<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Posiciones extends Model
{
    //

    protected $primaryKey = "id_posicion";

    public function jugador() {
      return $this->hasMany('App\Models\User', 'id_posicion', 'id_posicion');
    }
}
