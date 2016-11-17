<?php namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use DB;

class Uservideo extends Model
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
        'video_id'
    ];

    /**
     * Relation with user table.
     * @author <aneeshk@cubettech.com>
     * @since 11th November 2015
     * 
     */
    public function user()
    {
        return $this->hasOne('App\User', 'id', 'user_id')->with(['profile']);
    }

    /**
     * Relation with video table.
     * @author <aneeshk@cubettech.com>
     * @since 11th November 2015
     */
    public function video()
    {
        return $this->hasOne('App\Video', 'id', 'video_id');
    }
}
