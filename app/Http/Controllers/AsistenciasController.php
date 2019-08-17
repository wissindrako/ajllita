<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Auth;

class AsistenciasController extends Controller
{
  public function form_agregar_lista_de_asistencia(){
    return view("formularios.form_agregar_lista_de_asistencia");
  }

  public function agregar_lista_de_asistencia(Request $request){
    //Tomamos el id de todos los usuarios activos
    $usuarios = \DB::table('users')
    ->select('id')
    ->where('activo', 1)
    ->get();

    //Realizamos un registro para cada usuario activo, con el dia establecido
    foreach ($usuarios as $usuario) {
      \DB::table('asistencia')->insert([
          ['id_usuario' => $usuario->id,
           'fecha' => $request->fecha,
           'asistencia' => 0]
      ]);
    }
    return view("mensajes.mensaje_exito")->with("msj"," Lista de asistencia registrada correctamente para fecha $request->fecha ");
  }

  public function form_listas_de_asistencia(){
    //Tomamos todas las listas creadas
    $listas = \DB::table('asistencia')
    ->select('fecha')
    ->distinct()
    ->get();

    return view("formularios.form_listas_de_asistencia")
          ->with("listas",$listas);
  }

  public function lista_de_asistencia(Request $request){
    //Tomamos todas las listas creadas
    $listas = \DB::table('asistencia')
    ->join('users', 'users.id', '=', 'asistencia.id_usuario')
    ->join('personas', 'personas.id_persona', '=', 'users.id_persona')
    ->join('recintos', 'personas.id_recinto', '=', 'recintos.id_recinto')
    ->join('origen', 'origen.id_origen', '=', 'personas.id_origen')
    ->join('sub_origen', 'sub_origen.id_sub_origen', '=', 'personas.id_sub_origen')
    ->select('recintos.circunscripcion', 'recintos.distrito', 'recintos.zona', 'recintos.nombre as recinto', 'recintos.direccion as direccion_recinto', 'asistencia.asistencia',
             'users.email', 'users.password', 'personas.nombre as nombre_usuario', 'personas.paterno', 'personas.materno', 'personas.cedula_identidad',
             'personas.complemento_cedula', 'personas.expedido', 'personas.telefono_celular', 'personas.telefono_referencia', 'personas.direccion as direccion_usuario',
             'origen.origen', 'sub_origen.nombre as nombre_sub_origen')
    ->where('asistencia.fecha', $request->fecha)
    ->orderBy('recintos.circunscripcion', 'ASC')
    ->orderBy('recintos.distrito', 'ASC')
    ->orderBy('recintos.zona', 'ASC')
    ->orderBy('recintos.nombre', 'ASC')
    ->orderBy('asistencia.asistencia', 'DESC')
    ->orderBy('users.email', 'ASC')
    ->get();

    return view("listados.lista_de_asistencia")
          ->with("listas",$listas)
          ->with("fecha",$request->fecha);
  }

  public function form_registrar_asistencia(){
    return view("formularios.form_registrar_asistencia");
  }

  public function registrar_asistencia(Request $request){
    //Tomamos el id del usuario
    $id_usuario = Auth::user()->id;

    //Tomamos la fecha actual
    $date = new Carbon();
    $hoy = Carbon::now();
    $fecha = $hoy->format('Y-m-d');

    //Verificamos que exista una lista de asistencia para el usuario y fecha actual
    $registro_fecha = \DB::table('asistencia')
                              ->where('fecha', $fecha)
                              ->distinct()
                              ->value('fecha');

    if ($registro_fecha != "") {
      //Tomamos el id del usuario que intenta registrar su asistencia
      $registro_usuario_asistencia = \DB::table('asistencia')
                                ->where('id_usuario', $id_usuario)
                                ->where('fecha', $fecha)
                                ->distinct()
                                ->value('asistencia');

      if ($registro_usuario_asistencia == "0" ) {
        //En caso que haya la lista, este el nombre del usuario y no haya registrado su asistencia previamente, registramos su asistencia
        //Realizamos el update al registro de asistencia
        \DB::table('asistencia')
              ->where('id_usuario', $id_usuario)
              ->where('fecha', $fecha)
              ->update(['asistencia' => 1,
                        'fecha_registro' => $hoy]);

        return view("mensajes.mensaje_exito")->with("msj"," Gracias por su asistencia. ");
      }
      elseif ($registro_usuario_asistencia == "1") {
        //Si el valor $registro_usuario_asistencia esta en 1, el usuario ya registro su asistencia
        return view("mensajes.mensaje_error")->with("msj"," Estimado usuario, usted ya registró su asistencia. ");
      }
      else {
        //Si el valor $registro_usuario_asistencia esta vacio, el usuario no esta en la lista
        return view("mensajes.mensaje_error")->with("msj"," Estimado usuario, su nombre no está registrado en la lista de fecha $fecha ");
      }
    }
    else {
      return view("mensajes.mensaje_error")->with("msj"," Estimado usuario, no existe una lista de asistencia para la fecha $fecha ");
    }
  }

  public function registrar_falta(Request $request){
    //Tomamos el id del usuario
    $id_usuario = Auth::user()->id;

    //Tomamos la fecha actual
    $date = new Carbon();
    $hoy = Carbon::now();
    $fecha = $hoy->format('Y-m-d');

    //Verificamos que exista una lista de asistencia para el usuario y fecha actual
    $registro_fecha = \DB::table('asistencia')
                              ->where('fecha', $fecha)
                              ->distinct()
                              ->value('fecha');

    if ($registro_fecha != "") {
      //Tomamos el id del usuario que intenta registrar su asistencia
      $registro_usuario_asistencia = \DB::table('asistencia')
                                ->where('id_usuario', $id_usuario)
                                ->where('fecha', $fecha)
                                ->distinct()
                                ->value('asistencia');

      if ($registro_usuario_asistencia == "0" ) {
        //En caso que haya la lista, este el nombre del usuario y no haya registrado su asistencia previamente, registramos su asistencia
        //Realizamos el update al registro de asistencia
        \DB::table('asistencia')
              ->where('id_usuario', $id_usuario)
              ->where('fecha', $fecha)
              ->update(['asistencia' => 0,
                        'observacion' => $request->observacion,
                        'fecha_registro' => $hoy]);

        return view("mensajes.mensaje_exito")->with("msj"," Gracias por indicarnos que no podrá asistir. ");
      }
      elseif ($registro_usuario_asistencia == "1") {
        //Si el valor $registro_usuario_asistencia esta en 1, el usuario ya registro su asistencia
        return view("mensajes.mensaje_error")->with("msj"," Estimado usuario, usted ya registró su asistencia. ");
      }
      else {
        //Si el valor $registro_usuario_asistencia esta vacio, el usuario no esta en la lista
        return view("mensajes.mensaje_error")->with("msj"," Estimado usuario, su nombre no está registrado en la lista de fecha $fecha ");
      }
    }
    else {
      return view("mensajes.mensaje_error")->with("msj"," Estimado usuario, no existe una lista de asistencia para la fecha $fecha ");
    }
  }
}
