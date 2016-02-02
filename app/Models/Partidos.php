<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Partidos extends Model implements Transformable
{
    use TransformableTrait;

    protected $primaryKey = "id_partido";
    protected $fillable = ['fecha','horario','cancha','estado','tipo','fecha_verificacion','id_verificacion','motivo_rechazo'];


}
