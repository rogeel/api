<?php

namespace App\Presenters;

use App\Transformers\EquiposTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class EquiposPresenter
 *
 * @package namespace App\Presenters;
 */
class EquiposPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new EquiposTransformer();
    }
}
