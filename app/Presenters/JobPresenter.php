<?php

namespace App\Presenters;

use App\Transformers\JobTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class JobPresenter
 *
 * @package namespace App\Presenters;
 */
class JobPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new JobTransformer();
    }
}
