<?php namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Mail\Message;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class PasswordController extends Controller
{
    /*
      |--------------------------------------------------------------------------
      | Password Reset Controller
      |--------------------------------------------------------------------------
      |
      | This controller is responsible for handling password reset requests
      | and uses a simple trait to include this behavior. You're free to
      | explore this trait and override any methods you wish to tweak.
      |
     */

    /**
     * Create a new password controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('jwt.auth');
    }

    /**
     * @api {post} /password/email RequestPassword
     * @apiName RequestPassword
     * @apiGroup password
     *
     * @apiParam {string} email email address of user *required
     *
     * @apiSuccess {String} success.
     *
     * @apiSuccessExample Success-Response:
     *     HTTP/1.1 200 OK
     *     {
     *          "status" : 1,
     *          "success": "successfully_sent_email_to_your_email_address",
     *          "email": "aneeshk@cubettech.com"
     *      }
     *
     * @apiError error Message token_invalid.
     * @apiError error Message token_expired.
     * @apiError invalid_email User error.
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
     *      "status" : 0,
     *       "error": "token_not_provided"
     *     }
     *
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 422 email_reqired
     *     {
     *          "status" : 0,
     *          "error": "email field is required"
     *          "email": "aneeshk@cubettech.com"
     *     }  
     * 
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 500 invalid_email
     *     {
     *          "status" : 0,
     *          "error": "invalid_email"
     *          "email": "aneeshk@cubettech.com"
     *     }
     *      
     */
    public function postEmail(Request $request)
    {
        if (!isset($request->email)) {
            return response()->json(['status' => 0, 'error' => 'email field is required'], 422);
        }

        $response = Password::sendResetLink($request->only('email'), function (Message $message) {
                $message->subject($this->getEmailSubject());
            });

        switch ($response) {
            case Password::RESET_LINK_SENT:
                return response()->json(['status' => 1, 'success' => 'Successfully sent email to your email.', 'email' => $request->input('email')], 200);

            case Password::INVALID_USER:
                return response()->json(['status' => 0, 'error' => 'invalid_email', 'email' => $request->input('email')], 500);
        }
    }

    /**
     * Get the e-mail subject line to be used for the reset link email.
     *
     * @return string
     */
    protected function getEmailSubject()
    {
        return property_exists($this, 'subject') ? $this->subject : 'Your Password Reset Link';
    }

    /**
     * Display the password reset view for the given token.
     *
     * @param  string  $token
     * @return \Illuminate\Http\Response
     */
    public function getReset($token = null)
    {
        if (is_null($token)) {
            throw new NotFoundHttpException;
        }

        return view('auth.reset')->with('token', $token);
    }

    /**
     * Reset the given user's password.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postReset(Request $request)
    {
        $this->validate($request, [
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:6',
        ]);

        $credentials = $request->only(
            'email', 'password', 'password_confirmation', 'token'
        );

        $response = Password::reset($credentials, function ($user, $password) {
                $this->resetPassword($user, $password);
            });

        switch ($response) {
            case Password::PASSWORD_RESET:
                return redirect($this->redirectPath())->with('status', trans($response));

            default:
                return redirect()->back()
                        ->withInput($request->only('email'))
                        ->withErrors(['email' => trans($response)]);
        }
    }

    /**
     * Reset the given user's password.
     *
     * @param  \Illuminate\Contracts\Auth\CanResetPassword  $user
     * @param  string  $password
     * @return void
     */
    protected function resetPassword($user, $password)
    {
        $user->password = Hash::make($password);

        $user->save();
    }

    /**
     * Get the post register / login redirect path.
     *
     * @return string
     */
    public function redirectPath()
    {
        if (property_exists($this, 'redirectPath')) {
            return $this->redirectPath;
        }

        return property_exists($this, 'redirectTo') ? $this->redirectTo : '/';
    }
}
