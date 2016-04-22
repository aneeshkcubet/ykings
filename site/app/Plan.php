<?php namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{

    /**
     * Set the database specific table name
     */
    protected $table = 'plans';

    /**
     * Set the fillable fields within the model
     */
    protected $fillable = [
        'name',
        'amount',
        'currency',
        'duration',
        'inapp_id'
    ];

    /**
     * Define the relationship for the author
     * @return \Illuminate\Database\Query\Builder
     * @author Aneesh K<aneeshk@cubettech.com>
     */
    protected function subscriptions()
    {
        return $this->hasMany('App\Subscription', 'plan_id', $this->id);
    }
}
