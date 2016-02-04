<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Alertas extends Model implements Transformable
{
    use TransformableTrait;

    protected $fillable = ['id_jugador','estado','id_tipo_alerta'];

    protected $primaryKey = "id_alerta";

}
