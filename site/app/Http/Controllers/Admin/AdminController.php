<?php namespace App\Http\Controllers\Admin;

use Auth,
    DB,
    Image;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use JWTAuth;
use App\User;
use App\Profile;
use App\Settings;
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

    public function migrateUsers()
    {
        $lastInsertId = DB::connection('mysql')->table('site_settings')->where('key', 'last_migrated_user')->pluck('value');
        $users = DB::connection('mysql2')->table('users')->select('*')->where('id', '>', $lastInsertId)->where('email', '!=', '')->where('email', '!=', '(null)')->get();
        foreach ($users as $uKey => $user) {
            $userExists = DB::connection('mysql')->table('users')->where('email', '=', $user->email)->first();
            if (is_null($userExists)) {
                $profile = DB::connection('mysql2')->table('user_profiles')->select('*')->where('user_id', $user->id)->first();

                if (!is_null($profile)) {
                    DB::connection('mysql')->table('users')->insert([
                        'email' => $user->email,
                        'password' => $user->password,
                        'remember_token' => $user->remember_token,
                        'confirmation_code' => $user->confirmation_code,
                        'status' => $user->status,
                        'is_featured' => $user->is_featured,
                        'is_admin' => $user->is_admin,
                        'is_subscribed_backend' => $user->is_subscribed_backend,
                        'referral_code' => $user->referral_code,
                        'created_at' => $user->created_at,
                        'updated_at' => $user->updated_at,
                    ]);


                    $nUser = DB::connection('mysql')->table('users')->select('*')->where('email', '=', $user->email)->orderBy('id', 'desc')->first();

                    $nProfile = DB::connection('mysql')->table('user_profiles')->insert(array(
                        'user_id' => $nUser->id,
                        'first_name' => $profile->first_name,
                        'last_name' => $profile->last_name,
                        'gender' => $profile->gender,
                        'fitness_status' => $profile->fitness_status,
                        'goal' => $profile->goal,
                        'image' => $profile->image,
                        'cover_image' => $profile->cover_image,
                        'country' => $profile->country,
                        'state' => $profile->state,
                        'city' => $profile->city,
                        'spot' => $profile->spot,
                        'quote' => $profile->quote,
                        'facebook' => $profile->facebook,
                        'twitter' => $profile->twitter,
                        'instagram' => $profile->instagram,
                        'created_at' => $profile->created_at,
                        'updated_at' => $profile->updated_at,
                    ));
                    $newsSubscription = DB::connection('mysql2')->table('user_settings')->select('*')->where('user_id', $user->id)->where('key', 'subscription')->first();

                    if (!is_null($newsSubscription)) {
                        DB::connection('mysql')->table('user_settings')->insert([
                            'user_id' => $nUser->id,
                            'key' => 'subscription',
                            'value' => $newsSubscription->value,
                            'created_at' => $newsSubscription->created_at,
                            'updated_at' => $newsSubscription->updated_at,
                        ]);
                    }

                    $notSubscription = DB::connection('mysql2')->table('user_settings')->select('*')->where('user_id', $user->id)->where('key', 'notification')->first();

                    if (!is_null($notSubscription)) {
                        DB::connection('mysql')->table('user_settings')->insert([
                            'user_id' => $nUser->id,
                            'key' => 'notification',
                            'value' => $notSubscription->value,
                            'created_at' => $notSubscription->created_at,
                            'updated_at' => $notSubscription->updated_at,
                        ]);
                    }

                    $subscription = DB::connection('mysql2')->table('subscriptions')->select('*')->where('user_id', $user->id)->orderBy('id', 'desc')->first();

                    if (!is_null($subscription)) {
                        DB::connection('mysql')->table('subscriptions')->insert([
                            'user_id' => $nUser->id,
                            'plan_id' => $subscription->plan_id,
                            'amount' => $subscription->amount,
                            'currency' => $subscription->currency,
                            'transaction_id' => $subscription->transaction_id,
                            'start_time' => $subscription->start_time,
                            'end_time' => $subscription->end_time,
                            'details' => $subscription->details,
                            'status' => $subscription->status,
                            'created_at' => $subscription->created_at,
                            'updated_at' => $subscription->updated_at,
                        ]);
                    }

                    $usersocialaccounts = DB::connection('mysql2')->table('user_social_accounts')->select('*')->where('user_id', $user->id)->orderBy('id', 'desc')->first();
                    if (!is_null($usersocialaccounts)) {
                        DB::connection('mysql')->table('user_social_accounts')->insert([
                            'user_id' => $nUser->id,
                            'provider' => $usersocialaccounts->provider,
                            'provider_uid' => $usersocialaccounts->provider_uid,
                            'created_at' => $usersocialaccounts->created_at,
                            'updated_at' => $usersocialaccounts->updated_at,
                        ]);
                    }
                }
            } else {
                $newsSubscription = DB::connection('mysql2')->table('user_settings')->select('*')->where('user_id', $user->id)->where('key', 'subscription')->first();

                if (!is_null($newsSubscription)) {
                    $newsSubscriptionExists = DB::connection('mysql')->table('user_settings')->where('user_id', $userExists->id)->where('key', 'subscription')->first();

                    if (is_null($newsSubscriptionExists)) {
                        DB::connection('mysql')->table('user_settings')->insert([
                            'user_id' => $userExists->id,
                            'key' => 'subscription',
                            'value' => $newsSubscription->value,
                            'created_at' => $newsSubscription->created_at,
                            'updated_at' => $newsSubscription->updated_at,
                        ]);
                    } else {
                        DB::connection('mysql')->table('user_settings')->where('user_id', $userExists->id)->update([
                            'key' => 'subscription',
                            'value' => $newsSubscription->value,
                            'created_at' => $newsSubscription->created_at,
                            'updated_at' => $newsSubscription->updated_at,
                        ]);
                    }
                }

                $notSubscription = DB::connection('mysql2')->table('user_settings')->select('*')->where('user_id', $user->id)->where('key', 'notification')->first();

                if (!is_null($notSubscription)) {
                    $notSubscriptionExists = DB::connection('mysql')->table('user_settings')->where('user_id', $userExists->id)->where('key', 'notification')->first();
                    if (is_null($notSubscriptionExists)) {
                        DB::connection('mysql')->table('user_settings')->insert([
                            'user_id' => $userExists->id,
                            'key' => 'notification',
                            'value' => $notSubscription->value,
                            'created_at' => $notSubscription->created_at,
                            'updated_at' => $notSubscription->updated_at,
                        ]);
                    } else {
                        DB::connection('mysql')->table('user_settings')->where('user_id', $userExists->id)->update([
                            'key' => 'notification',
                            'value' => $notSubscription->value,
                            'created_at' => $notSubscription->created_at,
                            'updated_at' => $notSubscription->updated_at,
                        ]);
                    }
                }

                $subscription = DB::connection('mysql2')->table('subscriptions')->select('*')->where('user_id', $user->id)->orderBy('id', 'desc')->first();

                if (!is_null($subscription)) {
                    $subscriptionExists = DB::connection('mysql')->table('subscriptions')->select('*')->where('user_id', $userExists->id)->orderBy('id', 'desc')->first();
                    if (is_null($subscriptionExists)) {
                        DB::connection('mysql')->table('subscriptions')->insert([
                            'user_id' => $userExists->id,
                            'plan_id' => $subscription->plan_id,
                            'amount' => $subscription->amount,
                            'currency' => $subscription->currency,
                            'transaction_id' => $subscription->transaction_id,
                            'start_time' => $subscription->start_time,
                            'end_time' => $subscription->end_time,
                            'details' => $subscription->details,
                            'status' => $subscription->status,
                            'created_at' => $subscription->created_at,
                            'updated_at' => $subscription->updated_at,
                        ]);
                    } else {
                        DB::connection('mysql')->table('subscriptions')->where('user_id', $userExists->id)->update([
                            'plan_id' => $subscription->plan_id,
                            'amount' => $subscription->amount,
                            'currency' => $subscription->currency,
                            'transaction_id' => $subscription->transaction_id,
                            'start_time' => $subscription->start_time,
                            'end_time' => $subscription->end_time,
                            'details' => $subscription->details,
                            'status' => $subscription->status,
                            'created_at' => $subscription->created_at,
                            'updated_at' => $subscription->updated_at,
                        ]);
                    }
                }

                $usersocialaccounts = DB::connection('mysql2')->table('user_social_accounts')->select('*')->where('user_id', $user->id)->orderBy('id', 'desc')->first();
                if (!is_null($usersocialaccounts)) {
                    $socialExists = DB::connection('mysql')->table('user_social_accounts')->select('*')->where('user_id', $userExists->id)->orderBy('id', 'desc')->first();
                    if (is_null($socialExists)) {
                        DB::connection('mysql')->table('user_social_accounts')->insert([
                            'user_id' => $userExists->id,
                            'provider' => $usersocialaccounts->provider,
                            'provider_uid' => $usersocialaccounts->provider_uid,
                            'created_at' => $usersocialaccounts->created_at,
                            'updated_at' => $usersocialaccounts->updated_at,
                        ]);
                    } else {
                        DB::connection('mysql')->table('user_social_accounts')->where('user_id', $userExists->id)->update([
                            'provider' => $usersocialaccounts->provider,
                            'provider_uid' => $usersocialaccounts->provider_uid,
                            'created_at' => $usersocialaccounts->created_at,
                            'updated_at' => $usersocialaccounts->updated_at,
                        ]);
                    }
                }
            }
            $lastMigratedUserId = $user->id;
            DB::connection('mysql')->table('site_settings')->where('key', 'last_migrated_user')->update(['value' => $lastMigratedUserId]);
        }
        echo 'Completed';
    }
}
