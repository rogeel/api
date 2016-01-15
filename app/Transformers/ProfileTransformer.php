<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Models\Profile;

/**
 * Class ProfileTransformer
 * @package namespace App\Transformers;
 */
class ProfileTransformer extends TransformerAbstract
{

    /**
     * Transform the \Profile entity
     * @param \Profile $model
     *
     * @return array
     */
    public function transform(Profile $model)
    {
        $return = [
            'id'                => (int) $model->id,
            'user'              => $model->user()->get(),
            'user_id'           => (int) $model->user_id,
            'birthday'          => $model->birthday,
            'gender'            => $model->gender,
            'years_experience'  => $model->years_experience,
            'expertiseAreas'    => $model->expertiseAreas()->get(),
            'expertiseTopics'   => $model->expertiseTopics()->get(),
            'addresses'         => $model->addresses()->get(),
            'jobs'              => $model->jobs()->get(),
            'languages'         => $model->languages()->get(),
            'references'        => $model->references()->get(),
            'publications'      => $model->publications()->get(),
            'question_1'        => $model->question_1,
            'question_2'        => $model->question_2,
            'question_3'        => $model->question_3,
            'question_4'        => $model->question_4,
            'question_5'        => $model->question_5,
            'question_6'        => $model->question_6,
            'question_7'        => $model->question_7,
            'question_8'        => $model->question_8,
            'file'              => $model->file
        ];

        if ($model->country_id != 1) $return['country_id'] = $model->country_id;

        return $return;
    }
}
