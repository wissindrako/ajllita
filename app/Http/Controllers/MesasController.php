<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Caffeinated\Shinobi\Models\Role;
use Caffeinated\Shinobi\Models\Permission;
use App\User;
use App\Persona;
use App\UsuarioMesa;

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

        return view("formularios.form_asignar_usuario_mesa")
        ->with('circunscripciones', $circunscripciones)
        ->with('roles', $roles)
        ->with('persona', $persona);
    }

    public function consultaMesasRecinto($id_recinto){

        //Mesas Asignadas

        $mesas_recinto =\DB::table('mesas')
        ->leftjoin('rel_usuario_mesa', 'mesas.id_mesa', 'rel_usuario_mesa.id_mesa')
        ->where(function($query){
            $query
            ->where('rel_usuario_mesa.activo', null)
            ->orwhere('rel_usuario_mesa.activo', 0);
        })
        ->where('mesas.id_recinto', $id_recinto)
        ->select('rel_usuario_mesa.id_mesa as rel_idmesa', 'rel_usuario_mesa.activo', 
                 'mesas.id_mesa', 'mesas.id_recinto', 'codigo_mesas_oep', 'codigo_ajllita')
        ->orderBy('mesas.id_mesa')
        ->get();
        
        return $mesas_recinto;
    }

    public function asignar_usuario_mesa(Request $request){
        if ($request->has("mesas")) {

            $usuario=new User;
            $usuario->id_persona=$request->input("id_persona");
            $usuario->name=$request->input("username");
            $usuario->email=$request->input("username");
            $usuario->password= bcrypt($request->input("password"));
            $usuario->id_persona=$request->input("id_persona");
            $usuario->activo=1;
            
            // $mesas_join = "";

            // foreach ($request->mesas as $value) {
            //     $mesas_join = $mesas_join.$value;
            // }

            //Si el usuario es creado correctamente modificamos su rol
            if ($usuario->save()) {

                $rol = \DB::table('roles')
                ->where('roles.slug', $request->input("rol_slug"))
                ->first();


                $persona = Persona::find($request->input("id_persona"));
                $persona->id_rol =$request->input("id_rol");

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
        
        
    }
}
