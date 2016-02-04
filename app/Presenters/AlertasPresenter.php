<?php

namespace App\Presenters;

use App\Transformers\AlertasTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class AlertasPresenter
 *
 * @package namespace App\Presenters;
 */
class AlertasPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new AlertasTransformer();
    }
}
