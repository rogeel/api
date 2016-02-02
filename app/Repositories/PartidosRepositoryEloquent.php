<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\PartidosRepository;
use App\Models\Partidos;

/**
 * Class PartidosRepositoryEloquent
 * @package namespace App\Repositories;
 */
class PartidosRepositoryEloquent extends BaseRepository implements PartidosRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Partidos::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
