<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Admin
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
        session_start();
        if(isset($_SESSION["email"])){
            $email = $_SESSION["email"];
            $res = DB::select("select role from admins where email = ?", [$email]);
            $rol = "";
            if($res){
                foreach($res as $val){
                    $rol = $val->role;
                }
                $_SESSION['rol'] = $rol;
                return $next($request);
            }else{
                $_SESSION['rol'] = 'Usuario';
                return $next($request);

            }
        }else{
            return redirect('/');
        }
    }
}
