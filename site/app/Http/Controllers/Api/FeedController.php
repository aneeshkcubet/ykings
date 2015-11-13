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
use App\Clap;
use Image;

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
                'user_id' => 'required',
                'offset' => 'required',
                'limit' => 'required'
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
     * Get a validator for details of particular feed.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator_clap(array $data)
    {
        return Validator::make($data, [
                'user_id' => 'required',
                'feed_id' => 'required'
        ]);
    }

    /**
     * @api {post} /feeds/create?token= createFeeds
     * @apiName CreateFeeds
     * @apiGroup Feeds
     * @apiParam {Number} user_id Id of user *required 
     * @apiParam {String} item_type 'excercise','workout','motivation','announcement' *required
     * @apiParam {String} item_id id of the targetting item *required
     * @apiParam {file} image *optional
     * 
     * @apiSuccess {String} success.
     * 
     * @apiSuccessExample Success-Response:
     * HTTP/1.1 200 OK
     * {
      "status" : 1,
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
     * @apiError error Message token_not_provided.
     * @apiError error Validation error.
     * @apiError error Validation error.
     * @apiError error Validation error.
     * @apiError error Validation error.
     * @apiError could_not_create_user User error.
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
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 422 Validation error
     *     {
     *       "status" : 0,
     *       "error": "The item_type field is required"
     *     }
     * 
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 422 Validation error
     *     {
     *       "status" : 0,
     *       "error": "The item_id field is required"
     *     }
     * 
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 422 Validation error
     *     {
     *       "status" : 0,
     *       "error": "The text field is required"
     *     }
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 422 Validation error
     *     {
     *       "status" : 0,
     *       "error": "user_created_but_we_accept_only_jpeg_gif_png_files_as_profile_images"
     *     } 
     * 
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 500 user_does_not_exists
     *     {
     *       "status" : 0,
     *       "error": "user_does_not_exists"
     *     }
     * 
     */
    public function createFeeds(Request $request)
    {
        if (!isset($request->user_id) || ($request->user_id == NULL)) {
            return response()->json(["status" => "0", "error" => "The user_id field is required"]);
        } elseif (!isset($request->item_type) || ($request->item_type == NULL)) {
            return response()->json(["status" => "0", "error" => "The item_type field is required"]);
        } elseif (!isset($request->item_id) || ($request->item_id == NULL)) {
            return response()->json(["status" => "0", "error" => "The item_id field is required."]);
        } elseif (!isset($request->text) || ($request->text == NULL)) {
            return response()->json(["status" => "0", "error" => "The text field is required."]);
        } else {

            $user = User::where('id', '=', $request->input('user_id'))->first();

            if ($user) {
                $feeds = new Feeds([
                    'user_id' => $request->input('user_id'),
                    'item_type' => $request->input('item_type'),
                    'item_id' => $request->input('item_id'),
                    'feed_text' => $request->input('text')
                ]);

                $feed = $user->feeds()->save($feeds);

                if (isset($_FILES['image']) && $_FILES['image']['error'] == UPLOAD_ERR_OK) {

                    $accepableTypes = ['image/jpeg', 'image/gif', 'image/png', 'image/jpg', 'image/pjpeg', 'image/x-png'];

                    if (!in_array($_FILES['image']['type'], $accepableTypes)) {
                        return response()->json(['error' => 'user_created_but_we_accept_only_jpeg_gif_png_files_as_profile_images'], 500);
                    }

                    $image = Image::make($_FILES['image']['tmp_name']);

                    $image->encode('jpeg');

                    $image->save(config('image.feedOriginalPath') . $user->id . '_' . time() . '.jpg');

                    $image->crop(400, 400);

                    $image->save(config('image.feedLargePath') . $user->id . '_' . time() . '.jpg');

                    $image->crop(150, 150);

                    $image->save(config('image.feedMediumPath') . $user->id . '_' . time() . '.jpg');

                    $image->crop(65, 65);

                    $image->save(config('image.feedSmallPath') . $user->id . '_' . time() . '.jpg');

                    $image_upload = new Images([
                        'user_id' => $request->input('user_id'),
                        'path' => $user->id . '_' . time() . '.jpg',
                        'description' => $request->input('text'),
                        'parent_type' => 'feed', 'parent_id' => $feed->id
                    ]);

                    $feeds->images()->save($image_upload);
                }
                $feeds = Feeds::with(['user', 'images'])->get();
                return response()->json(['status' => 1, 'success' => 'feed_created_successfully', 'feed' => $feeds->toArray()], 200);
            } else {
                return response()->json(['status' => 0, 'error' => 'user_does_not_exists'], 500);
            }
        }
    }

    /**
     * @api {post} /user/feedlist?token= UserFeeds
     * @apiName UserFeeds
     * @apiGroup Feeds
     * @apiParam {Number} user_id Id of user 
     * @apiParam {Number} offser offset
     * @apiParam {Number} limit limit 
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
        if (!isset($request->user_id) || ($request->user_id == NULL)) {
            return response()->json(["status" => "0", "error" => "The user_id field is required"]);
        } else if (!isset($request->offset) || ($request->offset == NULL)) {
            return response()->json(["status" => "0", "error" => "The offset field is required"]);
        } else if (!isset($request->limit) || ($request->limit == NULL)) {
            return response()->json(["status" => "0", "error" => "The limit field is required"]);
        } else {
            $user = User::where('id', '=', $request->input('user_id'))->first();

            if ($user) {
                $feeds = Feeds::where('user_id', '=', $request->input('user_id'))
                    ->with(['user', 'commentCount', 'image'])
                    ->skip($request->input('offset'))
                    ->take($request->input('limit'))
                    ->get();
                return response()->json(['status' => 1, 'success' => 'List', 'feed_list' => $feeds->toArray()], 200);
            } else {
                return response()->json(['status' => 0, 'error' => 'user_not_exists'], 500);
            }
        }
    }

    /**
     * @api {post} /feeds/list?token= ListFeeds
     * @apiName ListFeeds
     * @apiGroup Feeds
     * @apiParam {Number} user_id Id of user 
     * @apiParam {Number} offset offset 
     * @apiParam {Number} limit limit
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
        if (!isset($request->user_id) || ($request->user_id == NULL)) {
            return response()->json(["status" => "0", "error" => "The user_id field is required"]);
        } else if (!isset($request->offset) || ($request->offset == NULL)) {
            return response()->json(["status" => "0", "error" => "The offset field is required"]);
        } else if (!isset($request->limit) || ($request->limit == NULL)) {
            return response()->json(["status" => "0", "error" => "The limit field is required"]);
        } else {
            $user = User::where('id', '=', $request->input('user_id'))->first();

            if ($user) {
                $feeds = Feeds::with(['user', 'commentCount'])
                    ->skip($request->input('offset'))
                    ->take($request->input('limit'))
                    ->get();

                return response()->json(['status' => 1, 'success' => 'List', 'feed_list' => $feeds->toArray()], 200);
            } else {
                return response()->json(['status' => 0, 'error' => 'user_not_exists'], 500);
            }
        }
    }

    /**
     * @api {post} /feeds/feedDetails?token= FeedDetails
     * @apiName feedDetails
     * @apiGroup Feeds
     * @apiParam {Number} user_id Id of user 
     * @apiSuccess {String} success.
     * @apiSuccessExample Success-Response:
     * HTTP/1.1 200 OK
     * {
      "success": "List",
      "feed_list": [
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
      },
      "comment_count": null
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
    public function feedsDetails(Request $request)
    {
        if (!isset($request->user_id) || ($request->user_id == NULL)) {
            return response()->json(["status" => "0", "error" => "The user_id field is required"]);
        } else if (!isset($request->feed_id) || ($request->feed_id == NULL)) {
            return response()->json(["status" => "0", "error" => "The feed_id field is required"]);
        } else {
            $user = User::where('id', '=', $request->input('user_id'))->first();

            if ($user) {
                $feeds = Feeds::where('id', '=', $request->input('feed_id'))->with(['user', 'commentCount'])->get();

                return response()->json(['success' => 'List', 'feed_list' => $feeds->toArray()], 200);
            } else {
                return response()->json(['error' => 'user_not_exists'], 500);
            }
        }
    }

    public function clapFeed(Request $request)
    {
        $validator = $this->validator_clap($request->all());

        if ($validator->fails()) {
            return response()->json(['error' => $validator->messages()->toArray()], 422);
        }
        $feed = Feeds::where('id', '=', $request->input('feed_id'))->first();

        if (!is_null($feed)) {
            $clap = Clap::where('user_id', '=', $request->input('user_id'))
                ->where('item_id', '=', $request->input('feed_id'))
                ->where('item_type', '=', 'feed')
                ->first();
            if (is_null($clap)) {
                $clap_details = new Clap(['user_id' => $request->input('user_id'),
                    'item_type' => 'feed', 'item_id' => $request->input('feed_id')
                ]);
                $feed->clap()->save($clap_details);
            }
            $feeds = Feeds::where('id', '=', $request->input('feed_id'))->with(['user', 'commentCount', 'clap'])->get();
            return response()->json(['success' => 'List', 'clap' => $feeds->toArray()], 200);
        } else {
            return response()->json(['error' => 'feed_not_exists'], 422);
        }
    }

    public function loadComments(Request $request)
    {
        $validator = $this->validator_clap($request->all());

        if ($validator->fails()) {
            return response()->json(['status' => 0, 'error' => $validator->errors()->getMessages()], 422);
        }
        $feed = Feeds::where('id', '=', $request->input('feed_id'))->first();

        if (!is_null($feed)) {
            $feeds = Feeds::where('id', '=', $request->input('feed_id'))->with(['comment'])->get();
            return response()->json(['status' => 1, 'success' => 'comments list', 'comments' => $feeds->toArray(), 'urls' => config('urls.urls')], 200);
        } else {
            return response()->json(['status' => 0, 'error' => 'feed_not_exists'], 422);
        }
    }
}
