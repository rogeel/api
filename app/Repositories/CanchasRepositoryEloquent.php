<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\CanchasRepository;
use App\Models\Canchas;
use DB;

/**
 * Class CanchasRepositoryEloquent
 * @package namespace App\Repositories;
 */
class CanchasRepositoryEloquent extends BaseRepository implements CanchasRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Canchas::class;
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
        return "App\\Presenters\\CanchasPresenter";
    }

    public function searchData($data){

    $where=array();
    if( (!isset($data['ciudad'])))
        $data["ciudad"]= "";
    if( (!isset($data['fecha'])))
        $data["fecha"]= "";
    if( (!isset($data['hora'])))
        $data["hora"]= "";
    if( (!isset($data['noJugadores'])))
        $data["noJugadores"]= "";

    $ciudad=strtolower($data['ciudad']);
    $fechaini=$data['fecha'];
    $noJugadores=intval($data['noJugadores']);
    if(!empty($_REQUEST['fecha'])){
        $fecha = strtotime($data['fecha']);
    }else{
        $fecha = strtotime('today');
    }

    $joinConditional="";
      

    if(!empty($data['hora'])){
        $hora = explode(':',$data['hora']);
        $hora1=intval($hora[0]);
        if(date('N', $fecha) >= 6){
            array_push($where,"FIND_IN_SET(".$hora1.", B.horas_activas_fin) >= 1");
        }else{
            array_push($where,"FIND_IN_SET(".$hora1.", B.horas_activas_semana) >= 1");
        }
        array_push($where,"G.hora IS NULL");
        $joinConditional = "  and (G.hora ='".$hora1.":00:00' AND G.fecha ='".$fechaini."')";
    }else{
        $hora1 = 0;
    }

    //array_push($where,"trim(lower(C.cancha)) like '%".$val."%'");
    array_push($where,"trim(lower(D.ciudad)) like '%".$ciudad."%'");
    array_push($where,"B.jugadores >= ".$noJugadores);
    array_push($where,"B.jugadores >= ".$noJugadores);

    //array_push($where,"trim(lower(E.zona)) like '%".$val."%'");
    // if($val=='norte' || $val=='sur' || $val=='centro' || $val=='oriente' || $val=='occidente') array_push($andwhere,"trim(lower(E.zona)) like '%".$val."%'");

    $where=implode(" and ",$where);
    if(!empty($andwhere)) $andwhere=implode(" or ",$andwhere);

    //crear el query
    $query="select
    B.id_cancha as id, C.cancha,  C.lat, C.lon, C.dir, C.telefono, C.email, E.zona, D.ciudad, C.horario,C.horario_fin,C.servicios,C.tarifas, B.campo
    from
    campos B inner join canchas C ON B.id_cancha = C.id_cancha
    inner join ciudades D on C.id_ciudad = D.id_ciudad
    inner join zonas E on C.id_zona=E.id_zona
    left join reservas G on G.id_campo = B.id_campo and C.id_cancha = G.id_cancha".$joinConditional."
    where  C.estado='t'
    and ($where) ";
    if(!empty($andwhere)) $query.="and ($andwhere)";          
    $query.="GROUP BY B.id_campo limit ".(($data['pagina']-1)*$data['por_pagina']).",".$data['por_pagina'];
    $canchas=DB::select($query);
    $query="select
    count(B.id_cancha) as total
    from
    campos B inner join canchas C ON B.id_cancha = C.id_cancha
    inner join ciudades D on C.id_ciudad = D.id_ciudad
    inner join zonas E on C.id_zona=E.id_zona
    left join reservas G on G.id_campo = B.id_campo and C.id_cancha = G.id_cancha".$joinConditional."
    where  C.estado='t'
    and ($where) GROUP BY B.id_campo";
    $total=count(DB::select($query));


    $result = array('canchas' => $canchas, "total" => $total);
    return $result;
    }
}
