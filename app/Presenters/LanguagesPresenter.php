<?php

namespace App\Presenters;

use App\Transformers\LanguagesTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class LanguagesPresenter
 *
 * @package namespace App\Presenters;
 */
class LanguagesPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new LanguagesTransformer();
    }
}
