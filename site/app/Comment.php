<?php namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use DB;

class Comment extends Model
{

    /**
     * Set the database specific table name
     */
    protected $table = 'comments';

    /**
     * Set the fillable fields within the model
     */
    protected $fillable = [
        'user_id',
        'parent_type',
        'parent_id',
        'comment_text'
    ];

    /**
     * Relation with user table.
     * @author <ansa@cubettech.com>
     * @since 17-11-2015
     * 
     */
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'id')->with(['profile'])->select(array('id', 'email'));
    }

    /**
     * Relation with user profile table.
     * @author <ansa@cubettech.com>
     * @since 18-11-2015
     * 
     */
    public function profile()
    {
        return $this->hasOne('App\Profile', 'user_id', 'user_id')->select(array('user_id', 'first_name', 'last_name', 'image'));
    }

    /**
     * Function to check user commented this feed.
     * @author <ansa@cubettech.com>
     * @since 19-11-2015
     */
    public static function isCommented($userId, $parentId, $parentType)
    {
        $commentCount = DB::table('comments')
            ->select('*')
            ->where('user_id', '=', $userId)
            ->where('parent_id', '=', $parentId)
            ->where('parent_type', '=', $parentType)
            ->count();

        if ($commentCount <= 0) {
            return 0;
        } else {
            return 1;
        }
    }

    /**
     * Function to get total clap count of a feed.
     * @author <ansa@cubettech.com>
     * @since 23-11-2015
     */
    public static function commentCount($itemId, $itemType)
    {
        $commentCount = DB::table('comments')
            ->where('parent_id', $itemId)
            ->where('parent_type', '=', $itemType)
            ->count();
        return $commentCount;
    }
}
