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
use App\Newsletter;
use App\User;

class NewsletterController extends Controller
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
        $newsletter = Newsletter::get();

        $user = User::where('id', Auth::user()->id)->with(['profile', 'settings'])->first();

        // Show the page
        return View('admin.newsletter.index', compact('newsletter', 'user'));
    }

    /**
     * Newsletter create get form.
     * @since 14/01/2015
     * @author aneeshk@cubettech.com
     * @return json
     */
    public function getCreate()
    {
        $user = User::where('id', Auth::user()->id)->with(['profile', 'settings'])->first();


        // Show the page
        return View('admin.newsletter.create', compact('user'));
    }

    /**
     * Newsletter create form processing.
     * @since 14/01/2015
     * @author aneeshk@cubettech.com
     * @return json
     */
    public function postCreate(Request $request)
    {       

        $newsletter = Newsletter::create([
                'exercise_id' => Input::get('name'),                
                'duration' => json_encode(Input::get('duration')),
                'unit' => Input::get('unit')                
        ]);

        if (!is_null($newsletter)) { 
            
            // Redirect to the home page with success menu
            return Redirect::route("admin.newsletters")->with('success', 'Successfully created newsletter.');
        }

        // Redirect to the newsletter creation page
        return Redirect::back()->withInput()->with('error', $error);
    }
    
    /**
     * Newsletter create form processing.
     * @since 14/01/2015
     * @author aneeshk@cubettech.com
     * @return json
     */
    public function postSend(Request $request)
    {       

        $newsletter = Newsletter::create([
                'exercise_id' => Input::get('name'),                
                'duration' => json_encode(Input::get('duration')),
                'unit' => Input::get('unit')                
        ]);

        if (!is_null($newsletter)) { 
            
            // Redirect to the home page with success menu
            return Redirect::route("admin.newsletters")->with('success', 'Successfully created newsletter.');
        }

        // Redirect to the newsletter creation page
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
        $newsletter = Newsletter::where('id', $id)->first();        
        // Get the user information
        if (!is_null($newsletter)) {
            
            $user = User::where('id', Auth::user()->id)->with(['profile', 'settings'])->first();
            
        } else {
            // Prepare the error message
            $error = 'Newsletter not found';

            // Redirect to the user management page
            return Redirect::route('admin.newsletters')->with('error', $error);
        }
        // Show the page
        return View('admin.newsletter.show', compact('newsletter', 'user'));
    }

    /**
     * Newsletter Edit page
     * @since 14/01/2015
     * @author aneeshk@cubettech.com
     * @return json
     */
    public function getEdit($id = null)
    {

        
        $newsletter = Newsletter::where('id', $id)->first();
        
        // Get the user information
        if (!is_null($newsletter)) {
            $user = User::where('id', Auth::user()->id)->with(['profile', 'settings'])->first();
            
            return View('admin.newsletter.edit', compact('newsletter', 'user', 'muscleGroups'));
        } else {
            // Prepare the error message
            $error = 'Newsletter not found';

            // Redirect to the user management page
            return Redirect::route('admin.newsletters')->with('error', $error);
        }

        // Show the page
        return View('admin.newsletter.edit', compact('user', 'newsletter', 'muscleGroups'));
    }

    /**
     * Newsletter Post Edit page
     * @since 14/01/2015
     * @author aneeshk@cubettech.com
     * @return json
     */
    public function postEdit(Request $request, $id = null)
    {
        $newsletter = Newsletter::where('id', $id)->first();

        if (!is_null($newsletter)) {
            Newsletter::where('id', $id)->update([
                'name' => Input::get('name'),                
                'duration' => json_encode(Input::get('duration')),
                'unit' => Input::get('unit')                
            ]);  

            return Redirect::route('admin.newsletters')->with('success', 'Updated successfully');
        } else {

            return Redirect::route('admin.newsletters', $id)->withInput()->with('error', 'Newsletter not found!');
        }
        // Redirect to the user page
    }

    /**
     * Newsletter Delete
     * @since 14/01/2015
     * @author aneeshk@cubettech.com
     * @return json
     */
    public function getDelete($id = null)
    {
        $newsletter = Newsletter::where('id', $id)->first();

        if (is_null($newsletter)) {

            $error = 'Newsletter does not exists.';

            Redirect::route("admin.newsletters")->with('error', $error);
        }

        Newsletter::where('id', $id)->delete();

        return Redirect::route("admin.newsletters")->with('success', 'Successfully deleted newsletter.');
    }

    /**
     * Newsletter Delete
     * @since 14/01/2015
     * @author aneeshk@cubettech.com
     * @return json
     */
    public function getModalDelete($id = null)
    {
        $model = 'newsletters';

        $confirm_route = $error = null;

        $entity = 'newsletter';

        $newsletter = Newsletter::where('id', $id)->first();

        if (is_null($newsletter)) {
            $error = 'Newsletter does not exists.';
            return View('admin/layouts/modal_confirmation', compact('error', 'model', 'confirm_route', 'entity'));
        }

        $confirm_route = route('admin.newsletter.delete', ['id' => $id]);

        return View('admin/layouts/modal_confirmation', compact('error', 'model', 'confirm_route', 'entity'));
    }
}
