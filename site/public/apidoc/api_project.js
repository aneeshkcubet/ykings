define({
  "name": "Ykings Api",
  "version": "1.0.0",
  "description": "Ykings Api Project",
  "title": "Api Documentation for Ykings Api",
  "url": "http://sandbox.ykings.com/api",
  "header": {
    "title": "My own header title",
    "content": "<h2>API Endpoint</h2>\n<p>Your API Endpoint is http://sandbox.ykings.com/api.</p>\n"
  },
  "footer": {
    "title": "My own footer title",
    "content": "<p>#How to authenticate via token?</p>\n<p>Suppose your API call is http://sandbox.ykings.com/api/users then add you token as query parameter to the url. To get auth token tou have to post http://sandbox.ykings.com/api/authenticate.</p>\n<p>eg. http://sandbox.ykings.com/api/users?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOiIxIiwiaXNzIjoiaHR0cDpcL1wvc2FuZGJveC55a2luZ3MuY29tXC9hcGlcL2F1dGhlbnRpY2F0ZSIsImlhdCI6IjE0NDY2Mzk0NjEiLCJleHAiOiIxNDQ2NjQzMDYxIiwibmJmIjoiMTQ0NjYzOTQ2MSIsImp0aSI6IjNjMTQ4M2IwMzIyNWJiNmJkMzY1ZDEzZjYwZWJhYzI0In0.DDkmO2tA4LXj59PA50X6a3-dPqyq6tjYCLvVuPm6UNY</p>\n"
  },
  "order": [
    "GetUser",
    "PostUser"
  ],
  "template": {
    "withCompare": false,
    "withGenerator": true
  },
  "sampleUrl": false,
  "apidoc": "0.2.0",
  "generator": {
    "name": "apidoc",
    "time": "2015-12-11T11:07:49.889Z",
    "url": "http://apidocjs.com",
    "version": "0.13.1"
  }
});