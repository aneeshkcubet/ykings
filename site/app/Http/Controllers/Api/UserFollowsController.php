<?php namespace App\Http\Controllers\Api;

use Auth;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Exceptions\InvalidConfirmationCodeException;
use App\Follow;
use App\User;

class UserFollowsController extends Controller
{
    /*
      |--------------------------------------------------------------------------
      | User Actions Controller
      |--------------------------------------------------------------------------
      |
      | This controller handles the registration of new users, as well as the
      | authentication of existing users. Why don't you explore it?
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
     * @api {post} /follow/add followUser
     * @apiName followUser
     * @apiGroup Follow
     * @apiParam {integer} follower_id id of follower user  *required
     * @apiParam {integer} following_id id of following user *required
     *
     * @apiSuccess {String} success.
     *
     * @apiSuccessExample Success-Response:
     * HTTP/1.1 200 OK
      {
          "status": 1,
          "success": "successfully_followed"          
      }
     *
     * @apiError error Message token_invalid.
     * @apiError error Message token_expired.
     * @apiError error Message token_not_provided.
     * @apiError error Message follower_user_does_not_exists.
     * @apiError error Message following_user_does_not_exists.
     * @apiError error Message validation_errors.
     * @apiError error Message validation_errors.
     * @apiError error Message follower_user_not_verified_email.
     * @apiError error Message following_user_not_verified_email.
     * @apiError error Message you_are_already_followed
     * @apiError error Message could_not_able_to_follow
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
     *       "status": 0,
     *       "error": "token_expired"
     *     }
     * 
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 400 Bad Request
     *     {
     *       "status": 0,
     *       "error": "token_not_provided"
     *     }
     * 
     * 
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 422 validation_errors
     *     {
     *       "status": 0,
     *       "error":  "The follower_id field is required."        
     *     }
     * 
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 422 validation_errors
     *     {
     *       "status": 0,
     *       "error":  "The following_id field is required."        
     *     } 
     * 
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 422 follower_user_does_not_exists
     *     {
     *           "status": 0,
     *           "error": "follower_user_does_not_exists"
     *     } 
     *
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 422 following_user_does_not_exists
     *     {
     *           "status": 0,
     *           "error": "following_user_does_not_exists"
     *     }  
     * 
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 422 follower_user_not_verified_email
     *     {
     *           "status": 0,
     *           "error": "follower_user_not_verified_email"
     *     }
     *   
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 422 following_user_not_verified_email
     *     {
     *           "status": 0,
     *           "error": "following_user_not_verified_email"
     *     }
     * 
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 422 you_are_already_followed
     *     {
     *           "status": 0,
     *           "error": "you_are_already_followed"
     *     } 
     * 
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 422 could_not_able_to_follow
     *     {
     *           "status": 0,
     *           "error": "could_not_able_to_follow"
     *     }
     *    
     */
    public function follow(Request $request)
    {
        $data = $request->all();

        if (!isset($data['follower_id'])) {
            return response()->json(['status' => 0, 'error' => 'follower_id field is required'], 422);
        }

        if (!isset($data['following_id'])) {
            return response()->json(['status' => 0, 'error' => 'following_id field is required'], 422);
        }

        $follower = User::where('id', '=', $data['follower_id'])->first();

        $following = User::where('id', '=', $data['following_id'])->first();

        if (is_null($follower)) {
            return response()->json(['status' => 0, 'error' => 'follower_user_does_not_exists'], 422);
        } else {
            if ($follower->status == 0) {
                return response()->json(['status' => 0, 'error' => 'follower_user_not_verified_email'], 422);
            }
        }

        if (is_null($following)) {
            return response()->json(['status' => 0, 'error' => 'following_user_does_not_exists'], 422);
        } else {
            if ($following->status == 0) {
                return response()->json(['status' => 0, 'error' => 'following_user_not_verified_email'], 422);
            }

            $alreadyFollwed = Follow::where('user_id', '=', $follower->id)->where('follow_id', '=', $following->id)->first();

            if (!is_null($alreadyFollwed)) {
                return response()->json(['status' => 0, 'error' => 'you_are_already_followed'], 422);
            }

            $follow = Follow::create([
                    'user_id' => $follower->id,
                    'follow_id' => $following->id
            ]);

            if (!is_null($follow)) {
                $user = User::where('id', '=', $follower->id)
                        ->with(['profile', 'followers', 'followings'])->first();
                return response()->json(['status' => 1, 'success' => 'successfully_followed'], 200);
            } else {
                return response()->json(['status' => 0, 'error' => 'could_not_able_to_follow'], 500);
            }
        }
    }

    /**
     * @api {post} /follow/unfollow unfollowUser
     * @apiName unfollowUser
     * @apiGroup Follow
     * @apiParam {integer} follower_id id of follower user  *required
     * @apiParam {integer} following_id id of following user *required
     *
     * @apiSuccess {String} success.
     *
     * @apiSuccessExample Success-Response:
     * HTTP/1.1 200 OK
      {
          "status": 1,
          "success": "successfully_unfollowed"          
       }
     *
     * @apiError error Message token_invalid.
     * @apiError error Message token_expired.
     * @apiError error Message token_not_provided.
     * @apiError error Message follower_user_does_not_exists.
     * @apiError error Message following_user_does_not_exists.
     * @apiError error Message validation_errors.
     * @apiError error Message validation_errors.
     * @apiError error Message follower_user_not_verified_email.
     * @apiError error Message following_user_not_verified_email.
     * @apiError error Message you_are_already_unfollowed
     * @apiError error Message could_not_able_to_unfollow
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
     *     HTTP/1.1 422 follower_user_does_not_exists
     *     {
     *           "status": 0,
     *           "error": "follower_user_does_not_exists"
     *     }
     * 
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 422 following_user_does_not_exists
     *     {
     *           "status": 0,
     *           "error": "following_user_does_not_exists"
     *     }
     * 
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 422 validation_errors
     *     {
     *       "status": 0,
     *       "error":  "The follower_id field is required."        
     *     }
     * 
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 422 validation_errors
     *     {
     *       "status": 0,
     *       "error":  "The following_id field is required."        
     *     }
     *  
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 422 follower_user_does_not_exists
     *     {
     *           "status": 0,
     *           "error": "follower_user_does_not_exists"
     *     }
     * 
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 422 follower_user_not_verified_email
     *     {
     *           "status": 0,
     *           "error": "follower_user_not_verified_email"
     *     }
     *   
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 422 following_user_not_verified_email
     *     {
     *           "status": 0,
     *           "error": "following_user_not_verified_email"
     *     }
     * 
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 422 you_are_already_followed
     *     {
     *           "status": 0,
     *           "error": "you_are_already_unfollowed"
     *     } 
     * 
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 500 could_not_able_to_follow
     *     {
     *           "status": 0,
     *           "error": "could_not_able_to_unfollow"
     *     }
     *    
     */
    public function unFollow(Request $request)
    {
        $data = $request->all();

        $data = $request->all();

        if (!isset($data['follower_id'])) {
            return response()->json(['status' => 0, 'error' => 'follower_id field is required'], 422);
        }

        if (!isset($data['following_id'])) {
            return response()->json(['status' => 0, 'error' => 'following_id field is required'], 422);
        }

        $follower = User::where('id', '=', $data['follower_id'])->first();

        $following = User::where('id', '=', $data['following_id'])->first();

        if (is_null($follower)) {
            return response()->json(['status' => 0, 'error' => 'follower_user_does_not_exists'], 422);
        } else {
            if ($follower->status == 0) {
                return response()->json(['status' => 0, 'error' => 'follower_user_not_verified_email'], 422);
            }
        }

        if (is_null($following)) {
            return response()->json(['status' => 0, 'error' => 'following_user_does_not_exists'], 422);
        } else {
            if ($following->status == 0) {
                return response()->json(['status' => 0, 'error' => 'following_user_not_verified_email'], 422);
            }

            $alreadyFollwed = Follow::where('user_id', '=', $follower->id)->where('follow_id', '=', $following->id)->first();

            if (is_null($alreadyFollwed)) {
                return response()->json(['status' => 0, 'error' => 'you_are_already_unfollowed'], 422);
            }

            Follow::delete([
                'user_id' => $follower->id,
                'follow_id' => $following->id
            ]);

            $user = User::where('id', '=', $follower->id)
                    ->with(['profile', 'followers', 'followings'])->first();

            return response()->json(['status' => 1, 'success' => 'successfully_unfollowed', 'user' => $user->toArray(), 'urls' => config('urls.urls')], 200);


            return response()->json(['status' => 0, 'error' => 'could_not_able_to_follow'], 500);
        }
    }

    /**
     * @api {post} /follow/get getFollowers
     * @apiName getFollowers
     * @apiGroup Follow
     * @apiParam {integer} user_id id of targetting user  *required
     *
     * @apiSuccess {String} success.
     *
     * @apiSuccessExample Success-Response:
     * HTTP/1.1 200 OK
      {
          "status": 1,
          "success": "user_followers",
          "user": {
              "id": "2",
              "email": "aneeshk@cubettech.com",
              "confirmation_code": "",
              "status": "1",
              "created_at": "2015-11-12 08:44:54",
              "updated_at": "2015-11-12 08:44:54",
              "profile": {
                  "id": "2",
                  "user_id": "2",
                  "first_name": "Aneesh",
                  "last_name": "Kallikkattil",
                  "gender": "0",
                  "fitness_status": "3",
                  "goal": "3",
                  "image": "2_1447317902.jpg",
                  "city": "Kochi",
                  "state": "Kerala",
                  "country": "India",
                  "quote": "I need to get strong!!!!",
                  "created_at": "2015-11-12 08:45:02",
                  "updated_at": "2015-11-12 08:45:02"
               }
          "followers": [{
              "id": "1",
              "user_id": "3",
              "follow_id": "2",
              "created_at": "2015-11-12 09:34:27",
              "updated_at": "2015-11-12 15:05:55",
              "following_profile": {
                  "id": "3",
                  "email": "ykings1@yopmail.com",
                  "confirmation_code": "",
                  "status": "1",
                  "created_at": "2015-11-12 08:47:37",
                  "updated_at": "2015-11-12 08:47:37",
                  "profile": {
                      "id": "3",
                      "user_id": "3",
                      "first_name": "Ykings",
                      "last_name": "test1",
                      "gender": "0",
                      "fitness_status": "1",
                      "goal": "3",
                      "image": "3_1447318063.jpg",
                      "city": "Kochi",
                      "state": "Kerala",
                      "country": "India",
                      "quote": "I need to get strong!!!!",
                      "created_at": "2015-11-12 08:47:43",
                      "updated_at": "2015-11-12 08:47:43"
                  }
              }              
          }]
      },
      "urls": {
          "profileImageSmall": "http://sandbox.ykings.com/uploads/images/profile/small",
          "profileImageMedium": "http://sandbox.ykings.com/uploads/images/profile/medium",
          "profileImageLarge": "http://sandbox.ykings.com/uploads/images/profile/large",
          "profileImageOriginal": "http://sandbox.ykings.com/uploads/images/profile/original",
          "video": "http://sandbox.ykings.com/uploads/videos",
          "feedImageSmall": "http://sandbox.ykings.com/uploads/images/feed/small",
          "feedImageMedium": "http://sandbox.ykings.com/uploads/images/feed/medium",
          "feedImageLarge": "http://sandbox.ykings.com/uploads/images/feed/large",
          "feedImageOriginal": "http://sandbox.ykings.com/uploads/images/feed/original"
          }
      }
     * @apiError error Message token_invalid
     * @apiError error Message token_expired
     * @apiError error Message token_not_provided
     * @apiError error Message user_id_required
     * @apiError error Message invalid_user_id
     * @apiError error Message user_does_not_exists
     * @apiError error Message user_not_verified_email
     * 
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
     *     HTTP/1.1 422 user_id_required
     *     {
     *           "status": 0,
     *           "error": "user_id_required"
     *     }
     * 
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 422 invalid_user_id
     *     {
     *           "status": 0,
     *           "error": "invalid_user_id"
     *     } 
     * 
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 422 user_does_not_exists
     *     {
     *           "status": 0,
     *           "error": "user_does_not_exists"
     *     }
     * 
     *   
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 422 user_not_verified_email
     *     {
     *           "status": 0,
     *           "error": "user_not_verified_email"
     *     } 
     *    
     */
    public function getFollowers(Request $request)
    {
        $data = $request->all();


        if (!isset($data['user_id'])) {
            return response()->json(['status' => 0, 'error' => 'user_id_required'], 422);
        }

        if (!is_int((int) $data['user_id'])) {
            return response()->json(['status' => 0, 'error' => 'invalid_user_id'], 422);
        }

        $user = User::where('id', '=', $data['user_id'])
                ->with(['profile', 'followers'])->first();

        if (is_null($user)) {
            return response()->json(['status' => 0, 'error' => 'user_does_not_exists'], 422);
        }

        if ($user->status == 0) {
            return response()->json(['status' => 0, 'error' => 'user_not_verified_email'], 422);
        }

        return response()->json(['status' => 1, 'success' => 'user_followers', 'user' => $user->toArray(), 'urls' => config('urls.urls')], 200);
    }

    /**
     * @api {post} /follow/follows getFollowings
     * @apiName getFollowings
     * @apiGroup Follow
     *
     * @apiParam {integer} user_id id of targetting user  *required
     *
     * @apiSuccess {String} success.
     *
     * @apiSuccessExample Success-Response:
     * HTTP/1.1 200 OK
      {
      "status": 1,
      "success": "user_followings",
      "user": {
          "id": "2",
          "email": "aneeshk@cubettech.com",
          "confirmation_code": "",
          "status": "1",
          "created_at": "2015-11-12 08:44:54",
          "updated_at": "2015-11-12 08:44:54",
          "profile": {
                  "id": "2",
                  "user_id": "2",
                  "first_name": "Aneesh",
                  "last_name": "Kallikkattil",
                  "gender": "0",
                  "fitness_status": "3",
                  "goal": "3",
                  "image": "2_1447317902.jpg",
                  "city": "Kochi",
                  "state": "Kerala",
                  "country": "India",
                  "quote": "I need to get strong!!!!",
                  "created_at": "2015-11-12 08:45:02",
                  "updated_at": "2015-11-12 08:45:02"
              },
          "followers": [
                  {
                      "id": "1",
                      "user_id": "3",
                      "follow_id": "2",
                      "created_at": "2015-11-12 09:34:27",
                      "updated_at": "2015-11-12 15:05:55",
                      "following_profile": {
                      "id": "3",
                      "email": "ykings1@yopmail.com",
                      "confirmation_code": "",
                      "status": "1",
                      "created_at": "2015-11-12 08:47:37",
                      "updated_at": "2015-11-12 08:47:37",
                      "profile": {
                          "id": "3",
                          "user_id": "3",
                          "first_name": "Ykings",
                          "last_name": "test1",
                          "gender": "0",
                          "fitness_status": "1",
                          "goal": "3",
                          "image": "3_1447318063.jpg",
                          "city": "Kochi",
                          "state": "Kerala",
                          "country": "India",
                          "quote": "I need to get strong!!!!",
                          "created_at": "2015-11-12 08:47:43",
                          "updated_at": "2015-11-12 08:47:43"
                      }
                 }
              ]
          },
          "urls": {
              "profileImageSmall": "http://sandbox.ykings.com/uploads/images/profile/small",
              "profileImageMedium": "http://sandbox.ykings.com/uploads/images/profile/medium",
              "profileImageLarge": "http://sandbox.ykings.com/uploads/images/profile/large",
              "profileImageOriginal": "http://sandbox.ykings.com/uploads/images/profile/original",
              "video": "http://sandbox.ykings.com/uploads/videos",
              "feedImageSmall": "http://sandbox.ykings.com/uploads/images/feed/small",
              "feedImageMedium": "http://sandbox.ykings.com/uploads/images/feed/medium",
              "feedImageLarge": "http://sandbox.ykings.com/uploads/images/feed/large",
              "feedImageOriginal": "http://sandbox.ykings.com/uploads/images/feed/original"
           }      
      }
     *
     * @apiError error Message token_invalid
     * @apiError error Message token_expired
     * @apiError error Message token_not_provided
     * @apiError error Message user_id_required
     * @apiError error Message invalid_user_id
     * @apiError error Message user_does_not_exists
     * @apiError error Message user_not_verified_email
     * 
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
     *     HTTP/1.1 422 user_id_required
     *     {
     *           "status": 0,
     *           "error": "user_id_required"
     *     }
     * 
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 422 invalid_user_id
     *     {
     *           "status": 0,
     *           "error": "invalid_user_id"
     *     } 
     * 
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 422 user_does_not_exists
     *     {
     *           "status": 0,
     *           "error": "user_does_not_exists"
     *     }
     * 
     *   
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 422 user_not_verified_email
     *     {
     *           "status": 0,
     *           "error": "user_not_verified_email"
     *     } 
     *    
     */
    public function getMyFollowings(Request $request)
    {
        $data = $request->all();

        if (!isset($data['user_id'])) {
            return response()->json(['status' => 0, 'error' => 'user_id_required'], 422);
        }

        if (!is_int((int) $data['user_id'])) {
            return response()->json(['status' => 0, 'error' => 'invalid_user_id'], 422);
        }

        $user = User::where('id', '=', $data['user_id'])
                ->with(['profile', 'followings'])->first();

        if (is_null($user)) {
            return response()->json(['status' => 0, 'error' => 'user_does_not_exists'], 422);
        }

        if ($user->status == 0) {
            return response()->json(['status' => 0, 'error' => 'user_not_verified_email'], 422);
        }

        return response()->json(['status' => 1, 'success' => 'user_followings', 'user' => $user->toArray(), 'urls' => config('urls.urls')], 200);
    }
}
