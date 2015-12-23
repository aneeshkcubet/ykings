<?php namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use DB;

class Point extends Model
{

    /**
     * Set the database specific table name
     */
    protected $table = 'points';

    /**
     * Set the fillable fields within the model
     */
    protected $fillable = [
        'points',
        'user_id',
        'activity'
    ];

    /**
     * Function to find level of given user.
     * @author <ansa@cubettech.com>
     * @since 24-11-2015
     */
    public static function userLevel($userId)
    {
        $points = DB::table('points')
            ->where('user_id', '=', $userId)
            ->sum('points');

        $userPoints = (int) $points;

        if ($userPoints > 0) {
            $level = (sqrt(625 + (100 * $userPoints)) - 25) / 50;

            return $userLevel = (int) $level;
        } else {
            return $userLevel = 1;
        }
    }
    /**
     * Function to find user points.
     * @author <ansa@cubettech.com>
     * @since 24-11-2015
     */
    public static function userPoints($userId)
    {
        $points = DB::table('points')
            ->where('user_id', '=', $userId)
            ->sum('points');

        return $userPoints = (int) $points;
       
    }
    
    /**
     * Function to find user points.
     * @author <aneeshk@cubettech.com>
     * @since 8-12-2015
     */
    public static function userPontToNextLevel($userId)
    {
        $points = Point::userPoints($userId);
        $level = Point::userLevel($userId);
        $nextLevel = $level + 1;
        
        $pointsTonextLevel = ((pow(((50*$nextLevel)+25), 2) - 625)/100) - $points;
        
        return $pointsTonextLevel;
        
       
}
}
