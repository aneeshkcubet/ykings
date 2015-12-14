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

}
