<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\PublicationRepository;
use App\Models\Publication;
use Prettus\Validator\Contracts\ValidatorInterface;

/**
 * Class PublicationRepositoryEloquent
 * @package namespace App\Repositories;
 */
class PublicationRepositoryEloquent extends BaseRepository implements PublicationRepository
{
    /**
     * Validation rules
     * @var array
     */
    protected $rules = [
      ValidatorInterface::RULE_CREATE => [
        'profile_id' => 'required|exists:profile,id',
        'title'      => 'required|string|max:100',
        'publisher'  => 'required|string|max:50',
        'year'       => 'required|integer'
      ],
      ValidatorInterface::RULE_UPDATE => [
        'profile_id' => 'required|exists:profile,id',
        'title'      => 'required|string|max:100',
        'publisher'  => 'required|string|max:50',
        'year'       => 'required|integer'
      ]
    ];

    protected $fieldSearchable = [
        'title'     => 'like',
        'publisher' => 'like',
        'year'
    ];

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Publication::class;
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
     * @return PublicationPresenter fractal instance that parses the model
     */
    public function presenter()
    {
        return "App\\Presenters\\PublicationPresenter";
    }
}
