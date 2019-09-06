<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GraficosController extends Controller
{
    public function votacion_general(){
        $votos_presidenciales_r = \DB::table('mesas')
        ->join('recintos', 'mesas.id_recinto', 'recintos.id_recinto')
        ->join('votos_presidenciales_r', 'mesas.id_mesa', 'votos_presidenciales_r.id_mesa')
        ->select('mesas.id_mesa',
        \DB::raw('SUM(nulos) as nulos'),
        \DB::raw('SUM(blancos) as blancos')
        )
        ->first();

        return view("graficos.votacion_general")
        ->with('votos_presidenciales_r', $votos_presidenciales_r);
    }

    public function votacion_general_uninominales(){
        $circ_1 = \DB::table('mesas')
        ->join('recintos', 'mesas.id_recinto', 'recintos.id_recinto')
        ->join('votos_uninominales_r', 'mesas.id_mesa', 'votos_uninominales_r.id_mesa')
        ->select('mesas.id_mesa',
        \DB::raw('SUM(nulos) as nulos'),
        \DB::raw('SUM(blancos) as blancos')
        )
        ->first();
        
        $circ_2 = \DB::table('mesas')
        ->join('recintos', 'mesas.id_recinto', 'recintos.id_recinto')
        ->join('votos_uninominales_r', 'mesas.id_mesa', 'votos_uninominales_r.id_mesa')
        ->select('mesas.id_mesa',
        \DB::raw('SUM(nulos) as nulos'),
        \DB::raw('SUM(blancos) as blancos')
        )
        ->first();
        
        $circ_3 = \DB::table('mesas')
        ->join('recintos', 'mesas.id_recinto', 'recintos.id_recinto')
        ->join('votos_uninominales_r', 'mesas.id_mesa', 'votos_uninominales_r.id_mesa')
        ->select('mesas.id_mesa',
        \DB::raw('SUM(nulos) as nulos'),
        \DB::raw('SUM(blancos) as blancos')
        )
        ->first();
        
        $circ_4 = \DB::table('mesas')
        ->join('recintos', 'mesas.id_recinto', 'recintos.id_recinto')
        ->join('votos_uninominales_r', 'mesas.id_mesa', 'votos_uninominales_r.id_mesa')
        ->select('mesas.id_mesa',
        \DB::raw('SUM(nulos) as nulos'),
        \DB::raw('SUM(blancos) as blancos')
        )
        ->first();

        return view("graficos.votacion_general_uninominales")
        ->with('circ_1', $circ_1)
        ->with('circ_2', $circ_2)
        ->with('circ_3', $circ_3)
        ->with('circ_4', $circ_4);
    }

    public function presidenciales(){
        $votos_presidenciales = \DB::table('mesas')
        ->join('recintos', 'mesas.id_recinto', 'recintos.id_recinto')
        ->join('votos_presidenciales', 'mesas.id_mesa', 'votos_presidenciales.id_mesa')
        ->join('partidos', 'votos_presidenciales.id_partido', 'partidos.id_partido')
        ->select('votos_presidenciales.id_partido', 'partidos.sigla', 'partidos.fill', 'partidos.borderColor',
        \DB::raw('SUM(validos) as validos')
        )
        ->groupBy('votos_presidenciales.id_partido')
        ->get();
        return response()->json($votos_presidenciales);
    }

    public function uninominales_c10(){
        $votos_uninominales = \DB::table('mesas')
        ->join('recintos', 'mesas.id_recinto', 'recintos.id_recinto')
        ->join('votos_uninominales', 'mesas.id_mesa', 'votos_uninominales.id_mesa')
        ->join('partidos', 'votos_uninominales.id_partido', 'partidos.id_partido')
        ->select('votos_uninominales.id_partido', 'partidos.sigla', 'partidos.fill', 'partidos.borderColor',
        \DB::raw('SUM(validos) as validos')
        )
        ->where('recintos.circunscripcion', 11)
        ->groupBy('votos_uninominales.id_partido')
        ->get();
        return response()->json($votos_uninominales);
    }

    public function uninominales_c11(){
        $votos_uninominales = \DB::table('mesas')
        ->join('recintos', 'mesas.id_recinto', 'recintos.id_recinto')
        ->join('votos_uninominales', 'mesas.id_mesa', 'votos_uninominales.id_mesa')
        ->join('partidos', 'votos_uninominales.id_partido', 'partidos.id_partido')
        ->select('votos_uninominales.id_partido', 'partidos.sigla', 'partidos.fill', 'partidos.borderColor',
        \DB::raw('SUM(validos) as validos')
        )
        ->where('recintos.circunscripcion', 12)
        ->groupBy('votos_uninominales.id_partido')
        ->get();
        return response()->json($votos_uninominales);
    }

    public function uninominales_c12(){
        $votos_uninominales = \DB::table('mesas')
        ->join('recintos', 'mesas.id_recinto', 'recintos.id_recinto')
        ->join('votos_uninominales', 'mesas.id_mesa', 'votos_uninominales.id_mesa')
        ->join('partidos', 'votos_uninominales.id_partido', 'partidos.id_partido')
        ->select('votos_uninominales.id_partido', 'partidos.sigla', 'partidos.fill', 'partidos.borderColor',
        \DB::raw('SUM(validos) as validos')
        )
        ->where('recintos.circunscripcion', 13)
        ->groupBy('votos_uninominales.id_partido')
        ->get();
        return response()->json($votos_uninominales);
    }

    public function uninominales_c13(){
        $votos_uninominales = \DB::table('mesas')
        ->join('recintos', 'mesas.id_recinto', 'recintos.id_recinto')
        ->join('votos_uninominales', 'mesas.id_mesa', 'votos_uninominales.id_mesa')
        ->join('partidos', 'votos_uninominales.id_partido', 'partidos.id_partido')
        ->select('votos_uninominales.id_partido', 'partidos.sigla', 'partidos.fill', 'partidos.borderColor',
        \DB::raw('SUM(validos) as validos')
        )
        ->where('recintos.circunscripcion', 14)
        ->groupBy('votos_uninominales.id_partido')
        ->get();
        return response()->json($votos_uninominales);
    }

}
