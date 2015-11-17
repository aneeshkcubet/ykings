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
    
    
}
