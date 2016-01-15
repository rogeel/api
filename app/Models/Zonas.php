<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Zonas extends Model
{
    //

    protected $primaryKey = "id_zona";

    public function jugador() {
      return $this->hasMany('App\Models\User', 'id_zona', 'zona');
    }
}
