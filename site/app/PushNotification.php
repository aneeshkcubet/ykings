<?php namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use DB;

class PushNotification extends Model
{

    /**
     * Set the database specific table name
     */
    protected $table = 'push_notifications';

    /**
     * Set the fillable fields within the model
     */
    protected $fillable = ['user_id',
        'type',
        'device_token'
    ];

 
}
