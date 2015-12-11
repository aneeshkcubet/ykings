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
use App\Workout;
use App\Workoutexercise;
use App\Workoutuser;

class WorkoutsController extends Controller
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
     * @api {post} /workout/list loadWorkouts
     * @apiName loadWorkouts
     * @apiGroup Workout
     * @apiParam {Number} user_id Id of user 
     * @apiSuccess {String} success.
     * @apiSuccessExample Success-Response:
     * HTTP/1.1 200 OK
     * {
          "status": 1,
          "is_subscribed": 0,
          "workouts": {
          "free": [{
                      "id": "2",
                      "name": "Borr",
                      "description": "Borr Borr Borr",
                      "rounds": "3",
                      "category": "2",
                      "type": "1",
                      "rewards": "330",
                      "duration": "19.00",
                      "equipments": "BAR",      
                  },
                  {
                      "id": "3",
                      "name": "Bragi",
                      "description": "Bragi",
                      "rounds": "5",
                      "category": "2",
                      "type": "1",
                      "rewards": "200",
                      "duration": "14.00",
                      "equipments": "Low Bar"      
                  }],
          "paid": [{
                      "id": "1",
                      "name": "Baldur",
                      "description": "Baldur Baldur",
                      "rounds": "5",
                      "category": "1",
                      "type": "2",
                      "rewards": "330",
                      "duration": "15.00",
                      "equipments": ""
                  }]
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
    public function loadWorkouts(Request $request)
    {
        $workoutResponse = [];
        if (!isset($request->user_id) || ($request->user_id == null)) {
            return response()->json(["status" => "0", "error" => "The user_id field is required"]);
        } else {
            $user = User::where('id', '=', $request->input('user_id'))->first();
            if (!is_null($user)) {
                $workoutResponse['free'] = [];
                $workoutResponse['paid'] = [];

                $freeWorkouts = Workout::where('type', '=', 1)->get();
                $paidWorkouts = Workout::where('type', '=', 2)->get();
                if (!is_null($freeWorkouts)) {
                    $workoutResponse['free'] = $freeWorkouts;
                }
                if (!is_null($paidWorkouts)) {
                    $workoutResponse['paid'] = $paidWorkouts;
                }
                return response()->json([
                        'status' => 1,
                        'is_subscribed' => $user->is_subscribed,
                        'workouts' => $workoutResponse
                        ], 200);
            } else {
                return response()->json(['status' => 0, 'error' => 'user_not_exists'], 500);
            }
        }
    }

    /**
     * @api {post} /workout/getlevels getWorkoutWithLevels
     * @apiName getWorkoutWithLevels
     * @apiGroup Workout
     * @apiParam {Number} workout_id Id of workout 
     * @apiSuccess {String} success.
     * @apiSuccessExample Success-Response:
     * HTTP/1.1 200 OK
     *  {
          "status": 1,
          "is_subscribed": 0,
          "workout": {
            "id": "2",
            "name": "Borr",
            "description": "Borr Borr Borr",
            "rounds": "3",
            "category": "2",
            "type": "1",
            "rewards": {
              "lean": 330,
              "athletic": 440,
              "strength": 550
            },
            "duration": "19.00",
            "equipments": "BAR",
            "lean": [],
            "athletic": [
              {
                "id": "1",
                "workout_id": "2",
                "user_id": "2",
                "status": "1",
                "time": "1200",
                "is_starred": "0",
                "created_at": "2015-11-20 05:04:13",
                "updated_at": "2015-12-08 10:38:24",
                "category": "2",
                "profile": {
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
                  "facebook": "",
                  "twitter": "",
                  "instagram": "",
                  "created_at": "2015-11-09 09:14:02",
                  "updated_at": "2015-12-09 09:07:21",
                  "level": 3
                }
              }
            ],
            "strength": []
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
     * @apiError error Message workout_not_exists
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
     *     HTTP/1.1 500 workout_not_exists
     *     {
     *       "status" : 0,
     *       "error": "workout_not_exists"
     *     }
     * 
     */
    public function getWorkoutWithLevels(Request $request)
    {
//        $rewards = [
//            'lean' => 330,
//            'athletic' => 440,
//            'strength' => 550
//        ];
//        
//        echo json_encode($rewards);
//        die;
        if (!isset($request->workout_id) || ($request->workout_id == null)) {
            return response()->json(["status" => "0", "error" => "The workout_id field is required"]);
        } else {
            $workout = Workout::where('id', '=', $request->input('workout_id'))->first();
            if (!is_null($workout)) {
                $workoutArray = $workout->toArray();
                $workoutArray['rewards'] = json_decode($workoutArray['rewards'], true);
                $leanWorkoutUsers = WorkoutUser::where('category', '=', 1)
                    ->where('workout_id', '=', $request->workout_id)
                    ->where('status', '=', 1)
                    ->with(['profile'])
                    ->groupBy('user_id')
                    ->orderBy('time', 'ASC')
                    ->get();
                $athleteWorkoutUsers = WorkoutUser::where('category', '=', 2)
                    ->where('workout_id', '=', $request->workout_id)
                    ->where('status', '=', 1)
                    ->with(['profile'])
                    ->groupBy('user_id')
                    ->orderBy('time', 'ASC')
                    ->get();
                $strengthWorkoutUsers = WorkoutUser::where('category', '=', 3)
                    ->where('workout_id', '=', $request->workout_id)
                    ->where('status', '=', 1)
                    ->with(['profile'])
                    ->groupBy('user_id')
                    ->orderBy('time', 'ASC')
                    ->get();

                $time = time();

                $isSubscribed = 0;

                if (isset($request->user_id)) {

                    $subscription = DB::table('subscriptions')
                        ->select('*')
                        ->where('user_id', '=', $request->user_id)
                        ->orderBy('id', 'DESC')
                        ->first();

                    if (!is_null($subscription) && $subscription->end_time > $time) {
                        $isSubscribed = 1;
                    }
                }

                $workoutArray['lean'] = [];
                $workoutArray['athletic'] = [];
                $workoutArray['strength'] = [];

                $workoutArray['lean'] = $leanWorkoutUsers->toArray();
                $workoutArray['athletic'] = $athleteWorkoutUsers->toArray();
                $workoutArray['strength'] = $strengthWorkoutUsers->toArray();

                return response()->json(['status' => 1, 'is_subscribed' => $isSubscribed, 'workout' => $workoutArray, 'urls' => config('urls.urls')], 200);
            } else {
                return response()->json(['status' => 0, 'error' => 'workout_not_exists'], 500);
            }
        }
    }

    /**
     * @api {post} /workout/getexercises getWorkoutWithExercises
     * @apiName getWorkoutWithExercises
     * @apiGroup Workout
     * @apiParam {Number} workout_id Id of workout 
     * @apiParam {Number} category of workout 1-lean, 2-athletic, 3-strength
     * @apiSuccess {String} success.
     * @apiSuccessExample Success-Response:
     * HTTP/1.1 200 OK
     * {
      "status": 1,
      "workout": {
      "id": "2",
      "name": "Borr",
      "description": "Borr Borr Borr",
      "rounds": "3",
      "category": "2",
      "type": "1",
      "rewards": "330",
      "duration": "19.00",
      "equipments": "BAR",
      "exercises": {
      "round1": [
      {
      "id": "31",
      "exercise_id": "69",
      "unit": "",
      "video": {
      "id": "69",
      "path": "Now1.mp4",
      "videothumbnail": "thumbnail3.jpg",
      "description": "Test Description"
      },
      "exercise": {
      "id": "69",
      "name": "Muscleups",
      "description": ""
      }
      },
      {
      "id": "32",
      "exercise_id": "85",
      "unit": "",
      "video": {
      "id": "85",
      "path": "Now1.mp4",
      "videothumbnail": "thumbnail1.png",
      "description": "Test Description"
      },
      "exercise": {
      "id": "85",
      "name": "Atztec Pushups",
      "description": ""
      }
      },
      {
      "id": "33",
      "exercise_id": "70",
      "unit": "",
      "video": {
      "id": "70",
      "path": "Now1.mp4",
      "videothumbnail": "thumbnail1.png",
      "description": "Test Description"
      },
      "exercise": {
      "id": "70",
      "name": "Dips",
      "description": ""
      }
      },
      {
      "id": "70",
      "exercise_id": "72",
      "unit": "",
      "video": {
      "id": "72",
      "path": "Now1.mp4",
      "videothumbnail": "thumbnail3.jpg",
      "description": "Test Description"
      },
      "exercise": {
      "id": "72",
      "name": "Burpee Squat Jumps",
      "description": ""
      }
      },
      {
      "id": "71",
      "exercise_id": "69",
      "unit": "",
      "video": {
      "id": "69",
      "path": "Now1.mp4",
      "videothumbnail": "thumbnail3.jpg",
      "description": "Test Description"
      },
      "exercise": {
      "id": "69",
      "name": "Muscleups",
      "description": ""
      }
      },
      {
      "id": "72",
      "exercise_id": "75",
      "unit": "",
      "video": {
      "id": "75",
      "path": "Now1.mp4",
      "videothumbnail": "thumbnail3.jpg",
      "description": "Test Description"
      },
      "exercise": {
      "id": "75",
      "name": "Jacknives",
      "description": ""
      }
      },
      {
      "id": "73",
      "exercise_id": "70",
      "unit": "",
      "video": {
      "id": "70",
      "path": "Now1.mp4",
      "videothumbnail": "thumbnail1.png",
      "description": "Test Description"
      },
      "exercise": {
      "id": "70",
      "name": "Dips",
      "description": ""
      }
      }
      ],
      "round2": [
      {
      "id": "34",
      "exercise_id": "69",
      "unit": "",
      "video": {
      "id": "69",
      "path": "Now1.mp4",
      "videothumbnail": "thumbnail3.jpg",
      "description": "Test Description"
      },
      "exercise": {
      "id": "69",
      "name": "Muscleups",
      "description": ""
      }
      },
      {
      "id": "35",
      "exercise_id": "85",
      "unit": "",
      "video": {
      "id": "85",
      "path": "Now1.mp4",
      "videothumbnail": "thumbnail1.png",
      "description": "Test Description"
      },
      "exercise": {
      "id": "85",
      "name": "Atztec Pushups",
      "description": ""
      }
      },
      {
      "id": "36",
      "exercise_id": "70",
      "unit": "",
      "video": {
      "id": "70",
      "path": "Now1.mp4",
      "videothumbnail": "thumbnail1.png",
      "description": "Test Description"
      },
      "exercise": {
      "id": "70",
      "name": "Dips",
      "description": ""
      }
      },
      {
      "id": "74",
      "exercise_id": "72",
      "unit": "",
      "video": {
      "id": "72",
      "path": "Now1.mp4",
      "videothumbnail": "thumbnail3.jpg",
      "description": "Test Description"
      },
      "exercise": {
      "id": "72",
      "name": "Burpee Squat Jumps",
      "description": ""
      }
      },
      {
      "id": "75",
      "exercise_id": "69",
      "unit": "",
      "video": {
      "id": "69",
      "path": "Now1.mp4",
      "videothumbnail": "thumbnail3.jpg",
      "description": "Test Description"
      },
      "exercise": {
      "id": "69",
      "name": "Muscleups",
      "description": ""
      }
      },
      {
      "id": "76",
      "exercise_id": "75",
      "unit": "",
      "video": {
      "id": "75",
      "path": "Now1.mp4",
      "videothumbnail": "thumbnail3.jpg",
      "description": "Test Description"
      },
      "exercise": {
      "id": "75",
      "name": "Jacknives",
      "description": ""
      }
      },
      {
      "id": "77",
      "exercise_id": "70",
      "unit": "",
      "video": {
      "id": "70",
      "path": "Now1.mp4",
      "videothumbnail": "thumbnail1.png",
      "description": "Test Description"
      },
      "exercise": {
      "id": "70",
      "name": "Dips",
      "description": ""
      }
      }
      ],
      "round3": [
      {
      "id": "37",
      "exercise_id": "69",
      "unit": "",
      "video": {
      "id": "69",
      "path": "Now1.mp4",
      "videothumbnail": "thumbnail3.jpg",
      "description": "Test Description"
      },
      "exercise": {
      "id": "69",
      "name": "Muscleups",
      "description": ""
      }
      },
      {
      "id": "38",
      "exercise_id": "85",
      "unit": "",
      "video": {
      "id": "85",
      "path": "Now1.mp4",
      "videothumbnail": "thumbnail1.png",
      "description": "Test Description"
      },
      "exercise": {
      "id": "85",
      "name": "Atztec Pushups",
      "description": ""
      }
      },
      {
      "id": "39",
      "exercise_id": "70",
      "unit": "",
      "video": {
      "id": "70",
      "path": "Now1.mp4",
      "videothumbnail": "thumbnail1.png",
      "description": "Test Description"
      },
      "exercise": {
      "id": "70",
      "name": "Dips",
      "description": ""
      }
      },
      {
      "id": "78",
      "exercise_id": "72",
      "unit": "",
      "video": {
      "id": "72",
      "path": "Now1.mp4",
      "videothumbnail": "thumbnail3.jpg",
      "description": "Test Description"
      },
      "exercise": {
      "id": "72",
      "name": "Burpee Squat Jumps",
      "description": ""
      }
      },
      {
      "id": "79",
      "exercise_id": "69",
      "unit": "",
      "video": {
      "id": "69",
      "path": "Now1.mp4",
      "videothumbnail": "thumbnail3.jpg",
      "description": "Test Description"
      },
      "exercise": {
      "id": "69",
      "name": "Muscleups",
      "description": ""
      }
      },
      {
      "id": "80",
      "exercise_id": "75",
      "unit": "",
      "video": {
      "id": "75",
      "path": "Now1.mp4",
      "videothumbnail": "thumbnail3.jpg",
      "description": "Test Description"
      },
      "exercise": {
      "id": "75",
      "name": "Jacknives",
      "description": ""
      }
      },
      {
      "id": "81",
      "exercise_id": "70",
      "unit": "",
      "video": {
      "id": "70",
      "path": "Now1.mp4",
      "videothumbnail": "thumbnail1.png",
      "description": "Test Description"
      },
      "exercise": {
      "id": "70",
      "name": "Dips",
      "description": ""
      }
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
     * @apiError error Message Validation error
     * @apiError error Message workout_not_exists
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
     *  @apiErrorExample Error-Response:
     *     HTTP/1.1 422 Validation error
     *     {
     *       "status" : 0,
     *       "error": "The category field is required"
     *     }
     * 
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 500 workout_not_exists
     *     {
     *       "status" : 0,
     *       "error": "workout_not_exists"
     *     }
     * 
     */
    public function getWorkoutWithExercises(Request $request)
    {
        if (!isset($request->workout_id) || ($request->workout_id == null)) {
            return response()->json(["status" => "0", "error" => "The workout_id field is required"]);
        } elseif (!isset($request->category) || ($request->category == null)) {
            return response()->json(["status" => "0", "error" => "The category field is required"]);
        } else {
            $workout = Workout::where('id', '=', $request->input('workout_id'))->first();
            if (!is_null($workout)) {
                $rounds = $workout->rounds;
                $count = 1;
                $exercises = [];
                do {
                    $roundExercises = Workoutexercise::where('category', '=', $request->category)
                            ->where('round', '=', $count)
                            ->where('workout_id', '=', $request->input('workout_id'))
                            ->with(['video', 'exercise'])->get();

                    $exercises['round' . $count] = $roundExercises->toArray();

                    $count++;
                } while ($count <= $rounds);


                $workoutArray = $workout->toArray();

                $workoutArray['exercises'] = $exercises;

                return response()->json(['status' => 1, 'workout' => $workoutArray, 'urls' => config('urls.urls')], 200);
            } else {
                return response()->json(['status' => 0, 'error' => 'workout_not_exists'], 500);
            }
        }
    }

    /**
     * @api {post} /workout/addstar addStar
     * @apiName addStar
     * @apiGroup Workout
     * @apiParam {Number} workout_id Id of workout *required
     * @apiParam {Number} category of workout *required 1-lean, 2-athletic, 3-strength
     * @apiParam {Number} user_id of workout *required
     * @apiSuccess {String} success.
     * @apiSuccessExample Success-Response:
     * HTTP/1.1 200 OK
     *  {
      "status": 1,
      "success": "Successfully stared."
      }
     * 
     * 
     * @apiError error Message token_invalid.
     * @apiError error Message token_expired.
     * @apiError error Message token_not_provided.
     * @apiError error Message Validation error
     * @apiError error Message Validation error
     * @apiError error Message workout_not_exists
     * @apiError error Message You need to complete this workout to star.
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
     *     HTTP/1.1 422 Validation error
     *     {
     *       "status" : 0,
     *       "error": "The category field is required"
     *     }
     * 
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 422 Validation error
     *     {
     *       "status" : 0,
     *       "error": "The user_id field is required"
     *     }
     * 
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 422 You need to complete this workout to star.
     *     {
     *       "status" : 0,
     *       "error": "You need to complete this workout to star."
     *     }
     * 
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 500 workout_not_exists
     *     {
     *       "status" : 0,
     *       "error": "workout_not_exists"
     *     }
     * 
     */
    public function addStar(Request $request)
    {
        if (!isset($request->workout_id) || ($request->workout_id == null)) {
            return response()->json(["status" => "0", "error" => "The workout_id field is required"]);
        } elseif (!isset($request->category) || ($request->category == null)) {
            return response()->json(["status" => "0", "error" => "The category field is required"]);
        } elseif (!isset($request->user_id) || ($request->user_id == null)) {
            return response()->json(["status" => "0", "error" => "The user_id field is required"]);
        } else {
            $workout = Workout::where('id', '=', $request->input('workout_id'))->first();
            if (!is_null($workout)) {

                $workoutUser = WorkoutUser::where('workout_id', $workout->id)
                    ->where('user_id', $request->user_id)
                    ->where('category', $request->category)
                    ->first();

                if (!is_null($workoutUser)) {
                    $workoutUser->update(['is_stared' => 1]);
                } else {
                    return response()->json(['status' => 0, 'error' => 'You need to complete this workout to star.'], 422);
                }

                return response()->json(['status' => 1, 'success' => 'Successfully stared.'], 200);
            } else {
                return response()->json(['status' => 0, 'error' => 'workout_not_exists'], 500);
            }
        }
    }
}
