<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\EquiposRepository;
use App\Models\Equipos;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Repository\Events\RepositoryEntityCreated;
use Prettus\Repository\Events\RepositoryEntityUpdated;

/**
 * Class EquiposRepositoryEloquent
 * @package namespace App\Repositories;
 */
class EquiposRepositoryEloquent extends BaseRepository implements EquiposRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */

    protected $rules = [
      ValidatorInterface::RULE_CREATE => [
        'equipo' => 'required|unique:equipos',
        'camiseta'  => 'required',
        'camiseta1'  => 'required',
        'pantaloneta'  => 'required',
        'pantaloneta1'  => 'required',
        'id_ciudad'  => 'required|exists:ciudades,id_ciudad',
        'id_zona'  => 'required|exists:zonas,id_zona',
        'sexo'  => 'required|in:m,f'
      ], ValidatorInterface::RULE_UPDATE => [
        'equipo' => 'required|unique:equipos',
        'camiseta'  => 'required',
        'camiseta1'  => 'required',
        'pantaloneta'  => 'required',
        'pantaloneta1'  => 'required',
        'id_ciudad'  => 'required|exists:ciudades,id_ciudad',
        'id_zona'  => 'required|exists:zonas,id_zona',
        'sexo'  => 'required|in:m,f'
      ]
    ];



    public function model()
    {
        return Equipos::class;
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
        return "App\\Presenters\\EquiposPresenter";
    }
}
