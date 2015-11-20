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
        if (!isset($request->user_id) || ($request->user_id == null)) {
            return response()->json(["status" => "0", "error" => "The user_id field is required"]);
        } else {
            $user = User::where('id', '=', $request->input('user_id'))->first();
            if (!is_null($user)) {

                $workouts = Workout::all();

                return response()->json([
                        'status' => 1,
                        'is_subscribed' => $user->is_subscribed,
                        'workouts' => $workouts], 200);
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
          "feedImageOriginal": "http://sandbox.ykings.com/uploads/images/feed/original"
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
                    ->get();
                $athleteWorkoutUsers = WorkoutUser::where('category', '=', 2)
                    ->where('workout_id', '=', $request->workout_id)
                    ->where('status', '=', 1)
                    ->with(['profile'])
                    ->get();
                $strengthWorkoutUsers = WorkoutUser::where('category', '=', 3)
                    ->where('workout_id', '=', $request->workout_id)
                    ->where('status', '=', 1)
                    ->with(['profile'])
                    ->get();
                
                $workoutArray['beginer'] = $leanWorkoutUsers->toArray();
                $workoutArray['advanced'] = $athleteWorkoutUsers->toArray();
                $workoutArray['professional'] = $strengthWorkoutUsers->toArray();

                return response()->json(['status' => 1, 'workout' => $workoutArray, 'urls' => config('urls.urls')], 200);
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
          "exercises": [
            {
              "id": "16",
              "workout_id": "1",
              "category": "2",
              "repititions": "50",
              "exercise_id": "32",
              "unit": "",
              "round": "1",
              "created_at": "2015-11-18 18:30:00",
              "updated_at": "2015-11-19 10:00:00"
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
          "feedImageOriginal": "http://sandbox.ykings.com/uploads/images/feed/original"
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
                $workoutArray = $workout->toArray();
                
                $workoutExercises = Workoutexercise::where('category', '=', $request->category)->get();
                
                $workoutArray['exercises'] = $workoutExercises->toArray();
                
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
                
                if(!is_null($workoutUser)){
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
