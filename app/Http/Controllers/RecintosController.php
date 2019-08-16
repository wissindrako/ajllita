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
        ->get();
        
        return $distritos;
    }
    public function consultaRecintos($id_distrito){
        $recintos = \DB::table('recintos')
        ->select('id_recinto', 'nombre')
        ->where('distrito', $id_distrito)
        ->get();

        return $recintos;
    }
}
