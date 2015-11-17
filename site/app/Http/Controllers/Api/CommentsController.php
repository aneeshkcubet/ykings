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

class CommentsController extends Controller
{
    /*
      |--------------------------------------------------------------------------
      | Workout Controller
      |--------------------------------------------------------------------------
      |
      | This controller handles feeds,workout,excersice.
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
      "success": "commented_on_feed_successfully",
      "feed": {
      "id": "6",
      "user_id": "2",
      "item_type": "excercise",
      "item_id": "1",
      "feed_text": "This is a sample feed text.",
      "created_at": "2015-11-16 11:55:34",
      "updated_at": "2015-11-16 11:55:34",
      "comment_count": 2,
      "clap_count": 0,
      "comments": [
      {
      "id": "2",
      "user_id": "2",
      "parent_type": "feed",
      "parent_id": "6",
      "comment_text": "This is another comment",
      "created_at": "2015-11-16 13:55:14",
      "updated_at": "2015-11-16 13:55:14"
      },
      {
      "id": "3",
      "user_id": "5",
      "parent_type": "feed",
      "parent_id": "6",
      "comment_text": "This is another comment",
      "created_at": "2015-11-16 13:55:40",
      "updated_at": "2015-11-16 13:55:40"
      }
      ],
      "image": [
      {
      "id": "2",
      "user_id": "2",
      "path": "2_1447674934.jpg",
      "description": "This is a sample feed text.",
      "parent_type": "2",
      "parent_id": "6",
      "created_at": "2015-11-16 11:55:34",
      "updated_at": "2015-11-16 11:55:34"
      }
      ],
      "claps": []
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

            $feed = Feeds::where('id', '=', $request->input('feed_id'))->with(['comments', 'image', 'claps'])->first();

            return response()->json(['status' => 1, 'success' => 'commented_on_feed_successfully', 'feed' => $feed->toArray(), 'urls' => config('urls.urls')], 200);
        }
    }

    /**
     * @api {post} /feeds/comments loadComments
     * @apiName loadComments
     * @apiGroup Feeds
     * @apiParam {Number} user_id Id of user 
     * @apiParam {Number} feed_id feed_id 
     * @apiParam {Number} [offset] offset 
     * @apiParam {Number} [limit] limit 
     * @apiSuccess {String} success.
     * @apiSuccessExample Success-Response:
     *HTTP/1.1 200 OK{
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
            "user": {
                "id": "14",
                "email": "sachin@cubettech.com",
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
                        "city": null,
                        "state": null,
                        "country": null,
                        "quote": "",
                        "created_at": "2015-11-11 06:23:56",
                        "updated_at": "2015-11-11 06:23:56"
                    }
                ]
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
            "user": {
                "id": "11",
                "email": "ansa@cubettech.com",
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
                ]
            }
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
                    ->with(['user']);
                if (!null === ($request->input('offset')) && !null === ($request->input('limit'))) {
                    $commentQuery->skip($request->input('offset'));
                    $commentQuery->take($request->input('limit'));
                }
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
     * @apiParam {Number} user_id Id of user 
     * @apiParam {Number} comment_id feed_id 
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
