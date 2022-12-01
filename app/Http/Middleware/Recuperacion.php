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
            $res = DB::select('select nombre, apellido from invitados where email = ?', [$email]);
            $nombre = "";
            $apellido = "";
            
            foreach($res as $val){
                $nombre = $val->nombre;
                $apellido = $val->apellido;
            }

            if($res){
                return response()->view('registro', ['email'=>$email,'nombre'=>$nombre, 'apellido'=>$apellido]);
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
