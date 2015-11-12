<?php namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use DB;

class Follow extends Model
{

    /**
     * Set the database specific table name
     */
    protected $table = 'user_videos';

    /**
     * Set the fillable fields within the model
     */
    protected $fillable = [
        'user_id',
        'follow_id'
    ];

    /**
     * Relation with user table.
     * @author <aneesh@cubettech.com>
     * @since 12th November 2015
     * 
     */
    public function follower()
    {
        return $this->hasOne('App\User', 'id', 'user_id')->with(['profile']);
    }

    /**
     * Relation with user table.
     * @author <aneesh@cubettech.com>
     * @since 12th November 2015
     */
    public function following()
    {
        return $this->hasOne('App\User', 'id', 'follow_id')->with(['profile']);;
    }

}
