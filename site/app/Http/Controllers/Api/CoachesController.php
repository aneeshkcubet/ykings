<?php namespace App\Http\Controllers\Api;

use Auth,
    DB;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\User;
use App\Profile;
use App\Exercise;
use App\Exerciseuser;
use App\Coach;
use App\Musclegroup;
use Carbon\Carbon;

class CoachesController extends Controller
{
    /*
      |--------------------------------------------------------------------------
      | CoachesController Controller
      |--------------------------------------------------------------------------
      |
      | This controller handles coaches and Algorithm.
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
     * @api {post} /coach/get getCoach
     * @apiName getCoach
     * @apiGroup Coach
     * @apiParam {Number} user_id Id of user *required 
     * @apiParam {String} [tz_offset] User timexone offset eg. +05:30 for IST
     * @apiSuccess {String} success.
     * @apiSuccessExample Success-Response:
     * HTTP/1.1 200 OK
     * {
      "status": 1,
      "message": "coach_exercises",
      "coach_day": "1",
      "coach_week": "1",
      "is_subscribed": 1,
      "need_update": 0,
      "week_status": {
      "1": 0
      },
      "day_status": {
      "1": 0,
      "2": 0,
      "3": 0,
      "4": 0,
      "5": 0,
      "6": 0
      },
      "week_points": "330.00",
      "coach": {
      "id": "490",
      "user_id": "67",
      "focus": "2",
      "height": "0.00",
      "weight": "0.00",
      "days": "6",
      "exercises": {
      "day1": {
      "warmup": [
      {
      "id": "1",
      "name": "wall extensions",
      "duration": {
      "min": "10",
      "max": "20"
      },
      "unit": "times",
      "created_at": "2016-01-21 08:55:06",
      "updated_at": "2016-01-21 08:55:06",
      "is_completed": 0
      },
      {
      "id": "2",
      "name": "band dislocates",
      "duration": {
      "min": "10",
      "max": "20"
      },
      "unit": "times",
      "created_at": "2016-01-21 08:57:38",
      "updated_at": "2016-01-21 08:57:38",
      "is_completed": 0
      },
      {
      "id": "3",
      "name": "cat-camels",
      "duration": {
      "min": "10",
      "max": "20"
      },
      "unit": "times",
      "created_at": "2016-01-21 09:00:39",
      "updated_at": "2016-01-21 09:00:39",
      "is_completed": 0
      },
      {
      "id": "4",
      "name": "scapular shrugs",
      "duration": {
      "min": "10",
      "max": "20"
      },
      "unit": "times",
      "created_at": "2016-01-21 09:01:01",
      "updated_at": "2016-01-21 09:01:01",
      "is_completed": 0
      },
      {
      "id": "5",
      "name": "full body circles",
      "duration": {
      "min": "10",
      "max": "20"
      },
      "unit": "times",
      "created_at": "2016-01-21 09:01:26",
      "updated_at": "2016-01-21 09:01:26",
      "is_completed": 0
      },
      {
      "id": "6",
      "name": "Jumping Jacks",
      "duration": {
      "min": "100",
      "max": ""
      },
      "unit": "seconds",
      "created_at": "2016-01-21 09:04:52",
      "updated_at": "2016-01-21 09:04:52",
      "is_completed": 0
      },
      {
      "id": "7",
      "name": "Arm rotations",
      "duration": {
      "min": "120",
      "max": ""
      },
      "unit": "times",
      "created_at": "2016-01-21 09:05:29",
      "updated_at": "2016-01-21 09:05:29",
      "is_completed": 0
      },
      {
      "id": "8",
      "name": "High Knees",
      "duration": {
      "min": "50",
      "max": ""
      },
      "unit": "times",
      "created_at": "2016-01-21 09:06:02",
      "updated_at": "2016-01-21 09:06:02",
      "is_completed": 0
      },
      {
      "id": "9",
      "name": "Shouder rolls",
      "duration": {
      "min": "20",
      "max": ""
      },
      "unit": "times",
      "created_at": "2016-01-21 09:06:34",
      "updated_at": "2016-01-21 09:06:34",
      "is_completed": 0
      }
      ],
      "is_completed": 0,
      "fundumentals": [
      {
      "id": "16",
      "row": "4",
      "exercise_id": "57",
      "duration": {
      "min": "15",
      "max": ""
      },
      "unit": "times",
      "is_completed": "0",
      "created_at": "2016-01-22 04:51:17",
      "updated_at": "2016-04-04 12:10:48",
      "exercise": {
      "id": "57",
      "name": "Knee Raises",
      "description": "Develop grip and core strength and get used to slow and controlled moves",
      "category": "1",
      "type": "2",
      "muscle_groups": "4,6,7",
      "rewards": "6.00",
      "repititions": "10",
      "duration": "10",
      "unit": "times",
      "equipment": "",
      "range_of_motion": "1. Start from a deadhang position with your arms and legs fully extended, and feet off the ground.  \r\n2. Raise your knees up towards your chest as high as possible. \r\n3. Hold for a brief moment and slowly return to the starting position. \r\n4. Repeat for required repetitions. ",
      "video_tips": "    ",
      "pro_tips": "Avoid using momentum or swinging during the exercise. \r\nPerform the knee raise slowly and controlled.",
      "is_static": "0",
      "musclegroup_string": "Back, Core, Legs",
      "video": [
      {
      "id": "67",
      "path": "57_1454044213.mp4",
      "videothumbnail": "57_1454044213.jpg",
      "description": "Knee Raises"
      }
      ]
      }
      },
      {
      "id": "17",
      "row": "4",
      "exercise_id": "78",
      "duration": {
      "min": "20",
      "max": ""
      },
      "unit": "times",
      "is_completed": "0",
      "created_at": "2016-01-22 04:52:22",
      "updated_at": "2016-04-04 14:00:58",
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
      "is_static": "0",
      "musclegroup_string": "Shoulders, Back, Arms, Core",
      "video": [
      {
      "id": "78",
      "path": "78_1454045971.mp4",
      "videothumbnail": "78_1454045971.jpg",
      "description": "Australian Pullups"
      }
      ]
      }
      },
      {
      "id": "18",
      "row": "4",
      "exercise_id": "49",
      "duration": {
      "min": "30",
      "max": ""
      },
      "unit": "times",
      "is_completed": "0",
      "created_at": "2016-01-22 04:52:56",
      "updated_at": "2016-04-04 14:19:29",
      "exercise": {
      "id": "49",
      "name": "Side Triceps",
      "description": "Start with the basics of building triceps strength",
      "category": "1",
      "type": "1",
      "muscle_groups": "3",
      "rewards": "6.00",
      "repititions": "10",
      "duration": "10",
      "unit": "times",
      "equipment": "",
      "range_of_motion": " 1. Start with the body on your side\r\n2. Put one hand on your shoulder \r\n3. Press up with the other arm and hold in extension ",
      "video_tips": "          ",
      "pro_tips": " Avoid supporting the movement with your core muscle.      ",
      "is_static": "0",
      "musclegroup_string": "Triceps",
      "video": [
      {
      "id": "43",
      "path": "49_1454043404.mp4",
      "videothumbnail": "49_1454043404.jpg",
      "description": "Side Triceps"
      }
      ]
      }
      },
      {
      "id": "19",
      "row": "4",
      "exercise_id": "45",
      "duration": {
      "min": "25",
      "max": ""
      },
      "unit": "times",
      "is_completed": "0",
      "created_at": "2016-01-22 04:53:50",
      "updated_at": "2016-04-04 14:16:38",
      "exercise": {
      "id": "45",
      "name": "Squats",
      "description": "Get strong with a world class full body compound exercise",
      "category": "2",
      "type": "1",
      "muscle_groups": "7",
      "rewards": "7.00",
      "repititions": "10",
      "duration": "10",
      "unit": "times",
      "equipment": "",
      "range_of_motion": " 1. Start from a standing position\r\n2. Go down in a squat \r\n3. Keep your hands in front of you and press yourself up ",
      "video_tips": "      ",
      "pro_tips": " Lock the knees out while squeezing the glutes to execute properly.\r\nSquat deep and hold for 1-2 secs, ass to the grass!     ",
      "is_static": "0",
      "musclegroup_string": "Legs",
      "video": [
      {
      "id": "41",
      "path": "45_1454043104.mp4",
      "videothumbnail": "45_1454043104.jpg",
      "description": "Squats"
      }
      ]
      }
      },
      {
      "id": "20",
      "row": "4",
      "exercise_id": "32",
      "duration": {
      "min": "20",
      "max": ""
      },
      "unit": "times",
      "is_completed": "0",
      "created_at": "2016-01-22 04:54:35",
      "updated_at": "2016-04-04 11:06:44",
      "exercise": {
      "id": "32",
      "name": "Sprawl",
      "description": "Boost your cardio and strength with sprawls",
      "category": "1",
      "type": "1",
      "muscle_groups": "8",
      "rewards": "6.00",
      "repititions": "10",
      "duration": "10",
      "unit": "times",
      "equipment": "",
      "range_of_motion": "1. Start in a standing position\r\n2. Go into a straight arm plank position\r\n3. Go back up and jump with your hands above your head",
      "video_tips": "    ",
      "pro_tips": "Avoid a hollow back during the movement. \r\nKeep the core and lower back engaged at all times.",
      "is_static": "0",
      "musclegroup_string": "Full Body",
      "video": [
      {
      "id": "29",
      "path": "32_1454041954.mp4",
      "videothumbnail": "32_1454041954.jpg",
      "description": "Sprawl"
      }
      ]
      }
      }
      ],
      "exercises": [],
      "workout": {
      "id": "3",
      "name": "Bragi",
      "description": "D,C,A",
      "rounds": "5",
      "category": "2",
      "type": "2",
      "rewards": "440",
      "duration": "480.00",
      "equipments": "Bar/Rings",
      "is_completed": 0,
      "exercises": {
      "round1": [
      {
      "id": "100",
      "workout_id": "3",
      "category": "1",
      "repititions": "10",
      "exercise_id": "14",
      "unit": "times",
      "round": "1",
      "created_at": "2016-01-19 04:18:12",
      "updated_at": "2016-04-04 09:33:39",
      "exercise": {
      "id": "14",
      "name": "Incline Pushups",
      "description": "Start your journey with the simplest way to develop an athletic physique",
      "category": "1",
      "type": "1",
      "muscle_groups": "1,2,3",
      "rewards": "6.00",
      "repititions": "10",
      "duration": "10",
      "unit": "times",
      "equipment": "",
      "range_of_motion": "1. Place hands on edge of bench, bar or rings at waist height, slightly wider than shoulder width \r\n2. Perform regular pushup. Arms should be perpendicular to body. \r\n  ",
      "video_tips": "    ",
      "pro_tips": "Resistance can be de- or increased by performing movement on different angles.\r\nAvoid rounding your spine and doing ?banana back? pushups, try squeezing your core.\r\n  ",
      "is_static": "0",
      "musclegroup_string": "Shoulders, Chest, Triceps"
      },
      "is_completed": 0
      },
      {
      "id": "105",
      "workout_id": "3",
      "category": "1",
      "repititions": "25",
      "exercise_id": "36",
      "unit": "times",
      "round": "1",
      "created_at": "2016-01-19 04:19:20",
      "updated_at": "2016-04-04 11:12:49",
      "exercise": {
      "id": "36",
      "name": "High Jumps",
      "description": "Do high jumps as a part of restless HIIT workouts",
      "category": "1",
      "type": "2",
      "muscle_groups": "7",
      "rewards": "6.00",
      "repititions": "10",
      "duration": "10",
      "unit": "times",
      "equipment": "",
      "range_of_motion": "1. Start from a standing position\r\n2. Jump up and bring your knees to your chest",
      "video_tips": "    ",
      "pro_tips": "Land softly and exhale when the knees are up.\r\n  ",
      "is_static": "0",
      "musclegroup_string": "Legs"
      },
      "is_completed": 0
      },
      {
      "id": "110",
      "workout_id": "3",
      "category": "1",
      "repititions": "7",
      "exercise_id": "66",
      "unit": "times",
      "round": "1",
      "created_at": "2016-01-19 04:19:53",
      "updated_at": "2016-04-04 14:31:38",
      "exercise": {
      "id": "69",
      "name": "Jumping Pullups",
      "description": "Expose yourself to packed shoulders and hang time",
      "category": "1",
      "type": "1",
      "muscle_groups": "1,5",
      "rewards": "6.00",
      "repititions": "10",
      "duration": "10",
      "unit": "times",
      "equipment": "",
      "range_of_motion": " 1. Grip a bar and jump into the top position of the pull-up exercise\r\n2. Straight legs in front of you. \r\n3. Slowly go down into a deadhang position ",
      "video_tips": "        ",
      "pro_tips": " A deadhang postion requires your shoulder blades down and towards the spine with arms being straight (retraction)\r\nAim for three second holds at the top and go down slowly ",
      "is_static": "0",
      "musclegroup_string": "Shoulders, Arms"
      },
      "is_completed": 0
      }
      ],
      "round2": [
      {
      "id": "101",
      "workout_id": "3",
      "category": "1",
      "repititions": "10",
      "exercise_id": "14",
      "unit": "times",
      "round": "2",
      "created_at": "2016-01-19 04:18:12",
      "updated_at": "2016-04-04 09:33:39",
      "exercise": {
      "id": "14",
      "name": "Incline Pushups",
      "description": "Start your journey with the simplest way to develop an athletic physique",
      "category": "1",
      "type": "1",
      "muscle_groups": "1,2,3",
      "rewards": "6.00",
      "repititions": "10",
      "duration": "10",
      "unit": "times",
      "equipment": "",
      "range_of_motion": "1. Place hands on edge of bench, bar or rings at waist height, slightly wider than shoulder width \r\n2. Perform regular pushup. Arms should be perpendicular to body. \r\n  ",
      "video_tips": "    ",
      "pro_tips": "Resistance can be de- or increased by performing movement on different angles.\r\nAvoid rounding your spine and doing ?banana back? pushups, try squeezing your core.\r\n  ",
      "is_static": "0",
      "musclegroup_string": "Shoulders, Chest, Triceps"
      },
      "is_completed": 0
      },
      {
      "id": "106",
      "workout_id": "3",
      "category": "1",
      "repititions": "25",
      "exercise_id": "36",
      "unit": "times",
      "round": "2",
      "created_at": "2016-01-19 04:19:20",
      "updated_at": "2016-04-04 11:12:49",
      "exercise": {
      "id": "36",
      "name": "High Jumps",
      "description": "Do high jumps as a part of restless HIIT workouts",
      "category": "1",
      "type": "2",
      "muscle_groups": "7",
      "rewards": "6.00",
      "repititions": "10",
      "duration": "10",
      "unit": "times",
      "equipment": "",
      "range_of_motion": "1. Start from a standing position\r\n2. Jump up and bring your knees to your chest",
      "video_tips": "    ",
      "pro_tips": "Land softly and exhale when the knees are up.\r\n  ",
      "is_static": "0",
      "musclegroup_string": "Legs"
      },
      "is_completed": 0
      },
      {
      "id": "111",
      "workout_id": "3",
      "category": "1",
      "repititions": "7",
      "exercise_id": "66",
      "unit": "times",
      "round": "2",
      "created_at": "2016-01-19 04:19:54",
      "updated_at": "2016-04-04 14:31:38",
      "exercise": {
      "id": "69",
      "name": "Jumping Pullups",
      "description": "Expose yourself to packed shoulders and hang time",
      "category": "1",
      "type": "1",
      "muscle_groups": "1,5",
      "rewards": "6.00",
      "repititions": "10",
      "duration": "10",
      "unit": "times",
      "equipment": "",
      "range_of_motion": " 1. Grip a bar and jump into the top position of the pull-up exercise\r\n2. Straight legs in front of you. \r\n3. Slowly go down into a deadhang position ",
      "video_tips": "        ",
      "pro_tips": " A deadhang postion requires your shoulder blades down and towards the spine with arms being straight (retraction)\r\nAim for three second holds at the top and go down slowly ",
      "is_static": "0",
      "musclegroup_string": "Shoulders, Arms"
      },
      "is_completed": 0
      }
      ],
      "round3": [
      {
      "id": "102",
      "workout_id": "3",
      "category": "1",
      "repititions": "10",
      "exercise_id": "14",
      "unit": "times",
      "round": "3",
      "created_at": "2016-01-19 04:18:12",
      "updated_at": "2016-04-04 09:33:39",
      "exercise": {
      "id": "14",
      "name": "Incline Pushups",
      "description": "Start your journey with the simplest way to develop an athletic physique",
      "category": "1",
      "type": "1",
      "muscle_groups": "1,2,3",
      "rewards": "6.00",
      "repititions": "10",
      "duration": "10",
      "unit": "times",
      "equipment": "",
      "range_of_motion": "1. Place hands on edge of bench, bar or rings at waist height, slightly wider than shoulder width \r\n2. Perform regular pushup. Arms should be perpendicular to body. \r\n  ",
      "video_tips": "    ",
      "pro_tips": "Resistance can be de- or increased by performing movement on different angles.\r\nAvoid rounding your spine and doing ?banana back? pushups, try squeezing your core.\r\n  ",
      "is_static": "0",
      "musclegroup_string": "Shoulders, Chest, Triceps"
      },
      "is_completed": 0
      },
      {
      "id": "107",
      "workout_id": "3",
      "category": "1",
      "repititions": "25",
      "exercise_id": "36",
      "unit": "times",
      "round": "3",
      "created_at": "2016-01-19 04:19:20",
      "updated_at": "2016-04-04 11:12:49",
      "exercise": {
      "id": "36",
      "name": "High Jumps",
      "description": "Do high jumps as a part of restless HIIT workouts",
      "category": "1",
      "type": "2",
      "muscle_groups": "7",
      "rewards": "6.00",
      "repititions": "10",
      "duration": "10",
      "unit": "times",
      "equipment": "",
      "range_of_motion": "1. Start from a standing position\r\n2. Jump up and bring your knees to your chest",
      "video_tips": "    ",
      "pro_tips": "Land softly and exhale when the knees are up.\r\n  ",
      "is_static": "0",
      "musclegroup_string": "Legs"
      },
      "is_completed": 0
      },
      {
      "id": "112",
      "workout_id": "3",
      "category": "1",
      "repititions": "7",
      "exercise_id": "66",
      "unit": "times",
      "round": "3",
      "created_at": "2016-01-19 04:19:54",
      "updated_at": "2016-04-04 14:31:38",
      "exercise": {
      "id": "69",
      "name": "Jumping Pullups",
      "description": "Expose yourself to packed shoulders and hang time",
      "category": "1",
      "type": "1",
      "muscle_groups": "1,5",
      "rewards": "6.00",
      "repititions": "10",
      "duration": "10",
      "unit": "times",
      "equipment": "",
      "range_of_motion": " 1. Grip a bar and jump into the top position of the pull-up exercise\r\n2. Straight legs in front of you. \r\n3. Slowly go down into a deadhang position ",
      "video_tips": "        ",
      "pro_tips": " A deadhang postion requires your shoulder blades down and towards the spine with arms being straight (retraction)\r\nAim for three second holds at the top and go down slowly ",
      "is_static": "0",
      "musclegroup_string": "Shoulders, Arms"
      },
      "is_completed": 0
      }
      ]
      },
      "exercise_category": 1
      },
      "coach_workout_rounds": 3,
      "workout_intensity": 1,
      "hiit": [],
      "stretching": [
      {
      "id": "1",
      "exercise_id": "Superman",
      "duration": {
      "min": 6,
      "max": 13
      },
      "unit": "times",
      "is_completed": "0",
      "created_at": "2016-01-22 07:10:31",
      "updated_at": "2016-01-22 07:10:31"
      },
      {
      "id": "2",
      "exercise_id": "Lower Back Strength",
      "duration": {
      "min": 38,
      "max": 63
      },
      "unit": "times",
      "is_completed": "0",
      "created_at": "2016-01-22 07:15:02",
      "updated_at": "2016-01-22 07:15:02"
      },
      {
      "id": "3",
      "exercise_id": "Upper Dog",
      "duration": {
      "min": 38,
      "max": 75
      },
      "unit": "seconds",
      "is_completed": "0",
      "created_at": "2016-01-22 07:16:03",
      "updated_at": "2016-01-22 07:16:03"
      },
      {
      "id": "4",
      "exercise_id": "Child's Pose",
      "duration": {
      "min": 38,
      "max": 75
      },
      "unit": "seconds",
      "is_completed": "0",
      "created_at": "2016-01-22 07:16:46",
      "updated_at": "2016-01-22 07:16:46"
      },
      {
      "id": "5",
      "exercise_id": "L-sit on the floor",
      "duration": {
      "min": 38,
      "max": 75
      },
      "unit": "seconds",
      "is_completed": "0",
      "created_at": "2016-01-22 07:17:13",
      "updated_at": "2016-01-22 07:17:13"
      },
      {
      "id": "6",
      "exercise_id": "Good morning",
      "duration": {
      "min": 38,
      "max": 75
      },
      "unit": "seconds",
      "is_completed": "0",
      "created_at": "2016-01-22 07:17:43",
      "updated_at": "2016-01-22 07:17:43"
      },
      {
      "id": "7",
      "exercise_id": "Chest Opener",
      "duration": {
      "min": 38,
      "max": 75
      },
      "unit": "seconds",
      "is_completed": "0",
      "created_at": "2016-01-22 07:19:32",
      "updated_at": "2016-01-22 07:19:32"
      },
      {
      "id": "8",
      "exercise_id": "Triceps Stretc",
      "duration": {
      "min": 38,
      "max": 75
      },
      "unit": "seconds",
      "is_completed": "0",
      "created_at": "2016-01-22 07:19:56",
      "updated_at": "2016-01-22 07:19:56"
      },
      {
      "id": "9",
      "exercise_id": "Hands Back",
      "duration": {
      "min": 38,
      "max": 75
      },
      "unit": "seconds",
      "is_completed": "0",
      "created_at": "2016-01-22 07:20:19",
      "updated_at": "2016-01-22 07:20:19"
      },
      {
      "id": "10",
      "exercise_id": "Shoulder Stretch",
      "duration": {
      "min": 38,
      "max": 75
      },
      "unit": "seconds",
      "is_completed": "0",
      "created_at": "2016-01-22 07:20:45",
      "updated_at": "2016-01-22 07:20:45"
      }
      ],
      "status": "pending"
      },
      "day2": {
      "warmup": [
      {
      "id": "1",
      "name": "wall extensions",
      "duration": {
      "min": "10",
      "max": "20"
      },
      "unit": "times",
      "created_at": "2016-01-21 08:55:06",
      "updated_at": "2016-01-21 08:55:06",
      "is_completed": 0
      },
      {
      "id": "2",
      "name": "band dislocates",
      "duration": {
      "min": "10",
      "max": "20"
      },
      "unit": "times",
      "created_at": "2016-01-21 08:57:38",
      "updated_at": "2016-01-21 08:57:38",
      "is_completed": 0
      },
      {
      "id": "3",
      "name": "cat-camels",
      "duration": {
      "min": "10",
      "max": "20"
      },
      "unit": "times",
      "created_at": "2016-01-21 09:00:39",
      "updated_at": "2016-01-21 09:00:39",
      "is_completed": 0
      },
      {
      "id": "4",
      "name": "scapular shrugs",
      "duration": {
      "min": "10",
      "max": "20"
      },
      "unit": "times",
      "created_at": "2016-01-21 09:01:01",
      "updated_at": "2016-01-21 09:01:01",
      "is_completed": 0
      },
      {
      "id": "5",
      "name": "full body circles",
      "duration": {
      "min": "10",
      "max": "20"
      },
      "unit": "times",
      "created_at": "2016-01-21 09:01:26",
      "updated_at": "2016-01-21 09:01:26",
      "is_completed": 0
      },
      {
      "id": "6",
      "name": "Jumping Jacks",
      "duration": {
      "min": "100",
      "max": ""
      },
      "unit": "seconds",
      "created_at": "2016-01-21 09:04:52",
      "updated_at": "2016-01-21 09:04:52",
      "is_completed": 0
      },
      {
      "id": "7",
      "name": "Arm rotations",
      "duration": {
      "min": "120",
      "max": ""
      },
      "unit": "times",
      "created_at": "2016-01-21 09:05:29",
      "updated_at": "2016-01-21 09:05:29",
      "is_completed": 0
      },
      {
      "id": "8",
      "name": "High Knees",
      "duration": {
      "min": "50",
      "max": ""
      },
      "unit": "times",
      "created_at": "2016-01-21 09:06:02",
      "updated_at": "2016-01-21 09:06:02",
      "is_completed": 0
      },
      {
      "id": "9",
      "name": "Shouder rolls",
      "duration": {
      "min": "20",
      "max": ""
      },
      "unit": "times",
      "created_at": "2016-01-21 09:06:34",
      "updated_at": "2016-01-21 09:06:34",
      "is_completed": 0
      }
      ],
      "is_completed": 0,
      "fundumentals": [
      {
      "id": "6",
      "row": "2",
      "exercise_id": "64",
      "duration": {
      "min": "10",
      "max": ""
      },
      "unit": "times",
      "is_completed": "0",
      "created_at": "2016-01-22 04:29:57",
      "updated_at": "2016-04-04 14:27:54",
      "exercise": {
      "id": "64",
      "name": "Skin the cat",
      "description": "Develop your joints mobility and expose yourself to new movement layers",
      "category": "1",
      "type": "2",
      "muscle_groups": "4,5,6",
      "rewards": "6.00",
      "repititions": "10",
      "duration": "10",
      "unit": "times",
      "equipment": "",
      "range_of_motion": " 1. Hands a little more than shoulder width apart\r\n2. Raise your knees to the chest\r\n3. continuing the movement until the feet pass up through the arms and over head into an inverted hang position.\r\n4. Continue to pass the feet round and down toward the ground into the extended 'skin the cat' position.\r\n5. Lift your hips and raise the legs back and over to the starting hang position. ",
      "video_tips": "        ",
      "pro_tips": " Put your hands closer together to ease up all back lever progressions.\r\nDo only half of the movement in the beginning, but fight for completion over time.\r\nIncorporate other static elements to challenge yourself during the movement as you master other skills.\r\n    ",
      "is_static": "0",
      "musclegroup_string": "Back, Arms, Core",
      "video": [
      {
      "id": "71",
      "path": "64_1454045043.mp4",
      "videothumbnail": "64_1454045043.jpg",
      "description": "Skin the cat"
      }
      ]
      }
      },
      {
      "id": "7",
      "row": "2",
      "exercise_id": "14",
      "duration": {
      "min": "20",
      "max": ""
      },
      "unit": "times",
      "is_completed": "0",
      "created_at": "2016-01-22 04:31:09",
      "updated_at": "2016-04-04 09:33:39",
      "exercise": {
      "id": "14",
      "name": "Incline Pushups",
      "description": "Start your journey with the simplest way to develop an athletic physique",
      "category": "1",
      "type": "1",
      "muscle_groups": "1,2,3",
      "rewards": "6.00",
      "repititions": "10",
      "duration": "10",
      "unit": "times",
      "equipment": "",
      "range_of_motion": "1. Place hands on edge of bench, bar or rings at waist height, slightly wider than shoulder width \r\n2. Perform regular pushup. Arms should be perpendicular to body. \r\n  ",
      "video_tips": "    ",
      "pro_tips": "Resistance can be de- or increased by performing movement on different angles.\r\nAvoid rounding your spine and doing ?banana back? pushups, try squeezing your core.\r\n  ",
      "is_static": "0",
      "musclegroup_string": "Shoulders, Chest, Triceps",
      "video": [
      {
      "id": "13",
      "path": "14_1453984243.mp4",
      "videothumbnail": "14_1453984243.jpg",
      "description": "Incline Pushups"
      }
      ]
      }
      },
      {
      "id": "8",
      "row": "2",
      "exercise_id": "48",
      "duration": {
      "min": "30",
      "max": ""
      },
      "unit": "times",
      "is_completed": "0",
      "created_at": "2016-01-22 04:32:04",
      "updated_at": "2016-04-04 14:19:00",
      "exercise": {
      "id": "48",
      "name": "Bench Dips",
      "description": "Develop more strength as you increase resistance with your bodyweight",
      "category": "1",
      "type": "2",
      "muscle_groups": "3",
      "rewards": "7.00",
      "repititions": "10",
      "duration": "10",
      "unit": "times",
      "equipment": "",
      "range_of_motion": " 1. Sit on side of bench. \r\n2. Place hands on edge of bench. Position feet away from bench and rest heels on floor with legs straight. \r\n3. Lower your body with the feet in front of you\r\n4. Press your body up and hold in extension ",
      "video_tips": "      ",
      "pro_tips": " Don?t rush through your movements to make things easier on yourself. You will sacrifice your form, and in the end, you won?t actually get good at the skills you?re working on.\r\nThe closer you put your hands together, the tougher the bench dip becomes. ",
      "is_static": "0",
      "musclegroup_string": "Triceps",
      "video": [
      {
      "id": "62",
      "path": "48_1454043291.mp4",
      "videothumbnail": "48_1454043291.jpg",
      "description": "Bench Dips"
      }
      ]
      }
      },
      {
      "id": "9",
      "row": "2",
      "exercise_id": "57",
      "duration": {
      "min": "15",
      "max": ""
      },
      "unit": "times",
      "is_completed": "0",
      "created_at": "2016-01-22 04:32:49",
      "updated_at": "2016-04-04 12:10:48",
      "exercise": {
      "id": "57",
      "name": "Knee Raises",
      "description": "Develop grip and core strength and get used to slow and controlled moves",
      "category": "1",
      "type": "2",
      "muscle_groups": "4,6,7",
      "rewards": "6.00",
      "repititions": "10",
      "duration": "10",
      "unit": "times",
      "equipment": "",
      "range_of_motion": "1. Start from a deadhang position with your arms and legs fully extended, and feet off the ground.  \r\n2. Raise your knees up towards your chest as high as possible. \r\n3. Hold for a brief moment and slowly return to the starting position. \r\n4. Repeat for required repetitions. ",
      "video_tips": "    ",
      "pro_tips": "Avoid using momentum or swinging during the exercise. \r\nPerform the knee raise slowly and controlled.",
      "is_static": "0",
      "musclegroup_string": "Back, Core, Legs",
      "video": [
      {
      "id": "67",
      "path": "57_1454044213.mp4",
      "videothumbnail": "57_1454044213.jpg",
      "description": "Knee Raises"
      }
      ]
      }
      },
      {
      "id": "10",
      "row": "2",
      "exercise_id": "42",
      "duration": {
      "min": "20",
      "max": ""
      },
      "unit": "times",
      "is_completed": "0",
      "created_at": "2016-01-22 04:33:42",
      "updated_at": "2016-04-04 11:22:09",
      "exercise": {
      "id": "42",
      "name": "Single Leg Deadlift",
      "description": "Get your hips mobile and control your balance",
      "category": "1",
      "type": "2",
      "muscle_groups": "7",
      "rewards": "6.00",
      "repititions": "10",
      "duration": "10",
      "unit": "times",
      "equipment": "",
      "range_of_motion": "1. Start from a standing position\r\n2. Keeping that knee slightly bent, perform a stiff-legged deadlift by bending at the hip.\r\n3. Continue lowering yourself until your upper body is parallel to the ground, and then return to the upright position. \r\n4. Repeat for the desired number of repetitions.",
      "video_tips": "    ",
      "pro_tips": "Avoid bending your supporting leg.\r\nKeep your non-supporting leg extended behind you for balance.",
      "is_static": "0",
      "musclegroup_string": "Legs",
      "video": [
      {
      "id": "38",
      "path": "42_1454042789.mp4",
      "videothumbnail": "42_1454042789.jpg",
      "description": "Single Leg Deadlift"
      }
      ]
      }
      }
      ],
      "exercises": [],
      "workout": {
      "id": "2",
      "name": "Borr",
      "description": "A,C,E,B",
      "rounds": "3",
      "category": "2",
      "type": "2",
      "rewards": "330",
      "duration": "1140.00",
      "equipments": "Bar/Rings",
      "is_completed": 0,
      "exercises": {
      "round1": [
      {
      "id": "16",
      "workout_id": "2",
      "category": "1",
      "repititions": "25",
      "exercise_id": "32",
      "unit": "times",
      "round": "1",
      "created_at": "2016-01-19 03:29:53",
      "updated_at": "2016-04-04 11:06:44",
      "exercise": {
      "id": "32",
      "name": "Sprawl",
      "description": "Boost your cardio and strength with sprawls",
      "category": "1",
      "type": "1",
      "muscle_groups": "8",
      "rewards": "6.00",
      "repititions": "10",
      "duration": "10",
      "unit": "times",
      "equipment": "",
      "range_of_motion": "1. Start in a standing position\r\n2. Go into a straight arm plank position\r\n3. Go back up and jump with your hands above your head",
      "video_tips": "    ",
      "pro_tips": "Avoid a hollow back during the movement. \r\nKeep the core and lower back engaged at all times.",
      "is_static": "0",
      "musclegroup_string": "Full Body"
      },
      "is_completed": 0
      },
      {
      "id": "19",
      "workout_id": "2",
      "category": "1",
      "repititions": "10",
      "exercise_id": "66",
      "unit": "times",
      "round": "1",
      "created_at": "2016-01-19 03:30:29",
      "updated_at": "2016-04-04 14:31:38",
      "exercise": {
      "id": "69",
      "name": "Jumping Pullups",
      "description": "Expose yourself to packed shoulders and hang time",
      "category": "1",
      "type": "1",
      "muscle_groups": "1,5",
      "rewards": "6.00",
      "repititions": "10",
      "duration": "10",
      "unit": "times",
      "equipment": "",
      "range_of_motion": " 1. Grip a bar and jump into the top position of the pull-up exercise\r\n2. Straight legs in front of you. \r\n3. Slowly go down into a deadhang position ",
      "video_tips": "        ",
      "pro_tips": " A deadhang postion requires your shoulder blades down and towards the spine with arms being straight (retraction)\r\nAim for three second holds at the top and go down slowly ",
      "is_static": "0",
      "musclegroup_string": "Shoulders, Arms"
      },
      "is_completed": 0
      },
      {
      "id": "22",
      "workout_id": "2",
      "category": "1",
      "repititions": "40",
      "exercise_id": "9",
      "unit": "times",
      "round": "1",
      "created_at": "2016-01-19 03:30:59",
      "updated_at": "2016-04-04 09:22:17",
      "exercise": {
      "id": "9",
      "name": "Crunches",
      "description": "Do the most admired sixpack exercise in the world",
      "category": "1",
      "type": "1",
      "muscle_groups": "6",
      "rewards": "6.00",
      "repititions": "10",
      "duration": "10",
      "unit": "times",
      "equipment": "",
      "range_of_motion": "1. Starting position is with lying face up on the floor with knees bent. \r\n2. Move torso up and touch your knees with your hands\r\n3. Lower body to the floor and repeat\r\n  ",
      "video_tips": "    ",
      "pro_tips": "Do variations in tempo. Aim for one count up and three counts down.\r\nIf you have a tendency to interlace your fingers and yank your head, place your hands cross-chest.",
      "is_static": "0",
      "musclegroup_string": "Core"
      },
      "is_completed": 0
      },
      {
      "id": "25",
      "workout_id": "2",
      "category": "1",
      "repititions": "30",
      "exercise_id": "49",
      "unit": "times",
      "round": "1",
      "created_at": "2016-01-19 03:31:40",
      "updated_at": "2016-04-04 14:19:29",
      "exercise": {
      "id": "49",
      "name": "Side Triceps",
      "description": "Start with the basics of building triceps strength",
      "category": "1",
      "type": "1",
      "muscle_groups": "3",
      "rewards": "6.00",
      "repititions": "10",
      "duration": "10",
      "unit": "times",
      "equipment": "",
      "range_of_motion": " 1. Start with the body on your side\r\n2. Put one hand on your shoulder \r\n3. Press up with the other arm and hold in extension ",
      "video_tips": "          ",
      "pro_tips": " Avoid supporting the movement with your core muscle.      ",
      "is_static": "0",
      "musclegroup_string": "Triceps"
      },
      "is_completed": 0
      }
      ],
      "round2": [
      {
      "id": "17",
      "workout_id": "2",
      "category": "1",
      "repititions": "25",
      "exercise_id": "32",
      "unit": "times",
      "round": "2",
      "created_at": "2016-01-19 03:29:53",
      "updated_at": "2016-04-04 11:06:44",
      "exercise": {
      "id": "32",
      "name": "Sprawl",
      "description": "Boost your cardio and strength with sprawls",
      "category": "1",
      "type": "1",
      "muscle_groups": "8",
      "rewards": "6.00",
      "repititions": "10",
      "duration": "10",
      "unit": "times",
      "equipment": "",
      "range_of_motion": "1. Start in a standing position\r\n2. Go into a straight arm plank position\r\n3. Go back up and jump with your hands above your head",
      "video_tips": "    ",
      "pro_tips": "Avoid a hollow back during the movement. \r\nKeep the core and lower back engaged at all times.",
      "is_static": "0",
      "musclegroup_string": "Full Body"
      },
      "is_completed": 0
      },
      {
      "id": "20",
      "workout_id": "2",
      "category": "1",
      "repititions": "10",
      "exercise_id": "66",
      "unit": "times",
      "round": "2",
      "created_at": "2016-01-19 03:30:30",
      "updated_at": "2016-04-04 14:31:38",
      "exercise": {
      "id": "69",
      "name": "Jumping Pullups",
      "description": "Expose yourself to packed shoulders and hang time",
      "category": "1",
      "type": "1",
      "muscle_groups": "1,5",
      "rewards": "6.00",
      "repititions": "10",
      "duration": "10",
      "unit": "times",
      "equipment": "",
      "range_of_motion": " 1. Grip a bar and jump into the top position of the pull-up exercise\r\n2. Straight legs in front of you. \r\n3. Slowly go down into a deadhang position ",
      "video_tips": "        ",
      "pro_tips": " A deadhang postion requires your shoulder blades down and towards the spine with arms being straight (retraction)\r\nAim for three second holds at the top and go down slowly ",
      "is_static": "0",
      "musclegroup_string": "Shoulders, Arms"
      },
      "is_completed": 0
      },
      {
      "id": "23",
      "workout_id": "2",
      "category": "1",
      "repititions": "40",
      "exercise_id": "9",
      "unit": "times",
      "round": "2",
      "created_at": "2016-01-19 03:30:59",
      "updated_at": "2016-04-04 09:22:17",
      "exercise": {
      "id": "9",
      "name": "Crunches",
      "description": "Do the most admired sixpack exercise in the world",
      "category": "1",
      "type": "1",
      "muscle_groups": "6",
      "rewards": "6.00",
      "repititions": "10",
      "duration": "10",
      "unit": "times",
      "equipment": "",
      "range_of_motion": "1. Starting position is with lying face up on the floor with knees bent. \r\n2. Move torso up and touch your knees with your hands\r\n3. Lower body to the floor and repeat\r\n  ",
      "video_tips": "    ",
      "pro_tips": "Do variations in tempo. Aim for one count up and three counts down.\r\nIf you have a tendency to interlace your fingers and yank your head, place your hands cross-chest.",
      "is_static": "0",
      "musclegroup_string": "Core"
      },
      "is_completed": 0
      },
      {
      "id": "26",
      "workout_id": "2",
      "category": "1",
      "repititions": "30",
      "exercise_id": "49",
      "unit": "times",
      "round": "2",
      "created_at": "2016-01-19 03:31:41",
      "updated_at": "2016-04-04 14:19:29",
      "exercise": {
      "id": "49",
      "name": "Side Triceps",
      "description": "Start with the basics of building triceps strength",
      "category": "1",
      "type": "1",
      "muscle_groups": "3",
      "rewards": "6.00",
      "repititions": "10",
      "duration": "10",
      "unit": "times",
      "equipment": "",
      "range_of_motion": " 1. Start with the body on your side\r\n2. Put one hand on your shoulder \r\n3. Press up with the other arm and hold in extension ",
      "video_tips": "          ",
      "pro_tips": " Avoid supporting the movement with your core muscle.      ",
      "is_static": "0",
      "musclegroup_string": "Triceps"
      },
      "is_completed": 0
      }
      ],
      "round3": [
      {
      "id": "18",
      "workout_id": "2",
      "category": "1",
      "repititions": "25",
      "exercise_id": "32",
      "unit": "times",
      "round": "3",
      "created_at": "2016-01-19 03:29:53",
      "updated_at": "2016-04-04 11:06:44",
      "exercise": {
      "id": "32",
      "name": "Sprawl",
      "description": "Boost your cardio and strength with sprawls",
      "category": "1",
      "type": "1",
      "muscle_groups": "8",
      "rewards": "6.00",
      "repititions": "10",
      "duration": "10",
      "unit": "times",
      "equipment": "",
      "range_of_motion": "1. Start in a standing position\r\n2. Go into a straight arm plank position\r\n3. Go back up and jump with your hands above your head",
      "video_tips": "    ",
      "pro_tips": "Avoid a hollow back during the movement. \r\nKeep the core and lower back engaged at all times.",
      "is_static": "0",
      "musclegroup_string": "Full Body"
      },
      "is_completed": 0
      },
      {
      "id": "21",
      "workout_id": "2",
      "category": "1",
      "repititions": "10",
      "exercise_id": "66",
      "unit": "times",
      "round": "3",
      "created_at": "2016-01-19 03:30:30",
      "updated_at": "2016-04-04 14:31:38",
      "exercise": {
      "id": "69",
      "name": "Jumping Pullups",
      "description": "Expose yourself to packed shoulders and hang time",
      "category": "1",
      "type": "1",
      "muscle_groups": "1,5",
      "rewards": "6.00",
      "repititions": "10",
      "duration": "10",
      "unit": "times",
      "equipment": "",
      "range_of_motion": " 1. Grip a bar and jump into the top position of the pull-up exercise\r\n2. Straight legs in front of you. \r\n3. Slowly go down into a deadhang position ",
      "video_tips": "        ",
      "pro_tips": " A deadhang postion requires your shoulder blades down and towards the spine with arms being straight (retraction)\r\nAim for three second holds at the top and go down slowly ",
      "is_static": "0",
      "musclegroup_string": "Shoulders, Arms"
      },
      "is_completed": 0
      },
      {
      "id": "24",
      "workout_id": "2",
      "category": "1",
      "repititions": "40",
      "exercise_id": "9",
      "unit": "times",
      "round": "3",
      "created_at": "2016-01-19 03:30:59",
      "updated_at": "2016-04-04 09:22:17",
      "exercise": {
      "id": "9",
      "name": "Crunches",
      "description": "Do the most admired sixpack exercise in the world",
      "category": "1",
      "type": "1",
      "muscle_groups": "6",
      "rewards": "6.00",
      "repititions": "10",
      "duration": "10",
      "unit": "times",
      "equipment": "",
      "range_of_motion": "1. Starting position is with lying face up on the floor with knees bent. \r\n2. Move torso up and touch your knees with your hands\r\n3. Lower body to the floor and repeat\r\n  ",
      "video_tips": "    ",
      "pro_tips": "Do variations in tempo. Aim for one count up and three counts down.\r\nIf you have a tendency to interlace your fingers and yank your head, place your hands cross-chest.",
      "is_static": "0",
      "musclegroup_string": "Core"
      },
      "is_completed": 0
      },
      {
      "id": "27",
      "workout_id": "2",
      "category": "1",
      "repititions": "30",
      "exercise_id": "49",
      "unit": "times",
      "round": "3",
      "created_at": "2016-01-19 03:31:41",
      "updated_at": "2016-04-04 14:19:29",
      "exercise": {
      "id": "49",
      "name": "Side Triceps",
      "description": "Start with the basics of building triceps strength",
      "category": "1",
      "type": "1",
      "muscle_groups": "3",
      "rewards": "6.00",
      "repititions": "10",
      "duration": "10",
      "unit": "times",
      "equipment": "",
      "range_of_motion": " 1. Start with the body on your side\r\n2. Put one hand on your shoulder \r\n3. Press up with the other arm and hold in extension ",
      "video_tips": "          ",
      "pro_tips": " Avoid supporting the movement with your core muscle.      ",
      "is_static": "0",
      "musclegroup_string": "Triceps"
      },
      "is_completed": 0
      }
      ]
      },
      "exercise_category": 1
      },
      "coach_workout_rounds": 3,
      "workout_intensity": 1,
      "hiit": [],
      "stretching": [
      {
      "id": "1",
      "exercise_id": "Superman",
      "duration": {
      "min": 6,
      "max": 13
      },
      "unit": "times",
      "is_completed": "0",
      "created_at": "2016-01-22 07:10:31",
      "updated_at": "2016-01-22 07:10:31"
      },
      {
      "id": "2",
      "exercise_id": "Lower Back Strength",
      "duration": {
      "min": 38,
      "max": 63
      },
      "unit": "times",
      "is_completed": "0",
      "created_at": "2016-01-22 07:15:02",
      "updated_at": "2016-01-22 07:15:02"
      },
      {
      "id": "3",
      "exercise_id": "Upper Dog",
      "duration": {
      "min": 38,
      "max": 75
      },
      "unit": "seconds",
      "is_completed": "0",
      "created_at": "2016-01-22 07:16:03",
      "updated_at": "2016-01-22 07:16:03"
      },
      {
      "id": "4",
      "exercise_id": "Child's Pose",
      "duration": {
      "min": 38,
      "max": 75
      },
      "unit": "seconds",
      "is_completed": "0",
      "created_at": "2016-01-22 07:16:46",
      "updated_at": "2016-01-22 07:16:46"
      },
      {
      "id": "5",
      "exercise_id": "L-sit on the floor",
      "duration": {
      "min": 38,
      "max": 75
      },
      "unit": "seconds",
      "is_completed": "0",
      "created_at": "2016-01-22 07:17:13",
      "updated_at": "2016-01-22 07:17:13"
      },
      {
      "id": "6",
      "exercise_id": "Good morning",
      "duration": {
      "min": 38,
      "max": 75
      },
      "unit": "seconds",
      "is_completed": "0",
      "created_at": "2016-01-22 07:17:43",
      "updated_at": "2016-01-22 07:17:43"
      },
      {
      "id": "7",
      "exercise_id": "Chest Opener",
      "duration": {
      "min": 38,
      "max": 75
      },
      "unit": "seconds",
      "is_completed": "0",
      "created_at": "2016-01-22 07:19:32",
      "updated_at": "2016-01-22 07:19:32"
      },
      {
      "id": "8",
      "exercise_id": "Triceps Stretc",
      "duration": {
      "min": 38,
      "max": 75
      },
      "unit": "seconds",
      "is_completed": "0",
      "created_at": "2016-01-22 07:19:56",
      "updated_at": "2016-01-22 07:19:56"
      },
      {
      "id": "9",
      "exercise_id": "Hands Back",
      "duration": {
      "min": 38,
      "max": 75
      },
      "unit": "seconds",
      "is_completed": "0",
      "created_at": "2016-01-22 07:20:19",
      "updated_at": "2016-01-22 07:20:19"
      },
      {
      "id": "10",
      "exercise_id": "Shoulder Stretch",
      "duration": {
      "min": 38,
      "max": 75
      },
      "unit": "seconds",
      "is_completed": "0",
      "created_at": "2016-01-22 07:20:45",
      "updated_at": "2016-01-22 07:20:45"
      }
      ],
      "status": "pending"
      },
      "day3": {
      "warmup": [
      {
      "id": "1",
      "name": "wall extensions",
      "duration": {
      "min": "10",
      "max": "20"
      },
      "unit": "times",
      "created_at": "2016-01-21 08:55:06",
      "updated_at": "2016-01-21 08:55:06",
      "is_completed": 0
      },
      {
      "id": "2",
      "name": "band dislocates",
      "duration": {
      "min": "10",
      "max": "20"
      },
      "unit": "times",
      "created_at": "2016-01-21 08:57:38",
      "updated_at": "2016-01-21 08:57:38",
      "is_completed": 0
      },
      {
      "id": "3",
      "name": "cat-camels",
      "duration": {
      "min": "10",
      "max": "20"
      },
      "unit": "times",
      "created_at": "2016-01-21 09:00:39",
      "updated_at": "2016-01-21 09:00:39",
      "is_completed": 0
      },
      {
      "id": "4",
      "name": "scapular shrugs",
      "duration": {
      "min": "10",
      "max": "20"
      },
      "unit": "times",
      "created_at": "2016-01-21 09:01:01",
      "updated_at": "2016-01-21 09:01:01",
      "is_completed": 0
      },
      {
      "id": "5",
      "name": "full body circles",
      "duration": {
      "min": "10",
      "max": "20"
      },
      "unit": "times",
      "created_at": "2016-01-21 09:01:26",
      "updated_at": "2016-01-21 09:01:26",
      "is_completed": 0
      },
      {
      "id": "6",
      "name": "Jumping Jacks",
      "duration": {
      "min": "100",
      "max": ""
      },
      "unit": "seconds",
      "created_at": "2016-01-21 09:04:52",
      "updated_at": "2016-01-21 09:04:52",
      "is_completed": 0
      },
      {
      "id": "7",
      "name": "Arm rotations",
      "duration": {
      "min": "120",
      "max": ""
      },
      "unit": "times",
      "created_at": "2016-01-21 09:05:29",
      "updated_at": "2016-01-21 09:05:29",
      "is_completed": 0
      },
      {
      "id": "8",
      "name": "High Knees",
      "duration": {
      "min": "50",
      "max": ""
      },
      "unit": "times",
      "created_at": "2016-01-21 09:06:02",
      "updated_at": "2016-01-21 09:06:02",
      "is_completed": 0
      },
      {
      "id": "9",
      "name": "Shouder rolls",
      "duration": {
      "min": "20",
      "max": ""
      },
      "unit": "times",
      "created_at": "2016-01-21 09:06:34",
      "updated_at": "2016-01-21 09:06:34",
      "is_completed": 0
      }
      ],
      "is_completed": 0,
      "fundumentals": [
      {
      "id": "11",
      "row": "3",
      "exercise_id": "64",
      "duration": {
      "min": "10",
      "max": ""
      },
      "unit": "times",
      "is_completed": "0",
      "created_at": "2016-01-22 04:35:13",
      "updated_at": "2016-04-04 14:27:54",
      "exercise": {
      "id": "64",
      "name": "Skin the cat",
      "description": "Develop your joints mobility and expose yourself to new movement layers",
      "category": "1",
      "type": "2",
      "muscle_groups": "4,5,6",
      "rewards": "6.00",
      "repititions": "10",
      "duration": "10",
      "unit": "times",
      "equipment": "",
      "range_of_motion": " 1. Hands a little more than shoulder width apart\r\n2. Raise your knees to the chest\r\n3. continuing the movement until the feet pass up through the arms and over head into an inverted hang position.\r\n4. Continue to pass the feet round and down toward the ground into the extended 'skin the cat' position.\r\n5. Lift your hips and raise the legs back and over to the starting hang position. ",
      "video_tips": "        ",
      "pro_tips": " Put your hands closer together to ease up all back lever progressions.\r\nDo only half of the movement in the beginning, but fight for completion over time.\r\nIncorporate other static elements to challenge yourself during the movement as you master other skills.\r\n    ",
      "is_static": "0",
      "musclegroup_string": "Back, Arms, Core",
      "video": [
      {
      "id": "71",
      "path": "64_1454045043.mp4",
      "videothumbnail": "64_1454045043.jpg",
      "description": "Skin the cat"
      }
      ]
      }
      },
      {
      "id": "12",
      "row": "3",
      "exercise_id": "12",
      "duration": {
      "min": "20",
      "max": ""
      },
      "unit": "times",
      "is_completed": "0",
      "created_at": "2016-01-22 04:36:16",
      "updated_at": "2016-04-04 09:26:06",
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
      "is_static": "0",
      "musclegroup_string": "Shoulders, Chest, Triceps",
      "video": [
      {
      "id": "57",
      "path": "12_1453984139.mp4",
      "videothumbnail": "12_1453984139.jpg",
      "description": "Pushups"
      }
      ]
      }
      },
      {
      "id": "13",
      "row": "3",
      "exercise_id": "49",
      "duration": {
      "min": "30",
      "max": ""
      },
      "unit": "times",
      "is_completed": "0",
      "created_at": "2016-01-22 04:36:49",
      "updated_at": "2016-04-04 14:19:29",
      "exercise": {
      "id": "49",
      "name": "Side Triceps",
      "description": "Start with the basics of building triceps strength",
      "category": "1",
      "type": "1",
      "muscle_groups": "3",
      "rewards": "6.00",
      "repititions": "10",
      "duration": "10",
      "unit": "times",
      "equipment": "",
      "range_of_motion": " 1. Start with the body on your side\r\n2. Put one hand on your shoulder \r\n3. Press up with the other arm and hold in extension ",
      "video_tips": "          ",
      "pro_tips": " Avoid supporting the movement with your core muscle.      ",
      "is_static": "0",
      "musclegroup_string": "Triceps",
      "video": [
      {
      "id": "43",
      "path": "49_1454043404.mp4",
      "videothumbnail": "49_1454043404.jpg",
      "description": "Side Triceps"
      }
      ]
      }
      },
      {
      "id": "14",
      "row": "3",
      "exercise_id": "4",
      "duration": {
      "min": "60",
      "max": "90"
      },
      "unit": "seconds",
      "is_completed": "0",
      "created_at": "2016-01-22 04:37:32",
      "updated_at": "2016-04-04 14:02:11",
      "exercise": {
      "id": "4",
      "name": "Plank",
      "description": "The plank builds your isometric strength and helps sculpt your waistline.",
      "category": "1",
      "type": "1",
      "muscle_groups": "1,4,6,8",
      "rewards": "6.00",
      "repititions": "10",
      "duration": "10",
      "unit": "seconds",
      "equipment": "",
      "range_of_motion": "1. Get into pushup position on the floor.\r\n2. Now bend your elbows 90 degrees and rest your weight on your forearms. \r\n3. Hold the position for as long as you can.   ",
      "video_tips": "        ",
      "pro_tips": "Drive your chest away from the ground and spread your shoulder blades as much as you can.\r\nKeep a straight line, from head to toe. \r\nDon't collapse your lower back or reach your butt to the sky. Add movement to your plank, rock back and forth on your forearms and toes or shift from side to side.\r\nTry advanced variations with alternating sinlge leg support. \r\nStart with an incline plank if a straight plank is too hard in the beginning.  ",
      "is_static": "0",
      "musclegroup_string": "Shoulders, Back, Core, Full Body",
      "video": [
      {
      "id": "4",
      "path": "4_1453976855.mp4",
      "videothumbnail": "4_1453976855.jpg",
      "description": "Plank"
      }
      ]
      }
      },
      {
      "id": "15",
      "row": "3",
      "exercise_id": "36",
      "duration": {
      "min": "20",
      "max": ""
      },
      "unit": "times",
      "is_completed": "0",
      "created_at": "2016-01-22 04:37:57",
      "updated_at": "2016-04-04 11:12:49",
      "exercise": {
      "id": "36",
      "name": "High Jumps",
      "description": "Do high jumps as a part of restless HIIT workouts",
      "category": "1",
      "type": "2",
      "muscle_groups": "7",
      "rewards": "6.00",
      "repititions": "10",
      "duration": "10",
      "unit": "times",
      "equipment": "",
      "range_of_motion": "1. Start from a standing position\r\n2. Jump up and bring your knees to your chest",
      "video_tips": "    ",
      "pro_tips": "Land softly and exhale when the knees are up.\r\n  ",
      "is_static": "0",
      "musclegroup_string": "Legs",
      "video": [
      {
      "id": "33",
      "path": "36_1454042273.mp4",
      "videothumbnail": "36_1454042273.jpg",
      "description": "High Jumps"
      }
      ]
      }
      }
      ],
      "exercises": [],
      "workout": {
      "id": "9",
      "name": "Elli",
      "description": "C,A,D",
      "rounds": "3",
      "category": "2",
      "type": "1",
      "rewards": "330",
      "duration": "420.00",
      "equipments": "Bar/Rings",
      "is_completed": 0,
      "exercises": {
      "round1": [
      {
      "id": "325",
      "workout_id": "9",
      "category": "1",
      "repititions": "20",
      "exercise_id": "39",
      "unit": "times",
      "round": "1",
      "created_at": "2016-01-19 05:28:43",
      "updated_at": "2016-04-04 11:16:09",
      "exercise": {
      "id": "39",
      "name": "Climbers",
      "description": "Increase your energy, health and endurance",
      "category": "1",
      "type": "2",
      "muscle_groups": "7",
      "rewards": "6.00",
      "repititions": "10",
      "duration": "10",
      "unit": "times",
      "equipment": "",
      "range_of_motion": "1. Start in pushup position\r\n2. Alternate your legs up to hand level\r\n3. Repeat",
      "video_tips": "    ",
      "pro_tips": "If you are new to mountain climbers perform the knee to chest motion slow and steadily then build it up to a faster pace for a better cardio effect.    ",
      "is_static": "0",
      "musclegroup_string": "Legs"
      },
      "is_completed": 0
      },
      {
      "id": "328",
      "workout_id": "9",
      "category": "1",
      "repititions": "15",
      "exercise_id": "66",
      "unit": "times",
      "round": "1",
      "created_at": "2016-01-19 05:29:04",
      "updated_at": "2016-04-04 14:31:38",
      "exercise": {
      "id": "69",
      "name": "Jumping Pullups",
      "description": "Expose yourself to packed shoulders and hang time",
      "category": "1",
      "type": "1",
      "muscle_groups": "1,5",
      "rewards": "6.00",
      "repititions": "10",
      "duration": "10",
      "unit": "times",
      "equipment": "",
      "range_of_motion": " 1. Grip a bar and jump into the top position of the pull-up exercise\r\n2. Straight legs in front of you. \r\n3. Slowly go down into a deadhang position ",
      "video_tips": "        ",
      "pro_tips": " A deadhang postion requires your shoulder blades down and towards the spine with arms being straight (retraction)\r\nAim for three second holds at the top and go down slowly ",
      "is_static": "0",
      "musclegroup_string": "Shoulders, Arms"
      },
      "is_completed": 0
      },
      {
      "id": "331",
      "workout_id": "9",
      "category": "1",
      "repititions": "15",
      "exercise_id": "22",
      "unit": "times",
      "round": "1",
      "created_at": "2016-01-19 05:29:28",
      "updated_at": "2016-04-04 14:09:31",
      "exercise": {
      "id": "22",
      "name": "Spiderman Pushups",
      "description": "Learn to control your body and create body awareness",
      "category": "1",
      "type": "2",
      "muscle_groups": "2,3,5,6",
      "rewards": "6.00",
      "repititions": "10",
      "duration": "10",
      "unit": "times",
      "equipment": "",
      "range_of_motion": "  1. Start in a standard pushup position.\r\n 2. Next, lower yourself downward until your chest almost touches the floor as you inhale.\r\n 3. Bring your knees to your elbows as you go down and alternate with next repition. ",
      "video_tips": "      ",
      "pro_tips": " Pretend you are balancing something on your tailbone as you do the Spiderman pushup to maintain the correct plank position. This keeps your hips from rotating. ",
      "is_static": "0",
      "musclegroup_string": "Chest, Triceps, Arms, Core"
      },
      "is_completed": 0
      },
      {
      "id": "337",
      "workout_id": "9",
      "category": "1",
      "repititions": "25",
      "exercise_id": "57",
      "unit": "times",
      "round": "1",
      "created_at": "2016-01-19 05:30:04",
      "updated_at": "2016-04-04 12:10:48",
      "exercise": {
      "id": "57",
      "name": "Knee Raises",
      "description": "Develop grip and core strength and get used to slow and controlled moves",
      "category": "1",
      "type": "2",
      "muscle_groups": "4,6,7",
      "rewards": "6.00",
      "repititions": "10",
      "duration": "10",
      "unit": "times",
      "equipment": "",
      "range_of_motion": "1. Start from a deadhang position with your arms and legs fully extended, and feet off the ground.  \r\n2. Raise your knees up towards your chest as high as possible. \r\n3. Hold for a brief moment and slowly return to the starting position. \r\n4. Repeat for required repetitions. ",
      "video_tips": "    ",
      "pro_tips": "Avoid using momentum or swinging during the exercise. \r\nPerform the knee raise slowly and controlled.",
      "is_static": "0",
      "musclegroup_string": "Back, Core, Legs"
      },
      "is_completed": 0
      }
      ],
      "round2": [
      {
      "id": "326",
      "workout_id": "9",
      "category": "1",
      "repititions": "20",
      "exercise_id": "39",
      "unit": "times",
      "round": "2",
      "created_at": "2016-01-19 05:28:43",
      "updated_at": "2016-04-04 11:16:09",
      "exercise": {
      "id": "39",
      "name": "Climbers",
      "description": "Increase your energy, health and endurance",
      "category": "1",
      "type": "2",
      "muscle_groups": "7",
      "rewards": "6.00",
      "repititions": "10",
      "duration": "10",
      "unit": "times",
      "equipment": "",
      "range_of_motion": "1. Start in pushup position\r\n2. Alternate your legs up to hand level\r\n3. Repeat",
      "video_tips": "    ",
      "pro_tips": "If you are new to mountain climbers perform the knee to chest motion slow and steadily then build it up to a faster pace for a better cardio effect.    ",
      "is_static": "0",
      "musclegroup_string": "Legs"
      },
      "is_completed": 0
      },
      {
      "id": "329",
      "workout_id": "9",
      "category": "1",
      "repititions": "15",
      "exercise_id": "66",
      "unit": "times",
      "round": "2",
      "created_at": "2016-01-19 05:29:05",
      "updated_at": "2016-04-04 14:31:38",
      "exercise": {
      "id": "69",
      "name": "Jumping Pullups",
      "description": "Expose yourself to packed shoulders and hang time",
      "category": "1",
      "type": "1",
      "muscle_groups": "1,5",
      "rewards": "6.00",
      "repititions": "10",
      "duration": "10",
      "unit": "times",
      "equipment": "",
      "range_of_motion": " 1. Grip a bar and jump into the top position of the pull-up exercise\r\n2. Straight legs in front of you. \r\n3. Slowly go down into a deadhang position ",
      "video_tips": "        ",
      "pro_tips": " A deadhang postion requires your shoulder blades down and towards the spine with arms being straight (retraction)\r\nAim for three second holds at the top and go down slowly ",
      "is_static": "0",
      "musclegroup_string": "Shoulders, Arms"
      },
      "is_completed": 0
      },
      {
      "id": "332",
      "workout_id": "9",
      "category": "1",
      "repititions": "15",
      "exercise_id": "22",
      "unit": "times",
      "round": "2",
      "created_at": "2016-01-19 05:29:28",
      "updated_at": "2016-04-04 14:09:31",
      "exercise": {
      "id": "22",
      "name": "Spiderman Pushups",
      "description": "Learn to control your body and create body awareness",
      "category": "1",
      "type": "2",
      "muscle_groups": "2,3,5,6",
      "rewards": "6.00",
      "repititions": "10",
      "duration": "10",
      "unit": "times",
      "equipment": "",
      "range_of_motion": "  1. Start in a standard pushup position.\r\n 2. Next, lower yourself downward until your chest almost touches the floor as you inhale.\r\n 3. Bring your knees to your elbows as you go down and alternate with next repition. ",
      "video_tips": "      ",
      "pro_tips": " Pretend you are balancing something on your tailbone as you do the Spiderman pushup to maintain the correct plank position. This keeps your hips from rotating. ",
      "is_static": "0",
      "musclegroup_string": "Chest, Triceps, Arms, Core"
      },
      "is_completed": 0
      },
      {
      "id": "338",
      "workout_id": "9",
      "category": "1",
      "repititions": "25",
      "exercise_id": "57",
      "unit": "times",
      "round": "2",
      "created_at": "2016-01-19 05:30:04",
      "updated_at": "2016-04-04 12:10:48",
      "exercise": {
      "id": "57",
      "name": "Knee Raises",
      "description": "Develop grip and core strength and get used to slow and controlled moves",
      "category": "1",
      "type": "2",
      "muscle_groups": "4,6,7",
      "rewards": "6.00",
      "repititions": "10",
      "duration": "10",
      "unit": "times",
      "equipment": "",
      "range_of_motion": "1. Start from a deadhang position with your arms and legs fully extended, and feet off the ground.  \r\n2. Raise your knees up towards your chest as high as possible. \r\n3. Hold for a brief moment and slowly return to the starting position. \r\n4. Repeat for required repetitions. ",
      "video_tips": "    ",
      "pro_tips": "Avoid using momentum or swinging during the exercise. \r\nPerform the knee raise slowly and controlled.",
      "is_static": "0",
      "musclegroup_string": "Back, Core, Legs"
      },
      "is_completed": 0
      }
      ],
      "round3": [
      {
      "id": "327",
      "workout_id": "9",
      "category": "1",
      "repititions": "20",
      "exercise_id": "39",
      "unit": "times",
      "round": "3",
      "created_at": "2016-01-19 05:28:43",
      "updated_at": "2016-04-04 11:16:09",
      "exercise": {
      "id": "39",
      "name": "Climbers",
      "description": "Increase your energy, health and endurance",
      "category": "1",
      "type": "2",
      "muscle_groups": "7",
      "rewards": "6.00",
      "repititions": "10",
      "duration": "10",
      "unit": "times",
      "equipment": "",
      "range_of_motion": "1. Start in pushup position\r\n2. Alternate your legs up to hand level\r\n3. Repeat",
      "video_tips": "    ",
      "pro_tips": "If you are new to mountain climbers perform the knee to chest motion slow and steadily then build it up to a faster pace for a better cardio effect.    ",
      "is_static": "0",
      "musclegroup_string": "Legs"
      },
      "is_completed": 0
      },
      {
      "id": "330",
      "workout_id": "9",
      "category": "1",
      "repititions": "15",
      "exercise_id": "66",
      "unit": "times",
      "round": "3",
      "created_at": "2016-01-19 05:29:05",
      "updated_at": "2016-04-04 14:31:38",
      "exercise": {
      "id": "69",
      "name": "Jumping Pullups",
      "description": "Expose yourself to packed shoulders and hang time",
      "category": "1",
      "type": "1",
      "muscle_groups": "1,5",
      "rewards": "6.00",
      "repititions": "10",
      "duration": "10",
      "unit": "times",
      "equipment": "",
      "range_of_motion": " 1. Grip a bar and jump into the top position of the pull-up exercise\r\n2. Straight legs in front of you. \r\n3. Slowly go down into a deadhang position ",
      "video_tips": "        ",
      "pro_tips": " A deadhang postion requires your shoulder blades down and towards the spine with arms being straight (retraction)\r\nAim for three second holds at the top and go down slowly ",
      "is_static": "0",
      "musclegroup_string": "Shoulders, Arms"
      },
      "is_completed": 0
      },
      {
      "id": "333",
      "workout_id": "9",
      "category": "1",
      "repititions": "15",
      "exercise_id": "22",
      "unit": "times",
      "round": "3",
      "created_at": "2016-01-19 05:29:28",
      "updated_at": "2016-04-04 14:09:31",
      "exercise": {
      "id": "22",
      "name": "Spiderman Pushups",
      "description": "Learn to control your body and create body awareness",
      "category": "1",
      "type": "2",
      "muscle_groups": "2,3,5,6",
      "rewards": "6.00",
      "repititions": "10",
      "duration": "10",
      "unit": "times",
      "equipment": "",
      "range_of_motion": "  1. Start in a standard pushup position.\r\n 2. Next, lower yourself downward until your chest almost touches the floor as you inhale.\r\n 3. Bring your knees to your elbows as you go down and alternate with next repition. ",
      "video_tips": "      ",
      "pro_tips": " Pretend you are balancing something on your tailbone as you do the Spiderman pushup to maintain the correct plank position. This keeps your hips from rotating. ",
      "is_static": "0",
      "musclegroup_string": "Chest, Triceps, Arms, Core"
      },
      "is_completed": 0
      },
      {
      "id": "339",
      "workout_id": "9",
      "category": "1",
      "repititions": "25",
      "exercise_id": "57",
      "unit": "times",
      "round": "3",
      "created_at": "2016-01-19 05:30:04",
      "updated_at": "2016-04-04 12:10:48",
      "exercise": {
      "id": "57",
      "name": "Knee Raises",
      "description": "Develop grip and core strength and get used to slow and controlled moves",
      "category": "1",
      "type": "2",
      "muscle_groups": "4,6,7",
      "rewards": "6.00",
      "repititions": "10",
      "duration": "10",
      "unit": "times",
      "equipment": "",
      "range_of_motion": "1. Start from a deadhang position with your arms and legs fully extended, and feet off the ground.  \r\n2. Raise your knees up towards your chest as high as possible. \r\n3. Hold for a brief moment and slowly return to the starting position. \r\n4. Repeat for required repetitions. ",
      "video_tips": "    ",
      "pro_tips": "Avoid using momentum or swinging during the exercise. \r\nPerform the knee raise slowly and controlled.",
      "is_static": "0",
      "musclegroup_string": "Back, Core, Legs"
      },
      "is_completed": 0
      }
      ]
      },
      "exercise_category": 1
      },
      "coach_workout_rounds": 3,
      "workout_intensity": 1,
      "hiit": [],
      "stretching": [
      {
      "id": "1",
      "exercise_id": "Superman",
      "duration": {
      "min": 6,
      "max": 13
      },
      "unit": "times",
      "is_completed": "0",
      "created_at": "2016-01-22 07:10:31",
      "updated_at": "2016-01-22 07:10:31"
      },
      {
      "id": "2",
      "exercise_id": "Lower Back Strength",
      "duration": {
      "min": 38,
      "max": 63
      },
      "unit": "times",
      "is_completed": "0",
      "created_at": "2016-01-22 07:15:02",
      "updated_at": "2016-01-22 07:15:02"
      },
      {
      "id": "3",
      "exercise_id": "Upper Dog",
      "duration": {
      "min": 38,
      "max": 75
      },
      "unit": "seconds",
      "is_completed": "0",
      "created_at": "2016-01-22 07:16:03",
      "updated_at": "2016-01-22 07:16:03"
      },
      {
      "id": "4",
      "exercise_id": "Child's Pose",
      "duration": {
      "min": 38,
      "max": 75
      },
      "unit": "seconds",
      "is_completed": "0",
      "created_at": "2016-01-22 07:16:46",
      "updated_at": "2016-01-22 07:16:46"
      },
      {
      "id": "5",
      "exercise_id": "L-sit on the floor",
      "duration": {
      "min": 38,
      "max": 75
      },
      "unit": "seconds",
      "is_completed": "0",
      "created_at": "2016-01-22 07:17:13",
      "updated_at": "2016-01-22 07:17:13"
      },
      {
      "id": "6",
      "exercise_id": "Good morning",
      "duration": {
      "min": 38,
      "max": 75
      },
      "unit": "seconds",
      "is_completed": "0",
      "created_at": "2016-01-22 07:17:43",
      "updated_at": "2016-01-22 07:17:43"
      },
      {
      "id": "7",
      "exercise_id": "Chest Opener",
      "duration": {
      "min": 38,
      "max": 75
      },
      "unit": "seconds",
      "is_completed": "0",
      "created_at": "2016-01-22 07:19:32",
      "updated_at": "2016-01-22 07:19:32"
      },
      {
      "id": "8",
      "exercise_id": "Triceps Stretc",
      "duration": {
      "min": 38,
      "max": 75
      },
      "unit": "seconds",
      "is_completed": "0",
      "created_at": "2016-01-22 07:19:56",
      "updated_at": "2016-01-22 07:19:56"
      },
      {
      "id": "9",
      "exercise_id": "Hands Back",
      "duration": {
      "min": 38,
      "max": 75
      },
      "unit": "seconds",
      "is_completed": "0",
      "created_at": "2016-01-22 07:20:19",
      "updated_at": "2016-01-22 07:20:19"
      },
      {
      "id": "10",
      "exercise_id": "Shoulder Stretch",
      "duration": {
      "min": 38,
      "max": 75
      },
      "unit": "seconds",
      "is_completed": "0",
      "created_at": "2016-01-22 07:20:45",
      "updated_at": "2016-01-22 07:20:45"
      }
      ],
      "status": "pending"
      },
      "day4": {
      "warmup": [
      {
      "id": "1",
      "name": "wall extensions",
      "duration": {
      "min": "10",
      "max": "20"
      },
      "unit": "times",
      "created_at": "2016-01-21 08:55:06",
      "updated_at": "2016-01-21 08:55:06",
      "is_completed": 0
      },
      {
      "id": "2",
      "name": "band dislocates",
      "duration": {
      "min": "10",
      "max": "20"
      },
      "unit": "times",
      "created_at": "2016-01-21 08:57:38",
      "updated_at": "2016-01-21 08:57:38",
      "is_completed": 0
      },
      {
      "id": "3",
      "name": "cat-camels",
      "duration": {
      "min": "10",
      "max": "20"
      },
      "unit": "times",
      "created_at": "2016-01-21 09:00:39",
      "updated_at": "2016-01-21 09:00:39",
      "is_completed": 0
      },
      {
      "id": "4",
      "name": "scapular shrugs",
      "duration": {
      "min": "10",
      "max": "20"
      },
      "unit": "times",
      "created_at": "2016-01-21 09:01:01",
      "updated_at": "2016-01-21 09:01:01",
      "is_completed": 0
      },
      {
      "id": "5",
      "name": "full body circles",
      "duration": {
      "min": "10",
      "max": "20"
      },
      "unit": "times",
      "created_at": "2016-01-21 09:01:26",
      "updated_at": "2016-01-21 09:01:26",
      "is_completed": 0
      },
      {
      "id": "6",
      "name": "Jumping Jacks",
      "duration": {
      "min": "100",
      "max": ""
      },
      "unit": "seconds",
      "created_at": "2016-01-21 09:04:52",
      "updated_at": "2016-01-21 09:04:52",
      "is_completed": 0
      },
      {
      "id": "7",
      "name": "Arm rotations",
      "duration": {
      "min": "120",
      "max": ""
      },
      "unit": "times",
      "created_at": "2016-01-21 09:05:29",
      "updated_at": "2016-01-21 09:05:29",
      "is_completed": 0
      },
      {
      "id": "8",
      "name": "High Knees",
      "duration": {
      "min": "50",
      "max": ""
      },
      "unit": "times",
      "created_at": "2016-01-21 09:06:02",
      "updated_at": "2016-01-21 09:06:02",
      "is_completed": 0
      },
      {
      "id": "9",
      "name": "Shouder rolls",
      "duration": {
      "min": "20",
      "max": ""
      },
      "unit": "times",
      "created_at": "2016-01-21 09:06:34",
      "updated_at": "2016-01-21 09:06:34",
      "is_completed": 0
      }
      ],
      "is_completed": 0,
      "fundumentals": [
      {
      "id": "11",
      "row": "3",
      "exercise_id": "64",
      "duration": {
      "min": "10",
      "max": ""
      },
      "unit": "times",
      "is_completed": "0",
      "created_at": "2016-01-22 04:35:13",
      "updated_at": "2016-04-04 14:27:54",
      "exercise": {
      "id": "64",
      "name": "Skin the cat",
      "description": "Develop your joints mobility and expose yourself to new movement layers",
      "category": "1",
      "type": "2",
      "muscle_groups": "4,5,6",
      "rewards": "6.00",
      "repititions": "10",
      "duration": "10",
      "unit": "times",
      "equipment": "",
      "range_of_motion": " 1. Hands a little more than shoulder width apart\r\n2. Raise your knees to the chest\r\n3. continuing the movement until the feet pass up through the arms and over head into an inverted hang position.\r\n4. Continue to pass the feet round and down toward the ground into the extended 'skin the cat' position.\r\n5. Lift your hips and raise the legs back and over to the starting hang position. ",
      "video_tips": "        ",
      "pro_tips": " Put your hands closer together to ease up all back lever progressions.\r\nDo only half of the movement in the beginning, but fight for completion over time.\r\nIncorporate other static elements to challenge yourself during the movement as you master other skills.\r\n    ",
      "is_static": "0",
      "musclegroup_string": "Back, Arms, Core",
      "video": [
      {
      "id": "71",
      "path": "64_1454045043.mp4",
      "videothumbnail": "64_1454045043.jpg",
      "description": "Skin the cat"
      }
      ]
      }
      },
      {
      "id": "12",
      "row": "3",
      "exercise_id": "12",
      "duration": {
      "min": "20",
      "max": ""
      },
      "unit": "times",
      "is_completed": "0",
      "created_at": "2016-01-22 04:36:16",
      "updated_at": "2016-04-04 09:26:06",
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
      "is_static": "0",
      "musclegroup_string": "Shoulders, Chest, Triceps",
      "video": [
      {
      "id": "57",
      "path": "12_1453984139.mp4",
      "videothumbnail": "12_1453984139.jpg",
      "description": "Pushups"
      }
      ]
      }
      },
      {
      "id": "13",
      "row": "3",
      "exercise_id": "49",
      "duration": {
      "min": "30",
      "max": ""
      },
      "unit": "times",
      "is_completed": "0",
      "created_at": "2016-01-22 04:36:49",
      "updated_at": "2016-04-04 14:19:29",
      "exercise": {
      "id": "49",
      "name": "Side Triceps",
      "description": "Start with the basics of building triceps strength",
      "category": "1",
      "type": "1",
      "muscle_groups": "3",
      "rewards": "6.00",
      "repititions": "10",
      "duration": "10",
      "unit": "times",
      "equipment": "",
      "range_of_motion": " 1. Start with the body on your side\r\n2. Put one hand on your shoulder \r\n3. Press up with the other arm and hold in extension ",
      "video_tips": "          ",
      "pro_tips": " Avoid supporting the movement with your core muscle.      ",
      "is_static": "0",
      "musclegroup_string": "Triceps",
      "video": [
      {
      "id": "43",
      "path": "49_1454043404.mp4",
      "videothumbnail": "49_1454043404.jpg",
      "description": "Side Triceps"
      }
      ]
      }
      },
      {
      "id": "14",
      "row": "3",
      "exercise_id": "4",
      "duration": {
      "min": "60",
      "max": "90"
      },
      "unit": "seconds",
      "is_completed": "0",
      "created_at": "2016-01-22 04:37:32",
      "updated_at": "2016-04-04 14:02:11",
      "exercise": {
      "id": "4",
      "name": "Plank",
      "description": "The plank builds your isometric strength and helps sculpt your waistline.",
      "category": "1",
      "type": "1",
      "muscle_groups": "1,4,6,8",
      "rewards": "6.00",
      "repititions": "10",
      "duration": "10",
      "unit": "seconds",
      "equipment": "",
      "range_of_motion": "1. Get into pushup position on the floor.\r\n2. Now bend your elbows 90 degrees and rest your weight on your forearms. \r\n3. Hold the position for as long as you can.   ",
      "video_tips": "        ",
      "pro_tips": "Drive your chest away from the ground and spread your shoulder blades as much as you can.\r\nKeep a straight line, from head to toe. \r\nDon't collapse your lower back or reach your butt to the sky. Add movement to your plank, rock back and forth on your forearms and toes or shift from side to side.\r\nTry advanced variations with alternating sinlge leg support. \r\nStart with an incline plank if a straight plank is too hard in the beginning.  ",
      "is_static": "0",
      "musclegroup_string": "Shoulders, Back, Core, Full Body",
      "video": [
      {
      "id": "4",
      "path": "4_1453976855.mp4",
      "videothumbnail": "4_1453976855.jpg",
      "description": "Plank"
      }
      ]
      }
      },
      {
      "id": "15",
      "row": "3",
      "exercise_id": "36",
      "duration": {
      "min": "20",
      "max": ""
      },
      "unit": "times",
      "is_completed": "0",
      "created_at": "2016-01-22 04:37:57",
      "updated_at": "2016-04-04 11:12:49",
      "exercise": {
      "id": "36",
      "name": "High Jumps",
      "description": "Do high jumps as a part of restless HIIT workouts",
      "category": "1",
      "type": "2",
      "muscle_groups": "7",
      "rewards": "6.00",
      "repititions": "10",
      "duration": "10",
      "unit": "times",
      "equipment": "",
      "range_of_motion": "1. Start from a standing position\r\n2. Jump up and bring your knees to your chest",
      "video_tips": "    ",
      "pro_tips": "Land softly and exhale when the knees are up.\r\n  ",
      "is_static": "0",
      "musclegroup_string": "Legs",
      "video": [
      {
      "id": "33",
      "path": "36_1454042273.mp4",
      "videothumbnail": "36_1454042273.jpg",
      "description": "High Jumps"
      }
      ]
      }
      }
      ],
      "exercises": [],
      "workout": {
      "id": "1",
      "name": "Baldur",
      "description": "A,D,B",
      "rounds": "5",
      "category": "1",
      "type": "2",
      "rewards": "440",
      "duration": "2380.00",
      "equipments": "Bar/Rings, Paralettes/Rings",
      "is_completed": 0,
      "exercises": {
      "round1": [
      {
      "id": "1",
      "workout_id": "1",
      "category": "1",
      "repititions": "10",
      "exercise_id": "66",
      "unit": "times",
      "round": "1",
      "created_at": "2016-01-19 03:15:36",
      "updated_at": "2016-04-04 14:31:38",
      "exercise": {
      "id": "69",
      "name": "Jumping Pullups",
      "description": "Expose yourself to packed shoulders and hang time",
      "category": "1",
      "type": "1",
      "muscle_groups": "1,5",
      "rewards": "6.00",
      "repititions": "10",
      "duration": "10",
      "unit": "times",
      "equipment": "",
      "range_of_motion": " 1. Grip a bar and jump into the top position of the pull-up exercise\r\n2. Straight legs in front of you. \r\n3. Slowly go down into a deadhang position ",
      "video_tips": "        ",
      "pro_tips": " A deadhang postion requires your shoulder blades down and towards the spine with arms being straight (retraction)\r\nAim for three second holds at the top and go down slowly ",
      "is_static": "0",
      "musclegroup_string": "Shoulders, Arms"
      },
      "is_completed": 0
      },
      {
      "id": "6",
      "workout_id": "1",
      "category": "1",
      "repititions": "10",
      "exercise_id": "22",
      "unit": "times",
      "round": "1",
      "created_at": "2016-01-19 03:17:21",
      "updated_at": "2016-04-04 14:09:31",
      "exercise": {
      "id": "22",
      "name": "Spiderman Pushups",
      "description": "Learn to control your body and create body awareness",
      "category": "1",
      "type": "2",
      "muscle_groups": "2,3,5,6",
      "rewards": "6.00",
      "repititions": "10",
      "duration": "10",
      "unit": "times",
      "equipment": "",
      "range_of_motion": "  1. Start in a standard pushup position.\r\n 2. Next, lower yourself downward until your chest almost touches the floor as you inhale.\r\n 3. Bring your knees to your elbows as you go down and alternate with next repition. ",
      "video_tips": "      ",
      "pro_tips": " Pretend you are balancing something on your tailbone as you do the Spiderman pushup to maintain the correct plank position. This keeps your hips from rotating. ",
      "is_static": "0",
      "musclegroup_string": "Chest, Triceps, Arms, Core"
      },
      "is_completed": 0
      },
      {
      "id": "11",
      "workout_id": "1",
      "category": "1",
      "repititions": "10",
      "exercise_id": "49",
      "unit": "times",
      "round": "1",
      "created_at": "2016-01-19 03:19:02",
      "updated_at": "2016-04-04 14:19:29",
      "exercise": {
      "id": "49",
      "name": "Side Triceps",
      "description": "Start with the basics of building triceps strength",
      "category": "1",
      "type": "1",
      "muscle_groups": "3",
      "rewards": "6.00",
      "repititions": "10",
      "duration": "10",
      "unit": "times",
      "equipment": "",
      "range_of_motion": " 1. Start with the body on your side\r\n2. Put one hand on your shoulder \r\n3. Press up with the other arm and hold in extension ",
      "video_tips": "          ",
      "pro_tips": " Avoid supporting the movement with your core muscle.      ",
      "is_static": "0",
      "musclegroup_string": "Triceps"
      },
      "is_completed": 0
      }
      ],
      "round2": [
      {
      "id": "3",
      "workout_id": "1",
      "category": "1",
      "repititions": "20",
      "exercise_id": "66",
      "unit": "times",
      "round": "2",
      "created_at": "2016-01-19 03:16:17",
      "updated_at": "2016-04-04 14:31:38",
      "exercise": {
      "id": "69",
      "name": "Jumping Pullups",
      "description": "Expose yourself to packed shoulders and hang time",
      "category": "1",
      "type": "1",
      "muscle_groups": "1,5",
      "rewards": "6.00",
      "repititions": "10",
      "duration": "10",
      "unit": "times",
      "equipment": "",
      "range_of_motion": " 1. Grip a bar and jump into the top position of the pull-up exercise\r\n2. Straight legs in front of you. \r\n3. Slowly go down into a deadhang position ",
      "video_tips": "        ",
      "pro_tips": " A deadhang postion requires your shoulder blades down and towards the spine with arms being straight (retraction)\r\nAim for three second holds at the top and go down slowly ",
      "is_static": "0",
      "musclegroup_string": "Shoulders, Arms"
      },
      "is_completed": 0
      },
      {
      "id": "8",
      "workout_id": "1",
      "category": "1",
      "repititions": "20",
      "exercise_id": "22",
      "unit": "times",
      "round": "2",
      "created_at": "2016-01-19 03:17:54",
      "updated_at": "2016-04-04 14:09:31",
      "exercise": {
      "id": "22",
      "name": "Spiderman Pushups",
      "description": "Learn to control your body and create body awareness",
      "category": "1",
      "type": "2",
      "muscle_groups": "2,3,5,6",
      "rewards": "6.00",
      "repititions": "10",
      "duration": "10",
      "unit": "times",
      "equipment": "",
      "range_of_motion": "  1. Start in a standard pushup position.\r\n 2. Next, lower yourself downward until your chest almost touches the floor as you inhale.\r\n 3. Bring your knees to your elbows as you go down and alternate with next repition. ",
      "video_tips": "      ",
      "pro_tips": " Pretend you are balancing something on your tailbone as you do the Spiderman pushup to maintain the correct plank position. This keeps your hips from rotating. ",
      "is_static": "0",
      "musclegroup_string": "Chest, Triceps, Arms, Core"
      },
      "is_completed": 0
      },
      {
      "id": "13",
      "workout_id": "1",
      "category": "1",
      "repititions": "20",
      "exercise_id": "49",
      "unit": "times",
      "round": "2",
      "created_at": "2016-01-19 03:19:23",
      "updated_at": "2016-04-04 14:19:29",
      "exercise": {
      "id": "49",
      "name": "Side Triceps",
      "description": "Start with the basics of building triceps strength",
      "category": "1",
      "type": "1",
      "muscle_groups": "3",
      "rewards": "6.00",
      "repititions": "10",
      "duration": "10",
      "unit": "times",
      "equipment": "",
      "range_of_motion": " 1. Start with the body on your side\r\n2. Put one hand on your shoulder \r\n3. Press up with the other arm and hold in extension ",
      "video_tips": "          ",
      "pro_tips": " Avoid supporting the movement with your core muscle.      ",
      "is_static": "0",
      "musclegroup_string": "Triceps"
      },
      "is_completed": 0
      }
      ],
      "round3": [
      {
      "id": "5",
      "workout_id": "1",
      "category": "1",
      "repititions": "30",
      "exercise_id": "66",
      "unit": "times",
      "round": "3",
      "created_at": "2016-01-19 03:16:40",
      "updated_at": "2016-04-04 14:31:38",
      "exercise": {
      "id": "69",
      "name": "Jumping Pullups",
      "description": "Expose yourself to packed shoulders and hang time",
      "category": "1",
      "type": "1",
      "muscle_groups": "1,5",
      "rewards": "6.00",
      "repititions": "10",
      "duration": "10",
      "unit": "times",
      "equipment": "",
      "range_of_motion": " 1. Grip a bar and jump into the top position of the pull-up exercise\r\n2. Straight legs in front of you. \r\n3. Slowly go down into a deadhang position ",
      "video_tips": "        ",
      "pro_tips": " A deadhang postion requires your shoulder blades down and towards the spine with arms being straight (retraction)\r\nAim for three second holds at the top and go down slowly ",
      "is_static": "0",
      "musclegroup_string": "Shoulders, Arms"
      },
      "is_completed": 0
      },
      {
      "id": "10",
      "workout_id": "1",
      "category": "1",
      "repititions": "30",
      "exercise_id": "22",
      "unit": "times",
      "round": "3",
      "created_at": "2016-01-19 03:18:11",
      "updated_at": "2016-04-04 14:09:31",
      "exercise": {
      "id": "22",
      "name": "Spiderman Pushups",
      "description": "Learn to control your body and create body awareness",
      "category": "1",
      "type": "2",
      "muscle_groups": "2,3,5,6",
      "rewards": "6.00",
      "repititions": "10",
      "duration": "10",
      "unit": "times",
      "equipment": "",
      "range_of_motion": "  1. Start in a standard pushup position.\r\n 2. Next, lower yourself downward until your chest almost touches the floor as you inhale.\r\n 3. Bring your knees to your elbows as you go down and alternate with next repition. ",
      "video_tips": "      ",
      "pro_tips": " Pretend you are balancing something on your tailbone as you do the Spiderman pushup to maintain the correct plank position. This keeps your hips from rotating. ",
      "is_static": "0",
      "musclegroup_string": "Chest, Triceps, Arms, Core"
      },
      "is_completed": 0
      },
      {
      "id": "15",
      "workout_id": "1",
      "category": "1",
      "repititions": "30",
      "exercise_id": "49",
      "unit": "times",
      "round": "3",
      "created_at": "2016-01-19 03:19:48",
      "updated_at": "2016-04-04 14:19:29",
      "exercise": {
      "id": "49",
      "name": "Side Triceps",
      "description": "Start with the basics of building triceps strength",
      "category": "1",
      "type": "1",
      "muscle_groups": "3",
      "rewards": "6.00",
      "repititions": "10",
      "duration": "10",
      "unit": "times",
      "equipment": "",
      "range_of_motion": " 1. Start with the body on your side\r\n2. Put one hand on your shoulder \r\n3. Press up with the other arm and hold in extension ",
      "video_tips": "          ",
      "pro_tips": " Avoid supporting the movement with your core muscle.      ",
      "is_static": "0",
      "musclegroup_string": "Triceps"
      },
      "is_completed": 0
      }
      ]
      },
      "exercise_category": 1
      },
      "coach_workout_rounds": 3,
      "workout_intensity": 1,
      "hiit": [],
      "stretching": [
      {
      "id": "1",
      "exercise_id": "Superman",
      "duration": {
      "min": 6,
      "max": 13
      },
      "unit": "times",
      "is_completed": "0",
      "created_at": "2016-01-22 07:10:31",
      "updated_at": "2016-01-22 07:10:31"
      },
      {
      "id": "2",
      "exercise_id": "Lower Back Strength",
      "duration": {
      "min": 38,
      "max": 63
      },
      "unit": "times",
      "is_completed": "0",
      "created_at": "2016-01-22 07:15:02",
      "updated_at": "2016-01-22 07:15:02"
      },
      {
      "id": "3",
      "exercise_id": "Upper Dog",
      "duration": {
      "min": 38,
      "max": 75
      },
      "unit": "seconds",
      "is_completed": "0",
      "created_at": "2016-01-22 07:16:03",
      "updated_at": "2016-01-22 07:16:03"
      },
      {
      "id": "4",
      "exercise_id": "Child's Pose",
      "duration": {
      "min": 38,
      "max": 75
      },
      "unit": "seconds",
      "is_completed": "0",
      "created_at": "2016-01-22 07:16:46",
      "updated_at": "2016-01-22 07:16:46"
      },
      {
      "id": "5",
      "exercise_id": "L-sit on the floor",
      "duration": {
      "min": 38,
      "max": 75
      },
      "unit": "seconds",
      "is_completed": "0",
      "created_at": "2016-01-22 07:17:13",
      "updated_at": "2016-01-22 07:17:13"
      },
      {
      "id": "6",
      "exercise_id": "Good morning",
      "duration": {
      "min": 38,
      "max": 75
      },
      "unit": "seconds",
      "is_completed": "0",
      "created_at": "2016-01-22 07:17:43",
      "updated_at": "2016-01-22 07:17:43"
      },
      {
      "id": "7",
      "exercise_id": "Chest Opener",
      "duration": {
      "min": 38,
      "max": 75
      },
      "unit": "seconds",
      "is_completed": "0",
      "created_at": "2016-01-22 07:19:32",
      "updated_at": "2016-01-22 07:19:32"
      },
      {
      "id": "8",
      "exercise_id": "Triceps Stretc",
      "duration": {
      "min": 38,
      "max": 75
      },
      "unit": "seconds",
      "is_completed": "0",
      "created_at": "2016-01-22 07:19:56",
      "updated_at": "2016-01-22 07:19:56"
      },
      {
      "id": "9",
      "exercise_id": "Hands Back",
      "duration": {
      "min": 38,
      "max": 75
      },
      "unit": "seconds",
      "is_completed": "0",
      "created_at": "2016-01-22 07:20:19",
      "updated_at": "2016-01-22 07:20:19"
      },
      {
      "id": "10",
      "exercise_id": "Shoulder Stretch",
      "duration": {
      "min": 38,
      "max": 75
      },
      "unit": "seconds",
      "is_completed": "0",
      "created_at": "2016-01-22 07:20:45",
      "updated_at": "2016-01-22 07:20:45"
      }
      ],
      "status": "pending"
      },
      "day5": {
      "warmup": [
      {
      "id": "1",
      "name": "wall extensions",
      "duration": {
      "min": "10",
      "max": "20"
      },
      "unit": "times",
      "created_at": "2016-01-21 08:55:06",
      "updated_at": "2016-01-21 08:55:06",
      "is_completed": 0
      },
      {
      "id": "2",
      "name": "band dislocates",
      "duration": {
      "min": "10",
      "max": "20"
      },
      "unit": "times",
      "created_at": "2016-01-21 08:57:38",
      "updated_at": "2016-01-21 08:57:38",
      "is_completed": 0
      },
      {
      "id": "3",
      "name": "cat-camels",
      "duration": {
      "min": "10",
      "max": "20"
      },
      "unit": "times",
      "created_at": "2016-01-21 09:00:39",
      "updated_at": "2016-01-21 09:00:39",
      "is_completed": 0
      },
      {
      "id": "4",
      "name": "scapular shrugs",
      "duration": {
      "min": "10",
      "max": "20"
      },
      "unit": "times",
      "created_at": "2016-01-21 09:01:01",
      "updated_at": "2016-01-21 09:01:01",
      "is_completed": 0
      },
      {
      "id": "5",
      "name": "full body circles",
      "duration": {
      "min": "10",
      "max": "20"
      },
      "unit": "times",
      "created_at": "2016-01-21 09:01:26",
      "updated_at": "2016-01-21 09:01:26",
      "is_completed": 0
      },
      {
      "id": "6",
      "name": "Jumping Jacks",
      "duration": {
      "min": "100",
      "max": ""
      },
      "unit": "seconds",
      "created_at": "2016-01-21 09:04:52",
      "updated_at": "2016-01-21 09:04:52",
      "is_completed": 0
      },
      {
      "id": "7",
      "name": "Arm rotations",
      "duration": {
      "min": "120",
      "max": ""
      },
      "unit": "times",
      "created_at": "2016-01-21 09:05:29",
      "updated_at": "2016-01-21 09:05:29",
      "is_completed": 0
      },
      {
      "id": "8",
      "name": "High Knees",
      "duration": {
      "min": "50",
      "max": ""
      },
      "unit": "times",
      "created_at": "2016-01-21 09:06:02",
      "updated_at": "2016-01-21 09:06:02",
      "is_completed": 0
      },
      {
      "id": "9",
      "name": "Shouder rolls",
      "duration": {
      "min": "20",
      "max": ""
      },
      "unit": "times",
      "created_at": "2016-01-21 09:06:34",
      "updated_at": "2016-01-21 09:06:34",
      "is_completed": 0
      }
      ],
      "is_completed": 0,
      "fundumentals": [
      {
      "id": "11",
      "row": "3",
      "exercise_id": "64",
      "duration": {
      "min": "10",
      "max": ""
      },
      "unit": "times",
      "is_completed": "0",
      "created_at": "2016-01-22 04:35:13",
      "updated_at": "2016-04-04 14:27:54",
      "exercise": {
      "id": "64",
      "name": "Skin the cat",
      "description": "Develop your joints mobility and expose yourself to new movement layers",
      "category": "1",
      "type": "2",
      "muscle_groups": "4,5,6",
      "rewards": "6.00",
      "repititions": "10",
      "duration": "10",
      "unit": "times",
      "equipment": "",
      "range_of_motion": " 1. Hands a little more than shoulder width apart\r\n2. Raise your knees to the chest\r\n3. continuing the movement until the feet pass up through the arms and over head into an inverted hang position.\r\n4. Continue to pass the feet round and down toward the ground into the extended 'skin the cat' position.\r\n5. Lift your hips and raise the legs back and over to the starting hang position. ",
      "video_tips": "        ",
      "pro_tips": " Put your hands closer together to ease up all back lever progressions.\r\nDo only half of the movement in the beginning, but fight for completion over time.\r\nIncorporate other static elements to challenge yourself during the movement as you master other skills.\r\n    ",
      "is_static": "0",
      "musclegroup_string": "Back, Arms, Core",
      "video": [
      {
      "id": "71",
      "path": "64_1454045043.mp4",
      "videothumbnail": "64_1454045043.jpg",
      "description": "Skin the cat"
      }
      ]
      }
      },
      {
      "id": "12",
      "row": "3",
      "exercise_id": "12",
      "duration": {
      "min": "20",
      "max": ""
      },
      "unit": "times",
      "is_completed": "0",
      "created_at": "2016-01-22 04:36:16",
      "updated_at": "2016-04-04 09:26:06",
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
      "is_static": "0",
      "musclegroup_string": "Shoulders, Chest, Triceps",
      "video": [
      {
      "id": "57",
      "path": "12_1453984139.mp4",
      "videothumbnail": "12_1453984139.jpg",
      "description": "Pushups"
      }
      ]
      }
      },
      {
      "id": "13",
      "row": "3",
      "exercise_id": "49",
      "duration": {
      "min": "30",
      "max": ""
      },
      "unit": "times",
      "is_completed": "0",
      "created_at": "2016-01-22 04:36:49",
      "updated_at": "2016-04-04 14:19:29",
      "exercise": {
      "id": "49",
      "name": "Side Triceps",
      "description": "Start with the basics of building triceps strength",
      "category": "1",
      "type": "1",
      "muscle_groups": "3",
      "rewards": "6.00",
      "repititions": "10",
      "duration": "10",
      "unit": "times",
      "equipment": "",
      "range_of_motion": " 1. Start with the body on your side\r\n2. Put one hand on your shoulder \r\n3. Press up with the other arm and hold in extension ",
      "video_tips": "          ",
      "pro_tips": " Avoid supporting the movement with your core muscle.      ",
      "is_static": "0",
      "musclegroup_string": "Triceps",
      "video": [
      {
      "id": "43",
      "path": "49_1454043404.mp4",
      "videothumbnail": "49_1454043404.jpg",
      "description": "Side Triceps"
      }
      ]
      }
      },
      {
      "id": "14",
      "row": "3",
      "exercise_id": "4",
      "duration": {
      "min": "60",
      "max": "90"
      },
      "unit": "seconds",
      "is_completed": "0",
      "created_at": "2016-01-22 04:37:32",
      "updated_at": "2016-04-04 14:02:11",
      "exercise": {
      "id": "4",
      "name": "Plank",
      "description": "The plank builds your isometric strength and helps sculpt your waistline.",
      "category": "1",
      "type": "1",
      "muscle_groups": "1,4,6,8",
      "rewards": "6.00",
      "repititions": "10",
      "duration": "10",
      "unit": "seconds",
      "equipment": "",
      "range_of_motion": "1. Get into pushup position on the floor.\r\n2. Now bend your elbows 90 degrees and rest your weight on your forearms. \r\n3. Hold the position for as long as you can.   ",
      "video_tips": "        ",
      "pro_tips": "Drive your chest away from the ground and spread your shoulder blades as much as you can.\r\nKeep a straight line, from head to toe. \r\nDon't collapse your lower back or reach your butt to the sky. Add movement to your plank, rock back and forth on your forearms and toes or shift from side to side.\r\nTry advanced variations with alternating sinlge leg support. \r\nStart with an incline plank if a straight plank is too hard in the beginning.  ",
      "is_static": "0",
      "musclegroup_string": "Shoulders, Back, Core, Full Body",
      "video": [
      {
      "id": "4",
      "path": "4_1453976855.mp4",
      "videothumbnail": "4_1453976855.jpg",
      "description": "Plank"
      }
      ]
      }
      },
      {
      "id": "15",
      "row": "3",
      "exercise_id": "36",
      "duration": {
      "min": "20",
      "max": ""
      },
      "unit": "times",
      "is_completed": "0",
      "created_at": "2016-01-22 04:37:57",
      "updated_at": "2016-04-04 11:12:49",
      "exercise": {
      "id": "36",
      "name": "High Jumps",
      "description": "Do high jumps as a part of restless HIIT workouts",
      "category": "1",
      "type": "2",
      "muscle_groups": "7",
      "rewards": "6.00",
      "repititions": "10",
      "duration": "10",
      "unit": "times",
      "equipment": "",
      "range_of_motion": "1. Start from a standing position\r\n2. Jump up and bring your knees to your chest",
      "video_tips": "    ",
      "pro_tips": "Land softly and exhale when the knees are up.\r\n  ",
      "is_static": "0",
      "musclegroup_string": "Legs",
      "video": [
      {
      "id": "33",
      "path": "36_1454042273.mp4",
      "videothumbnail": "36_1454042273.jpg",
      "description": "High Jumps"
      }
      ]
      }
      }
      ],
      "exercises": [],
      "workout": {
      "id": "21",
      "name": "Vali",
      "description": "A,B,E",
      "rounds": "3",
      "category": "1",
      "type": "2",
      "rewards": "330",
      "duration": "1620.00",
      "equipments": "Bar/Rings, Ladder/Post",
      "is_completed": 0,
      "exercises": {
      "round1": [
      {
      "id": "838",
      "workout_id": "21",
      "category": "1",
      "repititions": "7",
      "exercise_id": "64",
      "unit": "times",
      "round": "1",
      "created_at": "2016-01-19 23:14:44",
      "updated_at": "2016-04-04 14:27:54",
      "exercise": {
      "id": "64",
      "name": "Skin the cat",
      "description": "Develop your joints mobility and expose yourself to new movement layers",
      "category": "1",
      "type": "2",
      "muscle_groups": "4,5,6",
      "rewards": "6.00",
      "repititions": "10",
      "duration": "10",
      "unit": "times",
      "equipment": "",
      "range_of_motion": " 1. Hands a little more than shoulder width apart\r\n2. Raise your knees to the chest\r\n3. continuing the movement until the feet pass up through the arms and over head into an inverted hang position.\r\n4. Continue to pass the feet round and down toward the ground into the extended 'skin the cat' position.\r\n5. Lift your hips and raise the legs back and over to the starting hang position. ",
      "video_tips": "        ",
      "pro_tips": " Put your hands closer together to ease up all back lever progressions.\r\nDo only half of the movement in the beginning, but fight for completion over time.\r\nIncorporate other static elements to challenge yourself during the movement as you master other skills.\r\n    ",
      "is_static": "0",
      "musclegroup_string": "Back, Arms, Core"
      },
      "is_completed": 0
      },
      {
      "id": "841",
      "workout_id": "21",
      "category": "1",
      "repititions": "30",
      "exercise_id": "49",
      "unit": "times",
      "round": "1",
      "created_at": "2016-01-19 23:15:12",
      "updated_at": "2016-04-04 14:19:29",
      "exercise": {
      "id": "49",
      "name": "Side Triceps",
      "description": "Start with the basics of building triceps strength",
      "category": "1",
      "type": "1",
      "muscle_groups": "3",
      "rewards": "6.00",
      "repititions": "10",
      "duration": "10",
      "unit": "times",
      "equipment": "",
      "range_of_motion": " 1. Start with the body on your side\r\n2. Put one hand on your shoulder \r\n3. Press up with the other arm and hold in extension ",
      "video_tips": "          ",
      "pro_tips": " Avoid supporting the movement with your core muscle.      ",
      "is_static": "0",
      "musclegroup_string": "Triceps"
      },
      "is_completed": 0
      },
      {
      "id": "844",
      "workout_id": "21",
      "category": "1",
      "repititions": "15",
      "exercise_id": "29",
      "unit": "times",
      "round": "1",
      "created_at": "2016-01-19 23:15:35",
      "updated_at": "2016-04-04 14:14:02",
      "exercise": {
      "id": "29",
      "name": "Tucked DF",
      "description": "Develop your core strength on the path to the hardest core exercise in history",
      "category": "1",
      "type": "2",
      "muscle_groups": "6",
      "rewards": "6.00",
      "repititions": "10",
      "duration": "10",
      "unit": "times",
      "equipment": "",
      "range_of_motion": " 1. Lie on a decline or flat bench and grab the edge of it behind your head with both hands. \r\n2. Tuck your knees to your chest.\r\n3. Slowly try to extend to bend legs and hold position as long as you can \r\n4. Repeat movement. ",
      "video_tips": "          ",
      "pro_tips": " Work it slowly and controlled.\r\nFocus to engage your core and lower back in all progressions. ",
      "is_static": "0",
      "musclegroup_string": "Core"
      },
      "is_completed": 0
      },
      {
      "id": "847",
      "workout_id": "21",
      "category": "1",
      "repititions": "30",
      "exercise_id": "72",
      "unit": "times",
      "round": "1",
      "created_at": "2016-01-19 23:16:00",
      "updated_at": "2016-04-04 14:34:27",
      "exercise": {
      "id": "73",
      "name": "Tucked Human Flag",
      "description": "Start securing your anchoring point and learn to fully lock out your support",
      "category": "1",
      "type": "2",
      "muscle_groups": "1,5,6",
      "rewards": "6.00",
      "repititions": "10",
      "duration": "10",
      "unit": "times",
      "equipment": "",
      "range_of_motion": " 1. Place your hands so that palms face each other.\r\n2. Lock lower arm out for stabilization. (Hands, elbows and shoulders are in line) \r\n3. Pull your body with your upper arm up and tuck your knees to chest. ",
      "video_tips": "          ",
      "pro_tips": " If you begin to fall out of position it's important to land on your feet and let go of the anchor point to protect the shoulders.\r\nStraighten your hip and align with body.\r\nGet somebody to assist you in the beginning to stay in position. ",
      "is_static": "1",
      "musclegroup_string": "Shoulders, Arms, Core"
      },
      "is_completed": 0
      },
      {
      "id": "850",
      "workout_id": "21",
      "category": "1",
      "repititions": "10",
      "exercise_id": "66",
      "unit": "times",
      "round": "1",
      "created_at": "2016-01-19 23:16:27",
      "updated_at": "2016-04-04 14:31:38",
      "exercise": {
      "id": "69",
      "name": "Jumping Pullups",
      "description": "Expose yourself to packed shoulders and hang time",
      "category": "1",
      "type": "1",
      "muscle_groups": "1,5",
      "rewards": "6.00",
      "repititions": "10",
      "duration": "10",
      "unit": "times",
      "equipment": "",
      "range_of_motion": " 1. Grip a bar and jump into the top position of the pull-up exercise\r\n2. Straight legs in front of you. \r\n3. Slowly go down into a deadhang position ",
      "video_tips": "        ",
      "pro_tips": " A deadhang postion requires your shoulder blades down and towards the spine with arms being straight (retraction)\r\nAim for three second holds at the top and go down slowly ",
      "is_static": "0",
      "musclegroup_string": "Shoulders, Arms"
      },
      "is_completed": 0
      }
      ],
      "round2": [
      {
      "id": "839",
      "workout_id": "21",
      "category": "1",
      "repititions": "7",
      "exercise_id": "64",
      "unit": "times",
      "round": "2",
      "created_at": "2016-01-19 23:14:44",
      "updated_at": "2016-04-04 14:27:54",
      "exercise": {
      "id": "64",
      "name": "Skin the cat",
      "description": "Develop your joints mobility and expose yourself to new movement layers",
      "category": "1",
      "type": "2",
      "muscle_groups": "4,5,6",
      "rewards": "6.00",
      "repititions": "10",
      "duration": "10",
      "unit": "times",
      "equipment": "",
      "range_of_motion": " 1. Hands a little more than shoulder width apart\r\n2. Raise your knees to the chest\r\n3. continuing the movement until the feet pass up through the arms and over head into an inverted hang position.\r\n4. Continue to pass the feet round and down toward the ground into the extended 'skin the cat' position.\r\n5. Lift your hips and raise the legs back and over to the starting hang position. ",
      "video_tips": "        ",
      "pro_tips": " Put your hands closer together to ease up all back lever progressions.\r\nDo only half of the movement in the beginning, but fight for completion over time.\r\nIncorporate other static elements to challenge yourself during the movement as you master other skills.\r\n    ",
      "is_static": "0",
      "musclegroup_string": "Back, Arms, Core"
      },
      "is_completed": 0
      },
      {
      "id": "842",
      "workout_id": "21",
      "category": "1",
      "repititions": "30",
      "exercise_id": "49",
      "unit": "times",
      "round": "2",
      "created_at": "2016-01-19 23:15:12",
      "updated_at": "2016-04-04 14:19:29",
      "exercise": {
      "id": "49",
      "name": "Side Triceps",
      "description": "Start with the basics of building triceps strength",
      "category": "1",
      "type": "1",
      "muscle_groups": "3",
      "rewards": "6.00",
      "repititions": "10",
      "duration": "10",
      "unit": "times",
      "equipment": "",
      "range_of_motion": " 1. Start with the body on your side\r\n2. Put one hand on your shoulder \r\n3. Press up with the other arm and hold in extension ",
      "video_tips": "          ",
      "pro_tips": " Avoid supporting the movement with your core muscle.      ",
      "is_static": "0",
      "musclegroup_string": "Triceps"
      },
      "is_completed": 0
      },
      {
      "id": "845",
      "workout_id": "21",
      "category": "1",
      "repititions": "15",
      "exercise_id": "29",
      "unit": "times",
      "round": "2",
      "created_at": "2016-01-19 23:15:35",
      "updated_at": "2016-04-04 14:14:02",
      "exercise": {
      "id": "29",
      "name": "Tucked DF",
      "description": "Develop your core strength on the path to the hardest core exercise in history",
      "category": "1",
      "type": "2",
      "muscle_groups": "6",
      "rewards": "6.00",
      "repititions": "10",
      "duration": "10",
      "unit": "times",
      "equipment": "",
      "range_of_motion": " 1. Lie on a decline or flat bench and grab the edge of it behind your head with both hands. \r\n2. Tuck your knees to your chest.\r\n3. Slowly try to extend to bend legs and hold position as long as you can \r\n4. Repeat movement. ",
      "video_tips": "          ",
      "pro_tips": " Work it slowly and controlled.\r\nFocus to engage your core and lower back in all progressions. ",
      "is_static": "0",
      "musclegroup_string": "Core"
      },
      "is_completed": 0
      },
      {
      "id": "848",
      "workout_id": "21",
      "category": "1",
      "repititions": "30",
      "exercise_id": "72",
      "unit": "times",
      "round": "2",
      "created_at": "2016-01-19 23:16:00",
      "updated_at": "2016-04-04 14:34:27",
      "exercise": {
      "id": "73",
      "name": "Tucked Human Flag",
      "description": "Start securing your anchoring point and learn to fully lock out your support",
      "category": "1",
      "type": "2",
      "muscle_groups": "1,5,6",
      "rewards": "6.00",
      "repititions": "10",
      "duration": "10",
      "unit": "times",
      "equipment": "",
      "range_of_motion": " 1. Place your hands so that palms face each other.\r\n2. Lock lower arm out for stabilization. (Hands, elbows and shoulders are in line) \r\n3. Pull your body with your upper arm up and tuck your knees to chest. ",
      "video_tips": "          ",
      "pro_tips": " If you begin to fall out of position it's important to land on your feet and let go of the anchor point to protect the shoulders.\r\nStraighten your hip and align with body.\r\nGet somebody to assist you in the beginning to stay in position. ",
      "is_static": "1",
      "musclegroup_string": "Shoulders, Arms, Core"
      },
      "is_completed": 0
      },
      {
      "id": "852",
      "workout_id": "21",
      "category": "1",
      "repititions": "10",
      "exercise_id": "66",
      "unit": "times",
      "round": "2",
      "created_at": "2016-01-19 23:16:28",
      "updated_at": "2016-04-04 14:31:38",
      "exercise": {
      "id": "69",
      "name": "Jumping Pullups",
      "description": "Expose yourself to packed shoulders and hang time",
      "category": "1",
      "type": "1",
      "muscle_groups": "1,5",
      "rewards": "6.00",
      "repititions": "10",
      "duration": "10",
      "unit": "times",
      "equipment": "",
      "range_of_motion": " 1. Grip a bar and jump into the top position of the pull-up exercise\r\n2. Straight legs in front of you. \r\n3. Slowly go down into a deadhang position ",
      "video_tips": "        ",
      "pro_tips": " A deadhang postion requires your shoulder blades down and towards the spine with arms being straight (retraction)\r\nAim for three second holds at the top and go down slowly ",
      "is_static": "0",
      "musclegroup_string": "Shoulders, Arms"
      },
      "is_completed": 0
      }
      ],
      "round3": [
      {
      "id": "840",
      "workout_id": "21",
      "category": "1",
      "repititions": "7",
      "exercise_id": "64",
      "unit": "times",
      "round": "3",
      "created_at": "2016-01-19 23:14:44",
      "updated_at": "2016-04-04 14:27:54",
      "exercise": {
      "id": "64",
      "name": "Skin the cat",
      "description": "Develop your joints mobility and expose yourself to new movement layers",
      "category": "1",
      "type": "2",
      "muscle_groups": "4,5,6",
      "rewards": "6.00",
      "repititions": "10",
      "duration": "10",
      "unit": "times",
      "equipment": "",
      "range_of_motion": " 1. Hands a little more than shoulder width apart\r\n2. Raise your knees to the chest\r\n3. continuing the movement until the feet pass up through the arms and over head into an inverted hang position.\r\n4. Continue to pass the feet round and down toward the ground into the extended 'skin the cat' position.\r\n5. Lift your hips and raise the legs back and over to the starting hang position. ",
      "video_tips": "        ",
      "pro_tips": " Put your hands closer together to ease up all back lever progressions.\r\nDo only half of the movement in the beginning, but fight for completion over time.\r\nIncorporate other static elements to challenge yourself during the movement as you master other skills.\r\n    ",
      "is_static": "0",
      "musclegroup_string": "Back, Arms, Core"
      },
      "is_completed": 0
      },
      {
      "id": "843",
      "workout_id": "21",
      "category": "1",
      "repititions": "30",
      "exercise_id": "49",
      "unit": "times",
      "round": "3",
      "created_at": "2016-01-19 23:15:12",
      "updated_at": "2016-04-04 14:19:29",
      "exercise": {
      "id": "49",
      "name": "Side Triceps",
      "description": "Start with the basics of building triceps strength",
      "category": "1",
      "type": "1",
      "muscle_groups": "3",
      "rewards": "6.00",
      "repititions": "10",
      "duration": "10",
      "unit": "times",
      "equipment": "",
      "range_of_motion": " 1. Start with the body on your side\r\n2. Put one hand on your shoulder \r\n3. Press up with the other arm and hold in extension ",
      "video_tips": "          ",
      "pro_tips": " Avoid supporting the movement with your core muscle.      ",
      "is_static": "0",
      "musclegroup_string": "Triceps"
      },
      "is_completed": 0
      },
      {
      "id": "846",
      "workout_id": "21",
      "category": "1",
      "repititions": "15",
      "exercise_id": "29",
      "unit": "times",
      "round": "3",
      "created_at": "2016-01-19 23:15:35",
      "updated_at": "2016-04-04 14:14:02",
      "exercise": {
      "id": "29",
      "name": "Tucked DF",
      "description": "Develop your core strength on the path to the hardest core exercise in history",
      "category": "1",
      "type": "2",
      "muscle_groups": "6",
      "rewards": "6.00",
      "repititions": "10",
      "duration": "10",
      "unit": "times",
      "equipment": "",
      "range_of_motion": " 1. Lie on a decline or flat bench and grab the edge of it behind your head with both hands. \r\n2. Tuck your knees to your chest.\r\n3. Slowly try to extend to bend legs and hold position as long as you can \r\n4. Repeat movement. ",
      "video_tips": "          ",
      "pro_tips": " Work it slowly and controlled.\r\nFocus to engage your core and lower back in all progressions. ",
      "is_static": "0",
      "musclegroup_string": "Core"
      },
      "is_completed": 0
      },
      {
      "id": "849",
      "workout_id": "21",
      "category": "1",
      "repititions": "30",
      "exercise_id": "72",
      "unit": "times",
      "round": "3",
      "created_at": "2016-01-19 23:16:00",
      "updated_at": "2016-04-04 14:34:27",
      "exercise": {
      "id": "73",
      "name": "Tucked Human Flag",
      "description": "Start securing your anchoring point and learn to fully lock out your support",
      "category": "1",
      "type": "2",
      "muscle_groups": "1,5,6",
      "rewards": "6.00",
      "repititions": "10",
      "duration": "10",
      "unit": "times",
      "equipment": "",
      "range_of_motion": " 1. Place your hands so that palms face each other.\r\n2. Lock lower arm out for stabilization. (Hands, elbows and shoulders are in line) \r\n3. Pull your body with your upper arm up and tuck your knees to chest. ",
      "video_tips": "          ",
      "pro_tips": " If you begin to fall out of position it's important to land on your feet and let go of the anchor point to protect the shoulders.\r\nStraighten your hip and align with body.\r\nGet somebody to assist you in the beginning to stay in position. ",
      "is_static": "1",
      "musclegroup_string": "Shoulders, Arms, Core"
      },
      "is_completed": 0
      },
      {
      "id": "854",
      "workout_id": "21",
      "category": "1",
      "repititions": "10",
      "exercise_id": "66",
      "unit": "times",
      "round": "3",
      "created_at": "2016-01-19 23:16:28",
      "updated_at": "2016-04-04 14:31:38",
      "exercise": {
      "id": "69",
      "name": "Jumping Pullups",
      "description": "Expose yourself to packed shoulders and hang time",
      "category": "1",
      "type": "1",
      "muscle_groups": "1,5",
      "rewards": "6.00",
      "repititions": "10",
      "duration": "10",
      "unit": "times",
      "equipment": "",
      "range_of_motion": " 1. Grip a bar and jump into the top position of the pull-up exercise\r\n2. Straight legs in front of you. \r\n3. Slowly go down into a deadhang position ",
      "video_tips": "        ",
      "pro_tips": " A deadhang postion requires your shoulder blades down and towards the spine with arms being straight (retraction)\r\nAim for three second holds at the top and go down slowly ",
      "is_static": "0",
      "musclegroup_string": "Shoulders, Arms"
      },
      "is_completed": 0
      }
      ]
      },
      "exercise_category": 1
      },
      "coach_workout_rounds": 3,
      "workout_intensity": 1,
      "hiit": [],
      "stretching": [
      {
      "id": "1",
      "exercise_id": "Superman",
      "duration": {
      "min": 6,
      "max": 13
      },
      "unit": "times",
      "is_completed": "0",
      "created_at": "2016-01-22 07:10:31",
      "updated_at": "2016-01-22 07:10:31"
      },
      {
      "id": "2",
      "exercise_id": "Lower Back Strength",
      "duration": {
      "min": 38,
      "max": 63
      },
      "unit": "times",
      "is_completed": "0",
      "created_at": "2016-01-22 07:15:02",
      "updated_at": "2016-01-22 07:15:02"
      },
      {
      "id": "3",
      "exercise_id": "Upper Dog",
      "duration": {
      "min": 38,
      "max": 75
      },
      "unit": "seconds",
      "is_completed": "0",
      "created_at": "2016-01-22 07:16:03",
      "updated_at": "2016-01-22 07:16:03"
      },
      {
      "id": "4",
      "exercise_id": "Child's Pose",
      "duration": {
      "min": 38,
      "max": 75
      },
      "unit": "seconds",
      "is_completed": "0",
      "created_at": "2016-01-22 07:16:46",
      "updated_at": "2016-01-22 07:16:46"
      },
      {
      "id": "5",
      "exercise_id": "L-sit on the floor",
      "duration": {
      "min": 38,
      "max": 75
      },
      "unit": "seconds",
      "is_completed": "0",
      "created_at": "2016-01-22 07:17:13",
      "updated_at": "2016-01-22 07:17:13"
      },
      {
      "id": "6",
      "exercise_id": "Good morning",
      "duration": {
      "min": 38,
      "max": 75
      },
      "unit": "seconds",
      "is_completed": "0",
      "created_at": "2016-01-22 07:17:43",
      "updated_at": "2016-01-22 07:17:43"
      },
      {
      "id": "7",
      "exercise_id": "Chest Opener",
      "duration": {
      "min": 38,
      "max": 75
      },
      "unit": "seconds",
      "is_completed": "0",
      "created_at": "2016-01-22 07:19:32",
      "updated_at": "2016-01-22 07:19:32"
      },
      {
      "id": "8",
      "exercise_id": "Triceps Stretc",
      "duration": {
      "min": 38,
      "max": 75
      },
      "unit": "seconds",
      "is_completed": "0",
      "created_at": "2016-01-22 07:19:56",
      "updated_at": "2016-01-22 07:19:56"
      },
      {
      "id": "9",
      "exercise_id": "Hands Back",
      "duration": {
      "min": 38,
      "max": 75
      },
      "unit": "seconds",
      "is_completed": "0",
      "created_at": "2016-01-22 07:20:19",
      "updated_at": "2016-01-22 07:20:19"
      },
      {
      "id": "10",
      "exercise_id": "Shoulder Stretch",
      "duration": {
      "min": 38,
      "max": 75
      },
      "unit": "seconds",
      "is_completed": "0",
      "created_at": "2016-01-22 07:20:45",
      "updated_at": "2016-01-22 07:20:45"
      }
      ],
      "status": "pending"
      },
      "day6": {
      "warmup": [
      {
      "id": "1",
      "name": "wall extensions",
      "duration": {
      "min": "10",
      "max": "20"
      },
      "unit": "times",
      "created_at": "2016-01-21 08:55:06",
      "updated_at": "2016-01-21 08:55:06",
      "is_completed": 0
      },
      {
      "id": "2",
      "name": "band dislocates",
      "duration": {
      "min": "10",
      "max": "20"
      },
      "unit": "times",
      "created_at": "2016-01-21 08:57:38",
      "updated_at": "2016-01-21 08:57:38",
      "is_completed": 0
      },
      {
      "id": "3",
      "name": "cat-camels",
      "duration": {
      "min": "10",
      "max": "20"
      },
      "unit": "times",
      "created_at": "2016-01-21 09:00:39",
      "updated_at": "2016-01-21 09:00:39",
      "is_completed": 0
      },
      {
      "id": "4",
      "name": "scapular shrugs",
      "duration": {
      "min": "10",
      "max": "20"
      },
      "unit": "times",
      "created_at": "2016-01-21 09:01:01",
      "updated_at": "2016-01-21 09:01:01",
      "is_completed": 0
      },
      {
      "id": "5",
      "name": "full body circles",
      "duration": {
      "min": "10",
      "max": "20"
      },
      "unit": "times",
      "created_at": "2016-01-21 09:01:26",
      "updated_at": "2016-01-21 09:01:26",
      "is_completed": 0
      },
      {
      "id": "6",
      "name": "Jumping Jacks",
      "duration": {
      "min": "100",
      "max": ""
      },
      "unit": "seconds",
      "created_at": "2016-01-21 09:04:52",
      "updated_at": "2016-01-21 09:04:52",
      "is_completed": 0
      },
      {
      "id": "7",
      "name": "Arm rotations",
      "duration": {
      "min": "120",
      "max": ""
      },
      "unit": "times",
      "created_at": "2016-01-21 09:05:29",
      "updated_at": "2016-01-21 09:05:29",
      "is_completed": 0
      },
      {
      "id": "8",
      "name": "High Knees",
      "duration": {
      "min": "50",
      "max": ""
      },
      "unit": "times",
      "created_at": "2016-01-21 09:06:02",
      "updated_at": "2016-01-21 09:06:02",
      "is_completed": 0
      },
      {
      "id": "9",
      "name": "Shouder rolls",
      "duration": {
      "min": "20",
      "max": ""
      },
      "unit": "times",
      "created_at": "2016-01-21 09:06:34",
      "updated_at": "2016-01-21 09:06:34",
      "is_completed": 0
      }
      ],
      "is_completed": 0,
      "fundumentals": [
      {
      "id": "11",
      "row": "3",
      "exercise_id": "64",
      "duration": {
      "min": "10",
      "max": ""
      },
      "unit": "times",
      "is_completed": "0",
      "created_at": "2016-01-22 04:35:13",
      "updated_at": "2016-04-04 14:27:54",
      "exercise": {
      "id": "64",
      "name": "Skin the cat",
      "description": "Develop your joints mobility and expose yourself to new movement layers",
      "category": "1",
      "type": "2",
      "muscle_groups": "4,5,6",
      "rewards": "6.00",
      "repititions": "10",
      "duration": "10",
      "unit": "times",
      "equipment": "",
      "range_of_motion": " 1. Hands a little more than shoulder width apart\r\n2. Raise your knees to the chest\r\n3. continuing the movement until the feet pass up through the arms and over head into an inverted hang position.\r\n4. Continue to pass the feet round and down toward the ground into the extended 'skin the cat' position.\r\n5. Lift your hips and raise the legs back and over to the starting hang position. ",
      "video_tips": "        ",
      "pro_tips": " Put your hands closer together to ease up all back lever progressions.\r\nDo only half of the movement in the beginning, but fight for completion over time.\r\nIncorporate other static elements to challenge yourself during the movement as you master other skills.\r\n    ",
      "is_static": "0",
      "musclegroup_string": "Back, Arms, Core",
      "video": [
      {
      "id": "71",
      "path": "64_1454045043.mp4",
      "videothumbnail": "64_1454045043.jpg",
      "description": "Skin the cat"
      }
      ]
      }
      },
      {
      "id": "12",
      "row": "3",
      "exercise_id": "12",
      "duration": {
      "min": "20",
      "max": ""
      },
      "unit": "times",
      "is_completed": "0",
      "created_at": "2016-01-22 04:36:16",
      "updated_at": "2016-04-04 09:26:06",
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
      "is_static": "0",
      "musclegroup_string": "Shoulders, Chest, Triceps",
      "video": [
      {
      "id": "57",
      "path": "12_1453984139.mp4",
      "videothumbnail": "12_1453984139.jpg",
      "description": "Pushups"
      }
      ]
      }
      },
      {
      "id": "13",
      "row": "3",
      "exercise_id": "49",
      "duration": {
      "min": "30",
      "max": ""
      },
      "unit": "times",
      "is_completed": "0",
      "created_at": "2016-01-22 04:36:49",
      "updated_at": "2016-04-04 14:19:29",
      "exercise": {
      "id": "49",
      "name": "Side Triceps",
      "description": "Start with the basics of building triceps strength",
      "category": "1",
      "type": "1",
      "muscle_groups": "3",
      "rewards": "6.00",
      "repititions": "10",
      "duration": "10",
      "unit": "times",
      "equipment": "",
      "range_of_motion": " 1. Start with the body on your side\r\n2. Put one hand on your shoulder \r\n3. Press up with the other arm and hold in extension ",
      "video_tips": "          ",
      "pro_tips": " Avoid supporting the movement with your core muscle.      ",
      "is_static": "0",
      "musclegroup_string": "Triceps",
      "video": [
      {
      "id": "43",
      "path": "49_1454043404.mp4",
      "videothumbnail": "49_1454043404.jpg",
      "description": "Side Triceps"
      }
      ]
      }
      },
      {
      "id": "14",
      "row": "3",
      "exercise_id": "4",
      "duration": {
      "min": "60",
      "max": "90"
      },
      "unit": "seconds",
      "is_completed": "0",
      "created_at": "2016-01-22 04:37:32",
      "updated_at": "2016-04-04 14:02:11",
      "exercise": {
      "id": "4",
      "name": "Plank",
      "description": "The plank builds your isometric strength and helps sculpt your waistline.",
      "category": "1",
      "type": "1",
      "muscle_groups": "1,4,6,8",
      "rewards": "6.00",
      "repititions": "10",
      "duration": "10",
      "unit": "seconds",
      "equipment": "",
      "range_of_motion": "1. Get into pushup position on the floor.\r\n2. Now bend your elbows 90 degrees and rest your weight on your forearms. \r\n3. Hold the position for as long as you can.   ",
      "video_tips": "        ",
      "pro_tips": "Drive your chest away from the ground and spread your shoulder blades as much as you can.\r\nKeep a straight line, from head to toe. \r\nDon't collapse your lower back or reach your butt to the sky. Add movement to your plank, rock back and forth on your forearms and toes or shift from side to side.\r\nTry advanced variations with alternating sinlge leg support. \r\nStart with an incline plank if a straight plank is too hard in the beginning.  ",
      "is_static": "0",
      "musclegroup_string": "Shoulders, Back, Core, Full Body",
      "video": [
      {
      "id": "4",
      "path": "4_1453976855.mp4",
      "videothumbnail": "4_1453976855.jpg",
      "description": "Plank"
      }
      ]
      }
      },
      {
      "id": "15",
      "row": "3",
      "exercise_id": "36",
      "duration": {
      "min": "20",
      "max": ""
      },
      "unit": "times",
      "is_completed": "0",
      "created_at": "2016-01-22 04:37:57",
      "updated_at": "2016-04-04 11:12:49",
      "exercise": {
      "id": "36",
      "name": "High Jumps",
      "description": "Do high jumps as a part of restless HIIT workouts",
      "category": "1",
      "type": "2",
      "muscle_groups": "7",
      "rewards": "6.00",
      "repititions": "10",
      "duration": "10",
      "unit": "times",
      "equipment": "",
      "range_of_motion": "1. Start from a standing position\r\n2. Jump up and bring your knees to your chest",
      "video_tips": "    ",
      "pro_tips": "Land softly and exhale when the knees are up.\r\n  ",
      "is_static": "0",
      "musclegroup_string": "Legs",
      "video": [
      {
      "id": "33",
      "path": "36_1454042273.mp4",
      "videothumbnail": "36_1454042273.jpg",
      "description": "High Jumps"
      }
      ]
      }
      }
      ],
      "exercises": [],
      "workout": {
      "id": "10",
      "name": "Loki",
      "description": "A,E,B",
      "rounds": "1",
      "category": "1",
      "type": "1",
      "rewards": "330",
      "duration": "1440.00",
      "equipments": "Bar/Rings",
      "is_completed": 0,
      "exercises": {
      "round1": [
      {
      "id": "364",
      "workout_id": "10",
      "category": "1",
      "repititions": "15",
      "exercise_id": "66",
      "unit": "times",
      "round": "1",
      "created_at": "2016-01-19 05:35:04",
      "updated_at": "2016-04-04 14:31:38",
      "exercise": {
      "id": "69",
      "name": "Jumping Pullups",
      "description": "Expose yourself to packed shoulders and hang time",
      "category": "1",
      "type": "1",
      "muscle_groups": "1,5",
      "rewards": "6.00",
      "repititions": "10",
      "duration": "10",
      "unit": "times",
      "equipment": "",
      "range_of_motion": " 1. Grip a bar and jump into the top position of the pull-up exercise\r\n2. Straight legs in front of you. \r\n3. Slowly go down into a deadhang position ",
      "video_tips": "        ",
      "pro_tips": " A deadhang postion requires your shoulder blades down and towards the spine with arms being straight (retraction)\r\nAim for three second holds at the top and go down slowly ",
      "is_static": "0",
      "musclegroup_string": "Shoulders, Arms"
      },
      "is_completed": 0
      },
      {
      "id": "365",
      "workout_id": "10",
      "category": "1",
      "repititions": "120",
      "exercise_id": "4",
      "unit": "seconds",
      "round": "1",
      "created_at": "2016-01-19 05:35:24",
      "updated_at": "2016-04-04 14:02:11",
      "exercise": {
      "id": "4",
      "name": "Plank",
      "description": "The plank builds your isometric strength and helps sculpt your waistline.",
      "category": "1",
      "type": "1",
      "muscle_groups": "1,4,6,8",
      "rewards": "6.00",
      "repititions": "10",
      "duration": "10",
      "unit": "seconds",
      "equipment": "",
      "range_of_motion": "1. Get into pushup position on the floor.\r\n2. Now bend your elbows 90 degrees and rest your weight on your forearms. \r\n3. Hold the position for as long as you can.   ",
      "video_tips": "        ",
      "pro_tips": "Drive your chest away from the ground and spread your shoulder blades as much as you can.\r\nKeep a straight line, from head to toe. \r\nDon't collapse your lower back or reach your butt to the sky. Add movement to your plank, rock back and forth on your forearms and toes or shift from side to side.\r\nTry advanced variations with alternating sinlge leg support. \r\nStart with an incline plank if a straight plank is too hard in the beginning.  ",
      "is_static": "0",
      "musclegroup_string": "Shoulders, Back, Core, Full Body"
      },
      "is_completed": 0
      },
      {
      "id": "366",
      "workout_id": "10",
      "category": "1",
      "repititions": "50",
      "exercise_id": "49",
      "unit": "times",
      "round": "1",
      "created_at": "2016-01-19 05:35:49",
      "updated_at": "2016-04-04 14:19:29",
      "exercise": {
      "id": "49",
      "name": "Side Triceps",
      "description": "Start with the basics of building triceps strength",
      "category": "1",
      "type": "1",
      "muscle_groups": "3",
      "rewards": "6.00",
      "repititions": "10",
      "duration": "10",
      "unit": "times",
      "equipment": "",
      "range_of_motion": " 1. Start with the body on your side\r\n2. Put one hand on your shoulder \r\n3. Press up with the other arm and hold in extension ",
      "video_tips": "          ",
      "pro_tips": " Avoid supporting the movement with your core muscle.      ",
      "is_static": "0",
      "musclegroup_string": "Triceps"
      },
      "is_completed": 0
      },
      {
      "id": "367",
      "workout_id": "10",
      "category": "1",
      "repititions": "25",
      "exercise_id": "29",
      "unit": "times",
      "round": "1",
      "created_at": "2016-01-19 05:36:05",
      "updated_at": "2016-04-04 14:14:02",
      "exercise": {
      "id": "29",
      "name": "Tucked DF",
      "description": "Develop your core strength on the path to the hardest core exercise in history",
      "category": "1",
      "type": "2",
      "muscle_groups": "6",
      "rewards": "6.00",
      "repititions": "10",
      "duration": "10",
      "unit": "times",
      "equipment": "",
      "range_of_motion": " 1. Lie on a decline or flat bench and grab the edge of it behind your head with both hands. \r\n2. Tuck your knees to your chest.\r\n3. Slowly try to extend to bend legs and hold position as long as you can \r\n4. Repeat movement. ",
      "video_tips": "          ",
      "pro_tips": " Work it slowly and controlled.\r\nFocus to engage your core and lower back in all progressions. ",
      "is_static": "0",
      "musclegroup_string": "Core"
      },
      "is_completed": 0
      },
      {
      "id": "368",
      "workout_id": "10",
      "category": "1",
      "repititions": "50",
      "exercise_id": "9",
      "unit": "times",
      "round": "1",
      "created_at": "2016-01-19 05:36:21",
      "updated_at": "2016-04-04 09:22:17",
      "exercise": {
      "id": "9",
      "name": "Crunches",
      "description": "Do the most admired sixpack exercise in the world",
      "category": "1",
      "type": "1",
      "muscle_groups": "6",
      "rewards": "6.00",
      "repititions": "10",
      "duration": "10",
      "unit": "times",
      "equipment": "",
      "range_of_motion": "1. Starting position is with lying face up on the floor with knees bent. \r\n2. Move torso up and touch your knees with your hands\r\n3. Lower body to the floor and repeat\r\n  ",
      "video_tips": "    ",
      "pro_tips": "Do variations in tempo. Aim for one count up and three counts down.\r\nIf you have a tendency to interlace your fingers and yank your head, place your hands cross-chest.",
      "is_static": "0",
      "musclegroup_string": "Core"
      },
      "is_completed": 0
      },
      {
      "id": "369",
      "workout_id": "10",
      "category": "1",
      "repititions": "25",
      "exercise_id": "29",
      "unit": "times",
      "round": "1",
      "created_at": "2016-01-19 05:36:44",
      "updated_at": "2016-04-04 14:14:02",
      "exercise": {
      "id": "29",
      "name": "Tucked DF",
      "description": "Develop your core strength on the path to the hardest core exercise in history",
      "category": "1",
      "type": "2",
      "muscle_groups": "6",
      "rewards": "6.00",
      "repititions": "10",
      "duration": "10",
      "unit": "times",
      "equipment": "",
      "range_of_motion": " 1. Lie on a decline or flat bench and grab the edge of it behind your head with both hands. \r\n2. Tuck your knees to your chest.\r\n3. Slowly try to extend to bend legs and hold position as long as you can \r\n4. Repeat movement. ",
      "video_tips": "          ",
      "pro_tips": " Work it slowly and controlled.\r\nFocus to engage your core and lower back in all progressions. ",
      "is_static": "0",
      "musclegroup_string": "Core"
      },
      "is_completed": 0
      },
      {
      "id": "370",
      "workout_id": "10",
      "category": "1",
      "repititions": "50",
      "exercise_id": "49",
      "unit": "times",
      "round": "1",
      "created_at": "2016-01-19 05:37:38",
      "updated_at": "2016-04-04 14:19:29",
      "exercise": {
      "id": "49",
      "name": "Side Triceps",
      "description": "Start with the basics of building triceps strength",
      "category": "1",
      "type": "1",
      "muscle_groups": "3",
      "rewards": "6.00",
      "repititions": "10",
      "duration": "10",
      "unit": "times",
      "equipment": "",
      "range_of_motion": " 1. Start with the body on your side\r\n2. Put one hand on your shoulder \r\n3. Press up with the other arm and hold in extension ",
      "video_tips": "          ",
      "pro_tips": " Avoid supporting the movement with your core muscle.      ",
      "is_static": "0",
      "musclegroup_string": "Triceps"
      },
      "is_completed": 0
      },
      {
      "id": "371",
      "workout_id": "10",
      "category": "1",
      "repititions": "120",
      "exercise_id": "4",
      "unit": "seconds",
      "round": "1",
      "created_at": "2016-01-19 05:37:58",
      "updated_at": "2016-04-04 14:02:11",
      "exercise": {
      "id": "4",
      "name": "Plank",
      "description": "The plank builds your isometric strength and helps sculpt your waistline.",
      "category": "1",
      "type": "1",
      "muscle_groups": "1,4,6,8",
      "rewards": "6.00",
      "repititions": "10",
      "duration": "10",
      "unit": "seconds",
      "equipment": "",
      "range_of_motion": "1. Get into pushup position on the floor.\r\n2. Now bend your elbows 90 degrees and rest your weight on your forearms. \r\n3. Hold the position for as long as you can.   ",
      "video_tips": "        ",
      "pro_tips": "Drive your chest away from the ground and spread your shoulder blades as much as you can.\r\nKeep a straight line, from head to toe. \r\nDon't collapse your lower back or reach your butt to the sky. Add movement to your plank, rock back and forth on your forearms and toes or shift from side to side.\r\nTry advanced variations with alternating sinlge leg support. \r\nStart with an incline plank if a straight plank is too hard in the beginning.  ",
      "is_static": "0",
      "musclegroup_string": "Shoulders, Back, Core, Full Body"
      },
      "is_completed": 0
      },
      {
      "id": "372",
      "workout_id": "10",
      "category": "1",
      "repititions": "15",
      "exercise_id": "66",
      "unit": "times",
      "round": "1",
      "created_at": "2016-01-19 05:38:13",
      "updated_at": "2016-04-04 14:31:38",
      "exercise": {
      "id": "69",
      "name": "Jumping Pullups",
      "description": "Expose yourself to packed shoulders and hang time",
      "category": "1",
      "type": "1",
      "muscle_groups": "1,5",
      "rewards": "6.00",
      "repititions": "10",
      "duration": "10",
      "unit": "times",
      "equipment": "",
      "range_of_motion": " 1. Grip a bar and jump into the top position of the pull-up exercise\r\n2. Straight legs in front of you. \r\n3. Slowly go down into a deadhang position ",
      "video_tips": "        ",
      "pro_tips": " A deadhang postion requires your shoulder blades down and towards the spine with arms being straight (retraction)\r\nAim for three second holds at the top and go down slowly ",
      "is_static": "0",
      "musclegroup_string": "Shoulders, Arms"
      },
      "is_completed": 0
      }
      ]
      },
      "exercise_category": 1
      },
      "coach_workout_rounds": 1,
      "workout_intensity": 1,
      "hiit": [
      {
      "id": 2,
      "intensity": 4,
      "is_completed": 0,
      "replacement": [
      {
      "round1": [
      {
      "name": "Burpee",
      "duration": 10,
      "unit": "times",
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
      "is_static": "0",
      "musclegroup_string": "Full Body",
      "video": [
      {
      "id": "28",
      "path": "31_1454041910.mp4",
      "videothumbnail": "31_1454041910.jpg",
      "description": "Burpee"
      }
      ]
      }
      },
      {
      "name": "Rest",
      "duration": 10,
      "unit": "seconds",
      "exercise": []
      }
      ],
      "round2": [
      {
      "name": "High Jumps",
      "duration": 25,
      "unit": "times",
      "exercise": {
      "id": "36",
      "name": "High Jumps",
      "description": "Do high jumps as a part of restless HIIT workouts",
      "category": "1",
      "type": "2",
      "muscle_groups": "7",
      "rewards": "6.00",
      "repititions": "10",
      "duration": "10",
      "unit": "times",
      "equipment": "",
      "range_of_motion": "1. Start from a standing position\r\n2. Jump up and bring your knees to your chest",
      "video_tips": "    ",
      "pro_tips": "Land softly and exhale when the knees are up.\r\n  ",
      "is_static": "0",
      "musclegroup_string": "Legs",
      "video": [
      {
      "id": "33",
      "path": "36_1454042273.mp4",
      "videothumbnail": "36_1454042273.jpg",
      "description": "High Jumps"
      }
      ]
      }
      },
      {
      "name": "Rest",
      "duration": 10,
      "unit": "seconds",
      "exercise": []
      }
      ],
      "round3": [
      {
      "name": "Knee Raises",
      "duration": 15,
      "unit": "times",
      "exercise": {
      "id": "57",
      "name": "Knee Raises",
      "description": "Develop grip and core strength and get used to slow and controlled moves",
      "category": "1",
      "type": "2",
      "muscle_groups": "4,6,7",
      "rewards": "6.00",
      "repititions": "10",
      "duration": "10",
      "unit": "times",
      "equipment": "",
      "range_of_motion": "1. Start from a deadhang position with your arms and legs fully extended, and feet off the ground.  \r\n2. Raise your knees up towards your chest as high as possible. \r\n3. Hold for a brief moment and slowly return to the starting position. \r\n4. Repeat for required repetitions. ",
      "video_tips": "    ",
      "pro_tips": "Avoid using momentum or swinging during the exercise. \r\nPerform the knee raise slowly and controlled.",
      "is_static": "0",
      "musclegroup_string": "Back, Core, Legs",
      "video": [
      {
      "id": "67",
      "path": "57_1454044213.mp4",
      "videothumbnail": "57_1454044213.jpg",
      "description": "Knee Raises"
      }
      ]
      }
      },
      {
      "name": "Rest",
      "duration": 10,
      "unit": "seconds",
      "exercise": []
      }
      ]
      }
      ],
      "replacement_round_count": 3
      }
      ],
      "stretching": [
      {
      "id": "1",
      "exercise_id": "Superman",
      "duration": {
      "min": 6,
      "max": 13
      },
      "unit": "times",
      "is_completed": "0",
      "created_at": "2016-01-22 07:10:31",
      "updated_at": "2016-01-22 07:10:31"
      },
      {
      "id": "2",
      "exercise_id": "Lower Back Strength",
      "duration": {
      "min": 38,
      "max": 63
      },
      "unit": "times",
      "is_completed": "0",
      "created_at": "2016-01-22 07:15:02",
      "updated_at": "2016-01-22 07:15:02"
      },
      {
      "id": "3",
      "exercise_id": "Upper Dog",
      "duration": {
      "min": 38,
      "max": 75
      },
      "unit": "seconds",
      "is_completed": "0",
      "created_at": "2016-01-22 07:16:03",
      "updated_at": "2016-01-22 07:16:03"
      },
      {
      "id": "4",
      "exercise_id": "Child's Pose",
      "duration": {
      "min": 38,
      "max": 75
      },
      "unit": "seconds",
      "is_completed": "0",
      "created_at": "2016-01-22 07:16:46",
      "updated_at": "2016-01-22 07:16:46"
      },
      {
      "id": "5",
      "exercise_id": "L-sit on the floor",
      "duration": {
      "min": 38,
      "max": 75
      },
      "unit": "seconds",
      "is_completed": "0",
      "created_at": "2016-01-22 07:17:13",
      "updated_at": "2016-01-22 07:17:13"
      },
      {
      "id": "6",
      "exercise_id": "Good morning",
      "duration": {
      "min": 38,
      "max": 75
      },
      "unit": "seconds",
      "is_completed": "0",
      "created_at": "2016-01-22 07:17:43",
      "updated_at": "2016-01-22 07:17:43"
      },
      {
      "id": "7",
      "exercise_id": "Chest Opener",
      "duration": {
      "min": 38,
      "max": 75
      },
      "unit": "seconds",
      "is_completed": "0",
      "created_at": "2016-01-22 07:19:32",
      "updated_at": "2016-01-22 07:19:32"
      },
      {
      "id": "8",
      "exercise_id": "Triceps Stretc",
      "duration": {
      "min": 38,
      "max": 75
      },
      "unit": "seconds",
      "is_completed": "0",
      "created_at": "2016-01-22 07:19:56",
      "updated_at": "2016-01-22 07:19:56"
      },
      {
      "id": "9",
      "exercise_id": "Hands Back",
      "duration": {
      "min": 38,
      "max": 75
      },
      "unit": "seconds",
      "is_completed": "0",
      "created_at": "2016-01-22 07:20:19",
      "updated_at": "2016-01-22 07:20:19"
      },
      {
      "id": "10",
      "exercise_id": "Shoulder Stretch",
      "duration": {
      "min": 38,
      "max": 75
      },
      "unit": "seconds",
      "is_completed": "0",
      "created_at": "2016-01-22 07:20:45",
      "updated_at": "2016-01-22 07:20:45"
      }
      ],
      "status": "pending"
      }
      },
      "category": "professional",
      "muscle_groups": "",
      "limitations": "",
      "goal_option": "0",
      "feedback": "0",
      "created_at": "2016-05-27 06:54:49",
      "updated_at": "2016-06-14 12:50:18",
      "musclegroup_string": "",
      "goaloption_string": "",
      "description": "Strive for progress"
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
                $coach = DB::table('coaches')->where('user_id', $request->user_id)->first();

                if (!is_null($coach)) {

                    $coach->musclegroup_string = Coach::musclegroupString($coach->muscle_groups);

                    $coach->limitations = Coach::musclegroupString($coach->limitations);

                    $coach->goaloption_string = Coach::goaloptionString($coach->goal_option);

                    $coach->exercises = json_decode($coach->exercises, true);

                    $coach->exercises = array_map(function($dayExercise) {
                        $dayExercise['fundumentals'] = array_map(function($fundumental) {
                            $funduExe = Exercise::where('id', $fundumental['exercise_id'])->with('video')->first();
                            $fundumental['exercise'] = $funduExe->toArray();
                            return $fundumental;
                        }, $dayExercise['fundumentals']);

                        if (isset($dayExercise['workout']['exercises'])) {
                            $dayExercise['workout']['exercises'] = array_map(function($rounds) {
                                $rounds = array_map(function($roundExercise) {
                                    $exercise = Exercise::where('id', $roundExercise['exercise_id'])->with('video')->first();
                                    $roundExercise['exercise'] = $exercise->toArray();
                                    return $roundExercise;
                                }, $rounds);
                                return $rounds;
                            }, $dayExercise['workout']['exercises']);
                        }

                        return $dayExercise;
                    }, $coach->exercises);

                    $coachStatus = DB::table('coach_status')->where('user_id', $request->user_id)->where('coach_id', $coach->id)->first();

                    if ($coachStatus->week <= 15) {
                        $coach->description = DB::table('coach_descriptions')->where('week', $coachStatus->week)->pluck('description');
                    } else {
                        $coach->description = DB::table('coach_descriptions')->where('week', 15)->pluck('description');
                    }

                    $currentTimestamp = date("Y-m-d H:i:s", time());

//                    $currentTimestamp = '2016-09-28 18:30:01';
                    $offset = (isset($request->tz_offset) && $request->tz_offset != '' && $request->tz_offset != NULL) ? $request->tz_offset : '+00:00';
                    $offsetArr = explode(":", $offset);
                    $operator = (substr($offsetArr[0], 0, 1) == '+') ? '+' : '-';
                    $offsetHrs = $operator . substr($offsetArr[0], 1) . ' hours';
                    $offsetMin = $operator . $offsetArr[1] . ' minutes';

                    $currentTimestamp = date("Y-m-d H:i:s", strtotime($currentTimestamp . ' ' . $offsetHrs));

                    $coachUpdatedDate = date('Y-m-d H:i:s', strtotime($coachStatus->updated_at . ' ' . $offsetHrs));

                    if ($offsetArr[1] != '00'):
                        $currentTimestamp = date("Y-m-d H:i:s", strtotime($currentTimestamp . ' ' . $offsetMin));
                        $coachUpdatedDate = date('Y-m-d H:i:s', strtotime($coachUpdatedDate . ' ' . $offsetMin));
                    endif;

                    $coachNextDay = strtotime(date('Y-m-d', strtotime($coachUpdatedDate)) . ' 00:00:01 + 1 days');

                    $currentTimestampNum = strtotime($currentTimestamp);

                    $dayStatus = json_decode($coachStatus->day_status, true);

                    $weekStatus = json_decode($coachStatus->week_status, true);

                    if (isset($coach->exercises) && !empty($coach->exercises)) {
                        foreach ($coach->exercises as $ekey => $exercise) {
                            if (in_array((int) (str_replace('day', '', $ekey)), $dayStatus) && $dayStatus[(int) (str_replace('day', '', $ekey))] == 1) {
                                $coach->exercises[$ekey]['status'] = 'completed';
                            } else {
                                $coach->exercises[$ekey]['status'] = 'pending';
                            }
                        }
                    }

                    if ($coachStatus->need_update == 1) {
                        //User feedback required
                        return response()->json([
                                'status' => 1,
                                'message' => 'user_feedback_required',
                                'coach_day' => $coachStatus->day,
                                'coach_week' => $coachStatus->week,
                                'is_subscribed' => $user->is_subscribed,
                                'need_update' => 1,
                                'week_status' => $weekStatus,
                                'day_status' => $dayStatus,
                                'week_points' => DB::table('coach_points')->where('user_id', $request->user_id)->where('week', $coachStatus->week)->sum('points'),
                                'coach' => $coach,
                                'last_finished_date' => $coachUpdatedDate,
                                'urls' => config('urls.urls')], 200);
                    } else {
//                        if ($coachStatus->need_update == 1) {
//                            return response()->json([
//                                    'status' => 1,
//                                    'message' => 'already_completed_week_workouts',
//                                    'coach_day' => $coachStatus->day,
//                                    'coach_week' => $coachStatus->week,
//                                    'is_subscribed' => $user->is_subscribed,
//                                    'need_update' => 1,
//                                    'week_status' => $weekStatus,
//                                    'day_status' => $dayStatus,
//                                    'week_points' => DB::table('coach_points')->where('user_id', $request->user_id)->where('week', $coachStatus->week)->sum('points'),
//                                    'coach' => $coach,
//                                    'urls' => config('urls.urls')], 200);
//                        }

                        if ($coachStatus->need_update == 0) {
                            if ($dayStatus[$coachStatus->day] == 1) {
//                                Development
//                                $coachNextDay = strtotime($coachStatus->updated_at . ' + 5 Minutes');
                                if ($coachNextDay > $currentTimestampNum) {
                                    return response()->json([
                                            'status' => 1,
                                            'message' => 'already_completed_day_workouts',
                                            'coach_day' => $coachStatus->day,
                                            'coach_week' => $coachStatus->week,
                                            'is_subscribed' => $user->is_subscribed,
                                            'need_update' => 0,
                                            'week_status' => $weekStatus,
                                            'day_status' => $dayStatus,
                                            'week_points' => DB::table('coach_points')->where('user_id', $request->user_id)->where('week', $coachStatus->week)->sum('points'),
                                            'coach' => $coach,
                                            'last_finished_date' => $coachUpdatedDate,
                                            'urls' => config('urls.urls')], 200);
                                } else {
                                    return response()->json([
                                            'status' => 1,
                                            'message' => 'coach_exercises',
                                            'coach_day' => $coachStatus->day + 1,
                                            'coach_week' => $coachStatus->week,
                                            'is_subscribed' => $user->is_subscribed,
                                            'need_update' => 0,
                                            'week_status' => $weekStatus,
                                            'day_status' => $dayStatus,
                                            'week_points' => DB::table('coach_points')->where('user_id', $request->user_id)->where('week', $coachStatus->week)->sum('points'),
                                            'coach' => $coach,
                                            'last_finished_date' => $coachUpdatedDate,
                                            'urls' => config('urls.urls')], 200);
                                }
                            } else {
                                return response()->json([
                                        'status' => 1,
                                        'message' => 'coach_exercises',
                                        'coach_day' => $coachStatus->day,
                                        'coach_week' => $coachStatus->week,
                                        'is_subscribed' => $user->is_subscribed,
                                        'need_update' => 0,
                                        'week_status' => $weekStatus,
                                        'day_status' => $dayStatus,
                                        'week_points' => DB::table('coach_points')->where('user_id', $request->user_id)->where('week', $coachStatus->week)->sum('points'),
                                        'coach' => $coach,
                                        'last_finished_date' => $coachUpdatedDate,
                                        'urls' => config('urls.urls')], 200);
                            }
                        }
                    }
                } else {
                    return response()->json([
                            'status' => 1,
                            'message' => 'coach_not_found',
                            'coach_day' => 0,
                            'coach_week' => 0,
                            'is_subscribed' => $user->is_subscribed,
                            'need_update' => 0,
                            'coach' => [],
                            'urls' => config('urls.urls')], 200);
                }
            } else {
                return response()->json(['status' => 0, 'error' => 'user_not_exists'], 500);
            }
        }
    }

    /**
     * @api {post} /coach/getfundumentals getFundumentals
     * @apiName getFundumentals
     * @apiGroup Coach
     * @apiParam {Number} user_id Id of user *required
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
                ['exercise_id' => 3, 'duration' => 10, 'test_done' => 0],
                ['exercise_id' => 32, 'duration' => 15, 'test_done' => 0],
                ['exercise_id' => 72, 'duration' => 45, 'test_done' => 0],
                ['exercise_id' => 48, 'duration' => 20, 'test_done' => 0]
            ]
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
     * @apiParam {Number} user_id Id of user *required
     * @apiParam {Number} day Id of user *required
     * @apiSuccess {String} success.
     * @apiSuccessExample Success-Response:
     * HTTP/1.1 200 OK
     * {
      "status": 1,
      "message": "successfully finished day workouts",
      "coach_day": "1",
      "coach_week": "1",
      "is_subscribed": 0,
      "need_update": 1,
      "week_status": {
      "1": 1
      },
      "day_status": {
      "1": 1,
      "2": 1
      },
      "week_points": 0
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

                $coachStatus = DB::table('coach_status')->where('user_id', $request->user_id)->first();

                $exercisesArray = json_decode($coach->exercises, true);

                $dayExerciseArray = $exercisesArray['day' . $coachStatus->day];

                $exercisesArray['day' . $coachStatus->day] = $this->updateDayExercises($dayExerciseArray);

                for ($i = 1; $i <= $coach->days; $i++) {
                    if ($i <= $request->day) {
                        $exercisesArray['day' . $i]['is_completed'] = 1;
                        $exercisesArray['day' . $i]['status'] = 'completed';
                    } else {
                        $exercisesArray['day' . $i]['is_completed'] = 0;
                        $exercisesArray['day' . $i]['status'] = 'pending';
                    }
                }

                Coach::where('user_id', $request->user_id)->update([
                    'exercises' => json_encode($exercisesArray)
                ]);

                if (is_null($coachStatus->day_status) || $coachStatus->day_status == '') {
                    for ($i = 1; $i <= $coach->days; $i++) {
                        if ($dKay <= $request->day) {
                            $statusArray[$i] = 1;
                        } else {
                            $statusArray[$i] = 0;
                        }
                    }
                    $data['day_status'] = json_encode($statusArray);
                } else {
                    $statusArray = json_decode($coachStatus->day_status, TRUE);

                    foreach ($statusArray as $dKay => $status) {
                        if ($dKay <= $request->day) {
                            $statusArray[$dKay] = 1;
                        } else {
                            $statusArray[$dKay] = 0;
                        }
                    }
                    $data['day_status'] = json_encode($statusArray);
                }
                $data['day'] = $request->day;

                DB::table('coach_status')
                    ->where('user_id', $request->user_id)
                    ->where('coach_id', $coach->id)
                    ->update($data);

                $coach = DB::table('coaches')->where('user_id', $request->user_id)->first();

                $coach->musclegroup_string = Coach::musclegroupString($coach->muscle_groups);

                $coach->goaloption_string = Coach::goaloptionString($coach->goal_option);

                $coachStatus = DB::table('coach_status')->where('user_id', $request->user_id)->where('coach_id', $coach->id)->first();

                if ($coachStatus->week <= 15) {
                    $coach->description = DB::table('coach_descriptions')->where('week', $coachStatus->week)->pluck('description');
                } else {
                    $coach->description = DB::table('coach_descriptions')->where('week', 15)->pluck('description');
                }

                $dayStatus = json_decode($coachStatus->day_status, true);

                $weekStatus = json_decode($coachStatus->week_status, true);


                return response()->json([
                        'status' => 1,
                        'message' => 'successfully finished day workouts',
                        'coach_day' => $coachStatus->day,
                        'coach_week' => $coachStatus->week,
                        'is_subscribed' => $user->is_subscribed,
                        'need_update' => 0,
                        'week_status' => $weekStatus,
                        'day_status' => $dayStatus,
                        'musclegroup_string' => $coach->musclegroup_string,
                        'week_points' => DB::table('coach_points')->where('user_id', $request->user_id)->where('week', $coachStatus->week)->sum('points'),
                        ], 200);
            } else {
                return response()->json(['status' => 0, 'error' => 'user_not_exists'], 500);
            }
        }
    }

    /**
     * @api {post} /coach/finishweek finishCoachWeekWorkouts
     * @apiName finishCoachWeekWorkouts
     * @apiGroup Coach
     * @apiParam {Number} user_id Id of user *required
     * @apiParam {Number} week *required
     * @apiSuccess {String} success.
     * @apiSuccessExample Success-Response:
     * HTTP/1.1 200 OK
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
    public function finishCoachWeekWorkouts(Request $request)
    {
        if (!isset($request->user_id) || ($request->user_id == null)) {
            return response()->json(["status" => "0", "error" => "The user_id field is required"]);
        } elseif (!isset($request->week) || ($request->week == null)) {
            return response()->json(["status" => "0", "error" => "The day field is required"]);
        } else {
            $user = User::where('id', '=', $request->input('user_id'))->first();
            if (!is_null($user)) {
                $coach = Coach::where('user_id', $request->user_id)->first();

                $coachStatus = DB::table('coach_status')->where('user_id', $request->user_id)->first();

                $statusArray = [];

                for ($i = 1; $i <= $request->week; $i++) {
                    if ($i <= $request->week) {
                        $statusArray[$i] = 1;
                    } else {
                        $statusArray[$i] = 0;
                    }
                }

                $data['week_status'] = json_encode($statusArray);

                $data['need_update'] = 1;

                $data['week'] = $request->week;

                DB::table('coach_status')
                    ->where('user_id', $request->user_id)
                    ->update($data);

                $coach = DB::table('coaches')->where('user_id', $request->user_id)->first();

                $coach->musclegroup_string = Coach::musclegroupString($coach->muscle_groups);

                $coach->goaloption_string = Coach::goaloptionString($coach->goal_option);

                $coachStatus = DB::table('coach_status')->where('user_id', $request->user_id)->where('coach_id', $coach->id)->first();

                if ($coachStatus->week <= 15) {
                    $coach->description = DB::table('coach_descriptions')->where('week', $coachStatus->week)->pluck('description');
                } else {
                    $coach->description = DB::table('coach_descriptions')->where('week', 15)->pluck('description');
                }

                $dayStatus = json_decode($coachStatus->day_status, true);

                $weekStatus = json_decode($coachStatus->week_status, true);

                return response()->json([
                        'status' => 1,
                        'message' => 'successfully finished week workouts',
                        'coach_day' => $coachStatus->day,
                        'coach_week' => $coachStatus->week,
                        'is_subscribed' => $user->is_subscribed,
                        'need_update' => $coachStatus->need_update,
                        'week_status' => $weekStatus,
                        'day_status' => $dayStatus,
                        'musclegroup_string' => $coach->musclegroup_string,
                        'goaloption_string' => $coach->goaloption_string,
                        'week_points' => DB::table('coach_points')->where('user_id', $request->user_id)->where('week', $coachStatus->week)->sum('points'),
                        ], 200);
            } else {
                return response()->json(['status' => 0, 'error' => 'user_not_exists'], 500);
            }
        }
    }

    public function updateDayExercises($dayExercise)
    {

        if (isset($dayExercise['exercises']) && count($dayExercise['exercises']) > 0) {
            foreach ($dayExercise['exercises'] as $fKey => $exercise) {
                if (!empty($exercise)) {
                    $dayExercise['exercises'][$fKey]['is_completed'] = 1;
                }
            }
        }

        if (isset($dayExercise['workout']) && count($dayExercise['workout'] > 0)) {
            if (!empty($dayExercise['workout'])) {
                $dayExercise['workout']['is_completed'] = 1;
            }
        }

        if (isset($dayExercise['hiit']) && count($dayExercise['hiit']) > 0) {
            if (!empty($dayExercise['hiit'])) {
                foreach ($dayExercise['hiit'] as $hKey => $hiit) {
                    $dayExercise['hiit'][$hKey]['is_completed'] = 1;
                }
            }
        }

        return $dayExercise;
    }

    /**
     * @api {post} /coach/preparecoach prepareCoach
     * @apiName prepareCoach
     * @apiGroup Coach
     * @apiParam {Number} user_id Id of user *required
     * @apiParam {Number} test status of test exercises json encoded array of exercise ids and statuses [{"exercise_id":67,"test_done":1},{"exercise_id":45,"test_done":1},{"exercise_id":4,"test_done":1},{"exercise_id":12,"test_done":1}] *required
     * @apiParam {Number} days number of workout days per week *required
     * @apiParam {String} [muscle_groups] user muscle groups preferences comma seperated ids 1,5,6 etc.
     * @apiParam {String} [limitations] user muscle groups preferences comma seperated ids 1,5,6 etc.
     * @apiParam {String} feedback user feedback json_encoded array {"67":2,"45":1,"4":2,"12":3} 1- I can do way more, 2 - I can do more, 3 - It was ok *required
     * @apiParam {String} [focus] on redo coach user has the option to change focus. Values 1- Lean, 2-Athletic, 3- Strength
     * @apiSuccess {String} success.
     * @apiSuccessExample Success-Response:
     * HTTP/1.1 200 OK
     * {
      "status": 1,
      "message": "coach_exercises",
      "coach_day": "1",
      "coach_week": "1",
      "is_subscribed": 1,
      "need_update": "0",
      "week_status": {
      "1": 0
      },
      "day_status": {
      "1": 0,
      "2": 0
      },
      "week_points": 0,
      "coach": {
      "id": "532",
      "user_id": "100",
      "focus": "1",
      "height": "0.00",
      "weight": "0.00",
      "days": "2",
      "exercises": {
      "day1": {
      "warmup": [
      {
      "id": "1",
      "name": "wall extensions",
      "duration": {
      "min": "10",
      "max": "20"
      },
      "unit": "times",
      "created_at": "2016-01-21 08:55:06",
      "updated_at": "2016-01-21 08:55:06",
      "is_completed": 0
      },
      {
      "id": "2",
      "name": "band dislocates",
      "duration": {
      "min": "10",
      "max": "20"
      },
      "unit": "times",
      "created_at": "2016-01-21 08:57:38",
      "updated_at": "2016-01-21 08:57:38",
      "is_completed": 0
      },
      {
      "id": "3",
      "name": "cat-camels",
      "duration": {
      "min": "10",
      "max": "20"
      },
      "unit": "times",
      "created_at": "2016-01-21 09:00:39",
      "updated_at": "2016-01-21 09:00:39",
      "is_completed": 0
      },
      {
      "id": "4",
      "name": "scapular shrugs",
      "duration": {
      "min": "10",
      "max": "20"
      },
      "unit": "times",
      "created_at": "2016-01-21 09:01:01",
      "updated_at": "2016-01-21 09:01:01",
      "is_completed": 0
      },
      {
      "id": "5",
      "name": "full body circles",
      "duration": {
      "min": "10",
      "max": "20"
      },
      "unit": "times",
      "created_at": "2016-01-21 09:01:26",
      "updated_at": "2016-01-21 09:01:26",
      "is_completed": 0
      },
      {
      "id": "6",
      "name": "Jumping Jacks",
      "duration": {
      "min": "100",
      "max": ""
      },
      "unit": "seconds",
      "created_at": "2016-01-21 09:04:52",
      "updated_at": "2016-01-21 09:04:52",
      "is_completed": 0
      },
      {
      "id": "7",
      "name": "Arm rotations",
      "duration": {
      "min": "120",
      "max": ""
      },
      "unit": "times",
      "created_at": "2016-01-21 09:05:29",
      "updated_at": "2016-01-21 09:05:29",
      "is_completed": 0
      },
      {
      "id": "8",
      "name": "High Knees",
      "duration": {
      "min": "50",
      "max": ""
      },
      "unit": "times",
      "created_at": "2016-01-21 09:06:02",
      "updated_at": "2016-01-21 09:06:02",
      "is_completed": 0
      },
      {
      "id": "9",
      "name": "Shouder rolls",
      "duration": {
      "min": "20",
      "max": ""
      },
      "unit": "times",
      "created_at": "2016-01-21 09:06:34",
      "updated_at": "2016-01-21 09:06:34",
      "is_completed": 0
      }
      ],
      "is_completed": 0,
      "fundumentals": [
      {
      "id": "27",
      "row": "1",
      "exercise_id": "1",
      "duration": {
      "min": "5",
      "max": "8"
      },
      "unit": "times",
      "is_completed": "0",
      "created_at": "2016-08-08 14:04:33",
      "updated_at": "2016-08-11 04:55:05",
      "exercise": {
      "id": "1",
      "name": "Eccentric Pull-ups",
      "description": "Eccentric Pull-ups",
      "category": "1",
      "type": "1",
      "muscle_groups": "",
      "rewards": "5.00",
      "repititions": "1",
      "duration": "1",
      "unit": "times",
      "equipment": "",
      "range_of_motion": "1) Start with feet on the ground 2) Jump into pullup, chin above bar level 3) Hold position briefly 4) Slow & controlled eccentric movement into starting position",
      "video_tips": "",
      "pro_tips": "",
      "video_tips_html": "",
      "pro_tips_html": "",
      "range_of_motion_html": "<p>1) Start with feet on the ground<br /> 2) Jump into pullup, chin above bar level<br /> 3) Hold position briefly<br /> 4) Slow &amp; controlled eccentric movement into starting position</p>",
      "is_static": "0",
      "musclegroup_string": "",
      "video": []
      }
      },
      {
      "id": "28",
      "row": "1",
      "exercise_id": "47",
      "duration": {
      "min": "12",
      "max": "15"
      },
      "unit": "times",
      "is_completed": "0",
      "created_at": "2016-08-08 14:06:32",
      "updated_at": "2016-08-08 14:06:32",
      "exercise": {
      "id": "47",
      "name": "Incline Pushups",
      "description": "Incline Pushups",
      "category": "1",
      "type": "1",
      "muscle_groups": "",
      "rewards": "5.00",
      "repititions": "1",
      "duration": "1",
      "unit": "times",
      "equipment": "",
      "range_of_motion": "",
      "video_tips": "",
      "pro_tips": "",
      "video_tips_html": "",
      "pro_tips_html": "",
      "range_of_motion_html": "",
      "is_static": "0",
      "musclegroup_string": "",
      "video": []
      }
      },
      {
      "id": "29",
      "row": "1",
      "exercise_id": "16",
      "duration": {
      "min": "8",
      "max": "12"
      },
      "unit": "times",
      "is_completed": "0",
      "created_at": "2016-08-08 14:07:09",
      "updated_at": "2016-08-08 14:07:09",
      "exercise": {
      "id": "16",
      "name": "Bench Dips",
      "description": "Bench Dips",
      "category": "1",
      "type": "1",
      "muscle_groups": "",
      "rewards": "5.00",
      "repititions": "1",
      "duration": "1",
      "unit": "times",
      "equipment": "",
      "range_of_motion": "",
      "video_tips": "",
      "pro_tips": "",
      "video_tips_html": "",
      "pro_tips_html": "",
      "range_of_motion_html": "",
      "is_static": "0",
      "musclegroup_string": "",
      "video": [
      {
      "id": "83",
      "path": "100_1470654597.mp4",
      "videothumbnail": "100_1470654597.jpg",
      "description": "Bench Dips"
      }
      ]
      }
      },
      {
      "id": "30",
      "row": "1",
      "exercise_id": "86",
      "duration": {
      "min": "10",
      "max": "15"
      },
      "unit": "times",
      "is_completed": "0",
      "created_at": "2016-08-08 14:08:12",
      "updated_at": "2016-08-08 14:08:12",
      "exercise": {
      "id": "86",
      "name": "Knee Raises",
      "description": "Knee Raises",
      "category": "1",
      "type": "1",
      "muscle_groups": "",
      "rewards": "5.00",
      "repititions": "1",
      "duration": "1",
      "unit": "times",
      "equipment": "",
      "range_of_motion": "",
      "video_tips": "",
      "pro_tips": "",
      "video_tips_html": "",
      "pro_tips_html": "",
      "range_of_motion_html": "",
      "is_static": "0",
      "musclegroup_string": "",
      "video": []
      }
      },
      {
      "id": "31",
      "row": "1",
      "exercise_id": "37",
      "duration": {
      "min": "15",
      "max": "20"
      },
      "unit": "times",
      "is_completed": "0",
      "created_at": "2016-08-08 14:09:52",
      "updated_at": "2016-08-08 14:09:52",
      "exercise": {
      "id": "37",
      "name": "Climbers",
      "description": "Climbers",
      "category": "1",
      "type": "1",
      "muscle_groups": "",
      "rewards": "5.00",
      "repititions": "1",
      "duration": "1",
      "unit": "times",
      "equipment": "",
      "range_of_motion": "",
      "video_tips": "",
      "pro_tips": "",
      "video_tips_html": "",
      "pro_tips_html": "",
      "range_of_motion_html": "",
      "is_static": "0",
      "musclegroup_string": "",
      "video": []
      }
      }
      ],
      "exercises": [],
      "workout": {
      "id": "2",
      "name": "Vali",
      "description": "",
      "rounds": "3",
      "category": "2",
      "type": "1",
      "rewards": "330",
      "duration": "100.00",
      "equipments": "BAR/RINGS",
      "is_repsandsets": "0",
      "created_at": "2016-08-03 06:24:47",
      "is_completed": 0,
      "progression_string": "",
      "exercises": {
      "round1": [
      {
      "id": "1260",
      "workout_id": "2",
      "category": "1",
      "repititions": "8",
      "exercise_id": "1",
      "unit": "times",
      "round": "1",
      "sets": "0",
      "created_at": "2016-08-04 07:13:49",
      "updated_at": "2016-08-11 04:55:05",
      "exercise": {
      "id": "1",
      "name": "Eccentric Pull-ups",
      "description": "Eccentric Pull-ups",
      "category": "1",
      "type": "1",
      "muscle_groups": "",
      "rewards": "5.00",
      "repititions": "1",
      "duration": "1",
      "unit": "times",
      "equipment": "",
      "range_of_motion": "1) Start with feet on the ground 2) Jump into pullup, chin above bar level 3) Hold position briefly 4) Slow & controlled eccentric movement into starting position",
      "video_tips": "",
      "pro_tips": "",
      "video_tips_html": "",
      "pro_tips_html": "",
      "range_of_motion_html": "<p>1) Start with feet on the ground<br /> 2) Jump into pullup, chin above bar level<br /> 3) Hold position briefly<br /> 4) Slow &amp; controlled eccentric movement into starting position</p>",
      "is_static": "0",
      "musclegroup_string": "",
      "video": []
      },
      "is_completed": 0
      },
      {
      "id": "1263",
      "workout_id": "2",
      "category": "1",
      "repititions": "20",
      "exercise_id": "37",
      "unit": "times",
      "round": "1",
      "sets": "0",
      "created_at": "2016-08-04 07:15:51",
      "updated_at": "2016-08-04 11:56:46",
      "exercise": {
      "id": "37",
      "name": "Climbers",
      "description": "Climbers",
      "category": "1",
      "type": "1",
      "muscle_groups": "",
      "rewards": "5.00",
      "repititions": "1",
      "duration": "1",
      "unit": "times",
      "equipment": "",
      "range_of_motion": "",
      "video_tips": "",
      "pro_tips": "",
      "video_tips_html": "",
      "pro_tips_html": "",
      "range_of_motion_html": "",
      "is_static": "0",
      "musclegroup_string": "",
      "video": []
      },
      "is_completed": 0
      },
      {
      "id": "1266",
      "workout_id": "2",
      "category": "1",
      "repititions": "45",
      "exercise_id": "72",
      "unit": "seconds",
      "round": "1",
      "sets": "0",
      "created_at": "2016-08-04 07:16:27",
      "updated_at": "2016-08-04 12:55:16",
      "exercise": {
      "id": "72",
      "name": "Plank (SH)",
      "description": "Plank (SH)",
      "category": "1",
      "type": "1",
      "muscle_groups": "",
      "rewards": "5.00",
      "repititions": "1",
      "duration": "1",
      "unit": "seconds",
      "equipment": "",
      "range_of_motion": "",
      "video_tips": "",
      "pro_tips": "",
      "video_tips_html": "",
      "pro_tips_html": "",
      "range_of_motion_html": "",
      "is_static": "1",
      "musclegroup_string": "",
      "video": []
      },
      "is_completed": 0
      }
      ]
      },
      "exercise_category": 1
      },
      "skilltraining": [],
      "coach_workout_rounds": 1,
      "workout_intensity": 1,
      "hiit": [],
      "stretching": [
      {
      "id": "1",
      "exercise_id": "Superman",
      "duration": {
      "min": "5",
      "max": "10"
      },
      "unit": "times",
      "is_completed": "0",
      "created_at": "2016-01-22 07:10:31",
      "updated_at": "2016-01-22 07:10:31"
      },
      {
      "id": "2",
      "exercise_id": "Lower Back Strength",
      "duration": {
      "min": "30",
      "max": "50"
      },
      "unit": "times",
      "is_completed": "0",
      "created_at": "2016-01-22 07:15:02",
      "updated_at": "2016-01-22 07:15:02"
      },
      {
      "id": "3",
      "exercise_id": "Upper Dog",
      "duration": {
      "min": "30",
      "max": "60"
      },
      "unit": "seconds",
      "is_completed": "0",
      "created_at": "2016-01-22 07:16:03",
      "updated_at": "2016-01-22 07:16:03"
      },
      {
      "id": "4",
      "exercise_id": "Child's Pose",
      "duration": {
      "min": "30",
      "max": "60"
      },
      "unit": "seconds",
      "is_completed": "0",
      "created_at": "2016-01-22 07:16:46",
      "updated_at": "2016-01-22 07:16:46"
      },
      {
      "id": "5",
      "exercise_id": "L-sit on the floor",
      "duration": {
      "min": "30",
      "max": "60"
      },
      "unit": "seconds",
      "is_completed": "0",
      "created_at": "2016-01-22 07:17:13",
      "updated_at": "2016-01-22 07:17:13"
      },
      {
      "id": "6",
      "exercise_id": "Good morning",
      "duration": {
      "min": "30",
      "max": "60"
      },
      "unit": "seconds",
      "is_completed": "0",
      "created_at": "2016-01-22 07:17:43",
      "updated_at": "2016-01-22 07:17:43"
      },
      {
      "id": "7",
      "exercise_id": "Chest Opener",
      "duration": {
      "min": "30",
      "max": "60"
      },
      "unit": "seconds",
      "is_completed": "0",
      "created_at": "2016-01-22 07:19:32",
      "updated_at": "2016-01-22 07:19:32"
      },
      {
      "id": "8",
      "exercise_id": "Triceps Stretc",
      "duration": {
      "min": "30",
      "max": "60"
      },
      "unit": "seconds",
      "is_completed": "0",
      "created_at": "2016-01-22 07:19:56",
      "updated_at": "2016-01-22 07:19:56"
      },
      {
      "id": "9",
      "exercise_id": "Hands Back",
      "duration": {
      "min": "30",
      "max": "60"
      },
      "unit": "seconds",
      "is_completed": "0",
      "created_at": "2016-01-22 07:20:19",
      "updated_at": "2016-01-22 07:20:19"
      },
      {
      "id": "10",
      "exercise_id": "Shoulder Stretch",
      "duration": {
      "min": "30",
      "max": "60"
      },
      "unit": "seconds",
      "is_completed": "0",
      "created_at": "2016-01-22 07:20:45",
      "updated_at": "2016-01-22 07:20:45"
      }
      ]
      },
      "day2": {
      "warmup": [
      {
      "id": "1",
      "name": "wall extensions",
      "duration": {
      "min": "10",
      "max": "20"
      },
      "unit": "times",
      "created_at": "2016-01-21 08:55:06",
      "updated_at": "2016-01-21 08:55:06",
      "is_completed": 0
      },
      {
      "id": "2",
      "name": "band dislocates",
      "duration": {
      "min": "10",
      "max": "20"
      },
      "unit": "times",
      "created_at": "2016-01-21 08:57:38",
      "updated_at": "2016-01-21 08:57:38",
      "is_completed": 0
      },
      {
      "id": "3",
      "name": "cat-camels",
      "duration": {
      "min": "10",
      "max": "20"
      },
      "unit": "times",
      "created_at": "2016-01-21 09:00:39",
      "updated_at": "2016-01-21 09:00:39",
      "is_completed": 0
      },
      {
      "id": "4",
      "name": "scapular shrugs",
      "duration": {
      "min": "10",
      "max": "20"
      },
      "unit": "times",
      "created_at": "2016-01-21 09:01:01",
      "updated_at": "2016-01-21 09:01:01",
      "is_completed": 0
      },
      {
      "id": "5",
      "name": "full body circles",
      "duration": {
      "min": "10",
      "max": "20"
      },
      "unit": "times",
      "created_at": "2016-01-21 09:01:26",
      "updated_at": "2016-01-21 09:01:26",
      "is_completed": 0
      },
      {
      "id": "6",
      "name": "Jumping Jacks",
      "duration": {
      "min": "100",
      "max": ""
      },
      "unit": "seconds",
      "created_at": "2016-01-21 09:04:52",
      "updated_at": "2016-01-21 09:04:52",
      "is_completed": 0
      },
      {
      "id": "7",
      "name": "Arm rotations",
      "duration": {
      "min": "120",
      "max": ""
      },
      "unit": "times",
      "created_at": "2016-01-21 09:05:29",
      "updated_at": "2016-01-21 09:05:29",
      "is_completed": 0
      },
      {
      "id": "8",
      "name": "High Knees",
      "duration": {
      "min": "50",
      "max": ""
      },
      "unit": "times",
      "created_at": "2016-01-21 09:06:02",
      "updated_at": "2016-01-21 09:06:02",
      "is_completed": 0
      },
      {
      "id": "9",
      "name": "Shouder rolls",
      "duration": {
      "min": "20",
      "max": ""
      },
      "unit": "times",
      "created_at": "2016-01-21 09:06:34",
      "updated_at": "2016-01-21 09:06:34",
      "is_completed": 0
      }
      ],
      "is_completed": 0,
      "fundumentals": [
      {
      "id": "42",
      "row": "4",
      "exercise_id": "6",
      "duration": {
      "min": "8",
      "max": "12"
      },
      "unit": "times",
      "is_completed": "0",
      "created_at": "2016-08-08 15:09:55",
      "updated_at": "2016-08-08 15:09:55",
      "exercise": {
      "id": "6",
      "name": "Australian Pull-ups",
      "description": "Australian Pull-ups",
      "category": "1",
      "type": "2",
      "muscle_groups": "",
      "rewards": "5.00",
      "repititions": "1",
      "duration": "1",
      "unit": "times",
      "equipment": "",
      "range_of_motion": "",
      "video_tips": "",
      "pro_tips": "",
      "video_tips_html": "",
      "pro_tips_html": "",
      "range_of_motion_html": "",
      "is_static": "0",
      "musclegroup_string": "",
      "video": [
      {
      "id": "84",
      "path": "90_1470654394.mp4",
      "videothumbnail": "90_1470654394.jpg",
      "description": "Australian Pull-ups"
      }
      ]
      }
      },
      {
      "id": "43",
      "row": "4",
      "exercise_id": "47",
      "duration": {
      "min": "8",
      "max": "12"
      },
      "unit": "times",
      "is_completed": "0",
      "created_at": "2016-08-08 15:11:38",
      "updated_at": "2016-08-08 15:11:38",
      "exercise": {
      "id": "47",
      "name": "Incline Pushups",
      "description": "Incline Pushups",
      "category": "1",
      "type": "1",
      "muscle_groups": "",
      "rewards": "5.00",
      "repititions": "1",
      "duration": "1",
      "unit": "times",
      "equipment": "",
      "range_of_motion": "",
      "video_tips": "",
      "pro_tips": "",
      "video_tips_html": "",
      "pro_tips_html": "",
      "range_of_motion_html": "",
      "is_static": "0",
      "musclegroup_string": "",
      "video": []
      }
      },
      {
      "id": "44",
      "row": "4",
      "exercise_id": "17",
      "duration": {
      "min": "8",
      "max": "12"
      },
      "unit": "times",
      "is_completed": "0",
      "created_at": "2016-08-08 15:12:32",
      "updated_at": "2016-08-08 15:12:32",
      "exercise": {
      "id": "17",
      "name": "Floor Triceps Ext.",
      "description": "Floor Triceps Ext.",
      "category": "1",
      "type": "1",
      "muscle_groups": "",
      "rewards": "6.00",
      "repititions": "1",
      "duration": "1",
      "unit": "times",
      "equipment": "",
      "range_of_motion": "",
      "video_tips": "",
      "pro_tips": "",
      "video_tips_html": "",
      "pro_tips_html": "",
      "range_of_motion_html": "",
      "is_static": "0",
      "musclegroup_string": "",
      "video": []
      }
      },
      {
      "id": "45",
      "row": "4",
      "exercise_id": "67",
      "duration": {
      "min": "12",
      "max": "15"
      },
      "unit": "times",
      "is_completed": "0",
      "created_at": "2016-08-08 15:13:45",
      "updated_at": "2016-08-08 15:14:03",
      "exercise": {
      "id": "67",
      "name": "Crunches",
      "description": "Crunches",
      "category": "1",
      "type": "1",
      "muscle_groups": "",
      "rewards": "5.00",
      "repititions": "1",
      "duration": "1",
      "unit": "times",
      "equipment": "",
      "range_of_motion": "",
      "video_tips": "",
      "pro_tips": "",
      "video_tips_html": "",
      "pro_tips_html": "",
      "range_of_motion_html": "",
      "is_static": "0",
      "musclegroup_string": "",
      "video": []
      }
      },
      {
      "id": "46",
      "row": "4",
      "exercise_id": "41",
      "duration": {
      "min": "12",
      "max": "20"
      },
      "unit": "times",
      "is_completed": "0",
      "created_at": "2016-08-08 15:15:05",
      "updated_at": "2016-08-08 15:15:05",
      "exercise": {
      "id": "41",
      "name": "Jumping Lunges",
      "description": "Jumping Lunges",
      "category": "3",
      "type": "1",
      "muscle_groups": "",
      "rewards": "10.00",
      "repititions": "1",
      "duration": "1",
      "unit": "times",
      "equipment": "",
      "range_of_motion": "",
      "video_tips": "",
      "pro_tips": "",
      "video_tips_html": "",
      "pro_tips_html": "",
      "range_of_motion_html": "",
      "is_static": "0",
      "musclegroup_string": "",
      "video": []
      }
      }
      ],
      "exercises": [],
      "workout": [],
      "skilltraining": {
      "id": "1",
      "name": "Muscleups (MU)",
      "description": "",
      "rewards": 330,
      "equipments": "",
      "is_circuit": "0",
      "created_at": "2016-08-02 10:56:33",
      "progression_string": "",
      "focus": 1,
      "exercises": [
      {
      "id": "1",
      "skilltraining_id": "1",
      "category": "1",
      "repititions": "5",
      "exercise_id": "110",
      "unit": "times",
      "sets": "3",
      "created_at": "2016-08-03 06:59:50",
      "updated_at": "2016-08-03 07:22:46",
      "video": {
      "id": "80",
      "path": "193_1470649743.mp4",
      "videothumbnail": "193_1470649743.jpg",
      "description": ""
      },
      "exercise": {
      "id": "110",
      "name": "Jump 2 MU",
      "description": "Jump 2 MU",
      "category": "3",
      "type": "2",
      "muscle_groups": "",
      "rewards": "5.00",
      "repititions": "1",
      "duration": "1",
      "unit": "times",
      "equipment": "",
      "range_of_motion": "1) Start with feet on the ground 2) Jump up into muscleup 3) Straight bar dip on top 4) Slow & controlled eccentric movement into starting position",
      "video_tips": "",
      "pro_tips": "",
      "video_tips_html": "",
      "pro_tips_html": "",
      "range_of_motion_html": "<p>1) Start with feet on the ground<br /> 2) Jump up into muscleup<br /> 3) Straight bar dip on top<br /> 4) Slow &amp; controlled eccentric movement into starting position</p>",
      "is_static": "0",
      "musclegroup_string": ""
      }
      },
      {
      "id": "2",
      "skilltraining_id": "1",
      "category": "1",
      "repititions": "10",
      "exercise_id": "3",
      "unit": "times",
      "sets": "3",
      "created_at": "2016-08-03 07:16:19",
      "updated_at": "2016-08-03 07:25:06",
      "video": {
      "id": "81",
      "path": "86_1470654172.mp4",
      "videothumbnail": "86_1470654172.jpg",
      "description": "Pull-ups "
      },
      "exercise": {
      "id": "3",
      "name": "Pull-ups ",
      "description": "Pull-ups ",
      "category": "2",
      "type": "1",
      "muscle_groups": "",
      "rewards": "7.00",
      "repititions": "1",
      "duration": "1",
      "unit": "times",
      "equipment": "",
      "range_of_motion": "1) Start in deadhang position 2) Pullup, chin above bar level 3) Slow & controlled movement into starting position",
      "video_tips": "",
      "pro_tips": "",
      "video_tips_html": "",
      "pro_tips_html": "",
      "range_of_motion_html": "<p>1) Start in deadhang position<br /> 2) Pullup, chin above bar level<br /> 3) Slow &amp; controlled movement into starting position</p>",
      "is_static": "0",
      "musclegroup_string": ""
      }
      },
      {
      "id": "3",
      "skilltraining_id": "1",
      "category": "1",
      "repititions": "20",
      "exercise_id": "48",
      "unit": "times",
      "sets": "3",
      "created_at": "2016-08-03 07:18:36",
      "updated_at": "2016-08-03 07:25:43",
      "video": {
      "id": "82",
      "path": "132_1470650036.mp4",
      "videothumbnail": "132_1470650036.jpg",
      "description": ""
      },
      "exercise": {
      "id": "48",
      "name": "Pushups",
      "description": "Pushups",
      "category": "1",
      "type": "1",
      "muscle_groups": "",
      "rewards": "6.00",
      "repititions": "1",
      "duration": "1",
      "unit": "times",
      "equipment": "",
      "range_of_motion": "",
      "video_tips": "",
      "pro_tips": "",
      "video_tips_html": "",
      "pro_tips_html": "",
      "range_of_motion_html": "",
      "is_static": "0",
      "musclegroup_string": ""
      }
      },
      {
      "id": "4",
      "skilltraining_id": "1",
      "category": "1",
      "repititions": "15",
      "exercise_id": "16",
      "unit": "times",
      "sets": "3",
      "created_at": "2016-08-03 07:26:11",
      "updated_at": "2016-08-03 07:26:11",
      "video": {
      "id": "83",
      "path": "100_1470654597.mp4",
      "videothumbnail": "100_1470654597.jpg",
      "description": "Bench Dips"
      },
      "exercise": {
      "id": "16",
      "name": "Bench Dips",
      "description": "Bench Dips",
      "category": "1",
      "type": "1",
      "muscle_groups": "",
      "rewards": "5.00",
      "repititions": "1",
      "duration": "1",
      "unit": "times",
      "equipment": "",
      "range_of_motion": "",
      "video_tips": "",
      "pro_tips": "",
      "video_tips_html": "",
      "pro_tips_html": "",
      "range_of_motion_html": "",
      "is_static": "0",
      "musclegroup_string": ""
      }
      },
      {
      "id": "5",
      "skilltraining_id": "1",
      "category": "1",
      "repititions": "15",
      "exercise_id": "6",
      "unit": "times",
      "sets": "3",
      "created_at": "2016-08-03 07:26:42",
      "updated_at": "2016-08-03 07:26:42",
      "video": {
      "id": "84",
      "path": "90_1470654394.mp4",
      "videothumbnail": "90_1470654394.jpg",
      "description": "Australian Pull-ups"
      },
      "exercise": {
      "id": "6",
      "name": "Australian Pull-ups",
      "description": "Australian Pull-ups",
      "category": "1",
      "type": "2",
      "muscle_groups": "",
      "rewards": "5.00",
      "repititions": "1",
      "duration": "1",
      "unit": "times",
      "equipment": "",
      "range_of_motion": "",
      "video_tips": "",
      "pro_tips": "",
      "video_tips_html": "",
      "pro_tips_html": "",
      "range_of_motion_html": "",
      "is_static": "0",
      "musclegroup_string": ""
      }
      }
      ]
      },
      "coach_workout_rounds": 1,
      "workout_intensity": 1,
      "hiit": [
      {
      "id": 2,
      "intensity": 4,
      "is_completed": 0,
      "replacement": [
      {
      "round1": [
      {
      "name": "Burpee Pushups",
      "duration": 10,
      "unit": "times",
      "exercise": {
      "id": "44",
      "name": "Burpee Pushups",
      "description": "Burpee Pushups",
      "category": "2",
      "type": "1",
      "muscle_groups": "",
      "rewards": "7.00",
      "repititions": "1",
      "duration": "1",
      "unit": "times",
      "equipment": "",
      "range_of_motion": "",
      "video_tips": "",
      "pro_tips": "",
      "video_tips_html": "",
      "pro_tips_html": "",
      "range_of_motion_html": "",
      "is_static": "0",
      "musclegroup_string": "",
      "video": []
      }
      },
      {
      "name": "Rest",
      "duration": 10,
      "unit": "seconds",
      "exercise": {
      "id": "152",
      "name": "Rest",
      "description": "Rest",
      "category": "1",
      "type": "1",
      "muscle_groups": "",
      "rewards": "0.00",
      "repititions": "1",
      "duration": "1",
      "unit": "seconds",
      "equipment": "",
      "range_of_motion": "",
      "video_tips": "",
      "pro_tips": "",
      "video_tips_html": "",
      "pro_tips_html": "",
      "range_of_motion_html": "",
      "is_static": "0",
      "musclegroup_string": "",
      "video": []
      }
      }
      ],
      "round2": [
      {
      "name": "Squat Jumps",
      "duration": 15,
      "unit": "times",
      "exercise": {
      "id": "40",
      "name": "Squat Jumps",
      "description": "Squat Jumps",
      "category": "3",
      "type": "1",
      "muscle_groups": "",
      "rewards": "7.00",
      "repititions": "1",
      "duration": "1",
      "unit": "times",
      "equipment": "",
      "range_of_motion": "",
      "video_tips": "",
      "pro_tips": "",
      "video_tips_html": "",
      "pro_tips_html": "",
      "range_of_motion_html": "",
      "is_static": "0",
      "musclegroup_string": "",
      "video": []
      }
      },
      {
      "name": "Rest",
      "duration": 10,
      "unit": "seconds",
      "exercise": {
      "id": "152",
      "name": "Rest",
      "description": "Rest",
      "category": "1",
      "type": "1",
      "muscle_groups": "",
      "rewards": "0.00",
      "repititions": "1",
      "duration": "1",
      "unit": "seconds",
      "equipment": "",
      "range_of_motion": "",
      "video_tips": "",
      "pro_tips": "",
      "video_tips_html": "",
      "pro_tips_html": "",
      "range_of_motion_html": "",
      "is_static": "0",
      "musclegroup_string": "",
      "video": []
      }
      }
      ],
      "round3": [
      {
      "name": "Knee Raises",
      "duration": 25,
      "unit": "times",
      "exercise": {
      "id": "86",
      "name": "Knee Raises",
      "description": "Knee Raises",
      "category": "1",
      "type": "1",
      "muscle_groups": "",
      "rewards": "5.00",
      "repititions": "1",
      "duration": "1",
      "unit": "times",
      "equipment": "",
      "range_of_motion": "",
      "video_tips": "",
      "pro_tips": "",
      "video_tips_html": "",
      "pro_tips_html": "",
      "range_of_motion_html": "",
      "is_static": "0",
      "musclegroup_string": "",
      "video": []
      }
      },
      {
      "name": "Rest",
      "duration": 10,
      "unit": "seconds",
      "exercise": {
      "id": "152",
      "name": "Rest",
      "description": "Rest",
      "category": "1",
      "type": "1",
      "muscle_groups": "",
      "rewards": "0.00",
      "repititions": "1",
      "duration": "1",
      "unit": "seconds",
      "equipment": "",
      "range_of_motion": "",
      "video_tips": "",
      "pro_tips": "",
      "video_tips_html": "",
      "pro_tips_html": "",
      "range_of_motion_html": "",
      "is_static": "0",
      "musclegroup_string": "",
      "video": []
      }
      }
      ]
      }
      ],
      "replacement_round_count": 3
      }
      ],
      "stretching": [
      {
      "id": "1",
      "exercise_id": "Superman",
      "duration": {
      "min": "5",
      "max": "10"
      },
      "unit": "times",
      "is_completed": "0",
      "created_at": "2016-01-22 07:10:31",
      "updated_at": "2016-01-22 07:10:31"
      },
      {
      "id": "2",
      "exercise_id": "Lower Back Strength",
      "duration": {
      "min": "30",
      "max": "50"
      },
      "unit": "times",
      "is_completed": "0",
      "created_at": "2016-01-22 07:15:02",
      "updated_at": "2016-01-22 07:15:02"
      },
      {
      "id": "3",
      "exercise_id": "Upper Dog",
      "duration": {
      "min": "30",
      "max": "60"
      },
      "unit": "seconds",
      "is_completed": "0",
      "created_at": "2016-01-22 07:16:03",
      "updated_at": "2016-01-22 07:16:03"
      },
      {
      "id": "4",
      "exercise_id": "Child's Pose",
      "duration": {
      "min": "30",
      "max": "60"
      },
      "unit": "seconds",
      "is_completed": "0",
      "created_at": "2016-01-22 07:16:46",
      "updated_at": "2016-01-22 07:16:46"
      },
      {
      "id": "5",
      "exercise_id": "L-sit on the floor",
      "duration": {
      "min": "30",
      "max": "60"
      },
      "unit": "seconds",
      "is_completed": "0",
      "created_at": "2016-01-22 07:17:13",
      "updated_at": "2016-01-22 07:17:13"
      },
      {
      "id": "6",
      "exercise_id": "Good morning",
      "duration": {
      "min": "30",
      "max": "60"
      },
      "unit": "seconds",
      "is_completed": "0",
      "created_at": "2016-01-22 07:17:43",
      "updated_at": "2016-01-22 07:17:43"
      },
      {
      "id": "7",
      "exercise_id": "Chest Opener",
      "duration": {
      "min": "30",
      "max": "60"
      },
      "unit": "seconds",
      "is_completed": "0",
      "created_at": "2016-01-22 07:19:32",
      "updated_at": "2016-01-22 07:19:32"
      },
      {
      "id": "8",
      "exercise_id": "Triceps Stretc",
      "duration": {
      "min": "30",
      "max": "60"
      },
      "unit": "seconds",
      "is_completed": "0",
      "created_at": "2016-01-22 07:19:56",
      "updated_at": "2016-01-22 07:19:56"
      },
      {
      "id": "9",
      "exercise_id": "Hands Back",
      "duration": {
      "min": "30",
      "max": "60"
      },
      "unit": "seconds",
      "is_completed": "0",
      "created_at": "2016-01-22 07:20:19",
      "updated_at": "2016-01-22 07:20:19"
      },
      {
      "id": "10",
      "exercise_id": "Shoulder Stretch",
      "duration": {
      "min": "30",
      "max": "60"
      },
      "unit": "seconds",
      "is_completed": "0",
      "created_at": "2016-01-22 07:20:45",
      "updated_at": "2016-01-22 07:20:45"
      }
      ]
      }
      },
      "category": "advanced",
      "muscle_groups": "",
      "limitations": "",
      "goal_option": "0",
      "feedback": "0",
      "created_at": "2016-08-10 07:19:11",
      "updated_at": "2016-08-12 05:06:11",
      "description": "Strive for progress",
      "musclegroup_string": "",
      "goaloption_string": ""
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
     * @apiError error Message user_not_exists
     * @apiError error Message Invalid options selected.
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
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 500 Invalid options selected.
     *     {
      "status": 0,
      "message": "Invalid options selected. Please revisit your options to get your coach."
      }
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 500 raid not selected.
     *     {
      "status": 0,
      "message": "Please select a raid to continue."
      }
     * 
     */
    public function prepareCoach(Request $request)
    {
        if (!isset($request->user_id) || ($request->user_id == null)) {
            return response()->json(["status" => "0", "error" => "The user_id field is required"]);
        } elseif (!isset($request->test) || ($request->test == null)) {
            return response()->json(["status" => "0", "error" => "The test field is required"]);
        } elseif (!isset($request->days) || ($request->days == null)) {
            return response()->json(["status" => "0", "error" => "The days field is required"]);
        } elseif (!isset($request->feedback) || ($request->feedback == null)) {
            return response()->json(["status" => "0", "error" => "The feedback field is required"]);
        } else {
            $tests = json_decode($request->feedback, true);
            $doneCnt = $userRaidSelected = 0;
            foreach ($tests as $test) {
                if ($test != 3) {
                    $doneCnt++;
                }
            }

            $userGoalOption = DB::table('user_goal_options')->where('user_id', $request->user_id)->first();

            if (!is_null($userGoalOption)) {
                if ($userGoalOption->goal_options != '') {
                    $userRaidSelected = 1;
                }
            }

            if ($doneCnt >= 4 && $userRaidSelected == 0) {
                return response()->json(["status" => "0", "error" => "Please select a raid to continue."]);
            }

            $user = User::where('id', '=', $request->input('user_id'))->first();

            $feedbacks = json_decode($request->feedback, true);

            $category = 3;

            foreach ($feedbacks as $feedback) {
                if ($feedback == 1) {
                    continue;
                } elseif ($feedback == 2) {
                    $category = 2;
                    break;
                }
            }

            foreach ($feedbacks as $feedback) {
                if ($feedback == 2) {
                    continue;
                } elseif ($feedback == 3) {
                    $category = 1;
                    break;
                }
            }

            $feedbackSum = 0;

            foreach ($feedbacks as $feedback) {
                $feedbackSum += $feedback;
            }

            $feedAvg = round($feedbackSum / 4);

            if ($feedAvg < 2 && $feedAvg > 0) {
                $category = 'professional';
            } elseif ($feedAvg == 2) {
                $category = 'advanced';
            } elseif ($feedAvg == 3 || $feedAvg == 0) {
                $category = 'beginer';
            }

            $profile = Profile::where('user_id', $request->user_id)->first();

            $likeQueryArray = $limitQueryArray = [];

            if (isset($request->muscle_groups)) {
                $muscleGroupArray = explode(',', $request->muscle_groups);
                foreach ($muscleGroupArray as $muscleGroupId) {
                    if ($muscleGroupId != ' ' && $muscleGroupId != '') {
                        $likeQueryArray[] = $muscleGroupId;
                    }
                }
            }

            if (isset($request->limitations)) {
                $limitationsArray = explode(',', $request->limitations);
                foreach ($limitationsArray as $limitationId) {
                    if ($limitationId != ' ' && $limitationId != '' && $limitationId != null) {
                        $limitQueryArray[] = $limitationId;
                    }
                }
            }

            if (!is_null($user)) {
                $data = [
                    'user_id' => $request->user_id,
                    'focus' => (isset($request->focus) && ($request->focus != null) && ($request->focus != '(null)')) ? $request->focus : $profile->goal,
                    'category' => $category,
                    'muscle_groups' => (!isset($request->muscle_groups) || ($request->muscle_groups == null)) ? "" : implode(',', $likeQueryArray),
                    'limitations' => (!isset($request->limitations) || ($request->limitations == null)) ? "" : implode(',', $limitQueryArray),
                    'height' => (!isset($request->height) || ($request->height == null)) ? "" : $request->height,
                    'weight' => (!isset($request->weight) || ($request->weight == null)) ? "" : $request->weight,
                    'days' => $request->days,
                    'exercises' => '',
                    'feedback' => $request->feedback
                ];

                $userCoach = Coach::where('user_id', '=', $request->input('user_id'))->first();

                if (isset($request->muscle_groups) && $request->muscle_groups != '' && $request->muscle_groups != null && $request->muscle_groups != '(null)') {
                    $muscleGroups = DB::table('user_physique_options')->where('user_id', $request->user_id)->first();
                    if (!is_null($muscleGroups)) {
                        DB::table('user_physique_options')->where('user_id', $request->user_id)->update(['physique_options' => implode(',', $likeQueryArray)]);
                    } else {
                        DB::table('user_physique_options')->insert(['physique_options' => implode(',', $likeQueryArray), 'user_id' => $request->user_id]);
                    }
                }

                if ((isset($request->focus) && ($request->focus != null) && ($request->focus != '(null)'))) {
                    Profile::where('user_id', $request->user_id)->update([
                        'goal' => $request->focus
                    ]);
                }

                if (is_null($userCoach)) {
                    Coach::create($data);
                    $coachId = DB::table('coaches')->where('user_id', $request->user_id)->pluck('id');
                } else {
                    DB::table('coaches')->where('id', $userCoach->id)->update($data);
                    $coachId = $userCoach->id;
                }

                $data['test'] = $request->test;

                $data['week'] = 1;

                //Prepare coach exercises according to user options
                $coachExercises = Coach::prepareCoachExercises($coachId, $data);

                if ($coachExercises) {

                    DB::table('coaches')->where('id', $coachId)->update(['exercises' => json_encode($coachExercises)]);

                    $userCoachStatus = DB::table('coach_status')->where('user_id', $request->user_id)->where('coach_id', $coachId)->first();

                    for ($i = 1; $i <= $request->days; $i++) {
                        $statusArray[$i] = 0;
                    }

                    $weekStatusArray[1] = 0;

                    if (is_null($userCoachStatus)) {
                        DB::table('coach_status')->insert([
                            'user_id' => $request->user_id,
                            'coach_id' => $coachId,
                            'day' => 1,
                            'week' => 1,
                            'need_update' => 0,
                            'day_status' => json_encode($statusArray),
                            'week_status' => json_encode($weekStatusArray),
                            'created_at' => Carbon::now()
                        ]);
                    } else {
                        DB::table('coach_status')->where('coach_id', $coachId)->update([
                            'day' => 1,
                            'week' => 1,
                            'need_update' => 0,
                            'day_status' => json_encode($statusArray),
                            'week_status' => json_encode($weekStatusArray)
                        ]);
                    }

                    $coach = Coach::where('user_id', $request->user_id)->first();

                    $coachStatus = DB::table('coach_status')->where('user_id', $request->user_id)->where('coach_id', $coach->id)->first();

                    if ($coachStatus->week <= 15) {
                        $coach->description = DB::table('coach_descriptions')->where('week', $coachStatus->week)->pluck('description');
                    } else {
                        $coach->description = DB::table('coach_descriptions')->where('week', 15)->pluck('description');
                    }

                    $coach->musclegroup_string = Coach::musclegroupString($coach->muscle_groups);

                    $coach->limitations = Coach::musclegroupString($coach->limitations);

                    $coach->goaloption_string = Coach::goaloptionString($coach->goal_option);

                    $coach->exercises = json_decode($coach->exercises, true);

                    $dayStatus = json_decode($coachStatus->day_status, true);

                    $weekStatus = json_decode($coachStatus->week_status, true);

                    return response()->json([
                            'status' => 1,
                            'message' => 'coach_exercises',
                            'coach_day' => $coachStatus->day,
                            'coach_week' => $coachStatus->week,
                            'is_subscribed' => $user->is_subscribed,
                            'need_update' => $coachStatus->need_update,
                            'week_status' => $weekStatus,
                            'day_status' => $dayStatus,
                            'week_points' => DB::table('coach_points')->where('user_id', $request->user_id)->where('week', $coachStatus->week)->sum('points'),
                            'coach' => $coach,
                            'urls' => config('urls.urls')], 200);
                } else {
                    Coach::where('user_id', $request->user_id)->delete();
                    return response()->json([
                            'status' => 0,
                            'message' => 'Invalid options selected. Please revisit your options to get your coach.'], 500);
                }
            } else {
                return response()->json(['status' => 0, 'error' => 'user_not_exists'], 500);
            }
        }
    }

    /**
     * @api {post} /coach/update updateCoach
     * @apiName updateCoach
     * @apiGroup Coach
     * @apiParam {Number} user_id Id of user *required
     * @apiParam {Number} assessment 1- I can do way more, 2 - I can do more, 3 - It was ok *required
     * @apiParam {Number} focus user focus 1-Lean, 2-Athletic, 3-Strength *required
     * @apiParam {Number} days number of workout days per week *required
     * @apiSuccess {String} success.
     * @apiSuccessExample Success-Response:
     * HTTP/1.1 200 OK
     * {
      "status": 1,
      "message": "coach_exercises",
      "coach_day": "1",
      "coach_week": "1",
      "is_subscribed": 1,
      "need_update": "0",
      "week_status": {
      "1": 0
      },
      "day_status": {
      "1": 0,
      "2": 0
      },
      "week_points": 0,
      "coach": {
      "id": "532",
      "user_id": "100",
      "focus": "1",
      "height": "0.00",
      "weight": "0.00",
      "days": "2",
      "exercises": {
      "day1": {
      "warmup": [
      {
      "id": "1",
      "name": "wall extensions",
      "duration": {
      "min": "10",
      "max": "20"
      },
      "unit": "times",
      "created_at": "2016-01-21 08:55:06",
      "updated_at": "2016-01-21 08:55:06",
      "is_completed": 0
      },
      {
      "id": "2",
      "name": "band dislocates",
      "duration": {
      "min": "10",
      "max": "20"
      },
      "unit": "times",
      "created_at": "2016-01-21 08:57:38",
      "updated_at": "2016-01-21 08:57:38",
      "is_completed": 0
      },
      {
      "id": "3",
      "name": "cat-camels",
      "duration": {
      "min": "10",
      "max": "20"
      },
      "unit": "times",
      "created_at": "2016-01-21 09:00:39",
      "updated_at": "2016-01-21 09:00:39",
      "is_completed": 0
      },
      {
      "id": "4",
      "name": "scapular shrugs",
      "duration": {
      "min": "10",
      "max": "20"
      },
      "unit": "times",
      "created_at": "2016-01-21 09:01:01",
      "updated_at": "2016-01-21 09:01:01",
      "is_completed": 0
      },
      {
      "id": "5",
      "name": "full body circles",
      "duration": {
      "min": "10",
      "max": "20"
      },
      "unit": "times",
      "created_at": "2016-01-21 09:01:26",
      "updated_at": "2016-01-21 09:01:26",
      "is_completed": 0
      },
      {
      "id": "6",
      "name": "Jumping Jacks",
      "duration": {
      "min": "100",
      "max": ""
      },
      "unit": "seconds",
      "created_at": "2016-01-21 09:04:52",
      "updated_at": "2016-01-21 09:04:52",
      "is_completed": 0
      },
      {
      "id": "7",
      "name": "Arm rotations",
      "duration": {
      "min": "120",
      "max": ""
      },
      "unit": "times",
      "created_at": "2016-01-21 09:05:29",
      "updated_at": "2016-01-21 09:05:29",
      "is_completed": 0
      },
      {
      "id": "8",
      "name": "High Knees",
      "duration": {
      "min": "50",
      "max": ""
      },
      "unit": "times",
      "created_at": "2016-01-21 09:06:02",
      "updated_at": "2016-01-21 09:06:02",
      "is_completed": 0
      },
      {
      "id": "9",
      "name": "Shouder rolls",
      "duration": {
      "min": "20",
      "max": ""
      },
      "unit": "times",
      "created_at": "2016-01-21 09:06:34",
      "updated_at": "2016-01-21 09:06:34",
      "is_completed": 0
      }
      ],
      "is_completed": 0,
      "fundumentals": [
      {
      "id": "27",
      "row": "1",
      "exercise_id": "1",
      "duration": {
      "min": "5",
      "max": "8"
      },
      "unit": "times",
      "is_completed": "0",
      "created_at": "2016-08-08 14:04:33",
      "updated_at": "2016-08-11 04:55:05",
      "exercise": {
      "id": "1",
      "name": "Eccentric Pull-ups",
      "description": "Eccentric Pull-ups",
      "category": "1",
      "type": "1",
      "muscle_groups": "",
      "rewards": "5.00",
      "repititions": "1",
      "duration": "1",
      "unit": "times",
      "equipment": "",
      "range_of_motion": "1) Start with feet on the ground 2) Jump into pullup, chin above bar level 3) Hold position briefly 4) Slow & controlled eccentric movement into starting position",
      "video_tips": "",
      "pro_tips": "",
      "video_tips_html": "",
      "pro_tips_html": "",
      "range_of_motion_html": "<p>1) Start with feet on the ground<br /> 2) Jump into pullup, chin above bar level<br /> 3) Hold position briefly<br /> 4) Slow &amp; controlled eccentric movement into starting position</p>",
      "is_static": "0",
      "musclegroup_string": "",
      "video": []
      }
      },
      {
      "id": "28",
      "row": "1",
      "exercise_id": "47",
      "duration": {
      "min": "12",
      "max": "15"
      },
      "unit": "times",
      "is_completed": "0",
      "created_at": "2016-08-08 14:06:32",
      "updated_at": "2016-08-08 14:06:32",
      "exercise": {
      "id": "47",
      "name": "Incline Pushups",
      "description": "Incline Pushups",
      "category": "1",
      "type": "1",
      "muscle_groups": "",
      "rewards": "5.00",
      "repititions": "1",
      "duration": "1",
      "unit": "times",
      "equipment": "",
      "range_of_motion": "",
      "video_tips": "",
      "pro_tips": "",
      "video_tips_html": "",
      "pro_tips_html": "",
      "range_of_motion_html": "",
      "is_static": "0",
      "musclegroup_string": "",
      "video": []
      }
      },
      {
      "id": "29",
      "row": "1",
      "exercise_id": "16",
      "duration": {
      "min": "8",
      "max": "12"
      },
      "unit": "times",
      "is_completed": "0",
      "created_at": "2016-08-08 14:07:09",
      "updated_at": "2016-08-08 14:07:09",
      "exercise": {
      "id": "16",
      "name": "Bench Dips",
      "description": "Bench Dips",
      "category": "1",
      "type": "1",
      "muscle_groups": "",
      "rewards": "5.00",
      "repititions": "1",
      "duration": "1",
      "unit": "times",
      "equipment": "",
      "range_of_motion": "",
      "video_tips": "",
      "pro_tips": "",
      "video_tips_html": "",
      "pro_tips_html": "",
      "range_of_motion_html": "",
      "is_static": "0",
      "musclegroup_string": "",
      "video": [
      {
      "id": "83",
      "path": "100_1470654597.mp4",
      "videothumbnail": "100_1470654597.jpg",
      "description": "Bench Dips"
      }
      ]
      }
      },
      {
      "id": "30",
      "row": "1",
      "exercise_id": "86",
      "duration": {
      "min": "10",
      "max": "15"
      },
      "unit": "times",
      "is_completed": "0",
      "created_at": "2016-08-08 14:08:12",
      "updated_at": "2016-08-08 14:08:12",
      "exercise": {
      "id": "86",
      "name": "Knee Raises",
      "description": "Knee Raises",
      "category": "1",
      "type": "1",
      "muscle_groups": "",
      "rewards": "5.00",
      "repititions": "1",
      "duration": "1",
      "unit": "times",
      "equipment": "",
      "range_of_motion": "",
      "video_tips": "",
      "pro_tips": "",
      "video_tips_html": "",
      "pro_tips_html": "",
      "range_of_motion_html": "",
      "is_static": "0",
      "musclegroup_string": "",
      "video": []
      }
      },
      {
      "id": "31",
      "row": "1",
      "exercise_id": "37",
      "duration": {
      "min": "15",
      "max": "20"
      },
      "unit": "times",
      "is_completed": "0",
      "created_at": "2016-08-08 14:09:52",
      "updated_at": "2016-08-08 14:09:52",
      "exercise": {
      "id": "37",
      "name": "Climbers",
      "description": "Climbers",
      "category": "1",
      "type": "1",
      "muscle_groups": "",
      "rewards": "5.00",
      "repititions": "1",
      "duration": "1",
      "unit": "times",
      "equipment": "",
      "range_of_motion": "",
      "video_tips": "",
      "pro_tips": "",
      "video_tips_html": "",
      "pro_tips_html": "",
      "range_of_motion_html": "",
      "is_static": "0",
      "musclegroup_string": "",
      "video": []
      }
      }
      ],
      "exercises": [],
      "workout": {
      "id": "2",
      "name": "Vali",
      "description": "",
      "rounds": "3",
      "category": "2",
      "type": "1",
      "rewards": "330",
      "duration": "100.00",
      "equipments": "BAR/RINGS",
      "is_repsandsets": "0",
      "created_at": "2016-08-03 06:24:47",
      "is_completed": 0,
      "progression_string": "",
      "exercises": {
      "round1": [
      {
      "id": "1260",
      "workout_id": "2",
      "category": "1",
      "repititions": "8",
      "exercise_id": "1",
      "unit": "times",
      "round": "1",
      "sets": "0",
      "created_at": "2016-08-04 07:13:49",
      "updated_at": "2016-08-11 04:55:05",
      "exercise": {
      "id": "1",
      "name": "Eccentric Pull-ups",
      "description": "Eccentric Pull-ups",
      "category": "1",
      "type": "1",
      "muscle_groups": "",
      "rewards": "5.00",
      "repititions": "1",
      "duration": "1",
      "unit": "times",
      "equipment": "",
      "range_of_motion": "1) Start with feet on the ground 2) Jump into pullup, chin above bar level 3) Hold position briefly 4) Slow & controlled eccentric movement into starting position",
      "video_tips": "",
      "pro_tips": "",
      "video_tips_html": "",
      "pro_tips_html": "",
      "range_of_motion_html": "<p>1) Start with feet on the ground<br /> 2) Jump into pullup, chin above bar level<br /> 3) Hold position briefly<br /> 4) Slow &amp; controlled eccentric movement into starting position</p>",
      "is_static": "0",
      "musclegroup_string": "",
      "video": []
      },
      "is_completed": 0
      },
      {
      "id": "1263",
      "workout_id": "2",
      "category": "1",
      "repititions": "20",
      "exercise_id": "37",
      "unit": "times",
      "round": "1",
      "sets": "0",
      "created_at": "2016-08-04 07:15:51",
      "updated_at": "2016-08-04 11:56:46",
      "exercise": {
      "id": "37",
      "name": "Climbers",
      "description": "Climbers",
      "category": "1",
      "type": "1",
      "muscle_groups": "",
      "rewards": "5.00",
      "repititions": "1",
      "duration": "1",
      "unit": "times",
      "equipment": "",
      "range_of_motion": "",
      "video_tips": "",
      "pro_tips": "",
      "video_tips_html": "",
      "pro_tips_html": "",
      "range_of_motion_html": "",
      "is_static": "0",
      "musclegroup_string": "",
      "video": []
      },
      "is_completed": 0
      },
      {
      "id": "1266",
      "workout_id": "2",
      "category": "1",
      "repititions": "45",
      "exercise_id": "72",
      "unit": "seconds",
      "round": "1",
      "sets": "0",
      "created_at": "2016-08-04 07:16:27",
      "updated_at": "2016-08-04 12:55:16",
      "exercise": {
      "id": "72",
      "name": "Plank (SH)",
      "description": "Plank (SH)",
      "category": "1",
      "type": "1",
      "muscle_groups": "",
      "rewards": "5.00",
      "repititions": "1",
      "duration": "1",
      "unit": "seconds",
      "equipment": "",
      "range_of_motion": "",
      "video_tips": "",
      "pro_tips": "",
      "video_tips_html": "",
      "pro_tips_html": "",
      "range_of_motion_html": "",
      "is_static": "1",
      "musclegroup_string": "",
      "video": []
      },
      "is_completed": 0
      }
      ]
      },
      "exercise_category": 1
      },
      "skilltraining": [],
      "coach_workout_rounds": 1,
      "workout_intensity": 1,
      "hiit": [],
      "stretching": [
      {
      "id": "1",
      "exercise_id": "Superman",
      "duration": {
      "min": "5",
      "max": "10"
      },
      "unit": "times",
      "is_completed": "0",
      "created_at": "2016-01-22 07:10:31",
      "updated_at": "2016-01-22 07:10:31"
      },
      {
      "id": "2",
      "exercise_id": "Lower Back Strength",
      "duration": {
      "min": "30",
      "max": "50"
      },
      "unit": "times",
      "is_completed": "0",
      "created_at": "2016-01-22 07:15:02",
      "updated_at": "2016-01-22 07:15:02"
      },
      {
      "id": "3",
      "exercise_id": "Upper Dog",
      "duration": {
      "min": "30",
      "max": "60"
      },
      "unit": "seconds",
      "is_completed": "0",
      "created_at": "2016-01-22 07:16:03",
      "updated_at": "2016-01-22 07:16:03"
      },
      {
      "id": "4",
      "exercise_id": "Child's Pose",
      "duration": {
      "min": "30",
      "max": "60"
      },
      "unit": "seconds",
      "is_completed": "0",
      "created_at": "2016-01-22 07:16:46",
      "updated_at": "2016-01-22 07:16:46"
      },
      {
      "id": "5",
      "exercise_id": "L-sit on the floor",
      "duration": {
      "min": "30",
      "max": "60"
      },
      "unit": "seconds",
      "is_completed": "0",
      "created_at": "2016-01-22 07:17:13",
      "updated_at": "2016-01-22 07:17:13"
      },
      {
      "id": "6",
      "exercise_id": "Good morning",
      "duration": {
      "min": "30",
      "max": "60"
      },
      "unit": "seconds",
      "is_completed": "0",
      "created_at": "2016-01-22 07:17:43",
      "updated_at": "2016-01-22 07:17:43"
      },
      {
      "id": "7",
      "exercise_id": "Chest Opener",
      "duration": {
      "min": "30",
      "max": "60"
      },
      "unit": "seconds",
      "is_completed": "0",
      "created_at": "2016-01-22 07:19:32",
      "updated_at": "2016-01-22 07:19:32"
      },
      {
      "id": "8",
      "exercise_id": "Triceps Stretc",
      "duration": {
      "min": "30",
      "max": "60"
      },
      "unit": "seconds",
      "is_completed": "0",
      "created_at": "2016-01-22 07:19:56",
      "updated_at": "2016-01-22 07:19:56"
      },
      {
      "id": "9",
      "exercise_id": "Hands Back",
      "duration": {
      "min": "30",
      "max": "60"
      },
      "unit": "seconds",
      "is_completed": "0",
      "created_at": "2016-01-22 07:20:19",
      "updated_at": "2016-01-22 07:20:19"
      },
      {
      "id": "10",
      "exercise_id": "Shoulder Stretch",
      "duration": {
      "min": "30",
      "max": "60"
      },
      "unit": "seconds",
      "is_completed": "0",
      "created_at": "2016-01-22 07:20:45",
      "updated_at": "2016-01-22 07:20:45"
      }
      ]
      },
      "day2": {
      "warmup": [
      {
      "id": "1",
      "name": "wall extensions",
      "duration": {
      "min": "10",
      "max": "20"
      },
      "unit": "times",
      "created_at": "2016-01-21 08:55:06",
      "updated_at": "2016-01-21 08:55:06",
      "is_completed": 0
      },
      {
      "id": "2",
      "name": "band dislocates",
      "duration": {
      "min": "10",
      "max": "20"
      },
      "unit": "times",
      "created_at": "2016-01-21 08:57:38",
      "updated_at": "2016-01-21 08:57:38",
      "is_completed": 0
      },
      {
      "id": "3",
      "name": "cat-camels",
      "duration": {
      "min": "10",
      "max": "20"
      },
      "unit": "times",
      "created_at": "2016-01-21 09:00:39",
      "updated_at": "2016-01-21 09:00:39",
      "is_completed": 0
      },
      {
      "id": "4",
      "name": "scapular shrugs",
      "duration": {
      "min": "10",
      "max": "20"
      },
      "unit": "times",
      "created_at": "2016-01-21 09:01:01",
      "updated_at": "2016-01-21 09:01:01",
      "is_completed": 0
      },
      {
      "id": "5",
      "name": "full body circles",
      "duration": {
      "min": "10",
      "max": "20"
      },
      "unit": "times",
      "created_at": "2016-01-21 09:01:26",
      "updated_at": "2016-01-21 09:01:26",
      "is_completed": 0
      },
      {
      "id": "6",
      "name": "Jumping Jacks",
      "duration": {
      "min": "100",
      "max": ""
      },
      "unit": "seconds",
      "created_at": "2016-01-21 09:04:52",
      "updated_at": "2016-01-21 09:04:52",
      "is_completed": 0
      },
      {
      "id": "7",
      "name": "Arm rotations",
      "duration": {
      "min": "120",
      "max": ""
      },
      "unit": "times",
      "created_at": "2016-01-21 09:05:29",
      "updated_at": "2016-01-21 09:05:29",
      "is_completed": 0
      },
      {
      "id": "8",
      "name": "High Knees",
      "duration": {
      "min": "50",
      "max": ""
      },
      "unit": "times",
      "created_at": "2016-01-21 09:06:02",
      "updated_at": "2016-01-21 09:06:02",
      "is_completed": 0
      },
      {
      "id": "9",
      "name": "Shouder rolls",
      "duration": {
      "min": "20",
      "max": ""
      },
      "unit": "times",
      "created_at": "2016-01-21 09:06:34",
      "updated_at": "2016-01-21 09:06:34",
      "is_completed": 0
      }
      ],
      "is_completed": 0,
      "fundumentals": [
      {
      "id": "42",
      "row": "4",
      "exercise_id": "6",
      "duration": {
      "min": "8",
      "max": "12"
      },
      "unit": "times",
      "is_completed": "0",
      "created_at": "2016-08-08 15:09:55",
      "updated_at": "2016-08-08 15:09:55",
      "exercise": {
      "id": "6",
      "name": "Australian Pull-ups",
      "description": "Australian Pull-ups",
      "category": "1",
      "type": "2",
      "muscle_groups": "",
      "rewards": "5.00",
      "repititions": "1",
      "duration": "1",
      "unit": "times",
      "equipment": "",
      "range_of_motion": "",
      "video_tips": "",
      "pro_tips": "",
      "video_tips_html": "",
      "pro_tips_html": "",
      "range_of_motion_html": "",
      "is_static": "0",
      "musclegroup_string": "",
      "video": [
      {
      "id": "84",
      "path": "90_1470654394.mp4",
      "videothumbnail": "90_1470654394.jpg",
      "description": "Australian Pull-ups"
      }
      ]
      }
      },
      {
      "id": "43",
      "row": "4",
      "exercise_id": "47",
      "duration": {
      "min": "8",
      "max": "12"
      },
      "unit": "times",
      "is_completed": "0",
      "created_at": "2016-08-08 15:11:38",
      "updated_at": "2016-08-08 15:11:38",
      "exercise": {
      "id": "47",
      "name": "Incline Pushups",
      "description": "Incline Pushups",
      "category": "1",
      "type": "1",
      "muscle_groups": "",
      "rewards": "5.00",
      "repititions": "1",
      "duration": "1",
      "unit": "times",
      "equipment": "",
      "range_of_motion": "",
      "video_tips": "",
      "pro_tips": "",
      "video_tips_html": "",
      "pro_tips_html": "",
      "range_of_motion_html": "",
      "is_static": "0",
      "musclegroup_string": "",
      "video": []
      }
      },
      {
      "id": "44",
      "row": "4",
      "exercise_id": "17",
      "duration": {
      "min": "8",
      "max": "12"
      },
      "unit": "times",
      "is_completed": "0",
      "created_at": "2016-08-08 15:12:32",
      "updated_at": "2016-08-08 15:12:32",
      "exercise": {
      "id": "17",
      "name": "Floor Triceps Ext.",
      "description": "Floor Triceps Ext.",
      "category": "1",
      "type": "1",
      "muscle_groups": "",
      "rewards": "6.00",
      "repititions": "1",
      "duration": "1",
      "unit": "times",
      "equipment": "",
      "range_of_motion": "",
      "video_tips": "",
      "pro_tips": "",
      "video_tips_html": "",
      "pro_tips_html": "",
      "range_of_motion_html": "",
      "is_static": "0",
      "musclegroup_string": "",
      "video": []
      }
      },
      {
      "id": "45",
      "row": "4",
      "exercise_id": "67",
      "duration": {
      "min": "12",
      "max": "15"
      },
      "unit": "times",
      "is_completed": "0",
      "created_at": "2016-08-08 15:13:45",
      "updated_at": "2016-08-08 15:14:03",
      "exercise": {
      "id": "67",
      "name": "Crunches",
      "description": "Crunches",
      "category": "1",
      "type": "1",
      "muscle_groups": "",
      "rewards": "5.00",
      "repititions": "1",
      "duration": "1",
      "unit": "times",
      "equipment": "",
      "range_of_motion": "",
      "video_tips": "",
      "pro_tips": "",
      "video_tips_html": "",
      "pro_tips_html": "",
      "range_of_motion_html": "",
      "is_static": "0",
      "musclegroup_string": "",
      "video": []
      }
      },
      {
      "id": "46",
      "row": "4",
      "exercise_id": "41",
      "duration": {
      "min": "12",
      "max": "20"
      },
      "unit": "times",
      "is_completed": "0",
      "created_at": "2016-08-08 15:15:05",
      "updated_at": "2016-08-08 15:15:05",
      "exercise": {
      "id": "41",
      "name": "Jumping Lunges",
      "description": "Jumping Lunges",
      "category": "3",
      "type": "1",
      "muscle_groups": "",
      "rewards": "10.00",
      "repititions": "1",
      "duration": "1",
      "unit": "times",
      "equipment": "",
      "range_of_motion": "",
      "video_tips": "",
      "pro_tips": "",
      "video_tips_html": "",
      "pro_tips_html": "",
      "range_of_motion_html": "",
      "is_static": "0",
      "musclegroup_string": "",
      "video": []
      }
      }
      ],
      "exercises": [],
      "workout": [],
      "skilltraining": {
      "id": "1",
      "name": "Muscleups (MU)",
      "description": "",
      "rewards": 330,
      "equipments": "",
      "is_circuit": "0",
      "created_at": "2016-08-02 10:56:33",
      "progression_string": "",
      "focus": 1,
      "exercises": [
      {
      "id": "1",
      "skilltraining_id": "1",
      "category": "1",
      "repititions": "5",
      "exercise_id": "110",
      "unit": "times",
      "sets": "3",
      "created_at": "2016-08-03 06:59:50",
      "updated_at": "2016-08-03 07:22:46",
      "video": {
      "id": "80",
      "path": "193_1470649743.mp4",
      "videothumbnail": "193_1470649743.jpg",
      "description": ""
      },
      "exercise": {
      "id": "110",
      "name": "Jump 2 MU",
      "description": "Jump 2 MU",
      "category": "3",
      "type": "2",
      "muscle_groups": "",
      "rewards": "5.00",
      "repititions": "1",
      "duration": "1",
      "unit": "times",
      "equipment": "",
      "range_of_motion": "1) Start with feet on the ground 2) Jump up into muscleup 3) Straight bar dip on top 4) Slow & controlled eccentric movement into starting position",
      "video_tips": "",
      "pro_tips": "",
      "video_tips_html": "",
      "pro_tips_html": "",
      "range_of_motion_html": "<p>1) Start with feet on the ground<br /> 2) Jump up into muscleup<br /> 3) Straight bar dip on top<br /> 4) Slow &amp; controlled eccentric movement into starting position</p>",
      "is_static": "0",
      "musclegroup_string": ""
      }
      },
      {
      "id": "2",
      "skilltraining_id": "1",
      "category": "1",
      "repititions": "10",
      "exercise_id": "3",
      "unit": "times",
      "sets": "3",
      "created_at": "2016-08-03 07:16:19",
      "updated_at": "2016-08-03 07:25:06",
      "video": {
      "id": "81",
      "path": "86_1470654172.mp4",
      "videothumbnail": "86_1470654172.jpg",
      "description": "Pull-ups "
      },
      "exercise": {
      "id": "3",
      "name": "Pull-ups ",
      "description": "Pull-ups ",
      "category": "2",
      "type": "1",
      "muscle_groups": "",
      "rewards": "7.00",
      "repititions": "1",
      "duration": "1",
      "unit": "times",
      "equipment": "",
      "range_of_motion": "1) Start in deadhang position 2) Pullup, chin above bar level 3) Slow & controlled movement into starting position",
      "video_tips": "",
      "pro_tips": "",
      "video_tips_html": "",
      "pro_tips_html": "",
      "range_of_motion_html": "<p>1) Start in deadhang position<br /> 2) Pullup, chin above bar level<br /> 3) Slow &amp; controlled movement into starting position</p>",
      "is_static": "0",
      "musclegroup_string": ""
      }
      },
      {
      "id": "3",
      "skilltraining_id": "1",
      "category": "1",
      "repititions": "20",
      "exercise_id": "48",
      "unit": "times",
      "sets": "3",
      "created_at": "2016-08-03 07:18:36",
      "updated_at": "2016-08-03 07:25:43",
      "video": {
      "id": "82",
      "path": "132_1470650036.mp4",
      "videothumbnail": "132_1470650036.jpg",
      "description": ""
      },
      "exercise": {
      "id": "48",
      "name": "Pushups",
      "description": "Pushups",
      "category": "1",
      "type": "1",
      "muscle_groups": "",
      "rewards": "6.00",
      "repititions": "1",
      "duration": "1",
      "unit": "times",
      "equipment": "",
      "range_of_motion": "",
      "video_tips": "",
      "pro_tips": "",
      "video_tips_html": "",
      "pro_tips_html": "",
      "range_of_motion_html": "",
      "is_static": "0",
      "musclegroup_string": ""
      }
      },
      {
      "id": "4",
      "skilltraining_id": "1",
      "category": "1",
      "repititions": "15",
      "exercise_id": "16",
      "unit": "times",
      "sets": "3",
      "created_at": "2016-08-03 07:26:11",
      "updated_at": "2016-08-03 07:26:11",
      "video": {
      "id": "83",
      "path": "100_1470654597.mp4",
      "videothumbnail": "100_1470654597.jpg",
      "description": "Bench Dips"
      },
      "exercise": {
      "id": "16",
      "name": "Bench Dips",
      "description": "Bench Dips",
      "category": "1",
      "type": "1",
      "muscle_groups": "",
      "rewards": "5.00",
      "repititions": "1",
      "duration": "1",
      "unit": "times",
      "equipment": "",
      "range_of_motion": "",
      "video_tips": "",
      "pro_tips": "",
      "video_tips_html": "",
      "pro_tips_html": "",
      "range_of_motion_html": "",
      "is_static": "0",
      "musclegroup_string": ""
      }
      },
      {
      "id": "5",
      "skilltraining_id": "1",
      "category": "1",
      "repititions": "15",
      "exercise_id": "6",
      "unit": "times",
      "sets": "3",
      "created_at": "2016-08-03 07:26:42",
      "updated_at": "2016-08-03 07:26:42",
      "video": {
      "id": "84",
      "path": "90_1470654394.mp4",
      "videothumbnail": "90_1470654394.jpg",
      "description": "Australian Pull-ups"
      },
      "exercise": {
      "id": "6",
      "name": "Australian Pull-ups",
      "description": "Australian Pull-ups",
      "category": "1",
      "type": "2",
      "muscle_groups": "",
      "rewards": "5.00",
      "repititions": "1",
      "duration": "1",
      "unit": "times",
      "equipment": "",
      "range_of_motion": "",
      "video_tips": "",
      "pro_tips": "",
      "video_tips_html": "",
      "pro_tips_html": "",
      "range_of_motion_html": "",
      "is_static": "0",
      "musclegroup_string": ""
      }
      }
      ]
      },
      "coach_workout_rounds": 1,
      "workout_intensity": 1,
      "hiit": [
      {
      "id": 2,
      "intensity": 4,
      "is_completed": 0,
      "replacement": [
      {
      "round1": [
      {
      "name": "Burpee Pushups",
      "duration": 10,
      "unit": "times",
      "exercise": {
      "id": "44",
      "name": "Burpee Pushups",
      "description": "Burpee Pushups",
      "category": "2",
      "type": "1",
      "muscle_groups": "",
      "rewards": "7.00",
      "repititions": "1",
      "duration": "1",
      "unit": "times",
      "equipment": "",
      "range_of_motion": "",
      "video_tips": "",
      "pro_tips": "",
      "video_tips_html": "",
      "pro_tips_html": "",
      "range_of_motion_html": "",
      "is_static": "0",
      "musclegroup_string": "",
      "video": []
      }
      },
      {
      "name": "Rest",
      "duration": 10,
      "unit": "seconds",
      "exercise": {
      "id": "152",
      "name": "Rest",
      "description": "Rest",
      "category": "1",
      "type": "1",
      "muscle_groups": "",
      "rewards": "0.00",
      "repititions": "1",
      "duration": "1",
      "unit": "seconds",
      "equipment": "",
      "range_of_motion": "",
      "video_tips": "",
      "pro_tips": "",
      "video_tips_html": "",
      "pro_tips_html": "",
      "range_of_motion_html": "",
      "is_static": "0",
      "musclegroup_string": "",
      "video": []
      }
      }
      ],
      "round2": [
      {
      "name": "Squat Jumps",
      "duration": 15,
      "unit": "times",
      "exercise": {
      "id": "40",
      "name": "Squat Jumps",
      "description": "Squat Jumps",
      "category": "3",
      "type": "1",
      "muscle_groups": "",
      "rewards": "7.00",
      "repititions": "1",
      "duration": "1",
      "unit": "times",
      "equipment": "",
      "range_of_motion": "",
      "video_tips": "",
      "pro_tips": "",
      "video_tips_html": "",
      "pro_tips_html": "",
      "range_of_motion_html": "",
      "is_static": "0",
      "musclegroup_string": "",
      "video": []
      }
      },
      {
      "name": "Rest",
      "duration": 10,
      "unit": "seconds",
      "exercise": {
      "id": "152",
      "name": "Rest",
      "description": "Rest",
      "category": "1",
      "type": "1",
      "muscle_groups": "",
      "rewards": "0.00",
      "repititions": "1",
      "duration": "1",
      "unit": "seconds",
      "equipment": "",
      "range_of_motion": "",
      "video_tips": "",
      "pro_tips": "",
      "video_tips_html": "",
      "pro_tips_html": "",
      "range_of_motion_html": "",
      "is_static": "0",
      "musclegroup_string": "",
      "video": []
      }
      }
      ],
      "round3": [
      {
      "name": "Knee Raises",
      "duration": 25,
      "unit": "times",
      "exercise": {
      "id": "86",
      "name": "Knee Raises",
      "description": "Knee Raises",
      "category": "1",
      "type": "1",
      "muscle_groups": "",
      "rewards": "5.00",
      "repititions": "1",
      "duration": "1",
      "unit": "times",
      "equipment": "",
      "range_of_motion": "",
      "video_tips": "",
      "pro_tips": "",
      "video_tips_html": "",
      "pro_tips_html": "",
      "range_of_motion_html": "",
      "is_static": "0",
      "musclegroup_string": "",
      "video": []
      }
      },
      {
      "name": "Rest",
      "duration": 10,
      "unit": "seconds",
      "exercise": {
      "id": "152",
      "name": "Rest",
      "description": "Rest",
      "category": "1",
      "type": "1",
      "muscle_groups": "",
      "rewards": "0.00",
      "repititions": "1",
      "duration": "1",
      "unit": "seconds",
      "equipment": "",
      "range_of_motion": "",
      "video_tips": "",
      "pro_tips": "",
      "video_tips_html": "",
      "pro_tips_html": "",
      "range_of_motion_html": "",
      "is_static": "0",
      "musclegroup_string": "",
      "video": []
      }
      }
      ]
      }
      ],
      "replacement_round_count": 3
      }
      ],
      "stretching": [
      {
      "id": "1",
      "exercise_id": "Superman",
      "duration": {
      "min": "5",
      "max": "10"
      },
      "unit": "times",
      "is_completed": "0",
      "created_at": "2016-01-22 07:10:31",
      "updated_at": "2016-01-22 07:10:31"
      },
      {
      "id": "2",
      "exercise_id": "Lower Back Strength",
      "duration": {
      "min": "30",
      "max": "50"
      },
      "unit": "times",
      "is_completed": "0",
      "created_at": "2016-01-22 07:15:02",
      "updated_at": "2016-01-22 07:15:02"
      },
      {
      "id": "3",
      "exercise_id": "Upper Dog",
      "duration": {
      "min": "30",
      "max": "60"
      },
      "unit": "seconds",
      "is_completed": "0",
      "created_at": "2016-01-22 07:16:03",
      "updated_at": "2016-01-22 07:16:03"
      },
      {
      "id": "4",
      "exercise_id": "Child's Pose",
      "duration": {
      "min": "30",
      "max": "60"
      },
      "unit": "seconds",
      "is_completed": "0",
      "created_at": "2016-01-22 07:16:46",
      "updated_at": "2016-01-22 07:16:46"
      },
      {
      "id": "5",
      "exercise_id": "L-sit on the floor",
      "duration": {
      "min": "30",
      "max": "60"
      },
      "unit": "seconds",
      "is_completed": "0",
      "created_at": "2016-01-22 07:17:13",
      "updated_at": "2016-01-22 07:17:13"
      },
      {
      "id": "6",
      "exercise_id": "Good morning",
      "duration": {
      "min": "30",
      "max": "60"
      },
      "unit": "seconds",
      "is_completed": "0",
      "created_at": "2016-01-22 07:17:43",
      "updated_at": "2016-01-22 07:17:43"
      },
      {
      "id": "7",
      "exercise_id": "Chest Opener",
      "duration": {
      "min": "30",
      "max": "60"
      },
      "unit": "seconds",
      "is_completed": "0",
      "created_at": "2016-01-22 07:19:32",
      "updated_at": "2016-01-22 07:19:32"
      },
      {
      "id": "8",
      "exercise_id": "Triceps Stretc",
      "duration": {
      "min": "30",
      "max": "60"
      },
      "unit": "seconds",
      "is_completed": "0",
      "created_at": "2016-01-22 07:19:56",
      "updated_at": "2016-01-22 07:19:56"
      },
      {
      "id": "9",
      "exercise_id": "Hands Back",
      "duration": {
      "min": "30",
      "max": "60"
      },
      "unit": "seconds",
      "is_completed": "0",
      "created_at": "2016-01-22 07:20:19",
      "updated_at": "2016-01-22 07:20:19"
      },
      {
      "id": "10",
      "exercise_id": "Shoulder Stretch",
      "duration": {
      "min": "30",
      "max": "60"
      },
      "unit": "seconds",
      "is_completed": "0",
      "created_at": "2016-01-22 07:20:45",
      "updated_at": "2016-01-22 07:20:45"
      }
      ]
      }
      },
      "category": "advanced",
      "muscle_groups": "",
      "limitations": "",
      "goal_option": "0",
      "feedback": "0",
      "created_at": "2016-08-10 07:19:11",
      "updated_at": "2016-08-12 05:06:11",
      "description": "Strive for progress",
      "musclegroup_string": "",
      "goaloption_string": ""
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
     * @apiError error Message user_not_exists
     * @apiError error Message Invalid options selected
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
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 500 Invalid options selected.
     *     {
      "status": 0,
      "message": "Invalid options selected. Please revisit your options to get your coach."
      }
     * 
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 500 raid not selected.
     *     {
      "status": 0,
      "message": "Please select a raid to continue."
      }
     */
    public function updateCoach(Request $request)
    {
        if (!isset($request->user_id) || ($request->user_id == null)) {
            return response()->json(["status" => "0", "error" => "The user_id field is required"]);
        } elseif (!isset($request->assessment) || ($request->assessment == null)) {
            return response()->json(["status" => "0", "error" => "The assessment field is required"]);
        } elseif (!isset($request->focus) || ($request->focus == null)) {
            return response()->json(["status" => "0", "error" => "The focus field is required"]);
        } elseif (!isset($request->days) || ($request->days == null)) {
            return response()->json(["status" => "0", "error" => "The days field is required"]);
        } else {
            $user = User::where('id', '=', $request->input('user_id'))->first();
            if (!is_null($user)) {

                $coach = Coach::where('user_id', $request->user_id)->first();

                $coachStatus = DB::table('coach_status')
                    ->where('user_id', $request->user_id)
                    ->where('coach_id', $coach->id)
                    ->first();

                $coach = Coach::where('user_id', $request->user_id)->first();

                $userRaidSelected = 0;

                $userGoalOption = DB::table('user_goal_options')->where('user_id', $request->user_id)->first();

                if (!is_null($userGoalOption)) {
                    if ($userGoalOption->goal_options != '') {
                        $userRaidSelected = 1;
                    }
                }

                if (($coachStatus->week + 1) > 4) {
                    if ($userRaidSelected == 0) {
                        return response()->json(["status" => "0", "error" => "Please select a raid to continue."]);
                    }
                }

                if ($request->assessment != 3 && $userRaidSelected == 0) {
                    return response()->json(["status" => "0", "error" => "Please select a raid to continue."]);
                }

                for ($i = 1; $i <= $request->days; $i++) {
                    $statusArray[$i] = 0;
                }

                $weekStatusArray = json_decode($coachStatus->week_status, TRUE);

                for ($j = 1; $j <= $coach->weeks; $j++) {
                    $weekStatusArray[$j] = 1;
                }

                $weekStatusArray[$coachStatus->week + 1] = 0;
                //Code added by ansa@cubettech.com on 09-05-2016
                //To update goal in user_profile.
                Profile::where('user_id', $request->user_id)->update([
                    'goal' => $request->focus
                ]);

                $profile = Profile::where('user_id', $request->user_id)->first();

                $exercises = Coach::updateCoach($request->assessment, $coach->id, $profile->goal, $request->days);

                if ($exercises) {

                    DB::table('coach_status')
                        ->where('coach_id', $coach->id)
                        ->update([
                            'day_status' => json_encode($statusArray),
                            'week_status' => json_encode($weekStatusArray),
                            'need_update' => 0,
                            'day' => 1,
                            'week' => $coachStatus->week + 1
                    ]);

                    Coach::where('user_id', $request->user_id)->update([
                        'exercises' => json_encode($exercises),
                        'days' => $request->days,
                        'focus' => $profile->goal
                    ]);

                    $coach = Coach::where('user_id', $request->user_id)->first();

                    $coach->musclegroup_string = Coach::musclegroupString($coach->muscle_groups);

                    $coach->limitations = Coach::musclegroupString($coach->limitations);

                    $coach->goaloption_string = Coach::goaloptionString($coach->goal_option);

                    $coach->exercises = json_decode($coach->exercises, true);

                    $coachStatus = DB::table('coach_status')->where('coach_id', $coach->id)->first();

                    $dayStatus = json_decode($coachStatus->day_status, true);

                    $weekStatus = json_decode($coachStatus->week_status, true);

                    if ($coachStatus->week <= 15) {
                        $coach->description = DB::table('coach_descriptions')->where('week', $coachStatus->week)->pluck('description');
                    } else {
                        $coach->description = DB::table('coach_descriptions')->where('week', 15)->pluck('description');
                    }

                    return response()->json([
                            'status' => 1,
                            'message' => 'Successfully updated coach exercises',
                            'coach_day' => 1,
                            'coach_week' => $coachStatus->week,
                            'is_subscribed' => $user->is_subscribed,
                            'need_update' => 0,
                            'week_status' => $weekStatus,
                            'day_status' => $dayStatus,
                            'week_points' => DB::table('coach_points')->where('user_id', $request->user_id)->where('week', $coachStatus->week)->sum('points'),
                            'coach' => $coach,
                            'urls' => config('urls.urls')], 200);
                } else {
                    return response()->json([
                            'status' => 0,
                            'message' => 'Invalid options selected. Please revisit your options to get your coach.'], 500);
                }
            } else {
                return response()->json(['status' => 0, 'error' => 'user_not_exists'], 500);
            }
        }
    }

    /**
     * @api {post} /coach/getmusclegroups getmusclegroups
     * @apiName getMusclegroups
     * @apiGroup Coach
     * @apiParam {Number} user_id Id of user *required
     * @apiSuccess {String} success.
     * @apiSuccessExample Success-Response:
     * HTTP/1.1 200 OK
     * 
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
    public function getMuscleGroups(Request $request)
    {

        if (!isset($request->user_id) || ($request->user_id == null)) {
            return response()->json(["status" => "0", "error" => "The user_id field is required"]);
        } else {
            $user = User::where('id', '=', $request->input('user_id'))->first();
            if (!is_null($user)) {

                $muscleGroups = Musclegroup::all();

                return response()->json([
                        'status' => 1,
                        'muscle_groups' => $muscleGroups
                        ], 200);
            } else {
                return response()->json(['status' => 0, 'error' => 'user_not_exists'], 500);
            }
        }
    }

    /**
     * @api {post} /coach/reset resetCoach
     * @apiName resetCoach
     * @apiGroup Coach
     * @apiParam {Number} user_id Id of user *required
     * @apiSuccess {String} success.
     * @apiSuccessExample Success-Response:
     * HTTP/1.1 200 OK
     * {
      "status": 1,
      "message": "successfully_reset_coach"
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
    public function resetCoach(Request $request)
    {

        if (!isset($request->user_id) || ($request->user_id == null)) {
            return response()->json(["status" => "0", "error" => "The user_id field is required"]);
        } else {
            $user = User::where('id', '=', $request->input('user_id'))->first();
            if (!is_null($user)) {

                Coach::where('user_id', $request->user_id)->delete();

                DB::table('coach_points')->where('user_id', $request->user_id)->delete();

                DB::table('coach_status')->where('user_id', $request->user_id)->delete();

                return response()->json([
                        'status' => 1,
                        'message' => 'successfully_reset_coach'
                        ], 200);
            } else {
                return response()->json(['status' => 0, 'error' => 'user_not_exists'], 500);
            }
        }
    }

    /**
     * Function to test replacement of html tags
     * @param Request $request
     * @author Aneesh K<aneeshk@cubettech.com>
     */
    public function test(Request $request)
    {
        $str = "<p>Some Text Here for some good fun mmhmmm</p>\n<ul>\n<li>List</li>\n<li>Item</li>\n</ul>\n\n<ol>\n<li>Listo</li>\n<li>Itemo</li>\n</ol>\n<ul>\n<li>List2</li>\n<li>Item2</li>\n</ul>\n";

        preg_match_all('!<ul>(.+?)</ul>!s', $str, $matches);

        foreach ($matches[1] AS $string) {
            $var[] = preg_replace("/(?:<li>(.+?)<\/li>)/", "$1\n", $string);
        }

        $str = str_replace($matches[0], $var, $str);

        echo $str;
    }
}
