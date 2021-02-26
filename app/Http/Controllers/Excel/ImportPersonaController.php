<?php

namespace App\Http\Controllers\Excel;

use App\User;
use App\Persona;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Validator;

class ImportPersonaController extends Controller
{
    function index()
    {
        // $data = User::orderBy('id', 'desc')->get();
        $data = Persona::with('usuario')->with('roles_persona')->get();
        return view('excel.persona.index', compact('data'));
    }

    function import(Request $request)
    {


        if($request->hasFile('select_file')){
            $path = $request->file('select_file')->getRealPath();
            $data = Excel::load($path, function($reader) {})->get();

            $cedula = $data->pluck('cedula')->toArray();
            if( count($cedula) != count(array_unique($cedula)) ){
                return back()->with('mensaje_error','Las cédulas de Identidad no deben estar repetidas.');
            }

            $insert_persona = array();
            $insert_usuario = array();
            $insert_role_user = array();
            $insert_user_mesa = array();
            $insert_user_recinto = array();
            $insert_user_distrito = array();


            $last_id_persona = Persona::all();

            if (count($last_id_persona)) {
                $last_id_persona = $last_id_persona->last()->id_persona;
            } else {
                $last_id_persona = 0;
            }

            $last_user_id = User::latest()->first()->id;
            if (!$last_user_id) {
                $last_user_id = 0;
            }
            
            foreach ($data->toArray() as $key => $value) {

                $reglas=[
                    'nombre'  => 'required',
                    'paterno' => 'required_without:materno',
                    'materno' => 'required_without:paterno',
                    'cedula'  => 'required|unique:personas,cedula_identidad'
                    ];
                    
                $mensajes=[
                    'nombre.required' => 'El campo nombre es obligatorio.',
                    'cedula.unique' => 'Una o más cédulas ya esta registradas en el Sistema.',
                ];
        
                $validator = Validator::make( $value,$reglas,$mensajes );
                if( $validator->fails() ){ 
                    return back()->with('mensaje_error','Revise los siguientes Datos.')
                  ->withErrors($validator)
                  ->withInput($request->flash());
                }

                $id_persona = $last_id_persona + $key + 1;
                $id_usuario = $last_user_id + $key + 1;

                // return $id_usuario;

                //Usuario
                $u = array();
                $u['id'] = $id_usuario;
                $u['name'] = $value['cedula'];
                $u['email'] = $value['cedula'];
                $u['password'] = bcrypt($value['cedula']);
                $u['id_persona'] = $id_persona;
                $u['activo'] = 1;
                array_push($insert_usuario, $u);

                //personas
                $p = array();
                $p['id_persona'] = $id_persona;
                $p['nombre'] = ucwords($value['nombre']);
                $p['paterno'] = ucwords($value['paterno']);
                $p['materno'] = ucwords($value['materno']);
                $p['cedula_identidad'] = $value['cedula'];
                $p['complemento_cedula'] = $value['comp_ci'];
                $p['expedido'] = $value['exp'];
                $p['fecha_nacimiento'] = $value['fecha_nac'];
                $p['telefono_celular'] = $value['celular'];
                $p['telefono_referencia'] = $value['telf_ref'];
                $p['email'] = $value['email'];
                $p['direccion'] = $value['direccion'];
                $p['grado_compromiso'] = 3;
                $p['fecha_registro'] = date('Y-m-d');
                $p['activo'] = 1;
                $p['asignado'] = 1;
                $p['id_recinto'] = $value['id_recinto'];
                $p['id_origen'] = $value['id_origen'];
                $p['id_sub_origen'] = $value['id_sub_origen'];
                $p['id_responsable_registro'] = Auth::id();
                $p['id_rol'] = $value['id_rol'];
                $p['titularidad'] = $value['titularidad'];
                $p['informatico'] = $value['informatico'];
                $p['militancia'] = $value['militancia'];
                array_push($insert_persona, $p);

                //role_user
                $role_user = array();
                $role_user['role_id'] = $value['id_rol'];
                $role_user['user_id'] = $id_usuario;
                array_push($insert_role_user, $role_user);

                if ($value['id_rol'] == 20) { //Reponsable Mesa
                    $usuario_mesa = array();
                    $usuario_mesa['id_usuario'] = $id_usuario;
                    $usuario_mesa['id_mesa'] = $value['id_mesa'];
                    $usuario_mesa['activo'] = 1;
                    array_push($insert_user_mesa, $usuario_mesa);
                }
                if ($value['id_rol'] == 21) { //Responsable Recinto
                    $usuario_recinto = array();
                    $usuario_recinto['id_usuario'] = $id_usuario;
                    $usuario_recinto['id_recinto'] = $value['id_recinto'];
                    $usuario_recinto['activo'] = 1;
                    array_push($insert_user_recinto, $usuario_recinto);
                }
                if ($value['id_rol'] == 22) { //Responsable Distrito
                    $usuario_distrito = array();
                    $usuario_distrito['id_usuario'] = $id_usuario;
                    $usuario_distrito['id_distrito'] = $value['id_distrito'];
                    $usuario_distrito['activo'] = 1;
                    array_push($insert_user_distrito, $usuario_distrito);
                }
            }
            
            // return $insert_usuario;
            if(!empty($insert_persona)){
                Persona::insert($insert_persona);

                if(!empty($insert_usuario)){
                    User::insert($insert_usuario);
                    \DB::table('role_user')->insert($insert_role_user);
                    if(!empty($insert_user_mesa)){
                        \DB::table('rel_usuario_mesa')->insert($insert_user_mesa);
                    }
                    if(!empty($insert_user_recinto)){
                        \DB::table('rel_usuario_recinto')->insert($insert_user_recinto);
                    }
                    if(!empty($insert_user_distrito)){
                        \DB::table('rel_usuario_distrito')->insert($insert_user_distrito);
                    }
                    return back()->with('mensaje_exito','Insert Record successfully.');
                }
            }


        }

    }
}
