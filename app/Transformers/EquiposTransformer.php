<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Models\Equipos;

/**
 * Class EquiposTransformer
 * @package namespace App\Transformers;
 */
class EquiposTransformer extends TransformerAbstract
{

    /**
     * Transform the \Equipos entity
     * @param \Equipos $model
     *
     * @return array
     */
    public function transform(Equipos $model)
    {
        return [
            'id'         => (int) $model->id_equipo,
            'equipo'         => $model->equipo,
            'cancha'         => $model->cancha,
            'sexo'         => $model->sexo,
            'ranking'         => $model->ranking,
            'camiseta'         => $model->camiseta,
            'camiseta1'         => $model->camiseta1,
            'pantaloneta'         => $model->pantaloneta,
            'pantaloneta1'         => $model->pantaloneta1,
            'ciudad' => $model->ciudad()->get(),
            'zona' => $model->zona()->get(),

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
