<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sector;
use App\HeritageCost;
use App\Application;
use App\RoleUser;
use App\Offer;
use App\User;
use App\Demand;
use App\Interest;
use App\AverageInterest;
use Illuminate\Support\Facades\DB;


class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
                    public function index($id)
    {
        $sector = Sector::find($id);
        return $sector;
    }

    public function getcostopatrimonio()
    {
        $HeritageCost = HeritageCost::first();
        return $HeritageCost;
    }

    public function showtime()
    {
        $time = Application::where('state' , 'Iniciado')->orWhere('state' , 'En estudio')->orWhere('state' , 'Contactado')->orWhere('state' , 'Aceptada')->get();
        return $time;
    }

    public function showterminada()
    {
        $time = Application::where('state' , 'Rechazada')->orWhere('state' , 'Finalizado')->get();
        return $time;
    }

    public function solicitudesAdmin()
    {
        $sectores = Sector::orderBy("name")->get();
        $Banco = Offer::orderBy("name")->get();
        $empresas = Demand::orderBy("name_company")->get();
        $solicitud = Application::select('applications.id','applications.created_at as fecha','applications.state as estado','applications.terms as plazo','demands.name_company as empresa','offers.name as banco','applications.interest_rate as tasa','sectors.name as sector', 'applications.value as monto','indebtedness_capacities.wacc','simulation_demands.roic')
        ->join('indebtedness_capacities','indebtedness_capacities.id','applications.indebtedness_capacities_id')
        ->join('offers','offers.id','indebtedness_capacities.offers_id')
        ->join('simulations','simulations.id','indebtedness_capacities.simulation_id')
        ->join('sectors','sectors.id','simulations.sector_id')
        ->join('simulation_demands','simulation_demands.simulation_id','indebtedness_capacities.simulation_id')
        ->join('demands','demands.id','simulation_demands.demand_id')
//        ->where('applications.state','<>', 'Rechazada')
//        ->where('applications.state','<>', 'Vencida')
//        ->where('applications.state','<>', 'Aceptada')
        ->get();
        return view('admin/solicitudes')->with('solicitud',$solicitud)->with('sectores',$sectores)->with('Banco',$Banco)->with('empresas',$empresas);
    }

    public function historialAdmin()
    {
        $sectores = Sector::all();
        $Banco = Offer::all();
        $solicitud = Application::select('applications.id','applications.created_at as fecha','applications.state as estado','applications.terms as plazo','demands.name_company as empresa','offers.name as banco','applications.interest_rate as tasa','sectors.name as sector', 'applications.value as monto','indebtedness_capacities.wacc','simulation_demands.roic')
        ->join('indebtedness_capacities','indebtedness_capacities.id','applications.indebtedness_capacities_id')
        ->join('offers','offers.id','indebtedness_capacities.offers_id')
        ->join('simulations','simulations.id','indebtedness_capacities.simulation_id')
        ->join('sectors','sectors.id','simulations.sector_id')
        ->join('simulation_demands','simulation_demands.simulation_id','indebtedness_capacities.simulation_id')
        ->join('demands','demands.id','simulation_demands.demand_id')
        ->where('applications.state','<>', 'Iniciado')
        ->where('applications.state','<>', 'En estudio')
        ->get();
        return view('admin/historial')->with('solicitud',$solicitud)->with('sectores',$sectores)->with('Banco',$Banco);
    }

    
    public function edit(Request $request, $id)
    {
        $heritage= HeritageCost::find($id);
        $heritage->tlr_usa=$request->tlr_usa;
        $heritage->embi=$request->embi;
        $heritage->tasa_impuestos=$request->tasa_impuestos;
        $heritage->prima_mercado=$request->prima_mercado;
        $heritage->inflacion_colombia=$request->inflacion_colombia;
        $heritage->inflacion_usa=$request->inflacion_usa;

        if ($heritage->save()) {
            # code...
            return response()->json([
				'status' => true,
				'mensaje' => 'Si',
			]);

        }else {
            # code...
            return response()->json([
				'status' => false,
				'mensaje' => 'No',
			]);
        }

    }

    public function editbeta(Request $request, $id)
    {
        $sector= Sector::find($id);
        $sector->beta_desapalancado=$request->valor;

        if ($sector->save()) {
            # code...
            return response()->json([
				'status' => true,
				'mensaje' => 'Si',
			]);

        }else {
            # code...
            return response()->json([
				'status' => false,
				'mensaje' => 'No',
			]);
        }

    }
    public function registeroffer(Request $request)
    {
        $existeEmail =User::where('email', '=', $request->email)->count();
        $existeNit =Offer::where('nit', '=', $request->nit)->count();
        $existeEmpresa =Offer::where('name', '=', $request->name)->count();


        if ($existeEmail >= 1) {
            # code...
            return response()->json([
				'status' => true,
				'mensaje' => 'errorEmail',
			]);
        }else if($existeNit >= 1){
            return response()->json([
				'status' => true,
				'mensaje' => 'errorNit',
			]);
        }else if($existeEmpresa >= 1){
            return response()->json([
				'status' => true,
				'mensaje' => 'errorEmpresa',
			]);
        }
        else{

            $cadena = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";
            $longitudCadena = strlen($cadena);
            $pass = "";
            $longitudPass = 8;
            for ($i = 1; $i <= $longitudPass; $i++) {
                $pos = rand(0, $longitudCadena - 1);
                $pass .= substr($cadena, $pos, 1);
            }

            DB::commit();
    
            $user = new User();
            $user->email = $request->email;
            $user->password = bcrypt($pass);
    
            if ($user->save()) {
                $RoleUser = new RoleUser();
                $RoleUser->role_id = 2;
                $RoleUser->user_id = $user->id;
                $RoleUser->save();
                
                $offer = new Offer();
                $offer->user_id = $user->id;
                $offer->nit = $request->nit;
                $offer->name = $request->name;
                $offer->name_functionary = $request->name_functionary;
                $offer->ebitda_interes = 0;
                $offer->of_ebitda = 0;
                $offer->of_financiacion = 0;
                $offer->save();

                for ($i=1; $i <= 22 ; $i++) { 
                    # code...
                    $Interest = new Interest();
                    $Interest->offer_id=$offer->id;
                    $Interest->sector_id=$i;
                    $Interest->noventa=0;
                    $Interest->ciento_ochenta=0;
                    $Interest->average=0;
                    $Interest->un_ano=0;
                    $Interest->dos_anos=0;
                    $Interest->mas_dos_anos=0;
                    $Interest->state= "No";
                    $Interest->save();

                }
                $AverageInterest = new AverageInterest();
                $AverageInterest->offer_id=$offer->id;
                $AverageInterest->agricultura=0;
                $AverageInterest->explotacion=0;
                $AverageInterest->industria=0;
                $AverageInterest->electricidad=0;
                $AverageInterest->agua=0;
                $AverageInterest->construccion=0;
                $AverageInterest->comercio= 0;
                $AverageInterest->transporte=0;
                $AverageInterest->alojamiento=0;
                $AverageInterest->comunicaciones=0;
                $AverageInterest->financieras=0;
                $AverageInterest->inmobiliarias=0;
                $AverageInterest->cientificas=0;
                $AverageInterest->administrativos= 0;
                $AverageInterest->publica=0;
                $AverageInterest->educacion=0;
                $AverageInterest->salud=0;
                $AverageInterest->arte=0;
                $AverageInterest->otras=0;
                $AverageInterest->hogares=0;
                $AverageInterest->organizaciones= 0;
                $AverageInterest->noincluidas= 0;
                $AverageInterest->save();


                DB::rollBack();

                // Si el usuario es creado, se envia un correo electronico con la clave del nuevo usuario.
                
                \Mail::send('emails.emailRegisterUser', ['pass' => $pass, 'user' => $user->email], function ($prov) use ($user) {
                    $prov->to($user->email)->subject('Bienvenido a Nonio');
                });
                
                return response()->json([
                    'status' => true,
                    'mensaje' => 'Si',
                    'usuario' => $user->email,
                    'clave' => $pass
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'mensaje' => 'No se pudo guardar el usuario',
                ]);
            }



        }

    }


    public function inscritosUsers()
    {
        $usuarios =
            DB::table('offers')
            ->select('users.*', 'users.id AS idUser','offers.*', 'offers_users.name as nombre')
            ->join('offers_users', 'offers_users.offers_id', 'offers.id')
            ->join('users', 'offers_users.user_id', 'users.id')
            ->join('role_users', 'role_users.user_id', 'users.id')
            ->where('role_users.role_id', '=', 4)
            //->where('offers.user_id', '=', Auth::user()->id)
            ->get();

        return view('oferente/usuarios')->with('usuarios', $usuarios);
    }

    public function inscritosOffers()
    {
        $bancos =
                DB
                ::table('offers')
                ->select('offers.id', 'offers.name','offers.nit','offers.name_functionary','users.email')
                ->join('users','users.id','=','offers.user_id')
                ->get();

        return view('admin/bancosinscritos',compact('bancos'));
    }

    public function inscritosEmpresas()
    {
        $empresas =
                DB
                ::table('demands')
                ->select('demands.id', 'demands.name_company','demands.nit','demands.name_contact','demands.phone','demands.ubication','users.email')
                ->join('users','users.id','=','demands.user_id')
                ->get();

        return view('admin/empresasinscritas',compact('empresas'));
    }

    public function entidadesFinancierasDelete($id)
    {

        try
        {
            DB::commit();

            $entidad = DB::table('offers')->where('id','=',$id);

            $offer_id = $entidad->first()->id;

            $user_id = $entidad->first()->user_id;

            $role_user = DB::table('role_users')->where('user_id','=',$user_id);

            $average_interest = DB::table('average_interests')->where('offer_id','=',$offer_id);

            $interest = DB::table('interests')->where('offer_id','=',$offer_id);

            $average_interest->delete();

            $interest->delete();

            $entidad->delete();

            $role_user->delete();

            $user = DB::table('users')->where('id','=',$user_id);

            $user->delete();

            alert()->warning("Eliminada correctamente")->confirmButton();
        }
        catch (\Exception $exception)
        {
            DB::rollback();
            dd($exception);
        }


        return redirect()->back();

    }
    
    public function empresasDelete($id)
    {

        try
        {
            DB::commit();

            $entidad = DB::table('demands')->where('id','=',$id);

            $demand_id = $entidad->first()->id;

            $user_id = $entidad->first()->user_id;
            
            $simulation_demands = DB::table('simulation_demands')->where('demand_id','=',$demand_id);
            
            $simulation_id = $simulation_demands->first()->simulation_id;

            $role_user = DB::table('role_users')->where('user_id','=',$user_id);

            $demands = DB::table('demands')->where('user_id','=',$user_id);

            $simulation = DB::table('simulations')->where('id','=',$simulation_id);
            
            $indebtness = DB::table('indebtedness_capacities')->where('simulation_id','=',$simulation_id);

            foreach ($indebtness->get() as $indebt){
                $application = DB::table('applications')->where('indebtedness_capacities_id','=',$indebt->id);
                $application->delete();
            }
            $indebtness->delete();

            $simulation_demands->delete();
            
            $demands->delete();

            $simulation->delete();
            
            $role_user->delete();

            $entidad->delete();

            $user = DB::table('users')->where('id','=',$user_id);

            $user->delete();

            alert()->warning("Eliminada correctamente")->confirmButton();
        }
        catch (\Exception $exception)
        {
            DB::rollback();
            dd($exception);
        }


        return redirect()->back();

    }

   
}
