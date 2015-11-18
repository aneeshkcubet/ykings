<?php namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use DB;

class Exercise extends Model
{

    /**
     * Set the database specific table name
     */
    protected $table = 'exercises';

    /**
     * Set the fillable fields within the model
     */
    protected $fillable = [
        'name',
        'description',
        'difficulty',
        'level',
        'rewards',
        'repititions',
        'duration',
        'equipment'
    ];
    
    /**
     * Relation with video table.
     * @author <aneesh@cubettech.com>
     * @since 11th November 2015
     */
    public function video()
    {
        return $this->hasMany('App\Video', 'parent_id', 'id')->where('parent_type', '=', 1);
    }
    
    
}
