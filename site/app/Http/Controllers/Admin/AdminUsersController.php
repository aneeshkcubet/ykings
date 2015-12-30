<?php namespace App\Http\Controllers\Admin;

use Auth;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use JWTAuth;

class AdminUsersController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Show the page
        return view('admin.login');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        return 'hh';
//        $this->validate($request, [
//            'email' => 'required|email', 'password' => 'required',
//        ]);
//        $credentials = $request->only('email', 'password');
//        if ($this->auth->attempt($credentials, $request->has('remember'))) {
//            return redirect()->intended($this->redirectPath());
//        } else {
//            return redirect($this->loginPath())
//                    ->withInput($request->only('email', 'remember'))
//                    ->with(['error' => $this->getFailedLoginMessage()]);
//        }
    }
}
