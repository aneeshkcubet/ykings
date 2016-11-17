<?php namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use DB;

class Workout extends Model
{

    /**
     * Set the database specific table name
     */
    protected $table = 'workouts';

    /**
     * Set the fillable fields within the model
     */
    protected $fillable = [
        'name',
        'description',
        'rounds',
        'difficulty',
        'category',
        'type',
        'rewards',
        'equipments',
        'is_repsandsets'
    ];
    protected $hidden = [
        'updated_at'
    ];
    protected $appends = ['progression_string'];

    /**
     * Function to set progression_string attribute
     * @return type
     * @author Aneesh K<aneeshk@cubettech.com>
     */
    public function getProgressionStringAttribute()
    {
        return $this->attributes['progression_string'] = self::progressionString($this->description);
    }

    /**
     * Function to stringify muscle groups related to an exercise.
     * @param type $progressions
     * @return type
     * @author Aneesh K<aneeshk@cubettech.com>
     */
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
        foreach ($progrArray as $progr) {
            if (array_key_exists(strtolower($progr), $progressionArray)) {
                $progrsArray[] = $progressionArray[strtolower($progr)];
            }
        }

        return implode(', ', $progrsArray);
//        return $progressions;
    }

    /**
     * Function to find user workout points.
     * @author <ansa@cubettech.com>
     * @since 9-12-2015
     */
    public static function workoutCount($userId)
    {
        $count = DB::table('workout_users')
            ->where('user_id', '=', $userId)
            ->where('status', '=', 1)
            ->count();

        return $workoutCount = (int) $count;
    }
}
