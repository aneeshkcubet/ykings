<?php namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{

    /**
     * Set the database specific table name
     */
    protected $table = 'subscriptions';

    /**
     * Set the fillable fields within the model
     */
    protected $fillable = [
        'user_id',
        'plan_id',
        'amount',
        'currency',
        'transaction_id',
        'start_time',
        'end_time',
        'details',
        'status'
    ];

    /**
     * Define the relationship for the author     *
     * @return \Illuminate\Database\Query\Builder
     * @author Aneesh K<aneeshk@cubettech.com>
     */
    protected function user()
    {
        return $this->belongsTo('App\User', 'id', 'user_id');
    }

    /**
     * Define the relationship for the plan
     * @return \Illuminate\Database\Query\Builder
     * @author Aneesh K<aneeshk@cubettech.com>
     */
    protected function plan()
    {
        return $this->belongsTo('App\Plan', 'id', 'plan_id');
    }
}
