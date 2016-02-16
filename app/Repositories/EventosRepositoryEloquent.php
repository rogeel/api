<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\EventosRepository;
use App\Models\Eventos;
use DB;
/**
 * Class EventosRepositoryEloquent
 * @package namespace App\Repositories;
 */
class EventosRepositoryEloquent extends BaseRepository implements EventosRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Eventos::class;
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
        return "App\\Presenters\\EventosPresenter";
    }

    public function searchData($data){
      $where=array();
      
      if( (!isset($data['evento'])))
          $data["evento"]= "";

      if( (!isset($data['desc_larga'])))
          $data["desc_larga"]= "";

      if( (!isset($data['dir'])))
          $data["dir"]= "";

      
      $evento=strtolower($data['evento']);
      $desc_larga=strtolower($data['desc_larga']);
      $dir=strtolower($data['dir']);

      array_push($where,"trim(lower(evento)) like '%".$evento."%'");
      array_push($where,"trim(lower(desc_larga)) like '%".$desc_larga."%'");
      array_push($where,"trim(lower(dir)) like '%".$dir."%'");

      
      $where=implode(" and ",$where);
      //crear el query
      $query="select
      *
      from
      eventos 
      where
      estado = 'p'
      and (".$where.")
      order by fecha
      limit ".$data['por_pagina']."
      offset ".(($data['pagina']-1)*$data['por_pagina']);
      $eventos=DB::select($query);
      $query="select count(id_evento) as total from eventos where estado = 'p' and (".$where.")";
      $total=DB::select($query);
      //$jugadores = $this->parserResult($jugadores);
      $result = array('eventos' => $eventos, "total" => $total);
      return $result;
    
    }
}
