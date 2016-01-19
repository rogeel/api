<?php

namespace App\Presenters;

use App\Transformers\CiudadesTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class CiudadesPresenter
 *
 * @package namespace App\Presenters;
 */
class CiudadesPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new CiudadesTransformer();
    }
}
