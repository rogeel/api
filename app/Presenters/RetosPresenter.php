<?php

namespace App\Presenters;

use App\Transformers\RetosTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class RetosPresenter
 *
 * @package namespace App\Presenters;
 */
class RetosPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new RetosTransformer();
    }
}
