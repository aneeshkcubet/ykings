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
     * @apiParam {Number} user_id Id of user *required
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
     * @apiParam {Number} workout_id Id of workout *required
     * @apiParam {Number} user_d Id of user *required
     * @apiSuccess {String} success.
     * @apiSuccessExample Success-Response:
     * HTTP/1.1 200 OK
     * {
  "status": 1,
  "is_subscribed": 0,
  "workout": {
    "id": "2",
    "name": "Borr",
    "description": "",
    "rounds": "3",
    "category": "2",
    "type": "1",
    "rewards": {
      "lean": "330",
      "athletic": "440",
      "strength": "550"
    },
    "duration": "1140.00",
    "equipments": "Bar",
    "lean": {
      "1": {
        "featured": [
          {
            "id": "1",
            "workout_id": "2",
            "user_id": "3",
            "status": "1",
            "time": "6",
            "is_starred": "0",
            "volume": "1",
            "focus": "1",
            "feed_id": "3",
            "is_coach": "0",
            "coach_rounds": "0",
            "created_at": "2016-01-22 14:28:04",
            "updated_at": "2016-01-28 07:11:20",
            "category": "2",
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
          },
          {
            "id": "9",
            "workout_id": "2",
            "user_id": "15",
            "status": "1",
            "time": "24",
            "is_starred": "0",
            "volume": "1",
            "focus": "1",
            "feed_id": "38",
            "is_coach": "0",
            "coach_rounds": "0",
            "created_at": "2016-01-27 03:53:35",
            "updated_at": "2016-01-28 07:11:20",
            "category": "2",
            "profile": {
              "id": "15",
              "user_id": "15",
              "first_name": "Aneesh ",
              "last_name": "Ileaf ",
              "gender": "0",
              "fitness_status": "1",
              "goal": "1",
              "image": "15_1454308286.jpg",
              "cover_image": "15_1454321250.jpg",
              "city": "",
              "state": "",
              "country": "",
              "spot": "",
              "quote": "Good management is what happens when the manager is not there. :) :)",
              "facebook": "",
              "twitter": "",
              "instagram": "",
              "created_at": "2016-01-27 03:49:19",
              "updated_at": "2016-02-01 10:07:30",
              "level": 14
            }
          }
        ],
        "following": [
          {
            "id": "47",
            "workout_id": "2",
            "user_id": "15",
            "status": "1",
            "time": "1",
            "is_starred": "0",
            "volume": "1",
            "focus": "1",
            "feed_id": "330",
            "is_coach": "0",
            "coach_rounds": "0",
            "created_at": "2016-02-04 04:48:38",
            "updated_at": "2016-02-04 04:48:38",
            "category": "1",
            "profile": {
              "id": "15",
              "user_id": "15",
              "first_name": "Aneesh ",
              "last_name": "Ileaf ",
              "gender": "0",
              "fitness_status": "1",
              "goal": "1",
              "image": "15_1454308286.jpg",
              "cover_image": "15_1454321250.jpg",
              "city": "",
              "state": "",
              "country": "",
              "spot": "",
              "quote": "Good management is what happens when the manager is not there. :) :)",
              "facebook": "",
              "twitter": "",
              "instagram": "",
              "created_at": "2016-01-27 03:49:19",
              "updated_at": "2016-02-01 10:07:30",
              "level": 14
            }
          },
          {
            "id": "4",
            "workout_id": "2",
            "user_id": "3",
            "status": "1",
            "time": "4",
            "is_starred": "0",
            "volume": "1",
            "focus": "1",
            "feed_id": "7",
            "is_coach": "0",
            "coach_rounds": "0",
            "created_at": "2016-01-22 14:47:39",
            "updated_at": "2016-01-28 07:11:20",
            "category": "2",
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
          },
          {
            "id": "37",
            "workout_id": "2",
            "user_id": "15",
            "status": "1",
            "time": "5",
            "is_starred": "0",
            "volume": "1",
            "focus": "1",
            "feed_id": "222",
            "is_coach": "0",
            "coach_rounds": "0",
            "created_at": "2016-01-29 13:55:06",
            "updated_at": "2016-01-29 13:55:06",
            "category": "1",
            "profile": {
              "id": "15",
              "user_id": "15",
              "first_name": "Aneesh ",
              "last_name": "Ileaf ",
              "gender": "0",
              "fitness_status": "1",
              "goal": "1",
              "image": "15_1454308286.jpg",
              "cover_image": "15_1454321250.jpg",
              "city": "",
              "state": "",
              "country": "",
              "spot": "",
              "quote": "Good management is what happens when the manager is not there. :) :)",
              "facebook": "",
              "twitter": "",
              "instagram": "",
              "created_at": "2016-01-27 03:49:19",
              "updated_at": "2016-02-01 10:07:30",
              "level": 14
            }
          },
          {
            "id": "1",
            "workout_id": "2",
            "user_id": "3",
            "status": "1",
            "time": "6",
            "is_starred": "0",
            "volume": "1",
            "focus": "1",
            "feed_id": "3",
            "is_coach": "0",
            "coach_rounds": "0",
            "created_at": "2016-01-22 14:28:04",
            "updated_at": "2016-01-28 07:11:20",
            "category": "2",
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
          },
          {
            "id": "7",
            "workout_id": "2",
            "user_id": "3",
            "status": "1",
            "time": "9",
            "is_starred": "0",
            "volume": "1",
            "focus": "1",
            "feed_id": "10",
            "is_coach": "0",
            "coach_rounds": "0",
            "created_at": "2016-01-22 15:03:16",
            "updated_at": "2016-01-22 15:25:49",
            "category": "2",
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
          },
          {
            "id": "9",
            "workout_id": "2",
            "user_id": "15",
            "status": "1",
            "time": "24",
            "is_starred": "0",
            "volume": "1",
            "focus": "1",
            "feed_id": "38",
            "is_coach": "0",
            "coach_rounds": "0",
            "created_at": "2016-01-27 03:53:35",
            "updated_at": "2016-01-28 07:11:20",
            "category": "2",
            "profile": {
              "id": "15",
              "user_id": "15",
              "first_name": "Aneesh ",
              "last_name": "Ileaf ",
              "gender": "0",
              "fitness_status": "1",
              "goal": "1",
              "image": "15_1454308286.jpg",
              "cover_image": "15_1454321250.jpg",
              "city": "",
              "state": "",
              "country": "",
              "spot": "",
              "quote": "Good management is what happens when the manager is not there. :) :)",
              "facebook": "",
              "twitter": "",
              "instagram": "",
              "created_at": "2016-01-27 03:49:19",
              "updated_at": "2016-02-01 10:07:30",
              "level": 14
            }
          }
        ],
        "personal_best": ""
      },
      "2": {
        "featured": [],
        "following": [
          {
            "id": "47",
            "workout_id": "2",
            "user_id": "15",
            "status": "1",
            "time": "1",
            "is_starred": "0",
            "volume": "1",
            "focus": "1",
            "feed_id": "330",
            "is_coach": "0",
            "coach_rounds": "0",
            "created_at": "2016-02-04 04:48:38",
            "updated_at": "2016-02-04 04:48:38",
            "category": "1",
            "profile": {
              "id": "15",
              "user_id": "15",
              "first_name": "Aneesh ",
              "last_name": "Ileaf ",
              "gender": "0",
              "fitness_status": "1",
              "goal": "1",
              "image": "15_1454308286.jpg",
              "cover_image": "15_1454321250.jpg",
              "city": "",
              "state": "",
              "country": "",
              "spot": "",
              "quote": "Good management is what happens when the manager is not there. :) :)",
              "facebook": "",
              "twitter": "",
              "instagram": "",
              "created_at": "2016-01-27 03:49:19",
              "updated_at": "2016-02-01 10:07:30",
              "level": 14
            }
          },
          {
            "id": "4",
            "workout_id": "2",
            "user_id": "3",
            "status": "1",
            "time": "4",
            "is_starred": "0",
            "volume": "1",
            "focus": "1",
            "feed_id": "7",
            "is_coach": "0",
            "coach_rounds": "0",
            "created_at": "2016-01-22 14:47:39",
            "updated_at": "2016-01-28 07:11:20",
            "category": "2",
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
          },
          {
            "id": "37",
            "workout_id": "2",
            "user_id": "15",
            "status": "1",
            "time": "5",
            "is_starred": "0",
            "volume": "1",
            "focus": "1",
            "feed_id": "222",
            "is_coach": "0",
            "coach_rounds": "0",
            "created_at": "2016-01-29 13:55:06",
            "updated_at": "2016-01-29 13:55:06",
            "category": "1",
            "profile": {
              "id": "15",
              "user_id": "15",
              "first_name": "Aneesh ",
              "last_name": "Ileaf ",
              "gender": "0",
              "fitness_status": "1",
              "goal": "1",
              "image": "15_1454308286.jpg",
              "cover_image": "15_1454321250.jpg",
              "city": "",
              "state": "",
              "country": "",
              "spot": "",
              "quote": "Good management is what happens when the manager is not there. :) :)",
              "facebook": "",
              "twitter": "",
              "instagram": "",
              "created_at": "2016-01-27 03:49:19",
              "updated_at": "2016-02-01 10:07:30",
              "level": 14
            }
          },
          {
            "id": "1",
            "workout_id": "2",
            "user_id": "3",
            "status": "1",
            "time": "6",
            "is_starred": "0",
            "volume": "1",
            "focus": "1",
            "feed_id": "3",
            "is_coach": "0",
            "coach_rounds": "0",
            "created_at": "2016-01-22 14:28:04",
            "updated_at": "2016-01-28 07:11:20",
            "category": "2",
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
          },
          {
            "id": "7",
            "workout_id": "2",
            "user_id": "3",
            "status": "1",
            "time": "9",
            "is_starred": "0",
            "volume": "1",
            "focus": "1",
            "feed_id": "10",
            "is_coach": "0",
            "coach_rounds": "0",
            "created_at": "2016-01-22 15:03:16",
            "updated_at": "2016-01-22 15:25:49",
            "category": "2",
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
          },
          {
            "id": "9",
            "workout_id": "2",
            "user_id": "15",
            "status": "1",
            "time": "24",
            "is_starred": "0",
            "volume": "1",
            "focus": "1",
            "feed_id": "38",
            "is_coach": "0",
            "coach_rounds": "0",
            "created_at": "2016-01-27 03:53:35",
            "updated_at": "2016-01-28 07:11:20",
            "category": "2",
            "profile": {
              "id": "15",
              "user_id": "15",
              "first_name": "Aneesh ",
              "last_name": "Ileaf ",
              "gender": "0",
              "fitness_status": "1",
              "goal": "1",
              "image": "15_1454308286.jpg",
              "cover_image": "15_1454321250.jpg",
              "city": "",
              "state": "",
              "country": "",
              "spot": "",
              "quote": "Good management is what happens when the manager is not there. :) :)",
              "facebook": "",
              "twitter": "",
              "instagram": "",
              "created_at": "2016-01-27 03:49:19",
              "updated_at": "2016-02-01 10:07:30",
              "level": 14
            }
          }
        ],
        "personal_best": ""
      },
      "3": {
        "featured": [],
        "following": [
          {
            "id": "47",
            "workout_id": "2",
            "user_id": "15",
            "status": "1",
            "time": "1",
            "is_starred": "0",
            "volume": "1",
            "focus": "1",
            "feed_id": "330",
            "is_coach": "0",
            "coach_rounds": "0",
            "created_at": "2016-02-04 04:48:38",
            "updated_at": "2016-02-04 04:48:38",
            "category": "1",
            "profile": {
              "id": "15",
              "user_id": "15",
              "first_name": "Aneesh ",
              "last_name": "Ileaf ",
              "gender": "0",
              "fitness_status": "1",
              "goal": "1",
              "image": "15_1454308286.jpg",
              "cover_image": "15_1454321250.jpg",
              "city": "",
              "state": "",
              "country": "",
              "spot": "",
              "quote": "Good management is what happens when the manager is not there. :) :)",
              "facebook": "",
              "twitter": "",
              "instagram": "",
              "created_at": "2016-01-27 03:49:19",
              "updated_at": "2016-02-01 10:07:30",
              "level": 14
            }
          },
          {
            "id": "4",
            "workout_id": "2",
            "user_id": "3",
            "status": "1",
            "time": "4",
            "is_starred": "0",
            "volume": "1",
            "focus": "1",
            "feed_id": "7",
            "is_coach": "0",
            "coach_rounds": "0",
            "created_at": "2016-01-22 14:47:39",
            "updated_at": "2016-01-28 07:11:20",
            "category": "2",
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
          },
          {
            "id": "37",
            "workout_id": "2",
            "user_id": "15",
            "status": "1",
            "time": "5",
            "is_starred": "0",
            "volume": "1",
            "focus": "1",
            "feed_id": "222",
            "is_coach": "0",
            "coach_rounds": "0",
            "created_at": "2016-01-29 13:55:06",
            "updated_at": "2016-01-29 13:55:06",
            "category": "1",
            "profile": {
              "id": "15",
              "user_id": "15",
              "first_name": "Aneesh ",
              "last_name": "Ileaf ",
              "gender": "0",
              "fitness_status": "1",
              "goal": "1",
              "image": "15_1454308286.jpg",
              "cover_image": "15_1454321250.jpg",
              "city": "",
              "state": "",
              "country": "",
              "spot": "",
              "quote": "Good management is what happens when the manager is not there. :) :)",
              "facebook": "",
              "twitter": "",
              "instagram": "",
              "created_at": "2016-01-27 03:49:19",
              "updated_at": "2016-02-01 10:07:30",
              "level": 14
            }
          },
          {
            "id": "1",
            "workout_id": "2",
            "user_id": "3",
            "status": "1",
            "time": "6",
            "is_starred": "0",
            "volume": "1",
            "focus": "1",
            "feed_id": "3",
            "is_coach": "0",
            "coach_rounds": "0",
            "created_at": "2016-01-22 14:28:04",
            "updated_at": "2016-01-28 07:11:20",
            "category": "2",
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
          },
          {
            "id": "7",
            "workout_id": "2",
            "user_id": "3",
            "status": "1",
            "time": "9",
            "is_starred": "0",
            "volume": "1",
            "focus": "1",
            "feed_id": "10",
            "is_coach": "0",
            "coach_rounds": "0",
            "created_at": "2016-01-22 15:03:16",
            "updated_at": "2016-01-22 15:25:49",
            "category": "2",
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
          },
          {
            "id": "9",
            "workout_id": "2",
            "user_id": "15",
            "status": "1",
            "time": "24",
            "is_starred": "0",
            "volume": "1",
            "focus": "1",
            "feed_id": "38",
            "is_coach": "0",
            "coach_rounds": "0",
            "created_at": "2016-01-27 03:53:35",
            "updated_at": "2016-01-28 07:11:20",
            "category": "2",
            "profile": {
              "id": "15",
              "user_id": "15",
              "first_name": "Aneesh ",
              "last_name": "Ileaf ",
              "gender": "0",
              "fitness_status": "1",
              "goal": "1",
              "image": "15_1454308286.jpg",
              "cover_image": "15_1454321250.jpg",
              "city": "",
              "state": "",
              "country": "",
              "spot": "",
              "quote": "Good management is what happens when the manager is not there. :) :)",
              "facebook": "",
              "twitter": "",
              "instagram": "",
              "created_at": "2016-01-27 03:49:19",
              "updated_at": "2016-02-01 10:07:30",
              "level": 14
            }
          }
        ],
        "personal_best": ""
      }
    },
    "athletic": {
      "1": {
        "featured": [
          {
            "id": "30",
            "workout_id": "2",
            "user_id": "15",
            "status": "1",
            "time": "53",
            "is_starred": "0",
            "volume": "1",
            "focus": "2",
            "feed_id": "174",
            "is_coach": "0",
            "coach_rounds": "0",
            "created_at": "2016-01-28 14:53:23",
            "updated_at": "2016-01-28 14:53:23",
            "category": "2",
            "profile": {
              "id": "15",
              "user_id": "15",
              "first_name": "Aneesh ",
              "last_name": "Ileaf ",
              "gender": "0",
              "fitness_status": "1",
              "goal": "1",
              "image": "15_1454308286.jpg",
              "cover_image": "15_1454321250.jpg",
              "city": "",
              "state": "",
              "country": "",
              "spot": "",
              "quote": "Good management is what happens when the manager is not there. :) :)",
              "facebook": "",
              "twitter": "",
              "instagram": "",
              "created_at": "2016-01-27 03:49:19",
              "updated_at": "2016-02-01 10:07:30",
              "level": 14
            }
          }
        ],
        "following": [
          {
            "id": "33",
            "workout_id": "2",
            "user_id": "15",
            "status": "1",
            "time": "2",
            "is_starred": "0",
            "volume": "1",
            "focus": "2",
            "feed_id": "182",
            "is_coach": "0",
            "coach_rounds": "0",
            "created_at": "2016-01-28 15:22:42",
            "updated_at": "2016-01-28 15:22:42",
            "category": "2",
            "profile": {
              "id": "15",
              "user_id": "15",
              "first_name": "Aneesh ",
              "last_name": "Ileaf ",
              "gender": "0",
              "fitness_status": "1",
              "goal": "1",
              "image": "15_1454308286.jpg",
              "cover_image": "15_1454321250.jpg",
              "city": "",
              "state": "",
              "country": "",
              "spot": "",
              "quote": "Good management is what happens when the manager is not there. :) :)",
              "facebook": "",
              "twitter": "",
              "instagram": "",
              "created_at": "2016-01-27 03:49:19",
              "updated_at": "2016-02-01 10:07:30",
              "level": 14
            }
          },
          {
            "id": "31",
            "workout_id": "2",
            "user_id": "15",
            "status": "1",
            "time": "8",
            "is_starred": "0",
            "volume": "1",
            "focus": "2",
            "feed_id": "175",
            "is_coach": "0",
            "coach_rounds": "0",
            "created_at": "2016-01-28 15:00:31",
            "updated_at": "2016-01-28 15:00:31",
            "category": "2",
            "profile": {
              "id": "15",
              "user_id": "15",
              "first_name": "Aneesh ",
              "last_name": "Ileaf ",
              "gender": "0",
              "fitness_status": "1",
              "goal": "1",
              "image": "15_1454308286.jpg",
              "cover_image": "15_1454321250.jpg",
              "city": "",
              "state": "",
              "country": "",
              "spot": "",
              "quote": "Good management is what happens when the manager is not there. :) :)",
              "facebook": "",
              "twitter": "",
              "instagram": "",
              "created_at": "2016-01-27 03:49:19",
              "updated_at": "2016-02-01 10:07:30",
              "level": 14
            }
          },
          {
            "id": "32",
            "workout_id": "2",
            "user_id": "15",
            "status": "1",
            "time": "21",
            "is_starred": "0",
            "volume": "1",
            "focus": "2",
            "feed_id": "181",
            "is_coach": "0",
            "coach_rounds": "0",
            "created_at": "2016-01-28 15:18:05",
            "updated_at": "2016-01-28 15:18:05",
            "category": "2",
            "profile": {
              "id": "15",
              "user_id": "15",
              "first_name": "Aneesh ",
              "last_name": "Ileaf ",
              "gender": "0",
              "fitness_status": "1",
              "goal": "1",
              "image": "15_1454308286.jpg",
              "cover_image": "15_1454321250.jpg",
              "city": "",
              "state": "",
              "country": "",
              "spot": "",
              "quote": "Good management is what happens when the manager is not there. :) :)",
              "facebook": "",
              "twitter": "",
              "instagram": "",
              "created_at": "2016-01-27 03:49:19",
              "updated_at": "2016-02-01 10:07:30",
              "level": 14
            }
          },
          {
            "id": "30",
            "workout_id": "2",
            "user_id": "15",
            "status": "1",
            "time": "53",
            "is_starred": "0",
            "volume": "1",
            "focus": "2",
            "feed_id": "174",
            "is_coach": "0",
            "coach_rounds": "0",
            "created_at": "2016-01-28 14:53:23",
            "updated_at": "2016-01-28 14:53:23",
            "category": "2",
            "profile": {
              "id": "15",
              "user_id": "15",
              "first_name": "Aneesh ",
              "last_name": "Ileaf ",
              "gender": "0",
              "fitness_status": "1",
              "goal": "1",
              "image": "15_1454308286.jpg",
              "cover_image": "15_1454321250.jpg",
              "city": "",
              "state": "",
              "country": "",
              "spot": "",
              "quote": "Good management is what happens when the manager is not there. :) :)",
              "facebook": "",
              "twitter": "",
              "instagram": "",
              "created_at": "2016-01-27 03:49:19",
              "updated_at": "2016-02-01 10:07:30",
              "level": 14
            }
          }
        ],
        "personal_best": "2"
      },
      "2": {
        "featured": [],
        "following": [],
        "personal_best": "2"
      },
      "3": {
        "featured": [
          {
            "id": "14",
            "workout_id": "2",
            "user_id": "20",
            "status": "1",
            "time": "14",
            "is_starred": "0",
            "volume": "3",
            "focus": "2",
            "feed_id": "67",
            "is_coach": "0",
            "coach_rounds": "0",
            "created_at": "2016-01-27 14:59:50",
            "updated_at": "2016-01-28 07:11:56",
            "category": "2",
            "profile": {
              "id": "20",
              "user_id": "20",
              "first_name": "sreejith",
              "last_name": "iLeaf",
              "gender": "0",
              "fitness_status": "2",
              "goal": "2",
              "image": "20_1453916030.jpg",
              "cover_image": "20_1453916040.jpg",
              "city": "1",
              "state": "",
              "country": "",
              "spot": "2",
              "quote": "33",
              "facebook": "hi",
              "twitter": "fine",
              "instagram": "u",
              "created_at": "2016-01-27 09:45:07",
              "updated_at": "2016-01-27 17:43:58",
              "level": 13
            }
          }
        ],
        "following": [
          {
            "id": "18",
            "workout_id": "2",
            "user_id": "20",
            "status": "1",
            "time": "2",
            "is_starred": "0",
            "volume": "3",
            "focus": "2",
            "feed_id": "90",
            "is_coach": "0",
            "coach_rounds": "0",
            "created_at": "2016-01-27 17:12:57",
            "updated_at": "2016-01-28 07:11:56",
            "category": "2",
            "profile": {
              "id": "20",
              "user_id": "20",
              "first_name": "sreejith",
              "last_name": "iLeaf",
              "gender": "0",
              "fitness_status": "2",
              "goal": "2",
              "image": "20_1453916030.jpg",
              "cover_image": "20_1453916040.jpg",
              "city": "1",
              "state": "",
              "country": "",
              "spot": "2",
              "quote": "33",
              "facebook": "hi",
              "twitter": "fine",
              "instagram": "u",
              "created_at": "2016-01-27 09:45:07",
              "updated_at": "2016-01-27 17:43:58",
              "level": 13
            }
          },
          {
            "id": "19",
            "workout_id": "2",
            "user_id": "20",
            "status": "1",
            "time": "2",
            "is_starred": "0",
            "volume": "3",
            "focus": "2",
            "feed_id": "91",
            "is_coach": "0",
            "coach_rounds": "0",
            "created_at": "2016-01-27 17:13:06",
            "updated_at": "2016-01-28 07:11:56",
            "category": "2",
            "profile": {
              "id": "20",
              "user_id": "20",
              "first_name": "sreejith",
              "last_name": "iLeaf",
              "gender": "0",
              "fitness_status": "2",
              "goal": "2",
              "image": "20_1453916030.jpg",
              "cover_image": "20_1453916040.jpg",
              "city": "1",
              "state": "",
              "country": "",
              "spot": "2",
              "quote": "33",
              "facebook": "hi",
              "twitter": "fine",
              "instagram": "u",
              "created_at": "2016-01-27 09:45:07",
              "updated_at": "2016-01-27 17:43:58",
              "level": 13
            }
          },
          {
            "id": "27",
            "workout_id": "2",
            "user_id": "20",
            "status": "1",
            "time": "10",
            "is_starred": "0",
            "volume": "3",
            "focus": "2",
            "feed_id": "132",
            "is_coach": "0",
            "coach_rounds": "0",
            "created_at": "2016-01-28 07:20:48",
            "updated_at": "2016-01-28 07:20:48",
            "category": "2",
            "profile": {
              "id": "20",
              "user_id": "20",
              "first_name": "sreejith",
              "last_name": "iLeaf",
              "gender": "0",
              "fitness_status": "2",
              "goal": "2",
              "image": "20_1453916030.jpg",
              "cover_image": "20_1453916040.jpg",
              "city": "1",
              "state": "",
              "country": "",
              "spot": "2",
              "quote": "33",
              "facebook": "hi",
              "twitter": "fine",
              "instagram": "u",
              "created_at": "2016-01-27 09:45:07",
              "updated_at": "2016-01-27 17:43:58",
              "level": 13
            }
          },
          {
            "id": "14",
            "workout_id": "2",
            "user_id": "20",
            "status": "1",
            "time": "14",
            "is_starred": "0",
            "volume": "3",
            "focus": "2",
            "feed_id": "67",
            "is_coach": "0",
            "coach_rounds": "0",
            "created_at": "2016-01-27 14:59:50",
            "updated_at": "2016-01-28 07:11:56",
            "category": "2",
            "profile": {
              "id": "20",
              "user_id": "20",
              "first_name": "sreejith",
              "last_name": "iLeaf",
              "gender": "0",
              "fitness_status": "2",
              "goal": "2",
              "image": "20_1453916030.jpg",
              "cover_image": "20_1453916040.jpg",
              "city": "1",
              "state": "",
              "country": "",
              "spot": "2",
              "quote": "33",
              "facebook": "hi",
              "twitter": "fine",
              "instagram": "u",
              "created_at": "2016-01-27 09:45:07",
              "updated_at": "2016-01-27 17:43:58",
              "level": 13
            }
          },
          {
            "id": "15",
            "workout_id": "2",
            "user_id": "20",
            "status": "1",
            "time": "14",
            "is_starred": "0",
            "volume": "3",
            "focus": "2",
            "feed_id": "68",
            "is_coach": "0",
            "coach_rounds": "0",
            "created_at": "2016-01-27 14:59:56",
            "updated_at": "2016-01-28 07:11:56",
            "category": "2",
            "profile": {
              "id": "20",
              "user_id": "20",
              "first_name": "sreejith",
              "last_name": "iLeaf",
              "gender": "0",
              "fitness_status": "2",
              "goal": "2",
              "image": "20_1453916030.jpg",
              "cover_image": "20_1453916040.jpg",
              "city": "1",
              "state": "",
              "country": "",
              "spot": "2",
              "quote": "33",
              "facebook": "hi",
              "twitter": "fine",
              "instagram": "u",
              "created_at": "2016-01-27 09:45:07",
              "updated_at": "2016-01-27 17:43:58",
              "level": 13
            }
          },
          {
            "id": "16",
            "workout_id": "2",
            "user_id": "20",
            "status": "1",
            "time": "14",
            "is_starred": "0",
            "volume": "3",
            "focus": "2",
            "feed_id": "69",
            "is_coach": "0",
            "coach_rounds": "0",
            "created_at": "2016-01-27 15:00:13",
            "updated_at": "2016-01-28 07:11:56",
            "category": "2",
            "profile": {
              "id": "20",
              "user_id": "20",
              "first_name": "sreejith",
              "last_name": "iLeaf",
              "gender": "0",
              "fitness_status": "2",
              "goal": "2",
              "image": "20_1453916030.jpg",
              "cover_image": "20_1453916040.jpg",
              "city": "1",
              "state": "",
              "country": "",
              "spot": "2",
              "quote": "33",
              "facebook": "hi",
              "twitter": "fine",
              "instagram": "u",
              "created_at": "2016-01-27 09:45:07",
              "updated_at": "2016-01-27 17:43:58",
              "level": 13
            }
          },
          {
            "id": "17",
            "workout_id": "2",
            "user_id": "20",
            "status": "1",
            "time": "14",
            "is_starred": "0",
            "volume": "3",
            "focus": "2",
            "feed_id": "70",
            "is_coach": "0",
            "coach_rounds": "0",
            "created_at": "2016-01-27 15:00:20",
            "updated_at": "2016-01-28 07:11:56",
            "category": "2",
            "profile": {
              "id": "20",
              "user_id": "20",
              "first_name": "sreejith",
              "last_name": "iLeaf",
              "gender": "0",
              "fitness_status": "2",
              "goal": "2",
              "image": "20_1453916030.jpg",
              "cover_image": "20_1453916040.jpg",
              "city": "1",
              "state": "",
              "country": "",
              "spot": "2",
              "quote": "33",
              "facebook": "hi",
              "twitter": "fine",
              "instagram": "u",
              "created_at": "2016-01-27 09:45:07",
              "updated_at": "2016-01-27 17:43:58",
              "level": 13
            }
          }
        ],
        "personal_best": "2"
      }
    },
    "strength": {
      "1": {
        "featured": [
          {
            "id": "22",
            "workout_id": "2",
            "user_id": "20",
            "status": "1",
            "time": "16",
            "is_starred": "0",
            "volume": "1",
            "focus": "3",
            "feed_id": "127",
            "is_coach": "0",
            "coach_rounds": "0",
            "created_at": "2016-01-28 06:22:02",
            "updated_at": "2016-01-28 07:12:17",
            "category": "2",
            "profile": {
              "id": "20",
              "user_id": "20",
              "first_name": "sreejith",
              "last_name": "iLeaf",
              "gender": "0",
              "fitness_status": "2",
              "goal": "2",
              "image": "20_1453916030.jpg",
              "cover_image": "20_1453916040.jpg",
              "city": "1",
              "state": "",
              "country": "",
              "spot": "2",
              "quote": "33",
              "facebook": "hi",
              "twitter": "fine",
              "instagram": "u",
              "created_at": "2016-01-27 09:45:07",
              "updated_at": "2016-01-27 17:43:58",
              "level": 13
            }
          }
        ],
        "following": [
          {
            "id": "26",
            "workout_id": "2",
            "user_id": "20",
            "status": "1",
            "time": "3",
            "is_starred": "0",
            "volume": "1",
            "focus": "3",
            "feed_id": "131",
            "is_coach": "0",
            "coach_rounds": "0",
            "created_at": "2016-01-28 07:04:38",
            "updated_at": "2016-01-28 07:12:17",
            "category": "2",
            "profile": {
              "id": "20",
              "user_id": "20",
              "first_name": "sreejith",
              "last_name": "iLeaf",
              "gender": "0",
              "fitness_status": "2",
              "goal": "2",
              "image": "20_1453916030.jpg",
              "cover_image": "20_1453916040.jpg",
              "city": "1",
              "state": "",
              "country": "",
              "spot": "2",
              "quote": "33",
              "facebook": "hi",
              "twitter": "fine",
              "instagram": "u",
              "created_at": "2016-01-27 09:45:07",
              "updated_at": "2016-01-27 17:43:58",
              "level": 13
            }
          },
          {
            "id": "25",
            "workout_id": "2",
            "user_id": "20",
            "status": "1",
            "time": "6",
            "is_starred": "0",
            "volume": "1",
            "focus": "3",
            "feed_id": "130",
            "is_coach": "0",
            "coach_rounds": "0",
            "created_at": "2016-01-28 06:51:02",
            "updated_at": "2016-01-28 07:12:17",
            "category": "2",
            "profile": {
              "id": "20",
              "user_id": "20",
              "first_name": "sreejith",
              "last_name": "iLeaf",
              "gender": "0",
              "fitness_status": "2",
              "goal": "2",
              "image": "20_1453916030.jpg",
              "cover_image": "20_1453916040.jpg",
              "city": "1",
              "state": "",
              "country": "",
              "spot": "2",
              "quote": "33",
              "facebook": "hi",
              "twitter": "fine",
              "instagram": "u",
              "created_at": "2016-01-27 09:45:07",
              "updated_at": "2016-01-27 17:43:58",
              "level": 13
            }
          },
          {
            "id": "22",
            "workout_id": "2",
            "user_id": "20",
            "status": "1",
            "time": "16",
            "is_starred": "0",
            "volume": "1",
            "focus": "3",
            "feed_id": "127",
            "is_coach": "0",
            "coach_rounds": "0",
            "created_at": "2016-01-28 06:22:02",
            "updated_at": "2016-01-28 07:12:17",
            "category": "2",
            "profile": {
              "id": "20",
              "user_id": "20",
              "first_name": "sreejith",
              "last_name": "iLeaf",
              "gender": "0",
              "fitness_status": "2",
              "goal": "2",
              "image": "20_1453916030.jpg",
              "cover_image": "20_1453916040.jpg",
              "city": "1",
              "state": "",
              "country": "",
              "spot": "2",
              "quote": "33",
              "facebook": "hi",
              "twitter": "fine",
              "instagram": "u",
              "created_at": "2016-01-27 09:45:07",
              "updated_at": "2016-01-27 17:43:58",
              "level": 13
            }
          },
          {
            "id": "23",
            "workout_id": "2",
            "user_id": "20",
            "status": "1",
            "time": "16",
            "is_starred": "0",
            "volume": "1",
            "focus": "3",
            "feed_id": "128",
            "is_coach": "0",
            "coach_rounds": "0",
            "created_at": "2016-01-28 06:22:13",
            "updated_at": "2016-01-28 07:12:17",
            "category": "2",
            "profile": {
              "id": "20",
              "user_id": "20",
              "first_name": "sreejith",
              "last_name": "iLeaf",
              "gender": "0",
              "fitness_status": "2",
              "goal": "2",
              "image": "20_1453916030.jpg",
              "cover_image": "20_1453916040.jpg",
              "city": "1",
              "state": "",
              "country": "",
              "spot": "2",
              "quote": "33",
              "facebook": "hi",
              "twitter": "fine",
              "instagram": "u",
              "created_at": "2016-01-27 09:45:07",
              "updated_at": "2016-01-27 17:43:58",
              "level": 13
            }
          },
          {
            "id": "24",
            "workout_id": "2",
            "user_id": "20",
            "status": "1",
            "time": "16",
            "is_starred": "0",
            "volume": "1",
            "focus": "3",
            "feed_id": "129",
            "is_coach": "0",
            "coach_rounds": "0",
            "created_at": "2016-01-28 06:25:39",
            "updated_at": "2016-01-28 07:12:17",
            "category": "2",
            "profile": {
              "id": "20",
              "user_id": "20",
              "first_name": "sreejith",
              "last_name": "iLeaf",
              "gender": "0",
              "fitness_status": "2",
              "goal": "2",
              "image": "20_1453916030.jpg",
              "cover_image": "20_1453916040.jpg",
              "city": "1",
              "state": "",
              "country": "",
              "spot": "2",
              "quote": "33",
              "facebook": "hi",
              "twitter": "fine",
              "instagram": "u",
              "created_at": "2016-01-27 09:45:07",
              "updated_at": "2016-01-27 17:43:58",
              "level": 13
            }
          }
        ],
        "personal_best": "3"
      },
      "2": {
        "featured": [],
        "following": [],
        "personal_best": "3"
      },
      "3": {
        "featured": [],
        "following": [],
        "personal_best": "3"
      }
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
        $followingLeanWorkout = [];
        $followingAthleteWorkout = [];
        $followingStrengthWorkout = [];

        if (!isset($request->workout_id) || ($request->workout_id == null)) {
            return response()->json(["status" => "0", "error" => "The workout_id field is required"]);
        } elseif (!isset($request->user_id) || ($request->user_id == null)) {
            return response()->json(["status" => "0", "error" => "The user_id field is required"]);
        } else {
            $workout = Workout::where('id', '=', $request->input('workout_id'))->first();
            if (!is_null($workout)) {

                $workoutArray = $workout->toArray();

                $workoutArray['rewards'] = json_decode($workoutArray['rewards'], true);

                $featuredUserQuery = DB::table('users')->select('id')->whereRaw('status = 1 AND is_featured = 1')->toSql();

                $followQuery = DB::table('follows')->select('follow_id')->whereRaw('user_id = ' . $request->user_id)->toSql();

                $intensityArray = [1, 2, 3];

                foreach ($intensityArray as $intensity) {
                    $workoutArray['lean'][$intensity]['featured'] = WorkoutUser::whereRaw('focus = 1 AND volume = ' . $intensity . ' AND workout_id = ' . $request->workout_id . ' AND status= 1 AND user_id IN(' . $featuredUserQuery . ')')
                        ->with(['profile'])
                        ->groupBy('user_id')
                        ->orderBy('time', 'ASC')
                        ->get();

                    $workoutArray['lean'][$intensity]['following'] = WorkoutUser::whereRaw('workout_id = ' . $request->workout_id . ' AND focus = 1 AND (user_id IN(' . $followQuery . ') OR user_id IN(' . $request->user_id . '))')
                        ->with(['profile'])
                        ->orderBy('time', 'ASC')
                        ->get();
                    
                    $bestTime = WorkoutUser::where('workout_id',$request->workout_id)
                        ->where('focus', 1)
                        ->where('user_id', $request->user_id)
                        ->orderBy('time', 'ASC')
                        ->pluck('time');
                    
                    if(!is_null($bestTime)){
                        $workoutArray['lean'][$intensity]['personal_best'] = $bestTime;
                    } else {
                        $workoutArray['lean'][$intensity]['personal_best'] = '';
                    }
                    
                    

                    $workoutArray['athletic'][$intensity]['featured'] = WorkoutUser::whereRaw('focus = 2 AND volume = ' . $intensity . ' AND workout_id = ' . $request->workout_id . ' AND status= 1 AND user_id IN(' . $featuredUserQuery . ')')
                        ->with(['profile'])
                        ->groupBy('user_id')
                        ->orderBy('time', 'ASC')
                        ->get();

                    $workoutArray['athletic'][$intensity]['following'] = WorkoutUser::whereRaw('workout_id = ' . $request->workout_id . ' AND volume = ' . $intensity . ' AND focus = 2 AND (user_id IN(' . $followQuery . ') OR user_id IN(' . $request->user_id . '))')
                        ->with(['profile'])
                        ->orderBy('time', 'ASC')
                        ->get();
                    
                    $bestTime = WorkoutUser::where('workout_id',$request->workout_id)
                        ->where('focus', 2)
                        ->where('user_id', $request->user_id)
                        ->orderBy('time', 'ASC')
                        ->pluck('time');
                    
                    if(!is_null($bestTime)){
                        $workoutArray['athletic'][$intensity]['personal_best'] = $bestTime;
                        
                    } else {
                        $workoutArray['athletic'][$intensity]['personal_best'] = '';
                    }
                    
                    

                    $workoutArray['strength'][$intensity]['featured'] = WorkoutUser::whereRaw('focus = 3 AND volume = ' . $intensity . ' AND  workout_id = ' . $request->workout_id . ' AND status= 1 AND user_id IN(' . $featuredUserQuery . ')')
                        ->with(['profile'])
                        ->groupBy('user_id')
                        ->orderBy('time', 'ASC')
                        ->get();

                    $workoutArray['strength'][$intensity]['following'] = WorkoutUser::whereRaw('workout_id = ' . $request->workout_id . ' AND focus = 3 AND volume = ' . $intensity . ' AND (user_id IN(' . $followQuery . ') OR user_id IN(' . $request->user_id . '))')
                        ->with(['profile'])
                        ->orderBy('time', 'ASC')
                        ->get();
                    
                    $bestTime = WorkoutUser::where('workout_id',$request->workout_id)
                        ->where('focus', 3)
                        ->where('user_id', $request->user_id)
                        ->orderBy('time', 'ASC')
                        ->pluck('time');
                    
                    if(!is_null($bestTime)){
                        $workoutArray['strength'][$intensity]['personal_best'] = $bestTime;
                    } else {
                        $workoutArray['strength'][$intensity]['personal_best'] = '';
                    }
                }

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
     * @apiParam {Number} workout_id Id of workout *required
     * @apiParam {Number} category of workout 1-lean, 2-athletic, 3-strength *required
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
}
