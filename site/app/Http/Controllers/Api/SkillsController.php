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
      | SkillsController Controller
      |--------------------------------------------------------------------------
      |
      | This controller handles skills, user skills etc.
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
      "id": "87",
      "description": "",
      "progression_id": "1",
      "level": "5",
      "row": "1",
      "substitute": "0",
      "exercise_id": "89",
      "is_allies": "0",
      "created_at": "2016-08-02 06:15:30",
      "updated_at": "2016-08-02 06:15:30",
      "exercise": {
      "id": "89",
      "name": "Muscleups",
      "description": "Muscleups",
      "category": "3",
      "type": "1",
      "muscle_groups": "",
      "rewards": "10.00",
      "repititions": "10",
      "duration": "10",
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
      "is_selected": 0
      },
      {
      "id": "92",
      "description": "",
      "progression_id": "1",
      "level": "5",
      "row": "2",
      "substitute": "0",
      "exercise_id": "94",
      "is_allies": "0",
      "created_at": "2016-08-02 06:19:08",
      "updated_at": "2016-08-02 06:19:08",
      "exercise": {
      "id": "94",
      "name": "Front Lever (SH)",
      "description": "Front Lever (SH)",
      "category": "3",
      "type": "2",
      "muscle_groups": "",
      "rewards": "10.00",
      "repititions": "10",
      "duration": "10",
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
      "is_selected": 0
      },
      {
      "id": "97",
      "description": "",
      "progression_id": "1",
      "level": "5",
      "row": "3",
      "substitute": "0",
      "exercise_id": "99",
      "is_allies": "0",
      "created_at": "2016-08-02 06:21:34",
      "updated_at": "2016-08-02 06:21:34",
      "exercise": {
      "id": "99",
      "name": "Back Lever (SH)",
      "description": "Back Lever (SH)",
      "category": "3",
      "type": "2",
      "muscle_groups": "",
      "rewards": "10.00",
      "repititions": "10",
      "duration": "10",
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
      "is_selected": 0
      }
      ],
      "dip": [
      {
      "id": "102",
      "description": "",
      "progression_id": "2",
      "level": "5",
      "row": "1",
      "substitute": "0",
      "exercise_id": "104",
      "is_allies": "0",
      "created_at": "2016-08-02 06:24:47",
      "updated_at": "2016-08-02 06:24:47",
      "exercise": {
      "id": "104",
      "name": "Triceps Extensions",
      "description": "Triceps Extensions",
      "category": "3",
      "type": "1",
      "muscle_groups": "",
      "rewards": "10.00",
      "repititions": "10",
      "duration": "10",
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
      "is_selected": 0
      },
      {
      "id": "109",
      "description": "",
      "progression_id": "2",
      "level": "5",
      "row": "2",
      "substitute": "0",
      "exercise_id": "110",
      "is_allies": "0",
      "created_at": "2016-08-02 06:49:50",
      "updated_at": "2016-08-02 06:49:50",
      "exercise": {
      "id": "110",
      "name": "Hefesto",
      "description": "Hefesto",
      "category": "3",
      "type": "2",
      "muscle_groups": "",
      "rewards": "10.00",
      "repititions": "10",
      "duration": "10",
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
      "is_selected": 0
      },
      {
      "id": "114",
      "description": "",
      "progression_id": "2",
      "level": "5",
      "row": "3",
      "substitute": "0",
      "exercise_id": "115",
      "is_allies": "0",
      "created_at": "2016-08-02 06:52:30",
      "updated_at": "2016-08-02 10:13:35",
      "exercise": {
      "id": "115",
      "name": "Impossible Dips",
      "description": "Impossible Dips",
      "category": "3",
      "type": "2",
      "muscle_groups": "",
      "rewards": "10.00",
      "repititions": "10",
      "duration": "10",
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
      "is_selected": 0
      }
      ],
      "full_body": [
      {
      "id": "119",
      "description": "",
      "progression_id": "3",
      "level": "5",
      "row": "1",
      "substitute": "0",
      "exercise_id": "120",
      "is_allies": "0",
      "created_at": "2016-08-02 07:00:56",
      "updated_at": "2016-08-02 07:00:56",
      "exercise": {
      "id": "120",
      "name": "Pistols",
      "description": "Pistols",
      "category": "3",
      "type": "1",
      "muscle_groups": "",
      "rewards": "10.00",
      "repititions": "10",
      "duration": "10",
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
      "is_selected": 0
      },
      {
      "id": "124",
      "description": "",
      "progression_id": "3",
      "level": "5",
      "row": "2",
      "substitute": "0",
      "exercise_id": "125",
      "is_allies": "0",
      "created_at": "2016-08-02 07:03:25",
      "updated_at": "2016-08-02 07:03:25",
      "exercise": {
      "id": "125",
      "name": "Jumping Lunges",
      "description": "Jumping Lunges",
      "category": "3",
      "type": "1",
      "muscle_groups": "",
      "rewards": "10.00",
      "repititions": "10",
      "duration": "10",
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
      "is_selected": 0
      },
      {
      "id": "129",
      "description": "",
      "progression_id": "3",
      "level": "5",
      "row": "3",
      "substitute": "0",
      "exercise_id": "130",
      "is_allies": "0",
      "created_at": "2016-08-02 07:06:11",
      "updated_at": "2016-08-02 07:06:11",
      "exercise": {
      "id": "130",
      "name": "Clap Pushup Burpee",
      "description": "Clap Pushup Burpee",
      "category": "3",
      "type": "1",
      "muscle_groups": "",
      "rewards": "10.00",
      "repititions": "10",
      "duration": "10",
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
      "is_selected": 0
      }
      ],
      "push": [
      {
      "id": "135",
      "description": "",
      "progression_id": "4",
      "level": "5",
      "row": "1",
      "substitute": "0",
      "exercise_id": "135",
      "is_allies": "0",
      "created_at": "2016-08-02 07:10:42",
      "updated_at": "2016-08-02 07:10:42",
      "exercise": {
      "id": "135",
      "name": "One Arm Pushups",
      "description": "One Arm Pushups",
      "category": "3",
      "type": "1",
      "muscle_groups": "",
      "rewards": "10.00",
      "repititions": "10",
      "duration": "10",
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
      "is_selected": 0
      },
      {
      "id": "140",
      "description": "",
      "progression_id": "4",
      "level": "5",
      "row": "2",
      "substitute": "0",
      "exercise_id": "140",
      "is_allies": "0",
      "created_at": "2016-08-02 07:13:18",
      "updated_at": "2016-08-02 07:13:18",
      "exercise": {
      "id": "140",
      "name": "Handstand Pushups",
      "description": "Handstand Pushups",
      "category": "3",
      "type": "1",
      "muscle_groups": "",
      "rewards": "10.00",
      "repititions": "10",
      "duration": "10",
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
      "is_selected": 0
      },
      {
      "id": "145",
      "description": "",
      "progression_id": "4",
      "level": "5",
      "row": "3",
      "substitute": "0",
      "exercise_id": "145",
      "is_allies": "0",
      "created_at": "2016-08-02 07:17:01",
      "updated_at": "2016-08-02 11:34:12",
      "exercise": {
      "id": "145",
      "name": "Double Clap Pushups",
      "description": "Double Clap Pushups",
      "category": "3",
      "type": "1",
      "muscle_groups": "",
      "rewards": "10.00",
      "repititions": "10",
      "duration": "10",
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
      "is_selected": 0
      },
      {
      "id": "150",
      "description": "",
      "progression_id": "4",
      "level": "5",
      "row": "4",
      "substitute": "0",
      "exercise_id": "150",
      "is_allies": "0",
      "created_at": "2016-08-02 07:23:55",
      "updated_at": "2016-08-02 07:23:55",
      "exercise": {
      "id": "150",
      "name": "Planche (SH)",
      "description": "Planche (SH)",
      "category": "3",
      "type": "2",
      "muscle_groups": "",
      "rewards": "10.00",
      "repititions": "10",
      "duration": "10",
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
      "is_selected": 0
      }
      ],
      "core": [
      {
      "id": "155",
      "description": "",
      "progression_id": "5",
      "level": "5",
      "row": "1",
      "substitute": "0",
      "exercise_id": "155",
      "is_allies": "0",
      "created_at": "2016-08-02 07:27:53",
      "updated_at": "2016-08-02 07:27:53",
      "exercise": {
      "id": "155",
      "name": "Hollow Body Rock",
      "description": "Hollow Body Rock",
      "category": "3",
      "type": "1",
      "muscle_groups": "",
      "rewards": "10.00",
      "repititions": "10",
      "duration": "10",
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
      "is_selected": 0
      },
      {
      "id": "160",
      "description": "",
      "progression_id": "5",
      "level": "5",
      "row": "2",
      "substitute": "0",
      "exercise_id": "160",
      "is_allies": "0",
      "created_at": "2016-08-02 07:33:01",
      "updated_at": "2016-08-02 07:33:01",
      "exercise": {
      "id": "160",
      "name": "Side Plank (SH)",
      "description": "Side Plank (SH)",
      "category": "3",
      "type": "1",
      "muscle_groups": "",
      "rewards": "10.00",
      "repititions": "10",
      "duration": "10",
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
      "is_selected": 0
      },
      {
      "id": "165",
      "description": "",
      "progression_id": "5",
      "level": "5",
      "row": "3",
      "substitute": "0",
      "exercise_id": "165",
      "is_allies": "0",
      "created_at": "2016-08-02 07:37:43",
      "updated_at": "2016-08-02 07:37:43",
      "exercise": {
      "id": "165",
      "name": "Human Flag ",
      "description": "Human Flag ",
      "category": "3",
      "type": "2",
      "muscle_groups": "",
      "rewards": "10.00",
      "repititions": "10",
      "duration": "10",
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
      "is_selected": 0
      },
      {
      "id": "169",
      "description": "",
      "progression_id": "5",
      "level": "4",
      "row": "4",
      "substitute": "0",
      "exercise_id": "169",
      "is_allies": "0",
      "created_at": "2016-08-02 07:41:21",
      "updated_at": "2016-08-02 07:41:21",
      "exercise": {
      "id": "169",
      "name": "Dragon Flag",
      "description": "Dragon Flag",
      "category": "2",
      "type": "2",
      "muscle_groups": "",
      "rewards": "10.00",
      "repititions": "10",
      "duration": "10",
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
      "is_selected": 0
      },
      {
      "id": "174",
      "description": "",
      "progression_id": "5",
      "level": "5",
      "row": "5",
      "substitute": "0",
      "exercise_id": "174",
      "is_allies": "0",
      "created_at": "2016-08-02 07:45:06",
      "updated_at": "2016-08-02 07:45:06",
      "exercise": {
      "id": "174",
      "name": "Pullover",
      "description": "Pullover",
      "category": "3",
      "type": "1",
      "muscle_groups": "",
      "rewards": "10.00",
      "repititions": "10",
      "duration": "10",
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
      "is_selected": 0
      }
      ]
      },
      "is_subscribed": 1,
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

                //need to find how many rows in each progression and need to find the exercise to be unlocked 
                //by the user in that row.
                //Get pull progression row count.

                $pullRowCount = count(Skill::where('progression_id', 1)->groupBy('row')->get());


                $i = 1;

                do {
                    $skill = DB::table('skills')->where('row', $i)->where('progression_id', 1)->orderBy('skills.level', 'DESC')->first();

                    $skill->exercise = Exercise::where('id', $skill->exercise_id)->with(['video'])->first();

                    $skill->is_selected = 0;
                    $unlockCount = DB::table('user_goal_options')->where('user_id', $request->user_id)->where('goal_options', $skill->id)->count();
                    if ($unlockCount > 0) {
                        $skill->is_selected = 1;
                    }

                    $skills['pull'][] = $skill;

                    $i++;
                } while ($i <= $pullRowCount);

                $i = 1;

                $dipRowCount = count(Skill::where('progression_id', 2)->groupBy('row')->get());

                do {
                    $skill = DB::table('skills')->where('row', $i)->where('progression_id', 2)->orderBy('skills.level', 'DESC')->first();
                    $skill->exercise = Exercise::where('id', $skill->exercise_id)->with(['video'])->first();
                    $skill->is_selected = 0;
                    $unlockCount = DB::table('user_goal_options')->where('user_id', $request->user_id)->where('goal_options', $skill->id)->count();
                    if ($unlockCount > 0) {
                        $skill->is_selected = 1;
                    }

                    $skills['dip'][] = $skill;
                    $i++;
                    unset($skill);
                } while ($i <= $dipRowCount);

                $i = 1;

                $fullBodyRowCount = count(Skill::where('progression_id', 3)->groupBy('row')->get());

                do {

                    $skill = DB::table('skills')->where('row', $i)->where('progression_id', 3)->orderBy('skills.level', 'DESC')->first();
                    $skill->exercise = Exercise::where('id', $skill->exercise_id)->with(['video'])->first();
                    $skill->is_selected = 0;
                    $unlockCount = DB::table('user_goal_options')->where('user_id', $request->user_id)->where('goal_options', $skill->id)->count();
                    if ($unlockCount > 0) {
                        $skill->is_selected = 1;
                    }

                    $skills['full_body'][] = $skill;
                    $i++;
                    unset($skill);
                } while ($i <= $fullBodyRowCount);

                $i = 1;

                $pushRowCount = count(Skill::where('progression_id', 4)->groupBy('row')->get());

                do {
                    $skill = DB::table('skills')->where('row', $i)->where('progression_id', 4)->orderBy('skills.level', 'DESC')->first();
                    $skill->exercise = Exercise::where('id', $skill->exercise_id)->with(['video'])->first();
                    $skill->is_selected = 0;
                    $unlockCount = DB::table('user_goal_options')->where('user_id', $request->user_id)->where('goal_options', $skill->id)->count();
                    if ($unlockCount > 0) {
                        $skill->is_selected = 1;
                    }

                    $skills['push'][] = $skill;
                    $i++;
                    unset($skill);
                } while ($i <= $pushRowCount);

                $i = 1;

                $coreRowCount = count(Skill::where('progression_id', 5)->groupBy('row')->get());

                do {
                    $skill = DB::table('skills')->where('row', $i)->where('progression_id', 5)->orderBy('skills.level', 'DESC')->first();
                    $skill->exercise = Exercise::where('id', $skill->exercise_id)->with(['video'])->first();
                    $skill->is_selected = 0;
                    $unlockCount = DB::table('user_goal_options')->where('user_id', $request->user_id)->where('goal_options', $skill->id)->count();
                    if ($unlockCount > 0) {
                        $skill->is_selected = 1;
                    }

                    $skills['core'][] = $skill;
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
      "id": "83",
      "description": "",
      "progression_id": "1",
      "level": "1",
      "row": "1",
      "substitute": "0",
      "exercise_id": "84",
      "is_allies": "0",
      "created_at": "2016-08-02 06:08:13",
      "updated_at": "2016-08-04 15:35:12",
      "is_selected": 0,
      "isLocked": 0,
      "isLockable": 0,
      "isUnlockable": 0,
      "exercise": {
        "id": "84",
        "name": "Eccentric Pull-ups",
        "description": "Eccentric Pull-ups",
        "category": "1",
        "type": "1",
        "muscle_groups": "",
        "rewards": "5.00",
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
      "id": "176",
      "description": "",
      "progression_id": "1",
      "level": "2",
      "row": "1",
      "substitute": "0",
      "exercise_id": "85",
      "is_allies": "0",
      "created_at": "2016-08-02 07:53:44",
      "updated_at": "2016-08-04 15:34:42",
      "is_selected": 0,
      "isLocked": 0,
      "isLockable": 1,
      "isUnlockable": 0,
      "exercise": {
        "id": "85",
        "name": "Assisted Pull-ups",
        "description": "Assisted Pull-ups",
        "category": "1",
        "type": "1",
        "muscle_groups": "",
        "rewards": "6.00",
        "unit": "times",
        "equipment": "",
        "range_of_motion": "1) Start in deadhang position 2) Pullup, chin above bar level 3) Slow & controlled movement into starting position",
        "video_tips": "",
        "pro_tips": "",
        "video_tips_html": "",
        "pro_tips_html": "",
        "range_of_motion_html": "<p>1) Start in deadhang position<br /> 2) Pullup, chin above bar level<br /> 3) Slow &amp; controlled movement into starting position</p>",
        "is_static": "0",
        "musclegroup_string": "",
        "video": []
      }
    },
    {
      "id": "85",
      "description": "",
      "progression_id": "1",
      "level": "3",
      "row": "1",
      "substitute": "0",
      "exercise_id": "86",
      "is_allies": "0",
      "created_at": "2016-08-02 06:13:26",
      "updated_at": "2016-08-04 15:34:16",
      "is_selected": 0,
      "isLocked": 1,
      "isLockable": 0,
      "isUnlockable": 1,
      "exercise": {
        "id": "86",
        "name": "Pull-ups ",
        "description": "Pull-ups ",
        "category": "2",
        "type": "1",
        "muscle_groups": "",
        "rewards": "7.00",
        "unit": "times",
        "equipment": "",
        "range_of_motion": "1) Start in deadhang position 2) Pullup, chin above bar level 3) Slow & controlled movement into starting position",
        "video_tips": "",
        "pro_tips": "",
        "video_tips_html": "",
        "pro_tips_html": "",
        "range_of_motion_html": "<p>1) Start in deadhang position<br /> 2) Pullup, chin above bar level<br /> 3) Slow &amp; controlled movement into starting position</p>",
        "is_static": "0",
        "musclegroup_string": "",
        "video": [
          {
            "id": "81",
            "path": "86_1470654172.mp4",
            "videothumbnail": "86_1470654172.jpg",
            "description": "Pull-ups "
          }
        ]
      }
    },
    {
      "id": "86",
      "description": "",
      "progression_id": "1",
      "level": "4",
      "row": "1",
      "substitute": "0",
      "exercise_id": "88",
      "is_allies": "0",
      "created_at": "2016-08-02 06:14:38",
      "updated_at": "2016-08-09 05:12:23",
      "is_selected": 0,
      "isLocked": 1,
      "isLockable": 0,
      "isUnlockable": 0,
      "exercise": {
        "id": "88",
        "name": "High Chest Pull-ups",
        "description": "High Chest Pull-ups",
        "category": "2",
        "type": "1",
        "muscle_groups": "",
        "rewards": "7.00",
        "unit": "times",
        "equipment": "",
        "range_of_motion": "1) Start in deadhang position 2) Pullup explosively, chest above bar level 3) Controlled movement into starting position",
        "video_tips": "",
        "pro_tips": "",
        "video_tips_html": "",
        "pro_tips_html": "",
        "range_of_motion_html": "<p>1) Start in deadhang position<br /> 2) Pullup explosively, chest above bar level<br /> 3) Controlled movement into starting position</p>",
        "is_static": "0",
        "musclegroup_string": "",
        "video": []
      }
    },
    {
      "id": "87",
      "description": "",
      "progression_id": "1",
      "level": "5",
      "row": "1",
      "substitute": "0",
      "exercise_id": "89",
      "is_allies": "0",
      "created_at": "2016-08-02 06:15:30",
      "updated_at": "2016-08-04 14:47:41",
      "is_selected": 1,
      "isLocked": 1,
      "isLockable": 0,
      "isUnlockable": 0,
      "exercise": {
        "id": "89",
        "name": "Muscleups",
        "description": "Muscleups",
        "category": "3",
        "type": "1",
        "muscle_groups": "",
        "rewards": "10.00",
        "unit": "times",
        "equipment": "",
        "range_of_motion": "1) Start in deadhang position2) Pullup explosively into wrist transition3) Straight bar dip on top4) Slow & controlled movement into starting position",
        "video_tips": "",
        "pro_tips": "",
        "video_tips_html": "",
        "pro_tips_html": "",
        "range_of_motion_html": "<p>1) Start in deadhang position<br />2) Pullup explosively into wrist transition<br />3) Straight bar dip on top<br />4) Slow &amp; controlled movement into starting position</p>",
        "is_static": "0",
        "musclegroup_string": "",
        "video": [
          {
            "id": "79",
            "path": "89_1470649283.mp4",
            "videothumbnail": "89_1470649283.jpg",
            "description": ""
          }
        ]
      }
    }
  ],
  "allies": [
    {
      "id": "177",
      "description": "",
      "progression_id": "1",
      "level": "0",
      "row": "1",
      "substitute": "0",
      "exercise_id": "193",
      "is_allies": "1",
      "created_at": "2016-08-02 09:03:41",
      "updated_at": "2016-08-04 15:35:36",
      "is_selected": 0,
      "isLocked": 1,
      "isLockable": 0,
      "isUnlockable": 1,
      "exercise": {
        "id": "193",
        "name": "Jump 2 MU",
        "description": "Jump 2 MU",
        "category": "3",
        "type": "2",
        "muscle_groups": "",
        "rewards": "5.00",
        "unit": "times",
        "equipment": "",
        "range_of_motion": "1) Start with feet on the ground 2) Jump up into muscleup 3) Straight bar dip on top 4) Slow & controlled eccentric movement into starting position",
        "video_tips": "",
        "pro_tips": "",
        "video_tips_html": "",
        "pro_tips_html": "",
        "range_of_motion_html": "<p>1) Start with feet on the ground<br /> 2) Jump up into muscleup<br /> 3) Straight bar dip on top<br /> 4) Slow &amp; controlled eccentric movement into starting position</p>",
        "is_static": "0",
        "musclegroup_string": "",
        "video": [
          {
            "id": "80",
            "path": "193_1470649743.mp4",
            "videothumbnail": "193_1470649743.jpg",
            "description": ""
          }
        ]
      }
    },
    {
      "id": "178",
      "description": "",
      "progression_id": "1",
      "level": "0",
      "row": "1",
      "substitute": "0",
      "exercise_id": "194",
      "is_allies": "1",
      "created_at": "2016-08-02 09:08:06",
      "updated_at": "2016-08-04 15:36:07",
      "is_selected": 0,
      "isLocked": 1,
      "isLockable": 0,
      "isUnlockable": 1,
      "exercise": {
        "id": "194",
        "name": "Assisted MU",
        "description": "Assisted MU",
        "category": "3",
        "type": "2",
        "muscle_groups": "",
        "rewards": "5.00",
        "unit": "times",
        "equipment": "",
        "range_of_motion": "1) Start in deadhang position 2) Pullup explosively into wrist transition 3) Straight bar dip on top 4) Slow & controlled movement into starting position",
        "video_tips": "",
        "pro_tips": "",
        "video_tips_html": "",
        "pro_tips_html": "",
        "range_of_motion_html": "<p>1) Start in deadhang position<br /> 2) Pullup explosively into wrist transition<br /> 3) Straight bar dip on top<br /> 4) Slow &amp; controlled movement into starting position</p>",
        "is_static": "0",
        "musclegroup_string": "",
        "video": []
      }
    },
    {
      "id": "179",
      "description": "",
      "progression_id": "1",
      "level": "0",
      "row": "1",
      "substitute": "0",
      "exercise_id": "195",
      "is_allies": "1",
      "created_at": "2016-08-02 09:10:20",
      "updated_at": "2016-08-04 15:36:31",
      "is_selected": 0,
      "isLocked": 0,
      "isLockable": 1,
      "isUnlockable": 0,
      "exercise": {
        "id": "195",
        "name": "Gripchange Pull-ups",
        "description": "Gripchange Pull-ups",
        "category": "3",
        "type": "2",
        "muscle_groups": "",
        "rewards": "5.00",
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
      "id": "180",
      "description": "",
      "progression_id": "1",
      "level": "0",
      "row": "1",
      "substitute": "0",
      "exercise_id": "196",
      "is_allies": "1",
      "created_at": "2016-08-02 09:11:17",
      "updated_at": "2016-08-04 15:37:07",
      "is_selected": 0,
      "isLocked": 1,
      "isLockable": 0,
      "isUnlockable": 1,
      "exercise": {
        "id": "196",
        "name": "Pullover  to ecc. MU",
        "description": "Pullover  to ecc. MU",
        "category": "3",
        "type": "2",
        "muscle_groups": "",
        "rewards": "5.00",
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
      "id": "181",
      "description": "",
      "progression_id": "1",
      "level": "0",
      "row": "1",
      "substitute": "0",
      "exercise_id": "197",
      "is_allies": "1",
      "created_at": "2016-08-02 09:11:39",
      "updated_at": "2016-08-04 15:38:14",
      "is_selected": 0,
      "isLocked": 1,
      "isLockable": 0,
      "isUnlockable": 1,
      "exercise": {
        "id": "197",
        "name": "10s DH to High Chest Pull-up",
        "description": "10s DH to High Chest Pull-up",
        "category": "3",
        "type": "2",
        "muscle_groups": "",
        "rewards": "5.00",
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
      "id": "182",
      "description": "",
      "progression_id": "1",
      "level": "0",
      "row": "1",
      "substitute": "0",
      "exercise_id": "198",
      "is_allies": "1",
      "created_at": "2016-08-02 09:13:18",
      "updated_at": "2016-08-04 15:38:55",
      "is_selected": 0,
      "isLocked": 1,
      "isLockable": 0,
      "isUnlockable": 1,
      "exercise": {
        "id": "198",
        "name": "Pull-up / MU / Straight Bar Dip ",
        "description": "Pull-up / MU / Straight Bar Dip ",
        "category": "3",
        "type": "2",
        "muscle_groups": "",
        "rewards": "5.00",
        "unit": "times",
        "equipment": "",
        "range_of_motion": "This exercise is a combination of basic moves. Please read the pullups, muscleups & straight bar dip range of motion description beforehand.",
        "video_tips": "",
        "pro_tips": "",
        "video_tips_html": "",
        "pro_tips_html": "",
        "range_of_motion_html": "<p>This exercise is a combination of basic moves. Please read the pullups, muscleups &amp; straight bar dip range of motion description beforehand.</p>",
        "is_static": "0",
        "musclegroup_string": "",
        "video": []
      }
    },
    {
      "id": "183",
      "description": "",
      "progression_id": "1",
      "level": "0",
      "row": "1",
      "substitute": "0",
      "exercise_id": "199",
      "is_allies": "1",
      "created_at": "2016-08-02 09:14:04",
      "updated_at": "2016-08-04 15:39:28",
      "is_selected": 0,
      "isLocked": 0,
      "isLockable": 1,
      "isUnlockable": 0,
      "exercise": {
        "id": "199",
        "name": "10s DH to MU",
        "description": "10s DH to MU",
        "category": "3",
        "type": "2",
        "muscle_groups": "",
        "rewards": "5.00",
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
  "is_subscribed": 1,
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

                $skills = Skill::where('row', $skill->row)->where('is_allies', '=', 0)->where('progression_id', $skill->progression_id)->with(['exercise'])->orderBy('level', 'ASC')->get();
                
                foreach ($skills as $sKey => $sValue) {
                    $isRaidActive = DB::table('user_goal_options')->where('user_id', $request->user_id)->where('goal_options', $sValue->id)->count();
                    if ($isRaidActive > 0) {
                        $skills[$sKey]->is_selected = 1;
                    } else {
                        $skills[$sKey]->is_selected = 0;
                    }
                    $skills[$sKey]->isLocked = $this->isLocked($sValue, $request->user_id);
                    $skills[$sKey]->isLockable = $this->isLockable($sValue, $request->user_id);
                    $skills[$sKey]->isUnlockable = $this->isUnlockable($sValue, $request->user_id);
                }

                $allies = Skill::where('row', $skill->row)->where('is_allies', '=', 1)->where('progression_id', $skill->progression_id)->with(['exercise'])->orderBy('level', 'ASC')->get();

                foreach ($allies as $aKey => $aValue) {
                    $allies[$aKey]->is_selected = 0;
                    $allies[$aKey]->isLocked = $this->isLocked($aValue, $request->user_id);
                    $allies[$aKey]->isLockable = $this->isLockable($aValue, $request->user_id);
                    $allies[$aKey]->isUnlockable = $this->isUnlockable($aValue, $request->user_id);
                }
            } else {
                return response()->json(['status' => 0, 'error' => 'user_not_exists'], 500);
            }

            return response()->json([
                    'status' => 1,
                    'skills' => $skills,
                    'allies' => $allies,
                    'is_subscribed' => $user->is_subscribed,
                    'urls' => config('urls.urls')], 200);
        }
    }

    /**
     * Check for skill is locked.
     * @param type $skill
     * @param type $userId
     * @return int
     * @author Aneesh K<aneeshk@cubettech.com>
     */
    public function isLocked($skill, $userId)
    {
        $unLockCount = DB::table('unlocked_skills')
            ->select('exercise_id')
            ->whereRaw('user_id = ' . $userId . ' AND skill_id = ' . $skill->id)
            ->count();

        if ($unLockCount > 0 || ($skill->level < 2 && $skill->level != 0)) {
            return 0;
        }

        return 1;
    }

    /**
     * Check for skill is lockable.
     * @param type $skill
     * @param type $userId
     * @return int
     * @author Aneesh K<aneeshk@cubettech.com>
     */
    public function isLockable($skill, $userId)
    {
        if ($skill->level < 2 && $skill->level != 0) {
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

    /**
     * Check for skill is unlockable.
     * @param type $skill
     * @param type $userId
     * @return int.
     * @author Aneesh K<aneeshk@cubettech.com>
     */
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
                
                if ($skill->level != 2) {
                    $prevSkill = Skill::where('row', $skill->row)
                        ->where('progression_id', $skill->progression_id)
                        ->where('level', '=', $skill->level - 1)
                        ->first();
                    
                    if (!is_null($prevSkill)) {
                        $unLockCount = DB::table('unlocked_skills')
                            ->select('exercise_id')
                            ->whereRaw('user_id = ' . $userId . ' AND skill_id = ' . $prevSkill->id)
                            ->count();

                        if ($unLockCount > 0) {
                            return 1;
                        }
                    }
                } else {
                    return 1;
                }
            }
        } elseif ($skill->level == 0) {
            $unLockCount = DB::table('unlocked_skills')
                ->select('exercise_id')
                ->whereRaw('user_id = ' . $userId . ' AND skill_id = ' . $skill->id)
                ->count();
            if ($unLockCount > 0) {
                return 0;
            } else {
                return 1;
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
      "id": "83",
      "description": "",
      "progression_id": "1",
      "level": "1",
      "row": "1",
      "substitute": "0",
      "exercise_id": "84",
      "is_allies": "0",
      "created_at": "2016-08-02 06:08:13",
      "updated_at": "2016-08-04 15:35:12",
      "is_selected": 0,
      "isLocked": 0,
      "isLockable": 0,
      "isUnlockable": 0,
      "exercise": {
        "id": "84",
        "name": "Eccentric Pull-ups",
        "description": "Eccentric Pull-ups",
        "category": "1",
        "type": "1",
        "muscle_groups": "",
        "rewards": "5.00",
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
      "id": "176",
      "description": "",
      "progression_id": "1",
      "level": "2",
      "row": "1",
      "substitute": "0",
      "exercise_id": "85",
      "is_allies": "0",
      "created_at": "2016-08-02 07:53:44",
      "updated_at": "2016-08-04 15:34:42",
      "is_selected": 0,
      "isLocked": 0,
      "isLockable": 1,
      "isUnlockable": 0,
      "exercise": {
        "id": "85",
        "name": "Assisted Pull-ups",
        "description": "Assisted Pull-ups",
        "category": "1",
        "type": "1",
        "muscle_groups": "",
        "rewards": "6.00",
        "unit": "times",
        "equipment": "",
        "range_of_motion": "1) Start in deadhang position 2) Pullup, chin above bar level 3) Slow & controlled movement into starting position",
        "video_tips": "",
        "pro_tips": "",
        "video_tips_html": "",
        "pro_tips_html": "",
        "range_of_motion_html": "<p>1) Start in deadhang position<br /> 2) Pullup, chin above bar level<br /> 3) Slow &amp; controlled movement into starting position</p>",
        "is_static": "0",
        "musclegroup_string": "",
        "video": []
      }
    },
    {
      "id": "85",
      "description": "",
      "progression_id": "1",
      "level": "3",
      "row": "1",
      "substitute": "0",
      "exercise_id": "86",
      "is_allies": "0",
      "created_at": "2016-08-02 06:13:26",
      "updated_at": "2016-08-04 15:34:16",
      "is_selected": 0,
      "isLocked": 1,
      "isLockable": 0,
      "isUnlockable": 1,
      "exercise": {
        "id": "86",
        "name": "Pull-ups ",
        "description": "Pull-ups ",
        "category": "2",
        "type": "1",
        "muscle_groups": "",
        "rewards": "7.00",
        "unit": "times",
        "equipment": "",
        "range_of_motion": "1) Start in deadhang position 2) Pullup, chin above bar level 3) Slow & controlled movement into starting position",
        "video_tips": "",
        "pro_tips": "",
        "video_tips_html": "",
        "pro_tips_html": "",
        "range_of_motion_html": "<p>1) Start in deadhang position<br /> 2) Pullup, chin above bar level<br /> 3) Slow &amp; controlled movement into starting position</p>",
        "is_static": "0",
        "musclegroup_string": "",
        "video": [
          {
            "id": "81",
            "path": "86_1470654172.mp4",
            "videothumbnail": "86_1470654172.jpg",
            "description": "Pull-ups "
          }
        ]
      }
    },
    {
      "id": "86",
      "description": "",
      "progression_id": "1",
      "level": "4",
      "row": "1",
      "substitute": "0",
      "exercise_id": "88",
      "is_allies": "0",
      "created_at": "2016-08-02 06:14:38",
      "updated_at": "2016-08-09 05:12:23",
      "is_selected": 0,
      "isLocked": 1,
      "isLockable": 0,
      "isUnlockable": 0,
      "exercise": {
        "id": "88",
        "name": "High Chest Pull-ups",
        "description": "High Chest Pull-ups",
        "category": "2",
        "type": "1",
        "muscle_groups": "",
        "rewards": "7.00",
        "unit": "times",
        "equipment": "",
        "range_of_motion": "1) Start in deadhang position 2) Pullup explosively, chest above bar level 3) Controlled movement into starting position",
        "video_tips": "",
        "pro_tips": "",
        "video_tips_html": "",
        "pro_tips_html": "",
        "range_of_motion_html": "<p>1) Start in deadhang position<br /> 2) Pullup explosively, chest above bar level<br /> 3) Controlled movement into starting position</p>",
        "is_static": "0",
        "musclegroup_string": "",
        "video": []
      }
    },
    {
      "id": "87",
      "description": "",
      "progression_id": "1",
      "level": "5",
      "row": "1",
      "substitute": "0",
      "exercise_id": "89",
      "is_allies": "0",
      "created_at": "2016-08-02 06:15:30",
      "updated_at": "2016-08-04 14:47:41",
      "is_selected": 1,
      "isLocked": 1,
      "isLockable": 0,
      "isUnlockable": 0,
      "exercise": {
        "id": "89",
        "name": "Muscleups",
        "description": "Muscleups",
        "category": "3",
        "type": "1",
        "muscle_groups": "",
        "rewards": "10.00",
        "unit": "times",
        "equipment": "",
        "range_of_motion": "1) Start in deadhang position2) Pullup explosively into wrist transition3) Straight bar dip on top4) Slow & controlled movement into starting position",
        "video_tips": "",
        "pro_tips": "",
        "video_tips_html": "",
        "pro_tips_html": "",
        "range_of_motion_html": "<p>1) Start in deadhang position<br />2) Pullup explosively into wrist transition<br />3) Straight bar dip on top<br />4) Slow &amp; controlled movement into starting position</p>",
        "is_static": "0",
        "musclegroup_string": "",
        "video": [
          {
            "id": "79",
            "path": "89_1470649283.mp4",
            "videothumbnail": "89_1470649283.jpg",
            "description": ""
          }
        ]
      }
    }
  ],
  "allies": [
    {
      "id": "177",
      "description": "",
      "progression_id": "1",
      "level": "0",
      "row": "1",
      "substitute": "0",
      "exercise_id": "193",
      "is_allies": "1",
      "created_at": "2016-08-02 09:03:41",
      "updated_at": "2016-08-04 15:35:36",
      "is_selected": 0,
      "isLocked": 1,
      "isLockable": 0,
      "isUnlockable": 1,
      "exercise": {
        "id": "193",
        "name": "Jump 2 MU",
        "description": "Jump 2 MU",
        "category": "3",
        "type": "2",
        "muscle_groups": "",
        "rewards": "5.00",
        "unit": "times",
        "equipment": "",
        "range_of_motion": "1) Start with feet on the ground 2) Jump up into muscleup 3) Straight bar dip on top 4) Slow & controlled eccentric movement into starting position",
        "video_tips": "",
        "pro_tips": "",
        "video_tips_html": "",
        "pro_tips_html": "",
        "range_of_motion_html": "<p>1) Start with feet on the ground<br /> 2) Jump up into muscleup<br /> 3) Straight bar dip on top<br /> 4) Slow &amp; controlled eccentric movement into starting position</p>",
        "is_static": "0",
        "musclegroup_string": "",
        "video": [
          {
            "id": "80",
            "path": "193_1470649743.mp4",
            "videothumbnail": "193_1470649743.jpg",
            "description": ""
          }
        ]
      }
    },
    {
      "id": "178",
      "description": "",
      "progression_id": "1",
      "level": "0",
      "row": "1",
      "substitute": "0",
      "exercise_id": "194",
      "is_allies": "1",
      "created_at": "2016-08-02 09:08:06",
      "updated_at": "2016-08-04 15:36:07",
      "is_selected": 0,
      "isLocked": 1,
      "isLockable": 0,
      "isUnlockable": 1,
      "exercise": {
        "id": "194",
        "name": "Assisted MU",
        "description": "Assisted MU",
        "category": "3",
        "type": "2",
        "muscle_groups": "",
        "rewards": "5.00",
        "unit": "times",
        "equipment": "",
        "range_of_motion": "1) Start in deadhang position 2) Pullup explosively into wrist transition 3) Straight bar dip on top 4) Slow & controlled movement into starting position",
        "video_tips": "",
        "pro_tips": "",
        "video_tips_html": "",
        "pro_tips_html": "",
        "range_of_motion_html": "<p>1) Start in deadhang position<br /> 2) Pullup explosively into wrist transition<br /> 3) Straight bar dip on top<br /> 4) Slow &amp; controlled movement into starting position</p>",
        "is_static": "0",
        "musclegroup_string": "",
        "video": []
      }
    },
    {
      "id": "179",
      "description": "",
      "progression_id": "1",
      "level": "0",
      "row": "1",
      "substitute": "0",
      "exercise_id": "195",
      "is_allies": "1",
      "created_at": "2016-08-02 09:10:20",
      "updated_at": "2016-08-04 15:36:31",
      "is_selected": 0,
      "isLocked": 0,
      "isLockable": 1,
      "isUnlockable": 0,
      "exercise": {
        "id": "195",
        "name": "Gripchange Pull-ups",
        "description": "Gripchange Pull-ups",
        "category": "3",
        "type": "2",
        "muscle_groups": "",
        "rewards": "5.00",
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
      "id": "180",
      "description": "",
      "progression_id": "1",
      "level": "0",
      "row": "1",
      "substitute": "0",
      "exercise_id": "196",
      "is_allies": "1",
      "created_at": "2016-08-02 09:11:17",
      "updated_at": "2016-08-04 15:37:07",
      "is_selected": 0,
      "isLocked": 1,
      "isLockable": 0,
      "isUnlockable": 1,
      "exercise": {
        "id": "196",
        "name": "Pullover  to ecc. MU",
        "description": "Pullover  to ecc. MU",
        "category": "3",
        "type": "2",
        "muscle_groups": "",
        "rewards": "5.00",
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
      "id": "181",
      "description": "",
      "progression_id": "1",
      "level": "0",
      "row": "1",
      "substitute": "0",
      "exercise_id": "197",
      "is_allies": "1",
      "created_at": "2016-08-02 09:11:39",
      "updated_at": "2016-08-04 15:38:14",
      "is_selected": 0,
      "isLocked": 1,
      "isLockable": 0,
      "isUnlockable": 1,
      "exercise": {
        "id": "197",
        "name": "10s DH to High Chest Pull-up",
        "description": "10s DH to High Chest Pull-up",
        "category": "3",
        "type": "2",
        "muscle_groups": "",
        "rewards": "5.00",
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
      "id": "182",
      "description": "",
      "progression_id": "1",
      "level": "0",
      "row": "1",
      "substitute": "0",
      "exercise_id": "198",
      "is_allies": "1",
      "created_at": "2016-08-02 09:13:18",
      "updated_at": "2016-08-04 15:38:55",
      "is_selected": 0,
      "isLocked": 1,
      "isLockable": 0,
      "isUnlockable": 1,
      "exercise": {
        "id": "198",
        "name": "Pull-up / MU / Straight Bar Dip ",
        "description": "Pull-up / MU / Straight Bar Dip ",
        "category": "3",
        "type": "2",
        "muscle_groups": "",
        "rewards": "5.00",
        "unit": "times",
        "equipment": "",
        "range_of_motion": "This exercise is a combination of basic moves. Please read the pullups, muscleups & straight bar dip range of motion description beforehand.",
        "video_tips": "",
        "pro_tips": "",
        "video_tips_html": "",
        "pro_tips_html": "",
        "range_of_motion_html": "<p>This exercise is a combination of basic moves. Please read the pullups, muscleups &amp; straight bar dip range of motion description beforehand.</p>",
        "is_static": "0",
        "musclegroup_string": "",
        "video": []
      }
    },
    {
      "id": "183",
      "description": "",
      "progression_id": "1",
      "level": "0",
      "row": "1",
      "substitute": "0",
      "exercise_id": "199",
      "is_allies": "1",
      "created_at": "2016-08-02 09:14:04",
      "updated_at": "2016-08-04 15:39:28",
      "is_selected": 0,
      "isLocked": 0,
      "isLockable": 1,
      "isUnlockable": 0,
      "exercise": {
        "id": "199",
        "name": "10s DH to MU",
        "description": "10s DH to MU",
        "category": "3",
        "type": "2",
        "muscle_groups": "",
        "rewards": "5.00",
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
  "is_subscribed": 1,
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

                    $skills = Skill::where('row', $unlockedSkill->row)->where('is_allies', '=', 0)->where('progression_id', $unlockedSkill->progression_id)->with(['exercise'])->orderBy('level', 'ASC')->get();

                    foreach ($skills as $sKey => $sValue) {
                        $isRaidActive = DB::table('user_goal_options')->where('user_id', $request->user_id)->where('goal_options', $sValue->id)->count();
                        if ($isRaidActive > 0) {
                            $skills[$sKey]->is_selected = 1;
                        } else {
                            $skills[$sKey]->is_selected = 0;
                        }
                        $skills[$sKey]->isLocked = $this->isLocked($sValue, $request->user_id);
                        $skills[$sKey]->isLockable = $this->isLockable($sValue, $request->user_id);
                        $skills[$sKey]->isUnlockable = $this->isUnlockable($sValue, $request->user_id);
                    }

                    $allies = Skill::where('row', $unlockedSkill->row)->where('is_allies', '=', 1)->where('progression_id', $unlockedSkill->progression_id)->with(['exercise'])->orderBy('level', 'ASC')->get();

                    foreach ($allies as $aKey => $aValue) {

                        $allies[$aKey]->is_selected = 0;
                        $allies[$aKey]->isLocked = $this->isLocked($aValue, $request->user_id);
                        $allies[$aKey]->isLockable = $this->isLockable($aValue, $request->user_id);
                        $allies[$aKey]->isUnlockable = $this->isUnlockable($aValue, $request->user_id);
                    }

                    return response()->json([
                            'status' => 1,
                            'message' => 'successfully unlocked the skill',
                            'skills' => $skills,
                            'allies' => $allies,
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
      "id": "83",
      "description": "",
      "progression_id": "1",
      "level": "1",
      "row": "1",
      "substitute": "0",
      "exercise_id": "84",
      "is_allies": "0",
      "created_at": "2016-08-02 06:08:13",
      "updated_at": "2016-08-04 15:35:12",
      "is_selected": 0,
      "isLocked": 0,
      "isLockable": 0,
      "isUnlockable": 0,
      "exercise": {
        "id": "84",
        "name": "Eccentric Pull-ups",
        "description": "Eccentric Pull-ups",
        "category": "1",
        "type": "1",
        "muscle_groups": "",
        "rewards": "5.00",
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
      "id": "176",
      "description": "",
      "progression_id": "1",
      "level": "2",
      "row": "1",
      "substitute": "0",
      "exercise_id": "85",
      "is_allies": "0",
      "created_at": "2016-08-02 07:53:44",
      "updated_at": "2016-08-04 15:34:42",
      "is_selected": 0,
      "isLocked": 1,
      "isLockable": 0,
      "isUnlockable": 1,
      "exercise": {
        "id": "85",
        "name": "Assisted Pull-ups",
        "description": "Assisted Pull-ups",
        "category": "1",
        "type": "1",
        "muscle_groups": "",
        "rewards": "6.00",
        "unit": "times",
        "equipment": "",
        "range_of_motion": "1) Start in deadhang position 2) Pullup, chin above bar level 3) Slow & controlled movement into starting position",
        "video_tips": "",
        "pro_tips": "",
        "video_tips_html": "",
        "pro_tips_html": "",
        "range_of_motion_html": "<p>1) Start in deadhang position<br /> 2) Pullup, chin above bar level<br /> 3) Slow &amp; controlled movement into starting position</p>",
        "is_static": "0",
        "musclegroup_string": "",
        "video": []
      }
    },
    {
      "id": "85",
      "description": "",
      "progression_id": "1",
      "level": "3",
      "row": "1",
      "substitute": "0",
      "exercise_id": "86",
      "is_allies": "0",
      "created_at": "2016-08-02 06:13:26",
      "updated_at": "2016-08-04 15:34:16",
      "is_selected": 0,
      "isLocked": 1,
      "isLockable": 0,
      "isUnlockable": 0,
      "exercise": {
        "id": "86",
        "name": "Pull-ups ",
        "description": "Pull-ups ",
        "category": "2",
        "type": "1",
        "muscle_groups": "",
        "rewards": "7.00",
        "unit": "times",
        "equipment": "",
        "range_of_motion": "1) Start in deadhang position 2) Pullup, chin above bar level 3) Slow & controlled movement into starting position",
        "video_tips": "",
        "pro_tips": "",
        "video_tips_html": "",
        "pro_tips_html": "",
        "range_of_motion_html": "<p>1) Start in deadhang position<br /> 2) Pullup, chin above bar level<br /> 3) Slow &amp; controlled movement into starting position</p>",
        "is_static": "0",
        "musclegroup_string": "",
        "video": [
          {
            "id": "81",
            "path": "86_1470654172.mp4",
            "videothumbnail": "86_1470654172.jpg",
            "description": "Pull-ups "
          }
        ]
      }
    },
    {
      "id": "86",
      "description": "",
      "progression_id": "1",
      "level": "4",
      "row": "1",
      "substitute": "0",
      "exercise_id": "88",
      "is_allies": "0",
      "created_at": "2016-08-02 06:14:38",
      "updated_at": "2016-08-09 05:12:23",
      "is_selected": 0,
      "isLocked": 1,
      "isLockable": 0,
      "isUnlockable": 0,
      "exercise": {
        "id": "88",
        "name": "High Chest Pull-ups",
        "description": "High Chest Pull-ups",
        "category": "2",
        "type": "1",
        "muscle_groups": "",
        "rewards": "7.00",
        "unit": "times",
        "equipment": "",
        "range_of_motion": "1) Start in deadhang position 2) Pullup explosively, chest above bar level 3) Controlled movement into starting position",
        "video_tips": "",
        "pro_tips": "",
        "video_tips_html": "",
        "pro_tips_html": "",
        "range_of_motion_html": "<p>1) Start in deadhang position<br /> 2) Pullup explosively, chest above bar level<br /> 3) Controlled movement into starting position</p>",
        "is_static": "0",
        "musclegroup_string": "",
        "video": []
      }
    },
    {
      "id": "87",
      "description": "",
      "progression_id": "1",
      "level": "5",
      "row": "1",
      "substitute": "0",
      "exercise_id": "89",
      "is_allies": "0",
      "created_at": "2016-08-02 06:15:30",
      "updated_at": "2016-08-04 14:47:41",
      "is_selected": 1,
      "isLocked": 1,
      "isLockable": 0,
      "isUnlockable": 0,
      "exercise": {
        "id": "89",
        "name": "Muscleups",
        "description": "Muscleups",
        "category": "3",
        "type": "1",
        "muscle_groups": "",
        "rewards": "10.00",
        "unit": "times",
        "equipment": "",
        "range_of_motion": "1) Start in deadhang position2) Pullup explosively into wrist transition3) Straight bar dip on top4) Slow & controlled movement into starting position",
        "video_tips": "",
        "pro_tips": "",
        "video_tips_html": "",
        "pro_tips_html": "",
        "range_of_motion_html": "<p>1) Start in deadhang position<br />2) Pullup explosively into wrist transition<br />3) Straight bar dip on top<br />4) Slow &amp; controlled movement into starting position</p>",
        "is_static": "0",
        "musclegroup_string": "",
        "video": [
          {
            "id": "79",
            "path": "89_1470649283.mp4",
            "videothumbnail": "89_1470649283.jpg",
            "description": ""
          }
        ]
      }
    }
  ],
  "allies": [
    {
      "id": "177",
      "description": "",
      "progression_id": "1",
      "level": "0",
      "row": "1",
      "substitute": "0",
      "exercise_id": "193",
      "is_allies": "1",
      "created_at": "2016-08-02 09:03:41",
      "updated_at": "2016-08-04 15:35:36",
      "is_selected": 0,
      "isLocked": 1,
      "isLockable": 0,
      "isUnlockable": 1,
      "exercise": {
        "id": "193",
        "name": "Jump 2 MU",
        "description": "Jump 2 MU",
        "category": "3",
        "type": "2",
        "muscle_groups": "",
        "rewards": "5.00",
        "unit": "times",
        "equipment": "",
        "range_of_motion": "1) Start with feet on the ground 2) Jump up into muscleup 3) Straight bar dip on top 4) Slow & controlled eccentric movement into starting position",
        "video_tips": "",
        "pro_tips": "",
        "video_tips_html": "",
        "pro_tips_html": "",
        "range_of_motion_html": "<p>1) Start with feet on the ground<br /> 2) Jump up into muscleup<br /> 3) Straight bar dip on top<br /> 4) Slow &amp; controlled eccentric movement into starting position</p>",
        "is_static": "0",
        "musclegroup_string": "",
        "video": [
          {
            "id": "80",
            "path": "193_1470649743.mp4",
            "videothumbnail": "193_1470649743.jpg",
            "description": ""
          }
        ]
      }
    },
    {
      "id": "178",
      "description": "",
      "progression_id": "1",
      "level": "0",
      "row": "1",
      "substitute": "0",
      "exercise_id": "194",
      "is_allies": "1",
      "created_at": "2016-08-02 09:08:06",
      "updated_at": "2016-08-04 15:36:07",
      "is_selected": 0,
      "isLocked": 1,
      "isLockable": 0,
      "isUnlockable": 1,
      "exercise": {
        "id": "194",
        "name": "Assisted MU",
        "description": "Assisted MU",
        "category": "3",
        "type": "2",
        "muscle_groups": "",
        "rewards": "5.00",
        "unit": "times",
        "equipment": "",
        "range_of_motion": "1) Start in deadhang position 2) Pullup explosively into wrist transition 3) Straight bar dip on top 4) Slow & controlled movement into starting position",
        "video_tips": "",
        "pro_tips": "",
        "video_tips_html": "",
        "pro_tips_html": "",
        "range_of_motion_html": "<p>1) Start in deadhang position<br /> 2) Pullup explosively into wrist transition<br /> 3) Straight bar dip on top<br /> 4) Slow &amp; controlled movement into starting position</p>",
        "is_static": "0",
        "musclegroup_string": "",
        "video": []
      }
    },
    {
      "id": "179",
      "description": "",
      "progression_id": "1",
      "level": "0",
      "row": "1",
      "substitute": "0",
      "exercise_id": "195",
      "is_allies": "1",
      "created_at": "2016-08-02 09:10:20",
      "updated_at": "2016-08-04 15:36:31",
      "is_selected": 0,
      "isLocked": 0,
      "isLockable": 1,
      "isUnlockable": 0,
      "exercise": {
        "id": "195",
        "name": "Gripchange Pull-ups",
        "description": "Gripchange Pull-ups",
        "category": "3",
        "type": "2",
        "muscle_groups": "",
        "rewards": "5.00",
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
      "id": "180",
      "description": "",
      "progression_id": "1",
      "level": "0",
      "row": "1",
      "substitute": "0",
      "exercise_id": "196",
      "is_allies": "1",
      "created_at": "2016-08-02 09:11:17",
      "updated_at": "2016-08-04 15:37:07",
      "is_selected": 0,
      "isLocked": 1,
      "isLockable": 0,
      "isUnlockable": 1,
      "exercise": {
        "id": "196",
        "name": "Pullover  to ecc. MU",
        "description": "Pullover  to ecc. MU",
        "category": "3",
        "type": "2",
        "muscle_groups": "",
        "rewards": "5.00",
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
      "id": "181",
      "description": "",
      "progression_id": "1",
      "level": "0",
      "row": "1",
      "substitute": "0",
      "exercise_id": "197",
      "is_allies": "1",
      "created_at": "2016-08-02 09:11:39",
      "updated_at": "2016-08-04 15:38:14",
      "is_selected": 0,
      "isLocked": 1,
      "isLockable": 0,
      "isUnlockable": 1,
      "exercise": {
        "id": "197",
        "name": "10s DH to High Chest Pull-up",
        "description": "10s DH to High Chest Pull-up",
        "category": "3",
        "type": "2",
        "muscle_groups": "",
        "rewards": "5.00",
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
      "id": "182",
      "description": "",
      "progression_id": "1",
      "level": "0",
      "row": "1",
      "substitute": "0",
      "exercise_id": "198",
      "is_allies": "1",
      "created_at": "2016-08-02 09:13:18",
      "updated_at": "2016-08-04 15:38:55",
      "is_selected": 0,
      "isLocked": 1,
      "isLockable": 0,
      "isUnlockable": 1,
      "exercise": {
        "id": "198",
        "name": "Pull-up / MU / Straight Bar Dip ",
        "description": "Pull-up / MU / Straight Bar Dip ",
        "category": "3",
        "type": "2",
        "muscle_groups": "",
        "rewards": "5.00",
        "unit": "times",
        "equipment": "",
        "range_of_motion": "This exercise is a combination of basic moves. Please read the pullups, muscleups & straight bar dip range of motion description beforehand.",
        "video_tips": "",
        "pro_tips": "",
        "video_tips_html": "",
        "pro_tips_html": "",
        "range_of_motion_html": "<p>This exercise is a combination of basic moves. Please read the pullups, muscleups &amp; straight bar dip range of motion description beforehand.</p>",
        "is_static": "0",
        "musclegroup_string": "",
        "video": []
      }
    },
    {
      "id": "183",
      "description": "",
      "progression_id": "1",
      "level": "0",
      "row": "1",
      "substitute": "0",
      "exercise_id": "199",
      "is_allies": "1",
      "created_at": "2016-08-02 09:14:04",
      "updated_at": "2016-08-04 15:39:28",
      "is_selected": 0,
      "isLocked": 0,
      "isLockable": 1,
      "isUnlockable": 0,
      "exercise": {
        "id": "199",
        "name": "10s DH to MU",
        "description": "10s DH to MU",
        "category": "3",
        "type": "2",
        "muscle_groups": "",
        "rewards": "5.00",
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
  "is_subscribed": 1,
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

                    $higherLevelSkills = DB::table('skills')->select('id')->whereRaw('level >= ' . $unlockedSkill->level . ' AND level > 1 AND progression_id = ' . $unlockedSkill->progression_id . ' AND row = ' . $unlockedSkill->row)->toSql();

                    Unlockedexercise::whereRaw('skill_id IN (' . $higherLevelSkills . ') AND user_id = ' . $request->user_id)->delete();

                    $skills = Skill::where('row', $unlockedSkill->row)->where('is_allies', '=', 0)->where('progression_id', $unlockedSkill->progression_id)->with(['exercise'])->orderBy('level', 'ASC')->get();

                    foreach ($skills as $sKey => $sValue) {
                        $isRaidActive = DB::table('user_goal_options')->where('user_id', $request->user_id)->where('goal_options', $sValue->id)->count();
                        if ($isRaidActive > 0) {
                            $skills[$sKey]->is_selected = 1;
                        } else {
                            $skills[$sKey]->is_selected = 0;
                        }
                        $skills[$sKey]->isLocked = $this->isLocked($sValue, $request->user_id);
                        $skills[$sKey]->isLockable = $this->isLockable($sValue, $request->user_id);
                        $skills[$sKey]->isUnlockable = $this->isUnlockable($sValue, $request->user_id);
                    }

                    $allies = Skill::where('row', $unlockedSkill->row)->where('is_allies', '=', 1)->where('progression_id', $unlockedSkill->progression_id)->with(['exercise'])->orderBy('level', 'ASC')->get();

                    foreach ($allies as $aKey => $aValue) {

                        $allies[$aKey]->is_selected = 0;
                        $allies[$aKey]->isLocked = $this->isLocked($aValue, $request->user_id);
                        $allies[$aKey]->isLockable = $this->isLockable($aValue, $request->user_id);
                        $allies[$aKey]->isUnlockable = $this->isUnlockable($aValue, $request->user_id);
                    }

                    return response()->json([
                            'status' => 1,
                            'message' => 'successfully locked the skill',
                            'skills' => $skills,
                            'allies' => $allies,
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
