<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Registro
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     */
    public function handle(Request $request, Closure $next)
    {  
        if ($request->input('email')){
            $email = $request->input('email');
            $res = DB::select('select nombre, apellido from lista where email = ?', [$email]);
            $check_register = DB::select("select email from invitados where email = ?", [$email]);
            $nombre = "";
            $apellido = "";
            
            foreach($res as $val){
                $nombre = $val->nombre;
                $apellido = $val->apellido;
            }

            if($res){
                return response()->view('registro', ['email'=>$email,'nombre'=>$nombre, 'apellido'=>$apellido]);
            }else{
                if($check_register){
                    return redirect()->route('recuperacion', ["error"=>"Esta cuenta esta registrada
                     puedes recuperar tu contraseña desde este panel"]);
                }
            }

            if(!$res && !$check_register){
                return redirect()->route('recuperacion', ["error"=>"Este correo no 
                    esta invitado o registrado en el sistema"]);
            }

        }else{
            return redirect('/');
        }

        session_start();
        if(isset($_SESSION["code"])){
            if ($request->input('code') !== $_SESSION["code"]) {
                return redirect('/');
            }
        }else{
            return redirect('/');
        } 
        /* return $next($request); */
    }
}
