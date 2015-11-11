<?php namespace App\Http\Controllers\Api;

use Auth,
    Validator;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Settings;
use App\User;
use App\Profile;
use App\Feeds;
use App\Images;

class FeedController extends Controller
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
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
                'user_id' => 'required',
                'item_type' => 'required',
                'item_id' => 'required',
                'text' => 'required'
        ]);
    }

    /**
     * Get a validator for listing all feeds.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator_list(array $data)
    {
        return Validator::make($data, [
                'user_id' => 'required'
        ]);
    }

    /**
     * Get a validator for details of particular feed.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator_feed(array $data)
    {
        return Validator::make($data, [
                'user_id' => 'required',
                'feed_id' => 'required'
        ]);
    }

    /**
     * @api {post} /createFeeds createFeeds
     * @apiName Create Feeds
     * @apiGroup Feeds
     * @apiParam {Number} user_id Id of user 
     * @apiParam {String} item_type 'excercise','workout','motivation','announcement'
     * @apiParam {String} image FormData
     * @apiSuccess {String} success.
     * @apiSuccessExample Success-Response:
     * HTTP/1.1 200 OK
     * {
      "success": "feed_created_successfully",
      "feed": [
      {
      "id": "15",
      "user_id": "11",
      "item_type": "workout",
      "item_id": "1",
      "feed_text": "testttttttttt",
      "created_at": "2015-11-11 03:51:01",
      "updated_at": "2015-11-11 03:51:01",
      "user": {
      "id": "11",
      "email": "ansa@cubettech.com",
      "confirmation_code": null,
      "status": "1",
      "created_at": "2015-11-09 12:40:07",
      "updated_at": "2015-11-09 12:40:07"
      }
      },
      {
      "id": "16",
      "user_id": "11",
      "item_type": "workout",
      "item_id": "1",
      "feed_text": "testttttttttt",
      "created_at": "2015-11-11 03:58:36",
      "updated_at": "2015-11-11 03:58:36",
      "user": {
      "id": "11",
      "email": "ansa@cubettech.com",
      "confirmation_code": null,
      "status": "1",
      "created_at": "2015-11-09 12:40:07",
      "updated_at": "2015-11-09 12:40:07"
      }
      }
      ]
      }
     * 
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
     */
    public function createFeeds(Request $request)
    {
        $validator = $this->validator($request->all());

        if ($validator->fails()) {
            return response()->json(['error' => $validator->messages()->toArray()], 422);
        }
        $user = User::where('id', '=', $request->input('user_id'))->first();

        if ($user) {
            $feeds = new Feeds(['user_id' => $request->input('user_id'),
                'item_type' => $request->input('item_type'),
                'item_id' => $request->input('item_id'),
                'feed_text' => $request->input('text')]);
            $feed = $user->feeds()->save($feeds);

            $feeds = Feeds::with(['user'])->get();
            return response()->json(['success' => 'feed_created_successfully', 'feed' => $feeds->toArray()], 200);
        } else {
            return response()->json(['error' => 'user_not_exists'], 500);
        }
    }

    /**
     * @api {post} user/feedlist UserFeeds
     * @apiName UserFeeds
     * @apiGroup Feeds
     * @apiParam {Number} user_id Id of user 
     * @apiSuccess {String} success.
     *  @apiSuccessExample Success-Response:
     *     HTTP/1.1 200 OK
     * {
      "success": "List",
      "feed_list": [
      {
      "id": "21",
      "user_id": "14",
      "item_type": "excercise",
      "item_id": "1",
      "feed_text": "testttttttttt",
      "created_at": "2015-11-11 06:27:51",
      "updated_at": "2015-11-11 06:27:51",
      "user": {
      "id": "14",
      "email": "sachin@cubettech.com",
      "confirmation_code": null,
      "status": "1",
      "created_at": "2015-11-11 06:23:56",
      "updated_at": "2015-11-11 06:23:56"
      }
      },
      {
      "id": "22",
      "user_id": "14",
      "item_type": "excercise",
      "item_id": "1",
      "feed_text": "afassdfsd",
      "created_at": "2015-11-11 06:49:38",
      "updated_at": "2015-11-11 06:49:38",
      "user": {
      "id": "14",
      "email": "sachin@cubettech.com",
      "confirmation_code": null,
      "status": "1",
      "created_at": "2015-11-11 06:23:56",
      "updated_at": "2015-11-11 06:23:56"
      }
      },
      {
      "id": "23",
      "user_id": "14",
      "item_type": "excercise",
      "item_id": "1",
      "feed_text": "afassdfsd",
      "created_at": "2015-11-11 06:50:18",
      "updated_at": "2015-11-11 06:50:18",
      "user": {
      "id": "14",
      "email": "sachin@cubettech.com",
      "confirmation_code": null,
      "status": "1",
      "created_at": "2015-11-11 06:23:56",
      "updated_at": "2015-11-11 06:23:56"
      }
      },
      {
      "id": "24",
      "user_id": "14",
      "item_type": "excercise",
      "item_id": "1",
      "feed_text": "afassdfsd",
      "created_at": "2015-11-11 06:57:04",
      "updated_at": "2015-11-11 06:57:04",
      "user": {
      "id": "14",
      "email": "sachin@cubettech.com",
      "confirmation_code": null,
      "status": "1",
      "created_at": "2015-11-11 06:23:56",
      "updated_at": "2015-11-11 06:23:56"
      }
      },
      {
      "id": "25",
      "user_id": "14",
      "item_type": "excercise",
      "item_id": "1",
      "feed_text": "afassdfsd",
      "created_at": "2015-11-11 06:57:21",
      "updated_at": "2015-11-11 06:57:21",
      "user": {
      "id": "14",
      "email": "sachin@cubettech.com",
      "confirmation_code": null,
      "status": "1",
      "created_at": "2015-11-11 06:23:56",
      "updated_at": "2015-11-11 06:23:56"
      }
      }
      ]
      }
     * 
     * 
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
     */
    public function userFeeds(Request $request)
    {
        $validator = $this->validator_list($request->all());

        if ($validator->fails()) {
            return response()->json(['error' => $validator->messages()->toArray()], 422);
        }
        $user = User::where('id', '=', $request->input('user_id'))->first();

        if ($user) {
            $feeds = Feeds::where('user_id', '=', $request->input('user_id'))->with(['user'])
                ->get();
            return response()->json(['success' => 'List', 'feed_list' => $feeds->toArray()], 200);
        } else {
            return response()->json(['error' => 'user_not_exists'], 500);
        }
    }

    /**
     * @api {post} feeds/list ListFeeds
     * @apiName ListFeeds
     * @apiGroup Feeds
     * @apiParam {Number} user_id Id of user 
     * @apiSuccess {String} success.
     * @apiSuccessExample Success-Response:
     *     HTTP/1.1 200 OK
     * {
      "success": "list",
      "feed_list": [
      {
      "id": "15",
      "user_id": "11",
      "item_type": "workout",
      "item_id": "1",
      "feed_text": "testttttttttt",
      "created_at": "2015-11-11 03:51:01",
      "updated_at": "2015-11-11 03:51:01"
      },
      {
      "id": "16",
      "user_id": "11",
      "item_type": "workout",
      "item_id": "1",
      "feed_text": "testttttttttt",
      "created_at": "2015-11-11 03:58:36",
      "updated_at": "2015-11-11 03:58:36"
      },
      {
      "id": "17",
      "user_id": "11",
      "item_type": "workout",
      "item_id": "1",
      "feed_text": "testttttttttt",
      "created_at": "2015-11-11 03:59:27",
      "updated_at": "2015-11-11 03:59:27"
      },
      {
      "id": "18",
      "user_id": "11",
      "item_type": "workout",
      "item_id": "1",
      "feed_text": "testttttttttt",
      "created_at": "2015-11-11 04:00:05",
      "updated_at": "2015-11-11 04:00:05"
      },
      {
      "id": "19",
      "user_id": "11",
      "item_type": "workout",
      "item_id": "1",
      "feed_text": "testttttttttt",
      "created_at": "2015-11-11 04:05:11",
      "updated_at": "2015-11-11 04:05:11"
      },
      {
      "id": "20",
      "user_id": "11",
      "item_type": "workout",
      "item_id": "1",
      "feed_text": "testttttttttt",
      "created_at": "2015-11-11 05:05:37",
      "updated_at": "2015-11-11 05:05:37"
      }
      ]
      }
     * 
     * 
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
     */
    public function listFeeds(Request $request)
    {
        $validator = $this->validator_list($request->all());

        if ($validator->fails()) {
            return response()->json(['error' => $validator->messages()->toArray()], 422);
        }
        $user = User::where('id', '=', $request->input('user_id'))->first();

        if ($user) {
            $feeds = Feeds::with(['user', 'commentCount'])->get();

            return response()->json(['success' => 'List', 'feed_list' => $feeds->toArray()], 200);
        } else {
            return response()->json(['error' => 'user_not_exists'], 500);
        }
    }

    public function feedsDetails(Request $request)
    {
        $validator = $this->validator_feed($request->all());

        if ($validator->fails()) {
            return response()->json(['error' => $validator->messages()->toArray()], 422);
        }
        $user = User::where('id', '=', $request->input('user_id'))->first();

        if ($user) {
            $feeds = Feeds::where('id', '=', $request->input('feed_id'))->with(['user', 'commentCount'])->get();

            return response()->json(['success' => 'List', 'feed_list' => $feeds->toArray()], 200);
        } else {
            return response()->json(['error' => 'user_not_exists'], 500);
        }
    }
}
