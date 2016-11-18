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
      | Newsletter Controller
      |--------------------------------------------------------------------------
      |
      |
     */

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Function to unsubscibe newsletter from email
     * @param type $code
     * @return type
     */
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
