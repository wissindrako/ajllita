<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mesa;
use App\Recinto;

class GraficosController extends Controller
{

    public function form_resumen_global_por_distrito(){
        $mesas = Mesa::all();
        $total_votos = $mesas->sum('numero_votantes');

        $votos_validos = \DB::table('mesas')
        ->join('recintos', 'mesas.id_recinto', 'recintos.id_recinto')
        ->join('votos_presidenciales', 'mesas.id_mesa', 'votos_presidenciales.id_mesa')
        ->join('partidos', 'votos_presidenciales.id_partido', 'partidos.id_partido')
        ->select(
        'recintos.distrito',
        \DB::raw('SUM(validos) as validos'),
        \DB::raw('SUM(numero_mesas) as numero_mesas')
        )
        ->groupBy('recintos.distrito')
        ->orderby('recintos.distrito')
        ->get();

        $alcaldia = array();

        foreach ($votos_validos as $key => $value) {
            $e = array();
            $e["distrito"] = $value->distrito;

            $recintos = \DB::table('recintos')->where('distrito', $value->distrito)->count();
            $mesas = \DB::table('recintos')->where('distrito', $value->distrito)->sum('numero_mesas');
            
            $e["validos"] = $value->validos;
            $e["Cantidad recintos"] = $recintos;
            $e["Cantidad mesas"] = $mesas;
            // 
            // $e["borderColor"] = $value->borderColor;
            // $e["valor"] = round(($value->validos*100)/$total_votos, 2);
            // $e["blancos"] = (int) $value->blancos;
            // $e["nulos"] = (int) $value->nulos;
            array_push($alcaldia, $e);
        }

        $votos_presidenciales_r = \DB::table('mesas')
        ->join('recintos', 'mesas.id_recinto', 'recintos.id_recinto')
        ->join('votos_presidenciales_r', 'mesas.id_mesa', 'votos_presidenciales_r.id_mesa')
        ->select('mesas.id_mesa',
        \DB::raw('SUM(nulos) as nulos'),
        \DB::raw('SUM(blancos) as blancos')
        )
        ->first();

        dd($alcaldia);

        return view("graficos.form_resumen_global_por_distrito")
        ->with('votos_validos', $votos_validos)
        ->with('votos_presidenciales_r', $votos_presidenciales_r)
        ->with('total_votos', $total_votos);
    }

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

    public function porcentaje_votacion_general(){
        $mesas = Mesa::all();
        $total_votos = $mesas->sum('numero_votantes');

        $votos_validos = \DB::table('mesas')
        ->join('recintos', 'mesas.id_recinto', 'recintos.id_recinto')
        ->join('votos_presidenciales', 'mesas.id_mesa', 'votos_presidenciales.id_mesa')
        ->join('partidos', 'votos_presidenciales.id_partido', 'partidos.id_partido')
        ->select(
        \DB::raw('SUM(validos) as validos')
        )
        ->first();

        return view("graficos.porcentaje_votacion_general")
        ->with('votos_validos', $votos_validos)
        ->with('total_votos', $total_votos);
    }

    public function votacion_general_uninominales(){
        $distritos = Recinto::orderBy('distrito')->distinct()->pluck('distrito');

        return view("graficos.votacion_general_uninominales")
        ->with('distritos', $distritos);
    }

    public function votacion_general_presidenciales(){
        $distritos = Recinto::orderBy('distrito')->distinct()->pluck('distrito');

        return view("graficos.votacion_general_presidenciales")
        ->with('distritos', $distritos);
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
        ->orderby('partidos.nivel')
        ->get();
        return response()->json($votos_presidenciales);
    }

    public function porcentaje_presidenciales(){

        $mesas = Mesa::all();
        $total_votos = $mesas->sum('numero_votantes');

        $votos_presidenciales = \DB::table('mesas')
        ->join('recintos', 'mesas.id_recinto', 'recintos.id_recinto')
        ->join('votos_presidenciales', 'mesas.id_mesa', 'votos_presidenciales.id_mesa')
        ->join('partidos', 'votos_presidenciales.id_partido', 'partidos.id_partido')
        ->select(
            'votos_presidenciales.id_partido', 'partidos.sigla', 'partidos.fill', 'partidos.borderColor',
        \DB::raw('SUM(validos) as validos')
        )
        ->groupBy('votos_presidenciales.id_partido')
        ->orderby('partidos.nivel')
        ->get();


        $votos_presidenciales_r = \DB::table('mesas')
        ->join('recintos', 'mesas.id_recinto', 'recintos.id_recinto')
        ->join('votos_presidenciales_r', 'mesas.id_mesa', 'votos_presidenciales_r.id_mesa')
        ->select('mesas.id_mesa',
        \DB::raw('SUM(nulos) as nulos'),
        \DB::raw('SUM(blancos) as blancos')
        )
        ->first();

        $suma_votos = $votos_presidenciales->sum('validos') + $votos_presidenciales_r->blancos + $votos_presidenciales_r->nulos;

        $alcaldia = array();

        foreach ($votos_presidenciales as $key => $value) {
            $e = array();
            $e["id_partido"] = $value->id_partido;
            $e["sigla"] = $value->sigla;
            $e["fill"] = $value->fill;
            $e["borderColor"] = $value->borderColor;
            $e["valor"] = $value->validos;
            $e["porcentaje"] = round(($value->validos*100)/$suma_votos, 2);

            array_push($alcaldia, $e);
        }

        if($votos_presidenciales_r->blancos != null){
            $e = array();
            $e["id_partido"] = count($votos_presidenciales) + 1;
            $e["sigla"] = 'Blanco';
            $e["fill"] = '#fff';
            $e["borderColor"] = '#000';
            $e["valor"] = $votos_presidenciales_r->blancos;
            if ($suma_votos == 0) {
                $e["porcentaje"] = 0;
            } else {
                $e["porcentaje"] = round(($votos_presidenciales_r->blancos*100)/$suma_votos, 2);
            }

            array_push($alcaldia, $e);
        }
            
        if($votos_presidenciales_r->nulos != null){
            $e = array();
            $e["id_partido"] = count($votos_presidenciales) + 2;
            $e["sigla"] = 'Nulo';
            $e["fill"] = '#898a8a';
            $e["borderColor"] = '#f90101';
            $e["valor"] = $votos_presidenciales_r->nulos;
            if ($suma_votos == 0) {
                $e["porcentaje"] = 0;
            } else {
                $e["porcentaje"] = round(($votos_presidenciales_r->nulos*100)/$suma_votos, 2);
            }

            array_push($alcaldia, $e);
        }  

        return response()->json($alcaldia);
    }

    public function presidenciales_por_distrito($distrito){
        $votos_presidenciales = \DB::table('mesas')
        ->join('recintos', 'mesas.id_recinto', 'recintos.id_recinto')
        ->join('votos_presidenciales', 'mesas.id_mesa', 'votos_presidenciales.id_mesa')
        ->join('partidos', 'votos_presidenciales.id_partido', 'partidos.id_partido')
        ->select('votos_presidenciales.id_partido', 'partidos.sigla', 'partidos.fill', 'partidos.borderColor',
        \DB::raw('SUM(validos) as validos')
        )
        ->where('recintos.distrito', $distrito)
        ->groupBy('votos_presidenciales.id_partido')
        ->orderby('partidos.nivel')
        ->get();

        $votos_presidenciales_r = \DB::table('mesas')
        ->join('recintos', 'mesas.id_recinto', 'recintos.id_recinto')
        ->join('votos_presidenciales_r', 'mesas.id_mesa', 'votos_presidenciales_r.id_mesa')
        ->select('mesas.id_mesa',
        \DB::raw('SUM(nulos) as nulos'),
        \DB::raw('SUM(blancos) as blancos')
        )
        ->where('recintos.distrito', $distrito)
        ->first();

        $suma_votos = $votos_presidenciales->sum('validos') + $votos_presidenciales_r->nulos + $votos_presidenciales_r->blancos;

        $presidenciales = array();

        foreach ($votos_presidenciales as $key => $value) {
            $e = array();
            $e["id_partido"] = $value->id_partido;
            $e["sigla"] = $value->sigla;
            $e["fill"] = $value->fill;
            $e["borderColor"] = $value->borderColor;
            $e["valor"] = $value->validos;
            if ($suma_votos == 0) {
                $e["porcentaje"] = 0;
            } else {
                $e["porcentaje"] = round(($value->validos*100)/$suma_votos, 2);
            }
            array_push($presidenciales, $e);
        }

        if($votos_presidenciales_r->blancos != null){
            $e = array();
            $e["id_partido"] = count($votos_presidenciales) + 1;
            $e["sigla"] = 'Blanco';
            $e["fill"] = '#fff';
            $e["borderColor"] = '#000';
            $e["valor"] = $votos_presidenciales_r->blancos;
            if ($suma_votos == 0) {
                $e["porcentaje"] = 0;
            } else {
                $e["porcentaje"] = round(($votos_presidenciales_r->blancos*100)/$suma_votos, 2);
            }

            array_push($presidenciales, $e);
        }
            
        if($votos_presidenciales_r->nulos != null){
            $e = array();
            $e["id_partido"] = count($votos_presidenciales) + 2;
            $e["sigla"] = 'Nulo';
            $e["fill"] = '#898a8a';
            $e["borderColor"] = '#f90101';
            $e["valor"] = $votos_presidenciales_r->nulos;
            if ($suma_votos == 0) {
                $e["porcentaje"] = 0;
            } else {
                $e["porcentaje"] = round(($votos_presidenciales_r->nulos*100)/$suma_votos, 2);
            }

            array_push($presidenciales, $e);
        }

        return response()->json($presidenciales);
    }

    public function uninominales_por_distrito($distrito){
        $votos_uninominales = \DB::table('mesas')
        ->join('recintos', 'mesas.id_recinto', 'recintos.id_recinto')
        ->join('votos_uninominales', 'mesas.id_mesa', 'votos_uninominales.id_mesa')
        ->join('partidos', 'votos_uninominales.id_partido', 'partidos.id_partido')
        ->select('votos_uninominales.id_partido', 'partidos.sigla', 'partidos.fill', 'partidos.borderColor',
        \DB::raw('SUM(validos) as validos')
        )
        ->where('recintos.distrito', $distrito)
        ->groupBy('votos_uninominales.id_partido')
        ->orderby('partidos.nivel')
        ->get();

        $votos_uninominales_r = \DB::table('mesas')
        ->join('recintos', 'mesas.id_recinto', 'recintos.id_recinto')
        ->join('votos_uninominales_r', 'mesas.id_mesa', 'votos_uninominales_r.id_mesa')
        ->select('mesas.id_mesa',
        \DB::raw('SUM(nulos) as nulos'),
        \DB::raw('SUM(blancos) as blancos')
        )
        ->where('recintos.distrito', $distrito)
        ->first();

        $suma_votos = $votos_uninominales->sum('validos') + $votos_uninominales_r->nulos + $votos_uninominales_r->blancos;

        $uninominales = array();

        foreach ($votos_uninominales as $key => $value) {
            $e = array();
            $e["id_partido"] = $value->id_partido;
            $e["sigla"] = $value->sigla;
            $e["fill"] = $value->fill;
            $e["borderColor"] = $value->borderColor;
            $e["valor"] = $value->validos;
            if ($suma_votos == 0) {
                $e["porcentaje"] = 0;
            } else {
                $e["porcentaje"] = round(($value->validos*100)/$suma_votos, 2);
            }
            array_push($uninominales, $e);
        }

        if($votos_uninominales_r->blancos != null){
            $e = array();
            $e["id_partido"] = count($votos_uninominales) + 1;
            $e["sigla"] = 'Blanco';
            $e["fill"] = '#fff';
            $e["borderColor"] = '#000';
            $e["valor"] = $votos_uninominales_r->blancos;
            if ($suma_votos == 0) {
                $e["porcentaje"] = 0;
            } else {
                $e["porcentaje"] = round(($votos_uninominales_r->blancos*100)/$suma_votos, 2);
            }

            array_push($uninominales, $e);
        }
            
        if($votos_uninominales_r->nulos != null){
            $e = array();
            $e["id_partido"] = count($votos_uninominales) + 2;
            $e["sigla"] = 'Nulo';
            $e["fill"] = '#898a8a';
            $e["borderColor"] = '#f90101';
            $e["valor"] = $votos_uninominales_r->nulos;
            if ($suma_votos == 0) {
                $e["porcentaje"] = 0;
            } else {
                $e["porcentaje"] = round(($votos_uninominales_r->nulos*100)/$suma_votos, 2);
            }

            array_push($uninominales, $e);
        }

        return response()->json($uninominales);
    }

    public function uninominales_c8(){
        $votos_uninominales = \DB::table('mesas')
        ->join('recintos', 'mesas.id_recinto', 'recintos.id_recinto')
        ->join('votos_uninominales', 'mesas.id_mesa', 'votos_uninominales.id_mesa')
        ->join('partidos', 'votos_uninominales.id_partido', 'partidos.id_partido')
        ->select('votos_uninominales.id_partido', 'partidos.sigla', 'partidos.fill', 'partidos.borderColor',
        \DB::raw('SUM(validos) as validos')
        )
        ->where('recintos.circunscripcion', 8)
        ->groupBy('votos_uninominales.id_partido')
        ->orderby('partidos.nivel')
        ->get();
        return response()->json($votos_uninominales);
    }

    public function uninominales_c10(){
        $votos_uninominales = \DB::table('mesas')
        ->join('recintos', 'mesas.id_recinto', 'recintos.id_recinto')
        ->join('votos_uninominales', 'mesas.id_mesa', 'votos_uninominales.id_mesa')
        ->join('partidos', 'votos_uninominales.id_partido', 'partidos.id_partido')
        ->select('votos_uninominales.id_partido', 'partidos.sigla', 'partidos.fill', 'partidos.borderColor',
        \DB::raw('SUM(validos) as validos')
        )
        ->where('recintos.circunscripcion', 10)
        ->groupBy('votos_uninominales.id_partido')
        ->orderby('partidos.nivel')
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
        ->where('recintos.circunscripcion', 11)
        ->groupBy('votos_uninominales.id_partido')
        ->orderby('partidos.nivel')
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
        ->where('recintos.circunscripcion', 12)
        ->groupBy('votos_uninominales.id_partido')
        ->orderby('partidos.nivel')
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
        ->where('recintos.circunscripcion', 13)
        ->groupBy('votos_uninominales.id_partido')
        ->orderby('partidos.nivel')
        ->get();
        return response()->json($votos_uninominales);
    }

}
