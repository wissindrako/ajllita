<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Storage;
Use App\User;
Use App\Recinto;
Use App\Mesa;

class VotacionesController extends Controller
{
  public function form_llenar_mesas_emergencia_tipo(){

    return view("formularios.form_llenar_mesas_emergencia_tipo");
  }

  //PRESIDENCIALES
  public function form_llenado_emergencia($id_recinto){
    
    $recinto = Recinto::find($id_recinto);

    $partidos = \DB::table('partidos')
    ->orderBy('nivel')
    ->get();

    $users = User::all();

    $mesas = Recinto::find($id_recinto)->mesas;

    return view("formularios.form_llenado_emergencia")
      ->with('mesas', $mesas)
      ->with('recinto', $recinto)
      ->with('users', $users)
      ->with('partidos', $partidos);
  }

  //UNINOMINALES
  public function form_llenado_emergencia_uninominales($id_recinto){
    
    $recinto = Recinto::find($id_recinto);

    $partidos = \DB::table('partidos')
    ->orderBy('nivel')
    ->get();

    $users = User::all();

    $mesas = Recinto::find($id_recinto)->mesas;

    return view("formularios.form_llenado_emergencia_uninominales")
      ->with('mesas', $mesas)
      ->with('recinto', $recinto)
      ->with('users', $users)
      ->with('partidos', $partidos);
  }

  public function llenado_emergencia(Request $request){
    // $a = 0;
    // while ($a < 10) {
    //   $a++;
    // }

    if ($request->partido_1 == "") { # code...
    } else {
      // return \DB::table('votos_presidenciales')->where('id_mesa', $request->id_mesa)->where('id_partido', 1)->get();
      if (count(\DB::table('votos_presidenciales')->where('id_mesa', $request->id_mesa)->where('id_partido', 1)->get()) > 0) {
        \DB::table('votos_presidenciales')->where('id_mesa', $request->id_mesa)->where('id_partido', 1)
      ->update(['validos' => $request->partido_1, 'id_usuario' => Auth::user()->id]);
      } else {
        //Realizamos el registro
        \DB::table('votos_presidenciales')->insert([
          ['id_mesa' => $request->id_mesa,
          'id_partido' => 1,
          'validos' => $request->partido_1,
          'id_usuario' => Auth::user()->id]
        ]);
      }
    }
    if ($request->partido_2 == "") { # code...
    } else {
      if (count(\DB::table('votos_presidenciales')->where('id_mesa', $request->id_mesa)->where('id_partido', 2)->get()) > 0) {
        \DB::table('votos_presidenciales')->where('id_mesa', $request->id_mesa)->where('id_partido', 2)
      ->update(['validos' => $request->partido_2, 'id_usuario' => Auth::user()->id]);
      } else {
        //Realizamos el registro
        \DB::table('votos_presidenciales')->insert([
          ['id_mesa' => $request->id_mesa,
          'id_partido' => 2,
          'validos' => $request->partido_2,
          'id_usuario' => Auth::user()->id]
        ]);
      }
    }
    if ($request->partido_3 == "") { # code...
    } else {
      if (count(\DB::table('votos_presidenciales')->where('id_mesa', $request->id_mesa)->where('id_partido', 3)->get()) > 0) {
        \DB::table('votos_presidenciales')->where('id_mesa', $request->id_mesa)->where('id_partido', 3)
      ->update(['validos' => $request->partido_3, 'id_usuario' => Auth::user()->id]);
      } else {
        //Realizamos el registro
        \DB::table('votos_presidenciales')->insert([
          ['id_mesa' => $request->id_mesa,
          'id_partido' => 3,
          'validos' => $request->partido_3,
          'id_usuario' => Auth::user()->id]
        ]);
      }
    }
    if ($request->partido_4 == "") { # code...
    } else {
      if (count(\DB::table('votos_presidenciales')->where('id_mesa', $request->id_mesa)->where('id_partido', 4)->get()) > 0) {
        \DB::table('votos_presidenciales')->where('id_mesa', $request->id_mesa)->where('id_partido', 4)
      ->update(['validos' => $request->partido_4, 'id_usuario' => Auth::user()->id]);
      } else {
        //Realizamos el registro
        \DB::table('votos_presidenciales')->insert([
          ['id_mesa' => $request->id_mesa,
          'id_partido' => 4,
          'validos' => $request->partido_4,
          'id_usuario' => Auth::user()->id]
        ]);
      }
    }
    if ($request->partido_5 == "") { # code...
    } else {
      if (count(\DB::table('votos_presidenciales')->where('id_mesa', $request->id_mesa)->where('id_partido', 5)->get()) > 0) {
        \DB::table('votos_presidenciales')->where('id_mesa', $request->id_mesa)->where('id_partido', 5)
      ->update(['validos' => $request->partido_5, 'id_usuario' => Auth::user()->id]);
      } else {
        //Realizamos el registro
        \DB::table('votos_presidenciales')->insert([
          ['id_mesa' => $request->id_mesa,
          'id_partido' => 5,
          'validos' => $request->partido_5,
          'id_usuario' => Auth::user()->id]
        ]);
      }
    }
    if ($request->partido_6 == "") { # code...
    } else {
      if (count(\DB::table('votos_presidenciales')->where('id_mesa', $request->id_mesa)->where('id_partido', 6)->get()) > 0) {
        \DB::table('votos_presidenciales')->where('id_mesa', $request->id_mesa)->where('id_partido', 6)
      ->update(['validos' => $request->partido_6, 'id_usuario' => Auth::user()->id]);
      } else {
        //Realizamos el registro
        \DB::table('votos_presidenciales')->insert([
          ['id_mesa' => $request->id_mesa,
          'id_partido' => 6,
          'validos' => $request->partido_6,
          'id_usuario' => Auth::user()->id]
        ]);
      }
    }
    if ($request->partido_7 == "") { # code...
    } else {
      if (count(\DB::table('votos_presidenciales')->where('id_mesa', $request->id_mesa)->where('id_partido', 7)->get()) > 0) {
        \DB::table('votos_presidenciales')->where('id_mesa', $request->id_mesa)->where('id_partido', 7)
      ->update(['validos' => $request->partido_7, 'id_usuario' => Auth::user()->id]);
      } else {
        //Realizamos el registro
        \DB::table('votos_presidenciales')->insert([
          ['id_mesa' => $request->id_mesa,
          'id_partido' => 7,
          'validos' => $request->partido_7,
          'id_usuario' => Auth::user()->id]
        ]);
      }
    }
    if ($request->partido_8 == "") { # code...
    } else {
      if (count(\DB::table('votos_presidenciales')->where('id_mesa', $request->id_mesa)->where('id_partido', 8)->get()) > 0) {
        \DB::table('votos_presidenciales')->where('id_mesa', $request->id_mesa)->where('id_partido', 8)
      ->update(['validos' => $request->partido_8, 'id_usuario' => Auth::user()->id]);
      } else {
        //Realizamos el registro
        \DB::table('votos_presidenciales')->insert([
          ['id_mesa' => $request->id_mesa,
          'id_partido' => 8,
          'validos' => $request->partido_8,
          'id_usuario' => Auth::user()->id]
        ]);
      }
    }
    if ($request->partido_9 == "") { # code...
    } else {
      if (count(\DB::table('votos_presidenciales')->where('id_mesa', $request->id_mesa)->where('id_partido', 9)->get()) > 0) {
        \DB::table('votos_presidenciales')->where('id_mesa', $request->id_mesa)->where('id_partido', 9)
      ->update(['validos' => $request->partido_9, 'id_usuario' => Auth::user()->id]);
      } else {
        //Realizamos el registro
        \DB::table('votos_presidenciales')->insert([
          ['id_mesa' => $request->id_mesa,
          'id_partido' => 9,
          'validos' => $request->partido_9,
          'id_usuario' => Auth::user()->id]
        ]);
      }
    }
    if ($request->blancos == "" && $request->nulos == "") { # code...
    } else {
      if (count(\DB::table('votos_presidenciales_r')->where('id_mesa', $request->id_mesa)->get()) > 0) {
        \DB::table('votos_presidenciales_r')->where('id_mesa', $request->id_mesa)
      ->update(['blancos' => $request->blancos, 'nulos' => $request->nulos, 'id_usuario' => Auth::user()->id]);
      } else {
        //Realizamos el registro
        \DB::table('votos_presidenciales_r')->insert([
          ['id_mesa' => $request->id_mesa,
          'blancos' => $request->blancos,
          'nulos' => $request->nulos,
          'id_usuario' => Auth::user()->id]
        ]);
      }
    }

    

    // if($a->save())
    // {
    //     return 'ok' ;
    // }
    // else
    // {
    //     return 'failed' ;
    // }
  }

  public function form_votar_seleccionar_mesa(){
    //Tomamos el id del usuario
    $id_usuario = Auth::user()->id;
    // $id_usuario = 45;

    //Tomamos las mesas y los registros intorducidos
    $mesas = \DB::table('rel_usuario_mesa')
    ->leftjoin('mesas', 'rel_usuario_mesa.id_mesa', '=', 'mesas.id_mesa')
    ->where('id_usuario', $id_usuario)
    ->where('activo', 1)
    ->select('mesas.id_mesa', 'mesas.codigo_mesas_oep', 'mesas.codigo_ajllita', 'mesas.numero_votantes', 'mesas.foto_presidenciales','foto_uninominales',
                \DB::raw("(SELECT COUNT(id_votos_presidenciales) FROM votos_presidenciales WHERE id_mesa=mesas.id_mesa) as registros_presidenciales"),
                \DB::raw("(SELECT COUNT(id_votos_presidenciales_r) FROM votos_presidenciales_r WHERE id_mesa=mesas.id_mesa) as registros_presidenciales_r"),
                \DB::raw("(SELECT COUNT(id_votos_uninominales) FROM votos_uninominales WHERE id_mesa=mesas.id_mesa) as registros_uninominales"),
                \DB::raw("(SELECT COUNT(id_votos_uninominales_r) FROM votos_uninominales_r WHERE id_mesa=mesas.id_mesa) as registros_uninominales_r"),
                \DB::raw("(SELECT SUM(validos) FROM votos_presidenciales WHERE id_mesa=mesas.id_mesa) as suma_presidenciales"),
                \DB::raw("(SELECT nulos FROM votos_presidenciales_r WHERE id_mesa=mesas.id_mesa) as suma_presidenciales_nulos"),
                \DB::raw("(SELECT blancos FROM votos_presidenciales_r WHERE id_mesa=mesas.id_mesa) as suma_presidenciales_blancos"),
                \DB::raw("(SELECT SUM(validos) FROM votos_uninominales WHERE id_mesa=mesas.id_mesa) as suma_uninominales"),
                \DB::raw("(SELECT nulos FROM votos_uninominales_r WHERE id_mesa=mesas.id_mesa) as suma_uninominales_nulos"),
                \DB::raw("(SELECT blancos FROM votos_uninominales_r WHERE id_mesa=mesas.id_mesa) as suma_uninominales_blancos")
              )
    ->get();

    $cantidad_partidos = \DB::table('partidos')
                            ->count('id_partido');

    return view("formularios.form_votar_seleccionar_mesa")
          ->with("mesas",$mesas)
          ->with("cantidad_partidos",$cantidad_partidos);
  }

  public function form_votar_seleccionar_tipo(Request $request){
    //Tomamos los datos de la mesa
    $mesas = \DB::table('mesas')
    ->select('id_mesa', 'codigo_mesas_oep')
    ->where('id_mesa', $request->id_mesa)
    ->get();

    return view("formularios.form_votar_seleccionar_tipo")
          ->with("mesas",$mesas);
  }


  public function form_votar_presidencial(Request $request){
    //Tomamos los datos de la mesa
    $mesas = \DB::table('mesas')
    ->select('id_mesa', 'codigo_mesas_oep', 'numero_votantes', 'foto_presidenciales')
    ->where('id_mesa', $request->id_mesa)
    ->get();

    foreach ($mesas as $mesa) {
      $codigo_mesas_oep = $mesa->codigo_mesas_oep;
      $foto_presidenciales = $mesa->foto_presidenciales;
    }

    //Tomamos los partidos y los votos intorducidos para la mesa seleccionada
    $partidos = \DB::table('partidos')->orderBy('nivel')->get();

    $votos_introducidos = \DB::table('votos_presidenciales')
                              ->where('id_mesa', $request->id_mesa)
                              ->select('id_partido', 'validos')
                              ->get();

    /*$partidos = \DB::table('partidos')
                    ->leftjoin('votos_presidenciales', 'partidos.id_partido', '=', 'votos_presidenciales.id_partido')
                    ->where('votos_presidenciales.id_mesa', $request->id_mesa)
                    ->select('partidos.id_partido', 'partidos.nombre', 'partidos.sigla', 'partidos.logo', 'votos_presidenciales.validos')
                    ->get();*/

    $votos_introducidos_nyb = \DB::table('votos_presidenciales_r')
                              ->where('id_mesa', $request->id_mesa)
                              ->select('nulos', 'blancos')
                              ->get();

    return view("formularios.form_votar_presidencial")
          ->with("id_mesa",$request->id_mesa)
          ->with("codigo_mesas_oep",$codigo_mesas_oep)
          ->with("partidos",$partidos)
          ->with("votos_introducidos",$votos_introducidos)
          ->with("votos_introducidos_nyb",$votos_introducidos_nyb)
          ->with("foto_presidenciales",$foto_presidenciales);
  }

  public function form_votar_presidencial_partido(Request $request){
    //Tomamos los datos de la mesa
    $mesas = \DB::table('mesas')
              ->select('id_mesa', 'codigo_mesas_oep', 'numero_votantes')
              ->where('id_mesa', $request->id_mesa)
              ->get();

    foreach ($mesas as $mesa) {
      $codigo_mesas_oep = $mesa->codigo_mesas_oep;
      $numero_votantes = $mesa->numero_votantes;
    }

    //Tomamos los datos del partido
    $sigla_partido = \DB::table('partidos')
                    ->where('id_partido', $request->id_partido)
                    ->value('sigla');

    //Tomamos el valor ingresado para el partido y mesa dado
    $validos = \DB::table('votos_presidenciales')
                    ->where('id_mesa', $request->id_mesa)
                    ->where('id_partido', $request->id_partido)
                    ->value('validos');

    return view("formularios.form_votar_presidencial_partido")
          ->with("id_mesa",$request->id_mesa)
          ->with("codigo_mesas_oep",$codigo_mesas_oep)
          ->with("numero_votantes",$numero_votantes)
          ->with("id_partido",$request->id_partido)
          ->with("sigla_partido",$sigla_partido)
          ->with("validos",$validos);
  }

  public function votar_presidencial_partido(Request $request){
    //Verificamos si se hizo el registro previamente
    $id_votos_presidenciales = \DB::table('votos_presidenciales')
                ->where('id_mesa', $request->id_mesa)
                ->where('id_partido', $request->id_partido)
                ->value('id_votos_presidenciales');

    //Si no existe el registro, lo creamos, caso contrario lo actualizamos
    if ($id_votos_presidenciales == "") {
      //Realizamos el registro
      \DB::table('votos_presidenciales')->insert([
          ['id_mesa' => $request->id_mesa,
           'id_partido' => $request->id_partido,
           'validos' => $request->validos,
           'id_usuario' => Auth::user()->id]
      ]);
    }
    else {
      \DB::table('votos_presidenciales')
            ->where('id_mesa', $request->id_mesa)
            ->where('id_partido', $request->id_partido)
            ->update(['validos' => $request->validos,
                      'id_usuario' => Auth::user()->id]);
    }

    //Tomamos los datos de la mesa
    $mesas = \DB::table('mesas')
    ->select('id_mesa', 'codigo_mesas_oep', 'numero_votantes', 'foto_presidenciales')
    ->where('id_mesa', $request->id_mesa)
    ->get();

    foreach ($mesas as $mesa) {
      $codigo_mesas_oep = $mesa->codigo_mesas_oep;
      $foto_presidenciales = $mesa->foto_presidenciales;
    }

    //Tomamos los partidos y los votos intorducidos para la mesa seleccionada
    $partidos = \DB::table('partidos')->orderBy('nivel')->get();

    $votos_introducidos = \DB::table('votos_presidenciales')
                              ->where('id_mesa', $request->id_mesa)
                              ->select('id_partido', 'validos')
                              ->get();

    $votos_introducidos_nyb = \DB::table('votos_presidenciales_r')
                              ->where('id_mesa', $request->id_mesa)
                              ->select('nulos', 'blancos')
                              ->get();

    return view("formularios.form_votar_presidencial")
          ->with("id_mesa",$request->id_mesa)
          ->with("codigo_mesas_oep",$codigo_mesas_oep)
          ->with("partidos",$partidos)
          ->with("votos_introducidos",$votos_introducidos)
          ->with("votos_introducidos_nyb",$votos_introducidos_nyb)
          ->with("foto_presidenciales",$foto_presidenciales);
  }

  public function form_votar_presidencial_nyb(Request $request){
    //Tomamos los datos de la mesa
    $mesas = \DB::table('mesas')
              ->select('id_mesa', 'codigo_mesas_oep', 'numero_votantes')
              ->where('id_mesa', $request->id_mesa)
              ->get();

    foreach ($mesas as $mesa) {
      $codigo_mesas_oep = $mesa->codigo_mesas_oep;
      $numero_votantes = $mesa->numero_votantes;
    }

    //Tomamos el registro de nulos y blancos
    $votos_introducidos_nyb = \DB::table('votos_presidenciales_r')
                              ->where('id_mesa', $request->id_mesa)
                              ->select('nulos', 'blancos')
                              ->get();

    //Inicializamos para evitar error de variable indefinida
    $nulos = 0;
    $blancos = 0;

    foreach ($votos_introducidos_nyb as $voto_introducido_nyb) {
      $nulos = $voto_introducido_nyb->nulos;
      $blancos = $voto_introducido_nyb->blancos;
    }

    return view("formularios.form_votar_presidencial_nyb")
          ->with("id_mesa",$request->id_mesa)
          ->with("codigo_mesas_oep",$codigo_mesas_oep)
          ->with("numero_votantes",$numero_votantes)
          ->with("nulos",$nulos)
          ->with("blancos",$blancos);
  }

  public function votar_presidencial_nyb(Request $request){
    //Verificamos si se hizo el registro previamente
    $id_votos_presidenciales_nyb = \DB::table('votos_presidenciales_r')
                ->where('id_mesa', $request->id_mesa)
                ->value('id_votos_presidenciales_r');

    //Si no existe el registro, lo creamos, caso contrario lo actualizamos
    if ($id_votos_presidenciales_nyb == "") {
      //Realizamos el registro
      \DB::table('votos_presidenciales_r')->insert([
          ['id_mesa' => $request->id_mesa,
           'nulos' => $request->nulos,
           'blancos' => $request->blancos,
           'id_usuario' => Auth::user()->id]
      ]);
    }
    else {
      \DB::table('votos_presidenciales_r')
            ->where('id_mesa', $request->id_mesa)
            ->update(['nulos' => $request->nulos,
                      'blancos' => $request->blancos,
                      'id_usuario' => Auth::user()->id]);
    }

    //Tomamos los datos de la mesa
    $mesas = \DB::table('mesas')
    ->select('id_mesa', 'codigo_mesas_oep', 'numero_votantes', 'foto_presidenciales')
    ->where('id_mesa', $request->id_mesa)
    ->get();

    foreach ($mesas as $mesa) {
      $codigo_mesas_oep = $mesa->codigo_mesas_oep;
      $foto_presidenciales = $mesa->foto_presidenciales;
    }

    //Tomamos los partidos y los votos intorducidos para la mesa seleccionada
    $partidos = \DB::table('partidos')->orderBy('nivel')->get();

    $votos_introducidos = \DB::table('votos_presidenciales')
                              ->where('id_mesa', $request->id_mesa)
                              ->select('id_partido', 'validos')
                              ->get();

    $votos_introducidos_nyb = \DB::table('votos_presidenciales_r')
                              ->where('id_mesa', $request->id_mesa)
                              ->select('nulos', 'blancos')
                              ->get();

    return view("formularios.form_votar_presidencial")
          ->with("id_mesa",$request->id_mesa)
          ->with("codigo_mesas_oep",$codigo_mesas_oep)
          ->with("partidos",$partidos)
          ->with("votos_introducidos",$votos_introducidos)
          ->with("votos_introducidos_nyb",$votos_introducidos_nyb)
          ->with("foto_presidenciales",$foto_presidenciales);
  }


  public function form_votar_presidencial_subir_imagen(Request $request){
    //Tomamos los datos de la mesa
    $codigo_mesas_oep = \DB::table('mesas')
                        ->where('id_mesa', $request->id_mesa)
                        ->value('codigo_mesas_oep');

    return view("formularios.form_votar_presidencial_subir_imagen")
          ->with("id_mesa",$request->id_mesa)
          ->with("codigo_mesas_oep",$codigo_mesas_oep);
  }


  public function votar_presidencial_subir_imagen(Request $request){

    //Subimos el archivo
    if($request->file('archivo') != ""){
        $archivo = $request->file('archivo');
        $mime = $archivo->getMimeType();
        $extension=strtolower($archivo->getClientOriginalExtension());
        $nuevo_nombre="presidencial-id_mesa_".$request->id_mesa;
        // $mi_imagen = public_path().'/storage/media/foto_presidenciales/'.$nuevo_nombre;
        // if (@getimagesize($mi_imagen)) {
        //   return $nuevo_nombre;
        // }
        // else
        // {
        //   echo $mi_imagen." - ";
        // }
        $r1=Storage::disk('media/foto_presidenciales')->put($nuevo_nombre, \File::get($archivo));
        $rutadelaimagen="../storage/media/foto_presidenciales/".$nuevo_nombre;
        if ($r1){
          //Introducimos la ruta en la BD
          \DB::table('mesas')
                ->where('id_mesa', $request->id_mesa)
                ->update(['foto_presidenciales' => $rutadelaimagen]);

          //Redirigimos a la vista form_votar_presidencial
          //Tomamos los datos de la mesa
          $mesas = \DB::table('mesas')
          ->select('id_mesa', 'codigo_mesas_oep', 'numero_votantes', 'foto_presidenciales')
          ->where('id_mesa', $request->id_mesa)
          ->get();

          foreach ($mesas as $mesa) {
            $codigo_mesas_oep = $mesa->codigo_mesas_oep;
            $foto_presidenciales = $mesa->foto_presidenciales;
          }

          //Tomamos los partidos y los votos intorducidos para la mesa seleccionada
          $partidos = \DB::table('partidos')->orderBy('nivel')->get();

          $votos_introducidos = \DB::table('votos_presidenciales')
                                    ->where('id_mesa', $request->id_mesa)
                                    ->select('id_partido', 'validos')
                                    ->get();

          $votos_introducidos_nyb = \DB::table('votos_presidenciales_r')
                                    ->where('id_mesa', $request->id_mesa)
                                    ->select('nulos', 'blancos')
                                    ->get();

          return view("formularios.form_votar_presidencial")
                ->with("id_mesa",$request->id_mesa)
                ->with("codigo_mesas_oep",$codigo_mesas_oep)
                ->with("partidos",$partidos)
                ->with("votos_introducidos",$votos_introducidos)
                ->with("votos_introducidos_nyb",$votos_introducidos_nyb)
                ->with("foto_presidenciales",$foto_presidenciales);

        }
        else{
          return view("mensajes.msj_error")->with("msj","Ocurrio un error al subir la imagen");
        }
     }
  }


  public function form_votar_uninominal(Request $request){
    //Tomamos los datos de la mesa
    $mesas = \DB::table('mesas')
    ->select('id_mesa', 'codigo_mesas_oep', 'numero_votantes', 'foto_uninominales')
    ->where('id_mesa', $request->id_mesa)
    ->get();

    foreach ($mesas as $mesa) {
      $codigo_mesas_oep = $mesa->codigo_mesas_oep;
      $foto_uninominales = $mesa->foto_uninominales;
    }

    //Tomamos los partidos y los votos intorducidos para la mesa seleccionada
    $partidos = \DB::table('partidos')->orderBy('nivel')->get();

    $votos_introducidos = \DB::table('votos_uninominales')
                              ->where('id_mesa', $request->id_mesa)
                              ->select('id_partido', 'validos')
                              ->get();

    $votos_introducidos_nyb = \DB::table('votos_uninominales_r')
                              ->where('id_mesa', $request->id_mesa)
                              ->select('nulos', 'blancos')
                              ->get();

    return view("formularios.form_votar_uninominal")
          ->with("id_mesa",$request->id_mesa)
          ->with("codigo_mesas_oep",$codigo_mesas_oep)
          ->with("partidos",$partidos)
          ->with("votos_introducidos",$votos_introducidos)
          ->with("votos_introducidos_nyb",$votos_introducidos_nyb)
          ->with("foto_uninominales",$foto_uninominales);
  }

  public function form_votar_uninominal_partido(Request $request){
    //Tomamos los datos de la mesa
    $mesas = \DB::table('mesas')
              ->select('id_mesa', 'codigo_mesas_oep', 'numero_votantes')
              ->where('id_mesa', $request->id_mesa)
              ->get();

    foreach ($mesas as $mesa) {
      $codigo_mesas_oep = $mesa->codigo_mesas_oep;
      $numero_votantes = $mesa->numero_votantes;
    }

    //Tomamos los datos del partido
    $sigla_partido = \DB::table('partidos')
                    ->where('id_partido', $request->id_partido)
                    ->value('sigla');

    //Tomamos el valor ingresado para el partido y mesa dado
    $validos = \DB::table('votos_uninominales')
                    ->where('id_mesa', $request->id_mesa)
                    ->where('id_partido', $request->id_partido)
                    ->value('validos');

    return view("formularios.form_votar_uninominal_partido")
          ->with("id_mesa",$request->id_mesa)
          ->with("codigo_mesas_oep",$codigo_mesas_oep)
          ->with("numero_votantes",$numero_votantes)
          ->with("id_partido",$request->id_partido)
          ->with("sigla_partido",$sigla_partido)
          ->with("validos",$validos);
  }

  public function votar_uninominal_partido(Request $request){
    //Verificamos si se hizo el registro previamente
    $id_votos_uninominales = \DB::table('votos_uninominales')
                ->where('id_mesa', $request->id_mesa)
                ->where('id_partido', $request->id_partido)
                ->value('id_votos_uninominales');

    //Si no existe el registro, lo creamos, caso contrario lo actualizamos
    if ($id_votos_uninominales == "") {
      //Realizamos el registro
      \DB::table('votos_uninominales')->insert([
          ['id_mesa' => $request->id_mesa,
           'id_partido' => $request->id_partido,
           'validos' => $request->validos,
           'id_usuario' => Auth::user()->id]
      ]);
    }
    else {
      \DB::table('votos_uninominales')
            ->where('id_mesa', $request->id_mesa)
            ->where('id_partido', $request->id_partido)
            ->update(['validos' => $request->validos,
                      'id_usuario' => Auth::user()->id]);
    }

    //Tomamos los datos de la mesa
    $mesas = \DB::table('mesas')
    ->select('id_mesa', 'codigo_mesas_oep', 'numero_votantes', 'foto_uninominales')
    ->where('id_mesa', $request->id_mesa)
    ->get();

    foreach ($mesas as $mesa) {
      $codigo_mesas_oep = $mesa->codigo_mesas_oep;
      $foto_uninominales = $mesa->foto_uninominales;
    }

    //Tomamos los partidos y los votos intorducidos para la mesa seleccionada
    $partidos = \DB::table('partidos')->orderBy('nivel')->get();

    $votos_introducidos = \DB::table('votos_uninominales')
                              ->where('id_mesa', $request->id_mesa)
                              ->select('id_partido', 'validos')
                              ->get();

    $votos_introducidos_nyb = \DB::table('votos_uninominales_r')
                              ->where('id_mesa', $request->id_mesa)
                              ->select('nulos', 'blancos')
                              ->get();

    return view("formularios.form_votar_uninominal")
          ->with("id_mesa",$request->id_mesa)
          ->with("codigo_mesas_oep",$codigo_mesas_oep)
          ->with("partidos",$partidos)
          ->with("votos_introducidos",$votos_introducidos)
          ->with("votos_introducidos_nyb",$votos_introducidos_nyb)
          ->with("foto_uninominales",$foto_uninominales);
  }

  public function form_votar_uninominal_nyb(Request $request){
    //Tomamos los datos de la mesa
    $mesas = \DB::table('mesas')
              ->select('id_mesa', 'codigo_mesas_oep', 'numero_votantes')
              ->where('id_mesa', $request->id_mesa)
              ->get();

    foreach ($mesas as $mesa) {
      $codigo_mesas_oep = $mesa->codigo_mesas_oep;
      $numero_votantes = $mesa->numero_votantes;
    }

    //Tomamos el registro de nulos y blancos
    $votos_introducidos_nyb = \DB::table('votos_uninominales_r')
                              ->where('id_mesa', $request->id_mesa)
                              ->select('nulos', 'blancos')
                              ->get();

    //Inicializamos para evitar error de variable indefinida
    $nulos = 0;
    $blancos = 0;
    foreach ($votos_introducidos_nyb as $voto_introducido_nyb) {
      $nulos = $voto_introducido_nyb->nulos;
      $blancos = $voto_introducido_nyb->blancos;
    }

    return view("formularios.form_votar_uninominal_nyb")
          ->with("id_mesa",$request->id_mesa)
          ->with("codigo_mesas_oep",$codigo_mesas_oep)
          ->with("numero_votantes",$numero_votantes)
          ->with("nulos",$nulos)
          ->with("blancos",$blancos);
  }

  public function votar_uninominal_nyb(Request $request){
    //Verificamos si se hizo el registro previamente
    $id_votos_uninominales_nyb = \DB::table('votos_uninominales_r')
                ->where('id_mesa', $request->id_mesa)
                ->value('id_votos_uninominales_r');

    //Si no existe el registro, lo creamos, caso contrario lo actualizamos
    if ($id_votos_uninominales_nyb == "") {
      //Realizamos el registro
      \DB::table('votos_uninominales_r')->insert([
          ['id_mesa' => $request->id_mesa,
           'nulos' => $request->nulos,
           'blancos' => $request->blancos,
           'id_usuario' => Auth::user()->id]
      ]);
    }
    else {
      \DB::table('votos_uninominales_r')
            ->where('id_mesa', $request->id_mesa)
            ->update(['nulos' => $request->nulos,
                      'blancos' => $request->blancos,
                      'id_usuario' => Auth::user()->id]);
    }

    //Tomamos los datos de la mesa
    $mesas = \DB::table('mesas')
    ->select('id_mesa', 'codigo_mesas_oep', 'numero_votantes', 'foto_uninominales')
    ->where('id_mesa', $request->id_mesa)
    ->get();

    foreach ($mesas as $mesa) {
      $codigo_mesas_oep = $mesa->codigo_mesas_oep;
      $foto_uninominales = $mesa->foto_uninominales;
    }

    //Tomamos los partidos y los votos intorducidos para la mesa seleccionada
    $partidos = \DB::table('partidos')->orderBy('nivel')->get();

    $votos_introducidos = \DB::table('votos_uninominales')
                              ->where('id_mesa', $request->id_mesa)
                              ->select('id_partido', 'validos')
                              ->get();

    $votos_introducidos_nyb = \DB::table('votos_uninominales_r')
                              ->where('id_mesa', $request->id_mesa)
                              ->select('nulos', 'blancos')
                              ->get();

    return view("formularios.form_votar_uninominal")
          ->with("id_mesa",$request->id_mesa)
          ->with("codigo_mesas_oep",$codigo_mesas_oep)
          ->with("partidos",$partidos)
          ->with("votos_introducidos",$votos_introducidos)
          ->with("votos_introducidos_nyb",$votos_introducidos_nyb)
          ->with("foto_uninominales",$foto_uninominales);
  }


  public function form_votar_uninominal_subir_imagen(Request $request){
    //Tomamos los datos de la mesa
    $codigo_mesas_oep = \DB::table('mesas')
                        ->where('id_mesa', $request->id_mesa)
                        ->value('codigo_mesas_oep');

    return view("formularios.form_votar_uninominal_subir_imagen")
          ->with("id_mesa",$request->id_mesa)
          ->with("codigo_mesas_oep",$codigo_mesas_oep);
  }


  public function votar_uninominal_subir_imagen(Request $request){

    //Subimos el archivo
    if($request->file('archivo') != ""){
        $archivo = $request->file('archivo');
        $mime = $archivo->getMimeType();
        $extension=strtolower($archivo->getClientOriginalExtension());
        $nuevo_nombre="uninominal-id_mesa_".$request->id_mesa;
        $r1=Storage::disk('media/foto_uninominales')->put($nuevo_nombre, \File::get($archivo) );
        $rutadelaimagen="../storage/media/foto_uninominales/".$nuevo_nombre;
        if ($r1){
          //Introducimos la ruta en la BD
          \DB::table('mesas')
                ->where('id_mesa', $request->id_mesa)
                ->update(['foto_uninominales' => $rutadelaimagen]);

          //Redirigimos a la vista form_votar_uninominal
          //Tomamos los datos de la mesa
          $mesas = \DB::table('mesas')
          ->select('id_mesa', 'codigo_mesas_oep', 'numero_votantes', 'foto_uninominales')
          ->where('id_mesa', $request->id_mesa)
          ->get();

          foreach ($mesas as $mesa) {
            $codigo_mesas_oep = $mesa->codigo_mesas_oep;
            $foto_uninominales = $mesa->foto_uninominales;
          }

          //Tomamos los partidos y los votos intorducidos para la mesa seleccionada
          $partidos = \DB::table('partidos')->orderBy('nivel')->get();

          $votos_introducidos = \DB::table('votos_uninominales')
                                    ->where('id_mesa', $request->id_mesa)
                                    ->select('id_partido', 'validos')
                                    ->get();

          $votos_introducidos_nyb = \DB::table('votos_uninominales_r')
                                    ->where('id_mesa', $request->id_mesa)
                                    ->select('nulos', 'blancos')
                                    ->get();

          return view("formularios.form_votar_uninominal")
                ->with("id_mesa",$request->id_mesa)
                ->with("codigo_mesas_oep",$codigo_mesas_oep)
                ->with("partidos",$partidos)
                ->with("votos_introducidos",$votos_introducidos)
                ->with("votos_introducidos_nyb",$votos_introducidos_nyb)
                ->with("foto_uninominales",$foto_uninominales);
        }
        else{
          return view("mensajes.msj_error")->with("msj","Ocurrio un error al subir la imagen");
        }
     }

    /*return view("formularios.form_votar_presidencial_subir_imagen")
          ->with("id_mesa",$request->id_mesa)
          ->with("codigo_mesas_oep",$codigo_mesas_oep);*/
  }
}
