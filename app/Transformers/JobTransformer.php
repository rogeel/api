<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Models\Job;

/**
 * Class JobTransformer
 * @package namespace App\Transformers;
 */
class JobTransformer extends TransformerAbstract
{

    /**
     * Transform the \Job entity
     * @param \Job $model
     *
     * @return array
     */
    public function transform(Job $model)
    {
        return [
            'id'         => (int) $model->id,
            'job_title'       => $model->job_title,
            'start_date'       => $model->start_date,
            'finish_date'       => $model->finish_date,
            'expertise_areas_id'       => $model->expertise_areas_id,
            'employer'       => $model->employer,
            'employer_address'       => $model->employer_address,
            'employer_phone'       => $model->employer_phone,
            'employer_email'       => $model->employer_email,
            'country_id'       => (int)$model->country_id,
            'supervisor'       => $model->supervisor,
            'type_business'       => $model->type_business,
            'achievements'       => $model->achievements,
            'expertise_areas' =>$model->expertiseAreas()->get(),

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
