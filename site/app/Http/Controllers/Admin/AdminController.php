<?php namespace App\Http\Controllers\Admin;

use Auth;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use JWTAuth;
use App\User;
use Redirect;

class AdminController extends Controller
{

    /**
     * Admin index.
     * @since 04/01/2015
     * @author ansa@cubettech.com
     * @return json
     */
    public function index()
    {
        if (Auth::user()) {
            $user = User::where('id', '=', Auth::user()->id)->with(['profile'])->first();
            $user = $user->toArray();
            return View('admin.dashboard.index', compact('user'));
        } else {
            return Redirect::route("admin.getlogin");
        }
    }

    /**
     * Admin get login.
     * @since 04/01/2015
     * @author ansa@cubettech.com
     * @return json
     */
    public function getLogin()
    {
        return view('admin.login');
    }

    /**
     * Admin post login.
     * @since 04/01/2015
     * @author ansa@cubettech.com
     * @return json
     */
    public function postLogin(Request $request)
    {
        $data = $request->all();
        if (Auth::attempt([ 'email' => $data['email'], 'password' => $data['password']])) {
            // Authentication passed...
            if (Auth::user()->status == 1) {
                return Redirect::route("admin.index")->with('success', 'Succesfully loggedin as Admin');
            }
        } else {
            return view('admin.login');
        }
    }

    /**
     * Logout.
     * @since 04/01/2015
     * @author ansa@cubettech.com
     * @return json
     */
    public function logout()
    {
        Auth::logout();
        return Redirect::route("admin.getlogin");
    }
}
