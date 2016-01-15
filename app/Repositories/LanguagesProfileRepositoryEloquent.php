<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\LanguagesProfileRepository;
use App\Models\LanguagesProfile;
use Prettus\Validator\Contracts\ValidatorInterface;

/**
 * Class LanguagesRepositoryEloquent
 * @package namespace App\Repositories;
 */
class LanguagesProfileRepositoryEloquent extends BaseRepository implements LanguagesProfileRepository
{
    /**
     * Validation rules
     * @var array
     */
    protected $rules = [
      ValidatorInterface::RULE_CREATE => [
        'profile_id'      => 'required|exists:profile,id',
        'languages_id'    => 'required|integer|exists:languages,id',
        'mother_tongue'   => 'required|boolean',
        'reading'         => 'required|integer|max:4|min:1',
        'writing'         => 'required|integer|max:4|min:1',
        'speaking'        => 'required|integer|max:4|min:1'
      ],
      ValidatorInterface::RULE_UPDATE => [
        'profile_id'      => 'required|exists:profile,id',
        'languages_id'    => 'required|integer|exists:languages,id',
        'mother_tongue'   => 'required|boolean',
        'reading'         => 'required|integer|max:4|min:1',
        'writing'         => 'required|integer|max:4|min:1',
        'speaking'        => 'required|integer|max:4|min:1'
      ]
    ];

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return LanguagesProfile::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    /**
     * Presenter for the LanguagesProfile repository
     * @return [type] [description]
     */
    public function presenter()
    {
        return "App\\Presenters\\LanguagesProfilePresenter";
    }
}
