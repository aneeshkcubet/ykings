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
use App\Hiit;
use App\Exercise;
use App\Workout;
use App\Coach;
use App\User;
use App\Musclegroup;

class CoachController extends Controller
{
    
    public function __construct()
    {        
        $this->middleware('admin');
    }

    /**
     * Index page
     * @since 21/01/2015
     * @author aneeshk@cubettech.com
     * @return json
     */
    public function getIndex()
    {
        $muscleGroups = DB::table('muscle_groups')->lists('name','id');
        
        // Grab all the users
        $coaches = Coach::with(['profile'])->get();

        $coachArray = $coaches->toArray();
        
        $coachArray = array_map(function($coach) use ($muscleGroups){
            $coachMuscleGroups = explode(',', $coach['muscle_groups']);
            $muscles = [];
            if(count($coachMuscleGroups)>0){
                foreach($coachMuscleGroups as $cKey => $coachMuscleGroup){
                    if(array_key_exists($coachMuscleGroup, $muscleGroups)){
                        $muscles[] = $muscleGroups[$coachMuscleGroup];
                    }
                }
                $coach['muscle_groups'] = implode(',', $muscles);
            } else {
                $coach['muscle_groups'] = 'No muscle group selected by user.';
            }
            return $coach;
        }, $coachArray);     

        $user = User::where('id', Auth::user()->id)->with(['profile', 'settings'])->first();

        // Show the page
        return View('admin.coach.index', compact('coachArray', 'user'));
    }
    
    /**
     * View page
     * @since 21/01/2015
     * @author aneeshk@cubettech.com
     * @return json
     */
    public function show($id)
    {
        $coach = Coach::where('id', $id)->first();
        if (!is_null($coach)) {
            $user = User::where('id', Auth::user()->id)->with(['profile', 'settings'])->first();
        } else {
            // Prepare the error message
            $error = 'Coach not found';

            // Redirect to the user management page
            return Redirect::route('admin.coaches')->with('error', $error);
        }
        // Show the page
        return View('admin.coach.show', compact('coach', 'user'));
    }

    /**
     * Coach Delete
     * @since 21/01/2015
     * @author aneeshk@cubettech.com
     * @return json
     */
    public function getDelete($id = null)
    {
        $coach = Coach::where('id', $id)->first();

        if (is_null($coach)) {

            $error = 'Coach does not exists.';

            Redirect::route("admin.coaches")->with('error', $error);
        }

        Coach::where('id', $id)->delete();

        return Redirect::route("admin.coaches")->with('success', 'Successfully removed coach.');
    }

    /**
     * Coach Delete
     * @since 21/01/2015
     * @author aneeshk@cubettech.com
     * @return json
     */
    public function getModalDelete($id = null)
    {
        $model = 'coaches';

        $confirm_route = $error = null;

        $entity = 'coach';

        $coach = Coach::where('id', $id)->first();

        if (is_null($coach)) {
            $error = 'Coach does not exists.';
            return View('admin/layouts/modal_confirmation', compact('error', 'model', 'confirm_route', 'entity'));
        }

        $confirm_route = route('admin.coach.delete', ['id' => $id]);

        return View('admin/layouts/modal_confirmation', compact('error', 'model', 'confirm_route', 'entity'));
    }
}
