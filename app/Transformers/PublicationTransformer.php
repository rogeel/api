<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Models\Publication;

/**
 * Class PublicationTransformer
 * @package namespace App\Transformers;
 */
class PublicationTransformer extends TransformerAbstract
{

    /**
     * Transform the \Publication entity
     * @param \Publication $model
     *
     * @return array
     */
    public function transform(Publication $model)
    {
        return [
            'id'         => (int) $model->id,
            'profile_id' => (int) $model->profile_id,
            'title'      => $model->title,
            'publisher'  => $model->publisher,
            'year'       => $model->year
        ];
    }
}
