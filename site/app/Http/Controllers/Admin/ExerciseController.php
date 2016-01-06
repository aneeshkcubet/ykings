<?php namespace App\Http\Controllers\Admin;

use Auth,
    Hash,
    DB;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use JWTAuth;
use Redirect;
use Input;
use Lang;
use Validator;
use App\Exercise;
use App\Profile;
use App\User;

class ExerciseController extends Controller
{

    /**
     * Index page
     * @since 04/01/2015
     * @author ansa@cubettech.com
     * @return json
     */
    public function getIndex()
    {
        // Grab all the users
        $exercise = Exercise::get();
        $user = User::where('id', Auth::user()->id)->with(['profile', 'settings'])->first();
        // Show the page
        return View('admin.exercise.index', compact('exercise', 'user'));
    }

    /**
     * User create form processing.
     * @since 04/01/2015
     * @author ansa@cubettech.com
     * @return json
     */
    public function getCreate()
    {
        $user = User::where('id', Auth::user()->id)->with(['profile', 'settings'])->first();
        // Show the page
        return View('admin.exercise.create', compact('user'));
    }

    /**
     * User create form processing.
     * @since 04/01/2015
     * @author ansa@cubettech.com
     * @return json
     */
    public function postCreate()
    {
        try {

            // Register the user
            Exercise::create([
                'name' => Input::get('name'),
                'description' => Input::get('description'),
                'category' => Input::get('category'),
                'type' => Input::get('type'),
                'rewards' => Input::get('rewards'),
                'repetitions' => Input::get('repetitions'),
                'duration' => Input::get('duration'),
                'unit' => Input::get('unit'),
                'equipment' => Input::get('equipment')
            ]);

            //check for activation and send activation mail if not activated by default
            // Redirect to the home page with success menu
            return Redirect::route("exercise")->with('success', Lang::get('Successfully created'));
        } catch (LoginRequiredException $e) {
            $error = Lang::get('admin/users/message.user_login_required');
        } catch (PasswordRequiredException $e) {
            $error = Lang::get('admin/users/message.user_password_required');
        } catch (UserExistsException $e) {
            $error = Lang::get('admin/users/message.user_exists');
        }

        // Redirect to the user creation page
        return Redirect::back()->withInput()->with('error', $error);
    }

    /**
     * View page
     * @since 04/01/2015
     * @author ansa@cubettech.com
     * @return json
     */
    public function show($id)
    {

        try {
            // Get the user information
            $exercise = Exercise::where('id', $id)->first();
            $user = User::where('id', Auth::user()->id)->with(['profile', 'settings'])->first();
        } catch (UserNotFoundException $e) {
            // Prepare the error message
            $error = Lang::get('users/message.user_not_found', compact('id'));

            // Redirect to the user management page
            return Redirect::route('users')->with('error', $error);
        }
        // Show the page
        return View('admin.exercise.show', compact('exercise', 'user'));
    }

    /**
     * User Edit page
     * @since 04/01/2015
     * @author ansa@cubettech.com
     * @return json
     */
    public function getEdit($id = null)
    {
        // Get the user information
        if ($exercise = Exercise::where('id', $id)->first()) {
            $user = User::where('id', Auth::user()->id)->with(['profile', 'settings'])->first();
        } else {
            // Prepare the error message
            $error = Lang::get('users/message.user_not_found', compact('id'));

            // Redirect to the user management page
            return Redirect::route('users')->with('error', $error);
        }

        // Show the page
        return View('admin.exercise.edit', compact('user', 'exercise'));
    }

    /**
     * User Post Edit page
     * @since 04/01/2015
     * @author ansa@cubettech.com
     * @return json
     */
    public function postEdit($id = null)
    {
        try {
            $exercise = Exercise::where('id', $id)->first();
            // Update the user
            $exercise->name = Input::get('name');
            $exercise->description = Input::get('description');
            $exercise->category = Input::get('category');
            $exercise->type = Input::get('type');
            $exercise->rewards = Input::get('rewards');
            $exercise->repititions = Input::get('repititions');
            $exercise->duration = Input::get('duration');
            $exercise->unit = Input::get('unit');
            $exercise->equipment = Input::get('equipment');
            $exercise->save();

            return Redirect::route('exercise.update', $id)->with('success', 'Updated successfully');
        } catch (LoginRequiredException $e) {
            $error = Lang::get('users/message.user_login_required');
        }

        // Redirect to the user page
        return Redirect::route('users.update', $id)->withInput()->with('error', $error);
    }

    /**
     * User Delete
     * @since 04/01/2015
     * @author ansa@cubettech.com
     * @return json
     */
    public function getDelete()
    {
        // Grab deleted users
        $users = User::onlyTrashed()->get();

        // Show the page
        return View('admin.exercise', compact('users'));
    }

    /**
     * User Delete
     * @since 04/01/2015
     * @author ansa@cubettech.com
     * @return json
     */
    public function getModalDelete($id = null)
    {
        $model = 'exercise';
        $confirm_route = $error = null;
        try { 
            // Get user information
            // $user = User::where('id', $id)->first();
            // Check if we are not trying to delete ourselves
            //  if ($user->id === Sentinel::getUser()->id) {
            // Prepare the error message
            //  $error = Lang::get('users/message.error.delete');
            return View('admin.layouts.modal_confirmation', compact('model', 'confirm_route'));
            // }
        } catch (UserNotFoundException $e) {
            // Prepare the error message
            $error = Lang::get('users/message.user_not_found', compact('id'));
            return View('admin/layouts/modal_confirmation', compact('error', 'model', 'confirm_route'));
        }
        $confirm_route = route('delete.exercise', ['id' => $id]);
        return View('admin/layouts/modal_confirmation', compact('error', 'model', 'confirm_route'));
    }
}
