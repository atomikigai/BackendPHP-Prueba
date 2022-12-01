<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Mail\MyMail;
use Mail;
class enviarInvitacion extends Controller
{
    //

    public function invitacion(Request $req){
        if($_SESSION['rol'] == "Administrador"){
            if(!empty($req->email) && !empty($req->nombre) && !empty($req->apellido)){
                $email = $req->email;
                $nombre = $req->nombre;
                $apellido = $req->apellido;
                $res = DB::select("select email from lista where email = ?", [$email]);
                if(!$res){
                    $store = DB::insert("insert into lista (email, nombre, apellido) values (?,?,?)",
                     [$email, $nombre, $apellido]);
    
                     if($store){
                        $mailDataUser = [
                            'title' => 'Invitacion',
                            'body' => 'Tienes una invitacion para 
                            registrate en http://127.0.0.1:8000/registro?email='.$email,
                        ];
                        Mail::to($email)->send(new MyMail($mailDataUser));
                        return redirect()->route('enviar', ["success"=>"Invitación enviada con exito"]);
                     }
                }else{
                    return redirect()->route('enviar', ["warning"=>"Este correo esta en la lista de invitados"]);
                }
            }
        }
        return redirect()->route('enviar', ["message"=>"No tienes permisos para enviar una invitación"]);
    }
}
