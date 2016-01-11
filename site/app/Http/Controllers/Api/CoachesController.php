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
                $coach = Coach::where('user_id', $request->user_id)->first();
                $coachStatus = DB::table('coach_status')->where('user_id', $request->user_id)->where('coach_id', $coach->id)->first();
                $currentTimestamp = time();

                $remainDays = 7 - $coach->days;

                //previous week completed
                if ($coachStatus->status == 1) {
                    if ($coachStatus->need_update == 1 && (strtotime($coachStatus->created_at . ' + ' . $coachStatus->week . ' weeks') <= $currentTimestamp)) {
                        return response()->json([
                                'status' => 1,
                                'coach_day' => $coachStatus->day,
                                'coach_week' => $coachStatus->week,
                                'is_subscribed' => $user->is_subscribed,
                                'need_update' => 1,
                                'coach' => [],
                                'urls' => config('urls.urls')], 200);
                    } elseif ($coachStatus->need_update == 1 && (strtotime($coachStatus->updated_at . ' + ' . $coachStatus->week . ' weeks') > $currentTimestamp)) {
                        return response()->json([
                                'status' => 1,
                                'message' => 'You have already completed this week workouts.',
                                'coach_day' => $coachStatus->day,
                                'coach_week' => $coachStatus->week,
                                'is_subscribed' => $user->is_subscribed,
                                'need_update' => 0,
                                'coach' => [],
                                'urls' => config('urls.urls')], 200);
                    } elseif ($coachStatus->need_update == 0 && (strtotime($coachStatus->created_at . ' + ' . $coachStatus->week . ' weeks') <= $currentTimestamp)) {
                        $coach->exercises = json_decode($coach->exercises, true);
                        return response()->json([
                                'status' => 1,
                                'coach_day' => $coachStatus->day,
                                'coach_week' => $coachStatus->week,
                                'is_subscribed' => $user->is_subscribed,
                                'need_update' => 1,
                                'coach' => [],
                                'urls' => config('urls.urls')], 200);
                    } elseif ($coachStatus->need_update == 0 && (strtotime($coachStatus->created_at . ' + ' . $coachStatus->week . ' weeks') > $currentTimestamp)) {
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
                    if ((strtotime($coachStatus->created_at . ' + ' . $coachStatus->week . ' weeks') <= $currentTimestamp)) {
                        $coach->exercises = json_decode($coach->exercises, true);
                        return response()->json([
                                'status' => 1,
                                'coach_day' => $coachStatus->day,
                                'coach_week' => $coachStatus->week,
                                'is_subscribed' => $user->is_subscribed,
                                'need_update' => 1,
                                'coach' => [],
                                'urls' => config('urls.urls')], 200);
                    } elseif ((strtotime($coachStatus->created_at . ' + ' . $coachStatus->week . ' weeks') > $currentTimestamp)) {
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
     * @apiParam {Number} user_id Id of user *required
     * @apiParam {Number} day Id of user *required
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
                    $data['status'] = 1;
                } else {
                    $data['status'] = 0;
                }

                DB::table('coach_status')
                    ->where('user_id', $request->user_id)
                    ->where('coach_id', $coach->id)
                    ->update($data);

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
     * @apiParam {Number} user_id Id of user *required
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
     * @apiParam {Number} user_id Id of user *required
     * @apiParam {Number} test1 status of test1 0-failed 1-passed *required
     * @apiParam {Number} test2 status of test2 0-failed 1-passed *required
     * @apiParam {Number} focus user focus 1-Lean, 2-Athletic, 3-Strength *required
     * @apiParam {Number} days number of workout days per week *required
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
  "coach": {
    "id": "1",
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
              "1": {
                "min": 7
              },
              "2": {
                "min": 10
              }
            },
            "unit": "times",
            "exercise": {
              "id": "4",
              "name": "Skin the cat",
              "description": "A good upper body stretching exercise, especially for achieving full range of motion in the shoulder. The skin the cat exercise is a fundamental movement performed on gymnastics rings.",
              "category": "1",
              "type": "2",
              "rewards": "6.00",
              "repititions": "10",
              "duration": "10",
              "unit": "times",
              "equipment": "",
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
              "1": {
                "min": 10
              },
              "2": {
                "min": 20
              }
            },
            "unit": "times",
            "exercise": {
              "id": "12",
              "name": "Incline Pushups",
              "description": "",
              "category": "1",
              "type": "1",
              "rewards": "6.00",
              "repititions": "10",
              "duration": "1",
              "unit": "times",
              "equipment": "",
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
              "1": {
                "min": 20
              },
              "2": {
                "min": 40
              }
            },
            "unit": "times",
            "exercise": {
              "id": "36",
              "name": "Dips (Bench)",
              "description": "",
              "category": "2",
              "type": "1",
              "rewards": "6.00",
              "repititions": "10",
              "duration": "1",
              "unit": "times",
              "equipment": "",
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
              "1": {
                "min": 10
              },
              "2": {
                "min": 15
              }
            },
            "unit": "times",
            "exercise": {
              "id": "3",
              "name": "Knee Raises",
              "description": "Standing Knee Raises (also known as standing knee crunches and standing knee pulls) is a functional abdominal exercise for boosting strength throughout the core. Unlike standard ab exercises, they don’t isolate abdominal muscles. Instead they work your upper abs and lower abs in conjunction with other important muscles such as hips, back and shoulders.",
              "category": "1",
              "type": "2",
              "rewards": "6.00",
              "repititions": "10",
              "duration": "1",
              "unit": "times",
              "equipment": "",
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
              "1": {
                "min": 10
              },
              "2": {
                "min": 20
              }
            },
            "unit": "times",
            "exercise": {
              "id": "8",
              "name": "Single Leg Deadlift",
              "description": "",
              "category": "1",
              "type": "2",
              "rewards": "6.00",
              "repititions": "10",
              "duration": "1",
              "unit": "times",
              "equipment": "",
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
          "rewards": "{\"lean\":330,\"athletic\":440,\"strength\":550}",
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
            "exercise_id": 4,
            "duration": {
              "1": {
                "min": 7
              },
              "2": {
                "min": 10
              }
            },
            "unit": "times",
            "exercise": {
              "id": "4",
              "name": "Skin the cat",
              "description": "A good upper body stretching exercise, especially for achieving full range of motion in the shoulder. The skin the cat exercise is a fundamental movement performed on gymnastics rings.",
              "category": "1",
              "type": "2",
              "rewards": "6.00",
              "repititions": "10",
              "duration": "10",
              "unit": "times",
              "equipment": "",
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
              "1": {
                "min": 10
              },
              "2": {
                "min": 20
              }
            },
            "unit": "times",
            "exercise": {
              "id": "12",
              "name": "Incline Pushups",
              "description": "",
              "category": "1",
              "type": "1",
              "rewards": "6.00",
              "repititions": "10",
              "duration": "1",
              "unit": "times",
              "equipment": "",
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
              "1": {
                "min": 20
              },
              "2": {
                "min": 40
              }
            },
            "unit": "times",
            "exercise": {
              "id": "36",
              "name": "Dips (Bench)",
              "description": "",
              "category": "2",
              "type": "1",
              "rewards": "6.00",
              "repititions": "10",
              "duration": "1",
              "unit": "times",
              "equipment": "",
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
              "1": {
                "min": 10
              },
              "2": {
                "min": 15
              }
            },
            "unit": "times",
            "exercise": {
              "id": "3",
              "name": "Knee Raises",
              "description": "Standing Knee Raises (also known as standing knee crunches and standing knee pulls) is a functional abdominal exercise for boosting strength throughout the core. Unlike standard ab exercises, they don’t isolate abdominal muscles. Instead they work your upper abs and lower abs in conjunction with other important muscles such as hips, back and shoulders.",
              "category": "1",
              "type": "2",
              "rewards": "6.00",
              "repititions": "10",
              "duration": "1",
              "unit": "times",
              "equipment": "",
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
              "1": {
                "min": 10
              },
              "2": {
                "min": 20
              }
            },
            "unit": "times",
            "exercise": {
              "id": "8",
              "name": "Single Leg Deadlift",
              "description": "",
              "category": "1",
              "type": "2",
              "rewards": "6.00",
              "repititions": "10",
              "duration": "1",
              "unit": "times",
              "equipment": "",
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
          "id": "4",
          "name": "Buri",
          "description": "Buri",
          "rounds": "1",
          "category": "1",
          "type": "2",
          "rewards": "{\"lean\":330,\"athletic\":440,\"strength\":550}",
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
        "workout_intensity": 1,
        "hiit": [
          2
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
    "created_at": "2016-01-11 12:53:11",
    "updated_at": "2016-01-11 12:53:12"
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
                    'need_update' => 0,
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
                        'need_update' => $coachStatus->need_update,
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
     * @apiParam {Number} assesment 1- I can do way more, 2 - I can do more, 3 - It was ok *required
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

                DB::table('coach_status')
                    ->where('user_id', $request->user_id)
                    ->where('coach_id', $coach->id)
                    ->update([
                        'status' => 0,
                        'need_update' => 0,
                        'day' => 1,
                        'week' => $coachStatus->week + 1
                ]);
                
                $exercises = Coach::updateCoach(json_decode($coach->exercises, true), $request->assessment);                
                
                Coach::where('user_id', $request->user_id)->update([
                    'exercises' => json_encode($exercises)
                ]);
                
                $coach = Coach::where('user_id', $request->user_id)->first();
                $coach->exercises = json_decode($coach->exercises, true);
                return response()->json([
                        'status' => 1,
                        'coach_day' => 1,
                        'coach_week' => $coachStatus->week + 1,
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
