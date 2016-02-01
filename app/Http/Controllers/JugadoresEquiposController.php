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
    public function store( Request $request, $equipoId) {
        $input_data = json_decode($request->getContent(), true);
        \JWTAuth::parseToken();
        $user = \JWTAuth::parseToken()->authenticate();

        

        $arrayEquipoJugador = array('id_jugador' => $user->id_jugador,'id_equipo'=>$equipoId,'id_posicion'=>$user->id_posicion,'capitan'=>'f' , 'titular' => 't');
        try {
          $result = $this->JugadoresEquiposRepository->create($arrayEquipoJugador);
          $equipo = $this->equiposRepository->find($equipoId);
          return response()->json($equipo);

        }catch (\Exception $e) {
          if ($e instanceof ValidatorException) {
            return response()->json($e->toArray(), 400);

          } else {
     
            return response()->json($e->getMessage(), 500);

          }
        }

        
    }

    /**
     * Show a record by id
     * @return array
     */
    public function show($id){


    }

    /**
     * Update a address by id
     * @return array
     */
    public function update(Request $request, $equipoId, $id){

      $equipo_data = $request->all();
      \JWTAuth::parseToken();
      $user = \JWTAuth::parseToken()->authenticate();

      $equiposCapitan = $this->JugadoresEquiposRepository->findWhere([
          'id_jugador'=>$user->id_jugador,
          'capitan'=>'t',
          'id_equipo'=>$equipoId
      ]);



      if(count($equiposCapitan)==0){
        return ResponseMessage::notIsCaptain();
      }
      if(!isset($equipo_data["capitan"])){
        $equipo_data["capitan"]="s";
      }

      $arrayEquipoJugador = array('id_jugador' => $id, 'id_equipo'=>$equipoId,'id_posicion'=>$equipo_data["posicion"],'capitan'=>$equipo_data["capitan"] , 'titular' => $equipo_data["titular"]);
      try {

        $jugadores = \App\Models\JugadoresEquipos::where('id_equipo',$equipoId)->where('id_jugador', $id)
                      ->update( $arrayEquipoJugador);
        if($equipo_data["capitan"]=="t" && $id!=$user->id_jugador){
          $jugadores = \App\Models\JugadoresEquipos::where('id_equipo',$equipoId)->where('id_jugador', $user->id_jugador)
                      ->update([ 'capitan'=>'s']);

        }
        //$result = $this->JugadoresEquiposRepository->update($arrayEquipoJugador);


        $equipo = $this->equiposRepository->find($equipoId);
        return response()->json($equipo);

      }catch (\Exception $e) {
        if ($e instanceof ValidatorException) {
          return response()->json($e->toArray(), 400);

        } else {
   
          return response()->json($e->getMessage(), 500);

        }
      }




    
        
      
    }

    /**
     * Delete a record by id
     * @return array
     */
    public function destroy($equipoId,$id){

      
      \JWTAuth::parseToken();
      $user = \JWTAuth::parseToken()->authenticate();

      if($id!=$user->id_jugador){


        $equiposCapitan = $this->JugadoresEquiposRepository->findWhere([
            'id_jugador'=>$user->id_jugador,
            'capitan'=>'t',
            'id_equipo'=>$equipoId
        ]);

        if(count($equiposCapitan)==0){
          return ResponseMessage::notIsCaptain();
        }
      }

      $jugadores = \App\Models\JugadoresEquipos::where('id_equipo',$equipoId)->where('id_jugador', $id)->delete();

      

      return response()->json(true);

      
      
    }

    
}
