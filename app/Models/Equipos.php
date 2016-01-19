<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Equipos extends Model implements Transformable
{
    use TransformableTrait;

    protected $table = 'equipos';
	 protected $primaryKey = "id_equipo";

	protected $fillable = [
        'equipo', 'cancha', 'camiseta', 'camiseta1', 'pantaloneta', 'pantaloneta1', 'id_ciudad', 'id_zona', 'ranking', 'categoria', 'sexo'
    ];
	
    public function jugadores(){
      return $this->belongsToMany('App\Models\User', 'jugadores_equipos', 'id_jugador', 'id_equipo');
    }

    public function ciudad()
    {
      return $this->BelongsTo('App\Models\Ciudades', 'id_ciudad', 'id_ciudad');
    }

    public function zona()
    {
      return $this->BelongsTo('App\Models\Zonas', 'id_zona', 'id_zona');
    }

}
