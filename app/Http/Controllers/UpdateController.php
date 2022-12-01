<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UpdateController extends Controller
{
    //
    public function updatedata(Request $req){
        if(isset($_SESSION['rol'])){
            if($_SESSION['rol'] == "Administrador"){
                $id = $req->id;
                $res = DB::update('update invitados set
                email= ?, 
                nombre = ?, 
                apellido = ?, 
                direccion = ?, 
                pais = ?, 
                ciudad = ?, 
                telefono = ?, 
                password = ?
                where email = ?', [$req->email, $req->nombre, $req->apellido, 
                $req->direccion, $req->pais, $req->ciudad, $req->telefono, bcrypt($req->password), $id]);

                if($res){
                    return redirect()->route('admin');
                }
                return redirect()->route('admin');
            }
        }
        //$res = DB::update();
        return redirect()->route('admin');
    }

}
