<?php namespace App\Http\Controllers\Api;

use Validator,
    Hash,
    Mail,
    Auth,
    Image,
    Redirect,
    DB;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Exceptions\InvalidConfirmationCodeException;
use Carbon\Carbon;
use App\User;
use App\Profile;
use App\Settings;
use App\Follow;
use App\Social;
use App\PushNotification;
use App\Feeds;
use App\Exercise;
use App\Workout;
use App\Hiit;
use App\Exerciseuser;
use App\Workoutuser;
use App\Hiituser;
use App\Point;
use App\Skill;
use App\Musclegroup;

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
     * @api {post} /user CreateUserAccount
     * @apiName CreateUserAccount
     * @apiGroup User
     *
     * @apiParam {string} first_name Firstname of user *required
     * @apiParam {string} last_name Firstname of user *required
     * @apiParam {string} email email address of user *required
     * @apiParam {string} password password added by user *required
     * @apiParam {file} [image] user avatar image *accepted formats JPEG, PNG, and GIF
     * @apiParam {number} [gender] user id of the user 1-Male, 2-Female 
     * @apiParam {number} [fitness_status] user's self assessment about fitness 1-I am definitely fit, 2-I am quite fit, 3-I am not so fit *optional
     * @apiParam {number} [goal] user's goal 1-Get Lean, 2-Get Fit, 3-Get Strong 
     * @apiParam {string} [city] user's city 
     * @apiParam {string} [state] user's state 
     * @apiParam {string} [country] user's country 
     * @apiParam {string} [spot] spot
     * @apiParam {string} [device_token] Device Token
     * @apiParam {string} [device_type] Device Type(android/ios)
     * @apiParam {string} [quote] Quote added by user
     * @apiParam {number} [subscription] Whether Newsletter subscription selected by user 
     * @apiSuccess {String} success.
     * 
     * @apiSuccessExample Success-Response:
     *     HTTP/1.1 200 OK
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
     *                   "gender": 0,
     *                   "fitness_status": 0,
     *                   "goal": 0,
     *                   "image": "2_1447242011.jpg",
     *                   "city": "",
     *                   "state": "",
     *                   "country": "",
      "spot": "",
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
     *               "profileImageSmall": "http://sandbox.ykings.com/uploads/images/profile/small",
     *               "profileImageMedium": "http://sandbox.ykings.com/uploads/images/profile/medium",
     *               "profileImageLarge": "http://sandbox.ykings.com/uploads/images/profile/large",
     *               "profileImageOriginal": "http://sandbox.ykings.com/uploads/images/profile/original",
     *               "video": "http://sandbox.ykings.com/uploads/videos",
     *               "feedImageSmall": "http://sandbox.ykings.com/uploads/images/feed/small",
     *               "feedImageMedium": "http://sandbox.ykings.com/uploads/images/feed/medium",
     *               "feedImageLarge": "http://sandbox.ykings.com/uploads/images/feed/large",
     *               "feedImageOriginal": "http://sandbox.ykings.com/uploads/images/feed/original"
     *           }
     *       }
     *
     * @apiError error Message token_invalid.
     * @apiError error Message token_expired.
     * @apiError error Message token_not_provided.
     * @apiError error Validation error.
     * @apiError error Validation error.
     * @apiError error Validation error.
     * @apiError error Validation error.
     * @apiError error Message user_created_but_we_accept_only_jpeg_gif_png_files_as_profile_images.
     * @apiError could_not_create_user User error.
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
     *     HTTP/1.1 400 Validation error
     *     {
     *       "status" : 0,
     *       "error": "The password field is required."
     *     }
     * 
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 400 Validation error
     *     {
     *       "status" : 0,
     *       "error": "The first_name field is required"
     *     }
     * 
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 400 Validation error
     *     {
     *       "status" : 0,
     *       "error": "The last_name field is required"
     *     }
     * 
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 422 This email already signed up with us.
     *     {
     *       "status" : 0,
     *       "error": "This email already signed up with us."
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
     *       "status" : 0,
     *       "error": "user_created_but_we_accept_only_jpeg_gif_png_files_as_profile_images"
     *     }
     */
    public function postRegister(Request $request)
    {
        if (!isset($request->email) || ($request->email == NULL)) {
            return response()->json([ "status" => 0, "error" => "The email field is required."]);
        } elseif (!isset($request->password) || ($request->password == NULL)) {
            return response()->json([ "status" => 0, "error" => "The password field is required."]);
        } elseif (!isset($request->first_name) || ($request->first_name == NULL)) {
            return response()->json(["status" => 0, "error" => "The first_name field is required"]);
        } elseif (!isset($request->last_name) || ($request->last_name == NULL)) {
            return response()->json([ "status" => 0, "error" => "The last_name field is required"]);
        } else {

            $user = User::where('email', '=', $request->email)->first();

            if (!is_null($user)) {
                return response()->json([ "status" => 0, "error" => "This email already signed up with us."], 422);
            }

            if ($this->create($request->all())) {
                $user = User::where('email', '=', $request->input('email'))->with(['profile', 'videos'])->first();

                if (isset($_FILES['image']) && $_FILES['image']['error'] == UPLOAD_ERR_OK) {

//                    $accepableTypes = ['image/jpeg', 'image/gif', 'image/png', 'image/jpg', 'image/pjpeg', 'image/x-png'];
//
//                    if (!in_array($_FILES ['image'] ['type'], $accepableTypes)) {
//                        return response()->json(['error' => 'user_created_but_we_accept_only_jpeg_gif_png_files_as_profile_images'], 500);
//                    }

                    $image = Image::make($_FILES['image']['tmp_name']);

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
                $user = User::where('email', '=', $request->input('email'))->with([ 'profile',
                        'videos'])->first();
                $userArray = $user->toArray();

                $userArray['follower_count'] = DB::table('follows')->where('follow_id', '=', $user['id'])->count();
                $userArray['workout_count'] = Workout::workoutCount($user['id']);
                $userArray['points'] = Point::userPoints($user['id']);
                $userArray['level'] = Point::userLevel($user['id']);

                //Code to check facebook connected for user.
                //Added by ansa@cubettech.com on 27-11-2015
                $userArray['facebook_connected'] = Social::isFacebookConnect($user['id']);
                return response()->json(['status' => 1, 'success' => 'successfully_created_user', 'user' => $userArray, 'urls' => config('urls.urls')], 200);
            } else {
                return response()->json(['status' => 0, 'error' => 'could_not_create_user'], 500);
            }
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
            'gender' => isset($data['gender']) ? $data['gender'] : '',
            'fitness_status' => isset($data['fitness_status']) ? $data['fitness_status'] : '',
            'goal' => isset($data['goal']) ? $data['goal'] : '',
            'city' => isset($data['city']) ? $data['city'] : '',
            'state' => isset($data['state']) ? $data['state'] : '',
            'country' => isset($data['country']) ? $data['country'] : '',
            'spot' => isset($data['spot']) ? $data['spot'] : '',
            'quote' => isset($data['quote']) ? $data['quote'] : '']);


        $userProfile = $user->profile()->save($profile);

        $user = User::where('email', '=', $data['email'])->with([ 'profile'])->first();

        if (isset($data['subscription'])) {
            Settings::create(['user_id' => $user->id,
                'key' => 'subscription', 'value' => $data['subscription']
            ]);
        }

        //Code added by <ansa@cubettech.com> on 31-12-2015
        //To save device token
        if (isset($request->device_token) && (isset($request->device_type))) {
            $deviceToken = PushNotification::create(['user_id' => $user->id,
                    'type' => $request->device_token,
                    'device_token' => $request->device_token
            ]);
        }

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
     * @apiParam {string} [first_name] Firstname of user *optional
     * @apiParam {string} [last_name] Firstname of user *optional
     * @apiParam {string} email email address of user *readonly *required 
     * @apiParam {number} [gender] gender of the user 1-Male, 2-Female 
     * @apiParam {number} [fitness_status] user's self assessment about fitness 1-I am definitely fit, 2-I am quite fit, 3-I am not so fit *optional
     * @apiParam {file} [image] user avatar image  *accepted formats JPEG, PNG, and GIF
     * @apiParam {file} [cover_image] user cover_image
     * @apiParam {number} [goal] user's goal
     * @apiParam {string} [city] user's city
     * @apiParam {string} [state] user's state 
     * @apiParam {string} [country] user's country 
     * @apiParam {string} [spot] spot
     * @apiParam {string} [twitter] twitter
     * @apiParam {string} [facebook] facebook
     * @apiParam {string} [instagram] instagram
     * @apiParam {string} [quote] Quote added by user 
     * @apiParam {number} [subscription] Whether Newsletter subscription selected by user 
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
     *                   "gender": 0,
     *                   "fitness_status": 0,
     *                   "goal": 0,
     *                   "image": "2_1447242011.jpg",
     *                   "cover_image": "",
     *                   "city": "",
     *                   "state": "",
     *                   "country": "",
     *                   "spot": "",
     *                   "twitter": "",
     *                   "facebook": "",
     *                   "instagram": "",
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
     *            "urls": {
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
    public function update(Request $request)
    {
        $data = $request->all();

        if (!isset($request->email) || ($request->email == NULL)) {
            return response()->json([ "status" => 0, "error" => "The email field is required."]);
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

        if (isset($data['spot'])) {
            $profData['spot'] = $data['spot'];
        }

        if (isset($data['twitter'])) {
            $profData['twitter'] = $data['twitter'];
        }

        if (isset($data['facebook'])) {
            $profData['facebook'] = $data['facebook'];
        }

        if (isset($data['instagram'])) {
            $profData['instagram'] = $data['instagram'];
        }

        if ($user = User::where('email', '=', $data['email'])->with(['profile'])->first()) {

            $user->profile()->update($profData);

            $user = User::where('email', '=', $request->input('email'))->with(['profile'])->first();

            if (isset($_FILES['image']) && $_FILES['image']['error'] == UPLOAD_ERR_OK) {

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

            if (isset($_FILES['cover_image']) && $_FILES['cover_image']['error'] == UPLOAD_ERR_OK) {

                $image = Image::make($_FILES['cover_image']['tmp_name']);

                $image->encode('jpeg');

                $image->save(config('image.coverOriginalPath') . $user->id . '_' . time() . '.jpg');

                $image->fit(400, 400);

                $image->save(config('image.coverLargePath') . $user->id . '_' . time() . '.jpg');

                $image->fit(150, 150);

                $image->save(config('image.coverMediumPath') . $user->id . '_' . time() . '.jpg');

                $image->fit(65, 65);

                $image->save(config('image.coverSmallPath') . $user->id . '_' . time() . '.jpg');

                $user->profile()->update(['cover_image' => $user->id . '_' . time() . '.jpg']);
            }
            $user = User::where('email', '=', $request->input('email'))->with([ 'profile', 'videos'])->first();

            if (isset($data['subscription'])) {
                Settings::where('user_id', '=', $user->id)
                    ->where('key', '=', 'subscription')
                    ->update(['value' => $data['subscription']]);
            }

            $userArray = $user->toArray();

            $userArray['follower_count'] = DB::table('follows')->where('follow_id', '=', $user['id'])->count();
            $userArray['workout_count'] = Workout::workoutCount($user['id']);
            $userArray['points'] = Point::userPoints($user['id']);
            $userArray['level'] = Point::userLevel($user['id']);

            //Code to check facebook connected for user.
            //Added by ansa@cubettech.com on 27-11-2015
            $userArray['facebook_connected'] = Social::isFacebookConnect($user['id']);

            return response()->json(['status' => 1, 'success' => 'successfully_updated_user_profile', 'user' => $userArray, 'urls' => config('urls.urls')], 200);
        } else {
            return response()->json(['status' => 0, 'error' => 'could_not_update_user'], 500);
        }
    }

    /**
     * @api {post} /user/login LoginUser
     * @apiName LoginUser
     * @apiGroup User
     *
     * @apiParam {string} email email address of user *required
     * @apiParam {string} password password added by user *required
     * @apiParam {string} [device_token] Device Token
     * @apiParam {string} [device_type] Device Type(android/ios)
     * @apiSuccess {String} success.
     *
     * @apiSuccessExample Success-Response:
     * HTTP/1.1 200 OK
     * {
      "status": 1,
      "success": "successfully_logged_in",
      "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOiI0MSIsImlzcyI6Imh0dHA6XC9cL3lraW5ncy5tZVwvYXBpXC91c2VyXC9sb2dpbiIsImlhdCI6IjE0NDk2NjMwMTMiLCJleHAiOiIxNDUzMjYzMDEzIiwibmJmIjoiMTQ0OTY2MzAxMyIsImp0aSI6IjlmYmZhNDE1ODMzZGEzMDkyNzdkMDg3MWMyMmQ1NWQyIn0.pcjqabawygOzEvd3TliSIIAwWAG5gDJstABHWK_0D2c",
      "user": {
      "id": "41",
      "email": "arun@ileafsolutions.net",
      "confirmation_code": "",
      "status": "1",
      "created_at": "2015-11-16 15:24:09",
      "updated_at": "2015-11-16 16:32:47",
      "is_subscribed": 0,
      "profile": [
      {
      "id": "31",
      "user_id": "41",
      "first_name": "arun",
      "last_name": "mg",
      "gender": "1",
      "fitness_status": "3",
      "goal": "1",
      "image": "41_1449060497.jpg",
      "cover_image": "",
      "city": "",
      "state": "",
      "country": "",
      "spot": "",
      "quote": "",
      "instagram": 0,
      "twitter": 0,
      "facebook": 0,
      "fb": 0,
      "created_at": "2015-11-16 15:24:09",
      "updated_at": "2015-12-02 18:18:17",
      "level": 1
      }
      ],
      "settings": [
      {
      "id": "22",
      "user_id": "41",
      "key": "subscription",
      "value": "1",
      "created_at": "2015-12-03 09:52:37",
      "updated_at": "2015-12-03 11:54:07"
      },
      {
      "id": "23",
      "user_id": "41",
      "key": "notification",
      "value": "{\"comments\":\"1\",\"claps\":\"1\",\"follow\":\"1\",\"my_performance\":\"1\",\"motivation_knowledge\":\"1\"} ",
      "created_at": "2015-12-03 09:52:37",
      "updated_at": "2015-12-03 12:05:31"
      }
      ],
      "follower_count": 3,
      "workout_count": 0,
      "points": 0,
      "level": 1,
      "facebook_connected": 0
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
     *
     * @apiError error Message token_invalid.
     * @apiError error Message token_expired.
     * @apiError error Message token_not_provided.
     * @apiError error Validation error.
     * @apiError error Validation error.
     * @apiError error user_not_verified User error.
     * @apiError error invalid_credentials User error.
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
     *     HTTP/1.1 400 Validation error
     *     {
     *       "status" : 0,
     *       "error": "The password field is required."
     *     }
     *  
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 400 Validation error
     *     {
     *       "status" : 0,
     *       "error": "The password field is required."
     *     }
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 422 user_not_verified
     *     {
     *       "status" : 0,
     *       "error": "user_not_verified"
     *     }
     * 
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 401 invalid_credentials
     *     {
     *       "status" : 0,
     *       "error": "invalid_credentials"
     *     }
     */
    public function login(Request $request)
    {
        $data = $request->all();

        if (!isset($request->email) || ($request->email == NULL)) {
            return response()->json([ "status" => 0, "error" => "The email field is required."]);
        } elseif (!isset($request->password) || ($request->password == NULL)) {
            return response()->json([ "status" => 0, "error" => "The password field is required."]);
        }

        if (Auth::attempt([ 'email' => $data['email'], 'password' => $data['password']])) {
            // Authentication passed...

            if (Auth::user()->status == 1) {
                $user = User::where('id', '=', Auth::user()->id)->with(['profile', 'settings'])->first();

                try {
                    // verify the credentials and create a token for the user
                    if (!$token = JWTAuth::fromUser($user)) {
                        return response()->json([ 'status' => 0, 'error' => 'invalid_credentials'], 401);
                    }
                } catch (JWTException $e) {
                    // something went wrong
                    return response()->json([ 'status' => 0, 'error' => 'could_not_create_token'], 500);
                }

                //Code added by <ansa@cubettech.com> on 31-12-2015
                //To save device token
                if (isset($request->device_token) && (isset($request->device_type))) {
                    $userDeviceToken = PushNotification::where('user_id', '=', Auth::user()->id)
                        ->where('type', '=', $request->device_type)
                        ->first();
                    if (is_null($userDeviceToken)) {
                        $deviceToken = PushNotification::create(['user_id' => Auth::user()->id,
                                'type' => $request->device_type,
                                'device_token' => $request->device_token
                        ]);
                    } else {
                        $userDeviceToken->device_token = $request->device_token;
                        $userDeviceToken->update();
                    }
                }

                $userArray = $user->toArray();

                $userArray['follower_count'] = DB::table('follows')->where('follow_id', '=', $user['id'])->count();
                $userArray['workout_count'] = Workout::workoutCount($user['id']);
                $userArray['points'] = Point::userPoints($user['id']);
                $userArray['level'] = Point::userLevel($user['id']);

                //Code to check facebook connected for user.
                //Added by ansa@cubettech.com on 27-11-2015
                $userArray['facebook_connected'] = Social::isFacebookConnect($user['id']);
                // if no errors are encountered we can return a JWT
                return response()->json(['status' => 1, 'success' => 'successfully_logged_in', 'token' => $token, 'user' => $userArray, 'urls' => config('urls.urls')], 200);
            } else {
                return response()->json(['status' => 0, 'error' => 'user_not_verified'], 401);
            }
        } else {
            return response()->json(['status' => 0, 'error' => 'invalid_credentials'], 422);
        }
    }

    /**
     * @api {post} /user/get GetUserDetails
     * @apiName GetUserDetails
     * @apiGroup User
     *
     * @apiParam {integer} user_id id of loggedin user *required
     * @apiParam {integer} profile_id id of other user *required
     * @apiSuccess {String} success.
     *
     * @apiSuccessExample Success-Response:
     * HTTP/1.1 200 OK
     * {
      "status": 1,
      "success": "user_details",
      "user": {
      "id": "2",
      "email": "aneeshk@cubettech.com",
      "confirmation_code": "",
      "status": "1",
      "created_at": "2015-11-09 09:14:02",
      "updated_at": "2015-11-16 06:45:17",
      "is_subscribed": 0,
      "profile": [
      {
      "id": "2",
      "user_id": "2",
      "first_name": "Aneesh",
      "last_name": "Kallikkattil",
      "gender": "1",
      "fitness_status": "3",
      "goal": "3",
      "image": "",
      "cover_image": "",
      "city": "",
      "state": "",
      "country": "",
      "spot": "",
      "quote": "I want to get Strong",
      "facebook": 0,
      "twitter": 0,
      "instagram": 0,
      "created_at": "2015-11-09 09:14:02",
      "updated_at": "2015-11-09 10:16:07",
      "level": 3
      }
      ],
      "settings": [
      {
      "id": "2",
      "user_id": "2",
      "key": "notification",
      "value": "{\"comments\":\"1\",\"claps\":\"1\",\"follow\":\"1\",\"my_performance\":\"1\",\"motivation_knowledge\":\"1\"} ",
      "created_at": "2015-11-20 00:00:00",
      "updated_at": "2015-12-03 06:35:31"
      },
      {
      "id": "3",
      "user_id": "2",
      "key": "subscription",
      "value": "1",
      "created_at": "2015-11-20 00:00:00",
      "updated_at": "2015-11-20 06:33:27"
      }
      ],
      "is_following": 0,
      "follower_count": 0,
      "workout_count": 4,
      "level": 3,
      "points": 330,
      "points_to_next_level": 170,
      "total_skills": 6,
      "user_skills_count": 2,
      "athlete_since": "2015-11-09 09:14:02",
      "facebook_connected": 0
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
     *
     * @apiError error Message token_invalid.
     * @apiError error Message token_expired.
     * @apiError error Message token_not_provided.
     * @apiError error Validation error.
     * @apiError error user_not_verified User error.
     * @apiError error invalid_credentials User error.
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
     *     HTTP/1.1 422 Validation error
     *     {
     *       "status" : 0,
     *       "error": "user_id required"
     *     }
     * 
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 422 user_not_verified
     *     {
     *       "status" : 0,
     *       "error": "user_not_verified"
     *     }
     * 
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 401 invalid_credentials
     *     {
     *       "status" : 0,
     *       "error": "invalid_credentials"
     *     }
     */
    public function getUser(Request $request)
    {
        $data = $request->all();

        if (!isset($data['user_id'])) {
            return response()->json(['status' => 0, 'error' => 'user_id required'], 422);
        }
        if (!isset($data['profile_id'])) {
            return response()->json(['status' => 0, 'error' => 'profile_id required'], 422);
        }
        if (Auth::user()->status == 1) {

            $getUserQuery = User::where('id', '=', $data['profile_id']);
            $getUserQuery->with(['profile']);
            //Need settings array if user views own profile
            //Added by ansa@cubettech.com on 27-11-2015
            if ($data['user_id'] == $data['profile_id'])
                $getUserQuery->with(['settings']);

            $user = $getUserQuery->first();
            $userArray = $user->toArray();

            $userArray['is_following'] = 0;
            if ($data['user_id'] != $data['profile_id'])
                $userArray['is_following'] = Follow::isFollowing($data['user_id'], $data['profile_id']);

            $userArray['follower_count'] = DB::table('follows')->where('follow_id', '=', $user['id'])->count();

            $userArray['workout_count'] = DB::table('workout_users')
                ->where('user_id', '=', $user['id'])
                ->where('status', '=', 1)
                ->count();

            $userArray['level'] = Point::userLevel($user['id']);

            $userArray['points'] = Point::userPoints($user['id']);
            $userArray['points_to_next_level'] = Point::userPontToNextLevel($user['id']);
            if ($userArray['is_subscribed'] == 1) {
                $userArray['coach_week'] = 1;
            }

            if (isset($userArray['profile']['goal'])) {
                if ($userArray['profile']['goal'] == 1) {
                    $userArray['focus'] = 'Lean';
                } elseif ($userArray['profile']['goal'] == 2) {
                    $userArray['focus'] = 'Athletic';
                } elseif ($userArray['profile']['goal'] == 3) {
                    $userArray['focus'] = 'Strength';
                }
            }

            $userArray['total_skills'] = 6;
            $userArray['user_skills_count'] = 2;

            $userArray['athlete_since'] = $userArray['created_at'];
            //Code to check facebook connected for user.
            //Added by ansa@cubettech.com on 27-11-2015
            $userArray['facebook_connected'] = Social::isFacebookConnect($user['id']);


            return response()->json(['status' => 1, 'success' => 'user_details', 'user' => $userArray, 'urls' => config('urls.urls')], 200);
        } else {
            return response()->json(['status' => 0, 'error' => 'user_not_verified'], 401);
        }
    }

    /**
     * @api {post} /user/resendverify ResendVerificationEmail
     * @apiName ResendVerificationEmail
     * @apiGroup User
     *
     * @apiParam {string} email email address of user *required
     *
     * @apiSuccess {String} success.
     *
     * @apiSuccessExample Success-Response:
     *     HTTP/1.1 200 OK
     *     {
     *          "status" : 1,
     *          "success": "Successfully sent email to your email address.",
     *          "email": "aneeshk@cubettech.com"
     *      }
     *
     * @apiError error Message token_invalid.
     * @apiError error Message token_expired.
     * @apiError error Message token_not_provided.
     * @apiError error Validation Error.
     * @apiError error email not registered with us.
     * @apiError error email already verified.
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
     *      "status" : 0,
     *       "error": "token_not_provided"
     *     }
     *
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 422 email_reqired
     *     {
     *          "status" : 0,
     *          "error": "email field is required"
     *     }  
     * 
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 422 email not registered with us
     *     {
     *          "status" : 0,
     *          "error": "email not registered with us"
     *     }
     * 
     * 
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 422 email already verified
     *     {
     *          "status" : 0,
     *          "error": "email already verified"
     *     }
     *      
     */
    public function resendVerifyEmail(Request $request)
    {
        if (!isset($request->email)) {
            return response()->json(['status' => 0, 'error' => 'email field is required'], 422);
        }


        $user = User::where(['email' => $request->email])->with(['profile'])->first();

        if (is_null($user)) {
            return response()->json(['status' => 0, 'error' => 'email not registered with us'], 422);
        }

        if ($user->status == 1) {
            return response()->json(['status' => 0, 'error' => 'email already verified'], 422);
        }

        Mail::send('email.verify', ['confirmation_code' => $user->confirmation_code], function($message) use ($user, $request) {
            $message->to($request->email, $user->profile[0]['first_name'] . ' ' . $user->profile[0]['last_name'])
                ->subject('Verify your email address');
        });

        return response()->json(['status' => 1, 'success' => 'Successfully sent email to your email address.', 'email' => $request->input('email')], 200);
    }

    /**
     * @api {post} /user/history/recent getUserRecentHistory
     * @apiName getUserRecentHistory
     * @apiGroup User
     * @apiParam {integer} user_id id of loggedin user *required
     * @apiSuccess {String} success.
     * @apiSuccessExample Success-Response:
     * HTTP/1.1 200 OK
     * {
      "status": 1,
      "success": "history",
      "history": [
      {
      "id": "25",
      "user_id": "96",
      "item_type": "exercise",
      "item_id": "35",
      "feed_text": "Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Integer pulvinar suscipit ante vitae ultricies.",
      "created_at": "2016-01-08 05:43:32",
      "updated_at": "2016-01-08 05:43:32",
      "category": "Athletic",
      "item_name": "One Leg Back Lever",
      "duration": "100",
      "volume": "10",
      "points": "60.00"
      },
      {
      "id": "24",
      "user_id": "96",
      "item_type": "exercise",
      "item_id": "8",
      "feed_text": "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean eget orci fringilla, tempor nibh quis, varius lectus. Nunc maximus diam ac lacus dictum pulvinar.",
      "created_at": "2016-01-08 05:42:12",
      "updated_at": "2016-01-08 05:42:12",
      "category": "Lean",
      "item_name": "Single Leg Deadlift",
      "duration": "100",
      "volume": "100",
      "points": "60.00"
      },
      {
      "id": "23",
      "user_id": "96",
      "item_type": "exercise",
      "item_id": "4",
      "feed_text": "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean eget orci fringilla, tempor nibh quis, varius lectus. Nunc maximus diam ac lacus dictum pulvinar.",
      "created_at": "2016-01-08 05:41:35",
      "updated_at": "2016-01-08 05:41:35",
      "category": "Lean",
      "item_name": "Skin the cat",
      "duration": "30",
      "volume": "100",
      "points": "60.00"
      },
      {
      "id": "22",
      "user_id": "96",
      "item_type": "exercise",
      "item_id": "4",
      "feed_text": "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean eget orci fringilla, tempor nibh quis, varius lectus. Nunc maximus diam ac lacus dictum pulvinar.",
      "created_at": "2016-01-08 05:41:06",
      "updated_at": "2016-01-08 05:41:06",
      "category": "Lean",
      "item_name": "Skin the cat",
      "duration": "30",
      "volume": "50",
      "points": "30.00"
      },
      {
      "id": "21",
      "user_id": "96",
      "item_type": "exercise",
      "item_id": "2",
      "feed_text": "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean eget orci fringilla, tempor nibh quis, varius lectus. Nunc maximus diam ac lacus dictum pulvinar.",
      "created_at": "2016-01-08 05:40:20",
      "updated_at": "2016-01-08 05:40:20",
      "category": "Lean",
      "item_name": "Australian Pullups",
      "duration": "30",
      "volume": "3",
      "points": "1.80"
      },
      {
      "id": "2",
      "user_id": "96",
      "item_type": "exercise",
      "item_id": "1",
      "feed_text": "not bad",
      "created_at": "2016-01-07 10:25:18",
      "updated_at": "2016-01-07 10:25:18",
      "category": "Lean",
      "item_name": "Jumping Pullups",
      "duration": "29",
      "volume": "25",
      "points": "25.00"
      },
      {
      "id": "1",
      "user_id": "96",
      "item_type": "exercise",
      "item_id": "1",
      "feed_text": "its cool",
      "created_at": "2016-01-07 10:23:02",
      "updated_at": "2016-01-07 10:23:02",
      "category": "Lean",
      "item_name": "Jumping Pullups",
      "duration": "57",
      "volume": "50",
      "points": "50.00"
      }
      ],
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
     * 
     * 
     * @apiError error Message token_invalid.
     * @apiError error Message token_expired.
     * @apiError error Message token_not_provided.
     * @apiError error Validation error.
     * @apiError user_not_exists User error.
     *
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 400 Invalid Request
     *     {
     *       "status":"0",
     *       "error": "token_invalid"
     *     }
     * 
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 401 Unauthorised
     *     {
     *       "status":"0",
     *       "error": "token_expired"
     *     }
     * 
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 400 Bad Request
     *     {
     *       "status":"0",
     *       "error": "token_not_provided"
     *     }
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 400 Bad Request
     *     {
     *       "status":"0",
     *       "error": "user_not_exists"
     *     }
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 422 Validation error
     *     {
     *       "status" : 0,
     *       "error": "The user_id field is required"
     *     }
     */
    public function getUserRecentHistory(Request $request)
    {

        if (!isset($request->user_id) || ($request->user_id == null)) {
            return response()->json(["status" => "0", "error" => "The user_id field is required"]);
        } else {
            $user = User::where('id', '=', $request->input('user_id'))->first();

            if ($user) {
                $userHistory = Feeds::where('user_id', '=', $request->user_id)
                    ->where('item_type', '=', 'exercise')
                    ->whereOr('item_type', '=', 'workout')
                    ->whereOr('item_type', '=', 'hiit')
                    ->orderBy('created_at', 'DESC')
                    ->get();

                if (count($userHistory) > 0) {
                    $userHistoryResponse = $this->AdditionalFeedsDetails($userHistory);
                }

                return response()->json(['status' => 1, 'success' => 'history', 'history' => $userHistoryResponse, 'urls' => config('urls.urls')], 200);
            } else {
                return response()->json(['status' => 0, 'error' => 'user_does_not_exists'], 500);
            }
        }
    }

    /**
     * Function to get additional parameters in feeds.
     * @since 19/11/2015
     * @author ansa@cubettech.com
     * @return json
     */
    protected function AdditionalFeedsDetails($userHistory)
    {
        foreach ($userHistory as $history) {
            if ($history->item_type == 'workout') {

                $workout = Workout::where('id', '=', $history->item_id)->first();
                if (!is_null($workout)) {
                    if ($workout->category == 1) {
                        $history->category = "Strength";
                    } elseif ($workout->category == 2) {
                        $history->category = "Cardio-strength";
                    }
                }

                $history->item_name = $workout->name;

                $workoutUserDet = DB::table('workout_users')
                    ->where('feed_id', $history->id)
                    ->first();

                $history->duration = $workoutUserDet->time;
                $history->volume = $workoutUserDet->volume;
                $history->points = DB::table('points')->where('item_id', $workoutUserDet->id)->where('activity', 'workout_completed')->pluck('points');
            } elseif ($history->item_type == 'exercise') {

                $exercise = Exercise::where('id', '=', $history->item_id)->first();
                if (!is_null($exercise)) {
                    if ($exercise->category == 1) {
                        $history->category = "Lean";
                    } elseif ($exercise->category == 2) {
                        $history->category = "Athletic";
                    } elseif ($exercise->category == 3) {
                        $history->category = "Strength";
                    }
                }

                $history->item_name = $exercise->name;

                $exerciseUserDet = DB::table('exercise_users')
                    ->where('feed_id', $history->id)
                    ->first();

                $history->duration = $exerciseUserDet->time;
                $history->volume = $exerciseUserDet->volume;
                $history->points = DB::table('points')->where('item_id', $exerciseUserDet->id)->where('activity', 'exercise_completed')->pluck('points');
            } elseif ($history->item_type == 'hiit') {

                $hiit = Hiit::where('id', '=', $history->item_id)->first();


                $history->item_name = $hiit->name;

                $hiitUserDet = DB::table('hiit_users')
                    ->where('feed_id', $history->id)
                    ->first();

                $history->duration = $hiitUserDet->time;
                $history->volume = $hiitUserDet->volume;
                $history->points = DB::table('points')->where('item_id', $hiitUserDet->id)->where('activity', 'hiit_completed')->pluck('points');
            }

            $historyResponse[] = $history;
        }
        return $historyResponse;
    }

    /**
     * @api {post} /user/history/exercise getUserExerciseHistory
     * @apiName getUserExerciseHistory
     * @apiGroup User
     * @apiParam {integer} user_id id of loggedin user *required
     * @apiSuccess {String} success.
     * @apiSuccessExample Success-Response:
     * HTTP/1.1 200 OK
     * 
     * {
      "status": 1,
      "success": "history",
      "exercise_history": [
      {
      "id": "1",
      "name": "Jumping Pullups",
      "description": "The jumping pull-up is a challenging full body exercise that targets the back, legs and arms.",
      "category": "1",
      "type": "1",
      "rewards": "6.00",
      "repititions": "10",
      "duration": "1",
      "unit": "times",
      "equipment": "",
      "scores": {
      "10": [],
      "20": [],
      "25": [
      {
      "id": "2",
      "user_id": "96",
      "exercise_id": "1",
      "status": "1",
      "time": "29",
      "is_starred": "0",
      "volume": "25",
      "feed_id": "2",
      "created_at": "2016-01-07 10:25:18",
      "updated_at": "2016-01-07 10:25:18"
      }
      ],
      "30": [],
      "50": [
      {
      "id": "1",
      "user_id": "96",
      "exercise_id": "1",
      "status": "1",
      "time": "57",
      "is_starred": "0",
      "volume": "50",
      "feed_id": "1",
      "created_at": "2016-01-07 10:23:02",
      "updated_at": "2016-01-07 10:23:02"
      }
      ],
      "60": [],
      "100": [],
      "120": [],
      "180": [],
      "240": [],
      "250": [],
      "300": [],
      "360": [],
      "420": [],
      "480": [],
      "500": [],
      "540": [],
      "600": [],
      "750": [],
      "1000": []
      }
      },
      {
      "id": "2",
      "name": "Australian Pullups",
      "description": "Australian pull-ups are becoming a very popular exercise. Like all types of pull-ups (and all types of exercises for that matter) there are many different ways to do the Australian, and it can be incorporated into a number of different contexts within a workout.",
      "category": "1",
      "type": "2",
      "rewards": "6.00",
      "repititions": "10",
      "duration": "1",
      "unit": "times",
      "equipment": "",
      "scores": {
      "10": [],
      "20": [],
      "25": [],
      "30": [],
      "50": [],
      "60": [],
      "100": [],
      "120": [],
      "180": [],
      "240": [],
      "250": [],
      "300": [],
      "360": [],
      "420": [],
      "480": [],
      "500": [],
      "540": [],
      "600": [],
      "750": [],
      "1000": []
      }
      },
      {
      "id": "3",
      "name": "Knee Raises",
      "description": "Standing Knee Raises (also known as standing knee crunches and standing knee pulls) is a functional abdominal exercise for boosting strength throughout the core. Unlike standard ab exercises, they don’t isolate abdominal muscles. Instead they work your upper abs and lower abs in conjunction with other important muscles such as hips, back and shoulders.",
      "category": "1",
      "type": "2",
      "rewards": "6.00",
      "repititions": "10",
      "duration": "1",
      "unit": "times",
      "equipment": "",
      "scores": {
      "10": [],
      "20": [],
      "25": [],
      "30": [],
      "50": [],
      "60": [],
      "100": [],
      "120": [],
      "180": [],
      "240": [],
      "250": [],
      "300": [],
      "360": [],
      "420": [],
      "480": [],
      "500": [],
      "540": [],
      "600": [],
      "750": [],
      "1000": []
      }
      },
      {
      "id": "4",
      "name": "Skin the cat",
      "description": "A good upper body stretching exercise, especially for achieving full range of motion in the shoulder. The skin the cat exercise is a fundamental movement performed on gymnastics rings.",
      "category": "1",
      "type": "2",
      "rewards": "6.00",
      "repititions": "10",
      "duration": "10",
      "unit": "times",
      "equipment": "",
      "scores": {
      "10": [],
      "20": [],
      "25": [],
      "30": [],
      "50": [
      {
      "id": "10",
      "user_id": "96",
      "exercise_id": "4",
      "status": "1",
      "time": "30",
      "is_starred": "0",
      "volume": "50",
      "feed_id": "22",
      "created_at": "2016-01-08 05:41:06",
      "updated_at": "2016-01-08 05:41:06"
      }
      ],
      "60": [],
      "100": [
      {
      "id": "11",
      "user_id": "96",
      "exercise_id": "4",
      "status": "1",
      "time": "30",
      "is_starred": "0",
      "volume": "100",
      "feed_id": "23",
      "created_at": "2016-01-08 05:41:35",
      "updated_at": "2016-01-08 05:41:35"
      }
      ],
      "120": [],
      "180": [],
      "240": [],
      "250": [],
      "300": [],
      "360": [],
      "420": [],
      "480": [],
      "500": [],
      "540": [],
      "600": [],
      "750": [],
      "1000": []
      }
      },
      {
      "id": "5",
      "name": "Side Trizeps",
      "description": "",
      "category": "1",
      "type": "1",
      "rewards": "6.00",
      "repititions": "10",
      "duration": "30",
      "unit": "times",
      "equipment": "",
      "scores": {
      "10": [],
      "20": [],
      "25": [],
      "30": [],
      "50": [],
      "60": [],
      "100": [],
      "120": [],
      "180": [],
      "240": [],
      "250": [],
      "300": [],
      "360": [],
      "420": [],
      "480": [],
      "500": [],
      "540": [],
      "600": [],
      "750": [],
      "1000": []
      }
      },
      {
      "id": "6",
      "name": "Trizeps Extension",
      "description": "",
      "category": "1",
      "type": "2",
      "rewards": "6.00",
      "repititions": "10",
      "duration": "1",
      "unit": "times",
      "equipment": "",
      "scores": {
      "10": [],
      "20": [],
      "25": [],
      "30": [],
      "50": [],
      "60": [],
      "100": [],
      "120": [],
      "180": [],
      "240": [],
      "250": [],
      "300": [],
      "360": [],
      "420": [],
      "480": [],
      "500": [],
      "540": [],
      "600": [],
      "750": [],
      "1000": []
      }
      },
      {
      "id": "7",
      "name": "Wall Sits",
      "description": "",
      "category": "1",
      "type": "1",
      "rewards": "6.00",
      "repititions": "10",
      "duration": "10",
      "unit": "seconds",
      "equipment": "",
      "scores": {
      "10": [],
      "20": [],
      "25": [],
      "30": [],
      "50": [],
      "60": [],
      "100": [],
      "120": [],
      "180": [],
      "240": [],
      "250": [],
      "300": [],
      "360": [],
      "420": [],
      "480": [],
      "500": [],
      "540": [],
      "600": [],
      "750": [],
      "1000": []
      }
      },
      {
      "id": "8",
      "name": "Single Leg Deadlift",
      "description": "",
      "category": "1",
      "type": "2",
      "rewards": "6.00",
      "repititions": "10",
      "duration": "1",
      "unit": "times",
      "equipment": "",
      "scores": {
      "10": [],
      "20": [],
      "25": [],
      "30": [],
      "50": [],
      "60": [],
      "100": [
      {
      "id": "12",
      "user_id": "96",
      "exercise_id": "8",
      "status": "1",
      "time": "100",
      "is_starred": "0",
      "volume": "100",
      "feed_id": "24",
      "created_at": "2016-01-08 05:42:12",
      "updated_at": "2016-01-08 05:42:12"
      }
      ],
      "120": [],
      "180": [],
      "240": [],
      "250": [],
      "300": [],
      "360": [],
      "420": [],
      "480": [],
      "500": [],
      "540": [],
      "600": [],
      "750": [],
      "1000": []
      }
      },
      {
      "id": "9",
      "name": "Climbers",
      "description": "",
      "category": "1",
      "type": "2",
      "rewards": "6.00",
      "repititions": "10",
      "duration": "1",
      "unit": "times",
      "equipment": "",
      "scores": {
      "10": [],
      "20": [],
      "25": [],
      "30": [],
      "50": [],
      "60": [],
      "100": [],
      "120": [],
      "180": [],
      "240": [],
      "250": [],
      "300": [],
      "360": [],
      "420": [],
      "480": [],
      "500": [],
      "540": [],
      "600": [],
      "750": [],
      "1000": []
      }
      }
      ],
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
     * 
     * 
     * @apiError error Message token_invalid.
     * @apiError error Message token_expired.
     * @apiError error Message token_not_provided.
     * @apiError error Validation error.
     * @apiError user_not_exists User error.
     *
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 400 Invalid Request
     *     {
     *       "status":"0",
     *       "error": "token_invalid"
     *     }
     * 
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 401 Unauthorised
     *     {
     *       "status":"0",
     *       "error": "token_expired"
     *     }
     * 
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 400 Bad Request
     *     {
     *       "status":"0",
     *       "error": "token_not_provided"
     *     }
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 400 Bad Request
     *     {
     *       "status":"0",
     *       "error": "user_not_exists"
     *     }
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 422 Validation error
     *     {
     *       "status" : 0,
     *       "error": "The user_id field is required"
     *     }
     */
    public function getUserExerciseHistory(Request $request)
    {
        if (!isset($request->user_id) || ($request->user_id == null)) {
            return response()->json(["status" => "0", "error" => "The user_id field is required"]);
        } else {

            $user = User::where('id', '=', $request->input('user_id'))->first();

            $arr1 = Array(10, 20, 25, 30, 50, 60, 100, 120, 180, 240, 250, 300, 360, 420, 480, 500, 540, 600, 750, 1000);

            if ($user) {
                $exercises = Exercise::all();
                
                $exerciseArray = $exercises->toArray();
                foreach ($exerciseArray as $eKey => $exercise) {

                    foreach ($arr1 as $vKey => $volume1) {
                        $exerciseUserDet[$volume1] = DB::table('exercise_users')
                            ->where('exercise_id', $exercise['id'])
                            ->where('user_id', $request->user_id)
                            ->where('volume', $volume1)
                            ->get();
                    }

                    $exerciseArray[$eKey]['scores'] = $exerciseUserDet;
                }
                return response()->json(['status' => 1, 'success' => 'history', 'exercise_history' => $exerciseArray], 200);
            } else {
                return response()->json(['status' => 0, 'error' => 'user_does_not_exists'], 500);
            }
        }
    }

    /**
     * @api {post} /user/history/workout getUserWorkoutHistory
     * @apiName getUserWorkoutHistory
     * @apiGroup User
     * @apiParam {integer} user_id id of loggedin user *required
     * @apiSuccess {String} success.
     * @apiSuccessExample Success-Response:
     * HTTP/1.1 200 OK
     * {
      "status": 1,
      "success": "history",
      "workout_history": [
      {
      "id": "1",
      "name": "Baldur",
      "description": "Baldur Baldur",
      "rounds": "5",
      "category": "1",
      "type": "2",
      "rewards": "{\"lean\":330,\"athletic\":440,\"strength\":550}",
      "duration": "1680.00",
      "equipments": "",
      "lean": {
      "1": [],
      "2": [],
      "3": []
      },
      "athletic": {
      "1": [],
      "2": [],
      "3": []
      },
      "strength": {
      "1": [],
      "2": [],
      "3": []
      }
      },
      {
      "id": "2",
      "name": "Borr",
      "description": "Borr Borr Borr",
      "rounds": "3",
      "category": "2",
      "type": "1",
      "rewards": "{\"lean\":330,\"athletic\":440,\"strength\":550}",
      "duration": "1140.00",
      "equipments": "Bar",
      "lean": {
      "1": [],
      "2": [
      {
      "id": "7",
      "workout_id": "2",
      "user_id": "96",
      "status": "1",
      "time": "2900",
      "is_starred": "0",
      "volume": "2",
      "focus": "1",
      "feed_id": "14",
      "created_at": "2016-01-07 13:01:07",
      "updated_at": "2016-01-12 04:42:26",
      "category": "1"
      },
      {
      "id": "8",
      "workout_id": "2",
      "user_id": "96",
      "status": "1",
      "time": "2900",
      "is_starred": "0",
      "volume": "2",
      "focus": "1",
      "feed_id": "15",
      "created_at": "2016-01-07 13:02:08",
      "updated_at": "2016-01-12 04:42:30",
      "category": "1"
      },
      {
      "id": "9",
      "workout_id": "2",
      "user_id": "96",
      "status": "1",
      "time": "2900",
      "is_starred": "0",
      "volume": "2",
      "focus": "1",
      "feed_id": "16",
      "created_at": "2016-01-07 13:02:22",
      "updated_at": "2016-01-12 04:42:36",
      "category": "1"
      }
      ],
      "3": []
      },
      "athletic": {
      "1": [],
      "2": [],
      "3": []
      },
      "strength": {
      "1": [],
      "2": [],
      "3": []
      }
      },
      {
      "id": "3",
      "name": "Bragi",
      "description": "Bragi",
      "rounds": "5",
      "category": "2",
      "type": "1",
      "rewards": "{\"lean\":330,\"athletic\":440,\"strength\":550}",
      "duration": "840.00",
      "equipments": "Low Bar",
      "lean": {
      "1": [],
      "2": [],
      "3": []
      },
      "athletic": {
      "1": [],
      "2": [],
      "3": []
      },
      "strength": {
      "1": [],
      "2": [],
      "3": []
      }
      },
      {
      "id": "4",
      "name": "Buri",
      "description": "Buri",
      "rounds": "1",
      "category": "1",
      "type": "2",
      "rewards": "{\"lean\":330,\"athletic\":440,\"strength\":550}",
      "duration": "1440.00",
      "equipments": "Bar",
      "lean": {
      "1": [],
      "2": [],
      "3": []
      },
      "athletic": {
      "1": [],
      "2": [],
      "3": []
      },
      "strength": {
      "1": [],
      "2": [],
      "3": []
      }
      },
      {
      "id": "5",
      "name": "Dagur",
      "description": "Dagur",
      "rounds": "3",
      "category": "1",
      "type": "2",
      "rewards": "{\"lean\":330,\"athletic\":440,\"strength\":550}",
      "duration": "1260.00",
      "equipments": "Bar",
      "lean": {
      "1": [],
      "2": [],
      "3": []
      },
      "athletic": {
      "1": [],
      "2": [],
      "3": []
      },
      "strength": {
      "1": [],
      "2": [],
      "3": []
      }
      },
      {
      "id": "6",
      "name": "Delling",
      "description": "Delling",
      "rounds": "1",
      "category": "1",
      "type": "2",
      "rewards": "{\"lean\":330,\"athletic\":440,\"strength\":550}",
      "duration": "1140.00",
      "equipments": "Bar",
      "lean": {
      "1": [
      {
      "id": "15",
      "workout_id": "6",
      "user_id": "96",
      "status": "1",
      "time": "1500",
      "is_starred": "0",
      "volume": "1",
      "focus": "1",
      "feed_id": "29",
      "created_at": "2016-01-08 05:46:46",
      "updated_at": "2016-01-12 04:43:33",
      "category": "1"
      }
      ],
      "2": [
      {
      "id": "16",
      "workout_id": "6",
      "user_id": "96",
      "status": "1",
      "time": "1500",
      "is_starred": "0",
      "volume": "2",
      "focus": "1",
      "feed_id": "30",
      "created_at": "2016-01-08 05:46:55",
      "updated_at": "2016-01-12 04:43:37",
      "category": "1"
      }
      ],
      "3": [
      {
      "id": "17",
      "workout_id": "6",
      "user_id": "96",
      "status": "1",
      "time": "1500",
      "is_starred": "0",
      "volume": "3",
      "focus": "1",
      "feed_id": "31",
      "created_at": "2016-01-08 05:47:00",
      "updated_at": "2016-01-12 04:43:40",
      "category": "1"
      }
      ]
      },
      "athletic": {
      "1": [],
      "2": [
      {
      "id": "12",
      "workout_id": "6",
      "user_id": "96",
      "status": "1",
      "time": "1500",
      "is_starred": "0",
      "volume": "2",
      "focus": "2",
      "feed_id": "26",
      "created_at": "2016-01-08 05:45:46",
      "updated_at": "2016-01-12 04:43:02",
      "category": "2"
      },
      {
      "id": "13",
      "workout_id": "6",
      "user_id": "96",
      "status": "1",
      "time": "1500",
      "is_starred": "0",
      "volume": "2",
      "focus": "2",
      "feed_id": "27",
      "created_at": "2016-01-08 05:45:56",
      "updated_at": "2016-01-12 04:43:06",
      "category": "1"
      },
      {
      "id": "14",
      "workout_id": "6",
      "user_id": "96",
      "status": "1",
      "time": "1500",
      "is_starred": "0",
      "volume": "2",
      "focus": "2",
      "feed_id": "28",
      "created_at": "2016-01-08 05:46:02",
      "updated_at": "2016-01-12 04:43:09",
      "category": "3"
      }
      ],
      "3": []
      },
      "strength": {
      "1": [],
      "2": [],
      "3": []
      }
      },
      {
      "id": "7",
      "name": "Eir",
      "description": "Eir",
      "rounds": "1",
      "category": "2",
      "type": "2",
      "rewards": "{\"lean\":330,\"athletic\":440,\"strength\":550}",
      "duration": "1020.00",
      "equipments": "Bar",
      "lean": {
      "1": [],
      "2": [],
      "3": []
      },
      "athletic": {
      "1": [],
      "2": [],
      "3": []
      },
      "strength": {
      "1": [],
      "2": [],
      "3": []
      }
      },
      {
      "id": "8",
      "name": "Eostre",
      "description": "Eostre",
      "rounds": "5",
      "category": "1",
      "type": "2",
      "rewards": "{\"lean\":330,\"athletic\":440,\"strength\":550}",
      "duration": "1260.00",
      "equipments": "Ball,Bar",
      "lean": {
      "1": [],
      "2": [],
      "3": []
      },
      "athletic": {
      "1": [],
      "2": [],
      "3": []
      },
      "strength": {
      "1": [],
      "2": [],
      "3": []
      }
      },
      {
      "id": "9",
      "name": "Elli",
      "description": "Elli",
      "rounds": "3",
      "category": "2",
      "type": "1",
      "rewards": "{\"lean\":330,\"athletic\":440,\"strength\":550}",
      "duration": "1380.00",
      "equipments": "Bar",
      "lean": {
      "1": [
      {
      "id": "18",
      "workout_id": "9",
      "user_id": "96",
      "status": "1",
      "time": "1500",
      "is_starred": "0",
      "volume": "1",
      "focus": "1",
      "feed_id": "32",
      "created_at": "2016-01-08 05:48:32",
      "updated_at": "2016-01-12 04:43:44",
      "category": "1"
      }
      ],
      "2": [
      {
      "id": "19",
      "workout_id": "9",
      "user_id": "96",
      "status": "1",
      "time": "1500",
      "is_starred": "0",
      "volume": "2",
      "focus": "1",
      "feed_id": "33",
      "created_at": "2016-01-08 05:48:45",
      "updated_at": "2016-01-12 04:43:47",
      "category": "1"
      }
      ],
      "3": [
      {
      "id": "20",
      "workout_id": "9",
      "user_id": "96",
      "status": "1",
      "time": "1500",
      "is_starred": "0",
      "volume": "3",
      "focus": "1",
      "feed_id": "34",
      "created_at": "2016-01-08 05:49:00",
      "updated_at": "2016-01-12 04:43:51",
      "category": "1"
      }
      ]
      },
      "athletic": {
      "1": [
      {
      "id": "21",
      "workout_id": "9",
      "user_id": "96",
      "status": "1",
      "time": "1500",
      "is_starred": "0",
      "volume": "1",
      "focus": "2",
      "feed_id": "35",
      "created_at": "2016-01-08 05:49:19",
      "updated_at": "2016-01-12 04:44:06",
      "category": "2"
      }
      ],
      "2": [
      {
      "id": "22",
      "workout_id": "9",
      "user_id": "96",
      "status": "1",
      "time": "1500",
      "is_starred": "0",
      "volume": "2",
      "focus": "2",
      "feed_id": "36",
      "created_at": "2016-01-08 05:49:27",
      "updated_at": "2016-01-12 04:44:09",
      "category": "2"
      }
      ],
      "3": []
      },
      "strength": {
      "1": [],
      "2": [],
      "3": []
      }
      },
      {
      "id": "10",
      "name": "Loki",
      "description": "Loki",
      "rounds": "1",
      "category": "1",
      "type": "2",
      "rewards": "{\"lean\":330,\"athletic\":440,\"strength\":550}",
      "duration": "1440.00",
      "equipments": "Bar, Bench",
      "lean": {
      "1": [],
      "2": [],
      "3": []
      },
      "athletic": {
      "1": [],
      "2": [],
      "3": []
      },
      "strength": {
      "1": [],
      "2": [],
      "3": []
      }
      },
      {
      "id": "11",
      "name": "Hermodur",
      "description": "Hermodur",
      "rounds": "4",
      "category": "1",
      "type": "2",
      "rewards": "{\"lean\":330,\"athletic\":440,\"strength\":550}",
      "duration": "1740.00",
      "equipments": "Bar",
      "lean": {
      "1": [],
      "2": [],
      "3": []
      },
      "athletic": {
      "1": [],
      "2": [],
      "3": []
      },
      "strength": {
      "1": [],
      "2": [],
      "3": []
      }
      },
      {
      "id": "12",
      "name": "Forseti",
      "description": "Forseti",
      "rounds": "6",
      "category": "2",
      "type": "2",
      "rewards": "{\"lean\":330,\"athletic\":440,\"strength\":550}",
      "duration": "2280.00",
      "equipments": "Bar",
      "lean": {
      "1": [],
      "2": [],
      "3": []
      },
      "athletic": {
      "1": [],
      "2": [],
      "3": []
      },
      "strength": {
      "1": [],
      "2": [],
      "3": []
      }
      },
      {
      "id": "13",
      "name": "Magni",
      "description": "Magni",
      "rounds": "4",
      "category": "1",
      "type": "2",
      "rewards": "{\"lean\":330,\"athletic\":440,\"strength\":550}",
      "duration": "1380.00",
      "equipments": "Low bar, Bar",
      "lean": {
      "1": [],
      "2": [],
      "3": []
      },
      "athletic": {
      "1": [],
      "2": [],
      "3": []
      },
      "strength": {
      "1": [],
      "2": [],
      "3": []
      }
      },
      {
      "id": "14",
      "name": "Odin",
      "description": "Odin",
      "rounds": "1",
      "category": "1",
      "type": "2",
      "rewards": "{\"lean\":330,\"athletic\":440,\"strength\":550}",
      "duration": "1200.00",
      "equipments": "Ball, Bar, Low bar",
      "lean": {
      "1": [],
      "2": [],
      "3": []
      },
      "athletic": {
      "1": [],
      "2": [],
      "3": []
      },
      "strength": {
      "1": [],
      "2": [],
      "3": []
      }
      },
      {
      "id": "15",
      "name": "Mimir",
      "description": "mimir",
      "rounds": "4",
      "category": "2",
      "type": "1",
      "rewards": "{\"lean\":330,\"athletic\":440,\"strength\":550}",
      "duration": "920.00",
      "equipments": "",
      "lean": {
      "1": [],
      "2": [],
      "3": []
      },
      "athletic": {
      "1": [],
      "2": [
      {
      "id": "23",
      "workout_id": "15",
      "user_id": "96",
      "status": "1",
      "time": "1500",
      "is_starred": "0",
      "volume": "2",
      "focus": "2",
      "feed_id": "37",
      "created_at": "2016-01-08 05:49:36",
      "updated_at": "2016-01-12 04:44:12",
      "category": "2"
      }
      ],
      "3": []
      },
      "strength": {
      "1": [],
      "2": [],
      "3": []
      }
      },
      {
      "id": "16",
      "name": "Tyr ",
      "description": "Tyr Tyr",
      "rounds": "3",
      "category": "1",
      "type": "2",
      "rewards": "{\"lean\":330,\"athletic\":440,\"strength\":550}",
      "duration": "1560.00",
      "equipments": "Bar, Bench",
      "lean": {
      "1": [],
      "2": [],
      "3": []
      },
      "athletic": {
      "1": [],
      "2": [],
      "3": []
      },
      "strength": {
      "1": [],
      "2": [],
      "3": []
      }
      },
      {
      "id": "17",
      "name": "Thor",
      "description": "Thor Thor",
      "rounds": "1",
      "category": "1",
      "type": "2",
      "rewards": "{\"lean\":330,\"athletic\":440,\"strength\":550}",
      "duration": "1560.00",
      "equipments": "Bar/Bench",
      "lean": {
      "1": [],
      "2": [],
      "3": []
      },
      "athletic": {
      "1": [],
      "2": [],
      "3": []
      },
      "strength": {
      "1": [],
      "2": [],
      "3": []
      }
      },
      {
      "id": "18",
      "name": "Sif",
      "description": "Sif",
      "rounds": "3",
      "category": "2",
      "type": "1",
      "rewards": "{\"lean\":330,\"athletic\":440,\"strength\":550}",
      "duration": "0.00",
      "equipments": "Bar",
      "lean": {
      "1": [],
      "2": [],
      "3": []
      },
      "athletic": {
      "1": [],
      "2": [],
      "3": []
      },
      "strength": {
      "1": [],
      "2": [],
      "3": []
      }
      },
      {
      "id": "19",
      "name": "Hœnir",
      "description": "Hœnir Hœnir",
      "rounds": "3",
      "category": "1",
      "type": "2",
      "rewards": "{\"lean\":330,\"athletic\":440,\"strength\":550}",
      "duration": "1740.00",
      "equipments": "",
      "lean": {
      "1": [],
      "2": [],
      "3": []
      },
      "athletic": {
      "1": [],
      "2": [],
      "3": []
      },
      "strength": {
      "1": [],
      "2": [],
      "3": []
      }
      },
      {
      "id": "20",
      "name": "Snotra",
      "description": "Snotra Snotra",
      "rounds": "3",
      "category": "2",
      "type": "2",
      "rewards": "{\"lean\":330,\"athletic\":440,\"strength\":550}",
      "duration": "1620.00",
      "equipments": "Ball, Bar, Post",
      "lean": {
      "1": [],
      "2": [],
      "3": []
      },
      "athletic": {
      "1": [],
      "2": [],
      "3": []
      },
      "strength": {
      "1": [],
      "2": [],
      "3": []
      }
      },
      {
      "id": "21",
      "name": "Váli",
      "description": "Váli Váli",
      "rounds": "3",
      "category": "1",
      "type": "2",
      "rewards": "{\"lean\":330,\"athletic\":440,\"strength\":550}",
      "duration": "1620.00",
      "equipments": "Bar, Post",
      "lean": {
      "1": [],
      "2": [],
      "3": []
      },
      "athletic": {
      "1": [],
      "2": [],
      "3": []
      },
      "strength": {
      "1": [],
      "2": [],
      "3": []
      }
      },
      {
      "id": "22",
      "name": "Hel",
      "description": "Hel Hel",
      "rounds": "3",
      "category": "2",
      "type": "1",
      "rewards": "{\"lean\":330,\"athletic\":440,\"strength\":550}",
      "duration": "1080.00",
      "equipments": "Bar",
      "lean": {
      "1": [],
      "2": [],
      "3": []
      },
      "athletic": {
      "1": [],
      "2": [],
      "3": []
      },
      "strength": {
      "1": [],
      "2": [],
      "3": []
      }
      },
      {
      "id": "23",
      "name": "Yggdrasil",
      "description": "Yggdrasil Yggdrasil",
      "rounds": "3",
      "category": "1",
      "type": "2",
      "rewards": "{\"lean\":330,\"athletic\":440,\"strength\":550}",
      "duration": "0.00",
      "equipments": "Bar, Post",
      "lean": {
      "1": [],
      "2": [],
      "3": []
      },
      "athletic": {
      "1": [],
      "2": [],
      "3": []
      },
      "strength": {
      "1": [],
      "2": [],
      "3": []
      }
      },
      {
      "id": "24",
      "name": "Nerþus",
      "description": "Nerþus Nerþus",
      "rounds": "3",
      "category": "1",
      "type": "2",
      "rewards": "{\"lean\":330,\"athletic\":440,\"strength\":550}",
      "duration": "0.00",
      "equipments": "Bar, Ball, Low Bar",
      "lean": {
      "1": [],
      "2": [],
      "3": []
      },
      "athletic": {
      "1": [],
      "2": [],
      "3": []
      },
      "strength": {
      "1": [],
      "2": [],
      "3": []
      }
      },
      {
      "id": "25",
      "name": "Jörð",
      "description": "Jörð Jörð",
      "rounds": "4",
      "category": "2",
      "type": "1",
      "rewards": "{\"lean\":330,\"athletic\":440,\"strength\":550}",
      "duration": "1680.00",
      "equipments": "",
      "lean": {
      "1": [],
      "2": [],
      "3": []
      },
      "athletic": {
      "1": [],
      "2": [],
      "3": []
      },
      "strength": {
      "1": [],
      "2": [],
      "3": []
      }
      }
      ]
      }
     * 
     * 
     * @apiError error Message token_invalid.
     * @apiError error Message token_expired.
     * @apiError error Message token_not_provided.
     * @apiError error Validation error.
     * @apiError user_not_exists User error.
     *
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 400 Invalid Request
     *     {
     *       "status":"0",
     *       "error": "token_invalid"
     *     }
     * 
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 401 Unauthorised
     *     {
     *       "status":"0",
     *       "error": "token_expired"
     *     }
     * 
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 400 Bad Request
     *     {
     *       "status":"0",
     *       "error": "token_not_provided"
     *     }
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 400 Bad Request
     *     {
     *       "status":"0",
     *       "error": "user_not_exists"
     *     }
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 422 Validation error
     *     {
     *       "status" : 0,
     *       "error": "The user_id field is required"
     *     }
     */
    public function getUserWorkoutHistory(Request $request)
    {
        if (!isset($request->user_id) || ($request->user_id == null)) {
            return response()->json(["status" => "0", "error" => "The user_id field is required"]);
        } else {
            $user = User::where('id', '=', $request->input('user_id'))->first();

            $arr1 = Array(1, 2, 3);

            if ($user) {
                $workouts = Workout::all();
                $workoutArray = $workouts->toArray();
                foreach ($workoutArray as $eKey => $workout) {
                    
                    foreach ($arr1 as $vKey => $volume1) {
                        $exerciseUserDetLean[$volume1] = DB::table('workout_users')
                            ->where('workout_id', $workout['id'])
                            ->where('user_id', $request->user_id)
                            ->where('volume', $volume1)
                            ->where('focus', 1)
                            ->get();
                    }

                    $workoutArray[$eKey]['lean']['scores'] = $exerciseUserDetLean;

                    foreach ($arr1 as $vKey => $volume1) {
                        $exerciseUserDetAthletic[$volume1] = DB::table('workout_users')
                            ->where('workout_id', $workout['id'])
                            ->where('user_id', $request->user_id)
                            ->where('volume', $volume1)
                            ->where('focus', 2)
                            ->get();
                    }

                    $workoutArray[$eKey]['athletic']['scores'] = $exerciseUserDetAthletic;

                    foreach ($arr1 as $vKey => $volume1) {
                        $exerciseUserDetStrength[$volume1] = DB::table('workout_users')
                            ->where('workout_id', $workout['id'])
                            ->where('user_id', $request->user_id)
                            ->where('volume', $volume1)
                            ->where('focus', 3)
                            ->get();
                    }

                    $workoutArray[$eKey]['strength']['scores'] = $exerciseUserDetStrength;
                }

                return response()->json(['status' => 1, 'success' => 'history', 'workout_history' => $workoutArray], 200);
            } else {
                return response()->json(['status' => 0, 'error' => 'user_does_not_exists'], 500);
            }
        }
    }

    /**
     * @api {post} /user/history/hiit getUserHiitHistory
     * @apiName getUserHiitHistory
     * @apiGroup User
     * @apiParam {integer} user_id id of loggedin user *required
     * @apiSuccess {String} success.
     * @apiSuccessExample Success-Response:
     * HTTP/1.1 200 OK
     * {
      "status": 1,
      "success": "history",
      "hiit_history": [
      {
      "id": "1",
      "name": "30/30",
      "description": "Interval 4 rounds to 10 rounds",
      "exercises": "",
      "rewards": "330.00",
      "scores": {
      "1": [],
      "2": [],
      "3": [],
      "4": [
      {
      "id": "2",
      "hiit_id": "1",
      "user_id": "96",
      "status": "1",
      "time": "1500.00",
      "is_starred": "0",
      "volume": "4",
      "feed_id": "38",
      "created_at": "2016-01-08 06:02:50",
      "updated_at": "2016-01-08 06:02:50"
      }
      ],
      "5": [],
      "6": [],
      "7": [],
      "8": [],
      "9": [],
      "10": [
      {
      "id": "9",
      "hiit_id": "1",
      "user_id": "96",
      "status": "1",
      "time": "2250.00",
      "is_starred": "0",
      "volume": "10",
      "feed_id": "45",
      "created_at": "2016-01-08 06:04:32",
      "updated_at": "2016-01-08 06:04:32"
      }
      ],
      "11": [],
      "12": [],
      "13": [],
      "14": [],
      "16": []
      }
      },
      {
      "id": "2",
      "name": "20/10",
      "description": "Interval 4 rounds to 8 rounds",
      "exercises": "",
      "rewards": "330.00",
      "scores": {
      "1": [],
      "2": [],
      "3": [],
      "4": [],
      "5": [
      {
      "id": "4",
      "hiit_id": "2",
      "user_id": "96",
      "status": "1",
      "time": "1500.00",
      "is_starred": "0",
      "volume": "5",
      "feed_id": "40",
      "created_at": "2016-01-08 06:03:17",
      "updated_at": "2016-01-08 06:03:17"
      }
      ],
      "6": [],
      "7": [
      {
      "id": "3",
      "hiit_id": "2",
      "user_id": "96",
      "status": "1",
      "time": "1500.00",
      "is_starred": "0",
      "volume": "7",
      "feed_id": "39",
      "created_at": "2016-01-08 06:03:10",
      "updated_at": "2016-01-08 06:03:10"
      }
      ],
      "8": [
      {
      "id": "5",
      "hiit_id": "2",
      "user_id": "96",
      "status": "1",
      "time": "1500.00",
      "is_starred": "0",
      "volume": "8",
      "feed_id": "41",
      "created_at": "2016-01-08 06:03:27",
      "updated_at": "2016-01-08 06:03:27"
      }
      ],
      "9": [],
      "10": [],
      "11": [],
      "12": [],
      "13": [],
      "14": [],
      "16": []
      }
      },
      {
      "id": "3",
      "name": "60/120",
      "description": "Interval 3 to 5 rounds",
      "exercises": "",
      "rewards": "330.00",
      "scores": {
      "1": [],
      "2": [],
      "3": [
      {
      "id": "6",
      "hiit_id": "3",
      "user_id": "96",
      "status": "1",
      "time": "1500.00",
      "is_starred": "0",
      "volume": "3",
      "feed_id": "42",
      "created_at": "2016-01-08 06:03:37",
      "updated_at": "2016-01-08 06:03:37"
      }
      ],
      "4": [
      {
      "id": "7",
      "hiit_id": "3",
      "user_id": "96",
      "status": "1",
      "time": "1500.00",
      "is_starred": "0",
      "volume": "4",
      "feed_id": "43",
      "created_at": "2016-01-08 06:03:44",
      "updated_at": "2016-01-08 06:03:44"
      }
      ],
      "5": [
      {
      "id": "8",
      "hiit_id": "3",
      "user_id": "96",
      "status": "1",
      "time": "1500.00",
      "is_starred": "0",
      "volume": "5",
      "feed_id": "44",
      "created_at": "2016-01-08 06:03:48",
      "updated_at": "2016-01-08 06:03:48"
      }
      ],
      "6": [],
      "7": [],
      "8": [],
      "9": [],
      "10": [],
      "11": [],
      "12": [],
      "13": [],
      "14": [],
      "16": []
      }
      }
      ]
      }
     * 
     * 
     * @apiError error Message token_invalid.
     * @apiError error Message token_expired.
     * @apiError error Message token_not_provided.
     * @apiError error Validation error.
     * @apiError user_not_exists User error.
     *
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 400 Invalid Request
     *     {
     *       "status":"0",
     *       "error": "token_invalid"
     *     }
     * 
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 401 Unauthorised
     *     {
     *       "status":"0",
     *       "error": "token_expired"
     *     }
     * 
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 400 Bad Request
     *     {
     *       "status":"0",
     *       "error": "token_not_provided"
     *     }
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 400 Bad Request
     *     {
     *       "status":"0",
     *       "error": "user_not_exists"
     *     }
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 422 Validation error
     *     {
     *       "status" : 0,
     *       "error": "The user_id field is required"
     *     }
     */
    public function getUserHiitHistory(Request $request)
    {
        if (!isset($request->user_id) || ($request->user_id == null)) {
            return response()->json(["status" => "0", "error" => "The user_id field is required"]);
        } else {
            $user = User::where('id', '=', $request->input('user_id'))->first();

            $arr1 = Array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 16);

            if ($user) {

                $hiits = Hiit::all();
                $hiitArray = $hiits->toArray();
                foreach ($hiitArray as $eKey => $hiit) {
                    foreach ($arr1 as $vKey => $volume1) {
                        $hiitSores[$volume1] = DB::table('hiit_users')
                            ->where('hiit_id', $hiit['id'])
                            ->where('user_id', $request->user_id)
                            ->where('volume', $volume1)
                            ->get();
                    }
                    $hiitArray[$eKey]['scores'] = $hiitSores;
                }
                return response()->json(['status' => 1, 'success' => 'history', 'hiit_history' => $hiitArray], 200);
            } else {
                return response()->json(['status' => 0, 'error' => 'user_does_not_exists'], 500);
            }
        }
    }

    public function confirm(Request $request)
    {
        $conformationCode = $request->input('token');

        if (!$conformationCode) {
            throw newInvalidConfirmationCodeException;
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
            return response()->json(['status' => 1, 'success' => 'user_successfully_logged_out'], 200);
        } else {
            return response()->json(['status' => 0, 'error' => 'user_already_logged_out'], 401);
        }
    }

    /**
     * @api {post} /user/options/goaloptions getUserGoalOptions
     * @apiName getUserGoalOptions
     * @apiGroup User
     * @apiParam {integer} user_id id of loggedin user *required
     * @apiParam {integer} progression_id id of Progression *required
     * @apiSuccess {String} success.
     * @apiSuccessExample Success-Response:
     * HTTP/1.1 200 OK
     * {
          "status": 1,
          "success": "user_selected_goals",
          "skill_levels": [
            {
              "id": "5",
              "description": "",
              "progression_id": "1",
              "level": "5",
              "row": "1",
              "substitute": "0",
              "exercise_id": "69",
              "created_at": "2015-12-14 03:04:45",
              "updated_at": "2015-12-15 05:48:46",
              "exercise": {
                "id": "69",
                "name": "Muscleups",
                "description": "",
                "category": "3",
                "type": "1",
                "muscle_groups": "0",
                "rewards": "6.00",
                "repititions": "10",
                "duration": "1",
                "unit": "times",
                "equipment": "",
                "range_of_motion": "",
                "video_tips": "",
                "pro_tips": "",
                "video": [
                  {
                    "id": "69",
                    "path": "Now69.mp4",
                    "videothumbnail": "thumbnail3.jpg",
                    "description": "Test Description"
                  }
                ]
              },
              "is_selected": 1
            },
            {
              "id": "10",
              "description": "",
              "progression_id": "1",
              "level": "5",
              "row": "2",
              "substitute": "0",
              "exercise_id": "77",
              "created_at": "2015-12-14 03:04:45",
              "updated_at": "2015-12-15 05:48:46",
              "exercise": {
                "id": "77",
                "name": "Front Lever",
                "description": "",
                "category": "3",
                "type": "2",
                "muscle_groups": "0",
                "rewards": "10.00",
                "repititions": "10",
                "duration": "10",
                "unit": "seconds",
                "equipment": "",
                "range_of_motion": "",
                "video_tips": "",
                "pro_tips": "",
                "video": [
                  {
                    "id": "78",
                    "path": "Now78.mp4",
                    "videothumbnail": "thumbnail2.png",
                    "description": "Test Description"
                  }
                ]
              },
              "is_selected": 0
            },
            {
              "id": "15",
              "description": "",
              "progression_id": "1",
              "level": "5",
              "row": "3",
              "substitute": "0",
              "exercise_id": "78",
              "created_at": "2015-12-14 03:04:45",
              "updated_at": "2015-12-15 05:48:46",
              "exercise": {
                "id": "78",
                "name": "Pullover",
                "description": "",
                "category": "3",
                "type": "2",
                "muscle_groups": "0",
                "rewards": "10.00",
                "repititions": "10",
                "duration": "1",
                "unit": "times",
                "equipment": "",
                "range_of_motion": "",
                "video_tips": "",
                "pro_tips": "",
                "video": [
                  {
                    "id": "79",
                    "path": "Now79.mp4",
                    "videothumbnail": "thumbnail3.jpg",
                    "description": "Test Description"
                  }
                ]
              },
              "is_selected": 0
            },
            {
              "id": "20",
              "description": "",
              "progression_id": "1",
              "level": "5",
              "row": "4",
              "substitute": "0",
              "exercise_id": "79",
              "created_at": "2015-12-14 03:04:45",
              "updated_at": "2015-12-15 05:48:46",
              "exercise": {
                "id": "79",
                "name": "Back Lever",
                "description": "",
                "category": "3",
                "type": "2",
                "muscle_groups": "0",
                "rewards": "10.00",
                "repititions": "10",
                "duration": "10",
                "unit": "seconds",
                "equipment": "",
                "range_of_motion": "",
                "video_tips": "",
                "pro_tips": "",
                "video": [
                  {
                    "id": "80",
                    "path": "Now80.mp4",
                    "videothumbnail": "thumbnail1.png",
                    "description": "Test Description"
                  }
                ]
              },
              "is_selected": 1
            }
          ]
        }
     * 
     * 
     * @apiError error Message token_invalid.
     * @apiError error Message token_expired.
     * @apiError error Message token_not_provided.
     * @apiError error Validation error.
     * @apiError error Validation error.
     * @apiError user_not_exists User error.
     *
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 400 Invalid Request
     *     {
     *       "status":"0",
     *       "error": "token_invalid"
     *     }
     * 
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 401 Unauthorised
     *     {
     *       "status":"0",
     *       "error": "token_expired"
     *     }
     * 
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 400 Bad Request
     *     {
     *       "status":"0",
     *       "error": "token_not_provided"
     *     }
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 500 Bad Request
     *     {
     *       "status":"0",
     *       "error": "user_not_exists"
     *     }
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 422 Validation error
     *     {
     *       "status" : 0,
     *       "error": "The user_id field is required"
     *     }
     * 
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 422 Validation error
     *     {
     *       "status" : 0,
     *       "error": "The progression_id field is required"
     *     }
     */
    public function getUserGoalOptions(Request $request)
    {
        if (!isset($request->user_id) || ($request->user_id == null)) {
            return response()->json(["status" => "0", "error" => "The user_id field is required"]);
        } elseif (!isset($request->progression_id) || ($request->progression_id == null)) {
            return response()->json(["status" => "0", "error" => "The progression_id field is required"]);
        } else {

            $user = User::where('id', '=', $request->input('user_id'))->first();

            if ($user) {
                $pullRowCount = count(Skill::where('progression_id', $request->progression_id)->groupBy('row')->get());


                $i = 1;

                do {

                    $skill = Skill::where('row', $i)->where('progression_id', $request->progression_id)->with(['exercise'])->orderBy('skills.level', 'DESC')->first();

                    $skills[] = $skill->toArray();

                    $i++;
                } while ($i <= $pullRowCount);

                $userOptions = DB::table('user_goal_options')->where('user_id', $request->user_id)->first();

                $skills = array_map(function($skill) use ($userOptions) {
                    if (!is_null($userOptions)) {
                        $userOptionsArray = explode(',', $userOptions->goal_options);
                        if (count($userOptionsArray) > 0) {
                            if (in_array($skill['id'], $userOptionsArray)) {
                                $skill['is_selected'] = 1;
                            } else {
                                $skill['is_selected'] = 0;
                            }
                        } else {
                            $skill['is_selected'] = 0;
                        }
                    } else {
                        $skill['is_selected'] = 0;
                    }
                    return $skill;
                }, $skills);
                return response()->json(['status' => 1, 'success' => 'user_selected_goals', 'skill_levels' => $skills], 200);
            } else {
                return response()->json(['status' => 0, 'error' => 'user_does_not_exists'], 500);
            }
        }
    }

    /**
     * @api {post} /user/options/updategoaloptions updateUserGoalOptions
     * @apiName updateUserGoalOptions
     * @apiGroup User
     * @apiParam {integer} user_id id of loggedin user *required
     * @apiParam {integer} progression_id id of Progression *required
     * @apiParam {String} goal_options comma seperated values of goals selected *required
     * @apiSuccess {String} success.
     * @apiSuccessExample Success-Response:
     * HTTP/1.1 200 OK
     * {
          "status": 1,
          "success": "updated_user_goals",
          "skill_levels": [
            {
              "id": "5",
              "description": "",
              "progression_id": "1",
              "level": "5",
              "row": "1",
              "substitute": "0",
              "exercise_id": "69",
              "created_at": "2015-12-14 03:04:45",
              "updated_at": "2015-12-15 05:48:46",
              "exercise": {
                "id": "69",
                "name": "Muscleups",
                "description": "",
                "category": "3",
                "type": "1",
                "muscle_groups": "0",
                "rewards": "6.00",
                "repititions": "10",
                "duration": "1",
                "unit": "times",
                "equipment": "",
                "range_of_motion": "",
                "video_tips": "",
                "pro_tips": "",
                "video": [
                  {
                    "id": "69",
                    "path": "Now69.mp4",
                    "videothumbnail": "thumbnail3.jpg",
                    "description": "Test Description"
                  }
                ]
              },
              "is_selected": 1
            },
            {
              "id": "10",
              "description": "",
              "progression_id": "1",
              "level": "5",
              "row": "2",
              "substitute": "0",
              "exercise_id": "77",
              "created_at": "2015-12-14 03:04:45",
              "updated_at": "2015-12-15 05:48:46",
              "exercise": {
                "id": "77",
                "name": "Front Lever",
                "description": "",
                "category": "3",
                "type": "2",
                "muscle_groups": "0",
                "rewards": "10.00",
                "repititions": "10",
                "duration": "10",
                "unit": "seconds",
                "equipment": "",
                "range_of_motion": "",
                "video_tips": "",
                "pro_tips": "",
                "video": [
                  {
                    "id": "78",
                    "path": "Now78.mp4",
                    "videothumbnail": "thumbnail2.png",
                    "description": "Test Description"
                  }
                ]
              },
              "is_selected": 0
            },
            {
              "id": "15",
              "description": "",
              "progression_id": "1",
              "level": "5",
              "row": "3",
              "substitute": "0",
              "exercise_id": "78",
              "created_at": "2015-12-14 03:04:45",
              "updated_at": "2015-12-15 05:48:46",
              "exercise": {
                "id": "78",
                "name": "Pullover",
                "description": "",
                "category": "3",
                "type": "2",
                "muscle_groups": "0",
                "rewards": "10.00",
                "repititions": "10",
                "duration": "1",
                "unit": "times",
                "equipment": "",
                "range_of_motion": "",
                "video_tips": "",
                "pro_tips": "",
                "video": [
                  {
                    "id": "79",
                    "path": "Now79.mp4",
                    "videothumbnail": "thumbnail3.jpg",
                    "description": "Test Description"
                  }
                ]
              },
              "is_selected": 0
            },
            {
              "id": "20",
              "description": "",
              "progression_id": "1",
              "level": "5",
              "row": "4",
              "substitute": "0",
              "exercise_id": "79",
              "created_at": "2015-12-14 03:04:45",
              "updated_at": "2015-12-15 05:48:46",
              "exercise": {
                "id": "79",
                "name": "Back Lever",
                "description": "",
                "category": "3",
                "type": "2",
                "muscle_groups": "0",
                "rewards": "10.00",
                "repititions": "10",
                "duration": "10",
                "unit": "seconds",
                "equipment": "",
                "range_of_motion": "",
                "video_tips": "",
                "pro_tips": "",
                "video": [
                  {
                    "id": "80",
                    "path": "Now80.mp4",
                    "videothumbnail": "thumbnail1.png",
                    "description": "Test Description"
                  }
                ]
              },
              "is_selected": 1
            }
          ]
        }
     * 
     * 
     * @apiError error Message token_invalid.
     * @apiError error Message token_expired.
     * @apiError error Message token_not_provided.
     * @apiError error Validation error.
     * @apiError error Validation error.
     * @apiError error Validation error.
     * @apiError user_not_exists User error.
     *
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 400 Invalid Request
     *     {
     *       "status":"0",
     *       "error": "token_invalid"
     *     }
     * 
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 401 Unauthorised
     *     {
     *       "status":"0",
     *       "error": "token_expired"
     *     }
     * 
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 400 Bad Request
     *     {
     *       "status":"0",
     *       "error": "token_not_provided"
     *     }
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 500 Bad Request
     *     {
     *       "status":"0",
     *       "error": "user_not_exists"
     *     }
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 422 Validation error
     *     {
     *       "status" : 0,
     *       "error": "The user_id field is required"
     *     }
     * 
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 422 Validation error
     *     {
     *       "status" : 0,
     *       "error": "The progression_id field is required"
     *     }
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 422 Validation error
     *     {
     *       "status" : 0,
     *       "error": "The goal_options field is required"
     *     }
     */
    public function updateUserGoalOptions(Request $request)
    {
        if (!isset($request->user_id) || ($request->user_id == null)) {
            return response()->json(["status" => "0", "error" => "The user_id field is required"]);
        } elseif (!isset($request->progression_id) || ($request->progression_id == null)) {
            return response()->json(["status" => "0", "error" => "The progression_id field is required"]);
        } elseif (!isset($request->goal_options) || ($request->goal_options == null)) {
            return response()->json(["status" => "0", "error" => "The goal_options field is required"]);
        } else {

            $user = User::where('id', '=', $request->input('user_id'))->first();

            if ($user) {

                $userOptions = DB::table('user_goal_options')->where('user_id', $request->user_id)->where('progression_id', $request->progression_id)->first();

                if (!is_null($userOptions)) {

                    DB::table('user_goal_options')->where('user_id', $request->user_id)->where('progression_id', $request->progression_id)->update(['goal_options' => $request->goal_options]);
                } else {

                    DB::table('user_goal_options')->insert([
                        'user_id' => $request->user_id,
                        'goal_options' => $request->goal_options,
                        'progression_id' => $request->progression_id,
                        'created_at' => Carbon::now()
                    ]);
                }

                $pullRowCount = count(Skill::where('progression_id', $request->progression_id)->groupBy('row')->get());

                $i = 1;

                do {

                    $skill = Skill::where('row', $i)->where('progression_id', $request->progression_id)->with(['exercise'])->orderBy('skills.level', 'DESC')->first();

                    $skills[] = $skill->toArray();

                    $i++;
                } while ($i <= $pullRowCount);

                $userOptionsArray = explode(',', $request->goal_options);
                $whereNotInQuery = '';
                $whereInQuery = '';
                if (count($userOptionsArray) > 0) {
                    foreach ($userOptionsArray as $userOption) {
                        $skill1 = Skill::where('id', $userOption)->first();
                        $skillsInthisRowQuery = DB::table('skills')->select('skills.id')
                                ->whereRaw('skills.progression_id = ' . $request->progression_id . ' AND skills.row =' . $skill1->row)->toSql();

                        $whereNotInQuery .= ' AND skills.id NOT IN(' . $skillsInthisRowQuery . ')';

                        $whereInQuery .= ' AND skills.id IN(' . $skillsInthisRowQuery . ')';
                    }
                }

                $userOptions = DB::table('user_goal_options')->where('user_id', $request->user_id)->where('progression_id', $request->progression_id)->first();

                $skills = array_map(function($skill) use ($userOptions) {
                    if (!is_null($userOptions)) {
                        $userOptionsArray = explode(',', $userOptions->goal_options);
                        if (count($userOptionsArray) > 0) {
                            if (in_array($skill['id'], $userOptionsArray)) {
                                $skill['is_selected'] = 1;
                            } else {
                                $skill['is_selected'] = 0;
                            }
                        } else {
                            $skill['is_selected'] = 0;
                        }
                    } else {
                        $skill['is_selected'] = 0;
                    }
                    return $skill;
                }, $skills);

                $skillsShouldLockedQuery = DB::table('skills')->select('skills.id')
                        ->whereRaw('skills.progression_id = ' . $request->progression_id . ' AND skills.level != 1' . $whereNotInQuery)->toSql();

                $skillsShouldUnlocked = DB::table('skills')->select('skills.id', 'skills.exercise_id')
                        ->whereRaw('skills.progression_id = ' . $request->progression_id . ' AND skills.level != 1' . $whereInQuery)->get();

                DB::table('unlocked_skills')->whereRaw('skill_id IN (' . $skillsShouldLockedQuery . ')')->delete();

//                foreach ($skillsShouldUnlocked as $skillUnlocked) {
//                    DB::table('unlocked_skills')->insert([
//                        'user_id' => $request->user_id,
//                        'skill_id' => $skillUnlocked->id,
//                        'exercise_id' => $skillUnlocked->exercise_id,
//                        'created_at' => Carbon::now()
//                    ]);
//                }
                return response()->json(['status' => 1, 'success' => 'updated_user_goals', 'skill_levels' => $skills], 200);
            } else {
                return response()->json(['status' => 0, 'error' => 'user_does_not_exists'], 500);
            }
        }
    }

    /**
     * @api {post} /user/options/physiqueoptions getUserPhysiqueOptions
     * @apiName getUserPhysiqueOptions
     * @apiGroup User
     * @apiParam {integer} user_id id of loggedin user *required
     * @apiSuccess {String} success.
     * @apiSuccessExample Success-Response:
     * HTTP/1.1 200 OK
     * {
      "status": 1,
      "success": "physique_groups",
      "physique_groups": [
      {
      "id": "1",
      "name": "Shoulders",
      "is_selected": 1
      },
      {
      "id": "2",
      "name": "Chest",
      "is_selected": 1
      },
      {
      "id": "3",
      "name": "Triceps",
      "is_selected": 1
      },
      {
      "id": "4",
      "name": "Lower Back",
      "is_selected": 0
      },
      {
      "id": "5",
      "name": "Arms",
      "is_selected": 1
      },
      {
      "id": "6",
      "name": "Core",
      "is_selected": 1
      },
      {
      "id": "7",
      "name": "Legs",
      "is_selected": 1
      },
      {
      "id": "8",
      "name": "Full Body",
      "is_selected": 0
      }
      ]
      }
     * 
     * 
     * @apiError error Message token_invalid.
     * @apiError error Message token_expired.
     * @apiError error Message token_not_provided.
     * @apiError error Validation error.     * 
     * @apiError user_not_exists User error.
     *
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 400 Invalid Request
     *     {
     *       "status":"0",
     *       "error": "token_invalid"
     *     }
     * 
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 401 Unauthorised
     *     {
     *       "status":"0",
     *       "error": "token_expired"
     *     }
     * 
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 400 Bad Request
     *     {
     *       "status":"0",
     *       "error": "token_not_provided"
     *     }
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 500 Bad Request
     *     {
     *       "status":"0",
     *       "error": "user_not_exists"
     *     }
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 422 Validation error
     *     {
     *       "status" : 0,
     *       "error": "The user_id field is required"
     *     }
     * 
     * 
     */
    public function getUserPhysiqueOptions(Request $request)
    {
        if (!isset($request->user_id) || ($request->user_id == null)) {
            return response()->json(["status" => "0", "error" => "The user_id field is required"]);
        } else {

            $user = User::where('id', '=', $request->input('user_id'))->first();

            if ($user) {

                $muscleGroups = DB::table('muscle_groups')->get();

                $userOptions = DB::table('user_physique_options')->where('user_id', $request->user_id)->first();

                $muscleGroups = array_map(function($muscleGroup) use ($userOptions) {
                    if (!is_null($userOptions)) {
                        $userOptionsArray = explode(',', $userOptions->physique_options);
                        if (count($userOptionsArray) > 0) {
                            if (in_array($muscleGroup->id, $userOptionsArray)) {
                                $muscleGroup->is_selected = 1;
                            } else {
                                $muscleGroup->is_selected = 0;
                            }
                        } else {
                            $muscleGroup->is_selected = 0;
                        }
                    } else {
                        $muscleGroup->is_selected = 0;
                    }
                    return $muscleGroup;
                }, $muscleGroups);

                return response()->json(['status' => 1, 'success' => 'physique_groups', 'physique_groups' => $muscleGroups], 200);
            } else {
                return response()->json(['status' => 0, 'error' => 'user_does_not_exists'], 500);
            }
        }
    }

    /**
     * @api {post} /user/options/updatephysiqueoptions updateUserPhysiqueOptions
     * @apiName updateUserPhysiqueOptions
     * @apiGroup User
     * @apiParam {integer} user_id id of loggedin user *required
     * @apiParam {integer} physique_options comma seperated ids of each muscle groups *required
     * @apiSuccess {String} success.
     * @apiSuccessExample Success-Response:
     * HTTP/1.1 200 OK
     * {
      "status": 1,
      "success": "updated_user_physique_groups",
      "physique_groups": [
      {
      "id": "1",
      "name": "Shoulders",
      "is_selected": 1
      },
      {
      "id": "2",
      "name": "Chest",
      "is_selected": 0
      },
      {
      "id": "3",
      "name": "Triceps",
      "is_selected": 1
      },
      {
      "id": "4",
      "name": "Lower Back",
      "is_selected": 0
      },
      {
      "id": "5",
      "name": "Arms",
      "is_selected": 1
      },
      {
      "id": "6",
      "name": "Core",
      "is_selected": 1
      },
      {
      "id": "7",
      "name": "Legs",
      "is_selected": 1
      },
      {
      "id": "8",
      "name": "Full Body",
      "is_selected": 0
      }
      ]
      }
     * 
     * 
     * @apiError error Message token_invalid.
     * @apiError error Message token_expired.
     * @apiError error Message token_not_provided.
     * @apiError error Validation error.     * 
     * @apiError user_not_exists User error.
     *
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 400 Invalid Request
     *     {
     *       "status":"0",
     *       "error": "token_invalid"
     *     }
     * 
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 401 Unauthorised
     *     {
     *       "status":"0",
     *       "error": "token_expired"
     *     }
     * 
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 400 Bad Request
     *     {
     *       "status":"0",
     *       "error": "token_not_provided"
     *     }
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 500 Bad Request
     *     {
     *       "status":"0",
     *       "error": "user_not_exists"
     *     }
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 422 Validation error
     *     {
     *       "status" : 0,
     *       "error": "The user_id field is required"
     *     }
     * 
     * 
     */
    public function updateUserPhysiqueOptions(Request $request)
    {
        if (!isset($request->user_id) || ($request->user_id == null)) {
            return response()->json(["status" => "0", "error" => "The user_id field is required"]);
        } elseif (!isset($request->physique_options) || ($request->physique_options == null)) {
            return response()->json(["status" => "0", "error" => "The physique_options field is required"]);
        } else {

            $user = User::where('id', '=', $request->input('user_id'))->first();

            if ($user) {

                $muscleGroups = DB::table('muscle_groups')->get();

                $userOptions = DB::table('user_physique_options')->where('user_id', $request->user_id)->first();

                if (!is_null($userOptions)) {
                    DB::table('user_physique_options')
                        ->where('user_id', $request->user_id)
                        ->update(['physique_options' => $request->physique_options]);
                } else {
                    DB::table('user_physique_options')->insert([
                        'user_id' => $request->user_id,
                        'physique_options' => $request->physique_options,
                        'created_at' => Carbon::now()
                    ]);
                }

                $userOptionsArray = explode(',', $request->physique_options);
                $whereNotInQuery = '';
                if (count($userOptionsArray) > 0) {
                    foreach ($userOptionsArray as $userOption) {
                        $skillsInthisRowQuery = DB::table('exercises')->select('exercises.id')
                                ->whereRaw('exercises.muscle_groups LIKE "%' . $userOption . '%"')->toSql();
                        $whereNotInQuery .= ' AND skills.exercise_id NOT IN(' . $skillsInthisRowQuery . ')';
                    }
                }

                $muscleGroups = array_map(function($muscleGroup) use ($userOptionsArray) {
                    if (count($userOptionsArray)>=1) {
                        if (count($userOptionsArray) > 0) {
                            if (in_array($muscleGroup->id, $userOptionsArray)) {
                                $muscleGroup->is_selected = 1;
                            } else {
                                $muscleGroup->is_selected = 0;
                            }
                        } else {
                            $muscleGroup->is_selected = 0;
                        }
                    } else {
                        $muscleGroup->is_selected = 0;
                    }
                    return $muscleGroup;
                }, $muscleGroups);
                
                $skillsShouldLockedQuery = DB::table('skills')->select('skills.id')
                        ->whereRaw('skills.level != 1' . $whereNotInQuery)->toSql();

                DB::table('unlocked_skills')->whereRaw('skill_id IN (' . $skillsShouldLockedQuery . ')')->delete();

                return response()->json(['status' => 1, 'success' => 'updated_user_physique_groups', 'physique_groups' => $muscleGroups], 200);
            } else {
                return response()->json(['status' => 0, 'error' => 'user_does_not_exists'], 500);
            }
        }
    }
}
