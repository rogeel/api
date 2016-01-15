<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\JobRepository;
use App\Models\Job;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Repository\Events\RepositoryEntityCreated;
use Prettus\Repository\Events\RepositoryEntityUpdated;

/**
 * Class JobRepositoryEloquent
 * @package namespace App\Repositories;
 */
class JobRepositoryEloquent extends BaseRepository implements JobRepository
{

    /**
     * Validation rules
     * @var array
     */
    protected $rules = [
      ValidatorInterface::RULE_CREATE => [
        'profile_id'        => 'required|exists:profile,id',
        'job_title'         => 'required|string|max:50',
        'start_date'        => 'required|date',
        'finish_date'       => 'date|after:start_date',
        'employer'          => 'required|string|max:50',
        'employer_address'  => 'required|string|max:50',
        'country_id'        => 'required',
        'supervisor'        => 'required|string|max:50',
        'type_business'     => 'required|string|max:50'
      ],
      ValidatorInterface::RULE_UPDATE => [
        'profile_id'        => 'required|exists:profile,id',
        'job_title'         => 'required|string|max:50',
        'start_date'        => 'required|date',
        'finish_date'       => 'date|after:start_date',
        'employer'          => 'required|string|max:50',
        'employer_address'  => 'required|string|max:50',
        'country_id'        => 'required',
        'supervisor'        => 'required|string|max:50',
        'type_business'     => 'required|string|max:50'
      ]
    ];


    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Job::class;
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
        return "App\\Presenters\\JobPresenter";
    }

     public function detachExpertiseAreas ($job_id) {
      $this->applyScope();

      $_skipPresenter = $this->skipPresenter;

      $this->skipPresenter(true);

      $model = $this->model->findOrFail($job_id);



      $model->expertiseAreas()->detach();


      $model = $model->fresh();

      $this->skipPresenter($_skipPresenter);
      $this->resetModel();

      event(new RepositoryEntityUpdated($this, $model));

      return $this->parserResult($model);
    }


    public function attachExpertiseAreas ($job_id,$expertiseAreas) {
      $this->applyScope();

      $_skipPresenter = $this->skipPresenter;

      $this->skipPresenter(true);

      $model = $this->model->findOrFail($job_id);


      foreach ($expertiseAreas as $key => $expertiseArea) {
         $model->expertiseAreas()->attach($expertiseArea["id"]);
      }



      $model = $model->fresh();

      $this->skipPresenter($_skipPresenter);
      $this->resetModel();

      event(new RepositoryEntityUpdated($this, $model));

      return $this->parserResult($model);
    }
}
