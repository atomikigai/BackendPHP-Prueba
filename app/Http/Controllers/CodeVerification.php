<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CodeVerification extends Controller
{
    //

    public function verification(Request $req){
        $code = $req->get('code');
        $email = $req->get('email');
        $nombre = $req->get('nombre');
        $apellido = $req->get('apellido');
        $isinvited = $req->get('invited');
        $codeInput = "";

        $data = $this->validate(request(),[
            'value1' => 'required',
            'value2' => 'required',
            'value3' => 'required',
            'value4' => 'required',
            'value5' => 'required',
        ]);

        foreach($data as $val){
            $codeInput .= $val;
        }

        if (!empty($code)){
            if($code == $codeInput){
                return redirect()->route('registro', ['email'=>$email]);
            }else{
                return view('codigo', ['error'=>'El codigo no es correcto, intente de nuevo.',
                'email'=>$email,
                'codigo'=>$code,
                'isinvited'=>$isinvited,
            ]);
            }
        }

        return $code;
    }
}
