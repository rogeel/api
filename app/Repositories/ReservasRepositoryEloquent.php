<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\ReservasRepository;
use App\Models\Reservas;

/**
 * Class ReservasRepositoryEloquent
 * @package namespace App\Repositories;
 */
class ReservasRepositoryEloquent extends BaseRepository implements ReservasRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Reservas::class;
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
        return "App\\Presenters\\ReservasPresenter";
    }
}
