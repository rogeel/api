<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Models\JugadoresEquipos;

/**
 * Class JugadoresEquiposTransformer
 * @package namespace App\Transformers;
 */
class JugadoresEquiposTransformer extends TransformerAbstract
{

    /**
     * Transform the \JugadoresEquipos entity
     * @param \JugadoresEquipos $model
     *
     * @return array
     */
    public function transform(JugadoresEquipos $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
