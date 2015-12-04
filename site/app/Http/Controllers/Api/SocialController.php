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
     * @api {post} /social/facebookSignUp
     * @apiName facebookSignUp
     * @apiGroup Social
     *
     * @apiParam {string} [first_name] Firstname of user 
     * @apiParam {string} [last_name] LastName of user 
     * @apiParam {string} [image_url] Facebook Profile Image Url of user 
     * @apiParam {string} [access_token] Access Token 
     * @apiParam {string} email email address of user *required
     * @apiParam {string} provider_id Facebook id of user *required
     * @apiParam {string} provider Provider,eg:facebook
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
      "success": "successfully_created_user",
      "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOiIxMSIsImlzcyI6Imh0dHA6XC9cL3lraW5ncy5tZVwvYXBpXC9zb2NpYWxcL2ZhY2Vib29rTG9naW4iLCJpYXQiOiIxNDQ4NjE2ODM3IiwiZXhwIjoiMTQ1MjIxNjgzNyIsIm5iZiI6IjE0NDg2MTY4MzciLCJqdGkiOiI5NGMyOWM4YzdlM2I0MWM3ODA0M2U5MjZkN2Y0MzM2YyJ9.pi1yBYNrszaS5mN1VT6du6nqenVu9Bga51T8WmxNn5w",
      "user": {
      "id": "11",
      "email": "ansa@cubettech.com",
      "confirmation_code": null,
      "status": "1",
      "created_at": "2015-11-09 12:40:07",
      "updated_at": "2015-11-09 12:40:07",
      "facebook_connect": 1,
      "is_subscribed": 0,
      "profile": [
      {
      "id": "7",
      "user_id": "11",
      "first_name": "",
      "last_name": "",
      "gender": "0",
      "fitness_status": "0",
      "goal": "0",
      "image": "11_1447237788.jpg",
      "city": null,
      "state": null,
      "country": null,
      "spot": "",
      "quote": "",
      "created_at": "2015-11-09 12:40:07",
      "updated_at": "2015-11-27 09:33:57"
      }
      ],
      "social": [
      {
      "id": "2",
      "user_id": "11",
      "provider": "facebook",
      "provider_uid": "123456789",
      "access_token": "",
      "created_at": "2015-11-09 12:40:07",
      "updated_at": "2015-11-09 12:40:07"
      }
      ]
      },
      "urls": {
      "profileImageSmall": "http://sandbox.ykings.com/uploads/images/profile/small",
      "profileImageMedium": "http://sandbox.ykings.com/uploads/images/profile/medium",
      "profileImageLarge": "http://sandbox.ykings.com/uploads/images/profile/large",
      "profileImageOriginal": "http://sandbox.ykings.com/uploads/images/profile/original",
      "video": "http://sandbox.ykings.com/uploads/videos",
      "videothumbnail": "http://sandbox.ykings.com/uploads/images/videothumbnails",
      "feedImageSmall": "http://sandbox.ykings.com/uploads/images/feed/small",
      "feedImageMedium": "http://sandbox.ykings.com/uploads/images/feed/medium",
      "feedImageLarge": "http://sandbox.ykings.com/uploads/images/feed/large",
      "feedImageOriginal": "http://sandbox.ykings.com/uploads/images/feed/original",
      "coverImageSmall": "http://sandbox.ykings.com/uploads/images/cover_image/small",
      "coverImageMedium": "http://sandbox.ykings.com/uploads/images/cover_image/medium",
      "coverImageLarge": "http://sandbox.ykings.com/uploads/images/cover_image/large",
      "coverImageOriginal": "http://sandbox.ykings.com/uploads/images/cover_image/original"
      }
      }
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
     *  @apiErrorExample Error-Response:
     *      HTTP/1.1 422 Validation error
      {
      "status": 0,
      "error": "The email field is required."
      }
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 422 Validation error
     *     {
     *       "error": "could_not_create_user"
     *     }
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
                        ->with(['profile', 'social'])->first();


                if (Auth::loginUsingId($user->id)) {
                    // Authentication passed...

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
                        $user['facebook_connect'] = Social::isFacebookConnect($user->id);
                        // if no errors are encountered we can return a JWT
                        return response()->json(['status' => 1, 'success' => 'successfully_logged_in', 'token' => $token, 'user' => $user->toArray(), 'urls' => config('urls.urls')], 200);
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
     * @api {post} /social/facebookLogin
     * @apiName facebookLogin
     * @apiGroup Social
     *
     * @apiParam {string} [first_name] Firstname of user 
     * @apiParam {string} [last_name] LastName of user 
     * @apiParam {string} [image_url] Facebook Profile Image Url of user 
     * @apiParam {string} [access_token] Access Token 
     * @apiParam {string} email email address of user *required
     * @apiParam {string} provider_id Facebook id of user *required
     * @apiParam {string} provider Provider,eg:facebook
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
      "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOiIxMSIsImlzcyI6Imh0dHA6XC9cL3lraW5ncy5tZVwvYXBpXC9zb2NpYWxcL2ZhY2Vib29rTG9naW4iLCJpYXQiOiIxNDQ4NjE2ODM3IiwiZXhwIjoiMTQ1MjIxNjgzNyIsIm5iZiI6IjE0NDg2MTY4MzciLCJqdGkiOiI5NGMyOWM4YzdlM2I0MWM3ODA0M2U5MjZkN2Y0MzM2YyJ9.pi1yBYNrszaS5mN1VT6du6nqenVu9Bga51T8WmxNn5w",
      "user": {
      "id": "11",
      "email": "ansa@cubettech.com",
      "confirmation_code": null,
      "status": "1",
      "created_at": "2015-11-09 12:40:07",
      "updated_at": "2015-11-09 12:40:07",
      "facebook_connect": 1,
      "is_subscribed": 0,
      "profile": [
      {
      "id": "7",
      "user_id": "11",
      "first_name": "",
      "last_name": "",
      "gender": "0",
      "fitness_status": "0",
      "goal": "0",
      "image": "11_1447237788.jpg",
      "city": null,
      "state": null,
      "country": null,
      "spot": "",
      "quote": "",
      "created_at": "2015-11-09 12:40:07",
      "updated_at": "2015-11-27 09:33:57"
      }
      ],
      "social": [
      {
      "id": "2",
      "user_id": "11",
      "provider": "facebook",
      "provider_uid": "123456789",
      "access_token": "",
      "created_at": "2015-11-09 12:40:07",
      "updated_at": "2015-11-09 12:40:07"
      }
      ]
      },
      "urls": {
      "profileImageSmall": "http://sandbox.ykings.com/uploads/images/profile/small",
      "profileImageMedium": "http://sandbox.ykings.com/uploads/images/profile/medium",
      "profileImageLarge": "http://sandbox.ykings.com/uploads/images/profile/large",
      "profileImageOriginal": "http://sandbox.ykings.com/uploads/images/profile/original",
      "video": "http://sandbox.ykings.com/uploads/videos",
      "videothumbnail": "http://sandbox.ykings.com/uploads/images/videothumbnails",
      "feedImageSmall": "http://sandbox.ykings.com/uploads/images/feed/small",
      "feedImageMedium": "http://sandbox.ykings.com/uploads/images/feed/medium",
      "feedImageLarge": "http://sandbox.ykings.com/uploads/images/feed/large",
      "feedImageOriginal": "http://sandbox.ykings.com/uploads/images/feed/original",
      "coverImageSmall": "http://sandbox.ykings.com/uploads/images/cover_image/small",
      "coverImageMedium": "http://sandbox.ykings.com/uploads/images/cover_image/medium",
      "coverImageLarge": "http://sandbox.ykings.com/uploads/images/cover_image/large",
      "coverImageOriginal": "http://sandbox.ykings.com/uploads/images/cover_image/original"
      }
      }
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
     *  @apiErrorExample Error-Response:
     *      HTTP/1.1 422 Validation error
      {
      "status": 0,
      "error": "The email field is required."
      }
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 422 Validation error
     *     {
     *       "error": "could_not_create_user"
     *     }
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
                        ->with(['profile', 'social'])->first();

                if (Auth::loginUsingId($user->id)) {
                    // Authentication passed...

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
                        $user['facebook_connect'] = Social::isFacebookConnect($user->id);
                        // if no errors are encountered we can return a JWT
                        return response()->json(['status' => 1, 'success' => 'successfully_logged_in', 'token' => $token, 'user' => $user->toArray(), 'urls' => config('urls.urls')], 200);
                    } else {
                        return response()->json(['status' => 0, 'error' => 'user_not_verified'], 401);
                    }
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

}
