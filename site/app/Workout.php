<?php namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use DB;

class Workout extends Model
{

    /**
     * Set the database specific table name
     */
    protected $table = 'workouts';

    /**
     * Set the fillable fields within the model
     */
    protected $fillable = [
        'name',
        'description',
        'rounds',
        'difficulty',
        'category',
        'type',
        'rewards',
        'duration',
        'equipments'
    ];
    protected $hidden = [
        'updated_at',
        'created_at'
    ];

    /**
     * Function to find user workout points.
     * @author <ansa@cubettech.com>
     * @since 9-12-2015
     */
    public static function workoutCount($userId)
    {
        $count = DB::table('workout_users')
                    ->where('user_id', '=', $userId)
                    ->where('status', '=', 1)
                    ->count();

        return $workoutCount = (int) $count;
       
    }
}
