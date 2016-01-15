<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Models\Language;

/**
 * Class LanguagesTransformer
 * @package namespace App\Transformers;
 */
class LanguagesTransformer extends TransformerAbstract
{

    /**
     * Transform the \Languages entity
     * @param \Languages $model
     *
     * @return array
     */
    public function transform(Language $model)
    {
        return [
            'id'          => (int) $model->id,
            'language'    => $model->language
        ];
    }
}
