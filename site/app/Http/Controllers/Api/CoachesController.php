<?php namespace App\Http\Controllers\Api;

use Auth,
    DB;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\User;
use App\Exercise;
use App\Exerciseuser;
use App\Coach;
use Carbon\Carbon;

class CoachesController extends Controller
{
    /*
      |--------------------------------------------------------------------------
      | Exercises Controller
      |--------------------------------------------------------------------------
      |
      | This controller handles coaches and Algorithm.
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
     * @api {post} /coach/get getCoach
     * @apiName getCoach
     * @apiGroup Coach
     * @apiParam {Number} user_id Id of user 
     * @apiSuccess {String} success.
     * @apiSuccessExample Success-Response:
     * HTTP/1.1 200 OK
     * 
     * @apiError error Message token_invalid.
     * @apiError error Message token_expired.
     * @apiError error Message token_not_provided.
     * @apiError error Message Validation error
     * @apiError error Message user_not_exists
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
     *     HTTP/1.1 422 Validation error
     *     {
     *       "status" : 0,
     *       "error": "The user_id field is required"
     *     }
     * 
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 500 user_not_exists
     *     {
     *       "status" : 0,
     *       "error": "user_not_exists"
     *     }
     * 
     */
    public function getCoach(Request $request)
    {
        if (!isset($request->user_id) || ($request->user_id == null)) {
            return response()->json(["status" => "0", "error" => "The user_id field is required"]);
        } else {
            $user = User::where('id', '=', $request->input('user_id'))->first();
            if (!is_null($user)) {
                $coach = [];
                return response()->json([
                        'status' => 1,
                        'coach' => $coach,
                        'is_subscribed' => $user->is_subscribed,
                        'urls' => config('urls.urls')], 200);
            } else {
                return response()->json(['status' => 0, 'error' => 'user_not_exists'], 500);
            }
        }
    }

    /**
     * @api {post} /coach/getFundumentals getFundumentals
     * @apiName getFundumentals
     * @apiGroup Coach
     * @apiParam {Number} user_id Id of user *mandatory
     * @apiSuccess {String} success.
     * @apiSuccessExample Success-Response:
     * HTTP/1.1 200 OK
     * {
      "status": 1,
      "tests": {
      "1": [
      {
      "exercise_id": 43,
      "duration": 10,
      "exercise": {
      "id": "43",
      "name": "Pushups",
      "description": "",
      "category": "2",
      "type": "1",
      "rewards": "6.00",
      "repititions": "10",
      "duration": "1.00",
      "unit": "times",
      "equipment": "",
      "video": [
      {
      "id": "43",
      "path": "Now43.mp4",
      "videothumbnail": "thumbnail3.jpg",
      "description": "Test Description"
      }
      ]
      }
      },
      {
      "exercise_id": 2,
      "duration": 10,
      "exercise": {
      "id": "2",
      "name": "Australian Pullups",
      "description": "Australian pull-ups are becoming a very popular exercise. Like all types of pull-ups (and all types of exercises for that matter) there are many different ways to do the Australian, and it can be incorporated into a number of different contexts within a workout.",
      "category": "1",
      "type": "2",
      "rewards": "6.00",
      "repititions": "10",
      "duration": "1.00",
      "unit": "times",
      "equipment": "",
      "video": [
      {
      "id": "2",
      "path": "Now2.mp4",
      "videothumbnail": "thumbnail1.png",
      "description": "Test Description"
      }
      ]
      }
      },
      {
      "exercise_id": 40,
      "duration": 15,
      "exercise": {
      "id": "40",
      "name": "Lunge",
      "description": "",
      "category": "2",
      "type": "2",
      "rewards": "6.00",
      "repititions": "10",
      "duration": "1.00",
      "unit": "times",
      "equipment": "",
      "video": [
      {
      "id": "40",
      "path": "Now40.mp4",
      "videothumbnail": "thumbnail3.jpg",
      "description": "Test Description"
      }
      ]
      }
      },
      {
      "exercise_id": 17,
      "duration": 15,
      "exercise": {
      "id": "17",
      "name": "Plank",
      "description": "",
      "category": "1",
      "type": "1",
      "rewards": "6.00",
      "repititions": "10",
      "duration": "1.00",
      "unit": "times",
      "equipment": "",
      "video": [
      {
      "id": "17",
      "path": "Now17.mp4",
      "videothumbnail": "thumbnail1.png",
      "description": "Test Description"
      }
      ]
      }
      }
      ],
      "2": [
      {
      "exercise_id": 43,
      "duration": 30,
      "exercise": {
      "id": "43",
      "name": "Pushups",
      "description": "",
      "category": "2",
      "type": "1",
      "rewards": "6.00",
      "repititions": "10",
      "duration": "1.00",
      "unit": "times",
      "equipment": "",
      "video": [
      {
      "id": "43",
      "path": "Now43.mp4",
      "videothumbnail": "thumbnail3.jpg",
      "description": "Test Description"
      }
      ]
      }
      },
      {
      "exercise_id": 32,
      "duration": 10,
      "exercise": {
      "id": "32",
      "name": "Pull ups / Chin ups",
      "description": "",
      "category": "2",
      "type": "1",
      "rewards": "6.00",
      "repititions": "10",
      "duration": "1.00",
      "unit": "times",
      "equipment": "",
      "video": [
      {
      "id": "32",
      "path": "Now32.mp4",
      "videothumbnail": "thumbnail1.png",
      "description": "Test Description"
      }
      ]
      }
      },
      {
      "exercise_id": 38,
      "duration": 25,
      "exercise": {
      "id": "38",
      "name": "Squats",
      "description": "",
      "category": "2",
      "type": "1",
      "rewards": "6.00",
      "repititions": "10",
      "duration": "1.00",
      "unit": "times",
      "equipment": "",
      "video": [
      {
      "id": "38",
      "path": "Now38.mp4",
      "videothumbnail": "thumbnail1.png",
      "description": "Test Description"
      }
      ]
      }
      }
      ]
      },
      "is_subscribed": 0,
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
     * @apiError error Message token_invalid.
     * @apiError error Message token_expired.
     * @apiError error Message token_not_provided.
     * @apiError error Message Validation error
     * @apiError error Message user_not_exists
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
     *     HTTP/1.1 422 Validation error
     *     {
     *       "status" : 0,
     *       "error": "The user_id field is required"
     *     }
     * 
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 500 user_not_exists
     *     {
     *       "status" : 0,
     *       "error": "user_not_exists"
     *     }
     * 
     */
    public function getFundumentals(Request $request)
    {
        $fundumentalArray = [
            1 => [
                ['exercise_id' => 43, 'duration' => 10],
                ['exercise_id' => 2, 'duration' => 10],
                ['exercise_id' => 40, 'duration' => 15],
                ['exercise_id' => 17, 'duration' => 15]],
            2 => [
                ['exercise_id' => 43, 'duration' => 30],
                ['exercise_id' => 32, 'duration' => 10],
                ['exercise_id' => 38, 'duration' => 25]],
        ];
        if (!isset($request->user_id) || ($request->user_id == null)) {
            return response()->json(["status" => "0", "error" => "The user_id field is required"]);
        } else {
            $user = User::where('id', '=', $request->input('user_id'))->first();
            if (!is_null($user)) {
                foreach ($fundumentalArray as $iKey => $fundumental) {
                    foreach ($fundumental as $jKey => $iVal) {
                        $fundumentalArray[$iKey][$jKey]['exercise'] = Exercise::where('id', $iVal['exercise_id'])->with(['video'])->first();
                    }
                }
                return response()->json([
                        'status' => 1,
                        'tests' => $fundumentalArray,
                        'is_subscribed' => $user->is_subscribed,
                        'urls' => config('urls.urls')], 200);
            } else {
                return response()->json(['status' => 0, 'error' => 'user_not_exists'], 500);
            }
        }
    }

    /**
     * @api {post} /coach/getdescription getDescription
     * @apiName getDescription
     * @apiGroup Coach
     * @apiParam {Number} user_id Id of user *mandatory
     * @apiSuccess {String} success.
     * @apiSuccessExample Success-Response:
     * HTTP/1.1 200 OK
     * {
      "status": 1,
      "descriptions": {
      "1": "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas in faucibus orci. Nunc et lorem libero. Nulla facilisi. Nunc dictum, sapien ut tincidunt ultrices, dui nunc auctor velit, ac porta lacus turpis non massa. Quisque nec vestibulum risus, quis consequat lectus. Curabitur dignissim risus ac velit tincidunt dignissim. Mauris nec risus eget felis mollis tincidunt. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. In suscipit blandit bibendum. Nulla venenatis sed libero at ornare. Interdum et malesuada fames ac ante ipsum primis in faucibus. ",
      "2": "Vestibulum rutrum efficitur vulputate. Mauris quam turpis, pellentesque sed mauris eget, imperdiet scelerisque libero. Sed vitae leo id massa consectetur vestibulum ut ac tellus. Nam luctus nisl at leo sagittis condimentum. Duis malesuada, nisl sit amet tincidunt sollicitudin, turpis leo aliquam eros, eu aliquam felis massa id urna. Suspendisse potenti. Curabitur sodales accumsan varius. Aenean nulla sem, consectetur sed ex sed, vestibulum iaculis felis. Suspendisse neque eros, sagittis quis pulvinar a, porta id est. Curabitur diam massa, semper et pretium vitae, commodo ut ligula. Sed venenatis imperdiet suscipit. Nam egestas ante vitae augue sodales consectetur. Ut vel molestie dolor. Nam lorem nibh, maximus vitae urna eget, interdum aliquam libero. Suspendisse ut metus justo. Mauris hendrerit pulvinar orci, at efficitur odio porta ut. ",
      "3": "Nullam sit amet eros nec nibh feugiat scelerisque vitae in ante. Mauris eu hendrerit eros. In et risus vel purus pharetra mollis quis sed tellus. Sed ut libero posuere risus aliquam consectetur non ac dui. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed maximus lobortis nulla ut elementum. Aliquam vel accumsan leo. In sagittis enim scelerisque dolor dictum tristique. Donec mattis ut turpis id finibus. Nullam ac imperdiet nisi. In accumsan massa id magna imperdiet eleifend. Donec tempor blandit lacinia. Nulla vitae ligula sit amet est luctus vehicula. "
      }
      }
     * 
     * @apiError error Message token_invalid.
     * @apiError error Message token_expired.
     * @apiError error Message token_not_provided.
     * @apiError error Message Validation error
     * @apiError error Message user_not_exists
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
     *     HTTP/1.1 422 Validation error
     *     {
     *       "status" : 0,
     *       "error": "The user_id field is required"
     *     }
     * 
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 500 user_not_exists
     *     {
     *       "status" : 0,
     *       "error": "user_not_exists"
     *     }
     * 
     */
    public function getDescription(Request $request)
    {
        if (!isset($request->user_id) || ($request->user_id == null)) {
            return response()->json(["status" => "0", "error" => "The user_id field is required"]);
        } else {
            $user = User::where('id', '=', $request->input('user_id'))->first();
            if (!is_null($user)) {
                $description = DB::table('site_settings')->select('value')->where('key', 'coach_description')->first();
                return response()->json([
                        'status' => 1,
                        'descriptions' => json_decode($description->value, true)], 200);
            } else {
                return response()->json(['status' => 0, 'error' => 'user_not_exists'], 500);
            }
        }
    }
    
    /**
     * @api {post} /coach/preparecoach prepareCoach
     * @apiName prepareCoach
     * @apiGroup Coach
     * @apiParam {Number} user_id Id of user *mandatory
     * @apiParam {Number} user_id Id of user *mandatory
     * @apiSuccess {String} success.
     * @apiSuccessExample Success-Response:
     * HTTP/1.1 200 OK
     * {
      "status": 1,
      "descriptions": {
      "1": "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas in faucibus orci. Nunc et lorem libero. Nulla facilisi. Nunc dictum, sapien ut tincidunt ultrices, dui nunc auctor velit, ac porta lacus turpis non massa. Quisque nec vestibulum risus, quis consequat lectus. Curabitur dignissim risus ac velit tincidunt dignissim. Mauris nec risus eget felis mollis tincidunt. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. In suscipit blandit bibendum. Nulla venenatis sed libero at ornare. Interdum et malesuada fames ac ante ipsum primis in faucibus. ",
      "2": "Vestibulum rutrum efficitur vulputate. Mauris quam turpis, pellentesque sed mauris eget, imperdiet scelerisque libero. Sed vitae leo id massa consectetur vestibulum ut ac tellus. Nam luctus nisl at leo sagittis condimentum. Duis malesuada, nisl sit amet tincidunt sollicitudin, turpis leo aliquam eros, eu aliquam felis massa id urna. Suspendisse potenti. Curabitur sodales accumsan varius. Aenean nulla sem, consectetur sed ex sed, vestibulum iaculis felis. Suspendisse neque eros, sagittis quis pulvinar a, porta id est. Curabitur diam massa, semper et pretium vitae, commodo ut ligula. Sed venenatis imperdiet suscipit. Nam egestas ante vitae augue sodales consectetur. Ut vel molestie dolor. Nam lorem nibh, maximus vitae urna eget, interdum aliquam libero. Suspendisse ut metus justo. Mauris hendrerit pulvinar orci, at efficitur odio porta ut. ",
      "3": "Nullam sit amet eros nec nibh feugiat scelerisque vitae in ante. Mauris eu hendrerit eros. In et risus vel purus pharetra mollis quis sed tellus. Sed ut libero posuere risus aliquam consectetur non ac dui. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed maximus lobortis nulla ut elementum. Aliquam vel accumsan leo. In sagittis enim scelerisque dolor dictum tristique. Donec mattis ut turpis id finibus. Nullam ac imperdiet nisi. In accumsan massa id magna imperdiet eleifend. Donec tempor blandit lacinia. Nulla vitae ligula sit amet est luctus vehicula. "
      }
      }
     * 
     * @apiError error Message token_invalid.
     * @apiError error Message token_expired.
     * @apiError error Message token_not_provided.
     * @apiError error Message Validation error
     * @apiError error Message user_not_exists
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
     *     HTTP/1.1 422 Validation error
     *     {
     *       "status" : 0,
     *       "error": "The user_id field is required"
     *     }
     * 
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 500 user_not_exists
     *     {
     *       "status" : 0,
     *       "error": "user_not_exists"
     *     }
     * 
     */
    public function prepareCoach(Request $request)
    {
        if (!isset($request->user_id) || ($request->user_id == null)) {
            return response()->json(["status" => "0", "error" => "The user_id field is required"]);
        } else {
            $user = User::where('id', '=', $request->input('user_id'))->first();
            if (!is_null($user)) {
                
            } else {
                return response()->json(['status' => 0, 'error' => 'user_not_exists'], 500);
            }
        }
        
    }
}
