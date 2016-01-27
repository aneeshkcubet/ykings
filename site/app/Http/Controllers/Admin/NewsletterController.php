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
use App\Profile;

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
        $validator = Validator::make($request->all(), [
                'subject' => 'required|max:255',
                'content' => 'required|min:10',
        ]);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)
                    ->withInput();
        }


        $newsletter = Newsletter::create([
                'subject' => Input::get('subject'),
                'content' => Input::get('content'),
                'subscribers' => '',
                'status' => 0
        ]);

        if (!is_null($newsletter)) {

            // Redirect to the home page with success menu
            return Redirect::route("admin.newsletters")->with('success', 'Newsletter drafted successfully.');
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
        $validator = Validator::make($request->all(), [
                'subject' => 'required|max:255',
                'content' => 'required|min:10',
        ]);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)
                    ->withInput();
        }

        $data['subject'] = Input::get('subject');

        $data['content'] = Input::get('content');

        $data['fromName'] = 'Ykings';

        $dataSub = [];

        $subscribers = DB::table('user_settings')
            ->select('users.email', 'user_profiles.first_name', 'user_profiles.last_name', 'users.id')
            ->leftJoin('user_profiles', 'user_profiles.user_id', '=', 'user_settings.user_id')
            ->leftJoin('users', 'users.id', '=', 'user_settings.user_id')
            ->where('user_settings.key', '=', 'subscription')
            ->where('user_settings.value', '=', 1)
            ->where('users.status', 1)
            ->get();

        foreach ($subscribers as $aKey => $subscriber) {
            $data['name'] = $subscriber->first_name . ' ' . $subscriber->last_name;

            $data['code'] = base64_encode($subscriber->email . "_" . $subscriber->id);

            $data['toEmail'] = $subscriber->email;

            Mail::send('email.newsletter', $data, function($message) use ($data) {
                $message->to($data['toEmail'], $data['name'])
                    ->subject($data['subject']);
            });

            $dataSub[] = $subscriber->id;
        }

        $newsletter = Newsletter::create([
                'subject' => Input::get('subject'),
                'content' => Input::get('content'),
                'subscribers' => implode(',', $dataSub),
                'status' => 1
        ]);

        if (!is_null($newsletter)) {

            // Redirect to the home page with success menu
            return Redirect::route("admin.newsletters")->with('success', 'Successfully sent newsletter to subscribers.');
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
        $newsletter = DB::table('newsletters')->where('id', $id)->first();
        // Get the user information
        if (!is_null($newsletter)) {

            $user = User::where('id', Auth::user()->id)->with(['profile', 'settings'])->first();
            $newsletter->subscriberProfiles = [];
            if ($newsletter->subscribers != '') {
                $subscribersArray = explode(',', $newsletter->subscribers);

                foreach ($subscribersArray as $sKey => $subscriber) {
                    $newsletter->subscriberProfiles[] = Profile::where('user_id', $subscriber)->first();
                }
            }
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

            $newsletter = Newsletter::where('id', $id)->update([
                'subject' => Input::get('subject'),
                'content' => Input::get('content'),
                'subscribers' => '',
                'status' => 0
            ]);

            return Redirect::route('admin.newsletters')->with('success', 'Newsletter drafted successfully');
        } else {

            return Redirect::route('admin.newsletters', $id)->withInput()->with('error', 'Newsletter not found!');
        }
        // Redirect to the user page
    }

    /**
     * Newsletter create form processing.
     * @since 14/01/2015
     * @author aneeshk@cubettech.com
     * @return json
     */
    public function postEditSend(Request $request, $id = null)
    {
        $validator = Validator::make($request->all(), [
                'subject' => 'required|max:255',
                'content' => 'required|min:10',
        ]);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)
                    ->withInput();
        }

        $data['subject'] = Input::get('subject');

        $data['content'] = Input::get('content');

        $data['fromName'] = 'Ykings';

        $dataSub = [];

        $subscribers = DB::table('user_settings')
            ->select('users.email', 'user_profiles.first_name', 'user_profiles.last_name', 'users.id')
            ->leftJoin('user_profiles', 'user_profiles.user_id', '=', 'user_settings.user_id')
            ->leftJoin('users', 'users.id', '=', 'user_settings.user_id')
            ->where('user_settings.key', '=', 'subscription')
            ->where('user_settings.value', '=', 1)
            ->where('users.status', 1)
            ->get();

        foreach ($subscribers as $aKey => $subscriber) {
            $data['name'] = $subscriber->first_name . ' ' . $subscriber->last_name;

            $data['code'] = base64_encode($subscriber->email . "_" . $subscriber->id);

            $data['toEmail'] = $subscriber->email;

            Mail::send('email.newsletter', $data, function($message) use ($data) {
                $message->to($data['toEmail'], $data['name'])
                    ->subject($data['subject']);
            });

            $dataSub[] = $subscriber->id;
        }

        $newsletter = Newsletter::where('id', $id)->update([
            'subject' => Input::get('subject'),
            'content' => Input::get('content'),
            'subscribers' => implode(',', $dataSub),
            'status' => 1
        ]);

        if (!is_null($newsletter)) {

            // Redirect to the home page with success menu
            return Redirect::route("admin.newsletters")->with('success', 'Successfully sent newsletter to subscribers.');
        }

        // Redirect to the newsletter creation page
        return Redirect::back()->withInput()->with('error', $error);
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
