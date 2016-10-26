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
use App\CommonFunctions\PushNotificationFunction;
use App\Skilltraining;
use App\Skilltraininguser;

class UsersController extends Controller
{
    /*
      |--------------------------------------------------------------------------
      | UsersController - Controller
      |--------------------------------------------------------------------------
      |
      | This controller handles the registration of new users, as well as the
      | authentication of existing users. Why don't you explore it?
      |
     */

    /**
     * 
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('jwt.auth', ['except' => [
                'confirm',
                'postRegister',
                'login',
                'resendVerifyEmail',
                'updateUserEmail'
        ]]);
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
     * @apiParam {number} [gender] gender of the user 1-Male, 2-Female 
     * @apiParam {number} [fitness_status] user's self assessment about fitness 1-I am definitely fit, 2-I am quite fit, 3-I am not so fit *optional
     * @apiParam {number} [goal] user's goal 1-Get Lean, 2-Get Fit, 3-Get Strong 
     * @apiParam {string} [city] user's city 
     * @apiParam {string} [state] user's state 
     * @apiParam {string} [country] user's country 
     * @apiParam {string} [spot] Training Spot
     * @apiParam {string} [device_token] Device Token
     * @apiParam {string} [device_type] Device Type(android/ios)
     * @apiParam {string} [quote] Motivational quote added by user
     * @apiParam {number} [subscription] Whether Newsletter subscription selected by user
     * @apiParam {string} [referral_code] If user added referral code 
     * @apiParam {string} [parameters] json_encoded array {"marketing_title":"marketing"}. 
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
     *                   "spot": "",
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
     *               ],
     *          "promo_code": "hewiby"
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
     * @apiError error Validation error.
     * @apiError error Validation error.
     * @apiError error Validation error.
     * @apiError error Validation error.
     * @apiError error Message user_created_but_we_accept_only_jpeg_gif_png_files_as_profile_images.
     * @apiError could_not_create_user User error.
     *
     * 
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 400 Validation error
     *     {
      "status": 0,
      "error": "The email field is required.",
      "referral_code": "i2dGox"
      }
     * 
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 400 Validation error
     *     {
     *       "status" : 0,
     *       "error": "The password field is required.",
     *       "referral_code": "i2dGox"
     *     }
     * 
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 400 Validation error
     *     {
     *       "status" : 0,
     *       "error": "The first_name field is required",
     *       "referral_code": "i2dGox"
     *     }
     * 
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 400 Validation error
     *     {
     *       "status" : 0,
     *       "error": "The last_name field is required",
     *       "referral_code": "i2dGox"
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
     *       "error": "could_not_create_user",
     *       "referral_code": "i2dGox"
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
        if (!isset($request->email) || ($request->email == NULL) || $request->email == '(null)') {
            $respArray = [ "status" => 0, "error" => "The email field is required."];
            if (isset($request->referral_code) && $request->referral_code != '') {
                $respArray['referral_code'] = $request->referral_code;
            }
            return response()->json($respArray);
        } elseif (!isset($request->password) || ($request->password == NULL) || $request->password == '(null)') {
            $respArray = [ "status" => 0, "error" => "The password field is required."];
            if (isset($request->referral_code) && $request->referral_code != '') {
                $respArray['referral_code'] = $request->referral_code;
            }
            return response()->json($respArray);
        } elseif (!isset($request->first_name) || ($request->first_name == NULL) || $request->first_name == '(null)') {
            $respArray = ["status" => 0, "error" => "The first_name field is required"];
            if (isset($request->referral_code) && $request->referral_code != '') {
                $respArray['referral_code'] = $request->referral_code;
            }
            return response()->json($respArray);
        } elseif (!isset($request->last_name) || ($request->last_name == NULL) || $request->last_name == '(null)') {
            $respArray = [ "status" => 0, "error" => "The last_name field is required"];
            if (isset($request->referral_code) && $request->referral_code != '') {
                $respArray['referral_code'] = $request->referral_code;
            }
            return response()->json($respArray);
        } else {

            $user = User::where('email', '=', trim(strtolower($request->email)))->first();

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

                DB::table('promo_code')->insert([
                    'code' => $this->getToken(6),
                    'user_id' => $user->id,
                    'created_at' => Carbon::now()
                ]);

                // inserting into refferal table
                if (isset($request->parameters) || ($request->parameters != NULL)) {

                    $parameters = json_decode($request->parameters, true);

                    DB::table('refferals')->insert([
                        'user_id' => $user->id,
                        'email' => $user->email,
                        'marketing_title' => $parameters['$marketing_title'],
                        'parameters' => $request->parameters,
                        'is_coach_subscribed' => 0,
                        'created_at' => Carbon::now()
                    ]);
                }

                if (isset($request->referral_code) && $request->referral_code != '') {

                    DB::table('points')->insert([
                        'user_id' => $request->referral_code,
                        'item_id' => $request->referral_code,
                        'activity' => 'reference',
                        'points' => DB::table('site_settings')->where('key', '=', 'invitation_points')->pluck('value'),
                        'created_at' => Carbon::now()
                    ]);
                }

                $user = User::where('email', '=', $request->input('email'))->with([ 'profile', 'videos'])->first();

                $userArray = $user->toArray();

                $userArray['follower_count'] = DB::table('follows')->where('follow_id', '=', $user['id'])->count();
                $userArray['workout_count'] = Workout::workoutCount($user['id']);
                $userArray['points'] = Point::userPoints($user['id']);
                $userArray['level'] = Point::userLevel($user['id']);

                //Code to check facebook connected for user.
                //Added by ansa@cubettech.com on 27-11-2015
                $userArray['facebook_connected'] = Social::isFacebookConnect($userArray['id']);
                $userArray['promo_code'] = DB::table('promo_code')->where('user_id', '=', $userArray['id'])->pluck('code');
                return response()->json(['status' => 1, 'success' => 'successfully_created_user', 'user' => $userArray, 'urls' => config('urls.urls')], 200);
            } else {
                $respArray = ['status' => 0, 'error' => 'could_not_create_user'];
                if (isset($request->referral_code) && $request->referral_code != '') {
                    $respArray['referral_code'] = $request->referral_code;
                }
                return response()->json($respArray, 500);
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
                'status' => 0,
                'referral_code' => isset($data['referral_code']) ? $data['referral_code'] : 0
        ]);        

        $profile = new Profile([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'gender' => isset($data['gender']) && $data['gender'] != '(null)' && $data['gender'] != '' ? $data['gender'] : 0,
            'fitness_status' => isset($data['fitness_status']) && $data['fitness_status'] != '(null)' && $data['fitness_status'] != '' ? $data['fitness_status'] : 0,
            'goal' => isset($data['goal']) && $data['goal'] != '(null)' && $data['goal'] != '' ? $data['goal'] : 0,
            'city' => isset($data['city']) && $data['city'] != '(null)' && $data['city'] != '' ? $data['city'] : '',
            'state' => isset($data['state']) && $data['state'] != '(null)' && $data['state'] != '' ? $data['state'] : '',
            'country' => isset($data['country']) && $data['country'] != '(null)' && $data['country'] != '' ? $data['country'] : '',
            'spot' => isset($data['spot']) && $data['spot'] != '(null)' && $data['spot'] != '' ? $data['spot'] : '',
            'quote' => isset($data['quote']) && $data['quote'] != '(null)' && $data['quote'] != '' ? $data['quote'] : ''
            ]
        );

        $userProfile = $user->profile()->save($profile);

        $user = User::where('email', '=', $data['email'])->with([ 'profile'])->first();
        
        Mail::send('email.verify', ['confirmation_code' => $confirmation_code, 'first_name' => $data['first_name'], 'last_name' => $data['last_name']], function($message) use ($data) {
            $message->to($data['email'], $data['first_name'] . ' ' . $data['last_name'])
                ->subject('Verify your email address');
        });

        if (isset($data['subscription'])) {
            Settings::create(['user_id' => $user->id,
                'key' => 'subscription', 'value' => $data['subscription']
            ]);
        }

        //Code added by <ansa@cubettech.com> on 31-12-2015
        //To save device token
        if (isset($request->device_token) && (isset($request->device_type))) {
            $deviceToken = PushNotification::create([
                    'user_id' => $user->id,
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
     *               ],
     *              "promo_code": "hewiby",
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

        if ($user = User::where('email', '=', $data['email'])->with(['profile', 'followers'])->first()) {

            $userArray = $user->toArray();
            //To add followers level in response.
            //code added by ansa@cubettech.com on 1-12-2015

            if (count($user->followers) > 0 && (isset($profData['quote']) && $user->profile[0]->quote != $profData['quote'])) {
                foreach ($user->followers as $follower) {
                    //Push Notification
                    $data = [
                        'type' => 'motivation',
                        'type_id' => $follower->user_id,
                        'user_id' => $user->id,
                        'friend_id' => $follower->user_id
                    ];

                    PushNotificationFunction::pushNotification($data);
                }
            }

            $user->profile()->update($profData);

            $user = User::where('email', '=', $request->input('email'))->with(['profile'])->first();

            $promoCode = DB::table('promo_code')->where('user_id', '=', $user->id)->first();

            if (is_null($promoCode)) {
                DB::table('promo_code')->insert([
                    'code' => $this->getToken(6),
                    'user_id' => $user->id,
                    'created_at' => Carbon::now()
                ]);
            }

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



            try {
                // verify the credentials and create a token for the user
                if (!$token = JWTAuth::fromUser($user)) {
                    return response()->json([ 'status' => 0, 'error' => 'invalid_credentials'], 401);
                }
            } catch (JWTException $e) {
                // something went wrong
                return response()->json([ 'status' => 0, 'error' => 'could_not_create_token'], 500);
            }



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
            $userArray['promo_code'] = DB::table('promo_code')->where('user_id', '=', $userArray['id'])->pluck('code');

            //Code to check facebook connected for user.
            //Added by ansa@cubettech.com on 27-11-2015
            $userArray['facebook_connected'] = Social::isFacebookConnect($user['id']);

            return response()->json(['status' => 1, 'success' => 'successfully_updated_user_profile', 'token' => $token, 'user' => $userArray, 'urls' => config('urls.urls')], 200);
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
      "is_subscribed": 0,
      "user_raid": {
      "id": "6",
      "name": "Front Lever"
      },
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
      "facebook_connected": 0,
      "promo_code": "hewiby"
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
     * @apiError error Validation error.
     * @apiError error Validation error.
     * @apiError error user_not_verified User error.
     * @apiError error invalid_credentials User error.
     *
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

                $promoCode = DB::table('promo_code')->where('user_id', '=', Auth::user()->id)->first();

                if (is_null($promoCode)) {
                    DB::table('promo_code')->insert([
                        'code' => $this->getToken(6),
                        'user_id' => Auth::user()->id,
                        'created_at' => Carbon::now()
                    ]);
                }

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
                if (isset($request->device_token) && isset($request->device_type) && $request->device_token != null && $request->device_token != '(null)') {
                    $userDeviceToken = PushNotification::where('device_token', '=', $request->device_token)
                        ->where('type', '=', $request->device_type)
                        ->first();
                    if (is_null($userDeviceToken)) {
                        $deviceToken = PushNotification::create([
                                'user_id' => Auth::user()->id,
                                'type' => $request->device_type,
                                'device_token' => $request->device_token
                        ]);
                    } else {
                        $userDeviceToken->user_id = Auth::user()->id;
                        $userDeviceToken->device_token = $request->device_token;
                        $userDeviceToken->update();
                    }
                }

                $userArray = $user->toArray();

                $userArray['follower_count'] = DB::table('follows')->where('follow_id', '=', $userArray['id'])->count();
                $userArray['workout_count'] = Workout::workoutCount($userArray['id']);
                $userArray['points'] = Point::userPoints($userArray['id']);
                $userArray['level'] = Point::userLevel($userArray['id']);
                $userArray['promo_code'] = DB::table('promo_code')->where('user_id', '=', $userArray['id'])->pluck('code');

                //Code to check facebook connected for user.
                //Added by ansa@cubettech.com on 27-11-2015
                $userArray['facebook_connected'] = Social::isFacebookConnect($userArray['id']);
                $coachStatus = DB::table('coach_status')->where('user_id', $request->user_id)->first();
                if (!is_null($coachStatus)) {
                    $userArray['coach_week'] = $coachStatus->week;
                } else {
                    $userArray['coach_week'] = 0;
                }

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
      "facebook_connected": 0,
      "promo_code": "hewiby"
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

            $promoCode = DB::table('promo_code')->where('user_id', '=', Auth::user()->id)->first();

            if (is_null($promoCode)) {
                DB::table('promo_code')->insert([
                    'code' => $this->getToken(6),
                    'user_id' => Auth::user()->id,
                    'created_at' => Carbon::now()
                ]);
            }

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
                ->distinct()
                ->count() + DB::table('skilltraining_users')
                ->where('user_id', '=', $user['id'])
                ->where('status', '=', 1)
                ->distinct()
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

            $userArray['total_skills'] = DB::table('skills')
                ->distinct()
                ->count();
            
            $userArray['user_skills_count'] = DB::table('unlocked_skills')
                ->where('user_id', '=', $user['id'])
                ->distinct()
                ->count();

            $userArray['athlete_since'] = $userArray['created_at'];
            //Code to check facebook connected for user.
            //Added by ansa@cubettech.com on 27-11-2015
            $userArray['facebook_connected'] = Social::isFacebookConnect($user['id']);
            $userArray['promo_code'] = DB::table('promo_code')->where('user_id', '=', $userArray['id'])->pluck('code');

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
     * @apiError error Validation Error.
     * @apiError error email not registered with us.
     * @apiError error email already verified.
     *
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
        
        $profile = Profile::where('user_id', $user->id)->first();
        
        $confirmation_code = DB::table('password_resets')->where('email', $request->email)->pluck('token');
        
        if(is_null($confirmation_code)){
            return response()->json(['status' => 0, 'error' => 'Invalid user.'], 422);
        }

        Mail::send('email.verify', ['confirmation_code' => $confirmation_code, 'first_name' => $profile->first_name, 'last_name' => $profile->last_name], function($message) use ($user, $request) {
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
     * @apiParam {integer} [last_history_id] id last history id *required
     * @apiSuccess {String} success.
     * @apiSuccessExample Success-Response:
     * HTTP/1.1 200 OK
     * {
  "status": 1,
  "success": "history",
  "history": [
    {
      "id": "1497",
      "user_id": "100",
      "item_type": "exercise",
      "item_id": "78",
      "feed_text": "This is the Third test on V2",
      "image": "",
      "created_at": "2016-07-27 06:33:55",
      "updated_at": "2016-07-27 06:33:55",
      "category": "Lean",
      "item_name": "Australian Pullups",
      "duration": "5",
      "volume": "max",
      "sets": "8",
      "points": "96.00"
    },
    {
      "id": "1469",
      "user_id": "100",
      "item_type": "exercise",
      "item_id": "78",
      "feed_text": "This is the Third test on V2",
      "image": "",
      "created_at": "2016-07-20 06:53:04",
      "updated_at": "2016-07-20 06:53:04",
      "category": "Lean",
      "item_name": "Australian Pullups",
      "duration": "5",
      "volume": "15",
      "sets": "8",
      "points": "72.00"
    },
    {
      "id": "1468",
      "user_id": "100",
      "item_type": "exercise",
      "item_id": "78",
      "feed_text": "This is the Third test on V2",
      "image": "",
      "created_at": "2016-07-20 06:52:37",
      "updated_at": "2016-07-20 06:52:37",
      "category": "Lean",
      "item_name": "Australian Pullups",
      "duration": "5",
      "volume": "15",
      "sets": "3",
      "points": "27.00"
    },
    {
      "id": "1467",
      "user_id": "100",
      "item_type": "exercise",
      "item_id": "78",
      "feed_text": "This is the Third test on V2",
      "image": "",
      "created_at": "2016-07-20 06:52:33",
      "updated_at": "2016-07-20 06:52:33",
      "category": "Lean",
      "item_name": "Australian Pullups",
      "duration": "5",
      "volume": "15",
      "sets": "1",
      "points": "9.00"
    },
    {
      "id": "1466",
      "user_id": "100",
      "item_type": "exercise",
      "item_id": "78",
      "feed_text": "This is the Third test on V2",
      "image": "",
      "created_at": "2016-07-20 06:52:07",
      "updated_at": "2016-07-20 06:52:07",
      "category": "Lean",
      "item_name": "Australian Pullups",
      "duration": "5",
      "volume": "5",
      "sets": "10",
      "points": "30.00"
    },
    {
      "id": "1465",
      "user_id": "100",
      "item_type": "exercise",
      "item_id": "10",
      "feed_text": "This is the Third test on V2",
      "image": "",
      "created_at": "2016-07-20 06:51:19",
      "updated_at": "2016-07-20 06:51:19",
      "category": "Strength",
      "item_name": "One Arm Pushups",
      "duration": "5",
      "volume": "5",
      "sets": "5",
      "points": "22.50"
    },
    {
      "id": "1464",
      "user_id": "100",
      "item_type": "exercise",
      "item_id": "8",
      "feed_text": "This is the Third test on V2",
      "image": "",
      "created_at": "2016-07-20 06:51:13",
      "updated_at": "2016-07-20 06:51:13",
      "category": "Athletic",
      "item_name": "Bicycle",
      "duration": "5",
      "volume": "5",
      "sets": "5",
      "points": "17.50"
    },
    {
      "id": "1463",
      "user_id": "100",
      "item_type": "exercise",
      "item_id": "78",
      "feed_text": "This is the Third test on V2",
      "image": "",
      "created_at": "2016-07-20 06:51:08",
      "updated_at": "2016-07-20 06:51:08",
      "category": "Lean",
      "item_name": "Australian Pullups",
      "duration": "5",
      "volume": "5",
      "sets": "5",
      "points": "15.00"
    },
    {
      "id": "1462",
      "user_id": "100",
      "item_type": "exercise",
      "item_id": "78",
      "feed_text": "This is the Third test on V2",
      "image": "",
      "created_at": "2016-07-20 06:51:02",
      "updated_at": "2016-07-20 06:51:02",
      "category": "Lean",
      "item_name": "Australian Pullups",
      "duration": "5",
      "volume": "5",
      "sets": "3",
      "points": "9.00"
    },
    {
      "id": "1461",
      "user_id": "100",
      "item_type": "exercise",
      "item_id": "78",
      "feed_text": "This is the Third test on V2",
      "image": "",
      "created_at": "2016-07-20 06:50:58",
      "updated_at": "2016-07-20 06:50:58",
      "category": "Lean",
      "item_name": "Australian Pullups",
      "duration": "5",
      "volume": "5",
      "sets": "2",
      "points": "6.00"
    }
  ],
  "urls": {
    "profileImageSmall": "http://testing.ykings.com/uploads/images/profile/small",
    "profileImageMedium": "http://testing.ykings.com/uploads/images/profile/medium",
    "profileImageLarge": "http://testing.ykings.com/uploads/images/profile/large",
    "profileImageOriginal": "http://testing.ykings.com/uploads/images/profile/original",
    "video": "http://testing.ykings.com/uploads/videos",
    "videothumbnail": "http://testing.ykings.com/uploads/images/videothumbnails",
    "feedImageSmall": "http://testing.ykings.com/uploads/images/feed/small",
    "feedImageMedium": "http://testing.ykings.com/uploads/images/feed/medium",
    "feedImageLarge": "http://testing.ykings.com/uploads/images/feed/large",
    "feedImageOriginal": "http://testing.ykings.com/uploads/images/feed/original",
    "coverImageSmall": "http://testing.ykings.com/uploads/images/cover_image/small",
    "coverImageMedium": "http://testing.ykings.com/uploads/images/cover_image/medium",
    "coverImageLarge": "http://testing.ykings.com/uploads/images/cover_image/large",
    "coverImageOriginal": "http://testing.ykings.com/uploads/images/cover_image/original"
  },
  "last_history_id": "1461",
  "view_more": 1
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
                $userHistoryQuery = Feeds::where('user_id', '=', $request->user_id);
                $whereRawQuery = '(item_type = "exercise" OR item_type = "workout" OR item_type = "hiit") ';
                if (isset($request->last_history_id) && $request->last_history_id != null && $request->last_history_id != '(null)') {
                    $whereRawQuery .= 'AND id < ' . $request->last_history_id;
                }

                $userHistory = $userHistoryQuery->whereRaw($whereRawQuery)->orderBy('id', 'DESC')->take(10)->get();

                $userHistoryResponse = array();
                $viewMore = 1;

                if (count($userHistory) > 0) {
                    $userHistoryResponse = $this->AdditionalFeedsDetails($userHistory);
                    $lastActivity = end($userHistoryResponse);
                    $lastActivityId = $lastActivity->id;
                    $viewMore = (count($userHistory) >= 10) ? 1 : 0;
                    $viewMoreCount = Feeds::where('user_id', '=', $request->user_id)->whereRaw('(item_type = "exercise" OR item_type = "workout" OR item_type = "hiit") AND id < ' . $lastActivityId)->orderBy('id', 'DESC')->count();
                    if ($viewMoreCount > 0) {
                        $viewMore = 1;
                    }
                } else {
                    $lastActivityId = 0;
                    $viewMore = 0;
                }
                return response()->json(['status' => 1, 'success' => 'history', 'history' => $userHistoryResponse, 'urls' => config('urls.urls'), 'last_history_id' => $lastActivityId, 'view_more' => $viewMore], 200);
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
                        $history->category = "HIIT-strength";
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
                $history->sets = $exerciseUserDet->sets;
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
     * {
  "status": 1,
  "success": "history",
  "exercise_history": [
    {
      "id": "1",
      "name": "Side Plank",
      "description": "Achieve superior body control, strengthen your shoulders, and improve lateral torso stability.",
      "category": "3",
      "type": "1",
      "muscle_groups": "1,4,6,8",
      "rewards": "9.00",
      "repititions": "10",
      "duration": "10",
      "unit": "seconds",
      "equipment": "",
      "range_of_motion": "1. Start seated on the right hip with the knees slightly bent.\r\n2. Place supporting elbow on the floor and push your body up, so that it forms a perfect triangle with the floor.\r\n3. Hold the position while resting the other arm along side the body.\r\n4. Return slowly to starting position and switch sides.\r\n",
      "video_tips": "",
      "pro_tips": "\r\nTry advanced variations with fully extended support arm.\r\nLift up the non-supporting leg and arm while in the plank to work for more strength and balance.\r\nPay attention to push your inner thighs to the ceilings.\r\nGo slowly and controlled in and out of the side plank.\r\n",
      "video_tips_html": "",
      "pro_tips_html": "<ul><li>Try advanced variations with fully extended support arm.</li><li>Lift up the non-supporting leg and arm while in the plank to work for more strength and balance.</li><li>Pay attention to push your inner thighs to the ceilings.</li><li>Go slowly and controlled in and out of the side plank.</li></ul>",
      "range_of_motion_html": "<ol><li>Start seated on the right hip with the knees slightly bent.</li><li>Place supporting elbow on the floor and push your body up, so that it forms a perfect triangle with the floor.</li><li>Hold the position while resting the other arm along side the body.</li><li>Return slowly to starting position and switch sides.</li></ol>",
      "is_static": "0",
      "musclegroup_string": "Shoulders, Back, Core, Full Body",
      "scores": {
        "1": {
          "5": [],
          "10": [],
          "15": [],
          "20": [],
          "30": [],
          "45": [],
          "60": [],
          "90": [],
          "120": [],
          "max": []
        },
        "2": {
          "5": [],
          "10": [],
          "15": [],
          "20": [],
          "30": [],
          "45": [],
          "60": [],
          "90": [],
          "120": [],
          "max": []
        },
        "3": {
          "5": [],
          "10": [],
          "15": [],
          "20": [],
          "30": [],
          "45": [],
          "60": [],
          "90": [],
          "120": [],
          "max": []
        },
        "4": {
          "5": [],
          "10": [],
          "15": [],
          "20": [],
          "30": [],
          "45": [],
          "60": [],
          "90": [],
          "120": [],
          "max": []
        },
        "5": {
          "5": [],
          "10": [],
          "15": [],
          "20": [],
          "30": [],
          "45": [],
          "60": [],
          "90": [],
          "120": [],
          "max": []
        },
        "6": {
          "5": [],
          "10": [],
          "15": [],
          "20": [],
          "30": [],
          "45": [],
          "60": [],
          "90": [],
          "120": [],
          "max": []
        },
        "7": {
          "5": [],
          "10": [],
          "15": [],
          "20": [],
          "30": [],
          "45": [],
          "60": [],
          "90": [],
          "120": [],
          "max": []
        },
        "8": {
          "5": [],
          "10": [],
          "15": [],
          "20": [],
          "30": [],
          "45": [],
          "60": [],
          "90": [],
          "120": [],
          "max": []
        },
        "9": {
          "5": [],
          "10": [],
          "15": [],
          "20": [],
          "30": [],
          "45": [],
          "60": [],
          "90": [],
          "120": [],
          "max": []
        },
        "10": {
          "5": [],
          "10": [],
          "15": [],
          "20": [],
          "30": [],
          "45": [],
          "60": [],
          "90": [],
          "120": [],
          "max": []
        }
      }
    },
    {
      "id": "2",
      "name": "Decline Plank",
      "description": "Strengthen and tone your abs",
      "category": "3",
      "type": "1",
      "muscle_groups": "1,4,6,8",
      "rewards": "7.00",
      "repititions": "10",
      "duration": "10",
      "unit": "seconds",
      "equipment": "",
      "range_of_motion": "1. Get into pushup position on the floor with your legs positioned on higher ground (box).\r\n2. Now bend your elbows 90 degrees and rest your weight on your forearms.\r\n3. Hold the position for as long as you can while keeping a straight line.\r\n",
      "video_tips": "",
      "pro_tips": "\r\nFeet slightly raised above the level of the elbows is sufficient.\r\nTry variations with fully extended arms.\r\nKeeping the spine from moving teaches creating stability through the spine, hips and shoulders while extending the hip or flexing the shoulder.\r\n",
      "video_tips_html": "",
      "pro_tips_html": "<ul>\r\n<li>Feet slightly raised above the level of the elbows is sufficient.</li>\r\n<li>Try variations with fully extended arms.</li>\r\n<li>Keeping the spine from moving teaches creating stability through the spine, hips and shoulders while extending the hip or flexing the shoulder.</li>\r\n</ul>",
      "range_of_motion_html": "<ol>\r\n<li>Get into pushup position on the floor with your legs positioned on higher ground (box).</li>\r\n<li>Now bend your elbows 90 degrees and rest your weight on your forearms.</li>\r\n<li>Hold the position for as long as you can while keeping a straight line.</li>\r\n</ol>",
      "is_static": "0",
      "musclegroup_string": "Shoulders, Back, Core, Full Body",
      "scores": {
        "1": {
          "5": [],
          "10": [],
          "15": [],
          "20": [],
          "30": [],
          "45": [],
          "60": [],
          "90": [],
          "120": [],
          "max": []
        },
        "2": {
          "5": [],
          "10": [],
          "15": [],
          "20": [],
          "30": [],
          "45": [],
          "60": [],
          "90": [],
          "120": [],
          "max": []
        },
        "3": {
          "5": [],
          "10": [],
          "15": [],
          "20": [],
          "30": [],
          "45": [],
          "60": [],
          "90": [],
          "120": [],
          "max": []
        },
        "4": {
          "5": [],
          "10": [],
          "15": [],
          "20": [],
          "30": [],
          "45": [],
          "60": [],
          "90": [],
          "120": [],
          "max": []
        },
        "5": {
          "5": [],
          "10": [],
          "15": [],
          "20": [],
          "30": [],
          "45": [],
          "60": [],
          "90": [],
          "120": [],
          "max": []
        },
        "6": {
          "5": [],
          "10": [],
          "15": [],
          "20": [],
          "30": [],
          "45": [],
          "60": [],
          "90": [],
          "120": [],
          "max": []
        },
        "7": {
          "5": [],
          "10": [],
          "15": [],
          "20": [],
          "30": [],
          "45": [],
          "60": [],
          "90": [],
          "120": [],
          "max": []
        },
        "8": {
          "5": [],
          "10": [],
          "15": [],
          "20": [],
          "30": [],
          "45": [],
          "60": [],
          "90": [],
          "120": [],
          "max": []
        },
        "9": {
          "5": [],
          "10": [],
          "15": [],
          "20": [],
          "30": [],
          "45": [],
          "60": [],
          "90": [],
          "120": [],
          "max": []
        },
        "10": {
          "5": [],
          "10": [],
          "15": [],
          "20": [],
          "30": [],
          "45": [],
          "60": [],
          "90": [],
          "120": [],
          "max": []
        }
      }
    },
    {
      "id": "3",
      "name": "Tucked Plank",
      "description": "Put an emphasis on your shoulders and your posture.",
      "category": "2",
      "type": "1",
      "muscle_groups": "1,4,6,8",
      "rewards": "7.00",
      "repititions": "10",
      "duration": "10",
      "unit": "seconds",
      "equipment": "",
      "range_of_motion": "1. Get into pushup position on the floor.\r\n2. Arms stay fully extended. Rest your weight on your arms. \r\n3. Bring one leg to the chest while maintaining the postion.\r\n4. Alternate the legs for as long as you can. ",
      "video_tips": "      ",
      "pro_tips": "Keep your neck long and in line with your spine. \r\nDon't look ahead and don't look at your feet, look slightly ahead of yourself.",
      "video_tips_html": "",
      "pro_tips_html": "",
      "range_of_motion_html": "",
      "is_static": "0",
      "musclegroup_string": "Shoulders, Back, Core, Full Body",
      "scores": {
        "1": {
          "5": [],
          "10": [],
          "15": [],
          "20": [],
          "30": [],
          "45": [],
          "60": [],
          "90": [],
          "120": [],
          "max": []
        },
        "2": {
          "5": [],
          "10": [],
          "15": [],
          "20": [],
          "30": [],
          "45": [],
          "60": [],
          "90": [],
          "120": [],
          "max": []
        },
        "3": {
          "5": [],
          "10": [],
          "15": [],
          "20": [],
          "30": [],
          "45": [],
          "60": [],
          "90": [],
          "120": [],
          "max": []
        },
        "4": {
          "5": [],
          "10": [],
          "15": [],
          "20": [],
          "30": [],
          "45": [],
          "60": [],
          "90": [],
          "120": [],
          "max": []
        },
        "5": {
          "5": [],
          "10": [],
          "15": [],
          "20": [],
          "30": [],
          "45": [],
          "60": [],
          "90": [],
          "120": [],
          "max": []
        },
        "6": {
          "5": [],
          "10": [],
          "15": [],
          "20": [],
          "30": [],
          "45": [],
          "60": [],
          "90": [],
          "120": [],
          "max": []
        },
        "7": {
          "5": [],
          "10": [],
          "15": [],
          "20": [],
          "30": [],
          "45": [],
          "60": [],
          "90": [],
          "120": [],
          "max": []
        },
        "8": {
          "5": [],
          "10": [],
          "15": [],
          "20": [],
          "30": [],
          "45": [],
          "60": [],
          "90": [],
          "120": [],
          "max": []
        },
        "9": {
          "5": [],
          "10": [],
          "15": [],
          "20": [],
          "30": [],
          "45": [],
          "60": [],
          "90": [],
          "120": [],
          "max": []
        },
        "10": {
          "5": [],
          "10": [],
          "15": [],
          "20": [],
          "30": [],
          "45": [],
          "60": [],
          "90": [],
          "120": [],
          "max": []
        }
      }
    },
    {
      "id": "4",
      "name": "Plank",
      "description": "The plank builds your isometric strength and helps sculpt your waistline.",
      "category": "1",
      "type": "1",
      "muscle_groups": "1,4,6,8",
      "rewards": "6.00",
      "repititions": "10",
      "duration": "10",
      "unit": "seconds",
      "equipment": "",
      "range_of_motion": "1. Get into pushup position on the floor.\r\n2. Now bend your elbows 90 degrees and rest your weight on your forearms. \r\n3. Hold the position for as long as you can.   ",
      "video_tips": "        ",
      "pro_tips": "Drive your chest away from the ground and spread your shoulder blades as much as you can.\r\nKeep a straight line, from head to toe. \r\nDon't collapse your lower back or reach your butt to the sky. Add movement to your plank, rock back and forth on your forearms and toes or shift from side to side.\r\nTry advanced variations with alternating sinlge leg support. \r\nStart with an incline plank if a straight plank is too hard in the beginning.  ",
      "video_tips_html": "",
      "pro_tips_html": "",
      "range_of_motion_html": "",
      "is_static": "0",
      "musclegroup_string": "Shoulders, Back, Core, Full Body",
      "scores": {
        "1": {
          "5": [],
          "10": [],
          "15": [],
          "20": [],
          "30": [],
          "45": [],
          "60": [],
          "90": [],
          "120": [],
          "max": []
        },
        "2": {
          "5": [],
          "10": [],
          "15": [],
          "20": [],
          "30": [],
          "45": [],
          "60": [],
          "90": [],
          "120": [],
          "max": []
        },
        "3": {
          "5": [],
          "10": [],
          "15": [],
          "20": [],
          "30": [],
          "45": [],
          "60": [],
          "90": [],
          "120": [],
          "max": []
        },
        "4": {
          "5": [],
          "10": [],
          "15": [],
          "20": [],
          "30": [],
          "45": [],
          "60": [],
          "90": [],
          "120": [],
          "max": []
        },
        "5": {
          "5": [],
          "10": [],
          "15": [],
          "20": [],
          "30": [],
          "45": [],
          "60": [],
          "90": [],
          "120": [],
          "max": []
        },
        "6": {
          "5": [],
          "10": [],
          "15": [],
          "20": [],
          "30": [],
          "45": [],
          "60": [],
          "90": [],
          "120": [],
          "max": []
        },
        "7": {
          "5": [],
          "10": [],
          "15": [],
          "20": [],
          "30": [],
          "45": [],
          "60": [],
          "90": [],
          "120": [],
          "max": []
        },
        "8": {
          "5": [],
          "10": [],
          "15": [],
          "20": [],
          "30": [],
          "45": [],
          "60": [],
          "90": [],
          "120": [],
          "max": []
        },
        "9": {
          "5": [],
          "10": [],
          "15": [],
          "20": [],
          "30": [],
          "45": [],
          "60": [],
          "90": [],
          "120": [],
          "max": []
        },
        "10": {
          "5": [],
          "10": [],
          "15": [],
          "20": [],
          "30": [],
          "45": [],
          "60": [],
          "90": [],
          "120": [],
          "max": []
        }
      }
    },
    {
      "id": "5",
      "name": "Jackknives",
      "description": "Build your abs and obliques",
      "category": "3",
      "type": "1",
      "muscle_groups": "6",
      "rewards": "9.00",
      "repititions": "10",
      "duration": "10",
      "unit": "times",
      "equipment": "",
      "range_of_motion": "1. Lie straight on an exercise mat and extend your arms straight back behind your head.\r\n2. Elevate your legs and arms and bend your waist at the same time and touch your feet when they are totally vertical.\r\n3. Keep your arms fully extended, totally parallel to your legs. Go back down, repeat.\r\n   ",
      "video_tips": "      ",
      "pro_tips": "Fight for inches and hold in upper position for even more core strength.\r\nKeep track on good form and keep your upper body elevated from the floor.\r\n   ",
      "video_tips_html": "",
      "pro_tips_html": "",
      "range_of_motion_html": "",
      "is_static": "0",
      "musclegroup_string": "Core",
      "scores": {
        "1": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "2": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "3": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "4": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "5": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "6": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "7": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "8": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "9": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "10": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        }
      }
    },
    {
      "id": "6",
      "name": "V-up Rollup",
      "description": "Coordinate a harder variation of core body strength & control.",
      "category": "3",
      "type": "1",
      "muscle_groups": "6",
      "rewards": "7.00",
      "repititions": "10",
      "duration": "10",
      "unit": "times",
      "equipment": "",
      "range_of_motion": "1. Lie on your back on the floor with arms by your sides and your legs extended out.\r\n2. Lift your upper body up off the floor and reach out with your hands towards your toes.\r\n3. As you roll down, extend your arms above your head and let your legs lift off the floor. \r\n4. As soon as your back touches the floor, perform the v-up.",
      "video_tips": "      ",
      "pro_tips": "Keep your chin away from your chest, and make sure the movement is done in a controlled manner.\r\nWhile doing this exercise, your legs should be fully extended near about 30-45 degrees from the floor.",
      "video_tips_html": "",
      "pro_tips_html": "",
      "range_of_motion_html": "",
      "is_static": "0",
      "musclegroup_string": "Core",
      "scores": {
        "1": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "2": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "3": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "4": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "5": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "6": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "7": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "8": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "9": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "10": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        }
      }
    },
    {
      "id": "7",
      "name": "Situps",
      "description": "Build a strong core and fight for real abs.",
      "category": "2",
      "type": "1",
      "muscle_groups": "6",
      "rewards": "7.00",
      "repititions": "10",
      "duration": "10",
      "unit": "times",
      "equipment": "",
      "range_of_motion": "1. Lying on back with knees bent\r\n2. Pull torso upwards and touch the floor in front of feet\r\n3. Lower your torso to the floor\r\n4. Quickly touch the floor behind your head and go back up\r\n",
      "video_tips": "    ",
      "pro_tips": "If you experience any back pain then perform the same exercise on a gym ball to comfort your spine.\r\nDo the situp without using the swing of your arms.",
      "video_tips_html": "",
      "pro_tips_html": "",
      "range_of_motion_html": "",
      "is_static": "0",
      "musclegroup_string": "Core",
      "scores": {
        "1": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "2": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "3": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "4": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "5": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "6": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "7": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "8": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "9": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "10": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        }
      }
    },
    {
      "id": "8",
      "name": "Bicycle",
      "description": "Strengthen your side-ab muscle and stabilize your torso rotation",
      "category": "2",
      "type": "1",
      "muscle_groups": "6",
      "rewards": "7.00",
      "repititions": "10",
      "duration": "10",
      "unit": "times",
      "equipment": "",
      "range_of_motion": "1. Lie flat on the floor with the lower back pressed into the floor\r\n2. Place your hands slightly behind your head\r\n3. Move one knee and its opposite elbow toward each other while straightening the other leg\r\n4. Repeat with other side",
      "video_tips": "      ",
      "pro_tips": "Keep elbows back and don't push your head or neck up with your hands. \r\nConcentrate to work with your core. The slower, the better.\r\nFocus on getting your shoulder blades of the ground. Think shoulder to knee instead of elbow to knee.\r\nKeep the rhythm of changing sides for continuous alternate crunches maintained and do as many reps as your body allows.",
      "video_tips_html": "",
      "pro_tips_html": "",
      "range_of_motion_html": "",
      "is_static": "0",
      "musclegroup_string": "Core",
      "scores": {
        "1": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "2": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "3": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "4": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "5": {
          "1": [],
          "3": [],
          "5": [
            {
              "id": "859",
              "user_id": "100",
              "exercise_id": "8",
              "status": "1",
              "time": "5",
              "is_starred": "1",
              "volume": "5",
              "feed_id": "1464",
              "sets": "5",
              "created_at": "2016-07-20 06:51:13",
              "updated_at": "2016-07-20 06:51:13"
            }
          ],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "6": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "7": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "8": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "9": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "10": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        }
      }
    },
    {
      "id": "9",
      "name": "Crunches",
      "description": "Do the most admired sixpack exercise in the world",
      "category": "1",
      "type": "1",
      "muscle_groups": "6",
      "rewards": "6.00",
      "repititions": "10",
      "duration": "10",
      "unit": "times",
      "equipment": "",
      "range_of_motion": "1. Starting position is with lying face up on the floor with knees bent. \r\n2. Move torso up and touch your knees with your hands\r\n3. Lower body to the floor and repeat\r\n  ",
      "video_tips": "    ",
      "pro_tips": "Do variations in tempo. Aim for one count up and three counts down.\r\nIf you have a tendency to interlace your fingers and yank your head, place your hands cross-chest.",
      "video_tips_html": "",
      "pro_tips_html": "",
      "range_of_motion_html": "",
      "is_static": "0",
      "musclegroup_string": "Core",
      "scores": {
        "1": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "2": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "3": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "4": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "5": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "6": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "7": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "8": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "9": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "10": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        }
      }
    },
    {
      "id": "10",
      "name": "One Arm Pushups",
      "description": "Master one of the most demanding and rewarding exercises in calisthenics.",
      "category": "3",
      "type": "1",
      "muscle_groups": "1,2,3,5",
      "rewards": "9.00",
      "repititions": "10",
      "duration": "10",
      "unit": "times",
      "equipment": "",
      "range_of_motion": " 1.Get in a pushup position and place one hand on the floor centered.\r\n2. Next, lower yourself downward until your chest almost touches the floor.\r\n3. Press your upper body back up to the starting position with the other hand on your back.\r\n4. Repeat and switch hands for a balanced workout ",
      "video_tips": "      ",
      "pro_tips": " Try a straddle stance for better balance. The wider you go, the easier the move becomes. So feel free to start wide, but aim to get narrower over time. \r\nAim also for shoulders parallel to the ground.\r\n   ",
      "video_tips_html": "",
      "pro_tips_html": "",
      "range_of_motion_html": "",
      "is_static": "0",
      "musclegroup_string": "Shoulders, Chest, Triceps, Arms",
      "scores": {
        "1": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "2": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "3": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "4": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "5": {
          "1": [],
          "3": [],
          "5": [
            {
              "id": "860",
              "user_id": "100",
              "exercise_id": "10",
              "status": "1",
              "time": "5",
              "is_starred": "1",
              "volume": "5",
              "feed_id": "1465",
              "sets": "5",
              "created_at": "2016-07-20 06:51:19",
              "updated_at": "2016-07-20 06:51:19"
            }
          ],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "6": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "7": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "8": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "9": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "10": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        }
      }
    },
    {
      "id": "11",
      "name": "Incline One Arm Pushups",
      "description": "Build pure one arm and body power",
      "category": "3",
      "type": "1",
      "muscle_groups": "1,2,3",
      "rewards": "7.00",
      "repititions": "10",
      "duration": "10",
      "unit": "times",
      "equipment": "",
      "range_of_motion": "1. Place one hand on edge of bench or bar at waist height, and put the other behind your back\r\n2. Start lowering your body until the chest almost touches the bench or bar. \r\n3. Bring your body up in a controlled manner and repeat.\r\n   ",
      "video_tips": "      ",
      "pro_tips": " Remember to think about squeezing your whole body, especially your abs and glutes, in order to create full-body tension when practicing toward one-arm push-ups.\r\nTwist of the body should be minimal\r\nBody should be straight (looking from the side)\r\nYou should lower down until there is no more than 10 cm between the ground and your chest",
      "video_tips_html": "",
      "pro_tips_html": "",
      "range_of_motion_html": "",
      "is_static": "0",
      "musclegroup_string": "Shoulders, Chest, Triceps",
      "scores": {
        "1": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "2": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "3": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "4": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "5": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "6": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "7": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "8": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "9": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "10": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        }
      }
    },
    {
      "id": "12",
      "name": "Pushups",
      "description": "Perform the most popular exercise of all time with real strength",
      "category": "2",
      "type": "1",
      "muscle_groups": "1,2,3",
      "rewards": "7.00",
      "repititions": "10",
      "duration": "10",
      "unit": "times",
      "equipment": "",
      "range_of_motion": " 1. Lie on the floor face down and place your hands in a standard pushup position.\r\n 2. Next, lower yourself downward until your chest almost touches the floor as you inhale.\r\n 3. Exhale and press your upper body back up to the starting position while squeezing your chest.\r\n 4. Repeat, after a brief pause at the top contracted position.\r\n",
      "video_tips": "      ",
      "pro_tips": "Do them extra slow and hold it in highest and lowest position to get strength.\r\nOne of the most common push-up mistakes is flaring out the elbows out instead of keeping them at your sides.\r\nIf too easy, try Spiderman and Diamond Pushups or wear a weigthed vest.",
      "video_tips_html": "",
      "pro_tips_html": "",
      "range_of_motion_html": "",
      "is_static": "0",
      "musclegroup_string": "Shoulders, Chest, Triceps",
      "scores": {
        "1": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "2": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "3": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "4": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "5": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "6": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "7": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "8": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "9": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "10": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        }
      }
    },
    {
      "id": "13",
      "name": "Ball Pushups",
      "description": "Balance your body and develop wrist strength.",
      "category": "2",
      "type": "1",
      "muscle_groups": "1,2,3",
      "rewards": "7.00",
      "repititions": "10",
      "duration": "10",
      "unit": "times",
      "equipment": "",
      "range_of_motion": "1. Get into a pushup position resting both hand on ball.\r\n2. Fight the balance as you perform a pushup with the chest to the ball",
      "video_tips": "      ",
      "pro_tips": "Work your wrist mobility thoroughly before attempting ball pushups.\r\nTry a variations resting one arm on the ball and the other on the floor to shift the muscle focus more to your shoulders.\r\nGet into a straddle stance if too tough in the beginning.",
      "video_tips_html": "",
      "pro_tips_html": "",
      "range_of_motion_html": "",
      "is_static": "0",
      "musclegroup_string": "Shoulders, Chest, Triceps",
      "scores": {
        "1": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "2": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "3": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "4": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "5": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "6": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "7": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "8": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "9": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "10": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        }
      }
    },
    {
      "id": "14",
      "name": "Incline Pushups",
      "description": "Start your journey with the simplest way to develop an athletic physique",
      "category": "1",
      "type": "1",
      "muscle_groups": "1,2,3",
      "rewards": "6.00",
      "repititions": "10",
      "duration": "10",
      "unit": "times",
      "equipment": "",
      "range_of_motion": "1. Place hands on edge of bench, bar or rings at waist height, slightly wider than shoulder width \r\n2. Perform regular pushup. Arms should be perpendicular to body. \r\n  ",
      "video_tips": "    ",
      "pro_tips": "Resistance can be de- or increased by performing movement on different angles.\r\nAvoid rounding your spine and doing ?banana back? pushups, try squeezing your core.\r\n  ",
      "video_tips_html": "",
      "pro_tips_html": "",
      "range_of_motion_html": "",
      "is_static": "0",
      "musclegroup_string": "Shoulders, Chest, Triceps",
      "scores": {
        "1": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "2": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "3": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "4": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "5": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "6": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "7": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "8": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "9": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "10": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        }
      }
    },
    {
      "id": "15",
      "name": "Handstand Pushups",
      "description": "Master one of the hardest calisthenics movements out there",
      "category": "3",
      "type": "1",
      "muscle_groups": "1,3,6",
      "rewards": "9.00",
      "repititions": "10",
      "duration": "10",
      "unit": "times",
      "equipment": "",
      "range_of_motion": " 1. Walk up a wall or kick into a wall for an assisted wall handstand\r\n2. Lower yourself slowly and in full controll till your head almost touches the floor \r\n3. Press up in the standard handstand position and repeat. ",
      "video_tips": "      ",
      "pro_tips": " When doing this exercise, you must keep the lower body activated to keep balance and keep the body in a straight line. ",
      "video_tips_html": "",
      "pro_tips_html": "",
      "range_of_motion_html": "",
      "is_static": "0",
      "musclegroup_string": "Shoulders, Triceps, Core",
      "scores": {
        "1": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "2": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "3": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "4": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "5": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "6": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "7": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "8": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "9": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "10": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        }
      }
    },
    {
      "id": "16",
      "name": "Handstand",
      "description": "Improve your overall strength, body control, and spatial awareness",
      "category": "3",
      "type": "1",
      "muscle_groups": "1,5,6",
      "rewards": "7.00",
      "repititions": "10",
      "duration": "10",
      "unit": "times",
      "equipment": "",
      "range_of_motion": " 1. Walk up a wall or kick into a wall for an assisted wall handstand\r\n2. Lower yourself slowly and in full controll till your head almost touches the floor \r\n3. Press up in the standard handstand position and repeat. ",
      "video_tips": "          ",
      "pro_tips": " The two areas that will take the brunt of the force when you?re upside down are your wrists and your shoulders. \r\nWarmup your wrists before handstand training and spread your fingers for better balance.\r\nImprove your shoulder strength and flexibility before attempting handstands.\r\nWork on a hollow body hold for core strength and control. ",
      "video_tips_html": "",
      "pro_tips_html": "",
      "range_of_motion_html": "",
      "is_static": "1",
      "musclegroup_string": "Shoulders, Arms, Core",
      "scores": {
        "1": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "2": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "3": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "4": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "5": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "6": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "7": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "8": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "9": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "10": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        }
      }
    },
    {
      "id": "17",
      "name": "Crow Pose",
      "description": "Learn the essential static hold to challenge your strength, flexibility, and coordination",
      "category": "2",
      "type": "1",
      "muscle_groups": "1,3",
      "rewards": "7.00",
      "repititions": "10",
      "duration": "10",
      "unit": "times",
      "equipment": "",
      "range_of_motion": "1. Squat down\r\n2. Hands on the floor shoulder width apart\r\n3. Leaning forward bending at the elbows",
      "video_tips": "        ",
      "pro_tips": "Do tippy toes supported crow pose in the beginning.\r\nAlthough the advanced version of Crow is done with straight arms, try it first with bent elbows.\r\nHold for a breath or two and then with control, lower your feet to the floor. Repeat rocking in and out of Crow to strengthen your core, upper body, and the muscles in your hands.\r\n",
      "video_tips_html": "",
      "pro_tips_html": "",
      "range_of_motion_html": "",
      "is_static": "1",
      "musclegroup_string": "Shoulders, Triceps",
      "scores": {
        "1": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "2": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "3": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "4": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "5": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "6": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "7": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "8": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "9": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "10": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        }
      }
    },
    {
      "id": "18",
      "name": "Elevated Pike Pushups",
      "description": "Create more body awareness while feeling the power in your shoulders",
      "category": "2",
      "type": "1",
      "muscle_groups": "1,3",
      "rewards": "7.00",
      "repititions": "10",
      "duration": "10",
      "unit": "times",
      "equipment": "",
      "range_of_motion": "1. Put your hands in front of you and place your toes on an elevated position\r\n2. Arms and back to form one line\r\n3. Bring body down and engage should muscles\r\n4. Press back up to starting position",
      "video_tips": "      ",
      "pro_tips": "Your body should resemble more of a right angle than a V-shape.\r\nElevating your feet increases the difficulty of the pike push-up by changing the leverage and placing more of your weight onto your hands. This forces you to use the strength of your upper body to perform a rep.",
      "video_tips_html": "",
      "pro_tips_html": "",
      "range_of_motion_html": "",
      "is_static": "0",
      "musclegroup_string": "Shoulders, Triceps",
      "scores": {
        "1": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "2": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "3": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "4": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "5": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "6": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "7": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "8": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "9": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "10": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        }
      }
    },
    {
      "id": "19",
      "name": "Military Press",
      "description": "Your ?go to? exercise while working your way up to the Handstand Push-Up.",
      "category": "1",
      "type": "1",
      "muscle_groups": "1,3",
      "rewards": "6.00",
      "repititions": "10",
      "duration": "10",
      "unit": "times",
      "equipment": "",
      "range_of_motion": "1. Put your hands in front of you and stand on your toes\r\n2. Arms and back to form one line\r\n3. Bring body down and engage should muscles\r\n4. Press back up to starting position",
      "video_tips": "      ",
      "pro_tips": "The key is to keep the hips as high above the shoulders, with straight knees and a flat back.\r\nForm an \"A\" over time and start with static holds if you have trouble doing the pushups in the beginning.",
      "video_tips_html": "",
      "pro_tips_html": "",
      "range_of_motion_html": "",
      "is_static": "0",
      "musclegroup_string": "Shoulders, Triceps",
      "scores": {
        "1": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "2": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "3": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "4": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "5": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "6": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "7": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "8": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "9": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "10": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        }
      }
    },
    {
      "id": "20",
      "name": "Atztec Pushups",
      "description": "The ultimate combination of explosiveness and flexibility",
      "category": "3",
      "type": "2",
      "muscle_groups": "1,2,5,6,8",
      "rewards": "9.00",
      "repititions": "10",
      "duration": "10",
      "unit": "times",
      "equipment": "",
      "range_of_motion": " 1. Start in a standard pushup position.\r\n2. Next, lower yourself downward until your chest almost touches the floor as you inhale.\r\n3. Press up explosively and touch your toes with your hands in the air\r\n4. Land as softly as you can on your hands and toes back in the push-up position. ",
      "video_tips": "        ",
      "pro_tips": " Warm up and stretch before attempting any explosive kind of exercise such as Aztect Pushups.\r\nFocus to bring your butt up high in the air.\r\nDo this on a padded surface to prevent injury.\r\nIf you can't complete one, try it without touching your toes first. ",
      "video_tips_html": "",
      "pro_tips_html": "",
      "range_of_motion_html": "",
      "is_static": "0",
      "musclegroup_string": "Shoulders, Chest, Arms, Core, Full Body",
      "scores": {
        "1": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "2": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "3": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "4": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "5": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "6": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "7": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "8": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "9": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "10": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        }
      }
    },
    {
      "id": "21",
      "name": "Explosive Pushups",
      "description": "Start developing explosive power that adds up to your ballistic strength",
      "category": "2",
      "type": "2",
      "muscle_groups": "1,2,3,5",
      "rewards": "7.00",
      "repititions": "10",
      "duration": "10",
      "unit": "times",
      "equipment": "",
      "range_of_motion": "  1. Start in a standard pushup position.\r\n 2. Next, lower yourself downward until your chest almost touches the floor as you inhale.\r\n 3. Press up explosively and get your upper body off the floor ",
      "video_tips": "      ",
      "pro_tips": " If you can't complete one, try it in an incline variation.\r\nPay attention to don't round your back when pushing up.  ",
      "video_tips_html": "",
      "pro_tips_html": "",
      "range_of_motion_html": "",
      "is_static": "0",
      "musclegroup_string": "Shoulders, Chest, Triceps, Arms",
      "scores": {
        "1": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "2": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "3": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "4": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "5": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "6": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "7": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "8": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "9": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "10": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        }
      }
    },
    {
      "id": "22",
      "name": "Spiderman Pushups",
      "description": "Learn to control your body and create body awareness",
      "category": "1",
      "type": "2",
      "muscle_groups": "2,3,5,6",
      "rewards": "6.00",
      "repititions": "10",
      "duration": "10",
      "unit": "times",
      "equipment": "",
      "range_of_motion": "  1. Start in a standard pushup position.\r\n 2. Next, lower yourself downward until your chest almost touches the floor as you inhale.\r\n 3. Bring your knees to your elbows as you go down and alternate with next repition. ",
      "video_tips": "      ",
      "pro_tips": " Pretend you are balancing something on your tailbone as you do the Spiderman pushup to maintain the correct plank position. This keeps your hips from rotating. ",
      "video_tips_html": "",
      "pro_tips_html": "",
      "range_of_motion_html": "",
      "is_static": "0",
      "musclegroup_string": "Chest, Triceps, Arms, Core",
      "scores": {
        "1": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "2": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "3": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "4": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "5": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "6": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "7": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "8": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "9": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "10": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        }
      }
    },
    {
      "id": "23",
      "name": "Bruce Lee Pushups",
      "description": "Master the tough variation of pike pushups",
      "category": "3",
      "type": "2",
      "muscle_groups": "1,3",
      "rewards": "9.00",
      "repititions": "10",
      "duration": "10",
      "unit": "times",
      "equipment": "",
      "range_of_motion": "1. Start in a standard pushup position with your hands forming a diamond below your chest and feet elevated\r\n2. Next, lower yourself downward until your head almost touches the floor.\r\n3. Exhale and press your upper body back up to the starting position while squeezing your chest.\r\n4. Repeat, after a brief pause at the top contracted position.",
      "video_tips": "    ",
      "pro_tips": "  Try with straddled feet if to difficult.\r\n  ",
      "video_tips_html": "",
      "pro_tips_html": "",
      "range_of_motion_html": "",
      "is_static": "0",
      "musclegroup_string": "Shoulders, Triceps",
      "scores": {
        "1": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "2": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "3": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "4": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "5": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "6": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "7": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "8": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "9": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "10": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        }
      }
    },
    {
      "id": "24",
      "name": "Diamond Pushups",
      "description": "Develop your arm, chest and shoulder strength",
      "category": "2",
      "type": "2",
      "muscle_groups": "1,2,5",
      "rewards": "7.00",
      "repititions": "10",
      "duration": "10",
      "unit": "times",
      "equipment": "",
      "range_of_motion": "1. Start in a standard pushup position with your hands forming a diamond below your chest.\r\n2. Next, lower yourself downward until your chest almost touches your hands.\r\n3. Exhale and press your upper body back up to the starting position while squeezing your chest.\r\n4. Repeat, after a brief pause at the top contracted position.",
      "video_tips": "    ",
      "pro_tips": "Try with straddled feet if to difficult.\r\nIf you can?t do 1 diamond push up, get strong enough for 20 regular push ups, then gradually move your hands closer until you can do 1 rep with your thumbs touching.\r\n  ",
      "video_tips_html": "",
      "pro_tips_html": "",
      "range_of_motion_html": "",
      "is_static": "0",
      "musclegroup_string": "Shoulders, Chest, Arms",
      "scores": {
        "1": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "2": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "3": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "4": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "5": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "6": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "7": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "8": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "9": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "10": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        }
      }
    },
    {
      "id": "25",
      "name": "Decline Pushups",
      "description": "Increase the intensity and difficulty of a standard push ups and help you build shoulder strength fast",
      "category": "1",
      "type": "2",
      "muscle_groups": "2,5",
      "rewards": "6.00",
      "repititions": "10",
      "duration": "10",
      "unit": "times",
      "equipment": "",
      "range_of_motion": " 1. Start in a standard pushup position with your feet elevated.\r\n2. Next, lower yourself downward until your chest almost touches the floor as you inhale.\r\n3. Press up and repeat movement.\r\n   ",
      "video_tips": "      ",
      "pro_tips": " Start slowly and perform decline pushups in a slow and controlled manner.\r\nGradually increase the angle of the decline as you get stronger. \r\nTo increase the challenge of a decline pushup even more, lift one leg off the bench as you go into your pushup and leave it elevated for a few repetitions. Then switch sides, elevating your other leg.\r\n ",
      "video_tips_html": "",
      "pro_tips_html": "",
      "range_of_motion_html": "",
      "is_static": "0",
      "musclegroup_string": "Chest, Arms",
      "scores": {
        "1": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "2": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "3": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "4": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "5": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "6": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "7": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "8": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "9": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "10": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        }
      }
    },
    {
      "id": "26",
      "name": "Dragon Flag",
      "description": "Master Bruce Lee's go-to abs move",
      "category": "3",
      "type": "2",
      "muscle_groups": "3,6",
      "rewards": "9.00",
      "repititions": "10",
      "duration": "10",
      "unit": "times",
      "equipment": "",
      "range_of_motion": " 1. Lie on a decline or flat bench and grab the edge of it behind your head with both hands. \r\n2. Swing your feet upward until your body is almost vertical (your shoulder blades will stay planted on the bench).\r\n3. Slowly lower your feet under control until they are just above the bench, or as far as you can to start. \r\n4. Lift your legs back up in the air again to complete a rep.  ",
      "video_tips": "        ",
      "pro_tips": " Work with a declined bench in the beginning.\r\nAvoid a hollow back.\r\nThe key is to work it slowly. Incorporate Leg Raises and do all progressions properly.\r\n    ",
      "video_tips_html": "",
      "pro_tips_html": "",
      "range_of_motion_html": "",
      "is_static": "1",
      "musclegroup_string": "Triceps, Core",
      "scores": {
        "1": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "2": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "3": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "4": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "5": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "6": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "7": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "8": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "9": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "10": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        }
      }
    },
    {
      "id": "27",
      "name": "Negative Dragon Flag",
      "description": "Let's work on core and torso to build a serious midsection",
      "category": "3",
      "type": "2",
      "muscle_groups": "6",
      "rewards": "7.00",
      "repititions": "10",
      "duration": "10",
      "unit": "times",
      "equipment": "",
      "range_of_motion": " 1. Lie on a decline or flat bench and grab the edge of it behind your head with both hands. \r\n2. Swing your feet upward until your body is almost vertical (your shoulder blades will stay planted on the bench).\r\n3. Slowly lower your feet under control until starting position. \r\n4. Lift your legs back up in the air again and repeat the movement.  ",
      "video_tips": "          ",
      "pro_tips": " Try with one leg if to difficult with instead of both in the beginning.\r\nAnother good variation are straddled legs.\r\n     ",
      "video_tips_html": "",
      "pro_tips_html": "",
      "range_of_motion_html": "",
      "is_static": "1",
      "musclegroup_string": "Core",
      "scores": {
        "1": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "2": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "3": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "4": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "5": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "6": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "7": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "8": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "9": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "10": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        }
      }
    },
    {
      "id": "28",
      "name": "Bend Knee DF",
      "description": "Find your balance and get ripped while progressing",
      "category": "2",
      "type": "2",
      "muscle_groups": "6",
      "rewards": "7.00",
      "repititions": "10",
      "duration": "10",
      "unit": "times",
      "equipment": "",
      "range_of_motion": " 1. Lie on a decline or flat bench and grab the edge of it behind your head with both hands. \r\n2. Swing your feet upward until your body is almost vertical (your shoulder blades will stay planted on the bench).\r\n3. Slowly lower bend legs as far as you can go. \r\n4. Lift your bend legs back up in the air again to complete a rep.  ",
      "video_tips": "          ",
      "pro_tips": " Stay in the static postion as you progress and hold your max to build more strength.\r\n     ",
      "video_tips_html": "",
      "pro_tips_html": "",
      "range_of_motion_html": "",
      "is_static": "1",
      "musclegroup_string": "Core",
      "scores": {
        "1": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "2": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "3": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "4": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "5": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "6": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "7": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "8": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "9": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "10": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        }
      }
    },
    {
      "id": "29",
      "name": "Tucked DF",
      "description": "Develop your core strength on the path to the hardest core exercise in history",
      "category": "1",
      "type": "2",
      "muscle_groups": "6",
      "rewards": "6.00",
      "repititions": "10",
      "duration": "10",
      "unit": "times",
      "equipment": "",
      "range_of_motion": " 1. Lie on a decline or flat bench and grab the edge of it behind your head with both hands. \r\n2. Tuck your knees to your chest.\r\n3. Slowly try to extend to bend legs and hold position as long as you can \r\n4. Repeat movement. ",
      "video_tips": "          ",
      "pro_tips": " Work it slowly and controlled.\r\nFocus to engage your core and lower back in all progressions. ",
      "video_tips_html": "",
      "pro_tips_html": "",
      "range_of_motion_html": "",
      "is_static": "0",
      "musclegroup_string": "Core",
      "scores": {
        "1": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "2": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "3": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "4": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "5": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "6": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "7": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "8": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "9": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "10": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        }
      }
    },
    {
      "id": "30",
      "name": "Burpee Squat Jumps",
      "description": "Master an elite cardio and plymetric exercise",
      "category": "3",
      "type": "1",
      "muscle_groups": "8",
      "rewards": "9.00",
      "repititions": "10",
      "duration": "10",
      "unit": "times",
      "equipment": "",
      "range_of_motion": "1. Start in a standing position\r\n2. Go down and bring your body down to the floor\r\n3. Get up and do a high jump with the knees to your chest",
      "video_tips": "    ",
      "pro_tips": "Avoid a hollow back during the movement. \r\nKeep the core and lower back engaged at all times.",
      "video_tips_html": "",
      "pro_tips_html": "",
      "range_of_motion_html": "",
      "is_static": "0",
      "musclegroup_string": "Full Body",
      "scores": {
        "1": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "2": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "3": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "4": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "5": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "6": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "7": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "8": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "9": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "10": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        }
      }
    },
    {
      "id": "31",
      "name": "Burpee",
      "description": "Test your fitness with the original burpee",
      "category": "2",
      "type": "1",
      "muscle_groups": "8",
      "rewards": "7.00",
      "repititions": "10",
      "duration": "10",
      "unit": "times",
      "equipment": "",
      "range_of_motion": "1. Start in a standing position\r\n2. Go down and bring your body down to the floor\r\n3. Jump back up with your hands behind your head",
      "video_tips": "    ",
      "pro_tips": "Avoid a hollow back during the movement. \r\nKeep the core and lower back engaged at all times.",
      "video_tips_html": "",
      "pro_tips_html": "",
      "range_of_motion_html": "",
      "is_static": "0",
      "musclegroup_string": "Full Body",
      "scores": {
        "1": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "2": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "3": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "4": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "5": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "6": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "7": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "8": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "9": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "10": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        }
      }
    },
    {
      "id": "32",
      "name": "Sprawl",
      "description": "Boost your cardio and strength with sprawls",
      "category": "1",
      "type": "1",
      "muscle_groups": "8",
      "rewards": "6.00",
      "repititions": "10",
      "duration": "10",
      "unit": "times",
      "equipment": "",
      "range_of_motion": "1. Start in a standing position\r\n2. Go into a straight arm plank position\r\n3. Go back up and jump with your hands above your head",
      "video_tips": "    ",
      "pro_tips": "Avoid a hollow back during the movement. \r\nKeep the core and lower back engaged at all times.",
      "video_tips_html": "",
      "pro_tips_html": "",
      "range_of_motion_html": "",
      "is_static": "0",
      "musclegroup_string": "Full Body",
      "scores": {
        "1": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "2": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [
            {
              "id": "839",
              "user_id": "100",
              "exercise_id": "32",
              "status": "1",
              "time": "60",
              "is_starred": "0",
              "volume": "10",
              "feed_id": "1444",
              "sets": "2",
              "created_at": "2016-07-19 06:25:34",
              "updated_at": "2016-07-19 06:25:34"
            }
          ],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "3": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "4": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "5": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "6": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "7": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "8": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "9": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "10": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        }
      }
    },
    {
      "id": "33",
      "name": "Pistol Jumps",
      "description": "Challenge yourself on balance, strength and coordination",
      "category": "3",
      "type": "2",
      "muscle_groups": "7",
      "rewards": "9.00",
      "repititions": "10",
      "duration": "10",
      "unit": "times",
      "equipment": "",
      "range_of_motion": "1. Start from a standing position\r\n2. Go down in a single leg squat with one leg extended\r\n3. Keep your hands in front of you and jump back up",
      "video_tips": "    ",
      "pro_tips": "Try an advanced movement flow and jump right into the next pistol instead of stopping in the starting position.    ",
      "video_tips_html": "",
      "pro_tips_html": "",
      "range_of_motion_html": "",
      "is_static": "0",
      "musclegroup_string": "Legs",
      "scores": {
        "1": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "2": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "3": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "4": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "5": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "6": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "7": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "8": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "9": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "10": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        }
      }
    },
    {
      "id": "34",
      "name": "One Leg Squat Jumps",
      "description": "Build plyometric strength in your legs",
      "category": "3",
      "type": "2",
      "muscle_groups": "7",
      "rewards": "7.00",
      "repititions": "10",
      "duration": "10",
      "unit": "times",
      "equipment": "",
      "range_of_motion": "1. Start from a standing position\r\n2. Go down in a single leg squat with the other leg bend\r\n3. Keep your hands in front of you and jump back up",
      "video_tips": "      ",
      "pro_tips": "Fight for height on each repetition.\r\n   ",
      "video_tips_html": "",
      "pro_tips_html": "",
      "range_of_motion_html": "",
      "is_static": "0",
      "musclegroup_string": "Legs",
      "scores": {
        "1": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "2": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "3": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "4": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "5": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "6": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "7": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "8": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "9": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "10": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        }
      }
    },
    {
      "id": "35",
      "name": "Squat Jumps",
      "description": "Get your  heart pumping and strengthen your legs and glutes",
      "category": "2",
      "type": "2",
      "muscle_groups": "7",
      "rewards": "7.00",
      "repititions": "10",
      "duration": "10",
      "unit": "times",
      "equipment": "",
      "range_of_motion": "1. Start from a standing position\r\n2. Start by doing a regular squat, then engage your core\r\n3. Jump up explosively and land softly, repeat.",
      "video_tips": "    ",
      "pro_tips": "Ensure that you avoid allowing the chest to tip over.\r\n  ",
      "video_tips_html": "",
      "pro_tips_html": "",
      "range_of_motion_html": "",
      "is_static": "0",
      "musclegroup_string": "Legs",
      "scores": {
        "1": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "2": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "3": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "4": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "5": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "6": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "7": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "8": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "9": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "10": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        }
      }
    },
    {
      "id": "36",
      "name": "High Jumps",
      "description": "Do high jumps as a part of restless HIIT workouts",
      "category": "1",
      "type": "2",
      "muscle_groups": "7",
      "rewards": "6.00",
      "repititions": "10",
      "duration": "10",
      "unit": "times",
      "equipment": "",
      "range_of_motion": "1. Start from a standing position\r\n2. Jump up and bring your knees to your chest",
      "video_tips": "    ",
      "pro_tips": "Land softly and exhale when the knees are up.\r\n  ",
      "video_tips_html": "",
      "pro_tips_html": "",
      "range_of_motion_html": "",
      "is_static": "0",
      "musclegroup_string": "Legs",
      "scores": {
        "1": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "2": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "3": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "4": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "5": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "6": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "7": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "8": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "9": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "10": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        }
      }
    },
    {
      "id": "37",
      "name": "Iron Mike",
      "description": "Build plyometric leg power",
      "category": "3",
      "type": "2",
      "muscle_groups": "7",
      "rewards": "9.00",
      "repititions": "10",
      "duration": "10",
      "unit": "times",
      "equipment": "",
      "range_of_motion": "1. Start from a lunge position\r\n2. Go down in the lunge\r\n3. Jump up from a lunge and alternate stance\r\n4. Repeat",
      "video_tips": "    ",
      "pro_tips": "Avoid using your upper body to push off of your leg as you return to the standing position.",
      "video_tips_html": "",
      "pro_tips_html": "",
      "range_of_motion_html": "",
      "is_static": "0",
      "musclegroup_string": "Legs",
      "scores": {
        "1": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "2": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "3": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "4": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "5": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "6": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "7": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "8": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "9": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "10": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        }
      }
    },
    {
      "id": "38",
      "name": "Lunge",
      "description": "Work on your posture and get shapely toned legs",
      "category": "2",
      "type": "2",
      "muscle_groups": "7",
      "rewards": "7.00",
      "repititions": "10",
      "duration": "10",
      "unit": "times",
      "equipment": "",
      "range_of_motion": "1. Start in a lunge position\r\n2. Go down in the lunge\r\n3. Press up and switch legs\r\n4. Repeat",
      "video_tips": "    ",
      "pro_tips": "Go slow and steady, concentrating on the muscles being engaged included all of those tiny stabilizing muscles that are helping you keep your balance.\r\n  ",
      "video_tips_html": "",
      "pro_tips_html": "",
      "range_of_motion_html": "",
      "is_static": "0",
      "musclegroup_string": "Legs",
      "scores": {
        "1": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "2": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "3": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "4": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "5": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "6": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "7": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "8": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "9": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "10": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        }
      }
    },
    {
      "id": "39",
      "name": "Climbers",
      "description": "Increase your energy, health and endurance",
      "category": "1",
      "type": "2",
      "muscle_groups": "7",
      "rewards": "6.00",
      "repititions": "10",
      "duration": "10",
      "unit": "times",
      "equipment": "",
      "range_of_motion": "1. Start in pushup position\r\n2. Alternate your legs up to hand level\r\n3. Repeat",
      "video_tips": "    ",
      "pro_tips": "If you are new to mountain climbers perform the knee to chest motion slow and steadily then build it up to a faster pace for a better cardio effect.    ",
      "video_tips_html": "",
      "pro_tips_html": "",
      "range_of_motion_html": "",
      "is_static": "0",
      "musclegroup_string": "Legs",
      "scores": {
        "1": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "2": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "3": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "4": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "5": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "6": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "7": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "8": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "9": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "10": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        }
      }
    },
    {
      "id": "40",
      "name": "Shrimp Squats",
      "description": "Master body balance, gain control and pure leg power",
      "category": "3",
      "type": "2",
      "muscle_groups": "7",
      "rewards": "9.00",
      "repititions": "10",
      "duration": "10",
      "unit": "times",
      "equipment": "",
      "range_of_motion": "1. Start from a standing position\r\n2. Go down in a squat holding one leg \r\n3. Keep the other hand in front of you and press your body up again",
      "video_tips": "    ",
      "pro_tips": "Avoid letting your knees track past your toes and not rounding your back in order to keep your balance.",
      "video_tips_html": "",
      "pro_tips_html": "",
      "range_of_motion_html": "",
      "is_static": "0",
      "musclegroup_string": "Legs",
      "scores": {
        "1": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "2": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "3": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "4": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "5": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "6": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "7": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "8": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "9": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "10": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        }
      }
    },
    {
      "id": "41",
      "name": "Bulgarian Lunge",
      "description": "Start to get more balance and leg strength",
      "category": "2",
      "type": "2",
      "muscle_groups": "7",
      "rewards": "7.00",
      "repititions": "10",
      "duration": "10",
      "unit": "times",
      "equipment": "",
      "range_of_motion": "1. Start from a standing position with one leg on a chair or bench\r\n2. Go down in a single leg squat \r\n3. Press your body and repeat",
      "video_tips": "    ",
      "pro_tips": "Avoid letting your knees track past your toes and not rounding your back in order to keep your balance.    ",
      "video_tips_html": "",
      "pro_tips_html": "",
      "range_of_motion_html": "",
      "is_static": "0",
      "musclegroup_string": "Legs",
      "scores": {
        "1": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "2": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "3": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "4": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "5": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "6": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "7": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "8": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "9": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "10": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        }
      }
    },
    {
      "id": "42",
      "name": "Single Leg Deadlift",
      "description": "Get your hips mobile and control your balance",
      "category": "1",
      "type": "2",
      "muscle_groups": "7",
      "rewards": "6.00",
      "repititions": "10",
      "duration": "10",
      "unit": "times",
      "equipment": "",
      "range_of_motion": "1. Start from a standing position\r\n2. Keeping that knee slightly bent, perform a stiff-legged deadlift by bending at the hip.\r\n3. Continue lowering yourself until your upper body is parallel to the ground, and then return to the upright position. \r\n4. Repeat for the desired number of repetitions.",
      "video_tips": "    ",
      "pro_tips": "Avoid bending your supporting leg.\r\nKeep your non-supporting leg extended behind you for balance.",
      "video_tips_html": "",
      "pro_tips_html": "",
      "range_of_motion_html": "",
      "is_static": "0",
      "musclegroup_string": "Legs",
      "scores": {
        "1": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "2": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "3": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "4": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "5": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "6": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "7": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "8": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "9": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "10": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        }
      }
    },
    {
      "id": "43",
      "name": "Pistols",
      "description": "Master the elite one leg power move",
      "category": "3",
      "type": "1",
      "muscle_groups": "7",
      "rewards": "9.00",
      "repititions": "10",
      "duration": "10",
      "unit": "times",
      "equipment": "",
      "range_of_motion": " 1. Start from a standing position\r\n2. Go down in a single leg squat with one leg extended\r\n3. Keep your hands in front of you and press yourself up again ",
      "video_tips": "      ",
      "pro_tips": " Avoid letting your knees track past your toes.\r\nFocus to straighten the non-supporting leg to get more out of pistols.     ",
      "video_tips_html": "",
      "pro_tips_html": "",
      "range_of_motion_html": "",
      "is_static": "0",
      "musclegroup_string": "Legs",
      "scores": {
        "1": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "2": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "3": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "4": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "5": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "6": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "7": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "8": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "9": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "10": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        }
      }
    },
    {
      "id": "44",
      "name": "Assisted Pistols",
      "description": "Combine flexibility, strength and grace for this exercise",
      "category": "3",
      "type": "1",
      "muscle_groups": "7",
      "rewards": "7.00",
      "repititions": "10",
      "duration": "10",
      "unit": "times",
      "equipment": "",
      "range_of_motion": " 1. Start from a standing position\r\n2. Go down in a single leg squat with one leg extended\r\n3. Support the exercise with one hand as you go down and press up ",
      "video_tips": "        ",
      "pro_tips": " Avoid letting your knees track past your toes.\r\nFocus to straighten the non-supporting leg to get more out of the exercise.\r\nWarmup and stretch your lower if you are stiff in these areas.    ",
      "video_tips_html": "",
      "pro_tips_html": "",
      "range_of_motion_html": "",
      "is_static": "0",
      "musclegroup_string": "Legs",
      "scores": {
        "1": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "2": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "3": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "4": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "5": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "6": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "7": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "8": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "9": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "10": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        }
      }
    },
    {
      "id": "45",
      "name": "Squats",
      "description": "Get strong with a world class full body compound exercise",
      "category": "2",
      "type": "1",
      "muscle_groups": "7",
      "rewards": "7.00",
      "repititions": "10",
      "duration": "10",
      "unit": "times",
      "equipment": "",
      "range_of_motion": " 1. Start from a standing position\r\n2. Go down in a squat \r\n3. Keep your hands in front of you and press yourself up ",
      "video_tips": "      ",
      "pro_tips": " Lock the knees out while squeezing the glutes to execute properly.\r\nSquat deep and hold for 1-2 secs, ass to the grass!     ",
      "video_tips_html": "",
      "pro_tips_html": "",
      "range_of_motion_html": "",
      "is_static": "0",
      "musclegroup_string": "Legs",
      "scores": {
        "1": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "2": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "3": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "4": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "5": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "6": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "7": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "8": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "9": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "10": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        }
      }
    },
    {
      "id": "46",
      "name": "Wall Sits",
      "description": "Hold the static position to build isometric strength",
      "category": "1",
      "type": "1",
      "muscle_groups": "7",
      "rewards": "6.00",
      "repititions": "10",
      "duration": "10",
      "unit": "seconds",
      "equipment": "",
      "range_of_motion": " 1. Start with standing close to a wall\r\n2. Go down in a squat with your back pressed against the wall \r\n3. Stay in a 90 angle with your squat ",
      "video_tips": "        ",
      "pro_tips": " Focus to have wall contact with your head, shoulders and lower back.\r\nTry to keep your hands to the side or on your chest while in the wall sit. ",
      "video_tips_html": "",
      "pro_tips_html": "",
      "range_of_motion_html": "",
      "is_static": "0",
      "musclegroup_string": "Legs",
      "scores": {
        "1": {
          "5": [],
          "10": [],
          "15": [],
          "20": [],
          "30": [],
          "45": [],
          "60": [],
          "90": [],
          "120": [],
          "max": []
        },
        "2": {
          "5": [],
          "10": [],
          "15": [],
          "20": [],
          "30": [],
          "45": [],
          "60": [],
          "90": [],
          "120": [],
          "max": []
        },
        "3": {
          "5": [],
          "10": [],
          "15": [],
          "20": [],
          "30": [],
          "45": [],
          "60": [],
          "90": [],
          "120": [],
          "max": []
        },
        "4": {
          "5": [],
          "10": [],
          "15": [],
          "20": [],
          "30": [],
          "45": [],
          "60": [],
          "90": [],
          "120": [],
          "max": []
        },
        "5": {
          "5": [],
          "10": [],
          "15": [],
          "20": [],
          "30": [],
          "45": [],
          "60": [],
          "90": [],
          "120": [],
          "max": []
        },
        "6": {
          "5": [],
          "10": [],
          "15": [],
          "20": [],
          "30": [],
          "45": [],
          "60": [],
          "90": [],
          "120": [],
          "max": []
        },
        "7": {
          "5": [],
          "10": [],
          "15": [],
          "20": [],
          "30": [],
          "45": [],
          "60": [],
          "90": [],
          "120": [],
          "max": []
        },
        "8": {
          "5": [],
          "10": [],
          "15": [],
          "20": [],
          "30": [],
          "45": [],
          "60": [],
          "90": [],
          "120": [],
          "max": []
        },
        "9": {
          "5": [],
          "10": [],
          "15": [],
          "20": [],
          "30": [],
          "45": [],
          "60": [],
          "90": [],
          "120": [],
          "max": []
        },
        "10": {
          "5": [],
          "10": [],
          "15": [],
          "20": [],
          "30": [],
          "45": [],
          "60": [],
          "90": [],
          "120": [],
          "max": []
        }
      }
    },
    {
      "id": "47",
      "name": "Elevated Dips",
      "description": "Feel the stretch and overcome your last limits to advanced dip exercises",
      "category": "2",
      "type": "2",
      "muscle_groups": "3,5",
      "rewards": "7.00",
      "repititions": "10",
      "duration": "10",
      "unit": "times",
      "equipment": "",
      "range_of_motion": " 1. Start from lying on your side\r\n2. Put one hand to your shoulder \r\n3. Press up with the other arm and hold in extension ",
      "video_tips": "        ",
      "pro_tips": " As you build strength, progress to single leg assisted dips, supporting only one leg instead of two\r\n    ",
      "video_tips_html": "",
      "pro_tips_html": "",
      "range_of_motion_html": "",
      "is_static": "0",
      "musclegroup_string": "Triceps, Arms",
      "scores": {
        "1": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "2": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "3": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "4": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "5": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "6": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "7": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "8": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "9": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "10": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        }
      }
    },
    {
      "id": "48",
      "name": "Bench Dips",
      "description": "Develop more strength as you increase resistance with your bodyweight",
      "category": "1",
      "type": "2",
      "muscle_groups": "3",
      "rewards": "7.00",
      "repititions": "10",
      "duration": "10",
      "unit": "times",
      "equipment": "",
      "range_of_motion": " 1. Sit on side of bench. \r\n2. Place hands on edge of bench. Position feet away from bench and rest heels on floor with legs straight. \r\n3. Lower your body with the feet in front of you\r\n4. Press your body up and hold in extension ",
      "video_tips": "      ",
      "pro_tips": " Don?t rush through your movements to make things easier on yourself. You will sacrifice your form, and in the end, you won?t actually get good at the skills you?re working on.\r\nThe closer you put your hands together, the tougher the bench dip becomes. ",
      "video_tips_html": "",
      "pro_tips_html": "",
      "range_of_motion_html": "",
      "is_static": "0",
      "musclegroup_string": "Triceps",
      "scores": {
        "1": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "2": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "3": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "4": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "5": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "6": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "7": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "8": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "9": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "10": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        }
      }
    },
    {
      "id": "49",
      "name": "Side Triceps",
      "description": "Start with the basics of building triceps strength",
      "category": "1",
      "type": "1",
      "muscle_groups": "3",
      "rewards": "6.00",
      "repititions": "10",
      "duration": "10",
      "unit": "times",
      "equipment": "",
      "range_of_motion": " 1. Start with the body on your side\r\n2. Put one hand on your shoulder \r\n3. Press up with the other arm and hold in extension ",
      "video_tips": "          ",
      "pro_tips": " Avoid supporting the movement with your core muscle.      ",
      "video_tips_html": "",
      "pro_tips_html": "",
      "range_of_motion_html": "",
      "is_static": "0",
      "musclegroup_string": "Triceps",
      "scores": {
        "1": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "2": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "3": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "4": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "5": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "6": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "7": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "8": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "9": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "10": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        }
      }
    },
    {
      "id": "50",
      "name": "Triceps Extensions",
      "description": "Your go-to exercise for core and triceps ",
      "category": "3",
      "type": "1",
      "muscle_groups": "3,6",
      "rewards": "9.00",
      "repititions": "10",
      "duration": "10",
      "unit": "times",
      "equipment": "",
      "range_of_motion": " 1. Grab a bar or rings and keep your body straight\r\n2. Lower your body until head is beneath bar level\r\n3. Press your body up and hold in triceps extension  ",
      "video_tips": "      ",
      "pro_tips": " Keep whole body in line and engaged throughout the exercise.\r\nThe lower the bar/rings the tougher the exercise.     ",
      "video_tips_html": "",
      "pro_tips_html": "",
      "range_of_motion_html": "",
      "is_static": "0",
      "musclegroup_string": "Triceps, Core",
      "scores": {
        "1": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "2": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "3": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "4": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "5": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "6": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "7": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "8": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "9": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "10": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        }
      }
    },
    {
      "id": "51",
      "name": "Parallettes/Ring Dips",
      "description": "Gradually test and exceed your boudaries as you build strength in your arms",
      "category": "2",
      "type": "1",
      "muscle_groups": "1,2,3,5",
      "rewards": "7.00",
      "repititions": "10",
      "duration": "10",
      "unit": "times",
      "equipment": "",
      "range_of_motion": " 1. Support your body weight in an upright position.\r\n2. Lower your body by bending at the elbows. Upper and lower arm to form a 90? angle.\r\n3. Press your body back up to the original starting position so that your arms are nearly straight but not quite locked. Repeat. ",
      "video_tips": "            ",
      "pro_tips": " Leg position can be bent or straight during the exercise. Avoid crossed legs.\r\nTo work your triceps efficiently, ensure your body is straight. \r\nLeaning over will apply emphasis to the chest muscles. ",
      "video_tips_html": "",
      "pro_tips_html": "",
      "range_of_motion_html": "",
      "is_static": "0",
      "musclegroup_string": "Shoulders, Chest, Triceps, Arms",
      "scores": {
        "1": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "2": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "3": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "4": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "5": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "6": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "7": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "8": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "9": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "10": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        }
      }
    },
    {
      "id": "52",
      "name": "Korean Dips",
      "description": "Work your arms with your whole bodyweight",
      "category": "3",
      "type": "2",
      "muscle_groups": "1,3,4",
      "rewards": "9.00",
      "repititions": "10",
      "duration": "10",
      "unit": "times",
      "equipment": "",
      "range_of_motion": " 1. Start sitting on a bar\r\n2. Lower yourself down to the front while maintaining a strong grip with both hands\r\n3. Keep upper body and core straight and engaged\r\n4. Lower yourself slowly and controlled and push back up ",
      "video_tips": "          ",
      "pro_tips": " Try descending as slow as possible as you progress.\r\n     ",
      "video_tips_html": "",
      "pro_tips_html": "",
      "range_of_motion_html": "",
      "is_static": "0",
      "musclegroup_string": "Shoulders, Triceps, Back",
      "scores": {
        "1": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "2": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "3": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "4": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "5": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "6": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "7": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "8": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "9": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "10": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        }
      }
    },
    {
      "id": "53",
      "name": "Straight Bar Dips",
      "description": "Expose yourself to more balance and body control that will help you also in many other exercises",
      "category": "2",
      "type": "2",
      "muscle_groups": "1,2,3",
      "rewards": "7.00",
      "repititions": "10",
      "duration": "10",
      "unit": "times",
      "equipment": "",
      "range_of_motion": " 1. Start lowering yourself from top position of the bar.\r\n2. Put your legs forward while descending\r\n3. Almost touch the bar with your chest and go back up again.\r\n4. Hold arms in extended position. ",
      "video_tips": "            ",
      "pro_tips": " Place your arms at shoulder width.          ",
      "video_tips_html": "",
      "pro_tips_html": "",
      "range_of_motion_html": "",
      "is_static": "0",
      "musclegroup_string": "Shoulders, Chest, Triceps",
      "scores": {
        "1": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "2": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "3": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "4": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "5": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "6": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "7": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "8": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "9": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "10": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        }
      }
    },
    {
      "id": "54",
      "name": "Toe Touches",
      "description": "Engage your whole body in this elite exercise",
      "category": "3",
      "type": "2",
      "muscle_groups": "1,4,5,6,7,8",
      "rewards": "9.00",
      "repititions": "10",
      "duration": "10",
      "unit": "times",
      "equipment": "",
      "range_of_motion": "1. Start from a deadhang position\r\n2. Bring your legs up to bar level\r\n3. Slowly return to deadhang position",
      "video_tips": "      ",
      "pro_tips": "Fight for height and touch the bar with your shin over time\r\n  ",
      "video_tips_html": "",
      "pro_tips_html": "",
      "range_of_motion_html": "",
      "is_static": "0",
      "musclegroup_string": "Shoulders, Back, Arms, Core, Legs, Full Body",
      "scores": {
        "1": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "2": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "3": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "4": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "5": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "6": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "7": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "8": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "9": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "10": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        }
      }
    },
    {
      "id": "55",
      "name": "L-Sit",
      "description": "Learn one of the most popular and wanted static holds in the game. At the bar, on the floor",
      "category": "2",
      "type": "2",
      "muscle_groups": "1,4,5,6,7",
      "rewards": "7.00",
      "repititions": "10",
      "duration": "10",
      "unit": "times",
      "equipment": "",
      "range_of_motion": "1. Hang from the bar \r\n2. Raise legs into an L-sit position (90 degrees)",
      "video_tips": "      ",
      "pro_tips": "Do L-Sits constantly also in your stretching routine on the floor\r\nFight for pure strength rather than momentum\r\n    \r\n   ",
      "video_tips_html": "",
      "pro_tips_html": "",
      "range_of_motion_html": "",
      "is_static": "0",
      "musclegroup_string": "Shoulders, Back, Arms, Core, Legs",
      "scores": {
        "1": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "2": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "3": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "4": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "5": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "6": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "7": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "8": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "9": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "10": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        }
      }
    },
    {
      "id": "56",
      "name": "Leg Raises",
      "description": "Fight for your hip mobility, core strength and leg flexibility",
      "category": "2",
      "type": "2",
      "muscle_groups": "4,6,7",
      "rewards": "7.00",
      "repititions": "10",
      "duration": "10",
      "unit": "times",
      "equipment": "",
      "range_of_motion": "1. Dead Hang from a pull-up bar with a grip that's comfortable and feet off the ground.  \r\n2. Raise your Legs up towards 90 degree\r\n3. Hold for a brief moment and slowly return to the starting position. \r\n4. Repeat for required repetitions. ",
      "video_tips": "      ",
      "pro_tips": "Increase the holding time to move on to the L-Sit.\r\nUse Knee Raises to always finish your set.",
      "video_tips_html": "",
      "pro_tips_html": "",
      "range_of_motion_html": "",
      "is_static": "0",
      "musclegroup_string": "Back, Core, Legs",
      "scores": {
        "1": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "2": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [
            {
              "id": "840",
              "user_id": "100",
              "exercise_id": "56",
              "status": "1",
              "time": "60",
              "is_starred": "0",
              "volume": "10",
              "feed_id": "1445",
              "sets": "2",
              "created_at": "2016-07-19 06:26:45",
              "updated_at": "2016-07-19 06:26:45"
            },
            {
              "id": "841",
              "user_id": "100",
              "exercise_id": "56",
              "status": "1",
              "time": "60",
              "is_starred": "1",
              "volume": "10",
              "feed_id": "1446",
              "sets": "2",
              "created_at": "2016-07-19 06:28:59",
              "updated_at": "2016-07-19 06:28:59"
            }
          ],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "3": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "4": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "5": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "6": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "7": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "8": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "9": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "10": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        }
      }
    },
    {
      "id": "57",
      "name": "Knee Raises",
      "description": "Develop grip and core strength and get used to slow and controlled moves",
      "category": "1",
      "type": "2",
      "muscle_groups": "4,6,7",
      "rewards": "6.00",
      "repititions": "10",
      "duration": "10",
      "unit": "times",
      "equipment": "",
      "range_of_motion": "1. Start from a deadhang position with your arms and legs fully extended, and feet off the ground.  \r\n2. Raise your knees up towards your chest as high as possible. \r\n3. Hold for a brief moment and slowly return to the starting position. \r\n4. Repeat for required repetitions. ",
      "video_tips": "    ",
      "pro_tips": "Avoid using momentum or swinging during the exercise. \r\nPerform the knee raise slowly and controlled.",
      "video_tips_html": "",
      "pro_tips_html": "",
      "range_of_motion_html": "",
      "is_static": "0",
      "musclegroup_string": "Back, Core, Legs",
      "scores": {
        "1": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "2": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "3": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "4": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "5": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "6": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "7": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "8": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "9": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "10": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        }
      }
    },
    {
      "id": "58",
      "name": "Pullover",
      "description": "Master the pullover to start with the coolest combos at the bar",
      "category": "3",
      "type": "2",
      "muscle_groups": "5,6,8",
      "rewards": "9.00",
      "repititions": "10",
      "duration": "10",
      "unit": "times",
      "equipment": "",
      "range_of_motion": " 1. Stand facing the bar and grip it with both hands in an overhand grip. Starting Position: retracted Deadhang\r\n2. Pull the body up toward the bar\r\n3. During the pull-up, begin to move the legs and hips up and over the bar.\r\n4. Continue moving around the bar and finish the exercise with the body in a front support position ",
      "video_tips": "        ",
      "pro_tips": " To challenge yourself, use each postion to do a static hold of other elite skills as you go around\r\nKeep legs straight and together throughout the movement\r\n    ",
      "video_tips_html": "",
      "pro_tips_html": "",
      "range_of_motion_html": "",
      "is_static": "0",
      "musclegroup_string": "Arms, Core, Full Body",
      "scores": {
        "1": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "2": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "3": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "4": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "5": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "6": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "7": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "8": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "9": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "10": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        }
      }
    },
    {
      "id": "59",
      "name": "Head Banger Pull-ups",
      "description": "Get comfortable to full body control at the bar",
      "category": "3",
      "type": "2",
      "muscle_groups": "1,5,6",
      "rewards": "7.00",
      "repititions": "10",
      "duration": "10",
      "unit": "times",
      "equipment": "",
      "range_of_motion": " 1. Grip the bar with both hands in an underhand grip.\r\n2. Bring your chin to bar level \r\n3. Extend your arms and push your body away from the bar\r\n4. Get back to chin to the bar position ",
      "video_tips": "            ",
      "pro_tips": " You might want to try this with different grip widths and forms.\r\nAs you move away from the bar simultaneously move your legs in the opposite direction to counter-balance effectively.\r\n      ",
      "video_tips_html": "",
      "pro_tips_html": "",
      "range_of_motion_html": "",
      "is_static": "0",
      "musclegroup_string": "Shoulders, Arms, Core",
      "scores": {
        "1": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "2": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "3": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "4": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "5": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "6": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "7": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "8": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "9": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "10": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        }
      }
    },
    {
      "id": "60",
      "name": "Back Lever",
      "description": "Gain ultimate core power with this elite exercise.",
      "category": "3",
      "type": "2",
      "muscle_groups": "4,5,6",
      "rewards": "9.00",
      "repititions": "10",
      "duration": "10",
      "unit": "times",
      "equipment": "",
      "range_of_motion": " 1. Raise your legs up so that you're hanging upside down (inverted hang). \r\n2. Lower the body, leading from the toes down to a horizontal hold, parallel to the ground. \r\n3. Hold this position.\r\n4. Raise the legs back to the starting inverted hang position. ",
      "video_tips": "          ",
      "pro_tips": " To challenge yourself go into the back lever from a tucked knees position. ",
      "video_tips_html": "",
      "pro_tips_html": "",
      "range_of_motion_html": "",
      "is_static": "1",
      "musclegroup_string": "Back, Arms, Core",
      "scores": {
        "1": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "2": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "3": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "4": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "5": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "6": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "7": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "8": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "9": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "10": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        }
      }
    },
    {
      "id": "61",
      "name": "Half Back Lever",
      "description": "Experience to overcome limits as you progress and push through",
      "category": "3",
      "type": "2",
      "muscle_groups": "4,5,6",
      "rewards": "7.00",
      "repititions": "10",
      "duration": "10",
      "unit": "times",
      "equipment": "",
      "range_of_motion": " 1. Hands a little more than shoulder width apart\r\n2. Raise knees to chest\r\n3. Go into a horizontal postion and both legs out with knees bend\r\n4. Hold postion as long as you can ",
      "video_tips": "            ",
      "pro_tips": " Two alternatives for doing this exercise:\r\n1) Start from inverted hang and lower yourself over time.\r\n2) Try the same movement with straddled legs ",
      "video_tips_html": "",
      "pro_tips_html": "",
      "range_of_motion_html": "",
      "is_static": "1",
      "musclegroup_string": "Back, Arms, Core",
      "scores": {
        "1": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "2": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "3": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "4": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "5": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "6": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "7": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "8": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "9": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "10": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        }
      }
    },
    {
      "id": "62",
      "name": "One Leg Back Lever",
      "description": "Learn maintaining aestetics while progressing with your static hold",
      "category": "2",
      "type": "2",
      "muscle_groups": "4,5,6",
      "rewards": "7.00",
      "repititions": "10",
      "duration": "10",
      "unit": "times",
      "equipment": "",
      "range_of_motion": " 1. Hands a little more than shoulder width apart\r\n2. Raise knees to chest\r\n3. Go into a horizontal postion and slowly kick one leg out\r\n4. Hold postion as long as you can and alternate legs ",
      "video_tips": "            ",
      "pro_tips": " Fight for a straight back and keep your neck in a neutral position.           ",
      "video_tips_html": "",
      "pro_tips_html": "",
      "range_of_motion_html": "",
      "is_static": "1",
      "musclegroup_string": "Back, Arms, Core",
      "scores": {
        "1": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "2": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "3": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "4": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "5": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "6": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "7": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "8": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "9": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "10": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        }
      }
    },
    {
      "id": "63",
      "name": "Tuck Back Lever",
      "description": "Use your grip and body strength to get familiar holding yourself controlled above the floor",
      "category": "2",
      "type": "2",
      "muscle_groups": "4,5,6",
      "rewards": "7.00",
      "repititions": "10",
      "duration": "10",
      "unit": "times",
      "equipment": "",
      "range_of_motion": " 1. Hands a little more than shoulder width apart\r\n2. Raise knees to chest\r\n3. Go into an upside down horizontal postion with tucked knees\r\n4. Hold postion as long as you can ",
      "video_tips": "              ",
      "pro_tips": " Keep the body tight with muscles engaged at all times.\r\nAim for 30 seconds in your static hold. ",
      "video_tips_html": "",
      "pro_tips_html": "",
      "range_of_motion_html": "",
      "is_static": "1",
      "musclegroup_string": "Back, Arms, Core",
      "scores": {
        "1": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "2": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "3": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "4": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "5": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "6": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "7": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "8": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "9": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "10": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        }
      }
    },
    {
      "id": "64",
      "name": "Skin the cat",
      "description": "Develop your joints mobility and expose yourself to new movement layers",
      "category": "1",
      "type": "2",
      "muscle_groups": "4,5,6",
      "rewards": "6.00",
      "repititions": "10",
      "duration": "10",
      "unit": "times",
      "equipment": "",
      "range_of_motion": " 1. Hands a little more than shoulder width apart\r\n2. Raise your knees to the chest\r\n3. continuing the movement until the feet pass up through the arms and over head into an inverted hang position.\r\n4. Continue to pass the feet round and down toward the ground into the extended 'skin the cat' position.\r\n5. Lift your hips and raise the legs back and over to the starting hang position. ",
      "video_tips": "        ",
      "pro_tips": " Put your hands closer together to ease up all back lever progressions.\r\nDo only half of the movement in the beginning, but fight for completion over time.\r\nIncorporate other static elements to challenge yourself during the movement as you master other skills.\r\n    ",
      "video_tips_html": "",
      "pro_tips_html": "",
      "range_of_motion_html": "",
      "is_static": "0",
      "musclegroup_string": "Back, Arms, Core",
      "scores": {
        "1": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "2": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "3": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "4": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "5": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "6": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "7": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "8": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "9": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "10": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        }
      }
    },
    {
      "id": "65",
      "name": "Muscleups",
      "description": "Engage in the most popular calisthenics exercise",
      "category": "3",
      "type": "1",
      "muscle_groups": "1,3,5,8",
      "rewards": "9.00",
      "repititions": "10",
      "duration": "10",
      "unit": "times",
      "equipment": "",
      "range_of_motion": " 1. Start from a retracted deadhang position\r\n2. Legs in front of you, don't swing\r\n3. Keep neck in neutral position at all times\r\n4. Explosive Pullup\r\n5. Move wrists at the bar and straight bar dip\r\n6. Go back into starting position in controlled manner ",
      "video_tips": "      ",
      "pro_tips": " You may find it easier to start with a flexband to support you making the transition.?\r\nChallenge yourself and try the same with rings.\r\nWork with the false grip when you are stuck at the transistion spot. ",
      "video_tips_html": "",
      "pro_tips_html": "",
      "range_of_motion_html": "",
      "is_static": "0",
      "musclegroup_string": "Shoulders, Triceps, Arms, Full Body",
      "scores": {
        "1": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "2": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "3": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "4": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "5": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "6": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "7": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "8": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "9": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "10": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        }
      }
    },
    {
      "id": "66",
      "name": "Explosive Pullups",
      "description": "Build explosiveness in order to build the strength and muscle memory to go the final step",
      "category": "3",
      "type": "1",
      "muscle_groups": "1,5",
      "rewards": "7.00",
      "repititions": "10",
      "duration": "10",
      "unit": "times",
      "equipment": "",
      "range_of_motion": "  1. Start from a retracted deadhang position\r\n2. Legs in front of you, don't swing\r\n3. Explosive Pull up till chest is at bar level\r\n4. Go down controlled  ",
      "video_tips": "          ",
      "pro_tips": "You may find it easier with the kick but do them strict as you progress.\nFight for height. Use a resistance band if needed to build explosive power.  ",
      "video_tips_html": "",
      "pro_tips_html": "",
      "range_of_motion_html": "",
      "is_static": "0",
      "musclegroup_string": "Shoulders, Arms",
      "scores": {
        "1": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "2": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "3": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "4": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "5": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "6": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "7": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "8": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "9": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "10": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        }
      }
    },
    {
      "id": "67",
      "name": "Pullups/Chinups",
      "description": "Experience the beauty of strict pullups to build insane upper body strength",
      "category": "2",
      "type": "1",
      "muscle_groups": "1,5",
      "rewards": "7.00",
      "repititions": "10",
      "duration": "10",
      "unit": "times",
      "equipment": "",
      "range_of_motion": " 1. Start from a retracted deadhang position\r\n2. Legs are in line with your body, don't swing\r\n3. Pull up till chin is above the bar\r\n4. Pause at the top of the exercise and then lower back down under control. \r\n5. Return to the starting position and repeat. ",
      "video_tips": "      ",
      "pro_tips": "You might switch grips to build all muscles simultaneously. Try close and wide grips. \nDo underhand chinups and overhand pullups.\nYou want to go up fast but slowly and controlled into the deadhang.\nDo weighted pullups and chinups when you are more advanced (5kg,8kg,10kg) ",
      "video_tips_html": "",
      "pro_tips_html": "",
      "range_of_motion_html": "",
      "is_static": "0",
      "musclegroup_string": "Shoulders, Arms",
      "scores": {
        "1": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "2": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "3": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "4": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "5": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "6": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "7": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "8": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "9": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "10": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        }
      }
    },
    {
      "id": "68",
      "name": "Supported Pullups",
      "description": "Develop your back strength with slow, controlled and strict movements",
      "category": "2",
      "type": "1",
      "muscle_groups": "1,5",
      "rewards": "7.00",
      "repititions": "10",
      "duration": "10",
      "unit": "times",
      "equipment": "",
      "range_of_motion": " 1. Start from a retracted deadhang position\r\n2. Keep neck in neutral position at all times\r\n3. Pull up till chin is above the bar\r\n4. Go down controlled ",
      "video_tips": "            ",
      "pro_tips": "Use a partner, bench or resistance bands to help you during the exercise.\n      ",
      "video_tips_html": "",
      "pro_tips_html": "",
      "range_of_motion_html": "",
      "is_static": "0",
      "musclegroup_string": "Shoulders, Arms",
      "scores": {
        "1": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "2": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "3": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "4": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "5": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "6": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "7": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "8": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "9": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "10": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        }
      }
    },
    {
      "id": "69",
      "name": "Jumping Pullups",
      "description": "Expose yourself to packed shoulders and hang time",
      "category": "1",
      "type": "1",
      "muscle_groups": "1,5",
      "rewards": "6.00",
      "repititions": "10",
      "duration": "10",
      "unit": "times",
      "equipment": "",
      "range_of_motion": " 1. Grip a bar and jump into the top position of the pull-up exercise\r\n2. Straight legs in front of you. \r\n3. Slowly go down into a deadhang position ",
      "video_tips": "        ",
      "pro_tips": " A deadhang postion requires your shoulder blades down and towards the spine with arms being straight (retraction)\r\nAim for three second holds at the top and go down slowly ",
      "video_tips_html": "",
      "pro_tips_html": "",
      "range_of_motion_html": "",
      "is_static": "0",
      "musclegroup_string": "Shoulders, Arms",
      "scores": {
        "1": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "2": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "3": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "4": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "5": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "6": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "7": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "8": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "9": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "10": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        }
      }
    },
    {
      "id": "70",
      "name": "Human Flag",
      "description": "Master full body control and core power",
      "category": "3",
      "type": "2",
      "muscle_groups": "1,5,6",
      "rewards": "9.00",
      "repititions": "10",
      "duration": "10",
      "unit": "times",
      "equipment": "",
      "range_of_motion": " 1. Establish the grip and set the hands in position, ensuring that they're in a straight line and perpendicular to the ground.\r\n2. With the body in position and in a straight line, first lift the outside leg off the ground. This will help maintain your alignment and make the coming press into the flag a little easier to execute.\r\n3. Press with as much force as possible with the lower arm and bring the legs together, raising the body to horizontal. ",
      "video_tips": "          ",
      "pro_tips": " Aim to turn your body fully out for a perfect form.\r\nStraighten your hip and align with body.\r\n     ",
      "video_tips_html": "",
      "pro_tips_html": "",
      "range_of_motion_html": "",
      "is_static": "1",
      "musclegroup_string": "Shoulders, Arms, Core",
      "scores": {
        "1": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "2": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "3": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "4": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "5": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "6": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "7": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "8": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "9": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "10": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        }
      }
    },
    {
      "id": "71",
      "name": "Negative Human Flag",
      "description": "Feel pure arm and body strength and get used to a static hold.",
      "category": "2",
      "type": "2",
      "muscle_groups": "1,5,6",
      "rewards": "7.00",
      "repititions": "10",
      "duration": "10",
      "unit": "times",
      "equipment": "",
      "range_of_motion": " 1. Place your hands so that palms face each other.\r\n2. Lock lower arm out for stabilization.\r\n3. Pull your body with your upper arm up and start slowly descending from high human flag posdtion\r\n      ",
      "video_tips": "              ",
      "pro_tips": "You might want to challenge yourself and stop at certain angles while descending.\n      ",
      "video_tips_html": "",
      "pro_tips_html": "",
      "range_of_motion_html": "",
      "is_static": "1",
      "musclegroup_string": "Shoulders, Arms, Core",
      "scores": {
        "1": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "2": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "3": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "4": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "5": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "6": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "7": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "8": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "9": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "10": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        }
      }
    },
    {
      "id": "72",
      "name": "High Human Flag",
      "description": "Develop the balance to use your core to get your legs up",
      "category": "2",
      "type": "2",
      "muscle_groups": "1,5,6",
      "rewards": "7.00",
      "repititions": "10",
      "duration": "10",
      "unit": "times",
      "equipment": "",
      "range_of_motion": " 1. Place your hands so that palms face each other.\r\n2. Lock lower arm out for stabilization. (Hands, elbows and shoulders are in line) \r\n3. Pull your body with your upper arm up and get your legs up vertically. ",
      "video_tips": "            ",
      "pro_tips": " Try descending as slow as possible and try to go up again as you progress.\r\nStraighten your hip and align with body. ",
      "video_tips_html": "",
      "pro_tips_html": "",
      "range_of_motion_html": "",
      "is_static": "1",
      "musclegroup_string": "Shoulders, Arms, Core",
      "scores": {
        "1": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "2": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "3": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "4": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "5": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "6": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "7": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "8": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "9": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "10": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        }
      }
    },
    {
      "id": "73",
      "name": "Tucked Human Flag",
      "description": "Start securing your anchoring point and learn to fully lock out your support",
      "category": "1",
      "type": "2",
      "muscle_groups": "1,5,6",
      "rewards": "6.00",
      "repititions": "10",
      "duration": "10",
      "unit": "times",
      "equipment": "",
      "range_of_motion": " 1. Place your hands so that palms face each other.\r\n2. Lock lower arm out for stabilization. (Hands, elbows and shoulders are in line) \r\n3. Pull your body with your upper arm up and tuck your knees to chest. ",
      "video_tips": "          ",
      "pro_tips": " If you begin to fall out of position it's important to land on your feet and let go of the anchor point to protect the shoulders.\r\nStraighten your hip and align with body.\r\nGet somebody to assist you in the beginning to stay in position. ",
      "video_tips_html": "",
      "pro_tips_html": "",
      "range_of_motion_html": "",
      "is_static": "1",
      "musclegroup_string": "Shoulders, Arms, Core",
      "scores": {
        "1": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "2": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "3": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "4": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "5": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "6": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "7": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "8": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "9": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "10": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        }
      }
    },
    {
      "id": "74",
      "name": "Front Lever",
      "description": "Master full body control and core power",
      "category": "3",
      "type": "2",
      "muscle_groups": "4,5,6",
      "rewards": "9.00",
      "repititions": "10",
      "duration": "10",
      "unit": "times",
      "equipment": "",
      "range_of_motion": " 1. Start from an inverted hang position on a pull-up bar.\r\n2. Lower the body slowly down until completely horizontal (your body facing upwards). \r\n3. Maintain the hold as long as good form will allow.\r\n    ",
      "video_tips": "        ",
      "pro_tips": "You might want to try to get into the front lever from the floor and hold as long as you can.\n    ",
      "video_tips_html": "",
      "pro_tips_html": "",
      "range_of_motion_html": "",
      "is_static": "1",
      "musclegroup_string": "Back, Arms, Core",
      "scores": {
        "1": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "2": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "3": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "4": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "5": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "6": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "7": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "8": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "9": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "10": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        }
      }
    },
    {
      "id": "75",
      "name": "Front Lever Top",
      "description": "Feel the power of slow and controlled movement",
      "category": "3",
      "type": "2",
      "muscle_groups": "4,5,6",
      "rewards": "7.00",
      "repititions": "10",
      "duration": "10",
      "unit": "times",
      "equipment": "",
      "range_of_motion": " 1. Bring the body up into an inverted hang\r\n2. Slowly release the body into the front lever position ",
      "video_tips": "              ",
      "pro_tips": " You might want to extend the hips and straddle the legs apart. The wider the legs, the easier the hold. ",
      "video_tips_html": "",
      "pro_tips_html": "",
      "range_of_motion_html": "",
      "is_static": "1",
      "musclegroup_string": "Back, Arms, Core",
      "scores": {
        "1": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "2": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "3": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "4": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "5": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "6": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "7": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "8": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "9": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "10": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        }
      }
    },
    {
      "id": "76",
      "name": "One Leg Front Lever",
      "description": "Develop your core and back strength to increase your hanging",
      "category": "2",
      "type": "2",
      "muscle_groups": "4,5,6",
      "rewards": "7.00",
      "repititions": "10",
      "duration": "10",
      "unit": "times",
      "equipment": "",
      "range_of_motion": "  1. Go into a tuck front lever position\r\n2. Keep one leg tucked into the chest while you slowly kick the other leg out. (Tippy toes forward)\r\n3. Alternate legs during the hold.?  ",
      "video_tips": "            ",
      "pro_tips": "An easier variation is to alternate legs constantly till you can't hold the position anymore.  ",
      "video_tips_html": "",
      "pro_tips_html": "",
      "range_of_motion_html": "",
      "is_static": "1",
      "musclegroup_string": "Back, Arms, Core",
      "scores": {
        "1": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "2": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "3": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "4": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "5": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "6": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "7": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "8": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "9": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "10": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        }
      }
    },
    {
      "id": "77",
      "name": "Tuck Front Lever",
      "description": "Start feeling getting control over your body at a bar or rings.",
      "category": "2",
      "type": "2",
      "muscle_groups": "1,4,5,6",
      "rewards": "6.00",
      "repititions": "10",
      "duration": "10",
      "unit": "times",
      "equipment": "",
      "range_of_motion": "  1. The arms should be around shoulder width apart. Palm of the hands facing downwards.\r\n2. Squeeze the glutes and leg muscles, bring the body in horizontal position\r\n3. Bring the legs up to the chest into a tuck position    ",
      "video_tips": "              ",
      "pro_tips": "  Challenge yourself and move from tucked knees chest to knees in front of the bar  ",
      "video_tips_html": "",
      "pro_tips_html": "",
      "range_of_motion_html": "",
      "is_static": "1",
      "musclegroup_string": "Shoulders, Back, Arms, Core",
      "scores": {
        "1": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "2": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "3": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "4": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "5": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "6": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "7": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "8": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "9": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "10": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        }
      }
    },
    {
      "id": "78",
      "name": "Australian Pullups",
      "description": "Get started with developing your grip and back strength",
      "category": "1",
      "type": "2",
      "muscle_groups": "1,4,5,6",
      "rewards": "6.00",
      "repititions": "10",
      "duration": "10",
      "unit": "times",
      "equipment": "",
      "range_of_motion": "1. Grip a bar that is suspended at around waist height, with the feet resting on the ground.\r\n2. Squeeze the shoulder blades together and pull your chest up to the bar",
      "video_tips": "    ",
      "pro_tips": "The closer the body is to horizontal the more difficult the exercise becomes.?\r\nA set of height adjustable gymnastics rings are a good alternative.\r\nKeep whole body engaged and keep your butt in line with your body.?  ",
      "video_tips_html": "",
      "pro_tips_html": "",
      "range_of_motion_html": "",
      "is_static": "0",
      "musclegroup_string": "Shoulders, Back, Arms, Core",
      "scores": {
        "1": {
          "1": [
            {
              "id": "842",
              "user_id": "100",
              "exercise_id": "78",
              "status": "1",
              "time": "5",
              "is_starred": "1",
              "volume": "1",
              "feed_id": "1447",
              "sets": "1",
              "created_at": "2016-07-20 06:48:48",
              "updated_at": "2016-07-20 06:48:48"
            }
          ],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [
            {
              "id": "862",
              "user_id": "100",
              "exercise_id": "78",
              "status": "1",
              "time": "5",
              "is_starred": "1",
              "volume": "15",
              "feed_id": "1467",
              "sets": "1",
              "created_at": "2016-07-20 06:52:33",
              "updated_at": "2016-07-20 06:52:33"
            }
          ],
          "20": [],
          "max": []
        },
        "2": {
          "1": [
            {
              "id": "843",
              "user_id": "100",
              "exercise_id": "78",
              "status": "1",
              "time": "5",
              "is_starred": "1",
              "volume": "1",
              "feed_id": "1448",
              "sets": "2",
              "created_at": "2016-07-20 06:48:57",
              "updated_at": "2016-07-20 06:48:57"
            }
          ],
          "3": [],
          "5": [
            {
              "id": "856",
              "user_id": "100",
              "exercise_id": "78",
              "status": "1",
              "time": "5",
              "is_starred": "1",
              "volume": "5",
              "feed_id": "1461",
              "sets": "2",
              "created_at": "2016-07-20 06:50:58",
              "updated_at": "2016-07-20 06:50:58"
            }
          ],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "3": {
          "1": [
            {
              "id": "844",
              "user_id": "100",
              "exercise_id": "78",
              "status": "1",
              "time": "5",
              "is_starred": "1",
              "volume": "1",
              "feed_id": "1449",
              "sets": "3",
              "created_at": "2016-07-20 06:49:01",
              "updated_at": "2016-07-20 06:49:01"
            }
          ],
          "3": [
            {
              "id": "850",
              "user_id": "100",
              "exercise_id": "78",
              "status": "1",
              "time": "5",
              "is_starred": "1",
              "volume": "3",
              "feed_id": "1455",
              "sets": "3",
              "created_at": "2016-07-20 06:49:49",
              "updated_at": "2016-07-20 06:49:49"
            }
          ],
          "5": [
            {
              "id": "857",
              "user_id": "100",
              "exercise_id": "78",
              "status": "1",
              "time": "5",
              "is_starred": "1",
              "volume": "5",
              "feed_id": "1462",
              "sets": "3",
              "created_at": "2016-07-20 06:51:02",
              "updated_at": "2016-07-20 06:51:02"
            }
          ],
          "8": [],
          "10": [],
          "12": [],
          "15": [
            {
              "id": "863",
              "user_id": "100",
              "exercise_id": "78",
              "status": "1",
              "time": "5",
              "is_starred": "1",
              "volume": "15",
              "feed_id": "1468",
              "sets": "3",
              "created_at": "2016-07-20 06:52:37",
              "updated_at": "2016-07-20 06:52:37"
            }
          ],
          "20": [],
          "max": []
        },
        "4": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "5": {
          "1": [
            {
              "id": "845",
              "user_id": "100",
              "exercise_id": "78",
              "status": "1",
              "time": "5",
              "is_starred": "1",
              "volume": "1",
              "feed_id": "1450",
              "sets": "5",
              "created_at": "2016-07-20 06:49:07",
              "updated_at": "2016-07-20 06:49:07"
            }
          ],
          "3": [
            {
              "id": "851",
              "user_id": "100",
              "exercise_id": "78",
              "status": "1",
              "time": "5",
              "is_starred": "1",
              "volume": "3",
              "feed_id": "1456",
              "sets": "5",
              "created_at": "2016-07-20 06:49:55",
              "updated_at": "2016-07-20 06:49:55"
            },
            {
              "id": "852",
              "user_id": "100",
              "exercise_id": "78",
              "status": "1",
              "time": "5",
              "is_starred": "1",
              "volume": "3",
              "feed_id": "1457",
              "sets": "5",
              "created_at": "2016-07-20 06:49:57",
              "updated_at": "2016-07-20 06:49:57"
            }
          ],
          "5": [
            {
              "id": "858",
              "user_id": "100",
              "exercise_id": "78",
              "status": "1",
              "time": "5",
              "is_starred": "1",
              "volume": "5",
              "feed_id": "1463",
              "sets": "5",
              "created_at": "2016-07-20 06:51:08",
              "updated_at": "2016-07-20 06:51:08"
            }
          ],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "6": {
          "1": [
            {
              "id": "846",
              "user_id": "100",
              "exercise_id": "78",
              "status": "1",
              "time": "5",
              "is_starred": "1",
              "volume": "1",
              "feed_id": "1451",
              "sets": "6",
              "created_at": "2016-07-20 06:49:13",
              "updated_at": "2016-07-20 06:49:13"
            }
          ],
          "3": [
            {
              "id": "853",
              "user_id": "100",
              "exercise_id": "78",
              "status": "1",
              "time": "5",
              "is_starred": "1",
              "volume": "3",
              "feed_id": "1458",
              "sets": "6",
              "created_at": "2016-07-20 06:50:05",
              "updated_at": "2016-07-20 06:50:05"
            }
          ],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "7": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "8": {
          "1": [
            {
              "id": "847",
              "user_id": "100",
              "exercise_id": "78",
              "status": "1",
              "time": "5",
              "is_starred": "1",
              "volume": "1",
              "feed_id": "1452",
              "sets": "8",
              "created_at": "2016-07-20 06:49:18",
              "updated_at": "2016-07-20 06:49:18"
            }
          ],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [
            {
              "id": "864",
              "user_id": "100",
              "exercise_id": "78",
              "status": "1",
              "time": "5",
              "is_starred": "1",
              "volume": "15",
              "feed_id": "1469",
              "sets": "8",
              "created_at": "2016-07-20 06:53:04",
              "updated_at": "2016-07-20 06:53:04"
            }
          ],
          "20": [],
          "max": [
            {
              "id": "890",
              "user_id": "100",
              "exercise_id": "78",
              "status": "1",
              "time": "5",
              "is_starred": "1",
              "volume": "max",
              "feed_id": "1497",
              "sets": "8",
              "created_at": "2016-07-27 06:33:55",
              "updated_at": "2016-07-27 06:33:55"
            }
          ]
        },
        "9": {
          "1": [
            {
              "id": "848",
              "user_id": "100",
              "exercise_id": "78",
              "status": "1",
              "time": "5",
              "is_starred": "1",
              "volume": "1",
              "feed_id": "1453",
              "sets": "9",
              "created_at": "2016-07-20 06:49:28",
              "updated_at": "2016-07-20 06:49:28"
            }
          ],
          "3": [
            {
              "id": "854",
              "user_id": "100",
              "exercise_id": "78",
              "status": "1",
              "time": "5",
              "is_starred": "1",
              "volume": "3",
              "feed_id": "1459",
              "sets": "9",
              "created_at": "2016-07-20 06:50:09",
              "updated_at": "2016-07-20 06:50:09"
            }
          ],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "10": {
          "1": [
            {
              "id": "849",
              "user_id": "100",
              "exercise_id": "78",
              "status": "1",
              "time": "5",
              "is_starred": "1",
              "volume": "1",
              "feed_id": "1454",
              "sets": "10",
              "created_at": "2016-07-20 06:49:33",
              "updated_at": "2016-07-20 06:49:33"
            }
          ],
          "3": [
            {
              "id": "855",
              "user_id": "100",
              "exercise_id": "78",
              "status": "1",
              "time": "5",
              "is_starred": "1",
              "volume": "3",
              "feed_id": "1460",
              "sets": "10",
              "created_at": "2016-07-20 06:50:14",
              "updated_at": "2016-07-20 06:50:14"
            }
          ],
          "5": [
            {
              "id": "861",
              "user_id": "100",
              "exercise_id": "78",
              "status": "1",
              "time": "5",
              "is_starred": "1",
              "volume": "5",
              "feed_id": "1466",
              "sets": "10",
              "created_at": "2016-07-20 06:52:07",
              "updated_at": "2016-07-20 06:52:07"
            }
          ],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        }
      }
    },
    {
      "id": "80",
      "name": "Jumping Jacks",
      "description": "Jumping Jacks",
      "category": "2",
      "type": "1",
      "muscle_groups": "7,8",
      "rewards": "10.00",
      "repititions": "10",
      "duration": "10",
      "unit": "times",
      "equipment": "",
      "range_of_motion": "",
      "video_tips": "",
      "pro_tips": "",
      "video_tips_html": "",
      "pro_tips_html": "",
      "range_of_motion_html": "",
      "is_static": "0",
      "musclegroup_string": "Legs, Full Body",
      "scores": {
        "1": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "2": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "3": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "4": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "5": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "6": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "7": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "8": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "9": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        },
        "10": {
          "1": [],
          "3": [],
          "5": [],
          "8": [],
          "10": [],
          "12": [],
          "15": [],
          "20": [],
          "max": []
        }
      }
    },
    {
      "id": "83",
      "name": "Jumping Jacks",
      "description": "Jumping Jacks",
      "category": "2",
      "type": "2",
      "muscle_groups": "2,3",
      "rewards": "10.00",
      "repititions": "10",
      "duration": "10",
      "unit": "seconds",
      "equipment": "",
      "range_of_motion": "",
      "video_tips": "",
      "pro_tips": "\r\nsefsdf esssedg\r\nfhfgjhfgjfgj\r\ngyjhgjgh\r\nfhfghfjh \r\n\r\nhjghjghkn fgjhnlkhj lkdflldfjh lkfghllfghlk lkfghlnfghlnl.\r\n1. fdxgdfhg dfgdfghsf fgghdfh\r\n2. gjgfj ghjygjh yjggjghj\r\n3. ghhjhk hgjkhujkj ghjkghj hgjghj\r\n",
      "video_tips_html": "",
      "pro_tips_html": "<ul>\r\n<li>sefsdf esssedg</li>\r\n<li>fhfgjhfgjfgj</li>\r\n<li>gyjhgjgh</li>\r\n<li>fhfghfjh&nbsp;</li>\r\n</ul>\r\n<p>hjghjghkn fgjhnlkhj lkdflldfjh lkfghllfghlk lkfghlnfghlnl.</p>\r\n<ol>\r\n<li>fdxgdfhg dfgdfghsf fgghdfh</li>\r\n<li>gjgfj ghjygjh yjggjghj</li>\r\n<li>ghhjhk hgjkhujkj ghjkghj hgjghj</li>\r\n</ol>",
      "range_of_motion_html": "",
      "is_static": "0",
      "musclegroup_string": "Chest, Triceps",
      "scores": {
        "1": {
          "5": [],
          "10": [],
          "15": [],
          "20": [],
          "30": [],
          "45": [],
          "60": [],
          "90": [],
          "120": [],
          "max": []
        },
        "2": {
          "5": [],
          "10": [],
          "15": [],
          "20": [],
          "30": [],
          "45": [],
          "60": [],
          "90": [],
          "120": [],
          "max": []
        },
        "3": {
          "5": [],
          "10": [],
          "15": [],
          "20": [],
          "30": [],
          "45": [],
          "60": [],
          "90": [],
          "120": [],
          "max": []
        },
        "4": {
          "5": [],
          "10": [],
          "15": [],
          "20": [],
          "30": [],
          "45": [],
          "60": [],
          "90": [],
          "120": [],
          "max": []
        },
        "5": {
          "5": [],
          "10": [],
          "15": [],
          "20": [],
          "30": [],
          "45": [],
          "60": [],
          "90": [],
          "120": [],
          "max": []
        },
        "6": {
          "5": [],
          "10": [],
          "15": [],
          "20": [],
          "30": [],
          "45": [],
          "60": [],
          "90": [],
          "120": [],
          "max": []
        },
        "7": {
          "5": [],
          "10": [],
          "15": [],
          "20": [],
          "30": [],
          "45": [],
          "60": [],
          "90": [],
          "120": [],
          "max": []
        },
        "8": {
          "5": [],
          "10": [],
          "15": [],
          "20": [],
          "30": [],
          "45": [],
          "60": [],
          "90": [],
          "120": [],
          "max": []
        },
        "9": {
          "5": [],
          "10": [],
          "15": [],
          "20": [],
          "30": [],
          "45": [],
          "60": [],
          "90": [],
          "120": [],
          "max": []
        },
        "10": {
          "5": [],
          "10": [],
          "15": [],
          "20": [],
          "30": [],
          "45": [],
          "60": [],
          "90": [],
          "120": [],
          "max": []
        }
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
    public function getUserExerciseHistory(Request $request)
    {
        if (!isset($request->user_id) || ($request->user_id == null)) {
            return response()->json(["status" => "0", "error" => "The user_id field is required"]);
        } else {

            $user = User::where('id', '=', $request->input('user_id'))->first();

            $arr1 = Array(1, 3, 5, 8, 10, 12, 15, 20, 'max');

            $arr2 = Array(5, 10, 15, 20, 30, 45, 60, 90, 120, 'max');

            if ($user) {
                $exercises = Exercise::where('name', '!=', 'Rest')->get();

                $exerciseArray = $exercises->toArray();
                foreach ($exerciseArray as $eKey => $exercise) {

                    if ($exercise['unit'] == 'seconds') {
                        $volumeArray = $arr2;
                    } else {
                        $volumeArray = $arr1;
                    }

                    $exerciseUserDet = Array();

                    for ($i = 1; $i <= 10; $i++) {
                        foreach ($volumeArray as $vKey => $volume1) {
                            $exerciseUserDet[$i][$volume1] = DB::table('exercise_users')
                                ->where('exercise_id', $exercise['id'])
                                ->where('user_id', $request->user_id)
                                ->where('volume', $volume1)
                                ->where('sets', '=', $i)
                                ->get();
                        }
                    }


                    $exerciseArray[$eKey]['scores'] = $exerciseUserDet;
                    unset($volumeArray);
                    unset($exerciseUserDet);
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
      "name": "Hel",
      "description": "",
      "rounds": "5",
      "category": "1",
      "type": "1",
      "rewards": {
        "lean": "330",
        "athletic": "440",
        "strength": "550"
      },
      "duration": "100.00",
      "equipments": "BAR/RINGS",
      "is_repsandsets": "0",
      "created_at": "2016-08-03 06:19:40",
      "progression_string": "",
      "lean": {
        "scores": {
          "1": [
            {
              "id": "70",
              "workout_id": "1",
              "user_id": "100",
              "status": "1",
              "time": "24",
              "is_starred": "0",
              "volume": "1",
              "focus": "1",
              "feed_id": "144",
              "is_coach": "0",
              "coach_rounds": "0",
              "created_at": "2016-09-02 08:33:53",
              "updated_at": "2016-09-02 08:33:53",
              "category": "1"
            }
          ],
          "2": [],
          "3": []
        }
      },
      "athletic": {
        "scores": {
          "1": [],
          "2": [],
          "3": [
            {
              "id": "11",
              "workout_id": "1",
              "user_id": "100",
              "status": "1",
              "time": "21",
              "is_starred": "0",
              "volume": "3",
              "focus": "2",
              "feed_id": "53",
              "is_coach": "0",
              "coach_rounds": "0",
              "created_at": "2016-08-30 07:28:44",
              "updated_at": "2016-08-30 07:28:44",
              "category": "1"
            }
          ]
        }
      },
      "strength": {
        "scores": {
          "1": [],
          "2": [],
          "3": []
        }
      }
    },
    {
      "id": "2",
      "name": "Vali",
      "description": "",
      "rounds": "3",
      "category": "2",
      "type": "1",
      "rewards": {
        "lean": "330",
        "athletic": "440",
        "strength": "550"
      },
      "duration": "100.00",
      "equipments": "BAR/RINGS",
      "is_repsandsets": "0",
      "created_at": "2016-08-03 06:24:47",
      "progression_string": "",
      "lean": {
        "scores": {
          "1": [],
          "2": [],
          "3": []
        }
      },
      "athletic": {
        "scores": {
          "1": [],
          "2": [],
          "3": []
        }
      },
      "strength": {
        "scores": {
          "1": [],
          "2": [],
          "3": []
        }
      }
    },
    {
      "id": "3",
      "name": "Bragi",
      "description": "",
      "rounds": "5",
      "category": "2",
      "type": "1",
      "rewards": {
        "lean": "330",
        "athletic": "440",
        "strength": "550"
      },
      "duration": "100.00",
      "equipments": "BAR/RINGS",
      "is_repsandsets": "0",
      "created_at": "2016-08-03 06:33:11",
      "progression_string": "",
      "lean": {
        "scores": {
          "1": [],
          "2": [],
          "3": []
        }
      },
      "athletic": {
        "scores": {
          "1": [],
          "2": [],
          "3": []
        }
      },
      "strength": {
        "scores": {
          "1": [],
          "2": [],
          "3": []
        }
      }
    },
    {
      "id": "4",
      "name": "Thor",
      "description": "",
      "rounds": "1",
      "category": "1",
      "type": "1",
      "rewards": {
        "lean": "330",
        "athletic": "440",
        "strength": "550"
      },
      "duration": "100.00",
      "equipments": "Bar/Rings",
      "is_repsandsets": "1",
      "created_at": "2016-08-03 06:34:38",
      "progression_string": "",
      "lean": {
        "scores": {
          "1": [],
          "2": [],
          "3": []
        }
      },
      "athletic": {
        "scores": {
          "1": [
            {
              "id": "65",
              "workout_id": "4",
              "user_id": "100",
              "status": "1",
              "time": "7",
              "is_starred": "0",
              "volume": "1",
              "focus": "2",
              "feed_id": "134",
              "is_coach": "0",
              "coach_rounds": "0",
              "created_at": "2016-09-01 11:10:03",
              "updated_at": "2016-09-01 11:10:03",
              "category": "1"
            }
          ],
          "2": [],
          "3": []
        }
      },
      "strength": {
        "scores": {
          "1": [],
          "2": [],
          "3": []
        }
      }
    },
    {
      "id": "6",
      "name": "Odin",
      "description": "",
      "rounds": "1",
      "category": "1",
      "type": "1",
      "rewards": {
        "lean": "330",
        "athletic": "440",
        "strength": "550"
      },
      "duration": "100.00",
      "equipments": "",
      "is_repsandsets": "1",
      "created_at": "2016-08-04 19:18:21",
      "progression_string": "",
      "lean": {
        "scores": {
          "1": [],
          "2": [],
          "3": []
        }
      },
      "athletic": {
        "scores": {
          "1": [],
          "2": [],
          "3": []
        }
      },
      "strength": {
        "scores": {
          "1": [],
          "2": [],
          "3": []
        }
      }
    },
    {
      "id": "7",
      "name": "Forseti",
      "description": "Forseti",
      "rounds": "6",
      "category": "2",
      "type": "2",
      "rewards": {
        "lean": "330",
        "athletic": "440",
        "strength": "550"
      },
      "duration": "100.00",
      "equipments": "Bar/Rings",
      "is_repsandsets": "0",
      "created_at": "2016-08-05 06:19:34",
      "progression_string": "",
      "lean": {
        "scores": {
          "1": [],
          "2": [],
          "3": []
        }
      },
      "athletic": {
        "scores": {
          "1": [],
          "2": [],
          "3": []
        }
      },
      "strength": {
        "scores": {
          "1": [],
          "2": [],
          "3": []
        }
      }
    },
    {
      "id": "8",
      "name": "Mimir",
      "description": "Mimir",
      "rounds": "4",
      "category": "2",
      "type": "2",
      "rewards": {
        "lean": "330",
        "athletic": "440",
        "strength": "550"
      },
      "duration": "100.00",
      "equipments": "No Equipment",
      "is_repsandsets": "0",
      "created_at": "2016-08-05 06:44:19",
      "progression_string": "",
      "lean": {
        "scores": {
          "1": [],
          "2": [],
          "3": []
        }
      },
      "athletic": {
        "scores": {
          "1": [],
          "2": [],
          "3": []
        }
      },
      "strength": {
        "scores": {
          "1": [],
          "2": [],
          "3": []
        }
      }
    },
    {
      "id": "9",
      "name": "Nerþus",
      "description": "Nerþus",
      "rounds": "4",
      "category": "2",
      "type": "2",
      "rewards": {
        "lean": "330",
        "athletic": "440",
        "strength": "550"
      },
      "duration": "100.00",
      "equipments": "Bar/Rings",
      "is_repsandsets": "0",
      "created_at": "2016-08-05 06:51:17",
      "progression_string": "",
      "lean": {
        "scores": {
          "1": [],
          "2": [],
          "3": []
        }
      },
      "athletic": {
        "scores": {
          "1": [],
          "2": [],
          "3": []
        }
      },
      "strength": {
        "scores": {
          "1": [],
          "2": [],
          "3": []
        }
      }
    },
    {
      "id": "10",
      "name": "Sif",
      "description": "Sif",
      "rounds": "3",
      "category": "1",
      "type": "2",
      "rewards": {
        "lean": "330",
        "athletic": "440",
        "strength": "550"
      },
      "duration": "100.00",
      "equipments": "No Equipment",
      "is_repsandsets": "0",
      "created_at": "2016-08-05 06:57:17",
      "progression_string": "",
      "lean": {
        "scores": {
          "1": [],
          "2": [],
          "3": []
        }
      },
      "athletic": {
        "scores": {
          "1": [
            {
              "id": "72",
              "workout_id": "10",
              "user_id": "100",
              "status": "1",
              "time": "206",
              "is_starred": "1",
              "volume": "1",
              "focus": "2",
              "feed_id": "147",
              "is_coach": "1",
              "coach_rounds": "3",
              "created_at": "2016-09-02 09:12:15",
              "updated_at": "2016-09-02 09:12:15",
              "category": "1"
            }
          ],
          "2": [],
          "3": []
        }
      },
      "strength": {
        "scores": {
          "1": [],
          "2": [],
          "3": []
        }
      }
    },
    {
      "id": "11",
      "name": "Snotra",
      "description": "Snotra",
      "rounds": "3",
      "category": "1",
      "type": "2",
      "rewards": {
        "lean": "330",
        "athletic": "440",
        "strength": "550"
      },
      "duration": "100.00",
      "equipments": "Bar/Rings",
      "is_repsandsets": "0",
      "created_at": "2016-08-05 07:19:18",
      "progression_string": "",
      "lean": {
        "scores": {
          "1": [],
          "2": [],
          "3": []
        }
      },
      "athletic": {
        "scores": {
          "1": [],
          "2": [],
          "3": []
        }
      },
      "strength": {
        "scores": {
          "1": [],
          "2": [],
          "3": []
        }
      }
    },
    {
      "id": "12",
      "name": "Loki",
      "description": "Loki",
      "rounds": "1",
      "category": "1",
      "type": "2",
      "rewards": {
        "lean": "330",
        "athletic": "440",
        "strength": "550"
      },
      "duration": "100.00",
      "equipments": "Bar/Rings",
      "is_repsandsets": "1",
      "created_at": "2016-08-05 07:28:06",
      "progression_string": "",
      "lean": {
        "scores": {
          "1": [],
          "2": [],
          "3": []
        }
      },
      "athletic": {
        "scores": {
          "1": [],
          "2": [],
          "3": []
        }
      },
      "strength": {
        "scores": {
          "1": [],
          "2": [],
          "3": []
        }
      }
    },
    {
      "id": "13",
      "name": "Baldur",
      "description": "Baldur",
      "rounds": "1",
      "category": "1",
      "type": "2",
      "rewards": {
        "lean": "330",
        "athletic": "440",
        "strength": "550"
      },
      "duration": "100.00",
      "equipments": "Bar/Rings",
      "is_repsandsets": "1",
      "created_at": "2016-08-05 07:37:24",
      "progression_string": "",
      "lean": {
        "scores": {
          "1": [],
          "2": [],
          "3": []
        }
      },
      "athletic": {
        "scores": {
          "1": [],
          "2": [],
          "3": []
        }
      },
      "strength": {
        "scores": {
          "1": [],
          "2": [],
          "3": []
        }
      }
    }
  ],
  "skill_training_history": [
    {
      "id": "1",
      "name": "Muscleups (MU)",
      "description": "",
      "rewards": {
        "lean": "330",
        "athletic": "440",
        "strength": "550"
      },
      "equipments": "",
      "is_circuit": "0",
      "created_at": "2016-08-02 10:56:33",
      "progression_string": "",
      "hero": {
        "scores": {
          "1": [
            {
              "id": "225",
              "skilltraining_id": "1",
              "user_id": "100",
              "status": "1",
              "time": "39",
              "is_starred": "1",
              "volume": "1",
              "focus": "1",
              "feed_id": "698",
              "is_coach": "0",
              "created_at": "2016-09-23 08:58:02",
              "updated_at": "2016-09-23 08:58:02"
            }
          ]
        }
      },
      "barzerker": {
        "scores": {
          "1": [
            {
              "id": "226",
              "skilltraining_id": "1",
              "user_id": "100",
              "status": "1",
              "time": "29",
              "is_starred": "1",
              "volume": "1",
              "focus": "2",
              "feed_id": "699",
              "is_coach": "0",
              "created_at": "2016-09-23 08:59:30",
              "updated_at": "2016-09-23 08:59:30"
            }
          ]
        }
      },
      "legend": {
        "scores": {
          "1": [
            {
              "id": "22",
              "skilltraining_id": "1",
              "user_id": "100",
              "status": "1",
              "time": "17",
              "is_starred": "0",
              "volume": "1",
              "focus": "3",
              "feed_id": "47",
              "is_coach": "0",
              "created_at": "2016-08-30 05:35:58",
              "updated_at": "2016-08-30 05:35:58"
            },
            {
              "id": "227",
              "skilltraining_id": "1",
              "user_id": "100",
              "status": "1",
              "time": "29",
              "is_starred": "0",
              "volume": "1",
              "focus": "3",
              "feed_id": "700",
              "is_coach": "0",
              "created_at": "2016-09-23 09:00:52",
              "updated_at": "2016-09-23 09:00:52"
            }
          ]
        }
      }
    },
    {
      "id": "2",
      "name": "Front Lever (FL)",
      "description": "",
      "rewards": {
        "lean": "330",
        "athletic": "440",
        "strength": "550"
      },
      "equipments": "Bar/Rings",
      "is_circuit": "0",
      "created_at": "2016-08-02 10:57:05",
      "progression_string": "",
      "hero": {
        "scores": {
          "1": []
        }
      },
      "barzerker": {
        "scores": {
          "1": []
        }
      },
      "legend": {
        "scores": {
          "1": []
        }
      }
    },
    {
      "id": "3",
      "name": "Back Lever (BL)",
      "description": "",
      "rewards": {
        "lean": "330",
        "athletic": "440",
        "strength": "550"
      },
      "equipments": "",
      "is_circuit": "0",
      "created_at": "2016-08-02 10:57:36",
      "progression_string": "",
      "hero": {
        "scores": {
          "1": []
        }
      },
      "barzerker": {
        "scores": {
          "1": []
        }
      },
      "legend": {
        "scores": {
          "1": []
        }
      }
    },
    {
      "id": "4",
      "name": "Triceps Extensions",
      "description": "Triceps Extensions",
      "rewards": {
        "lean": "330",
        "athletic": "440",
        "strength": "550"
      },
      "equipments": "Bar/Rings",
      "is_circuit": "0",
      "created_at": "2016-08-02 10:58:09",
      "progression_string": "",
      "hero": {
        "scores": {
          "1": []
        }
      },
      "barzerker": {
        "scores": {
          "1": []
        }
      },
      "legend": {
        "scores": {
          "1": []
        }
      }
    },
    {
      "id": "5",
      "name": "Hefesto",
      "description": "",
      "rewards": {
        "lean": "330",
        "athletic": "440",
        "strength": "550"
      },
      "equipments": "Bar",
      "is_circuit": "0",
      "created_at": "2016-08-02 10:58:36",
      "progression_string": "",
      "hero": {
        "scores": {
          "1": []
        }
      },
      "barzerker": {
        "scores": {
          "1": []
        }
      },
      "legend": {
        "scores": {
          "1": []
        }
      }
    },
    {
      "id": "6",
      "name": "Impossible Dips",
      "description": "",
      "rewards": {
        "lean": "330",
        "athletic": "440",
        "strength": "550"
      },
      "equipments": "Paralettes, Parallel Bars",
      "is_circuit": "0",
      "created_at": "2016-08-02 10:59:02",
      "progression_string": "",
      "hero": {
        "scores": {
          "1": []
        }
      },
      "barzerker": {
        "scores": {
          "1": []
        }
      },
      "legend": {
        "scores": {
          "1": []
        }
      }
    },
    {
      "id": "7",
      "name": "1- Arm Pushups",
      "description": "",
      "rewards": {
        "lean": "330",
        "athletic": "440",
        "strength": "550"
      },
      "equipments": "No Equipment",
      "is_circuit": "0",
      "created_at": "2016-08-02 11:00:24",
      "progression_string": "",
      "hero": {
        "scores": {
          "1": []
        }
      },
      "barzerker": {
        "scores": {
          "1": []
        }
      },
      "legend": {
        "scores": {
          "1": []
        }
      }
    },
    {
      "id": "8",
      "name": "Handstand Pushups",
      "description": "Handstand Pushups",
      "rewards": {
        "lean": "330",
        "athletic": "440",
        "strength": "550"
      },
      "equipments": "No Equipment",
      "is_circuit": "0",
      "created_at": "2016-08-02 11:00:49",
      "progression_string": "",
      "hero": {
        "scores": {
          "1": []
        }
      },
      "barzerker": {
        "scores": {
          "1": []
        }
      },
      "legend": {
        "scores": {
          "1": []
        }
      }
    },
    {
      "id": "9",
      "name": "Planche",
      "description": "Planche",
      "rewards": {
        "lean": "330",
        "athletic": "440",
        "strength": "550"
      },
      "equipments": "Paralettes, Parallel Bars",
      "is_circuit": "0",
      "created_at": "2016-08-02 11:02:03",
      "progression_string": "",
      "hero": {
        "scores": {
          "1": []
        }
      },
      "barzerker": {
        "scores": {
          "1": []
        }
      },
      "legend": {
        "scores": {
          "1": []
        }
      }
    },
    {
      "id": "10",
      "name": "Hollow Body Rock ",
      "description": "Hollow Body Rock",
      "rewards": {
        "lean": "330",
        "athletic": "440",
        "strength": "550"
      },
      "equipments": "No Equipment",
      "is_circuit": "0",
      "created_at": "2016-08-02 11:02:33",
      "progression_string": "",
      "hero": {
        "scores": {
          "1": []
        }
      },
      "barzerker": {
        "scores": {
          "1": [
            {
              "id": "161",
              "skilltraining_id": "10",
              "user_id": "100",
              "status": "1",
              "time": "41",
              "is_starred": "0",
              "volume": "1",
              "focus": "2",
              "feed_id": "494",
              "is_coach": "0",
              "created_at": "2016-09-19 17:26:40",
              "updated_at": "2016-09-19 17:26:40"
            }
          ]
        }
      },
      "legend": {
        "scores": {
          "1": []
        }
      }
    },
    {
      "id": "11",
      "name": "Side Plank",
      "description": "Side Plank (all Core related exercises)",
      "rewards": {
        "lean": "330",
        "athletic": "440",
        "strength": "550"
      },
      "equipments": "Bar/Rings",
      "is_circuit": "0",
      "created_at": "2016-08-02 11:02:55",
      "progression_string": "",
      "hero": {
        "scores": {
          "1": []
        }
      },
      "barzerker": {
        "scores": {
          "1": []
        }
      },
      "legend": {
        "scores": {
          "1": []
        }
      }
    },
    {
      "id": "12",
      "name": "Human Flag",
      "description": "",
      "rewards": {
        "lean": "330",
        "athletic": "440",
        "strength": "550"
      },
      "equipments": "Bar/Rings, Post, Vertical Bar",
      "is_circuit": "0",
      "created_at": "2016-08-02 11:03:23",
      "progression_string": "",
      "hero": {
        "scores": {
          "1": []
        }
      },
      "barzerker": {
        "scores": {
          "1": []
        }
      },
      "legend": {
        "scores": {
          "1": []
        }
      }
    },
    {
      "id": "13",
      "name": "Shoulder & Dragon Flag",
      "description": "",
      "rewards": {
        "lean": "330",
        "athletic": "440",
        "strength": "550"
      },
      "equipments": "Post, Vertical Bar, Bench",
      "is_circuit": "0",
      "created_at": "2016-08-02 11:04:01",
      "progression_string": "",
      "hero": {
        "scores": {
          "1": []
        }
      },
      "barzerker": {
        "scores": {
          "1": []
        }
      },
      "legend": {
        "scores": {
          "1": []
        }
      }
    },
    {
      "id": "14",
      "name": "Pullover",
      "description": "",
      "rewards": {
        "lean": "330",
        "athletic": "440",
        "strength": "550"
      },
      "equipments": "Bar/Rings",
      "is_circuit": "0",
      "created_at": "2016-08-02 11:04:38",
      "progression_string": "",
      "hero": {
        "scores": {
          "1": []
        }
      },
      "barzerker": {
        "scores": {
          "1": []
        }
      },
      "legend": {
        "scores": {
          "1": []
        }
      }
    },
    {
      "id": "15",
      "name": "Legs",
      "description": "",
      "rewards": {
        "lean": "330",
        "athletic": "440",
        "strength": "550"
      },
      "equipments": "No Equipment",
      "is_circuit": "1",
      "created_at": "2016-08-02 11:29:01",
      "progression_string": "",
      "hero": {
        "scores": {
          "1": []
        }
      },
      "barzerker": {
        "scores": {
          "1": []
        }
      },
      "legend": {
        "scores": {
          "1": []
        }
      }
    },
    {
      "id": "16",
      "name": "Double Clap Pushups",
      "description": "Double Clap Pushups",
      "rewards": {
        "lean": "330",
        "athletic": "440",
        "strength": "550"
      },
      "equipments": "No Equipment",
      "is_circuit": "0",
      "created_at": "2016-08-02 11:37:29",
      "progression_string": "",
      "hero": {
        "scores": {
          "1": []
        }
      },
      "barzerker": {
        "scores": {
          "1": []
        }
      },
      "legend": {
        "scores": {
          "1": []
        }
      }
    },
    {
      "id": "18",
      "name": "Clap Pushup Burpees",
      "description": "Clap Pushup Burpees",
      "rewards": {
        "lean": "330",
        "athletic": "440",
        "strength": "550"
      },
      "equipments": "No Equipment",
      "is_circuit": "0",
      "created_at": "2016-08-12 10:37:02",
      "progression_string": "",
      "hero": {
        "scores": {
          "1": []
        }
      },
      "barzerker": {
        "scores": {
          "1": []
        }
      },
      "legend": {
        "scores": {
          "1": []
        }
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

            if ($user) {
                $workouts = Workout::all();
                $workoutArray = $workouts->toArray();
                
                foreach ($workoutArray as $eKey => $workout) {
                    $workoutArray[$eKey]['rewards'] = json_decode($workoutArray[$eKey]['rewards'], true);

                    for ($i = 1; $i <= 3; $i++) {
                        $exerciseUserDetLean[$i] = DB::table('workout_users')
                            ->where('workout_id', $workout['id'])
                            ->where('user_id', $request->user_id)
                            ->where('volume', $i)
                            ->where('focus', 1)
                            ->get();
                    }

                    $workoutArray[$eKey]['lean']['scores'] = $exerciseUserDetLean;

                    for ($i = 1; $i <= 3; $i++) {
                        $exerciseUserDetAthletic[$i] = DB::table('workout_users')
                            ->where('workout_id', $workout['id'])
                            ->where('user_id', $request->user_id)
                            ->where('volume', $i)
                            ->where('focus', 2)
                            ->get();
                    }

                    $workoutArray[$eKey]['athletic']['scores'] = $exerciseUserDetAthletic;

                    for ($i = 1; $i <= 3; $i++) {
                        $exerciseUserDetStrength[$i] = DB::table('workout_users')
                            ->where('workout_id', $workout['id'])
                            ->where('user_id', $request->user_id)
                            ->where('volume', $i)
                            ->where('focus', 3)
                            ->get();
                    }

                    $workoutArray[$eKey]['strength']['scores'] = $exerciseUserDetStrength;
                }
                
                $skillTrainings = Skilltraining::all();
                
                $skillTrainingsArray = $skillTrainings->toArray();                
                foreach ($skillTrainingsArray as $sKey => $skillTraining) {
                    $skillTrainingsArray[$sKey]['rewards'] = json_decode($skillTrainingsArray[$sKey]['rewards'], true);
                    for ($i = 1; $i <= 1; $i++) {
                        $skillTrainingUserDetLean[$i] = DB::table('skilltraining_users')
                            ->where('skilltraining_id', $skillTraining['id'])
                            ->where('user_id', $request->user_id)
                            ->where('volume', $i)
                            ->where('focus', 1)
                            ->get();
                    }

                    $skillTrainingsArray[$sKey]['hero']['scores'] = $skillTrainingUserDetLean;

                    for ($i = 1; $i <= 1; $i++) {
                        $skillTrainingUserDetAthletic[$i] = DB::table('skilltraining_users')
                            ->where('skilltraining_id', $skillTraining['id'])
                            ->where('user_id', $request->user_id)
                            ->where('volume', $i)
                            ->where('focus', 2)
                            ->get();
                    }

                    $skillTrainingsArray[$sKey]['barzerker']['scores'] = $skillTrainingUserDetAthletic;

                    for ($i = 1; $i <= 1; $i++) {
                        $skillTrainingUserDetStrength[$i] = DB::table('skilltraining_users')
                            ->where('skilltraining_id', $skillTraining['id'])
                            ->where('user_id', $request->user_id)
                            ->where('volume', $i)
                            ->where('focus', 3)
                            ->get();
                    }

                    $skillTrainingsArray[$sKey]['legend']['scores'] = $skillTrainingUserDetStrength;
                }

                return response()->json(['status' => 1, 'success' => 'history', 'workout_history' => $workoutArray, 'skill_training_history' => $skillTrainingsArray], 200);
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
            $error = 'Code not found';
        } else {

            $user = User::whereConfirmationCode($conformationCode)->first();

            if (is_null($user)) {
                $error = 'User not found';
            } else {
                $user->status = 1;
                $user->confirmation_code = null;
                $user->save();
                return Redirect::to('/')->with('success', 'You are successfully confirmed your email. You can login to app by using your email and password.');
            }
        }
        return Redirect::to('/')->with('error', $error);
    }

    /**
     * @api {post} /user/logout Logout
     * @apiName Logout
     * @apiGroup User
     * @apiParam {integer} user_id id of loggedin user *required
     * @apiSuccess {String} success.
     * @apiSuccessExample Success-Response:
     * HTTP/1.1 200 OK
     * {
      "status": 1,
      "success": "user_successfully_logged_out"
      }
     * 
     * 
     * @apiError error Message token_invalid.
     * @apiError error Message token_expired.
     * @apiError error Message token_not_provided.
     * @apiError error Validation error.
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
     *     HTTP/1.1 422 Validation error
     *     {
     *       "status" : 0,
     *       "error": "The user_id field is required"
     *     }
     */
    public function logout(Request $request)
    {
        if (!isset($request->user_id) || ($request->user_id == null)) {
            return response()->json(["status" => "0", "error" => "The user_id field is required"]);
        } else {
            PushNotification::where('user_id', '=', $request->user_id)->delete();
            Auth::logout();
            return response()->json(['status' => 1, 'success' => 'user_successfully_logged_out'], 200);
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

            if (!is_null($user)) {
                $pullRowCount = count(Skill::where('progression_id', $request->progression_id)->groupBy('row')->get());

                $i = 1;

                do {

                    $skill = Skill::where('row', $i)->where('progression_id', $request->progression_id)->with(['exercise'])->orderBy('skills.level', 'DESC')->first();

                    $skills[] = $skill->toArray();

                    $i++;
                } while ($i <= $pullRowCount);

                $userOptions = DB::table('user_goal_options')->where('progression_id', $request->progression_id)->where('user_id', $request->user_id)->first();

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
     * @apiParam {String} goal_options value of goal selected *required
     * @apiSuccess {String} success.
     * @apiSuccessExample Success-Response:
     * HTTP/1.1 200 OK
     * {
      "status": 1,
      "success": "updated_user_goal"
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
        } elseif (!isset($request->goal_options) || ($request->goal_options == null)) {
            return response()->json(["status" => "0", "error" => "The goal_options field is required"]);
        } else {

            $user = User::where('id', '=', $request->input('user_id'))->first();

            if (!is_null($user)) {

                $userOption = DB::table('user_goal_options')->where('user_id', $request->user_id)->first();

                $skill = DB::table('skills')->where('id', $request->goal_options)->first();

                if (!is_null($userOption)) {

                    DB::table('user_goal_options')
                        ->where('user_id', $request->user_id)
                        ->update([
                            'progression_id' => $skill->progression_id,
                            'goal_options' => $request->goal_options
                    ]);
                } else {

                    DB::table('user_goal_options')->insert([
                        'user_id' => $request->user_id,
                        'goal_options' => $request->goal_options,
                        'progression_id' => $skill->progression_id,
                        'created_at' => Carbon::now()
                    ]);
                }

                $coach = DB::table('coaches')->where('user_id', $request->user_id)->first();

                if (!is_null($coach)) {

                    DB::table('coaches')
                        ->where('user_id', $request->user_id)
                        ->update([
                            'goal_option' => $request->goal_options
                    ]);
                }

                return response()->json(['status' => 1, 'success' => 'updated_user_goal'], 200);
            } else {
                return response()->json(['status' => 0, 'error' => 'user_does_not_exists'], 500);
            }
        }
    }

    /**
     * @api {post} /user/options/removegoaloptions removeUserGoalOptions
     * @apiName removeUserGoalOptions
     * @apiGroup User
     * @apiParam {integer} user_id id of loggedin user *required
     * @apiSuccess {String} success.
     * @apiSuccessExample Success-Response:
     * HTTP/1.1 200 OK
     * {
      "status": 1,
      "success": "removed_user_goal"
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
    public function removeUserGoalOptions(Request $request)
    {
        if (!isset($request->user_id) || ($request->user_id == null)) {
            return response()->json(["status" => "0", "error" => "The user_id field is required"]);
        } else {

            $user = User::where('id', '=', $request->input('user_id'))->first();

            if (!is_null($user)) {

                DB::table('user_goal_options')->where('user_id', $request->user_id)->delete();

                $coach = DB::table('coaches')->where('user_id', $request->user_id)->first();

                if (!is_null($coach)) {
                    DB::table('coaches')
                        ->where('user_id', $request->user_id)
                        ->update(['goal_option' => 0]);
                }

                return response()->json(['status' => 1, 'success' => 'removed_user_goal'], 200);
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

                $muscleGroups = array_map(function($muscleGroup) use ($userOptionsArray) {
                    if (count($userOptionsArray) >= 1) {
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

                $coach = DB::table('coaches')->where('user_id', $request->user_id)->first();

                if (!is_null($coach)) {
                    DB::table('coaches')
                        ->where('user_id', $request->user_id)
                        ->update(['muscle_groups' => $request->physique_options]);
                }

                return response()->json(['status' => 1, 'success' => 'updated_user_physique_groups', 'physique_groups' => $muscleGroups], 200);
            } else {
                return response()->json(['status' => 0, 'error' => 'user_does_not_exists'], 500);
            }
        }
    }

    /**
     * @api {post} /user/updatemotivation updateMotivation
     * @apiName updateMotivation
     * @apiGroup User
     * @apiParam {integer} user_id id of loggedin user *required
     * @apiParam {String} quote User motivation message *required
     * @apiSuccess {String} success.
     * @apiSuccessExample Success-Response:
     * HTTP/1.1 200 OK
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
    public function updateMotivation(Request $request)
    {
        if (!isset($request->user_id) || ($request->user_id == null)) {
            return response()->json(["status" => "0", "error" => "The user_id field is required"]);
        } elseif (!isset($request->quote) || ($request->quote == null) || $request->quote == '(null)') {
            return response()->json(["status" => "0", "error" => "The quote field is required"]);
        } else {

            $user = User::where('id', $request->user_id)->with(['followers'])->first();

            if ($user) {

                Profile::where('user_id', $request->user_id)->update(['quote' => $request->quote]);

                return response()->json(['status' => 1, 'success' => 'updated_user_motivation_messsage'], 200);
            } else {
                return response()->json(['status' => 0, 'error' => 'user_does_not_exists'], 500);
            }
        }
    }

    public function crypto_rand_secure($min, $max)
    {
        $range = $max - $min;
        if ($range < 1){
            return $min; // not so random...
        }
        $log = ceil(log($range, 2));
        $bytes = (int) ($log / 8) + 1; // length in bytes
        $bits = (int) $log + 1; // length in bits
        $filter = (int) (1 << $bits) - 1; // set all lower bits to 1
        
        do {
            $rnd = hexdec(bin2hex(openssl_random_pseudo_bytes($bytes)));
            $rnd = $rnd & $filter; // discard irrelevant bits
        } while ($rnd >= $range);
        
        return $min + $rnd;
    }

    public function getToken($length)
    {
        $token = "";
        $codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $codeAlphabet.= "abcdefghijklmnopqrstuvwxyz";
        $codeAlphabet.= "0123456789";
        $max = strlen($codeAlphabet) - 1;
        
        for ($i = 0; $i < $length; $i++) {
            $token .= $codeAlphabet[$this->crypto_rand_secure(0, $max)];
        }
        
        return $token;
    }

    /**
     * @api {post} /user/updateemail updateUserEmail
     * @apiName updateUserEmail
     * @apiGroup User
     *
     * @apiParam {string} email email address of user *required
     * @apiParam {Number} user_id id of user user *required
     * @apiSuccess {String} success.
     * 
     * @apiSuccessExample Success-Response:
     *     HTTP/1.1 200 OK
     * {
      "status": 1,
      "message": "Successfully updated email address."
      }
     *       
     *
     * @apiError error Validation error.
     * @apiError error Validation error.
     * @apiError error Message An user already registered with this email address.
     *
     * 
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 400 Validation error
     *     {
      "status": 0,
      "error": "The email field is required.",
      }
     * 
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 400 Validation error
     *     {
     *       "status" : 0,
     *       "error": "The user_id field is required."
     *     }
     * 
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 Already Exists Erroe
     *     {
     *       "status" : 0,
     *       "error": "An user already registered with this email address."
     *     }
     */
    public function updateUserEmail(Request $request)
    {
        if (!isset($request->user_id) || ($request->user_id == null)) {
            return response()->json(["status" => "0", "error" => "The user_id field is required"]);
        } elseif (!isset($request->email) || ($request->email == null)) {
            return response()->json(["status" => "0", "error" => "The email field is required"]);
        } else {

            $user = User::where('id', '=', $request->user_id)->with(['profile'])->first();

            $alreadyExist = User::where('email', '=', $request->email)->first();

            if (!is_null($alreadyExist)) {
                return response()->json(["status" => "0", "error" => "An user already registered with this email address."]);
            }

            if (is_null($user)) {
                return response()->json([ "status" => 0, "error" => "User does not exists."], 422);
            } else {

                $data = [
                    'email' => $request->email,
                    'first_name' => $user['profile'][0]->first_name,
                    'last_name' => $user['profile'][0]->last_name,
                ];

                $confirmation_code = str_random(30);

                User::where('id', '=', $request->user_id)->update([
                    'email' => $request->email,
                    'confirmation_code' => $confirmation_code,
                    'status' => 0
                ]);

                Mail::send('email.verify', ['confirmation_code' => $confirmation_code, 'first_name' => $data['first_name'], 'last_name' => $data['last_name']], function($message) use ($data) {
                    $message->to($data['email'], $data['first_name'] . ' ' . $data['last_name'])
                        ->subject('Verify your email address');
                });

                return response()->json([ "status" => 1, "message" => "Successfully updated email address."], 200);
            }
        }
    }
}