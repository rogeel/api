<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Models\Partidos;

/**
 * Class PartidosTransformer
 * @package namespace App\Transformers;
 */
class PartidosTransformer extends TransformerAbstract
{

    /**
     * Transform the \Partidos entity
     * @param \Partidos $model
     *
     * @return array
     */
    public function transform(Partidos $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
