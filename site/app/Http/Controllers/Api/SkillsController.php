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
use App\Skill;
use App\Progression;
use App\Unlockedexercise;

class SkillsController extends Controller
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
     * @api {post} /skills/list loadSkills
     * @apiName loadSkills
     * @apiGroup Skill
     * @apiParam {Number} user_id Id of user *required
     * @apiSuccess {String} success.
     * @apiSuccessExample Success-Response:
     * HTTP/1.1 200 OK
     * {
      "status": 1,
      "skills": {
      "pull": [
      {
      "id": "3",
      "progression_id": "1",
      "level": "3",
      "row": "1",
      "substitute": "53",
      "exercise_id": "32",
      "created_at": "2015-12-14 03:04:45",
      "updated_at": "2015-12-15 05:48:46",
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
      "equipment": ""
      }
      },
      {
      "id": "6",
      "progression_id": "1",
      "level": "1",
      "row": "2",
      "substitute": "22",
      "exercise_id": "2",
      "created_at": "2015-12-14 03:04:45",
      "updated_at": "2015-12-15 05:48:46",
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
      "equipment": ""
      }
      },
      {
      "id": "11",
      "progression_id": "1",
      "level": "1",
      "row": "3",
      "substitute": "23",
      "exercise_id": "3",
      "created_at": "2015-12-14 03:04:45",
      "updated_at": "2015-12-15 05:48:46",
      "exercise": {
      "id": "3",
      "name": "Knee Raises",
      "description": "Standing Knee Raises (also known as standing knee crunches and standing knee pulls) is a functional abdominal exercise for boosting strength throughout the core. Unlike standard ab exercises, they don’t isolate abdominal muscles. Instead they work your upper abs and lower abs in conjunction with other important muscles such as hips, back and shoulders.",
      "category": "1",
      "type": "2",
      "rewards": "6.00",
      "repititions": "10",
      "duration": "1.00",
      "unit": "times",
      "equipment": ""
      }
      },
      {
      "id": "16",
      "progression_id": "1",
      "level": "1",
      "row": "4",
      "substitute": "24",
      "exercise_id": "4",
      "created_at": "2015-12-14 03:04:45",
      "updated_at": "2015-12-15 05:48:46",
      "exercise": {
      "id": "4",
      "name": "Skin the cat",
      "description": "A good upper body stretching exercise, especially for achieving full range of motion in the shoulder. The skin the cat exercise is a fundamental movement performed on gymnastics rings.",
      "category": "1",
      "type": "2",
      "rewards": "6.00",
      "repititions": "10",
      "duration": "1.00",
      "unit": "times",
      "equipment": ""
      }
      }
      ],
      "dip": [
      {
      "id": "22",
      "progression_id": "2",
      "level": "2",
      "row": "1",
      "substitute": "57",
      "exercise_id": "36",
      "created_at": "2015-12-14 03:04:45",
      "updated_at": "2015-12-15 05:48:46",
      "exercise": {
      "id": "36",
      "name": "Dips (Bench)",
      "description": "",
      "category": "2",
      "type": "1",
      "rewards": "6.00",
      "repititions": "10",
      "duration": "1.00",
      "unit": "times",
      "equipment": ""
      }
      },
      {
      "id": "25",
      "progression_id": "2",
      "level": "1",
      "row": "2",
      "substitute": 0,
      "exercise_id": "6",
      "created_at": "2015-12-14 03:04:45",
      "updated_at": "2015-12-15 05:48:46",
      "exercise": {
      "id": "6",
      "name": "Trizeps Extension",
      "description": "",
      "category": "1",
      "type": "2",
      "rewards": "6.00",
      "repititions": "10",
      "duration": "1.00",
      "unit": "times",
      "equipment": ""
      }
      }
      ],
      "full_body": [
      {
      "id": "29",
      "progression_id": "3",
      "level": "1",
      "row": "1",
      "substitute": 0,
      "exercise_id": "7",
      "created_at": "2015-12-14 03:04:45",
      "updated_at": "2015-12-15 05:48:46",
      "exercise": {
      "id": "7",
      "name": "Wall Sits",
      "description": "",
      "category": "1",
      "type": "1",
      "rewards": "6.00",
      "repititions": "10",
      "duration": "1.00",
      "unit": "times",
      "equipment": ""
      }
      },
      {
      "id": "33",
      "progression_id": "3",
      "level": "1",
      "row": "2",
      "substitute": 0,
      "exercise_id": "8",
      "created_at": "2015-12-14 03:04:45",
      "updated_at": "2015-12-15 05:48:46",
      "exercise": {
      "id": "8",
      "name": "Single Leg Deadlift",
      "description": "",
      "category": "1",
      "type": "2",
      "rewards": "6.00",
      "repititions": "10",
      "duration": "1.00",
      "unit": "times",
      "equipment": ""
      }
      },
      {
      "id": "36",
      "progression_id": "3",
      "level": "1",
      "row": "3",
      "substitute": 0,
      "exercise_id": "9",
      "created_at": "2015-12-14 03:04:45",
      "updated_at": "2015-12-15 05:48:46",
      "exercise": {
      "id": "9",
      "name": "Climbers",
      "description": "",
      "category": "1",
      "type": "2",
      "rewards": "6.00",
      "repititions": "10",
      "duration": "1.00",
      "unit": "times",
      "equipment": ""
      }
      },
      {
      "id": "39",
      "progression_id": "3",
      "level": "1",
      "row": "4",
      "substitute": 0,
      "exercise_id": "10",
      "created_at": "2015-12-14 03:04:45",
      "updated_at": "2015-12-15 05:48:46",
      "exercise": {
      "id": "10",
      "name": "High Jumps",
      "description": "",
      "category": "1",
      "type": "2",
      "rewards": "6.00",
      "repititions": "10",
      "duration": "1.00",
      "unit": "times",
      "equipment": ""
      }
      },
      {
      "id": "43",
      "progression_id": "3",
      "level": "1",
      "row": "5",
      "substitute": 0,
      "exercise_id": "11",
      "created_at": "2015-12-14 03:04:45",
      "updated_at": "2015-12-15 05:48:46",
      "exercise": {
      "id": "11",
      "name": "Sprawl",
      "description": "",
      "category": "1",
      "type": "1",
      "rewards": "6.00",
      "repititions": "10",
      "duration": "1.00",
      "unit": "times",
      "equipment": ""
      }
      }
      ],
      "push": [
      {
      "id": "46",
      "progression_id": "4",
      "level": "1",
      "row": "1",
      "substitute": "25",
      "exercise_id": "12",
      "created_at": "2015-12-14 03:04:45",
      "updated_at": "2015-12-15 05:48:46",
      "exercise": {
      "id": "12",
      "name": "Incline Pushups",
      "description": "",
      "category": "1",
      "type": "1",
      "rewards": "6.00",
      "repititions": "10",
      "duration": "1.00",
      "unit": "times",
      "equipment": ""
      }
      },
      {
      "id": "66",
      "progression_id": "4",
      "level": "1",
      "row": "2",
      "substitute": "26",
      "exercise_id": "13",
      "created_at": "2015-12-14 03:04:45",
      "updated_at": "2015-12-15 05:48:46",
      "exercise": {
      "id": "13",
      "name": "Military Press",
      "description": "",
      "category": "1",
      "type": "1",
      "rewards": "6.00",
      "repititions": "10",
      "duration": "1.00",
      "unit": "times",
      "equipment": ""
      }
      },
      {
      "id": "71",
      "progression_id": "4",
      "level": "1",
      "row": "3",
      "substitute": 0,
      "exercise_id": "14",
      "created_at": "2015-12-14 03:04:45",
      "updated_at": "2015-12-15 05:48:46",
      "exercise": {
      "id": "14",
      "name": "Decline Pushups",
      "description": "",
      "category": "1",
      "type": "2",
      "rewards": "6.00",
      "repititions": "10",
      "duration": "1.00",
      "unit": "times",
      "equipment": ""
      }
      },
      {
      "id": "74",
      "progression_id": "4",
      "level": "1",
      "row": "4",
      "substitute": 0,
      "exercise_id": "15",
      "created_at": "2015-12-14 03:04:45",
      "updated_at": "2015-12-15 05:48:46",
      "exercise": {
      "id": "15",
      "name": "Explosive Pushups",
      "description": "",
      "category": "1",
      "type": "2",
      "rewards": "6.00",
      "repititions": "10",
      "duration": "1.00",
      "unit": "times",
      "equipment": ""
      }
      }
      ],
      "core": [
      {
      "id": "78",
      "progression_id": "5",
      "level": "1",
      "row": "1",
      "substitute": "27",
      "exercise_id": "16",
      "created_at": "2015-12-14 03:04:45",
      "updated_at": "2015-12-15 05:48:46",
      "exercise": {
      "id": "16",
      "name": "Crunches",
      "description": "",
      "category": "1",
      "type": "1",
      "rewards": "6.00",
      "repititions": "10",
      "duration": "1.00",
      "unit": "times",
      "equipment": ""
      }
      },
      {
      "id": "107",
      "progression_id": "5",
      "level": "1",
      "row": "2",
      "substitute": 0,
      "exercise_id": "17",
      "created_at": "2015-12-14 03:04:45",
      "updated_at": "2015-12-15 05:48:46",
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
      "equipment": ""
      }
      },
      {
      "id": "111",
      "progression_id": "5",
      "level": "1",
      "row": "3",
      "substitute": "23",
      "exercise_id": "3",
      "created_at": "2015-12-14 03:04:45",
      "updated_at": "2015-12-15 05:48:46",
      "exercise": {
      "id": "3",
      "name": "Knee Raises",
      "description": "Standing Knee Raises (also known as standing knee crunches and standing knee pulls) is a functional abdominal exercise for boosting strength throughout the core. Unlike standard ab exercises, they don’t isolate abdominal muscles. Instead they work your upper abs and lower abs in conjunction with other important muscles such as hips, back and shoulders.",
      "category": "1",
      "type": "2",
      "rewards": "6.00",
      "repititions": "10",
      "duration": "1.00",
      "unit": "times",
      "equipment": ""
      }
      },
      {
      "id": "116",
      "progression_id": "5",
      "level": "1",
      "row": "4",
      "substitute": "29",
      "exercise_id": "18",
      "created_at": "2015-12-14 03:04:45",
      "updated_at": "2015-12-15 05:48:46",
      "exercise": {
      "id": "18",
      "name": "Tucked Human Flag",
      "description": "",
      "category": "1",
      "type": "2",
      "rewards": "6.00",
      "repititions": "",
      "duration": "1.00",
      "unit": "times",
      "equipment": ""
      }
      },
      {
      "id": "122",
      "progression_id": "5",
      "level": "3",
      "row": "5",
      "substitute": "67",
      "exercise_id": "51",
      "created_at": "2015-12-14 03:04:45",
      "updated_at": "2015-12-15 05:48:46",
      "exercise": {
      "id": "51",
      "name": "One Leg Dragon Flag",
      "description": "",
      "category": "2",
      "type": "2",
      "rewards": "6.00",
      "repititions": "10",
      "duration": "1.00",
      "unit": "times",
      "equipment": ""
      }
      },
      {
      "id": "125",
      "progression_id": "5",
      "level": "1",
      "row": "6",
      "substitute": "31",
      "exercise_id": "20",
      "created_at": "2015-12-14 03:04:45",
      "updated_at": "2015-12-15 05:48:46",
      "exercise": {
      "id": "20",
      "name": "Tuck Planche",
      "description": "",
      "category": "1",
      "type": "2",
      "rewards": "6.00",
      "repititions": "10",
      "duration": "1.00",
      "unit": "times",
      "equipment": ""
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
     *       "status":0,
     *       "error": "token_invalid"
     *     }
     * 
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 401 Unauthorised
     *     {
     *       "status":0,
     *       "error": "token_expired"
     *     }
     * 
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 400 Bad Request
     *     {
     *       "status":0,
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
    public function loadSkills(Request $request)
    {
        if (!isset($request->user_id) || ($request->user_id == null)) {
            return response()->json(["status" => 0, "error" => "The user_id field is required"]);
        } else {
            $user = User::where('id', '=', $request->input('user_id'))->first();
            if (!is_null($user)) {
                $skills = [];

                $unlockedSkillsQuery = DB::table('unlocked_skills')
                    ->select('exercise_id')
                    ->whereRaw('user_id = ' . $request->user_id)
                    ->toSql();

                //need to find how many rows in each progression and need to find the exercise to be unlocked 
                //by the user in that row.
                //Get pull progression row count.

                $pullRowCount = count(Skill::where('progression_id', 1)->groupBy('row')->get());


                $i = 1;

                do {

                    $skill = Skill::where('row', $i)->where('progression_id', 1)->with(['exercise'])->orderBy('skills.level', 'DESC')->first();

                    $skills['pull'][] = $skill->toArray();

                    $i++;
                } while ($i <= $pullRowCount);

                $i = 1;

                $dipRowCount = count(Skill::where('progression_id', 2)->groupBy('row')->get());

                do {
                    $skill = Skill::where('row', $i)->where('progression_id', 2)->with(['exercise'])->orderBy('skills.level', 'DESC')->first();

                    $skills['dip'][] = $skill->toArray();
                    $i++;
                    unset($skill);
                } while ($i <= $dipRowCount);

                $i = 1;

                $fullBodyRowCount = count(Skill::where('progression_id', 3)->groupBy('row')->get());

                do {

                    $skill = Skill::where('row', $i)->where('progression_id', 3)->with(['exercise'])->orderBy('skills.level', 'DESC')->first();

                    $skills['full_body'][] = $skill->toArray();
                    $i++;
                    unset($skill);
                } while ($i <= $fullBodyRowCount);

                $i = 1;

                $pushRowCount = count(Skill::where('progression_id', 4)->groupBy('row')->get());

                do {


                    $skill = Skill::where('row', $i)->where('progression_id', 4)->with(['exercise'])->orderBy('skills.level', 'DESC')->first();

                    $skills['push'][] = $skill->toArray();
                    $i++;
                    unset($skill);
                } while ($i <= $pushRowCount);

                $i = 1;

                $coreRowCount = count(Skill::where('progression_id', 5)->groupBy('row')->get());

                do {

                    $skill = Skill::where('row', $i)->where('progression_id', 5)->with(['exercise'])->orderBy('skills.level', 'ASC')->first();

                    $skills['core'][] = $skill->toArray();
                    $i++;
                    unset($skill);
                } while ($i <= $coreRowCount);

                return response()->json([
                        'status' => 1,
                        'skills' => $skills,
                        'is_subscribed' => $user->is_subscribed,
                        'urls' => config('urls.urls')], 200);
            } else {
                return response()->json(['status' => 0, 'error' => 'user_not_exists'], 500);
            }
        }
    }

    /**
     * @api {post} /skills/getlevelskills getLevelSkills
     * @apiName getLevelSkills
     * @apiGroup Skill
     * @apiParam {Number} user_id Id of user *required
     * @apiParam {Number} skill_id Id of skill *required
     * @apiSuccess {String} success.
     * @apiSuccessExample Success-Response:
     * HTTP/1.1 200 OK
     * {
      "status": 1,
      "skills": [
      {
      "id": "21",
      "progression_id": "2",
      "level": "1",
      "row": "1",
      "substitute": "0",
      "exercise_id": "5",
      "created_at": "2015-12-14 03:04:45",
      "updated_at": "2015-12-15 05:48:46",
      "isLocked": 0,
      "isLockable": 0,
      "isUnlockable": 1,
      "exercise": {
      "id": "5",
      "name": "Side Trizeps",
      "description": "",
      "category": "1",
      "type": "1",
      "rewards": "6.00",
      "repititions": "10",
      "duration": "30.00",
      "unit": "times",
      "equipment": ""
      }
      },
      {
      "id": "22",
      "progression_id": "2",
      "level": "2",
      "row": "1",
      "substitute": "57",
      "exercise_id": "36",
      "created_at": "2015-12-14 03:04:45",
      "updated_at": "2015-12-15 05:48:46",
      "isLocked": 1,
      "isLockable": 0,
      "isUnlockable": 1,
      "exercise": {
      "id": "36",
      "name": "Dips (Bench)",
      "description": "",
      "category": "2",
      "type": "1",
      "rewards": "6.00",
      "repititions": "10",
      "duration": "1.00",
      "unit": "times",
      "equipment": ""
      }
      },
      {
      "id": "23",
      "progression_id": "2",
      "level": "3",
      "row": "1",
      "substitute": "36",
      "exercise_id": "57",
      "created_at": "2015-12-14 03:04:45",
      "updated_at": "2015-12-15 05:48:46",
      "isLocked": 1,
      "isLockable": 0,
      "isUnlockable": 1,
      "exercise": {
      "id": "57",
      "name": "Elevated Dips",
      "description": "",
      "category": "2",
      "type": "1",
      "rewards": "6.00",
      "repititions": "10",
      "duration": "1.00",
      "unit": "times",
      "equipment": ""
      }
      },
      {
      "id": "24",
      "progression_id": "2",
      "level": "4",
      "row": "1",
      "substitute": "0",
      "exercise_id": "70",
      "created_at": "2015-12-14 03:04:45",
      "updated_at": "2015-12-15 05:48:46",
      "isLocked": 1,
      "isLockable": 0,
      "isUnlockable": 0,
      "exercise": {
      "id": "70",
      "name": "Dips",
      "description": "",
      "category": "3",
      "type": "1",
      "rewards": "6.00",
      "repititions": "10",
      "duration": "1.00",
      "unit": "times",
      "equipment": ""
      }
      }
      ],
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
     * 
     * 
     * @apiError error Message token_invalid.
     * @apiError error Message token_expired.
     * @apiError error Message token_not_provided.
     * @apiError error Message Validation error
     * @apiError error Message Validation error
     * @apiError error Message user_not_exists
     *
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 400 Invalid Request
     *     {
     *       "status":0,
     *       "error": "token_invalid"
     *     }
     * 
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 401 Unauthorised
     *     {
     *       "status":0,
     *       "error": "token_expired"
     *     }
     * 
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 400 Bad Request
     *     {
     *       "status":0,
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
     *     HTTP/1.1 422 Validation error
     *     {
     *       "status" : 0,
     *       "error": "The skill_id field is required"
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
    public function getLevelSkills(Request $request)
    {
        if (!isset($request->user_id) || ($request->user_id == null)) {
            return response()->json(["status" => 0, "error" => "The user_id field is required"]);
        } elseif (!isset($request->skill_id) || ($request->skill_id == null)) {
            return response()->json(["status" => 0, "error" => "The skill_id field is required"]);
        } else {
            $user = User::where('id', '=', $request->input('user_id'))->first();
            if (!is_null($user)) {

                $skill = Skill::where('id', $request->skill_id)->first();

                $skills = Skill::where('row', $skill->row)->where('progression_id', $skill->progression_id)->with(['exercise'])->orderBy('level', 'ASC')->get();
                foreach ($skills as $sKey => $sValue) {
                    $skills[$sKey]->isLocked = $this->isLocked($sValue, $request->user_id);
                    $skills[$sKey]->isLockable = $this->isLockable($sValue, $request->user_id);
                    $skills[$sKey]->isUnlockable = $this->isUnlockable($sValue, $request->user_id);
                }
            } else {
                return response()->json(['status' => 0, 'error' => 'user_not_exists'], 500);
            }

            return response()->json([
                    'status' => 1,
                    'skills' => $skills,
                    'is_subscribed' => $user->is_subscribed,
                    'urls' => config('urls.urls')], 200);
        }
    }

    public function isLocked($skill, $userId)
    {
        $unLockCount = DB::table('unlocked_skills')
            ->select('exercise_id')
            ->whereRaw('user_id = ' . $userId . ' AND skill_id = ' . $skill->id)
            ->count();
        

        if ($unLockCount > 0 || $skill->level < 2) {
            return 0;
        }

        return 1;
    }

    public function isLockable($skill, $userId)
    {
        if ($skill->level < 2) {
            return 0;
        }
        $unLockCount = DB::table('unlocked_skills')
            ->select('exercise_id')
            ->whereRaw('user_id = ' . $userId . ' AND skill_id = ' . $skill->id)
            ->count();

        if ($unLockCount > 0) {
            return 1;
        }

        return 0;
    }

    public function isUnlockable($skill, $userId)
    {
        if ($skill->level >= 2) {
            //check whether the skill already unlocked
            $unLockCount = DB::table('unlocked_skills')
                ->select('exercise_id')
                ->whereRaw('user_id = ' . $userId . ' AND skill_id = ' . $skill->id)
                ->count();
            if ($unLockCount > 0) {
                return 0;
            } else {
                //check whether previous level skills unlocked or not
                //get previous level skill

                $skill = Skill::where('id', $skill->id)->first();

                $prevSkill = Skill::where('row', $skill->row)
                    ->where('progression_id', $skill->progression_id)
                    ->where('level', ($skill->level - 1))
                    ->first();

                $unLockCount = DB::table('unlocked_skills')
                    ->select('exercise_id')
                    ->whereRaw('user_id = ' . $userId . ' AND skill_id = ' . $prevSkill->id)
                    ->count();
                if ($unLockCount > 0) {
                    return 1;
                }
            }
        }
        return 0;
    }

    /**
     * @api {post} /skills/unlockskill unlockSkill
     * @apiName unlockSkill
     * @apiGroup Skill
     * @apiParam {Number} user_id Id of user *required
     * @apiParam {Number} skill_id Id of skill *required
     * @apiSuccess {String} success.
     * @apiSuccessExample Success-Response:
     * HTTP/1.1 200 OK
     * {
          "status": 1,
          "message": "successfully unlocked the skill",
          "skills": [
            {
              "id": "11",
              "progression_id": "1",
              "level": "1",
              "row": "3",
              "substitute": "23",
              "exercise_id": "3",
              "created_at": "2015-12-14 03:04:45",
              "updated_at": "2015-12-15 05:48:46",
              "isLocked": 0,
              "isLockable": 0,
              "isUnlockable": 0,
              "exercise": {
                "id": "3",
                "name": "Knee Raises",
                "description": "Standing Knee Raises (also known as standing knee crunches and standing knee pulls) is a functional abdominal exercise for boosting strength throughout the core. Unlike standard ab exercises, they don’t isolate abdominal muscles. Instead they work your upper abs and lower abs in conjunction with other important muscles such as hips, back and shoulders.",
                "category": "1",
                "type": "2",
                "rewards": "6.00",
                "repititions": "10",
                "duration": "1.00",
                "unit": "times",
                "equipment": ""
              }
            },
            {
              "id": "12",
              "progression_id": "1",
              "level": "2",
              "row": "3",
              "substitute": "0",
              "exercise_id": "23",
              "created_at": "2015-12-14 03:04:45",
              "updated_at": "2016-01-04 10:24:35",
              "isLocked": 1,
              "isLockable": 0,
              "isUnlockable": 1,
              "exercise": {
                "id": "23",
                "name": "Leg Raises",
                "description": "",
                "category": "1",
                "type": "2",
                "rewards": "6.00",
                "repititions": "10",
                "duration": "1.00",
                "unit": "times",
                "equipment": ""
              }
            },
            {
              "id": "13",
              "progression_id": "1",
              "level": "3",
              "row": "3",
              "substitute": "55",
              "exercise_id": "34",
              "created_at": "2015-12-14 03:04:45",
              "updated_at": "2015-12-15 05:48:46",
              "isLocked": 1,
              "isLockable": 0,
              "isUnlockable": 0,
              "exercise": {
                "id": "34",
                "name": "L-Sit",
                "description": "",
                "category": "2",
                "type": "2",
                "rewards": "6.00",
                "repititions": "10",
                "duration": "1.00",
                "unit": "times",
                "equipment": ""
              }
            },
            {
              "id": "14",
              "progression_id": "1",
              "level": "4",
              "row": "3",
              "substitute": "0",
              "exercise_id": "55",
              "created_at": "2015-12-14 03:04:45",
              "updated_at": "2016-01-04 10:24:44",
              "isLocked": 1,
              "isLockable": 0,
              "isUnlockable": 0,
              "exercise": {
                "id": "55",
                "name": "L-Sit Pullup",
                "description": "",
                "category": "2",
                "type": "2",
                "rewards": "6.00",
                "repititions": "10",
                "duration": "1.00",
                "unit": "times",
                "equipment": ""
              }
            },
            {
              "id": "15",
              "progression_id": "1",
              "level": "5",
              "row": "3",
              "substitute": "0",
              "exercise_id": "78",
              "created_at": "2015-12-14 03:04:45",
              "updated_at": "2015-12-15 05:48:46",
              "isLocked": 0,
              "isLockable": 1,
              "isUnlockable": 0,
              "exercise": {
                "id": "78",
                "name": "Pullover",
                "description": "",
                "category": "3",
                "type": "2",
                "rewards": "10.00",
                "repititions": "10",
                "duration": "1.00",
                "unit": "times",
                "equipment": ""
              }
            }
          ],
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
     * 
     * 
     * @apiError error Message token_invalid.
     * @apiError error Message token_expired.
     * @apiError error Message token_not_provided.
     * @apiError error Message Validation error
     * @apiError error Message Validation error
     * @apiError error Message user_not_exists
     *
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 400 Invalid Request
     *     {
     *       "status":0,
     *       "error": "token_invalid"
     *     }
     * 
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 401 Unauthorised
     *     {
     *       "status":0,
     *       "error": "token_expired"
     *     }
     * 
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 400 Bad Request
     *     {
     *       "status":0,
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
     *     HTTP/1.1 422 Validation error
     *     {
     *       "status" : 0,
     *       "error": "The skill_id field is required"
     *     }
     * 
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 500 user_not_exists
     *     {
     *       "status" : 0,
     *       "error": "user_not_exists"
     *     }
     * 
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 500 already unlocked the skill
     *     {
     *       "status" : 0,
     *       "error": "already unlocked the skill"
     *     }
     * 
     */
    public function unlockSkill(Request $request)
    {
        if (!isset($request->user_id) || ($request->user_id == null)) {
            return response()->json(["status" => 0, "error" => "The user_id field is required"]);
        } elseif (!isset($request->skill_id) || ($request->skill_id == null)) {
            return response()->json(["status" => 0, "error" => "The skill_id field is required"]);
        } else {
            $user = User::where('id', '=', $request->input('user_id'))->first();
            if (!is_null($user)) {
                $isUnlocked = Unlockedexercise::where('skill_id', $request->skill_id)->where('user_id', $request->user_id)->count();
                if ($isUnlocked > 1) {
                    return response()->json(['status' => 0, 'error' => 'already unlocked the skill'], 500);
                } else {
                    $unlockedSkill = Skill::where('id', $request->skill_id)->first();
                    Unlockedexercise::create([
                        'skill_id' => $unlockedSkill->id,
                        'exercise_id' => $unlockedSkill->exercise_id,
                        'user_id' => $request->user_id
                    ]);                    

                    $skills = Skill::where('row', $unlockedSkill->row)->where('progression_id', $unlockedSkill->progression_id)->with(['exercise'])->orderBy('level', 'ASC')->get();
                    foreach ($skills as $sKey => $sValue) {
                        $skills[$sKey]->isLocked = $this->isLocked($sValue, $request->user_id);
                        $skills[$sKey]->isLockable = $this->isLockable($sValue, $request->user_id);
                        $skills[$sKey]->isUnlockable = $this->isUnlockable($sValue, $request->user_id);
                    }

                    return response()->json([
                            'status' => 1,
                            'message' => 'successfully unlocked the skill',
                            'skills' => $skills,
                            'is_subscribed' => $user->is_subscribed,
                            'urls' => config('urls.urls')], 200);
                }
            } else {
                return response()->json(['status' => 0, 'error' => 'user_not_exists'], 500);
            }
        }
    }

    /**
     * @api {post} /skills/lockskill lockSkill
     * @apiName lockSkill
     * @apiGroup Skill
     * @apiParam {Number} user_id Id of user *required
     * @apiParam {Number} skill_id Id of skill *required
     * @apiSuccess {String} success.
     * @apiSuccessExample Success-Response:
     * HTTP/1.1 200 OK
     * {
          "status": 1,
          "message": "successfully locked the skill",
          "skills": [
            {
              "id": "11",
              "progression_id": "1",
              "level": "1",
              "row": "3",
              "substitute": "23",
              "exercise_id": "3",
              "created_at": "2015-12-14 03:04:45",
              "updated_at": "2015-12-15 05:48:46",
              "isLocked": 0,
              "isLockable": 0,
              "isUnlockable": 0,
              "exercise": {
                "id": "3",
                "name": "Knee Raises",
                "description": "Standing Knee Raises (also known as standing knee crunches and standing knee pulls) is a functional abdominal exercise for boosting strength throughout the core. Unlike standard ab exercises, they don’t isolate abdominal muscles. Instead they work your upper abs and lower abs in conjunction with other important muscles such as hips, back and shoulders.",
                "category": "1",
                "type": "2",
                "rewards": "6.00",
                "repititions": "10",
                "duration": "1.00",
                "unit": "times",
                "equipment": ""
              }
            },
            {
              "id": "12",
              "progression_id": "1",
              "level": "2",
              "row": "3",
              "substitute": "0",
              "exercise_id": "23",
              "created_at": "2015-12-14 03:04:45",
              "updated_at": "2016-01-04 10:24:35",
              "isLocked": 1,
              "isLockable": 0,
              "isUnlockable": 1,
              "exercise": {
                "id": "23",
                "name": "Leg Raises",
                "description": "",
                "category": "1",
                "type": "2",
                "rewards": "6.00",
                "repititions": "10",
                "duration": "1.00",
                "unit": "times",
                "equipment": ""
              }
            },
            {
              "id": "13",
              "progression_id": "1",
              "level": "3",
              "row": "3",
              "substitute": "55",
              "exercise_id": "34",
              "created_at": "2015-12-14 03:04:45",
              "updated_at": "2015-12-15 05:48:46",
              "isLocked": 1,
              "isLockable": 0,
              "isUnlockable": 0,
              "exercise": {
                "id": "34",
                "name": "L-Sit",
                "description": "",
                "category": "2",
                "type": "2",
                "rewards": "6.00",
                "repititions": "10",
                "duration": "1.00",
                "unit": "times",
                "equipment": ""
              }
            },
            {
              "id": "14",
              "progression_id": "1",
              "level": "4",
              "row": "3",
              "substitute": "0",
              "exercise_id": "55",
              "created_at": "2015-12-14 03:04:45",
              "updated_at": "2016-01-04 10:24:44",
              "isLocked": 1,
              "isLockable": 0,
              "isUnlockable": 0,
              "exercise": {
                "id": "55",
                "name": "L-Sit Pullup",
                "description": "",
                "category": "2",
                "type": "2",
                "rewards": "6.00",
                "repititions": "10",
                "duration": "1.00",
                "unit": "times",
                "equipment": ""
              }
            },
            {
              "id": "15",
              "progression_id": "1",
              "level": "5",
              "row": "3",
              "substitute": "0",
              "exercise_id": "78",
              "created_at": "2015-12-14 03:04:45",
              "updated_at": "2015-12-15 05:48:46",
              "isLocked": 1,
              "isLockable": 0,
              "isUnlockable": 0,
              "exercise": {
                "id": "78",
                "name": "Pullover",
                "description": "",
                "category": "3",
                "type": "2",
                "rewards": "10.00",
                "repititions": "10",
                "duration": "1.00",
                "unit": "times",
                "equipment": ""
              }
            }
          ],
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
     * 
     * 
     * @apiError error Message token_invalid.
     * @apiError error Message token_expired.
     * @apiError error Message token_not_provided.
     * @apiError error Message Validation error
     * @apiError error Message Validation error
     * @apiError error Message user_not_exists
     *
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 400 Invalid Request
     *     {
     *       "status":0,
     *       "error": "token_invalid"
     *     }
     * 
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 401 Unauthorised
     *     {
     *       "status":0,
     *       "error": "token_expired"
     *     }
     * 
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 400 Bad Request
     *     {
     *       "status":0,
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
     *     HTTP/1.1 422 Validation error
     *     {
     *       "status" : 0,
     *       "error": "The skill_id field is required"
     *     }
     * 
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 500 user_not_exists
     *     {
     *       "status" : 0,
     *       "error": "user_not_exists"
     *     }
     * 
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 500 already locked the skill
     *     {
     *       "status" : 0,
     *       "error": "already locked the skill"
     *     }
     * 
     */
    public function lockSkill(Request $request)
    {
        if (!isset($request->user_id) || ($request->user_id == null)) {
            return response()->json(["status" => 0, "error" => "The user_id field is required"]);
        } elseif (!isset($request->skill_id) || ($request->skill_id == null)) {
            return response()->json(["status" => 0, "error" => "The skill_id field is required"]);
        } else {
            $user = User::where('id', '=', $request->input('user_id'))->first();
            if (!is_null($user)) {
                $isUnlocked = Unlockedexercise::where('skill_id', $request->skill_id)->where('user_id', $request->user_id)->count();
                if ($isUnlocked > 0) {

                    $unlockedSkill = Skill::where('id', $request->skill_id)->first();

                    $higherLevelSkills = DB::table('skills')->select('id')->whereRaw('level >= ' . $unlockedSkill->level)->toSql();

                    Unlockedexercise::whereRaw('skill_id IN (' . $higherLevelSkills . ') AND user_id = ' . $request->user_id)->delete();

                    $skills = Skill::where('row', $unlockedSkill->row)->where('progression_id', $unlockedSkill->progression_id)->with(['exercise'])->orderBy('level', 'ASC')->get();
                    foreach ($skills as $sKey => $sValue) {
                        $skills[$sKey]->isLocked = $this->isLocked($sValue, $request->user_id);
                        $skills[$sKey]->isLockable = $this->isLockable($sValue, $request->user_id);
                        $skills[$sKey]->isUnlockable = $this->isUnlockable($sValue, $request->user_id);
                    }

                    return response()->json([
                            'status' => 1,
                            'message' => 'successfully locked the skill',
                            'skills' => $skills,
                            'is_subscribed' => $user->is_subscribed,
                            'urls' => config('urls.urls')], 200);
                } else {
                    return response()->json(['status' => 0, 'error' => 'already locked the skill'], 500);
                }
            } else {
                return response()->json(['status' => 0, 'error' => 'user_not_exists'], 500);
            }
        }
    }
}
