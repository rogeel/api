<?php

namespace App\Presenters;

use App\Transformers\ExpertiseTopicTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class ExpertiseTopicPresenter
 *
 * @package namespace App\Presenters;
 */
class ExpertiseTopicPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new ExpertiseTopicTransformer();
    }
}
