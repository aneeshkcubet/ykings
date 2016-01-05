<?php

namespace App;

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
        'genter',
        'fitness_status',
        'goal',
        'image',
        'city',
        'state',
        'country',
        'quote',
        'spot'        
    ];
    
    
    protected $appends = array('level');

    
    
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
     * 
     * @return type
     */
    public function getLevelAttribute() {
        
        return $this->attributes['level'] = $this->getLevel($this->user_id);
    }
    
    public function getLevel($userId)
    {
        return Point::userLevel($userId);
    }

}
