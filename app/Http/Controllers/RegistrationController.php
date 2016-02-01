<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\UserRepository;
use App\Services\TransactionalMailer;
use Prettus\Validator\Exceptions\ValidatorException;
use Storage;
use Input;

class RegistrationController extends Controller
{


  /**
   * The user repository instance.
   */
  protected $usersRepo;

  /**
   * Sends transactional emails
   * @var $mailer
   */
  protected $mailer;


  /**
   * Create a new controller instance.
   *
   * @param  UserRepository  $usersRepo
   * @return void
   */
  public function __construct(UserRepository $usersRepo, TransactionalMailer $mailer)
  {
      $this->usersRepo = $usersRepo;
      $this->mailer = $mailer;
  }

  /**
   * Saves a registration into the database
   * @return void
   */
  public function store(Request $request) {

    $user_data = $request->all();
    $user_data['confirmed'] = 1;
    $user = NULL;
    try{
      $this->usersRepo->skippresenter();
      $user = $this->usersRepo->create($user_data);
      //$user = $this->usersRepo->attachRole($user->id, 'user');
      //$this->mailer->sendVerificationEmail($user);
      $this->usersRepo->skippresenter(false);
      //Storage::makeDirectory('users/'.$user->id);

      $file = $request->file("foto");
      if(!empty($file)){
          $file->move("images/jugadores/",$user->id_jugador.".jpg");
      }else{
          if($user_data['sexo']=='m'){
            if(getenv('APP_ENV')=="production"){
                copy("/filesHtml/quepartido1/public/images/jugadores/0.jpg","/filesHtml/quepartido1/public/images/jugadores/".$user->id_jugador.".jpg");
              }else{
                copy("/filesHtml/dev/front/public/images/jugadores/0.jpg","/filesHtml/quepartido1/public/images/jugadores/".$user->id_jugador.".jpg");

              }
          }elseif($user_data['sexo']=='f'){
              if(getenv('APP_ENV')=="production"){
                copy("/filesHtml/quepartido1/public/images/jugadores/0f.jpg","/filesHtml/quepartido1/public/images/jugadores/".$user->id_jugador.".jpg");
              }else{
                copy("/filesHtml/dev/front/public/images/jugadores/0f.jpg","/filesHtml/quepartido1/public/images/jugadores/".$user->id_jugador.".jpg");

              }
          }
      }
      return response()->json($this->usersRepo->parserResult($user));

    }catch (\Exception $e) {
      if ($e instanceof ValidatorException) {
        return response()->json($e->toArray(), 400);

      } else {
      
        return response()->json($e->getMessage(), 500);

      }
    }
  }

  /**
   * Confirmates the email address of an specific user using the confirmation_token that is provided on the confirmation email that is sent as part of the registration process.
   * @param  Request $request request
   * @return JSON           status of the verification
   */
 
}
