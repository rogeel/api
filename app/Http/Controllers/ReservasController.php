<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repositories\ReservasRepository;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Libraries\Helper\ResponseMessage as ResponseMessage;

class ReservasController extends Controller
{
    //

    protected $repository;


    public function __construct(AlertasRepository $repository){
      $this->repository = $repository;
    }


    /**
     * Show all addresses
     * @return array
     */
    public function index()
    {   
        \JWTAuth::parseToken();
        $user = \JWTAuth::parseToken()->authenticate();

        $alertas = $this->repository->findWhere([
            'id_jugador'=>$user->id_jugador
        ]);
        return response()->json($alertas);    
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

        return response()->json($this->equiposRepository->find($id));     

    }

    /**
     * Update a address by id
     * @return array
     */
    public function update(Request $request, $id){

        \JWTAuth::parseToken();
        $user = \JWTAuth::parseToken()->authenticate();

        $alert_data = json_decode($request->getContent(), true);

        try{
            $alert = $this->repository->update($alert_data, $id);
            return response()->json($alert);
        } catch (\Exception $e) {
            if ($e instanceof ValidatorException) {
                return response()->json($e->toArray(), 400);
            }
            else {
          
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
