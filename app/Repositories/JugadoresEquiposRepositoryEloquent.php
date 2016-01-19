<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\JugadoresEquiposRepository;
use App\Models\JugadoresEquipos;

/**
 * Class JugadoresEquiposRepositoryEloquent
 * @package namespace App\Repositories;
 */
class JugadoresEquiposRepositoryEloquent extends BaseRepository implements JugadoresEquiposRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return JugadoresEquipos::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
