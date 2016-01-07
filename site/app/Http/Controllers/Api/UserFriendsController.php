<?php namespace App\Http\Controllers\Api;

use Auth,
    Mail,
    Validator;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\User;
use App\Social;
use App\Follow;

class UserFriendsController extends Controller
{
    /*
      |--------------------------------------------------------------------------
      | Connect Controller
      |--------------------------------------------------------------------------
      |
      | This controller handles the registration and login from social media.
      |
     */

    /**
     * @api {post} /connect/connectFriends connectFriends
     * @apiName connectFriends
     * @apiGroup Connect
     * @apiDescription API for connecting facebook/phone book.
     * @apiParam {string} user_id User Id of user *required
     * @apiParam {string} friends_list email/facebook id ,json array *required  
     * @apiParam {string} type facebook/phonebook *required
     * @apiSuccess {String} success.
     * @apiSuccessExample Success-Response:
     * HTTP/1.1 200 OK
      type:phone

      {
      "status": 1,
      "registered_emails": [
      {
      "id": "14",
      "email": "sachin@cubettech.com",
      "confirmation_code": null,
      "status": "1",
      "created_at": "2015-11-11 06:23:56",
      "updated_at": "2015-11-11 06:23:56",
      "is_subscribed": 0,
      "is_following": 0,
      "profile": [
      {
      "id": "8",
      "user_id": "14",
      "first_name": "sachii",
      "last_name": "k",
      "gender": "0",
      "fitness_status": "0",
      "goal": "0",
      "image": null,
      "cover_image": "",
      "city": null,
      "state": null,
      "country": null,
      "spot": "",
      "quote": "",
      "created_at": "2015-11-11 06:23:56",
      "updated_at": "2015-11-11 06:23:56"
      }
      ]
      }
      ],
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
      },
      "type": "phone"
      }

      type:facebook
      {
      "status": 1,
      "registered_emails": [
      {
      "id": "3",
      "user_id": "15",
      "provider": "facebook",
      "provider_uid": "100789521",
      "access_token": "",
      "created_at": "2015-11-11 06:25:34",
      "updated_at": "2015-11-11 06:25:34",
      "email": "ansa@cubettech.com",
      "is_following": 0,
      "profile": {
      "id": "9",
      "user_id": "15",
      "first_name": "Dibu",
      "last_name": "k",
      "gender": "0",
      "fitness_status": "0",
      "goal": "0",
      "image": null,
      "cover_image": "",
      "city": null,
      "state": null,
      "country": null,
      "spot": "",
      "quote": "",
      "created_at": "2015-11-11 06:25:34",
      "updated_at": "2015-11-11 06:25:34"
      }
      }
      ],
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
      },
      "type": "facebook"
      }
     * @apiError error Message token_invalid.
     * @apiError error Message token_expired.
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 400 Invalid Request
     *     {
     *       "error": "token_invalid"
     *     }
     * 
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 401 Unauthorised
     *     {
     *       "error": "token_expired"
     *     }
     * 
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 400 Bad Request
     *     {
     *       "error": "token_not_provided"
     *     }
     * 
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 422 Validation error
     *     {
     *       "status" : 0,
     *       "error": "The user_id field is required"
     *     }
     *  @apiErrorExample Error-Response:
     *     HTTP/1.1 422 Validation error
     *     {
     *       "status" : 0,
     *       "error": "The email field is required"
     *     }
     *  @apiErrorExample Error-Response:
     *     HTTP/1.1 422 Validation error
     *     {
     *       "status" : 0,
     *       "error": "The type field is required"
     *     }
     */
    public function connectFriends(Request $request)
    {
        $registeredUsers = array();
        if (!isset($request->user_id) || ($request->user_id == null)) {
            return response()->json(["status" => "0", "error" => "The user_id field is required"]);
        } else if (!isset($request->type) || ($request->type == null)) {
            return response()->json(["status" => "0", "error" => "The Type field is required"]);
        } else if (!isset($request->friends_list) || (count(json_decode($request->friends_list)) == 0)) {
            return response()->json(["status" => "0", "error" => "The friends_list field is required"]);
        } else {
            $user = User::where('id', '=', $request->input('user_id'))->first();
            if ($user) {
                $friendsArray = json_decode($request->friends_list, true);
                foreach ($friendsArray as $friends) {
                    if ($request->type == 'phonebook') {
                        $emailExists = User::where('email', '=', $friends)
                            ->where('status', 1)
                            ->with(['profile'])
                            ->first();
                        if (!is_null($emailExists)) {
                            $emailExists['is_following'] = Follow::isFollowing($request->input('user_id'), $emailExists['id']);
                            $registeredUsers[] = $emailExists;
                        }
                    } else {
                        $facebookExists = Social::where('provider_uid', '=', $friends)->with(['profile'])->first();
                        if (!is_null($facebookExists)) {
                            $email = User::where('id', $facebookExists['user_id'])->select('email')->first();
                            $facebookExists['email'] = $email->email;
                            $facebookExists['is_following'] = Follow::isFollowing($request->input('user_id'), $facebookExists['user_id']);
                            $registeredUsers[] = $facebookExists;
                        }
                    }
                }

                return response()->json(['status' => 1, 'registered_emails' => $registeredUsers, 'urls' => config('urls.urls'), 'type' => $request->type], 200);
            } else {
                return response()->json(['status' => 0, 'error' => 'user_not_exists'], 422);
            }
        }
    }

    /**
     * @api {post} connect/inviteFriends inviteFriends
     * @apiName inviteFriends
     * @apiGroup Connect
     * @apiDescription API for inviteFriends.
     * @apiParam {string} user_id User Id of user *required
     * @apiParam {string} email Email Ids from contact,json array  *required
     * @apiSuccess {String} success.
     * @apiSuccessExample Success-Response:
     * HTTP/1.1 200 OK
      {
      "status": 1,
      "success": "Invitation sent"
      }
     * @apiError error Message token_invalid.
     * @apiError error Message token_expired.
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 400 Invalid Request
     *     {
     *       "error": "token_invalid"
     *     }
     * 
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 401 Unauthorised
     *     {
     *       "error": "token_expired"
     *     }
     * 
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 400 Bad Request
     *     {
     *       "error": "token_not_provided"
     *     }
     * 
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 422 Validation error
     *     {
     *       "status" : 0,
     *       "error": "The user_id field is required"
     *     }
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 422 Validation error
     *     {
     *       "status" : 0,
     *       "error": "The email field is required"
     *     }
     */
    public function inviteFriends(Request $request)
    {
        if (!isset($request->user_id) || ($request->user_id == null)) {
            return response()->json(["status" => "0", "error" => "The user_id field is required"]);
        } else if (!isset($request->email) || (count(json_decode($request->email)) == 0 )) {
            return response()->json(["status" => "0", "error" => "The email field is required"]);
        } else if (!isset($request->invitation_code) || ($request->invitation_code == null )) {
            return response()->json(["status" => "0", "error" => "The invitation code is required"]);
        } else {

            $user = User::where(['id' => $request->user_id])->with(['profile'])->first();
            if ($user) {
                $emailArray = json_decode($request->email, true);
                foreach ($emailArray as $email) {
                    $dataArray = array("first_name" => $user->profile[0]['first_name'],
                        "last_name" => $user->profile[0]['last_name'],
                        "email" => $email);
                    Mail::send('email.invite', ['code' => $request->invitation_code], function($message) use ($dataArray) {
                        $message->to($dataArray['email'], $dataArray['first_name'] . ' ' . $dataArray['last_name'])
                            ->subject('Invitation from Ykings');
                    });
                }
                return response()->json(['status' => 1, 'success' => 'Invitation sent'], 200);
            } else {
                return response()->json(['status' => 0, 'error' => 'user_not_exists'], 422);
            }
        }
    }
}
