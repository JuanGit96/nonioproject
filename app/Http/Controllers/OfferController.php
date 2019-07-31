<?php

namespace App\Http\Controllers;

use App\Demand;
use App\SimulationDemand;
use Illuminate\Http\Request;
use App\Offer;
use App\Interest;
use App\AverageInterest;
use App\Application;
use DB;
use Auth;
use App\OfertUser;
use App\User;
use App\RoleUser;
//use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Alert;

class OfferController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id, $minimo)
    {
        $clients = DB::table('indebtedness_capacities')
                        ->join('offers', 'offers.id', '=', 'indebtedness_capacities.offers_id')
                        ->join('interests', 'interests.offer_id', '=', 'indebtedness_capacities.offers_id')
                        ->join('simulations', 'simulations.sector_id', 'interests.sector_id')
                        // ->join('applications', 'applications.indebtedness_capacities_id', '=', 'indebtedness_capacities.id')
                        ->select('indebtedness_capacities.id as id_capacidad', 'offers.*', 'indebtedness_capacities.simulation_id')
                        ->where('indebtedness_capacities.simulation_id', $id)
                        ->where('simulations.id', $id)
                        ->where('indebtedness_capacities.cea', '>=', $minimo)
                        ->where('interests.state', '=', 'No')
                        ->whereRaw("indebtedness_capacities.id NOT IN (select DISTINCT applications.indebtedness_capacities_id as id from applications join indebtedness_capacities on applications.indebtedness_capacities_id = indebtedness_capacities.id where indebtedness_capacities.simulation_id = '$id')")
                        ->get();
        //return $clients;

        $count = count($clients);
        $interes = Interest::select("interests.*")
                ->join('simulations', 'simulations.sector_id', 'interests.sector_id')
                ->join('offers', 'offers.id', '=', 'interests.offer_id')
                ->where('interests.state', '=', 'No')
                ->where('simulations.id', $id)
                ->get();

        /*$indebtedness_capacities = DB::table('indebtedness_capacities')
                ->where('indebtedness_capacities.simulation_id', '=', $id)
                ->where('indebtedness_capacities.offers_id', '=', $clients[0]->id)
                ->first();

        $applications = DB::table('applications')
                ->where('applications.indebtedness_capacities_id', '=', $indebtedness_capacities->id)
                ->count();

        $applications2 = DB::table('indebtedness_capacities')
                ->join('applications', 'applications.indebtedness_capacities_id', '=', 'indebtedness_capacities.id')
                ->where('indebtedness_capacities.simulation_id', '=', $id)
                ->first();
        */


        $res = array(
            'clients' => $clients, 
            'count' => $count, 
            'interes' => $interes, 
            //'applications' => $applications, 
            //'indebtedness_capacities' => $indebtedness_capacities, 
            //'applications2' => $applications2
                );

        return $res;
    }

    public function show()
    {
        $id = Auth::id();
        $offer = Offer::where('user_id', $id)->first();
        return $offer;
    }

    public function showtasas($id)
    {
        $id_user = Auth::id();
        $offer = Offer::where('user_id', $id_user)->first();
        $Tasas = Interest::where('offer_id', $offer->id)->where('sector_id', $id)->first();
        return $Tasas;
    }

    public function updatetasainteres($id, Request $request)
    {

        $Interest = Interest::find($request->get('interes'));
        $Interest->noventa = $request->get('noventa');
        $Interest->ciento_ochenta = $request->get('ciento_ochenta');
        $Interest->un_ano = $request->get('un_ano');
        $Interest->dos_anos = $request->get('dos_anos');
        $Interest->mas_dos_anos = $request->get('mas_dos_anos');
        $Interest->average = 0;
        $Interest->state = 'No';
        $Interest->save();

        if ($Interest->save())
        {
            return response()->json([
                        'status' => true,
                        'mensaje' => 'Tasas guardadas',
            ]);
        }
    }

    public function showpyme($id)
    {

        $select = [
            'simulations.*',
            'demands.nit',
            'demands.name_company',
            'demands.name_contact',
            'demands.phone',
            'demands.ubication',
            'applications.state',
            'indebtedness_capacities.cec',
            'indebtedness_capacities.cecc',
            'indebtedness_capacities.ces',
            'indebtedness_capacities.cea',
            'indebtedness_capacities.after_taxes'
        ];

        $pyme = Application::select($select)
                ->join('indebtedness_capacities', 'indebtedness_capacities.id', 'applications.indebtedness_capacities_id')
                ->join('simulations', 'simulations.id', 'indebtedness_capacities.simulation_id')
                ->join('simulation_demands', 'simulation_demands.simulation_id', 'simulations.id')
                ->join('demands', 'demands.id', 'simulation_demands.demand_id')
                ->where('applications.id', $id)
                ->first();
        return $pyme;
    }

    public function guardartasas(Request $request)
    {

        $id_user = Auth::id();
        $offer = Offer::where('user_id', $id_user)->get();


        for ($i = 1; $i <= 22; $i++)
        {

            $Interest = Interest::find($i);
            $Interest->sector_id = $i;
            $Interest->noventa = $request->get('noventa');
            $Interest->ciento_ochenta = $request->get('ciento_ochenta');
            $Interest->un_ano = $request->get('un_ano');
            $Interest->dos_anos = $request->get('dos_anos');
            $Interest->mas_dos_anos = $request->get('mas_dos_anos');
            $Interest->average = ($request->noventa + $request->ciento_ochenta + $request->un_ano + $request->dos_anos + $request->mas_dos_anos) / 5;
            $Interest->state = 'No';
            $Interest->save();
        }
        return response()->json([
                    'status' => true,
                    'mensaje' => 'Tasas guardadas',
        ]);
    }

    public function updatetasas(Request $request, $id)
    {

        try {
            $tasas = Interest::find($id);

            $offer_id = $tasas->offer_id;

            $noTasas = Interest::where('offer_id', $offer_id)->get();

            foreach ($noTasas as $tasa)
            {
                $t = Interest::find($tasa->id);

                $t->noventa = $request->noventa;
                $t->ciento_ochenta = $request->ciento_ochenta;
                $t->un_ano = $request->un_ano;
                $t->dos_anos = $request->dos_anos;
                $t->mas_dos_anos = $request->mas_dos_anos;
                $t->average = ($request->noventa + $request->ciento_ochenta + $request->un_ano + $request->dos_anos + $request->mas_dos_anos) / 5;






                if ($t->save())
                {
                    $prom = AverageInterest::where('offer_id', $t->offer_id)->first();
                    if ($t->sector_id == 1)
                    {
                        # code...
                        $prom->agricultura = $t->average;
                    }
                    else if ($t->sector_id == 2)
                    {
                        $prom->explotacion = $t->average;
                    }
                    else if ($t->sector_id == 3)
                    {
                        $prom->industria = $t->average;
                    }
                    else if ($t->sector_id == 4)
                    {
                        $prom->electricidad = $t->average;
                    }
                    else if ($t->sector_id == 5)
                    {
                        $prom->agua = $t->average;
                    }
                    else if ($t->sector_id == 6)
                    {
                        $prom->construccion = $t->average;
                    }
                    else if ($t->sector_id == 7)
                    {
                        $prom->comercio = $t->average;
                    }
                    else if ($t->sector_id == 8)
                    {
                        $prom->transporte = $t->average;
                    }
                    else if ($t->sector_id == 9)
                    {
                        $prom->alojamiento = $t->average;
                    }
                    else if ($t->sector_id == 10)
                    {
                        $prom->comunicaciones = $t->average;
                    }
                    else if ($t->sector_id == 11)
                    {
                        $prom->financieras = $t->average;
                    }
                    else if ($t->sector_id == 12)
                    {
                        $prom->inmobiliarias = $t->average;
                    }
                    else if ($t->sector_id == 13)
                    {
                        $prom->cientificas = $t->average;
                    }
                    else if ($t->sector_id == 14)
                    {
                        $prom->administrativos = $t->average;
                    }
                    else if ($t->sector_id == 15)
                    {
                        $prom->publica = $t->average;
                    }
                    else if ($t->sector_id == 16)
                    {
                        $prom->educacion = $t->average;
                    }
                    else if ($t->sector_id == 17)
                    {
                        $prom->salud = $t->average;
                    }
                    else if ($t->sector_id == 18)
                    {
                        $prom->arte = $t->average;
                    }
                    else if ($t->sector_id == 19)
                    {
                        $prom->otras = $t->average;
                    }
                    else if ($t->sector_id == 20)
                    {
                        $prom->hogares = $t->average;
                    }
                    else if ($t->sector_id == 21)
                    {
                        $prom->organizaciones = $t->average;
                    }
                    else if ($t->sector_id == 22)
                    {
                        $prom->noincluidas = $tasas->average;
                    }
                    $prom->save();
//                return response()->json([
//                    'status' => true,
//                    'mensaje' => 'Si',
//                ]);
                }
                else
                {
                    # code...
                    return response()->json([
                        'status' => false,
                        'mensaje' => 'No',
                    ]);
                }
            }











        }
        catch (\Exception $exception)
        {
            # code...
            return response()->json([
                'status' => false,
                'mensaje' => 'No',
            ]);
        }

        return response()->json([
                    'status' => true,
                    'mensaje' => 'Si',
                ]);


    }

    public function update(Request $request, $id)
    {
        //
        $covenant = Offer::find($id);
        $covenant->ebitda_interes = $request->ebitda_interes;
        $covenant->of_ebitda = $request->of_ebitda;
        $covenant->of_financiacion = $request->of_financiacion;
        if ($covenant->save())
        {
            # code...
            return response()->json([
                        'status' => true,
                        'mensaje' => 'Si',
            ]);
        }
        else
        {
            # code...
            return response()->json([
                        'status' => false,
                        'mensaje' => 'No',
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function solicitudes()
    {
        $userAuth = Auth::id();

        $rolAuth = DB::table('role_users')->where('user_id','=',$userAuth)->first()->role_id;

        if ($rolAuth == 2) #si es banco
            $id = $userAuth;

        if ($rolAuth == 4) # si es un usuario
        {
            $id = DB::table('offers_users')->where('user_id','=',$userAuth)->first()->offers_id;
        }

        $solicitud = DB::table('applications')
                ->select('applications.id', 'applications.created_at as fecha', 'applications.state as estado', 'demands.name_company as empresa', 'applications.interest_rate as tasa', 'sectors.name as sector', 'applications.value as monto', 'indebtedness_capacities.wacc', 'simulation_demands.roic')
                ->join('indebtedness_capacities', 'indebtedness_capacities.id', 'applications.indebtedness_capacities_id')
                ->join('simulation_demands', 'simulation_demands.simulation_id', 'indebtedness_capacities.simulation_id')
                ->join('offers', 'offers.id', 'indebtedness_capacities.offers_id')
                ->join('simulations', 'simulations.id', 'simulation_demands.simulation_id')
                ->join('demands', 'demands.id', 'simulation_demands.demand_id')
                ->join('sectors', 'sectors.id', 'simulations.sector_id')
                ->where('offers.user_id', $id);
//                ->where('applications.state', '<>', 'Rechazada')
//                ->where('applications.state', '<>', 'Vencida')
//                ->get();

        if ($rolAuth == 2) #si es banco
        {
            $solicitud = $solicitud
                        ->where('applications.state', '<>', 'Rechazada')
                        ->where('applications.state', '<>', 'Vencida')
                        ->get();
        }


        if ($rolAuth == 4) # si es un usuario
        {
            $solicitud = $solicitud
                ->where('applications.state', '=', 'Aceptada')
                ->get();
        }

        return view('oferente/solicitudes')->with('solicitud', $solicitud);
    }

    public function historial()
    {
        $userAuth = Auth::id();

        $rolAuth = DB::table('role_users')->where('user_id','=',$userAuth)->first()->role_id;

        if ($rolAuth == 2) #si es banco
            $id = $userAuth;

        if ($rolAuth == 4) # si es un usuario
        {
            $id = DB::table('offers_users')->where('user_id','=',$userAuth)->first()->offers_id;
        }

        $solicitud = DB::table('applications')
            ->select('applications.created_at as fecha', 'applications.state as estado', 'demands.name_company as empresa', 'applications.interest_rate as tasa', 'sectors.name as sector', 'applications.value as monto', 'applications.id')
            ->join('indebtedness_capacities', 'indebtedness_capacities.id', 'applications.indebtedness_capacities_id')
            ->join('simulation_demands', 'simulation_demands.simulation_id', 'indebtedness_capacities.simulation_id')
            ->join('offers', 'offers.id', 'indebtedness_capacities.offers_id')
            ->join('simulations', 'simulations.id', 'simulation_demands.simulation_id')
            ->join('demands', 'demands.id', 'simulation_demands.demand_id')
            ->join('sectors', 'sectors.id', 'simulations.sector_id')
            ->where('offers.user_id', $id)
            ->where('applications.state', '<>', 'Iniciado')
            ->where('applications.state', '<>', 'En estudio')
            ->get();

        return view('oferente/historial')->with('solicitud', $solicitud);
    }

    public function changestate(Request $request)
    {

        (isset($request->id_aplicacion2))?$application = $request->id_aplicacion2 : $application = $request->id_aplicacion;
        (isset($request->estado2))?$estadoNuevo = $request->estado2 : $estadoNuevo = $request->estado;

        $estado = Application::find($application);
        $estado->state = $estadoNuevo;

        if ($estado->save())
        {
            $simulation = DB::table('applications')
                ->select('simulations.email_contact')
                ->join('indebtedness_capacities', 'indebtedness_capacities.id', 'applications.indebtedness_capacities_id')
                ->join('simulation_demands', 'simulation_demands.simulation_id', 'indebtedness_capacities.simulation_id')
                ->join('simulations', 'simulations.id', 'simulation_demands.simulation_id')
                ->where('applications.id', '=', $application )->first();

            //Si el usuario es creado, se envia un correo electronico con la clave del nuevo usuario.
            Mail::send('emails.changeSolicitud', ['estado' => $request->estado], function ($prov) use ($simulation) {
                $prov->to($simulation->email_contact)->subject('Cambio en el estado de tu solicitud');
            });


            return response()->json([
                        'status' => true,
                        'mensaje' => 'Si',
            ]);
        }
        else
        {
            # code...
            return response()->json([
                        'status' => false,
                        'mensaje' => 'No',
            ]);
        }
    }

    public function createUser(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',

        ],[
            'name.required' => 'El campo nombre es obligatorio',
            'email.required' => 'El campo email es obligatorio',
            'email.unique' => 'El correo ya está registrado',
            'email.email' => 'El campo email no es valido',
        ]);

        $cadena = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";
        $longitudCadena = strlen($cadena);
        $pass = "";
        $longitudPass = 8;
        for ($i = 1; $i <= $longitudPass; $i++)
        {
            $pos = rand(0, $longitudCadena - 1);
            $pass .= substr($cadena, $pos, 1);
        }

        try
        {
            DB::commit();

            $offers = Offer::where('user_id', Auth::id())->first();

            $user = new User();
            $user->email = $request->email;
            $user->password = bcrypt($pass);
            $user->save();

            $rol = new RoleUser();
            $rol->user_id = $user->id;
            $rol->role_id = 4;
            $rol->save();


            $oferuser = new OfertUser();
            $oferuser->name = $request->name;
            $oferuser->offers_id = $offers->id;
            $oferuser->user_id = $user->id;
            $oferuser->save();

            if ($user->save())
            {

            //Si el usuario es creado, se envia un correo electronico con la clave del nuevo usuario.
            \Mail::send('emails.emailRegisterUser', ['pass' => $pass, 'user' => $user->email], function ($prov) use ($user) {
                $prov->to($user->email, $user->name)->subject('Usuario de Nonio');
            });

//            return response()->json([
//                        'status' => true,
//                        'mensaje' => 'Usuario creado',
//            ]);

                Alert::success('Creacion exitosa de usuario')->persistent("Cerrar");

                return redirect()->back();

            }


        }
        catch(\Exception $e)
        {
            Alert::error('Error en el servidor')->persistent("Cerrar");

            return redirect()->back();

            DB::rollback();

        }


    }

    public function usuarios()
    {

        $usuarios = DB::table('offers')->select('users.*','users.id AS idUser', 'offers.*', 'offers_users.name as nombre')
                ->join('offers_users', 'offers_users.offers_id', 'offers.id')
                ->join('users', 'offers_users.user_id', 'users.id')
                ->join('role_users', 'role_users.user_id', 'users.id')
                ->where('role_users.role_id', '=', 4)
                ->where('offers.user_id', '=', Auth::user()->id)
                ->get();

        return view('oferente/usuarios')->with('usuarios', $usuarios);
    }

    public function destroyUsersByOffer($user_id)
    {
        $user = User::findOrFail($user_id);

        $role = DB::table('role_users')->where('user_id','=',$user->id);

        $user_offer = DB::table('offers_users')->where('user_id','=',$user->id);

        $role->delete();

        $user_offer->delete();

        $user->delete();

        alert()->warning("Eliminada correctamente")->confirmButton();

        return redirect()->back();

    }

    public function tasas_plazos()
    {

        $offers = DB::table('offers')->where('user_id', Auth::user()->id)->first();

        $Interest = Interest::where('offer_id', $offers->id)->get();
        return view('oferente/tasas_plazos')->with("Interest", $Interest);
    }

    public function Betar($id)
    {

        $betar = Interest::find($id);
        $betar->state = "Si";
        $betar->save();

        return response()->json([
                    'status' => true,
                    'mensaje' => 'Sector Betado',
        ]);
    }

    public function Habilitar($id)
    {

        $betar = Interest::find($id);
        $betar->state = "No";
        $betar->save();

        return response()->json([
                    'status' => true,
                    'mensaje' => 'Sector Habilitado',
        ]);
    }

}
