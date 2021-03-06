<?php namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use DB;

class Feeds extends Model
{

    /**
     * Set the database specific table name
     */
    protected $table = 'feeds';

    /**
     * Set the fillable fields within the model
     */
    protected $fillable = [
        'user_id',
        'item_type',
        'item_id',
        'feed_text'
    ];

    /**
     * Relation with user table.
     * @author <ansa@cubettech.com>
     * @since 11-11-2015
     * 
     */
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'id')->with(['profile']);
    }

    /**
     * Relation with user table.
     * @author <ansa@cubettech.com>
     * @since 19-11-2015
     * 
     */
    public function profile()
    {
        return $this->belongsTo('App\Profile', 'user_id', 'user_id')->select(array('user_id', 'first_name', 'last_name', 'image', 'quote', 'gender'));
    }

    /**
     * Relation with image table.
     * @author <ansa@cubettech.com>
     * @since 11-11-2015
     */
    public function image()
    {
        return $this->hasMany('App\Images', 'parent_id', 'id')->where('parent_type', '=', 2);
    }

    /**
     * Relation with clap table.
     * @author <ansa@cubettech.com>
     * @since 11-11-2015
     */
    public function claps()
    {
        return $this->hasMany('App\Clap', 'item_id', 'id')->where('item_type', '=', 'feed');
    }

    /**
     * Relation with comment table.
     * @author <ansa@cubettech.com>
     * @since 11-11-2015
     */
    public function comments()
    {
        return $this->hasMany('App\Comment', 'parent_id', $this->id)->where('parent_type', '=', 'feed')->with(['user']);
    }
}
