<?php namespace App\Http\Controllers\Admin;

use Auth;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use JWTAuth;
use App\User;
use App\Feeds;
use App\Subscription;
use Carbon\Carbon;
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

            $date = date("Y-m-d");

            $dateDayBack = date("Y-m-d H:i:s", strtotime($date . " -1 day"));

            $dateWeekBack = date("Y-m-d H:i:s", strtotime($date . " -1 week"));

            $dateMonthBack = date("Y-m-d H:i:s", strtotime($date . " -1 month"));

            $activities = [
                'last_day' => Feeds::where('created_at', '>', $dateDayBack)->count(),
                'last_week' => Feeds::where('created_at', '>', $dateWeekBack)->count(),
                'last_month' => Feeds::where('created_at', '>', $dateMonthBack)->count()
            ];

            $activeUsers = [
                'last_day' => User::where('created_at', '>', $dateDayBack)->where('status', 1)->count(),
                'last_week' => User::where('created_at', '>', $dateWeekBack)->where('status', 1)->count(),
                'last_month' => User::where('created_at', '>', $dateMonthBack)->where('status', 1)->count()
            ];

            $subscriptions = [
                'last_day' => Subscription::where('created_at', '>', $dateDayBack)->count(),
                'last_week' => Subscription::where('created_at', '>', $dateWeekBack)->count(),
                'last_month' => Subscription::where('created_at', '>', $dateMonthBack)->count()
            ];

            $registeredUsers = [
                'last_day' => User::where('created_at', '>', $dateDayBack)->count(),
                'last_week' => User::where('created_at', '>', $dateWeekBack)->count(),
                'last_month' => User::where('created_at', '>', $dateMonthBack)->count()
            ];

            return View('admin.dashboard.index', compact(
                    'user', 'activities', 'activeUsers', 'subscriptions', 'registeredUsers'));
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
            if (Auth::user()->status == 1 && Auth::user()->is_admin == 1) {
                return Redirect::route("admin.index")->with('success', 'Succesfully loggedin as Admin');
            } else {
                Auth::logout();
                return Redirect::route("admin.getlogin")->with('error', 'You are not an admininistrator!!');
                ;
            }
        } else {
            return Redirect::route("admin.getlogin")->with('error', 'Invalid Credentials');
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
