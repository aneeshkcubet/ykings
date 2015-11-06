define({ "api": [
  {
    "type": "post",
    "url": "/authenticate",
    "title": "Get JW token",
    "name": "Athenticate",
    "group": "General",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "<p>number</p> ",
            "optional": false,
            "field": "id",
            "description": "<p>user id of the user</p> "
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
            "description": "<p>Firstname of user *optional</p> "
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
            "type": "<p>string</p> ",
            "optional": false,
            "field": "password_confirmation",
            "description": "<p>password confirmation added by user *required</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>number</p> ",
            "optional": false,
            "field": "gender",
            "description": "<p>user id of the user 1-Male, 2-Female *required</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>number</p> ",
            "optional": false,
            "field": "fitness_status",
            "description": "<p>user's self assessment about fitness 1-I am definitely fit, 2-I am quite fit, 3-I am not so fit *required</p> "
          },
          {
            "group": "Parameter",
            "type": "<p>number</p> ",
            "optional": false,
            "field": "goal",
            "description": "<p>user's goal *required</p> "
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
          "content": "HTTP/1.1 200 OK\n{\n  \n}",
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
    "filename": "app/Http/Controllers/Api/UsersController.php",
    "groupTitle": "User"
  }
] });