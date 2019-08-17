<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class TransportesController extends Controller
{
  public function form_agregar_transporte(){
      $origenes = \DB::table('origen')
      ->select('id_origen', 'origen')
      ->where('activo', 1)
      ->get();

      $distritos = \DB::table('recintos')
      ->select('distrito')
      ->get();

      return view("formularios.form_agregar_transporte")
            ->with("origenes",$origenes)
            ->with("distritos",$distritos);
  }

  public function agregar_transporte(Request $request){

      //Realizamos el registro
      \DB::table('transportes')->insert([
          ['conductor' => $request->conductor,
           'contacto_conductor' => $request->contacto_conductor,
           'propietario' => $request->propietario,
           'contacto_propietario' => $request->contacto_propietario,
           'id_origen' => $request->id_origen,
           'id_suborigen' => $request->id_suborigen,
           'distrito' => $request->distrito,
           'marca' => $request->marca,
           'modelo' => $request->modelo,
           'placa' => $request->placa]
      ]);

      return view("mensajes.mensaje_exito")->with("msj",' Transporte agregado correctamente ');
  }


  public function consultaSuborigen($id_origen){
      $suborigenes = \DB::table('sub_origen')
      ->select('id_sub_origen', 'nombre')
      ->where('id_origen', $id_origen)
      ->where('activo', 1)
      ->get();

      return $suborigenes;
  }

  public function revisar_transportes(){
      $transportes = \DB::table('transportes')
      ->leftjoin('origen', 'origen.id_origen', '=', 'transportes.id_origen')
      ->leftjoin('sub_origen', 'sub_origen.id_sub_origen', '=', 'transportes.id_suborigen')
      ->orderBy('transportes.distrito', 'ASC')
      ->orderBy('transportes.id_origen', 'ASC')
      ->orderBy('transportes.id_suborigen', 'ASC')
      ->orderBy('transportes.conductor', 'ASC')
      ->orderBy('transportes.propietario', 'ASC')
      ->get();

      return view("listados.revisar_transportes")
            ->with("transportes",$transportes);
  }

  public function revisar_transportes_asistencia(){
      //Tomamos la fecha actual
      $date = new Carbon();
      $hoy = Carbon::now();
      $fecha = $hoy->format('Y-m-d');

      $transportes = \DB::table('transportes')
      ->leftjoin('origen', 'origen.id_origen', '=', 'transportes.id_origen')
      ->leftjoin('sub_origen', 'sub_origen.id_sub_origen', '=', 'transportes.id_suborigen')
      ->leftjoin('rel_usuario_transporte', 'rel_usuario_transporte.id_transporte', '=', 'transportes.id_transporte')
      ->leftjoin('asistencia', 'asistencia.id_usuario', '=', 'rel_usuario_transporte.id_usuario')
      ->where('asistencia.fecha', $fecha)
      ->orderBy('transportes.distrito', 'ASC')
      ->orderBy('transportes.id_origen', 'ASC')
      ->orderBy('transportes.id_suborigen', 'ASC')
      ->orderBy('transportes.conductor', 'ASC')
      ->orderBy('transportes.propietario', 'ASC')
      ->orderBy('asistencia.asistencia', 'DESC')
      ->get();

      return view("listados.revisar_transportes_asistencia")
            ->with("transportes",$transportes);
  }
}
