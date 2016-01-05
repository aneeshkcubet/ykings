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
        // Declare the rules for the form validation
        $rules = array(
            'first_name' => 'required|min:3',
            'last_name' => 'required|min:3',
            'email' => 'required|email|unique:users',
            'password' => 'required|between:3,32',
            'password_confirm' => 'required|same:password',
            'pic' => 'mimes:jpg,jpeg,bmp,png|max:10000'
        );

        // Create a new validator instance from our validation rules
        //$validator = Validator::make(Input::all(), $rules);
        // If validation fails, we'll exit the operation now.
        // if ($validator->fails()) {
        // Ooops.. something went wrong
        //   return Redirect::back()->withInput()->withErrors($validator);
        // }
//        //upload image
//        if ($file = Input::file('pic')) {
//            $fileName = $file->getClientOriginalName();
//            $extension = $file->getClientOriginalExtension() ? : 'png';
//            $folderName = '/uploads/images/profile/original';
//            $destinationPath = public_path() . $folderName;
//            $safeName = str_random(10) . '.' . $extension;
//            $file->move($destinationPath, $safeName);
//        }
        //check whether use should be activated by default or not
        //  $activate = Input::get('activate') ? true : false;

        try {

            $confirmation_code = str_random(30);
            $user = User::create([
                    'email' => Input::get('email'),
                    'password' => Hash::make(Input::get('password')),
                    'confirmation_code' => $confirmation_code,
                    'status' => 0
            ]);

            // Register the user
            $profile = new Profile(array(
                'first_name' => Input::get('first_name'),
                'last_name' => Input::get('last_name'),
                'password' => Input::get('password'),
                //  'image' => isset($safeName) ? $safeName : '',
                'gender' => Input::get('gender'),
                'country' => Input::get('country'),
                'state' => Input::get('state'),
                'city' => Input::get('city'),
                'spot' => Input::get('spot'),
                'quote' => Input::get('quote')
            ));
            $userProfile = $user->profile()->save($profile);
            //check for activation and send activation mail if not activated by default
            // Redirect to the home page with success menu
            return Redirect::route("users")->with('success', Lang::get('Successfully created'));
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
            //echo Auth::user()->id;die;
            // Get the user information
            $exercise = Exercise::where('id', $id)->first();
            $user = User::where('id', Auth::user()->id)->with(['profile', 'settings'])->first();
            $usersList = '';
//         $exerciseUsers = ExerciseUser::where('exercise_id', '=', $request->input('exercise_id'))
//                    ->where('status', '=', 1)
//                    ->with(['profile'])
//                    ->groupBy('user_id')
//                    ->orderBy('time', 'ASC')
//                    ->get();
        } catch (UserNotFoundException $e) {
            // Prepare the error message
            $error = Lang::get('users/message.user_not_found', compact('id'));

            // Redirect to the user management page
            return Redirect::route('users')->with('error', $error);
        }
        // Show the page
        return View('admin.exercise.show', compact('exercise', 'user', 'usersList'));
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
        if ($tUser = User::where('id', $id)->with(['profile', 'settings'])->first()) {
            $user = User::where('id', Auth::user()->id)->with(['profile', 'settings'])->first();
        } else {
            // Prepare the error message
            $error = Lang::get('users/message.user_not_found', compact('id'));

            // Redirect to the user management page
            return Redirect::route('users')->with('error', $error);
        }

        // Show the page
        return View('admin/users/edit', compact('user', 'tUser'));
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
            // Get the user information
            $user = User::where('id', $id)->first();
        } catch (UserNotFoundException $e) {
            // Prepare the error message
            $error = Lang::get('users/message.user_not_found', compact('id'));

            // Redirect to the user management page
            return Redirect::route('users')->with('error', $error);
        }

        //
        $this->validationRules['email'] = "required|email|unique:users,email,{$user->email},email";

        // Do we want to update the user password?
        if (!$password = Input::get('password')) {
            unset($this->validationRules['password']);
            unset($this->validationRules['password_confirm']);
        }

        // Create a new validator instance from our validation rules
        $validator = Validator::make(Input::all(), $this->validationRules);

        // If validation fails, we'll exit the operation now.
        if ($validator->fails()) {
            // Ooops.. something went wrong
            return Redirect::back()->withInput()->withErrors($validator);
        }

        try {

            $userProfile = Profile::where('user_id', $id)->first();
            // Update the user
            $userProfile->first_name = Input::get('first_name');
            $userProfile->last_name = Input::get('last_name');
            $userProfile->gender = Input::get('gender');
            $userProfile->country = Input::get('country');
            $userProfile->state = Input::get('state');
            $userProfile->city = Input::get('city');
            $userProfile->spot = Input::get('spot');
            $userProfile->quote = Input::get('quote');
            $userProfile->save();

            // Was the user updated?
            if ($user->save()) {
                // Prepare the success message
                $success = Lang::get('users/message.success.update');
                // Redirect to the user page
                return Redirect::route('users.update', $id)->with('success', $success);
            }
            // Prepare the error message
            $error = Lang::get('users/message.error.update');
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
    public function getDeletedUsers()
    {
        // Grab deleted users
        $users = User::onlyTrashed()->get();

        // Show the page
        return View('admin/deleted_users', compact('users'));
    }

    /**
     * User Delete
     * @since 04/01/2015
     * @author ansa@cubettech.com
     * @return json
     */
    public function getModalDelete($id = null)
    {
        $model = 'users';
        $confirm_route = $error = null;
        try { //echo 'hiii';die;
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
        $confirm_route = route('delete/user', ['id' => $user->id]);
        return View('admin/layouts/modal_confirmation', compact('error', 'model', 'confirm_route'));
    }
}
