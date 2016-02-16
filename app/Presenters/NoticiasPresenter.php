<?php

namespace App\Presenters;

use App\Transformers\NoticiasTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class NoticiasPresenter
 *
 * @package namespace App\Presenters;
 */
class NoticiasPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new NoticiasTransformer();
    }
}
