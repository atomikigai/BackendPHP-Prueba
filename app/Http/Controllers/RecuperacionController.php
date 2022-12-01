<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Middleware\Recuperacion;

class RecuperacionController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware(Recuperacion::class);
    }

    public function check(){

    }
}
