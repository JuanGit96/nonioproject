<?php

/*
  |--------------------------------------------------------------------------
  | Web Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register web routes for your application. These
  | routes are loaded by the RouteServiceProvider within a group which
  | contains the "web" middleware group. Now create something great!
  |
 */

use App\Exports\CostoDeudaExport;
use App\Exports\SolicitudesExport;
use Maatwebsite\Excel\Facades\Excel;
use RealRashid\SweetAlert\Facades\Alert;

date_default_timezone_set('America/Bogota');

Route::get('/', function () {
    return view('welcome');
});

Route::get('/preguntas_frecuentes', function () {
    return view('questions');
});
Route::get('/terminos_condiciones', function () {
    return view('termsAndConditions');
});
Route::get('/contacto', function () {
    return view('contact');
});

Route::get('/forgotpassword', function () {
    $msg = 0;
    return view('auth/passwords/email')->with('msg', $msg);
});
//Simulación
Route::get('/simulation', function () {
    $sector = DB::table('sectors')->get();
    return view('simulation')->with('sector', $sector);
});

Route::put('/validateEmail', 'SimulationController@validateEmail')->name("validateEmail");

Route::get('/accepted/{id}', function ($id) {
    $max = DB::table('indebtedness_capacities')->where('simulation_id', $id)->max('cea');
    $min = DB::table('indebtedness_capacities')->where('simulation_id', $id)->min('cea');
    if ($max <= 0)
    {
        return view('sorry')->with('btn', true)->with('info', "Según la información que suministraste no eres apto para solicitar un producto de financiamiento para tu empresa. Si tienes alguna duda con respecto al resultado puedes comunicarte a los números de contacto de Nonio. Gracias");
    }
    else if ($min <= 0)
    {
        $min = 0;
        return view('accepted')->with('max', $max)->with('min', $min)->with('id', $id);
    }
    else
    {
        return view('accepted')->with('max', $max)->with('min', $min)->with('id', $id);
    }
})->name("accepted");

Route::get('/success', function () {
    return view('success');
});

Route::get('/registro', function () {
    return view('register');
});
Route::get('/registerdemand/{id}/{simulation_id}', function ( $id, $simulation_id ) {
    $max = DB::table('indebtedness_capacities')->where('simulation_id', $simulation_id)->max('cea');
    return view('registerdemand')->with('id', $id)->with('simulation_id', $simulation_id)->with('max', $max);
})->name("registerdemand");

Route::post('/createuser', 'OfferController@createUser')->name("createuser");

Route::get('/user/{id}', 'UserController@createUser')->name("user");

Route::post('/validateNombre', 'UserController@validateNombre')->name("validateNombre");

Route::put('/changepassword', 'UserController@changepassword');


Route::post('/createdemand', 'DemandController@store')->name("/createdemand");
Route::post('/simulationfilter', 'SimulationController@createSimulation')->name("/simulationfilter");
Route::post('/updatedemand', 'DemandController@update')->name("/updatedemand");
Route::post('/updateNotDemand', 'DemandController@updateNotDemand')->name("/updateNotDemand");
Route::post('/resetpass', 'UserController@resetpass')->name("/resetpass");


Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => ['auth']], function () {

    // Perfil-------------------------------------------------------------------

    Route::get('/getuser', 'UserController@index')->name("getuser");


    // Modulo Administrador------------------------------------------------------------

    Route::get('/solicitudesAdmin', 'AdminController@solicitudesAdmin')->name("solicitudesAdmin");
    Route::get('/historial', 'AdminController@historialAdmin')->name("historial");

    Route::get('/EntidadesFinancieras', function () {
        return view('admin/financial_entities');
    });

    Route::get('inscritosUsers', 'AdminController@inscritosUsers')->name('get_admin_inscritosUsers');
    Route::get('inscritosOffers', 'AdminController@inscritosOffers')->name('get_admin_inscritosOffers');
    Route::get('inscritosEmpresas', 'AdminController@inscritosEmpresas')->name('get_admin_inscritosEmpresas');
    Route::delete('entidadesFinancieras_delete/{id}', 'AdminController@entidadesFinancierasDelete')->name('entidadesFinancieras.delete');
    Route::delete('empresas_delete/{id}', 'AdminController@empresasDelete')->name('empresas.delete');


    Route::post('/registeroffer', 'AdminController@registeroffer')->name("/registeroffer");

    Route::get('/costo_patrimonio', function () {
        $sector = DB::table('sectors')->get();
        return view('admin/costo_patrimonio')->with('sector', $sector);
    });

    Route::get('/costo_deuda', function () {
        $interes = DB::table('average_interests')->select('average_interests.*', 'offers.name as banco')->join('offers', 'offers.id', 'average_interests.offer_id')->get();
        return view('admin/costo_deuda')->with('interes', $interes);
    });

    Route::get('/costo_deuda/reportExcel', function (Excel $excel) {

        return (new CostoDeudaExport)->download('costo_deuda.xls');

    })->name('get_costo_deuda_excel');


    Route::get('/solicitudes/reportExcel', function (Excel $excel) {

        return (new SolicitudesExport)->download('solicitudes.xls');

    })->name('get_solicitudes_excel');


    Route::get('/getsector/{id}', 'AdminController@index')->name("getsector");
    Route::get('/getcostopatrimonio', 'AdminController@getcostopatrimonio')->name("getcostopatrimonio");
    Route::get('/showtime', 'AdminController@showtime')->name("showtime");
    Route::put('/editarcostopatrimonio/{id}', 'AdminController@edit')->name("editarcostopatrimonio");
    Route::put('/editarbeta/{id}', 'AdminController@editbeta')->name("editarbeta");



    // Oferentes--------------------------------------------------------------------------------

    Route::get('/covenants', function () {
        return view('oferente/covenants');
    });

    Route::get('/tasas_plazos', 'OfferController@tasas_plazos')->name("tasas_plazos");
    Route::get('/showpyme/{id}', 'OfferController@showpyme')->name("showpyme");
    Route::get('/getoffers/{id}/{minimo}', 'OfferController@index')->name("getoffers");
    Route::get('/getcovenants  ', 'OfferController@show')->name("getcovenants");
    Route::get('/tasasyplazos/{id}', 'OfferController@showtasas')->name("tasasyplazos");
    Route::get('/solicitudes_ofer  ', 'OfferController@solicitudes')->name("solicitudes_ofer");
    Route::get('/historial_ofer  ', 'OfferController@historial')->name("historial_ofer");
    Route::get('/showterminada  ', 'AdminController@showterminada')->name("showterminada");
    Route::put('/editarcovenant/{id}', 'OfferController@update')->name("editarcovenant");
    Route::put('/editartasas/{id}', 'OfferController@updatetasas')->name("editarcovenant");
    Route::put('/changestate', 'OfferController@changestate')->name("changestate");
    Route::put('/guardartasas', 'OfferController@guardartasas')->name("guardartasas");
    Route::post('/createUser', 'OfferController@createUser')->name("createUser");
    Route::get('/users', 'OfferController@usuarios')->name("users");

    Route::get('/Betar/{id}', 'OfferController@Betar')->name("Betar");

    Route::get('/Habilitar/{id}', 'OfferController@Habilitar')->name("Habilitar");

    #ELIMINAR USUARIO POR BANCO

    Route::delete('/eliminarUsuarioByBanc/{id}','OfferController@destroyUsersByOffer')->name('usuariosBancos.delete');



    Route::put('/updatetasainteres/{id}', 'OfferController@updatetasainteres')->name("updatetasainteres");

    Route::get('/createUser', function () {
        return view('oferente/crearusuarios');
    });




    // Demandantes
    Route::get('/marketplace/{simulation_id}', function ( $simulation_id) {
        $max = DB::table('indebtedness_capacities')->where('simulation_id', $simulation_id)->max('cea');
        // $min = DB::table('indebtedness_capacities')->where('simulation_id',$simulation_id)->min('cea');

        $demand = DB::table('simulation_demands')->where('simulation_id', $simulation_id)->first();
        $min = 0;
        $info = DB::table('applications')
                ->select('applications.id as appId', 'applications.state as estado', 'applications.created_at as fecha', 'applications.updated_at as fecha2')
                ->join('indebtedness_capacities', 'indebtedness_capacities.id', 'applications.indebtedness_capacities_id')
                ->join('simulations', 'simulations.id', 'indebtedness_capacities.simulation_id')
                ->where('simulations.id', $simulation_id)
                ->orderBy('fecha', 'desc')
                ->first();
        $habilitado = "";
        if ($info)
        {
            if ($info->estado == "En estudio" || $info->estado == "Iniciado"  || $info->estado == "Aceptada")
            {
                $fecha = new DateTime($info->fecha);
                $hoy = new DateTime();
                $fecha->add(date_interval_create_from_date_string("5 days"));
                if ($fecha > $hoy)
                {
                    $habilitado = "disabled";
                }
            }elseif ($info->estado == "Rechazada" || $info->estado == "Vencida")
            {
                $habilitado = "";
            }else{
                $fecha = new DateTime($info->fecha2);
                $hoy = new DateTime();
                $fecha->add(date_interval_create_from_date_string("1 months"));
                if ($fecha > $hoy)
                {
                    $habilitado = "disabled";
                }
            }
        }
        return view('demand/marketplace')->with('value', $demand->value)->with('max', $max)->with('min', $min)->with('simulation_id', $simulation_id)->with('habilitado', $habilitado);
        # code...
    })->name("/marketplace");


    Route::get('/editdata/{id}', 'DemandController@show')->name('editdata');
    Route::PUT('/updatedata', 'DemandController@updatedata')->name('updatedata');



    Route::get('/solicitudes/{id}', function ($id) {

        $info = DB::table('applications')
                ->select('applications.id as appId', 'applications.state as estado', 'applications.terms as plazo', 'applications.created_at as fecha', 'simulation_demands.value as valor', 'applications.value as value', 'applications.interest_rate as tasa', 'offers.name as banco', 'indebtedness_capacities.cea as capacidad', 'simulations.*', 'sectors.name as nombresector')
                ->join('indebtedness_capacities', 'indebtedness_capacities.id', 'applications.indebtedness_capacities_id')
                ->join('simulation_demands', 'simulation_demands.simulation_id', 'indebtedness_capacities.simulation_id')
                ->join('offers', 'offers.id', 'indebtedness_capacities.offers_id')
                ->join('simulations', 'simulations.id', 'simulation_demands.simulation_id')
                ->join('sectors', 'sectors.id', 'simulations.sector_id')
                ->join('demands', 'demands.id', 'simulation_demands.demand_id')
                ->where('demands.id', $id)
                ->orderBy('fecha', 'desc')
                ->get();
        //return "<pre>" . print_r($info, true) . "</pre>";
        return view('demand/homedemand')->with('info', $info);
    })->name("/solicitudes");

    Route::get('/solicitud/{id}', function ($id) {

        $info = DB::table('applications')
                ->select('applications.id as appId','applications.value as value', 'applications.state as estado', 'applications.terms as plazo', 'applications.created_at as fecha', 'simulation_demands.value as valor', 'applications.interest_rate as tasa', 'offers.name as banco', 'indebtedness_capacities.cea as capacidad', 'simulations.*', 'sectors.name as nombresector')
                ->join('indebtedness_capacities', 'indebtedness_capacities.id', 'applications.indebtedness_capacities_id')
                ->join('simulation_demands', 'simulation_demands.simulation_id', 'indebtedness_capacities.simulation_id')
                ->join('offers', 'offers.id', 'indebtedness_capacities.offers_id')
                ->join('simulations', 'simulations.id', 'simulation_demands.simulation_id')
                ->join('sectors', 'sectors.id', 'simulations.sector_id')
                ->join('demands', 'demands.id', 'simulation_demands.demand_id')
                ->where('demands.id', $id)
                ->orderBy('fecha', 'desc')
                ->first();

        if($info != null)
        {
            $max = DB::table('indebtedness_capacities')->where('simulation_id', $info->id)->max('cea');

            $solicitud_id = $info->appId;

            return view('demand/solicitud')->with('infos', $info)->with('value',$info->value)->with('max',$max)->with('solicitud_id',$solicitud_id);

        }


        //return "<pre>" . print_r($info, true) . "</pre>";
        return view('demand/solicitud')->with('infos', $info);
    })->name("/solicitud");

    ###
    Route::get('/editar_solicitud/{id}/{value}/{plazo}', function ($id,$value,$plazo) {

        $aplication = App\Application::find($id);

        $aplication->value = $value;

        $aplication->terms = $plazo;

        if ($aplication->save())
        {
            \alert()->success('Tu solicitud se ha editado con exito')->confirmButton();
        }
        else
        {
            \alert()->error('Tu solicitud NO se ha editado (Contacta con el administrador)')->confirmButton();
        }

        return redirect()->back();


    })->name("editar_solicitud");


    Route::get('/eliminar_solicitud/{id}/', function ($id) {


        $name = DB::table('demands')->where('user_id',Auth::user()->id)->first();
        $simulation =  DB::table('simulation_demands')->where('demand_id',$name->id)->first();



        $aplication = App\Application::find($id);


        if ($aplication->delete())
        {
            \alert()->success('Tu ultima solicitud se ha eliminado con exito')->confirmButton();
        }
        else
        {
            \alert()->error('Tu solicitud NO se ha eliminado (Contacta con el administrador)')->confirmButton();
        }

        return redirect()->back();


    })->name("eliminar_solicitud");
    ###

    Route::get('/financiera/{id}', function ($id) {

        $info = DB::table('simulations')
                        ->select('simulations.*', 'sectors.name')
                        ->join('sectors', 'sectors.id', 'simulations.sector_id')
                        ->join('simulation_demands', 'simulation_demands.simulation_id', 'simulations.id')
                        ->where('simulations.id', $id)->get();

        return view('demand/infofinanciera')->with('info', $info);
    })->name("/financiera");

    Route::get('/financiera/edit/{id}', function ($id) {

        $info = DB::table('simulations')
            ->select('simulations.*', 'sectors.name')
            ->join('sectors', 'sectors.id', 'simulations.sector_id')
            ->join('simulation_demands', 'simulation_demands.simulation_id', 'simulations.id')
            ->where('simulations.id', $id)->first();

        $sector = DB::table('sectors')->get();

        return view('demand/edit_infofinanciera')->with('infos', $info)->with('sector',$sector)->with('id',$id);
    })->name("get_editInfoFinanciera");

    Route::post('/financiera/edit/{id}', 'FinancialController@editInfoFinanciera')->name('post_editInfoFinanciera');

    Route::post('/application', 'DemandController@application')->name("/application");
    Route::get('/logout', 'Auth\LoginController@logout');
});
