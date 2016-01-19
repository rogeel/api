<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repositories\EquiposRepository;
use App\Repositories\JugadoresEquiposRepository;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Libraries\Helper\ResponseMessage as ResponseMessage;

class EquipoController extends Controller
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
        return response()->json($this->equiposRepository->all());
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
