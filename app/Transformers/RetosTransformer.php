<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Models\Retos;

/**
 * Class RetosTransformer
 * @package namespace App\Transformers;
 */
class RetosTransformer extends TransformerAbstract
{

    /**
     * Transform the \Retos entity
     * @param \Retos $model
     *
     * @return array
     */
    public function transform(Retos $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
