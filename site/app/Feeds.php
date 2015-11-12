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
    protected $fillable = ['user_id',
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
        return $this->belongsTo('App\User');
    }

    /**
     * Relation with image table.
     * @author <ansa@cubettech.com>
     * @since 11-11-2015
     */
    public function images()
    {
        return $this->hasMany('App\Images', 'parent_id', 'id');
    }

    /**
     * Relation with image table.
     * @author <ansa@cubettech.com>
     * @since 11-11-2015
     */
    public function commentCount()
    {
        return $this->belongsTo('App\Comment', 'parent_id', $this->id)->where('parent_type', '=', 'feed');
    }
    /**
     * Relation with image table.
     * @author <ansa@cubettech.com>
     * @since 11-11-2015
     */
    public function clap()
    {
        return $this->hasMany('App\Clap', 'item_id', 'id');
    }
     /**
     * Relation with image table.
     * @author <ansa@cubettech.com>
     * @since 11-11-2015
     */
    public function comment()
    {
        return $this->hasMany('App\Comment', 'parent_type', 'id');
    }
}
