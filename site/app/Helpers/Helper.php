<?php namespace App\Helpers;

use App\Profile;

class Helper
{

    public static function getProfile($userId)
    {
        $profile = Profile::where('user_id', $userId)->first();

        return $profile;
    }
}
