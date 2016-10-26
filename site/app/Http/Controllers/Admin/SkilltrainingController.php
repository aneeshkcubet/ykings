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
use App\Skilltraining;
use App\Exercise;
use App\Skilltrainingexercise;
use App\Profile;
use App\User;
use App\Skill;
use Yajra\Datatables\Datatables;

class SkilltrainingController extends Controller
{

    public function __construct()
    {
        $this->middleware('admin');
    }

    /**
     * Index page
     * @since 15/01/2015
     * @author aneeshk@cubettech.com
     * @return json
     */
    public function getIndex()
    {
        // Grab all the users
        $skilltrainings = Skilltraining::all();
        $user = User::where('id', Auth::user()->id)->with(['profile', 'settings'])->first();
        // Show the page
        return View('admin.skilltraining.index', compact('skilltrainings', 'user'));
    }

    /**
     * Process datatables ajax request.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function anyData()
    {
        $posts = Skilltraining::select('skilltrainings.*');
        return Datatables::of($posts)
                ->addColumn('action', function ($list) {
                    $html = '<a href="' . route('admin.skilltraining.show', $list->id) . '"><i class="glyphicon glyphicon-eye-open" data-name="info" data-size="18" data-loop="true" data-c="#428BCA" data-hc="#428BCA" title="View Skilltraining Details"></i></a>
                                <a href="' . route('admin.skilltraining.edit', $list->id) . '"><i class="glyphicon glyphicon-edit" data-name="edit" data-size="18" data-loop="true" data-c="#428BCA" data-hc="#428BCA" title="Edit Skilltraining Details"></i></a>

                                <a href="' . route('admin.confirm-delete.skilltraining', $list->id) . '" data-toggle="modal" data-target="#delete_confirm">
                                    <i class="glyphicon glyphicon-remove" data-name="skilltraining-remove" data-size="18" data-loop="true" data-c="#f56954" data-hc="#f56954" title="delete skilltraining">
                                    </i>
                                </a>';
                    return $html;
                })
                ->editColumn('rewards', function ($list) {
                    $rewardsArray = json_decode($list->rewards);

                    return 'Strength Endurance - ' . $rewardsArray->lean . ', Speed Strength - ' . $rewardsArray->athletic . ', Absolute Strength - ' . $rewardsArray->strength;
                })
                ->editColumn('is_circuit', function ($list) {
                    if ($list->is_circuit == 1) {
                        return 'Yes';
                    } else {
                        return 'No';
                    }
                })
                ->blacklist(['action'])
                ->make(true);
    }

    /**
     * Skilltraining create get form.
     * @since 15/01/2015
     * @author aneeshk@cubettech.com
     * @return json
     */
    public function getCreate()
    {
        $user = User::where('id', Auth::user()->id)->with(['profile', 'settings'])->first();
        $pullRowCount = count(Skill::where('progression_id', 1)->groupBy('row')->get());


        $i = 1;

        do {

            $skill = Skill::where('row', $i)->where('progression_id', 1)->with(['exercise'])->orderBy('skills.level', 'DESC')->first();

            $skills['pull'][$i] = $skill->toArray();

            $i++;
        } while ($i <= $pullRowCount);

        $i = 1;

        $dipRowCount = count(Skill::where('progression_id', 2)->groupBy('row')->get());

        do {
            $skill = Skill::where('row', $i)->where('progression_id', 2)->with(['exercise'])->orderBy('skills.level', 'DESC')->first();

            $skills['dip'][$i] = $skill->toArray();
            $i++;
            unset($skill);
        } while ($i <= $dipRowCount);

        $i = 1;

        $fullBodyRowCount = count(Skill::where('progression_id', 3)->groupBy('row')->get());

        do {

            $skill = Skill::where('row', $i)->where('progression_id', 3)->with(['exercise'])->orderBy('skills.level', 'DESC')->first();

            $skills['full_body'][$i] = $skill->toArray();
            $i++;
            unset($skill);
        } while ($i <= $fullBodyRowCount);

        $i = 1;

        $pushRowCount = count(Skill::where('progression_id', 4)->groupBy('row')->get());

        do {


            $skill = Skill::where('row', $i)->where('progression_id', 4)->with(['exercise'])->orderBy('skills.level', 'DESC')->first();

            $skills['push'][$i] = $skill->toArray();
            $i++;
            unset($skill);
        } while ($i <= $pushRowCount);

        $i = 1;

        $coreRowCount = count(Skill::where('progression_id', 5)->groupBy('row')->get());

        do {

            $skill = Skill::where('row', $i)->where('progression_id', 5)->with(['exercise'])->orderBy('skills.level', 'DESC')->first();

            $skills['core'][$i] = $skill->toArray();
            $i++;
            unset($skill);
        } while ($i <= $coreRowCount);
        // Show the page
        return View('admin.skilltraining.create', compact('user', 'skills'));
    }

    /**
     * Skilltraining create form processing.
     * @since 15/01/2015
     * @author aneeshk@cubettech.com
     * @return json
     */
    public function postCreate()
    {
        $rewardsArray = [
            'lean' => Input::get('lean-rewards'),
            'athletic' => Input::get('athletic-rewards'),
            'strength' => Input::get('strength-rewards')
        ];

        $isCircuit = Input::get('is_circuit');

        $skilltraining = Skilltraining::create([
                'name' => Input::get('name'),
                'description' => Input::get('description'),
                'rewards' => json_encode($rewardsArray),
                'equipments' => Input::get('equipments'),
                'is_circuit' => (isset($isCircuit)) ? 1 : 0
        ]);

        if (!is_null($skilltraining)) {

            // Redirect to the home page with success menu
            return Redirect::route("admin.skilltrainings")->with('success', 'Successfully created skilltraining.');
        }
    }

    /**
     * Show Basic Skilltraining Details
     * @since 15/01/2015
     * @author aneeshk@cubettech.com
     * @return json
     */
    public function show($id)
    {
        $skilltraining = Skilltraining::where('id', $id)->first();
        if (!is_null($skilltraining)) {
            $user = User::where('id', Auth::user()->id)->with(['profile', 'settings'])->first();
            $exercises = [];
            $exercises['lean'] = Skilltrainingexercise::where('category', '=', 1)
                ->where('skilltraining_id', '=', $skilltraining->id)
                ->with(['exercise'])
                ->get();

            $category = 2;

            $exercises['athletic'] = Skilltrainingexercise::where('category', '=', 2)
                ->where('skilltraining_id', '=', $skilltraining->id)
                ->with(['exercise'])
                ->get();

            $category = 3;

            $exercises['strength'] = Skilltrainingexercise::where('category', '=', 3)
                ->where('skilltraining_id', '=', $skilltraining->id)
                ->with(['exercise'])
                ->get();
        } else {
            // Redirect to the user management page
            return Redirect::route('admin.skilltrainings')->with('error', 'Skilltraining not found!!');
        }

        return View('admin.skilltraining.show', compact('skilltraining', 'user', 'exercises'));
    }

    /**
     * Skilltraining Edit page
     * @since 15/01/2015
     * @author aneeshk@cubettech.com
     * @return json
     */
    public function getEdit($id = null)
    {
        $skilltraining = Skilltraining::where('id', $id)->first();
        $pullRowCount = count(Skill::where('progression_id', 1)->groupBy('row')->get());

        $i = 1;

        do {

            $skill = Skill::where('row', $i)->where('progression_id', 1)->with(['exercise'])->orderBy('skills.level', 'DESC')->first();

            $skills['pull'][$i] = $skill->toArray();

            $i++;
        } while ($i <= $pullRowCount);

        $i = 1;

        $dipRowCount = count(Skill::where('progression_id', 2)->groupBy('row')->get());

        do {
            $skill = Skill::where('row', $i)->where('progression_id', 2)->with(['exercise'])->orderBy('skills.level', 'DESC')->first();

            $skills['dip'][$i] = $skill->toArray();
            $i++;
            unset($skill);
        } while ($i <= $dipRowCount);

        $i = 1;

        $fullBodyRowCount = count(Skill::where('progression_id', 3)->groupBy('row')->get());

        do {

            $skill = Skill::where('row', $i)->where('progression_id', 3)->with(['exercise'])->orderBy('skills.level', 'DESC')->first();

            $skills['full_body'][$i] = $skill->toArray();
            $i++;
            unset($skill);
        } while ($i <= $fullBodyRowCount);

        $i = 1;

        $pushRowCount = count(Skill::where('progression_id', 4)->groupBy('row')->get());

        do {


            $skill = Skill::where('row', $i)->where('progression_id', 4)->with(['exercise'])->orderBy('skills.level', 'DESC')->first();

            $skills['push'][$i] = $skill->toArray();
            $i++;
            unset($skill);
        } while ($i <= $pushRowCount);

        $i = 1;

        $coreRowCount = count(Skill::where('progression_id', 5)->groupBy('row')->get());

        do {

            $skill = Skill::where('row', $i)->where('progression_id', 5)->with(['exercise'])->orderBy('skills.level', 'DESC')->first();

            $skills['core'][$i] = $skill->toArray();
            $i++;
            unset($skill);
        } while ($i <= $coreRowCount);

        if (!is_null($skilltraining)) {
            $user = User::where('id', Auth::user()->id)->with(['profile', 'settings'])->first();
            $exercises = [];
            $exercises['lean'] = Skilltrainingexercise::where('category', '=', 1)
                ->where('skilltraining_id', '=', $skilltraining->id)
                ->with(['exercise'])
                ->get();

            $exercises['athletic'] = Skilltrainingexercise::where('category', '=', 2)
                ->where('skilltraining_id', '=', $skilltraining->id)
                ->with(['exercise'])
                ->get();

            $exercises['strength'] = Skilltrainingexercise::where('category', '=', 3)
                ->where('skilltraining_id', '=', $skilltraining->id)
                ->with(['exercise'])
                ->get();
            // Show the page
            return View('admin.skilltraining.edit', compact('skilltraining', 'user', 'exercises', 'skills'));
        } else {
            // Redirect to the user management page
            return Redirect::route('admin.skilltrainings')->with('error', 'Skilltraining not found!!');
        }
    }

    /**
     * Skilltraining Post Edit page
     * @since 15/01/2015
     * @author aneeshk@cubettech.com
     * @return json
     */
    public function postEdit($id = null)
    {
        $skilltraining = Skilltraining::where('id', $id)->first();
        if (!is_null($skilltraining)) {

            $rewardsArray = [
                'lean' => Input::get('lean-rewards'),
                'athletic' => Input::get('athletic-rewards'),
                'strength' => Input::get('strength-rewards')
            ];
            
            $isCircuit = Input::get('is_circuit');

            $skilltraining = Skilltraining::where('id', $skilltraining->id)->update([
                'name' => Input::get('name'),
                'description' => Input::get('description'),
                'rewards' => json_encode($rewardsArray),
                'equipments' => Input::get('equipments'),
                'is_circuit' => (isset($isCircuit)) ? 1 : 0
            ]);
            return Redirect::route('admin.skilltrainings')->with('success', 'Successfully updated the skilltraining.');
        } else {
            // Redirect to the user management page
            return Redirect::route('admin.skilltrainings')->with('error', 'Skilltraining not found!!');
        }

        // Redirect to the user page
        return Redirect::route('admin.skilltraining.edit', $id)->withInput()->with('error', $error);
    }

    /**
     * Skilltraining Delete
     * @since 15/01/2015
     * @author aneeshk@cubettech.com
     * @return json
     */
    public function getDelete($id = null)
    {
        $skilltraining = Skilltraining::where('id', $id)->first();

        if (is_null($skilltraining)) {

            $error = 'Skilltraining does not exists!!';

            Redirect::route("admin.skilltrainings")->with('error', $error);
        }

        Skilltraining::where('id', $id)->delete();

        return Redirect::route("admin.skilltrainings")->with('success', 'Successfully deleted skilltraining.');
    }

    /**
     * Skilltraining Delete
     * @since 15/01/2015
     * @author aneeshk@cubettech.com
     * @return json
     */
    public function getModalDelete($id = null)
    {
        $model = 'skilltrainings';

        $confirm_route = $error = null;

        $entity = 'skilltraining';

        $skilltraining = Skilltraining::where('id', $id)->first();

        if (is_null($skilltraining)) {
            $error = 'Skilltraining does not exists!!';
            return View('admin/layouts/modal_confirmation', compact('error', 'model', 'confirm_route', 'entity'));
        }

        $confirm_route = route('admin.skilltraining.delete', ['id' => $id]);

        return View('admin/layouts/modal_confirmation', compact('error', 'model', 'confirm_route', 'entity'));
    }

    /**
     * Skilltraining create get form.
     * @since 15/01/2015
     * @author aneeshk@cubettech.com
     * @return json
     */
    public function getExerciseCreate($id = null)
    {
        $skilltraining = Skilltraining::where('id', $id)->first();
        if (!is_null($skilltraining)) {

            $user = User::where('id', Auth::user()->id)->with(['profile', 'settings'])->first();

            $exercises = Exercise::all();
        } else {
            // Redirect to the user management page
            return Redirect::route('admin.skilltrainings')->with('error', 'Skilltraining not found!!');
        }
        // Show the page
        return View('admin.skilltraining.exercisecreate', compact('user', 'skilltraining', 'exercises'));
    }

    /**
     * Skilltraining create form processing.
     * @since 15/01/2015
     * @author aneeshk@cubettech.com
     * @return json
     */
    public function postExerciseCreate($id = null)
    {
        $skilltraining = Skilltraining::where('id', $id)->first();
        $exercise = Exercise::where('id', Input::get('exercise_id'))->first();

        $skilltrainingId = Input::get('skilltraining_id');
        $category = Input::get('category');
        $repetitions = Input::get('repititions');
        $exerciseId = Input::get('exercise_id');
        $sets = Input::get('sets');
        $skillId = Input::get('skill_id');
        if (!is_null($skilltraining)) {
            $skilltrainingExercise = Skilltrainingexercise::create([
                    'skilltraining_id' => $skilltrainingId,
                    'category' => $category,
                    'repititions' => $repetitions,
                    'exercise_id' => $exerciseId,
                    'unit' => $exercise->unit,
                    'sets' => $sets
            ]);
            // Redirect to the home page with success menu
            return Redirect::route("admin.skilltraining.edit", $skilltraining->id)->with('success', 'Successfully added exercise to skilltraining.');
        }
    }

    /**
     * Skilltraining Edit page
     * @since 15/01/2015
     * @author aneeshk@cubettech.com
     * @return json
     */
    public function getExerciseEdit($id = null)
    {
        $skilltrainingExercise = Skilltrainingexercise::where('id', $id)->with(['exercise'])->first();

        if (!is_null($skilltrainingExercise)) {

            $user = User::where('id', Auth::user()->id)->with(['profile', 'settings'])->first();

            $exercises = Exercise::all();

            $skilltraining = Skilltraining::where('id', $skilltrainingExercise->skilltraining_id)->first();

            return View('admin.skilltraining.exerciseedit', compact('skilltrainingExercise', 'user', 'exercises', 'skilltraining'));
        } else {
            // Redirect to the user management page
            return Redirect::route('admin.skilltrainings')->with('error', 'Skilltraining exercise not found!!');
        }

        // Show the page
        return View('admin.skilltraining.edit', compact('skilltraining', 'user', 'exercises'));
    }

    /**
     * Skilltraining Post Edit page
     * @since 15/01/2015
     * @author aneeshk@cubettech.com
     * @return json
     */
    public function postExerciseEdit($id = null)
    {
        $skilltraining = Skilltraining::where('id', Input::get('skilltraining_id'))->first();
        $exercise = Exercise::where('id', Input::get('exercise_id'))->first();
        if (!is_null($skilltraining)) {
            $skilltrainingExercise = Skilltrainingexercise::where('skilltraining_id', Input::get('skilltraining_id'))
                ->where('id', $id)
                ->update([
                'repititions' => Input::get('repititions'),
                'exercise_id' => Input::get('exercise_id'),
                'unit' => $exercise->unit,
                'sets' => Input::get('sets')
            ]);

            return Redirect::route("admin.skilltraining.edit", $skilltraining->id)->with('success', 'Successfully edited exercise in skilltraining.');
        } else {
            // Redirect to the user management page
            return Redirect::route('admin.skilltrainings')->with('error', 'Skilltraining not found!!');
        }

        // Redirect to the user page
        return Redirect::route('admin.skilltraining.edit', $id)->withInput()->with('error', $error);
    }

    /**
     * Skilltraining Delete
     * @since 15/01/2015
     * @author aneeshk@cubettech.com
     * @return json
     */
    public function getExerciseDelete($id = null)
    {
        $skilltrainingExercise = Skilltrainingexercise::where('id', $id)->first();

        if (is_null($skilltrainingExercise)) {

            $error = 'Exercis does not exists!!';

            Redirect::route("admin.skilltraining.edit", $skilltrainingExercise->skilltraining_id)->with('error', $error);
        }

        Skilltrainingexercise::where('id', $id)->delete();

        return Redirect::route("admin.skilltraining.edit", $skilltrainingExercise->skilltraining_id)->with('success', 'Successfully deleted exercise in skilltraining.');
    }
}
