<?php namespace App\Http\Controllers\Api;

use Auth;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\User;
use App\Message;
class MessageController extends Controller
{

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
     * @api {post} /user/listNotifications ListNotifications
     * @apiName ListNotifications
     * @apiGroup Message
     * @apiParam {Number} user_id Id of user *required
     * @apiSuccess {String} success.
     * 
     * @apiSuccessExample Success-Response:
     * HTTP/1.1 200 OK
     * {
        "status": 1,
        "notifications": [
            {
                "id": "1",
                "user_id": "41",
                "friend_id": "28",
                "message_type": "clap",
                "message": "claped feed",
                "read": "0",
                "created_at": "2015-12-31 00:00:00",
                "updated_at": "2015-12-31 11:09:08"
            },
            {
                "id": "2",
                "user_id": "41",
                "friend_id": "2",
                "message_type": "clap",
                "message": "claped feed",
                "read": "0",
                "created_at": "2015-12-31 00:00:00",
                "updated_at": "2015-12-31 00:00:00"
            }
        ]
     }
     * 
     * @apiError error Message token_invalid.
     * @apiError error Message token_expired.
     * @apiError error Message token_not_provided.
     * @apiError error Validation error.
     * @apiError error user_not_exists
     *
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 400 Invalid Request
     *     {
     *       "status" : 0,
     *       "error": "token_invalid"
     *     }
     * 
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 401 Unauthorised
     *     {
     *       "status" : 0,
     *       "error": "token_expired"
     *     }
     * 
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 400 Bad Request
     *     {
     *       "status" : 0,
     *       "error": "token_not_provided"
     *     }
     * 
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 400 Validation error
     *     {
     *       "status" : 0,
     *       "error": "The user_id field is required"
     *     }
     * 
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 400 user_not_exists
     *     {
     *       "status" : 0,
     *       "error": "user_not_exists"
     *     }  
     *  
     */
    public function listNotifications(Request $request)
    {
        if (!isset($request->user_id) || ($request->user_id == null)) {
            return response()->json(["status" => "0", "error" => "The user_id field is required"]);
        } else {

            $user = User::where('id', '=', $request->input('user_id'))->first();
            if ($user) {
                $notifications = Message::where('user_id', '=', $request->input('user_id'))->get();
                return response()->json(['status' => 1, 'notifications' => $notifications], 200);
            } else {
                return response()->json(['status' => 0, 'error' => 'user_not_exists'], 422);
            }
        }
    }
}

?>