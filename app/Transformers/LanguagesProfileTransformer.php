<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Models\LanguagesProfile;

/**
 * Class LanguagesTransformer
 * @package namespace App\Transformers;
 */
class LanguagesProfileTransformer extends TransformerAbstract
{

    /**
     * Transform the \LanguagesProfile entity
     * @param \LanguagesProfile $model
     *
     * @return array
     */
    public function transform(LanguagesProfile $model)
    {
        return [
            'id'              => (int) $model->id,
            'language_id'    => (int) $model->languages_id,
            'mother_tongue'   => $model->mother_tongue,
            'reading'         => $model->reading,
            'writing'         => $model->writing,
            'speaking'        => $model->speaking
        ];
    }
}
