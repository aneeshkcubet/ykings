<?php namespace App\Http\Controllers\Api;

use Auth,
    Validator;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\User;
use App\Feeds;
use App\Comment;
use App\CommonFunctions\PushNotificationFunction;

class CommentsController extends Controller
{
    /*
      |--------------------------------------------------------------------------
      | Workout Controller
      |--------------------------------------------------------------------------
      |
      | This controller handles comments.
      |
     */

    /**
     * @api {post} /feeds/addComment addFeedComment
     * @apiName addFeedComment
     * @apiGroup Feeds
     * @apiParam {Number} user_id Id of user *required 
     * @apiParam {String} feed_id of the targetting item *required
     * @apiParam {String} text *required
     * 
     * @apiSuccess {String} success.
     * 
     * @apiSuccessExample Success-Response:
     * HTTP/1.1 200 OK
     * {
      "status": 1,
      "success": "commented_on_feed_successfully"

      }
     * 
     * @apiError error Message token_invalid.
     * @apiError error Message token_expired.
     * @apiError error Message token_not_provided.
     * @apiError error Validation error.
     * @apiError error Validation error.
     * @apiError error Validation error.
     * @apiError error user_does_not_exists.
     * @apiError error feed_does_not_exists.
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
     *       "error": "The user_id field is required"
     *     }
     * 
     * 
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 422 Validation error
     *     {
     *       "status" : 0,
     *       "error": "The feed_id field is required"
     *     }
     * 
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 422 Validation error
     *     {
     *       "status" : 0,
     *       "error": "The text field is required"
     *     }
     * 
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 500 user_does_not_exists
     *     {
     *       "status" : 0,
     *       "error": "user_does_not_exists"
     *     }
     * 
     * * @apiErrorExample Error-Response:
     *     HTTP/1.1 500 feed_does_not_exists
     *     {
     *       "status" : 0,
     *       "error": "feed_does_not_exists"
     *     }
     * 
     */
    public function addFeedComment(Request $request)
    {
        $data = $request->all();
        if (!isset($data['user_id'])) {
            return response()->json(["status" => "0", "error" => "The user_id field is required"]);
        } elseif (!isset($data['feed_id'])) {
            return response()->json(["status" => "0", "error" => "The feed_id field is required"]);
        } elseif (!isset($data['text'])) {
            return response()->json(["status" => "0", "error" => "The text field is required"]);
        } else {

            $user = User::where('id', '=', $request->input('user_id'))->first();

            $feed = Feeds::where('id', '=', $request->input('feed_id'))->with(['comments'])->first();

            if (is_null($user)) {
                return response()->json(['status' => 0, 'error' => 'user_does_not_exists'], 500);
            } elseif (is_null($feed)) {
                return response()->json(['status' => 0, 'error' => 'feed_does_not_exists'], 500);
            }

            $comment = Comment::create([
                    'user_id' => $data['user_id'],
                    'parent_type' => 'feed',
                    'parent_id' => $data['feed_id'],
                    'comment_text' => $request->text
            ]);
            //Push Notification
            $push = [
                'type' => 'comment',
                'type_id' => $data['feed_id'],
                'user_id' => $data['user_id'],
                'friend_id' => $feed->user_id
            ];
            PushNotificationFunction::pushNotification($push);
            return response()->json(['status' => 1, 'success' => 'commented_on_feed_successfully'], 200);
        }
    }

    /**
     * @api {post} /feeds/comments loadComments
     * @apiName loadComments
     * @apiGroup Feeds
     * @apiParam {Number} user_id Id of user *required
     * @apiParam {Number} feed_id feed_id *required
     * @apiParam {Number} [offset] offset 
     * @apiParam {Number} [limit] limit 
     * @apiSuccess {String} success.
     * @apiSuccessExample Success-Response:
     * HTTP/1.1 200 OK
      {
      "status": 1,
      "comments": [
      {
      "id": "1",
      "user_id": "14",
      "parent_type": "feed",
      "parent_id": "15",
      "comment_text": "This is a sample comment",
      "created_at": "2015-11-16 13:53:47",
      "updated_at": "2015-11-17 13:01:09",
      "profile": {
      "user_id": "14",
      "first_name": "sachii",
      "last_name": "k",
      "image": null
      }
      },
      {
      "id": "2",
      "user_id": "11",
      "parent_type": "feed",
      "parent_id": "15",
      "comment_text": "This is another comment",
      "created_at": "2015-11-16 13:55:14",
      "updated_at": "2015-11-17 13:02:38",
      "profile": {
      "user_id": "11",
      "first_name": "ansa",
      "last_name": "v",
      "image": "11_1447237788.jpg"
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
      }
      }
     * @apiError error Message token_invalid.
     * @apiError error Message token_expired.
     * @apiError user_not_exists User error.
     *
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 400 Invalid Request
     *     {
     *       "status":"0",
     *       "error": "token_invalid"
     *     }
     * 
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 401 Unauthorised
     *     {
     *       "status":"0",
     *       "error": "token_expired"
     *     }
     * 
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 400 Bad Request
     *     {
     *       "status":"0",
     *       "error": "token_not_provided"
     *     }
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 400 Bad Request
     *     {
     *       "status":"0",
     *       "error": "feed_not_exists"
     *     }
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
     *       "error": "The feed_id field is required"
     *     }
     * 
     */
    public function loadComments(Request $request)
    {
        if (!isset($request->user_id) || ($request->user_id == null)) {
            return response()->json(["status" => "0", "error" => "The user_id field is required"]);
        } else if (!isset($request->feed_id) || ($request->feed_id == null)) {
            return response()->json(["status" => "0", "error" => "The feed_id field is required"]);
        } else {
            $feed = Feeds::where('id', '=', $request->input('feed_id'))->first();
            if (!is_null($feed)) {
                $commentQuery = Comment::where('parent_id', '=', $request->input('feed_id'))
                    ->where('parent_type', 'feed')
                    ->with(['profile']);

                if ($request->offset != null && $request->limit != null) {
                    $commentQuery->skip($request->input('limit'));
                    $commentQuery->take($request->input('offset'));
                }

                $commentQuery->orderBy('created_at', 'DESC');
                $comments = $commentQuery->get();

                return response()->json(['status' => 1, 'comments' => $comments->toArray(), 'urls' => config('urls.urls')], 200);
            } else {
                return response()->json(['status' => 0, 'error' => 'feed_not_exists'], 422);
            }
        }
    }

    /**
     * @api {post} /feeds/deleteComment deleteComment
     * @apiName deleteComment
     * @apiGroup Feeds
     * @apiParam {Number} user_id Id of user *required
     * @apiParam {Number} comment_id feed_id *required
     * @apiSuccess {String} success.
     * @apiSuccessExample Success-Response:
     * HTTP/1.1 200 OK{
     *      "status": 1,
     *      "message" :comment deleted
     * }
     * 
     * @apiError error Message token_invalid.
     * @apiError error Message token_expired.
     *
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 400 Invalid Request
     *     {
     *       "status":"0",
     *       "error": "token_invalid"
     *     }
     * 
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 401 Unauthorised
     *     {
     *       "status":"0",
     *       "error": "token_expired"
     *     }
     * 
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 400 Bad Request
     *     {
     *       "status":"0",
     *       "error": "token_not_provided"
     *     }
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 400 Bad Request
     *     {
     *       "status":"0",
     *       "error": "comment_not_exists"
     *     }
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
     *       "error": "The comment_id field is required"
     *     }
     * 
     */
    public function deleteComment(Request $request)
    {
        if (!isset($request->user_id) || ($request->user_id == null)) {
            return response()->json(["status" => "0", "error" => "The user_id field is required"]);
        } else if (!isset($request->comment_id) || ($request->comment_id == null)) {
            return response()->json(["status" => "0", "error" => "The comment_id field is required"]);
        } else {
            $commentQuery = Comment::where('id', '=', $request->input('comment_id'))->first();
            if (!is_null($commentQuery)) {
                $commentQuery->delete();
                return response()->json(['status' => 1, 'message' => 'comment deleted'], 200);
            } else {
                return response()->json(['status' => 0, 'error' => 'comment_not_exists'], 422);
            }
        }
    }
}
