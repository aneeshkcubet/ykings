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
      "is_subscribed": 1,
      "workouts": {
      "free": [
      {
      "id": "9",
      "name": "Elli",
      "description": "C,A,D",
      "rounds": "3",
      "category": "2",
      "type": "1",
      "rewards": "{\"lean\":\"330\",\"athletic\":\"440\",\"strength\":\"550\"}",
      "duration": "420.00",
      "equipments": "Bar/Rings",
      "created_at": "2016-01-19 05:27:35",
      "progression_string": "Full Body, Pull, Push"
      },
      {
      "id": "10",
      "name": "Loki",
      "description": "A,E,B",
      "rounds": "1",
      "category": "1",
      "type": "1",
      "rewards": "{\"lean\":\"330\",\"athletic\":\"440\",\"strength\":\"550\"}",
      "duration": "1440.00",
      "equipments": "Bar/Rings",
      "created_at": "2016-01-19 05:34:36",
      "progression_string": "Pull, Core, Dip"
      },
      {
      "id": "13",
      "name": "Magni",
      "description": "A,E,D,C",
      "rounds": "4",
      "category": "1",
      "type": "1",
      "rewards": "{\"lean\":\"440\",\"athletic\":\"550\",\"strength\":\"660\"}",
      "duration": "600.00",
      "equipments": "Bar/Rings",
      "created_at": "2016-01-19 06:05:29",
      "progression_string": "Pull, Core, Push, Full Body"
      },
      {
      "id": "20",
      "name": "Snotra",
      "description": "D,A,B,C,E",
      "rounds": "3",
      "category": "1",
      "type": "1",
      "rewards": "{\"lean\":\"440\",\"athletic\":\"550\",\"strength\":\"660\"}",
      "duration": "1620.00",
      "equipments": "Bar/Rings",
      "created_at": "2016-01-19 23:04:47",
      "progression_string": "Push, Pull, Dip, Full Body, Core"
      },
      {
      "id": "24",
      "name": "Nerpus",
      "description": "A,D,E,B",
      "rounds": "3",
      "category": "1",
      "type": "1",
      "rewards": "{\"lean\":\"440\",\"athletic\":\"550\",\"strength\":\"660\"}",
      "duration": "0.00",
      "equipments": "Bar/Rings",
      "created_at": "2016-01-19 23:37:31",
      "progression_string": "Pull, Push, Core, Dip"
      },
      {
      "id": "25",
      "name": "Jord",
      "description": "C,E",
      "rounds": "4",
      "category": "2",
      "type": "1",
      "rewards": "{\"lean\":\"440\",\"athletic\":\"550\",\"strength\":\"660\"}",
      "duration": "720.00",
      "equipments": "",
      "created_at": "2016-01-19 23:56:15",
      "progression_string": "Full Body, Core"
      }
      ],
      "paid": [
      {
      "id": "1",
      "name": "Baldur",
      "description": "A,D,B",
      "rounds": "5",
      "category": "1",
      "type": "2",
      "rewards": "{\"lean\":\"440\",\"athletic\":\"550\",\"strength\":\"660\"}",
      "duration": "2380.00",
      "equipments": "Bar/Rings, Paralettes/Rings",
      "created_at": "2016-01-19 03:13:33",
      "progression_string": "Pull, Push, Dip"
      },
      {
      "id": "2",
      "name": "Borr",
      "description": "A,C,E,B",
      "rounds": "3",
      "category": "2",
      "type": "2",
      "rewards": "{\"lean\":\"330\",\"athletic\":\"440\",\"strength\":\"550\"}",
      "duration": "1140.00",
      "equipments": "Bar/Rings",
      "created_at": "2016-01-19 03:27:55",
      "progression_string": "Pull, Full Body, Core, Dip"
      },
      {
      "id": "3",
      "name": "Bragi",
      "description": "D,C,A",
      "rounds": "5",
      "category": "2",
      "type": "2",
      "rewards": "{\"lean\":\"440\",\"athletic\":\"550\",\"strength\":\"660\"}",
      "duration": "480.00",
      "equipments": "Bar/Rings",
      "created_at": "2016-01-19 04:17:24",
      "progression_string": "Push, Full Body, Pull"
      },
      {
      "id": "4",
      "name": "Buri",
      "description": "A,B,D,C",
      "rounds": "1",
      "category": "1",
      "type": "2",
      "rewards": "{\"lean\":\"440\",\"athletic\":\"550\",\"strength\":\"660\"}",
      "duration": "1440.00",
      "equipments": "Bar/Rings",
      "created_at": "2016-01-19 04:29:15",
      "progression_string": "Pull, Dip, Push, Full Body"
      },
      {
      "id": "5",
      "name": "Dagur",
      "description": "C,E",
      "rounds": "3",
      "category": "1",
      "type": "2",
      "rewards": "{\"lean\":\"330\",\"athletic\":\"440\",\"strength\":\"550\"}",
      "duration": "1260.00",
      "equipments": "Bar/Rings",
      "created_at": "2016-01-19 04:36:27",
      "progression_string": "Full Body, Core"
      },
      {
      "id": "6",
      "name": "Delling",
      "description": "C,E,B,A",
      "rounds": "1",
      "category": "1",
      "type": "2",
      "rewards": "{\"lean\":\"440\",\"athletic\":\"550\",\"strength\":\"660\"}",
      "duration": "1020.00",
      "equipments": "Bar/Rings",
      "created_at": "2016-01-19 04:45:17",
      "progression_string": "Full Body, Core, Dip, Pull"
      },
      {
      "id": "7",
      "name": "Eir",
      "description": "C,A,E,D",
      "rounds": "1",
      "category": "1",
      "type": "2",
      "rewards": "{\"lean\":\"330\",\"athletic\":\"440\",\"strength\":\"550\"}",
      "duration": "1020.00",
      "equipments": "Bar/Rings",
      "created_at": "2016-01-19 05:02:33",
      "progression_string": "Full Body, Pull, Core, Push"
      },
      {
      "id": "8",
      "name": "Eostre",
      "description": "E,D,A",
      "rounds": "5",
      "category": "1",
      "type": "2",
      "rewards": "{\"lean\":\"440\",\"athletic\":\"550\",\"strength\":\"660\"}",
      "duration": "720.00",
      "equipments": "Bar/Rings",
      "created_at": "2016-01-19 05:17:38",
      "progression_string": "Core, Push, Pull"
      },
      {
      "id": "11",
      "name": "Hermodur",
      "description": "E,C",
      "rounds": "4",
      "category": "1",
      "type": "2",
      "rewards": "{\"lean\":\"440\",\"athletic\":\"550\",\"strength\":\"660\"}",
      "duration": "900.00",
      "equipments": "Bar/Rings",
      "created_at": "2016-01-19 05:48:45",
      "progression_string": "Core, Full Body"
      },
      {
      "id": "12",
      "name": "Forseti",
      "description": "E,C",
      "rounds": "6",
      "category": "2",
      "type": "2",
      "rewards": "{\"lean\":\"440\",\"athletic\":\"550\",\"strength\":\"660\"}",
      "duration": "1080.00",
      "equipments": "Bar/Rings",
      "created_at": "2016-01-19 05:59:51",
      "progression_string": "Core, Full Body"
      },
      {
      "id": "14",
      "name": "Odin",
      "description": "A,D,E",
      "rounds": "1",
      "category": "1",
      "type": "2",
      "rewards": "{\"lean\":\"330\",\"athletic\":\"440\",\"strength\":\"550\"}",
      "duration": "1200.00",
      "equipments": "Bar/Rings",
      "created_at": "2016-01-19 06:13:53",
      "progression_string": "Pull, Push, Core"
      },
      {
      "id": "15",
      "name": "Mimir",
      "description": "C,D,E",
      "rounds": "4",
      "category": "2",
      "type": "2",
      "rewards": "{\"lean\":\"330\",\"athletic\":\"440\",\"strength\":\"550\"}",
      "duration": "900.00",
      "equipments": "Bar/Rings",
      "created_at": "2016-01-19 06:27:26",
      "progression_string": "Full Body, Push, Core"
      },
      {
      "id": "16",
      "name": "Tyr",
      "description": "B,C,E",
      "rounds": "3",
      "category": "1",
      "type": "2",
      "rewards": "{\"lean\":\"440\",\"athletic\":\"550\",\"strength\":\"660\"}",
      "duration": "540.00",
      "equipments": "Bar/Rings, Paralettes/Rings",
      "created_at": "2016-01-19 06:34:04",
      "progression_string": "Dip, Full Body, Core"
      },
      {
      "id": "17",
      "name": "Thor",
      "description": "C,A,D,B,E",
      "rounds": "1",
      "category": "1",
      "type": "2",
      "rewards": "{\"lean\":\"440\",\"athletic\":\"550\",\"strength\":\"660\"}",
      "duration": "1560.00",
      "equipments": "Bar/Rings",
      "created_at": "2016-01-19 06:43:09",
      "progression_string": "Full Body, Pull, Push, Dip, Core"
      },
      {
      "id": "18",
      "name": "Sif",
      "description": "B,C,E",
      "rounds": "3",
      "category": "2",
      "type": "2",
      "rewards": "{\"lean\":\"330\",\"athletic\":\"440\",\"strength\":\"550\"}",
      "duration": "0.00",
      "equipments": "Bar/Rings",
      "created_at": "2016-01-19 06:49:07",
      "progression_string": "Dip, Full Body, Core"
      },
      {
      "id": "19",
      "name": "Hoenir",
      "description": "E,C,D",
      "rounds": "3",
      "category": "1",
      "type": "2",
      "rewards": "{\"lean\":\"330\",\"athletic\":\"440\",\"strength\":\"550\"}",
      "duration": "1740.00",
      "equipments": "Bar/Rings, Ladder/Post",
      "created_at": "2016-01-19 06:58:22",
      "progression_string": "Core, Full Body, Push"
      },
      {
      "id": "21",
      "name": "Vali",
      "description": "A,B,E",
      "rounds": "3",
      "category": "1",
      "type": "2",
      "rewards": "{\"lean\":\"330\",\"athletic\":\"440\",\"strength\":\"550\"}",
      "duration": "1620.00",
      "equipments": "Bar/Rings, Ladder/Post",
      "created_at": "2016-01-19 23:13:48",
      "progression_string": "Pull, Dip, Core"
      },
      {
      "id": "22",
      "name": "Hel",
      "description": "C,E,A,D",
      "rounds": "3",
      "category": "2",
      "type": "2",
      "rewards": "{\"lean\":\"440\",\"athletic\":\"550\",\"strength\":\"660\"}",
      "duration": "1080.00",
      "equipments": "Bar/Rings",
      "created_at": "2016-01-19 23:21:30",
      "progression_string": "Full Body, Core, Pull, Push"
      },
      {
      "id": "23",
      "name": "Yggdrasil",
      "description": "E,C,B",
      "rounds": "3",
      "category": "1",
      "type": "2",
      "rewards": "{\"lean\":\"440\",\"athletic\":\"550\",\"strength\":\"660\"}",
      "duration": "0.00",
      "equipments": "Bar/Rings, Ladder/Post",
      "created_at": "2016-01-19 23:29:34",
      "progression_string": "Core, Full Body, Dip"
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
                    $workoutResponse['free'] = $freeWorkouts->toArray();
                }
                if (!is_null($paidWorkouts)) {
                    $workoutResponse['paid'] = $paidWorkouts->toArray();
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
      "id": "15",
      "name": "Mimir",
      "description": "C,D,E",
      "rounds": "4",
      "category": "2",
      "type": "2",
      "rewards": {
      "lean": "330",
      "athletic": "440",
      "strength": "550"
      },
      "duration": "900.00",
      "equipments": "Bar/Rings",
      "created_at": "2016-01-19 06:27:26",
      "progression_string": "Full Body, Push, Core",
      "lean": {
      "1": {
      "featured": [],
      "following": [
      {
      "id": "93",
      "workout_id": "15",
      "user_id": "67",
      "status": "1",
      "time": "3",
      "is_starred": "0",
      "volume": "1",
      "focus": "1",
      "feed_id": "735",
      "is_coach": "0",
      "coach_rounds": "0",
      "created_at": "2016-02-17 06:45:31",
      "updated_at": "2016-02-17 06:45:31",
      "category": "1",
      "profile": {
      "id": "67",
      "user_id": "67",
      "first_name": "Aneesh",
      "last_name": "iLeaf",
      "gender": "2",
      "fitness_status": "3",
      "goal": "2",
      "image": "67_1460107183.jpg",
      "cover_image": "67_1460107251.jpg",
      "city": "Kochi",
      "state": "",
      "country": "",
      "spot": "",
      "quote": "åäÀáâæ?ã",
      "facebook": "",
      "twitter": "",
      "instagram": "",
      "created_at": "2016-02-12 14:39:19",
      "updated_at": "2016-07-15 10:13:47",
      "level": 44
      }
      },
      {
      "id": "97",
      "workout_id": "15",
      "user_id": "67",
      "status": "1",
      "time": "3",
      "is_starred": "0",
      "volume": "1",
      "focus": "1",
      "feed_id": "747",
      "is_coach": "0",
      "coach_rounds": "0",
      "created_at": "2016-02-17 11:01:16",
      "updated_at": "2016-02-17 11:01:16",
      "category": "1",
      "profile": {
      "id": "67",
      "user_id": "67",
      "first_name": "Aneesh",
      "last_name": "iLeaf",
      "gender": "2",
      "fitness_status": "3",
      "goal": "2",
      "image": "67_1460107183.jpg",
      "cover_image": "67_1460107251.jpg",
      "city": "Kochi",
      "state": "",
      "country": "",
      "spot": "",
      "quote": "åäÀáâæ?ã",
      "facebook": "",
      "twitter": "",
      "instagram": "",
      "created_at": "2016-02-12 14:39:19",
      "updated_at": "2016-07-15 10:13:47",
      "level": 44
      }
      },
      {
      "id": "101",
      "workout_id": "15",
      "user_id": "67",
      "status": "1",
      "time": "3",
      "is_starred": "0",
      "volume": "1",
      "focus": "1",
      "feed_id": "775",
      "is_coach": "0",
      "coach_rounds": "0",
      "created_at": "2016-02-18 09:53:55",
      "updated_at": "2016-02-18 09:53:55",
      "category": "1",
      "profile": {
      "id": "67",
      "user_id": "67",
      "first_name": "Aneesh",
      "last_name": "iLeaf",
      "gender": "2",
      "fitness_status": "3",
      "goal": "2",
      "image": "67_1460107183.jpg",
      "cover_image": "67_1460107251.jpg",
      "city": "Kochi",
      "state": "",
      "country": "",
      "spot": "",
      "quote": "åäÀáâæ?ã",
      "facebook": "",
      "twitter": "",
      "instagram": "",
      "created_at": "2016-02-12 14:39:19",
      "updated_at": "2016-07-15 10:13:47",
      "level": 44
      }
      },
      {
      "id": "98",
      "workout_id": "15",
      "user_id": "67",
      "status": "1",
      "time": "5",
      "is_starred": "0",
      "volume": "1",
      "focus": "1",
      "feed_id": "753",
      "is_coach": "0",
      "coach_rounds": "0",
      "created_at": "2016-02-17 11:26:44",
      "updated_at": "2016-02-17 11:26:44",
      "category": "1",
      "profile": {
      "id": "67",
      "user_id": "67",
      "first_name": "Aneesh",
      "last_name": "iLeaf",
      "gender": "2",
      "fitness_status": "3",
      "goal": "2",
      "image": "67_1460107183.jpg",
      "cover_image": "67_1460107251.jpg",
      "city": "Kochi",
      "state": "",
      "country": "",
      "spot": "",
      "quote": "åäÀáâæ?ã",
      "facebook": "",
      "twitter": "",
      "instagram": "",
      "created_at": "2016-02-12 14:39:19",
      "updated_at": "2016-07-15 10:13:47",
      "level": 44
      }
      },
      {
      "id": "112",
      "workout_id": "15",
      "user_id": "67",
      "status": "1",
      "time": "10",
      "is_starred": "0",
      "volume": "1",
      "focus": "1",
      "feed_id": "858",
      "is_coach": "0",
      "coach_rounds": "0",
      "created_at": "2016-02-24 05:08:42",
      "updated_at": "2016-02-24 05:08:42",
      "category": "1",
      "profile": {
      "id": "67",
      "user_id": "67",
      "first_name": "Aneesh",
      "last_name": "iLeaf",
      "gender": "2",
      "fitness_status": "3",
      "goal": "2",
      "image": "67_1460107183.jpg",
      "cover_image": "67_1460107251.jpg",
      "city": "Kochi",
      "state": "",
      "country": "",
      "spot": "",
      "quote": "åäÀáâæ?ã",
      "facebook": "",
      "twitter": "",
      "instagram": "",
      "created_at": "2016-02-12 14:39:19",
      "updated_at": "2016-07-15 10:13:47",
      "level": 44
      }
      },
      {
      "id": "96",
      "workout_id": "15",
      "user_id": "67",
      "status": "1",
      "time": "34",
      "is_starred": "0",
      "volume": "1",
      "focus": "1",
      "feed_id": "743",
      "is_coach": "0",
      "coach_rounds": "0",
      "created_at": "2016-02-17 09:55:06",
      "updated_at": "2016-02-17 09:55:06",
      "category": "1",
      "profile": {
      "id": "67",
      "user_id": "67",
      "first_name": "Aneesh",
      "last_name": "iLeaf",
      "gender": "2",
      "fitness_status": "3",
      "goal": "2",
      "image": "67_1460107183.jpg",
      "cover_image": "67_1460107251.jpg",
      "city": "Kochi",
      "state": "",
      "country": "",
      "spot": "",
      "quote": "åäÀáâæ?ã",
      "facebook": "",
      "twitter": "",
      "instagram": "",
      "created_at": "2016-02-12 14:39:19",
      "updated_at": "2016-07-15 10:13:47",
      "level": 44
      }
      },
      {
      "id": "95",
      "workout_id": "15",
      "user_id": "67",
      "status": "1",
      "time": "69",
      "is_starred": "0",
      "volume": "1",
      "focus": "1",
      "feed_id": "742",
      "is_coach": "0",
      "coach_rounds": "0",
      "created_at": "2016-02-17 09:50:14",
      "updated_at": "2016-02-17 09:50:14",
      "category": "1",
      "profile": {
      "id": "67",
      "user_id": "67",
      "first_name": "Aneesh",
      "last_name": "iLeaf",
      "gender": "2",
      "fitness_status": "3",
      "goal": "2",
      "image": "67_1460107183.jpg",
      "cover_image": "67_1460107251.jpg",
      "city": "Kochi",
      "state": "",
      "country": "",
      "spot": "",
      "quote": "åäÀáâæ?ã",
      "facebook": "",
      "twitter": "",
      "instagram": "",
      "created_at": "2016-02-12 14:39:19",
      "updated_at": "2016-07-15 10:13:47",
      "level": 44
      }
      }
      ],
      "personal_best": ""
      },
      "2": {
      "featured": [],
      "following": [
      {
      "id": "93",
      "workout_id": "15",
      "user_id": "67",
      "status": "1",
      "time": "3",
      "is_starred": "0",
      "volume": "1",
      "focus": "1",
      "feed_id": "735",
      "is_coach": "0",
      "coach_rounds": "0",
      "created_at": "2016-02-17 06:45:31",
      "updated_at": "2016-02-17 06:45:31",
      "category": "1",
      "profile": {
      "id": "67",
      "user_id": "67",
      "first_name": "Aneesh",
      "last_name": "iLeaf",
      "gender": "2",
      "fitness_status": "3",
      "goal": "2",
      "image": "67_1460107183.jpg",
      "cover_image": "67_1460107251.jpg",
      "city": "Kochi",
      "state": "",
      "country": "",
      "spot": "",
      "quote": "åäÀáâæ?ã",
      "facebook": "",
      "twitter": "",
      "instagram": "",
      "created_at": "2016-02-12 14:39:19",
      "updated_at": "2016-07-15 10:13:47",
      "level": 44
      }
      },
      {
      "id": "97",
      "workout_id": "15",
      "user_id": "67",
      "status": "1",
      "time": "3",
      "is_starred": "0",
      "volume": "1",
      "focus": "1",
      "feed_id": "747",
      "is_coach": "0",
      "coach_rounds": "0",
      "created_at": "2016-02-17 11:01:16",
      "updated_at": "2016-02-17 11:01:16",
      "category": "1",
      "profile": {
      "id": "67",
      "user_id": "67",
      "first_name": "Aneesh",
      "last_name": "iLeaf",
      "gender": "2",
      "fitness_status": "3",
      "goal": "2",
      "image": "67_1460107183.jpg",
      "cover_image": "67_1460107251.jpg",
      "city": "Kochi",
      "state": "",
      "country": "",
      "spot": "",
      "quote": "åäÀáâæ?ã",
      "facebook": "",
      "twitter": "",
      "instagram": "",
      "created_at": "2016-02-12 14:39:19",
      "updated_at": "2016-07-15 10:13:47",
      "level": 44
      }
      },
      {
      "id": "101",
      "workout_id": "15",
      "user_id": "67",
      "status": "1",
      "time": "3",
      "is_starred": "0",
      "volume": "1",
      "focus": "1",
      "feed_id": "775",
      "is_coach": "0",
      "coach_rounds": "0",
      "created_at": "2016-02-18 09:53:55",
      "updated_at": "2016-02-18 09:53:55",
      "category": "1",
      "profile": {
      "id": "67",
      "user_id": "67",
      "first_name": "Aneesh",
      "last_name": "iLeaf",
      "gender": "2",
      "fitness_status": "3",
      "goal": "2",
      "image": "67_1460107183.jpg",
      "cover_image": "67_1460107251.jpg",
      "city": "Kochi",
      "state": "",
      "country": "",
      "spot": "",
      "quote": "åäÀáâæ?ã",
      "facebook": "",
      "twitter": "",
      "instagram": "",
      "created_at": "2016-02-12 14:39:19",
      "updated_at": "2016-07-15 10:13:47",
      "level": 44
      }
      },
      {
      "id": "98",
      "workout_id": "15",
      "user_id": "67",
      "status": "1",
      "time": "5",
      "is_starred": "0",
      "volume": "1",
      "focus": "1",
      "feed_id": "753",
      "is_coach": "0",
      "coach_rounds": "0",
      "created_at": "2016-02-17 11:26:44",
      "updated_at": "2016-02-17 11:26:44",
      "category": "1",
      "profile": {
      "id": "67",
      "user_id": "67",
      "first_name": "Aneesh",
      "last_name": "iLeaf",
      "gender": "2",
      "fitness_status": "3",
      "goal": "2",
      "image": "67_1460107183.jpg",
      "cover_image": "67_1460107251.jpg",
      "city": "Kochi",
      "state": "",
      "country": "",
      "spot": "",
      "quote": "åäÀáâæ?ã",
      "facebook": "",
      "twitter": "",
      "instagram": "",
      "created_at": "2016-02-12 14:39:19",
      "updated_at": "2016-07-15 10:13:47",
      "level": 44
      }
      },
      {
      "id": "112",
      "workout_id": "15",
      "user_id": "67",
      "status": "1",
      "time": "10",
      "is_starred": "0",
      "volume": "1",
      "focus": "1",
      "feed_id": "858",
      "is_coach": "0",
      "coach_rounds": "0",
      "created_at": "2016-02-24 05:08:42",
      "updated_at": "2016-02-24 05:08:42",
      "category": "1",
      "profile": {
      "id": "67",
      "user_id": "67",
      "first_name": "Aneesh",
      "last_name": "iLeaf",
      "gender": "2",
      "fitness_status": "3",
      "goal": "2",
      "image": "67_1460107183.jpg",
      "cover_image": "67_1460107251.jpg",
      "city": "Kochi",
      "state": "",
      "country": "",
      "spot": "",
      "quote": "åäÀáâæ?ã",
      "facebook": "",
      "twitter": "",
      "instagram": "",
      "created_at": "2016-02-12 14:39:19",
      "updated_at": "2016-07-15 10:13:47",
      "level": 44
      }
      },
      {
      "id": "96",
      "workout_id": "15",
      "user_id": "67",
      "status": "1",
      "time": "34",
      "is_starred": "0",
      "volume": "1",
      "focus": "1",
      "feed_id": "743",
      "is_coach": "0",
      "coach_rounds": "0",
      "created_at": "2016-02-17 09:55:06",
      "updated_at": "2016-02-17 09:55:06",
      "category": "1",
      "profile": {
      "id": "67",
      "user_id": "67",
      "first_name": "Aneesh",
      "last_name": "iLeaf",
      "gender": "2",
      "fitness_status": "3",
      "goal": "2",
      "image": "67_1460107183.jpg",
      "cover_image": "67_1460107251.jpg",
      "city": "Kochi",
      "state": "",
      "country": "",
      "spot": "",
      "quote": "åäÀáâæ?ã",
      "facebook": "",
      "twitter": "",
      "instagram": "",
      "created_at": "2016-02-12 14:39:19",
      "updated_at": "2016-07-15 10:13:47",
      "level": 44
      }
      },
      {
      "id": "95",
      "workout_id": "15",
      "user_id": "67",
      "status": "1",
      "time": "69",
      "is_starred": "0",
      "volume": "1",
      "focus": "1",
      "feed_id": "742",
      "is_coach": "0",
      "coach_rounds": "0",
      "created_at": "2016-02-17 09:50:14",
      "updated_at": "2016-02-17 09:50:14",
      "category": "1",
      "profile": {
      "id": "67",
      "user_id": "67",
      "first_name": "Aneesh",
      "last_name": "iLeaf",
      "gender": "2",
      "fitness_status": "3",
      "goal": "2",
      "image": "67_1460107183.jpg",
      "cover_image": "67_1460107251.jpg",
      "city": "Kochi",
      "state": "",
      "country": "",
      "spot": "",
      "quote": "åäÀáâæ?ã",
      "facebook": "",
      "twitter": "",
      "instagram": "",
      "created_at": "2016-02-12 14:39:19",
      "updated_at": "2016-07-15 10:13:47",
      "level": 44
      }
      }
      ],
      "personal_best": ""
      },
      "3": {
      "featured": [],
      "following": [
      {
      "id": "93",
      "workout_id": "15",
      "user_id": "67",
      "status": "1",
      "time": "3",
      "is_starred": "0",
      "volume": "1",
      "focus": "1",
      "feed_id": "735",
      "is_coach": "0",
      "coach_rounds": "0",
      "created_at": "2016-02-17 06:45:31",
      "updated_at": "2016-02-17 06:45:31",
      "category": "1",
      "profile": {
      "id": "67",
      "user_id": "67",
      "first_name": "Aneesh",
      "last_name": "iLeaf",
      "gender": "2",
      "fitness_status": "3",
      "goal": "2",
      "image": "67_1460107183.jpg",
      "cover_image": "67_1460107251.jpg",
      "city": "Kochi",
      "state": "",
      "country": "",
      "spot": "",
      "quote": "åäÀáâæ?ã",
      "facebook": "",
      "twitter": "",
      "instagram": "",
      "created_at": "2016-02-12 14:39:19",
      "updated_at": "2016-07-15 10:13:47",
      "level": 44
      }
      },
      {
      "id": "97",
      "workout_id": "15",
      "user_id": "67",
      "status": "1",
      "time": "3",
      "is_starred": "0",
      "volume": "1",
      "focus": "1",
      "feed_id": "747",
      "is_coach": "0",
      "coach_rounds": "0",
      "created_at": "2016-02-17 11:01:16",
      "updated_at": "2016-02-17 11:01:16",
      "category": "1",
      "profile": {
      "id": "67",
      "user_id": "67",
      "first_name": "Aneesh",
      "last_name": "iLeaf",
      "gender": "2",
      "fitness_status": "3",
      "goal": "2",
      "image": "67_1460107183.jpg",
      "cover_image": "67_1460107251.jpg",
      "city": "Kochi",
      "state": "",
      "country": "",
      "spot": "",
      "quote": "åäÀáâæ?ã",
      "facebook": "",
      "twitter": "",
      "instagram": "",
      "created_at": "2016-02-12 14:39:19",
      "updated_at": "2016-07-15 10:13:47",
      "level": 44
      }
      },
      {
      "id": "101",
      "workout_id": "15",
      "user_id": "67",
      "status": "1",
      "time": "3",
      "is_starred": "0",
      "volume": "1",
      "focus": "1",
      "feed_id": "775",
      "is_coach": "0",
      "coach_rounds": "0",
      "created_at": "2016-02-18 09:53:55",
      "updated_at": "2016-02-18 09:53:55",
      "category": "1",
      "profile": {
      "id": "67",
      "user_id": "67",
      "first_name": "Aneesh",
      "last_name": "iLeaf",
      "gender": "2",
      "fitness_status": "3",
      "goal": "2",
      "image": "67_1460107183.jpg",
      "cover_image": "67_1460107251.jpg",
      "city": "Kochi",
      "state": "",
      "country": "",
      "spot": "",
      "quote": "åäÀáâæ?ã",
      "facebook": "",
      "twitter": "",
      "instagram": "",
      "created_at": "2016-02-12 14:39:19",
      "updated_at": "2016-07-15 10:13:47",
      "level": 44
      }
      },
      {
      "id": "98",
      "workout_id": "15",
      "user_id": "67",
      "status": "1",
      "time": "5",
      "is_starred": "0",
      "volume": "1",
      "focus": "1",
      "feed_id": "753",
      "is_coach": "0",
      "coach_rounds": "0",
      "created_at": "2016-02-17 11:26:44",
      "updated_at": "2016-02-17 11:26:44",
      "category": "1",
      "profile": {
      "id": "67",
      "user_id": "67",
      "first_name": "Aneesh",
      "last_name": "iLeaf",
      "gender": "2",
      "fitness_status": "3",
      "goal": "2",
      "image": "67_1460107183.jpg",
      "cover_image": "67_1460107251.jpg",
      "city": "Kochi",
      "state": "",
      "country": "",
      "spot": "",
      "quote": "åäÀáâæ?ã",
      "facebook": "",
      "twitter": "",
      "instagram": "",
      "created_at": "2016-02-12 14:39:19",
      "updated_at": "2016-07-15 10:13:47",
      "level": 44
      }
      },
      {
      "id": "112",
      "workout_id": "15",
      "user_id": "67",
      "status": "1",
      "time": "10",
      "is_starred": "0",
      "volume": "1",
      "focus": "1",
      "feed_id": "858",
      "is_coach": "0",
      "coach_rounds": "0",
      "created_at": "2016-02-24 05:08:42",
      "updated_at": "2016-02-24 05:08:42",
      "category": "1",
      "profile": {
      "id": "67",
      "user_id": "67",
      "first_name": "Aneesh",
      "last_name": "iLeaf",
      "gender": "2",
      "fitness_status": "3",
      "goal": "2",
      "image": "67_1460107183.jpg",
      "cover_image": "67_1460107251.jpg",
      "city": "Kochi",
      "state": "",
      "country": "",
      "spot": "",
      "quote": "åäÀáâæ?ã",
      "facebook": "",
      "twitter": "",
      "instagram": "",
      "created_at": "2016-02-12 14:39:19",
      "updated_at": "2016-07-15 10:13:47",
      "level": 44
      }
      },
      {
      "id": "96",
      "workout_id": "15",
      "user_id": "67",
      "status": "1",
      "time": "34",
      "is_starred": "0",
      "volume": "1",
      "focus": "1",
      "feed_id": "743",
      "is_coach": "0",
      "coach_rounds": "0",
      "created_at": "2016-02-17 09:55:06",
      "updated_at": "2016-02-17 09:55:06",
      "category": "1",
      "profile": {
      "id": "67",
      "user_id": "67",
      "first_name": "Aneesh",
      "last_name": "iLeaf",
      "gender": "2",
      "fitness_status": "3",
      "goal": "2",
      "image": "67_1460107183.jpg",
      "cover_image": "67_1460107251.jpg",
      "city": "Kochi",
      "state": "",
      "country": "",
      "spot": "",
      "quote": "åäÀáâæ?ã",
      "facebook": "",
      "twitter": "",
      "instagram": "",
      "created_at": "2016-02-12 14:39:19",
      "updated_at": "2016-07-15 10:13:47",
      "level": 44
      }
      },
      {
      "id": "95",
      "workout_id": "15",
      "user_id": "67",
      "status": "1",
      "time": "69",
      "is_starred": "0",
      "volume": "1",
      "focus": "1",
      "feed_id": "742",
      "is_coach": "0",
      "coach_rounds": "0",
      "created_at": "2016-02-17 09:50:14",
      "updated_at": "2016-02-17 09:50:14",
      "category": "1",
      "profile": {
      "id": "67",
      "user_id": "67",
      "first_name": "Aneesh",
      "last_name": "iLeaf",
      "gender": "2",
      "fitness_status": "3",
      "goal": "2",
      "image": "67_1460107183.jpg",
      "cover_image": "67_1460107251.jpg",
      "city": "Kochi",
      "state": "",
      "country": "",
      "spot": "",
      "quote": "åäÀáâæ?ã",
      "facebook": "",
      "twitter": "",
      "instagram": "",
      "created_at": "2016-02-12 14:39:19",
      "updated_at": "2016-07-15 10:13:47",
      "level": 44
      }
      }
      ],
      "personal_best": ""
      }
      },
      "athletic": {
      "1": {
      "featured": [],
      "following": [
      {
      "id": "174",
      "workout_id": "15",
      "user_id": "67",
      "status": "1",
      "time": "4",
      "is_starred": "0",
      "volume": "1",
      "focus": "2",
      "feed_id": "1098",
      "is_coach": "0",
      "coach_rounds": "0",
      "created_at": "2016-03-17 12:20:24",
      "updated_at": "2016-03-17 12:20:24",
      "category": "2",
      "profile": {
      "id": "67",
      "user_id": "67",
      "first_name": "Aneesh",
      "last_name": "iLeaf",
      "gender": "2",
      "fitness_status": "3",
      "goal": "2",
      "image": "67_1460107183.jpg",
      "cover_image": "67_1460107251.jpg",
      "city": "Kochi",
      "state": "",
      "country": "",
      "spot": "",
      "quote": "åäÀáâæ?ã",
      "facebook": "",
      "twitter": "",
      "instagram": "",
      "created_at": "2016-02-12 14:39:19",
      "updated_at": "2016-07-15 10:13:47",
      "level": 44
      }
      },
      {
      "id": "167",
      "workout_id": "15",
      "user_id": "67",
      "status": "1",
      "time": "5",
      "is_starred": "0",
      "volume": "1",
      "focus": "2",
      "feed_id": "1091",
      "is_coach": "0",
      "coach_rounds": "0",
      "created_at": "2016-03-17 10:38:59",
      "updated_at": "2016-03-17 10:38:59",
      "category": "2",
      "profile": {
      "id": "67",
      "user_id": "67",
      "first_name": "Aneesh",
      "last_name": "iLeaf",
      "gender": "2",
      "fitness_status": "3",
      "goal": "2",
      "image": "67_1460107183.jpg",
      "cover_image": "67_1460107251.jpg",
      "city": "Kochi",
      "state": "",
      "country": "",
      "spot": "",
      "quote": "åäÀáâæ?ã",
      "facebook": "",
      "twitter": "",
      "instagram": "",
      "created_at": "2016-02-12 14:39:19",
      "updated_at": "2016-07-15 10:13:47",
      "level": 44
      }
      },
      {
      "id": "232",
      "workout_id": "15",
      "user_id": "67",
      "status": "1",
      "time": "8",
      "is_starred": "0",
      "volume": "1",
      "focus": "2",
      "feed_id": "1189",
      "is_coach": "1",
      "coach_rounds": "2",
      "created_at": "2016-04-11 04:58:59",
      "updated_at": "2016-04-11 04:58:59",
      "category": "2",
      "profile": {
      "id": "67",
      "user_id": "67",
      "first_name": "Aneesh",
      "last_name": "iLeaf",
      "gender": "2",
      "fitness_status": "3",
      "goal": "2",
      "image": "67_1460107183.jpg",
      "cover_image": "67_1460107251.jpg",
      "city": "Kochi",
      "state": "",
      "country": "",
      "spot": "",
      "quote": "åäÀáâæ?ã",
      "facebook": "",
      "twitter": "",
      "instagram": "",
      "created_at": "2016-02-12 14:39:19",
      "updated_at": "2016-07-15 10:13:47",
      "level": 44
      }
      },
      {
      "id": "171",
      "workout_id": "15",
      "user_id": "67",
      "status": "1",
      "time": "14",
      "is_starred": "0",
      "volume": "1",
      "focus": "2",
      "feed_id": "1095",
      "is_coach": "0",
      "coach_rounds": "0",
      "created_at": "2016-03-17 11:31:24",
      "updated_at": "2016-03-17 11:31:24",
      "category": "2",
      "profile": {
      "id": "67",
      "user_id": "67",
      "first_name": "Aneesh",
      "last_name": "iLeaf",
      "gender": "2",
      "fitness_status": "3",
      "goal": "2",
      "image": "67_1460107183.jpg",
      "cover_image": "67_1460107251.jpg",
      "city": "Kochi",
      "state": "",
      "country": "",
      "spot": "",
      "quote": "åäÀáâæ?ã",
      "facebook": "",
      "twitter": "",
      "instagram": "",
      "created_at": "2016-02-12 14:39:19",
      "updated_at": "2016-07-15 10:13:47",
      "level": 44
      }
      },
      {
      "id": "177",
      "workout_id": "15",
      "user_id": "67",
      "status": "1",
      "time": "15",
      "is_starred": "0",
      "volume": "1",
      "focus": "2",
      "feed_id": "1102",
      "is_coach": "0",
      "coach_rounds": "0",
      "created_at": "2016-03-18 12:17:59",
      "updated_at": "2016-03-18 12:17:59",
      "category": "2",
      "profile": {
      "id": "67",
      "user_id": "67",
      "first_name": "Aneesh",
      "last_name": "iLeaf",
      "gender": "2",
      "fitness_status": "3",
      "goal": "2",
      "image": "67_1460107183.jpg",
      "cover_image": "67_1460107251.jpg",
      "city": "Kochi",
      "state": "",
      "country": "",
      "spot": "",
      "quote": "åäÀáâæ?ã",
      "facebook": "",
      "twitter": "",
      "instagram": "",
      "created_at": "2016-02-12 14:39:19",
      "updated_at": "2016-07-15 10:13:47",
      "level": 44
      }
      }
      ],
      "personal_best": ""
      },
      "2": {
      "featured": [],
      "following": [],
      "personal_best": ""
      },
      "3": {
      "featured": [],
      "following": [],
      "personal_best": ""
      }
      },
      "strength": {
      "1": {
      "featured": [],
      "following": [],
      "personal_best": ""
      },
      "2": {
      "featured": [],
      "following": [],
      "personal_best": ""
      },
      "3": {
      "featured": [],
      "following": [],
      "personal_best": ""
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

                    $bestTime = WorkoutUser::where('workout_id', $request->workout_id)
                        ->where('focus', 1)
                        ->where('user_id', $request->user_id)
                        ->orderBy('time', 'ASC')
                        ->pluck('time');

                    if (!is_null($bestTime)) {
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

                    $bestTime = WorkoutUser::where('workout_id', $request->workout_id)
                        ->where('focus', 2)
                        ->where('user_id', $request->user_id)
                        ->orderBy('time', 'ASC')
                        ->pluck('time');

                    if (!is_null($bestTime)) {
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

                    $bestTime = WorkoutUser::where('workout_id', $request->workout_id)
                        ->where('focus', 3)
                        ->where('user_id', $request->user_id)
                        ->orderBy('time', 'ASC')
                        ->pluck('time');

                    if (!is_null($bestTime)) {
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
      "id": "15",
      "name": "Mimir",
      "description": "C,D,E",
      "rounds": "4",
      "category": "2",
      "type": "2",
      "rewards": "{\"lean\":\"330\",\"athletic\":\"440\",\"strength\":\"550\"}",
      "duration": "900.00",
      "equipments": "Bar/Rings",
      "created_at": "2016-01-19 06:27:26",
      "progression_string": "Full Body, Push, Core",
      "exercises": {
      "round1": [
      {
      "id": "618",
      "workout_id": "15",
      "category": "2",
      "repititions": "10",
      "exercise_id": "31",
      "unit": "times",
      "round": "1",
      "created_at": "2016-01-19 06:29:26",
      "updated_at": "2016-04-04 11:05:52",
      "video": {
      "id": "28",
      "path": "31_1454041910.mp4",
      "videothumbnail": "31_1454041910.jpg",
      "description": "Burpee"
      },
      "exercise": {
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
      "musclegroup_string": "Full Body"
      }
      },
      {
      "id": "622",
      "workout_id": "15",
      "category": "2",
      "repititions": "25",
      "exercise_id": "7",
      "unit": "times",
      "round": "1",
      "created_at": "2016-01-19 06:29:45",
      "updated_at": "2016-04-04 09:20:02",
      "video": {
      "id": "7",
      "path": "7_1453976943.mp4",
      "videothumbnail": "7_1453976943.jpg",
      "description": "Situps"
      },
      "exercise": {
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
      "musclegroup_string": "Core"
      }
      },
      {
      "id": "626",
      "workout_id": "15",
      "category": "2",
      "repititions": "50",
      "exercise_id": "38",
      "unit": "times",
      "round": "1",
      "created_at": "2016-01-19 06:30:05",
      "updated_at": "2016-04-04 11:15:22",
      "video": {
      "id": "35",
      "path": "38_1454042426.mp4",
      "videothumbnail": "38_1454042426.jpg",
      "description": "Lunge"
      },
      "exercise": {
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
      "musclegroup_string": "Legs"
      }
      },
      {
      "id": "630",
      "workout_id": "15",
      "category": "2",
      "repititions": "20",
      "exercise_id": "12",
      "unit": "times",
      "round": "1",
      "created_at": "2016-01-19 06:30:29",
      "updated_at": "2016-04-04 09:26:06",
      "video": {
      "id": "57",
      "path": "12_1453984139.mp4",
      "videothumbnail": "12_1453984139.jpg",
      "description": "Pushups"
      },
      "exercise": {
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
      "musclegroup_string": "Shoulders, Chest, Triceps"
      }
      }
      ],
      "round2": [
      {
      "id": "619",
      "workout_id": "15",
      "category": "2",
      "repititions": "10",
      "exercise_id": "31",
      "unit": "times",
      "round": "2",
      "created_at": "2016-01-19 06:29:26",
      "updated_at": "2016-04-04 11:05:52",
      "video": {
      "id": "28",
      "path": "31_1454041910.mp4",
      "videothumbnail": "31_1454041910.jpg",
      "description": "Burpee"
      },
      "exercise": {
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
      "musclegroup_string": "Full Body"
      }
      },
      {
      "id": "623",
      "workout_id": "15",
      "category": "2",
      "repititions": "25",
      "exercise_id": "7",
      "unit": "times",
      "round": "2",
      "created_at": "2016-01-19 06:29:45",
      "updated_at": "2016-04-04 09:20:02",
      "video": {
      "id": "7",
      "path": "7_1453976943.mp4",
      "videothumbnail": "7_1453976943.jpg",
      "description": "Situps"
      },
      "exercise": {
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
      "musclegroup_string": "Core"
      }
      },
      {
      "id": "627",
      "workout_id": "15",
      "category": "2",
      "repititions": "50",
      "exercise_id": "38",
      "unit": "times",
      "round": "2",
      "created_at": "2016-01-19 06:30:05",
      "updated_at": "2016-04-04 11:15:22",
      "video": {
      "id": "35",
      "path": "38_1454042426.mp4",
      "videothumbnail": "38_1454042426.jpg",
      "description": "Lunge"
      },
      "exercise": {
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
      "musclegroup_string": "Legs"
      }
      },
      {
      "id": "631",
      "workout_id": "15",
      "category": "2",
      "repititions": "20",
      "exercise_id": "12",
      "unit": "times",
      "round": "2",
      "created_at": "2016-01-19 06:30:29",
      "updated_at": "2016-04-04 09:26:06",
      "video": {
      "id": "57",
      "path": "12_1453984139.mp4",
      "videothumbnail": "12_1453984139.jpg",
      "description": "Pushups"
      },
      "exercise": {
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
      "musclegroup_string": "Shoulders, Chest, Triceps"
      }
      }
      ],
      "round3": [
      {
      "id": "620",
      "workout_id": "15",
      "category": "2",
      "repititions": "10",
      "exercise_id": "31",
      "unit": "times",
      "round": "3",
      "created_at": "2016-01-19 06:29:26",
      "updated_at": "2016-04-04 11:05:52",
      "video": {
      "id": "28",
      "path": "31_1454041910.mp4",
      "videothumbnail": "31_1454041910.jpg",
      "description": "Burpee"
      },
      "exercise": {
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
      "musclegroup_string": "Full Body"
      }
      },
      {
      "id": "624",
      "workout_id": "15",
      "category": "2",
      "repititions": "25",
      "exercise_id": "7",
      "unit": "times",
      "round": "3",
      "created_at": "2016-01-19 06:29:45",
      "updated_at": "2016-04-04 09:20:02",
      "video": {
      "id": "7",
      "path": "7_1453976943.mp4",
      "videothumbnail": "7_1453976943.jpg",
      "description": "Situps"
      },
      "exercise": {
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
      "musclegroup_string": "Core"
      }
      },
      {
      "id": "628",
      "workout_id": "15",
      "category": "2",
      "repititions": "50",
      "exercise_id": "38",
      "unit": "times",
      "round": "3",
      "created_at": "2016-01-19 06:30:05",
      "updated_at": "2016-04-04 11:15:22",
      "video": {
      "id": "35",
      "path": "38_1454042426.mp4",
      "videothumbnail": "38_1454042426.jpg",
      "description": "Lunge"
      },
      "exercise": {
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
      "musclegroup_string": "Legs"
      }
      },
      {
      "id": "632",
      "workout_id": "15",
      "category": "2",
      "repititions": "20",
      "exercise_id": "12",
      "unit": "times",
      "round": "3",
      "created_at": "2016-01-19 06:30:29",
      "updated_at": "2016-04-04 09:26:06",
      "video": {
      "id": "57",
      "path": "12_1453984139.mp4",
      "videothumbnail": "12_1453984139.jpg",
      "description": "Pushups"
      },
      "exercise": {
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
      "musclegroup_string": "Shoulders, Chest, Triceps"
      }
      }
      ],
      "round4": [
      {
      "id": "621",
      "workout_id": "15",
      "category": "2",
      "repititions": "10",
      "exercise_id": "31",
      "unit": "times",
      "round": "4",
      "created_at": "2016-01-19 06:29:26",
      "updated_at": "2016-04-04 11:05:52",
      "video": {
      "id": "28",
      "path": "31_1454041910.mp4",
      "videothumbnail": "31_1454041910.jpg",
      "description": "Burpee"
      },
      "exercise": {
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
      "musclegroup_string": "Full Body"
      }
      },
      {
      "id": "625",
      "workout_id": "15",
      "category": "2",
      "repititions": "25",
      "exercise_id": "7",
      "unit": "times",
      "round": "4",
      "created_at": "2016-01-19 06:29:45",
      "updated_at": "2016-04-04 09:20:02",
      "video": {
      "id": "7",
      "path": "7_1453976943.mp4",
      "videothumbnail": "7_1453976943.jpg",
      "description": "Situps"
      },
      "exercise": {
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
      "musclegroup_string": "Core"
      }
      },
      {
      "id": "629",
      "workout_id": "15",
      "category": "2",
      "repititions": "50",
      "exercise_id": "38",
      "unit": "times",
      "round": "4",
      "created_at": "2016-01-19 06:30:05",
      "updated_at": "2016-04-04 11:15:22",
      "video": {
      "id": "35",
      "path": "38_1454042426.mp4",
      "videothumbnail": "38_1454042426.jpg",
      "description": "Lunge"
      },
      "exercise": {
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
      "musclegroup_string": "Legs"
      }
      },
      {
      "id": "633",
      "workout_id": "15",
      "category": "2",
      "repititions": "20",
      "exercise_id": "12",
      "unit": "times",
      "round": "4",
      "created_at": "2016-01-19 06:30:29",
      "updated_at": "2016-04-04 09:26:06",
      "video": {
      "id": "57",
      "path": "12_1453984139.mp4",
      "videothumbnail": "12_1453984139.jpg",
      "description": "Pushups"
      },
      "exercise": {
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
      "musclegroup_string": "Shoulders, Chest, Triceps"
      }
      }
      ]
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

                $workoutArray['rewards'] = json_decode($workoutArray['rewards'], TRUE);

                $workoutArray['exercises'] = $exercises;

                return response()->json(['status' => 1, 'workout' => $workoutArray, 'urls' => config('urls.urls')], 200);
            } else {
                return response()->json(['status' => 0, 'error' => 'workout_not_exists'], 500);
            }
        }
    }
}
