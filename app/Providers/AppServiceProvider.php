<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        view()->composer('*', function($view) {
            $personas = \DB::table('personal')
            ->join('users', 'personal.cedula', '=', 'users.ci')
            ->join('areas', 'personal.idarea', '=', 'areas.idarea')
            ->join('unidades', 'areas.idunidad', '=', 'unidades.id')
            ->select('users.id as id_usuario', 'users.nombre', 'users.paterno','users.materno', 'users.ci',
                    'areas.*', 'unidades.nombre as unidad', 'unidades.id as idunidad')
            ->get();
            $view->with('personas', $personas);
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
