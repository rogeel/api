<?php

namespace App\Presenters;

use App\Transformers\JugadoresEquiposTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class JugadoresEquiposPresenter
 *
 * @package namespace App\Presenters;
 */
class JugadoresEquiposPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new JugadoresEquiposTransformer();
    }
}
