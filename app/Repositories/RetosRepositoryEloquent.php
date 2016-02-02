<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\RetosRepository;
use App\Models\Retos;

/**
 * Class RetosRepositoryEloquent
 * @package namespace App\Repositories;
 */
class RetosRepositoryEloquent extends BaseRepository implements RetosRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Retos::class;
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
        return "App\\Presenters\\RetosPresenter";
    }
}
