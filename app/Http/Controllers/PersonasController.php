<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Auth;
use App\Persona;

class PersonasController extends Controller
{
    
    public function form_agregar_persona(){
        //carga el formulario para agregar un nueva persona

        $circunscripciones = \DB::table('recintos')
        ->select('circunscripcion')
        ->distinct()
        ->get();

        $origenes = \DB::table('origen')
        ->where('activo', 1)
        ->get();
        return view("formularios.form_agregar_persona")
        ->with('circunscripciones', $circunscripciones)
        ->with('origenes', $origenes);
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
                    $persona->id_recinto=$request->input("recinto");
                    $persona->id_origen=$request->input("id_origen");
                    $persona->id_sub_origen=$request->input("id_sub_origen");
                    $persona->id_responsable_registro=Auth::user()->id;
                    $persona->id_rol=16;
    
                    if($persona->save())
                    {
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

    public function ConsultaSubOrigen($id_origen){
        $sub_origenes = \DB::table('sub_origen')
        ->where('id_origen', $id_origen)
        ->where('activo', 1)
        // ->distinct()
        ->get();
        
        return $sub_origenes;
    }
}
