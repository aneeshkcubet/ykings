<?php namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use DB;

class Hiituser extends Model
{

    /**
     * Set the database specific table name
     */
    protected $table = 'hiit_users';

    /**
     * Set the fillable fields within the model
     */
    protected $fillable = [
        'user_id',
        'hiit_id',
        'status',
        'time',
        'is_starred',
        'volume',
        'feed_id'
    ];

    /**
     * Define the relationship for the author
     * @return \Illuminate\Database\Query\Builder
     * @author Aneesh K<aneeshk@cubettech.com>
     */
    public function profile()
    {
        return $this->hasOne('App\Profile', 'user_id', 'user_id');
    }
}
