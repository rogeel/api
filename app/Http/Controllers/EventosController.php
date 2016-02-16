<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repositories\EventosRepository;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Libraries\Helper\ResponseMessage as ResponseMessage;

class EventosController extends Controller
{
    //

    protected $repository;


    public function __construct(EventosRepository $eventosRepository ){
      $this->repository = $eventosRepository;
     
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
        
      
    }

    /**
     * Delete a record by id
     * @return array
     */
    public function destroy($id){
      
    }

    public function buscar(Request $request) {
      
      $conditions = json_decode($request->getContent(), true);
      $eventos = $this->repository->searchData($conditions);

      return response()->json($eventos);
        
    }



    
}
