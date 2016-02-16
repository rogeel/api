<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\NoticiasRepository;
use App\Models\Noticias;
use DB;

/**
 * Class NoticiasRepositoryEloquent
 * @package namespace App\Repositories;
 */
class NoticiasRepositoryEloquent extends BaseRepository implements NoticiasRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Noticias::class;
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
        return "App\\Presenters\\NoticiasPresenter";
    }

    public function searchData($data){
      $where=array();
      
      if( (!isset($data['noticia'])))
          $data["noticia"]= "";

      if( (!isset($data['descripcion'])))
          $data["descripcion"]= "";

      
      $noticia=strtolower($data['noticia']);
      $descripcion=strtolower($data['descripcion']);

      array_push($where,"trim(lower(noticia)) like '%".$noticia."%'");
      array_push($where,"trim(lower(descripcion)) like '%".$descripcion."%'");

      
      $where=implode(" and ",$where);
      //crear el query
      $query="select
      *
      from
      noticias 
      where
      estado = 'p'
      and (".$where.")
      order by fecha
      limit ".$data['por_pagina']."
      offset ".(($data['pagina']-1)*$data['por_pagina']);
      $noticias=DB::select($query);
      $query="select count(id_noticia) as total from noticias where estado = 'p' and (".$where.")";
      $total=DB::select($query);
      //$jugadores = $this->parserResult($jugadores);
      $result = array('noticias' => $noticias, "total" => $total);
      return $result;
    
    }
}
