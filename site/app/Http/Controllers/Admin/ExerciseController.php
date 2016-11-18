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
use Yajra\Datatables\Datatables;

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
        $user = User::where('id', Auth::user()->id)->with(['profile', 'settings'])->first();

        // Show the page
        return View('admin.exercise.index', compact('user'));
    }

    /**
     * Process datatables ajax request.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function anyData()
    {
        $posts = Exercise::select('exercises.*');
        $db = DB::table('muscle_groups');
        return Datatables::of($posts)
                ->addColumn('action', function ($list) {
                    $html = '<a href="' . route('admin.exercise.show', $list->id) . '"><i class="glyphicon glyphicon-eye-open" data-name="info" data-size="18" data-loop="true" data-c="#428BCA" data-hc="#428BCA" title="View Exercise Details"></i></a>
                                <a href="' . route('admin.exercise.edit', $list->id) . '"><i class="glyphicon glyphicon-edit" data-name="edit" data-size="18" data-loop="true" data-c="#428BCA" data-hc="#428BCA" title="Edit Exercise Details"></i></a>

                                <a href="' . route('admin.confirm-delete.exercise', $list->id) . '" data-toggle="modal" data-target="#delete_confirm">
                                    <i class="glyphicon glyphicon-remove" data-name="exercise-remove" data-size="18" data-loop="true" data-c="#f56954" data-hc="#f56954" title="delete exercise">
                                    </i>
                                </a>';
                    return $html;
                })
                ->editColumn('category', function ($list) {
                    if ($list->category == 1) {
                        return 'Lean';
                    } elseif ($list->category == 2) {
                        return 'Athletic';
                    } else {
                        return 'Strength';
                    }
                })
                ->editColumn('type', function ($list) {
                    if ($list->type == 1) {
                        return 'Free';
                    } else {
                        return 'Paid';
                    }
                })
                ->editColumn('unit', function ($list) {
                    if ($list->unit == 'times') {
                        return 'Repetitions';
                    } else {
                        return 'Seconds';
                    }
                })
                ->blacklist(['action'])
                ->make(true);
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

        if ((Input::get('pro_tips') != 'Type the pro tips here') && Input::get('pro_tips') != '') {
            $proTipsRaw = str_replace(['<p>', '<div>'], '', Input::get('pro_tips'));
            $proTipsRaw = str_replace(['</p>', '<br>', '<br />', '</div>'], '', $proTipsRaw);
            preg_match_all('!<ul>(.+?)</ul>!s', $proTipsRaw, $ulmatches);

            foreach ($ulmatches[1] AS $ustring) {
                $ulStringRaw = str_replace(['<ul>', '</li>'], '', $ustring);
                $ulStringRaw = str_replace('<li>', '', $ulStringRaw);
                $proTipsRaw = str_replace($ulmatches[0], $ulStringRaw, $proTipsRaw);
            }

            preg_match_all('!<ol>(.+?)</ol>!s', $proTipsRaw, $olmatches);

            foreach ($olmatches[1] AS $ostring) {
                $olStringRaw = str_replace(['<ol>', '</li>'], '', $ostring);
                $olStringRawArray = explode('<li>', $olStringRaw);
                unset($olStringRawArray[0]);
                for ($i = 1; $i <= count($olStringRawArray); $i++) {
                    $olStringRawArray[$i] = $i . '. ' . $olStringRawArray[$i];
                }
                $olStringRaw = implode('', $olStringRawArray);
                $proTipsRaw = str_replace($olmatches[0], $olStringRaw, $proTipsRaw);
            }
            $proTips = htmlspecialchars_decode(html_entity_decode($proTipsRaw), ENT_QUOTES);
            $proTipsHtml = Input::get('pro_tips');
            unset($proTipsRaw);
        } else {
            $proTips = '';
            $proTipsHtml = '';
        }

        if ((Input::get('range_of_motion') != 'Type the range of motion here') && Input::get('range_of_motion') != '') {

            $proTipsRaw = str_replace(['<p>', '<div>'], '', Input::get('range_of_motion'));
            $proTipsRaw = str_replace(['</p>', '<br>', '<br />', '</div>'], '', $proTipsRaw);
            preg_match_all('!<ul>(.+?)</ul>!s', $proTipsRaw, $ulmatches);

            foreach ($ulmatches[1] AS $ustring) {
                $ulStringRaw = str_replace(['<ul>', '</li>'], '', $ustring);
                $ulStringRaw = str_replace('<li>', '', $ulStringRaw);
                $proTipsRaw = str_replace($ulmatches[0], $ulStringRaw, $proTipsRaw);
            }

            preg_match_all('!<ol>(.+?)</ol>!s', $proTipsRaw, $olmatches);

            foreach ($olmatches[1] AS $ostring) {
                $olStringRaw = str_replace(['<ol>', '</li>'], '', $ostring);
                $olStringRawArray = explode('<li>', $olStringRaw);
                unset($olStringRawArray[0]);
                for ($i = 1; $i <= count($olStringRawArray); $i++) {
                    $olStringRawArray[$i] = $i . '. ' . $olStringRawArray[$i];
                }
                $olStringRaw = implode('', $olStringRawArray);
                $proTipsRaw = str_replace($olmatches[0], $olStringRaw, $proTipsRaw);
            }
            $rangeOfMotion = htmlspecialchars_decode(html_entity_decode($proTipsRaw), ENT_QUOTES);
            $rangeOfMotionHtml = Input::get('range_of_motion');
            unset($proTipsRaw);
        } else {
            $rangeOfMotion = '';
            $rangeOfMotionHtml = '';
        }

        if ((Input::get('video_tips') != 'Type the video tips here') && Input::get('video_tips') != '') {
            $proTipsRaw = str_replace(['<p>', '<p></p>', '<p> </p>', '<p>&nbsp;</p>', '<div>'], '', Input::get('video_tips'));
            $proTipsRaw = str_replace(['</p>', '<br>', '<br />', '</div>'], '', $proTipsRaw);
            preg_match_all('!<ul>(.+?)</ul>!s', $proTipsRaw, $ulmatches);

            foreach ($ulmatches[1] AS $ustring) {
                $ulStringRaw = str_replace(['<ul>', '</li>'], '', $ustring);
                $ulStringRaw = str_replace('<li>', '', $ulStringRaw);
                $proTipsRaw = str_replace($ulmatches[0], $ulStringRaw, $proTipsRaw);
            }

            preg_match_all('!<ol>(.+?)</ol>!s', $proTipsRaw, $olmatches);

            foreach ($olmatches[1] AS $ostring) {
                $olStringRaw = str_replace(['<ol>', '</li>'], '', $ostring);
                $olStringRawArray = explode('<li>', $olStringRaw);
                unset($olStringRawArray[0]);
                for ($i = 1; $i <= count($olStringRawArray); $i++) {
                    $olStringRawArray[$i] = $i . '. ' . $olStringRawArray[$i];
                }
                $olStringRaw = implode('', $olStringRawArray);
                $proTipsRaw = str_replace($olmatches[0], $olStringRaw, $proTipsRaw);
            }
            $videoTips = htmlspecialchars_decode(html_entity_decode($proTipsRaw), ENT_QUOTES);
            $videoTipsHtml = Input::get('range_of_motion');
            unset($proTipsRaw);
        } else {
            $videoTips = '';
            $videoTipsHtml = '';
        }

        $muscleGroups = Input::get('muscle_groups');
        $duration = Input::get('repetitions');
        $isStatic = Input::get('is_static');
        $exercise = Exercise::create([
                'name' => Input::get('name'),
                'description' => Input::get('description'),
                'category' => Input::get('category'),
                'type' => Input::get('type'),
                'rewards' => Input::get('rewards'),
                'unit' => Input::get('unit'),
                'equipment' => Input::get('equipment'),
                'muscle_groups' => (isset($muscleGroups) && !empty($muscleGroups != '')) ? implode(',', Input::get('muscle_groups')) : '',
                'range_of_motion' => $rangeOfMotion,
                'video_tips' => $videoTips,
                'pro_tips' => $proTips,
                'range_of_motion_html' => str_replace("\r\n", '', $rangeOfMotionHtml),
                'video_tips_html' => str_replace("\r\n", '', $videoTipsHtml),
                'pro_tips_html' => str_replace("\r\n", '', $proTipsHtml),
                'is_static' => (isset($isStatic)) ? 1 : 0
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

        $isStatic = Input::get('is_static');

        if (!is_null($exercise)) {

            if ((Input::get('pro_tips') != 'Type the pro tips here') && Input::get('pro_tips') != '') {
                $proTipsRaw = str_replace(['<p>', '<div>'], '', Input::get('pro_tips'));
                $proTipsRaw = str_replace(['</p>', '<br>', '<br />', '</div>'], '', $proTipsRaw);
                preg_match_all('!<ul>(.+?)</ul>!s', $proTipsRaw, $ulmatches);

                foreach ($ulmatches[1] AS $ustring) {
                    $ulStringRaw = str_replace(['<ul>', '</li>'], '', $ustring);
                    $ulStringRaw = str_replace('<li>', '', $ulStringRaw);
                    $proTipsRaw = str_replace($ulmatches[0], $ulStringRaw, $proTipsRaw);
                }

                preg_match_all('!<ol>(.+?)</ol>!s', $proTipsRaw, $olmatches);

                foreach ($olmatches[1] AS $ostring) {
                    $olStringRaw = str_replace(['<ol>', '</li>'], '', $ostring);
                    $olStringRawArray = explode('<li>', $olStringRaw);
                    unset($olStringRawArray[0]);
                    for ($i = 1; $i <= count($olStringRawArray); $i++) {
                        $olStringRawArray[$i] = $i . '. ' . $olStringRawArray[$i];
                    }
                    $olStringRaw = implode('', $olStringRawArray);
                    $proTipsRaw = str_replace($olmatches[0], $olStringRaw, $proTipsRaw);
                }
                $proTips = htmlspecialchars_decode(html_entity_decode($proTipsRaw), ENT_QUOTES);
                $proTipsHtml = Input::get('pro_tips');
                unset($proTipsRaw);
            } else {
                $proTips = '';
                $proTipsHtml = '';
            }

            if ((Input::get('range_of_motion') != 'Type the range of motion here') && Input::get('range_of_motion') != '') {

                $proTipsRaw = str_replace(['<p>', '<div>'], '', Input::get('range_of_motion'));
                $proTipsRaw = str_replace(['</p>', '<br>', '<br />', '</div>'], '', $proTipsRaw);
                preg_match_all('!<ul>(.+?)</ul>!s', $proTipsRaw, $ulmatches);

                foreach ($ulmatches[1] AS $ustring) {
                    $ulStringRaw = str_replace(['<ul>', '</li>'], '', $ustring);
                    $ulStringRaw = str_replace('<li>', '', $ulStringRaw);
                    $proTipsRaw = str_replace($ulmatches[0], $ulStringRaw, $proTipsRaw);
                }

                preg_match_all('!<ol>(.+?)</ol>!s', $proTipsRaw, $olmatches);

                foreach ($olmatches[1] AS $ostring) {
                    $olStringRaw = str_replace(['<ol>', '</li>'], '', $ostring);
                    $olStringRawArray = explode('<li>', $olStringRaw);
                    unset($olStringRawArray[0]);
                    for ($i = 1; $i <= count($olStringRawArray); $i++) {
                        $olStringRawArray[$i] = $i . '. ' . $olStringRawArray[$i];
                    }
                    $olStringRaw = implode('', $olStringRawArray);
                    $proTipsRaw = str_replace($olmatches[0], $olStringRaw, $proTipsRaw);
                }
                $rangeOfMotion = htmlspecialchars_decode(html_entity_decode($proTipsRaw), ENT_QUOTES);
                $rangeOfMotionHtml = Input::get('range_of_motion');
                unset($proTipsRaw);
            } else {
                $rangeOfMotion = '';
                $rangeOfMotionHtml = '';
            }

            if ((Input::get('video_tips') != 'Type the video tips here') && Input::get('video_tips') != '') {
                $proTipsRaw = str_replace(['<p>', '<p></p>', '<p> </p>', '<p>&nbsp;</p>', '<div>'], '', Input::get('video_tips'));
                $proTipsRaw = str_replace(['</p>', '<br>', '<br />', '</div>'], '', $proTipsRaw);
                preg_match_all('!<ul>(.+?)</ul>!s', $proTipsRaw, $ulmatches);

                foreach ($ulmatches[1] AS $ustring) {
                    $ulStringRaw = str_replace(['<ul>', '</li>'], '', $ustring);
                    $ulStringRaw = str_replace('<li>', '', $ulStringRaw);
                    $proTipsRaw = str_replace($ulmatches[0], $ulStringRaw, $proTipsRaw);
                }

                preg_match_all('!<ol>(.+?)</ol>!s', $proTipsRaw, $olmatches);

                foreach ($olmatches[1] AS $ostring) {
                    $olStringRaw = str_replace(['<ol>', '</li>'], '', $ostring);
                    $olStringRawArray = explode('<li>', $olStringRaw);
                    unset($olStringRawArray[0]);
                    for ($i = 1; $i <= count($olStringRawArray); $i++) {
                        $olStringRawArray[$i] = $i . '. ' . $olStringRawArray[$i];
                    }
                    $olStringRaw = implode('', $olStringRawArray);
                    $proTipsRaw = str_replace($olmatches[0], $olStringRaw, $proTipsRaw);
                }
                $videoTips = htmlspecialchars_decode(html_entity_decode($proTipsRaw), ENT_QUOTES);
                $videoTipsHtml = Input::get('range_of_motion');
                unset($proTipsRaw);
            } else {
                $videoTips = '';
                $videoTipsHtml = '';
            }

            $duration = Input::get('repetitions');

            Exercise::where('id', $id)->update([
                'name' => Input::get('name'),
                'description' => Input::get('description'),
                'category' => Input::get('category'),
                'type' => Input::get('type'),
                'rewards' => Input::get('rewards'),
                'unit' => Input::get('unit'),
                'equipment' => Input::get('equipment'),
                'muscle_groups' => (isset($muscleGroups) && !empty($muscleGroups != '')) ? implode(',', Input::get('muscle_groups')) : '',
                'range_of_motion' => $rangeOfMotion,
                'video_tips' => $videoTips,
                'pro_tips' => $proTips,
                'range_of_motion_html' => str_replace("\r\n", '', $rangeOfMotionHtml),
                'video_tips_html' => str_replace("\r\n", '', $videoTipsHtml),
                'pro_tips_html' => str_replace("\r\n", '', $proTipsHtml),
                'is_static' => (isset($isStatic)) ? 1 : 0
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

                    if (file_exists(public_path('uploads/videos/') . $video->path)) {
                        unlink(public_path('uploads/videos/') . $video->path);
                    }

                    if (file_exists(config("image.videoThumbPath") . $video->videothumbnail)) {
                        unlink(config("image.videoThumbPath") . $video->videothumbnail);
                    }

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

            return Redirect::route('admin.exercises')->with('success', 'Updated successfully.');
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
