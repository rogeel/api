<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\JugadoresEquiposRepository;
use App\Models\JugadoresEquipos;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Repository\Events\RepositoryEntityCreated;
use Prettus\Repository\Events\RepositoryEntityUpdated;

/**
 * Class JugadoresEquiposRepositoryEloquent
 * @package namespace App\Repositories;
 */
class JugadoresEquiposRepositoryEloquent extends BaseRepository implements JugadoresEquiposRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */

     protected $rules = [
      ValidatorInterface::RULE_CREATE => [
        'id_equipo' => 'required|exists:equipos,id_equipo',
        'id_jugador'  => 'required|exists:jugadores,id_jugador',
        'capitan'  => 'required',
        'titular'  => 'required',
        'id_posicion'  => 'required|exists:posiciones,id_posicion'
      ], ValidatorInterface::RULE_UPDATE => [
        'id_equipo' => 'required|exists:equipos,id_equipo',
        'id_jugador'  => 'required|exists:jugadores,id_jugador',
        'capitan'  => 'required',
        'titular'  => 'required',
        'id_posicion'  => 'required|exists:posiciones,id_posicion'
      ]
    ];
    public function model()
    {
        return JugadoresEquipos::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
