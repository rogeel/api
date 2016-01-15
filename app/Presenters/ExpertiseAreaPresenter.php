<?php

namespace App\Presenters;

use App\Transformers\ExpertiseAreaTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class ExpertiseAreaPresenter
 *
 * @package namespace App\Presenters;
 */
class ExpertiseAreaPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new ExpertiseAreaTransformer();
    }
}
