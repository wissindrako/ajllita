<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Auth;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('*', function($view) {
        if (Auth::guest()) {
            $personas_logueadas = [];
        } else {

            $personas_logueadas = \DB::table('users')
            ->leftjoin('personas', 'users.id_persona', 'personas.id_persona')
            ->leftjoin('recintos', 'personas.id_recinto', 'recintos.id_recinto')
            ->where('users.id', Auth::user()->id)
            ->select('users.id as id_usuario', 'users.name',
            'personas.telefono_celular', 'personas.nombre', 'personas.paterno', 'personas.materno',
            \DB::raw('CONCAT(personas.cedula_identidad,personas.complemento_cedula) as ci'),
            \DB::raw('CONCAT(personas.paterno," ",personas.materno," ",personas.nombre) as nombre_completo')
            )
            ->first();
        }
        $view->with('personas_logueadas', $personas_logueadas);
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}

