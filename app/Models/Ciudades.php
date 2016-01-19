<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Ciudades extends Model implements Transformable
{
    use TransformableTrait;

    protected $fillable = [];

    protected $primaryKey = "id_ciudad";
	
    public function jugador() {
      return $this->hasMany('App\Models\User', 'id_ciudad', 'id_ciudad');
    }

    public function zonas() {
      return $this->hasMany('App\Models\Zonas', 'id_ciudad', 'id_ciudad');
    }

}
