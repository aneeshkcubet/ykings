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
     * @api {post} /social/facebookLogin facebookLogin
     * @apiName Facebook Login
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
    "comments": [
        {
            "id": "1",
            "user_id": "14",
            "parent_type": "feed",
            "parent_id": "15",
            "comment_text": "This is a sample comment",
            "created_at": "2015-11-16 13:53:47",
            "updated_at": "2015-11-17 13:01:09",
            "user": {
                "id": "14",
                "email": "sachin@cubettech.com",
                "profile": [
                    {
                        "id": "8",
                        "user_id": "14",
                        "first_name": "sachii",
                        "last_name": "k",
                        "gender": "0",
                        "fitness_status": "0",
                        "goal": "0",
                        "image": null,
                        "city": null,
                        "state": null,
                        "country": null,
                        "quote": "",
                        "created_at": "2015-11-11 06:23:56",
                        "updated_at": "2015-11-11 06:23:56"
                    }
                ]
            }
        },
        {
            "id": "2",
            "user_id": "11",
            "parent_type": "feed",
            "parent_id": "15",
            "comment_text": "This is another comment",
            "created_at": "2015-11-16 13:55:14",
            "updated_at": "2015-11-17 13:02:38",
            "user": {
                "id": "11",
                "email": "ansa@cubettech.com",
                "profile": [
                    {
                        "id": "7",
                        "user_id": "11",
                        "first_name": "ansa",
                        "last_name": "v",
                        "gender": "0",
                        "fitness_status": "0",
                        "goal": "0",
                        "image": "11_1447237788.jpg",
                        "city": null,
                        "state": null,
                        "country": null,
                        "quote": "",
                        "created_at": "2015-11-09 12:40:07",
                        "updated_at": "2015-11-12 09:05:16"
                    }
                ]
            }
        }
    ],
    "urls": {
        "profileImageSmall": "http://ykings.me/uploads/images/profile/small",
        "profileImageMedium": "http://ykings.me/uploads/images/profile/medium",
        "profileImageLarge": "http://ykings.me/uploads/images/profile/large",
        "profileImageOriginal": "http://ykings.me/uploads/images/profile/original",
        "video": "http://ykings.me/uploads/videos",
        "feedImageSmall": "http://ykings.me/uploads/images/feed/small",
        "feedImageMedium": "http://ykings.me/uploads/images/feed/medium",
        "feedImageLarge": "http://ykings.me/uploads/images/feed/large",
        "feedImageOriginal": "http://ykings.me/uploads/images/feed/original"
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
     * {
      "status": 0,
      "error": {
      "email": [
      "The email field is required."
      ],
      "provider_id": [
      "The provider id field is required."
      ],
      "provider": [
      "The provider field is required."
      ]
      }
      }
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

            if ($this->create($request->all())) {

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
     * Function to insert user details 
     * @since 09/11/2015
     * @author ansa@cubettech.com
     * @return json
     */
    public function create(array $data)
    {
        $user_exist = User::where('email', '=', $data['email'])->first();
        if (!is_null($user_exist)) {
            return true;
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
                'provider' => isset($data['access_token']) ? $data['access_token'] : '',
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
