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
     * @apiParam {Number} user_id Id of user 
     * @apiParam {String} settings_key notification/subscription
     * @apiParam {String} status json array of [{"comments":"1"},{"claps":"0"},{"follow":"0"},{"my_performance":"1"},{"motivation_knowledge":"1"}]
     * @apiSuccess {String} success.
     * 
     * @apiSuccessExample Success-Response:
     *     HTTP/1.1 200 OK
     * {
     * "status" : 1,
      "success": "successfully_updated",
      "user": {
      "id": "1",
      "email": "admin@ykings.com",
      "confirmation_code": null,
      "status": "1",
      "created_at": "2015-11-06 12:14:48",
      "updated_at": "2015-11-06 12:15:04",
      "profile": {
      "id": "1",
      "user_id": "1",
      "first_name": "Ykings",
      "last_name": "Administrator",
      "gender": "0",
      "fitness_status": "0",
      "goal": "3",
      "image": null,
      "city": null,
      "state": null,
      "country": null,
      "quote": "I am Simple",
      "created_at": "2015-11-06 12:14:48",
      "updated_at": "2015-11-06 12:14:48"
      },
      "social": null,
      "settings": [
      {
      "id": "1",
      "user_id": "1",
      "key": "notification",
      "value": "1",
      "created_at": "2015-11-10 06:18:29",
      "updated_at": "2015-11-10 12:02:08"
      },
      {
      "id": "2",
      "user_id": "1",
      "key": "subscription",
      "value": "0",
      "created_at": "2015-11-10 06:32:20",
      "updated_at": "2015-11-10 12:10:43"
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
                        ->with(['profile', 'social', 'settings'])->first();
                
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
                
                foreach($userSettings as $sKey => $userSetting ){
                    $userSetting->value = json_decode($userSetting->value, true);
                }
                 $is_facebook_connect = Social::isFacebookConnect($user->id);
                return response()->json(['status' => 1, 'settings' => $userSettings,'facebook_connect'=>$is_facebook_connect], 200);
            } else {
                return response()->json(['status' => 0, 'error' => 'user_not_exists'], 422);
            }
        }
    }
}
