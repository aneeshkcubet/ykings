define({ "api": [
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
            "description": "<p>Id of exercise</p> "
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
            "description": "<p>Id of exercise</p> "
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
    "url": "/workout/list",
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
            "description": "<p>Id of user</p> "
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
          "content": "HTTP/1.1 200 OK\n{\n      \"status\": 1,\n      \"exercises\": {\n      \"beginer\": [\n      {\n      \"id\": \"1\",\n      \"name\": \"Jumping Pullups\",\n      \"description\": \"The jumping pull-up is a challenging full body exercise that targets the back, legs and arms.\",\n      \"category\": \"1\",\n      \"type\": \"1\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"1.00\",\n      \"equipment\": \"\",\n      \"created_at\": \"2015-11-17 13:30:19\",\n      \"updated_at\": \"2015-11-17 13:30:19\",\n      \"video\": [\n      {\n      \"id\": \"1\",\n      \"user_id\": \"1\",\n      \"path\": \"Now1.mp4\",\n      \"description\": \"Test Description\",\n      \"parent_type\": \"1\",\n      \"type\": \"1\",\n      \"parent_id\": \"1\",\n      \"created_at\": \"2015-11-11 07:26:40\",\n      \"updated_at\": \"2015-11-11 17:43:27\"\n      }\n      ]\n      }\n      ],\n      \"advanced\": [\n      {\n      \"id\": \"1\",\n      \"name\": \"Jumping Pullups\",\n      \"description\": \"The jumping pull-up is a challenging full body exercise that targets the back, legs and arms.\",\n      \"category\": \"1\",\n      \"type\": \"1\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"1.00\",\n      \"equipment\": \"\",\n      \"created_at\": \"2015-11-17 13:30:19\",\n      \"updated_at\": \"2015-11-17 13:30:19\",\n      \"video\": [\n      {\n      \"id\": \"1\",\n      \"user_id\": \"1\",\n      \"path\": \"Now1.mp4\",\n      \"description\": \"Test Description\",\n      \"parent_type\": \"1\",\n      \"type\": \"1\",\n      \"parent_id\": \"1\",\n      \"created_at\": \"2015-11-11 07:26:40\",\n      \"updated_at\": \"2015-11-11 17:43:27\"\n      }\n      ]\n      }\n      ],\n      \"professional\": [\n      {\n      \"id\": \"1\",\n      \"name\": \"Jumping Pullups\",\n      \"description\": \"The jumping pull-up is a challenging full body exercise that targets the back, legs and arms.\",\n      \"category\": \"1\",\n      \"type\": \"1\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"1.00\",\n      \"equipment\": \"\",\n      \"created_at\": \"2015-11-17 13:30:19\",\n      \"updated_at\": \"2015-11-17 13:30:19\",\n      \"video\": [\n      {\n      \"id\": \"1\",\n      \"user_id\": \"1\",\n      \"path\": \"Now1.mp4\",\n      \"description\": \"Test Description\",\n      \"parent_type\": \"1\",\n      \"type\": \"1\",\n      \"parent_id\": \"1\",\n      \"created_at\": \"2015-11-11 07:26:40\",\n      \"updated_at\": \"2015-11-11 17:43:27\"\n      }\n      ]\n      }\n      ]\n      }\n\n      }",
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
            "description": "<p>'excercise','workout','motivation','announcement' *required</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>String</p> ",
            "optional": false,
            "field": "item_id",
            "description": "<p>id of the targetting item *required</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>String</p> ",
            "optional": false,
            "field": "time_taken",
            "description": "<p>time in seconds</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>String</p> ",
            "optional": false,
            "field": "rewards",
            "description": "<p>points earned by doing activity</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>String</p> ",
            "optional": false,
            "field": "category",
            "description": "<p>in case of workout completion</p> "
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
          "content": "HTTP/1.1 422 Validation error\n{\n  \"status\" : 0,\n  \"error\": \"feed_created_but_we_accept_only_jpeg_gif_png_files_as_profile_images\"\n}",
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
            "description": "<p>Id of user</p> "
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
          "content": "    HTTP/1.1 200 OK\n{\n      \"status\": 1,\n      \"success\": \"List\",\n      \"feed_list\": [\n      {\n      \"id\": \"38\",\n      \"user_id\": \"11\",\n      \"item_type\": \"workout\",\n      \"item_id\": \"1\",\n      \"feed_text\": \"testttttttttt\",\n      \"created_at\": \"2015-11-11 11:53:35\",\n      \"updated_at\": \"2015-11-11 11:53:35\",\n      \"clap_count\": 0,\n      \"comment_count\": 0,\n      \"is_commented\": 0,\n      \"is_claped\": 0,\n      \"image\": [\n      {\n      \"id\": \"6\",\n      \"user_id\": \"11\",\n      \"path\": \"11_1447242815.jpg\",\n      \"description\": \"testttttttttt\",\n      \"parent_type\": \"2\",\n      \"parent_id\": \"38\",\n      \"created_at\": \"2015-11-11 11:53:35\",\n      \"updated_at\": \"2015-11-11 11:53:35\"\n      }\n      ],\n      \"profile\": {\n      \"user_id\": \"11\",\n      \"first_name\": \"ansa\",\n      \"last_name\": \"v\",\n      \"image\": \"11_1447237788.jpg\"\n      }\n      },\n      {\n      \"id\": \"37\",\n      \"user_id\": \"11\",\n      \"item_type\": \"workout\",\n      \"item_id\": \"1\",\n      \"feed_text\": \"testttttttttt\",\n      \"created_at\": \"2015-11-11 11:46:28\",\n      \"updated_at\": \"2015-11-11 11:46:28\",\n      \"clap_count\": 0,\n      \"comment_count\": 0,\n      \"is_commented\": 0,\n      \"is_claped\": 0,\n      \"image\": [\n      {\n      \"id\": \"5\",\n      \"user_id\": \"11\",\n      \"path\": \"11_1447242388.jpg\",\n      \"description\": \"testttttttttt\",\n      \"parent_type\": \"2\",\n      \"parent_id\": \"37\",\n      \"created_at\": \"2015-11-11 11:46:28\",\n      \"updated_at\": \"2015-11-11 11:46:28\"\n      }\n      ],\n      \"profile\": {\n      \"user_id\": \"11\",\n      \"first_name\": \"ansa\",\n      \"last_name\": \"v\",\n      \"image\": \"11_1447237788.jpg\"\n      }\n      }\n      ],\n      \"urls\": {\n      \"profileImageSmall\": \"http://ykings.me/uploads/images/profile/small\",\n      \"profileImageMedium\": \"http://ykings.me/uploads/images/profile/medium\",\n      \"profileImageLarge\": \"http://ykings.me/uploads/images/profile/large\",\n      \"profileImageOriginal\": \"http://ykings.me/uploads/images/profile/original\",\n      \"video\": \"http://ykings.me/uploads/videos\",\n      \"feedImageSmall\": \"http://ykings.me/uploads/images/feed/small\",\n      \"feedImageMedium\": \"http://ykings.me/uploads/images/feed/medium\",\n      \"feedImageLarge\": \"http://ykings.me/uploads/images/feed/large\",\n      \"feedImageOriginal\": \"http://ykings.me/uploads/images/feed/original\"\n      }\n      }",
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
            "type": "<p>Number</p> ",
            "optional": false,
            "field": "user_id",
            "description": "<p>Id of user</p> "
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
          "content": "    HTTP/1.1 200 OK\n{\n      \"status\": 1,\n      \"success\": \"List\",\n      \"feed_list\": [\n      {\n      \"id\": \"38\",\n      \"user_id\": \"11\",\n      \"item_type\": \"workout\",\n      \"item_id\": \"1\",\n      \"feed_text\": \"testttttttttt\",\n      \"created_at\": \"2015-11-11 11:53:35\",\n      \"updated_at\": \"2015-11-11 11:53:35\",\n      \"clap_count\": 0,\n      \"comment_count\": 0,\n      \"is_commented\": 0,\n      \"is_claped\": 0,\n      \"image\": [\n      {\n      \"id\": \"6\",\n      \"user_id\": \"11\",\n      \"path\": \"11_1447242815.jpg\",\n      \"description\": \"testttttttttt\",\n      \"parent_type\": \"2\",\n      \"parent_id\": \"38\",\n      \"created_at\": \"2015-11-11 11:53:35\",\n      \"updated_at\": \"2015-11-11 11:53:35\"\n      }\n      ],\n      \"profile\": {\n      \"user_id\": \"11\",\n      \"first_name\": \"ansa\",\n      \"last_name\": \"v\",\n      \"image\": \"11_1447237788.jpg\"\n      }\n      },\n      {\n      \"id\": \"37\",\n      \"user_id\": \"11\",\n      \"item_type\": \"workout\",\n      \"item_id\": \"1\",\n      \"feed_text\": \"testttttttttt\",\n      \"created_at\": \"2015-11-11 11:46:28\",\n      \"updated_at\": \"2015-11-11 11:46:28\",\n      \"clap_count\": 0,\n      \"comment_count\": 0,\n      \"is_commented\": 0,\n      \"is_claped\": 0,\n      \"image\": [\n      {\n      \"id\": \"5\",\n      \"user_id\": \"11\",\n      \"path\": \"11_1447242388.jpg\",\n      \"description\": \"testttttttttt\",\n      \"parent_type\": \"2\",\n      \"parent_id\": \"37\",\n      \"created_at\": \"2015-11-11 11:46:28\",\n      \"updated_at\": \"2015-11-11 11:46:28\"\n      }\n      ],\n      \"profile\": {\n      \"user_id\": \"11\",\n      \"first_name\": \"ansa\",\n      \"last_name\": \"v\",\n      \"image\": \"11_1447237788.jpg\"\n      }\n      }\n      ],\n      \"urls\": {\n      \"profileImageSmall\": \"http://ykings.me/uploads/images/profile/small\",\n      \"profileImageMedium\": \"http://ykings.me/uploads/images/profile/medium\",\n      \"profileImageLarge\": \"http://ykings.me/uploads/images/profile/large\",\n      \"profileImageOriginal\": \"http://ykings.me/uploads/images/profile/original\",\n      \"video\": \"http://ykings.me/uploads/videos\",\n      \"feedImageSmall\": \"http://ykings.me/uploads/images/feed/small\",\n      \"feedImageMedium\": \"http://ykings.me/uploads/images/feed/medium\",\n      \"feedImageLarge\": \"http://ykings.me/uploads/images/feed/large\",\n      \"feedImageOriginal\": \"http://ykings.me/uploads/images/feed/original\"\n      }\n      }",
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
            "description": "<p>Id of user</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>Number</p> ",
            "optional": false,
            "field": "feed_id",
            "description": "<p>feed_id</p> "
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
            "description": "<p>Id of user</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>Number</p> ",
            "optional": false,
            "field": "comment_id",
            "description": "<p>feed_id</p> "
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
    "title": "",
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
            "description": "<p>Id of user</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>Number</p> ",
            "optional": false,
            "field": "feed_id",
            "description": "<p>feed_id</p> "
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
          "content": "HTTP/1.1 200 OK\n{\n      \"status\": 1,\n      \"success\": \"Details\",\n      \"feed_details\": [\n      {\n      \"id\": \"21\",\n      \"user_id\": \"14\",\n      \"item_type\": \"excercise\",\n      \"item_id\": \"1\",\n      \"feed_text\": \"testttttttttt\",\n      \"created_at\": \"2015-11-11 06:27:51\",\n      \"updated_at\": \"2015-11-11 06:27:51\",\n      \"clap_count\": 0,\n      \"comment_count\": 0,\n      \"is_commented\": 0,\n      \"is_claped\": 0,\n      \"profile\": {\n      \"user_id\": \"14\",\n      \"first_name\": \"sachii\",\n      \"last_name\": \"k\",\n      \"image\": null\n      }\n      }\n      ],\n      \"urls\": {\n      \"profileImageSmall\": \"http://ykings.me/uploads/images/profile/small\",\n      \"profileImageMedium\": \"http://ykings.me/uploads/images/profile/medium\",\n      \"profileImageLarge\": \"http://ykings.me/uploads/images/profile/large\",\n      \"profileImageOriginal\": \"http://ykings.me/uploads/images/profile/original\",\n      \"video\": \"http://ykings.me/uploads/videos\",\n      \"videothumbnail\": \"http://ykings.me/uploads/images/videothumbnails\",\n      \"feedImageSmall\": \"http://ykings.me/uploads/images/feed/small\",\n      \"feedImageMedium\": \"http://ykings.me/uploads/images/feed/medium\",\n      \"feedImageLarge\": \"http://ykings.me/uploads/images/feed/large\",\n      \"feedImageOriginal\": \"http://ykings.me/uploads/images/feed/original\"\n      }\n      }",
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
            "description": "<p>Id of user</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>Number</p> ",
            "optional": false,
            "field": "feed_id",
            "description": "<p>feed_id</p> "
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
          "content": "HTTP/1.1 200 OK\n      {\n      \"status\": 1,\n      \"comments\": [\n      {\n      \"id\": \"1\",\n      \"user_id\": \"14\",\n      \"parent_type\": \"feed\",\n      \"parent_id\": \"15\",\n      \"comment_text\": \"This is a sample comment\",\n      \"created_at\": \"2015-11-16 13:53:47\",\n      \"updated_at\": \"2015-11-17 13:01:09\",\n      \"profile\": {\n      \"user_id\": \"14\",\n      \"first_name\": \"sachii\",\n      \"last_name\": \"k\",\n      \"image\": null\n      }\n      },\n      {\n      \"id\": \"2\",\n      \"user_id\": \"11\",\n      \"parent_type\": \"feed\",\n      \"parent_id\": \"15\",\n      \"comment_text\": \"This is another comment\",\n      \"created_at\": \"2015-11-16 13:55:14\",\n      \"updated_at\": \"2015-11-17 13:02:38\",\n      \"profile\": {\n      \"user_id\": \"11\",\n      \"first_name\": \"ansa\",\n      \"last_name\": \"v\",\n      \"image\": \"11_1447237788.jpg\"\n      }\n      }\n      ],\n      \"urls\": {\n      \"profileImageSmall\": \"http://ykings.me/uploads/images/profile/small\",\n      \"profileImageMedium\": \"http://ykings.me/uploads/images/profile/medium\",\n      \"profileImageLarge\": \"http://ykings.me/uploads/images/profile/large\",\n      \"profileImageOriginal\": \"http://ykings.me/uploads/images/profile/original\",\n      \"video\": \"http://ykings.me/uploads/videos\",\n      \"feedImageSmall\": \"http://ykings.me/uploads/images/feed/small\",\n      \"feedImageMedium\": \"http://ykings.me/uploads/images/feed/medium\",\n      \"feedImageLarge\": \"http://ykings.me/uploads/images/feed/large\",\n      \"feedImageOriginal\": \"http://ykings.me/uploads/images/feed/original\"\n      }\n      }",
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
            "description": "<p>Id of user</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>Number</p> ",
            "optional": false,
            "field": "feed_id",
            "description": "<p>feed_id</p> "
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
          "content": "HTTP/1.1 200 OK\n      {\n          \"status\": 1,\n          \"success\": \"successfully_followed\",\n          \"user\": {\n              \"id\": \"5\",\n              \"email\": \"ykings3@yopmail.com\",\n              \"confirmation_code\": \"\",\n              \"status\": \"1\",\n              \"created_at\": \"2015-11-12 08:49:55\",\n              \"updated_at\": \"2015-11-12 08:49:55\",\n              \"profile\": {\n                  \"id\": \"5\",\n                  \"user_id\": \"5\",\n                  \"first_name\": \"Ykings\",\n                  \"last_name\": \"test3\",\n                  \"gender\": \"0\",\n                  \"fitness_status\": \"2\",\n                  \"goal\": \"2\",\n                  \"image\": \"5_1447318201.jpg\",\n                  \"city\": \"Kochi\",\n                  \"state\": \"Kerala\",\n                  \"country\": \"India\",\n                  \"quote\": \"I need to get strong!!!!\",\n                  \"created_at\": \"2015-11-12 08:50:01\",\n                  \"updated_at\": \"2015-11-12 08:50:01\"\n              }\n          },\n          \"followers\": [],\n          \"followings\": [{\n                  \"id\": \"3\",\n                  \"user_id\": \"5\",\n                  \"follow_id\": \"2\",\n                  \"created_at\": \"2015-11-12 11:43:59\",\n                  \"updated_at\": \"2015-11-12 11:43:59\",\n                  \"follow_profile\": {\n                      \"id\": \"2\",\n                      \"email\": \"aneeshk@cubettech.com\",\n                      \"confirmation_code\": \"\",\n                      \"status\": \"1\",\n                      \"created_at\": \"2015-11-12 08:44:54\",\n                      \"updated_at\": \"2015-11-12 08:44:54\",\n                      \"profile\": {\n                      \"id\": \"2\",\n                      \"user_id\": \"2\",\n                      \"first_name\": \"Aneesh\",\n                      \"last_name\": \"Kallikkattil\",\n                      \"gender\": \"0\",\n                      \"fitness_status\": \"3\",\n                      \"goal\": \"3\",\n                      \"image\": \"2_1447317902.jpg\",\n                      \"city\": \"Kochi\",\n                      \"state\": \"Kerala\",\n                      \"country\": \"India\",\n                      \"quote\": \"I need to get strong!!!!\",\n                      \"created_at\": \"2015-11-12 08:45:02\",\n                      \"updated_at\": \"2015-11-12 08:45:02\"\n                  }\n              }\n          }]\n      },\n      \"urls\": {\n              \"profileImageSmall\": \"http://sandbox.ykings.com/uploads/images/profile/small\",\n              \"profileImageMedium\": \"http://sandbox.ykings.com/uploads/images/profile/medium\",\n              \"profileImageLarge\": \"http://sandbox.ykings.com/uploads/images/profile/large\",\n              \"profileImageOriginal\": \"http://sandbox.ykings.com/uploads/images/profile/original\",\n              \"video\": \"http://sandbox.ykings.com/uploads/videos\",\n              \"feedImageSmall\": \"http://sandbox.ykings.com/uploads/images/feed/small\",\n              \"feedImageMedium\": \"http://sandbox.ykings.com/uploads/images/feed/medium\",\n              \"feedImageLarge\": \"http://sandbox.ykings.com/uploads/images/feed/large\",\n              \"feedImageOriginal\": \"http://sandbox.ykings.com/uploads/images/feed/original\"\n          }\n      }",
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
          "content": "HTTP/1.1 401 Unauthorised\n{\n  \"status\": 0,\n  \"error\": \"token_expired\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 400 Bad Request\n{\n  \"status\": 0,\n  \"error\": \"token_not_provided\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 422 validation_errors\n{\n  \"status\": 0,\n  \"error\":  \"The follower_id field is required.\"        \n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 422 validation_errors\n{\n  \"status\": 0,\n  \"error\":  \"The following_id field is required.\"        \n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 422 follower_user_does_not_exists\n{\n      \"status\": 0,\n      \"error\": \"follower_user_does_not_exists\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 422 following_user_does_not_exists\n{\n      \"status\": 0,\n      \"error\": \"following_user_does_not_exists\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 422 follower_user_not_verified_email\n{\n      \"status\": 0,\n      \"error\": \"follower_user_not_verified_email\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 422 following_user_not_verified_email\n{\n      \"status\": 0,\n      \"error\": \"following_user_not_verified_email\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 422 you_are_already_followed\n{\n      \"status\": 0,\n      \"error\": \"you_are_already_followed\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 422 could_not_able_to_follow\n{\n      \"status\": 0,\n      \"error\": \"could_not_able_to_follow\"\n}",
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
          "content": "HTTP/1.1 200 OK\n      {\n          \"status\": 1,\n          \"success\": \"user_followers\",\n          \"user\": {\n              \"id\": \"2\",\n              \"email\": \"aneeshk@cubettech.com\",\n              \"confirmation_code\": \"\",\n              \"status\": \"1\",\n              \"created_at\": \"2015-11-12 08:44:54\",\n              \"updated_at\": \"2015-11-12 08:44:54\",\n              \"profile\": {\n                  \"id\": \"2\",\n                  \"user_id\": \"2\",\n                  \"first_name\": \"Aneesh\",\n                  \"last_name\": \"Kallikkattil\",\n                  \"gender\": \"0\",\n                  \"fitness_status\": \"3\",\n                  \"goal\": \"3\",\n                  \"image\": \"2_1447317902.jpg\",\n                  \"city\": \"Kochi\",\n                  \"state\": \"Kerala\",\n                  \"country\": \"India\",\n                  \"quote\": \"I need to get strong!!!!\",\n                  \"created_at\": \"2015-11-12 08:45:02\",\n                  \"updated_at\": \"2015-11-12 08:45:02\"\n               }\n          },\n          \"followers\": [{\n              \"id\": \"1\",\n              \"user_id\": \"3\",\n              \"follow_id\": \"2\",\n              \"created_at\": \"2015-11-12 09:34:27\",\n              \"updated_at\": \"2015-11-12 15:05:55\",\n              \"following_profile\": {\n                  \"id\": \"3\",\n                  \"email\": \"ykings1@yopmail.com\",\n                  \"confirmation_code\": \"\",\n                  \"status\": \"1\",\n                  \"created_at\": \"2015-11-12 08:47:37\",\n                  \"updated_at\": \"2015-11-12 08:47:37\",\n                  \"profile\": {\n                      \"id\": \"3\",\n                      \"user_id\": \"3\",\n                      \"first_name\": \"Ykings\",\n                      \"last_name\": \"test1\",\n                      \"gender\": \"0\",\n                      \"fitness_status\": \"1\",\n                      \"goal\": \"3\",\n                      \"image\": \"3_1447318063.jpg\",\n                      \"city\": \"Kochi\",\n                      \"state\": \"Kerala\",\n                      \"country\": \"India\",\n                      \"quote\": \"I need to get strong!!!!\",\n                      \"created_at\": \"2015-11-12 08:47:43\",\n                      \"updated_at\": \"2015-11-12 08:47:43\"\n                  }\n              }\n              },\n              {\n              \"id\": \"3\",\n              \"user_id\": \"5\",\n              \"follow_id\": \"2\",\n              \"created_at\": \"2015-11-12 11:43:59\",\n              \"updated_at\": \"2015-11-12 11:43:59\",\n              \"following_profile\": {\n                  \"id\": \"5\",\n                  \"email\": \"ykings3@yopmail.com\",\n                  \"confirmation_code\": \"\",\n                  \"status\": \"1\",\n                  \"created_at\": \"2015-11-12 08:49:55\",\n                  \"updated_at\": \"2015-11-12 08:49:55\",\n                  \"profile\": {\n                      \"id\": \"5\",\n                      \"user_id\": \"5\",\n                      \"first_name\": \"Ykings\",\n                      \"last_name\": \"test3\",\n                      \"gender\": \"0\",\n                      \"fitness_status\": \"2\",\n                      \"goal\": \"2\",\n                      \"image\": \"5_1447318201.jpg\",\n                      \"city\": \"Kochi\",\n                      \"state\": \"Kerala\",\n                      \"country\": \"India\",\n                      \"quote\": \"I need to get strong!!!!\",\n                      \"created_at\": \"2015-11-12 08:50:01\",\n                      \"updated_at\": \"2015-11-12 08:50:01\"\n                  }\n              }\n          }]\n      },\n      \"urls\": {\n          \"profileImageSmall\": \"http://sandbox.ykings.com/uploads/images/profile/small\",\n          \"profileImageMedium\": \"http://sandbox.ykings.com/uploads/images/profile/medium\",\n          \"profileImageLarge\": \"http://sandbox.ykings.com/uploads/images/profile/large\",\n          \"profileImageOriginal\": \"http://sandbox.ykings.com/uploads/images/profile/original\",\n          \"video\": \"http://sandbox.ykings.com/uploads/videos\",\n          \"feedImageSmall\": \"http://sandbox.ykings.com/uploads/images/feed/small\",\n          \"feedImageMedium\": \"http://sandbox.ykings.com/uploads/images/feed/medium\",\n          \"feedImageLarge\": \"http://sandbox.ykings.com/uploads/images/feed/large\",\n          \"feedImageOriginal\": \"http://sandbox.ykings.com/uploads/images/feed/original\"\n      }\n      }",
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
          "content": "HTTP/1.1 200 OK\n  {\n  \"status\": 1,\n  \"success\": \"user_followings\",\n  \"user\": {\n  \"id\": \"2\",\n  \"email\": \"aneeshk@cubettech.com\",\n  \"confirmation_code\": \"\",\n  \"status\": \"1\",\n  \"created_at\": \"2015-11-12 08:44:54\",\n  \"updated_at\": \"2015-11-12 08:44:54\",\n  \"profile\": {\n  \"id\": \"2\",\n  \"user_id\": \"2\",\n  \"first_name\": \"Aneesh\",\n  \"last_name\": \"Kallikkattil\",\n  \"gender\": \"0\",\n  \"fitness_status\": \"3\",\n  \"goal\": \"3\",\n  \"image\": \"2_1447317902.jpg\",\n  \"city\": \"Kochi\",\n  \"state\": \"Kerala\",\n  \"country\": \"India\",\n  \"quote\": \"I need to get strong!!!!\",\n  \"created_at\": \"2015-11-12 08:45:02\",\n  \"updated_at\": \"2015-11-12 08:45:02\"\n  },\n  \"followers\": [\n  {\n  \"id\": \"1\",\n  \"user_id\": \"3\",\n  \"follow_id\": \"2\",\n  \"created_at\": \"2015-11-12 09:34:27\",\n  \"updated_at\": \"2015-11-12 15:05:55\",\n  \"following_profile\": {\n  \"id\": \"3\",\n  \"email\": \"ykings1@yopmail.com\",\n  \"confirmation_code\": \"\",\n  \"status\": \"1\",\n  \"created_at\": \"2015-11-12 08:47:37\",\n  \"updated_at\": \"2015-11-12 08:47:37\",\n  \"profile\": {\n  \"id\": \"3\",\n  \"user_id\": \"3\",\n  \"first_name\": \"Ykings\",\n  \"last_name\": \"test1\",\n  \"gender\": \"0\",\n  \"fitness_status\": \"1\",\n  \"goal\": \"3\",\n  \"image\": \"3_1447318063.jpg\",\n  \"city\": \"Kochi\",\n  \"state\": \"Kerala\",\n  \"country\": \"India\",\n  \"quote\": \"I need to get strong!!!!\",\n  \"created_at\": \"2015-11-12 08:47:43\",\n  \"updated_at\": \"2015-11-12 08:47:43\"\n  }\n  }\n  },\n  {\n  \"id\": \"3\",\n  \"user_id\": \"5\",\n  \"follow_id\": \"2\",\n  \"created_at\": \"2015-11-12 11:43:59\",\n  \"updated_at\": \"2015-11-12 11:43:59\",\n  \"following_profile\": {\n  \"id\": \"5\",\n  \"email\": \"ykings3@yopmail.com\",\n  \"confirmation_code\": \"\",\n  \"status\": \"1\",\n  \"created_at\": \"2015-11-12 08:49:55\",\n  \"updated_at\": \"2015-11-12 08:49:55\",\n  \"profile\": {\n  \"id\": \"5\",\n  \"user_id\": \"5\",\n  \"first_name\": \"Ykings\",\n  \"last_name\": \"test3\",\n  \"gender\": \"0\",\n  \"fitness_status\": \"2\",\n  \"goal\": \"2\",\n  \"image\": \"5_1447318201.jpg\",\n  \"city\": \"Kochi\",\n  \"state\": \"Kerala\",\n  \"country\": \"India\",\n  \"quote\": \"I need to get strong!!!!\",\n  \"created_at\": \"2015-11-12 08:50:01\",\n  \"updated_at\": \"2015-11-12 08:50:01\"\n  }\n  }\n  }\n  ]\n  },\n  \"urls\": {\n  \"profileImageSmall\": \"http://sandbox.ykings.com/uploads/images/profile/small\",\n  \"profileImageMedium\": \"http://sandbox.ykings.com/uploads/images/profile/medium\",\n  \"profileImageLarge\": \"http://sandbox.ykings.com/uploads/images/profile/large\",\n  \"profileImageOriginal\": \"http://sandbox.ykings.com/uploads/images/profile/original\",\n  \"video\": \"http://sandbox.ykings.com/uploads/videos\",\n  \"feedImageSmall\": \"http://sandbox.ykings.com/uploads/images/feed/small\",\n  \"feedImageMedium\": \"http://sandbox.ykings.com/uploads/images/feed/medium\",\n  \"feedImageLarge\": \"http://sandbox.ykings.com/uploads/images/feed/large\",\n  \"feedImageOriginal\": \"http://sandbox.ykings.com/uploads/images/feed/original\"\n  }\n  }",
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
          "content": "HTTP/1.1 200 OK\n      {\n          \"status\": 1,\n          \"success\": \"successfully_unfollowed\",\n          \"user\": {\n              \"id\": \"5\",\n              \"email\": \"ykings3@yopmail.com\",\n              \"confirmation_code\": \"\",\n              \"status\": \"1\",\n              \"created_at\": \"2015-11-12 08:49:55\",\n              \"updated_at\": \"2015-11-12 08:49:55\",\n              \"profile\": {\n                  \"id\": \"5\",\n                  \"user_id\": \"5\",\n                  \"first_name\": \"Ykings\",\n                  \"last_name\": \"test3\",\n                  \"gender\": \"0\",\n                  \"fitness_status\": \"2\",\n                  \"goal\": \"2\",\n                  \"image\": \"5_1447318201.jpg\",\n                  \"city\": \"Kochi\",\n                  \"state\": \"Kerala\",\n                  \"country\": \"India\",\n                  \"quote\": \"I need to get strong!!!!\",\n                  \"created_at\": \"2015-11-12 08:50:01\",\n                  \"updated_at\": \"2015-11-12 08:50:01\"\n               }\n          },\n          \"followers\": [],\n          \"followings\": [{\n              \"id\": \"3\",\n              \"user_id\": \"5\",\n              \"follow_id\": \"2\",\n              \"created_at\": \"2015-11-12 11:43:59\",\n              \"updated_at\": \"2015-11-12 11:43:59\",\n              \"follow_profile\": {\n                  \"id\": \"2\",\n                  \"email\": \"aneeshk@cubettech.com\",\n                  \"confirmation_code\": \"\",\n                  \"status\": \"1\",\n                  \"created_at\": \"2015-11-12 08:44:54\",\n                  \"updated_at\": \"2015-11-12 08:44:54\",\n                  \"profile\": {\n                      \"id\": \"2\",\n                      \"user_id\": \"2\",\n                      \"first_name\": \"Aneesh\",\n                      \"last_name\": \"Kallikkattil\",\n                      \"gender\": \"0\",\n                      \"fitness_status\": \"3\",\n                      \"goal\": \"3\",\n                      \"image\": \"2_1447317902.jpg\",\n                      \"city\": \"Kochi\",\n                      \"state\": \"Kerala\",\n                      \"country\": \"India\",\n                      \"quote\": \"I need to get strong!!!!\",\n                      \"created_at\": \"2015-11-12 08:45:02\",\n                      \"updated_at\": \"2015-11-12 08:45:02\"\n                  }\n              }\n          }]\n      },\n      \"urls\": {\n          \"profileImageSmall\": \"http://sandbox.ykings.com/uploads/images/profile/small\",\n          \"profileImageMedium\": \"http://sandbox.ykings.com/uploads/images/profile/medium\",\n          \"profileImageLarge\": \"http://sandbox.ykings.com/uploads/images/profile/large\",\n          \"profileImageOriginal\": \"http://sandbox.ykings.com/uploads/images/profile/original\",\n          \"video\": \"http://sandbox.ykings.com/uploads/videos\",\n          \"feedImageSmall\": \"http://sandbox.ykings.com/uploads/images/feed/small\",\n          \"feedImageMedium\": \"http://sandbox.ykings.com/uploads/images/feed/medium\",\n          \"feedImageLarge\": \"http://sandbox.ykings.com/uploads/images/feed/large\",\n          \"feedImageOriginal\": \"http://sandbox.ykings.com/uploads/images/feed/original\"\n        }\n    }",
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
          "content": "HTTP/1.1 400 Invalid Request\n{ \n  \"status\" : 0,\n  \"error\": \"token_invalid\"\n}",
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
          "content": "HTTP/1.1 422 follower_user_does_not_exists\n{\n      \"status\": 0,\n      \"error\": \"follower_user_does_not_exists\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 422 following_user_does_not_exists\n{\n      \"status\": 0,\n      \"error\": \"following_user_does_not_exists\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 422 validation_errors\n{\n  \"status\": 0,\n  \"error\":  \"The follower_id field is required.\"        \n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 422 validation_errors\n{\n  \"status\": 0,\n  \"error\":  \"The following_id field is required.\"        \n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 422 follower_user_does_not_exists\n{\n      \"status\": 0,\n      \"error\": \"follower_user_does_not_exists\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 422 follower_user_not_verified_email\n{\n      \"status\": 0,\n      \"error\": \"follower_user_not_verified_email\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 422 following_user_not_verified_email\n{\n      \"status\": 0,\n      \"error\": \"following_user_not_verified_email\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 422 you_are_already_followed\n{\n      \"status\": 0,\n      \"error\": \"you_are_already_unfollowed\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 500 could_not_able_to_follow\n{\n      \"status\": 0,\n      \"error\": \"could_not_able_to_unfollow\"\n}",
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
    "url": "/user/settings?token=",
    "title": "userSettings",
    "name": "User_Settings",
    "group": "Settings",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "<p>Number</p> ",
            "optional": false,
            "field": "user_id",
            "description": "<p>Id of user</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>String</p> ",
            "optional": false,
            "field": "settings_key",
            "description": "<p>notification/subscription</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>String</p> ",
            "optional": false,
            "field": "status",
            "description": "<p>json array of [{&quot;comments&quot;:&quot;1&quot;},{&quot;claps&quot;:&quot;0&quot;},{&quot;follow&quot;:&quot;0&quot;},{&quot;my_performance&quot;:&quot;1&quot;},{&quot;motivation_knowledge&quot;:&quot;1&quot;}]</p> "
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
          "content": "    HTTP/1.1 200 OK\n{\n\"status\" : 1,\n      \"success\": \"successfully_updated\",\n      \"user\": {\n      \"id\": \"1\",\n      \"email\": \"admin@ykings.com\",\n      \"confirmation_code\": null,\n      \"status\": \"1\",\n      \"created_at\": \"2015-11-06 12:14:48\",\n      \"updated_at\": \"2015-11-06 12:15:04\",\n      \"profile\": {\n      \"id\": \"1\",\n      \"user_id\": \"1\",\n      \"first_name\": \"Ykings\",\n      \"last_name\": \"Administrator\",\n      \"gender\": \"0\",\n      \"fitness_status\": \"0\",\n      \"goal\": \"3\",\n      \"image\": null,\n      \"city\": null,\n      \"state\": null,\n      \"country\": null,\n      \"quote\": \"I am Simple\",\n      \"created_at\": \"2015-11-06 12:14:48\",\n      \"updated_at\": \"2015-11-06 12:14:48\"\n      },\n      \"social\": null,\n      \"settings\": [\n      {\n      \"id\": \"1\",\n      \"user_id\": \"1\",\n      \"key\": \"notification\",\n      \"value\": \"1\",\n      \"created_at\": \"2015-11-10 06:18:29\",\n      \"updated_at\": \"2015-11-10 12:02:08\"\n      },\n      {\n      \"id\": \"2\",\n      \"user_id\": \"1\",\n      \"key\": \"subscription\",\n      \"value\": \"0\",\n      \"created_at\": \"2015-11-10 06:32:20\",\n      \"updated_at\": \"2015-11-10 12:10:43\"\n      }\n      ]\n      }\n      }",
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
    "url": "/connect/connectFriends",
    "title": "",
    "name": "Connect_Friends",
    "group": "Social",
    "description": "<p>API for connecting facebook/phone book.</p> ",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "<p>string</p> ",
            "optional": false,
            "field": "user_id",
            "description": "<p>User Id of user</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>string</p> ",
            "optional": false,
            "field": "email",
            "description": "<p>Email Ids from contact,json array</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>string</p> ",
            "optional": false,
            "field": "type",
            "description": "<p>facebook/phonebook</p> "
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
          "content": "HTTP/1.1 200 OK\n      {\n        \"status\": 1,\n        \"registered_emails\": [\n            {\n                \"id\": \"11\",\n                \"email\": \"ansa@cubettech.com\",\n                \"confirmation_code\": null,\n                \"status\": \"1\",\n                \"created_at\": \"2015-11-09 12:40:07\",\n                \"updated_at\": \"2015-11-09 12:40:07\",\n                \"profile\": [\n                    {\n                        \"id\": \"7\",\n                        \"user_id\": \"11\",\n                        \"first_name\": \"ansa\",\n                        \"last_name\": \"v\",\n                        \"gender\": \"0\",\n                        \"fitness_status\": \"0\",\n                        \"goal\": \"0\",\n                        \"image\": \"11_1447237788.jpg\",\n                        \"city\": null,\n                        \"state\": null,\n                        \"country\": null,\n                        \"quote\": \"\",\n                        \"created_at\": \"2015-11-09 12:40:07\",\n                        \"updated_at\": \"2015-11-12 09:05:16\"\n                    }\n                ],\n                \"image\": []\n            },\n            {\n                \"id\": \"15\",\n                \"email\": \"dibin@cubettech.com\",\n                \"confirmation_code\": null,\n                \"status\": \"1\",\n                \"created_at\": \"2015-11-11 06:25:34\",\n                \"updated_at\": \"2015-11-11 06:25:34\",\n                \"profile\": [\n                    {\n                        \"id\": \"9\",\n                        \"user_id\": \"15\",\n                        \"first_name\": \"Dibu\",\n                        \"last_name\": \"k\",\n                        \"gender\": \"0\",\n                        \"fitness_status\": \"0\",\n                        \"goal\": \"0\",\n                        \"image\": null,\n                        \"city\": null,\n                        \"state\": null,\n                        \"country\": null,\n                        \"quote\": \"\",\n                        \"created_at\": \"2015-11-11 06:25:34\",\n                        \"updated_at\": \"2015-11-11 06:25:34\"\n                    }\n                ],\n                \"image\": []\n            }\n        ],\n        \"urls\": {\n            \"profileImageSmall\": \"http://ykings.me/uploads/images/profile/small\",\n            \"profileImageMedium\": \"http://ykings.me/uploads/images/profile/medium\",\n            \"profileImageLarge\": \"http://ykings.me/uploads/images/profile/large\",\n            \"profileImageOriginal\": \"http://ykings.me/uploads/images/profile/original\",\n            \"video\": \"http://ykings.me/uploads/videos\",\n            \"feedImageSmall\": \"http://ykings.me/uploads/images/feed/small\",\n            \"feedImageMedium\": \"http://ykings.me/uploads/images/feed/medium\",\n            \"feedImageLarge\": \"http://ykings.me/uploads/images/feed/large\",\n            \"feedImageOriginal\": \"http://ykings.me/uploads/images/feed/original\"\n        },\n        \"type\": \"phonebook\"\n        }",
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
    "groupTitle": "Social"
  },
  {
    "type": "post",
    "url": "/social/facebookLogin?token=",
    "title": "facebookLogin",
    "name": "Facebook_Login",
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
            "description": "<p>Provider,eg:facebook</p> "
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
          "content": "    HTTP/1.1 200 OK\n{\n    \"status\": 1,\n    \"comments\": [\n        {\n            \"id\": \"1\",\n            \"user_id\": \"14\",\n            \"parent_type\": \"feed\",\n            \"parent_id\": \"15\",\n            \"comment_text\": \"This is a sample comment\",\n            \"created_at\": \"2015-11-16 13:53:47\",\n            \"updated_at\": \"2015-11-17 13:01:09\",\n            \"user\": {\n                \"id\": \"14\",\n                \"email\": \"sachin@cubettech.com\",\n                \"profile\": [\n                    {\n                        \"id\": \"8\",\n                        \"user_id\": \"14\",\n                        \"first_name\": \"sachii\",\n                        \"last_name\": \"k\",\n                        \"gender\": \"0\",\n                        \"fitness_status\": \"0\",\n                        \"goal\": \"0\",\n                        \"image\": null,\n                        \"city\": null,\n                        \"state\": null,\n                        \"country\": null,\n                        \"quote\": \"\",\n                        \"created_at\": \"2015-11-11 06:23:56\",\n                        \"updated_at\": \"2015-11-11 06:23:56\"\n                    }\n                ]\n            }\n        },\n        {\n            \"id\": \"2\",\n            \"user_id\": \"11\",\n            \"parent_type\": \"feed\",\n            \"parent_id\": \"15\",\n            \"comment_text\": \"This is another comment\",\n            \"created_at\": \"2015-11-16 13:55:14\",\n            \"updated_at\": \"2015-11-17 13:02:38\",\n            \"user\": {\n                \"id\": \"11\",\n                \"email\": \"ansa@cubettech.com\",\n                \"profile\": [\n                    {\n                        \"id\": \"7\",\n                        \"user_id\": \"11\",\n                        \"first_name\": \"ansa\",\n                        \"last_name\": \"v\",\n                        \"gender\": \"0\",\n                        \"fitness_status\": \"0\",\n                        \"goal\": \"0\",\n                        \"image\": \"11_1447237788.jpg\",\n                        \"city\": null,\n                        \"state\": null,\n                        \"country\": null,\n                        \"quote\": \"\",\n                        \"created_at\": \"2015-11-09 12:40:07\",\n                        \"updated_at\": \"2015-11-12 09:05:16\"\n                    }\n                ]\n            }\n        }\n    ],\n    \"urls\": {\n        \"profileImageSmall\": \"http://ykings.me/uploads/images/profile/small\",\n        \"profileImageMedium\": \"http://ykings.me/uploads/images/profile/medium\",\n        \"profileImageLarge\": \"http://ykings.me/uploads/images/profile/large\",\n        \"profileImageOriginal\": \"http://ykings.me/uploads/images/profile/original\",\n        \"video\": \"http://ykings.me/uploads/videos\",\n        \"feedImageSmall\": \"http://ykings.me/uploads/images/feed/small\",\n        \"feedImageMedium\": \"http://ykings.me/uploads/images/feed/medium\",\n        \"feedImageLarge\": \"http://ykings.me/uploads/images/feed/large\",\n        \"feedImageOriginal\": \"http://ykings.me/uploads/images/feed/original\"\n    }\n}",
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
          "content": "{\n      \"status\": 0,\n      \"error\": {\n      \"email\": [\n      \"The email field is required.\"\n      ],\n      \"provider_id\": [\n      \"The provider id field is required.\"\n      ],\n      \"provider\": [\n      \"The provider field is required.\"\n      ]\n      }\n      }",
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
            "optional": false,
            "field": "details",
            "description": "<p>details of transaction device, os, versio etc as json array *required</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>Number</p> ",
            "optional": false,
            "field": "inapp_id",
            "description": "<p>id of subscription id created with Inapp *required</p> "
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
            "optional": false,
            "field": "image",
            "description": "<p>user avatar image *optional *accepted formats JPEG, PNG, and GIF</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>number</p> ",
            "optional": false,
            "field": "gender",
            "description": "<p>user id of the user 1-Male, 2-Female *optional</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>number</p> ",
            "optional": false,
            "field": "fitness_status",
            "description": "<p>user's self assessment about fitness 1-I am definitely fit, 2-I am quite fit, 3-I am not so fit *optional</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>number</p> ",
            "optional": false,
            "field": "goal",
            "description": "<p>user's goal *optional 1-Get Lean, 2-Get Fit, 3-Get Strong</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>string</p> ",
            "optional": false,
            "field": "city",
            "description": "<p>user's city *optional</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>string</p> ",
            "optional": false,
            "field": "state",
            "description": "<p>user's state *optional</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>string</p> ",
            "optional": false,
            "field": "country",
            "description": "<p>user's country *optional</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>string</p> ",
            "optional": false,
            "field": "quote",
            "description": "<p>Quote added by user *optional</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>number</p> ",
            "optional": false,
            "field": "subscription",
            "description": "<p>Whether Newsletter subscription selected by user *optional</p> "
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
          "content": "HTTP/1.1 200 OK\n  {\n      \"status\" : 1,\n      \"success\": \"successfully_updated_user_profile\",\n      \"token\": \"eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOiIyIiwiaXNzIjoiaHR0cDpcL1wvbG9jYWxob3N0OjgwMDBcL2FwaVwvdXNlclwvbG9naW4iLCJpYXQiOiIxNDQ3MjQ2NTc1IiwiZXhwIjoiMTQ0NzYwNjU3NSIsIm5iZiI6IjE0NDcyNDY1NzUiLCJqdGkiOiI2ZTBlN2JlMDI5YTJjZTVkODM4MzkwY2EyZmE0MGNkMSJ9.lFwueZXytFQhLcfX6GZ1fwp5wmtPT1GenTZpx3p2jKQ\",\n      \"user\": {\n          \"id\": \"2\",\n          \"email\": \"aneeshk@cubettech.com\",\n          \"confirmation_code\": \"d6grRYINWtcDH18bXc358M9ZDDFExd\",\n          \"status\": \"1\",\n          \"created_at\": \"2015-11-11 11:40:04\",\n          \"updated_at\": \"2015-11-11 11:40:04\",\n          \"profile\": {\n              \"id\": \"2\",\n              \"user_id\": \"2\",\n              \"first_name\": \"Aneesh\",\n              \"last_name\": \"Kallikkattil\",\n              \"gender\": \"0\",\n              \"fitness_status\": \"0\",\n              \"goal\": \"0\",\n              \"image\": \"2_1447242011.jpg\",\n              \"city\": \"\",\n              \"state\": \"\",\n              \"country\": \"\",\n              \"quote\": \"\",\n              \"created_at\": \"2015-11-11 11:40:10\",\n              \"updated_at\": \"2015-11-11 11:40:11\"\n          },\n          \"videos\": [\n              {\n                  \"id\": \"2\",\n                  \"user_id\": \"2\",\n                  \"video_id\": \"1\",\n                  \"created_at\": \"2015-11-11 11:40:05\",\n                  \"updated_at\": \"2015-11-11 11:40:05\",\n                  \"video\": {\n                      \"id\": \"1\",\n                      \"user_id\": \"1\",\n                      \"path\": \"Now1.mp4\",\n                      \"description\": \"Test Description\",\n                      \"parent_type\": \"1\",\n                      \"type\": \"1\",\n                      \"parent_id\": \"1\",\n                      \"created_at\": \"2015-11-11 07:26:40\",\n                      \"updated_at\": \"2015-11-11 17:43:27\"\n                  }\n              }\n          ]\n      },\n      \"urls\": {\n          \"profileImageSmall\": \"http://sandbox.ykings.com/uploads/images/profile/small\",\n          \"profileImageMedium\": \"http://sandbox.ykings.com/uploads/images/profile/medium\",\n          \"profileImageLarge\": \"http://sandbox.ykings.com/uploads/images/profile/large\",\n          \"profileImageOriginal\": \"http://sandbox.ykings.com/uploads/images/profile/original\",\n          \"video\": \"http://sandbox.ykings.com/uploads/videos\",\n          \"feedImageSmall\": \"http://sandbox.ykings.com/uploads/images/feed/small\",\n          \"feedImageMedium\": \"http://sandbox.ykings.com/uploads/images/feed/medium\",\n          \"feedImageLarge\": \"http://sandbox.ykings.com/uploads/images/feed/large\",\n          \"feedImageOriginal\": \"http://sandbox.ykings.com/uploads/images/feed/original\"\n      }\n  }",
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
          "content": "  HTTP/1.1 200 OK\n  {\n    \"status\" : 1,\n    \"success\": \"user_details\",\n    \"user\": {\n        \"id\": \"2\",\n        \"email\": \"aneeshk@ykings.com\",\n        \"confirmation_code\": \"d6grRYINWtcDH18bXc358M9ZDDFExd\",\n        \"status\": \"0\",\n        \"created_at\": \"2015-11-11 11:40:04\",\n        \"updated_at\": \"2015-11-11 11:40:04\",\n        \"profile\": {\n            \"id\": \"2\",\n            \"user_id\": \"2\",\n            \"first_name\": \"Aneesh\",\n            \"last_name\": \"Kallikkattil\",\n            \"gender\": \"0\",\n            \"fitness_status\": \"0\",\n            \"goal\": \"0\",\n            \"image\": \"2_1447242011.jpg\",\n            \"city\": \"\",\n            \"state\": \"\",\n            \"country\": \"\",\n            \"quote\": \"\",\n            \"created_at\": \"2015-11-11 11:40:10\",\n            \"updated_at\": \"2015-11-11 11:40:11\"\n        },\n        \"videos\": [\n            {\n                \"id\": \"2\",\n                \"user_id\": \"2\",\n                \"video_id\": \"1\",\n                \"created_at\": \"2015-11-11 11:40:05\",\n                \"updated_at\": \"2015-11-11 11:40:05\",\n                \"video\": {\n                    \"id\": \"1\",\n                    \"user_id\": \"1\",\n                    \"path\": \"Now1.mp4\",\n                    \"description\": \"Test Description\",\n                    \"parent_type\": \"1\",\n                    \"type\": \"1\",\n                    \"parent_id\": \"1\",\n                   \"created_at\": \"2015-11-11 07:26:40\",\n                    \"updated_at\": \"2015-11-11 17:43:27\"\n                }     \n             }\n\n        ]\n    },\n    \"urls\": {\n        \"profileImageSmall\": \"http://sandbox.ykings.com/uploads/images/profile/small\",\n        \"profileImageMedium\": \"http://sandbox.ykings.com/uploads/images/profile/medium\",\n        \"profileImageLarge\": \"http://sandbox.ykings.com/uploads/images/profile/large\",\n        \"profileImageOriginal\": \"http://sandbox.ykings.com/uploads/images/profile/original\",\n        \"video\": \"http://sandbox.ykings.com/uploads/videos\",\n        \"feedImageSmall\": \"http://sandbox.ykings.com/uploads/images/feed/small\",\n        \"feedImageMedium\": \"http://sandbox.ykings.com/uploads/images/feed/medium\",\n        \"feedImageLarge\": \"http://sandbox.ykings.com/uploads/images/feed/large\",\n        \"feedImageOriginal\": \"http://sandbox.ykings.com/uploads/images/feed/original\"\n    }\n}",
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
          "content": "HTTP/1.1 200 OK\n  {\n      \"status\" : 1,\n      \"success\": \"user_videos\",\n      \"videos\": [\n          {\n              \"id\": \"2\",\n              \"user_id\": \"2\",\n              \"video_id\": \"1\",\n              \"created_at\": \"2015-11-11 11:40:05\",\n              \"updated_at\": \"2015-11-11 11:40:05\",\n              \"video\": {\n                  \"id\": \"1\",\n                  \"user_id\": \"1\",\n                  \"path\": \"Now1.mp4\",\n                  \"description\": \"Test Description\",\n                  \"parent_type\": \"1\",\n                  \"type\": \"1\",\n                  \"parent_id\": \"1\",\n                  \"created_at\": \"2015-11-11 07:26:40\",\n                  \"updated_at\": \"2015-11-11 17:43:27\"\n              },\n              \"user\": {\n                  \"id\": \"2\",\n                  \"email\": \"aneeshk@ykings.com\",\n                  \"confirmation_code\": \"d6grRYINWtcDH18bXc358M9ZDDFExd\",\n                  \"status\": \"0\",\n                  \"created_at\": \"2015-11-11 11:40:04\",\n                  \"updated_at\": \"2015-11-11 11:40:04\",\n                  \"profile\": {\n                      \"id\": \"2\",\n                      \"user_id\": \"2\",\n                      \"first_name\": \"Aneesh\",\n                      \"last_name\": \"Kallikkattil\",\n                      \"gender\": \"0\",\n                      \"fitness_status\": \"0\",\n                      \"goal\": \"0\",\n                      \"image\": \"2_1447242011.jpg\",\n                      \"city\": \"\",\n                      \"state\": \"\",\n                      \"country\": \"\",\n                      \"quote\": \"\",\n                      \"created_at\": \"2015-11-11 11:40:10\",\n                      \"updated_at\": \"2015-11-11 11:40:11\"\n                  }\n              }\n          }\n      ],\n      \"urls\": {\n          \"profileImageSmall\": \"http://sandbox.ykings.com/uploads/images/profile/small\",\n          \"profileImageMedium\": \"http://sandbox.ykings.com/uploads/images/profile/medium\",\n          \"profileImageLarge\": \"http://sandbox.ykings.com/uploads/images/profile/large\",\n          \"profileImageOriginal\": \"http://sandbox.ykings.com/uploads/images/profile/original\",\n          \"video\": \"http://sandbox.ykings.com/uploads/videos\",\n          \"feedImageSmall\": \"http://sandbox.ykings.com/uploads/images/feed/small\",\n          \"feedImageMedium\": \"http://sandbox.ykings.com/uploads/images/feed/medium\",\n          \"feedImageLarge\": \"http://sandbox.ykings.com/uploads/images/feed/large\",\n          \"feedImageOriginal\": \"http://sandbox.ykings.com/uploads/images/feed/original\"\n      }\n  }",
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
          "content": "HTTP/1.1 200 OK\n  {\n      \"status\" : 1\n      \"success\": \"successfully_logged_in\",\n      \"token\": \"eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOiIyIiwiaXNzIjoiaHR0cDpcL1wvbG9jYWxob3N0OjgwMDBcL2FwaVwvdXNlclwvbG9naW4iLCJpYXQiOiIxNDQ3MjQ2NTc1IiwiZXhwIjoiMTQ0NzYwNjU3NSIsIm5iZiI6IjE0NDcyNDY1NzUiLCJqdGkiOiI2ZTBlN2JlMDI5YTJjZTVkODM4MzkwY2EyZmE0MGNkMSJ9.lFwueZXytFQhLcfX6GZ1fwp5wmtPT1GenTZpx3p2jKQ\",\n      \"user\": {\n          \"id\": \"2\",\n          \"email\": \"aneeshk@cubettech.com\",\n          \"confirmation_code\": \"d6grRYINWtcDH18bXc358M9ZDDFExd\",\n          \"status\": \"1\",\n          \"created_at\": \"2015-11-11 11:40:04\",\n          \"updated_at\": \"2015-11-11 11:40:04\",\n          \"profile\": {\n              \"id\": \"2\",\n              \"user_id\": \"2\",\n              \"first_name\": \"Aneesh\",\n              \"last_name\": \"Kallikkattil\",\n              \"gender\": \"0\",\n              \"fitness_status\": \"0\",\n              \"goal\": \"0\",\n              \"image\": \"2_1447242011.jpg\",\n              \"city\": \"\",\n              \"state\": \"\",\n              \"country\": \"\",\n              \"quote\": \"\",\n              \"created_at\": \"2015-11-11 11:40:10\",\n              \"updated_at\": \"2015-11-11 11:40:11\"\n          },\n          \"videos\": [\n              {\n                  \"id\": \"2\",\n                  \"user_id\": \"2\",\n                  \"video_id\": \"1\",\n                  \"created_at\": \"2015-11-11 11:40:05\",\n                  \"updated_at\": \"2015-11-11 11:40:05\",\n                  \"video\": {\n                      \"id\": \"1\",\n                      \"user_id\": \"1\",\n                      \"path\": \"Now1.mp4\",\n                      \"description\": \"Test Description\",\n                      \"parent_type\": \"1\",\n                      \"type\": \"1\",\n                      \"parent_id\": \"1\",\n                      \"created_at\": \"2015-11-11 07:26:40\",\n                      \"updated_at\": \"2015-11-11 17:43:27\"\n                  }\n              }\n          ]\n      },\n      \"urls\": {\n          \"profileImageSmall\": \"http://sandbox.ykings.com/uploads/images/profile/small\",\n          \"profileImageMedium\": \"http://sandbox.ykings.com/uploads/images/profile/medium\",\n          \"profileImageLarge\": \"http://sandbox.ykings.com/uploads/images/profile/large\",\n          \"profileImageOriginal\": \"http://sandbox.ykings.com/uploads/images/profile/original\",\n          \"video\": \"http://sandbox.ykings.com/uploads/videos\",\n          \"feedImageSmall\": \"http://sandbox.ykings.com/uploads/images/feed/small\",\n          \"feedImageMedium\": \"http://sandbox.ykings.com/uploads/images/feed/medium\",\n          \"feedImageLarge\": \"http://sandbox.ykings.com/uploads/images/feed/large\",\n          \"feedImageOriginal\": \"http://sandbox.ykings.com/uploads/images/feed/original\"\n      }\n  }",
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
    "url": "user/resendverify",
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
            "optional": false,
            "field": "first_name",
            "description": "<p>Firstname of user *optional</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>string</p> ",
            "optional": false,
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
            "optional": false,
            "field": "gender",
            "description": "<p>gender of the user 1-Male, 2-Female *optional</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>number</p> ",
            "optional": false,
            "field": "fitness_status",
            "description": "<p>user's self assessment about fitness 1-I am definitely fit, 2-I am quite fit, 3-I am not so fit *optional</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>file</p> ",
            "optional": false,
            "field": "image",
            "description": "<p>user avatar image *optional *accepted formats JPEG, PNG, and GIF</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>number</p> ",
            "optional": false,
            "field": "goal",
            "description": "<p>user's goal *optional</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>string</p> ",
            "optional": false,
            "field": "city",
            "description": "<p>user's city *optional</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>string</p> ",
            "optional": false,
            "field": "state",
            "description": "<p>user's state *optional</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>string</p> ",
            "optional": false,
            "field": "country",
            "description": "<p>user's country *optional</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>string</p> ",
            "optional": false,
            "field": "quote",
            "description": "<p>Quote added by user *optional</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>number</p> ",
            "optional": false,
            "field": "subscription",
            "description": "<p>Whether Newsletter subscription selected by user *optional</p> "
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
          "content": "HTTP/1.1 200 OK\n      {\n          \"status\" : 1,\n          \"success\": \"successfully_updated_user_profile\",\n          \"token\": \"eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOiIyIiwiaXNzIjoiaHR0cDpcL1wvbG9jYWxob3N0OjgwMDBcL2FwaVwvdXNlclwvbG9naW4iLCJpYXQiOiIxNDQ3MjQ2NTc1IiwiZXhwIjoiMTQ0NzYwNjU3NSIsIm5iZiI6IjE0NDcyNDY1NzUiLCJqdGkiOiI2ZTBlN2JlMDI5YTJjZTVkODM4MzkwY2EyZmE0MGNkMSJ9.lFwueZXytFQhLcfX6GZ1fwp5wmtPT1GenTZpx3p2jKQ\",\n          \"user\": {\n              \"id\": \"2\",\n              \"email\": \"aneeshk@cubettech.com\",\n              \"confirmation_code\": \"d6grRYINWtcDH18bXc358M9ZDDFExd\",\n              \"status\": \"1\",\n              \"created_at\": \"2015-11-11 11:40:04\",\n              \"updated_at\": \"2015-11-11 11:40:04\",\n              \"profile\": {\n                  \"id\": \"2\",\n                  \"user_id\": \"2\",\n                  \"first_name\": \"Aneesh\",\n                  \"last_name\": \"Kallikkattil\",\n                  \"gender\": \"0\",\n                  \"fitness_status\": \"0\",\n                  \"goal\": \"0\",\n                  \"image\": \"2_1447242011.jpg\",\n                  \"city\": \"\",\n                  \"state\": \"\",\n                  \"country\": \"\",\n                  \"quote\": \"\",\n                  \"created_at\": \"2015-11-11 11:40:10\",\n                  \"updated_at\": \"2015-11-11 11:40:11\"\n              },\n              \"videos\": [\n                  {\n                      \"id\": \"2\",\n                      \"user_id\": \"2\",\n                      \"video_id\": \"1\",\n                      \"created_at\": \"2015-11-11 11:40:05\",\n                      \"updated_at\": \"2015-11-11 11:40:05\",\n                      \"video\": {\n                          \"id\": \"1\",\n                          \"user_id\": \"1\",\n                          \"path\": \"Now1.mp4\",\n                          \"description\": \"Test Description\",\n                          \"parent_type\": \"1\",\n                          \"type\": \"1\",\n                          \"parent_id\": \"1\",\n                          \"created_at\": \"2015-11-11 07:26:40\",\n                          \"updated_at\": \"2015-11-11 17:43:27\"\n                      }\n                  }\n              ]\n          },\n          \"urls\": {\n              \"profileImageSmall\": \"http://sandbox.ykings.com/uploads/images/profile/small\",\n              \"profileImageMedium\": \"http://sandbox.ykings.com/uploads/images/profile/medium\",\n              \"profileImageLarge\": \"http://sandbox.ykings.com/uploads/images/profile/large\",\n              \"profileImageOriginal\": \"http://sandbox.ykings.com/uploads/images/profile/original\",\n              \"video\": \"http://sandbox.ykings.com/uploads/videos\",\n              \"feedImageSmall\": \"http://sandbox.ykings.com/uploads/images/feed/small\",\n              \"feedImageMedium\": \"http://sandbox.ykings.com/uploads/images/feed/medium\",\n              \"feedImageLarge\": \"http://sandbox.ykings.com/uploads/images/feed/large\",\n              \"feedImageOriginal\": \"http://sandbox.ykings.com/uploads/images/feed/original\"\n          }\n      }",
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
          "content": "HTTP/1.1 200 OK\n  {\n      \"status\" : 1,\n      \"success\": \"user_videos\",\n      \"videos\": [\n          {\n              \"id\": \"2\",\n              \"user_id\": \"2\",\n              \"video_id\": \"1\",\n              \"created_at\": \"2015-11-11 11:40:05\",\n              \"updated_at\": \"2015-11-11 11:40:05\",\n              \"video\": {\n                  \"id\": \"1\",\n                  \"user_id\": \"1\",\n                  \"path\": \"Now1.mp4\",\n                  \"description\": \"Test Description\",\n                  \"parent_type\": \"1\",\n                  \"type\": \"1\",\n                  \"parent_id\": \"1\",\n                  \"created_at\": \"2015-11-11 07:26:40\",\n                  \"updated_at\": \"2015-11-11 17:43:27\"\n              },\n              \"user\": {\n                  \"id\": \"2\",\n                  \"email\": \"aneeshk@ykings.com\",\n                  \"confirmation_code\": \"d6grRYINWtcDH18bXc358M9ZDDFExd\",\n                  \"status\": \"0\",\n                  \"created_at\": \"2015-11-11 11:40:04\",\n                  \"updated_at\": \"2015-11-11 11:40:04\",\n                  \"profile\": {\n                      \"id\": \"2\",\n                      \"user_id\": \"2\",\n                      \"first_name\": \"Aneesh\",\n                      \"last_name\": \"Kallikkattil\",\n                      \"gender\": \"0\",\n                      \"fitness_status\": \"0\",\n                      \"goal\": \"0\",\n                      \"image\": \"2_1447242011.jpg\",\n                      \"city\": \"\",\n                      \"state\": \"\",\n                      \"country\": \"\",\n                      \"quote\": \"\",\n                      \"created_at\": \"2015-11-11 11:40:10\",\n                      \"updated_at\": \"2015-11-11 11:40:11\"\n                  }\n              }\n          }\n      ],\n      \"urls\": {\n          \"profileImageSmall\": \"http://sandbox.ykings.com/uploads/images/profile/small\",\n          \"profileImageMedium\": \"http://sandbox.ykings.com/uploads/images/profile/medium\",\n          \"profileImageLarge\": \"http://sandbox.ykings.com/uploads/images/profile/large\",\n          \"profileImageOriginal\": \"http://sandbox.ykings.com/uploads/images/profile/original\",\n          \"video\": \"http://sandbox.ykings.com/uploads/videos\",\n          \"feedImageSmall\": \"http://sandbox.ykings.com/uploads/images/feed/small\",\n          \"feedImageMedium\": \"http://sandbox.ykings.com/uploads/images/feed/medium\",\n          \"feedImageLarge\": \"http://sandbox.ykings.com/uploads/images/feed/large\",\n          \"feedImageOriginal\": \"http://sandbox.ykings.com/uploads/images/feed/original\"\n      }\n  }",
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
    "url": "/workout/addstar",
    "title": "addStar",
    "name": "addStar",
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
            "description": "<p>of workout *required 1-beginer, 2-advanced, 3-professional</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>Number</p> ",
            "optional": false,
            "field": "user_id",
            "description": "<p>of workout *required</p> "
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
          "content": "HTTP/1.1 422 Validation error\n{\n  \"status\" : 0,\n  \"error\": \"The user_id field is required\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 422 You need to complete this workout to star.\n{\n  \"status\" : 0,\n  \"error\": \"You need to complete this workout to star.\"\n}",
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
            "description": "<p>Id of workout</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>Number</p> ",
            "optional": false,
            "field": "category",
            "description": "<p>of workout 1-beginer, 2-advanced, 3-professional</p> "
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
            "description": "<p>Id of workout</p> "
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
            "description": "<p>Id of user</p> "
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
          "content": "HTTP/1.1 200 OK\n{\n      \"status\": 1,\n      \"exercises\": {\n      \"beginer\": [\n      {\n      \"id\": \"1\",\n      \"name\": \"Jumping Pullups\",\n      \"description\": \"The jumping pull-up is a challenging full body exercise that targets the back, legs and arms.\",\n      \"category\": \"1\",\n      \"type\": \"1\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"1.00\",\n      \"equipment\": \"\",\n      \"created_at\": \"2015-11-17 13:30:19\",\n      \"updated_at\": \"2015-11-17 13:30:19\",\n      \"video\": [\n      {\n      \"id\": \"1\",\n      \"user_id\": \"1\",\n      \"path\": \"Now1.mp4\",\n      \"description\": \"Test Description\",\n      \"parent_type\": \"1\",\n      \"type\": \"1\",\n      \"parent_id\": \"1\",\n      \"created_at\": \"2015-11-11 07:26:40\",\n      \"updated_at\": \"2015-11-11 17:43:27\"\n      }\n      ]\n      }\n      ],\n      \"advanced\": [\n      {\n      \"id\": \"1\",\n      \"name\": \"Jumping Pullups\",\n      \"description\": \"The jumping pull-up is a challenging full body exercise that targets the back, legs and arms.\",\n      \"category\": \"1\",\n      \"type\": \"1\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"1.00\",\n      \"equipment\": \"\",\n      \"created_at\": \"2015-11-17 13:30:19\",\n      \"updated_at\": \"2015-11-17 13:30:19\",\n      \"video\": [\n      {\n      \"id\": \"1\",\n      \"user_id\": \"1\",\n      \"path\": \"Now1.mp4\",\n      \"description\": \"Test Description\",\n      \"parent_type\": \"1\",\n      \"type\": \"1\",\n      \"parent_id\": \"1\",\n      \"created_at\": \"2015-11-11 07:26:40\",\n      \"updated_at\": \"2015-11-11 17:43:27\"\n      }\n      ]\n      }\n      ],\n      \"professional\": [\n      {\n      \"id\": \"1\",\n      \"name\": \"Jumping Pullups\",\n      \"description\": \"The jumping pull-up is a challenging full body exercise that targets the back, legs and arms.\",\n      \"category\": \"1\",\n      \"type\": \"1\",\n      \"rewards\": \"6.00\",\n      \"repititions\": \"10\",\n      \"duration\": \"1.00\",\n      \"equipment\": \"\",\n      \"created_at\": \"2015-11-17 13:30:19\",\n      \"updated_at\": \"2015-11-17 13:30:19\",\n      \"video\": [\n      {\n      \"id\": \"1\",\n      \"user_id\": \"1\",\n      \"path\": \"Now1.mp4\",\n      \"description\": \"Test Description\",\n      \"parent_type\": \"1\",\n      \"type\": \"1\",\n      \"parent_id\": \"1\",\n      \"created_at\": \"2015-11-11 07:26:40\",\n      \"updated_at\": \"2015-11-11 17:43:27\"\n      }\n      ]\n      }\n      ]\n      }\n\n      }",
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
    "url": "password/email",
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