<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repositories\UserRepository;
use App\Services\TransactionalMailer;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Libraries\Helper\ResponseMessage as ResponseMessage;

class JugadorController extends Controller
{
    //

    protected $repository;


    public function __construct(UserRepository $repository){
      $this->repository = $repository;
    }


    /**
     * Show all addresses
     * @return array
     */
    public function index()
    {
        return response()->json($this->repository->all());     
      
    }

    /**
     * Saves a address into the database
     * @return void
     */
    public function store(Request $request) {
     
    }

    /**
     * Show a record by id
     * @return array
     */
    public function show($id){

        return response()->json($this->repository->find($id));

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

    public function buscar(Request $request) {
      
      $conditions = json_decode($request->getContent(), true);
      $jugadores = $this->repository->searchData($conditions);

      return response()->json($jugadores);
        
    }
}
