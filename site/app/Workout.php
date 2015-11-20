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

}
