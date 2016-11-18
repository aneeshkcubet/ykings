<?php namespace App\Http\Controllers\Admin;

use Validator,
    Hash,
    Mail,
    Auth,
    Image,
    Redirect,
    DB,
    Input,
    Lang,
    Response;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use JWTAuth;
use App\User;
use App\Profile;
use App\Country;
use App\Feeds;
use App\Images;
use App\CommonFunctions\PushNotificationFunction;
use Yajra\Datatables\Datatables;

class UsersController extends Controller
{

    public function __construct()
    {
        $this->middleware('admin', ['except' => ['exportsubscribers', 'exportusers']]);
    }

    /**
     * Displays datatables front end view
     *
     * @return \Illuminate\View\View
     */
    public function getIndex()
    {
        $usersList = array();
        $user = User::where('id', Auth::user()->id)->with(['profile', 'settings'])->first();
        return View('admin.users.index', compact('usersList', 'user'));
    }

    /**
     * Process datatables ajax request.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function anyData()
    {
        $posts = User::leftJoin('user_profiles', 'users.id', '=', 'user_profiles.user_id');

        return Datatables::of($posts)
                ->addColumn('action', function ($list) {
                    $html = ' <a href=\'' . route("admin.user.show", $list->user_id) . '\'><i class="glyphicon glyphicon-eye-open" data-name="info" data-size="18" data-loop="true" data-c="#428BCA" data-hc="#428BCA" title="view user"></i></a>
                                      <a href="' . route("admin.user.update", $list->user_id) . '"><i class="glyphicon glyphicon-edit"></i></a>';
                    if ($list->user_id != 1) {
                        $html.='<a href="' . route("admin.confirm-delete.user", $list->user_id) . '" data-toggle="modal" data-target="#delete_confirm">
                                        <i class="glyphicon glyphicon-remove" data-name="user-remove" data-size="18" data-loop="true" data-c="#f56954" data-hc="#f56954" title="delete user">
                                         </i>
                                        </a>';
                    }
                    if ($list->is_featured != 1) {
                        $html.='<a href = "' . route("admin.user.setfeatured", $list->user_id) . '" title = "Set as Featured User">
                                        <i class = "glyphicon glyphicon-thumbs-up" data-name = "thumbs-up" data-size = "18" data-c = "#f56954" data-hc = "#f56954" data-loop = "true" title = "Set as Featured User"></i>
                                        </a>';
                    } else {
                        $html.='<a href = "' . route("admin.user.unsetfeatured", $list->user_id) . '" title = "Remove Featured">
                                        <i class = "glyphicon glyphicon-thumbs-down" data-name = "thumbs-down" data-size = "18" data-c = "#f56954" data-hc = "#f56954" data-loop = "true" title = "Remove Featured"></i>
                                        </a>';
                    }
                    $user = User::where('id', $list->user_id)->first();
                    if ($user->is_subscribed_backend != 1) {
                        $html.='<a href = "' . route("admin.user.setsubscribed", $list->user_id) . '" title = "Set as Subscribed User">
                                        <i class = "glyphicon glyphicon-thumbs-up" data-name = "thumbs-up" data-size = "18" data-c = "#f56954" data-hc = "#f56954" data-loop = "true" title = "Set as Subscribed User"></i>
                                        </a>';
                    } else {
                        $html.='<a href = "' . route("admin.user.unsetsubscribed", $list->user_id) . '" title = "Remove Subscribed">
                                        <i class = "glyphicon glyphicon-thumbs-down" data-name = "thumbs-down" data-size = "18" data-c = "#f56954" data-hc = "#f56954" data-loop = "true" title = "Remove Subscribed"></i>
                                        </a>
                                        ';
                    }

                    return $html;
                })
                ->editColumn('status', function ($list) {
                    if ($list->status == '1') {
                        return 'Active';
                    } else {
                        return 'Not Verified';
                    }
                })
                ->addColumn('subscribed', function ($list) {
                    $user = User::where('id', $list->user_id)->first();
                    if ($user->is_subscribed == '1') {
                        return 'Yes';
                    } else {
                        return 'No';
                    }
                })
                ->blacklist(['action'])
                ->make(true);
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

        //If user verification required
        if (!isset($isActivated)) {
            Mail::send('email.verify', ['confirmation_code' => $confirmation_code, 'first_name' => $profile['first_name'], 'last_name' => $profile['last_name']], function($message) use ($data) {
                $message->to(Input::get('email'), Input::get('first_name') . ' ' . Input::get('last_name'))
                    ->subject('Verify your email address');
            });
        } else {
//If already activated by Administrator
            Mail::send('email.welcome', ['first_name' => $profile['first_name'], 'last_name' => $profile['last_name']], function($message) use ($data) {
                $message->to(Input::get('email'), Input::get('first_name') . ' ' . Input::get('last_name'))
                    ->subject('Welcome to Ykings App');
            });
        }

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

            Profile::where('user_id', $user->id)->update(['image' => $user->id . '_' . time() . '.jpg']);
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

        if ($tUser->referral_code > 0) {
            $refer = Profile::where('user_id', $tUser->referral_code)->first();
            $tUser->refferance = $refer;
        }

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

        $isAdmin = Input::get('is_admin');



// Do we want to update the user password?
        if (Input::get('password')) {
            User::where('id', $id)->update([
                'password' => Hash::make(Input::get('password')),
                'is_admin' => (isset($isAdmin)) ? 1 : 0,
            ]);
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
        return Redirect::route('admin.users')->with('success', $success);
    }

    /**
     * User Delete
     * @since 04/01/2015
     * @author ansa@cubettech.com
     * @return json
     */
    public function getDelete($id = null)
    {
        $user = User::where('id', $id)->delete();
//        $user->status = 2;
//        $user->update();

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

    /**
     * User Delete
     * @since 26/02/2015
     * @author aneeshk@cubettech.com
     * @return json
     */
    public function setSubscribed($id = null)
    {
        $user = User::where('id', $id)->first();
        $user->is_subscribed_backend = 1;
        $user->update();

        return Redirect::route("admin.users")->with('success', 'Successfully set as subscribed user.');
    }

    /**
     * User Delete
     * @since 26/02/2015
     * @author aneeshk@cubettech.com
     * @return json
     */
    public function unsetSubscribed($id = null)
    {
        $user = User::where('id', $id)->first();
        $user->is_subscribed_backend = 0;
        $user->update();

        return Redirect::route("admin.users")->with('success', 'Successfully removed subscribed user.');
    }

    /**
     * User create form processing.
     * @since 04/01/2015
     * @author ansa@cubettech.com
     * @return json
     */
    public function getKnowledgeCreate()
    {
        $user = User::where('id', Auth::user()->id)->with(['profile', 'settings'])->first();

        $countries = Country::all();
// Show the page
        return View('admin.knowledge.create', compact('user', 'countries'));
    }

    /**
     * User create form processing.
     * @since 12/01/2015
     * @author aneeshk@cubettech.com
     * @return json
     */
    public function postKnowledgeCreate(Request $request)
    {
        if (isset($_FILES['image']) && $_FILES['image']['error'] == UPLOAD_ERR_OK) {

            $accepableTypes = ['image/jpeg', 'image/gif', 'image/png', 'image/jpg', 'image/pjpeg', 'image/x-png'];

//Check for valid image type
            if (!in_array($_FILES['image']['type'], $accepableTypes)) {
                $error = 'Please upload a png or jpg or gif image.';
                return Redirect::back()->withInput()->with('error', $error);
            }
        }

        $feed = Feeds::create([
                'user_id' => Auth::user()->id,
                'item_type' => 'knowledge',
                'item_id' => 0,
                'feed_text' => $request->input('text'),
                'image' => ''
        ]);

        $users = User::where('status', 1)->where('id', '!=', Auth::user()->id)->get();

        foreach ($users as $uKey => $user) {

            $data = [
                'type' => 'knowledge',
                'type_id' => $feed->id,
                'user_id' => Auth::user()->id,
                'friend_id' => $user->id,
            ];

            PushNotificationFunction::pushNotification($data);
        }

//If user uploaded image

        if (isset($_FILES['image']) && $_FILES['image']['error'] == UPLOAD_ERR_OK) {

            $image = Image::make($_FILES['image']['tmp_name']);

            $time = time();

            $image->encode('jpeg');

            $image->save(config('image.feedOriginalPath') . 'feed_' . $feed->id . '_' . $time . '.jpg');

            $image->crop(400, 400);

            $image->save(config('image.feedLargePath') . 'feed_' . $feed->id . '_' . $time . '.jpg');

            $image->crop(150, 150);

            $image->save(config('image.feedMediumPath') . 'feed_' . $feed->id . '_' . $time . '.jpg');

            $image->crop(65, 65);

            $image->save(config('image.feedSmallPath') . 'feed_' . $feed->id . '_' . $time . '.jpg');

            $image_upload = Images::create([
                    'user_id' => Auth::user()->id,
                    'path' => 'feed_' . $feed->id . '_' . $time . '.jpg',
                    'description' => $request->input('text'),
                    'parent_type' => 2,
                    'parent_id' => $feed->id
            ]);

            Feeds::where('id', $feed->id)->update([
                'image' => 'feed_' . $feed->id . '_' . $time . '.jpg'
            ]);

            if (file_exists($_FILES['image']['tmp_name']) && is_writable($_FILES['image']['tmp_name'])) {
                unlink($_FILES['image']['tmp_name']);
            }
        }

// Redirect to the home page with success message

        return Redirect::route("admin.feeds")->with('success', 'Successfully added message.');
    }

    /**
     * Function to export subscribers to excel file
     * @return type
     * @author Aneesh K <aneeshk@cubettech.com>
     */
    public function exportsubscribers()
    {
        $subscribers = DB::table('user_settings')->where('user_settings.key', '=', 'subscription')
                ->where('user_settings.value', '=', 1)->distinct()->lists('user_id');

        $table = User::leftJoin('user_profiles', 'user_profiles.user_id', '=', 'users.id')
            ->select(['user_profiles.first_name', 'user_profiles.last_name', 'users.email'])
            ->whereIn('users.id', $subscribers)
            ->where('users.is_admin', '!=', 1)
            ->where('users.status', '=', 1)
            ->get();

        $filename = public_path() . "/subscribers.xls";
        if (!is_file($filename)) {
            touch($filename, time());
            chmod($filename, 0777);
        }
        $handle = fopen($filename, 'w+');
        fputcsv($handle, array('Sl No.', 'First Name', 'Last name', 'email'));

        $rowCount = 1;

        foreach ($table as $row) {
            fputcsv($handle, array($rowCount, $row['first_name'], $row['last_name'], $row['email']));
            $rowCount++;
        }

        fclose($handle);

        $headers = array(
            'Content-Type' => 'application/vnd.ms-excel; name=excel'
        );

        return Response::download($filename, 'subscribers' . time() . '.xls', $headers);
        return view('welcome');
    }

    /**
     * Function to export users to excel file
     * @return type
     * @author Aneesh K <aneeshk@cubettech.com>
     */
    public function exportusers()
    {
        $table = User::leftJoin('user_profiles', 'user_profiles.user_id', '=', 'users.id')
            ->select(['user_profiles.first_name', 'user_profiles.last_name', 'users.email'])
            ->get();

        $filename = public_path() . "/users.xls";
        if (!is_file($filename)) {
            touch($filename, time());
            chmod($filename, 0777);
        }
        $handle = fopen($filename, 'w+');
        fputcsv($handle, array('Sl No.', 'First Name', 'Last name', 'email'));

        $rowCount = 1;

        foreach ($table as $row) {
            fputcsv($handle, array($rowCount, $row['first_name'], $row['last_name'], $row['email']));
            $rowCount++;
        }

        fclose($handle);

        $headers = array(
            'Content-Type' => 'application/vnd.ms-excel; name=excel'
        );

        return Response::download($filename, 'users_' . time() . '.xls', $headers);
        return view('welcome');
    }
}
