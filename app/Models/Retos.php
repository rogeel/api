<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Retos extends Model implements Transformable
{
    use TransformableTrait;
    public $timestamps = false;
    protected $fillable = ['id_equipo','id_retador','id_reserva','mensaje','tipo','estado','fecha_registro','fecha','hora','lugar','id_jugador'];
    protected $primaryKey = "id_reto";

    public function equipo(){
      return $this->hasMany('App\Models\Equipos', 'id_equipo', 'id_equipo');
    }

    public function retador(){
      return $this->hasMany('App\Models\Equipos', 'id_equipo', 'id_retador');
    }

    public function reserva(){
      return $this->hasMany('App\Models\Reservas', 'id_reserva', 'id_reserva');
    }

}
