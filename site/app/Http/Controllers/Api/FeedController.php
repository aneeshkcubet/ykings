<?php namespace App\Http\Controllers\Api;

use Auth,
    Image,
    Validator,
    DB;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Carbon\Carbon;
use App\Settings;
use App\User;
use App\Profile;
use App\Feeds;
use App\Images;
use App\Clap;
use App\Comment;
use App\Exerciseuser;
use App\Workoutuser;
use App\Follow;
use App\Workout;
use App\Exercise;

class FeedController extends Controller
{
    /*
      |--------------------------------------------------------------------------
      | Workout Controller
      |--------------------------------------------------------------------------
      |
      | This controller handles feeds,workout,excercise.
      |
     */

    /**
     * @api {post} /feeds/create CreateFeed
     * @apiName CreateFeed
     * @apiGroup Feeds
     * @apiParam {Number} user_id Id of user *required 
     * @apiParam {String} item_type 'excercise','workout','motivation','announcement' *required
     * @apiParam {String} item_id id of the targetting item *required
     * @apiParam {String} time_taken time in seconds
     * @apiParam {String} rewards points earned by doing activity
     * @apiParam {String} category in case of workout completion
     * @apiParam {String} text *required
     * @apiParam {file} [image]
     * 
     * @apiSuccess {String} success.
     * 
     * @apiSuccessExample Success-Response:
     * HTTP/1.1 200 OK
     *  {
      "status": 1,
      "success": "feed_created_successfully"
      }
     * 
     * @apiError error Message token_invalid.
     * @apiError error Message token_expired.
     * @apiError error Message token_not_provided.
     * @apiError error Validation error.
     * @apiError error Validation error.
     * @apiError error Validation error.
     * @apiError error Validation error.
     * @apiError error user_does_not_exists
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
     *     HTTP/1.1 500 user_does_not_exists
     *     {
     *       "status" : 0,
     *       "error": "user_does_not_exists"
     *     }
     * 
     */
    public function createFeeds(Request $request)
    {
        if (!isset($request->user_id) || ($request->user_id == null)) {
            return response()->json(["status" => "0", "error" => "The user_id field is required"]);
        } elseif (!isset($request->item_type) || ($request->item_type == null)) {
            return response()->json(["status" => "0", "error" => "The item_type field is required"]);
        } elseif (!isset($request->item_id) || ($request->item_id == null)) {
            return response()->json(["status" => "0", "error" => "The item_id field is required."]);
        } elseif (!isset($request->text) || ($request->text == null)) {
            return response()->json(["status" => "0", "error" => "The text field is required."]);
        } else {

            $user = User::where('id', '=', $request->input('user_id'))->first();

            if ($user) {

                $itemId = $request->input('item_id');

                if ($request->item_type == 'exercise') {
                    Exerciseuser::create([
                        'user_id' => $request->user_id,
                        'exercise_id' => $request->item_id,
                        'status' => 1,
                        'time' => $request->time_taken,
                    ]);

                    $exerciseDetails = Exerciseuser::where('user_id', $request->user_id)
                        ->where('exercise_id', $request->item_id)
                        ->where('status', 1)
                        ->first();

                    $itemId = $exerciseDetails->id;

                    DB::table('points')->insert([
                        'user_id' => $request->user_id,
                        'activity' => 'exercise_completed',
                        'points' => $request->rewards,
                        'created_at' => Carbon::now()
                    ]);
                } elseif ($request->item_type == 'workout') {

                    $data = [
                        'workout_id' => $request->item_id,
                        'user_id' => $request->user_id,
                        'status' => 1,
                        'time' => $request->time_taken,
                        'category' => $request->category,
                        'is_starred' => 0
                    ];

                    WorkoutUser::create($data);

                    $exerciseDetails = WorkoutUser::where('user_id', $request->user_id)
                        ->where('workout_id', $request->item_id)
                        ->where('status', 1)
                        ->where('category', $request->category)
                        ->first();

                    $itemId = $exerciseDetails->id;

                    DB::table('points')->insert([
                        'user_id' => $request->user_id,
                        'activity' => 'workout_completed',
                        'points' => $request->rewards,
                        'created_at' => Carbon::now()
                    ]);
                }

                $feeds = new Feeds([
                    'user_id' => $request->input('user_id'),
                    'item_type' => $request->input('item_type'),
                    'item_id' => $request->input('item_id'),
                    'feed_text' => $request->input('text')
                ]);

                $feed = $user->feeds()->save($feeds);

                if (isset($_FILES['image']) && $_FILES['image']['error'] == UPLOAD_ERR_OK) {


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
                        'parent_type' => 2,
                        'parent_id' => $feed->id
                    ]);

                    $feeds->image()->save($image_upload);
                }
                $feeds = Feeds::with(['user', 'image'])->get();
                return response()->json(['status' => 1, 'success' => 'feed_created_successfully'], 200);
            } else {
                return response()->json(['status' => 0, 'error' => 'user_does_not_exists'], 500);
            }
        }
    }

    /**
     * @api {post} /user/feedlist UserFeeds
     * @apiName UserFeeds
     * @apiGroup Feeds
     * @apiParam {Number} user_id Id of user 
     * @apiParam {Number} [offset] offset
     * @apiParam {Number} [limit] limit 
     * @apiSuccess {String} success.
     *  @apiSuccessExample Success-Response:
     *     HTTP/1.1 200 OK
     * {
      "status": 1,
      "success": "List",
      "follower_count": 2,
      "level_count": 0,
      "workout_count": 0,
      "feed_list": [
      {
      "id": "21",
      "user_id": "14",
      "item_type": "excercise",
      "item_id": "1",
      "feed_text": "testttttttttt",
      "created_at": "2015-11-11 06:27:51",
      "updated_at": "2015-11-11 06:27:51",
      "clap_count": 0,
      "comment_count": 0,
      "is_commented": 0,
      "is_claped": 0,
      "category": "Strength",
      "image": [],
      "workout": [],
      "exercise": []
      },
      {
      "id": "22",
      "user_id": "14",
      "item_type": "excercise",
      "item_id": "1",
      "feed_text": "afassdfsd",
      "created_at": "2015-11-11 06:49:38",
      "updated_at": "2015-11-11 06:49:38",
      "clap_count": 0,
      "comment_count": 0,
      "is_commented": 0,
      "is_claped": 0,
      "category": "Strength",
      "image": [],
      "workout": [],
      "exercise": []
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
     * 
     * 
     * @apiError error Message token_invalid.
     * @apiError error Message token_expired.
     * @apiError user_not_exists User error.
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
     *       "error": "user_not_exists"
     *     }
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 422 Validation error
     *     {
     *       "status" : 0,
     *       "error": "The user_id field is required"
     *     }
     * 
     */
    public function userFeeds(Request $request)
    {
        $feedsResponse = array();
        if (!isset($request->user_id) || ($request->user_id == null)) {
            return response()->json(["status" => "0", "error" => "The user_id field is required"]);
        } else {
            $user = User::where('id', '=', $request->input('user_id'))->first();

            $feedQuery = Feeds::where('user_id', '=', $request->input('user_id'));

            if ($user) {
                $feedQuery->with(['image', 'workout', 'exercise']);
                if ($request->offset != null && $request->limit != null) {
                    $feedQuery->skip($request->input('limit'));
                    $feedQuery->take($request->input('offset'));
                }
                $feedQuery->orderBy('created_at', 'DESC');
                $feeds = $feedQuery->get();
                if (count($feeds) > 0) {
                    $feedsResponse = $this->AdditionalFeedsDetails($feeds, $request->user_id);
                }
                //follower count
                $followerCount = Follow::followerCount($request->user_id);
                //workout count
                $workoutCount = Workoutuser::workoutCount($request->user_id);
                return response()->json(['status' => 1, 'success' => 'List',
                        'follower_count' => $followerCount,
                        'level_count' => 0,
                        'workout_count' => $workoutCount,
                        'feed_list' => $feedsResponse,
                        'urls' => config('urls.urls')], 200);
            } else {
                return response()->json(['status' => 0, 'error' => 'user_not_exists'], 500);
            }
        }
    }

    /**
     * @api {post} /feeds/list ListFeeds
     * @apiName ListFeeds
     * @apiGroup Feeds
     * @apiParam {Number} user_id Id of user 
     * @apiParam {Number} [offset] offset 
     * @apiParam {Number} [limit] limit
     * @apiSuccess {String} success.
     * @apiSuccessExample Success-Response:
     *     HTTP/1.1 200 OK
     * {
      "status": 1,
      "success": "List",
      "feed_list": [
      {
      "id": "38",
      "user_id": "11",
      "item_type": "workout",
      "item_id": "1",
      "feed_text": "testttttttttt",
      "created_at": "2015-11-11 11:53:35",
      "updated_at": "2015-11-11 11:53:35",
      "clap_count": 0,
      "comment_count": 0,
      "is_commented": 0,
      "is_claped": 0,
     "category": "Strength",
      "image": [
      {
      "id": "6",
      "user_id": "11",
      "path": "11_1447242815.jpg",
      "description": "testttttttttt",
      "parent_type": "2",
      "parent_id": "38",
      "created_at": "2015-11-11 11:53:35",
      "updated_at": "2015-11-11 11:53:35"
      }
      ],
      "profile": {
      "user_id": "11",
      "first_name": "ansa",
      "last_name": "v",
      "image": "11_1447237788.jpg"
      }
      },
      {
      "id": "37",
      "user_id": "11",
      "item_type": "workout",
      "item_id": "1",
      "feed_text": "testttttttttt",
      "created_at": "2015-11-11 11:46:28",
      "updated_at": "2015-11-11 11:46:28",
      "clap_count": 0,
      "comment_count": 0,
      "is_commented": 0,
      "is_claped": 0,
      "category": "Strength",
      "image": [
      {
      "id": "5",
      "user_id": "11",
      "path": "11_1447242388.jpg",
      "description": "testttttttttt",
      "parent_type": "2",
      "parent_id": "37",
      "created_at": "2015-11-11 11:46:28",
      "updated_at": "2015-11-11 11:46:28"
      }
      ],
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
     * 
     * 
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
     *       "error": "user_not_exists"
     *     }
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 422 Validation error
     *     {
     *       "status" : 0,
     *       "error": "The user_id field is required"
     *     }
     */
    public function listFeeds(Request $request)
    {
        $feedsResponse = array();
        if (!isset($request->user_id) || ($request->user_id == null)) {
            return response()->json(["status" => "0", "error" => "The user_id field is required"]);
        } else {
            $user = User::where('id', '=', $request->input('user_id'))->first();
            if ($user) {

                $feedQuery = Feeds::whereIn('user_id', function($query) use ($request) {
                        $query->select('user_id')
                            ->from('follows')
                            ->where('follow_id', $request->user_id);
                    });

                $feedQuery->orWhere('user_id', 1);
                $feedQuery->orWhere('user_id', $request->user_id);
                $feedQuery->with(['image', 'profile', 'workout', 'exercise']);

                if ($request->offset != null && $request->limit != null) {
                    $feedQuery->skip($request->input('limit'));
                    $feedQuery->take($request->input('offset'));
                }

                $feedQuery->orderBy('created_at', 'DESC');
                $feeds = $feedQuery->get();
                if (count($feeds) > 0) {
                    $feedsResponse = $this->AdditionalFeedsDetails($feeds, $request->user_id);
                }
                return response()->json(['status' => 1, 'success' => 'List', 'feed_list' => $feedsResponse, 'urls' => config('urls.urls')], 200);
            } else {
                return response()->json(['status' => 0, 'error' => 'user_not_exists'], 500);
            }
        }
    }

    /**
     * Function to get additional parameters in feeds.
     * @since 19/11/2015
     * @author ansa@cubettech.com
     * @return json
     */
    protected function AdditionalFeedsDetails($feeds, $userId)
    {
        foreach ($feeds as $feedsArray) {
            //Clap count
            $feedsArray['clap_count'] = Clap::clapCount($feedsArray['id'], 'feed');

            //comments count
            $feedsArray['comment_count'] = Comment::commentCount($feedsArray['id'], 'feed');

            //is_commented
            $feedsArray['is_commented'] = Comment::isCommented($userId, $feedsArray['id'], 'feed');
            //is claped
            $feedsArray['is_claped'] = Clap::isClaped($userId, $feedsArray['id'], 'feed');

            if ($feedsArray['item_type'] == 'workout') {
                $workout = Workout::where('id', '=', $feedsArray['item_id'])->first();
                if (!is_null($workout)) {
                    if ($workout->category == 1) {
                        $feedsArray['category'] = "Strength";
                    } elseif ($workout->category == 2) {
                        $feedsArray['category'] = "Cardio-strength";
                    }
                } else {
                    $feedsArray['category'] = "";
                }
            } elseif ($feedsArray['item_type'] == 'excercise') {
                $exercise = Exercise::where('id', '=', $feedsArray['item_id'])->first();
                if (!is_null($exercise)) {
                    if ($exercise->category == 1) {
                        $feedsArray['category'] = "Lean";
                    } elseif ($exercise->category == 2) {
                        $feedsArray['category'] = "Athletic";
                    } elseif ($exercise->category == 3) {
                        $feedsArray['category'] = "Strength";
                    }
                } else {
                    $feedsArray['category'] = "";
                }
            } else {
                $feedsArray['category'] = "";
            }

            $feedsResponse[] = $feedsArray;
            unset($feedsArray);
        }
        return $feedsResponse;
    }

    /**
     * @api {post} /feeds/feedDetails
     * @apiName feedDetails
     * @apiGroup Feeds
     * @apiParam {Number} user_id Id of user 
     * @apiParam {Number} feed_id feed_id 
     * @apiSuccess {String} success.
     * @apiSuccessExample Success-Response:
     * HTTP/1.1 200 OK
     * {
      "status": 1,
      "success": "Details",
      "feed_details": [
      {
      "id": "21",
      "user_id": "14",
      "item_type": "excercise",
      "item_id": "1",
      "feed_text": "testttttttttt",
      "created_at": "2015-11-11 06:27:51",
      "updated_at": "2015-11-11 06:27:51",
      "clap_count": 0,
      "comment_count": 0,
      "is_commented": 0,
      "is_claped": 0,
      "profile": {
      "user_id": "14",
      "first_name": "sachii",
      "last_name": "k",
      "image": null
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
     * 
     * 
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
     *       "error": "user_not_exists"
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
    public function feedsDetails(Request $request)
    {
        if (!isset($request->user_id) || ($request->user_id == null)) {
            return response()->json(["status" => "0", "error" => "The user_id field is required"]);
        } else if (!isset($request->feed_id) || ($request->feed_id == null)) {
            return response()->json(["status" => "0", "error" => "The feed_id field is required"]);
        } else {
            $user = User::where('id', '=', $request->input('user_id'))->first();

            if ($user) {
                $feedsArray = Feeds::where('id', '=', $request->input('feed_id'))
                        ->with(['profile'])->first();
                if ($feedsArray) {
                    $feedsArray['clap_count'] = Clap::where('item_id', $feedsArray['id'])
                        ->where('item_type', '=', 'feed')
                        ->count();
                    //comments count
                    $feedsArray['comment_count'] = Comment::where('parent_id', $feedsArray['id'])
                        ->where('parent_type', '=', 'feed')
                        ->count();

                    //is_commented
                    $feedsArray['is_commented'] = Comment::isCommented($request->user_id, $feedsArray['id'], 'feed');
                    //is claped
                    $feedsArray['is_claped'] = Clap::isClaped($request->user_id, $feedsArray['id'], 'feed');

                    $feedsResponse[] = $feedsArray;
                }
                return response()->json(['status' => 1, 'success' => 'Details', 'feed_details' => $feedsResponse, 'urls' => config('urls.urls')], 200);
            } else {
                return response()->json(['status' => 0, 'error' => 'user_not_exists'], 500);
            }
        }
    }

    /**
     * @api {post} /feeds/clap clapFeed
     * @apiName clapFeed
     * @apiGroup Feeds
     * @apiParam {Number} user_id Id of user 
     * @apiParam {Number} feed_id feed_id 
     * @apiSuccess {String} success.
     * @apiSuccessExample Success-Response:
     *    HTTP/1.1 200 OK
      {
      "status": 1,
      "success": "clap added"
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
    public function clapFeed(Request $request)
    {
        if (!isset($request->user_id) || ($request->user_id == null)) {
            return response()->json(["status" => "0", "error" => "The user_id field is required"]);
        } else if (!isset($request->feed_id) || ($request->feed_id == null)) {
            return response()->json(["status" => "0", "error" => "The feed_id field is required"]);
        } else {
            $feed = Feeds::where('id', '=', $request->input('feed_id'))->with(['claps'])->first();

            if (!is_null($feed)) {
                $clap = Clap::where('user_id', '=', $request->input('user_id'))
                    ->where('item_id', '=', $request->input('feed_id'))
                    ->where('item_type', '=', 'feed')
                    ->first();
                if (is_null($clap)) {
                    $clap_details = new Clap([
                        'user_id' => $request->input('user_id'),
                        'item_type' => 'feed',
                        'item_id' => $request->input('feed_id')
                    ]);

                    $feed->claps()->save($clap_details);
                }

                $feeds = Feeds::where('id', '=', $request->input('feed_id'))->with(['comments', 'claps', 'image'])->get();
                return response()->json(['status' => 1, 'success' => 'clap added'], 200);
            } else {
                return response()->json(['status' => 0, 'error' => 'feed_not_exists'], 422);
            }
        }
    }

    /**
     * @api {post} /feeds/unclap unclapFeed
     * @apiName unclapFeed
     * @apiGroup Feeds
     * @apiParam {Number} user_id Id of user 
     * @apiParam {Number} feed_id feed_id 
     * @apiSuccess {String} success.
     * @apiSuccessExample Success-Response:
     *    HTTP/1.1 200 OK
      {
      "success": "unclaped"
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
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 422 Validation error
     *     {
     *       "status" : 0,
     *       "error": "not_yet_claped"
     *     }
     */
    public function unclapFeed(Request $request)
    {
        if (!isset($request->user_id) || ($request->user_id == null)) {
            return response()->json(["status" => "0", "error" => "The user_id field is required"]);
        } else if (!isset($request->feed_id) || ($request->feed_id == null)) {
            return response()->json(["status" => "0", "error" => "The feed_id field is required"]);
        } else {
            $feed = Feeds::where('id', '=', $request->input('feed_id'))->with(['claps'])->first();
            if (!is_null($feed)) {
                $clap = Clap::where('user_id', '=', $request->input('user_id'))
                    ->where('item_id', '=', $request->input('feed_id'))
                    ->where('item_type', '=', 'feed')
                    ->first();
                if (!is_null($clap)) {
                    $clap->delete();
                    $feeds = Feeds::where('id', '=', $request->input('feed_id'))->with(['comments', 'claps', 'image'])->get();
                    return response()->json(['status' => 1, 'success' => 'unclaped'], 200);
                } else {
                    return response()->json(['status' => 0, 'error' => 'not_yet_claped'], 422);
                }
            } else {
                return response()->json(['status' => 0, 'error' => 'feed_not_exists'], 422);
            }
        }
    }
}
