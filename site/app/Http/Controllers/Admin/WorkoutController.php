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
use App\Workout;
use App\Exercise;
use App\Workoutexercise;
use App\Profile;
use App\User;
use Yajra\Datatables\Datatables;

class WorkoutController extends Controller
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
        $workouts = Workout::all();
        $user = User::where('id', Auth::user()->id)->with(['profile', 'settings'])->first();
        // Show the page
        return View('admin.workout.index', compact('workouts', 'user'));
    }

    /**
     * Process datatables ajax request.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function anyData()
    {
        $posts = Workout::select('workouts.*');
        return Datatables::of($posts)
                ->addColumn('action', function ($list) {
                    $html = '<a href="' . route('admin.workout.show', $list->id) . '"><i class="glyphicon glyphicon-eye-open" data-name="info" data-size="18" data-loop="true" data-c="#428BCA" data-hc="#428BCA" title="View Workout Details"></i></a>
                                <a href="' . route('admin.workout.edit', $list->id) . '"><i class="glyphicon glyphicon-edit" data-name="edit" data-size="18" data-loop="true" data-c="#428BCA" data-hc="#428BCA" title="Edit Workout Details"></i></a>

                                <a href="' . route('admin.confirm-delete.workout', $list->id) . '" data-toggle="modal" data-target="#delete_confirm">
                                    <i class="glyphicon glyphicon-remove" data-name="workout-remove" data-size="18" data-loop="true" data-c="#f56954" data-hc="#f56954" title="delete workout">
                                    </i>
                                </a>';
                    return $html;
                })
                ->editColumn('category', function ($list) {
                    if ($list->category == 1) {
                        return 'Strength';
                    } elseif ($list->category == 2) {
                        return 'HIIT-Strength';
                    }
                })
                ->editColumn('type', function ($list) {
                    if ($list->type == 1) {
                        return 'Free';
                    } else {
                        return 'Paid';
                    }
                })
                ->editColumn('rewards', function ($list) {
                    $rewardsArray = json_decode($list->rewards);

                    return 'Strength Endurance - ' . $rewardsArray->lean . ', Speed Strength - ' . $rewardsArray->athletic . ', Absolute Strength - ' . $rewardsArray->strength;
                })
                ->blacklist(['action'])
                ->make(true);
    }

    /**
     * Workout create get form.
     * @since 15/01/2015
     * @author aneeshk@cubettech.com
     * @return json
     */
    public function getCreate()
    {
        $user = User::where('id', Auth::user()->id)->with(['profile', 'settings'])->first();
        // Show the page
        return View('admin.workout.create', compact('user'));
    }

    /**
     * Workout create form processing.
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

        $workout = Workout::create([
                'name' => Input::get('name'),
                'description' => Input::get('description'),
                'rounds' => Input::get('rounds'),
                'category' => Input::get('category'),
                'type' => Input::get('type'),
                'rewards' => json_encode($rewardsArray),
                'equipments' => Input::get('equipments'),
                'is_repsandsets' => Input::get('is_repsandsets')
        ]);

        if (!is_null($workout)) {

            // Redirect to the home page with success menu
            return Redirect::route("admin.workouts")->with('success', 'Successfully created workout.');
        }
    }

    /**
     * Show Basic Workout Details
     * @since 15/01/2015
     * @author aneeshk@cubettech.com
     * @return json
     */
    public function show($id)
    {
        $workout = workout::where('id', $id)->first();
        if (!is_null($workout)) {
            $user = User::where('id', Auth::user()->id)->with(['profile', 'settings'])->first();

            $rounds = $workout->rounds;
            $count = 1;
            $exercises = [];
            do {
                $exercises['lean']['round' . $count] = Workoutexercise::where('category', '=', 1)
                    ->where('round', '=', $count)
                    ->where('workout_id', '=', $workout->id)
                    ->with(['exercise'])
                    ->get();
                $count++;
            } while ($count <= $rounds);

            $count = 1;

            $category = 2;
            do {
                $exercises['athletic']['round' . $count] = Workoutexercise::where('category', '=', 2)
                    ->where('round', '=', $count)
                    ->where('workout_id', '=', $workout->id)
                    ->with(['exercise'])
                    ->get();
                $count++;
            } while ($count <= $rounds);

            $count = 1;

            $category = 3;
            do {
                $exercises['strength']['round' . $count] = Workoutexercise::where('category', '=', 3)
                    ->where('round', '=', $count)
                    ->where('workout_id', '=', $workout->id)
                    ->with(['exercise'])
                    ->get();

                $count++;
            } while ($count <= $rounds);
        } else {
            // Redirect to the user management page
            return Redirect::route('admin.workouts')->with('error', 'Workout not found!!');
        }

        return View('admin.workout.show', compact('workout', 'user', 'exercises'));
    }

    /**
     * Workout Edit page
     * @since 15/01/2015
     * @author aneeshk@cubettech.com
     * @return json
     */
    public function getEdit($id = null)
    {
        $workout = workout::where('id', $id)->first();
        if (!is_null($workout)) {
            $user = User::where('id', Auth::user()->id)->with(['profile', 'settings'])->first();

            $rounds = $workout->rounds;
            $count = 1;
            $exercises = [];
            do {
                $exercises['lean']['round' . $count] = Workoutexercise::where('category', '=', 1)
                    ->where('round', '=', $count)
                    ->where('workout_id', '=', $workout->id)
                    ->with(['exercise'])
                    ->get();
                $count++;
            } while ($count <= $rounds);

            $count = 1;

            $category = 2;
            do {
                $exercises['athletic']['round' . $count] = Workoutexercise::where('category', '=', 2)
                    ->where('round', '=', $count)
                    ->where('workout_id', '=', $workout->id)
                    ->with(['exercise'])
                    ->get();
                $count++;
            } while ($count <= $rounds);

            $count = 1;

            $category = 3;
            do {
                $exercises['strength']['round' . $count] = Workoutexercise::where('category', '=', 3)
                    ->where('round', '=', $count)
                    ->where('workout_id', '=', $workout->id)
                    ->with(['exercise'])
                    ->get();

                $count++;
            } while ($count <= $rounds);
        } else {
            // Redirect to the user management page
            return Redirect::route('admin.workouts')->with('error', 'Workout not found!!');
        }

        // Show the page
        return View('admin.workout.edit', compact('workout', 'user', 'exercises'));
    }

    /**
     * Workout Post Edit page
     * @since 15/01/2015
     * @author aneeshk@cubettech.com
     * @return json
     */
    public function postEdit($id = null)
    {
        $workout = workout::where('id', $id)->first();
        if (!is_null($workout)) {

            $rewardsArray = [
                'lean' => Input::get('lean-rewards'),
                'athletic' => Input::get('athletic-rewards'),
                'strength' => Input::get('strength-rewards')
            ];

            $workout = Workout::where('id', $workout->id)->update([
                'name' => Input::get('name'),
                'description' => Input::get('description'),
                'rounds' => Input::get('rounds'),
                'category' => Input::get('category'),
                'type' => Input::get('type'),
                'rewards' => json_encode($rewardsArray),
                'equipments' => Input::get('equipments'),
                'is_repsandsets' => Input::get('is_repsandsets')
            ]);
            return Redirect::route('admin.workouts')->with('success', 'Successfully updated the workout.');
        } else {
            // Redirect to the user management page
            return Redirect::route('admin.workouts')->with('error', 'Workout not found!!');
        }

        // Redirect to the user page
        return Redirect::route('admin.workout.edit', $id)->withInput()->with('error', $error);
    }

    /**
     * Workout Delete
     * @since 15/01/2015
     * @author aneeshk@cubettech.com
     * @return json
     */
    public function getDelete($id = null)
    {
        $workout = Workout::where('id', $id)->first();

        if (is_null($workout)) {

            $error = 'Workout does not exists!!';

            Redirect::route("admin.workouts")->with('error', $error);
        }

        Workout::where('id', $id)->delete();

        return Redirect::route("admin.workouts")->with('success', 'Successfully deleted workout.');
    }

    /**
     * Workout Delete
     * @since 15/01/2015
     * @author aneeshk@cubettech.com
     * @return json
     */
    public function getModalDelete($id = null)
    {
        $model = 'workouts';

        $confirm_route = $error = null;

        $entity = 'workout';

        $workout = Workout::where('id', $id)->first();

        if (is_null($workout)) {
            $error = 'Workout does not exists!!';
            return View('admin/layouts/modal_confirmation', compact('error', 'model', 'confirm_route', 'entity'));
        }

        $confirm_route = route('admin.workout.delete', ['id' => $id]);

        return View('admin/layouts/modal_confirmation', compact('error', 'model', 'confirm_route', 'entity'));
    }

    /**
     * Workout create get form.
     * @since 15/01/2015
     * @author aneeshk@cubettech.com
     * @return json
     */
    public function getExerciseCreate($id = null)
    {
        $workout = workout::where('id', $id)->first();
        if (!is_null($workout)) {
            $exercises = Exercise::all();
            $user = User::where('id', Auth::user()->id)->with(['profile', 'settings'])->first();
        } else {
            // Redirect to the user management page
            return Redirect::route('admin.workouts')->with('error', 'Workout not found!!');
        }
        // Show the page
        return View('admin.workout.exercisecreate', compact('user', 'workout', 'exercises'));
    }

    /**
     * Workout create form processing.
     * @since 15/01/2015
     * @author aneeshk@cubettech.com
     * @return json
     */
    public function postExerciseCreate($id = null)
    {
        $workout = workout::where('id', $id)->first();
        $exercise = Exercise::where('id', Input::get('exercise_id'))->first();

        $workoutId = Input::get('workout_id');
        $category = Input::get('category');
        $repetitions = Input::get('repititions');
        $exerciseId = Input::get('exercise_id');
        $sets = Input::get('sets');
        if (!is_null($workout)) {
            if ($workout->is_repsandsets == 1) {
                $workoutExercise = Workoutexercise::create([
                        'workout_id' => $workoutId,
                        'category' => $category,
                        'repititions' => $repetitions,
                        'exercise_id' => $exerciseId,
                        'unit' => $exercise->unit,
                        'round' => Input::get('round'),
                        'sets' => $sets
                ]);
            } else {
                foreach (Input::get('rounds') as $val) {
                    $workoutExercise = Workoutexercise::create([
                            'workout_id' => $workoutId,
                            'category' => $category,
                            'repititions' => $repetitions,
                            'exercise_id' => $exerciseId,
                            'unit' => $exercise->unit,
                            'round' => $val,
                            'sets' => $sets
                    ]);
                }
            }
            // Redirect to the home page with success menu
            return Redirect::route("admin.workout.edit", $workout->id)->with('success', 'Successfully added exercise to workout.');
        }
    }

    /**
     * Workout Edit page
     * @since 15/01/2015
     * @author aneeshk@cubettech.com
     * @return json
     */
    public function getExerciseEdit($id = null)
    {
        $workoutExercise = Workoutexercise::where('id', $id)->with(['exercise'])->first();

        if (!is_null($workoutExercise)) {

            $user = User::where('id', Auth::user()->id)->with(['profile', 'settings'])->first();

            $exercises = Exercise::all();

            $workout = Workout::where('id', $workoutExercise->workout_id)->first();

            $exerciseRounds = DB::table('workout_exercises')->select('round')->where('workout_id', $workoutExercise->workout_id)->where('exercise_id', $workoutExercise->exercise_id)->get();

            return View('admin.workout.exerciseedit', compact('workoutExercise', 'user', 'exercises', 'workout', 'rounds'));
        } else {
            // Redirect to the user management page
            return Redirect::route('admin.workouts')->with('error', 'Workout exercise not found!!');
        }

        // Show the page
        return View('admin.workout.edit', compact('workout', 'user', 'exercises'));
    }

    /**
     * Workout Post Edit page
     * @since 15/01/2015
     * @author aneeshk@cubettech.com
     * @return json
     */
    public function postExerciseEdit($id = null)
    {
        $workout = workout::where('id', Input::get('workout_id'))->first();
        $exercise = Exercise::where('id', Input::get('exercise_id'))->first();
        if (!is_null($workout)) {
            $workoutExercise = Workoutexercise::where('workout_id', Input::get('workout_id'))
                ->where('id', $id)
                ->update([
                'repititions' => Input::get('repititions'),
                'exercise_id' => Input::get('exercise_id'),
                'unit' => $exercise->unit,
                'sets' => Input::get('sets')
            ]);

            return Redirect::route("admin.workout.edit", $workout->id)->with('success', 'Successfully edited exercise in workout.');
        } else {
            // Redirect to the user management page
            return Redirect::route('admin.workouts')->with('error', 'Workout not found!!');
        }

        // Redirect to the user page
        return Redirect::route('admin.workout.edit', $id)->withInput()->with('error', $error);
    }

    /**
     * Workout Delete
     * @since 15/01/2015
     * @author aneeshk@cubettech.com
     * @return json
     */
    public function getExerciseDelete($id = null)
    {
        $workoutExercise = Workoutexercise::where('id', $id)->first();

        if (is_null($workoutExercise)) {

            $error = 'Exercis does not exists!!';

            Redirect::route("admin.workout.edit", $workoutExercise->workout_id)->with('error', $error);
        }

        Workoutexercise::where('id', $id)->delete();

        return Redirect::route("admin.workout.edit", $workoutExercise->workout_id)->with('success', 'Successfully deleted exercise in workout.');
    }
}
