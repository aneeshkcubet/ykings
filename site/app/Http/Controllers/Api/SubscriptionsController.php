<?php namespace App\Http\Controllers\Api;

use Auth,
    Validator;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\User;
use App\Plan;
use App\Subscription;

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
     * Create a new authentication controller instance.
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
     * @apiSuccess {String} success.
     * @apiSuccessExample Success-Response:
     *HTTP/1.1 200 OK
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
                
                Subscription::create([
                    'user_id' => $data['user_id'],
                    'amount' => $data['amount'],
                    'currency' => $data['currency'],
                    'process_time' => strtotime($data['process_time']),
                    'transaction_id' => $data['transaction_id'],
                    'plan_id' => $planId->id,
                    'status' => $data['status'],
                    'start_time' => time($data['process_time']),
                    'end_time' => strtotime("+".$data['months']." month", time($data['process_time']))
                ]);

                return response()->json(['status' => 1, 'message' => 'Subscription Updated'], 200);
            } else {
                return response()->json(['status' => 0, 'error' => 'user_not_exists'], 500);
            }
        }
    }
   
}
