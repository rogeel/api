<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\PartidosEquiposRepository;
use App\Models\PartidosEquipos;

/**
 * Class PartidosEquiposRepositoryEloquent
 * @package namespace App\Repositories;
 */
class PartidosEquiposRepositoryEloquent extends BaseRepository implements PartidosEquiposRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return PartidosEquipos::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
