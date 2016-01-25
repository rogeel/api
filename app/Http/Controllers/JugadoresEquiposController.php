<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repositories\EquiposRepository;
use App\Repositories\JugadoresEquiposRepository;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Libraries\Helper\ResponseMessage as ResponseMessage;

class JugadoresEquiposController extends Controller
{
    //

    protected $repository;


    public function __construct(EquiposRepository $equiposRepository,JugadoresEquiposRepository $JugadoresEquiposRepository ){
      $this->equiposRepository = $equiposRepository;
      $this->JugadoresEquiposRepository = $JugadoresEquiposRepository;
    }


    /**
     * Show all addresses
     * @return array
     */
    public function index()
    {
       
    }

    /**
     * Saves a address into the database
     * @return void
     */
    public function store(Request $request) {
        $equipo_data = $request->all();
        \JWTAuth::parseToken();
        $user = \JWTAuth::parseToken()->authenticate();
        $equipo = NULL;
        $equiposCapitan = $this->JugadoresEquiposRepository->findWhere([
            'id_jugador'=>$user->id_jugador,
            'capitan'=>'t'
        ]);
        if(count($equiposCapitan)>0){
             return ResponseMessage::notAllowedTeams();
        }
        
        try{

          $equipo = $this->equiposRepository->create($equipo_data);
          $arrayEquipoJugador = array('id_jugador' => $user->id_jugador,'id_equipo'=>$equipo["data"]["id"],'id_posicion'=>$user->id_posicion,'capitan'=>'t' , 'titular' => 't');
          $this->JugadoresEquiposRepository->create($arrayEquipoJugador);

          $file = $request->file("foto");
          if(!empty($file)){
                $file->move("images/jugadores/",$equipo["data"]["id"].".jpg");
          }else{

              if(getenv('APP_ENV')=="production"){
                copy("/filesHtml/quepartido1/public/images/equipos/0.jpg","/filesHtml/quepartido1/public/images/equipos/".$equipo["data"]["id"].".jpg");

              }else{
                copy("/filesHtml/dev/front/public/images/equipos/0.jpg","/filesHtml/dev/front/public/images/equipos/".$equipo["data"]["id"].".jpg");
              }

            
          }

         return response()->json($equipo);

        }catch (\Exception $e) {
          if ($e instanceof ValidatorException) {
            return response()->json($e->toArray(), 400);

          } else {
            if ($user instanceof \App\Models\Equipos) $equipo->forceDelete();
            return response()->json($e->getMessage(), 500);

          }
        }
    }

    /**
     * Show a record by id
     * @return array
     */
    public function show($id){

       return response()->json($this->equiposRepository->find($id));

    }

    /**
     * Update a address by id
     * @return array
     */
    public function update(Request $request, $id){

      $equipo_data = $request->all();
        \JWTAuth::parseToken();
        $user = \JWTAuth::parseToken()->authenticate();
        $equipo = NULL;
        $equiposCapitan = $this->JugadoresEquiposRepository->findWhere([
            'id_jugador'=>$user->id_jugador,
            'capitan'=>'t',
            'id_equipo'=>$id
        ]);
        if(count($equiposCapitan)==0){
             return ResponseMessage::invalidPermission();
        }
        
        try{

          $equipo = $this->equiposRepository->update($equipo_data,$id);

          $file = $request->file("foto");
          if(!empty($file)){
                $file->move("images/jugadores/",$equipo["data"]["id"].".jpg");
          }
          

         return response()->json($equipo);

        }catch (\Exception $e) {
          if ($e instanceof ValidatorException) {
            return response()->json($e->toArray(), 400);

          } else {
            if ($user instanceof \App\Models\Equipos) $equipo->forceDelete();
            return response()->json($e->getMessage(), 500);

          }
        }
        
      
    }

    /**
     * Delete a record by id
     * @return array
     */
    public function destroy($id){
      
    }

    public function buscar(Request $request) {
      
      $conditions = json_decode($request->getContent(), true);
      $equipos = $this->equiposRepository->searchData($conditions);

      return response()->json($equipos);
        
    }
}
