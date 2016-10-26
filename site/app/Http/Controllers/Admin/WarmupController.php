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
use App\Musclegroup;
use App\Warmup;
use App\User;

class WarmupController extends Controller
{

    public function __construct()
    {
        $this->middleware('admin');
    }

    /**
     * Index page
     * @since 14/01/2015
     * @author aneeshk@cubettech.com
     * @return json
     */
    public function getIndex()
    {
        // Grab all the users
        $warmup = Warmup::get();

        $user = User::where('id', Auth::user()->id)->with(['profile', 'settings'])->first();

        // Show the page
        return View('admin.warmup.index', compact('warmup', 'user'));
    }

    /**
     * Warmup create get form.
     * @since 14/01/2015
     * @author aneeshk@cubettech.com
     * @return json
     */
    public function getCreate()
    {
        $user = User::where('id', Auth::user()->id)->with(['profile', 'settings'])->first();

        // Show the page
        return View('admin.warmup.create', compact('user'));
    }

    /**
     * Warmup create form processing.
     * @since 14/01/2015
     * @author aneeshk@cubettech.com
     * @return json
     */
    public function postCreate(Request $request)
    {

        $warmup = Warmup::create([
                'name' => Input::get('name'),
                'duration' => json_encode(Input::get('duration')),
                'unit' => Input::get('unit')
        ]);

        if (!is_null($warmup)) {

            // Redirect to the home page with success menu
            return Redirect::route("admin.warmups")->with('success', 'Successfully created warmup.');
        }

        // Redirect to the warmup creation page
        return Redirect::back()->withInput()->with('error', $error);
    }

    /**
     * View page
     * @since 14/01/2015
     * @author aneeshk@cubettech.com
     * @return json
     */
    public function show($id)
    {
        $warmup = Warmup::where('id', $id)->first();
        // Get the user information
        if (!is_null($warmup)) {

            $user = User::where('id', Auth::user()->id)->with(['profile', 'settings'])->first();
        } else {
            // Prepare the error message
            $error = 'Warmup not found';

            // Redirect to the user management page
            return Redirect::route('admin.warmups')->with('error', $error);
        }
        // Show the page
        return View('admin.warmup.show', compact('warmup', 'user'));
    }

    /**
     * Warmup Edit page
     * @since 14/01/2015
     * @author aneeshk@cubettech.com
     * @return json
     */
    public function getEdit($id = null)
    {


        $warmup = Warmup::where('id', $id)->first();

        // Get the user information
        if (!is_null($warmup)) {
            $user = User::where('id', Auth::user()->id)->with(['profile', 'settings'])->first();

            return View('admin.warmup.edit', compact('warmup', 'user', 'muscleGroups'));
        } else {
            // Prepare the error message
            $error = 'Warmup not found';

            // Redirect to the user management page
            return Redirect::route('admin.warmups')->with('error', $error);
        }

        // Show the page
        return View('admin.warmup.edit', compact('user', 'warmup', 'muscleGroups'));
    }

    /**
     * Warmup Post Edit page
     * @since 14/01/2015
     * @author aneeshk@cubettech.com
     * @return json
     */
    public function postEdit(Request $request, $id = null)
    {
        $warmup = Warmup::where('id', $id)->first();

        if (!is_null($warmup)) {
            Warmup::where('id', $id)->update([
                'name' => Input::get('name'),
                'duration' => json_encode(Input::get('duration')),
                'unit' => Input::get('unit')
            ]);

            return Redirect::route('admin.warmups')->with('success', 'Updated successfully');
        } else {

            return Redirect::route('admin.warmups', $id)->withInput()->with('error', 'Warmup not found!');
        }
        // Redirect to the user page
    }

    /**
     * Warmup Delete
     * @since 14/01/2015
     * @author aneeshk@cubettech.com
     * @return json
     */
    public function getDelete($id = null)
    {
        $warmup = Warmup::where('id', $id)->first();

        if (is_null($warmup)) {

            $error = 'Warmup does not exists.';

            Redirect::route("admin.warmups")->with('error', $error);
        }

        Warmup::where('id', $id)->delete();

        return Redirect::route("admin.warmups")->with('success', 'Successfully deleted warmup.');
    }

    /**
     * Warmup Delete
     * @since 14/01/2015
     * @author aneeshk@cubettech.com
     * @return json
     */
    public function getModalDelete($id = null)
    {
        $model = 'warmups';

        $confirm_route = $error = null;

        $entity = 'warmup';

        $warmup = Warmup::where('id', $id)->first();

        if (is_null($warmup)) {
            $error = 'Warmup does not exists.';
            return View('admin/layouts/modal_confirmation', compact('error', 'model', 'confirm_route', 'entity'));
        }

        $confirm_route = route('admin.warmup.delete', ['id' => $id]);

        return View('admin/layouts/modal_confirmation', compact('error', 'model', 'confirm_route', 'entity'));
    }
}
