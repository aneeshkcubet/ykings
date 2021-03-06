<?php namespace App\Http\Controllers\Api;

use Auth,
    DB,
    Validator;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\User;
use App\Plan;
use App\Subscription;
use App\Coach;

class SubscriptionsController extends Controller
{
    /*
      |--------------------------------------------------------------------------
      | Subscriptions Controller
      |--------------------------------------------------------------------------
      |
      | This controller handles  user subscription.
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
     * @api {post} /subscription/update updateSubscription
     * @apiName updateSubscription
     * @apiGroup Subscription
     * @apiParam {Number} user_id Id of user *required
     * @apiParam {Number} amount amount of subscription *required
     * @apiParam {String} currency currency of payment *required
     * @apiParam {Date} process_time time payment processed in UTC *required
     * @apiParam {String} transaction_id id of payment transaction *required
     * @apiParam {String} [details] details of transaction device, os, version etc as json array
     * @apiParam {String} inapp_id id of subscription id created with Inapp *required
     * @apiParam {Number} months duration of subscription *required
     * @apiParam {Number} status status of payment  0-failure, 1-success *required
     * @apiParam {Number} [is_renew] transaction is renewal or not 1 - renew, 0 - new subscription
     * @apiSuccess {String} success.
     * @apiSuccessExample Success-Response:
     * HTTP/1.1 200 OK
      {
      "status": 1,
      "message": "Subscription Updated"
      }
     * 
     * @apiError error Message token_invalid.
     * @apiError error Message token_expired.
     * @apiError error Message token_not_provided.
     * @apiError error Message Validation error
     * @apiError error Message Validation error
     * @apiError error Message Validation error
     * @apiError error Message Validation error
     * @apiError error Message Validation error
     * @apiError error Message Validation error
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
     *     HTTP/1.1 422 Validation error
     *     {
     *       "status" : 0,
     *       "error": "The amount field is required"
     *     }
     * 
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 422 Validation error
     *     {
     *       "status" : 0,
     *       "error": "The currency field is required"
     *     }
     * 
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 422 Validation error
     *     {
     *       "status" : 0,
     *       "error": "The process_time field is required"
     *     }
     * 
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 422 Validation error
     *     {
     *       "status" : 0,
     *       "error": "The transaction_id field is required"
     *     }
     * 
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 422 Validation error
     *     {
     *       "status" : 0,
     *       "error": "The inapp_id field is required"
     *     }
     * 
     * 
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 422 Validation error
     *     {
     *       "status" : 0,
     *       "error": "The status field is required"
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
    public function updateSubscription(Request $request)
    {
        $data = $request->all();
        if (!isset($data['user_id'])) {
            return response()->json(["status" => "0", "error" => "The user_id field is required"]);
        } elseif (!isset($data['amount'])) {
            return response()->json(["status" => "0", "error" => "The amount field is required"]);
        } elseif (!isset($data['currency'])) {
            return response()->json(["status" => "0", "error" => "The currency field is required"]);
        } elseif (!isset($data['process_time'])) {
            return response()->json(["status" => "0", "error" => "The process_time field is required"]);
        } elseif (!isset($data['transaction_id'])) {
            return response()->json(["status" => "0", "error" => "The transaction_id field is required"]);
        } elseif (!isset($data['inapp_id'])) {
            return response()->json(["status" => "0", "error" => "The inapp_id field is required"]);
        } elseif (!isset($data['status'])) {
            return response()->json(["status" => "0", "error" => "The status field is required"]);
        } else {
            $user = User::where('id', '=', $request->input('user_id'))->first();
            if (!is_null($user)) {

                $planId = Plan::where('inapp_id', $data['inapp_id'])->first();

                if (isset($data['is_renew']) && $data['is_renew'] != 0 && $data['is_renew'] != '' && $data['is_renew'] != NULL && $data['is_renew'] != '(null)') {
                    $subscription = DB::table('subscriptions')
                        ->select('*')
                        ->where('user_id', '=', $data['user_id'])
                        ->orderBy('id', 'DESC')
                        ->first();
                    $subEndDate = gmdate("Y-m-d\TH:i:s\Z", $subscription->end_time);
                    Subscription::where('user_id', $data['user_id'])->update([
                        'amount' => $data['amount'],
                        'currency' => $data['currency'],
                        // 'process_time' => time(),
                        'transaction_id' => $data['transaction_id'],
                        'plan_id' => $planId->id,
                        'status' => $data['status'],
                        'start_time' => $subscription->end_time,
                        'end_time' => strtotime("+" . $data['months'] . " month", time($subEndDate))
                    ]);
                } else {
                    Subscription::create([
                        'user_id' => $data['user_id'],
                        'amount' => $data['amount'],
                        'currency' => $data['currency'],
                        'process_time' => strtotime($data['process_time']),
                        'transaction_id' => $data['transaction_id'],
                        'plan_id' => $planId->id,
                        'status' => $data['status'],
                        'start_time' => time($data['process_time']),
                        'end_time' => strtotime("+" . $data['months'] . " month", time($data['process_time']))
                    ]);
                }
//code modified by ansa@cubettech.co on 09-05-2016.$data['user_id']
                $coach = DB::table('coaches')->where('user_id', $data['user_id'])->first();

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
                        $coachDet = [
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
                            'urls' => config('urls.urls')];
                    } else {
                        if ($coachStatus->need_update == 1) {
                            $coachDet = [
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
                                'urls' => config('urls.urls')];
                        }

                        if ($coachStatus->need_update == 0) {
                            if ($dayStatus[$coachStatus->day] == 1) {
                                $coachUpdatedDate = date('Y-m-d', strtotime($coachStatus->updated_at));
                                $coachNextDay = strtotime($coachUpdatedDate . ' 00:00:01 + 1 days');
                                if ($coachNextDay > $currentTimestamp) {
                                    $coachDet = [
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
                                        'urls' => config('urls.urls')];
                                } else {
                                    $coachDet = [
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
                                        'urls' => config('urls.urls')];
                                }
                            } else {
                                $coachDet = [
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
                                    'urls' => config('urls.urls')];
                            }
                        }
                    }
                } else {
                    $coachDet = [
                        'status' => 1,
                        'message' => 'coach_not_found',
                        'coach_day' => 0,
                        'coach_week' => 0,
                        'is_subscribed' => $user->is_subscribed,
                        'need_update' => 0,
                        'coach' => [],
                        'urls' => config('urls.urls')];
                }

                return response()->json($coachDet, 200);
            } else {
                return response()->json(['status' => 0, 'error' => 'user_not_exists'], 500);
            }
        }
    }
}
