<?php namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use DB;

class Invitation extends Model
{

    /**
     * Set the database specific table name
     */
    protected $table = 'invitations';

    /**
     * Set the fillable fields within the model
     */
    protected $fillable = [
        'user_id',
        'email',
        'code',
        'status',
    ];
    protected $hidden = [
        'updated_at',
        'created_at'
    ];

}
