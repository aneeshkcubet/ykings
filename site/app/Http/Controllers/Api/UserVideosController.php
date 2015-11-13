<?php namespace App\Http\Controllers\Api;

use Auth;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Exceptions\InvalidConfirmationCodeException;
use App\Uservideo;

class UserVideosController extends Controller
{
    /*
      |--------------------------------------------------------------------------
      | User Videos Controller
      |--------------------------------------------------------------------------
      |
      | This controller handles the video subscription of users.
      |
     */

    /**
     * Create a new videos controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('jwt.auth');
    }

    /**
     * @api {get} /user/videos GetUserVideos
     * @apiName GetUserVideos
     * @apiGroup User
     *
     * @apiParam {integer} id id of user *required
     *
     * @apiSuccess {String} success.
     *
     * @apiSuccessExample Success-Response:
     *     HTTP/1.1 200 OK
     *       {
     *           "status" : 1,
     *           "success": "user_videos",
     *           "videos": [
     *               {
     *                   "id": "2",
     *                   "user_id": "2",
     *                   "video_id": "1",
     *                   "created_at": "2015-11-11 11:40:05",
     *                   "updated_at": "2015-11-11 11:40:05",
     *                   "video": {
     *                       "id": "1",
     *                       "user_id": "1",
     *                       "path": "Now1.mp4",
     *                       "description": "Test Description",
     *                       "parent_type": "1",
     *                       "type": "1",
     *                       "parent_id": "1",
     *                       "created_at": "2015-11-11 07:26:40",
     *                       "updated_at": "2015-11-11 17:43:27"
     *                   },
     *                   "user": {
     *                       "id": "2",
     *                       "email": "aneeshk@ykings.com",
     *                       "confirmation_code": "d6grRYINWtcDH18bXc358M9ZDDFExd",
     *                       "status": "0",
     *                       "created_at": "2015-11-11 11:40:04",
     *                       "updated_at": "2015-11-11 11:40:04",
     *                       "profile": {
     *                           "id": "2",
     *                           "user_id": "2",
     *                           "first_name": "Aneesh",
     *                           "last_name": "Kallikkattil",
     *                           "gender": "0",
     *                           "fitness_status": "0",
     *                           "goal": "0",
     *                           "image": "2_1447242011.jpg",
     *                           "city": "",
     *                           "state": "",
     *                           "country": "",
     *                           "quote": "",
     *                           "created_at": "2015-11-11 11:40:10",
     *                           "updated_at": "2015-11-11 11:40:11"
     *                       }
     *                   }
     *               }
     *           ],
     *           "urls": {
     *               "profileImageSmall": "http://sandbox.ykings.com/uploads/images/profile/small",
     *               "profileImageMedium": "http://sandbox.ykings.com/uploads/images/profile/medium",
     *               "profileImageLarge": "http://sandbox.ykings.com/uploads/images/profile/large",
     *               "profileImageOriginal": "http://sandbox.ykings.com/uploads/images/profile/original",
     *               "video": "http://sandbox.ykings.com/uploads/videos",
     *               "feedImageSmall": "http://sandbox.ykings.com/uploads/images/feed/small",
     *               "feedImageMedium": "http://sandbox.ykings.com/uploads/images/feed/medium",
     *               "feedImageLarge": "http://sandbox.ykings.com/uploads/images/feed/large",
     *               "feedImageOriginal": "http://sandbox.ykings.com/uploads/images/feed/original"
     *           }
     *       }
     *
     * @apiError error Message token_invalid.
     * @apiError error Message token_expired.
     * @apiError error Message token_not_provided.
     * @apiError error Validation Error.
     * @apiError error no_videos.
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
     *     HTTP/1.1 422 Validation Error
     *     {
     *       "status" : 0,
     *       "error": "user_id required"
     *     }
     * 
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 500 no_videos
     *     {
     *       "status" : 0,
     *       "error": "no_videos"
     *     }
     * 
     */
    public function GetUserVideos(Request $request)
    {
        $data = $request->all();
        if (!isset($data['user_id'])) {
            return response()->json(['status' => 0, 'error' => 'user_id required'], 422);
        }

        // Authentication passed...
        $userVideos = Uservideo::where('user_id', '=', $userId)->with(['video', 'user'])->get();

        if (!is_null($userVideos)) {
            return response()->json(['status' => 1, 'success' => 'user_videos', 'videos' => $userVideos->toArray(), 'urls' => config('urls.urls')], 200);
        } else {
            return response()->json(['status' => 0, 'error' => 'no_videos'], 422);
        }
    }

    /**
     * @api {get} /user/video/delete deleteUserVideo
     * @apiName deleteUserVideo
     * @apiGroup User
     *
     * @apiParam {integer} user_id id of user *required
     * @apiParam {integer} video_id id of user video *required
     *
     * @apiSuccess {String} success.
     *
     * @apiSuccessExample Success-Response:
     *     HTTP/1.1 200 OK
     *       {
     *           "status" : 1,
     *           "success": "user_videos",
     *           "videos": [
     *               {
     *                   "id": "2",
     *                   "user_id": "2",
     *                   "video_id": "1",
     *                   "created_at": "2015-11-11 11:40:05",
     *                   "updated_at": "2015-11-11 11:40:05",
     *                   "video": {
     *                       "id": "1",
     *                       "user_id": "1",
     *                       "path": "Now1.mp4",
     *                       "description": "Test Description",
     *                       "parent_type": "1",
     *                       "type": "1",
     *                       "parent_id": "1",
     *                       "created_at": "2015-11-11 07:26:40",
     *                       "updated_at": "2015-11-11 17:43:27"
     *                   },
     *                   "user": {
     *                       "id": "2",
     *                       "email": "aneeshk@ykings.com",
     *                       "confirmation_code": "d6grRYINWtcDH18bXc358M9ZDDFExd",
     *                       "status": "0",
     *                       "created_at": "2015-11-11 11:40:04",
     *                       "updated_at": "2015-11-11 11:40:04",
     *                       "profile": {
     *                           "id": "2",
     *                           "user_id": "2",
     *                           "first_name": "Aneesh",
     *                           "last_name": "Kallikkattil",
     *                           "gender": "0",
     *                           "fitness_status": "0",
     *                           "goal": "0",
     *                           "image": "2_1447242011.jpg",
     *                           "city": "",
     *                           "state": "",
     *                           "country": "",
     *                           "quote": "",
     *                           "created_at": "2015-11-11 11:40:10",
     *                           "updated_at": "2015-11-11 11:40:11"
     *                       }
     *                   }
     *               }
     *           ],
     *           "urls": {
     *               "profileImageSmall": "http://sandbox.ykings.com/uploads/images/profile/small",
     *               "profileImageMedium": "http://sandbox.ykings.com/uploads/images/profile/medium",
     *               "profileImageLarge": "http://sandbox.ykings.com/uploads/images/profile/large",
     *               "profileImageOriginal": "http://sandbox.ykings.com/uploads/images/profile/original",
     *               "video": "http://sandbox.ykings.com/uploads/videos",
     *               "feedImageSmall": "http://sandbox.ykings.com/uploads/images/feed/small",
     *               "feedImageMedium": "http://sandbox.ykings.com/uploads/images/feed/medium",
     *               "feedImageLarge": "http://sandbox.ykings.com/uploads/images/feed/large",
     *               "feedImageOriginal": "http://sandbox.ykings.com/uploads/images/feed/original"
     *           }
     *       }
     *
     * @apiError error Message token_invalid.
     * @apiError error Message token_expired.
     * @apiError error Message token_not_provided.
     * @apiError error Validation error
     * @apiError error Validation error
     * @apiError error cannot_able_to_delete_this_video
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
     *     HTTP/1.1 422 Validation error
     *     {
     *       "status" : 0,
     *       "error": "user_id required"
     *     }
     * 
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 422 Validation error
     *     {
     *       "status" : 0,
     *       "error": "video_id_id required"
     *     }
     * 
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 500 cannot_able_to_delete_this_video
     *     {
     *       "status" : 0,
     *       "error": "cannot_able_to_delete_this_video"
     *     }
     * 
     */
    public function deleteUserVideo(Request $request)
    {
        $data = $request->all();
        if (!isset($data['user_id'])) {
            return response()->json(['status' => 0, 'error' => 'user_id required'], 422);
        }

        if (!isset($data['video_id'])) {
            return response()->json(['status' => 0, 'error' => 'video_id_id required'], 422);
        }

        if (Uservideo::where('user_id', '=', $userId)->where('id', '=', 'video_id')->delete()) {
            $userVideos = Uservideo::where('user_id', '=', $userId)->with(['video', 'user'])->get();

            if (!is_null($userVideos)) {
                return response()->json(['status' => 1, 'success' => 'successfully_deleted_video', 'videos' => $userVideos->toArray(), 'urls' => config('urls.urls')], 200);
            } else {
                return response()->json(['status' => 1, 'success' => 'no_videos', 'videos' => []], 200);
            }
        } else {
            return response()->json(['status' => 0, 'error' => 'cannot_able_to_delete_this_video'], 422);
        }
    }
}
