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
use App\Exercise;
use App\Profile;
use App\User;
use App\Musclegroup;
use App\Workoutexercise;
use App\Fundumental;
use FFMpeg\FFMpeg;
use FFMpeg\Coordinate\TimeCode as TimeCode;
use App\Video;

class ExerciseController extends Controller
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
        $exercise = Exercise::all();

        $user = User::where('id', Auth::user()->id)->with(['profile', 'settings'])->first();

        // Show the page
        return View('admin.exercise.index', compact('exercise', 'user'));
    }

    /**
     * Exercise create get form.
     * @since 14/01/2015
     * @author aneeshk@cubettech.com
     * @return json
     */
    public function getCreate()
    {
        $user = User::where('id', Auth::user()->id)->with(['profile', 'settings'])->first();

        $muscleGroups = Musclegroup::all();

        // Show the page
        return View('admin.exercise.create', compact('user', 'muscleGroups'));
    }

    /**
     * Exercise create form processing.
     * @since 14/01/2015
     * @author aneeshk@cubettech.com
     * @return json
     */
    public function postCreate(Request $request)
    {
        if (isset($_FILES['video']) && $_FILES['video']['error'] == UPLOAD_ERR_OK) {

            $accepableTypes = ['video/mp4'];

            //Check for valid image type
            if (!in_array($_FILES['video']['type'], $accepableTypes)) {
                $error = 'Please upload a mp4 video.';
                return Redirect::back()->withInput()->with('error', $error);
            }
        }

        $muscleGroups = Input::get('muscle_groups');
        $duration = Input::get('repetitions');
        $exercise = Exercise::create([
                'name' => Input::get('name'),
                'description' => Input::get('description'),
                'category' => Input::get('category'),
                'type' => Input::get('type'),
                'rewards' => Input::get('rewards'),
                'repititions' => Input::get('repetitions'),
                'duration' => $duration,
                'unit' => Input::get('unit'),
                'equipment' => Input::get('equipment'),
                'muscle_groups' => (isset($muscleGroups) && !empty($muscleGroups != '')) ? implode(',', Input::get('muscle_groups')) : '',
                'range_of_motion' => ((Input::get('range_of_motion') == 'Type the range of motion here') || Input::get('range_of_motion') == '') ? '' : Input::get('range_of_motion'),
                'video_tips' => ((Input::get('video_tips') == 'Type the video tips here') || Input::get('video_tips') == '') ? '' : Input::get('video_tips'),
                'pro_tips' => ((Input::get('pro_tips') == 'Type the pro tips here') || Input::get('pro_tips') == '') ? '' : Input::get('pro_tips')
        ]);

        if (!is_null($exercise)) {
            if (isset($_FILES['video']) && $_FILES['video']['error'] == UPLOAD_ERR_OK) {

                $filename = $exercise->id . '_' . time();
                $extension = Input::file('video')->getClientOriginalExtension(); // getting image extension
                $fullName = $filename . '.' . $extension; // renameing image
                Input::file('video')->move(public_path('uploads/videos/'), $fullName);

                echo shell_exec('/usr/bin/ffmpeg -i ' . public_path("uploads/videos/") . $fullName . ' -vf "thumbnail,scale=640:360" -frames:v 1 ' . config("image.videoThumbPath") . $filename . '.png');

                Video::create([
                    'user_id' => Auth::user()->id,
                    'path' => $fullName,
                    'description' => $exercise->name,
                    'videothumbnail' => $filename . '.png',
                    'parent_type' => 1,
                    'parent_id' => $exercise->id,
                    'type' => 1
                ]);
            }


            // Redirect to the home page with success menu
            return Redirect::route("admin.exercises")->with('success', 'Successfully created exercise.');
        }

        // Redirect to the exercise creation page
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

        $muscleGroups = Musclegroup::all();
        $exercise = Exercise::where('id', $id)->with(['video'])->first();
        $exercise->muscle_groups = explode(',', $exercise->muscle_groups);
        // Get the user information
        if (!is_null($exercise)) {
            $user = User::where('id', Auth::user()->id)->with(['profile', 'settings'])->first();
        } else {
            // Prepare the error message
            $error = 'Exercise not found';

            // Redirect to the user management page
            return Redirect::route('admin.exercises')->with('error', $error);
        }
        // Show the page
        return View('admin.exercise.show', compact('exercise', 'user'));
    }

    /**
     * Exercise Edit page
     * @since 14/01/2015
     * @author aneeshk@cubettech.com
     * @return json
     */
    public function getEdit($id = null)
    {

        $muscleGroups = Musclegroup::all();
        $exercise = Exercise::where('id', $id)->with(['video'])->first();
        $eMgroups = explode(',', $exercise->muscle_groups);

        if (count($eMgroups) > 0) {
            foreach ($muscleGroups as $mgKey => $muscleGroup) {
                if (in_array($muscleGroup->id, $eMgroups)) {
                    $muscleGroups[$mgKey]->selected = 1;
                } else {
                    $muscleGroups[$mgKey]->selected = 0;
                }
            }
        }
        // Get the user information
        if (!is_null($exercise)) {
            $user = User::where('id', Auth::user()->id)->with(['profile', 'settings'])->first();

            return View('admin.exercise.edit', compact('exercise', 'user', 'muscleGroups'));
        } else {
            // Prepare the error message
            $error = 'Exercise not found';

            // Redirect to the user management page
            return Redirect::route('admin.exercises')->with('error', $error);
        }

        // Show the page
        return View('admin.exercise.edit', compact('user', 'exercise', 'muscleGroups'));
    }

    /**
     * Exercise Post Edit page
     * @since 14/01/2015
     * @author aneeshk@cubettech.com
     * @return json
     */
    public function postEdit(Request $request, $id = null)
    {
        if (isset($_FILES['video']) && $_FILES['video']['error'] == UPLOAD_ERR_OK) {

            $accepableTypes = ['video/mp4'];

            //Check for valid image type
            if (!in_array($_FILES['video']['type'], $accepableTypes)) {
                $error = 'Please upload a mp4 video.';
                return Redirect::back()->withInput()->with('error', $error);
            }
        }
        $exercise = Exercise::where('id', $id)->first();

        $muscleGroups = Input::get('muscle_groups');

        if (!is_null($exercise)) {

            $duration = Input::get('repetitions');
            Exercise::where('id', $id)->update([
                'name' => Input::get('name'),
                'description' => Input::get('description'),
                'category' => Input::get('category'),
                'type' => Input::get('type'),
                'rewards' => Input::get('rewards'),
                'repititions' => Input::get('repetitions'),
                'duration' => $duration,
                'unit' => Input::get('unit'),
                'equipment' => Input::get('equipment'),
                'muscle_groups' => (isset($muscleGroups) && !empty($muscleGroups != '')) ? implode(',', Input::get('muscle_groups')) : '',
                'range_of_motion' => ((Input::get('range_of_motion') == 'Type the range of motion here') || Input::get('range_of_motion') == '') ? '' : Input::get('range_of_motion'),
                'video_tips' => ((Input::get('video_tips') == 'Type the video tips here') || Input::get('video_tips') == '') ? '' : Input::get('video_tips'),
                'pro_tips' => ((Input::get('pro_tips') == 'Type the pro tips here') || Input::get('pro_tips') == '') ? '' : Input::get('pro_tips')
            ]);
            
            Fundumental::where('exercise_id', $id)->update(['unit' => Input::get('unit')]);
            
            Workoutexercise::where('exercise_id', $id)->update(['unit' => Input::get('unit')]);

            if (isset($_FILES['video']) && $_FILES['video']['error'] == UPLOAD_ERR_OK) {

                $video = Video::where('parent_id', $exercise->id)->where('parent_type', 1)->first();

                $filename = $exercise->id . '_' . time();
                $extension = Input::file('video')->getClientOriginalExtension(); // getting image extension
                $fullName = $filename . '.' . $extension; // renameing image
                Input::file('video')->move(public_path('uploads/videos/'), $fullName);

                echo shell_exec('/usr/bin/ffmpeg -i ' . public_path("uploads/videos/") . $fullName . ' -vf "thumbnail,scale=640:360" -frames:v 1 ' . config("image.videoThumbPath") . $filename . '.jpg');

                if (!is_null($video)) {

                    //Unlink previusly uploaded file and thumbnail

                    unlink(public_path('uploads/videos/') . $video->path);

                    unlink(config("image.videoThumbPath") . $video->videothumbnail);

                    Video::where('parent_id', $exercise->id)->where('parent_type', 1)->update([
                        'user_id' => Auth::user()->id,
                        'path' => $fullName,
                        'description' => $exercise->name,
                        'videothumbnail' => $filename . '.jpg'
                    ]);
                } else {
                    Video::create([
                        'user_id' => Auth::user()->id,
                        'path' => $fullName,
                        'description' => $exercise->name,
                        'videothumbnail' => $filename . '.jpg',
                        'parent_type' => 1,
                        'parent_id' => $exercise->id,
                        'type' => 1
                    ]);
                }
            } else {
                $video = Video::where('parent_id', $exercise->id)->where('parent_type', 1)->update([
                        'description' => $exercise->name
                ]);
            }

            return Redirect::route('admin.exercises')->with('success', 'Updated successfully');
        } else {

            return Redirect::route('admin.exercises', $id)->withInput()->with('error', 'Exercise not found!');
        }
        // Redirect to the user page
    }

    /**
     * Exercise Delete
     * @since 14/01/2015
     * @author aneeshk@cubettech.com
     * @return json
     */
    public function getDelete($id = null)
    {
        $exercise = Exercise::where('id', $id)->first();

        if (is_null($exercise)) {

            $error = 'Exercise does not exists.';

            Redirect::route("admin.exercises")->with('error', $error);
        }

        Exercise::where('id', $id)->delete();

        return Redirect::route("admin.exercises")->with('success', 'Successfully deleted exercise.');
    }

    /**
     * Exercise Delete
     * @since 14/01/2015
     * @author aneeshk@cubettech.com
     * @return json
     */
    public function getModalDelete($id = null)
    {
        $model = 'exercises';

        $confirm_route = $error = null;

        $entity = 'exercise';

        $exercise = Exercise::where('id', $id)->first();

        if (is_null($exercise)) {
            $error = 'Exercise does not exists.';
            return View('admin/layouts/modal_confirmation', compact('error', 'model', 'confirm_route', 'entity'));
        }

        $confirm_route = route('admin.exercise.delete', ['id' => $id]);

        return View('admin/layouts/modal_confirmation', compact('error', 'model', 'confirm_route', 'entity'));
    }
}
