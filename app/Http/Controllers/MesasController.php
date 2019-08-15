<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MesasController extends Controller
{
    public function form_asignar_usuario_mesa(){
        return view("formularios.form_asignar_usuario_mesa");
    }
}
