<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\CiudadesRepository;
use App\Models\Ciudades;

/**
 * Class CiudadesRepositoryEloquent
 * @package namespace App\Repositories;
 */
class CiudadesRepositoryEloquent extends BaseRepository implements CiudadesRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Ciudades::class;
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
        return "App\\Presenters\\CiudadesPresenter";
    }
}
