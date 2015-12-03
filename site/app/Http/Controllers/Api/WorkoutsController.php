<?php namespace App\Http\Controllers\Api;

use Auth,
    Validator;
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
      "is_subscribed": 1,
      "exercises": {
      "beginer": [
      {
      "id": "1",
      "name": "Jumping Pullups",
      "description": "The jumping pull-up is a challenging full body exercise that targets the back, legs and arms.",
      "category": "1",
      "type": "1",
      "rewards": "6.00",
      "repititions": "10",
      "duration": "1.00",
      "equipment": "",
      "created_at": "2015-11-17 13:30:19",
      "updated_at": "2015-11-17 13:30:19",
      "video": [
      {
      "id": "1",
      "user_id": "1",
      "path": "Now1.mp4",
      "description": "Test Description",
      "parent_type": "1",
      "type": "1",
      "parent_id": "1",
      "created_at": "2015-11-11 07:26:40",
      "updated_at": "2015-11-11 17:43:27"
      }
      ]
      }
      ],
      "advanced": [
      {
      "id": "1",
      "name": "Jumping Pullups",
      "description": "The jumping pull-up is a challenging full body exercise that targets the back, legs and arms.",
      "category": "1",
      "type": "1",
      "rewards": "6.00",
      "repititions": "10",
      "duration": "1.00",
      "equipment": "",
      "created_at": "2015-11-17 13:30:19",
      "updated_at": "2015-11-17 13:30:19",
      "video": [
      {
      "id": "1",
      "user_id": "1",
      "path": "Now1.mp4",
      "description": "Test Description",
      "parent_type": "1",
      "type": "1",
      "parent_id": "1",
      "created_at": "2015-11-11 07:26:40",
      "updated_at": "2015-11-11 17:43:27"
      }
      ]
      }
      ],
      "professional": [
      {
      "id": "1",
      "name": "Jumping Pullups",
      "description": "The jumping pull-up is a challenging full body exercise that targets the back, legs and arms.",
      "category": "1",
      "type": "1",
      "rewards": "6.00",
      "repititions": "10",
      "duration": "1.00",
      "equipment": "",
      "created_at": "2015-11-17 13:30:19",
      "updated_at": "2015-11-17 13:30:19",
      "video": [
      {
      "id": "1",
      "user_id": "1",
      "path": "Now1.mp4",
      "description": "Test Description",
      "parent_type": "1",
      "type": "1",
      "parent_id": "1",
      "created_at": "2015-11-11 07:26:40",
      "updated_at": "2015-11-11 17:43:27"
      }
      ]
      }
      ]
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
        $workoutResponse = array();
        if (!isset($request->user_id) || ($request->user_id == null)) {
            return response()->json(["status" => "0", "error" => "The user_id field is required"]);
        } else {
            $user = User::where('id', '=', $request->input('user_id'))->first();
            if (!is_null($user)) {

                $workouts = Workout::all();
                if (!is_null($workouts)) {
                    foreach ($workouts as $workoutArray) {
                        $workoutResponse[] = $workoutArray;
                        $workoutArray['lean'] = Workoutexercise::where('workout_id', $workoutArray['id'])
                            ->where('category', 1)
                            ->get(['exercise_id', 'unit', 'repititions', 'round']);
                        $workoutArray['athletic'] = Workoutexercise::where('workout_id', $workoutArray['id'])
                            ->where('category', 2)
                            -> get(['exercise_id', 'unit', 'repititions', 'round']);
                        $workoutArray['strength'] = Workoutexercise::where('workout_id', $workoutArray['id'])
                            ->where('category', 3) 
                            -> get(['exercise_id', 'unit', 'repititions', 'round']);
                        unset($workoutArray);
                    }
                }
                return response()->json([
                        'status' => 1,
                        'is_subscribed' => $user->is_subscribed,
                        'workouts' => $workoutResponse], 200);
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
      "created_at": "2015-11-18 18:30:00",
      "updated_at": "2015-11-19 11:13:13",
      "beginer": [],
      "advanced": [
      {
      "id": "1",
      "workout_id": "2",
      "user_id": "2",
      "status": "1",
      "time": "33",
      "is_starred": "0",
      "created_at": "2015-11-20 05:04:13",
      "updated_at": "2015-11-20 05:04:13",
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
      "city": "",
      "state": "",
      "country": "",
      "spot": "",
      "quote": "I want to get Strong",
      "created_at": "2015-11-09 09:14:02",
      "updated_at": "2015-11-09 10:16:07"
      }
      }
      ],
      "professional": []
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
        if (!isset($request->workout_id) || ($request->workout_id == null)) {
            return response()->json(["status" => "0", "error" => "The workout_id field is required"]);
        } else {
            $workout = Workout::where('id', '=', $request->input('workout_id'))->first();
            if (!is_null($workout)) {
                $workoutArray = $workout->toArray();
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
                $subscription = DB::table('subscriptions')
                    ->select('*')
                    ->where('user_id', '=', $userId)
                    ->orderBy('id', 'DESC')
                    ->first();
                if (is_null($subscription)) {
                    $isSubscribed = 0;
                }

                if ($subscription->end_time <= $time) {
                    $isSubscribed = 0;
                } else {
                    $isSubscribed = 1;
                }

                $workoutArray['beginer'] = [];
                $workoutArray['advanced'] = [];
                $workoutArray['professional'] = [];

                $workoutArray['beginer'] = $leanWorkoutUsers->toArray();
                $workoutArray['advanced'] = $athleteWorkoutUsers->toArray();
                $workoutArray['professional'] = $strengthWorkoutUsers->toArray();

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
     * @apiParam {Number} category of workout 1-beginer, 2-advanced, 3-professional
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
     * @apiParam {Number} category of workout *required 1-beginer, 2-advanced, 3-professional
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
