<?php

namespace App\Presenters;

use App\Transformers\CountryTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class CountryPresenter
 *
 * @package namespace App\Presenters;
 */
class CountryPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new CountryTransformer();
    }
}
