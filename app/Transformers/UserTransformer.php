<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Models\User;

/**
 * Class UserTransformer
 * @package namespace App\Transformers;
 */
class UserTransformer extends TransformerAbstract
{

    /**
     * Transform the \User entity
     * @param \User $model
     *
     * @return array
     */
    public function transform(User $model)
    {
         $response = [
            'id'          => (int) $model->id_jugador,
            'email'       => $model->email,
            'nombres'  => $model->nombres,
            'apellidos'   => $model->apellidos,
            'posicion' => $model->posicion()->get(),
            'ciudad' => $model->ciudad()->get(),
            'zona' => $model->zona()->get(),
            'f_nacimiento' => $model->f_nacimiento,
            'sexo' => $model->sexo,
            'descripcion' => $model->descripcion,
            'logros' => $model->logros,
            'fuerza' => $model->fuerza,
            'defensa' => $model->defensa,
            'resistencia' => $model->resistencia,
            'tecnica' => $model->tecnica,
            'ataque' => $model->ataque,
            'movil' => $model->movil,
            'app' =>$model->app


        ];

       

        return $response;
    }
}
