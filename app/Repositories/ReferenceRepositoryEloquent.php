<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\ReferenceRepository;
use App\Models\Reference;
use Prettus\Validator\Contracts\ValidatorInterface;

/**
 * Class ReferenceRepositoryEloquent
 * @package namespace App\Repositories;
 */
class ReferenceRepositoryEloquent extends BaseRepository implements ReferenceRepository
{
    /**
     * Validation rules
     * @var array
     */
    protected $rules = [
      ValidatorInterface::RULE_CREATE => [
        'profile_id'    => 'required|exists:profile,id',
        'first_name'    => 'required|string|max:50',
        'last_name'     => 'required|string|max:50',
        'email'         => 'required|email',
        'phone'         => 'required|integer',
        'organization'  => 'required|string|max:50',
        'job_title'     => 'required|string|max:50',
        'gender'        => 'required|string|size:1',
      ],
      ValidatorInterface::RULE_UPDATE => [
        'profile_id'    => 'required|exists:profile,id',
        'first_name'    => 'required|string|max:50',
        'last_name'     => 'required|string|max:50',
        'email'         => 'required|email',
        'phone'         => 'required|integer',
        'organization'  => 'required|string|max:50',
        'job_title'     => 'required|string|max:50',
        'gender'        => 'required|string|size:1',
      ]
    ];

    protected $fieldSearchable = [
      'first_name' => 'like',
      'last_name' => 'like',
      'organization' => 'like',
      'job_title' => 'like',
      'email'
    ];

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Reference::class;
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
     * @return ReferencePresenter fractal instance that parses the model
     */
    public function presenter()
    {
        return "App\\Presenters\\ReferencePresenter";
    }
}
