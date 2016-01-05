<?php namespace App\Http\Controllers\Api;

use Auth,
    DB;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\User;
use App\Exercise;
use App\Exerciseuser;
use App\Coach;
use Carbon\Carbon;

class CoachesController extends Controller
{
    /*
      |--------------------------------------------------------------------------
      | Exercises Controller
      |--------------------------------------------------------------------------
      |
      | This controller handles coaches and Algorithm.
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
     * @api {post} /coach/get getCoach
     * @apiName getCoach
     * @apiGroup Coach
     * @apiParam {Number} user_id Id of user 
     * @apiSuccess {String} success.
     * @apiSuccessExample Success-Response:
     * HTTP/1.1 200 OK
     * {
      "status": 1,
      "coach_day": "1",
      "coach_week": "3",
      "is_subscribed": 0,
      "need_update": 0,
      "coach": {
      "id": "1",
      "user_id": "82",
      "focus": "3",
      "height": "172.00",
      "weight": "176.00",
      "days": "2",
      "exercises": {
      "day1": {
      "warmup": {
      "exercise_id": "warmup",
      "duration": 300
      },
      "fundumentals": [
      {
      "exercise_id": 43,
      "duration": 30,
      "exercise": {
      "id": "43",
      "name": "Pushups",
      "description": "",
      "category": "2",
      "type": "1",
      "rewards": "6.00",
      "repititions": "10",
      "duration": "1.00",
      "unit": "times",
      "equipment": "",
      "video": [
      {
      "id": "43",
      "path": "Now43.mp4",
      "videothumbnail": "thumbnail3.jpg",
      "description": "Test Description"
      }
      ]
      }
      },
      {
      "exercise_id": 32,
      "duration": 10,
      "exercise": {
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
      "video": [
      {
      "id": "32",
      "path": "Now32.mp4",
      "videothumbnail": "thumbnail1.png",
      "description": "Test Description"
      }
      ]
      }
      },
      {
      "exercise_id": 38,
      "duration": 25,
      "exercise": {
      "id": "38",
      "name": "Squats",
      "description": "",
      "category": "2",
      "type": "1",
      "rewards": "6.00",
      "repititions": "10",
      "duration": "1.00",
      "unit": "times",
      "equipment": "",
      "video": [
      {
      "id": "38",
      "path": "Now38.mp4",
      "videothumbnail": "thumbnail1.png",
      "description": "Test Description"
      }
      ]
      }
      },
      {
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
      "video": [
      {
      "id": "1",
      "path": "Now1.mp4",
      "videothumbnail": "thumbnail3.jpg",
      "description": "Test Description"
      }
      ]
      }
      }
      ],
      "exercises": [],
      "workout": {
      "id": "2",
      "name": "Borr",
      "description": "Borr Borr Borr",
      "rounds": "3",
      "category": "2",
      "type": "1",
      "rewards": "{\"lean\":330,\"athletic\":440,\"strength\":550}",
      "duration": "19.00",
      "equipments": "Bar",
      "exercises": {
      "round1": [
      {
      "id": "46",
      "workout_id": "2",
      "category": "1",
      "repititions": "25",
      "exercise_id": "11",
      "unit": "times",
      "round": "1",
      "created_at": "2015-11-18 18:30:00",
      "updated_at": "2015-12-07 10:17:23",
      "video": {
      "id": "11",
      "path": "Now11.mp4",
      "videothumbnail": "thumbnail1.png",
      "description": "Test Description"
      },
      "exercise": {
      "id": "11",
      "name": "Sprawl",
      "description": ""
      }
      },
      {
      "id": "47",
      "workout_id": "2",
      "category": "1",
      "repititions": "10",
      "exercise_id": "1",
      "unit": "times",
      "round": "1",
      "created_at": "2015-11-18 18:30:00",
      "updated_at": "2015-12-07 10:17:23",
      "video": {
      "id": "1",
      "path": "Now1.mp4",
      "videothumbnail": "thumbnail3.jpg",
      "description": "Test Description"
      },
      "exercise": {
      "id": "1",
      "name": "Jumping Pullups",
      "description": "The jumping pull-up is a challenging full body exercise that targets the back, legs and arms."
      }
      },
      {
      "id": "48",
      "workout_id": "2",
      "category": "1",
      "repititions": "30",
      "exercise_id": "16",
      "unit": "times",
      "round": "1",
      "created_at": "2015-11-18 18:30:00",
      "updated_at": "2015-12-07 10:17:23",
      "video": {
      "id": "16",
      "path": "Now16.mp4",
      "videothumbnail": "thumbnail3.jpg",
      "description": "Test Description"
      },
      "exercise": {
      "id": "16",
      "name": "Crunches",
      "description": ""
      }
      },
      {
      "id": "49",
      "workout_id": "2",
      "category": "1",
      "repititions": "40",
      "exercise_id": "5",
      "unit": "times",
      "round": "1",
      "created_at": "2015-11-18 18:30:00",
      "updated_at": "2015-12-07 10:17:23",
      "video": {
      "id": "5",
      "path": "Now5.mp4",
      "videothumbnail": "thumbnail1.png",
      "description": "Test Description"
      },
      "exercise": {
      "id": "5",
      "name": "Side Trizeps",
      "description": ""
      }
      },
      {
      "id": "58",
      "workout_id": "2",
      "category": "2",
      "repititions": "25",
      "exercise_id": "42",
      "unit": "times",
      "round": "1",
      "created_at": "2015-11-18 18:30:00",
      "updated_at": "2015-12-07 10:17:23",
      "video": {
      "id": "42",
      "path": "Now42.mp4",
      "videothumbnail": "thumbnail2.png",
      "description": "Test Description"
      },
      "exercise": {
      "id": "42",
      "name": "Burpee",
      "description": ""
      }
      },
      {
      "id": "59",
      "workout_id": "2",
      "category": "2",
      "repititions": "10",
      "exercise_id": "32",
      "unit": "times",
      "round": "1",
      "created_at": "2015-11-18 18:30:00",
      "updated_at": "2015-12-07 10:17:23",
      "video": {
      "id": "32",
      "path": "Now32.mp4",
      "videothumbnail": "thumbnail1.png",
      "description": "Test Description"
      },
      "exercise": {
      "id": "32",
      "name": "Pull ups / Chin ups",
      "description": ""
      }
      },
      {
      "id": "60",
      "workout_id": "2",
      "category": "2",
      "repititions": "30",
      "exercise_id": "47",
      "unit": "times",
      "round": "1",
      "created_at": "2015-11-18 18:30:00",
      "updated_at": "2015-12-07 10:17:23",
      "video": {
      "id": "47",
      "path": "Now47.mp4",
      "videothumbnail": "thumbnail2.png",
      "description": "Test Description"
      },
      "exercise": {
      "id": "47",
      "name": "Situps",
      "description": ""
      }
      },
      {
      "id": "61",
      "workout_id": "2",
      "category": "2",
      "repititions": "40",
      "exercise_id": "36",
      "unit": "times",
      "round": "1",
      "created_at": "2015-11-18 18:30:00",
      "updated_at": "2015-12-07 10:17:23",
      "video": {
      "id": "36",
      "path": "Now36.mp4",
      "videothumbnail": "thumbnail2.png",
      "description": "Test Description"
      },
      "exercise": {
      "id": "36",
      "name": "Dips (Bench)",
      "description": ""
      }
      },
      {
      "id": "70",
      "workout_id": "2",
      "category": "3",
      "repititions": "25",
      "exercise_id": "72",
      "unit": "times",
      "round": "1",
      "created_at": "2015-11-18 18:30:00",
      "updated_at": "2015-12-07 10:17:23",
      "video": {
      "id": "73",
      "path": "Now73.mp4",
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
      "workout_id": "2",
      "category": "3",
      "repititions": "10",
      "exercise_id": "69",
      "unit": "times",
      "round": "1",
      "created_at": "2015-11-18 18:30:00",
      "updated_at": "2015-12-07 10:17:23",
      "video": {
      "id": "69",
      "path": "Now69.mp4",
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
      "workout_id": "2",
      "category": "3",
      "repititions": "30",
      "exercise_id": "75",
      "unit": "times",
      "round": "1",
      "created_at": "2015-11-18 18:30:00",
      "updated_at": "2015-12-07 10:17:23",
      "video": {
      "id": "76",
      "path": "Now76.mp4",
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
      "workout_id": "2",
      "category": "3",
      "repititions": "40",
      "exercise_id": "70",
      "unit": "times",
      "round": "1",
      "created_at": "2015-11-18 18:30:00",
      "updated_at": "2015-12-07 10:17:23",
      "video": {
      "id": "70",
      "path": "Now70.mp4",
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
      "id": "50",
      "workout_id": "2",
      "category": "1",
      "repititions": "25",
      "exercise_id": "11",
      "unit": "times",
      "round": "2",
      "created_at": "2015-11-18 18:30:00",
      "updated_at": "2015-12-07 10:17:23",
      "video": {
      "id": "11",
      "path": "Now11.mp4",
      "videothumbnail": "thumbnail1.png",
      "description": "Test Description"
      },
      "exercise": {
      "id": "11",
      "name": "Sprawl",
      "description": ""
      }
      },
      {
      "id": "51",
      "workout_id": "2",
      "category": "1",
      "repititions": "10",
      "exercise_id": "1",
      "unit": "times",
      "round": "2",
      "created_at": "2015-11-18 18:30:00",
      "updated_at": "2015-12-07 10:17:23",
      "video": {
      "id": "1",
      "path": "Now1.mp4",
      "videothumbnail": "thumbnail3.jpg",
      "description": "Test Description"
      },
      "exercise": {
      "id": "1",
      "name": "Jumping Pullups",
      "description": "The jumping pull-up is a challenging full body exercise that targets the back, legs and arms."
      }
      },
      {
      "id": "52",
      "workout_id": "2",
      "category": "1",
      "repititions": "30",
      "exercise_id": "16",
      "unit": "times",
      "round": "2",
      "created_at": "2015-11-18 18:30:00",
      "updated_at": "2015-12-07 10:17:23",
      "video": {
      "id": "16",
      "path": "Now16.mp4",
      "videothumbnail": "thumbnail3.jpg",
      "description": "Test Description"
      },
      "exercise": {
      "id": "16",
      "name": "Crunches",
      "description": ""
      }
      },
      {
      "id": "53",
      "workout_id": "2",
      "category": "1",
      "repititions": "40",
      "exercise_id": "5",
      "unit": "times",
      "round": "2",
      "created_at": "2015-11-18 18:30:00",
      "updated_at": "2015-12-07 10:17:23",
      "video": {
      "id": "5",
      "path": "Now5.mp4",
      "videothumbnail": "thumbnail1.png",
      "description": "Test Description"
      },
      "exercise": {
      "id": "5",
      "name": "Side Trizeps",
      "description": ""
      }
      },
      {
      "id": "62",
      "workout_id": "2",
      "category": "2",
      "repititions": "25",
      "exercise_id": "42",
      "unit": "times",
      "round": "2",
      "created_at": "2015-11-18 18:30:00",
      "updated_at": "2015-12-07 10:17:23",
      "video": {
      "id": "42",
      "path": "Now42.mp4",
      "videothumbnail": "thumbnail2.png",
      "description": "Test Description"
      },
      "exercise": {
      "id": "42",
      "name": "Burpee",
      "description": ""
      }
      },
      {
      "id": "63",
      "workout_id": "2",
      "category": "2",
      "repititions": "10",
      "exercise_id": "32",
      "unit": "times",
      "round": "2",
      "created_at": "2015-11-18 18:30:00",
      "updated_at": "2015-12-07 10:17:23",
      "video": {
      "id": "32",
      "path": "Now32.mp4",
      "videothumbnail": "thumbnail1.png",
      "description": "Test Description"
      },
      "exercise": {
      "id": "32",
      "name": "Pull ups / Chin ups",
      "description": ""
      }
      },
      {
      "id": "64",
      "workout_id": "2",
      "category": "2",
      "repititions": "30",
      "exercise_id": "47",
      "unit": "times",
      "round": "2",
      "created_at": "2015-11-18 18:30:00",
      "updated_at": "2015-12-07 10:17:23",
      "video": {
      "id": "47",
      "path": "Now47.mp4",
      "videothumbnail": "thumbnail2.png",
      "description": "Test Description"
      },
      "exercise": {
      "id": "47",
      "name": "Situps",
      "description": ""
      }
      },
      {
      "id": "65",
      "workout_id": "2",
      "category": "2",
      "repititions": "40",
      "exercise_id": "36",
      "unit": "times",
      "round": "2",
      "created_at": "2015-11-18 18:30:00",
      "updated_at": "2015-12-07 10:17:23",
      "video": {
      "id": "36",
      "path": "Now36.mp4",
      "videothumbnail": "thumbnail2.png",
      "description": "Test Description"
      },
      "exercise": {
      "id": "36",
      "name": "Dips (Bench)",
      "description": ""
      }
      },
      {
      "id": "74",
      "workout_id": "2",
      "category": "3",
      "repititions": "25",
      "exercise_id": "72",
      "unit": "times",
      "round": "2",
      "created_at": "2015-11-18 18:30:00",
      "updated_at": "2015-12-07 10:17:23",
      "video": {
      "id": "73",
      "path": "Now73.mp4",
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
      "workout_id": "2",
      "category": "3",
      "repititions": "10",
      "exercise_id": "69",
      "unit": "times",
      "round": "2",
      "created_at": "2015-11-18 18:30:00",
      "updated_at": "2015-12-07 10:17:23",
      "video": {
      "id": "69",
      "path": "Now69.mp4",
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
      "workout_id": "2",
      "category": "3",
      "repititions": "30",
      "exercise_id": "75",
      "unit": "times",
      "round": "2",
      "created_at": "2015-11-18 18:30:00",
      "updated_at": "2015-12-07 10:17:23",
      "video": {
      "id": "76",
      "path": "Now76.mp4",
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
      "workout_id": "2",
      "category": "3",
      "repititions": "40",
      "exercise_id": "70",
      "unit": "times",
      "round": "2",
      "created_at": "2015-11-18 18:30:00",
      "updated_at": "2015-12-07 10:17:23",
      "video": {
      "id": "70",
      "path": "Now70.mp4",
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
      "id": "54",
      "workout_id": "2",
      "category": "1",
      "repititions": "25",
      "exercise_id": "11",
      "unit": "times",
      "round": "3",
      "created_at": "2015-11-18 18:30:00",
      "updated_at": "2015-12-07 10:17:23",
      "video": {
      "id": "11",
      "path": "Now11.mp4",
      "videothumbnail": "thumbnail1.png",
      "description": "Test Description"
      },
      "exercise": {
      "id": "11",
      "name": "Sprawl",
      "description": ""
      }
      },
      {
      "id": "55",
      "workout_id": "2",
      "category": "1",
      "repititions": "10",
      "exercise_id": "1",
      "unit": "times",
      "round": "3",
      "created_at": "2015-11-18 18:30:00",
      "updated_at": "2015-12-07 10:17:23",
      "video": {
      "id": "1",
      "path": "Now1.mp4",
      "videothumbnail": "thumbnail3.jpg",
      "description": "Test Description"
      },
      "exercise": {
      "id": "1",
      "name": "Jumping Pullups",
      "description": "The jumping pull-up is a challenging full body exercise that targets the back, legs and arms."
      }
      },
      {
      "id": "56",
      "workout_id": "2",
      "category": "1",
      "repititions": "30",
      "exercise_id": "16",
      "unit": "times",
      "round": "3",
      "created_at": "2015-11-18 18:30:00",
      "updated_at": "2015-12-07 10:17:23",
      "video": {
      "id": "16",
      "path": "Now16.mp4",
      "videothumbnail": "thumbnail3.jpg",
      "description": "Test Description"
      },
      "exercise": {
      "id": "16",
      "name": "Crunches",
      "description": ""
      }
      },
      {
      "id": "57",
      "workout_id": "2",
      "category": "1",
      "repititions": "40",
      "exercise_id": "5",
      "unit": "times",
      "round": "3",
      "created_at": "2015-11-18 18:30:00",
      "updated_at": "2015-12-07 10:17:23",
      "video": {
      "id": "5",
      "path": "Now5.mp4",
      "videothumbnail": "thumbnail1.png",
      "description": "Test Description"
      },
      "exercise": {
      "id": "5",
      "name": "Side Trizeps",
      "description": ""
      }
      },
      {
      "id": "66",
      "workout_id": "2",
      "category": "2",
      "repititions": "25",
      "exercise_id": "42",
      "unit": "times",
      "round": "3",
      "created_at": "2015-11-18 18:30:00",
      "updated_at": "2015-12-07 10:17:23",
      "video": {
      "id": "42",
      "path": "Now42.mp4",
      "videothumbnail": "thumbnail2.png",
      "description": "Test Description"
      },
      "exercise": {
      "id": "42",
      "name": "Burpee",
      "description": ""
      }
      },
      {
      "id": "67",
      "workout_id": "2",
      "category": "2",
      "repititions": "10",
      "exercise_id": "32",
      "unit": "times",
      "round": "3",
      "created_at": "2015-11-18 18:30:00",
      "updated_at": "2015-12-07 10:17:23",
      "video": {
      "id": "32",
      "path": "Now32.mp4",
      "videothumbnail": "thumbnail1.png",
      "description": "Test Description"
      },
      "exercise": {
      "id": "32",
      "name": "Pull ups / Chin ups",
      "description": ""
      }
      },
      {
      "id": "68",
      "workout_id": "2",
      "category": "2",
      "repititions": "30",
      "exercise_id": "47",
      "unit": "times",
      "round": "3",
      "created_at": "2015-11-18 18:30:00",
      "updated_at": "2015-12-07 10:17:23",
      "video": {
      "id": "47",
      "path": "Now47.mp4",
      "videothumbnail": "thumbnail2.png",
      "description": "Test Description"
      },
      "exercise": {
      "id": "47",
      "name": "Situps",
      "description": ""
      }
      },
      {
      "id": "69",
      "workout_id": "2",
      "category": "2",
      "repititions": "40",
      "exercise_id": "36",
      "unit": "times",
      "round": "3",
      "created_at": "2015-11-18 18:30:00",
      "updated_at": "2015-12-07 10:17:23",
      "video": {
      "id": "36",
      "path": "Now36.mp4",
      "videothumbnail": "thumbnail2.png",
      "description": "Test Description"
      },
      "exercise": {
      "id": "36",
      "name": "Dips (Bench)",
      "description": ""
      }
      },
      {
      "id": "78",
      "workout_id": "2",
      "category": "3",
      "repititions": "25",
      "exercise_id": "72",
      "unit": "times",
      "round": "3",
      "created_at": "2015-11-18 18:30:00",
      "updated_at": "2015-12-07 10:17:23",
      "video": {
      "id": "73",
      "path": "Now73.mp4",
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
      "workout_id": "2",
      "category": "3",
      "repititions": "10",
      "exercise_id": "69",
      "unit": "times",
      "round": "3",
      "created_at": "2015-11-18 18:30:00",
      "updated_at": "2015-12-07 10:17:23",
      "video": {
      "id": "69",
      "path": "Now69.mp4",
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
      "workout_id": "2",
      "category": "3",
      "repititions": "30",
      "exercise_id": "75",
      "unit": "times",
      "round": "3",
      "created_at": "2015-11-18 18:30:00",
      "updated_at": "2015-12-07 10:17:23",
      "video": {
      "id": "76",
      "path": "Now76.mp4",
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
      "workout_id": "2",
      "category": "3",
      "repititions": "40",
      "exercise_id": "70",
      "unit": "times",
      "round": "3",
      "created_at": "2015-11-18 18:30:00",
      "updated_at": "2015-12-07 10:17:23",
      "video": {
      "id": "70",
      "path": "Now70.mp4",
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
      "round4": [
      {
      "id": "46",
      "workout_id": "2",
      "category": "1",
      "repititions": "25",
      "exercise_id": "11",
      "unit": "times",
      "round": "1",
      "created_at": "2015-11-18 18:30:00",
      "updated_at": "2015-12-07 10:17:23",
      "video": {
      "id": "11",
      "path": "Now11.mp4",
      "videothumbnail": "thumbnail1.png",
      "description": "Test Description"
      },
      "exercise": {
      "id": "11",
      "name": "Sprawl",
      "description": ""
      }
      },
      {
      "id": "47",
      "workout_id": "2",
      "category": "1",
      "repititions": "10",
      "exercise_id": "1",
      "unit": "times",
      "round": "1",
      "created_at": "2015-11-18 18:30:00",
      "updated_at": "2015-12-07 10:17:23",
      "video": {
      "id": "1",
      "path": "Now1.mp4",
      "videothumbnail": "thumbnail3.jpg",
      "description": "Test Description"
      },
      "exercise": {
      "id": "1",
      "name": "Jumping Pullups",
      "description": "The jumping pull-up is a challenging full body exercise that targets the back, legs and arms."
      }
      },
      {
      "id": "48",
      "workout_id": "2",
      "category": "1",
      "repititions": "30",
      "exercise_id": "16",
      "unit": "times",
      "round": "1",
      "created_at": "2015-11-18 18:30:00",
      "updated_at": "2015-12-07 10:17:23",
      "video": {
      "id": "16",
      "path": "Now16.mp4",
      "videothumbnail": "thumbnail3.jpg",
      "description": "Test Description"
      },
      "exercise": {
      "id": "16",
      "name": "Crunches",
      "description": ""
      }
      },
      {
      "id": "49",
      "workout_id": "2",
      "category": "1",
      "repititions": "40",
      "exercise_id": "5",
      "unit": "times",
      "round": "1",
      "created_at": "2015-11-18 18:30:00",
      "updated_at": "2015-12-07 10:17:23",
      "video": {
      "id": "5",
      "path": "Now5.mp4",
      "videothumbnail": "thumbnail1.png",
      "description": "Test Description"
      },
      "exercise": {
      "id": "5",
      "name": "Side Trizeps",
      "description": ""
      }
      },
      {
      "id": "58",
      "workout_id": "2",
      "category": "2",
      "repititions": "25",
      "exercise_id": "42",
      "unit": "times",
      "round": "1",
      "created_at": "2015-11-18 18:30:00",
      "updated_at": "2015-12-07 10:17:23",
      "video": {
      "id": "42",
      "path": "Now42.mp4",
      "videothumbnail": "thumbnail2.png",
      "description": "Test Description"
      },
      "exercise": {
      "id": "42",
      "name": "Burpee",
      "description": ""
      }
      },
      {
      "id": "59",
      "workout_id": "2",
      "category": "2",
      "repititions": "10",
      "exercise_id": "32",
      "unit": "times",
      "round": "1",
      "created_at": "2015-11-18 18:30:00",
      "updated_at": "2015-12-07 10:17:23",
      "video": {
      "id": "32",
      "path": "Now32.mp4",
      "videothumbnail": "thumbnail1.png",
      "description": "Test Description"
      },
      "exercise": {
      "id": "32",
      "name": "Pull ups / Chin ups",
      "description": ""
      }
      },
      {
      "id": "60",
      "workout_id": "2",
      "category": "2",
      "repititions": "30",
      "exercise_id": "47",
      "unit": "times",
      "round": "1",
      "created_at": "2015-11-18 18:30:00",
      "updated_at": "2015-12-07 10:17:23",
      "video": {
      "id": "47",
      "path": "Now47.mp4",
      "videothumbnail": "thumbnail2.png",
      "description": "Test Description"
      },
      "exercise": {
      "id": "47",
      "name": "Situps",
      "description": ""
      }
      },
      {
      "id": "61",
      "workout_id": "2",
      "category": "2",
      "repititions": "40",
      "exercise_id": "36",
      "unit": "times",
      "round": "1",
      "created_at": "2015-11-18 18:30:00",
      "updated_at": "2015-12-07 10:17:23",
      "video": {
      "id": "36",
      "path": "Now36.mp4",
      "videothumbnail": "thumbnail2.png",
      "description": "Test Description"
      },
      "exercise": {
      "id": "36",
      "name": "Dips (Bench)",
      "description": ""
      }
      },
      {
      "id": "70",
      "workout_id": "2",
      "category": "3",
      "repititions": "25",
      "exercise_id": "72",
      "unit": "times",
      "round": "1",
      "created_at": "2015-11-18 18:30:00",
      "updated_at": "2015-12-07 10:17:23",
      "video": {
      "id": "73",
      "path": "Now73.mp4",
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
      "workout_id": "2",
      "category": "3",
      "repititions": "10",
      "exercise_id": "69",
      "unit": "times",
      "round": "1",
      "created_at": "2015-11-18 18:30:00",
      "updated_at": "2015-12-07 10:17:23",
      "video": {
      "id": "69",
      "path": "Now69.mp4",
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
      "workout_id": "2",
      "category": "3",
      "repititions": "30",
      "exercise_id": "75",
      "unit": "times",
      "round": "1",
      "created_at": "2015-11-18 18:30:00",
      "updated_at": "2015-12-07 10:17:23",
      "video": {
      "id": "76",
      "path": "Now76.mp4",
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
      "workout_id": "2",
      "category": "3",
      "repititions": "40",
      "exercise_id": "70",
      "unit": "times",
      "round": "1",
      "created_at": "2015-11-18 18:30:00",
      "updated_at": "2015-12-07 10:17:23",
      "video": {
      "id": "70",
      "path": "Now70.mp4",
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
      "round5": [
      {
      "id": "50",
      "workout_id": "2",
      "category": "1",
      "repititions": "25",
      "exercise_id": "11",
      "unit": "times",
      "round": "2",
      "created_at": "2015-11-18 18:30:00",
      "updated_at": "2015-12-07 10:17:23",
      "video": {
      "id": "11",
      "path": "Now11.mp4",
      "videothumbnail": "thumbnail1.png",
      "description": "Test Description"
      },
      "exercise": {
      "id": "11",
      "name": "Sprawl",
      "description": ""
      }
      },
      {
      "id": "51",
      "workout_id": "2",
      "category": "1",
      "repititions": "10",
      "exercise_id": "1",
      "unit": "times",
      "round": "2",
      "created_at": "2015-11-18 18:30:00",
      "updated_at": "2015-12-07 10:17:23",
      "video": {
      "id": "1",
      "path": "Now1.mp4",
      "videothumbnail": "thumbnail3.jpg",
      "description": "Test Description"
      },
      "exercise": {
      "id": "1",
      "name": "Jumping Pullups",
      "description": "The jumping pull-up is a challenging full body exercise that targets the back, legs and arms."
      }
      },
      {
      "id": "52",
      "workout_id": "2",
      "category": "1",
      "repititions": "30",
      "exercise_id": "16",
      "unit": "times",
      "round": "2",
      "created_at": "2015-11-18 18:30:00",
      "updated_at": "2015-12-07 10:17:23",
      "video": {
      "id": "16",
      "path": "Now16.mp4",
      "videothumbnail": "thumbnail3.jpg",
      "description": "Test Description"
      },
      "exercise": {
      "id": "16",
      "name": "Crunches",
      "description": ""
      }
      },
      {
      "id": "53",
      "workout_id": "2",
      "category": "1",
      "repititions": "40",
      "exercise_id": "5",
      "unit": "times",
      "round": "2",
      "created_at": "2015-11-18 18:30:00",
      "updated_at": "2015-12-07 10:17:23",
      "video": {
      "id": "5",
      "path": "Now5.mp4",
      "videothumbnail": "thumbnail1.png",
      "description": "Test Description"
      },
      "exercise": {
      "id": "5",
      "name": "Side Trizeps",
      "description": ""
      }
      },
      {
      "id": "62",
      "workout_id": "2",
      "category": "2",
      "repititions": "25",
      "exercise_id": "42",
      "unit": "times",
      "round": "2",
      "created_at": "2015-11-18 18:30:00",
      "updated_at": "2015-12-07 10:17:23",
      "video": {
      "id": "42",
      "path": "Now42.mp4",
      "videothumbnail": "thumbnail2.png",
      "description": "Test Description"
      },
      "exercise": {
      "id": "42",
      "name": "Burpee",
      "description": ""
      }
      },
      {
      "id": "63",
      "workout_id": "2",
      "category": "2",
      "repititions": "10",
      "exercise_id": "32",
      "unit": "times",
      "round": "2",
      "created_at": "2015-11-18 18:30:00",
      "updated_at": "2015-12-07 10:17:23",
      "video": {
      "id": "32",
      "path": "Now32.mp4",
      "videothumbnail": "thumbnail1.png",
      "description": "Test Description"
      },
      "exercise": {
      "id": "32",
      "name": "Pull ups / Chin ups",
      "description": ""
      }
      },
      {
      "id": "64",
      "workout_id": "2",
      "category": "2",
      "repititions": "30",
      "exercise_id": "47",
      "unit": "times",
      "round": "2",
      "created_at": "2015-11-18 18:30:00",
      "updated_at": "2015-12-07 10:17:23",
      "video": {
      "id": "47",
      "path": "Now47.mp4",
      "videothumbnail": "thumbnail2.png",
      "description": "Test Description"
      },
      "exercise": {
      "id": "47",
      "name": "Situps",
      "description": ""
      }
      },
      {
      "id": "65",
      "workout_id": "2",
      "category": "2",
      "repititions": "40",
      "exercise_id": "36",
      "unit": "times",
      "round": "2",
      "created_at": "2015-11-18 18:30:00",
      "updated_at": "2015-12-07 10:17:23",
      "video": {
      "id": "36",
      "path": "Now36.mp4",
      "videothumbnail": "thumbnail2.png",
      "description": "Test Description"
      },
      "exercise": {
      "id": "36",
      "name": "Dips (Bench)",
      "description": ""
      }
      },
      {
      "id": "74",
      "workout_id": "2",
      "category": "3",
      "repititions": "25",
      "exercise_id": "72",
      "unit": "times",
      "round": "2",
      "created_at": "2015-11-18 18:30:00",
      "updated_at": "2015-12-07 10:17:23",
      "video": {
      "id": "73",
      "path": "Now73.mp4",
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
      "workout_id": "2",
      "category": "3",
      "repititions": "10",
      "exercise_id": "69",
      "unit": "times",
      "round": "2",
      "created_at": "2015-11-18 18:30:00",
      "updated_at": "2015-12-07 10:17:23",
      "video": {
      "id": "69",
      "path": "Now69.mp4",
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
      "workout_id": "2",
      "category": "3",
      "repititions": "30",
      "exercise_id": "75",
      "unit": "times",
      "round": "2",
      "created_at": "2015-11-18 18:30:00",
      "updated_at": "2015-12-07 10:17:23",
      "video": {
      "id": "76",
      "path": "Now76.mp4",
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
      "workout_id": "2",
      "category": "3",
      "repititions": "40",
      "exercise_id": "70",
      "unit": "times",
      "round": "2",
      "created_at": "2015-11-18 18:30:00",
      "updated_at": "2015-12-07 10:17:23",
      "video": {
      "id": "70",
      "path": "Now70.mp4",
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
      "round6": [
      {
      "id": "54",
      "workout_id": "2",
      "category": "1",
      "repititions": "25",
      "exercise_id": "11",
      "unit": "times",
      "round": "3",
      "created_at": "2015-11-18 18:30:00",
      "updated_at": "2015-12-07 10:17:23",
      "video": {
      "id": "11",
      "path": "Now11.mp4",
      "videothumbnail": "thumbnail1.png",
      "description": "Test Description"
      },
      "exercise": {
      "id": "11",
      "name": "Sprawl",
      "description": ""
      }
      },
      {
      "id": "55",
      "workout_id": "2",
      "category": "1",
      "repititions": "10",
      "exercise_id": "1",
      "unit": "times",
      "round": "3",
      "created_at": "2015-11-18 18:30:00",
      "updated_at": "2015-12-07 10:17:23",
      "video": {
      "id": "1",
      "path": "Now1.mp4",
      "videothumbnail": "thumbnail3.jpg",
      "description": "Test Description"
      },
      "exercise": {
      "id": "1",
      "name": "Jumping Pullups",
      "description": "The jumping pull-up is a challenging full body exercise that targets the back, legs and arms."
      }
      },
      {
      "id": "56",
      "workout_id": "2",
      "category": "1",
      "repititions": "30",
      "exercise_id": "16",
      "unit": "times",
      "round": "3",
      "created_at": "2015-11-18 18:30:00",
      "updated_at": "2015-12-07 10:17:23",
      "video": {
      "id": "16",
      "path": "Now16.mp4",
      "videothumbnail": "thumbnail3.jpg",
      "description": "Test Description"
      },
      "exercise": {
      "id": "16",
      "name": "Crunches",
      "description": ""
      }
      },
      {
      "id": "57",
      "workout_id": "2",
      "category": "1",
      "repititions": "40",
      "exercise_id": "5",
      "unit": "times",
      "round": "3",
      "created_at": "2015-11-18 18:30:00",
      "updated_at": "2015-12-07 10:17:23",
      "video": {
      "id": "5",
      "path": "Now5.mp4",
      "videothumbnail": "thumbnail1.png",
      "description": "Test Description"
      },
      "exercise": {
      "id": "5",
      "name": "Side Trizeps",
      "description": ""
      }
      },
      {
      "id": "66",
      "workout_id": "2",
      "category": "2",
      "repititions": "25",
      "exercise_id": "42",
      "unit": "times",
      "round": "3",
      "created_at": "2015-11-18 18:30:00",
      "updated_at": "2015-12-07 10:17:23",
      "video": {
      "id": "42",
      "path": "Now42.mp4",
      "videothumbnail": "thumbnail2.png",
      "description": "Test Description"
      },
      "exercise": {
      "id": "42",
      "name": "Burpee",
      "description": ""
      }
      },
      {
      "id": "67",
      "workout_id": "2",
      "category": "2",
      "repititions": "10",
      "exercise_id": "32",
      "unit": "times",
      "round": "3",
      "created_at": "2015-11-18 18:30:00",
      "updated_at": "2015-12-07 10:17:23",
      "video": {
      "id": "32",
      "path": "Now32.mp4",
      "videothumbnail": "thumbnail1.png",
      "description": "Test Description"
      },
      "exercise": {
      "id": "32",
      "name": "Pull ups / Chin ups",
      "description": ""
      }
      },
      {
      "id": "68",
      "workout_id": "2",
      "category": "2",
      "repititions": "30",
      "exercise_id": "47",
      "unit": "times",
      "round": "3",
      "created_at": "2015-11-18 18:30:00",
      "updated_at": "2015-12-07 10:17:23",
      "video": {
      "id": "47",
      "path": "Now47.mp4",
      "videothumbnail": "thumbnail2.png",
      "description": "Test Description"
      },
      "exercise": {
      "id": "47",
      "name": "Situps",
      "description": ""
      }
      },
      {
      "id": "69",
      "workout_id": "2",
      "category": "2",
      "repititions": "40",
      "exercise_id": "36",
      "unit": "times",
      "round": "3",
      "created_at": "2015-11-18 18:30:00",
      "updated_at": "2015-12-07 10:17:23",
      "video": {
      "id": "36",
      "path": "Now36.mp4",
      "videothumbnail": "thumbnail2.png",
      "description": "Test Description"
      },
      "exercise": {
      "id": "36",
      "name": "Dips (Bench)",
      "description": ""
      }
      },
      {
      "id": "78",
      "workout_id": "2",
      "category": "3",
      "repititions": "25",
      "exercise_id": "72",
      "unit": "times",
      "round": "3",
      "created_at": "2015-11-18 18:30:00",
      "updated_at": "2015-12-07 10:17:23",
      "video": {
      "id": "73",
      "path": "Now73.mp4",
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
      "workout_id": "2",
      "category": "3",
      "repititions": "10",
      "exercise_id": "69",
      "unit": "times",
      "round": "3",
      "created_at": "2015-11-18 18:30:00",
      "updated_at": "2015-12-07 10:17:23",
      "video": {
      "id": "69",
      "path": "Now69.mp4",
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
      "workout_id": "2",
      "category": "3",
      "repititions": "30",
      "exercise_id": "75",
      "unit": "times",
      "round": "3",
      "created_at": "2015-11-18 18:30:00",
      "updated_at": "2015-12-07 10:17:23",
      "video": {
      "id": "76",
      "path": "Now76.mp4",
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
      "workout_id": "2",
      "category": "3",
      "repititions": "40",
      "exercise_id": "70",
      "unit": "times",
      "round": "3",
      "created_at": "2015-11-18 18:30:00",
      "updated_at": "2015-12-07 10:17:23",
      "video": {
      "id": "70",
      "path": "Now70.mp4",
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
      "workout_intensity": 2,
      "hiit": [],
      "stretching": [
      {
      "exercise_id": "Superman",
      "duration": {
      "min": 5,
      "max": 10
      },
      "unit": "times"
      },
      {
      "exercise_id": "Lower Back Strength",
      "duration": {
      "min": 30,
      "max": 50
      },
      "unit": "times"
      },
      {
      "exercise_id": "Upper Dog",
      "duration": {
      "min": 30,
      "max": 60
      },
      "unit": "seconds"
      },
      {
      "exercise_id": "Child's Pose",
      "duration": {
      "min": 30,
      "max": 60
      },
      "unit": "seconds"
      },
      {
      "exercise_id": "L-sit on the floor",
      "duration": {
      "min": 30,
      "max": 60
      },
      "unit": "seconds"
      },
      {
      "exercise_id": "Frog stretch",
      "duration": {
      "min": 30,
      "max": 60
      },
      "unit": "seconds"
      },
      {
      "exercise_id": "Good morning",
      "duration": {
      "min": 30,
      "max": 60
      },
      "unit": "seconds"
      },
      {
      "exercise_id": "Chest Opener",
      "duration": {
      "min": 30,
      "max": 60
      },
      "unit": "seconds"
      },
      {
      "exercise_id": "Triceps Stretch",
      "duration": {
      "min": 30,
      "max": 60
      },
      "unit": "seconds"
      },
      {
      "exercise_id": "Hands Back",
      "duration": {
      "min": 30,
      "max": 60
      },
      "unit": "seconds"
      },
      {
      "exercise_id": "Shoulder Stretch",
      "duration": {
      "min": 30,
      "max": 60
      },
      "unit": "seconds"
      }
      ]
      },
      "day2": {
      "warmup": {
      "exercise_id": "warmup",
      "duration": 300
      },
      "fundumentals": [
      {
      "exercise_id": 43,
      "duration": 30,
      "exercise": {
      "id": "43",
      "name": "Pushups",
      "description": "",
      "category": "2",
      "type": "1",
      "rewards": "6.00",
      "repititions": "10",
      "duration": "1.00",
      "unit": "times",
      "equipment": "",
      "video": [
      {
      "id": "43",
      "path": "Now43.mp4",
      "videothumbnail": "thumbnail3.jpg",
      "description": "Test Description"
      }
      ]
      }
      },
      {
      "exercise_id": 32,
      "duration": 10,
      "exercise": {
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
      "video": [
      {
      "id": "32",
      "path": "Now32.mp4",
      "videothumbnail": "thumbnail1.png",
      "description": "Test Description"
      }
      ]
      }
      },
      {
      "exercise_id": 38,
      "duration": 25,
      "exercise": {
      "id": "38",
      "name": "Squats",
      "description": "",
      "category": "2",
      "type": "1",
      "rewards": "6.00",
      "repititions": "10",
      "duration": "1.00",
      "unit": "times",
      "equipment": "",
      "video": [
      {
      "id": "38",
      "path": "Now38.mp4",
      "videothumbnail": "thumbnail1.png",
      "description": "Test Description"
      }
      ]
      }
      },
      {
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
      "video": [
      {
      "id": "1",
      "path": "Now1.mp4",
      "videothumbnail": "thumbnail3.jpg",
      "description": "Test Description"
      }
      ]
      }
      }
      ],
      "exercises": [],
      "workout": {
      "id": "3",
      "name": "Bragi",
      "description": "Bragi",
      "rounds": "5",
      "category": "2",
      "type": "1",
      "rewards": "{\"lean\":330,\"athletic\":440,\"strength\":550}",
      "duration": "14.00",
      "equipments": "Low Bar",
      "exercises": {
      "round1": [
      {
      "id": "82",
      "workout_id": "3",
      "category": "1",
      "repititions": "50",
      "exercise_id": "12",
      "unit": "times",
      "round": "1",
      "created_at": "2015-11-18 18:30:00",
      "updated_at": "2015-11-19 10:00:00",
      "video": {
      "id": "12",
      "path": "Now12.mp4",
      "videothumbnail": "thumbnail2.png",
      "description": "Test Description"
      },
      "exercise": {
      "id": "12",
      "name": "Incline Pushups",
      "description": ""
      }
      },
      {
      "id": "83",
      "workout_id": "3",
      "category": "1",
      "repititions": "10",
      "exercise_id": "12",
      "unit": "times",
      "round": "1",
      "created_at": "2015-11-18 18:30:00",
      "updated_at": "2015-11-19 10:00:00",
      "video": {
      "id": "12",
      "path": "Now12.mp4",
      "videothumbnail": "thumbnail2.png",
      "description": "Test Description"
      },
      "exercise": {
      "id": "12",
      "name": "Incline Pushups",
      "description": ""
      }
      },
      {
      "id": "84",
      "workout_id": "3",
      "category": "1",
      "repititions": "25",
      "exercise_id": "11",
      "unit": "times",
      "round": "1",
      "created_at": "2015-11-18 18:30:00",
      "updated_at": "2015-11-19 10:00:00",
      "video": {
      "id": "11",
      "path": "Now11.mp4",
      "videothumbnail": "thumbnail1.png",
      "description": "Test Description"
      },
      "exercise": {
      "id": "11",
      "name": "Sprawl",
      "description": ""
      }
      },
      {
      "id": "85",
      "workout_id": "3",
      "category": "1",
      "repititions": "10",
      "exercise_id": "2",
      "unit": "times",
      "round": "1",
      "created_at": "2015-11-18 18:30:00",
      "updated_at": "2015-11-19 10:00:54",
      "video": {
      "id": "2",
      "path": "Now2.mp4",
      "videothumbnail": "thumbnail1.png",
      "description": "Test Description"
      },
      "exercise": {
      "id": "2",
      "name": "Australian Pullups",
      "description": "Australian pull-ups are becoming a very popular exercise. Like all types of pull-ups (and all types of exercises for that matter) there are many different ways to do the Australian, and it can be incorporated into a number of different contexts within a workout."
      }
      },
      {
      "id": "86",
      "workout_id": "3",
      "category": "1",
      "repititions": "20",
      "exercise_id": "90",
      "unit": "seconds",
      "round": "1",
      "created_at": "2015-11-18 18:30:00",
      "updated_at": "2015-11-19 10:45:38",
      "video": null,
      "exercise": {
      "id": "90",
      "name": "Rest",
      "description": "Rest"
      }
      },
      {
      "id": "102",
      "workout_id": "3",
      "category": "2",
      "repititions": "10",
      "exercise_id": "43",
      "unit": "times",
      "round": "1",
      "created_at": "2015-11-18 18:30:00",
      "updated_at": "2015-11-19 10:00:00",
      "video": {
      "id": "43",
      "path": "Now43.mp4",
      "videothumbnail": "thumbnail3.jpg",
      "description": "Test Description"
      },
      "exercise": {
      "id": "43",
      "name": "Pushups",
      "description": ""
      }
      },
      {
      "id": "103",
      "workout_id": "3",
      "category": "2",
      "repititions": "25",
      "exercise_id": "42",
      "unit": "times",
      "round": "1",
      "created_at": "2015-11-18 18:30:00",
      "updated_at": "2015-11-19 10:00:00",
      "video": {
      "id": "42",
      "path": "Now42.mp4",
      "videothumbnail": "thumbnail2.png",
      "description": "Test Description"
      },
      "exercise": {
      "id": "42",
      "name": "Burpee",
      "description": ""
      }
      },
      {
      "id": "104",
      "workout_id": "3",
      "category": "2",
      "repititions": "10",
      "exercise_id": "33",
      "unit": "times",
      "round": "1",
      "created_at": "2015-11-18 18:30:00",
      "updated_at": "2015-11-19 10:00:54",
      "video": {
      "id": "33",
      "path": "Now33.mp4",
      "videothumbnail": "thumbnail2.png",
      "description": "Test Description"
      },
      "exercise": {
      "id": "33",
      "name": "One Leg Front Lever",
      "description": ""
      }
      },
      {
      "id": "105",
      "workout_id": "3",
      "category": "2",
      "repititions": "20",
      "exercise_id": "90",
      "unit": "seconds",
      "round": "1",
      "created_at": "2015-11-18 18:30:00",
      "updated_at": "2015-11-19 10:45:38",
      "video": null,
      "exercise": {
      "id": "90",
      "name": "Rest",
      "description": "Rest"
      }
      },
      {
      "id": "121",
      "workout_id": "3",
      "category": "3",
      "repititions": "10",
      "exercise_id": "73",
      "unit": "times",
      "round": "1",
      "created_at": "2015-11-18 18:30:00",
      "updated_at": "2015-11-19 10:00:00",
      "video": {
      "id": "74",
      "path": "Now74.mp4",
      "videothumbnail": "thumbnail1.png",
      "description": "Test Description"
      },
      "exercise": {
      "id": "73",
      "name": "One Arm Pushups",
      "description": ""
      }
      },
      {
      "id": "122",
      "workout_id": "3",
      "category": "3",
      "repititions": "25",
      "exercise_id": "72",
      "unit": "times",
      "round": "1",
      "created_at": "2015-11-18 18:30:00",
      "updated_at": "2015-11-19 10:00:00",
      "video": {
      "id": "73",
      "path": "Now73.mp4",
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
      "id": "123",
      "workout_id": "3",
      "category": "3",
      "repititions": "10",
      "exercise_id": "77",
      "unit": "times",
      "round": "1",
      "created_at": "2015-11-18 18:30:00",
      "updated_at": "2015-11-19 10:00:54",
      "video": {
      "id": "78",
      "path": "Now78.mp4",
      "videothumbnail": "thumbnail2.png",
      "description": "Test Description"
      },
      "exercise": {
      "id": "77",
      "name": "Front Lever",
      "description": ""
      }
      },
      {
      "id": "124",
      "workout_id": "3",
      "category": "3",
      "repititions": "20",
      "exercise_id": "90",
      "unit": "seconds",
      "round": "1",
      "created_at": "2015-11-18 18:30:00",
      "updated_at": "2015-11-19 10:45:38",
      "video": null,
      "exercise": {
      "id": "90",
      "name": "Rest",
      "description": "Rest"
      }
      }
      ],
      "round2": [
      {
      "id": "87",
      "workout_id": "3",
      "category": "1",
      "repititions": "10",
      "exercise_id": "12",
      "unit": "times",
      "round": "2",
      "created_at": "2015-11-18 18:30:00",
      "updated_at": "2015-11-19 10:00:00",
      "video": {
      "id": "12",
      "path": "Now12.mp4",
      "videothumbnail": "thumbnail2.png",
      "description": "Test Description"
      },
      "exercise": {
      "id": "12",
      "name": "Incline Pushups",
      "description": ""
      }
      },
      {
      "id": "88",
      "workout_id": "3",
      "category": "1",
      "repititions": "25",
      "exercise_id": "11",
      "unit": "times",
      "round": "2",
      "created_at": "2015-11-18 18:30:00",
      "updated_at": "2015-11-19 10:00:00",
      "video": {
      "id": "11",
      "path": "Now11.mp4",
      "videothumbnail": "thumbnail1.png",
      "description": "Test Description"
      },
      "exercise": {
      "id": "11",
      "name": "Sprawl",
      "description": ""
      }
      },
      {
      "id": "89",
      "workout_id": "3",
      "category": "1",
      "repititions": "10",
      "exercise_id": "2",
      "unit": "times",
      "round": "2",
      "created_at": "2015-11-18 18:30:00",
      "updated_at": "2015-11-19 10:00:54",
      "video": {
      "id": "2",
      "path": "Now2.mp4",
      "videothumbnail": "thumbnail1.png",
      "description": "Test Description"
      },
      "exercise": {
      "id": "2",
      "name": "Australian Pullups",
      "description": "Australian pull-ups are becoming a very popular exercise. Like all types of pull-ups (and all types of exercises for that matter) there are many different ways to do the Australian, and it can be incorporated into a number of different contexts within a workout."
      }
      },
      {
      "id": "90",
      "workout_id": "3",
      "category": "1",
      "repititions": "20",
      "exercise_id": "90",
      "unit": "seconds",
      "round": "2",
      "created_at": "2015-11-18 18:30:00",
      "updated_at": "2015-11-19 10:45:38",
      "video": null,
      "exercise": {
      "id": "90",
      "name": "Rest",
      "description": "Rest"
      }
      },
      {
      "id": "106",
      "workout_id": "3",
      "category": "2",
      "repititions": "10",
      "exercise_id": "43",
      "unit": "times",
      "round": "2",
      "created_at": "2015-11-18 18:30:00",
      "updated_at": "2015-11-19 10:00:00",
      "video": {
      "id": "43",
      "path": "Now43.mp4",
      "videothumbnail": "thumbnail3.jpg",
      "description": "Test Description"
      },
      "exercise": {
      "id": "43",
      "name": "Pushups",
      "description": ""
      }
      },
      {
      "id": "107",
      "workout_id": "3",
      "category": "2",
      "repititions": "25",
      "exercise_id": "42",
      "unit": "times",
      "round": "2",
      "created_at": "2015-11-18 18:30:00",
      "updated_at": "2015-11-19 10:00:00",
      "video": {
      "id": "42",
      "path": "Now42.mp4",
      "videothumbnail": "thumbnail2.png",
      "description": "Test Description"
      },
      "exercise": {
      "id": "42",
      "name": "Burpee",
      "description": ""
      }
      },
      {
      "id": "108",
      "workout_id": "3",
      "category": "2",
      "repititions": "10",
      "exercise_id": "33",
      "unit": "times",
      "round": "2",
      "created_at": "2015-11-18 18:30:00",
      "updated_at": "2015-11-19 10:00:54",
      "video": {
      "id": "33",
      "path": "Now33.mp4",
      "videothumbnail": "thumbnail2.png",
      "description": "Test Description"
      },
      "exercise": {
      "id": "33",
      "name": "One Leg Front Lever",
      "description": ""
      }
      },
      {
      "id": "109",
      "workout_id": "3",
      "category": "2",
      "repititions": "20",
      "exercise_id": "90",
      "unit": "seconds",
      "round": "2",
      "created_at": "2015-11-18 18:30:00",
      "updated_at": "2015-11-19 10:45:38",
      "video": null,
      "exercise": {
      "id": "90",
      "name": "Rest",
      "description": "Rest"
      }
      },
      {
      "id": "125",
      "workout_id": "3",
      "category": "3",
      "repititions": "10",
      "exercise_id": "73",
      "unit": "times",
      "round": "2",
      "created_at": "2015-11-18 18:30:00",
      "updated_at": "2015-11-19 10:00:00",
      "video": {
      "id": "74",
      "path": "Now74.mp4",
      "videothumbnail": "thumbnail1.png",
      "description": "Test Description"
      },
      "exercise": {
      "id": "73",
      "name": "One Arm Pushups",
      "description": ""
      }
      },
      {
      "id": "126",
      "workout_id": "3",
      "category": "3",
      "repititions": "25",
      "exercise_id": "72",
      "unit": "times",
      "round": "2",
      "created_at": "2015-11-18 18:30:00",
      "updated_at": "2015-11-19 10:00:00",
      "video": {
      "id": "73",
      "path": "Now73.mp4",
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
      "id": "127",
      "workout_id": "3",
      "category": "3",
      "repititions": "10",
      "exercise_id": "77",
      "unit": "times",
      "round": "2",
      "created_at": "2015-11-18 18:30:00",
      "updated_at": "2015-11-19 10:00:54",
      "video": {
      "id": "78",
      "path": "Now78.mp4",
      "videothumbnail": "thumbnail2.png",
      "description": "Test Description"
      },
      "exercise": {
      "id": "77",
      "name": "Front Lever",
      "description": ""
      }
      },
      {
      "id": "128",
      "workout_id": "3",
      "category": "3",
      "repititions": "20",
      "exercise_id": "90",
      "unit": "seconds",
      "round": "2",
      "created_at": "2015-11-18 18:30:00",
      "updated_at": "2015-11-19 10:45:38",
      "video": null,
      "exercise": {
      "id": "90",
      "name": "Rest",
      "description": "Rest"
      }
      }
      ],
      "round3": [
      {
      "id": "91",
      "workout_id": "3",
      "category": "1",
      "repititions": "10",
      "exercise_id": "12",
      "unit": "times",
      "round": "3",
      "created_at": "2015-11-18 18:30:00",
      "updated_at": "2015-11-19 10:00:00",
      "video": {
      "id": "12",
      "path": "Now12.mp4",
      "videothumbnail": "thumbnail2.png",
      "description": "Test Description"
      },
      "exercise": {
      "id": "12",
      "name": "Incline Pushups",
      "description": ""
      }
      },
      {
      "id": "92",
      "workout_id": "3",
      "category": "1",
      "repititions": "25",
      "exercise_id": "11",
      "unit": "times",
      "round": "3",
      "created_at": "2015-11-18 18:30:00",
      "updated_at": "2015-11-19 10:00:00",
      "video": {
      "id": "11",
      "path": "Now11.mp4",
      "videothumbnail": "thumbnail1.png",
      "description": "Test Description"
      },
      "exercise": {
      "id": "11",
      "name": "Sprawl",
      "description": ""
      }
      },
      {
      "id": "93",
      "workout_id": "3",
      "category": "1",
      "repititions": "10",
      "exercise_id": "2",
      "unit": "times",
      "round": "3",
      "created_at": "2015-11-18 18:30:00",
      "updated_at": "2015-11-19 10:00:54",
      "video": {
      "id": "2",
      "path": "Now2.mp4",
      "videothumbnail": "thumbnail1.png",
      "description": "Test Description"
      },
      "exercise": {
      "id": "2",
      "name": "Australian Pullups",
      "description": "Australian pull-ups are becoming a very popular exercise. Like all types of pull-ups (and all types of exercises for that matter) there are many different ways to do the Australian, and it can be incorporated into a number of different contexts within a workout."
      }
      },
      {
      "id": "94",
      "workout_id": "3",
      "category": "1",
      "repititions": "20",
      "exercise_id": "90",
      "unit": "seconds",
      "round": "3",
      "created_at": "2015-11-18 18:30:00",
      "updated_at": "2015-11-19 10:45:38",
      "video": null,
      "exercise": {
      "id": "90",
      "name": "Rest",
      "description": "Rest"
      }
      },
      {
      "id": "110",
      "workout_id": "3",
      "category": "2",
      "repititions": "10",
      "exercise_id": "43",
      "unit": "times",
      "round": "3",
      "created_at": "2015-11-18 18:30:00",
      "updated_at": "2015-11-19 10:00:00",
      "video": {
      "id": "43",
      "path": "Now43.mp4",
      "videothumbnail": "thumbnail3.jpg",
      "description": "Test Description"
      },
      "exercise": {
      "id": "43",
      "name": "Pushups",
      "description": ""
      }
      },
      {
      "id": "111",
      "workout_id": "3",
      "category": "2",
      "repititions": "25",
      "exercise_id": "42",
      "unit": "times",
      "round": "3",
      "created_at": "2015-11-18 18:30:00",
      "updated_at": "2015-11-19 10:00:00",
      "video": {
      "id": "42",
      "path": "Now42.mp4",
      "videothumbnail": "thumbnail2.png",
      "description": "Test Description"
      },
      "exercise": {
      "id": "42",
      "name": "Burpee",
      "description": ""
      }
      },
      {
      "id": "112",
      "workout_id": "3",
      "category": "2",
      "repititions": "10",
      "exercise_id": "33",
      "unit": "times",
      "round": "3",
      "created_at": "2015-11-18 18:30:00",
      "updated_at": "2015-11-19 10:00:54",
      "video": {
      "id": "33",
      "path": "Now33.mp4",
      "videothumbnail": "thumbnail2.png",
      "description": "Test Description"
      },
      "exercise": {
      "id": "33",
      "name": "One Leg Front Lever",
      "description": ""
      }
      },
      {
      "id": "113",
      "workout_id": "3",
      "category": "2",
      "repititions": "20",
      "exercise_id": "90",
      "unit": "seconds",
      "round": "3",
      "created_at": "2015-11-18 18:30:00",
      "updated_at": "2015-11-19 10:45:38",
      "video": null,
      "exercise": {
      "id": "90",
      "name": "Rest",
      "description": "Rest"
      }
      },
      {
      "id": "129",
      "workout_id": "3",
      "category": "3",
      "repititions": "10",
      "exercise_id": "73",
      "unit": "times",
      "round": "3",
      "created_at": "2015-11-18 18:30:00",
      "updated_at": "2015-11-19 10:00:00",
      "video": {
      "id": "74",
      "path": "Now74.mp4",
      "videothumbnail": "thumbnail1.png",
      "description": "Test Description"
      },
      "exercise": {
      "id": "73",
      "name": "One Arm Pushups",
      "description": ""
      }
      },
      {
      "id": "130",
      "workout_id": "3",
      "category": "3",
      "repititions": "25",
      "exercise_id": "72",
      "unit": "times",
      "round": "3",
      "created_at": "2015-11-18 18:30:00",
      "updated_at": "2015-11-19 10:00:00",
      "video": {
      "id": "73",
      "path": "Now73.mp4",
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
      "id": "131",
      "workout_id": "3",
      "category": "3",
      "repititions": "10",
      "exercise_id": "77",
      "unit": "times",
      "round": "3",
      "created_at": "2015-11-18 18:30:00",
      "updated_at": "2015-11-19 10:00:54",
      "video": {
      "id": "78",
      "path": "Now78.mp4",
      "videothumbnail": "thumbnail2.png",
      "description": "Test Description"
      },
      "exercise": {
      "id": "77",
      "name": "Front Lever",
      "description": ""
      }
      },
      {
      "id": "132",
      "workout_id": "3",
      "category": "3",
      "repititions": "20",
      "exercise_id": "90",
      "unit": "seconds",
      "round": "3",
      "created_at": "2015-11-18 18:30:00",
      "updated_at": "2015-11-19 10:45:38",
      "video": null,
      "exercise": {
      "id": "90",
      "name": "Rest",
      "description": "Rest"
      }
      }
      ],
      "round4": [
      {
      "id": "95",
      "workout_id": "3",
      "category": "1",
      "repititions": "10",
      "exercise_id": "12",
      "unit": "times",
      "round": "4",
      "created_at": "2015-11-18 18:30:00",
      "updated_at": "2015-11-19 10:00:00",
      "video": {
      "id": "12",
      "path": "Now12.mp4",
      "videothumbnail": "thumbnail2.png",
      "description": "Test Description"
      },
      "exercise": {
      "id": "12",
      "name": "Incline Pushups",
      "description": ""
      }
      },
      {
      "id": "96",
      "workout_id": "3",
      "category": "1",
      "repititions": "25",
      "exercise_id": "11",
      "unit": "times",
      "round": "4",
      "created_at": "2015-11-18 18:30:00",
      "updated_at": "2015-11-19 10:00:00",
      "video": {
      "id": "11",
      "path": "Now11.mp4",
      "videothumbnail": "thumbnail1.png",
      "description": "Test Description"
      },
      "exercise": {
      "id": "11",
      "name": "Sprawl",
      "description": ""
      }
      },
      {
      "id": "97",
      "workout_id": "3",
      "category": "1",
      "repititions": "10",
      "exercise_id": "2",
      "unit": "times",
      "round": "4",
      "created_at": "2015-11-18 18:30:00",
      "updated_at": "2015-11-19 10:00:54",
      "video": {
      "id": "2",
      "path": "Now2.mp4",
      "videothumbnail": "thumbnail1.png",
      "description": "Test Description"
      },
      "exercise": {
      "id": "2",
      "name": "Australian Pullups",
      "description": "Australian pull-ups are becoming a very popular exercise. Like all types of pull-ups (and all types of exercises for that matter) there are many different ways to do the Australian, and it can be incorporated into a number of different contexts within a workout."
      }
      },
      {
      "id": "98",
      "workout_id": "3",
      "category": "1",
      "repititions": "20",
      "exercise_id": "90",
      "unit": "seconds",
      "round": "4",
      "created_at": "2015-11-18 18:30:00",
      "updated_at": "2015-11-19 10:45:38",
      "video": null,
      "exercise": {
      "id": "90",
      "name": "Rest",
      "description": "Rest"
      }
      },
      {
      "id": "114",
      "workout_id": "3",
      "category": "2",
      "repititions": "10",
      "exercise_id": "43",
      "unit": "times",
      "round": "4",
      "created_at": "2015-11-18 18:30:00",
      "updated_at": "2015-11-19 10:00:00",
      "video": {
      "id": "43",
      "path": "Now43.mp4",
      "videothumbnail": "thumbnail3.jpg",
      "description": "Test Description"
      },
      "exercise": {
      "id": "43",
      "name": "Pushups",
      "description": ""
      }
      },
      {
      "id": "115",
      "workout_id": "3",
      "category": "2",
      "repititions": "25",
      "exercise_id": "42",
      "unit": "times",
      "round": "4",
      "created_at": "2015-11-18 18:30:00",
      "updated_at": "2015-11-19 10:00:00",
      "video": {
      "id": "42",
      "path": "Now42.mp4",
      "videothumbnail": "thumbnail2.png",
      "description": "Test Description"
      },
      "exercise": {
      "id": "42",
      "name": "Burpee",
      "description": ""
      }
      },
      {
      "id": "116",
      "workout_id": "3",
      "category": "2",
      "repititions": "10",
      "exercise_id": "33",
      "unit": "times",
      "round": "4",
      "created_at": "2015-11-18 18:30:00",
      "updated_at": "2015-11-19 10:00:54",
      "video": {
      "id": "33",
      "path": "Now33.mp4",
      "videothumbnail": "thumbnail2.png",
      "description": "Test Description"
      },
      "exercise": {
      "id": "33",
      "name": "One Leg Front Lever",
      "description": ""
      }
      },
      {
      "id": "117",
      "workout_id": "3",
      "category": "2",
      "repititions": "20",
      "exercise_id": "90",
      "unit": "seconds",
      "round": "4",
      "created_at": "2015-11-18 18:30:00",
      "updated_at": "2015-11-19 10:45:38",
      "video": null,
      "exercise": {
      "id": "90",
      "name": "Rest",
      "description": "Rest"
      }
      },
      {
      "id": "133",
      "workout_id": "3",
      "category": "3",
      "repititions": "10",
      "exercise_id": "73",
      "unit": "times",
      "round": "4",
      "created_at": "2015-11-18 18:30:00",
      "updated_at": "2015-11-19 10:00:00",
      "video": {
      "id": "74",
      "path": "Now74.mp4",
      "videothumbnail": "thumbnail1.png",
      "description": "Test Description"
      },
      "exercise": {
      "id": "73",
      "name": "One Arm Pushups",
      "description": ""
      }
      },
      {
      "id": "134",
      "workout_id": "3",
      "category": "3",
      "repititions": "25",
      "exercise_id": "72",
      "unit": "times",
      "round": "4",
      "created_at": "2015-11-18 18:30:00",
      "updated_at": "2015-11-19 10:00:00",
      "video": {
      "id": "73",
      "path": "Now73.mp4",
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
      "id": "135",
      "workout_id": "3",
      "category": "3",
      "repititions": "10",
      "exercise_id": "77",
      "unit": "times",
      "round": "4",
      "created_at": "2015-11-18 18:30:00",
      "updated_at": "2015-11-19 10:00:54",
      "video": {
      "id": "78",
      "path": "Now78.mp4",
      "videothumbnail": "thumbnail2.png",
      "description": "Test Description"
      },
      "exercise": {
      "id": "77",
      "name": "Front Lever",
      "description": ""
      }
      },
      {
      "id": "136",
      "workout_id": "3",
      "category": "3",
      "repititions": "20",
      "exercise_id": "90",
      "unit": "seconds",
      "round": "4",
      "created_at": "2015-11-18 18:30:00",
      "updated_at": "2015-11-19 10:45:38",
      "video": null,
      "exercise": {
      "id": "90",
      "name": "Rest",
      "description": "Rest"
      }
      }
      ],
      "round5": [
      {
      "id": "99",
      "workout_id": "3",
      "category": "1",
      "repititions": "10",
      "exercise_id": "12",
      "unit": "times",
      "round": "5",
      "created_at": "2015-11-18 18:30:00",
      "updated_at": "2015-11-19 10:00:00",
      "video": {
      "id": "12",
      "path": "Now12.mp4",
      "videothumbnail": "thumbnail2.png",
      "description": "Test Description"
      },
      "exercise": {
      "id": "12",
      "name": "Incline Pushups",
      "description": ""
      }
      },
      {
      "id": "100",
      "workout_id": "3",
      "category": "1",
      "repititions": "25",
      "exercise_id": "11",
      "unit": "times",
      "round": "5",
      "created_at": "2015-11-18 18:30:00",
      "updated_at": "2015-11-19 10:00:00",
      "video": {
      "id": "11",
      "path": "Now11.mp4",
      "videothumbnail": "thumbnail1.png",
      "description": "Test Description"
      },
      "exercise": {
      "id": "11",
      "name": "Sprawl",
      "description": ""
      }
      },
      {
      "id": "101",
      "workout_id": "3",
      "category": "1",
      "repititions": "10",
      "exercise_id": "2",
      "unit": "times",
      "round": "5",
      "created_at": "2015-11-18 18:30:00",
      "updated_at": "2015-11-19 10:00:54",
      "video": {
      "id": "2",
      "path": "Now2.mp4",
      "videothumbnail": "thumbnail1.png",
      "description": "Test Description"
      },
      "exercise": {
      "id": "2",
      "name": "Australian Pullups",
      "description": "Australian pull-ups are becoming a very popular exercise. Like all types of pull-ups (and all types of exercises for that matter) there are many different ways to do the Australian, and it can be incorporated into a number of different contexts within a workout."
      }
      },
      {
      "id": "118",
      "workout_id": "3",
      "category": "2",
      "repititions": "10",
      "exercise_id": "43",
      "unit": "times",
      "round": "5",
      "created_at": "2015-11-18 18:30:00",
      "updated_at": "2015-11-19 10:00:00",
      "video": {
      "id": "43",
      "path": "Now43.mp4",
      "videothumbnail": "thumbnail3.jpg",
      "description": "Test Description"
      },
      "exercise": {
      "id": "43",
      "name": "Pushups",
      "description": ""
      }
      },
      {
      "id": "119",
      "workout_id": "3",
      "category": "2",
      "repititions": "25",
      "exercise_id": "42",
      "unit": "times",
      "round": "5",
      "created_at": "2015-11-18 18:30:00",
      "updated_at": "2015-11-19 10:00:00",
      "video": {
      "id": "42",
      "path": "Now42.mp4",
      "videothumbnail": "thumbnail2.png",
      "description": "Test Description"
      },
      "exercise": {
      "id": "42",
      "name": "Burpee",
      "description": ""
      }
      },
      {
      "id": "120",
      "workout_id": "3",
      "category": "2",
      "repititions": "10",
      "exercise_id": "33",
      "unit": "times",
      "round": "5",
      "created_at": "2015-11-18 18:30:00",
      "updated_at": "2015-11-19 10:00:54",
      "video": {
      "id": "33",
      "path": "Now33.mp4",
      "videothumbnail": "thumbnail2.png",
      "description": "Test Description"
      },
      "exercise": {
      "id": "33",
      "name": "One Leg Front Lever",
      "description": ""
      }
      },
      {
      "id": "137",
      "workout_id": "3",
      "category": "3",
      "repititions": "10",
      "exercise_id": "73",
      "unit": "times",
      "round": "5",
      "created_at": "2015-11-18 18:30:00",
      "updated_at": "2015-11-19 10:00:00",
      "video": {
      "id": "74",
      "path": "Now74.mp4",
      "videothumbnail": "thumbnail1.png",
      "description": "Test Description"
      },
      "exercise": {
      "id": "73",
      "name": "One Arm Pushups",
      "description": ""
      }
      },
      {
      "id": "138",
      "workout_id": "3",
      "category": "3",
      "repititions": "25",
      "exercise_id": "72",
      "unit": "times",
      "round": "5",
      "created_at": "2015-11-18 18:30:00",
      "updated_at": "2015-11-19 10:00:00",
      "video": {
      "id": "73",
      "path": "Now73.mp4",
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
      "id": "139",
      "workout_id": "3",
      "category": "3",
      "repititions": "10",
      "exercise_id": "77",
      "unit": "times",
      "round": "5",
      "created_at": "2015-11-18 18:30:00",
      "updated_at": "2015-11-19 10:00:54",
      "video": {
      "id": "78",
      "path": "Now78.mp4",
      "videothumbnail": "thumbnail2.png",
      "description": "Test Description"
      },
      "exercise": {
      "id": "77",
      "name": "Front Lever",
      "description": ""
      }
      }
      ]
      }
      },
      "workout_intensity": 1,
      "hiit": [
      1
      ],
      "stretching": [
      {
      "exercise_id": "Superman",
      "duration": {
      "min": 5,
      "max": 10
      },
      "unit": "times"
      },
      {
      "exercise_id": "Lower Back Strength",
      "duration": {
      "min": 30,
      "max": 50
      },
      "unit": "times"
      },
      {
      "exercise_id": "Upper Dog",
      "duration": {
      "min": 30,
      "max": 60
      },
      "unit": "seconds"
      },
      {
      "exercise_id": "Child's Pose",
      "duration": {
      "min": 30,
      "max": 60
      },
      "unit": "seconds"
      },
      {
      "exercise_id": "L-sit on the floor",
      "duration": {
      "min": 30,
      "max": 60
      },
      "unit": "seconds"
      },
      {
      "exercise_id": "Frog stretch",
      "duration": {
      "min": 30,
      "max": 60
      },
      "unit": "seconds"
      },
      {
      "exercise_id": "Good morning",
      "duration": {
      "min": 30,
      "max": 60
      },
      "unit": "seconds"
      },
      {
      "exercise_id": "Chest Opener",
      "duration": {
      "min": 30,
      "max": 60
      },
      "unit": "seconds"
      },
      {
      "exercise_id": "Triceps Stretch",
      "duration": {
      "min": 30,
      "max": 60
      },
      "unit": "seconds"
      },
      {
      "exercise_id": "Hands Back",
      "duration": {
      "min": 30,
      "max": 60
      },
      "unit": "seconds"
      },
      {
      "exercise_id": "Shoulder Stretch",
      "duration": {
      "min": 30,
      "max": 60
      },
      "unit": "seconds"
      }
      ]
      }
      },
      "created_at": "2016-01-05 09:40:54",
      "updated_at": "2016-01-05 09:40:54"
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
    public function getCoach(Request $request)
    {
        if (!isset($request->user_id) || ($request->user_id == null)) {
            return response()->json(["status" => "0", "error" => "The user_id field is required"]);
        } else {
            $user = User::where('id', '=', $request->input('user_id'))->first();
            if (!is_null($user)) {
                //Check whether the user completed the week workouts
                $coach = Coach::where('user_id', $request->user_id)->first();
                $coachStatus = DB::table('coach_status')->where('user_id', $request->user_id)->where('coach_id', $coach->id)->first();
                $currentTimestamp = time();

                $remainDays = 7 - $coach->days;

                if ((strtotime($coachStatus->updated_at . " + " . $remainDays . " days")) <= $currentTimestamp) {
                    return response()->json([
                            'status' => 1,
                            'coach_day' => $coachStatus->day,
                            'coach_week' => $coachStatus->week,
                            'is_subscribed' => $user->is_subscribed,
                            'need_update' => 1,
                            'coach' => [],
                            'urls' => config('urls.urls')], 200);
                } else {
                    $coach->exercises = json_decode($coach->exercises, true);
                    return response()->json([
                            'status' => 1,
                            'coach_day' => $coachStatus->day,
                            'coach_week' => $coachStatus->week,
                            'is_subscribed' => $user->is_subscribed,
                            'need_update' => 0,
                            'coach' => $coach,
                            'urls' => config('urls.urls')], 200);
                }
            } else {
                return response()->json(['status' => 0, 'error' => 'user_not_exists'], 500);
            }
        }
    }

    /**
     * @api {post} /coach/getFundumentals getFundumentals
     * @apiName getFundumentals
     * @apiGroup Coach
     * @apiParam {Number} user_id Id of user *mandatory
     * @apiSuccess {String} success.
     * @apiSuccessExample Success-Response:
     * HTTP/1.1 200 OK
     * {
      "status": 1,
      "tests": {
      "1": [
      {
      "exercise_id": 43,
      "duration": 10,
      "exercise": {
      "id": "43",
      "name": "Pushups",
      "description": "",
      "category": "2",
      "type": "1",
      "rewards": "6.00",
      "repititions": "10",
      "duration": "1.00",
      "unit": "times",
      "equipment": "",
      "video": [
      {
      "id": "43",
      "path": "Now43.mp4",
      "videothumbnail": "thumbnail3.jpg",
      "description": "Test Description"
      }
      ]
      }
      },
      {
      "exercise_id": 2,
      "duration": 10,
      "exercise": {
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
      "video": [
      {
      "id": "2",
      "path": "Now2.mp4",
      "videothumbnail": "thumbnail1.png",
      "description": "Test Description"
      }
      ]
      }
      },
      {
      "exercise_id": 40,
      "duration": 15,
      "exercise": {
      "id": "40",
      "name": "Lunge",
      "description": "",
      "category": "2",
      "type": "2",
      "rewards": "6.00",
      "repititions": "10",
      "duration": "1.00",
      "unit": "times",
      "equipment": "",
      "video": [
      {
      "id": "40",
      "path": "Now40.mp4",
      "videothumbnail": "thumbnail3.jpg",
      "description": "Test Description"
      }
      ]
      }
      },
      {
      "exercise_id": 17,
      "duration": 15,
      "exercise": {
      "id": "17",
      "name": "Plank",
      "description": "",
      "category": "1",
      "type": "1",
      "rewards": "6.00",
      "repititions": "10",
      "duration": "1.00",
      "unit": "times",
      "equipment": "",
      "video": [
      {
      "id": "17",
      "path": "Now17.mp4",
      "videothumbnail": "thumbnail1.png",
      "description": "Test Description"
      }
      ]
      }
      }
      ],
      "2": [
      {
      "exercise_id": 43,
      "duration": 30,
      "exercise": {
      "id": "43",
      "name": "Pushups",
      "description": "",
      "category": "2",
      "type": "1",
      "rewards": "6.00",
      "repititions": "10",
      "duration": "1.00",
      "unit": "times",
      "equipment": "",
      "video": [
      {
      "id": "43",
      "path": "Now43.mp4",
      "videothumbnail": "thumbnail3.jpg",
      "description": "Test Description"
      }
      ]
      }
      },
      {
      "exercise_id": 32,
      "duration": 10,
      "exercise": {
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
      "video": [
      {
      "id": "32",
      "path": "Now32.mp4",
      "videothumbnail": "thumbnail1.png",
      "description": "Test Description"
      }
      ]
      }
      },
      {
      "exercise_id": 38,
      "duration": 25,
      "exercise": {
      "id": "38",
      "name": "Squats",
      "description": "",
      "category": "2",
      "type": "1",
      "rewards": "6.00",
      "repititions": "10",
      "duration": "1.00",
      "unit": "times",
      "equipment": "",
      "video": [
      {
      "id": "38",
      "path": "Now38.mp4",
      "videothumbnail": "thumbnail1.png",
      "description": "Test Description"
      }
      ]
      }
      }
      ]
      },
      "is_subscribed": 0,
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
    public function getFundumentals(Request $request)
    {
        $fundumentalArray = [
            1 => [
                ['exercise_id' => 43, 'duration' => 10],
                ['exercise_id' => 2, 'duration' => 10],
                ['exercise_id' => 40, 'duration' => 15],
                ['exercise_id' => 17, 'duration' => 15]],
            2 => [
                ['exercise_id' => 43, 'duration' => 30],
                ['exercise_id' => 32, 'duration' => 10],
                ['exercise_id' => 38, 'duration' => 25]],
        ];
        if (!isset($request->user_id) || ($request->user_id == null)) {
            return response()->json(["status" => "0", "error" => "The user_id field is required"]);
        } else {
            $user = User::where('id', '=', $request->input('user_id'))->first();
            if (!is_null($user)) {
                foreach ($fundumentalArray as $iKey => $fundumental) {
                    foreach ($fundumental as $jKey => $iVal) {
                        $fundumentalArray[$iKey][$jKey]['exercise'] = Exercise::where('id', $iVal['exercise_id'])->with(['video'])->first();
                    }
                }
                return response()->json([
                        'status' => 1,
                        'tests' => $fundumentalArray,
                        'is_subscribed' => $user->is_subscribed,
                        'urls' => config('urls.urls')], 200);
            } else {
                return response()->json(['status' => 0, 'error' => 'user_not_exists'], 500);
            }
        }
    }

    /**
     * @api {post} /coach/finishday finishCoachDayWorkouts
     * @apiName finishCoachDayWorkouts
     * @apiGroup Coach
     * @apiParam {Number} user_id Id of user *mandatory
     * @apiParam {Number} day Id of user *mandatory
     * @apiSuccess {String} success.
     * @apiSuccessExample Success-Response:
     * HTTP/1.1 200 OK
     * {
      "status": 1,
      "message": "successfully finished day workouts"
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
    public function finishCoachDayWorkouts(Request $request)
    {
        if (!isset($request->user_id) || ($request->user_id == null)) {
            return response()->json(["status" => "0", "error" => "The user_id field is required"]);
        } elseif (!isset($request->day) || ($request->day == null)) {
            return response()->json(["status" => "0", "error" => "The day field is required"]);
        } else {
            $user = User::where('id', '=', $request->input('user_id'))->first();
            if (!is_null($user)) {
                $coach = Coach::where('user_id', $request->user_id)->first();
                $coachStatus = DB::table('coach_status')->where('user_id', $request->user_id)->where('coach_id', $coach->id)->first();
                if ($coach->days == $request->day) {
                    $data['week'] = $coachStatus->week + 1;
                    $data['status'] = 0;
                    $data['day'] = 1;
                } else {
                    $data['status'] = 0;
                    $data['day'] = $request->day + 1;
                }

                $data['user_id'] = $request->user_id;
                $data['coach_id'] = $coach->id;
                $data['created_at'] = Carbon::now();

                DB::table('coach_status')->insert($data);



                return response()->json(['status' => 1, 'message' => 'successfully finished day workouts'], 500);
            } else {
                return response()->json(['status' => 0, 'error' => 'user_not_exists'], 500);
            }
        }
    }

    /**
     * @api {post} /coach/getdescription getDescription
     * @apiName getDescription
     * @apiGroup Coach
     * @apiParam {Number} user_id Id of user *mandatory
     * @apiSuccess {String} success.
     * @apiSuccessExample Success-Response:
     * HTTP/1.1 200 OK
     * {
      "status": 1,
      "descriptions": {
      "1": "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas in faucibus orci. Nunc et lorem libero. Nulla facilisi. Nunc dictum, sapien ut tincidunt ultrices, dui nunc auctor velit, ac porta lacus turpis non massa. Quisque nec vestibulum risus, quis consequat lectus. Curabitur dignissim risus ac velit tincidunt dignissim. Mauris nec risus eget felis mollis tincidunt. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. In suscipit blandit bibendum. Nulla venenatis sed libero at ornare. Interdum et malesuada fames ac ante ipsum primis in faucibus. ",
      "2": "Vestibulum rutrum efficitur vulputate. Mauris quam turpis, pellentesque sed mauris eget, imperdiet scelerisque libero. Sed vitae leo id massa consectetur vestibulum ut ac tellus. Nam luctus nisl at leo sagittis condimentum. Duis malesuada, nisl sit amet tincidunt sollicitudin, turpis leo aliquam eros, eu aliquam felis massa id urna. Suspendisse potenti. Curabitur sodales accumsan varius. Aenean nulla sem, consectetur sed ex sed, vestibulum iaculis felis. Suspendisse neque eros, sagittis quis pulvinar a, porta id est. Curabitur diam massa, semper et pretium vitae, commodo ut ligula. Sed venenatis imperdiet suscipit. Nam egestas ante vitae augue sodales consectetur. Ut vel molestie dolor. Nam lorem nibh, maximus vitae urna eget, interdum aliquam libero. Suspendisse ut metus justo. Mauris hendrerit pulvinar orci, at efficitur odio porta ut. ",
      "3": "Nullam sit amet eros nec nibh feugiat scelerisque vitae in ante. Mauris eu hendrerit eros. In et risus vel purus pharetra mollis quis sed tellus. Sed ut libero posuere risus aliquam consectetur non ac dui. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed maximus lobortis nulla ut elementum. Aliquam vel accumsan leo. In sagittis enim scelerisque dolor dictum tristique. Donec mattis ut turpis id finibus. Nullam ac imperdiet nisi. In accumsan massa id magna imperdiet eleifend. Donec tempor blandit lacinia. Nulla vitae ligula sit amet est luctus vehicula. "
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
    public function getDescription(Request $request)
    {
        if (!isset($request->user_id) || ($request->user_id == null)) {
            return response()->json(["status" => "0", "error" => "The user_id field is required"]);
        } else {
            $user = User::where('id', '=', $request->input('user_id'))->first();
            if (!is_null($user)) {
                $description = DB::table('site_settings')->select('value')->where('key', 'coach_description')->first();
                return response()->json([
                        'status' => 1,
                        'descriptions' => json_decode($description->value, true)], 200);
            } else {
                return response()->json(['status' => 0, 'error' => 'user_not_exists'], 500);
            }
        }
    }

    /**
     * @api {post} /coach/preparecoach prepareCoach
     * @apiName prepareCoach
     * @apiGroup Coach
     * @apiParam {Number} user_id Id of user *mandatory
     * @apiParam {Number} test1 status of test1 0-failed 1-passed *mandatory
     * @apiParam {Number} test2 status of test2 0-failed 1-passed *mandatory
     * @apiParam {Number} focus user focus 1-Lean, 2-Athletic, 3-Strength *mandatory
     * @apiParam {Number} days number of workout days per week *mandatory
     * @apiParam {Number} progression progression which user focus on 1-Pull, 2-Dip, 3-Full Body, 4-Push, 5-Core  *mandatory
     * @apiParam {Number} height user height in centimeters *optional
     * @apiParam {Number} weight user weight in lbs *optional
     * @apiSuccess {String} success.
     * @apiSuccessExample Success-Response:
     * HTTP/1.1 200 OK
     * {
      "status": 1,
      "coach": {
      "day1": {
      "warmup": {
      "exercise_id": "warmup",
      "duration": 300
      },
      "fundumentals": [
      {
      "exercise_id": 43,
      "duration": 30,
      "exercise": {
      "id": "43",
      "name": "Pushups",
      "description": "",
      "category": "2",
      "type": "1",
      "rewards": "6.00",
      "repititions": "10",
      "duration": "1.00",
      "unit": "times",
      "equipment": "",
      "video": [
      {
      "id": "43",
      "path": "Now43.mp4",
      "videothumbnail": "thumbnail3.jpg",
      "description": "Test Description"
      }
      ]
      }
      },
      {
      "exercise_id": 32,
      "duration": 10,
      "exercise": {
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
      "video": [
      {
      "id": "32",
      "path": "Now32.mp4",
      "videothumbnail": "thumbnail1.png",
      "description": "Test Description"
      }
      ]
      }
      },
      {
      "exercise_id": 38,
      "duration": 25,
      "exercise": {
      "id": "38",
      "name": "Squats",
      "description": "",
      "category": "2",
      "type": "1",
      "rewards": "6.00",
      "repititions": "10",
      "duration": "1.00",
      "unit": "times",
      "equipment": "",
      "video": [
      {
      "id": "38",
      "path": "Now38.mp4",
      "videothumbnail": "thumbnail1.png",
      "description": "Test Description"
      }
      ]
      }
      },
      {
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
      "video": [
      {
      "id": "1",
      "path": "Now1.mp4",
      "videothumbnail": "thumbnail3.jpg",
      "description": "Test Description"
      }
      ]
      }
      }
      ],
      "exercises": [],
      "workout": {
      "id": "2",
      "name": "Borr",
      "description": "Borr Borr Borr",
      "rounds": "3",
      "category": "2",
      "type": "1",
      "rewards": "{\"lean\":330,\"athletic\":440,\"strength\":550}",
      "duration": "19.00",
      "equipments": "Bar",
      "exercises": {
      "round1": [
      {
      "id": "46",
      "workout_id": "2",
      "category": "1",
      "repititions": "25",
      "exercise_id": "11",
      "unit": "times",
      "round": "1",
      "created_at": "2015-11-18 18:30:00",
      "updated_at": "2015-12-07 10:17:23",
      "video": {
      "id": "11",
      "path": "Now11.mp4",
      "videothumbnail": "thumbnail1.png",
      "description": "Test Description"
      },
      "exercise": {
      "id": "11",
      "name": "Sprawl",
      "description": ""
      }
      },
      {
      "id": "47",
      "workout_id": "2",
      "category": "1",
      "repititions": "10",
      "exercise_id": "1",
      "unit": "times",
      "round": "1",
      "created_at": "2015-11-18 18:30:00",
      "updated_at": "2015-12-07 10:17:23",
      "video": {
      "id": "1",
      "path": "Now1.mp4",
      "videothumbnail": "thumbnail3.jpg",
      "description": "Test Description"
      },
      "exercise": {
      "id": "1",
      "name": "Jumping Pullups",
      "description": "The jumping pull-up is a challenging full body exercise that targets the back, legs and arms."
      }
      },
      {
      "id": "48",
      "workout_id": "2",
      "category": "1",
      "repititions": "30",
      "exercise_id": "16",
      "unit": "times",
      "round": "1",
      "created_at": "2015-11-18 18:30:00",
      "updated_at": "2015-12-07 10:17:23",
      "video": {
      "id": "16",
      "path": "Now16.mp4",
      "videothumbnail": "thumbnail3.jpg",
      "description": "Test Description"
      },
      "exercise": {
      "id": "16",
      "name": "Crunches",
      "description": ""
      }
      },
      {
      "id": "49",
      "workout_id": "2",
      "category": "1",
      "repititions": "40",
      "exercise_id": "5",
      "unit": "times",
      "round": "1",
      "created_at": "2015-11-18 18:30:00",
      "updated_at": "2015-12-07 10:17:23",
      "video": {
      "id": "5",
      "path": "Now5.mp4",
      "videothumbnail": "thumbnail1.png",
      "description": "Test Description"
      },
      "exercise": {
      "id": "5",
      "name": "Side Trizeps",
      "description": ""
      }
      },
      {
      "id": "58",
      "workout_id": "2",
      "category": "2",
      "repititions": "25",
      "exercise_id": "42",
      "unit": "times",
      "round": "1",
      "created_at": "2015-11-18 18:30:00",
      "updated_at": "2015-12-07 10:17:23",
      "video": {
      "id": "42",
      "path": "Now42.mp4",
      "videothumbnail": "thumbnail2.png",
      "description": "Test Description"
      },
      "exercise": {
      "id": "42",
      "name": "Burpee",
      "description": ""
      }
      },
      {
      "id": "59",
      "workout_id": "2",
      "category": "2",
      "repititions": "10",
      "exercise_id": "32",
      "unit": "times",
      "round": "1",
      "created_at": "2015-11-18 18:30:00",
      "updated_at": "2015-12-07 10:17:23",
      "video": {
      "id": "32",
      "path": "Now32.mp4",
      "videothumbnail": "thumbnail1.png",
      "description": "Test Description"
      },
      "exercise": {
      "id": "32",
      "name": "Pull ups / Chin ups",
      "description": ""
      }
      },
      {
      "id": "60",
      "workout_id": "2",
      "category": "2",
      "repititions": "30",
      "exercise_id": "47",
      "unit": "times",
      "round": "1",
      "created_at": "2015-11-18 18:30:00",
      "updated_at": "2015-12-07 10:17:23",
      "video": {
      "id": "47",
      "path": "Now47.mp4",
      "videothumbnail": "thumbnail2.png",
      "description": "Test Description"
      },
      "exercise": {
      "id": "47",
      "name": "Situps",
      "description": ""
      }
      },
      {
      "id": "61",
      "workout_id": "2",
      "category": "2",
      "repititions": "40",
      "exercise_id": "36",
      "unit": "times",
      "round": "1",
      "created_at": "2015-11-18 18:30:00",
      "updated_at": "2015-12-07 10:17:23",
      "video": {
      "id": "36",
      "path": "Now36.mp4",
      "videothumbnail": "thumbnail2.png",
      "description": "Test Description"
      },
      "exercise": {
      "id": "36",
      "name": "Dips (Bench)",
      "description": ""
      }
      },
      {
      "id": "70",
      "workout_id": "2",
      "category": "3",
      "repititions": "25",
      "exercise_id": "72",
      "unit": "times",
      "round": "1",
      "created_at": "2015-11-18 18:30:00",
      "updated_at": "2015-12-07 10:17:23",
      "video": {
      "id": "73",
      "path": "Now73.mp4",
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
      "workout_id": "2",
      "category": "3",
      "repititions": "10",
      "exercise_id": "69",
      "unit": "times",
      "round": "1",
      "created_at": "2015-11-18 18:30:00",
      "updated_at": "2015-12-07 10:17:23",
      "video": {
      "id": "69",
      "path": "Now69.mp4",
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
      "workout_id": "2",
      "category": "3",
      "repititions": "30",
      "exercise_id": "75",
      "unit": "times",
      "round": "1",
      "created_at": "2015-11-18 18:30:00",
      "updated_at": "2015-12-07 10:17:23",
      "video": {
      "id": "76",
      "path": "Now76.mp4",
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
      "workout_id": "2",
      "category": "3",
      "repititions": "40",
      "exercise_id": "70",
      "unit": "times",
      "round": "1",
      "created_at": "2015-11-18 18:30:00",
      "updated_at": "2015-12-07 10:17:23",
      "video": {
      "id": "70",
      "path": "Now70.mp4",
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
      "id": "50",
      "workout_id": "2",
      "category": "1",
      "repititions": "25",
      "exercise_id": "11",
      "unit": "times",
      "round": "2",
      "created_at": "2015-11-18 18:30:00",
      "updated_at": "2015-12-07 10:17:23",
      "video": {
      "id": "11",
      "path": "Now11.mp4",
      "videothumbnail": "thumbnail1.png",
      "description": "Test Description"
      },
      "exercise": {
      "id": "11",
      "name": "Sprawl",
      "description": ""
      }
      },
      {
      "id": "51",
      "workout_id": "2",
      "category": "1",
      "repititions": "10",
      "exercise_id": "1",
      "unit": "times",
      "round": "2",
      "created_at": "2015-11-18 18:30:00",
      "updated_at": "2015-12-07 10:17:23",
      "video": {
      "id": "1",
      "path": "Now1.mp4",
      "videothumbnail": "thumbnail3.jpg",
      "description": "Test Description"
      },
      "exercise": {
      "id": "1",
      "name": "Jumping Pullups",
      "description": "The jumping pull-up is a challenging full body exercise that targets the back, legs and arms."
      }
      },
      {
      "id": "52",
      "workout_id": "2",
      "category": "1",
      "repititions": "30",
      "exercise_id": "16",
      "unit": "times",
      "round": "2",
      "created_at": "2015-11-18 18:30:00",
      "updated_at": "2015-12-07 10:17:23",
      "video": {
      "id": "16",
      "path": "Now16.mp4",
      "videothumbnail": "thumbnail3.jpg",
      "description": "Test Description"
      },
      "exercise": {
      "id": "16",
      "name": "Crunches",
      "description": ""
      }
      },
      {
      "id": "53",
      "workout_id": "2",
      "category": "1",
      "repititions": "40",
      "exercise_id": "5",
      "unit": "times",
      "round": "2",
      "created_at": "2015-11-18 18:30:00",
      "updated_at": "2015-12-07 10:17:23",
      "video": {
      "id": "5",
      "path": "Now5.mp4",
      "videothumbnail": "thumbnail1.png",
      "description": "Test Description"
      },
      "exercise": {
      "id": "5",
      "name": "Side Trizeps",
      "description": ""
      }
      },
      {
      "id": "62",
      "workout_id": "2",
      "category": "2",
      "repititions": "25",
      "exercise_id": "42",
      "unit": "times",
      "round": "2",
      "created_at": "2015-11-18 18:30:00",
      "updated_at": "2015-12-07 10:17:23",
      "video": {
      "id": "42",
      "path": "Now42.mp4",
      "videothumbnail": "thumbnail2.png",
      "description": "Test Description"
      },
      "exercise": {
      "id": "42",
      "name": "Burpee",
      "description": ""
      }
      },
      {
      "id": "63",
      "workout_id": "2",
      "category": "2",
      "repititions": "10",
      "exercise_id": "32",
      "unit": "times",
      "round": "2",
      "created_at": "2015-11-18 18:30:00",
      "updated_at": "2015-12-07 10:17:23",
      "video": {
      "id": "32",
      "path": "Now32.mp4",
      "videothumbnail": "thumbnail1.png",
      "description": "Test Description"
      },
      "exercise": {
      "id": "32",
      "name": "Pull ups / Chin ups",
      "description": ""
      }
      },
      {
      "id": "64",
      "workout_id": "2",
      "category": "2",
      "repititions": "30",
      "exercise_id": "47",
      "unit": "times",
      "round": "2",
      "created_at": "2015-11-18 18:30:00",
      "updated_at": "2015-12-07 10:17:23",
      "video": {
      "id": "47",
      "path": "Now47.mp4",
      "videothumbnail": "thumbnail2.png",
      "description": "Test Description"
      },
      "exercise": {
      "id": "47",
      "name": "Situps",
      "description": ""
      }
      },
      {
      "id": "65",
      "workout_id": "2",
      "category": "2",
      "repititions": "40",
      "exercise_id": "36",
      "unit": "times",
      "round": "2",
      "created_at": "2015-11-18 18:30:00",
      "updated_at": "2015-12-07 10:17:23",
      "video": {
      "id": "36",
      "path": "Now36.mp4",
      "videothumbnail": "thumbnail2.png",
      "description": "Test Description"
      },
      "exercise": {
      "id": "36",
      "name": "Dips (Bench)",
      "description": ""
      }
      },
      {
      "id": "74",
      "workout_id": "2",
      "category": "3",
      "repititions": "25",
      "exercise_id": "72",
      "unit": "times",
      "round": "2",
      "created_at": "2015-11-18 18:30:00",
      "updated_at": "2015-12-07 10:17:23",
      "video": {
      "id": "73",
      "path": "Now73.mp4",
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
      "workout_id": "2",
      "category": "3",
      "repititions": "10",
      "exercise_id": "69",
      "unit": "times",
      "round": "2",
      "created_at": "2015-11-18 18:30:00",
      "updated_at": "2015-12-07 10:17:23",
      "video": {
      "id": "69",
      "path": "Now69.mp4",
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
      "workout_id": "2",
      "category": "3",
      "repititions": "30",
      "exercise_id": "75",
      "unit": "times",
      "round": "2",
      "created_at": "2015-11-18 18:30:00",
      "updated_at": "2015-12-07 10:17:23",
      "video": {
      "id": "76",
      "path": "Now76.mp4",
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
      "workout_id": "2",
      "category": "3",
      "repititions": "40",
      "exercise_id": "70",
      "unit": "times",
      "round": "2",
      "created_at": "2015-11-18 18:30:00",
      "updated_at": "2015-12-07 10:17:23",
      "video": {
      "id": "70",
      "path": "Now70.mp4",
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
      "id": "54",
      "workout_id": "2",
      "category": "1",
      "repititions": "25",
      "exercise_id": "11",
      "unit": "times",
      "round": "3",
      "created_at": "2015-11-18 18:30:00",
      "updated_at": "2015-12-07 10:17:23",
      "video": {
      "id": "11",
      "path": "Now11.mp4",
      "videothumbnail": "thumbnail1.png",
      "description": "Test Description"
      },
      "exercise": {
      "id": "11",
      "name": "Sprawl",
      "description": ""
      }
      },
      {
      "id": "55",
      "workout_id": "2",
      "category": "1",
      "repititions": "10",
      "exercise_id": "1",
      "unit": "times",
      "round": "3",
      "created_at": "2015-11-18 18:30:00",
      "updated_at": "2015-12-07 10:17:23",
      "video": {
      "id": "1",
      "path": "Now1.mp4",
      "videothumbnail": "thumbnail3.jpg",
      "description": "Test Description"
      },
      "exercise": {
      "id": "1",
      "name": "Jumping Pullups",
      "description": "The jumping pull-up is a challenging full body exercise that targets the back, legs and arms."
      }
      },
      {
      "id": "56",
      "workout_id": "2",
      "category": "1",
      "repititions": "30",
      "exercise_id": "16",
      "unit": "times",
      "round": "3",
      "created_at": "2015-11-18 18:30:00",
      "updated_at": "2015-12-07 10:17:23",
      "video": {
      "id": "16",
      "path": "Now16.mp4",
      "videothumbnail": "thumbnail3.jpg",
      "description": "Test Description"
      },
      "exercise": {
      "id": "16",
      "name": "Crunches",
      "description": ""
      }
      },
      {
      "id": "57",
      "workout_id": "2",
      "category": "1",
      "repititions": "40",
      "exercise_id": "5",
      "unit": "times",
      "round": "3",
      "created_at": "2015-11-18 18:30:00",
      "updated_at": "2015-12-07 10:17:23",
      "video": {
      "id": "5",
      "path": "Now5.mp4",
      "videothumbnail": "thumbnail1.png",
      "description": "Test Description"
      },
      "exercise": {
      "id": "5",
      "name": "Side Trizeps",
      "description": ""
      }
      },
      {
      "id": "66",
      "workout_id": "2",
      "category": "2",
      "repititions": "25",
      "exercise_id": "42",
      "unit": "times",
      "round": "3",
      "created_at": "2015-11-18 18:30:00",
      "updated_at": "2015-12-07 10:17:23",
      "video": {
      "id": "42",
      "path": "Now42.mp4",
      "videothumbnail": "thumbnail2.png",
      "description": "Test Description"
      },
      "exercise": {
      "id": "42",
      "name": "Burpee",
      "description": ""
      }
      },
      {
      "id": "67",
      "workout_id": "2",
      "category": "2",
      "repititions": "10",
      "exercise_id": "32",
      "unit": "times",
      "round": "3",
      "created_at": "2015-11-18 18:30:00",
      "updated_at": "2015-12-07 10:17:23",
      "video": {
      "id": "32",
      "path": "Now32.mp4",
      "videothumbnail": "thumbnail1.png",
      "description": "Test Description"
      },
      "exercise": {
      "id": "32",
      "name": "Pull ups / Chin ups",
      "description": ""
      }
      },
      {
      "id": "68",
      "workout_id": "2",
      "category": "2",
      "repititions": "30",
      "exercise_id": "47",
      "unit": "times",
      "round": "3",
      "created_at": "2015-11-18 18:30:00",
      "updated_at": "2015-12-07 10:17:23",
      "video": {
      "id": "47",
      "path": "Now47.mp4",
      "videothumbnail": "thumbnail2.png",
      "description": "Test Description"
      },
      "exercise": {
      "id": "47",
      "name": "Situps",
      "description": ""
      }
      },
      {
      "id": "69",
      "workout_id": "2",
      "category": "2",
      "repititions": "40",
      "exercise_id": "36",
      "unit": "times",
      "round": "3",
      "created_at": "2015-11-18 18:30:00",
      "updated_at": "2015-12-07 10:17:23",
      "video": {
      "id": "36",
      "path": "Now36.mp4",
      "videothumbnail": "thumbnail2.png",
      "description": "Test Description"
      },
      "exercise": {
      "id": "36",
      "name": "Dips (Bench)",
      "description": ""
      }
      },
      {
      "id": "78",
      "workout_id": "2",
      "category": "3",
      "repititions": "25",
      "exercise_id": "72",
      "unit": "times",
      "round": "3",
      "created_at": "2015-11-18 18:30:00",
      "updated_at": "2015-12-07 10:17:23",
      "video": {
      "id": "73",
      "path": "Now73.mp4",
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
      "workout_id": "2",
      "category": "3",
      "repititions": "10",
      "exercise_id": "69",
      "unit": "times",
      "round": "3",
      "created_at": "2015-11-18 18:30:00",
      "updated_at": "2015-12-07 10:17:23",
      "video": {
      "id": "69",
      "path": "Now69.mp4",
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
      "workout_id": "2",
      "category": "3",
      "repititions": "30",
      "exercise_id": "75",
      "unit": "times",
      "round": "3",
      "created_at": "2015-11-18 18:30:00",
      "updated_at": "2015-12-07 10:17:23",
      "video": {
      "id": "76",
      "path": "Now76.mp4",
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
      "workout_id": "2",
      "category": "3",
      "repititions": "40",
      "exercise_id": "70",
      "unit": "times",
      "round": "3",
      "created_at": "2015-11-18 18:30:00",
      "updated_at": "2015-12-07 10:17:23",
      "video": {
      "id": "70",
      "path": "Now70.mp4",
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
      "round4": [
      {
      "id": "46",
      "workout_id": "2",
      "category": "1",
      "repititions": "25",
      "exercise_id": "11",
      "unit": "times",
      "round": "1",
      "created_at": "2015-11-18 18:30:00",
      "updated_at": "2015-12-07 10:17:23",
      "video": {
      "id": "11",
      "path": "Now11.mp4",
      "videothumbnail": "thumbnail1.png",
      "description": "Test Description"
      },
      "exercise": {
      "id": "11",
      "name": "Sprawl",
      "description": ""
      }
      },
      {
      "id": "47",
      "workout_id": "2",
      "category": "1",
      "repititions": "10",
      "exercise_id": "1",
      "unit": "times",
      "round": "1",
      "created_at": "2015-11-18 18:30:00",
      "updated_at": "2015-12-07 10:17:23",
      "video": {
      "id": "1",
      "path": "Now1.mp4",
      "videothumbnail": "thumbnail3.jpg",
      "description": "Test Description"
      },
      "exercise": {
      "id": "1",
      "name": "Jumping Pullups",
      "description": "The jumping pull-up is a challenging full body exercise that targets the back, legs and arms."
      }
      },
      {
      "id": "48",
      "workout_id": "2",
      "category": "1",
      "repititions": "30",
      "exercise_id": "16",
      "unit": "times",
      "round": "1",
      "created_at": "2015-11-18 18:30:00",
      "updated_at": "2015-12-07 10:17:23",
      "video": {
      "id": "16",
      "path": "Now16.mp4",
      "videothumbnail": "thumbnail3.jpg",
      "description": "Test Description"
      },
      "exercise": {
      "id": "16",
      "name": "Crunches",
      "description": ""
      }
      },
      {
      "id": "49",
      "workout_id": "2",
      "category": "1",
      "repititions": "40",
      "exercise_id": "5",
      "unit": "times",
      "round": "1",
      "created_at": "2015-11-18 18:30:00",
      "updated_at": "2015-12-07 10:17:23",
      "video": {
      "id": "5",
      "path": "Now5.mp4",
      "videothumbnail": "thumbnail1.png",
      "description": "Test Description"
      },
      "exercise": {
      "id": "5",
      "name": "Side Trizeps",
      "description": ""
      }
      },
      {
      "id": "58",
      "workout_id": "2",
      "category": "2",
      "repititions": "25",
      "exercise_id": "42",
      "unit": "times",
      "round": "1",
      "created_at": "2015-11-18 18:30:00",
      "updated_at": "2015-12-07 10:17:23",
      "video": {
      "id": "42",
      "path": "Now42.mp4",
      "videothumbnail": "thumbnail2.png",
      "description": "Test Description"
      },
      "exercise": {
      "id": "42",
      "name": "Burpee",
      "description": ""
      }
      },
      {
      "id": "59",
      "workout_id": "2",
      "category": "2",
      "repititions": "10",
      "exercise_id": "32",
      "unit": "times",
      "round": "1",
      "created_at": "2015-11-18 18:30:00",
      "updated_at": "2015-12-07 10:17:23",
      "video": {
      "id": "32",
      "path": "Now32.mp4",
      "videothumbnail": "thumbnail1.png",
      "description": "Test Description"
      },
      "exercise": {
      "id": "32",
      "name": "Pull ups / Chin ups",
      "description": ""
      }
      },
      {
      "id": "60",
      "workout_id": "2",
      "category": "2",
      "repititions": "30",
      "exercise_id": "47",
      "unit": "times",
      "round": "1",
      "created_at": "2015-11-18 18:30:00",
      "updated_at": "2015-12-07 10:17:23",
      "video": {
      "id": "47",
      "path": "Now47.mp4",
      "videothumbnail": "thumbnail2.png",
      "description": "Test Description"
      },
      "exercise": {
      "id": "47",
      "name": "Situps",
      "description": ""
      }
      },
      {
      "id": "61",
      "workout_id": "2",
      "category": "2",
      "repititions": "40",
      "exercise_id": "36",
      "unit": "times",
      "round": "1",
      "created_at": "2015-11-18 18:30:00",
      "updated_at": "2015-12-07 10:17:23",
      "video": {
      "id": "36",
      "path": "Now36.mp4",
      "videothumbnail": "thumbnail2.png",
      "description": "Test Description"
      },
      "exercise": {
      "id": "36",
      "name": "Dips (Bench)",
      "description": ""
      }
      },
      {
      "id": "70",
      "workout_id": "2",
      "category": "3",
      "repititions": "25",
      "exercise_id": "72",
      "unit": "times",
      "round": "1",
      "created_at": "2015-11-18 18:30:00",
      "updated_at": "2015-12-07 10:17:23",
      "video": {
      "id": "73",
      "path": "Now73.mp4",
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
      "workout_id": "2",
      "category": "3",
      "repititions": "10",
      "exercise_id": "69",
      "unit": "times",
      "round": "1",
      "created_at": "2015-11-18 18:30:00",
      "updated_at": "2015-12-07 10:17:23",
      "video": {
      "id": "69",
      "path": "Now69.mp4",
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
      "workout_id": "2",
      "category": "3",
      "repititions": "30",
      "exercise_id": "75",
      "unit": "times",
      "round": "1",
      "created_at": "2015-11-18 18:30:00",
      "updated_at": "2015-12-07 10:17:23",
      "video": {
      "id": "76",
      "path": "Now76.mp4",
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
      "workout_id": "2",
      "category": "3",
      "repititions": "40",
      "exercise_id": "70",
      "unit": "times",
      "round": "1",
      "created_at": "2015-11-18 18:30:00",
      "updated_at": "2015-12-07 10:17:23",
      "video": {
      "id": "70",
      "path": "Now70.mp4",
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
      "round5": [
      {
      "id": "50",
      "workout_id": "2",
      "category": "1",
      "repititions": "25",
      "exercise_id": "11",
      "unit": "times",
      "round": "2",
      "created_at": "2015-11-18 18:30:00",
      "updated_at": "2015-12-07 10:17:23",
      "video": {
      "id": "11",
      "path": "Now11.mp4",
      "videothumbnail": "thumbnail1.png",
      "description": "Test Description"
      },
      "exercise": {
      "id": "11",
      "name": "Sprawl",
      "description": ""
      }
      },
      {
      "id": "51",
      "workout_id": "2",
      "category": "1",
      "repititions": "10",
      "exercise_id": "1",
      "unit": "times",
      "round": "2",
      "created_at": "2015-11-18 18:30:00",
      "updated_at": "2015-12-07 10:17:23",
      "video": {
      "id": "1",
      "path": "Now1.mp4",
      "videothumbnail": "thumbnail3.jpg",
      "description": "Test Description"
      },
      "exercise": {
      "id": "1",
      "name": "Jumping Pullups",
      "description": "The jumping pull-up is a challenging full body exercise that targets the back, legs and arms."
      }
      },
      {
      "id": "52",
      "workout_id": "2",
      "category": "1",
      "repititions": "30",
      "exercise_id": "16",
      "unit": "times",
      "round": "2",
      "created_at": "2015-11-18 18:30:00",
      "updated_at": "2015-12-07 10:17:23",
      "video": {
      "id": "16",
      "path": "Now16.mp4",
      "videothumbnail": "thumbnail3.jpg",
      "description": "Test Description"
      },
      "exercise": {
      "id": "16",
      "name": "Crunches",
      "description": ""
      }
      },
      {
      "id": "53",
      "workout_id": "2",
      "category": "1",
      "repititions": "40",
      "exercise_id": "5",
      "unit": "times",
      "round": "2",
      "created_at": "2015-11-18 18:30:00",
      "updated_at": "2015-12-07 10:17:23",
      "video": {
      "id": "5",
      "path": "Now5.mp4",
      "videothumbnail": "thumbnail1.png",
      "description": "Test Description"
      },
      "exercise": {
      "id": "5",
      "name": "Side Trizeps",
      "description": ""
      }
      },
      {
      "id": "62",
      "workout_id": "2",
      "category": "2",
      "repititions": "25",
      "exercise_id": "42",
      "unit": "times",
      "round": "2",
      "created_at": "2015-11-18 18:30:00",
      "updated_at": "2015-12-07 10:17:23",
      "video": {
      "id": "42",
      "path": "Now42.mp4",
      "videothumbnail": "thumbnail2.png",
      "description": "Test Description"
      },
      "exercise": {
      "id": "42",
      "name": "Burpee",
      "description": ""
      }
      },
      {
      "id": "63",
      "workout_id": "2",
      "category": "2",
      "repititions": "10",
      "exercise_id": "32",
      "unit": "times",
      "round": "2",
      "created_at": "2015-11-18 18:30:00",
      "updated_at": "2015-12-07 10:17:23",
      "video": {
      "id": "32",
      "path": "Now32.mp4",
      "videothumbnail": "thumbnail1.png",
      "description": "Test Description"
      },
      "exercise": {
      "id": "32",
      "name": "Pull ups / Chin ups",
      "description": ""
      }
      },
      {
      "id": "64",
      "workout_id": "2",
      "category": "2",
      "repititions": "30",
      "exercise_id": "47",
      "unit": "times",
      "round": "2",
      "created_at": "2015-11-18 18:30:00",
      "updated_at": "2015-12-07 10:17:23",
      "video": {
      "id": "47",
      "path": "Now47.mp4",
      "videothumbnail": "thumbnail2.png",
      "description": "Test Description"
      },
      "exercise": {
      "id": "47",
      "name": "Situps",
      "description": ""
      }
      },
      {
      "id": "65",
      "workout_id": "2",
      "category": "2",
      "repititions": "40",
      "exercise_id": "36",
      "unit": "times",
      "round": "2",
      "created_at": "2015-11-18 18:30:00",
      "updated_at": "2015-12-07 10:17:23",
      "video": {
      "id": "36",
      "path": "Now36.mp4",
      "videothumbnail": "thumbnail2.png",
      "description": "Test Description"
      },
      "exercise": {
      "id": "36",
      "name": "Dips (Bench)",
      "description": ""
      }
      },
      {
      "id": "74",
      "workout_id": "2",
      "category": "3",
      "repititions": "25",
      "exercise_id": "72",
      "unit": "times",
      "round": "2",
      "created_at": "2015-11-18 18:30:00",
      "updated_at": "2015-12-07 10:17:23",
      "video": {
      "id": "73",
      "path": "Now73.mp4",
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
      "workout_id": "2",
      "category": "3",
      "repititions": "10",
      "exercise_id": "69",
      "unit": "times",
      "round": "2",
      "created_at": "2015-11-18 18:30:00",
      "updated_at": "2015-12-07 10:17:23",
      "video": {
      "id": "69",
      "path": "Now69.mp4",
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
      "workout_id": "2",
      "category": "3",
      "repititions": "30",
      "exercise_id": "75",
      "unit": "times",
      "round": "2",
      "created_at": "2015-11-18 18:30:00",
      "updated_at": "2015-12-07 10:17:23",
      "video": {
      "id": "76",
      "path": "Now76.mp4",
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
      "workout_id": "2",
      "category": "3",
      "repititions": "40",
      "exercise_id": "70",
      "unit": "times",
      "round": "2",
      "created_at": "2015-11-18 18:30:00",
      "updated_at": "2015-12-07 10:17:23",
      "video": {
      "id": "70",
      "path": "Now70.mp4",
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
      "round6": [
      {
      "id": "54",
      "workout_id": "2",
      "category": "1",
      "repititions": "25",
      "exercise_id": "11",
      "unit": "times",
      "round": "3",
      "created_at": "2015-11-18 18:30:00",
      "updated_at": "2015-12-07 10:17:23",
      "video": {
      "id": "11",
      "path": "Now11.mp4",
      "videothumbnail": "thumbnail1.png",
      "description": "Test Description"
      },
      "exercise": {
      "id": "11",
      "name": "Sprawl",
      "description": ""
      }
      },
      {
      "id": "55",
      "workout_id": "2",
      "category": "1",
      "repititions": "10",
      "exercise_id": "1",
      "unit": "times",
      "round": "3",
      "created_at": "2015-11-18 18:30:00",
      "updated_at": "2015-12-07 10:17:23",
      "video": {
      "id": "1",
      "path": "Now1.mp4",
      "videothumbnail": "thumbnail3.jpg",
      "description": "Test Description"
      },
      "exercise": {
      "id": "1",
      "name": "Jumping Pullups",
      "description": "The jumping pull-up is a challenging full body exercise that targets the back, legs and arms."
      }
      },
      {
      "id": "56",
      "workout_id": "2",
      "category": "1",
      "repititions": "30",
      "exercise_id": "16",
      "unit": "times",
      "round": "3",
      "created_at": "2015-11-18 18:30:00",
      "updated_at": "2015-12-07 10:17:23",
      "video": {
      "id": "16",
      "path": "Now16.mp4",
      "videothumbnail": "thumbnail3.jpg",
      "description": "Test Description"
      },
      "exercise": {
      "id": "16",
      "name": "Crunches",
      "description": ""
      }
      },
      {
      "id": "57",
      "workout_id": "2",
      "category": "1",
      "repititions": "40",
      "exercise_id": "5",
      "unit": "times",
      "round": "3",
      "created_at": "2015-11-18 18:30:00",
      "updated_at": "2015-12-07 10:17:23",
      "video": {
      "id": "5",
      "path": "Now5.mp4",
      "videothumbnail": "thumbnail1.png",
      "description": "Test Description"
      },
      "exercise": {
      "id": "5",
      "name": "Side Trizeps",
      "description": ""
      }
      },
      {
      "id": "66",
      "workout_id": "2",
      "category": "2",
      "repititions": "25",
      "exercise_id": "42",
      "unit": "times",
      "round": "3",
      "created_at": "2015-11-18 18:30:00",
      "updated_at": "2015-12-07 10:17:23",
      "video": {
      "id": "42",
      "path": "Now42.mp4",
      "videothumbnail": "thumbnail2.png",
      "description": "Test Description"
      },
      "exercise": {
      "id": "42",
      "name": "Burpee",
      "description": ""
      }
      },
      {
      "id": "67",
      "workout_id": "2",
      "category": "2",
      "repititions": "10",
      "exercise_id": "32",
      "unit": "times",
      "round": "3",
      "created_at": "2015-11-18 18:30:00",
      "updated_at": "2015-12-07 10:17:23",
      "video": {
      "id": "32",
      "path": "Now32.mp4",
      "videothumbnail": "thumbnail1.png",
      "description": "Test Description"
      },
      "exercise": {
      "id": "32",
      "name": "Pull ups / Chin ups",
      "description": ""
      }
      },
      {
      "id": "68",
      "workout_id": "2",
      "category": "2",
      "repititions": "30",
      "exercise_id": "47",
      "unit": "times",
      "round": "3",
      "created_at": "2015-11-18 18:30:00",
      "updated_at": "2015-12-07 10:17:23",
      "video": {
      "id": "47",
      "path": "Now47.mp4",
      "videothumbnail": "thumbnail2.png",
      "description": "Test Description"
      },
      "exercise": {
      "id": "47",
      "name": "Situps",
      "description": ""
      }
      },
      {
      "id": "69",
      "workout_id": "2",
      "category": "2",
      "repititions": "40",
      "exercise_id": "36",
      "unit": "times",
      "round": "3",
      "created_at": "2015-11-18 18:30:00",
      "updated_at": "2015-12-07 10:17:23",
      "video": {
      "id": "36",
      "path": "Now36.mp4",
      "videothumbnail": "thumbnail2.png",
      "description": "Test Description"
      },
      "exercise": {
      "id": "36",
      "name": "Dips (Bench)",
      "description": ""
      }
      },
      {
      "id": "78",
      "workout_id": "2",
      "category": "3",
      "repititions": "25",
      "exercise_id": "72",
      "unit": "times",
      "round": "3",
      "created_at": "2015-11-18 18:30:00",
      "updated_at": "2015-12-07 10:17:23",
      "video": {
      "id": "73",
      "path": "Now73.mp4",
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
      "workout_id": "2",
      "category": "3",
      "repititions": "10",
      "exercise_id": "69",
      "unit": "times",
      "round": "3",
      "created_at": "2015-11-18 18:30:00",
      "updated_at": "2015-12-07 10:17:23",
      "video": {
      "id": "69",
      "path": "Now69.mp4",
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
      "workout_id": "2",
      "category": "3",
      "repititions": "30",
      "exercise_id": "75",
      "unit": "times",
      "round": "3",
      "created_at": "2015-11-18 18:30:00",
      "updated_at": "2015-12-07 10:17:23",
      "video": {
      "id": "76",
      "path": "Now76.mp4",
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
      "workout_id": "2",
      "category": "3",
      "repititions": "40",
      "exercise_id": "70",
      "unit": "times",
      "round": "3",
      "created_at": "2015-11-18 18:30:00",
      "updated_at": "2015-12-07 10:17:23",
      "video": {
      "id": "70",
      "path": "Now70.mp4",
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
      "workout_intensity": 2,
      "hiit": [],
      "stretching": [
      {
      "exercise_id": "Superman",
      "duration": {
      "min": 5,
      "max": 10
      },
      "unit": "times"
      },
      {
      "exercise_id": "Lower Back Strength",
      "duration": {
      "min": 30,
      "max": 50
      },
      "unit": "times"
      },
      {
      "exercise_id": "Upper Dog",
      "duration": {
      "min": 30,
      "max": 60
      },
      "unit": "seconds"
      },
      {
      "exercise_id": "Child's Pose",
      "duration": {
      "min": 30,
      "max": 60
      },
      "unit": "seconds"
      },
      {
      "exercise_id": "L-sit on the floor",
      "duration": {
      "min": 30,
      "max": 60
      },
      "unit": "seconds"
      },
      {
      "exercise_id": "Frog stretch",
      "duration": {
      "min": 30,
      "max": 60
      },
      "unit": "seconds"
      },
      {
      "exercise_id": "Good morning",
      "duration": {
      "min": 30,
      "max": 60
      },
      "unit": "seconds"
      },
      {
      "exercise_id": "Chest Opener",
      "duration": {
      "min": 30,
      "max": 60
      },
      "unit": "seconds"
      },
      {
      "exercise_id": "Triceps Stretch",
      "duration": {
      "min": 30,
      "max": 60
      },
      "unit": "seconds"
      },
      {
      "exercise_id": "Hands Back",
      "duration": {
      "min": 30,
      "max": 60
      },
      "unit": "seconds"
      },
      {
      "exercise_id": "Shoulder Stretch",
      "duration": {
      "min": 30,
      "max": 60
      },
      "unit": "seconds"
      }
      ]
      },
      "day2": {
      "warmup": {
      "exercise_id": "warmup",
      "duration": 300
      },
      "fundumentals": [
      {
      "exercise_id": 43,
      "duration": 30,
      "exercise": {
      "id": "43",
      "name": "Pushups",
      "description": "",
      "category": "2",
      "type": "1",
      "rewards": "6.00",
      "repititions": "10",
      "duration": "1.00",
      "unit": "times",
      "equipment": "",
      "video": [
      {
      "id": "43",
      "path": "Now43.mp4",
      "videothumbnail": "thumbnail3.jpg",
      "description": "Test Description"
      }
      ]
      }
      },
      {
      "exercise_id": 32,
      "duration": 10,
      "exercise": {
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
      "video": [
      {
      "id": "32",
      "path": "Now32.mp4",
      "videothumbnail": "thumbnail1.png",
      "description": "Test Description"
      }
      ]
      }
      },
      {
      "exercise_id": 38,
      "duration": 25,
      "exercise": {
      "id": "38",
      "name": "Squats",
      "description": "",
      "category": "2",
      "type": "1",
      "rewards": "6.00",
      "repititions": "10",
      "duration": "1.00",
      "unit": "times",
      "equipment": "",
      "video": [
      {
      "id": "38",
      "path": "Now38.mp4",
      "videothumbnail": "thumbnail1.png",
      "description": "Test Description"
      }
      ]
      }
      },
      {
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
      "video": [
      {
      "id": "1",
      "path": "Now1.mp4",
      "videothumbnail": "thumbnail3.jpg",
      "description": "Test Description"
      }
      ]
      }
      }
      ],
      "exercises": [],
      "workout": {
      "id": "3",
      "name": "Bragi",
      "description": "Bragi",
      "rounds": "5",
      "category": "2",
      "type": "1",
      "rewards": "{\"lean\":330,\"athletic\":440,\"strength\":550}",
      "duration": "14.00",
      "equipments": "Low Bar",
      "exercises": {
      "round1": [
      {
      "id": "82",
      "workout_id": "3",
      "category": "1",
      "repititions": "50",
      "exercise_id": "12",
      "unit": "times",
      "round": "1",
      "created_at": "2015-11-18 18:30:00",
      "updated_at": "2015-11-19 10:00:00",
      "video": {
      "id": "12",
      "path": "Now12.mp4",
      "videothumbnail": "thumbnail2.png",
      "description": "Test Description"
      },
      "exercise": {
      "id": "12",
      "name": "Incline Pushups",
      "description": ""
      }
      },
      {
      "id": "83",
      "workout_id": "3",
      "category": "1",
      "repititions": "10",
      "exercise_id": "12",
      "unit": "times",
      "round": "1",
      "created_at": "2015-11-18 18:30:00",
      "updated_at": "2015-11-19 10:00:00",
      "video": {
      "id": "12",
      "path": "Now12.mp4",
      "videothumbnail": "thumbnail2.png",
      "description": "Test Description"
      },
      "exercise": {
      "id": "12",
      "name": "Incline Pushups",
      "description": ""
      }
      },
      {
      "id": "84",
      "workout_id": "3",
      "category": "1",
      "repititions": "25",
      "exercise_id": "11",
      "unit": "times",
      "round": "1",
      "created_at": "2015-11-18 18:30:00",
      "updated_at": "2015-11-19 10:00:00",
      "video": {
      "id": "11",
      "path": "Now11.mp4",
      "videothumbnail": "thumbnail1.png",
      "description": "Test Description"
      },
      "exercise": {
      "id": "11",
      "name": "Sprawl",
      "description": ""
      }
      },
      {
      "id": "85",
      "workout_id": "3",
      "category": "1",
      "repititions": "10",
      "exercise_id": "2",
      "unit": "times",
      "round": "1",
      "created_at": "2015-11-18 18:30:00",
      "updated_at": "2015-11-19 10:00:54",
      "video": {
      "id": "2",
      "path": "Now2.mp4",
      "videothumbnail": "thumbnail1.png",
      "description": "Test Description"
      },
      "exercise": {
      "id": "2",
      "name": "Australian Pullups",
      "description": "Australian pull-ups are becoming a very popular exercise. Like all types of pull-ups (and all types of exercises for that matter) there are many different ways to do the Australian, and it can be incorporated into a number of different contexts within a workout."
      }
      },
      {
      "id": "86",
      "workout_id": "3",
      "category": "1",
      "repititions": "20",
      "exercise_id": "90",
      "unit": "seconds",
      "round": "1",
      "created_at": "2015-11-18 18:30:00",
      "updated_at": "2015-11-19 10:45:38",
      "video": null,
      "exercise": {
      "id": "90",
      "name": "Rest",
      "description": "Rest"
      }
      },
      {
      "id": "102",
      "workout_id": "3",
      "category": "2",
      "repititions": "10",
      "exercise_id": "43",
      "unit": "times",
      "round": "1",
      "created_at": "2015-11-18 18:30:00",
      "updated_at": "2015-11-19 10:00:00",
      "video": {
      "id": "43",
      "path": "Now43.mp4",
      "videothumbnail": "thumbnail3.jpg",
      "description": "Test Description"
      },
      "exercise": {
      "id": "43",
      "name": "Pushups",
      "description": ""
      }
      },
      {
      "id": "103",
      "workout_id": "3",
      "category": "2",
      "repititions": "25",
      "exercise_id": "42",
      "unit": "times",
      "round": "1",
      "created_at": "2015-11-18 18:30:00",
      "updated_at": "2015-11-19 10:00:00",
      "video": {
      "id": "42",
      "path": "Now42.mp4",
      "videothumbnail": "thumbnail2.png",
      "description": "Test Description"
      },
      "exercise": {
      "id": "42",
      "name": "Burpee",
      "description": ""
      }
      },
      {
      "id": "104",
      "workout_id": "3",
      "category": "2",
      "repititions": "10",
      "exercise_id": "33",
      "unit": "times",
      "round": "1",
      "created_at": "2015-11-18 18:30:00",
      "updated_at": "2015-11-19 10:00:54",
      "video": {
      "id": "33",
      "path": "Now33.mp4",
      "videothumbnail": "thumbnail2.png",
      "description": "Test Description"
      },
      "exercise": {
      "id": "33",
      "name": "One Leg Front Lever",
      "description": ""
      }
      },
      {
      "id": "105",
      "workout_id": "3",
      "category": "2",
      "repititions": "20",
      "exercise_id": "90",
      "unit": "seconds",
      "round": "1",
      "created_at": "2015-11-18 18:30:00",
      "updated_at": "2015-11-19 10:45:38",
      "video": null,
      "exercise": {
      "id": "90",
      "name": "Rest",
      "description": "Rest"
      }
      },
      {
      "id": "121",
      "workout_id": "3",
      "category": "3",
      "repititions": "10",
      "exercise_id": "73",
      "unit": "times",
      "round": "1",
      "created_at": "2015-11-18 18:30:00",
      "updated_at": "2015-11-19 10:00:00",
      "video": {
      "id": "74",
      "path": "Now74.mp4",
      "videothumbnail": "thumbnail1.png",
      "description": "Test Description"
      },
      "exercise": {
      "id": "73",
      "name": "One Arm Pushups",
      "description": ""
      }
      },
      {
      "id": "122",
      "workout_id": "3",
      "category": "3",
      "repititions": "25",
      "exercise_id": "72",
      "unit": "times",
      "round": "1",
      "created_at": "2015-11-18 18:30:00",
      "updated_at": "2015-11-19 10:00:00",
      "video": {
      "id": "73",
      "path": "Now73.mp4",
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
      "id": "123",
      "workout_id": "3",
      "category": "3",
      "repititions": "10",
      "exercise_id": "77",
      "unit": "times",
      "round": "1",
      "created_at": "2015-11-18 18:30:00",
      "updated_at": "2015-11-19 10:00:54",
      "video": {
      "id": "78",
      "path": "Now78.mp4",
      "videothumbnail": "thumbnail2.png",
      "description": "Test Description"
      },
      "exercise": {
      "id": "77",
      "name": "Front Lever",
      "description": ""
      }
      },
      {
      "id": "124",
      "workout_id": "3",
      "category": "3",
      "repititions": "20",
      "exercise_id": "90",
      "unit": "seconds",
      "round": "1",
      "created_at": "2015-11-18 18:30:00",
      "updated_at": "2015-11-19 10:45:38",
      "video": null,
      "exercise": {
      "id": "90",
      "name": "Rest",
      "description": "Rest"
      }
      }
      ],
      "round2": [
      {
      "id": "87",
      "workout_id": "3",
      "category": "1",
      "repititions": "10",
      "exercise_id": "12",
      "unit": "times",
      "round": "2",
      "created_at": "2015-11-18 18:30:00",
      "updated_at": "2015-11-19 10:00:00",
      "video": {
      "id": "12",
      "path": "Now12.mp4",
      "videothumbnail": "thumbnail2.png",
      "description": "Test Description"
      },
      "exercise": {
      "id": "12",
      "name": "Incline Pushups",
      "description": ""
      }
      },
      {
      "id": "88",
      "workout_id": "3",
      "category": "1",
      "repititions": "25",
      "exercise_id": "11",
      "unit": "times",
      "round": "2",
      "created_at": "2015-11-18 18:30:00",
      "updated_at": "2015-11-19 10:00:00",
      "video": {
      "id": "11",
      "path": "Now11.mp4",
      "videothumbnail": "thumbnail1.png",
      "description": "Test Description"
      },
      "exercise": {
      "id": "11",
      "name": "Sprawl",
      "description": ""
      }
      },
      {
      "id": "89",
      "workout_id": "3",
      "category": "1",
      "repititions": "10",
      "exercise_id": "2",
      "unit": "times",
      "round": "2",
      "created_at": "2015-11-18 18:30:00",
      "updated_at": "2015-11-19 10:00:54",
      "video": {
      "id": "2",
      "path": "Now2.mp4",
      "videothumbnail": "thumbnail1.png",
      "description": "Test Description"
      },
      "exercise": {
      "id": "2",
      "name": "Australian Pullups",
      "description": "Australian pull-ups are becoming a very popular exercise. Like all types of pull-ups (and all types of exercises for that matter) there are many different ways to do the Australian, and it can be incorporated into a number of different contexts within a workout."
      }
      },
      {
      "id": "90",
      "workout_id": "3",
      "category": "1",
      "repititions": "20",
      "exercise_id": "90",
      "unit": "seconds",
      "round": "2",
      "created_at": "2015-11-18 18:30:00",
      "updated_at": "2015-11-19 10:45:38",
      "video": null,
      "exercise": {
      "id": "90",
      "name": "Rest",
      "description": "Rest"
      }
      },
      {
      "id": "106",
      "workout_id": "3",
      "category": "2",
      "repititions": "10",
      "exercise_id": "43",
      "unit": "times",
      "round": "2",
      "created_at": "2015-11-18 18:30:00",
      "updated_at": "2015-11-19 10:00:00",
      "video": {
      "id": "43",
      "path": "Now43.mp4",
      "videothumbnail": "thumbnail3.jpg",
      "description": "Test Description"
      },
      "exercise": {
      "id": "43",
      "name": "Pushups",
      "description": ""
      }
      },
      {
      "id": "107",
      "workout_id": "3",
      "category": "2",
      "repititions": "25",
      "exercise_id": "42",
      "unit": "times",
      "round": "2",
      "created_at": "2015-11-18 18:30:00",
      "updated_at": "2015-11-19 10:00:00",
      "video": {
      "id": "42",
      "path": "Now42.mp4",
      "videothumbnail": "thumbnail2.png",
      "description": "Test Description"
      },
      "exercise": {
      "id": "42",
      "name": "Burpee",
      "description": ""
      }
      },
      {
      "id": "108",
      "workout_id": "3",
      "category": "2",
      "repititions": "10",
      "exercise_id": "33",
      "unit": "times",
      "round": "2",
      "created_at": "2015-11-18 18:30:00",
      "updated_at": "2015-11-19 10:00:54",
      "video": {
      "id": "33",
      "path": "Now33.mp4",
      "videothumbnail": "thumbnail2.png",
      "description": "Test Description"
      },
      "exercise": {
      "id": "33",
      "name": "One Leg Front Lever",
      "description": ""
      }
      },
      {
      "id": "109",
      "workout_id": "3",
      "category": "2",
      "repititions": "20",
      "exercise_id": "90",
      "unit": "seconds",
      "round": "2",
      "created_at": "2015-11-18 18:30:00",
      "updated_at": "2015-11-19 10:45:38",
      "video": null,
      "exercise": {
      "id": "90",
      "name": "Rest",
      "description": "Rest"
      }
      },
      {
      "id": "125",
      "workout_id": "3",
      "category": "3",
      "repititions": "10",
      "exercise_id": "73",
      "unit": "times",
      "round": "2",
      "created_at": "2015-11-18 18:30:00",
      "updated_at": "2015-11-19 10:00:00",
      "video": {
      "id": "74",
      "path": "Now74.mp4",
      "videothumbnail": "thumbnail1.png",
      "description": "Test Description"
      },
      "exercise": {
      "id": "73",
      "name": "One Arm Pushups",
      "description": ""
      }
      },
      {
      "id": "126",
      "workout_id": "3",
      "category": "3",
      "repititions": "25",
      "exercise_id": "72",
      "unit": "times",
      "round": "2",
      "created_at": "2015-11-18 18:30:00",
      "updated_at": "2015-11-19 10:00:00",
      "video": {
      "id": "73",
      "path": "Now73.mp4",
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
      "id": "127",
      "workout_id": "3",
      "category": "3",
      "repititions": "10",
      "exercise_id": "77",
      "unit": "times",
      "round": "2",
      "created_at": "2015-11-18 18:30:00",
      "updated_at": "2015-11-19 10:00:54",
      "video": {
      "id": "78",
      "path": "Now78.mp4",
      "videothumbnail": "thumbnail2.png",
      "description": "Test Description"
      },
      "exercise": {
      "id": "77",
      "name": "Front Lever",
      "description": ""
      }
      },
      {
      "id": "128",
      "workout_id": "3",
      "category": "3",
      "repititions": "20",
      "exercise_id": "90",
      "unit": "seconds",
      "round": "2",
      "created_at": "2015-11-18 18:30:00",
      "updated_at": "2015-11-19 10:45:38",
      "video": null,
      "exercise": {
      "id": "90",
      "name": "Rest",
      "description": "Rest"
      }
      }
      ],
      "round3": [
      {
      "id": "91",
      "workout_id": "3",
      "category": "1",
      "repititions": "10",
      "exercise_id": "12",
      "unit": "times",
      "round": "3",
      "created_at": "2015-11-18 18:30:00",
      "updated_at": "2015-11-19 10:00:00",
      "video": {
      "id": "12",
      "path": "Now12.mp4",
      "videothumbnail": "thumbnail2.png",
      "description": "Test Description"
      },
      "exercise": {
      "id": "12",
      "name": "Incline Pushups",
      "description": ""
      }
      },
      {
      "id": "92",
      "workout_id": "3",
      "category": "1",
      "repititions": "25",
      "exercise_id": "11",
      "unit": "times",
      "round": "3",
      "created_at": "2015-11-18 18:30:00",
      "updated_at": "2015-11-19 10:00:00",
      "video": {
      "id": "11",
      "path": "Now11.mp4",
      "videothumbnail": "thumbnail1.png",
      "description": "Test Description"
      },
      "exercise": {
      "id": "11",
      "name": "Sprawl",
      "description": ""
      }
      },
      {
      "id": "93",
      "workout_id": "3",
      "category": "1",
      "repititions": "10",
      "exercise_id": "2",
      "unit": "times",
      "round": "3",
      "created_at": "2015-11-18 18:30:00",
      "updated_at": "2015-11-19 10:00:54",
      "video": {
      "id": "2",
      "path": "Now2.mp4",
      "videothumbnail": "thumbnail1.png",
      "description": "Test Description"
      },
      "exercise": {
      "id": "2",
      "name": "Australian Pullups",
      "description": "Australian pull-ups are becoming a very popular exercise. Like all types of pull-ups (and all types of exercises for that matter) there are many different ways to do the Australian, and it can be incorporated into a number of different contexts within a workout."
      }
      },
      {
      "id": "94",
      "workout_id": "3",
      "category": "1",
      "repititions": "20",
      "exercise_id": "90",
      "unit": "seconds",
      "round": "3",
      "created_at": "2015-11-18 18:30:00",
      "updated_at": "2015-11-19 10:45:38",
      "video": null,
      "exercise": {
      "id": "90",
      "name": "Rest",
      "description": "Rest"
      }
      },
      {
      "id": "110",
      "workout_id": "3",
      "category": "2",
      "repititions": "10",
      "exercise_id": "43",
      "unit": "times",
      "round": "3",
      "created_at": "2015-11-18 18:30:00",
      "updated_at": "2015-11-19 10:00:00",
      "video": {
      "id": "43",
      "path": "Now43.mp4",
      "videothumbnail": "thumbnail3.jpg",
      "description": "Test Description"
      },
      "exercise": {
      "id": "43",
      "name": "Pushups",
      "description": ""
      }
      },
      {
      "id": "111",
      "workout_id": "3",
      "category": "2",
      "repititions": "25",
      "exercise_id": "42",
      "unit": "times",
      "round": "3",
      "created_at": "2015-11-18 18:30:00",
      "updated_at": "2015-11-19 10:00:00",
      "video": {
      "id": "42",
      "path": "Now42.mp4",
      "videothumbnail": "thumbnail2.png",
      "description": "Test Description"
      },
      "exercise": {
      "id": "42",
      "name": "Burpee",
      "description": ""
      }
      },
      {
      "id": "112",
      "workout_id": "3",
      "category": "2",
      "repititions": "10",
      "exercise_id": "33",
      "unit": "times",
      "round": "3",
      "created_at": "2015-11-18 18:30:00",
      "updated_at": "2015-11-19 10:00:54",
      "video": {
      "id": "33",
      "path": "Now33.mp4",
      "videothumbnail": "thumbnail2.png",
      "description": "Test Description"
      },
      "exercise": {
      "id": "33",
      "name": "One Leg Front Lever",
      "description": ""
      }
      },
      {
      "id": "113",
      "workout_id": "3",
      "category": "2",
      "repititions": "20",
      "exercise_id": "90",
      "unit": "seconds",
      "round": "3",
      "created_at": "2015-11-18 18:30:00",
      "updated_at": "2015-11-19 10:45:38",
      "video": null,
      "exercise": {
      "id": "90",
      "name": "Rest",
      "description": "Rest"
      }
      },
      {
      "id": "129",
      "workout_id": "3",
      "category": "3",
      "repititions": "10",
      "exercise_id": "73",
      "unit": "times",
      "round": "3",
      "created_at": "2015-11-18 18:30:00",
      "updated_at": "2015-11-19 10:00:00",
      "video": {
      "id": "74",
      "path": "Now74.mp4",
      "videothumbnail": "thumbnail1.png",
      "description": "Test Description"
      },
      "exercise": {
      "id": "73",
      "name": "One Arm Pushups",
      "description": ""
      }
      },
      {
      "id": "130",
      "workout_id": "3",
      "category": "3",
      "repititions": "25",
      "exercise_id": "72",
      "unit": "times",
      "round": "3",
      "created_at": "2015-11-18 18:30:00",
      "updated_at": "2015-11-19 10:00:00",
      "video": {
      "id": "73",
      "path": "Now73.mp4",
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
      "id": "131",
      "workout_id": "3",
      "category": "3",
      "repititions": "10",
      "exercise_id": "77",
      "unit": "times",
      "round": "3",
      "created_at": "2015-11-18 18:30:00",
      "updated_at": "2015-11-19 10:00:54",
      "video": {
      "id": "78",
      "path": "Now78.mp4",
      "videothumbnail": "thumbnail2.png",
      "description": "Test Description"
      },
      "exercise": {
      "id": "77",
      "name": "Front Lever",
      "description": ""
      }
      },
      {
      "id": "132",
      "workout_id": "3",
      "category": "3",
      "repititions": "20",
      "exercise_id": "90",
      "unit": "seconds",
      "round": "3",
      "created_at": "2015-11-18 18:30:00",
      "updated_at": "2015-11-19 10:45:38",
      "video": null,
      "exercise": {
      "id": "90",
      "name": "Rest",
      "description": "Rest"
      }
      }
      ],
      "round4": [
      {
      "id": "95",
      "workout_id": "3",
      "category": "1",
      "repititions": "10",
      "exercise_id": "12",
      "unit": "times",
      "round": "4",
      "created_at": "2015-11-18 18:30:00",
      "updated_at": "2015-11-19 10:00:00",
      "video": {
      "id": "12",
      "path": "Now12.mp4",
      "videothumbnail": "thumbnail2.png",
      "description": "Test Description"
      },
      "exercise": {
      "id": "12",
      "name": "Incline Pushups",
      "description": ""
      }
      },
      {
      "id": "96",
      "workout_id": "3",
      "category": "1",
      "repititions": "25",
      "exercise_id": "11",
      "unit": "times",
      "round": "4",
      "created_at": "2015-11-18 18:30:00",
      "updated_at": "2015-11-19 10:00:00",
      "video": {
      "id": "11",
      "path": "Now11.mp4",
      "videothumbnail": "thumbnail1.png",
      "description": "Test Description"
      },
      "exercise": {
      "id": "11",
      "name": "Sprawl",
      "description": ""
      }
      },
      {
      "id": "97",
      "workout_id": "3",
      "category": "1",
      "repititions": "10",
      "exercise_id": "2",
      "unit": "times",
      "round": "4",
      "created_at": "2015-11-18 18:30:00",
      "updated_at": "2015-11-19 10:00:54",
      "video": {
      "id": "2",
      "path": "Now2.mp4",
      "videothumbnail": "thumbnail1.png",
      "description": "Test Description"
      },
      "exercise": {
      "id": "2",
      "name": "Australian Pullups",
      "description": "Australian pull-ups are becoming a very popular exercise. Like all types of pull-ups (and all types of exercises for that matter) there are many different ways to do the Australian, and it can be incorporated into a number of different contexts within a workout."
      }
      },
      {
      "id": "98",
      "workout_id": "3",
      "category": "1",
      "repititions": "20",
      "exercise_id": "90",
      "unit": "seconds",
      "round": "4",
      "created_at": "2015-11-18 18:30:00",
      "updated_at": "2015-11-19 10:45:38",
      "video": null,
      "exercise": {
      "id": "90",
      "name": "Rest",
      "description": "Rest"
      }
      },
      {
      "id": "114",
      "workout_id": "3",
      "category": "2",
      "repititions": "10",
      "exercise_id": "43",
      "unit": "times",
      "round": "4",
      "created_at": "2015-11-18 18:30:00",
      "updated_at": "2015-11-19 10:00:00",
      "video": {
      "id": "43",
      "path": "Now43.mp4",
      "videothumbnail": "thumbnail3.jpg",
      "description": "Test Description"
      },
      "exercise": {
      "id": "43",
      "name": "Pushups",
      "description": ""
      }
      },
      {
      "id": "115",
      "workout_id": "3",
      "category": "2",
      "repititions": "25",
      "exercise_id": "42",
      "unit": "times",
      "round": "4",
      "created_at": "2015-11-18 18:30:00",
      "updated_at": "2015-11-19 10:00:00",
      "video": {
      "id": "42",
      "path": "Now42.mp4",
      "videothumbnail": "thumbnail2.png",
      "description": "Test Description"
      },
      "exercise": {
      "id": "42",
      "name": "Burpee",
      "description": ""
      }
      },
      {
      "id": "116",
      "workout_id": "3",
      "category": "2",
      "repititions": "10",
      "exercise_id": "33",
      "unit": "times",
      "round": "4",
      "created_at": "2015-11-18 18:30:00",
      "updated_at": "2015-11-19 10:00:54",
      "video": {
      "id": "33",
      "path": "Now33.mp4",
      "videothumbnail": "thumbnail2.png",
      "description": "Test Description"
      },
      "exercise": {
      "id": "33",
      "name": "One Leg Front Lever",
      "description": ""
      }
      },
      {
      "id": "117",
      "workout_id": "3",
      "category": "2",
      "repititions": "20",
      "exercise_id": "90",
      "unit": "seconds",
      "round": "4",
      "created_at": "2015-11-18 18:30:00",
      "updated_at": "2015-11-19 10:45:38",
      "video": null,
      "exercise": {
      "id": "90",
      "name": "Rest",
      "description": "Rest"
      }
      },
      {
      "id": "133",
      "workout_id": "3",
      "category": "3",
      "repititions": "10",
      "exercise_id": "73",
      "unit": "times",
      "round": "4",
      "created_at": "2015-11-18 18:30:00",
      "updated_at": "2015-11-19 10:00:00",
      "video": {
      "id": "74",
      "path": "Now74.mp4",
      "videothumbnail": "thumbnail1.png",
      "description": "Test Description"
      },
      "exercise": {
      "id": "73",
      "name": "One Arm Pushups",
      "description": ""
      }
      },
      {
      "id": "134",
      "workout_id": "3",
      "category": "3",
      "repititions": "25",
      "exercise_id": "72",
      "unit": "times",
      "round": "4",
      "created_at": "2015-11-18 18:30:00",
      "updated_at": "2015-11-19 10:00:00",
      "video": {
      "id": "73",
      "path": "Now73.mp4",
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
      "id": "135",
      "workout_id": "3",
      "category": "3",
      "repititions": "10",
      "exercise_id": "77",
      "unit": "times",
      "round": "4",
      "created_at": "2015-11-18 18:30:00",
      "updated_at": "2015-11-19 10:00:54",
      "video": {
      "id": "78",
      "path": "Now78.mp4",
      "videothumbnail": "thumbnail2.png",
      "description": "Test Description"
      },
      "exercise": {
      "id": "77",
      "name": "Front Lever",
      "description": ""
      }
      },
      {
      "id": "136",
      "workout_id": "3",
      "category": "3",
      "repititions": "20",
      "exercise_id": "90",
      "unit": "seconds",
      "round": "4",
      "created_at": "2015-11-18 18:30:00",
      "updated_at": "2015-11-19 10:45:38",
      "video": null,
      "exercise": {
      "id": "90",
      "name": "Rest",
      "description": "Rest"
      }
      }
      ],
      "round5": [
      {
      "id": "99",
      "workout_id": "3",
      "category": "1",
      "repititions": "10",
      "exercise_id": "12",
      "unit": "times",
      "round": "5",
      "created_at": "2015-11-18 18:30:00",
      "updated_at": "2015-11-19 10:00:00",
      "video": {
      "id": "12",
      "path": "Now12.mp4",
      "videothumbnail": "thumbnail2.png",
      "description": "Test Description"
      },
      "exercise": {
      "id": "12",
      "name": "Incline Pushups",
      "description": ""
      }
      },
      {
      "id": "100",
      "workout_id": "3",
      "category": "1",
      "repititions": "25",
      "exercise_id": "11",
      "unit": "times",
      "round": "5",
      "created_at": "2015-11-18 18:30:00",
      "updated_at": "2015-11-19 10:00:00",
      "video": {
      "id": "11",
      "path": "Now11.mp4",
      "videothumbnail": "thumbnail1.png",
      "description": "Test Description"
      },
      "exercise": {
      "id": "11",
      "name": "Sprawl",
      "description": ""
      }
      },
      {
      "id": "101",
      "workout_id": "3",
      "category": "1",
      "repititions": "10",
      "exercise_id": "2",
      "unit": "times",
      "round": "5",
      "created_at": "2015-11-18 18:30:00",
      "updated_at": "2015-11-19 10:00:54",
      "video": {
      "id": "2",
      "path": "Now2.mp4",
      "videothumbnail": "thumbnail1.png",
      "description": "Test Description"
      },
      "exercise": {
      "id": "2",
      "name": "Australian Pullups",
      "description": "Australian pull-ups are becoming a very popular exercise. Like all types of pull-ups (and all types of exercises for that matter) there are many different ways to do the Australian, and it can be incorporated into a number of different contexts within a workout."
      }
      },
      {
      "id": "118",
      "workout_id": "3",
      "category": "2",
      "repititions": "10",
      "exercise_id": "43",
      "unit": "times",
      "round": "5",
      "created_at": "2015-11-18 18:30:00",
      "updated_at": "2015-11-19 10:00:00",
      "video": {
      "id": "43",
      "path": "Now43.mp4",
      "videothumbnail": "thumbnail3.jpg",
      "description": "Test Description"
      },
      "exercise": {
      "id": "43",
      "name": "Pushups",
      "description": ""
      }
      },
      {
      "id": "119",
      "workout_id": "3",
      "category": "2",
      "repititions": "25",
      "exercise_id": "42",
      "unit": "times",
      "round": "5",
      "created_at": "2015-11-18 18:30:00",
      "updated_at": "2015-11-19 10:00:00",
      "video": {
      "id": "42",
      "path": "Now42.mp4",
      "videothumbnail": "thumbnail2.png",
      "description": "Test Description"
      },
      "exercise": {
      "id": "42",
      "name": "Burpee",
      "description": ""
      }
      },
      {
      "id": "120",
      "workout_id": "3",
      "category": "2",
      "repititions": "10",
      "exercise_id": "33",
      "unit": "times",
      "round": "5",
      "created_at": "2015-11-18 18:30:00",
      "updated_at": "2015-11-19 10:00:54",
      "video": {
      "id": "33",
      "path": "Now33.mp4",
      "videothumbnail": "thumbnail2.png",
      "description": "Test Description"
      },
      "exercise": {
      "id": "33",
      "name": "One Leg Front Lever",
      "description": ""
      }
      },
      {
      "id": "137",
      "workout_id": "3",
      "category": "3",
      "repititions": "10",
      "exercise_id": "73",
      "unit": "times",
      "round": "5",
      "created_at": "2015-11-18 18:30:00",
      "updated_at": "2015-11-19 10:00:00",
      "video": {
      "id": "74",
      "path": "Now74.mp4",
      "videothumbnail": "thumbnail1.png",
      "description": "Test Description"
      },
      "exercise": {
      "id": "73",
      "name": "One Arm Pushups",
      "description": ""
      }
      },
      {
      "id": "138",
      "workout_id": "3",
      "category": "3",
      "repititions": "25",
      "exercise_id": "72",
      "unit": "times",
      "round": "5",
      "created_at": "2015-11-18 18:30:00",
      "updated_at": "2015-11-19 10:00:00",
      "video": {
      "id": "73",
      "path": "Now73.mp4",
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
      "id": "139",
      "workout_id": "3",
      "category": "3",
      "repititions": "10",
      "exercise_id": "77",
      "unit": "times",
      "round": "5",
      "created_at": "2015-11-18 18:30:00",
      "updated_at": "2015-11-19 10:00:54",
      "video": {
      "id": "78",
      "path": "Now78.mp4",
      "videothumbnail": "thumbnail2.png",
      "description": "Test Description"
      },
      "exercise": {
      "id": "77",
      "name": "Front Lever",
      "description": ""
      }
      }
      ]
      }
      },
      "workout_intensity": 1,
      "hiit": [
      1
      ],
      "stretching": [
      {
      "exercise_id": "Superman",
      "duration": {
      "min": 5,
      "max": 10
      },
      "unit": "times"
      },
      {
      "exercise_id": "Lower Back Strength",
      "duration": {
      "min": 30,
      "max": 50
      },
      "unit": "times"
      },
      {
      "exercise_id": "Upper Dog",
      "duration": {
      "min": 30,
      "max": 60
      },
      "unit": "seconds"
      },
      {
      "exercise_id": "Child's Pose",
      "duration": {
      "min": 30,
      "max": 60
      },
      "unit": "seconds"
      },
      {
      "exercise_id": "L-sit on the floor",
      "duration": {
      "min": 30,
      "max": 60
      },
      "unit": "seconds"
      },
      {
      "exercise_id": "Frog stretch",
      "duration": {
      "min": 30,
      "max": 60
      },
      "unit": "seconds"
      },
      {
      "exercise_id": "Good morning",
      "duration": {
      "min": 30,
      "max": 60
      },
      "unit": "seconds"
      },
      {
      "exercise_id": "Chest Opener",
      "duration": {
      "min": 30,
      "max": 60
      },
      "unit": "seconds"
      },
      {
      "exercise_id": "Triceps Stretch",
      "duration": {
      "min": 30,
      "max": 60
      },
      "unit": "seconds"
      },
      {
      "exercise_id": "Hands Back",
      "duration": {
      "min": 30,
      "max": 60
      },
      "unit": "seconds"
      },
      {
      "exercise_id": "Shoulder Stretch",
      "duration": {
      "min": 30,
      "max": 60
      },
      "unit": "seconds"
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
    public function prepareCoach(Request $request)
    {
        if (!isset($request->user_id) || ($request->user_id == null)) {
            return response()->json(["status" => "0", "error" => "The user_id field is required"]);
        } elseif (!isset($request->test1) || ($request->test1 == null)) {
            return response()->json(["status" => "0", "error" => "The test1 field is required"]);
        } elseif (!isset($request->test2) || ($request->test2 == null)) {
            return response()->json(["status" => "0", "error" => "The test2 field is required"]);
        } elseif (!isset($request->focus) || ($request->focus == null)) {
            return response()->json(["status" => "0", "error" => "The focus field is required"]);
        } elseif (!isset($request->days) || ($request->days == null)) {
            return response()->json(["status" => "0", "error" => "The days field is required"]);
        } else {
            $user = User::where('id', '=', $request->input('user_id'))->first();
            if (!is_null($user)) {
                $data = [
                    'user_id' => $request->user_id,
                    'focus' => $request->focus,
                    'height' => $request->height,
                    'weight' => $request->weight,
                    'days' => $request->days,
                    'exercises' => ''
                ];

                Coach::create($data);

                $coachId = DB::table('coaches')->where('user_id', $request->user_id)->pluck('id');

                $data['test1'] = $request->test1;

                $data['test2'] = $request->test2;

                $coach = Coach::prepareCoachExercises($coachId, $data);

                DB::table('coaches')->where('id', $coachId)->update(['exercises' => json_encode($coach)]);

                DB::table('coach_status')->insert([
                    'user_id' => $request->user_id,
                    'coach_id' => $coachId,
                    'day' => 1,
                    'week' => 1,
                    'status' => 0,
                    'created_at' => Carbon::now()
                ]);

                $coach = Coach::where('user_id', $request->user_id)->first();
                $coachStatus = DB::table('coach_status')->where('user_id', $request->user_id)->where('coach_id', $coach->id)->first();
                $coach->exercises = json_decode($coach->exercises, true);
                return response()->json([
                        'status' => 1,
                        'coach_day' => $coachStatus->day,
                        'coach_week' => $coachStatus->week,
                        'is_subscribed' => $user->is_subscribed,
                        'need_update' => 0,
                        'coach' => $coach,
                        'urls' => config('urls.urls')], 200);
            } else {
                return response()->json(['status' => 0, 'error' => 'user_not_exists'], 500);
            }
        }
    }
    
    /**
     * @api {post} /coach/update updateCoach
     * @apiName updateCoach
     * @apiGroup Coach
     * @apiParam {Number} user_id Id of user *mandatory
     * @apiParam {Number} day Id of user *mandatory
     * @apiSuccess {String} success.
     * @apiSuccessExample Success-Response:
     * HTTP/1.1 200 OK
     * {
      "status": 1,
      "message": "successfully finished day workouts"
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
    public function updateCoach(Request $request)
    {
        if (!isset($request->user_id) || ($request->user_id == null)) {
            return response()->json(["status" => "0", "error" => "The user_id field is required"]);
        } elseif (!isset($request->assesment) || ($request->assesment == null)) {
            return response()->json(["status" => "0", "error" => "The assesment field is required"]);
        } else {
            $user = User::where('id', '=', $request->input('user_id'))->first();
            if (!is_null($user)) {
                

                $coach = Coach::where('user_id', $request->user_id)->first();
                $coachStatus = DB::table('coach_status')->where('user_id', $request->user_id)->where('coach_id', $coach->id)->first();
                $coach->exercises = json_decode($coach->exercises, true);
                return response()->json([
                        'status' => 1,
                        'coach_day' => $coachStatus->day,
                        'coach_week' => $coachStatus->week,
                        'is_subscribed' => $user->is_subscribed,
                        'need_update' => 0,
                        'coach' => $coach,
                        'urls' => config('urls.urls')], 200);
            } else {
                return response()->json(['status' => 0, 'error' => 'user_not_exists'], 500);
            }
        }
    }
}
