<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\CamposRepository;
use App\Models\Campos;

/**
 * Class CamposRepositoryEloquent
 * @package namespace App\Repositories;
 */
class CamposRepositoryEloquent extends BaseRepository implements CamposRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Campos::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
