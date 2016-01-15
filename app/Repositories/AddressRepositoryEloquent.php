<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\AddressRepository;
use App\Models\Address;
use Prettus\Validator\Contracts\ValidatorInterface;

/**
 * Class AddressRepositoryEloquent
 * @package namespace App\Repositories;
 */
class AddressRepositoryEloquent extends BaseRepository implements AddressRepository
{
    /**
     * Validation rules
     * @var array
     */
    protected $rules = [
      ValidatorInterface::RULE_CREATE => [
        'profile_id'    => 'required|exists:profile,id',
        'type'          => 'required|string|size:1',
        'address_1'     => 'required|string|max:50',
        'city'          => 'required|string|max:50',
        'state'         => 'required|string|max:50',
        'country_id'    => 'required|exists:countries,id',
        'phone'         => 'integer|required_without:mobile',
        'mobile'        => 'integer|required_without:phone',
        'postal_code'   => 'integer'
      ],
      ValidatorInterface::RULE_UPDATE => [
        'profile_id'    => 'required|exists:profile,id',
        'type'          => 'required|string|size:1',
        'address_1'     => 'required|string|max:50',
        'city'          => 'required|string|max:50',
        'state'         => 'required|string|max:50',
        'country_id'    => 'required|exists:countries,id',
        'phone'         => 'integer|required_without:mobile',
        'mobile'        => 'integer|required_without:phone',
        'postal_code'   => 'integer'
      ]
    ];

    // protected $fieldSearchable = [
    //   'address_1' => 'like',
    //   'address_2' => 'like',
    //   'postal_code'
    // ];

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Address::class;
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
     * @return AddressPresenter fractal instance that parses the model
     */
    public function presenter()
    {
        return "App\\Presenters\\AddressPresenter";
    }
}
