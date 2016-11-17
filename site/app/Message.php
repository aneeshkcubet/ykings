<?php namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use DB;

class Message extends Model
{

    /**
     * Set the database specific table name
     */
    protected $table = 'message';

    /**
     * Set the fillable fields within the model
     */
    protected $fillable = ['user_id',
        'friend_id',
        'message_type',
        'type_id',
        'read',
        'message'
    ];

}
