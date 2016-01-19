<?php

namespace App\Presenters;

use App\Transformers\ZonasTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class ZonasPresenter
 *
 * @package namespace App\Presenters;
 */
class ZonasPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new ZonasTransformer();
    }
}
