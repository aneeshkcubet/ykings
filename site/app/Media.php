<?php namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use DB;

class Media extends Model
{

    /**
     * Set the database specific table name
     */
    protected $table = 'medias';

    /**
     * Set the fillable fields within the model
     */
    protected $fillable = [
        'name',
        'description',
        'path'
    ];
    
}
