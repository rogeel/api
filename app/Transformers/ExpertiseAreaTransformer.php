<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Models\ExpertiseAreas;

/**
 * Class ExpertiseAreaTransformer
 * @package namespace App\Transformers;
 */
class ExpertiseAreaTransformer extends TransformerAbstract
{

    /**
     * Transform the \ExpertiseArea entity
     * @param \ExpertiseArea $model
     *
     * @return array
     */
    public function transform(ExpertiseAreas $model)
    {
        return [
            'id'          => (int) $model->id,
            'area'        => $model->area,
            'expertise_topics' => $model->expertiseTopics()->get(),
            'created_at'  => $model->created_at,
            'updated_at'  => $model->updated_at
        ];
    }
}
