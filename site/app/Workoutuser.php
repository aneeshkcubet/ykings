<?php namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use DB;

class Workout extends Model
{

    /**
     * Set the database specific table name
     */
    protected $table = 'exercises';

    /**
     * Set the fillable fields within the model
     */
    protected $fillable = [
        'workout_id',
        'user_id',
        'status'
    ];
    
    
}
