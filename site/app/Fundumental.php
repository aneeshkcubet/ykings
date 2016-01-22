<?php namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use DB;

class Fundumental extends Model
{

    /**
     * Set the database specific table name
     */
    protected $table = 'fundumentals';

    /**
     * Set the fillable fields within the model
     */
    protected $fillable = [
        'row',        
        'exercise_id',
        'duration',
        'unit',
        'is_completed'
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

}
