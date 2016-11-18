<?php namespace App\Http\Controllers\Api;

use Auth,
    Validator,
    DB;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\User;
use App\Feeds;
use App\Exercise;
use App\Exerciseuser;
use App\Skilltraining;
use App\Skilltrainingexercise;
use App\Skilltraininguser;

class SkilltrainingsController extends Controller
{
    /*
      |--------------------------------------------------------------------------
      | SkilltrainingsController Controller
      |--------------------------------------------------------------------------
      |
      | This controller handles skill trainings, user skill trainings.
      |
     */

    /**
     * 
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('jwt.auth');
    }

    /**
     * @api {post} /skilltraining/list loadSkilltrainings
     * @apiName loadSkilltrainings
     * @apiGroup Skilltraining
     * @apiParam {Number} user_id Id of user *required
     * @apiSuccess {String} success.
     * @apiSuccessExample Success-Response:
     * HTTP/1.1 200 OK
     * {
      "status": 1,
      "is_subscribed": 1,
      "skilltrainings": [
      {
      "id": "1",
      "name": "Muscleups (MU)",
      "description": "",
      "rewards": "{\"lean\":\"330\",\"athletic\":\"440\",\"strength\":\"550\"}",
      "equipments": "",
      "skill_id": "87",
      "created_at": "2016-08-02 10:56:33",
      "progression_string": "",
      "is_unlocked": 0
      },
      {
      "id": "2",
      "name": "Front Lever (FL)",
      "description": "",
      "rewards": "{\"lean\":\"330\",\"athletic\":\"440\",\"strength\":\"550\"}",
      "equipments": "Bar/Rings",
      "skill_id": "92",
      "created_at": "2016-08-02 10:57:05",
      "progression_string": "",
      "is_unlocked": 0
      },
      {
      "id": "3",
      "name": "Back Lever (BL)",
      "description": "",
      "rewards": "{\"lean\":\"330\",\"athletic\":\"440\",\"strength\":\"550\"}",
      "equipments": "",
      "skill_id": "97",
      "created_at": "2016-08-02 10:57:36",
      "progression_string": "",
      "is_unlocked": 0
      },
      {
      "id": "4",
      "name": "Triceps Extensions",
      "description": "",
      "rewards": "{\"lean\":\"330\",\"athletic\":\"440\",\"strength\":\"550\"}",
      "equipments": "Bar/Rings",
      "skill_id": "102",
      "created_at": "2016-08-02 10:58:09",
      "progression_string": "",
      "is_unlocked": 0
      },
      {
      "id": "5",
      "name": "Hefesto",
      "description": "",
      "rewards": "{\"lean\":\"330\",\"athletic\":\"440\",\"strength\":\"550\"}",
      "equipments": "Bar",
      "skill_id": "109",
      "created_at": "2016-08-02 10:58:36",
      "progression_string": "",
      "is_unlocked": 0
      },
      {
      "id": "6",
      "name": "Impossible Dips",
      "description": "",
      "rewards": "{\"lean\":\"330\",\"athletic\":\"440\",\"strength\":\"550\"}",
      "equipments": "Paralettes, Parallel Bars",
      "skill_id": "114",
      "created_at": "2016-08-02 10:59:02",
      "progression_string": "",
      "is_unlocked": 0
      },
      {
      "id": "7",
      "name": "1- Arm Pushups",
      "description": "",
      "rewards": "{\"lean\":\"330\",\"athletic\":\"440\",\"strength\":\"550\"}",
      "equipments": "No Equipment",
      "skill_id": "135",
      "created_at": "2016-08-02 11:00:24",
      "progression_string": "",
      "is_unlocked": 0
      },
      {
      "id": "8",
      "name": "Handstand Pushups",
      "description": "Handstand Pushups",
      "rewards": "{\"lean\":\"330\",\"athletic\":\"440\",\"strength\":\"550\"}",
      "equipments": "No Equipment",
      "skill_id": "140",
      "created_at": "2016-08-02 11:00:49",
      "progression_string": "",
      "is_unlocked": 0
      },
      {
      "id": "9",
      "name": "Planche",
      "description": "Planche",
      "rewards": "{\"lean\":\"330\",\"athletic\":\"440\",\"strength\":\"550\"}",
      "equipments": "Paralettes, Parallel Bars",
      "skill_id": "150",
      "created_at": "2016-08-02 11:02:03",
      "progression_string": "",
      "is_unlocked": 0
      },
      {
      "id": "10",
      "name": "Hollow Body Rock ",
      "description": "Hollow Body Rock",
      "rewards": "{\"lean\":\"330\",\"athletic\":\"440\",\"strength\":\"550\"}",
      "equipments": "No Equipment",
      "skill_id": "155",
      "created_at": "2016-08-02 11:02:33",
      "progression_string": "",
      "is_unlocked": 0
      },
      {
      "id": "11",
      "name": "Side Plank",
      "description": "Side Plank (all Core related exercises)",
      "rewards": "{\"lean\":\"330\",\"athletic\":\"440\",\"strength\":\"550\"}",
      "equipments": "Bar/Rings",
      "skill_id": "160",
      "created_at": "2016-08-02 11:02:55",
      "progression_string": "",
      "is_unlocked": 0
      },
      {
      "id": "12",
      "name": "Human Flag",
      "description": "",
      "rewards": "{\"lean\":\"330\",\"athletic\":\"440\",\"strength\":\"550\"}",
      "equipments": "Bar/Rings, Post, Vertical Bar",
      "skill_id": "165",
      "created_at": "2016-08-02 11:03:23",
      "progression_string": "",
      "is_unlocked": 0
      },
      {
      "id": "13",
      "name": "Shoulder & Dragon Flag",
      "description": "",
      "rewards": "{\"lean\":\"330\",\"athletic\":\"440\",\"strength\":\"550\"}",
      "equipments": "Post, Vertical Bar, Bench",
      "skill_id": "236",
      "created_at": "2016-08-02 11:04:01",
      "progression_string": "",
      "is_unlocked": 0
      },
      {
      "id": "14",
      "name": "Pullover",
      "description": "",
      "rewards": "{\"lean\":\"330\",\"athletic\":\"440\",\"strength\":\"550\"}",
      "equipments": "Bar/Rings",
      "skill_id": "174",
      "created_at": "2016-08-02 11:04:38",
      "progression_string": "",
      "is_unlocked": 0
      },
      {
      "id": "15",
      "name": "Legs",
      "description": "",
      "rewards": "{\"lean\":\"330\",\"athletic\":\"440\",\"strength\":\"550\"}",
      "equipments": "",
      "skill_id": "119",
      "created_at": "2016-08-02 11:29:01",
      "progression_string": "",
      "is_unlocked": 0
      },
      {
      "id": "16",
      "name": "Double Clap Pushups",
      "description": "Double Clap Pushups",
      "rewards": "{\"lean\":\"330\",\"athletic\":\"440\",\"strength\":\"550\"}",
      "equipments": "No Equipment",
      "skill_id": "145",
      "created_at": "2016-08-02 11:37:29",
      "progression_string": "",
      "is_unlocked": 0
      }
      ]
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
    public function loadSkilltrainings(Request $request)
    {
        $skilltrainingResponse = [];
        if (!isset($request->user_id) || ($request->user_id == null)) {
            return response()->json(["status" => "0", "error" => "The user_id field is required"]);
        } else {
            $user = User::where('id', '=', $request->input('user_id'))->first();
            if (!is_null($user)) {
                $freeSkilltrainings = Skilltraining::all();
                $freeSkilltrainingsArray = $freeSkilltrainings->toArray();
                $freeSkilltrainingsArray = array_map(function($freeSkilltraining) use ($user) {
                    $freeSkilltraining['is_unlocked'] = self::isSkillTainingUnlocked($freeSkilltraining['id'], $user->id);
                    return $freeSkilltraining;
                }, $freeSkilltrainingsArray);
                return response()->json([
                        'status' => 1,
                        'is_subscribed' => $user->is_subscribed,
                        'skilltrainings' => $freeSkilltrainingsArray
                        ], 200);
            } else {
                return response()->json(['status' => 0, 'error' => 'user_not_exists'], 500);
            }
        }
    }

    /**
     * Check whether the skill training unlocked or not.
     * @param type $skillTraId
     * @param type $userId
     * @return int
     * @author Aneesh K<aneeshk@cubettech.com>
     */
    public static function isSkillTainingUnlocked($skillTraId, $userId)
    {
        $unlockCnt = DB::table('unlocked_skilltrainings')->where([
                'user_id' => $userId,
                'skilltraining_id' => $skillTraId
            ])->count();
        $freeArray = Array(1, 8, 10);

        $user = User::where('id', '=', $userId)->first();

        if (in_array($skillTraId, $freeArray)) {
            return 1;
        }

        if ($user->is_subscribed == 0) {
            return 0;
        }

        if ($unlockCnt > 0) {
            return 1;
        } else {
            return 0;
        }
    }

    /**
     * @api {post} /skilltraining/getlevels getSkilltrainingWithLevels
     * @apiName getSkilltrainingWithLevels
     * @apiGroup Skilltraining
     * @apiParam {Number} skilltraining_id Id of skilltraining *required
     * @apiParam {Number} user_d Id of user *required
     * @apiSuccess {String} success.
     * @apiSuccessExample Success-Response:
     * HTTP/1.1 200 OK
     * {
      "status": 1,
      "is_subscribed": 0,
      "skilltraining": {
      "id": "1",
      "name": "Muscleups (MU)",
      "description": "",
      "rewards": {
      "lean": "330",
      "athletic": "440",
      "strength": "550"
      },
      "equipments": "",
      "is_circuit": "0",
      "created_at": "2016-08-02 10:56:33",
      "progression_string": "",
      "lock_status": {
      "1": 1,
      "2": 1,
      "3": 1
      },
      "lean": {
      "1": {
      "featured": [
      {
      "id": "33",
      "skilltraining_id": "1",
      "user_id": "545",
      "status": "1",
      "time": "62",
      "is_starred": "0",
      "volume": "1",
      "focus": "1",
      "feed_id": "1609",
      "is_coach": "0",
      "created_at": "2016-08-12 08:49:33",
      "updated_at": "2016-08-12 08:49:33",
      "profile": {
      "id": "442",
      "user_id": "545",
      "first_name": "Vishnu",
      "last_name": "g",
      "gender": "1",
      "fitness_status": "2",
      "goal": "2",
      "image": "",
      "cover_image": "",
      "city": "",
      "state": "",
      "country": "",
      "spot": "",
      "quote": "",
      "facebook": "",
      "twitter": "",
      "instagram": "",
      "created_at": "2016-07-15 06:56:18",
      "updated_at": "2016-08-12 11:23:31",
      "level": 16
      }
      }
      ],
      "following": [
      {
      "id": "1",
      "skilltraining_id": "1",
      "user_id": "100",
      "status": "1",
      "time": "30",
      "is_starred": "1",
      "volume": "1",
      "focus": "1",
      "feed_id": "1500",
      "is_coach": "0",
      "created_at": "2016-08-08 11:24:03",
      "updated_at": "2016-08-08 11:24:03",
      "profile": {
      "id": "99",
      "user_id": "100",
      "first_name": "Aneesh",
      "last_name": "k test",
      "gender": "1",
      "fitness_status": "2",
      "goal": "1",
      "image": "",
      "cover_image": "",
      "city": "",
      "state": "",
      "country": "",
      "spot": "",
      "quote": "????? ",
      "facebook": "",
      "twitter": "",
      "instagram": "",
      "created_at": "2016-03-18 09:17:57",
      "updated_at": "2016-08-17 05:46:20",
      "level": 10
      }
      },
      {
      "id": "2",
      "skilltraining_id": "1",
      "user_id": "100",
      "status": "1",
      "time": "30",
      "is_starred": "1",
      "volume": "1",
      "focus": "1",
      "feed_id": "1501",
      "is_coach": "0",
      "created_at": "2016-08-08 11:24:27",
      "updated_at": "2016-08-08 11:24:27",
      "profile": {
      "id": "99",
      "user_id": "100",
      "first_name": "Aneesh",
      "last_name": "k test",
      "gender": "1",
      "fitness_status": "2",
      "goal": "1",
      "image": "",
      "cover_image": "",
      "city": "",
      "state": "",
      "country": "",
      "spot": "",
      "quote": "????? ",
      "facebook": "",
      "twitter": "",
      "instagram": "",
      "created_at": "2016-03-18 09:17:57",
      "updated_at": "2016-08-17 05:46:20",
      "level": 10
      }
      },
      {
      "id": "88",
      "skilltraining_id": "1",
      "user_id": "100",
      "status": "1",
      "time": "30",
      "is_starred": "1",
      "volume": "1",
      "focus": "1",
      "feed_id": "1703",
      "is_coach": "1",
      "created_at": "2016-08-17 10:33:32",
      "updated_at": "2016-08-17 10:33:32",
      "profile": {
      "id": "99",
      "user_id": "100",
      "first_name": "Aneesh",
      "last_name": "k test",
      "gender": "1",
      "fitness_status": "2",
      "goal": "1",
      "image": "",
      "cover_image": "",
      "city": "",
      "state": "",
      "country": "",
      "spot": "",
      "quote": "????? ",
      "facebook": "",
      "twitter": "",
      "instagram": "",
      "created_at": "2016-03-18 09:17:57",
      "updated_at": "2016-08-17 05:46:20",
      "level": 10
      }
      }
      ],
      "personal_best": "30"
      },
      "2": {
      "featured": [],
      "following": [
      {
      "id": "1",
      "skilltraining_id": "1",
      "user_id": "100",
      "status": "1",
      "time": "30",
      "is_starred": "1",
      "volume": "1",
      "focus": "1",
      "feed_id": "1500",
      "is_coach": "0",
      "created_at": "2016-08-08 11:24:03",
      "updated_at": "2016-08-08 11:24:03",
      "profile": {
      "id": "99",
      "user_id": "100",
      "first_name": "Aneesh",
      "last_name": "k test",
      "gender": "1",
      "fitness_status": "2",
      "goal": "1",
      "image": "",
      "cover_image": "",
      "city": "",
      "state": "",
      "country": "",
      "spot": "",
      "quote": "????? ",
      "facebook": "",
      "twitter": "",
      "instagram": "",
      "created_at": "2016-03-18 09:17:57",
      "updated_at": "2016-08-17 05:46:20",
      "level": 10
      }
      },
      {
      "id": "2",
      "skilltraining_id": "1",
      "user_id": "100",
      "status": "1",
      "time": "30",
      "is_starred": "1",
      "volume": "1",
      "focus": "1",
      "feed_id": "1501",
      "is_coach": "0",
      "created_at": "2016-08-08 11:24:27",
      "updated_at": "2016-08-08 11:24:27",
      "profile": {
      "id": "99",
      "user_id": "100",
      "first_name": "Aneesh",
      "last_name": "k test",
      "gender": "1",
      "fitness_status": "2",
      "goal": "1",
      "image": "",
      "cover_image": "",
      "city": "",
      "state": "",
      "country": "",
      "spot": "",
      "quote": "????? ",
      "facebook": "",
      "twitter": "",
      "instagram": "",
      "created_at": "2016-03-18 09:17:57",
      "updated_at": "2016-08-17 05:46:20",
      "level": 10
      }
      },
      {
      "id": "88",
      "skilltraining_id": "1",
      "user_id": "100",
      "status": "1",
      "time": "30",
      "is_starred": "1",
      "volume": "1",
      "focus": "1",
      "feed_id": "1703",
      "is_coach": "1",
      "created_at": "2016-08-17 10:33:32",
      "updated_at": "2016-08-17 10:33:32",
      "profile": {
      "id": "99",
      "user_id": "100",
      "first_name": "Aneesh",
      "last_name": "k test",
      "gender": "1",
      "fitness_status": "2",
      "goal": "1",
      "image": "",
      "cover_image": "",
      "city": "",
      "state": "",
      "country": "",
      "spot": "",
      "quote": "????? ",
      "facebook": "",
      "twitter": "",
      "instagram": "",
      "created_at": "2016-03-18 09:17:57",
      "updated_at": "2016-08-17 05:46:20",
      "level": 10
      }
      }
      ],
      "personal_best": "30"
      },
      "3": {
      "featured": [],
      "following": [
      {
      "id": "1",
      "skilltraining_id": "1",
      "user_id": "100",
      "status": "1",
      "time": "30",
      "is_starred": "1",
      "volume": "1",
      "focus": "1",
      "feed_id": "1500",
      "is_coach": "0",
      "created_at": "2016-08-08 11:24:03",
      "updated_at": "2016-08-08 11:24:03",
      "profile": {
      "id": "99",
      "user_id": "100",
      "first_name": "Aneesh",
      "last_name": "k test",
      "gender": "1",
      "fitness_status": "2",
      "goal": "1",
      "image": "",
      "cover_image": "",
      "city": "",
      "state": "",
      "country": "",
      "spot": "",
      "quote": "????? ",
      "facebook": "",
      "twitter": "",
      "instagram": "",
      "created_at": "2016-03-18 09:17:57",
      "updated_at": "2016-08-17 05:46:20",
      "level": 10
      }
      },
      {
      "id": "2",
      "skilltraining_id": "1",
      "user_id": "100",
      "status": "1",
      "time": "30",
      "is_starred": "1",
      "volume": "1",
      "focus": "1",
      "feed_id": "1501",
      "is_coach": "0",
      "created_at": "2016-08-08 11:24:27",
      "updated_at": "2016-08-08 11:24:27",
      "profile": {
      "id": "99",
      "user_id": "100",
      "first_name": "Aneesh",
      "last_name": "k test",
      "gender": "1",
      "fitness_status": "2",
      "goal": "1",
      "image": "",
      "cover_image": "",
      "city": "",
      "state": "",
      "country": "",
      "spot": "",
      "quote": "????? ",
      "facebook": "",
      "twitter": "",
      "instagram": "",
      "created_at": "2016-03-18 09:17:57",
      "updated_at": "2016-08-17 05:46:20",
      "level": 10
      }
      },
      {
      "id": "88",
      "skilltraining_id": "1",
      "user_id": "100",
      "status": "1",
      "time": "30",
      "is_starred": "1",
      "volume": "1",
      "focus": "1",
      "feed_id": "1703",
      "is_coach": "1",
      "created_at": "2016-08-17 10:33:32",
      "updated_at": "2016-08-17 10:33:32",
      "profile": {
      "id": "99",
      "user_id": "100",
      "first_name": "Aneesh",
      "last_name": "k test",
      "gender": "1",
      "fitness_status": "2",
      "goal": "1",
      "image": "",
      "cover_image": "",
      "city": "",
      "state": "",
      "country": "",
      "spot": "",
      "quote": "????? ",
      "facebook": "",
      "twitter": "",
      "instagram": "",
      "created_at": "2016-03-18 09:17:57",
      "updated_at": "2016-08-17 05:46:20",
      "level": 10
      }
      }
      ],
      "personal_best": "30"
      }
      },
      "athletic": {
      "1": {
      "featured": [],
      "following": [
      {
      "id": "44",
      "skilltraining_id": "1",
      "user_id": "67",
      "status": "1",
      "time": "22",
      "is_starred": "0",
      "volume": "1",
      "focus": "2",
      "feed_id": "1646",
      "is_coach": "0",
      "created_at": "2016-08-16 07:26:46",
      "updated_at": "2016-08-16 07:26:46",
      "profile": {
      "id": "67",
      "user_id": "67",
      "first_name": "Aneesh",
      "last_name": "iLeaf",
      "gender": "0",
      "fitness_status": "3",
      "goal": "2",
      "image": "67_1460107183.jpg",
      "cover_image": "67_1460107251.jpg",
      "city": "Kochi",
      "state": "",
      "country": "",
      "spot": "",
      "quote": "åäÀáâæ?ã",
      "facebook": "",
      "twitter": "",
      "instagram": "",
      "created_at": "2016-02-12 14:39:19",
      "updated_at": "2016-08-17 06:50:31",
      "level": 13
      }
      },
      {
      "id": "89",
      "skilltraining_id": "1",
      "user_id": "100",
      "status": "1",
      "time": "30",
      "is_starred": "1",
      "volume": "1",
      "focus": "2",
      "feed_id": "1705",
      "is_coach": "1",
      "created_at": "2016-08-17 10:56:23",
      "updated_at": "2016-08-17 10:56:23",
      "profile": {
      "id": "99",
      "user_id": "100",
      "first_name": "Aneesh",
      "last_name": "k test",
      "gender": "1",
      "fitness_status": "2",
      "goal": "1",
      "image": "",
      "cover_image": "",
      "city": "",
      "state": "",
      "country": "",
      "spot": "",
      "quote": "????? ",
      "facebook": "",
      "twitter": "",
      "instagram": "",
      "created_at": "2016-03-18 09:17:57",
      "updated_at": "2016-08-17 05:46:20",
      "level": 10
      }
      },
      {
      "id": "90",
      "skilltraining_id": "1",
      "user_id": "100",
      "status": "1",
      "time": "30",
      "is_starred": "1",
      "volume": "1",
      "focus": "2",
      "feed_id": "1706",
      "is_coach": "1",
      "created_at": "2016-08-17 10:58:39",
      "updated_at": "2016-08-17 10:58:39",
      "profile": {
      "id": "99",
      "user_id": "100",
      "first_name": "Aneesh",
      "last_name": "k test",
      "gender": "1",
      "fitness_status": "2",
      "goal": "1",
      "image": "",
      "cover_image": "",
      "city": "",
      "state": "",
      "country": "",
      "spot": "",
      "quote": "????? ",
      "facebook": "",
      "twitter": "",
      "instagram": "",
      "created_at": "2016-03-18 09:17:57",
      "updated_at": "2016-08-17 05:46:20",
      "level": 10
      }
      },
      {
      "id": "91",
      "skilltraining_id": "1",
      "user_id": "100",
      "status": "1",
      "time": "30",
      "is_starred": "1",
      "volume": "1",
      "focus": "2",
      "feed_id": "1707",
      "is_coach": "1",
      "created_at": "2016-08-17 11:05:13",
      "updated_at": "2016-08-17 11:05:13",
      "profile": {
      "id": "99",
      "user_id": "100",
      "first_name": "Aneesh",
      "last_name": "k test",
      "gender": "1",
      "fitness_status": "2",
      "goal": "1",
      "image": "",
      "cover_image": "",
      "city": "",
      "state": "",
      "country": "",
      "spot": "",
      "quote": "????? ",
      "facebook": "",
      "twitter": "",
      "instagram": "",
      "created_at": "2016-03-18 09:17:57",
      "updated_at": "2016-08-17 05:46:20",
      "level": 10
      }
      },
      {
      "id": "92",
      "skilltraining_id": "1",
      "user_id": "100",
      "status": "1",
      "time": "30",
      "is_starred": "1",
      "volume": "1",
      "focus": "2",
      "feed_id": "1708",
      "is_coach": "1",
      "created_at": "2016-08-17 11:05:38",
      "updated_at": "2016-08-17 11:05:38",
      "profile": {
      "id": "99",
      "user_id": "100",
      "first_name": "Aneesh",
      "last_name": "k test",
      "gender": "1",
      "fitness_status": "2",
      "goal": "1",
      "image": "",
      "cover_image": "",
      "city": "",
      "state": "",
      "country": "",
      "spot": "",
      "quote": "????? ",
      "facebook": "",
      "twitter": "",
      "instagram": "",
      "created_at": "2016-03-18 09:17:57",
      "updated_at": "2016-08-17 05:46:20",
      "level": 10
      }
      },
      {
      "id": "93",
      "skilltraining_id": "1",
      "user_id": "100",
      "status": "1",
      "time": "30",
      "is_starred": "1",
      "volume": "1",
      "focus": "2",
      "feed_id": "1709",
      "is_coach": "1",
      "created_at": "2016-08-17 11:08:05",
      "updated_at": "2016-08-17 11:08:05",
      "profile": {
      "id": "99",
      "user_id": "100",
      "first_name": "Aneesh",
      "last_name": "k test",
      "gender": "1",
      "fitness_status": "2",
      "goal": "1",
      "image": "",
      "cover_image": "",
      "city": "",
      "state": "",
      "country": "",
      "spot": "",
      "quote": "????? ",
      "facebook": "",
      "twitter": "",
      "instagram": "",
      "created_at": "2016-03-18 09:17:57",
      "updated_at": "2016-08-17 05:46:20",
      "level": 10
      }
      },
      {
      "id": "94",
      "skilltraining_id": "1",
      "user_id": "100",
      "status": "1",
      "time": "30",
      "is_starred": "1",
      "volume": "1",
      "focus": "2",
      "feed_id": "1710",
      "is_coach": "1",
      "created_at": "2016-08-17 11:08:26",
      "updated_at": "2016-08-17 11:08:26",
      "profile": {
      "id": "99",
      "user_id": "100",
      "first_name": "Aneesh",
      "last_name": "k test",
      "gender": "1",
      "fitness_status": "2",
      "goal": "1",
      "image": "",
      "cover_image": "",
      "city": "",
      "state": "",
      "country": "",
      "spot": "",
      "quote": "????? ",
      "facebook": "",
      "twitter": "",
      "instagram": "",
      "created_at": "2016-03-18 09:17:57",
      "updated_at": "2016-08-17 05:46:20",
      "level": 10
      }
      }
      ],
      "personal_best": "30"
      },
      "2": {
      "featured": [],
      "following": [],
      "personal_best": "30"
      },
      "3": {
      "featured": [],
      "following": [],
      "personal_best": "30"
      }
      },
      "strength": {
      "1": {
      "featured": [
      {
      "id": "34",
      "skilltraining_id": "1",
      "user_id": "545",
      "status": "1",
      "time": "31",
      "is_starred": "0",
      "volume": "1",
      "focus": "3",
      "feed_id": "1610",
      "is_coach": "0",
      "created_at": "2016-08-12 08:52:33",
      "updated_at": "2016-08-12 08:52:33",
      "profile": {
      "id": "442",
      "user_id": "545",
      "first_name": "Vishnu",
      "last_name": "g",
      "gender": "1",
      "fitness_status": "2",
      "goal": "2",
      "image": "",
      "cover_image": "",
      "city": "",
      "state": "",
      "country": "",
      "spot": "",
      "quote": "",
      "facebook": "",
      "twitter": "",
      "instagram": "",
      "created_at": "2016-07-15 06:56:18",
      "updated_at": "2016-08-12 11:23:31",
      "level": 16
      }
      }
      ],
      "following": [
      {
      "id": "95",
      "skilltraining_id": "1",
      "user_id": "100",
      "status": "1",
      "time": "30",
      "is_starred": "1",
      "volume": "1",
      "focus": "3",
      "feed_id": "1711",
      "is_coach": "1",
      "created_at": "2016-08-17 11:10:33",
      "updated_at": "2016-08-17 11:10:33",
      "profile": {
      "id": "99",
      "user_id": "100",
      "first_name": "Aneesh",
      "last_name": "k test",
      "gender": "1",
      "fitness_status": "2",
      "goal": "1",
      "image": "",
      "cover_image": "",
      "city": "",
      "state": "",
      "country": "",
      "spot": "",
      "quote": "????? ",
      "facebook": "",
      "twitter": "",
      "instagram": "",
      "created_at": "2016-03-18 09:17:57",
      "updated_at": "2016-08-17 05:46:20",
      "level": 10
      }
      },
      {
      "id": "96",
      "skilltraining_id": "1",
      "user_id": "100",
      "status": "1",
      "time": "30",
      "is_starred": "1",
      "volume": "1",
      "focus": "3",
      "feed_id": "1712",
      "is_coach": "1",
      "created_at": "2016-08-17 11:10:45",
      "updated_at": "2016-08-17 11:10:45",
      "profile": {
      "id": "99",
      "user_id": "100",
      "first_name": "Aneesh",
      "last_name": "k test",
      "gender": "1",
      "fitness_status": "2",
      "goal": "1",
      "image": "",
      "cover_image": "",
      "city": "",
      "state": "",
      "country": "",
      "spot": "",
      "quote": "????? ",
      "facebook": "",
      "twitter": "",
      "instagram": "",
      "created_at": "2016-03-18 09:17:57",
      "updated_at": "2016-08-17 05:46:20",
      "level": 10
      }
      }
      ],
      "personal_best": "30"
      },
      "2": {
      "featured": [],
      "following": [],
      "personal_best": "30"
      },
      "3": {
      "featured": [],
      "following": [],
      "personal_best": "30"
      }
      }
      },
      "urls": {
      "profileImageSmall": "http://testing.ykings.com/uploads/images/profile/small",
      "profileImageMedium": "http://testing.ykings.com/uploads/images/profile/medium",
      "profileImageLarge": "http://testing.ykings.com/uploads/images/profile/large",
      "profileImageOriginal": "http://testing.ykings.com/uploads/images/profile/original",
      "video": "http://testing.ykings.com/uploads/videos",
      "videothumbnail": "http://testing.ykings.com/uploads/images/videothumbnails",
      "feedImageSmall": "http://testing.ykings.com/uploads/images/feed/small",
      "feedImageMedium": "http://testing.ykings.com/uploads/images/feed/medium",
      "feedImageLarge": "http://testing.ykings.com/uploads/images/feed/large",
      "feedImageOriginal": "http://testing.ykings.com/uploads/images/feed/original",
      "coverImageSmall": "http://testing.ykings.com/uploads/images/cover_image/small",
      "coverImageMedium": "http://testing.ykings.com/uploads/images/cover_image/medium",
      "coverImageLarge": "http://testing.ykings.com/uploads/images/cover_image/large",
      "coverImageOriginal": "http://testing.ykings.com/uploads/images/cover_image/original"
      }
      }
     * 
     * @apiError error Message token_invalid.
     * @apiError error Message token_expired.
     * @apiError error Message token_not_provided.
     * @apiError error Message Validation error
     * @apiError error Message skilltraining_not_exists
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
     *       "error": "The exercise_id field is required"
     *     }
     * 
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 500 skilltraining_not_exists
     *     {
     *       "status" : 0,
     *       "error": "skilltraining_not_exists"
     *     }
     * 
     */
    public function getSkilltrainingWithLevels(Request $request)
    {
        $followingLeanSkilltraining = [];
        $followingAthleteSkilltraining = [];
        $followingStrengthSkilltraining = [];

        if (!isset($request->skilltraining_id) || ($request->skilltraining_id == null)) {
            return response()->json(["status" => "0", "error" => "The skilltraining_id field is required"]);
        } elseif (!isset($request->user_id) || ($request->user_id == null)) {
            return response()->json(["status" => "0", "error" => "The user_id field is required"]);
        } else {
            $skilltraining = Skilltraining::where('id', '=', $request->input('skilltraining_id'))->first();
            if (!is_null($skilltraining)) {

                $freeArray = Array(1, 8, 10);

                $skilltrainingArray = $skilltraining->toArray();

                for ($i = 1; $i <= 3; $i++) {
                    $unlockCount = DB::table('unlocked_skilltrainings')->where([
                            'user_id' => $request->user_id,
                            'skilltraining_id' => $request->skilltraining_id,
                            'level' => $i
                        ])->count();
                    if ($unlockCount > 0 || in_array($request->skilltraining_id, $freeArray)) {
                        $statusArray[$i] = 1;
                    } else {
                        $statusArray[$i] = 0;
                    }
                }

                $skilltrainingArray['lock_status'] = $statusArray;


                $skilltrainingArray['rewards'] = json_decode($skilltrainingArray['rewards'], true);

                $featuredUserQuery = DB::table('users')->select('id')->whereRaw('status = 1 AND is_featured = 1')->toSql();

                $followQuery = DB::table('follows')->select('follow_id')->whereRaw('user_id = ' . $request->user_id)->toSql();

                $intensityArray = [1, 2, 3];

                foreach ($intensityArray as $intensity) {
                    $skilltrainingArray['lean'][$intensity]['featured'] = SkilltrainingUser::whereRaw('focus = 1 AND volume = ' . $intensity . ' AND skilltraining_id = ' . $request->skilltraining_id . ' AND status= 1 AND user_id IN(' . $featuredUserQuery . ')')
                        ->with(['profile'])
                        ->groupBy('user_id')
                        ->orderBy('time', 'ASC')
                        ->get();

                    $skilltrainingArray['lean'][$intensity]['following'] = SkilltrainingUser::whereRaw('skilltraining_id = ' . $request->skilltraining_id . ' AND focus = 1 AND (user_id IN(' . $followQuery . ') OR user_id IN(' . $request->user_id . '))')
                        ->with(['profile'])
                        ->orderBy('time', 'ASC')
                        ->get();

                    $bestTime = SkilltrainingUser::where('skilltraining_id', $request->skilltraining_id)
                        ->where('focus', 1)
                        ->where('user_id', $request->user_id)
                        ->orderBy('time', 'ASC')
                        ->pluck('time');

                    if (!is_null($bestTime)) {
                        $skilltrainingArray['lean'][$intensity]['personal_best'] = $bestTime;
                    } else {
                        $skilltrainingArray['lean'][$intensity]['personal_best'] = '';
                    }

                    $skilltrainingArray['athletic'][$intensity]['featured'] = SkilltrainingUser::whereRaw('focus = 2 AND volume = ' . $intensity . ' AND skilltraining_id = ' . $request->skilltraining_id . ' AND status= 1 AND user_id IN(' . $featuredUserQuery . ')')
                        ->with(['profile'])
                        ->groupBy('user_id')
                        ->orderBy('time', 'ASC')
                        ->get();

                    $skilltrainingArray['athletic'][$intensity]['following'] = SkilltrainingUser::whereRaw('skilltraining_id = ' . $request->skilltraining_id . ' AND volume = ' . $intensity . ' AND focus = 2 AND (user_id IN(' . $followQuery . ') OR user_id IN(' . $request->user_id . '))')
                        ->with(['profile'])
                        ->orderBy('time', 'ASC')
                        ->get();

                    $bestTime = SkilltrainingUser::where('skilltraining_id', $request->skilltraining_id)
                        ->where('focus', 2)
                        ->where('user_id', $request->user_id)
                        ->orderBy('time', 'ASC')
                        ->pluck('time');

                    if (!is_null($bestTime)) {
                        $skilltrainingArray['athletic'][$intensity]['personal_best'] = $bestTime;
                    } else {
                        $skilltrainingArray['athletic'][$intensity]['personal_best'] = '';
                    }



                    $skilltrainingArray['strength'][$intensity]['featured'] = SkilltrainingUser::whereRaw('focus = 3 AND volume = ' . $intensity . ' AND  skilltraining_id = ' . $request->skilltraining_id . ' AND status= 1 AND user_id IN(' . $featuredUserQuery . ')')
                        ->with(['profile'])
                        ->groupBy('user_id')
                        ->orderBy('time', 'ASC')
                        ->get();

                    $skilltrainingArray['strength'][$intensity]['following'] = SkilltrainingUser::whereRaw('skilltraining_id = ' . $request->skilltraining_id . ' AND focus = 3 AND volume = ' . $intensity . ' AND (user_id IN(' . $followQuery . ') OR user_id IN(' . $request->user_id . '))')
                        ->with(['profile'])
                        ->orderBy('time', 'ASC')
                        ->get();

                    $bestTime = SkilltrainingUser::where('skilltraining_id', $request->skilltraining_id)
                        ->where('focus', 3)
                        ->where('user_id', $request->user_id)
                        ->orderBy('time', 'ASC')
                        ->pluck('time');

                    if (!is_null($bestTime)) {
                        $skilltrainingArray['strength'][$intensity]['personal_best'] = $bestTime;
                    } else {
                        $skilltrainingArray['strength'][$intensity]['personal_best'] = '';
                    }
                }

                $time = time();

                $isSubscribed = 0;

                if (isset($request->user_id)) {
                    $subscription = DB::table('subscriptions')
                        ->select('*')
                        ->where('user_id', '=', $request->user_id)
                        ->orderBy('id', 'DESC')
                        ->first();

                    if (!is_null($subscription) && $subscription->end_time > $time) {
                        $isSubscribed = 1;
                    }
                }

                return response()->json(['status' => 1, 'is_subscribed' => $isSubscribed, 'skilltraining' => $skilltrainingArray, 'urls' => config('urls.urls')], 200);
            } else {
                return response()->json(['status' => 0, 'error' => 'skilltraining_not_exists'], 500);
            }
        }
    }

    /**
     * @api {post} /skilltraining/getexercises getSkilltrainingWithExercises
     * @apiName getSkilltrainingWithExercises
     * @apiGroup Skilltraining
     * @apiParam {Number} skilltraining_id Id of skilltraining *required
     * @apiParam {Number} category of skilltraining 1-lean, 2-athletic, 3-strength *required
     * @apiSuccess {String} success.
     * @apiSuccessExample Success-Response:
     * HTTP/1.1 200 OK
     * {
      "status": 1,
      "skilltraining": {
      "id": "1",
      "name": "Muscleups (MU)",
      "description": "",
      "rewards": {
      "lean": "330",
      "athletic": "440",
      "strength": "550"
      },
      "equipments": "",
      "skill_id": "87",
      "created_at": "2016-08-02 10:56:33",
      "progression_string": "",
      "exercises": [
      {
      "id": "1",
      "skilltraining_id": "1",
      "category": "1",
      "repititions": "5",
      "exercise_id": "193",
      "unit": "times",
      "sets": "3",
      "created_at": "2016-08-03 06:59:50",
      "updated_at": "2016-08-03 07:22:46",
      "video": {
      "id": "80",
      "path": "193_1470649743.mp4",
      "videothumbnail": "193_1470649743.jpg",
      "description": ""
      },
      "exercise": {
      "id": "193",
      "name": "Jump 2 MU",
      "description": "Jump 2 MU",
      "category": "3",
      "type": "2",
      "muscle_groups": "",
      "rewards": "5.00",
      "unit": "times",
      "equipment": "",
      "range_of_motion": "1) Start with feet on the ground 2) Jump up into muscleup 3) Straight bar dip on top 4) Slow & controlled eccentric movement into starting position",
      "video_tips": "",
      "pro_tips": "",
      "video_tips_html": "",
      "pro_tips_html": "",
      "range_of_motion_html": "<p>1) Start with feet on the ground<br /> 2) Jump up into muscleup<br /> 3) Straight bar dip on top<br /> 4) Slow &amp; controlled eccentric movement into starting position</p>",
      "is_static": "0",
      "musclegroup_string": ""
      }
      },
      {
      "id": "2",
      "skilltraining_id": "1",
      "category": "1",
      "repititions": "10",
      "exercise_id": "86",
      "unit": "times",
      "sets": "3",
      "created_at": "2016-08-03 07:16:19",
      "updated_at": "2016-08-03 07:25:06",
      "video": {
      "id": "81",
      "path": "86_1470654172.mp4",
      "videothumbnail": "86_1470654172.jpg",
      "description": "Pull-ups "
      },
      "exercise": {
      "id": "86",
      "name": "Pull-ups ",
      "description": "Pull-ups ",
      "category": "2",
      "type": "1",
      "muscle_groups": "",
      "rewards": "7.00",
      "unit": "times",
      "equipment": "",
      "range_of_motion": "1) Start in deadhang position 2) Pullup, chin above bar level 3) Slow & controlled movement into starting position",
      "video_tips": "",
      "pro_tips": "",
      "video_tips_html": "",
      "pro_tips_html": "",
      "range_of_motion_html": "<p>1) Start in deadhang position<br /> 2) Pullup, chin above bar level<br /> 3) Slow &amp; controlled movement into starting position</p>",
      "is_static": "0",
      "musclegroup_string": ""
      }
      },
      {
      "id": "3",
      "skilltraining_id": "1",
      "category": "1",
      "repititions": "20",
      "exercise_id": "132",
      "unit": "times",
      "sets": "3",
      "created_at": "2016-08-03 07:18:36",
      "updated_at": "2016-08-03 07:25:43",
      "video": {
      "id": "82",
      "path": "132_1470650036.mp4",
      "videothumbnail": "132_1470650036.jpg",
      "description": ""
      },
      "exercise": {
      "id": "132",
      "name": "Pushups",
      "description": "Pushups",
      "category": "1",
      "type": "1",
      "muscle_groups": "",
      "rewards": "6.00",
      "unit": "times",
      "equipment": "",
      "range_of_motion": "",
      "video_tips": "",
      "pro_tips": "",
      "video_tips_html": "",
      "pro_tips_html": "",
      "range_of_motion_html": "",
      "is_static": "0",
      "musclegroup_string": ""
      }
      },
      {
      "id": "4",
      "skilltraining_id": "1",
      "category": "1",
      "repititions": "15",
      "exercise_id": "100",
      "unit": "times",
      "sets": "3",
      "created_at": "2016-08-03 07:26:11",
      "updated_at": "2016-08-03 07:26:11",
      "video": {
      "id": "83",
      "path": "100_1470654597.mp4",
      "videothumbnail": "100_1470654597.jpg",
      "description": "Bench Dips"
      },
      "exercise": {
      "id": "100",
      "name": "Bench Dips",
      "description": "Bench Dips",
      "category": "1",
      "type": "1",
      "muscle_groups": "",
      "rewards": "5.00",
      "unit": "times",
      "equipment": "",
      "range_of_motion": "",
      "video_tips": "",
      "pro_tips": "",
      "video_tips_html": "",
      "pro_tips_html": "",
      "range_of_motion_html": "",
      "is_static": "0",
      "musclegroup_string": ""
      }
      },
      {
      "id": "5",
      "skilltraining_id": "1",
      "category": "1",
      "repititions": "15",
      "exercise_id": "90",
      "unit": "times",
      "sets": "3",
      "created_at": "2016-08-03 07:26:42",
      "updated_at": "2016-08-03 07:26:42",
      "video": {
      "id": "84",
      "path": "90_1470654394.mp4",
      "videothumbnail": "90_1470654394.jpg",
      "description": "Australian Pull-ups"
      },
      "exercise": {
      "id": "90",
      "name": "Australian Pull-ups",
      "description": "Australian Pull-ups",
      "category": "1",
      "type": "2",
      "muscle_groups": "",
      "rewards": "5.00",
      "unit": "times",
      "equipment": "",
      "range_of_motion": "",
      "video_tips": "",
      "pro_tips": "",
      "video_tips_html": "",
      "pro_tips_html": "",
      "range_of_motion_html": "",
      "is_static": "0",
      "musclegroup_string": ""
      }
      }
      ]
      },
      "urls": {
      "profileImageSmall": "http://testing.ykings.com/uploads/images/profile/small",
      "profileImageMedium": "http://testing.ykings.com/uploads/images/profile/medium",
      "profileImageLarge": "http://testing.ykings.com/uploads/images/profile/large",
      "profileImageOriginal": "http://testing.ykings.com/uploads/images/profile/original",
      "video": "http://testing.ykings.com/uploads/videos",
      "videothumbnail": "http://testing.ykings.com/uploads/images/videothumbnails",
      "feedImageSmall": "http://testing.ykings.com/uploads/images/feed/small",
      "feedImageMedium": "http://testing.ykings.com/uploads/images/feed/medium",
      "feedImageLarge": "http://testing.ykings.com/uploads/images/feed/large",
      "feedImageOriginal": "http://testing.ykings.com/uploads/images/feed/original",
      "coverImageSmall": "http://testing.ykings.com/uploads/images/cover_image/small",
      "coverImageMedium": "http://testing.ykings.com/uploads/images/cover_image/medium",
      "coverImageLarge": "http://testing.ykings.com/uploads/images/cover_image/large",
      "coverImageOriginal": "http://testing.ykings.com/uploads/images/cover_image/original"
      }
      }
     * 
     * @apiError error Message token_invalid.
     * @apiError error Message token_expired.
     * @apiError error Message token_not_provided.
     * @apiError error Message Validation error
     * @apiError error Message Validation error
     * @apiError error Message skilltraining_not_exists
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
     *       "error": "The exercise_id field is required"
     *     }
     * 
     *  @apiErrorExample Error-Response:
     *     HTTP/1.1 422 Validation error
     *     {
     *       "status" : 0,
     *       "error": "The category field is required"
     *     }
     * 
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 500 skilltraining_not_exists
     *     {
     *       "status" : 0,
     *       "error": "skilltraining_not_exists"
     *     }
     * 
     */
    public function getSkilltrainingWithExercises(Request $request)
    {
        if (!isset($request->skilltraining_id) || ($request->skilltraining_id == null)) {
            return response()->json(["status" => "0", "error" => "The skilltraining_id field is required"]);
        } elseif (!isset($request->category) || ($request->category == null)) {
            return response()->json(["status" => "0", "error" => "The category field is required"]);
        } else {
            $skilltraining = Skilltraining::where('id', '=', $request->input('skilltraining_id'))->first();
            if (!is_null($skilltraining)) {
                $roundExercises = Skilltrainingexercise::where('category', '=', $request->category)
                        ->where('skilltraining_id', '=', $request->input('skilltraining_id'))
                        ->with(['exercise'])->get();

                $skilltrainingArray = $skilltraining->toArray();

                $skilltrainingArray['rewards'] = json_decode($skilltrainingArray['rewards'], TRUE);

                if ($skilltraining->is_circuit == 1) {
                    $exercises = $roundExercises->toArray();
                    if (count($exercises) > 0) {
                        $skilltrainingArray['rounds'] = $exercises[0]['sets'];
                        for ($i = 1; $i <= $skilltrainingArray['rounds']; $i++) {
                            $roundEx['round' . $i] = $exercises;
                        }
                        $skilltrainingArray['exercises'] = $roundEx;
                    }
                } else {
                    $skilltrainingArray['exercises'] = $roundExercises->toArray();
                }

                return response()->json(['status' => 1, 'skilltraining' => $skilltrainingArray, 'urls' => config('urls.urls')], 200);
            } else {
                return response()->json(['status' => 0, 'error' => 'skilltraining_not_exists'], 500);
            }
        }
    }
}
