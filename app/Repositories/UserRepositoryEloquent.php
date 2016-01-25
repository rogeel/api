<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\UserRepository;
use App\Models\User;
use Prettus\Validator\Contracts\ValidatorInterface;
use Hash;
Use DB;
use Prettus\Repository\Events\RepositoryEntityCreated;
use Prettus\Repository\Events\RepositoryEntityUpdated;



/**
 * Class UserRepositoryEloquent
 * @package namespace App\Repositories;
 */
class UserRepositoryEloquent extends BaseRepository implements UserRepository
{
    /**
     * Validation rules
     * @var array
     */
    protected $rules = [
      ValidatorInterface::RULE_CREATE => [
        'nombres' => 'required|max:50',
        'apellidos'  => 'required|max:50',
        'email' => 'required|email|unique:jugadores',
        'password' => [
          'required',
          'min:8',
          'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*(_|[^\w])).+$/'
        ],
        'id_posicion' => 'required|exists:posiciones,id_posicion',
        'id_ciudad' => 'required|exists:ciudades,id_ciudad',
        'f_nacimiento' => 'required|date',
        'sexo' => 'required|in:m,f',
        'zona' => 'required|exists:zonas,id_zona',
        'movil' => 'required'
      ], ValidatorInterface::RULE_UPDATE => [
        'nombres' => 'required|max:50',
        'apellidos'  => 'required|max:50',
        'email' => 'required|email|unique:jugadores,email,NULL,id_jugador',
        'password' => [
          'min:8',
          'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*(_|[^\w])).+$/'
        ],
        'id_posicion' => 'required|exists:posiciones,id_posicion',
        'id_ciudad' => 'required|exists:ciudades,id_ciudad',
        'f_nacimiento' => 'required|date',
        'sexo' => 'required|in:m,f',
        'zona' => 'required|exists:zonas,id_zona',
        'movil' => 'required'
      ]
    ];

    protected $fieldSearchable = [
      'nombres' => 'like',
      'apellidos' => 'like',
      'email'
    ];

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return User::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    /**
     * Presenter for the user repository
     * @return [type] [description]
     */
    public function presenter()
    {
        return "App\\Presenters\\UserPresenter";
    }

    /**
     * Generates a new user in the database
     * @param  array  $attributes attributes to generate the user
     * @return Models\User             User created
     */
    public function create(array $attributes){
        if ( !is_null($this->validator) ) {
            $this->validator->with($attributes)
                ->passesOrFail( ValidatorInterface::RULE_CREATE );
        }

        $model = $this->model->newInstance($attributes);
        $this->hashPassword($model);
        $model->save();
        $this->resetModel();
        event(new RepositoryEntityCreated($this, $model));
        return $this->parserResult($model);
    }

    /**
     * Hash password of the user model that was stored
     * @param  \App\Models\User $user user model
     * @return void
     */
    public function hashPassword(\App\Models\User $user){
        $user->password = Hash::make($user->password);
    }

    /**
     * Removes confirmation token and sets the user as confirmed
     * @param  Integer $id User's id
     * @return mixed     user's data
     */
    public function removeConfirmationToken($id){
      $this->applyScope();

      $_skipPresenter = $this->skipPresenter;

      $this->skipPresenter(true);

      $model = $this->model->findOrFail($id);
      $attributes = [
          'confirmed' => 1,
          'confirmation_token' => NULL
      ];
      $model->fill($attributes);
      $model->save();

      $this->skipPresenter($_skipPresenter);
      $this->resetModel();

      event(new RepositoryEntityUpdated($this, $model));

      return $this->parserResult($model);
    }

    /**
     * Adds specified role to the user
     * @param  Integer  $user_id
     * @param  String   $role_string short name of the role
     * @return mixed    users_data
     */
    public function attachRole ($user_id, $role_slug) {
      $this->applyScope();

      $_skipPresenter = $this->skipPresenter;

      $this->skipPresenter(true);

      $model = $this->model->findOrFail($user_id);

      $role = Role::where('slug', $role_slug)->first();

      if ($role instanceof  Role) $model->attachRole($role);
      else {
        throw new Exception('There is no role: '.$role_slug);
      }

      $model = $model->fresh();

      $this->skipPresenter($_skipPresenter);
      $this->resetModel();

      event(new RepositoryEntityUpdated($this, $model));

      return $this->parserResult($model);
    }

    public function searchData($data){
      $where=array();
      if( (isset($data['posicion']))){
        $posicion=intval($data['posicion']);
        array_push($where,"B.id_posicion = '".$posicion."'");
      }
      if( (isset($data['ciudad']))){
        $ciudad=intval($data['ciudad']);
        array_push($where,"B.id_ciudad = '".$ciudad."'");
      }
      if( (!isset($data['nombre'])))
          $data["nombre"]= "";
      if( (isset($data['zona']))){
          $zona=intval($data['zona']);
          array_push($where,"B.zona = '".$zona."'");
      }
      if( (!isset($data['email'])))
          $data["email"]= "";

      
      $nombre=strtolower($data['nombre']);
      $email=strtolower($data['email']);

      array_push($where,"trim(lower(email)) like '%".$email."%'");
      array_push($where,"trim(lower(B.nombres)) like '%".$nombre."%'");
      array_push($where,"trim(lower(B.apellidos)) like '%".$nombre."%'");
      
      $where=implode(" and ",$where);
      //crear el query
      $query="select
      B.id_jugador as id,B.nombres,B.apellidos,posicion,ciudad,G.zona,B.f_nacimiento, B.sexo, B.descripcion,B.logros, B.fuerza, B.defensa, B.resistencia, B.tecnica, B.ataque, B.movil,
      case
      when (select id_equipo from jugadores_equipos where id_jugador=B.id_jugador limit 1 )>0
      then (select equipo from jugadores_equipos X,equipos Y where  X.id_equipo=Y.id_equipo and id_jugador=B.id_jugador limit 1 )
      else 'sin equipo'
        end as equipo
      from
      jugadores B,ciudades E,posiciones F,zonas G
      where
      B.id_ciudad=E.id_ciudad
      and B.id_posicion=F.id_posicion
      and B.zona=G.id_zona
      and (".$where.")
      limit ".$data['por_pagina']."
      offset ".(($data['pagina']-1)*$data['por_pagina']);
      $jugadores=DB::select($query);
      $query="select
      count(B.id_jugador) as total
      from
      jugadores B,ciudades E,posiciones F,zonas G
      where
      B.id_ciudad=E.id_ciudad
      and B.id_posicion=F.id_posicion
      and B.zona=G.id_zona
      and (".$where.")";
      $total=DB::select($query);
      //$jugadores = $this->parserResult($jugadores);
      $result = array('jugadores' => $jugadores, "total" => $total);
      return $result;
    
    }
}
