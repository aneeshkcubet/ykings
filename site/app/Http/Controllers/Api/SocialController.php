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
     * @api {post} /social/facebookLogin?token= facebookLogin
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

            if ($status = $this->create($request->all())) {

                if (is_array($status)) {
                    return response()->json(["status" => "0", "message" => "confirmation_required"]);
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
    protected function create(array $data)
    {
        $user_exist = User::where('email', '=', $data['email'])->first();
        if (!is_null($user_exist)) {
         $social = Social::where('user_id', '=', $user_exist->id)
                ->where('provider', '=', 'facebook')
                ->where('provider_uid', '!=', '')
                ->first();

//            $facebook_link = 0;
//            if (!is_null($social)) {
//                //to do update profile details with new details
//                $profile = Profile::where('user_id', $user_exist->id);
//                $profile->update([
//                    'first_name' => isset($data['first_name']) ? $data['first_name'] : '',
//                    'last_name' => isset($data['last_name']) ? $data['last_name'] : '',
//                    'gender' => isset($data['gender']) ? $data['gender'] : '',
//                    'fitness_status' => isset($data['fitness_status']) ? $data['fitness_status'] : '',
//                    'goal' => isset($data['goal']) ? $data['goal'] : '',
//                    'quote' => isset($data['quote']) ? $data['quote'] : ''
//                ]);
                return true;
//            } else {
//                return $response = array('facebook_link' => 0, 'status' => true);
//            }
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
     * @api {post} /social/facebookUpdate facebookUpdate
     * @apiName facebookUpdate
     * @apiGroup Social
     *
     * @apiParam {string} first_name Firstname of user *optional
     * @apiParam {string} last_name Firstname of user *optional
     * @apiParam {string} email email address of user *readonly *required 
     * @apiParam {number} gender gender of the user 1-Male, 2-Female *optional
     * @apiParam {number} fitness_status user's self assessment about fitness 1-I am definitely fit, 2-I am quite fit, 3-I am not so fit *optional
     * @apiParam {file} image user avatar image *optional *accepted formats JPEG, PNG, and GIF
     * @apiParam {number} goal user's goal *optional
     * @apiParam {string} city user's city *optional
     * @apiParam {string} state user's state *optional
     * @apiParam {string} country user's country *optional
     * @apiParam {string} quote Quote added by user *optional
     * @apiParam {number} subscription Whether Newsletter subscription selected by user *optional
     *
     * @apiSuccess {String} success.
     * 
     * @apiSuccessExample Success-Response:
     * HTTP/1.1 200 OK
     *       {
     *           "status" : 1,
     *           "success": "successfully_updated_user_profile",
     *           "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOiIyIiwiaXNzIjoiaHR0cDpcL1wvbG9jYWxob3N0OjgwMDBcL2FwaVwvdXNlclwvbG9naW4iLCJpYXQiOiIxNDQ3MjQ2NTc1IiwiZXhwIjoiMTQ0NzYwNjU3NSIsIm5iZiI6IjE0NDcyNDY1NzUiLCJqdGkiOiI2ZTBlN2JlMDI5YTJjZTVkODM4MzkwY2EyZmE0MGNkMSJ9.lFwueZXytFQhLcfX6GZ1fwp5wmtPT1GenTZpx3p2jKQ",
     *           "user": {
     *               "id": "2",
     *               "email": "aneeshk@cubettech.com",
     *               "confirmation_code": "d6grRYINWtcDH18bXc358M9ZDDFExd",
     *               "status": "1",
     *               "created_at": "2015-11-11 11:40:04",
     *               "updated_at": "2015-11-11 11:40:04",
     *               "profile": {
     *                   "id": "2",
     *                   "user_id": "2",
     *                   "first_name": "Aneesh",
     *                   "last_name": "Kallikkattil",
     *                   "gender": "0",
     *                   "fitness_status": "0",
     *                   "goal": "0",
     *                   "image": "2_1447242011.jpg",
     *                   "city": "",
     *                   "state": "",
     *                   "country": "",
     *                   "quote": "",
     *                   "created_at": "2015-11-11 11:40:10",
     *                   "updated_at": "2015-11-11 11:40:11"
     *               },
     *               "videos": [
     *                   {
     *                       "id": "2",
     *                       "user_id": "2",
     *                       "video_id": "1",
     *                       "created_at": "2015-11-11 11:40:05",
     *                       "updated_at": "2015-11-11 11:40:05",
     *                       "video": {
     *                           "id": "1",
     *                           "user_id": "1",
     *                           "path": "Now1.mp4",
     *                           "description": "Test Description",
     *                           "parent_type": "1",
     *                           "type": "1",
     *                           "parent_id": "1",
     *                           "created_at": "2015-11-11 07:26:40",
     *                           "updated_at": "2015-11-11 17:43:27"
     *                       }
     *                   }
     *               ]
     *           },
     *           "urls": {
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
     *       }
     * @apiError error Message token_invalid.
     * @apiError error Message token_expired.
     * @apiError error Validation error.
     * @apiError error Message could_not_update_user_profile User error.
     * @apiError error Message user_updated_but_we_accept_only_jpeg_gif_png_files_as_profile_images User error.
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
     *       "error": "The email field is required."
     *     }
     * 
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 500 could_not_create_user
     *     {
     *       "status" : 0,
     *       "error": "could_not_create_user"
     *     }
     * 
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 500 user_created_but_we_accept_only_jpeg_gif_png_files_as_profile_images
     *     {
     *       "error": "user_updated_but_we_accept_only_jpeg_gif_png_files_as_profile_images"
     *     }
     */
    public function facebookUpdate(Request $request)
    {
        $data = $request->all();

        if (!isset($request->email) || ($request->email == NULL)) {
            return response()->json([ "status" => "0", "error" => "The email field is required."]);
        }

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
            $profData ['city'] = $data['city'];
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

            if (isset($_FILES['image']) && $_FILES['image']['error'] == UPLOAD_ERR_OK) {

                $accepableTypes = ['image/jpeg', 'image/gif', 'image/png', 'image/jpg', 'image/pjpeg', 'image/x-png'];

                if (!in_array($_FILES ['image'] ['type'], $accepableTypes)) {
                    return response()->json(['error' => 'user_created_but_we_accept_only_jpeg_gif_png_files_as_profile_images'], 500);
                }

                $image = Image::make($_FILES['image']['tmp_name']);

                $image->encode('jpeg');

                $image->save(config('image.profileOriginalPath') . $user->id . '_' . time() . '.jpg');

                $image->fit(400, 400);

                $image->save(config('image.profileLargePath') . $user->id . '_' . time() . '.jpg');

                $image->fit(150, 150);

                $image->save(config('image.profileMediumPath') . $user->id . '_' . time() . '.jpg');

                $image->fit(65, 65);

                $image->save(config('image.profileSmallPath') . $user->id . '_' . time() . '.jpg');

                $user->profile()->update(['image' => $user->id . '_' . time() . '.jpg']);
            }

            $user = User::where('email', '=', $request->input('email'))->with([ 'profile', 'videos'])->first();

            if (isset($data['subscription'])) {
                Settings::where('user_id', '=', $user->id)
                    ->where('key', '=', 'subscription')
                    ->update(['value' => $data['subscription']]);
            }

            return response()->json(['status' => 1, 'success' => 'successfully_updated_user_profile', 'user' => $user->toArray(), 'urls' => config('urls.urls')], 200);
        } else {
            return response()->json(['status' => 0, 'error' => 'could_not_update_user'], 500);
        }
    }
}
