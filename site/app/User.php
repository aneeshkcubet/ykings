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
    protected $fillable = ['email', 'password', 'status', 'confirmation_code'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];
    
    protected $appends = array('is_subscribed');

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
    
    public function getIsSubscribedAttribute() {
        
        return $this->attributes['is_subscribed'] = $this->isSubscribed($this->id);
    }

    public function isSubscribed($userId)
    {
        $time = time();
        $subscription = DB::table('subscriptions')
            ->select('*')
            ->where('user_id', '=', $userId)
            ->orderBy('id', 'DESC')
            ->first();
        if(is_null($subscription)){
            return 0;
        }        
       
        if($subscription->end_time <= $time){
            return 0;
        } else {
            return 1;
        }
    }
}
