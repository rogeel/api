<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Models\Ciudades;

/**
 * Class CiudadesTransformer
 * @package namespace App\Transformers;
 */
class CiudadesTransformer extends TransformerAbstract
{

    /**
     * Transform the \Ciudades entity
     * @param \Ciudades $model
     *
     * @return array
     */
    public function transform(Ciudades $model)
    {
        return [
            'id'         => (int) $model->id_ciudad,
            'ciudad'         =>  $model->ciudad,
            'zonas' => $model->zonas()->get()
        ];
    }
}
