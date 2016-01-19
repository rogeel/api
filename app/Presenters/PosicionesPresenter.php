<?php

namespace App\Presenters;

use App\Transformers\PosicionesTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class PosicionesPresenter
 *
 * @package namespace App\Presenters;
 */
class PosicionesPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new PosicionesTransformer();
    }
}
