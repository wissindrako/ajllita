<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mesa extends Model
{
    public $timestamps = false;
    protected $primaryKey = 'id_mesa';
    /**
     * Get the votos for the blog Mesa.
    */

    public function votos_presidenciales()
    {
        // return $this->hasMany('App\Comment', 'foreign_key', 'local_key');
        return $this->hasMany('App\Votos_Presidenciales', 'id_mesa', 'id_mesa');
    }

    /**
     * Obtener el recinto que tiene una Mesa
    */
    public function recinto()
    {
        // return $this->belongsTo('App\Post', 'foreign_key', 'other_key');
        return $this->belongsTo('App\Recinto', 'id_recinto', 'id_recinto');
    }

    /**
     * Obtener los blancos y nulos pertenecientes a una mesa.
    */

    public function votos_presidenciales_r()
    {
        // return $this->hasMany('App\Comment', 'foreign_key', 'local_key');
        return $this->hasOne('App\Votos_Presidenciales_r', 'id_mesa', 'id_mesa');
    }

}
