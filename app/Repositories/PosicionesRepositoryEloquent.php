<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\PosicionesRepository;
use App\Models\Posiciones;

/**
 * Class PosicionesRepositoryEloquent
 * @package namespace App\Repositories;
 */
class PosicionesRepositoryEloquent extends BaseRepository implements PosicionesRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Posiciones::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function presenter()
    {
        return "App\\Presenters\\PosicionesPresenter";
    }
}
