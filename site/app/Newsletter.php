<?php namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use DB;

class Newsletter extends Model
{
    /**
     * Set the database specific table name
     */
    protected $table = 'newsletters';

    /**
     * Set the fillable fields within the model
     */
    protected $fillable = [
        'subject',        
        'content',
        'status',
        'subscribers'
    ];
}
