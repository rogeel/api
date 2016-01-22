<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Campos extends Model implements Transformable
{
    use TransformableTrait;

    protected $fillable = [];

    protected $primaryKey = "id_cancha";

}
