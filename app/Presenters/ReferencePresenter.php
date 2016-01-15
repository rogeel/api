<?php

namespace App\Presenters;

use App\Transformers\ReferenceTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class ReferencePresenter
 *
 * @package namespace App\Presenters;
 */
class ReferencePresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new ReferenceTransformer();
    }
}
