<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\AlertasRepository;
use App\Models\Alertas;
use Prettus\Validator\Contracts\ValidatorInterface;

/**
 * Class AlertasRepositoryEloquent
 * @package namespace App\Repositories;
 */
class AlertasRepositoryEloquent extends BaseRepository implements AlertasRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */

    protected $rules = [
      ValidatorInterface::RULE_CREATE => [
        'id_jugador' => 'required|exists:jugadores,id_jugador',
        'estado' => 'required',
        'id_tipo_alerta' => 'required'
        
      ], ValidatorInterface::RULE_UPDATE => [
        'estado' => 'required',
      ]
    ];
    public function model()
    {
        return Alertas::class;
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
        return "App\\Presenters\\AlertasPresenter";
    }
}
