<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Models\ExpertiseTopic;

/**
 * Class ExpertiseTopicTransformer
 * @package namespace App\Transformers;
 */
class ExpertiseTopicTransformer extends TransformerAbstract
{

    /**
     * Transform the \ExpertiseTopic entity
     * @param \ExpertiseTopic $model
     *
     * @return array
     */
    public function transform(ExpertiseTopic $model)
    {
        return [
            'id'         => (int) $model->id,
            'topic' => $model->topic,
            'expertise_area' => $model->expertiseArea()->get(),
            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
