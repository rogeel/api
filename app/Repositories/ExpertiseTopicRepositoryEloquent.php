<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\ExpertiseTopicRepository;
use App\Models\ExpertiseTopic;
use Prettus\Validator\Contracts\ValidatorInterface;

/**
 * Class ExpertiseTopicRepositoryEloquent
 * @package namespace App\Repositories;
 */
class ExpertiseTopicRepositoryEloquent extends BaseRepository implements ExpertiseTopicRepository
{
    /**
     * Validation rules
     * @var array
     */
    protected $rules = [
      ValidatorInterface::RULE_CREATE => [
        'topic' => 'required',
        'expertise_area_id' => 'required|unique:expertise_topics'
      ],
      ValidatorInterface::RULE_UPDATE => [
        'topic' => 'required',
        'expertise_area_id' => 'required|unique:expertise_topics'
      ]
    ];

    protected $fieldSearchable = [
      'topic' => 'like'
    ];


    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return ExpertiseTopic::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }


    /**
     * Presenter that's goona be used by the for the expertise topics repository
     * @return [type] [description]
     */
    public function presenter()
    {
        return "App\\Presenters\\ExpertiseTopicPresenter";
    }
}
