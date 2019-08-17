<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Recinto;

class RecintosController extends Controller
{
    public function consultaDistritos($id_circunscripcion){
        $distritos = \DB::table('recintos')
        ->select('distrito')
        ->where('circunscripcion', $id_circunscripcion)
        ->distinct()
        ->orderBy('distrito', 'asc')
        ->get();
        
        return $distritos;
    }
    public function consultaRecintos($id_distrito, $id_circunscripcion){
        $recintos = \DB::table('recintos')
        ->select('id_recinto', 'nombre')
        ->where('circunscripcion', $id_circunscripcion)
        ->where('distrito', $id_distrito)
        ->orderBy('id_recinto', 'asc')
        ->get();
        return $recintos;
    }
}
