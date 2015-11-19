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
     * @api {post} /workout/list loadWorkouts
     * @apiName loadWorkouts
     * @apiGroup Workouts
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
    public function loadExercises(Request $request)
    {
        if (!isset($request->user_id) || ($request->user_id == null)) {
            return response()->json(["status" => "0", "error" => "The user_id field is required"]);
        } else {
            $user = User::where('id', '=', $request->input('user_id'))->first();
            if (!is_null($user)) {
                if ($user->is_subscribed == 1) {
                    $leanExercises = Exercise::where('category', '=', 1)->with(['video'])->get();
                    $athleticExercises = Exercise::where('category', '=', 2)->with(['video'])->get();
                    $strongExercises = Exercise::where('category', '=', 3)->with(['video'])->get();
                } else {
                    $leanExercises = Exercise::where('category', '=', 1)->where('type', '=', 1)->with(['video'])->get();
                    $athleticExercises = Exercise::where('category', '=', 2)->where('type', '=', 2)->with(['video'])->get();
                    $strongExercises = Exercise::where('category', '=', 3)->where('type', '=', 3)->with(['video'])->get();
                }
                return response()->json(['status' => 1, 'exercises' => ['beginer' => $leanExercises, 'advanced' => $athleticExercises, 'professional' => $strongExercises], 'urls' => config('urls.urls')], 200);
            } else {
                return response()->json(['status' => 0, 'error' => 'user_not_exists'], 500);
            }
        }
    }    

    /**
     * @api {post} /exercise/getwithusers getExerciseWithUsers
     * @apiName getExerciseWithUsers
     * @apiGroup Exercise
     * @apiParam {Number} exercise_id Id of exercise 
     * @apiSuccess {String} success.
     * @apiSuccessExample Success-Response:
     * HTTP/1.1 200 OK
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
    public function getExerciseWithUsers(Request $request)
    {
        if (!isset($request->exercise_id) || ($request->exercise_id == null)) {
            return response()->json(["status" => "0", "error" => "The exercise_id field is required"]);
        } else {
            $exercise = Exercise::where('id', '=', $request->input('exercise_id'))->first();            
            
            if (!is_null($exercise)) {
                $exerciseArray = $exercise->toArray();
                $exerciseUsers = ExerciseUser::where('exercise_id', '=', $request->input('exercise_id'))
                    ->where('status', '=', 1)
                    ->with(['profile'])
                    ->get();
                $exerciseArray['users'] = $exerciseUsers->toArray();
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
     * @apiParam {Number} exercise_id Id of exercise 
     * @apiSuccess {String} success.
     * @apiSuccessExample Success-Response:
     * HTTP/1.1 200 OK
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
