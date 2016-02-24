#How to authenticate via token?

Suppose your API call is http://sandbox.ykings.com/api/users then add you token as query parameter to the url. 
To get auth token you have to login to the app.

Once your token has been expired you need to refresh token using POST

POST http://sandbox.ykings.com/api/authenticate.

Parameters:- token => [old token that has already expired]

eg. http://sandbox.ykings.com/api/users?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOiIxIiwiaXNzIjoiaHR0cDpcL1wvc2FuZGJveC55a2luZ3MuY29tXC9hcGlcL2F1dGhlbnRpY2F0ZSIsImlhdCI6IjE0NDY2Mzk0NjEiLCJleHAiOiIxNDQ2NjQzMDYxIiwibmJmIjoiMTQ0NjYzOTQ2MSIsImp0aSI6IjNjMTQ4M2IwMzIyNWJiNmJkMzY1ZDEzZjYwZWJhYzI0In0.DDkmO2tA4LXj59PA50X6a3-dPqyq6tjYCLvVuPm6UNY
