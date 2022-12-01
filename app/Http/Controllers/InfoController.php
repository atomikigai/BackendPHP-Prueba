<?php

namespace App\Http\Controllers;
use App\Mail\MyMail;
use Mail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
// use Illuminate\Support\Facades\Mail;
// use Illuminate\Http\JsonResponse;



class InfoController extends Controller
{
    //
    public function info(Request $req){
        $email = $req->get('email');
        $password = $req->get('password');
        $isregistred = false;
        $isinvited = false;

        if (!empty($email)){
            $res = DB::select('select email from invitados where email = ?', [$email]);    
            if (empty($res)){
                $isregistred = false;
            }else{
                $isregistred = true;
            }

            if ($isregistred){
                return view('invitacion', ["email"=>$email, "isregistered"=>true]);
            }else{
                $res = DB::select('select email, nombre, apellido from lista where email = ?', [$email]);    
                if (empty($res)){
                    $isinvited = false;
                    return view('invitacion', ["error"=>true]);;
                }else{
                    $isinvited = true;
                    $code = $this->generateCode();
                    
                    $nombre = "";
                    $apellido = "";
                    foreach($res as $val){
                        $nombre = $val->nombre;
                        $apellido = $val->apellido;
                    }

                    session_start();
                    $_SESSION["code"] = $code;

                    $body = 'Utilice este codigo para comprobar su correo electronico: ' . $code;
                    $mailData = [
                        'title' => 'Codigo verificación',
                        'body' => $body,
                    ];
                    Mail::to($email)->send(new MyMail($mailData));
                    return view('codigo', ["email"=>$email, 'nombre'=>$nombre, 'apellido'=>$apellido,"isinvited"=>true, "codigo"=>$code]);
                }
            }
        }
        
        if(empty($email) || empty($password)){
            return view('invitacion', ["emptyvalues"=>true]);
        }else{
            return view('login');
        }
    }

    function generateCode(){
        $number = array();
        $final = "";
        for ($i = 0; $i < 5; $i++){
            $number[] = strval(rand(0,9));
        }

        for ($i = 0; $i < 5; $i++){
            $final = $final . $number[$i];
        }

        return $final;
    }
}
