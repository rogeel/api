<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Models\PartidosEquipos;

/**
 * Class PartidosEquiposTransformer
 * @package namespace App\Transformers;
 */
class PartidosEquiposTransformer extends TransformerAbstract
{

    /**
     * Transform the \PartidosEquipos entity
     * @param \PartidosEquipos $model
     *
     * @return array
     */
    public function transform(PartidosEquipos $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
