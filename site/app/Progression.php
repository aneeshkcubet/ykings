<?php namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

class Progression extends Model
{

    /**
     * Set the database specific table name
     */
    protected $table = 'progressions';

    /**
     * Set the fillable fields within the model
     */
    protected $fillable = [
        'name',
        'description'
    ];

    public function getUserProgressionExercise($progressionId, $userId)
    {
        
    }
}
