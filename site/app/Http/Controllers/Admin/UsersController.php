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
use JWTAuth;
use App\User;
use App\Profile;
use App\Country;

class UsersController extends Controller
{
    
    public function __construct()
    {        
        $this->middleware('admin');
    }

    /**
     * User index page
     * @since 04/01/2015
     * @author ansa@cubettech.com
     * @return json
     */
    public function getIndex()
    {
        // Grab all the users
        $usersList = User::where('status', '!=', 2)->get();

        $user = User::where('id', Auth::user()->id)->with(['profile', 'settings'])->first();
        // Show the page
        return View('admin.users.index', compact('usersList', 'user'));
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
        
        $countries = Country::all();
        // Show the page
        return View('admin.users.create', compact('user', 'countries'));
    }

    /**
     * User create form processing.
     * @since 12/01/2015
     * @author aneeshk@cubettech.com
     * @return json
     */
    public function postCreate(Request $request)
    {
        if (isset($_FILES['image']) && $_FILES['image']['error'] == UPLOAD_ERR_OK) {

            $accepableTypes = ['image/jpeg', 'image/gif', 'image/png', 'image/jpg', 'image/pjpeg', 'image/x-png'];

            //Check for valid image type
            if (!in_array($_FILES['image']['type'], $accepableTypes)) {
                $error = 'Please upload a png or jpg or gif image.';
                return Redirect::back()->withInput()->with('error', $error);
            }
        }

        $confirmation_code = str_random(30);

        $isActivated = Input::get('is_activated');
        
        $isAdmin = Input::get('is_admin');

        $user = User::create([
                'email' => Input::get('email'),
                'password' => Hash::make(Input::get('password')),
                'confirmation_code' => (isset($isActivated)) ? '' : $confirmation_code,
                'status' => (isset($isActivated)) ? 1 : 0,
                'is_admin' => (isset($isAdmin)) ? 1 : 0,
        ]);

        $data['password'] = Input::get('password');

        //If user verification required
        if (!isset($isActivated)) {
            Mail::send('email.verify', ['confirmation_code' => $confirmation_code], function($message) use ($data) {
                $message->to(Input::get('email'), Input::get('first_name') . ' ' . Input::get('last_name'))
                    ->subject('Verify your email address');
            });
        } else {
            //If already activated by Administrator
            Mail::send('email.welcome', ['password' => Input::get('password')], function($message) use ($data) {
                $message->to(Input::get('email'), Input::get('first_name') . ' ' . Input::get('last_name'))
                    ->subject('Welcome to Ykings App');
            });
        }

        // Register the user
        $profile = new Profile(array(
            'first_name' => Input::get('first_name'),
            'last_name' => Input::get('last_name'),
            'password' => Input::get('password'),
            'gender' => Input::get('gender'),
            'country' => Input::get('country'),
            'state' => Input::get('state'),
            'city' => Input::get('city'),
            'spot' => Input::get('spot'),
            'quote' => Input::get('quote')
        ));

        $userProfile = $user->profile()->save($profile);

        $user = User::where('email', '=', $request->input('email'))->with(['profile', 'videos'])->first();

        //If user uploaded image

        if (isset($_FILES['image']) && $_FILES['image']['error'] == UPLOAD_ERR_OK) {

            $image = Image::make($_FILES['image']['tmp_name']);

            $image->encode('jpeg');

            $image->save(config('image.profileOriginalPath') . $user->id . '_' . time() . '.jpg');

            $image->crop(400, 400);

            $image->save(config('image.profileLargePath') . $user->id . '_' . time() . '.jpg');

            $image->crop(150, 150);

            $image->save(config('image.profileMediumPath') . $user->id . '_' . time() . '.jpg');

            $image->crop(65, 65);

            $image->save(config('image.profileSmallPath') . $user->id . '_' . time() . '.jpg');

            $user->profile()->update(['image' => $user->id . '_' . time() . '.jpg']);
        }

        // Redirect to the home page with success message

        return Redirect::route("admin.users")->with('success', 'Successfully created');
    }

    /**
     * User View page
     * @since 04/01/2015
     * @author ansa@cubettech.com
     * @return json
     */
    public function show($id)
    {
        // Get the user information
        $tUser = User::where('id', $id)->with(['profile', 'settings'])->first();

        if (is_null($tUser)) {

            // Prepare the error message
            $error = 'User does not exists';

            // Redirect to the user management page
            return Redirect::route('admin.users')->with('error', $error);
        }
        
        $countries = Country::all();


        $user = User::where('id', Auth::user()->id)->with(['profile', 'settings'])->first();

        // Show the page
        return View('admin.users.show', compact('tUser', 'user', 'countries'));
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
        $tUser = User::where('id', $id)->with(['profile', 'settings'])->first();

        if (is_null($tUser)) {

            // Prepare the error message
            $error = 'User does not exists';

            // Redirect to the user management page
            return Redirect::route('admin.users')->with('error', $error);
        }
        
        $countries = Country::all();

        $user = User::where('id', Auth::user()->id)->with(['profile', 'settings'])->first();

        // Show the page
        return View('admin/users/edit', compact('user', 'tUser', 'countries'));
    }

    /**
     * User Post Edit page
     * @since 04/01/2015
     * @author ansa@cubettech.com
     * @return json
     */
    public function postEdit(Request $request, $id = null)
    {
//        print_r($_FILES);
//        die;
        if (isset($_FILES['image']) && $_FILES['image']['error'] == UPLOAD_ERR_OK) {

            $accepableTypes = ['image/jpeg', 'image/gif', 'image/png', 'image/jpg', 'image/pjpeg', 'image/x-png'];

            //Check for valid image type
            if (!in_array($_FILES['image']['type'], $accepableTypes)) {
                $error = 'Please upload a png or jpg or gif image.';
                return Redirect::back()->withInput()->with('error', $error);
            }
        }

        $user = User::where('id', $id)->first();

        if (is_null($user)) {

            $error = 'User does not exists';

            // Redirect to the user management page
            return Redirect::route('admin.users')->with('error', $error);
        }


        $this->validationRules['email'] = "required|email";

        // Do we want to update the user password?
        if (!$password = Input::get('password')) {
            unset($this->validationRules['password']);
            unset($this->validationRules['password_confirm']);
        }

        // Create a new validator instance from our validation rules
        $validator = Validator::make(Input::all(), $this->validationRules);

        // If validation fails, we'll exit the operation now.
        if ($validator->fails()) {
            return Redirect::back()->withInput()->withErrors($validator);
        }
        
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
        $userProfile->update();

        //If user uploaded image

        if (isset($_FILES['image']) && $_FILES['image']['error'] == UPLOAD_ERR_OK) {

            $image = Image::make($_FILES['image']['tmp_name']);

            $image->encode('jpeg');

            $image->save(config('image.profileOriginalPath') . $user->id . '_' . time() . '.jpg');

            $image->crop(400, 400);

            $image->save(config('image.profileLargePath') . $user->id . '_' . time() . '.jpg');

            $image->crop(150, 150);

            $image->save(config('image.profileMediumPath') . $user->id . '_' . time() . '.jpg');

            $image->crop(65, 65);

            $image->save(config('image.profileSmallPath') . $user->id . '_' . time() . '.jpg');            

            $name = $user->id . '_' . time() . '.jpg';
            
            DB::table('user_profiles')->where('user_id', $user->id)->update(['image' => $name]);

            
        }
        // Prepare the success message
        $success = 'Successfully updated the user profile.';
        // Redirect to the user page
        return Redirect::route('admin.users', $id)->with('success', $success);


        // Redirect to the user page
        return Redirect::route('admin.user.update', $id)->withInput()->with('error', $error);
    }

    /**
     * User Delete
     * @since 04/01/2015
     * @author ansa@cubettech.com
     * @return json
     */
    public function getDelete($id = null)
    {
        $user = User::where('id', $id)->first();
        $user->status = 2;
        $user->update();

        return Redirect::route("admin.users")->with('success', 'Successfully deleted user.');
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
        
        $entity = 'user';

        $confirm_route = $error = null;

        $user = User::where('id', $id)->first();

        $confirm_route = route('admin.user.delete', ['id' => $user->id]);

        if (is_null($user)) {
            $error = 'User does not exists.';
            return View('admin/layouts/modal_confirmation', compact('error', 'model', 'confirm_route', 'entity'));
        }

        return View('admin/layouts/modal_confirmation', compact('error', 'model', 'confirm_route', 'entity'));
    }

    /**
     * User Delete
     * @since 12/01/2015
     * @author aneeshk@cubettech.com
     * @return json
     */
    public function setFeatured($id = null)
    {
        $user = User::where('id', $id)->first();
        $user->is_featured = 1;
        $user->update();

        return Redirect::route("admin.users")->with('success', 'Successfully set as featured user.');
    }

    /**
     * User Delete
     * @since 12/01/2015
     * @author aneeshk@cubettech.com
     * @return json
     */
    public function unsetFeatured($id = null)
    {
        $user = User::where('id', $id)->first();
        $user->is_featured = 0;
        $user->update();

        return Redirect::route("admin.users")->with('success', 'Successfully removed featured user.');
    }
}
