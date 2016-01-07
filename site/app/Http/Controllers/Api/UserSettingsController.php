<?php namespace App\Http\Controllers\Api;

use Auth;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Settings;
use App\User;
use App\Profile;
use App\Social;
use App\PushNotification;

class UserSettingsController extends Controller
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
     * @api {post} /user/settings updateUserSettings
     * @apiName updateUserSettings
     * @apiGroup Settings
     * @apiParam {Number} user_id Id of user *required
     * @apiParam {String} settings_key notification/subscription *required
     * @apiParam {String} status json array of {"comments":"1","claps":"0","follow":"0","my_performance":"1","motivation_knowledge":"1"}
     * @apiSuccess {String} success.
     * 
     * @apiSuccessExample Success-Response:
     * HTTP/1.1 200 OK
     * {
      "status": 1,
      "success": "successfully_updated",
      "user": {
      "id": "41",
      "email": "arun@ileafsolutions.net",
      "confirmation_code": "",
      "status": "1",
      "created_at": "2015-11-16 09:54:09",
      "updated_at": "2015-11-16 11:02:47",
      "is_subscribed": 0,
      "settings": [
      {
      "id": "22",
      "user_id": "41",
      "key": "subscription",
      "value": "1",
      "created_at": "2015-12-03 04:22:37",
      "updated_at": "2015-12-03 06:24:07"
      },
      {
      "id": "23",
      "user_id": "41",
      "key": "notification",
      "value": "{\"comments\":\"1\",\"claps\":\"0\",\"follow\":\"0\",\"my_performance\":\"1\",\"motivation_knowledge\":\"1\"}",
      "created_at": "2015-12-03 04:22:37",
      "updated_at": "2015-12-03 06:13:52"
      }
      ]
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
     * 
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 400 Validation error
     *     {
     *       "status" : 0,
     *       "error": "The settings_key field is required"
     *     }
     * 
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 400 Validation error
     *     {
     *       "status" : 0,
     *       "error": "The status field is required."
     *     } 
     *  
     */
    public function userSettings(Request $request)
    {
        if (!isset($request->user_id) || ($request->user_id == null)) {
            return response()->json(["status" => "0", "error" => "The user_id field is required"]);
        } elseif (!isset($request->settings_key) || ($request->settings_key == null)) {
            return response()->json(["status" => "0", "error" => "The settings_key field is required"]);
        } elseif (!isset($request->status) || ($request->status == null)) {
            return response()->json(["status" => "0", "error" => "The status field is required."]);
        } else {
            $user = User::where('id', '=', $request->input('user_id'))->first();
            if ($user) {
                $userSettings = Settings::where('user_id', '=', $request->input('user_id'))
                    ->where('key', '=', $request->input('settings_key'))
                    ->first();
                if ($userSettings) {
                    $userSettings->value = $request->input('status');
                    $userSettings->update();
                } else {
                    $settings = new Settings(['user_id' => $request->input('user_id'),
                        'key' => $request->input('settings_key'), 'value' => $request->input('status')
                    ]);
                    $user->settings()->save($settings);
                }
                $user = User::where('id', '=', $request->input('user_id'))
                        ->with(['settings'])->first();

                return response()->json(['status' => 1, 'success' => 'successfully_updated', 'user' => $user->toArray()], 200);
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
      "id": "22",
      "user_id": "41",
      "key": "subscription",
      "value": 1,
      "created_at": "2015-12-03 04:22:37",
      "updated_at": "2015-12-03 04:28:18"
      },
      {
      "id": "23",
      "user_id": "41",
      "key": "notification",
      "value": {
      "comments": "1",
      "claps": "0",
      "follow": "0",
      "my_performance": "1",
      "motivation_knowledge": "1"
      },
      "created_at": "2015-12-03 04:22:37",
      "updated_at": "2015-12-03 06:13:52"
      }
      ],
      "facebook_connect": 0
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
                $is_facebook_connect = Social::isFacebookConnect($user->id);
                return response()->json(['status' => 1, 'settings' => $userSettings, 'facebook_connect' => $is_facebook_connect], 200);
            } else {
                return response()->json(['status' => 0, 'error' => 'user_not_exists'], 422);
            }
        }
    }

    /**
     * @api {post} /user/updateDeviceToken updateDeviceToken
     * @apiName updateDeviceToken
     * @apiGroup Settings
     * @apiParam {Number} user_id Id of user *required
     * @apiParam {String} device_token device_token of user *required
     * @apiParam {String} type device type (ios/android) *required
     * @apiSuccess {String} success.
     * 
     * @apiSuccessExample Success-Response:
     * HTTP/1.1 200 OK
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
    public function updateDeviceToken(Request $request)
    {
        if (!isset($request->user_id) || ($request->user_id == null)) {
            return response()->json(["status" => "0", "error" => "The user_id field is required"]);
        } else if (!isset($request->type) || ($request->type == null)) {
            return response()->json(["status" => "0", "error" => "The type field is required"]);
        } else if (!isset($request->device_token) || ($request->device_token == null)) {
            return response()->json(["status" => "0", "error" => "The device_token field is required"]);
        } else {
            $user = User::where('id', '=', $request->input('user_id'))->first();
            if ($user) {
                $userDeviceToken = PushNotification::where('user_id', '=', $request->input('user_id'))
                    ->where('type', '=', $request->type)
                    ->first();
                if (is_null($userDeviceToken)) {
                    $deviceToken = PushNotification::create(['user_id' => $request->input('user_id'),
                            'type' => $request->type,
                            'device_token' => $request->device_token
                    ]);
                   
                } else {
                    $userDeviceToken->device_token = $request->device_token;
                    $userDeviceToken->update();
                }
                return response()->json(['status' => 1, 'success' => 'Updated Successfully'], 200);
            } else {
                return response()->json(['status' => 0, 'error' => 'user_not_exists'], 422);
            }
        }
    }
}
