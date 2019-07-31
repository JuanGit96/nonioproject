<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Demand;
use App\SimulationDemand;
use App\Simulation;
use App\Application;
use App\RoleUser;
use App\Offer;
use DB;
use App\User;
use App\OfertUser;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id = Auth::id();
        $Role = RoleUser::where('user_id',$id)->first();
        $User = User::select('users.*')->where('id',$id)->first();
        $offer_User = OfertUser::select('offers_users.*')->where('user_id',$User->id)->first();
        if ($Role->role_id== 1) {
            # code...
            return view('admin/perfil_admin')->with('user', $User);
        }
        elseif($Role->role_id== 2){
            $Offer = Offer::select('offers.*')->where('user_id',$id)->first();
           return view('oferente/dashboard')->with('user', $User)->with('offer', $Offer);
           
        }elseif($Role->role_id== 4){
            $Offer = Offer::select('offers.*')->where('id',$offer_User->offers_id)->first();
            return view('oferente/dashboard')->with('user', $User)->with('offer', $Offer);
           
        }else{
            $demand= Demand::where('user_id',$id )->first();
            $demand2= Demand::where('user_id',$id )->count();
            if ($demand2==0) {

                # code...
                $idsimulation= Simulation::where('email_contact',$User->email)->first();
                return redirect()->route('registerdemand',['id' => $id ,'simulation_id'=> $idsimulation->id,'existe'=> 2]);
            }else {
                $simulation = SimulationDemand::where('demand_id',$demand->id)->get();
                $simulacionSinAplicar = 0;
                for ($i=0; $i < count($simulation) ; $i++) { 
                    # code...
                    $aplication= Application::join('indebtedness_capacities','indebtedness_capacities.id','applications.indebtedness_capacities_id')->where('indebtedness_capacities.simulation_id',$simulation[$i]->simulation_id)->count();
                    if ($aplication==0) {
                        # code...
                        $simulacionSinAplicar= $simulation[$i]->simulation_id;
                    }
                }
                if ($simulacionSinAplicar==0) {
                    return redirect()->route('/solicitudes',['id'=> $demand->id]);
                }else{
                    return redirect()->route('/marketplace',['simulation_id'=> $simulacionSinAplicar]);
                }
            }
        }
    }
}
