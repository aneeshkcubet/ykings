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
          "content": "HTTP/1.1 200 OK\n{\n      \"status\": 1,\n      \"message\": \"successfully finished day workouts\"\n      }",
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
    "url": "/coach/getdescription",
    "title": "getDescription",
    "name": "getDescription",
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
          "content": "HTTP/1.1 200 OK\n{\n      \"status\": 1,\n      \"descriptions\": {\n      \"1\": \"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas in faucibus orci. Nunc et lorem libero. Nulla facilisi. Nunc dictum, sapien ut tincidunt ultrices, dui nunc auctor velit, ac porta lacus turpis non massa. Quisque nec vestibulum risus, quis consequat lectus. Curabitur dignissim risus ac velit tincidunt dignissim. Mauris nec risus eget felis mollis tincidunt. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. In suscipit blandit bibendum. Nulla venenatis sed libero at ornare. Interdum et malesuada fames ac ante ipsum primis in faucibus. \",\n      \"2\": \"Vestibulum rutrum efficitur vulputate. Mauris quam turpis, pellentesque sed mauris eget, imperdiet scelerisque libero. Sed vitae leo id massa consectetur vestibulum ut ac tellus. Nam luctus nisl at leo sagittis condimentum. Duis malesuada, nisl sit amet tincidunt sollicitudin, turpis leo aliquam eros, eu aliquam felis massa id urna. Suspendisse potenti. Curabitur sodales accumsan varius. Aenean nulla sem, consectetur sed ex sed, vestibulum iaculis felis. Suspendisse neque eros, sagittis quis pulvinar a, porta id est. Curabitur diam massa, semper et pretium vitae, commodo ut ligula. Sed venenatis imperdiet suscipit. Nam egestas ante vitae augue sodales consectetur. Ut vel molestie dolor. Nam lorem nibh, maximus vitae urna eget, interdum aliquam libero. Suspendisse ut metus justo. Mauris hendrerit pulvinar orci, at efficitur odio porta ut. \",\n      \"3\": \"Nullam sit amet eros nec nibh feugiat scelerisque vitae in ante. Mauris eu hendrerit eros. In et risus vel purus pharetra mollis quis sed tellus. Sed ut libero posuere risus aliquam consectetur non ac dui. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed maximus lobortis nulla ut elementum. Aliquam vel accumsan leo. In sagittis enim scelerisque dolor dictum tristique. Donec mattis ut turpis id finibus. Nullam ac imperdiet nisi. In accumsan massa id magna imperdiet eleifend. Donec tempor blandit lacinia. Nulla vitae ligula sit amet est luctus vehicula. \"\n      }\n      }",
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
            "field": "test1",
            "description": "<p>status of test1 0-failed 1-passed *required</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>Number</p> ",
            "optional": false,
            "field": "test2",
            "description": "<p>status of test2 0-failed 1-passed *required</p> "
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
            "type": "<p>Number</p> ",
            "optional": true,
            "field": "height",
            "description": "<p>user height in centimeters</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>Number</p> ",
            "optional": true,
            "field": "weight",
            "description": "<p>user weight in lbs</p> "
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
          "content": "HTTP/1.1 200 OK\n{\n      \"status\": 1,\n      \"coach_day\": \"1\",\n      \"coach_week\": \"1\",\n      \"is_subscribed\": 0,\n      \"need_update\": \"0\",\n      \"coach\": {\n      \"id\": \"9\",\n      \"user_id\": \"96\",\n      \"focus\": \"3\",\n      \"height\": \"172.00\",\n      \"weight\": \"176.00\",\n      \"days\": \"2\",\n      \"exercises\": {\n      \"day1\": {\n      \"warmup\": [\n      {\n      \"id\": \"1\",\n      \"name\": \"Wall Extensions\",\n      \"duration\": {\n      \"min\": 10,\n      \"max\": 20\n      },\n      \"unit\": \"times\",\n      \"created_at\": \"2016-01-11 00:00:00\",\n      \"updated_at\": \"2016-01-11 08:27:00\"\n      },\n      {\n      \"id\": \"2\",\n      \"name\": \"band dislocates\",\n      \"duration\": {\n      \"min\": 10,\n      \"max\": 20\n      },\n      \"unit\": \"times\",\n      \"created_at\": \"2016-01-11 00:00:00\",\n      \"updated_at\": \"2016-01-11 08:26:57\"\n      },\n      {\n      \"id\": \"3\",\n      \"name\": \"Cat-camels\",\n      \"duration\": {\n      \"min\": 10,\n      \"max\": 20\n      },\n      \"unit\": \"times\",\n      \"created_at\": \"2016-01-11 00:00:00\",\n      \"updated_at\": \"2016-01-11 08:26:53\"\n      },\n      {\n      \"id\": \"4\",\n      \"name\": \"Scapular Shrugs\",\n      \"duration\": {\n      \"min\": 10,\n      \"max\": 20\n      },\n      \"unit\": \"times\",\n      \"created_at\": \"2016-01-11 00:00:00\",\n      \"updated_at\": \"2016-01-11 08:26:49\"\n      },\n      {\n      \"id\": \"5\",\n      \"name\": \"Full Body Circles\",\n      \"duration\": {\n      \"min\": 10,\n      \"max\": 20\n      },\n      \"unit\": \"times\",\n      \"created_at\": \"2016-01-11 00:00:01\",\n      \"updated_at\": \"2016-01-11 08:26:44\"\n      },\n      {\n      \"id\": \"6\",\n      \"name\": \"Front and Side Leg Swings\",\n      \"duration\": {\n      \"min\": 10,\n      \"max\": 20\n      },\n      \"unit\": \"times\",\n      \"created_at\": \"2016-01-11 00:00:01\",\n      \"updated_at\": \"2016-01-11 08:26:40\"\n      },\n      {\n      \"id\": \"7\",\n      \"name\": \"Jumping Jacks\",\n      \"duration\": {\n      \"min\": 100\n      },\n      \"unit\": \"times\",\n      \"created_at\": \"2016-01-11 00:00:01\",\n      \"updated_at\": \"2016-01-11 08:29:46\"\n      },\n      {\n      \"id\": \"8\",\n      \"name\": \"Arm Rotations\",\n      \"duration\": {\n      \"min\": 120\n      },\n      \"unit\": \"times\",\n      \"created_at\": \"2016-01-11 00:00:02\",\n      \"updated_at\": \"2016-01-11 08:29:55\"\n      },\n      {\n      \"id\": \"9\",\n      \"name\": \"High Knees\",\n      \"duration\": {\n      \"min\": 50\n      },\n      \"unit\": \"times\",\n      \"created_at\": \"2016-01-11 00:00:02\",\n      \"updated_at\": \"2016-01-11 08:30:04\"\n      },\n      {\n      \"id\": \"10\",\n      \"name\": \"Plank\",\n      \"duration\": {\n      \"min\": 10,\n      \"max\": 60\n      },\n      \"unit\": \"seconds\",\n      \"created_at\": \"2016-01-11 00:00:02\",\n      \"updated_at\": \"2016-01-11 08:28:03\"\n      },\n      {\n      \"id\": \"11\",\n      \"name\": \"Burpee\",\n      \"duration\": {\n      \"min\": 10\n      },\n      \"unit\": \"times\",\n      \"created_at\": \"2016-01-11 00:00:03\",\n      \"updated_at\": \"2016-01-11 08:30:44\"\n      },\n      {\n      \"id\": \"12\",\n      \"name\": \"Shouder rolls\",\n      \"duration\": {\n      \"min\": 20\n      },\n      \"unit\": \"times\",\n      \"created_at\": \"2016-01-11 00:00:03\",\n      \"updated_at\": \"2016-01-11 08:31:11\"\n      },\n      {\n      \"id\": \"13\",\n      \"name\": \"Squat jumps\",\n      \"duration\": {\n      \"min\": 10\n      },\n      \"unit\": \"times\",\n      \"created_at\": \"2016-01-11 00:00:03\",\n      \"updated_at\": \"2016-01-11 08:31:29\"\n      }\n      ],\n      \"fundumentals\": [\n      {\n      \"exercise_id\": 4,\n      \"duration\": {\n      \"min\": 10\n      },\n      \"unit\": \"times\",\n      \"exercise\": {\n      \"id\": \"4\",\n      \"name\": \"Skin the cat\",\n      \"description\": \"A good upper body stretching exercise, especially for achieving full range of motion in the shoulder. The skin the cat exercise is a fundamental movement performed on gymnastics rings.\",\n      \"category\": \"1\",\n      \"type\": \"2\",\n      \"muscle_groups\": \"0\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \"\",\n      \"video_tips\": \"\",\n      \"pro_tips\": \"\",\n      \"video\": [\n      {\n      \"id\": \"4\",\n      \"path\": \"Now4.mp4\",\n      \"videothumbnail\": \"thumbnail3.jpg\",\n      \"description\": \"Test Description\"\n      }\n      ]\n      }\n      },\n      {\n      \"exercise_id\": 12,\n      \"duration\": {\n      \"min\": 20\n      },\n      \"unit\": \"times\",\n      \"exercise\": {\n      \"id\": \"12\",\n      \"name\": \"Incline Pushups\",\n      \"description\": \"\",\n      \"category\": \"1\",\n      \"type\": \"1\",\n      \"muscle_groups\": \"2,1,3\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"1\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \"\",\n      \"video_tips\": \"\",\n      \"pro_tips\": \"\",\n      \"video\": [\n      {\n      \"id\": \"12\",\n      \"path\": \"Now12.mp4\",\n      \"videothumbnail\": \"thumbnail2.png\",\n      \"description\": \"Test Description\"\n      }\n      ]\n      }\n      },\n      {\n      \"exercise_id\": 36,\n      \"duration\": {\n      \"min\": 40\n      },\n      \"unit\": \"times\",\n      \"exercise\": {\n      \"id\": \"36\",\n      \"name\": \"Dips (Bench)\",\n      \"description\": \"\",\n      \"category\": \"2\",\n      \"type\": \"1\",\n      \"muscle_groups\": \"0\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"1\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \"\",\n      \"video_tips\": \"\",\n      \"pro_tips\": \"\",\n      \"video\": [\n      {\n      \"id\": \"36\",\n      \"path\": \"Now36.mp4\",\n      \"videothumbnail\": \"thumbnail2.png\",\n      \"description\": \"Test Description\"\n      }\n      ]\n      }\n      },\n      {\n      \"exercise_id\": 3,\n      \"duration\": {\n      \"min\": 15\n      },\n      \"unit\": \"times\",\n      \"exercise\": {\n      \"id\": \"3\",\n      \"name\": \"Knee Raises\",\n      \"description\": \"Standing Knee Raises (also known as standing knee crunches and standing knee pulls) is a functional abdominal exercise for boosting strength throughout the core. Unlike standard ab exercises, they don’t isolate abdominal muscles. Instead they work your upper abs and lower abs in conjunction with other important muscles such as hips, back and shoulders.\",\n      \"category\": \"1\",\n      \"type\": \"2\",\n      \"muscle_groups\": \"6,4,7\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"1\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \"\",\n      \"video_tips\": \"\",\n      \"pro_tips\": \"\",\n      \"video\": [\n      {\n      \"id\": \"3\",\n      \"path\": \"Now3.mp4\",\n      \"videothumbnail\": \"thumbnail2.png\",\n      \"description\": \"Test Description\"\n      }\n      ]\n      }\n      },\n      {\n      \"exercise_id\": 8,\n      \"duration\": {\n      \"min\": 20\n      },\n      \"unit\": \"times\",\n      \"exercise\": {\n      \"id\": \"8\",\n      \"name\": \"Single Leg Deadlift\",\n      \"description\": \"\",\n      \"category\": \"1\",\n      \"type\": \"2\",\n      \"muscle_groups\": \"7\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"1\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \"\",\n      \"video_tips\": \"\",\n      \"pro_tips\": \"\",\n      \"video\": [\n      {\n      \"id\": \"8\",\n      \"path\": \"Now8.mp4\",\n      \"videothumbnail\": \"thumbnail1.png\",\n      \"description\": \"Test Description\"\n      }\n      ]\n      }\n      }\n      ],\n      \"exercises\": [],\n      \"workout\": {\n      \"id\": \"1\",\n      \"name\": \"Baldur\",\n      \"description\": \"Baldur Baldur\",\n      \"rounds\": \"5\",\n      \"category\": \"1\",\n      \"type\": \"2\",\n      \"rewards\": 550,\n      \"duration\": \"1680.00\",\n      \"equipments\": \"\",\n      \"exercises\": {\n      \"round1\": [\n      {\n      \"id\": \"31\",\n      \"workout_id\": \"1\",\n      \"category\": \"3\",\n      \"repititions\": \"50\",\n      \"exercise_id\": \"69\",\n      \"unit\": \"times\",\n      \"round\": \"1\",\n      \"created_at\": \"2015-11-18 18:30:00\",\n      \"updated_at\": \"2015-12-07 10:17:23\",\n      \"video\": {\n      \"id\": \"69\",\n      \"path\": \"Now69.mp4\",\n      \"videothumbnail\": \"thumbnail3.jpg\",\n      \"description\": \"Test Description\"\n      },\n      \"exercise\": {\n      \"id\": \"69\",\n      \"name\": \"Muscleups\",\n      \"description\": \"\"\n      }\n      },\n      {\n      \"id\": \"32\",\n      \"workout_id\": \"1\",\n      \"category\": \"3\",\n      \"repititions\": \"50\",\n      \"exercise_id\": \"85\",\n      \"unit\": \"times\",\n      \"round\": \"1\",\n      \"created_at\": \"2015-11-18 18:30:00\",\n      \"updated_at\": \"2015-12-07 10:17:23\",\n      \"video\": {\n      \"id\": \"86\",\n      \"path\": \"Now86.mp4\",\n      \"videothumbnail\": \"thumbnail1.png\",\n      \"description\": \"Test Description\"\n      },\n      \"exercise\": {\n      \"id\": \"85\",\n      \"name\": \"Atztec Pushups\",\n      \"description\": \"\"\n      }\n      },\n      {\n      \"id\": \"33\",\n      \"workout_id\": \"1\",\n      \"category\": \"3\",\n      \"repititions\": \"50\",\n      \"exercise_id\": \"70\",\n      \"unit\": \"times\",\n      \"round\": \"1\",\n      \"created_at\": \"2015-11-18 18:30:00\",\n      \"updated_at\": \"2015-12-07 10:17:23\",\n      \"video\": {\n      \"id\": \"70\",\n      \"path\": \"Now70.mp4\",\n      \"videothumbnail\": \"thumbnail1.png\",\n      \"description\": \"Test Description\"\n      },\n      \"exercise\": {\n      \"id\": \"70\",\n      \"name\": \"Dips\",\n      \"description\": \"\"\n      }\n      }\n      ],\n      \"round2\": [\n      {\n      \"id\": \"34\",\n      \"workout_id\": \"1\",\n      \"category\": \"3\",\n      \"repititions\": \"40\",\n      \"exercise_id\": \"69\",\n      \"unit\": \"times\",\n      \"round\": \"2\",\n      \"created_at\": \"2015-11-18 18:30:00\",\n      \"updated_at\": \"2015-12-07 10:17:23\",\n      \"video\": {\n      \"id\": \"69\",\n      \"path\": \"Now69.mp4\",\n      \"videothumbnail\": \"thumbnail3.jpg\",\n      \"description\": \"Test Description\"\n      },\n      \"exercise\": {\n      \"id\": \"69\",\n      \"name\": \"Muscleups\",\n      \"description\": \"\"\n      }\n      },\n      {\n      \"id\": \"35\",\n      \"workout_id\": \"1\",\n      \"category\": \"3\",\n      \"repititions\": \"40\",\n      \"exercise_id\": \"85\",\n      \"unit\": \"times\",\n      \"round\": \"2\",\n      \"created_at\": \"2015-11-18 18:30:00\",\n      \"updated_at\": \"2015-12-07 10:17:23\",\n      \"video\": {\n      \"id\": \"86\",\n      \"path\": \"Now86.mp4\",\n      \"videothumbnail\": \"thumbnail1.png\",\n      \"description\": \"Test Description\"\n      },\n      \"exercise\": {\n      \"id\": \"85\",\n      \"name\": \"Atztec Pushups\",\n      \"description\": \"\"\n      }\n      },\n      {\n      \"id\": \"36\",\n      \"workout_id\": \"1\",\n      \"category\": \"3\",\n      \"repititions\": \"40\",\n      \"exercise_id\": \"70\",\n      \"unit\": \"times\",\n      \"round\": \"2\",\n      \"created_at\": \"2015-11-18 18:30:00\",\n      \"updated_at\": \"2015-12-07 10:17:23\",\n      \"video\": {\n      \"id\": \"70\",\n      \"path\": \"Now70.mp4\",\n      \"videothumbnail\": \"thumbnail1.png\",\n      \"description\": \"Test Description\"\n      },\n      \"exercise\": {\n      \"id\": \"70\",\n      \"name\": \"Dips\",\n      \"description\": \"\"\n      }\n      }\n      ],\n      \"round3\": [\n      {\n      \"id\": \"37\",\n      \"workout_id\": \"1\",\n      \"category\": \"3\",\n      \"repititions\": \"30\",\n      \"exercise_id\": \"69\",\n      \"unit\": \"times\",\n      \"round\": \"3\",\n      \"created_at\": \"2015-11-18 18:30:00\",\n      \"updated_at\": \"2015-12-07 10:17:23\",\n      \"video\": {\n      \"id\": \"69\",\n      \"path\": \"Now69.mp4\",\n      \"videothumbnail\": \"thumbnail3.jpg\",\n      \"description\": \"Test Description\"\n      },\n      \"exercise\": {\n      \"id\": \"69\",\n      \"name\": \"Muscleups\",\n      \"description\": \"\"\n      }\n      },\n      {\n      \"id\": \"38\",\n      \"workout_id\": \"1\",\n      \"category\": \"3\",\n      \"repititions\": \"30\",\n      \"exercise_id\": \"85\",\n      \"unit\": \"times\",\n      \"round\": \"3\",\n      \"created_at\": \"2015-11-18 18:30:00\",\n      \"updated_at\": \"2015-12-07 10:17:23\",\n      \"video\": {\n      \"id\": \"86\",\n      \"path\": \"Now86.mp4\",\n      \"videothumbnail\": \"thumbnail1.png\",\n      \"description\": \"Test Description\"\n      },\n      \"exercise\": {\n      \"id\": \"85\",\n      \"name\": \"Atztec Pushups\",\n      \"description\": \"\"\n      }\n      },\n      {\n      \"id\": \"39\",\n      \"workout_id\": \"1\",\n      \"category\": \"3\",\n      \"repititions\": \"30\",\n      \"exercise_id\": \"70\",\n      \"unit\": \"times\",\n      \"round\": \"3\",\n      \"created_at\": \"2015-11-18 18:30:00\",\n      \"updated_at\": \"2015-12-07 10:17:23\",\n      \"video\": {\n      \"id\": \"70\",\n      \"path\": \"Now70.mp4\",\n      \"videothumbnail\": \"thumbnail1.png\",\n      \"description\": \"Test Description\"\n      },\n      \"exercise\": {\n      \"id\": \"70\",\n      \"name\": \"Dips\",\n      \"description\": \"\"\n      }\n      }\n      ],\n      \"round4\": [\n      {\n      \"id\": \"40\",\n      \"workout_id\": \"1\",\n      \"category\": \"3\",\n      \"repititions\": \"20\",\n      \"exercise_id\": \"69\",\n      \"unit\": \"times\",\n      \"round\": \"4\",\n      \"created_at\": \"2015-11-18 18:30:00\",\n      \"updated_at\": \"2015-12-07 10:17:23\",\n      \"video\": {\n      \"id\": \"69\",\n      \"path\": \"Now69.mp4\",\n      \"videothumbnail\": \"thumbnail3.jpg\",\n      \"description\": \"Test Description\"\n      },\n      \"exercise\": {\n      \"id\": \"69\",\n      \"name\": \"Muscleups\",\n      \"description\": \"\"\n      }\n      },\n      {\n      \"id\": \"41\",\n      \"workout_id\": \"1\",\n      \"category\": \"3\",\n      \"repititions\": \"20\",\n      \"exercise_id\": \"85\",\n      \"unit\": \"times\",\n      \"round\": \"4\",\n      \"created_at\": \"2015-11-18 18:30:00\",\n      \"updated_at\": \"2015-12-07 10:17:23\",\n      \"video\": {\n      \"id\": \"86\",\n      \"path\": \"Now86.mp4\",\n      \"videothumbnail\": \"thumbnail1.png\",\n      \"description\": \"Test Description\"\n      },\n      \"exercise\": {\n      \"id\": \"85\",\n      \"name\": \"Atztec Pushups\",\n      \"description\": \"\"\n      }\n      },\n      {\n      \"id\": \"42\",\n      \"workout_id\": \"1\",\n      \"category\": \"3\",\n      \"repititions\": \"20\",\n      \"exercise_id\": \"70\",\n      \"unit\": \"times\",\n      \"round\": \"4\",\n      \"created_at\": \"2015-11-18 18:30:00\",\n      \"updated_at\": \"2015-12-07 10:17:23\",\n      \"video\": {\n      \"id\": \"70\",\n      \"path\": \"Now70.mp4\",\n      \"videothumbnail\": \"thumbnail1.png\",\n      \"description\": \"Test Description\"\n      },\n      \"exercise\": {\n      \"id\": \"70\",\n      \"name\": \"Dips\",\n      \"description\": \"\"\n      }\n      }\n      ],\n      \"round5\": [\n      {\n      \"id\": \"43\",\n      \"workout_id\": \"1\",\n      \"category\": \"3\",\n      \"repititions\": \"10\",\n      \"exercise_id\": \"69\",\n      \"unit\": \"times\",\n      \"round\": \"5\",\n      \"created_at\": \"2015-11-18 18:30:00\",\n      \"updated_at\": \"2015-12-07 10:17:23\",\n      \"video\": {\n      \"id\": \"69\",\n      \"path\": \"Now69.mp4\",\n      \"videothumbnail\": \"thumbnail3.jpg\",\n      \"description\": \"Test Description\"\n      },\n      \"exercise\": {\n      \"id\": \"69\",\n      \"name\": \"Muscleups\",\n      \"description\": \"\"\n      }\n      },\n      {\n      \"id\": \"44\",\n      \"workout_id\": \"1\",\n      \"category\": \"3\",\n      \"repititions\": \"10\",\n      \"exercise_id\": \"85\",\n      \"unit\": \"times\",\n      \"round\": \"5\",\n      \"created_at\": \"2015-11-18 18:30:00\",\n      \"updated_at\": \"2015-12-07 10:17:23\",\n      \"video\": {\n      \"id\": \"86\",\n      \"path\": \"Now86.mp4\",\n      \"videothumbnail\": \"thumbnail1.png\",\n      \"description\": \"Test Description\"\n      },\n      \"exercise\": {\n      \"id\": \"85\",\n      \"name\": \"Atztec Pushups\",\n      \"description\": \"\"\n      }\n      },\n      {\n      \"id\": \"45\",\n      \"workout_id\": \"1\",\n      \"category\": \"3\",\n      \"repititions\": \"10\",\n      \"exercise_id\": \"70\",\n      \"unit\": \"times\",\n      \"round\": \"5\",\n      \"created_at\": \"2015-11-18 18:30:00\",\n      \"updated_at\": \"2015-12-07 10:17:23\",\n      \"video\": {\n      \"id\": \"70\",\n      \"path\": \"Now70.mp4\",\n      \"videothumbnail\": \"thumbnail1.png\",\n      \"description\": \"Test Description\"\n      },\n      \"exercise\": {\n      \"id\": \"70\",\n      \"name\": \"Dips\",\n      \"description\": \"\"\n      }\n      }\n      ],\n      \"round6\": [\n      {\n      \"id\": \"31\",\n      \"workout_id\": \"1\",\n      \"category\": \"3\",\n      \"repititions\": \"50\",\n      \"exercise_id\": \"69\",\n      \"unit\": \"times\",\n      \"round\": \"1\",\n      \"created_at\": \"2015-11-18 18:30:00\",\n      \"updated_at\": \"2015-12-07 10:17:23\",\n      \"video\": {\n      \"id\": \"69\",\n      \"path\": \"Now69.mp4\",\n      \"videothumbnail\": \"thumbnail3.jpg\",\n      \"description\": \"Test Description\"\n      },\n      \"exercise\": {\n      \"id\": \"69\",\n      \"name\": \"Muscleups\",\n      \"description\": \"\"\n      }\n      },\n      {\n      \"id\": \"32\",\n      \"workout_id\": \"1\",\n      \"category\": \"3\",\n      \"repititions\": \"50\",\n      \"exercise_id\": \"85\",\n      \"unit\": \"times\",\n      \"round\": \"1\",\n      \"created_at\": \"2015-11-18 18:30:00\",\n      \"updated_at\": \"2015-12-07 10:17:23\",\n      \"video\": {\n      \"id\": \"86\",\n      \"path\": \"Now86.mp4\",\n      \"videothumbnail\": \"thumbnail1.png\",\n      \"description\": \"Test Description\"\n      },\n      \"exercise\": {\n      \"id\": \"85\",\n      \"name\": \"Atztec Pushups\",\n      \"description\": \"\"\n      }\n      },\n      {\n      \"id\": \"33\",\n      \"workout_id\": \"1\",\n      \"category\": \"3\",\n      \"repititions\": \"50\",\n      \"exercise_id\": \"70\",\n      \"unit\": \"times\",\n      \"round\": \"1\",\n      \"created_at\": \"2015-11-18 18:30:00\",\n      \"updated_at\": \"2015-12-07 10:17:23\",\n      \"video\": {\n      \"id\": \"70\",\n      \"path\": \"Now70.mp4\",\n      \"videothumbnail\": \"thumbnail1.png\",\n      \"description\": \"Test Description\"\n      },\n      \"exercise\": {\n      \"id\": \"70\",\n      \"name\": \"Dips\",\n      \"description\": \"\"\n      }\n      }\n      ]\n      }\n      },\n      \"coach_workout_rounds\": 6,\n      \"workout_intensity\": 2,\n      \"hiit\": [],\n      \"stretching\": [\n      {\n      \"exercise_id\": \"Superman\",\n      \"duration\": {\n      \"min\": 6,\n      \"max\": 13\n      },\n      \"unit\": \"times\"\n      },\n      {\n      \"exercise_id\": \"Lower Back Strength\",\n      \"duration\": {\n      \"min\": 38,\n      \"max\": 63\n      },\n      \"unit\": \"times\"\n      },\n      {\n      \"exercise_id\": \"Upper Dog\",\n      \"duration\": {\n      \"min\": 38,\n      \"max\": 75\n      },\n      \"unit\": \"seconds\"\n      },\n      {\n      \"exercise_id\": \"Child's Pose\",\n      \"duration\": {\n      \"min\": 38,\n      \"max\": 75\n      },\n      \"unit\": \"seconds\"\n      },\n      {\n      \"exercise_id\": \"L-sit on the floor\",\n      \"duration\": {\n      \"min\": 38,\n      \"max\": 75\n      },\n      \"unit\": \"seconds\"\n      },\n      {\n      \"exercise_id\": \"Frog stretch\",\n      \"duration\": {\n      \"min\": 38,\n      \"max\": 75\n      },\n      \"unit\": \"seconds\"\n      },\n      {\n      \"exercise_id\": \"Good morning\",\n      \"duration\": {\n      \"min\": 38,\n      \"max\": 75\n      },\n      \"unit\": \"seconds\"\n      },\n      {\n      \"exercise_id\": \"Chest Opener\",\n      \"duration\": {\n      \"min\": 38,\n      \"max\": 75\n      },\n      \"unit\": \"seconds\"\n      },\n      {\n      \"exercise_id\": \"Triceps Stretch\",\n      \"duration\": {\n      \"min\": 38,\n      \"max\": 75\n      },\n      \"unit\": \"seconds\"\n      },\n      {\n      \"exercise_id\": \"Hands Back\",\n      \"duration\": {\n      \"min\": 38,\n      \"max\": 75\n      },\n      \"unit\": \"seconds\"\n      },\n      {\n      \"exercise_id\": \"Shoulder Stretch\",\n      \"duration\": {\n      \"min\": 38,\n      \"max\": 75\n      },\n      \"unit\": \"seconds\"\n      }\n      ]\n      },\n      \"day2\": {\n      \"warmup\": [\n      {\n      \"id\": \"1\",\n      \"name\": \"Wall Extensions\",\n      \"duration\": {\n      \"min\": 10,\n      \"max\": 20\n      },\n      \"unit\": \"times\",\n      \"created_at\": \"2016-01-11 00:00:00\",\n      \"updated_at\": \"2016-01-11 08:27:00\"\n      },\n      {\n      \"id\": \"2\",\n      \"name\": \"band dislocates\",\n      \"duration\": {\n      \"min\": 10,\n      \"max\": 20\n      },\n      \"unit\": \"times\",\n      \"created_at\": \"2016-01-11 00:00:00\",\n      \"updated_at\": \"2016-01-11 08:26:57\"\n      },\n      {\n      \"id\": \"3\",\n      \"name\": \"Cat-camels\",\n      \"duration\": {\n      \"min\": 10,\n      \"max\": 20\n      },\n      \"unit\": \"times\",\n      \"created_at\": \"2016-01-11 00:00:00\",\n      \"updated_at\": \"2016-01-11 08:26:53\"\n      },\n      {\n      \"id\": \"4\",\n      \"name\": \"Scapular Shrugs\",\n      \"duration\": {\n      \"min\": 10,\n      \"max\": 20\n      },\n      \"unit\": \"times\",\n      \"created_at\": \"2016-01-11 00:00:00\",\n      \"updated_at\": \"2016-01-11 08:26:49\"\n      },\n      {\n      \"id\": \"5\",\n      \"name\": \"Full Body Circles\",\n      \"duration\": {\n      \"min\": 10,\n      \"max\": 20\n      },\n      \"unit\": \"times\",\n      \"created_at\": \"2016-01-11 00:00:01\",\n      \"updated_at\": \"2016-01-11 08:26:44\"\n      },\n      {\n      \"id\": \"6\",\n      \"name\": \"Front and Side Leg Swings\",\n      \"duration\": {\n      \"min\": 10,\n      \"max\": 20\n      },\n      \"unit\": \"times\",\n      \"created_at\": \"2016-01-11 00:00:01\",\n      \"updated_at\": \"2016-01-11 08:26:40\"\n      },\n      {\n      \"id\": \"7\",\n      \"name\": \"Jumping Jacks\",\n      \"duration\": {\n      \"min\": 100\n      },\n      \"unit\": \"times\",\n      \"created_at\": \"2016-01-11 00:00:01\",\n      \"updated_at\": \"2016-01-11 08:29:46\"\n      },\n      {\n      \"id\": \"8\",\n      \"name\": \"Arm Rotations\",\n      \"duration\": {\n      \"min\": 120\n      },\n      \"unit\": \"times\",\n      \"created_at\": \"2016-01-11 00:00:02\",\n      \"updated_at\": \"2016-01-11 08:29:55\"\n      },\n      {\n      \"id\": \"9\",\n      \"name\": \"High Knees\",\n      \"duration\": {\n      \"min\": 50\n      },\n      \"unit\": \"times\",\n      \"created_at\": \"2016-01-11 00:00:02\",\n      \"updated_at\": \"2016-01-11 08:30:04\"\n      },\n      {\n      \"id\": \"10\",\n      \"name\": \"Plank\",\n      \"duration\": {\n      \"min\": 10,\n      \"max\": 60\n      },\n      \"unit\": \"seconds\",\n      \"created_at\": \"2016-01-11 00:00:02\",\n      \"updated_at\": \"2016-01-11 08:28:03\"\n      },\n      {\n      \"id\": \"11\",\n      \"name\": \"Burpee\",\n      \"duration\": {\n      \"min\": 10\n      },\n      \"unit\": \"times\",\n      \"created_at\": \"2016-01-11 00:00:03\",\n      \"updated_at\": \"2016-01-11 08:30:44\"\n      },\n      {\n      \"id\": \"12\",\n      \"name\": \"Shouder rolls\",\n      \"duration\": {\n      \"min\": 20\n      },\n      \"unit\": \"times\",\n      \"created_at\": \"2016-01-11 00:00:03\",\n      \"updated_at\": \"2016-01-11 08:31:11\"\n      },\n      {\n      \"id\": \"13\",\n      \"name\": \"Squat jumps\",\n      \"duration\": {\n      \"min\": 10\n      },\n      \"unit\": \"times\",\n      \"created_at\": \"2016-01-11 00:00:03\",\n      \"updated_at\": \"2016-01-11 08:31:29\"\n      }\n      ],\n      \"fundumentals\": [\n      {\n      \"exercise_id\": 1,\n      \"duration\": {\n      \"min\": 15\n      },\n      \"unit\": \"times\",\n      \"exercise\": {\n      \"id\": \"1\",\n      \"name\": \"Jumping Pullups\",\n      \"description\": \"The jumping pull-up is a challenging full body exercise that targets the back, legs and arms.\",\n      \"category\": \"1\",\n      \"type\": \"1\",\n      \"muscle_groups\": \"0\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"1\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \"\",\n      \"video_tips\": \"\",\n      \"pro_tips\": \"\",\n      \"video\": [\n      {\n      \"id\": \"1\",\n      \"path\": \"Now1.mp4\",\n      \"videothumbnail\": \"thumbnail3.jpg\",\n      \"description\": \"Test Description\"\n      }\n      ]\n      }\n      },\n      {\n      \"exercise_id\": 13,\n      \"duration\": {\n      \"min\": 20\n      },\n      \"unit\": \"times\",\n      \"exercise\": {\n      \"id\": \"13\",\n      \"name\": \"Military Press\",\n      \"description\": \"\",\n      \"category\": \"1\",\n      \"type\": \"1\",\n      \"muscle_groups\": \"1,3\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"1\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \"\",\n      \"video_tips\": \"\",\n      \"pro_tips\": \"\",\n      \"video\": [\n      {\n      \"id\": \"13\",\n      \"path\": \"Now13.mp4\",\n      \"videothumbnail\": \"thumbnail3.jpg\",\n      \"description\": \"Test Description\"\n      }\n      ]\n      }\n      },\n      {\n      \"exercise_id\": 5,\n      \"duration\": {\n      \"min\": 40\n      },\n      \"unit\": \"times\",\n      \"exercise\": {\n      \"id\": \"5\",\n      \"name\": \"Side Triceps\",\n      \"description\": \"\",\n      \"category\": \"1\",\n      \"type\": \"1\",\n      \"muscle_groups\": \"0\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"30\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \"\",\n      \"video_tips\": \"\",\n      \"pro_tips\": \"\",\n      \"video\": [\n      {\n      \"id\": \"5\",\n      \"path\": \"Now5.mp4\",\n      \"videothumbnail\": \"thumbnail1.png\",\n      \"description\": \"Test Description\"\n      }\n      ]\n      }\n      },\n      {\n      \"exercise_id\": 16,\n      \"duration\": {\n      \"min\": 40\n      },\n      \"unit\": \"times\",\n      \"exercise\": {\n      \"id\": \"16\",\n      \"name\": \"Crunches\",\n      \"description\": \"\",\n      \"category\": \"1\",\n      \"type\": \"1\",\n      \"muscle_groups\": \"6\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"1\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \"\",\n      \"video_tips\": \"\",\n      \"pro_tips\": \"\",\n      \"video\": [\n      {\n      \"id\": \"16\",\n      \"path\": \"Now16.mp4\",\n      \"videothumbnail\": \"thumbnail3.jpg\",\n      \"description\": \"Test Description\"\n      }\n      ]\n      }\n      },\n      {\n      \"exercise_id\": 7,\n      \"duration\": {\n      \"min\": 60,\n      \"max\": 90\n      },\n      \"unit\": \"seconds\",\n      \"exercise\": {\n      \"id\": \"7\",\n      \"name\": \"Wall Sits\",\n      \"description\": \"\",\n      \"category\": \"1\",\n      \"type\": \"1\",\n      \"muscle_groups\": \"7,8\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"seconds\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \"\",\n      \"video_tips\": \"\",\n      \"pro_tips\": \"\",\n      \"video\": [\n      {\n      \"id\": \"7\",\n      \"path\": \"Now7.mp4\",\n      \"videothumbnail\": \"thumbnail3.jpg\",\n      \"description\": \"Test Description\"\n      }\n      ]\n      }\n      }\n      ],\n      \"exercises\": [],\n      \"workout\": {\n      \"id\": \"4\",\n      \"name\": \"Buri\",\n      \"description\": \"Buri\",\n      \"rounds\": \"1\",\n      \"category\": \"1\",\n      \"type\": \"2\",\n      \"rewards\": 550,\n      \"duration\": \"1440.00\",\n      \"equipments\": \"Bar\",\n      \"exercises\": {\n      \"round1\": [\n      {\n      \"id\": \"150\",\n      \"workout_id\": \"4\",\n      \"category\": \"3\",\n      \"repititions\": \"180\",\n      \"exercise_id\": \"75\",\n      \"unit\": \"seconds\",\n      \"round\": \"1\",\n      \"created_at\": \"2015-11-18 18:30:00\",\n      \"updated_at\": \"2015-11-19 10:00:00\",\n      \"video\": {\n      \"id\": \"76\",\n      \"path\": \"Now76.mp4\",\n      \"videothumbnail\": \"thumbnail3.jpg\",\n      \"description\": \"Test Description\"\n      },\n      \"exercise\": {\n      \"id\": \"75\",\n      \"name\": \"Jacknives\",\n      \"description\": \"\"\n      }\n      },\n      {\n      \"id\": \"151\",\n      \"workout_id\": \"4\",\n      \"category\": \"3\",\n      \"repititions\": \"50\",\n      \"exercise_id\": \"69\",\n      \"unit\": \"times\",\n      \"round\": \"1\",\n      \"created_at\": \"2015-11-18 18:30:00\",\n      \"updated_at\": \"2015-11-19 10:00:00\",\n      \"video\": {\n      \"id\": \"69\",\n      \"path\": \"Now69.mp4\",\n      \"videothumbnail\": \"thumbnail3.jpg\",\n      \"description\": \"Test Description\"\n      },\n      \"exercise\": {\n      \"id\": \"69\",\n      \"name\": \"Muscleups\",\n      \"description\": \"\"\n      }\n      },\n      {\n      \"id\": \"152\",\n      \"workout_id\": \"4\",\n      \"category\": \"3\",\n      \"repititions\": \"100\",\n      \"exercise_id\": \"70\",\n      \"unit\": \"times\",\n      \"round\": \"1\",\n      \"created_at\": \"2015-11-18 18:30:00\",\n      \"updated_at\": \"2015-11-19 10:00:54\",\n      \"video\": {\n      \"id\": \"70\",\n      \"path\": \"Now70.mp4\",\n      \"videothumbnail\": \"thumbnail1.png\",\n      \"description\": \"Test Description\"\n      },\n      \"exercise\": {\n      \"id\": \"70\",\n      \"name\": \"Dips\",\n      \"description\": \"\"\n      }\n      },\n      {\n      \"id\": \"153\",\n      \"workout_id\": \"4\",\n      \"category\": \"3\",\n      \"repititions\": \"50\",\n      \"exercise_id\": \"74\",\n      \"unit\": \"times\",\n      \"round\": \"1\",\n      \"created_at\": \"2015-11-18 18:30:00\",\n      \"updated_at\": \"2015-11-19 10:45:38\",\n      \"video\": {\n      \"id\": \"75\",\n      \"path\": \"Now75.mp4\",\n      \"videothumbnail\": \"thumbnail2.png\",\n      \"description\": \"Test Description\"\n      },\n      \"exercise\": {\n      \"id\": \"74\",\n      \"name\": \"Handstand Pushups\",\n      \"description\": \"\"\n      }\n      },\n      {\n      \"id\": \"154\",\n      \"workout_id\": \"4\",\n      \"category\": \"3\",\n      \"repititions\": \"200\",\n      \"exercise_id\": \"82\",\n      \"unit\": \"times\",\n      \"round\": \"1\",\n      \"created_at\": \"2015-11-18 18:30:00\",\n      \"updated_at\": \"2015-11-19 10:00:00\",\n      \"video\": {\n      \"id\": \"83\",\n      \"path\": \"Now83.mp4\",\n      \"videothumbnail\": \"thumbnail1.png\",\n      \"description\": \"Test Description\"\n      },\n      \"exercise\": {\n      \"id\": \"82\",\n      \"name\": \"Iron Mike\",\n      \"description\": \"\"\n      }\n      }\n      ]\n      }\n      },\n      \"coach_workout_rounds\": 1,\n      \"workout_intensity\": 1,\n      \"hiit\": [\n      {\n      \"id\": 2,\n      \"intensity\": 4\n      }\n      ],\n      \"stretching\": [\n      {\n      \"exercise_id\": \"Superman\",\n      \"duration\": {\n      \"min\": 6,\n      \"max\": 13\n      },\n      \"unit\": \"times\"\n      },\n      {\n      \"exercise_id\": \"Lower Back Strength\",\n      \"duration\": {\n      \"min\": 38,\n      \"max\": 63\n      },\n      \"unit\": \"times\"\n      },\n      {\n      \"exercise_id\": \"Upper Dog\",\n      \"duration\": {\n      \"min\": 38,\n      \"max\": 75\n      },\n      \"unit\": \"seconds\"\n      },\n      {\n      \"exercise_id\": \"Child's Pose\",\n      \"duration\": {\n      \"min\": 38,\n      \"max\": 75\n      },\n      \"unit\": \"seconds\"\n      },\n      {\n      \"exercise_id\": \"L-sit on the floor\",\n      \"duration\": {\n      \"min\": 38,\n      \"max\": 75\n      },\n      \"unit\": \"seconds\"\n      },\n      {\n      \"exercise_id\": \"Frog stretch\",\n      \"duration\": {\n      \"min\": 38,\n      \"max\": 75\n      },\n      \"unit\": \"seconds\"\n      },\n      {\n      \"exercise_id\": \"Good morning\",\n      \"duration\": {\n      \"min\": 38,\n      \"max\": 75\n      },\n      \"unit\": \"seconds\"\n      },\n      {\n      \"exercise_id\": \"Chest Opener\",\n      \"duration\": {\n      \"min\": 38,\n      \"max\": 75\n      },\n      \"unit\": \"seconds\"\n      },\n      {\n      \"exercise_id\": \"Triceps Stretch\",\n      \"duration\": {\n      \"min\": 38,\n      \"max\": 75\n      },\n      \"unit\": \"seconds\"\n      },\n      {\n      \"exercise_id\": \"Hands Back\",\n      \"duration\": {\n      \"min\": 38,\n      \"max\": 75\n      },\n      \"unit\": \"seconds\"\n      },\n      {\n      \"exercise_id\": \"Shoulder Stretch\",\n      \"duration\": {\n      \"min\": 38,\n      \"max\": 75\n      },\n      \"unit\": \"seconds\"\n      }\n      ]\n      }\n      },\n      \"category\": \"advanced\",\n      \"muscle_groups\": \"3,6,8\",\n      \"created_at\": \"2016-01-14 11:31:41\",\n      \"updated_at\": \"2016-01-15 06:27:40\"\n      },\n      \"urls\": {\n      \"profileImageSmall\": \"http://sandbox.ykings.com/uploads/images/profile/small\",\n      \"profileImageMedium\": \"http://sandbox.ykings.com/uploads/images/profile/medium\",\n      \"profileImageLarge\": \"http://sandbox.ykings.com/uploads/images/profile/large\",\n      \"profileImageOriginal\": \"http://sandbox.ykings.com/uploads/images/profile/original\",\n      \"video\": \"http://sandbox.ykings.com/uploads/videos\",\n      \"videothumbnail\": \"http://sandbox.ykings.com/uploads/images/videothumbnails\",\n      \"feedImageSmall\": \"http://sandbox.ykings.com/uploads/images/feed/small\",\n      \"feedImageMedium\": \"http://sandbox.ykings.com/uploads/images/feed/medium\",\n      \"feedImageLarge\": \"http://sandbox.ykings.com/uploads/images/feed/large\",\n      \"feedImageOriginal\": \"http://sandbox.ykings.com/uploads/images/feed/original\",\n      \"coverImageSmall\": \"http://sandbox.ykings.com/uploads/images/cover_image/small\",\n      \"coverImageMedium\": \"http://sandbox.ykings.com/uploads/images/cover_image/medium\",\n      \"coverImageLarge\": \"http://sandbox.ykings.com/uploads/images/cover_image/large\",\n      \"coverImageOriginal\": \"http://sandbox.ykings.com/uploads/images/cover_image/original\"\n      }\n      }",
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
          "content": "HTTP/1.1 200 OK\n{\n      \"status\": 1,\n      \"message\": \"successfully finished day workouts\"\n      }",
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
          "content": "HTTP/1.1 200 OK\n{\n    \"status\": 1,\n    \"exercise\": {\n        \"id\": \"1\",\n        \"name\": \"Jumping Pullups\",\n        \"description\": \"The jumping pull-up is a challenging full body exercise that targets the back, legs and arms.\",\n        \"category\": \"1\",\n        \"type\": \"1\",\n        \"rewards\": \"6.00\",\n        \"repititions\": \"10\",\n        \"duration\": \"1.00\",\n        \"unit\": \"times\",\n        \"equipment\": \"\",\n        \"video\": [\n            {\n                \"id\": \"1\",\n                \"path\": \"Now1.mp4\",\n                \"videothumbnail\": \"thumbnail3.jpg\",\n                \"description\": \"Test Description\"\n            }\n        ],\n        \"users\": []\n    },\n    \"urls\": {\n        \"profileImageSmall\": \"http://ykings.me/uploads/images/profile/small\",\n        \"profileImageMedium\": \"http://ykings.me/uploads/images/profile/medium\",\n        \"profileImageLarge\": \"http://ykings.me/uploads/images/profile/large\",\n        \"profileImageOriginal\": \"http://ykings.me/uploads/images/profile/original\",\n        \"video\": \"http://ykings.me/uploads/videos\",\n        \"videothumbnail\": \"http://ykings.me/uploads/images/videothumbnails\",\n        \"feedImageSmall\": \"http://ykings.me/uploads/images/feed/small\",\n        \"feedImageMedium\": \"http://ykings.me/uploads/images/feed/medium\",\n        \"feedImageLarge\": \"http://ykings.me/uploads/images/feed/large\",\n        \"feedImageOriginal\": \"http://ykings.me/uploads/images/feed/original\",\n        \"coverImageSmall\": \"http://ykings.me/uploads/images/cover_image/small\",\n        \"coverImageMedium\": \"http://ykings.me/uploads/images/cover_image/medium\",\n        \"coverImageLarge\": \"http://ykings.me/uploads/images/cover_image/large\",\n        \"coverImageOriginal\": \"http://ykings.me/uploads/images/cover_image/original\"\n    }\n}",
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
            "description": "<p>'exercise','workout','motivation','announcement', 'hiit' *required</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>Number</p> ",
            "optional": false,
            "field": "item_id",
            "description": "<p>id of the targetting item *required</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>Number</p> ",
            "optional": true,
            "field": "time_taken",
            "description": "<p>time in seconds</p> "
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
            "description": "<p>in case of workout completion 1-Strength, 2-Cardio Strength</p> "
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
            "description": "<p>1 in case if coach workout</p> "
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
          "content": "    HTTP/1.1 200 OK\n{\n      \"status\": 1,\n      \"success\": \"List\",\n      \"feed_list\": [\n      {\n      \"id\": \"235\",\n      \"user_id\": \"84\",\n      \"item_type\": \"workout\",\n      \"item_id\": \"12\",\n      \"feed_text\": \"Post check\",\n      \"created_at\": \"2016-01-20 06:52:57\",\n      \"updated_at\": \"2016-01-20 06:52:57\",\n      \"clap_count\": 0,\n      \"comment_count\": 0,\n      \"is_commented\": 0,\n      \"is_claped\": 0,\n      \"image\": [],\n      \"category\": \"Cardio-strength\",\n      \"item_name\": \"Forseti\",\n      \"duration\": \"41\",\n      \"intensity\": \"1\",\n      \"profile\": {\n      \"user_id\": \"84\",\n      \"first_name\": \"Aneesh\",\n      \"last_name\": \"ILeaf\",\n      \"image\": \"84_1453206435.jpg\",\n      \"quote\": \"new things\",\n      \"level\": 7\n      }\n      },\n      {\n      \"id\": \"233\",\n      \"user_id\": \"84\",\n      \"item_type\": \"exercise\",\n      \"item_id\": \"2\",\n      \"feed_text\": \"How hard was your Training? what kept you going?\",\n      \"created_at\": \"2016-01-20 04:53:55\",\n      \"updated_at\": \"2016-01-20 04:53:55\",\n      \"clap_count\": 0,\n      \"comment_count\": 0,\n      \"is_commented\": 0,\n      \"is_claped\": 0,\n      \"image\": [],\n      \"category\": \"Lean\",\n      \"item_name\": \"Australian Pullups\",\n      \"duration\": \"8\",\n      \"intensity\": \"1\",\n      \"unit\": \"times\",\n      \"profile\": {\n      \"user_id\": \"84\",\n      \"first_name\": \"Aneesh\",\n      \"last_name\": \"ILeaf\",\n      \"image\": \"84_1453206435.jpg\",\n      \"quote\": \"new things\",\n      \"level\": 7\n      }\n      },\n      {\n      \"id\": \"232\",\n      \"user_id\": \"84\",\n      \"item_type\": \"exercise\",\n      \"item_id\": \"43\",\n      \"feed_text\": \"How hard was your Training? what kept you going?\",\n      \"created_at\": \"2016-01-20 04:53:16\",\n      \"updated_at\": \"2016-01-20 04:53:16\",\n      \"clap_count\": 0,\n      \"comment_count\": 0,\n      \"is_commented\": 0,\n      \"is_claped\": 0,\n      \"image\": [],\n      \"category\": \"Athletic\",\n      \"item_name\": \"Pushups\",\n      \"duration\": \"2\",\n      \"intensity\": \"1\",\n      \"unit\": \"times\",\n      \"profile\": {\n      \"user_id\": \"84\",\n      \"first_name\": \"Aneesh\",\n      \"last_name\": \"ILeaf\",\n      \"image\": \"84_1453206435.jpg\",\n      \"quote\": \"new things\",\n      \"level\": 7\n      }\n      },\n      {\n      \"id\": \"231\",\n      \"user_id\": \"86\",\n      \"item_type\": \"exercise\",\n      \"item_id\": \"43\",\n      \"feed_text\": \"Hai\",\n      \"created_at\": \"2016-01-20 04:37:20\",\n      \"updated_at\": \"2016-01-20 04:37:20\",\n      \"clap_count\": 0,\n      \"comment_count\": 0,\n      \"is_commented\": 0,\n      \"is_claped\": 0,\n      \"image\": [],\n      \"category\": \"Athletic\",\n      \"item_name\": \"Pushups\",\n      \"duration\": \"5\",\n      \"intensity\": \"1\",\n      \"unit\": \"times\",\n      \"profile\": {\n      \"user_id\": \"86\",\n      \"first_name\": \"Vinish\",\n      \"last_name\": \"Tester\",\n      \"image\": \"86_1452668192.jpg\",\n      \"quote\": \"how are you?\",\n      \"level\": 18\n      }\n      },\n      {\n      \"id\": \"230\",\n      \"user_id\": \"86\",\n      \"item_type\": \"exercise\",\n      \"item_id\": \"17\",\n      \"feed_text\": \"Ok\",\n      \"created_at\": \"2016-01-19 13:48:39\",\n      \"updated_at\": \"2016-01-19 13:48:39\",\n      \"clap_count\": 1,\n      \"comment_count\": 0,\n      \"is_commented\": 0,\n      \"is_claped\": 1,\n      \"image\": [],\n      \"category\": \"Lean\",\n      \"item_name\": \"Plank\",\n      \"duration\": \"1\",\n      \"intensity\": \"1\",\n      \"unit\": \"seconds\",\n      \"profile\": {\n      \"user_id\": \"86\",\n      \"first_name\": \"Vinish\",\n      \"last_name\": \"Tester\",\n      \"image\": \"86_1452668192.jpg\",\n      \"quote\": \"how are you?\",\n      \"level\": 18\n      }\n      },\n      {\n      \"id\": \"229\",\n      \"user_id\": \"86\",\n      \"item_type\": \"exercise\",\n      \"item_id\": \"1\",\n      \"feed_text\": \"How hard was your Training? what kept you going?\",\n      \"created_at\": \"2016-01-19 13:48:04\",\n      \"updated_at\": \"2016-01-19 13:48:04\",\n      \"clap_count\": 0,\n      \"comment_count\": 0,\n      \"is_commented\": 0,\n      \"is_claped\": 0,\n      \"image\": [],\n      \"category\": \"Lean\",\n      \"item_name\": \"Jumping Pullups\",\n      \"duration\": \"3\",\n      \"intensity\": \"10\",\n      \"unit\": \"times\",\n      \"profile\": {\n      \"user_id\": \"86\",\n      \"first_name\": \"Vinish\",\n      \"last_name\": \"Tester\",\n      \"image\": \"86_1452668192.jpg\",\n      \"quote\": \"how are you?\",\n      \"level\": 18\n      }\n      },\n      {\n      \"id\": \"228\",\n      \"user_id\": \"86\",\n      \"item_type\": \"exercise\",\n      \"item_id\": \"40\",\n      \"feed_text\": \"How hard was your Training? what kept you going?\",\n      \"created_at\": \"2016-01-19 13:47:35\",\n      \"updated_at\": \"2016-01-19 13:47:35\",\n      \"clap_count\": 0,\n      \"comment_count\": 0,\n      \"is_commented\": 0,\n      \"is_claped\": 0,\n      \"image\": [],\n      \"category\": \"Athletic\",\n      \"item_name\": \"Lunge\",\n      \"duration\": \"3\",\n      \"intensity\": \"1\",\n      \"unit\": \"times\",\n      \"profile\": {\n      \"user_id\": \"86\",\n      \"first_name\": \"Vinish\",\n      \"last_name\": \"Tester\",\n      \"image\": \"86_1452668192.jpg\",\n      \"quote\": \"how are you?\",\n      \"level\": 18\n      }\n      },\n      {\n      \"id\": \"227\",\n      \"user_id\": \"86\",\n      \"item_type\": \"exercise\",\n      \"item_id\": \"2\",\n      \"feed_text\": \"How hard was your Training? what kept you going?\",\n      \"created_at\": \"2016-01-19 13:46:59\",\n      \"updated_at\": \"2016-01-19 13:46:59\",\n      \"clap_count\": 0,\n      \"comment_count\": 0,\n      \"is_commented\": 0,\n      \"is_claped\": 0,\n      \"image\": [],\n      \"category\": \"Lean\",\n      \"item_name\": \"Australian Pullups\",\n      \"duration\": \"2\",\n      \"intensity\": \"1\",\n      \"unit\": \"times\",\n      \"profile\": {\n      \"user_id\": \"86\",\n      \"first_name\": \"Vinish\",\n      \"last_name\": \"Tester\",\n      \"image\": \"86_1452668192.jpg\",\n      \"quote\": \"how are you?\",\n      \"level\": 18\n      }\n      },\n      {\n      \"id\": \"226\",\n      \"user_id\": \"86\",\n      \"item_type\": \"exercise\",\n      \"item_id\": \"43\",\n      \"feed_text\": \"How hard was your Training? what kept you going?\",\n      \"created_at\": \"2016-01-19 13:46:23\",\n      \"updated_at\": \"2016-01-19 13:46:23\",\n      \"clap_count\": 1,\n      \"comment_count\": 0,\n      \"is_commented\": 0,\n      \"is_claped\": 0,\n      \"image\": [],\n      \"category\": \"Athletic\",\n      \"item_name\": \"Pushups\",\n      \"duration\": \"0\",\n      \"intensity\": \"1\",\n      \"unit\": \"times\",\n      \"profile\": {\n      \"user_id\": \"86\",\n      \"first_name\": \"Vinish\",\n      \"last_name\": \"Tester\",\n      \"image\": \"86_1452668192.jpg\",\n      \"quote\": \"how are you?\",\n      \"level\": 18\n      }\n      },\n      {\n      \"id\": \"225\",\n      \"user_id\": \"84\",\n      \"item_type\": \"workout\",\n      \"item_id\": \"2\",\n      \"feed_text\": \"How hard was your Training? what kept you going?\",\n      \"created_at\": \"2016-01-19 13:35:46\",\n      \"updated_at\": \"2016-01-19 13:35:46\",\n      \"clap_count\": 0,\n      \"comment_count\": 0,\n      \"is_commented\": 0,\n      \"is_claped\": 0,\n      \"image\": [],\n      \"category\": \"Cardio-strength\",\n      \"item_name\": \"Borr\",\n      \"duration\": \"5\",\n      \"intensity\": \"1\",\n      \"profile\": {\n      \"user_id\": \"84\",\n      \"first_name\": \"Aneesh\",\n      \"last_name\": \"ILeaf\",\n      \"image\": \"84_1453206435.jpg\",\n      \"quote\": \"new things\",\n      \"level\": 7\n      }\n      }\n      ],\n      \"urls\": {\n      \"profileImageSmall\": \"http://sandbox.ykings.com/uploads/images/profile/small\",\n      \"profileImageMedium\": \"http://sandbox.ykings.com/uploads/images/profile/medium\",\n      \"profileImageLarge\": \"http://sandbox.ykings.com/uploads/images/profile/large\",\n      \"profileImageOriginal\": \"http://sandbox.ykings.com/uploads/images/profile/original\",\n      \"video\": \"http://sandbox.ykings.com/uploads/videos\",\n      \"videothumbnail\": \"http://sandbox.ykings.com/uploads/images/videothumbnails\",\n      \"feedImageSmall\": \"http://sandbox.ykings.com/uploads/images/feed/small\",\n      \"feedImageMedium\": \"http://sandbox.ykings.com/uploads/images/feed/medium\",\n      \"feedImageLarge\": \"http://sandbox.ykings.com/uploads/images/feed/large\",\n      \"feedImageOriginal\": \"http://sandbox.ykings.com/uploads/images/feed/original\",\n      \"coverImageSmall\": \"http://sandbox.ykings.com/uploads/images/cover_image/small\",\n      \"coverImageMedium\": \"http://sandbox.ykings.com/uploads/images/cover_image/medium\",\n      \"coverImageLarge\": \"http://sandbox.ykings.com/uploads/images/cover_image/large\",\n      \"coverImageOriginal\": \"http://sandbox.ykings.com/uploads/images/cover_image/original\"\n      }\n      }",
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
          "content": "    HTTP/1.1 200 OK\n{\n      \"status\": 1,\n      \"success\": \"List\",\n      \"follower_count\": 2,\n      \"level_count\": 0,\n      \"workout_count\": 15,\n      \"feed_list\": [\n      {\n      \"id\": \"45\",\n      \"user_id\": \"96\",\n      \"item_type\": \"hiit\",\n      \"item_id\": \"1\",\n      \"feed_text\": \"Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Integer pulvinar suscipit ante vitae ultricies.\",\n      \"created_at\": \"2016-01-08 06:04:32\",\n      \"updated_at\": \"2016-01-08 06:04:32\",\n      \"clap_count\": 0,\n      \"comment_count\": 0,\n      \"is_commented\": 0,\n      \"is_claped\": 0,\n      \"image\": [\n      {\n      \"id\": \"68\",\n      \"user_id\": \"96\",\n      \"path\": \"96_1452233072.jpg\",\n      \"description\": \"Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Integer pulvinar suscipit ante vitae ultricies.\",\n      \"parent_type\": \"2\",\n      \"parent_id\": \"45\",\n      \"created_at\": \"2016-01-08 06:04:32\",\n      \"updated_at\": \"2016-01-08 06:04:32\"\n      }\n      ],\n      \"item_name\": \"30/30\",\n      \"duration\": \"2250.00\",\n      \"intensity\": \"10\"\n      },\n      {\n      \"id\": \"44\",\n      \"user_id\": \"96\",\n      \"item_type\": \"hiit\",\n      \"item_id\": \"3\",\n      \"feed_text\": \"Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Integer pulvinar suscipit ante vitae ultricies.\",\n      \"created_at\": \"2016-01-08 06:03:48\",\n      \"updated_at\": \"2016-01-08 06:03:48\",\n      \"clap_count\": 0,\n      \"comment_count\": 0,\n      \"is_commented\": 0,\n      \"is_claped\": 0,\n      \"image\": [],\n      \"item_name\": \"60/120\",\n      \"duration\": \"1500.00\",\n      \"intensity\": \"5\"\n      },\n      {\n      \"id\": \"43\",\n      \"user_id\": \"96\",\n      \"item_type\": \"hiit\",\n      \"item_id\": \"3\",\n      \"feed_text\": \"Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Integer pulvinar suscipit ante vitae ultricies.\",\n      \"created_at\": \"2016-01-08 06:03:44\",\n      \"updated_at\": \"2016-01-08 06:03:44\",\n      \"clap_count\": 0,\n      \"comment_count\": 0,\n      \"is_commented\": 0,\n      \"is_claped\": 0,\n      \"image\": [],\n      \"item_name\": \"60/120\",\n      \"duration\": \"1500.00\",\n      \"intensity\": \"4\"\n      },\n      {\n      \"id\": \"42\",\n      \"user_id\": \"96\",\n      \"item_type\": \"hiit\",\n      \"item_id\": \"3\",\n      \"feed_text\": \"Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Integer pulvinar suscipit ante vitae ultricies.\",\n      \"created_at\": \"2016-01-08 06:03:37\",\n      \"updated_at\": \"2016-01-08 06:03:37\",\n      \"clap_count\": 0,\n      \"comment_count\": 0,\n      \"is_commented\": 0,\n      \"is_claped\": 0,\n      \"image\": [],\n      \"item_name\": \"60/120\",\n      \"duration\": \"1500.00\",\n      \"intensity\": \"3\"\n      },\n      {\n      \"id\": \"41\",\n      \"user_id\": \"96\",\n      \"item_type\": \"hiit\",\n      \"item_id\": \"2\",\n      \"feed_text\": \"Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Integer pulvinar suscipit ante vitae ultricies.\",\n      \"created_at\": \"2016-01-08 06:03:27\",\n      \"updated_at\": \"2016-01-08 06:03:27\",\n      \"clap_count\": 0,\n      \"comment_count\": 0,\n      \"is_commented\": 0,\n      \"is_claped\": 0,\n      \"image\": [],\n      \"item_name\": \"20/10\",\n      \"duration\": \"1500.00\",\n      \"intensity\": \"8\"\n      },\n      {\n      \"id\": \"40\",\n      \"user_id\": \"96\",\n      \"item_type\": \"hiit\",\n      \"item_id\": \"2\",\n      \"feed_text\": \"Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Integer pulvinar suscipit ante vitae ultricies.\",\n      \"created_at\": \"2016-01-08 06:03:17\",\n      \"updated_at\": \"2016-01-08 06:03:17\",\n      \"clap_count\": 1,\n      \"comment_count\": 0,\n      \"is_commented\": 0,\n      \"is_claped\": 1,\n      \"image\": [],\n      \"item_name\": \"20/10\",\n      \"duration\": \"1500.00\",\n      \"intensity\": \"5\"\n      },\n      {\n      \"id\": \"39\",\n      \"user_id\": \"96\",\n      \"item_type\": \"hiit\",\n      \"item_id\": \"2\",\n      \"feed_text\": \"Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Integer pulvinar suscipit ante vitae ultricies.\",\n      \"created_at\": \"2016-01-08 06:03:10\",\n      \"updated_at\": \"2016-01-08 06:03:10\",\n      \"clap_count\": 2,\n      \"comment_count\": 0,\n      \"is_commented\": 0,\n      \"is_claped\": 1,\n      \"image\": [],\n      \"item_name\": \"20/10\",\n      \"duration\": \"1500.00\",\n      \"intensity\": \"7\"\n      },\n      {\n      \"id\": \"38\",\n      \"user_id\": \"96\",\n      \"item_type\": \"hiit\",\n      \"item_id\": \"1\",\n      \"feed_text\": \"Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Integer pulvinar suscipit ante vitae ultricies.\",\n      \"created_at\": \"2016-01-08 06:02:50\",\n      \"updated_at\": \"2016-01-08 06:02:50\",\n      \"clap_count\": 0,\n      \"comment_count\": 0,\n      \"is_commented\": 0,\n      \"is_claped\": 0,\n      \"image\": [],\n      \"item_name\": \"30/30\",\n      \"duration\": \"1500.00\",\n      \"intensity\": \"4\"\n      },\n      {\n      \"id\": \"37\",\n      \"user_id\": \"96\",\n      \"item_type\": \"workout\",\n      \"item_id\": \"15\",\n      \"feed_text\": \"Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Integer pulvinar suscipit ante vitae ultricies.\",\n      \"created_at\": \"2016-01-08 05:49:36\",\n      \"updated_at\": \"2016-01-08 05:49:36\",\n      \"clap_count\": 0,\n      \"comment_count\": 0,\n      \"is_commented\": 0,\n      \"is_claped\": 0,\n      \"image\": [\n      {\n      \"id\": \"67\",\n      \"user_id\": \"96\",\n      \"path\": \"96_1452232176.jpg\",\n      \"description\": \"Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Integer pulvinar suscipit ante vitae ultricies.\",\n      \"parent_type\": \"2\",\n      \"parent_id\": \"37\",\n      \"created_at\": \"2016-01-08 05:49:36\",\n      \"updated_at\": \"2016-01-08 05:49:36\"\n      }\n      ],\n      \"category\": \"Cardio-strength\",\n      \"item_name\": \"Mimir\",\n      \"duration\": \"1500\",\n      \"intensity\": \"2\"\n      },\n      {\n      \"id\": \"36\",\n      \"user_id\": \"96\",\n      \"item_type\": \"workout\",\n      \"item_id\": \"9\",\n      \"feed_text\": \"Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Integer pulvinar suscipit ante vitae ultricies.\",\n      \"created_at\": \"2016-01-08 05:49:27\",\n      \"updated_at\": \"2016-01-08 05:49:27\",\n      \"clap_count\": 0,\n      \"comment_count\": 0,\n      \"is_commented\": 0,\n      \"is_claped\": 0,\n      \"image\": [\n      {\n      \"id\": \"66\",\n      \"user_id\": \"96\",\n      \"path\": \"96_1452232167.jpg\",\n      \"description\": \"Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Integer pulvinar suscipit ante vitae ultricies.\",\n      \"parent_type\": \"2\",\n      \"parent_id\": \"36\",\n      \"created_at\": \"2016-01-08 05:49:27\",\n      \"updated_at\": \"2016-01-08 05:49:27\"\n      }\n      ],\n      \"category\": \"Cardio-strength\",\n      \"item_name\": \"Elli\",\n      \"duration\": \"1500\",\n      \"intensity\": \"2\"\n      }\n      ],\n      \"urls\": {\n      \"profileImageSmall\": \"http://sandbox.ykings.com/uploads/images/profile/small\",\n      \"profileImageMedium\": \"http://sandbox.ykings.com/uploads/images/profile/medium\",\n      \"profileImageLarge\": \"http://sandbox.ykings.com/uploads/images/profile/large\",\n      \"profileImageOriginal\": \"http://sandbox.ykings.com/uploads/images/profile/original\",\n      \"video\": \"http://sandbox.ykings.com/uploads/videos\",\n      \"videothumbnail\": \"http://sandbox.ykings.com/uploads/images/videothumbnails\",\n      \"feedImageSmall\": \"http://sandbox.ykings.com/uploads/images/feed/small\",\n      \"feedImageMedium\": \"http://sandbox.ykings.com/uploads/images/feed/medium\",\n      \"feedImageLarge\": \"http://sandbox.ykings.com/uploads/images/feed/large\",\n      \"feedImageOriginal\": \"http://sandbox.ykings.com/uploads/images/feed/original\",\n      \"coverImageSmall\": \"http://sandbox.ykings.com/uploads/images/cover_image/small\",\n      \"coverImageMedium\": \"http://sandbox.ykings.com/uploads/images/cover_image/medium\",\n      \"coverImageLarge\": \"http://sandbox.ykings.com/uploads/images/cover_image/large\",\n      \"coverImageOriginal\": \"http://sandbox.ykings.com/uploads/images/cover_image/original\"\n      }\n      }",
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
          "content": "HTTP/1.1 200 OK\n{\n      \"status\": 1,\n      \"success\": \"Details\",\n      \"feed_details\": [\n      {\n      \"id\": \"1\",\n      \"user_id\": \"1\",\n      \"item_type\": \"workout\",\n      \"item_id\": \"1\",\n      \"feed_text\": \"Testing\",\n      \"created_at\": \"2015-11-01 05:30:00\",\n      \"updated_at\": \"2015-11-23 10:14:16\",\n      \"clap_count\": 1,\n      \"comment_count\": 3,\n      \"is_commented\": 1,\n      \"is_claped\": 0,\n      \"category\": \"Strength\",\n      \"item_name\": \"Baldur\",\n      \"duration\": 0,\n      \"image\": [],\n      \"profile\": {\n      \"user_id\": \"1\",\n      \"first_name\": \"Ykings\",\n      \"last_name\": \"Administrator\",\n      \"image\": \"53_1447764255.jpg\",\n      \"quote\": \"I am Simple\",\n      \"level\": 1\n      }\n      }\n      ],\n      \"urls\": {\n      \"profileImageSmall\": \"http://ykings.me/uploads/images/profile/small\",\n      \"profileImageMedium\": \"http://ykings.me/uploads/images/profile/medium\",\n      \"profileImageLarge\": \"http://ykings.me/uploads/images/profile/large\",\n      \"profileImageOriginal\": \"http://ykings.me/uploads/images/profile/original\",\n      \"video\": \"http://ykings.me/uploads/videos\",\n      \"videothumbnail\": \"http://ykings.me/uploads/images/videothumbnails\",\n      \"feedImageSmall\": \"http://ykings.me/uploads/images/feed/small\",\n      \"feedImageMedium\": \"http://ykings.me/uploads/images/feed/medium\",\n      \"feedImageLarge\": \"http://ykings.me/uploads/images/feed/large\",\n      \"feedImageOriginal\": \"http://ykings.me/uploads/images/feed/original\",\n      \"coverImageSmall\": \"http://ykings.me/uploads/images/cover_image/small\",\n      \"coverImageMedium\": \"http://ykings.me/uploads/images/cover_image/medium\",\n      \"coverImageLarge\": \"http://ykings.me/uploads/images/cover_image/large\",\n      \"coverImageOriginal\": \"http://ykings.me/uploads/images/cover_image/original\"\n      }\n      }",
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
    "type": "get",
    "url": "/authenticate",
    "title": "Get JW token",
    "name": "Athenticate",
    "group": "General",
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
          "content": "HTTP/1.1 200 OK\n{\n      \"status\": 1,\n      \"notifications\": [\n      {\n      \"id\": \"1\",\n      \"user_id\": \"41\",\n      \"friend_id\": \"28\",\n      \"message_type\": \"clap\",\n      \"type_id\": \"1\",\n      \"message\": \"claped feed\",\n      \"read\": \"0\",\n      \"created_at\": \"2015-12-31 00:00:00\",\n      \"updated_at\": \"2016-01-01 11:02:43\",\n      \"image\": \"28_1448283791.jpg\"\n      },\n      {\n      \"id\": \"2\",\n      \"user_id\": \"41\",\n      \"friend_id\": \"2\",\n      \"message_type\": \"clap\",\n      \"type_id\": \"1\",\n      \"message\": \"claped feed\",\n      \"read\": \"0\",\n      \"created_at\": \"2015-12-31 00:00:00\",\n      \"updated_at\": \"2016-01-01 11:02:45\",\n      \"image\": \"\"\n      }\n      ],\n      \"urls\": {\n      \"profileImageSmall\": \"http://ykings.me/uploads/images/profile/small\",\n      \"profileImageMedium\": \"http://ykings.me/uploads/images/profile/medium\",\n      \"profileImageLarge\": \"http://ykings.me/uploads/images/profile/large\",\n      \"profileImageOriginal\": \"http://ykings.me/uploads/images/profile/original\",\n      \"video\": \"http://ykings.me/uploads/videos\",\n      \"videothumbnail\": \"http://ykings.me/uploads/images/videothumbnails\",\n      \"feedImageSmall\": \"http://ykings.me/uploads/images/feed/small\",\n      \"feedImageMedium\": \"http://ykings.me/uploads/images/feed/medium\",\n      \"feedImageLarge\": \"http://ykings.me/uploads/images/feed/large\",\n      \"feedImageOriginal\": \"http://ykings.me/uploads/images/feed/original\",\n      \"coverImageSmall\": \"http://ykings.me/uploads/images/cover_image/small\",\n      \"coverImageMedium\": \"http://ykings.me/uploads/images/cover_image/medium\",\n      \"coverImageLarge\": \"http://ykings.me/uploads/images/cover_image/large\",\n      \"coverImageOriginal\": \"http://ykings.me/uploads/images/cover_image/original\"\n      }\n      }",
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
          "content": "HTTP/1.1 200 OK\n     {\n                \"status\": 1,\n                \"success\": \"Successfully Updated\"\n            }",
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
          "content": "HTTP/1.1 200 OK\n{\n      \"status\": 1,\n      \"skills\": [\n      {\n      \"id\": \"21\",\n      \"progression_id\": \"2\",\n      \"level\": \"1\",\n      \"row\": \"1\",\n      \"substitute\": \"0\",\n      \"exercise_id\": \"5\",\n      \"created_at\": \"2015-12-14 03:04:45\",\n      \"updated_at\": \"2015-12-15 05:48:46\",\n      \"isLocked\": 0,\n      \"isLockable\": 0,\n      \"isUnlockable\": 1,\n      \"exercise\": {\n      \"id\": \"5\",\n      \"name\": \"Side Trizeps\",\n      \"description\": \"\",\n      \"category\": \"1\",\n      \"type\": \"1\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"30.00\",\n      \"unit\": \"times\",\n      \"equipment\": \"\"\n      }\n      },\n      {\n      \"id\": \"22\",\n      \"progression_id\": \"2\",\n      \"level\": \"2\",\n      \"row\": \"1\",\n      \"substitute\": \"57\",\n      \"exercise_id\": \"36\",\n      \"created_at\": \"2015-12-14 03:04:45\",\n      \"updated_at\": \"2015-12-15 05:48:46\",\n      \"isLocked\": 1,\n      \"isLockable\": 0,\n      \"isUnlockable\": 1,\n      \"exercise\": {\n      \"id\": \"36\",\n      \"name\": \"Dips (Bench)\",\n      \"description\": \"\",\n      \"category\": \"2\",\n      \"type\": \"1\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"1.00\",\n      \"unit\": \"times\",\n      \"equipment\": \"\"\n      }\n      },\n      {\n      \"id\": \"23\",\n      \"progression_id\": \"2\",\n      \"level\": \"3\",\n      \"row\": \"1\",\n      \"substitute\": \"36\",\n      \"exercise_id\": \"57\",\n      \"created_at\": \"2015-12-14 03:04:45\",\n      \"updated_at\": \"2015-12-15 05:48:46\",\n      \"isLocked\": 1,\n      \"isLockable\": 0,\n      \"isUnlockable\": 1,\n      \"exercise\": {\n      \"id\": \"57\",\n      \"name\": \"Elevated Dips\",\n      \"description\": \"\",\n      \"category\": \"2\",\n      \"type\": \"1\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"1.00\",\n      \"unit\": \"times\",\n      \"equipment\": \"\"\n      }\n      },\n      {\n      \"id\": \"24\",\n      \"progression_id\": \"2\",\n      \"level\": \"4\",\n      \"row\": \"1\",\n      \"substitute\": \"0\",\n      \"exercise_id\": \"70\",\n      \"created_at\": \"2015-12-14 03:04:45\",\n      \"updated_at\": \"2015-12-15 05:48:46\",\n      \"isLocked\": 1,\n      \"isLockable\": 0,\n      \"isUnlockable\": 0,\n      \"exercise\": {\n      \"id\": \"70\",\n      \"name\": \"Dips\",\n      \"description\": \"\",\n      \"category\": \"3\",\n      \"type\": \"1\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"1.00\",\n      \"unit\": \"times\",\n      \"equipment\": \"\"\n      }\n      }\n      ],\n      \"is_subscribed\": 0,\n      \"urls\": {\n      \"profileImageSmall\": \"http://sandbox.ykings.com/uploads/images/profile/small\",\n      \"profileImageMedium\": \"http://sandbox.ykings.com/uploads/images/profile/medium\",\n      \"profileImageLarge\": \"http://sandbox.ykings.com/uploads/images/profile/large\",\n      \"profileImageOriginal\": \"http://sandbox.ykings.com/uploads/images/profile/original\",\n      \"video\": \"http://sandbox.ykings.com/uploads/videos\",\n      \"videothumbnail\": \"http://sandbox.ykings.com/uploads/images/videothumbnails\",\n      \"feedImageSmall\": \"http://sandbox.ykings.com/uploads/images/feed/small\",\n      \"feedImageMedium\": \"http://sandbox.ykings.com/uploads/images/feed/medium\",\n      \"feedImageLarge\": \"http://sandbox.ykings.com/uploads/images/feed/large\",\n      \"feedImageOriginal\": \"http://sandbox.ykings.com/uploads/images/feed/original\",\n      \"coverImageSmall\": \"http://sandbox.ykings.com/uploads/images/cover_image/small\",\n      \"coverImageMedium\": \"http://sandbox.ykings.com/uploads/images/cover_image/medium\",\n      \"coverImageLarge\": \"http://sandbox.ykings.com/uploads/images/cover_image/large\",\n      \"coverImageOriginal\": \"http://sandbox.ykings.com/uploads/images/cover_image/original\"\n      }\n      }",
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
          "content": "HTTP/1.1 200 OK\n{\n          \"status\": 1,\n          \"message\": \"successfully locked the skill\",\n          \"skills\": [\n            {\n              \"id\": \"11\",\n              \"progression_id\": \"1\",\n              \"level\": \"1\",\n              \"row\": \"3\",\n              \"substitute\": \"23\",\n              \"exercise_id\": \"3\",\n              \"created_at\": \"2015-12-14 03:04:45\",\n              \"updated_at\": \"2015-12-15 05:48:46\",\n              \"isLocked\": 0,\n              \"isLockable\": 0,\n              \"isUnlockable\": 0,\n              \"exercise\": {\n                \"id\": \"3\",\n                \"name\": \"Knee Raises\",\n                \"description\": \"Standing Knee Raises (also known as standing knee crunches and standing knee pulls) is a functional abdominal exercise for boosting strength throughout the core. Unlike standard ab exercises, they don’t isolate abdominal muscles. Instead they work your upper abs and lower abs in conjunction with other important muscles such as hips, back and shoulders.\",\n                \"category\": \"1\",\n                \"type\": \"2\",\n                \"rewards\": \"6.00\",\n                \"repititions\": \"10\",\n                \"duration\": \"1.00\",\n                \"unit\": \"times\",\n                \"equipment\": \"\"\n              }\n            },\n            {\n              \"id\": \"12\",\n              \"progression_id\": \"1\",\n              \"level\": \"2\",\n              \"row\": \"3\",\n              \"substitute\": \"0\",\n              \"exercise_id\": \"23\",\n              \"created_at\": \"2015-12-14 03:04:45\",\n              \"updated_at\": \"2016-01-04 10:24:35\",\n              \"isLocked\": 1,\n              \"isLockable\": 0,\n              \"isUnlockable\": 1,\n              \"exercise\": {\n                \"id\": \"23\",\n                \"name\": \"Leg Raises\",\n                \"description\": \"\",\n                \"category\": \"1\",\n                \"type\": \"2\",\n                \"rewards\": \"6.00\",\n                \"repititions\": \"10\",\n                \"duration\": \"1.00\",\n                \"unit\": \"times\",\n                \"equipment\": \"\"\n              }\n            },\n            {\n              \"id\": \"13\",\n              \"progression_id\": \"1\",\n              \"level\": \"3\",\n              \"row\": \"3\",\n              \"substitute\": \"55\",\n              \"exercise_id\": \"34\",\n              \"created_at\": \"2015-12-14 03:04:45\",\n              \"updated_at\": \"2015-12-15 05:48:46\",\n              \"isLocked\": 1,\n              \"isLockable\": 0,\n              \"isUnlockable\": 0,\n              \"exercise\": {\n                \"id\": \"34\",\n                \"name\": \"L-Sit\",\n                \"description\": \"\",\n                \"category\": \"2\",\n                \"type\": \"2\",\n                \"rewards\": \"6.00\",\n                \"repititions\": \"10\",\n                \"duration\": \"1.00\",\n                \"unit\": \"times\",\n                \"equipment\": \"\"\n              }\n            },\n            {\n              \"id\": \"14\",\n              \"progression_id\": \"1\",\n              \"level\": \"4\",\n              \"row\": \"3\",\n              \"substitute\": \"0\",\n              \"exercise_id\": \"55\",\n              \"created_at\": \"2015-12-14 03:04:45\",\n              \"updated_at\": \"2016-01-04 10:24:44\",\n              \"isLocked\": 1,\n              \"isLockable\": 0,\n              \"isUnlockable\": 0,\n              \"exercise\": {\n                \"id\": \"55\",\n                \"name\": \"L-Sit Pullup\",\n                \"description\": \"\",\n                \"category\": \"2\",\n                \"type\": \"2\",\n                \"rewards\": \"6.00\",\n                \"repititions\": \"10\",\n                \"duration\": \"1.00\",\n                \"unit\": \"times\",\n                \"equipment\": \"\"\n              }\n            },\n            {\n              \"id\": \"15\",\n              \"progression_id\": \"1\",\n              \"level\": \"5\",\n              \"row\": \"3\",\n              \"substitute\": \"0\",\n              \"exercise_id\": \"78\",\n              \"created_at\": \"2015-12-14 03:04:45\",\n              \"updated_at\": \"2015-12-15 05:48:46\",\n              \"isLocked\": 1,\n              \"isLockable\": 0,\n              \"isUnlockable\": 0,\n              \"exercise\": {\n                \"id\": \"78\",\n                \"name\": \"Pullover\",\n                \"description\": \"\",\n                \"category\": \"3\",\n                \"type\": \"2\",\n                \"rewards\": \"10.00\",\n                \"repititions\": \"10\",\n                \"duration\": \"1.00\",\n                \"unit\": \"times\",\n                \"equipment\": \"\"\n              }\n            }\n          ],\n          \"is_subscribed\": 0,\n          \"urls\": {\n            \"profileImageSmall\": \"http://sandbox.ykings.com/uploads/images/profile/small\",\n            \"profileImageMedium\": \"http://sandbox.ykings.com/uploads/images/profile/medium\",\n            \"profileImageLarge\": \"http://sandbox.ykings.com/uploads/images/profile/large\",\n            \"profileImageOriginal\": \"http://sandbox.ykings.com/uploads/images/profile/original\",\n            \"video\": \"http://sandbox.ykings.com/uploads/videos\",\n            \"videothumbnail\": \"http://sandbox.ykings.com/uploads/images/videothumbnails\",\n            \"feedImageSmall\": \"http://sandbox.ykings.com/uploads/images/feed/small\",\n            \"feedImageMedium\": \"http://sandbox.ykings.com/uploads/images/feed/medium\",\n            \"feedImageLarge\": \"http://sandbox.ykings.com/uploads/images/feed/large\",\n            \"feedImageOriginal\": \"http://sandbox.ykings.com/uploads/images/feed/original\",\n            \"coverImageSmall\": \"http://sandbox.ykings.com/uploads/images/cover_image/small\",\n            \"coverImageMedium\": \"http://sandbox.ykings.com/uploads/images/cover_image/medium\",\n            \"coverImageLarge\": \"http://sandbox.ykings.com/uploads/images/cover_image/large\",\n            \"coverImageOriginal\": \"http://sandbox.ykings.com/uploads/images/cover_image/original\"\n          }\n        }",
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
          "content": "HTTP/1.1 200 OK\n{\n          \"status\": 1,\n          \"message\": \"successfully unlocked the skill\",\n          \"skills\": [\n            {\n              \"id\": \"11\",\n              \"progression_id\": \"1\",\n              \"level\": \"1\",\n              \"row\": \"3\",\n              \"substitute\": \"23\",\n              \"exercise_id\": \"3\",\n              \"created_at\": \"2015-12-14 03:04:45\",\n              \"updated_at\": \"2015-12-15 05:48:46\",\n              \"isLocked\": 0,\n              \"isLockable\": 0,\n              \"isUnlockable\": 0,\n              \"exercise\": {\n                \"id\": \"3\",\n                \"name\": \"Knee Raises\",\n                \"description\": \"Standing Knee Raises (also known as standing knee crunches and standing knee pulls) is a functional abdominal exercise for boosting strength throughout the core. Unlike standard ab exercises, they don’t isolate abdominal muscles. Instead they work your upper abs and lower abs in conjunction with other important muscles such as hips, back and shoulders.\",\n                \"category\": \"1\",\n                \"type\": \"2\",\n                \"rewards\": \"6.00\",\n                \"repititions\": \"10\",\n                \"duration\": \"1.00\",\n                \"unit\": \"times\",\n                \"equipment\": \"\"\n              }\n            },\n            {\n              \"id\": \"12\",\n              \"progression_id\": \"1\",\n              \"level\": \"2\",\n              \"row\": \"3\",\n              \"substitute\": \"0\",\n              \"exercise_id\": \"23\",\n              \"created_at\": \"2015-12-14 03:04:45\",\n              \"updated_at\": \"2016-01-04 10:24:35\",\n              \"isLocked\": 1,\n              \"isLockable\": 0,\n              \"isUnlockable\": 1,\n              \"exercise\": {\n                \"id\": \"23\",\n                \"name\": \"Leg Raises\",\n                \"description\": \"\",\n                \"category\": \"1\",\n                \"type\": \"2\",\n                \"rewards\": \"6.00\",\n                \"repititions\": \"10\",\n                \"duration\": \"1.00\",\n                \"unit\": \"times\",\n                \"equipment\": \"\"\n              }\n            },\n            {\n              \"id\": \"13\",\n              \"progression_id\": \"1\",\n              \"level\": \"3\",\n              \"row\": \"3\",\n              \"substitute\": \"55\",\n              \"exercise_id\": \"34\",\n              \"created_at\": \"2015-12-14 03:04:45\",\n              \"updated_at\": \"2015-12-15 05:48:46\",\n              \"isLocked\": 1,\n              \"isLockable\": 0,\n              \"isUnlockable\": 0,\n              \"exercise\": {\n                \"id\": \"34\",\n                \"name\": \"L-Sit\",\n                \"description\": \"\",\n                \"category\": \"2\",\n                \"type\": \"2\",\n                \"rewards\": \"6.00\",\n                \"repititions\": \"10\",\n                \"duration\": \"1.00\",\n                \"unit\": \"times\",\n                \"equipment\": \"\"\n              }\n            },\n            {\n              \"id\": \"14\",\n              \"progression_id\": \"1\",\n              \"level\": \"4\",\n              \"row\": \"3\",\n              \"substitute\": \"0\",\n              \"exercise_id\": \"55\",\n              \"created_at\": \"2015-12-14 03:04:45\",\n              \"updated_at\": \"2016-01-04 10:24:44\",\n              \"isLocked\": 1,\n              \"isLockable\": 0,\n              \"isUnlockable\": 0,\n              \"exercise\": {\n                \"id\": \"55\",\n                \"name\": \"L-Sit Pullup\",\n                \"description\": \"\",\n                \"category\": \"2\",\n                \"type\": \"2\",\n                \"rewards\": \"6.00\",\n                \"repititions\": \"10\",\n                \"duration\": \"1.00\",\n                \"unit\": \"times\",\n                \"equipment\": \"\"\n              }\n            },\n            {\n              \"id\": \"15\",\n              \"progression_id\": \"1\",\n              \"level\": \"5\",\n              \"row\": \"3\",\n              \"substitute\": \"0\",\n              \"exercise_id\": \"78\",\n              \"created_at\": \"2015-12-14 03:04:45\",\n              \"updated_at\": \"2015-12-15 05:48:46\",\n              \"isLocked\": 0,\n              \"isLockable\": 1,\n              \"isUnlockable\": 0,\n              \"exercise\": {\n                \"id\": \"78\",\n                \"name\": \"Pullover\",\n                \"description\": \"\",\n                \"category\": \"3\",\n                \"type\": \"2\",\n                \"rewards\": \"10.00\",\n                \"repititions\": \"10\",\n                \"duration\": \"1.00\",\n                \"unit\": \"times\",\n                \"equipment\": \"\"\n              }\n            }\n          ],\n          \"is_subscribed\": 0,\n          \"urls\": {\n            \"profileImageSmall\": \"http://sandbox.ykings.com/uploads/images/profile/small\",\n            \"profileImageMedium\": \"http://sandbox.ykings.com/uploads/images/profile/medium\",\n            \"profileImageLarge\": \"http://sandbox.ykings.com/uploads/images/profile/large\",\n            \"profileImageOriginal\": \"http://sandbox.ykings.com/uploads/images/profile/original\",\n            \"video\": \"http://sandbox.ykings.com/uploads/videos\",\n            \"videothumbnail\": \"http://sandbox.ykings.com/uploads/images/videothumbnails\",\n            \"feedImageSmall\": \"http://sandbox.ykings.com/uploads/images/feed/small\",\n            \"feedImageMedium\": \"http://sandbox.ykings.com/uploads/images/feed/medium\",\n            \"feedImageLarge\": \"http://sandbox.ykings.com/uploads/images/feed/large\",\n            \"feedImageOriginal\": \"http://sandbox.ykings.com/uploads/images/feed/original\",\n            \"coverImageSmall\": \"http://sandbox.ykings.com/uploads/images/cover_image/small\",\n            \"coverImageMedium\": \"http://sandbox.ykings.com/uploads/images/cover_image/medium\",\n            \"coverImageLarge\": \"http://sandbox.ykings.com/uploads/images/cover_image/large\",\n            \"coverImageOriginal\": \"http://sandbox.ykings.com/uploads/images/cover_image/original\"\n          }\n        }",
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
            "field": "error",
            "description": "<p>Message token_invalid.</p> "
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
          "content": "HTTP/1.1 422 Validation error\n{\n  \"error\": \"could_not_create_user\"\n}",
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
            "field": "error",
            "description": "<p>Message token_invalid.</p> "
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
          "content": "HTTP/1.1 422 Validation error\n{\n  \"error\": \"could_not_create_user\"\n}",
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
          "content": "HTTP/1.1 200 OK\n      {\n            \"status\": 1,\n            \"message\": \"Subscription Updated\"\n      }",
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
            "description": "<p>user id of the user 1-Male, 2-Female</p> "
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
            "description": "<p>spot</p> "
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
          "content": "HTTP/1.1 200 OK\n  {\n      \"status\" : 1,\n      \"success\": \"successfully_updated_user_profile\",\n      \"token\": \"eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOiIyIiwiaXNzIjoiaHR0cDpcL1wvbG9jYWxob3N0OjgwMDBcL2FwaVwvdXNlclwvbG9naW4iLCJpYXQiOiIxNDQ3MjQ2NTc1IiwiZXhwIjoiMTQ0NzYwNjU3NSIsIm5iZiI6IjE0NDcyNDY1NzUiLCJqdGkiOiI2ZTBlN2JlMDI5YTJjZTVkODM4MzkwY2EyZmE0MGNkMSJ9.lFwueZXytFQhLcfX6GZ1fwp5wmtPT1GenTZpx3p2jKQ\",\n      \"user\": {\n          \"id\": \"2\",\n          \"email\": \"aneeshk@cubettech.com\",\n          \"confirmation_code\": \"d6grRYINWtcDH18bXc358M9ZDDFExd\",\n          \"status\": \"1\",\n          \"created_at\": \"2015-11-11 11:40:04\",\n          \"updated_at\": \"2015-11-11 11:40:04\",\n          \"profile\": {\n              \"id\": \"2\",\n              \"user_id\": \"2\",\n              \"first_name\": \"Aneesh\",\n              \"last_name\": \"Kallikkattil\",\n              \"gender\": 0,\n              \"fitness_status\": 0,\n              \"goal\": 0,\n              \"image\": \"2_1447242011.jpg\",\n              \"city\": \"\",\n              \"state\": \"\",\n              \"country\": \"\",\n  \"spot\": \"\",\n              \"quote\": \"\",\n              \"created_at\": \"2015-11-11 11:40:10\",\n              \"updated_at\": \"2015-11-11 11:40:11\"\n          },\n          \"videos\": [\n              {\n                  \"id\": \"2\",\n                  \"user_id\": \"2\",\n                  \"video_id\": \"1\",\n                  \"created_at\": \"2015-11-11 11:40:05\",\n                  \"updated_at\": \"2015-11-11 11:40:05\",\n                  \"video\": {\n                      \"id\": \"1\",\n                      \"user_id\": \"1\",\n                      \"path\": \"Now1.mp4\",\n                      \"description\": \"Test Description\",\n                      \"parent_type\": \"1\",\n                      \"type\": \"1\",\n                      \"parent_id\": \"1\",\n                      \"created_at\": \"2015-11-11 07:26:40\",\n                      \"updated_at\": \"2015-11-11 17:43:27\"\n                  }\n              }\n          ]\n      },\n      \"urls\": {\n          \"profileImageSmall\": \"http://sandbox.ykings.com/uploads/images/profile/small\",\n          \"profileImageMedium\": \"http://sandbox.ykings.com/uploads/images/profile/medium\",\n          \"profileImageLarge\": \"http://sandbox.ykings.com/uploads/images/profile/large\",\n          \"profileImageOriginal\": \"http://sandbox.ykings.com/uploads/images/profile/original\",\n          \"video\": \"http://sandbox.ykings.com/uploads/videos\",\n          \"feedImageSmall\": \"http://sandbox.ykings.com/uploads/images/feed/small\",\n          \"feedImageMedium\": \"http://sandbox.ykings.com/uploads/images/feed/medium\",\n          \"feedImageLarge\": \"http://sandbox.ykings.com/uploads/images/feed/large\",\n          \"feedImageOriginal\": \"http://sandbox.ykings.com/uploads/images/feed/original\"\n      }\n  }",
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
            "field": "could_not_create_user",
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
          "content": "HTTP/1.1 400 Validation error\n{\n  \"status\" : 0,\n  \"error\": \"The password field is required.\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 400 Validation error\n{\n  \"status\" : 0,\n  \"error\": \"The first_name field is required\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 400 Validation error\n{\n  \"status\" : 0,\n  \"error\": \"The last_name field is required\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 422 This email already signed up with us.\n{\n  \"status\" : 0,\n  \"error\": \"This email already signed up with us.\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 500 could_not_create_user\n{\n  \"status\" : 0,\n  \"error\": \"could_not_create_user\"\n}",
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
          "content": "HTTP/1.1 200 OK\n{\n      \"status\": 1,\n      \"success\": \"user_details\",\n      \"user\": {\n      \"id\": \"2\",\n      \"email\": \"aneeshk@cubettech.com\",\n      \"confirmation_code\": \"\",\n      \"status\": \"1\",\n      \"created_at\": \"2015-11-09 09:14:02\",\n      \"updated_at\": \"2015-11-16 06:45:17\",\n      \"is_subscribed\": 0,\n      \"profile\": [\n      {\n      \"id\": \"2\",\n      \"user_id\": \"2\",\n      \"first_name\": \"Aneesh\",\n      \"last_name\": \"Kallikkattil\",\n      \"gender\": \"1\",\n      \"fitness_status\": \"3\",\n      \"goal\": \"3\",\n      \"image\": \"\",\n      \"cover_image\": \"\",\n      \"city\": \"\",\n      \"state\": \"\",\n      \"country\": \"\",\n      \"spot\": \"\",\n      \"quote\": \"I want to get Strong\",\n      \"facebook\": 0,\n      \"twitter\": 0,\n      \"instagram\": 0,\n      \"created_at\": \"2015-11-09 09:14:02\",\n      \"updated_at\": \"2015-11-09 10:16:07\",\n      \"level\": 3\n      }\n      ],\n      \"settings\": [\n      {\n      \"id\": \"2\",\n      \"user_id\": \"2\",\n      \"key\": \"notification\",\n      \"value\": \"{\\\"comments\\\":\\\"1\\\",\\\"claps\\\":\\\"1\\\",\\\"follow\\\":\\\"1\\\",\\\"my_performance\\\":\\\"1\\\",\\\"motivation_knowledge\\\":\\\"1\\\"} \",\n      \"created_at\": \"2015-11-20 00:00:00\",\n      \"updated_at\": \"2015-12-03 06:35:31\"\n      },\n      {\n      \"id\": \"3\",\n      \"user_id\": \"2\",\n      \"key\": \"subscription\",\n      \"value\": \"1\",\n      \"created_at\": \"2015-11-20 00:00:00\",\n      \"updated_at\": \"2015-11-20 06:33:27\"\n      }\n      ],\n      \"is_following\": 0,\n      \"follower_count\": 0,\n      \"workout_count\": 4,\n      \"level\": 3,\n      \"points\": 330,\n      \"points_to_next_level\": 170,\n      \"total_skills\": 6,\n      \"user_skills_count\": 2,\n      \"athlete_since\": \"2015-11-09 09:14:02\",\n      \"facebook_connected\": 0\n      },\n      \"urls\": {\n      \"profileImageSmall\": \"http://sandbox.ykings.com/uploads/images/profile/small\",\n      \"profileImageMedium\": \"http://sandbox.ykings.com/uploads/images/profile/medium\",\n      \"profileImageLarge\": \"http://sandbox.ykings.com/uploads/images/profile/large\",\n      \"profileImageOriginal\": \"http://sandbox.ykings.com/uploads/images/profile/original\",\n      \"video\": \"http://sandbox.ykings.com/uploads/videos\",\n      \"videothumbnail\": \"http://sandbox.ykings.com/uploads/images/videothumbnails\",\n      \"feedImageSmall\": \"http://sandbox.ykings.com/uploads/images/feed/small\",\n      \"feedImageMedium\": \"http://sandbox.ykings.com/uploads/images/feed/medium\",\n      \"feedImageLarge\": \"http://sandbox.ykings.com/uploads/images/feed/large\",\n      \"feedImageOriginal\": \"http://sandbox.ykings.com/uploads/images/feed/original\",\n      \"coverImageSmall\": \"http://sandbox.ykings.com/uploads/images/cover_image/small\",\n      \"coverImageMedium\": \"http://sandbox.ykings.com/uploads/images/cover_image/medium\",\n      \"coverImageLarge\": \"http://sandbox.ykings.com/uploads/images/cover_image/large\",\n      \"coverImageOriginal\": \"http://sandbox.ykings.com/uploads/images/cover_image/original\"\n      }\n      }",
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
          "content": "HTTP/1.1 200 OK\n{\n      \"status\": 1,\n      \"success\": \"successfully_logged_in\",\n      \"token\": \"eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOiI0MSIsImlzcyI6Imh0dHA6XC9cL3lraW5ncy5tZVwvYXBpXC91c2VyXC9sb2dpbiIsImlhdCI6IjE0NDk2NjMwMTMiLCJleHAiOiIxNDUzMjYzMDEzIiwibmJmIjoiMTQ0OTY2MzAxMyIsImp0aSI6IjlmYmZhNDE1ODMzZGEzMDkyNzdkMDg3MWMyMmQ1NWQyIn0.pcjqabawygOzEvd3TliSIIAwWAG5gDJstABHWK_0D2c\",\n      \"user\": {\n      \"id\": \"41\",\n      \"email\": \"arun@ileafsolutions.net\",\n      \"confirmation_code\": \"\",\n      \"status\": \"1\",\n      \"created_at\": \"2015-11-16 15:24:09\",\n      \"updated_at\": \"2015-11-16 16:32:47\",\n      \"is_subscribed\": 0,\n      \"profile\": [\n      {\n      \"id\": \"31\",\n      \"user_id\": \"41\",\n      \"first_name\": \"arun\",\n      \"last_name\": \"mg\",\n      \"gender\": \"1\",\n      \"fitness_status\": \"3\",\n      \"goal\": \"1\",\n      \"image\": \"41_1449060497.jpg\",\n      \"cover_image\": \"\",\n      \"city\": \"\",\n      \"state\": \"\",\n      \"country\": \"\",\n      \"spot\": \"\",\n      \"quote\": \"\",\n      \"instagram\": 0,\n      \"twitter\": 0,\n      \"facebook\": 0,\n      \"fb\": 0,\n      \"created_at\": \"2015-11-16 15:24:09\",\n      \"updated_at\": \"2015-12-02 18:18:17\",\n      \"level\": 1\n      }\n      ],\n      \"settings\": [\n      {\n      \"id\": \"22\",\n      \"user_id\": \"41\",\n      \"key\": \"subscription\",\n      \"value\": \"1\",\n      \"created_at\": \"2015-12-03 09:52:37\",\n      \"updated_at\": \"2015-12-03 11:54:07\"\n      },\n      {\n      \"id\": \"23\",\n      \"user_id\": \"41\",\n      \"key\": \"notification\",\n      \"value\": \"{\\\"comments\\\":\\\"1\\\",\\\"claps\\\":\\\"1\\\",\\\"follow\\\":\\\"1\\\",\\\"my_performance\\\":\\\"1\\\",\\\"motivation_knowledge\\\":\\\"1\\\"} \",\n      \"created_at\": \"2015-12-03 09:52:37\",\n      \"updated_at\": \"2015-12-03 12:05:31\"\n      }\n      ],\n      \"follower_count\": 3,\n      \"workout_count\": 0,\n      \"points\": 0,\n      \"level\": 1,\n      \"facebook_connected\": 0\n      },\n      \"urls\": {\n      \"profileImageSmall\": \"http://ykings.me/uploads/images/profile/small\",\n      \"profileImageMedium\": \"http://ykings.me/uploads/images/profile/medium\",\n      \"profileImageLarge\": \"http://ykings.me/uploads/images/profile/large\",\n      \"profileImageOriginal\": \"http://ykings.me/uploads/images/profile/original\",\n      \"video\": \"http://ykings.me/uploads/videos\",\n      \"videothumbnail\": \"http://ykings.me/uploads/images/videothumbnails\",\n      \"feedImageSmall\": \"http://ykings.me/uploads/images/feed/small\",\n      \"feedImageMedium\": \"http://ykings.me/uploads/images/feed/medium\",\n      \"feedImageLarge\": \"http://ykings.me/uploads/images/feed/large\",\n      \"feedImageOriginal\": \"http://ykings.me/uploads/images/feed/original\",\n      \"coverImageSmall\": \"http://ykings.me/uploads/images/cover_image/small\",\n      \"coverImageMedium\": \"http://ykings.me/uploads/images/cover_image/medium\",\n      \"coverImageLarge\": \"http://ykings.me/uploads/images/cover_image/large\",\n      \"coverImageOriginal\": \"http://ykings.me/uploads/images/cover_image/original\"\n      }\n      }",
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
          "content": "HTTP/1.1 400 Bad Request\n{\n \"status\" : 0,\n  \"error\": \"token_not_provided\"\n}",
          "type": "json"
        },
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
          "content": "HTTP/1.1 200 OK\n      {\n          \"status\" : 1,\n          \"success\": \"successfully_updated_user_profile\",\n          \"token\": \"eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOiIyIiwiaXNzIjoiaHR0cDpcL1wvbG9jYWxob3N0OjgwMDBcL2FwaVwvdXNlclwvbG9naW4iLCJpYXQiOiIxNDQ3MjQ2NTc1IiwiZXhwIjoiMTQ0NzYwNjU3NSIsIm5iZiI6IjE0NDcyNDY1NzUiLCJqdGkiOiI2ZTBlN2JlMDI5YTJjZTVkODM4MzkwY2EyZmE0MGNkMSJ9.lFwueZXytFQhLcfX6GZ1fwp5wmtPT1GenTZpx3p2jKQ\",\n          \"user\": {\n              \"id\": \"2\",\n              \"email\": \"aneeshk@cubettech.com\",\n              \"confirmation_code\": \"d6grRYINWtcDH18bXc358M9ZDDFExd\",\n              \"status\": \"1\",\n              \"created_at\": \"2015-11-11 11:40:04\",\n              \"updated_at\": \"2015-11-11 11:40:04\",\n              \"profile\": {\n                  \"id\": \"2\",\n                  \"user_id\": \"2\",\n                  \"first_name\": \"Aneesh\",\n                  \"last_name\": \"Kallikkattil\",\n                  \"gender\": 0,\n                  \"fitness_status\": 0,\n                  \"goal\": 0,\n                  \"image\": \"2_1447242011.jpg\",\n                  \"cover_image\": \"\",\n                  \"city\": \"\",\n                  \"state\": \"\",\n                  \"country\": \"\",\n                  \"spot\": \"\",\n                  \"twitter\": \"\",\n                  \"facebook\": \"\",\n                  \"instagram\": \"\",\n                  \"quote\": \"\",\n                  \"created_at\": \"2015-11-11 11:40:10\",\n                  \"updated_at\": \"2015-11-11 11:40:11\"\n              },\n              \"videos\": [\n                  {\n                      \"id\": \"2\",\n                      \"user_id\": \"2\",\n                      \"video_id\": \"1\",\n                      \"created_at\": \"2015-11-11 11:40:05\",\n                      \"updated_at\": \"2015-11-11 11:40:05\",\n                      \"video\": {\n                          \"id\": \"1\",\n                          \"user_id\": \"1\",\n                          \"path\": \"Now1.mp4\",\n                          \"description\": \"Test Description\",\n                          \"parent_type\": \"1\",\n                          \"type\": \"1\",\n                          \"parent_id\": \"1\",\n                          \"created_at\": \"2015-11-11 07:26:40\",\n                          \"updated_at\": \"2015-11-11 17:43:27\"\n                      }\n                  }\n              ]\n          },\n           \"urls\": {\n      \"profileImageSmall\": \"http://sandbox.ykings.com/uploads/images/profile/small\",\n      \"profileImageMedium\": \"http://sandbox.ykings.com/uploads/images/profile/medium\",\n      \"profileImageLarge\": \"http://sandbox.ykings.com/uploads/images/profile/large\",\n      \"profileImageOriginal\": \"http://sandbox.ykings.com/uploads/images/profile/original\",\n      \"video\": \"http://sandbox.ykings.com/uploads/videos\",\n      \"videothumbnail\": \"http://sandbox.ykings.com/uploads/images/videothumbnails\",\n      \"feedImageSmall\": \"http://sandbox.ykings.com/uploads/images/feed/small\",\n      \"feedImageMedium\": \"http://sandbox.ykings.com/uploads/images/feed/medium\",\n      \"feedImageLarge\": \"http://sandbox.ykings.com/uploads/images/feed/large\",\n      \"feedImageOriginal\": \"http://sandbox.ykings.com/uploads/images/feed/original\",\n      \"coverImageSmall\": \"http://sandbox.ykings.com/uploads/images/cover_image/small\",\n      \"coverImageMedium\": \"http://sandbox.ykings.com/uploads/images/cover_image/medium\",\n      \"coverImageLarge\": \"http://sandbox.ykings.com/uploads/images/cover_image/large\",\n      \"coverImageOriginal\": \"http://sandbox.ykings.com/uploads/images/cover_image/original\"\n      }\n      }",
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
          "content": "HTTP/1.1 200 OK\n{\n      \"status\": 1,\n      \"success\": \"user_selected_goals\",\n      \"skill_levels\": {\n      \"1\": {\n      \"id\": \"5\",\n      \"description\": \"\",\n      \"progression_id\": \"1\",\n      \"level\": \"5\",\n      \"row\": \"1\",\n      \"substitute\": \"0\",\n      \"exercise_id\": \"69\",\n      \"created_at\": \"2015-12-14 03:04:45\",\n      \"updated_at\": \"2015-12-15 05:48:46\",\n      \"exercise\": {\n      \"id\": \"69\",\n      \"name\": \"Muscleups\",\n      \"description\": \"\",\n      \"category\": \"3\",\n      \"type\": \"1\",\n      \"muscle_groups\": \"0\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"1\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \"\",\n      \"video_tips\": \"\",\n      \"pro_tips\": \"\",\n      \"video\": [\n      {\n      \"id\": \"69\",\n      \"path\": \"Now69.mp4\",\n      \"videothumbnail\": \"thumbnail3.jpg\",\n      \"description\": \"Test Description\"\n      }\n      ]\n      },\n      \"is_selected\": 1\n      },\n      \"2\": {\n      \"id\": \"10\",\n      \"description\": \"\",\n      \"progression_id\": \"1\",\n      \"level\": \"5\",\n      \"row\": \"2\",\n      \"substitute\": \"0\",\n      \"exercise_id\": \"77\",\n      \"created_at\": \"2015-12-14 03:04:45\",\n      \"updated_at\": \"2015-12-15 05:48:46\",\n      \"exercise\": {\n      \"id\": \"77\",\n      \"name\": \"Front Lever\",\n      \"description\": \"\",\n      \"category\": \"3\",\n      \"type\": \"2\",\n      \"muscle_groups\": \"0\",\n      \"rewards\": \"10.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"seconds\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \"\",\n      \"video_tips\": \"\",\n      \"pro_tips\": \"\",\n      \"video\": [\n      {\n      \"id\": \"78\",\n      \"path\": \"Now78.mp4\",\n      \"videothumbnail\": \"thumbnail2.png\",\n      \"description\": \"Test Description\"\n      }\n      ]\n      },\n      \"is_selected\": 0\n      },\n      \"3\": {\n      \"id\": \"15\",\n      \"description\": \"\",\n      \"progression_id\": \"1\",\n      \"level\": \"5\",\n      \"row\": \"3\",\n      \"substitute\": \"0\",\n      \"exercise_id\": \"78\",\n      \"created_at\": \"2015-12-14 03:04:45\",\n      \"updated_at\": \"2015-12-15 05:48:46\",\n      \"exercise\": {\n      \"id\": \"78\",\n      \"name\": \"Pullover\",\n      \"description\": \"\",\n      \"category\": \"3\",\n      \"type\": \"2\",\n      \"muscle_groups\": \"0\",\n      \"rewards\": \"10.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"1\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \"\",\n      \"video_tips\": \"\",\n      \"pro_tips\": \"\",\n      \"video\": [\n      {\n      \"id\": \"79\",\n      \"path\": \"Now79.mp4\",\n      \"videothumbnail\": \"thumbnail3.jpg\",\n      \"description\": \"Test Description\"\n      }\n      ]\n      },\n      \"is_selected\": 1\n      },\n      \"4\": {\n      \"id\": \"20\",\n      \"description\": \"\",\n      \"progression_id\": \"1\",\n      \"level\": \"5\",\n      \"row\": \"4\",\n      \"substitute\": \"0\",\n      \"exercise_id\": \"79\",\n      \"created_at\": \"2015-12-14 03:04:45\",\n      \"updated_at\": \"2015-12-15 05:48:46\",\n      \"exercise\": {\n      \"id\": \"79\",\n      \"name\": \"Back Lever\",\n      \"description\": \"\",\n      \"category\": \"3\",\n      \"type\": \"2\",\n      \"muscle_groups\": \"0\",\n      \"rewards\": \"10.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"seconds\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \"\",\n      \"video_tips\": \"\",\n      \"pro_tips\": \"\",\n      \"video\": [\n      {\n      \"id\": \"80\",\n      \"path\": \"Now80.mp4\",\n      \"videothumbnail\": \"thumbnail1.png\",\n      \"description\": \"Test Description\"\n      }\n      ]\n      },\n      \"is_selected\": 1\n      }\n      }\n      }",
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
            "type": "<p>integer</p> ",
            "optional": false,
            "field": "progression_id",
            "description": "<p>id of Progression *required</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>String</p> ",
            "optional": false,
            "field": "selected_goals",
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
          "content": "HTTP/1.1 200 OK\n{\n      \"status\": 1,\n      \"success\": \"updated_user_goals\",\n      \"skill_levels\": {\n      \"1\": {\n      \"id\": \"5\",\n      \"description\": \"\",\n      \"progression_id\": \"1\",\n      \"level\": \"5\",\n      \"row\": \"1\",\n      \"substitute\": \"0\",\n      \"exercise_id\": \"69\",\n      \"created_at\": \"2015-12-14 03:04:45\",\n      \"updated_at\": \"2015-12-15 05:48:46\",\n      \"exercise\": {\n      \"id\": \"69\",\n      \"name\": \"Muscleups\",\n      \"description\": \"\",\n      \"category\": \"3\",\n      \"type\": \"1\",\n      \"muscle_groups\": \"0\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"1\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \"\",\n      \"video_tips\": \"\",\n      \"pro_tips\": \"\",\n      \"video\": [\n      {\n      \"id\": \"69\",\n      \"path\": \"Now69.mp4\",\n      \"videothumbnail\": \"thumbnail3.jpg\",\n      \"description\": \"Test Description\"\n      }\n      ]\n      },\n      \"is_selected\": 1\n      },\n      \"2\": {\n      \"id\": \"10\",\n      \"description\": \"\",\n      \"progression_id\": \"1\",\n      \"level\": \"5\",\n      \"row\": \"2\",\n      \"substitute\": \"0\",\n      \"exercise_id\": \"77\",\n      \"created_at\": \"2015-12-14 03:04:45\",\n      \"updated_at\": \"2015-12-15 05:48:46\",\n      \"exercise\": {\n      \"id\": \"77\",\n      \"name\": \"Front Lever\",\n      \"description\": \"\",\n      \"category\": \"3\",\n      \"type\": \"2\",\n      \"muscle_groups\": \"0\",\n      \"rewards\": \"10.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"seconds\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \"\",\n      \"video_tips\": \"\",\n      \"pro_tips\": \"\",\n      \"video\": [\n      {\n      \"id\": \"78\",\n      \"path\": \"Now78.mp4\",\n      \"videothumbnail\": \"thumbnail2.png\",\n      \"description\": \"Test Description\"\n      }\n      ]\n      },\n      \"is_selected\": 0\n      },\n      \"3\": {\n      \"id\": \"15\",\n      \"description\": \"\",\n      \"progression_id\": \"1\",\n      \"level\": \"5\",\n      \"row\": \"3\",\n      \"substitute\": \"0\",\n      \"exercise_id\": \"78\",\n      \"created_at\": \"2015-12-14 03:04:45\",\n      \"updated_at\": \"2015-12-15 05:48:46\",\n      \"exercise\": {\n      \"id\": \"78\",\n      \"name\": \"Pullover\",\n      \"description\": \"\",\n      \"category\": \"3\",\n      \"type\": \"2\",\n      \"muscle_groups\": \"0\",\n      \"rewards\": \"10.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"1\",\n      \"unit\": \"times\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \"\",\n      \"video_tips\": \"\",\n      \"pro_tips\": \"\",\n      \"video\": [\n      {\n      \"id\": \"79\",\n      \"path\": \"Now79.mp4\",\n      \"videothumbnail\": \"thumbnail3.jpg\",\n      \"description\": \"Test Description\"\n      }\n      ]\n      },\n      \"is_selected\": 0\n      },\n      \"4\": {\n      \"id\": \"20\",\n      \"description\": \"\",\n      \"progression_id\": \"1\",\n      \"level\": \"5\",\n      \"row\": \"4\",\n      \"substitute\": \"0\",\n      \"exercise_id\": \"79\",\n      \"created_at\": \"2015-12-14 03:04:45\",\n      \"updated_at\": \"2015-12-15 05:48:46\",\n      \"exercise\": {\n      \"id\": \"79\",\n      \"name\": \"Back Lever\",\n      \"description\": \"\",\n      \"category\": \"3\",\n      \"type\": \"2\",\n      \"muscle_groups\": \"0\",\n      \"rewards\": \"10.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"10\",\n      \"unit\": \"seconds\",\n      \"equipment\": \"\",\n      \"range_of_motion\": \"\",\n      \"video_tips\": \"\",\n      \"pro_tips\": \"\",\n      \"video\": [\n      {\n      \"id\": \"80\",\n      \"path\": \"Now80.mp4\",\n      \"videothumbnail\": \"thumbnail1.png\",\n      \"description\": \"Test Description\"\n      }\n      ]\n      },\n      \"is_selected\": 1\n      }\n      }\n      }",
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
            "description": "<p>comma seperated ids of each muscle group *required</p> "
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
          "content": "HTTP/1.1 200 OK\n{\n      \"status\": 1,\n      \"is_subscribed\": 0,\n      \"workout\": {\n      \"id\": \"2\",\n      \"name\": \"Borr\",\n      \"description\": \"Borr Borr Borr\",\n      \"rounds\": \"3\",\n      \"category\": \"2\",\n      \"type\": \"1\",\n      \"rewards\": 330,\n      \"duration\": \"19.00\",\n      \"equipments\": \"BAR\",\n      \"lean\": {\n      \"featured\": [],\n      \"following\": []\n      },\n      \"athletic\": {\n      \"featured\": [\n      {\n      \"id\": \"1\",\n      \"workout_id\": \"2\",\n      \"user_id\": \"2\",\n      \"status\": \"1\",\n      \"time\": \"33\",\n      \"is_starred\": \"0\",\n      \"created_at\": \"2015-11-20 10:34:13\",\n      \"updated_at\": \"2015-11-20 10:34:13\",\n      \"category\": \"2\",\n      \"profile\": {\n      \"id\": \"2\",\n      \"user_id\": \"2\",\n      \"first_name\": \"Aneesh\",\n      \"last_name\": \"Kallikkattil\",\n      \"gender\": \"1\",\n      \"fitness_status\": \"3\",\n      \"goal\": \"3\",\n      \"image\": \"\",\n      \"cover_image\": \"\",\n      \"city\": \"\",\n      \"state\": \"\",\n      \"country\": \"\",\n      \"spot\": \"\",\n      \"quote\": \"I want to get Strong\",\n      \"instagram\": \"0\",\n      \"twitter\": \"0\",\n      \"facebook\": \"0\",\n      \"fb\": \"0\",\n      \"created_at\": \"2015-11-09 14:44:02\",\n      \"updated_at\": \"2015-12-03 07:26:43\",\n      \"level\": 3\n      }\n      }\n      ],\n      \"following\": []\n      },\n      \"strength\": {\n      \"featured\": [],\n      \"following\": []\n      }\n      },\n      \"urls\": {\n      \"profileImageSmall\": \"http://ykings.me/uploads/images/profile/small\",\n      \"profileImageMedium\": \"http://ykings.me/uploads/images/profile/medium\",\n      \"profileImageLarge\": \"http://ykings.me/uploads/images/profile/large\",\n      \"profileImageOriginal\": \"http://ykings.me/uploads/images/profile/original\",\n      \"video\": \"http://ykings.me/uploads/videos\",\n      \"videothumbnail\": \"http://ykings.me/uploads/images/videothumbnails\",\n      \"feedImageSmall\": \"http://ykings.me/uploads/images/feed/small\",\n      \"feedImageMedium\": \"http://ykings.me/uploads/images/feed/medium\",\n      \"feedImageLarge\": \"http://ykings.me/uploads/images/feed/large\",\n      \"feedImageOriginal\": \"http://ykings.me/uploads/images/feed/original\",\n      \"coverImageSmall\": \"http://ykings.me/uploads/images/cover_image/small\",\n      \"coverImageMedium\": \"http://ykings.me/uploads/images/cover_image/medium\",\n      \"coverImageLarge\": \"http://ykings.me/uploads/images/cover_image/large\",\n      \"coverImageOriginal\": \"http://ykings.me/uploads/images/cover_image/original\"\n      }\n      }",
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