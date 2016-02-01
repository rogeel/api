<?php
namespace App\Http\Controllers;
use JWTAuth;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repositories\UserRepository;
use App\Libraries\Helper\ResponseMessage as ResponseMessage;

class AuthenticateController extends Controller
{
    protected $usersRepo;

    public function __construct(UserRepository $users){
      $this->usersRepo = $users;
    }

    public function store(Request $request)
    {
        // grab credentials from the request
        $input_data = json_decode($request->getContent(), true);
        $arrayReturn = array();

        try {
            $credentials = [
                'email' => $input_data['email'],
                'password' => $input_data['password'],
                'confirmed' => 1
            ];
            

           

            //$user_role = array_key_exists('role', $input_data) ? $input_data['role'] : 'user';


            // attempt to verify the credentials and create a token for the user
            if (! $token = JWTAuth::attempt($credentials)) {
                return ResponseMessage::invalidCredentials();
            }

            // Checks Roles
            $user = JWTAuth::setToken($token)->authenticate();

            //$isQueryFromAdmin = $user->is('query') && $user_role == 'admin';

            /*if (!$user->is($user_role) && !$isQueryFromAdmin) {
              return response()->json(
                  ['error' => 'invalid_credentials'], 401
              );
            }*/
        } catch (JWTException $e) {
            // something went wrong whilst attempting to encode the token
            return response()->json(
                [
                  'error' => 'could_not_create_token',
                  'message' => $e->getMessage()
                ], 500
            );
        }

        // all good so return the token
        $arrayReturn = compact('token');
        $arrayReturn["user"] = $this->usersRepo->parserResult($user)['data'];

        return response()->json($arrayReturn);
    }
}
