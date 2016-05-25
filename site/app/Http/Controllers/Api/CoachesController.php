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
     * @apiParam {Number} user_id Id of user *required 
     * @apiSuccess {String} success.
     * @apiSuccessExample Success-Response:
     * HTTP/1.1 200 OK
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

                    $coachStatus = DB::table('coach_status')->where('user_id', $request->user_id)->where('coach_id', $coach->id)->first();

                    if ($coachStatus->week <= 15) {
                        $coach->description = DB::table('coach_descriptions')->where('week', $coachStatus->week)->pluck('description');
                    } else {
                        $coach->description = DB::table('coach_descriptions')->where('week', 15)->pluck('description');
                    }

                    $currentTimestamp = time();

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


                    if (strtotime($coach->updated_at . ' + 7 days') <= $currentTimestamp && $coachStatus->need_update == 1) {
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
                                'urls' => config('urls.urls')], 200);
                    } else {
                        if ($coachStatus->need_update == 1) {
                            return response()->json([
                                    'status' => 1,
                                    'message' => 'already_completed_week_workouts',
                                    'coach_day' => $coachStatus->day,
                                    'coach_week' => $coachStatus->week,
                                    'is_subscribed' => $user->is_subscribed,
                                    'need_update' => 1,
                                    'week_status' => $weekStatus,
                                    'day_status' => $dayStatus,
                                    'week_points' => DB::table('coach_points')->where('user_id', $request->user_id)->where('week', $coachStatus->week)->sum('points'),
                                    'coach' => $coach,
                                    'urls' => config('urls.urls')], 200);
                        }

                        if ($coachStatus->need_update == 0) {
                            if ($dayStatus[$coachStatus->day] == 1) {
                                $coachUpdatedDate = date('Y-m-d', strtotime($coachStatus->updated_at));
//                                Live
//                                $coachNextDay = strtotime($coachUpdatedDate . ' 00:00:01 + 1 days');
//                                
//                                
//                                Development
                                $coachNextDay = strtotime($coachStatus->updated_at . ' + 30 Minutes');
                                if ($coachNextDay > $currentTimestamp) {
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
                ['exercise_id' => 67, 'duration' => 10, 'test_done' => 0],
                ['exercise_id' => 45, 'duration' => 15, 'test_done' => 0],
                ['exercise_id' => 4, 'duration' => 45, 'test_done' => 0],
                ['exercise_id' => 12, 'duration' => 20, 'test_done' => 0]
            ]
//            ,
//            1 => [
//                ['exercise_id' => 43, 'duration' => 10, 'test_done' => 0],
//                ['exercise_id' => 2, 'duration' => 10, 'test_done' => 0],
//                ['exercise_id' => 40, 'duration' => 15, 'test_done' => 0],
//                ['exercise_id' => 17, 'duration' => 15, 'test_done' => 0]
//            ],
//            2 => [
//                ['exercise_id' => 43, 'duration' => 30, 'test_done' => 0],
//                ['exercise_id' => 32, 'duration' => 10, 'test_done' => 0],
//                ['exercise_id' => 38, 'duration' => 25, 'test_done' => 0]
//            ],
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

                for ($i = 1; $i <= $coachStatus->week; $i++) {
                    if ($i <= $request->week) {
                        $statusArray[$i] = 1;
                    } else {
                        $statusArray[$i] = 0;
                    }
                }

                $data['week_status'] = json_encode($statusArray);

                $data['need_update'] = 1;

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
     * @apiParam {Number} focus user focus 1-Lean, 2-Athletic, 3-Strength *required
     * @apiParam {Number} days number of workout days per week *required
     * @apiParam {String} [muscle_groups] user muscle groups preferences comma seperated ids 1,5,6 etc.
     * @apiParam {String} feedback user feedback json_encoded array {"67":2,"45":1,"4":2,"12":3} 0-not done, 1- I can do way more, 2 - I can do more, 3 - It was ok *required
     * @apiSuccess {String} success.
     * @apiSuccessExample Success-Response:
     * HTTP/1.1 200 OK
     * {
      "status": 1,
      "coach_day": "1",
      "coach_week": "1",
      "is_subscribed": 0,
      "need_update": "0",
      "week_points": 200,
      "coach": {
      "id": "9",
      "user_id": "96",
      "focus": "3",
      "height": "172.00",
      "weight": "176.00",
      "days": "2",
      "exercises": {
      "day1": {
      "warmup": [
      {
      "id": "1",
      "name": "Wall Extensions",
      "duration": {
      "min": 10,
      "max": 20
      },
      "unit": "times",
      "created_at": "2016-01-11 00:00:00",
      "updated_at": "2016-01-11 08:27:00"
      },
      {
      "id": "2",
      "name": "band dislocates",
      "duration": {
      "min": 10,
      "max": 20
      },
      "unit": "times",
      "created_at": "2016-01-11 00:00:00",
      "updated_at": "2016-01-11 08:26:57"
      },
      {
      "id": "3",
      "name": "Cat-camels",
      "duration": {
      "min": 10,
      "max": 20
      },
      "unit": "times",
      "created_at": "2016-01-11 00:00:00",
      "updated_at": "2016-01-11 08:26:53"
      },
      {
      "id": "4",
      "name": "Scapular Shrugs",
      "duration": {
      "min": 10,
      "max": 20
      },
      "unit": "times",
      "created_at": "2016-01-11 00:00:00",
      "updated_at": "2016-01-11 08:26:49"
      },
      {
      "id": "5",
      "name": "Full Body Circles",
      "duration": {
      "min": 10,
      "max": 20
      },
      "unit": "times",
      "created_at": "2016-01-11 00:00:01",
      "updated_at": "2016-01-11 08:26:44"
      },
      {
      "id": "6",
      "name": "Front and Side Leg Swings",
      "duration": {
      "min": 10,
      "max": 20
      },
      "unit": "times",
      "created_at": "2016-01-11 00:00:01",
      "updated_at": "2016-01-11 08:26:40"
      },
      {
      "id": "7",
      "name": "Jumping Jacks",
      "duration": {
      "min": 100
      },
      "unit": "times",
      "created_at": "2016-01-11 00:00:01",
      "updated_at": "2016-01-11 08:29:46"
      },
      {
      "id": "8",
      "name": "Arm Rotations",
      "duration": {
      "min": 120
      },
      "unit": "times",
      "created_at": "2016-01-11 00:00:02",
      "updated_at": "2016-01-11 08:29:55"
      },
      {
      "id": "9",
      "name": "High Knees",
      "duration": {
      "min": 50
      },
      "unit": "times",
      "created_at": "2016-01-11 00:00:02",
      "updated_at": "2016-01-11 08:30:04"
      },
      {
      "id": "10",
      "name": "Plank",
      "duration": {
      "min": 10,
      "max": 60
      },
      "unit": "seconds",
      "created_at": "2016-01-11 00:00:02",
      "updated_at": "2016-01-11 08:28:03"
      },
      {
      "id": "11",
      "name": "Burpee",
      "duration": {
      "min": 10
      },
      "unit": "times",
      "created_at": "2016-01-11 00:00:03",
      "updated_at": "2016-01-11 08:30:44"
      },
      {
      "id": "12",
      "name": "Shouder rolls",
      "duration": {
      "min": 20
      },
      "unit": "times",
      "created_at": "2016-01-11 00:00:03",
      "updated_at": "2016-01-11 08:31:11"
      },
      {
      "id": "13",
      "name": "Squat jumps",
      "duration": {
      "min": 10
      },
      "unit": "times",
      "created_at": "2016-01-11 00:00:03",
      "updated_at": "2016-01-11 08:31:29"
      }
      ],
      "fundumentals": [
      {
      "exercise_id": 4,
      "duration": {
      "min": 10
      },
      "unit": "times",
      "exercise": {
      "id": "4",
      "name": "Skin the cat",
      "description": "A good upper body stretching exercise, especially for achieving full range of motion in the shoulder. The skin the cat exercise is a fundamental movement performed on gymnastics rings.",
      "category": "1",
      "type": "2",
      "muscle_groups": "0",
      "rewards": "6.00",
      "repititions": "10",
      "duration": "10",
      "unit": "times",
      "equipment": "",
      "range_of_motion": "",
      "video_tips": "",
      "pro_tips": "",
      "video": [
      {
      "id": "4",
      "path": "Now4.mp4",
      "videothumbnail": "thumbnail3.jpg",
      "description": "Test Description"
      }
      ]
      }
      },
      {
      "exercise_id": 12,
      "duration": {
      "min": 20
      },
      "unit": "times",
      "exercise": {
      "id": "12",
      "name": "Incline Pushups",
      "description": "",
      "category": "1",
      "type": "1",
      "muscle_groups": "2,1,3",
      "rewards": "6.00",
      "repititions": "10",
      "duration": "1",
      "unit": "times",
      "equipment": "",
      "range_of_motion": "",
      "video_tips": "",
      "pro_tips": "",
      "video": [
      {
      "id": "12",
      "path": "Now12.mp4",
      "videothumbnail": "thumbnail2.png",
      "description": "Test Description"
      }
      ]
      }
      },
      {
      "exercise_id": 36,
      "duration": {
      "min": 40
      },
      "unit": "times",
      "exercise": {
      "id": "36",
      "name": "Dips (Bench)",
      "description": "",
      "category": "2",
      "type": "1",
      "muscle_groups": "0",
      "rewards": "6.00",
      "repititions": "10",
      "duration": "1",
      "unit": "times",
      "equipment": "",
      "range_of_motion": "",
      "video_tips": "",
      "pro_tips": "",
      "video": [
      {
      "id": "36",
      "path": "Now36.mp4",
      "videothumbnail": "thumbnail2.png",
      "description": "Test Description"
      }
      ]
      }
      },
      {
      "exercise_id": 3,
      "duration": {
      "min": 15
      },
      "unit": "times",
      "exercise": {
      "id": "3",
      "name": "Knee Raises",
      "description": "Standing Knee Raises (also known as standing knee crunches and standing knee pulls) is a functional abdominal exercise for boosting strength throughout the core. Unlike standard ab exercises, they don’t isolate abdominal muscles. Instead they work your upper abs and lower abs in conjunction with other important muscles such as hips, back and shoulders.",
      "category": "1",
      "type": "2",
      "muscle_groups": "6,4,7",
      "rewards": "6.00",
      "repititions": "10",
      "duration": "1",
      "unit": "times",
      "equipment": "",
      "range_of_motion": "",
      "video_tips": "",
      "pro_tips": "",
      "video": [
      {
      "id": "3",
      "path": "Now3.mp4",
      "videothumbnail": "thumbnail2.png",
      "description": "Test Description"
      }
      ]
      }
      },
      {
      "exercise_id": 8,
      "duration": {
      "min": 20
      },
      "unit": "times",
      "exercise": {
      "id": "8",
      "name": "Single Leg Deadlift",
      "description": "",
      "category": "1",
      "type": "2",
      "muscle_groups": "7",
      "rewards": "6.00",
      "repititions": "10",
      "duration": "1",
      "unit": "times",
      "equipment": "",
      "range_of_motion": "",
      "video_tips": "",
      "pro_tips": "",
      "video": [
      {
      "id": "8",
      "path": "Now8.mp4",
      "videothumbnail": "thumbnail1.png",
      "description": "Test Description"
      }
      ]
      }
      }
      ],
      "exercises": [],
      "workout": {
      "id": "1",
      "name": "Baldur",
      "description": "Baldur Baldur",
      "rounds": "5",
      "category": "1",
      "type": "2",
      "rewards": 550,
      "duration": "1680.00",
      "equipments": "",
      "exercises": {
      "round1": [
      {
      "id": "31",
      "workout_id": "1",
      "category": "3",
      "repititions": "50",
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
      "id": "32",
      "workout_id": "1",
      "category": "3",
      "repititions": "50",
      "exercise_id": "85",
      "unit": "times",
      "round": "1",
      "created_at": "2015-11-18 18:30:00",
      "updated_at": "2015-12-07 10:17:23",
      "video": {
      "id": "86",
      "path": "Now86.mp4",
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
      "workout_id": "1",
      "category": "3",
      "repititions": "50",
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
      "id": "34",
      "workout_id": "1",
      "category": "3",
      "repititions": "40",
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
      "id": "35",
      "workout_id": "1",
      "category": "3",
      "repititions": "40",
      "exercise_id": "85",
      "unit": "times",
      "round": "2",
      "created_at": "2015-11-18 18:30:00",
      "updated_at": "2015-12-07 10:17:23",
      "video": {
      "id": "86",
      "path": "Now86.mp4",
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
      "workout_id": "1",
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
      "id": "37",
      "workout_id": "1",
      "category": "3",
      "repititions": "30",
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
      "id": "38",
      "workout_id": "1",
      "category": "3",
      "repititions": "30",
      "exercise_id": "85",
      "unit": "times",
      "round": "3",
      "created_at": "2015-11-18 18:30:00",
      "updated_at": "2015-12-07 10:17:23",
      "video": {
      "id": "86",
      "path": "Now86.mp4",
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
      "workout_id": "1",
      "category": "3",
      "repititions": "30",
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
      "id": "40",
      "workout_id": "1",
      "category": "3",
      "repititions": "20",
      "exercise_id": "69",
      "unit": "times",
      "round": "4",
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
      "id": "41",
      "workout_id": "1",
      "category": "3",
      "repititions": "20",
      "exercise_id": "85",
      "unit": "times",
      "round": "4",
      "created_at": "2015-11-18 18:30:00",
      "updated_at": "2015-12-07 10:17:23",
      "video": {
      "id": "86",
      "path": "Now86.mp4",
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
      "id": "42",
      "workout_id": "1",
      "category": "3",
      "repititions": "20",
      "exercise_id": "70",
      "unit": "times",
      "round": "4",
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
      "id": "43",
      "workout_id": "1",
      "category": "3",
      "repititions": "10",
      "exercise_id": "69",
      "unit": "times",
      "round": "5",
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
      "id": "44",
      "workout_id": "1",
      "category": "3",
      "repititions": "10",
      "exercise_id": "85",
      "unit": "times",
      "round": "5",
      "created_at": "2015-11-18 18:30:00",
      "updated_at": "2015-12-07 10:17:23",
      "video": {
      "id": "86",
      "path": "Now86.mp4",
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
      "id": "45",
      "workout_id": "1",
      "category": "3",
      "repititions": "10",
      "exercise_id": "70",
      "unit": "times",
      "round": "5",
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
      "id": "31",
      "workout_id": "1",
      "category": "3",
      "repititions": "50",
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
      "id": "32",
      "workout_id": "1",
      "category": "3",
      "repititions": "50",
      "exercise_id": "85",
      "unit": "times",
      "round": "1",
      "created_at": "2015-11-18 18:30:00",
      "updated_at": "2015-12-07 10:17:23",
      "video": {
      "id": "86",
      "path": "Now86.mp4",
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
      "workout_id": "1",
      "category": "3",
      "repititions": "50",
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
      ]
      }
      },
      "coach_workout_rounds": 6,
      "workout_intensity": 2,
      "hiit": [],
      "stretching": [
      {
      "exercise_id": "Superman",
      "duration": {
      "min": 6,
      "max": 13
      },
      "unit": "times"
      },
      {
      "exercise_id": "Lower Back Strength",
      "duration": {
      "min": 38,
      "max": 63
      },
      "unit": "times"
      },
      {
      "exercise_id": "Upper Dog",
      "duration": {
      "min": 38,
      "max": 75
      },
      "unit": "seconds"
      },
      {
      "exercise_id": "Child's Pose",
      "duration": {
      "min": 38,
      "max": 75
      },
      "unit": "seconds"
      },
      {
      "exercise_id": "L-sit on the floor",
      "duration": {
      "min": 38,
      "max": 75
      },
      "unit": "seconds"
      },
      {
      "exercise_id": "Frog stretch",
      "duration": {
      "min": 38,
      "max": 75
      },
      "unit": "seconds"
      },
      {
      "exercise_id": "Good morning",
      "duration": {
      "min": 38,
      "max": 75
      },
      "unit": "seconds"
      },
      {
      "exercise_id": "Chest Opener",
      "duration": {
      "min": 38,
      "max": 75
      },
      "unit": "seconds"
      },
      {
      "exercise_id": "Triceps Stretch",
      "duration": {
      "min": 38,
      "max": 75
      },
      "unit": "seconds"
      },
      {
      "exercise_id": "Hands Back",
      "duration": {
      "min": 38,
      "max": 75
      },
      "unit": "seconds"
      },
      {
      "exercise_id": "Shoulder Stretch",
      "duration": {
      "min": 38,
      "max": 75
      },
      "unit": "seconds"
      }
      ]
      },
      "day2": {
      "warmup": [
      {
      "id": "1",
      "name": "Wall Extensions",
      "duration": {
      "min": 10,
      "max": 20
      },
      "unit": "times",
      "created_at": "2016-01-11 00:00:00",
      "updated_at": "2016-01-11 08:27:00"
      },
      {
      "id": "2",
      "name": "band dislocates",
      "duration": {
      "min": 10,
      "max": 20
      },
      "unit": "times",
      "created_at": "2016-01-11 00:00:00",
      "updated_at": "2016-01-11 08:26:57"
      },
      {
      "id": "3",
      "name": "Cat-camels",
      "duration": {
      "min": 10,
      "max": 20
      },
      "unit": "times",
      "created_at": "2016-01-11 00:00:00",
      "updated_at": "2016-01-11 08:26:53"
      },
      {
      "id": "4",
      "name": "Scapular Shrugs",
      "duration": {
      "min": 10,
      "max": 20
      },
      "unit": "times",
      "created_at": "2016-01-11 00:00:00",
      "updated_at": "2016-01-11 08:26:49"
      },
      {
      "id": "5",
      "name": "Full Body Circles",
      "duration": {
      "min": 10,
      "max": 20
      },
      "unit": "times",
      "created_at": "2016-01-11 00:00:01",
      "updated_at": "2016-01-11 08:26:44"
      },
      {
      "id": "6",
      "name": "Front and Side Leg Swings",
      "duration": {
      "min": 10,
      "max": 20
      },
      "unit": "times",
      "created_at": "2016-01-11 00:00:01",
      "updated_at": "2016-01-11 08:26:40"
      },
      {
      "id": "7",
      "name": "Jumping Jacks",
      "duration": {
      "min": 100
      },
      "unit": "times",
      "created_at": "2016-01-11 00:00:01",
      "updated_at": "2016-01-11 08:29:46"
      },
      {
      "id": "8",
      "name": "Arm Rotations",
      "duration": {
      "min": 120
      },
      "unit": "times",
      "created_at": "2016-01-11 00:00:02",
      "updated_at": "2016-01-11 08:29:55"
      },
      {
      "id": "9",
      "name": "High Knees",
      "duration": {
      "min": 50
      },
      "unit": "times",
      "created_at": "2016-01-11 00:00:02",
      "updated_at": "2016-01-11 08:30:04"
      },
      {
      "id": "10",
      "name": "Plank",
      "duration": {
      "min": 10,
      "max": 60
      },
      "unit": "seconds",
      "created_at": "2016-01-11 00:00:02",
      "updated_at": "2016-01-11 08:28:03"
      },
      {
      "id": "11",
      "name": "Burpee",
      "duration": {
      "min": 10
      },
      "unit": "times",
      "created_at": "2016-01-11 00:00:03",
      "updated_at": "2016-01-11 08:30:44"
      },
      {
      "id": "12",
      "name": "Shouder rolls",
      "duration": {
      "min": 20
      },
      "unit": "times",
      "created_at": "2016-01-11 00:00:03",
      "updated_at": "2016-01-11 08:31:11"
      },
      {
      "id": "13",
      "name": "Squat jumps",
      "duration": {
      "min": 10
      },
      "unit": "times",
      "created_at": "2016-01-11 00:00:03",
      "updated_at": "2016-01-11 08:31:29"
      }
      ],
      "fundumentals": [
      {
      "exercise_id": 1,
      "duration": {
      "min": 15
      },
      "unit": "times",
      "exercise": {
      "id": "1",
      "name": "Jumping Pullups",
      "description": "The jumping pull-up is a challenging full body exercise that targets the back, legs and arms.",
      "category": "1",
      "type": "1",
      "muscle_groups": "0",
      "rewards": "6.00",
      "repititions": "10",
      "duration": "1",
      "unit": "times",
      "equipment": "",
      "range_of_motion": "",
      "video_tips": "",
      "pro_tips": "",
      "video": [
      {
      "id": "1",
      "path": "Now1.mp4",
      "videothumbnail": "thumbnail3.jpg",
      "description": "Test Description"
      }
      ]
      }
      },
      {
      "exercise_id": 13,
      "duration": {
      "min": 20
      },
      "unit": "times",
      "exercise": {
      "id": "13",
      "name": "Military Press",
      "description": "",
      "category": "1",
      "type": "1",
      "muscle_groups": "1,3",
      "rewards": "6.00",
      "repititions": "10",
      "duration": "1",
      "unit": "times",
      "equipment": "",
      "range_of_motion": "",
      "video_tips": "",
      "pro_tips": "",
      "video": [
      {
      "id": "13",
      "path": "Now13.mp4",
      "videothumbnail": "thumbnail3.jpg",
      "description": "Test Description"
      }
      ]
      }
      },
      {
      "exercise_id": 5,
      "duration": {
      "min": 40
      },
      "unit": "times",
      "exercise": {
      "id": "5",
      "name": "Side Triceps",
      "description": "",
      "category": "1",
      "type": "1",
      "muscle_groups": "0",
      "rewards": "6.00",
      "repititions": "10",
      "duration": "30",
      "unit": "times",
      "equipment": "",
      "range_of_motion": "",
      "video_tips": "",
      "pro_tips": "",
      "video": [
      {
      "id": "5",
      "path": "Now5.mp4",
      "videothumbnail": "thumbnail1.png",
      "description": "Test Description"
      }
      ]
      }
      },
      {
      "exercise_id": 16,
      "duration": {
      "min": 40
      },
      "unit": "times",
      "exercise": {
      "id": "16",
      "name": "Crunches",
      "description": "",
      "category": "1",
      "type": "1",
      "muscle_groups": "6",
      "rewards": "6.00",
      "repititions": "10",
      "duration": "1",
      "unit": "times",
      "equipment": "",
      "range_of_motion": "",
      "video_tips": "",
      "pro_tips": "",
      "video": [
      {
      "id": "16",
      "path": "Now16.mp4",
      "videothumbnail": "thumbnail3.jpg",
      "description": "Test Description"
      }
      ]
      }
      },
      {
      "exercise_id": 7,
      "duration": {
      "min": 60,
      "max": 90
      },
      "unit": "seconds",
      "exercise": {
      "id": "7",
      "name": "Wall Sits",
      "description": "",
      "category": "1",
      "type": "1",
      "muscle_groups": "7,8",
      "rewards": "6.00",
      "repititions": "10",
      "duration": "10",
      "unit": "seconds",
      "equipment": "",
      "range_of_motion": "",
      "video_tips": "",
      "pro_tips": "",
      "video": [
      {
      "id": "7",
      "path": "Now7.mp4",
      "videothumbnail": "thumbnail3.jpg",
      "description": "Test Description"
      }
      ]
      }
      }
      ],
      "exercises": [],
      "workout": {
      "id": "4",
      "name": "Buri",
      "description": "Buri",
      "rounds": "1",
      "category": "1",
      "type": "2",
      "rewards": 550,
      "duration": "1440.00",
      "equipments": "Bar",
      "exercises": {
      "round1": [
      {
      "id": "150",
      "workout_id": "4",
      "category": "3",
      "repititions": "180",
      "exercise_id": "75",
      "unit": "seconds",
      "round": "1",
      "created_at": "2015-11-18 18:30:00",
      "updated_at": "2015-11-19 10:00:00",
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
      "id": "151",
      "workout_id": "4",
      "category": "3",
      "repititions": "50",
      "exercise_id": "69",
      "unit": "times",
      "round": "1",
      "created_at": "2015-11-18 18:30:00",
      "updated_at": "2015-11-19 10:00:00",
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
      "id": "152",
      "workout_id": "4",
      "category": "3",
      "repititions": "100",
      "exercise_id": "70",
      "unit": "times",
      "round": "1",
      "created_at": "2015-11-18 18:30:00",
      "updated_at": "2015-11-19 10:00:54",
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
      },
      {
      "id": "153",
      "workout_id": "4",
      "category": "3",
      "repititions": "50",
      "exercise_id": "74",
      "unit": "times",
      "round": "1",
      "created_at": "2015-11-18 18:30:00",
      "updated_at": "2015-11-19 10:45:38",
      "video": {
      "id": "75",
      "path": "Now75.mp4",
      "videothumbnail": "thumbnail2.png",
      "description": "Test Description"
      },
      "exercise": {
      "id": "74",
      "name": "Handstand Pushups",
      "description": ""
      }
      },
      {
      "id": "154",
      "workout_id": "4",
      "category": "3",
      "repititions": "200",
      "exercise_id": "82",
      "unit": "times",
      "round": "1",
      "created_at": "2015-11-18 18:30:00",
      "updated_at": "2015-11-19 10:00:00",
      "video": {
      "id": "83",
      "path": "Now83.mp4",
      "videothumbnail": "thumbnail1.png",
      "description": "Test Description"
      },
      "exercise": {
      "id": "82",
      "name": "Iron Mike",
      "description": ""
      }
      }
      ]
      }
      },
      "coach_workout_rounds": 1,
      "workout_intensity": 1,
      "hiit": [
      {
      "id": 2,
      "intensity": 4
      }
      ],
      "stretching": [
      {
      "exercise_id": "Superman",
      "duration": {
      "min": 6,
      "max": 13
      },
      "unit": "times"
      },
      {
      "exercise_id": "Lower Back Strength",
      "duration": {
      "min": 38,
      "max": 63
      },
      "unit": "times"
      },
      {
      "exercise_id": "Upper Dog",
      "duration": {
      "min": 38,
      "max": 75
      },
      "unit": "seconds"
      },
      {
      "exercise_id": "Child's Pose",
      "duration": {
      "min": 38,
      "max": 75
      },
      "unit": "seconds"
      },
      {
      "exercise_id": "L-sit on the floor",
      "duration": {
      "min": 38,
      "max": 75
      },
      "unit": "seconds"
      },
      {
      "exercise_id": "Frog stretch",
      "duration": {
      "min": 38,
      "max": 75
      },
      "unit": "seconds"
      },
      {
      "exercise_id": "Good morning",
      "duration": {
      "min": 38,
      "max": 75
      },
      "unit": "seconds"
      },
      {
      "exercise_id": "Chest Opener",
      "duration": {
      "min": 38,
      "max": 75
      },
      "unit": "seconds"
      },
      {
      "exercise_id": "Triceps Stretch",
      "duration": {
      "min": 38,
      "max": 75
      },
      "unit": "seconds"
      },
      {
      "exercise_id": "Hands Back",
      "duration": {
      "min": 38,
      "max": 75
      },
      "unit": "seconds"
      },
      {
      "exercise_id": "Shoulder Stretch",
      "duration": {
      "min": 38,
      "max": 75
      },
      "unit": "seconds"
      }
      ]
      }
      },
      "category": "advanced",
      "muscle_groups": "3,6,8",
      "created_at": "2016-01-14 11:31:41",
      "updated_at": "2016-01-15 06:27:40"
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
        } elseif (!isset($request->test) || ($request->test == null)) {
            return response()->json(["status" => "0", "error" => "The test field is required"]);
        } elseif (!isset($request->days) || ($request->days == null)) {
            return response()->json(["status" => "0", "error" => "The days field is required"]);
        } elseif (!isset($request->feedback) || ($request->feedback == null)) {
            return response()->json(["status" => "0", "error" => "The feedback field is required"]);
        } else {
            $user = User::where('id', '=', $request->input('user_id'))->first();

            $feedbacks = json_decode($request->feedback, true);

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

            if (!is_null($user)) {
                $data = [
                    'user_id' => $request->user_id,
                    'focus' => $profile->goal,
                    'category' => $category,
                    'muscle_groups' => (!isset($request->muscle_groups) || ($request->muscle_groups == null)) ? "" : $request->muscle_groups,
                    'limitations' => (!isset($request->limitations) || ($request->limitations == null)) ? "" : $request->limitations,
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
                        DB::table('user_physique_options')->where('user_id', $request->user_id)->update(['physique_options' => $request->muscle_groups]);
                    } else {
                        DB::table('user_physique_options')->insert(['physique_options' => $request->muscle_groups, 'user_id' => $request->user_id]);
                    }
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

                //Limit the coach exercises and reptitions

                $filteredCoach = Coach::filterCoachExercises($coachExercises, $data);

                DB::table('coaches')->where('id', $coachId)->update(['exercises' => json_encode($filteredCoach)]);

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

                DB::table('user_physique_options')->where('user_id', $request->user_id)->delete();

                DB::table('user_goal_options')->where('user_id', $request->user_id)->delete();

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
}
