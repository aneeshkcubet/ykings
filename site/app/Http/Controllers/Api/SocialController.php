<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use App\Profile;
use App\Social;
use Validator1,
    Validator;

class SocialController extends Controller {
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
    protected function validator(array $data) {
        return Validator::make($data, [
                    'first_name' => 'required|max:255',
                    'last_name' => 'required|max:255',
                    'email' => 'required|email|max:255',
                    'provider_id' => 'required',
                    'provider' => 'required',
        ]);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator1(array $data) {
        return Validator::make($data, [
                    'email' => 'required|email|max:255'
        ]);
    }

    /**
     * @api {post} /facebook facebookLogin
     * @apiName Facebook Login
     * @apiGroup Social
     *
     * @apiParam {string} first_name Firstname of user *required
     * @apiParam {string} last_name Firstname of user *required
     * @apiParam {string} email email address of user *required
     * @apiParam {string} id Facebook id of user *required

     *
     * @apiSuccess {String} success.
     *     HTTP/1.1 200 OK
     * {
      "success": "successfully_logged_in",
      "user": [
      {
      "id": "11",
      "email": "ansa@cubettech.com",
      "confirmation_code": null,
      "status": "0",
      "created_at": "2015-11-09 12:40:07",
      "updated_at": "2015-11-09 12:40:07",
      "profile": {
      "id": "7",
      "user_id": "11",
      "first_name": "ansa",
      "last_name": "v",
      "gender": "0",
      "fitness_status": "0",
      "goal": "0",
      "image": null,
      "city": null,
      "state": null,
      "country": null,
      "quote": "",
      "created_at": "2015-11-09 12:40:07",
      "updated_at": "2015-11-09 12:40:07"
      },
      "social": {
      "id": "2",
      "user_id": "11",
      "provider": "facebook",
      "provider_uid": "123456789",
      "created_at": "2015-11-09 12:40:07",
      "updated_at": "2015-11-09 12:40:07"
      }
      }
      ]
      }
     * @apiError error Message token_invalid.
     * @apiError error Message token_expired.
     * @apiError could_not_create_user User error.
     *
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
     *     HTTP/1.1 500 could_not_create_user
     *     {
     *       "error": "could_not_create_user"
     *     }
     */
    public function facebookLogin(Request $request) {
        $validator = $this->validator1($request->all());

        if ($validator->fails()) {
            return response()->json(['error' => $validator->messages()->toArray()], 422);
        }

        if ($this->create($request->all())) {
            $user = User::where('email', '=', $request->input('email'))
                            ->with(['profile'])
                            ->with(['social'])->get();
            return response()->json(['success' => 'successfully_logged_in', 'user' => $user->toArray()], 200);
        } else {
            return response()->json(['error' => 'could_not_create_user'], 500);
        }
    }

    /**
     * Function to insert user details 
     * @since 09/11/2015
     * @author ansa@cubettech.com
     * @return json
     */
    public function create(array $data) {
        $user_exist = User::where('email', '=', $data['email'])->first();
        if (!is_null($user_exist)) {
            return true;
        } else {
            //user table
            $user = User::create([
                        'email' => $data['email']]);
            //user profile table
            $profile = new Profile([
                'first_name' => isset($data['first_name']) ? $data['first_name'] : '',
                'last_name' => isset($data['last_name']) ? $data['last_name'] : '',
                'gender' => isset($data['gender']) ? $data['gender'] : '',
                'fitness_status' => isset($data['fitness_status']) ? $data['fitness_status'] : '',
                'goal' => isset($data['goal']) ? $data['goal'] : '',
                'quote' => isset($data['quote']) ? $data['quote'] : ''
            ]);
            $userProfile = $user->profile()->save($profile);
             //user social account table
            $social = new Social([
                'provider' => $data['provider'],
                'provider_uid' => $data['provider_id']
            ]);
            $socialAccount = $user->social()->save($social);

            $user = User::where('email', '=', $data['email'])->with(['profile'])->get();
            if (!is_null($user)) {
                return true;
            } else {
                return false;
            }
        }
    }

}
