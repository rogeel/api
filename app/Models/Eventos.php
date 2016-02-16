<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Eventos extends Model implements Transformable
{
    use TransformableTrait;

    protected $primaryKey = "id_evento";

    protected $fillable = [];

}
