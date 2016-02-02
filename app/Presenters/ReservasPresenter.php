<?php

namespace App\Presenters;

use App\Transformers\ReservasTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class ReservasPresenter
 *
 * @package namespace App\Presenters;
 */
class ReservasPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new ReservasTransformer();
    }
}
