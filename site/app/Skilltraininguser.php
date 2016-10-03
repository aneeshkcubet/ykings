<?php namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use DB;

class Skilltraininguser extends Model
{

    /**
     * Set the database specific table name
     */
    protected $table = 'skilltraining_users';

    /**
     * Set the fillable fields within the model
     */
    protected $fillable = [
        'skilltraining_id',
        'user_id',
        'status',
        'time',
        'is_starred',
        'volume',
        'focus',
        'is_coach',
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

    /**
     * Function to get skilltraining count.
     * @author <ansa@cubettech.com>
     * @since 23-11-2015
     */
    public static function skilltrainingCount($userId)
    {
        $skilltrainingCount = DB::table('skilltraining_users')
            ->where('user_id', $userId)
            ->count();
        return $skilltrainingCount;
    }
}
