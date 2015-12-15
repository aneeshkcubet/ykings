<?php namespace App\Http\Controllers\Api;

use Auth;
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
     * @apiParam {Number} user_id Id of user 
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
    public function loadSkills(Request $request)
    {
        if (!isset($request->user_id) || ($request->user_id == null)) {
            return response()->json(["status" => "0", "error" => "The user_id field is required"]);
        } else {
            $user = User::where('id', '=', $request->input('user_id'))->first();
            if (!is_null($user)) {
                $skills = [];

                //need to find how many rows in each progression and need to find the exercise to be unlocked by the user in that row.
                //Get pull progression row count.

                $pullRowCount = Skill::where('progression_id', 1)->groupBy('row')->count();

                $dipRowCount = Skill::where('progression_id', 2)->groupBy('row')->count();

                $fullBodyRowCount = Skill::where('progression_id', 3)->groupBy('row')->count();

                $pushRowCount = Skill::where('progression_id', 4)->groupBy('row')->count();

                $coreRowCount = Skill::where('progression_id', 5)->groupBy('row')->count();

                $i = 1;

                do {
                    $skills[] = DB::table('skills')
                        ->select('skills.*')
                        ->leftJoin('exercise_users', function($join) {
                            $join->on('skills.exercise_id', '=', 'exercise_users.exercise_id');
                        })
                        ->leftJoin('exercises', function($join) {
                            $join->on('skills.exercise_id', '=', 'exercises.id');
                        })
                        ->where('skills.level', $i)
                        ->where('exercise_users.user_id', $request->input('user_id'))
                            ->orderBy('exercise_users.id', 'DESC')
                            ->first();
                    //Get next exercise that user need to unlock in that level.

                    $i++;
                } while ($i <= $pullRowCount);
                
                print_r($skill);
                
                die;

                $i = 1;

                do {
                    //Get next exercise that user need to unlock in that level.

                    $i++;
                } while ($i <= $dipRowCount);

                $i = 1;

                do {
                    //Get next exercise that user need to unlock in that level.

                    $i++;
                } while ($i <= $fullBodyRowCount);

                $i = 1;

                do {
                    //Get next exercise that user need to unlock in that level.

                    $i++;
                } while ($i <= $pushRowCount);

                $i = 1;

                do {
                    //Get next exercise that user need to unlock in that level.

                    $i++;
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
}
