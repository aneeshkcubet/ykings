<?php namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

class Clap extends Model
{

    /**
     * Set the database specific table name
     */
    protected $table = 'claps';

    /**
     * Set the fillable fields within the model
     */
    protected $fillable = ['user_id',
        'item_type',
        'item_id'
        
    ];

    /**
     * Define the relationship for the author
     *
     * @return \Illuminate\Database\Query\Builder
     */
    public function feeds()
    {
       return $this->belongsTo('App\Feeds', 'id', 'item_id');
    }
    
}
