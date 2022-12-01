<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class login extends Controller
{
    //
    public function login(Request $request){
        $email = $request->input('email');
        $password = $request->input('password');
        $user_password = "";        
        $res = DB::select('select nombre, apellido, password from invitados where email = ?', [$email]);
        $role = DB::select('select role from admins where email = ?', [$email]);
        $role_res = "";

        if($email == "" || $password == ""){
            return redirect()->route('invitacion', ["emptyvalues"=>true, "isregistered"=>true]);
        }
        
        foreach($res as $val){
            $user_password = $val->password;
        }

        foreach($role as $val){
            $role_res = $val->role;
        }

        $password_result = password_verify($password, $user_password);
        if($password_result){
            if($res){
                if($password_result){
                    return redirect()->route('registro', ["email"=>$email]);
                }

                if($role_res == "Administrador"){
                    return redirect()->route('admin', ["email"=>$email, "role"=>"Administrador"]);
                }
            }else{
                return redirect()->route('invitacion');
            }
        }else{
            if($res){
                return redirect()->route('invitacion', ["passwordError"=>"Contraseña incorrecta", "isregistered"=>true]);
            }else{
                return redirect()->route('invitacion', ["error"=>true, "isregistered"=>false]);
            }
        }
    }
}
