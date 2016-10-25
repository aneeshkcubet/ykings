<?php namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use DB;

class Follow extends Model
{

    /**
     * Set the database specific table name
     */
    protected $table = 'follows';

    /**
     * Set the fillable fields within the model
     */
    protected $fillable = [
        'user_id',
        'follow_id'
    ];

    /**
     * Relation with followers.
     * @author Aneesh K<aneeshk@cubettech.com>
     * @since 12th November 2015
     * 
     */
    public function follower()
    {
        return $this->hasOne('App\User', 'id', 'user_id')->with(['profile']);
    }

    /**
     * Relation with following users
     * @author Aneesh K<aneeshk@cubettech.com>
     * @since 12th November 2015
     */
    public function following()
    {
        return $this->hasOne('App\User', 'id', 'follow_id')->with(['profile']);
    }

    /**
     * Relation with follw profile user.
     * @author Aneesh K<aneeshk@cubettech.com>
     * @since 12th November 2015
     */
    public function followProfile()
    {
        return $this->hasOne('App\User', 'id', 'follow_id')->with(['profile']);
    }

    /**
     * Relation with follwing profile user.
     * @author Aneesh K<aneeshk@cubettech.com>
     * @since 12th November 2015
     */
    public function followingProfile()
    {
        return $this->hasOne('App\User', 'id', 'user_id')->with(['profile']);
    }

    /**
     * Function to get follower count.
     * @author <ansa@cubettech.com>
     * @since 23-11-2015
     */
    public static function followerCount($userId)
    {
        $followerCount = DB::table('follows')
            ->where('follow_id', $userId)
            ->count();
        return $followerCount;
    }

    /**
     * Function to check if userId follows given profileId.
     * @author <ansa@cubettech.com>
     * @since 24-11-2015
     */
    public static function isFollowing($userId, $profileId)
    {
        $following = DB::table('follows')
            ->select('*')
            ->where('user_id', '=', $userId)
            ->where('follow_id', '=', $profileId)
            ->count();

        if ($following <= 0) {
            return 0;
        } else {
            return 1;
        }
    }
}
