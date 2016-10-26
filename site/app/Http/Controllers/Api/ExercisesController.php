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
     * 
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
      "video": [
      {
      "id": "78",
      "path": "78_1454045971.mp4",
      "videothumbnail": "78_1454045971.jpg",
      "description": "Australian Pullups"
      }
      ],
      "leaderboard": {
      "1": {
      "1": {
      "users": [
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
      "updated_at": "2016-07-20 06:48:48",
      "profile": {
      "id": "99",
      "user_id": "100",
      "first_name": "Aneesh",
      "last_name": "k test",
      "gender": "1",
      "fitness_status": "2",
      "goal": "3",
      "image": "",
      "cover_image": "",
      "city": "",
      "state": "",
      "country": "",
      "spot": "",
      "quote": "????? ",
      "facebook": "",
      "twitter": "",
      "instagram": "",
      "created_at": "2016-03-18 09:17:57",
      "updated_at": "2016-07-12 11:46:41",
      "level": 12
      }
      }
      ],
      "personal_best": "5"
      },
      "3": {
      "users": [],
      "personal_best": ""
      },
      "5": {
      "users": [],
      "personal_best": ""
      },
      "8": {
      "users": [],
      "personal_best": ""
      },
      "10": {
      "users": [],
      "personal_best": ""
      },
      "12": {
      "users": [],
      "personal_best": ""
      },
      "15": {
      "users": [
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
      "updated_at": "2016-07-20 06:52:33",
      "profile": {
      "id": "99",
      "user_id": "100",
      "first_name": "Aneesh",
      "last_name": "k test",
      "gender": "1",
      "fitness_status": "2",
      "goal": "3",
      "image": "",
      "cover_image": "",
      "city": "",
      "state": "",
      "country": "",
      "spot": "",
      "quote": "????? ",
      "facebook": "",
      "twitter": "",
      "instagram": "",
      "created_at": "2016-03-18 09:17:57",
      "updated_at": "2016-07-12 11:46:41",
      "level": 12
      }
      }
      ],
      "personal_best": "5"
      },
      "20": {
      "users": [],
      "personal_best": ""
      }
      },
      "2": {
      "1": {
      "users": [
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
      "updated_at": "2016-07-20 06:48:57",
      "profile": {
      "id": "99",
      "user_id": "100",
      "first_name": "Aneesh",
      "last_name": "k test",
      "gender": "1",
      "fitness_status": "2",
      "goal": "3",
      "image": "",
      "cover_image": "",
      "city": "",
      "state": "",
      "country": "",
      "spot": "",
      "quote": "????? ",
      "facebook": "",
      "twitter": "",
      "instagram": "",
      "created_at": "2016-03-18 09:17:57",
      "updated_at": "2016-07-12 11:46:41",
      "level": 12
      }
      }
      ],
      "personal_best": "5"
      },
      "3": {
      "users": [],
      "personal_best": ""
      },
      "5": {
      "users": [
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
      "updated_at": "2016-07-20 06:50:58",
      "profile": {
      "id": "99",
      "user_id": "100",
      "first_name": "Aneesh",
      "last_name": "k test",
      "gender": "1",
      "fitness_status": "2",
      "goal": "3",
      "image": "",
      "cover_image": "",
      "city": "",
      "state": "",
      "country": "",
      "spot": "",
      "quote": "????? ",
      "facebook": "",
      "twitter": "",
      "instagram": "",
      "created_at": "2016-03-18 09:17:57",
      "updated_at": "2016-07-12 11:46:41",
      "level": 12
      }
      }
      ],
      "personal_best": "5"
      },
      "8": {
      "users": [],
      "personal_best": ""
      },
      "10": {
      "users": [],
      "personal_best": ""
      },
      "12": {
      "users": [],
      "personal_best": ""
      },
      "15": {
      "users": [],
      "personal_best": ""
      },
      "20": {
      "users": [],
      "personal_best": ""
      }
      },
      "3": {
      "1": {
      "users": [
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
      "updated_at": "2016-07-20 06:49:01",
      "profile": {
      "id": "99",
      "user_id": "100",
      "first_name": "Aneesh",
      "last_name": "k test",
      "gender": "1",
      "fitness_status": "2",
      "goal": "3",
      "image": "",
      "cover_image": "",
      "city": "",
      "state": "",
      "country": "",
      "spot": "",
      "quote": "????? ",
      "facebook": "",
      "twitter": "",
      "instagram": "",
      "created_at": "2016-03-18 09:17:57",
      "updated_at": "2016-07-12 11:46:41",
      "level": 12
      }
      }
      ],
      "personal_best": "5"
      },
      "3": {
      "users": [
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
      "updated_at": "2016-07-20 06:49:49",
      "profile": {
      "id": "99",
      "user_id": "100",
      "first_name": "Aneesh",
      "last_name": "k test",
      "gender": "1",
      "fitness_status": "2",
      "goal": "3",
      "image": "",
      "cover_image": "",
      "city": "",
      "state": "",
      "country": "",
      "spot": "",
      "quote": "????? ",
      "facebook": "",
      "twitter": "",
      "instagram": "",
      "created_at": "2016-03-18 09:17:57",
      "updated_at": "2016-07-12 11:46:41",
      "level": 12
      }
      }
      ],
      "personal_best": "5"
      },
      "5": {
      "users": [
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
      "updated_at": "2016-07-20 06:51:02",
      "profile": {
      "id": "99",
      "user_id": "100",
      "first_name": "Aneesh",
      "last_name": "k test",
      "gender": "1",
      "fitness_status": "2",
      "goal": "3",
      "image": "",
      "cover_image": "",
      "city": "",
      "state": "",
      "country": "",
      "spot": "",
      "quote": "????? ",
      "facebook": "",
      "twitter": "",
      "instagram": "",
      "created_at": "2016-03-18 09:17:57",
      "updated_at": "2016-07-12 11:46:41",
      "level": 12
      }
      }
      ],
      "personal_best": "5"
      },
      "8": {
      "users": [],
      "personal_best": ""
      },
      "10": {
      "users": [],
      "personal_best": ""
      },
      "12": {
      "users": [],
      "personal_best": ""
      },
      "15": {
      "users": [
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
      "updated_at": "2016-07-20 06:52:37",
      "profile": {
      "id": "99",
      "user_id": "100",
      "first_name": "Aneesh",
      "last_name": "k test",
      "gender": "1",
      "fitness_status": "2",
      "goal": "3",
      "image": "",
      "cover_image": "",
      "city": "",
      "state": "",
      "country": "",
      "spot": "",
      "quote": "????? ",
      "facebook": "",
      "twitter": "",
      "instagram": "",
      "created_at": "2016-03-18 09:17:57",
      "updated_at": "2016-07-12 11:46:41",
      "level": 12
      }
      }
      ],
      "personal_best": "5"
      },
      "20": {
      "users": [],
      "personal_best": ""
      }
      },
      "4": {
      "1": {
      "users": [],
      "personal_best": ""
      },
      "3": {
      "users": [],
      "personal_best": ""
      },
      "5": {
      "users": [],
      "personal_best": ""
      },
      "8": {
      "users": [],
      "personal_best": ""
      },
      "10": {
      "users": [],
      "personal_best": ""
      },
      "12": {
      "users": [],
      "personal_best": ""
      },
      "15": {
      "users": [],
      "personal_best": ""
      },
      "20": {
      "users": [],
      "personal_best": ""
      }
      },
      "5": {
      "1": {
      "users": [
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
      "updated_at": "2016-07-20 06:49:07",
      "profile": {
      "id": "99",
      "user_id": "100",
      "first_name": "Aneesh",
      "last_name": "k test",
      "gender": "1",
      "fitness_status": "2",
      "goal": "3",
      "image": "",
      "cover_image": "",
      "city": "",
      "state": "",
      "country": "",
      "spot": "",
      "quote": "????? ",
      "facebook": "",
      "twitter": "",
      "instagram": "",
      "created_at": "2016-03-18 09:17:57",
      "updated_at": "2016-07-12 11:46:41",
      "level": 12
      }
      }
      ],
      "personal_best": "5"
      },
      "3": {
      "users": [
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
      "updated_at": "2016-07-20 06:49:55",
      "profile": {
      "id": "99",
      "user_id": "100",
      "first_name": "Aneesh",
      "last_name": "k test",
      "gender": "1",
      "fitness_status": "2",
      "goal": "3",
      "image": "",
      "cover_image": "",
      "city": "",
      "state": "",
      "country": "",
      "spot": "",
      "quote": "????? ",
      "facebook": "",
      "twitter": "",
      "instagram": "",
      "created_at": "2016-03-18 09:17:57",
      "updated_at": "2016-07-12 11:46:41",
      "level": 12
      }
      }
      ],
      "personal_best": "5"
      },
      "5": {
      "users": [
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
      "updated_at": "2016-07-20 06:51:08",
      "profile": {
      "id": "99",
      "user_id": "100",
      "first_name": "Aneesh",
      "last_name": "k test",
      "gender": "1",
      "fitness_status": "2",
      "goal": "3",
      "image": "",
      "cover_image": "",
      "city": "",
      "state": "",
      "country": "",
      "spot": "",
      "quote": "????? ",
      "facebook": "",
      "twitter": "",
      "instagram": "",
      "created_at": "2016-03-18 09:17:57",
      "updated_at": "2016-07-12 11:46:41",
      "level": 12
      }
      }
      ],
      "personal_best": "5"
      },
      "8": {
      "users": [],
      "personal_best": ""
      },
      "10": {
      "users": [],
      "personal_best": ""
      },
      "12": {
      "users": [],
      "personal_best": ""
      },
      "15": {
      "users": [],
      "personal_best": ""
      },
      "20": {
      "users": [],
      "personal_best": ""
      }
      },
      "6": {
      "1": {
      "users": [
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
      "updated_at": "2016-07-20 06:49:13",
      "profile": {
      "id": "99",
      "user_id": "100",
      "first_name": "Aneesh",
      "last_name": "k test",
      "gender": "1",
      "fitness_status": "2",
      "goal": "3",
      "image": "",
      "cover_image": "",
      "city": "",
      "state": "",
      "country": "",
      "spot": "",
      "quote": "????? ",
      "facebook": "",
      "twitter": "",
      "instagram": "",
      "created_at": "2016-03-18 09:17:57",
      "updated_at": "2016-07-12 11:46:41",
      "level": 12
      }
      }
      ],
      "personal_best": "5"
      },
      "3": {
      "users": [
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
      "updated_at": "2016-07-20 06:50:05",
      "profile": {
      "id": "99",
      "user_id": "100",
      "first_name": "Aneesh",
      "last_name": "k test",
      "gender": "1",
      "fitness_status": "2",
      "goal": "3",
      "image": "",
      "cover_image": "",
      "city": "",
      "state": "",
      "country": "",
      "spot": "",
      "quote": "????? ",
      "facebook": "",
      "twitter": "",
      "instagram": "",
      "created_at": "2016-03-18 09:17:57",
      "updated_at": "2016-07-12 11:46:41",
      "level": 12
      }
      }
      ],
      "personal_best": "5"
      },
      "5": {
      "users": [],
      "personal_best": ""
      },
      "8": {
      "users": [],
      "personal_best": ""
      },
      "10": {
      "users": [],
      "personal_best": ""
      },
      "12": {
      "users": [],
      "personal_best": ""
      },
      "15": {
      "users": [],
      "personal_best": ""
      },
      "20": {
      "users": [],
      "personal_best": ""
      }
      },
      "7": {
      "1": {
      "users": [],
      "personal_best": ""
      },
      "3": {
      "users": [],
      "personal_best": ""
      },
      "5": {
      "users": [],
      "personal_best": ""
      },
      "8": {
      "users": [],
      "personal_best": ""
      },
      "10": {
      "users": [],
      "personal_best": ""
      },
      "12": {
      "users": [],
      "personal_best": ""
      },
      "15": {
      "users": [],
      "personal_best": ""
      },
      "20": {
      "users": [],
      "personal_best": ""
      }
      },
      "8": {
      "1": {
      "users": [
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
      "updated_at": "2016-07-20 06:49:18",
      "profile": {
      "id": "99",
      "user_id": "100",
      "first_name": "Aneesh",
      "last_name": "k test",
      "gender": "1",
      "fitness_status": "2",
      "goal": "3",
      "image": "",
      "cover_image": "",
      "city": "",
      "state": "",
      "country": "",
      "spot": "",
      "quote": "????? ",
      "facebook": "",
      "twitter": "",
      "instagram": "",
      "created_at": "2016-03-18 09:17:57",
      "updated_at": "2016-07-12 11:46:41",
      "level": 12
      }
      }
      ],
      "personal_best": "5"
      },
      "3": {
      "users": [],
      "personal_best": ""
      },
      "5": {
      "users": [],
      "personal_best": ""
      },
      "8": {
      "users": [],
      "personal_best": ""
      },
      "10": {
      "users": [],
      "personal_best": ""
      },
      "12": {
      "users": [],
      "personal_best": ""
      },
      "15": {
      "users": [
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
      "updated_at": "2016-07-20 06:53:04",
      "profile": {
      "id": "99",
      "user_id": "100",
      "first_name": "Aneesh",
      "last_name": "k test",
      "gender": "1",
      "fitness_status": "2",
      "goal": "3",
      "image": "",
      "cover_image": "",
      "city": "",
      "state": "",
      "country": "",
      "spot": "",
      "quote": "????? ",
      "facebook": "",
      "twitter": "",
      "instagram": "",
      "created_at": "2016-03-18 09:17:57",
      "updated_at": "2016-07-12 11:46:41",
      "level": 12
      }
      }
      ],
      "personal_best": "5"
      },
      "20": {
      "users": [],
      "personal_best": ""
      }
      },
      "9": {
      "1": {
      "users": [
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
      "updated_at": "2016-07-20 06:49:28",
      "profile": {
      "id": "99",
      "user_id": "100",
      "first_name": "Aneesh",
      "last_name": "k test",
      "gender": "1",
      "fitness_status": "2",
      "goal": "3",
      "image": "",
      "cover_image": "",
      "city": "",
      "state": "",
      "country": "",
      "spot": "",
      "quote": "????? ",
      "facebook": "",
      "twitter": "",
      "instagram": "",
      "created_at": "2016-03-18 09:17:57",
      "updated_at": "2016-07-12 11:46:41",
      "level": 12
      }
      }
      ],
      "personal_best": "5"
      },
      "3": {
      "users": [
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
      "updated_at": "2016-07-20 06:50:09",
      "profile": {
      "id": "99",
      "user_id": "100",
      "first_name": "Aneesh",
      "last_name": "k test",
      "gender": "1",
      "fitness_status": "2",
      "goal": "3",
      "image": "",
      "cover_image": "",
      "city": "",
      "state": "",
      "country": "",
      "spot": "",
      "quote": "????? ",
      "facebook": "",
      "twitter": "",
      "instagram": "",
      "created_at": "2016-03-18 09:17:57",
      "updated_at": "2016-07-12 11:46:41",
      "level": 12
      }
      }
      ],
      "personal_best": "5"
      },
      "5": {
      "users": [],
      "personal_best": ""
      },
      "8": {
      "users": [],
      "personal_best": ""
      },
      "10": {
      "users": [],
      "personal_best": ""
      },
      "12": {
      "users": [],
      "personal_best": ""
      },
      "15": {
      "users": [],
      "personal_best": ""
      },
      "20": {
      "users": [],
      "personal_best": ""
      }
      },
      "10": {
      "1": {
      "users": [
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
      "updated_at": "2016-07-20 06:49:33",
      "profile": {
      "id": "99",
      "user_id": "100",
      "first_name": "Aneesh",
      "last_name": "k test",
      "gender": "1",
      "fitness_status": "2",
      "goal": "3",
      "image": "",
      "cover_image": "",
      "city": "",
      "state": "",
      "country": "",
      "spot": "",
      "quote": "????? ",
      "facebook": "",
      "twitter": "",
      "instagram": "",
      "created_at": "2016-03-18 09:17:57",
      "updated_at": "2016-07-12 11:46:41",
      "level": 12
      }
      }
      ],
      "personal_best": "5"
      },
      "3": {
      "users": [
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
      "updated_at": "2016-07-20 06:50:14",
      "profile": {
      "id": "99",
      "user_id": "100",
      "first_name": "Aneesh",
      "last_name": "k test",
      "gender": "1",
      "fitness_status": "2",
      "goal": "3",
      "image": "",
      "cover_image": "",
      "city": "",
      "state": "",
      "country": "",
      "spot": "",
      "quote": "????? ",
      "facebook": "",
      "twitter": "",
      "instagram": "",
      "created_at": "2016-03-18 09:17:57",
      "updated_at": "2016-07-12 11:46:41",
      "level": 12
      }
      }
      ],
      "personal_best": "5"
      },
      "5": {
      "users": [
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
      "updated_at": "2016-07-20 06:52:07",
      "profile": {
      "id": "99",
      "user_id": "100",
      "first_name": "Aneesh",
      "last_name": "k test",
      "gender": "1",
      "fitness_status": "2",
      "goal": "3",
      "image": "",
      "cover_image": "",
      "city": "",
      "state": "",
      "country": "",
      "spot": "",
      "quote": "????? ",
      "facebook": "",
      "twitter": "",
      "instagram": "",
      "created_at": "2016-03-18 09:17:57",
      "updated_at": "2016-07-12 11:46:41",
      "level": 12
      }
      }
      ],
      "personal_best": "5"
      },
      "8": {
      "users": [],
      "personal_best": ""
      },
      "10": {
      "users": [],
      "personal_best": ""
      },
      "12": {
      "users": [],
      "personal_best": ""
      },
      "15": {
      "users": [],
      "personal_best": ""
      },
      "20": {
      "users": [],
      "personal_best": ""
      }
      }
      }
      },
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

            $arr1 = Array(1, 3, 5, 8, 10, 12, 15, 20);

            $arr2 = Array(5, 10, 15, 20, 30, 45, 60, 90, 120);

            if ($exercise->unit == 'seconds') {
                $volumeArray = $arr2;
            } else {
                $volumeArray = $arr1;
            }

            if (!is_null($exercise)) {

                $exerciseArray = $exercise->toArray();

                $leaderBoard = Array();

                for ($i = 1; $i <= 10; $i++) {
                    foreach ($volumeArray as $vKey => $volume1) {
                        $exerciseUsers = ExerciseUser::where('exercise_id', '=', $request->input('exercise_id'))
                            ->where('status', '=', 1)
                            ->where('volume', '=', $volume1)
                            ->where('sets', '=', $i)
                            ->with(['profile'])
                            ->groupBy('user_id')
                            ->orderBy('time', 'ASC')
                            ->take(15)
                            ->get();

                        $leaderBoard[$i][$volume1]['users'] = $exerciseUsers->toArray();

                        $personalBest = DB::table('exercise_users')->where('exercise_id', '=', $request->input('exercise_id'))
                            ->where('status', '=', 1)
                            ->where('volume', '=', $volume1)
                            ->where('sets', '=', $i)
                            ->where('user_id', '=', $request->user_id)
                            ->groupBy('user_id')
                            ->orderBy('time', 'ASC')
                            ->pluck('time');

                        if (!is_null($personalBest)) {
                            $leaderBoard[$i][$volume1]['personal_best'] = $personalBest;
                        } else {
                            $leaderBoard[$i][$volume1]['personal_best'] = '';
                        }
                        unset($exerciseUsers);
                        unset($personalBest);
                    }
                }

                $exerciseArray['leaderboard'] = $leaderBoard;

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
      "video": [
      {
      "id": "1",
      "path": "1_1453976681.mp4",
      "videothumbnail": "1_1453976681.jpg",
      "description": "Side Plank"
      }
      ]
      },
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
