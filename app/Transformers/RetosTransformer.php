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
            'id'         => (int) $model->id_reto,
            'equipo'    => $model->equipo()->get(),
            'retador'    => $model->retador()->get(),
            'reserva'    => $model->reserva()->get(),
            'mensaje'         => $model->mensaje,
            'tipo'    => $model->tipo,
            'estado'    => $model->estado,
            'fecha_registro'    => $model->fecha_registro,
            'fecha'    => $model->fecha,
            'hora'    => $model->hora,
            'lugar' => $model->lugar
            
        ];
    }
}
