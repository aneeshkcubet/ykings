<?php namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{

    /**
     * Set the database specific table name
     */
    protected $table = 'countries';

}
