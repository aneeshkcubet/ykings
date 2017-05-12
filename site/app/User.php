<?php namespace App;

use Event,
    DB;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use App\Skill;

class User extends Model implements AuthenticatableContract, AuthorizableContract, CanResetPasswordContract
{

    use Authenticatable,
        Authorizable,
        CanResetPassword;

    public static function boot()
    {

        parent::boot();

        static::created(function($user) {
            Event::fire('user.created', $user);
        });

        static::updated(function($user) {
            Event::fire('user.updated', $user);
        });

        static::deleted(function($user) {
            Event::fire('user.deleted', $user);
        });
    }

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['email', 'password', 'status', 'confirmation_code', 'is_featured', 'is_admin', 'is_subscribed_backend', 'referral_code', 'subscription_end_date', 'subscription_start_date'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];
    protected $appends = ['is_subscribed', 'user_raid', 'need_renew'];

    /**
     * Fetch the user's profile via a one to one
     * relationship on the profile table
     */
    public function profile()
    {
        return $this->hasMany('App\Profile', 'user_id', 'id');
    }

    /**
     * Fetch the user's social account via a one to one
     * relationship on the user_social_account table
     */
    public function social()
    {
        return $this->hasMany('App\Social', 'user_id', 'id');
    }

    /**
     * Fetch the user's social account via a one to one
     * relationship on the user_social_account table
     */
    public function settings()
    {
        return $this->hasMany('App\Settings', 'user_id', 'id');
    }

    /**
     * Fetch the user's social account via a one to one
     * relationship on the user_social_account table
     */
    public function feeds()
    {
        return $this->hasMany('App\Feeds', 'user_id', 'id')->with('commentCount');
    }

    /**
     * 
     * @return type
     */
    public function videos()
    {
        return $this->hasMany('App\Uservideo', 'user_id', 'id')->with(['video']);
    }

    /**
     * 
     * @return type
     */
    public function followers()
    {
        return $this->hasMany('App\Follow', 'follow_id', 'id')->with(['followingProfile'])->orderBy('user_id');
    }

    /**
     * 
     * @return type
     */
    public function followings()
    {
        return $this->hasMany('App\Follow', 'user_id', 'id')->with(['followProfile'])->orderBy('follow_id');
    }

    /**
     * Relation with image table.
     * @author <ansa@cubettech.com>
     * @since 16-11-2015
     */
    public function image()
    {
        return $this->hasMany('App\Images', 'parent_id', 'id')->where('parent_type', '=', 2);
    }

    /**
     * Function to set the user is subscribed
     * @depends isSubscribed
     * @return type
     * @author Aneesh K<aneeshk@cubettech.com>
     */
    public function getIsSubscribedAttribute()
    {

        return $this->attributes['is_subscribed'] = $this->isSubscribed($this->id);
    }

    /**
     * Function to check weather renew of subscription needed
     * @depends isSubscribed
     * @return type
     * @author Aneesh K<aneeshk@cubettech.com>
     */
    public function getNeedRenewAttribute()
    {

        return $this->attributes['need_renew'] = $this->needToUpdate($this->id);
    }

    /**
     * Function to set is_subscribed attribute
     * @param type $userId
     * @return int
     */
    public function isSubscribed($userId)
    {
        $time = time();

        $user = DB::table('users')
            ->select('*')
            ->where('id', '=', $userId)
            ->first();

        if (!is_null($user)) {

            $freeUsageDate = strtotime($user->created_at . ' + 2 Weeks');

            if ($time <= $freeUsageDate) {
                return 1;
            }
            
            $adminSubscribed = DB::table('users')
                ->select('*')
                ->where('id', $userId)
                ->where('is_subscribed_backend', 1)
                ->first();

            if (!is_null($adminSubscribed)) {
                $startDate = strtotime(date("Y/m/d 00:00:01", $adminSubscribed->subscription_start_date));
                $endDate = strtotime(date("Y/m/d 23:59:59", $adminSubscribed->subscription_end_date));
                if ($endDate >= $time && $startDate <= $time) {
                    return 1;
                }
            }


            $subscription = DB::table('subscriptions')
                ->select('*')
                ->where('user_id', '=', $userId)
                ->orderBy('id', 'DESC')
                ->first();

            if (!is_null($subscription)) {
                if ($subscription->end_time > $time) {
                    return 1;
                }
            }            
        }
        return 0;
    }

    /**
     * Function to set need_renew attribute
     * @param type $userId
     * @return int
     */
    public function needToUpdate($userId)
    {
        $time = time();

        $user = DB::table('users')
            ->select('*')
            ->where('id', $userId)
            ->first();
        if (!is_null($user)) {            
            
            $subscription = DB::table('subscriptions')
                ->select('*')
                ->where('user_id', '=', $userId)
                ->orderBy('id', 'DESC')
                ->first();

            if (!is_null($subscription)) {
                if ($subscription->end_time >= $time) {
                    return 0;
                }
            }
            
            $adminSubscribed = DB::table('users')
                ->select('*')
                ->where('id', $userId)
                ->where('is_subscribed_backend', 1)
                ->first();
            
            if (!is_null($adminSubscribed)) {                
                if ($adminSubscribed->subscription_end_date >= $time && $adminSubscribed->subscription_start_date <= $time) {
                    return 0;
                }
            }

            $freeUsageDate = strtotime($user->created_at . ' + 2 Weeks');

            if ($time <= $freeUsageDate) {
                return 0;
            }                       
        }
        
        return 1;
    }

    /**
     * Function to get the user raid
     * @return type
     */
    public function getUserRaidAttribute()
    {
        return $this->attributes['user_raid'] = $this->userRaid($this->id);
    }

    /**
     * Function to set the user_raid attribute
     * @return type
     */
    public function userRaid($userId)
    {
        $time = time();
        $userRaid = DB::table('user_goal_options')
            ->select('*')
            ->where('user_id', '=', $userId)
            ->orderBy('id', 'DESC')
            ->first();
        if (is_null($userRaid)) {
            return [];
        } else {
            $raidSkill = Skill::where('id', '=', $userRaid->goal_options)
                ->with(['exercise'])
                ->first();

            if (is_null($userRaid)) {
                return [];
            }

            return ['id' => $raidSkill->id, 'name' => $raidSkill['exercise']->name];
        }
    }
}
