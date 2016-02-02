<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\RetosRepository;
use App\Models\Retos;

/**
 * Class RetosRepositoryEloquent
 * @package namespace App\Repositories;
 */
class RetosRepositoryEloquent extends BaseRepository implements RetosRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    protected $rules = [
      ValidatorInterface::RULE_CREATE => [
        'id_equipo' => 'required|exists:equipos,id_equipo',
        'id_retador'  => 'required|exists:equipos,id_equipo',
        'id_reserva'  => 'exists:reservas,id_reserva',
        'mensaje'  => 'required',
        'tipo' => 'required',
        'estado' => 'required',
        'fecha_registro' => 'fecha_registro',
        'fecha' => 'required',
        'hora' => 'required'
      ], ValidatorInterface::RULE_UPDATE => [
        'id_equipo' => 'required|exists:equipos,id_equipo',
        'id_retador'  => 'required|exists:equipos,id_equipo',
        'id_reserva'  => 'exists:reservas,id_reserva',
        'mensaje'  => 'required',
        'tipo' => 'required',
        'estado' => 'required',
        'fecha_registro' => 'fecha_registro',
        'fecha' => 'required',
        'hora' => 'required'
      ]
    ];


    public function model()
    {
        return Retos::class;
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
        return "App\\Presenters\\RetosPresenter";
    }
}
