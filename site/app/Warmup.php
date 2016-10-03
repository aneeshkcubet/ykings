<?php namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use DB;

class Warmup extends Model
{

    /**
     * Set the database specific table name
     */
    protected $table = 'warmups';

    /**
     * Set the fillable fields within the model
     */
    protected $fillable = [
        'name',        
        'duration',
        'unit'
    ];

}
