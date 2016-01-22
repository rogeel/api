<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Models\Canchas;

/**
 * Class CanchasTransformer
 * @package namespace App\Transformers;
 */
class CanchasTransformer extends TransformerAbstract
{

    /**
     * Transform the \Canchas entity
     * @param \Canchas $model
     *
     * @return array
     */
    public function transform(Canchas $model)
    {
        return [
            'id'         => (int) $model->id_cancha,
            'cancha'         =>  $model->cancha,
            'ciudad'         =>  $model->ciudad()->get(),
            'lat'         =>  $model->lat,
            'lon'         =>  $model->lon,
            'dir'         =>  $model->dir,
            'telefono'         =>  $model->telefono,
            'email'         =>  $model->email,
            'zona' =>$model->zona()->get(),
            'horario' =>$model->horario,
            'horario_fin' =>$model->horario_fin,
            'servicios' =>$model->servicios,
            'tarifas' =>$model->tarifas,
            'campos' =>$model->campos()->get(),

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
