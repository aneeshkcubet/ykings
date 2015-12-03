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
     * @api {post} /exercise/list loadExercises
     * @apiName loadExercises
     * @apiGroup Exercise
     * @apiParam {Number} user_id Id of user 
     * @apiSuccess {String} success.
     * @apiSuccessExample Success-Response:
     * HTTP/1.1 200 OK
     * {
          "status": 1,
          "is_subscribed" : 1,
          "exercises": {
            "beginer": {
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
            "advanced": {
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
            "professional": {
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

                $leanExercisesFree = Exercise::where('category', '=', 1)->where('type', '=', 1)->with(['video'])->get();
                $athleticExercisesFree = Exercise::where('category', '=', 2)->where('type', '=', 1)->with(['video'])->get();
                $strongExercisesFree = Exercise::where('category', '=', 3)->where('type', '=', 1)->with(['video'])->get();
                $leanExercisesPaid = Exercise::where('category', '=', 1)->where('type', '=', 2)->with(['video'])->get();
                $athleticExercisesPaid = Exercise::where('category', '=', 2)->where('type', '=', 2)->with(['video'])->get();
                $strongExercisesPaid = Exercise::where('category', '=', 3)->where('type', '=', 2)->with(['video'])->get();

                $exercises['beginer'] = ['free' => $leanExercisesFree, 'paid' => $leanExercisesPaid];
                $exercises['advanced'] = ['free' => $athleticExercisesFree, 'paid' => $athleticExercisesPaid];
                $exercises['professional'] = ['free' => $strongExercisesFree, 'paid' => $strongExercisesPaid];
                
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
     * @apiParam {Number} exercise_id Id of exercise 
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
            "users": []
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
