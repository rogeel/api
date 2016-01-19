<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Models\Zonas;

/**
 * Class ZonasTransformer
 * @package namespace App\Transformers;
 */
class ZonasTransformer extends TransformerAbstract
{

    /**
     * Transform the \Zonas entity
     * @param \Zonas $model
     *
     * @return array
     */
    public function transform(Zonas $model)
    {
        return [
            'id'         => (int) $model->id_zona,
            'zona'         =>  $model->zona,
            'ciudad'     => $model->ciudad()->get()

            /* place your other model properties here */

        ];
    }
}
