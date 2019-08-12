<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use DateTime;

use App\User;
use App\Gestion;
use App\Usada;

class PruebasController extends Controller
{
    //
    public function form_pruebas(){

        return view('formularios.form_pruebas');

    }
}
