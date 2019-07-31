<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Demand;
use App\Simulation;
use App\SimulationDemand;
use App\RoleUser;
use App\Offer;
use Illuminate\Support\Facades\Hash;
use Auth;

class UserController extends Controller {

    public function index()
    {
        $id = Auth::id();
        $User = User::select('users.*')->where('id', $id)->first();
        $Role = RoleUser::where('user_id', $id)->first();

        // Si es administrador
        if ($Role->role_id == 1)
        {
            # code...
            return view('admin/perfil_admin')->with('user', $User);
        }
        // Si es un banco
        else if ($Role->role_id == 2)
        {
            # code...
            $Offer = Offer::select('offers.*')->where('user_id', $id)->first();
            return view('oferente/dashboard')->with('user', $User)->with('offer', $Offer);
        }
        else if ($Role->role_id == 4)
        {

            $Offer = Offer::select('offers.*')->join('offers_users', 'offers_users.offers_id', '=', 'offers.id')->where('offers_users.user_id', $id)->first();

            // dd($Offer);
            return view('oferente/dashboard')->with('user', $User)->with('offer', $Offer);
        }
        else
        {
            # code...
            $Demand = Demand::select('demands.*')->where('user_id', $id)->first();
            $Cant = SimulationDemand::where('demand_id', $Demand->id)->count();
            return view('demand/perfil')->with('User', $User)->with('Demand', $Demand)->with('Cant', $Cant);
        }
    }

    public function resetpass(Request $request)
    {
        $cadena = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";
        $longitudCadena = strlen($cadena);
        $pass = "";
        $longitudPass = 8;
        for ($i = 1; $i <= $longitudPass; $i++)
        {
            $pos = rand(0, $longitudCadena - 1);
            $pass .= substr($cadena, $pos, 1);
        }
        $user = User::where('email', $request->get('email'))->first();

        if ($user != null)
        {
            $user->password = bcrypt($pass);
            if ($user->save())
            {
                \Mail::send('emails.emailReset', ['pass' => $pass, 'user' => $user->email], function ($prov) use ($user) {
                    $prov->to($user->email)->subject('Restablecimiento de  Contraseña');
                });
                $msg = 1;
                return view('auth/passwords/email')->with('msg', $msg);
            }
            else
            {
                $msg = 2;
                return view('auth/passwords/email')->with('msg', $msg);
            }
        }
        else
        {
            $msg = 2;
            return view('auth/passwords/email')->with('msg', $msg);
        }


    }

    public function changepassword(Request $request)
    {

        $id = Auth::id();
        $actual = $request->get('actualpass');
        $user = User::find($id);
        if (Hash::check($actual, $user->password))
        {
            if ($request->get('confirmpass') == $request->get('newpass'))
            {
                $user->password = bcrypt($request->get('confirmpass'));
                if ($user->save())
                {
                    return response()->json([
                                'status' => true,
                                'mensaje' => 'Se ha actualizado la contraseña',
                    ]);
                }
                else
                {
                    return response()->json([
                                'status' => false,
                                'mensaje' => 'No se pudo',
                    ]);
                }
            }
            else
            {
                return response()->json([
                            'status' => true,
                            'mensaje' => 'noigual',
                ]);
            }
        }
        else
        {
            return response()->json([
                        'status' => true,
                        'mensaje' => 'noactual',
            ]);
        }
    }

    public function createUser($id)
    {
        $email = Simulation::where('id', $id)->first();

        $cadena = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";
        $longitudCadena = strlen($cadena);
        $pass = "";
        $longitudPass = 8;
        for ($i = 1; $i <= $longitudPass; $i++)
        {
            $pos = rand(0, $longitudCadena - 1);
            $pass .= substr($cadena, $pos, 1);
        }
        $user = User::where("email", "=", $email->email_contact)->first();
        if ($user){
            return redirect()->route('registerdemand', ['id' => $user->id, 'simulation_id' => $id]);
        }
        else
        {
            $user = new User();
            $user->email = $email->email_contact;
            $user->password = bcrypt($pass);
            if ($user->save())
            {
                $RoleUser = new RoleUser();
                $RoleUser->role_id = 3;
                $RoleUser->user_id = $user->id;
                $RoleUser->save();
                // Si el usuario es creado, se envia un correo electronico con la clave del nuevo usuario.
                echo "<pre>" . print_r($pass, true) . "</pre>";
                \Mail::send('emails.emailRegisterUser', ['pass' => $pass, 'user' => $user->email], function ($prov) use ($user) {
                    $prov->to($user->email, $user->name)->subject('Bienvenido a Nonio');
                });

                return redirect()->route('registerdemand', ['id' => $user->id, 'simulation_id' => $id]);
            }
            else
            {
                return response()->json([
                            'status' => false,
                            'mensaje' => 'No se pudo guardar el usuario',
                ]);
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function validateNombre(Request $request)
    {
        $demandnit = Demand::where('nit', $request->get('nit'))->count();
        $demandname = Demand::where('name_company', $request->get('name_company'))->count();

        if ($demandname >= 1 && $demandnit >= 1)
        {
            return response()->json([
                        'status' => false,
                        'mensaje' => 'namesinitsi',
            ]);
        }
        else if ($demandname >= 1)
        {
            return response()->json([
                        'status' => false,
                        'mensaje' => 'siname',
            ]);
        }
        else if ($demandnit >= 1)
        {
            return response()->json([
                        'status' => false,
                        'mensaje' => 'nitsi',
            ]);
        }
        else
        {
            return response()->json([
                        'status' => true,
                        'mensaje' => 'no',
            ]);
        }
    }

}
