<?php namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use DB;

class Social extends Model
{

    /**
     * Set the database specific table name
     */
    protected $table = 'user_social_accounts';

    /**
     * Set the fillable fields within the model
     */
    protected $fillable = ['user_id',
        'provider',
        'provider_uid'
    ];

    /**
     * Define the relationship for the author
     *
     * @return \Illuminate\Database\Query\Builder
     */
    public function user()
    {
        return $this->belongsTo('App\User', 'id', 'user_id');
    }

    /**
     * Function to check if user connected with facebbok.
     * @author <ansa@cubettech.com>
     * @since 27-11-2015
     */
    public static function isFacebookConnect($userId)
    {
        $social = DB::table('user_social_accounts')
            ->where('user_id', '=', $userId)
            ->where('provider', '=', 'facebook')
            ->where('provider_uid', '!=', '')
            ->count();
        if ($social <= 0) {
            return 0;
        } else {
            return 1;
        }
    }

    /**
     * Relation with profile table.
     * @author <ansa@cubettech.com>
     * @since 30-11-2015
     */
    public function profile()
    {
        return $this->belongsTo('App\Profile', 'user_id', 'user_id');
    }

    /**
     * Relation with settings table.
     * @author <ansa@cubettech.com>
     * @since 09-12-2015
     */
    public function settings()
    {
        return $this->hasMany('App\Settings', 'user_id', 'user_id');
    }
}
