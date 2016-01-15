<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class JugadorController extends Controller
{
    //

    protected $repository;


    public function __construct(AddressRepository $repository){
      $this->repository = $repository;
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
    public function update(Request $request, $id){
      
    }

    /**
     * Delete a record by id
     * @return array
     */
    public function destroy($id){
      
    }
}
