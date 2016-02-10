<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Models\Alertas;

/**
 * Class AlertasTransformer
 * @package namespace App\Transformers;
 */
class AlertasTransformer extends TransformerAbstract
{

    /**
     * Transform the \Alertas entity
     * @param \Alertas $model
     *
     * @return array
     */
    public function transform(Alertas $model)
    {
        return [
            'id'         => (int) $model->id_alerta,
            'jugador'    => $model->jugador()->get(),
            'estado'     => $model->estado,
            'id_tipo_alerta'     => (int)$model->id_tipo_alerta,
            'alerta' => $model->alerta,
            'alerta_app' => $model->alerta_app,
            'id_referencia' => $model->id_referencia,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
