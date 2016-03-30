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
use App\User;
use App\Profile;
use App\Refferal;
use App\Point;
class SettingController extends Controller
{

    public function __construct()
    {
        $this->middleware('admin');
    }

    /**
     * Plan Edit page
     * @since 14/01/2015
     * @author aneeshk@cubettech.com
     * @return json
     */
    public function getEdit()
    {

        $settings = DB::table('site_settings')->get();
        // Get the user information
        if (!is_null($settings)) {
            $user = User::where('id', Auth::user()->id)->with(['profile', 'settings'])->first();

            return View('admin.setting.edit', compact('settings', 'user'));
        } else {
            return View('admin.setting.edit', compact('user'));
        }
    }

    /**
     * Plan Post Edit page
     * @since 14/01/2015
     * @author aneeshk@cubettech.com
     * @return json
     */
    public function postEdit(Request $request)
    {
        
        $inputArray = $request->except('_token');
        
        foreach($inputArray as $iKey => $input){
            DB::table('site_settings')->where('key', $iKey)->update(['value' => $input]);
        }

        return Redirect::route('admin.settings.edit')->with('success', 'Settings updated successfully');

        // Redirect to the user page
    }
    
    public function refferalIndex(){
        
        // Grab all the refferals
        $refferalsList = Refferal::all();
        
        if(count($refferalsList)>0){            
            foreach($refferalsList as $lKey => $refferal){
                $profile = User::where('email', $refferal->email)->first();
                if(!is_null($profile)){
                    if($profile->is_subscribed == 1){
                        $refferalsList[$lKey]->is_coach_subscribed = 1;
                    }  else {
                        $refferalsList[$lKey]->is_coach_subscribed = 0;
                    }                    
                } else {
                    $refferalsList[$lKey]->is_coach_subscribed = 0;
                }
                
            }            
        }

        $user = User::where('id', Auth::user()->id)->with(['profile', 'settings'])->first();

        // Show the page
        return View('admin.refferals.index', ['refferalsList' => $refferalsList,'user' => $user]);
        
    }
    
}
