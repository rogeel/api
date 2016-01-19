<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Posiciones extends Model implements Transformable
{
    use TransformableTrait;

    protected $fillable = [];

    protected $primaryKey = "id_posicion";

    public function jugador() {
      return $this->hasMany('App\Models\User', 'id_posicion', 'id_posicion');
    }

}
