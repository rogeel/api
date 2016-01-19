<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class JugadoresEquipos extends Model implements Transformable
{
    use TransformableTrait;

    protected $table = 'jugadores_equipos';

	protected $primaryKey = array('id_jugador', 'id_equipo');

    protected $fillable = [];

}
