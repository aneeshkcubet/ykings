<?php namespace App\Http\Controllers\Api;

use Auth,
    Image,
    Validator;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\User;
use App\Profile;
use App\Social;
use App\Settings;
use App\Images;
use App\Follow;
use App\Workout;
use App\Point;
use DB;
use Carbon\Carbon;

class SocialController extends Controller
{
    /*
      |--------------------------------------------------------------------------
      | Social Controller
      |--------------------------------------------------------------------------
      |
      | This controller handles the registration and login from social media.
      |
     */
    
    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('jwt.auth', ['except' => [
            'facebookSignUp', 
            'facebookLogin',
            'postRegister',
            'login',
            'resendVerifyEmail',
            'updateUserEmail'
            ]]);
    }

    /**
     * @api {post} /social/facebookSignUp facebookSignUp
     * @apiName facebookSignUp
     * @apiGroup Social
     *
     * @apiParam {string} [first_name] Firstname of user 
     * @apiParam {string} [last_name] LastName of user 
     * @apiParam {string} [image_url] Facebook Profile Image Url of user 
     * @apiParam {string} [access_token] Access Token 
     * @apiParam {string} email email address of user *required 
     * @apiParam {string} provider_id Facebook id of user *required
     * @apiParam {string} provider Provider,eg:facebook *required
     * @apiParam {string} [subscription] Permission flag 0/1
     * @apiParam {string} [gender] gender 
     * @apiParam {string} [fitness_status] fitness_status
     * @apiParam {string} [goal] goal 
     * @apiParam {string} [quote] quote 
     * @apiParam {string} [parameters] json_encoded array {"marketing_title":"marketing"}.

     * @apiSuccess {String} success.
     * @apiSuccessExample Success-Response:
     *     HTTP/1.1 200 OK
     * {
      "status": 1,
      "success": "successfully_created_user",
      "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOiI3NyIsImlzcyI6Imh0dHA6XC9cL3lraW5ncy5tZVwvYXBpXC9zb2NpYWxcL2ZhY2Vib29rU2lnblVwIiwiaWF0IjoiMTQ0OTY2Mjk1NCIsImV4cCI6IjE0NTMyNjI5NTQiLCJuYmYiOiIxNDQ5NjYyOTU0IiwianRpIjoiMzU4MGY2NTM4YTE1Y2QzZWE5YzMxMDcxOTg4M2VhN2UifQ.2atfPXavOuhdFhUet3DA6qX5PV22q-irT400XRe1hoA",
      "user": {
      "id": "77",
      "email": "kiranlm1@cubettech.com",
      "confirmation_code": "",
      "status": "1",
      "created_at": "2015-12-09 12:09:08",
      "updated_at": "2015-12-09 12:09:08",
      "workout_count": 0,
      "points": 0,
      "level": 1,
      "facebook_connect": 1,
      "follower_count": 0,
      "is_subscribed": 0,
      "profile": [
      {
      "id": "61",
      "user_id": "77",
      "first_name": "kiran",
      "last_name": "lm",
      "gender": "0",
      "fitness_status": "0",
      "goal": "0",
      "image": "77_1449662953.jpg",
      "cover_image": "",
      "city": "",
      "state": "",
      "country": "",
      "spot": "",
      "quote": "",
      "instagram": "",
      "twitter": "",
      "facebook": "",
      "fb": "0",
      "created_at": "2015-12-09 12:09:12",
      "updated_at": "2015-12-09 12:09:13",
      "level": 1
      }
      ],
      "settings": [
      {
      "id": "34",
      "user_id": "77",
      "key": "subscription",
      "value": "1",
      "created_at": "2015-12-09 12:09:12",
      "updated_at": "2015-12-09 12:09:12"
      },
      {
      "id": "35",
      "user_id": "77",
      "key": "notification",
      "value": "{\"comments\":\"1\",\"claps\":\"0\",\"follow\":\"0\",\"my_performance\":\"1\",\"motivation_knowledge\":\"1\"}",
      "created_at": "2015-12-09 12:09:12",
      "updated_at": "2015-12-09 12:09:12"
      }
      ]
      },
      "urls": {
      "profileImageSmall": "http://ykings.me/uploads/images/profile/small",
      "profileImageMedium": "http://ykings.me/uploads/images/profile/medium",
      "profileImageLarge": "http://ykings.me/uploads/images/profile/large",
      "profileImageOriginal": "http://ykings.me/uploads/images/profile/original",
      "video": "http://ykings.me/uploads/videos",
      "videothumbnail": "http://ykings.me/uploads/images/videothumbnails",
      "feedImageSmall": "http://ykings.me/uploads/images/feed/small",
      "feedImageMedium": "http://ykings.me/uploads/images/feed/medium",
      "feedImageLarge": "http://ykings.me/uploads/images/feed/large",
      "feedImageOriginal": "http://ykings.me/uploads/images/feed/original",
      "coverImageSmall": "http://ykings.me/uploads/images/cover_image/small",
      "coverImageMedium": "http://ykings.me/uploads/images/cover_image/medium",
      "coverImageLarge": "http://ykings.me/uploads/images/cover_image/large",
      "coverImageOriginal": "http://ykings.me/uploads/images/cover_image/original"
      }
      }
     * @apiError could_not_create_user User error.
     * @apiError Validation error
     * @apiError Validation error
     * @apiError Validation error
     * 
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 500 could_not_create_user
     *     {
     *       "error": "could_not_create_user"
     *     }
     *  @apiErrorExample Error-Response:
     *      HTTP/1.1 422 Validation error
      {
      "status": 0,
      "error": "The email field is required."
      }
     * 
     * @apiErrorExample Error-Response:
     *      HTTP/1.1 422 Validation error
      {
      "status": 0,
      "error": "The provider id field is required"
      }
     * 
     * @apiErrorExample Error-Response:
     *      HTTP/1.1 422 Validation error
      {
      "status": 0,
      "error": "The provider field is required."
      }
     */
    public function facebookSignUp(Request $request)
    {
        if (!isset($request->email) || ($request->email == null)) {
            return response()->json(["status" => "0", "error" => "The email field is required"]);
        } elseif (!isset($request->provider_id) || ($request->provider_id == null)) {
            return response()->json(["status" => "0", "error" => "The provider id field is required"]);
        } elseif (!isset($request->provider) || ($request->provider == null)) {
            return response()->json(["status" => "0", "error" => "The provider field is required."]);
        } else {

            if ($status = $this->create($request->all())) {

                if (is_array($status)) {
                    return response()->json(["status" => "0", "message" => "email already exists"]);
                }

                $user = User::where('email', '=', $request->input('email'))
                        ->with(['profile', 'settings'])->first();


                if (Auth::loginUsingId($user->id)) {
                    // Authentication passed...
                    
                    // inserting into refferal table
                if(isset($request->parameters) || ($request->parameters != NULL)){
                    
                    $parameters = json_decode($request->parameters, true);
                    
                    DB::table('refferals')->insert([
                        'user_id' => $user->id,
                        'email' => $user->email,
                        'marketing_title' => $parameters['marketing_title'],
                        'parameters' => $request->parameters,
                        'is_coach_subscribed' => 0,
                        'created_at' => Carbon::now()
                    ]);
                }

                    if (Auth::user()->status == 1) {
                        try {
                            // verify the credentials and create a token for the user
                            if (!$token = JWTAuth::fromUser($user)) {
                                return response()->json(['status' => 0, 'error' => 'invalid_credentials'], 401);
                            }
                        } catch (JWTException $e) {
                            // something went wrong
                            return response()->json(['status' => 0, 'error' => 'could_not_create_token'], 500);
                        }

                        $user['workout_count'] = Workout::workoutCount($user->id);
                        $user['points'] = Point::userPoints($user->id);
                        $user['level'] = Point::userLevel($user->id);
                        $user['facebook_connect'] = Social::isFacebookConnect($user->id);
                        //follower count
                        $user['follower_count'] = Follow::followerCount($user->id);
                        // if no errors are encountered we can return a JWT
                        return response()->json(['status' => 1, 'success' => 'successfully_created_user', 'token' => $token, 'user' => $user->toArray(), 'urls' => config('urls.urls')], 200);
                    } else {
                        return response()->json(['status' => 0, 'error' => 'user_not_verified'], 401);
                    }
                } else {
                    return response()->json(['status' => 0, 'error' => 'invalid_credentials'], 422);
                }
                return response()->json(['status' => 1, 'success' => 'successfully_created_user', 'user' => $user->toArray()], 200);
            } else {
                return response()->json(['status' => 0, 'error' => 'could_not_create_user'], 500);
            }
        }
    }

    /**
     * Function to insert user details 
     * @since 09/11/2015
     * @author ansa@cubettech.com
     * @return json
     */
    protected function create(array $data)
    {
        $user_exist = User::where('email', '=', $data['email'])->first();

        if (!is_null($user_exist)) {
            return $response = array('email' => 1, 'status' => true);
        } else {
            //user table
            $user = User::create(['email' => $data['email'], 'status' => 1]);
            //user profile table
            $profile = new Profile([
                'first_name' => isset($data['first_name']) ? $data['first_name'] : '',
                'last_name' => isset($data['last_name']) ? $data['last_name'] : '',
                'gender' => isset($data['gender']) ? $data['gender'] : '',
                'fitness_status' => isset($data['fitness_status']) ? $data['fitness_status'] : '',
                'goal' => isset($data['goal']) ? $data['goal'] : '',
                'quote' => isset($data['quote']) ? $data['quote'] : ''
            ]);
            $userProfile = $user->profile()->save($profile);

            if (isset($data['image_url']) && $data['image_url'] != '') {

                $image = Image::make($data['image_url']);

                $image->encode('jpeg');

                $image->save(config('image.profileOriginalPath') . $user->id . '_' . time() . '.jpg');

                $image->crop(400, 400);

                $image->save(config('image.profileLargePath') . $user->id . '_' . time() . '.jpg');

                $image->crop(150, 150);

                $image->save(config('image.profileMediumPath') . $user->id . '_' . time() . '.jpg');

                $image->crop(65, 65);

                $image->save(config('image.profileSmallPath') . $user->id . '_' . time() . '.jpg');

                $user->profile()->update(['image' => $user->id . '_' . time() . '.jpg']);
            }
            if (isset($data['subscription'])) {
                Settings::create(['user_id' => $user->id,
                    'key' => 'subscription', 'value' => $data['subscription']
                ]);
            }
            //user social account table
            $social = new Social([
                'provider' => isset($data['provider']) ? $data['provider'] : '',
                'provider_uid' => $data['provider_id'],
                'access_token' => isset($data['access_token']) ? $data['access_token'] : '',
            ]);
            $socialAccount = $user->social()->save($social);

            $user = User::where('email', '=', $data['email'])->with(['profile'])->get();
            if (!is_null($user)) {
                return true;
            } else {
                return false;
            }
        }
    }

    /**
     * @api {post} /social/facebookLogin facebookLogin
     * @apiName facebookLogin
     * @apiGroup Social
     *
     * @apiParam {string} [first_name] Firstname of user 
     * @apiParam {string} [last_name] LastName of user 
     * @apiParam {string} [image_url] Facebook Profile Image Url of user 
     * @apiParam {string} [access_token] Access Token 
     * @apiParam {string} email email address of user *required
     * @apiParam {string} provider_id Facebook id of user *required
     * @apiParam {string} provider Provider,eg:facebook *required
     * @apiParam {string} [subscription] Permission flag 0/1
     * @apiParam {string} [gender] gender 
     * @apiParam {string} [fitness_status] fitness_status
     * @apiParam {string} [goal] goal 
     * @apiParam {string} [quote] quote 

     * @apiSuccess {String} success.
     * @apiSuccessExample Success-Response:
     *     HTTP/1.1 200 OK
     * {
      "status": 1,
      "success": "successfully_logged_in",
      "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOiI3NSIsImlzcyI6Imh0dHA6XC9cL3lraW5ncy5tZVwvYXBpXC9zb2NpYWxcL2ZhY2Vib29rTG9naW4iLCJpYXQiOiIxNDQ5NjYyODMyIiwiZXhwIjoiMTQ1MzI2MjgzMiIsIm5iZiI6IjE0NDk2NjI4MzIiLCJqdGkiOiI4Zjc1ZjliMmJjMzFmMmQ5OWIzZGUzYmI3OWMyM2QxYiJ9.DlOJuP45ticT3wHRVMLp3mgXFQCbbPUetHYK2ucjIJA",
      "user": {
      "id": "75",
      "email": "kiran.lm@cubettech.com",
      "confirmation_code": "",
      "status": "1",
      "created_at": "2015-12-04 10:24:06",
      "updated_at": "2015-12-04 10:24:06",
      "workout_count": 0,
      "points": 0,
      "level": 1,
      "facebook_connect": 1,
      "follower_count": 0,
      "is_subscribed": 0,
      "profile": [
      {
      "id": "59",
      "user_id": "75",
      "first_name": "kiran",
      "last_name": "",
      "gender": "0",
      "fitness_status": "0",
      "goal": "0",
      "image": "75_1449224652.jpg",
      "cover_image": "",
      "city": "",
      "state": "",
      "country": "",
      "spot": "",
      "quote": "",
      "instagram": "0",
      "twitter": "0",
      "facebook": "0",
      "fb": "0",
      "created_at": "2015-12-04 10:24:11",
      "updated_at": "2015-12-04 16:58:53",
      "level": 1
      }
      ],
      "settings": [
      {
      "id": "30",
      "user_id": "75",
      "key": "subscription",
      "value": "1",
      "created_at": "2015-12-04 10:24:11",
      "updated_at": "2015-12-04 10:24:11"
      },
      {
      "id": "31",
      "user_id": "75",
      "key": "notification",
      "value": "{\"comments\":\"1\",\"claps\":\"0\",\"follow\":\"0\",\"my_performance\":\"1\",\"motivation_knowledge\":\"1\"}",
      "created_at": "2015-12-04 10:24:11",
      "updated_at": "2015-12-04 10:24:11"
      }
      ]
      },
      "urls": {
      "profileImageSmall": "http://ykings.me/uploads/images/profile/small",
      "profileImageMedium": "http://ykings.me/uploads/images/profile/medium",
      "profileImageLarge": "http://ykings.me/uploads/images/profile/large",
      "profileImageOriginal": "http://ykings.me/uploads/images/profile/original",
      "video": "http://ykings.me/uploads/videos",
      "videothumbnail": "http://ykings.me/uploads/images/videothumbnails",
      "feedImageSmall": "http://ykings.me/uploads/images/feed/small",
      "feedImageMedium": "http://ykings.me/uploads/images/feed/medium",
      "feedImageLarge": "http://ykings.me/uploads/images/feed/large",
      "feedImageOriginal": "http://ykings.me/uploads/images/feed/original",
      "coverImageSmall": "http://ykings.me/uploads/images/cover_image/small",
      "coverImageMedium": "http://ykings.me/uploads/images/cover_image/medium",
      "coverImageLarge": "http://ykings.me/uploads/images/cover_image/large",
      "coverImageOriginal": "http://ykings.me/uploads/images/cover_image/original"
      }
      }
     * @apiError could_not_create_user User error.
     * @apiError Validation error.
     * @apiError Validation error
     * @apiError Validation error
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 500 could_not_create_user
     *     {
     *       "error": "could_not_create_user"
     *     }
     * 
     *  @apiErrorExample Error-Response:
     *  HTTP/1.1 422 Validation error
      {
      "status": 0,
      "error": "The email field is required."
      }
     * 
     * @apiErrorExample Error-Response:
     *  HTTP/1.1 422 Validation error
      {
      "status": 0,
      "error": "The provider id field is required"
      }
     * 
     * @apiErrorExample Error-Response:
     *  HTTP/1.1 422 Validation error
      {
      "status": 0,
      "error": "The provider field is required."
      }
     * 
     */
    public function facebookLogin(Request $request)
    {
        if (!isset($request->email) || ($request->email == null)) {
            return response()->json(["status" => "0", "error" => "The email field is required"]);
        } elseif (!isset($request->provider_id) || ($request->provider_id == null)) {
            return response()->json(["status" => "0", "error" => "The provider id field is required"]);
        } elseif (!isset($request->provider) || ($request->provider == null)) {
            return response()->json(["status" => "0", "error" => "The provider field is required."]);
        } else {
            if ($this->login($request->all())) {
                $user = User::where('email', '=', $request->input('email'))
                        ->with(['profile', 'settings'])->first();

                if (Auth::loginUsingId($user->id)) {
                    try {
                        // verify the credentials and create a token for the user
                        if (!$token = JWTAuth::fromUser($user)) {
                            return response()->json(['status' => 0, 'error' => 'invalid_credentials'], 401);
                        }
                    } catch (JWTException $e) {
                        // something went wrong
                        return response()->json(['status' => 0, 'error' => 'could_not_create_token'], 500);
                    }
                    $user['workout_count'] = Workout::workoutCount($user->id);
                    $user['points'] = Point::userPoints($user->id);
                    $user['level'] = Point::userLevel($user->id);
                    $user['facebook_connect'] = Social::isFacebookConnect($user->id);
                    //follower count
                    $user['follower_count'] = Follow::followerCount($user->id);
                    // if no errors are encountered we can return a JWT
                    return response()->json(['status' => 1, 'success' => 'successfully_logged_in', 'token' => $token, 'user' => $user->toArray(), 'urls' => config('urls.urls')], 200);
                } else {
                    return response()->json(['status' => 0, 'error' => 'invalid_credentials'], 422);
                }
                return response()->json(['status' => 1, 'success' => 'successfully_logged_in', 'user' => $user->toArray()], 200);
            } else {
                return response()->json(['status' => 0, 'error' => 'could_not_create_user'], 500);
            }
        }
    }

    /**
     * Function for facebook login
     * @since 04/12/2015
     * @author ansa@cubettech.com
     * @return json
     */
    protected function login(array $data)
    {
        $user_exist = User::where('email', '=', $data['email'])->first();

        if (!is_null($user_exist)) {

            $social = Social::where('user_id', '=', $user_exist->id)
                ->where('provider', '=', 'facebook')
                ->where('provider_uid', '!=', '')
                ->first();

            if (!is_null($social)) {
                return true;
            } else {
                //user social account table
                Social::create(['user_id' => $user_exist->id,
                    'provider' => isset($data['provider']) ? $data['provider'] : '',
                    'provider_uid' => $data['provider_id'],
                    'access_token' => isset($data['access_token']) ? $data['access_token'] : '',
                ]);
                User::where('email', '=', $data['email'])->update(['status' => 1]);
                //to do update profile details with new details
                $profile = Profile::where('user_id', '=', $user_exist->id)->first();

                $first_name = $profile->first_name;
                if (($profile->first_name == '') && (isset($data['first_name'])))
                    $first_name = $data['first_name'];

                $last_name = $profile->last_name;
                if (($profile->last_name == '') && (isset($data['last_name'])))
                    $last_name = $data['last_name'];

                $gender = $profile->gender;
                if (($profile->gender == '') && (isset($data['gender'])))
                    $gender = $data['gender'];

                $fitness_status = $profile->fitness_status;
                if (($profile->fitness_status == '') && (isset($data['fitness_status'])))
                    $fitness_status = $data['fitness_status'];

                $goal = $profile->goal;
                if (($profile->goal == '') && (isset($data['goal'])))
                    $goal = $data['goal'];

                $quote = $profile->quote;
                if (($profile->quote == '') && (isset($data['quote'])))
                    $quote = $data['quote'];

                $profile->update([
                    'first_name' => $first_name,
                    'last_name' => $last_name,
                    'gender' => $gender,
                    'fitness_status' => $fitness_status,
                    'goal' => $goal,
                    'quote' => $quote
                ]);

                if (isset($data['image_url']) && $data['image_url'] != '' && $profile->image == '') {

                    $image = Image::make($data['image_url']);

                    $image->encode('jpeg');

                    $image->save(config('image.profileOriginalPath') . $user_exist->id . '_' . time() . '.jpg');

                    $image->crop(400, 400);

                    $image->save(config('image.profileLargePath') . $user_exist->id . '_' . time() . '.jpg');

                    $image->crop(150, 150);

                    $image->save(config('image.profileMediumPath') . $user_exist->id . '_' . time() . '.jpg');

                    $image->crop(65, 65);

                    $image->save(config('image.profileSmallPath') . $user_exist->id . '_' . time() . '.jpg');

                    $profile->update(['image' => $user_exist->id . '_' . time() . '.jpg']);
                }
                return true;
            }
        } else {
            //user table
            $user = User::create(['email' => $data['email'], 'status' => 1]);

            //user profile table
            $profile = new Profile([
                'first_name' => isset($data['first_name']) ? $data['first_name'] : '',
                'last_name' => isset($data['last_name']) ? $data['last_name'] : '',
                'gender' => isset($data['gender']) ? $data['gender'] : '',
                'fitness_status' => isset($data['fitness_status']) ? $data['fitness_status'] : '',
                'goal' => isset($data['goal']) ? $data['goal'] : '',
                'quote' => isset($data['quote']) ? $data['quote'] : ''
            ]);
            $userProfile = $user->profile()->save($profile);

            if (isset($data['image_url']) && $data['image_url'] != '') {

                $image = Image::make($data['image_url']);

                $image->encode('jpeg');

                $image->save(config('image.profileOriginalPath') . $user->id . '_' . time() . '.jpg');

                $image->crop(400, 400);

                $image->save(config('image.profileLargePath') . $user->id . '_' . time() . '.jpg');

                $image->crop(150, 150);

                $image->save(config('image.profileMediumPath') . $user->id . '_' . time() . '.jpg');

                $image->crop(65, 65);

                $image->save(config('image.profileSmallPath') . $user->id . '_' . time() . '.jpg');

                $user->profile()->update(['image' => $user->id . '_' . time() . '.jpg']);
            }

            //user social account table
            $social = new Social([
                'provider' => isset($data['provider']) ? $data['provider'] : '',
                'provider_uid' => $data['provider_id'],
                'access_token' => isset($data['access_token']) ? $data['access_token'] : '',
            ]);

            $socialAccount = $user->social()->save($social);

            $user = User::where('email', '=', $data['email'])->with(['profile'])->get();
            if (!is_null($user)) {
                return true;
            } else {
                return false;
            }
        }
    }

    /**
     * @api {post} /social/facebookDisconnect facebookDisconnect
     * @apiName facebookDisconnect
     * @apiGroup Social
     * @apiParam {Number} user_id Id of user *required
     * @apiSuccess {String} success.
     * 
     * @apiSuccessExample Success-Response:
     * HTTP/1.1 200 OK
     *  {
      "status": 1,
      "success": "Facebook Disconnected"
      }
     * 
     * @apiError error Message token_invalid.
     * @apiError error Message token_expired.
     * @apiError error Message token_not_provided.
     * @apiError error Validation error.
     * @apiError error user_not_exists
     *
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 400 Invalid Request
     *     {
     *       "status" : 0,
     *       "error": "token_invalid"
     *     }
     * 
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 401 Unauthorised
     *     {
     *       "status" : 0,
     *       "error": "token_expired"
     *     }
     * 
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 400 Bad Request
     *     {
     *       "status" : 0,
     *       "error": "token_not_provided"
     *     }
     * 
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 400 Validation error
     *     {
     *       "status" : 0,
     *       "error": "The user_id field is required"
     *     }
     * 
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 400 user_not_exists
     *     {
     *       "status" : 0,
     *       "error": "user_not_exists"
     *     }  

     */
    public function facebookDisconnect(Request $request)
    {
        if (!isset($request->user_id) || ($request->user_id == null)) {
            return response()->json(["status" => "0", "error" => "The user_id field is required"]);
        } else {
            $user = User::where('id', '=', $request->input('user_id'))->first();
            if ($user) {
                $social = Social::where('user_id', '=', $request->user_id)
                    ->where('provider', '=', 'facebook')
                    ->where('provider_uid', '!=', '')
                    ->first();

                if (!is_null($social)) {
                    $social->delete();
                    return response()->json(['status' => 1, 'success' => 'Facebook Disconnected'], 200);
                }
            } else {
                return response()->json(['status' => 0, 'error' => 'user_not_exists'], 422);
            }
        }
    }
}
