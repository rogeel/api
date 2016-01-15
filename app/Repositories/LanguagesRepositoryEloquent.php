<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\LanguagesRepository;
use App\Models\Language;

/**
 * Class LanguagesRepositoryEloquent
 * @package namespace App\Repositories;
 */
class LanguagesRepositoryEloquent extends BaseRepository implements LanguagesRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Language::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    /**
     * Presenter for the Languages repository
     * @return [type] [description]
     */
    public function presenter()
    {
        return "App\\Presenters\\LanguagesPresenter";
    }
}
