<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PersonasController extends Controller
{
    public function form_agregar_persona(){
        //carga el formulario para agregar un nueva persona
    
        return view("formularios.form_agregar_persona");
    }
}
