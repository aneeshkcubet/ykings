<?php namespace App;

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

    /**
     * Fetch the user's profile via a one to one
     * relationship on the profile table
     */
    public function profile()
    {
        return $this->hasOne('App\Profile', 'user_id', 'id');
    }

    /**
     * Fetch the user's social account via a one to one
     * relationship on the user_social_account table
     */
    public function social()
    {
        return $this->hasOne('App\Social', 'user_id', 'id');
    }

    /**
     * Fetch the user's social account via a one to one
     * relationship on the user_social_account table
     */
    public function settings()
    {
        return $this->hasMany('App\Settings', 'user_id', 'id');
    }
}
