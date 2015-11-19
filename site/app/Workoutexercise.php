<?php namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use DB;

class Workoutexercise extends Model
{

    /**
     * Set the database specific table name
     */
    protected $table = 'workout_exercises';

    /**
     * Set the fillable fields within the model
     */
    protected $fillable = [
        'workout_id',
        'difficulty',
        'repititions',
        'exercise_id',
        'equipments',
        'round' 
    ];
    
    /**
     * Relation with video table.
     * @author <aneesh@cubettech.com>
     * @since 11th November 2015
     */
    public function video()
    {
        return $this->hasMany('App\Video', 'parent_id', 'exercise_id')->where('parent_type', '=', 1);
    }
    
    
}
