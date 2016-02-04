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
        'repititions',
        'duration',
        'unit',
        'equipment',
        'muscle_groups',
        'range_of_motion',
        'video_tips',
        'pro_tips'
    ];
    protected $hidden = [
        'updated_at',
        'created_at'
    ];
    protected $appends = ['musclegroup_string'];

    public function getMusclegroupStringAttribute()
    {
        return $this->attributes['musclegroup_string'] = self::musclegroupString($this->muscle_groups);
    }

    public static function musclegroupString($muscleGroups)
    {
        $eMuscleGroups = [];
        if ($muscleGroups == '') {
            return '';
        } else {
            $muscleGroupsArray = DB::table('muscle_groups')->lists('name', 'id');
            
            if(is_array($muscleGroups)){
                $emuscleGroupsArray = $muscleGroups;
            } elseif(is_string($muscleGroups)) {
                $emuscleGroupsArray = explode(',', $muscleGroups);
            } else {
                $emuscleGroupsArray = [];
            }                       
            
            foreach ($emuscleGroupsArray as $exerciseMuscleGroup) {
                if(isset($exerciseMuscleGroup) && $exerciseMuscleGroup != '' && !empty($exerciseMuscleGroup) && !is_null($exerciseMuscleGroup)){
                    $eMuscleGroups[] = $muscleGroupsArray[$exerciseMuscleGroup];
                }                
            }

            return implode(', ', $eMuscleGroups);
        }
    }

    /**
     * Relation with video table.
     * @author <aneesh@cubettech.com>
     * @since 11th November 2015
     */
    public function video()
    {
        return $this->hasMany('App\Video', 'parent_id', 'id')->where('parent_type', '=', 1);
    }

    /**
     * Relation with video table.
     * @author <aneesh@cubettech.com>
     * @since 11th November 2015
     */
    public function workoutexercises()
    {
        return $this->hasMany('App\Workoutexercise', 'exercise_id', 'id');
    }
}
