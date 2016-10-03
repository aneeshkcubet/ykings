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
use App\Skill;
use App\Exercise;
use App\Profile;
use App\User;
use App\Video;
use App\Progression;

class SkillController extends Controller
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
        $pullRowCount = count(Skill::where('progression_id', 1)->groupBy('row')->get());


        $i = 1;

        do {

            $skill = Skill::where('row', $i)->where('progression_id', 1)->with(['exercise'])->orderBy('skills.level', 'DESC')->get();

            $skills['pull'][$i] = $skill->toArray();

            $i++;
        } while ($i <= $pullRowCount);

        $i = 1;

        $dipRowCount = count(Skill::where('progression_id', 2)->groupBy('row')->get());

        do {
            $skill = Skill::where('row', $i)->where('progression_id', 2)->with(['exercise'])->orderBy('skills.level', 'DESC')->get();

            $skills['dip'][$i] = $skill->toArray();
            $i++;
            unset($skill);
        } while ($i <= $dipRowCount);

        $i = 1;

        $fullBodyRowCount = count(Skill::where('progression_id', 3)->groupBy('row')->get());

        do {

            $skill = Skill::where('row', $i)->where('progression_id', 3)->with(['exercise'])->orderBy('skills.level', 'DESC')->get();

            $skills['full_body'][$i] = $skill->toArray();
            $i++;
            unset($skill);
        } while ($i <= $fullBodyRowCount);

        $i = 1;

        $pushRowCount = count(Skill::where('progression_id', 4)->groupBy('row')->get());

        do {


            $skill = Skill::where('row', $i)->where('progression_id', 4)->with(['exercise'])->orderBy('skills.level', 'DESC')->get();

            $skills['push'][$i] = $skill->toArray();
            $i++;
            unset($skill);
        } while ($i <= $pushRowCount);

        $i = 1;

        $coreRowCount = count(Skill::where('progression_id', 5)->groupBy('row')->get());

        do {

            $skill = Skill::where('row', $i)->where('progression_id', 5)->with(['exercise'])->orderBy('skills.level', 'DESC')->get();

            $skills['core'][$i] = $skill->toArray();
            $i++;
            unset($skill);
        } while ($i <= $coreRowCount);

        $user = User::where('id', Auth::user()->id)->with(['profile', 'settings'])->first();

        // Show the page
        return View('admin.skill.index', compact('skills', 'user'));
    }

    /**
     * Skill create get form.
     * @since 14/01/2015
     * @author aneeshk@cubettech.com
     * @return json
     */
    public function getCreate()
    {
        $user = User::where('id', Auth::user()->id)->with(['profile', 'settings'])->first();

        $exercises = Exercise::all();
        $progressions = Progression::all();

        // Show the page
        return View('admin.skill.create', compact('user', 'exercises', 'progressions'));
    }

    /**
     * Skill create form processing.
     * @since 14/01/2015
     * @author aneeshk@cubettech.com
     * @return json
     */
    public function postCreate(Request $request)
    {

        $skill = Skill::create([
                'description' => Input::get('description'),
                'progression_id' => Input::get('progression_id'),
                'level' => Input::get('level'),
                'row' => Input::get('row'),
                'exercise_id' => Input::get('exercise_id'),
                'is_allies' => Input::get('is_allies')
        ]);

        if (!is_null($skill)) {

            // Redirect to the home page with success menu
            return Redirect::route("admin.skills")->with('success', 'Successfully created skill.');
        }

        // Redirect to the skill creation page
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

        $skill = Skill::where('id', $id)->with(['exercise', 'progression'])->first();
        // Get the user information
        if (!is_null($skill)) {
            $user = User::where('id', Auth::user()->id)->with(['profile', 'settings'])->first();
        } else {
            // Prepare the error message
            $error = 'Skill not found';

            // Redirect to the user management page
            return Redirect::route('admin.skills')->with('error', $error);
        }
        // Show the page
        return View('admin.skill.show', compact('skill', 'user'));
    }

    /**
     * Skill Edit page
     * @since 14/01/2015
     * @author aneeshk@cubettech.com
     * @return json
     */
    public function getEdit($id = null)
    {

        $skill = Skill::where('id', $id)->with(['exercise', 'progression'])->first();
        $exercises = Exercise::all();
        $progressions = Progression::all();
        // Get the user information
        if (!is_null($skill)) {
            $user = User::where('id', Auth::user()->id)->with(['profile', 'settings'])->first();
        } else {
            // Prepare the error message
            $error = 'Skill not found';

            // Redirect to the user management page
            return Redirect::route('admin.skills')->with('error', $error);
        }
        // Show the page
        return View('admin.skill.edit', compact('user', 'skill', 'exercises', 'progressions'));
    }

    /**
     * Skill Post Edit page
     * @since 14/01/2015
     * @author aneeshk@cubettech.com
     * @return json
     */
    public function postEdit(Request $request, $id = null)
    {
        $skill = Skill::where('id', $id)->first();

        if (!is_null($skill)) {
            
            Skill::where('id', $id)->update([
                'description' => Input::get('description'),
                'progression_id' => Input::get('progression_id'),
                'level' => Input::get('level'),
                'row' => Input::get('row'),
                'exercise_id' => Input::get('exercise_id'),
                'is_allies' => Input::get('is_allies'),
        ]);


            return Redirect::route('admin.skills')->with('success', 'Skill updated successfully');
        } else {

            return Redirect::route('admin.skills', $id)->withInput()->with('error', 'Skill not found!');
        }
        // Redirect to the user page
    }

    /**
     * Skill Delete
     * @since 14/01/2015
     * @author aneeshk@cubettech.com
     * @return json
     */
    public function getDelete($id = null)
    {
        $skill = Skill::where('id', $id)->first();

        if (is_null($skill)) {

            $error = 'Skill does not exists.';

            Redirect::route("admin.skills")->with('error', $error);
        }

        Skill::where('id', $id)->delete();

        return Redirect::route("admin.skills")->with('success', 'Successfully deleted skill.');
    }

    /**
     * Skill Delete
     * @since 14/01/2015
     * @author aneeshk@cubettech.com
     * @return json
     */
    public function getModalDelete($id = null)
    {
        $model = 'skills';

        $confirm_route = $error = null;

        $entity = 'skill';

        $skill = Skill::where('id', $id)->first();

        if (is_null($skill)) {
            $error = 'Skill does not exists.';
            return View('admin/layouts/modal_confirmation', compact('error', 'model', 'confirm_route', 'entity'));
        }

        $confirm_route = route('admin.skill.delete', ['id' => $id]);

        return View('admin/layouts/modal_confirmation', compact('error', 'model', 'confirm_route', 'entity'));
    }
}
