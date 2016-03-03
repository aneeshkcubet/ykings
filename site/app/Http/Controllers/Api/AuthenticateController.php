<?php namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\User;

class AuthenticateController extends Controller
{

    public function __construct()
    {
        // Apply the jwt.auth middleware to all methods in this controller
        // except for the authenticate method. We don't want to prevent
        // the user from retrieving their token if they don't already have it
        $this->middleware('jwt.auth', ['except' => ['authenticate']]);
    }

    public function index()
    {
        // Retrieve all the users in the database and return them
        $users = User::all();
        return $users;
    }

    /**
     * @api {post} authenticate RefreshToken
     * @apiName RefreshToken
     * @apiGroup General
     * 
     * @apiParam {String} token expired token *required
     *
     * @apiSuccess {String} token JWT Auth token.
     *
     * @apiSuccessExample Success-Response:
     *     HTTP/1.1 200 OK
     *     {
     *       "status" : 1,
     *       "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOiIxIiwiaXNzIjoiaHR0cDpcL1wvc2FuZGJveC55a2luZ3MuY29tXC9hcGlcL2F1dGhlbnRpY2F0ZSIsImlhdCI6IjE0NDY2MzMwNzgiLCJleHAiOiIxNDQ2NjM2Njc4IiwibmJmIjoiMTQ0NjYzMzA3OCIsImp0aSI6ImFiNDAwNTllZmU0OTI3ODYwMTczYjI1ZGEzZWJmMDkwIn0.uM_G0OAne9b-twd60tAZlAUGmpitINP0JMgGC3ZrNoo",
     *     }
     * 
     * @apiError Validation Error
     * @apiError invalid_credentials Message invalid_credentials.
     * @apiError could_not_create_token JWT error.
     * 
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 422 Validation error
     *     {
     *       "status" : 0,
     *       "error": "The token field is required"
     *     }
     *
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 404 invalid_credentials
     *     {
     *       "status" : 0,
     *       "error": "invalid_credentials"
     *     }
     * 
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 500 could_not_create_token
     *     {
     *       "status" : 0,
     *       "error": "could_not_create_token"
     *     }
     */
    public function authenticate(Request $request)
    {
        if (!isset($request->token) || ($request->token == null)) {
            return response()->json(["status" => "0", "error" => "The token field is required"]);
        }

        try {
            // verify the credentials and create a token for the user
            if (!$token = JWTAuth::refresh($request->token)) {
                return response()->json(['status' => 0, 'error' => 'invalid_credentials'], 401);
            }
        } catch (JWTException $e) {
            // something went wrong
            return response()->json(['status' => 0, 'error' => 'could_not_refresh_token'], 500);
        }

        // if no errors are encountered we can return a JWT
        return response()->json(['status' => 1, 'token' => $token], 200);
    }
}
