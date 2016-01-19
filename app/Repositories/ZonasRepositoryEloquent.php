<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\ZonasRepository;
use App\Models\Zonas;

/**
 * Class ZonasRepositoryEloquent
 * @package namespace App\Repositories;
 */
class ZonasRepositoryEloquent extends BaseRepository implements ZonasRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Zonas::class;
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
        return "App\\Presenters\\ZonasPresenter";
    }
}
