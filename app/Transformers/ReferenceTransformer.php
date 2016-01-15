<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Models\Reference;

/**
 * Class ReferenceTransformer
 * @package namespace App\Transformers;
 */
class ReferenceTransformer extends TransformerAbstract
{

    /**
     * Transform the \Reference entity
     * @param \Reference $model
     *
     * @return array
     */
    public function transform(Reference $model)
    {
        return [
            'id'         => (int) $model->id,
            'profile'     => $model->profile()->get(),
            'first_name'  => $model->first_name,
            'last_name'   => $model->last_name,
            'email'       => $model->email,
            'phone'       => $model->phone,
            'organization' => $model->organization,
            'job_title'  => $model->job_title,
            'gender'     => $model->gender,
            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
