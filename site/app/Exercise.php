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
        'category',
        'type',
        'rewards',
        'unit',
        'equipment',
        'muscle_groups',
        'range_of_motion',
        'video_tips',
        'pro_tips',
        'is_static',
        'pro_tips_html',
        'video_tips_html',
        'range_of_motion_html'
    ];
    protected $hidden = [
        'updated_at',
        'created_at'
    ];
    protected $appends = ['musclegroup_string'];

    /**
     * Function to stringify muscle groups related to an exercise.
     * @return type
     * @author Aneesh K<aneeshk@cubettech.com>
     */
    public function getMusclegroupStringAttribute()
    {
        return $this->attributes['musclegroup_string'] = self::musclegroupString($this->muscle_groups);
    }

    /**
     * Function to get get muscle groups of an exercise.
     * @param type $muscleGroups
     * @return string
     * @author Aneesh K<aneeshk@cubettech.com>
     */
    public static function musclegroupString($muscleGroups)
    {
        $eMuscleGroups = [];
        if ($muscleGroups == '') {
            return '';
        } else {
            $muscleGroupsArray = DB::table('muscle_groups')->lists('name', 'id');

            if (is_array($muscleGroups)) {
                $emuscleGroupsArray = $muscleGroups;
            } elseif (is_string($muscleGroups)) {
                $emuscleGroupsArray = explode(',', $muscleGroups);
            } else {
                $emuscleGroupsArray = [];
            }

            foreach ($emuscleGroupsArray as $exerciseMuscleGroup) {
                if (isset($exerciseMuscleGroup) && $exerciseMuscleGroup != '' && !empty($exerciseMuscleGroup) && !is_null($exerciseMuscleGroup)) {
                    $eMuscleGroups[] = $muscleGroupsArray[$exerciseMuscleGroup];
                }
            }

            return implode(', ', $eMuscleGroups);
        }
    }

    /**
     * Relation with video table.
     * @author <aneeshk@cubettech.com>
     * @since 11th November 2015
     */
    public function video()
    {
        return $this->hasMany('App\Video', 'parent_id', 'id');
    }

    /**
     * Relation with video table.
     * @author <aneeshk@cubettech.com>
     * @since 11th November 2015
     */
    public function workoutexercises()
    {
        return $this->hasMany('App\Workoutexercise', 'exercise_id', 'id');
    }
}
