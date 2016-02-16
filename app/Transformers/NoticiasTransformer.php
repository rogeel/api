<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Models\Noticias;

/**
 * Class NoticiasTransformer
 * @package namespace App\Transformers;
 */
class NoticiasTransformer extends TransformerAbstract
{

    /**
     * Transform the \Noticias entity
     * @param \Noticias $model
     *
     * @return array
     */
    public function transform(Noticias $model)
    {
        return [
            'id_noticia'         => (int) $model->id_noticia,
            'noticia'         => $model->estado,
            'fecha'         => $model->fecha,
            'desc_corta'         => $model->desc_corta,
            'descripcion'         => $model->descripcion,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
