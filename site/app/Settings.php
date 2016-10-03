<?php namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{

    /**
     * Set the database specific table name
     */
    protected $table = 'user_settings';

    /**
     * Set the fillable fields within the model
     */
    protected $fillable = [
        'user_id',
        'key',
        'value'
    ];

    /**
     * Define the relationship for the author
     * @return \Illuminate\Database\Query\Builder
     * @author Aneesh K<aneeshk@cubettech.com>     * 
     */
    protected function user()
    {
        return $this->belongsTo('App\User', 'id', 'user_id');
    }
}
