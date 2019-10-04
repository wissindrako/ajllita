<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Recinto;
use Maatwebsite\Excel\Facades\Excel;

use App\User;

class ExcelController extends Controller
{
    function form_asignacion_delegado_excel(){
        return view('formularios.form_asignacion_delegado_excel');
    }

    function delegados_mesa()
    {
        // $mesa_data = DB::table('users')->get()->toArray();
        // $distritos = \DB::table('recintos')->select('distrito_referencial')->distinct()->get()->toArray();
        
        $mesas =\DB::table('mesas')
        ->leftjoin('rel_usuario_mesa', 'mesas.id_mesa', 'rel_usuario_mesa.id_mesa')
        ->leftjoin('recintos', 'mesas.id_recinto', 'recintos.id_recinto')
        ->leftjoin('users', 'rel_usuario_mesa.id_usuario', 'users.id')
        ->leftjoin('personas', 'users.id_persona', 'personas.id_persona')
        // ->where('recintos.id_recinto', 13)
        ->select( 'mesas.id_mesa',
        'recintos.id_recinto', 'recintos.asiento_electoral', 'recintos.nombre as nombre_recinto', 'recintos.numero_mesas', 'recintos.numero_votantes', 
        'recintos.zona_referencial', 'recintos.direccion', 'recintos.circunscripcion', 'recintos.distrito',
        'personas.titularidad',
        'rel_usuario_mesa.id_usuario_mesa',
        // \DB::raw('CONCAT("Cel. ", personas.telefono_celular," - ",personas.telefono_referencia) as contacto'),
        // \DB::raw('CONCAT(personas.paterno," ",personas.materno," ",personas.nombre) as nombre_completo'),
        \DB::raw("group_concat(personas.titularidad SEPARATOR ', ') as titularidad")
        )
        ->orderBy('mesas.id_mesa')
        ->groupBy('mesas.id_mesa')
        // ->take(100)
        ->get();

        
            
            //Titulos - Headers
            // $mesa_array[] = array(
            //     'Asiento Electoral', 'Recinto Electoral', 'Mesas', 'Votantes', 'Zona Referencial', 
            //     'Dirección', 'Circunscripción', 'Distrito', 'Asignación'
            // );
            // dd($mesa_data);
           


        $distritos = Recinto::groupBy('distrito')->pluck('distrito');
        $circunscripciones = Recinto::groupBy('circunscripcion')->pluck('circunscripcion');
        $max_mesas = Recinto::all()->max('numero_mesas');

        $detalle_mesas = array();

        foreach($mesas as $mesa)
        {
            $e = array();
            
                $e['Asiento Electoral'] = $mesa->asiento_electoral;
                $e['Recinto Electoral'] = $mesa->nombre_recinto;
                $e['Mesas'] = $mesa->numero_mesas;
                $e['Votantes'] = $mesa->numero_votantes;
                $e['Direccion'] = $mesa->direccion;
                $e['Zona Referencial'] = $mesa->zona_referencial;
                $e['Circunscripcion'] = $mesa->circunscripcion;
                $e['Distrito'] = $mesa->distrito;
                $e['Asignacion'] = $mesa->titularidad;
                
                $e['separador_detalle'] = "";

            //Distritos
            foreach ($distritos as $distrito) {
                if ($mesa->distrito == $distrito) {
                    $e["d".$distrito] = 1;
                } else {
                    $e["d".$distrito] = 0;
                }
            }
            $e['separador_distritos'] = "";

            //Circunscripciones.
            foreach ($circunscripciones as $circ) {
                if ($mesa->circunscripcion == $circ) {
                    $e["c".$circ] = 1;
                } else {
                    $e["c".$circ] = 0;
                }
            }
            $e['separador_circ'] = "";

            //Titulares
            for ($i=1; $i <= $max_mesas ; $i++) { 
                if($mesa->numero_mesas == $i){
                    if ($mesa->titularidad == "") {
                        $e["titular_".$i] = 0;
                    } else {
                        $asignacion = (explode(", ",$mesa->titularidad));
                        if (in_array('TITULAR', $asignacion)) {
                            $e["titular_".$i] = 1;
                        }else{
                            $e["titular_".$i] = 0;
                        }
                    }
                }else{
                    $e["titular_".$i] = 0;
                }
            }
            $e['separador_titular'] = "";

            //Titulares
            for ($i=1; $i <= $max_mesas ; $i++) { 
                if($mesa->numero_mesas == $i){
                    if ($mesa->titularidad == "") {
                        $e["suplente_".$i] = 0;
                    } else {
                        $asignacion = (explode(", ",$mesa->titularidad));
                        if (in_array('SUPLENTE', $asignacion)) {
                            $e["suplente_".$i] = 1;
                        }else{
                            $e["suplente_".$i] = 0;
                        }
                    }
                }else{
                    $e["suplente_".$i] = 0;
                }
            }
            array_push($detalle_mesas, $e);
        }
        
        // dd($detalle_mesas);

        Excel::create('Delegados por Mesa', function($excel) use ($detalle_mesas){
            $excel->setTitle('Delegados por Mesa');
            $excel->sheet('Delegados por Mesa', function($sheet) use ($detalle_mesas){
            $sheet->fromArray($detalle_mesas, null, 'A1', true, false);
            });
        })->download('xlsx');
    }

    function test_page()
    {
        // $mesa_data = DB::table('users')->get()->toArray();
        $mesa_data = User::get();

        //Titulos - Headers
        $mesa_array[] = array('Nombre de mesa', 'email', 'created_at', 'updated_at', 'id_persona');
        // dd($mesa_data);
        foreach($mesa_data as $mesa)
        {
            $mesa_array[] = array(
            'mesa'  => $mesa->name,
            'email'   => $mesa->email,
            'Creado en'    => $mesa->created_at,
            'Actualizado en'  => $mesa->updated_at,
            'id_persona'   => $mesa->id_persona
            );
        }
        Excel::create('mesa Data', function($excel) use ($mesa_array){
            $excel->setTitle('mesa Data');
            $excel->sheet('mesa Data', function($sheet) use ($mesa_array){
                $sheet->fromArray($mesa_array, null, 'A1', false, false);
            });
        })->download('xlsx');
    }
}