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
use App\Exercise;
use App\User;
use App\Video;
use App\Fundumental;

class FundumentalController extends Controller
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
        $rowCount = count(Fundumental::groupBy('row')->get());

        $i = 1;

        do {

            $fundumentals[$i] = Fundumental::where('row', $i)->with(['exercise'])->get();

            $i++;
        } while ($i <= 5);


        $user = User::where('id', Auth::user()->id)->with(['profile', 'settings'])->first();

        return View('admin.fundumental.index', compact('fundumentals', 'user'));
    }

    /**
     * Fundumental create get form.
     * @since 14/01/2015
     * @author aneeshk@cubettech.com
     * @return json
     */
    public function getCreate()
    {
        $user = User::where('id', Auth::user()->id)->with(['profile', 'settings'])->first();

        $exercises = Exercise::all();

        // Show the page
        return View('admin.fundumental.create', compact('user', 'exercises'));
    }

    /**
     * Fundumental create form processing.
     * @since 14/01/2015
     * @author aneeshk@cubettech.com
     * @return json
     */
    public function postCreate(Request $request)
    {

        $exercise = Exercise::where('id', Input::get('exercise_id'))->first();

        $fundumental = Fundumental::create([
                'row' => Input::get('row'),
                'exercise_id' => Input::get('exercise_id'),
                'duration' => json_encode(Input::get('duration')),
                'unit' => $exercise->unit,
                'is_completed' => 0,
        ]);

        if (!is_null($fundumental)) {

            // Redirect to the home page with success menu
            return Redirect::route("admin.fundumentals")->with('success', 'Successfully created fundumental.');
        }

        // Redirect to the fundumental creation page
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

        $fundumental = Fundumental::where('id', $id)->with(['exercise'])->first();
        // Get the user information
        if (!is_null($fundumental)) {
            $user = User::where('id', Auth::user()->id)->with(['profile', 'settings'])->first();
        } else {
            // Prepare the error message
            $error = 'Fundumental not found';

            // Redirect to the user management page
            return Redirect::route('admin.fundumentals')->with('error', $error);
        }
        // Show the page
        return View('admin.fundumental.show', compact('fundumental', 'user'));
    }

    /**
     * Fundumental Edit page
     * @since 14/01/2015
     * @author aneeshk@cubettech.com
     * @return json
     */
    public function getEdit($id = null)
    {

        $fundumental = Fundumental::where('id', $id)->with(['exercise'])->first();
        $exercises = Exercise::all();
        // Get the user information
        if (!is_null($fundumental)) {
            $user = User::where('id', Auth::user()->id)->with(['profile', 'settings'])->first();
        } else {
            // Prepare the error message
            $error = 'Fundumental not found';

            // Redirect to the user management page
            return Redirect::route('admin.fundumentals')->with('error', $error);
        }
        // Show the page
        return View('admin.fundumental.edit', compact('user', 'fundumental', 'exercises'));
    }

    /**
     * Fundumental Post Edit page
     * @since 14/01/2015
     * @author aneeshk@cubettech.com
     * @return json
     */
    public function postEdit(Request $request, $id = null)
    {
        $fundumental = Fundumental::where('id', $id)->first();

        if (!is_null($fundumental)) {
            
            $exercise = Exercise::where('id', Input::get('exercise_id'))->first();

            $fundumental = Fundumental::where('id', $id)->update([
                    'row' => Input::get('row'),
                    'exercise_id' => Input::get('exercise_id'),
                    'duration' => json_encode(Input::get('duration')),
                    'unit' => $exercise->unit
            ]);


            return Redirect::route('admin.fundumentals')->with('success', 'Fundumental updated successfully');
        } else {

            return Redirect::route('admin.fundumentals', $id)->withInput()->with('error', 'Fundumental not found!');
        }
        // Redirect to the user page
    }

    /**
     * Fundumental Delete
     * @since 14/01/2015
     * @author aneeshk@cubettech.com
     * @return json
     */
    public function getDelete($id = null)
    {
        $fundumental = Fundumental::where('id', $id)->first();

        if (is_null($fundumental)) {

            $error = 'Fundumental does not exists.';

            Redirect::route("admin.fundumentals")->with('error', $error);
        }

        Fundumental::where('id', $id)->delete();

        return Redirect::route("admin.fundumentals")->with('success', 'Successfully deleted fundumental.');
    }

    /**
     * Fundumental Delete
     * @since 14/01/2015
     * @author aneeshk@cubettech.com
     * @return json
     */
    public function getModalDelete($id = null)
    {
        $model = 'fundumentals';

        $confirm_route = $error = null;

        $entity = 'fundumental';

        $fundumental = Fundumental::where('id', $id)->first();

        if (is_null($fundumental)) {
            $error = 'Fundumental does not exists.';
            return View('admin/layouts/modal_confirmation', compact('error', 'model', 'confirm_route', 'entity'));
        }

        $confirm_route = route('admin.fundumental.delete', ['id' => $id]);

        return View('admin/layouts/modal_confirmation', compact('error', 'model', 'confirm_route', 'entity'));
    }
}
