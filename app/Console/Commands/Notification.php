<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Mail;
use DateTime;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use App\Application;

class Notification extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notification';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {

        $now = new DateTime();
        $fecha =  $now->format("Y-m-d");
        $fecha2 = DB::table('applications')->get();

        for ($i = 0; $i < count($fecha2); $i++) {
            $fecha3 =  $fecha2[$i]->created_at;
            $fecha4 = (new Carbon($fecha3))->format('Y-m-d');
            $nuevafecha = strtotime ( '+4 day' , strtotime ( $fecha4 ) ) ;
            $nuevafecha = date ( 'Y-m-j' , $nuevafecha );
            $nuevafecha2 = strtotime ( '+5 day' , strtotime ( $fecha4 ) ) ;
            $nuevafecha2 = date ( 'Y-m-j' , $nuevafecha2 );
            if($fecha == $nuevafecha){

                foreach ($fecha2 as $complaint){
                    $user = DB::table('indebtedness_capacities')->where('id' ,$complaint->indebtedness_capacities_id)->get();
                    foreach ($user as $user) {
                    $client = DB::table('offers')->where('id',$user->offers_id)->get();
                    $simulation = DB::table('simulations')->where('id',$user->simulation_id)->get();

                    foreach ($client as $client) {

                         $usuarios = DB::table('users')->where('id',$client->user_id)->get();
                         foreach ($usuarios as $usuarios) {
                        Mail::send('emails.notification', ['usuarios' => $usuarios,'simulation'=> $simulation], function ($message) use ($usuarios) {
                            $message->from('lina.pinilla@grimorum.com', 'Notificación')->subject('una solicitud vencida');
                            $message->to($usuarios->email)->subject('Notificación');
                        });
                    }
                    }

                }
              }
            }elseif($fecha == $nuevafecha2){
                foreach ($fecha2 as $complaint) {

                    $applications = Application::find($complaint->id);
                    $applications->state = "Vencida";
                    $applications->save();

                    $user = DB::table('indebtedness_capacities')->where('id' ,$complaint->indebtedness_capacities_id)->get();
                    foreach ($user as $user) {
                    $client = DB::table('offers')->where('id',$user->offers_id)->get();
                    $simulation = DB::table('simulations')->where('id',$user->simulation_id)->get();


                    foreach ($client as $client) {
                        foreach ($simulation as $simulation) {

                            Mail::send('emails.notificacionvencida', ['simulation'=> $simulation], function ($message) use ($simulation) {
                            $message->from('lina.pinilla@grimorum.com', 'Notificación')->subject('La solicitude ha caducado');
                            $message->to($simulation->email_contact)->subject('Notificación');
                        });

                         $usuarios = DB::table('users')->where('id',$client->user_id)->get();
                         foreach ($usuarios as $usuarios) {
                        Mail::send('emails.notificationvencidabanco', ['usuarios' => $usuarios,'simulation'=> $simulation], function ($message) use ($usuarios) {
                            $message->from('lina.pinilla@grimorum.com', 'Notificación')->subject('solicitud vencida');
                            $message->to($usuarios->email)->subject('Notificación');
                        });
                        }
                    }
                    }

                }

        }
    }
    }
    }
}
