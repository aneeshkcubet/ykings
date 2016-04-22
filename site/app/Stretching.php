<?php namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use DB;

class Stretching extends Model
{

    /**
     * Set the database specific table name
     */
    protected $table = 'stretchings';

    /**
     * Set the fillable fields within the model
     */
    protected $fillable = [
        'exercise_id',        
        'duration',
        'unit'
    ];
}
