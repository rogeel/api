<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Canchas extends Model implements Transformable
{
    use TransformableTrait;

    protected $primaryKey = "id_cancha";

    protected $fillable = [];

    public function campos(){
      return $this->hasMany('App\Models\Campos', 'id_cancha', 'id_cancha');
    }

    public function zona()
    {
      return $this->BelongsTo('App\Models\Zonas', 'id_zona', 'id_zona');
    }

    public function ciudad()
    {
      return $this->BelongsTo('App\Models\Ciudades', 'id_ciudad', 'id_ciudad');
    }

}
