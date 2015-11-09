<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

class Social extends Model {

    /**
     * Set the database specific table name
     */
    protected $table = 'user_social_accounts';

    /**
     * Set the fillable fields within the model
     */
    protected $fillable = [
        'provider',
        'provider_uid'
    ];
 /**
     * Define the relationship for the author
     *
     * @return \Illuminate\Database\Query\Builder
     */
    protected function user()
    {
        return $this->belongsTo('App\User', 'id', 'user_id');
    }
   
}
