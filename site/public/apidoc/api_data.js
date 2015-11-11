define({ "api": [
  {
    "type": "post",
    "url": "/createFeeds",
    "title": "createFeeds",
    "name": "Create_Feeds",
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
            "type": "<p>String</p> ",
            "optional": false,
            "field": "item_type",
            "description": "<p>'excercise','workout','motivation','announcement'</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>String</p> ",
            "optional": false,
            "field": "image",
            "description": "<p>FormData</p> "
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
          "content": "HTTP/1.1 200 OK\n{\n      \"success\": \"feed_created_successfully\",\n      \"feed\": [\n      {\n      \"id\": \"15\",\n      \"user_id\": \"11\",\n      \"item_type\": \"workout\",\n      \"item_id\": \"1\",\n      \"feed_text\": \"testttttttttt\",\n      \"created_at\": \"2015-11-11 03:51:01\",\n      \"updated_at\": \"2015-11-11 03:51:01\",\n      \"user\": {\n      \"id\": \"11\",\n      \"email\": \"ansa@cubettech.com\",\n      \"confirmation_code\": null,\n      \"status\": \"1\",\n      \"created_at\": \"2015-11-09 12:40:07\",\n      \"updated_at\": \"2015-11-09 12:40:07\"\n      }\n      },\n      {\n      \"id\": \"16\",\n      \"user_id\": \"11\",\n      \"item_type\": \"workout\",\n      \"item_id\": \"1\",\n      \"feed_text\": \"testttttttttt\",\n      \"created_at\": \"2015-11-11 03:58:36\",\n      \"updated_at\": \"2015-11-11 03:58:36\",\n      \"user\": {\n      \"id\": \"11\",\n      \"email\": \"ansa@cubettech.com\",\n      \"confirmation_code\": null,\n      \"status\": \"1\",\n      \"created_at\": \"2015-11-09 12:40:07\",\n      \"updated_at\": \"2015-11-09 12:40:07\"\n      }\n      }\n      ]\n      }",
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
        }
      ]
    },
    "version": "0.0.0",
    "filename": "app/Http/Controllers/Api/FeedController.php",
    "groupTitle": "Feeds"
  },
  {
    "type": "post",
    "url": "feeds/list",
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
          "content": "    HTTP/1.1 200 OK\n{\n      \"success\": \"list\",\n      \"feed_list\": [\n      {\n      \"id\": \"15\",\n      \"user_id\": \"11\",\n      \"item_type\": \"workout\",\n      \"item_id\": \"1\",\n      \"feed_text\": \"testttttttttt\",\n      \"created_at\": \"2015-11-11 03:51:01\",\n      \"updated_at\": \"2015-11-11 03:51:01\"\n      },\n      {\n      \"id\": \"16\",\n      \"user_id\": \"11\",\n      \"item_type\": \"workout\",\n      \"item_id\": \"1\",\n      \"feed_text\": \"testttttttttt\",\n      \"created_at\": \"2015-11-11 03:58:36\",\n      \"updated_at\": \"2015-11-11 03:58:36\"\n      },\n      {\n      \"id\": \"17\",\n      \"user_id\": \"11\",\n      \"item_type\": \"workout\",\n      \"item_id\": \"1\",\n      \"feed_text\": \"testttttttttt\",\n      \"created_at\": \"2015-11-11 03:59:27\",\n      \"updated_at\": \"2015-11-11 03:59:27\"\n      },\n      {\n      \"id\": \"18\",\n      \"user_id\": \"11\",\n      \"item_type\": \"workout\",\n      \"item_id\": \"1\",\n      \"feed_text\": \"testttttttttt\",\n      \"created_at\": \"2015-11-11 04:00:05\",\n      \"updated_at\": \"2015-11-11 04:00:05\"\n      },\n      {\n      \"id\": \"19\",\n      \"user_id\": \"11\",\n      \"item_type\": \"workout\",\n      \"item_id\": \"1\",\n      \"feed_text\": \"testttttttttt\",\n      \"created_at\": \"2015-11-11 04:05:11\",\n      \"updated_at\": \"2015-11-11 04:05:11\"\n      },\n      {\n      \"id\": \"20\",\n      \"user_id\": \"11\",\n      \"item_type\": \"workout\",\n      \"item_id\": \"1\",\n      \"feed_text\": \"testttttttttt\",\n      \"created_at\": \"2015-11-11 05:05:37\",\n      \"updated_at\": \"2015-11-11 05:05:37\"\n      }\n      ]\n      }",
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
        }
      ]
    },
    "version": "0.0.0",
    "filename": "app/Http/Controllers/Api/FeedController.php",
    "groupTitle": "Feeds"
  },
  {
    "type": "post",
    "url": "user/feedlist",
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
          "content": "    HTTP/1.1 200 OK\n{\n      \"success\": \"List\",\n      \"feed_list\": [\n      {\n      \"id\": \"21\",\n      \"user_id\": \"14\",\n      \"item_type\": \"excercise\",\n      \"item_id\": \"1\",\n      \"feed_text\": \"testttttttttt\",\n      \"created_at\": \"2015-11-11 06:27:51\",\n      \"updated_at\": \"2015-11-11 06:27:51\",\n      \"user\": {\n      \"id\": \"14\",\n      \"email\": \"sachin@cubettech.com\",\n      \"confirmation_code\": null,\n      \"status\": \"1\",\n      \"created_at\": \"2015-11-11 06:23:56\",\n      \"updated_at\": \"2015-11-11 06:23:56\"\n      }\n      },\n      {\n      \"id\": \"22\",\n      \"user_id\": \"14\",\n      \"item_type\": \"excercise\",\n      \"item_id\": \"1\",\n      \"feed_text\": \"afassdfsd\",\n      \"created_at\": \"2015-11-11 06:49:38\",\n      \"updated_at\": \"2015-11-11 06:49:38\",\n      \"user\": {\n      \"id\": \"14\",\n      \"email\": \"sachin@cubettech.com\",\n      \"confirmation_code\": null,\n      \"status\": \"1\",\n      \"created_at\": \"2015-11-11 06:23:56\",\n      \"updated_at\": \"2015-11-11 06:23:56\"\n      }\n      },\n      {\n      \"id\": \"23\",\n      \"user_id\": \"14\",\n      \"item_type\": \"excercise\",\n      \"item_id\": \"1\",\n      \"feed_text\": \"afassdfsd\",\n      \"created_at\": \"2015-11-11 06:50:18\",\n      \"updated_at\": \"2015-11-11 06:50:18\",\n      \"user\": {\n      \"id\": \"14\",\n      \"email\": \"sachin@cubettech.com\",\n      \"confirmation_code\": null,\n      \"status\": \"1\",\n      \"created_at\": \"2015-11-11 06:23:56\",\n      \"updated_at\": \"2015-11-11 06:23:56\"\n      }\n      },\n      {\n      \"id\": \"24\",\n      \"user_id\": \"14\",\n      \"item_type\": \"excercise\",\n      \"item_id\": \"1\",\n      \"feed_text\": \"afassdfsd\",\n      \"created_at\": \"2015-11-11 06:57:04\",\n      \"updated_at\": \"2015-11-11 06:57:04\",\n      \"user\": {\n      \"id\": \"14\",\n      \"email\": \"sachin@cubettech.com\",\n      \"confirmation_code\": null,\n      \"status\": \"1\",\n      \"created_at\": \"2015-11-11 06:23:56\",\n      \"updated_at\": \"2015-11-11 06:23:56\"\n      }\n      },\n      {\n      \"id\": \"25\",\n      \"user_id\": \"14\",\n      \"item_type\": \"excercise\",\n      \"item_id\": \"1\",\n      \"feed_text\": \"afassdfsd\",\n      \"created_at\": \"2015-11-11 06:57:21\",\n      \"updated_at\": \"2015-11-11 06:57:21\",\n      \"user\": {\n      \"id\": \"14\",\n      \"email\": \"sachin@cubettech.com\",\n      \"confirmation_code\": null,\n      \"status\": \"1\",\n      \"created_at\": \"2015-11-11 06:23:56\",\n      \"updated_at\": \"2015-11-11 06:23:56\"\n      }\n      }\n      ]\n      }",
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
        }
      ]
    },
    "version": "0.0.0",
    "filename": "app/Http/Controllers/Api/FeedController.php",
    "groupTitle": "Feeds"
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
          "content": "HTTP/1.1 200 OK\n{\n  \"token\": \"eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOiIxIiwiaXNzIjoiaHR0cDpcL1wvc2FuZGJveC55a2luZ3MuY29tXC9hcGlcL2F1dGhlbnRpY2F0ZSIsImlhdCI6IjE0NDY2MzMwNzgiLCJleHAiOiIxNDQ2NjM2Njc4IiwibmJmIjoiMTQ0NjYzMzA3OCIsImp0aSI6ImFiNDAwNTllZmU0OTI3ODYwMTczYjI1ZGEzZWJmMDkwIn0.uM_G0OAne9b-twd60tAZlAUGmpitINP0JMgGC3ZrNoo\",\n}",
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
          "content": "HTTP/1.1 404 invalid_credentials\n{\n  \"error\": \"invalid_credentials\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 500 could_not_create_token\n{\n  \"error\": \"could_not_create_token\"\n}",
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
    "url": "/user/settings",
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
          "content": "    HTTP/1.1 200 OK\n{\n      \"success\": \"successfully_updated\",\n      \"user\": {\n      \"id\": \"1\",\n      \"email\": \"admin@ykings.com\",\n      \"confirmation_code\": null,\n      \"status\": \"1\",\n      \"created_at\": \"2015-11-06 12:14:48\",\n      \"updated_at\": \"2015-11-06 12:15:04\",\n      \"profile\": {\n      \"id\": \"1\",\n      \"user_id\": \"1\",\n      \"first_name\": \"Ykings\",\n      \"last_name\": \"Administrator\",\n      \"gender\": \"0\",\n      \"fitness_status\": \"0\",\n      \"goal\": \"3\",\n      \"image\": null,\n      \"city\": null,\n      \"state\": null,\n      \"country\": null,\n      \"quote\": \"I am Simple\",\n      \"created_at\": \"2015-11-06 12:14:48\",\n      \"updated_at\": \"2015-11-06 12:14:48\"\n      },\n      \"social\": null,\n      \"settings\": [\n      {\n      \"id\": \"1\",\n      \"user_id\": \"1\",\n      \"key\": \"notification\",\n      \"value\": \"1\",\n      \"created_at\": \"2015-11-10 06:18:29\",\n      \"updated_at\": \"2015-11-10 12:02:08\"\n      },\n      {\n      \"id\": \"2\",\n      \"user_id\": \"1\",\n      \"key\": \"subscription\",\n      \"value\": \"0\",\n      \"created_at\": \"2015-11-10 06:32:20\",\n      \"updated_at\": \"2015-11-10 12:10:43\"\n      }\n      ]\n      }\n      }",
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
        }
      ]
    },
    "version": "0.0.0",
    "filename": "app/Http/Controllers/Api/UserSettingsController.php",
    "groupTitle": "Settings"
  },
  {
    "type": "post",
    "url": "/facebook",
    "title": "facebookLogin",
    "name": "Facebook_Login",
    "group": "Social",
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
            "field": "id",
            "description": "<p>Facebook id of user *required</p> "
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
          "content": "    HTTP/1.1 200 OK\n{\n      \"success\": \"successfully_logged_in\",\n      \"token\": \"eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOiIxMSIsImlzcyI6Imh0dHA6XC9cL2xvY2FsaG9zdDo4MDAwXC9hcGlcL3NvY2lhbFwvZmFjZWJvb2tMb2dpbiIsImlhdCI6IjE0NDcxMjk3NTkiLCJleHAiOiIxNDQ3NDg5NzU5IiwibmJmIjoiMTQ0NzEyOTc1OSIsImp0aSI6ImNiODMzMmU5ZGI4ODMyMTYwODM2YjVjMzBhNTkwNWQ2In0.flzfuwss7oEZcrQoy05sECz1o74ofIkgf5F24xvNKE0\",\n      \"user\": {\n      \"id\": \"11\",\n      \"email\": \"ansa@cubettech.com\",\n      \"confirmation_code\": null,\n      \"status\": \"1\",\n      \"created_at\": \"2015-11-09 12:40:07\",\n      \"updated_at\": \"2015-11-09 12:40:07\",\n      \"profile\": {\n      \"id\": \"7\",\n      \"user_id\": \"11\",\n      \"first_name\": \"ansa\",\n      \"last_name\": \"v\",\n      \"gender\": \"0\",\n      \"fitness_status\": \"0\",\n      \"goal\": \"0\",\n      \"image\": null,\n      \"city\": null,\n      \"state\": null,\n      \"country\": null,\n      \"quote\": \"\",\n      \"created_at\": \"2015-11-09 12:40:07\",\n      \"updated_at\": \"2015-11-09 12:40:07\"\n      },\n      \"social\": {\n      \"id\": \"2\",\n      \"user_id\": \"11\",\n      \"provider\": \"facebook\",\n      \"provider_uid\": \"123456789\",\n      \"created_at\": \"2015-11-09 12:40:07\",\n      \"updated_at\": \"2015-11-09 12:40:07\"\n      }\n      }\n      }",
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
        }
      ]
    },
    "version": "0.0.0",
    "filename": "app/Http/Controllers/Api/SocialController.php",
    "groupTitle": "Social"
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
          "content": "HTTP/1.1 200 OK\n  {\n      \"success\": \"successfully_updated_user_profile\",\n      \"token\": \"eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOiIyIiwiaXNzIjoiaHR0cDpcL1wvbG9jYWxob3N0OjgwMDBcL2FwaVwvdXNlclwvbG9naW4iLCJpYXQiOiIxNDQ3MjQ2NTc1IiwiZXhwIjoiMTQ0NzYwNjU3NSIsIm5iZiI6IjE0NDcyNDY1NzUiLCJqdGkiOiI2ZTBlN2JlMDI5YTJjZTVkODM4MzkwY2EyZmE0MGNkMSJ9.lFwueZXytFQhLcfX6GZ1fwp5wmtPT1GenTZpx3p2jKQ\",\n      \"user\": {\n          \"id\": \"2\",\n          \"email\": \"aneeshk@cubettech.com\",\n          \"confirmation_code\": \"d6grRYINWtcDH18bXc358M9ZDDFExd\",\n          \"status\": \"1\",\n          \"created_at\": \"2015-11-11 11:40:04\",\n          \"updated_at\": \"2015-11-11 11:40:04\",\n          \"profile\": {\n              \"id\": \"2\",\n              \"user_id\": \"2\",\n              \"first_name\": \"Aneesh\",\n              \"last_name\": \"Kallikkattil\",\n              \"gender\": \"0\",\n              \"fitness_status\": \"0\",\n              \"goal\": \"0\",\n              \"image\": \"2_1447242011.jpg\",\n              \"city\": \"\",\n              \"state\": \"\",\n              \"country\": \"\",\n              \"quote\": \"\",\n              \"created_at\": \"2015-11-11 11:40:10\",\n              \"updated_at\": \"2015-11-11 11:40:11\"\n          },\n          \"videos\": [\n              {\n                  \"id\": \"2\",\n                  \"user_id\": \"2\",\n                  \"video_id\": \"1\",\n                  \"created_at\": \"2015-11-11 11:40:05\",\n                  \"updated_at\": \"2015-11-11 11:40:05\",\n                  \"video\": {\n                      \"id\": \"1\",\n                      \"user_id\": \"1\",\n                      \"path\": \"Now1.mp4\",\n                      \"description\": \"Test Description\",\n                      \"parent_type\": \"1\",\n                      \"type\": \"1\",\n                      \"parent_id\": \"1\",\n                      \"created_at\": \"2015-11-11 07:26:40\",\n                      \"updated_at\": \"2015-11-11 17:43:27\"\n                  }\n              }\n          ]\n      },\n      \"urls\": {\n          \"profileImageSmall\": \"http://localhost:8000/uploads/images/profile/small\",\n          \"profileImageMedium\": \"http://localhost:8000/uploads/images/profile/medium\",\n          \"profileImageLarge\": \"http://localhost:8000/uploads/images/profile/large\",\n          \"profileImageOriginal\": \"http://localhost:8000/uploads/images/profile/original\",\n          \"video\": \"http://localhost:8000/uploads/videos\",\n          \"feedImageSmall\": \"http://localhost:8000/uploads/images/feed/small\",\n          \"feedImageMedium\": \"http://localhost:8000/uploads/images/feed/medium\",\n          \"feedImageLarge\": \"http://localhost:8000/uploads/images/feed/large\",\n          \"feedImageOriginal\": \"http://localhost:8000/uploads/images/feed/original\"\n      }\n  }",
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
          "content": "HTTP/1.1 500 user_created_but_we_accept_only_jpeg_gif_png_files_as_profile_images\n{\n  \"error\": \"user_created_but_we_accept_only_jpeg_gif_png_files_as_profile_images\"\n}",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "app/Http/Controllers/Api/UsersController.php",
    "groupTitle": "User"
  },
  {
    "type": "get",
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
          "content": "  HTTP/1.1 200 OK\n  {\n    \"success\": \"user_details\",\n    \"user\": {\n        \"id\": \"2\",\n        \"email\": \"aneeshk@ykings.com\",\n        \"confirmation_code\": \"d6grRYINWtcDH18bXc358M9ZDDFExd\",\n        \"status\": \"0\",\n        \"created_at\": \"2015-11-11 11:40:04\",\n        \"updated_at\": \"2015-11-11 11:40:04\",\n        \"profile\": {\n            \"id\": \"2\",\n            \"user_id\": \"2\",\n            \"first_name\": \"Aneesh\",\n            \"last_name\": \"Kallikkattil\",\n            \"gender\": \"0\",\n            \"fitness_status\": \"0\",\n            \"goal\": \"0\",\n            \"image\": \"2_1447242011.jpg\",\n            \"city\": \"\",\n            \"state\": \"\",\n            \"country\": \"\",\n            \"quote\": \"\",\n            \"created_at\": \"2015-11-11 11:40:10\",\n            \"updated_at\": \"2015-11-11 11:40:11\"\n        },\n        \"videos\": [\n            {\n                \"id\": \"2\",\n                \"user_id\": \"2\",\n                \"video_id\": \"1\",\n                \"created_at\": \"2015-11-11 11:40:05\",\n                \"updated_at\": \"2015-11-11 11:40:05\",\n                \"video\": {\n                    \"id\": \"1\",\n                    \"user_id\": \"1\",\n                    \"path\": \"Now1.mp4\",\n                    \"description\": \"Test Description\",\n                    \"parent_type\": \"1\",\n                    \"type\": \"1\",\n                    \"parent_id\": \"1\",\n                   \"created_at\": \"2015-11-11 07:26:40\",\n                    \"updated_at\": \"2015-11-11 17:43:27\"\n                }     \n             }\n\n        ]\n    },\n    \"urls\": {\n        \"profileImageSmall\": \"http://localhost:8000/uploads/images/profile/small\",\n        \"profileImageMedium\": \"http://localhost:8000/uploads/images/profile/medium\",\n        \"profileImageLarge\": \"http://localhost:8000/uploads/images/profile/large\",\n        \"profileImageOriginal\": \"http://localhost:8000/uploads/images/profile/original\",\n        \"video\": \"http://localhost:8000/uploads/videos\",\n        \"feedImageSmall\": \"http://localhost:8000/uploads/images/feed/small\",\n        \"feedImageMedium\": \"http://localhost:8000/uploads/images/feed/medium\",\n        \"feedImageLarge\": \"http://localhost:8000/uploads/images/feed/large\",\n        \"feedImageOriginal\": \"http://localhost:8000/uploads/images/feed/original\"\n    }\n}",
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
            "field": "user_not_verified",
            "description": "<p>User error.</p> "
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "invalid_credentials",
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
          "content": "HTTP/1.1 422 user_not_verified\n{\n  \"error\": \"user_not_verified\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 401 invalid_credentials\n{\n  \"error\": \"invalid_credentials\"\n}",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "app/Http/Controllers/Api/UsersController.php",
    "groupTitle": "User"
  },
  {
    "type": "get",
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
          "content": "HTTP/1.1 200 OK\n  {\n      \"success\": \"user_videos\",\n      \"videos\": [\n          {\n              \"id\": \"2\",\n              \"user_id\": \"2\",\n              \"video_id\": \"1\",\n              \"created_at\": \"2015-11-11 11:40:05\",\n              \"updated_at\": \"2015-11-11 11:40:05\",\n              \"video\": {\n                  \"id\": \"1\",\n                  \"user_id\": \"1\",\n                  \"path\": \"Now1.mp4\",\n                  \"description\": \"Test Description\",\n                  \"parent_type\": \"1\",\n                  \"type\": \"1\",\n                  \"parent_id\": \"1\",\n                  \"created_at\": \"2015-11-11 07:26:40\",\n                  \"updated_at\": \"2015-11-11 17:43:27\"\n              },\n              \"user\": {\n                  \"id\": \"2\",\n                  \"email\": \"aneeshk@ykings.com\",\n                  \"confirmation_code\": \"d6grRYINWtcDH18bXc358M9ZDDFExd\",\n                  \"status\": \"0\",\n                  \"created_at\": \"2015-11-11 11:40:04\",\n                  \"updated_at\": \"2015-11-11 11:40:04\",\n                  \"profile\": {\n                      \"id\": \"2\",\n                      \"user_id\": \"2\",\n                      \"first_name\": \"Aneesh\",\n                      \"last_name\": \"Kallikkattil\",\n                      \"gender\": \"0\",\n                      \"fitness_status\": \"0\",\n                      \"goal\": \"0\",\n                      \"image\": \"2_1447242011.jpg\",\n                      \"city\": \"\",\n                      \"state\": \"\",\n                      \"country\": \"\",\n                      \"quote\": \"\",\n                      \"created_at\": \"2015-11-11 11:40:10\",\n                      \"updated_at\": \"2015-11-11 11:40:11\"\n                  }\n              }\n          }\n      ],\n      \"urls\": {\n          \"profileImageSmall\": \"http://localhost:8000/uploads/images/profile/small\",\n          \"profileImageMedium\": \"http://localhost:8000/uploads/images/profile/medium\",\n          \"profileImageLarge\": \"http://localhost:8000/uploads/images/profile/large\",\n          \"profileImageOriginal\": \"http://localhost:8000/uploads/images/profile/original\",\n          \"video\": \"http://localhost:8000/uploads/videos\",\n          \"feedImageSmall\": \"http://localhost:8000/uploads/images/feed/small\",\n          \"feedImageMedium\": \"http://localhost:8000/uploads/images/feed/medium\",\n          \"feedImageLarge\": \"http://localhost:8000/uploads/images/feed/large\",\n          \"feedImageOriginal\": \"http://localhost:8000/uploads/images/feed/original\"\n      }\n  }",
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
            "field": "user_not_verified",
            "description": "<p>User error.</p> "
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "invalid_credentials",
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
          "content": "HTTP/1.1 401 invalid_credentials\n{\n  \"error\": \"invalid_credentials\"\n}",
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
          "content": "HTTP/1.1 200 OK\n  {\n      \"success\": \"successfully_logged_in\",\n      \"token\": \"eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOiIyIiwiaXNzIjoiaHR0cDpcL1wvbG9jYWxob3N0OjgwMDBcL2FwaVwvdXNlclwvbG9naW4iLCJpYXQiOiIxNDQ3MjQ2NTc1IiwiZXhwIjoiMTQ0NzYwNjU3NSIsIm5iZiI6IjE0NDcyNDY1NzUiLCJqdGkiOiI2ZTBlN2JlMDI5YTJjZTVkODM4MzkwY2EyZmE0MGNkMSJ9.lFwueZXytFQhLcfX6GZ1fwp5wmtPT1GenTZpx3p2jKQ\",\n      \"user\": {\n          \"id\": \"2\",\n          \"email\": \"aneeshk@cubettech.com\",\n          \"confirmation_code\": \"d6grRYINWtcDH18bXc358M9ZDDFExd\",\n          \"status\": \"1\",\n          \"created_at\": \"2015-11-11 11:40:04\",\n          \"updated_at\": \"2015-11-11 11:40:04\",\n          \"profile\": {\n              \"id\": \"2\",\n              \"user_id\": \"2\",\n              \"first_name\": \"Aneesh\",\n              \"last_name\": \"Kallikkattil\",\n              \"gender\": \"0\",\n              \"fitness_status\": \"0\",\n              \"goal\": \"0\",\n              \"image\": \"2_1447242011.jpg\",\n              \"city\": \"\",\n              \"state\": \"\",\n              \"country\": \"\",\n              \"quote\": \"\",\n              \"created_at\": \"2015-11-11 11:40:10\",\n              \"updated_at\": \"2015-11-11 11:40:11\"\n          },\n          \"videos\": [\n              {\n                  \"id\": \"2\",\n                  \"user_id\": \"2\",\n                  \"video_id\": \"1\",\n                  \"created_at\": \"2015-11-11 11:40:05\",\n                  \"updated_at\": \"2015-11-11 11:40:05\",\n                  \"video\": {\n                      \"id\": \"1\",\n                      \"user_id\": \"1\",\n                      \"path\": \"Now1.mp4\",\n                      \"description\": \"Test Description\",\n                      \"parent_type\": \"1\",\n                      \"type\": \"1\",\n                      \"parent_id\": \"1\",\n                      \"created_at\": \"2015-11-11 07:26:40\",\n                      \"updated_at\": \"2015-11-11 17:43:27\"\n                  }\n              }\n          ]\n      },\n      \"urls\": {\n          \"profileImageSmall\": \"http://localhost:8000/uploads/images/profile/small\",\n          \"profileImageMedium\": \"http://localhost:8000/uploads/images/profile/medium\",\n          \"profileImageLarge\": \"http://localhost:8000/uploads/images/profile/large\",\n          \"profileImageOriginal\": \"http://localhost:8000/uploads/images/profile/original\",\n          \"video\": \"http://localhost:8000/uploads/videos\",\n          \"feedImageSmall\": \"http://localhost:8000/uploads/images/feed/small\",\n          \"feedImageMedium\": \"http://localhost:8000/uploads/images/feed/medium\",\n          \"feedImageLarge\": \"http://localhost:8000/uploads/images/feed/large\",\n          \"feedImageOriginal\": \"http://localhost:8000/uploads/images/feed/original\"\n      }\n  }",
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
            "field": "user_not_verified",
            "description": "<p>User error.</p> "
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "invalid_credentials",
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
          "content": "HTTP/1.1 422 user_not_verified\n{\n  \"error\": \"user_not_verified\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 401 invalid_credentials\n{\n  \"error\": \"invalid_credentials\"\n}",
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
          "content": "HTTP/1.1 200 OK\n      {\n          \"success\": \"successfully_updated_user_profile\",\n          \"token\": \"eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOiIyIiwiaXNzIjoiaHR0cDpcL1wvbG9jYWxob3N0OjgwMDBcL2FwaVwvdXNlclwvbG9naW4iLCJpYXQiOiIxNDQ3MjQ2NTc1IiwiZXhwIjoiMTQ0NzYwNjU3NSIsIm5iZiI6IjE0NDcyNDY1NzUiLCJqdGkiOiI2ZTBlN2JlMDI5YTJjZTVkODM4MzkwY2EyZmE0MGNkMSJ9.lFwueZXytFQhLcfX6GZ1fwp5wmtPT1GenTZpx3p2jKQ\",\n          \"user\": {\n              \"id\": \"2\",\n              \"email\": \"aneeshk@cubettech.com\",\n              \"confirmation_code\": \"d6grRYINWtcDH18bXc358M9ZDDFExd\",\n              \"status\": \"1\",\n              \"created_at\": \"2015-11-11 11:40:04\",\n              \"updated_at\": \"2015-11-11 11:40:04\",\n              \"profile\": {\n                  \"id\": \"2\",\n                  \"user_id\": \"2\",\n                  \"first_name\": \"Aneesh\",\n                  \"last_name\": \"Kallikkattil\",\n                  \"gender\": \"0\",\n                  \"fitness_status\": \"0\",\n                  \"goal\": \"0\",\n                  \"image\": \"2_1447242011.jpg\",\n                  \"city\": \"\",\n                  \"state\": \"\",\n                  \"country\": \"\",\n                  \"quote\": \"\",\n                  \"created_at\": \"2015-11-11 11:40:10\",\n                  \"updated_at\": \"2015-11-11 11:40:11\"\n              },\n              \"videos\": [\n                  {\n                      \"id\": \"2\",\n                      \"user_id\": \"2\",\n                      \"video_id\": \"1\",\n                      \"created_at\": \"2015-11-11 11:40:05\",\n                      \"updated_at\": \"2015-11-11 11:40:05\",\n                      \"video\": {\n                          \"id\": \"1\",\n                          \"user_id\": \"1\",\n                          \"path\": \"Now1.mp4\",\n                          \"description\": \"Test Description\",\n                          \"parent_type\": \"1\",\n                          \"type\": \"1\",\n                          \"parent_id\": \"1\",\n                          \"created_at\": \"2015-11-11 07:26:40\",\n                          \"updated_at\": \"2015-11-11 17:43:27\"\n                      }\n                  }\n              ]\n          },\n          \"urls\": {\n              \"profileImageSmall\": \"http://localhost:8000/uploads/images/profile/small\",\n              \"profileImageMedium\": \"http://localhost:8000/uploads/images/profile/medium\",\n              \"profileImageLarge\": \"http://localhost:8000/uploads/images/profile/large\",\n              \"profileImageOriginal\": \"http://localhost:8000/uploads/images/profile/original\",\n              \"video\": \"http://localhost:8000/uploads/videos\",\n              \"feedImageSmall\": \"http://localhost:8000/uploads/images/feed/small\",\n              \"feedImageMedium\": \"http://localhost:8000/uploads/images/feed/medium\",\n              \"feedImageLarge\": \"http://localhost:8000/uploads/images/feed/large\",\n              \"feedImageOriginal\": \"http://localhost:8000/uploads/images/feed/original\"\n          }\n      }",
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
            "field": "could_not_update_user_profile",
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
    "type": "get",
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
            "field": "id",
            "description": "<p>id of user *required</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>integer</p> ",
            "optional": false,
            "field": "video_id",
            "description": "<p>id of user video*required</p> "
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
          "content": "HTTP/1.1 200 OK\n  {\n      \"success\": \"user_videos\",\n      \"videos\": [\n          {\n              \"id\": \"2\",\n              \"user_id\": \"2\",\n              \"video_id\": \"1\",\n              \"created_at\": \"2015-11-11 11:40:05\",\n              \"updated_at\": \"2015-11-11 11:40:05\",\n              \"video\": {\n                  \"id\": \"1\",\n                  \"user_id\": \"1\",\n                  \"path\": \"Now1.mp4\",\n                  \"description\": \"Test Description\",\n                  \"parent_type\": \"1\",\n                  \"type\": \"1\",\n                  \"parent_id\": \"1\",\n                  \"created_at\": \"2015-11-11 07:26:40\",\n                  \"updated_at\": \"2015-11-11 17:43:27\"\n              },\n              \"user\": {\n                  \"id\": \"2\",\n                  \"email\": \"aneeshk@ykings.com\",\n                  \"confirmation_code\": \"d6grRYINWtcDH18bXc358M9ZDDFExd\",\n                  \"status\": \"0\",\n                  \"created_at\": \"2015-11-11 11:40:04\",\n                  \"updated_at\": \"2015-11-11 11:40:04\",\n                  \"profile\": {\n                      \"id\": \"2\",\n                      \"user_id\": \"2\",\n                      \"first_name\": \"Aneesh\",\n                      \"last_name\": \"Kallikkattil\",\n                      \"gender\": \"0\",\n                      \"fitness_status\": \"0\",\n                      \"goal\": \"0\",\n                      \"image\": \"2_1447242011.jpg\",\n                      \"city\": \"\",\n                      \"state\": \"\",\n                      \"country\": \"\",\n                      \"quote\": \"\",\n                      \"created_at\": \"2015-11-11 11:40:10\",\n                      \"updated_at\": \"2015-11-11 11:40:11\"\n                  }\n              }\n          }\n      ],\n      \"urls\": {\n          \"profileImageSmall\": \"http://localhost:8000/uploads/images/profile/small\",\n          \"profileImageMedium\": \"http://localhost:8000/uploads/images/profile/medium\",\n          \"profileImageLarge\": \"http://localhost:8000/uploads/images/profile/large\",\n          \"profileImageOriginal\": \"http://localhost:8000/uploads/images/profile/original\",\n          \"video\": \"http://localhost:8000/uploads/videos\",\n          \"feedImageSmall\": \"http://localhost:8000/uploads/images/feed/small\",\n          \"feedImageMedium\": \"http://localhost:8000/uploads/images/feed/medium\",\n          \"feedImageLarge\": \"http://localhost:8000/uploads/images/feed/large\",\n          \"feedImageOriginal\": \"http://localhost:8000/uploads/images/feed/original\"\n      }\n  }",
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
            "field": "user_not_verified",
            "description": "<p>User error.</p> "
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "invalid_credentials",
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
          "content": "HTTP/1.1 422 cannot_able_to_delete_this_video\n{\n  \"error\": \"cannot_able_to_delete_this_video\"\n}",
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
    "url": "password/emai",
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
          "content": "HTTP/1.1 200 OK\n{\n     \"success\": \"successfully_sent_email_to_your_email_address\",\n     \"email\": \"aneeshk@cubettech.com\"\n }",
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
          "content": "HTTP/1.1 401 invalid_email\n{\n     \"error\": \"invalid_email\"\n     \"email\": \"aneeshk@cubettech.com\"\n}",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "app/Http/Controllers/Api/PasswordController.php",
    "groupTitle": "password"
  }
] });