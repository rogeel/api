<?php

namespace App\Presenters;

use App\Transformers\PartidosTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class PartidosPresenter
 *
 * @package namespace App\Presenters;
 */
class PartidosPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new PartidosTransformer();
    }
}
