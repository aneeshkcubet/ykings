<?php namespace App\Http\Controllers\Admin;

use Validator,
    Hash,
    Mail,
    Auth,
    Image,
    Redirect,
    DB,
    Input,
    Lang;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use App\Profile;
use App\Refferal;
use App\Point;
use Yajra\Datatables\Datatables;

class SettingController extends Controller
{

    public function __construct()
    {
        $this->middleware('admin');
    }

    /**
     * Plan Edit page
     * @since 14/01/2015
     * @author aneeshk@cubettech.com
     * @return json
     */
    public function getEdit()
    {
        $settings = DB::table('site_settings')->get();
        // Get the user information
        if (!is_null($settings)) {
            $user = User::where('id', Auth::user()->id)->with(['profile', 'settings'])->first();

            return View('admin.setting.edit', compact('settings', 'user'));
        } else {
            return View('admin.setting.edit', compact('user'));
        }
    }

    /**
     * Plan Post Edit page
     * @since 14/01/2015
     * @author aneeshk@cubettech.com
     * @return json
     */
    public function postEdit(Request $request)
    {
        $inputArray = $request->except('_token');

        foreach ($inputArray as $iKey => $input) {
            DB::table('site_settings')->where('key', $iKey)->update(['value' => $input]);
        }

        return Redirect::route('admin.settings.edit')->with('success', 'Settings updated successfully');

        // Redirect to the user page
    }

    public function refferalIndex()
    {
        $user = User::where('id', Auth::user()->id)->with(['profile', 'settings'])->first();

        // Show the page
        return View('admin.refferals.index', ['user' => $user]);
    }

    /**
     * Process datatables ajax request.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function anyData()
    {
        $posts = DB::table('refferals')
            ->select(['id', 'user_id', 'email', 'marketing_title', 'parameters']);

        return Datatables::of($posts)
                ->addColumn('is_coach_subscribed', function ($list) {
                    $profile = User::where('email', $list->email)->first();
                    if (!is_null($profile)) {
                        if ($profile->is_subscribed == 1) {
                            return 'Yes';
                        } else {
                            return 'No';
                        }
                    } else {
                        return 'No';
                    }
                })
                ->make(true);
    }
}
