<?php namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use DB;
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

    /**
     * Function to check user commented this feed.
     * @author <ansa@cubettech.com>
     * @since 19-11-2015
     */
    public static function isClaped($userId, $itemId, $itemType)
    {
        $clapCount = DB::table('claps')
            ->select('*')
            ->where('user_id', '=', $userId)
            ->where('item_id', '=', $itemId)
            ->where('item_type', '=', $itemType)
            ->count();

        if ($clapCount <= 0) {
            return 0;
        } else {
            return 1;
        }
    }
}
