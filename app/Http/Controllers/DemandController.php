<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Demand;
use App\User;
use App\Simulation;
use App\Sector;
use App\SimulationDemand;
use App\Application;
use App\IndebtednessCapacity;
use App\HeritageCost;
use App\Offer;
use Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use redirect;

class DemandController extends Controller
{
   
    public function application(Request $request)
    {
        $solicitud = new Application();
        $solicitud->indebtedness_capacities_id = $request->id;
        $solicitud->value = $request->monto;
        $solicitud->interest_rate = $request->tasainteres;
        $solicitud->terms = $request->plazo;
        $solicitud->state = "Iniciado";

        if ($solicitud->save()) {

            $user = auth()->user();

            $select = [
                'offers.name as banco',
                'offers.name as banco',
                'indebtedness_capacities.cea as capacidad',
                'simulations.*',
                'applications.*',
                'users.email',
            ];


            $simulation = DB::table('applications')
                ->select($select)
                ->join('indebtedness_capacities', 'indebtedness_capacities.id', 'applications.indebtedness_capacities_id')
                ->join('simulation_demands', 'simulation_demands.simulation_id', 'indebtedness_capacities.simulation_id')
                ->join('offers', 'offers.id', 'indebtedness_capacities.offers_id')
                ->join('users', 'offers.user_id', 'users.id')
                ->join('simulations', 'simulations.id', 'simulation_demands.simulation_id')
                ->where('applications.id', '=', $solicitud->id )->first();

            //nueva solicitud a banco
            Mail::send('emails.newSolicitud', ['simulation' => $simulation], function ($prov) use ($simulation) {
                $prov->to($simulation->email)->subject('Nueva solicitud');
            });

            //nueva solicitud a empresa
            Mail::send('emails.newSolicitudExitosa', ['simulation' => $simulation], function ($prov) use ($simulation) {
                $prov->to($simulation->email_contact)->subject('Solicitud Exitosa');
            });

            # code...
            return  $solicitud->indebtedness_capacities_id;

        }else{
            return response()->json([
				'status' => false,
				'mensaje' => 'No',
			]);
        }
    }

   
    public function store(Request $request)
    {
	    $value_requested = floatval(str_replace(",","",$request->get('value_requested')));
        
        $demand = new Demand();
        $demand->user_id = $request->get('user_id');
        $demand->nit = $request->get('nit');
		$demand->name_company = $request->get('name_company');
		$demand->name_contact = $request->get('name_contact');
		$demand->phone = $request->get('phone_contact');
        $demand->ubication = $request->get('ubication');
        

        if ($demand->save()) {
            # code...
            
            $simulacion = Simulation::find($request->get('simulation_id'));
            $heritage_costs = HeritageCost::find(1);
            $max = IndebtednessCapacity::where('simulation_id',$request->get('simulation_id'))->max('cea');
            $beta = Sector::where('id',$simulacion->sector_id)->first();

            $simulation_demand = new SimulationDemand();
            $simulation_demand->simulation_id = $request->get('simulation_id');
            $simulation_demand->demand_id =  $demand->id;
            $simulation_demand->value = $value_requested;
            $simulation_demand->rodi = $simulacion->ebitda - (($simulacion->ebitda - $simulacion->depreciation_costs - $simulacion->amortizacion_costs) *($heritage_costs->tasa_impuestos/100));
            $rodi= $simulacion->ebitda - (($simulacion->ebitda - $simulacion->depreciation_costs - $simulacion->amortizacion_costs) *($heritage_costs->tasa_impuestos/100));
            $simulation_demand->dinversion =($simulacion->financial_obligations / ($simulacion->financial_obligations + $simulacion->heritage_value))*100;
            $dinversion =($simulacion->financial_obligations / ($simulacion->financial_obligations + $simulacion->heritage_value))*100;
            $simulation_demand->roic =($rodi / ($simulacion->financial_obligations + $simulacion->heritage_value)*100);
            $simulation_demand->eadicional = $max;

            $simulation_demand->costopatrimonio= ((1+($heritage_costs->tlr_usa/100)+($heritage_costs->embi/100)+$beta->beta_desapalancado*(1+(($dinversion/100)*(1-($heritage_costs->tasa_impuestos/100))))*($heritage_costs->prima_mercado/100) )* (1+((1+($heritage_costs->inflacion_colombia/100))/(1+($heritage_costs->inflacion_usa/100))-1))-1)*100;
            if($simulation_demand->save()){
                $bancos = Offer::all();
                for ($i=0; $i <  count($bancos); $i++) { 

                    $capacidad = IndebtednessCapacity::where('simulation_id',$request->get('simulation_id'))->where('offers_id',$bancos[$i]->id)->first();
                    if ($capacidad == '') {
                        # code...
                    }else{
                        $taxes = $capacidad->after_taxes;
                        $capacidad->wacc =  ((($simulation_demand->dinversion/100) * ($taxes/100)) +((1-($simulation_demand->dinversion/100))* ($simulation_demand->costopatrimonio/100)))*100;
                        $capacidad->save();
                    }
                }
                $simu = Simulation::select('sectors.name as sector', 'simulations.*')->join('sectors','sectors.id','simulations.sector_id')->where('simulations.id',$request->get('simulation_id'))->first();

                // \Mail::send('emails.emailNotificacion',  ['simulacion' => $simu , 'pyme' => $demand,'simulation_demand' => $simulation_demand], function ($mail)  {
                //     $mail->to('nicolas.cardenas@grimorum.com')->subject('Registro Nuevo');
                // });

                // return view('success');

                if (Auth::loginUsingId($demand->user_id,true)) {            //     # code...
                    return redirect()->route('/marketplace',['simulation_id'=> $request->get('simulation_id')]);
                }
                else{
                    return false;
                }

            } else {
                # code...
                return false;
            }
            
        }else {
            # code...
            return false;
        }
        
    }

    public function show($id)
    {
        $Demand =Demand::find($id); 
        return $Demand;

    }

    public function updatedata(Request $request){

        $Demandupdate = Demand::find($request->get('id'));
        $Demandupdate->nit = $request->get('nit');        
        $Demandupdate->name_company = $request->get('compañia');
        $Demandupdate->name_contact = $request->get('contacto');
        $Demandupdate->phone = $request->get('phone');
        $Demandupdate->ubication = $request->get('ubication');
        $Demandupdate->save();

        return response()->json([
            'status' => true,
            'mensaje' => 'Actualización exitosa',
        ]);

    }

}
