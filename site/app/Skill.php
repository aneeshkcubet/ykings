<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    /**
     * Set the database specific table name
     */
    protected $table = 'skills';
    
    /**
     * Set the fillable fields within the model
     */
    protected $fillable = [
        'description',
        'progression_id',
        'level',
        'row',
        'exercise_id',
        'substitute'
    ]; 
    
    /**
     * Define the relationship for the exercise
     *
     * @return \Illuminate\Database\Query\Builder
     */
    public function exercise()
    {
        return $this->hasOne('App\Exercise', 'id', 'exercise_id')->with(['video']);
    }
    
    /**
     * Define the relationship for the progression
     *
     * @return \Illuminate\Database\Query\Builder
     */
    public function progression()
    {
        return $this->hasOne('App\Progression', 'id', 'progression_id');
    }

}
