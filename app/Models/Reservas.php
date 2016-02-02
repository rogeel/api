<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Reservas extends Model implements Transformable
{
    use TransformableTrait;

    protected $fillable = [];
    protected $primaryKey = "id_reserva";

}
