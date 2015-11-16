<?php namespace App\Http\Controllers\Api;

use Auth,
    Validator;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\User;

class UserFriendsController extends Controller
{
    /*
      |--------------------------------------------------------------------------
      | Social Controller
      |--------------------------------------------------------------------------
      |
      | This controller handles the registration and login from social media.
      |
     */

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
                'first_name' => 'required|max:255',
                'last_name' => 'required|max:255',
                'email' => 'required|email|max:255',
                'provider_id' => 'required',
                'provider' => 'required',
        ]);
    }

    /**
     * @api {post} /connect/connectFriends
     * @apiName Connect Friends
     * @apiGroup Social
     * @apiDescription API for connecting facebook/phone book.
     * @apiParam {string} user_id User Id of user 
     * @apiParam {string} email Email Ids from contact,json array  
     * @apiParam {string} type facebook/phonebook   
     * @apiSuccess {String} success.
     * @apiSuccessExample Success-Response:
     * HTTP/1.1 200 OK
      {
        "status": 1,
        "registered_emails": [
            {
                "id": "11",
                "email": "ansa@cubettech.com",
                "confirmation_code": null,
                "status": "1",
                "created_at": "2015-11-09 12:40:07",
                "updated_at": "2015-11-09 12:40:07",
                "profile": [
                    {
                        "id": "7",
                        "user_id": "11",
                        "first_name": "ansa",
                        "last_name": "v",
                        "gender": "0",
                        "fitness_status": "0",
                        "goal": "0",
                        "image": "11_1447237788.jpg",
                        "city": null,
                        "state": null,
                        "country": null,
                        "quote": "",
                        "created_at": "2015-11-09 12:40:07",
                        "updated_at": "2015-11-12 09:05:16"
                    }
                ],
                "image": []
            },
            {
                "id": "15",
                "email": "dibin@cubettech.com",
                "confirmation_code": null,
                "status": "1",
                "created_at": "2015-11-11 06:25:34",
                "updated_at": "2015-11-11 06:25:34",
                "profile": [
                    {
                        "id": "9",
                        "user_id": "15",
                        "first_name": "Dibu",
                        "last_name": "k",
                        "gender": "0",
                        "fitness_status": "0",
                        "goal": "0",
                        "image": null,
                        "city": null,
                        "state": null,
                        "country": null,
                        "quote": "",
                        "created_at": "2015-11-11 06:25:34",
                        "updated_at": "2015-11-11 06:25:34"
                    }
                ],
                "image": []
            }
        ],
        "urls": {
            "profileImageSmall": "http://ykings.me/uploads/images/profile/small",
            "profileImageMedium": "http://ykings.me/uploads/images/profile/medium",
            "profileImageLarge": "http://ykings.me/uploads/images/profile/large",
            "profileImageOriginal": "http://ykings.me/uploads/images/profile/original",
            "video": "http://ykings.me/uploads/videos",
            "feedImageSmall": "http://ykings.me/uploads/images/feed/small",
            "feedImageMedium": "http://ykings.me/uploads/images/feed/medium",
            "feedImageLarge": "http://ykings.me/uploads/images/feed/large",
            "feedImageOriginal": "http://ykings.me/uploads/images/feed/original"
        },
        "type": "phonebook"
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
        $registeredEmail = array();
        if (!isset($request->user_id) || ($request->user_id == null)) {
            return response()->json(["status" => "0", "error" => "The user_id field is required"]);
        } else if (!isset($request->email) || (count(json_decode($request->email)) == 0 )) {
            return response()->json(["status" => "0", "error" => "The email field is required"]);
        } else if (!isset ($request->type) || ($request->type == null)) {
            return response()->json(["status" => "0", "error" => "The Type field is required"]);
        } else {
            $user = User::where('id', '=', $request->input('user_id'))->first();
            if ($user) {
                $emailArray = json_decode($request->email, true);
                foreach ($emailArray as $email) {
                    $emailExists = User::where('email', '=', $email)->with(['profile', 'image'])->first();
                    if (!is_null($emailExists)) {
                        $registeredEmail[] = $emailExists;
                    }
                }
                return response()->json(['status' => 1, 'registered_emails' => $registeredEmail, 'urls' => config('urls.urls'),'type'=>$request->type], 200);
            } else {
                return response()->json(['status' => 0, 'error' => 'user_not_exists'], 422);
            }
        }
    }
}
