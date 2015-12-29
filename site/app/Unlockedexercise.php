<?php namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use DB;

class Unlockedexercise extends Model
{

    /**
     * Set the database specific table name
     */
    protected $table = 'unlocked_skills';

    /**
     * Set the fillable fields within the model
     */
    protected $fillable = [
        'user_id',
        'skill_id',
        'exercise_id'
    ];
    
    protected $hidden = [
        'updated_at',
        'created_at'
    ];
    
    /**
     * Relation with video table.
     * @author <aneesh@cubettech.com>
     * @since 11th November 2015
     */
    public function exercise()
    {
        return $this->hasOne('App\Exercise', 'id', 'exercise_id')->with(['video']);
    }   
   
    
}
