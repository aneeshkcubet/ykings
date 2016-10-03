<?php namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use DB;

class Skilltraining extends Model
{

    /**
     * Set the database specific table name
     */
    protected $table = 'skilltrainings';

    /**
     * Set the fillable fields within the model
     */
    protected $fillable = [
        'name',
        'description',
        'rewards',
        'equipments',
        'is_circuit'
    ];
    protected $hidden = [
        'updated_at'
    ];
    
    protected $appends = ['progression_string'];

    /**
     * Function to stringify muscle groups related to an exercise.
     * @return type
     * @author Aneesh K<aneeshk@cubettech.com>
     */
    public function getProgressionStringAttribute()
    {
        return $this->attributes['progression_string'] = self::progressionString($this->description);
    }

    public static function progressionString($progressions)
    {
        $progressionArray = Array(
            "a" => 'Pull',
            "b" => 'Dip',
            "c" => 'Full Body',
            "d" => 'Push',
            "e" => 'Core'
        );
        $progrArray = explode(',', $progressions);
        $progrsArray = [];
        foreach($progrArray as $progr){
            if(array_key_exists(strtolower($progr), $progressionArray)){
                $progrsArray[] = $progressionArray[strtolower($progr)];
            }
        }
        
        return implode(', ', $progrsArray);  
//        return $progressions;
    }

    /**
     * Function to find user skilltraining points.
     * @author <ansa@cubettech.com>
     * @since 9-12-2015
     */
    public static function skilltrainingCount($userId)
    {
        $count = DB::table('skilltraining_users')
            ->where('user_id', '=', $userId)
            ->where('status', '=', 1)
            ->count();

        return $skilltrainingCount = (int) $count;
    }
}
