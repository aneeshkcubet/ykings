<?php namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use DB;

class Video extends Model
{

    public static function boot()
    {

        parent::boot();

        static::created(function($video) {
            if ($video->type == 1) {
                Event::fire('video.created', $video);
            }
        });

        static::deleted(function($video) {
            Event::fire('video.deleted', $video);
        });
    }

    /**
     * Set the database specific table name
     */
    protected $table = 'videos';

    /**
     * Set the fillable fields within the model
     */
    protected $fillable = [
        'user_id',
        'path',
        'parent_type',
        'parent_id'
    ];

    /**
     * Relation with user_videos table.
     * @author <aneesh@cubettech.com>
     * @since 11th November 2015
     * 
     */
    public function uservideos()
    {
        return $this->hasMany('App\Uservideo', 'video_id', 'id');
    }
}
