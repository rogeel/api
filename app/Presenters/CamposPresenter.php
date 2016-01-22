<?php

namespace App\Presenters;

use App\Transformers\CamposTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class CamposPresenter
 *
 * @package namespace App\Presenters;
 */
class CamposPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new CamposTransformer();
    }
}
