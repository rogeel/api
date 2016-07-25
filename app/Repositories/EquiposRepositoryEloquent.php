<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\EquiposRepository;
use App\Models\Equipos;
Use DB;
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
        'camiseta_manga'  => 'required',
        'medias'  => 'required',
        'camiseta1'  => 'required',
        'camiseta_manga1'  => 'required',
        'medias1'  => 'required',
        'pantaloneta'  => 'required',
        'pantaloneta1'  => 'required',
        'id_ciudad'  => 'required|exists:ciudades,id_ciudad',
        'id_zona'  => 'required|exists:zonas,id_zona',
        'sexo'  => 'required|in:m,f'
      ], ValidatorInterface::RULE_UPDATE => [
        'equipo' => 'required|unique:equipos,equipo,NULL,id_equipo',
        'camiseta'  => 'required',
        'camiseta_manga'  => 'required',
        'medias'  => 'required',
        'camiseta1'  => 'required',
        'camiseta_manga1'  => 'required',
        'medias1'  => 'required',
        'pantaloneta'  => 'required',
        'pantaloneta1'  => 'required',
        'id_ciudad'  => 'required|exists:ciudades,id_ciudad',
        'id_zona'  => 'required|exists:zonas,id_zona',
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

    public function searchData($data){



      $where=array();
      print_r($data);
      if( (isset($data['ciudad']))){
        $ciudad=intval($data['ciudad']);
        array_push($where,"B.id_ciudad = '".$ciudad."'");
      }
      if( (isset($data['zona']))){
          $zona=intval($data['zona']);
          array_push($where,"B.id_zona = '".$zona."'");
      }
      if( (!isset($data['equipo'])))
          $data["equipo"]= "";


      if( (isset($data['sexo']))){
          $sexo=$data['sexo'];
          array_push($where,"B.sexo = '".$sexo."'");
      }


      array_push($where,"trim(lower(equipo)) like '%".$data["equipo"]."%'");
      $where=implode(" and ",$where);
      //crear el query
      $query="select
                B.id_equipo as id,B.equipo, B.cancha,B.sexo, case when ranking is null then '-' else ranking end as ranking,B.camiseta, B.camiseta1, B.pantaloneta, B.pantaloneta1, ciudad,zona 
              from
                 equipos B,ciudades E,zonas G
              where
                B.id_ciudad=E.id_ciudad
                and B.id_zona=G.id_zona
                and (".$where.")
               limit ".$data['por_pagina']."
                offset ".(($data['pagina']-1)*$data['por_pagina']);
      $equipos=DB::select($query);
      $query="select
                count(B.id_equipo) as total 
              from
                 equipos B,ciudades E,zonas G
              where
                B.id_ciudad=E.id_ciudad
                and B.id_zona=G.id_zona
                and (".$where.")";
      $total=DB::select($query);
    
      //$jugadores = $this->parserResult($jugadores);
      $result = array('equipos' => $equipos, "total" => $total);
      return $result;
    
    }
}
