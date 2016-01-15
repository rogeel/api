<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\ProfileRepository;
use App\Models\Profile;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Repository\Events\RepositoryEntityCreated;
use Prettus\Repository\Events\RepositoryEntityUpdated;


/**
 * Class ProfileRepositoryEloquent
 * @package namespace App\Repositories;
 */
class ProfileRepositoryEloquent extends BaseRepository implements ProfileRepository
{


  /**
   * Validation rules
   * @var array
   */
  protected $rules = [
    ValidatorInterface::RULE_CREATE => [
      'user_id'             => 'required|exists:users,id',
      'country_id'          => 'required|exists:countries,id',
      'years_experience'    => 'integer',
      'birthday'            => 'date'
    ],
    ValidatorInterface::RULE_UPDATE => [
      'user_id'             => 'required|exists:users,id',
      'country_id'          => 'required|exists:countries,id',
      'years_experience'    => 'integer',
      'birthday'            => 'date'
    ]
  ];
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Profile::class;
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
        return "App\\Presenters\\ProfilePresenter";
    }

    /**
     * Generates an empty profile for the user
     * @param  $user_id User id
     * @return mixed         profile
     */
    public function generateProfileForUser ($user_id){
      $model = $this->makeModel();
      $model->user_id = $user_id;
      return $this->parserResult($model);
    }


    /**
     * Adds expertise areas to an specific profile
     * @param  [type] $profile_id            [description]
     * @param  array  $expertiseAreas_ids [description]
     * @return [type]                     [description]
     */
    public function attachExpertiseAreas($profile_id, array $expertiseAreas){
      $this->applyScope();

      $_skipPresenter = $this->skipPresenter;

      $this->skipPresenter(true);

      $model = $this->model->findOrFail($profile_id);

      foreach ($expertiseAreas as $key => $expertArea) {
        $model->expertiseAreas()->attach($expertArea['id']);
      }

      $model = $model->fresh();

      $this->skipPresenter($_skipPresenter);
      $this->resetModel();

      event(new RepositoryEntityUpdated($this, $model));

      return $this->parserResult($model);
    }


    /**
     * Adds expertise topics to an specific profile
     * @param  [type] $profile_id          [description]
     * @param  array  $expertiseTopics_ids [description]
     * @return [type]                      [description]
     */
    public function attachExpertiseTopics($profile_id, array $expertiseTopics){
        $this->applyScope();

        $_skipPresenter = $this->skipPresenter;

        $this->skipPresenter(true);

        $model = $this->model->findOrFail($profile_id);

        foreach ($expertiseTopics as $key => $expertiseTopic) {
          $model->expertiseTopics()->attach($expertiseTopic['id']);
        }

        $model = $model->fresh();

        $this->skipPresenter($_skipPresenter);
        $this->resetModel();

        event(new RepositoryEntityUpdated($this, $model));

        return $this->parserResult($model);
    }

    /**
     * Adds expertise topics to an specific profile
     * @param  [type] $profile_id          [description]
     * @param  array  $expertiseTopics_ids [description]
     * @return [type]                      [description]
     */
    public function detachExpertiseAreas($profile_id){
        $this->applyScope();

        $_skipPresenter = $this->skipPresenter;

        $this->skipPresenter(true);

        $model = $this->model->findOrFail($profile_id);

        $model->expertiseAreas()->detach();

        $model = $model->fresh();

        $this->skipPresenter($_skipPresenter);
        $this->resetModel();

        event(new RepositoryEntityUpdated($this, $model));

        return $this->parserResult($model);
    }

    /**
     * Adds expertise topics to an specific profile
     * @param  [type] $profile_id          [description]
     * @param  array  $expertiseTopics_ids [description]
     * @return [type]                      [description]
     */
    public function detachExpertiseTopics($profile_id){
        $this->applyScope();

        $_skipPresenter = $this->skipPresenter;

        $this->skipPresenter(true);

        $model = $this->model->findOrFail($profile_id);

        $model->expertiseTopics()->detach();

        $model = $model->fresh();

        $this->skipPresenter($_skipPresenter);
        $this->resetModel();

        event(new RepositoryEntityUpdated($this, $model));

        return $this->parserResult($model);
    }

}
