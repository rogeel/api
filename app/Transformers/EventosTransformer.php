<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Models\Eventos;

/**
 * Class EventosTransformer
 * @package namespace App\Transformers;
 */
class EventosTransformer extends TransformerAbstract
{

    /**
     * Transform the \Eventos entity
     * @param \Eventos $model
     *
     * @return array
     */
    public function transform(Eventos $model)
    {
        return [
            'id_evento'         => (int) $model->id_evento,
            'evento'         =>  $model->evento,
            'fecha'         => $model->fecha,
            'hora'         => $model->hora,
            'dir'         => $model->dir,
            'descripcion'         => $model->descripcion,
            'desc_larga'         => $model->desc_larga,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
