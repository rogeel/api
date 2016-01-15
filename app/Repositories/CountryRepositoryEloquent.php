<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\CountryRepository;
use App\Models\Country;

/**
 * Class CountryRepositoryEloquent
 * @package namespace App\Repositories;
 */
class CountryRepositoryEloquent extends BaseRepository implements CountryRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Country::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    /**
     * Presents the model to the view
     * @return CountryPresenter fractal instance that parses the model
     */
    public function presenter()
    {
        return "App\\Presenters\\CountryPresenter";
    }
}
