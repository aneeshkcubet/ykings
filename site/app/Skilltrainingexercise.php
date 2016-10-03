<?php namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use DB;

class Skilltrainingexercise extends Model
{

    /**
     * Set the database specific table name
     */
    protected $table = 'skilltraining_exercises';

    /**
     * Set the fillable fields within the model
     */
    protected $fillable = [
        'skilltraining_id',
        'category',
        'repititions',
        'exercise_id',
        'unit',
        'sets'
    ];
    
//    protected $hidden = [
//        'skilltraining_id',
//        'category',
//        'repititions',
//        'round',
//        'updated_at',
//        'created_at'
//    ];
    
    /**
     * Relation with video table.
     * @author <aneesh@cubettech.com>
     * @since 11th November 2015
     */
    public function video()
    {
        return $this->hasOne('App\Video', 'parent_id', 'exercise_id');
    }
    
    /**
     * Relation with video table.
     * @author <aneesh@cubettech.com>
     * @since 20th November 2015
     */
    public function exercise()
    {
        return $this->belongsTo('App\Exercise', 'exercise_id', 'id')->with(['video']);
    }
    /**
     * Function to get follower count.
     * @author <ansa@cubettech.com>
     * @since 23-11-2015
     */
    public static function followerCount($userId)
    {
        $followerCount = DB::table('follows')
            ->where('follow_id', $userId)
            ->count();
        return $followerCount;
    }
    
    
}
