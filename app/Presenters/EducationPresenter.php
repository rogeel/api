<?php

namespace App\Presenters;

use App\Transformers\EducationTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class EducationPresenter
 *
 * @package namespace App\Presenters;
 */
class EducationPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new EducationTransformer();
    }
}
