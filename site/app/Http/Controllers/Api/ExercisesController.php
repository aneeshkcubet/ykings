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
use App\Comment;
use App\Exercise;

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
     * @api {post} /exercises/list loadExercises
     * @apiName loadExercises
     * @apiGroup Exercise
     * @apiParam {Number} user_id Id of user 
     * @apiSuccess {String} success.
     * @apiSuccessExample Success-Response:
     * HTTP/1.1 200 OK
     * {
            "status": 1,
            "exercises": [
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
                },
                {
                    "id": "2",
                    "name": "Australian Pullups",
                    "description": "Australian pull-ups are becoming a very popular exercise. Like all types of pull-ups (and all types of exercises for that matter) there are many different ways to do the Australian, and it can be incorporated into a number of different contexts within a workout.",
                    "category": "1",
                    "type": "1",
                    "rewards": "6.00",
                    "repititions": "10",
                    "duration": "1.00",
                    "equipment": "",
                    "created_at": "2015-11-17 13:30:20",
                    "updated_at": "2015-11-17 13:30:20",
                    "video": []
                }
           ]
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
                    $exercises = Exercise::all()->with(['video']);
                } else {
                    $exercises = Exercise::where('type', '=', 1)->with(['video'])->get();
                }
                return response()->json(['status' => 1, 'exercises' => $exercises->toArray(), 'urls' => config('urls.urls')], 200);
            } else {
                return response()->json(['status' => 0, 'error' => 'user_not_exists'], 500);
            }
        }
    }
}
