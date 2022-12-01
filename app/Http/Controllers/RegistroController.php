<?php

namespace App\Http\Controllers;

use App\Models\Invitados;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Mail\MyMail;
use Mail;
class RegistroController extends Controller

{
    //
    public function store(Request $req){

        if($req->password != $req->password_confirmation){
            return redirect()->route('registro', ['email'=>$req->email, 
            'nombre'=>$req->nombre, 'apellido'=>$req->apellido, 'password'=>true]);
        }

        $exist = DB::select('select email from invitados where email = ?', [$req->email]);
        $res = "";
        $email = $req->email;
        
        $titleUser = "Registro exitoso";
        $bodyUser = 'Su cuenta ha sido registrada con exito';
        $titleAdmin = "Usuario Nuevo";
        $bodyAdmin = 'Se ha registrado un usuario con el correo: ' . $email;

        $mailDataUser = [
            'title' => $titleUser,
            'body' => $bodyUser,
        ];

        $mailDataAdmin = [
            'title' => $titleAdmin,
            'body' => $bodyAdmin,
        ];

        if($exist){
            $titleUser = "Datos actualizados";
            $bodyUser = 'Se han actualizados los datos del correo: ' . $email;

            $titleAdmin = "Datos Actualizados";
            $bodyAdmin = 'El usuario con correo: ' . $email . ' actualizo sus datos';

            $mailDataUser = [
                'title' => $titleUser,
                'body' => $bodyUser,
            ];
            
            $mailDataAdmin = [
                'title' => $titleAdmin,
                'body' => $bodyAdmin,
            ];

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
            $req->direccion, $req->pais, $req->ciudad, $req->telefono, bcrypt($req->password), $req->email]);
            
        }else{
            $isinvited = DB::select("select email from lista where email = ?", [$email]);
            if($isinvited){
                $res = DB::insert('insert into invitados (email, nombre, apellido, direccion, pais, ciudad, telefono, password) 
                values (?, ?, ?, ?, ?, ?, ?, ?)', [$req->email, $req->nombre, $req->apellido, 
                $req->direccion, $req->pais, $req->ciudad, $req->telefono, bcrypt($req->password)]);
            }else{
                return redirect()->route('registro', ['noexist'=>true]);
            }
        }

        if($res){
            Mail::to($email)->send(new MyMail($mailDataUser));
            Mail::to('jostick516@gmail.com')->send(new MyMail($mailDataAdmin));
            session_start();
            $_SESSION["email"] = $email;
            return redirect()->route('invitacion');
        }
    }
}
