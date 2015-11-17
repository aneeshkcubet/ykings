<?php namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use DB;

class Comment extends Model
{

    /**
     * Set the database specific table name
     */
    protected $table = 'comments';

    /**
     * Set the fillable fields within the model
     */
    protected $fillable = [
        'user_id',
        'parent_type',
        'parent_id',
        'comment_text'
    ];

    /**
     * Relation with user table.
     * @author <ansa@cubettech.com>
     * @since 17-11-2015
     * 
     */
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'id')->with(['profile'])->select(array('id' , 'email'));
    }
}
