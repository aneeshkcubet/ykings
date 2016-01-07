<?php namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use DB;

class Workoutuser extends Model
{

    /**
     * Set the database specific table name
     */
    protected $table = 'workout_users';

    /**
     * Set the fillable fields within the model
     */
    protected $fillable = [
        'workout_id',
        'user_id',
        'status',
        'time',
        'category',
        'volume',
        'feed_id'
    ];

    /**
     * Define the relationship for the author
     *
     * @return \Illuminate\Database\Query\Builder
     */
    public function profile()
    {
        return $this->hasOne('App\Profile', 'user_id', 'user_id');
    }

    public function completeWorkout($data)
    {
        
    }

    /**
     * Function to get workout count.
     * @author <ansa@cubettech.com>
     * @since 23-11-2015
     */
    public static function workoutCount($userId)
    {
        $workoutCount = DB::table('workout_users')
            ->where('user_id', $userId)
            ->count();
        return $workoutCount;
    }
}
