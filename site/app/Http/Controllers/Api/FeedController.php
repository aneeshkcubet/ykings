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
use App\Hiit;
use App\Hiituser;
use App\Point;
use App\Freestyleuser;
use App\Testuser;
use App\CommonFunctions\PushNotificationFunction;

class FeedController extends Controller
{
    /*
      |--------------------------------------------------------------------------
      | Workout Controller
      |--------------------------------------------------------------------------
      |
      | This controller handles feeds,workout,exercise.
      |
     */

    /**
     * @api {post} /feeds/create CreateFeed
     * @apiName CreateFeed
     * @apiGroup Feeds
     * @apiParam {Number} user_id Id of user *required 
     * @apiParam {String} item_type 'exercise','workout','motivation','announcement', 'hiit', 'freestyle', 'test', 'hiit_replacement','fundamental' *required
     * @apiParam {Number} item_id id of the targetting item (0 incase of freestyle) *required
     * @apiParam {Number} [time_taken] time in seconds (for 'exercise','workout', 'hiit', and 'freestyle'
     * @apiParam {Number} [rewards] points earned by doing activity
     * @apiParam {Number} [category] in case of workout completion 1-Strength, 2-HIIT Strength
     * @apiParam {Number} [focus] in case of workout completion 1-Lean, 2-Athletic 3-Strength
     * @apiParam {String} text *required
     * @apiParam {file} [image]
     * @apiParam {String} [starred] 0/1
     * @apiParam {Number} [volume] volume of exercise/workout/hiit
     * @apiParam {Number} [is_coach] 1 in case if coach workouts/exercises/hiits
     * @apiParam {Number} [coach_rounds] number of workout rounds ("coach_workout_rounds" field from day workout)
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
        } else {

            $user = User::where('id', '=', $request->input('user_id'))->first();

            if ($user) {

                $userLevelBefore = Point::userLevel($user->id);

                //Code added by <ansa@cubettech.com> on 30-12-2015
                //To add star for feed
                $addStar = 0;
                if (isset($request->starred) && ($request->starred != null))
                    $addStar = intval($request->starred);

                $itemId = $request->input('item_id');

                if ($request->item_type != 'fundamental' && $request->item_type != 'test') {
                    $feed = Feeds::create([
                            'user_id' => $request->input('user_id'),
                            'item_type' => $request->input('item_type'),
                            'item_id' => $request->input('item_id'),
                            'feed_text' => (isset($request->text) && ($request->text != null)) ? $request->text : '',
                            'image' => ''
                    ]);
                }

                if ($request->item_type == 'fundamental') {

                    DB::table('points')->insert([
                        'user_id' => $request->user_id,
                        'item_id' => 0,
                        'activity' => 'fundamental_completed',
                        'points' => $request->rewards,
                        'created_at' => Carbon::now()
                    ]);
                }


                if ($request->item_type == 'exercise') {
                    $exerciseUser = Exerciseuser::create([
                            'user_id' => $request->user_id,
                            'exercise_id' => $request->item_id,
                            'status' => 1,
                            'feed_id' => $feed->id,
                            'time' => $request->time_taken,
                            'is_starred' => $addStar,
                            'volume' => isset($request->volume) ? $request->volume : ''
                    ]);

                    $exerciseDetails = Exercise::where('id', $request->item_id)->first();

                    if ($exerciseDetails->unit == 'times') {
                        $pointForSingle = ($exerciseDetails->rewards) / $exerciseDetails->repititions;

                        $pointsEarned = 0;
                        if (isset($request->volume))
                            $pointsEarned = $pointForSingle * $request->volume;
                    } else {
                        $pointsEarned = 0;
                        if (isset($request->volume))
                            $pointsEarned = $exerciseDetails->rewards * $request->volume;
                    }

                    DB::table('points')->insert([
                        'user_id' => $request->user_id,
                        'item_id' => $exerciseUser->id,
                        'activity' => 'exercise_completed',
                        'points' => $pointsEarned,
                        'created_at' => Carbon::now()
                    ]);

                    if (isset($request->is_coach) && $request->is_coach == 1) {
                        $coachStatus = DB::table('coach_status')->where('user_id', $request->user_id)->first();
                        DB::table('coach_points')->insert([
                            'user_id' => $request->user_id,
                            'week' => $coachStatus->week,
                            'points' => $pointsEarned
                        ]);
                    }
                } elseif ($request->item_type == 'workout') {

                    $workoutDetails = Workout::where('id', $request->item_id)->first();

                    $data = [
                        'workout_id' => $request->item_id,
                        'user_id' => $request->user_id,
                        'status' => 1,
                        'feed_id' => $feed->id,
                        'time' => $request->time_taken,
                        'category' => $request->category,
                        'is_starred' => $addStar,
                        'volume' => isset($request->volume) ? $request->volume : '',
                        'focus' => isset($request->focus) ? $request->focus : '',
                        'is_coach' => isset($request->is_coach) ? $request->is_coach : 0,
                        'coach_rounds' => isset($request->coach_rounds) ? $request->coach_rounds : 0,
                    ];

                    $workoutUser = WorkoutUser::create($data);

                    $pointsEarned = 0;

                    $rewardsArray = json_decode($workoutDetails->rewards);

                    if (isset($request->is_coach) && $request->is_coach == 1) {
                        if ($request->category == 1) {
                            $pointsEarned = ($rewardsArray->lean / $workoutDetails->rounds) * $request->coach_rounds;
                        } elseif ($request->category == 2) {
                            $pointsEarned = ($rewardsArray->athletic / $workoutDetails->rounds) * $request->coach_rounds;
                        } elseif ($request->category == 3) {
                            $pointsEarned = ($rewardsArray->strength / $workoutDetails->rounds) * $request->coach_rounds;
                        }
                    } else {
                        $pointsEarned = $request->rewards;
                    }

                    if (isset($request->is_coach) && $request->is_coach == 1) {
                        $coachStatus = DB::table('coach_status')->where('user_id', $request->user_id)->first();
                        DB::table('coach_points')->insert([
                            'user_id' => $request->user_id,
                            'week' => $coachStatus->week,
                            'points' => $pointsEarned
                        ]);
                    }

                    DB::table('points')->insert([
                        'user_id' => $request->user_id,
                        'item_id' => $workoutUser->id,
                        'activity' => 'workout_completed',
                        'points' => $pointsEarned,
                        'created_at' => Carbon::now()
                    ]);
                } elseif ($request->item_type == 'hiit' || $request->item_type == 'hiit_replacement') {

                    $data = [
                        'hiit_id' => $request->item_id,
                        'user_id' => $request->user_id,
                        'status' => 1,
                        'feed_id' => $feed->id,
                        'time' => $request->time_taken,
                        'is_starred' => $addStar,
                        'volume' => isset($request->volume) ? $request->volume : ''
                    ];

                    $hiitUser = Hiituser::create($data);

                    $exerciseDetails = Hiit::where('id', $request->item_id)->first();

                    $pointsEarned = 0;

                    if (isset($request->volume))
                        $pointsEarned = $request->rewards;

                    DB::table('points')->insert([
                        'user_id' => $request->user_id,
                        'item_id' => $hiitUser->id,
                        'activity' => 'hiit_completed',
                        'points' => $pointsEarned,
                        'created_at' => Carbon::now()
                    ]);

                    if (isset($request->is_coach) && $request->is_coach == 1) {
                        $coachStatus = DB::table('coach_status')->where('user_id', $request->user_id)->first();
                        DB::table('coach_points')->insert([
                            'user_id' => $request->user_id,
                            'week' => $coachStatus->week,
                            'points' => $pointsEarned
                        ]);
                    }
                } elseif ($request->item_type == 'freestyle') {

                    $pointsEarned = 0;

                    $pointForSingle = DB::table('site_settings')->where('key', '=', 'freestyle_points')->pluck('value');

                    $pointsEarned = ($request->time_taken / 60) * $pointForSingle;

                    $data = [
                        'user_id' => $request->user_id,
                        'status' => 1,
                        'feed_id' => $feed->id,
                        'time' => $request->time_taken,
                        'is_starred' => $addStar,
                        'volume' => ceil(($request->time_taken / 60))
                    ];

                    $freestyleUser = Freestyleuser::create($data);

                    DB::table('points')->insert([
                        'user_id' => $request->user_id,
                        'item_id' => $freestyleUser->id,
                        'activity' => 'freestyle_completed',
                        'points' => $pointsEarned,
                        'created_at' => Carbon::now()
                    ]);
                } elseif ($request->item_type == 'test') {

                    $data = [
                        'test_id' => $request->item_id,
                        'user_id' => $request->user_id,
                        'status' => 1,
                        'feed_id' => 0,
                        'time' => $request->time_taken,
                        'is_starred' => $addStar,
                        'volume' => isset($request->volume) ? $request->volume : ''
                    ];

                    $hiitUser = Testuser::create($data);


                    DB::table('points')->insert([
                        'user_id' => $request->user_id,
                        'item_id' => $hiitUser->id,
                        'activity' => 'test_completed',
                        'points' => $request->rewards,
                        'created_at' => Carbon::now()
                    ]);
                }

                if (isset($_FILES['image']) && $_FILES['image']['error'] == UPLOAD_ERR_OK && $request->item_type != 'fundamental' && $request->item_type != 'test') {

                    $image = Image::make($_FILES['image']['tmp_name']);

                    $time = time();

                    $image->encode('jpeg');

                    $image->save(config('image.feedOriginalPath') . 'feed_' . $feed->id . '_' . $time . '.jpg');

                    $image->crop(400, 400);

                    $image->save(config('image.feedLargePath') . 'feed_' . $feed->id . '_' . $time . '.jpg');

                    $image->crop(150, 150);

                    $image->save(config('image.feedMediumPath') . 'feed_' . $feed->id . '_' . $time . '.jpg');

                    $image->crop(65, 65);

                    $image->save(config('image.feedSmallPath') . 'feed_' . $feed->id . '_' . $time . '.jpg');

                    $image_upload = Images::create([
                            'user_id' => $request->input('user_id'),
                            'path' => 'feed_' . $feed->id . '_' . $time . '.jpg',
                            'description' => (isset($request->text) && ($request->text != null)) ? $request->text : '',
                            'parent_type' => 2,
                            'parent_id' => $feed->id
                    ]);

                    Feeds::where('id', $feed->id)->update([
                        'image' => 'feed_' . $feed->id . '_' . $time . '.jpg'
                    ]);

                    if (file_exists($_FILES['image']['tmp_name']) && is_writable($_FILES['image']['tmp_name'])) {
                        unlink($_FILES['image']['tmp_name']);
                    }
                }

                $userLevelAfter = Point::userLevel($user->id);

                if ($userLevelAfter > $userLevelBefore) {

                    //Push Notification
                    $data = [
                        'type' => 'perfomance',
                        'type_id' => $request->user_id,
                        'user_id' => $request->user_id,
                        'friend_id' => $request->user_id,
                        'from_level' => $userLevelBefore,
                        'to_level' => $userLevelAfter,
                    ];

                    PushNotificationFunction::pushNotification($data);
                }

                $feeds = Feeds::with(['user'])->get();

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
     * @apiParam {integer} user_id id of loggedin user *required
     * @apiParam {integer} profile_id id of other user *required
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
      "workout_count": 15,
      "feed_list": [
      {
      "id": 703,
      "user_id": 48,
      "item_type": "hiit_replacement",
      "item_id": 3,
      "feed_text": "Testing HIIT replacements",
      "image": [],
      "created_at": "2016-02-23 13:20:00",
      "updated_at": "2016-02-23 13:20:00",
      "clap_count": 0,
      "comment_count": 0,
      "is_commented": 0,
      "is_claped": 0,
      "item_name": "60/120(Replacement)",
      "duration": 320,
      "intensity": 4,
      "profile": {
      "user_id": 48,
      "first_name": "Aneesh",
      "last_name": "Kallikkattil",
      "image": "",
      "quote": "",
      "gender": 1,
      "level": 2
      }
      },
      {
      "id": "45",
      "user_id": "96",
      "item_type": "hiit",
      "item_id": "1",
      "feed_text": "Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Integer pulvinar suscipit ante vitae ultricies.",
      "created_at": "2016-01-08 06:04:32",
      "updated_at": "2016-01-08 06:04:32",
      "clap_count": 0,
      "comment_count": 0,
      "is_commented": 0,
      "is_claped": 0,
      "image": [
      {
      "id": "68",
      "user_id": "96",
      "path": "96_1452233072.jpg",
      "description": "Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Integer pulvinar suscipit ante vitae ultricies.",
      "parent_type": "2",
      "parent_id": "45",
      "created_at": "2016-01-08 06:04:32",
      "updated_at": "2016-01-08 06:04:32"
      }
      ],
      "item_name": "30/30",
      "duration": "2250.00",
      "intensity": "10"
      },
      {
      "id": "44",
      "user_id": "96",
      "item_type": "hiit",
      "item_id": "3",
      "feed_text": "Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Integer pulvinar suscipit ante vitae ultricies.",
      "created_at": "2016-01-08 06:03:48",
      "updated_at": "2016-01-08 06:03:48",
      "clap_count": 0,
      "comment_count": 0,
      "is_commented": 0,
      "is_claped": 0,
      "image": [],
      "item_name": "60/120",
      "duration": "1500.00",
      "intensity": "5"
      },
      {
      "id": "43",
      "user_id": "96",
      "item_type": "hiit",
      "item_id": "3",
      "feed_text": "Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Integer pulvinar suscipit ante vitae ultricies.",
      "created_at": "2016-01-08 06:03:44",
      "updated_at": "2016-01-08 06:03:44",
      "clap_count": 0,
      "comment_count": 0,
      "is_commented": 0,
      "is_claped": 0,
      "image": [],
      "item_name": "60/120",
      "duration": "1500.00",
      "intensity": "4"
      },
      {
      "id": "42",
      "user_id": "96",
      "item_type": "hiit",
      "item_id": "3",
      "feed_text": "Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Integer pulvinar suscipit ante vitae ultricies.",
      "created_at": "2016-01-08 06:03:37",
      "updated_at": "2016-01-08 06:03:37",
      "clap_count": 0,
      "comment_count": 0,
      "is_commented": 0,
      "is_claped": 0,
      "image": [],
      "item_name": "60/120",
      "duration": "1500.00",
      "intensity": "3"
      },
      {
      "id": "41",
      "user_id": "96",
      "item_type": "hiit",
      "item_id": "2",
      "feed_text": "Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Integer pulvinar suscipit ante vitae ultricies.",
      "created_at": "2016-01-08 06:03:27",
      "updated_at": "2016-01-08 06:03:27",
      "clap_count": 0,
      "comment_count": 0,
      "is_commented": 0,
      "is_claped": 0,
      "image": [],
      "item_name": "20/10",
      "duration": "1500.00",
      "intensity": "8"
      },
      {
      "id": "40",
      "user_id": "96",
      "item_type": "hiit",
      "item_id": "2",
      "feed_text": "Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Integer pulvinar suscipit ante vitae ultricies.",
      "created_at": "2016-01-08 06:03:17",
      "updated_at": "2016-01-08 06:03:17",
      "clap_count": 1,
      "comment_count": 0,
      "is_commented": 0,
      "is_claped": 1,
      "image": [],
      "item_name": "20/10",
      "duration": "1500.00",
      "intensity": "5"
      },
      {
      "id": "39",
      "user_id": "96",
      "item_type": "hiit",
      "item_id": "2",
      "feed_text": "Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Integer pulvinar suscipit ante vitae ultricies.",
      "created_at": "2016-01-08 06:03:10",
      "updated_at": "2016-01-08 06:03:10",
      "clap_count": 2,
      "comment_count": 0,
      "is_commented": 0,
      "is_claped": 1,
      "image": [],
      "item_name": "20/10",
      "duration": "1500.00",
      "intensity": "7"
      },
      {
      "id": "38",
      "user_id": "96",
      "item_type": "hiit",
      "item_id": "1",
      "feed_text": "Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Integer pulvinar suscipit ante vitae ultricies.",
      "created_at": "2016-01-08 06:02:50",
      "updated_at": "2016-01-08 06:02:50",
      "clap_count": 0,
      "comment_count": 0,
      "is_commented": 0,
      "is_claped": 0,
      "image": [],
      "item_name": "30/30",
      "duration": "1500.00",
      "intensity": "4"
      },
      {
      "id": "37",
      "user_id": "96",
      "item_type": "workout",
      "item_id": "15",
      "feed_text": "Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Integer pulvinar suscipit ante vitae ultricies.",
      "created_at": "2016-01-08 05:49:36",
      "updated_at": "2016-01-08 05:49:36",
      "clap_count": 0,
      "comment_count": 0,
      "is_commented": 0,
      "is_claped": 0,
      "image": [
      {
      "id": "67",
      "user_id": "96",
      "path": "96_1452232176.jpg",
      "description": "Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Integer pulvinar suscipit ante vitae ultricies.",
      "parent_type": "2",
      "parent_id": "37",
      "created_at": "2016-01-08 05:49:36",
      "updated_at": "2016-01-08 05:49:36"
      }
      ],
      "category": "HIIT-strength",
      "item_name": "Mimir",
      "duration": "1500",
      "intensity": "2"
      },
      {
      "id": "36",
      "user_id": "96",
      "item_type": "workout",
      "item_id": "9",
      "feed_text": "Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Integer pulvinar suscipit ante vitae ultricies.",
      "created_at": "2016-01-08 05:49:27",
      "updated_at": "2016-01-08 05:49:27",
      "clap_count": 0,
      "comment_count": 0,
      "is_commented": 0,
      "is_claped": 0,
      "image": [
      {
      "id": "66",
      "user_id": "96",
      "path": "96_1452232167.jpg",
      "description": "Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Integer pulvinar suscipit ante vitae ultricies.",
      "parent_type": "2",
      "parent_id": "36",
      "created_at": "2016-01-08 05:49:27",
      "updated_at": "2016-01-08 05:49:27"
      }
      ],
      "category": "HIIT-strength",
      "item_name": "Elli",
      "duration": "1500",
      "intensity": "2"
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
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 422 Validation error
     *     {
     *       "status" : 0,
     *       "error": "The profile_id field is required"
     *     }
     */
    public function userFeeds(Request $request)
    {
        $feedsResponse = array();
        if (!isset($request->user_id) || ($request->user_id == null)) {
            return response()->json(["status" => "0", "error" => "The user_id field is required"]);
        } else if (!isset($request->profile_id) || ($request->profile_id == null)) {
            return response()->json(['status' => 0, 'error' => 'profile_id required']);
        } else {
            $user = User::where('id', '=', $request->input('user_id'))->first();

            $feedQuery = Feeds::where('user_id', '=', $request->input('profile_id'));

            if ($user) {
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
                $followerCount = Follow::followerCount($request->profile_id);
                //workout count
                $workoutCount = Workoutuser::workoutCount($request->profile_id);
                return response()->json([
                        'status' => 1,
                        'success' => 'List',
                        'follower_count' => $followerCount,
                        'level_count' => 0,
                        'workout_count' => $workoutCount,
                        'feed_list' => $this->removeNullfromArray($feedsResponse),
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
     * @apiParam {Number} user_id Id of user *required
     * @apiParam {Number} [offset] offset 
     * @apiParam {Number} [limit] limit
     * @apiSuccess {String} success.
     * @apiSuccessExample Success-Response:
     *     HTTP/1.1 200 OK
     * {
      "status": 1,
      "success": "List",
      "feed_list": [
     * {
      "id": 703,
      "user_id": 48,
      "item_type": "hiit_replacement",
      "item_id": 3,
      "feed_text": "Testing HIIT replacements",
      "image": [],
      "created_at": "2016-02-23 13:20:00",
      "updated_at": "2016-02-23 13:20:00",
      "clap_count": 0,
      "comment_count": 0,
      "is_commented": 0,
      "is_claped": 0,
      "item_name": "60/120(Replacement)",
      "duration": 320,
      "intensity": 4,
      "profile": {
      "user_id": 48,
      "first_name": "Aneesh",
      "last_name": "Kallikkattil",
      "image": "",
      "quote": "",
      "gender": 1,
      "level": 2
      }
      },
      {
      "id": "1167",
      "user_id": "130",
      "item_type": "workout",
      "item_id": "9",
      "feed_text": " ",
      "image": "",
      "created_at": "2016-04-07 11:16:49",
      "updated_at": "2016-04-07 11:16:49",
      "clap_count": 0,
      "comment_count": 0,
      "is_commented": 0,
      "is_claped": 0,
      "category": "HIIT-strength",
      "item_name": "Elli",
      "duration": "3",
      "workout_rounds": "3",
      "intensity": "1",
      "focus": "Athletic",
      "profile": {
      "user_id": "130",
      "first_name": "test",
      "last_name": "user 2",
      "image": "130_1460027861.jpg",
      "quote": "",
      "gender": "1",
      "level": 3
      }
      },
      {
      "id": "233",
      "user_id": "84",
      "item_type": "exercise",
      "item_id": "2",
      "feed_text": "How hard was your Training? what kept you going?",
      "created_at": "2016-01-20 04:53:55",
      "updated_at": "2016-01-20 04:53:55",
      "clap_count": 0,
      "comment_count": 0,
      "is_commented": 0,
      "is_claped": 0,
      "image": [],
      "category": "Lean",
      "item_name": "Australian Pullups",
      "duration": "8",
      "intensity": "1",
      "unit": "times",
      "profile": {
      "user_id": "84",
      "first_name": "Aneesh",
      "last_name": "ILeaf",
      "image": "84_1453206435.jpg",
      "quote": "new things",
      "level": 7
      }
      },
      {
      "id": "232",
      "user_id": "84",
      "item_type": "exercise",
      "item_id": "43",
      "feed_text": "How hard was your Training? what kept you going?",
      "created_at": "2016-01-20 04:53:16",
      "updated_at": "2016-01-20 04:53:16",
      "clap_count": 0,
      "comment_count": 0,
      "is_commented": 0,
      "is_claped": 0,
      "image": [],
      "category": "Athletic",
      "item_name": "Pushups",
      "duration": "2",
      "intensity": "1",
      "unit": "times",
      "profile": {
      "user_id": "84",
      "first_name": "Aneesh",
      "last_name": "ILeaf",
      "image": "84_1453206435.jpg",
      "quote": "new things",
      "level": 7
      }
      },
      {
      "id": "231",
      "user_id": "86",
      "item_type": "exercise",
      "item_id": "43",
      "feed_text": "Hai",
      "created_at": "2016-01-20 04:37:20",
      "updated_at": "2016-01-20 04:37:20",
      "clap_count": 0,
      "comment_count": 0,
      "is_commented": 0,
      "is_claped": 0,
      "image": [],
      "category": "Athletic",
      "item_name": "Pushups",
      "duration": "5",
      "intensity": "1",
      "unit": "times",
      "profile": {
      "user_id": "86",
      "first_name": "Vinish",
      "last_name": "Tester",
      "image": "86_1452668192.jpg",
      "quote": "how are you?",
      "level": 18
      }
      },
      {
      "id": "230",
      "user_id": "86",
      "item_type": "exercise",
      "item_id": "17",
      "feed_text": "Ok",
      "created_at": "2016-01-19 13:48:39",
      "updated_at": "2016-01-19 13:48:39",
      "clap_count": 1,
      "comment_count": 0,
      "is_commented": 0,
      "is_claped": 1,
      "image": [],
      "category": "Lean",
      "item_name": "Plank",
      "duration": "1",
      "intensity": "1",
      "unit": "seconds",
      "profile": {
      "user_id": "86",
      "first_name": "Vinish",
      "last_name": "Tester",
      "image": "86_1452668192.jpg",
      "quote": "how are you?",
      "level": 18
      }
      },
      {
      "id": "229",
      "user_id": "86",
      "item_type": "exercise",
      "item_id": "1",
      "feed_text": "How hard was your Training? what kept you going?",
      "created_at": "2016-01-19 13:48:04",
      "updated_at": "2016-01-19 13:48:04",
      "clap_count": 0,
      "comment_count": 0,
      "is_commented": 0,
      "is_claped": 0,
      "image": [],
      "category": "Lean",
      "item_name": "Jumping Pullups",
      "duration": "3",
      "intensity": "10",
      "unit": "times",
      "profile": {
      "user_id": "86",
      "first_name": "Vinish",
      "last_name": "Tester",
      "image": "86_1452668192.jpg",
      "quote": "how are you?",
      "level": 18
      }
      },
      {
      "id": "228",
      "user_id": "86",
      "item_type": "exercise",
      "item_id": "40",
      "feed_text": "How hard was your Training? what kept you going?",
      "created_at": "2016-01-19 13:47:35",
      "updated_at": "2016-01-19 13:47:35",
      "clap_count": 0,
      "comment_count": 0,
      "is_commented": 0,
      "is_claped": 0,
      "image": [],
      "category": "Athletic",
      "item_name": "Lunge",
      "duration": "3",
      "intensity": "1",
      "unit": "times",
      "profile": {
      "user_id": "86",
      "first_name": "Vinish",
      "last_name": "Tester",
      "image": "86_1452668192.jpg",
      "quote": "how are you?",
      "level": 18
      }
      },
      {
      "id": "227",
      "user_id": "86",
      "item_type": "exercise",
      "item_id": "2",
      "feed_text": "How hard was your Training? what kept you going?",
      "created_at": "2016-01-19 13:46:59",
      "updated_at": "2016-01-19 13:46:59",
      "clap_count": 0,
      "comment_count": 0,
      "is_commented": 0,
      "is_claped": 0,
      "image": [],
      "category": "Lean",
      "item_name": "Australian Pullups",
      "duration": "2",
      "intensity": "1",
      "unit": "times",
      "profile": {
      "user_id": "86",
      "first_name": "Vinish",
      "last_name": "Tester",
      "image": "86_1452668192.jpg",
      "quote": "how are you?",
      "level": 18
      }
      },
      {
      "id": "226",
      "user_id": "86",
      "item_type": "exercise",
      "item_id": "43",
      "feed_text": "How hard was your Training? what kept you going?",
      "created_at": "2016-01-19 13:46:23",
      "updated_at": "2016-01-19 13:46:23",
      "clap_count": 1,
      "comment_count": 0,
      "is_commented": 0,
      "is_claped": 0,
      "image": [],
      "category": "Athletic",
      "item_name": "Pushups",
      "duration": "0",
      "intensity": "1",
      "unit": "times",
      "profile": {
      "user_id": "86",
      "first_name": "Vinish",
      "last_name": "Tester",
      "image": "86_1452668192.jpg",
      "quote": "how are you?",
      "level": 18
      }
      },
      {
      "id": "1133",
      "user_id": "67",
      "item_type": "workout",
      "item_id": "2",
      "feed_text": "hcjgg",
      "image": "",
      "created_at": "2016-03-31 17:19:28",
      "updated_at": "2016-03-31 17:19:28",
      "clap_count": 0,
      "comment_count": 0,
      "is_commented": 0,
      "is_claped": 0,
      "category": "HIIT-strength",
      "item_name": "Borr",
      "duration": "8",
      "workout_rounds": "3",
      "is_coach": 1,
      "coach_workout_rounds": "1",
      "focus": "Athletic",
      "profile": {
      "user_id": "67",
      "first_name": "Aneesh",
      "last_name": "iL",
      "image": "67_1457647007.jpg",
      "quote": "",
      "gender": "2",
      "level": 36
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
                        $query->select('follow_id')
                            ->from('follows')
                            ->where('user_id', $request->user_id);
                    });

                $feedQuery->orWhere('user_id', 1);
                $feedQuery->orWhere('user_id', $request->user_id);
                $feedQuery->with(['profile']);

                if ($request->offset != null && $request->limit != null) {
                    $feedQuery->skip($request->input('limit'));
                    $feedQuery->take($request->input('offset'));
                }

                $feedQuery->orderBy('created_at', 'DESC');
                $feeds = $feedQuery->get();
                if (count($feeds) > 0) {
                    $feedsResponse = $this->AdditionalFeedsDetails($feeds, $request->user_id);
                }
                return response()->json(['status' => 1, 'success' => 'List', 'feed_list' => $this->removeNullfromArray($feedsResponse), 'urls' => config('urls.urls')], 200);
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


            $feedsArray['image'] = Images::where('parent_id', $feedsArray['id'])->where('parent_type', '=', 2)->get();

            //To get Category
            if ($feedsArray['item_type'] == 'workout') {

                $workout = Workout::where('id', '=', $feedsArray['item_id'])->first();

                if (!is_null($workout)) {
                    if ($workout->category == 1) {
                        $feedsArray['category'] = "Strength";
                    } elseif ($workout->category == 2) {
                        $feedsArray['category'] = "HIIT-strength";
                    }
                } else {
                    $feedsArray['category'] = "";
                }
                $feedsArray['item_name'] = $workout->name;

                $workoutUser = DB::table('workout_users')
                    ->where('feed_id', $feedsArray['id'])
                    ->first();

                if (!is_null($workoutUser->time)) {
                    $feedsArray['duration'] = $workoutUser->time;
                } else {
                    $feedsArray['duration'] = 0;
                }

                $feedsArray['workout_rounds'] = $workout->rounds;
                if ($workoutUser->is_coach == 1) {
                    $feedsArray['is_coach'] = 1;
                    $feedsArray['coach_workout_rounds'] = $workoutUser->coach_rounds;

                    if ($workoutUser->coach_rounds == $workout->rounds) {
                        $feedsArray['intensity'] = 1;
                    } elseif ($workoutUser->coach_rounds > $workout->rounds) {
                        if (($workoutUser->coach_rounds % $workout->rounds) == 0) {
                            $feedsArray['intensity'] = $workoutUser->coach_rounds / $workout->rounds;
                        } else {
                            $feedsArray['intensity'] = ($workoutUser->coach_rounds / $workout->rounds) + 1;
                        }
                    }
                } else {
                    $feedsArray['intensity'] = $workoutUser->volume;
                }
                if (isset($workoutUser->focus) && $workoutUser->focus > 0) {
                    if ($workoutUser->focus == 1) {
                        $feedsArray['focus'] = 'Lean';
                    } elseif ($workoutUser->focus == 2) {
                        $feedsArray['focus'] = 'Athletic';
                    } elseif ($workoutUser->focus == 3) {
                        $feedsArray['focus'] = 'Strong';
                    }
                }
            } elseif ($feedsArray['item_type'] == 'exercise') {

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
                $feedsArray['item_name'] = $exercise->name;

                $exerciseUser = DB::table('exercise_users')
                    ->where('feed_id', $feedsArray['id'])
                    ->first();

                if (!is_null($exerciseUser->time)) {
                    $feedsArray['duration'] = $exerciseUser->time;
                } else {
                    $feedsArray['duration'] = 0;
                }

                $feedsArray['intensity'] = $exerciseUser->volume;

                $feedsArray['unit'] = $exercise->unit;

                $feedsArray['is_static'] = $exercise->is_static;
            } elseif ($feedsArray['item_type'] == 'hiit' || $feedsArray['item_type'] == 'hiit_replacement') {

                $hiit = Hiit::where('id', '=', $feedsArray['item_id'])->first();
                if ($feedsArray['item_type'] == 'hiit_replacement') {
                    $feedsArray['item_name'] = $hiit->name . '(Replacement)';
                } else {
                    $feedsArray['item_name'] = $hiit->name;
                }


                $hiitUser = DB::table('hiit_users')
                    ->where('feed_id', $feedsArray['id'])
                    ->first();

                if (!is_null($hiitUser->time)) {
                    $feedsArray['duration'] = $hiitUser->time;
                } else {
                    $feedsArray['duration'] = 0;
                }

                $feedsArray['intensity'] = $hiitUser->volume;
            } elseif ($feedsArray['item_type'] == 'freestyle') {
                $feedsArray['item_name'] = 'Freestyle';

                $freestyleUser = DB::table('freestyle_users')
                    ->where('feed_id', $feedsArray['id'])
                    ->first();

                if (!is_null($freestyleUser)) {
                    $feedsArray['duration'] = $freestyleUser->time;
                } else {
                    $feedsArray['duration'] = 0;
                }

                $feedsArray['intensity'] = $freestyleUser->volume;
            } elseif ($feedsArray['item_type'] == 'knowledge') {
                $feedsArray['category'] = "";
                $feedsArray['item_name'] = "Knowledge";
            } elseif ($feedsArray['item_type'] == 'test') {

                $hiitUser = DB::table('test_users')
                    ->where('feed_id', $feedsArray['id'])
                    ->first();

                if ($hiitUser->test_id == 1) {
                    $feedsArray['item_name'] = 'Fitness test MK1';
                } else {
                    $feedsArray['item_name'] = 'Fitness test MK2';
                }

                if (!is_null($hiitUser->time)) {
                    $feedsArray['duration'] = $hiitUser->time;
                } else {
                    $feedsArray['duration'] = 0;
                }

                $feedsArray['intensity'] = $hiitUser->volume;
            } else {
                $feedsArray['category'] = "";
                $feedsArray['item_name'] = "";
            }

            $feedsResponse[] = $feedsArray;
            unset($feedsArray);
        }
        return $feedsResponse;
    }

    /**
     * @api {post} /feeds/feedDetails feedDetails
     * @apiName feedDetails
     * @apiGroup Feeds
     * @apiParam {Number} user_id Id of user *required
     * @apiParam {Number} feed_id feed_id *required
     * @apiSuccess {String} success.
     * @apiSuccessExample Success-Response:
     * HTTP/1.1 200 OK
     * {
      "id": "1133",
      "user_id": "67",
      "item_type": "workout",
      "item_id": "2",
      "feed_text": "hcjgg",
      "image": "",
      "created_at": "2016-03-31 17:19:28",
      "updated_at": "2016-03-31 17:19:28",
      "clap_count": 0,
      "comment_count": 0,
      "is_commented": 0,
      "is_claped": 0,
      "category": "HIIT-strength",
      "item_name": "Borr",
      "duration": "8",
      "workout_rounds": "3",
      "is_coach": 1,
      "coach_workout_rounds": "1",
      "focus": "Athletic",
      "profile": {
      "user_id": "67",
      "first_name": "Aneesh",
      "last_name": "iL",
      "image": "67_1457647007.jpg",
      "quote": "",
      "gender": "2",
      "level": 36
      }
      }
      ],
      "urls": {
      "profileImageSmall": "http://ykings.me/uploads/images/profile/small",
      "profileImageMedium": "http://ykings.me/uploads/images/profile/medium",
      "profileImageLarge": "http://ykings.me/uploads/images/profile/large",
      "profileImageOriginal": "http://ykings.me/uploads/images/profile/original",
      "video": "http://ykings.me/uploads/videos",
      "videothumbnail": "http://ykings.me/uploads/images/videothumbnails",
      "feedImageSmall": "http://ykings.me/uploads/images/feed/small",
      "feedImageMedium": "http://ykings.me/uploads/images/feed/medium",
      "feedImageLarge": "http://ykings.me/uploads/images/feed/large",
      "feedImageOriginal": "http://ykings.me/uploads/images/feed/original",
      "coverImageSmall": "http://ykings.me/uploads/images/cover_image/small",
      "coverImageMedium": "http://ykings.me/uploads/images/cover_image/medium",
      "coverImageLarge": "http://ykings.me/uploads/images/cover_image/large",
      "coverImageOriginal": "http://ykings.me/uploads/images/cover_image/original"
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

                    //To get Category
                    if ($feedsArray['item_type'] == 'workout') {

                        $workout = Workout::where('id', '=', $feedsArray['item_id'])->first();

                        if (!is_null($workout)) {
                            if ($workout->category == 1) {
                                $feedsArray['category'] = "Strength";
                            } elseif ($workout->category == 2) {
                                $feedsArray['category'] = "HIIT-strength";
                            }
                        } else {
                            $feedsArray['category'] = "";
                        }
                        $feedsArray['item_name'] = $workout->name;

                        $workoutUser = DB::table('workout_users')
                            ->where('feed_id', $feedsArray['id'])
                            ->first();

                        if (!is_null($workoutUser->time)) {
                            $feedsArray['duration'] = $workoutUser->time;
                        } else {
                            $feedsArray['duration'] = 0;
                        }

                        $feedsArray['workout_rounds'] = $workout->rounds;
                        if ($workoutUser->is_coach == 1) {
                            $feedsArray['is_coach'] = 1;
                            $feedsArray['coach_workout_rounds'] = $workoutUser->coach_rounds;

                            if ($workoutUser->coach_rounds == $workout->rounds) {
                                $feedsArray['intensity'] = 1;
                            } elseif ($workoutUser->coach_rounds > $workout->rounds) {
                                if (($workoutUser->coach_rounds % $workout->rounds) == 0) {
                                    $feedsArray['intensity'] = $workoutUser->coach_rounds / $workout->rounds;
                                } else {
                                    $feedsArray['intensity'] = ($workoutUser->coach_rounds / $workout->rounds) + 1;
                                }
                            }
                        } else {
                            $feedsArray['intensity'] = $workoutUser->volume;
                        }
                        if (isset($workoutUser->focus) && $workoutUser->focus > 0) {
                            if ($workoutUser->focus == 1) {
                                $feedsArray['focus'] = 'Lean';
                            } elseif ($workoutUser->focus == 2) {
                                $feedsArray['focus'] = 'Athletic';
                            } elseif ($workoutUser->focus == 3) {
                                $feedsArray['focus'] = 'Strong';
                            }
                        }
                    } elseif ($feedsArray['item_type'] == 'exercise') {

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
                        $feedsArray['item_name'] = $exercise->name;

                        $exerciseUser = DB::table('exercise_users')
                            ->where('feed_id', $feedsArray['id'])
                            ->first();

                        if (!is_null($exerciseUser->time)) {
                            $feedsArray['duration'] = $exerciseUser->time;
                        } else {
                            $feedsArray['duration'] = 0;
                        }

                        $feedsArray['intensity'] = $exerciseUser->volume;

                        $feedsArray['unit'] = $exercise->unit;
                        $feedsArray['is_static'] = $exercise->is_static;
                    } elseif ($feedsArray['item_type'] == 'hiit' || $feedsArray['item_type'] == 'hiit_replacement') {

                        $hiit = Hiit::where('id', '=', $feedsArray['item_id'])->first();
                        if ($feedsArray['item_type'] == 'hiit_replacement') {
                            $feedsArray['item_name'] = $hiit->name . '(Replacement)';
                        } else {
                            $feedsArray['item_name'] = $hiit->name;
                        }

                        $hiitUser = DB::table('hiit_users')
                            ->where('feed_id', $feedsArray['id'])
                            ->first();

                        if (!is_null($hiitUser->time)) {
                            $feedsArray['duration'] = $hiitUser->time;
                        } else {
                            $feedsArray['duration'] = 0;
                        }

                        $feedsArray['intensity'] = $hiitUser->volume;
                    } elseif ($feedsArray['item_type'] == 'freestyle') {
                        $feedsArray['item_name'] = 'Freestyle';

                        $freestyleUser = DB::table('freestyle_users')
                            ->where('feed_id', $feedsArray['id'])
                            ->first();

                        if (!is_null($freestyleUser)) {
                            $feedsArray['duration'] = $freestyleUser->time;
                        } else {
                            $feedsArray['duration'] = 0;
                        }

                        $feedsArray['intensity'] = $freestyleUser->volume;
                    } elseif ($feedsArray['item_type'] == 'knowledge') {
                        $feedsArray['category'] = "";
                        $feedsArray['item_name'] = "Knowledge";
                    } elseif ($feedsArray['item_type'] == 'test') {
                        $hiitUser = DB::table('test_users')
                            ->where('feed_id', $feedsArray['id'])
                            ->first();

                        if ($hiitUser->test_id == 1) {
                            $feedsArray['item_name'] = 'Fitness test MK1';
                        } else {
                            $feedsArray['item_name'] = 'Fitness test MK2';
                        }

                        if (!is_null($hiitUser->time)) {
                            $feedsArray['duration'] = $hiitUser->time;
                        } else {
                            $feedsArray['duration'] = 0;
                        }

                        $feedsArray['intensity'] = $hiitUser->volume;
                    } else {
                        $feedsArray['category'] = "";
                        $feedsArray['item_name'] = "";
                    }
                    $feedsResponse[] = $feedsArray;
                }
                return response()->json(['status' => 1, 'success' => 'Details', 'feed_details' => $this->removeNullfromArray($feedsResponse), 'urls' => config('urls.urls')], 200);
            } else {
                return response()->json(['status' => 0, 'error' => 'user_not_exists'], 500);
            }
        }
    }

    /**
     * @api {post} /feeds/clap clapFeed
     * @apiName clapFeed
     * @apiGroup Feeds
     * @apiParam {Number} user_id Id of user *required 
     * @apiParam {Number} feed_id feed_id *required
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

                    //Push Notification
                    $data = [
                        'type' => 'clap',
                        'type_id' => $request->input('feed_id'),
                        'user_id' => $request->user_id,
                        'friend_id' => $feed->user_id
                    ];
                    PushNotificationFunction::pushNotification($data);
                }

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
     * @apiParam {Number} user_id Id of user *required
     * @apiParam {Number} feed_id feed_id *required
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
                    //Push Notification
                    $request = [
                        'type' => 'unclap',
                        'type_id' => $request->input('feed_id'),
                        'user_id' => $request->user_id,
                        'friend_id' => $feed->user_id
                    ];
                    return response()->json(['status' => 1, 'success' => 'unclaped'], 200);
                } else {
                    return response()->json(['status' => 0, 'error' => 'not_yet_claped'], 422);
                }
            } else {
                return response()->json(['status' => 0, 'error' => 'feed_not_exists'], 422);
            }
        }
    }

    /**
     * Method to remove null from response string(It will complecate the development on Ios)
     * @param type $array
     * @return type
     * @author Aneesh K<aneeshk@cubettech.com>
     * @since 7th March, 2016
     */
    public function removeNullfromArray($array)
    {
        if (is_object($array)) {
            $jsonString = json_encode($array);

            $jsonString = str_replace('null,', '"",', $jsonString);

            return json_decode($jsonString);
        } elseif (is_array($array)) {
            $jsonString = json_encode($array);

            $jsonString = str_replace('null,', '"",', $jsonString);

            return json_decode($jsonString, true);
        }
    }
}
