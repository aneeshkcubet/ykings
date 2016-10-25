<?php namespace App\Http\Controllers\Api;

use Auth;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\User;
use App\Message;

class MessageController extends Controller
{

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
     * @api {post} /user/listNotifications ListNotifications
     * @apiName ListNotifications
     * @apiGroup Message
     * @apiParam {Number} user_id Id of user *required
     * @apiSuccess {String} success.
     * 
     * @apiSuccessExample Success-Response:
     * HTTP/1.1 200 OK
     * {
      "status": 1,
      "notifications": [
      {
      "id": "1730",
      "user_id": "1",
      "friend_id": "67",
      "message_type": "knowledge",
      "type_id": "1364",
      "message": "Team added a new message.",
      "read": "1",
      "created_at": "2016-06-02 12:42:59",
      "updated_at": "2016-06-14 06:23:25",
      "image": "1_1463145040.jpg"
      },
      {
      "id": "1692",
      "user_id": "67",
      "friend_id": "67",
      "message_type": "perfomance",
      "type_id": "67",
      "message": "Congrats. Your level has been upgraded to 43.",
      "read": "0",
      "created_at": "2016-05-14 07:05:03",
      "updated_at": "2016-05-14 07:05:03",
      "image": "67_1460107183.jpg"
      },
      {
      "id": "1574",
      "user_id": "1",
      "friend_id": "67",
      "message_type": "knowledge",
      "type_id": "1314",
      "message": "Team added a new message.",
      "read": "0",
      "created_at": "2016-05-13 13:19:20",
      "updated_at": "2016-05-13 13:19:20",
      "image": "1_1463145040.jpg"
      },
      {
      "id": "1451",
      "user_id": "1",
      "friend_id": "67",
      "message_type": "knowledge",
      "type_id": "1313",
      "message": "Team added a new message.",
      "read": "0",
      "created_at": "2016-05-13 13:17:45",
      "updated_at": "2016-05-13 13:17:45",
      "image": "1_1463145040.jpg"
      },
      {
      "id": "1327",
      "user_id": "1",
      "friend_id": "67",
      "message_type": "knowledge",
      "type_id": "1312",
      "message": "Team added a new message.",
      "read": "0",
      "created_at": "2016-05-13 12:41:47",
      "updated_at": "2016-05-13 12:41:47",
      "image": "1_1463145040.jpg"
      },
      {
      "id": "1201",
      "user_id": "1",
      "friend_id": "67",
      "message_type": "knowledge",
      "type_id": "1311",
      "message": "Team added a new message.",
      "read": "0",
      "created_at": "2016-05-13 12:26:25",
      "updated_at": "2016-05-13 12:26:25",
      "image": "1_1463145040.jpg"
      },
      {
      "id": "1173",
      "user_id": "67",
      "friend_id": "67",
      "message_type": "perfomance",
      "type_id": "67",
      "message": "Congrats. Your level has been upgraded to 42.",
      "read": "0",
      "created_at": "2016-05-06 08:56:09",
      "updated_at": "2016-05-06 08:56:09",
      "image": "67_1460107183.jpg"
      },
      {
      "id": "1155",
      "user_id": "17",
      "friend_id": "67",
      "message_type": "comment",
      "type_id": "1244",
      "message": "Vinish commented on your feed.",
      "read": "1",
      "created_at": "2016-04-28 05:58:27",
      "updated_at": "2016-05-05 05:18:02",
      "image": "17_1457639358.jpg"
      },
      {
      "id": "1152",
      "user_id": "67",
      "friend_id": "67",
      "message_type": "perfomance",
      "type_id": "67",
      "message": "Congrats. Your level has been upgraded to 41.",
      "read": "1",
      "created_at": "2016-04-26 09:10:50",
      "updated_at": "2016-05-05 05:18:02",
      "image": "67_1460107183.jpg"
      },
      {
      "id": "1019",
      "user_id": "1",
      "friend_id": "67",
      "message_type": "knowledge",
      "type_id": "1238",
      "message": "Team added a new message.",
      "read": "1",
      "created_at": "2016-04-21 08:22:35",
      "updated_at": "2016-04-22 10:59:07",
      "image": "1_1463145040.jpg"
      },
      {
      "id": "897",
      "user_id": "1",
      "friend_id": "67",
      "message_type": "knowledge",
      "type_id": "1237",
      "message": "Team added a new message.",
      "read": "1",
      "created_at": "2016-04-21 08:22:04",
      "updated_at": "2016-04-22 10:59:14",
      "image": "1_1463145040.jpg"
      },
      {
      "id": "774",
      "user_id": "1",
      "friend_id": "67",
      "message_type": "knowledge",
      "type_id": "1236",
      "message": "Team added a new message.",
      "read": "1",
      "created_at": "2016-04-21 08:13:47",
      "updated_at": "2016-04-22 10:59:19",
      "image": "1_1463145040.jpg"
      },
      {
      "id": "652",
      "user_id": "1",
      "friend_id": "67",
      "message_type": "knowledge",
      "type_id": "1235",
      "message": "Team added a new message.",
      "read": "1",
      "created_at": "2016-04-21 08:12:43",
      "updated_at": "2016-04-22 10:38:43",
      "image": "1_1463145040.jpg"
      },
      {
      "id": "616",
      "user_id": "67",
      "friend_id": "67",
      "message_type": "perfomance",
      "type_id": "67",
      "message": "Congrats. Your level has been upgraded to 40.",
      "read": "1",
      "created_at": "2016-04-13 06:35:49",
      "updated_at": "2016-05-05 05:18:02",
      "image": "67_1460107183.jpg"
      },
      {
      "id": "612",
      "user_id": "67",
      "friend_id": "67",
      "message_type": "perfomance",
      "type_id": "67",
      "message": "Congrats. Your level has been upgraded to 39.",
      "read": "1",
      "created_at": "2016-04-12 07:14:32",
      "updated_at": "2016-05-05 05:18:02",
      "image": "67_1460107183.jpg"
      },
      {
      "id": "608",
      "user_id": "67",
      "friend_id": "67",
      "message_type": "perfomance",
      "type_id": "67",
      "message": "Congrats. Your level has been upgraded to 38.",
      "read": "1",
      "created_at": "2016-04-08 15:19:13",
      "updated_at": "2016-05-05 05:18:02",
      "image": "67_1460107183.jpg"
      },
      {
      "id": "599",
      "user_id": "67",
      "friend_id": "67",
      "message_type": "perfomance",
      "type_id": "67",
      "message": "Congrats. Your level has been upgraded to 37.",
      "read": "1",
      "created_at": "2016-04-07 13:41:29",
      "updated_at": "2016-05-05 05:18:02",
      "image": "67_1460107183.jpg"
      },
      {
      "id": "584",
      "user_id": "67",
      "friend_id": "67",
      "message_type": "perfomance",
      "type_id": "67",
      "message": "Congrats. Your level has been upgraded to 36.",
      "read": "1",
      "created_at": "2016-04-05 05:20:32",
      "updated_at": "2016-05-05 05:18:02",
      "image": "67_1460107183.jpg"
      },
      {
      "id": "581",
      "user_id": "67",
      "friend_id": "67",
      "message_type": "perfomance",
      "type_id": "67",
      "message": "Congrats. Your level has been upgraded to 35.",
      "read": "1",
      "created_at": "2016-03-31 17:46:28",
      "updated_at": "2016-05-05 05:18:02",
      "image": "67_1460107183.jpg"
      },
      {
      "id": "579",
      "user_id": "67",
      "friend_id": "67",
      "message_type": "perfomance",
      "type_id": "67",
      "message": "Congrats. Your level has been upgraded to 34.",
      "read": "1",
      "created_at": "2016-03-31 14:47:34",
      "updated_at": "2016-05-05 05:18:02",
      "image": "67_1460107183.jpg"
      },
      {
      "id": "570",
      "user_id": "17",
      "friend_id": "67",
      "message_type": "comment",
      "type_id": "1097",
      "message": "Vinish commented on your feed.",
      "read": "1",
      "created_at": "2016-03-30 06:44:43",
      "updated_at": "2016-04-25 19:10:09",
      "image": "17_1457639358.jpg"
      },
      {
      "id": "569",
      "user_id": "17",
      "friend_id": "67",
      "message_type": "comment",
      "type_id": "1115",
      "message": "Vinish commented on your feed.",
      "read": "1",
      "created_at": "2016-03-30 06:34:56",
      "updated_at": "2016-04-22 10:59:04",
      "image": "17_1457639358.jpg"
      },
      {
      "id": "568",
      "user_id": "17",
      "friend_id": "67",
      "message_type": "comment",
      "type_id": "1115",
      "message": "Vinish commented on your feed.",
      "read": "1",
      "created_at": "2016-03-30 06:23:17",
      "updated_at": "2016-04-22 10:59:04",
      "image": "17_1457639358.jpg"
      },
      {
      "id": "567",
      "user_id": "17",
      "friend_id": "67",
      "message_type": "comment",
      "type_id": "1115",
      "message": "Vinish commented on your feed.",
      "read": "1",
      "created_at": "2016-03-30 06:22:20",
      "updated_at": "2016-04-22 10:59:04",
      "image": "17_1457639358.jpg"
      },
      {
      "id": "566",
      "user_id": "17",
      "friend_id": "67",
      "message_type": "comment",
      "type_id": "1115",
      "message": "Vinish commented on your feed.",
      "read": "1",
      "created_at": "2016-03-30 06:21:40",
      "updated_at": "2016-04-22 10:59:04",
      "image": "17_1457639358.jpg"
      },
      {
      "id": "565",
      "user_id": "17",
      "friend_id": "67",
      "message_type": "comment",
      "type_id": "1115",
      "message": "Vinish commented on your feed.",
      "read": "1",
      "created_at": "2016-03-30 06:19:48",
      "updated_at": "2016-04-22 10:59:04",
      "image": "17_1457639358.jpg"
      },
      {
      "id": "564",
      "user_id": "17",
      "friend_id": "67",
      "message_type": "comment",
      "type_id": "1115",
      "message": "Vinish commented on your feed.",
      "read": "1",
      "created_at": "2016-03-30 06:19:42",
      "updated_at": "2016-04-22 10:59:04",
      "image": "17_1457639358.jpg"
      },
      {
      "id": "563",
      "user_id": "67",
      "friend_id": "67",
      "message_type": "perfomance",
      "type_id": "67",
      "message": "Congrats. Your level has been upgraded to 33.",
      "read": "1",
      "created_at": "2016-03-30 05:08:15",
      "updated_at": "2016-05-05 05:18:02",
      "image": "67_1460107183.jpg"
      },
      {
      "id": "551",
      "user_id": "67",
      "friend_id": "67",
      "message_type": "perfomance",
      "type_id": "67",
      "message": "Congrats. Your level has been upgraded to 32.",
      "read": "1",
      "created_at": "2016-03-17 12:27:49",
      "updated_at": "2016-05-05 05:18:02",
      "image": "67_1460107183.jpg"
      },
      {
      "id": "550",
      "user_id": "67",
      "friend_id": "67",
      "message_type": "perfomance",
      "type_id": "67",
      "message": "Congrats. Your level has been upgraded to 31.",
      "read": "1",
      "created_at": "2016-03-17 11:49:32",
      "updated_at": "2016-05-05 05:18:02",
      "image": "67_1460107183.jpg"
      },
      {
      "id": "549",
      "user_id": "67",
      "friend_id": "67",
      "message_type": "perfomance",
      "type_id": "67",
      "message": "Congrats. Your level has been upgraded to 30.",
      "read": "1",
      "created_at": "2016-03-17 10:55:03",
      "updated_at": "2016-05-05 05:18:02",
      "image": "67_1460107183.jpg"
      },
      {
      "id": "548",
      "user_id": "67",
      "friend_id": "67",
      "message_type": "perfomance",
      "type_id": "67",
      "message": "Congrats. Your level has been upgraded to 29.",
      "read": "1",
      "created_at": "2016-03-17 10:29:01",
      "updated_at": "2016-05-05 05:18:02",
      "image": "67_1460107183.jpg"
      },
      {
      "id": "547",
      "user_id": "67",
      "friend_id": "67",
      "message_type": "perfomance",
      "type_id": "67",
      "message": "Congrats. Your level has been upgraded to 28.",
      "read": "1",
      "created_at": "2016-03-17 09:54:53",
      "updated_at": "2016-05-05 05:18:02",
      "image": "67_1460107183.jpg"
      },
      {
      "id": "546",
      "user_id": "67",
      "friend_id": "67",
      "message_type": "perfomance",
      "type_id": "67",
      "message": "Congrats. Your level has been upgraded to 27.",
      "read": "1",
      "created_at": "2016-03-17 09:50:43",
      "updated_at": "2016-05-05 05:18:02",
      "image": "67_1460107183.jpg"
      },
      {
      "id": "545",
      "user_id": "67",
      "friend_id": "67",
      "message_type": "perfomance",
      "type_id": "67",
      "message": "Congrats. Your level has been upgraded to 26.",
      "read": "1",
      "created_at": "2016-03-17 09:03:52",
      "updated_at": "2016-05-05 05:18:02",
      "image": "67_1460107183.jpg"
      },
      {
      "id": "544",
      "user_id": "67",
      "friend_id": "67",
      "message_type": "perfomance",
      "type_id": "67",
      "message": "Congrats. Your level has been upgraded to 25.",
      "read": "1",
      "created_at": "2016-03-17 09:01:28",
      "updated_at": "2016-05-05 05:18:02",
      "image": "67_1460107183.jpg"
      },
      {
      "id": "537",
      "user_id": "67",
      "friend_id": "67",
      "message_type": "perfomance",
      "type_id": "67",
      "message": "Congrats. Your level has been upgraded to 24.",
      "read": "1",
      "created_at": "2016-03-15 11:04:31",
      "updated_at": "2016-05-05 05:18:02",
      "image": "67_1460107183.jpg"
      },
      {
      "id": "536",
      "user_id": "67",
      "friend_id": "67",
      "message_type": "perfomance",
      "type_id": "67",
      "message": "Congrats. Your level has been upgraded to 23.",
      "read": "1",
      "created_at": "2016-03-15 10:08:59",
      "updated_at": "2016-05-05 05:18:02",
      "image": "67_1460107183.jpg"
      },
      {
      "id": "514",
      "user_id": "1",
      "friend_id": "67",
      "message_type": "knowledge",
      "type_id": "1032",
      "message": "Team added a new message.",
      "read": "1",
      "created_at": "2016-03-13 16:53:59",
      "updated_at": "2016-03-18 11:59:52",
      "image": "1_1463145040.jpg"
      },
      {
      "id": "493",
      "user_id": "67",
      "friend_id": "67",
      "message_type": "perfomance",
      "type_id": "67",
      "message": "Congrats. Your level has been upgraded to 22.",
      "read": "1",
      "created_at": "2016-03-11 11:55:12",
      "updated_at": "2016-05-05 05:18:02",
      "image": "67_1460107183.jpg"
      },
      {
      "id": "491",
      "user_id": "67",
      "friend_id": "67",
      "message_type": "perfomance",
      "type_id": "67",
      "message": "Congrats. Your level has been upgraded to 21.",
      "read": "1",
      "created_at": "2016-03-11 10:07:29",
      "updated_at": "2016-05-05 05:18:02",
      "image": "67_1460107183.jpg"
      },
      {
      "id": "483",
      "user_id": "67",
      "friend_id": "67",
      "message_type": "perfomance",
      "type_id": "67",
      "message": "Congrats. Your level has been upgraded to 20.",
      "read": "1",
      "created_at": "2016-03-08 12:38:42",
      "updated_at": "2016-05-05 05:18:02",
      "image": "67_1460107183.jpg"
      },
      {
      "id": "462",
      "user_id": "67",
      "friend_id": "67",
      "message_type": "perfomance",
      "type_id": "67",
      "message": "Congrats. Your level has been upgraded to 19.",
      "read": "1",
      "created_at": "2016-03-03 09:23:46",
      "updated_at": "2016-05-05 05:18:02",
      "image": "67_1460107183.jpg"
      },
      {
      "id": "458",
      "user_id": "67",
      "friend_id": "67",
      "message_type": "perfomance",
      "type_id": "67",
      "message": "Congrats. Your level has been upgraded to 18.",
      "read": "1",
      "created_at": "2016-02-24 05:08:42",
      "updated_at": "2016-05-05 05:18:02",
      "image": "67_1460107183.jpg"
      },
      {
      "id": "448",
      "user_id": "67",
      "friend_id": "67",
      "message_type": "perfomance",
      "type_id": "67",
      "message": "Congrats. Your level has been upgraded to 17.",
      "read": "1",
      "created_at": "2016-02-19 14:05:15",
      "updated_at": "2016-05-05 05:18:02",
      "image": "67_1460107183.jpg"
      },
      {
      "id": "437",
      "user_id": "67",
      "friend_id": "67",
      "message_type": "perfomance",
      "type_id": "67",
      "message": "Congrats. Your level has been upgraded to 16.",
      "read": "1",
      "created_at": "2016-02-18 09:53:55",
      "updated_at": "2016-05-05 05:18:02",
      "image": "67_1460107183.jpg"
      },
      {
      "id": "435",
      "user_id": "67",
      "friend_id": "67",
      "message_type": "perfomance",
      "type_id": "67",
      "message": "Congrats. Your level has been upgraded to 15.",
      "read": "1",
      "created_at": "2016-02-17 11:39:52",
      "updated_at": "2016-05-05 05:18:02",
      "image": "67_1460107183.jpg"
      },
      {
      "id": "434",
      "user_id": "67",
      "friend_id": "67",
      "message_type": "perfomance",
      "type_id": "67",
      "message": "Congrats. Your level has been upgraded to 14.",
      "read": "1",
      "created_at": "2016-02-17 11:01:16",
      "updated_at": "2016-05-05 05:18:02",
      "image": "67_1460107183.jpg"
      },
      {
      "id": "433",
      "user_id": "67",
      "friend_id": "67",
      "message_type": "perfomance",
      "type_id": "67",
      "message": "Congrats. Your level has been upgraded to 13.",
      "read": "1",
      "created_at": "2016-02-17 08:59:44",
      "updated_at": "2016-05-05 05:18:02",
      "image": "67_1460107183.jpg"
      },
      {
      "id": "432",
      "user_id": "67",
      "friend_id": "67",
      "message_type": "perfomance",
      "type_id": "67",
      "message": "Congrats. Your level has been upgraded to 12.",
      "read": "1",
      "created_at": "2016-02-17 07:02:02",
      "updated_at": "2016-05-05 05:18:02",
      "image": "67_1460107183.jpg"
      },
      {
      "id": "430",
      "user_id": "67",
      "friend_id": "67",
      "message_type": "perfomance",
      "type_id": "67",
      "message": "Congrats. Your level has been upgraded to 11.",
      "read": "1",
      "created_at": "2016-02-17 06:44:30",
      "updated_at": "2016-05-05 05:18:02",
      "image": "67_1460107183.jpg"
      },
      {
      "id": "429",
      "user_id": "67",
      "friend_id": "67",
      "message_type": "perfomance",
      "type_id": "67",
      "message": "Congrats. Your level has been upgraded to 10.",
      "read": "1",
      "created_at": "2016-02-17 06:41:16",
      "updated_at": "2016-05-05 05:18:02",
      "image": "67_1460107183.jpg"
      },
      {
      "id": "427",
      "user_id": "67",
      "friend_id": "67",
      "message_type": "perfomance",
      "type_id": "67",
      "message": "Congrats. Your level has been upgraded to 9.",
      "read": "1",
      "created_at": "2016-02-17 06:28:33",
      "updated_at": "2016-05-05 05:18:02",
      "image": "67_1460107183.jpg"
      },
      {
      "id": "426",
      "user_id": "67",
      "friend_id": "67",
      "message_type": "perfomance",
      "type_id": "67",
      "message": "Congrats. Your level has been upgraded to 8.",
      "read": "1",
      "created_at": "2016-02-17 06:20:13",
      "updated_at": "2016-05-05 05:18:02",
      "image": "67_1460107183.jpg"
      },
      {
      "id": "425",
      "user_id": "67",
      "friend_id": "67",
      "message_type": "perfomance",
      "type_id": "67",
      "message": "Congrats. Your level has been upgraded to 7.",
      "read": "1",
      "created_at": "2016-02-17 05:52:29",
      "updated_at": "2016-05-05 05:18:02",
      "image": "67_1460107183.jpg"
      },
      {
      "id": "421",
      "user_id": "67",
      "friend_id": "67",
      "message_type": "perfomance",
      "type_id": "67",
      "message": "Congrats. Your level has been upgraded to 6.",
      "read": "1",
      "created_at": "2016-02-15 09:39:32",
      "updated_at": "2016-05-05 05:18:02",
      "image": "67_1460107183.jpg"
      },
      {
      "id": "419",
      "user_id": "67",
      "friend_id": "67",
      "message_type": "perfomance",
      "type_id": "67",
      "message": "Congrats. Your level has been upgraded to 5.",
      "read": "1",
      "created_at": "2016-02-12 15:20:21",
      "updated_at": "2016-05-05 05:18:02",
      "image": "67_1460107183.jpg"
      },
      {
      "id": "417",
      "user_id": "67",
      "friend_id": "67",
      "message_type": "perfomance",
      "type_id": "67",
      "message": "Congrats. Your level has been upgraded to 3.",
      "read": "1",
      "created_at": "2016-02-12 15:07:54",
      "updated_at": "2016-05-05 05:18:02",
      "image": "67_1460107183.jpg"
      }
      ],
      "unread_notification_count": 6,
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
     * @apiError error Validation error.
     * @apiError error user_not_exists
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
     *     HTTP/1.1 400 Validation error
     *     {
     *       "status" : 0,
     *       "error": "The user_id field is required"
     *     }
     * 
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 400 user_not_exists
     *     {
     *       "status" : 0,
     *       "error": "user_not_exists"
     *     }  
     *  
     */
    public function listNotifications(Request $request)
    {
        if (!isset($request->user_id) || ($request->user_id == null)) {
            return response()->json(["status" => "0", "error" => "The user_id field is required"]);
        } else {
            $user = User::where('id', '=', $request->input('user_id'))->first();
            if ($user) {
                $notifications = Message::where('message.friend_id', '=', $request->input('user_id'))
                    ->join('user_profiles', 'user_profiles.user_id', '=', 'message.user_id')
                    ->select(array('message.*', 'user_profiles.image'))
                    ->orderBy('message.id', 'DESC')
                    ->get();

                $unreadNotificationCnt = Message::where('message.friend_id', '=', $request->user_id)
                    ->where('message.read', 0)
                    ->count();
                return response()->json(['status' => 1, 'notifications' => $notifications, 'unread_notification_count' => $unreadNotificationCnt, 'urls' => config('urls.urls')], 200);
            } else {
                return response()->json(['status' => 0, 'error' => 'user_not_exists'], 422);
            }
        }
    }

    /**
     * @api {post} /message/updateReadStatus updateReadStatus
     * @apiName updateReadStatus
     * @apiGroup Message
     * @apiParam {Number} user_id Id of user *required
     * @apiParam {Number} message_id message of user *required
     * @apiSuccess {String} success.
     * 
     * @apiSuccessExample Success-Response:
     * HTTP/1.1 200 OK
     * {
      "status": 1,
      "success": "Successfully Updated",
      "unread_notification_count": 5
      }
     * 
     * @apiError error Message token_invalid.
     * @apiError error Message token_expired.
     * @apiError error Message token_not_provided.
     * @apiError error Validation error.
     * @apiError error user_not_exists
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
     *     HTTP/1.1 400 Validation error
     *     {
     *       "status" : 0,
     *       "error": "The user_id field is required"
     *     }
     * 
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 400 user_not_exists
     *     {
     *       "status" : 0,
     *       "error": "user_not_exists"
     *     }  
     * @apiErrorExample Error-Response:
     *   HTTP/1.1 400 user_not_exists
     *    {
      "status": 0,
      "error": "message_not_exists"
      }
     */
    public function updateReadStatus(Request $request)
    {
        if (!isset($request->user_id) || ($request->user_id == null)) {
            return response()->json(["status" => "0", "error" => "The user_id field is required"]);
        } if (!isset($request->message_id) || ($request->message_id == null)) {
            return response()->json(["status" => "0", "error" => "The message_id field is required"]);
        } else {
            $user = User::where('id', '=', $request->input('user_id'))->first();
            if ($user) {
                $notification = Message::where('id', '=', $request->message_id)->first();
                if (!empty($notification)) {

                    Message::where('user_id', $notification->user_id)
                        ->where('friend_id', $notification->friend_id)
                        ->where('message_type', $notification->message_type)
                        ->where('type_id', $notification->type_id)
                        ->update(['read' => 1]);

                    $unreadNotificationCnt = Message::where('message.friend_id', '=', $request->user_id)
                        ->where('message.read', 0)
                        ->count();

                    return response()->json(['status' => 1, 'success' => 'Successfully Updated', 'unread_notification_count' => $unreadNotificationCnt], 200);
                } else {
                    return response()->json(['status' => 0, 'error' => 'message_not_exists'], 422);
                }
            } else {
                return response()->json(['status' => 0, 'error' => 'user_not_exists'], 422);
            }
        }
    }
}

?>