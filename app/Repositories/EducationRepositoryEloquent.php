<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\EducationRepository;
use App\Models\Education;
use Prettus\Validator\Contracts\ValidatorInterface;

/**
 * Class EducationRepositoryEloquent
 * @package namespace App\Repositories;
 */
class EducationRepositoryEloquent extends BaseRepository implements EducationRepository
{


    protected $rules = [
      ValidatorInterface::RULE_CREATE => [
        'profile_id'    => 'required|exists:profile,id',
        'type'          => 'required|string',
        'institution'   => 'required|string|max:50',
        'start_date'    => 'required|date',
        'finish_date'   => 'date|after:start_date',
        'level'         => 'required|string|max:50',
        'field_study'   => 'required|string|max:50',
        'file'          => 'required|string',
      ],
      ValidatorInterface::RULE_UPDATE => [
        'profile_id'    => 'required|exists:profile,id',
        'type'          => 'required|string',
        'institution'   => 'required|string|max:50',
        'start_date'    => 'required|date',
        'finish_date'   => 'date|after:start_date',
        'level'         => 'required|string|max:50',
        'field_study'   => 'required|string|max:50',
        'file'          => 'required|string',      ]
    ];
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Education::class;
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
        return "App\\Presenters\\EducationPresenter";
    }
}
