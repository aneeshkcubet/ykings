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


                    if (strtotime($coachStatus->created_at . ' + ' . $coachStatus->week . ' weeks') <= $currentTimestamp) {
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
                                if (strtotime($coachStatus->updated_at . ' + 1 days') >= $currentTimestamp) {
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
                ['exercise_id' => 43, 'duration' => 10, 'test_done' => 0],
                ['exercise_id' => 2, 'duration' => 10, 'test_done' => 0],
                ['exercise_id' => 40, 'duration' => 15, 'test_done' => 0],
                ['exercise_id' => 17, 'duration' => 15, 'test_done' => 0]
            ],
            2 => [
                ['exercise_id' => 43, 'duration' => 30, 'test_done' => 0],
                ['exercise_id' => 32, 'duration' => 10, 'test_done' => 0],
                ['exercise_id' => 38, 'duration' => 25, 'test_done' => 0]
            ],
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

                if (is_null($coachStatus->week_status) || $coachStatus->week_status == '') {
                    $WeekStatusArray = [];

                    if ($request->day == $coach->days) {
                        for ($j = 1; $j <= $coachStatus->week; $j++) {
                            $WeekStatusArray[$j] = 1;
                        }
                        $data['need_update'] = 1;
                    } else {
                        for ($j = 1; $j < $coachStatus->week; $j++) {
                            $WeekStatusArray[$j] = 1;
                        }

                        $WeekStatusArray[$coachStatus->week] = 0;
                        $data['need_update'] = 0;
                    }
                    $data['week_status'] = json_encode($WeekStatusArray);
                } else {

                    $WeekStatusArray = json_decode($coach->week_status, TRUE);
                    if ($request->day == $coach->days) {
                        for ($j = 1; $j <= $coachStatus->week; $j++) {
                            $WeekStatusArray[$j] = 1;
                        }
                        $data['need_update'] = 1;
                    } else {
                        for ($j = 1; $j < $coachStatus->week; $j++) {
                            $WeekStatusArray[$j] = 1;
                        }

                        $WeekStatusArray[$coachStatus->week] = 0;
                        $data['need_update'] = 0;
                    }
                    $data['week_status'] = json_encode($WeekStatusArray);
                }

                DB::table('coach_status')
                    ->where('user_id', $request->user_id)
                    ->where('coach_id', $coach->id)
                    ->update($data);

                $coach = DB::table('coaches')->where('user_id', $request->user_id)->first();

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
                        'need_update' => 1,
                        'week_status' => $weekStatus,
                        'day_status' => $dayStatus,
                        'week_points' => DB::table('coach_points')->where('user_id', $request->user_id)->where('week', $coachStatus->week)->sum('points'),
                        ], 200);
            } else {
                return response()->json(['status' => 0, 'error' => 'user_not_exists'], 500);
            }
        }
    }

    /**
     * @api {post} /coach/preparecoach prepareCoach
     * @apiName prepareCoach
     * @apiGroup Coach
     * @apiParam {Number} user_id Id of user *required
     * @apiParam {Number} test1 status of test1 0-failed 1-passed *required
     * @apiParam {Number} test2 status of test2 0-failed 1-passed *required
     * @apiParam {Number} focus user focus 1-Lean, 2-Athletic, 3-Strength *required
     * @apiParam {Number} days number of workout days per week *required
     * @apiParam {String} [muscle_groups] user muscle groups preferences comma seperated ids 1,5,6 etc.
     * @apiParam {Number} [height] user height in centimeters
     * @apiParam {Number} [weight] user weight in lbs
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
                    'category' => ($request->test1 == 0 && $request->test2 == 0) ? 'beginer' : 'advanced',
                    'muscle_groups' => (!isset($request->muscle_groups) || ($request->muscle_groups == null)) ? "" : $request->muscle_groups,
                    'height' => (!isset($request->height) || ($request->height == null)) ? "" : $request->height,
                    'weight' => (!isset($request->weight) || ($request->weight == null)) ? "" : $request->weight,
                    'days' => $request->days,
                    'exercises' => ''
                ];

                $userCoach = Coach::where('user_id', '=', $request->input('user_id'))->first();

                if (is_null($userCoach)) {

                    Coach::create($data);

                    $coachId = DB::table('coaches')->where('user_id', $request->user_id)->pluck('id');
                } else {


                    DB::table('coaches')->where('id', $userCoach->id)->update($data);

                    $coachId = $userCoach->id;
                }


                $data['test1'] = $request->test1;

                $data['test2'] = $request->test2;

                $coachExercises = Coach::prepareCoachExercises($coachId, $data);

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
     * @apiSuccess {String} success.
     * @apiSuccessExample Success-Response:
     * HTTP/1.1 200 OK
     * {
      "status": 1,
      "coach_day": "1",
      "coach_week": "1",
      "is_subscribed": 0,
      "need_update": "0",
      "week_points": 0,
      "coach": {
      "id": "11",
      "user_id": "11",
      "focus": "1",
      "height": "200.00",
      "weight": "170.00",
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
      "id": "11",
      "row": "3",
      "exercise_id": "64",
      "duration": {
      "min": "10",
      "max": ""
      },
      "unit": "seconds",
      "is_completed": "0",
      "created_at": "2016-01-22 04:35:13",
      "updated_at": "2016-01-22 04:35:13",
      "exercise": {
      "id": "64",
      "name": "Skin the cat",
      "description": "Develop your joints mobility and expose yourself to new movement layers.",
      "category": "1",
      "type": "2",
      "muscle_groups": "",
      "rewards": "6.00",
      "repititions": "10",
      "duration": "10",
      "unit": "seconds",
      "equipment": "",
      "range_of_motion": "\"1. Hands a little more than shoulder width apart\r\n2. Raise your knees to the chest\r\n3. continuing the movement until the feet pass up through the arms and over head into an inverted hang position.\r\n4. Continue to pass the feet round and down toward the ground (although not touching) into the extended 'skin the cat' position.\r\n5. Lift your hips and raise the legs back and over to the starting hang position.\"\r\n",
      "video_tips": "",
      "pro_tips": "Incorporate other static elements to challenge yourself during the movement.\r\n",
      "video": []
      }
      },
      {
      "id": "12",
      "row": "3",
      "exercise_id": "25",
      "duration": {
      "min": "20",
      "max": ""
      },
      "unit": "times",
      "is_completed": "0",
      "created_at": "2016-01-22 04:36:16",
      "updated_at": "2016-01-22 04:36:16",
      "exercise": {
      "id": "25",
      "name": "Decline Pushups",
      "description": "Increase the intensity and difficulty of a standard push ups and help you build shoulder strength fast.",
      "category": "1",
      "type": "2",
      "muscle_groups": "1,2,5",
      "rewards": "6.00",
      "repititions": "10",
      "duration": "10",
      "unit": "times",
      "equipment": "",
      "range_of_motion": "\"1. Start in a standard pushup position with your feet elevated.\r\n 2. Next, lower yourself downward until your chest almost touches the floor as you inhale.\r\n 3. Press up and repeat movement.\"\r\n",
      "video_tips": "",
      "pro_tips": "Do this exercise slowly as you progress\r\n",
      "video": [
      {
      "id": "23",
      "path": "25_1453098456.mp4",
      "videothumbnail": "25_1453098456.png",
      "description": ""
      }
      ]
      }
      },
      {
      "id": "13",
      "row": "3",
      "exercise_id": "49",
      "duration": {
      "min": "40",
      "max": ""
      },
      "unit": "seconds",
      "is_completed": "0",
      "created_at": "2016-01-22 04:36:49",
      "updated_at": "2016-01-22 04:36:49",
      "exercise": {
      "id": "49",
      "name": "Side Trizeps",
      "description": "Start with the basics of building triceps strength.",
      "category": "1",
      "type": "1",
      "muscle_groups": "",
      "rewards": "6.00",
      "repititions": "10",
      "duration": "10",
      "unit": "seconds",
      "equipment": "",
      "range_of_motion": "\"1. Start with the body on your side\r\n2. Put one hand on your shoulder \r\n3. Press up with the other arm and hold in extension\"\r\n",
      "video_tips": "",
      "pro_tips": "",
      "video": [
      {
      "id": "43",
      "path": "49_1453107322.mp4",
      "videothumbnail": "49_1453107322.png",
      "description": ""
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
      "updated_at": "2016-01-22 04:37:32",
      "exercise": {
      "id": "4",
      "name": "Plank",
      "description": "The plank builds your isometric strength and helps sculpt your waistline.",
      "category": "1",
      "type": "1",
      "muscle_groups": "1,4,6",
      "rewards": "6.00",
      "repititions": "10",
      "duration": "10",
      "unit": "seconds",
      "equipment": "",
      "range_of_motion": "\"1. Get into pushup position on the floor.\r\n2. Now bend your elbows 90 degrees and rest your weight on your forearms. \r\n3. Hold the position for as long as you can. \"\r\n",
      "video_tips": "",
      "pro_tips": "Keep elbows directly below shoulders to safe energy while holding the plank.\r\n",
      "video": [
      {
      "id": "4",
      "path": "4_1453036787.mp4",
      "videothumbnail": "4_1453036787.png",
      "description": ""
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
      "updated_at": "2016-01-22 04:37:57",
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
      "range_of_motion": "\"1. Start from a standing position\r\n2. Jump up and bring your knees to your chest\"\r\n",
      "video_tips": "",
      "pro_tips": "Push yourself to jump up really high\r\n",
      "video": [
      {
      "id": "33",
      "path": "36_1453099391.mp4",
      "videothumbnail": "36_1453099391.png",
      "description": ""
      }
      ]
      }
      }
      ],
      "exercises": [],
      "workout": {
      "id": "12",
      "name": "Forseti",
      "description": "",
      "rounds": "6",
      "category": "2",
      "type": "2",
      "rewards": "330",
      "duration": "1080.00",
      "equipments": "Bar",
      "is_completed": 0,
      "exercises": {
      "round1": [
      {
      "id": "451",
      "workout_id": "12",
      "category": "1",
      "repititions": "10",
      "exercise_id": "9",
      "unit": "times",
      "round": "1",
      "created_at": "2016-01-19 06:00:30",
      "updated_at": "2016-01-19 06:00:30",
      "is_completed": 0,
      "video": {
      "id": "9",
      "path": "9_1453038416.mp4",
      "videothumbnail": "9_1453038416.png",
      "description": ""
      },
      "exercise": {
      "id": "9",
      "name": "Crunches",
      "description": "Do the most admired sixpack exercise in the world"
      }
      },
      {
      "id": "457",
      "workout_id": "12",
      "category": "1",
      "repititions": "25",
      "exercise_id": "32",
      "unit": "times",
      "round": "1",
      "created_at": "2016-01-19 06:00:57",
      "updated_at": "2016-01-19 06:00:57",
      "is_completed": 0,
      "video": {
      "id": "29",
      "path": "32_1453099099.mp4",
      "videothumbnail": "32_1453099099.png",
      "description": ""
      },
      "exercise": {
      "id": "32",
      "name": "Sprawl",
      "description": "Boost your cardio and strength with sprawls"
      }
      },
      {
      "id": "463",
      "workout_id": "12",
      "category": "1",
      "repititions": "25",
      "exercise_id": "57",
      "unit": "times",
      "round": "1",
      "created_at": "2016-01-19 06:01:16",
      "updated_at": "2016-01-19 06:01:16",
      "is_completed": 0,
      "video": null,
      "exercise": {
      "id": "57",
      "name": "Knee Raises",
      "description": "Develop grip and core strength and get used to slow and controlled moves."
      }
      },
      {
      "id": "469",
      "workout_id": "12",
      "category": "1",
      "repititions": "15",
      "exercise_id": "36",
      "unit": "times",
      "round": "1",
      "created_at": "2016-01-19 06:01:40",
      "updated_at": "2016-01-19 06:01:40",
      "is_completed": 0,
      "video": {
      "id": "33",
      "path": "36_1453099391.mp4",
      "videothumbnail": "36_1453099391.png",
      "description": ""
      },
      "exercise": {
      "id": "36",
      "name": "High Jumps",
      "description": "Do high jumps as a part of restless HIIT workouts"
      }
      }
      ],
      "round2": [
      {
      "id": "452",
      "workout_id": "12",
      "category": "1",
      "repititions": "10",
      "exercise_id": "9",
      "unit": "times",
      "round": "2",
      "created_at": "2016-01-19 06:00:30",
      "updated_at": "2016-01-19 06:00:30",
      "is_completed": 0,
      "video": {
      "id": "9",
      "path": "9_1453038416.mp4",
      "videothumbnail": "9_1453038416.png",
      "description": ""
      },
      "exercise": {
      "id": "9",
      "name": "Crunches",
      "description": "Do the most admired sixpack exercise in the world"
      }
      },
      {
      "id": "458",
      "workout_id": "12",
      "category": "1",
      "repititions": "25",
      "exercise_id": "32",
      "unit": "times",
      "round": "2",
      "created_at": "2016-01-19 06:00:57",
      "updated_at": "2016-01-19 06:00:57",
      "is_completed": 0,
      "video": {
      "id": "29",
      "path": "32_1453099099.mp4",
      "videothumbnail": "32_1453099099.png",
      "description": ""
      },
      "exercise": {
      "id": "32",
      "name": "Sprawl",
      "description": "Boost your cardio and strength with sprawls"
      }
      },
      {
      "id": "464",
      "workout_id": "12",
      "category": "1",
      "repititions": "25",
      "exercise_id": "57",
      "unit": "times",
      "round": "2",
      "created_at": "2016-01-19 06:01:16",
      "updated_at": "2016-01-19 06:01:16",
      "is_completed": 0,
      "video": null,
      "exercise": {
      "id": "57",
      "name": "Knee Raises",
      "description": "Develop grip and core strength and get used to slow and controlled moves."
      }
      },
      {
      "id": "470",
      "workout_id": "12",
      "category": "1",
      "repititions": "15",
      "exercise_id": "36",
      "unit": "times",
      "round": "2",
      "created_at": "2016-01-19 06:01:40",
      "updated_at": "2016-01-19 06:01:40",
      "is_completed": 0,
      "video": {
      "id": "33",
      "path": "36_1453099391.mp4",
      "videothumbnail": "36_1453099391.png",
      "description": ""
      },
      "exercise": {
      "id": "36",
      "name": "High Jumps",
      "description": "Do high jumps as a part of restless HIIT workouts"
      }
      }
      ],
      "round3": [
      {
      "id": "453",
      "workout_id": "12",
      "category": "1",
      "repititions": "10",
      "exercise_id": "9",
      "unit": "times",
      "round": "3",
      "created_at": "2016-01-19 06:00:30",
      "updated_at": "2016-01-19 06:00:30",
      "is_completed": 0,
      "video": {
      "id": "9",
      "path": "9_1453038416.mp4",
      "videothumbnail": "9_1453038416.png",
      "description": ""
      },
      "exercise": {
      "id": "9",
      "name": "Crunches",
      "description": "Do the most admired sixpack exercise in the world"
      }
      },
      {
      "id": "459",
      "workout_id": "12",
      "category": "1",
      "repititions": "25",
      "exercise_id": "32",
      "unit": "times",
      "round": "3",
      "created_at": "2016-01-19 06:00:57",
      "updated_at": "2016-01-19 06:00:57",
      "is_completed": 0,
      "video": {
      "id": "29",
      "path": "32_1453099099.mp4",
      "videothumbnail": "32_1453099099.png",
      "description": ""
      },
      "exercise": {
      "id": "32",
      "name": "Sprawl",
      "description": "Boost your cardio and strength with sprawls"
      }
      },
      {
      "id": "465",
      "workout_id": "12",
      "category": "1",
      "repititions": "25",
      "exercise_id": "57",
      "unit": "times",
      "round": "3",
      "created_at": "2016-01-19 06:01:16",
      "updated_at": "2016-01-19 06:01:16",
      "is_completed": 0,
      "video": null,
      "exercise": {
      "id": "57",
      "name": "Knee Raises",
      "description": "Develop grip and core strength and get used to slow and controlled moves."
      }
      },
      {
      "id": "471",
      "workout_id": "12",
      "category": "1",
      "repititions": "15",
      "exercise_id": "36",
      "unit": "times",
      "round": "3",
      "created_at": "2016-01-19 06:01:40",
      "updated_at": "2016-01-19 06:01:40",
      "is_completed": 0,
      "video": {
      "id": "33",
      "path": "36_1453099391.mp4",
      "videothumbnail": "36_1453099391.png",
      "description": ""
      },
      "exercise": {
      "id": "36",
      "name": "High Jumps",
      "description": "Do high jumps as a part of restless HIIT workouts"
      }
      }
      ],
      "round4": [
      {
      "id": "454",
      "workout_id": "12",
      "category": "1",
      "repititions": "10",
      "exercise_id": "9",
      "unit": "times",
      "round": "4",
      "created_at": "2016-01-19 06:00:30",
      "updated_at": "2016-01-19 06:00:30",
      "is_completed": 0,
      "video": {
      "id": "9",
      "path": "9_1453038416.mp4",
      "videothumbnail": "9_1453038416.png",
      "description": ""
      },
      "exercise": {
      "id": "9",
      "name": "Crunches",
      "description": "Do the most admired sixpack exercise in the world"
      }
      },
      {
      "id": "460",
      "workout_id": "12",
      "category": "1",
      "repititions": "25",
      "exercise_id": "32",
      "unit": "times",
      "round": "4",
      "created_at": "2016-01-19 06:00:58",
      "updated_at": "2016-01-19 06:00:58",
      "is_completed": 0,
      "video": {
      "id": "29",
      "path": "32_1453099099.mp4",
      "videothumbnail": "32_1453099099.png",
      "description": ""
      },
      "exercise": {
      "id": "32",
      "name": "Sprawl",
      "description": "Boost your cardio and strength with sprawls"
      }
      },
      {
      "id": "466",
      "workout_id": "12",
      "category": "1",
      "repititions": "25",
      "exercise_id": "57",
      "unit": "times",
      "round": "4",
      "created_at": "2016-01-19 06:01:16",
      "updated_at": "2016-01-19 06:01:16",
      "is_completed": 0,
      "video": null,
      "exercise": {
      "id": "57",
      "name": "Knee Raises",
      "description": "Develop grip and core strength and get used to slow and controlled moves."
      }
      },
      {
      "id": "472",
      "workout_id": "12",
      "category": "1",
      "repititions": "15",
      "exercise_id": "36",
      "unit": "times",
      "round": "4",
      "created_at": "2016-01-19 06:01:40",
      "updated_at": "2016-01-19 06:01:40",
      "is_completed": 0,
      "video": {
      "id": "33",
      "path": "36_1453099391.mp4",
      "videothumbnail": "36_1453099391.png",
      "description": ""
      },
      "exercise": {
      "id": "36",
      "name": "High Jumps",
      "description": "Do high jumps as a part of restless HIIT workouts"
      }
      }
      ],
      "round5": [
      {
      "id": "455",
      "workout_id": "12",
      "category": "1",
      "repititions": "10",
      "exercise_id": "9",
      "unit": "times",
      "round": "5",
      "created_at": "2016-01-19 06:00:30",
      "updated_at": "2016-01-19 06:00:30",
      "is_completed": 0,
      "video": {
      "id": "9",
      "path": "9_1453038416.mp4",
      "videothumbnail": "9_1453038416.png",
      "description": ""
      },
      "exercise": {
      "id": "9",
      "name": "Crunches",
      "description": "Do the most admired sixpack exercise in the world"
      }
      },
      {
      "id": "461",
      "workout_id": "12",
      "category": "1",
      "repititions": "25",
      "exercise_id": "32",
      "unit": "times",
      "round": "5",
      "created_at": "2016-01-19 06:00:58",
      "updated_at": "2016-01-19 06:00:58",
      "is_completed": 0,
      "video": {
      "id": "29",
      "path": "32_1453099099.mp4",
      "videothumbnail": "32_1453099099.png",
      "description": ""
      },
      "exercise": {
      "id": "32",
      "name": "Sprawl",
      "description": "Boost your cardio and strength with sprawls"
      }
      },
      {
      "id": "467",
      "workout_id": "12",
      "category": "1",
      "repititions": "25",
      "exercise_id": "57",
      "unit": "times",
      "round": "5",
      "created_at": "2016-01-19 06:01:16",
      "updated_at": "2016-01-19 06:01:16",
      "is_completed": 0,
      "video": null,
      "exercise": {
      "id": "57",
      "name": "Knee Raises",
      "description": "Develop grip and core strength and get used to slow and controlled moves."
      }
      },
      {
      "id": "473",
      "workout_id": "12",
      "category": "1",
      "repititions": "15",
      "exercise_id": "36",
      "unit": "times",
      "round": "5",
      "created_at": "2016-01-19 06:01:40",
      "updated_at": "2016-01-19 06:01:40",
      "is_completed": 0,
      "video": {
      "id": "33",
      "path": "36_1453099391.mp4",
      "videothumbnail": "36_1453099391.png",
      "description": ""
      },
      "exercise": {
      "id": "36",
      "name": "High Jumps",
      "description": "Do high jumps as a part of restless HIIT workouts"
      }
      }
      ],
      "round6": [
      {
      "id": "456",
      "workout_id": "12",
      "category": "1",
      "repititions": "10",
      "exercise_id": "9",
      "unit": "times",
      "round": "6",
      "created_at": "2016-01-19 06:00:30",
      "updated_at": "2016-01-19 06:00:30",
      "is_completed": 0,
      "video": {
      "id": "9",
      "path": "9_1453038416.mp4",
      "videothumbnail": "9_1453038416.png",
      "description": ""
      },
      "exercise": {
      "id": "9",
      "name": "Crunches",
      "description": "Do the most admired sixpack exercise in the world"
      }
      },
      {
      "id": "462",
      "workout_id": "12",
      "category": "1",
      "repititions": "25",
      "exercise_id": "32",
      "unit": "times",
      "round": "6",
      "created_at": "2016-01-19 06:00:58",
      "updated_at": "2016-01-19 06:00:58",
      "is_completed": 0,
      "video": {
      "id": "29",
      "path": "32_1453099099.mp4",
      "videothumbnail": "32_1453099099.png",
      "description": ""
      },
      "exercise": {
      "id": "32",
      "name": "Sprawl",
      "description": "Boost your cardio and strength with sprawls"
      }
      },
      {
      "id": "468",
      "workout_id": "12",
      "category": "1",
      "repititions": "25",
      "exercise_id": "57",
      "unit": "times",
      "round": "6",
      "created_at": "2016-01-19 06:01:16",
      "updated_at": "2016-01-19 06:01:16",
      "is_completed": 0,
      "video": null,
      "exercise": {
      "id": "57",
      "name": "Knee Raises",
      "description": "Develop grip and core strength and get used to slow and controlled moves."
      }
      },
      {
      "id": "474",
      "workout_id": "12",
      "category": "1",
      "repititions": "15",
      "exercise_id": "36",
      "unit": "times",
      "round": "6",
      "created_at": "2016-01-19 06:01:40",
      "updated_at": "2016-01-19 06:01:40",
      "is_completed": 0,
      "video": {
      "id": "33",
      "path": "36_1453099391.mp4",
      "videothumbnail": "36_1453099391.png",
      "description": ""
      },
      "exercise": {
      "id": "36",
      "name": "High Jumps",
      "description": "Do high jumps as a part of restless HIIT workouts"
      }
      }
      ],
      "round7": [
      {
      "id": "451",
      "workout_id": "12",
      "category": "1",
      "repititions": "10",
      "exercise_id": "9",
      "unit": "times",
      "round": "1",
      "created_at": "2016-01-19 06:00:30",
      "updated_at": "2016-01-19 06:00:30",
      "is_completed": 0,
      "video": {
      "id": "9",
      "path": "9_1453038416.mp4",
      "videothumbnail": "9_1453038416.png",
      "description": ""
      },
      "exercise": {
      "id": "9",
      "name": "Crunches",
      "description": "Do the most admired sixpack exercise in the world"
      }
      },
      {
      "id": "457",
      "workout_id": "12",
      "category": "1",
      "repititions": "25",
      "exercise_id": "32",
      "unit": "times",
      "round": "1",
      "created_at": "2016-01-19 06:00:57",
      "updated_at": "2016-01-19 06:00:57",
      "is_completed": 0,
      "video": {
      "id": "29",
      "path": "32_1453099099.mp4",
      "videothumbnail": "32_1453099099.png",
      "description": ""
      },
      "exercise": {
      "id": "32",
      "name": "Sprawl",
      "description": "Boost your cardio and strength with sprawls"
      }
      },
      {
      "id": "463",
      "workout_id": "12",
      "category": "1",
      "repititions": "25",
      "exercise_id": "57",
      "unit": "times",
      "round": "1",
      "created_at": "2016-01-19 06:01:16",
      "updated_at": "2016-01-19 06:01:16",
      "is_completed": 0,
      "video": null,
      "exercise": {
      "id": "57",
      "name": "Knee Raises",
      "description": "Develop grip and core strength and get used to slow and controlled moves."
      }
      },
      {
      "id": "469",
      "workout_id": "12",
      "category": "1",
      "repititions": "15",
      "exercise_id": "36",
      "unit": "times",
      "round": "1",
      "created_at": "2016-01-19 06:01:40",
      "updated_at": "2016-01-19 06:01:40",
      "is_completed": 0,
      "video": {
      "id": "33",
      "path": "36_1453099391.mp4",
      "videothumbnail": "36_1453099391.png",
      "description": ""
      },
      "exercise": {
      "id": "36",
      "name": "High Jumps",
      "description": "Do high jumps as a part of restless HIIT workouts"
      }
      }
      ]
      }
      },
      "coach_workout_rounds": 7,
      "workout_intensity": 2,
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
      "id": "1",
      "row": "1",
      "exercise_id": "69",
      "duration": {
      "min": "15",
      "max": ""
      },
      "unit": "times",
      "is_completed": "0",
      "created_at": "2016-01-22 04:12:38",
      "updated_at": "2016-01-22 04:12:38",
      "exercise": {
      "id": "69",
      "name": "Jumping Pullups",
      "description": "Expose yourself to packed shoulders and hang time.",
      "category": "1",
      "type": "1",
      "muscle_groups": "",
      "rewards": "6.00",
      "repititions": "10",
      "duration": "10",
      "unit": "times",
      "equipment": "",
      "range_of_motion": "\"1. Grip a bar and jump into the top position of the pull-up exercise\r\n2. Straight legs in front of you. \r\n3. Slowly go down into a deadhang position\"\r\n",
      "video_tips": "",
      "pro_tips": "\"A deadhang postion requires your shoulder blades down or towards the spine with arms being straight (retraction)\r\nAim for three second holds at the top and go down slowly\"\r\n",
      "video": []
      }
      },
      {
      "id": "2",
      "row": "1",
      "exercise_id": "19",
      "duration": {
      "min": "20",
      "max": ""
      },
      "unit": "times",
      "is_completed": "0",
      "created_at": "2016-01-22 04:26:56",
      "updated_at": "2016-01-22 04:26:56",
      "exercise": {
      "id": "19",
      "name": "Military Press",
      "description": "Your “go to” exercise while working your way up to the Handstand Push-Up.",
      "category": "1",
      "type": "1",
      "muscle_groups": "1,3",
      "rewards": "6.00",
      "repititions": "10",
      "duration": "10",
      "unit": "times",
      "equipment": "",
      "range_of_motion": "\"1. Put your hands in front of you and stand on your toes\r\n2. Arms and back to form one line\r\n3. Bring body down and engage should muscles\r\n4. Press back up to starting position\"\r\n",
      "video_tips": "",
      "pro_tips": "Try a straddle stance for an easier variation if you are not that flexible yet.\r\n",
      "video": [
      {
      "id": "17",
      "path": "19_1453096645.mp4",
      "videothumbnail": "19_1453096645.png",
      "description": ""
      }
      ]
      }
      },
      {
      "id": "3",
      "row": "1",
      "exercise_id": "49",
      "duration": {
      "min": "40",
      "max": ""
      },
      "unit": "seconds",
      "is_completed": "0",
      "created_at": "2016-01-22 04:27:47",
      "updated_at": "2016-01-22 04:27:47",
      "exercise": {
      "id": "49",
      "name": "Side Trizeps",
      "description": "Start with the basics of building triceps strength.",
      "category": "1",
      "type": "1",
      "muscle_groups": "",
      "rewards": "6.00",
      "repititions": "10",
      "duration": "10",
      "unit": "seconds",
      "equipment": "",
      "range_of_motion": "\"1. Start with the body on your side\r\n2. Put one hand on your shoulder \r\n3. Press up with the other arm and hold in extension\"\r\n",
      "video_tips": "",
      "pro_tips": "",
      "video": [
      {
      "id": "43",
      "path": "49_1453107322.mp4",
      "videothumbnail": "49_1453107322.png",
      "description": ""
      }
      ]
      }
      },
      {
      "id": "4",
      "row": "1",
      "exercise_id": "9",
      "duration": {
      "min": "40",
      "max": ""
      },
      "unit": "times",
      "is_completed": "0",
      "created_at": "2016-01-22 04:28:23",
      "updated_at": "2016-01-22 04:28:23",
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
      "range_of_motion": "\"1. Starting position is with lying face up on the floor with knees bent. \r\n2. Move torso up and touch your knees with your hands\r\n3. Lower body to the floor and repeat\"\r\n",
      "video_tips": "",
      "pro_tips": "Try with weights on your chest as you progress.\r\n",
      "video": [
      {
      "id": "9",
      "path": "9_1453038416.mp4",
      "videothumbnail": "9_1453038416.png",
      "description": ""
      }
      ]
      }
      },
      {
      "id": "5",
      "row": "1",
      "exercise_id": "46",
      "duration": {
      "min": "60",
      "max": "90"
      },
      "unit": "times",
      "is_completed": "0",
      "created_at": "2016-01-22 04:29:13",
      "updated_at": "2016-01-22 04:29:13",
      "exercise": {
      "id": "46",
      "name": "Wall Sits",
      "description": "Hold the static position to build isometric strength.",
      "category": "1",
      "type": "1",
      "muscle_groups": "7,8",
      "rewards": "6.00",
      "repititions": "10",
      "duration": "10",
      "unit": "times",
      "equipment": "",
      "range_of_motion": "\"1. Start with standing close to a wall\r\n2. Go down in a squat with your back pressed against the wall \r\n3. Stay in a 90 angle with your squat\"\r\n",
      "video_tips": "",
      "pro_tips": "",
      "video": [
      {
      "id": "42",
      "path": "46_1453102438.mp4",
      "videothumbnail": "46_1453102438.png",
      "description": ""
      }
      ]
      }
      }
      ],
      "exercises": [],
      "workout": {
      "id": "25",
      "name": "Jord",
      "description": "",
      "rounds": "4",
      "category": "2",
      "type": "1",
      "rewards": "330",
      "duration": "720.00",
      "equipments": "",
      "is_completed": 0,
      "exercises": {
      "round1": [
      {
      "id": "1054",
      "workout_id": "25",
      "category": "1",
      "repititions": "50",
      "exercise_id": "39",
      "unit": "times",
      "round": "1",
      "created_at": "2016-01-19 23:56:39",
      "updated_at": "2016-01-19 23:56:39",
      "is_completed": 0,
      "video": null,
      "exercise": {
      "id": "39",
      "name": "Climbers",
      "description": "Increase your energy, health and endurance."
      }
      },
      {
      "id": "1058",
      "workout_id": "25",
      "category": "1",
      "repititions": "180",
      "exercise_id": "4",
      "unit": "seconds",
      "round": "1",
      "created_at": "2016-01-19 23:56:56",
      "updated_at": "2016-01-19 23:56:56",
      "is_completed": 0,
      "video": {
      "id": "4",
      "path": "4_1453036787.mp4",
      "videothumbnail": "4_1453036787.png",
      "description": ""
      },
      "exercise": {
      "id": "4",
      "name": "Plank",
      "description": "The plank builds your isometric strength and helps sculpt your waistline."
      }
      },
      {
      "id": "1066",
      "workout_id": "25",
      "category": "1",
      "repititions": "25",
      "exercise_id": "36",
      "unit": "times",
      "round": "1",
      "created_at": "2016-01-19 23:57:29",
      "updated_at": "2016-01-19 23:57:29",
      "is_completed": 0,
      "video": {
      "id": "33",
      "path": "36_1453099391.mp4",
      "videothumbnail": "36_1453099391.png",
      "description": ""
      },
      "exercise": {
      "id": "36",
      "name": "High Jumps",
      "description": "Do high jumps as a part of restless HIIT workouts"
      }
      },
      {
      "id": "1074",
      "workout_id": "25",
      "category": "1",
      "repititions": "120",
      "exercise_id": "4",
      "unit": "seconds",
      "round": "1",
      "created_at": "2016-01-19 23:58:03",
      "updated_at": "2016-01-19 23:58:03",
      "is_completed": 0,
      "video": {
      "id": "4",
      "path": "4_1453036787.mp4",
      "videothumbnail": "4_1453036787.png",
      "description": ""
      },
      "exercise": {
      "id": "4",
      "name": "Plank",
      "description": "The plank builds your isometric strength and helps sculpt your waistline."
      }
      },
      {
      "id": "1078",
      "workout_id": "25",
      "category": "1",
      "repititions": "25",
      "exercise_id": "32",
      "unit": "times",
      "round": "1",
      "created_at": "2016-01-19 23:58:32",
      "updated_at": "2016-01-19 23:58:32",
      "is_completed": 0,
      "video": {
      "id": "29",
      "path": "32_1453099099.mp4",
      "videothumbnail": "32_1453099099.png",
      "description": ""
      },
      "exercise": {
      "id": "32",
      "name": "Sprawl",
      "description": "Boost your cardio and strength with sprawls"
      }
      },
      {
      "id": "1132",
      "workout_id": "25",
      "category": "1",
      "repititions": "30",
      "exercise_id": "79",
      "unit": "seconds",
      "round": "1",
      "created_at": "2016-01-20 00:05:10",
      "updated_at": "2016-01-20 00:05:10",
      "is_completed": 0,
      "video": null,
      "exercise": {
      "id": "79",
      "name": "Rest",
      "description": ""
      }
      }
      ],
      "round2": [
      {
      "id": "1055",
      "workout_id": "25",
      "category": "1",
      "repititions": "50",
      "exercise_id": "39",
      "unit": "times",
      "round": "2",
      "created_at": "2016-01-19 23:56:39",
      "updated_at": "2016-01-19 23:56:39",
      "is_completed": 0,
      "video": null,
      "exercise": {
      "id": "39",
      "name": "Climbers",
      "description": "Increase your energy, health and endurance."
      }
      },
      {
      "id": "1059",
      "workout_id": "25",
      "category": "1",
      "repititions": "180",
      "exercise_id": "4",
      "unit": "seconds",
      "round": "2",
      "created_at": "2016-01-19 23:56:56",
      "updated_at": "2016-01-19 23:56:56",
      "is_completed": 0,
      "video": {
      "id": "4",
      "path": "4_1453036787.mp4",
      "videothumbnail": "4_1453036787.png",
      "description": ""
      },
      "exercise": {
      "id": "4",
      "name": "Plank",
      "description": "The plank builds your isometric strength and helps sculpt your waistline."
      }
      },
      {
      "id": "1068",
      "workout_id": "25",
      "category": "1",
      "repititions": "25",
      "exercise_id": "36",
      "unit": "times",
      "round": "2",
      "created_at": "2016-01-19 23:57:29",
      "updated_at": "2016-01-19 23:57:29",
      "is_completed": 0,
      "video": {
      "id": "33",
      "path": "36_1453099391.mp4",
      "videothumbnail": "36_1453099391.png",
      "description": ""
      },
      "exercise": {
      "id": "36",
      "name": "High Jumps",
      "description": "Do high jumps as a part of restless HIIT workouts"
      }
      },
      {
      "id": "1075",
      "workout_id": "25",
      "category": "1",
      "repititions": "120",
      "exercise_id": "4",
      "unit": "seconds",
      "round": "2",
      "created_at": "2016-01-19 23:58:03",
      "updated_at": "2016-01-19 23:58:03",
      "is_completed": 0,
      "video": {
      "id": "4",
      "path": "4_1453036787.mp4",
      "videothumbnail": "4_1453036787.png",
      "description": ""
      },
      "exercise": {
      "id": "4",
      "name": "Plank",
      "description": "The plank builds your isometric strength and helps sculpt your waistline."
      }
      },
      {
      "id": "1079",
      "workout_id": "25",
      "category": "1",
      "repititions": "25",
      "exercise_id": "32",
      "unit": "times",
      "round": "2",
      "created_at": "2016-01-19 23:58:32",
      "updated_at": "2016-01-19 23:58:32",
      "is_completed": 0,
      "video": {
      "id": "29",
      "path": "32_1453099099.mp4",
      "videothumbnail": "32_1453099099.png",
      "description": ""
      },
      "exercise": {
      "id": "32",
      "name": "Sprawl",
      "description": "Boost your cardio and strength with sprawls"
      }
      },
      {
      "id": "1133",
      "workout_id": "25",
      "category": "1",
      "repititions": "30",
      "exercise_id": "79",
      "unit": "seconds",
      "round": "2",
      "created_at": "2016-01-20 00:05:10",
      "updated_at": "2016-01-20 00:05:10",
      "is_completed": 0,
      "video": null,
      "exercise": {
      "id": "79",
      "name": "Rest",
      "description": ""
      }
      }
      ],
      "round3": [
      {
      "id": "1056",
      "workout_id": "25",
      "category": "1",
      "repititions": "50",
      "exercise_id": "39",
      "unit": "times",
      "round": "3",
      "created_at": "2016-01-19 23:56:39",
      "updated_at": "2016-01-19 23:56:39",
      "is_completed": 0,
      "video": null,
      "exercise": {
      "id": "39",
      "name": "Climbers",
      "description": "Increase your energy, health and endurance."
      }
      },
      {
      "id": "1061",
      "workout_id": "25",
      "category": "1",
      "repititions": "180",
      "exercise_id": "4",
      "unit": "seconds",
      "round": "3",
      "created_at": "2016-01-19 23:56:56",
      "updated_at": "2016-01-19 23:56:56",
      "is_completed": 0,
      "video": {
      "id": "4",
      "path": "4_1453036787.mp4",
      "videothumbnail": "4_1453036787.png",
      "description": ""
      },
      "exercise": {
      "id": "4",
      "name": "Plank",
      "description": "The plank builds your isometric strength and helps sculpt your waistline."
      }
      },
      {
      "id": "1070",
      "workout_id": "25",
      "category": "1",
      "repititions": "25",
      "exercise_id": "36",
      "unit": "times",
      "round": "3",
      "created_at": "2016-01-19 23:57:29",
      "updated_at": "2016-01-19 23:57:29",
      "is_completed": 0,
      "video": {
      "id": "33",
      "path": "36_1453099391.mp4",
      "videothumbnail": "36_1453099391.png",
      "description": ""
      },
      "exercise": {
      "id": "36",
      "name": "High Jumps",
      "description": "Do high jumps as a part of restless HIIT workouts"
      }
      },
      {
      "id": "1076",
      "workout_id": "25",
      "category": "1",
      "repititions": "120",
      "exercise_id": "4",
      "unit": "seconds",
      "round": "3",
      "created_at": "2016-01-19 23:58:03",
      "updated_at": "2016-01-19 23:58:03",
      "is_completed": 0,
      "video": {
      "id": "4",
      "path": "4_1453036787.mp4",
      "videothumbnail": "4_1453036787.png",
      "description": ""
      },
      "exercise": {
      "id": "4",
      "name": "Plank",
      "description": "The plank builds your isometric strength and helps sculpt your waistline."
      }
      },
      {
      "id": "1080",
      "workout_id": "25",
      "category": "1",
      "repititions": "25",
      "exercise_id": "32",
      "unit": "times",
      "round": "3",
      "created_at": "2016-01-19 23:58:32",
      "updated_at": "2016-01-19 23:58:32",
      "is_completed": 0,
      "video": {
      "id": "29",
      "path": "32_1453099099.mp4",
      "videothumbnail": "32_1453099099.png",
      "description": ""
      },
      "exercise": {
      "id": "32",
      "name": "Sprawl",
      "description": "Boost your cardio and strength with sprawls"
      }
      },
      {
      "id": "1134",
      "workout_id": "25",
      "category": "1",
      "repititions": "30",
      "exercise_id": "79",
      "unit": "seconds",
      "round": "3",
      "created_at": "2016-01-20 00:05:10",
      "updated_at": "2016-01-20 00:05:10",
      "is_completed": 0,
      "video": null,
      "exercise": {
      "id": "79",
      "name": "Rest",
      "description": ""
      }
      }
      ],
      "round4": [
      {
      "id": "1057",
      "workout_id": "25",
      "category": "1",
      "repititions": "50",
      "exercise_id": "39",
      "unit": "times",
      "round": "4",
      "created_at": "2016-01-19 23:56:39",
      "updated_at": "2016-01-19 23:56:39",
      "is_completed": 0,
      "video": null,
      "exercise": {
      "id": "39",
      "name": "Climbers",
      "description": "Increase your energy, health and endurance."
      }
      },
      {
      "id": "1063",
      "workout_id": "25",
      "category": "1",
      "repititions": "180",
      "exercise_id": "4",
      "unit": "seconds",
      "round": "4",
      "created_at": "2016-01-19 23:56:56",
      "updated_at": "2016-01-19 23:56:56",
      "is_completed": 0,
      "video": {
      "id": "4",
      "path": "4_1453036787.mp4",
      "videothumbnail": "4_1453036787.png",
      "description": ""
      },
      "exercise": {
      "id": "4",
      "name": "Plank",
      "description": "The plank builds your isometric strength and helps sculpt your waistline."
      }
      },
      {
      "id": "1072",
      "workout_id": "25",
      "category": "1",
      "repititions": "25",
      "exercise_id": "36",
      "unit": "times",
      "round": "4",
      "created_at": "2016-01-19 23:57:30",
      "updated_at": "2016-01-19 23:57:30",
      "is_completed": 0,
      "video": {
      "id": "33",
      "path": "36_1453099391.mp4",
      "videothumbnail": "36_1453099391.png",
      "description": ""
      },
      "exercise": {
      "id": "36",
      "name": "High Jumps",
      "description": "Do high jumps as a part of restless HIIT workouts"
      }
      },
      {
      "id": "1077",
      "workout_id": "25",
      "category": "1",
      "repititions": "120",
      "exercise_id": "4",
      "unit": "seconds",
      "round": "4",
      "created_at": "2016-01-19 23:58:03",
      "updated_at": "2016-01-19 23:58:03",
      "is_completed": 0,
      "video": {
      "id": "4",
      "path": "4_1453036787.mp4",
      "videothumbnail": "4_1453036787.png",
      "description": ""
      },
      "exercise": {
      "id": "4",
      "name": "Plank",
      "description": "The plank builds your isometric strength and helps sculpt your waistline."
      }
      },
      {
      "id": "1081",
      "workout_id": "25",
      "category": "1",
      "repititions": "25",
      "exercise_id": "32",
      "unit": "times",
      "round": "4",
      "created_at": "2016-01-19 23:58:32",
      "updated_at": "2016-01-19 23:58:32",
      "is_completed": 0,
      "video": {
      "id": "29",
      "path": "32_1453099099.mp4",
      "videothumbnail": "32_1453099099.png",
      "description": ""
      },
      "exercise": {
      "id": "32",
      "name": "Sprawl",
      "description": "Boost your cardio and strength with sprawls"
      }
      }
      ]
      }
      },
      "coach_workout_rounds": 11,
      "workout_intensity": 1,
      "hiit": [
      {
      "id": 2,
      "intensity": 4,
      "is_completed": 0
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
      ]
      }
      },
      "category": "advanced",
      "muscle_groups": "7,3,6",
      "created_at": "2016-01-27 05:18:48",
      "updated_at": "2016-01-27 05:18:48",
      "description": "focus on core and lower back"
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
    public function updateCoach(Request $request)
    {
        if (!isset($request->user_id) || ($request->user_id == null)) {
            return response()->json(["status" => "0", "error" => "The user_id field is required"]);
        } elseif (!isset($request->assessment) || ($request->assessment == null)) {
            return response()->json(["status" => "0", "error" => "The assessment field is required"]);
        } else {
            $user = User::where('id', '=', $request->input('user_id'))->first();
            if (!is_null($user)) {

                $coach = Coach::where('user_id', $request->user_id)->first();

                $coachStatus = DB::table('coach_status')
                    ->where('user_id', $request->user_id)
                    ->where('coach_id', $coach->id)
                    ->first();

                for ($i = 1; $i <= $coach->days; $i++) {
                    $statusArray[$i] = 0;
                }

                $weekStatusArray = json_decode($coach->week_status, TRUE);

                $weekStatusArray[$coachStatus->week + 1] = 0;

                DB::table('coach_status')
                    ->where('user_id', $request->user_id)
                    ->where('coach_id', $coach->id)
                    ->update([
                        'day_status' => json_encode($statusArray),
                        'week_status' => json_encode($weekStatusArray),
                        'need_update' => 0,
                        'day' => 1,
                        'week' => $coachStatus->week + 1
                ]);

                $exercises = Coach::updateCoach(json_decode($coach->exercises, true), $request->assessment, $coach->id);

                Coach::where('user_id', $request->user_id)->update([
                    'exercises' => json_encode($exercises)
                ]);

                $coach = Coach::where('user_id', $request->user_id)->first();

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
