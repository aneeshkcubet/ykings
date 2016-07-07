define({ "api": [
  {
    "type": "post",
    "url": "/coach/finishday",
    "title": "finishCoachDayWorkouts",
    "name": "finishCoachDayWorkouts",
    "group": "Coach",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "<p>Number</p> ",
            "optional": false,
            "field": "user_id",
            "description": "<p>Id of user *required</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>Number</p> ",
            "optional": false,
            "field": "day",
            "description": "<p>Id of user *required</p> "
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "<p>String</p> ",
            "optional": false,
            "field": "success.",
            "description": ""
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n{\n      \"status\": 1,\n      \"message\": \"successfully finished day workouts\",\n      \"coach_day\": \"1\",\n      \"coach_week\": \"1\",\n      \"is_subscribed\": 0,\n      \"need_update\": 1,\n      \"week_status\": {\n      \"1\": 1\n      },\n      \"day_status\": {\n      \"1\": 1,\n      \"2\": 1\n      },\n      \"week_points\": 0\n      }",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "error",
            "description": "<p>Message token_invalid.</p> "
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 400 Invalid Request\n{\n  \"status\":\"0\",\n  \"error\": \"token_invalid\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 401 Unauthorised\n{\n  \"status\":\"0\",\n  \"error\": \"token_expired\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 400 Bad Request\n{\n  \"status\":\"0\",\n  \"error\": \"token_not_provided\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 422 Validation error\n{\n  \"status\" : 0,\n  \"error\": \"The user_id field is required\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 500 user_not_exists\n{\n  \"status\" : 0,\n  \"error\": \"user_not_exists\"\n}",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "app/Http/Controllers/Api/CoachesController.php",
    "groupTitle": "Coach"
  },
  {
    "type": "post",
    "url": "/coach/finishweek",
    "title": "finishCoachWeekWorkouts",
    "name": "finishCoachWeekWorkouts",
    "group": "Coach",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "<p>Number</p> ",
            "optional": false,
            "field": "user_id",
            "description": "<p>Id of user *required</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>Number</p> ",
            "optional": false,
            "field": "week",
            "description": "<p>*required</p> "
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "<p>String</p> ",
            "optional": false,
            "field": "success.",
            "description": ""
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "error",
            "description": "<p>Message token_invalid.</p> "
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 400 Invalid Request\n{\n  \"status\":\"0\",\n  \"error\": \"token_invalid\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 401 Unauthorised\n{\n  \"status\":\"0\",\n  \"error\": \"token_expired\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 400 Bad Request\n{\n  \"status\":\"0\",\n  \"error\": \"token_not_provided\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 422 Validation error\n{\n  \"status\" : 0,\n  \"error\": \"The user_id field is required\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 500 user_not_exists\n{\n  \"status\" : 0,\n  \"error\": \"user_not_exists\"\n}",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "app/Http/Controllers/Api/CoachesController.php",
    "groupTitle": "Coach"
  },
  {
    "type": "post",
    "url": "/coach/get",
    "title": "getCoach",
    "name": "getCoach",
    "group": "Coach",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "<p>Number</p> ",
            "optional": false,
            "field": "user_id",
            "description": "<p>Id of user *required</p> "
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "<p>String</p> ",
            "optional": false,
            "field": "success.",
            "description": ""
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n{\n      \"status\": 1,\n      \"message\": \"coach_exercises\",\n      \"coach_day\": \"1\",\n      \"coach_week\": \"1\",\n      \"is_subscribed\": 1,\n      \"need_update\": 0,\n      \"week_status\": {\n      \"1\": 0\n      },\n      \"day_status\": {\n      \"1\": 0,\n      \"2\": 0,\n      \"3\": 0,\n      \"4\": 0,\n      \"5\": 0,\n      \"6\": 0\n      },\n      \"week_points\": \"330.00\",\n      \"coach\": {\n      \"id\": \"490\",\n      \"user_id\": \"67\",\n      \"focus\": \"2\",\n      \"height\": \"0.00\",\n      \"weight\": \"0.00\",\n      \"days\": \"6\",\n      \"exercises\": {\n      \"day1\": {\n      \"warmup\": [\n      {\n      \"id\": \"1\",\n      \"name\": \"wall extensions\",\n      \"duration\": {\n      \"min\": \"10\",\n      \"max\": \"20\"\n      },\n      \"unit\": \"times\",\n      \"created_at\": \"2016-01-21 08:55:06\",\n      \"updated_at\": \"2016-01-21 08:55:06\",\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"2\",\n      \"name\": \"band dislocates\",\n      \"duration\": {\n      \"min\": \"10\",\n      \"max\": \"20\"\n      },\n      \"unit\": \"times\",\n      \"created_at\": \"2016-01-21 08:57:38\",\n      \"updated_at\": \"2016-01-21 08:57:38\",\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"3\",\n      \"name\": \"cat-camels\",\n      \"duration\": {\n      \"min\": \"10\",\n      \"max\": \"20\"\n      },\n      \"unit\": \"times\",\n      \"created_at\": \"2016-01-21 09:00:39\",\n      \"updated_at\": \"2016-01-21 09:00:39\",\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"4\",\n      \"name\": \"scapular shrugs\",\n      \"duration\": {\n      \"min\": \"10\",\n      \"max\": \"20\"\n      },\n      \"unit\": \"times\",\n      \"created_at\": \"2016-01-21 09:01:01\",\n      \"updated_at\": \"2016-01-21 09:01:01\",\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"5\",\n      \"name\": \"full body circles\",\n      \"duration\": {\n      \"min\": \"10\",\n      \"max\": \"20\"\n      },\n      \"unit\": \"times\",\n      \"created_at\": \"2016-01-21 09:01:26\",\n      \"updated_at\": \"2016-01-21 09:01:26\",\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"6\",\n      \"name\": \"Jumping Jacks\",\n      \"duration\": {\n      \"min\": \"100\",\n      \"max\": \"\"\n      },\n      \"unit\": \"seconds\",\n      \"created_at\": \"2016-01-21 09:04:52\",\n      \"updated_at\": \"2016-01-21 09:04:52\",\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"7\",\n      \"name\": \"Arm rotations\",\n      \"duration\": {\n      \"min\": \"120\",\n      \"max\": \"\"\n      },\n      \"unit\": \"times\",\n      \"created_at\": \"2016-01-21 09:05:29\",\n      \"updated_at\": \"2016-01-21 09:05:29\",\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"8\",\n      \"name\": \"High Knees\",\n      \"duration\": {\n      \"min\": \"50\",\n      \"max\": \"\"\n      },\n      \"unit\": \"times\",\n      \"created_at\": \"2016-01-21 09:06:02\",\n      \"updated_at\": \"2016-01-21 09:06:02\",\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"9\",\n      \"name\": \"Shouder rolls\",\n      \"duration\": {\n      \"min\": \"20\",\n      \"max\": \"\"\n      },\n      \"unit\": \"times\",\n      \"created_at\": \"2016-01-21 09:06:34\",\n      \"updated_at\": \"2016-01-21 09:06:34\",\n      \"is_completed\": 0\n      }\n      ],\n      \"is_completed\": 0,\n      \"fundumentals\": [\n      {\n      \"id\": \"16\",\n      \"row\": \"4\",\n      \"exercise_id\": \"57\",\n      \"duration\": {\n      \"min\": \"15\",\n      \"max\": \"\"\n      },\n      \"unit\": \"times\",\n      \"is_completed\": \"0\",\n      \"created_at\": \"2016-01-22 04:51:17\",\n      \"updated_at\": \"2016-04-04 12:10:48\",\n      \"exercise\": {\n      \"id\": \"57\",\n      \"name\": \"Knee Raises\",\n      \"description\": \"Develop grip and core strength and get used to slow and controlled moves\",\n      \"category\": \"1\",\n      \"type\": \"2\",\n      \"muscle_groups\": \"4,6,7\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \"1. Start from a deadhang position with your arms and legs fully extended, and feet off the ground.  \\r\\n2. Raise your knees up towards your chest as high as possible. \\r\\n3. Hold for a brief moment and slowly return to the starting position. \\r\\n4. Repeat for required repetitions. \",\n      \"video_tips\": \"    \",\n      \"pro_tips\": \"Avoid using momentum or swinging during the exercise. \\r\\nPerform the knee raise slowly and controlled.\",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Back, Core, Legs\",\n      \"video\": [\n      {\n      \"id\": \"67\",\n      \"path\": \"57_1454044213.mp4\",\n      \"videothumbnail\": \"57_1454044213.jpg\",\n      \"description\": \"Knee Raises\"\n      }\n      ]\n      }\n      },\n      {\n      \"id\": \"17\",\n      \"row\": \"4\",\n      \"exercise_id\": \"78\",\n      \"duration\": {\n      \"min\": \"20\",\n      \"max\": \"\"\n      },\n      \"unit\": \"times\",\n      \"is_completed\": \"0\",\n      \"created_at\": \"2016-01-22 04:52:22\",\n      \"updated_at\": \"2016-04-04 14:00:58\",\n      \"exercise\": {\n      \"id\": \"78\",\n      \"name\": \"Australian Pullups\",\n      \"description\": \"Get started with developing your grip and back strength\",\n      \"category\": \"1\",\n      \"type\": \"2\",\n      \"muscle_groups\": \"1,4,5,6\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \"1. Grip a bar that is suspended at around waist height, with the feet resting on the ground.\\r\\n2. Squeeze the shoulder blades together and pull your chest up to the bar\",\n      \"video_tips\": \"    \",\n      \"pro_tips\": \"The closer the body is to horizontal the more difficult the exercise becomes.?\\r\\nA set of height adjustable gymnastics rings are a good alternative.\\r\\nKeep whole body engaged and keep your butt in line with your body.?  \",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Shoulders, Back, Arms, Core\",\n      \"video\": [\n      {\n      \"id\": \"78\",\n      \"path\": \"78_1454045971.mp4\",\n      \"videothumbnail\": \"78_1454045971.jpg\",\n      \"description\": \"Australian Pullups\"\n      }\n      ]\n      }\n      },\n      {\n      \"id\": \"18\",\n      \"row\": \"4\",\n      \"exercise_id\": \"49\",\n      \"duration\": {\n      \"min\": \"30\",\n      \"max\": \"\"\n      },\n      \"unit\": \"times\",\n      \"is_completed\": \"0\",\n      \"created_at\": \"2016-01-22 04:52:56\",\n      \"updated_at\": \"2016-04-04 14:19:29\",\n      \"exercise\": {\n      \"id\": \"49\",\n      \"name\": \"Side Triceps\",\n      \"description\": \"Start with the basics of building triceps strength\",\n      \"category\": \"1\",\n      \"type\": \"1\",\n      \"muscle_groups\": \"3\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \" 1. Start with the body on your side\\r\\n2. Put one hand on your shoulder \\r\\n3. Press up with the other arm and hold in extension \",\n      \"video_tips\": \"          \",\n      \"pro_tips\": \" Avoid supporting the movement with your core muscle.      \",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Triceps\",\n      \"video\": [\n      {\n      \"id\": \"43\",\n      \"path\": \"49_1454043404.mp4\",\n      \"videothumbnail\": \"49_1454043404.jpg\",\n      \"description\": \"Side Triceps\"\n      }\n      ]\n      }\n      },\n      {\n      \"id\": \"19\",\n      \"row\": \"4\",\n      \"exercise_id\": \"45\",\n      \"duration\": {\n      \"min\": \"25\",\n      \"max\": \"\"\n      },\n      \"unit\": \"times\",\n      \"is_completed\": \"0\",\n      \"created_at\": \"2016-01-22 04:53:50\",\n      \"updated_at\": \"2016-04-04 14:16:38\",\n      \"exercise\": {\n      \"id\": \"45\",\n      \"name\": \"Squats\",\n      \"description\": \"Get strong with a world class full body compound exercise\",\n      \"category\": \"2\",\n      \"type\": \"1\",\n      \"muscle_groups\": \"7\",\n      \"rewards\": \"7.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \" 1. Start from a standing position\\r\\n2. Go down in a squat \\r\\n3. Keep your hands in front of you and press yourself up \",\n      \"video_tips\": \"      \",\n      \"pro_tips\": \" Lock the knees out while squeezing the glutes to execute properly.\\r\\nSquat deep and hold for 1-2 secs, ass to the grass!     \",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Legs\",\n      \"video\": [\n      {\n      \"id\": \"41\",\n      \"path\": \"45_1454043104.mp4\",\n      \"videothumbnail\": \"45_1454043104.jpg\",\n      \"description\": \"Squats\"\n      }\n      ]\n      }\n      },\n      {\n      \"id\": \"20\",\n      \"row\": \"4\",\n      \"exercise_id\": \"32\",\n      \"duration\": {\n      \"min\": \"20\",\n      \"max\": \"\"\n      },\n      \"unit\": \"times\",\n      \"is_completed\": \"0\",\n      \"created_at\": \"2016-01-22 04:54:35\",\n      \"updated_at\": \"2016-04-04 11:06:44\",\n      \"exercise\": {\n      \"id\": \"32\",\n      \"name\": \"Sprawl\",\n      \"description\": \"Boost your cardio and strength with sprawls\",\n      \"category\": \"1\",\n      \"type\": \"1\",\n      \"muscle_groups\": \"8\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \"1. Start in a standing position\\r\\n2. Go into a straight arm plank position\\r\\n3. Go back up and jump with your hands above your head\",\n      \"video_tips\": \"    \",\n      \"pro_tips\": \"Avoid a hollow back during the movement. \\r\\nKeep the core and lower back engaged at all times.\",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Full Body\",\n      \"video\": [\n      {\n      \"id\": \"29\",\n      \"path\": \"32_1454041954.mp4\",\n      \"videothumbnail\": \"32_1454041954.jpg\",\n      \"description\": \"Sprawl\"\n      }\n      ]\n      }\n      }\n      ],\n      \"exercises\": [],\n      \"workout\": {\n      \"id\": \"3\",\n      \"name\": \"Bragi\",\n      \"description\": \"D,C,A\",\n      \"rounds\": \"5\",\n      \"category\": \"2\",\n      \"type\": \"2\",\n      \"rewards\": \"440\",\n      \"duration\": \"480.00\",\n      \"equipments\": \"Bar/Rings\",\n      \"is_completed\": 0,\n      \"exercises\": {\n      \"round1\": [\n      {\n      \"id\": \"100\",\n      \"workout_id\": \"3\",\n      \"category\": \"1\",\n      \"repititions\": \"10\",\n      \"exercise_id\": \"14\",\n      \"unit\": \"times\",\n      \"round\": \"1\",\n      \"created_at\": \"2016-01-19 04:18:12\",\n      \"updated_at\": \"2016-04-04 09:33:39\",\n      \"exercise\": {\n      \"id\": \"14\",\n      \"name\": \"Incline Pushups\",\n      \"description\": \"Start your journey with the simplest way to develop an athletic physique\",\n      \"category\": \"1\",\n      \"type\": \"1\",\n      \"muscle_groups\": \"1,2,3\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \"1. Place hands on edge of bench, bar or rings at waist height, slightly wider than shoulder width \\r\\n2. Perform regular pushup. Arms should be perpendicular to body. \\r\\n  \",\n      \"video_tips\": \"    \",\n      \"pro_tips\": \"Resistance can be de- or increased by performing movement on different angles.\\r\\nAvoid rounding your spine and doing ?banana back? pushups, try squeezing your core.\\r\\n  \",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Shoulders, Chest, Triceps\"\n      },\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"105\",\n      \"workout_id\": \"3\",\n      \"category\": \"1\",\n      \"repititions\": \"25\",\n      \"exercise_id\": \"36\",\n      \"unit\": \"times\",\n      \"round\": \"1\",\n      \"created_at\": \"2016-01-19 04:19:20\",\n      \"updated_at\": \"2016-04-04 11:12:49\",\n      \"exercise\": {\n      \"id\": \"36\",\n      \"name\": \"High Jumps\",\n      \"description\": \"Do high jumps as a part of restless HIIT workouts\",\n      \"category\": \"1\",\n      \"type\": \"2\",\n      \"muscle_groups\": \"7\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \"1. Start from a standing position\\r\\n2. Jump up and bring your knees to your chest\",\n      \"video_tips\": \"    \",\n      \"pro_tips\": \"Land softly and exhale when the knees are up.\\r\\n  \",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Legs\"\n      },\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"110\",\n      \"workout_id\": \"3\",\n      \"category\": \"1\",\n      \"repititions\": \"7\",\n      \"exercise_id\": \"66\",\n      \"unit\": \"times\",\n      \"round\": \"1\",\n      \"created_at\": \"2016-01-19 04:19:53\",\n      \"updated_at\": \"2016-04-04 14:31:38\",\n      \"exercise\": {\n      \"id\": \"69\",\n      \"name\": \"Jumping Pullups\",\n      \"description\": \"Expose yourself to packed shoulders and hang time\",\n      \"category\": \"1\",\n      \"type\": \"1\",\n      \"muscle_groups\": \"1,5\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \" 1. Grip a bar and jump into the top position of the pull-up exercise\\r\\n2. Straight legs in front of you. \\r\\n3. Slowly go down into a deadhang position \",\n      \"video_tips\": \"        \",\n      \"pro_tips\": \" A deadhang postion requires your shoulder blades down and towards the spine with arms being straight (retraction)\\r\\nAim for three second holds at the top and go down slowly \",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Shoulders, Arms\"\n      },\n      \"is_completed\": 0\n      }\n      ],\n      \"round2\": [\n      {\n      \"id\": \"101\",\n      \"workout_id\": \"3\",\n      \"category\": \"1\",\n      \"repititions\": \"10\",\n      \"exercise_id\": \"14\",\n      \"unit\": \"times\",\n      \"round\": \"2\",\n      \"created_at\": \"2016-01-19 04:18:12\",\n      \"updated_at\": \"2016-04-04 09:33:39\",\n      \"exercise\": {\n      \"id\": \"14\",\n      \"name\": \"Incline Pushups\",\n      \"description\": \"Start your journey with the simplest way to develop an athletic physique\",\n      \"category\": \"1\",\n      \"type\": \"1\",\n      \"muscle_groups\": \"1,2,3\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \"1. Place hands on edge of bench, bar or rings at waist height, slightly wider than shoulder width \\r\\n2. Perform regular pushup. Arms should be perpendicular to body. \\r\\n  \",\n      \"video_tips\": \"    \",\n      \"pro_tips\": \"Resistance can be de- or increased by performing movement on different angles.\\r\\nAvoid rounding your spine and doing ?banana back? pushups, try squeezing your core.\\r\\n  \",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Shoulders, Chest, Triceps\"\n      },\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"106\",\n      \"workout_id\": \"3\",\n      \"category\": \"1\",\n      \"repititions\": \"25\",\n      \"exercise_id\": \"36\",\n      \"unit\": \"times\",\n      \"round\": \"2\",\n      \"created_at\": \"2016-01-19 04:19:20\",\n      \"updated_at\": \"2016-04-04 11:12:49\",\n      \"exercise\": {\n      \"id\": \"36\",\n      \"name\": \"High Jumps\",\n      \"description\": \"Do high jumps as a part of restless HIIT workouts\",\n      \"category\": \"1\",\n      \"type\": \"2\",\n      \"muscle_groups\": \"7\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \"1. Start from a standing position\\r\\n2. Jump up and bring your knees to your chest\",\n      \"video_tips\": \"    \",\n      \"pro_tips\": \"Land softly and exhale when the knees are up.\\r\\n  \",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Legs\"\n      },\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"111\",\n      \"workout_id\": \"3\",\n      \"category\": \"1\",\n      \"repititions\": \"7\",\n      \"exercise_id\": \"66\",\n      \"unit\": \"times\",\n      \"round\": \"2\",\n      \"created_at\": \"2016-01-19 04:19:54\",\n      \"updated_at\": \"2016-04-04 14:31:38\",\n      \"exercise\": {\n      \"id\": \"69\",\n      \"name\": \"Jumping Pullups\",\n      \"description\": \"Expose yourself to packed shoulders and hang time\",\n      \"category\": \"1\",\n      \"type\": \"1\",\n      \"muscle_groups\": \"1,5\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \" 1. Grip a bar and jump into the top position of the pull-up exercise\\r\\n2. Straight legs in front of you. \\r\\n3. Slowly go down into a deadhang position \",\n      \"video_tips\": \"        \",\n      \"pro_tips\": \" A deadhang postion requires your shoulder blades down and towards the spine with arms being straight (retraction)\\r\\nAim for three second holds at the top and go down slowly \",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Shoulders, Arms\"\n      },\n      \"is_completed\": 0\n      }\n      ],\n      \"round3\": [\n      {\n      \"id\": \"102\",\n      \"workout_id\": \"3\",\n      \"category\": \"1\",\n      \"repititions\": \"10\",\n      \"exercise_id\": \"14\",\n      \"unit\": \"times\",\n      \"round\": \"3\",\n      \"created_at\": \"2016-01-19 04:18:12\",\n      \"updated_at\": \"2016-04-04 09:33:39\",\n      \"exercise\": {\n      \"id\": \"14\",\n      \"name\": \"Incline Pushups\",\n      \"description\": \"Start your journey with the simplest way to develop an athletic physique\",\n      \"category\": \"1\",\n      \"type\": \"1\",\n      \"muscle_groups\": \"1,2,3\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \"1. Place hands on edge of bench, bar or rings at waist height, slightly wider than shoulder width \\r\\n2. Perform regular pushup. Arms should be perpendicular to body. \\r\\n  \",\n      \"video_tips\": \"    \",\n      \"pro_tips\": \"Resistance can be de- or increased by performing movement on different angles.\\r\\nAvoid rounding your spine and doing ?banana back? pushups, try squeezing your core.\\r\\n  \",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Shoulders, Chest, Triceps\"\n      },\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"107\",\n      \"workout_id\": \"3\",\n      \"category\": \"1\",\n      \"repititions\": \"25\",\n      \"exercise_id\": \"36\",\n      \"unit\": \"times\",\n      \"round\": \"3\",\n      \"created_at\": \"2016-01-19 04:19:20\",\n      \"updated_at\": \"2016-04-04 11:12:49\",\n      \"exercise\": {\n      \"id\": \"36\",\n      \"name\": \"High Jumps\",\n      \"description\": \"Do high jumps as a part of restless HIIT workouts\",\n      \"category\": \"1\",\n      \"type\": \"2\",\n      \"muscle_groups\": \"7\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \"1. Start from a standing position\\r\\n2. Jump up and bring your knees to your chest\",\n      \"video_tips\": \"    \",\n      \"pro_tips\": \"Land softly and exhale when the knees are up.\\r\\n  \",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Legs\"\n      },\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"112\",\n      \"workout_id\": \"3\",\n      \"category\": \"1\",\n      \"repititions\": \"7\",\n      \"exercise_id\": \"66\",\n      \"unit\": \"times\",\n      \"round\": \"3\",\n      \"created_at\": \"2016-01-19 04:19:54\",\n      \"updated_at\": \"2016-04-04 14:31:38\",\n      \"exercise\": {\n      \"id\": \"69\",\n      \"name\": \"Jumping Pullups\",\n      \"description\": \"Expose yourself to packed shoulders and hang time\",\n      \"category\": \"1\",\n      \"type\": \"1\",\n      \"muscle_groups\": \"1,5\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \" 1. Grip a bar and jump into the top position of the pull-up exercise\\r\\n2. Straight legs in front of you. \\r\\n3. Slowly go down into a deadhang position \",\n      \"video_tips\": \"        \",\n      \"pro_tips\": \" A deadhang postion requires your shoulder blades down and towards the spine with arms being straight (retraction)\\r\\nAim for three second holds at the top and go down slowly \",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Shoulders, Arms\"\n      },\n      \"is_completed\": 0\n      }\n      ]\n      },\n      \"exercise_category\": 1\n      },\n      \"coach_workout_rounds\": 3,\n      \"workout_intensity\": 1,\n      \"hiit\": [],\n      \"stretching\": [\n      {\n      \"id\": \"1\",\n      \"exercise_id\": \"Superman\",\n      \"duration\": {\n      \"min\": 6,\n      \"max\": 13\n      },\n      \"unit\": \"times\",\n      \"is_completed\": \"0\",\n      \"created_at\": \"2016-01-22 07:10:31\",\n      \"updated_at\": \"2016-01-22 07:10:31\"\n      },\n      {\n      \"id\": \"2\",\n      \"exercise_id\": \"Lower Back Strength\",\n      \"duration\": {\n      \"min\": 38,\n      \"max\": 63\n      },\n      \"unit\": \"times\",\n      \"is_completed\": \"0\",\n      \"created_at\": \"2016-01-22 07:15:02\",\n      \"updated_at\": \"2016-01-22 07:15:02\"\n      },\n      {\n      \"id\": \"3\",\n      \"exercise_id\": \"Upper Dog\",\n      \"duration\": {\n      \"min\": 38,\n      \"max\": 75\n      },\n      \"unit\": \"seconds\",\n      \"is_completed\": \"0\",\n      \"created_at\": \"2016-01-22 07:16:03\",\n      \"updated_at\": \"2016-01-22 07:16:03\"\n      },\n      {\n      \"id\": \"4\",\n      \"exercise_id\": \"Child's Pose\",\n      \"duration\": {\n      \"min\": 38,\n      \"max\": 75\n      },\n      \"unit\": \"seconds\",\n      \"is_completed\": \"0\",\n      \"created_at\": \"2016-01-22 07:16:46\",\n      \"updated_at\": \"2016-01-22 07:16:46\"\n      },\n      {\n      \"id\": \"5\",\n      \"exercise_id\": \"L-sit on the floor\",\n      \"duration\": {\n      \"min\": 38,\n      \"max\": 75\n      },\n      \"unit\": \"seconds\",\n      \"is_completed\": \"0\",\n      \"created_at\": \"2016-01-22 07:17:13\",\n      \"updated_at\": \"2016-01-22 07:17:13\"\n      },\n      {\n      \"id\": \"6\",\n      \"exercise_id\": \"Good morning\",\n      \"duration\": {\n      \"min\": 38,\n      \"max\": 75\n      },\n      \"unit\": \"seconds\",\n      \"is_completed\": \"0\",\n      \"created_at\": \"2016-01-22 07:17:43\",\n      \"updated_at\": \"2016-01-22 07:17:43\"\n      },\n      {\n      \"id\": \"7\",\n      \"exercise_id\": \"Chest Opener\",\n      \"duration\": {\n      \"min\": 38,\n      \"max\": 75\n      },\n      \"unit\": \"seconds\",\n      \"is_completed\": \"0\",\n      \"created_at\": \"2016-01-22 07:19:32\",\n      \"updated_at\": \"2016-01-22 07:19:32\"\n      },\n      {\n      \"id\": \"8\",\n      \"exercise_id\": \"Triceps Stretc\",\n      \"duration\": {\n      \"min\": 38,\n      \"max\": 75\n      },\n      \"unit\": \"seconds\",\n      \"is_completed\": \"0\",\n      \"created_at\": \"2016-01-22 07:19:56\",\n      \"updated_at\": \"2016-01-22 07:19:56\"\n      },\n      {\n      \"id\": \"9\",\n      \"exercise_id\": \"Hands Back\",\n      \"duration\": {\n      \"min\": 38,\n      \"max\": 75\n      },\n      \"unit\": \"seconds\",\n      \"is_completed\": \"0\",\n      \"created_at\": \"2016-01-22 07:20:19\",\n      \"updated_at\": \"2016-01-22 07:20:19\"\n      },\n      {\n      \"id\": \"10\",\n      \"exercise_id\": \"Shoulder Stretch\",\n      \"duration\": {\n      \"min\": 38,\n      \"max\": 75\n      },\n      \"unit\": \"seconds\",\n      \"is_completed\": \"0\",\n      \"created_at\": \"2016-01-22 07:20:45\",\n      \"updated_at\": \"2016-01-22 07:20:45\"\n      }\n      ],\n      \"status\": \"pending\"\n      },\n      \"day2\": {\n      \"warmup\": [\n      {\n      \"id\": \"1\",\n      \"name\": \"wall extensions\",\n      \"duration\": {\n      \"min\": \"10\",\n      \"max\": \"20\"\n      },\n      \"unit\": \"times\",\n      \"created_at\": \"2016-01-21 08:55:06\",\n      \"updated_at\": \"2016-01-21 08:55:06\",\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"2\",\n      \"name\": \"band dislocates\",\n      \"duration\": {\n      \"min\": \"10\",\n      \"max\": \"20\"\n      },\n      \"unit\": \"times\",\n      \"created_at\": \"2016-01-21 08:57:38\",\n      \"updated_at\": \"2016-01-21 08:57:38\",\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"3\",\n      \"name\": \"cat-camels\",\n      \"duration\": {\n      \"min\": \"10\",\n      \"max\": \"20\"\n      },\n      \"unit\": \"times\",\n      \"created_at\": \"2016-01-21 09:00:39\",\n      \"updated_at\": \"2016-01-21 09:00:39\",\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"4\",\n      \"name\": \"scapular shrugs\",\n      \"duration\": {\n      \"min\": \"10\",\n      \"max\": \"20\"\n      },\n      \"unit\": \"times\",\n      \"created_at\": \"2016-01-21 09:01:01\",\n      \"updated_at\": \"2016-01-21 09:01:01\",\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"5\",\n      \"name\": \"full body circles\",\n      \"duration\": {\n      \"min\": \"10\",\n      \"max\": \"20\"\n      },\n      \"unit\": \"times\",\n      \"created_at\": \"2016-01-21 09:01:26\",\n      \"updated_at\": \"2016-01-21 09:01:26\",\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"6\",\n      \"name\": \"Jumping Jacks\",\n      \"duration\": {\n      \"min\": \"100\",\n      \"max\": \"\"\n      },\n      \"unit\": \"seconds\",\n      \"created_at\": \"2016-01-21 09:04:52\",\n      \"updated_at\": \"2016-01-21 09:04:52\",\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"7\",\n      \"name\": \"Arm rotations\",\n      \"duration\": {\n      \"min\": \"120\",\n      \"max\": \"\"\n      },\n      \"unit\": \"times\",\n      \"created_at\": \"2016-01-21 09:05:29\",\n      \"updated_at\": \"2016-01-21 09:05:29\",\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"8\",\n      \"name\": \"High Knees\",\n      \"duration\": {\n      \"min\": \"50\",\n      \"max\": \"\"\n      },\n      \"unit\": \"times\",\n      \"created_at\": \"2016-01-21 09:06:02\",\n      \"updated_at\": \"2016-01-21 09:06:02\",\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"9\",\n      \"name\": \"Shouder rolls\",\n      \"duration\": {\n      \"min\": \"20\",\n      \"max\": \"\"\n      },\n      \"unit\": \"times\",\n      \"created_at\": \"2016-01-21 09:06:34\",\n      \"updated_at\": \"2016-01-21 09:06:34\",\n      \"is_completed\": 0\n      }\n      ],\n      \"is_completed\": 0,\n      \"fundumentals\": [\n      {\n      \"id\": \"6\",\n      \"row\": \"2\",\n      \"exercise_id\": \"64\",\n      \"duration\": {\n      \"min\": \"10\",\n      \"max\": \"\"\n      },\n      \"unit\": \"times\",\n      \"is_completed\": \"0\",\n      \"created_at\": \"2016-01-22 04:29:57\",\n      \"updated_at\": \"2016-04-04 14:27:54\",\n      \"exercise\": {\n      \"id\": \"64\",\n      \"name\": \"Skin the cat\",\n      \"description\": \"Develop your joints mobility and expose yourself to new movement layers\",\n      \"category\": \"1\",\n      \"type\": \"2\",\n      \"muscle_groups\": \"4,5,6\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \" 1. Hands a little more than shoulder width apart\\r\\n2. Raise your knees to the chest\\r\\n3. continuing the movement until the feet pass up through the arms and over head into an inverted hang position.\\r\\n4. Continue to pass the feet round and down toward the ground into the extended 'skin the cat' position.\\r\\n5. Lift your hips and raise the legs back and over to the starting hang position. \",\n      \"video_tips\": \"        \",\n      \"pro_tips\": \" Put your hands closer together to ease up all back lever progressions.\\r\\nDo only half of the movement in the beginning, but fight for completion over time.\\r\\nIncorporate other static elements to challenge yourself during the movement as you master other skills.\\r\\n    \",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Back, Arms, Core\",\n      \"video\": [\n      {\n      \"id\": \"71\",\n      \"path\": \"64_1454045043.mp4\",\n      \"videothumbnail\": \"64_1454045043.jpg\",\n      \"description\": \"Skin the cat\"\n      }\n      ]\n      }\n      },\n      {\n      \"id\": \"7\",\n      \"row\": \"2\",\n      \"exercise_id\": \"14\",\n      \"duration\": {\n      \"min\": \"20\",\n      \"max\": \"\"\n      },\n      \"unit\": \"times\",\n      \"is_completed\": \"0\",\n      \"created_at\": \"2016-01-22 04:31:09\",\n      \"updated_at\": \"2016-04-04 09:33:39\",\n      \"exercise\": {\n      \"id\": \"14\",\n      \"name\": \"Incline Pushups\",\n      \"description\": \"Start your journey with the simplest way to develop an athletic physique\",\n      \"category\": \"1\",\n      \"type\": \"1\",\n      \"muscle_groups\": \"1,2,3\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \"1. Place hands on edge of bench, bar or rings at waist height, slightly wider than shoulder width \\r\\n2. Perform regular pushup. Arms should be perpendicular to body. \\r\\n  \",\n      \"video_tips\": \"    \",\n      \"pro_tips\": \"Resistance can be de- or increased by performing movement on different angles.\\r\\nAvoid rounding your spine and doing ?banana back? pushups, try squeezing your core.\\r\\n  \",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Shoulders, Chest, Triceps\",\n      \"video\": [\n      {\n      \"id\": \"13\",\n      \"path\": \"14_1453984243.mp4\",\n      \"videothumbnail\": \"14_1453984243.jpg\",\n      \"description\": \"Incline Pushups\"\n      }\n      ]\n      }\n      },\n      {\n      \"id\": \"8\",\n      \"row\": \"2\",\n      \"exercise_id\": \"48\",\n      \"duration\": {\n      \"min\": \"30\",\n      \"max\": \"\"\n      },\n      \"unit\": \"times\",\n      \"is_completed\": \"0\",\n      \"created_at\": \"2016-01-22 04:32:04\",\n      \"updated_at\": \"2016-04-04 14:19:00\",\n      \"exercise\": {\n      \"id\": \"48\",\n      \"name\": \"Bench Dips\",\n      \"description\": \"Develop more strength as you increase resistance with your bodyweight\",\n      \"category\": \"1\",\n      \"type\": \"2\",\n      \"muscle_groups\": \"3\",\n      \"rewards\": \"7.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \" 1. Sit on side of bench. \\r\\n2. Place hands on edge of bench. Position feet away from bench and rest heels on floor with legs straight. \\r\\n3. Lower your body with the feet in front of you\\r\\n4. Press your body up and hold in extension \",\n      \"video_tips\": \"      \",\n      \"pro_tips\": \" Don?t rush through your movements to make things easier on yourself. You will sacrifice your form, and in the end, you won?t actually get good at the skills you?re working on.\\r\\nThe closer you put your hands together, the tougher the bench dip becomes. \",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Triceps\",\n      \"video\": [\n      {\n      \"id\": \"62\",\n      \"path\": \"48_1454043291.mp4\",\n      \"videothumbnail\": \"48_1454043291.jpg\",\n      \"description\": \"Bench Dips\"\n      }\n      ]\n      }\n      },\n      {\n      \"id\": \"9\",\n      \"row\": \"2\",\n      \"exercise_id\": \"57\",\n      \"duration\": {\n      \"min\": \"15\",\n      \"max\": \"\"\n      },\n      \"unit\": \"times\",\n      \"is_completed\": \"0\",\n      \"created_at\": \"2016-01-22 04:32:49\",\n      \"updated_at\": \"2016-04-04 12:10:48\",\n      \"exercise\": {\n      \"id\": \"57\",\n      \"name\": \"Knee Raises\",\n      \"description\": \"Develop grip and core strength and get used to slow and controlled moves\",\n      \"category\": \"1\",\n      \"type\": \"2\",\n      \"muscle_groups\": \"4,6,7\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \"1. Start from a deadhang position with your arms and legs fully extended, and feet off the ground.  \\r\\n2. Raise your knees up towards your chest as high as possible. \\r\\n3. Hold for a brief moment and slowly return to the starting position. \\r\\n4. Repeat for required repetitions. \",\n      \"video_tips\": \"    \",\n      \"pro_tips\": \"Avoid using momentum or swinging during the exercise. \\r\\nPerform the knee raise slowly and controlled.\",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Back, Core, Legs\",\n      \"video\": [\n      {\n      \"id\": \"67\",\n      \"path\": \"57_1454044213.mp4\",\n      \"videothumbnail\": \"57_1454044213.jpg\",\n      \"description\": \"Knee Raises\"\n      }\n      ]\n      }\n      },\n      {\n      \"id\": \"10\",\n      \"row\": \"2\",\n      \"exercise_id\": \"42\",\n      \"duration\": {\n      \"min\": \"20\",\n      \"max\": \"\"\n      },\n      \"unit\": \"times\",\n      \"is_completed\": \"0\",\n      \"created_at\": \"2016-01-22 04:33:42\",\n      \"updated_at\": \"2016-04-04 11:22:09\",\n      \"exercise\": {\n      \"id\": \"42\",\n      \"name\": \"Single Leg Deadlift\",\n      \"description\": \"Get your hips mobile and control your balance\",\n      \"category\": \"1\",\n      \"type\": \"2\",\n      \"muscle_groups\": \"7\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \"1. Start from a standing position\\r\\n2. Keeping that knee slightly bent, perform a stiff-legged deadlift by bending at the hip.\\r\\n3. Continue lowering yourself until your upper body is parallel to the ground, and then return to the upright position. \\r\\n4. Repeat for the desired number of repetitions.\",\n      \"video_tips\": \"    \",\n      \"pro_tips\": \"Avoid bending your supporting leg.\\r\\nKeep your non-supporting leg extended behind you for balance.\",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Legs\",\n      \"video\": [\n      {\n      \"id\": \"38\",\n      \"path\": \"42_1454042789.mp4\",\n      \"videothumbnail\": \"42_1454042789.jpg\",\n      \"description\": \"Single Leg Deadlift\"\n      }\n      ]\n      }\n      }\n      ],\n      \"exercises\": [],\n      \"workout\": {\n      \"id\": \"2\",\n      \"name\": \"Borr\",\n      \"description\": \"A,C,E,B\",\n      \"rounds\": \"3\",\n      \"category\": \"2\",\n      \"type\": \"2\",\n      \"rewards\": \"330\",\n      \"duration\": \"1140.00\",\n      \"equipments\": \"Bar/Rings\",\n      \"is_completed\": 0,\n      \"exercises\": {\n      \"round1\": [\n      {\n      \"id\": \"16\",\n      \"workout_id\": \"2\",\n      \"category\": \"1\",\n      \"repititions\": \"25\",\n      \"exercise_id\": \"32\",\n      \"unit\": \"times\",\n      \"round\": \"1\",\n      \"created_at\": \"2016-01-19 03:29:53\",\n      \"updated_at\": \"2016-04-04 11:06:44\",\n      \"exercise\": {\n      \"id\": \"32\",\n      \"name\": \"Sprawl\",\n      \"description\": \"Boost your cardio and strength with sprawls\",\n      \"category\": \"1\",\n      \"type\": \"1\",\n      \"muscle_groups\": \"8\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \"1. Start in a standing position\\r\\n2. Go into a straight arm plank position\\r\\n3. Go back up and jump with your hands above your head\",\n      \"video_tips\": \"    \",\n      \"pro_tips\": \"Avoid a hollow back during the movement. \\r\\nKeep the core and lower back engaged at all times.\",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Full Body\"\n      },\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"19\",\n      \"workout_id\": \"2\",\n      \"category\": \"1\",\n      \"repititions\": \"10\",\n      \"exercise_id\": \"66\",\n      \"unit\": \"times\",\n      \"round\": \"1\",\n      \"created_at\": \"2016-01-19 03:30:29\",\n      \"updated_at\": \"2016-04-04 14:31:38\",\n      \"exercise\": {\n      \"id\": \"69\",\n      \"name\": \"Jumping Pullups\",\n      \"description\": \"Expose yourself to packed shoulders and hang time\",\n      \"category\": \"1\",\n      \"type\": \"1\",\n      \"muscle_groups\": \"1,5\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \" 1. Grip a bar and jump into the top position of the pull-up exercise\\r\\n2. Straight legs in front of you. \\r\\n3. Slowly go down into a deadhang position \",\n      \"video_tips\": \"        \",\n      \"pro_tips\": \" A deadhang postion requires your shoulder blades down and towards the spine with arms being straight (retraction)\\r\\nAim for three second holds at the top and go down slowly \",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Shoulders, Arms\"\n      },\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"22\",\n      \"workout_id\": \"2\",\n      \"category\": \"1\",\n      \"repititions\": \"40\",\n      \"exercise_id\": \"9\",\n      \"unit\": \"times\",\n      \"round\": \"1\",\n      \"created_at\": \"2016-01-19 03:30:59\",\n      \"updated_at\": \"2016-04-04 09:22:17\",\n      \"exercise\": {\n      \"id\": \"9\",\n      \"name\": \"Crunches\",\n      \"description\": \"Do the most admired sixpack exercise in the world\",\n      \"category\": \"1\",\n      \"type\": \"1\",\n      \"muscle_groups\": \"6\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \"1. Starting position is with lying face up on the floor with knees bent. \\r\\n2. Move torso up and touch your knees with your hands\\r\\n3. Lower body to the floor and repeat\\r\\n  \",\n      \"video_tips\": \"    \",\n      \"pro_tips\": \"Do variations in tempo. Aim for one count up and three counts down.\\r\\nIf you have a tendency to interlace your fingers and yank your head, place your hands cross-chest.\",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Core\"\n      },\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"25\",\n      \"workout_id\": \"2\",\n      \"category\": \"1\",\n      \"repititions\": \"30\",\n      \"exercise_id\": \"49\",\n      \"unit\": \"times\",\n      \"round\": \"1\",\n      \"created_at\": \"2016-01-19 03:31:40\",\n      \"updated_at\": \"2016-04-04 14:19:29\",\n      \"exercise\": {\n      \"id\": \"49\",\n      \"name\": \"Side Triceps\",\n      \"description\": \"Start with the basics of building triceps strength\",\n      \"category\": \"1\",\n      \"type\": \"1\",\n      \"muscle_groups\": \"3\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \" 1. Start with the body on your side\\r\\n2. Put one hand on your shoulder \\r\\n3. Press up with the other arm and hold in extension \",\n      \"video_tips\": \"          \",\n      \"pro_tips\": \" Avoid supporting the movement with your core muscle.      \",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Triceps\"\n      },\n      \"is_completed\": 0\n      }\n      ],\n      \"round2\": [\n      {\n      \"id\": \"17\",\n      \"workout_id\": \"2\",\n      \"category\": \"1\",\n      \"repititions\": \"25\",\n      \"exercise_id\": \"32\",\n      \"unit\": \"times\",\n      \"round\": \"2\",\n      \"created_at\": \"2016-01-19 03:29:53\",\n      \"updated_at\": \"2016-04-04 11:06:44\",\n      \"exercise\": {\n      \"id\": \"32\",\n      \"name\": \"Sprawl\",\n      \"description\": \"Boost your cardio and strength with sprawls\",\n      \"category\": \"1\",\n      \"type\": \"1\",\n      \"muscle_groups\": \"8\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \"1. Start in a standing position\\r\\n2. Go into a straight arm plank position\\r\\n3. Go back up and jump with your hands above your head\",\n      \"video_tips\": \"    \",\n      \"pro_tips\": \"Avoid a hollow back during the movement. \\r\\nKeep the core and lower back engaged at all times.\",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Full Body\"\n      },\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"20\",\n      \"workout_id\": \"2\",\n      \"category\": \"1\",\n      \"repititions\": \"10\",\n      \"exercise_id\": \"66\",\n      \"unit\": \"times\",\n      \"round\": \"2\",\n      \"created_at\": \"2016-01-19 03:30:30\",\n      \"updated_at\": \"2016-04-04 14:31:38\",\n      \"exercise\": {\n      \"id\": \"69\",\n      \"name\": \"Jumping Pullups\",\n      \"description\": \"Expose yourself to packed shoulders and hang time\",\n      \"category\": \"1\",\n      \"type\": \"1\",\n      \"muscle_groups\": \"1,5\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \" 1. Grip a bar and jump into the top position of the pull-up exercise\\r\\n2. Straight legs in front of you. \\r\\n3. Slowly go down into a deadhang position \",\n      \"video_tips\": \"        \",\n      \"pro_tips\": \" A deadhang postion requires your shoulder blades down and towards the spine with arms being straight (retraction)\\r\\nAim for three second holds at the top and go down slowly \",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Shoulders, Arms\"\n      },\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"23\",\n      \"workout_id\": \"2\",\n      \"category\": \"1\",\n      \"repititions\": \"40\",\n      \"exercise_id\": \"9\",\n      \"unit\": \"times\",\n      \"round\": \"2\",\n      \"created_at\": \"2016-01-19 03:30:59\",\n      \"updated_at\": \"2016-04-04 09:22:17\",\n      \"exercise\": {\n      \"id\": \"9\",\n      \"name\": \"Crunches\",\n      \"description\": \"Do the most admired sixpack exercise in the world\",\n      \"category\": \"1\",\n      \"type\": \"1\",\n      \"muscle_groups\": \"6\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \"1. Starting position is with lying face up on the floor with knees bent. \\r\\n2. Move torso up and touch your knees with your hands\\r\\n3. Lower body to the floor and repeat\\r\\n  \",\n      \"video_tips\": \"    \",\n      \"pro_tips\": \"Do variations in tempo. Aim for one count up and three counts down.\\r\\nIf you have a tendency to interlace your fingers and yank your head, place your hands cross-chest.\",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Core\"\n      },\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"26\",\n      \"workout_id\": \"2\",\n      \"category\": \"1\",\n      \"repititions\": \"30\",\n      \"exercise_id\": \"49\",\n      \"unit\": \"times\",\n      \"round\": \"2\",\n      \"created_at\": \"2016-01-19 03:31:41\",\n      \"updated_at\": \"2016-04-04 14:19:29\",\n      \"exercise\": {\n      \"id\": \"49\",\n      \"name\": \"Side Triceps\",\n      \"description\": \"Start with the basics of building triceps strength\",\n      \"category\": \"1\",\n      \"type\": \"1\",\n      \"muscle_groups\": \"3\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \" 1. Start with the body on your side\\r\\n2. Put one hand on your shoulder \\r\\n3. Press up with the other arm and hold in extension \",\n      \"video_tips\": \"          \",\n      \"pro_tips\": \" Avoid supporting the movement with your core muscle.      \",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Triceps\"\n      },\n      \"is_completed\": 0\n      }\n      ],\n      \"round3\": [\n      {\n      \"id\": \"18\",\n      \"workout_id\": \"2\",\n      \"category\": \"1\",\n      \"repititions\": \"25\",\n      \"exercise_id\": \"32\",\n      \"unit\": \"times\",\n      \"round\": \"3\",\n      \"created_at\": \"2016-01-19 03:29:53\",\n      \"updated_at\": \"2016-04-04 11:06:44\",\n      \"exercise\": {\n      \"id\": \"32\",\n      \"name\": \"Sprawl\",\n      \"description\": \"Boost your cardio and strength with sprawls\",\n      \"category\": \"1\",\n      \"type\": \"1\",\n      \"muscle_groups\": \"8\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \"1. Start in a standing position\\r\\n2. Go into a straight arm plank position\\r\\n3. Go back up and jump with your hands above your head\",\n      \"video_tips\": \"    \",\n      \"pro_tips\": \"Avoid a hollow back during the movement. \\r\\nKeep the core and lower back engaged at all times.\",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Full Body\"\n      },\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"21\",\n      \"workout_id\": \"2\",\n      \"category\": \"1\",\n      \"repititions\": \"10\",\n      \"exercise_id\": \"66\",\n      \"unit\": \"times\",\n      \"round\": \"3\",\n      \"created_at\": \"2016-01-19 03:30:30\",\n      \"updated_at\": \"2016-04-04 14:31:38\",\n      \"exercise\": {\n      \"id\": \"69\",\n      \"name\": \"Jumping Pullups\",\n      \"description\": \"Expose yourself to packed shoulders and hang time\",\n      \"category\": \"1\",\n      \"type\": \"1\",\n      \"muscle_groups\": \"1,5\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \" 1. Grip a bar and jump into the top position of the pull-up exercise\\r\\n2. Straight legs in front of you. \\r\\n3. Slowly go down into a deadhang position \",\n      \"video_tips\": \"        \",\n      \"pro_tips\": \" A deadhang postion requires your shoulder blades down and towards the spine with arms being straight (retraction)\\r\\nAim for three second holds at the top and go down slowly \",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Shoulders, Arms\"\n      },\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"24\",\n      \"workout_id\": \"2\",\n      \"category\": \"1\",\n      \"repititions\": \"40\",\n      \"exercise_id\": \"9\",\n      \"unit\": \"times\",\n      \"round\": \"3\",\n      \"created_at\": \"2016-01-19 03:30:59\",\n      \"updated_at\": \"2016-04-04 09:22:17\",\n      \"exercise\": {\n      \"id\": \"9\",\n      \"name\": \"Crunches\",\n      \"description\": \"Do the most admired sixpack exercise in the world\",\n      \"category\": \"1\",\n      \"type\": \"1\",\n      \"muscle_groups\": \"6\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \"1. Starting position is with lying face up on the floor with knees bent. \\r\\n2. Move torso up and touch your knees with your hands\\r\\n3. Lower body to the floor and repeat\\r\\n  \",\n      \"video_tips\": \"    \",\n      \"pro_tips\": \"Do variations in tempo. Aim for one count up and three counts down.\\r\\nIf you have a tendency to interlace your fingers and yank your head, place your hands cross-chest.\",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Core\"\n      },\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"27\",\n      \"workout_id\": \"2\",\n      \"category\": \"1\",\n      \"repititions\": \"30\",\n      \"exercise_id\": \"49\",\n      \"unit\": \"times\",\n      \"round\": \"3\",\n      \"created_at\": \"2016-01-19 03:31:41\",\n      \"updated_at\": \"2016-04-04 14:19:29\",\n      \"exercise\": {\n      \"id\": \"49\",\n      \"name\": \"Side Triceps\",\n      \"description\": \"Start with the basics of building triceps strength\",\n      \"category\": \"1\",\n      \"type\": \"1\",\n      \"muscle_groups\": \"3\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \" 1. Start with the body on your side\\r\\n2. Put one hand on your shoulder \\r\\n3. Press up with the other arm and hold in extension \",\n      \"video_tips\": \"          \",\n      \"pro_tips\": \" Avoid supporting the movement with your core muscle.      \",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Triceps\"\n      },\n      \"is_completed\": 0\n      }\n      ]\n      },\n      \"exercise_category\": 1\n      },\n      \"coach_workout_rounds\": 3,\n      \"workout_intensity\": 1,\n      \"hiit\": [],\n      \"stretching\": [\n      {\n      \"id\": \"1\",\n      \"exercise_id\": \"Superman\",\n      \"duration\": {\n      \"min\": 6,\n      \"max\": 13\n      },\n      \"unit\": \"times\",\n      \"is_completed\": \"0\",\n      \"created_at\": \"2016-01-22 07:10:31\",\n      \"updated_at\": \"2016-01-22 07:10:31\"\n      },\n      {\n      \"id\": \"2\",\n      \"exercise_id\": \"Lower Back Strength\",\n      \"duration\": {\n      \"min\": 38,\n      \"max\": 63\n      },\n      \"unit\": \"times\",\n      \"is_completed\": \"0\",\n      \"created_at\": \"2016-01-22 07:15:02\",\n      \"updated_at\": \"2016-01-22 07:15:02\"\n      },\n      {\n      \"id\": \"3\",\n      \"exercise_id\": \"Upper Dog\",\n      \"duration\": {\n      \"min\": 38,\n      \"max\": 75\n      },\n      \"unit\": \"seconds\",\n      \"is_completed\": \"0\",\n      \"created_at\": \"2016-01-22 07:16:03\",\n      \"updated_at\": \"2016-01-22 07:16:03\"\n      },\n      {\n      \"id\": \"4\",\n      \"exercise_id\": \"Child's Pose\",\n      \"duration\": {\n      \"min\": 38,\n      \"max\": 75\n      },\n      \"unit\": \"seconds\",\n      \"is_completed\": \"0\",\n      \"created_at\": \"2016-01-22 07:16:46\",\n      \"updated_at\": \"2016-01-22 07:16:46\"\n      },\n      {\n      \"id\": \"5\",\n      \"exercise_id\": \"L-sit on the floor\",\n      \"duration\": {\n      \"min\": 38,\n      \"max\": 75\n      },\n      \"unit\": \"seconds\",\n      \"is_completed\": \"0\",\n      \"created_at\": \"2016-01-22 07:17:13\",\n      \"updated_at\": \"2016-01-22 07:17:13\"\n      },\n      {\n      \"id\": \"6\",\n      \"exercise_id\": \"Good morning\",\n      \"duration\": {\n      \"min\": 38,\n      \"max\": 75\n      },\n      \"unit\": \"seconds\",\n      \"is_completed\": \"0\",\n      \"created_at\": \"2016-01-22 07:17:43\",\n      \"updated_at\": \"2016-01-22 07:17:43\"\n      },\n      {\n      \"id\": \"7\",\n      \"exercise_id\": \"Chest Opener\",\n      \"duration\": {\n      \"min\": 38,\n      \"max\": 75\n      },\n      \"unit\": \"seconds\",\n      \"is_completed\": \"0\",\n      \"created_at\": \"2016-01-22 07:19:32\",\n      \"updated_at\": \"2016-01-22 07:19:32\"\n      },\n      {\n      \"id\": \"8\",\n      \"exercise_id\": \"Triceps Stretc\",\n      \"duration\": {\n      \"min\": 38,\n      \"max\": 75\n      },\n      \"unit\": \"seconds\",\n      \"is_completed\": \"0\",\n      \"created_at\": \"2016-01-22 07:19:56\",\n      \"updated_at\": \"2016-01-22 07:19:56\"\n      },\n      {\n      \"id\": \"9\",\n      \"exercise_id\": \"Hands Back\",\n      \"duration\": {\n      \"min\": 38,\n      \"max\": 75\n      },\n      \"unit\": \"seconds\",\n      \"is_completed\": \"0\",\n      \"created_at\": \"2016-01-22 07:20:19\",\n      \"updated_at\": \"2016-01-22 07:20:19\"\n      },\n      {\n      \"id\": \"10\",\n      \"exercise_id\": \"Shoulder Stretch\",\n      \"duration\": {\n      \"min\": 38,\n      \"max\": 75\n      },\n      \"unit\": \"seconds\",\n      \"is_completed\": \"0\",\n      \"created_at\": \"2016-01-22 07:20:45\",\n      \"updated_at\": \"2016-01-22 07:20:45\"\n      }\n      ],\n      \"status\": \"pending\"\n      },\n      \"day3\": {\n      \"warmup\": [\n      {\n      \"id\": \"1\",\n      \"name\": \"wall extensions\",\n      \"duration\": {\n      \"min\": \"10\",\n      \"max\": \"20\"\n      },\n      \"unit\": \"times\",\n      \"created_at\": \"2016-01-21 08:55:06\",\n      \"updated_at\": \"2016-01-21 08:55:06\",\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"2\",\n      \"name\": \"band dislocates\",\n      \"duration\": {\n      \"min\": \"10\",\n      \"max\": \"20\"\n      },\n      \"unit\": \"times\",\n      \"created_at\": \"2016-01-21 08:57:38\",\n      \"updated_at\": \"2016-01-21 08:57:38\",\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"3\",\n      \"name\": \"cat-camels\",\n      \"duration\": {\n      \"min\": \"10\",\n      \"max\": \"20\"\n      },\n      \"unit\": \"times\",\n      \"created_at\": \"2016-01-21 09:00:39\",\n      \"updated_at\": \"2016-01-21 09:00:39\",\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"4\",\n      \"name\": \"scapular shrugs\",\n      \"duration\": {\n      \"min\": \"10\",\n      \"max\": \"20\"\n      },\n      \"unit\": \"times\",\n      \"created_at\": \"2016-01-21 09:01:01\",\n      \"updated_at\": \"2016-01-21 09:01:01\",\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"5\",\n      \"name\": \"full body circles\",\n      \"duration\": {\n      \"min\": \"10\",\n      \"max\": \"20\"\n      },\n      \"unit\": \"times\",\n      \"created_at\": \"2016-01-21 09:01:26\",\n      \"updated_at\": \"2016-01-21 09:01:26\",\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"6\",\n      \"name\": \"Jumping Jacks\",\n      \"duration\": {\n      \"min\": \"100\",\n      \"max\": \"\"\n      },\n      \"unit\": \"seconds\",\n      \"created_at\": \"2016-01-21 09:04:52\",\n      \"updated_at\": \"2016-01-21 09:04:52\",\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"7\",\n      \"name\": \"Arm rotations\",\n      \"duration\": {\n      \"min\": \"120\",\n      \"max\": \"\"\n      },\n      \"unit\": \"times\",\n      \"created_at\": \"2016-01-21 09:05:29\",\n      \"updated_at\": \"2016-01-21 09:05:29\",\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"8\",\n      \"name\": \"High Knees\",\n      \"duration\": {\n      \"min\": \"50\",\n      \"max\": \"\"\n      },\n      \"unit\": \"times\",\n      \"created_at\": \"2016-01-21 09:06:02\",\n      \"updated_at\": \"2016-01-21 09:06:02\",\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"9\",\n      \"name\": \"Shouder rolls\",\n      \"duration\": {\n      \"min\": \"20\",\n      \"max\": \"\"\n      },\n      \"unit\": \"times\",\n      \"created_at\": \"2016-01-21 09:06:34\",\n      \"updated_at\": \"2016-01-21 09:06:34\",\n      \"is_completed\": 0\n      }\n      ],\n      \"is_completed\": 0,\n      \"fundumentals\": [\n      {\n      \"id\": \"11\",\n      \"row\": \"3\",\n      \"exercise_id\": \"64\",\n      \"duration\": {\n      \"min\": \"10\",\n      \"max\": \"\"\n      },\n      \"unit\": \"times\",\n      \"is_completed\": \"0\",\n      \"created_at\": \"2016-01-22 04:35:13\",\n      \"updated_at\": \"2016-04-04 14:27:54\",\n      \"exercise\": {\n      \"id\": \"64\",\n      \"name\": \"Skin the cat\",\n      \"description\": \"Develop your joints mobility and expose yourself to new movement layers\",\n      \"category\": \"1\",\n      \"type\": \"2\",\n      \"muscle_groups\": \"4,5,6\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \" 1. Hands a little more than shoulder width apart\\r\\n2. Raise your knees to the chest\\r\\n3. continuing the movement until the feet pass up through the arms and over head into an inverted hang position.\\r\\n4. Continue to pass the feet round and down toward the ground into the extended 'skin the cat' position.\\r\\n5. Lift your hips and raise the legs back and over to the starting hang position. \",\n      \"video_tips\": \"        \",\n      \"pro_tips\": \" Put your hands closer together to ease up all back lever progressions.\\r\\nDo only half of the movement in the beginning, but fight for completion over time.\\r\\nIncorporate other static elements to challenge yourself during the movement as you master other skills.\\r\\n    \",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Back, Arms, Core\",\n      \"video\": [\n      {\n      \"id\": \"71\",\n      \"path\": \"64_1454045043.mp4\",\n      \"videothumbnail\": \"64_1454045043.jpg\",\n      \"description\": \"Skin the cat\"\n      }\n      ]\n      }\n      },\n      {\n      \"id\": \"12\",\n      \"row\": \"3\",\n      \"exercise_id\": \"12\",\n      \"duration\": {\n      \"min\": \"20\",\n      \"max\": \"\"\n      },\n      \"unit\": \"times\",\n      \"is_completed\": \"0\",\n      \"created_at\": \"2016-01-22 04:36:16\",\n      \"updated_at\": \"2016-04-04 09:26:06\",\n      \"exercise\": {\n      \"id\": \"12\",\n      \"name\": \"Pushups\",\n      \"description\": \"Perform the most popular exercise of all time with real strength\",\n      \"category\": \"2\",\n      \"type\": \"1\",\n      \"muscle_groups\": \"1,2,3\",\n      \"rewards\": \"7.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \" 1. Lie on the floor face down and place your hands in a standard pushup position.\\r\\n 2. Next, lower yourself downward until your chest almost touches the floor as you inhale.\\r\\n 3. Exhale and press your upper body back up to the starting position while squeezing your chest.\\r\\n 4. Repeat, after a brief pause at the top contracted position.\\r\\n\",\n      \"video_tips\": \"      \",\n      \"pro_tips\": \"Do them extra slow and hold it in highest and lowest position to get strength.\\r\\nOne of the most common push-up mistakes is flaring out the elbows out instead of keeping them at your sides.\\r\\nIf too easy, try Spiderman and Diamond Pushups or wear a weigthed vest.\",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Shoulders, Chest, Triceps\",\n      \"video\": [\n      {\n      \"id\": \"57\",\n      \"path\": \"12_1453984139.mp4\",\n      \"videothumbnail\": \"12_1453984139.jpg\",\n      \"description\": \"Pushups\"\n      }\n      ]\n      }\n      },\n      {\n      \"id\": \"13\",\n      \"row\": \"3\",\n      \"exercise_id\": \"49\",\n      \"duration\": {\n      \"min\": \"30\",\n      \"max\": \"\"\n      },\n      \"unit\": \"times\",\n      \"is_completed\": \"0\",\n      \"created_at\": \"2016-01-22 04:36:49\",\n      \"updated_at\": \"2016-04-04 14:19:29\",\n      \"exercise\": {\n      \"id\": \"49\",\n      \"name\": \"Side Triceps\",\n      \"description\": \"Start with the basics of building triceps strength\",\n      \"category\": \"1\",\n      \"type\": \"1\",\n      \"muscle_groups\": \"3\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \" 1. Start with the body on your side\\r\\n2. Put one hand on your shoulder \\r\\n3. Press up with the other arm and hold in extension \",\n      \"video_tips\": \"          \",\n      \"pro_tips\": \" Avoid supporting the movement with your core muscle.      \",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Triceps\",\n      \"video\": [\n      {\n      \"id\": \"43\",\n      \"path\": \"49_1454043404.mp4\",\n      \"videothumbnail\": \"49_1454043404.jpg\",\n      \"description\": \"Side Triceps\"\n      }\n      ]\n      }\n      },\n      {\n      \"id\": \"14\",\n      \"row\": \"3\",\n      \"exercise_id\": \"4\",\n      \"duration\": {\n      \"min\": \"60\",\n      \"max\": \"90\"\n      },\n      \"unit\": \"seconds\",\n      \"is_completed\": \"0\",\n      \"created_at\": \"2016-01-22 04:37:32\",\n      \"updated_at\": \"2016-04-04 14:02:11\",\n      \"exercise\": {\n      \"id\": \"4\",\n      \"name\": \"Plank\",\n      \"description\": \"The plank builds your isometric strength and helps sculpt your waistline.\",\n      \"category\": \"1\",\n      \"type\": \"1\",\n      \"muscle_groups\": \"1,4,6,8\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"seconds\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \"1. Get into pushup position on the floor.\\r\\n2. Now bend your elbows 90 degrees and rest your weight on your forearms. \\r\\n3. Hold the position for as long as you can.   \",\n      \"video_tips\": \"        \",\n      \"pro_tips\": \"Drive your chest away from the ground and spread your shoulder blades as much as you can.\\r\\nKeep a straight line, from head to toe. \\r\\nDon't collapse your lower back or reach your butt to the sky. Add movement to your plank, rock back and forth on your forearms and toes or shift from side to side.\\r\\nTry advanced variations with alternating sinlge leg support. \\r\\nStart with an incline plank if a straight plank is too hard in the beginning.  \",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Shoulders, Back, Core, Full Body\",\n      \"video\": [\n      {\n      \"id\": \"4\",\n      \"path\": \"4_1453976855.mp4\",\n      \"videothumbnail\": \"4_1453976855.jpg\",\n      \"description\": \"Plank\"\n      }\n      ]\n      }\n      },\n      {\n      \"id\": \"15\",\n      \"row\": \"3\",\n      \"exercise_id\": \"36\",\n      \"duration\": {\n      \"min\": \"20\",\n      \"max\": \"\"\n      },\n      \"unit\": \"times\",\n      \"is_completed\": \"0\",\n      \"created_at\": \"2016-01-22 04:37:57\",\n      \"updated_at\": \"2016-04-04 11:12:49\",\n      \"exercise\": {\n      \"id\": \"36\",\n      \"name\": \"High Jumps\",\n      \"description\": \"Do high jumps as a part of restless HIIT workouts\",\n      \"category\": \"1\",\n      \"type\": \"2\",\n      \"muscle_groups\": \"7\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \"1. Start from a standing position\\r\\n2. Jump up and bring your knees to your chest\",\n      \"video_tips\": \"    \",\n      \"pro_tips\": \"Land softly and exhale when the knees are up.\\r\\n  \",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Legs\",\n      \"video\": [\n      {\n      \"id\": \"33\",\n      \"path\": \"36_1454042273.mp4\",\n      \"videothumbnail\": \"36_1454042273.jpg\",\n      \"description\": \"High Jumps\"\n      }\n      ]\n      }\n      }\n      ],\n      \"exercises\": [],\n      \"workout\": {\n      \"id\": \"9\",\n      \"name\": \"Elli\",\n      \"description\": \"C,A,D\",\n      \"rounds\": \"3\",\n      \"category\": \"2\",\n      \"type\": \"1\",\n      \"rewards\": \"330\",\n      \"duration\": \"420.00\",\n      \"equipments\": \"Bar/Rings\",\n      \"is_completed\": 0,\n      \"exercises\": {\n      \"round1\": [\n      {\n      \"id\": \"325\",\n      \"workout_id\": \"9\",\n      \"category\": \"1\",\n      \"repititions\": \"20\",\n      \"exercise_id\": \"39\",\n      \"unit\": \"times\",\n      \"round\": \"1\",\n      \"created_at\": \"2016-01-19 05:28:43\",\n      \"updated_at\": \"2016-04-04 11:16:09\",\n      \"exercise\": {\n      \"id\": \"39\",\n      \"name\": \"Climbers\",\n      \"description\": \"Increase your energy, health and endurance\",\n      \"category\": \"1\",\n      \"type\": \"2\",\n      \"muscle_groups\": \"7\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \"1. Start in pushup position\\r\\n2. Alternate your legs up to hand level\\r\\n3. Repeat\",\n      \"video_tips\": \"    \",\n      \"pro_tips\": \"If you are new to mountain climbers perform the knee to chest motion slow and steadily then build it up to a faster pace for a better cardio effect.    \",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Legs\"\n      },\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"328\",\n      \"workout_id\": \"9\",\n      \"category\": \"1\",\n      \"repititions\": \"15\",\n      \"exercise_id\": \"66\",\n      \"unit\": \"times\",\n      \"round\": \"1\",\n      \"created_at\": \"2016-01-19 05:29:04\",\n      \"updated_at\": \"2016-04-04 14:31:38\",\n      \"exercise\": {\n      \"id\": \"69\",\n      \"name\": \"Jumping Pullups\",\n      \"description\": \"Expose yourself to packed shoulders and hang time\",\n      \"category\": \"1\",\n      \"type\": \"1\",\n      \"muscle_groups\": \"1,5\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \" 1. Grip a bar and jump into the top position of the pull-up exercise\\r\\n2. Straight legs in front of you. \\r\\n3. Slowly go down into a deadhang position \",\n      \"video_tips\": \"        \",\n      \"pro_tips\": \" A deadhang postion requires your shoulder blades down and towards the spine with arms being straight (retraction)\\r\\nAim for three second holds at the top and go down slowly \",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Shoulders, Arms\"\n      },\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"331\",\n      \"workout_id\": \"9\",\n      \"category\": \"1\",\n      \"repititions\": \"15\",\n      \"exercise_id\": \"22\",\n      \"unit\": \"times\",\n      \"round\": \"1\",\n      \"created_at\": \"2016-01-19 05:29:28\",\n      \"updated_at\": \"2016-04-04 14:09:31\",\n      \"exercise\": {\n      \"id\": \"22\",\n      \"name\": \"Spiderman Pushups\",\n      \"description\": \"Learn to control your body and create body awareness\",\n      \"category\": \"1\",\n      \"type\": \"2\",\n      \"muscle_groups\": \"2,3,5,6\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \"  1. Start in a standard pushup position.\\r\\n 2. Next, lower yourself downward until your chest almost touches the floor as you inhale.\\r\\n 3. Bring your knees to your elbows as you go down and alternate with next repition. \",\n      \"video_tips\": \"      \",\n      \"pro_tips\": \" Pretend you are balancing something on your tailbone as you do the Spiderman pushup to maintain the correct plank position. This keeps your hips from rotating. \",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Chest, Triceps, Arms, Core\"\n      },\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"337\",\n      \"workout_id\": \"9\",\n      \"category\": \"1\",\n      \"repititions\": \"25\",\n      \"exercise_id\": \"57\",\n      \"unit\": \"times\",\n      \"round\": \"1\",\n      \"created_at\": \"2016-01-19 05:30:04\",\n      \"updated_at\": \"2016-04-04 12:10:48\",\n      \"exercise\": {\n      \"id\": \"57\",\n      \"name\": \"Knee Raises\",\n      \"description\": \"Develop grip and core strength and get used to slow and controlled moves\",\n      \"category\": \"1\",\n      \"type\": \"2\",\n      \"muscle_groups\": \"4,6,7\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \"1. Start from a deadhang position with your arms and legs fully extended, and feet off the ground.  \\r\\n2. Raise your knees up towards your chest as high as possible. \\r\\n3. Hold for a brief moment and slowly return to the starting position. \\r\\n4. Repeat for required repetitions. \",\n      \"video_tips\": \"    \",\n      \"pro_tips\": \"Avoid using momentum or swinging during the exercise. \\r\\nPerform the knee raise slowly and controlled.\",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Back, Core, Legs\"\n      },\n      \"is_completed\": 0\n      }\n      ],\n      \"round2\": [\n      {\n      \"id\": \"326\",\n      \"workout_id\": \"9\",\n      \"category\": \"1\",\n      \"repititions\": \"20\",\n      \"exercise_id\": \"39\",\n      \"unit\": \"times\",\n      \"round\": \"2\",\n      \"created_at\": \"2016-01-19 05:28:43\",\n      \"updated_at\": \"2016-04-04 11:16:09\",\n      \"exercise\": {\n      \"id\": \"39\",\n      \"name\": \"Climbers\",\n      \"description\": \"Increase your energy, health and endurance\",\n      \"category\": \"1\",\n      \"type\": \"2\",\n      \"muscle_groups\": \"7\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \"1. Start in pushup position\\r\\n2. Alternate your legs up to hand level\\r\\n3. Repeat\",\n      \"video_tips\": \"    \",\n      \"pro_tips\": \"If you are new to mountain climbers perform the knee to chest motion slow and steadily then build it up to a faster pace for a better cardio effect.    \",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Legs\"\n      },\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"329\",\n      \"workout_id\": \"9\",\n      \"category\": \"1\",\n      \"repititions\": \"15\",\n      \"exercise_id\": \"66\",\n      \"unit\": \"times\",\n      \"round\": \"2\",\n      \"created_at\": \"2016-01-19 05:29:05\",\n      \"updated_at\": \"2016-04-04 14:31:38\",\n      \"exercise\": {\n      \"id\": \"69\",\n      \"name\": \"Jumping Pullups\",\n      \"description\": \"Expose yourself to packed shoulders and hang time\",\n      \"category\": \"1\",\n      \"type\": \"1\",\n      \"muscle_groups\": \"1,5\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \" 1. Grip a bar and jump into the top position of the pull-up exercise\\r\\n2. Straight legs in front of you. \\r\\n3. Slowly go down into a deadhang position \",\n      \"video_tips\": \"        \",\n      \"pro_tips\": \" A deadhang postion requires your shoulder blades down and towards the spine with arms being straight (retraction)\\r\\nAim for three second holds at the top and go down slowly \",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Shoulders, Arms\"\n      },\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"332\",\n      \"workout_id\": \"9\",\n      \"category\": \"1\",\n      \"repititions\": \"15\",\n      \"exercise_id\": \"22\",\n      \"unit\": \"times\",\n      \"round\": \"2\",\n      \"created_at\": \"2016-01-19 05:29:28\",\n      \"updated_at\": \"2016-04-04 14:09:31\",\n      \"exercise\": {\n      \"id\": \"22\",\n      \"name\": \"Spiderman Pushups\",\n      \"description\": \"Learn to control your body and create body awareness\",\n      \"category\": \"1\",\n      \"type\": \"2\",\n      \"muscle_groups\": \"2,3,5,6\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \"  1. Start in a standard pushup position.\\r\\n 2. Next, lower yourself downward until your chest almost touches the floor as you inhale.\\r\\n 3. Bring your knees to your elbows as you go down and alternate with next repition. \",\n      \"video_tips\": \"      \",\n      \"pro_tips\": \" Pretend you are balancing something on your tailbone as you do the Spiderman pushup to maintain the correct plank position. This keeps your hips from rotating. \",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Chest, Triceps, Arms, Core\"\n      },\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"338\",\n      \"workout_id\": \"9\",\n      \"category\": \"1\",\n      \"repititions\": \"25\",\n      \"exercise_id\": \"57\",\n      \"unit\": \"times\",\n      \"round\": \"2\",\n      \"created_at\": \"2016-01-19 05:30:04\",\n      \"updated_at\": \"2016-04-04 12:10:48\",\n      \"exercise\": {\n      \"id\": \"57\",\n      \"name\": \"Knee Raises\",\n      \"description\": \"Develop grip and core strength and get used to slow and controlled moves\",\n      \"category\": \"1\",\n      \"type\": \"2\",\n      \"muscle_groups\": \"4,6,7\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \"1. Start from a deadhang position with your arms and legs fully extended, and feet off the ground.  \\r\\n2. Raise your knees up towards your chest as high as possible. \\r\\n3. Hold for a brief moment and slowly return to the starting position. \\r\\n4. Repeat for required repetitions. \",\n      \"video_tips\": \"    \",\n      \"pro_tips\": \"Avoid using momentum or swinging during the exercise. \\r\\nPerform the knee raise slowly and controlled.\",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Back, Core, Legs\"\n      },\n      \"is_completed\": 0\n      }\n      ],\n      \"round3\": [\n      {\n      \"id\": \"327\",\n      \"workout_id\": \"9\",\n      \"category\": \"1\",\n      \"repititions\": \"20\",\n      \"exercise_id\": \"39\",\n      \"unit\": \"times\",\n      \"round\": \"3\",\n      \"created_at\": \"2016-01-19 05:28:43\",\n      \"updated_at\": \"2016-04-04 11:16:09\",\n      \"exercise\": {\n      \"id\": \"39\",\n      \"name\": \"Climbers\",\n      \"description\": \"Increase your energy, health and endurance\",\n      \"category\": \"1\",\n      \"type\": \"2\",\n      \"muscle_groups\": \"7\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \"1. Start in pushup position\\r\\n2. Alternate your legs up to hand level\\r\\n3. Repeat\",\n      \"video_tips\": \"    \",\n      \"pro_tips\": \"If you are new to mountain climbers perform the knee to chest motion slow and steadily then build it up to a faster pace for a better cardio effect.    \",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Legs\"\n      },\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"330\",\n      \"workout_id\": \"9\",\n      \"category\": \"1\",\n      \"repititions\": \"15\",\n      \"exercise_id\": \"66\",\n      \"unit\": \"times\",\n      \"round\": \"3\",\n      \"created_at\": \"2016-01-19 05:29:05\",\n      \"updated_at\": \"2016-04-04 14:31:38\",\n      \"exercise\": {\n      \"id\": \"69\",\n      \"name\": \"Jumping Pullups\",\n      \"description\": \"Expose yourself to packed shoulders and hang time\",\n      \"category\": \"1\",\n      \"type\": \"1\",\n      \"muscle_groups\": \"1,5\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \" 1. Grip a bar and jump into the top position of the pull-up exercise\\r\\n2. Straight legs in front of you. \\r\\n3. Slowly go down into a deadhang position \",\n      \"video_tips\": \"        \",\n      \"pro_tips\": \" A deadhang postion requires your shoulder blades down and towards the spine with arms being straight (retraction)\\r\\nAim for three second holds at the top and go down slowly \",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Shoulders, Arms\"\n      },\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"333\",\n      \"workout_id\": \"9\",\n      \"category\": \"1\",\n      \"repititions\": \"15\",\n      \"exercise_id\": \"22\",\n      \"unit\": \"times\",\n      \"round\": \"3\",\n      \"created_at\": \"2016-01-19 05:29:28\",\n      \"updated_at\": \"2016-04-04 14:09:31\",\n      \"exercise\": {\n      \"id\": \"22\",\n      \"name\": \"Spiderman Pushups\",\n      \"description\": \"Learn to control your body and create body awareness\",\n      \"category\": \"1\",\n      \"type\": \"2\",\n      \"muscle_groups\": \"2,3,5,6\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \"  1. Start in a standard pushup position.\\r\\n 2. Next, lower yourself downward until your chest almost touches the floor as you inhale.\\r\\n 3. Bring your knees to your elbows as you go down and alternate with next repition. \",\n      \"video_tips\": \"      \",\n      \"pro_tips\": \" Pretend you are balancing something on your tailbone as you do the Spiderman pushup to maintain the correct plank position. This keeps your hips from rotating. \",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Chest, Triceps, Arms, Core\"\n      },\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"339\",\n      \"workout_id\": \"9\",\n      \"category\": \"1\",\n      \"repititions\": \"25\",\n      \"exercise_id\": \"57\",\n      \"unit\": \"times\",\n      \"round\": \"3\",\n      \"created_at\": \"2016-01-19 05:30:04\",\n      \"updated_at\": \"2016-04-04 12:10:48\",\n      \"exercise\": {\n      \"id\": \"57\",\n      \"name\": \"Knee Raises\",\n      \"description\": \"Develop grip and core strength and get used to slow and controlled moves\",\n      \"category\": \"1\",\n      \"type\": \"2\",\n      \"muscle_groups\": \"4,6,7\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \"1. Start from a deadhang position with your arms and legs fully extended, and feet off the ground.  \\r\\n2. Raise your knees up towards your chest as high as possible. \\r\\n3. Hold for a brief moment and slowly return to the starting position. \\r\\n4. Repeat for required repetitions. \",\n      \"video_tips\": \"    \",\n      \"pro_tips\": \"Avoid using momentum or swinging during the exercise. \\r\\nPerform the knee raise slowly and controlled.\",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Back, Core, Legs\"\n      },\n      \"is_completed\": 0\n      }\n      ]\n      },\n      \"exercise_category\": 1\n      },\n      \"coach_workout_rounds\": 3,\n      \"workout_intensity\": 1,\n      \"hiit\": [],\n      \"stretching\": [\n      {\n      \"id\": \"1\",\n      \"exercise_id\": \"Superman\",\n      \"duration\": {\n      \"min\": 6,\n      \"max\": 13\n      },\n      \"unit\": \"times\",\n      \"is_completed\": \"0\",\n      \"created_at\": \"2016-01-22 07:10:31\",\n      \"updated_at\": \"2016-01-22 07:10:31\"\n      },\n      {\n      \"id\": \"2\",\n      \"exercise_id\": \"Lower Back Strength\",\n      \"duration\": {\n      \"min\": 38,\n      \"max\": 63\n      },\n      \"unit\": \"times\",\n      \"is_completed\": \"0\",\n      \"created_at\": \"2016-01-22 07:15:02\",\n      \"updated_at\": \"2016-01-22 07:15:02\"\n      },\n      {\n      \"id\": \"3\",\n      \"exercise_id\": \"Upper Dog\",\n      \"duration\": {\n      \"min\": 38,\n      \"max\": 75\n      },\n      \"unit\": \"seconds\",\n      \"is_completed\": \"0\",\n      \"created_at\": \"2016-01-22 07:16:03\",\n      \"updated_at\": \"2016-01-22 07:16:03\"\n      },\n      {\n      \"id\": \"4\",\n      \"exercise_id\": \"Child's Pose\",\n      \"duration\": {\n      \"min\": 38,\n      \"max\": 75\n      },\n      \"unit\": \"seconds\",\n      \"is_completed\": \"0\",\n      \"created_at\": \"2016-01-22 07:16:46\",\n      \"updated_at\": \"2016-01-22 07:16:46\"\n      },\n      {\n      \"id\": \"5\",\n      \"exercise_id\": \"L-sit on the floor\",\n      \"duration\": {\n      \"min\": 38,\n      \"max\": 75\n      },\n      \"unit\": \"seconds\",\n      \"is_completed\": \"0\",\n      \"created_at\": \"2016-01-22 07:17:13\",\n      \"updated_at\": \"2016-01-22 07:17:13\"\n      },\n      {\n      \"id\": \"6\",\n      \"exercise_id\": \"Good morning\",\n      \"duration\": {\n      \"min\": 38,\n      \"max\": 75\n      },\n      \"unit\": \"seconds\",\n      \"is_completed\": \"0\",\n      \"created_at\": \"2016-01-22 07:17:43\",\n      \"updated_at\": \"2016-01-22 07:17:43\"\n      },\n      {\n      \"id\": \"7\",\n      \"exercise_id\": \"Chest Opener\",\n      \"duration\": {\n      \"min\": 38,\n      \"max\": 75\n      },\n      \"unit\": \"seconds\",\n      \"is_completed\": \"0\",\n      \"created_at\": \"2016-01-22 07:19:32\",\n      \"updated_at\": \"2016-01-22 07:19:32\"\n      },\n      {\n      \"id\": \"8\",\n      \"exercise_id\": \"Triceps Stretc\",\n      \"duration\": {\n      \"min\": 38,\n      \"max\": 75\n      },\n      \"unit\": \"seconds\",\n      \"is_completed\": \"0\",\n      \"created_at\": \"2016-01-22 07:19:56\",\n      \"updated_at\": \"2016-01-22 07:19:56\"\n      },\n      {\n      \"id\": \"9\",\n      \"exercise_id\": \"Hands Back\",\n      \"duration\": {\n      \"min\": 38,\n      \"max\": 75\n      },\n      \"unit\": \"seconds\",\n      \"is_completed\": \"0\",\n      \"created_at\": \"2016-01-22 07:20:19\",\n      \"updated_at\": \"2016-01-22 07:20:19\"\n      },\n      {\n      \"id\": \"10\",\n      \"exercise_id\": \"Shoulder Stretch\",\n      \"duration\": {\n      \"min\": 38,\n      \"max\": 75\n      },\n      \"unit\": \"seconds\",\n      \"is_completed\": \"0\",\n      \"created_at\": \"2016-01-22 07:20:45\",\n      \"updated_at\": \"2016-01-22 07:20:45\"\n      }\n      ],\n      \"status\": \"pending\"\n      },\n      \"day4\": {\n      \"warmup\": [\n      {\n      \"id\": \"1\",\n      \"name\": \"wall extensions\",\n      \"duration\": {\n      \"min\": \"10\",\n      \"max\": \"20\"\n      },\n      \"unit\": \"times\",\n      \"created_at\": \"2016-01-21 08:55:06\",\n      \"updated_at\": \"2016-01-21 08:55:06\",\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"2\",\n      \"name\": \"band dislocates\",\n      \"duration\": {\n      \"min\": \"10\",\n      \"max\": \"20\"\n      },\n      \"unit\": \"times\",\n      \"created_at\": \"2016-01-21 08:57:38\",\n      \"updated_at\": \"2016-01-21 08:57:38\",\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"3\",\n      \"name\": \"cat-camels\",\n      \"duration\": {\n      \"min\": \"10\",\n      \"max\": \"20\"\n      },\n      \"unit\": \"times\",\n      \"created_at\": \"2016-01-21 09:00:39\",\n      \"updated_at\": \"2016-01-21 09:00:39\",\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"4\",\n      \"name\": \"scapular shrugs\",\n      \"duration\": {\n      \"min\": \"10\",\n      \"max\": \"20\"\n      },\n      \"unit\": \"times\",\n      \"created_at\": \"2016-01-21 09:01:01\",\n      \"updated_at\": \"2016-01-21 09:01:01\",\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"5\",\n      \"name\": \"full body circles\",\n      \"duration\": {\n      \"min\": \"10\",\n      \"max\": \"20\"\n      },\n      \"unit\": \"times\",\n      \"created_at\": \"2016-01-21 09:01:26\",\n      \"updated_at\": \"2016-01-21 09:01:26\",\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"6\",\n      \"name\": \"Jumping Jacks\",\n      \"duration\": {\n      \"min\": \"100\",\n      \"max\": \"\"\n      },\n      \"unit\": \"seconds\",\n      \"created_at\": \"2016-01-21 09:04:52\",\n      \"updated_at\": \"2016-01-21 09:04:52\",\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"7\",\n      \"name\": \"Arm rotations\",\n      \"duration\": {\n      \"min\": \"120\",\n      \"max\": \"\"\n      },\n      \"unit\": \"times\",\n      \"created_at\": \"2016-01-21 09:05:29\",\n      \"updated_at\": \"2016-01-21 09:05:29\",\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"8\",\n      \"name\": \"High Knees\",\n      \"duration\": {\n      \"min\": \"50\",\n      \"max\": \"\"\n      },\n      \"unit\": \"times\",\n      \"created_at\": \"2016-01-21 09:06:02\",\n      \"updated_at\": \"2016-01-21 09:06:02\",\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"9\",\n      \"name\": \"Shouder rolls\",\n      \"duration\": {\n      \"min\": \"20\",\n      \"max\": \"\"\n      },\n      \"unit\": \"times\",\n      \"created_at\": \"2016-01-21 09:06:34\",\n      \"updated_at\": \"2016-01-21 09:06:34\",\n      \"is_completed\": 0\n      }\n      ],\n      \"is_completed\": 0,\n      \"fundumentals\": [\n      {\n      \"id\": \"11\",\n      \"row\": \"3\",\n      \"exercise_id\": \"64\",\n      \"duration\": {\n      \"min\": \"10\",\n      \"max\": \"\"\n      },\n      \"unit\": \"times\",\n      \"is_completed\": \"0\",\n      \"created_at\": \"2016-01-22 04:35:13\",\n      \"updated_at\": \"2016-04-04 14:27:54\",\n      \"exercise\": {\n      \"id\": \"64\",\n      \"name\": \"Skin the cat\",\n      \"description\": \"Develop your joints mobility and expose yourself to new movement layers\",\n      \"category\": \"1\",\n      \"type\": \"2\",\n      \"muscle_groups\": \"4,5,6\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \" 1. Hands a little more than shoulder width apart\\r\\n2. Raise your knees to the chest\\r\\n3. continuing the movement until the feet pass up through the arms and over head into an inverted hang position.\\r\\n4. Continue to pass the feet round and down toward the ground into the extended 'skin the cat' position.\\r\\n5. Lift your hips and raise the legs back and over to the starting hang position. \",\n      \"video_tips\": \"        \",\n      \"pro_tips\": \" Put your hands closer together to ease up all back lever progressions.\\r\\nDo only half of the movement in the beginning, but fight for completion over time.\\r\\nIncorporate other static elements to challenge yourself during the movement as you master other skills.\\r\\n    \",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Back, Arms, Core\",\n      \"video\": [\n      {\n      \"id\": \"71\",\n      \"path\": \"64_1454045043.mp4\",\n      \"videothumbnail\": \"64_1454045043.jpg\",\n      \"description\": \"Skin the cat\"\n      }\n      ]\n      }\n      },\n      {\n      \"id\": \"12\",\n      \"row\": \"3\",\n      \"exercise_id\": \"12\",\n      \"duration\": {\n      \"min\": \"20\",\n      \"max\": \"\"\n      },\n      \"unit\": \"times\",\n      \"is_completed\": \"0\",\n      \"created_at\": \"2016-01-22 04:36:16\",\n      \"updated_at\": \"2016-04-04 09:26:06\",\n      \"exercise\": {\n      \"id\": \"12\",\n      \"name\": \"Pushups\",\n      \"description\": \"Perform the most popular exercise of all time with real strength\",\n      \"category\": \"2\",\n      \"type\": \"1\",\n      \"muscle_groups\": \"1,2,3\",\n      \"rewards\": \"7.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \" 1. Lie on the floor face down and place your hands in a standard pushup position.\\r\\n 2. Next, lower yourself downward until your chest almost touches the floor as you inhale.\\r\\n 3. Exhale and press your upper body back up to the starting position while squeezing your chest.\\r\\n 4. Repeat, after a brief pause at the top contracted position.\\r\\n\",\n      \"video_tips\": \"      \",\n      \"pro_tips\": \"Do them extra slow and hold it in highest and lowest position to get strength.\\r\\nOne of the most common push-up mistakes is flaring out the elbows out instead of keeping them at your sides.\\r\\nIf too easy, try Spiderman and Diamond Pushups or wear a weigthed vest.\",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Shoulders, Chest, Triceps\",\n      \"video\": [\n      {\n      \"id\": \"57\",\n      \"path\": \"12_1453984139.mp4\",\n      \"videothumbnail\": \"12_1453984139.jpg\",\n      \"description\": \"Pushups\"\n      }\n      ]\n      }\n      },\n      {\n      \"id\": \"13\",\n      \"row\": \"3\",\n      \"exercise_id\": \"49\",\n      \"duration\": {\n      \"min\": \"30\",\n      \"max\": \"\"\n      },\n      \"unit\": \"times\",\n      \"is_completed\": \"0\",\n      \"created_at\": \"2016-01-22 04:36:49\",\n      \"updated_at\": \"2016-04-04 14:19:29\",\n      \"exercise\": {\n      \"id\": \"49\",\n      \"name\": \"Side Triceps\",\n      \"description\": \"Start with the basics of building triceps strength\",\n      \"category\": \"1\",\n      \"type\": \"1\",\n      \"muscle_groups\": \"3\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \" 1. Start with the body on your side\\r\\n2. Put one hand on your shoulder \\r\\n3. Press up with the other arm and hold in extension \",\n      \"video_tips\": \"          \",\n      \"pro_tips\": \" Avoid supporting the movement with your core muscle.      \",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Triceps\",\n      \"video\": [\n      {\n      \"id\": \"43\",\n      \"path\": \"49_1454043404.mp4\",\n      \"videothumbnail\": \"49_1454043404.jpg\",\n      \"description\": \"Side Triceps\"\n      }\n      ]\n      }\n      },\n      {\n      \"id\": \"14\",\n      \"row\": \"3\",\n      \"exercise_id\": \"4\",\n      \"duration\": {\n      \"min\": \"60\",\n      \"max\": \"90\"\n      },\n      \"unit\": \"seconds\",\n      \"is_completed\": \"0\",\n      \"created_at\": \"2016-01-22 04:37:32\",\n      \"updated_at\": \"2016-04-04 14:02:11\",\n      \"exercise\": {\n      \"id\": \"4\",\n      \"name\": \"Plank\",\n      \"description\": \"The plank builds your isometric strength and helps sculpt your waistline.\",\n      \"category\": \"1\",\n      \"type\": \"1\",\n      \"muscle_groups\": \"1,4,6,8\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"seconds\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \"1. Get into pushup position on the floor.\\r\\n2. Now bend your elbows 90 degrees and rest your weight on your forearms. \\r\\n3. Hold the position for as long as you can.   \",\n      \"video_tips\": \"        \",\n      \"pro_tips\": \"Drive your chest away from the ground and spread your shoulder blades as much as you can.\\r\\nKeep a straight line, from head to toe. \\r\\nDon't collapse your lower back or reach your butt to the sky. Add movement to your plank, rock back and forth on your forearms and toes or shift from side to side.\\r\\nTry advanced variations with alternating sinlge leg support. \\r\\nStart with an incline plank if a straight plank is too hard in the beginning.  \",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Shoulders, Back, Core, Full Body\",\n      \"video\": [\n      {\n      \"id\": \"4\",\n      \"path\": \"4_1453976855.mp4\",\n      \"videothumbnail\": \"4_1453976855.jpg\",\n      \"description\": \"Plank\"\n      }\n      ]\n      }\n      },\n      {\n      \"id\": \"15\",\n      \"row\": \"3\",\n      \"exercise_id\": \"36\",\n      \"duration\": {\n      \"min\": \"20\",\n      \"max\": \"\"\n      },\n      \"unit\": \"times\",\n      \"is_completed\": \"0\",\n      \"created_at\": \"2016-01-22 04:37:57\",\n      \"updated_at\": \"2016-04-04 11:12:49\",\n      \"exercise\": {\n      \"id\": \"36\",\n      \"name\": \"High Jumps\",\n      \"description\": \"Do high jumps as a part of restless HIIT workouts\",\n      \"category\": \"1\",\n      \"type\": \"2\",\n      \"muscle_groups\": \"7\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \"1. Start from a standing position\\r\\n2. Jump up and bring your knees to your chest\",\n      \"video_tips\": \"    \",\n      \"pro_tips\": \"Land softly and exhale when the knees are up.\\r\\n  \",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Legs\",\n      \"video\": [\n      {\n      \"id\": \"33\",\n      \"path\": \"36_1454042273.mp4\",\n      \"videothumbnail\": \"36_1454042273.jpg\",\n      \"description\": \"High Jumps\"\n      }\n      ]\n      }\n      }\n      ],\n      \"exercises\": [],\n      \"workout\": {\n      \"id\": \"1\",\n      \"name\": \"Baldur\",\n      \"description\": \"A,D,B\",\n      \"rounds\": \"5\",\n      \"category\": \"1\",\n      \"type\": \"2\",\n      \"rewards\": \"440\",\n      \"duration\": \"2380.00\",\n      \"equipments\": \"Bar/Rings, Paralettes/Rings\",\n      \"is_completed\": 0,\n      \"exercises\": {\n      \"round1\": [\n      {\n      \"id\": \"1\",\n      \"workout_id\": \"1\",\n      \"category\": \"1\",\n      \"repititions\": \"10\",\n      \"exercise_id\": \"66\",\n      \"unit\": \"times\",\n      \"round\": \"1\",\n      \"created_at\": \"2016-01-19 03:15:36\",\n      \"updated_at\": \"2016-04-04 14:31:38\",\n      \"exercise\": {\n      \"id\": \"69\",\n      \"name\": \"Jumping Pullups\",\n      \"description\": \"Expose yourself to packed shoulders and hang time\",\n      \"category\": \"1\",\n      \"type\": \"1\",\n      \"muscle_groups\": \"1,5\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \" 1. Grip a bar and jump into the top position of the pull-up exercise\\r\\n2. Straight legs in front of you. \\r\\n3. Slowly go down into a deadhang position \",\n      \"video_tips\": \"        \",\n      \"pro_tips\": \" A deadhang postion requires your shoulder blades down and towards the spine with arms being straight (retraction)\\r\\nAim for three second holds at the top and go down slowly \",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Shoulders, Arms\"\n      },\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"6\",\n      \"workout_id\": \"1\",\n      \"category\": \"1\",\n      \"repititions\": \"10\",\n      \"exercise_id\": \"22\",\n      \"unit\": \"times\",\n      \"round\": \"1\",\n      \"created_at\": \"2016-01-19 03:17:21\",\n      \"updated_at\": \"2016-04-04 14:09:31\",\n      \"exercise\": {\n      \"id\": \"22\",\n      \"name\": \"Spiderman Pushups\",\n      \"description\": \"Learn to control your body and create body awareness\",\n      \"category\": \"1\",\n      \"type\": \"2\",\n      \"muscle_groups\": \"2,3,5,6\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \"  1. Start in a standard pushup position.\\r\\n 2. Next, lower yourself downward until your chest almost touches the floor as you inhale.\\r\\n 3. Bring your knees to your elbows as you go down and alternate with next repition. \",\n      \"video_tips\": \"      \",\n      \"pro_tips\": \" Pretend you are balancing something on your tailbone as you do the Spiderman pushup to maintain the correct plank position. This keeps your hips from rotating. \",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Chest, Triceps, Arms, Core\"\n      },\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"11\",\n      \"workout_id\": \"1\",\n      \"category\": \"1\",\n      \"repititions\": \"10\",\n      \"exercise_id\": \"49\",\n      \"unit\": \"times\",\n      \"round\": \"1\",\n      \"created_at\": \"2016-01-19 03:19:02\",\n      \"updated_at\": \"2016-04-04 14:19:29\",\n      \"exercise\": {\n      \"id\": \"49\",\n      \"name\": \"Side Triceps\",\n      \"description\": \"Start with the basics of building triceps strength\",\n      \"category\": \"1\",\n      \"type\": \"1\",\n      \"muscle_groups\": \"3\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \" 1. Start with the body on your side\\r\\n2. Put one hand on your shoulder \\r\\n3. Press up with the other arm and hold in extension \",\n      \"video_tips\": \"          \",\n      \"pro_tips\": \" Avoid supporting the movement with your core muscle.      \",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Triceps\"\n      },\n      \"is_completed\": 0\n      }\n      ],\n      \"round2\": [\n      {\n      \"id\": \"3\",\n      \"workout_id\": \"1\",\n      \"category\": \"1\",\n      \"repititions\": \"20\",\n      \"exercise_id\": \"66\",\n      \"unit\": \"times\",\n      \"round\": \"2\",\n      \"created_at\": \"2016-01-19 03:16:17\",\n      \"updated_at\": \"2016-04-04 14:31:38\",\n      \"exercise\": {\n      \"id\": \"69\",\n      \"name\": \"Jumping Pullups\",\n      \"description\": \"Expose yourself to packed shoulders and hang time\",\n      \"category\": \"1\",\n      \"type\": \"1\",\n      \"muscle_groups\": \"1,5\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \" 1. Grip a bar and jump into the top position of the pull-up exercise\\r\\n2. Straight legs in front of you. \\r\\n3. Slowly go down into a deadhang position \",\n      \"video_tips\": \"        \",\n      \"pro_tips\": \" A deadhang postion requires your shoulder blades down and towards the spine with arms being straight (retraction)\\r\\nAim for three second holds at the top and go down slowly \",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Shoulders, Arms\"\n      },\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"8\",\n      \"workout_id\": \"1\",\n      \"category\": \"1\",\n      \"repititions\": \"20\",\n      \"exercise_id\": \"22\",\n      \"unit\": \"times\",\n      \"round\": \"2\",\n      \"created_at\": \"2016-01-19 03:17:54\",\n      \"updated_at\": \"2016-04-04 14:09:31\",\n      \"exercise\": {\n      \"id\": \"22\",\n      \"name\": \"Spiderman Pushups\",\n      \"description\": \"Learn to control your body and create body awareness\",\n      \"category\": \"1\",\n      \"type\": \"2\",\n      \"muscle_groups\": \"2,3,5,6\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \"  1. Start in a standard pushup position.\\r\\n 2. Next, lower yourself downward until your chest almost touches the floor as you inhale.\\r\\n 3. Bring your knees to your elbows as you go down and alternate with next repition. \",\n      \"video_tips\": \"      \",\n      \"pro_tips\": \" Pretend you are balancing something on your tailbone as you do the Spiderman pushup to maintain the correct plank position. This keeps your hips from rotating. \",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Chest, Triceps, Arms, Core\"\n      },\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"13\",\n      \"workout_id\": \"1\",\n      \"category\": \"1\",\n      \"repititions\": \"20\",\n      \"exercise_id\": \"49\",\n      \"unit\": \"times\",\n      \"round\": \"2\",\n      \"created_at\": \"2016-01-19 03:19:23\",\n      \"updated_at\": \"2016-04-04 14:19:29\",\n      \"exercise\": {\n      \"id\": \"49\",\n      \"name\": \"Side Triceps\",\n      \"description\": \"Start with the basics of building triceps strength\",\n      \"category\": \"1\",\n      \"type\": \"1\",\n      \"muscle_groups\": \"3\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \" 1. Start with the body on your side\\r\\n2. Put one hand on your shoulder \\r\\n3. Press up with the other arm and hold in extension \",\n      \"video_tips\": \"          \",\n      \"pro_tips\": \" Avoid supporting the movement with your core muscle.      \",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Triceps\"\n      },\n      \"is_completed\": 0\n      }\n      ],\n      \"round3\": [\n      {\n      \"id\": \"5\",\n      \"workout_id\": \"1\",\n      \"category\": \"1\",\n      \"repititions\": \"30\",\n      \"exercise_id\": \"66\",\n      \"unit\": \"times\",\n      \"round\": \"3\",\n      \"created_at\": \"2016-01-19 03:16:40\",\n      \"updated_at\": \"2016-04-04 14:31:38\",\n      \"exercise\": {\n      \"id\": \"69\",\n      \"name\": \"Jumping Pullups\",\n      \"description\": \"Expose yourself to packed shoulders and hang time\",\n      \"category\": \"1\",\n      \"type\": \"1\",\n      \"muscle_groups\": \"1,5\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \" 1. Grip a bar and jump into the top position of the pull-up exercise\\r\\n2. Straight legs in front of you. \\r\\n3. Slowly go down into a deadhang position \",\n      \"video_tips\": \"        \",\n      \"pro_tips\": \" A deadhang postion requires your shoulder blades down and towards the spine with arms being straight (retraction)\\r\\nAim for three second holds at the top and go down slowly \",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Shoulders, Arms\"\n      },\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"10\",\n      \"workout_id\": \"1\",\n      \"category\": \"1\",\n      \"repititions\": \"30\",\n      \"exercise_id\": \"22\",\n      \"unit\": \"times\",\n      \"round\": \"3\",\n      \"created_at\": \"2016-01-19 03:18:11\",\n      \"updated_at\": \"2016-04-04 14:09:31\",\n      \"exercise\": {\n      \"id\": \"22\",\n      \"name\": \"Spiderman Pushups\",\n      \"description\": \"Learn to control your body and create body awareness\",\n      \"category\": \"1\",\n      \"type\": \"2\",\n      \"muscle_groups\": \"2,3,5,6\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \"  1. Start in a standard pushup position.\\r\\n 2. Next, lower yourself downward until your chest almost touches the floor as you inhale.\\r\\n 3. Bring your knees to your elbows as you go down and alternate with next repition. \",\n      \"video_tips\": \"      \",\n      \"pro_tips\": \" Pretend you are balancing something on your tailbone as you do the Spiderman pushup to maintain the correct plank position. This keeps your hips from rotating. \",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Chest, Triceps, Arms, Core\"\n      },\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"15\",\n      \"workout_id\": \"1\",\n      \"category\": \"1\",\n      \"repititions\": \"30\",\n      \"exercise_id\": \"49\",\n      \"unit\": \"times\",\n      \"round\": \"3\",\n      \"created_at\": \"2016-01-19 03:19:48\",\n      \"updated_at\": \"2016-04-04 14:19:29\",\n      \"exercise\": {\n      \"id\": \"49\",\n      \"name\": \"Side Triceps\",\n      \"description\": \"Start with the basics of building triceps strength\",\n      \"category\": \"1\",\n      \"type\": \"1\",\n      \"muscle_groups\": \"3\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \" 1. Start with the body on your side\\r\\n2. Put one hand on your shoulder \\r\\n3. Press up with the other arm and hold in extension \",\n      \"video_tips\": \"          \",\n      \"pro_tips\": \" Avoid supporting the movement with your core muscle.      \",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Triceps\"\n      },\n      \"is_completed\": 0\n      }\n      ]\n      },\n      \"exercise_category\": 1\n      },\n      \"coach_workout_rounds\": 3,\n      \"workout_intensity\": 1,\n      \"hiit\": [],\n      \"stretching\": [\n      {\n      \"id\": \"1\",\n      \"exercise_id\": \"Superman\",\n      \"duration\": {\n      \"min\": 6,\n      \"max\": 13\n      },\n      \"unit\": \"times\",\n      \"is_completed\": \"0\",\n      \"created_at\": \"2016-01-22 07:10:31\",\n      \"updated_at\": \"2016-01-22 07:10:31\"\n      },\n      {\n      \"id\": \"2\",\n      \"exercise_id\": \"Lower Back Strength\",\n      \"duration\": {\n      \"min\": 38,\n      \"max\": 63\n      },\n      \"unit\": \"times\",\n      \"is_completed\": \"0\",\n      \"created_at\": \"2016-01-22 07:15:02\",\n      \"updated_at\": \"2016-01-22 07:15:02\"\n      },\n      {\n      \"id\": \"3\",\n      \"exercise_id\": \"Upper Dog\",\n      \"duration\": {\n      \"min\": 38,\n      \"max\": 75\n      },\n      \"unit\": \"seconds\",\n      \"is_completed\": \"0\",\n      \"created_at\": \"2016-01-22 07:16:03\",\n      \"updated_at\": \"2016-01-22 07:16:03\"\n      },\n      {\n      \"id\": \"4\",\n      \"exercise_id\": \"Child's Pose\",\n      \"duration\": {\n      \"min\": 38,\n      \"max\": 75\n      },\n      \"unit\": \"seconds\",\n      \"is_completed\": \"0\",\n      \"created_at\": \"2016-01-22 07:16:46\",\n      \"updated_at\": \"2016-01-22 07:16:46\"\n      },\n      {\n      \"id\": \"5\",\n      \"exercise_id\": \"L-sit on the floor\",\n      \"duration\": {\n      \"min\": 38,\n      \"max\": 75\n      },\n      \"unit\": \"seconds\",\n      \"is_completed\": \"0\",\n      \"created_at\": \"2016-01-22 07:17:13\",\n      \"updated_at\": \"2016-01-22 07:17:13\"\n      },\n      {\n      \"id\": \"6\",\n      \"exercise_id\": \"Good morning\",\n      \"duration\": {\n      \"min\": 38,\n      \"max\": 75\n      },\n      \"unit\": \"seconds\",\n      \"is_completed\": \"0\",\n      \"created_at\": \"2016-01-22 07:17:43\",\n      \"updated_at\": \"2016-01-22 07:17:43\"\n      },\n      {\n      \"id\": \"7\",\n      \"exercise_id\": \"Chest Opener\",\n      \"duration\": {\n      \"min\": 38,\n      \"max\": 75\n      },\n      \"unit\": \"seconds\",\n      \"is_completed\": \"0\",\n      \"created_at\": \"2016-01-22 07:19:32\",\n      \"updated_at\": \"2016-01-22 07:19:32\"\n      },\n      {\n      \"id\": \"8\",\n      \"exercise_id\": \"Triceps Stretc\",\n      \"duration\": {\n      \"min\": 38,\n      \"max\": 75\n      },\n      \"unit\": \"seconds\",\n      \"is_completed\": \"0\",\n      \"created_at\": \"2016-01-22 07:19:56\",\n      \"updated_at\": \"2016-01-22 07:19:56\"\n      },\n      {\n      \"id\": \"9\",\n      \"exercise_id\": \"Hands Back\",\n      \"duration\": {\n      \"min\": 38,\n      \"max\": 75\n      },\n      \"unit\": \"seconds\",\n      \"is_completed\": \"0\",\n      \"created_at\": \"2016-01-22 07:20:19\",\n      \"updated_at\": \"2016-01-22 07:20:19\"\n      },\n      {\n      \"id\": \"10\",\n      \"exercise_id\": \"Shoulder Stretch\",\n      \"duration\": {\n      \"min\": 38,\n      \"max\": 75\n      },\n      \"unit\": \"seconds\",\n      \"is_completed\": \"0\",\n      \"created_at\": \"2016-01-22 07:20:45\",\n      \"updated_at\": \"2016-01-22 07:20:45\"\n      }\n      ],\n      \"status\": \"pending\"\n      },\n      \"day5\": {\n      \"warmup\": [\n      {\n      \"id\": \"1\",\n      \"name\": \"wall extensions\",\n      \"duration\": {\n      \"min\": \"10\",\n      \"max\": \"20\"\n      },\n      \"unit\": \"times\",\n      \"created_at\": \"2016-01-21 08:55:06\",\n      \"updated_at\": \"2016-01-21 08:55:06\",\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"2\",\n      \"name\": \"band dislocates\",\n      \"duration\": {\n      \"min\": \"10\",\n      \"max\": \"20\"\n      },\n      \"unit\": \"times\",\n      \"created_at\": \"2016-01-21 08:57:38\",\n      \"updated_at\": \"2016-01-21 08:57:38\",\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"3\",\n      \"name\": \"cat-camels\",\n      \"duration\": {\n      \"min\": \"10\",\n      \"max\": \"20\"\n      },\n      \"unit\": \"times\",\n      \"created_at\": \"2016-01-21 09:00:39\",\n      \"updated_at\": \"2016-01-21 09:00:39\",\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"4\",\n      \"name\": \"scapular shrugs\",\n      \"duration\": {\n      \"min\": \"10\",\n      \"max\": \"20\"\n      },\n      \"unit\": \"times\",\n      \"created_at\": \"2016-01-21 09:01:01\",\n      \"updated_at\": \"2016-01-21 09:01:01\",\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"5\",\n      \"name\": \"full body circles\",\n      \"duration\": {\n      \"min\": \"10\",\n      \"max\": \"20\"\n      },\n      \"unit\": \"times\",\n      \"created_at\": \"2016-01-21 09:01:26\",\n      \"updated_at\": \"2016-01-21 09:01:26\",\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"6\",\n      \"name\": \"Jumping Jacks\",\n      \"duration\": {\n      \"min\": \"100\",\n      \"max\": \"\"\n      },\n      \"unit\": \"seconds\",\n      \"created_at\": \"2016-01-21 09:04:52\",\n      \"updated_at\": \"2016-01-21 09:04:52\",\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"7\",\n      \"name\": \"Arm rotations\",\n      \"duration\": {\n      \"min\": \"120\",\n      \"max\": \"\"\n      },\n      \"unit\": \"times\",\n      \"created_at\": \"2016-01-21 09:05:29\",\n      \"updated_at\": \"2016-01-21 09:05:29\",\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"8\",\n      \"name\": \"High Knees\",\n      \"duration\": {\n      \"min\": \"50\",\n      \"max\": \"\"\n      },\n      \"unit\": \"times\",\n      \"created_at\": \"2016-01-21 09:06:02\",\n      \"updated_at\": \"2016-01-21 09:06:02\",\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"9\",\n      \"name\": \"Shouder rolls\",\n      \"duration\": {\n      \"min\": \"20\",\n      \"max\": \"\"\n      },\n      \"unit\": \"times\",\n      \"created_at\": \"2016-01-21 09:06:34\",\n      \"updated_at\": \"2016-01-21 09:06:34\",\n      \"is_completed\": 0\n      }\n      ],\n      \"is_completed\": 0,\n      \"fundumentals\": [\n      {\n      \"id\": \"11\",\n      \"row\": \"3\",\n      \"exercise_id\": \"64\",\n      \"duration\": {\n      \"min\": \"10\",\n      \"max\": \"\"\n      },\n      \"unit\": \"times\",\n      \"is_completed\": \"0\",\n      \"created_at\": \"2016-01-22 04:35:13\",\n      \"updated_at\": \"2016-04-04 14:27:54\",\n      \"exercise\": {\n      \"id\": \"64\",\n      \"name\": \"Skin the cat\",\n      \"description\": \"Develop your joints mobility and expose yourself to new movement layers\",\n      \"category\": \"1\",\n      \"type\": \"2\",\n      \"muscle_groups\": \"4,5,6\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \" 1. Hands a little more than shoulder width apart\\r\\n2. Raise your knees to the chest\\r\\n3. continuing the movement until the feet pass up through the arms and over head into an inverted hang position.\\r\\n4. Continue to pass the feet round and down toward the ground into the extended 'skin the cat' position.\\r\\n5. Lift your hips and raise the legs back and over to the starting hang position. \",\n      \"video_tips\": \"        \",\n      \"pro_tips\": \" Put your hands closer together to ease up all back lever progressions.\\r\\nDo only half of the movement in the beginning, but fight for completion over time.\\r\\nIncorporate other static elements to challenge yourself during the movement as you master other skills.\\r\\n    \",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Back, Arms, Core\",\n      \"video\": [\n      {\n      \"id\": \"71\",\n      \"path\": \"64_1454045043.mp4\",\n      \"videothumbnail\": \"64_1454045043.jpg\",\n      \"description\": \"Skin the cat\"\n      }\n      ]\n      }\n      },\n      {\n      \"id\": \"12\",\n      \"row\": \"3\",\n      \"exercise_id\": \"12\",\n      \"duration\": {\n      \"min\": \"20\",\n      \"max\": \"\"\n      },\n      \"unit\": \"times\",\n      \"is_completed\": \"0\",\n      \"created_at\": \"2016-01-22 04:36:16\",\n      \"updated_at\": \"2016-04-04 09:26:06\",\n      \"exercise\": {\n      \"id\": \"12\",\n      \"name\": \"Pushups\",\n      \"description\": \"Perform the most popular exercise of all time with real strength\",\n      \"category\": \"2\",\n      \"type\": \"1\",\n      \"muscle_groups\": \"1,2,3\",\n      \"rewards\": \"7.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \" 1. Lie on the floor face down and place your hands in a standard pushup position.\\r\\n 2. Next, lower yourself downward until your chest almost touches the floor as you inhale.\\r\\n 3. Exhale and press your upper body back up to the starting position while squeezing your chest.\\r\\n 4. Repeat, after a brief pause at the top contracted position.\\r\\n\",\n      \"video_tips\": \"      \",\n      \"pro_tips\": \"Do them extra slow and hold it in highest and lowest position to get strength.\\r\\nOne of the most common push-up mistakes is flaring out the elbows out instead of keeping them at your sides.\\r\\nIf too easy, try Spiderman and Diamond Pushups or wear a weigthed vest.\",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Shoulders, Chest, Triceps\",\n      \"video\": [\n      {\n      \"id\": \"57\",\n      \"path\": \"12_1453984139.mp4\",\n      \"videothumbnail\": \"12_1453984139.jpg\",\n      \"description\": \"Pushups\"\n      }\n      ]\n      }\n      },\n      {\n      \"id\": \"13\",\n      \"row\": \"3\",\n      \"exercise_id\": \"49\",\n      \"duration\": {\n      \"min\": \"30\",\n      \"max\": \"\"\n      },\n      \"unit\": \"times\",\n      \"is_completed\": \"0\",\n      \"created_at\": \"2016-01-22 04:36:49\",\n      \"updated_at\": \"2016-04-04 14:19:29\",\n      \"exercise\": {\n      \"id\": \"49\",\n      \"name\": \"Side Triceps\",\n      \"description\": \"Start with the basics of building triceps strength\",\n      \"category\": \"1\",\n      \"type\": \"1\",\n      \"muscle_groups\": \"3\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \" 1. Start with the body on your side\\r\\n2. Put one hand on your shoulder \\r\\n3. Press up with the other arm and hold in extension \",\n      \"video_tips\": \"          \",\n      \"pro_tips\": \" Avoid supporting the movement with your core muscle.      \",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Triceps\",\n      \"video\": [\n      {\n      \"id\": \"43\",\n      \"path\": \"49_1454043404.mp4\",\n      \"videothumbnail\": \"49_1454043404.jpg\",\n      \"description\": \"Side Triceps\"\n      }\n      ]\n      }\n      },\n      {\n      \"id\": \"14\",\n      \"row\": \"3\",\n      \"exercise_id\": \"4\",\n      \"duration\": {\n      \"min\": \"60\",\n      \"max\": \"90\"\n      },\n      \"unit\": \"seconds\",\n      \"is_completed\": \"0\",\n      \"created_at\": \"2016-01-22 04:37:32\",\n      \"updated_at\": \"2016-04-04 14:02:11\",\n      \"exercise\": {\n      \"id\": \"4\",\n      \"name\": \"Plank\",\n      \"description\": \"The plank builds your isometric strength and helps sculpt your waistline.\",\n      \"category\": \"1\",\n      \"type\": \"1\",\n      \"muscle_groups\": \"1,4,6,8\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"seconds\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \"1. Get into pushup position on the floor.\\r\\n2. Now bend your elbows 90 degrees and rest your weight on your forearms. \\r\\n3. Hold the position for as long as you can.   \",\n      \"video_tips\": \"        \",\n      \"pro_tips\": \"Drive your chest away from the ground and spread your shoulder blades as much as you can.\\r\\nKeep a straight line, from head to toe. \\r\\nDon't collapse your lower back or reach your butt to the sky. Add movement to your plank, rock back and forth on your forearms and toes or shift from side to side.\\r\\nTry advanced variations with alternating sinlge leg support. \\r\\nStart with an incline plank if a straight plank is too hard in the beginning.  \",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Shoulders, Back, Core, Full Body\",\n      \"video\": [\n      {\n      \"id\": \"4\",\n      \"path\": \"4_1453976855.mp4\",\n      \"videothumbnail\": \"4_1453976855.jpg\",\n      \"description\": \"Plank\"\n      }\n      ]\n      }\n      },\n      {\n      \"id\": \"15\",\n      \"row\": \"3\",\n      \"exercise_id\": \"36\",\n      \"duration\": {\n      \"min\": \"20\",\n      \"max\": \"\"\n      },\n      \"unit\": \"times\",\n      \"is_completed\": \"0\",\n      \"created_at\": \"2016-01-22 04:37:57\",\n      \"updated_at\": \"2016-04-04 11:12:49\",\n      \"exercise\": {\n      \"id\": \"36\",\n      \"name\": \"High Jumps\",\n      \"description\": \"Do high jumps as a part of restless HIIT workouts\",\n      \"category\": \"1\",\n      \"type\": \"2\",\n      \"muscle_groups\": \"7\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \"1. Start from a standing position\\r\\n2. Jump up and bring your knees to your chest\",\n      \"video_tips\": \"    \",\n      \"pro_tips\": \"Land softly and exhale when the knees are up.\\r\\n  \",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Legs\",\n      \"video\": [\n      {\n      \"id\": \"33\",\n      \"path\": \"36_1454042273.mp4\",\n      \"videothumbnail\": \"36_1454042273.jpg\",\n      \"description\": \"High Jumps\"\n      }\n      ]\n      }\n      }\n      ],\n      \"exercises\": [],\n      \"workout\": {\n      \"id\": \"21\",\n      \"name\": \"Vali\",\n      \"description\": \"A,B,E\",\n      \"rounds\": \"3\",\n      \"category\": \"1\",\n      \"type\": \"2\",\n      \"rewards\": \"330\",\n      \"duration\": \"1620.00\",\n      \"equipments\": \"Bar/Rings, Ladder/Post\",\n      \"is_completed\": 0,\n      \"exercises\": {\n      \"round1\": [\n      {\n      \"id\": \"838\",\n      \"workout_id\": \"21\",\n      \"category\": \"1\",\n      \"repititions\": \"7\",\n      \"exercise_id\": \"64\",\n      \"unit\": \"times\",\n      \"round\": \"1\",\n      \"created_at\": \"2016-01-19 23:14:44\",\n      \"updated_at\": \"2016-04-04 14:27:54\",\n      \"exercise\": {\n      \"id\": \"64\",\n      \"name\": \"Skin the cat\",\n      \"description\": \"Develop your joints mobility and expose yourself to new movement layers\",\n      \"category\": \"1\",\n      \"type\": \"2\",\n      \"muscle_groups\": \"4,5,6\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \" 1. Hands a little more than shoulder width apart\\r\\n2. Raise your knees to the chest\\r\\n3. continuing the movement until the feet pass up through the arms and over head into an inverted hang position.\\r\\n4. Continue to pass the feet round and down toward the ground into the extended 'skin the cat' position.\\r\\n5. Lift your hips and raise the legs back and over to the starting hang position. \",\n      \"video_tips\": \"        \",\n      \"pro_tips\": \" Put your hands closer together to ease up all back lever progressions.\\r\\nDo only half of the movement in the beginning, but fight for completion over time.\\r\\nIncorporate other static elements to challenge yourself during the movement as you master other skills.\\r\\n    \",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Back, Arms, Core\"\n      },\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"841\",\n      \"workout_id\": \"21\",\n      \"category\": \"1\",\n      \"repititions\": \"30\",\n      \"exercise_id\": \"49\",\n      \"unit\": \"times\",\n      \"round\": \"1\",\n      \"created_at\": \"2016-01-19 23:15:12\",\n      \"updated_at\": \"2016-04-04 14:19:29\",\n      \"exercise\": {\n      \"id\": \"49\",\n      \"name\": \"Side Triceps\",\n      \"description\": \"Start with the basics of building triceps strength\",\n      \"category\": \"1\",\n      \"type\": \"1\",\n      \"muscle_groups\": \"3\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \" 1. Start with the body on your side\\r\\n2. Put one hand on your shoulder \\r\\n3. Press up with the other arm and hold in extension \",\n      \"video_tips\": \"          \",\n      \"pro_tips\": \" Avoid supporting the movement with your core muscle.      \",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Triceps\"\n      },\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"844\",\n      \"workout_id\": \"21\",\n      \"category\": \"1\",\n      \"repititions\": \"15\",\n      \"exercise_id\": \"29\",\n      \"unit\": \"times\",\n      \"round\": \"1\",\n      \"created_at\": \"2016-01-19 23:15:35\",\n      \"updated_at\": \"2016-04-04 14:14:02\",\n      \"exercise\": {\n      \"id\": \"29\",\n      \"name\": \"Tucked DF\",\n      \"description\": \"Develop your core strength on the path to the hardest core exercise in history\",\n      \"category\": \"1\",\n      \"type\": \"2\",\n      \"muscle_groups\": \"6\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \" 1. Lie on a decline or flat bench and grab the edge of it behind your head with both hands. \\r\\n2. Tuck your knees to your chest.\\r\\n3. Slowly try to extend to bend legs and hold position as long as you can \\r\\n4. Repeat movement. \",\n      \"video_tips\": \"          \",\n      \"pro_tips\": \" Work it slowly and controlled.\\r\\nFocus to engage your core and lower back in all progressions. \",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Core\"\n      },\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"847\",\n      \"workout_id\": \"21\",\n      \"category\": \"1\",\n      \"repititions\": \"30\",\n      \"exercise_id\": \"72\",\n      \"unit\": \"times\",\n      \"round\": \"1\",\n      \"created_at\": \"2016-01-19 23:16:00\",\n      \"updated_at\": \"2016-04-04 14:34:27\",\n      \"exercise\": {\n      \"id\": \"73\",\n      \"name\": \"Tucked Human Flag\",\n      \"description\": \"Start securing your anchoring point and learn to fully lock out your support\",\n      \"category\": \"1\",\n      \"type\": \"2\",\n      \"muscle_groups\": \"1,5,6\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \" 1. Place your hands so that palms face each other.\\r\\n2. Lock lower arm out for stabilization. (Hands, elbows and shoulders are in line) \\r\\n3. Pull your body with your upper arm up and tuck your knees to chest. \",\n      \"video_tips\": \"          \",\n      \"pro_tips\": \" If you begin to fall out of position it's important to land on your feet and let go of the anchor point to protect the shoulders.\\r\\nStraighten your hip and align with body.\\r\\nGet somebody to assist you in the beginning to stay in position. \",\n      \"is_static\": \"1\",\n      \"musclegroup_string\": \"Shoulders, Arms, Core\"\n      },\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"850\",\n      \"workout_id\": \"21\",\n      \"category\": \"1\",\n      \"repititions\": \"10\",\n      \"exercise_id\": \"66\",\n      \"unit\": \"times\",\n      \"round\": \"1\",\n      \"created_at\": \"2016-01-19 23:16:27\",\n      \"updated_at\": \"2016-04-04 14:31:38\",\n      \"exercise\": {\n      \"id\": \"69\",\n      \"name\": \"Jumping Pullups\",\n      \"description\": \"Expose yourself to packed shoulders and hang time\",\n      \"category\": \"1\",\n      \"type\": \"1\",\n      \"muscle_groups\": \"1,5\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \" 1. Grip a bar and jump into the top position of the pull-up exercise\\r\\n2. Straight legs in front of you. \\r\\n3. Slowly go down into a deadhang position \",\n      \"video_tips\": \"        \",\n      \"pro_tips\": \" A deadhang postion requires your shoulder blades down and towards the spine with arms being straight (retraction)\\r\\nAim for three second holds at the top and go down slowly \",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Shoulders, Arms\"\n      },\n      \"is_completed\": 0\n      }\n      ],\n      \"round2\": [\n      {\n      \"id\": \"839\",\n      \"workout_id\": \"21\",\n      \"category\": \"1\",\n      \"repititions\": \"7\",\n      \"exercise_id\": \"64\",\n      \"unit\": \"times\",\n      \"round\": \"2\",\n      \"created_at\": \"2016-01-19 23:14:44\",\n      \"updated_at\": \"2016-04-04 14:27:54\",\n      \"exercise\": {\n      \"id\": \"64\",\n      \"name\": \"Skin the cat\",\n      \"description\": \"Develop your joints mobility and expose yourself to new movement layers\",\n      \"category\": \"1\",\n      \"type\": \"2\",\n      \"muscle_groups\": \"4,5,6\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \" 1. Hands a little more than shoulder width apart\\r\\n2. Raise your knees to the chest\\r\\n3. continuing the movement until the feet pass up through the arms and over head into an inverted hang position.\\r\\n4. Continue to pass the feet round and down toward the ground into the extended 'skin the cat' position.\\r\\n5. Lift your hips and raise the legs back and over to the starting hang position. \",\n      \"video_tips\": \"        \",\n      \"pro_tips\": \" Put your hands closer together to ease up all back lever progressions.\\r\\nDo only half of the movement in the beginning, but fight for completion over time.\\r\\nIncorporate other static elements to challenge yourself during the movement as you master other skills.\\r\\n    \",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Back, Arms, Core\"\n      },\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"842\",\n      \"workout_id\": \"21\",\n      \"category\": \"1\",\n      \"repititions\": \"30\",\n      \"exercise_id\": \"49\",\n      \"unit\": \"times\",\n      \"round\": \"2\",\n      \"created_at\": \"2016-01-19 23:15:12\",\n      \"updated_at\": \"2016-04-04 14:19:29\",\n      \"exercise\": {\n      \"id\": \"49\",\n      \"name\": \"Side Triceps\",\n      \"description\": \"Start with the basics of building triceps strength\",\n      \"category\": \"1\",\n      \"type\": \"1\",\n      \"muscle_groups\": \"3\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \" 1. Start with the body on your side\\r\\n2. Put one hand on your shoulder \\r\\n3. Press up with the other arm and hold in extension \",\n      \"video_tips\": \"          \",\n      \"pro_tips\": \" Avoid supporting the movement with your core muscle.      \",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Triceps\"\n      },\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"845\",\n      \"workout_id\": \"21\",\n      \"category\": \"1\",\n      \"repititions\": \"15\",\n      \"exercise_id\": \"29\",\n      \"unit\": \"times\",\n      \"round\": \"2\",\n      \"created_at\": \"2016-01-19 23:15:35\",\n      \"updated_at\": \"2016-04-04 14:14:02\",\n      \"exercise\": {\n      \"id\": \"29\",\n      \"name\": \"Tucked DF\",\n      \"description\": \"Develop your core strength on the path to the hardest core exercise in history\",\n      \"category\": \"1\",\n      \"type\": \"2\",\n      \"muscle_groups\": \"6\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \" 1. Lie on a decline or flat bench and grab the edge of it behind your head with both hands. \\r\\n2. Tuck your knees to your chest.\\r\\n3. Slowly try to extend to bend legs and hold position as long as you can \\r\\n4. Repeat movement. \",\n      \"video_tips\": \"          \",\n      \"pro_tips\": \" Work it slowly and controlled.\\r\\nFocus to engage your core and lower back in all progressions. \",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Core\"\n      },\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"848\",\n      \"workout_id\": \"21\",\n      \"category\": \"1\",\n      \"repititions\": \"30\",\n      \"exercise_id\": \"72\",\n      \"unit\": \"times\",\n      \"round\": \"2\",\n      \"created_at\": \"2016-01-19 23:16:00\",\n      \"updated_at\": \"2016-04-04 14:34:27\",\n      \"exercise\": {\n      \"id\": \"73\",\n      \"name\": \"Tucked Human Flag\",\n      \"description\": \"Start securing your anchoring point and learn to fully lock out your support\",\n      \"category\": \"1\",\n      \"type\": \"2\",\n      \"muscle_groups\": \"1,5,6\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \" 1. Place your hands so that palms face each other.\\r\\n2. Lock lower arm out for stabilization. (Hands, elbows and shoulders are in line) \\r\\n3. Pull your body with your upper arm up and tuck your knees to chest. \",\n      \"video_tips\": \"          \",\n      \"pro_tips\": \" If you begin to fall out of position it's important to land on your feet and let go of the anchor point to protect the shoulders.\\r\\nStraighten your hip and align with body.\\r\\nGet somebody to assist you in the beginning to stay in position. \",\n      \"is_static\": \"1\",\n      \"musclegroup_string\": \"Shoulders, Arms, Core\"\n      },\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"852\",\n      \"workout_id\": \"21\",\n      \"category\": \"1\",\n      \"repititions\": \"10\",\n      \"exercise_id\": \"66\",\n      \"unit\": \"times\",\n      \"round\": \"2\",\n      \"created_at\": \"2016-01-19 23:16:28\",\n      \"updated_at\": \"2016-04-04 14:31:38\",\n      \"exercise\": {\n      \"id\": \"69\",\n      \"name\": \"Jumping Pullups\",\n      \"description\": \"Expose yourself to packed shoulders and hang time\",\n      \"category\": \"1\",\n      \"type\": \"1\",\n      \"muscle_groups\": \"1,5\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \" 1. Grip a bar and jump into the top position of the pull-up exercise\\r\\n2. Straight legs in front of you. \\r\\n3. Slowly go down into a deadhang position \",\n      \"video_tips\": \"        \",\n      \"pro_tips\": \" A deadhang postion requires your shoulder blades down and towards the spine with arms being straight (retraction)\\r\\nAim for three second holds at the top and go down slowly \",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Shoulders, Arms\"\n      },\n      \"is_completed\": 0\n      }\n      ],\n      \"round3\": [\n      {\n      \"id\": \"840\",\n      \"workout_id\": \"21\",\n      \"category\": \"1\",\n      \"repititions\": \"7\",\n      \"exercise_id\": \"64\",\n      \"unit\": \"times\",\n      \"round\": \"3\",\n      \"created_at\": \"2016-01-19 23:14:44\",\n      \"updated_at\": \"2016-04-04 14:27:54\",\n      \"exercise\": {\n      \"id\": \"64\",\n      \"name\": \"Skin the cat\",\n      \"description\": \"Develop your joints mobility and expose yourself to new movement layers\",\n      \"category\": \"1\",\n      \"type\": \"2\",\n      \"muscle_groups\": \"4,5,6\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \" 1. Hands a little more than shoulder width apart\\r\\n2. Raise your knees to the chest\\r\\n3. continuing the movement until the feet pass up through the arms and over head into an inverted hang position.\\r\\n4. Continue to pass the feet round and down toward the ground into the extended 'skin the cat' position.\\r\\n5. Lift your hips and raise the legs back and over to the starting hang position. \",\n      \"video_tips\": \"        \",\n      \"pro_tips\": \" Put your hands closer together to ease up all back lever progressions.\\r\\nDo only half of the movement in the beginning, but fight for completion over time.\\r\\nIncorporate other static elements to challenge yourself during the movement as you master other skills.\\r\\n    \",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Back, Arms, Core\"\n      },\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"843\",\n      \"workout_id\": \"21\",\n      \"category\": \"1\",\n      \"repititions\": \"30\",\n      \"exercise_id\": \"49\",\n      \"unit\": \"times\",\n      \"round\": \"3\",\n      \"created_at\": \"2016-01-19 23:15:12\",\n      \"updated_at\": \"2016-04-04 14:19:29\",\n      \"exercise\": {\n      \"id\": \"49\",\n      \"name\": \"Side Triceps\",\n      \"description\": \"Start with the basics of building triceps strength\",\n      \"category\": \"1\",\n      \"type\": \"1\",\n      \"muscle_groups\": \"3\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \" 1. Start with the body on your side\\r\\n2. Put one hand on your shoulder \\r\\n3. Press up with the other arm and hold in extension \",\n      \"video_tips\": \"          \",\n      \"pro_tips\": \" Avoid supporting the movement with your core muscle.      \",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Triceps\"\n      },\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"846\",\n      \"workout_id\": \"21\",\n      \"category\": \"1\",\n      \"repititions\": \"15\",\n      \"exercise_id\": \"29\",\n      \"unit\": \"times\",\n      \"round\": \"3\",\n      \"created_at\": \"2016-01-19 23:15:35\",\n      \"updated_at\": \"2016-04-04 14:14:02\",\n      \"exercise\": {\n      \"id\": \"29\",\n      \"name\": \"Tucked DF\",\n      \"description\": \"Develop your core strength on the path to the hardest core exercise in history\",\n      \"category\": \"1\",\n      \"type\": \"2\",\n      \"muscle_groups\": \"6\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \" 1. Lie on a decline or flat bench and grab the edge of it behind your head with both hands. \\r\\n2. Tuck your knees to your chest.\\r\\n3. Slowly try to extend to bend legs and hold position as long as you can \\r\\n4. Repeat movement. \",\n      \"video_tips\": \"          \",\n      \"pro_tips\": \" Work it slowly and controlled.\\r\\nFocus to engage your core and lower back in all progressions. \",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Core\"\n      },\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"849\",\n      \"workout_id\": \"21\",\n      \"category\": \"1\",\n      \"repititions\": \"30\",\n      \"exercise_id\": \"72\",\n      \"unit\": \"times\",\n      \"round\": \"3\",\n      \"created_at\": \"2016-01-19 23:16:00\",\n      \"updated_at\": \"2016-04-04 14:34:27\",\n      \"exercise\": {\n      \"id\": \"73\",\n      \"name\": \"Tucked Human Flag\",\n      \"description\": \"Start securing your anchoring point and learn to fully lock out your support\",\n      \"category\": \"1\",\n      \"type\": \"2\",\n      \"muscle_groups\": \"1,5,6\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \" 1. Place your hands so that palms face each other.\\r\\n2. Lock lower arm out for stabilization. (Hands, elbows and shoulders are in line) \\r\\n3. Pull your body with your upper arm up and tuck your knees to chest. \",\n      \"video_tips\": \"          \",\n      \"pro_tips\": \" If you begin to fall out of position it's important to land on your feet and let go of the anchor point to protect the shoulders.\\r\\nStraighten your hip and align with body.\\r\\nGet somebody to assist you in the beginning to stay in position. \",\n      \"is_static\": \"1\",\n      \"musclegroup_string\": \"Shoulders, Arms, Core\"\n      },\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"854\",\n      \"workout_id\": \"21\",\n      \"category\": \"1\",\n      \"repititions\": \"10\",\n      \"exercise_id\": \"66\",\n      \"unit\": \"times\",\n      \"round\": \"3\",\n      \"created_at\": \"2016-01-19 23:16:28\",\n      \"updated_at\": \"2016-04-04 14:31:38\",\n      \"exercise\": {\n      \"id\": \"69\",\n      \"name\": \"Jumping Pullups\",\n      \"description\": \"Expose yourself to packed shoulders and hang time\",\n      \"category\": \"1\",\n      \"type\": \"1\",\n      \"muscle_groups\": \"1,5\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \" 1. Grip a bar and jump into the top position of the pull-up exercise\\r\\n2. Straight legs in front of you. \\r\\n3. Slowly go down into a deadhang position \",\n      \"video_tips\": \"        \",\n      \"pro_tips\": \" A deadhang postion requires your shoulder blades down and towards the spine with arms being straight (retraction)\\r\\nAim for three second holds at the top and go down slowly \",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Shoulders, Arms\"\n      },\n      \"is_completed\": 0\n      }\n      ]\n      },\n      \"exercise_category\": 1\n      },\n      \"coach_workout_rounds\": 3,\n      \"workout_intensity\": 1,\n      \"hiit\": [],\n      \"stretching\": [\n      {\n      \"id\": \"1\",\n      \"exercise_id\": \"Superman\",\n      \"duration\": {\n      \"min\": 6,\n      \"max\": 13\n      },\n      \"unit\": \"times\",\n      \"is_completed\": \"0\",\n      \"created_at\": \"2016-01-22 07:10:31\",\n      \"updated_at\": \"2016-01-22 07:10:31\"\n      },\n      {\n      \"id\": \"2\",\n      \"exercise_id\": \"Lower Back Strength\",\n      \"duration\": {\n      \"min\": 38,\n      \"max\": 63\n      },\n      \"unit\": \"times\",\n      \"is_completed\": \"0\",\n      \"created_at\": \"2016-01-22 07:15:02\",\n      \"updated_at\": \"2016-01-22 07:15:02\"\n      },\n      {\n      \"id\": \"3\",\n      \"exercise_id\": \"Upper Dog\",\n      \"duration\": {\n      \"min\": 38,\n      \"max\": 75\n      },\n      \"unit\": \"seconds\",\n      \"is_completed\": \"0\",\n      \"created_at\": \"2016-01-22 07:16:03\",\n      \"updated_at\": \"2016-01-22 07:16:03\"\n      },\n      {\n      \"id\": \"4\",\n      \"exercise_id\": \"Child's Pose\",\n      \"duration\": {\n      \"min\": 38,\n      \"max\": 75\n      },\n      \"unit\": \"seconds\",\n      \"is_completed\": \"0\",\n      \"created_at\": \"2016-01-22 07:16:46\",\n      \"updated_at\": \"2016-01-22 07:16:46\"\n      },\n      {\n      \"id\": \"5\",\n      \"exercise_id\": \"L-sit on the floor\",\n      \"duration\": {\n      \"min\": 38,\n      \"max\": 75\n      },\n      \"unit\": \"seconds\",\n      \"is_completed\": \"0\",\n      \"created_at\": \"2016-01-22 07:17:13\",\n      \"updated_at\": \"2016-01-22 07:17:13\"\n      },\n      {\n      \"id\": \"6\",\n      \"exercise_id\": \"Good morning\",\n      \"duration\": {\n      \"min\": 38,\n      \"max\": 75\n      },\n      \"unit\": \"seconds\",\n      \"is_completed\": \"0\",\n      \"created_at\": \"2016-01-22 07:17:43\",\n      \"updated_at\": \"2016-01-22 07:17:43\"\n      },\n      {\n      \"id\": \"7\",\n      \"exercise_id\": \"Chest Opener\",\n      \"duration\": {\n      \"min\": 38,\n      \"max\": 75\n      },\n      \"unit\": \"seconds\",\n      \"is_completed\": \"0\",\n      \"created_at\": \"2016-01-22 07:19:32\",\n      \"updated_at\": \"2016-01-22 07:19:32\"\n      },\n      {\n      \"id\": \"8\",\n      \"exercise_id\": \"Triceps Stretc\",\n      \"duration\": {\n      \"min\": 38,\n      \"max\": 75\n      },\n      \"unit\": \"seconds\",\n      \"is_completed\": \"0\",\n      \"created_at\": \"2016-01-22 07:19:56\",\n      \"updated_at\": \"2016-01-22 07:19:56\"\n      },\n      {\n      \"id\": \"9\",\n      \"exercise_id\": \"Hands Back\",\n      \"duration\": {\n      \"min\": 38,\n      \"max\": 75\n      },\n      \"unit\": \"seconds\",\n      \"is_completed\": \"0\",\n      \"created_at\": \"2016-01-22 07:20:19\",\n      \"updated_at\": \"2016-01-22 07:20:19\"\n      },\n      {\n      \"id\": \"10\",\n      \"exercise_id\": \"Shoulder Stretch\",\n      \"duration\": {\n      \"min\": 38,\n      \"max\": 75\n      },\n      \"unit\": \"seconds\",\n      \"is_completed\": \"0\",\n      \"created_at\": \"2016-01-22 07:20:45\",\n      \"updated_at\": \"2016-01-22 07:20:45\"\n      }\n      ],\n      \"status\": \"pending\"\n      },\n      \"day6\": {\n      \"warmup\": [\n      {\n      \"id\": \"1\",\n      \"name\": \"wall extensions\",\n      \"duration\": {\n      \"min\": \"10\",\n      \"max\": \"20\"\n      },\n      \"unit\": \"times\",\n      \"created_at\": \"2016-01-21 08:55:06\",\n      \"updated_at\": \"2016-01-21 08:55:06\",\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"2\",\n      \"name\": \"band dislocates\",\n      \"duration\": {\n      \"min\": \"10\",\n      \"max\": \"20\"\n      },\n      \"unit\": \"times\",\n      \"created_at\": \"2016-01-21 08:57:38\",\n      \"updated_at\": \"2016-01-21 08:57:38\",\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"3\",\n      \"name\": \"cat-camels\",\n      \"duration\": {\n      \"min\": \"10\",\n      \"max\": \"20\"\n      },\n      \"unit\": \"times\",\n      \"created_at\": \"2016-01-21 09:00:39\",\n      \"updated_at\": \"2016-01-21 09:00:39\",\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"4\",\n      \"name\": \"scapular shrugs\",\n      \"duration\": {\n      \"min\": \"10\",\n      \"max\": \"20\"\n      },\n      \"unit\": \"times\",\n      \"created_at\": \"2016-01-21 09:01:01\",\n      \"updated_at\": \"2016-01-21 09:01:01\",\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"5\",\n      \"name\": \"full body circles\",\n      \"duration\": {\n      \"min\": \"10\",\n      \"max\": \"20\"\n      },\n      \"unit\": \"times\",\n      \"created_at\": \"2016-01-21 09:01:26\",\n      \"updated_at\": \"2016-01-21 09:01:26\",\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"6\",\n      \"name\": \"Jumping Jacks\",\n      \"duration\": {\n      \"min\": \"100\",\n      \"max\": \"\"\n      },\n      \"unit\": \"seconds\",\n      \"created_at\": \"2016-01-21 09:04:52\",\n      \"updated_at\": \"2016-01-21 09:04:52\",\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"7\",\n      \"name\": \"Arm rotations\",\n      \"duration\": {\n      \"min\": \"120\",\n      \"max\": \"\"\n      },\n      \"unit\": \"times\",\n      \"created_at\": \"2016-01-21 09:05:29\",\n      \"updated_at\": \"2016-01-21 09:05:29\",\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"8\",\n      \"name\": \"High Knees\",\n      \"duration\": {\n      \"min\": \"50\",\n      \"max\": \"\"\n      },\n      \"unit\": \"times\",\n      \"created_at\": \"2016-01-21 09:06:02\",\n      \"updated_at\": \"2016-01-21 09:06:02\",\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"9\",\n      \"name\": \"Shouder rolls\",\n      \"duration\": {\n      \"min\": \"20\",\n      \"max\": \"\"\n      },\n      \"unit\": \"times\",\n      \"created_at\": \"2016-01-21 09:06:34\",\n      \"updated_at\": \"2016-01-21 09:06:34\",\n      \"is_completed\": 0\n      }\n      ],\n      \"is_completed\": 0,\n      \"fundumentals\": [\n      {\n      \"id\": \"11\",\n      \"row\": \"3\",\n      \"exercise_id\": \"64\",\n      \"duration\": {\n      \"min\": \"10\",\n      \"max\": \"\"\n      },\n      \"unit\": \"times\",\n      \"is_completed\": \"0\",\n      \"created_at\": \"2016-01-22 04:35:13\",\n      \"updated_at\": \"2016-04-04 14:27:54\",\n      \"exercise\": {\n      \"id\": \"64\",\n      \"name\": \"Skin the cat\",\n      \"description\": \"Develop your joints mobility and expose yourself to new movement layers\",\n      \"category\": \"1\",\n      \"type\": \"2\",\n      \"muscle_groups\": \"4,5,6\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \" 1. Hands a little more than shoulder width apart\\r\\n2. Raise your knees to the chest\\r\\n3. continuing the movement until the feet pass up through the arms and over head into an inverted hang position.\\r\\n4. Continue to pass the feet round and down toward the ground into the extended 'skin the cat' position.\\r\\n5. Lift your hips and raise the legs back and over to the starting hang position. \",\n      \"video_tips\": \"        \",\n      \"pro_tips\": \" Put your hands closer together to ease up all back lever progressions.\\r\\nDo only half of the movement in the beginning, but fight for completion over time.\\r\\nIncorporate other static elements to challenge yourself during the movement as you master other skills.\\r\\n    \",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Back, Arms, Core\",\n      \"video\": [\n      {\n      \"id\": \"71\",\n      \"path\": \"64_1454045043.mp4\",\n      \"videothumbnail\": \"64_1454045043.jpg\",\n      \"description\": \"Skin the cat\"\n      }\n      ]\n      }\n      },\n      {\n      \"id\": \"12\",\n      \"row\": \"3\",\n      \"exercise_id\": \"12\",\n      \"duration\": {\n      \"min\": \"20\",\n      \"max\": \"\"\n      },\n      \"unit\": \"times\",\n      \"is_completed\": \"0\",\n      \"created_at\": \"2016-01-22 04:36:16\",\n      \"updated_at\": \"2016-04-04 09:26:06\",\n      \"exercise\": {\n      \"id\": \"12\",\n      \"name\": \"Pushups\",\n      \"description\": \"Perform the most popular exercise of all time with real strength\",\n      \"category\": \"2\",\n      \"type\": \"1\",\n      \"muscle_groups\": \"1,2,3\",\n      \"rewards\": \"7.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \" 1. Lie on the floor face down and place your hands in a standard pushup position.\\r\\n 2. Next, lower yourself downward until your chest almost touches the floor as you inhale.\\r\\n 3. Exhale and press your upper body back up to the starting position while squeezing your chest.\\r\\n 4. Repeat, after a brief pause at the top contracted position.\\r\\n\",\n      \"video_tips\": \"      \",\n      \"pro_tips\": \"Do them extra slow and hold it in highest and lowest position to get strength.\\r\\nOne of the most common push-up mistakes is flaring out the elbows out instead of keeping them at your sides.\\r\\nIf too easy, try Spiderman and Diamond Pushups or wear a weigthed vest.\",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Shoulders, Chest, Triceps\",\n      \"video\": [\n      {\n      \"id\": \"57\",\n      \"path\": \"12_1453984139.mp4\",\n      \"videothumbnail\": \"12_1453984139.jpg\",\n      \"description\": \"Pushups\"\n      }\n      ]\n      }\n      },\n      {\n      \"id\": \"13\",\n      \"row\": \"3\",\n      \"exercise_id\": \"49\",\n      \"duration\": {\n      \"min\": \"30\",\n      \"max\": \"\"\n      },\n      \"unit\": \"times\",\n      \"is_completed\": \"0\",\n      \"created_at\": \"2016-01-22 04:36:49\",\n      \"updated_at\": \"2016-04-04 14:19:29\",\n      \"exercise\": {\n      \"id\": \"49\",\n      \"name\": \"Side Triceps\",\n      \"description\": \"Start with the basics of building triceps strength\",\n      \"category\": \"1\",\n      \"type\": \"1\",\n      \"muscle_groups\": \"3\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \" 1. Start with the body on your side\\r\\n2. Put one hand on your shoulder \\r\\n3. Press up with the other arm and hold in extension \",\n      \"video_tips\": \"          \",\n      \"pro_tips\": \" Avoid supporting the movement with your core muscle.      \",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Triceps\",\n      \"video\": [\n      {\n      \"id\": \"43\",\n      \"path\": \"49_1454043404.mp4\",\n      \"videothumbnail\": \"49_1454043404.jpg\",\n      \"description\": \"Side Triceps\"\n      }\n      ]\n      }\n      },\n      {\n      \"id\": \"14\",\n      \"row\": \"3\",\n      \"exercise_id\": \"4\",\n      \"duration\": {\n      \"min\": \"60\",\n      \"max\": \"90\"\n      },\n      \"unit\": \"seconds\",\n      \"is_completed\": \"0\",\n      \"created_at\": \"2016-01-22 04:37:32\",\n      \"updated_at\": \"2016-04-04 14:02:11\",\n      \"exercise\": {\n      \"id\": \"4\",\n      \"name\": \"Plank\",\n      \"description\": \"The plank builds your isometric strength and helps sculpt your waistline.\",\n      \"category\": \"1\",\n      \"type\": \"1\",\n      \"muscle_groups\": \"1,4,6,8\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"seconds\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \"1. Get into pushup position on the floor.\\r\\n2. Now bend your elbows 90 degrees and rest your weight on your forearms. \\r\\n3. Hold the position for as long as you can.   \",\n      \"video_tips\": \"        \",\n      \"pro_tips\": \"Drive your chest away from the ground and spread your shoulder blades as much as you can.\\r\\nKeep a straight line, from head to toe. \\r\\nDon't collapse your lower back or reach your butt to the sky. Add movement to your plank, rock back and forth on your forearms and toes or shift from side to side.\\r\\nTry advanced variations with alternating sinlge leg support. \\r\\nStart with an incline plank if a straight plank is too hard in the beginning.  \",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Shoulders, Back, Core, Full Body\",\n      \"video\": [\n      {\n      \"id\": \"4\",\n      \"path\": \"4_1453976855.mp4\",\n      \"videothumbnail\": \"4_1453976855.jpg\",\n      \"description\": \"Plank\"\n      }\n      ]\n      }\n      },\n      {\n      \"id\": \"15\",\n      \"row\": \"3\",\n      \"exercise_id\": \"36\",\n      \"duration\": {\n      \"min\": \"20\",\n      \"max\": \"\"\n      },\n      \"unit\": \"times\",\n      \"is_completed\": \"0\",\n      \"created_at\": \"2016-01-22 04:37:57\",\n      \"updated_at\": \"2016-04-04 11:12:49\",\n      \"exercise\": {\n      \"id\": \"36\",\n      \"name\": \"High Jumps\",\n      \"description\": \"Do high jumps as a part of restless HIIT workouts\",\n      \"category\": \"1\",\n      \"type\": \"2\",\n      \"muscle_groups\": \"7\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \"1. Start from a standing position\\r\\n2. Jump up and bring your knees to your chest\",\n      \"video_tips\": \"    \",\n      \"pro_tips\": \"Land softly and exhale when the knees are up.\\r\\n  \",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Legs\",\n      \"video\": [\n      {\n      \"id\": \"33\",\n      \"path\": \"36_1454042273.mp4\",\n      \"videothumbnail\": \"36_1454042273.jpg\",\n      \"description\": \"High Jumps\"\n      }\n      ]\n      }\n      }\n      ],\n      \"exercises\": [],\n      \"workout\": {\n      \"id\": \"10\",\n      \"name\": \"Loki\",\n      \"description\": \"A,E,B\",\n      \"rounds\": \"1\",\n      \"category\": \"1\",\n      \"type\": \"1\",\n      \"rewards\": \"330\",\n      \"duration\": \"1440.00\",\n      \"equipments\": \"Bar/Rings\",\n      \"is_completed\": 0,\n      \"exercises\": {\n      \"round1\": [\n      {\n      \"id\": \"364\",\n      \"workout_id\": \"10\",\n      \"category\": \"1\",\n      \"repititions\": \"15\",\n      \"exercise_id\": \"66\",\n      \"unit\": \"times\",\n      \"round\": \"1\",\n      \"created_at\": \"2016-01-19 05:35:04\",\n      \"updated_at\": \"2016-04-04 14:31:38\",\n      \"exercise\": {\n      \"id\": \"69\",\n      \"name\": \"Jumping Pullups\",\n      \"description\": \"Expose yourself to packed shoulders and hang time\",\n      \"category\": \"1\",\n      \"type\": \"1\",\n      \"muscle_groups\": \"1,5\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \" 1. Grip a bar and jump into the top position of the pull-up exercise\\r\\n2. Straight legs in front of you. \\r\\n3. Slowly go down into a deadhang position \",\n      \"video_tips\": \"        \",\n      \"pro_tips\": \" A deadhang postion requires your shoulder blades down and towards the spine with arms being straight (retraction)\\r\\nAim for three second holds at the top and go down slowly \",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Shoulders, Arms\"\n      },\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"365\",\n      \"workout_id\": \"10\",\n      \"category\": \"1\",\n      \"repititions\": \"120\",\n      \"exercise_id\": \"4\",\n      \"unit\": \"seconds\",\n      \"round\": \"1\",\n      \"created_at\": \"2016-01-19 05:35:24\",\n      \"updated_at\": \"2016-04-04 14:02:11\",\n      \"exercise\": {\n      \"id\": \"4\",\n      \"name\": \"Plank\",\n      \"description\": \"The plank builds your isometric strength and helps sculpt your waistline.\",\n      \"category\": \"1\",\n      \"type\": \"1\",\n      \"muscle_groups\": \"1,4,6,8\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"seconds\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \"1. Get into pushup position on the floor.\\r\\n2. Now bend your elbows 90 degrees and rest your weight on your forearms. \\r\\n3. Hold the position for as long as you can.   \",\n      \"video_tips\": \"        \",\n      \"pro_tips\": \"Drive your chest away from the ground and spread your shoulder blades as much as you can.\\r\\nKeep a straight line, from head to toe. \\r\\nDon't collapse your lower back or reach your butt to the sky. Add movement to your plank, rock back and forth on your forearms and toes or shift from side to side.\\r\\nTry advanced variations with alternating sinlge leg support. \\r\\nStart with an incline plank if a straight plank is too hard in the beginning.  \",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Shoulders, Back, Core, Full Body\"\n      },\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"366\",\n      \"workout_id\": \"10\",\n      \"category\": \"1\",\n      \"repititions\": \"50\",\n      \"exercise_id\": \"49\",\n      \"unit\": \"times\",\n      \"round\": \"1\",\n      \"created_at\": \"2016-01-19 05:35:49\",\n      \"updated_at\": \"2016-04-04 14:19:29\",\n      \"exercise\": {\n      \"id\": \"49\",\n      \"name\": \"Side Triceps\",\n      \"description\": \"Start with the basics of building triceps strength\",\n      \"category\": \"1\",\n      \"type\": \"1\",\n      \"muscle_groups\": \"3\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \" 1. Start with the body on your side\\r\\n2. Put one hand on your shoulder \\r\\n3. Press up with the other arm and hold in extension \",\n      \"video_tips\": \"          \",\n      \"pro_tips\": \" Avoid supporting the movement with your core muscle.      \",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Triceps\"\n      },\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"367\",\n      \"workout_id\": \"10\",\n      \"category\": \"1\",\n      \"repititions\": \"25\",\n      \"exercise_id\": \"29\",\n      \"unit\": \"times\",\n      \"round\": \"1\",\n      \"created_at\": \"2016-01-19 05:36:05\",\n      \"updated_at\": \"2016-04-04 14:14:02\",\n      \"exercise\": {\n      \"id\": \"29\",\n      \"name\": \"Tucked DF\",\n      \"description\": \"Develop your core strength on the path to the hardest core exercise in history\",\n      \"category\": \"1\",\n      \"type\": \"2\",\n      \"muscle_groups\": \"6\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \" 1. Lie on a decline or flat bench and grab the edge of it behind your head with both hands. \\r\\n2. Tuck your knees to your chest.\\r\\n3. Slowly try to extend to bend legs and hold position as long as you can \\r\\n4. Repeat movement. \",\n      \"video_tips\": \"          \",\n      \"pro_tips\": \" Work it slowly and controlled.\\r\\nFocus to engage your core and lower back in all progressions. \",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Core\"\n      },\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"368\",\n      \"workout_id\": \"10\",\n      \"category\": \"1\",\n      \"repititions\": \"50\",\n      \"exercise_id\": \"9\",\n      \"unit\": \"times\",\n      \"round\": \"1\",\n      \"created_at\": \"2016-01-19 05:36:21\",\n      \"updated_at\": \"2016-04-04 09:22:17\",\n      \"exercise\": {\n      \"id\": \"9\",\n      \"name\": \"Crunches\",\n      \"description\": \"Do the most admired sixpack exercise in the world\",\n      \"category\": \"1\",\n      \"type\": \"1\",\n      \"muscle_groups\": \"6\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \"1. Starting position is with lying face up on the floor with knees bent. \\r\\n2. Move torso up and touch your knees with your hands\\r\\n3. Lower body to the floor and repeat\\r\\n  \",\n      \"video_tips\": \"    \",\n      \"pro_tips\": \"Do variations in tempo. Aim for one count up and three counts down.\\r\\nIf you have a tendency to interlace your fingers and yank your head, place your hands cross-chest.\",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Core\"\n      },\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"369\",\n      \"workout_id\": \"10\",\n      \"category\": \"1\",\n      \"repititions\": \"25\",\n      \"exercise_id\": \"29\",\n      \"unit\": \"times\",\n      \"round\": \"1\",\n      \"created_at\": \"2016-01-19 05:36:44\",\n      \"updated_at\": \"2016-04-04 14:14:02\",\n      \"exercise\": {\n      \"id\": \"29\",\n      \"name\": \"Tucked DF\",\n      \"description\": \"Develop your core strength on the path to the hardest core exercise in history\",\n      \"category\": \"1\",\n      \"type\": \"2\",\n      \"muscle_groups\": \"6\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \" 1. Lie on a decline or flat bench and grab the edge of it behind your head with both hands. \\r\\n2. Tuck your knees to your chest.\\r\\n3. Slowly try to extend to bend legs and hold position as long as you can \\r\\n4. Repeat movement. \",\n      \"video_tips\": \"          \",\n      \"pro_tips\": \" Work it slowly and controlled.\\r\\nFocus to engage your core and lower back in all progressions. \",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Core\"\n      },\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"370\",\n      \"workout_id\": \"10\",\n      \"category\": \"1\",\n      \"repititions\": \"50\",\n      \"exercise_id\": \"49\",\n      \"unit\": \"times\",\n      \"round\": \"1\",\n      \"created_at\": \"2016-01-19 05:37:38\",\n      \"updated_at\": \"2016-04-04 14:19:29\",\n      \"exercise\": {\n      \"id\": \"49\",\n      \"name\": \"Side Triceps\",\n      \"description\": \"Start with the basics of building triceps strength\",\n      \"category\": \"1\",\n      \"type\": \"1\",\n      \"muscle_groups\": \"3\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \" 1. Start with the body on your side\\r\\n2. Put one hand on your shoulder \\r\\n3. Press up with the other arm and hold in extension \",\n      \"video_tips\": \"          \",\n      \"pro_tips\": \" Avoid supporting the movement with your core muscle.      \",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Triceps\"\n      },\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"371\",\n      \"workout_id\": \"10\",\n      \"category\": \"1\",\n      \"repititions\": \"120\",\n      \"exercise_id\": \"4\",\n      \"unit\": \"seconds\",\n      \"round\": \"1\",\n      \"created_at\": \"2016-01-19 05:37:58\",\n      \"updated_at\": \"2016-04-04 14:02:11\",\n      \"exercise\": {\n      \"id\": \"4\",\n      \"name\": \"Plank\",\n      \"description\": \"The plank builds your isometric strength and helps sculpt your waistline.\",\n      \"category\": \"1\",\n      \"type\": \"1\",\n      \"muscle_groups\": \"1,4,6,8\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"seconds\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \"1. Get into pushup position on the floor.\\r\\n2. Now bend your elbows 90 degrees and rest your weight on your forearms. \\r\\n3. Hold the position for as long as you can.   \",\n      \"video_tips\": \"        \",\n      \"pro_tips\": \"Drive your chest away from the ground and spread your shoulder blades as much as you can.\\r\\nKeep a straight line, from head to toe. \\r\\nDon't collapse your lower back or reach your butt to the sky. Add movement to your plank, rock back and forth on your forearms and toes or shift from side to side.\\r\\nTry advanced variations with alternating sinlge leg support. \\r\\nStart with an incline plank if a straight plank is too hard in the beginning.  \",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Shoulders, Back, Core, Full Body\"\n      },\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"372\",\n      \"workout_id\": \"10\",\n      \"category\": \"1\",\n      \"repititions\": \"15\",\n      \"exercise_id\": \"66\",\n      \"unit\": \"times\",\n      \"round\": \"1\",\n      \"created_at\": \"2016-01-19 05:38:13\",\n      \"updated_at\": \"2016-04-04 14:31:38\",\n      \"exercise\": {\n      \"id\": \"69\",\n      \"name\": \"Jumping Pullups\",\n      \"description\": \"Expose yourself to packed shoulders and hang time\",\n      \"category\": \"1\",\n      \"type\": \"1\",\n      \"muscle_groups\": \"1,5\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \" 1. Grip a bar and jump into the top position of the pull-up exercise\\r\\n2. Straight legs in front of you. \\r\\n3. Slowly go down into a deadhang position \",\n      \"video_tips\": \"        \",\n      \"pro_tips\": \" A deadhang postion requires your shoulder blades down and towards the spine with arms being straight (retraction)\\r\\nAim for three second holds at the top and go down slowly \",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Shoulders, Arms\"\n      },\n      \"is_completed\": 0\n      }\n      ]\n      },\n      \"exercise_category\": 1\n      },\n      \"coach_workout_rounds\": 1,\n      \"workout_intensity\": 1,\n      \"hiit\": [\n      {\n      \"id\": 2,\n      \"intensity\": 4,\n      \"is_completed\": 0,\n      \"replacement\": [\n      {\n      \"round1\": [\n      {\n      \"name\": \"Burpee\",\n      \"duration\": 10,\n      \"unit\": \"times\",\n      \"exercise\": {\n      \"id\": \"31\",\n      \"name\": \"Burpee\",\n      \"description\": \"Test your fitness with the original burpee\",\n      \"category\": \"2\",\n      \"type\": \"1\",\n      \"muscle_groups\": \"8\",\n      \"rewards\": \"7.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \"1. Start in a standing position\\r\\n2. Go down and bring your body down to the floor\\r\\n3. Jump back up with your hands behind your head\",\n      \"video_tips\": \"    \",\n      \"pro_tips\": \"Avoid a hollow back during the movement. \\r\\nKeep the core and lower back engaged at all times.\",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Full Body\",\n      \"video\": [\n      {\n      \"id\": \"28\",\n      \"path\": \"31_1454041910.mp4\",\n      \"videothumbnail\": \"31_1454041910.jpg\",\n      \"description\": \"Burpee\"\n      }\n      ]\n      }\n      },\n      {\n      \"name\": \"Rest\",\n      \"duration\": 10,\n      \"unit\": \"seconds\",\n      \"exercise\": []\n      }\n      ],\n      \"round2\": [\n      {\n      \"name\": \"High Jumps\",\n      \"duration\": 25,\n      \"unit\": \"times\",\n      \"exercise\": {\n      \"id\": \"36\",\n      \"name\": \"High Jumps\",\n      \"description\": \"Do high jumps as a part of restless HIIT workouts\",\n      \"category\": \"1\",\n      \"type\": \"2\",\n      \"muscle_groups\": \"7\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \"1. Start from a standing position\\r\\n2. Jump up and bring your knees to your chest\",\n      \"video_tips\": \"    \",\n      \"pro_tips\": \"Land softly and exhale when the knees are up.\\r\\n  \",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Legs\",\n      \"video\": [\n      {\n      \"id\": \"33\",\n      \"path\": \"36_1454042273.mp4\",\n      \"videothumbnail\": \"36_1454042273.jpg\",\n      \"description\": \"High Jumps\"\n      }\n      ]\n      }\n      },\n      {\n      \"name\": \"Rest\",\n      \"duration\": 10,\n      \"unit\": \"seconds\",\n      \"exercise\": []\n      }\n      ],\n      \"round3\": [\n      {\n      \"name\": \"Knee Raises\",\n      \"duration\": 15,\n      \"unit\": \"times\",\n      \"exercise\": {\n      \"id\": \"57\",\n      \"name\": \"Knee Raises\",\n      \"description\": \"Develop grip and core strength and get used to slow and controlled moves\",\n      \"category\": \"1\",\n      \"type\": \"2\",\n      \"muscle_groups\": \"4,6,7\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \"1. Start from a deadhang position with your arms and legs fully extended, and feet off the ground.  \\r\\n2. Raise your knees up towards your chest as high as possible. \\r\\n3. Hold for a brief moment and slowly return to the starting position. \\r\\n4. Repeat for required repetitions. \",\n      \"video_tips\": \"    \",\n      \"pro_tips\": \"Avoid using momentum or swinging during the exercise. \\r\\nPerform the knee raise slowly and controlled.\",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Back, Core, Legs\",\n      \"video\": [\n      {\n      \"id\": \"67\",\n      \"path\": \"57_1454044213.mp4\",\n      \"videothumbnail\": \"57_1454044213.jpg\",\n      \"description\": \"Knee Raises\"\n      }\n      ]\n      }\n      },\n      {\n      \"name\": \"Rest\",\n      \"duration\": 10,\n      \"unit\": \"seconds\",\n      \"exercise\": []\n      }\n      ]\n      }\n      ],\n      \"replacement_round_count\": 3\n      }\n      ],\n      \"stretching\": [\n      {\n      \"id\": \"1\",\n      \"exercise_id\": \"Superman\",\n      \"duration\": {\n      \"min\": 6,\n      \"max\": 13\n      },\n      \"unit\": \"times\",\n      \"is_completed\": \"0\",\n      \"created_at\": \"2016-01-22 07:10:31\",\n      \"updated_at\": \"2016-01-22 07:10:31\"\n      },\n      {\n      \"id\": \"2\",\n      \"exercise_id\": \"Lower Back Strength\",\n      \"duration\": {\n      \"min\": 38,\n      \"max\": 63\n      },\n      \"unit\": \"times\",\n      \"is_completed\": \"0\",\n      \"created_at\": \"2016-01-22 07:15:02\",\n      \"updated_at\": \"2016-01-22 07:15:02\"\n      },\n      {\n      \"id\": \"3\",\n      \"exercise_id\": \"Upper Dog\",\n      \"duration\": {\n      \"min\": 38,\n      \"max\": 75\n      },\n      \"unit\": \"seconds\",\n      \"is_completed\": \"0\",\n      \"created_at\": \"2016-01-22 07:16:03\",\n      \"updated_at\": \"2016-01-22 07:16:03\"\n      },\n      {\n      \"id\": \"4\",\n      \"exercise_id\": \"Child's Pose\",\n      \"duration\": {\n      \"min\": 38,\n      \"max\": 75\n      },\n      \"unit\": \"seconds\",\n      \"is_completed\": \"0\",\n      \"created_at\": \"2016-01-22 07:16:46\",\n      \"updated_at\": \"2016-01-22 07:16:46\"\n      },\n      {\n      \"id\": \"5\",\n      \"exercise_id\": \"L-sit on the floor\",\n      \"duration\": {\n      \"min\": 38,\n      \"max\": 75\n      },\n      \"unit\": \"seconds\",\n      \"is_completed\": \"0\",\n      \"created_at\": \"2016-01-22 07:17:13\",\n      \"updated_at\": \"2016-01-22 07:17:13\"\n      },\n      {\n      \"id\": \"6\",\n      \"exercise_id\": \"Good morning\",\n      \"duration\": {\n      \"min\": 38,\n      \"max\": 75\n      },\n      \"unit\": \"seconds\",\n      \"is_completed\": \"0\",\n      \"created_at\": \"2016-01-22 07:17:43\",\n      \"updated_at\": \"2016-01-22 07:17:43\"\n      },\n      {\n      \"id\": \"7\",\n      \"exercise_id\": \"Chest Opener\",\n      \"duration\": {\n      \"min\": 38,\n      \"max\": 75\n      },\n      \"unit\": \"seconds\",\n      \"is_completed\": \"0\",\n      \"created_at\": \"2016-01-22 07:19:32\",\n      \"updated_at\": \"2016-01-22 07:19:32\"\n      },\n      {\n      \"id\": \"8\",\n      \"exercise_id\": \"Triceps Stretc\",\n      \"duration\": {\n      \"min\": 38,\n      \"max\": 75\n      },\n      \"unit\": \"seconds\",\n      \"is_completed\": \"0\",\n      \"created_at\": \"2016-01-22 07:19:56\",\n      \"updated_at\": \"2016-01-22 07:19:56\"\n      },\n      {\n      \"id\": \"9\",\n      \"exercise_id\": \"Hands Back\",\n      \"duration\": {\n      \"min\": 38,\n      \"max\": 75\n      },\n      \"unit\": \"seconds\",\n      \"is_completed\": \"0\",\n      \"created_at\": \"2016-01-22 07:20:19\",\n      \"updated_at\": \"2016-01-22 07:20:19\"\n      },\n      {\n      \"id\": \"10\",\n      \"exercise_id\": \"Shoulder Stretch\",\n      \"duration\": {\n      \"min\": 38,\n      \"max\": 75\n      },\n      \"unit\": \"seconds\",\n      \"is_completed\": \"0\",\n      \"created_at\": \"2016-01-22 07:20:45\",\n      \"updated_at\": \"2016-01-22 07:20:45\"\n      }\n      ],\n      \"status\": \"pending\"\n      }\n      },\n      \"category\": \"professional\",\n      \"muscle_groups\": \"\",\n      \"limitations\": \"\",\n      \"goal_option\": \"0\",\n      \"feedback\": \"0\",\n      \"created_at\": \"2016-05-27 06:54:49\",\n      \"updated_at\": \"2016-06-14 12:50:18\",\n      \"musclegroup_string\": \"\",\n      \"goaloption_string\": \"\",\n      \"description\": \"Strive for progress\"\n      },\n      \"urls\": {\n      \"profileImageSmall\": \"http://testing.ykings.com/uploads/images/profile/small\",\n      \"profileImageMedium\": \"http://testing.ykings.com/uploads/images/profile/medium\",\n      \"profileImageLarge\": \"http://testing.ykings.com/uploads/images/profile/large\",\n      \"profileImageOriginal\": \"http://testing.ykings.com/uploads/images/profile/original\",\n      \"video\": \"http://testing.ykings.com/uploads/videos\",\n      \"videothumbnail\": \"http://testing.ykings.com/uploads/images/videothumbnails\",\n      \"feedImageSmall\": \"http://testing.ykings.com/uploads/images/feed/small\",\n      \"feedImageMedium\": \"http://testing.ykings.com/uploads/images/feed/medium\",\n      \"feedImageLarge\": \"http://testing.ykings.com/uploads/images/feed/large\",\n      \"feedImageOriginal\": \"http://testing.ykings.com/uploads/images/feed/original\",\n      \"coverImageSmall\": \"http://testing.ykings.com/uploads/images/cover_image/small\",\n      \"coverImageMedium\": \"http://testing.ykings.com/uploads/images/cover_image/medium\",\n      \"coverImageLarge\": \"http://testing.ykings.com/uploads/images/cover_image/large\",\n      \"coverImageOriginal\": \"http://testing.ykings.com/uploads/images/cover_image/original\"\n      }\n      }",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "error",
            "description": "<p>Message token_invalid.</p> "
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 400 Invalid Request\n{\n  \"status\":\"0\",\n  \"error\": \"token_invalid\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 401 Unauthorised\n{\n  \"status\":\"0\",\n  \"error\": \"token_expired\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 400 Bad Request\n{\n  \"status\":\"0\",\n  \"error\": \"token_not_provided\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 422 Validation error\n{\n  \"status\" : 0,\n  \"error\": \"The user_id field is required\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 500 user_not_exists\n{\n  \"status\" : 0,\n  \"error\": \"user_not_exists\"\n}",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "app/Http/Controllers/Api/CoachesController.php",
    "groupTitle": "Coach"
  },
  {
    "type": "post",
    "url": "/coach/getfundumentals",
    "title": "getFundumentals",
    "name": "getFundumentals",
    "group": "Coach",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "<p>Number</p> ",
            "optional": false,
            "field": "user_id",
            "description": "<p>Id of user *required</p> "
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "<p>String</p> ",
            "optional": false,
            "field": "success.",
            "description": ""
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n{\n      \"status\": 1,\n      \"tests\": {\n      \"1\": [\n      {\n      \"exercise_id\": 43,\n      \"duration\": 10,\n      \"exercise\": {\n      \"id\": \"43\",\n      \"name\": \"Pushups\",\n      \"description\": \"\",\n      \"category\": \"2\",\n      \"type\": \"1\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"1.00\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"video\": [\n      {\n      \"id\": \"43\",\n      \"path\": \"Now43.mp4\",\n      \"videothumbnail\": \"thumbnail3.jpg\",\n      \"description\": \"Test Description\"\n      }\n      ]\n      }\n      },\n      {\n      \"exercise_id\": 2,\n      \"duration\": 10,\n      \"exercise\": {\n      \"id\": \"2\",\n      \"name\": \"Australian Pullups\",\n      \"description\": \"Australian pull-ups are becoming a very popular exercise. Like all types of pull-ups (and all types of exercises for that matter) there are many different ways to do the Australian, and it can be incorporated into a number of different contexts within a workout.\",\n      \"category\": \"1\",\n      \"type\": \"2\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"1.00\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"video\": [\n      {\n      \"id\": \"2\",\n      \"path\": \"Now2.mp4\",\n      \"videothumbnail\": \"thumbnail1.png\",\n      \"description\": \"Test Description\"\n      }\n      ]\n      }\n      },\n      {\n      \"exercise_id\": 40,\n      \"duration\": 15,\n      \"exercise\": {\n      \"id\": \"40\",\n      \"name\": \"Lunge\",\n      \"description\": \"\",\n      \"category\": \"2\",\n      \"type\": \"2\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"1.00\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"video\": [\n      {\n      \"id\": \"40\",\n      \"path\": \"Now40.mp4\",\n      \"videothumbnail\": \"thumbnail3.jpg\",\n      \"description\": \"Test Description\"\n      }\n      ]\n      }\n      },\n      {\n      \"exercise_id\": 17,\n      \"duration\": 15,\n      \"exercise\": {\n      \"id\": \"17\",\n      \"name\": \"Plank\",\n      \"description\": \"\",\n      \"category\": \"1\",\n      \"type\": \"1\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"1.00\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"video\": [\n      {\n      \"id\": \"17\",\n      \"path\": \"Now17.mp4\",\n      \"videothumbnail\": \"thumbnail1.png\",\n      \"description\": \"Test Description\"\n      }\n      ]\n      }\n      }\n      ],\n      \"2\": [\n      {\n      \"exercise_id\": 43,\n      \"duration\": 30,\n      \"exercise\": {\n      \"id\": \"43\",\n      \"name\": \"Pushups\",\n      \"description\": \"\",\n      \"category\": \"2\",\n      \"type\": \"1\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"1.00\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"video\": [\n      {\n      \"id\": \"43\",\n      \"path\": \"Now43.mp4\",\n      \"videothumbnail\": \"thumbnail3.jpg\",\n      \"description\": \"Test Description\"\n      }\n      ]\n      }\n      },\n      {\n      \"exercise_id\": 32,\n      \"duration\": 10,\n      \"exercise\": {\n      \"id\": \"32\",\n      \"name\": \"Pull ups / Chin ups\",\n      \"description\": \"\",\n      \"category\": \"2\",\n      \"type\": \"1\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"1.00\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"video\": [\n      {\n      \"id\": \"32\",\n      \"path\": \"Now32.mp4\",\n      \"videothumbnail\": \"thumbnail1.png\",\n      \"description\": \"Test Description\"\n      }\n      ]\n      }\n      },\n      {\n      \"exercise_id\": 38,\n      \"duration\": 25,\n      \"exercise\": {\n      \"id\": \"38\",\n      \"name\": \"Squats\",\n      \"description\": \"\",\n      \"category\": \"2\",\n      \"type\": \"1\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"1.00\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"video\": [\n      {\n      \"id\": \"38\",\n      \"path\": \"Now38.mp4\",\n      \"videothumbnail\": \"thumbnail1.png\",\n      \"description\": \"Test Description\"\n      }\n      ]\n      }\n      }\n      ]\n      },\n      \"is_subscribed\": 0,\n      \"urls\": {\n      \"profileImageSmall\": \"http://sandbox.ykings.com/uploads/images/profile/small\",\n      \"profileImageMedium\": \"http://sandbox.ykings.com/uploads/images/profile/medium\",\n      \"profileImageLarge\": \"http://sandbox.ykings.com/uploads/images/profile/large\",\n      \"profileImageOriginal\": \"http://sandbox.ykings.com/uploads/images/profile/original\",\n      \"video\": \"http://sandbox.ykings.com/uploads/videos\",\n      \"videothumbnail\": \"http://sandbox.ykings.com/uploads/images/videothumbnails\",\n      \"feedImageSmall\": \"http://sandbox.ykings.com/uploads/images/feed/small\",\n      \"feedImageMedium\": \"http://sandbox.ykings.com/uploads/images/feed/medium\",\n      \"feedImageLarge\": \"http://sandbox.ykings.com/uploads/images/feed/large\",\n      \"feedImageOriginal\": \"http://sandbox.ykings.com/uploads/images/feed/original\",\n      \"coverImageSmall\": \"http://sandbox.ykings.com/uploads/images/cover_image/small\",\n      \"coverImageMedium\": \"http://sandbox.ykings.com/uploads/images/cover_image/medium\",\n      \"coverImageLarge\": \"http://sandbox.ykings.com/uploads/images/cover_image/large\",\n      \"coverImageOriginal\": \"http://sandbox.ykings.com/uploads/images/cover_image/original\"\n      }\n      }",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "error",
            "description": "<p>Message token_invalid.</p> "
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 400 Invalid Request\n{\n  \"status\":\"0\",\n  \"error\": \"token_invalid\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 401 Unauthorised\n{\n  \"status\":\"0\",\n  \"error\": \"token_expired\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 400 Bad Request\n{\n  \"status\":\"0\",\n  \"error\": \"token_not_provided\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 422 Validation error\n{\n  \"status\" : 0,\n  \"error\": \"The user_id field is required\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 500 user_not_exists\n{\n  \"status\" : 0,\n  \"error\": \"user_not_exists\"\n}",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "app/Http/Controllers/Api/CoachesController.php",
    "groupTitle": "Coach"
  },
  {
    "type": "post",
    "url": "/coach/getmusclegroups",
    "title": "getmusclegroups",
    "name": "getMusclegroups",
    "group": "Coach",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "<p>Number</p> ",
            "optional": false,
            "field": "user_id",
            "description": "<p>Id of user *required</p> "
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "<p>String</p> ",
            "optional": false,
            "field": "success.",
            "description": ""
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "error",
            "description": "<p>Message token_invalid.</p> "
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 400 Invalid Request\n{\n  \"status\":\"0\",\n  \"error\": \"token_invalid\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 401 Unauthorised\n{\n  \"status\":\"0\",\n  \"error\": \"token_expired\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 400 Bad Request\n{\n  \"status\":\"0\",\n  \"error\": \"token_not_provided\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 422 Validation error\n{\n  \"status\" : 0,\n  \"error\": \"The user_id field is required\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 500 user_not_exists\n{\n  \"status\" : 0,\n  \"error\": \"user_not_exists\"\n}",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "app/Http/Controllers/Api/CoachesController.php",
    "groupTitle": "Coach"
  },
  {
    "type": "post",
    "url": "/coach/preparecoach",
    "title": "prepareCoach",
    "name": "prepareCoach",
    "group": "Coach",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "<p>Number</p> ",
            "optional": false,
            "field": "user_id",
            "description": "<p>Id of user *required</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>Number</p> ",
            "optional": false,
            "field": "test",
            "description": "<p>status of test exercises json encoded array of exercise ids and statuses [{&quot;exercise_id&quot;:67,&quot;test_done&quot;:1},{&quot;exercise_id&quot;:45,&quot;test_done&quot;:1},{&quot;exercise_id&quot;:4,&quot;test_done&quot;:1},{&quot;exercise_id&quot;:12,&quot;test_done&quot;:1}] *required</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>Number</p> ",
            "optional": false,
            "field": "days",
            "description": "<p>number of workout days per week *required</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>String</p> ",
            "optional": true,
            "field": "muscle_groups",
            "description": "<p>user muscle groups preferences comma seperated ids 1,5,6 etc.</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>String</p> ",
            "optional": true,
            "field": "limitations",
            "description": "<p>user muscle groups preferences comma seperated ids 1,5,6 etc.</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>String</p> ",
            "optional": false,
            "field": "feedback",
            "description": "<p>user feedback json_encoded array {&quot;67&quot;:2,&quot;45&quot;:1,&quot;4&quot;:2,&quot;12&quot;:3} 0-not done, 1- I can do way more, 2 - I can do more, 3 - It was ok *required</p> "
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "<p>String</p> ",
            "optional": false,
            "field": "success.",
            "description": ""
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n{\n      \"status\": 1,\n      \"message\": \"coach_exercises\",\n      \"coach_day\": \"1\",\n      \"coach_week\": \"1\",\n      \"is_subscribed\": 1,\n      \"need_update\": \"0\",\n      \"week_status\": {\n      \"1\": 0\n      },\n      \"day_status\": {\n      \"1\": 0,\n      \"2\": 0,\n      \"3\": 0,\n      \"4\": 0,\n      \"5\": 0,\n      \"6\": 0\n      },\n      \"week_points\": \"330.00\",\n      \"coach\": {\n      \"id\": \"490\",\n      \"user_id\": \"67\",\n      \"focus\": \"2\",\n      \"height\": \"0.00\",\n      \"weight\": \"0.00\",\n      \"days\": \"6\",\n      \"exercises\": {\n      \"day1\": {\n      \"warmup\": [\n      {\n      \"id\": \"1\",\n      \"name\": \"wall extensions\",\n      \"duration\": {\n      \"min\": \"10\",\n      \"max\": \"20\"\n      },\n      \"unit\": \"times\",\n      \"created_at\": \"2016-01-21 08:55:06\",\n      \"updated_at\": \"2016-01-21 08:55:06\",\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"2\",\n      \"name\": \"band dislocates\",\n      \"duration\": {\n      \"min\": \"10\",\n      \"max\": \"20\"\n      },\n      \"unit\": \"times\",\n      \"created_at\": \"2016-01-21 08:57:38\",\n      \"updated_at\": \"2016-01-21 08:57:38\",\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"3\",\n      \"name\": \"cat-camels\",\n      \"duration\": {\n      \"min\": \"10\",\n      \"max\": \"20\"\n      },\n      \"unit\": \"times\",\n      \"created_at\": \"2016-01-21 09:00:39\",\n      \"updated_at\": \"2016-01-21 09:00:39\",\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"4\",\n      \"name\": \"scapular shrugs\",\n      \"duration\": {\n      \"min\": \"10\",\n      \"max\": \"20\"\n      },\n      \"unit\": \"times\",\n      \"created_at\": \"2016-01-21 09:01:01\",\n      \"updated_at\": \"2016-01-21 09:01:01\",\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"5\",\n      \"name\": \"full body circles\",\n      \"duration\": {\n      \"min\": \"10\",\n      \"max\": \"20\"\n      },\n      \"unit\": \"times\",\n      \"created_at\": \"2016-01-21 09:01:26\",\n      \"updated_at\": \"2016-01-21 09:01:26\",\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"6\",\n      \"name\": \"Jumping Jacks\",\n      \"duration\": {\n      \"min\": \"100\",\n      \"max\": \"\"\n      },\n      \"unit\": \"seconds\",\n      \"created_at\": \"2016-01-21 09:04:52\",\n      \"updated_at\": \"2016-01-21 09:04:52\",\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"7\",\n      \"name\": \"Arm rotations\",\n      \"duration\": {\n      \"min\": \"120\",\n      \"max\": \"\"\n      },\n      \"unit\": \"times\",\n      \"created_at\": \"2016-01-21 09:05:29\",\n      \"updated_at\": \"2016-01-21 09:05:29\",\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"8\",\n      \"name\": \"High Knees\",\n      \"duration\": {\n      \"min\": \"50\",\n      \"max\": \"\"\n      },\n      \"unit\": \"times\",\n      \"created_at\": \"2016-01-21 09:06:02\",\n      \"updated_at\": \"2016-01-21 09:06:02\",\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"9\",\n      \"name\": \"Shouder rolls\",\n      \"duration\": {\n      \"min\": \"20\",\n      \"max\": \"\"\n      },\n      \"unit\": \"times\",\n      \"created_at\": \"2016-01-21 09:06:34\",\n      \"updated_at\": \"2016-01-21 09:06:34\",\n      \"is_completed\": 0\n      }\n      ],\n      \"is_completed\": 0,\n      \"fundumentals\": [\n      {\n      \"id\": \"16\",\n      \"row\": \"4\",\n      \"exercise_id\": \"57\",\n      \"duration\": {\n      \"min\": \"15\",\n      \"max\": \"\"\n      },\n      \"unit\": \"times\",\n      \"is_completed\": \"0\",\n      \"created_at\": \"2016-01-22 04:51:17\",\n      \"updated_at\": \"2016-04-04 12:10:48\",\n      \"exercise\": {\n      \"id\": \"57\",\n      \"name\": \"Knee Raises\",\n      \"description\": \"Develop grip and core strength and get used to slow and controlled moves\",\n      \"category\": \"1\",\n      \"type\": \"2\",\n      \"muscle_groups\": \"4,6,7\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \"1. Start from a deadhang position with your arms and legs fully extended, and feet off the ground.  \\r\\n2. Raise your knees up towards your chest as high as possible. \\r\\n3. Hold for a brief moment and slowly return to the starting position. \\r\\n4. Repeat for required repetitions. \",\n      \"video_tips\": \"    \",\n      \"pro_tips\": \"Avoid using momentum or swinging during the exercise. \\r\\nPerform the knee raise slowly and controlled.\",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Back, Core, Legs\",\n      \"video\": [\n      {\n      \"id\": \"67\",\n      \"path\": \"57_1454044213.mp4\",\n      \"videothumbnail\": \"57_1454044213.jpg\",\n      \"description\": \"Knee Raises\"\n      }\n      ]\n      }\n      },\n      {\n      \"id\": \"17\",\n      \"row\": \"4\",\n      \"exercise_id\": \"78\",\n      \"duration\": {\n      \"min\": \"20\",\n      \"max\": \"\"\n      },\n      \"unit\": \"times\",\n      \"is_completed\": \"0\",\n      \"created_at\": \"2016-01-22 04:52:22\",\n      \"updated_at\": \"2016-04-04 14:00:58\",\n      \"exercise\": {\n      \"id\": \"78\",\n      \"name\": \"Australian Pullups\",\n      \"description\": \"Get started with developing your grip and back strength\",\n      \"category\": \"1\",\n      \"type\": \"2\",\n      \"muscle_groups\": \"1,4,5,6\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \"1. Grip a bar that is suspended at around waist height, with the feet resting on the ground.\\r\\n2. Squeeze the shoulder blades together and pull your chest up to the bar\",\n      \"video_tips\": \"    \",\n      \"pro_tips\": \"The closer the body is to horizontal the more difficult the exercise becomes.?\\r\\nA set of height adjustable gymnastics rings are a good alternative.\\r\\nKeep whole body engaged and keep your butt in line with your body.?  \",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Shoulders, Back, Arms, Core\",\n      \"video\": [\n      {\n      \"id\": \"78\",\n      \"path\": \"78_1454045971.mp4\",\n      \"videothumbnail\": \"78_1454045971.jpg\",\n      \"description\": \"Australian Pullups\"\n      }\n      ]\n      }\n      },\n      {\n      \"id\": \"18\",\n      \"row\": \"4\",\n      \"exercise_id\": \"49\",\n      \"duration\": {\n      \"min\": \"30\",\n      \"max\": \"\"\n      },\n      \"unit\": \"times\",\n      \"is_completed\": \"0\",\n      \"created_at\": \"2016-01-22 04:52:56\",\n      \"updated_at\": \"2016-04-04 14:19:29\",\n      \"exercise\": {\n      \"id\": \"49\",\n      \"name\": \"Side Triceps\",\n      \"description\": \"Start with the basics of building triceps strength\",\n      \"category\": \"1\",\n      \"type\": \"1\",\n      \"muscle_groups\": \"3\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \" 1. Start with the body on your side\\r\\n2. Put one hand on your shoulder \\r\\n3. Press up with the other arm and hold in extension \",\n      \"video_tips\": \"          \",\n      \"pro_tips\": \" Avoid supporting the movement with your core muscle.      \",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Triceps\",\n      \"video\": [\n      {\n      \"id\": \"43\",\n      \"path\": \"49_1454043404.mp4\",\n      \"videothumbnail\": \"49_1454043404.jpg\",\n      \"description\": \"Side Triceps\"\n      }\n      ]\n      }\n      },\n      {\n      \"id\": \"19\",\n      \"row\": \"4\",\n      \"exercise_id\": \"45\",\n      \"duration\": {\n      \"min\": \"25\",\n      \"max\": \"\"\n      },\n      \"unit\": \"times\",\n      \"is_completed\": \"0\",\n      \"created_at\": \"2016-01-22 04:53:50\",\n      \"updated_at\": \"2016-04-04 14:16:38\",\n      \"exercise\": {\n      \"id\": \"45\",\n      \"name\": \"Squats\",\n      \"description\": \"Get strong with a world class full body compound exercise\",\n      \"category\": \"2\",\n      \"type\": \"1\",\n      \"muscle_groups\": \"7\",\n      \"rewards\": \"7.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \" 1. Start from a standing position\\r\\n2. Go down in a squat \\r\\n3. Keep your hands in front of you and press yourself up \",\n      \"video_tips\": \"      \",\n      \"pro_tips\": \" Lock the knees out while squeezing the glutes to execute properly.\\r\\nSquat deep and hold for 1-2 secs, ass to the grass!     \",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Legs\",\n      \"video\": [\n      {\n      \"id\": \"41\",\n      \"path\": \"45_1454043104.mp4\",\n      \"videothumbnail\": \"45_1454043104.jpg\",\n      \"description\": \"Squats\"\n      }\n      ]\n      }\n      },\n      {\n      \"id\": \"20\",\n      \"row\": \"4\",\n      \"exercise_id\": \"32\",\n      \"duration\": {\n      \"min\": \"20\",\n      \"max\": \"\"\n      },\n      \"unit\": \"times\",\n      \"is_completed\": \"0\",\n      \"created_at\": \"2016-01-22 04:54:35\",\n      \"updated_at\": \"2016-04-04 11:06:44\",\n      \"exercise\": {\n      \"id\": \"32\",\n      \"name\": \"Sprawl\",\n      \"description\": \"Boost your cardio and strength with sprawls\",\n      \"category\": \"1\",\n      \"type\": \"1\",\n      \"muscle_groups\": \"8\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \"1. Start in a standing position\\r\\n2. Go into a straight arm plank position\\r\\n3. Go back up and jump with your hands above your head\",\n      \"video_tips\": \"    \",\n      \"pro_tips\": \"Avoid a hollow back during the movement. \\r\\nKeep the core and lower back engaged at all times.\",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Full Body\",\n      \"video\": [\n      {\n      \"id\": \"29\",\n      \"path\": \"32_1454041954.mp4\",\n      \"videothumbnail\": \"32_1454041954.jpg\",\n      \"description\": \"Sprawl\"\n      }\n      ]\n      }\n      }\n      ],\n      \"exercises\": [],\n      \"workout\": {\n      \"id\": \"3\",\n      \"name\": \"Bragi\",\n      \"description\": \"D,C,A\",\n      \"rounds\": \"5\",\n      \"category\": \"2\",\n      \"type\": \"2\",\n      \"rewards\": \"440\",\n      \"duration\": \"480.00\",\n      \"equipments\": \"Bar/Rings\",\n      \"is_completed\": 0,\n      \"exercises\": {\n      \"round1\": [\n      {\n      \"id\": \"100\",\n      \"workout_id\": \"3\",\n      \"category\": \"1\",\n      \"repititions\": \"10\",\n      \"exercise_id\": \"14\",\n      \"unit\": \"times\",\n      \"round\": \"1\",\n      \"created_at\": \"2016-01-19 04:18:12\",\n      \"updated_at\": \"2016-04-04 09:33:39\",\n      \"exercise\": {\n      \"id\": \"14\",\n      \"name\": \"Incline Pushups\",\n      \"description\": \"Start your journey with the simplest way to develop an athletic physique\",\n      \"category\": \"1\",\n      \"type\": \"1\",\n      \"muscle_groups\": \"1,2,3\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \"1. Place hands on edge of bench, bar or rings at waist height, slightly wider than shoulder width \\r\\n2. Perform regular pushup. Arms should be perpendicular to body. \\r\\n  \",\n      \"video_tips\": \"    \",\n      \"pro_tips\": \"Resistance can be de- or increased by performing movement on different angles.\\r\\nAvoid rounding your spine and doing ?banana back? pushups, try squeezing your core.\\r\\n  \",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Shoulders, Chest, Triceps\"\n      },\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"105\",\n      \"workout_id\": \"3\",\n      \"category\": \"1\",\n      \"repititions\": \"25\",\n      \"exercise_id\": \"36\",\n      \"unit\": \"times\",\n      \"round\": \"1\",\n      \"created_at\": \"2016-01-19 04:19:20\",\n      \"updated_at\": \"2016-04-04 11:12:49\",\n      \"exercise\": {\n      \"id\": \"36\",\n      \"name\": \"High Jumps\",\n      \"description\": \"Do high jumps as a part of restless HIIT workouts\",\n      \"category\": \"1\",\n      \"type\": \"2\",\n      \"muscle_groups\": \"7\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \"1. Start from a standing position\\r\\n2. Jump up and bring your knees to your chest\",\n      \"video_tips\": \"    \",\n      \"pro_tips\": \"Land softly and exhale when the knees are up.\\r\\n  \",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Legs\"\n      },\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"110\",\n      \"workout_id\": \"3\",\n      \"category\": \"1\",\n      \"repititions\": \"7\",\n      \"exercise_id\": \"66\",\n      \"unit\": \"times\",\n      \"round\": \"1\",\n      \"created_at\": \"2016-01-19 04:19:53\",\n      \"updated_at\": \"2016-04-04 14:31:38\",\n      \"exercise\": {\n      \"id\": \"69\",\n      \"name\": \"Jumping Pullups\",\n      \"description\": \"Expose yourself to packed shoulders and hang time\",\n      \"category\": \"1\",\n      \"type\": \"1\",\n      \"muscle_groups\": \"1,5\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \" 1. Grip a bar and jump into the top position of the pull-up exercise\\r\\n2. Straight legs in front of you. \\r\\n3. Slowly go down into a deadhang position \",\n      \"video_tips\": \"        \",\n      \"pro_tips\": \" A deadhang postion requires your shoulder blades down and towards the spine with arms being straight (retraction)\\r\\nAim for three second holds at the top and go down slowly \",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Shoulders, Arms\"\n      },\n      \"is_completed\": 0\n      }\n      ],\n      \"round2\": [\n      {\n      \"id\": \"101\",\n      \"workout_id\": \"3\",\n      \"category\": \"1\",\n      \"repititions\": \"10\",\n      \"exercise_id\": \"14\",\n      \"unit\": \"times\",\n      \"round\": \"2\",\n      \"created_at\": \"2016-01-19 04:18:12\",\n      \"updated_at\": \"2016-04-04 09:33:39\",\n      \"exercise\": {\n      \"id\": \"14\",\n      \"name\": \"Incline Pushups\",\n      \"description\": \"Start your journey with the simplest way to develop an athletic physique\",\n      \"category\": \"1\",\n      \"type\": \"1\",\n      \"muscle_groups\": \"1,2,3\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \"1. Place hands on edge of bench, bar or rings at waist height, slightly wider than shoulder width \\r\\n2. Perform regular pushup. Arms should be perpendicular to body. \\r\\n  \",\n      \"video_tips\": \"    \",\n      \"pro_tips\": \"Resistance can be de- or increased by performing movement on different angles.\\r\\nAvoid rounding your spine and doing ?banana back? pushups, try squeezing your core.\\r\\n  \",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Shoulders, Chest, Triceps\"\n      },\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"106\",\n      \"workout_id\": \"3\",\n      \"category\": \"1\",\n      \"repititions\": \"25\",\n      \"exercise_id\": \"36\",\n      \"unit\": \"times\",\n      \"round\": \"2\",\n      \"created_at\": \"2016-01-19 04:19:20\",\n      \"updated_at\": \"2016-04-04 11:12:49\",\n      \"exercise\": {\n      \"id\": \"36\",\n      \"name\": \"High Jumps\",\n      \"description\": \"Do high jumps as a part of restless HIIT workouts\",\n      \"category\": \"1\",\n      \"type\": \"2\",\n      \"muscle_groups\": \"7\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \"1. Start from a standing position\\r\\n2. Jump up and bring your knees to your chest\",\n      \"video_tips\": \"    \",\n      \"pro_tips\": \"Land softly and exhale when the knees are up.\\r\\n  \",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Legs\"\n      },\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"111\",\n      \"workout_id\": \"3\",\n      \"category\": \"1\",\n      \"repititions\": \"7\",\n      \"exercise_id\": \"66\",\n      \"unit\": \"times\",\n      \"round\": \"2\",\n      \"created_at\": \"2016-01-19 04:19:54\",\n      \"updated_at\": \"2016-04-04 14:31:38\",\n      \"exercise\": {\n      \"id\": \"69\",\n      \"name\": \"Jumping Pullups\",\n      \"description\": \"Expose yourself to packed shoulders and hang time\",\n      \"category\": \"1\",\n      \"type\": \"1\",\n      \"muscle_groups\": \"1,5\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \" 1. Grip a bar and jump into the top position of the pull-up exercise\\r\\n2. Straight legs in front of you. \\r\\n3. Slowly go down into a deadhang position \",\n      \"video_tips\": \"        \",\n      \"pro_tips\": \" A deadhang postion requires your shoulder blades down and towards the spine with arms being straight (retraction)\\r\\nAim for three second holds at the top and go down slowly \",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Shoulders, Arms\"\n      },\n      \"is_completed\": 0\n      }\n      ],\n      \"round3\": [\n      {\n      \"id\": \"102\",\n      \"workout_id\": \"3\",\n      \"category\": \"1\",\n      \"repititions\": \"10\",\n      \"exercise_id\": \"14\",\n      \"unit\": \"times\",\n      \"round\": \"3\",\n      \"created_at\": \"2016-01-19 04:18:12\",\n      \"updated_at\": \"2016-04-04 09:33:39\",\n      \"exercise\": {\n      \"id\": \"14\",\n      \"name\": \"Incline Pushups\",\n      \"description\": \"Start your journey with the simplest way to develop an athletic physique\",\n      \"category\": \"1\",\n      \"type\": \"1\",\n      \"muscle_groups\": \"1,2,3\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \"1. Place hands on edge of bench, bar or rings at waist height, slightly wider than shoulder width \\r\\n2. Perform regular pushup. Arms should be perpendicular to body. \\r\\n  \",\n      \"video_tips\": \"    \",\n      \"pro_tips\": \"Resistance can be de- or increased by performing movement on different angles.\\r\\nAvoid rounding your spine and doing ?banana back? pushups, try squeezing your core.\\r\\n  \",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Shoulders, Chest, Triceps\"\n      },\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"107\",\n      \"workout_id\": \"3\",\n      \"category\": \"1\",\n      \"repititions\": \"25\",\n      \"exercise_id\": \"36\",\n      \"unit\": \"times\",\n      \"round\": \"3\",\n      \"created_at\": \"2016-01-19 04:19:20\",\n      \"updated_at\": \"2016-04-04 11:12:49\",\n      \"exercise\": {\n      \"id\": \"36\",\n      \"name\": \"High Jumps\",\n      \"description\": \"Do high jumps as a part of restless HIIT workouts\",\n      \"category\": \"1\",\n      \"type\": \"2\",\n      \"muscle_groups\": \"7\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \"1. Start from a standing position\\r\\n2. Jump up and bring your knees to your chest\",\n      \"video_tips\": \"    \",\n      \"pro_tips\": \"Land softly and exhale when the knees are up.\\r\\n  \",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Legs\"\n      },\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"112\",\n      \"workout_id\": \"3\",\n      \"category\": \"1\",\n      \"repititions\": \"7\",\n      \"exercise_id\": \"66\",\n      \"unit\": \"times\",\n      \"round\": \"3\",\n      \"created_at\": \"2016-01-19 04:19:54\",\n      \"updated_at\": \"2016-04-04 14:31:38\",\n      \"exercise\": {\n      \"id\": \"69\",\n      \"name\": \"Jumping Pullups\",\n      \"description\": \"Expose yourself to packed shoulders and hang time\",\n      \"category\": \"1\",\n      \"type\": \"1\",\n      \"muscle_groups\": \"1,5\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \" 1. Grip a bar and jump into the top position of the pull-up exercise\\r\\n2. Straight legs in front of you. \\r\\n3. Slowly go down into a deadhang position \",\n      \"video_tips\": \"        \",\n      \"pro_tips\": \" A deadhang postion requires your shoulder blades down and towards the spine with arms being straight (retraction)\\r\\nAim for three second holds at the top and go down slowly \",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Shoulders, Arms\"\n      },\n      \"is_completed\": 0\n      }\n      ]\n      },\n      \"exercise_category\": 1\n      },\n      \"coach_workout_rounds\": 3,\n      \"workout_intensity\": 1,\n      \"hiit\": [],\n      \"stretching\": [\n      {\n      \"id\": \"1\",\n      \"exercise_id\": \"Superman\",\n      \"duration\": {\n      \"min\": 6,\n      \"max\": 13\n      },\n      \"unit\": \"times\",\n      \"is_completed\": \"0\",\n      \"created_at\": \"2016-01-22 07:10:31\",\n      \"updated_at\": \"2016-01-22 07:10:31\"\n      },\n      {\n      \"id\": \"2\",\n      \"exercise_id\": \"Lower Back Strength\",\n      \"duration\": {\n      \"min\": 38,\n      \"max\": 63\n      },\n      \"unit\": \"times\",\n      \"is_completed\": \"0\",\n      \"created_at\": \"2016-01-22 07:15:02\",\n      \"updated_at\": \"2016-01-22 07:15:02\"\n      },\n      {\n      \"id\": \"3\",\n      \"exercise_id\": \"Upper Dog\",\n      \"duration\": {\n      \"min\": 38,\n      \"max\": 75\n      },\n      \"unit\": \"seconds\",\n      \"is_completed\": \"0\",\n      \"created_at\": \"2016-01-22 07:16:03\",\n      \"updated_at\": \"2016-01-22 07:16:03\"\n      },\n      {\n      \"id\": \"4\",\n      \"exercise_id\": \"Child's Pose\",\n      \"duration\": {\n      \"min\": 38,\n      \"max\": 75\n      },\n      \"unit\": \"seconds\",\n      \"is_completed\": \"0\",\n      \"created_at\": \"2016-01-22 07:16:46\",\n      \"updated_at\": \"2016-01-22 07:16:46\"\n      },\n      {\n      \"id\": \"5\",\n      \"exercise_id\": \"L-sit on the floor\",\n      \"duration\": {\n      \"min\": 38,\n      \"max\": 75\n      },\n      \"unit\": \"seconds\",\n      \"is_completed\": \"0\",\n      \"created_at\": \"2016-01-22 07:17:13\",\n      \"updated_at\": \"2016-01-22 07:17:13\"\n      },\n      {\n      \"id\": \"6\",\n      \"exercise_id\": \"Good morning\",\n      \"duration\": {\n      \"min\": 38,\n      \"max\": 75\n      },\n      \"unit\": \"seconds\",\n      \"is_completed\": \"0\",\n      \"created_at\": \"2016-01-22 07:17:43\",\n      \"updated_at\": \"2016-01-22 07:17:43\"\n      },\n      {\n      \"id\": \"7\",\n      \"exercise_id\": \"Chest Opener\",\n      \"duration\": {\n      \"min\": 38,\n      \"max\": 75\n      },\n      \"unit\": \"seconds\",\n      \"is_completed\": \"0\",\n      \"created_at\": \"2016-01-22 07:19:32\",\n      \"updated_at\": \"2016-01-22 07:19:32\"\n      },\n      {\n      \"id\": \"8\",\n      \"exercise_id\": \"Triceps Stretc\",\n      \"duration\": {\n      \"min\": 38,\n      \"max\": 75\n      },\n      \"unit\": \"seconds\",\n      \"is_completed\": \"0\",\n      \"created_at\": \"2016-01-22 07:19:56\",\n      \"updated_at\": \"2016-01-22 07:19:56\"\n      },\n      {\n      \"id\": \"9\",\n      \"exercise_id\": \"Hands Back\",\n      \"duration\": {\n      \"min\": 38,\n      \"max\": 75\n      },\n      \"unit\": \"seconds\",\n      \"is_completed\": \"0\",\n      \"created_at\": \"2016-01-22 07:20:19\",\n      \"updated_at\": \"2016-01-22 07:20:19\"\n      },\n      {\n      \"id\": \"10\",\n      \"exercise_id\": \"Shoulder Stretch\",\n      \"duration\": {\n      \"min\": 38,\n      \"max\": 75\n      },\n      \"unit\": \"seconds\",\n      \"is_completed\": \"0\",\n      \"created_at\": \"2016-01-22 07:20:45\",\n      \"updated_at\": \"2016-01-22 07:20:45\"\n      }\n      ]\n      },\n      \"day2\": {\n      \"warmup\": [\n      {\n      \"id\": \"1\",\n      \"name\": \"wall extensions\",\n      \"duration\": {\n      \"min\": \"10\",\n      \"max\": \"20\"\n      },\n      \"unit\": \"times\",\n      \"created_at\": \"2016-01-21 08:55:06\",\n      \"updated_at\": \"2016-01-21 08:55:06\",\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"2\",\n      \"name\": \"band dislocates\",\n      \"duration\": {\n      \"min\": \"10\",\n      \"max\": \"20\"\n      },\n      \"unit\": \"times\",\n      \"created_at\": \"2016-01-21 08:57:38\",\n      \"updated_at\": \"2016-01-21 08:57:38\",\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"3\",\n      \"name\": \"cat-camels\",\n      \"duration\": {\n      \"min\": \"10\",\n      \"max\": \"20\"\n      },\n      \"unit\": \"times\",\n      \"created_at\": \"2016-01-21 09:00:39\",\n      \"updated_at\": \"2016-01-21 09:00:39\",\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"4\",\n      \"name\": \"scapular shrugs\",\n      \"duration\": {\n      \"min\": \"10\",\n      \"max\": \"20\"\n      },\n      \"unit\": \"times\",\n      \"created_at\": \"2016-01-21 09:01:01\",\n      \"updated_at\": \"2016-01-21 09:01:01\",\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"5\",\n      \"name\": \"full body circles\",\n      \"duration\": {\n      \"min\": \"10\",\n      \"max\": \"20\"\n      },\n      \"unit\": \"times\",\n      \"created_at\": \"2016-01-21 09:01:26\",\n      \"updated_at\": \"2016-01-21 09:01:26\",\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"6\",\n      \"name\": \"Jumping Jacks\",\n      \"duration\": {\n      \"min\": \"100\",\n      \"max\": \"\"\n      },\n      \"unit\": \"seconds\",\n      \"created_at\": \"2016-01-21 09:04:52\",\n      \"updated_at\": \"2016-01-21 09:04:52\",\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"7\",\n      \"name\": \"Arm rotations\",\n      \"duration\": {\n      \"min\": \"120\",\n      \"max\": \"\"\n      },\n      \"unit\": \"times\",\n      \"created_at\": \"2016-01-21 09:05:29\",\n      \"updated_at\": \"2016-01-21 09:05:29\",\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"8\",\n      \"name\": \"High Knees\",\n      \"duration\": {\n      \"min\": \"50\",\n      \"max\": \"\"\n      },\n      \"unit\": \"times\",\n      \"created_at\": \"2016-01-21 09:06:02\",\n      \"updated_at\": \"2016-01-21 09:06:02\",\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"9\",\n      \"name\": \"Shouder rolls\",\n      \"duration\": {\n      \"min\": \"20\",\n      \"max\": \"\"\n      },\n      \"unit\": \"times\",\n      \"created_at\": \"2016-01-21 09:06:34\",\n      \"updated_at\": \"2016-01-21 09:06:34\",\n      \"is_completed\": 0\n      }\n      ],\n      \"is_completed\": 0,\n      \"fundumentals\": [\n      {\n      \"id\": \"6\",\n      \"row\": \"2\",\n      \"exercise_id\": \"64\",\n      \"duration\": {\n      \"min\": \"10\",\n      \"max\": \"\"\n      },\n      \"unit\": \"times\",\n      \"is_completed\": \"0\",\n      \"created_at\": \"2016-01-22 04:29:57\",\n      \"updated_at\": \"2016-04-04 14:27:54\",\n      \"exercise\": {\n      \"id\": \"64\",\n      \"name\": \"Skin the cat\",\n      \"description\": \"Develop your joints mobility and expose yourself to new movement layers\",\n      \"category\": \"1\",\n      \"type\": \"2\",\n      \"muscle_groups\": \"4,5,6\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \" 1. Hands a little more than shoulder width apart\\r\\n2. Raise your knees to the chest\\r\\n3. continuing the movement until the feet pass up through the arms and over head into an inverted hang position.\\r\\n4. Continue to pass the feet round and down toward the ground into the extended 'skin the cat' position.\\r\\n5. Lift your hips and raise the legs back and over to the starting hang position. \",\n      \"video_tips\": \"        \",\n      \"pro_tips\": \" Put your hands closer together to ease up all back lever progressions.\\r\\nDo only half of the movement in the beginning, but fight for completion over time.\\r\\nIncorporate other static elements to challenge yourself during the movement as you master other skills.\\r\\n    \",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Back, Arms, Core\",\n      \"video\": [\n      {\n      \"id\": \"71\",\n      \"path\": \"64_1454045043.mp4\",\n      \"videothumbnail\": \"64_1454045043.jpg\",\n      \"description\": \"Skin the cat\"\n      }\n      ]\n      }\n      },\n      {\n      \"id\": \"7\",\n      \"row\": \"2\",\n      \"exercise_id\": \"14\",\n      \"duration\": {\n      \"min\": \"20\",\n      \"max\": \"\"\n      },\n      \"unit\": \"times\",\n      \"is_completed\": \"0\",\n      \"created_at\": \"2016-01-22 04:31:09\",\n      \"updated_at\": \"2016-04-04 09:33:39\",\n      \"exercise\": {\n      \"id\": \"14\",\n      \"name\": \"Incline Pushups\",\n      \"description\": \"Start your journey with the simplest way to develop an athletic physique\",\n      \"category\": \"1\",\n      \"type\": \"1\",\n      \"muscle_groups\": \"1,2,3\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \"1. Place hands on edge of bench, bar or rings at waist height, slightly wider than shoulder width \\r\\n2. Perform regular pushup. Arms should be perpendicular to body. \\r\\n  \",\n      \"video_tips\": \"    \",\n      \"pro_tips\": \"Resistance can be de- or increased by performing movement on different angles.\\r\\nAvoid rounding your spine and doing ?banana back? pushups, try squeezing your core.\\r\\n  \",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Shoulders, Chest, Triceps\",\n      \"video\": [\n      {\n      \"id\": \"13\",\n      \"path\": \"14_1453984243.mp4\",\n      \"videothumbnail\": \"14_1453984243.jpg\",\n      \"description\": \"Incline Pushups\"\n      }\n      ]\n      }\n      },\n      {\n      \"id\": \"8\",\n      \"row\": \"2\",\n      \"exercise_id\": \"48\",\n      \"duration\": {\n      \"min\": \"30\",\n      \"max\": \"\"\n      },\n      \"unit\": \"times\",\n      \"is_completed\": \"0\",\n      \"created_at\": \"2016-01-22 04:32:04\",\n      \"updated_at\": \"2016-04-04 14:19:00\",\n      \"exercise\": {\n      \"id\": \"48\",\n      \"name\": \"Bench Dips\",\n      \"description\": \"Develop more strength as you increase resistance with your bodyweight\",\n      \"category\": \"1\",\n      \"type\": \"2\",\n      \"muscle_groups\": \"3\",\n      \"rewards\": \"7.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \" 1. Sit on side of bench. \\r\\n2. Place hands on edge of bench. Position feet away from bench and rest heels on floor with legs straight. \\r\\n3. Lower your body with the feet in front of you\\r\\n4. Press your body up and hold in extension \",\n      \"video_tips\": \"      \",\n      \"pro_tips\": \" Don?t rush through your movements to make things easier on yourself. You will sacrifice your form, and in the end, you won?t actually get good at the skills you?re working on.\\r\\nThe closer you put your hands together, the tougher the bench dip becomes. \",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Triceps\",\n      \"video\": [\n      {\n      \"id\": \"62\",\n      \"path\": \"48_1454043291.mp4\",\n      \"videothumbnail\": \"48_1454043291.jpg\",\n      \"description\": \"Bench Dips\"\n      }\n      ]\n      }\n      },\n      {\n      \"id\": \"9\",\n      \"row\": \"2\",\n      \"exercise_id\": \"57\",\n      \"duration\": {\n      \"min\": \"15\",\n      \"max\": \"\"\n      },\n      \"unit\": \"times\",\n      \"is_completed\": \"0\",\n      \"created_at\": \"2016-01-22 04:32:49\",\n      \"updated_at\": \"2016-04-04 12:10:48\",\n      \"exercise\": {\n      \"id\": \"57\",\n      \"name\": \"Knee Raises\",\n      \"description\": \"Develop grip and core strength and get used to slow and controlled moves\",\n      \"category\": \"1\",\n      \"type\": \"2\",\n      \"muscle_groups\": \"4,6,7\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \"1. Start from a deadhang position with your arms and legs fully extended, and feet off the ground.  \\r\\n2. Raise your knees up towards your chest as high as possible. \\r\\n3. Hold for a brief moment and slowly return to the starting position. \\r\\n4. Repeat for required repetitions. \",\n      \"video_tips\": \"    \",\n      \"pro_tips\": \"Avoid using momentum or swinging during the exercise. \\r\\nPerform the knee raise slowly and controlled.\",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Back, Core, Legs\",\n      \"video\": [\n      {\n      \"id\": \"67\",\n      \"path\": \"57_1454044213.mp4\",\n      \"videothumbnail\": \"57_1454044213.jpg\",\n      \"description\": \"Knee Raises\"\n      }\n      ]\n      }\n      },\n      {\n      \"id\": \"10\",\n      \"row\": \"2\",\n      \"exercise_id\": \"42\",\n      \"duration\": {\n      \"min\": \"20\",\n      \"max\": \"\"\n      },\n      \"unit\": \"times\",\n      \"is_completed\": \"0\",\n      \"created_at\": \"2016-01-22 04:33:42\",\n      \"updated_at\": \"2016-04-04 11:22:09\",\n      \"exercise\": {\n      \"id\": \"42\",\n      \"name\": \"Single Leg Deadlift\",\n      \"description\": \"Get your hips mobile and control your balance\",\n      \"category\": \"1\",\n      \"type\": \"2\",\n      \"muscle_groups\": \"7\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \"1. Start from a standing position\\r\\n2. Keeping that knee slightly bent, perform a stiff-legged deadlift by bending at the hip.\\r\\n3. Continue lowering yourself until your upper body is parallel to the ground, and then return to the upright position. \\r\\n4. Repeat for the desired number of repetitions.\",\n      \"video_tips\": \"    \",\n      \"pro_tips\": \"Avoid bending your supporting leg.\\r\\nKeep your non-supporting leg extended behind you for balance.\",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Legs\",\n      \"video\": [\n      {\n      \"id\": \"38\",\n      \"path\": \"42_1454042789.mp4\",\n      \"videothumbnail\": \"42_1454042789.jpg\",\n      \"description\": \"Single Leg Deadlift\"\n      }\n      ]\n      }\n      }\n      ],\n      \"exercises\": [],\n      \"workout\": {\n      \"id\": \"2\",\n      \"name\": \"Borr\",\n      \"description\": \"A,C,E,B\",\n      \"rounds\": \"3\",\n      \"category\": \"2\",\n      \"type\": \"2\",\n      \"rewards\": \"330\",\n      \"duration\": \"1140.00\",\n      \"equipments\": \"Bar/Rings\",\n      \"is_completed\": 0,\n      \"exercises\": {\n      \"round1\": [\n      {\n      \"id\": \"16\",\n      \"workout_id\": \"2\",\n      \"category\": \"1\",\n      \"repititions\": \"25\",\n      \"exercise_id\": \"32\",\n      \"unit\": \"times\",\n      \"round\": \"1\",\n      \"created_at\": \"2016-01-19 03:29:53\",\n      \"updated_at\": \"2016-04-04 11:06:44\",\n      \"exercise\": {\n      \"id\": \"32\",\n      \"name\": \"Sprawl\",\n      \"description\": \"Boost your cardio and strength with sprawls\",\n      \"category\": \"1\",\n      \"type\": \"1\",\n      \"muscle_groups\": \"8\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \"1. Start in a standing position\\r\\n2. Go into a straight arm plank position\\r\\n3. Go back up and jump with your hands above your head\",\n      \"video_tips\": \"    \",\n      \"pro_tips\": \"Avoid a hollow back during the movement. \\r\\nKeep the core and lower back engaged at all times.\",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Full Body\"\n      },\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"19\",\n      \"workout_id\": \"2\",\n      \"category\": \"1\",\n      \"repititions\": \"10\",\n      \"exercise_id\": \"66\",\n      \"unit\": \"times\",\n      \"round\": \"1\",\n      \"created_at\": \"2016-01-19 03:30:29\",\n      \"updated_at\": \"2016-04-04 14:31:38\",\n      \"exercise\": {\n      \"id\": \"69\",\n      \"name\": \"Jumping Pullups\",\n      \"description\": \"Expose yourself to packed shoulders and hang time\",\n      \"category\": \"1\",\n      \"type\": \"1\",\n      \"muscle_groups\": \"1,5\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \" 1. Grip a bar and jump into the top position of the pull-up exercise\\r\\n2. Straight legs in front of you. \\r\\n3. Slowly go down into a deadhang position \",\n      \"video_tips\": \"        \",\n      \"pro_tips\": \" A deadhang postion requires your shoulder blades down and towards the spine with arms being straight (retraction)\\r\\nAim for three second holds at the top and go down slowly \",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Shoulders, Arms\"\n      },\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"22\",\n      \"workout_id\": \"2\",\n      \"category\": \"1\",\n      \"repititions\": \"40\",\n      \"exercise_id\": \"9\",\n      \"unit\": \"times\",\n      \"round\": \"1\",\n      \"created_at\": \"2016-01-19 03:30:59\",\n      \"updated_at\": \"2016-04-04 09:22:17\",\n      \"exercise\": {\n      \"id\": \"9\",\n      \"name\": \"Crunches\",\n      \"description\": \"Do the most admired sixpack exercise in the world\",\n      \"category\": \"1\",\n      \"type\": \"1\",\n      \"muscle_groups\": \"6\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \"1. Starting position is with lying face up on the floor with knees bent. \\r\\n2. Move torso up and touch your knees with your hands\\r\\n3. Lower body to the floor and repeat\\r\\n  \",\n      \"video_tips\": \"    \",\n      \"pro_tips\": \"Do variations in tempo. Aim for one count up and three counts down.\\r\\nIf you have a tendency to interlace your fingers and yank your head, place your hands cross-chest.\",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Core\"\n      },\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"25\",\n      \"workout_id\": \"2\",\n      \"category\": \"1\",\n      \"repititions\": \"30\",\n      \"exercise_id\": \"49\",\n      \"unit\": \"times\",\n      \"round\": \"1\",\n      \"created_at\": \"2016-01-19 03:31:40\",\n      \"updated_at\": \"2016-04-04 14:19:29\",\n      \"exercise\": {\n      \"id\": \"49\",\n      \"name\": \"Side Triceps\",\n      \"description\": \"Start with the basics of building triceps strength\",\n      \"category\": \"1\",\n      \"type\": \"1\",\n      \"muscle_groups\": \"3\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \" 1. Start with the body on your side\\r\\n2. Put one hand on your shoulder \\r\\n3. Press up with the other arm and hold in extension \",\n      \"video_tips\": \"          \",\n      \"pro_tips\": \" Avoid supporting the movement with your core muscle.      \",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Triceps\"\n      },\n      \"is_completed\": 0\n      }\n      ],\n      \"round2\": [\n      {\n      \"id\": \"17\",\n      \"workout_id\": \"2\",\n      \"category\": \"1\",\n      \"repititions\": \"25\",\n      \"exercise_id\": \"32\",\n      \"unit\": \"times\",\n      \"round\": \"2\",\n      \"created_at\": \"2016-01-19 03:29:53\",\n      \"updated_at\": \"2016-04-04 11:06:44\",\n      \"exercise\": {\n      \"id\": \"32\",\n      \"name\": \"Sprawl\",\n      \"description\": \"Boost your cardio and strength with sprawls\",\n      \"category\": \"1\",\n      \"type\": \"1\",\n      \"muscle_groups\": \"8\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \"1. Start in a standing position\\r\\n2. Go into a straight arm plank position\\r\\n3. Go back up and jump with your hands above your head\",\n      \"video_tips\": \"    \",\n      \"pro_tips\": \"Avoid a hollow back during the movement. \\r\\nKeep the core and lower back engaged at all times.\",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Full Body\"\n      },\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"20\",\n      \"workout_id\": \"2\",\n      \"category\": \"1\",\n      \"repititions\": \"10\",\n      \"exercise_id\": \"66\",\n      \"unit\": \"times\",\n      \"round\": \"2\",\n      \"created_at\": \"2016-01-19 03:30:30\",\n      \"updated_at\": \"2016-04-04 14:31:38\",\n      \"exercise\": {\n      \"id\": \"69\",\n      \"name\": \"Jumping Pullups\",\n      \"description\": \"Expose yourself to packed shoulders and hang time\",\n      \"category\": \"1\",\n      \"type\": \"1\",\n      \"muscle_groups\": \"1,5\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \" 1. Grip a bar and jump into the top position of the pull-up exercise\\r\\n2. Straight legs in front of you. \\r\\n3. Slowly go down into a deadhang position \",\n      \"video_tips\": \"        \",\n      \"pro_tips\": \" A deadhang postion requires your shoulder blades down and towards the spine with arms being straight (retraction)\\r\\nAim for three second holds at the top and go down slowly \",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Shoulders, Arms\"\n      },\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"23\",\n      \"workout_id\": \"2\",\n      \"category\": \"1\",\n      \"repititions\": \"40\",\n      \"exercise_id\": \"9\",\n      \"unit\": \"times\",\n      \"round\": \"2\",\n      \"created_at\": \"2016-01-19 03:30:59\",\n      \"updated_at\": \"2016-04-04 09:22:17\",\n      \"exercise\": {\n      \"id\": \"9\",\n      \"name\": \"Crunches\",\n      \"description\": \"Do the most admired sixpack exercise in the world\",\n      \"category\": \"1\",\n      \"type\": \"1\",\n      \"muscle_groups\": \"6\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \"1. Starting position is with lying face up on the floor with knees bent. \\r\\n2. Move torso up and touch your knees with your hands\\r\\n3. Lower body to the floor and repeat\\r\\n  \",\n      \"video_tips\": \"    \",\n      \"pro_tips\": \"Do variations in tempo. Aim for one count up and three counts down.\\r\\nIf you have a tendency to interlace your fingers and yank your head, place your hands cross-chest.\",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Core\"\n      },\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"26\",\n      \"workout_id\": \"2\",\n      \"category\": \"1\",\n      \"repititions\": \"30\",\n      \"exercise_id\": \"49\",\n      \"unit\": \"times\",\n      \"round\": \"2\",\n      \"created_at\": \"2016-01-19 03:31:41\",\n      \"updated_at\": \"2016-04-04 14:19:29\",\n      \"exercise\": {\n      \"id\": \"49\",\n      \"name\": \"Side Triceps\",\n      \"description\": \"Start with the basics of building triceps strength\",\n      \"category\": \"1\",\n      \"type\": \"1\",\n      \"muscle_groups\": \"3\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \" 1. Start with the body on your side\\r\\n2. Put one hand on your shoulder \\r\\n3. Press up with the other arm and hold in extension \",\n      \"video_tips\": \"          \",\n      \"pro_tips\": \" Avoid supporting the movement with your core muscle.      \",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Triceps\"\n      },\n      \"is_completed\": 0\n      }\n      ],\n      \"round3\": [\n      {\n      \"id\": \"18\",\n      \"workout_id\": \"2\",\n      \"category\": \"1\",\n      \"repititions\": \"25\",\n      \"exercise_id\": \"32\",\n      \"unit\": \"times\",\n      \"round\": \"3\",\n      \"created_at\": \"2016-01-19 03:29:53\",\n      \"updated_at\": \"2016-04-04 11:06:44\",\n      \"exercise\": {\n      \"id\": \"32\",\n      \"name\": \"Sprawl\",\n      \"description\": \"Boost your cardio and strength with sprawls\",\n      \"category\": \"1\",\n      \"type\": \"1\",\n      \"muscle_groups\": \"8\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \"1. Start in a standing position\\r\\n2. Go into a straight arm plank position\\r\\n3. Go back up and jump with your hands above your head\",\n      \"video_tips\": \"    \",\n      \"pro_tips\": \"Avoid a hollow back during the movement. \\r\\nKeep the core and lower back engaged at all times.\",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Full Body\"\n      },\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"21\",\n      \"workout_id\": \"2\",\n      \"category\": \"1\",\n      \"repititions\": \"10\",\n      \"exercise_id\": \"66\",\n      \"unit\": \"times\",\n      \"round\": \"3\",\n      \"created_at\": \"2016-01-19 03:30:30\",\n      \"updated_at\": \"2016-04-04 14:31:38\",\n      \"exercise\": {\n      \"id\": \"69\",\n      \"name\": \"Jumping Pullups\",\n      \"description\": \"Expose yourself to packed shoulders and hang time\",\n      \"category\": \"1\",\n      \"type\": \"1\",\n      \"muscle_groups\": \"1,5\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \" 1. Grip a bar and jump into the top position of the pull-up exercise\\r\\n2. Straight legs in front of you. \\r\\n3. Slowly go down into a deadhang position \",\n      \"video_tips\": \"        \",\n      \"pro_tips\": \" A deadhang postion requires your shoulder blades down and towards the spine with arms being straight (retraction)\\r\\nAim for three second holds at the top and go down slowly \",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Shoulders, Arms\"\n      },\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"24\",\n      \"workout_id\": \"2\",\n      \"category\": \"1\",\n      \"repititions\": \"40\",\n      \"exercise_id\": \"9\",\n      \"unit\": \"times\",\n      \"round\": \"3\",\n      \"created_at\": \"2016-01-19 03:30:59\",\n      \"updated_at\": \"2016-04-04 09:22:17\",\n      \"exercise\": {\n      \"id\": \"9\",\n      \"name\": \"Crunches\",\n      \"description\": \"Do the most admired sixpack exercise in the world\",\n      \"category\": \"1\",\n      \"type\": \"1\",\n      \"muscle_groups\": \"6\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \"1. Starting position is with lying face up on the floor with knees bent. \\r\\n2. Move torso up and touch your knees with your hands\\r\\n3. Lower body to the floor and repeat\\r\\n  \",\n      \"video_tips\": \"    \",\n      \"pro_tips\": \"Do variations in tempo. Aim for one count up and three counts down.\\r\\nIf you have a tendency to interlace your fingers and yank your head, place your hands cross-chest.\",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Core\"\n      },\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"27\",\n      \"workout_id\": \"2\",\n      \"category\": \"1\",\n      \"repititions\": \"30\",\n      \"exercise_id\": \"49\",\n      \"unit\": \"times\",\n      \"round\": \"3\",\n      \"created_at\": \"2016-01-19 03:31:41\",\n      \"updated_at\": \"2016-04-04 14:19:29\",\n      \"exercise\": {\n      \"id\": \"49\",\n      \"name\": \"Side Triceps\",\n      \"description\": \"Start with the basics of building triceps strength\",\n      \"category\": \"1\",\n      \"type\": \"1\",\n      \"muscle_groups\": \"3\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \" 1. Start with the body on your side\\r\\n2. Put one hand on your shoulder \\r\\n3. Press up with the other arm and hold in extension \",\n      \"video_tips\": \"          \",\n      \"pro_tips\": \" Avoid supporting the movement with your core muscle.      \",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Triceps\"\n      },\n      \"is_completed\": 0\n      }\n      ]\n      },\n      \"exercise_category\": 1\n      },\n      \"coach_workout_rounds\": 3,\n      \"workout_intensity\": 1,\n      \"hiit\": [],\n      \"stretching\": [\n      {\n      \"id\": \"1\",\n      \"exercise_id\": \"Superman\",\n      \"duration\": {\n      \"min\": 6,\n      \"max\": 13\n      },\n      \"unit\": \"times\",\n      \"is_completed\": \"0\",\n      \"created_at\": \"2016-01-22 07:10:31\",\n      \"updated_at\": \"2016-01-22 07:10:31\"\n      },\n      {\n      \"id\": \"2\",\n      \"exercise_id\": \"Lower Back Strength\",\n      \"duration\": {\n      \"min\": 38,\n      \"max\": 63\n      },\n      \"unit\": \"times\",\n      \"is_completed\": \"0\",\n      \"created_at\": \"2016-01-22 07:15:02\",\n      \"updated_at\": \"2016-01-22 07:15:02\"\n      },\n      {\n      \"id\": \"3\",\n      \"exercise_id\": \"Upper Dog\",\n      \"duration\": {\n      \"min\": 38,\n      \"max\": 75\n      },\n      \"unit\": \"seconds\",\n      \"is_completed\": \"0\",\n      \"created_at\": \"2016-01-22 07:16:03\",\n      \"updated_at\": \"2016-01-22 07:16:03\"\n      },\n      {\n      \"id\": \"4\",\n      \"exercise_id\": \"Child's Pose\",\n      \"duration\": {\n      \"min\": 38,\n      \"max\": 75\n      },\n      \"unit\": \"seconds\",\n      \"is_completed\": \"0\",\n      \"created_at\": \"2016-01-22 07:16:46\",\n      \"updated_at\": \"2016-01-22 07:16:46\"\n      },\n      {\n      \"id\": \"5\",\n      \"exercise_id\": \"L-sit on the floor\",\n      \"duration\": {\n      \"min\": 38,\n      \"max\": 75\n      },\n      \"unit\": \"seconds\",\n      \"is_completed\": \"0\",\n      \"created_at\": \"2016-01-22 07:17:13\",\n      \"updated_at\": \"2016-01-22 07:17:13\"\n      },\n      {\n      \"id\": \"6\",\n      \"exercise_id\": \"Good morning\",\n      \"duration\": {\n      \"min\": 38,\n      \"max\": 75\n      },\n      \"unit\": \"seconds\",\n      \"is_completed\": \"0\",\n      \"created_at\": \"2016-01-22 07:17:43\",\n      \"updated_at\": \"2016-01-22 07:17:43\"\n      },\n      {\n      \"id\": \"7\",\n      \"exercise_id\": \"Chest Opener\",\n      \"duration\": {\n      \"min\": 38,\n      \"max\": 75\n      },\n      \"unit\": \"seconds\",\n      \"is_completed\": \"0\",\n      \"created_at\": \"2016-01-22 07:19:32\",\n      \"updated_at\": \"2016-01-22 07:19:32\"\n      },\n      {\n      \"id\": \"8\",\n      \"exercise_id\": \"Triceps Stretc\",\n      \"duration\": {\n      \"min\": 38,\n      \"max\": 75\n      },\n      \"unit\": \"seconds\",\n      \"is_completed\": \"0\",\n      \"created_at\": \"2016-01-22 07:19:56\",\n      \"updated_at\": \"2016-01-22 07:19:56\"\n      },\n      {\n      \"id\": \"9\",\n      \"exercise_id\": \"Hands Back\",\n      \"duration\": {\n      \"min\": 38,\n      \"max\": 75\n      },\n      \"unit\": \"seconds\",\n      \"is_completed\": \"0\",\n      \"created_at\": \"2016-01-22 07:20:19\",\n      \"updated_at\": \"2016-01-22 07:20:19\"\n      },\n      {\n      \"id\": \"10\",\n      \"exercise_id\": \"Shoulder Stretch\",\n      \"duration\": {\n      \"min\": 38,\n      \"max\": 75\n      },\n      \"unit\": \"seconds\",\n      \"is_completed\": \"0\",\n      \"created_at\": \"2016-01-22 07:20:45\",\n      \"updated_at\": \"2016-01-22 07:20:45\"\n      }\n      ]\n      },\n      \"day3\": {\n      \"warmup\": [\n      {\n      \"id\": \"1\",\n      \"name\": \"wall extensions\",\n      \"duration\": {\n      \"min\": \"10\",\n      \"max\": \"20\"\n      },\n      \"unit\": \"times\",\n      \"created_at\": \"2016-01-21 08:55:06\",\n      \"updated_at\": \"2016-01-21 08:55:06\",\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"2\",\n      \"name\": \"band dislocates\",\n      \"duration\": {\n      \"min\": \"10\",\n      \"max\": \"20\"\n      },\n      \"unit\": \"times\",\n      \"created_at\": \"2016-01-21 08:57:38\",\n      \"updated_at\": \"2016-01-21 08:57:38\",\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"3\",\n      \"name\": \"cat-camels\",\n      \"duration\": {\n      \"min\": \"10\",\n      \"max\": \"20\"\n      },\n      \"unit\": \"times\",\n      \"created_at\": \"2016-01-21 09:00:39\",\n      \"updated_at\": \"2016-01-21 09:00:39\",\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"4\",\n      \"name\": \"scapular shrugs\",\n      \"duration\": {\n      \"min\": \"10\",\n      \"max\": \"20\"\n      },\n      \"unit\": \"times\",\n      \"created_at\": \"2016-01-21 09:01:01\",\n      \"updated_at\": \"2016-01-21 09:01:01\",\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"5\",\n      \"name\": \"full body circles\",\n      \"duration\": {\n      \"min\": \"10\",\n      \"max\": \"20\"\n      },\n      \"unit\": \"times\",\n      \"created_at\": \"2016-01-21 09:01:26\",\n      \"updated_at\": \"2016-01-21 09:01:26\",\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"6\",\n      \"name\": \"Jumping Jacks\",\n      \"duration\": {\n      \"min\": \"100\",\n      \"max\": \"\"\n      },\n      \"unit\": \"seconds\",\n      \"created_at\": \"2016-01-21 09:04:52\",\n      \"updated_at\": \"2016-01-21 09:04:52\",\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"7\",\n      \"name\": \"Arm rotations\",\n      \"duration\": {\n      \"min\": \"120\",\n      \"max\": \"\"\n      },\n      \"unit\": \"times\",\n      \"created_at\": \"2016-01-21 09:05:29\",\n      \"updated_at\": \"2016-01-21 09:05:29\",\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"8\",\n      \"name\": \"High Knees\",\n      \"duration\": {\n      \"min\": \"50\",\n      \"max\": \"\"\n      },\n      \"unit\": \"times\",\n      \"created_at\": \"2016-01-21 09:06:02\",\n      \"updated_at\": \"2016-01-21 09:06:02\",\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"9\",\n      \"name\": \"Shouder rolls\",\n      \"duration\": {\n      \"min\": \"20\",\n      \"max\": \"\"\n      },\n      \"unit\": \"times\",\n      \"created_at\": \"2016-01-21 09:06:34\",\n      \"updated_at\": \"2016-01-21 09:06:34\",\n      \"is_completed\": 0\n      }\n      ],\n      \"is_completed\": 0,\n      \"fundumentals\": [\n      {\n      \"id\": \"11\",\n      \"row\": \"3\",\n      \"exercise_id\": \"64\",\n      \"duration\": {\n      \"min\": \"10\",\n      \"max\": \"\"\n      },\n      \"unit\": \"times\",\n      \"is_completed\": \"0\",\n      \"created_at\": \"2016-01-22 04:35:13\",\n      \"updated_at\": \"2016-04-04 14:27:54\",\n      \"exercise\": {\n      \"id\": \"64\",\n      \"name\": \"Skin the cat\",\n      \"description\": \"Develop your joints mobility and expose yourself to new movement layers\",\n      \"category\": \"1\",\n      \"type\": \"2\",\n      \"muscle_groups\": \"4,5,6\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \" 1. Hands a little more than shoulder width apart\\r\\n2. Raise your knees to the chest\\r\\n3. continuing the movement until the feet pass up through the arms and over head into an inverted hang position.\\r\\n4. Continue to pass the feet round and down toward the ground into the extended 'skin the cat' position.\\r\\n5. Lift your hips and raise the legs back and over to the starting hang position. \",\n      \"video_tips\": \"        \",\n      \"pro_tips\": \" Put your hands closer together to ease up all back lever progressions.\\r\\nDo only half of the movement in the beginning, but fight for completion over time.\\r\\nIncorporate other static elements to challenge yourself during the movement as you master other skills.\\r\\n    \",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Back, Arms, Core\",\n      \"video\": [\n      {\n      \"id\": \"71\",\n      \"path\": \"64_1454045043.mp4\",\n      \"videothumbnail\": \"64_1454045043.jpg\",\n      \"description\": \"Skin the cat\"\n      }\n      ]\n      }\n      },\n      {\n      \"id\": \"12\",\n      \"row\": \"3\",\n      \"exercise_id\": \"12\",\n      \"duration\": {\n      \"min\": \"20\",\n      \"max\": \"\"\n      },\n      \"unit\": \"times\",\n      \"is_completed\": \"0\",\n      \"created_at\": \"2016-01-22 04:36:16\",\n      \"updated_at\": \"2016-04-04 09:26:06\",\n      \"exercise\": {\n      \"id\": \"12\",\n      \"name\": \"Pushups\",\n      \"description\": \"Perform the most popular exercise of all time with real strength\",\n      \"category\": \"2\",\n      \"type\": \"1\",\n      \"muscle_groups\": \"1,2,3\",\n      \"rewards\": \"7.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \" 1. Lie on the floor face down and place your hands in a standard pushup position.\\r\\n 2. Next, lower yourself downward until your chest almost touches the floor as you inhale.\\r\\n 3. Exhale and press your upper body back up to the starting position while squeezing your chest.\\r\\n 4. Repeat, after a brief pause at the top contracted position.\\r\\n\",\n      \"video_tips\": \"      \",\n      \"pro_tips\": \"Do them extra slow and hold it in highest and lowest position to get strength.\\r\\nOne of the most common push-up mistakes is flaring out the elbows out instead of keeping them at your sides.\\r\\nIf too easy, try Spiderman and Diamond Pushups or wear a weigthed vest.\",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Shoulders, Chest, Triceps\",\n      \"video\": [\n      {\n      \"id\": \"57\",\n      \"path\": \"12_1453984139.mp4\",\n      \"videothumbnail\": \"12_1453984139.jpg\",\n      \"description\": \"Pushups\"\n      }\n      ]\n      }\n      },\n      {\n      \"id\": \"13\",\n      \"row\": \"3\",\n      \"exercise_id\": \"49\",\n      \"duration\": {\n      \"min\": \"30\",\n      \"max\": \"\"\n      },\n      \"unit\": \"times\",\n      \"is_completed\": \"0\",\n      \"created_at\": \"2016-01-22 04:36:49\",\n      \"updated_at\": \"2016-04-04 14:19:29\",\n      \"exercise\": {\n      \"id\": \"49\",\n      \"name\": \"Side Triceps\",\n      \"description\": \"Start with the basics of building triceps strength\",\n      \"category\": \"1\",\n      \"type\": \"1\",\n      \"muscle_groups\": \"3\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \" 1. Start with the body on your side\\r\\n2. Put one hand on your shoulder \\r\\n3. Press up with the other arm and hold in extension \",\n      \"video_tips\": \"          \",\n      \"pro_tips\": \" Avoid supporting the movement with your core muscle.      \",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Triceps\",\n      \"video\": [\n      {\n      \"id\": \"43\",\n      \"path\": \"49_1454043404.mp4\",\n      \"videothumbnail\": \"49_1454043404.jpg\",\n      \"description\": \"Side Triceps\"\n      }\n      ]\n      }\n      },\n      {\n      \"id\": \"14\",\n      \"row\": \"3\",\n      \"exercise_id\": \"4\",\n      \"duration\": {\n      \"min\": \"60\",\n      \"max\": \"90\"\n      },\n      \"unit\": \"seconds\",\n      \"is_completed\": \"0\",\n      \"created_at\": \"2016-01-22 04:37:32\",\n      \"updated_at\": \"2016-04-04 14:02:11\",\n      \"exercise\": {\n      \"id\": \"4\",\n      \"name\": \"Plank\",\n      \"description\": \"The plank builds your isometric strength and helps sculpt your waistline.\",\n      \"category\": \"1\",\n      \"type\": \"1\",\n      \"muscle_groups\": \"1,4,6,8\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"seconds\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \"1. Get into pushup position on the floor.\\r\\n2. Now bend your elbows 90 degrees and rest your weight on your forearms. \\r\\n3. Hold the position for as long as you can.   \",\n      \"video_tips\": \"        \",\n      \"pro_tips\": \"Drive your chest away from the ground and spread your shoulder blades as much as you can.\\r\\nKeep a straight line, from head to toe. \\r\\nDon't collapse your lower back or reach your butt to the sky. Add movement to your plank, rock back and forth on your forearms and toes or shift from side to side.\\r\\nTry advanced variations with alternating sinlge leg support. \\r\\nStart with an incline plank if a straight plank is too hard in the beginning.  \",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Shoulders, Back, Core, Full Body\",\n      \"video\": [\n      {\n      \"id\": \"4\",\n      \"path\": \"4_1453976855.mp4\",\n      \"videothumbnail\": \"4_1453976855.jpg\",\n      \"description\": \"Plank\"\n      }\n      ]\n      }\n      },\n      {\n      \"id\": \"15\",\n      \"row\": \"3\",\n      \"exercise_id\": \"36\",\n      \"duration\": {\n      \"min\": \"20\",\n      \"max\": \"\"\n      },\n      \"unit\": \"times\",\n      \"is_completed\": \"0\",\n      \"created_at\": \"2016-01-22 04:37:57\",\n      \"updated_at\": \"2016-04-04 11:12:49\",\n      \"exercise\": {\n      \"id\": \"36\",\n      \"name\": \"High Jumps\",\n      \"description\": \"Do high jumps as a part of restless HIIT workouts\",\n      \"category\": \"1\",\n      \"type\": \"2\",\n      \"muscle_groups\": \"7\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \"1. Start from a standing position\\r\\n2. Jump up and bring your knees to your chest\",\n      \"video_tips\": \"    \",\n      \"pro_tips\": \"Land softly and exhale when the knees are up.\\r\\n  \",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Legs\",\n      \"video\": [\n      {\n      \"id\": \"33\",\n      \"path\": \"36_1454042273.mp4\",\n      \"videothumbnail\": \"36_1454042273.jpg\",\n      \"description\": \"High Jumps\"\n      }\n      ]\n      }\n      }\n      ],\n      \"exercises\": [],\n      \"workout\": {\n      \"id\": \"9\",\n      \"name\": \"Elli\",\n      \"description\": \"C,A,D\",\n      \"rounds\": \"3\",\n      \"category\": \"2\",\n      \"type\": \"1\",\n      \"rewards\": \"330\",\n      \"duration\": \"420.00\",\n      \"equipments\": \"Bar/Rings\",\n      \"is_completed\": 0,\n      \"exercises\": {\n      \"round1\": [\n      {\n      \"id\": \"325\",\n      \"workout_id\": \"9\",\n      \"category\": \"1\",\n      \"repititions\": \"20\",\n      \"exercise_id\": \"39\",\n      \"unit\": \"times\",\n      \"round\": \"1\",\n      \"created_at\": \"2016-01-19 05:28:43\",\n      \"updated_at\": \"2016-04-04 11:16:09\",\n      \"exercise\": {\n      \"id\": \"39\",\n      \"name\": \"Climbers\",\n      \"description\": \"Increase your energy, health and endurance\",\n      \"category\": \"1\",\n      \"type\": \"2\",\n      \"muscle_groups\": \"7\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \"1. Start in pushup position\\r\\n2. Alternate your legs up to hand level\\r\\n3. Repeat\",\n      \"video_tips\": \"    \",\n      \"pro_tips\": \"If you are new to mountain climbers perform the knee to chest motion slow and steadily then build it up to a faster pace for a better cardio effect.    \",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Legs\"\n      },\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"328\",\n      \"workout_id\": \"9\",\n      \"category\": \"1\",\n      \"repititions\": \"15\",\n      \"exercise_id\": \"66\",\n      \"unit\": \"times\",\n      \"round\": \"1\",\n      \"created_at\": \"2016-01-19 05:29:04\",\n      \"updated_at\": \"2016-04-04 14:31:38\",\n      \"exercise\": {\n      \"id\": \"69\",\n      \"name\": \"Jumping Pullups\",\n      \"description\": \"Expose yourself to packed shoulders and hang time\",\n      \"category\": \"1\",\n      \"type\": \"1\",\n      \"muscle_groups\": \"1,5\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \" 1. Grip a bar and jump into the top position of the pull-up exercise\\r\\n2. Straight legs in front of you. \\r\\n3. Slowly go down into a deadhang position \",\n      \"video_tips\": \"        \",\n      \"pro_tips\": \" A deadhang postion requires your shoulder blades down and towards the spine with arms being straight (retraction)\\r\\nAim for three second holds at the top and go down slowly \",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Shoulders, Arms\"\n      },\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"331\",\n      \"workout_id\": \"9\",\n      \"category\": \"1\",\n      \"repititions\": \"15\",\n      \"exercise_id\": \"22\",\n      \"unit\": \"times\",\n      \"round\": \"1\",\n      \"created_at\": \"2016-01-19 05:29:28\",\n      \"updated_at\": \"2016-04-04 14:09:31\",\n      \"exercise\": {\n      \"id\": \"22\",\n      \"name\": \"Spiderman Pushups\",\n      \"description\": \"Learn to control your body and create body awareness\",\n      \"category\": \"1\",\n      \"type\": \"2\",\n      \"muscle_groups\": \"2,3,5,6\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \"  1. Start in a standard pushup position.\\r\\n 2. Next, lower yourself downward until your chest almost touches the floor as you inhale.\\r\\n 3. Bring your knees to your elbows as you go down and alternate with next repition. \",\n      \"video_tips\": \"      \",\n      \"pro_tips\": \" Pretend you are balancing something on your tailbone as you do the Spiderman pushup to maintain the correct plank position. This keeps your hips from rotating. \",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Chest, Triceps, Arms, Core\"\n      },\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"337\",\n      \"workout_id\": \"9\",\n      \"category\": \"1\",\n      \"repititions\": \"25\",\n      \"exercise_id\": \"57\",\n      \"unit\": \"times\",\n      \"round\": \"1\",\n      \"created_at\": \"2016-01-19 05:30:04\",\n      \"updated_at\": \"2016-04-04 12:10:48\",\n      \"exercise\": {\n      \"id\": \"57\",\n      \"name\": \"Knee Raises\",\n      \"description\": \"Develop grip and core strength and get used to slow and controlled moves\",\n      \"category\": \"1\",\n      \"type\": \"2\",\n      \"muscle_groups\": \"4,6,7\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \"1. Start from a deadhang position with your arms and legs fully extended, and feet off the ground.  \\r\\n2. Raise your knees up towards your chest as high as possible. \\r\\n3. Hold for a brief moment and slowly return to the starting position. \\r\\n4. Repeat for required repetitions. \",\n      \"video_tips\": \"    \",\n      \"pro_tips\": \"Avoid using momentum or swinging during the exercise. \\r\\nPerform the knee raise slowly and controlled.\",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Back, Core, Legs\"\n      },\n      \"is_completed\": 0\n      }\n      ],\n      \"round2\": [\n      {\n      \"id\": \"326\",\n      \"workout_id\": \"9\",\n      \"category\": \"1\",\n      \"repititions\": \"20\",\n      \"exercise_id\": \"39\",\n      \"unit\": \"times\",\n      \"round\": \"2\",\n      \"created_at\": \"2016-01-19 05:28:43\",\n      \"updated_at\": \"2016-04-04 11:16:09\",\n      \"exercise\": {\n      \"id\": \"39\",\n      \"name\": \"Climbers\",\n      \"description\": \"Increase your energy, health and endurance\",\n      \"category\": \"1\",\n      \"type\": \"2\",\n      \"muscle_groups\": \"7\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \"1. Start in pushup position\\r\\n2. Alternate your legs up to hand level\\r\\n3. Repeat\",\n      \"video_tips\": \"    \",\n      \"pro_tips\": \"If you are new to mountain climbers perform the knee to chest motion slow and steadily then build it up to a faster pace for a better cardio effect.    \",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Legs\"\n      },\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"329\",\n      \"workout_id\": \"9\",\n      \"category\": \"1\",\n      \"repititions\": \"15\",\n      \"exercise_id\": \"66\",\n      \"unit\": \"times\",\n      \"round\": \"2\",\n      \"created_at\": \"2016-01-19 05:29:05\",\n      \"updated_at\": \"2016-04-04 14:31:38\",\n      \"exercise\": {\n      \"id\": \"69\",\n      \"name\": \"Jumping Pullups\",\n      \"description\": \"Expose yourself to packed shoulders and hang time\",\n      \"category\": \"1\",\n      \"type\": \"1\",\n      \"muscle_groups\": \"1,5\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \" 1. Grip a bar and jump into the top position of the pull-up exercise\\r\\n2. Straight legs in front of you. \\r\\n3. Slowly go down into a deadhang position \",\n      \"video_tips\": \"        \",\n      \"pro_tips\": \" A deadhang postion requires your shoulder blades down and towards the spine with arms being straight (retraction)\\r\\nAim for three second holds at the top and go down slowly \",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Shoulders, Arms\"\n      },\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"332\",\n      \"workout_id\": \"9\",\n      \"category\": \"1\",\n      \"repititions\": \"15\",\n      \"exercise_id\": \"22\",\n      \"unit\": \"times\",\n      \"round\": \"2\",\n      \"created_at\": \"2016-01-19 05:29:28\",\n      \"updated_at\": \"2016-04-04 14:09:31\",\n      \"exercise\": {\n      \"id\": \"22\",\n      \"name\": \"Spiderman Pushups\",\n      \"description\": \"Learn to control your body and create body awareness\",\n      \"category\": \"1\",\n      \"type\": \"2\",\n      \"muscle_groups\": \"2,3,5,6\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \"  1. Start in a standard pushup position.\\r\\n 2. Next, lower yourself downward until your chest almost touches the floor as you inhale.\\r\\n 3. Bring your knees to your elbows as you go down and alternate with next repition. \",\n      \"video_tips\": \"      \",\n      \"pro_tips\": \" Pretend you are balancing something on your tailbone as you do the Spiderman pushup to maintain the correct plank position. This keeps your hips from rotating. \",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Chest, Triceps, Arms, Core\"\n      },\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"338\",\n      \"workout_id\": \"9\",\n      \"category\": \"1\",\n      \"repititions\": \"25\",\n      \"exercise_id\": \"57\",\n      \"unit\": \"times\",\n      \"round\": \"2\",\n      \"created_at\": \"2016-01-19 05:30:04\",\n      \"updated_at\": \"2016-04-04 12:10:48\",\n      \"exercise\": {\n      \"id\": \"57\",\n      \"name\": \"Knee Raises\",\n      \"description\": \"Develop grip and core strength and get used to slow and controlled moves\",\n      \"category\": \"1\",\n      \"type\": \"2\",\n      \"muscle_groups\": \"4,6,7\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \"1. Start from a deadhang position with your arms and legs fully extended, and feet off the ground.  \\r\\n2. Raise your knees up towards your chest as high as possible. \\r\\n3. Hold for a brief moment and slowly return to the starting position. \\r\\n4. Repeat for required repetitions. \",\n      \"video_tips\": \"    \",\n      \"pro_tips\": \"Avoid using momentum or swinging during the exercise. \\r\\nPerform the knee raise slowly and controlled.\",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Back, Core, Legs\"\n      },\n      \"is_completed\": 0\n      }\n      ],\n      \"round3\": [\n      {\n      \"id\": \"327\",\n      \"workout_id\": \"9\",\n      \"category\": \"1\",\n      \"repititions\": \"20\",\n      \"exercise_id\": \"39\",\n      \"unit\": \"times\",\n      \"round\": \"3\",\n      \"created_at\": \"2016-01-19 05:28:43\",\n      \"updated_at\": \"2016-04-04 11:16:09\",\n      \"exercise\": {\n      \"id\": \"39\",\n      \"name\": \"Climbers\",\n      \"description\": \"Increase your energy, health and endurance\",\n      \"category\": \"1\",\n      \"type\": \"2\",\n      \"muscle_groups\": \"7\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \"1. Start in pushup position\\r\\n2. Alternate your legs up to hand level\\r\\n3. Repeat\",\n      \"video_tips\": \"    \",\n      \"pro_tips\": \"If you are new to mountain climbers perform the knee to chest motion slow and steadily then build it up to a faster pace for a better cardio effect.    \",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Legs\"\n      },\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"330\",\n      \"workout_id\": \"9\",\n      \"category\": \"1\",\n      \"repititions\": \"15\",\n      \"exercise_id\": \"66\",\n      \"unit\": \"times\",\n      \"round\": \"3\",\n      \"created_at\": \"2016-01-19 05:29:05\",\n      \"updated_at\": \"2016-04-04 14:31:38\",\n      \"exercise\": {\n      \"id\": \"69\",\n      \"name\": \"Jumping Pullups\",\n      \"description\": \"Expose yourself to packed shoulders and hang time\",\n      \"category\": \"1\",\n      \"type\": \"1\",\n      \"muscle_groups\": \"1,5\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \" 1. Grip a bar and jump into the top position of the pull-up exercise\\r\\n2. Straight legs in front of you. \\r\\n3. Slowly go down into a deadhang position \",\n      \"video_tips\": \"        \",\n      \"pro_tips\": \" A deadhang postion requires your shoulder blades down and towards the spine with arms being straight (retraction)\\r\\nAim for three second holds at the top and go down slowly \",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Shoulders, Arms\"\n      },\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"333\",\n      \"workout_id\": \"9\",\n      \"category\": \"1\",\n      \"repititions\": \"15\",\n      \"exercise_id\": \"22\",\n      \"unit\": \"times\",\n      \"round\": \"3\",\n      \"created_at\": \"2016-01-19 05:29:28\",\n      \"updated_at\": \"2016-04-04 14:09:31\",\n      \"exercise\": {\n      \"id\": \"22\",\n      \"name\": \"Spiderman Pushups\",\n      \"description\": \"Learn to control your body and create body awareness\",\n      \"category\": \"1\",\n      \"type\": \"2\",\n      \"muscle_groups\": \"2,3,5,6\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \"  1. Start in a standard pushup position.\\r\\n 2. Next, lower yourself downward until your chest almost touches the floor as you inhale.\\r\\n 3. Bring your knees to your elbows as you go down and alternate with next repition. \",\n      \"video_tips\": \"      \",\n      \"pro_tips\": \" Pretend you are balancing something on your tailbone as you do the Spiderman pushup to maintain the correct plank position. This keeps your hips from rotating. \",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Chest, Triceps, Arms, Core\"\n      },\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"339\",\n      \"workout_id\": \"9\",\n      \"category\": \"1\",\n      \"repititions\": \"25\",\n      \"exercise_id\": \"57\",\n      \"unit\": \"times\",\n      \"round\": \"3\",\n      \"created_at\": \"2016-01-19 05:30:04\",\n      \"updated_at\": \"2016-04-04 12:10:48\",\n      \"exercise\": {\n      \"id\": \"57\",\n      \"name\": \"Knee Raises\",\n      \"description\": \"Develop grip and core strength and get used to slow and controlled moves\",\n      \"category\": \"1\",\n      \"type\": \"2\",\n      \"muscle_groups\": \"4,6,7\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \"1. Start from a deadhang position with your arms and legs fully extended, and feet off the ground.  \\r\\n2. Raise your knees up towards your chest as high as possible. \\r\\n3. Hold for a brief moment and slowly return to the starting position. \\r\\n4. Repeat for required repetitions. \",\n      \"video_tips\": \"    \",\n      \"pro_tips\": \"Avoid using momentum or swinging during the exercise. \\r\\nPerform the knee raise slowly and controlled.\",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Back, Core, Legs\"\n      },\n      \"is_completed\": 0\n      }\n      ]\n      },\n      \"exercise_category\": 1\n      },\n      \"coach_workout_rounds\": 3,\n      \"workout_intensity\": 1,\n      \"hiit\": [],\n      \"stretching\": [\n      {\n      \"id\": \"1\",\n      \"exercise_id\": \"Superman\",\n      \"duration\": {\n      \"min\": 6,\n      \"max\": 13\n      },\n      \"unit\": \"times\",\n      \"is_completed\": \"0\",\n      \"created_at\": \"2016-01-22 07:10:31\",\n      \"updated_at\": \"2016-01-22 07:10:31\"\n      },\n      {\n      \"id\": \"2\",\n      \"exercise_id\": \"Lower Back Strength\",\n      \"duration\": {\n      \"min\": 38,\n      \"max\": 63\n      },\n      \"unit\": \"times\",\n      \"is_completed\": \"0\",\n      \"created_at\": \"2016-01-22 07:15:02\",\n      \"updated_at\": \"2016-01-22 07:15:02\"\n      },\n      {\n      \"id\": \"3\",\n      \"exercise_id\": \"Upper Dog\",\n      \"duration\": {\n      \"min\": 38,\n      \"max\": 75\n      },\n      \"unit\": \"seconds\",\n      \"is_completed\": \"0\",\n      \"created_at\": \"2016-01-22 07:16:03\",\n      \"updated_at\": \"2016-01-22 07:16:03\"\n      },\n      {\n      \"id\": \"4\",\n      \"exercise_id\": \"Child's Pose\",\n      \"duration\": {\n      \"min\": 38,\n      \"max\": 75\n      },\n      \"unit\": \"seconds\",\n      \"is_completed\": \"0\",\n      \"created_at\": \"2016-01-22 07:16:46\",\n      \"updated_at\": \"2016-01-22 07:16:46\"\n      },\n      {\n      \"id\": \"5\",\n      \"exercise_id\": \"L-sit on the floor\",\n      \"duration\": {\n      \"min\": 38,\n      \"max\": 75\n      },\n      \"unit\": \"seconds\",\n      \"is_completed\": \"0\",\n      \"created_at\": \"2016-01-22 07:17:13\",\n      \"updated_at\": \"2016-01-22 07:17:13\"\n      },\n      {\n      \"id\": \"6\",\n      \"exercise_id\": \"Good morning\",\n      \"duration\": {\n      \"min\": 38,\n      \"max\": 75\n      },\n      \"unit\": \"seconds\",\n      \"is_completed\": \"0\",\n      \"created_at\": \"2016-01-22 07:17:43\",\n      \"updated_at\": \"2016-01-22 07:17:43\"\n      },\n      {\n      \"id\": \"7\",\n      \"exercise_id\": \"Chest Opener\",\n      \"duration\": {\n      \"min\": 38,\n      \"max\": 75\n      },\n      \"unit\": \"seconds\",\n      \"is_completed\": \"0\",\n      \"created_at\": \"2016-01-22 07:19:32\",\n      \"updated_at\": \"2016-01-22 07:19:32\"\n      },\n      {\n      \"id\": \"8\",\n      \"exercise_id\": \"Triceps Stretc\",\n      \"duration\": {\n      \"min\": 38,\n      \"max\": 75\n      },\n      \"unit\": \"seconds\",\n      \"is_completed\": \"0\",\n      \"created_at\": \"2016-01-22 07:19:56\",\n      \"updated_at\": \"2016-01-22 07:19:56\"\n      },\n      {\n      \"id\": \"9\",\n      \"exercise_id\": \"Hands Back\",\n      \"duration\": {\n      \"min\": 38,\n      \"max\": 75\n      },\n      \"unit\": \"seconds\",\n      \"is_completed\": \"0\",\n      \"created_at\": \"2016-01-22 07:20:19\",\n      \"updated_at\": \"2016-01-22 07:20:19\"\n      },\n      {\n      \"id\": \"10\",\n      \"exercise_id\": \"Shoulder Stretch\",\n      \"duration\": {\n      \"min\": 38,\n      \"max\": 75\n      },\n      \"unit\": \"seconds\",\n      \"is_completed\": \"0\",\n      \"created_at\": \"2016-01-22 07:20:45\",\n      \"updated_at\": \"2016-01-22 07:20:45\"\n      }\n      ]\n      },\n      \"day4\": {\n      \"warmup\": [\n      {\n      \"id\": \"1\",\n      \"name\": \"wall extensions\",\n      \"duration\": {\n      \"min\": \"10\",\n      \"max\": \"20\"\n      },\n      \"unit\": \"times\",\n      \"created_at\": \"2016-01-21 08:55:06\",\n      \"updated_at\": \"2016-01-21 08:55:06\",\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"2\",\n      \"name\": \"band dislocates\",\n      \"duration\": {\n      \"min\": \"10\",\n      \"max\": \"20\"\n      },\n      \"unit\": \"times\",\n      \"created_at\": \"2016-01-21 08:57:38\",\n      \"updated_at\": \"2016-01-21 08:57:38\",\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"3\",\n      \"name\": \"cat-camels\",\n      \"duration\": {\n      \"min\": \"10\",\n      \"max\": \"20\"\n      },\n      \"unit\": \"times\",\n      \"created_at\": \"2016-01-21 09:00:39\",\n      \"updated_at\": \"2016-01-21 09:00:39\",\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"4\",\n      \"name\": \"scapular shrugs\",\n      \"duration\": {\n      \"min\": \"10\",\n      \"max\": \"20\"\n      },\n      \"unit\": \"times\",\n      \"created_at\": \"2016-01-21 09:01:01\",\n      \"updated_at\": \"2016-01-21 09:01:01\",\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"5\",\n      \"name\": \"full body circles\",\n      \"duration\": {\n      \"min\": \"10\",\n      \"max\": \"20\"\n      },\n      \"unit\": \"times\",\n      \"created_at\": \"2016-01-21 09:01:26\",\n      \"updated_at\": \"2016-01-21 09:01:26\",\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"6\",\n      \"name\": \"Jumping Jacks\",\n      \"duration\": {\n      \"min\": \"100\",\n      \"max\": \"\"\n      },\n      \"unit\": \"seconds\",\n      \"created_at\": \"2016-01-21 09:04:52\",\n      \"updated_at\": \"2016-01-21 09:04:52\",\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"7\",\n      \"name\": \"Arm rotations\",\n      \"duration\": {\n      \"min\": \"120\",\n      \"max\": \"\"\n      },\n      \"unit\": \"times\",\n      \"created_at\": \"2016-01-21 09:05:29\",\n      \"updated_at\": \"2016-01-21 09:05:29\",\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"8\",\n      \"name\": \"High Knees\",\n      \"duration\": {\n      \"min\": \"50\",\n      \"max\": \"\"\n      },\n      \"unit\": \"times\",\n      \"created_at\": \"2016-01-21 09:06:02\",\n      \"updated_at\": \"2016-01-21 09:06:02\",\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"9\",\n      \"name\": \"Shouder rolls\",\n      \"duration\": {\n      \"min\": \"20\",\n      \"max\": \"\"\n      },\n      \"unit\": \"times\",\n      \"created_at\": \"2016-01-21 09:06:34\",\n      \"updated_at\": \"2016-01-21 09:06:34\",\n      \"is_completed\": 0\n      }\n      ],\n      \"is_completed\": 0,\n      \"fundumentals\": [\n      {\n      \"id\": \"11\",\n      \"row\": \"3\",\n      \"exercise_id\": \"64\",\n      \"duration\": {\n      \"min\": \"10\",\n      \"max\": \"\"\n      },\n      \"unit\": \"times\",\n      \"is_completed\": \"0\",\n      \"created_at\": \"2016-01-22 04:35:13\",\n      \"updated_at\": \"2016-04-04 14:27:54\",\n      \"exercise\": {\n      \"id\": \"64\",\n      \"name\": \"Skin the cat\",\n      \"description\": \"Develop your joints mobility and expose yourself to new movement layers\",\n      \"category\": \"1\",\n      \"type\": \"2\",\n      \"muscle_groups\": \"4,5,6\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \" 1. Hands a little more than shoulder width apart\\r\\n2. Raise your knees to the chest\\r\\n3. continuing the movement until the feet pass up through the arms and over head into an inverted hang position.\\r\\n4. Continue to pass the feet round and down toward the ground into the extended 'skin the cat' position.\\r\\n5. Lift your hips and raise the legs back and over to the starting hang position. \",\n      \"video_tips\": \"        \",\n      \"pro_tips\": \" Put your hands closer together to ease up all back lever progressions.\\r\\nDo only half of the movement in the beginning, but fight for completion over time.\\r\\nIncorporate other static elements to challenge yourself during the movement as you master other skills.\\r\\n    \",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Back, Arms, Core\",\n      \"video\": [\n      {\n      \"id\": \"71\",\n      \"path\": \"64_1454045043.mp4\",\n      \"videothumbnail\": \"64_1454045043.jpg\",\n      \"description\": \"Skin the cat\"\n      }\n      ]\n      }\n      },\n      {\n      \"id\": \"12\",\n      \"row\": \"3\",\n      \"exercise_id\": \"12\",\n      \"duration\": {\n      \"min\": \"20\",\n      \"max\": \"\"\n      },\n      \"unit\": \"times\",\n      \"is_completed\": \"0\",\n      \"created_at\": \"2016-01-22 04:36:16\",\n      \"updated_at\": \"2016-04-04 09:26:06\",\n      \"exercise\": {\n      \"id\": \"12\",\n      \"name\": \"Pushups\",\n      \"description\": \"Perform the most popular exercise of all time with real strength\",\n      \"category\": \"2\",\n      \"type\": \"1\",\n      \"muscle_groups\": \"1,2,3\",\n      \"rewards\": \"7.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \" 1. Lie on the floor face down and place your hands in a standard pushup position.\\r\\n 2. Next, lower yourself downward until your chest almost touches the floor as you inhale.\\r\\n 3. Exhale and press your upper body back up to the starting position while squeezing your chest.\\r\\n 4. Repeat, after a brief pause at the top contracted position.\\r\\n\",\n      \"video_tips\": \"      \",\n      \"pro_tips\": \"Do them extra slow and hold it in highest and lowest position to get strength.\\r\\nOne of the most common push-up mistakes is flaring out the elbows out instead of keeping them at your sides.\\r\\nIf too easy, try Spiderman and Diamond Pushups or wear a weigthed vest.\",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Shoulders, Chest, Triceps\",\n      \"video\": [\n      {\n      \"id\": \"57\",\n      \"path\": \"12_1453984139.mp4\",\n      \"videothumbnail\": \"12_1453984139.jpg\",\n      \"description\": \"Pushups\"\n      }\n      ]\n      }\n      },\n      {\n      \"id\": \"13\",\n      \"row\": \"3\",\n      \"exercise_id\": \"49\",\n      \"duration\": {\n      \"min\": \"30\",\n      \"max\": \"\"\n      },\n      \"unit\": \"times\",\n      \"is_completed\": \"0\",\n      \"created_at\": \"2016-01-22 04:36:49\",\n      \"updated_at\": \"2016-04-04 14:19:29\",\n      \"exercise\": {\n      \"id\": \"49\",\n      \"name\": \"Side Triceps\",\n      \"description\": \"Start with the basics of building triceps strength\",\n      \"category\": \"1\",\n      \"type\": \"1\",\n      \"muscle_groups\": \"3\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \" 1. Start with the body on your side\\r\\n2. Put one hand on your shoulder \\r\\n3. Press up with the other arm and hold in extension \",\n      \"video_tips\": \"          \",\n      \"pro_tips\": \" Avoid supporting the movement with your core muscle.      \",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Triceps\",\n      \"video\": [\n      {\n      \"id\": \"43\",\n      \"path\": \"49_1454043404.mp4\",\n      \"videothumbnail\": \"49_1454043404.jpg\",\n      \"description\": \"Side Triceps\"\n      }\n      ]\n      }\n      },\n      {\n      \"id\": \"14\",\n      \"row\": \"3\",\n      \"exercise_id\": \"4\",\n      \"duration\": {\n      \"min\": \"60\",\n      \"max\": \"90\"\n      },\n      \"unit\": \"seconds\",\n      \"is_completed\": \"0\",\n      \"created_at\": \"2016-01-22 04:37:32\",\n      \"updated_at\": \"2016-04-04 14:02:11\",\n      \"exercise\": {\n      \"id\": \"4\",\n      \"name\": \"Plank\",\n      \"description\": \"The plank builds your isometric strength and helps sculpt your waistline.\",\n      \"category\": \"1\",\n      \"type\": \"1\",\n      \"muscle_groups\": \"1,4,6,8\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"seconds\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \"1. Get into pushup position on the floor.\\r\\n2. Now bend your elbows 90 degrees and rest your weight on your forearms. \\r\\n3. Hold the position for as long as you can.   \",\n      \"video_tips\": \"        \",\n      \"pro_tips\": \"Drive your chest away from the ground and spread your shoulder blades as much as you can.\\r\\nKeep a straight line, from head to toe. \\r\\nDon't collapse your lower back or reach your butt to the sky. Add movement to your plank, rock back and forth on your forearms and toes or shift from side to side.\\r\\nTry advanced variations with alternating sinlge leg support. \\r\\nStart with an incline plank if a straight plank is too hard in the beginning.  \",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Shoulders, Back, Core, Full Body\",\n      \"video\": [\n      {\n      \"id\": \"4\",\n      \"path\": \"4_1453976855.mp4\",\n      \"videothumbnail\": \"4_1453976855.jpg\",\n      \"description\": \"Plank\"\n      }\n      ]\n      }\n      },\n      {\n      \"id\": \"15\",\n      \"row\": \"3\",\n      \"exercise_id\": \"36\",\n      \"duration\": {\n      \"min\": \"20\",\n      \"max\": \"\"\n      },\n      \"unit\": \"times\",\n      \"is_completed\": \"0\",\n      \"created_at\": \"2016-01-22 04:37:57\",\n      \"updated_at\": \"2016-04-04 11:12:49\",\n      \"exercise\": {\n      \"id\": \"36\",\n      \"name\": \"High Jumps\",\n      \"description\": \"Do high jumps as a part of restless HIIT workouts\",\n      \"category\": \"1\",\n      \"type\": \"2\",\n      \"muscle_groups\": \"7\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \"1. Start from a standing position\\r\\n2. Jump up and bring your knees to your chest\",\n      \"video_tips\": \"    \",\n      \"pro_tips\": \"Land softly and exhale when the knees are up.\\r\\n  \",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Legs\",\n      \"video\": [\n      {\n      \"id\": \"33\",\n      \"path\": \"36_1454042273.mp4\",\n      \"videothumbnail\": \"36_1454042273.jpg\",\n      \"description\": \"High Jumps\"\n      }\n      ]\n      }\n      }\n      ],\n      \"exercises\": [],\n      \"workout\": {\n      \"id\": \"1\",\n      \"name\": \"Baldur\",\n      \"description\": \"A,D,B\",\n      \"rounds\": \"5\",\n      \"category\": \"1\",\n      \"type\": \"2\",\n      \"rewards\": \"440\",\n      \"duration\": \"2380.00\",\n      \"equipments\": \"Bar/Rings, Paralettes/Rings\",\n      \"is_completed\": 0,\n      \"exercises\": {\n      \"round1\": [\n      {\n      \"id\": \"1\",\n      \"workout_id\": \"1\",\n      \"category\": \"1\",\n      \"repititions\": \"10\",\n      \"exercise_id\": \"66\",\n      \"unit\": \"times\",\n      \"round\": \"1\",\n      \"created_at\": \"2016-01-19 03:15:36\",\n      \"updated_at\": \"2016-04-04 14:31:38\",\n      \"exercise\": {\n      \"id\": \"69\",\n      \"name\": \"Jumping Pullups\",\n      \"description\": \"Expose yourself to packed shoulders and hang time\",\n      \"category\": \"1\",\n      \"type\": \"1\",\n      \"muscle_groups\": \"1,5\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \" 1. Grip a bar and jump into the top position of the pull-up exercise\\r\\n2. Straight legs in front of you. \\r\\n3. Slowly go down into a deadhang position \",\n      \"video_tips\": \"        \",\n      \"pro_tips\": \" A deadhang postion requires your shoulder blades down and towards the spine with arms being straight (retraction)\\r\\nAim for three second holds at the top and go down slowly \",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Shoulders, Arms\"\n      },\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"6\",\n      \"workout_id\": \"1\",\n      \"category\": \"1\",\n      \"repititions\": \"10\",\n      \"exercise_id\": \"22\",\n      \"unit\": \"times\",\n      \"round\": \"1\",\n      \"created_at\": \"2016-01-19 03:17:21\",\n      \"updated_at\": \"2016-04-04 14:09:31\",\n      \"exercise\": {\n      \"id\": \"22\",\n      \"name\": \"Spiderman Pushups\",\n      \"description\": \"Learn to control your body and create body awareness\",\n      \"category\": \"1\",\n      \"type\": \"2\",\n      \"muscle_groups\": \"2,3,5,6\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \"  1. Start in a standard pushup position.\\r\\n 2. Next, lower yourself downward until your chest almost touches the floor as you inhale.\\r\\n 3. Bring your knees to your elbows as you go down and alternate with next repition. \",\n      \"video_tips\": \"      \",\n      \"pro_tips\": \" Pretend you are balancing something on your tailbone as you do the Spiderman pushup to maintain the correct plank position. This keeps your hips from rotating. \",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Chest, Triceps, Arms, Core\"\n      },\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"11\",\n      \"workout_id\": \"1\",\n      \"category\": \"1\",\n      \"repititions\": \"10\",\n      \"exercise_id\": \"49\",\n      \"unit\": \"times\",\n      \"round\": \"1\",\n      \"created_at\": \"2016-01-19 03:19:02\",\n      \"updated_at\": \"2016-04-04 14:19:29\",\n      \"exercise\": {\n      \"id\": \"49\",\n      \"name\": \"Side Triceps\",\n      \"description\": \"Start with the basics of building triceps strength\",\n      \"category\": \"1\",\n      \"type\": \"1\",\n      \"muscle_groups\": \"3\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \" 1. Start with the body on your side\\r\\n2. Put one hand on your shoulder \\r\\n3. Press up with the other arm and hold in extension \",\n      \"video_tips\": \"          \",\n      \"pro_tips\": \" Avoid supporting the movement with your core muscle.      \",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Triceps\"\n      },\n      \"is_completed\": 0\n      }\n      ],\n      \"round2\": [\n      {\n      \"id\": \"3\",\n      \"workout_id\": \"1\",\n      \"category\": \"1\",\n      \"repititions\": \"20\",\n      \"exercise_id\": \"66\",\n      \"unit\": \"times\",\n      \"round\": \"2\",\n      \"created_at\": \"2016-01-19 03:16:17\",\n      \"updated_at\": \"2016-04-04 14:31:38\",\n      \"exercise\": {\n      \"id\": \"69\",\n      \"name\": \"Jumping Pullups\",\n      \"description\": \"Expose yourself to packed shoulders and hang time\",\n      \"category\": \"1\",\n      \"type\": \"1\",\n      \"muscle_groups\": \"1,5\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \" 1. Grip a bar and jump into the top position of the pull-up exercise\\r\\n2. Straight legs in front of you. \\r\\n3. Slowly go down into a deadhang position \",\n      \"video_tips\": \"        \",\n      \"pro_tips\": \" A deadhang postion requires your shoulder blades down and towards the spine with arms being straight (retraction)\\r\\nAim for three second holds at the top and go down slowly \",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Shoulders, Arms\"\n      },\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"8\",\n      \"workout_id\": \"1\",\n      \"category\": \"1\",\n      \"repititions\": \"20\",\n      \"exercise_id\": \"22\",\n      \"unit\": \"times\",\n      \"round\": \"2\",\n      \"created_at\": \"2016-01-19 03:17:54\",\n      \"updated_at\": \"2016-04-04 14:09:31\",\n      \"exercise\": {\n      \"id\": \"22\",\n      \"name\": \"Spiderman Pushups\",\n      \"description\": \"Learn to control your body and create body awareness\",\n      \"category\": \"1\",\n      \"type\": \"2\",\n      \"muscle_groups\": \"2,3,5,6\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \"  1. Start in a standard pushup position.\\r\\n 2. Next, lower yourself downward until your chest almost touches the floor as you inhale.\\r\\n 3. Bring your knees to your elbows as you go down and alternate with next repition. \",\n      \"video_tips\": \"      \",\n      \"pro_tips\": \" Pretend you are balancing something on your tailbone as you do the Spiderman pushup to maintain the correct plank position. This keeps your hips from rotating. \",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Chest, Triceps, Arms, Core\"\n      },\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"13\",\n      \"workout_id\": \"1\",\n      \"category\": \"1\",\n      \"repititions\": \"20\",\n      \"exercise_id\": \"49\",\n      \"unit\": \"times\",\n      \"round\": \"2\",\n      \"created_at\": \"2016-01-19 03:19:23\",\n      \"updated_at\": \"2016-04-04 14:19:29\",\n      \"exercise\": {\n      \"id\": \"49\",\n      \"name\": \"Side Triceps\",\n      \"description\": \"Start with the basics of building triceps strength\",\n      \"category\": \"1\",\n      \"type\": \"1\",\n      \"muscle_groups\": \"3\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \" 1. Start with the body on your side\\r\\n2. Put one hand on your shoulder \\r\\n3. Press up with the other arm and hold in extension \",\n      \"video_tips\": \"          \",\n      \"pro_tips\": \" Avoid supporting the movement with your core muscle.      \",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Triceps\"\n      },\n      \"is_completed\": 0\n      }\n      ],\n      \"round3\": [\n      {\n      \"id\": \"5\",\n      \"workout_id\": \"1\",\n      \"category\": \"1\",\n      \"repititions\": \"30\",\n      \"exercise_id\": \"66\",\n      \"unit\": \"times\",\n      \"round\": \"3\",\n      \"created_at\": \"2016-01-19 03:16:40\",\n      \"updated_at\": \"2016-04-04 14:31:38\",\n      \"exercise\": {\n      \"id\": \"69\",\n      \"name\": \"Jumping Pullups\",\n      \"description\": \"Expose yourself to packed shoulders and hang time\",\n      \"category\": \"1\",\n      \"type\": \"1\",\n      \"muscle_groups\": \"1,5\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \" 1. Grip a bar and jump into the top position of the pull-up exercise\\r\\n2. Straight legs in front of you. \\r\\n3. Slowly go down into a deadhang position \",\n      \"video_tips\": \"        \",\n      \"pro_tips\": \" A deadhang postion requires your shoulder blades down and towards the spine with arms being straight (retraction)\\r\\nAim for three second holds at the top and go down slowly \",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Shoulders, Arms\"\n      },\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"10\",\n      \"workout_id\": \"1\",\n      \"category\": \"1\",\n      \"repititions\": \"30\",\n      \"exercise_id\": \"22\",\n      \"unit\": \"times\",\n      \"round\": \"3\",\n      \"created_at\": \"2016-01-19 03:18:11\",\n      \"updated_at\": \"2016-04-04 14:09:31\",\n      \"exercise\": {\n      \"id\": \"22\",\n      \"name\": \"Spiderman Pushups\",\n      \"description\": \"Learn to control your body and create body awareness\",\n      \"category\": \"1\",\n      \"type\": \"2\",\n      \"muscle_groups\": \"2,3,5,6\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \"  1. Start in a standard pushup position.\\r\\n 2. Next, lower yourself downward until your chest almost touches the floor as you inhale.\\r\\n 3. Bring your knees to your elbows as you go down and alternate with next repition. \",\n      \"video_tips\": \"      \",\n      \"pro_tips\": \" Pretend you are balancing something on your tailbone as you do the Spiderman pushup to maintain the correct plank position. This keeps your hips from rotating. \",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Chest, Triceps, Arms, Core\"\n      },\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"15\",\n      \"workout_id\": \"1\",\n      \"category\": \"1\",\n      \"repititions\": \"30\",\n      \"exercise_id\": \"49\",\n      \"unit\": \"times\",\n      \"round\": \"3\",\n      \"created_at\": \"2016-01-19 03:19:48\",\n      \"updated_at\": \"2016-04-04 14:19:29\",\n      \"exercise\": {\n      \"id\": \"49\",\n      \"name\": \"Side Triceps\",\n      \"description\": \"Start with the basics of building triceps strength\",\n      \"category\": \"1\",\n      \"type\": \"1\",\n      \"muscle_groups\": \"3\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \" 1. Start with the body on your side\\r\\n2. Put one hand on your shoulder \\r\\n3. Press up with the other arm and hold in extension \",\n      \"video_tips\": \"          \",\n      \"pro_tips\": \" Avoid supporting the movement with your core muscle.      \",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Triceps\"\n      },\n      \"is_completed\": 0\n      }\n      ]\n      },\n      \"exercise_category\": 1\n      },\n      \"coach_workout_rounds\": 3,\n      \"workout_intensity\": 1,\n      \"hiit\": [],\n      \"stretching\": [\n      {\n      \"id\": \"1\",\n      \"exercise_id\": \"Superman\",\n      \"duration\": {\n      \"min\": 6,\n      \"max\": 13\n      },\n      \"unit\": \"times\",\n      \"is_completed\": \"0\",\n      \"created_at\": \"2016-01-22 07:10:31\",\n      \"updated_at\": \"2016-01-22 07:10:31\"\n      },\n      {\n      \"id\": \"2\",\n      \"exercise_id\": \"Lower Back Strength\",\n      \"duration\": {\n      \"min\": 38,\n      \"max\": 63\n      },\n      \"unit\": \"times\",\n      \"is_completed\": \"0\",\n      \"created_at\": \"2016-01-22 07:15:02\",\n      \"updated_at\": \"2016-01-22 07:15:02\"\n      },\n      {\n      \"id\": \"3\",\n      \"exercise_id\": \"Upper Dog\",\n      \"duration\": {\n      \"min\": 38,\n      \"max\": 75\n      },\n      \"unit\": \"seconds\",\n      \"is_completed\": \"0\",\n      \"created_at\": \"2016-01-22 07:16:03\",\n      \"updated_at\": \"2016-01-22 07:16:03\"\n      },\n      {\n      \"id\": \"4\",\n      \"exercise_id\": \"Child's Pose\",\n      \"duration\": {\n      \"min\": 38,\n      \"max\": 75\n      },\n      \"unit\": \"seconds\",\n      \"is_completed\": \"0\",\n      \"created_at\": \"2016-01-22 07:16:46\",\n      \"updated_at\": \"2016-01-22 07:16:46\"\n      },\n      {\n      \"id\": \"5\",\n      \"exercise_id\": \"L-sit on the floor\",\n      \"duration\": {\n      \"min\": 38,\n      \"max\": 75\n      },\n      \"unit\": \"seconds\",\n      \"is_completed\": \"0\",\n      \"created_at\": \"2016-01-22 07:17:13\",\n      \"updated_at\": \"2016-01-22 07:17:13\"\n      },\n      {\n      \"id\": \"6\",\n      \"exercise_id\": \"Good morning\",\n      \"duration\": {\n      \"min\": 38,\n      \"max\": 75\n      },\n      \"unit\": \"seconds\",\n      \"is_completed\": \"0\",\n      \"created_at\": \"2016-01-22 07:17:43\",\n      \"updated_at\": \"2016-01-22 07:17:43\"\n      },\n      {\n      \"id\": \"7\",\n      \"exercise_id\": \"Chest Opener\",\n      \"duration\": {\n      \"min\": 38,\n      \"max\": 75\n      },\n      \"unit\": \"seconds\",\n      \"is_completed\": \"0\",\n      \"created_at\": \"2016-01-22 07:19:32\",\n      \"updated_at\": \"2016-01-22 07:19:32\"\n      },\n      {\n      \"id\": \"8\",\n      \"exercise_id\": \"Triceps Stretc\",\n      \"duration\": {\n      \"min\": 38,\n      \"max\": 75\n      },\n      \"unit\": \"seconds\",\n      \"is_completed\": \"0\",\n      \"created_at\": \"2016-01-22 07:19:56\",\n      \"updated_at\": \"2016-01-22 07:19:56\"\n      },\n      {\n      \"id\": \"9\",\n      \"exercise_id\": \"Hands Back\",\n      \"duration\": {\n      \"min\": 38,\n      \"max\": 75\n      },\n      \"unit\": \"seconds\",\n      \"is_completed\": \"0\",\n      \"created_at\": \"2016-01-22 07:20:19\",\n      \"updated_at\": \"2016-01-22 07:20:19\"\n      },\n      {\n      \"id\": \"10\",\n      \"exercise_id\": \"Shoulder Stretch\",\n      \"duration\": {\n      \"min\": 38,\n      \"max\": 75\n      },\n      \"unit\": \"seconds\",\n      \"is_completed\": \"0\",\n      \"created_at\": \"2016-01-22 07:20:45\",\n      \"updated_at\": \"2016-01-22 07:20:45\"\n      }\n      ]\n      },\n      \"day5\": {\n      \"warmup\": [\n      {\n      \"id\": \"1\",\n      \"name\": \"wall extensions\",\n      \"duration\": {\n      \"min\": \"10\",\n      \"max\": \"20\"\n      },\n      \"unit\": \"times\",\n      \"created_at\": \"2016-01-21 08:55:06\",\n      \"updated_at\": \"2016-01-21 08:55:06\",\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"2\",\n      \"name\": \"band dislocates\",\n      \"duration\": {\n      \"min\": \"10\",\n      \"max\": \"20\"\n      },\n      \"unit\": \"times\",\n      \"created_at\": \"2016-01-21 08:57:38\",\n      \"updated_at\": \"2016-01-21 08:57:38\",\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"3\",\n      \"name\": \"cat-camels\",\n      \"duration\": {\n      \"min\": \"10\",\n      \"max\": \"20\"\n      },\n      \"unit\": \"times\",\n      \"created_at\": \"2016-01-21 09:00:39\",\n      \"updated_at\": \"2016-01-21 09:00:39\",\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"4\",\n      \"name\": \"scapular shrugs\",\n      \"duration\": {\n      \"min\": \"10\",\n      \"max\": \"20\"\n      },\n      \"unit\": \"times\",\n      \"created_at\": \"2016-01-21 09:01:01\",\n      \"updated_at\": \"2016-01-21 09:01:01\",\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"5\",\n      \"name\": \"full body circles\",\n      \"duration\": {\n      \"min\": \"10\",\n      \"max\": \"20\"\n      },\n      \"unit\": \"times\",\n      \"created_at\": \"2016-01-21 09:01:26\",\n      \"updated_at\": \"2016-01-21 09:01:26\",\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"6\",\n      \"name\": \"Jumping Jacks\",\n      \"duration\": {\n      \"min\": \"100\",\n      \"max\": \"\"\n      },\n      \"unit\": \"seconds\",\n      \"created_at\": \"2016-01-21 09:04:52\",\n      \"updated_at\": \"2016-01-21 09:04:52\",\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"7\",\n      \"name\": \"Arm rotations\",\n      \"duration\": {\n      \"min\": \"120\",\n      \"max\": \"\"\n      },\n      \"unit\": \"times\",\n      \"created_at\": \"2016-01-21 09:05:29\",\n      \"updated_at\": \"2016-01-21 09:05:29\",\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"8\",\n      \"name\": \"High Knees\",\n      \"duration\": {\n      \"min\": \"50\",\n      \"max\": \"\"\n      },\n      \"unit\": \"times\",\n      \"created_at\": \"2016-01-21 09:06:02\",\n      \"updated_at\": \"2016-01-21 09:06:02\",\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"9\",\n      \"name\": \"Shouder rolls\",\n      \"duration\": {\n      \"min\": \"20\",\n      \"max\": \"\"\n      },\n      \"unit\": \"times\",\n      \"created_at\": \"2016-01-21 09:06:34\",\n      \"updated_at\": \"2016-01-21 09:06:34\",\n      \"is_completed\": 0\n      }\n      ],\n      \"is_completed\": 0,\n      \"fundumentals\": [\n      {\n      \"id\": \"11\",\n      \"row\": \"3\",\n      \"exercise_id\": \"64\",\n      \"duration\": {\n      \"min\": \"10\",\n      \"max\": \"\"\n      },\n      \"unit\": \"times\",\n      \"is_completed\": \"0\",\n      \"created_at\": \"2016-01-22 04:35:13\",\n      \"updated_at\": \"2016-04-04 14:27:54\",\n      \"exercise\": {\n      \"id\": \"64\",\n      \"name\": \"Skin the cat\",\n      \"description\": \"Develop your joints mobility and expose yourself to new movement layers\",\n      \"category\": \"1\",\n      \"type\": \"2\",\n      \"muscle_groups\": \"4,5,6\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \" 1. Hands a little more than shoulder width apart\\r\\n2. Raise your knees to the chest\\r\\n3. continuing the movement until the feet pass up through the arms and over head into an inverted hang position.\\r\\n4. Continue to pass the feet round and down toward the ground into the extended 'skin the cat' position.\\r\\n5. Lift your hips and raise the legs back and over to the starting hang position. \",\n      \"video_tips\": \"        \",\n      \"pro_tips\": \" Put your hands closer together to ease up all back lever progressions.\\r\\nDo only half of the movement in the beginning, but fight for completion over time.\\r\\nIncorporate other static elements to challenge yourself during the movement as you master other skills.\\r\\n    \",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Back, Arms, Core\",\n      \"video\": [\n      {\n      \"id\": \"71\",\n      \"path\": \"64_1454045043.mp4\",\n      \"videothumbnail\": \"64_1454045043.jpg\",\n      \"description\": \"Skin the cat\"\n      }\n      ]\n      }\n      },\n      {\n      \"id\": \"12\",\n      \"row\": \"3\",\n      \"exercise_id\": \"12\",\n      \"duration\": {\n      \"min\": \"20\",\n      \"max\": \"\"\n      },\n      \"unit\": \"times\",\n      \"is_completed\": \"0\",\n      \"created_at\": \"2016-01-22 04:36:16\",\n      \"updated_at\": \"2016-04-04 09:26:06\",\n      \"exercise\": {\n      \"id\": \"12\",\n      \"name\": \"Pushups\",\n      \"description\": \"Perform the most popular exercise of all time with real strength\",\n      \"category\": \"2\",\n      \"type\": \"1\",\n      \"muscle_groups\": \"1,2,3\",\n      \"rewards\": \"7.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \" 1. Lie on the floor face down and place your hands in a standard pushup position.\\r\\n 2. Next, lower yourself downward until your chest almost touches the floor as you inhale.\\r\\n 3. Exhale and press your upper body back up to the starting position while squeezing your chest.\\r\\n 4. Repeat, after a brief pause at the top contracted position.\\r\\n\",\n      \"video_tips\": \"      \",\n      \"pro_tips\": \"Do them extra slow and hold it in highest and lowest position to get strength.\\r\\nOne of the most common push-up mistakes is flaring out the elbows out instead of keeping them at your sides.\\r\\nIf too easy, try Spiderman and Diamond Pushups or wear a weigthed vest.\",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Shoulders, Chest, Triceps\",\n      \"video\": [\n      {\n      \"id\": \"57\",\n      \"path\": \"12_1453984139.mp4\",\n      \"videothumbnail\": \"12_1453984139.jpg\",\n      \"description\": \"Pushups\"\n      }\n      ]\n      }\n      },\n      {\n      \"id\": \"13\",\n      \"row\": \"3\",\n      \"exercise_id\": \"49\",\n      \"duration\": {\n      \"min\": \"30\",\n      \"max\": \"\"\n      },\n      \"unit\": \"times\",\n      \"is_completed\": \"0\",\n      \"created_at\": \"2016-01-22 04:36:49\",\n      \"updated_at\": \"2016-04-04 14:19:29\",\n      \"exercise\": {\n      \"id\": \"49\",\n      \"name\": \"Side Triceps\",\n      \"description\": \"Start with the basics of building triceps strength\",\n      \"category\": \"1\",\n      \"type\": \"1\",\n      \"muscle_groups\": \"3\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \" 1. Start with the body on your side\\r\\n2. Put one hand on your shoulder \\r\\n3. Press up with the other arm and hold in extension \",\n      \"video_tips\": \"          \",\n      \"pro_tips\": \" Avoid supporting the movement with your core muscle.      \",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Triceps\",\n      \"video\": [\n      {\n      \"id\": \"43\",\n      \"path\": \"49_1454043404.mp4\",\n      \"videothumbnail\": \"49_1454043404.jpg\",\n      \"description\": \"Side Triceps\"\n      }\n      ]\n      }\n      },\n      {\n      \"id\": \"14\",\n      \"row\": \"3\",\n      \"exercise_id\": \"4\",\n      \"duration\": {\n      \"min\": \"60\",\n      \"max\": \"90\"\n      },\n      \"unit\": \"seconds\",\n      \"is_completed\": \"0\",\n      \"created_at\": \"2016-01-22 04:37:32\",\n      \"updated_at\": \"2016-04-04 14:02:11\",\n      \"exercise\": {\n      \"id\": \"4\",\n      \"name\": \"Plank\",\n      \"description\": \"The plank builds your isometric strength and helps sculpt your waistline.\",\n      \"category\": \"1\",\n      \"type\": \"1\",\n      \"muscle_groups\": \"1,4,6,8\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"seconds\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \"1. Get into pushup position on the floor.\\r\\n2. Now bend your elbows 90 degrees and rest your weight on your forearms. \\r\\n3. Hold the position for as long as you can.   \",\n      \"video_tips\": \"        \",\n      \"pro_tips\": \"Drive your chest away from the ground and spread your shoulder blades as much as you can.\\r\\nKeep a straight line, from head to toe. \\r\\nDon't collapse your lower back or reach your butt to the sky. Add movement to your plank, rock back and forth on your forearms and toes or shift from side to side.\\r\\nTry advanced variations with alternating sinlge leg support. \\r\\nStart with an incline plank if a straight plank is too hard in the beginning.  \",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Shoulders, Back, Core, Full Body\",\n      \"video\": [\n      {\n      \"id\": \"4\",\n      \"path\": \"4_1453976855.mp4\",\n      \"videothumbnail\": \"4_1453976855.jpg\",\n      \"description\": \"Plank\"\n      }\n      ]\n      }\n      },\n      {\n      \"id\": \"15\",\n      \"row\": \"3\",\n      \"exercise_id\": \"36\",\n      \"duration\": {\n      \"min\": \"20\",\n      \"max\": \"\"\n      },\n      \"unit\": \"times\",\n      \"is_completed\": \"0\",\n      \"created_at\": \"2016-01-22 04:37:57\",\n      \"updated_at\": \"2016-04-04 11:12:49\",\n      \"exercise\": {\n      \"id\": \"36\",\n      \"name\": \"High Jumps\",\n      \"description\": \"Do high jumps as a part of restless HIIT workouts\",\n      \"category\": \"1\",\n      \"type\": \"2\",\n      \"muscle_groups\": \"7\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \"1. Start from a standing position\\r\\n2. Jump up and bring your knees to your chest\",\n      \"video_tips\": \"    \",\n      \"pro_tips\": \"Land softly and exhale when the knees are up.\\r\\n  \",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Legs\",\n      \"video\": [\n      {\n      \"id\": \"33\",\n      \"path\": \"36_1454042273.mp4\",\n      \"videothumbnail\": \"36_1454042273.jpg\",\n      \"description\": \"High Jumps\"\n      }\n      ]\n      }\n      }\n      ],\n      \"exercises\": [],\n      \"workout\": {\n      \"id\": \"21\",\n      \"name\": \"Vali\",\n      \"description\": \"A,B,E\",\n      \"rounds\": \"3\",\n      \"category\": \"1\",\n      \"type\": \"2\",\n      \"rewards\": \"330\",\n      \"duration\": \"1620.00\",\n      \"equipments\": \"Bar/Rings, Ladder/Post\",\n      \"is_completed\": 0,\n      \"exercises\": {\n      \"round1\": [\n      {\n      \"id\": \"838\",\n      \"workout_id\": \"21\",\n      \"category\": \"1\",\n      \"repititions\": \"7\",\n      \"exercise_id\": \"64\",\n      \"unit\": \"times\",\n      \"round\": \"1\",\n      \"created_at\": \"2016-01-19 23:14:44\",\n      \"updated_at\": \"2016-04-04 14:27:54\",\n      \"exercise\": {\n      \"id\": \"64\",\n      \"name\": \"Skin the cat\",\n      \"description\": \"Develop your joints mobility and expose yourself to new movement layers\",\n      \"category\": \"1\",\n      \"type\": \"2\",\n      \"muscle_groups\": \"4,5,6\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \" 1. Hands a little more than shoulder width apart\\r\\n2. Raise your knees to the chest\\r\\n3. continuing the movement until the feet pass up through the arms and over head into an inverted hang position.\\r\\n4. Continue to pass the feet round and down toward the ground into the extended 'skin the cat' position.\\r\\n5. Lift your hips and raise the legs back and over to the starting hang position. \",\n      \"video_tips\": \"        \",\n      \"pro_tips\": \" Put your hands closer together to ease up all back lever progressions.\\r\\nDo only half of the movement in the beginning, but fight for completion over time.\\r\\nIncorporate other static elements to challenge yourself during the movement as you master other skills.\\r\\n    \",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Back, Arms, Core\"\n      },\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"841\",\n      \"workout_id\": \"21\",\n      \"category\": \"1\",\n      \"repititions\": \"30\",\n      \"exercise_id\": \"49\",\n      \"unit\": \"times\",\n      \"round\": \"1\",\n      \"created_at\": \"2016-01-19 23:15:12\",\n      \"updated_at\": \"2016-04-04 14:19:29\",\n      \"exercise\": {\n      \"id\": \"49\",\n      \"name\": \"Side Triceps\",\n      \"description\": \"Start with the basics of building triceps strength\",\n      \"category\": \"1\",\n      \"type\": \"1\",\n      \"muscle_groups\": \"3\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \" 1. Start with the body on your side\\r\\n2. Put one hand on your shoulder \\r\\n3. Press up with the other arm and hold in extension \",\n      \"video_tips\": \"          \",\n      \"pro_tips\": \" Avoid supporting the movement with your core muscle.      \",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Triceps\"\n      },\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"844\",\n      \"workout_id\": \"21\",\n      \"category\": \"1\",\n      \"repititions\": \"15\",\n      \"exercise_id\": \"29\",\n      \"unit\": \"times\",\n      \"round\": \"1\",\n      \"created_at\": \"2016-01-19 23:15:35\",\n      \"updated_at\": \"2016-04-04 14:14:02\",\n      \"exercise\": {\n      \"id\": \"29\",\n      \"name\": \"Tucked DF\",\n      \"description\": \"Develop your core strength on the path to the hardest core exercise in history\",\n      \"category\": \"1\",\n      \"type\": \"2\",\n      \"muscle_groups\": \"6\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \" 1. Lie on a decline or flat bench and grab the edge of it behind your head with both hands. \\r\\n2. Tuck your knees to your chest.\\r\\n3. Slowly try to extend to bend legs and hold position as long as you can \\r\\n4. Repeat movement. \",\n      \"video_tips\": \"          \",\n      \"pro_tips\": \" Work it slowly and controlled.\\r\\nFocus to engage your core and lower back in all progressions. \",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Core\"\n      },\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"847\",\n      \"workout_id\": \"21\",\n      \"category\": \"1\",\n      \"repititions\": \"30\",\n      \"exercise_id\": \"72\",\n      \"unit\": \"times\",\n      \"round\": \"1\",\n      \"created_at\": \"2016-01-19 23:16:00\",\n      \"updated_at\": \"2016-04-04 14:34:27\",\n      \"exercise\": {\n      \"id\": \"73\",\n      \"name\": \"Tucked Human Flag\",\n      \"description\": \"Start securing your anchoring point and learn to fully lock out your support\",\n      \"category\": \"1\",\n      \"type\": \"2\",\n      \"muscle_groups\": \"1,5,6\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \" 1. Place your hands so that palms face each other.\\r\\n2. Lock lower arm out for stabilization. (Hands, elbows and shoulders are in line) \\r\\n3. Pull your body with your upper arm up and tuck your knees to chest. \",\n      \"video_tips\": \"          \",\n      \"pro_tips\": \" If you begin to fall out of position it's important to land on your feet and let go of the anchor point to protect the shoulders.\\r\\nStraighten your hip and align with body.\\r\\nGet somebody to assist you in the beginning to stay in position. \",\n      \"is_static\": \"1\",\n      \"musclegroup_string\": \"Shoulders, Arms, Core\"\n      },\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"850\",\n      \"workout_id\": \"21\",\n      \"category\": \"1\",\n      \"repititions\": \"10\",\n      \"exercise_id\": \"66\",\n      \"unit\": \"times\",\n      \"round\": \"1\",\n      \"created_at\": \"2016-01-19 23:16:27\",\n      \"updated_at\": \"2016-04-04 14:31:38\",\n      \"exercise\": {\n      \"id\": \"69\",\n      \"name\": \"Jumping Pullups\",\n      \"description\": \"Expose yourself to packed shoulders and hang time\",\n      \"category\": \"1\",\n      \"type\": \"1\",\n      \"muscle_groups\": \"1,5\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \" 1. Grip a bar and jump into the top position of the pull-up exercise\\r\\n2. Straight legs in front of you. \\r\\n3. Slowly go down into a deadhang position \",\n      \"video_tips\": \"        \",\n      \"pro_tips\": \" A deadhang postion requires your shoulder blades down and towards the spine with arms being straight (retraction)\\r\\nAim for three second holds at the top and go down slowly \",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Shoulders, Arms\"\n      },\n      \"is_completed\": 0\n      }\n      ],\n      \"round2\": [\n      {\n      \"id\": \"839\",\n      \"workout_id\": \"21\",\n      \"category\": \"1\",\n      \"repititions\": \"7\",\n      \"exercise_id\": \"64\",\n      \"unit\": \"times\",\n      \"round\": \"2\",\n      \"created_at\": \"2016-01-19 23:14:44\",\n      \"updated_at\": \"2016-04-04 14:27:54\",\n      \"exercise\": {\n      \"id\": \"64\",\n      \"name\": \"Skin the cat\",\n      \"description\": \"Develop your joints mobility and expose yourself to new movement layers\",\n      \"category\": \"1\",\n      \"type\": \"2\",\n      \"muscle_groups\": \"4,5,6\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \" 1. Hands a little more than shoulder width apart\\r\\n2. Raise your knees to the chest\\r\\n3. continuing the movement until the feet pass up through the arms and over head into an inverted hang position.\\r\\n4. Continue to pass the feet round and down toward the ground into the extended 'skin the cat' position.\\r\\n5. Lift your hips and raise the legs back and over to the starting hang position. \",\n      \"video_tips\": \"        \",\n      \"pro_tips\": \" Put your hands closer together to ease up all back lever progressions.\\r\\nDo only half of the movement in the beginning, but fight for completion over time.\\r\\nIncorporate other static elements to challenge yourself during the movement as you master other skills.\\r\\n    \",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Back, Arms, Core\"\n      },\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"842\",\n      \"workout_id\": \"21\",\n      \"category\": \"1\",\n      \"repititions\": \"30\",\n      \"exercise_id\": \"49\",\n      \"unit\": \"times\",\n      \"round\": \"2\",\n      \"created_at\": \"2016-01-19 23:15:12\",\n      \"updated_at\": \"2016-04-04 14:19:29\",\n      \"exercise\": {\n      \"id\": \"49\",\n      \"name\": \"Side Triceps\",\n      \"description\": \"Start with the basics of building triceps strength\",\n      \"category\": \"1\",\n      \"type\": \"1\",\n      \"muscle_groups\": \"3\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \" 1. Start with the body on your side\\r\\n2. Put one hand on your shoulder \\r\\n3. Press up with the other arm and hold in extension \",\n      \"video_tips\": \"          \",\n      \"pro_tips\": \" Avoid supporting the movement with your core muscle.      \",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Triceps\"\n      },\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"845\",\n      \"workout_id\": \"21\",\n      \"category\": \"1\",\n      \"repititions\": \"15\",\n      \"exercise_id\": \"29\",\n      \"unit\": \"times\",\n      \"round\": \"2\",\n      \"created_at\": \"2016-01-19 23:15:35\",\n      \"updated_at\": \"2016-04-04 14:14:02\",\n      \"exercise\": {\n      \"id\": \"29\",\n      \"name\": \"Tucked DF\",\n      \"description\": \"Develop your core strength on the path to the hardest core exercise in history\",\n      \"category\": \"1\",\n      \"type\": \"2\",\n      \"muscle_groups\": \"6\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \" 1. Lie on a decline or flat bench and grab the edge of it behind your head with both hands. \\r\\n2. Tuck your knees to your chest.\\r\\n3. Slowly try to extend to bend legs and hold position as long as you can \\r\\n4. Repeat movement. \",\n      \"video_tips\": \"          \",\n      \"pro_tips\": \" Work it slowly and controlled.\\r\\nFocus to engage your core and lower back in all progressions. \",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Core\"\n      },\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"848\",\n      \"workout_id\": \"21\",\n      \"category\": \"1\",\n      \"repititions\": \"30\",\n      \"exercise_id\": \"72\",\n      \"unit\": \"times\",\n      \"round\": \"2\",\n      \"created_at\": \"2016-01-19 23:16:00\",\n      \"updated_at\": \"2016-04-04 14:34:27\",\n      \"exercise\": {\n      \"id\": \"73\",\n      \"name\": \"Tucked Human Flag\",\n      \"description\": \"Start securing your anchoring point and learn to fully lock out your support\",\n      \"category\": \"1\",\n      \"type\": \"2\",\n      \"muscle_groups\": \"1,5,6\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \" 1. Place your hands so that palms face each other.\\r\\n2. Lock lower arm out for stabilization. (Hands, elbows and shoulders are in line) \\r\\n3. Pull your body with your upper arm up and tuck your knees to chest. \",\n      \"video_tips\": \"          \",\n      \"pro_tips\": \" If you begin to fall out of position it's important to land on your feet and let go of the anchor point to protect the shoulders.\\r\\nStraighten your hip and align with body.\\r\\nGet somebody to assist you in the beginning to stay in position. \",\n      \"is_static\": \"1\",\n      \"musclegroup_string\": \"Shoulders, Arms, Core\"\n      },\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"852\",\n      \"workout_id\": \"21\",\n      \"category\": \"1\",\n      \"repititions\": \"10\",\n      \"exercise_id\": \"66\",\n      \"unit\": \"times\",\n      \"round\": \"2\",\n      \"created_at\": \"2016-01-19 23:16:28\",\n      \"updated_at\": \"2016-04-04 14:31:38\",\n      \"exercise\": {\n      \"id\": \"69\",\n      \"name\": \"Jumping Pullups\",\n      \"description\": \"Expose yourself to packed shoulders and hang time\",\n      \"category\": \"1\",\n      \"type\": \"1\",\n      \"muscle_groups\": \"1,5\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \" 1. Grip a bar and jump into the top position of the pull-up exercise\\r\\n2. Straight legs in front of you. \\r\\n3. Slowly go down into a deadhang position \",\n      \"video_tips\": \"        \",\n      \"pro_tips\": \" A deadhang postion requires your shoulder blades down and towards the spine with arms being straight (retraction)\\r\\nAim for three second holds at the top and go down slowly \",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Shoulders, Arms\"\n      },\n      \"is_completed\": 0\n      }\n      ],\n      \"round3\": [\n      {\n      \"id\": \"840\",\n      \"workout_id\": \"21\",\n      \"category\": \"1\",\n      \"repititions\": \"7\",\n      \"exercise_id\": \"64\",\n      \"unit\": \"times\",\n      \"round\": \"3\",\n      \"created_at\": \"2016-01-19 23:14:44\",\n      \"updated_at\": \"2016-04-04 14:27:54\",\n      \"exercise\": {\n      \"id\": \"64\",\n      \"name\": \"Skin the cat\",\n      \"description\": \"Develop your joints mobility and expose yourself to new movement layers\",\n      \"category\": \"1\",\n      \"type\": \"2\",\n      \"muscle_groups\": \"4,5,6\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \" 1. Hands a little more than shoulder width apart\\r\\n2. Raise your knees to the chest\\r\\n3. continuing the movement until the feet pass up through the arms and over head into an inverted hang position.\\r\\n4. Continue to pass the feet round and down toward the ground into the extended 'skin the cat' position.\\r\\n5. Lift your hips and raise the legs back and over to the starting hang position. \",\n      \"video_tips\": \"        \",\n      \"pro_tips\": \" Put your hands closer together to ease up all back lever progressions.\\r\\nDo only half of the movement in the beginning, but fight for completion over time.\\r\\nIncorporate other static elements to challenge yourself during the movement as you master other skills.\\r\\n    \",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Back, Arms, Core\"\n      },\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"843\",\n      \"workout_id\": \"21\",\n      \"category\": \"1\",\n      \"repititions\": \"30\",\n      \"exercise_id\": \"49\",\n      \"unit\": \"times\",\n      \"round\": \"3\",\n      \"created_at\": \"2016-01-19 23:15:12\",\n      \"updated_at\": \"2016-04-04 14:19:29\",\n      \"exercise\": {\n      \"id\": \"49\",\n      \"name\": \"Side Triceps\",\n      \"description\": \"Start with the basics of building triceps strength\",\n      \"category\": \"1\",\n      \"type\": \"1\",\n      \"muscle_groups\": \"3\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \" 1. Start with the body on your side\\r\\n2. Put one hand on your shoulder \\r\\n3. Press up with the other arm and hold in extension \",\n      \"video_tips\": \"          \",\n      \"pro_tips\": \" Avoid supporting the movement with your core muscle.      \",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Triceps\"\n      },\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"846\",\n      \"workout_id\": \"21\",\n      \"category\": \"1\",\n      \"repititions\": \"15\",\n      \"exercise_id\": \"29\",\n      \"unit\": \"times\",\n      \"round\": \"3\",\n      \"created_at\": \"2016-01-19 23:15:35\",\n      \"updated_at\": \"2016-04-04 14:14:02\",\n      \"exercise\": {\n      \"id\": \"29\",\n      \"name\": \"Tucked DF\",\n      \"description\": \"Develop your core strength on the path to the hardest core exercise in history\",\n      \"category\": \"1\",\n      \"type\": \"2\",\n      \"muscle_groups\": \"6\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \" 1. Lie on a decline or flat bench and grab the edge of it behind your head with both hands. \\r\\n2. Tuck your knees to your chest.\\r\\n3. Slowly try to extend to bend legs and hold position as long as you can \\r\\n4. Repeat movement. \",\n      \"video_tips\": \"          \",\n      \"pro_tips\": \" Work it slowly and controlled.\\r\\nFocus to engage your core and lower back in all progressions. \",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Core\"\n      },\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"849\",\n      \"workout_id\": \"21\",\n      \"category\": \"1\",\n      \"repititions\": \"30\",\n      \"exercise_id\": \"72\",\n      \"unit\": \"times\",\n      \"round\": \"3\",\n      \"created_at\": \"2016-01-19 23:16:00\",\n      \"updated_at\": \"2016-04-04 14:34:27\",\n      \"exercise\": {\n      \"id\": \"73\",\n      \"name\": \"Tucked Human Flag\",\n      \"description\": \"Start securing your anchoring point and learn to fully lock out your support\",\n      \"category\": \"1\",\n      \"type\": \"2\",\n      \"muscle_groups\": \"1,5,6\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \" 1. Place your hands so that palms face each other.\\r\\n2. Lock lower arm out for stabilization. (Hands, elbows and shoulders are in line) \\r\\n3. Pull your body with your upper arm up and tuck your knees to chest. \",\n      \"video_tips\": \"          \",\n      \"pro_tips\": \" If you begin to fall out of position it's important to land on your feet and let go of the anchor point to protect the shoulders.\\r\\nStraighten your hip and align with body.\\r\\nGet somebody to assist you in the beginning to stay in position. \",\n      \"is_static\": \"1\",\n      \"musclegroup_string\": \"Shoulders, Arms, Core\"\n      },\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"854\",\n      \"workout_id\": \"21\",\n      \"category\": \"1\",\n      \"repititions\": \"10\",\n      \"exercise_id\": \"66\",\n      \"unit\": \"times\",\n      \"round\": \"3\",\n      \"created_at\": \"2016-01-19 23:16:28\",\n      \"updated_at\": \"2016-04-04 14:31:38\",\n      \"exercise\": {\n      \"id\": \"69\",\n      \"name\": \"Jumping Pullups\",\n      \"description\": \"Expose yourself to packed shoulders and hang time\",\n      \"category\": \"1\",\n      \"type\": \"1\",\n      \"muscle_groups\": \"1,5\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \" 1. Grip a bar and jump into the top position of the pull-up exercise\\r\\n2. Straight legs in front of you. \\r\\n3. Slowly go down into a deadhang position \",\n      \"video_tips\": \"        \",\n      \"pro_tips\": \" A deadhang postion requires your shoulder blades down and towards the spine with arms being straight (retraction)\\r\\nAim for three second holds at the top and go down slowly \",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Shoulders, Arms\"\n      },\n      \"is_completed\": 0\n      }\n      ]\n      },\n      \"exercise_category\": 1\n      },\n      \"coach_workout_rounds\": 3,\n      \"workout_intensity\": 1,\n      \"hiit\": [],\n      \"stretching\": [\n      {\n      \"id\": \"1\",\n      \"exercise_id\": \"Superman\",\n      \"duration\": {\n      \"min\": 6,\n      \"max\": 13\n      },\n      \"unit\": \"times\",\n      \"is_completed\": \"0\",\n      \"created_at\": \"2016-01-22 07:10:31\",\n      \"updated_at\": \"2016-01-22 07:10:31\"\n      },\n      {\n      \"id\": \"2\",\n      \"exercise_id\": \"Lower Back Strength\",\n      \"duration\": {\n      \"min\": 38,\n      \"max\": 63\n      },\n      \"unit\": \"times\",\n      \"is_completed\": \"0\",\n      \"created_at\": \"2016-01-22 07:15:02\",\n      \"updated_at\": \"2016-01-22 07:15:02\"\n      },\n      {\n      \"id\": \"3\",\n      \"exercise_id\": \"Upper Dog\",\n      \"duration\": {\n      \"min\": 38,\n      \"max\": 75\n      },\n      \"unit\": \"seconds\",\n      \"is_completed\": \"0\",\n      \"created_at\": \"2016-01-22 07:16:03\",\n      \"updated_at\": \"2016-01-22 07:16:03\"\n      },\n      {\n      \"id\": \"4\",\n      \"exercise_id\": \"Child's Pose\",\n      \"duration\": {\n      \"min\": 38,\n      \"max\": 75\n      },\n      \"unit\": \"seconds\",\n      \"is_completed\": \"0\",\n      \"created_at\": \"2016-01-22 07:16:46\",\n      \"updated_at\": \"2016-01-22 07:16:46\"\n      },\n      {\n      \"id\": \"5\",\n      \"exercise_id\": \"L-sit on the floor\",\n      \"duration\": {\n      \"min\": 38,\n      \"max\": 75\n      },\n      \"unit\": \"seconds\",\n      \"is_completed\": \"0\",\n      \"created_at\": \"2016-01-22 07:17:13\",\n      \"updated_at\": \"2016-01-22 07:17:13\"\n      },\n      {\n      \"id\": \"6\",\n      \"exercise_id\": \"Good morning\",\n      \"duration\": {\n      \"min\": 38,\n      \"max\": 75\n      },\n      \"unit\": \"seconds\",\n      \"is_completed\": \"0\",\n      \"created_at\": \"2016-01-22 07:17:43\",\n      \"updated_at\": \"2016-01-22 07:17:43\"\n      },\n      {\n      \"id\": \"7\",\n      \"exercise_id\": \"Chest Opener\",\n      \"duration\": {\n      \"min\": 38,\n      \"max\": 75\n      },\n      \"unit\": \"seconds\",\n      \"is_completed\": \"0\",\n      \"created_at\": \"2016-01-22 07:19:32\",\n      \"updated_at\": \"2016-01-22 07:19:32\"\n      },\n      {\n      \"id\": \"8\",\n      \"exercise_id\": \"Triceps Stretc\",\n      \"duration\": {\n      \"min\": 38,\n      \"max\": 75\n      },\n      \"unit\": \"seconds\",\n      \"is_completed\": \"0\",\n      \"created_at\": \"2016-01-22 07:19:56\",\n      \"updated_at\": \"2016-01-22 07:19:56\"\n      },\n      {\n      \"id\": \"9\",\n      \"exercise_id\": \"Hands Back\",\n      \"duration\": {\n      \"min\": 38,\n      \"max\": 75\n      },\n      \"unit\": \"seconds\",\n      \"is_completed\": \"0\",\n      \"created_at\": \"2016-01-22 07:20:19\",\n      \"updated_at\": \"2016-01-22 07:20:19\"\n      },\n      {\n      \"id\": \"10\",\n      \"exercise_id\": \"Shoulder Stretch\",\n      \"duration\": {\n      \"min\": 38,\n      \"max\": 75\n      },\n      \"unit\": \"seconds\",\n      \"is_completed\": \"0\",\n      \"created_at\": \"2016-01-22 07:20:45\",\n      \"updated_at\": \"2016-01-22 07:20:45\"\n      }\n      ]\n      },\n      \"day6\": {\n      \"warmup\": [\n      {\n      \"id\": \"1\",\n      \"name\": \"wall extensions\",\n      \"duration\": {\n      \"min\": \"10\",\n      \"max\": \"20\"\n      },\n      \"unit\": \"times\",\n      \"created_at\": \"2016-01-21 08:55:06\",\n      \"updated_at\": \"2016-01-21 08:55:06\",\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"2\",\n      \"name\": \"band dislocates\",\n      \"duration\": {\n      \"min\": \"10\",\n      \"max\": \"20\"\n      },\n      \"unit\": \"times\",\n      \"created_at\": \"2016-01-21 08:57:38\",\n      \"updated_at\": \"2016-01-21 08:57:38\",\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"3\",\n      \"name\": \"cat-camels\",\n      \"duration\": {\n      \"min\": \"10\",\n      \"max\": \"20\"\n      },\n      \"unit\": \"times\",\n      \"created_at\": \"2016-01-21 09:00:39\",\n      \"updated_at\": \"2016-01-21 09:00:39\",\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"4\",\n      \"name\": \"scapular shrugs\",\n      \"duration\": {\n      \"min\": \"10\",\n      \"max\": \"20\"\n      },\n      \"unit\": \"times\",\n      \"created_at\": \"2016-01-21 09:01:01\",\n      \"updated_at\": \"2016-01-21 09:01:01\",\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"5\",\n      \"name\": \"full body circles\",\n      \"duration\": {\n      \"min\": \"10\",\n      \"max\": \"20\"\n      },\n      \"unit\": \"times\",\n      \"created_at\": \"2016-01-21 09:01:26\",\n      \"updated_at\": \"2016-01-21 09:01:26\",\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"6\",\n      \"name\": \"Jumping Jacks\",\n      \"duration\": {\n      \"min\": \"100\",\n      \"max\": \"\"\n      },\n      \"unit\": \"seconds\",\n      \"created_at\": \"2016-01-21 09:04:52\",\n      \"updated_at\": \"2016-01-21 09:04:52\",\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"7\",\n      \"name\": \"Arm rotations\",\n      \"duration\": {\n      \"min\": \"120\",\n      \"max\": \"\"\n      },\n      \"unit\": \"times\",\n      \"created_at\": \"2016-01-21 09:05:29\",\n      \"updated_at\": \"2016-01-21 09:05:29\",\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"8\",\n      \"name\": \"High Knees\",\n      \"duration\": {\n      \"min\": \"50\",\n      \"max\": \"\"\n      },\n      \"unit\": \"times\",\n      \"created_at\": \"2016-01-21 09:06:02\",\n      \"updated_at\": \"2016-01-21 09:06:02\",\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"9\",\n      \"name\": \"Shouder rolls\",\n      \"duration\": {\n      \"min\": \"20\",\n      \"max\": \"\"\n      },\n      \"unit\": \"times\",\n      \"created_at\": \"2016-01-21 09:06:34\",\n      \"updated_at\": \"2016-01-21 09:06:34\",\n      \"is_completed\": 0\n      }\n      ],\n      \"is_completed\": 0,\n      \"fundumentals\": [\n      {\n      \"id\": \"11\",\n      \"row\": \"3\",\n      \"exercise_id\": \"64\",\n      \"duration\": {\n      \"min\": \"10\",\n      \"max\": \"\"\n      },\n      \"unit\": \"times\",\n      \"is_completed\": \"0\",\n      \"created_at\": \"2016-01-22 04:35:13\",\n      \"updated_at\": \"2016-04-04 14:27:54\",\n      \"exercise\": {\n      \"id\": \"64\",\n      \"name\": \"Skin the cat\",\n      \"description\": \"Develop your joints mobility and expose yourself to new movement layers\",\n      \"category\": \"1\",\n      \"type\": \"2\",\n      \"muscle_groups\": \"4,5,6\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \" 1. Hands a little more than shoulder width apart\\r\\n2. Raise your knees to the chest\\r\\n3. continuing the movement until the feet pass up through the arms and over head into an inverted hang position.\\r\\n4. Continue to pass the feet round and down toward the ground into the extended 'skin the cat' position.\\r\\n5. Lift your hips and raise the legs back and over to the starting hang position. \",\n      \"video_tips\": \"        \",\n      \"pro_tips\": \" Put your hands closer together to ease up all back lever progressions.\\r\\nDo only half of the movement in the beginning, but fight for completion over time.\\r\\nIncorporate other static elements to challenge yourself during the movement as you master other skills.\\r\\n    \",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Back, Arms, Core\",\n      \"video\": [\n      {\n      \"id\": \"71\",\n      \"path\": \"64_1454045043.mp4\",\n      \"videothumbnail\": \"64_1454045043.jpg\",\n      \"description\": \"Skin the cat\"\n      }\n      ]\n      }\n      },\n      {\n      \"id\": \"12\",\n      \"row\": \"3\",\n      \"exercise_id\": \"12\",\n      \"duration\": {\n      \"min\": \"20\",\n      \"max\": \"\"\n      },\n      \"unit\": \"times\",\n      \"is_completed\": \"0\",\n      \"created_at\": \"2016-01-22 04:36:16\",\n      \"updated_at\": \"2016-04-04 09:26:06\",\n      \"exercise\": {\n      \"id\": \"12\",\n      \"name\": \"Pushups\",\n      \"description\": \"Perform the most popular exercise of all time with real strength\",\n      \"category\": \"2\",\n      \"type\": \"1\",\n      \"muscle_groups\": \"1,2,3\",\n      \"rewards\": \"7.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \" 1. Lie on the floor face down and place your hands in a standard pushup position.\\r\\n 2. Next, lower yourself downward until your chest almost touches the floor as you inhale.\\r\\n 3. Exhale and press your upper body back up to the starting position while squeezing your chest.\\r\\n 4. Repeat, after a brief pause at the top contracted position.\\r\\n\",\n      \"video_tips\": \"      \",\n      \"pro_tips\": \"Do them extra slow and hold it in highest and lowest position to get strength.\\r\\nOne of the most common push-up mistakes is flaring out the elbows out instead of keeping them at your sides.\\r\\nIf too easy, try Spiderman and Diamond Pushups or wear a weigthed vest.\",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Shoulders, Chest, Triceps\",\n      \"video\": [\n      {\n      \"id\": \"57\",\n      \"path\": \"12_1453984139.mp4\",\n      \"videothumbnail\": \"12_1453984139.jpg\",\n      \"description\": \"Pushups\"\n      }\n      ]\n      }\n      },\n      {\n      \"id\": \"13\",\n      \"row\": \"3\",\n      \"exercise_id\": \"49\",\n      \"duration\": {\n      \"min\": \"30\",\n      \"max\": \"\"\n      },\n      \"unit\": \"times\",\n      \"is_completed\": \"0\",\n      \"created_at\": \"2016-01-22 04:36:49\",\n      \"updated_at\": \"2016-04-04 14:19:29\",\n      \"exercise\": {\n      \"id\": \"49\",\n      \"name\": \"Side Triceps\",\n      \"description\": \"Start with the basics of building triceps strength\",\n      \"category\": \"1\",\n      \"type\": \"1\",\n      \"muscle_groups\": \"3\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \" 1. Start with the body on your side\\r\\n2. Put one hand on your shoulder \\r\\n3. Press up with the other arm and hold in extension \",\n      \"video_tips\": \"          \",\n      \"pro_tips\": \" Avoid supporting the movement with your core muscle.      \",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Triceps\",\n      \"video\": [\n      {\n      \"id\": \"43\",\n      \"path\": \"49_1454043404.mp4\",\n      \"videothumbnail\": \"49_1454043404.jpg\",\n      \"description\": \"Side Triceps\"\n      }\n      ]\n      }\n      },\n      {\n      \"id\": \"14\",\n      \"row\": \"3\",\n      \"exercise_id\": \"4\",\n      \"duration\": {\n      \"min\": \"60\",\n      \"max\": \"90\"\n      },\n      \"unit\": \"seconds\",\n      \"is_completed\": \"0\",\n      \"created_at\": \"2016-01-22 04:37:32\",\n      \"updated_at\": \"2016-04-04 14:02:11\",\n      \"exercise\": {\n      \"id\": \"4\",\n      \"name\": \"Plank\",\n      \"description\": \"The plank builds your isometric strength and helps sculpt your waistline.\",\n      \"category\": \"1\",\n      \"type\": \"1\",\n      \"muscle_groups\": \"1,4,6,8\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"seconds\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \"1. Get into pushup position on the floor.\\r\\n2. Now bend your elbows 90 degrees and rest your weight on your forearms. \\r\\n3. Hold the position for as long as you can.   \",\n      \"video_tips\": \"        \",\n      \"pro_tips\": \"Drive your chest away from the ground and spread your shoulder blades as much as you can.\\r\\nKeep a straight line, from head to toe. \\r\\nDon't collapse your lower back or reach your butt to the sky. Add movement to your plank, rock back and forth on your forearms and toes or shift from side to side.\\r\\nTry advanced variations with alternating sinlge leg support. \\r\\nStart with an incline plank if a straight plank is too hard in the beginning.  \",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Shoulders, Back, Core, Full Body\",\n      \"video\": [\n      {\n      \"id\": \"4\",\n      \"path\": \"4_1453976855.mp4\",\n      \"videothumbnail\": \"4_1453976855.jpg\",\n      \"description\": \"Plank\"\n      }\n      ]\n      }\n      },\n      {\n      \"id\": \"15\",\n      \"row\": \"3\",\n      \"exercise_id\": \"36\",\n      \"duration\": {\n      \"min\": \"20\",\n      \"max\": \"\"\n      },\n      \"unit\": \"times\",\n      \"is_completed\": \"0\",\n      \"created_at\": \"2016-01-22 04:37:57\",\n      \"updated_at\": \"2016-04-04 11:12:49\",\n      \"exercise\": {\n      \"id\": \"36\",\n      \"name\": \"High Jumps\",\n      \"description\": \"Do high jumps as a part of restless HIIT workouts\",\n      \"category\": \"1\",\n      \"type\": \"2\",\n      \"muscle_groups\": \"7\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \"1. Start from a standing position\\r\\n2. Jump up and bring your knees to your chest\",\n      \"video_tips\": \"    \",\n      \"pro_tips\": \"Land softly and exhale when the knees are up.\\r\\n  \",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Legs\",\n      \"video\": [\n      {\n      \"id\": \"33\",\n      \"path\": \"36_1454042273.mp4\",\n      \"videothumbnail\": \"36_1454042273.jpg\",\n      \"description\": \"High Jumps\"\n      }\n      ]\n      }\n      }\n      ],\n      \"exercises\": [],\n      \"workout\": {\n      \"id\": \"10\",\n      \"name\": \"Loki\",\n      \"description\": \"A,E,B\",\n      \"rounds\": \"1\",\n      \"category\": \"1\",\n      \"type\": \"1\",\n      \"rewards\": \"330\",\n      \"duration\": \"1440.00\",\n      \"equipments\": \"Bar/Rings\",\n      \"is_completed\": 0,\n      \"exercises\": {\n      \"round1\": [\n      {\n      \"id\": \"364\",\n      \"workout_id\": \"10\",\n      \"category\": \"1\",\n      \"repititions\": \"15\",\n      \"exercise_id\": \"66\",\n      \"unit\": \"times\",\n      \"round\": \"1\",\n      \"created_at\": \"2016-01-19 05:35:04\",\n      \"updated_at\": \"2016-04-04 14:31:38\",\n      \"exercise\": {\n      \"id\": \"69\",\n      \"name\": \"Jumping Pullups\",\n      \"description\": \"Expose yourself to packed shoulders and hang time\",\n      \"category\": \"1\",\n      \"type\": \"1\",\n      \"muscle_groups\": \"1,5\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \" 1. Grip a bar and jump into the top position of the pull-up exercise\\r\\n2. Straight legs in front of you. \\r\\n3. Slowly go down into a deadhang position \",\n      \"video_tips\": \"        \",\n      \"pro_tips\": \" A deadhang postion requires your shoulder blades down and towards the spine with arms being straight (retraction)\\r\\nAim for three second holds at the top and go down slowly \",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Shoulders, Arms\"\n      },\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"365\",\n      \"workout_id\": \"10\",\n      \"category\": \"1\",\n      \"repititions\": \"120\",\n      \"exercise_id\": \"4\",\n      \"unit\": \"seconds\",\n      \"round\": \"1\",\n      \"created_at\": \"2016-01-19 05:35:24\",\n      \"updated_at\": \"2016-04-04 14:02:11\",\n      \"exercise\": {\n      \"id\": \"4\",\n      \"name\": \"Plank\",\n      \"description\": \"The plank builds your isometric strength and helps sculpt your waistline.\",\n      \"category\": \"1\",\n      \"type\": \"1\",\n      \"muscle_groups\": \"1,4,6,8\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"seconds\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \"1. Get into pushup position on the floor.\\r\\n2. Now bend your elbows 90 degrees and rest your weight on your forearms. \\r\\n3. Hold the position for as long as you can.   \",\n      \"video_tips\": \"        \",\n      \"pro_tips\": \"Drive your chest away from the ground and spread your shoulder blades as much as you can.\\r\\nKeep a straight line, from head to toe. \\r\\nDon't collapse your lower back or reach your butt to the sky. Add movement to your plank, rock back and forth on your forearms and toes or shift from side to side.\\r\\nTry advanced variations with alternating sinlge leg support. \\r\\nStart with an incline plank if a straight plank is too hard in the beginning.  \",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Shoulders, Back, Core, Full Body\"\n      },\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"366\",\n      \"workout_id\": \"10\",\n      \"category\": \"1\",\n      \"repititions\": \"50\",\n      \"exercise_id\": \"49\",\n      \"unit\": \"times\",\n      \"round\": \"1\",\n      \"created_at\": \"2016-01-19 05:35:49\",\n      \"updated_at\": \"2016-04-04 14:19:29\",\n      \"exercise\": {\n      \"id\": \"49\",\n      \"name\": \"Side Triceps\",\n      \"description\": \"Start with the basics of building triceps strength\",\n      \"category\": \"1\",\n      \"type\": \"1\",\n      \"muscle_groups\": \"3\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \" 1. Start with the body on your side\\r\\n2. Put one hand on your shoulder \\r\\n3. Press up with the other arm and hold in extension \",\n      \"video_tips\": \"          \",\n      \"pro_tips\": \" Avoid supporting the movement with your core muscle.      \",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Triceps\"\n      },\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"367\",\n      \"workout_id\": \"10\",\n      \"category\": \"1\",\n      \"repititions\": \"25\",\n      \"exercise_id\": \"29\",\n      \"unit\": \"times\",\n      \"round\": \"1\",\n      \"created_at\": \"2016-01-19 05:36:05\",\n      \"updated_at\": \"2016-04-04 14:14:02\",\n      \"exercise\": {\n      \"id\": \"29\",\n      \"name\": \"Tucked DF\",\n      \"description\": \"Develop your core strength on the path to the hardest core exercise in history\",\n      \"category\": \"1\",\n      \"type\": \"2\",\n      \"muscle_groups\": \"6\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \" 1. Lie on a decline or flat bench and grab the edge of it behind your head with both hands. \\r\\n2. Tuck your knees to your chest.\\r\\n3. Slowly try to extend to bend legs and hold position as long as you can \\r\\n4. Repeat movement. \",\n      \"video_tips\": \"          \",\n      \"pro_tips\": \" Work it slowly and controlled.\\r\\nFocus to engage your core and lower back in all progressions. \",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Core\"\n      },\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"368\",\n      \"workout_id\": \"10\",\n      \"category\": \"1\",\n      \"repititions\": \"50\",\n      \"exercise_id\": \"9\",\n      \"unit\": \"times\",\n      \"round\": \"1\",\n      \"created_at\": \"2016-01-19 05:36:21\",\n      \"updated_at\": \"2016-04-04 09:22:17\",\n      \"exercise\": {\n      \"id\": \"9\",\n      \"name\": \"Crunches\",\n      \"description\": \"Do the most admired sixpack exercise in the world\",\n      \"category\": \"1\",\n      \"type\": \"1\",\n      \"muscle_groups\": \"6\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \"1. Starting position is with lying face up on the floor with knees bent. \\r\\n2. Move torso up and touch your knees with your hands\\r\\n3. Lower body to the floor and repeat\\r\\n  \",\n      \"video_tips\": \"    \",\n      \"pro_tips\": \"Do variations in tempo. Aim for one count up and three counts down.\\r\\nIf you have a tendency to interlace your fingers and yank your head, place your hands cross-chest.\",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Core\"\n      },\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"369\",\n      \"workout_id\": \"10\",\n      \"category\": \"1\",\n      \"repititions\": \"25\",\n      \"exercise_id\": \"29\",\n      \"unit\": \"times\",\n      \"round\": \"1\",\n      \"created_at\": \"2016-01-19 05:36:44\",\n      \"updated_at\": \"2016-04-04 14:14:02\",\n      \"exercise\": {\n      \"id\": \"29\",\n      \"name\": \"Tucked DF\",\n      \"description\": \"Develop your core strength on the path to the hardest core exercise in history\",\n      \"category\": \"1\",\n      \"type\": \"2\",\n      \"muscle_groups\": \"6\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \" 1. Lie on a decline or flat bench and grab the edge of it behind your head with both hands. \\r\\n2. Tuck your knees to your chest.\\r\\n3. Slowly try to extend to bend legs and hold position as long as you can \\r\\n4. Repeat movement. \",\n      \"video_tips\": \"          \",\n      \"pro_tips\": \" Work it slowly and controlled.\\r\\nFocus to engage your core and lower back in all progressions. \",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Core\"\n      },\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"370\",\n      \"workout_id\": \"10\",\n      \"category\": \"1\",\n      \"repititions\": \"50\",\n      \"exercise_id\": \"49\",\n      \"unit\": \"times\",\n      \"round\": \"1\",\n      \"created_at\": \"2016-01-19 05:37:38\",\n      \"updated_at\": \"2016-04-04 14:19:29\",\n      \"exercise\": {\n      \"id\": \"49\",\n      \"name\": \"Side Triceps\",\n      \"description\": \"Start with the basics of building triceps strength\",\n      \"category\": \"1\",\n      \"type\": \"1\",\n      \"muscle_groups\": \"3\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \" 1. Start with the body on your side\\r\\n2. Put one hand on your shoulder \\r\\n3. Press up with the other arm and hold in extension \",\n      \"video_tips\": \"          \",\n      \"pro_tips\": \" Avoid supporting the movement with your core muscle.      \",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Triceps\"\n      },\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"371\",\n      \"workout_id\": \"10\",\n      \"category\": \"1\",\n      \"repititions\": \"120\",\n      \"exercise_id\": \"4\",\n      \"unit\": \"seconds\",\n      \"round\": \"1\",\n      \"created_at\": \"2016-01-19 05:37:58\",\n      \"updated_at\": \"2016-04-04 14:02:11\",\n      \"exercise\": {\n      \"id\": \"4\",\n      \"name\": \"Plank\",\n      \"description\": \"The plank builds your isometric strength and helps sculpt your waistline.\",\n      \"category\": \"1\",\n      \"type\": \"1\",\n      \"muscle_groups\": \"1,4,6,8\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"seconds\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \"1. Get into pushup position on the floor.\\r\\n2. Now bend your elbows 90 degrees and rest your weight on your forearms. \\r\\n3. Hold the position for as long as you can.   \",\n      \"video_tips\": \"        \",\n      \"pro_tips\": \"Drive your chest away from the ground and spread your shoulder blades as much as you can.\\r\\nKeep a straight line, from head to toe. \\r\\nDon't collapse your lower back or reach your butt to the sky. Add movement to your plank, rock back and forth on your forearms and toes or shift from side to side.\\r\\nTry advanced variations with alternating sinlge leg support. \\r\\nStart with an incline plank if a straight plank is too hard in the beginning.  \",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Shoulders, Back, Core, Full Body\"\n      },\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"372\",\n      \"workout_id\": \"10\",\n      \"category\": \"1\",\n      \"repititions\": \"15\",\n      \"exercise_id\": \"66\",\n      \"unit\": \"times\",\n      \"round\": \"1\",\n      \"created_at\": \"2016-01-19 05:38:13\",\n      \"updated_at\": \"2016-04-04 14:31:38\",\n      \"exercise\": {\n      \"id\": \"69\",\n      \"name\": \"Jumping Pullups\",\n      \"description\": \"Expose yourself to packed shoulders and hang time\",\n      \"category\": \"1\",\n      \"type\": \"1\",\n      \"muscle_groups\": \"1,5\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \" 1. Grip a bar and jump into the top position of the pull-up exercise\\r\\n2. Straight legs in front of you. \\r\\n3. Slowly go down into a deadhang position \",\n      \"video_tips\": \"        \",\n      \"pro_tips\": \" A deadhang postion requires your shoulder blades down and towards the spine with arms being straight (retraction)\\r\\nAim for three second holds at the top and go down slowly \",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Shoulders, Arms\"\n      },\n      \"is_completed\": 0\n      }\n      ]\n      },\n      \"exercise_category\": 1\n      },\n      \"coach_workout_rounds\": 1,\n      \"workout_intensity\": 1,\n      \"hiit\": [\n      {\n      \"id\": 2,\n      \"intensity\": 4,\n      \"is_completed\": 0,\n      \"replacement\": [\n      {\n      \"round1\": [\n      {\n      \"name\": \"Burpee\",\n      \"duration\": 10,\n      \"unit\": \"times\",\n      \"exercise\": {\n      \"id\": \"31\",\n      \"name\": \"Burpee\",\n      \"description\": \"Test your fitness with the original burpee\",\n      \"category\": \"2\",\n      \"type\": \"1\",\n      \"muscle_groups\": \"8\",\n      \"rewards\": \"7.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \"1. Start in a standing position\\r\\n2. Go down and bring your body down to the floor\\r\\n3. Jump back up with your hands behind your head\",\n      \"video_tips\": \"    \",\n      \"pro_tips\": \"Avoid a hollow back during the movement. \\r\\nKeep the core and lower back engaged at all times.\",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Full Body\",\n      \"video\": [\n      {\n      \"id\": \"28\",\n      \"path\": \"31_1454041910.mp4\",\n      \"videothumbnail\": \"31_1454041910.jpg\",\n      \"description\": \"Burpee\"\n      }\n      ]\n      }\n      },\n      {\n      \"name\": \"Rest\",\n      \"duration\": 10,\n      \"unit\": \"seconds\",\n      \"exercise\": []\n      }\n      ],\n      \"round2\": [\n      {\n      \"name\": \"High Jumps\",\n      \"duration\": 25,\n      \"unit\": \"times\",\n      \"exercise\": {\n      \"id\": \"36\",\n      \"name\": \"High Jumps\",\n      \"description\": \"Do high jumps as a part of restless HIIT workouts\",\n      \"category\": \"1\",\n      \"type\": \"2\",\n      \"muscle_groups\": \"7\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \"1. Start from a standing position\\r\\n2. Jump up and bring your knees to your chest\",\n      \"video_tips\": \"    \",\n      \"pro_tips\": \"Land softly and exhale when the knees are up.\\r\\n  \",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Legs\",\n      \"video\": [\n      {\n      \"id\": \"33\",\n      \"path\": \"36_1454042273.mp4\",\n      \"videothumbnail\": \"36_1454042273.jpg\",\n      \"description\": \"High Jumps\"\n      }\n      ]\n      }\n      },\n      {\n      \"name\": \"Rest\",\n      \"duration\": 10,\n      \"unit\": \"seconds\",\n      \"exercise\": []\n      }\n      ],\n      \"round3\": [\n      {\n      \"name\": \"Knee Raises\",\n      \"duration\": 15,\n      \"unit\": \"times\",\n      \"exercise\": {\n      \"id\": \"57\",\n      \"name\": \"Knee Raises\",\n      \"description\": \"Develop grip and core strength and get used to slow and controlled moves\",\n      \"category\": \"1\",\n      \"type\": \"2\",\n      \"muscle_groups\": \"4,6,7\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \"1. Start from a deadhang position with your arms and legs fully extended, and feet off the ground.  \\r\\n2. Raise your knees up towards your chest as high as possible. \\r\\n3. Hold for a brief moment and slowly return to the starting position. \\r\\n4. Repeat for required repetitions. \",\n      \"video_tips\": \"    \",\n      \"pro_tips\": \"Avoid using momentum or swinging during the exercise. \\r\\nPerform the knee raise slowly and controlled.\",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Back, Core, Legs\",\n      \"video\": [\n      {\n      \"id\": \"67\",\n      \"path\": \"57_1454044213.mp4\",\n      \"videothumbnail\": \"57_1454044213.jpg\",\n      \"description\": \"Knee Raises\"\n      }\n      ]\n      }\n      },\n      {\n      \"name\": \"Rest\",\n      \"duration\": 10,\n      \"unit\": \"seconds\",\n      \"exercise\": []\n      }\n      ]\n      }\n      ],\n      \"replacement_round_count\": 3\n      }\n      ],\n      \"stretching\": [\n      {\n      \"id\": \"1\",\n      \"exercise_id\": \"Superman\",\n      \"duration\": {\n      \"min\": 6,\n      \"max\": 13\n      },\n      \"unit\": \"times\",\n      \"is_completed\": \"0\",\n      \"created_at\": \"2016-01-22 07:10:31\",\n      \"updated_at\": \"2016-01-22 07:10:31\"\n      },\n      {\n      \"id\": \"2\",\n      \"exercise_id\": \"Lower Back Strength\",\n      \"duration\": {\n      \"min\": 38,\n      \"max\": 63\n      },\n      \"unit\": \"times\",\n      \"is_completed\": \"0\",\n      \"created_at\": \"2016-01-22 07:15:02\",\n      \"updated_at\": \"2016-01-22 07:15:02\"\n      },\n      {\n      \"id\": \"3\",\n      \"exercise_id\": \"Upper Dog\",\n      \"duration\": {\n      \"min\": 38,\n      \"max\": 75\n      },\n      \"unit\": \"seconds\",\n      \"is_completed\": \"0\",\n      \"created_at\": \"2016-01-22 07:16:03\",\n      \"updated_at\": \"2016-01-22 07:16:03\"\n      },\n      {\n      \"id\": \"4\",\n      \"exercise_id\": \"Child's Pose\",\n      \"duration\": {\n      \"min\": 38,\n      \"max\": 75\n      },\n      \"unit\": \"seconds\",\n      \"is_completed\": \"0\",\n      \"created_at\": \"2016-01-22 07:16:46\",\n      \"updated_at\": \"2016-01-22 07:16:46\"\n      },\n      {\n      \"id\": \"5\",\n      \"exercise_id\": \"L-sit on the floor\",\n      \"duration\": {\n      \"min\": 38,\n      \"max\": 75\n      },\n      \"unit\": \"seconds\",\n      \"is_completed\": \"0\",\n      \"created_at\": \"2016-01-22 07:17:13\",\n      \"updated_at\": \"2016-01-22 07:17:13\"\n      },\n      {\n      \"id\": \"6\",\n      \"exercise_id\": \"Good morning\",\n      \"duration\": {\n      \"min\": 38,\n      \"max\": 75\n      },\n      \"unit\": \"seconds\",\n      \"is_completed\": \"0\",\n      \"created_at\": \"2016-01-22 07:17:43\",\n      \"updated_at\": \"2016-01-22 07:17:43\"\n      },\n      {\n      \"id\": \"7\",\n      \"exercise_id\": \"Chest Opener\",\n      \"duration\": {\n      \"min\": 38,\n      \"max\": 75\n      },\n      \"unit\": \"seconds\",\n      \"is_completed\": \"0\",\n      \"created_at\": \"2016-01-22 07:19:32\",\n      \"updated_at\": \"2016-01-22 07:19:32\"\n      },\n      {\n      \"id\": \"8\",\n      \"exercise_id\": \"Triceps Stretc\",\n      \"duration\": {\n      \"min\": 38,\n      \"max\": 75\n      },\n      \"unit\": \"seconds\",\n      \"is_completed\": \"0\",\n      \"created_at\": \"2016-01-22 07:19:56\",\n      \"updated_at\": \"2016-01-22 07:19:56\"\n      },\n      {\n      \"id\": \"9\",\n      \"exercise_id\": \"Hands Back\",\n      \"duration\": {\n      \"min\": 38,\n      \"max\": 75\n      },\n      \"unit\": \"seconds\",\n      \"is_completed\": \"0\",\n      \"created_at\": \"2016-01-22 07:20:19\",\n      \"updated_at\": \"2016-01-22 07:20:19\"\n      },\n      {\n      \"id\": \"10\",\n      \"exercise_id\": \"Shoulder Stretch\",\n      \"duration\": {\n      \"min\": 38,\n      \"max\": 75\n      },\n      \"unit\": \"seconds\",\n      \"is_completed\": \"0\",\n      \"created_at\": \"2016-01-22 07:20:45\",\n      \"updated_at\": \"2016-01-22 07:20:45\"\n      }\n      ]\n      }\n      },\n      \"category\": \"professional\",\n      \"muscle_groups\": \"\",\n      \"limitations\": \"\",\n      \"goal_option\": \"0\",\n      \"feedback\": \"0\",\n      \"created_at\": \"2016-05-27 06:54:49\",\n      \"updated_at\": \"2016-06-14 12:50:18\",\n      \"description\": \"Strive for progress\",\n      \"musclegroup_string\": \"\",\n      \"goaloption_string\": \"\"\n      },\n      \"urls\": {\n      \"profileImageSmall\": \"http://testing.ykings.com/uploads/images/profile/small\",\n      \"profileImageMedium\": \"http://testing.ykings.com/uploads/images/profile/medium\",\n      \"profileImageLarge\": \"http://testing.ykings.com/uploads/images/profile/large\",\n      \"profileImageOriginal\": \"http://testing.ykings.com/uploads/images/profile/original\",\n      \"video\": \"http://testing.ykings.com/uploads/videos\",\n      \"videothumbnail\": \"http://testing.ykings.com/uploads/images/videothumbnails\",\n      \"feedImageSmall\": \"http://testing.ykings.com/uploads/images/feed/small\",\n      \"feedImageMedium\": \"http://testing.ykings.com/uploads/images/feed/medium\",\n      \"feedImageLarge\": \"http://testing.ykings.com/uploads/images/feed/large\",\n      \"feedImageOriginal\": \"http://testing.ykings.com/uploads/images/feed/original\",\n      \"coverImageSmall\": \"http://testing.ykings.com/uploads/images/cover_image/small\",\n      \"coverImageMedium\": \"http://testing.ykings.com/uploads/images/cover_image/medium\",\n      \"coverImageLarge\": \"http://testing.ykings.com/uploads/images/cover_image/large\",\n      \"coverImageOriginal\": \"http://testing.ykings.com/uploads/images/cover_image/original\"\n      }\n      }",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "error",
            "description": "<p>Message token_invalid.</p> "
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 400 Invalid Request\n{\n  \"status\":\"0\",\n  \"error\": \"token_invalid\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 401 Unauthorised\n{\n  \"status\":\"0\",\n  \"error\": \"token_expired\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 400 Bad Request\n{\n  \"status\":\"0\",\n  \"error\": \"token_not_provided\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 422 Validation error\n{\n  \"status\" : 0,\n  \"error\": \"The user_id field is required\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 500 user_not_exists\n{\n  \"status\" : 0,\n  \"error\": \"user_not_exists\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 500 Invalid options selected.\n{\n          \"status\": 0,\n          \"message\": \"Invalid options selected. Please revisit your options to get your coach.\"\n        }",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "app/Http/Controllers/Api/CoachesController.php",
    "groupTitle": "Coach"
  },
  {
    "type": "post",
    "url": "/coach/reset",
    "title": "resetCoach",
    "name": "resetCoach",
    "group": "Coach",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "<p>Number</p> ",
            "optional": false,
            "field": "user_id",
            "description": "<p>Id of user *required</p> "
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "<p>String</p> ",
            "optional": false,
            "field": "success.",
            "description": ""
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n{\n      \"status\": 1,\n      \"message\": \"successfully_reset_coach\"\n      }",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "error",
            "description": "<p>Message token_invalid.</p> "
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 400 Invalid Request\n{\n  \"status\":\"0\",\n  \"error\": \"token_invalid\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 401 Unauthorised\n{\n  \"status\":\"0\",\n  \"error\": \"token_expired\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 400 Bad Request\n{\n  \"status\":\"0\",\n  \"error\": \"token_not_provided\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 422 Validation error\n{\n  \"status\" : 0,\n  \"error\": \"The user_id field is required\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 500 user_not_exists\n{\n  \"status\" : 0,\n  \"error\": \"user_not_exists\"\n}",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "app/Http/Controllers/Api/CoachesController.php",
    "groupTitle": "Coach"
  },
  {
    "type": "post",
    "url": "/coach/update",
    "title": "updateCoach",
    "name": "updateCoach",
    "group": "Coach",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "<p>Number</p> ",
            "optional": false,
            "field": "user_id",
            "description": "<p>Id of user *required</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>Number</p> ",
            "optional": false,
            "field": "assessment",
            "description": "<p>1- I can do way more, 2 - I can do more, 3 - It was ok *required</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>Number</p> ",
            "optional": false,
            "field": "focus",
            "description": "<p>user focus 1-Lean, 2-Athletic, 3-Strength *required</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>Number</p> ",
            "optional": false,
            "field": "days",
            "description": "<p>number of workout days per week *required</p> "
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "<p>String</p> ",
            "optional": false,
            "field": "success.",
            "description": ""
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n{\n      \"status\": 1,\n      \"message\": \"Successfully updated coach exercises\",\n      \"coach_day\": \"1\",\n      \"coach_week\": \"1\",\n      \"is_subscribed\": 1,\n      \"need_update\": 0,\n      \"week_status\": {\n      \"1\": 0\n      },\n      \"day_status\": {\n      \"1\": 0,\n      \"2\": 0,\n      \"3\": 0,\n      \"4\": 0,\n      \"5\": 0,\n      \"6\": 0\n      },\n      \"week_points\": \"330.00\",\n      \"coach\": {\n      \"id\": \"490\",\n      \"user_id\": \"67\",\n      \"focus\": \"2\",\n      \"height\": \"0.00\",\n      \"weight\": \"0.00\",\n      \"days\": \"6\",\n      \"exercises\": {\n      \"day1\": {\n      \"warmup\": [\n      {\n      \"id\": \"1\",\n      \"name\": \"wall extensions\",\n      \"duration\": {\n      \"min\": \"10\",\n      \"max\": \"20\"\n      },\n      \"unit\": \"times\",\n      \"created_at\": \"2016-01-21 08:55:06\",\n      \"updated_at\": \"2016-01-21 08:55:06\",\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"2\",\n      \"name\": \"band dislocates\",\n      \"duration\": {\n      \"min\": \"10\",\n      \"max\": \"20\"\n      },\n      \"unit\": \"times\",\n      \"created_at\": \"2016-01-21 08:57:38\",\n      \"updated_at\": \"2016-01-21 08:57:38\",\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"3\",\n      \"name\": \"cat-camels\",\n      \"duration\": {\n      \"min\": \"10\",\n      \"max\": \"20\"\n      },\n      \"unit\": \"times\",\n      \"created_at\": \"2016-01-21 09:00:39\",\n      \"updated_at\": \"2016-01-21 09:00:39\",\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"4\",\n      \"name\": \"scapular shrugs\",\n      \"duration\": {\n      \"min\": \"10\",\n      \"max\": \"20\"\n      },\n      \"unit\": \"times\",\n      \"created_at\": \"2016-01-21 09:01:01\",\n      \"updated_at\": \"2016-01-21 09:01:01\",\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"5\",\n      \"name\": \"full body circles\",\n      \"duration\": {\n      \"min\": \"10\",\n      \"max\": \"20\"\n      },\n      \"unit\": \"times\",\n      \"created_at\": \"2016-01-21 09:01:26\",\n      \"updated_at\": \"2016-01-21 09:01:26\",\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"6\",\n      \"name\": \"Jumping Jacks\",\n      \"duration\": {\n      \"min\": \"100\",\n      \"max\": \"\"\n      },\n      \"unit\": \"seconds\",\n      \"created_at\": \"2016-01-21 09:04:52\",\n      \"updated_at\": \"2016-01-21 09:04:52\",\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"7\",\n      \"name\": \"Arm rotations\",\n      \"duration\": {\n      \"min\": \"120\",\n      \"max\": \"\"\n      },\n      \"unit\": \"times\",\n      \"created_at\": \"2016-01-21 09:05:29\",\n      \"updated_at\": \"2016-01-21 09:05:29\",\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"8\",\n      \"name\": \"High Knees\",\n      \"duration\": {\n      \"min\": \"50\",\n      \"max\": \"\"\n      },\n      \"unit\": \"times\",\n      \"created_at\": \"2016-01-21 09:06:02\",\n      \"updated_at\": \"2016-01-21 09:06:02\",\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"9\",\n      \"name\": \"Shouder rolls\",\n      \"duration\": {\n      \"min\": \"20\",\n      \"max\": \"\"\n      },\n      \"unit\": \"times\",\n      \"created_at\": \"2016-01-21 09:06:34\",\n      \"updated_at\": \"2016-01-21 09:06:34\",\n      \"is_completed\": 0\n      }\n      ],\n      \"is_completed\": 0,\n      \"fundumentals\": [\n      {\n      \"id\": \"16\",\n      \"row\": \"4\",\n      \"exercise_id\": \"57\",\n      \"duration\": {\n      \"min\": \"15\",\n      \"max\": \"\"\n      },\n      \"unit\": \"times\",\n      \"is_completed\": \"0\",\n      \"created_at\": \"2016-01-22 04:51:17\",\n      \"updated_at\": \"2016-04-04 12:10:48\",\n      \"exercise\": {\n      \"id\": \"57\",\n      \"name\": \"Knee Raises\",\n      \"description\": \"Develop grip and core strength and get used to slow and controlled moves\",\n      \"category\": \"1\",\n      \"type\": \"2\",\n      \"muscle_groups\": \"4,6,7\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \"1. Start from a deadhang position with your arms and legs fully extended, and feet off the ground.  \\r\\n2. Raise your knees up towards your chest as high as possible. \\r\\n3. Hold for a brief moment and slowly return to the starting position. \\r\\n4. Repeat for required repetitions. \",\n      \"video_tips\": \"    \",\n      \"pro_tips\": \"Avoid using momentum or swinging during the exercise. \\r\\nPerform the knee raise slowly and controlled.\",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Back, Core, Legs\",\n      \"video\": [\n      {\n      \"id\": \"67\",\n      \"path\": \"57_1454044213.mp4\",\n      \"videothumbnail\": \"57_1454044213.jpg\",\n      \"description\": \"Knee Raises\"\n      }\n      ]\n      }\n      },\n      {\n      \"id\": \"17\",\n      \"row\": \"4\",\n      \"exercise_id\": \"78\",\n      \"duration\": {\n      \"min\": \"20\",\n      \"max\": \"\"\n      },\n      \"unit\": \"times\",\n      \"is_completed\": \"0\",\n      \"created_at\": \"2016-01-22 04:52:22\",\n      \"updated_at\": \"2016-04-04 14:00:58\",\n      \"exercise\": {\n      \"id\": \"78\",\n      \"name\": \"Australian Pullups\",\n      \"description\": \"Get started with developing your grip and back strength\",\n      \"category\": \"1\",\n      \"type\": \"2\",\n      \"muscle_groups\": \"1,4,5,6\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \"1. Grip a bar that is suspended at around waist height, with the feet resting on the ground.\\r\\n2. Squeeze the shoulder blades together and pull your chest up to the bar\",\n      \"video_tips\": \"    \",\n      \"pro_tips\": \"The closer the body is to horizontal the more difficult the exercise becomes.?\\r\\nA set of height adjustable gymnastics rings are a good alternative.\\r\\nKeep whole body engaged and keep your butt in line with your body.?  \",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Shoulders, Back, Arms, Core\",\n      \"video\": [\n      {\n      \"id\": \"78\",\n      \"path\": \"78_1454045971.mp4\",\n      \"videothumbnail\": \"78_1454045971.jpg\",\n      \"description\": \"Australian Pullups\"\n      }\n      ]\n      }\n      },\n      {\n      \"id\": \"18\",\n      \"row\": \"4\",\n      \"exercise_id\": \"49\",\n      \"duration\": {\n      \"min\": \"30\",\n      \"max\": \"\"\n      },\n      \"unit\": \"times\",\n      \"is_completed\": \"0\",\n      \"created_at\": \"2016-01-22 04:52:56\",\n      \"updated_at\": \"2016-04-04 14:19:29\",\n      \"exercise\": {\n      \"id\": \"49\",\n      \"name\": \"Side Triceps\",\n      \"description\": \"Start with the basics of building triceps strength\",\n      \"category\": \"1\",\n      \"type\": \"1\",\n      \"muscle_groups\": \"3\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \" 1. Start with the body on your side\\r\\n2. Put one hand on your shoulder \\r\\n3. Press up with the other arm and hold in extension \",\n      \"video_tips\": \"          \",\n      \"pro_tips\": \" Avoid supporting the movement with your core muscle.      \",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Triceps\",\n      \"video\": [\n      {\n      \"id\": \"43\",\n      \"path\": \"49_1454043404.mp4\",\n      \"videothumbnail\": \"49_1454043404.jpg\",\n      \"description\": \"Side Triceps\"\n      }\n      ]\n      }\n      },\n      {\n      \"id\": \"19\",\n      \"row\": \"4\",\n      \"exercise_id\": \"45\",\n      \"duration\": {\n      \"min\": \"25\",\n      \"max\": \"\"\n      },\n      \"unit\": \"times\",\n      \"is_completed\": \"0\",\n      \"created_at\": \"2016-01-22 04:53:50\",\n      \"updated_at\": \"2016-04-04 14:16:38\",\n      \"exercise\": {\n      \"id\": \"45\",\n      \"name\": \"Squats\",\n      \"description\": \"Get strong with a world class full body compound exercise\",\n      \"category\": \"2\",\n      \"type\": \"1\",\n      \"muscle_groups\": \"7\",\n      \"rewards\": \"7.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \" 1. Start from a standing position\\r\\n2. Go down in a squat \\r\\n3. Keep your hands in front of you and press yourself up \",\n      \"video_tips\": \"      \",\n      \"pro_tips\": \" Lock the knees out while squeezing the glutes to execute properly.\\r\\nSquat deep and hold for 1-2 secs, ass to the grass!     \",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Legs\",\n      \"video\": [\n      {\n      \"id\": \"41\",\n      \"path\": \"45_1454043104.mp4\",\n      \"videothumbnail\": \"45_1454043104.jpg\",\n      \"description\": \"Squats\"\n      }\n      ]\n      }\n      },\n      {\n      \"id\": \"20\",\n      \"row\": \"4\",\n      \"exercise_id\": \"32\",\n      \"duration\": {\n      \"min\": \"20\",\n      \"max\": \"\"\n      },\n      \"unit\": \"times\",\n      \"is_completed\": \"0\",\n      \"created_at\": \"2016-01-22 04:54:35\",\n      \"updated_at\": \"2016-04-04 11:06:44\",\n      \"exercise\": {\n      \"id\": \"32\",\n      \"name\": \"Sprawl\",\n      \"description\": \"Boost your cardio and strength with sprawls\",\n      \"category\": \"1\",\n      \"type\": \"1\",\n      \"muscle_groups\": \"8\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \"1. Start in a standing position\\r\\n2. Go into a straight arm plank position\\r\\n3. Go back up and jump with your hands above your head\",\n      \"video_tips\": \"    \",\n      \"pro_tips\": \"Avoid a hollow back during the movement. \\r\\nKeep the core and lower back engaged at all times.\",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Full Body\",\n      \"video\": [\n      {\n      \"id\": \"29\",\n      \"path\": \"32_1454041954.mp4\",\n      \"videothumbnail\": \"32_1454041954.jpg\",\n      \"description\": \"Sprawl\"\n      }\n      ]\n      }\n      }\n      ],\n      \"exercises\": [],\n      \"workout\": {\n      \"id\": \"3\",\n      \"name\": \"Bragi\",\n      \"description\": \"D,C,A\",\n      \"rounds\": \"5\",\n      \"category\": \"2\",\n      \"type\": \"2\",\n      \"rewards\": \"440\",\n      \"duration\": \"480.00\",\n      \"equipments\": \"Bar/Rings\",\n      \"is_completed\": 0,\n      \"exercises\": {\n      \"round1\": [\n      {\n      \"id\": \"100\",\n      \"workout_id\": \"3\",\n      \"category\": \"1\",\n      \"repititions\": \"10\",\n      \"exercise_id\": \"14\",\n      \"unit\": \"times\",\n      \"round\": \"1\",\n      \"created_at\": \"2016-01-19 04:18:12\",\n      \"updated_at\": \"2016-04-04 09:33:39\",\n      \"exercise\": {\n      \"id\": \"14\",\n      \"name\": \"Incline Pushups\",\n      \"description\": \"Start your journey with the simplest way to develop an athletic physique\",\n      \"category\": \"1\",\n      \"type\": \"1\",\n      \"muscle_groups\": \"1,2,3\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \"1. Place hands on edge of bench, bar or rings at waist height, slightly wider than shoulder width \\r\\n2. Perform regular pushup. Arms should be perpendicular to body. \\r\\n  \",\n      \"video_tips\": \"    \",\n      \"pro_tips\": \"Resistance can be de- or increased by performing movement on different angles.\\r\\nAvoid rounding your spine and doing ?banana back? pushups, try squeezing your core.\\r\\n  \",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Shoulders, Chest, Triceps\"\n      },\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"105\",\n      \"workout_id\": \"3\",\n      \"category\": \"1\",\n      \"repititions\": \"25\",\n      \"exercise_id\": \"36\",\n      \"unit\": \"times\",\n      \"round\": \"1\",\n      \"created_at\": \"2016-01-19 04:19:20\",\n      \"updated_at\": \"2016-04-04 11:12:49\",\n      \"exercise\": {\n      \"id\": \"36\",\n      \"name\": \"High Jumps\",\n      \"description\": \"Do high jumps as a part of restless HIIT workouts\",\n      \"category\": \"1\",\n      \"type\": \"2\",\n      \"muscle_groups\": \"7\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \"1. Start from a standing position\\r\\n2. Jump up and bring your knees to your chest\",\n      \"video_tips\": \"    \",\n      \"pro_tips\": \"Land softly and exhale when the knees are up.\\r\\n  \",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Legs\"\n      },\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"110\",\n      \"workout_id\": \"3\",\n      \"category\": \"1\",\n      \"repititions\": \"7\",\n      \"exercise_id\": \"66\",\n      \"unit\": \"times\",\n      \"round\": \"1\",\n      \"created_at\": \"2016-01-19 04:19:53\",\n      \"updated_at\": \"2016-04-04 14:31:38\",\n      \"exercise\": {\n      \"id\": \"69\",\n      \"name\": \"Jumping Pullups\",\n      \"description\": \"Expose yourself to packed shoulders and hang time\",\n      \"category\": \"1\",\n      \"type\": \"1\",\n      \"muscle_groups\": \"1,5\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \" 1. Grip a bar and jump into the top position of the pull-up exercise\\r\\n2. Straight legs in front of you. \\r\\n3. Slowly go down into a deadhang position \",\n      \"video_tips\": \"        \",\n      \"pro_tips\": \" A deadhang postion requires your shoulder blades down and towards the spine with arms being straight (retraction)\\r\\nAim for three second holds at the top and go down slowly \",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Shoulders, Arms\"\n      },\n      \"is_completed\": 0\n      }\n      ],\n      \"round2\": [\n      {\n      \"id\": \"101\",\n      \"workout_id\": \"3\",\n      \"category\": \"1\",\n      \"repititions\": \"10\",\n      \"exercise_id\": \"14\",\n      \"unit\": \"times\",\n      \"round\": \"2\",\n      \"created_at\": \"2016-01-19 04:18:12\",\n      \"updated_at\": \"2016-04-04 09:33:39\",\n      \"exercise\": {\n      \"id\": \"14\",\n      \"name\": \"Incline Pushups\",\n      \"description\": \"Start your journey with the simplest way to develop an athletic physique\",\n      \"category\": \"1\",\n      \"type\": \"1\",\n      \"muscle_groups\": \"1,2,3\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \"1. Place hands on edge of bench, bar or rings at waist height, slightly wider than shoulder width \\r\\n2. Perform regular pushup. Arms should be perpendicular to body. \\r\\n  \",\n      \"video_tips\": \"    \",\n      \"pro_tips\": \"Resistance can be de- or increased by performing movement on different angles.\\r\\nAvoid rounding your spine and doing ?banana back? pushups, try squeezing your core.\\r\\n  \",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Shoulders, Chest, Triceps\"\n      },\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"106\",\n      \"workout_id\": \"3\",\n      \"category\": \"1\",\n      \"repititions\": \"25\",\n      \"exercise_id\": \"36\",\n      \"unit\": \"times\",\n      \"round\": \"2\",\n      \"created_at\": \"2016-01-19 04:19:20\",\n      \"updated_at\": \"2016-04-04 11:12:49\",\n      \"exercise\": {\n      \"id\": \"36\",\n      \"name\": \"High Jumps\",\n      \"description\": \"Do high jumps as a part of restless HIIT workouts\",\n      \"category\": \"1\",\n      \"type\": \"2\",\n      \"muscle_groups\": \"7\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \"1. Start from a standing position\\r\\n2. Jump up and bring your knees to your chest\",\n      \"video_tips\": \"    \",\n      \"pro_tips\": \"Land softly and exhale when the knees are up.\\r\\n  \",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Legs\"\n      },\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"111\",\n      \"workout_id\": \"3\",\n      \"category\": \"1\",\n      \"repititions\": \"7\",\n      \"exercise_id\": \"66\",\n      \"unit\": \"times\",\n      \"round\": \"2\",\n      \"created_at\": \"2016-01-19 04:19:54\",\n      \"updated_at\": \"2016-04-04 14:31:38\",\n      \"exercise\": {\n      \"id\": \"69\",\n      \"name\": \"Jumping Pullups\",\n      \"description\": \"Expose yourself to packed shoulders and hang time\",\n      \"category\": \"1\",\n      \"type\": \"1\",\n      \"muscle_groups\": \"1,5\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \" 1. Grip a bar and jump into the top position of the pull-up exercise\\r\\n2. Straight legs in front of you. \\r\\n3. Slowly go down into a deadhang position \",\n      \"video_tips\": \"        \",\n      \"pro_tips\": \" A deadhang postion requires your shoulder blades down and towards the spine with arms being straight (retraction)\\r\\nAim for three second holds at the top and go down slowly \",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Shoulders, Arms\"\n      },\n      \"is_completed\": 0\n      }\n      ],\n      \"round3\": [\n      {\n      \"id\": \"102\",\n      \"workout_id\": \"3\",\n      \"category\": \"1\",\n      \"repititions\": \"10\",\n      \"exercise_id\": \"14\",\n      \"unit\": \"times\",\n      \"round\": \"3\",\n      \"created_at\": \"2016-01-19 04:18:12\",\n      \"updated_at\": \"2016-04-04 09:33:39\",\n      \"exercise\": {\n      \"id\": \"14\",\n      \"name\": \"Incline Pushups\",\n      \"description\": \"Start your journey with the simplest way to develop an athletic physique\",\n      \"category\": \"1\",\n      \"type\": \"1\",\n      \"muscle_groups\": \"1,2,3\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \"1. Place hands on edge of bench, bar or rings at waist height, slightly wider than shoulder width \\r\\n2. Perform regular pushup. Arms should be perpendicular to body. \\r\\n  \",\n      \"video_tips\": \"    \",\n      \"pro_tips\": \"Resistance can be de- or increased by performing movement on different angles.\\r\\nAvoid rounding your spine and doing ?banana back? pushups, try squeezing your core.\\r\\n  \",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Shoulders, Chest, Triceps\"\n      },\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"107\",\n      \"workout_id\": \"3\",\n      \"category\": \"1\",\n      \"repititions\": \"25\",\n      \"exercise_id\": \"36\",\n      \"unit\": \"times\",\n      \"round\": \"3\",\n      \"created_at\": \"2016-01-19 04:19:20\",\n      \"updated_at\": \"2016-04-04 11:12:49\",\n      \"exercise\": {\n      \"id\": \"36\",\n      \"name\": \"High Jumps\",\n      \"description\": \"Do high jumps as a part of restless HIIT workouts\",\n      \"category\": \"1\",\n      \"type\": \"2\",\n      \"muscle_groups\": \"7\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \"1. Start from a standing position\\r\\n2. Jump up and bring your knees to your chest\",\n      \"video_tips\": \"    \",\n      \"pro_tips\": \"Land softly and exhale when the knees are up.\\r\\n  \",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Legs\"\n      },\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"112\",\n      \"workout_id\": \"3\",\n      \"category\": \"1\",\n      \"repititions\": \"7\",\n      \"exercise_id\": \"66\",\n      \"unit\": \"times\",\n      \"round\": \"3\",\n      \"created_at\": \"2016-01-19 04:19:54\",\n      \"updated_at\": \"2016-04-04 14:31:38\",\n      \"exercise\": {\n      \"id\": \"69\",\n      \"name\": \"Jumping Pullups\",\n      \"description\": \"Expose yourself to packed shoulders and hang time\",\n      \"category\": \"1\",\n      \"type\": \"1\",\n      \"muscle_groups\": \"1,5\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \" 1. Grip a bar and jump into the top position of the pull-up exercise\\r\\n2. Straight legs in front of you. \\r\\n3. Slowly go down into a deadhang position \",\n      \"video_tips\": \"        \",\n      \"pro_tips\": \" A deadhang postion requires your shoulder blades down and towards the spine with arms being straight (retraction)\\r\\nAim for three second holds at the top and go down slowly \",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Shoulders, Arms\"\n      },\n      \"is_completed\": 0\n      }\n      ]\n      },\n      \"exercise_category\": 1\n      },\n      \"coach_workout_rounds\": 3,\n      \"workout_intensity\": 1,\n      \"hiit\": [],\n      \"stretching\": [\n      {\n      \"id\": \"1\",\n      \"exercise_id\": \"Superman\",\n      \"duration\": {\n      \"min\": 6,\n      \"max\": 13\n      },\n      \"unit\": \"times\",\n      \"is_completed\": \"0\",\n      \"created_at\": \"2016-01-22 07:10:31\",\n      \"updated_at\": \"2016-01-22 07:10:31\"\n      },\n      {\n      \"id\": \"2\",\n      \"exercise_id\": \"Lower Back Strength\",\n      \"duration\": {\n      \"min\": 38,\n      \"max\": 63\n      },\n      \"unit\": \"times\",\n      \"is_completed\": \"0\",\n      \"created_at\": \"2016-01-22 07:15:02\",\n      \"updated_at\": \"2016-01-22 07:15:02\"\n      },\n      {\n      \"id\": \"3\",\n      \"exercise_id\": \"Upper Dog\",\n      \"duration\": {\n      \"min\": 38,\n      \"max\": 75\n      },\n      \"unit\": \"seconds\",\n      \"is_completed\": \"0\",\n      \"created_at\": \"2016-01-22 07:16:03\",\n      \"updated_at\": \"2016-01-22 07:16:03\"\n      },\n      {\n      \"id\": \"4\",\n      \"exercise_id\": \"Child's Pose\",\n      \"duration\": {\n      \"min\": 38,\n      \"max\": 75\n      },\n      \"unit\": \"seconds\",\n      \"is_completed\": \"0\",\n      \"created_at\": \"2016-01-22 07:16:46\",\n      \"updated_at\": \"2016-01-22 07:16:46\"\n      },\n      {\n      \"id\": \"5\",\n      \"exercise_id\": \"L-sit on the floor\",\n      \"duration\": {\n      \"min\": 38,\n      \"max\": 75\n      },\n      \"unit\": \"seconds\",\n      \"is_completed\": \"0\",\n      \"created_at\": \"2016-01-22 07:17:13\",\n      \"updated_at\": \"2016-01-22 07:17:13\"\n      },\n      {\n      \"id\": \"6\",\n      \"exercise_id\": \"Good morning\",\n      \"duration\": {\n      \"min\": 38,\n      \"max\": 75\n      },\n      \"unit\": \"seconds\",\n      \"is_completed\": \"0\",\n      \"created_at\": \"2016-01-22 07:17:43\",\n      \"updated_at\": \"2016-01-22 07:17:43\"\n      },\n      {\n      \"id\": \"7\",\n      \"exercise_id\": \"Chest Opener\",\n      \"duration\": {\n      \"min\": 38,\n      \"max\": 75\n      },\n      \"unit\": \"seconds\",\n      \"is_completed\": \"0\",\n      \"created_at\": \"2016-01-22 07:19:32\",\n      \"updated_at\": \"2016-01-22 07:19:32\"\n      },\n      {\n      \"id\": \"8\",\n      \"exercise_id\": \"Triceps Stretc\",\n      \"duration\": {\n      \"min\": 38,\n      \"max\": 75\n      },\n      \"unit\": \"seconds\",\n      \"is_completed\": \"0\",\n      \"created_at\": \"2016-01-22 07:19:56\",\n      \"updated_at\": \"2016-01-22 07:19:56\"\n      },\n      {\n      \"id\": \"9\",\n      \"exercise_id\": \"Hands Back\",\n      \"duration\": {\n      \"min\": 38,\n      \"max\": 75\n      },\n      \"unit\": \"seconds\",\n      \"is_completed\": \"0\",\n      \"created_at\": \"2016-01-22 07:20:19\",\n      \"updated_at\": \"2016-01-22 07:20:19\"\n      },\n      {\n      \"id\": \"10\",\n      \"exercise_id\": \"Shoulder Stretch\",\n      \"duration\": {\n      \"min\": 38,\n      \"max\": 75\n      },\n      \"unit\": \"seconds\",\n      \"is_completed\": \"0\",\n      \"created_at\": \"2016-01-22 07:20:45\",\n      \"updated_at\": \"2016-01-22 07:20:45\"\n      }\n      ],\n      \"status\": \"pending\"\n      },\n      \"day2\": {\n      \"warmup\": [\n      {\n      \"id\": \"1\",\n      \"name\": \"wall extensions\",\n      \"duration\": {\n      \"min\": \"10\",\n      \"max\": \"20\"\n      },\n      \"unit\": \"times\",\n      \"created_at\": \"2016-01-21 08:55:06\",\n      \"updated_at\": \"2016-01-21 08:55:06\",\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"2\",\n      \"name\": \"band dislocates\",\n      \"duration\": {\n      \"min\": \"10\",\n      \"max\": \"20\"\n      },\n      \"unit\": \"times\",\n      \"created_at\": \"2016-01-21 08:57:38\",\n      \"updated_at\": \"2016-01-21 08:57:38\",\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"3\",\n      \"name\": \"cat-camels\",\n      \"duration\": {\n      \"min\": \"10\",\n      \"max\": \"20\"\n      },\n      \"unit\": \"times\",\n      \"created_at\": \"2016-01-21 09:00:39\",\n      \"updated_at\": \"2016-01-21 09:00:39\",\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"4\",\n      \"name\": \"scapular shrugs\",\n      \"duration\": {\n      \"min\": \"10\",\n      \"max\": \"20\"\n      },\n      \"unit\": \"times\",\n      \"created_at\": \"2016-01-21 09:01:01\",\n      \"updated_at\": \"2016-01-21 09:01:01\",\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"5\",\n      \"name\": \"full body circles\",\n      \"duration\": {\n      \"min\": \"10\",\n      \"max\": \"20\"\n      },\n      \"unit\": \"times\",\n      \"created_at\": \"2016-01-21 09:01:26\",\n      \"updated_at\": \"2016-01-21 09:01:26\",\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"6\",\n      \"name\": \"Jumping Jacks\",\n      \"duration\": {\n      \"min\": \"100\",\n      \"max\": \"\"\n      },\n      \"unit\": \"seconds\",\n      \"created_at\": \"2016-01-21 09:04:52\",\n      \"updated_at\": \"2016-01-21 09:04:52\",\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"7\",\n      \"name\": \"Arm rotations\",\n      \"duration\": {\n      \"min\": \"120\",\n      \"max\": \"\"\n      },\n      \"unit\": \"times\",\n      \"created_at\": \"2016-01-21 09:05:29\",\n      \"updated_at\": \"2016-01-21 09:05:29\",\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"8\",\n      \"name\": \"High Knees\",\n      \"duration\": {\n      \"min\": \"50\",\n      \"max\": \"\"\n      },\n      \"unit\": \"times\",\n      \"created_at\": \"2016-01-21 09:06:02\",\n      \"updated_at\": \"2016-01-21 09:06:02\",\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"9\",\n      \"name\": \"Shouder rolls\",\n      \"duration\": {\n      \"min\": \"20\",\n      \"max\": \"\"\n      },\n      \"unit\": \"times\",\n      \"created_at\": \"2016-01-21 09:06:34\",\n      \"updated_at\": \"2016-01-21 09:06:34\",\n      \"is_completed\": 0\n      }\n      ],\n      \"is_completed\": 0,\n      \"fundumentals\": [\n      {\n      \"id\": \"6\",\n      \"row\": \"2\",\n      \"exercise_id\": \"64\",\n      \"duration\": {\n      \"min\": \"10\",\n      \"max\": \"\"\n      },\n      \"unit\": \"times\",\n      \"is_completed\": \"0\",\n      \"created_at\": \"2016-01-22 04:29:57\",\n      \"updated_at\": \"2016-04-04 14:27:54\",\n      \"exercise\": {\n      \"id\": \"64\",\n      \"name\": \"Skin the cat\",\n      \"description\": \"Develop your joints mobility and expose yourself to new movement layers\",\n      \"category\": \"1\",\n      \"type\": \"2\",\n      \"muscle_groups\": \"4,5,6\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \" 1. Hands a little more than shoulder width apart\\r\\n2. Raise your knees to the chest\\r\\n3. continuing the movement until the feet pass up through the arms and over head into an inverted hang position.\\r\\n4. Continue to pass the feet round and down toward the ground into the extended 'skin the cat' position.\\r\\n5. Lift your hips and raise the legs back and over to the starting hang position. \",\n      \"video_tips\": \"        \",\n      \"pro_tips\": \" Put your hands closer together to ease up all back lever progressions.\\r\\nDo only half of the movement in the beginning, but fight for completion over time.\\r\\nIncorporate other static elements to challenge yourself during the movement as you master other skills.\\r\\n    \",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Back, Arms, Core\",\n      \"video\": [\n      {\n      \"id\": \"71\",\n      \"path\": \"64_1454045043.mp4\",\n      \"videothumbnail\": \"64_1454045043.jpg\",\n      \"description\": \"Skin the cat\"\n      }\n      ]\n      }\n      },\n      {\n      \"id\": \"7\",\n      \"row\": \"2\",\n      \"exercise_id\": \"14\",\n      \"duration\": {\n      \"min\": \"20\",\n      \"max\": \"\"\n      },\n      \"unit\": \"times\",\n      \"is_completed\": \"0\",\n      \"created_at\": \"2016-01-22 04:31:09\",\n      \"updated_at\": \"2016-04-04 09:33:39\",\n      \"exercise\": {\n      \"id\": \"14\",\n      \"name\": \"Incline Pushups\",\n      \"description\": \"Start your journey with the simplest way to develop an athletic physique\",\n      \"category\": \"1\",\n      \"type\": \"1\",\n      \"muscle_groups\": \"1,2,3\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \"1. Place hands on edge of bench, bar or rings at waist height, slightly wider than shoulder width \\r\\n2. Perform regular pushup. Arms should be perpendicular to body. \\r\\n  \",\n      \"video_tips\": \"    \",\n      \"pro_tips\": \"Resistance can be de- or increased by performing movement on different angles.\\r\\nAvoid rounding your spine and doing ?banana back? pushups, try squeezing your core.\\r\\n  \",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Shoulders, Chest, Triceps\",\n      \"video\": [\n      {\n      \"id\": \"13\",\n      \"path\": \"14_1453984243.mp4\",\n      \"videothumbnail\": \"14_1453984243.jpg\",\n      \"description\": \"Incline Pushups\"\n      }\n      ]\n      }\n      },\n      {\n      \"id\": \"8\",\n      \"row\": \"2\",\n      \"exercise_id\": \"48\",\n      \"duration\": {\n      \"min\": \"30\",\n      \"max\": \"\"\n      },\n      \"unit\": \"times\",\n      \"is_completed\": \"0\",\n      \"created_at\": \"2016-01-22 04:32:04\",\n      \"updated_at\": \"2016-04-04 14:19:00\",\n      \"exercise\": {\n      \"id\": \"48\",\n      \"name\": \"Bench Dips\",\n      \"description\": \"Develop more strength as you increase resistance with your bodyweight\",\n      \"category\": \"1\",\n      \"type\": \"2\",\n      \"muscle_groups\": \"3\",\n      \"rewards\": \"7.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \" 1. Sit on side of bench. \\r\\n2. Place hands on edge of bench. Position feet away from bench and rest heels on floor with legs straight. \\r\\n3. Lower your body with the feet in front of you\\r\\n4. Press your body up and hold in extension \",\n      \"video_tips\": \"      \",\n      \"pro_tips\": \" Don?t rush through your movements to make things easier on yourself. You will sacrifice your form, and in the end, you won?t actually get good at the skills you?re working on.\\r\\nThe closer you put your hands together, the tougher the bench dip becomes. \",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Triceps\",\n      \"video\": [\n      {\n      \"id\": \"62\",\n      \"path\": \"48_1454043291.mp4\",\n      \"videothumbnail\": \"48_1454043291.jpg\",\n      \"description\": \"Bench Dips\"\n      }\n      ]\n      }\n      },\n      {\n      \"id\": \"9\",\n      \"row\": \"2\",\n      \"exercise_id\": \"57\",\n      \"duration\": {\n      \"min\": \"15\",\n      \"max\": \"\"\n      },\n      \"unit\": \"times\",\n      \"is_completed\": \"0\",\n      \"created_at\": \"2016-01-22 04:32:49\",\n      \"updated_at\": \"2016-04-04 12:10:48\",\n      \"exercise\": {\n      \"id\": \"57\",\n      \"name\": \"Knee Raises\",\n      \"description\": \"Develop grip and core strength and get used to slow and controlled moves\",\n      \"category\": \"1\",\n      \"type\": \"2\",\n      \"muscle_groups\": \"4,6,7\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \"1. Start from a deadhang position with your arms and legs fully extended, and feet off the ground.  \\r\\n2. Raise your knees up towards your chest as high as possible. \\r\\n3. Hold for a brief moment and slowly return to the starting position. \\r\\n4. Repeat for required repetitions. \",\n      \"video_tips\": \"    \",\n      \"pro_tips\": \"Avoid using momentum or swinging during the exercise. \\r\\nPerform the knee raise slowly and controlled.\",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Back, Core, Legs\",\n      \"video\": [\n      {\n      \"id\": \"67\",\n      \"path\": \"57_1454044213.mp4\",\n      \"videothumbnail\": \"57_1454044213.jpg\",\n      \"description\": \"Knee Raises\"\n      }\n      ]\n      }\n      },\n      {\n      \"id\": \"10\",\n      \"row\": \"2\",\n      \"exercise_id\": \"42\",\n      \"duration\": {\n      \"min\": \"20\",\n      \"max\": \"\"\n      },\n      \"unit\": \"times\",\n      \"is_completed\": \"0\",\n      \"created_at\": \"2016-01-22 04:33:42\",\n      \"updated_at\": \"2016-04-04 11:22:09\",\n      \"exercise\": {\n      \"id\": \"42\",\n      \"name\": \"Single Leg Deadlift\",\n      \"description\": \"Get your hips mobile and control your balance\",\n      \"category\": \"1\",\n      \"type\": \"2\",\n      \"muscle_groups\": \"7\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \"1. Start from a standing position\\r\\n2. Keeping that knee slightly bent, perform a stiff-legged deadlift by bending at the hip.\\r\\n3. Continue lowering yourself until your upper body is parallel to the ground, and then return to the upright position. \\r\\n4. Repeat for the desired number of repetitions.\",\n      \"video_tips\": \"    \",\n      \"pro_tips\": \"Avoid bending your supporting leg.\\r\\nKeep your non-supporting leg extended behind you for balance.\",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Legs\",\n      \"video\": [\n      {\n      \"id\": \"38\",\n      \"path\": \"42_1454042789.mp4\",\n      \"videothumbnail\": \"42_1454042789.jpg\",\n      \"description\": \"Single Leg Deadlift\"\n      }\n      ]\n      }\n      }\n      ],\n      \"exercises\": [],\n      \"workout\": {\n      \"id\": \"2\",\n      \"name\": \"Borr\",\n      \"description\": \"A,C,E,B\",\n      \"rounds\": \"3\",\n      \"category\": \"2\",\n      \"type\": \"2\",\n      \"rewards\": \"330\",\n      \"duration\": \"1140.00\",\n      \"equipments\": \"Bar/Rings\",\n      \"is_completed\": 0,\n      \"exercises\": {\n      \"round1\": [\n      {\n      \"id\": \"16\",\n      \"workout_id\": \"2\",\n      \"category\": \"1\",\n      \"repititions\": \"25\",\n      \"exercise_id\": \"32\",\n      \"unit\": \"times\",\n      \"round\": \"1\",\n      \"created_at\": \"2016-01-19 03:29:53\",\n      \"updated_at\": \"2016-04-04 11:06:44\",\n      \"exercise\": {\n      \"id\": \"32\",\n      \"name\": \"Sprawl\",\n      \"description\": \"Boost your cardio and strength with sprawls\",\n      \"category\": \"1\",\n      \"type\": \"1\",\n      \"muscle_groups\": \"8\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \"1. Start in a standing position\\r\\n2. Go into a straight arm plank position\\r\\n3. Go back up and jump with your hands above your head\",\n      \"video_tips\": \"    \",\n      \"pro_tips\": \"Avoid a hollow back during the movement. \\r\\nKeep the core and lower back engaged at all times.\",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Full Body\"\n      },\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"19\",\n      \"workout_id\": \"2\",\n      \"category\": \"1\",\n      \"repititions\": \"10\",\n      \"exercise_id\": \"66\",\n      \"unit\": \"times\",\n      \"round\": \"1\",\n      \"created_at\": \"2016-01-19 03:30:29\",\n      \"updated_at\": \"2016-04-04 14:31:38\",\n      \"exercise\": {\n      \"id\": \"69\",\n      \"name\": \"Jumping Pullups\",\n      \"description\": \"Expose yourself to packed shoulders and hang time\",\n      \"category\": \"1\",\n      \"type\": \"1\",\n      \"muscle_groups\": \"1,5\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \" 1. Grip a bar and jump into the top position of the pull-up exercise\\r\\n2. Straight legs in front of you. \\r\\n3. Slowly go down into a deadhang position \",\n      \"video_tips\": \"        \",\n      \"pro_tips\": \" A deadhang postion requires your shoulder blades down and towards the spine with arms being straight (retraction)\\r\\nAim for three second holds at the top and go down slowly \",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Shoulders, Arms\"\n      },\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"22\",\n      \"workout_id\": \"2\",\n      \"category\": \"1\",\n      \"repititions\": \"40\",\n      \"exercise_id\": \"9\",\n      \"unit\": \"times\",\n      \"round\": \"1\",\n      \"created_at\": \"2016-01-19 03:30:59\",\n      \"updated_at\": \"2016-04-04 09:22:17\",\n      \"exercise\": {\n      \"id\": \"9\",\n      \"name\": \"Crunches\",\n      \"description\": \"Do the most admired sixpack exercise in the world\",\n      \"category\": \"1\",\n      \"type\": \"1\",\n      \"muscle_groups\": \"6\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \"1. Starting position is with lying face up on the floor with knees bent. \\r\\n2. Move torso up and touch your knees with your hands\\r\\n3. Lower body to the floor and repeat\\r\\n  \",\n      \"video_tips\": \"    \",\n      \"pro_tips\": \"Do variations in tempo. Aim for one count up and three counts down.\\r\\nIf you have a tendency to interlace your fingers and yank your head, place your hands cross-chest.\",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Core\"\n      },\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"25\",\n      \"workout_id\": \"2\",\n      \"category\": \"1\",\n      \"repititions\": \"30\",\n      \"exercise_id\": \"49\",\n      \"unit\": \"times\",\n      \"round\": \"1\",\n      \"created_at\": \"2016-01-19 03:31:40\",\n      \"updated_at\": \"2016-04-04 14:19:29\",\n      \"exercise\": {\n      \"id\": \"49\",\n      \"name\": \"Side Triceps\",\n      \"description\": \"Start with the basics of building triceps strength\",\n      \"category\": \"1\",\n      \"type\": \"1\",\n      \"muscle_groups\": \"3\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \" 1. Start with the body on your side\\r\\n2. Put one hand on your shoulder \\r\\n3. Press up with the other arm and hold in extension \",\n      \"video_tips\": \"          \",\n      \"pro_tips\": \" Avoid supporting the movement with your core muscle.      \",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Triceps\"\n      },\n      \"is_completed\": 0\n      }\n      ],\n      \"round2\": [\n      {\n      \"id\": \"17\",\n      \"workout_id\": \"2\",\n      \"category\": \"1\",\n      \"repititions\": \"25\",\n      \"exercise_id\": \"32\",\n      \"unit\": \"times\",\n      \"round\": \"2\",\n      \"created_at\": \"2016-01-19 03:29:53\",\n      \"updated_at\": \"2016-04-04 11:06:44\",\n      \"exercise\": {\n      \"id\": \"32\",\n      \"name\": \"Sprawl\",\n      \"description\": \"Boost your cardio and strength with sprawls\",\n      \"category\": \"1\",\n      \"type\": \"1\",\n      \"muscle_groups\": \"8\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \"1. Start in a standing position\\r\\n2. Go into a straight arm plank position\\r\\n3. Go back up and jump with your hands above your head\",\n      \"video_tips\": \"    \",\n      \"pro_tips\": \"Avoid a hollow back during the movement. \\r\\nKeep the core and lower back engaged at all times.\",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Full Body\"\n      },\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"20\",\n      \"workout_id\": \"2\",\n      \"category\": \"1\",\n      \"repititions\": \"10\",\n      \"exercise_id\": \"66\",\n      \"unit\": \"times\",\n      \"round\": \"2\",\n      \"created_at\": \"2016-01-19 03:30:30\",\n      \"updated_at\": \"2016-04-04 14:31:38\",\n      \"exercise\": {\n      \"id\": \"69\",\n      \"name\": \"Jumping Pullups\",\n      \"description\": \"Expose yourself to packed shoulders and hang time\",\n      \"category\": \"1\",\n      \"type\": \"1\",\n      \"muscle_groups\": \"1,5\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \" 1. Grip a bar and jump into the top position of the pull-up exercise\\r\\n2. Straight legs in front of you. \\r\\n3. Slowly go down into a deadhang position \",\n      \"video_tips\": \"        \",\n      \"pro_tips\": \" A deadhang postion requires your shoulder blades down and towards the spine with arms being straight (retraction)\\r\\nAim for three second holds at the top and go down slowly \",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Shoulders, Arms\"\n      },\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"23\",\n      \"workout_id\": \"2\",\n      \"category\": \"1\",\n      \"repititions\": \"40\",\n      \"exercise_id\": \"9\",\n      \"unit\": \"times\",\n      \"round\": \"2\",\n      \"created_at\": \"2016-01-19 03:30:59\",\n      \"updated_at\": \"2016-04-04 09:22:17\",\n      \"exercise\": {\n      \"id\": \"9\",\n      \"name\": \"Crunches\",\n      \"description\": \"Do the most admired sixpack exercise in the world\",\n      \"category\": \"1\",\n      \"type\": \"1\",\n      \"muscle_groups\": \"6\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \"1. Starting position is with lying face up on the floor with knees bent. \\r\\n2. Move torso up and touch your knees with your hands\\r\\n3. Lower body to the floor and repeat\\r\\n  \",\n      \"video_tips\": \"    \",\n      \"pro_tips\": \"Do variations in tempo. Aim for one count up and three counts down.\\r\\nIf you have a tendency to interlace your fingers and yank your head, place your hands cross-chest.\",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Core\"\n      },\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"26\",\n      \"workout_id\": \"2\",\n      \"category\": \"1\",\n      \"repititions\": \"30\",\n      \"exercise_id\": \"49\",\n      \"unit\": \"times\",\n      \"round\": \"2\",\n      \"created_at\": \"2016-01-19 03:31:41\",\n      \"updated_at\": \"2016-04-04 14:19:29\",\n      \"exercise\": {\n      \"id\": \"49\",\n      \"name\": \"Side Triceps\",\n      \"description\": \"Start with the basics of building triceps strength\",\n      \"category\": \"1\",\n      \"type\": \"1\",\n      \"muscle_groups\": \"3\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \" 1. Start with the body on your side\\r\\n2. Put one hand on your shoulder \\r\\n3. Press up with the other arm and hold in extension \",\n      \"video_tips\": \"          \",\n      \"pro_tips\": \" Avoid supporting the movement with your core muscle.      \",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Triceps\"\n      },\n      \"is_completed\": 0\n      }\n      ],\n      \"round3\": [\n      {\n      \"id\": \"18\",\n      \"workout_id\": \"2\",\n      \"category\": \"1\",\n      \"repititions\": \"25\",\n      \"exercise_id\": \"32\",\n      \"unit\": \"times\",\n      \"round\": \"3\",\n      \"created_at\": \"2016-01-19 03:29:53\",\n      \"updated_at\": \"2016-04-04 11:06:44\",\n      \"exercise\": {\n      \"id\": \"32\",\n      \"name\": \"Sprawl\",\n      \"description\": \"Boost your cardio and strength with sprawls\",\n      \"category\": \"1\",\n      \"type\": \"1\",\n      \"muscle_groups\": \"8\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \"1. Start in a standing position\\r\\n2. Go into a straight arm plank position\\r\\n3. Go back up and jump with your hands above your head\",\n      \"video_tips\": \"    \",\n      \"pro_tips\": \"Avoid a hollow back during the movement. \\r\\nKeep the core and lower back engaged at all times.\",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Full Body\"\n      },\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"21\",\n      \"workout_id\": \"2\",\n      \"category\": \"1\",\n      \"repititions\": \"10\",\n      \"exercise_id\": \"66\",\n      \"unit\": \"times\",\n      \"round\": \"3\",\n      \"created_at\": \"2016-01-19 03:30:30\",\n      \"updated_at\": \"2016-04-04 14:31:38\",\n      \"exercise\": {\n      \"id\": \"69\",\n      \"name\": \"Jumping Pullups\",\n      \"description\": \"Expose yourself to packed shoulders and hang time\",\n      \"category\": \"1\",\n      \"type\": \"1\",\n      \"muscle_groups\": \"1,5\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \" 1. Grip a bar and jump into the top position of the pull-up exercise\\r\\n2. Straight legs in front of you. \\r\\n3. Slowly go down into a deadhang position \",\n      \"video_tips\": \"        \",\n      \"pro_tips\": \" A deadhang postion requires your shoulder blades down and towards the spine with arms being straight (retraction)\\r\\nAim for three second holds at the top and go down slowly \",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Shoulders, Arms\"\n      },\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"24\",\n      \"workout_id\": \"2\",\n      \"category\": \"1\",\n      \"repititions\": \"40\",\n      \"exercise_id\": \"9\",\n      \"unit\": \"times\",\n      \"round\": \"3\",\n      \"created_at\": \"2016-01-19 03:30:59\",\n      \"updated_at\": \"2016-04-04 09:22:17\",\n      \"exercise\": {\n      \"id\": \"9\",\n      \"name\": \"Crunches\",\n      \"description\": \"Do the most admired sixpack exercise in the world\",\n      \"category\": \"1\",\n      \"type\": \"1\",\n      \"muscle_groups\": \"6\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \"1. Starting position is with lying face up on the floor with knees bent. \\r\\n2. Move torso up and touch your knees with your hands\\r\\n3. Lower body to the floor and repeat\\r\\n  \",\n      \"video_tips\": \"    \",\n      \"pro_tips\": \"Do variations in tempo. Aim for one count up and three counts down.\\r\\nIf you have a tendency to interlace your fingers and yank your head, place your hands cross-chest.\",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Core\"\n      },\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"27\",\n      \"workout_id\": \"2\",\n      \"category\": \"1\",\n      \"repititions\": \"30\",\n      \"exercise_id\": \"49\",\n      \"unit\": \"times\",\n      \"round\": \"3\",\n      \"created_at\": \"2016-01-19 03:31:41\",\n      \"updated_at\": \"2016-04-04 14:19:29\",\n      \"exercise\": {\n      \"id\": \"49\",\n      \"name\": \"Side Triceps\",\n      \"description\": \"Start with the basics of building triceps strength\",\n      \"category\": \"1\",\n      \"type\": \"1\",\n      \"muscle_groups\": \"3\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \" 1. Start with the body on your side\\r\\n2. Put one hand on your shoulder \\r\\n3. Press up with the other arm and hold in extension \",\n      \"video_tips\": \"          \",\n      \"pro_tips\": \" Avoid supporting the movement with your core muscle.      \",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Triceps\"\n      },\n      \"is_completed\": 0\n      }\n      ]\n      },\n      \"exercise_category\": 1\n      },\n      \"coach_workout_rounds\": 3,\n      \"workout_intensity\": 1,\n      \"hiit\": [],\n      \"stretching\": [\n      {\n      \"id\": \"1\",\n      \"exercise_id\": \"Superman\",\n      \"duration\": {\n      \"min\": 6,\n      \"max\": 13\n      },\n      \"unit\": \"times\",\n      \"is_completed\": \"0\",\n      \"created_at\": \"2016-01-22 07:10:31\",\n      \"updated_at\": \"2016-01-22 07:10:31\"\n      },\n      {\n      \"id\": \"2\",\n      \"exercise_id\": \"Lower Back Strength\",\n      \"duration\": {\n      \"min\": 38,\n      \"max\": 63\n      },\n      \"unit\": \"times\",\n      \"is_completed\": \"0\",\n      \"created_at\": \"2016-01-22 07:15:02\",\n      \"updated_at\": \"2016-01-22 07:15:02\"\n      },\n      {\n      \"id\": \"3\",\n      \"exercise_id\": \"Upper Dog\",\n      \"duration\": {\n      \"min\": 38,\n      \"max\": 75\n      },\n      \"unit\": \"seconds\",\n      \"is_completed\": \"0\",\n      \"created_at\": \"2016-01-22 07:16:03\",\n      \"updated_at\": \"2016-01-22 07:16:03\"\n      },\n      {\n      \"id\": \"4\",\n      \"exercise_id\": \"Child's Pose\",\n      \"duration\": {\n      \"min\": 38,\n      \"max\": 75\n      },\n      \"unit\": \"seconds\",\n      \"is_completed\": \"0\",\n      \"created_at\": \"2016-01-22 07:16:46\",\n      \"updated_at\": \"2016-01-22 07:16:46\"\n      },\n      {\n      \"id\": \"5\",\n      \"exercise_id\": \"L-sit on the floor\",\n      \"duration\": {\n      \"min\": 38,\n      \"max\": 75\n      },\n      \"unit\": \"seconds\",\n      \"is_completed\": \"0\",\n      \"created_at\": \"2016-01-22 07:17:13\",\n      \"updated_at\": \"2016-01-22 07:17:13\"\n      },\n      {\n      \"id\": \"6\",\n      \"exercise_id\": \"Good morning\",\n      \"duration\": {\n      \"min\": 38,\n      \"max\": 75\n      },\n      \"unit\": \"seconds\",\n      \"is_completed\": \"0\",\n      \"created_at\": \"2016-01-22 07:17:43\",\n      \"updated_at\": \"2016-01-22 07:17:43\"\n      },\n      {\n      \"id\": \"7\",\n      \"exercise_id\": \"Chest Opener\",\n      \"duration\": {\n      \"min\": 38,\n      \"max\": 75\n      },\n      \"unit\": \"seconds\",\n      \"is_completed\": \"0\",\n      \"created_at\": \"2016-01-22 07:19:32\",\n      \"updated_at\": \"2016-01-22 07:19:32\"\n      },\n      {\n      \"id\": \"8\",\n      \"exercise_id\": \"Triceps Stretc\",\n      \"duration\": {\n      \"min\": 38,\n      \"max\": 75\n      },\n      \"unit\": \"seconds\",\n      \"is_completed\": \"0\",\n      \"created_at\": \"2016-01-22 07:19:56\",\n      \"updated_at\": \"2016-01-22 07:19:56\"\n      },\n      {\n      \"id\": \"9\",\n      \"exercise_id\": \"Hands Back\",\n      \"duration\": {\n      \"min\": 38,\n      \"max\": 75\n      },\n      \"unit\": \"seconds\",\n      \"is_completed\": \"0\",\n      \"created_at\": \"2016-01-22 07:20:19\",\n      \"updated_at\": \"2016-01-22 07:20:19\"\n      },\n      {\n      \"id\": \"10\",\n      \"exercise_id\": \"Shoulder Stretch\",\n      \"duration\": {\n      \"min\": 38,\n      \"max\": 75\n      },\n      \"unit\": \"seconds\",\n      \"is_completed\": \"0\",\n      \"created_at\": \"2016-01-22 07:20:45\",\n      \"updated_at\": \"2016-01-22 07:20:45\"\n      }\n      ],\n      \"status\": \"pending\"\n      },\n      \"day3\": {\n      \"warmup\": [\n      {\n      \"id\": \"1\",\n      \"name\": \"wall extensions\",\n      \"duration\": {\n      \"min\": \"10\",\n      \"max\": \"20\"\n      },\n      \"unit\": \"times\",\n      \"created_at\": \"2016-01-21 08:55:06\",\n      \"updated_at\": \"2016-01-21 08:55:06\",\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"2\",\n      \"name\": \"band dislocates\",\n      \"duration\": {\n      \"min\": \"10\",\n      \"max\": \"20\"\n      },\n      \"unit\": \"times\",\n      \"created_at\": \"2016-01-21 08:57:38\",\n      \"updated_at\": \"2016-01-21 08:57:38\",\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"3\",\n      \"name\": \"cat-camels\",\n      \"duration\": {\n      \"min\": \"10\",\n      \"max\": \"20\"\n      },\n      \"unit\": \"times\",\n      \"created_at\": \"2016-01-21 09:00:39\",\n      \"updated_at\": \"2016-01-21 09:00:39\",\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"4\",\n      \"name\": \"scapular shrugs\",\n      \"duration\": {\n      \"min\": \"10\",\n      \"max\": \"20\"\n      },\n      \"unit\": \"times\",\n      \"created_at\": \"2016-01-21 09:01:01\",\n      \"updated_at\": \"2016-01-21 09:01:01\",\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"5\",\n      \"name\": \"full body circles\",\n      \"duration\": {\n      \"min\": \"10\",\n      \"max\": \"20\"\n      },\n      \"unit\": \"times\",\n      \"created_at\": \"2016-01-21 09:01:26\",\n      \"updated_at\": \"2016-01-21 09:01:26\",\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"6\",\n      \"name\": \"Jumping Jacks\",\n      \"duration\": {\n      \"min\": \"100\",\n      \"max\": \"\"\n      },\n      \"unit\": \"seconds\",\n      \"created_at\": \"2016-01-21 09:04:52\",\n      \"updated_at\": \"2016-01-21 09:04:52\",\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"7\",\n      \"name\": \"Arm rotations\",\n      \"duration\": {\n      \"min\": \"120\",\n      \"max\": \"\"\n      },\n      \"unit\": \"times\",\n      \"created_at\": \"2016-01-21 09:05:29\",\n      \"updated_at\": \"2016-01-21 09:05:29\",\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"8\",\n      \"name\": \"High Knees\",\n      \"duration\": {\n      \"min\": \"50\",\n      \"max\": \"\"\n      },\n      \"unit\": \"times\",\n      \"created_at\": \"2016-01-21 09:06:02\",\n      \"updated_at\": \"2016-01-21 09:06:02\",\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"9\",\n      \"name\": \"Shouder rolls\",\n      \"duration\": {\n      \"min\": \"20\",\n      \"max\": \"\"\n      },\n      \"unit\": \"times\",\n      \"created_at\": \"2016-01-21 09:06:34\",\n      \"updated_at\": \"2016-01-21 09:06:34\",\n      \"is_completed\": 0\n      }\n      ],\n      \"is_completed\": 0,\n      \"fundumentals\": [\n      {\n      \"id\": \"11\",\n      \"row\": \"3\",\n      \"exercise_id\": \"64\",\n      \"duration\": {\n      \"min\": \"10\",\n      \"max\": \"\"\n      },\n      \"unit\": \"times\",\n      \"is_completed\": \"0\",\n      \"created_at\": \"2016-01-22 04:35:13\",\n      \"updated_at\": \"2016-04-04 14:27:54\",\n      \"exercise\": {\n      \"id\": \"64\",\n      \"name\": \"Skin the cat\",\n      \"description\": \"Develop your joints mobility and expose yourself to new movement layers\",\n      \"category\": \"1\",\n      \"type\": \"2\",\n      \"muscle_groups\": \"4,5,6\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \" 1. Hands a little more than shoulder width apart\\r\\n2. Raise your knees to the chest\\r\\n3. continuing the movement until the feet pass up through the arms and over head into an inverted hang position.\\r\\n4. Continue to pass the feet round and down toward the ground into the extended 'skin the cat' position.\\r\\n5. Lift your hips and raise the legs back and over to the starting hang position. \",\n      \"video_tips\": \"        \",\n      \"pro_tips\": \" Put your hands closer together to ease up all back lever progressions.\\r\\nDo only half of the movement in the beginning, but fight for completion over time.\\r\\nIncorporate other static elements to challenge yourself during the movement as you master other skills.\\r\\n    \",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Back, Arms, Core\",\n      \"video\": [\n      {\n      \"id\": \"71\",\n      \"path\": \"64_1454045043.mp4\",\n      \"videothumbnail\": \"64_1454045043.jpg\",\n      \"description\": \"Skin the cat\"\n      }\n      ]\n      }\n      },\n      {\n      \"id\": \"12\",\n      \"row\": \"3\",\n      \"exercise_id\": \"12\",\n      \"duration\": {\n      \"min\": \"20\",\n      \"max\": \"\"\n      },\n      \"unit\": \"times\",\n      \"is_completed\": \"0\",\n      \"created_at\": \"2016-01-22 04:36:16\",\n      \"updated_at\": \"2016-04-04 09:26:06\",\n      \"exercise\": {\n      \"id\": \"12\",\n      \"name\": \"Pushups\",\n      \"description\": \"Perform the most popular exercise of all time with real strength\",\n      \"category\": \"2\",\n      \"type\": \"1\",\n      \"muscle_groups\": \"1,2,3\",\n      \"rewards\": \"7.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \" 1. Lie on the floor face down and place your hands in a standard pushup position.\\r\\n 2. Next, lower yourself downward until your chest almost touches the floor as you inhale.\\r\\n 3. Exhale and press your upper body back up to the starting position while squeezing your chest.\\r\\n 4. Repeat, after a brief pause at the top contracted position.\\r\\n\",\n      \"video_tips\": \"      \",\n      \"pro_tips\": \"Do them extra slow and hold it in highest and lowest position to get strength.\\r\\nOne of the most common push-up mistakes is flaring out the elbows out instead of keeping them at your sides.\\r\\nIf too easy, try Spiderman and Diamond Pushups or wear a weigthed vest.\",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Shoulders, Chest, Triceps\",\n      \"video\": [\n      {\n      \"id\": \"57\",\n      \"path\": \"12_1453984139.mp4\",\n      \"videothumbnail\": \"12_1453984139.jpg\",\n      \"description\": \"Pushups\"\n      }\n      ]\n      }\n      },\n      {\n      \"id\": \"13\",\n      \"row\": \"3\",\n      \"exercise_id\": \"49\",\n      \"duration\": {\n      \"min\": \"30\",\n      \"max\": \"\"\n      },\n      \"unit\": \"times\",\n      \"is_completed\": \"0\",\n      \"created_at\": \"2016-01-22 04:36:49\",\n      \"updated_at\": \"2016-04-04 14:19:29\",\n      \"exercise\": {\n      \"id\": \"49\",\n      \"name\": \"Side Triceps\",\n      \"description\": \"Start with the basics of building triceps strength\",\n      \"category\": \"1\",\n      \"type\": \"1\",\n      \"muscle_groups\": \"3\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \" 1. Start with the body on your side\\r\\n2. Put one hand on your shoulder \\r\\n3. Press up with the other arm and hold in extension \",\n      \"video_tips\": \"          \",\n      \"pro_tips\": \" Avoid supporting the movement with your core muscle.      \",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Triceps\",\n      \"video\": [\n      {\n      \"id\": \"43\",\n      \"path\": \"49_1454043404.mp4\",\n      \"videothumbnail\": \"49_1454043404.jpg\",\n      \"description\": \"Side Triceps\"\n      }\n      ]\n      }\n      },\n      {\n      \"id\": \"14\",\n      \"row\": \"3\",\n      \"exercise_id\": \"4\",\n      \"duration\": {\n      \"min\": \"60\",\n      \"max\": \"90\"\n      },\n      \"unit\": \"seconds\",\n      \"is_completed\": \"0\",\n      \"created_at\": \"2016-01-22 04:37:32\",\n      \"updated_at\": \"2016-04-04 14:02:11\",\n      \"exercise\": {\n      \"id\": \"4\",\n      \"name\": \"Plank\",\n      \"description\": \"The plank builds your isometric strength and helps sculpt your waistline.\",\n      \"category\": \"1\",\n      \"type\": \"1\",\n      \"muscle_groups\": \"1,4,6,8\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"seconds\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \"1. Get into pushup position on the floor.\\r\\n2. Now bend your elbows 90 degrees and rest your weight on your forearms. \\r\\n3. Hold the position for as long as you can.   \",\n      \"video_tips\": \"        \",\n      \"pro_tips\": \"Drive your chest away from the ground and spread your shoulder blades as much as you can.\\r\\nKeep a straight line, from head to toe. \\r\\nDon't collapse your lower back or reach your butt to the sky. Add movement to your plank, rock back and forth on your forearms and toes or shift from side to side.\\r\\nTry advanced variations with alternating sinlge leg support. \\r\\nStart with an incline plank if a straight plank is too hard in the beginning.  \",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Shoulders, Back, Core, Full Body\",\n      \"video\": [\n      {\n      \"id\": \"4\",\n      \"path\": \"4_1453976855.mp4\",\n      \"videothumbnail\": \"4_1453976855.jpg\",\n      \"description\": \"Plank\"\n      }\n      ]\n      }\n      },\n      {\n      \"id\": \"15\",\n      \"row\": \"3\",\n      \"exercise_id\": \"36\",\n      \"duration\": {\n      \"min\": \"20\",\n      \"max\": \"\"\n      },\n      \"unit\": \"times\",\n      \"is_completed\": \"0\",\n      \"created_at\": \"2016-01-22 04:37:57\",\n      \"updated_at\": \"2016-04-04 11:12:49\",\n      \"exercise\": {\n      \"id\": \"36\",\n      \"name\": \"High Jumps\",\n      \"description\": \"Do high jumps as a part of restless HIIT workouts\",\n      \"category\": \"1\",\n      \"type\": \"2\",\n      \"muscle_groups\": \"7\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \"1. Start from a standing position\\r\\n2. Jump up and bring your knees to your chest\",\n      \"video_tips\": \"    \",\n      \"pro_tips\": \"Land softly and exhale when the knees are up.\\r\\n  \",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Legs\",\n      \"video\": [\n      {\n      \"id\": \"33\",\n      \"path\": \"36_1454042273.mp4\",\n      \"videothumbnail\": \"36_1454042273.jpg\",\n      \"description\": \"High Jumps\"\n      }\n      ]\n      }\n      }\n      ],\n      \"exercises\": [],\n      \"workout\": {\n      \"id\": \"9\",\n      \"name\": \"Elli\",\n      \"description\": \"C,A,D\",\n      \"rounds\": \"3\",\n      \"category\": \"2\",\n      \"type\": \"1\",\n      \"rewards\": \"330\",\n      \"duration\": \"420.00\",\n      \"equipments\": \"Bar/Rings\",\n      \"is_completed\": 0,\n      \"exercises\": {\n      \"round1\": [\n      {\n      \"id\": \"325\",\n      \"workout_id\": \"9\",\n      \"category\": \"1\",\n      \"repititions\": \"20\",\n      \"exercise_id\": \"39\",\n      \"unit\": \"times\",\n      \"round\": \"1\",\n      \"created_at\": \"2016-01-19 05:28:43\",\n      \"updated_at\": \"2016-04-04 11:16:09\",\n      \"exercise\": {\n      \"id\": \"39\",\n      \"name\": \"Climbers\",\n      \"description\": \"Increase your energy, health and endurance\",\n      \"category\": \"1\",\n      \"type\": \"2\",\n      \"muscle_groups\": \"7\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \"1. Start in pushup position\\r\\n2. Alternate your legs up to hand level\\r\\n3. Repeat\",\n      \"video_tips\": \"    \",\n      \"pro_tips\": \"If you are new to mountain climbers perform the knee to chest motion slow and steadily then build it up to a faster pace for a better cardio effect.    \",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Legs\"\n      },\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"328\",\n      \"workout_id\": \"9\",\n      \"category\": \"1\",\n      \"repititions\": \"15\",\n      \"exercise_id\": \"66\",\n      \"unit\": \"times\",\n      \"round\": \"1\",\n      \"created_at\": \"2016-01-19 05:29:04\",\n      \"updated_at\": \"2016-04-04 14:31:38\",\n      \"exercise\": {\n      \"id\": \"69\",\n      \"name\": \"Jumping Pullups\",\n      \"description\": \"Expose yourself to packed shoulders and hang time\",\n      \"category\": \"1\",\n      \"type\": \"1\",\n      \"muscle_groups\": \"1,5\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \" 1. Grip a bar and jump into the top position of the pull-up exercise\\r\\n2. Straight legs in front of you. \\r\\n3. Slowly go down into a deadhang position \",\n      \"video_tips\": \"        \",\n      \"pro_tips\": \" A deadhang postion requires your shoulder blades down and towards the spine with arms being straight (retraction)\\r\\nAim for three second holds at the top and go down slowly \",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Shoulders, Arms\"\n      },\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"331\",\n      \"workout_id\": \"9\",\n      \"category\": \"1\",\n      \"repititions\": \"15\",\n      \"exercise_id\": \"22\",\n      \"unit\": \"times\",\n      \"round\": \"1\",\n      \"created_at\": \"2016-01-19 05:29:28\",\n      \"updated_at\": \"2016-04-04 14:09:31\",\n      \"exercise\": {\n      \"id\": \"22\",\n      \"name\": \"Spiderman Pushups\",\n      \"description\": \"Learn to control your body and create body awareness\",\n      \"category\": \"1\",\n      \"type\": \"2\",\n      \"muscle_groups\": \"2,3,5,6\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \"  1. Start in a standard pushup position.\\r\\n 2. Next, lower yourself downward until your chest almost touches the floor as you inhale.\\r\\n 3. Bring your knees to your elbows as you go down and alternate with next repition. \",\n      \"video_tips\": \"      \",\n      \"pro_tips\": \" Pretend you are balancing something on your tailbone as you do the Spiderman pushup to maintain the correct plank position. This keeps your hips from rotating. \",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Chest, Triceps, Arms, Core\"\n      },\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"337\",\n      \"workout_id\": \"9\",\n      \"category\": \"1\",\n      \"repititions\": \"25\",\n      \"exercise_id\": \"57\",\n      \"unit\": \"times\",\n      \"round\": \"1\",\n      \"created_at\": \"2016-01-19 05:30:04\",\n      \"updated_at\": \"2016-04-04 12:10:48\",\n      \"exercise\": {\n      \"id\": \"57\",\n      \"name\": \"Knee Raises\",\n      \"description\": \"Develop grip and core strength and get used to slow and controlled moves\",\n      \"category\": \"1\",\n      \"type\": \"2\",\n      \"muscle_groups\": \"4,6,7\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \"1. Start from a deadhang position with your arms and legs fully extended, and feet off the ground.  \\r\\n2. Raise your knees up towards your chest as high as possible. \\r\\n3. Hold for a brief moment and slowly return to the starting position. \\r\\n4. Repeat for required repetitions. \",\n      \"video_tips\": \"    \",\n      \"pro_tips\": \"Avoid using momentum or swinging during the exercise. \\r\\nPerform the knee raise slowly and controlled.\",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Back, Core, Legs\"\n      },\n      \"is_completed\": 0\n      }\n      ],\n      \"round2\": [\n      {\n      \"id\": \"326\",\n      \"workout_id\": \"9\",\n      \"category\": \"1\",\n      \"repititions\": \"20\",\n      \"exercise_id\": \"39\",\n      \"unit\": \"times\",\n      \"round\": \"2\",\n      \"created_at\": \"2016-01-19 05:28:43\",\n      \"updated_at\": \"2016-04-04 11:16:09\",\n      \"exercise\": {\n      \"id\": \"39\",\n      \"name\": \"Climbers\",\n      \"description\": \"Increase your energy, health and endurance\",\n      \"category\": \"1\",\n      \"type\": \"2\",\n      \"muscle_groups\": \"7\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \"1. Start in pushup position\\r\\n2. Alternate your legs up to hand level\\r\\n3. Repeat\",\n      \"video_tips\": \"    \",\n      \"pro_tips\": \"If you are new to mountain climbers perform the knee to chest motion slow and steadily then build it up to a faster pace for a better cardio effect.    \",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Legs\"\n      },\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"329\",\n      \"workout_id\": \"9\",\n      \"category\": \"1\",\n      \"repititions\": \"15\",\n      \"exercise_id\": \"66\",\n      \"unit\": \"times\",\n      \"round\": \"2\",\n      \"created_at\": \"2016-01-19 05:29:05\",\n      \"updated_at\": \"2016-04-04 14:31:38\",\n      \"exercise\": {\n      \"id\": \"69\",\n      \"name\": \"Jumping Pullups\",\n      \"description\": \"Expose yourself to packed shoulders and hang time\",\n      \"category\": \"1\",\n      \"type\": \"1\",\n      \"muscle_groups\": \"1,5\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \" 1. Grip a bar and jump into the top position of the pull-up exercise\\r\\n2. Straight legs in front of you. \\r\\n3. Slowly go down into a deadhang position \",\n      \"video_tips\": \"        \",\n      \"pro_tips\": \" A deadhang postion requires your shoulder blades down and towards the spine with arms being straight (retraction)\\r\\nAim for three second holds at the top and go down slowly \",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Shoulders, Arms\"\n      },\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"332\",\n      \"workout_id\": \"9\",\n      \"category\": \"1\",\n      \"repititions\": \"15\",\n      \"exercise_id\": \"22\",\n      \"unit\": \"times\",\n      \"round\": \"2\",\n      \"created_at\": \"2016-01-19 05:29:28\",\n      \"updated_at\": \"2016-04-04 14:09:31\",\n      \"exercise\": {\n      \"id\": \"22\",\n      \"name\": \"Spiderman Pushups\",\n      \"description\": \"Learn to control your body and create body awareness\",\n      \"category\": \"1\",\n      \"type\": \"2\",\n      \"muscle_groups\": \"2,3,5,6\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \"  1. Start in a standard pushup position.\\r\\n 2. Next, lower yourself downward until your chest almost touches the floor as you inhale.\\r\\n 3. Bring your knees to your elbows as you go down and alternate with next repition. \",\n      \"video_tips\": \"      \",\n      \"pro_tips\": \" Pretend you are balancing something on your tailbone as you do the Spiderman pushup to maintain the correct plank position. This keeps your hips from rotating. \",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Chest, Triceps, Arms, Core\"\n      },\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"338\",\n      \"workout_id\": \"9\",\n      \"category\": \"1\",\n      \"repititions\": \"25\",\n      \"exercise_id\": \"57\",\n      \"unit\": \"times\",\n      \"round\": \"2\",\n      \"created_at\": \"2016-01-19 05:30:04\",\n      \"updated_at\": \"2016-04-04 12:10:48\",\n      \"exercise\": {\n      \"id\": \"57\",\n      \"name\": \"Knee Raises\",\n      \"description\": \"Develop grip and core strength and get used to slow and controlled moves\",\n      \"category\": \"1\",\n      \"type\": \"2\",\n      \"muscle_groups\": \"4,6,7\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \"1. Start from a deadhang position with your arms and legs fully extended, and feet off the ground.  \\r\\n2. Raise your knees up towards your chest as high as possible. \\r\\n3. Hold for a brief moment and slowly return to the starting position. \\r\\n4. Repeat for required repetitions. \",\n      \"video_tips\": \"    \",\n      \"pro_tips\": \"Avoid using momentum or swinging during the exercise. \\r\\nPerform the knee raise slowly and controlled.\",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Back, Core, Legs\"\n      },\n      \"is_completed\": 0\n      }\n      ],\n      \"round3\": [\n      {\n      \"id\": \"327\",\n      \"workout_id\": \"9\",\n      \"category\": \"1\",\n      \"repititions\": \"20\",\n      \"exercise_id\": \"39\",\n      \"unit\": \"times\",\n      \"round\": \"3\",\n      \"created_at\": \"2016-01-19 05:28:43\",\n      \"updated_at\": \"2016-04-04 11:16:09\",\n      \"exercise\": {\n      \"id\": \"39\",\n      \"name\": \"Climbers\",\n      \"description\": \"Increase your energy, health and endurance\",\n      \"category\": \"1\",\n      \"type\": \"2\",\n      \"muscle_groups\": \"7\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \"1. Start in pushup position\\r\\n2. Alternate your legs up to hand level\\r\\n3. Repeat\",\n      \"video_tips\": \"    \",\n      \"pro_tips\": \"If you are new to mountain climbers perform the knee to chest motion slow and steadily then build it up to a faster pace for a better cardio effect.    \",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Legs\"\n      },\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"330\",\n      \"workout_id\": \"9\",\n      \"category\": \"1\",\n      \"repititions\": \"15\",\n      \"exercise_id\": \"66\",\n      \"unit\": \"times\",\n      \"round\": \"3\",\n      \"created_at\": \"2016-01-19 05:29:05\",\n      \"updated_at\": \"2016-04-04 14:31:38\",\n      \"exercise\": {\n      \"id\": \"69\",\n      \"name\": \"Jumping Pullups\",\n      \"description\": \"Expose yourself to packed shoulders and hang time\",\n      \"category\": \"1\",\n      \"type\": \"1\",\n      \"muscle_groups\": \"1,5\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \" 1. Grip a bar and jump into the top position of the pull-up exercise\\r\\n2. Straight legs in front of you. \\r\\n3. Slowly go down into a deadhang position \",\n      \"video_tips\": \"        \",\n      \"pro_tips\": \" A deadhang postion requires your shoulder blades down and towards the spine with arms being straight (retraction)\\r\\nAim for three second holds at the top and go down slowly \",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Shoulders, Arms\"\n      },\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"333\",\n      \"workout_id\": \"9\",\n      \"category\": \"1\",\n      \"repititions\": \"15\",\n      \"exercise_id\": \"22\",\n      \"unit\": \"times\",\n      \"round\": \"3\",\n      \"created_at\": \"2016-01-19 05:29:28\",\n      \"updated_at\": \"2016-04-04 14:09:31\",\n      \"exercise\": {\n      \"id\": \"22\",\n      \"name\": \"Spiderman Pushups\",\n      \"description\": \"Learn to control your body and create body awareness\",\n      \"category\": \"1\",\n      \"type\": \"2\",\n      \"muscle_groups\": \"2,3,5,6\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \"  1. Start in a standard pushup position.\\r\\n 2. Next, lower yourself downward until your chest almost touches the floor as you inhale.\\r\\n 3. Bring your knees to your elbows as you go down and alternate with next repition. \",\n      \"video_tips\": \"      \",\n      \"pro_tips\": \" Pretend you are balancing something on your tailbone as you do the Spiderman pushup to maintain the correct plank position. This keeps your hips from rotating. \",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Chest, Triceps, Arms, Core\"\n      },\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"339\",\n      \"workout_id\": \"9\",\n      \"category\": \"1\",\n      \"repititions\": \"25\",\n      \"exercise_id\": \"57\",\n      \"unit\": \"times\",\n      \"round\": \"3\",\n      \"created_at\": \"2016-01-19 05:30:04\",\n      \"updated_at\": \"2016-04-04 12:10:48\",\n      \"exercise\": {\n      \"id\": \"57\",\n      \"name\": \"Knee Raises\",\n      \"description\": \"Develop grip and core strength and get used to slow and controlled moves\",\n      \"category\": \"1\",\n      \"type\": \"2\",\n      \"muscle_groups\": \"4,6,7\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \"1. Start from a deadhang position with your arms and legs fully extended, and feet off the ground.  \\r\\n2. Raise your knees up towards your chest as high as possible. \\r\\n3. Hold for a brief moment and slowly return to the starting position. \\r\\n4. Repeat for required repetitions. \",\n      \"video_tips\": \"    \",\n      \"pro_tips\": \"Avoid using momentum or swinging during the exercise. \\r\\nPerform the knee raise slowly and controlled.\",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Back, Core, Legs\"\n      },\n      \"is_completed\": 0\n      }\n      ]\n      },\n      \"exercise_category\": 1\n      },\n      \"coach_workout_rounds\": 3,\n      \"workout_intensity\": 1,\n      \"hiit\": [],\n      \"stretching\": [\n      {\n      \"id\": \"1\",\n      \"exercise_id\": \"Superman\",\n      \"duration\": {\n      \"min\": 6,\n      \"max\": 13\n      },\n      \"unit\": \"times\",\n      \"is_completed\": \"0\",\n      \"created_at\": \"2016-01-22 07:10:31\",\n      \"updated_at\": \"2016-01-22 07:10:31\"\n      },\n      {\n      \"id\": \"2\",\n      \"exercise_id\": \"Lower Back Strength\",\n      \"duration\": {\n      \"min\": 38,\n      \"max\": 63\n      },\n      \"unit\": \"times\",\n      \"is_completed\": \"0\",\n      \"created_at\": \"2016-01-22 07:15:02\",\n      \"updated_at\": \"2016-01-22 07:15:02\"\n      },\n      {\n      \"id\": \"3\",\n      \"exercise_id\": \"Upper Dog\",\n      \"duration\": {\n      \"min\": 38,\n      \"max\": 75\n      },\n      \"unit\": \"seconds\",\n      \"is_completed\": \"0\",\n      \"created_at\": \"2016-01-22 07:16:03\",\n      \"updated_at\": \"2016-01-22 07:16:03\"\n      },\n      {\n      \"id\": \"4\",\n      \"exercise_id\": \"Child's Pose\",\n      \"duration\": {\n      \"min\": 38,\n      \"max\": 75\n      },\n      \"unit\": \"seconds\",\n      \"is_completed\": \"0\",\n      \"created_at\": \"2016-01-22 07:16:46\",\n      \"updated_at\": \"2016-01-22 07:16:46\"\n      },\n      {\n      \"id\": \"5\",\n      \"exercise_id\": \"L-sit on the floor\",\n      \"duration\": {\n      \"min\": 38,\n      \"max\": 75\n      },\n      \"unit\": \"seconds\",\n      \"is_completed\": \"0\",\n      \"created_at\": \"2016-01-22 07:17:13\",\n      \"updated_at\": \"2016-01-22 07:17:13\"\n      },\n      {\n      \"id\": \"6\",\n      \"exercise_id\": \"Good morning\",\n      \"duration\": {\n      \"min\": 38,\n      \"max\": 75\n      },\n      \"unit\": \"seconds\",\n      \"is_completed\": \"0\",\n      \"created_at\": \"2016-01-22 07:17:43\",\n      \"updated_at\": \"2016-01-22 07:17:43\"\n      },\n      {\n      \"id\": \"7\",\n      \"exercise_id\": \"Chest Opener\",\n      \"duration\": {\n      \"min\": 38,\n      \"max\": 75\n      },\n      \"unit\": \"seconds\",\n      \"is_completed\": \"0\",\n      \"created_at\": \"2016-01-22 07:19:32\",\n      \"updated_at\": \"2016-01-22 07:19:32\"\n      },\n      {\n      \"id\": \"8\",\n      \"exercise_id\": \"Triceps Stretc\",\n      \"duration\": {\n      \"min\": 38,\n      \"max\": 75\n      },\n      \"unit\": \"seconds\",\n      \"is_completed\": \"0\",\n      \"created_at\": \"2016-01-22 07:19:56\",\n      \"updated_at\": \"2016-01-22 07:19:56\"\n      },\n      {\n      \"id\": \"9\",\n      \"exercise_id\": \"Hands Back\",\n      \"duration\": {\n      \"min\": 38,\n      \"max\": 75\n      },\n      \"unit\": \"seconds\",\n      \"is_completed\": \"0\",\n      \"created_at\": \"2016-01-22 07:20:19\",\n      \"updated_at\": \"2016-01-22 07:20:19\"\n      },\n      {\n      \"id\": \"10\",\n      \"exercise_id\": \"Shoulder Stretch\",\n      \"duration\": {\n      \"min\": 38,\n      \"max\": 75\n      },\n      \"unit\": \"seconds\",\n      \"is_completed\": \"0\",\n      \"created_at\": \"2016-01-22 07:20:45\",\n      \"updated_at\": \"2016-01-22 07:20:45\"\n      }\n      ],\n      \"status\": \"pending\"\n      },\n      \"day4\": {\n      \"warmup\": [\n      {\n      \"id\": \"1\",\n      \"name\": \"wall extensions\",\n      \"duration\": {\n      \"min\": \"10\",\n      \"max\": \"20\"\n      },\n      \"unit\": \"times\",\n      \"created_at\": \"2016-01-21 08:55:06\",\n      \"updated_at\": \"2016-01-21 08:55:06\",\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"2\",\n      \"name\": \"band dislocates\",\n      \"duration\": {\n      \"min\": \"10\",\n      \"max\": \"20\"\n      },\n      \"unit\": \"times\",\n      \"created_at\": \"2016-01-21 08:57:38\",\n      \"updated_at\": \"2016-01-21 08:57:38\",\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"3\",\n      \"name\": \"cat-camels\",\n      \"duration\": {\n      \"min\": \"10\",\n      \"max\": \"20\"\n      },\n      \"unit\": \"times\",\n      \"created_at\": \"2016-01-21 09:00:39\",\n      \"updated_at\": \"2016-01-21 09:00:39\",\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"4\",\n      \"name\": \"scapular shrugs\",\n      \"duration\": {\n      \"min\": \"10\",\n      \"max\": \"20\"\n      },\n      \"unit\": \"times\",\n      \"created_at\": \"2016-01-21 09:01:01\",\n      \"updated_at\": \"2016-01-21 09:01:01\",\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"5\",\n      \"name\": \"full body circles\",\n      \"duration\": {\n      \"min\": \"10\",\n      \"max\": \"20\"\n      },\n      \"unit\": \"times\",\n      \"created_at\": \"2016-01-21 09:01:26\",\n      \"updated_at\": \"2016-01-21 09:01:26\",\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"6\",\n      \"name\": \"Jumping Jacks\",\n      \"duration\": {\n      \"min\": \"100\",\n      \"max\": \"\"\n      },\n      \"unit\": \"seconds\",\n      \"created_at\": \"2016-01-21 09:04:52\",\n      \"updated_at\": \"2016-01-21 09:04:52\",\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"7\",\n      \"name\": \"Arm rotations\",\n      \"duration\": {\n      \"min\": \"120\",\n      \"max\": \"\"\n      },\n      \"unit\": \"times\",\n      \"created_at\": \"2016-01-21 09:05:29\",\n      \"updated_at\": \"2016-01-21 09:05:29\",\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"8\",\n      \"name\": \"High Knees\",\n      \"duration\": {\n      \"min\": \"50\",\n      \"max\": \"\"\n      },\n      \"unit\": \"times\",\n      \"created_at\": \"2016-01-21 09:06:02\",\n      \"updated_at\": \"2016-01-21 09:06:02\",\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"9\",\n      \"name\": \"Shouder rolls\",\n      \"duration\": {\n      \"min\": \"20\",\n      \"max\": \"\"\n      },\n      \"unit\": \"times\",\n      \"created_at\": \"2016-01-21 09:06:34\",\n      \"updated_at\": \"2016-01-21 09:06:34\",\n      \"is_completed\": 0\n      }\n      ],\n      \"is_completed\": 0,\n      \"fundumentals\": [\n      {\n      \"id\": \"11\",\n      \"row\": \"3\",\n      \"exercise_id\": \"64\",\n      \"duration\": {\n      \"min\": \"10\",\n      \"max\": \"\"\n      },\n      \"unit\": \"times\",\n      \"is_completed\": \"0\",\n      \"created_at\": \"2016-01-22 04:35:13\",\n      \"updated_at\": \"2016-04-04 14:27:54\",\n      \"exercise\": {\n      \"id\": \"64\",\n      \"name\": \"Skin the cat\",\n      \"description\": \"Develop your joints mobility and expose yourself to new movement layers\",\n      \"category\": \"1\",\n      \"type\": \"2\",\n      \"muscle_groups\": \"4,5,6\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \" 1. Hands a little more than shoulder width apart\\r\\n2. Raise your knees to the chest\\r\\n3. continuing the movement until the feet pass up through the arms and over head into an inverted hang position.\\r\\n4. Continue to pass the feet round and down toward the ground into the extended 'skin the cat' position.\\r\\n5. Lift your hips and raise the legs back and over to the starting hang position. \",\n      \"video_tips\": \"        \",\n      \"pro_tips\": \" Put your hands closer together to ease up all back lever progressions.\\r\\nDo only half of the movement in the beginning, but fight for completion over time.\\r\\nIncorporate other static elements to challenge yourself during the movement as you master other skills.\\r\\n    \",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Back, Arms, Core\",\n      \"video\": [\n      {\n      \"id\": \"71\",\n      \"path\": \"64_1454045043.mp4\",\n      \"videothumbnail\": \"64_1454045043.jpg\",\n      \"description\": \"Skin the cat\"\n      }\n      ]\n      }\n      },\n      {\n      \"id\": \"12\",\n      \"row\": \"3\",\n      \"exercise_id\": \"12\",\n      \"duration\": {\n      \"min\": \"20\",\n      \"max\": \"\"\n      },\n      \"unit\": \"times\",\n      \"is_completed\": \"0\",\n      \"created_at\": \"2016-01-22 04:36:16\",\n      \"updated_at\": \"2016-04-04 09:26:06\",\n      \"exercise\": {\n      \"id\": \"12\",\n      \"name\": \"Pushups\",\n      \"description\": \"Perform the most popular exercise of all time with real strength\",\n      \"category\": \"2\",\n      \"type\": \"1\",\n      \"muscle_groups\": \"1,2,3\",\n      \"rewards\": \"7.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \" 1. Lie on the floor face down and place your hands in a standard pushup position.\\r\\n 2. Next, lower yourself downward until your chest almost touches the floor as you inhale.\\r\\n 3. Exhale and press your upper body back up to the starting position while squeezing your chest.\\r\\n 4. Repeat, after a brief pause at the top contracted position.\\r\\n\",\n      \"video_tips\": \"      \",\n      \"pro_tips\": \"Do them extra slow and hold it in highest and lowest position to get strength.\\r\\nOne of the most common push-up mistakes is flaring out the elbows out instead of keeping them at your sides.\\r\\nIf too easy, try Spiderman and Diamond Pushups or wear a weigthed vest.\",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Shoulders, Chest, Triceps\",\n      \"video\": [\n      {\n      \"id\": \"57\",\n      \"path\": \"12_1453984139.mp4\",\n      \"videothumbnail\": \"12_1453984139.jpg\",\n      \"description\": \"Pushups\"\n      }\n      ]\n      }\n      },\n      {\n      \"id\": \"13\",\n      \"row\": \"3\",\n      \"exercise_id\": \"49\",\n      \"duration\": {\n      \"min\": \"30\",\n      \"max\": \"\"\n      },\n      \"unit\": \"times\",\n      \"is_completed\": \"0\",\n      \"created_at\": \"2016-01-22 04:36:49\",\n      \"updated_at\": \"2016-04-04 14:19:29\",\n      \"exercise\": {\n      \"id\": \"49\",\n      \"name\": \"Side Triceps\",\n      \"description\": \"Start with the basics of building triceps strength\",\n      \"category\": \"1\",\n      \"type\": \"1\",\n      \"muscle_groups\": \"3\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \" 1. Start with the body on your side\\r\\n2. Put one hand on your shoulder \\r\\n3. Press up with the other arm and hold in extension \",\n      \"video_tips\": \"          \",\n      \"pro_tips\": \" Avoid supporting the movement with your core muscle.      \",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Triceps\",\n      \"video\": [\n      {\n      \"id\": \"43\",\n      \"path\": \"49_1454043404.mp4\",\n      \"videothumbnail\": \"49_1454043404.jpg\",\n      \"description\": \"Side Triceps\"\n      }\n      ]\n      }\n      },\n      {\n      \"id\": \"14\",\n      \"row\": \"3\",\n      \"exercise_id\": \"4\",\n      \"duration\": {\n      \"min\": \"60\",\n      \"max\": \"90\"\n      },\n      \"unit\": \"seconds\",\n      \"is_completed\": \"0\",\n      \"created_at\": \"2016-01-22 04:37:32\",\n      \"updated_at\": \"2016-04-04 14:02:11\",\n      \"exercise\": {\n      \"id\": \"4\",\n      \"name\": \"Plank\",\n      \"description\": \"The plank builds your isometric strength and helps sculpt your waistline.\",\n      \"category\": \"1\",\n      \"type\": \"1\",\n      \"muscle_groups\": \"1,4,6,8\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"seconds\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \"1. Get into pushup position on the floor.\\r\\n2. Now bend your elbows 90 degrees and rest your weight on your forearms. \\r\\n3. Hold the position for as long as you can.   \",\n      \"video_tips\": \"        \",\n      \"pro_tips\": \"Drive your chest away from the ground and spread your shoulder blades as much as you can.\\r\\nKeep a straight line, from head to toe. \\r\\nDon't collapse your lower back or reach your butt to the sky. Add movement to your plank, rock back and forth on your forearms and toes or shift from side to side.\\r\\nTry advanced variations with alternating sinlge leg support. \\r\\nStart with an incline plank if a straight plank is too hard in the beginning.  \",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Shoulders, Back, Core, Full Body\",\n      \"video\": [\n      {\n      \"id\": \"4\",\n      \"path\": \"4_1453976855.mp4\",\n      \"videothumbnail\": \"4_1453976855.jpg\",\n      \"description\": \"Plank\"\n      }\n      ]\n      }\n      },\n      {\n      \"id\": \"15\",\n      \"row\": \"3\",\n      \"exercise_id\": \"36\",\n      \"duration\": {\n      \"min\": \"20\",\n      \"max\": \"\"\n      },\n      \"unit\": \"times\",\n      \"is_completed\": \"0\",\n      \"created_at\": \"2016-01-22 04:37:57\",\n      \"updated_at\": \"2016-04-04 11:12:49\",\n      \"exercise\": {\n      \"id\": \"36\",\n      \"name\": \"High Jumps\",\n      \"description\": \"Do high jumps as a part of restless HIIT workouts\",\n      \"category\": \"1\",\n      \"type\": \"2\",\n      \"muscle_groups\": \"7\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \"1. Start from a standing position\\r\\n2. Jump up and bring your knees to your chest\",\n      \"video_tips\": \"    \",\n      \"pro_tips\": \"Land softly and exhale when the knees are up.\\r\\n  \",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Legs\",\n      \"video\": [\n      {\n      \"id\": \"33\",\n      \"path\": \"36_1454042273.mp4\",\n      \"videothumbnail\": \"36_1454042273.jpg\",\n      \"description\": \"High Jumps\"\n      }\n      ]\n      }\n      }\n      ],\n      \"exercises\": [],\n      \"workout\": {\n      \"id\": \"1\",\n      \"name\": \"Baldur\",\n      \"description\": \"A,D,B\",\n      \"rounds\": \"5\",\n      \"category\": \"1\",\n      \"type\": \"2\",\n      \"rewards\": \"440\",\n      \"duration\": \"2380.00\",\n      \"equipments\": \"Bar/Rings, Paralettes/Rings\",\n      \"is_completed\": 0,\n      \"exercises\": {\n      \"round1\": [\n      {\n      \"id\": \"1\",\n      \"workout_id\": \"1\",\n      \"category\": \"1\",\n      \"repititions\": \"10\",\n      \"exercise_id\": \"66\",\n      \"unit\": \"times\",\n      \"round\": \"1\",\n      \"created_at\": \"2016-01-19 03:15:36\",\n      \"updated_at\": \"2016-04-04 14:31:38\",\n      \"exercise\": {\n      \"id\": \"69\",\n      \"name\": \"Jumping Pullups\",\n      \"description\": \"Expose yourself to packed shoulders and hang time\",\n      \"category\": \"1\",\n      \"type\": \"1\",\n      \"muscle_groups\": \"1,5\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \" 1. Grip a bar and jump into the top position of the pull-up exercise\\r\\n2. Straight legs in front of you. \\r\\n3. Slowly go down into a deadhang position \",\n      \"video_tips\": \"        \",\n      \"pro_tips\": \" A deadhang postion requires your shoulder blades down and towards the spine with arms being straight (retraction)\\r\\nAim for three second holds at the top and go down slowly \",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Shoulders, Arms\"\n      },\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"6\",\n      \"workout_id\": \"1\",\n      \"category\": \"1\",\n      \"repititions\": \"10\",\n      \"exercise_id\": \"22\",\n      \"unit\": \"times\",\n      \"round\": \"1\",\n      \"created_at\": \"2016-01-19 03:17:21\",\n      \"updated_at\": \"2016-04-04 14:09:31\",\n      \"exercise\": {\n      \"id\": \"22\",\n      \"name\": \"Spiderman Pushups\",\n      \"description\": \"Learn to control your body and create body awareness\",\n      \"category\": \"1\",\n      \"type\": \"2\",\n      \"muscle_groups\": \"2,3,5,6\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \"  1. Start in a standard pushup position.\\r\\n 2. Next, lower yourself downward until your chest almost touches the floor as you inhale.\\r\\n 3. Bring your knees to your elbows as you go down and alternate with next repition. \",\n      \"video_tips\": \"      \",\n      \"pro_tips\": \" Pretend you are balancing something on your tailbone as you do the Spiderman pushup to maintain the correct plank position. This keeps your hips from rotating. \",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Chest, Triceps, Arms, Core\"\n      },\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"11\",\n      \"workout_id\": \"1\",\n      \"category\": \"1\",\n      \"repititions\": \"10\",\n      \"exercise_id\": \"49\",\n      \"unit\": \"times\",\n      \"round\": \"1\",\n      \"created_at\": \"2016-01-19 03:19:02\",\n      \"updated_at\": \"2016-04-04 14:19:29\",\n      \"exercise\": {\n      \"id\": \"49\",\n      \"name\": \"Side Triceps\",\n      \"description\": \"Start with the basics of building triceps strength\",\n      \"category\": \"1\",\n      \"type\": \"1\",\n      \"muscle_groups\": \"3\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \" 1. Start with the body on your side\\r\\n2. Put one hand on your shoulder \\r\\n3. Press up with the other arm and hold in extension \",\n      \"video_tips\": \"          \",\n      \"pro_tips\": \" Avoid supporting the movement with your core muscle.      \",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Triceps\"\n      },\n      \"is_completed\": 0\n      }\n      ],\n      \"round2\": [\n      {\n      \"id\": \"3\",\n      \"workout_id\": \"1\",\n      \"category\": \"1\",\n      \"repititions\": \"20\",\n      \"exercise_id\": \"66\",\n      \"unit\": \"times\",\n      \"round\": \"2\",\n      \"created_at\": \"2016-01-19 03:16:17\",\n      \"updated_at\": \"2016-04-04 14:31:38\",\n      \"exercise\": {\n      \"id\": \"69\",\n      \"name\": \"Jumping Pullups\",\n      \"description\": \"Expose yourself to packed shoulders and hang time\",\n      \"category\": \"1\",\n      \"type\": \"1\",\n      \"muscle_groups\": \"1,5\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \" 1. Grip a bar and jump into the top position of the pull-up exercise\\r\\n2. Straight legs in front of you. \\r\\n3. Slowly go down into a deadhang position \",\n      \"video_tips\": \"        \",\n      \"pro_tips\": \" A deadhang postion requires your shoulder blades down and towards the spine with arms being straight (retraction)\\r\\nAim for three second holds at the top and go down slowly \",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Shoulders, Arms\"\n      },\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"8\",\n      \"workout_id\": \"1\",\n      \"category\": \"1\",\n      \"repititions\": \"20\",\n      \"exercise_id\": \"22\",\n      \"unit\": \"times\",\n      \"round\": \"2\",\n      \"created_at\": \"2016-01-19 03:17:54\",\n      \"updated_at\": \"2016-04-04 14:09:31\",\n      \"exercise\": {\n      \"id\": \"22\",\n      \"name\": \"Spiderman Pushups\",\n      \"description\": \"Learn to control your body and create body awareness\",\n      \"category\": \"1\",\n      \"type\": \"2\",\n      \"muscle_groups\": \"2,3,5,6\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \"  1. Start in a standard pushup position.\\r\\n 2. Next, lower yourself downward until your chest almost touches the floor as you inhale.\\r\\n 3. Bring your knees to your elbows as you go down and alternate with next repition. \",\n      \"video_tips\": \"      \",\n      \"pro_tips\": \" Pretend you are balancing something on your tailbone as you do the Spiderman pushup to maintain the correct plank position. This keeps your hips from rotating. \",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Chest, Triceps, Arms, Core\"\n      },\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"13\",\n      \"workout_id\": \"1\",\n      \"category\": \"1\",\n      \"repititions\": \"20\",\n      \"exercise_id\": \"49\",\n      \"unit\": \"times\",\n      \"round\": \"2\",\n      \"created_at\": \"2016-01-19 03:19:23\",\n      \"updated_at\": \"2016-04-04 14:19:29\",\n      \"exercise\": {\n      \"id\": \"49\",\n      \"name\": \"Side Triceps\",\n      \"description\": \"Start with the basics of building triceps strength\",\n      \"category\": \"1\",\n      \"type\": \"1\",\n      \"muscle_groups\": \"3\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \" 1. Start with the body on your side\\r\\n2. Put one hand on your shoulder \\r\\n3. Press up with the other arm and hold in extension \",\n      \"video_tips\": \"          \",\n      \"pro_tips\": \" Avoid supporting the movement with your core muscle.      \",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Triceps\"\n      },\n      \"is_completed\": 0\n      }\n      ],\n      \"round3\": [\n      {\n      \"id\": \"5\",\n      \"workout_id\": \"1\",\n      \"category\": \"1\",\n      \"repititions\": \"30\",\n      \"exercise_id\": \"66\",\n      \"unit\": \"times\",\n      \"round\": \"3\",\n      \"created_at\": \"2016-01-19 03:16:40\",\n      \"updated_at\": \"2016-04-04 14:31:38\",\n      \"exercise\": {\n      \"id\": \"69\",\n      \"name\": \"Jumping Pullups\",\n      \"description\": \"Expose yourself to packed shoulders and hang time\",\n      \"category\": \"1\",\n      \"type\": \"1\",\n      \"muscle_groups\": \"1,5\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \" 1. Grip a bar and jump into the top position of the pull-up exercise\\r\\n2. Straight legs in front of you. \\r\\n3. Slowly go down into a deadhang position \",\n      \"video_tips\": \"        \",\n      \"pro_tips\": \" A deadhang postion requires your shoulder blades down and towards the spine with arms being straight (retraction)\\r\\nAim for three second holds at the top and go down slowly \",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Shoulders, Arms\"\n      },\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"10\",\n      \"workout_id\": \"1\",\n      \"category\": \"1\",\n      \"repititions\": \"30\",\n      \"exercise_id\": \"22\",\n      \"unit\": \"times\",\n      \"round\": \"3\",\n      \"created_at\": \"2016-01-19 03:18:11\",\n      \"updated_at\": \"2016-04-04 14:09:31\",\n      \"exercise\": {\n      \"id\": \"22\",\n      \"name\": \"Spiderman Pushups\",\n      \"description\": \"Learn to control your body and create body awareness\",\n      \"category\": \"1\",\n      \"type\": \"2\",\n      \"muscle_groups\": \"2,3,5,6\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \"  1. Start in a standard pushup position.\\r\\n 2. Next, lower yourself downward until your chest almost touches the floor as you inhale.\\r\\n 3. Bring your knees to your elbows as you go down and alternate with next repition. \",\n      \"video_tips\": \"      \",\n      \"pro_tips\": \" Pretend you are balancing something on your tailbone as you do the Spiderman pushup to maintain the correct plank position. This keeps your hips from rotating. \",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Chest, Triceps, Arms, Core\"\n      },\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"15\",\n      \"workout_id\": \"1\",\n      \"category\": \"1\",\n      \"repititions\": \"30\",\n      \"exercise_id\": \"49\",\n      \"unit\": \"times\",\n      \"round\": \"3\",\n      \"created_at\": \"2016-01-19 03:19:48\",\n      \"updated_at\": \"2016-04-04 14:19:29\",\n      \"exercise\": {\n      \"id\": \"49\",\n      \"name\": \"Side Triceps\",\n      \"description\": \"Start with the basics of building triceps strength\",\n      \"category\": \"1\",\n      \"type\": \"1\",\n      \"muscle_groups\": \"3\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \" 1. Start with the body on your side\\r\\n2. Put one hand on your shoulder \\r\\n3. Press up with the other arm and hold in extension \",\n      \"video_tips\": \"          \",\n      \"pro_tips\": \" Avoid supporting the movement with your core muscle.      \",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Triceps\"\n      },\n      \"is_completed\": 0\n      }\n      ]\n      },\n      \"exercise_category\": 1\n      },\n      \"coach_workout_rounds\": 3,\n      \"workout_intensity\": 1,\n      \"hiit\": [],\n      \"stretching\": [\n      {\n      \"id\": \"1\",\n      \"exercise_id\": \"Superman\",\n      \"duration\": {\n      \"min\": 6,\n      \"max\": 13\n      },\n      \"unit\": \"times\",\n      \"is_completed\": \"0\",\n      \"created_at\": \"2016-01-22 07:10:31\",\n      \"updated_at\": \"2016-01-22 07:10:31\"\n      },\n      {\n      \"id\": \"2\",\n      \"exercise_id\": \"Lower Back Strength\",\n      \"duration\": {\n      \"min\": 38,\n      \"max\": 63\n      },\n      \"unit\": \"times\",\n      \"is_completed\": \"0\",\n      \"created_at\": \"2016-01-22 07:15:02\",\n      \"updated_at\": \"2016-01-22 07:15:02\"\n      },\n      {\n      \"id\": \"3\",\n      \"exercise_id\": \"Upper Dog\",\n      \"duration\": {\n      \"min\": 38,\n      \"max\": 75\n      },\n      \"unit\": \"seconds\",\n      \"is_completed\": \"0\",\n      \"created_at\": \"2016-01-22 07:16:03\",\n      \"updated_at\": \"2016-01-22 07:16:03\"\n      },\n      {\n      \"id\": \"4\",\n      \"exercise_id\": \"Child's Pose\",\n      \"duration\": {\n      \"min\": 38,\n      \"max\": 75\n      },\n      \"unit\": \"seconds\",\n      \"is_completed\": \"0\",\n      \"created_at\": \"2016-01-22 07:16:46\",\n      \"updated_at\": \"2016-01-22 07:16:46\"\n      },\n      {\n      \"id\": \"5\",\n      \"exercise_id\": \"L-sit on the floor\",\n      \"duration\": {\n      \"min\": 38,\n      \"max\": 75\n      },\n      \"unit\": \"seconds\",\n      \"is_completed\": \"0\",\n      \"created_at\": \"2016-01-22 07:17:13\",\n      \"updated_at\": \"2016-01-22 07:17:13\"\n      },\n      {\n      \"id\": \"6\",\n      \"exercise_id\": \"Good morning\",\n      \"duration\": {\n      \"min\": 38,\n      \"max\": 75\n      },\n      \"unit\": \"seconds\",\n      \"is_completed\": \"0\",\n      \"created_at\": \"2016-01-22 07:17:43\",\n      \"updated_at\": \"2016-01-22 07:17:43\"\n      },\n      {\n      \"id\": \"7\",\n      \"exercise_id\": \"Chest Opener\",\n      \"duration\": {\n      \"min\": 38,\n      \"max\": 75\n      },\n      \"unit\": \"seconds\",\n      \"is_completed\": \"0\",\n      \"created_at\": \"2016-01-22 07:19:32\",\n      \"updated_at\": \"2016-01-22 07:19:32\"\n      },\n      {\n      \"id\": \"8\",\n      \"exercise_id\": \"Triceps Stretc\",\n      \"duration\": {\n      \"min\": 38,\n      \"max\": 75\n      },\n      \"unit\": \"seconds\",\n      \"is_completed\": \"0\",\n      \"created_at\": \"2016-01-22 07:19:56\",\n      \"updated_at\": \"2016-01-22 07:19:56\"\n      },\n      {\n      \"id\": \"9\",\n      \"exercise_id\": \"Hands Back\",\n      \"duration\": {\n      \"min\": 38,\n      \"max\": 75\n      },\n      \"unit\": \"seconds\",\n      \"is_completed\": \"0\",\n      \"created_at\": \"2016-01-22 07:20:19\",\n      \"updated_at\": \"2016-01-22 07:20:19\"\n      },\n      {\n      \"id\": \"10\",\n      \"exercise_id\": \"Shoulder Stretch\",\n      \"duration\": {\n      \"min\": 38,\n      \"max\": 75\n      },\n      \"unit\": \"seconds\",\n      \"is_completed\": \"0\",\n      \"created_at\": \"2016-01-22 07:20:45\",\n      \"updated_at\": \"2016-01-22 07:20:45\"\n      }\n      ],\n      \"status\": \"pending\"\n      },\n      \"day5\": {\n      \"warmup\": [\n      {\n      \"id\": \"1\",\n      \"name\": \"wall extensions\",\n      \"duration\": {\n      \"min\": \"10\",\n      \"max\": \"20\"\n      },\n      \"unit\": \"times\",\n      \"created_at\": \"2016-01-21 08:55:06\",\n      \"updated_at\": \"2016-01-21 08:55:06\",\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"2\",\n      \"name\": \"band dislocates\",\n      \"duration\": {\n      \"min\": \"10\",\n      \"max\": \"20\"\n      },\n      \"unit\": \"times\",\n      \"created_at\": \"2016-01-21 08:57:38\",\n      \"updated_at\": \"2016-01-21 08:57:38\",\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"3\",\n      \"name\": \"cat-camels\",\n      \"duration\": {\n      \"min\": \"10\",\n      \"max\": \"20\"\n      },\n      \"unit\": \"times\",\n      \"created_at\": \"2016-01-21 09:00:39\",\n      \"updated_at\": \"2016-01-21 09:00:39\",\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"4\",\n      \"name\": \"scapular shrugs\",\n      \"duration\": {\n      \"min\": \"10\",\n      \"max\": \"20\"\n      },\n      \"unit\": \"times\",\n      \"created_at\": \"2016-01-21 09:01:01\",\n      \"updated_at\": \"2016-01-21 09:01:01\",\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"5\",\n      \"name\": \"full body circles\",\n      \"duration\": {\n      \"min\": \"10\",\n      \"max\": \"20\"\n      },\n      \"unit\": \"times\",\n      \"created_at\": \"2016-01-21 09:01:26\",\n      \"updated_at\": \"2016-01-21 09:01:26\",\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"6\",\n      \"name\": \"Jumping Jacks\",\n      \"duration\": {\n      \"min\": \"100\",\n      \"max\": \"\"\n      },\n      \"unit\": \"seconds\",\n      \"created_at\": \"2016-01-21 09:04:52\",\n      \"updated_at\": \"2016-01-21 09:04:52\",\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"7\",\n      \"name\": \"Arm rotations\",\n      \"duration\": {\n      \"min\": \"120\",\n      \"max\": \"\"\n      },\n      \"unit\": \"times\",\n      \"created_at\": \"2016-01-21 09:05:29\",\n      \"updated_at\": \"2016-01-21 09:05:29\",\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"8\",\n      \"name\": \"High Knees\",\n      \"duration\": {\n      \"min\": \"50\",\n      \"max\": \"\"\n      },\n      \"unit\": \"times\",\n      \"created_at\": \"2016-01-21 09:06:02\",\n      \"updated_at\": \"2016-01-21 09:06:02\",\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"9\",\n      \"name\": \"Shouder rolls\",\n      \"duration\": {\n      \"min\": \"20\",\n      \"max\": \"\"\n      },\n      \"unit\": \"times\",\n      \"created_at\": \"2016-01-21 09:06:34\",\n      \"updated_at\": \"2016-01-21 09:06:34\",\n      \"is_completed\": 0\n      }\n      ],\n      \"is_completed\": 0,\n      \"fundumentals\": [\n      {\n      \"id\": \"11\",\n      \"row\": \"3\",\n      \"exercise_id\": \"64\",\n      \"duration\": {\n      \"min\": \"10\",\n      \"max\": \"\"\n      },\n      \"unit\": \"times\",\n      \"is_completed\": \"0\",\n      \"created_at\": \"2016-01-22 04:35:13\",\n      \"updated_at\": \"2016-04-04 14:27:54\",\n      \"exercise\": {\n      \"id\": \"64\",\n      \"name\": \"Skin the cat\",\n      \"description\": \"Develop your joints mobility and expose yourself to new movement layers\",\n      \"category\": \"1\",\n      \"type\": \"2\",\n      \"muscle_groups\": \"4,5,6\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \" 1. Hands a little more than shoulder width apart\\r\\n2. Raise your knees to the chest\\r\\n3. continuing the movement until the feet pass up through the arms and over head into an inverted hang position.\\r\\n4. Continue to pass the feet round and down toward the ground into the extended 'skin the cat' position.\\r\\n5. Lift your hips and raise the legs back and over to the starting hang position. \",\n      \"video_tips\": \"        \",\n      \"pro_tips\": \" Put your hands closer together to ease up all back lever progressions.\\r\\nDo only half of the movement in the beginning, but fight for completion over time.\\r\\nIncorporate other static elements to challenge yourself during the movement as you master other skills.\\r\\n    \",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Back, Arms, Core\",\n      \"video\": [\n      {\n      \"id\": \"71\",\n      \"path\": \"64_1454045043.mp4\",\n      \"videothumbnail\": \"64_1454045043.jpg\",\n      \"description\": \"Skin the cat\"\n      }\n      ]\n      }\n      },\n      {\n      \"id\": \"12\",\n      \"row\": \"3\",\n      \"exercise_id\": \"12\",\n      \"duration\": {\n      \"min\": \"20\",\n      \"max\": \"\"\n      },\n      \"unit\": \"times\",\n      \"is_completed\": \"0\",\n      \"created_at\": \"2016-01-22 04:36:16\",\n      \"updated_at\": \"2016-04-04 09:26:06\",\n      \"exercise\": {\n      \"id\": \"12\",\n      \"name\": \"Pushups\",\n      \"description\": \"Perform the most popular exercise of all time with real strength\",\n      \"category\": \"2\",\n      \"type\": \"1\",\n      \"muscle_groups\": \"1,2,3\",\n      \"rewards\": \"7.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \" 1. Lie on the floor face down and place your hands in a standard pushup position.\\r\\n 2. Next, lower yourself downward until your chest almost touches the floor as you inhale.\\r\\n 3. Exhale and press your upper body back up to the starting position while squeezing your chest.\\r\\n 4. Repeat, after a brief pause at the top contracted position.\\r\\n\",\n      \"video_tips\": \"      \",\n      \"pro_tips\": \"Do them extra slow and hold it in highest and lowest position to get strength.\\r\\nOne of the most common push-up mistakes is flaring out the elbows out instead of keeping them at your sides.\\r\\nIf too easy, try Spiderman and Diamond Pushups or wear a weigthed vest.\",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Shoulders, Chest, Triceps\",\n      \"video\": [\n      {\n      \"id\": \"57\",\n      \"path\": \"12_1453984139.mp4\",\n      \"videothumbnail\": \"12_1453984139.jpg\",\n      \"description\": \"Pushups\"\n      }\n      ]\n      }\n      },\n      {\n      \"id\": \"13\",\n      \"row\": \"3\",\n      \"exercise_id\": \"49\",\n      \"duration\": {\n      \"min\": \"30\",\n      \"max\": \"\"\n      },\n      \"unit\": \"times\",\n      \"is_completed\": \"0\",\n      \"created_at\": \"2016-01-22 04:36:49\",\n      \"updated_at\": \"2016-04-04 14:19:29\",\n      \"exercise\": {\n      \"id\": \"49\",\n      \"name\": \"Side Triceps\",\n      \"description\": \"Start with the basics of building triceps strength\",\n      \"category\": \"1\",\n      \"type\": \"1\",\n      \"muscle_groups\": \"3\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \" 1. Start with the body on your side\\r\\n2. Put one hand on your shoulder \\r\\n3. Press up with the other arm and hold in extension \",\n      \"video_tips\": \"          \",\n      \"pro_tips\": \" Avoid supporting the movement with your core muscle.      \",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Triceps\",\n      \"video\": [\n      {\n      \"id\": \"43\",\n      \"path\": \"49_1454043404.mp4\",\n      \"videothumbnail\": \"49_1454043404.jpg\",\n      \"description\": \"Side Triceps\"\n      }\n      ]\n      }\n      },\n      {\n      \"id\": \"14\",\n      \"row\": \"3\",\n      \"exercise_id\": \"4\",\n      \"duration\": {\n      \"min\": \"60\",\n      \"max\": \"90\"\n      },\n      \"unit\": \"seconds\",\n      \"is_completed\": \"0\",\n      \"created_at\": \"2016-01-22 04:37:32\",\n      \"updated_at\": \"2016-04-04 14:02:11\",\n      \"exercise\": {\n      \"id\": \"4\",\n      \"name\": \"Plank\",\n      \"description\": \"The plank builds your isometric strength and helps sculpt your waistline.\",\n      \"category\": \"1\",\n      \"type\": \"1\",\n      \"muscle_groups\": \"1,4,6,8\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"seconds\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \"1. Get into pushup position on the floor.\\r\\n2. Now bend your elbows 90 degrees and rest your weight on your forearms. \\r\\n3. Hold the position for as long as you can.   \",\n      \"video_tips\": \"        \",\n      \"pro_tips\": \"Drive your chest away from the ground and spread your shoulder blades as much as you can.\\r\\nKeep a straight line, from head to toe. \\r\\nDon't collapse your lower back or reach your butt to the sky. Add movement to your plank, rock back and forth on your forearms and toes or shift from side to side.\\r\\nTry advanced variations with alternating sinlge leg support. \\r\\nStart with an incline plank if a straight plank is too hard in the beginning.  \",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Shoulders, Back, Core, Full Body\",\n      \"video\": [\n      {\n      \"id\": \"4\",\n      \"path\": \"4_1453976855.mp4\",\n      \"videothumbnail\": \"4_1453976855.jpg\",\n      \"description\": \"Plank\"\n      }\n      ]\n      }\n      },\n      {\n      \"id\": \"15\",\n      \"row\": \"3\",\n      \"exercise_id\": \"36\",\n      \"duration\": {\n      \"min\": \"20\",\n      \"max\": \"\"\n      },\n      \"unit\": \"times\",\n      \"is_completed\": \"0\",\n      \"created_at\": \"2016-01-22 04:37:57\",\n      \"updated_at\": \"2016-04-04 11:12:49\",\n      \"exercise\": {\n      \"id\": \"36\",\n      \"name\": \"High Jumps\",\n      \"description\": \"Do high jumps as a part of restless HIIT workouts\",\n      \"category\": \"1\",\n      \"type\": \"2\",\n      \"muscle_groups\": \"7\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \"1. Start from a standing position\\r\\n2. Jump up and bring your knees to your chest\",\n      \"video_tips\": \"    \",\n      \"pro_tips\": \"Land softly and exhale when the knees are up.\\r\\n  \",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Legs\",\n      \"video\": [\n      {\n      \"id\": \"33\",\n      \"path\": \"36_1454042273.mp4\",\n      \"videothumbnail\": \"36_1454042273.jpg\",\n      \"description\": \"High Jumps\"\n      }\n      ]\n      }\n      }\n      ],\n      \"exercises\": [],\n      \"workout\": {\n      \"id\": \"21\",\n      \"name\": \"Vali\",\n      \"description\": \"A,B,E\",\n      \"rounds\": \"3\",\n      \"category\": \"1\",\n      \"type\": \"2\",\n      \"rewards\": \"330\",\n      \"duration\": \"1620.00\",\n      \"equipments\": \"Bar/Rings, Ladder/Post\",\n      \"is_completed\": 0,\n      \"exercises\": {\n      \"round1\": [\n      {\n      \"id\": \"838\",\n      \"workout_id\": \"21\",\n      \"category\": \"1\",\n      \"repititions\": \"7\",\n      \"exercise_id\": \"64\",\n      \"unit\": \"times\",\n      \"round\": \"1\",\n      \"created_at\": \"2016-01-19 23:14:44\",\n      \"updated_at\": \"2016-04-04 14:27:54\",\n      \"exercise\": {\n      \"id\": \"64\",\n      \"name\": \"Skin the cat\",\n      \"description\": \"Develop your joints mobility and expose yourself to new movement layers\",\n      \"category\": \"1\",\n      \"type\": \"2\",\n      \"muscle_groups\": \"4,5,6\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \" 1. Hands a little more than shoulder width apart\\r\\n2. Raise your knees to the chest\\r\\n3. continuing the movement until the feet pass up through the arms and over head into an inverted hang position.\\r\\n4. Continue to pass the feet round and down toward the ground into the extended 'skin the cat' position.\\r\\n5. Lift your hips and raise the legs back and over to the starting hang position. \",\n      \"video_tips\": \"        \",\n      \"pro_tips\": \" Put your hands closer together to ease up all back lever progressions.\\r\\nDo only half of the movement in the beginning, but fight for completion over time.\\r\\nIncorporate other static elements to challenge yourself during the movement as you master other skills.\\r\\n    \",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Back, Arms, Core\"\n      },\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"841\",\n      \"workout_id\": \"21\",\n      \"category\": \"1\",\n      \"repititions\": \"30\",\n      \"exercise_id\": \"49\",\n      \"unit\": \"times\",\n      \"round\": \"1\",\n      \"created_at\": \"2016-01-19 23:15:12\",\n      \"updated_at\": \"2016-04-04 14:19:29\",\n      \"exercise\": {\n      \"id\": \"49\",\n      \"name\": \"Side Triceps\",\n      \"description\": \"Start with the basics of building triceps strength\",\n      \"category\": \"1\",\n      \"type\": \"1\",\n      \"muscle_groups\": \"3\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \" 1. Start with the body on your side\\r\\n2. Put one hand on your shoulder \\r\\n3. Press up with the other arm and hold in extension \",\n      \"video_tips\": \"          \",\n      \"pro_tips\": \" Avoid supporting the movement with your core muscle.      \",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Triceps\"\n      },\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"844\",\n      \"workout_id\": \"21\",\n      \"category\": \"1\",\n      \"repititions\": \"15\",\n      \"exercise_id\": \"29\",\n      \"unit\": \"times\",\n      \"round\": \"1\",\n      \"created_at\": \"2016-01-19 23:15:35\",\n      \"updated_at\": \"2016-04-04 14:14:02\",\n      \"exercise\": {\n      \"id\": \"29\",\n      \"name\": \"Tucked DF\",\n      \"description\": \"Develop your core strength on the path to the hardest core exercise in history\",\n      \"category\": \"1\",\n      \"type\": \"2\",\n      \"muscle_groups\": \"6\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \" 1. Lie on a decline or flat bench and grab the edge of it behind your head with both hands. \\r\\n2. Tuck your knees to your chest.\\r\\n3. Slowly try to extend to bend legs and hold position as long as you can \\r\\n4. Repeat movement. \",\n      \"video_tips\": \"          \",\n      \"pro_tips\": \" Work it slowly and controlled.\\r\\nFocus to engage your core and lower back in all progressions. \",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Core\"\n      },\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"847\",\n      \"workout_id\": \"21\",\n      \"category\": \"1\",\n      \"repititions\": \"30\",\n      \"exercise_id\": \"72\",\n      \"unit\": \"times\",\n      \"round\": \"1\",\n      \"created_at\": \"2016-01-19 23:16:00\",\n      \"updated_at\": \"2016-04-04 14:34:27\",\n      \"exercise\": {\n      \"id\": \"73\",\n      \"name\": \"Tucked Human Flag\",\n      \"description\": \"Start securing your anchoring point and learn to fully lock out your support\",\n      \"category\": \"1\",\n      \"type\": \"2\",\n      \"muscle_groups\": \"1,5,6\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \" 1. Place your hands so that palms face each other.\\r\\n2. Lock lower arm out for stabilization. (Hands, elbows and shoulders are in line) \\r\\n3. Pull your body with your upper arm up and tuck your knees to chest. \",\n      \"video_tips\": \"          \",\n      \"pro_tips\": \" If you begin to fall out of position it's important to land on your feet and let go of the anchor point to protect the shoulders.\\r\\nStraighten your hip and align with body.\\r\\nGet somebody to assist you in the beginning to stay in position. \",\n      \"is_static\": \"1\",\n      \"musclegroup_string\": \"Shoulders, Arms, Core\"\n      },\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"850\",\n      \"workout_id\": \"21\",\n      \"category\": \"1\",\n      \"repititions\": \"10\",\n      \"exercise_id\": \"66\",\n      \"unit\": \"times\",\n      \"round\": \"1\",\n      \"created_at\": \"2016-01-19 23:16:27\",\n      \"updated_at\": \"2016-04-04 14:31:38\",\n      \"exercise\": {\n      \"id\": \"69\",\n      \"name\": \"Jumping Pullups\",\n      \"description\": \"Expose yourself to packed shoulders and hang time\",\n      \"category\": \"1\",\n      \"type\": \"1\",\n      \"muscle_groups\": \"1,5\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \" 1. Grip a bar and jump into the top position of the pull-up exercise\\r\\n2. Straight legs in front of you. \\r\\n3. Slowly go down into a deadhang position \",\n      \"video_tips\": \"        \",\n      \"pro_tips\": \" A deadhang postion requires your shoulder blades down and towards the spine with arms being straight (retraction)\\r\\nAim for three second holds at the top and go down slowly \",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Shoulders, Arms\"\n      },\n      \"is_completed\": 0\n      }\n      ],\n      \"round2\": [\n      {\n      \"id\": \"839\",\n      \"workout_id\": \"21\",\n      \"category\": \"1\",\n      \"repititions\": \"7\",\n      \"exercise_id\": \"64\",\n      \"unit\": \"times\",\n      \"round\": \"2\",\n      \"created_at\": \"2016-01-19 23:14:44\",\n      \"updated_at\": \"2016-04-04 14:27:54\",\n      \"exercise\": {\n      \"id\": \"64\",\n      \"name\": \"Skin the cat\",\n      \"description\": \"Develop your joints mobility and expose yourself to new movement layers\",\n      \"category\": \"1\",\n      \"type\": \"2\",\n      \"muscle_groups\": \"4,5,6\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \" 1. Hands a little more than shoulder width apart\\r\\n2. Raise your knees to the chest\\r\\n3. continuing the movement until the feet pass up through the arms and over head into an inverted hang position.\\r\\n4. Continue to pass the feet round and down toward the ground into the extended 'skin the cat' position.\\r\\n5. Lift your hips and raise the legs back and over to the starting hang position. \",\n      \"video_tips\": \"        \",\n      \"pro_tips\": \" Put your hands closer together to ease up all back lever progressions.\\r\\nDo only half of the movement in the beginning, but fight for completion over time.\\r\\nIncorporate other static elements to challenge yourself during the movement as you master other skills.\\r\\n    \",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Back, Arms, Core\"\n      },\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"842\",\n      \"workout_id\": \"21\",\n      \"category\": \"1\",\n      \"repititions\": \"30\",\n      \"exercise_id\": \"49\",\n      \"unit\": \"times\",\n      \"round\": \"2\",\n      \"created_at\": \"2016-01-19 23:15:12\",\n      \"updated_at\": \"2016-04-04 14:19:29\",\n      \"exercise\": {\n      \"id\": \"49\",\n      \"name\": \"Side Triceps\",\n      \"description\": \"Start with the basics of building triceps strength\",\n      \"category\": \"1\",\n      \"type\": \"1\",\n      \"muscle_groups\": \"3\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \" 1. Start with the body on your side\\r\\n2. Put one hand on your shoulder \\r\\n3. Press up with the other arm and hold in extension \",\n      \"video_tips\": \"          \",\n      \"pro_tips\": \" Avoid supporting the movement with your core muscle.      \",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Triceps\"\n      },\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"845\",\n      \"workout_id\": \"21\",\n      \"category\": \"1\",\n      \"repititions\": \"15\",\n      \"exercise_id\": \"29\",\n      \"unit\": \"times\",\n      \"round\": \"2\",\n      \"created_at\": \"2016-01-19 23:15:35\",\n      \"updated_at\": \"2016-04-04 14:14:02\",\n      \"exercise\": {\n      \"id\": \"29\",\n      \"name\": \"Tucked DF\",\n      \"description\": \"Develop your core strength on the path to the hardest core exercise in history\",\n      \"category\": \"1\",\n      \"type\": \"2\",\n      \"muscle_groups\": \"6\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \" 1. Lie on a decline or flat bench and grab the edge of it behind your head with both hands. \\r\\n2. Tuck your knees to your chest.\\r\\n3. Slowly try to extend to bend legs and hold position as long as you can \\r\\n4. Repeat movement. \",\n      \"video_tips\": \"          \",\n      \"pro_tips\": \" Work it slowly and controlled.\\r\\nFocus to engage your core and lower back in all progressions. \",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Core\"\n      },\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"848\",\n      \"workout_id\": \"21\",\n      \"category\": \"1\",\n      \"repititions\": \"30\",\n      \"exercise_id\": \"72\",\n      \"unit\": \"times\",\n      \"round\": \"2\",\n      \"created_at\": \"2016-01-19 23:16:00\",\n      \"updated_at\": \"2016-04-04 14:34:27\",\n      \"exercise\": {\n      \"id\": \"73\",\n      \"name\": \"Tucked Human Flag\",\n      \"description\": \"Start securing your anchoring point and learn to fully lock out your support\",\n      \"category\": \"1\",\n      \"type\": \"2\",\n      \"muscle_groups\": \"1,5,6\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \" 1. Place your hands so that palms face each other.\\r\\n2. Lock lower arm out for stabilization. (Hands, elbows and shoulders are in line) \\r\\n3. Pull your body with your upper arm up and tuck your knees to chest. \",\n      \"video_tips\": \"          \",\n      \"pro_tips\": \" If you begin to fall out of position it's important to land on your feet and let go of the anchor point to protect the shoulders.\\r\\nStraighten your hip and align with body.\\r\\nGet somebody to assist you in the beginning to stay in position. \",\n      \"is_static\": \"1\",\n      \"musclegroup_string\": \"Shoulders, Arms, Core\"\n      },\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"852\",\n      \"workout_id\": \"21\",\n      \"category\": \"1\",\n      \"repititions\": \"10\",\n      \"exercise_id\": \"66\",\n      \"unit\": \"times\",\n      \"round\": \"2\",\n      \"created_at\": \"2016-01-19 23:16:28\",\n      \"updated_at\": \"2016-04-04 14:31:38\",\n      \"exercise\": {\n      \"id\": \"69\",\n      \"name\": \"Jumping Pullups\",\n      \"description\": \"Expose yourself to packed shoulders and hang time\",\n      \"category\": \"1\",\n      \"type\": \"1\",\n      \"muscle_groups\": \"1,5\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \" 1. Grip a bar and jump into the top position of the pull-up exercise\\r\\n2. Straight legs in front of you. \\r\\n3. Slowly go down into a deadhang position \",\n      \"video_tips\": \"        \",\n      \"pro_tips\": \" A deadhang postion requires your shoulder blades down and towards the spine with arms being straight (retraction)\\r\\nAim for three second holds at the top and go down slowly \",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Shoulders, Arms\"\n      },\n      \"is_completed\": 0\n      }\n      ],\n      \"round3\": [\n      {\n      \"id\": \"840\",\n      \"workout_id\": \"21\",\n      \"category\": \"1\",\n      \"repititions\": \"7\",\n      \"exercise_id\": \"64\",\n      \"unit\": \"times\",\n      \"round\": \"3\",\n      \"created_at\": \"2016-01-19 23:14:44\",\n      \"updated_at\": \"2016-04-04 14:27:54\",\n      \"exercise\": {\n      \"id\": \"64\",\n      \"name\": \"Skin the cat\",\n      \"description\": \"Develop your joints mobility and expose yourself to new movement layers\",\n      \"category\": \"1\",\n      \"type\": \"2\",\n      \"muscle_groups\": \"4,5,6\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \" 1. Hands a little more than shoulder width apart\\r\\n2. Raise your knees to the chest\\r\\n3. continuing the movement until the feet pass up through the arms and over head into an inverted hang position.\\r\\n4. Continue to pass the feet round and down toward the ground into the extended 'skin the cat' position.\\r\\n5. Lift your hips and raise the legs back and over to the starting hang position. \",\n      \"video_tips\": \"        \",\n      \"pro_tips\": \" Put your hands closer together to ease up all back lever progressions.\\r\\nDo only half of the movement in the beginning, but fight for completion over time.\\r\\nIncorporate other static elements to challenge yourself during the movement as you master other skills.\\r\\n    \",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Back, Arms, Core\"\n      },\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"843\",\n      \"workout_id\": \"21\",\n      \"category\": \"1\",\n      \"repititions\": \"30\",\n      \"exercise_id\": \"49\",\n      \"unit\": \"times\",\n      \"round\": \"3\",\n      \"created_at\": \"2016-01-19 23:15:12\",\n      \"updated_at\": \"2016-04-04 14:19:29\",\n      \"exercise\": {\n      \"id\": \"49\",\n      \"name\": \"Side Triceps\",\n      \"description\": \"Start with the basics of building triceps strength\",\n      \"category\": \"1\",\n      \"type\": \"1\",\n      \"muscle_groups\": \"3\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \" 1. Start with the body on your side\\r\\n2. Put one hand on your shoulder \\r\\n3. Press up with the other arm and hold in extension \",\n      \"video_tips\": \"          \",\n      \"pro_tips\": \" Avoid supporting the movement with your core muscle.      \",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Triceps\"\n      },\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"846\",\n      \"workout_id\": \"21\",\n      \"category\": \"1\",\n      \"repititions\": \"15\",\n      \"exercise_id\": \"29\",\n      \"unit\": \"times\",\n      \"round\": \"3\",\n      \"created_at\": \"2016-01-19 23:15:35\",\n      \"updated_at\": \"2016-04-04 14:14:02\",\n      \"exercise\": {\n      \"id\": \"29\",\n      \"name\": \"Tucked DF\",\n      \"description\": \"Develop your core strength on the path to the hardest core exercise in history\",\n      \"category\": \"1\",\n      \"type\": \"2\",\n      \"muscle_groups\": \"6\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \" 1. Lie on a decline or flat bench and grab the edge of it behind your head with both hands. \\r\\n2. Tuck your knees to your chest.\\r\\n3. Slowly try to extend to bend legs and hold position as long as you can \\r\\n4. Repeat movement. \",\n      \"video_tips\": \"          \",\n      \"pro_tips\": \" Work it slowly and controlled.\\r\\nFocus to engage your core and lower back in all progressions. \",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Core\"\n      },\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"849\",\n      \"workout_id\": \"21\",\n      \"category\": \"1\",\n      \"repititions\": \"30\",\n      \"exercise_id\": \"72\",\n      \"unit\": \"times\",\n      \"round\": \"3\",\n      \"created_at\": \"2016-01-19 23:16:00\",\n      \"updated_at\": \"2016-04-04 14:34:27\",\n      \"exercise\": {\n      \"id\": \"73\",\n      \"name\": \"Tucked Human Flag\",\n      \"description\": \"Start securing your anchoring point and learn to fully lock out your support\",\n      \"category\": \"1\",\n      \"type\": \"2\",\n      \"muscle_groups\": \"1,5,6\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \" 1. Place your hands so that palms face each other.\\r\\n2. Lock lower arm out for stabilization. (Hands, elbows and shoulders are in line) \\r\\n3. Pull your body with your upper arm up and tuck your knees to chest. \",\n      \"video_tips\": \"          \",\n      \"pro_tips\": \" If you begin to fall out of position it's important to land on your feet and let go of the anchor point to protect the shoulders.\\r\\nStraighten your hip and align with body.\\r\\nGet somebody to assist you in the beginning to stay in position. \",\n      \"is_static\": \"1\",\n      \"musclegroup_string\": \"Shoulders, Arms, Core\"\n      },\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"854\",\n      \"workout_id\": \"21\",\n      \"category\": \"1\",\n      \"repititions\": \"10\",\n      \"exercise_id\": \"66\",\n      \"unit\": \"times\",\n      \"round\": \"3\",\n      \"created_at\": \"2016-01-19 23:16:28\",\n      \"updated_at\": \"2016-04-04 14:31:38\",\n      \"exercise\": {\n      \"id\": \"69\",\n      \"name\": \"Jumping Pullups\",\n      \"description\": \"Expose yourself to packed shoulders and hang time\",\n      \"category\": \"1\",\n      \"type\": \"1\",\n      \"muscle_groups\": \"1,5\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \" 1. Grip a bar and jump into the top position of the pull-up exercise\\r\\n2. Straight legs in front of you. \\r\\n3. Slowly go down into a deadhang position \",\n      \"video_tips\": \"        \",\n      \"pro_tips\": \" A deadhang postion requires your shoulder blades down and towards the spine with arms being straight (retraction)\\r\\nAim for three second holds at the top and go down slowly \",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Shoulders, Arms\"\n      },\n      \"is_completed\": 0\n      }\n      ]\n      },\n      \"exercise_category\": 1\n      },\n      \"coach_workout_rounds\": 3,\n      \"workout_intensity\": 1,\n      \"hiit\": [],\n      \"stretching\": [\n      {\n      \"id\": \"1\",\n      \"exercise_id\": \"Superman\",\n      \"duration\": {\n      \"min\": 6,\n      \"max\": 13\n      },\n      \"unit\": \"times\",\n      \"is_completed\": \"0\",\n      \"created_at\": \"2016-01-22 07:10:31\",\n      \"updated_at\": \"2016-01-22 07:10:31\"\n      },\n      {\n      \"id\": \"2\",\n      \"exercise_id\": \"Lower Back Strength\",\n      \"duration\": {\n      \"min\": 38,\n      \"max\": 63\n      },\n      \"unit\": \"times\",\n      \"is_completed\": \"0\",\n      \"created_at\": \"2016-01-22 07:15:02\",\n      \"updated_at\": \"2016-01-22 07:15:02\"\n      },\n      {\n      \"id\": \"3\",\n      \"exercise_id\": \"Upper Dog\",\n      \"duration\": {\n      \"min\": 38,\n      \"max\": 75\n      },\n      \"unit\": \"seconds\",\n      \"is_completed\": \"0\",\n      \"created_at\": \"2016-01-22 07:16:03\",\n      \"updated_at\": \"2016-01-22 07:16:03\"\n      },\n      {\n      \"id\": \"4\",\n      \"exercise_id\": \"Child's Pose\",\n      \"duration\": {\n      \"min\": 38,\n      \"max\": 75\n      },\n      \"unit\": \"seconds\",\n      \"is_completed\": \"0\",\n      \"created_at\": \"2016-01-22 07:16:46\",\n      \"updated_at\": \"2016-01-22 07:16:46\"\n      },\n      {\n      \"id\": \"5\",\n      \"exercise_id\": \"L-sit on the floor\",\n      \"duration\": {\n      \"min\": 38,\n      \"max\": 75\n      },\n      \"unit\": \"seconds\",\n      \"is_completed\": \"0\",\n      \"created_at\": \"2016-01-22 07:17:13\",\n      \"updated_at\": \"2016-01-22 07:17:13\"\n      },\n      {\n      \"id\": \"6\",\n      \"exercise_id\": \"Good morning\",\n      \"duration\": {\n      \"min\": 38,\n      \"max\": 75\n      },\n      \"unit\": \"seconds\",\n      \"is_completed\": \"0\",\n      \"created_at\": \"2016-01-22 07:17:43\",\n      \"updated_at\": \"2016-01-22 07:17:43\"\n      },\n      {\n      \"id\": \"7\",\n      \"exercise_id\": \"Chest Opener\",\n      \"duration\": {\n      \"min\": 38,\n      \"max\": 75\n      },\n      \"unit\": \"seconds\",\n      \"is_completed\": \"0\",\n      \"created_at\": \"2016-01-22 07:19:32\",\n      \"updated_at\": \"2016-01-22 07:19:32\"\n      },\n      {\n      \"id\": \"8\",\n      \"exercise_id\": \"Triceps Stretc\",\n      \"duration\": {\n      \"min\": 38,\n      \"max\": 75\n      },\n      \"unit\": \"seconds\",\n      \"is_completed\": \"0\",\n      \"created_at\": \"2016-01-22 07:19:56\",\n      \"updated_at\": \"2016-01-22 07:19:56\"\n      },\n      {\n      \"id\": \"9\",\n      \"exercise_id\": \"Hands Back\",\n      \"duration\": {\n      \"min\": 38,\n      \"max\": 75\n      },\n      \"unit\": \"seconds\",\n      \"is_completed\": \"0\",\n      \"created_at\": \"2016-01-22 07:20:19\",\n      \"updated_at\": \"2016-01-22 07:20:19\"\n      },\n      {\n      \"id\": \"10\",\n      \"exercise_id\": \"Shoulder Stretch\",\n      \"duration\": {\n      \"min\": 38,\n      \"max\": 75\n      },\n      \"unit\": \"seconds\",\n      \"is_completed\": \"0\",\n      \"created_at\": \"2016-01-22 07:20:45\",\n      \"updated_at\": \"2016-01-22 07:20:45\"\n      }\n      ],\n      \"status\": \"pending\"\n      },\n      \"day6\": {\n      \"warmup\": [\n      {\n      \"id\": \"1\",\n      \"name\": \"wall extensions\",\n      \"duration\": {\n      \"min\": \"10\",\n      \"max\": \"20\"\n      },\n      \"unit\": \"times\",\n      \"created_at\": \"2016-01-21 08:55:06\",\n      \"updated_at\": \"2016-01-21 08:55:06\",\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"2\",\n      \"name\": \"band dislocates\",\n      \"duration\": {\n      \"min\": \"10\",\n      \"max\": \"20\"\n      },\n      \"unit\": \"times\",\n      \"created_at\": \"2016-01-21 08:57:38\",\n      \"updated_at\": \"2016-01-21 08:57:38\",\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"3\",\n      \"name\": \"cat-camels\",\n      \"duration\": {\n      \"min\": \"10\",\n      \"max\": \"20\"\n      },\n      \"unit\": \"times\",\n      \"created_at\": \"2016-01-21 09:00:39\",\n      \"updated_at\": \"2016-01-21 09:00:39\",\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"4\",\n      \"name\": \"scapular shrugs\",\n      \"duration\": {\n      \"min\": \"10\",\n      \"max\": \"20\"\n      },\n      \"unit\": \"times\",\n      \"created_at\": \"2016-01-21 09:01:01\",\n      \"updated_at\": \"2016-01-21 09:01:01\",\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"5\",\n      \"name\": \"full body circles\",\n      \"duration\": {\n      \"min\": \"10\",\n      \"max\": \"20\"\n      },\n      \"unit\": \"times\",\n      \"created_at\": \"2016-01-21 09:01:26\",\n      \"updated_at\": \"2016-01-21 09:01:26\",\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"6\",\n      \"name\": \"Jumping Jacks\",\n      \"duration\": {\n      \"min\": \"100\",\n      \"max\": \"\"\n      },\n      \"unit\": \"seconds\",\n      \"created_at\": \"2016-01-21 09:04:52\",\n      \"updated_at\": \"2016-01-21 09:04:52\",\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"7\",\n      \"name\": \"Arm rotations\",\n      \"duration\": {\n      \"min\": \"120\",\n      \"max\": \"\"\n      },\n      \"unit\": \"times\",\n      \"created_at\": \"2016-01-21 09:05:29\",\n      \"updated_at\": \"2016-01-21 09:05:29\",\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"8\",\n      \"name\": \"High Knees\",\n      \"duration\": {\n      \"min\": \"50\",\n      \"max\": \"\"\n      },\n      \"unit\": \"times\",\n      \"created_at\": \"2016-01-21 09:06:02\",\n      \"updated_at\": \"2016-01-21 09:06:02\",\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"9\",\n      \"name\": \"Shouder rolls\",\n      \"duration\": {\n      \"min\": \"20\",\n      \"max\": \"\"\n      },\n      \"unit\": \"times\",\n      \"created_at\": \"2016-01-21 09:06:34\",\n      \"updated_at\": \"2016-01-21 09:06:34\",\n      \"is_completed\": 0\n      }\n      ],\n      \"is_completed\": 0,\n      \"fundumentals\": [\n      {\n      \"id\": \"11\",\n      \"row\": \"3\",\n      \"exercise_id\": \"64\",\n      \"duration\": {\n      \"min\": \"10\",\n      \"max\": \"\"\n      },\n      \"unit\": \"times\",\n      \"is_completed\": \"0\",\n      \"created_at\": \"2016-01-22 04:35:13\",\n      \"updated_at\": \"2016-04-04 14:27:54\",\n      \"exercise\": {\n      \"id\": \"64\",\n      \"name\": \"Skin the cat\",\n      \"description\": \"Develop your joints mobility and expose yourself to new movement layers\",\n      \"category\": \"1\",\n      \"type\": \"2\",\n      \"muscle_groups\": \"4,5,6\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \" 1. Hands a little more than shoulder width apart\\r\\n2. Raise your knees to the chest\\r\\n3. continuing the movement until the feet pass up through the arms and over head into an inverted hang position.\\r\\n4. Continue to pass the feet round and down toward the ground into the extended 'skin the cat' position.\\r\\n5. Lift your hips and raise the legs back and over to the starting hang position. \",\n      \"video_tips\": \"        \",\n      \"pro_tips\": \" Put your hands closer together to ease up all back lever progressions.\\r\\nDo only half of the movement in the beginning, but fight for completion over time.\\r\\nIncorporate other static elements to challenge yourself during the movement as you master other skills.\\r\\n    \",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Back, Arms, Core\",\n      \"video\": [\n      {\n      \"id\": \"71\",\n      \"path\": \"64_1454045043.mp4\",\n      \"videothumbnail\": \"64_1454045043.jpg\",\n      \"description\": \"Skin the cat\"\n      }\n      ]\n      }\n      },\n      {\n      \"id\": \"12\",\n      \"row\": \"3\",\n      \"exercise_id\": \"12\",\n      \"duration\": {\n      \"min\": \"20\",\n      \"max\": \"\"\n      },\n      \"unit\": \"times\",\n      \"is_completed\": \"0\",\n      \"created_at\": \"2016-01-22 04:36:16\",\n      \"updated_at\": \"2016-04-04 09:26:06\",\n      \"exercise\": {\n      \"id\": \"12\",\n      \"name\": \"Pushups\",\n      \"description\": \"Perform the most popular exercise of all time with real strength\",\n      \"category\": \"2\",\n      \"type\": \"1\",\n      \"muscle_groups\": \"1,2,3\",\n      \"rewards\": \"7.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \" 1. Lie on the floor face down and place your hands in a standard pushup position.\\r\\n 2. Next, lower yourself downward until your chest almost touches the floor as you inhale.\\r\\n 3. Exhale and press your upper body back up to the starting position while squeezing your chest.\\r\\n 4. Repeat, after a brief pause at the top contracted position.\\r\\n\",\n      \"video_tips\": \"      \",\n      \"pro_tips\": \"Do them extra slow and hold it in highest and lowest position to get strength.\\r\\nOne of the most common push-up mistakes is flaring out the elbows out instead of keeping them at your sides.\\r\\nIf too easy, try Spiderman and Diamond Pushups or wear a weigthed vest.\",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Shoulders, Chest, Triceps\",\n      \"video\": [\n      {\n      \"id\": \"57\",\n      \"path\": \"12_1453984139.mp4\",\n      \"videothumbnail\": \"12_1453984139.jpg\",\n      \"description\": \"Pushups\"\n      }\n      ]\n      }\n      },\n      {\n      \"id\": \"13\",\n      \"row\": \"3\",\n      \"exercise_id\": \"49\",\n      \"duration\": {\n      \"min\": \"30\",\n      \"max\": \"\"\n      },\n      \"unit\": \"times\",\n      \"is_completed\": \"0\",\n      \"created_at\": \"2016-01-22 04:36:49\",\n      \"updated_at\": \"2016-04-04 14:19:29\",\n      \"exercise\": {\n      \"id\": \"49\",\n      \"name\": \"Side Triceps\",\n      \"description\": \"Start with the basics of building triceps strength\",\n      \"category\": \"1\",\n      \"type\": \"1\",\n      \"muscle_groups\": \"3\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \" 1. Start with the body on your side\\r\\n2. Put one hand on your shoulder \\r\\n3. Press up with the other arm and hold in extension \",\n      \"video_tips\": \"          \",\n      \"pro_tips\": \" Avoid supporting the movement with your core muscle.      \",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Triceps\",\n      \"video\": [\n      {\n      \"id\": \"43\",\n      \"path\": \"49_1454043404.mp4\",\n      \"videothumbnail\": \"49_1454043404.jpg\",\n      \"description\": \"Side Triceps\"\n      }\n      ]\n      }\n      },\n      {\n      \"id\": \"14\",\n      \"row\": \"3\",\n      \"exercise_id\": \"4\",\n      \"duration\": {\n      \"min\": \"60\",\n      \"max\": \"90\"\n      },\n      \"unit\": \"seconds\",\n      \"is_completed\": \"0\",\n      \"created_at\": \"2016-01-22 04:37:32\",\n      \"updated_at\": \"2016-04-04 14:02:11\",\n      \"exercise\": {\n      \"id\": \"4\",\n      \"name\": \"Plank\",\n      \"description\": \"The plank builds your isometric strength and helps sculpt your waistline.\",\n      \"category\": \"1\",\n      \"type\": \"1\",\n      \"muscle_groups\": \"1,4,6,8\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"seconds\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \"1. Get into pushup position on the floor.\\r\\n2. Now bend your elbows 90 degrees and rest your weight on your forearms. \\r\\n3. Hold the position for as long as you can.   \",\n      \"video_tips\": \"        \",\n      \"pro_tips\": \"Drive your chest away from the ground and spread your shoulder blades as much as you can.\\r\\nKeep a straight line, from head to toe. \\r\\nDon't collapse your lower back or reach your butt to the sky. Add movement to your plank, rock back and forth on your forearms and toes or shift from side to side.\\r\\nTry advanced variations with alternating sinlge leg support. \\r\\nStart with an incline plank if a straight plank is too hard in the beginning.  \",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Shoulders, Back, Core, Full Body\",\n      \"video\": [\n      {\n      \"id\": \"4\",\n      \"path\": \"4_1453976855.mp4\",\n      \"videothumbnail\": \"4_1453976855.jpg\",\n      \"description\": \"Plank\"\n      }\n      ]\n      }\n      },\n      {\n      \"id\": \"15\",\n      \"row\": \"3\",\n      \"exercise_id\": \"36\",\n      \"duration\": {\n      \"min\": \"20\",\n      \"max\": \"\"\n      },\n      \"unit\": \"times\",\n      \"is_completed\": \"0\",\n      \"created_at\": \"2016-01-22 04:37:57\",\n      \"updated_at\": \"2016-04-04 11:12:49\",\n      \"exercise\": {\n      \"id\": \"36\",\n      \"name\": \"High Jumps\",\n      \"description\": \"Do high jumps as a part of restless HIIT workouts\",\n      \"category\": \"1\",\n      \"type\": \"2\",\n      \"muscle_groups\": \"7\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \"1. Start from a standing position\\r\\n2. Jump up and bring your knees to your chest\",\n      \"video_tips\": \"    \",\n      \"pro_tips\": \"Land softly and exhale when the knees are up.\\r\\n  \",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Legs\",\n      \"video\": [\n      {\n      \"id\": \"33\",\n      \"path\": \"36_1454042273.mp4\",\n      \"videothumbnail\": \"36_1454042273.jpg\",\n      \"description\": \"High Jumps\"\n      }\n      ]\n      }\n      }\n      ],\n      \"exercises\": [],\n      \"workout\": {\n      \"id\": \"10\",\n      \"name\": \"Loki\",\n      \"description\": \"A,E,B\",\n      \"rounds\": \"1\",\n      \"category\": \"1\",\n      \"type\": \"1\",\n      \"rewards\": \"330\",\n      \"duration\": \"1440.00\",\n      \"equipments\": \"Bar/Rings\",\n      \"is_completed\": 0,\n      \"exercises\": {\n      \"round1\": [\n      {\n      \"id\": \"364\",\n      \"workout_id\": \"10\",\n      \"category\": \"1\",\n      \"repititions\": \"15\",\n      \"exercise_id\": \"66\",\n      \"unit\": \"times\",\n      \"round\": \"1\",\n      \"created_at\": \"2016-01-19 05:35:04\",\n      \"updated_at\": \"2016-04-04 14:31:38\",\n      \"exercise\": {\n      \"id\": \"69\",\n      \"name\": \"Jumping Pullups\",\n      \"description\": \"Expose yourself to packed shoulders and hang time\",\n      \"category\": \"1\",\n      \"type\": \"1\",\n      \"muscle_groups\": \"1,5\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \" 1. Grip a bar and jump into the top position of the pull-up exercise\\r\\n2. Straight legs in front of you. \\r\\n3. Slowly go down into a deadhang position \",\n      \"video_tips\": \"        \",\n      \"pro_tips\": \" A deadhang postion requires your shoulder blades down and towards the spine with arms being straight (retraction)\\r\\nAim for three second holds at the top and go down slowly \",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Shoulders, Arms\"\n      },\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"365\",\n      \"workout_id\": \"10\",\n      \"category\": \"1\",\n      \"repititions\": \"120\",\n      \"exercise_id\": \"4\",\n      \"unit\": \"seconds\",\n      \"round\": \"1\",\n      \"created_at\": \"2016-01-19 05:35:24\",\n      \"updated_at\": \"2016-04-04 14:02:11\",\n      \"exercise\": {\n      \"id\": \"4\",\n      \"name\": \"Plank\",\n      \"description\": \"The plank builds your isometric strength and helps sculpt your waistline.\",\n      \"category\": \"1\",\n      \"type\": \"1\",\n      \"muscle_groups\": \"1,4,6,8\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"seconds\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \"1. Get into pushup position on the floor.\\r\\n2. Now bend your elbows 90 degrees and rest your weight on your forearms. \\r\\n3. Hold the position for as long as you can.   \",\n      \"video_tips\": \"        \",\n      \"pro_tips\": \"Drive your chest away from the ground and spread your shoulder blades as much as you can.\\r\\nKeep a straight line, from head to toe. \\r\\nDon't collapse your lower back or reach your butt to the sky. Add movement to your plank, rock back and forth on your forearms and toes or shift from side to side.\\r\\nTry advanced variations with alternating sinlge leg support. \\r\\nStart with an incline plank if a straight plank is too hard in the beginning.  \",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Shoulders, Back, Core, Full Body\"\n      },\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"366\",\n      \"workout_id\": \"10\",\n      \"category\": \"1\",\n      \"repititions\": \"50\",\n      \"exercise_id\": \"49\",\n      \"unit\": \"times\",\n      \"round\": \"1\",\n      \"created_at\": \"2016-01-19 05:35:49\",\n      \"updated_at\": \"2016-04-04 14:19:29\",\n      \"exercise\": {\n      \"id\": \"49\",\n      \"name\": \"Side Triceps\",\n      \"description\": \"Start with the basics of building triceps strength\",\n      \"category\": \"1\",\n      \"type\": \"1\",\n      \"muscle_groups\": \"3\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \" 1. Start with the body on your side\\r\\n2. Put one hand on your shoulder \\r\\n3. Press up with the other arm and hold in extension \",\n      \"video_tips\": \"          \",\n      \"pro_tips\": \" Avoid supporting the movement with your core muscle.      \",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Triceps\"\n      },\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"367\",\n      \"workout_id\": \"10\",\n      \"category\": \"1\",\n      \"repititions\": \"25\",\n      \"exercise_id\": \"29\",\n      \"unit\": \"times\",\n      \"round\": \"1\",\n      \"created_at\": \"2016-01-19 05:36:05\",\n      \"updated_at\": \"2016-04-04 14:14:02\",\n      \"exercise\": {\n      \"id\": \"29\",\n      \"name\": \"Tucked DF\",\n      \"description\": \"Develop your core strength on the path to the hardest core exercise in history\",\n      \"category\": \"1\",\n      \"type\": \"2\",\n      \"muscle_groups\": \"6\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \" 1. Lie on a decline or flat bench and grab the edge of it behind your head with both hands. \\r\\n2. Tuck your knees to your chest.\\r\\n3. Slowly try to extend to bend legs and hold position as long as you can \\r\\n4. Repeat movement. \",\n      \"video_tips\": \"          \",\n      \"pro_tips\": \" Work it slowly and controlled.\\r\\nFocus to engage your core and lower back in all progressions. \",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Core\"\n      },\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"368\",\n      \"workout_id\": \"10\",\n      \"category\": \"1\",\n      \"repititions\": \"50\",\n      \"exercise_id\": \"9\",\n      \"unit\": \"times\",\n      \"round\": \"1\",\n      \"created_at\": \"2016-01-19 05:36:21\",\n      \"updated_at\": \"2016-04-04 09:22:17\",\n      \"exercise\": {\n      \"id\": \"9\",\n      \"name\": \"Crunches\",\n      \"description\": \"Do the most admired sixpack exercise in the world\",\n      \"category\": \"1\",\n      \"type\": \"1\",\n      \"muscle_groups\": \"6\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \"1. Starting position is with lying face up on the floor with knees bent. \\r\\n2. Move torso up and touch your knees with your hands\\r\\n3. Lower body to the floor and repeat\\r\\n  \",\n      \"video_tips\": \"    \",\n      \"pro_tips\": \"Do variations in tempo. Aim for one count up and three counts down.\\r\\nIf you have a tendency to interlace your fingers and yank your head, place your hands cross-chest.\",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Core\"\n      },\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"369\",\n      \"workout_id\": \"10\",\n      \"category\": \"1\",\n      \"repititions\": \"25\",\n      \"exercise_id\": \"29\",\n      \"unit\": \"times\",\n      \"round\": \"1\",\n      \"created_at\": \"2016-01-19 05:36:44\",\n      \"updated_at\": \"2016-04-04 14:14:02\",\n      \"exercise\": {\n      \"id\": \"29\",\n      \"name\": \"Tucked DF\",\n      \"description\": \"Develop your core strength on the path to the hardest core exercise in history\",\n      \"category\": \"1\",\n      \"type\": \"2\",\n      \"muscle_groups\": \"6\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \" 1. Lie on a decline or flat bench and grab the edge of it behind your head with both hands. \\r\\n2. Tuck your knees to your chest.\\r\\n3. Slowly try to extend to bend legs and hold position as long as you can \\r\\n4. Repeat movement. \",\n      \"video_tips\": \"          \",\n      \"pro_tips\": \" Work it slowly and controlled.\\r\\nFocus to engage your core and lower back in all progressions. \",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Core\"\n      },\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"370\",\n      \"workout_id\": \"10\",\n      \"category\": \"1\",\n      \"repititions\": \"50\",\n      \"exercise_id\": \"49\",\n      \"unit\": \"times\",\n      \"round\": \"1\",\n      \"created_at\": \"2016-01-19 05:37:38\",\n      \"updated_at\": \"2016-04-04 14:19:29\",\n      \"exercise\": {\n      \"id\": \"49\",\n      \"name\": \"Side Triceps\",\n      \"description\": \"Start with the basics of building triceps strength\",\n      \"category\": \"1\",\n      \"type\": \"1\",\n      \"muscle_groups\": \"3\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \" 1. Start with the body on your side\\r\\n2. Put one hand on your shoulder \\r\\n3. Press up with the other arm and hold in extension \",\n      \"video_tips\": \"          \",\n      \"pro_tips\": \" Avoid supporting the movement with your core muscle.      \",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Triceps\"\n      },\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"371\",\n      \"workout_id\": \"10\",\n      \"category\": \"1\",\n      \"repititions\": \"120\",\n      \"exercise_id\": \"4\",\n      \"unit\": \"seconds\",\n      \"round\": \"1\",\n      \"created_at\": \"2016-01-19 05:37:58\",\n      \"updated_at\": \"2016-04-04 14:02:11\",\n      \"exercise\": {\n      \"id\": \"4\",\n      \"name\": \"Plank\",\n      \"description\": \"The plank builds your isometric strength and helps sculpt your waistline.\",\n      \"category\": \"1\",\n      \"type\": \"1\",\n      \"muscle_groups\": \"1,4,6,8\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"seconds\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \"1. Get into pushup position on the floor.\\r\\n2. Now bend your elbows 90 degrees and rest your weight on your forearms. \\r\\n3. Hold the position for as long as you can.   \",\n      \"video_tips\": \"        \",\n      \"pro_tips\": \"Drive your chest away from the ground and spread your shoulder blades as much as you can.\\r\\nKeep a straight line, from head to toe. \\r\\nDon't collapse your lower back or reach your butt to the sky. Add movement to your plank, rock back and forth on your forearms and toes or shift from side to side.\\r\\nTry advanced variations with alternating sinlge leg support. \\r\\nStart with an incline plank if a straight plank is too hard in the beginning.  \",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Shoulders, Back, Core, Full Body\"\n      },\n      \"is_completed\": 0\n      },\n      {\n      \"id\": \"372\",\n      \"workout_id\": \"10\",\n      \"category\": \"1\",\n      \"repititions\": \"15\",\n      \"exercise_id\": \"66\",\n      \"unit\": \"times\",\n      \"round\": \"1\",\n      \"created_at\": \"2016-01-19 05:38:13\",\n      \"updated_at\": \"2016-04-04 14:31:38\",\n      \"exercise\": {\n      \"id\": \"69\",\n      \"name\": \"Jumping Pullups\",\n      \"description\": \"Expose yourself to packed shoulders and hang time\",\n      \"category\": \"1\",\n      \"type\": \"1\",\n      \"muscle_groups\": \"1,5\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \" 1. Grip a bar and jump into the top position of the pull-up exercise\\r\\n2. Straight legs in front of you. \\r\\n3. Slowly go down into a deadhang position \",\n      \"video_tips\": \"        \",\n      \"pro_tips\": \" A deadhang postion requires your shoulder blades down and towards the spine with arms being straight (retraction)\\r\\nAim for three second holds at the top and go down slowly \",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Shoulders, Arms\"\n      },\n      \"is_completed\": 0\n      }\n      ]\n      },\n      \"exercise_category\": 1\n      },\n      \"coach_workout_rounds\": 1,\n      \"workout_intensity\": 1,\n      \"hiit\": [\n      {\n      \"id\": 2,\n      \"intensity\": 4,\n      \"is_completed\": 0,\n      \"replacement\": [\n      {\n      \"round1\": [\n      {\n      \"name\": \"Burpee\",\n      \"duration\": 10,\n      \"unit\": \"times\",\n      \"exercise\": {\n      \"id\": \"31\",\n      \"name\": \"Burpee\",\n      \"description\": \"Test your fitness with the original burpee\",\n      \"category\": \"2\",\n      \"type\": \"1\",\n      \"muscle_groups\": \"8\",\n      \"rewards\": \"7.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \"1. Start in a standing position\\r\\n2. Go down and bring your body down to the floor\\r\\n3. Jump back up with your hands behind your head\",\n      \"video_tips\": \"    \",\n      \"pro_tips\": \"Avoid a hollow back during the movement. \\r\\nKeep the core and lower back engaged at all times.\",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Full Body\",\n      \"video\": [\n      {\n      \"id\": \"28\",\n      \"path\": \"31_1454041910.mp4\",\n      \"videothumbnail\": \"31_1454041910.jpg\",\n      \"description\": \"Burpee\"\n      }\n      ]\n      }\n      },\n      {\n      \"name\": \"Rest\",\n      \"duration\": 10,\n      \"unit\": \"seconds\",\n      \"exercise\": []\n      }\n      ],\n      \"round2\": [\n      {\n      \"name\": \"High Jumps\",\n      \"duration\": 25,\n      \"unit\": \"times\",\n      \"exercise\": {\n      \"id\": \"36\",\n      \"name\": \"High Jumps\",\n      \"description\": \"Do high jumps as a part of restless HIIT workouts\",\n      \"category\": \"1\",\n      \"type\": \"2\",\n      \"muscle_groups\": \"7\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \"1. Start from a standing position\\r\\n2. Jump up and bring your knees to your chest\",\n      \"video_tips\": \"    \",\n      \"pro_tips\": \"Land softly and exhale when the knees are up.\\r\\n  \",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Legs\",\n      \"video\": [\n      {\n      \"id\": \"33\",\n      \"path\": \"36_1454042273.mp4\",\n      \"videothumbnail\": \"36_1454042273.jpg\",\n      \"description\": \"High Jumps\"\n      }\n      ]\n      }\n      },\n      {\n      \"name\": \"Rest\",\n      \"duration\": 10,\n      \"unit\": \"seconds\",\n      \"exercise\": []\n      }\n      ],\n      \"round3\": [\n      {\n      \"name\": \"Knee Raises\",\n      \"duration\": 15,\n      \"unit\": \"times\",\n      \"exercise\": {\n      \"id\": \"57\",\n      \"name\": \"Knee Raises\",\n      \"description\": \"Develop grip and core strength and get used to slow and controlled moves\",\n      \"category\": \"1\",\n      \"type\": \"2\",\n      \"muscle_groups\": \"4,6,7\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \"1. Start from a deadhang position with your arms and legs fully extended, and feet off the ground.  \\r\\n2. Raise your knees up towards your chest as high as possible. \\r\\n3. Hold for a brief moment and slowly return to the starting position. \\r\\n4. Repeat for required repetitions. \",\n      \"video_tips\": \"    \",\n      \"pro_tips\": \"Avoid using momentum or swinging during the exercise. \\r\\nPerform the knee raise slowly and controlled.\",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"Back, Core, Legs\",\n      \"video\": [\n      {\n      \"id\": \"67\",\n      \"path\": \"57_1454044213.mp4\",\n      \"videothumbnail\": \"57_1454044213.jpg\",\n      \"description\": \"Knee Raises\"\n      }\n      ]\n      }\n      },\n      {\n      \"name\": \"Rest\",\n      \"duration\": 10,\n      \"unit\": \"seconds\",\n      \"exercise\": []\n      }\n      ]\n      }\n      ],\n      \"replacement_round_count\": 3\n      }\n      ],\n      \"stretching\": [\n      {\n      \"id\": \"1\",\n      \"exercise_id\": \"Superman\",\n      \"duration\": {\n      \"min\": 6,\n      \"max\": 13\n      },\n      \"unit\": \"times\",\n      \"is_completed\": \"0\",\n      \"created_at\": \"2016-01-22 07:10:31\",\n      \"updated_at\": \"2016-01-22 07:10:31\"\n      },\n      {\n      \"id\": \"2\",\n      \"exercise_id\": \"Lower Back Strength\",\n      \"duration\": {\n      \"min\": 38,\n      \"max\": 63\n      },\n      \"unit\": \"times\",\n      \"is_completed\": \"0\",\n      \"created_at\": \"2016-01-22 07:15:02\",\n      \"updated_at\": \"2016-01-22 07:15:02\"\n      },\n      {\n      \"id\": \"3\",\n      \"exercise_id\": \"Upper Dog\",\n      \"duration\": {\n      \"min\": 38,\n      \"max\": 75\n      },\n      \"unit\": \"seconds\",\n      \"is_completed\": \"0\",\n      \"created_at\": \"2016-01-22 07:16:03\",\n      \"updated_at\": \"2016-01-22 07:16:03\"\n      },\n      {\n      \"id\": \"4\",\n      \"exercise_id\": \"Child's Pose\",\n      \"duration\": {\n      \"min\": 38,\n      \"max\": 75\n      },\n      \"unit\": \"seconds\",\n      \"is_completed\": \"0\",\n      \"created_at\": \"2016-01-22 07:16:46\",\n      \"updated_at\": \"2016-01-22 07:16:46\"\n      },\n      {\n      \"id\": \"5\",\n      \"exercise_id\": \"L-sit on the floor\",\n      \"duration\": {\n      \"min\": 38,\n      \"max\": 75\n      },\n      \"unit\": \"seconds\",\n      \"is_completed\": \"0\",\n      \"created_at\": \"2016-01-22 07:17:13\",\n      \"updated_at\": \"2016-01-22 07:17:13\"\n      },\n      {\n      \"id\": \"6\",\n      \"exercise_id\": \"Good morning\",\n      \"duration\": {\n      \"min\": 38,\n      \"max\": 75\n      },\n      \"unit\": \"seconds\",\n      \"is_completed\": \"0\",\n      \"created_at\": \"2016-01-22 07:17:43\",\n      \"updated_at\": \"2016-01-22 07:17:43\"\n      },\n      {\n      \"id\": \"7\",\n      \"exercise_id\": \"Chest Opener\",\n      \"duration\": {\n      \"min\": 38,\n      \"max\": 75\n      },\n      \"unit\": \"seconds\",\n      \"is_completed\": \"0\",\n      \"created_at\": \"2016-01-22 07:19:32\",\n      \"updated_at\": \"2016-01-22 07:19:32\"\n      },\n      {\n      \"id\": \"8\",\n      \"exercise_id\": \"Triceps Stretc\",\n      \"duration\": {\n      \"min\": 38,\n      \"max\": 75\n      },\n      \"unit\": \"seconds\",\n      \"is_completed\": \"0\",\n      \"created_at\": \"2016-01-22 07:19:56\",\n      \"updated_at\": \"2016-01-22 07:19:56\"\n      },\n      {\n      \"id\": \"9\",\n      \"exercise_id\": \"Hands Back\",\n      \"duration\": {\n      \"min\": 38,\n      \"max\": 75\n      },\n      \"unit\": \"seconds\",\n      \"is_completed\": \"0\",\n      \"created_at\": \"2016-01-22 07:20:19\",\n      \"updated_at\": \"2016-01-22 07:20:19\"\n      },\n      {\n      \"id\": \"10\",\n      \"exercise_id\": \"Shoulder Stretch\",\n      \"duration\": {\n      \"min\": 38,\n      \"max\": 75\n      },\n      \"unit\": \"seconds\",\n      \"is_completed\": \"0\",\n      \"created_at\": \"2016-01-22 07:20:45\",\n      \"updated_at\": \"2016-01-22 07:20:45\"\n      }\n      ],\n      \"status\": \"pending\"\n      }\n      },\n      \"category\": \"professional\",\n      \"muscle_groups\": \"\",\n      \"limitations\": \"\",\n      \"goal_option\": \"0\",\n      \"feedback\": \"0\",\n      \"created_at\": \"2016-05-27 06:54:49\",\n      \"updated_at\": \"2016-06-14 12:50:18\",\n      \"musclegroup_string\": \"\",\n      \"goaloption_string\": \"\",\n      \"description\": \"Strive for progress\"\n      },\n      \"urls\": {\n      \"profileImageSmall\": \"http://testing.ykings.com/uploads/images/profile/small\",\n      \"profileImageMedium\": \"http://testing.ykings.com/uploads/images/profile/medium\",\n      \"profileImageLarge\": \"http://testing.ykings.com/uploads/images/profile/large\",\n      \"profileImageOriginal\": \"http://testing.ykings.com/uploads/images/profile/original\",\n      \"video\": \"http://testing.ykings.com/uploads/videos\",\n      \"videothumbnail\": \"http://testing.ykings.com/uploads/images/videothumbnails\",\n      \"feedImageSmall\": \"http://testing.ykings.com/uploads/images/feed/small\",\n      \"feedImageMedium\": \"http://testing.ykings.com/uploads/images/feed/medium\",\n      \"feedImageLarge\": \"http://testing.ykings.com/uploads/images/feed/large\",\n      \"feedImageOriginal\": \"http://testing.ykings.com/uploads/images/feed/original\",\n      \"coverImageSmall\": \"http://testing.ykings.com/uploads/images/cover_image/small\",\n      \"coverImageMedium\": \"http://testing.ykings.com/uploads/images/cover_image/medium\",\n      \"coverImageLarge\": \"http://testing.ykings.com/uploads/images/cover_image/large\",\n      \"coverImageOriginal\": \"http://testing.ykings.com/uploads/images/cover_image/original\"\n      }\n      }",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "error",
            "description": "<p>Message token_invalid.</p> "
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 400 Invalid Request\n{\n  \"status\":\"0\",\n  \"error\": \"token_invalid\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 401 Unauthorised\n{\n  \"status\":\"0\",\n  \"error\": \"token_expired\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 400 Bad Request\n{\n  \"status\":\"0\",\n  \"error\": \"token_not_provided\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 422 Validation error\n{\n  \"status\" : 0,\n  \"error\": \"The user_id field is required\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 500 user_not_exists\n{\n  \"status\" : 0,\n  \"error\": \"user_not_exists\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 500 Invalid options selected.\n{\n          \"status\": 0,\n          \"message\": \"Invalid options selected. Please revisit your options to get your coach.\"\n        }",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "app/Http/Controllers/Api/CoachesController.php",
    "groupTitle": "Coach"
  },
  {
    "type": "post",
    "url": "/connect/connectFriends",
    "title": "connectFriends",
    "name": "connectFriends",
    "group": "Connect",
    "description": "<p>API for connecting facebook/phone book.</p> ",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "<p>string</p> ",
            "optional": false,
            "field": "user_id",
            "description": "<p>User Id of user *required</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>string</p> ",
            "optional": false,
            "field": "friends_list",
            "description": "<p>email/facebook id ,json array *required</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>string</p> ",
            "optional": false,
            "field": "type",
            "description": "<p>facebook/phonebook *required</p> "
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "<p>String</p> ",
            "optional": false,
            "field": "success.",
            "description": ""
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n      type:phone\n\n      {\n      \"status\": 1,\n      \"registered_emails\": [\n      {\n      \"id\": \"14\",\n      \"email\": \"sachin@cubettech.com\",\n      \"confirmation_code\": null,\n      \"status\": \"1\",\n      \"created_at\": \"2015-11-11 06:23:56\",\n      \"updated_at\": \"2015-11-11 06:23:56\",\n      \"is_subscribed\": 0,\n      \"is_following\": 0,\n      \"profile\": [\n      {\n      \"id\": \"8\",\n      \"user_id\": \"14\",\n      \"first_name\": \"sachii\",\n      \"last_name\": \"k\",\n      \"gender\": \"0\",\n      \"fitness_status\": \"0\",\n      \"goal\": \"0\",\n      \"image\": null,\n      \"cover_image\": \"\",\n      \"city\": null,\n      \"state\": null,\n      \"country\": null,\n      \"spot\": \"\",\n      \"quote\": \"\",\n      \"created_at\": \"2015-11-11 06:23:56\",\n      \"updated_at\": \"2015-11-11 06:23:56\"\n      }\n      ]\n      }\n      ],\n      \"urls\": {\n      \"profileImageSmall\": \"http://sandbox.ykings.com/uploads/images/profile/small\",\n      \"profileImageMedium\": \"http://sandbox.ykings.com/uploads/images/profile/medium\",\n      \"profileImageLarge\": \"http://sandbox.ykings.com/uploads/images/profile/large\",\n      \"profileImageOriginal\": \"http://sandbox.ykings.com/uploads/images/profile/original\",\n      \"video\": \"http://sandbox.ykings.com/uploads/videos\",\n      \"videothumbnail\": \"http://sandbox.ykings.com/uploads/images/videothumbnails\",\n      \"feedImageSmall\": \"http://sandbox.ykings.com/uploads/images/feed/small\",\n      \"feedImageMedium\": \"http://sandbox.ykings.com/uploads/images/feed/medium\",\n      \"feedImageLarge\": \"http://sandbox.ykings.com/uploads/images/feed/large\",\n      \"feedImageOriginal\": \"http://sandbox.ykings.com/uploads/images/feed/original\",\n      \"coverImageSmall\": \"http://sandbox.ykings.com/uploads/images/cover_image/small\",\n      \"coverImageMedium\": \"http://sandbox.ykings.com/uploads/images/cover_image/medium\",\n      \"coverImageLarge\": \"http://sandbox.ykings.com/uploads/images/cover_image/large\",\n      \"coverImageOriginal\": \"http://sandbox.ykings.com/uploads/images/cover_image/original\"\n      },\n      \"type\": \"phone\"\n      }\n\n      type:facebook\n      {\n      \"status\": 1,\n      \"registered_emails\": [\n      {\n      \"id\": \"3\",\n      \"user_id\": \"15\",\n      \"provider\": \"facebook\",\n      \"provider_uid\": \"100789521\",\n      \"access_token\": \"\",\n      \"created_at\": \"2015-11-11 06:25:34\",\n      \"updated_at\": \"2015-11-11 06:25:34\",\n      \"email\": \"ansa@cubettech.com\",\n      \"is_following\": 0,\n      \"profile\": {\n      \"id\": \"9\",\n      \"user_id\": \"15\",\n      \"first_name\": \"Dibu\",\n      \"last_name\": \"k\",\n      \"gender\": \"0\",\n      \"fitness_status\": \"0\",\n      \"goal\": \"0\",\n      \"image\": null,\n      \"cover_image\": \"\",\n      \"city\": null,\n      \"state\": null,\n      \"country\": null,\n      \"spot\": \"\",\n      \"quote\": \"\",\n      \"created_at\": \"2015-11-11 06:25:34\",\n      \"updated_at\": \"2015-11-11 06:25:34\"\n      }\n      }\n      ],\n      \"urls\": {\n      \"profileImageSmall\": \"http://sandbox.ykings.com/uploads/images/profile/small\",\n      \"profileImageMedium\": \"http://sandbox.ykings.com/uploads/images/profile/medium\",\n      \"profileImageLarge\": \"http://sandbox.ykings.com/uploads/images/profile/large\",\n      \"profileImageOriginal\": \"http://sandbox.ykings.com/uploads/images/profile/original\",\n      \"video\": \"http://sandbox.ykings.com/uploads/videos\",\n      \"videothumbnail\": \"http://sandbox.ykings.com/uploads/images/videothumbnails\",\n      \"feedImageSmall\": \"http://sandbox.ykings.com/uploads/images/feed/small\",\n      \"feedImageMedium\": \"http://sandbox.ykings.com/uploads/images/feed/medium\",\n      \"feedImageLarge\": \"http://sandbox.ykings.com/uploads/images/feed/large\",\n      \"feedImageOriginal\": \"http://sandbox.ykings.com/uploads/images/feed/original\",\n      \"coverImageSmall\": \"http://sandbox.ykings.com/uploads/images/cover_image/small\",\n      \"coverImageMedium\": \"http://sandbox.ykings.com/uploads/images/cover_image/medium\",\n      \"coverImageLarge\": \"http://sandbox.ykings.com/uploads/images/cover_image/large\",\n      \"coverImageOriginal\": \"http://sandbox.ykings.com/uploads/images/cover_image/original\"\n      },\n      \"type\": \"facebook\"\n      }",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "error",
            "description": "<p>Message token_invalid.</p> "
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 400 Invalid Request\n{\n  \"error\": \"token_invalid\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 401 Unauthorised\n{\n  \"error\": \"token_expired\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 400 Bad Request\n{\n  \"error\": \"token_not_provided\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 422 Validation error\n{\n  \"status\" : 0,\n  \"error\": \"The user_id field is required\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 422 Validation error\n{\n  \"status\" : 0,\n  \"error\": \"The email field is required\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 422 Validation error\n{\n  \"status\" : 0,\n  \"error\": \"The type field is required\"\n}",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "app/Http/Controllers/Api/UserFriendsController.php",
    "groupTitle": "Connect"
  },
  {
    "type": "post",
    "url": "connect/inviteFriends",
    "title": "inviteFriends",
    "name": "inviteFriends",
    "group": "Connect",
    "description": "<p>API for inviteFriends.</p> ",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "<p>string</p> ",
            "optional": false,
            "field": "user_id",
            "description": "<p>User Id of user *required</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>string</p> ",
            "optional": false,
            "field": "email",
            "description": "<p>Email Ids from contact,json array  *required</p> "
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "<p>String</p> ",
            "optional": false,
            "field": "success.",
            "description": ""
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n      {\n      \"status\": 1,\n      \"success\": \"Invitation sent\"\n      }",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "error",
            "description": "<p>Message token_invalid.</p> "
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 400 Invalid Request\n{\n  \"error\": \"token_invalid\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 401 Unauthorised\n{\n  \"error\": \"token_expired\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 400 Bad Request\n{\n  \"error\": \"token_not_provided\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 422 Validation error\n{\n  \"status\" : 0,\n  \"error\": \"The user_id field is required\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 422 Validation error\n{\n  \"status\" : 0,\n  \"error\": \"The email field is required\"\n}",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "app/Http/Controllers/Api/UserFriendsController.php",
    "groupTitle": "Connect"
  },
  {
    "type": "post",
    "url": "/exercise/get",
    "title": "getExercise",
    "name": "getExercise",
    "group": "Exercise",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "<p>Number</p> ",
            "optional": false,
            "field": "exercise_id",
            "description": "<p>Id of exercise *required</p> "
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "<p>String</p> ",
            "optional": false,
            "field": "success.",
            "description": ""
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n{\n      \"status\": 1,\n      \"exercise\": {\n      \"id\": \"1\",\n      \"name\": \"Jumping Pullups\",\n      \"description\": \"The jumping pull-up is a challenging full body exercise that targets the back, legs and arms.\",\n      \"category\": \"1\",\n      \"type\": \"1\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"1.00\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"created_at\": \"2015-11-17 08:00:19\",\n      \"updated_at\": \"2015-11-20 04:20:50\",\n      \"video\": [\n      {\n      \"id\": \"1\",\n      \"user_id\": \"1\",\n      \"path\": \"Now1.mp4\",\n      \"videothumbnail\": \"\",\n      \"description\": \"Test Description\",\n      \"parent_type\": \"1\",\n      \"type\": \"1\",\n      \"parent_id\": \"1\",\n      \"created_at\": \"2015-11-11 01:56:40\",\n      \"updated_at\": \"2015-11-11 12:13:27\"\n      }\n      ]\n      },\n      \"urls\": {\n      \"profileImageSmall\": \"http://sandbox.ykings.com/uploads/images/profile/small\",\n      \"profileImageMedium\": \"http://sandbox.ykings.com/uploads/images/profile/medium\",\n      \"profileImageLarge\": \"http://sandbox.ykings.com/uploads/images/profile/large\",\n      \"profileImageOriginal\": \"http://sandbox.ykings.com/uploads/images/profile/original\",\n      \"video\": \"http://sandbox.ykings.com/uploads/videos\",\n      \"videothumbnail\": \"http://sandbox.ykings.com/uploads/images/videothumbnails\",\n      \"feedImageSmall\": \"http://sandbox.ykings.com/uploads/images/feed/small\",\n      \"feedImageMedium\": \"http://sandbox.ykings.com/uploads/images/feed/medium\",\n      \"feedImageLarge\": \"http://sandbox.ykings.com/uploads/images/feed/large\",\n      \"feedImageOriginal\": \"http://sandbox.ykings.com/uploads/images/feed/original\",\n      \"coverImageSmall\": \"http://sandbox.ykings.com/uploads/images/cover_image/small\",\n      \"coverImageMedium\": \"http://sandbox.ykings.com/uploads/images/cover_image/medium\",\n      \"coverImageLarge\": \"http://sandbox.ykings.com/uploads/images/cover_image/large\",\n      \"coverImageOriginal\": \"http://sandbox.ykings.com/uploads/images/cover_image/original\"\n      }\n      }",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "error",
            "description": "<p>Message token_invalid.</p> "
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 400 Invalid Request\n{\n  \"status\":\"0\",\n  \"error\": \"token_invalid\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 401 Unauthorised\n{\n  \"status\":\"0\",\n  \"error\": \"token_expired\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 400 Bad Request\n{\n  \"status\":\"0\",\n  \"error\": \"token_not_provided\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 422 Validation error\n{\n  \"status\" : 0,\n  \"error\": \"The exercise_id field is required\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 500 exercise_not_exists\n{\n  \"status\" : 0,\n  \"error\": \"exercise_not_exists\"\n}",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "app/Http/Controllers/Api/ExercisesController.php",
    "groupTitle": "Exercise"
  },
  {
    "type": "post",
    "url": "/exercise/getwithusers",
    "title": "getExerciseWithUsers",
    "name": "getExerciseWithUsers",
    "group": "Exercise",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "<p>Number</p> ",
            "optional": false,
            "field": "exercise_id",
            "description": "<p>Id of exercise *required</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>Number</p> ",
            "optional": false,
            "field": "user_id",
            "description": "<p>Id of user *required</p> "
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "<p>String</p> ",
            "optional": false,
            "field": "success.",
            "description": ""
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n{\n      \"status\": 1,\n      \"exercise\": {\n      \"10\": {\n      \"users\": [],\n      \"personal_best\": \"\"\n      },\n      \"20\": {\n      \"users\": [],\n      \"personal_best\": \"\"\n      },\n      \"25\": {\n      \"users\": [],\n      \"personal_best\": \"\"\n      },\n      \"30\": {\n      \"users\": [],\n      \"personal_best\": \"\"\n      },\n      \"50\": {\n      \"users\": [\n      {\n      \"id\": \"186\",\n      \"user_id\": \"3\",\n      \"exercise_id\": \"12\",\n      \"status\": \"1\",\n      \"time\": \"10\",\n      \"is_starred\": \"0\",\n      \"volume\": \"50\",\n      \"feed_id\": \"248\",\n      \"created_at\": \"2016-02-02 14:53:07\",\n      \"updated_at\": \"2016-02-02 14:53:07\",\n      \"profile\": {\n      \"id\": \"3\",\n      \"user_id\": \"3\",\n      \"first_name\": \"Arun\",\n      \"last_name\": \"MG\",\n      \"gender\": \"0\",\n      \"fitness_status\": \"3\",\n      \"goal\": \"1\",\n      \"image\": \"3_1453737842.jpg\",\n      \"cover_image\": \"3_1453914991.jpg\",\n      \"city\": \"kakkanad\",\n      \"state\": \"\",\n      \"country\": \"\",\n      \"spot\": \"\",\n      \"quote\": \"To lean\",\n      \"facebook\": \"\",\n      \"twitter\": \"\",\n      \"instagram\": \"\",\n      \"created_at\": \"2016-01-22 05:57:51\",\n      \"updated_at\": \"2016-02-04 12:34:45\",\n      \"level\": 13\n      }\n      }\n      ],\n      \"personal_best\": \"10\"\n      },\n      \"60\": {\n      \"users\": [],\n      \"personal_best\": \"\"\n      },\n      \"100\": {\n      \"users\": [],\n      \"personal_best\": \"\"\n      },\n      \"120\": {\n      \"users\": [],\n      \"personal_best\": \"\"\n      },\n      \"180\": {\n      \"users\": [],\n      \"personal_best\": \"\"\n      },\n      \"240\": {\n      \"users\": [],\n      \"personal_best\": \"\"\n      },\n      \"250\": {\n      \"users\": [],\n      \"personal_best\": \"\"\n      },\n      \"300\": {\n      \"users\": [],\n      \"personal_best\": \"\"\n      },\n      \"360\": {\n      \"users\": [],\n      \"personal_best\": \"\"\n      },\n      \"420\": {\n      \"users\": [],\n      \"personal_best\": \"\"\n      },\n      \"480\": {\n      \"users\": [],\n      \"personal_best\": \"\"\n      },\n      \"500\": {\n      \"users\": [],\n      \"personal_best\": \"\"\n      },\n      \"540\": {\n      \"users\": [],\n      \"personal_best\": \"\"\n      },\n      \"600\": {\n      \"users\": [],\n      \"personal_best\": \"\"\n      },\n      \"750\": {\n      \"users\": [],\n      \"personal_best\": \"\"\n      },\n      \"1000\": {\n      \"users\": [],\n      \"personal_best\": \"\"\n      },\n      \"id\": \"12\",\n      \"name\": \"Pushups\",\n      \"description\": \"Perform the most popular exercise of all time with real strength.\",\n      \"category\": \"2\",\n      \"type\": \"1\",\n      \"muscle_groups\": \"1,2,3\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \"  \\\"1. Lie on the floor face down and place your hands in a standard pushup position.\\r\\n 2. Next, lower yourself downward until your chest almost touches the floor as you inhale.\\r\\n 3. Exhale and press your upper body back up to the starting position while squeezing your chest.\\r\\n 4. Repeat, after a brief pause at the top contracted position.\\\"\\r\\n  \",\n      \"video_tips\": \"    \",\n      \"pro_tips\": \"  Do them extra slow and hold it in highest and lowest position to get strength.\\r\\n  \",\n      \"musclegroup_string\": \"Shoulders, Chest, Triceps\",\n      \"video\": [\n      {\n      \"id\": \"57\",\n      \"path\": \"12_1453984139.mp4\",\n      \"videothumbnail\": \"12_1453984139.jpg\",\n      \"description\": \"Pushups\"\n      }\n      ]\n      },\n      \"urls\": {\n      \"profileImageSmall\": \"http://sandbox.ykings.com/uploads/images/profile/small\",\n      \"profileImageMedium\": \"http://sandbox.ykings.com/uploads/images/profile/medium\",\n      \"profileImageLarge\": \"http://sandbox.ykings.com/uploads/images/profile/large\",\n      \"profileImageOriginal\": \"http://sandbox.ykings.com/uploads/images/profile/original\",\n      \"video\": \"http://sandbox.ykings.com/uploads/videos\",\n      \"videothumbnail\": \"http://sandbox.ykings.com/uploads/images/videothumbnails\",\n      \"feedImageSmall\": \"http://sandbox.ykings.com/uploads/images/feed/small\",\n      \"feedImageMedium\": \"http://sandbox.ykings.com/uploads/images/feed/medium\",\n      \"feedImageLarge\": \"http://sandbox.ykings.com/uploads/images/feed/large\",\n      \"feedImageOriginal\": \"http://sandbox.ykings.com/uploads/images/feed/original\",\n      \"coverImageSmall\": \"http://sandbox.ykings.com/uploads/images/cover_image/small\",\n      \"coverImageMedium\": \"http://sandbox.ykings.com/uploads/images/cover_image/medium\",\n      \"coverImageLarge\": \"http://sandbox.ykings.com/uploads/images/cover_image/large\",\n      \"coverImageOriginal\": \"http://sandbox.ykings.com/uploads/images/cover_image/original\"\n      }\n      }",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "error",
            "description": "<p>Message token_invalid.</p> "
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 400 Invalid Request\n{\n  \"status\":\"0\",\n  \"error\": \"token_invalid\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 401 Unauthorised\n{\n  \"status\":\"0\",\n  \"error\": \"token_expired\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 400 Bad Request\n{\n  \"status\":\"0\",\n  \"error\": \"token_not_provided\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 422 Validation error\n{\n  \"status\" : 0,\n  \"error\": \"The exercise_id field is required\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 422 Validation error\n{\n  \"status\" : 0,\n  \"error\": \"The user_id field is required\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 500 exercise_not_exists\n{\n  \"status\" : 0,\n  \"error\": \"exercise_not_exists\"\n}",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "app/Http/Controllers/Api/ExercisesController.php",
    "groupTitle": "Exercise"
  },
  {
    "type": "post",
    "url": "/exercise/list",
    "title": "loadExercises",
    "name": "loadExercises",
    "group": "Exercise",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "<p>Number</p> ",
            "optional": false,
            "field": "user_id",
            "description": "<p>Id of user *required</p> "
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "<p>String</p> ",
            "optional": false,
            "field": "success.",
            "description": ""
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n{\n      \"status\": 1,\n      \"is_subscribed\" : 1,\n      \"exercises\": {\n      \"lean\": {\n      \"free\": [\n      {\n      \"id\": \"1\",\n      \"name\": \"Jumping Pullups\",\n      \"description\": \"The jumping pull-up is a challenging full body exercise that targets the back, legs and arms.\",\n      \"category\": \"1\",\n      \"type\": \"1\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"1.00\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"created_at\": \"2015-11-17 08:00:19\",\n      \"updated_at\": \"2015-11-20 04:20:50\",\n      \"video\": [\n      {\n      \"id\": \"1\",\n      \"user_id\": \"1\",\n      \"path\": \"Now1.mp4\",\n      \"videothumbnail\": \"\",\n      \"description\": \"Test Description\",\n      \"parent_type\": \"1\",\n      \"type\": \"1\",\n      \"parent_id\": \"1\",\n      \"created_at\": \"2015-11-11 01:56:40\",\n      \"updated_at\": \"2015-11-11 12:13:27\"\n      }\n      ]\n      }\n      ],\n      \"paid\": [\n      {\n      \"id\": \"2\",\n      \"name\": \"Australian Pullups\",\n      \"description\": \"Australian pull-ups are becoming a very popular exercise. Like all types of pull-ups (and all types of exercises for that matter) there are many different ways to do the Australian, and it can be incorporated into a number of different contexts within a workout.\",\n      \"category\": \"1\",\n      \"type\": \"2\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"1.00\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"created_at\": \"2015-11-17 08:00:20\",\n      \"updated_at\": \"2015-11-20 04:20:01\",\n      \"video\": []\n      }\n      ]\n      },\n      \"athletic\": {\n      \"free\": [\n      {\n      \"id\": \"32\",\n      \"name\": \"Pull ups / Chin ups\",\n      \"description\": \"\",\n      \"category\": \"2\",\n      \"type\": \"1\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"1.00\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"created_at\": \"2015-11-17 08:01:02\",\n      \"updated_at\": \"2015-11-20 04:21:42\",\n      \"video\": []\n      }\n      ],\n      \"paid\": [\n      {\n      \"id\": \"33\",\n      \"name\": \"One Leg Front Lever\",\n      \"description\": \"\",\n      \"category\": \"2\",\n      \"type\": \"2\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"1.00\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"created_at\": \"2015-11-17 08:01:02\",\n      \"updated_at\": \"2015-11-20 04:20:01\",\n      \"video\": []\n      }\n      ]\n      },\n      \"strength\": {\n      \"free\": [\n      {\n      \"id\": \"69\",\n      \"name\": \"Muscleups\",\n      \"description\": \"\",\n      \"category\": \"3\",\n      \"type\": \"1\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"1.00\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"created_at\": \"2015-11-17 08:03:53\",\n      \"updated_at\": \"2015-11-20 04:22:21\",\n      \"video\": []\n      }\n      ],\n      \"paid\": [\n      {\n      \"id\": \"77\",\n      \"name\": \"Front Lever\",\n      \"description\": \"\",\n      \"category\": \"3\",\n      \"type\": \"2\",\n      \"rewards\": \"10.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"1.00\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"created_at\": \"2015-11-17 08:10:32\",\n      \"updated_at\": \"2015-11-17 08:10:32\",\n      \"video\": []\n      }\n      ]\n      }\n      },\n      \"urls\": {\n      \"profileImageSmall\": \"http://sandbox.ykings.com/uploads/images/profile/small\",\n      \"profileImageMedium\": \"http://sandbox.ykings.com/uploads/images/profile/medium\",\n      \"profileImageLarge\": \"http://sandbox.ykings.com/uploads/images/profile/large\",\n      \"profileImageOriginal\": \"http://sandbox.ykings.com/uploads/images/profile/original\",\n      \"video\": \"http://sandbox.ykings.com/uploads/videos\",\n      \"videothumbnail\": \"http://sandbox.ykings.com/uploads/images/videothumbnails\",\n      \"feedImageSmall\": \"http://sandbox.ykings.com/uploads/images/feed/small\",\n      \"feedImageMedium\": \"http://sandbox.ykings.com/uploads/images/feed/medium\",\n      \"feedImageLarge\": \"http://sandbox.ykings.com/uploads/images/feed/large\",\n      \"feedImageOriginal\": \"http://sandbox.ykings.com/uploads/images/feed/original\",\n      \"coverImageSmall\": \"http://sandbox.ykings.com/uploads/images/cover_image/small\",\n      \"coverImageMedium\": \"http://sandbox.ykings.com/uploads/images/cover_image/medium\",\n      \"coverImageLarge\": \"http://sandbox.ykings.com/uploads/images/cover_image/large\",\n      \"coverImageOriginal\": \"http://sandbox.ykings.com/uploads/images/cover_image/original\"\n      }\n      }",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "error",
            "description": "<p>Message token_invalid.</p> "
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 400 Invalid Request\n{\n  \"status\":\"0\",\n  \"error\": \"token_invalid\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 401 Unauthorised\n{\n  \"status\":\"0\",\n  \"error\": \"token_expired\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 400 Bad Request\n{\n  \"status\":\"0\",\n  \"error\": \"token_not_provided\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 422 Validation error\n{\n  \"status\" : 0,\n  \"error\": \"The user_id field is required\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 500 user_not_exists\n{\n  \"status\" : 0,\n  \"error\": \"user_not_exists\"\n}",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "app/Http/Controllers/Api/ExercisesController.php",
    "groupTitle": "Exercise"
  },
  {
    "type": "post",
    "url": "/feeds/create",
    "title": "CreateFeed",
    "name": "CreateFeed",
    "group": "Feeds",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "<p>Number</p> ",
            "optional": false,
            "field": "user_id",
            "description": "<p>Id of user *required</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>String</p> ",
            "optional": false,
            "field": "item_type",
            "description": "<p>'exercise','workout','motivation','announcement', 'hiit', 'freestyle', 'test', 'hiit_replacement','fundamental' *required</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>Number</p> ",
            "optional": false,
            "field": "item_id",
            "description": "<p>id of the targetting item (0 incase of freestyle) *required</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>Number</p> ",
            "optional": true,
            "field": "time_taken",
            "description": "<p>time in seconds (for 'exercise','workout', 'hiit', and 'freestyle'</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>Number</p> ",
            "optional": true,
            "field": "rewards",
            "description": "<p>points earned by doing activity</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>Number</p> ",
            "optional": true,
            "field": "category",
            "description": "<p>in case of workout completion 1-Strength, 2-HIIT Strength</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>Number</p> ",
            "optional": true,
            "field": "focus",
            "description": "<p>in case of workout completion 1-Lean, 2-Athletic 3-Strength</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>String</p> ",
            "optional": false,
            "field": "text",
            "description": "<p>*required</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>file</p> ",
            "optional": true,
            "field": "image",
            "description": ""
          },
          {
            "group": "Parameter",
            "type": "<p>String</p> ",
            "optional": true,
            "field": "starred",
            "description": "<p>0/1</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>Number</p> ",
            "optional": true,
            "field": "volume",
            "description": "<p>volume of exercise/workout/hiit</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>Number</p> ",
            "optional": true,
            "field": "is_coach",
            "description": "<p>1 in case if coach workouts/exercises/hiits</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>Number</p> ",
            "optional": true,
            "field": "coach_rounds",
            "description": "<p>number of workout rounds (&quot;coach_workout_rounds&quot; field from day workout)</p> "
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "<p>String</p> ",
            "optional": false,
            "field": "success.",
            "description": ""
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n {\n      \"status\": 1,\n      \"success\": \"feed_created_successfully\"\n      }",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "error",
            "description": "<p>Message token_invalid.</p> "
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 400 Invalid Request\n{\n  \"status\" : 0,\n  \"error\": \"token_invalid\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 401 Unauthorised\n{\n  \"status\" : 0,\n  \"error\": \"token_expired\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 400 Bad Request\n{\n  \"status\" : 0,\n  \"error\": \"token_not_provided\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 422 Validation error\n{\n  \"status\" : 0,\n  \"error\": \"The user_id field is required\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 422 Validation error\n{\n  \"status\" : 0,\n  \"error\": \"The item_type field is required\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 422 Validation error\n{\n  \"status\" : 0,\n  \"error\": \"The item_id field is required\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 422 Validation error\n{\n  \"status\" : 0,\n  \"error\": \"The text field is required\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 500 user_does_not_exists\n{\n  \"status\" : 0,\n  \"error\": \"user_does_not_exists\"\n}",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "app/Http/Controllers/Api/FeedController.php",
    "groupTitle": "Feeds"
  },
  {
    "type": "post",
    "url": "/feeds/list",
    "title": "ListFeeds",
    "name": "ListFeeds",
    "group": "Feeds",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "<p>Number</p> ",
            "optional": false,
            "field": "user_id",
            "description": "<p>Id of user *required</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>Number</p> ",
            "optional": true,
            "field": "offset",
            "description": "<p>offset</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>Number</p> ",
            "optional": true,
            "field": "limit",
            "description": "<p>limit</p> "
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "<p>String</p> ",
            "optional": false,
            "field": "success.",
            "description": ""
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n{\n      \"status\": 1,\n      \"success\": \"List\",\n      \"feed_list\": [\n      {\n      \"id\": \"1386\",\n      \"user_id\": \"17\",\n      \"item_type\": \"workout\",\n      \"item_id\": \"9\",\n      \"feed_text\": \"Hi\",\n      \"image\": [],\n      \"created_at\": \"2016-06-13 13:17:46\",\n      \"updated_at\": \"2016-06-13 13:17:46\",\n      \"clap_count\": 0,\n      \"comment_count\": 2,\n      \"is_commented\": 1,\n      \"is_claped\": 0,\n      \"category\": \"HIIT-strength\",\n      \"item_name\": \"Elli\",\n      \"duration\": \"8\",\n      \"workout_rounds\": \"3\",\n      \"intensity\": \"1\",\n      \"focus\": \"Athletic\",\n      \"profile\": {\n      \"user_id\": \"17\",\n      \"first_name\": \"Vinish\",\n      \"last_name\": \"P\",\n      \"image\": \"17_1457639358.jpg\",\n      \"quote\": \"you\",\n      \"gender\": \"0\",\n      \"level\": 28\n      }\n      },\n      {\n      \"id\": \"1385\",\n      \"user_id\": \"17\",\n      \"item_type\": \"workout\",\n      \"item_id\": \"9\",\n      \"feed_text\": \"Tester\",\n      \"image\": [],\n      \"created_at\": \"2016-06-13 13:15:23\",\n      \"updated_at\": \"2016-06-13 13:15:23\",\n      \"clap_count\": 1,\n      \"comment_count\": 0,\n      \"is_commented\": 0,\n      \"is_claped\": 0,\n      \"category\": \"HIIT-strength\",\n      \"item_name\": \"Elli\",\n      \"duration\": \"2\",\n      \"workout_rounds\": \"3\",\n      \"intensity\": \"1\",\n      \"focus\": \"Athletic\",\n      \"profile\": {\n      \"user_id\": \"17\",\n      \"first_name\": \"Vinish\",\n      \"last_name\": \"P\",\n      \"image\": \"17_1457639358.jpg\",\n      \"quote\": \"you\",\n      \"gender\": \"0\",\n      \"level\": 28\n      }\n      },\n      {\n      \"id\": \"1384\",\n      \"user_id\": \"17\",\n      \"item_type\": \"freestyle\",\n      \"item_id\": \"0\",\n      \"feed_text\": \"freestyle\",\n      \"image\": [],\n      \"created_at\": \"2016-06-13 11:22:00\",\n      \"updated_at\": \"2016-06-13 11:22:00\",\n      \"clap_count\": 0,\n      \"comment_count\": 0,\n      \"is_commented\": 0,\n      \"is_claped\": 0,\n      \"item_name\": \"Freestyle\",\n      \"duration\": \"216.00\",\n      \"intensity\": \"4\",\n      \"profile\": {\n      \"user_id\": \"17\",\n      \"first_name\": \"Vinish\",\n      \"last_name\": \"P\",\n      \"image\": \"17_1457639358.jpg\",\n      \"quote\": \"you\",\n      \"gender\": \"0\",\n      \"level\": 28\n      }\n      },\n      {\n      \"id\": \"1383\",\n      \"user_id\": \"17\",\n      \"item_type\": \"hiit_replacement\",\n      \"item_id\": \"2\",\n      \"feed_text\": \"test\\\\uD83D\\\\uDE02\",\n      \"image\": [],\n      \"created_at\": \"2016-06-13 11:05:46\",\n      \"updated_at\": \"2016-06-13 11:05:46\",\n      \"clap_count\": 0,\n      \"comment_count\": 0,\n      \"is_commented\": 0,\n      \"is_claped\": 0,\n      \"item_name\": \"20/10(Replacement)\",\n      \"duration\": \"44.00\",\n      \"intensity\": \"0\",\n      \"profile\": {\n      \"user_id\": \"17\",\n      \"first_name\": \"Vinish\",\n      \"last_name\": \"P\",\n      \"image\": \"17_1457639358.jpg\",\n      \"quote\": \"you\",\n      \"gender\": \"0\",\n      \"level\": 28\n      }\n      },\n      {\n      \"id\": \"1382\",\n      \"user_id\": \"17\",\n      \"item_type\": \"workout\",\n      \"item_id\": \"1\",\n      \"feed_text\": \"testing2\",\n      \"image\": [\n      {\n      \"id\": \"78\",\n      \"user_id\": \"17\",\n      \"path\": \"feed_1382_1465815822.jpg\",\n      \"description\": \"testing2\",\n      \"parent_type\": \"2\",\n      \"parent_id\": \"1382\",\n      \"created_at\": \"2016-06-13 11:03:42\",\n      \"updated_at\": \"2016-06-13 11:03:42\"\n      }\n      ],\n      \"created_at\": \"2016-06-13 11:03:42\",\n      \"updated_at\": \"2016-06-13 11:03:42\",\n      \"clap_count\": 1,\n      \"comment_count\": 0,\n      \"is_commented\": 0,\n      \"is_claped\": 0,\n      \"category\": \"Strength\",\n      \"item_name\": \"Baldur\",\n      \"duration\": \"9\",\n      \"workout_rounds\": \"5\",\n      \"is_coach\": 1,\n      \"coach_workout_rounds\": \"3\",\n      \"focus\": \"Lean\",\n      \"profile\": {\n      \"user_id\": \"17\",\n      \"first_name\": \"Vinish\",\n      \"last_name\": \"P\",\n      \"image\": \"17_1457639358.jpg\",\n      \"quote\": \"you\",\n      \"gender\": \"0\",\n      \"level\": 28\n      }\n      },\n      {\n      \"id\": \"1381\",\n      \"user_id\": \"17\",\n      \"item_type\": \"workout\",\n      \"item_id\": \"2\",\n      \"feed_text\": \"testing1\",\n      \"image\": [\n      {\n      \"id\": \"77\",\n      \"user_id\": \"17\",\n      \"path\": \"feed_1381_1465815305.jpg\",\n      \"description\": \"testing1\",\n      \"parent_type\": \"2\",\n      \"parent_id\": \"1381\",\n      \"created_at\": \"2016-06-13 10:55:05\",\n      \"updated_at\": \"2016-06-13 10:55:05\"\n      }\n      ],\n      \"created_at\": \"2016-06-13 10:55:05\",\n      \"updated_at\": \"2016-06-13 10:55:05\",\n      \"clap_count\": 0,\n      \"comment_count\": 0,\n      \"is_commented\": 0,\n      \"is_claped\": 0,\n      \"category\": \"HIIT-strength\",\n      \"item_name\": \"Borr\",\n      \"duration\": \"7\",\n      \"workout_rounds\": \"3\",\n      \"is_coach\": 1,\n      \"coach_workout_rounds\": \"3\",\n      \"intensity\": 1,\n      \"focus\": \"Lean\",\n      \"profile\": {\n      \"user_id\": \"17\",\n      \"first_name\": \"Vinish\",\n      \"last_name\": \"P\",\n      \"image\": \"17_1457639358.jpg\",\n      \"quote\": \"you\",\n      \"gender\": \"0\",\n      \"level\": 28\n      }\n      },\n      {\n      \"id\": \"1380\",\n      \"user_id\": \"17\",\n      \"item_type\": \"workout\",\n      \"item_id\": \"3\",\n      \"feed_text\": \"testing\",\n      \"image\": [],\n      \"created_at\": \"2016-06-13 10:53:15\",\n      \"updated_at\": \"2016-06-13 10:53:15\",\n      \"clap_count\": 0,\n      \"comment_count\": 0,\n      \"is_commented\": 0,\n      \"is_claped\": 0,\n      \"category\": \"HIIT-strength\",\n      \"item_name\": \"Bragi\",\n      \"duration\": \"4\",\n      \"workout_rounds\": \"5\",\n      \"is_coach\": 1,\n      \"coach_workout_rounds\": \"3\",\n      \"focus\": \"Lean\",\n      \"profile\": {\n      \"user_id\": \"17\",\n      \"first_name\": \"Vinish\",\n      \"last_name\": \"P\",\n      \"image\": \"17_1457639358.jpg\",\n      \"quote\": \"you\",\n      \"gender\": \"0\",\n      \"level\": 28\n      }\n      },\n      {\n      \"id\": \"1366\",\n      \"user_id\": \"17\",\n      \"item_type\": \"workout\",\n      \"item_id\": \"2\",\n      \"feed_text\": \"Haiiiii\",\n      \"image\": [],\n      \"created_at\": \"2016-06-09 10:34:46\",\n      \"updated_at\": \"2016-06-09 10:34:46\",\n      \"clap_count\": 0,\n      \"comment_count\": 0,\n      \"is_commented\": 0,\n      \"is_claped\": 0,\n      \"category\": \"HIIT-strength\",\n      \"item_name\": \"Borr\",\n      \"duration\": \"4\",\n      \"workout_rounds\": \"3\",\n      \"is_coach\": 1,\n      \"coach_workout_rounds\": \"3\",\n      \"intensity\": 1,\n      \"focus\": \"Lean\",\n      \"profile\": {\n      \"user_id\": \"17\",\n      \"first_name\": \"Vinish\",\n      \"last_name\": \"P\",\n      \"image\": \"17_1457639358.jpg\",\n      \"quote\": \"you\",\n      \"gender\": \"0\",\n      \"level\": 28\n      }\n      },\n      {\n      \"id\": \"1364\",\n      \"user_id\": \"1\",\n      \"item_type\": \"knowledge\",\n      \"item_id\": \"0\",\n      \"feed_text\": \"This is a test message.\\nAgain test for line feed.\\n\\nSecond with double line feed.\",\n      \"image\": [\n      {\n      \"id\": \"76\",\n      \"user_id\": \"1\",\n      \"path\": \"feed_1364_1464871380.jpg\",\n      \"description\": \"This is a test message.\\nAgain test for line feed.\\n\\nSecond with double line feed.\",\n      \"parent_type\": \"2\",\n      \"parent_id\": \"1364\",\n      \"created_at\": \"2016-06-02 12:43:00\",\n      \"updated_at\": \"2016-06-02 12:43:00\"\n      }\n      ],\n      \"created_at\": \"2016-06-02 12:42:59\",\n      \"updated_at\": \"2016-06-02 12:43:47\",\n      \"clap_count\": 0,\n      \"comment_count\": 0,\n      \"is_commented\": 0,\n      \"is_claped\": 0,\n      \"category\": \"\",\n      \"item_name\": \"Knowledge\",\n      \"profile\": {\n      \"user_id\": \"1\",\n      \"first_name\": \"Team\",\n      \"last_name\": \"Ykings\",\n      \"image\": \"1_1463145040.jpg\",\n      \"quote\": \"\",\n      \"gender\": \"0\",\n      \"level\": 3\n      }\n      },\n      {\n      \"id\": \"1363\",\n      \"user_id\": \"67\",\n      \"item_type\": \"exercise\",\n      \"item_id\": \"8\",\n      \"feed_text\": \"Community Workout in Augsburg. Our first YKMS in the books. Thanks everyone for the support. Next YKMS coming soon. #StriveForProgress\\n\\t\\\\\\\\n\\n\\t\\\\\\\\nCommunity Workout in Augsburg. Unsere erste YKMS ist geschafft. Danke an alle Beteiligten. Auf ein Neues in K\\\\\\\\U00fcrze.  #StriveForProgress\",\n      \"image\": [],\n      \"created_at\": \"2016-05-30 10:10:00\",\n      \"updated_at\": \"2016-05-30 10:10:00\",\n      \"clap_count\": 0,\n      \"comment_count\": 0,\n      \"is_commented\": 0,\n      \"is_claped\": 0,\n      \"category\": \"Athletic\",\n      \"item_name\": \"Bicycle\",\n      \"duration\": \"10\",\n      \"intensity\": \"7\",\n      \"unit\": \"times\",\n      \"is_static\": \"0\",\n      \"profile\": {\n      \"user_id\": \"67\",\n      \"first_name\": \"Aneesh\",\n      \"last_name\": \"iLeaf\",\n      \"image\": \"67_1460107183.jpg\",\n      \"quote\": \"åäÀáâæ?ã\",\n      \"gender\": \"2\",\n      \"level\": 43\n      }\n      }\n      ],\n      \"unread_notification_count\": 6,\n      \"urls\": {\n      \"profileImageSmall\": \"http://testing.ykings.com/uploads/images/profile/small\",\n      \"profileImageMedium\": \"http://testing.ykings.com/uploads/images/profile/medium\",\n      \"profileImageLarge\": \"http://testing.ykings.com/uploads/images/profile/large\",\n      \"profileImageOriginal\": \"http://testing.ykings.com/uploads/images/profile/original\",\n      \"video\": \"http://testing.ykings.com/uploads/videos\",\n      \"videothumbnail\": \"http://testing.ykings.com/uploads/images/videothumbnails\",\n      \"feedImageSmall\": \"http://testing.ykings.com/uploads/images/feed/small\",\n      \"feedImageMedium\": \"http://testing.ykings.com/uploads/images/feed/medium\",\n      \"feedImageLarge\": \"http://testing.ykings.com/uploads/images/feed/large\",\n      \"feedImageOriginal\": \"http://testing.ykings.com/uploads/images/feed/original\",\n      \"coverImageSmall\": \"http://testing.ykings.com/uploads/images/cover_image/small\",\n      \"coverImageMedium\": \"http://testing.ykings.com/uploads/images/cover_image/medium\",\n      \"coverImageLarge\": \"http://testing.ykings.com/uploads/images/cover_image/large\",\n      \"coverImageOriginal\": \"http://testing.ykings.com/uploads/images/cover_image/original\"\n      }\n      }",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "error",
            "description": "<p>Message token_invalid.</p> "
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "user_not_exists",
            "description": "<p>User error.</p> "
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 400 Invalid Request\n{\n  \"status\":\"0\",\n  \"error\": \"token_invalid\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 401 Unauthorised\n{\n  \"status\":\"0\",\n  \"error\": \"token_expired\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 400 Bad Request\n{\n  \"status\":\"0\",\n  \"error\": \"token_not_provided\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 400 Bad Request\n{\n  \"status\":\"0\",\n  \"error\": \"user_not_exists\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 422 Validation error\n{\n  \"status\" : 0,\n  \"error\": \"The user_id field is required\"\n}",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "app/Http/Controllers/Api/FeedController.php",
    "groupTitle": "Feeds"
  },
  {
    "type": "post",
    "url": "/user/feedlist",
    "title": "UserFeeds",
    "name": "UserFeeds",
    "group": "Feeds",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "<p>integer</p> ",
            "optional": false,
            "field": "user_id",
            "description": "<p>id of loggedin user *required</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>integer</p> ",
            "optional": false,
            "field": "profile_id",
            "description": "<p>id of other user *required</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>Number</p> ",
            "optional": true,
            "field": "offset",
            "description": "<p>offset</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>Number</p> ",
            "optional": true,
            "field": "limit",
            "description": "<p>limit</p> "
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "<p>String</p> ",
            "optional": false,
            "field": "success.",
            "description": ""
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "    HTTP/1.1 200 OK\n{\n      \"status\": 1,\n      \"success\": \"List\",\n      \"follower_count\": 2,\n      \"level_count\": 0,\n      \"workout_count\": 15,\n      \"feed_list\": [\n      {\n      \"id\": 703,\n      \"user_id\": 48,\n      \"item_type\": \"hiit_replacement\",\n      \"item_id\": 3,\n      \"feed_text\": \"Testing HIIT replacements\",\n      \"image\": [],\n      \"created_at\": \"2016-02-23 13:20:00\",\n      \"updated_at\": \"2016-02-23 13:20:00\",\n      \"clap_count\": 0,\n      \"comment_count\": 0,\n      \"is_commented\": 0,\n      \"is_claped\": 0,\n      \"item_name\": \"60/120(Replacement)\",\n      \"duration\": 320,\n      \"intensity\": 4,\n      \"profile\": {\n      \"user_id\": 48,\n      \"first_name\": \"Aneesh\",\n      \"last_name\": \"Kallikkattil\",\n      \"image\": \"\",\n      \"quote\": \"\",\n      \"gender\": 1,\n      \"level\": 2\n      }\n      },\n      {\n      \"id\": \"45\",\n      \"user_id\": \"96\",\n      \"item_type\": \"hiit\",\n      \"item_id\": \"1\",\n      \"feed_text\": \"Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Integer pulvinar suscipit ante vitae ultricies.\",\n      \"created_at\": \"2016-01-08 06:04:32\",\n      \"updated_at\": \"2016-01-08 06:04:32\",\n      \"clap_count\": 0,\n      \"comment_count\": 0,\n      \"is_commented\": 0,\n      \"is_claped\": 0,\n      \"image\": [\n      {\n      \"id\": \"68\",\n      \"user_id\": \"96\",\n      \"path\": \"96_1452233072.jpg\",\n      \"description\": \"Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Integer pulvinar suscipit ante vitae ultricies.\",\n      \"parent_type\": \"2\",\n      \"parent_id\": \"45\",\n      \"created_at\": \"2016-01-08 06:04:32\",\n      \"updated_at\": \"2016-01-08 06:04:32\"\n      }\n      ],\n      \"item_name\": \"30/30\",\n      \"duration\": \"2250.00\",\n      \"intensity\": \"10\"\n      },\n      {\n      \"id\": \"44\",\n      \"user_id\": \"96\",\n      \"item_type\": \"hiit\",\n      \"item_id\": \"3\",\n      \"feed_text\": \"Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Integer pulvinar suscipit ante vitae ultricies.\",\n      \"created_at\": \"2016-01-08 06:03:48\",\n      \"updated_at\": \"2016-01-08 06:03:48\",\n      \"clap_count\": 0,\n      \"comment_count\": 0,\n      \"is_commented\": 0,\n      \"is_claped\": 0,\n      \"image\": [],\n      \"item_name\": \"60/120\",\n      \"duration\": \"1500.00\",\n      \"intensity\": \"5\"\n      },\n      {\n      \"id\": \"43\",\n      \"user_id\": \"96\",\n      \"item_type\": \"hiit\",\n      \"item_id\": \"3\",\n      \"feed_text\": \"Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Integer pulvinar suscipit ante vitae ultricies.\",\n      \"created_at\": \"2016-01-08 06:03:44\",\n      \"updated_at\": \"2016-01-08 06:03:44\",\n      \"clap_count\": 0,\n      \"comment_count\": 0,\n      \"is_commented\": 0,\n      \"is_claped\": 0,\n      \"image\": [],\n      \"item_name\": \"60/120\",\n      \"duration\": \"1500.00\",\n      \"intensity\": \"4\"\n      },\n      {\n      \"id\": \"42\",\n      \"user_id\": \"96\",\n      \"item_type\": \"hiit\",\n      \"item_id\": \"3\",\n      \"feed_text\": \"Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Integer pulvinar suscipit ante vitae ultricies.\",\n      \"created_at\": \"2016-01-08 06:03:37\",\n      \"updated_at\": \"2016-01-08 06:03:37\",\n      \"clap_count\": 0,\n      \"comment_count\": 0,\n      \"is_commented\": 0,\n      \"is_claped\": 0,\n      \"image\": [],\n      \"item_name\": \"60/120\",\n      \"duration\": \"1500.00\",\n      \"intensity\": \"3\"\n      },\n      {\n      \"id\": \"41\",\n      \"user_id\": \"96\",\n      \"item_type\": \"hiit\",\n      \"item_id\": \"2\",\n      \"feed_text\": \"Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Integer pulvinar suscipit ante vitae ultricies.\",\n      \"created_at\": \"2016-01-08 06:03:27\",\n      \"updated_at\": \"2016-01-08 06:03:27\",\n      \"clap_count\": 0,\n      \"comment_count\": 0,\n      \"is_commented\": 0,\n      \"is_claped\": 0,\n      \"image\": [],\n      \"item_name\": \"20/10\",\n      \"duration\": \"1500.00\",\n      \"intensity\": \"8\"\n      },\n      {\n      \"id\": \"40\",\n      \"user_id\": \"96\",\n      \"item_type\": \"hiit\",\n      \"item_id\": \"2\",\n      \"feed_text\": \"Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Integer pulvinar suscipit ante vitae ultricies.\",\n      \"created_at\": \"2016-01-08 06:03:17\",\n      \"updated_at\": \"2016-01-08 06:03:17\",\n      \"clap_count\": 1,\n      \"comment_count\": 0,\n      \"is_commented\": 0,\n      \"is_claped\": 1,\n      \"image\": [],\n      \"item_name\": \"20/10\",\n      \"duration\": \"1500.00\",\n      \"intensity\": \"5\"\n      },\n      {\n      \"id\": \"39\",\n      \"user_id\": \"96\",\n      \"item_type\": \"hiit\",\n      \"item_id\": \"2\",\n      \"feed_text\": \"Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Integer pulvinar suscipit ante vitae ultricies.\",\n      \"created_at\": \"2016-01-08 06:03:10\",\n      \"updated_at\": \"2016-01-08 06:03:10\",\n      \"clap_count\": 2,\n      \"comment_count\": 0,\n      \"is_commented\": 0,\n      \"is_claped\": 1,\n      \"image\": [],\n      \"item_name\": \"20/10\",\n      \"duration\": \"1500.00\",\n      \"intensity\": \"7\"\n      },\n      {\n      \"id\": \"38\",\n      \"user_id\": \"96\",\n      \"item_type\": \"hiit\",\n      \"item_id\": \"1\",\n      \"feed_text\": \"Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Integer pulvinar suscipit ante vitae ultricies.\",\n      \"created_at\": \"2016-01-08 06:02:50\",\n      \"updated_at\": \"2016-01-08 06:02:50\",\n      \"clap_count\": 0,\n      \"comment_count\": 0,\n      \"is_commented\": 0,\n      \"is_claped\": 0,\n      \"image\": [],\n      \"item_name\": \"30/30\",\n      \"duration\": \"1500.00\",\n      \"intensity\": \"4\"\n      },\n      {\n      \"id\": \"37\",\n      \"user_id\": \"96\",\n      \"item_type\": \"workout\",\n      \"item_id\": \"15\",\n      \"feed_text\": \"Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Integer pulvinar suscipit ante vitae ultricies.\",\n      \"created_at\": \"2016-01-08 05:49:36\",\n      \"updated_at\": \"2016-01-08 05:49:36\",\n      \"clap_count\": 0,\n      \"comment_count\": 0,\n      \"is_commented\": 0,\n      \"is_claped\": 0,\n      \"image\": [\n      {\n      \"id\": \"67\",\n      \"user_id\": \"96\",\n      \"path\": \"96_1452232176.jpg\",\n      \"description\": \"Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Integer pulvinar suscipit ante vitae ultricies.\",\n      \"parent_type\": \"2\",\n      \"parent_id\": \"37\",\n      \"created_at\": \"2016-01-08 05:49:36\",\n      \"updated_at\": \"2016-01-08 05:49:36\"\n      }\n      ],\n      \"category\": \"HIIT-strength\",\n      \"item_name\": \"Mimir\",\n      \"duration\": \"1500\",\n      \"intensity\": \"2\"\n      },\n      {\n      \"id\": \"36\",\n      \"user_id\": \"96\",\n      \"item_type\": \"workout\",\n      \"item_id\": \"9\",\n      \"feed_text\": \"Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Integer pulvinar suscipit ante vitae ultricies.\",\n      \"created_at\": \"2016-01-08 05:49:27\",\n      \"updated_at\": \"2016-01-08 05:49:27\",\n      \"clap_count\": 0,\n      \"comment_count\": 0,\n      \"is_commented\": 0,\n      \"is_claped\": 0,\n      \"image\": [\n      {\n      \"id\": \"66\",\n      \"user_id\": \"96\",\n      \"path\": \"96_1452232167.jpg\",\n      \"description\": \"Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Integer pulvinar suscipit ante vitae ultricies.\",\n      \"parent_type\": \"2\",\n      \"parent_id\": \"36\",\n      \"created_at\": \"2016-01-08 05:49:27\",\n      \"updated_at\": \"2016-01-08 05:49:27\"\n      }\n      ],\n      \"category\": \"HIIT-strength\",\n      \"item_name\": \"Elli\",\n      \"duration\": \"1500\",\n      \"intensity\": \"2\"\n      }\n      ],\n      \"urls\": {\n      \"profileImageSmall\": \"http://sandbox.ykings.com/uploads/images/profile/small\",\n      \"profileImageMedium\": \"http://sandbox.ykings.com/uploads/images/profile/medium\",\n      \"profileImageLarge\": \"http://sandbox.ykings.com/uploads/images/profile/large\",\n      \"profileImageOriginal\": \"http://sandbox.ykings.com/uploads/images/profile/original\",\n      \"video\": \"http://sandbox.ykings.com/uploads/videos\",\n      \"videothumbnail\": \"http://sandbox.ykings.com/uploads/images/videothumbnails\",\n      \"feedImageSmall\": \"http://sandbox.ykings.com/uploads/images/feed/small\",\n      \"feedImageMedium\": \"http://sandbox.ykings.com/uploads/images/feed/medium\",\n      \"feedImageLarge\": \"http://sandbox.ykings.com/uploads/images/feed/large\",\n      \"feedImageOriginal\": \"http://sandbox.ykings.com/uploads/images/feed/original\",\n      \"coverImageSmall\": \"http://sandbox.ykings.com/uploads/images/cover_image/small\",\n      \"coverImageMedium\": \"http://sandbox.ykings.com/uploads/images/cover_image/medium\",\n      \"coverImageLarge\": \"http://sandbox.ykings.com/uploads/images/cover_image/large\",\n      \"coverImageOriginal\": \"http://sandbox.ykings.com/uploads/images/cover_image/original\"\n      }\n      }",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "error",
            "description": "<p>Message token_invalid.</p> "
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "user_not_exists",
            "description": "<p>User error.</p> "
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 400 Invalid Request\n{\n  \"status\":\"0\",\n  \"error\": \"token_invalid\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 401 Unauthorised\n{\n  \"status\":\"0\",\n  \"error\": \"token_expired\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 400 Bad Request\n{\n  \"status\":\"0\",\n  \"error\": \"token_not_provided\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 400 Bad Request\n{\n  \"status\":\"0\",\n  \"error\": \"user_not_exists\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 422 Validation error\n{\n  \"status\" : 0,\n  \"error\": \"The user_id field is required\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 422 Validation error\n{\n  \"status\" : 0,\n  \"error\": \"The profile_id field is required\"\n}",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "app/Http/Controllers/Api/FeedController.php",
    "groupTitle": "Feeds"
  },
  {
    "type": "post",
    "url": "/feeds/addComment",
    "title": "addFeedComment",
    "name": "addFeedComment",
    "group": "Feeds",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "<p>Number</p> ",
            "optional": false,
            "field": "user_id",
            "description": "<p>Id of user *required</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>String</p> ",
            "optional": false,
            "field": "feed_id",
            "description": "<p>of the targetting item *required</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>String</p> ",
            "optional": false,
            "field": "text",
            "description": "<p>*required</p> "
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "<p>String</p> ",
            "optional": false,
            "field": "success.",
            "description": ""
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n{\n      \"status\": 1,\n      \"success\": \"commented_on_feed_successfully\"\n\n      }",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "error",
            "description": "<p>Message token_invalid.</p> "
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 400 Invalid Request\n{\n  \"status\" : 0,\n  \"error\": \"token_invalid\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 401 Unauthorised\n{\n  \"status\" : 0,\n  \"error\": \"token_expired\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 400 Bad Request\n{\n  \"status\" : 0,\n  \"error\": \"token_not_provided\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 422 Validation error\n{\n  \"status\" : 0,\n  \"error\": \"The user_id field is required\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 422 Validation error\n{\n  \"status\" : 0,\n  \"error\": \"The feed_id field is required\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 422 Validation error\n{\n  \"status\" : 0,\n  \"error\": \"The text field is required\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 500 user_does_not_exists\n{\n  \"status\" : 0,\n  \"error\": \"user_does_not_exists\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 500 feed_does_not_exists\n{\n  \"status\" : 0,\n  \"error\": \"feed_does_not_exists\"\n}",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "app/Http/Controllers/Api/CommentsController.php",
    "groupTitle": "Feeds"
  },
  {
    "type": "post",
    "url": "/feeds/clap",
    "title": "clapFeed",
    "name": "clapFeed",
    "group": "Feeds",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "<p>Number</p> ",
            "optional": false,
            "field": "user_id",
            "description": "<p>Id of user *required</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>Number</p> ",
            "optional": false,
            "field": "feed_id",
            "description": "<p>feed_id *required</p> "
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "<p>String</p> ",
            "optional": false,
            "field": "success.",
            "description": ""
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n   {\n   \"status\": 1,\n   \"success\": \"clap added\"\n   }",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "error",
            "description": "<p>Message token_invalid.</p> "
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "user_not_exists",
            "description": "<p>User error.</p> "
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 400 Invalid Request\n{\n  \"status\":\"0\",\n  \"error\": \"token_invalid\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 401 Unauthorised\n{\n  \"status\":\"0\",\n  \"error\": \"token_expired\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 400 Bad Request\n{\n  \"status\":\"0\",\n  \"error\": \"token_not_provided\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 400 Bad Request\n{\n  \"status\":\"0\",\n  \"error\": \"feed_not_exists\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 422 Validation error\n{\n  \"status\" : 0,\n  \"error\": \"The user_id field is required\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 422 Validation error\n{\n  \"status\" : 0,\n  \"error\": \"The feed_id field is required\"\n}",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "app/Http/Controllers/Api/FeedController.php",
    "groupTitle": "Feeds"
  },
  {
    "type": "post",
    "url": "/feeds/deleteComment",
    "title": "deleteComment",
    "name": "deleteComment",
    "group": "Feeds",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "<p>Number</p> ",
            "optional": false,
            "field": "user_id",
            "description": "<p>Id of user *required</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>Number</p> ",
            "optional": false,
            "field": "comment_id",
            "description": "<p>feed_id *required</p> "
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "<p>String</p> ",
            "optional": false,
            "field": "success.",
            "description": ""
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK{\n     \"status\": 1,\n     \"message\" :comment deleted\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "error",
            "description": "<p>Message token_invalid.</p> "
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 400 Invalid Request\n{\n  \"status\":\"0\",\n  \"error\": \"token_invalid\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 401 Unauthorised\n{\n  \"status\":\"0\",\n  \"error\": \"token_expired\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 400 Bad Request\n{\n  \"status\":\"0\",\n  \"error\": \"token_not_provided\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 400 Bad Request\n{\n  \"status\":\"0\",\n  \"error\": \"comment_not_exists\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 422 Validation error\n{\n  \"status\" : 0,\n  \"error\": \"The user_id field is required\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 422 Validation error\n{\n  \"status\" : 0,\n  \"error\": \"The comment_id field is required\"\n}",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "app/Http/Controllers/Api/CommentsController.php",
    "groupTitle": "Feeds"
  },
  {
    "type": "post",
    "url": "/feeds/feedDetails",
    "title": "feedDetails",
    "name": "feedDetails",
    "group": "Feeds",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "<p>Number</p> ",
            "optional": false,
            "field": "user_id",
            "description": "<p>Id of user *required</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>Number</p> ",
            "optional": false,
            "field": "feed_id",
            "description": "<p>feed_id *required</p> "
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "<p>String</p> ",
            "optional": false,
            "field": "success.",
            "description": ""
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n{\n      \"id\": \"1133\",\n      \"user_id\": \"67\",\n      \"item_type\": \"workout\",\n      \"item_id\": \"2\",\n      \"feed_text\": \"hcjgg\",\n      \"image\": \"\",\n      \"created_at\": \"2016-03-31 17:19:28\",\n      \"updated_at\": \"2016-03-31 17:19:28\",\n      \"clap_count\": 0,\n      \"comment_count\": 0,\n      \"is_commented\": 0,\n      \"is_claped\": 0,\n      \"category\": \"HIIT-strength\",\n      \"item_name\": \"Borr\",\n      \"duration\": \"8\",\n      \"workout_rounds\": \"3\",\n      \"is_coach\": 1,\n      \"coach_workout_rounds\": \"1\",\n      \"focus\": \"Athletic\",\n      \"profile\": {\n      \"user_id\": \"67\",\n      \"first_name\": \"Aneesh\",\n      \"last_name\": \"iL\",\n      \"image\": \"67_1457647007.jpg\",\n      \"quote\": \"\",\n      \"gender\": \"2\",\n      \"level\": 36\n      }\n      }\n      ],\n      \"urls\": {\n      \"profileImageSmall\": \"http://ykings.me/uploads/images/profile/small\",\n      \"profileImageMedium\": \"http://ykings.me/uploads/images/profile/medium\",\n      \"profileImageLarge\": \"http://ykings.me/uploads/images/profile/large\",\n      \"profileImageOriginal\": \"http://ykings.me/uploads/images/profile/original\",\n      \"video\": \"http://ykings.me/uploads/videos\",\n      \"videothumbnail\": \"http://ykings.me/uploads/images/videothumbnails\",\n      \"feedImageSmall\": \"http://ykings.me/uploads/images/feed/small\",\n      \"feedImageMedium\": \"http://ykings.me/uploads/images/feed/medium\",\n      \"feedImageLarge\": \"http://ykings.me/uploads/images/feed/large\",\n      \"feedImageOriginal\": \"http://ykings.me/uploads/images/feed/original\",\n      \"coverImageSmall\": \"http://ykings.me/uploads/images/cover_image/small\",\n      \"coverImageMedium\": \"http://ykings.me/uploads/images/cover_image/medium\",\n      \"coverImageLarge\": \"http://ykings.me/uploads/images/cover_image/large\",\n      \"coverImageOriginal\": \"http://ykings.me/uploads/images/cover_image/original\"\n      }\n      }",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "error",
            "description": "<p>Message token_invalid.</p> "
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "user_not_exists",
            "description": "<p>User error.</p> "
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 400 Invalid Request\n{\n  \"status\":\"0\",\n  \"error\": \"token_invalid\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 401 Unauthorised\n{\n  \"status\":\"0\",\n  \"error\": \"token_expired\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 400 Bad Request\n{\n  \"status\":\"0\",\n  \"error\": \"token_not_provided\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 400 Bad Request\n{\n  \"status\":\"0\",\n  \"error\": \"user_not_exists\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 422 Validation error\n{\n  \"status\" : 0,\n  \"error\": \"The user_id field is required\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 422 Validation error\n{\n  \"status\" : 0,\n  \"error\": \"The feed_id field is required\"\n}",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "app/Http/Controllers/Api/FeedController.php",
    "groupTitle": "Feeds"
  },
  {
    "type": "post",
    "url": "/feeds/comments",
    "title": "loadComments",
    "name": "loadComments",
    "group": "Feeds",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "<p>Number</p> ",
            "optional": false,
            "field": "user_id",
            "description": "<p>Id of user *required</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>Number</p> ",
            "optional": false,
            "field": "feed_id",
            "description": "<p>feed_id *required</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>Number</p> ",
            "optional": true,
            "field": "offset",
            "description": "<p>offset</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>Number</p> ",
            "optional": true,
            "field": "limit",
            "description": "<p>limit</p> "
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "<p>String</p> ",
            "optional": false,
            "field": "success.",
            "description": ""
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n      {\n      \"status\": 1,\n      \"comments\": [\n      {\n      \"id\": \"1\",\n      \"user_id\": \"14\",\n      \"parent_type\": \"feed\",\n      \"parent_id\": \"15\",\n      \"comment_text\": \"This is a sample comment\",\n      \"created_at\": \"2015-11-16 13:53:47\",\n      \"updated_at\": \"2015-11-17 13:01:09\",\n      \"profile\": {\n      \"user_id\": \"14\",\n      \"first_name\": \"sachii\",\n      \"last_name\": \"k\",\n      \"image\": null\n      }\n      },\n      {\n      \"id\": \"2\",\n      \"user_id\": \"11\",\n      \"parent_type\": \"feed\",\n      \"parent_id\": \"15\",\n      \"comment_text\": \"This is another comment\",\n      \"created_at\": \"2015-11-16 13:55:14\",\n      \"updated_at\": \"2015-11-17 13:02:38\",\n      \"profile\": {\n      \"user_id\": \"11\",\n      \"first_name\": \"ansa\",\n      \"last_name\": \"v\",\n      \"image\": \"11_1447237788.jpg\"\n      }\n      }\n      ],\n      \"urls\": {\n      \"profileImageSmall\": \"http://sandbox.ykings.com/uploads/images/profile/small\",\n      \"profileImageMedium\": \"http://sandbox.ykings.com/uploads/images/profile/medium\",\n      \"profileImageLarge\": \"http://sandbox.ykings.com/uploads/images/profile/large\",\n      \"profileImageOriginal\": \"http://sandbox.ykings.com/uploads/images/profile/original\",\n      \"video\": \"http://sandbox.ykings.com/uploads/videos\",\n      \"videothumbnail\": \"http://sandbox.ykings.com/uploads/images/videothumbnails\",\n      \"feedImageSmall\": \"http://sandbox.ykings.com/uploads/images/feed/small\",\n      \"feedImageMedium\": \"http://sandbox.ykings.com/uploads/images/feed/medium\",\n      \"feedImageLarge\": \"http://sandbox.ykings.com/uploads/images/feed/large\",\n      \"feedImageOriginal\": \"http://sandbox.ykings.com/uploads/images/feed/original\",\n      \"coverImageSmall\": \"http://sandbox.ykings.com/uploads/images/cover_image/small\",\n      \"coverImageMedium\": \"http://sandbox.ykings.com/uploads/images/cover_image/medium\",\n      \"coverImageLarge\": \"http://sandbox.ykings.com/uploads/images/cover_image/large\",\n      \"coverImageOriginal\": \"http://sandbox.ykings.com/uploads/images/cover_image/original\"\n      }\n      }",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "error",
            "description": "<p>Message token_invalid.</p> "
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "user_not_exists",
            "description": "<p>User error.</p> "
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 400 Invalid Request\n{\n  \"status\":\"0\",\n  \"error\": \"token_invalid\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 401 Unauthorised\n{\n  \"status\":\"0\",\n  \"error\": \"token_expired\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 400 Bad Request\n{\n  \"status\":\"0\",\n  \"error\": \"token_not_provided\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 400 Bad Request\n{\n  \"status\":\"0\",\n  \"error\": \"feed_not_exists\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 422 Validation error\n{\n  \"status\" : 0,\n  \"error\": \"The user_id field is required\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 422 Validation error\n{\n  \"status\" : 0,\n  \"error\": \"The feed_id field is required\"\n}",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "app/Http/Controllers/Api/CommentsController.php",
    "groupTitle": "Feeds"
  },
  {
    "type": "post",
    "url": "/feeds/unclap",
    "title": "unclapFeed",
    "name": "unclapFeed",
    "group": "Feeds",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "<p>Number</p> ",
            "optional": false,
            "field": "user_id",
            "description": "<p>Id of user *required</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>Number</p> ",
            "optional": false,
            "field": "feed_id",
            "description": "<p>feed_id *required</p> "
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "<p>String</p> ",
            "optional": false,
            "field": "success.",
            "description": ""
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n   {\n   \"success\": \"unclaped\"\n   }",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "error",
            "description": "<p>Message token_invalid.</p> "
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "user_not_exists",
            "description": "<p>User error.</p> "
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 400 Invalid Request\n{\n  \"status\":\"0\",\n  \"error\": \"token_invalid\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 401 Unauthorised\n{\n  \"status\":\"0\",\n  \"error\": \"token_expired\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 400 Bad Request\n{\n  \"status\":\"0\",\n  \"error\": \"token_not_provided\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 400 Bad Request\n{\n  \"status\":\"0\",\n  \"error\": \"feed_not_exists\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 422 Validation error\n{\n  \"status\" : 0,\n  \"error\": \"The user_id field is required\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 422 Validation error\n{\n  \"status\" : 0,\n  \"error\": \"The feed_id field is required\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 422 Validation error\n{\n  \"status\" : 0,\n  \"error\": \"not_yet_claped\"\n}",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "app/Http/Controllers/Api/FeedController.php",
    "groupTitle": "Feeds"
  },
  {
    "type": "post",
    "url": "/follow/add",
    "title": "followUser",
    "name": "followUser",
    "group": "Follow",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "<p>integer</p> ",
            "optional": false,
            "field": "follower_id",
            "description": "<p>id of follower user  *required</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>integer</p> ",
            "optional": false,
            "field": "following_id",
            "description": "<p>id of following user *required</p> "
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "<p>String</p> ",
            "optional": false,
            "field": "success.",
            "description": ""
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n      {\n      \"status\": 1,\n      \"success\": \"successfully_followed\"\n      }",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "error",
            "description": "<p>Message token_invalid.</p> "
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 400 Invalid Request\n    {\n      \"error\": \"token_invalid\"\n    }",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 401 Unauthorised\n    {\n      \"status\": 0,\n      \"error\": \"token_expired\"\n    }",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 400 Bad Request\n    {\n      \"status\": 0,\n      \"error\": \"token_not_provided\"\n    }",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 422 validation_errors\n    {\n      \"status\": 0,\n      \"error\":  \"The follower_id field is required.\"        \n    }",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 422 validation_errors\n    {\n      \"status\": 0,\n      \"error\":  \"The following_id field is required.\"        \n    }",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 422 follower_user_does_not_exists\n    {\n          \"status\": 0,\n          \"error\": \"follower_user_does_not_exists\"\n    }",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 422 following_user_does_not_exists\n    {\n          \"status\": 0,\n          \"error\": \"following_user_does_not_exists\"\n    }",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 422 follower_user_not_verified_email\n    {\n          \"status\": 0,\n          \"error\": \"follower_user_not_verified_email\"\n    }",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 422 following_user_not_verified_email\n    {\n          \"status\": 0,\n          \"error\": \"following_user_not_verified_email\"\n    }",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 422 you_are_already_followed\n    {\n          \"status\": 0,\n          \"error\": \"you_are_already_followed\"\n    }",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 422 could_not_able_to_follow\n    {\n          \"status\": 0,\n          \"error\": \"could_not_able_to_follow\"\n    }",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "app/Http/Controllers/Api/UserFollowsController.php",
    "groupTitle": "Follow"
  },
  {
    "type": "post",
    "url": "/follow/get",
    "title": "getFollowers",
    "name": "getFollowers",
    "group": "Follow",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "<p>integer</p> ",
            "optional": false,
            "field": "user_id",
            "description": "<p>id of loggedin user  *required</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>integer</p> ",
            "optional": false,
            "field": "profile_id",
            "description": "<p>id of targetting user  *required</p> "
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "<p>String</p> ",
            "optional": false,
            "field": "success.",
            "description": ""
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n      {\n      \"status\": 1,\n      \"success\": \"user_followers\",\n      \"user\": {\n      \"id\": \"2\",\n      \"email\": \"aneeshk@cubettech.com\",\n      \"confirmation_code\": \"\",\n      \"status\": \"1\",\n      \"created_at\": \"2015-11-12 08:44:54\",\n      \"updated_at\": \"2015-11-12 08:44:54\",\n      \"profile\": {\n      \"id\": \"2\",\n      \"user_id\": \"2\",\n      \"first_name\": \"Aneesh\",\n      \"last_name\": \"Kallikkattil\",\n      \"gender\": \"0\",\n      \"fitness_status\": \"3\",\n      \"goal\": \"3\",\n      \"image\": \"2_1447317902.jpg\",\n      \"city\": \"Kochi\",\n      \"state\": \"Kerala\",\n      \"country\": \"India\",\n      \"spot\": \"\",\n      \"quote\": \"I need to get strong!!!!\",\n      \"created_at\": \"2015-11-12 08:45:02\",\n      \"updated_at\": \"2015-11-12 08:45:02\"\n      }\n      },\n      \"followers\": [{\n      \"id\": \"1\",\n      \"user_id\": \"3\",\n      \"follow_id\": \"2\",\n      \"created_at\": \"2015-11-12 09:34:27\",\n      \"updated_at\": \"2015-11-12 15:05:55\",\n      \"level\": 3,\n      \"is_following\":0,\n      \"following_profile\": {\n      \"id\": \"3\",\n      \"email\": \"ykings1@yopmail.com\",\n      \"confirmation_code\": \"\",\n      \"status\": \"1\",\n      \"created_at\": \"2015-11-12 08:47:37\",\n      \"updated_at\": \"2015-11-12 08:47:37\",\n      \"profile\": {\n      \"id\": \"3\",\n      \"user_id\": \"3\",\n      \"first_name\": \"Ykings\",\n      \"last_name\": \"test1\",\n      \"gender\": \"0\",\n      \"fitness_status\": \"1\",\n      \"goal\": \"3\",\n      \"image\": \"3_1447318063.jpg\",\n      \"city\": \"Kochi\",\n      \"state\": \"Kerala\",\n      \"country\": \"India\",\n      \"quote\": \"I need to get strong!!!!\",\n      \"created_at\": \"2015-11-12 08:47:43\",\n      \"updated_at\": \"2015-11-12 08:47:43\"\n      }\n      }\n      }],\n      \"urls\": {\n      \"profileImageSmall\": \"http://sandbox.ykings.com/uploads/images/profile/small\",\n      \"profileImageMedium\": \"http://sandbox.ykings.com/uploads/images/profile/medium\",\n      \"profileImageLarge\": \"http://sandbox.ykings.com/uploads/images/profile/large\",\n      \"profileImageOriginal\": \"http://sandbox.ykings.com/uploads/images/profile/original\",\n      \"video\": \"http://sandbox.ykings.com/uploads/videos\",\n      \"videothumbnail\": \"http://sandbox.ykings.com/uploads/images/videothumbnails\",\n      \"feedImageSmall\": \"http://sandbox.ykings.com/uploads/images/feed/small\",\n      \"feedImageMedium\": \"http://sandbox.ykings.com/uploads/images/feed/medium\",\n      \"feedImageLarge\": \"http://sandbox.ykings.com/uploads/images/feed/large\",\n      \"feedImageOriginal\": \"http://sandbox.ykings.com/uploads/images/feed/original\",\n      \"coverImageSmall\": \"http://sandbox.ykings.com/uploads/images/cover_image/small\",\n      \"coverImageMedium\": \"http://sandbox.ykings.com/uploads/images/cover_image/medium\",\n      \"coverImageLarge\": \"http://sandbox.ykings.com/uploads/images/cover_image/large\",\n      \"coverImageOriginal\": \"http://sandbox.ykings.com/uploads/images/cover_image/original\"\n      }\n      }",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "error",
            "description": "<p>Message token_invalid</p> "
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 400 Invalid Request\n{\n  \"status\" : 0,\n  \"error\": \"token_invalid\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 401 Unauthorised\n{\n  \"status\" : 0,\n  \"error\": \"token_expired\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 400 Bad Request\n{\n  \"status\" : 0,\n  \"error\": \"token_not_provided\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 422 user_id_required\n{\n      \"status\": 0,\n      \"error\": \"user_id_required\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 422 invalid_user_id\n{\n      \"status\": 0,\n      \"error\": \"invalid_user_id\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 422 user_does_not_exists\n{\n      \"status\": 0,\n      \"error\": \"user_does_not_exists\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 422 user_not_verified_email\n{\n      \"status\": 0,\n      \"error\": \"user_not_verified_email\"\n}",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "app/Http/Controllers/Api/UserFollowsController.php",
    "groupTitle": "Follow"
  },
  {
    "type": "post",
    "url": "/follow/follows",
    "title": "getFollowings",
    "name": "getFollowings",
    "group": "Follow",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "<p>integer</p> ",
            "optional": false,
            "field": "user_id",
            "description": "<p>id of targetting user  *required</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>integer</p> ",
            "optional": false,
            "field": "profile_id",
            "description": "<p>id of targetting user  *required</p> "
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "<p>String</p> ",
            "optional": false,
            "field": "success.",
            "description": ""
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n      {\n      \"status\": 1,\n      \"success\": \"user_followings\",\n      \"user\": {\n      \"id\": \"2\",\n      \"email\": \"aneeshk@cubettech.com\",\n      \"confirmation_code\": \"\",\n      \"status\": \"1\",\n      \"created_at\": \"2015-11-12 08:44:54\",\n      \"updated_at\": \"2015-11-12 08:44:54\",\n      \"profile\": {\n      \"id\": \"2\",\n      \"user_id\": \"2\",\n      \"first_name\": \"Aneesh\",\n      \"last_name\": \"Kallikkattil\",\n      \"gender\": \"0\",\n      \"fitness_status\": \"3\",\n      \"goal\": \"3\",\n      \"image\": \"2_1447317902.jpg\",\n      \"city\": \"Kochi\",\n      \"state\": \"Kerala\",\n      \"country\": \"India\",\n      \"spot\": \"\",\n      \"quote\": \"I need to get strong!!!!\",\n      \"created_at\": \"2015-11-12 08:45:02\",\n      \"updated_at\": \"2015-11-12 08:45:02\"\n      }\n      },\n      \"followings\": [\n      {\n      \"id\": \"1\",\n      \"user_id\": \"3\",\n      \"follow_id\": \"2\",\n      \"created_at\": \"2015-11-12 09:34:27\",\n      \"updated_at\": \"2015-11-12 15:05:55\",\n      \"level\": 3,\n      \"is_following\":0,\n      \"following_profile\": {\n      \"id\": \"3\",\n      \"email\": \"ykings1@yopmail.com\",\n      \"confirmation_code\": \"\",\n      \"status\": \"1\",\n      \"created_at\": \"2015-11-12 08:47:37\",\n      \"updated_at\": \"2015-11-12 08:47:37\",\n      \"profile\": {\n      \"id\": \"3\",\n      \"user_id\": \"3\",\n      \"first_name\": \"Ykings\",\n      \"last_name\": \"test1\",\n      \"gender\": \"0\",\n      \"fitness_status\": \"1\",\n      \"goal\": \"3\",\n      \"image\": \"3_1447318063.jpg\",\n      \"city\": \"Kochi\",\n      \"state\": \"Kerala\",\n      \"country\": \"India\",\n      \"quote\": \"I need to get strong!!!!\",\n      \"created_at\": \"2015-11-12 08:47:43\",\n      \"updated_at\": \"2015-11-12 08:47:43\"\n      }\n      }\n      }\n      ],\n      \"urls\": {\n      \"profileImageSmall\": \"http://sandbox.ykings.com/uploads/images/profile/small\",\n      \"profileImageMedium\": \"http://sandbox.ykings.com/uploads/images/profile/medium\",\n      \"profileImageLarge\": \"http://sandbox.ykings.com/uploads/images/profile/large\",\n      \"profileImageOriginal\": \"http://sandbox.ykings.com/uploads/images/profile/original\",\n      \"video\": \"http://sandbox.ykings.com/uploads/videos\",\n      \"videothumbnail\": \"http://sandbox.ykings.com/uploads/images/videothumbnails\",\n      \"feedImageSmall\": \"http://sandbox.ykings.com/uploads/images/feed/small\",\n      \"feedImageMedium\": \"http://sandbox.ykings.com/uploads/images/feed/medium\",\n      \"feedImageLarge\": \"http://sandbox.ykings.com/uploads/images/feed/large\",\n      \"feedImageOriginal\": \"http://sandbox.ykings.com/uploads/images/feed/original\",\n      \"coverImageSmall\": \"http://sandbox.ykings.com/uploads/images/cover_image/small\",\n      \"coverImageMedium\": \"http://sandbox.ykings.com/uploads/images/cover_image/medium\",\n      \"coverImageLarge\": \"http://sandbox.ykings.com/uploads/images/cover_image/large\",\n      \"coverImageOriginal\": \"http://sandbox.ykings.com/uploads/images/cover_image/original\"\n      }\n      }",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "error",
            "description": "<p>Message token_invalid</p> "
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 400 Invalid Request\n{\n  \"status\" : 0,\n  \"error\": \"token_invalid\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 401 Unauthorised\n{\n  \"status\" : 0,\n  \"error\": \"token_expired\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 400 Bad Request\n{\n  \"status\" : 0,\n  \"error\": \"token_not_provided\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 422 user_id_required\n{\n      \"status\": 0,\n      \"error\": \"user_id_required\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 422 invalid_user_id\n{\n      \"status\": 0,\n      \"error\": \"invalid_user_id\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 422 user_does_not_exists\n{\n      \"status\": 0,\n      \"error\": \"user_does_not_exists\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 422 user_not_verified_email\n{\n      \"status\": 0,\n      \"error\": \"user_not_verified_email\"\n}",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "app/Http/Controllers/Api/UserFollowsController.php",
    "groupTitle": "Follow"
  },
  {
    "type": "post",
    "url": "/follow/unfollow",
    "title": "unfollowUser",
    "name": "unfollowUser",
    "group": "Follow",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "<p>integer</p> ",
            "optional": false,
            "field": "follower_id",
            "description": "<p>id of follower user  *required</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>integer</p> ",
            "optional": false,
            "field": "following_id",
            "description": "<p>id of following user *required</p> "
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "<p>String</p> ",
            "optional": false,
            "field": "success.",
            "description": ""
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n      {\n      \"status\": 1,\n      \"success\": \"successfully_unfollowed\"\n      }",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "error",
            "description": "<p>Message token_invalid.</p> "
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 400 Invalid Request\n    { \n      \"status\" : 0,\n      \"error\": \"token_invalid\"\n    }",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 401 Unauthorised\n    {\n      \"status\" : 0,\n      \"error\": \"token_expired\"\n    }",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 400 Bad Request\n    {\n      \"status\" : 0,\n      \"error\": \"token_not_provided\"\n    }",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 422 follower_user_does_not_exists\n    {\n          \"status\": 0,\n          \"error\": \"follower_user_does_not_exists\"\n    }",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 422 following_user_does_not_exists\n    {\n          \"status\": 0,\n          \"error\": \"following_user_does_not_exists\"\n    }",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 422 validation_errors\n    {\n      \"status\": 0,\n      \"error\":  \"The follower_id field is required.\"        \n    }",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 422 validation_errors\n    {\n      \"status\": 0,\n      \"error\":  \"The following_id field is required.\"        \n    }",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 422 follower_user_does_not_exists\n    {\n          \"status\": 0,\n          \"error\": \"follower_user_does_not_exists\"\n    }",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 422 follower_user_not_verified_email\n    {\n          \"status\": 0,\n          \"error\": \"follower_user_not_verified_email\"\n    }",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 422 following_user_not_verified_email\n    {\n          \"status\": 0,\n          \"error\": \"following_user_not_verified_email\"\n    }",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 422 you_are_already_followed\n    {\n          \"status\": 0,\n          \"error\": \"you_are_already_unfollowed\"\n    }",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 500 could_not_able_to_follow\n    {\n          \"status\": 0,\n          \"error\": \"could_not_able_to_unfollow\"\n    }",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "app/Http/Controllers/Api/UserFollowsController.php",
    "groupTitle": "Follow"
  },
  {
    "type": "post",
    "url": "/authenticate/",
    "title": "RefreshToken",
    "name": "RefreshToken",
    "group": "General",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "<p>String</p> ",
            "optional": false,
            "field": "token",
            "description": "<p>expired token *required</p> "
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "<p>String</p> ",
            "optional": false,
            "field": "token",
            "description": "<p>JWT Auth token.</p> "
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n{\n  \"status\" : 1,\n  \"token\": \"eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOiIxIiwiaXNzIjoiaHR0cDpcL1wvc2FuZGJveC55a2luZ3MuY29tXC9hcGlcL2F1dGhlbnRpY2F0ZSIsImlhdCI6IjE0NDY2MzMwNzgiLCJleHAiOiIxNDQ2NjM2Njc4IiwibmJmIjoiMTQ0NjYzMzA3OCIsImp0aSI6ImFiNDAwNTllZmU0OTI3ODYwMTczYjI1ZGEzZWJmMDkwIn0.uM_G0OAne9b-twd60tAZlAUGmpitINP0JMgGC3ZrNoo\",\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "Validation",
            "description": "<p>Error</p> "
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "invalid_credentials",
            "description": "<p>Message invalid_credentials.</p> "
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "could_not_create_token",
            "description": "<p>JWT error.</p> "
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 422 Validation error\n{\n  \"status\" : 0,\n  \"error\": \"The token field is required\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 404 invalid_credentials\n{\n  \"status\" : 0,\n  \"error\": \"invalid_credentials\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 500 could_not_create_token\n{\n  \"status\" : 0,\n  \"error\": \"could_not_create_token\"\n}",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "app/Http/Controllers/Api/AuthenticateController.php",
    "groupTitle": "General"
  },
  {
    "type": "post",
    "url": "/user/listNotifications",
    "title": "ListNotifications",
    "name": "ListNotifications",
    "group": "Message",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "<p>Number</p> ",
            "optional": false,
            "field": "user_id",
            "description": "<p>Id of user *required</p> "
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "<p>String</p> ",
            "optional": false,
            "field": "success.",
            "description": ""
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n{\n  \"status\": 1,\n  \"notifications\": [\n    {\n      \"id\": \"1730\",\n      \"user_id\": \"1\",\n      \"friend_id\": \"67\",\n      \"message_type\": \"knowledge\",\n      \"type_id\": \"1364\",\n      \"message\": \"Team added a new message.\",\n      \"read\": \"1\",\n      \"created_at\": \"2016-06-02 12:42:59\",\n      \"updated_at\": \"2016-06-14 06:23:25\",\n      \"image\": \"1_1463145040.jpg\"\n    },\n    {\n      \"id\": \"1692\",\n      \"user_id\": \"67\",\n      \"friend_id\": \"67\",\n      \"message_type\": \"perfomance\",\n      \"type_id\": \"67\",\n      \"message\": \"Congrats. Your level has been upgraded to 43.\",\n      \"read\": \"0\",\n      \"created_at\": \"2016-05-14 07:05:03\",\n      \"updated_at\": \"2016-05-14 07:05:03\",\n      \"image\": \"67_1460107183.jpg\"\n    },\n    {\n      \"id\": \"1574\",\n      \"user_id\": \"1\",\n      \"friend_id\": \"67\",\n      \"message_type\": \"knowledge\",\n      \"type_id\": \"1314\",\n      \"message\": \"Team added a new message.\",\n      \"read\": \"0\",\n      \"created_at\": \"2016-05-13 13:19:20\",\n      \"updated_at\": \"2016-05-13 13:19:20\",\n      \"image\": \"1_1463145040.jpg\"\n    },\n    {\n      \"id\": \"1451\",\n      \"user_id\": \"1\",\n      \"friend_id\": \"67\",\n      \"message_type\": \"knowledge\",\n      \"type_id\": \"1313\",\n      \"message\": \"Team added a new message.\",\n      \"read\": \"0\",\n      \"created_at\": \"2016-05-13 13:17:45\",\n      \"updated_at\": \"2016-05-13 13:17:45\",\n      \"image\": \"1_1463145040.jpg\"\n    },\n    {\n      \"id\": \"1327\",\n      \"user_id\": \"1\",\n      \"friend_id\": \"67\",\n      \"message_type\": \"knowledge\",\n      \"type_id\": \"1312\",\n      \"message\": \"Team added a new message.\",\n      \"read\": \"0\",\n      \"created_at\": \"2016-05-13 12:41:47\",\n      \"updated_at\": \"2016-05-13 12:41:47\",\n      \"image\": \"1_1463145040.jpg\"\n    },\n    {\n      \"id\": \"1201\",\n      \"user_id\": \"1\",\n      \"friend_id\": \"67\",\n      \"message_type\": \"knowledge\",\n      \"type_id\": \"1311\",\n      \"message\": \"Team added a new message.\",\n      \"read\": \"0\",\n      \"created_at\": \"2016-05-13 12:26:25\",\n      \"updated_at\": \"2016-05-13 12:26:25\",\n      \"image\": \"1_1463145040.jpg\"\n    },\n    {\n      \"id\": \"1173\",\n      \"user_id\": \"67\",\n      \"friend_id\": \"67\",\n      \"message_type\": \"perfomance\",\n      \"type_id\": \"67\",\n      \"message\": \"Congrats. Your level has been upgraded to 42.\",\n      \"read\": \"0\",\n      \"created_at\": \"2016-05-06 08:56:09\",\n      \"updated_at\": \"2016-05-06 08:56:09\",\n      \"image\": \"67_1460107183.jpg\"\n    },\n    {\n      \"id\": \"1155\",\n      \"user_id\": \"17\",\n      \"friend_id\": \"67\",\n      \"message_type\": \"comment\",\n      \"type_id\": \"1244\",\n      \"message\": \"Vinish commented on your feed.\",\n      \"read\": \"1\",\n      \"created_at\": \"2016-04-28 05:58:27\",\n      \"updated_at\": \"2016-05-05 05:18:02\",\n      \"image\": \"17_1457639358.jpg\"\n    },\n    {\n      \"id\": \"1152\",\n      \"user_id\": \"67\",\n      \"friend_id\": \"67\",\n      \"message_type\": \"perfomance\",\n      \"type_id\": \"67\",\n      \"message\": \"Congrats. Your level has been upgraded to 41.\",\n      \"read\": \"1\",\n      \"created_at\": \"2016-04-26 09:10:50\",\n      \"updated_at\": \"2016-05-05 05:18:02\",\n      \"image\": \"67_1460107183.jpg\"\n    },\n    {\n      \"id\": \"1019\",\n      \"user_id\": \"1\",\n      \"friend_id\": \"67\",\n      \"message_type\": \"knowledge\",\n      \"type_id\": \"1238\",\n      \"message\": \"Team added a new message.\",\n      \"read\": \"1\",\n      \"created_at\": \"2016-04-21 08:22:35\",\n      \"updated_at\": \"2016-04-22 10:59:07\",\n      \"image\": \"1_1463145040.jpg\"\n    },\n    {\n      \"id\": \"897\",\n      \"user_id\": \"1\",\n      \"friend_id\": \"67\",\n      \"message_type\": \"knowledge\",\n      \"type_id\": \"1237\",\n      \"message\": \"Team added a new message.\",\n      \"read\": \"1\",\n      \"created_at\": \"2016-04-21 08:22:04\",\n      \"updated_at\": \"2016-04-22 10:59:14\",\n      \"image\": \"1_1463145040.jpg\"\n    },\n    {\n      \"id\": \"774\",\n      \"user_id\": \"1\",\n      \"friend_id\": \"67\",\n      \"message_type\": \"knowledge\",\n      \"type_id\": \"1236\",\n      \"message\": \"Team added a new message.\",\n      \"read\": \"1\",\n      \"created_at\": \"2016-04-21 08:13:47\",\n      \"updated_at\": \"2016-04-22 10:59:19\",\n      \"image\": \"1_1463145040.jpg\"\n    },\n    {\n      \"id\": \"652\",\n      \"user_id\": \"1\",\n      \"friend_id\": \"67\",\n      \"message_type\": \"knowledge\",\n      \"type_id\": \"1235\",\n      \"message\": \"Team added a new message.\",\n      \"read\": \"1\",\n      \"created_at\": \"2016-04-21 08:12:43\",\n      \"updated_at\": \"2016-04-22 10:38:43\",\n      \"image\": \"1_1463145040.jpg\"\n    },\n    {\n      \"id\": \"616\",\n      \"user_id\": \"67\",\n      \"friend_id\": \"67\",\n      \"message_type\": \"perfomance\",\n      \"type_id\": \"67\",\n      \"message\": \"Congrats. Your level has been upgraded to 40.\",\n      \"read\": \"1\",\n      \"created_at\": \"2016-04-13 06:35:49\",\n      \"updated_at\": \"2016-05-05 05:18:02\",\n      \"image\": \"67_1460107183.jpg\"\n    },\n    {\n      \"id\": \"612\",\n      \"user_id\": \"67\",\n      \"friend_id\": \"67\",\n      \"message_type\": \"perfomance\",\n      \"type_id\": \"67\",\n      \"message\": \"Congrats. Your level has been upgraded to 39.\",\n      \"read\": \"1\",\n      \"created_at\": \"2016-04-12 07:14:32\",\n      \"updated_at\": \"2016-05-05 05:18:02\",\n      \"image\": \"67_1460107183.jpg\"\n    },\n    {\n      \"id\": \"608\",\n      \"user_id\": \"67\",\n      \"friend_id\": \"67\",\n      \"message_type\": \"perfomance\",\n      \"type_id\": \"67\",\n      \"message\": \"Congrats. Your level has been upgraded to 38.\",\n      \"read\": \"1\",\n      \"created_at\": \"2016-04-08 15:19:13\",\n      \"updated_at\": \"2016-05-05 05:18:02\",\n      \"image\": \"67_1460107183.jpg\"\n    },\n    {\n      \"id\": \"599\",\n      \"user_id\": \"67\",\n      \"friend_id\": \"67\",\n      \"message_type\": \"perfomance\",\n      \"type_id\": \"67\",\n      \"message\": \"Congrats. Your level has been upgraded to 37.\",\n      \"read\": \"1\",\n      \"created_at\": \"2016-04-07 13:41:29\",\n      \"updated_at\": \"2016-05-05 05:18:02\",\n      \"image\": \"67_1460107183.jpg\"\n    },\n    {\n      \"id\": \"584\",\n      \"user_id\": \"67\",\n      \"friend_id\": \"67\",\n      \"message_type\": \"perfomance\",\n      \"type_id\": \"67\",\n      \"message\": \"Congrats. Your level has been upgraded to 36.\",\n      \"read\": \"1\",\n      \"created_at\": \"2016-04-05 05:20:32\",\n      \"updated_at\": \"2016-05-05 05:18:02\",\n      \"image\": \"67_1460107183.jpg\"\n    },\n    {\n      \"id\": \"581\",\n      \"user_id\": \"67\",\n      \"friend_id\": \"67\",\n      \"message_type\": \"perfomance\",\n      \"type_id\": \"67\",\n      \"message\": \"Congrats. Your level has been upgraded to 35.\",\n      \"read\": \"1\",\n      \"created_at\": \"2016-03-31 17:46:28\",\n      \"updated_at\": \"2016-05-05 05:18:02\",\n      \"image\": \"67_1460107183.jpg\"\n    },\n    {\n      \"id\": \"579\",\n      \"user_id\": \"67\",\n      \"friend_id\": \"67\",\n      \"message_type\": \"perfomance\",\n      \"type_id\": \"67\",\n      \"message\": \"Congrats. Your level has been upgraded to 34.\",\n      \"read\": \"1\",\n      \"created_at\": \"2016-03-31 14:47:34\",\n      \"updated_at\": \"2016-05-05 05:18:02\",\n      \"image\": \"67_1460107183.jpg\"\n    },\n    {\n      \"id\": \"570\",\n      \"user_id\": \"17\",\n      \"friend_id\": \"67\",\n      \"message_type\": \"comment\",\n      \"type_id\": \"1097\",\n      \"message\": \"Vinish commented on your feed.\",\n      \"read\": \"1\",\n      \"created_at\": \"2016-03-30 06:44:43\",\n      \"updated_at\": \"2016-04-25 19:10:09\",\n      \"image\": \"17_1457639358.jpg\"\n    },\n    {\n      \"id\": \"569\",\n      \"user_id\": \"17\",\n      \"friend_id\": \"67\",\n      \"message_type\": \"comment\",\n      \"type_id\": \"1115\",\n      \"message\": \"Vinish commented on your feed.\",\n      \"read\": \"1\",\n      \"created_at\": \"2016-03-30 06:34:56\",\n      \"updated_at\": \"2016-04-22 10:59:04\",\n      \"image\": \"17_1457639358.jpg\"\n    },\n    {\n      \"id\": \"568\",\n      \"user_id\": \"17\",\n      \"friend_id\": \"67\",\n      \"message_type\": \"comment\",\n      \"type_id\": \"1115\",\n      \"message\": \"Vinish commented on your feed.\",\n      \"read\": \"1\",\n      \"created_at\": \"2016-03-30 06:23:17\",\n      \"updated_at\": \"2016-04-22 10:59:04\",\n      \"image\": \"17_1457639358.jpg\"\n    },\n    {\n      \"id\": \"567\",\n      \"user_id\": \"17\",\n      \"friend_id\": \"67\",\n      \"message_type\": \"comment\",\n      \"type_id\": \"1115\",\n      \"message\": \"Vinish commented on your feed.\",\n      \"read\": \"1\",\n      \"created_at\": \"2016-03-30 06:22:20\",\n      \"updated_at\": \"2016-04-22 10:59:04\",\n      \"image\": \"17_1457639358.jpg\"\n    },\n    {\n      \"id\": \"566\",\n      \"user_id\": \"17\",\n      \"friend_id\": \"67\",\n      \"message_type\": \"comment\",\n      \"type_id\": \"1115\",\n      \"message\": \"Vinish commented on your feed.\",\n      \"read\": \"1\",\n      \"created_at\": \"2016-03-30 06:21:40\",\n      \"updated_at\": \"2016-04-22 10:59:04\",\n      \"image\": \"17_1457639358.jpg\"\n    },\n    {\n      \"id\": \"565\",\n      \"user_id\": \"17\",\n      \"friend_id\": \"67\",\n      \"message_type\": \"comment\",\n      \"type_id\": \"1115\",\n      \"message\": \"Vinish commented on your feed.\",\n      \"read\": \"1\",\n      \"created_at\": \"2016-03-30 06:19:48\",\n      \"updated_at\": \"2016-04-22 10:59:04\",\n      \"image\": \"17_1457639358.jpg\"\n    },\n    {\n      \"id\": \"564\",\n      \"user_id\": \"17\",\n      \"friend_id\": \"67\",\n      \"message_type\": \"comment\",\n      \"type_id\": \"1115\",\n      \"message\": \"Vinish commented on your feed.\",\n      \"read\": \"1\",\n      \"created_at\": \"2016-03-30 06:19:42\",\n      \"updated_at\": \"2016-04-22 10:59:04\",\n      \"image\": \"17_1457639358.jpg\"\n    },\n    {\n      \"id\": \"563\",\n      \"user_id\": \"67\",\n      \"friend_id\": \"67\",\n      \"message_type\": \"perfomance\",\n      \"type_id\": \"67\",\n      \"message\": \"Congrats. Your level has been upgraded to 33.\",\n      \"read\": \"1\",\n      \"created_at\": \"2016-03-30 05:08:15\",\n      \"updated_at\": \"2016-05-05 05:18:02\",\n      \"image\": \"67_1460107183.jpg\"\n    },\n    {\n      \"id\": \"551\",\n      \"user_id\": \"67\",\n      \"friend_id\": \"67\",\n      \"message_type\": \"perfomance\",\n      \"type_id\": \"67\",\n      \"message\": \"Congrats. Your level has been upgraded to 32.\",\n      \"read\": \"1\",\n      \"created_at\": \"2016-03-17 12:27:49\",\n      \"updated_at\": \"2016-05-05 05:18:02\",\n      \"image\": \"67_1460107183.jpg\"\n    },\n    {\n      \"id\": \"550\",\n      \"user_id\": \"67\",\n      \"friend_id\": \"67\",\n      \"message_type\": \"perfomance\",\n      \"type_id\": \"67\",\n      \"message\": \"Congrats. Your level has been upgraded to 31.\",\n      \"read\": \"1\",\n      \"created_at\": \"2016-03-17 11:49:32\",\n      \"updated_at\": \"2016-05-05 05:18:02\",\n      \"image\": \"67_1460107183.jpg\"\n    },\n    {\n      \"id\": \"549\",\n      \"user_id\": \"67\",\n      \"friend_id\": \"67\",\n      \"message_type\": \"perfomance\",\n      \"type_id\": \"67\",\n      \"message\": \"Congrats. Your level has been upgraded to 30.\",\n      \"read\": \"1\",\n      \"created_at\": \"2016-03-17 10:55:03\",\n      \"updated_at\": \"2016-05-05 05:18:02\",\n      \"image\": \"67_1460107183.jpg\"\n    },\n    {\n      \"id\": \"548\",\n      \"user_id\": \"67\",\n      \"friend_id\": \"67\",\n      \"message_type\": \"perfomance\",\n      \"type_id\": \"67\",\n      \"message\": \"Congrats. Your level has been upgraded to 29.\",\n      \"read\": \"1\",\n      \"created_at\": \"2016-03-17 10:29:01\",\n      \"updated_at\": \"2016-05-05 05:18:02\",\n      \"image\": \"67_1460107183.jpg\"\n    },\n    {\n      \"id\": \"547\",\n      \"user_id\": \"67\",\n      \"friend_id\": \"67\",\n      \"message_type\": \"perfomance\",\n      \"type_id\": \"67\",\n      \"message\": \"Congrats. Your level has been upgraded to 28.\",\n      \"read\": \"1\",\n      \"created_at\": \"2016-03-17 09:54:53\",\n      \"updated_at\": \"2016-05-05 05:18:02\",\n      \"image\": \"67_1460107183.jpg\"\n    },\n    {\n      \"id\": \"546\",\n      \"user_id\": \"67\",\n      \"friend_id\": \"67\",\n      \"message_type\": \"perfomance\",\n      \"type_id\": \"67\",\n      \"message\": \"Congrats. Your level has been upgraded to 27.\",\n      \"read\": \"1\",\n      \"created_at\": \"2016-03-17 09:50:43\",\n      \"updated_at\": \"2016-05-05 05:18:02\",\n      \"image\": \"67_1460107183.jpg\"\n    },\n    {\n      \"id\": \"545\",\n      \"user_id\": \"67\",\n      \"friend_id\": \"67\",\n      \"message_type\": \"perfomance\",\n      \"type_id\": \"67\",\n      \"message\": \"Congrats. Your level has been upgraded to 26.\",\n      \"read\": \"1\",\n      \"created_at\": \"2016-03-17 09:03:52\",\n      \"updated_at\": \"2016-05-05 05:18:02\",\n      \"image\": \"67_1460107183.jpg\"\n    },\n    {\n      \"id\": \"544\",\n      \"user_id\": \"67\",\n      \"friend_id\": \"67\",\n      \"message_type\": \"perfomance\",\n      \"type_id\": \"67\",\n      \"message\": \"Congrats. Your level has been upgraded to 25.\",\n      \"read\": \"1\",\n      \"created_at\": \"2016-03-17 09:01:28\",\n      \"updated_at\": \"2016-05-05 05:18:02\",\n      \"image\": \"67_1460107183.jpg\"\n    },\n    {\n      \"id\": \"537\",\n      \"user_id\": \"67\",\n      \"friend_id\": \"67\",\n      \"message_type\": \"perfomance\",\n      \"type_id\": \"67\",\n      \"message\": \"Congrats. Your level has been upgraded to 24.\",\n      \"read\": \"1\",\n      \"created_at\": \"2016-03-15 11:04:31\",\n      \"updated_at\": \"2016-05-05 05:18:02\",\n      \"image\": \"67_1460107183.jpg\"\n    },\n    {\n      \"id\": \"536\",\n      \"user_id\": \"67\",\n      \"friend_id\": \"67\",\n      \"message_type\": \"perfomance\",\n      \"type_id\": \"67\",\n      \"message\": \"Congrats. Your level has been upgraded to 23.\",\n      \"read\": \"1\",\n      \"created_at\": \"2016-03-15 10:08:59\",\n      \"updated_at\": \"2016-05-05 05:18:02\",\n      \"image\": \"67_1460107183.jpg\"\n    },\n    {\n      \"id\": \"514\",\n      \"user_id\": \"1\",\n      \"friend_id\": \"67\",\n      \"message_type\": \"knowledge\",\n      \"type_id\": \"1032\",\n      \"message\": \"Team added a new message.\",\n      \"read\": \"1\",\n      \"created_at\": \"2016-03-13 16:53:59\",\n      \"updated_at\": \"2016-03-18 11:59:52\",\n      \"image\": \"1_1463145040.jpg\"\n    },\n    {\n      \"id\": \"493\",\n      \"user_id\": \"67\",\n      \"friend_id\": \"67\",\n      \"message_type\": \"perfomance\",\n      \"type_id\": \"67\",\n      \"message\": \"Congrats. Your level has been upgraded to 22.\",\n      \"read\": \"1\",\n      \"created_at\": \"2016-03-11 11:55:12\",\n      \"updated_at\": \"2016-05-05 05:18:02\",\n      \"image\": \"67_1460107183.jpg\"\n    },\n    {\n      \"id\": \"491\",\n      \"user_id\": \"67\",\n      \"friend_id\": \"67\",\n      \"message_type\": \"perfomance\",\n      \"type_id\": \"67\",\n      \"message\": \"Congrats. Your level has been upgraded to 21.\",\n      \"read\": \"1\",\n      \"created_at\": \"2016-03-11 10:07:29\",\n      \"updated_at\": \"2016-05-05 05:18:02\",\n      \"image\": \"67_1460107183.jpg\"\n    },\n    {\n      \"id\": \"483\",\n      \"user_id\": \"67\",\n      \"friend_id\": \"67\",\n      \"message_type\": \"perfomance\",\n      \"type_id\": \"67\",\n      \"message\": \"Congrats. Your level has been upgraded to 20.\",\n      \"read\": \"1\",\n      \"created_at\": \"2016-03-08 12:38:42\",\n      \"updated_at\": \"2016-05-05 05:18:02\",\n      \"image\": \"67_1460107183.jpg\"\n    },\n    {\n      \"id\": \"462\",\n      \"user_id\": \"67\",\n      \"friend_id\": \"67\",\n      \"message_type\": \"perfomance\",\n      \"type_id\": \"67\",\n      \"message\": \"Congrats. Your level has been upgraded to 19.\",\n      \"read\": \"1\",\n      \"created_at\": \"2016-03-03 09:23:46\",\n      \"updated_at\": \"2016-05-05 05:18:02\",\n      \"image\": \"67_1460107183.jpg\"\n    },\n    {\n      \"id\": \"458\",\n      \"user_id\": \"67\",\n      \"friend_id\": \"67\",\n      \"message_type\": \"perfomance\",\n      \"type_id\": \"67\",\n      \"message\": \"Congrats. Your level has been upgraded to 18.\",\n      \"read\": \"1\",\n      \"created_at\": \"2016-02-24 05:08:42\",\n      \"updated_at\": \"2016-05-05 05:18:02\",\n      \"image\": \"67_1460107183.jpg\"\n    },\n    {\n      \"id\": \"448\",\n      \"user_id\": \"67\",\n      \"friend_id\": \"67\",\n      \"message_type\": \"perfomance\",\n      \"type_id\": \"67\",\n      \"message\": \"Congrats. Your level has been upgraded to 17.\",\n      \"read\": \"1\",\n      \"created_at\": \"2016-02-19 14:05:15\",\n      \"updated_at\": \"2016-05-05 05:18:02\",\n      \"image\": \"67_1460107183.jpg\"\n    },\n    {\n      \"id\": \"437\",\n      \"user_id\": \"67\",\n      \"friend_id\": \"67\",\n      \"message_type\": \"perfomance\",\n      \"type_id\": \"67\",\n      \"message\": \"Congrats. Your level has been upgraded to 16.\",\n      \"read\": \"1\",\n      \"created_at\": \"2016-02-18 09:53:55\",\n      \"updated_at\": \"2016-05-05 05:18:02\",\n      \"image\": \"67_1460107183.jpg\"\n    },\n    {\n      \"id\": \"435\",\n      \"user_id\": \"67\",\n      \"friend_id\": \"67\",\n      \"message_type\": \"perfomance\",\n      \"type_id\": \"67\",\n      \"message\": \"Congrats. Your level has been upgraded to 15.\",\n      \"read\": \"1\",\n      \"created_at\": \"2016-02-17 11:39:52\",\n      \"updated_at\": \"2016-05-05 05:18:02\",\n      \"image\": \"67_1460107183.jpg\"\n    },\n    {\n      \"id\": \"434\",\n      \"user_id\": \"67\",\n      \"friend_id\": \"67\",\n      \"message_type\": \"perfomance\",\n      \"type_id\": \"67\",\n      \"message\": \"Congrats. Your level has been upgraded to 14.\",\n      \"read\": \"1\",\n      \"created_at\": \"2016-02-17 11:01:16\",\n      \"updated_at\": \"2016-05-05 05:18:02\",\n      \"image\": \"67_1460107183.jpg\"\n    },\n    {\n      \"id\": \"433\",\n      \"user_id\": \"67\",\n      \"friend_id\": \"67\",\n      \"message_type\": \"perfomance\",\n      \"type_id\": \"67\",\n      \"message\": \"Congrats. Your level has been upgraded to 13.\",\n      \"read\": \"1\",\n      \"created_at\": \"2016-02-17 08:59:44\",\n      \"updated_at\": \"2016-05-05 05:18:02\",\n      \"image\": \"67_1460107183.jpg\"\n    },\n    {\n      \"id\": \"432\",\n      \"user_id\": \"67\",\n      \"friend_id\": \"67\",\n      \"message_type\": \"perfomance\",\n      \"type_id\": \"67\",\n      \"message\": \"Congrats. Your level has been upgraded to 12.\",\n      \"read\": \"1\",\n      \"created_at\": \"2016-02-17 07:02:02\",\n      \"updated_at\": \"2016-05-05 05:18:02\",\n      \"image\": \"67_1460107183.jpg\"\n    },\n    {\n      \"id\": \"430\",\n      \"user_id\": \"67\",\n      \"friend_id\": \"67\",\n      \"message_type\": \"perfomance\",\n      \"type_id\": \"67\",\n      \"message\": \"Congrats. Your level has been upgraded to 11.\",\n      \"read\": \"1\",\n      \"created_at\": \"2016-02-17 06:44:30\",\n      \"updated_at\": \"2016-05-05 05:18:02\",\n      \"image\": \"67_1460107183.jpg\"\n    },\n    {\n      \"id\": \"429\",\n      \"user_id\": \"67\",\n      \"friend_id\": \"67\",\n      \"message_type\": \"perfomance\",\n      \"type_id\": \"67\",\n      \"message\": \"Congrats. Your level has been upgraded to 10.\",\n      \"read\": \"1\",\n      \"created_at\": \"2016-02-17 06:41:16\",\n      \"updated_at\": \"2016-05-05 05:18:02\",\n      \"image\": \"67_1460107183.jpg\"\n    },\n    {\n      \"id\": \"427\",\n      \"user_id\": \"67\",\n      \"friend_id\": \"67\",\n      \"message_type\": \"perfomance\",\n      \"type_id\": \"67\",\n      \"message\": \"Congrats. Your level has been upgraded to 9.\",\n      \"read\": \"1\",\n      \"created_at\": \"2016-02-17 06:28:33\",\n      \"updated_at\": \"2016-05-05 05:18:02\",\n      \"image\": \"67_1460107183.jpg\"\n    },\n    {\n      \"id\": \"426\",\n      \"user_id\": \"67\",\n      \"friend_id\": \"67\",\n      \"message_type\": \"perfomance\",\n      \"type_id\": \"67\",\n      \"message\": \"Congrats. Your level has been upgraded to 8.\",\n      \"read\": \"1\",\n      \"created_at\": \"2016-02-17 06:20:13\",\n      \"updated_at\": \"2016-05-05 05:18:02\",\n      \"image\": \"67_1460107183.jpg\"\n    },\n    {\n      \"id\": \"425\",\n      \"user_id\": \"67\",\n      \"friend_id\": \"67\",\n      \"message_type\": \"perfomance\",\n      \"type_id\": \"67\",\n      \"message\": \"Congrats. Your level has been upgraded to 7.\",\n      \"read\": \"1\",\n      \"created_at\": \"2016-02-17 05:52:29\",\n      \"updated_at\": \"2016-05-05 05:18:02\",\n      \"image\": \"67_1460107183.jpg\"\n    },\n    {\n      \"id\": \"421\",\n      \"user_id\": \"67\",\n      \"friend_id\": \"67\",\n      \"message_type\": \"perfomance\",\n      \"type_id\": \"67\",\n      \"message\": \"Congrats. Your level has been upgraded to 6.\",\n      \"read\": \"1\",\n      \"created_at\": \"2016-02-15 09:39:32\",\n      \"updated_at\": \"2016-05-05 05:18:02\",\n      \"image\": \"67_1460107183.jpg\"\n    },\n    {\n      \"id\": \"419\",\n      \"user_id\": \"67\",\n      \"friend_id\": \"67\",\n      \"message_type\": \"perfomance\",\n      \"type_id\": \"67\",\n      \"message\": \"Congrats. Your level has been upgraded to 5.\",\n      \"read\": \"1\",\n      \"created_at\": \"2016-02-12 15:20:21\",\n      \"updated_at\": \"2016-05-05 05:18:02\",\n      \"image\": \"67_1460107183.jpg\"\n    },\n    {\n      \"id\": \"417\",\n      \"user_id\": \"67\",\n      \"friend_id\": \"67\",\n      \"message_type\": \"perfomance\",\n      \"type_id\": \"67\",\n      \"message\": \"Congrats. Your level has been upgraded to 3.\",\n      \"read\": \"1\",\n      \"created_at\": \"2016-02-12 15:07:54\",\n      \"updated_at\": \"2016-05-05 05:18:02\",\n      \"image\": \"67_1460107183.jpg\"\n    }\n  ],\n  \"unread_notification_count\": 6,\n  \"urls\": {\n    \"profileImageSmall\": \"http://testing.ykings.com/uploads/images/profile/small\",\n    \"profileImageMedium\": \"http://testing.ykings.com/uploads/images/profile/medium\",\n    \"profileImageLarge\": \"http://testing.ykings.com/uploads/images/profile/large\",\n    \"profileImageOriginal\": \"http://testing.ykings.com/uploads/images/profile/original\",\n    \"video\": \"http://testing.ykings.com/uploads/videos\",\n    \"videothumbnail\": \"http://testing.ykings.com/uploads/images/videothumbnails\",\n    \"feedImageSmall\": \"http://testing.ykings.com/uploads/images/feed/small\",\n    \"feedImageMedium\": \"http://testing.ykings.com/uploads/images/feed/medium\",\n    \"feedImageLarge\": \"http://testing.ykings.com/uploads/images/feed/large\",\n    \"feedImageOriginal\": \"http://testing.ykings.com/uploads/images/feed/original\",\n    \"coverImageSmall\": \"http://testing.ykings.com/uploads/images/cover_image/small\",\n    \"coverImageMedium\": \"http://testing.ykings.com/uploads/images/cover_image/medium\",\n    \"coverImageLarge\": \"http://testing.ykings.com/uploads/images/cover_image/large\",\n    \"coverImageOriginal\": \"http://testing.ykings.com/uploads/images/cover_image/original\"\n  }\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "error",
            "description": "<p>Message token_invalid.</p> "
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 400 Invalid Request\n{\n  \"status\" : 0,\n  \"error\": \"token_invalid\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 401 Unauthorised\n{\n  \"status\" : 0,\n  \"error\": \"token_expired\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 400 Bad Request\n{\n  \"status\" : 0,\n  \"error\": \"token_not_provided\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 400 Validation error\n{\n  \"status\" : 0,\n  \"error\": \"The user_id field is required\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 400 user_not_exists\n{\n  \"status\" : 0,\n  \"error\": \"user_not_exists\"\n}",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "app/Http/Controllers/Api/MessageController.php",
    "groupTitle": "Message"
  },
  {
    "type": "post",
    "url": "/message/updateReadStatus",
    "title": "updateReadStatus",
    "name": "updateReadStatus",
    "group": "Message",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "<p>Number</p> ",
            "optional": false,
            "field": "user_id",
            "description": "<p>Id of user *required</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>Number</p> ",
            "optional": false,
            "field": "message_id",
            "description": "<p>message of user *required</p> "
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "<p>String</p> ",
            "optional": false,
            "field": "success.",
            "description": ""
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n{\n          \"status\": 1,\n          \"success\": \"Successfully Updated\",\n          \"unread_notification_count\": 5\n        }",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "error",
            "description": "<p>Message token_invalid.</p> "
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 400 Invalid Request\n{\n  \"status\" : 0,\n  \"error\": \"token_invalid\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 401 Unauthorised\n{\n  \"status\" : 0,\n  \"error\": \"token_expired\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 400 Bad Request\n{\n  \"status\" : 0,\n  \"error\": \"token_not_provided\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 400 Validation error\n{\n  \"status\" : 0,\n  \"error\": \"The user_id field is required\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 400 user_not_exists\n{\n  \"status\" : 0,\n  \"error\": \"user_not_exists\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 400 user_not_exists\n {\n             \"status\": 0,\n             \"error\": \"message_not_exists\"\n         }",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "app/Http/Controllers/Api/MessageController.php",
    "groupTitle": "Message"
  },
  {
    "type": "post",
    "url": "/search/cityUsers",
    "title": "cityUsers",
    "name": "cityUsers",
    "group": "Search",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "<p>Number</p> ",
            "optional": false,
            "field": "user_id",
            "description": "<p>Id of user *required</p> "
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "<p>String</p> ",
            "optional": false,
            "field": "success.",
            "description": ""
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n{\n      \"status\": 1,\n      \"success\": \"List\",\n      \"search_result\": [\n      {\n      \"id\": \"25\",\n      \"user_id\": \"25\",\n      \"first_name\": \"nex\",\n      \"last_name\": \"testing\",\n      \"gender\": \"0\",\n      \"fitness_status\": \"2\",\n      \"goal\": \"3\",\n      \"image\": \"25_1453974118.jpg\",\n      \"cover_image\": \"25_1453974119.jpg\",\n      \"city\": \"kochi\",\n      \"state\": \"\",\n      \"country\": \"\",\n      \"spot\": \"home\",\n      \"quote\": \"my new motivation here\",\n      \"facebook\": \"\",\n      \"twitter\": \"\",\n      \"instagram\": \"\",\n      \"created_at\": \"2016-01-27 19:23:43\",\n      \"updated_at\": \"2016-01-28 09:41:59\",\n      \"level\": 1,\n      \"is_following\": 0\n      },\n      {\n      \"id\": \"28\",\n      \"user_id\": \"28\",\n      \"first_name\": \"Patrick\",\n      \"last_name\": \"John\",\n      \"gender\": \"1\",\n      \"fitness_status\": \"3\",\n      \"goal\": \"1\",\n      \"image\": \"28_1453979338.jpg\",\n      \"cover_image\": \"\",\n      \"city\": \"kochi\",\n      \"state\": \"\",\n      \"country\": \"\",\n      \"spot\": \"infopark\",\n      \"quote\": \"to fit\",\n      \"facebook\": \"\",\n      \"twitter\": \"\",\n      \"instagram\": \"\",\n      \"created_at\": \"2016-01-28 11:08:57\",\n      \"updated_at\": \"2016-02-04 08:31:24\",\n      \"level\": 1,\n      \"is_following\": 0\n      }\n      ],\n      \"urls\": {\n      \"profileImageSmall\": \"http://sandbox.ykings.com/uploads/images/profile/small\",\n      \"profileImageMedium\": \"http://sandbox.ykings.com/uploads/images/profile/medium\",\n      \"profileImageLarge\": \"http://sandbox.ykings.com/uploads/images/profile/large\",\n      \"profileImageOriginal\": \"http://sandbox.ykings.com/uploads/images/profile/original\",\n      \"video\": \"http://sandbox.ykings.com/uploads/videos\",\n      \"videothumbnail\": \"http://sandbox.ykings.com/uploads/images/videothumbnails\",\n      \"feedImageSmall\": \"http://sandbox.ykings.com/uploads/images/feed/small\",\n      \"feedImageMedium\": \"http://sandbox.ykings.com/uploads/images/feed/medium\",\n      \"feedImageLarge\": \"http://sandbox.ykings.com/uploads/images/feed/large\",\n      \"feedImageOriginal\": \"http://sandbox.ykings.com/uploads/images/feed/original\",\n      \"coverImageSmall\": \"http://sandbox.ykings.com/uploads/images/cover_image/small\",\n      \"coverImageMedium\": \"http://sandbox.ykings.com/uploads/images/cover_image/medium\",\n      \"coverImageLarge\": \"http://sandbox.ykings.com/uploads/images/cover_image/large\",\n      \"coverImageOriginal\": \"http://sandbox.ykings.com/uploads/images/cover_image/original\"\n      }\n      }",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "error",
            "description": "<p>Message token_invalid.</p> "
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 400 Invalid Request\n{\n  \"status\" : 0,\n  \"error\": \"token_invalid\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 401 Unauthorised\n{\n  \"status\" : 0,\n  \"error\": \"token_expired\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 400 Bad Request\n{\n  \"status\" : 0,\n  \"error\": \"token_not_provided\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 400 Validation error\n{\n  \"status\" : 0,\n  \"error\": \"The user_id field is required\"\n}",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "app/Http/Controllers/Api/SearchController.php",
    "groupTitle": "Search"
  },
  {
    "type": "post",
    "url": "/search/featuredUsers",
    "title": "featuredUsers",
    "name": "featuredUsers",
    "group": "Search",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "<p>Number</p> ",
            "optional": false,
            "field": "user_id",
            "description": "<p>Id of user *required</p> "
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "<p>String</p> ",
            "optional": false,
            "field": "success.",
            "description": ""
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n{\n      \"status\": 1,\n      \"success\": \"List\",\n      \"search_result\": [\n      {\n      \"id\": \"1\",\n      \"user_id\": \"1\",\n      \"first_name\": \"Ykings\",\n      \"last_name\": \"Administrator\",\n      \"gender\": \"0\",\n      \"fitness_status\": \"0\",\n      \"goal\": \"3\",\n      \"image\": \"1_1454051488.jpg\",\n      \"cover_image\": \"\",\n      \"city\": \"\",\n      \"state\": \"\",\n      \"country\": \"United States\",\n      \"spot\": \"\",\n      \"quote\": \"\",\n      \"facebook\": \"\",\n      \"twitter\": \"\",\n      \"instagram\": \"\",\n      \"created_at\": \"2015-11-06 06:44:48\",\n      \"updated_at\": \"2016-01-29 07:11:28\",\n      \"level\": 3,\n      \"is_following\": 1\n      },\n      {\n      \"id\": \"11\",\n      \"user_id\": \"11\",\n      \"first_name\": \"Aneesh\",\n      \"last_name\": \"Kallikkattil\",\n      \"gender\": \"1\",\n      \"fitness_status\": \"3\",\n      \"goal\": \"1\",\n      \"image\": \"\",\n      \"cover_image\": \"\",\n      \"city\": \"kochi\",\n      \"state\": \"\",\n      \"country\": \"\",\n      \"spot\": \"\",\n      \"quote\": \"Sample Quote Changed Again\",\n      \"facebook\": \"\",\n      \"twitter\": \"\",\n      \"instagram\": \"\",\n      \"created_at\": \"2016-01-25 11:40:35\",\n      \"updated_at\": \"2016-02-04 08:31:30\",\n      \"level\": 4,\n      \"is_following\": 1\n      },\n      {\n      \"id\": \"15\",\n      \"user_id\": \"15\",\n      \"first_name\": \"Aneesh \",\n      \"last_name\": \"Ileaf \",\n      \"gender\": \"0\",\n      \"fitness_status\": \"1\",\n      \"goal\": \"1\",\n      \"image\": \"15_1454308286.jpg\",\n      \"cover_image\": \"15_1454321250.jpg\",\n      \"city\": \"\",\n      \"state\": \"\",\n      \"country\": \"\",\n      \"spot\": \"\",\n      \"quote\": \"Good management is what happens when the manager is not there. :) :)\",\n      \"facebook\": \"\",\n      \"twitter\": \"\",\n      \"instagram\": \"\",\n      \"created_at\": \"2016-01-27 03:49:19\",\n      \"updated_at\": \"2016-02-01 10:07:30\",\n      \"level\": 14,\n      \"is_following\": 0\n      }\n      ],\n      \"urls\": {\n      \"profileImageSmall\": \"http://sandbox.ykings.com/uploads/images/profile/small\",\n      \"profileImageMedium\": \"http://sandbox.ykings.com/uploads/images/profile/medium\",\n      \"profileImageLarge\": \"http://sandbox.ykings.com/uploads/images/profile/large\",\n      \"profileImageOriginal\": \"http://sandbox.ykings.com/uploads/images/profile/original\",\n      \"video\": \"http://sandbox.ykings.com/uploads/videos\",\n      \"videothumbnail\": \"http://sandbox.ykings.com/uploads/images/videothumbnails\",\n      \"feedImageSmall\": \"http://sandbox.ykings.com/uploads/images/feed/small\",\n      \"feedImageMedium\": \"http://sandbox.ykings.com/uploads/images/feed/medium\",\n      \"feedImageLarge\": \"http://sandbox.ykings.com/uploads/images/feed/large\",\n      \"feedImageOriginal\": \"http://sandbox.ykings.com/uploads/images/feed/original\",\n      \"coverImageSmall\": \"http://sandbox.ykings.com/uploads/images/cover_image/small\",\n      \"coverImageMedium\": \"http://sandbox.ykings.com/uploads/images/cover_image/medium\",\n      \"coverImageLarge\": \"http://sandbox.ykings.com/uploads/images/cover_image/large\",\n      \"coverImageOriginal\": \"http://sandbox.ykings.com/uploads/images/cover_image/original\"\n      }\n      }",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "error",
            "description": "<p>Message token_invalid.</p> "
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 400 Invalid Request\n{\n  \"status\" : 0,\n  \"error\": \"token_invalid\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 401 Unauthorised\n{\n  \"status\" : 0,\n  \"error\": \"token_expired\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 400 Bad Request\n{\n  \"status\" : 0,\n  \"error\": \"token_not_provided\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 400 Validation error\n{\n  \"status\" : 0,\n  \"error\": \"The user_id field is required\"\n}",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "app/Http/Controllers/Api/SearchController.php",
    "groupTitle": "Search"
  },
  {
    "type": "post",
    "url": "/search/searchUser",
    "title": "searchUser",
    "name": "searchUser",
    "group": "Search",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "<p>Number</p> ",
            "optional": false,
            "field": "user_id",
            "description": "<p>Id of user *required</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>String</p> ",
            "optional": false,
            "field": "search_key",
            "description": "<p>search key *required</p> "
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "<p>String</p> ",
            "optional": false,
            "field": "success.",
            "description": ""
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n{\n      \"status\": 1,\n      \"success\": \"List\",\n      \"search_result\": [\n      {\n      \"user_id\": \"11\",\n      \"first_name\": \"ansaaaaa\",\n      \"last_name\": \"\",\n      \"image\": \"11_1447237788.jpg\",\n      \"quote\": \"\",\n      \"level\": 1,\n      \"is_following\": 0\n\n      },\n      {\n      \"user_id\": \"14\",\n      \"first_name\": \"sachii\",\n      \"last_name\": \"k\",\n      \"image\": null,\n      \"quote\": \"\",\n      \"level\": 1,\n      \"is_following\": 0\n      }\n      ],\n      \"urls\": {\n      \"profileImageSmall\": \"http://sandbox.ykings.com/uploads/images/profile/small\",\n      \"profileImageMedium\": \"http://sandbox.ykings.com/uploads/images/profile/medium\",\n      \"profileImageLarge\": \"http://sandbox.ykings.com/uploads/images/profile/large\",\n      \"profileImageOriginal\": \"http://sandbox.ykings.com/uploads/images/profile/original\",\n      \"video\": \"http://sandbox.ykings.com/uploads/videos\",\n      \"videothumbnail\": \"http://sandbox.ykings.com/uploads/images/videothumbnails\",\n      \"feedImageSmall\": \"http://sandbox.ykings.com/uploads/images/feed/small\",\n      \"feedImageMedium\": \"http://sandbox.ykings.com/uploads/images/feed/medium\",\n      \"feedImageLarge\": \"http://sandbox.ykings.com/uploads/images/feed/large\",\n      \"feedImageOriginal\": \"http://sandbox.ykings.com/uploads/images/feed/original\",\n      \"coverImageSmall\": \"http://sandbox.ykings.com/uploads/images/cover_image/small\",\n      \"coverImageMedium\": \"http://sandbox.ykings.com/uploads/images/cover_image/medium\",\n      \"coverImageLarge\": \"http://sandbox.ykings.com/uploads/images/cover_image/large\",\n      \"coverImageOriginal\": \"http://sandbox.ykings.com/uploads/images/cover_image/original\"\n      }\n      }",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "error",
            "description": "<p>Message token_invalid.</p> "
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 400 Invalid Request\n{\n  \"status\" : 0,\n  \"error\": \"token_invalid\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 401 Unauthorised\n{\n  \"status\" : 0,\n  \"error\": \"token_expired\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 400 Bad Request\n{\n  \"status\" : 0,\n  \"error\": \"token_not_provided\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 400 Validation error\n{\n  \"status\" : 0,\n  \"error\": \"The user_id field is required\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 400 Validation error\n{\n  \"status\" : 0,\n  \"error\": \"The search_key field is required.\"\n}",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "app/Http/Controllers/Api/SearchController.php",
    "groupTitle": "Search"
  },
  {
    "type": "post",
    "url": "/user/getsettings",
    "title": "getUserSettings",
    "name": "getUserSettings",
    "group": "Settings",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "<p>Number</p> ",
            "optional": false,
            "field": "user_id",
            "description": "<p>Id of user *required</p> "
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "<p>String</p> ",
            "optional": false,
            "field": "success.",
            "description": ""
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n{\n      \"status\": 1,\n      \"settings\": [\n      {\n      \"id\": \"22\",\n      \"user_id\": \"41\",\n      \"key\": \"subscription\",\n      \"value\": 1,\n      \"created_at\": \"2015-12-03 04:22:37\",\n      \"updated_at\": \"2015-12-03 04:28:18\"\n      },\n      {\n      \"id\": \"23\",\n      \"user_id\": \"41\",\n      \"key\": \"notification\",\n      \"value\": {\n      \"comments\": \"1\",\n      \"claps\": \"0\",\n      \"follow\": \"0\",\n      \"my_performance\": \"1\",\n      \"motivation_knowledge\": \"1\"\n      },\n      \"created_at\": \"2015-12-03 04:22:37\",\n      \"updated_at\": \"2015-12-03 06:13:52\"\n      }\n      ],\n      \"facebook_connect\": 0\n      }",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "error",
            "description": "<p>Message token_invalid.</p> "
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 400 Invalid Request\n{\n  \"status\" : 0,\n  \"error\": \"token_invalid\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 401 Unauthorised\n{\n  \"status\" : 0,\n  \"error\": \"token_expired\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 400 Bad Request\n{\n  \"status\" : 0,\n  \"error\": \"token_not_provided\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 400 Validation error\n{\n  \"status\" : 0,\n  \"error\": \"The user_id field is required\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 400 user_not_exists\n{\n  \"status\" : 0,\n  \"error\": \"user_not_exists\"\n}",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "app/Http/Controllers/Api/UserSettingsController.php",
    "groupTitle": "Settings"
  },
  {
    "type": "post",
    "url": "/user/getsettings",
    "title": "getUserSettings",
    "name": "getUserSettings",
    "group": "Settings",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "<p>Number</p> ",
            "optional": false,
            "field": "user_id",
            "description": "<p>Id of user *required</p> "
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "<p>String</p> ",
            "optional": false,
            "field": "success.",
            "description": ""
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n{\n      \"status\": 1,\n      \"settings\": [\n      {\n      \"id\": \"2\",\n      \"user_id\": \"2\",\n      \"key\": \"notification\",\n      \"value\": [\n      {\n      \"comments\": \"1\"\n      },\n      {\n      \"claps\": \"0\"\n      },\n      {\n      \"follow\": \"0\"\n      },\n      {\n      \"my_performance\": \"1\"\n      },\n      {\n      \"motivation_knowledge\": \"1\"\n      }\n      ],\n      \"created_at\": \"2015-11-20 00:00:00\",\n      \"updated_at\": \"2015-11-20 06:33:00\"\n      },\n      {\n      \"id\": \"3\",\n      \"user_id\": \"2\",\n      \"key\": \"subscription\",\n      \"value\": 1,\n      \"created_at\": \"2015-11-20 00:00:00\",\n      \"updated_at\": \"2015-11-20 06:33:27\"\n      }\n      ]\n      }",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "error",
            "description": "<p>Message token_invalid.</p> "
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 400 Invalid Request\n{\n  \"status\" : 0,\n  \"error\": \"token_invalid\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 401 Unauthorised\n{\n  \"status\" : 0,\n  \"error\": \"token_expired\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 400 Bad Request\n{\n  \"status\" : 0,\n  \"error\": \"token_not_provided\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 400 Validation error\n{\n  \"status\" : 0,\n  \"error\": \"The user_id field is required\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 400 user_not_exists\n{\n  \"status\" : 0,\n  \"error\": \"user_not_exists\"\n}",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "app/Http/Controllers/Api/SearchController.php",
    "groupTitle": "Settings"
  },
  {
    "type": "post",
    "url": "/user/updateDeviceToken",
    "title": "updateDeviceToken",
    "name": "updateDeviceToken",
    "group": "Settings",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "<p>Number</p> ",
            "optional": false,
            "field": "user_id",
            "description": "<p>Id of user *required</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>String</p> ",
            "optional": false,
            "field": "device_token",
            "description": "<p>device_token of user *required</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>String</p> ",
            "optional": false,
            "field": "type",
            "description": "<p>device type (ios/android) *required</p> "
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "<p>String</p> ",
            "optional": false,
            "field": "success.",
            "description": ""
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "error",
            "description": "<p>Message token_invalid.</p> "
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 400 Invalid Request\n{\n  \"status\" : 0,\n  \"error\": \"token_invalid\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 401 Unauthorised\n{\n  \"status\" : 0,\n  \"error\": \"token_expired\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 400 Bad Request\n{\n  \"status\" : 0,\n  \"error\": \"token_not_provided\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 400 Validation error\n{\n  \"status\" : 0,\n  \"error\": \"The user_id field is required\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 400 user_not_exists\n{\n  \"status\" : 0,\n  \"error\": \"user_not_exists\"\n}",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "app/Http/Controllers/Api/UserSettingsController.php",
    "groupTitle": "Settings"
  },
  {
    "type": "post",
    "url": "/user/settings",
    "title": "updateUserSettings",
    "name": "updateUserSettings",
    "group": "Settings",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "<p>Number</p> ",
            "optional": false,
            "field": "user_id",
            "description": "<p>Id of user *required</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>String</p> ",
            "optional": false,
            "field": "settings_key",
            "description": "<p>notification/subscription *required</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>String</p> ",
            "optional": false,
            "field": "status",
            "description": "<p>json array of {&quot;comments&quot;:&quot;1&quot;,&quot;claps&quot;:&quot;0&quot;,&quot;follow&quot;:&quot;0&quot;,&quot;my_performance&quot;:&quot;1&quot;,&quot;motivation_knowledge&quot;:&quot;1&quot;}</p> "
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "<p>String</p> ",
            "optional": false,
            "field": "success.",
            "description": ""
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n{\n      \"status\": 1,\n      \"success\": \"successfully_updated\",\n      \"user\": {\n      \"id\": \"41\",\n      \"email\": \"arun@ileafsolutions.net\",\n      \"confirmation_code\": \"\",\n      \"status\": \"1\",\n      \"created_at\": \"2015-11-16 09:54:09\",\n      \"updated_at\": \"2015-11-16 11:02:47\",\n      \"is_subscribed\": 0,\n      \"settings\": [\n      {\n      \"id\": \"22\",\n      \"user_id\": \"41\",\n      \"key\": \"subscription\",\n      \"value\": \"1\",\n      \"created_at\": \"2015-12-03 04:22:37\",\n      \"updated_at\": \"2015-12-03 06:24:07\"\n      },\n      {\n      \"id\": \"23\",\n      \"user_id\": \"41\",\n      \"key\": \"notification\",\n      \"value\": \"{\\\"comments\\\":\\\"1\\\",\\\"claps\\\":\\\"0\\\",\\\"follow\\\":\\\"0\\\",\\\"my_performance\\\":\\\"1\\\",\\\"motivation_knowledge\\\":\\\"1\\\"}\",\n      \"created_at\": \"2015-12-03 04:22:37\",\n      \"updated_at\": \"2015-12-03 06:13:52\"\n      }\n      ]\n      }\n      }",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "error",
            "description": "<p>Message token_invalid.</p> "
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 400 Invalid Request\n{\n  \"status\" : 0,\n  \"error\": \"token_invalid\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 401 Unauthorised\n{\n  \"status\" : 0,\n  \"error\": \"token_expired\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 400 Bad Request\n{\n  \"status\" : 0,\n  \"error\": \"token_not_provided\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 400 Validation error\n{\n  \"status\" : 0,\n  \"error\": \"The user_id field is required\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 400 Validation error\n{\n  \"status\" : 0,\n  \"error\": \"The settings_key field is required\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 400 Validation error\n{\n  \"status\" : 0,\n  \"error\": \"The status field is required.\"\n}",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "app/Http/Controllers/Api/UserSettingsController.php",
    "groupTitle": "Settings"
  },
  {
    "type": "post",
    "url": "/skills/getlevelskills",
    "title": "getLevelSkills",
    "name": "getLevelSkills",
    "group": "Skill",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "<p>Number</p> ",
            "optional": false,
            "field": "user_id",
            "description": "<p>Id of user *required</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>Number</p> ",
            "optional": false,
            "field": "skill_id",
            "description": "<p>Id of skill *required</p> "
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "<p>String</p> ",
            "optional": false,
            "field": "success.",
            "description": ""
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n{\n      \"status\": 1,\n      \"skills\": [\n      {\n      \"id\": \"5\",\n      \"description\": \"Expose yourself to packed shoulders and hang time.\",\n      \"progression_id\": \"1\",\n      \"level\": \"1\",\n      \"row\": \"1\",\n      \"substitute\": \"68\",\n      \"exercise_id\": \"69\",\n      \"created_at\": \"2023-01-16 06:06:00\",\n      \"updated_at\": \"2023-01-16 06:06:00\",\n      \"is_selected\": 0,\n      \"isLocked\": 0,\n      \"isLockable\": 0,\n      \"isUnlockable\": 0,\n      \"exercise\": {\n      \"id\": \"69\",\n      \"name\": \"Jumping Pullups\",\n      \"description\": \"Expose yourself to packed shoulders and hang time.\",\n      \"category\": \"1\",\n      \"type\": \"1\",\n      \"muscle_groups\": \"\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \" \\\"1. Grip a bar and jump into the top position of the pull-up exercise\\r\\n2. Straight legs in front of you. \\r\\n3. Slowly go down into a deadhang position\\\"\\r\\n \",\n      \"video_tips\": \"  \",\n      \"pro_tips\": \" \\\"A deadhang postion requires your shoulder blades down or towards the spine with arms being straight (retraction)\\r\\nAim for three second holds at the top and go down slowly\\\"\\r\\n \",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"\",\n      \"video\": [\n      {\n      \"id\": \"74\",\n      \"path\": \"69_1454045392.mp4\",\n      \"videothumbnail\": \"69_1454045392.jpg\",\n      \"description\": \"\"\n      }\n      ]\n      }\n      },\n      {\n      \"id\": \"4\",\n      \"description\": \"Develop your back strength with slow, controlled and strict movements.\",\n      \"progression_id\": \"1\",\n      \"level\": \"2\",\n      \"row\": \"1\",\n      \"substitute\": \"0\",\n      \"exercise_id\": \"68\",\n      \"created_at\": \"2022-01-16 06:06:00\",\n      \"updated_at\": \"2022-01-16 06:06:00\",\n      \"is_selected\": 0,\n      \"isLocked\": 1,\n      \"isLockable\": 0,\n      \"isUnlockable\": 1,\n      \"exercise\": {\n      \"id\": \"68\",\n      \"name\": \"Supported Pullups\",\n      \"description\": \"Develop your back strength with slow, controlled and strict movements.\",\n      \"category\": \"1\",\n      \"type\": \"1\",\n      \"muscle_groups\": \"\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \" \\\"1. Start from a retracted deadhang position\\r\\n2. Keep neck in neutral position at all times\\r\\n3. Pull up till chin is above the bar\\r\\n4. Go down controlled\\\"\\r\\n \",\n      \"video_tips\": \"  \",\n      \"pro_tips\": \" Use a partner, bench or resistance bands to help you during the exercise.\\r\\n \",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"\",\n      \"video\": [\n      {\n      \"id\": \"73\",\n      \"path\": \"68_1454045293.mp4\",\n      \"videothumbnail\": \"68_1454045293.jpg\",\n      \"description\": \"\"\n      }\n      ]\n      }\n      },\n      {\n      \"id\": \"3\",\n      \"description\": \"Experience the beauty of strict pullups to build insane upper body strength.\",\n      \"progression_id\": \"1\",\n      \"level\": \"3\",\n      \"row\": \"1\",\n      \"substitute\": \"66\",\n      \"exercise_id\": \"67\",\n      \"created_at\": \"2021-01-16 06:06:00\",\n      \"updated_at\": \"2021-01-16 06:06:00\",\n      \"is_selected\": 0,\n      \"isLocked\": 1,\n      \"isLockable\": 0,\n      \"isUnlockable\": 0,\n      \"exercise\": {\n      \"id\": \"67\",\n      \"name\": \"Pullups/Chinups\",\n      \"description\": \"Experience the beauty of strict pullups to build insane upper body strength.\",\n      \"category\": \"2\",\n      \"type\": \"1\",\n      \"muscle_groups\": \"\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \" \\\"1. Start from a retracted deadhang position\\r\\n2. Legs in front of you, don't swing\\r\\n3. Pull up till chin is above the bar\\r\\n4. Pause at the top of the exercise and then lower back down under control. \\r\\n5. Return to the starting position and repeat.\\\"\\r\\n \",\n      \"video_tips\": \"  \",\n      \"pro_tips\": \" \\\"You might switch grips to build all muscles simultaneously. Try close and wide grip and underhand and overhand pullups.\\r\\nYou want to go up fast but slowly and controlled into the deadhang.\\\"\\r\\n \",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"\",\n      \"video\": [\n      {\n      \"id\": \"72\",\n      \"path\": \"67_1454045247.mp4\",\n      \"videothumbnail\": \"67_1454045247.jpg\",\n      \"description\": \"\"\n      }\n      ]\n      }\n      },\n      {\n      \"id\": \"2\",\n      \"description\": \"Do your first explosive and dynamic element in order to build the strength and muscle memory to master one more step.\",\n      \"progression_id\": \"1\",\n      \"level\": \"4\",\n      \"row\": \"1\",\n      \"substitute\": \"0\",\n      \"exercise_id\": \"66\",\n      \"created_at\": \"2020-01-16 06:06:00\",\n      \"updated_at\": \"2020-01-16 06:06:00\",\n      \"is_selected\": 0,\n      \"isLocked\": 1,\n      \"isLockable\": 0,\n      \"isUnlockable\": 0,\n      \"exercise\": {\n      \"id\": \"66\",\n      \"name\": \"Explosive Pullups\",\n      \"description\": \"Do your first explosive and dynamic element in order to build the strength and muscle memory to master one more step.\",\n      \"category\": \"2\",\n      \"type\": \"1\",\n      \"muscle_groups\": \"\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \" \\\"1. Start from a retracted deadhang position\\r\\n2. Legs in front of you, don't swing\\r\\n3. Explosive Pull up till chin is above the bar\\r\\n4. Go down controlled\\\"\\r\\n \",\n      \"video_tips\": \"  \",\n      \"pro_tips\": \" You may find it easier with the kick but do them strict as you progress.\\r\\n \",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"\",\n      \"video\": [\n      {\n      \"id\": \"51\",\n      \"path\": \"66_1454045197.mp4\",\n      \"videothumbnail\": \"66_1454045197.jpg\",\n      \"description\": \"Explosive Pullups\"\n      }\n      ]\n      }\n      },\n      {\n      \"id\": \"1\",\n      \"description\": \"You mastered the muscleup. Congratulations\",\n      \"progression_id\": \"1\",\n      \"level\": \"5\",\n      \"row\": \"1\",\n      \"substitute\": \"0\",\n      \"exercise_id\": \"65\",\n      \"created_at\": \"2019-01-16 06:06:00\",\n      \"updated_at\": \"2019-01-16 06:06:00\",\n      \"is_selected\": 1,\n      \"isLocked\": 1,\n      \"isLockable\": 0,\n      \"isUnlockable\": 0,\n      \"exercise\": {\n      \"id\": \"65\",\n      \"name\": \"Muscleups\",\n      \"description\": \"You mastered the muscleup. Congratulations\",\n      \"category\": \"3\",\n      \"type\": \"1\",\n      \"muscle_groups\": \"\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \" \\\"1. Start from a retracted deadhang position\\r\\n2. Legs in front of you, don't swing\\r\\n3. Keep neck in neutral position at all times\\\"\\r\\n \",\n      \"video_tips\": \"  \",\n      \"pro_tips\": \" \\\"You may find it easier to start with a flexband to support you making the transition. \\r\\nChallenge yourself and try the same with rings.\\\"\\r\\n \",\n      \"is_static\": \"0\",\n      \"musclegroup_string\": \"\",\n      \"video\": [\n      {\n      \"id\": \"50\",\n      \"path\": \"65_1454045132.mp4\",\n      \"videothumbnail\": \"65_1454045132.jpg\",\n      \"description\": \"Muscleups\"\n      }\n      ]\n      }\n      }\n      ],\n      \"is_subscribed\": 1,\n      \"urls\": {\n      \"profileImageSmall\": \"http://sandbox.ykings.com/uploads/images/profile/small\",\n      \"profileImageMedium\": \"http://sandbox.ykings.com/uploads/images/profile/medium\",\n      \"profileImageLarge\": \"http://sandbox.ykings.com/uploads/images/profile/large\",\n      \"profileImageOriginal\": \"http://sandbox.ykings.com/uploads/images/profile/original\",\n      \"video\": \"http://sandbox.ykings.com/uploads/videos\",\n      \"videothumbnail\": \"http://sandbox.ykings.com/uploads/images/videothumbnails\",\n      \"feedImageSmall\": \"http://sandbox.ykings.com/uploads/images/feed/small\",\n      \"feedImageMedium\": \"http://sandbox.ykings.com/uploads/images/feed/medium\",\n      \"feedImageLarge\": \"http://sandbox.ykings.com/uploads/images/feed/large\",\n      \"feedImageOriginal\": \"http://sandbox.ykings.com/uploads/images/feed/original\",\n      \"coverImageSmall\": \"http://sandbox.ykings.com/uploads/images/cover_image/small\",\n      \"coverImageMedium\": \"http://sandbox.ykings.com/uploads/images/cover_image/medium\",\n      \"coverImageLarge\": \"http://sandbox.ykings.com/uploads/images/cover_image/large\",\n      \"coverImageOriginal\": \"http://sandbox.ykings.com/uploads/images/cover_image/original\"\n      }\n      }",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "error",
            "description": "<p>Message token_invalid.</p> "
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 400 Invalid Request\n{\n  \"status\":0,\n  \"error\": \"token_invalid\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 401 Unauthorised\n{\n  \"status\":0,\n  \"error\": \"token_expired\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 400 Bad Request\n{\n  \"status\":0,\n  \"error\": \"token_not_provided\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 422 Validation error\n{\n  \"status\" : 0,\n  \"error\": \"The user_id field is required\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 422 Validation error\n{\n  \"status\" : 0,\n  \"error\": \"The skill_id field is required\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 500 user_not_exists\n{\n  \"status\" : 0,\n  \"error\": \"user_not_exists\"\n}",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "app/Http/Controllers/Api/SkillsController.php",
    "groupTitle": "Skill"
  },
  {
    "type": "post",
    "url": "/skills/list",
    "title": "loadSkills",
    "name": "loadSkills",
    "group": "Skill",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "<p>Number</p> ",
            "optional": false,
            "field": "user_id",
            "description": "<p>Id of user *required</p> "
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "<p>String</p> ",
            "optional": false,
            "field": "success.",
            "description": ""
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n{\n      \"status\": 1,\n      \"skills\": {\n      \"pull\": [\n      {\n      \"id\": \"3\",\n      \"progression_id\": \"1\",\n      \"level\": \"3\",\n      \"row\": \"1\",\n      \"substitute\": \"53\",\n      \"exercise_id\": \"32\",\n      \"created_at\": \"2015-12-14 03:04:45\",\n      \"updated_at\": \"2015-12-15 05:48:46\",\n      \"exercise\": {\n      \"id\": \"32\",\n      \"name\": \"Pull ups / Chin ups\",\n      \"description\": \"\",\n      \"category\": \"2\",\n      \"type\": \"1\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"1.00\",\n      \"unit\": \"times\",\n      \"equipment\": \"\"\n      }\n      },\n      {\n      \"id\": \"6\",\n      \"progression_id\": \"1\",\n      \"level\": \"1\",\n      \"row\": \"2\",\n      \"substitute\": \"22\",\n      \"exercise_id\": \"2\",\n      \"created_at\": \"2015-12-14 03:04:45\",\n      \"updated_at\": \"2015-12-15 05:48:46\",\n      \"exercise\": {\n      \"id\": \"2\",\n      \"name\": \"Australian Pullups\",\n      \"description\": \"Australian pull-ups are becoming a very popular exercise. Like all types of pull-ups (and all types of exercises for that matter) there are many different ways to do the Australian, and it can be incorporated into a number of different contexts within a workout.\",\n      \"category\": \"1\",\n      \"type\": \"2\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"1.00\",\n      \"unit\": \"times\",\n      \"equipment\": \"\"\n      }\n      },\n      {\n      \"id\": \"11\",\n      \"progression_id\": \"1\",\n      \"level\": \"1\",\n      \"row\": \"3\",\n      \"substitute\": \"23\",\n      \"exercise_id\": \"3\",\n      \"created_at\": \"2015-12-14 03:04:45\",\n      \"updated_at\": \"2015-12-15 05:48:46\",\n      \"exercise\": {\n      \"id\": \"3\",\n      \"name\": \"Knee Raises\",\n      \"description\": \"Standing Knee Raises (also known as standing knee crunches and standing knee pulls) is a functional abdominal exercise for boosting strength throughout the core. Unlike standard ab exercises, they don’t isolate abdominal muscles. Instead they work your upper abs and lower abs in conjunction with other important muscles such as hips, back and shoulders.\",\n      \"category\": \"1\",\n      \"type\": \"2\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"1.00\",\n      \"unit\": \"times\",\n      \"equipment\": \"\"\n      }\n      },\n      {\n      \"id\": \"16\",\n      \"progression_id\": \"1\",\n      \"level\": \"1\",\n      \"row\": \"4\",\n      \"substitute\": \"24\",\n      \"exercise_id\": \"4\",\n      \"created_at\": \"2015-12-14 03:04:45\",\n      \"updated_at\": \"2015-12-15 05:48:46\",\n      \"exercise\": {\n      \"id\": \"4\",\n      \"name\": \"Skin the cat\",\n      \"description\": \"A good upper body stretching exercise, especially for achieving full range of motion in the shoulder. The skin the cat exercise is a fundamental movement performed on gymnastics rings.\",\n      \"category\": \"1\",\n      \"type\": \"2\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"1.00\",\n      \"unit\": \"times\",\n      \"equipment\": \"\"\n      }\n      }\n      ],\n      \"dip\": [\n      {\n      \"id\": \"22\",\n      \"progression_id\": \"2\",\n      \"level\": \"2\",\n      \"row\": \"1\",\n      \"substitute\": \"57\",\n      \"exercise_id\": \"36\",\n      \"created_at\": \"2015-12-14 03:04:45\",\n      \"updated_at\": \"2015-12-15 05:48:46\",\n      \"exercise\": {\n      \"id\": \"36\",\n      \"name\": \"Dips (Bench)\",\n      \"description\": \"\",\n      \"category\": \"2\",\n      \"type\": \"1\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"1.00\",\n      \"unit\": \"times\",\n      \"equipment\": \"\"\n      }\n      },\n      {\n      \"id\": \"25\",\n      \"progression_id\": \"2\",\n      \"level\": \"1\",\n      \"row\": \"2\",\n      \"substitute\": 0,\n      \"exercise_id\": \"6\",\n      \"created_at\": \"2015-12-14 03:04:45\",\n      \"updated_at\": \"2015-12-15 05:48:46\",\n      \"exercise\": {\n      \"id\": \"6\",\n      \"name\": \"Trizeps Extension\",\n      \"description\": \"\",\n      \"category\": \"1\",\n      \"type\": \"2\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"1.00\",\n      \"unit\": \"times\",\n      \"equipment\": \"\"\n      }\n      }\n      ],\n      \"full_body\": [\n      {\n      \"id\": \"29\",\n      \"progression_id\": \"3\",\n      \"level\": \"1\",\n      \"row\": \"1\",\n      \"substitute\": 0,\n      \"exercise_id\": \"7\",\n      \"created_at\": \"2015-12-14 03:04:45\",\n      \"updated_at\": \"2015-12-15 05:48:46\",\n      \"exercise\": {\n      \"id\": \"7\",\n      \"name\": \"Wall Sits\",\n      \"description\": \"\",\n      \"category\": \"1\",\n      \"type\": \"1\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"1.00\",\n      \"unit\": \"times\",\n      \"equipment\": \"\"\n      }\n      },\n      {\n      \"id\": \"33\",\n      \"progression_id\": \"3\",\n      \"level\": \"1\",\n      \"row\": \"2\",\n      \"substitute\": 0,\n      \"exercise_id\": \"8\",\n      \"created_at\": \"2015-12-14 03:04:45\",\n      \"updated_at\": \"2015-12-15 05:48:46\",\n      \"exercise\": {\n      \"id\": \"8\",\n      \"name\": \"Single Leg Deadlift\",\n      \"description\": \"\",\n      \"category\": \"1\",\n      \"type\": \"2\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"1.00\",\n      \"unit\": \"times\",\n      \"equipment\": \"\"\n      }\n      },\n      {\n      \"id\": \"36\",\n      \"progression_id\": \"3\",\n      \"level\": \"1\",\n      \"row\": \"3\",\n      \"substitute\": 0,\n      \"exercise_id\": \"9\",\n      \"created_at\": \"2015-12-14 03:04:45\",\n      \"updated_at\": \"2015-12-15 05:48:46\",\n      \"exercise\": {\n      \"id\": \"9\",\n      \"name\": \"Climbers\",\n      \"description\": \"\",\n      \"category\": \"1\",\n      \"type\": \"2\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"1.00\",\n      \"unit\": \"times\",\n      \"equipment\": \"\"\n      }\n      },\n      {\n      \"id\": \"39\",\n      \"progression_id\": \"3\",\n      \"level\": \"1\",\n      \"row\": \"4\",\n      \"substitute\": 0,\n      \"exercise_id\": \"10\",\n      \"created_at\": \"2015-12-14 03:04:45\",\n      \"updated_at\": \"2015-12-15 05:48:46\",\n      \"exercise\": {\n      \"id\": \"10\",\n      \"name\": \"High Jumps\",\n      \"description\": \"\",\n      \"category\": \"1\",\n      \"type\": \"2\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"1.00\",\n      \"unit\": \"times\",\n      \"equipment\": \"\"\n      }\n      },\n      {\n      \"id\": \"43\",\n      \"progression_id\": \"3\",\n      \"level\": \"1\",\n      \"row\": \"5\",\n      \"substitute\": 0,\n      \"exercise_id\": \"11\",\n      \"created_at\": \"2015-12-14 03:04:45\",\n      \"updated_at\": \"2015-12-15 05:48:46\",\n      \"exercise\": {\n      \"id\": \"11\",\n      \"name\": \"Sprawl\",\n      \"description\": \"\",\n      \"category\": \"1\",\n      \"type\": \"1\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"1.00\",\n      \"unit\": \"times\",\n      \"equipment\": \"\"\n      }\n      }\n      ],\n      \"push\": [\n      {\n      \"id\": \"46\",\n      \"progression_id\": \"4\",\n      \"level\": \"1\",\n      \"row\": \"1\",\n      \"substitute\": \"25\",\n      \"exercise_id\": \"12\",\n      \"created_at\": \"2015-12-14 03:04:45\",\n      \"updated_at\": \"2015-12-15 05:48:46\",\n      \"exercise\": {\n      \"id\": \"12\",\n      \"name\": \"Incline Pushups\",\n      \"description\": \"\",\n      \"category\": \"1\",\n      \"type\": \"1\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"1.00\",\n      \"unit\": \"times\",\n      \"equipment\": \"\"\n      }\n      },\n      {\n      \"id\": \"66\",\n      \"progression_id\": \"4\",\n      \"level\": \"1\",\n      \"row\": \"2\",\n      \"substitute\": \"26\",\n      \"exercise_id\": \"13\",\n      \"created_at\": \"2015-12-14 03:04:45\",\n      \"updated_at\": \"2015-12-15 05:48:46\",\n      \"exercise\": {\n      \"id\": \"13\",\n      \"name\": \"Military Press\",\n      \"description\": \"\",\n      \"category\": \"1\",\n      \"type\": \"1\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"1.00\",\n      \"unit\": \"times\",\n      \"equipment\": \"\"\n      }\n      },\n      {\n      \"id\": \"71\",\n      \"progression_id\": \"4\",\n      \"level\": \"1\",\n      \"row\": \"3\",\n      \"substitute\": 0,\n      \"exercise_id\": \"14\",\n      \"created_at\": \"2015-12-14 03:04:45\",\n      \"updated_at\": \"2015-12-15 05:48:46\",\n      \"exercise\": {\n      \"id\": \"14\",\n      \"name\": \"Decline Pushups\",\n      \"description\": \"\",\n      \"category\": \"1\",\n      \"type\": \"2\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"1.00\",\n      \"unit\": \"times\",\n      \"equipment\": \"\"\n      }\n      },\n      {\n      \"id\": \"74\",\n      \"progression_id\": \"4\",\n      \"level\": \"1\",\n      \"row\": \"4\",\n      \"substitute\": 0,\n      \"exercise_id\": \"15\",\n      \"created_at\": \"2015-12-14 03:04:45\",\n      \"updated_at\": \"2015-12-15 05:48:46\",\n      \"exercise\": {\n      \"id\": \"15\",\n      \"name\": \"Explosive Pushups\",\n      \"description\": \"\",\n      \"category\": \"1\",\n      \"type\": \"2\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"1.00\",\n      \"unit\": \"times\",\n      \"equipment\": \"\"\n      }\n      }\n      ],\n      \"core\": [\n      {\n      \"id\": \"78\",\n      \"progression_id\": \"5\",\n      \"level\": \"1\",\n      \"row\": \"1\",\n      \"substitute\": \"27\",\n      \"exercise_id\": \"16\",\n      \"created_at\": \"2015-12-14 03:04:45\",\n      \"updated_at\": \"2015-12-15 05:48:46\",\n      \"exercise\": {\n      \"id\": \"16\",\n      \"name\": \"Crunches\",\n      \"description\": \"\",\n      \"category\": \"1\",\n      \"type\": \"1\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"1.00\",\n      \"unit\": \"times\",\n      \"equipment\": \"\"\n      }\n      },\n      {\n      \"id\": \"107\",\n      \"progression_id\": \"5\",\n      \"level\": \"1\",\n      \"row\": \"2\",\n      \"substitute\": 0,\n      \"exercise_id\": \"17\",\n      \"created_at\": \"2015-12-14 03:04:45\",\n      \"updated_at\": \"2015-12-15 05:48:46\",\n      \"exercise\": {\n      \"id\": \"17\",\n      \"name\": \"Plank\",\n      \"description\": \"\",\n      \"category\": \"1\",\n      \"type\": \"1\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"1.00\",\n      \"unit\": \"times\",\n      \"equipment\": \"\"\n      }\n      },\n      {\n      \"id\": \"111\",\n      \"progression_id\": \"5\",\n      \"level\": \"1\",\n      \"row\": \"3\",\n      \"substitute\": \"23\",\n      \"exercise_id\": \"3\",\n      \"created_at\": \"2015-12-14 03:04:45\",\n      \"updated_at\": \"2015-12-15 05:48:46\",\n      \"exercise\": {\n      \"id\": \"3\",\n      \"name\": \"Knee Raises\",\n      \"description\": \"Standing Knee Raises (also known as standing knee crunches and standing knee pulls) is a functional abdominal exercise for boosting strength throughout the core. Unlike standard ab exercises, they don’t isolate abdominal muscles. Instead they work your upper abs and lower abs in conjunction with other important muscles such as hips, back and shoulders.\",\n      \"category\": \"1\",\n      \"type\": \"2\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"1.00\",\n      \"unit\": \"times\",\n      \"equipment\": \"\"\n      }\n      },\n      {\n      \"id\": \"116\",\n      \"progression_id\": \"5\",\n      \"level\": \"1\",\n      \"row\": \"4\",\n      \"substitute\": \"29\",\n      \"exercise_id\": \"18\",\n      \"created_at\": \"2015-12-14 03:04:45\",\n      \"updated_at\": \"2015-12-15 05:48:46\",\n      \"exercise\": {\n      \"id\": \"18\",\n      \"name\": \"Tucked Human Flag\",\n      \"description\": \"\",\n      \"category\": \"1\",\n      \"type\": \"2\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"\",\n      \"duration\": \"1.00\",\n      \"unit\": \"times\",\n      \"equipment\": \"\"\n      }\n      },\n      {\n      \"id\": \"122\",\n      \"progression_id\": \"5\",\n      \"level\": \"3\",\n      \"row\": \"5\",\n      \"substitute\": \"67\",\n      \"exercise_id\": \"51\",\n      \"created_at\": \"2015-12-14 03:04:45\",\n      \"updated_at\": \"2015-12-15 05:48:46\",\n      \"exercise\": {\n      \"id\": \"51\",\n      \"name\": \"One Leg Dragon Flag\",\n      \"description\": \"\",\n      \"category\": \"2\",\n      \"type\": \"2\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"1.00\",\n      \"unit\": \"times\",\n      \"equipment\": \"\"\n      }\n      },\n      {\n      \"id\": \"125\",\n      \"progression_id\": \"5\",\n      \"level\": \"1\",\n      \"row\": \"6\",\n      \"substitute\": \"31\",\n      \"exercise_id\": \"20\",\n      \"created_at\": \"2015-12-14 03:04:45\",\n      \"updated_at\": \"2015-12-15 05:48:46\",\n      \"exercise\": {\n      \"id\": \"20\",\n      \"name\": \"Tuck Planche\",\n      \"description\": \"\",\n      \"category\": \"1\",\n      \"type\": \"2\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"1.00\",\n      \"unit\": \"times\",\n      \"equipment\": \"\"\n      }\n      }\n      ]\n      },\n      \"is_subscribed\": 0,\n      \"urls\": {\n      \"profileImageSmall\": \"http://sandbox.ykings.com/uploads/images/profile/small\",\n      \"profileImageMedium\": \"http://sandbox.ykings.com/uploads/images/profile/medium\",\n      \"profileImageLarge\": \"http://sandbox.ykings.com/uploads/images/profile/large\",\n      \"profileImageOriginal\": \"http://sandbox.ykings.com/uploads/images/profile/original\",\n      \"video\": \"http://sandbox.ykings.com/uploads/videos\",\n      \"videothumbnail\": \"http://sandbox.ykings.com/uploads/images/videothumbnails\",\n      \"feedImageSmall\": \"http://sandbox.ykings.com/uploads/images/feed/small\",\n      \"feedImageMedium\": \"http://sandbox.ykings.com/uploads/images/feed/medium\",\n      \"feedImageLarge\": \"http://sandbox.ykings.com/uploads/images/feed/large\",\n      \"feedImageOriginal\": \"http://sandbox.ykings.com/uploads/images/feed/original\",\n      \"coverImageSmall\": \"http://sandbox.ykings.com/uploads/images/cover_image/small\",\n      \"coverImageMedium\": \"http://sandbox.ykings.com/uploads/images/cover_image/medium\",\n      \"coverImageLarge\": \"http://sandbox.ykings.com/uploads/images/cover_image/large\",\n      \"coverImageOriginal\": \"http://sandbox.ykings.com/uploads/images/cover_image/original\"\n      }\n      }",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "error",
            "description": "<p>Message token_invalid.</p> "
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 400 Invalid Request\n{\n  \"status\":0,\n  \"error\": \"token_invalid\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 401 Unauthorised\n{\n  \"status\":0,\n  \"error\": \"token_expired\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 400 Bad Request\n{\n  \"status\":0,\n  \"error\": \"token_not_provided\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 422 Validation error\n{\n  \"status\" : 0,\n  \"error\": \"The user_id field is required\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 500 user_not_exists\n{\n  \"status\" : 0,\n  \"error\": \"user_not_exists\"\n}",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "app/Http/Controllers/Api/SkillsController.php",
    "groupTitle": "Skill"
  },
  {
    "type": "post",
    "url": "/skills/lockskill",
    "title": "lockSkill",
    "name": "lockSkill",
    "group": "Skill",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "<p>Number</p> ",
            "optional": false,
            "field": "user_id",
            "description": "<p>Id of user *required</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>Number</p> ",
            "optional": false,
            "field": "skill_id",
            "description": "<p>Id of skill *required</p> "
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "<p>String</p> ",
            "optional": false,
            "field": "success.",
            "description": ""
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n{\n      \"status\": 1,\n      \"message\": \"successfully locked the skill\",\n      \"skills\": [\n      {\n      \"id\": \"11\",\n      \"progression_id\": \"1\",\n      \"level\": \"1\",\n      \"row\": \"3\",\n      \"substitute\": \"23\",\n      \"exercise_id\": \"3\",\n      \"created_at\": \"2015-12-14 03:04:45\",\n      \"updated_at\": \"2015-12-15 05:48:46\",\n      \"isLocked\": 0,\n      \"isLockable\": 0,\n      \"isUnlockable\": 0,\n      \"exercise\": {\n      \"id\": \"3\",\n      \"name\": \"Knee Raises\",\n      \"description\": \"Standing Knee Raises (also known as standing knee crunches and standing knee pulls) is a functional abdominal exercise for boosting strength throughout the core. Unlike standard ab exercises, they don’t isolate abdominal muscles. Instead they work your upper abs and lower abs in conjunction with other important muscles such as hips, back and shoulders.\",\n      \"category\": \"1\",\n      \"type\": \"2\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"1.00\",\n      \"unit\": \"times\",\n      \"equipment\": \"\"\n      }\n      },\n      {\n      \"id\": \"12\",\n      \"progression_id\": \"1\",\n      \"level\": \"2\",\n      \"row\": \"3\",\n      \"substitute\": \"0\",\n      \"exercise_id\": \"23\",\n      \"created_at\": \"2015-12-14 03:04:45\",\n      \"updated_at\": \"2016-01-04 10:24:35\",\n      \"isLocked\": 1,\n      \"isLockable\": 0,\n      \"isUnlockable\": 1,\n      \"exercise\": {\n      \"id\": \"23\",\n      \"name\": \"Leg Raises\",\n      \"description\": \"\",\n      \"category\": \"1\",\n      \"type\": \"2\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"1.00\",\n      \"unit\": \"times\",\n      \"equipment\": \"\"\n      }\n      },\n      {\n      \"id\": \"13\",\n      \"progression_id\": \"1\",\n      \"level\": \"3\",\n      \"row\": \"3\",\n      \"substitute\": \"55\",\n      \"exercise_id\": \"34\",\n      \"created_at\": \"2015-12-14 03:04:45\",\n      \"updated_at\": \"2015-12-15 05:48:46\",\n      \"isLocked\": 1,\n      \"isLockable\": 0,\n      \"isUnlockable\": 0,\n      \"exercise\": {\n      \"id\": \"34\",\n      \"name\": \"L-Sit\",\n      \"description\": \"\",\n      \"category\": \"2\",\n      \"type\": \"2\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"1.00\",\n      \"unit\": \"times\",\n      \"equipment\": \"\"\n      }\n      },\n      {\n      \"id\": \"14\",\n      \"progression_id\": \"1\",\n      \"level\": \"4\",\n      \"row\": \"3\",\n      \"substitute\": \"0\",\n      \"exercise_id\": \"55\",\n      \"created_at\": \"2015-12-14 03:04:45\",\n      \"updated_at\": \"2016-01-04 10:24:44\",\n      \"isLocked\": 1,\n      \"isLockable\": 0,\n      \"isUnlockable\": 0,\n      \"exercise\": {\n      \"id\": \"55\",\n      \"name\": \"L-Sit Pullup\",\n      \"description\": \"\",\n      \"category\": \"2\",\n      \"type\": \"2\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"1.00\",\n      \"unit\": \"times\",\n      \"equipment\": \"\"\n      }\n      },\n      {\n      \"id\": \"15\",\n      \"progression_id\": \"1\",\n      \"level\": \"5\",\n      \"row\": \"3\",\n      \"substitute\": \"0\",\n      \"exercise_id\": \"78\",\n      \"created_at\": \"2015-12-14 03:04:45\",\n      \"updated_at\": \"2015-12-15 05:48:46\",\n      \"isLocked\": 1,\n      \"isLockable\": 0,\n      \"isUnlockable\": 0,\n      \"exercise\": {\n      \"id\": \"78\",\n      \"name\": \"Pullover\",\n      \"description\": \"\",\n      \"category\": \"3\",\n      \"type\": \"2\",\n      \"rewards\": \"10.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"1.00\",\n      \"unit\": \"times\",\n      \"equipment\": \"\"\n      }\n      }\n      ],\n      \"is_subscribed\": 0,\n      \"urls\": {\n      \"profileImageSmall\": \"http://sandbox.ykings.com/uploads/images/profile/small\",\n      \"profileImageMedium\": \"http://sandbox.ykings.com/uploads/images/profile/medium\",\n      \"profileImageLarge\": \"http://sandbox.ykings.com/uploads/images/profile/large\",\n      \"profileImageOriginal\": \"http://sandbox.ykings.com/uploads/images/profile/original\",\n      \"video\": \"http://sandbox.ykings.com/uploads/videos\",\n      \"videothumbnail\": \"http://sandbox.ykings.com/uploads/images/videothumbnails\",\n      \"feedImageSmall\": \"http://sandbox.ykings.com/uploads/images/feed/small\",\n      \"feedImageMedium\": \"http://sandbox.ykings.com/uploads/images/feed/medium\",\n      \"feedImageLarge\": \"http://sandbox.ykings.com/uploads/images/feed/large\",\n      \"feedImageOriginal\": \"http://sandbox.ykings.com/uploads/images/feed/original\",\n      \"coverImageSmall\": \"http://sandbox.ykings.com/uploads/images/cover_image/small\",\n      \"coverImageMedium\": \"http://sandbox.ykings.com/uploads/images/cover_image/medium\",\n      \"coverImageLarge\": \"http://sandbox.ykings.com/uploads/images/cover_image/large\",\n      \"coverImageOriginal\": \"http://sandbox.ykings.com/uploads/images/cover_image/original\"\n      }\n      }",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "error",
            "description": "<p>Message token_invalid.</p> "
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 400 Invalid Request\n{\n  \"status\":0,\n  \"error\": \"token_invalid\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 401 Unauthorised\n{\n  \"status\":0,\n  \"error\": \"token_expired\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 400 Bad Request\n{\n  \"status\":0,\n  \"error\": \"token_not_provided\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 422 Validation error\n{\n  \"status\" : 0,\n  \"error\": \"The user_id field is required\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 422 Validation error\n{\n  \"status\" : 0,\n  \"error\": \"The skill_id field is required\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 500 user_not_exists\n{\n  \"status\" : 0,\n  \"error\": \"user_not_exists\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 500 already locked the skill\n{\n  \"status\" : 0,\n  \"error\": \"already locked the skill\"\n}",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "app/Http/Controllers/Api/SkillsController.php",
    "groupTitle": "Skill"
  },
  {
    "type": "post",
    "url": "/skills/unlockskill",
    "title": "unlockSkill",
    "name": "unlockSkill",
    "group": "Skill",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "<p>Number</p> ",
            "optional": false,
            "field": "user_id",
            "description": "<p>Id of user *required</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>Number</p> ",
            "optional": false,
            "field": "skill_id",
            "description": "<p>Id of skill *required</p> "
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "<p>String</p> ",
            "optional": false,
            "field": "success.",
            "description": ""
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n{\n      \"status\": 1,\n      \"message\": \"successfully unlocked the skill\",\n      \"skills\": [\n      {\n      \"id\": \"11\",\n      \"progression_id\": \"1\",\n      \"level\": \"1\",\n      \"row\": \"3\",\n      \"substitute\": \"23\",\n      \"exercise_id\": \"3\",\n      \"created_at\": \"2015-12-14 03:04:45\",\n      \"updated_at\": \"2015-12-15 05:48:46\",\n      \"isLocked\": 0,\n      \"isLockable\": 0,\n      \"isUnlockable\": 0,\n      \"exercise\": {\n      \"id\": \"3\",\n      \"name\": \"Knee Raises\",\n      \"description\": \"Standing Knee Raises (also known as standing knee crunches and standing knee pulls) is a functional abdominal exercise for boosting strength throughout the core. Unlike standard ab exercises, they don’t isolate abdominal muscles. Instead they work your upper abs and lower abs in conjunction with other important muscles such as hips, back and shoulders.\",\n      \"category\": \"1\",\n      \"type\": \"2\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"1.00\",\n      \"unit\": \"times\",\n      \"equipment\": \"\"\n      }\n      },\n      {\n      \"id\": \"12\",\n      \"progression_id\": \"1\",\n      \"level\": \"2\",\n      \"row\": \"3\",\n      \"substitute\": \"0\",\n      \"exercise_id\": \"23\",\n      \"created_at\": \"2015-12-14 03:04:45\",\n      \"updated_at\": \"2016-01-04 10:24:35\",\n      \"isLocked\": 1,\n      \"isLockable\": 0,\n      \"isUnlockable\": 1,\n      \"exercise\": {\n      \"id\": \"23\",\n      \"name\": \"Leg Raises\",\n      \"description\": \"\",\n      \"category\": \"1\",\n      \"type\": \"2\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"1.00\",\n      \"unit\": \"times\",\n      \"equipment\": \"\"\n      }\n      },\n      {\n      \"id\": \"13\",\n      \"progression_id\": \"1\",\n      \"level\": \"3\",\n      \"row\": \"3\",\n      \"substitute\": \"55\",\n      \"exercise_id\": \"34\",\n      \"created_at\": \"2015-12-14 03:04:45\",\n      \"updated_at\": \"2015-12-15 05:48:46\",\n      \"isLocked\": 1,\n      \"isLockable\": 0,\n      \"isUnlockable\": 0,\n      \"exercise\": {\n      \"id\": \"34\",\n      \"name\": \"L-Sit\",\n      \"description\": \"\",\n      \"category\": \"2\",\n      \"type\": \"2\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"1.00\",\n      \"unit\": \"times\",\n      \"equipment\": \"\"\n      }\n      },\n      {\n      \"id\": \"14\",\n      \"progression_id\": \"1\",\n      \"level\": \"4\",\n      \"row\": \"3\",\n      \"substitute\": \"0\",\n      \"exercise_id\": \"55\",\n      \"created_at\": \"2015-12-14 03:04:45\",\n      \"updated_at\": \"2016-01-04 10:24:44\",\n      \"isLocked\": 1,\n      \"isLockable\": 0,\n      \"isUnlockable\": 0,\n      \"exercise\": {\n      \"id\": \"55\",\n      \"name\": \"L-Sit Pullup\",\n      \"description\": \"\",\n      \"category\": \"2\",\n      \"type\": \"2\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"1.00\",\n      \"unit\": \"times\",\n      \"equipment\": \"\"\n      }\n      },\n      {\n      \"id\": \"15\",\n      \"progression_id\": \"1\",\n      \"level\": \"5\",\n      \"row\": \"3\",\n      \"substitute\": \"0\",\n      \"exercise_id\": \"78\",\n      \"created_at\": \"2015-12-14 03:04:45\",\n      \"updated_at\": \"2015-12-15 05:48:46\",\n      \"isLocked\": 0,\n      \"isLockable\": 1,\n      \"isUnlockable\": 0,\n      \"exercise\": {\n      \"id\": \"78\",\n      \"name\": \"Pullover\",\n      \"description\": \"\",\n      \"category\": \"3\",\n      \"type\": \"2\",\n      \"rewards\": \"10.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"1.00\",\n      \"unit\": \"times\",\n      \"equipment\": \"\"\n      }\n      }\n      ],\n      \"is_subscribed\": 0,\n      \"urls\": {\n      \"profileImageSmall\": \"http://sandbox.ykings.com/uploads/images/profile/small\",\n      \"profileImageMedium\": \"http://sandbox.ykings.com/uploads/images/profile/medium\",\n      \"profileImageLarge\": \"http://sandbox.ykings.com/uploads/images/profile/large\",\n      \"profileImageOriginal\": \"http://sandbox.ykings.com/uploads/images/profile/original\",\n      \"video\": \"http://sandbox.ykings.com/uploads/videos\",\n      \"videothumbnail\": \"http://sandbox.ykings.com/uploads/images/videothumbnails\",\n      \"feedImageSmall\": \"http://sandbox.ykings.com/uploads/images/feed/small\",\n      \"feedImageMedium\": \"http://sandbox.ykings.com/uploads/images/feed/medium\",\n      \"feedImageLarge\": \"http://sandbox.ykings.com/uploads/images/feed/large\",\n      \"feedImageOriginal\": \"http://sandbox.ykings.com/uploads/images/feed/original\",\n      \"coverImageSmall\": \"http://sandbox.ykings.com/uploads/images/cover_image/small\",\n      \"coverImageMedium\": \"http://sandbox.ykings.com/uploads/images/cover_image/medium\",\n      \"coverImageLarge\": \"http://sandbox.ykings.com/uploads/images/cover_image/large\",\n      \"coverImageOriginal\": \"http://sandbox.ykings.com/uploads/images/cover_image/original\"\n      }\n      }",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "error",
            "description": "<p>Message token_invalid.</p> "
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 400 Invalid Request\n{\n  \"status\":0,\n  \"error\": \"token_invalid\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 401 Unauthorised\n{\n  \"status\":0,\n  \"error\": \"token_expired\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 400 Bad Request\n{\n  \"status\":0,\n  \"error\": \"token_not_provided\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 422 Validation error\n{\n  \"status\" : 0,\n  \"error\": \"The user_id field is required\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 422 Validation error\n{\n  \"status\" : 0,\n  \"error\": \"The skill_id field is required\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 500 user_not_exists\n{\n  \"status\" : 0,\n  \"error\": \"user_not_exists\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 500 already unlocked the skill\n{\n  \"status\" : 0,\n  \"error\": \"already unlocked the skill\"\n}",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "app/Http/Controllers/Api/SkillsController.php",
    "groupTitle": "Skill"
  },
  {
    "type": "post",
    "url": "/social/facebookDisconnect",
    "title": "facebookDisconnect",
    "name": "facebookDisconnect",
    "group": "Social",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "<p>Number</p> ",
            "optional": false,
            "field": "user_id",
            "description": "<p>Id of user *required</p> "
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "<p>String</p> ",
            "optional": false,
            "field": "success.",
            "description": ""
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n {\n      \"status\": 1,\n      \"success\": \"Facebook Disconnected\"\n      }",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "error",
            "description": "<p>Message token_invalid.</p> "
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 400 Invalid Request\n{\n  \"status\" : 0,\n  \"error\": \"token_invalid\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 401 Unauthorised\n{\n  \"status\" : 0,\n  \"error\": \"token_expired\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 400 Bad Request\n{\n  \"status\" : 0,\n  \"error\": \"token_not_provided\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 400 Validation error\n{\n  \"status\" : 0,\n  \"error\": \"The user_id field is required\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 400 user_not_exists\n{\n  \"status\" : 0,\n  \"error\": \"user_not_exists\"\n}",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "app/Http/Controllers/Api/SocialController.php",
    "groupTitle": "Social"
  },
  {
    "type": "post",
    "url": "/social/facebookLogin",
    "title": "facebookLogin",
    "name": "facebookLogin",
    "group": "Social",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "<p>string</p> ",
            "optional": true,
            "field": "first_name",
            "description": "<p>Firstname of user</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>string</p> ",
            "optional": true,
            "field": "last_name",
            "description": "<p>LastName of user</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>string</p> ",
            "optional": true,
            "field": "image_url",
            "description": "<p>Facebook Profile Image Url of user</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>string</p> ",
            "optional": true,
            "field": "access_token",
            "description": "<p>Access Token</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>string</p> ",
            "optional": false,
            "field": "email",
            "description": "<p>email address of user *required</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>string</p> ",
            "optional": false,
            "field": "provider_id",
            "description": "<p>Facebook id of user *required</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>string</p> ",
            "optional": false,
            "field": "provider",
            "description": "<p>Provider,eg:facebook *required</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>string</p> ",
            "optional": true,
            "field": "subscription",
            "description": "<p>Permission flag 0/1</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>string</p> ",
            "optional": true,
            "field": "gender",
            "description": "<p>gender</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>string</p> ",
            "optional": true,
            "field": "fitness_status",
            "description": "<p>fitness_status</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>string</p> ",
            "optional": true,
            "field": "goal",
            "description": "<p>goal</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>string</p> ",
            "optional": true,
            "field": "quote",
            "description": "<p>quote</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>string</p> ",
            "optional": true,
            "field": "referral_code",
            "description": "<p>If user added referral code</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>string</p> ",
            "optional": true,
            "field": "parameters",
            "description": "<p>json_encoded array {&quot;marketing_title&quot;:&quot;marketing&quot;}.</p> "
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "<p>String</p> ",
            "optional": false,
            "field": "success.",
            "description": ""
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "    HTTP/1.1 200 OK\n{\n      \"status\": 1,\n      \"success\": \"successfully_logged_in\",\n      \"token\": \"eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOiI3NSIsImlzcyI6Imh0dHA6XC9cL3lraW5ncy5tZVwvYXBpXC9zb2NpYWxcL2ZhY2Vib29rTG9naW4iLCJpYXQiOiIxNDQ5NjYyODMyIiwiZXhwIjoiMTQ1MzI2MjgzMiIsIm5iZiI6IjE0NDk2NjI4MzIiLCJqdGkiOiI4Zjc1ZjliMmJjMzFmMmQ5OWIzZGUzYmI3OWMyM2QxYiJ9.DlOJuP45ticT3wHRVMLp3mgXFQCbbPUetHYK2ucjIJA\",\n      \"user\": {\n      \"id\": \"75\",\n      \"email\": \"kiran.lm@cubettech.com\",\n      \"confirmation_code\": \"\",\n      \"status\": \"1\",\n      \"created_at\": \"2015-12-04 10:24:06\",\n      \"updated_at\": \"2015-12-04 10:24:06\",\n      \"workout_count\": 0,\n      \"points\": 0,\n      \"level\": 1,\n      \"facebook_connect\": 1,\n      \"follower_count\": 0,\n      \"is_subscribed\": 0,\n      \"profile\": [\n      {\n      \"id\": \"59\",\n      \"user_id\": \"75\",\n      \"first_name\": \"kiran\",\n      \"last_name\": \"\",\n      \"gender\": \"0\",\n      \"fitness_status\": \"0\",\n      \"goal\": \"0\",\n      \"image\": \"75_1449224652.jpg\",\n      \"cover_image\": \"\",\n      \"city\": \"\",\n      \"state\": \"\",\n      \"country\": \"\",\n      \"spot\": \"\",\n      \"quote\": \"\",\n      \"instagram\": \"0\",\n      \"twitter\": \"0\",\n      \"facebook\": \"0\",\n      \"fb\": \"0\",\n      \"created_at\": \"2015-12-04 10:24:11\",\n      \"updated_at\": \"2015-12-04 16:58:53\",\n      \"level\": 1\n      }\n      ],\n      \"settings\": [\n      {\n      \"id\": \"30\",\n      \"user_id\": \"75\",\n      \"key\": \"subscription\",\n      \"value\": \"1\",\n      \"created_at\": \"2015-12-04 10:24:11\",\n      \"updated_at\": \"2015-12-04 10:24:11\"\n      },\n      {\n      \"id\": \"31\",\n      \"user_id\": \"75\",\n      \"key\": \"notification\",\n      \"value\": \"{\\\"comments\\\":\\\"1\\\",\\\"claps\\\":\\\"0\\\",\\\"follow\\\":\\\"0\\\",\\\"my_performance\\\":\\\"1\\\",\\\"motivation_knowledge\\\":\\\"1\\\"}\",\n      \"created_at\": \"2015-12-04 10:24:11\",\n      \"updated_at\": \"2015-12-04 10:24:11\"\n      }\n      ]\n      },\n      \"urls\": {\n      \"profileImageSmall\": \"http://ykings.me/uploads/images/profile/small\",\n      \"profileImageMedium\": \"http://ykings.me/uploads/images/profile/medium\",\n      \"profileImageLarge\": \"http://ykings.me/uploads/images/profile/large\",\n      \"profileImageOriginal\": \"http://ykings.me/uploads/images/profile/original\",\n      \"video\": \"http://ykings.me/uploads/videos\",\n      \"videothumbnail\": \"http://ykings.me/uploads/images/videothumbnails\",\n      \"feedImageSmall\": \"http://ykings.me/uploads/images/feed/small\",\n      \"feedImageMedium\": \"http://ykings.me/uploads/images/feed/medium\",\n      \"feedImageLarge\": \"http://ykings.me/uploads/images/feed/large\",\n      \"feedImageOriginal\": \"http://ykings.me/uploads/images/feed/original\",\n      \"coverImageSmall\": \"http://ykings.me/uploads/images/cover_image/small\",\n      \"coverImageMedium\": \"http://ykings.me/uploads/images/cover_image/medium\",\n      \"coverImageLarge\": \"http://ykings.me/uploads/images/cover_image/large\",\n      \"coverImageOriginal\": \"http://ykings.me/uploads/images/cover_image/original\"\n      }\n      }",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "could_not_create_user",
            "description": "<p>User error.</p> "
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "Validation",
            "description": "<p>error.</p> "
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 500 could_not_create_user\n{\n  \"error\": \"could_not_create_user\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 422 Validation error\n     {\n     \"status\": 0,\n     \"error\": \"The email field is required.\"\n     }",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 422 Validation error\n     {\n     \"status\": 0,\n     \"error\": \"The provider id field is required\"\n     }",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 422 Validation error\n     {\n     \"status\": 0,\n     \"error\": \"The provider field is required.\"\n     }",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "app/Http/Controllers/Api/SocialController.php",
    "groupTitle": "Social"
  },
  {
    "type": "post",
    "url": "/social/facebookSignUp",
    "title": "facebookSignUp",
    "name": "facebookSignUp",
    "group": "Social",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "<p>string</p> ",
            "optional": true,
            "field": "first_name",
            "description": "<p>Firstname of user</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>string</p> ",
            "optional": true,
            "field": "last_name",
            "description": "<p>LastName of user</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>string</p> ",
            "optional": true,
            "field": "image_url",
            "description": "<p>Facebook Profile Image Url of user</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>string</p> ",
            "optional": true,
            "field": "access_token",
            "description": "<p>Access Token</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>string</p> ",
            "optional": false,
            "field": "email",
            "description": "<p>email address of user *required</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>string</p> ",
            "optional": false,
            "field": "provider_id",
            "description": "<p>Facebook id of user *required</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>string</p> ",
            "optional": false,
            "field": "provider",
            "description": "<p>Provider,eg:facebook *required</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>string</p> ",
            "optional": true,
            "field": "subscription",
            "description": "<p>Permission flag 0/1</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>string</p> ",
            "optional": true,
            "field": "gender",
            "description": "<p>gender</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>string</p> ",
            "optional": true,
            "field": "fitness_status",
            "description": "<p>fitness_status</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>string</p> ",
            "optional": true,
            "field": "goal",
            "description": "<p>goal</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>string</p> ",
            "optional": true,
            "field": "quote",
            "description": "<p>quote</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>string</p> ",
            "optional": true,
            "field": "referral_code",
            "description": "<p>If user added referral code</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>string</p> ",
            "optional": true,
            "field": "parameters",
            "description": "<p>json_encoded array {&quot;marketing_title&quot;:&quot;marketing&quot;}.</p> "
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "<p>String</p> ",
            "optional": false,
            "field": "success.",
            "description": ""
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "    HTTP/1.1 200 OK\n{\n      \"status\": 1,\n      \"success\": \"successfully_created_user\",\n      \"token\": \"eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOiI3NyIsImlzcyI6Imh0dHA6XC9cL3lraW5ncy5tZVwvYXBpXC9zb2NpYWxcL2ZhY2Vib29rU2lnblVwIiwiaWF0IjoiMTQ0OTY2Mjk1NCIsImV4cCI6IjE0NTMyNjI5NTQiLCJuYmYiOiIxNDQ5NjYyOTU0IiwianRpIjoiMzU4MGY2NTM4YTE1Y2QzZWE5YzMxMDcxOTg4M2VhN2UifQ.2atfPXavOuhdFhUet3DA6qX5PV22q-irT400XRe1hoA\",\n      \"user\": {\n      \"id\": \"77\",\n      \"email\": \"kiranlm1@cubettech.com\",\n      \"confirmation_code\": \"\",\n      \"status\": \"1\",\n      \"created_at\": \"2015-12-09 12:09:08\",\n      \"updated_at\": \"2015-12-09 12:09:08\",\n      \"workout_count\": 0,\n      \"points\": 0,\n      \"level\": 1,\n      \"facebook_connect\": 1,\n      \"follower_count\": 0,\n      \"is_subscribed\": 0,\n      \"profile\": [\n      {\n      \"id\": \"61\",\n      \"user_id\": \"77\",\n      \"first_name\": \"kiran\",\n      \"last_name\": \"lm\",\n      \"gender\": \"0\",\n      \"fitness_status\": \"0\",\n      \"goal\": \"0\",\n      \"image\": \"77_1449662953.jpg\",\n      \"cover_image\": \"\",\n      \"city\": \"\",\n      \"state\": \"\",\n      \"country\": \"\",\n      \"spot\": \"\",\n      \"quote\": \"\",\n      \"instagram\": \"\",\n      \"twitter\": \"\",\n      \"facebook\": \"\",\n      \"fb\": \"0\",\n      \"created_at\": \"2015-12-09 12:09:12\",\n      \"updated_at\": \"2015-12-09 12:09:13\",\n      \"level\": 1\n      }\n      ],\n      \"settings\": [\n      {\n      \"id\": \"34\",\n      \"user_id\": \"77\",\n      \"key\": \"subscription\",\n      \"value\": \"1\",\n      \"created_at\": \"2015-12-09 12:09:12\",\n      \"updated_at\": \"2015-12-09 12:09:12\"\n      },\n      {\n      \"id\": \"35\",\n      \"user_id\": \"77\",\n      \"key\": \"notification\",\n      \"value\": \"{\\\"comments\\\":\\\"1\\\",\\\"claps\\\":\\\"0\\\",\\\"follow\\\":\\\"0\\\",\\\"my_performance\\\":\\\"1\\\",\\\"motivation_knowledge\\\":\\\"1\\\"}\",\n      \"created_at\": \"2015-12-09 12:09:12\",\n      \"updated_at\": \"2015-12-09 12:09:12\"\n      }\n      ]\n      },\n      \"urls\": {\n      \"profileImageSmall\": \"http://ykings.me/uploads/images/profile/small\",\n      \"profileImageMedium\": \"http://ykings.me/uploads/images/profile/medium\",\n      \"profileImageLarge\": \"http://ykings.me/uploads/images/profile/large\",\n      \"profileImageOriginal\": \"http://ykings.me/uploads/images/profile/original\",\n      \"video\": \"http://ykings.me/uploads/videos\",\n      \"videothumbnail\": \"http://ykings.me/uploads/images/videothumbnails\",\n      \"feedImageSmall\": \"http://ykings.me/uploads/images/feed/small\",\n      \"feedImageMedium\": \"http://ykings.me/uploads/images/feed/medium\",\n      \"feedImageLarge\": \"http://ykings.me/uploads/images/feed/large\",\n      \"feedImageOriginal\": \"http://ykings.me/uploads/images/feed/original\",\n      \"coverImageSmall\": \"http://ykings.me/uploads/images/cover_image/small\",\n      \"coverImageMedium\": \"http://ykings.me/uploads/images/cover_image/medium\",\n      \"coverImageLarge\": \"http://ykings.me/uploads/images/cover_image/large\",\n      \"coverImageOriginal\": \"http://ykings.me/uploads/images/cover_image/original\"\n      }\n      }",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "could_not_create_user",
            "description": "<p>User error.</p> "
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "Validation",
            "description": "<p>error</p> "
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 500 could_not_create_user\n{\n  \"error\": \"could_not_create_user\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 422 Validation error\n {\n \"status\": 0,\n \"error\": \"The email field is required.\"\n }",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 422 Validation error\n {\n \"status\": 0,\n \"error\": \"The provider id field is required\"\n }",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 422 Validation error\n {\n \"status\": 0,\n \"error\": \"The provider field is required.\"\n }",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "app/Http/Controllers/Api/SocialController.php",
    "groupTitle": "Social"
  },
  {
    "type": "post",
    "url": "/subscription/update",
    "title": "updateSubscription",
    "name": "updateSubscription",
    "group": "Subscription",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "<p>Number</p> ",
            "optional": false,
            "field": "user_id",
            "description": "<p>Id of user *required</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>Number</p> ",
            "optional": false,
            "field": "amount",
            "description": "<p>amount of subscription *required</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>String</p> ",
            "optional": false,
            "field": "currency",
            "description": "<p>currency of payment *required</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>Date</p> ",
            "optional": false,
            "field": "process_time",
            "description": "<p>time payment processed in UTC *required</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>String</p> ",
            "optional": false,
            "field": "transaction_id",
            "description": "<p>id of payment transaction *required</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>String</p> ",
            "optional": true,
            "field": "details",
            "description": "<p>details of transaction device, os, version etc as json array</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>String</p> ",
            "optional": false,
            "field": "inapp_id",
            "description": "<p>id of subscription id created with Inapp *required</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>Number</p> ",
            "optional": false,
            "field": "months",
            "description": "<p>duration of subscription *required</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>Number</p> ",
            "optional": false,
            "field": "status",
            "description": "<p>status of payment  0-failure, 1-success *required</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>Number</p> ",
            "optional": true,
            "field": "is_renew",
            "description": "<p>transaction is renewal or not 1 - renew, 0 - new subscription</p> "
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "<p>String</p> ",
            "optional": false,
            "field": "success.",
            "description": ""
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n      {\n      \"status\": 1,\n      \"message\": \"Subscription Updated\"\n      }",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "error",
            "description": "<p>Message token_invalid.</p> "
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 400 Invalid Request\n{\n  \"status\":\"0\",\n  \"error\": \"token_invalid\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 401 Unauthorised\n{\n  \"status\":\"0\",\n  \"error\": \"token_expired\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 400 Bad Request\n{\n  \"status\":\"0\",\n  \"error\": \"token_not_provided\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 422 Validation error\n{\n  \"status\" : 0,\n  \"error\": \"The user_id field is required\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 422 Validation error\n{\n  \"status\" : 0,\n  \"error\": \"The amount field is required\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 422 Validation error\n{\n  \"status\" : 0,\n  \"error\": \"The currency field is required\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 422 Validation error\n{\n  \"status\" : 0,\n  \"error\": \"The process_time field is required\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 422 Validation error\n{\n  \"status\" : 0,\n  \"error\": \"The transaction_id field is required\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 422 Validation error\n{\n  \"status\" : 0,\n  \"error\": \"The inapp_id field is required\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 422 Validation error\n{\n  \"status\" : 0,\n  \"error\": \"The status field is required\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 500 user_not_exists\n{\n  \"status\" : 0,\n  \"error\": \"user_not_exists\"\n}",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "app/Http/Controllers/Api/SubscriptionsController.php",
    "groupTitle": "Subscription"
  },
  {
    "type": "post",
    "url": "/user",
    "title": "CreateUserAccount",
    "name": "CreateUserAccount",
    "group": "User",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "<p>string</p> ",
            "optional": false,
            "field": "first_name",
            "description": "<p>Firstname of user *required</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>string</p> ",
            "optional": false,
            "field": "last_name",
            "description": "<p>Firstname of user *required</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>string</p> ",
            "optional": false,
            "field": "email",
            "description": "<p>email address of user *required</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>string</p> ",
            "optional": false,
            "field": "password",
            "description": "<p>password added by user *required</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>file</p> ",
            "optional": true,
            "field": "image",
            "description": "<p>user avatar image *accepted formats JPEG, PNG, and GIF</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>number</p> ",
            "optional": true,
            "field": "gender",
            "description": "<p>gender of the user 1-Male, 2-Female</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>number</p> ",
            "optional": true,
            "field": "fitness_status",
            "description": "<p>user's self assessment about fitness 1-I am definitely fit, 2-I am quite fit, 3-I am not so fit *optional</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>number</p> ",
            "optional": true,
            "field": "goal",
            "description": "<p>user's goal 1-Get Lean, 2-Get Fit, 3-Get Strong</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>string</p> ",
            "optional": true,
            "field": "city",
            "description": "<p>user's city</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>string</p> ",
            "optional": true,
            "field": "state",
            "description": "<p>user's state</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>string</p> ",
            "optional": true,
            "field": "country",
            "description": "<p>user's country</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>string</p> ",
            "optional": true,
            "field": "spot",
            "description": "<p>Training Spot</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>string</p> ",
            "optional": true,
            "field": "device_token",
            "description": "<p>Device Token</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>string</p> ",
            "optional": true,
            "field": "device_type",
            "description": "<p>Device Type(android/ios)</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>string</p> ",
            "optional": true,
            "field": "quote",
            "description": "<p>Motivational quote added by user</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>number</p> ",
            "optional": true,
            "field": "subscription",
            "description": "<p>Whether Newsletter subscription selected by user</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>string</p> ",
            "optional": true,
            "field": "referral_code",
            "description": "<p>If user added referral code</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>string</p> ",
            "optional": true,
            "field": "parameters",
            "description": "<p>json_encoded array {&quot;marketing_title&quot;:&quot;marketing&quot;}.</p> "
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "<p>String</p> ",
            "optional": false,
            "field": "success.",
            "description": ""
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n  {\n      \"status\" : 1,\n      \"success\": \"successfully_updated_user_profile\",\n      \"token\": \"eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOiIyIiwiaXNzIjoiaHR0cDpcL1wvbG9jYWxob3N0OjgwMDBcL2FwaVwvdXNlclwvbG9naW4iLCJpYXQiOiIxNDQ3MjQ2NTc1IiwiZXhwIjoiMTQ0NzYwNjU3NSIsIm5iZiI6IjE0NDcyNDY1NzUiLCJqdGkiOiI2ZTBlN2JlMDI5YTJjZTVkODM4MzkwY2EyZmE0MGNkMSJ9.lFwueZXytFQhLcfX6GZ1fwp5wmtPT1GenTZpx3p2jKQ\",\n      \"user\": {\n          \"id\": \"2\",\n          \"email\": \"aneeshk@cubettech.com\",\n          \"confirmation_code\": \"d6grRYINWtcDH18bXc358M9ZDDFExd\",\n          \"status\": \"1\",\n          \"created_at\": \"2015-11-11 11:40:04\",\n          \"updated_at\": \"2015-11-11 11:40:04\",\n          \"profile\": {\n              \"id\": \"2\",\n              \"user_id\": \"2\",\n              \"first_name\": \"Aneesh\",\n              \"last_name\": \"Kallikkattil\",\n              \"gender\": 0,\n              \"fitness_status\": 0,\n              \"goal\": 0,\n              \"image\": \"2_1447242011.jpg\",\n              \"city\": \"\",\n              \"state\": \"\",\n              \"country\": \"\",\n              \"spot\": \"\",\n              \"quote\": \"\",\n              \"created_at\": \"2015-11-11 11:40:10\",\n              \"updated_at\": \"2015-11-11 11:40:11\"\n          },\n          \"videos\": [\n              {\n                  \"id\": \"2\",\n                  \"user_id\": \"2\",\n                  \"video_id\": \"1\",\n                  \"created_at\": \"2015-11-11 11:40:05\",\n                  \"updated_at\": \"2015-11-11 11:40:05\",\n                  \"video\": {\n                      \"id\": \"1\",\n                      \"user_id\": \"1\",\n                      \"path\": \"Now1.mp4\",\n                      \"description\": \"Test Description\",\n                      \"parent_type\": \"1\",\n                      \"type\": \"1\",\n                      \"parent_id\": \"1\",\n                      \"created_at\": \"2015-11-11 07:26:40\",\n                      \"updated_at\": \"2015-11-11 17:43:27\"\n                  }\n              }\n          ],\n     \"promo_code\": \"hewiby\"\n      },\n      \"urls\": {\n          \"profileImageSmall\": \"http://sandbox.ykings.com/uploads/images/profile/small\",\n          \"profileImageMedium\": \"http://sandbox.ykings.com/uploads/images/profile/medium\",\n          \"profileImageLarge\": \"http://sandbox.ykings.com/uploads/images/profile/large\",\n          \"profileImageOriginal\": \"http://sandbox.ykings.com/uploads/images/profile/original\",\n          \"video\": \"http://sandbox.ykings.com/uploads/videos\",\n          \"feedImageSmall\": \"http://sandbox.ykings.com/uploads/images/feed/small\",\n          \"feedImageMedium\": \"http://sandbox.ykings.com/uploads/images/feed/medium\",\n          \"feedImageLarge\": \"http://sandbox.ykings.com/uploads/images/feed/large\",\n          \"feedImageOriginal\": \"http://sandbox.ykings.com/uploads/images/feed/original\"\n      }\n  }",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "error",
            "description": "<p>Validation error.</p> "
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "could_not_create_user",
            "description": "<p>User error.</p> "
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 400 Validation error\n{\n  \"status\": 0,\n  \"error\": \"The email field is required.\",\n  \"referral_code\": \"i2dGox\"\n  }",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 400 Validation error\n{\n  \"status\" : 0,\n  \"error\": \"The password field is required.\",\n  \"referral_code\": \"i2dGox\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 400 Validation error\n{\n  \"status\" : 0,\n  \"error\": \"The first_name field is required\",\n  \"referral_code\": \"i2dGox\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 400 Validation error\n{\n  \"status\" : 0,\n  \"error\": \"The last_name field is required\",\n  \"referral_code\": \"i2dGox\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 422 This email already signed up with us.\n{\n  \"status\" : 0,\n  \"error\": \"This email already signed up with us.\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 500 could_not_create_user\n{\n  \"status\" : 0,\n  \"error\": \"could_not_create_user\",\n  \"referral_code\": \"i2dGox\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 500 user_created_but_we_accept_only_jpeg_gif_png_files_as_profile_images\n{\n  \"status\" : 0,\n  \"error\": \"user_created_but_we_accept_only_jpeg_gif_png_files_as_profile_images\"\n}",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "app/Http/Controllers/Api/UsersController.php",
    "groupTitle": "User"
  },
  {
    "type": "post",
    "url": "/user/get",
    "title": "GetUserDetails",
    "name": "GetUserDetails",
    "group": "User",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "<p>integer</p> ",
            "optional": false,
            "field": "user_id",
            "description": "<p>id of loggedin user *required</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>integer</p> ",
            "optional": false,
            "field": "profile_id",
            "description": "<p>id of other user *required</p> "
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "<p>String</p> ",
            "optional": false,
            "field": "success.",
            "description": ""
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n{\n      \"status\": 1,\n      \"success\": \"user_details\",\n      \"user\": {\n      \"id\": \"2\",\n      \"email\": \"aneeshk@cubettech.com\",\n      \"confirmation_code\": \"\",\n      \"status\": \"1\",\n      \"created_at\": \"2015-11-09 09:14:02\",\n      \"updated_at\": \"2015-11-16 06:45:17\",\n      \"is_subscribed\": 0,\n      \"profile\": [\n      {\n      \"id\": \"2\",\n      \"user_id\": \"2\",\n      \"first_name\": \"Aneesh\",\n      \"last_name\": \"Kallikkattil\",\n      \"gender\": \"1\",\n      \"fitness_status\": \"3\",\n      \"goal\": \"3\",\n      \"image\": \"\",\n      \"cover_image\": \"\",\n      \"city\": \"\",\n      \"state\": \"\",\n      \"country\": \"\",\n      \"spot\": \"\",\n      \"quote\": \"I want to get Strong\",\n      \"facebook\": 0,\n      \"twitter\": 0,\n      \"instagram\": 0,\n      \"created_at\": \"2015-11-09 09:14:02\",\n      \"updated_at\": \"2015-11-09 10:16:07\",\n      \"level\": 3\n      }\n      ],\n      \"settings\": [\n      {\n      \"id\": \"2\",\n      \"user_id\": \"2\",\n      \"key\": \"notification\",\n      \"value\": \"{\\\"comments\\\":\\\"1\\\",\\\"claps\\\":\\\"1\\\",\\\"follow\\\":\\\"1\\\",\\\"my_performance\\\":\\\"1\\\",\\\"motivation_knowledge\\\":\\\"1\\\"} \",\n      \"created_at\": \"2015-11-20 00:00:00\",\n      \"updated_at\": \"2015-12-03 06:35:31\"\n      },\n      {\n      \"id\": \"3\",\n      \"user_id\": \"2\",\n      \"key\": \"subscription\",\n      \"value\": \"1\",\n      \"created_at\": \"2015-11-20 00:00:00\",\n      \"updated_at\": \"2015-11-20 06:33:27\"\n      }\n      ],\n      \"is_following\": 0,\n      \"follower_count\": 0,\n      \"workout_count\": 4,\n      \"level\": 3,\n      \"points\": 330,\n      \"points_to_next_level\": 170,\n      \"total_skills\": 6,\n      \"user_skills_count\": 2,\n      \"athlete_since\": \"2015-11-09 09:14:02\",\n      \"facebook_connected\": 0,\n      \"promo_code\": \"hewiby\"\n      },\n      \"urls\": {\n      \"profileImageSmall\": \"http://sandbox.ykings.com/uploads/images/profile/small\",\n      \"profileImageMedium\": \"http://sandbox.ykings.com/uploads/images/profile/medium\",\n      \"profileImageLarge\": \"http://sandbox.ykings.com/uploads/images/profile/large\",\n      \"profileImageOriginal\": \"http://sandbox.ykings.com/uploads/images/profile/original\",\n      \"video\": \"http://sandbox.ykings.com/uploads/videos\",\n      \"videothumbnail\": \"http://sandbox.ykings.com/uploads/images/videothumbnails\",\n      \"feedImageSmall\": \"http://sandbox.ykings.com/uploads/images/feed/small\",\n      \"feedImageMedium\": \"http://sandbox.ykings.com/uploads/images/feed/medium\",\n      \"feedImageLarge\": \"http://sandbox.ykings.com/uploads/images/feed/large\",\n      \"feedImageOriginal\": \"http://sandbox.ykings.com/uploads/images/feed/original\",\n      \"coverImageSmall\": \"http://sandbox.ykings.com/uploads/images/cover_image/small\",\n      \"coverImageMedium\": \"http://sandbox.ykings.com/uploads/images/cover_image/medium\",\n      \"coverImageLarge\": \"http://sandbox.ykings.com/uploads/images/cover_image/large\",\n      \"coverImageOriginal\": \"http://sandbox.ykings.com/uploads/images/cover_image/original\"\n      }\n      }",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "error",
            "description": "<p>Message token_invalid.</p> "
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 400 Invalid Request\n{\n  \"status\" : 0,\n  \"error\": \"token_invalid\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 401 Unauthorised\n{\n  \"status\" : 0,\n  \"error\": \"token_expired\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 400 Bad Request\n{\n  \"status\" : 0,\n  \"error\": \"token_not_provided\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 422 Validation error\n{\n  \"status\" : 0,\n  \"error\": \"user_id required\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 422 user_not_verified\n{\n  \"status\" : 0,\n  \"error\": \"user_not_verified\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 401 invalid_credentials\n{\n  \"status\" : 0,\n  \"error\": \"invalid_credentials\"\n}",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "app/Http/Controllers/Api/UsersController.php",
    "groupTitle": "User"
  },
  {
    "type": "post",
    "url": "/user/videos",
    "title": "GetUserVideos",
    "name": "GetUserVideos",
    "group": "User",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "<p>integer</p> ",
            "optional": false,
            "field": "id",
            "description": "<p>id of user *required</p> "
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "<p>String</p> ",
            "optional": false,
            "field": "success.",
            "description": ""
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "    HTTP/1.1 200 OK\n      {\n          \"status\" : 1,\n          \"success\": \"user_videos\",\n          \"videos\": [\n              {\n                  \"id\": \"2\",\n                  \"user_id\": \"2\",\n                  \"video_id\": \"1\",\n                  \"created_at\": \"2015-11-11 11:40:05\",\n                  \"updated_at\": \"2015-11-11 11:40:05\",\n                  \"video\": {\n                      \"id\": \"1\",\n                      \"user_id\": \"1\",\n                      \"path\": \"Now1.mp4\",\n                      \"description\": \"Test Description\",\n                      \"parent_type\": \"1\",\n                      \"type\": \"1\",\n                      \"parent_id\": \"1\",\n                      \"created_at\": \"2015-11-11 07:26:40\",\n                      \"updated_at\": \"2015-11-11 17:43:27\"\n                  }\n              }\n          ],\n          \"urls\": {\n                    \"profileImageSmall\": \"http://sandbox.ykings.com/uploads/images/profile/small\",\n                    \"profileImageMedium\": \"http://sandbox.ykings.com/uploads/images/profile/medium\",\n                    \"profileImageLarge\": \"http://sandbox.ykings.com/uploads/images/profile/large\",\n                    \"profileImageOriginal\": \"http://sandbox.ykings.com/uploads/images/profile/original\",\n                    \"video\": \"http://sandbox.ykings.com/uploads/videos\",\n                    \"videothumbnail\": \"http://sandbox.ykings.com/uploads/images/videothumbnails\",\n                    \"feedImageSmall\": \"http://sandbox.ykings.com/uploads/images/feed/small\",\n                    \"feedImageMedium\": \"http://sandbox.ykings.com/uploads/images/feed/medium\",\n                    \"feedImageLarge\": \"http://sandbox.ykings.com/uploads/images/feed/large\",\n                    \"feedImageOriginal\": \"http://sandbox.ykings.com/uploads/images/feed/original\",\n                    \"coverImageSmall\": \"http://sandbox.ykings.com/uploads/images/cover_image/small\",\n                    \"coverImageMedium\": \"http://sandbox.ykings.com/uploads/images/cover_image/medium\",\n                    \"coverImageLarge\": \"http://sandbox.ykings.com/uploads/images/cover_image/large\",\n                    \"coverImageOriginal\": \"http://sandbox.ykings.com/uploads/images/cover_image/original\"\n              }\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "error",
            "description": "<p>Message token_invalid.</p> "
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 400 Invalid Request\n{\n  \"status\" : 0,\n  \"error\": \"token_invalid\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 401 Unauthorised\n{\n  \"status\" : 0,\n  \"error\": \"token_expired\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 400 Bad Request\n{\n  \"status\" : 0,\n  \"error\": \"token_not_provided\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 422 Validation Error\n{\n  \"status\" : 0,\n  \"error\": \"user_id required\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 500 no_videos\n{\n  \"status\" : 0,\n  \"error\": \"no_videos\"\n}",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "app/Http/Controllers/Api/UserVideosController.php",
    "groupTitle": "User"
  },
  {
    "type": "post",
    "url": "/user/login",
    "title": "LoginUser",
    "name": "LoginUser",
    "group": "User",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "<p>string</p> ",
            "optional": false,
            "field": "email",
            "description": "<p>email address of user *required</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>string</p> ",
            "optional": false,
            "field": "password",
            "description": "<p>password added by user *required</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>string</p> ",
            "optional": true,
            "field": "device_token",
            "description": "<p>Device Token</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>string</p> ",
            "optional": true,
            "field": "device_type",
            "description": "<p>Device Type(android/ios)</p> "
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "<p>String</p> ",
            "optional": false,
            "field": "success.",
            "description": ""
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n{\n      \"status\": 1,\n      \"success\": \"successfully_logged_in\",\n      \"token\": \"eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOiI0MSIsImlzcyI6Imh0dHA6XC9cL3lraW5ncy5tZVwvYXBpXC91c2VyXC9sb2dpbiIsImlhdCI6IjE0NDk2NjMwMTMiLCJleHAiOiIxNDUzMjYzMDEzIiwibmJmIjoiMTQ0OTY2MzAxMyIsImp0aSI6IjlmYmZhNDE1ODMzZGEzMDkyNzdkMDg3MWMyMmQ1NWQyIn0.pcjqabawygOzEvd3TliSIIAwWAG5gDJstABHWK_0D2c\",\n      \"user\": {\n      \"id\": \"41\",\n      \"email\": \"arun@ileafsolutions.net\",\n      \"confirmation_code\": \"\",\n      \"status\": \"1\",\n      \"created_at\": \"2015-11-16 15:24:09\",\n      \"updated_at\": \"2015-11-16 16:32:47\",\n      \"is_subscribed\": 0,\n      \"is_subscribed\": 0,\n      \"user_raid\": {\n      \"id\": \"6\",\n      \"name\": \"Front Lever\"\n      },\n      \"profile\": [\n      {\n      \"id\": \"31\",\n      \"user_id\": \"41\",\n      \"first_name\": \"arun\",\n      \"last_name\": \"mg\",\n      \"gender\": \"1\",\n      \"fitness_status\": \"3\",\n      \"goal\": \"1\",\n      \"image\": \"41_1449060497.jpg\",\n      \"cover_image\": \"\",\n      \"city\": \"\",\n      \"state\": \"\",\n      \"country\": \"\",\n      \"spot\": \"\",\n      \"quote\": \"\",\n      \"instagram\": 0,\n      \"twitter\": 0,\n      \"facebook\": 0,\n      \"fb\": 0,\n      \"created_at\": \"2015-11-16 15:24:09\",\n      \"updated_at\": \"2015-12-02 18:18:17\",\n      \"level\": 1\n      }\n      ],\n      \"settings\": [\n      {\n      \"id\": \"22\",\n      \"user_id\": \"41\",\n      \"key\": \"subscription\",\n      \"value\": \"1\",\n      \"created_at\": \"2015-12-03 09:52:37\",\n      \"updated_at\": \"2015-12-03 11:54:07\"\n      },\n      {\n      \"id\": \"23\",\n      \"user_id\": \"41\",\n      \"key\": \"notification\",\n      \"value\": \"{\\\"comments\\\":\\\"1\\\",\\\"claps\\\":\\\"1\\\",\\\"follow\\\":\\\"1\\\",\\\"my_performance\\\":\\\"1\\\",\\\"motivation_knowledge\\\":\\\"1\\\"} \",\n      \"created_at\": \"2015-12-03 09:52:37\",\n      \"updated_at\": \"2015-12-03 12:05:31\"\n      }\n      ],\n      \"follower_count\": 3,\n      \"workout_count\": 0,\n      \"points\": 0,\n      \"level\": 1,\n      \"facebook_connected\": 0,\n      \"promo_code\": \"hewiby\"\n      },\n      \"urls\": {\n      \"profileImageSmall\": \"http://ykings.me/uploads/images/profile/small\",\n      \"profileImageMedium\": \"http://ykings.me/uploads/images/profile/medium\",\n      \"profileImageLarge\": \"http://ykings.me/uploads/images/profile/large\",\n      \"profileImageOriginal\": \"http://ykings.me/uploads/images/profile/original\",\n      \"video\": \"http://ykings.me/uploads/videos\",\n      \"videothumbnail\": \"http://ykings.me/uploads/images/videothumbnails\",\n      \"feedImageSmall\": \"http://ykings.me/uploads/images/feed/small\",\n      \"feedImageMedium\": \"http://ykings.me/uploads/images/feed/medium\",\n      \"feedImageLarge\": \"http://ykings.me/uploads/images/feed/large\",\n      \"feedImageOriginal\": \"http://ykings.me/uploads/images/feed/original\",\n      \"coverImageSmall\": \"http://ykings.me/uploads/images/cover_image/small\",\n      \"coverImageMedium\": \"http://ykings.me/uploads/images/cover_image/medium\",\n      \"coverImageLarge\": \"http://ykings.me/uploads/images/cover_image/large\",\n      \"coverImageOriginal\": \"http://ykings.me/uploads/images/cover_image/original\"\n      }\n      }",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "error",
            "description": "<p>Validation error.</p> "
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 400 Validation error\n{\n  \"status\" : 0,\n  \"error\": \"The email field is required.\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 400 Validation error\n{\n  \"status\" : 0,\n  \"error\": \"The password field is required.\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 400 Validation error\n{\n  \"status\" : 0,\n  \"error\": \"The password field is required.\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 422 user_not_verified\n{\n  \"status\" : 0,\n  \"error\": \"user_not_verified\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 401 invalid_credentials\n{\n  \"status\" : 0,\n  \"error\": \"invalid_credentials\"\n}",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "app/Http/Controllers/Api/UsersController.php",
    "groupTitle": "User"
  },
  {
    "type": "post",
    "url": "/user/resendverify",
    "title": "ResendVerificationEmail",
    "name": "ResendVerificationEmail",
    "group": "User",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "<p>string</p> ",
            "optional": false,
            "field": "email",
            "description": "<p>email address of user *required</p> "
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "<p>String</p> ",
            "optional": false,
            "field": "success.",
            "description": ""
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n{\n     \"status\" : 1,\n     \"success\": \"Successfully sent email to your email address.\",\n     \"email\": \"aneeshk@cubettech.com\"\n }",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "error",
            "description": "<p>Validation Error.</p> "
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 422 email_reqired\n{\n     \"status\" : 0,\n     \"error\": \"email field is required\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 422 email not registered with us\n{\n     \"status\" : 0,\n     \"error\": \"email not registered with us\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 422 email already verified\n{\n     \"status\" : 0,\n     \"error\": \"email already verified\"\n}",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "app/Http/Controllers/Api/UsersController.php",
    "groupTitle": "User"
  },
  {
    "type": "post",
    "url": "/user/update",
    "title": "UpdateUserAccount",
    "name": "UpdateUserAccount",
    "group": "User",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "<p>string</p> ",
            "optional": true,
            "field": "first_name",
            "description": "<p>Firstname of user *optional</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>string</p> ",
            "optional": true,
            "field": "last_name",
            "description": "<p>Firstname of user *optional</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>string</p> ",
            "optional": false,
            "field": "email",
            "description": "<p>email address of user *readonly *required</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>number</p> ",
            "optional": true,
            "field": "gender",
            "description": "<p>gender of the user 1-Male, 2-Female</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>number</p> ",
            "optional": true,
            "field": "fitness_status",
            "description": "<p>user's self assessment about fitness 1-I am definitely fit, 2-I am quite fit, 3-I am not so fit *optional</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>file</p> ",
            "optional": true,
            "field": "image",
            "description": "<p>user avatar image  *accepted formats JPEG, PNG, and GIF</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>file</p> ",
            "optional": true,
            "field": "cover_image",
            "description": "<p>user cover_image</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>number</p> ",
            "optional": true,
            "field": "goal",
            "description": "<p>user's goal</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>string</p> ",
            "optional": true,
            "field": "city",
            "description": "<p>user's city</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>string</p> ",
            "optional": true,
            "field": "state",
            "description": "<p>user's state</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>string</p> ",
            "optional": true,
            "field": "country",
            "description": "<p>user's country</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>string</p> ",
            "optional": true,
            "field": "spot",
            "description": "<p>spot</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>string</p> ",
            "optional": true,
            "field": "twitter",
            "description": "<p>twitter</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>string</p> ",
            "optional": true,
            "field": "facebook",
            "description": "<p>facebook</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>string</p> ",
            "optional": true,
            "field": "instagram",
            "description": "<p>instagram</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>string</p> ",
            "optional": true,
            "field": "quote",
            "description": "<p>Quote added by user</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>number</p> ",
            "optional": true,
            "field": "subscription",
            "description": "<p>Whether Newsletter subscription selected by user</p> "
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "<p>String</p> ",
            "optional": false,
            "field": "success.",
            "description": ""
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n      {\n          \"status\" : 1,\n          \"success\": \"successfully_updated_user_profile\",\n          \"token\": \"eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOiIyIiwiaXNzIjoiaHR0cDpcL1wvbG9jYWxob3N0OjgwMDBcL2FwaVwvdXNlclwvbG9naW4iLCJpYXQiOiIxNDQ3MjQ2NTc1IiwiZXhwIjoiMTQ0NzYwNjU3NSIsIm5iZiI6IjE0NDcyNDY1NzUiLCJqdGkiOiI2ZTBlN2JlMDI5YTJjZTVkODM4MzkwY2EyZmE0MGNkMSJ9.lFwueZXytFQhLcfX6GZ1fwp5wmtPT1GenTZpx3p2jKQ\",\n          \"user\": {\n              \"id\": \"2\",\n              \"email\": \"aneeshk@cubettech.com\",\n              \"confirmation_code\": \"d6grRYINWtcDH18bXc358M9ZDDFExd\",\n              \"status\": \"1\",\n              \"created_at\": \"2015-11-11 11:40:04\",\n              \"updated_at\": \"2015-11-11 11:40:04\",\n              \"profile\": {\n                  \"id\": \"2\",\n                  \"user_id\": \"2\",\n                  \"first_name\": \"Aneesh\",\n                  \"last_name\": \"Kallikkattil\",\n                  \"gender\": 0,\n                  \"fitness_status\": 0,\n                  \"goal\": 0,\n                  \"image\": \"2_1447242011.jpg\",\n                  \"cover_image\": \"\",\n                  \"city\": \"\",\n                  \"state\": \"\",\n                  \"country\": \"\",\n                  \"spot\": \"\",\n                  \"twitter\": \"\",\n                  \"facebook\": \"\",\n                  \"instagram\": \"\",\n                  \"quote\": \"\",\n                  \"created_at\": \"2015-11-11 11:40:10\",\n                  \"updated_at\": \"2015-11-11 11:40:11\"\n              },\n              \"videos\": [\n                  {\n                      \"id\": \"2\",\n                      \"user_id\": \"2\",\n                      \"video_id\": \"1\",\n                      \"created_at\": \"2015-11-11 11:40:05\",\n                      \"updated_at\": \"2015-11-11 11:40:05\",\n                      \"video\": {\n                          \"id\": \"1\",\n                          \"user_id\": \"1\",\n                          \"path\": \"Now1.mp4\",\n                          \"description\": \"Test Description\",\n                          \"parent_type\": \"1\",\n                          \"type\": \"1\",\n                          \"parent_id\": \"1\",\n                          \"created_at\": \"2015-11-11 07:26:40\",\n                          \"updated_at\": \"2015-11-11 17:43:27\"\n                      }\n                  }\n              ],\n             \"promo_code\": \"hewiby\",\n          },\n           \"urls\": {\n      \"profileImageSmall\": \"http://sandbox.ykings.com/uploads/images/profile/small\",\n      \"profileImageMedium\": \"http://sandbox.ykings.com/uploads/images/profile/medium\",\n      \"profileImageLarge\": \"http://sandbox.ykings.com/uploads/images/profile/large\",\n      \"profileImageOriginal\": \"http://sandbox.ykings.com/uploads/images/profile/original\",\n      \"video\": \"http://sandbox.ykings.com/uploads/videos\",\n      \"videothumbnail\": \"http://sandbox.ykings.com/uploads/images/videothumbnails\",\n      \"feedImageSmall\": \"http://sandbox.ykings.com/uploads/images/feed/small\",\n      \"feedImageMedium\": \"http://sandbox.ykings.com/uploads/images/feed/medium\",\n      \"feedImageLarge\": \"http://sandbox.ykings.com/uploads/images/feed/large\",\n      \"feedImageOriginal\": \"http://sandbox.ykings.com/uploads/images/feed/original\",\n      \"coverImageSmall\": \"http://sandbox.ykings.com/uploads/images/cover_image/small\",\n      \"coverImageMedium\": \"http://sandbox.ykings.com/uploads/images/cover_image/medium\",\n      \"coverImageLarge\": \"http://sandbox.ykings.com/uploads/images/cover_image/large\",\n      \"coverImageOriginal\": \"http://sandbox.ykings.com/uploads/images/cover_image/original\"\n      }\n      }",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "error",
            "description": "<p>Message token_invalid.</p> "
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 400 Invalid Request\n{\n  \"status\" : 0,\n  \"error\": \"token_invalid\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 401 Unauthorised\n{\n  \"status\" : 0,\n  \"error\": \"token_expired\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 400 Bad Request\n{\n  \"status\" : 0,\n  \"error\": \"token_not_provided\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 400 Validation error\n{\n  \"status\" : 0,\n  \"error\": \"The email field is required.\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 500 could_not_create_user\n{\n  \"status\" : 0,\n  \"error\": \"could_not_create_user\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 500 user_created_but_we_accept_only_jpeg_gif_png_files_as_profile_images\n{\n  \"error\": \"user_updated_but_we_accept_only_jpeg_gif_png_files_as_profile_images\"\n}",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "app/Http/Controllers/Api/UsersController.php",
    "groupTitle": "User"
  },
  {
    "type": "post",
    "url": "/user/video/delete",
    "title": "deleteUserVideo",
    "name": "deleteUserVideo",
    "group": "User",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "<p>integer</p> ",
            "optional": false,
            "field": "user_id",
            "description": "<p>id of user *required</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>integer</p> ",
            "optional": false,
            "field": "video_id",
            "description": "<p>id of user video *required</p> "
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "<p>String</p> ",
            "optional": false,
            "field": "success.",
            "description": ""
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n  {\n      \"status\" : 1,\n      \"success\": \"user_videos\",\n      \"videos\": [\n          {\n              \"id\": \"2\",\n              \"user_id\": \"2\",\n              \"video_id\": \"1\",\n              \"created_at\": \"2015-11-11 11:40:05\",\n              \"updated_at\": \"2015-11-11 11:40:05\",\n              \"video\": {\n                  \"id\": \"1\",\n                  \"user_id\": \"1\",\n                  \"path\": \"Now1.mp4\",\n                  \"description\": \"Test Description\",\n                  \"parent_type\": \"1\",\n                  \"type\": \"1\",\n                  \"parent_id\": \"1\",\n                  \"created_at\": \"2015-11-11 07:26:40\",\n                  \"updated_at\": \"2015-11-11 17:43:27\"\n              },\n              \"user\": {\n                  \"id\": \"2\",\n                  \"email\": \"aneeshk@ykings.com\",\n                  \"confirmation_code\": \"d6grRYINWtcDH18bXc358M9ZDDFExd\",\n                  \"status\": \"0\",\n                  \"created_at\": \"2015-11-11 11:40:04\",\n                  \"updated_at\": \"2015-11-11 11:40:04\",\n                  \"profile\": {\n                      \"id\": \"2\",\n                      \"user_id\": \"2\",\n                      \"first_name\": \"Aneesh\",\n                      \"last_name\": \"Kallikkattil\",\n                      \"gender\": \"0\",\n                      \"fitness_status\": \"0\",\n                      \"goal\": \"0\",\n                      \"image\": \"2_1447242011.jpg\",\n                      \"city\": \"\",\n                      \"state\": \"\",\n                      \"country\": \"\",\n                      \"spot\": \"\",\n                      \"quote\": \"\",\n                      \"twitter\": \"\",\n                      \"facebook\": \"\",\n                      \"instagram\": \"\",\n                      \"created_at\": \"2015-11-11 11:40:10\",\n                      \"updated_at\": \"2015-11-11 11:40:11\"\n                  }\n              }\n          }\n      ],\n     \"urls\": {\n        \"profileImageSmall\": \"http://sandbox.ykings.com/uploads/images/profile/small\",\n        \"profileImageMedium\": \"http://sandbox.ykings.com/uploads/images/profile/medium\",\n        \"profileImageLarge\": \"http://sandbox.ykings.com/uploads/images/profile/large\",\n        \"profileImageOriginal\": \"http://sandbox.ykings.com/uploads/images/profile/original\",\n        \"video\": \"http://sandbox.ykings.com/uploads/videos\",\n        \"videothumbnail\": \"http://sandbox.ykings.com/uploads/images/videothumbnails\",\n        \"feedImageSmall\": \"http://sandbox.ykings.com/uploads/images/feed/small\",\n        \"feedImageMedium\": \"http://sandbox.ykings.com/uploads/images/feed/medium\",\n        \"feedImageLarge\": \"http://sandbox.ykings.com/uploads/images/feed/large\",\n        \"feedImageOriginal\": \"http://sandbox.ykings.com/uploads/images/feed/original\",\n        \"coverImageSmall\": \"http://sandbox.ykings.com/uploads/images/cover_image/small\",\n        \"coverImageMedium\": \"http://sandbox.ykings.com/uploads/images/cover_image/medium\",\n        \"coverImageLarge\": \"http://sandbox.ykings.com/uploads/images/cover_image/large\",\n        \"coverImageOriginal\": \"http://sandbox.ykings.com/uploads/images/cover_image/original\"\n      }\n  }",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "error",
            "description": "<p>Message token_invalid.</p> "
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 400 Invalid Request\n{\n  \"status\" : 0,\n  \"error\": \"token_invalid\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 401 Unauthorised\n{\n  \"status\" : 0,\n  \"error\": \"token_expired\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 400 Bad Request\n{\n  \"status\" : 0,\n  \"error\": \"token_not_provided\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 422 Validation error\n{\n  \"status\" : 0,\n  \"error\": \"user_id required\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 422 Validation error\n{\n  \"status\" : 0,\n  \"error\": \"video_id_id required\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 500 cannot_able_to_delete_this_video\n{\n  \"status\" : 0,\n  \"error\": \"cannot_able_to_delete_this_video\"\n}",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "app/Http/Controllers/Api/UserVideosController.php",
    "groupTitle": "User"
  },
  {
    "type": "post",
    "url": "/user/history/exercise",
    "title": "getUserExerciseHistory",
    "name": "getUserExerciseHistory",
    "group": "User",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "<p>integer</p> ",
            "optional": false,
            "field": "user_id",
            "description": "<p>id of loggedin user *required</p> "
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "<p>String</p> ",
            "optional": false,
            "field": "success.",
            "description": ""
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n\n{\n      \"status\": 1,\n      \"success\": \"history\",\n      \"exercise_history\": [\n      {\n      \"id\": \"1\",\n      \"name\": \"Jumping Pullups\",\n      \"description\": \"The jumping pull-up is a challenging full body exercise that targets the back, legs and arms.\",\n      \"category\": \"1\",\n      \"type\": \"1\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"1\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"scores\": {\n      \"10\": [],\n      \"20\": [],\n      \"25\": [\n      {\n      \"id\": \"2\",\n      \"user_id\": \"96\",\n      \"exercise_id\": \"1\",\n      \"status\": \"1\",\n      \"time\": \"29\",\n      \"is_starred\": \"0\",\n      \"volume\": \"25\",\n      \"feed_id\": \"2\",\n      \"created_at\": \"2016-01-07 10:25:18\",\n      \"updated_at\": \"2016-01-07 10:25:18\"\n      }\n      ],\n      \"30\": [],\n      \"50\": [\n      {\n      \"id\": \"1\",\n      \"user_id\": \"96\",\n      \"exercise_id\": \"1\",\n      \"status\": \"1\",\n      \"time\": \"57\",\n      \"is_starred\": \"0\",\n      \"volume\": \"50\",\n      \"feed_id\": \"1\",\n      \"created_at\": \"2016-01-07 10:23:02\",\n      \"updated_at\": \"2016-01-07 10:23:02\"\n      }\n      ],\n      \"60\": [],\n      \"100\": [],\n      \"120\": [],\n      \"180\": [],\n      \"240\": [],\n      \"250\": [],\n      \"300\": [],\n      \"360\": [],\n      \"420\": [],\n      \"480\": [],\n      \"500\": [],\n      \"540\": [],\n      \"600\": [],\n      \"750\": [],\n      \"1000\": []\n      }\n      },\n      {\n      \"id\": \"2\",\n      \"name\": \"Australian Pullups\",\n      \"description\": \"Australian pull-ups are becoming a very popular exercise. Like all types of pull-ups (and all types of exercises for that matter) there are many different ways to do the Australian, and it can be incorporated into a number of different contexts within a workout.\",\n      \"category\": \"1\",\n      \"type\": \"2\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"1\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"scores\": {\n      \"10\": [],\n      \"20\": [],\n      \"25\": [],\n      \"30\": [],\n      \"50\": [],\n      \"60\": [],\n      \"100\": [],\n      \"120\": [],\n      \"180\": [],\n      \"240\": [],\n      \"250\": [],\n      \"300\": [],\n      \"360\": [],\n      \"420\": [],\n      \"480\": [],\n      \"500\": [],\n      \"540\": [],\n      \"600\": [],\n      \"750\": [],\n      \"1000\": []\n      }\n      },\n      {\n      \"id\": \"3\",\n      \"name\": \"Knee Raises\",\n      \"description\": \"Standing Knee Raises (also known as standing knee crunches and standing knee pulls) is a functional abdominal exercise for boosting strength throughout the core. Unlike standard ab exercises, they don’t isolate abdominal muscles. Instead they work your upper abs and lower abs in conjunction with other important muscles such as hips, back and shoulders.\",\n      \"category\": \"1\",\n      \"type\": \"2\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"1\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"scores\": {\n      \"10\": [],\n      \"20\": [],\n      \"25\": [],\n      \"30\": [],\n      \"50\": [],\n      \"60\": [],\n      \"100\": [],\n      \"120\": [],\n      \"180\": [],\n      \"240\": [],\n      \"250\": [],\n      \"300\": [],\n      \"360\": [],\n      \"420\": [],\n      \"480\": [],\n      \"500\": [],\n      \"540\": [],\n      \"600\": [],\n      \"750\": [],\n      \"1000\": []\n      }\n      },\n      {\n      \"id\": \"4\",\n      \"name\": \"Skin the cat\",\n      \"description\": \"A good upper body stretching exercise, especially for achieving full range of motion in the shoulder. The skin the cat exercise is a fundamental movement performed on gymnastics rings.\",\n      \"category\": \"1\",\n      \"type\": \"2\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"scores\": {\n      \"10\": [],\n      \"20\": [],\n      \"25\": [],\n      \"30\": [],\n      \"50\": [\n      {\n      \"id\": \"10\",\n      \"user_id\": \"96\",\n      \"exercise_id\": \"4\",\n      \"status\": \"1\",\n      \"time\": \"30\",\n      \"is_starred\": \"0\",\n      \"volume\": \"50\",\n      \"feed_id\": \"22\",\n      \"created_at\": \"2016-01-08 05:41:06\",\n      \"updated_at\": \"2016-01-08 05:41:06\"\n      }\n      ],\n      \"60\": [],\n      \"100\": [\n      {\n      \"id\": \"11\",\n      \"user_id\": \"96\",\n      \"exercise_id\": \"4\",\n      \"status\": \"1\",\n      \"time\": \"30\",\n      \"is_starred\": \"0\",\n      \"volume\": \"100\",\n      \"feed_id\": \"23\",\n      \"created_at\": \"2016-01-08 05:41:35\",\n      \"updated_at\": \"2016-01-08 05:41:35\"\n      }\n      ],\n      \"120\": [],\n      \"180\": [],\n      \"240\": [],\n      \"250\": [],\n      \"300\": [],\n      \"360\": [],\n      \"420\": [],\n      \"480\": [],\n      \"500\": [],\n      \"540\": [],\n      \"600\": [],\n      \"750\": [],\n      \"1000\": []\n      }\n      },\n      {\n      \"id\": \"5\",\n      \"name\": \"Side Trizeps\",\n      \"description\": \"\",\n      \"category\": \"1\",\n      \"type\": \"1\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"30\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"scores\": {\n      \"10\": [],\n      \"20\": [],\n      \"25\": [],\n      \"30\": [],\n      \"50\": [],\n      \"60\": [],\n      \"100\": [],\n      \"120\": [],\n      \"180\": [],\n      \"240\": [],\n      \"250\": [],\n      \"300\": [],\n      \"360\": [],\n      \"420\": [],\n      \"480\": [],\n      \"500\": [],\n      \"540\": [],\n      \"600\": [],\n      \"750\": [],\n      \"1000\": []\n      }\n      },\n      {\n      \"id\": \"6\",\n      \"name\": \"Trizeps Extension\",\n      \"description\": \"\",\n      \"category\": \"1\",\n      \"type\": \"2\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"1\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"scores\": {\n      \"10\": [],\n      \"20\": [],\n      \"25\": [],\n      \"30\": [],\n      \"50\": [],\n      \"60\": [],\n      \"100\": [],\n      \"120\": [],\n      \"180\": [],\n      \"240\": [],\n      \"250\": [],\n      \"300\": [],\n      \"360\": [],\n      \"420\": [],\n      \"480\": [],\n      \"500\": [],\n      \"540\": [],\n      \"600\": [],\n      \"750\": [],\n      \"1000\": []\n      }\n      },\n      {\n      \"id\": \"7\",\n      \"name\": \"Wall Sits\",\n      \"description\": \"\",\n      \"category\": \"1\",\n      \"type\": \"1\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"seconds\",\n      \"equipment\": \"\",\n      \"scores\": {\n      \"10\": [],\n      \"20\": [],\n      \"25\": [],\n      \"30\": [],\n      \"50\": [],\n      \"60\": [],\n      \"100\": [],\n      \"120\": [],\n      \"180\": [],\n      \"240\": [],\n      \"250\": [],\n      \"300\": [],\n      \"360\": [],\n      \"420\": [],\n      \"480\": [],\n      \"500\": [],\n      \"540\": [],\n      \"600\": [],\n      \"750\": [],\n      \"1000\": []\n      }\n      },\n      {\n      \"id\": \"8\",\n      \"name\": \"Single Leg Deadlift\",\n      \"description\": \"\",\n      \"category\": \"1\",\n      \"type\": \"2\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"1\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"scores\": {\n      \"10\": [],\n      \"20\": [],\n      \"25\": [],\n      \"30\": [],\n      \"50\": [],\n      \"60\": [],\n      \"100\": [\n      {\n      \"id\": \"12\",\n      \"user_id\": \"96\",\n      \"exercise_id\": \"8\",\n      \"status\": \"1\",\n      \"time\": \"100\",\n      \"is_starred\": \"0\",\n      \"volume\": \"100\",\n      \"feed_id\": \"24\",\n      \"created_at\": \"2016-01-08 05:42:12\",\n      \"updated_at\": \"2016-01-08 05:42:12\"\n      }\n      ],\n      \"120\": [],\n      \"180\": [],\n      \"240\": [],\n      \"250\": [],\n      \"300\": [],\n      \"360\": [],\n      \"420\": [],\n      \"480\": [],\n      \"500\": [],\n      \"540\": [],\n      \"600\": [],\n      \"750\": [],\n      \"1000\": []\n      }\n      },\n      {\n      \"id\": \"9\",\n      \"name\": \"Climbers\",\n      \"description\": \"\",\n      \"category\": \"1\",\n      \"type\": \"2\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"1\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"scores\": {\n      \"10\": [],\n      \"20\": [],\n      \"25\": [],\n      \"30\": [],\n      \"50\": [],\n      \"60\": [],\n      \"100\": [],\n      \"120\": [],\n      \"180\": [],\n      \"240\": [],\n      \"250\": [],\n      \"300\": [],\n      \"360\": [],\n      \"420\": [],\n      \"480\": [],\n      \"500\": [],\n      \"540\": [],\n      \"600\": [],\n      \"750\": [],\n      \"1000\": []\n      }\n      }\n      ],\n      \"urls\": {\n      \"profileImageSmall\": \"http://sandbox.ykings.com/uploads/images/profile/small\",\n      \"profileImageMedium\": \"http://sandbox.ykings.com/uploads/images/profile/medium\",\n      \"profileImageLarge\": \"http://sandbox.ykings.com/uploads/images/profile/large\",\n      \"profileImageOriginal\": \"http://sandbox.ykings.com/uploads/images/profile/original\",\n      \"video\": \"http://sandbox.ykings.com/uploads/videos\",\n      \"videothumbnail\": \"http://sandbox.ykings.com/uploads/images/videothumbnails\",\n      \"feedImageSmall\": \"http://sandbox.ykings.com/uploads/images/feed/small\",\n      \"feedImageMedium\": \"http://sandbox.ykings.com/uploads/images/feed/medium\",\n      \"feedImageLarge\": \"http://sandbox.ykings.com/uploads/images/feed/large\",\n      \"feedImageOriginal\": \"http://sandbox.ykings.com/uploads/images/feed/original\",\n      \"coverImageSmall\": \"http://sandbox.ykings.com/uploads/images/cover_image/small\",\n      \"coverImageMedium\": \"http://sandbox.ykings.com/uploads/images/cover_image/medium\",\n      \"coverImageLarge\": \"http://sandbox.ykings.com/uploads/images/cover_image/large\",\n      \"coverImageOriginal\": \"http://sandbox.ykings.com/uploads/images/cover_image/original\"\n      }\n      }",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "error",
            "description": "<p>Message token_invalid.</p> "
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "user_not_exists",
            "description": "<p>User error.</p> "
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 400 Invalid Request\n{\n  \"status\":\"0\",\n  \"error\": \"token_invalid\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 401 Unauthorised\n{\n  \"status\":\"0\",\n  \"error\": \"token_expired\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 400 Bad Request\n{\n  \"status\":\"0\",\n  \"error\": \"token_not_provided\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 400 Bad Request\n{\n  \"status\":\"0\",\n  \"error\": \"user_not_exists\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 422 Validation error\n{\n  \"status\" : 0,\n  \"error\": \"The user_id field is required\"\n}",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "app/Http/Controllers/Api/UsersController.php",
    "groupTitle": "User"
  },
  {
    "type": "post",
    "url": "/user/options/goaloptions",
    "title": "getUserGoalOptions",
    "name": "getUserGoalOptions",
    "group": "User",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "<p>integer</p> ",
            "optional": false,
            "field": "user_id",
            "description": "<p>id of loggedin user *required</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>integer</p> ",
            "optional": false,
            "field": "progression_id",
            "description": "<p>id of Progression *required</p> "
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "<p>String</p> ",
            "optional": false,
            "field": "success.",
            "description": ""
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n{\n      \"status\": 1,\n      \"success\": \"user_selected_goals\",\n      \"skill_levels\": [\n      {\n      \"id\": \"5\",\n      \"description\": \"\",\n      \"progression_id\": \"1\",\n      \"level\": \"5\",\n      \"row\": \"1\",\n      \"substitute\": \"0\",\n      \"exercise_id\": \"69\",\n      \"created_at\": \"2015-12-14 03:04:45\",\n      \"updated_at\": \"2015-12-15 05:48:46\",\n      \"exercise\": {\n      \"id\": \"69\",\n      \"name\": \"Muscleups\",\n      \"description\": \"\",\n      \"category\": \"3\",\n      \"type\": \"1\",\n      \"muscle_groups\": \"0\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"1\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \"\",\n      \"video_tips\": \"\",\n      \"pro_tips\": \"\",\n      \"video\": [\n      {\n      \"id\": \"69\",\n      \"path\": \"Now69.mp4\",\n      \"videothumbnail\": \"thumbnail3.jpg\",\n      \"description\": \"Test Description\"\n      }\n      ]\n      },\n      \"is_selected\": 1\n      },\n      {\n      \"id\": \"10\",\n      \"description\": \"\",\n      \"progression_id\": \"1\",\n      \"level\": \"5\",\n      \"row\": \"2\",\n      \"substitute\": \"0\",\n      \"exercise_id\": \"77\",\n      \"created_at\": \"2015-12-14 03:04:45\",\n      \"updated_at\": \"2015-12-15 05:48:46\",\n      \"exercise\": {\n      \"id\": \"77\",\n      \"name\": \"Front Lever\",\n      \"description\": \"\",\n      \"category\": \"3\",\n      \"type\": \"2\",\n      \"muscle_groups\": \"0\",\n      \"rewards\": \"10.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"seconds\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \"\",\n      \"video_tips\": \"\",\n      \"pro_tips\": \"\",\n      \"video\": [\n      {\n      \"id\": \"78\",\n      \"path\": \"Now78.mp4\",\n      \"videothumbnail\": \"thumbnail2.png\",\n      \"description\": \"Test Description\"\n      }\n      ]\n      },\n      \"is_selected\": 0\n      },\n      {\n      \"id\": \"15\",\n      \"description\": \"\",\n      \"progression_id\": \"1\",\n      \"level\": \"5\",\n      \"row\": \"3\",\n      \"substitute\": \"0\",\n      \"exercise_id\": \"78\",\n      \"created_at\": \"2015-12-14 03:04:45\",\n      \"updated_at\": \"2015-12-15 05:48:46\",\n      \"exercise\": {\n      \"id\": \"78\",\n      \"name\": \"Pullover\",\n      \"description\": \"\",\n      \"category\": \"3\",\n      \"type\": \"2\",\n      \"muscle_groups\": \"0\",\n      \"rewards\": \"10.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"1\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \"\",\n      \"video_tips\": \"\",\n      \"pro_tips\": \"\",\n      \"video\": [\n      {\n      \"id\": \"79\",\n      \"path\": \"Now79.mp4\",\n      \"videothumbnail\": \"thumbnail3.jpg\",\n      \"description\": \"Test Description\"\n      }\n      ]\n      },\n      \"is_selected\": 0\n      },\n      {\n      \"id\": \"20\",\n      \"description\": \"\",\n      \"progression_id\": \"1\",\n      \"level\": \"5\",\n      \"row\": \"4\",\n      \"substitute\": \"0\",\n      \"exercise_id\": \"79\",\n      \"created_at\": \"2015-12-14 03:04:45\",\n      \"updated_at\": \"2015-12-15 05:48:46\",\n      \"exercise\": {\n      \"id\": \"79\",\n      \"name\": \"Back Lever\",\n      \"description\": \"\",\n      \"category\": \"3\",\n      \"type\": \"2\",\n      \"muscle_groups\": \"0\",\n      \"rewards\": \"10.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"seconds\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \"\",\n      \"video_tips\": \"\",\n      \"pro_tips\": \"\",\n      \"video\": [\n      {\n      \"id\": \"80\",\n      \"path\": \"Now80.mp4\",\n      \"videothumbnail\": \"thumbnail1.png\",\n      \"description\": \"Test Description\"\n      }\n      ]\n      },\n      \"is_selected\": 1\n      }\n      ]\n      }",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "error",
            "description": "<p>Message token_invalid.</p> "
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "user_not_exists",
            "description": "<p>User error.</p> "
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 400 Invalid Request\n{\n  \"status\":\"0\",\n  \"error\": \"token_invalid\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 401 Unauthorised\n{\n  \"status\":\"0\",\n  \"error\": \"token_expired\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 400 Bad Request\n{\n  \"status\":\"0\",\n  \"error\": \"token_not_provided\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 500 Bad Request\n{\n  \"status\":\"0\",\n  \"error\": \"user_not_exists\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 422 Validation error\n{\n  \"status\" : 0,\n  \"error\": \"The user_id field is required\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 422 Validation error\n{\n  \"status\" : 0,\n  \"error\": \"The progression_id field is required\"\n}",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "app/Http/Controllers/Api/UsersController.php",
    "groupTitle": "User"
  },
  {
    "type": "post",
    "url": "/user/history/hiit",
    "title": "getUserHiitHistory",
    "name": "getUserHiitHistory",
    "group": "User",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "<p>integer</p> ",
            "optional": false,
            "field": "user_id",
            "description": "<p>id of loggedin user *required</p> "
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "<p>String</p> ",
            "optional": false,
            "field": "success.",
            "description": ""
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n{\n      \"status\": 1,\n      \"success\": \"history\",\n      \"hiit_history\": [\n      {\n      \"id\": \"1\",\n      \"name\": \"30/30\",\n      \"description\": \"Interval 4 rounds to 10 rounds\",\n      \"exercises\": \"\",\n      \"rewards\": \"330.00\",\n      \"scores\": {\n      \"1\": [],\n      \"2\": [],\n      \"3\": [],\n      \"4\": [\n      {\n      \"id\": \"2\",\n      \"hiit_id\": \"1\",\n      \"user_id\": \"96\",\n      \"status\": \"1\",\n      \"time\": \"1500.00\",\n      \"is_starred\": \"0\",\n      \"volume\": \"4\",\n      \"feed_id\": \"38\",\n      \"created_at\": \"2016-01-08 06:02:50\",\n      \"updated_at\": \"2016-01-08 06:02:50\"\n      }\n      ],\n      \"5\": [],\n      \"6\": [],\n      \"7\": [],\n      \"8\": [],\n      \"9\": [],\n      \"10\": [\n      {\n      \"id\": \"9\",\n      \"hiit_id\": \"1\",\n      \"user_id\": \"96\",\n      \"status\": \"1\",\n      \"time\": \"2250.00\",\n      \"is_starred\": \"0\",\n      \"volume\": \"10\",\n      \"feed_id\": \"45\",\n      \"created_at\": \"2016-01-08 06:04:32\",\n      \"updated_at\": \"2016-01-08 06:04:32\"\n      }\n      ],\n      \"11\": [],\n      \"12\": [],\n      \"13\": [],\n      \"14\": [],\n      \"16\": []\n      }\n      },\n      {\n      \"id\": \"2\",\n      \"name\": \"20/10\",\n      \"description\": \"Interval 4 rounds to 8 rounds\",\n      \"exercises\": \"\",\n      \"rewards\": \"330.00\",\n      \"scores\": {\n      \"1\": [],\n      \"2\": [],\n      \"3\": [],\n      \"4\": [],\n      \"5\": [\n      {\n      \"id\": \"4\",\n      \"hiit_id\": \"2\",\n      \"user_id\": \"96\",\n      \"status\": \"1\",\n      \"time\": \"1500.00\",\n      \"is_starred\": \"0\",\n      \"volume\": \"5\",\n      \"feed_id\": \"40\",\n      \"created_at\": \"2016-01-08 06:03:17\",\n      \"updated_at\": \"2016-01-08 06:03:17\"\n      }\n      ],\n      \"6\": [],\n      \"7\": [\n      {\n      \"id\": \"3\",\n      \"hiit_id\": \"2\",\n      \"user_id\": \"96\",\n      \"status\": \"1\",\n      \"time\": \"1500.00\",\n      \"is_starred\": \"0\",\n      \"volume\": \"7\",\n      \"feed_id\": \"39\",\n      \"created_at\": \"2016-01-08 06:03:10\",\n      \"updated_at\": \"2016-01-08 06:03:10\"\n      }\n      ],\n      \"8\": [\n      {\n      \"id\": \"5\",\n      \"hiit_id\": \"2\",\n      \"user_id\": \"96\",\n      \"status\": \"1\",\n      \"time\": \"1500.00\",\n      \"is_starred\": \"0\",\n      \"volume\": \"8\",\n      \"feed_id\": \"41\",\n      \"created_at\": \"2016-01-08 06:03:27\",\n      \"updated_at\": \"2016-01-08 06:03:27\"\n      }\n      ],\n      \"9\": [],\n      \"10\": [],\n      \"11\": [],\n      \"12\": [],\n      \"13\": [],\n      \"14\": [],\n      \"16\": []\n      }\n      },\n      {\n      \"id\": \"3\",\n      \"name\": \"60/120\",\n      \"description\": \"Interval 3 to 5 rounds\",\n      \"exercises\": \"\",\n      \"rewards\": \"330.00\",\n      \"scores\": {\n      \"1\": [],\n      \"2\": [],\n      \"3\": [\n      {\n      \"id\": \"6\",\n      \"hiit_id\": \"3\",\n      \"user_id\": \"96\",\n      \"status\": \"1\",\n      \"time\": \"1500.00\",\n      \"is_starred\": \"0\",\n      \"volume\": \"3\",\n      \"feed_id\": \"42\",\n      \"created_at\": \"2016-01-08 06:03:37\",\n      \"updated_at\": \"2016-01-08 06:03:37\"\n      }\n      ],\n      \"4\": [\n      {\n      \"id\": \"7\",\n      \"hiit_id\": \"3\",\n      \"user_id\": \"96\",\n      \"status\": \"1\",\n      \"time\": \"1500.00\",\n      \"is_starred\": \"0\",\n      \"volume\": \"4\",\n      \"feed_id\": \"43\",\n      \"created_at\": \"2016-01-08 06:03:44\",\n      \"updated_at\": \"2016-01-08 06:03:44\"\n      }\n      ],\n      \"5\": [\n      {\n      \"id\": \"8\",\n      \"hiit_id\": \"3\",\n      \"user_id\": \"96\",\n      \"status\": \"1\",\n      \"time\": \"1500.00\",\n      \"is_starred\": \"0\",\n      \"volume\": \"5\",\n      \"feed_id\": \"44\",\n      \"created_at\": \"2016-01-08 06:03:48\",\n      \"updated_at\": \"2016-01-08 06:03:48\"\n      }\n      ],\n      \"6\": [],\n      \"7\": [],\n      \"8\": [],\n      \"9\": [],\n      \"10\": [],\n      \"11\": [],\n      \"12\": [],\n      \"13\": [],\n      \"14\": [],\n      \"16\": []\n      }\n      }\n      ]\n      }",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "error",
            "description": "<p>Message token_invalid.</p> "
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "user_not_exists",
            "description": "<p>User error.</p> "
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 400 Invalid Request\n{\n  \"status\":\"0\",\n  \"error\": \"token_invalid\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 401 Unauthorised\n{\n  \"status\":\"0\",\n  \"error\": \"token_expired\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 400 Bad Request\n{\n  \"status\":\"0\",\n  \"error\": \"token_not_provided\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 400 Bad Request\n{\n  \"status\":\"0\",\n  \"error\": \"user_not_exists\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 422 Validation error\n{\n  \"status\" : 0,\n  \"error\": \"The user_id field is required\"\n}",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "app/Http/Controllers/Api/UsersController.php",
    "groupTitle": "User"
  },
  {
    "type": "post",
    "url": "/user/options/physiqueoptions",
    "title": "getUserPhysiqueOptions",
    "name": "getUserPhysiqueOptions",
    "group": "User",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "<p>integer</p> ",
            "optional": false,
            "field": "user_id",
            "description": "<p>id of loggedin user *required</p> "
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "<p>String</p> ",
            "optional": false,
            "field": "success.",
            "description": ""
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n{\n      \"status\": 1,\n      \"success\": \"physique_groups\",\n      \"physique_groups\": [\n      {\n      \"id\": \"1\",\n      \"name\": \"Shoulders\",\n      \"is_selected\": 1\n      },\n      {\n      \"id\": \"2\",\n      \"name\": \"Chest\",\n      \"is_selected\": 1\n      },\n      {\n      \"id\": \"3\",\n      \"name\": \"Triceps\",\n      \"is_selected\": 1\n      },\n      {\n      \"id\": \"4\",\n      \"name\": \"Lower Back\",\n      \"is_selected\": 0\n      },\n      {\n      \"id\": \"5\",\n      \"name\": \"Arms\",\n      \"is_selected\": 1\n      },\n      {\n      \"id\": \"6\",\n      \"name\": \"Core\",\n      \"is_selected\": 1\n      },\n      {\n      \"id\": \"7\",\n      \"name\": \"Legs\",\n      \"is_selected\": 1\n      },\n      {\n      \"id\": \"8\",\n      \"name\": \"Full Body\",\n      \"is_selected\": 0\n      }\n      ]\n      }",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "error",
            "description": "<p>Message token_invalid.</p> "
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "user_not_exists",
            "description": "<p>User error.</p> "
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 400 Invalid Request\n{\n  \"status\":\"0\",\n  \"error\": \"token_invalid\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 401 Unauthorised\n{\n  \"status\":\"0\",\n  \"error\": \"token_expired\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 400 Bad Request\n{\n  \"status\":\"0\",\n  \"error\": \"token_not_provided\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 500 Bad Request\n{\n  \"status\":\"0\",\n  \"error\": \"user_not_exists\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 422 Validation error\n{\n  \"status\" : 0,\n  \"error\": \"The user_id field is required\"\n}",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "app/Http/Controllers/Api/UsersController.php",
    "groupTitle": "User"
  },
  {
    "type": "post",
    "url": "/user/history/recent",
    "title": "getUserRecentHistory",
    "name": "getUserRecentHistory",
    "group": "User",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "<p>integer</p> ",
            "optional": false,
            "field": "user_id",
            "description": "<p>id of loggedin user *required</p> "
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "<p>String</p> ",
            "optional": false,
            "field": "success.",
            "description": ""
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n{\n      \"status\": 1,\n      \"success\": \"history\",\n      \"history\": [\n      {\n      \"id\": \"25\",\n      \"user_id\": \"96\",\n      \"item_type\": \"exercise\",\n      \"item_id\": \"35\",\n      \"feed_text\": \"Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Integer pulvinar suscipit ante vitae ultricies.\",\n      \"created_at\": \"2016-01-08 05:43:32\",\n      \"updated_at\": \"2016-01-08 05:43:32\",\n      \"category\": \"Athletic\",\n      \"item_name\": \"One Leg Back Lever\",\n      \"duration\": \"100\",\n      \"volume\": \"10\",\n      \"points\": \"60.00\"\n      },\n      {\n      \"id\": \"24\",\n      \"user_id\": \"96\",\n      \"item_type\": \"exercise\",\n      \"item_id\": \"8\",\n      \"feed_text\": \"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean eget orci fringilla, tempor nibh quis, varius lectus. Nunc maximus diam ac lacus dictum pulvinar.\",\n      \"created_at\": \"2016-01-08 05:42:12\",\n      \"updated_at\": \"2016-01-08 05:42:12\",\n      \"category\": \"Lean\",\n      \"item_name\": \"Single Leg Deadlift\",\n      \"duration\": \"100\",\n      \"volume\": \"100\",\n      \"points\": \"60.00\"\n      },\n      {\n      \"id\": \"23\",\n      \"user_id\": \"96\",\n      \"item_type\": \"exercise\",\n      \"item_id\": \"4\",\n      \"feed_text\": \"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean eget orci fringilla, tempor nibh quis, varius lectus. Nunc maximus diam ac lacus dictum pulvinar.\",\n      \"created_at\": \"2016-01-08 05:41:35\",\n      \"updated_at\": \"2016-01-08 05:41:35\",\n      \"category\": \"Lean\",\n      \"item_name\": \"Skin the cat\",\n      \"duration\": \"30\",\n      \"volume\": \"100\",\n      \"points\": \"60.00\"\n      },\n      {\n      \"id\": \"22\",\n      \"user_id\": \"96\",\n      \"item_type\": \"exercise\",\n      \"item_id\": \"4\",\n      \"feed_text\": \"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean eget orci fringilla, tempor nibh quis, varius lectus. Nunc maximus diam ac lacus dictum pulvinar.\",\n      \"created_at\": \"2016-01-08 05:41:06\",\n      \"updated_at\": \"2016-01-08 05:41:06\",\n      \"category\": \"Lean\",\n      \"item_name\": \"Skin the cat\",\n      \"duration\": \"30\",\n      \"volume\": \"50\",\n      \"points\": \"30.00\"\n      },\n      {\n      \"id\": \"21\",\n      \"user_id\": \"96\",\n      \"item_type\": \"exercise\",\n      \"item_id\": \"2\",\n      \"feed_text\": \"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean eget orci fringilla, tempor nibh quis, varius lectus. Nunc maximus diam ac lacus dictum pulvinar.\",\n      \"created_at\": \"2016-01-08 05:40:20\",\n      \"updated_at\": \"2016-01-08 05:40:20\",\n      \"category\": \"Lean\",\n      \"item_name\": \"Australian Pullups\",\n      \"duration\": \"30\",\n      \"volume\": \"3\",\n      \"points\": \"1.80\"\n      },\n      {\n      \"id\": \"2\",\n      \"user_id\": \"96\",\n      \"item_type\": \"exercise\",\n      \"item_id\": \"1\",\n      \"feed_text\": \"not bad\",\n      \"created_at\": \"2016-01-07 10:25:18\",\n      \"updated_at\": \"2016-01-07 10:25:18\",\n      \"category\": \"Lean\",\n      \"item_name\": \"Jumping Pullups\",\n      \"duration\": \"29\",\n      \"volume\": \"25\",\n      \"points\": \"25.00\"\n      },\n      {\n      \"id\": \"1\",\n      \"user_id\": \"96\",\n      \"item_type\": \"exercise\",\n      \"item_id\": \"1\",\n      \"feed_text\": \"its cool\",\n      \"created_at\": \"2016-01-07 10:23:02\",\n      \"updated_at\": \"2016-01-07 10:23:02\",\n      \"category\": \"Lean\",\n      \"item_name\": \"Jumping Pullups\",\n      \"duration\": \"57\",\n      \"volume\": \"50\",\n      \"points\": \"50.00\"\n      }\n      ],\n      \"urls\": {\n      \"profileImageSmall\": \"http://sandbox.ykings.com/uploads/images/profile/small\",\n      \"profileImageMedium\": \"http://sandbox.ykings.com/uploads/images/profile/medium\",\n      \"profileImageLarge\": \"http://sandbox.ykings.com/uploads/images/profile/large\",\n      \"profileImageOriginal\": \"http://sandbox.ykings.com/uploads/images/profile/original\",\n      \"video\": \"http://sandbox.ykings.com/uploads/videos\",\n      \"videothumbnail\": \"http://sandbox.ykings.com/uploads/images/videothumbnails\",\n      \"feedImageSmall\": \"http://sandbox.ykings.com/uploads/images/feed/small\",\n      \"feedImageMedium\": \"http://sandbox.ykings.com/uploads/images/feed/medium\",\n      \"feedImageLarge\": \"http://sandbox.ykings.com/uploads/images/feed/large\",\n      \"feedImageOriginal\": \"http://sandbox.ykings.com/uploads/images/feed/original\",\n      \"coverImageSmall\": \"http://sandbox.ykings.com/uploads/images/cover_image/small\",\n      \"coverImageMedium\": \"http://sandbox.ykings.com/uploads/images/cover_image/medium\",\n      \"coverImageLarge\": \"http://sandbox.ykings.com/uploads/images/cover_image/large\",\n      \"coverImageOriginal\": \"http://sandbox.ykings.com/uploads/images/cover_image/original\"\n      }\n      }",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "error",
            "description": "<p>Message token_invalid.</p> "
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "user_not_exists",
            "description": "<p>User error.</p> "
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 400 Invalid Request\n{\n  \"status\":\"0\",\n  \"error\": \"token_invalid\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 401 Unauthorised\n{\n  \"status\":\"0\",\n  \"error\": \"token_expired\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 400 Bad Request\n{\n  \"status\":\"0\",\n  \"error\": \"token_not_provided\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 400 Bad Request\n{\n  \"status\":\"0\",\n  \"error\": \"user_not_exists\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 422 Validation error\n{\n  \"status\" : 0,\n  \"error\": \"The user_id field is required\"\n}",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "app/Http/Controllers/Api/UsersController.php",
    "groupTitle": "User"
  },
  {
    "type": "post",
    "url": "/user/history/workout",
    "title": "getUserWorkoutHistory",
    "name": "getUserWorkoutHistory",
    "group": "User",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "<p>integer</p> ",
            "optional": false,
            "field": "user_id",
            "description": "<p>id of loggedin user *required</p> "
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "<p>String</p> ",
            "optional": false,
            "field": "success.",
            "description": ""
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n{\n      \"status\": 1,\n      \"success\": \"history\",\n      \"workout_history\": [\n      {\n      \"id\": \"1\",\n      \"name\": \"Baldur\",\n      \"description\": \"Baldur Baldur\",\n      \"rounds\": \"5\",\n      \"category\": \"1\",\n      \"type\": \"2\",\n      \"rewards\": \"{\\\"lean\\\":330,\\\"athletic\\\":440,\\\"strength\\\":550}\",\n      \"duration\": \"1680.00\",\n      \"equipments\": \"\",\n      \"lean\": {\n      \"1\": [],\n      \"2\": [],\n      \"3\": []\n      },\n      \"athletic\": {\n      \"1\": [],\n      \"2\": [],\n      \"3\": []\n      },\n      \"strength\": {\n      \"1\": [],\n      \"2\": [],\n      \"3\": []\n      }\n      },\n      {\n      \"id\": \"2\",\n      \"name\": \"Borr\",\n      \"description\": \"Borr Borr Borr\",\n      \"rounds\": \"3\",\n      \"category\": \"2\",\n      \"type\": \"1\",\n      \"rewards\": \"{\\\"lean\\\":330,\\\"athletic\\\":440,\\\"strength\\\":550}\",\n      \"duration\": \"1140.00\",\n      \"equipments\": \"Bar\",\n      \"lean\": {\n      \"1\": [],\n      \"2\": [\n      {\n      \"id\": \"7\",\n      \"workout_id\": \"2\",\n      \"user_id\": \"96\",\n      \"status\": \"1\",\n      \"time\": \"2900\",\n      \"is_starred\": \"0\",\n      \"volume\": \"2\",\n      \"focus\": \"1\",\n      \"feed_id\": \"14\",\n      \"created_at\": \"2016-01-07 13:01:07\",\n      \"updated_at\": \"2016-01-12 04:42:26\",\n      \"category\": \"1\"\n      },\n      {\n      \"id\": \"8\",\n      \"workout_id\": \"2\",\n      \"user_id\": \"96\",\n      \"status\": \"1\",\n      \"time\": \"2900\",\n      \"is_starred\": \"0\",\n      \"volume\": \"2\",\n      \"focus\": \"1\",\n      \"feed_id\": \"15\",\n      \"created_at\": \"2016-01-07 13:02:08\",\n      \"updated_at\": \"2016-01-12 04:42:30\",\n      \"category\": \"1\"\n      },\n      {\n      \"id\": \"9\",\n      \"workout_id\": \"2\",\n      \"user_id\": \"96\",\n      \"status\": \"1\",\n      \"time\": \"2900\",\n      \"is_starred\": \"0\",\n      \"volume\": \"2\",\n      \"focus\": \"1\",\n      \"feed_id\": \"16\",\n      \"created_at\": \"2016-01-07 13:02:22\",\n      \"updated_at\": \"2016-01-12 04:42:36\",\n      \"category\": \"1\"\n      }\n      ],\n      \"3\": []\n      },\n      \"athletic\": {\n      \"1\": [],\n      \"2\": [],\n      \"3\": []\n      },\n      \"strength\": {\n      \"1\": [],\n      \"2\": [],\n      \"3\": []\n      }\n      },\n      {\n      \"id\": \"3\",\n      \"name\": \"Bragi\",\n      \"description\": \"Bragi\",\n      \"rounds\": \"5\",\n      \"category\": \"2\",\n      \"type\": \"1\",\n      \"rewards\": \"{\\\"lean\\\":330,\\\"athletic\\\":440,\\\"strength\\\":550}\",\n      \"duration\": \"840.00\",\n      \"equipments\": \"Low Bar\",\n      \"lean\": {\n      \"1\": [],\n      \"2\": [],\n      \"3\": []\n      },\n      \"athletic\": {\n      \"1\": [],\n      \"2\": [],\n      \"3\": []\n      },\n      \"strength\": {\n      \"1\": [],\n      \"2\": [],\n      \"3\": []\n      }\n      },\n      {\n      \"id\": \"4\",\n      \"name\": \"Buri\",\n      \"description\": \"Buri\",\n      \"rounds\": \"1\",\n      \"category\": \"1\",\n      \"type\": \"2\",\n      \"rewards\": \"{\\\"lean\\\":330,\\\"athletic\\\":440,\\\"strength\\\":550}\",\n      \"duration\": \"1440.00\",\n      \"equipments\": \"Bar\",\n      \"lean\": {\n      \"1\": [],\n      \"2\": [],\n      \"3\": []\n      },\n      \"athletic\": {\n      \"1\": [],\n      \"2\": [],\n      \"3\": []\n      },\n      \"strength\": {\n      \"1\": [],\n      \"2\": [],\n      \"3\": []\n      }\n      },\n      {\n      \"id\": \"5\",\n      \"name\": \"Dagur\",\n      \"description\": \"Dagur\",\n      \"rounds\": \"3\",\n      \"category\": \"1\",\n      \"type\": \"2\",\n      \"rewards\": \"{\\\"lean\\\":330,\\\"athletic\\\":440,\\\"strength\\\":550}\",\n      \"duration\": \"1260.00\",\n      \"equipments\": \"Bar\",\n      \"lean\": {\n      \"1\": [],\n      \"2\": [],\n      \"3\": []\n      },\n      \"athletic\": {\n      \"1\": [],\n      \"2\": [],\n      \"3\": []\n      },\n      \"strength\": {\n      \"1\": [],\n      \"2\": [],\n      \"3\": []\n      }\n      },\n      {\n      \"id\": \"6\",\n      \"name\": \"Delling\",\n      \"description\": \"Delling\",\n      \"rounds\": \"1\",\n      \"category\": \"1\",\n      \"type\": \"2\",\n      \"rewards\": \"{\\\"lean\\\":330,\\\"athletic\\\":440,\\\"strength\\\":550}\",\n      \"duration\": \"1140.00\",\n      \"equipments\": \"Bar\",\n      \"lean\": {\n      \"1\": [\n      {\n      \"id\": \"15\",\n      \"workout_id\": \"6\",\n      \"user_id\": \"96\",\n      \"status\": \"1\",\n      \"time\": \"1500\",\n      \"is_starred\": \"0\",\n      \"volume\": \"1\",\n      \"focus\": \"1\",\n      \"feed_id\": \"29\",\n      \"created_at\": \"2016-01-08 05:46:46\",\n      \"updated_at\": \"2016-01-12 04:43:33\",\n      \"category\": \"1\"\n      }\n      ],\n      \"2\": [\n      {\n      \"id\": \"16\",\n      \"workout_id\": \"6\",\n      \"user_id\": \"96\",\n      \"status\": \"1\",\n      \"time\": \"1500\",\n      \"is_starred\": \"0\",\n      \"volume\": \"2\",\n      \"focus\": \"1\",\n      \"feed_id\": \"30\",\n      \"created_at\": \"2016-01-08 05:46:55\",\n      \"updated_at\": \"2016-01-12 04:43:37\",\n      \"category\": \"1\"\n      }\n      ],\n      \"3\": [\n      {\n      \"id\": \"17\",\n      \"workout_id\": \"6\",\n      \"user_id\": \"96\",\n      \"status\": \"1\",\n      \"time\": \"1500\",\n      \"is_starred\": \"0\",\n      \"volume\": \"3\",\n      \"focus\": \"1\",\n      \"feed_id\": \"31\",\n      \"created_at\": \"2016-01-08 05:47:00\",\n      \"updated_at\": \"2016-01-12 04:43:40\",\n      \"category\": \"1\"\n      }\n      ]\n      },\n      \"athletic\": {\n      \"1\": [],\n      \"2\": [\n      {\n      \"id\": \"12\",\n      \"workout_id\": \"6\",\n      \"user_id\": \"96\",\n      \"status\": \"1\",\n      \"time\": \"1500\",\n      \"is_starred\": \"0\",\n      \"volume\": \"2\",\n      \"focus\": \"2\",\n      \"feed_id\": \"26\",\n      \"created_at\": \"2016-01-08 05:45:46\",\n      \"updated_at\": \"2016-01-12 04:43:02\",\n      \"category\": \"2\"\n      },\n      {\n      \"id\": \"13\",\n      \"workout_id\": \"6\",\n      \"user_id\": \"96\",\n      \"status\": \"1\",\n      \"time\": \"1500\",\n      \"is_starred\": \"0\",\n      \"volume\": \"2\",\n      \"focus\": \"2\",\n      \"feed_id\": \"27\",\n      \"created_at\": \"2016-01-08 05:45:56\",\n      \"updated_at\": \"2016-01-12 04:43:06\",\n      \"category\": \"1\"\n      },\n      {\n      \"id\": \"14\",\n      \"workout_id\": \"6\",\n      \"user_id\": \"96\",\n      \"status\": \"1\",\n      \"time\": \"1500\",\n      \"is_starred\": \"0\",\n      \"volume\": \"2\",\n      \"focus\": \"2\",\n      \"feed_id\": \"28\",\n      \"created_at\": \"2016-01-08 05:46:02\",\n      \"updated_at\": \"2016-01-12 04:43:09\",\n      \"category\": \"3\"\n      }\n      ],\n      \"3\": []\n      },\n      \"strength\": {\n      \"1\": [],\n      \"2\": [],\n      \"3\": []\n      }\n      },\n      {\n      \"id\": \"7\",\n      \"name\": \"Eir\",\n      \"description\": \"Eir\",\n      \"rounds\": \"1\",\n      \"category\": \"2\",\n      \"type\": \"2\",\n      \"rewards\": \"{\\\"lean\\\":330,\\\"athletic\\\":440,\\\"strength\\\":550}\",\n      \"duration\": \"1020.00\",\n      \"equipments\": \"Bar\",\n      \"lean\": {\n      \"1\": [],\n      \"2\": [],\n      \"3\": []\n      },\n      \"athletic\": {\n      \"1\": [],\n      \"2\": [],\n      \"3\": []\n      },\n      \"strength\": {\n      \"1\": [],\n      \"2\": [],\n      \"3\": []\n      }\n      },\n      {\n      \"id\": \"8\",\n      \"name\": \"Eostre\",\n      \"description\": \"Eostre\",\n      \"rounds\": \"5\",\n      \"category\": \"1\",\n      \"type\": \"2\",\n      \"rewards\": \"{\\\"lean\\\":330,\\\"athletic\\\":440,\\\"strength\\\":550}\",\n      \"duration\": \"1260.00\",\n      \"equipments\": \"Ball,Bar\",\n      \"lean\": {\n      \"1\": [],\n      \"2\": [],\n      \"3\": []\n      },\n      \"athletic\": {\n      \"1\": [],\n      \"2\": [],\n      \"3\": []\n      },\n      \"strength\": {\n      \"1\": [],\n      \"2\": [],\n      \"3\": []\n      }\n      },\n      {\n      \"id\": \"9\",\n      \"name\": \"Elli\",\n      \"description\": \"Elli\",\n      \"rounds\": \"3\",\n      \"category\": \"2\",\n      \"type\": \"1\",\n      \"rewards\": \"{\\\"lean\\\":330,\\\"athletic\\\":440,\\\"strength\\\":550}\",\n      \"duration\": \"1380.00\",\n      \"equipments\": \"Bar\",\n      \"lean\": {\n      \"1\": [\n      {\n      \"id\": \"18\",\n      \"workout_id\": \"9\",\n      \"user_id\": \"96\",\n      \"status\": \"1\",\n      \"time\": \"1500\",\n      \"is_starred\": \"0\",\n      \"volume\": \"1\",\n      \"focus\": \"1\",\n      \"feed_id\": \"32\",\n      \"created_at\": \"2016-01-08 05:48:32\",\n      \"updated_at\": \"2016-01-12 04:43:44\",\n      \"category\": \"1\"\n      }\n      ],\n      \"2\": [\n      {\n      \"id\": \"19\",\n      \"workout_id\": \"9\",\n      \"user_id\": \"96\",\n      \"status\": \"1\",\n      \"time\": \"1500\",\n      \"is_starred\": \"0\",\n      \"volume\": \"2\",\n      \"focus\": \"1\",\n      \"feed_id\": \"33\",\n      \"created_at\": \"2016-01-08 05:48:45\",\n      \"updated_at\": \"2016-01-12 04:43:47\",\n      \"category\": \"1\"\n      }\n      ],\n      \"3\": [\n      {\n      \"id\": \"20\",\n      \"workout_id\": \"9\",\n      \"user_id\": \"96\",\n      \"status\": \"1\",\n      \"time\": \"1500\",\n      \"is_starred\": \"0\",\n      \"volume\": \"3\",\n      \"focus\": \"1\",\n      \"feed_id\": \"34\",\n      \"created_at\": \"2016-01-08 05:49:00\",\n      \"updated_at\": \"2016-01-12 04:43:51\",\n      \"category\": \"1\"\n      }\n      ]\n      },\n      \"athletic\": {\n      \"1\": [\n      {\n      \"id\": \"21\",\n      \"workout_id\": \"9\",\n      \"user_id\": \"96\",\n      \"status\": \"1\",\n      \"time\": \"1500\",\n      \"is_starred\": \"0\",\n      \"volume\": \"1\",\n      \"focus\": \"2\",\n      \"feed_id\": \"35\",\n      \"created_at\": \"2016-01-08 05:49:19\",\n      \"updated_at\": \"2016-01-12 04:44:06\",\n      \"category\": \"2\"\n      }\n      ],\n      \"2\": [\n      {\n      \"id\": \"22\",\n      \"workout_id\": \"9\",\n      \"user_id\": \"96\",\n      \"status\": \"1\",\n      \"time\": \"1500\",\n      \"is_starred\": \"0\",\n      \"volume\": \"2\",\n      \"focus\": \"2\",\n      \"feed_id\": \"36\",\n      \"created_at\": \"2016-01-08 05:49:27\",\n      \"updated_at\": \"2016-01-12 04:44:09\",\n      \"category\": \"2\"\n      }\n      ],\n      \"3\": []\n      },\n      \"strength\": {\n      \"1\": [],\n      \"2\": [],\n      \"3\": []\n      }\n      },\n      {\n      \"id\": \"10\",\n      \"name\": \"Loki\",\n      \"description\": \"Loki\",\n      \"rounds\": \"1\",\n      \"category\": \"1\",\n      \"type\": \"2\",\n      \"rewards\": \"{\\\"lean\\\":330,\\\"athletic\\\":440,\\\"strength\\\":550}\",\n      \"duration\": \"1440.00\",\n      \"equipments\": \"Bar, Bench\",\n      \"lean\": {\n      \"1\": [],\n      \"2\": [],\n      \"3\": []\n      },\n      \"athletic\": {\n      \"1\": [],\n      \"2\": [],\n      \"3\": []\n      },\n      \"strength\": {\n      \"1\": [],\n      \"2\": [],\n      \"3\": []\n      }\n      },\n      {\n      \"id\": \"11\",\n      \"name\": \"Hermodur\",\n      \"description\": \"Hermodur\",\n      \"rounds\": \"4\",\n      \"category\": \"1\",\n      \"type\": \"2\",\n      \"rewards\": \"{\\\"lean\\\":330,\\\"athletic\\\":440,\\\"strength\\\":550}\",\n      \"duration\": \"1740.00\",\n      \"equipments\": \"Bar\",\n      \"lean\": {\n      \"1\": [],\n      \"2\": [],\n      \"3\": []\n      },\n      \"athletic\": {\n      \"1\": [],\n      \"2\": [],\n      \"3\": []\n      },\n      \"strength\": {\n      \"1\": [],\n      \"2\": [],\n      \"3\": []\n      }\n      },\n      {\n      \"id\": \"12\",\n      \"name\": \"Forseti\",\n      \"description\": \"Forseti\",\n      \"rounds\": \"6\",\n      \"category\": \"2\",\n      \"type\": \"2\",\n      \"rewards\": \"{\\\"lean\\\":330,\\\"athletic\\\":440,\\\"strength\\\":550}\",\n      \"duration\": \"2280.00\",\n      \"equipments\": \"Bar\",\n      \"lean\": {\n      \"1\": [],\n      \"2\": [],\n      \"3\": []\n      },\n      \"athletic\": {\n      \"1\": [],\n      \"2\": [],\n      \"3\": []\n      },\n      \"strength\": {\n      \"1\": [],\n      \"2\": [],\n      \"3\": []\n      }\n      },\n      {\n      \"id\": \"13\",\n      \"name\": \"Magni\",\n      \"description\": \"Magni\",\n      \"rounds\": \"4\",\n      \"category\": \"1\",\n      \"type\": \"2\",\n      \"rewards\": \"{\\\"lean\\\":330,\\\"athletic\\\":440,\\\"strength\\\":550}\",\n      \"duration\": \"1380.00\",\n      \"equipments\": \"Low bar, Bar\",\n      \"lean\": {\n      \"1\": [],\n      \"2\": [],\n      \"3\": []\n      },\n      \"athletic\": {\n      \"1\": [],\n      \"2\": [],\n      \"3\": []\n      },\n      \"strength\": {\n      \"1\": [],\n      \"2\": [],\n      \"3\": []\n      }\n      },\n      {\n      \"id\": \"14\",\n      \"name\": \"Odin\",\n      \"description\": \"Odin\",\n      \"rounds\": \"1\",\n      \"category\": \"1\",\n      \"type\": \"2\",\n      \"rewards\": \"{\\\"lean\\\":330,\\\"athletic\\\":440,\\\"strength\\\":550}\",\n      \"duration\": \"1200.00\",\n      \"equipments\": \"Ball, Bar, Low bar\",\n      \"lean\": {\n      \"1\": [],\n      \"2\": [],\n      \"3\": []\n      },\n      \"athletic\": {\n      \"1\": [],\n      \"2\": [],\n      \"3\": []\n      },\n      \"strength\": {\n      \"1\": [],\n      \"2\": [],\n      \"3\": []\n      }\n      },\n      {\n      \"id\": \"15\",\n      \"name\": \"Mimir\",\n      \"description\": \"mimir\",\n      \"rounds\": \"4\",\n      \"category\": \"2\",\n      \"type\": \"1\",\n      \"rewards\": \"{\\\"lean\\\":330,\\\"athletic\\\":440,\\\"strength\\\":550}\",\n      \"duration\": \"920.00\",\n      \"equipments\": \"\",\n      \"lean\": {\n      \"1\": [],\n      \"2\": [],\n      \"3\": []\n      },\n      \"athletic\": {\n      \"1\": [],\n      \"2\": [\n      {\n      \"id\": \"23\",\n      \"workout_id\": \"15\",\n      \"user_id\": \"96\",\n      \"status\": \"1\",\n      \"time\": \"1500\",\n      \"is_starred\": \"0\",\n      \"volume\": \"2\",\n      \"focus\": \"2\",\n      \"feed_id\": \"37\",\n      \"created_at\": \"2016-01-08 05:49:36\",\n      \"updated_at\": \"2016-01-12 04:44:12\",\n      \"category\": \"2\"\n      }\n      ],\n      \"3\": []\n      },\n      \"strength\": {\n      \"1\": [],\n      \"2\": [],\n      \"3\": []\n      }\n      },\n      {\n      \"id\": \"16\",\n      \"name\": \"Tyr \",\n      \"description\": \"Tyr Tyr\",\n      \"rounds\": \"3\",\n      \"category\": \"1\",\n      \"type\": \"2\",\n      \"rewards\": \"{\\\"lean\\\":330,\\\"athletic\\\":440,\\\"strength\\\":550}\",\n      \"duration\": \"1560.00\",\n      \"equipments\": \"Bar, Bench\",\n      \"lean\": {\n      \"1\": [],\n      \"2\": [],\n      \"3\": []\n      },\n      \"athletic\": {\n      \"1\": [],\n      \"2\": [],\n      \"3\": []\n      },\n      \"strength\": {\n      \"1\": [],\n      \"2\": [],\n      \"3\": []\n      }\n      },\n      {\n      \"id\": \"17\",\n      \"name\": \"Thor\",\n      \"description\": \"Thor Thor\",\n      \"rounds\": \"1\",\n      \"category\": \"1\",\n      \"type\": \"2\",\n      \"rewards\": \"{\\\"lean\\\":330,\\\"athletic\\\":440,\\\"strength\\\":550}\",\n      \"duration\": \"1560.00\",\n      \"equipments\": \"Bar/Bench\",\n      \"lean\": {\n      \"1\": [],\n      \"2\": [],\n      \"3\": []\n      },\n      \"athletic\": {\n      \"1\": [],\n      \"2\": [],\n      \"3\": []\n      },\n      \"strength\": {\n      \"1\": [],\n      \"2\": [],\n      \"3\": []\n      }\n      },\n      {\n      \"id\": \"18\",\n      \"name\": \"Sif\",\n      \"description\": \"Sif\",\n      \"rounds\": \"3\",\n      \"category\": \"2\",\n      \"type\": \"1\",\n      \"rewards\": \"{\\\"lean\\\":330,\\\"athletic\\\":440,\\\"strength\\\":550}\",\n      \"duration\": \"0.00\",\n      \"equipments\": \"Bar\",\n      \"lean\": {\n      \"1\": [],\n      \"2\": [],\n      \"3\": []\n      },\n      \"athletic\": {\n      \"1\": [],\n      \"2\": [],\n      \"3\": []\n      },\n      \"strength\": {\n      \"1\": [],\n      \"2\": [],\n      \"3\": []\n      }\n      },\n      {\n      \"id\": \"19\",\n      \"name\": \"Hœnir\",\n      \"description\": \"Hœnir Hœnir\",\n      \"rounds\": \"3\",\n      \"category\": \"1\",\n      \"type\": \"2\",\n      \"rewards\": \"{\\\"lean\\\":330,\\\"athletic\\\":440,\\\"strength\\\":550}\",\n      \"duration\": \"1740.00\",\n      \"equipments\": \"\",\n      \"lean\": {\n      \"1\": [],\n      \"2\": [],\n      \"3\": []\n      },\n      \"athletic\": {\n      \"1\": [],\n      \"2\": [],\n      \"3\": []\n      },\n      \"strength\": {\n      \"1\": [],\n      \"2\": [],\n      \"3\": []\n      }\n      },\n      {\n      \"id\": \"20\",\n      \"name\": \"Snotra\",\n      \"description\": \"Snotra Snotra\",\n      \"rounds\": \"3\",\n      \"category\": \"2\",\n      \"type\": \"2\",\n      \"rewards\": \"{\\\"lean\\\":330,\\\"athletic\\\":440,\\\"strength\\\":550}\",\n      \"duration\": \"1620.00\",\n      \"equipments\": \"Ball, Bar, Post\",\n      \"lean\": {\n      \"1\": [],\n      \"2\": [],\n      \"3\": []\n      },\n      \"athletic\": {\n      \"1\": [],\n      \"2\": [],\n      \"3\": []\n      },\n      \"strength\": {\n      \"1\": [],\n      \"2\": [],\n      \"3\": []\n      }\n      },\n      {\n      \"id\": \"21\",\n      \"name\": \"Váli\",\n      \"description\": \"Váli Váli\",\n      \"rounds\": \"3\",\n      \"category\": \"1\",\n      \"type\": \"2\",\n      \"rewards\": \"{\\\"lean\\\":330,\\\"athletic\\\":440,\\\"strength\\\":550}\",\n      \"duration\": \"1620.00\",\n      \"equipments\": \"Bar, Post\",\n      \"lean\": {\n      \"1\": [],\n      \"2\": [],\n      \"3\": []\n      },\n      \"athletic\": {\n      \"1\": [],\n      \"2\": [],\n      \"3\": []\n      },\n      \"strength\": {\n      \"1\": [],\n      \"2\": [],\n      \"3\": []\n      }\n      },\n      {\n      \"id\": \"22\",\n      \"name\": \"Hel\",\n      \"description\": \"Hel Hel\",\n      \"rounds\": \"3\",\n      \"category\": \"2\",\n      \"type\": \"1\",\n      \"rewards\": \"{\\\"lean\\\":330,\\\"athletic\\\":440,\\\"strength\\\":550}\",\n      \"duration\": \"1080.00\",\n      \"equipments\": \"Bar\",\n      \"lean\": {\n      \"1\": [],\n      \"2\": [],\n      \"3\": []\n      },\n      \"athletic\": {\n      \"1\": [],\n      \"2\": [],\n      \"3\": []\n      },\n      \"strength\": {\n      \"1\": [],\n      \"2\": [],\n      \"3\": []\n      }\n      },\n      {\n      \"id\": \"23\",\n      \"name\": \"Yggdrasil\",\n      \"description\": \"Yggdrasil Yggdrasil\",\n      \"rounds\": \"3\",\n      \"category\": \"1\",\n      \"type\": \"2\",\n      \"rewards\": \"{\\\"lean\\\":330,\\\"athletic\\\":440,\\\"strength\\\":550}\",\n      \"duration\": \"0.00\",\n      \"equipments\": \"Bar, Post\",\n      \"lean\": {\n      \"1\": [],\n      \"2\": [],\n      \"3\": []\n      },\n      \"athletic\": {\n      \"1\": [],\n      \"2\": [],\n      \"3\": []\n      },\n      \"strength\": {\n      \"1\": [],\n      \"2\": [],\n      \"3\": []\n      }\n      },\n      {\n      \"id\": \"24\",\n      \"name\": \"Nerþus\",\n      \"description\": \"Nerþus Nerþus\",\n      \"rounds\": \"3\",\n      \"category\": \"1\",\n      \"type\": \"2\",\n      \"rewards\": \"{\\\"lean\\\":330,\\\"athletic\\\":440,\\\"strength\\\":550}\",\n      \"duration\": \"0.00\",\n      \"equipments\": \"Bar, Ball, Low Bar\",\n      \"lean\": {\n      \"1\": [],\n      \"2\": [],\n      \"3\": []\n      },\n      \"athletic\": {\n      \"1\": [],\n      \"2\": [],\n      \"3\": []\n      },\n      \"strength\": {\n      \"1\": [],\n      \"2\": [],\n      \"3\": []\n      }\n      },\n      {\n      \"id\": \"25\",\n      \"name\": \"Jörð\",\n      \"description\": \"Jörð Jörð\",\n      \"rounds\": \"4\",\n      \"category\": \"2\",\n      \"type\": \"1\",\n      \"rewards\": \"{\\\"lean\\\":330,\\\"athletic\\\":440,\\\"strength\\\":550}\",\n      \"duration\": \"1680.00\",\n      \"equipments\": \"\",\n      \"lean\": {\n      \"1\": [],\n      \"2\": [],\n      \"3\": []\n      },\n      \"athletic\": {\n      \"1\": [],\n      \"2\": [],\n      \"3\": []\n      },\n      \"strength\": {\n      \"1\": [],\n      \"2\": [],\n      \"3\": []\n      }\n      }\n      ]\n      }",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "error",
            "description": "<p>Message token_invalid.</p> "
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "user_not_exists",
            "description": "<p>User error.</p> "
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 400 Invalid Request\n{\n  \"status\":\"0\",\n  \"error\": \"token_invalid\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 401 Unauthorised\n{\n  \"status\":\"0\",\n  \"error\": \"token_expired\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 400 Bad Request\n{\n  \"status\":\"0\",\n  \"error\": \"token_not_provided\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 400 Bad Request\n{\n  \"status\":\"0\",\n  \"error\": \"user_not_exists\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 422 Validation error\n{\n  \"status\" : 0,\n  \"error\": \"The user_id field is required\"\n}",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "app/Http/Controllers/Api/UsersController.php",
    "groupTitle": "User"
  },
  {
    "type": "post",
    "url": "/user/options/removegoaloptions",
    "title": "removeUserGoalOptions",
    "name": "removeUserGoalOptions",
    "group": "User",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "<p>integer</p> ",
            "optional": false,
            "field": "user_id",
            "description": "<p>id of loggedin user *required</p> "
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "<p>String</p> ",
            "optional": false,
            "field": "success.",
            "description": ""
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n{\n      \"status\": 1,\n      \"success\": \"removed_user_goal\"\n      }",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "error",
            "description": "<p>Message token_invalid.</p> "
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "user_not_exists",
            "description": "<p>User error.</p> "
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 400 Invalid Request\n{\n  \"status\":\"0\",\n  \"error\": \"token_invalid\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 401 Unauthorised\n{\n  \"status\":\"0\",\n  \"error\": \"token_expired\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 400 Bad Request\n{\n  \"status\":\"0\",\n  \"error\": \"token_not_provided\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 500 Bad Request\n{\n  \"status\":\"0\",\n  \"error\": \"user_not_exists\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 422 Validation error\n{\n  \"status\" : 0,\n  \"error\": \"The user_id field is required\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 422 Validation error\n{\n  \"status\" : 0,\n  \"error\": \"The progression_id field is required\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 422 Validation error\n{\n  \"status\" : 0,\n  \"error\": \"The goal_options field is required\"\n}",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "app/Http/Controllers/Api/UsersController.php",
    "groupTitle": "User"
  },
  {
    "type": "post",
    "url": "/user/updatemotivation",
    "title": "updateMotivation",
    "name": "updateMotivation",
    "group": "User",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "<p>integer</p> ",
            "optional": false,
            "field": "user_id",
            "description": "<p>id of loggedin user *required</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>String</p> ",
            "optional": false,
            "field": "quote",
            "description": "<p>User motivation message *required</p> "
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "<p>String</p> ",
            "optional": false,
            "field": "success.",
            "description": ""
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "error",
            "description": "<p>Message token_invalid.</p> "
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "user_not_exists",
            "description": "<p>User error.</p> "
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 400 Invalid Request\n{\n  \"status\":\"0\",\n  \"error\": \"token_invalid\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 401 Unauthorised\n{\n  \"status\":\"0\",\n  \"error\": \"token_expired\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 400 Bad Request\n{\n  \"status\":\"0\",\n  \"error\": \"token_not_provided\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 500 Bad Request\n{\n  \"status\":\"0\",\n  \"error\": \"user_not_exists\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 422 Validation error\n{\n  \"status\" : 0,\n  \"error\": \"The user_id field is required\"\n}",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "app/Http/Controllers/Api/UsersController.php",
    "groupTitle": "User"
  },
  {
    "type": "post",
    "url": "/user/updateemail",
    "title": "updateUserEmail",
    "name": "updateUserEmail",
    "group": "User",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "<p>string</p> ",
            "optional": false,
            "field": "email",
            "description": "<p>email address of user *required</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>Number</p> ",
            "optional": false,
            "field": "user_id",
            "description": "<p>id of user user *required</p> "
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "<p>String</p> ",
            "optional": false,
            "field": "success.",
            "description": ""
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "    HTTP/1.1 200 OK\n{\n      \"status\": 1,\n      \"message\": \"Successfully updated email address.\"\n      }",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "error",
            "description": "<p>Validation error.</p> "
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 400 Validation error\n{\n  \"status\": 0,\n  \"error\": \"The email field is required.\",\n  }",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 400 Validation error\n{\n  \"status\" : 0,\n  \"error\": \"The user_id field is required.\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 Already Exists Erroe\n{\n  \"status\" : 0,\n  \"error\": \"An user already registered with this email address.\"\n}",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "app/Http/Controllers/Api/UsersController.php",
    "groupTitle": "User"
  },
  {
    "type": "post",
    "url": "/user/options/updategoaloptions",
    "title": "updateUserGoalOptions",
    "name": "updateUserGoalOptions",
    "group": "User",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "<p>integer</p> ",
            "optional": false,
            "field": "user_id",
            "description": "<p>id of loggedin user *required</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>String</p> ",
            "optional": false,
            "field": "goal_options",
            "description": "<p>value of goal selected *required</p> "
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "<p>String</p> ",
            "optional": false,
            "field": "success.",
            "description": ""
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n{\n      \"status\": 1,\n      \"success\": \"updated_user_goal\"\n      }",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "error",
            "description": "<p>Message token_invalid.</p> "
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "user_not_exists",
            "description": "<p>User error.</p> "
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 400 Invalid Request\n{\n  \"status\":\"0\",\n  \"error\": \"token_invalid\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 401 Unauthorised\n{\n  \"status\":\"0\",\n  \"error\": \"token_expired\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 400 Bad Request\n{\n  \"status\":\"0\",\n  \"error\": \"token_not_provided\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 500 Bad Request\n{\n  \"status\":\"0\",\n  \"error\": \"user_not_exists\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 422 Validation error\n{\n  \"status\" : 0,\n  \"error\": \"The user_id field is required\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 422 Validation error\n{\n  \"status\" : 0,\n  \"error\": \"The progression_id field is required\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 422 Validation error\n{\n  \"status\" : 0,\n  \"error\": \"The goal_options field is required\"\n}",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "app/Http/Controllers/Api/UsersController.php",
    "groupTitle": "User"
  },
  {
    "type": "post",
    "url": "/user/options/updatephysiqueoptions",
    "title": "updateUserPhysiqueOptions",
    "name": "updateUserPhysiqueOptions",
    "group": "User",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "<p>integer</p> ",
            "optional": false,
            "field": "user_id",
            "description": "<p>id of loggedin user *required</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>integer</p> ",
            "optional": false,
            "field": "physique_options",
            "description": "<p>comma seperated ids of each muscle groups *required</p> "
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "<p>String</p> ",
            "optional": false,
            "field": "success.",
            "description": ""
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n{\n      \"status\": 1,\n      \"success\": \"updated_user_physique_groups\",\n      \"physique_groups\": [\n      {\n      \"id\": \"1\",\n      \"name\": \"Shoulders\",\n      \"is_selected\": 1\n      },\n      {\n      \"id\": \"2\",\n      \"name\": \"Chest\",\n      \"is_selected\": 0\n      },\n      {\n      \"id\": \"3\",\n      \"name\": \"Triceps\",\n      \"is_selected\": 1\n      },\n      {\n      \"id\": \"4\",\n      \"name\": \"Lower Back\",\n      \"is_selected\": 0\n      },\n      {\n      \"id\": \"5\",\n      \"name\": \"Arms\",\n      \"is_selected\": 1\n      },\n      {\n      \"id\": \"6\",\n      \"name\": \"Core\",\n      \"is_selected\": 1\n      },\n      {\n      \"id\": \"7\",\n      \"name\": \"Legs\",\n      \"is_selected\": 1\n      },\n      {\n      \"id\": \"8\",\n      \"name\": \"Full Body\",\n      \"is_selected\": 0\n      }\n      ]\n      }",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "error",
            "description": "<p>Message token_invalid.</p> "
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "user_not_exists",
            "description": "<p>User error.</p> "
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 400 Invalid Request\n{\n  \"status\":\"0\",\n  \"error\": \"token_invalid\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 401 Unauthorised\n{\n  \"status\":\"0\",\n  \"error\": \"token_expired\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 400 Bad Request\n{\n  \"status\":\"0\",\n  \"error\": \"token_not_provided\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 500 Bad Request\n{\n  \"status\":\"0\",\n  \"error\": \"user_not_exists\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 422 Validation error\n{\n  \"status\" : 0,\n  \"error\": \"The user_id field is required\"\n}",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "app/Http/Controllers/Api/UsersController.php",
    "groupTitle": "User"
  },
  {
    "type": "post",
    "url": "/workout/getexercises",
    "title": "getWorkoutWithExercises",
    "name": "getWorkoutWithExercises",
    "group": "Workout",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "<p>Number</p> ",
            "optional": false,
            "field": "workout_id",
            "description": "<p>Id of workout *required</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>Number</p> ",
            "optional": false,
            "field": "category",
            "description": "<p>of workout 1-lean, 2-athletic, 3-strength *required</p> "
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "<p>String</p> ",
            "optional": false,
            "field": "success.",
            "description": ""
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n{\n      \"status\": 1,\n      \"workout\": {\n      \"id\": \"2\",\n      \"name\": \"Borr\",\n      \"description\": \"Borr Borr Borr\",\n      \"rounds\": \"3\",\n      \"category\": \"2\",\n      \"type\": \"1\",\n      \"rewards\": \"330\",\n      \"duration\": \"19.00\",\n      \"equipments\": \"BAR\",\n      \"exercises\": {\n      \"round1\": [\n      {\n      \"id\": \"31\",\n      \"exercise_id\": \"69\",\n      \"unit\": \"\",\n      \"video\": {\n      \"id\": \"69\",\n      \"path\": \"Now1.mp4\",\n      \"videothumbnail\": \"thumbnail3.jpg\",\n      \"description\": \"Test Description\"\n      },\n      \"exercise\": {\n      \"id\": \"69\",\n      \"name\": \"Muscleups\",\n      \"description\": \"\"\n      }\n      },\n      {\n      \"id\": \"32\",\n      \"exercise_id\": \"85\",\n      \"unit\": \"\",\n      \"video\": {\n      \"id\": \"85\",\n      \"path\": \"Now1.mp4\",\n      \"videothumbnail\": \"thumbnail1.png\",\n      \"description\": \"Test Description\"\n      },\n      \"exercise\": {\n      \"id\": \"85\",\n      \"name\": \"Atztec Pushups\",\n      \"description\": \"\"\n      }\n      },\n      {\n      \"id\": \"33\",\n      \"exercise_id\": \"70\",\n      \"unit\": \"\",\n      \"video\": {\n      \"id\": \"70\",\n      \"path\": \"Now1.mp4\",\n      \"videothumbnail\": \"thumbnail1.png\",\n      \"description\": \"Test Description\"\n      },\n      \"exercise\": {\n      \"id\": \"70\",\n      \"name\": \"Dips\",\n      \"description\": \"\"\n      }\n      },\n      {\n      \"id\": \"70\",\n      \"exercise_id\": \"72\",\n      \"unit\": \"\",\n      \"video\": {\n      \"id\": \"72\",\n      \"path\": \"Now1.mp4\",\n      \"videothumbnail\": \"thumbnail3.jpg\",\n      \"description\": \"Test Description\"\n      },\n      \"exercise\": {\n      \"id\": \"72\",\n      \"name\": \"Burpee Squat Jumps\",\n      \"description\": \"\"\n      }\n      },\n      {\n      \"id\": \"71\",\n      \"exercise_id\": \"69\",\n      \"unit\": \"\",\n      \"video\": {\n      \"id\": \"69\",\n      \"path\": \"Now1.mp4\",\n      \"videothumbnail\": \"thumbnail3.jpg\",\n      \"description\": \"Test Description\"\n      },\n      \"exercise\": {\n      \"id\": \"69\",\n      \"name\": \"Muscleups\",\n      \"description\": \"\"\n      }\n      },\n      {\n      \"id\": \"72\",\n      \"exercise_id\": \"75\",\n      \"unit\": \"\",\n      \"video\": {\n      \"id\": \"75\",\n      \"path\": \"Now1.mp4\",\n      \"videothumbnail\": \"thumbnail3.jpg\",\n      \"description\": \"Test Description\"\n      },\n      \"exercise\": {\n      \"id\": \"75\",\n      \"name\": \"Jacknives\",\n      \"description\": \"\"\n      }\n      },\n      {\n      \"id\": \"73\",\n      \"exercise_id\": \"70\",\n      \"unit\": \"\",\n      \"video\": {\n      \"id\": \"70\",\n      \"path\": \"Now1.mp4\",\n      \"videothumbnail\": \"thumbnail1.png\",\n      \"description\": \"Test Description\"\n      },\n      \"exercise\": {\n      \"id\": \"70\",\n      \"name\": \"Dips\",\n      \"description\": \"\"\n      }\n      }\n      ],\n      \"round2\": [\n      {\n      \"id\": \"34\",\n      \"exercise_id\": \"69\",\n      \"unit\": \"\",\n      \"video\": {\n      \"id\": \"69\",\n      \"path\": \"Now1.mp4\",\n      \"videothumbnail\": \"thumbnail3.jpg\",\n      \"description\": \"Test Description\"\n      },\n      \"exercise\": {\n      \"id\": \"69\",\n      \"name\": \"Muscleups\",\n      \"description\": \"\"\n      }\n      },\n      {\n      \"id\": \"35\",\n      \"exercise_id\": \"85\",\n      \"unit\": \"\",\n      \"video\": {\n      \"id\": \"85\",\n      \"path\": \"Now1.mp4\",\n      \"videothumbnail\": \"thumbnail1.png\",\n      \"description\": \"Test Description\"\n      },\n      \"exercise\": {\n      \"id\": \"85\",\n      \"name\": \"Atztec Pushups\",\n      \"description\": \"\"\n      }\n      },\n      {\n      \"id\": \"36\",\n      \"exercise_id\": \"70\",\n      \"unit\": \"\",\n      \"video\": {\n      \"id\": \"70\",\n      \"path\": \"Now1.mp4\",\n      \"videothumbnail\": \"thumbnail1.png\",\n      \"description\": \"Test Description\"\n      },\n      \"exercise\": {\n      \"id\": \"70\",\n      \"name\": \"Dips\",\n      \"description\": \"\"\n      }\n      },\n      {\n      \"id\": \"74\",\n      \"exercise_id\": \"72\",\n      \"unit\": \"\",\n      \"video\": {\n      \"id\": \"72\",\n      \"path\": \"Now1.mp4\",\n      \"videothumbnail\": \"thumbnail3.jpg\",\n      \"description\": \"Test Description\"\n      },\n      \"exercise\": {\n      \"id\": \"72\",\n      \"name\": \"Burpee Squat Jumps\",\n      \"description\": \"\"\n      }\n      },\n      {\n      \"id\": \"75\",\n      \"exercise_id\": \"69\",\n      \"unit\": \"\",\n      \"video\": {\n      \"id\": \"69\",\n      \"path\": \"Now1.mp4\",\n      \"videothumbnail\": \"thumbnail3.jpg\",\n      \"description\": \"Test Description\"\n      },\n      \"exercise\": {\n      \"id\": \"69\",\n      \"name\": \"Muscleups\",\n      \"description\": \"\"\n      }\n      },\n      {\n      \"id\": \"76\",\n      \"exercise_id\": \"75\",\n      \"unit\": \"\",\n      \"video\": {\n      \"id\": \"75\",\n      \"path\": \"Now1.mp4\",\n      \"videothumbnail\": \"thumbnail3.jpg\",\n      \"description\": \"Test Description\"\n      },\n      \"exercise\": {\n      \"id\": \"75\",\n      \"name\": \"Jacknives\",\n      \"description\": \"\"\n      }\n      },\n      {\n      \"id\": \"77\",\n      \"exercise_id\": \"70\",\n      \"unit\": \"\",\n      \"video\": {\n      \"id\": \"70\",\n      \"path\": \"Now1.mp4\",\n      \"videothumbnail\": \"thumbnail1.png\",\n      \"description\": \"Test Description\"\n      },\n      \"exercise\": {\n      \"id\": \"70\",\n      \"name\": \"Dips\",\n      \"description\": \"\"\n      }\n      }\n      ],\n      \"round3\": [\n      {\n      \"id\": \"37\",\n      \"exercise_id\": \"69\",\n      \"unit\": \"\",\n      \"video\": {\n      \"id\": \"69\",\n      \"path\": \"Now1.mp4\",\n      \"videothumbnail\": \"thumbnail3.jpg\",\n      \"description\": \"Test Description\"\n      },\n      \"exercise\": {\n      \"id\": \"69\",\n      \"name\": \"Muscleups\",\n      \"description\": \"\"\n      }\n      },\n      {\n      \"id\": \"38\",\n      \"exercise_id\": \"85\",\n      \"unit\": \"\",\n      \"video\": {\n      \"id\": \"85\",\n      \"path\": \"Now1.mp4\",\n      \"videothumbnail\": \"thumbnail1.png\",\n      \"description\": \"Test Description\"\n      },\n      \"exercise\": {\n      \"id\": \"85\",\n      \"name\": \"Atztec Pushups\",\n      \"description\": \"\"\n      }\n      },\n      {\n      \"id\": \"39\",\n      \"exercise_id\": \"70\",\n      \"unit\": \"\",\n      \"video\": {\n      \"id\": \"70\",\n      \"path\": \"Now1.mp4\",\n      \"videothumbnail\": \"thumbnail1.png\",\n      \"description\": \"Test Description\"\n      },\n      \"exercise\": {\n      \"id\": \"70\",\n      \"name\": \"Dips\",\n      \"description\": \"\"\n      }\n      },\n      {\n      \"id\": \"78\",\n      \"exercise_id\": \"72\",\n      \"unit\": \"\",\n      \"video\": {\n      \"id\": \"72\",\n      \"path\": \"Now1.mp4\",\n      \"videothumbnail\": \"thumbnail3.jpg\",\n      \"description\": \"Test Description\"\n      },\n      \"exercise\": {\n      \"id\": \"72\",\n      \"name\": \"Burpee Squat Jumps\",\n      \"description\": \"\"\n      }\n      },\n      {\n      \"id\": \"79\",\n      \"exercise_id\": \"69\",\n      \"unit\": \"\",\n      \"video\": {\n      \"id\": \"69\",\n      \"path\": \"Now1.mp4\",\n      \"videothumbnail\": \"thumbnail3.jpg\",\n      \"description\": \"Test Description\"\n      },\n      \"exercise\": {\n      \"id\": \"69\",\n      \"name\": \"Muscleups\",\n      \"description\": \"\"\n      }\n      },\n      {\n      \"id\": \"80\",\n      \"exercise_id\": \"75\",\n      \"unit\": \"\",\n      \"video\": {\n      \"id\": \"75\",\n      \"path\": \"Now1.mp4\",\n      \"videothumbnail\": \"thumbnail3.jpg\",\n      \"description\": \"Test Description\"\n      },\n      \"exercise\": {\n      \"id\": \"75\",\n      \"name\": \"Jacknives\",\n      \"description\": \"\"\n      }\n      },\n      {\n      \"id\": \"81\",\n      \"exercise_id\": \"70\",\n      \"unit\": \"\",\n      \"video\": {\n      \"id\": \"70\",\n      \"path\": \"Now1.mp4\",\n      \"videothumbnail\": \"thumbnail1.png\",\n      \"description\": \"Test Description\"\n      },\n      \"exercise\": {\n      \"id\": \"70\",\n      \"name\": \"Dips\",\n      \"description\": \"\"\n      }\n      }\n      ]\n      }\n      },\n      \"urls\": {\n      \"profileImageSmall\": \"http://sandbox.ykings.com/uploads/images/profile/small\",\n      \"profileImageMedium\": \"http://sandbox.ykings.com/uploads/images/profile/medium\",\n      \"profileImageLarge\": \"http://sandbox.ykings.com/uploads/images/profile/large\",\n      \"profileImageOriginal\": \"http://sandbox.ykings.com/uploads/images/profile/original\",\n      \"video\": \"http://sandbox.ykings.com/uploads/videos\",\n      \"videothumbnail\": \"http://sandbox.ykings.com/uploads/images/videothumbnails\",\n      \"feedImageSmall\": \"http://sandbox.ykings.com/uploads/images/feed/small\",\n      \"feedImageMedium\": \"http://sandbox.ykings.com/uploads/images/feed/medium\",\n      \"feedImageLarge\": \"http://sandbox.ykings.com/uploads/images/feed/large\",\n      \"feedImageOriginal\": \"http://sandbox.ykings.com/uploads/images/feed/original\",\n      \"coverImageSmall\": \"http://sandbox.ykings.com/uploads/images/cover_image/small\",\n      \"coverImageMedium\": \"http://sandbox.ykings.com/uploads/images/cover_image/medium\",\n      \"coverImageLarge\": \"http://sandbox.ykings.com/uploads/images/cover_image/large\",\n      \"coverImageOriginal\": \"http://sandbox.ykings.com/uploads/images/cover_image/original\"\n      }\n      }",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "error",
            "description": "<p>Message token_invalid.</p> "
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 400 Invalid Request\n{\n  \"status\":\"0\",\n  \"error\": \"token_invalid\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 401 Unauthorised\n{\n  \"status\":\"0\",\n  \"error\": \"token_expired\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 400 Bad Request\n{\n  \"status\":\"0\",\n  \"error\": \"token_not_provided\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 422 Validation error\n{\n  \"status\" : 0,\n  \"error\": \"The exercise_id field is required\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 422 Validation error\n{\n  \"status\" : 0,\n  \"error\": \"The category field is required\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 500 workout_not_exists\n{\n  \"status\" : 0,\n  \"error\": \"workout_not_exists\"\n}",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "app/Http/Controllers/Api/WorkoutsController.php",
    "groupTitle": "Workout"
  },
  {
    "type": "post",
    "url": "/workout/getlevels",
    "title": "getWorkoutWithLevels",
    "name": "getWorkoutWithLevels",
    "group": "Workout",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "<p>Number</p> ",
            "optional": false,
            "field": "workout_id",
            "description": "<p>Id of workout *required</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>Number</p> ",
            "optional": false,
            "field": "user_d",
            "description": "<p>Id of user *required</p> "
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "<p>String</p> ",
            "optional": false,
            "field": "success.",
            "description": ""
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n{\n  \"status\": 1,\n  \"is_subscribed\": 0,\n  \"workout\": {\n    \"id\": \"2\",\n    \"name\": \"Borr\",\n    \"description\": \"\",\n    \"rounds\": \"3\",\n    \"category\": \"2\",\n    \"type\": \"1\",\n    \"rewards\": {\n      \"lean\": \"330\",\n      \"athletic\": \"440\",\n      \"strength\": \"550\"\n    },\n    \"duration\": \"1140.00\",\n    \"equipments\": \"Bar\",\n    \"lean\": {\n      \"1\": {\n        \"featured\": [\n          {\n            \"id\": \"1\",\n            \"workout_id\": \"2\",\n            \"user_id\": \"3\",\n            \"status\": \"1\",\n            \"time\": \"6\",\n            \"is_starred\": \"0\",\n            \"volume\": \"1\",\n            \"focus\": \"1\",\n            \"feed_id\": \"3\",\n            \"is_coach\": \"0\",\n            \"coach_rounds\": \"0\",\n            \"created_at\": \"2016-01-22 14:28:04\",\n            \"updated_at\": \"2016-01-28 07:11:20\",\n            \"category\": \"2\",\n            \"profile\": {\n              \"id\": \"3\",\n              \"user_id\": \"3\",\n              \"first_name\": \"Arun\",\n              \"last_name\": \"MG\",\n              \"gender\": \"0\",\n              \"fitness_status\": \"3\",\n              \"goal\": \"1\",\n              \"image\": \"3_1453737842.jpg\",\n              \"cover_image\": \"3_1453914991.jpg\",\n              \"city\": \"kakkanad\",\n              \"state\": \"\",\n              \"country\": \"\",\n              \"spot\": \"\",\n              \"quote\": \"To lean\",\n              \"facebook\": \"\",\n              \"twitter\": \"\",\n              \"instagram\": \"\",\n              \"created_at\": \"2016-01-22 05:57:51\",\n              \"updated_at\": \"2016-02-04 12:34:45\",\n              \"level\": 13\n            }\n          },\n          {\n            \"id\": \"9\",\n            \"workout_id\": \"2\",\n            \"user_id\": \"15\",\n            \"status\": \"1\",\n            \"time\": \"24\",\n            \"is_starred\": \"0\",\n            \"volume\": \"1\",\n            \"focus\": \"1\",\n            \"feed_id\": \"38\",\n            \"is_coach\": \"0\",\n            \"coach_rounds\": \"0\",\n            \"created_at\": \"2016-01-27 03:53:35\",\n            \"updated_at\": \"2016-01-28 07:11:20\",\n            \"category\": \"2\",\n            \"profile\": {\n              \"id\": \"15\",\n              \"user_id\": \"15\",\n              \"first_name\": \"Aneesh \",\n              \"last_name\": \"Ileaf \",\n              \"gender\": \"0\",\n              \"fitness_status\": \"1\",\n              \"goal\": \"1\",\n              \"image\": \"15_1454308286.jpg\",\n              \"cover_image\": \"15_1454321250.jpg\",\n              \"city\": \"\",\n              \"state\": \"\",\n              \"country\": \"\",\n              \"spot\": \"\",\n              \"quote\": \"Good management is what happens when the manager is not there. :) :)\",\n              \"facebook\": \"\",\n              \"twitter\": \"\",\n              \"instagram\": \"\",\n              \"created_at\": \"2016-01-27 03:49:19\",\n              \"updated_at\": \"2016-02-01 10:07:30\",\n              \"level\": 14\n            }\n          }\n        ],\n        \"following\": [\n          {\n            \"id\": \"47\",\n            \"workout_id\": \"2\",\n            \"user_id\": \"15\",\n            \"status\": \"1\",\n            \"time\": \"1\",\n            \"is_starred\": \"0\",\n            \"volume\": \"1\",\n            \"focus\": \"1\",\n            \"feed_id\": \"330\",\n            \"is_coach\": \"0\",\n            \"coach_rounds\": \"0\",\n            \"created_at\": \"2016-02-04 04:48:38\",\n            \"updated_at\": \"2016-02-04 04:48:38\",\n            \"category\": \"1\",\n            \"profile\": {\n              \"id\": \"15\",\n              \"user_id\": \"15\",\n              \"first_name\": \"Aneesh \",\n              \"last_name\": \"Ileaf \",\n              \"gender\": \"0\",\n              \"fitness_status\": \"1\",\n              \"goal\": \"1\",\n              \"image\": \"15_1454308286.jpg\",\n              \"cover_image\": \"15_1454321250.jpg\",\n              \"city\": \"\",\n              \"state\": \"\",\n              \"country\": \"\",\n              \"spot\": \"\",\n              \"quote\": \"Good management is what happens when the manager is not there. :) :)\",\n              \"facebook\": \"\",\n              \"twitter\": \"\",\n              \"instagram\": \"\",\n              \"created_at\": \"2016-01-27 03:49:19\",\n              \"updated_at\": \"2016-02-01 10:07:30\",\n              \"level\": 14\n            }\n          },\n          {\n            \"id\": \"4\",\n            \"workout_id\": \"2\",\n            \"user_id\": \"3\",\n            \"status\": \"1\",\n            \"time\": \"4\",\n            \"is_starred\": \"0\",\n            \"volume\": \"1\",\n            \"focus\": \"1\",\n            \"feed_id\": \"7\",\n            \"is_coach\": \"0\",\n            \"coach_rounds\": \"0\",\n            \"created_at\": \"2016-01-22 14:47:39\",\n            \"updated_at\": \"2016-01-28 07:11:20\",\n            \"category\": \"2\",\n            \"profile\": {\n              \"id\": \"3\",\n              \"user_id\": \"3\",\n              \"first_name\": \"Arun\",\n              \"last_name\": \"MG\",\n              \"gender\": \"0\",\n              \"fitness_status\": \"3\",\n              \"goal\": \"1\",\n              \"image\": \"3_1453737842.jpg\",\n              \"cover_image\": \"3_1453914991.jpg\",\n              \"city\": \"kakkanad\",\n              \"state\": \"\",\n              \"country\": \"\",\n              \"spot\": \"\",\n              \"quote\": \"To lean\",\n              \"facebook\": \"\",\n              \"twitter\": \"\",\n              \"instagram\": \"\",\n              \"created_at\": \"2016-01-22 05:57:51\",\n              \"updated_at\": \"2016-02-04 12:34:45\",\n              \"level\": 13\n            }\n          },\n          {\n            \"id\": \"37\",\n            \"workout_id\": \"2\",\n            \"user_id\": \"15\",\n            \"status\": \"1\",\n            \"time\": \"5\",\n            \"is_starred\": \"0\",\n            \"volume\": \"1\",\n            \"focus\": \"1\",\n            \"feed_id\": \"222\",\n            \"is_coach\": \"0\",\n            \"coach_rounds\": \"0\",\n            \"created_at\": \"2016-01-29 13:55:06\",\n            \"updated_at\": \"2016-01-29 13:55:06\",\n            \"category\": \"1\",\n            \"profile\": {\n              \"id\": \"15\",\n              \"user_id\": \"15\",\n              \"first_name\": \"Aneesh \",\n              \"last_name\": \"Ileaf \",\n              \"gender\": \"0\",\n              \"fitness_status\": \"1\",\n              \"goal\": \"1\",\n              \"image\": \"15_1454308286.jpg\",\n              \"cover_image\": \"15_1454321250.jpg\",\n              \"city\": \"\",\n              \"state\": \"\",\n              \"country\": \"\",\n              \"spot\": \"\",\n              \"quote\": \"Good management is what happens when the manager is not there. :) :)\",\n              \"facebook\": \"\",\n              \"twitter\": \"\",\n              \"instagram\": \"\",\n              \"created_at\": \"2016-01-27 03:49:19\",\n              \"updated_at\": \"2016-02-01 10:07:30\",\n              \"level\": 14\n            }\n          },\n          {\n            \"id\": \"1\",\n            \"workout_id\": \"2\",\n            \"user_id\": \"3\",\n            \"status\": \"1\",\n            \"time\": \"6\",\n            \"is_starred\": \"0\",\n            \"volume\": \"1\",\n            \"focus\": \"1\",\n            \"feed_id\": \"3\",\n            \"is_coach\": \"0\",\n            \"coach_rounds\": \"0\",\n            \"created_at\": \"2016-01-22 14:28:04\",\n            \"updated_at\": \"2016-01-28 07:11:20\",\n            \"category\": \"2\",\n            \"profile\": {\n              \"id\": \"3\",\n              \"user_id\": \"3\",\n              \"first_name\": \"Arun\",\n              \"last_name\": \"MG\",\n              \"gender\": \"0\",\n              \"fitness_status\": \"3\",\n              \"goal\": \"1\",\n              \"image\": \"3_1453737842.jpg\",\n              \"cover_image\": \"3_1453914991.jpg\",\n              \"city\": \"kakkanad\",\n              \"state\": \"\",\n              \"country\": \"\",\n              \"spot\": \"\",\n              \"quote\": \"To lean\",\n              \"facebook\": \"\",\n              \"twitter\": \"\",\n              \"instagram\": \"\",\n              \"created_at\": \"2016-01-22 05:57:51\",\n              \"updated_at\": \"2016-02-04 12:34:45\",\n              \"level\": 13\n            }\n          },\n          {\n            \"id\": \"7\",\n            \"workout_id\": \"2\",\n            \"user_id\": \"3\",\n            \"status\": \"1\",\n            \"time\": \"9\",\n            \"is_starred\": \"0\",\n            \"volume\": \"1\",\n            \"focus\": \"1\",\n            \"feed_id\": \"10\",\n            \"is_coach\": \"0\",\n            \"coach_rounds\": \"0\",\n            \"created_at\": \"2016-01-22 15:03:16\",\n            \"updated_at\": \"2016-01-22 15:25:49\",\n            \"category\": \"2\",\n            \"profile\": {\n              \"id\": \"3\",\n              \"user_id\": \"3\",\n              \"first_name\": \"Arun\",\n              \"last_name\": \"MG\",\n              \"gender\": \"0\",\n              \"fitness_status\": \"3\",\n              \"goal\": \"1\",\n              \"image\": \"3_1453737842.jpg\",\n              \"cover_image\": \"3_1453914991.jpg\",\n              \"city\": \"kakkanad\",\n              \"state\": \"\",\n              \"country\": \"\",\n              \"spot\": \"\",\n              \"quote\": \"To lean\",\n              \"facebook\": \"\",\n              \"twitter\": \"\",\n              \"instagram\": \"\",\n              \"created_at\": \"2016-01-22 05:57:51\",\n              \"updated_at\": \"2016-02-04 12:34:45\",\n              \"level\": 13\n            }\n          },\n          {\n            \"id\": \"9\",\n            \"workout_id\": \"2\",\n            \"user_id\": \"15\",\n            \"status\": \"1\",\n            \"time\": \"24\",\n            \"is_starred\": \"0\",\n            \"volume\": \"1\",\n            \"focus\": \"1\",\n            \"feed_id\": \"38\",\n            \"is_coach\": \"0\",\n            \"coach_rounds\": \"0\",\n            \"created_at\": \"2016-01-27 03:53:35\",\n            \"updated_at\": \"2016-01-28 07:11:20\",\n            \"category\": \"2\",\n            \"profile\": {\n              \"id\": \"15\",\n              \"user_id\": \"15\",\n              \"first_name\": \"Aneesh \",\n              \"last_name\": \"Ileaf \",\n              \"gender\": \"0\",\n              \"fitness_status\": \"1\",\n              \"goal\": \"1\",\n              \"image\": \"15_1454308286.jpg\",\n              \"cover_image\": \"15_1454321250.jpg\",\n              \"city\": \"\",\n              \"state\": \"\",\n              \"country\": \"\",\n              \"spot\": \"\",\n              \"quote\": \"Good management is what happens when the manager is not there. :) :)\",\n              \"facebook\": \"\",\n              \"twitter\": \"\",\n              \"instagram\": \"\",\n              \"created_at\": \"2016-01-27 03:49:19\",\n              \"updated_at\": \"2016-02-01 10:07:30\",\n              \"level\": 14\n            }\n          }\n        ],\n        \"personal_best\": \"\"\n      },\n      \"2\": {\n        \"featured\": [],\n        \"following\": [\n          {\n            \"id\": \"47\",\n            \"workout_id\": \"2\",\n            \"user_id\": \"15\",\n            \"status\": \"1\",\n            \"time\": \"1\",\n            \"is_starred\": \"0\",\n            \"volume\": \"1\",\n            \"focus\": \"1\",\n            \"feed_id\": \"330\",\n            \"is_coach\": \"0\",\n            \"coach_rounds\": \"0\",\n            \"created_at\": \"2016-02-04 04:48:38\",\n            \"updated_at\": \"2016-02-04 04:48:38\",\n            \"category\": \"1\",\n            \"profile\": {\n              \"id\": \"15\",\n              \"user_id\": \"15\",\n              \"first_name\": \"Aneesh \",\n              \"last_name\": \"Ileaf \",\n              \"gender\": \"0\",\n              \"fitness_status\": \"1\",\n              \"goal\": \"1\",\n              \"image\": \"15_1454308286.jpg\",\n              \"cover_image\": \"15_1454321250.jpg\",\n              \"city\": \"\",\n              \"state\": \"\",\n              \"country\": \"\",\n              \"spot\": \"\",\n              \"quote\": \"Good management is what happens when the manager is not there. :) :)\",\n              \"facebook\": \"\",\n              \"twitter\": \"\",\n              \"instagram\": \"\",\n              \"created_at\": \"2016-01-27 03:49:19\",\n              \"updated_at\": \"2016-02-01 10:07:30\",\n              \"level\": 14\n            }\n          },\n          {\n            \"id\": \"4\",\n            \"workout_id\": \"2\",\n            \"user_id\": \"3\",\n            \"status\": \"1\",\n            \"time\": \"4\",\n            \"is_starred\": \"0\",\n            \"volume\": \"1\",\n            \"focus\": \"1\",\n            \"feed_id\": \"7\",\n            \"is_coach\": \"0\",\n            \"coach_rounds\": \"0\",\n            \"created_at\": \"2016-01-22 14:47:39\",\n            \"updated_at\": \"2016-01-28 07:11:20\",\n            \"category\": \"2\",\n            \"profile\": {\n              \"id\": \"3\",\n              \"user_id\": \"3\",\n              \"first_name\": \"Arun\",\n              \"last_name\": \"MG\",\n              \"gender\": \"0\",\n              \"fitness_status\": \"3\",\n              \"goal\": \"1\",\n              \"image\": \"3_1453737842.jpg\",\n              \"cover_image\": \"3_1453914991.jpg\",\n              \"city\": \"kakkanad\",\n              \"state\": \"\",\n              \"country\": \"\",\n              \"spot\": \"\",\n              \"quote\": \"To lean\",\n              \"facebook\": \"\",\n              \"twitter\": \"\",\n              \"instagram\": \"\",\n              \"created_at\": \"2016-01-22 05:57:51\",\n              \"updated_at\": \"2016-02-04 12:34:45\",\n              \"level\": 13\n            }\n          },\n          {\n            \"id\": \"37\",\n            \"workout_id\": \"2\",\n            \"user_id\": \"15\",\n            \"status\": \"1\",\n            \"time\": \"5\",\n            \"is_starred\": \"0\",\n            \"volume\": \"1\",\n            \"focus\": \"1\",\n            \"feed_id\": \"222\",\n            \"is_coach\": \"0\",\n            \"coach_rounds\": \"0\",\n            \"created_at\": \"2016-01-29 13:55:06\",\n            \"updated_at\": \"2016-01-29 13:55:06\",\n            \"category\": \"1\",\n            \"profile\": {\n              \"id\": \"15\",\n              \"user_id\": \"15\",\n              \"first_name\": \"Aneesh \",\n              \"last_name\": \"Ileaf \",\n              \"gender\": \"0\",\n              \"fitness_status\": \"1\",\n              \"goal\": \"1\",\n              \"image\": \"15_1454308286.jpg\",\n              \"cover_image\": \"15_1454321250.jpg\",\n              \"city\": \"\",\n              \"state\": \"\",\n              \"country\": \"\",\n              \"spot\": \"\",\n              \"quote\": \"Good management is what happens when the manager is not there. :) :)\",\n              \"facebook\": \"\",\n              \"twitter\": \"\",\n              \"instagram\": \"\",\n              \"created_at\": \"2016-01-27 03:49:19\",\n              \"updated_at\": \"2016-02-01 10:07:30\",\n              \"level\": 14\n            }\n          },\n          {\n            \"id\": \"1\",\n            \"workout_id\": \"2\",\n            \"user_id\": \"3\",\n            \"status\": \"1\",\n            \"time\": \"6\",\n            \"is_starred\": \"0\",\n            \"volume\": \"1\",\n            \"focus\": \"1\",\n            \"feed_id\": \"3\",\n            \"is_coach\": \"0\",\n            \"coach_rounds\": \"0\",\n            \"created_at\": \"2016-01-22 14:28:04\",\n            \"updated_at\": \"2016-01-28 07:11:20\",\n            \"category\": \"2\",\n            \"profile\": {\n              \"id\": \"3\",\n              \"user_id\": \"3\",\n              \"first_name\": \"Arun\",\n              \"last_name\": \"MG\",\n              \"gender\": \"0\",\n              \"fitness_status\": \"3\",\n              \"goal\": \"1\",\n              \"image\": \"3_1453737842.jpg\",\n              \"cover_image\": \"3_1453914991.jpg\",\n              \"city\": \"kakkanad\",\n              \"state\": \"\",\n              \"country\": \"\",\n              \"spot\": \"\",\n              \"quote\": \"To lean\",\n              \"facebook\": \"\",\n              \"twitter\": \"\",\n              \"instagram\": \"\",\n              \"created_at\": \"2016-01-22 05:57:51\",\n              \"updated_at\": \"2016-02-04 12:34:45\",\n              \"level\": 13\n            }\n          },\n          {\n            \"id\": \"7\",\n            \"workout_id\": \"2\",\n            \"user_id\": \"3\",\n            \"status\": \"1\",\n            \"time\": \"9\",\n            \"is_starred\": \"0\",\n            \"volume\": \"1\",\n            \"focus\": \"1\",\n            \"feed_id\": \"10\",\n            \"is_coach\": \"0\",\n            \"coach_rounds\": \"0\",\n            \"created_at\": \"2016-01-22 15:03:16\",\n            \"updated_at\": \"2016-01-22 15:25:49\",\n            \"category\": \"2\",\n            \"profile\": {\n              \"id\": \"3\",\n              \"user_id\": \"3\",\n              \"first_name\": \"Arun\",\n              \"last_name\": \"MG\",\n              \"gender\": \"0\",\n              \"fitness_status\": \"3\",\n              \"goal\": \"1\",\n              \"image\": \"3_1453737842.jpg\",\n              \"cover_image\": \"3_1453914991.jpg\",\n              \"city\": \"kakkanad\",\n              \"state\": \"\",\n              \"country\": \"\",\n              \"spot\": \"\",\n              \"quote\": \"To lean\",\n              \"facebook\": \"\",\n              \"twitter\": \"\",\n              \"instagram\": \"\",\n              \"created_at\": \"2016-01-22 05:57:51\",\n              \"updated_at\": \"2016-02-04 12:34:45\",\n              \"level\": 13\n            }\n          },\n          {\n            \"id\": \"9\",\n            \"workout_id\": \"2\",\n            \"user_id\": \"15\",\n            \"status\": \"1\",\n            \"time\": \"24\",\n            \"is_starred\": \"0\",\n            \"volume\": \"1\",\n            \"focus\": \"1\",\n            \"feed_id\": \"38\",\n            \"is_coach\": \"0\",\n            \"coach_rounds\": \"0\",\n            \"created_at\": \"2016-01-27 03:53:35\",\n            \"updated_at\": \"2016-01-28 07:11:20\",\n            \"category\": \"2\",\n            \"profile\": {\n              \"id\": \"15\",\n              \"user_id\": \"15\",\n              \"first_name\": \"Aneesh \",\n              \"last_name\": \"Ileaf \",\n              \"gender\": \"0\",\n              \"fitness_status\": \"1\",\n              \"goal\": \"1\",\n              \"image\": \"15_1454308286.jpg\",\n              \"cover_image\": \"15_1454321250.jpg\",\n              \"city\": \"\",\n              \"state\": \"\",\n              \"country\": \"\",\n              \"spot\": \"\",\n              \"quote\": \"Good management is what happens when the manager is not there. :) :)\",\n              \"facebook\": \"\",\n              \"twitter\": \"\",\n              \"instagram\": \"\",\n              \"created_at\": \"2016-01-27 03:49:19\",\n              \"updated_at\": \"2016-02-01 10:07:30\",\n              \"level\": 14\n            }\n          }\n        ],\n        \"personal_best\": \"\"\n      },\n      \"3\": {\n        \"featured\": [],\n        \"following\": [\n          {\n            \"id\": \"47\",\n            \"workout_id\": \"2\",\n            \"user_id\": \"15\",\n            \"status\": \"1\",\n            \"time\": \"1\",\n            \"is_starred\": \"0\",\n            \"volume\": \"1\",\n            \"focus\": \"1\",\n            \"feed_id\": \"330\",\n            \"is_coach\": \"0\",\n            \"coach_rounds\": \"0\",\n            \"created_at\": \"2016-02-04 04:48:38\",\n            \"updated_at\": \"2016-02-04 04:48:38\",\n            \"category\": \"1\",\n            \"profile\": {\n              \"id\": \"15\",\n              \"user_id\": \"15\",\n              \"first_name\": \"Aneesh \",\n              \"last_name\": \"Ileaf \",\n              \"gender\": \"0\",\n              \"fitness_status\": \"1\",\n              \"goal\": \"1\",\n              \"image\": \"15_1454308286.jpg\",\n              \"cover_image\": \"15_1454321250.jpg\",\n              \"city\": \"\",\n              \"state\": \"\",\n              \"country\": \"\",\n              \"spot\": \"\",\n              \"quote\": \"Good management is what happens when the manager is not there. :) :)\",\n              \"facebook\": \"\",\n              \"twitter\": \"\",\n              \"instagram\": \"\",\n              \"created_at\": \"2016-01-27 03:49:19\",\n              \"updated_at\": \"2016-02-01 10:07:30\",\n              \"level\": 14\n            }\n          },\n          {\n            \"id\": \"4\",\n            \"workout_id\": \"2\",\n            \"user_id\": \"3\",\n            \"status\": \"1\",\n            \"time\": \"4\",\n            \"is_starred\": \"0\",\n            \"volume\": \"1\",\n            \"focus\": \"1\",\n            \"feed_id\": \"7\",\n            \"is_coach\": \"0\",\n            \"coach_rounds\": \"0\",\n            \"created_at\": \"2016-01-22 14:47:39\",\n            \"updated_at\": \"2016-01-28 07:11:20\",\n            \"category\": \"2\",\n            \"profile\": {\n              \"id\": \"3\",\n              \"user_id\": \"3\",\n              \"first_name\": \"Arun\",\n              \"last_name\": \"MG\",\n              \"gender\": \"0\",\n              \"fitness_status\": \"3\",\n              \"goal\": \"1\",\n              \"image\": \"3_1453737842.jpg\",\n              \"cover_image\": \"3_1453914991.jpg\",\n              \"city\": \"kakkanad\",\n              \"state\": \"\",\n              \"country\": \"\",\n              \"spot\": \"\",\n              \"quote\": \"To lean\",\n              \"facebook\": \"\",\n              \"twitter\": \"\",\n              \"instagram\": \"\",\n              \"created_at\": \"2016-01-22 05:57:51\",\n              \"updated_at\": \"2016-02-04 12:34:45\",\n              \"level\": 13\n            }\n          },\n          {\n            \"id\": \"37\",\n            \"workout_id\": \"2\",\n            \"user_id\": \"15\",\n            \"status\": \"1\",\n            \"time\": \"5\",\n            \"is_starred\": \"0\",\n            \"volume\": \"1\",\n            \"focus\": \"1\",\n            \"feed_id\": \"222\",\n            \"is_coach\": \"0\",\n            \"coach_rounds\": \"0\",\n            \"created_at\": \"2016-01-29 13:55:06\",\n            \"updated_at\": \"2016-01-29 13:55:06\",\n            \"category\": \"1\",\n            \"profile\": {\n              \"id\": \"15\",\n              \"user_id\": \"15\",\n              \"first_name\": \"Aneesh \",\n              \"last_name\": \"Ileaf \",\n              \"gender\": \"0\",\n              \"fitness_status\": \"1\",\n              \"goal\": \"1\",\n              \"image\": \"15_1454308286.jpg\",\n              \"cover_image\": \"15_1454321250.jpg\",\n              \"city\": \"\",\n              \"state\": \"\",\n              \"country\": \"\",\n              \"spot\": \"\",\n              \"quote\": \"Good management is what happens when the manager is not there. :) :)\",\n              \"facebook\": \"\",\n              \"twitter\": \"\",\n              \"instagram\": \"\",\n              \"created_at\": \"2016-01-27 03:49:19\",\n              \"updated_at\": \"2016-02-01 10:07:30\",\n              \"level\": 14\n            }\n          },\n          {\n            \"id\": \"1\",\n            \"workout_id\": \"2\",\n            \"user_id\": \"3\",\n            \"status\": \"1\",\n            \"time\": \"6\",\n            \"is_starred\": \"0\",\n            \"volume\": \"1\",\n            \"focus\": \"1\",\n            \"feed_id\": \"3\",\n            \"is_coach\": \"0\",\n            \"coach_rounds\": \"0\",\n            \"created_at\": \"2016-01-22 14:28:04\",\n            \"updated_at\": \"2016-01-28 07:11:20\",\n            \"category\": \"2\",\n            \"profile\": {\n              \"id\": \"3\",\n              \"user_id\": \"3\",\n              \"first_name\": \"Arun\",\n              \"last_name\": \"MG\",\n              \"gender\": \"0\",\n              \"fitness_status\": \"3\",\n              \"goal\": \"1\",\n              \"image\": \"3_1453737842.jpg\",\n              \"cover_image\": \"3_1453914991.jpg\",\n              \"city\": \"kakkanad\",\n              \"state\": \"\",\n              \"country\": \"\",\n              \"spot\": \"\",\n              \"quote\": \"To lean\",\n              \"facebook\": \"\",\n              \"twitter\": \"\",\n              \"instagram\": \"\",\n              \"created_at\": \"2016-01-22 05:57:51\",\n              \"updated_at\": \"2016-02-04 12:34:45\",\n              \"level\": 13\n            }\n          },\n          {\n            \"id\": \"7\",\n            \"workout_id\": \"2\",\n            \"user_id\": \"3\",\n            \"status\": \"1\",\n            \"time\": \"9\",\n            \"is_starred\": \"0\",\n            \"volume\": \"1\",\n            \"focus\": \"1\",\n            \"feed_id\": \"10\",\n            \"is_coach\": \"0\",\n            \"coach_rounds\": \"0\",\n            \"created_at\": \"2016-01-22 15:03:16\",\n            \"updated_at\": \"2016-01-22 15:25:49\",\n            \"category\": \"2\",\n            \"profile\": {\n              \"id\": \"3\",\n              \"user_id\": \"3\",\n              \"first_name\": \"Arun\",\n              \"last_name\": \"MG\",\n              \"gender\": \"0\",\n              \"fitness_status\": \"3\",\n              \"goal\": \"1\",\n              \"image\": \"3_1453737842.jpg\",\n              \"cover_image\": \"3_1453914991.jpg\",\n              \"city\": \"kakkanad\",\n              \"state\": \"\",\n              \"country\": \"\",\n              \"spot\": \"\",\n              \"quote\": \"To lean\",\n              \"facebook\": \"\",\n              \"twitter\": \"\",\n              \"instagram\": \"\",\n              \"created_at\": \"2016-01-22 05:57:51\",\n              \"updated_at\": \"2016-02-04 12:34:45\",\n              \"level\": 13\n            }\n          },\n          {\n            \"id\": \"9\",\n            \"workout_id\": \"2\",\n            \"user_id\": \"15\",\n            \"status\": \"1\",\n            \"time\": \"24\",\n            \"is_starred\": \"0\",\n            \"volume\": \"1\",\n            \"focus\": \"1\",\n            \"feed_id\": \"38\",\n            \"is_coach\": \"0\",\n            \"coach_rounds\": \"0\",\n            \"created_at\": \"2016-01-27 03:53:35\",\n            \"updated_at\": \"2016-01-28 07:11:20\",\n            \"category\": \"2\",\n            \"profile\": {\n              \"id\": \"15\",\n              \"user_id\": \"15\",\n              \"first_name\": \"Aneesh \",\n              \"last_name\": \"Ileaf \",\n              \"gender\": \"0\",\n              \"fitness_status\": \"1\",\n              \"goal\": \"1\",\n              \"image\": \"15_1454308286.jpg\",\n              \"cover_image\": \"15_1454321250.jpg\",\n              \"city\": \"\",\n              \"state\": \"\",\n              \"country\": \"\",\n              \"spot\": \"\",\n              \"quote\": \"Good management is what happens when the manager is not there. :) :)\",\n              \"facebook\": \"\",\n              \"twitter\": \"\",\n              \"instagram\": \"\",\n              \"created_at\": \"2016-01-27 03:49:19\",\n              \"updated_at\": \"2016-02-01 10:07:30\",\n              \"level\": 14\n            }\n          }\n        ],\n        \"personal_best\": \"\"\n      }\n    },\n    \"athletic\": {\n      \"1\": {\n        \"featured\": [\n          {\n            \"id\": \"30\",\n            \"workout_id\": \"2\",\n            \"user_id\": \"15\",\n            \"status\": \"1\",\n            \"time\": \"53\",\n            \"is_starred\": \"0\",\n            \"volume\": \"1\",\n            \"focus\": \"2\",\n            \"feed_id\": \"174\",\n            \"is_coach\": \"0\",\n            \"coach_rounds\": \"0\",\n            \"created_at\": \"2016-01-28 14:53:23\",\n            \"updated_at\": \"2016-01-28 14:53:23\",\n            \"category\": \"2\",\n            \"profile\": {\n              \"id\": \"15\",\n              \"user_id\": \"15\",\n              \"first_name\": \"Aneesh \",\n              \"last_name\": \"Ileaf \",\n              \"gender\": \"0\",\n              \"fitness_status\": \"1\",\n              \"goal\": \"1\",\n              \"image\": \"15_1454308286.jpg\",\n              \"cover_image\": \"15_1454321250.jpg\",\n              \"city\": \"\",\n              \"state\": \"\",\n              \"country\": \"\",\n              \"spot\": \"\",\n              \"quote\": \"Good management is what happens when the manager is not there. :) :)\",\n              \"facebook\": \"\",\n              \"twitter\": \"\",\n              \"instagram\": \"\",\n              \"created_at\": \"2016-01-27 03:49:19\",\n              \"updated_at\": \"2016-02-01 10:07:30\",\n              \"level\": 14\n            }\n          }\n        ],\n        \"following\": [\n          {\n            \"id\": \"33\",\n            \"workout_id\": \"2\",\n            \"user_id\": \"15\",\n            \"status\": \"1\",\n            \"time\": \"2\",\n            \"is_starred\": \"0\",\n            \"volume\": \"1\",\n            \"focus\": \"2\",\n            \"feed_id\": \"182\",\n            \"is_coach\": \"0\",\n            \"coach_rounds\": \"0\",\n            \"created_at\": \"2016-01-28 15:22:42\",\n            \"updated_at\": \"2016-01-28 15:22:42\",\n            \"category\": \"2\",\n            \"profile\": {\n              \"id\": \"15\",\n              \"user_id\": \"15\",\n              \"first_name\": \"Aneesh \",\n              \"last_name\": \"Ileaf \",\n              \"gender\": \"0\",\n              \"fitness_status\": \"1\",\n              \"goal\": \"1\",\n              \"image\": \"15_1454308286.jpg\",\n              \"cover_image\": \"15_1454321250.jpg\",\n              \"city\": \"\",\n              \"state\": \"\",\n              \"country\": \"\",\n              \"spot\": \"\",\n              \"quote\": \"Good management is what happens when the manager is not there. :) :)\",\n              \"facebook\": \"\",\n              \"twitter\": \"\",\n              \"instagram\": \"\",\n              \"created_at\": \"2016-01-27 03:49:19\",\n              \"updated_at\": \"2016-02-01 10:07:30\",\n              \"level\": 14\n            }\n          },\n          {\n            \"id\": \"31\",\n            \"workout_id\": \"2\",\n            \"user_id\": \"15\",\n            \"status\": \"1\",\n            \"time\": \"8\",\n            \"is_starred\": \"0\",\n            \"volume\": \"1\",\n            \"focus\": \"2\",\n            \"feed_id\": \"175\",\n            \"is_coach\": \"0\",\n            \"coach_rounds\": \"0\",\n            \"created_at\": \"2016-01-28 15:00:31\",\n            \"updated_at\": \"2016-01-28 15:00:31\",\n            \"category\": \"2\",\n            \"profile\": {\n              \"id\": \"15\",\n              \"user_id\": \"15\",\n              \"first_name\": \"Aneesh \",\n              \"last_name\": \"Ileaf \",\n              \"gender\": \"0\",\n              \"fitness_status\": \"1\",\n              \"goal\": \"1\",\n              \"image\": \"15_1454308286.jpg\",\n              \"cover_image\": \"15_1454321250.jpg\",\n              \"city\": \"\",\n              \"state\": \"\",\n              \"country\": \"\",\n              \"spot\": \"\",\n              \"quote\": \"Good management is what happens when the manager is not there. :) :)\",\n              \"facebook\": \"\",\n              \"twitter\": \"\",\n              \"instagram\": \"\",\n              \"created_at\": \"2016-01-27 03:49:19\",\n              \"updated_at\": \"2016-02-01 10:07:30\",\n              \"level\": 14\n            }\n          },\n          {\n            \"id\": \"32\",\n            \"workout_id\": \"2\",\n            \"user_id\": \"15\",\n            \"status\": \"1\",\n            \"time\": \"21\",\n            \"is_starred\": \"0\",\n            \"volume\": \"1\",\n            \"focus\": \"2\",\n            \"feed_id\": \"181\",\n            \"is_coach\": \"0\",\n            \"coach_rounds\": \"0\",\n            \"created_at\": \"2016-01-28 15:18:05\",\n            \"updated_at\": \"2016-01-28 15:18:05\",\n            \"category\": \"2\",\n            \"profile\": {\n              \"id\": \"15\",\n              \"user_id\": \"15\",\n              \"first_name\": \"Aneesh \",\n              \"last_name\": \"Ileaf \",\n              \"gender\": \"0\",\n              \"fitness_status\": \"1\",\n              \"goal\": \"1\",\n              \"image\": \"15_1454308286.jpg\",\n              \"cover_image\": \"15_1454321250.jpg\",\n              \"city\": \"\",\n              \"state\": \"\",\n              \"country\": \"\",\n              \"spot\": \"\",\n              \"quote\": \"Good management is what happens when the manager is not there. :) :)\",\n              \"facebook\": \"\",\n              \"twitter\": \"\",\n              \"instagram\": \"\",\n              \"created_at\": \"2016-01-27 03:49:19\",\n              \"updated_at\": \"2016-02-01 10:07:30\",\n              \"level\": 14\n            }\n          },\n          {\n            \"id\": \"30\",\n            \"workout_id\": \"2\",\n            \"user_id\": \"15\",\n            \"status\": \"1\",\n            \"time\": \"53\",\n            \"is_starred\": \"0\",\n            \"volume\": \"1\",\n            \"focus\": \"2\",\n            \"feed_id\": \"174\",\n            \"is_coach\": \"0\",\n            \"coach_rounds\": \"0\",\n            \"created_at\": \"2016-01-28 14:53:23\",\n            \"updated_at\": \"2016-01-28 14:53:23\",\n            \"category\": \"2\",\n            \"profile\": {\n              \"id\": \"15\",\n              \"user_id\": \"15\",\n              \"first_name\": \"Aneesh \",\n              \"last_name\": \"Ileaf \",\n              \"gender\": \"0\",\n              \"fitness_status\": \"1\",\n              \"goal\": \"1\",\n              \"image\": \"15_1454308286.jpg\",\n              \"cover_image\": \"15_1454321250.jpg\",\n              \"city\": \"\",\n              \"state\": \"\",\n              \"country\": \"\",\n              \"spot\": \"\",\n              \"quote\": \"Good management is what happens when the manager is not there. :) :)\",\n              \"facebook\": \"\",\n              \"twitter\": \"\",\n              \"instagram\": \"\",\n              \"created_at\": \"2016-01-27 03:49:19\",\n              \"updated_at\": \"2016-02-01 10:07:30\",\n              \"level\": 14\n            }\n          }\n        ],\n        \"personal_best\": \"2\"\n      },\n      \"2\": {\n        \"featured\": [],\n        \"following\": [],\n        \"personal_best\": \"2\"\n      },\n      \"3\": {\n        \"featured\": [\n          {\n            \"id\": \"14\",\n            \"workout_id\": \"2\",\n            \"user_id\": \"20\",\n            \"status\": \"1\",\n            \"time\": \"14\",\n            \"is_starred\": \"0\",\n            \"volume\": \"3\",\n            \"focus\": \"2\",\n            \"feed_id\": \"67\",\n            \"is_coach\": \"0\",\n            \"coach_rounds\": \"0\",\n            \"created_at\": \"2016-01-27 14:59:50\",\n            \"updated_at\": \"2016-01-28 07:11:56\",\n            \"category\": \"2\",\n            \"profile\": {\n              \"id\": \"20\",\n              \"user_id\": \"20\",\n              \"first_name\": \"sreejith\",\n              \"last_name\": \"iLeaf\",\n              \"gender\": \"0\",\n              \"fitness_status\": \"2\",\n              \"goal\": \"2\",\n              \"image\": \"20_1453916030.jpg\",\n              \"cover_image\": \"20_1453916040.jpg\",\n              \"city\": \"1\",\n              \"state\": \"\",\n              \"country\": \"\",\n              \"spot\": \"2\",\n              \"quote\": \"33\",\n              \"facebook\": \"hi\",\n              \"twitter\": \"fine\",\n              \"instagram\": \"u\",\n              \"created_at\": \"2016-01-27 09:45:07\",\n              \"updated_at\": \"2016-01-27 17:43:58\",\n              \"level\": 13\n            }\n          }\n        ],\n        \"following\": [\n          {\n            \"id\": \"18\",\n            \"workout_id\": \"2\",\n            \"user_id\": \"20\",\n            \"status\": \"1\",\n            \"time\": \"2\",\n            \"is_starred\": \"0\",\n            \"volume\": \"3\",\n            \"focus\": \"2\",\n            \"feed_id\": \"90\",\n            \"is_coach\": \"0\",\n            \"coach_rounds\": \"0\",\n            \"created_at\": \"2016-01-27 17:12:57\",\n            \"updated_at\": \"2016-01-28 07:11:56\",\n            \"category\": \"2\",\n            \"profile\": {\n              \"id\": \"20\",\n              \"user_id\": \"20\",\n              \"first_name\": \"sreejith\",\n              \"last_name\": \"iLeaf\",\n              \"gender\": \"0\",\n              \"fitness_status\": \"2\",\n              \"goal\": \"2\",\n              \"image\": \"20_1453916030.jpg\",\n              \"cover_image\": \"20_1453916040.jpg\",\n              \"city\": \"1\",\n              \"state\": \"\",\n              \"country\": \"\",\n              \"spot\": \"2\",\n              \"quote\": \"33\",\n              \"facebook\": \"hi\",\n              \"twitter\": \"fine\",\n              \"instagram\": \"u\",\n              \"created_at\": \"2016-01-27 09:45:07\",\n              \"updated_at\": \"2016-01-27 17:43:58\",\n              \"level\": 13\n            }\n          },\n          {\n            \"id\": \"19\",\n            \"workout_id\": \"2\",\n            \"user_id\": \"20\",\n            \"status\": \"1\",\n            \"time\": \"2\",\n            \"is_starred\": \"0\",\n            \"volume\": \"3\",\n            \"focus\": \"2\",\n            \"feed_id\": \"91\",\n            \"is_coach\": \"0\",\n            \"coach_rounds\": \"0\",\n            \"created_at\": \"2016-01-27 17:13:06\",\n            \"updated_at\": \"2016-01-28 07:11:56\",\n            \"category\": \"2\",\n            \"profile\": {\n              \"id\": \"20\",\n              \"user_id\": \"20\",\n              \"first_name\": \"sreejith\",\n              \"last_name\": \"iLeaf\",\n              \"gender\": \"0\",\n              \"fitness_status\": \"2\",\n              \"goal\": \"2\",\n              \"image\": \"20_1453916030.jpg\",\n              \"cover_image\": \"20_1453916040.jpg\",\n              \"city\": \"1\",\n              \"state\": \"\",\n              \"country\": \"\",\n              \"spot\": \"2\",\n              \"quote\": \"33\",\n              \"facebook\": \"hi\",\n              \"twitter\": \"fine\",\n              \"instagram\": \"u\",\n              \"created_at\": \"2016-01-27 09:45:07\",\n              \"updated_at\": \"2016-01-27 17:43:58\",\n              \"level\": 13\n            }\n          },\n          {\n            \"id\": \"27\",\n            \"workout_id\": \"2\",\n            \"user_id\": \"20\",\n            \"status\": \"1\",\n            \"time\": \"10\",\n            \"is_starred\": \"0\",\n            \"volume\": \"3\",\n            \"focus\": \"2\",\n            \"feed_id\": \"132\",\n            \"is_coach\": \"0\",\n            \"coach_rounds\": \"0\",\n            \"created_at\": \"2016-01-28 07:20:48\",\n            \"updated_at\": \"2016-01-28 07:20:48\",\n            \"category\": \"2\",\n            \"profile\": {\n              \"id\": \"20\",\n              \"user_id\": \"20\",\n              \"first_name\": \"sreejith\",\n              \"last_name\": \"iLeaf\",\n              \"gender\": \"0\",\n              \"fitness_status\": \"2\",\n              \"goal\": \"2\",\n              \"image\": \"20_1453916030.jpg\",\n              \"cover_image\": \"20_1453916040.jpg\",\n              \"city\": \"1\",\n              \"state\": \"\",\n              \"country\": \"\",\n              \"spot\": \"2\",\n              \"quote\": \"33\",\n              \"facebook\": \"hi\",\n              \"twitter\": \"fine\",\n              \"instagram\": \"u\",\n              \"created_at\": \"2016-01-27 09:45:07\",\n              \"updated_at\": \"2016-01-27 17:43:58\",\n              \"level\": 13\n            }\n          },\n          {\n            \"id\": \"14\",\n            \"workout_id\": \"2\",\n            \"user_id\": \"20\",\n            \"status\": \"1\",\n            \"time\": \"14\",\n            \"is_starred\": \"0\",\n            \"volume\": \"3\",\n            \"focus\": \"2\",\n            \"feed_id\": \"67\",\n            \"is_coach\": \"0\",\n            \"coach_rounds\": \"0\",\n            \"created_at\": \"2016-01-27 14:59:50\",\n            \"updated_at\": \"2016-01-28 07:11:56\",\n            \"category\": \"2\",\n            \"profile\": {\n              \"id\": \"20\",\n              \"user_id\": \"20\",\n              \"first_name\": \"sreejith\",\n              \"last_name\": \"iLeaf\",\n              \"gender\": \"0\",\n              \"fitness_status\": \"2\",\n              \"goal\": \"2\",\n              \"image\": \"20_1453916030.jpg\",\n              \"cover_image\": \"20_1453916040.jpg\",\n              \"city\": \"1\",\n              \"state\": \"\",\n              \"country\": \"\",\n              \"spot\": \"2\",\n              \"quote\": \"33\",\n              \"facebook\": \"hi\",\n              \"twitter\": \"fine\",\n              \"instagram\": \"u\",\n              \"created_at\": \"2016-01-27 09:45:07\",\n              \"updated_at\": \"2016-01-27 17:43:58\",\n              \"level\": 13\n            }\n          },\n          {\n            \"id\": \"15\",\n            \"workout_id\": \"2\",\n            \"user_id\": \"20\",\n            \"status\": \"1\",\n            \"time\": \"14\",\n            \"is_starred\": \"0\",\n            \"volume\": \"3\",\n            \"focus\": \"2\",\n            \"feed_id\": \"68\",\n            \"is_coach\": \"0\",\n            \"coach_rounds\": \"0\",\n            \"created_at\": \"2016-01-27 14:59:56\",\n            \"updated_at\": \"2016-01-28 07:11:56\",\n            \"category\": \"2\",\n            \"profile\": {\n              \"id\": \"20\",\n              \"user_id\": \"20\",\n              \"first_name\": \"sreejith\",\n              \"last_name\": \"iLeaf\",\n              \"gender\": \"0\",\n              \"fitness_status\": \"2\",\n              \"goal\": \"2\",\n              \"image\": \"20_1453916030.jpg\",\n              \"cover_image\": \"20_1453916040.jpg\",\n              \"city\": \"1\",\n              \"state\": \"\",\n              \"country\": \"\",\n              \"spot\": \"2\",\n              \"quote\": \"33\",\n              \"facebook\": \"hi\",\n              \"twitter\": \"fine\",\n              \"instagram\": \"u\",\n              \"created_at\": \"2016-01-27 09:45:07\",\n              \"updated_at\": \"2016-01-27 17:43:58\",\n              \"level\": 13\n            }\n          },\n          {\n            \"id\": \"16\",\n            \"workout_id\": \"2\",\n            \"user_id\": \"20\",\n            \"status\": \"1\",\n            \"time\": \"14\",\n            \"is_starred\": \"0\",\n            \"volume\": \"3\",\n            \"focus\": \"2\",\n            \"feed_id\": \"69\",\n            \"is_coach\": \"0\",\n            \"coach_rounds\": \"0\",\n            \"created_at\": \"2016-01-27 15:00:13\",\n            \"updated_at\": \"2016-01-28 07:11:56\",\n            \"category\": \"2\",\n            \"profile\": {\n              \"id\": \"20\",\n              \"user_id\": \"20\",\n              \"first_name\": \"sreejith\",\n              \"last_name\": \"iLeaf\",\n              \"gender\": \"0\",\n              \"fitness_status\": \"2\",\n              \"goal\": \"2\",\n              \"image\": \"20_1453916030.jpg\",\n              \"cover_image\": \"20_1453916040.jpg\",\n              \"city\": \"1\",\n              \"state\": \"\",\n              \"country\": \"\",\n              \"spot\": \"2\",\n              \"quote\": \"33\",\n              \"facebook\": \"hi\",\n              \"twitter\": \"fine\",\n              \"instagram\": \"u\",\n              \"created_at\": \"2016-01-27 09:45:07\",\n              \"updated_at\": \"2016-01-27 17:43:58\",\n              \"level\": 13\n            }\n          },\n          {\n            \"id\": \"17\",\n            \"workout_id\": \"2\",\n            \"user_id\": \"20\",\n            \"status\": \"1\",\n            \"time\": \"14\",\n            \"is_starred\": \"0\",\n            \"volume\": \"3\",\n            \"focus\": \"2\",\n            \"feed_id\": \"70\",\n            \"is_coach\": \"0\",\n            \"coach_rounds\": \"0\",\n            \"created_at\": \"2016-01-27 15:00:20\",\n            \"updated_at\": \"2016-01-28 07:11:56\",\n            \"category\": \"2\",\n            \"profile\": {\n              \"id\": \"20\",\n              \"user_id\": \"20\",\n              \"first_name\": \"sreejith\",\n              \"last_name\": \"iLeaf\",\n              \"gender\": \"0\",\n              \"fitness_status\": \"2\",\n              \"goal\": \"2\",\n              \"image\": \"20_1453916030.jpg\",\n              \"cover_image\": \"20_1453916040.jpg\",\n              \"city\": \"1\",\n              \"state\": \"\",\n              \"country\": \"\",\n              \"spot\": \"2\",\n              \"quote\": \"33\",\n              \"facebook\": \"hi\",\n              \"twitter\": \"fine\",\n              \"instagram\": \"u\",\n              \"created_at\": \"2016-01-27 09:45:07\",\n              \"updated_at\": \"2016-01-27 17:43:58\",\n              \"level\": 13\n            }\n          }\n        ],\n        \"personal_best\": \"2\"\n      }\n    },\n    \"strength\": {\n      \"1\": {\n        \"featured\": [\n          {\n            \"id\": \"22\",\n            \"workout_id\": \"2\",\n            \"user_id\": \"20\",\n            \"status\": \"1\",\n            \"time\": \"16\",\n            \"is_starred\": \"0\",\n            \"volume\": \"1\",\n            \"focus\": \"3\",\n            \"feed_id\": \"127\",\n            \"is_coach\": \"0\",\n            \"coach_rounds\": \"0\",\n            \"created_at\": \"2016-01-28 06:22:02\",\n            \"updated_at\": \"2016-01-28 07:12:17\",\n            \"category\": \"2\",\n            \"profile\": {\n              \"id\": \"20\",\n              \"user_id\": \"20\",\n              \"first_name\": \"sreejith\",\n              \"last_name\": \"iLeaf\",\n              \"gender\": \"0\",\n              \"fitness_status\": \"2\",\n              \"goal\": \"2\",\n              \"image\": \"20_1453916030.jpg\",\n              \"cover_image\": \"20_1453916040.jpg\",\n              \"city\": \"1\",\n              \"state\": \"\",\n              \"country\": \"\",\n              \"spot\": \"2\",\n              \"quote\": \"33\",\n              \"facebook\": \"hi\",\n              \"twitter\": \"fine\",\n              \"instagram\": \"u\",\n              \"created_at\": \"2016-01-27 09:45:07\",\n              \"updated_at\": \"2016-01-27 17:43:58\",\n              \"level\": 13\n            }\n          }\n        ],\n        \"following\": [\n          {\n            \"id\": \"26\",\n            \"workout_id\": \"2\",\n            \"user_id\": \"20\",\n            \"status\": \"1\",\n            \"time\": \"3\",\n            \"is_starred\": \"0\",\n            \"volume\": \"1\",\n            \"focus\": \"3\",\n            \"feed_id\": \"131\",\n            \"is_coach\": \"0\",\n            \"coach_rounds\": \"0\",\n            \"created_at\": \"2016-01-28 07:04:38\",\n            \"updated_at\": \"2016-01-28 07:12:17\",\n            \"category\": \"2\",\n            \"profile\": {\n              \"id\": \"20\",\n              \"user_id\": \"20\",\n              \"first_name\": \"sreejith\",\n              \"last_name\": \"iLeaf\",\n              \"gender\": \"0\",\n              \"fitness_status\": \"2\",\n              \"goal\": \"2\",\n              \"image\": \"20_1453916030.jpg\",\n              \"cover_image\": \"20_1453916040.jpg\",\n              \"city\": \"1\",\n              \"state\": \"\",\n              \"country\": \"\",\n              \"spot\": \"2\",\n              \"quote\": \"33\",\n              \"facebook\": \"hi\",\n              \"twitter\": \"fine\",\n              \"instagram\": \"u\",\n              \"created_at\": \"2016-01-27 09:45:07\",\n              \"updated_at\": \"2016-01-27 17:43:58\",\n              \"level\": 13\n            }\n          },\n          {\n            \"id\": \"25\",\n            \"workout_id\": \"2\",\n            \"user_id\": \"20\",\n            \"status\": \"1\",\n            \"time\": \"6\",\n            \"is_starred\": \"0\",\n            \"volume\": \"1\",\n            \"focus\": \"3\",\n            \"feed_id\": \"130\",\n            \"is_coach\": \"0\",\n            \"coach_rounds\": \"0\",\n            \"created_at\": \"2016-01-28 06:51:02\",\n            \"updated_at\": \"2016-01-28 07:12:17\",\n            \"category\": \"2\",\n            \"profile\": {\n              \"id\": \"20\",\n              \"user_id\": \"20\",\n              \"first_name\": \"sreejith\",\n              \"last_name\": \"iLeaf\",\n              \"gender\": \"0\",\n              \"fitness_status\": \"2\",\n              \"goal\": \"2\",\n              \"image\": \"20_1453916030.jpg\",\n              \"cover_image\": \"20_1453916040.jpg\",\n              \"city\": \"1\",\n              \"state\": \"\",\n              \"country\": \"\",\n              \"spot\": \"2\",\n              \"quote\": \"33\",\n              \"facebook\": \"hi\",\n              \"twitter\": \"fine\",\n              \"instagram\": \"u\",\n              \"created_at\": \"2016-01-27 09:45:07\",\n              \"updated_at\": \"2016-01-27 17:43:58\",\n              \"level\": 13\n            }\n          },\n          {\n            \"id\": \"22\",\n            \"workout_id\": \"2\",\n            \"user_id\": \"20\",\n            \"status\": \"1\",\n            \"time\": \"16\",\n            \"is_starred\": \"0\",\n            \"volume\": \"1\",\n            \"focus\": \"3\",\n            \"feed_id\": \"127\",\n            \"is_coach\": \"0\",\n            \"coach_rounds\": \"0\",\n            \"created_at\": \"2016-01-28 06:22:02\",\n            \"updated_at\": \"2016-01-28 07:12:17\",\n            \"category\": \"2\",\n            \"profile\": {\n              \"id\": \"20\",\n              \"user_id\": \"20\",\n              \"first_name\": \"sreejith\",\n              \"last_name\": \"iLeaf\",\n              \"gender\": \"0\",\n              \"fitness_status\": \"2\",\n              \"goal\": \"2\",\n              \"image\": \"20_1453916030.jpg\",\n              \"cover_image\": \"20_1453916040.jpg\",\n              \"city\": \"1\",\n              \"state\": \"\",\n              \"country\": \"\",\n              \"spot\": \"2\",\n              \"quote\": \"33\",\n              \"facebook\": \"hi\",\n              \"twitter\": \"fine\",\n              \"instagram\": \"u\",\n              \"created_at\": \"2016-01-27 09:45:07\",\n              \"updated_at\": \"2016-01-27 17:43:58\",\n              \"level\": 13\n            }\n          },\n          {\n            \"id\": \"23\",\n            \"workout_id\": \"2\",\n            \"user_id\": \"20\",\n            \"status\": \"1\",\n            \"time\": \"16\",\n            \"is_starred\": \"0\",\n            \"volume\": \"1\",\n            \"focus\": \"3\",\n            \"feed_id\": \"128\",\n            \"is_coach\": \"0\",\n            \"coach_rounds\": \"0\",\n            \"created_at\": \"2016-01-28 06:22:13\",\n            \"updated_at\": \"2016-01-28 07:12:17\",\n            \"category\": \"2\",\n            \"profile\": {\n              \"id\": \"20\",\n              \"user_id\": \"20\",\n              \"first_name\": \"sreejith\",\n              \"last_name\": \"iLeaf\",\n              \"gender\": \"0\",\n              \"fitness_status\": \"2\",\n              \"goal\": \"2\",\n              \"image\": \"20_1453916030.jpg\",\n              \"cover_image\": \"20_1453916040.jpg\",\n              \"city\": \"1\",\n              \"state\": \"\",\n              \"country\": \"\",\n              \"spot\": \"2\",\n              \"quote\": \"33\",\n              \"facebook\": \"hi\",\n              \"twitter\": \"fine\",\n              \"instagram\": \"u\",\n              \"created_at\": \"2016-01-27 09:45:07\",\n              \"updated_at\": \"2016-01-27 17:43:58\",\n              \"level\": 13\n            }\n          },\n          {\n            \"id\": \"24\",\n            \"workout_id\": \"2\",\n            \"user_id\": \"20\",\n            \"status\": \"1\",\n            \"time\": \"16\",\n            \"is_starred\": \"0\",\n            \"volume\": \"1\",\n            \"focus\": \"3\",\n            \"feed_id\": \"129\",\n            \"is_coach\": \"0\",\n            \"coach_rounds\": \"0\",\n            \"created_at\": \"2016-01-28 06:25:39\",\n            \"updated_at\": \"2016-01-28 07:12:17\",\n            \"category\": \"2\",\n            \"profile\": {\n              \"id\": \"20\",\n              \"user_id\": \"20\",\n              \"first_name\": \"sreejith\",\n              \"last_name\": \"iLeaf\",\n              \"gender\": \"0\",\n              \"fitness_status\": \"2\",\n              \"goal\": \"2\",\n              \"image\": \"20_1453916030.jpg\",\n              \"cover_image\": \"20_1453916040.jpg\",\n              \"city\": \"1\",\n              \"state\": \"\",\n              \"country\": \"\",\n              \"spot\": \"2\",\n              \"quote\": \"33\",\n              \"facebook\": \"hi\",\n              \"twitter\": \"fine\",\n              \"instagram\": \"u\",\n              \"created_at\": \"2016-01-27 09:45:07\",\n              \"updated_at\": \"2016-01-27 17:43:58\",\n              \"level\": 13\n            }\n          }\n        ],\n        \"personal_best\": \"3\"\n      },\n      \"2\": {\n        \"featured\": [],\n        \"following\": [],\n        \"personal_best\": \"3\"\n      },\n      \"3\": {\n        \"featured\": [],\n        \"following\": [],\n        \"personal_best\": \"3\"\n      }\n    }\n  },\n  \"urls\": {\n    \"profileImageSmall\": \"http://sandbox.ykings.com/uploads/images/profile/small\",\n    \"profileImageMedium\": \"http://sandbox.ykings.com/uploads/images/profile/medium\",\n    \"profileImageLarge\": \"http://sandbox.ykings.com/uploads/images/profile/large\",\n    \"profileImageOriginal\": \"http://sandbox.ykings.com/uploads/images/profile/original\",\n    \"video\": \"http://sandbox.ykings.com/uploads/videos\",\n    \"videothumbnail\": \"http://sandbox.ykings.com/uploads/images/videothumbnails\",\n    \"feedImageSmall\": \"http://sandbox.ykings.com/uploads/images/feed/small\",\n    \"feedImageMedium\": \"http://sandbox.ykings.com/uploads/images/feed/medium\",\n    \"feedImageLarge\": \"http://sandbox.ykings.com/uploads/images/feed/large\",\n    \"feedImageOriginal\": \"http://sandbox.ykings.com/uploads/images/feed/original\",\n    \"coverImageSmall\": \"http://sandbox.ykings.com/uploads/images/cover_image/small\",\n    \"coverImageMedium\": \"http://sandbox.ykings.com/uploads/images/cover_image/medium\",\n    \"coverImageLarge\": \"http://sandbox.ykings.com/uploads/images/cover_image/large\",\n    \"coverImageOriginal\": \"http://sandbox.ykings.com/uploads/images/cover_image/original\"\n  }\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "error",
            "description": "<p>Message token_invalid.</p> "
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 400 Invalid Request\n{\n  \"status\":\"0\",\n  \"error\": \"token_invalid\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 401 Unauthorised\n{\n  \"status\":\"0\",\n  \"error\": \"token_expired\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 400 Bad Request\n{\n  \"status\":\"0\",\n  \"error\": \"token_not_provided\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 422 Validation error\n{\n  \"status\" : 0,\n  \"error\": \"The exercise_id field is required\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 500 workout_not_exists\n{\n  \"status\" : 0,\n  \"error\": \"workout_not_exists\"\n}",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "app/Http/Controllers/Api/WorkoutsController.php",
    "groupTitle": "Workout"
  },
  {
    "type": "post",
    "url": "/workout/list",
    "title": "loadWorkouts",
    "name": "loadWorkouts",
    "group": "Workout",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "<p>Number</p> ",
            "optional": false,
            "field": "user_id",
            "description": "<p>Id of user *required</p> "
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "<p>String</p> ",
            "optional": false,
            "field": "success.",
            "description": ""
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n{\n      \"status\": 1,\n      \"is_subscribed\": 0,\n      \"workouts\": {\n      \"free\": [{\n      \"id\": \"2\",\n      \"name\": \"Borr\",\n      \"description\": \"Borr Borr Borr\",\n      \"rounds\": \"3\",\n      \"category\": \"2\",\n      \"type\": \"1\",\n      \"rewards\": \"330\",\n      \"duration\": \"19.00\",\n      \"equipments\": \"BAR\",\n      },\n      {\n      \"id\": \"3\",\n      \"name\": \"Bragi\",\n      \"description\": \"Bragi\",\n      \"rounds\": \"5\",\n      \"category\": \"2\",\n      \"type\": \"1\",\n      \"rewards\": \"200\",\n      \"duration\": \"14.00\",\n      \"equipments\": \"Low Bar\"\n      }],\n      \"paid\": [{\n      \"id\": \"1\",\n      \"name\": \"Baldur\",\n      \"description\": \"Baldur Baldur\",\n      \"rounds\": \"5\",\n      \"category\": \"1\",\n      \"type\": \"2\",\n      \"rewards\": \"330\",\n      \"duration\": \"15.00\",\n      \"equipments\": \"\"\n      }]\n      }\n      }",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "error",
            "description": "<p>Message token_invalid.</p> "
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 400 Invalid Request\n{\n  \"status\":\"0\",\n  \"error\": \"token_invalid\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 401 Unauthorised\n{\n  \"status\":\"0\",\n  \"error\": \"token_expired\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 400 Bad Request\n{\n  \"status\":\"0\",\n  \"error\": \"token_not_provided\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 422 Validation error\n{\n  \"status\" : 0,\n  \"error\": \"The user_id field is required\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 500 user_not_exists\n{\n  \"status\" : 0,\n  \"error\": \"user_not_exists\"\n}",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "app/Http/Controllers/Api/WorkoutsController.php",
    "groupTitle": "Workout"
  },
  {
    "type": "post",
    "url": "/password/email",
    "title": "RequestPassword",
    "name": "RequestPassword",
    "group": "password",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "<p>string</p> ",
            "optional": false,
            "field": "email",
            "description": "<p>email address of user *required</p> "
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "<p>String</p> ",
            "optional": false,
            "field": "success.",
            "description": ""
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n{\n     \"status\" : 1,\n     \"success\": \"successfully_sent_email_to_your_email_address\",\n     \"email\": \"aneeshk@cubettech.com\"\n }",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "error",
            "description": "<p>Message token_invalid.</p> "
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "invalid_email",
            "description": "<p>User error.</p> "
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 400 Invalid Request\n{\n  \"status\" : 0,\n  \"error\": \"token_invalid\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 401 Unauthorised\n{\n  \"status\" : 0,\n  \"error\": \"token_expired\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 400 Bad Request\n{\n \"status\" : 0,\n  \"error\": \"token_not_provided\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 422 email_reqired\n{\n     \"status\" : 0,\n     \"error\": \"email field is required\"\n     \"email\": \"aneeshk@cubettech.com\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 500 invalid_email\n{\n     \"status\" : 0,\n     \"error\": \"invalid_email\"\n     \"email\": \"aneeshk@cubettech.com\"\n}",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "app/Http/Controllers/Api/PasswordController.php",
    "groupTitle": "password"
  }
] });