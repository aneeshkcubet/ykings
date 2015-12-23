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
        'progression_id',
        'level',
        'row',
        'exercise_id'
    ]; 
    
    /**
     * Define the relationship for the author
     *
     * @return \Illuminate\Database\Query\Builder
     */
    public function exercise()
    {
        return $this->hasOne('App\Exercise', 'id', 'exercise_id');
    }

}
