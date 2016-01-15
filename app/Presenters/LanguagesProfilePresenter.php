<?php

namespace App\Presenters;

use App\Transformers\LanguagesProfileTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class LanguagesPresenter
 *
 * @package namespace App\Presenters;
 */
class LanguagesProfilePresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new LanguagesProfileTransformer();
    }
}
