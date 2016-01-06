<?php namespace App\Http\Controllers\Api;

use Auth;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\User;
use App\Profile;
use App\Point;
use DB;
use App\Follow;

class SearchController extends Controller
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
     * @api {post} /search/searchUser searchUser
     * @apiName searchUser
     * @apiGroup Search
     * @apiParam {Number} user_id Id of user 
     * @apiParam {String} search_key search key
     * @apiSuccess {String} success.
     * 
     * @apiSuccessExample Success-Response:
     * HTTP/1.1 200 OK
     * {
      "status": 1,
      "success": "List",
      "search_result": [
      {
      "user_id": "11",
      "first_name": "ansaaaaa",
      "last_name": "",
      "image": "11_1447237788.jpg",
      "quote": "",
      "level": 1,
      "is_following": 0

      },
      {
      "user_id": "14",
      "first_name": "sachii",
      "last_name": "k",
      "image": null,
      "quote": "",
      "level": 1,
      "is_following": 0
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
      }
      }
     * 
     * @apiError error Message token_invalid.
     * @apiError error Message token_expired.
     * @apiError error Message token_not_provided.
     * @apiError error Validation error.
     * @apiError error Validation error.
     * @apiError error Validation error.
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
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 400 Validation error
     *     {
     *       "status" : 0,
     *       "error": "The search_key field is required."
     *     } 
     *  
     */
    public function userSearch(Request $request)
    {
        $searchResponse = array();
        if (!isset($request->user_id) || ($request->user_id == null)) {
            return response()->json(["status" => "0", "error" => "The user_id field is required"]);
        } elseif (!isset($request->search_key) || ($request->search_key == null)) {
            return response()->json(["status" => "0", "error" => "The search_key field is required"]);
        } else {
            $user = User::where('id', '=', $request->input('user_id'))->first();
            if (!is_null($user)) {
//                    $searchUsers = Profile::select('user_id', 'first_name', 'last_name', 'image', 'quote')
//                        ->whereRaw('(first_name LIKE "%' . $request->search_key . '%" OR last_name LIKE "%' . $request->search_key . '%") AND user_id != "' . $request->user_id . '"')
//                        ->get();

                $search = Profile::whereIn('user_id', function($query) use ($request) {
                        $query->select('id')
                            ->from('users')
                            ->where('status', 1);
                    });
                $search->whereRaw('(first_name LIKE "%' . $request->search_key . '%" OR last_name LIKE "%' . $request->search_key . '%") AND user_id != "' . $request->user_id . '"');
                $searchUsers = $search->get();

                if (!is_null($searchUsers)) {
                    foreach ($searchUsers as $usersList) {
                        $usersList['level'] = Point::userLevel($usersList->user_id);
                        $usersList['is_following'] = Follow::isFollowing($request->user_id, $usersList->user_id);
                        $searchResponse[] = $usersList;
                        unset($usersList);
                    }
                }
                return response()->json(['status' => 1, 'success' => 'List',
                        'search_result' => $searchResponse,
                        'urls' => config('urls.urls')], 200);
            } else {
                return response()->json(['status' => 0, 'error' => 'user_not_exists'], 422);
            }
        }
    }

    /**
     * @api {post} /user/getsettings getUserSettings
     * @apiName getUserSettings
     * @apiGroup Settings
     * @apiParam {Number} user_id Id of user *required
     * @apiSuccess {String} success.
     * 
     * @apiSuccessExample Success-Response:
     * HTTP/1.1 200 OK
     * {
      "status": 1,
      "settings": [
      {
      "id": "2",
      "user_id": "2",
      "key": "notification",
      "value": [
      {
      "comments": "1"
      },
      {
      "claps": "0"
      },
      {
      "follow": "0"
      },
      {
      "my_performance": "1"
      },
      {
      "motivation_knowledge": "1"
      }
      ],
      "created_at": "2015-11-20 00:00:00",
      "updated_at": "2015-11-20 06:33:00"
      },
      {
      "id": "3",
      "user_id": "2",
      "key": "subscription",
      "value": 1,
      "created_at": "2015-11-20 00:00:00",
      "updated_at": "2015-11-20 06:33:27"
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
    public function getUserSettings(Request $request)
    {
        if (!isset($request->user_id) || ($request->user_id == null)) {
            return response()->json(["status" => "0", "error" => "The user_id field is required"]);
        } else {

            $user = User::where('id', '=', $request->input('user_id'))->first();

            if ($user) {
                $userSettings = Settings::where('user_id', '=', $request->input('user_id'))->get();

                $userSettingsArray = $userSettings->toArray();

                foreach ($userSettings as $sKey => $userSetting) {
                    $userSetting->value = json_decode($userSetting->value, true);
                }
                return response()->json(['status' => 1, 'settings' => $userSettings], 200);
            } else {
                return response()->json(['status' => 0, 'error' => 'user_not_exists'], 422);
            }
        }
    }
}
