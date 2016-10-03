<?php namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use DB;

class Hiit extends Model
{

    /**
     * Set the database specific table name
     */
    protected $table = 'hiit';

    /**
     * Set the fillable fields within the model
     */
    protected $fillable = [
        'name',
        'description',
        'exercises',
        'rewards',
        'equipment'
    ];
    
    protected $hidden = [
        'updated_at',
        'created_at'
    ];
    
    
}
