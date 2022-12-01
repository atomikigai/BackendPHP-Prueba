<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class Recuperacion
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {

        if ($request->input('email')){
            $email = $request->input('email');
            $password = $request->input('password');
            $res = DB::select('select nombre, apellido, password from invitados where email = ?', [$email]);
            $nombre = "";
            $apellido = "";
            $user_password = "";

            foreach($res as $val){
                $nombre = $val->nombre;
                $apellido = $val->apellido;
                $user_password = $val->password;
            }

            $password_result = password_verify($password, $user_password);
            if($res){
                if($password_result){
                    return response()->view('registro', ['email'=>$email,'nombre'=>$nombre, 'apellido'=>$apellido]);                    
                }else{
                    return redirect()->route('recuperacion', ["error"=>"Contraseña incorrecta"]);
                }
            }else{
                $res = DB::select("select email from lista where email = ?", [$email]);
                if($res){
                    return redirect()->route('recuperacion', ["error"=>"Esta cuenta esta invitada
                     pero es necesario registrarla", "invited"=>true]);
                }else{
                    return redirect()->route('recuperacion', ["error"=>"Este correo no 
                    esta invitado o registrado en el sistema"]);
                }
            }
        }else{
            return redirect('/');
        }

    }
}
