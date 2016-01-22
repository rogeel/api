<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\CanchasRepository;
use App\Models\Canchas;

/**
 * Class CanchasRepositoryEloquent
 * @package namespace App\Repositories;
 */
class CanchasRepositoryEloquent extends BaseRepository implements CanchasRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Canchas::class;
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
        return "App\\Presenters\\CanchasPresenter";
    }

    public function searchData($data){


    }
}
