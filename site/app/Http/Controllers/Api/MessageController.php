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
      "type_id": "1",
      "message": "claped feed",
      "read": "0",
      "created_at": "2015-12-31 00:00:00",
      "updated_at": "2016-01-01 11:02:43",
      "image": "28_1448283791.jpg"
      },
      {
      "id": "2",
      "user_id": "41",
      "friend_id": "2",
      "message_type": "clap",
      "type_id": "1",
      "message": "claped feed",
      "read": "0",
      "created_at": "2015-12-31 00:00:00",
      "updated_at": "2016-01-01 11:02:45",
      "image": ""
      }
      ],
      "urls": {
      "profileImageSmall": "http://ykings.me/uploads/images/profile/small",
      "profileImageMedium": "http://ykings.me/uploads/images/profile/medium",
      "profileImageLarge": "http://ykings.me/uploads/images/profile/large",
      "profileImageOriginal": "http://ykings.me/uploads/images/profile/original",
      "video": "http://ykings.me/uploads/videos",
      "videothumbnail": "http://ykings.me/uploads/images/videothumbnails",
      "feedImageSmall": "http://ykings.me/uploads/images/feed/small",
      "feedImageMedium": "http://ykings.me/uploads/images/feed/medium",
      "feedImageLarge": "http://ykings.me/uploads/images/feed/large",
      "feedImageOriginal": "http://ykings.me/uploads/images/feed/original",
      "coverImageSmall": "http://ykings.me/uploads/images/cover_image/small",
      "coverImageMedium": "http://ykings.me/uploads/images/cover_image/medium",
      "coverImageLarge": "http://ykings.me/uploads/images/cover_image/large",
      "coverImageOriginal": "http://ykings.me/uploads/images/cover_image/original"
      }
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
                $notifications = Message::where('message.friend_id', '=', $request->input('user_id'))
                    ->join('user_profiles', 'user_profiles.user_id', '=', 'message.user_id')
                    ->select(array('message.*', 'user_profiles.image'))                    
                    ->orderBy('message.id', 'DESC')                    
                    ->get();
                return response()->json(['status' => 1, 'notifications' => $notifications, 'urls' => config('urls.urls')], 200);
            } else {
                return response()->json(['status' => 0, 'error' => 'user_not_exists'], 422);
            }
        }
    }

    /**
     * @api {post} /message/updateReadStatus updateReadStatus
     * @apiName updateReadStatus
     * @apiGroup Message
     * @apiParam {Number} user_id Id of user *required
     * @apiParam {Number} message_id message of user *required
     * @apiSuccess {String} success.
     * 
     * @apiSuccessExample Success-Response:
     * HTTP/1.1 200 OK
     *      {
                "status": 1,
                "success": "Successfully Updated"
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
     * @apiErrorExample Error-Response:
     *   HTTP/1.1 400 user_not_exists
     *    {
               "status": 0,
               "error": "message_not_exists"
           }
     */
    public function updateReadStatus(Request $request)
    {
        if (!isset($request->user_id) || ($request->user_id == null)) {
            return response()->json(["status" => "0", "error" => "The user_id field is required"]);
        } if (!isset($request->message_id) || ($request->message_id == null)) {
            return response()->json(["status" => "0", "error" => "The message_id field is required"]);
        } else {
            $user = User::where('id', '=', $request->input('user_id'))->first();
            if ($user) {
                $notification = Message::where('id', '=', $request->message_id)->first();
                if (!empty($notification)) {
                    Message::where('user_id', $notification->user_id)
                        ->where('friend_id', $notification->friend_id)
                        ->where('message_type', $notification->message_type)
                        ->where('type_id', $notification->type_id)
                        ->update(['read'=>1]);

                    return response()->json(['status' => 1, 'success' => 'Successfully Updated'], 200);
                } else {
                    return response()->json(['status' => 0, 'error' => 'message_not_exists'], 422);
                }
            } else {
                return response()->json(['status' => 0, 'error' => 'user_not_exists'], 422);
            }
        }
    }
}

?>