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
use App\Stretching;
use App\User;

class StretchingController extends Controller
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
        $stretching = Stretching::get();

        $user = User::where('id', Auth::user()->id)->with(['profile', 'settings'])->first();

        // Show the page
        return View('admin.stretching.index', compact('stretching', 'user'));
    }

    /**
     * Stretching create get form.
     * @since 14/01/2015
     * @author aneeshk@cubettech.com
     * @return json
     */
    public function getCreate()
    {
        $user = User::where('id', Auth::user()->id)->with(['profile', 'settings'])->first();


        // Show the page
        return View('admin.stretching.create', compact('user'));
    }

    /**
     * Stretching create form processing.
     * @since 14/01/2015
     * @author aneeshk@cubettech.com
     * @return json
     */
    public function postCreate(Request $request)
    {       

        $stretching = Stretching::create([
                'exercise_id' => Input::get('name'),                
                'duration' => json_encode(Input::get('duration')),
                'unit' => Input::get('unit')                
        ]);

        if (!is_null($stretching)) { 
            
            // Redirect to the home page with success menu
            return Redirect::route("admin.stretchings")->with('success', 'Successfully created stretching.');
        }

        // Redirect to the stretching creation page
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
        $stretching = Stretching::where('id', $id)->first();        
        // Get the user information
        if (!is_null($stretching)) {
            
            $user = User::where('id', Auth::user()->id)->with(['profile', 'settings'])->first();
            
        } else {
            // Prepare the error message
            $error = 'Stretching not found';

            // Redirect to the user management page
            return Redirect::route('admin.stretchings')->with('error', $error);
        }
        // Show the page
        return View('admin.stretching.show', compact('stretching', 'user'));
    }

    /**
     * Stretching Edit page
     * @since 14/01/2015
     * @author aneeshk@cubettech.com
     * @return json
     */
    public function getEdit($id = null)
    {

        
        $stretching = Stretching::where('id', $id)->first();
        
        // Get the user information
        if (!is_null($stretching)) {
            $user = User::where('id', Auth::user()->id)->with(['profile', 'settings'])->first();
            
            return View('admin.stretching.edit', compact('stretching', 'user', 'muscleGroups'));
        } else {
            // Prepare the error message
            $error = 'Stretching not found';

            // Redirect to the user management page
            return Redirect::route('admin.stretchings')->with('error', $error);
        }

        // Show the page
        return View('admin.stretching.edit', compact('user', 'stretching', 'muscleGroups'));
    }

    /**
     * Stretching Post Edit page
     * @since 14/01/2015
     * @author aneeshk@cubettech.com
     * @return json
     */
    public function postEdit(Request $request, $id = null)
    {
        $stretching = Stretching::where('id', $id)->first();

        if (!is_null($stretching)) {
            Stretching::where('id', $id)->update([
                'name' => Input::get('name'),                
                'duration' => json_encode(Input::get('duration')),
                'unit' => Input::get('unit')                
            ]);  

            return Redirect::route('admin.stretchings')->with('success', 'Updated successfully');
        } else {

            return Redirect::route('admin.stretchings', $id)->withInput()->with('error', 'Stretching not found!');
        }
        // Redirect to the user page
    }

    /**
     * Stretching Delete
     * @since 14/01/2015
     * @author aneeshk@cubettech.com
     * @return json
     */
    public function getDelete($id = null)
    {
        $stretching = Stretching::where('id', $id)->first();

        if (is_null($stretching)) {

            $error = 'Stretching does not exists.';

            Redirect::route("admin.stretchings")->with('error', $error);
        }

        Stretching::where('id', $id)->delete();

        return Redirect::route("admin.stretchings")->with('success', 'Successfully deleted stretching.');
    }

    /**
     * Stretching Delete
     * @since 14/01/2015
     * @author aneeshk@cubettech.com
     * @return json
     */
    public function getModalDelete($id = null)
    {
        $model = 'stretchings';

        $confirm_route = $error = null;

        $entity = 'stretching';

        $stretching = Stretching::where('id', $id)->first();

        if (is_null($stretching)) {
            $error = 'Stretching does not exists.';
            return View('admin/layouts/modal_confirmation', compact('error', 'model', 'confirm_route', 'entity'));
        }

        $confirm_route = route('admin.stretching.delete', ['id' => $id]);

        return View('admin/layouts/modal_confirmation', compact('error', 'model', 'confirm_route', 'entity'));
    }
}
