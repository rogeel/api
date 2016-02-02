<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Models\Reservas;

/**
 * Class ReservasTransformer
 * @package namespace App\Transformers;
 */
class ReservasTransformer extends TransformerAbstract
{

    /**
     * Transform the \Reservas entity
     * @param \Reservas $model
     *
     * @return array
     */
    public function transform(Reservas $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
