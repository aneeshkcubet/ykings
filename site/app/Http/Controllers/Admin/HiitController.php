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
use App\Hiit;
use App\User;

class HiitController extends Controller
{
    
    public function __construct()
    {        
        $this->middleware('admin');
    }

    /**
     * Index page
     * @since 21/01/2015
     * @author aneeshk@cubettech.com
     * @return json
     */
    public function getIndex()
    {
        // Grab all the users
        $hiit = Hiit::get();

        $user = User::where('id', Auth::user()->id)->with(['profile', 'settings'])->first();

        // Show the page
        return View('admin.hiit.index', compact('hiit', 'user'));
    }

    /**
     * Hiit create get form.
     * @since 21/01/2015
     * @author aneeshk@cubettech.com
     * @return json
     */
    public function getCreate()
    {
        $user = User::where('id', Auth::user()->id)->with(['profile', 'settings'])->first();

        // Show the page
        return View('admin.hiit.create', compact('user'));
    }

    /**
     * Hiit create form processing.
     * @since 21/01/2015
     * @author aneeshk@cubettech.com
     * @return json
     */
    public function postCreate(Request $request)
    {
        $hiit = Hiit::create([
                'name' => Input::get('name'),
                'description' => Input::get('description'),
                'rewards' => Input::get('rewards')
        ]);

        if (!is_null($hiit)) {

            // Redirect to the home page with success menu
            return Redirect::route("admin.hiits")->with('success', 'Successfully created hiit.');
        }

        // Redirect to the hiit creation page
        return Redirect::back()->withInput()->with('error', $error);
    }

    /**
     * View page
     * @since 21/01/2015
     * @author aneeshk@cubettech.com
     * @return json
     */
    public function show($id)
    {
        $hiit = Hiit::where('id', $id)->first();
        if (!is_null($hiit)) {
            $user = User::where('id', Auth::user()->id)->with(['profile', 'settings'])->first();
        } else {
            // Prepare the error message
            $error = 'Hiit not found';

            // Redirect to the user management page
            return Redirect::route('admin.hiits')->with('error', $error);
        }
        // Show the page
        return View('admin.hiit.show', compact('hiit', 'user'));
    }

    /**
     * Hiit Edit page
     * @since 21/01/2015
     * @author aneeshk@cubettech.com
     * @return json
     */
    public function getEdit($id = null)
    {
        $hiit = Hiit::where('id', $id)->first();
        // Get the user information
        if (!is_null($hiit)) {
            $user = User::where('id', Auth::user()->id)->with(['profile', 'settings'])->first();
            
            return View('admin.hiit.edit', compact('hiit', 'user'));
        } else {
            // Prepare the error message
            $error = 'Hiit not found';

            // Redirect to the user management page
            return Redirect::route('admin.hiits')->with('error', $error);
        }

        // Show the page
        return View('admin.hiit.edit', compact('user', 'hiit'));
    }

    /**
     * Hiit Post Edit page
     * @since 21/01/2015
     * @author aneeshk@cubettech.com
     * @return json
     */
    public function postEdit(Request $request, $id = null)
    {

        $hiit = Hiit::where('id', $id)->first();

        if (!is_null($hiit)) {
            Hiit::where('id', $id)->update([
                'name' => Input::get('name'),
                'description' => Input::get('description'),
                'rewards' => Input::get('rewards')                
            ]);

            return Redirect::route('admin.hiits')->with('success', 'Updated successfully');
        } else {

            return Redirect::route('admin.hiits', $id)->withInput()->with('error', 'Hiit not found!');
        }
        // Redirect to the user page
    }

    /**
     * Hiit Delete
     * @since 21/01/2015
     * @author aneeshk@cubettech.com
     * @return json
     */
    public function getDelete($id = null)
    {
        $hiit = Hiit::where('id', $id)->first();

        if (is_null($hiit)) {

            $error = 'Hiit does not exists.';

            Redirect::route("admin.hiits")->with('error', $error);
        }

        Hiit::where('id', $id)->delete();

        return Redirect::route("admin.hiits")->with('success', 'Successfully deleted hiit.');
    }

    /**
     * Hiit Delete
     * @since 21/01/2015
     * @author aneeshk@cubettech.com
     * @return json
     */
    public function getModalDelete($id = null)
    {
        $model = 'hiits';

        $confirm_route = $error = null;

        $entity = 'hiit';

        $hiit = Hiit::where('id', $id)->first();

        if (is_null($hiit)) {
            $error = 'Hiit does not exists.';
            return View('admin/layouts/modal_confirmation', compact('error', 'model', 'confirm_route', 'entity'));
        }

        $confirm_route = route('admin.hiit.delete', ['id' => $id]);

        return View('admin/layouts/modal_confirmation', compact('error', 'model', 'confirm_route', 'entity'));
    }
}
