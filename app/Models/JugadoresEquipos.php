<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class JugadoresEquipos extends Model implements Transformable
{
    use TransformableTrait;

    protected $table = 'jugadores_equipos';

    public $timestamps = false;

	

    protected $fillable = [
        'id_jugador', 'id_equipo', 'capitan', 'titular', 'id_posicion'
    ];

}
