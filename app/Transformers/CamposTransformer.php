<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Models\Campos;

/**
 * Class CamposTransformer
 * @package namespace App\Transformers;
 */
class CamposTransformer extends TransformerAbstract
{

    /**
     * Transform the \Campos entity
     * @param \Campos $model
     *
     * @return array
     */
    public function transform(Campos $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
