<?php namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

class Images extends Model
{

    /**
     * Set the database specific table name
     */
    protected $table = 'images';

    /**
     * Set the fillable fields within the model
     */
    protected $fillable = ['user_id',
        'path',
        'description',
        'parent_type',
        'parent_id'
    ];

    /**
     * Define the relationship for the author
     * @return \Illuminate\Database\Query\Builder
     * @author Aneesh K<aneeshk@cubettech.com>
     */
    public function feeds()
    {
        return $this->belongsTo('App\Feeds', 'id', 'parent_id');
    }
}
