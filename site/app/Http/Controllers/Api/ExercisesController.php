<?php namespace App\Http\Controllers\Api;

use Auth,
    Validator,
    DB;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\User;
use App\Feeds;
use App\Exercise;
use App\Exerciseuser;

class ExercisesController extends Controller
{
    /*
      |--------------------------------------------------------------------------
      | Exercises Controller
      |--------------------------------------------------------------------------
      |
      | This controller handles exercises, user exercises.
      |
     */

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('jwt.auth');
    }

    /**
     * @api {post} /exercise/list loadExercises
     * @apiName loadExercises
     * @apiGroup Exercise
     * @apiParam {Number} user_id Id of user *required
     * @apiSuccess {String} success.
     * @apiSuccessExample Success-Response:
     * HTTP/1.1 200 OK
     * {
      "status": 1,
      "is_subscribed" : 1,
      "exercises": {
      "lean": {
      "free": [
      {
      "id": "1",
      "name": "Jumping Pullups",
      "description": "The jumping pull-up is a challenging full body exercise that targets the back, legs and arms.",
      "category": "1",
      "type": "1",
      "rewards": "6.00",
      "repititions": "10",
      "duration": "1.00",
      "unit": "times",
      "equipment": "",
      "created_at": "2015-11-17 08:00:19",
      "updated_at": "2015-11-20 04:20:50",
      "video": [
      {
      "id": "1",
      "user_id": "1",
      "path": "Now1.mp4",
      "videothumbnail": "",
      "description": "Test Description",
      "parent_type": "1",
      "type": "1",
      "parent_id": "1",
      "created_at": "2015-11-11 01:56:40",
      "updated_at": "2015-11-11 12:13:27"
      }
      ]
      }
      ],
      "paid": [
      {
      "id": "2",
      "name": "Australian Pullups",
      "description": "Australian pull-ups are becoming a very popular exercise. Like all types of pull-ups (and all types of exercises for that matter) there are many different ways to do the Australian, and it can be incorporated into a number of different contexts within a workout.",
      "category": "1",
      "type": "2",
      "rewards": "6.00",
      "repititions": "10",
      "duration": "1.00",
      "unit": "times",
      "equipment": "",
      "created_at": "2015-11-17 08:00:20",
      "updated_at": "2015-11-20 04:20:01",
      "video": []
      }
      ]
      },
      "athletic": {
      "free": [
      {
      "id": "32",
      "name": "Pull ups / Chin ups",
      "description": "",
      "category": "2",
      "type": "1",
      "rewards": "6.00",
      "repititions": "10",
      "duration": "1.00",
      "unit": "times",
      "equipment": "",
      "created_at": "2015-11-17 08:01:02",
      "updated_at": "2015-11-20 04:21:42",
      "video": []
      }
      ],
      "paid": [
      {
      "id": "33",
      "name": "One Leg Front Lever",
      "description": "",
      "category": "2",
      "type": "2",
      "rewards": "6.00",
      "repititions": "10",
      "duration": "1.00",
      "unit": "times",
      "equipment": "",
      "created_at": "2015-11-17 08:01:02",
      "updated_at": "2015-11-20 04:20:01",
      "video": []
      }
      ]
      },
      "strength": {
      "free": [
      {
      "id": "69",
      "name": "Muscleups",
      "description": "",
      "category": "3",
      "type": "1",
      "rewards": "6.00",
      "repititions": "10",
      "duration": "1.00",
      "unit": "times",
      "equipment": "",
      "created_at": "2015-11-17 08:03:53",
      "updated_at": "2015-11-20 04:22:21",
      "video": []
      }
      ],
      "paid": [
      {
      "id": "77",
      "name": "Front Lever",
      "description": "",
      "category": "3",
      "type": "2",
      "rewards": "10.00",
      "repititions": "10",
      "duration": "1.00",
      "unit": "times",
      "equipment": "",
      "created_at": "2015-11-17 08:10:32",
      "updated_at": "2015-11-17 08:10:32",
      "video": []
      }
      ]
      }
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
     * @apiError error Message Validation error
     * @apiError error Message user_not_exists
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
     * 
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 500 user_not_exists
     *     {
     *       "status" : 0,
     *       "error": "user_not_exists"
     *     }
     * 
     */
    public function loadExercises(Request $request)
    {
        if (!isset($request->user_id) || ($request->user_id == null)) {
            return response()->json(["status" => "0", "error" => "The user_id field is required"]);
        } else {
            $user = User::where('id', '=', $request->input('user_id'))->first();
            if (!is_null($user)) {


                $exercises = [];

                $leanExercisesFree = Exercise::whereRaw('category = 1 AND type = 1 AND name != "Rest"')
                    ->with(['video'])
                    ->get();
                $athleticExercisesFree = Exercise::whereRaw('category = 2 AND type = 1 AND name != "Rest"')
                    ->with(['video'])
                    ->get();
                $strongExercisesFree = Exercise::whereRaw('category = 3 AND type = 1 AND name != "Rest"')
                    ->with(['video'])
                    ->get();


                $leanExercisesPaid = Exercise::where('category', '=', 1)
                    ->whereRaw('category = 1 AND type = 2 AND name != "Rest"')
                    ->with(['video'])
                    ->get();
                $athleticExercisesPaid = Exercise::whereRaw('category = 2 AND type = 2 AND name != "Rest"')
                    ->with(['video'])
                    ->get();
                $strongExercisesPaid = Exercise::whereRaw('category = 3 AND type = 2 AND name != "Rest"')
                    ->with(['video'])
                    ->get();

                $exercises['lean'] = ['free' => $leanExercisesFree, 'paid' => $leanExercisesPaid];
                $exercises['athletic'] = ['free' => $athleticExercisesFree, 'paid' => $athleticExercisesPaid];
                $exercises['strength'] = ['free' => $strongExercisesFree, 'paid' => $strongExercisesPaid];

                return response()->json([
                        'status' => 1,
                        'exercises' => $exercises,
                        'is_subscribed' => $user->is_subscribed,
                        'urls' => config('urls.urls')], 200);
            } else {
                return response()->json(['status' => 0, 'error' => 'user_not_exists'], 500);
            }
        }
    }

    /**
     * @api {post} /exercise/getwithusers getExerciseWithUsers
     * @apiName getExerciseWithUsers
     * @apiGroup Exercise
     * @apiParam {Number} exercise_id Id of exercise *required
     * @apiParam {Number} user_id Id of user *required
     * @apiSuccess {String} success.
     * @apiSuccessExample Success-Response:
     * HTTP/1.1 200 OK
     * {
      "status": 1,
      "exercise": {
      "10": {
      "users": [],
      "personal_best": ""
      },
      "20": {
      "users": [],
      "personal_best": ""
      },
      "25": {
      "users": [],
      "personal_best": ""
      },
      "30": {
      "users": [],
      "personal_best": ""
      },
      "50": {
      "users": [
      {
      "id": "186",
      "user_id": "3",
      "exercise_id": "12",
      "status": "1",
      "time": "10",
      "is_starred": "0",
      "volume": "50",
      "feed_id": "248",
      "created_at": "2016-02-02 14:53:07",
      "updated_at": "2016-02-02 14:53:07",
      "profile": {
      "id": "3",
      "user_id": "3",
      "first_name": "Arun",
      "last_name": "MG",
      "gender": "0",
      "fitness_status": "3",
      "goal": "1",
      "image": "3_1453737842.jpg",
      "cover_image": "3_1453914991.jpg",
      "city": "kakkanad",
      "state": "",
      "country": "",
      "spot": "",
      "quote": "To lean",
      "facebook": "",
      "twitter": "",
      "instagram": "",
      "created_at": "2016-01-22 05:57:51",
      "updated_at": "2016-02-04 12:34:45",
      "level": 13
      }
      }
      ],
      "personal_best": "10"
      },
      "60": {
      "users": [],
      "personal_best": ""
      },
      "100": {
      "users": [],
      "personal_best": ""
      },
      "120": {
      "users": [],
      "personal_best": ""
      },
      "180": {
      "users": [],
      "personal_best": ""
      },
      "240": {
      "users": [],
      "personal_best": ""
      },
      "250": {
      "users": [],
      "personal_best": ""
      },
      "300": {
      "users": [],
      "personal_best": ""
      },
      "360": {
      "users": [],
      "personal_best": ""
      },
      "420": {
      "users": [],
      "personal_best": ""
      },
      "480": {
      "users": [],
      "personal_best": ""
      },
      "500": {
      "users": [],
      "personal_best": ""
      },
      "540": {
      "users": [],
      "personal_best": ""
      },
      "600": {
      "users": [],
      "personal_best": ""
      },
      "750": {
      "users": [],
      "personal_best": ""
      },
      "1000": {
      "users": [],
      "personal_best": ""
      },
      "id": "12",
      "name": "Pushups",
      "description": "Perform the most popular exercise of all time with real strength.",
      "category": "2",
      "type": "1",
      "muscle_groups": "1,2,3",
      "rewards": "6.00",
      "repititions": "10",
      "duration": "10",
      "unit": "times",
      "equipment": "",
      "range_of_motion": "  \"1. Lie on the floor face down and place your hands in a standard pushup position.\r\n 2. Next, lower yourself downward until your chest almost touches the floor as you inhale.\r\n 3. Exhale and press your upper body back up to the starting position while squeezing your chest.\r\n 4. Repeat, after a brief pause at the top contracted position.\"\r\n  ",
      "video_tips": "    ",
      "pro_tips": "  Do them extra slow and hold it in highest and lowest position to get strength.\r\n  ",
      "musclegroup_string": "Shoulders, Chest, Triceps",
      "video": [
      {
      "id": "57",
      "path": "12_1453984139.mp4",
      "videothumbnail": "12_1453984139.jpg",
      "description": "Pushups"
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
     * 
     * 
     * @apiError error Message token_invalid.
     * @apiError error Message token_expired.
     * @apiError error Message token_not_provided.
     * @apiError error Message Validation error
     * @apiError error Message exercise_not_exists
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
     *       "error": "The exercise_id field is required"
     *     }
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 422 Validation error
     *     {
     *       "status" : 0,
     *       "error": "The user_id field is required"
     *     }
     * 
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 500 exercise_not_exists
     *     {
     *       "status" : 0,
     *       "error": "exercise_not_exists"
     *     }
     * 
     */
    public function getExerciseWithUsers(Request $request)
    {
        if (!isset($request->exercise_id) || ($request->exercise_id == null)) {
            return response()->json(["status" => "0", "error" => "The exercise_id field is required"]);
        } elseif (!isset($request->user_id) || ($request->user_id == null)) {
            return response()->json(["status" => "0", "error" => "The user_id field is required"]);
        } else {
            //code added by ansa@cubettech.com on 31-12-2015
            //Added video in response
            $exercise = Exercise::where('id', '=', $request->input('exercise_id'))->with(['video'])->first();
            
            $arr1 = Array(5, 10, 15, 20, 25, 30, 45, 60, 90, 120, 150, 180, 240, 300);
            
            $arr2 = Array(7, 10, 15, 20, 25, 30, 40, 50, 60, 100, 120, 180, 240, 250, 300, 360, 420, 480, 500, 540, 600, 750, 1000);
            if($exercise->unit == 'seconds'){
                $volumeArray = $arr1;
            }else{
                $volumeArray = $arr2;
            }

            if (!is_null($exercise)) {
                $exerciseArray = $exercise->toArray();
                foreach ($volumeArray as $vKey => $volume1) {
                    $exerciseUsers = ExerciseUser::where('exercise_id', '=', $request->input('exercise_id'))
                        ->where('status', '=', 1)
                        ->where('volume', '=', $volume1)
                        ->with(['profile'])
                        ->groupBy('user_id')
                        ->orderBy('time', 'ASC')
                        ->get();
                    $exerciseArray[$volume1]['users'] = $exerciseUsers->toArray();

                    $personalBest = DB::table('exercise_users')->where('exercise_id', '=', $request->input('exercise_id'))
                        ->where('status', '=', 1)
                        ->where('volume', '=', $volume1)
                        ->where('user_id', '=', $request->user_id)
                        ->groupBy('user_id')
                        ->orderBy('time', 'ASC')
                        ->pluck('time');

                    $exerciseArray[$volume1]['users'] = $exerciseUsers->toArray();

                    if (!is_null($personalBest)) {
                        $exerciseArray[$volume1]['personal_best'] = $personalBest;
                    } else {
                        $exerciseArray[$volume1]['personal_best'] = '';
                    }
                }
                return response()->json(['status' => 1, 'exercise' => $exerciseArray, 'urls' => config('urls.urls')], 200);
            } else {
                return response()->json(['status' => 0, 'error' => 'exercise_not_exists'], 500);
            }
        }
    }

    /**
     * @api {post} /exercise/get getExercise
     * @apiName getExercise
     * @apiGroup Exercise
     * @apiParam {Number} exercise_id Id of exercise *required
     * @apiSuccess {String} success.
     * @apiSuccessExample Success-Response:
     * HTTP/1.1 200 OK
     * {
      "status": 1,
      "exercise": {
      "id": "1",
      "name": "Jumping Pullups",
      "description": "The jumping pull-up is a challenging full body exercise that targets the back, legs and arms.",
      "category": "1",
      "type": "1",
      "rewards": "6.00",
      "repititions": "10",
      "duration": "1.00",
      "unit": "times",
      "equipment": "",
      "created_at": "2015-11-17 08:00:19",
      "updated_at": "2015-11-20 04:20:50",
      "video": [
      {
      "id": "1",
      "user_id": "1",
      "path": "Now1.mp4",
      "videothumbnail": "",
      "description": "Test Description",
      "parent_type": "1",
      "type": "1",
      "parent_id": "1",
      "created_at": "2015-11-11 01:56:40",
      "updated_at": "2015-11-11 12:13:27"
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
     * 
     * 
     * @apiError error Message token_invalid.
     * @apiError error Message token_expired.
     * @apiError error Message token_not_provided.
     * @apiError error Message Validation error
     * @apiError error Message exercise_not_exists
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
     *       "error": "The exercise_id field is required"
     *     }
     * 
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 500 exercise_not_exists
     *     {
     *       "status" : 0,
     *       "error": "exercise_not_exists"
     *     }
     * 
     */
    public function getExercise(Request $request)
    {
        if (!isset($request->exercise_id) || ($request->exercise_id == null)) {
            return response()->json(["status" => "0", "error" => "The exercise_id field is required"]);
        } else {
            $exercise = Exercise::where('id', '=', $request->input('exercise_id'))->with(['video'])->first();
            if (!is_null($exercise)) {
                return response()->json(['status' => 1, 'exercise' => $exercise, 'urls' => config('urls.urls')], 200);
            } else {
                return response()->json(['status' => 0, 'error' => 'exercise_not_exists'], 500);
            }
        }
    }
}
