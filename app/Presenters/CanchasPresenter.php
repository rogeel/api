<?php

namespace App\Presenters;

use App\Transformers\CanchasTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class CanchasPresenter
 *
 * @package namespace App\Presenters;
 */
class CanchasPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new CanchasTransformer();
    }
}
