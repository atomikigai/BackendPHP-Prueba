<?php

namespace App\Http\Controllers;

use App\Http\Middleware\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DataController extends Controller
{
    //
    public function show(){
        $res = DB::select("select * from invitados");
        return view('admin')->with('data', $res);
    }

    public function delete(Request $request){
        if(isset($_SESSION['rol'])){
            if($_SESSION['rol'] == "Administrador"){
                $id = $request->id;
                $res = DB::delete('delete from invitados where id = ?', [$id]);
                if($res){
                    return redirect()->route('admin');
                }
            }
        }
        return redirect()->route('admin');
    }

    public function edit(Request $req){
        //return $_SESSION['rol'];
        $id = $req->id;
        $user_edit = false;
        if($_SESSION['rol'] == "Usuario"){
            if($_SESSION['email'] == $req->email){
                $user_edit = true;
            }else{
                $user_edit = false;
            }
        }

        if(isset($_SESSION['rol'])){
            if($_SESSION['rol'] == "Administrador" or $user_edit){
                $res = DB::update('update invitados set
                email= ?, 
                nombre = ?, 
                apellido = ?, 
                direccion = ?, 
                pais = ?, 
                ciudad = ?, 
                telefono = ?, 
                password = ?
                where id = ?', [$req->email, $req->nombre, $req->apellido, 
                $req->direccion, $req->pais, $req->ciudad, $req->telefono, bcrypt($req->password), $id]);

                if($res){
                    return redirect()->route('admin');
                }
                return redirect()->route('admin');
            }
        }
        return redirect()->route('admin');
    }

    public function getdata(Request $request){
        if(!empty($request->id)){
            $id = $request->id;
            $res = DB::select("select * from invitados where id = ?", [$id]);
            if($res){
                return view('editar')->with('data', $res);
            }
        }
    }
}
