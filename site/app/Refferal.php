<?php namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use DB;

class Refferal extends Model
{

    /**
     * Set the database specific table name
     */
    protected $table = 'refferals';

    /**
     * Set the fillable fields within the model
     */
    protected $fillable = [
        'user_id',
        'email',
        'marketing_title',
        'parameters',
        'is_coach_subscribed'
    ];
}
