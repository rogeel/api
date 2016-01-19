<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Models\Posiciones;

/**
 * Class PosicionesTransformer
 * @package namespace App\Transformers;
 */
class PosicionesTransformer extends TransformerAbstract
{

    /**
     * Transform the \Posiciones entity
     * @param \Posiciones $model
     *
     * @return array
     */
    public function transform(Posiciones $model)
    {
        return [
            'id'         => (int) $model->id_posicion,
            'posicion'         =>  $model->posicion,

          
        ];
    }
}
