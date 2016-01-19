<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repositories\EquiposRepository;
use App\Repositories\JugadoresEquiposRepository;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Libraries\Helper\ResponseMessage as ResponseMessage;

class EquiposController extends Controller
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
        return response()->json($this->equiposRepository->all());      
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

          /*$file = $request->file("foto");


          if(!empty($file)){
                $file->move("images/jugadores/",$equipo->id_equipo.".jpg");
          }else{

                copy("/filesHtml/quepartido1/public/images/equipos/0.jpg","/filesHtml/quepartido1/public/images/equipos/".$equipo->id_equipo.".jpg");
            
          }*/

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

        try {
            \JWTAuth::parseToken();
            $user = \JWTAuth::parseToken()->authenticate();
           

            if($id == $user->id_jugador){

                $jugador = $this->repository->parserResult($user)['data'];
                return response()->json($jugador);        
            }else{
                return ResponseMessage::invalidPermission();
            }
            
           
        } catch (\Exception $e) {
            
        }

    }

    /**
     * Update a address by id
     * @return array
     */
    public function update(Request $request, $id){
        $jugador_data = json_decode($request->getContent(), true);
        \JWTAuth::parseToken();
        $user = \JWTAuth::parseToken()->authenticate();
        $editedJugador = NULL;

        try {

            if($id == $user->id_jugador){
                $editedJugador= $this->repository->update( $jugador_data, $id);
                return response()->json($editedJugador);
                
            }else{
                return ResponseMessage::invalidPermission();
            }
           
        } catch (\Exception $e) {
            if ($e instanceof ValidatorException) {
                return response()->json($e->toArray(), 400);

            } else {
                if($editedJugador != NULL && key_exists('id_jugador', $editedJugador))
                    $this->repository->delete($editedJugador['id_jugador']);
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
}
