<?php

namespace App\Presenters;

use App\Transformers\PartidosEquiposTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class PartidosEquiposPresenter
 *
 * @package namespace App\Presenters;
 */
class PartidosEquiposPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new PartidosEquiposTransformer();
    }
}
