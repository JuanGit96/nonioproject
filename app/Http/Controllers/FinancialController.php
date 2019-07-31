<?php

namespace App\Http\Controllers;

use App\Application;
use App\Demand;
use App\HeritageCost;
use App\IndebtednessCapacity;
use App\Interest;
use App\Offer;
use App\Simulation;
use App\SimulationDemand;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FinancialController extends Controller
{
    public function editInfoFinanciera(Request $request, $id)
    {
        ###

        $validatedData = $request->validate([
            'sector' => 'required',
            'date' => 'required',
            'income' => 'required',
            'sale_value' => 'required',
            'operating_costs' => 'required',
            'depreciation_costs' => 'required',
            'amortization_costs' => 'required',
            'financial_obligations' => 'required',
            'heritage_value' => 'required',
            'email_contact' => 'required',
        ]);

        // Convierte los valores a decimal
        $val1 = $request->get('income');
        $val2 = $request->get('sale_value');
        $val3 = $request->get('operating_costs');
        $val4 = $request->get('depreciation_costs');
        $val5 = $request->get('financial_obligations');
        $val6 = $request->get('amortization_costs');
        $val7 = $request->get('heritage_value');


        $income = floatval(str_replace(",","",$val1));
        $sale_value = floatval(str_replace(",","",$val2));
        $operating_costs = floatval(str_replace(",","",$val3));
        $depreciation_costs = floatval(str_replace(",","",$val4));
        $financial_obligations = floatval(str_replace(",","",$val5));
        $amortization_costs = floatval(str_replace(",","",$val6));
        $heritage_value = floatval(str_replace(",","",$val7));

        // valida si tiene una simulacion pendiente
        $User =User::where('email', '=', $request->get('email_contact'))->count();
        if ($User == 1) {
            # code...
            $user =User::where('email', '=', $request->get('email_contact'))->first();
            $demand= Demand::where('user_id',$user->id )->count();
            if ($demand == 0) {
                # code...
                return view('sorry')->with('btn',false)->with('info',"Segun nuestros registros solicitaste una simulación pero no continuaste con el proceso de registro, inicia sesión para continuar el proceso");
            }
            $demand2= Demand::where('user_id',$user->id )->first();
            $aplicaciones = Application::join('indebtedness_capacities','indebtedness_capacities.id','applications.indebtedness_capacities_id')
                ->join('simulation_demands','simulation_demands.simulation_id','indebtedness_capacities.simulation_id')
                ->where('simulation_demands.demand_id',$demand2->id) ->where('applications.state','Iniciado')->orWhere('applications.state','En estudio')->count();

            if ($aplicaciones >=1) {
                return view('sorry')->with('btn',false)->with('info',"En el momento tienes una simulacion de credito en estudio, debes esperar a que el banco cambie el estado de tu simulacion para crear una nueva");
            }
            else {

                $simulation = SimulationDemand::where('demand_id',$demand2->id)->get();
                # code...
                $simulacionSinAplicar = 0;
                for ($i=0; $i < count($simulation) ; $i++) {
                    # code...
                    $aplication = Application::join('indebtedness_capacities','indebtedness_capacities.id','applications.indebtedness_capacities_id')
                        ->where('indebtedness_capacities.simulation_id',$simulation[$i]->simulation_id)->count();

                   // if ($aplication==0) {
                        # code...
                     //   $simulacionSinAplicar= 1;
                    //}
                }
                if ($simulacionSinAplicar>=1) {
                    return view('sorry')->with('btn',false)->with('info',"Segun nuestro registros empezaste una simulacion y no solicitaste ningun banco, inicia sesion y termina el proceso");
                }
            }
        }

        // Editar simulacion simulacion
        $simulation = Simulation::findOrFail($id);
        $simulation->sector_id = $request->get('sector');
        $simulation->date = $request->get('date');
        $simulation->income = $income;
        $simulation->sale_value = $sale_value;
        $simulation->operating_costs = $operating_costs;
        $simulation->depreciation_costs = $depreciation_costs;
        $simulation->financial_obligations = $financial_obligations;
        $simulation->amortization_costs = $amortization_costs;
        $simulation->heritage_value = $heritage_value;
        $simulation->email_contact = $request->get('email_contact');

        //obtenemos el campo file definido en el formulario
        if($request->file('file')){
            $file = $request->file('file');

            //obtenemos el nombre del archivo
            $nombre = $file->getClientOriginalName();

            //indicamos que queremos guardar un nuevo archivo en el disco local
            \Storage::disk('local')->put($nombre,  \File::get($file));

            // Se guarda el nombre del archivo en la BD
            $simulation->file= $nombre;

        }

        // Se realiza la operacion EBITDA
        $ebitda = ( $income-$sale_value - $operating_costs + $depreciation_costs+$amortization_costs );

        // Se guarda el resultado en la BD
        $simulation->ebitda = $ebitda;

        // Se calcula la capacidad de endeudamiento

        $bancos = Offer::where('ebitda_interes','<>' ,0)->get();
        $heritage_costs = HeritageCost::find(1);
        if ($simulation->save()) {
            //  recorremos todos los demandantes
            for ($i=0; $i < count($bancos) ; $i++) {
                $tasainteres = Interest::where('offer_id',$bancos[$i]->id)->where('sector_id',$simulation->sector_id)->where('state','No')->first();
                if ($tasainteres == '') {
                    # code...
                }else {
                    $capacity = new IndebtednessCapacity();
                    $capacity->simulation_id = $simulation->id;
                    $capacity->offers_id = $bancos[$i]->id;
                    $capacity->cec = ($simulation->ebitda / $bancos[$i]->ebitda_interes /( $tasainteres->average /100) );
                    $capacity->cecc = ($simulation->ebitda * $bancos[$i]->of_ebitda  );
                    $capacity->ces = ($simulation->heritage_value /(1- ($bancos[$i]->of_financiacion / 100) ))-$simulation->heritage_value;
                    $capacity->after_taxes =($tasainteres->average/100)  * (1-($heritage_costs->tasa_impuestos/100))*100;
                    $capacidades = array( $capacity->cec,$capacity->cecc,$capacity->ces );
                    foreach($capacidades as $numero){
                        if(!isset($menor)){
                            $menor = $numero;
                        }elseif($menor > $numero){
                            $menor = $numero;
                        }
                    }
                    $capacity->cea = ($menor- $simulation->financial_obligations);
                    $capacity->save();
                    unset($menor);
                }
            }



            #retornando a vista correspondiente

            $max = DB::table('indebtedness_capacities')->where('simulation_id', $id)->max('cea');
            $min = DB::table('indebtedness_capacities')->where('simulation_id', $id)->min('cea');

            if ($max <= 0)
            {
                return view('sorry')->with('btn', true)->with('info', "Según la información que suministró usted no es apto para solicitar un producto de financiamiento para su empresa. Si tiene alguna duda con respecto al resultado puede comunicarse a los números de contacto de Nonio. Gracias");
            }
            else if ($min <= 0)
            {
                $min = 0;
                return view('accepted')->with('edition',true)->with('max', $max)->with('min', $min)->with('id', $id);
            }
            else
            {
                return view('accepted')->with('edition',true)->with('max', $max)->with('min', $min)->with('id', $id);
            }


        }else {
            # code...
            return false;
        }
    }
}
