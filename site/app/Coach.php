<?php namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use DB;

class Coach extends Model
{

    /**
     * Set the database specific table name
     */
    protected $table = 'coaches';

    /**
     * Set the fillable fields within the model
     */
    protected $fillable = [
        'user_id',
        'focus',
        'height',
        'weight',
        'days',
        'exercises'
    ];
    
    
}
