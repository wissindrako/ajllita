<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MesasController extends Controller
{
    public function form_asignar_usuario_mesa($id_persona){
        $persona = \DB::table('personas')
        ->join('recintos', 'personas.id_recinto', 'recintos.id_recinto')
        ->join('origen', 'personas.id_origen', 'origen.id_origen')
        ->leftjoin('sub_origen', 'personas.id_sub_origen', 'sub_origen.id_sub_origen')
        ->leftjoin('roles', 'personas.id_rol', 'roles.id')
        ->where('personas.id_persona', $id_persona)
        ->select('personas.*', 'recintos.id_recinto', 'recintos.nombre as nombre_recinto', 'recintos.circunscripcion', 'recintos.distrito',
                 'recintos.zona', 'recintos.direccion as direccion_recinto',
                 'origen.origen', 'sub_origen.nombre as sub_origen',
                 'roles.name as nombre_rol'
        )
        ->orderBy('fecha_registro', 'desc')
        ->orderBy('id_persona', 'desc')
        ->first();
        return view("formularios.form_asignar_usuario_mesa")
        ->with('persona', $persona);
    }
}
