<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ciudades extends Model
{
    //
	protected $primaryKey = "id_ciudad";
	
    public function jugador() {
      return $this->hasMany('App\Models\User', 'id_ciudad', 'id_ciudad');
    }
}
