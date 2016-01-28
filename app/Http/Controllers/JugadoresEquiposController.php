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
        $input_data = json_decode($request->getContent(), true);
        \JWTAuth::parseToken();
        $user = \JWTAuth::parseToken()->authenticate();
        $arrayEquipoJugador = array('id_jugador' => $user->id_jugador,'id_equipo'=>$input_data["id_equipo"],'id_posicion'=>$user->id_posicion,'capitan'=>'f' , 'titular' => 't');
        try {
          $result = $this->JugadoresEquiposRepository->create($arrayEquipoJugador);
          $equipo = $this->equiposRepository->find($input_data["id_equipo"]);
          return response()->json($equipo);

        }catch (\Exception $e) {
          if ($e instanceof ValidatorException) {
            return response()->json($e->toArray(), 400);

          } else {
            if ($result instanceof \App\Models\JugadoresEquipos) $result->forceDelete();
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
