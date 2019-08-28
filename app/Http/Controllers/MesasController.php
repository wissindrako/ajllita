<?php

namespace App\Http\Controllers;

use App\CasaCampana;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Caffeinated\Shinobi\Models\Role;
use Caffeinated\Shinobi\Models\Permission;
use Auth;
use Datatables;
use App\User;
use App\Persona;
use App\Recinto;
use App\Mesa;
use App\UsuarioMesa;
use App\UsuarioRecinto;
use App\UsuarioDistrito;
use App\UsuarioCircunscripcion;
use App\UsuarioTransporte;
use App\UsuarioCasaCampana;

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

        $circunscripciones = \DB::table('recintos')
        ->select('circunscripcion')
        ->distinct()
        ->orderBy('circunscripcion', 'asc')
        ->get();

        $roles = Role::all();

        $casas =  \DB::table('casas_campana')
        ->where('casas_campana.activo', 1)
        ->orderBy('circunscripcion', 'asc')
        ->orderBy('distrito', 'asc')
        ->orderBy('id_casa_campana', 'asc')
        ->get();

        $vehiculos = \DB::table('transportes')
        ->where('transportes.activo', 1)
        ->orderBy('id_transporte', 'asc')
        ->get();

        return view("formularios.form_asignar_usuario_mesa")
        ->with('circunscripciones', $circunscripciones)
        ->with('roles', $roles)
        ->with('casas', $casas)
        ->with('vehiculos', $vehiculos)
        ->with('persona', $persona);
    }

    public function listado_recintos_mesas(){

        return view("listados.listado_recintos_mesas");
    }
    
    public function buscar_recintos_mesas(){

        $mesas =\DB::table('mesas')       
        ->leftjoin('rel_usuario_mesa', 'mesas.id_mesa', 'rel_usuario_mesa.id_mesa')
        ->leftjoin('users', 'rel_usuario_mesa.id_usuario', 'users.id')
        ->leftjoin('personas', 'users.id_persona', 'personas.id_persona')
        ->leftjoin('recintos', 'mesas.id_recinto', 'recintos.id_recinto')
        // ->where('rel_usuario_mesa.id_usuario', 'users.id')
        // ->whereNotIn('mesas.id_mesa', $mesas_recinto)
        ->select('users.id as id_usuario',
            'rel_usuario_mesa.id_mesa as rel_idmesa', 'rel_usuario_mesa.activo as mesa_activa', 
                 'mesas.id_mesa', 'mesas.id_recinto', 'codigo_mesas_oep', 'mesas.codigo_ajllita',
                 'personas.direccion as direccion_persona',
                 \DB::raw('CONCAT("Cel. ", personas.telefono_celular," - ",personas.telefono_referencia) as contacto'),
                 \DB::raw('CONCAT(personas.paterno," ",personas.materno," ",personas.nombre) as nombre_completo'),
                 'recintos.circunscripcion', 'recintos.distrito', 'recintos.nombre as nombre_recinto', 'recintos.zona', 'recintos.direccion as direccion_recinto',
                )
        // ->orderBy('rel_usuario_mesa.activo', 'asc')
        ->orderBy('mesas.id_mesa', 'asc')
        // ->orderBy('recintos.circunscripcion', 'asc')
        // ->orderBy('recintos.distrito', 'asc')
        ->distinct()
        ->get();
        // dd($mesas);
        return Datatables::of($mesas)->make(true); 
    }

    public function consultaMesasRecinto($id_recinto, $id_persona){

        //Mesas Asignadas

        // $mesas_recinto =\DB::table('rel_usuario_mesa')
        // ->where('rel_usuario_mesa.activo', 0)
        // ->pluck('rel_usuario_mesa.id_mesa')
        // ->toArray();

        $mesas =\DB::table('mesas')
        ->leftjoin('rel_usuario_mesa', 'mesas.id_mesa', 'rel_usuario_mesa.id_mesa')
        ->leftjoin('users', 'rel_usuario_mesa.id_usuario', 'users.id')
        ->leftjoin('personas', 'users.id_persona', 'personas.id_persona')
        // ->where(function($query){
        //     $query
        //     ->where('rel_usuario_mesa.activo', null)
        //     ->orwhere('rel_usuario_mesa.activo', 1);
        // })
        ->where('mesas.id_recinto', $id_recinto)
        // ->whereNotIn('mesas.id_mesa', $mesas_recinto)
        ->select('users.id as id_usuario',
            'rel_usuario_mesa.id_mesa as rel_idmesa', 'rel_usuario_mesa.activo as mesa_activa', 
                 'mesas.id_mesa', 'mesas.id_recinto', 'codigo_mesas_oep', 'codigo_ajllita',
                 'personas.telefono_celular',
                 \DB::raw('CONCAT(personas.paterno," ",personas.materno," ",personas.nombre) as nombre_completo')
                )
        ->orderBy('mesas.id_mesa')
        ->distinct()
        ->get();

        // $mesas_recinto =\DB::table('rel_usuario_mesa')
        // ->where('rel_usuario_mesa.activo', 1)
        // ->pluck('rel_usuario_mesa.id_mesa')
        // ->toArray();

        // $mesas =\DB::table('mesas')
        // ->where('mesas.id_recinto', $id_recinto)
        // ->whereNotIn('id_mesa', $mesas_recinto)
        // ->select('id_mesa', 'codigo_mesas_oep', 'codigo_ajllita',  'id_recinto')
        // ->get();
        
        return $mesas;
    }

    public function asignar_usuario_mesa(Request $request){
        $persona = Persona::find($request->input("id_persona"));

        $username = $this->ObtieneUsuario($request->input("id_persona"));
        // $persona->id_rol =$request->input("id_rol");

        $usuario = \DB::table('users')
        ->where('id_persona', $request->input("id_persona"))
        ->first();

        if($request->input("rol_slug") == 'delegado_mas'){
            //rol delegado del MAS
            return 'delegado_mas';
        }elseif ($request->input("rol_slug") == 'conductor') {
            // rol Conductor
            if ($request->input("id_vehiculo") != "") {

                $user = false;
                if ($usuario != null) {
                    $user = true;
                    $usuario=User::find($usuario->id);
                }else {
                    $usuario=new User;
                    $usuario->id_persona=$request->input("id_persona");
                    $usuario->name=$username;
                    $usuario->email=strtolower($persona->nombre.$persona->paterno.$persona->materno).'@'.$username;
                    $usuario->password= bcrypt($username);
                    $usuario->id_persona=$request->input("id_persona");
                    $usuario->activo=1;
                    if ($usuario->save()) {
                        $user = true;
                    }
                }
    
                //Si el usuario es creado correctamente modificamos su rol
                if ($user) {
    
                    $rol = \DB::table('roles')
                    ->where('roles.slug', $request->input("rol_slug"))
                    ->first();
                        // $persona->id_rol =$request->input("id_rol");
                    $persona->id_rol =$rol->id;
                    $persona->asignado =1;
                    //Asignando rol
                    $usuario->assignRole($rol->id);
                    if ($persona->save()) {
                        // creamos las relaciones usuario - recinto
                        $usuario_transporte = new UsuarioTransporte();
                        $usuario_transporte->id_usuario = $usuario->id;
                        $usuario_transporte->id_transporte = $request->input("id_vehiculo");
                        $usuario_transporte->activo = 1;
                        if ($usuario_transporte->save()) {
                            return "ok";
                        } else {
                            # code...
                        }
                    } else {
                        // si no se guarda el update
                    }
                    
                } else {
                    //si el usuario no se guarda
                    return "failed usuario;";
                }
                
            } else {
                return "id_vehiculo";
            }
            // fin Conductor
        }elseif ($request->input("rol_slug") == 'registrador') {
            // rol Registrador
            if ($request->input("id_casa_campana") != "") {

                $user = false;
                if ($usuario != null) {
                    $user = true;
                    $usuario=User::find($usuario->id);
                }else {
                    $usuario=new User;
                    $usuario->id_persona=$request->input("id_persona");
                    $usuario->name=$username;
                    $usuario->email=strtolower($persona->nombre.$persona->paterno.$persona->materno).'@'.$username;
                    $usuario->password= bcrypt($username);
                    $usuario->id_persona=$request->input("id_persona");
                    $usuario->activo=1;
                    if ($usuario->save()) {
                        $user = true;
                    }
                }
    
                //Si el usuario es creado correctamente modificamos su rol
                if ($user) {
    
                    $rol = \DB::table('roles')
                    ->where('roles.slug', $request->input("rol_slug"))
                    ->first();
                        // $persona->id_rol =$request->input("id_rol");
                    $persona->id_rol =$rol->id;
                    $persona->asignado =1;
                    //Asignando rol
                    $usuario->assignRole($rol->id);

                    if ($persona->save()) {
                        // creamos las relaciones usuario - recinto
                        $usuario_casa_campana = new UsuarioCasaCampana();
                        $usuario_casa_campana->id_usuario = $usuario->id;
                        $usuario_casa_campana->id_casa_campana = $request->input("id_casa_campana");
                        $usuario_casa_campana->activo = 1;
                        if ($usuario_casa_campana->save()) {
                            return "ok";
                        } else {
                            # code...
                        }
                    } else {
                        // si no se guarda el update
                    }
                    
                } else {
                    //si el usuario no se guarda
                    return "failed usuario;";
                }
                
            } else {
                return "id_casa_campana";
            }
            // fin Registrador
        }elseif ($request->input("rol_slug") == 'call_center') {
            //rol 
            return 'call_center';
        }elseif ($request->input("rol_slug") == 'informatico') {
            //rol informatico
            if ($request->has("mesas")) {

                $user = false;
                if ($usuario != null) { //El usuario existe
                    $user = true;
                    $usuario=User::find($usuario->id);
                }else {
                    $usuario=new User;
                    $usuario->id_persona=$request->input("id_persona");
                    $usuario->name=$username;
                    $usuario->email=strtolower($persona->nombre.$persona->paterno.$persona->materno).'@'.$username;
                    $usuario->password= bcrypt($username);
                    $usuario->id_persona=$request->input("id_persona");
                    $usuario->activo=1;
                    if ($usuario->save()) {
                        $user = true;
                    }
                }
    
                //Si el usuario es creado correctamente modificamos su rol
                if ($user) {
    
                    $rol = \DB::table('roles')
                    ->where('roles.slug', $request->input("rol_slug"))
                    ->first();
    
                    $persona->id_rol =$rol->id;
                    $persona->asignado =1;
                    //Asignando rol
                    $usuario->assignRole($rol->id);
    
                    if ($persona->save()) {
                        // creamos las relaciones usuario - mesas
                        foreach ($request->mesas as $value) {
                            $usuario_mesa = new UsuarioMesa;
                            $usuario_mesa->id_usuario = $usuario->id;
                            $usuario_mesa->id_mesa = $value;
                            $usuario_mesa->activo = 1;
                            $usuario_mesa->save();
                        }
                        return "ok";
                    } else {
                        // si no se guarda el update
                    }
                    
                } else {
                    //si el usuario no se guarda
                    return "failed usuario;";
                }
                
            } else {
                return "mesas";
            }
        //fin rol informarico
        }elseif ($request->input("rol_slug") == 'responsable_recinto') {
            // rol responsable recinto
            if ($request->input("recinto") != "" && $request->input("recinto") != 0) {

                $user = false;
                if ($usuario != null) {
                    $user = true;
                    $usuario=User::find($usuario->id);
                }else {
                    $usuario=new User;
                    $usuario->id_persona=$request->input("id_persona");
                    $usuario->name=$username;
                    $usuario->email=strtolower($persona->nombre.$persona->paterno.$persona->materno).'@'.$username;
                    $usuario->password= bcrypt($username);
                    $usuario->id_persona=$request->input("id_persona");
                    $usuario->activo=1;
                    if ($usuario->save()) {
                        $user = true;
                    }
                }
    
                //Si el usuario es creado correctamente modificamos su rol
                if ($user) {
    
                    $rol = \DB::table('roles')
                    ->where('roles.slug', $request->input("rol_slug"))
                    ->first();
                        // $persona->id_rol =$request->input("id_rol");
                    $persona->id_rol =$rol->id;
                    $persona->asignado =1;
                    //Asignando rol
                    $usuario->assignRole($rol->id);

                    if ($persona->save()) {
                        // creamos las relaciones usuario - recinto
                        $usuario_recinto = new UsuarioRecinto;
                        $usuario_recinto->id_usuario = $usuario->id;
                        $usuario_recinto->id_recinto = $request->input("recinto");
                        $usuario_recinto->activo = 1;
                        if ($usuario_recinto->save()) {
                            return "ok";
                        } else {
                            # code...
                        }
                    } else {
                        // si no se guarda el update
                    }
                    
                } else {
                    //si el usuario no se guarda
                    return "failed usuario;";
                }
                
            } else {
                return "recinto";
            }
            // finresponsable recinto
        }elseif ($request->input("rol_slug") == 'responsable_distrito') {
            //rol Responsable de Distrito
            if ($request->input("distrito") != "" && $request->input("distrito") != 0) {

                $user = false;
                if ($usuario != null) {
                    $user = true;
                    $usuario=User::find($usuario->id);
                }else {
                    $usuario=new User;
                    $usuario->id_persona=$request->input("id_persona");
                    $usuario->name=$username;
                    $usuario->email=strtolower($persona->nombre.$persona->paterno.$persona->materno).'@'.$username;
                    $usuario->password= bcrypt($username);
                    $usuario->id_persona=$request->input("id_persona");
                    $usuario->activo=1;
                    if ($usuario->save()) {
                        $user = true;
                    }
                }
    
                //Si el usuario es creado correctamente modificamos su rol
                if ($user) {
    
                    $rol = \DB::table('roles')
                    ->where('roles.slug', $request->input("rol_slug"))
                    ->first();
                        // $persona->id_rol =$request->input("id_rol");
                    $persona->id_rol =$rol->id;
                    $persona->asignado =1;
                    //Asignando rol
                    $usuario->assignRole($rol->id);
    
                    if ($persona->save()) {
                        // creamos las relaciones usuario - recinto
                        $usuario_distrito = new UsuarioDistrito;
                        $usuario_distrito->id_usuario = $usuario->id;
                        $usuario_distrito->id_distrito = $request->input("distrito");
                        $usuario_distrito->activo = 1;
                        if ($usuario_distrito->save()) {
                            return "ok";
                        } else {
                            # code...
                        }
                    } else {
                        // si no se guarda el update
                    }
                    
                } else {
                    //si el usuario no se guarda
                    return "failed usuario;";
                }
                
            } else {
                return "distrito";
            }
            //fin Responsable de Distrito
        }elseif ($request->input("rol_slug") == 'responsable_circunscripcion') {
            //rol Responsable Circunscripcion
            if ($request->input("circunscripcion") != "" && $request->input("circunscripcion") != 0) {

                $user = false;
                if ($usuario != null) {
                    $user = true;
                    $usuario=User::find($usuario->id);
                }else {
                    $usuario=new User;
                    $usuario->id_persona=$request->input("id_persona");
                    $usuario->name=$username;
                    $usuario->email=strtolower($persona->nombre.$persona->paterno.$persona->materno).'@'.$username;
                    $usuario->password= bcrypt($username);
                    $usuario->id_persona=$request->input("id_persona");
                    $usuario->activo=1;
                    if ($usuario->save()) {
                        $user = true;
                    }
                }
    
                //Si el usuario es creado correctamente modificamos su rol
                if ($user) {
    
                    $rol = \DB::table('roles')
                    ->where('roles.slug', $request->input("rol_slug"))
                    ->first();
                        // $persona->id_rol =$request->input("id_rol");
                    $persona->id_rol =$rol->id;
                    $persona->asignado =1;
                    //Asignando rol
                    $usuario->assignRole($rol->id);

                    if ($persona->save()) {
                        // creamos las relaciones usuario - recinto
                        $usuario_circunscripcion = new UsuarioCircunscripcion;
                        $usuario_circunscripcion->id_usuario = $usuario->id;
                        $usuario_circunscripcion->id_circunscripcion = $request->input("circunscripcion");
                        $usuario_circunscripcion->activo = 1;
                        if ($usuario_circunscripcion->save()) {
                            return "ok";
                        } else {
                            # code...
                        }
                    } else {
                        // si no se guarda el update
                    }
                    
                } else {
                    //si el usuario no se guarda
                    return "failed usuario;";
                }
                
            } else {
                return "circunscripcion";
            }
            // fin Responsable Circunscripcion
        }else{

        }
        
    }

    public function liberar_responsabilidad(Request $request){

        //Obteniendo los datos de la persona
        $persona = Persona::find($request->input("id_persona"));
        
        // Obteniendo los datos del Usuario segun el id_persona
        $usuario = \DB::table('users')
        ->where('id_persona', $request->input('id_persona'))
        ->first();
        
        $usuario=User::find($usuario->id);

        $rol = \DB::table('roles')
        ->where('roles.id', $persona->id_rol)
        ->first();

        $usuario->revokeRole($rol->id);
        //$usuario->assignRole(15); //Delegado del Mas

        if ($rol->slug == 'delegado_mas') {
            # code...
        }elseif ($rol->slug == 'conductor') {
            // Rol Conductor
                $persona->asignado = 0;
                if ($persona->save()) {
                    return 'ok';
                } else {
                    return 'failed_persona';
                }
            // Fin Conductor
        }elseif ($rol->slug == 'registrador') {
            # code...
            $persona->asignado = 0;
            if ($persona->save()) {
                return 'ok';
            } else {
                return 'failed_persona';
            }
        }elseif ($rol->slug == 'call_center') {
            # code...
            $persona->asignado = 0;
            if ($persona->save()) {
                return 'ok';
            } else {
                return 'failed_persona';
            }
        }elseif ($rol->slug == 'informatico') {
            // Rol informatico
            if (UsuarioMesa::where('id_usuario', $usuario->id)
            ->update(array('activo' => 0))) {
                // $user = User::find($usuario->id);
                // $user->activo = 0;
                // if ($user->save()) {
                //     return 'ok';
                // } else {
                //     return 'failed_usuario';
                // }
                $persona->asignado = 0;
                if ($persona->save()) {
                    return 'ok';
                } else {
                    return 'failed_persona';
                }
            } else {
                return 'failed_usuario_mesas';
            }
            //Fin informatico
        }elseif ($rol->slug == 'responsable_recinto') {
            # code...
            $persona->asignado = 0;
            if ($persona->save()) {
                return 'ok';
            } else {
                return 'failed_persona';
            }
        }elseif ($rol->slug == 'responsable_distrito') {
            # code...
            $persona->asignado = 0;
            if ($persona->save()) {
                return 'ok';
            } else {
                return 'failed_persona';
            }
        }elseif ($rol->slug == 'responsable_circunscripcion') {
            # code...
            $persona->asignado = 0;
            if ($persona->save()) {
                return 'ok';
            } else {
                return 'failed_persona';
            }
        }else {
            return 'failed';
        }

    }

    public function form_ver_recinto(){
        
        $id_persona = Auth::user()->id_persona;
        $persona = Persona::find($id_persona);
        $recinto = Recinto::find($persona->id_recinto);
        $rol = Role::find($persona->id_rol);

        return view("formularios.form_ver_recinto")
        ->with('persona', $persona)
        ->with('recinto', $recinto)
        ->with('rol', $rol);
    }

    public function form_mesas_recinto(){
        return view("formularios.form_mesas_recinto");
    }

    public function asignar_mesas_recinto(){
        $recintos = Recinto::all();
        $mesas = Mesa::all();
        if(count($mesas) == 0){
            $codigo = 0;
            foreach ($recintos as $recinto) {
                $a = 0;
                while ($a < $recinto->numero_mesas) {
                    $codigo++;
                    $a++;
                    $mesa = new Mesa;
                    $mesa->codigo_mesas_oep = $codigo;
                    $mesa->codigo_ajllita = $codigo;
                    $mesa->foto_presidenciales = '';
                    $mesa->foto_uninominales = '';
                    $mesa->numero_votantes = 500; // *** ACTUALIZAR DE ACUERDO AL NUMERO DE VOTANTES POR MESA ***
                    $mesa->id_recinto = $recinto->id_recinto;
                    $mesa->save();
                }
            }
            return "ok";
        }else{
            return "Existen mesas";
        }
    }

    public function ObtieneUsuario($id_persona){
        $persona = Persona::find($id_persona);
    
        $ci = $persona->cedula_identidad.$persona->complemento_cedula;
        $numero = 0;
        $username = $ci;
        while (User::where('name', '=', $username)->exists()) { // user found 
            $username=$username+$numero;
            $numero++;
        }
    
        //Quitar espacios en blanco
        $username = str_replace(' ', '', $username); 
        return $username;
    }

}
