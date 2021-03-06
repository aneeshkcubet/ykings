<?php namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\User;

class HiitController extends Controller
{
    /*
      |--------------------------------------------------------------------------
      | Hiit Controller
      |--------------------------------------------------------------------------
      |
      | This controller handles hiits.
      |
     */

    /**
     * 
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('jwt.auth');
    }
}
