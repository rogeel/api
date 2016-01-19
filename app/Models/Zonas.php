<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Zonas extends Model implements Transformable
{
    use TransformableTrait;

    protected $fillable = [];

    protected $primaryKey = "id_zona";

    public function jugador() {
      return $this->hasMany('App\Models\User', 'id_zona', 'zona');
    }

    public function ciudad()
    {
      return $this->BelongsTo('App\Models\Ciudades', 'id_ciudad', 'id_ciudad');
    }

}
