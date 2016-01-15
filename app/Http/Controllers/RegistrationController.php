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
    $user_data['confirmation_code'] = str_random(45);
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
              copy("/filesHtml/quepartido1/public/images/jugadores/0.jpg","/filesHtml/quepartido1/public/images/jugadores/".$user->id_jugador.".jpg");
          }elseif($user_data['sexo']=='f'){
              copy("/filesHtml/quepartido1/public/images/jugadores/0f.jpg","/filesHtml/quepartido1/public/images/jugadores/".$user->id_jugador.".jpg");
          }
      }
      return response()->json($this->usersRepo->parserResult($user));

    }catch (\Exception $e) {
      if ($e instanceof ValidatorException) {
        return response()->json($e->toArray(), 400);

      } else {
        if ($user instanceof \App\Models\User) $user->forceDelete();
        return response()->json($e->getMessage(), 500);

      }
    }
  }

  /**
   * Confirmates the email address of an specific user using the confirmation_token that is provided on the confirmation email that is sent as part of the registration process.
   * @param  Request $request request
   * @return JSON           status of the verification
   */
  public function confirmate(Request $request) {
      $confirmation_data = json_decode($request->getContent(), true);
      //Avoid attacks with other data that the one that is actually required
      $users = $this->usersRepo->findWhere([
        'confirmation_token' => $confirmation_data['confirmation_token']
      ],
      ['id']);

      if (!empty($users['data']) && count($users['data']) == 1) {
        $user_id = $users['data'][0]['id'];
        $user =  $this->usersRepo
                      ->removeConfirmationToken($user_id);
        return response()->json([
            "message" => "confirmation completed",
            "data" => $user['data']
        ]);

      } else {
        return response()->json(
          ["message" => "invalid confirmation token"],
          400
        );

      }

  }
}
