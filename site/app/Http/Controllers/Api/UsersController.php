<?php namespace App\Http\Controllers\Api;

use Validator,
    Hash,
    Mail,
    Auth;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Exceptions\InvalidConfirmationCodeException;
use App\User;
use App\Profile;

class UsersController extends Controller
{
    /*
      |--------------------------------------------------------------------------
      | User Actions Controller
      |--------------------------------------------------------------------------
      |
      | This controller handles the registration of new users, as well as the
      | authentication of existing users. Why don't you explore it?
      |
     */

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('jwt.auth', ['except' => ['validator', 'create', 'confirm']]);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
                'first_name' => 'required|max:255',
                'last_name' => 'required|max:255',
                'email' => 'required|email|max:255|unique:users',
                'password' => 'required|min:6'
        ]);
    }

    /**
     * @api {post} /user CreateUserAccount
     * @apiName CreateUserAccount
     * @apiGroup User
     *
     * @apiParam {string} first_name Firstname of user *required
     * @apiParam {string} last_name Firstname of user *required
     * @apiParam {string} email email address of user *required
     * @apiParam {string} password password added by user *required
     * @apiParam {number} gender user id of the user 1-Male, 2-Female *optional
     * @apiParam {number} fitness_status user's self assessment about fitness 1-I am definitely fit, 2-I am quite fit, 3-I am not so fit *optional
     * @apiParam {number} goal user's goal *optional
     * @apiParam {string} city user's city *optional
     * @apiParam {string} state user's state *optional
     * @apiParam {string} country user's country *optional
     * @apiParam {string} quote Quote added by user *optional
     *
     * @apiSuccess {String} success.
     * 
     * @apiSuccessExample Success-Response:
     *     HTTP/1.1 200 OK
     *     {
     *     "success": "successfully_created_user",
     *     "user": {
     *             "id": "2",
     *             "email": "aneeshk@cubettech.com",
     *             "confirmation_code": null,
     *             "status": "0",
     *             "created_at": "2015-11-06 12:14:48",
     *             "updated_at": "2015-11-06 12:15:04",
     *             "profile": {
     *                 "id": "1",
     *                 "user_id": "2",
     *                 "first_name": "Aneesh",
     *                 "last_name": "Kallikkattil",
     *                 "gender": "0",
     *                 "fitness_status": "0",
     *                 "goal": "3",
     *                 "image": null,
     *                 "city": null,
     *                 "state": null,
     *                 "country": null,
     *                 "quote": "I am Simple",
     *                 "created_at": "2015-11-06 12:14:48",
     *                 "updated_at": "2015-11-06 12:14:48"
     *             }     
     *      }
     * }
     *
     * @apiError error Message token_invalid.
     * @apiError error Message token_expired.
     * @apiError could_not_create_user User error.
     *
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 400 Invalid Request
     *     {
     *       "error": "token_invalid"
     *     }
     * 
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 401 Unauthorised
     *     {
     *       "error": "token_expired"
     *     }
     * 
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 400 Bad Request
     *     {
     *       "error": "token_not_provided"
     *     }
     * 
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 500 could_not_create_user
     *     {
     *       "error": "could_not_create_user"
     *     }
     */
    public function postRegister(Request $request)
    {
        $validator = $this->validator($request->all());

        if ($validator->fails()) {

            return response()->json(['error' => $validator->messages()->toArray()], 422);
        }

        if ($this->create($request->all())) {
            $user = User::where('email', '=', $request->input('email'))->with(['profile'])->get();
            return response()->json(['success' => 'successfully_created_user', 'user' => $user->toArray()], 200);
        } else {
            return response()->json(['error' => 'could_not_create_user'], 500);
        }
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {

        $confirmation_code = str_random(30);

        $user = User::create([
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'confirmation_code' => $confirmation_code,
                'status' => 0
        ]);

        Mail::send('email.verify', ['confirmation_code' => $confirmation_code], function($message) use ($data) {
            $message->to($data['email'], $data['first_name'] . ' ' . $data['last_name'])
                ->subject('Verify your email address');
        });


        $profile = new Profile([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'gender' => $data['gender'],
            'fitness_status' => $data['fitness_status'],
            'goal' => $data['goal'],
            'city' => isset($data['city']) ? $data['city'] : '',
            'state' => isset($data['state']) ? $data['state'] : '',
            'country' => isset($data['country']) ? $data['country'] : '',
            'quote' => isset($data['quote']) ? $data['quote'] : ''
        ]);


        $userProfile = $user->profile()->save($profile);

        $user = User::where('email', '=', $data['email'])->with(['profile'])->first();

        if (!is_null($user)) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * @api {post} /user/update UpdateUserAccount
     * @apiName UpdateUserAccount
     * @apiGroup User
     *
     * @apiParam {string} first_name Firstname of user *optional
     * @apiParam {string} last_name Firstname of user *optional
     * @apiParam {string} email email address of user *readonly *required 
     * @apiParam {number} gender gender of the user 1-Male, 2-Female *optional
     * @apiParam {number} fitness_status user's self assessment about fitness 1-I am definitely fit, 2-I am quite fit, 3-I am not so fit *optional
     * @apiParam {number} goal user's goal *optional
     * @apiParam {string} city user's city *optional
     * @apiParam {string} state user's state *optional
     * @apiParam {string} country user's country *optional
     * @apiParam {string} quote Quote added by user *optional
     *
     * @apiSuccess {String} success.
     * 
     * @apiSuccessExample Success-Response:
     * HTTP/1.1 200 OK
     * {
     *        "success": "successfully_updated_user_profile",
     *        "user": {
     *               "id": "1",
     *               "email": "admin@ykings.com",
     *               "confirmation_code": null,
     *               "status": "1",
     *               "created_at": "2015-11-06 12:14:48",
     *               "updated_at": "2015-11-06 12:15:04",
     *               "profile": {
     *                   "id": "1",
     *                   "user_id": "1",
     *                   "first_name": "Ykings",
     *                   "last_name": "Cubet",
     *                   "gender": "0",
     *                   "fitness_status": "0",
     *                   "goal": "3",
     *                   "image": null,
     *                   "city": null,
     *                   "state": null,
     *                   "country": null,
     *                   "quote": "I am Simple",
     *                   "created_at": "2015-11-06 12:14:48",
     *                   "updated_at": "2015-11-10 13:35:24"
     *              }
     *        }
     *  }
     *
     * @apiError error Message token_invalid.
     * @apiError error Message token_expired.
     * @apiError could_not_update_user_profile User error.
     *
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 400 Invalid Request
     *     {
     *       "error": "token_invalid"
     *     }
     * 
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 401 Unauthorised
     *     {
     *       "error": "token_expired"
     *     }
     * 
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 400 Bad Request
     *     {
     *       "error": "token_not_provided"
     *     }
     * 
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 500 could_not_create_user
     *     {
     *       "error": "could_not_create_user"
     *     }
     */
    public function update(Request $request)
    {
        $data = $request->all();

        $profData = [];

        if (isset($data['first_name'])) {
            $profData['first_name'] = $data['first_name'];
        }

        if (isset($data['last_name'])) {
            $profData['last_name'] = $data['last_name'];
        }

        if (isset($data['gender'])) {
            $profData['gender'] = $data['gender'];
        }

        if (isset($data['fitness_status'])) {
            $profData['fitness_status'] = $data['fitness_status'];
        }

        if (isset($data['quote'])) {
            $profData['quote'] = $data['quote'];
        }

        if (isset($data['city'])) {
            $profData['city'] = $data['city'];
        }

        if (isset($data['state'])) {
            $profData['state'] = $data['state'];
        }

        if (isset($data['country'])) {
            $profData['country'] = $data['country'];
        }

        if ($user = User::where('email', '=', $data['email'])->with(['profile'])->first()) {

            $user->profile()->update($profData);
            $user = User::where('email', '=', $request->input('email'))->with(['profile'])->first();

            return response()->json(['success' => 'successfully_updated_user_profile', 'user' => $user->toArray()], 200);
        } else {
            return response()->json(['error' => 'could_not_update_user'], 500);
        }
    }

    /**
     * @api {post} /user/login LoginUser
     * @apiName LoginUser
     * @apiGroup User
     *
     * @apiParam {string} email email address of user *required
     * @apiParam {string} password password added by user *required
     *
     * @apiSuccess {String} success.
     *
     * @apiSuccessExample Success-Response:
     *     HTTP/1.1 200 OK
     *     {
     *     "success": "successfully_logged_in",
     *     "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOiIxIiwiaXNzIjoiaHR0cDpcL1wvc2FuZGJveC55a2luZ3MuY29tXC9hcGlcL2F1dGhlbnRpY2F0ZSIsImlhdCI6IjE0NDcwNjQ1MDQiLCJleHAiOiIxNDQ3NDI0NTA0IiwibmJmIjoiMTQ0NzA2NDUwNCIsImp0aSI6IjEzMTFkNDg1YTEzMzUwZTY3Y2MwMjJhNWE4YzEzMzQwIn0.hJdOlak3z2I3gOLTt8e7u8zSMsvHUSDMGMKNpCphLVk",
     *     "user":  {
     *             "id": "2",
     *             "email": "aneeshk@cubettech.com",
     *             "confirmation_code": null,
     *             "status": "1",
     *             "created_at": "2015-11-06 12:14:48",
     *             "updated_at": "2015-11-06 12:15:04",
     *             "profile": {
     *                 "id": "1",
     *                 "user_id": "2",
     *                 "first_name": "Aneesh",
     *                 "last_name": "Kallikkattil",
     *                 "gender": "0",
     *                 "fitness_status": "0",
     *                 "goal": "3",
     *                 "image": null,
     *                 "city": null,
     *                 "state": null,
     *                 "country": null,
     *                 "quote": "I am Simple",
     *                 "created_at": "2015-11-06 12:14:48",
     *                 "updated_at": "2015-11-06 12:14:48"
     *          }
     *      }
     * }
     *
     * @apiError error Message token_invalid.
     * @apiError error Message token_expired.
     * @apiError user_not_verified User error.
     * @apiError invalid_credentials User error.
     *
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 400 Invalid Request
     *     {
     *       "error": "token_invalid"
     *     }
     * 
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 401 Unauthorised
     *     {
     *       "error": "token_expired"
     *     }
     * 
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 400 Bad Request
     *     {
     *       "error": "token_not_provided"
     *     }
     * 
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 422 user_not_verified
     *     {
     *       "error": "user_not_verified"
     *     }
     * 
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 401 invalid_credentials
     *     {
     *       "error": "invalid_credentials"
     *     }
     */
    public function login(Request $request)
    {
        $data = $request->all();
        if (Auth::attempt(['email' => $data['email'], 'password' => $data['password']])) {
            // Authentication passed...

            if (Auth::user()->status == 1) {
                $user = User::where('id', '=', Auth::user()->id)->with(['profile'])->first();
                try {
                    // verify the credentials and create a token for the user
                    if (!$token = JWTAuth::fromUser($user)) {
                        return response()->json(['error' => 'invalid_credentials'], 401);
                    }
                } catch (JWTException $e) {
                    // something went wrong
                    return response()->json(['error' => 'could_not_create_token'], 500);
                }

                // if no errors are encountered we can return a JWT
                return response()->json(['success' => 'successfully_logged_in', 'token' => $token, 'user' => $user->toArray()], 200);
            } else {
                return response()->json(['error' => 'user_not_verified'], 401);
            }
        } else {
            return response()->json(['error' => 'invalid_credentials'], 422);
        }
    }

    /**
     * @api {get} /user/get GetUserDetails
     * @apiName GetUserDetails
     * @apiGroup User
     *
     * @apiParam {integer} id id of user *required
     *
     * @apiSuccess {String} success.
     *
     * @apiSuccessExample Success-Response:
     *     HTTP/1.1 200 OK
     *     {
     *     "success": "user_details",
     *     "user": {
     *             "id": "2",
     *             "email": "aneeshk@cubettech.com",
     *             "confirmation_code": null,
     *             "status": "1",
     *             "created_at": "2015-11-06 12:14:48",
     *             "updated_at": "2015-11-06 12:15:04",
     *             "profile": {
     *                 "id": "1",
     *                 "user_id": "2",
     *                 "first_name": "Aneesh",
     *                 "last_name": "Kallikkattil",
     *                 "gender": "0",
     *                 "fitness_status": "0",
     *                 "goal": "3",
     *                 "image": null,
     *                 "city": null,
     *                 "state": null,
     *                 "country": null,
     *                 "quote": "I am Simple",
     *                 "created_at": "2015-11-06 12:14:48",
     *                 "updated_at": "2015-11-06 12:14:48"
     *              }
     *        } 
     * }
     *
     * @apiError error Message token_invalid.
     * @apiError error Message token_expired.
     * @apiError user_not_verified User error.
     * @apiError invalid_credentials User error.
     *
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 400 Invalid Request
     *     {
     *       "error": "token_invalid"
     *     }
     * 
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 401 Unauthorised
     *     {
     *       "error": "token_expired"
     *     }
     * 
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 400 Bad Request
     *     {
     *       "error": "token_not_provided"
     *     }
     * 
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 422 user_not_verified
     *     {
     *       "error": "user_not_verified"
     *     }
     * 
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 401 invalid_credentials
     *     {
     *       "error": "invalid_credentials"
     *     }
     */
    public function getUser(Request $request)
    {
        $data = $request->all();
        //print_r($data);
        $userId = Auth::user()->id;
        if (isset($data['id'])) {
            $userId = $data['id'];
        }

        // Authentication passed...

        if (Auth::user()->status == 1) {
            $user = User::where('id', '=', $userId)->with(['profile'])->first();

            return response()->json(['success' => 'user_details', 'user' => $user->toArray()], 200);
        } else {
            return response()->json(['error' => 'user_not_verified'], 401);
        }
    }

    public function confirm(Request $request)
    {
        $conformationCode = $request->input('token');

        if (!$conformationCode) {
            throw new InvalidConfirmationCodeException;
        }

        $user = User::whereConfirmationCode($conformationCode)->first();

        if (!$user) {
            throw new InvalidConfirmationCodeException;
        }

        $user->status = 1;
        $user->confirmation_code = null;
        $user->save();

        return Redirect::to('/');
    }

    public function logout(Request $request)
    {
        if (Auth::user()) {
            Auth::logout();
            return response()->json(['success' => 'user_successfully_logged_out'], 200);
        } else {
            return response()->json(['error' => 'user_already_logged_out'], 401);
        }
    }
}
