<?php namespace App\Http\Controllers\Auth;

use Validator,
    Redirect;
use App\Http\Controllers\Controller;
use App\User;
use App\Profile;
use App\Settings;

class NewsletterController extends Controller
{
    /*
      |--------------------------------------------------------------------------
      | Registration & Login Controller
      |--------------------------------------------------------------------------
      |
      | This controller handles the registration of new users, as well as the
      | authentication of existing users. By default, this controller uses
      | a simple trait to add these behaviors. Why don't you explore it?
      |
     */

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'getLogout']);
    }

    protected function unsubscribe($code = null)
    {

        if ($code == null) {
            $error = 'Code not found';
        } else {

            $codeRaw = base64_decode($code);

            $codeArray = explode('_', $codeRaw);
            
            $user = User::where('id', $codeArray[1])->first();

            if (is_null($user)) {
                $error = 'User not found';
            } else {
                Settings::where('user_id', $codeArray[1])->where('key', '=', 'subscription')->delete();
                return Redirect::to('/')->with('success', 'Successfully unsubscribed newsletter.');
            }
        }
        return Redirect::to('/')->with('error', $error);
    }
}
