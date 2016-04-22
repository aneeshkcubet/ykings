<?php namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use App\Point;

class Profile extends Model
{

    /**
     * Set the database specific table name
     */
    protected $table = 'user_profiles';

    /**
     * Set the fillable fields within the model
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'gender',
        'fitness_status',
        'goal',
        'image',
        'cover_image',
        'city',
        'state',
        'country',
        'quote',
        'spot',
        'facebook',
        'twitter',
        'instagram'
    ];
    protected $appends = array('level');

    /**
     * Define the relationship for the author
     * @return \Illuminate\Database\Query\Builder
     * @author Aneesh K<aneeshk@cubettech.com>
     */
    public function user()
    {
        return $this->belongsTo('App\User', 'id', 'user_id');
    }

    /**
     * Function to set user level attribute
     * @return type
     * @author Aneesh K<aneeshk@cubettech.com>
     */
    public function getLevelAttribute()
    {

        return $this->attributes['level'] = $this->getLevel($this->user_id);
    }
    
    /**
     * Function to get user level
     * @param type $userId
     * @return type
     * @author Aneesh K<aneeshk@cubettech.com>
     */
    public function getLevel($userId)
    {
        return Point::userLevel($userId);
    }
}
