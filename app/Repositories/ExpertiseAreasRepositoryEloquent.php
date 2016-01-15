<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\ExpertiseAreasRepository;
use App\Models\ExpertiseAreas;
use Prettus\Validator\Contracts\ValidatorInterface;


/**
 * Class ExpertiseAreasRepositoryEloquent
 * @package namespace App\Repositories;
 */
class ExpertiseAreasRepositoryEloquent extends BaseRepository implements ExpertiseAreasRepository
{
    /**
     * Validation rules
     * @var array
     */
    protected $rules = [
      ValidatorInterface::RULE_CREATE => [
        'area' => 'required|unique:expertise_areas'
      ],
      ValidatorInterface::RULE_UPDATE => [
        'area' => 'required|unique:expertise_areas'
      ]
    ];

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return ExpertiseAreas::class;
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
     * @return ExpertiseAreaPresenter fractal instance that parses the model
     */
    public function presenter()
    {
        return "App\\Presenters\\ExpertiseAreaPresenter";
    }
}
