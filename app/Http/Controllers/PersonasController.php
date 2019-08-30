<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Datatables;
use Auth;
use App\Persona;

class PersonasController extends Controller
{
    
    public function form_agregar_persona(){
        //carga el formulario para agregar un nueva persona

        $circunscripciones = \DB::table('recintos')
        ->select('circunscripcion')
        ->distinct()
        ->orderBy('circunscripcion', 'asc')
        ->get();

        $origenes = \DB::table('origen')
        ->where('activo', 1)
        ->get();

        $roles = \DB::table('roles')
        ->where('id', '>=', 15)
        ->get();

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


        return view("formularios.form_agregar_persona")
        ->with('circunscripciones', $circunscripciones)
        ->with('origenes', $origenes)
        ->with('roles', $roles)
        ->with('casas', $casas)
        ->with('vehiculos', $vehiculos);
    }

    public function agregar_persona(Request $request){

    // $reglas=[  'nombres' => 'required',
    //     'paterno' => 'required_without:materno',
    //     'materno' => 'required_without:paterno',
    //     'cedula' => 'required|unique:personas,cedula_identidad',
    //     'nacimiento' => 'required',
    //     'telefono' => 'required|numeric',
    //     'telefono_ref' => 'required|numeric',
    //     'direccion' => 'required',
    //     'recinto' => 'required',

    //  ];

    //     $mensajes=['nombre.required' => 'El nombre es obligatorio',
    //         'paterno.required' => 'El apellido es obligatorio',
    //         'materno.required' => 'El apellido es obligatorio',
    //         'ci.required' => 'El C.I. es obligatorio',
    //         'ci.unique' => 'El C.I. ya se encuentra registrado',
    //         'telefono.numeric' => 'El telefono debe contener solo numeros',
    //         'telefono_ref.numeric' => 'El telefono debe contener solo numeros',
    //         'password.min' => 'El password debe tener al menos 4 caracteres',
    //         'email.unique' => 'El email ya se encuentra registrado en la base de datos',
    //         ];

    //     $validator = Validator::make( $request->all(),$reglas,$mensajes );
    //     if( $validator->fails() ){ 

    //         $circunscripciones = \DB::table('recintos')
    //         ->select('circunscripcion')
    //         ->distinct()
    //         ->get();
    
    //         $origenes = \DB::table('origen')
    //         ->where('activo', 1)
    //         ->get();
    //         return view("formularios.form_agregar_persona")
    //         ->with('circunscripciones', $circunscripciones)
    //         ->with('origenes', $origenes)
    //         ->withErrors($validator)
    //         ->withInput($request->flash());         
    //     }


        $cedulas = \DB::table('personas')
        ->select('cedula_identidad')
        ->where('cedula_identidad', $request->input("cedula"))
        ->where('complemento_cedula', $request->input("complemento"))
        ->distinct()
        ->get();

        if ($request->paterno == "" && $request->materno == "") {
            return "apellido";
        }else{
            if (count($cedulas) > 0) {
                return "cedula_repetida";
            }else{
                if($request->recinto != ""){
                    $persona=new Persona;
                    $persona->nombre=strtoupper($request->input("nombres"));
                    $persona->paterno=strtoupper($request->input("paterno"));
                    $persona->materno=strtoupper($request->input("materno"));
                    $persona->cedula_identidad=$request->input("cedula");
                    $persona->complemento_cedula=strtoupper($request->input("complemento"));
                    $persona->expedido=$request->input("expedido");
                    $persona->fecha_nacimiento=$request->input("nacimiento");
                    $persona->telefono_celular=$request->input("telefono");
                    $persona->telefono_referencia=$request->input("telefono_ref");
                    $persona->direccion=$request->input("direccion");
                    $persona->email=$request->input("email");
                    $persona->grado_compromiso=$request->input("grado_compromiso");
                    $persona->fecha_registro=date('Y-m-d');
                    $persona->activo=1;
                    $persona->asignado=1;
                    $persona->id_recinto=$request->input("recinto");
                    $persona->id_origen=$request->input("id_origen");
                    $persona->id_sub_origen=$request->input("id_sub_origen");
                    $persona->id_responsable_registro=Auth::user()->id;

                    $persona->id_rol=15;
    
                    if($persona->save())
                    {

                        $username = $this->ObtieneUsuario($persona->id_persona);
                        // $persona->id_rol =$request->input("id_rol");
                
                        $usuario=new User;
                        $usuario->id_persona=$request->input("id_persona");
                        $usuario->name=$username;
                        $usuario->email=strtolower($persona->nombre.$persona->paterno.$persona->materno).'@'.$username;
                        $usuario->password= bcrypt($username);
                        $usuario->id_persona=$request->input("id_persona");
                        $usuario->activo=1;
                
                        if($request->input("rol_slug") == 'militante'){
                            //rol delegado del MAS
                            return 'militante';
                        }elseif ($request->input("rol_slug") == 'conductor') {
                            // rol Conductor
                            if ($request->input("id_vehiculo") != "") {
                                //Si el usuario es creado correctamente modificamos su rol

                                if ($usuario->save()) {
                    
                                    $rol = \DB::table('roles')
                                    ->where('roles.slug', $request->input("rol_slug"))
                                    ->first();
                                        // $persona->id_rol =$request->input("id_rol");
                                    $persona->id_rol = $rol->id;
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
                
                                //Si el usuario es creado correctamente modificamos su rol
                                if ($usuario->save()) {
                    
                                    $rol = \DB::table('roles')
                                    ->where('roles.slug', $request->input("rol_slug"))
                                    ->first();

                                    // $persona->id_rol =$request->input("id_rol");
                                    $persona->id_rol = $rol->id;

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
                            //rol Call Center
                            //Si el usuario es creado correctamente modificamos su rol
                            if ($usuario->save()) {

                                $rol = \DB::table('roles')
                                ->where('roles.slug', $request->input("rol_slug"))
                                ->first();

                                // Cambiando el rol de persona
                                $persona->id_rol = $rol->id;
                                //Asignando rol
                                $usuario->assignRole($rol->id);
            
                                if ($persona->save()) {
                                    return "ok";
                                } else {
                                    // si no se guarda el update
                                }
                                
                            } else {
                                //si el usuario no se guarda
                                return "failed usuario;";
                            }
                        }elseif ($request->input("rol_slug") == 'responsable_mesa'){
                            //rol responsable_mesa
                            if ($request->has("mesas")) {
                
                                //Si el usuario es creado correctamente modificamos su rol
                                if ($usuario->save()) {
                    
                                    $rol = \DB::table('roles')
                                    ->where('roles.slug', $request->input("rol_slug"))
                                    ->first();
                    
                                    $persona->id_rol =$rol->id;
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
                                    
                                //Si el usuario es creado correctamente modificamos su rol
                                if ($usuario->save()) {
                    
                                    $rol = \DB::table('roles')
                                    ->where('roles.slug', $request->input("rol_slug"))
                                    ->first();

                                    // $persona->id_rol =$request->input("id_rol");
                                    $persona->id_rol =$rol->id;
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
                
                                //Si el usuario es creado correctamente modificamos su rol
                                if ($usuario->save()) {
                    
                                    $rol = \DB::table('roles')
                                    ->where('roles.slug', $request->input("rol_slug"))
                                    ->first();
                                        // $persona->id_rol =$request->input("id_rol");
                                    $persona->id_rol =$rol->id;
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
                    
                                //Si el usuario es creado correctamente modificamos su rol
                                if ($usuario->save()) {

                                    $rol = \DB::table('roles')
                                    ->where('roles.slug', $request->input("rol_slug"))
                                    ->first();
                                        // $persona->id_rol =$request->input("id_rol");
                                    $persona->id_rol =$rol->id;
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

                        return view("mensajes.msj_enviado")->with("msj","enviado_crear_persona");
                    }else{
                        return "failed";
                    }
                }
                else{
                    return "recinto";
                }
            }
        }
    }


    public function form_editar_persona($id_persona){
        //carga el formulario para agregar un nueva persona

        // $persona = Persona::find($id_persona);
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

        $circunscripcion = \DB::table('recintos')
        ->where('id_recinto', $persona->id_recinto)
        ->select('circunscripcion')
        ->distinct()
        ->first();

        $distrito = \DB::table('recintos')
        ->where('id_recinto', $persona->id_recinto)
        ->select('distrito')
        ->distinct()
        ->first();

        $circunscripciones = \DB::table('recintos')
        ->select('circunscripcion')
        ->distinct()
        ->orderBy('circunscripcion', 'asc')
        ->get();
        
        $distritos = \DB::table('recintos')
        ->where('circunscripcion', $circunscripcion->circunscripcion)
        ->select('distrito')
        ->distinct()
        ->orderBy('distrito', 'asc')
        ->get();

        $recintos = \DB::table('recintos')
        ->where('circunscripcion', $circunscripcion->circunscripcion)
        ->where('distrito', $distrito->distrito)
        ->select('id_recinto', 'nombre as nombre_recinto')
        // ->distinct()
        ->orderBy('id_recinto', 'asc')
        ->get();

        $origenes = \DB::table('origen')
        ->where('activo', 1)
        ->get();

        $sub_origenes = \DB::table('sub_origen')
        ->where('id_origen', $persona->id_origen)
        ->where('activo', 1)
        ->get();

        return view("formularios.form_editar_persona")
        ->with('persona', $persona)
        ->with('circunscripciones', $circunscripciones)
        ->with('distritos', $distritos)
        ->with('recintos', $recintos)
        ->with('origenes', $origenes)
        ->with('sub_origenes', $sub_origenes);
    }

    public function editar_persona(Request $request){

        $id_persona = $request->input("id_persona");
        $persona = Persona::find($id_persona);
        
        if ($request->input("cedula") != $persona->cedula_identidad || $request->input("complemento") != $persona->complemento_cedula) {
            $cedulas = \DB::table('personas')
            ->select('cedula_identidad')
            ->where('cedula_identidad', $request->input("cedula"))
            ->where('complemento_cedula', $request->input("complemento"))
            ->distinct()
            ->get();
        }else{
            $cedulas = [];
        }


        if ($request->paterno == "" && $request->materno == "") {
            return "apellido";
        }else{
            if (count($cedulas) > 0) {
                return "cedula_repetida";
            }else{
                if($request->recinto != ""){
                    $persona->nombre=strtoupper($request->input("nombres"));
                    $persona->paterno=strtoupper($request->input("paterno"));
                    $persona->materno=strtoupper($request->input("materno"));
                    $persona->cedula_identidad=$request->input("cedula");
                    $persona->complemento_cedula=strtoupper($request->input("complemento"));
                    $persona->expedido=$request->input("expedido");
                    $persona->fecha_nacimiento=$request->input("nacimiento");
                    $persona->telefono_celular=$request->input("telefono");
                    $persona->telefono_referencia=$request->input("telefono_ref");
                    $persona->direccion=$request->input("direccion");
                    $persona->email=$request->input("email");
                    $persona->grado_compromiso=$request->input("grado_compromiso");
                    $persona->fecha_registro=date('Y-m-d');
                    $persona->activo=1;
                    $persona->id_recinto=$request->input("recinto");
                    $persona->id_origen=$request->input("id_origen");
                    $persona->id_sub_origen=$request->input("id_sub_origen");
                    $persona->id_responsable_registro=Auth::user()->id;

                    $persona->id_rol=15;

                    if($persona->save())
                    {
                        return view("mensajes.msj_enviado")->with("msj","enviado_editar_persona");
                    }else{
                        return "failed";
                    }
                }
                else{
                    return "recinto";
                }
            }
        }
    }

    public function form_baja_persona($id_persona){
        //carga el formulario para agregar un nueva persona

        $persona = Persona::find($id_persona);

        return view("formularios.form_baja_persona")
        ->with('persona', $persona);
    }

    public function baja_persona(Request $request){
        $id_persona = $request->input("id_persona");
        $persona = Persona::find($id_persona);
        $persona->activo = 0;

        if ($persona->save()) {
            return "ok";
        } else {
            return "failed";
        }
    }

    public function listado_personas_asignacion(){
        $personas = [];
        return view("listados.listado_personas_asignacion")
        ->with('personas', $personas);
    }
    
    // public function buscar_persona_asignacion(Request $request){
    //     $dato = $request->input("dato_buscado");
    //     $personas = Persona::join('recintos', 'personas.id_recinto', 'recintos.id_recinto')
    //     ->leftjoin('users', 'personas.id_persona', 'users.id_persona')
    //     ->join('origen', 'personas.id_origen', 'origen.id_origen')
    //     ->leftjoin('sub_origen', 'personas.id_sub_origen', 'sub_origen.id_sub_origen')
    //     ->leftjoin('roles', 'personas.id_rol', 'roles.id')
    //     ->where("personas.nombre","like","%".$dato."%")
    //     ->orwhere("paterno","like","%".$dato."%")
    //     ->orwhere("materno","like","%".$dato."%")
    //     ->orwhere("cedula_identidad","like","%".$dato."%")
    //     ->orwhere("roles.slug","like","%".$dato."%")
    //     ->select('personas.*', 'recintos.id_recinto', 'recintos.nombre as nombre_recinto', 'recintos.circunscripcion', 'recintos.distrito',
    //     'recintos.zona', 'recintos.direccion as direccion_recinto',
    //     'origen.origen', 'sub_origen.nombre as sub_origen',
    //     'roles.name as nombre_rol',
    //     'users.activo as usuario_activo', 'users.name as codigo_usuario'
    //     )
    //     ->orderBy('id_persona', 'desc')
    //     // ->paginate(30);
    //     // return view('listados.listado_personas_asignacion')->with("personas",$personas);
    //     ->get();
    //     return $personas;
    // }

    public function buscar_persona_asignacion(){
        return Datatables::of(Persona::join('recintos', 'personas.id_recinto', 'recintos.id_recinto')
        ->leftjoin('users', 'personas.id_persona', 'users.id_persona')
        ->join('origen', 'personas.id_origen', 'origen.id_origen')
        ->leftjoin('sub_origen', 'personas.id_sub_origen', 'sub_origen.id_sub_origen')
        ->leftjoin('roles', 'personas.id_rol', 'roles.id')
        ->select('personas.*', 'recintos.id_recinto', 'recintos.nombre as nombre_recinto', 'recintos.circunscripcion', 'recintos.distrito',
        'recintos.zona', 'recintos.direccion as direccion_recinto',
        'origen.origen', 'sub_origen.nombre as sub_origen',
        'roles.name as nombre_rol',
        'users.activo as usuario_activo', 'users.name as codigo_usuario'
        )
        ->get())->make(true);
    }

    public function listado_personas(){
        $personas = \DB::table('personas')
        ->join('recintos', 'personas.id_recinto', 'recintos.id_recinto')
        ->join('origen', 'personas.id_origen', 'origen.id_origen')
        ->leftjoin('sub_origen', 'personas.id_sub_origen', 'sub_origen.id_sub_origen')
        ->leftjoin('roles', 'personas.id_rol', 'roles.id')
        ->select('personas.*', 'recintos.id_recinto', 'recintos.nombre as nombre_recinto', 'recintos.circunscripcion', 'recintos.distrito',
                 'recintos.zona', 'recintos.direccion as direccion_recinto',
                 'origen.origen', 'sub_origen.nombre as sub_origen',
                 'roles.name as nombre_rol'
        )
        ->orderBy('fecha_registro', 'desc')
        ->orderBy('id_persona', 'desc')
        ->get();
        return view("listados.listado_personas")
        ->with('personas', $personas);
    }
    
    // public function buscar_persona(Request $request){
    //     $dato = $request->input("dato_buscado");
    //     $personas = Persona::join('recintos', 'personas.id_recinto', 'recintos.id_recinto')
    //     ->join('origen', 'personas.id_origen', 'origen.id_origen')
    //     ->leftjoin('sub_origen', 'personas.id_sub_origen', 'sub_origen.id_sub_origen')
    //     ->leftjoin('roles', 'personas.id_rol', 'roles.id')
    //     ->where("personas.nombre","like","%".$dato."%")
    //     ->orwhere("paterno","like","%".$dato."%")
    //     ->orwhere("materno","like","%".$dato."%")
    //     ->orwhere("cedula_identidad","like","%".$dato."%")
    //     ->select('personas.*', 'recintos.id_recinto', 'recintos.nombre as nombre_recinto', 'recintos.circunscripcion', 'recintos.distrito',
    //     'recintos.zona', 'recintos.direccion as direccion_recinto',
    //     'origen.origen', 'sub_origen.nombre as sub_origen',
    //     'roles.name as nombre_rol'
    //     )
    //     ->orderBy('fecha_registro', 'desc')
    //     ->orderBy('id_persona', 'desc')
    //     ->paginate(100);
    //     return view('listados.listado_personas')->with("personas",$personas);
    // }

    public function buscar_persona(){
        return Datatables::of(Persona::join('recintos', 'personas.id_recinto', 'recintos.id_recinto')
        ->join('origen', 'personas.id_origen', 'origen.id_origen')
        ->leftjoin('sub_origen', 'personas.id_sub_origen', 'sub_origen.id_sub_origen')
        ->leftjoin('roles', 'personas.id_rol', 'roles.id')
        ->select('personas.*', 'recintos.id_recinto', 'recintos.nombre as nombre_recinto', 'recintos.circunscripcion', 'recintos.distrito',
        'recintos.zona', 'recintos.direccion as direccion_recinto',
        'origen.origen', 'sub_origen.nombre as sub_origen',
        'roles.name as nombre_rol'
        )
        ->get())->make(true);
    }

    public function ConsultaSubOrigen($id_origen){
        $sub_origenes = \DB::table('sub_origen')
        ->where('id_origen', $id_origen)
        ->where('activo', 1)
        // ->distinct()
        ->get();
        return $sub_origenes;
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
