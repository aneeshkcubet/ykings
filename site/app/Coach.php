<?php namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use DB;
use App\Exercise;
use App\Fundumental;
use App\Stretching;
use App\Musclegroup;
use App\Skill;

class Coach extends Model
{

    /**
     * Set the database specific table name
     */
    protected $table = 'coaches';

    /**
     * Set the fillable fields within the model
     */
    protected $fillable = [
        'user_id',
        'focus',
        'height',
        'weight',
        'days',
        'goal_option',
        'exercises',
        'category',
        'muscle_groups'
    ];
    protected $appends = ['musclegroup_string', 'goaloption_string'];

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
    
    public function getGoaloptionStringAttribute()
    {
        return $this->attributes['goaloption_string'] = self::goaloptionString($this->goal_option);
    }

    public static function goaloptionString($goalOption)
    {
        if ($goalOption == '' || $goalOption == 0) {
            return '';
        } else {
            $skill = Skill::where('id', $goalOption)->with(['exercise'])->first();
            return $skill['exercise']->name();
        }
    }

    public function profile()
    {
        return $this->belongsTo('App\Profile', 'user_id', 'user_id')->select(array('user_id', 'first_name', 'last_name', 'image', 'quote', 'gender'));
    }

    public static function prepareCoachExercises($coachId, $data)
    {
        $coach = [];

        $i = 1;

        do {

            $fundumental = Fundumental::where('row', $i)->with(['exercise'])->get();

            $fundumentalArray[$i] = $fundumental->toArray();

            $i++;
            unset($fundumental);
        } while ($i <= 5);



        $userWorkouts['strength'] = DB::select(self::getUserMatchedWorkoutsQuery(1, $data['focus'], $data['user_id']));

        $userWorkouts['cardio_strength'] = DB::select(self::getUserMatchedWorkoutsQuery(2, $data['focus'], $data['user_id']));

        $warmUps = DB::table('warmups')->select('*')->get();

        if ($data['category'] == 'beginer') {
            foreach ($fundumentalArray as $fKey => $fundumentals) {
                $fundumentalArray[$fKey] = array_map(function ($fundumental) {

                    $fundumentalDurationArray = json_decode($fundumental['duration'], TRUE);

                    $fundumental['duration'] = $fundumentalDurationArray[1];

                    $exercise = Exercise::where('id', $fundumental['exercise_id'])->with(['video'])->first();

                    $fundumental['exercise'] = $exercise->toArray();

                    return $fundumental;
                }, $fundumentals);
            }

            $warmUps = array_map(function($warmUp) {

                $duration = $warmUp->duration;

                $durationArray = json_decode($duration, true);

                $warmUp->duration = $durationArray[1];

                $warmUp->is_completed = 0;

                return $warmUp;
            }, $warmUps);
        } else {
            foreach ($fundumentalArray as $fKey => $fundumentals) {

                $fundumentalArray[$fKey] = array_map(function ($fundumental) {

                    $fundumentalDurationArray = json_decode($fundumental['duration'], TRUE);

                    $fundumental['duration'] = $fundumentalDurationArray[2];

                    $exercise = Exercise::where('id', $fundumental['exercise_id'])->with(['video'])->first();

                    $fundumental['exercise'] = $exercise->toArray();

                    return $fundumental;
                }, $fundumentals);
            }

            $warmUps = array_map(function($warmUp) {

                $duration = $warmUp->duration;

                $durationArray = json_decode($duration, true);

                $warmUp->duration = $durationArray[2];

                $warmUp->is_completed = 0;

                return $warmUp;
            }, $warmUps);
        }
        $stretches = Stretching::all();

        $stretchesArray = $stretches->toArray();

        $stretchesArray = array_map(function($stretch) {

            $duration = $stretch['duration'];

            $stretch['duration'] = json_decode($duration, true);

            return $stretch;
        }, $stretchesArray);


        if ($data['category'] == 'beginer') {
            $coach = self::getCoachForFocus($warmUps, $fundumentalArray, $stretchesArray, $data, $userWorkouts, $data['focus'], 'beginer');
        } else {
            if ($data['test1'] == 1 && $data['test2'] == 0) {
                $coach = self::getCoachForFocus($warmUps, $fundumentalArray, $stretchesArray, $data, $userWorkouts, $data['focus'], 'advanced');
            } else {
                $stretchesArray = array_map(function($stretch) {
                    $stretch['duration']['min'] = round($stretch['duration']['min'] + ($stretch['duration']['min'] * (25 / 100)));
                    $stretch['duration']['max'] = round($stretch['duration']['max'] + ($stretch['duration']['max'] * (25 / 100)));
                    return $stretch;
                }, $stretchesArray);

                $coach = self::getCoachForFocus($warmUps, $fundumentalArray, $stretchesArray, $data, $userWorkouts, $data['focus'], 'professional');
            }
        }

        return $coach;
    }

    public static function getCoachForFocus($warmUps, $fundumentalArray, $stretches, $data, $userWorkouts, $focus, $userLevel)
    {
        $coach = [];
        if ($userLevel == 'beginer') {
            if ($focus == 1) {
                $basicSkills = self::getUserBasicSkills($data['user_id'], $data['muscle_groups'], $focus);
                $exercises = [];
                foreach ($basicSkills as $bKey => $basicSkill) {
                    $exercise = Exercise::where('id', $basicSkill->exercise_id)->with(['video'])->first();
                    if (!is_null($exercise)) {
                        $exercise->is_completed = 0;
                        $exercises[] = $exercise;
                    }
                }

                $day1Workout = self::getWorkoutWithExercises($userWorkouts['cardio_strength'][0]->id, $focus);

                $day3Workout = self::getWorkoutWithExercises($userWorkouts['cardio_strength'][1]->id, $focus);

                $day5Workout = self::getWorkoutWithExercises($userWorkouts['cardio_strength'][2]->id, $focus);

                $day6Workout = self::getWorkoutWithExercises($userWorkouts['cardio_strength'][3]->id, $focus);

                if ($data['days'] == 2) {

                    //Day1 exercise set
                    $coach['day1']['warmup'] = $warmUps;
                    $coach['day1']['is_completed'] = 0;
                    $coach['day1']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day1']['exercises'] = [];
                    $coach['day1']['workout'] = $day1Workout;
                    $coach['day1']['coach_workout_rounds'] = count($day1Workout['exercises']);
                    $coach['day1']['workout_intensity'] = 1;
                    $coach['day1']['hiit'] = [];
                    $coach['day1']['stretching'] = $stretches;
                    $coach['day1']['is_completed'] = 0;

                    //Day2 Exercise set
                    $coach['day2']['warmup'] = $warmUps;
                    $coach['day2']['is_completed'] = 0;
                    $coach['day2']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day2']['exercises'] = $exercises;
                    $coach['day2']['workout'] = [];
                    $coach['day2']['coach_workout_rounds'] = 0;
                    $coach['day2']['workout_intensity'] = 1;
                    $coach['day2']['hiit'] = [['id' => 3, 'intensity' => 3, 'is_completed' => 0]];
                    $coach['day2']['stretching'] = $stretches;
                } elseif ($data['days'] == 3) {

                    $coach['day1']['warmup'] = $warmUps;
                    $coach['day1']['is_completed'] = 0;
                    $coach['day1']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day1']['exercises'] = [];
                    $coach['day1']['workout'] = $day1Workout;
                    $coach['day1']['coach_workout_rounds'] = count($day1Workout['exercises']);
                    $coach['day1']['workout_intensity'] = 1;
                    $coach['day1']['hiit'] = [];
                    $coach['day1']['stretching'] = $stretches;

                    //Day2 Exercise set

                    $coach['day2']['warmup'] = $warmUps;
                    $coach['day2']['is_completed'] = 0;
                    $coach['day2']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day2']['exercises'] = $exercises;
                    $coach['day2']['workout'] = [];
                    $coach['day2']['coach_workout_rounds'] = 0;
                    $coach['day2']['workout_intensity'] = 1;
                    $coach['day2']['hiit'] = [['id' => 3, 'intensity' => 3, 'is_completed' => 0]];
                    $coach['day2']['stretching'] = $stretches;

                    //Day3 exercise set

                    $coach['day3']['warmup'] = $warmUps;
                    $coach['day3']['is_completed'] = 0;
                    $coach['day3']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day3']['exercises'] = [];
                    $coach['day3']['workout'] = $day3Workout;
                    $coach['day3']['coach_workout_rounds'] = count($day3Workout['exercises']);
                    $coach['day3']['workout_intensity'] = 1;
                    $coach['day3']['hiit'] = [];
                    $coach['day3']['stretching'] = $stretches;
                } elseif ($data['days'] == 4) {

                    //Day1 exercise set
                    $coach['day1']['warmup'] = $warmUps;
                    $coach['day1']['is_completed'] = 0;
                    $coach['day1']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day1']['exercises'] = [];
                    $coach['day1']['workout'] = $day1Workout;
                    $coach['day1']['coach_workout_rounds'] = count($day1Workout['exercises']);
                    $coach['day1']['workout_intensity'] = 1;
                    $coach['day1']['hiit'] = [];
                    $coach['day1']['stretching'] = $stretches;

                    //Day2 Exercise set

                    $coach['day2']['warmup'] = $warmUps;
                    $coach['day2']['is_completed'] = 0;
                    $coach['day2']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day2']['exercises'] = $exercises;
                    $coach['day2']['workout'] = [];
                    $coach['day2']['coach_workout_rounds'] = 0;
                    $coach['day2']['workout_intensity'] = 1;
                    $coach['day2']['hiit'] = [['id' => 3, 'intensity' => 3, 'is_completed' => 0]];
                    $coach['day2']['stretching'] = $stretches;

                    //Day3 exercise set                    
                    $coach['day3']['warmup'] = $warmUps;
                    $coach['day3']['is_completed'] = 0;
                    $coach['day3']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day3']['exercises'] = [];
                    $coach['day3']['workout'] = $day3Workout;
                    $coach['day3']['coach_workout_rounds'] = count($day3Workout['exercises']);
                    $coach['day3']['workout_intensity'] = 1;
                    $coach['day3']['hiit'] = [];
                    $coach['day3']['stretching'] = $stretches;

                    //Day4 exercise set
                    $coach['day4']['warmup'] = $warmUps;
                    $coach['day4']['is_completed'] = 0;
                    $coach['day4']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day4']['exercises'] = $exercises;
                    $coach['day4']['workout'] = [];
                    $coach['day4']['coach_workout_rounds'] = 0;
                    $coach['day4']['workout_intensity'] = 1;
                    $coach['day4']['hiit'] = [['id' => 3, 'intensity' => 3, 'is_completed' => 0]];
                    $coach['day4']['stretching'] = $stretches;
                } elseif ($data['days'] == 5) {

                    //Day1 exercise set
                    $coach['day1']['warmup'] = $warmUps;
                    $coach['day1']['is_completed'] = 0;
                    $coach['day1']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day1']['exercises'] = [];
                    $coach['day1']['workout'] = $day1Workout;
                    $coach['day1']['coach_workout_rounds'] = count($day1Workout['exercises']);
                    $coach['day1']['workout_intensity'] = 1;
                    $coach['day1']['hiit'] = [];
                    $coach['day1']['stretching'] = $stretches;

                    //Day2 Exercise set
                    $coach['day2']['warmup'] = $warmUps;
                    $coach['day2']['is_completed'] = 0;
                    $coach['day2']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day2']['exercises'] = $exercises;
                    $coach['day2']['workout'] = [];
                    $coach['day2']['coach_workout_rounds'] = 0;
                    $coach['day2']['workout_intensity'] = 1;
                    $coach['day2']['hiit'] = [['id' => 3, 'intensity' => 3, 'is_completed' => 0]];
                    $coach['day2']['stretching'] = $stretches;

                    //Day3 exercise set
                    $coach['day3']['warmup'] = $warmUps;
                    $coach['day3']['is_completed'] = 0;
                    $coach['day3']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day3']['exercises'] = [];
                    $coach['day3']['workout'] = $day3Workout;
                    $coach['day3']['coach_workout_rounds'] = count($day3Workout['exercises']);
                    $coach['day3']['workout_intensity'] = 1;
                    $coach['day3']['hiit'] = [];
                    $coach['day3']['stretching'] = $stretches;

                    //Day4 exercise set
                    $coach['day4']['warmup'] = $warmUps;
                    $coach['day4']['is_completed'] = 0;
                    $coach['day4']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day4']['exercises'] = $exercises;
                    $coach['day4']['workout'] = [];
                    $coach['day4']['coach_workout_rounds'] = 0;
                    $coach['day4']['workout_intensity'] = 1;
                    $coach['day4']['hiit'] = [['id' => 3, 'intensity' => 3, 'is_completed' => 0]];
                    $coach['day4']['stretching'] = $stretches;

                    //Day5 exercise set                    
                    $coach['day5']['warmup'] = $warmUps;
                    $coach['day5']['is_completed'] = 0;
                    $coach['day5']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day5']['exercises'] = [];
                    $coach['day5']['workout'] = $day5Workout;
                    $coach['day5']['coach_workout_rounds'] = count($day5Workout['exercises']);
                    $coach['day5']['workout_intensity'] = 1;
                    $coach['day5']['hiit'] = [];
                    $coach['day5']['stretching'] = $stretches;
                } elseif ($data['days'] == 6) {
                    //Day1 exercise set
                    $coach['day1']['warmup'] = $warmUps;
                    $coach['day1']['is_completed'] = 0;
                    $coach['day1']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day1']['exercises'] = [];
                    $coach['day1']['workout'] = $day1Workout;
                    $coach['day1']['coach_workout_rounds'] = count($day1Workout['exercises']);
                    $coach['day1']['workout_intensity'] = 1;
                    $coach['day1']['hiit'] = [];
                    $coach['day1']['stretching'] = $stretches;

                    //Day2 Exercise set
                    $coach['day2']['warmup'] = $warmUps;
                    $coach['day2']['is_completed'] = 0;
                    $coach['day2']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day2']['exercises'] = $exercises;
                    $coach['day2']['workout'] = [];
                    $coach['day2']['coach_workout_rounds'] = 0;
                    $coach['day2']['workout_intensity'] = 1;
                    $coach['day2']['hiit'] = [['id' => 3, 'intensity' => 3, 'is_completed' => 0]];
                    $coach['day2']['stretching'] = $stretches;

                    //Day3 exercise set
                    $coach['day3']['warmup'] = $warmUps;
                    $coach['day3']['is_completed'] = 0;
                    $coach['day3']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day3']['exercises'] = [];
                    $coach['day3']['workout'] = $day3Workout;
                    $coach['day3']['coach_workout_rounds'] = count($day3Workout['exercises']);
                    $coach['day3']['workout_intensity'] = 1;
                    $coach['day3']['hiit'] = [];
                    $coach['day3']['stretching'] = $stretches;

                    //Day4 exercise set
                    $coach['day4']['warmup'] = $warmUps;
                    $coach['day4']['is_completed'] = 0;
                    $coach['day4']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day4']['exercises'] = $exercises;
                    $coach['day4']['workout'] = [];
                    $coach['day4']['coach_workout_rounds'] = 0;
                    $coach['day4']['workout_intensity'] = 1;
                    $coach['day4']['hiit'] = [['id' => 3, 'intensity' => 3, 'is_completed' => 0]];
                    $coach['day4']['stretching'] = $stretches;

                    //Day5 exercise set
                    $coach['day5']['warmup'] = $warmUps;
                    $coach['day5']['is_completed'] = 0;
                    $coach['day5']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day5']['exercises'] = $exercises;
                    $coach['day5']['workout'] = [];
                    $coach['day5']['coach_workout_rounds'] = 0;
                    $coach['day5']['workout_intensity'] = 1;
                    $coach['day5']['hiit'] = [['id' => 3, 'intensity' => 3, 'is_completed' => 0]];
                    $coach['day5']['stretching'] = $stretches;

                    //Day6 exercise set                    
                    $coach['day6']['warmup'] = $warmUps;
                    $coach['day6']['is_completed'] = 0;
                    $coach['day6']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day6']['exercises'] = [];
                    $coach['day6']['workout'] = $day5Workout;
                    $coach['day6']['coach_workout_rounds'] = count($day5Workout['exercises']);
                    $coach['day6']['workout_intensity'] = 1;
                    $coach['day6']['hiit'] = [];
                    $coach['day6']['stretching'] = $stretches;
                }
            } elseif ($focus == 2) {

                $basicSkills = self::getUserBasicSkills($data['user_id'], $data['muscle_groups'], $focus);

                $exercises = [];
                foreach ($basicSkills as $bKey => $basicSkill) {
                    $exercises[] = Exercise::where('id', $basicSkill->exercise_id)->with(['video'])->first();
                }

                $day1Workout = self::getWorkoutWithExercises($userWorkouts['cardio_strength'][0]->id, 2);

                $day3Workout = self::getWorkoutWithExercises($userWorkouts['cardio_strength'][1]->id, 2);

                $day5Workout = self::getWorkoutWithExercises($userWorkouts['cardio_strength'][2]->id, 2);

                $day6Workout = self::getWorkoutWithExercises($userWorkouts['cardio_strength'][3]->id, 2);

                if ($data['days'] == 2) {

                    //Day1 exercise set
                    $coach['day1']['warmup'] = $warmUps;
                    $coach['day1']['is_completed'] = 0;
                    $coach['day1']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day1']['exercises'] = [];
                    $coach['day1']['workout'] = $day1Workout;
                    $coach['day1']['coach_workout_rounds'] = count($day1Workout['exercises']);
                    $coach['day1']['workout_intensity'] = 1;
                    $coach['day1']['hiit'] = [];
                    $coach['day1']['stretching'] = $stretches;

                    //Day2 Exercise set
                    $coach['day2']['warmup'] = $warmUps;
                    $coach['day2']['is_completed'] = 0;
                    $coach['day2']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day2']['exercises'] = $exercises;
                    $coach['day2']['workout'] = [];
                    $coach['day2']['coach_workout_rounds'] = 0;
                    $coach['day2']['workout_intensity'] = 1;
                    $coach['day2']['hiit'] = [['id' => 3, 'intensity' => 3, 'is_completed' => 0]];
                    $coach['day2']['stretching'] = $stretches;
                } elseif ($data['days'] == 3) {

                    $coach['day1']['warmup'] = $warmUps;
                    $coach['day1']['is_completed'] = 0;
                    $coach['day1']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day1']['exercises'] = [];
                    $coach['day1']['workout'] = $day1Workout;
                    $coach['day1']['coach_workout_rounds'] = count($day1Workout['exercises']);
                    $coach['day1']['workout_intensity'] = 1;
                    $coach['day1']['hiit'] = [];
                    $coach['day1']['stretching'] = $stretches;

                    //Day2 Exercise set

                    $coach['day2']['warmup'] = $warmUps;
                    $coach['day2']['is_completed'] = 0;
                    $coach['day2']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day2']['exercises'] = $exercises;
                    $coach['day2']['workout'] = [];
                    $coach['day2']['coach_workout_rounds'] = 0;
                    $coach['day2']['workout_intensity'] = 1;
                    $coach['day2']['hiit'] = [['id' => 3, 'intensity' => 3, 'is_completed' => 0]];
                    $coach['day2']['stretching'] = $stretches;

                    //Day3 exercise set

                    $coach['day3']['warmup'] = $warmUps;
                    $coach['day3']['is_completed'] = 0;
                    $coach['day3']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day3']['exercises'] = [];
                    $coach['day3']['workout'] = $day3Workout;
                    $coach['day3']['coach_workout_rounds'] = count($day3Workout['exercises']);
                    $coach['day3']['workout_intensity'] = 1;
                    $coach['day3']['hiit'] = [];
                    $coach['day3']['stretching'] = $stretches;
                } elseif ($data['days'] == 4) {

                    //Day1 exercise set
                    $coach['day1']['warmup'] = $warmUps;
                    $coach['day1']['is_completed'] = 0;
                    $coach['day1']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day1']['exercises'] = [];
                    $coach['day1']['workout'] = $day1Workout;
                    $coach['day1']['coach_workout_rounds'] = count($day1Workout['exercises']);
                    $coach['day1']['workout_intensity'] = 1;
                    $coach['day1']['hiit'] = [];
                    $coach['day1']['stretching'] = $stretches;

                    //Day2 Exercise set

                    $coach['day2']['warmup'] = $warmUps;
                    $coach['day2']['is_completed'] = 0;
                    $coach['day2']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day2']['exercises'] = $exercises;
                    $coach['day2']['workout'] = [];
                    $coach['day2']['coach_workout_rounds'] = 0;
                    $coach['day2']['workout_intensity'] = 1;
                    $coach['day2']['hiit'] = [['id' => 3, 'intensity' => 3, 'is_completed' => 0]];
                    $coach['day2']['stretching'] = $stretches;

                    //Day3 exercise set                    
                    $coach['day3']['warmup'] = $warmUps;
                    $coach['day3']['is_completed'] = 0;
                    $coach['day3']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day3']['exercises'] = [];
                    $coach['day3']['workout'] = $day3Workout;
                    $coach['day3']['coach_workout_rounds'] = count($day3Workout['exercises']);
                    $coach['day3']['workout_intensity'] = 1;
                    $coach['day3']['hiit'] = [];
                    $coach['day3']['stretching'] = $stretches;

                    //Day4 exercise set
                    $coach['day4']['warmup'] = $warmUps;
                    $coach['day4']['is_completed'] = 0;
                    $coach['day4']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day4']['exercises'] = $exercises;
                    $coach['day4']['workout'] = [];
                    $coach['day4']['coach_workout_rounds'] = 0;
                    $coach['day4']['workout_intensity'] = 1;
                    $coach['day4']['hiit'] = [['id' => 3, 'intensity' => 3, 'is_completed' => 0]];
                    $coach['day4']['stretching'] = $stretches;
                } elseif ($data['days'] == 5) {

                    //Day1 exercise set
                    $coach['day1']['warmup'] = $warmUps;
                    $coach['day1']['is_completed'] = 0;
                    $coach['day1']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day1']['exercises'] = [];
                    $coach['day1']['workout'] = $day1Workout;
                    $coach['day1']['coach_workout_rounds'] = count($day1Workout['exercises']);
                    $coach['day1']['workout_intensity'] = 1;
                    $coach['day1']['hiit'] = [];
                    $coach['day1']['stretching'] = $stretches;

                    //Day2 Exercise set
                    $coach['day2']['warmup'] = $warmUps;
                    $coach['day2']['is_completed'] = 0;
                    $coach['day2']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day2']['exercises'] = $exercises;
                    $coach['day2']['workout'] = [];
                    $coach['day2']['coach_workout_rounds'] = 0;
                    $coach['day2']['workout_intensity'] = 1;
                    $coach['day2']['hiit'] = [['id' => 3, 'intensity' => 3, 'is_completed' => 0]];
                    $coach['day2']['stretching'] = $stretches;

                    //Day3 exercise set
                    $coach['day3']['warmup'] = $warmUps;
                    $coach['day3']['is_completed'] = 0;
                    $coach['day3']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day3']['exercises'] = [];
                    $coach['day3']['workout'] = $day3Workout;
                    $coach['day3']['coach_workout_rounds'] = count($day3Workout['exercises']);
                    $coach['day3']['workout_intensity'] = 1;
                    $coach['day3']['hiit'] = [];
                    $coach['day3']['stretching'] = $stretches;

                    //Day4 exercise set
                    $coach['day4']['warmup'] = $warmUps;
                    $coach['day4']['is_completed'] = 0;
                    $coach['day4']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day4']['exercises'] = $exercises;
                    $coach['day4']['workout'] = [];
                    $coach['day4']['coach_workout_rounds'] = 0;
                    $coach['day4']['workout_intensity'] = 1;
                    $coach['day4']['hiit'] = [['id' => 3, 'intensity' => 3, 'is_completed' => 0]];
                    $coach['day4']['stretching'] = $stretches;

                    //Day5 exercise set                    
                    $coach['day5']['warmup'] = $warmUps;
                    $coach['day5']['is_completed'] = 0;
                    $coach['day5']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day5']['exercises'] = [];
                    $coach['day5']['workout'] = $day5Workout;
                    $coach['day5']['coach_workout_rounds'] = count($day5Workout['exercises']);
                    $coach['day5']['workout_intensity'] = 1;
                    $coach['day5']['hiit'] = [];
                    $coach['day5']['stretching'] = $stretches;
                } elseif ($data['days'] == 6) {
                    //Day1 exercise set
                    $coach['day1']['warmup'] = $warmUps;
                    $coach['day1']['is_completed'] = 0;
                    $coach['day1']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day1']['exercises'] = [];
                    $coach['day1']['workout'] = $day1Workout;
                    $coach['day1']['coach_workout_rounds'] = count($day1Workout['exercises']);
                    $coach['day1']['workout_intensity'] = 1;
                    $coach['day1']['hiit'] = [];
                    $coach['day1']['stretching'] = $stretches;

                    //Day2 Exercise set
                    $coach['day2']['warmup'] = $warmUps;
                    $coach['day2']['is_completed'] = 0;
                    $coach['day2']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day2']['exercises'] = $exercises;
                    $coach['day2']['workout'] = [];
                    $coach['day2']['coach_workout_rounds'] = 0;
                    $coach['day2']['workout_intensity'] = 1;
                    $coach['day2']['hiit'] = [['id' => 3, 'intensity' => 3, 'is_completed' => 0]];
                    $coach['day2']['stretching'] = $stretches;

                    //Day3 exercise set
                    $coach['day3']['warmup'] = $warmUps;
                    $coach['day3']['is_completed'] = 0;
                    $coach['day3']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day3']['exercises'] = [];
                    $coach['day3']['workout'] = $day3Workout;
                    $coach['day3']['coach_workout_rounds'] = count($day3Workout['exercises']);
                    $coach['day3']['workout_intensity'] = 1;
                    $coach['day3']['hiit'] = [];
                    $coach['day3']['stretching'] = $stretches;

                    //Day4 exercise set
                    $coach['day4']['warmup'] = $warmUps;
                    $coach['day4']['is_completed'] = 0;
                    $coach['day4']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day4']['exercises'] = $exercises;
                    $coach['day4']['workout'] = [];
                    $coach['day4']['coach_workout_rounds'] = 0;
                    $coach['day4']['workout_intensity'] = 1;
                    $coach['day4']['hiit'] = [['id' => 3, 'intensity' => 3, 'is_completed' => 0]];
                    $coach['day4']['stretching'] = $stretches;

                    //Day5 exercise set
                    $coach['day5']['warmup'] = $warmUps;
                    $coach['day5']['is_completed'] = 0;
                    $coach['day5']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day5']['exercises'] = $exercises;
                    $coach['day5']['workout'] = [];
                    $coach['day5']['coach_workout_rounds'] = 0;
                    $coach['day5']['workout_intensity'] = 1;
                    $coach['day5']['hiit'] = [['id' => 3, 'intensity' => 3, 'is_completed' => 0]];
                    $coach['day5']['stretching'] = $stretches;

                    //Day6 exercise set                    
                    $coach['day6']['warmup'] = $warmUps;
                    $coach['day6']['is_completed'] = 0;
                    $coach['day6']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day6']['exercises'] = [];
                    $coach['day6']['workout'] = $day5Workout;
                    $coach['day6']['coach_workout_rounds'] = count($day5Workout['exercises']);
                    $coach['day6']['workout_intensity'] = 1;
                    $coach['day6']['hiit'] = [];
                    $coach['day6']['stretching'] = $stretches;
                }
            } elseif ($focus == 3) {
                $basicSkills = self::getUserBasicSkills($data['user_id'], $data['muscle_groups'], $focus);
                $exercises = [];
                foreach ($basicSkills as $bKey => $basicSkill) {
                    $exercises[] = Exercise::where('id', $basicSkill->exercise_id)->with(['video'])->first();
                }

                $day1Workout = self::getWorkoutWithExercises($userWorkouts['cardio_strength'][0]->id, 3);

                $day3Workout = self::getWorkoutWithExercises($userWorkouts['cardio_strength'][1]->id, 3);

                $day5Workout = self::getWorkoutWithExercises($userWorkouts['cardio_strength'][2]->id, 3);

                $day6Workout = self::getWorkoutWithExercises($userWorkouts['cardio_strength'][3]->id, 3);

                if ($data['days'] == 2) {

                    //Day1 exercise set
                    $coach['day1']['warmup'] = $warmUps;
                    $coach['day1']['is_completed'] = 0;
                    $coach['day1']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day1']['exercises'] = [];
                    $coach['day1']['workout'] = $day1Workout;
                    $coach['day1']['coach_workout_rounds'] = count($day1Workout['exercises']);
                    $coach['day1']['workout_intensity'] = 1;
                    $coach['day1']['hiit'] = [];
                    $coach['day1']['stretching'] = $stretches;

                    //Day2 Exercise set
                    $coach['day2']['warmup'] = $warmUps;
                    $coach['day2']['is_completed'] = 0;
                    $coach['day2']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day2']['exercises'] = $exercises;
                    $coach['day2']['workout'] = [];
                    $coach['day2']['coach_workout_rounds'] = 0;
                    $coach['day2']['workout_intensity'] = 1;
                    $coach['day2']['hiit'] = [['id' => 3, 'intensity' => 3, 'is_completed' => 0]];
                    $coach['day2']['stretching'] = $stretches;
                } elseif ($data['days'] == 3) {

                    $coach['day1']['warmup'] = $warmUps;
                    $coach['day1']['is_completed'] = 0;
                    $coach['day1']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day1']['exercises'] = [];
                    $coach['day1']['workout'] = $day1Workout;
                    $coach['day1']['coach_workout_rounds'] = count($day1Workout['exercises']);
                    $coach['day1']['workout_intensity'] = 1;
                    $coach['day1']['hiit'] = [];
                    $coach['day1']['stretching'] = $stretches;

                    //Day2 Exercise set

                    $coach['day2']['warmup'] = $warmUps;
                    $coach['day2']['is_completed'] = 0;
                    $coach['day2']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day2']['exercises'] = $exercises;
                    $coach['day2']['workout'] = [];
                    $coach['day2']['coach_workout_rounds'] = 0;
                    $coach['day2']['workout_intensity'] = 1;
                    $coach['day2']['hiit'] = [['id' => 3, 'intensity' => 3, 'is_completed' => 0]];
                    $coach['day2']['stretching'] = $stretches;

                    //Day3 exercise set

                    $coach['day3']['warmup'] = $warmUps;
                    $coach['day3']['is_completed'] = 0;
                    $coach['day3']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day3']['exercises'] = [];
                    $coach['day3']['workout'] = $day3Workout;
                    $coach['day3']['coach_workout_rounds'] = count($day3Workout['exercises']);
                    $coach['day3']['workout_intensity'] = 1;
                    $coach['day3']['hiit'] = [];
                    $coach['day3']['stretching'] = $stretches;
                } elseif ($data['days'] == 4) {

                    //Day1 exercise set
                    $coach['day1']['warmup'] = $warmUps;
                    $coach['day1']['is_completed'] = 0;
                    $coach['day1']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day1']['exercises'] = [];
                    $coach['day1']['workout'] = $day1Workout;
                    $coach['day1']['coach_workout_rounds'] = count($day1Workout['exercises']);
                    $coach['day1']['workout_intensity'] = 1;
                    $coach['day1']['hiit'] = [];
                    $coach['day1']['stretching'] = $stretches;

                    //Day2 Exercise set

                    $coach['day2']['warmup'] = $warmUps;
                    $coach['day2']['is_completed'] = 0;
                    $coach['day2']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day2']['exercises'] = $exercises;
                    $coach['day2']['workout'] = [];
                    $coach['day2']['coach_workout_rounds'] = 0;
                    $coach['day2']['workout_intensity'] = 1;
                    $coach['day2']['hiit'] = [['id' => 3, 'intensity' => 3, 'is_completed' => 0]];
                    $coach['day2']['stretching'] = $stretches;

                    //Day3 exercise set                    
                    $coach['day3']['warmup'] = $warmUps;
                    $coach['day3']['is_completed'] = 0;
                    $coach['day3']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day3']['exercises'] = [];
                    $coach['day3']['workout'] = $day3Workout;
                    $coach['day3']['coach_workout_rounds'] = count($day3Workout['exercises']);
                    $coach['day3']['workout_intensity'] = 1;
                    $coach['day3']['hiit'] = [];
                    $coach['day3']['stretching'] = $stretches;

                    //Day4 exercise set
                    $coach['day4']['warmup'] = $warmUps;
                    $coach['day4']['is_completed'] = 0;
                    $coach['day4']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day4']['exercises'] = $exercises;
                    $coach['day4']['workout'] = [];
                    $coach['day4']['coach_workout_rounds'] = 0;
                    $coach['day4']['workout_intensity'] = 1;
                    $coach['day4']['hiit'] = [['id' => 3, 'intensity' => 3, 'is_completed' => 0]];
                    $coach['day4']['stretching'] = $stretches;
                } elseif ($data['days'] == 5) {

                    //Day1 exercise set
                    $coach['day1']['warmup'] = $warmUps;
                    $coach['day1']['is_completed'] = 0;
                    $coach['day1']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day1']['exercises'] = [];
                    $coach['day1']['workout'] = $day1Workout;
                    $coach['day1']['coach_workout_rounds'] = count($day1Workout['exercises']);
                    $coach['day1']['workout_intensity'] = 1;
                    $coach['day1']['hiit'] = [];
                    $coach['day1']['stretching'] = $stretches;

                    //Day2 Exercise set
                    $coach['day2']['warmup'] = $warmUps;
                    $coach['day2']['is_completed'] = 0;
                    $coach['day2']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day2']['exercises'] = $exercises;
                    $coach['day2']['workout'] = [];
                    $coach['day2']['coach_workout_rounds'] = 0;
                    $coach['day2']['workout_intensity'] = 1;
                    $coach['day2']['hiit'] = [['id' => 3, 'intensity' => 3, 'is_completed' => 0]];
                    $coach['day2']['stretching'] = $stretches;

                    //Day3 exercise set
                    $coach['day3']['warmup'] = $warmUps;
                    $coach['day3']['is_completed'] = 0;
                    $coach['day3']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day3']['exercises'] = [];
                    $coach['day3']['workout'] = $day3Workout;
                    $coach['day3']['coach_workout_rounds'] = count($day3Workout['exercises']);
                    $coach['day3']['workout_intensity'] = 1;
                    $coach['day3']['hiit'] = [];
                    $coach['day3']['stretching'] = $stretches;

                    //Day4 exercise set
                    $coach['day4']['warmup'] = $warmUps;
                    $coach['day4']['is_completed'] = 0;
                    $coach['day4']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day4']['exercises'] = $exercises;
                    $coach['day4']['workout'] = [];
                    $coach['day4']['coach_workout_rounds'] = 0;
                    $coach['day4']['workout_intensity'] = 1;
                    $coach['day4']['hiit'] = [['id' => 3, 'intensity' => 3, 'is_completed' => 0]];
                    $coach['day4']['stretching'] = $stretches;

                    //Day5 exercise set                    
                    $coach['day5']['warmup'] = $warmUps;
                    $coach['day5']['is_completed'] = 0;
                    $coach['day5']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day5']['exercises'] = [];
                    $coach['day5']['workout'] = $day5Workout;
                    $coach['day5']['coach_workout_rounds'] = count($day5Workout['exercises']);
                    $coach['day5']['workout_intensity'] = 1;
                    $coach['day5']['hiit'] = [];
                    $coach['day5']['stretching'] = $stretches;
                } elseif ($data['days'] == 6) {
                    //Day1 exercise set
                    $coach['day1']['warmup'] = $warmUps;
                    $coach['day1']['is_completed'] = 0;
                    $coach['day1']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day1']['exercises'] = [];
                    $coach['day1']['workout'] = $day1Workout;
                    $coach['day1']['coach_workout_rounds'] = count($day1Workout['exercises']);
                    $coach['day1']['workout_intensity'] = 1;
                    $coach['day1']['hiit'] = [];
                    $coach['day1']['stretching'] = $stretches;

                    //Day2 Exercise set
                    $coach['day2']['warmup'] = $warmUps;
                    $coach['day2']['is_completed'] = 0;
                    $coach['day2']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day2']['exercises'] = $exercises;
                    $coach['day2']['workout'] = [];
                    $coach['day2']['coach_workout_rounds'] = 0;
                    $coach['day2']['workout_intensity'] = 1;
                    $coach['day2']['hiit'] = [['id' => 3, 'intensity' => 3, 'is_completed' => 0]];
                    $coach['day2']['stretching'] = $stretches;

                    //Day3 exercise set
                    $coach['day3']['warmup'] = $warmUps;
                    $coach['day3']['is_completed'] = 0;
                    $coach['day3']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day3']['exercises'] = [];
                    $coach['day3']['workout'] = $day3Workout;
                    $coach['day3']['coach_workout_rounds'] = count($day3Workout['exercises']);
                    $coach['day3']['workout_intensity'] = 1;
                    $coach['day3']['hiit'] = [];
                    $coach['day3']['stretching'] = $stretches;

                    //Day4 exercise set
                    $coach['day4']['warmup'] = $warmUps;
                    $coach['day4']['is_completed'] = 0;
                    $coach['day4']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day4']['exercises'] = $exercises;
                    $coach['day4']['workout'] = [];
                    $coach['day4']['coach_workout_rounds'] = 0;
                    $coach['day4']['workout_intensity'] = 1;
                    $coach['day4']['hiit'] = [['id' => 3, 'intensity' => 3, 'is_completed' => 0]];
                    $coach['day4']['stretching'] = $stretches;

                    //Day5 exercise set
                    $coach['day5']['warmup'] = $warmUps;
                    $coach['day5']['is_completed'] = 0;
                    $coach['day5']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day5']['exercises'] = $exercises;
                    $coach['day5']['workout'] = [];
                    $coach['day5']['coach_workout_rounds'] = 0;
                    $coach['day5']['workout_intensity'] = 1;
                    $coach['day5']['hiit'] = [['id' => 3, 'intensity' => 3, 'is_completed' => 0]];
                    $coach['day5']['stretching'] = $stretches;

                    //Day6 exercise set                    
                    $coach['day6']['warmup'] = $warmUps;
                    $coach['day6']['is_completed'] = 0;
                    $coach['day6']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day6']['exercises'] = [];
                    $coach['day6']['workout'] = $day5Workout;
                    $coach['day6']['coach_workout_rounds'] = count($day5Workout['exercises']);
                    $coach['day6']['workout_intensity'] = 1;
                    $coach['day6']['hiit'] = [];
                    $coach['day6']['stretching'] = $stretches;
                }
            }
        } elseif ($userLevel == 'advanced') {

            $csWorkout1 = self::getWorkoutWithExercises($userWorkouts['cardio_strength'][0]->id, $focus);

            $csWorkout2 = self::getWorkoutWithExercises($userWorkouts['cardio_strength'][1]->id, $focus);

            $csWorkout3 = self::getWorkoutWithExercises($userWorkouts['cardio_strength'][2]->id, $focus);

            $csWorkout4 = self::getWorkoutWithExercises($userWorkouts['cardio_strength'][3]->id, $focus);

            $csWorkout5 = self::getWorkoutWithExercises($userWorkouts['cardio_strength'][4]->id, $focus);

            $csWorkout6 = self::getWorkoutWithExercises($userWorkouts['cardio_strength'][5]->id, $focus);

            $sWorkout1 = self::getWorkoutWithExercises($userWorkouts['strength'][0]->id, $focus);

            $sWorkout2 = self::getWorkoutWithExercises($userWorkouts['strength'][1]->id, $focus);

            $sWorkout3 = self::getWorkoutWithExercises($userWorkouts['strength'][2]->id, $focus);

            $sWorkout4 = self::getWorkoutWithExercises($userWorkouts['strength'][3]->id, $focus);

            $sWorkout5 = self::getWorkoutWithExercises($userWorkouts['strength'][4]->id, $focus);

            $sWorkout6 = self::getWorkoutWithExercises($userWorkouts['strength'][5]->id, $focus);

            if ($focus == 1) {
                if ($data['days'] == 2) {
                    //Day1 exercise set
                    $coach['day1']['warmup'] = $warmUps;
                    $coach['day1']['is_completed'] = 0;
                    $coach['day1']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    //intensify csWorkout1
                    $coach['day1']['exercises'] = [];
                    $coach['day1']['workout'] = self::intensifyWorkout($csWorkout1, 1);
                    $coach['day1']['coach_workout_rounds'] = count($coach['day1']['workout']['exercises']);
                    $coach['day1']['workout_intensity'] = 2;
                    $coach['day1']['hiit'] = [];
                    $coach['day1']['stretching'] = $stretches;

                    //Day2 Exercise set
                    $coach['day2']['warmup'] = $warmUps;
                    $coach['day2']['is_completed'] = 0;
                    $coach['day2']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day2']['exercises'] = [];
                    $coach['day2']['workout'] = $csWorkout2;
                    $coach['day2']['coach_workout_rounds'] = count($csWorkout2);
                    $coach['day2']['workout_intensity'] = 1;
                    $coach['day2']['hiit'] = [['id' => 1, 'intensity' => 4, 'is_completed' => 0]];
                    $coach['day2']['stretching'] = $stretches;
                } elseif ($data['days'] == 3) {

                    //Day1 exercise set
                    $coach['day1']['warmup'] = $warmUps;
                    $coach['day1']['is_completed'] = 0;
                    $coach['day1']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day1']['exercises'] = [];
                    //intensify csWorkout1
                    $coach['day1']['workout'] = self::intensifyWorkout($csWorkout1, 1);
                    $coach['day1']['coach_workout_rounds'] = count($coach['day1']['workout']['exercises']);
                    $coach['day1']['workout_intensity'] = 2;
                    $coach['day1']['hiit'] = [];
                    $coach['day1']['stretching'] = $stretches;

                    //Day2 Exercise set
                    $coach['day2']['warmup'] = $warmUps;
                    $coach['day2']['is_completed'] = 0;
                    $coach['day2']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day2']['exercises'] = [];
                    $coach['day2']['workout'] = $csWorkout2;
                    $coach['day2']['coach_workout_rounds'] = count($csWorkout2);
                    $coach['day2']['workout_intensity'] = 1;
                    $coach['day2']['hiit'] = [['id' => 1, 'intensity' => 4, 'is_completed' => 0]];
                    $coach['day2']['stretching'] = $stretches;

                    //Day3 Exercise set
                    $coach['day3']['warmup'] = $warmUps;
                    $coach['day3']['is_completed'] = 0;
                    $coach['day3']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day3']['exercises'] = [];
                    //intensify sWorkout2
                    $coach['day3']['workout'] = self::intensifyWorkout($sWorkout1, 1);
                    $coach['day3']['coach_workout_rounds'] = count($coach['day3']['workout']['exercises']);
                    $coach['day3']['workout_intensity'] = 2;
                    $coach['day3']['hiit'] = [];
                    $coach['day3']['stretching'] = $stretches;
                } elseif ($data['days'] == 4) {
                    //Day1 exercise set
                    $coach['day1']['warmup'] = $warmUps;
                    $coach['day1']['is_completed'] = 0;
                    $coach['day1']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day1']['exercises'] = [];
                    //intensify csWorkout1
                    $coach['day1']['workout'] = self::intensifyWorkout($csWorkout1, 1);
                    $coach['day1']['coach_workout_rounds'] = count($coach['day1']['workout']['exercises']);
                    $coach['day1']['workout_intensity'] = 2;
                    $coach['day1']['hiit'] = [];
                    $coach['day1']['stretching'] = $stretches;

                    //Day2 Exercise set
                    $coach['day2']['warmup'] = $warmUps;
                    $coach['day2']['is_completed'] = 0;
                    $coach['day2']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day2']['exercises'] = [];
                    $coach['day2']['workout'] = $csWorkout2;
                    $coach['day2']['coach_workout_rounds'] = count($csWorkout2);
                    $coach['day2']['workout_intensity'] = 1;
                    $coach['day2']['hiit'] = [['id' => 3, 'intensity' => 3, 'is_completed' => 0]];
                    $coach['day2']['stretching'] = $stretches;

                    //Day3 Exercise set
                    $coach['day3']['warmup'] = $warmUps;
                    $coach['day3']['is_completed'] = 0;
                    $coach['day3']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day3']['exercises'] = [];
                    //intensify sWorkout2
                    $coach['day3']['workout'] = self::intensifyWorkout($csWorkout3, 1);
                    $coach['day3']['coach_workout_rounds'] = count($coach['day3']['workout']['exercises']);
                    $coach['day3']['workout_intensity'] = 2;
                    $coach['day3']['hiit'] = [];
                    $coach['day3']['stretching'] = $stretches;

                    //Day4 Exercise set
                    $coach['day4']['warmup'] = $warmUps;
                    $coach['day4']['is_completed'] = 0;
                    $coach['day4']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day4']['exercises'] = [];
                    //intensify sWorkout2
                    $coach['day4']['workout'] = $sWorkout1;
                    $coach['day4']['coach_workout_rounds'] = count($coach['day4']['workout']['exercises']);
                    $coach['day4']['workout_intensity'] = 1;
                    $coach['day4']['hiit'] = [['id' => 1, 'intensity' => 4, 'is_completed' => 0]];
                    $coach['day4']['stretching'] = $stretches;
                } elseif ($data['days'] == 5) {

                    //Day1 exercise set
                    $coach['day1']['warmup'] = $warmUps;
                    $coach['day1']['is_completed'] = 0;
                    $coach['day1']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day1']['exercises'] = [];
                    //intensify csWorkout1
                    $coach['day1']['workout'] = self::intensifyWorkout($csWorkout1, 1);
                    $coach['day1']['coach_workout_rounds'] = count($coach['day1']['workout']['exercises']);
                    $coach['day1']['workout_intensity'] = 2;
                    $coach['day1']['hiit'] = [];
                    $coach['day1']['stretching'] = $stretches;

                    //Day2 Exercise set
                    $coach['day2']['warmup'] = $warmUps;
                    $coach['day2']['is_completed'] = 0;
                    $coach['day2']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day2']['exercises'] = [];
                    $coach['day2']['workout'] = $csWorkout2;
                    $coach['day2']['coach_workout_rounds'] = count($csWorkout2);
                    $coach['day2']['workout_intensity'] = 1;
                    $coach['day2']['hiit'] = [['id' => 1, 'intensity' => 4, 'is_completed' => 0]];
                    $coach['day2']['stretching'] = $stretches;

                    //Day3 Exercise set
                    $coach['day3']['warmup'] = $warmUps;
                    $coach['day3']['is_completed'] = 0;
                    $coach['day3']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day3']['exercises'] = [];
                    //intensify sWorkout2
                    $coach['day3']['workout'] = self::intensifyWorkout($csWorkout3, 1);
                    $coach['day3']['coach_workout_rounds'] = count($coach['day3']['workout']['exercises']);
                    $coach['day3']['workout_intensity'] = 2;
                    $coach['day3']['hiit'] = [];
                    $coach['day3']['stretching'] = $stretches;

                    //Day4 Exercise set
                    $coach['day4']['warmup'] = $warmUps;
                    $coach['day4']['is_completed'] = 0;
                    $coach['day4']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day4']['exercises'] = [];
                    //intensify sWorkout2
                    $coach['day4']['workout'] = $sWorkout1;
                    $coach['day4']['coach_workout_rounds'] = count($coach['day4']['workout']['exercises']);
                    $coach['day4']['workout_intensity'] = 1;
                    $coach['day4']['hiit'] = [['id' => 3, 'intensity' => 3, 'is_completed' => 0]];
                    $coach['day4']['stretching'] = $stretches;

                    //Day5 Exercise set
                    $coach['day5']['warmup'] = $warmUps;
                    $coach['day5']['is_completed'] = 0;
                    $coach['day5']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day5']['exercises'] = [];
                    //intensify sWorkout2
                    $coach['day5']['workout'] = self::intensifyWorkout($sWorkout2, 1);
                    $coach['day5']['coach_workout_rounds'] = count($coach['day5']['workout']['exercises']);
                    $coach['day5']['workout_intensity'] = 2;
                    $coach['day5']['hiit'] = [['id' => 1, 'intensity' => 4, 'is_completed' => 0]];
                    $coach['day5']['stretching'] = $stretches;
                } elseif ($data['days'] == 6) {

                    //Day1 exercise set
                    $coach['day1']['warmup'] = $warmUps;
                    $coach['day1']['is_completed'] = 0;
                    $coach['day1']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day1']['exercises'] = [];
                    //intensify csWorkout1
                    $coach['day1']['workout'] = self::intensifyWorkout($csWorkout1, 1);
                    $coach['day1']['coach_workout_rounds'] = count($coach['day1']['workout']['exercises']);
                    $coach['day1']['workout_intensity'] = 2;
                    $coach['day1']['hiit'] = [];
                    $coach['day1']['stretching'] = $stretches;

                    //Day2 Exercise set
                    $coach['day2']['warmup'] = $warmUps;
                    $coach['day2']['is_completed'] = 0;
                    $coach['day2']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day2']['exercises'] = [];
                    $coach['day2']['workout'] = $csWorkout2;
                    $coach['day2']['coach_workout_rounds'] = count($csWorkout2);
                    $coach['day2']['workout_intensity'] = 1;
                    $coach['day2']['hiit'] = [['id' => 1, 'intensity' => 4, 'is_completed' => 0], ['id' => 1, 'intensity' => 3, 'is_completed' => 0]];
                    $coach['day2']['stretching'] = $stretches;

                    //Day3 Exercise set
                    $coach['day3']['warmup'] = $warmUps;
                    $coach['day3']['is_completed'] = 0;
                    $coach['day3']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day3']['exercises'] = [];
                    //intensify sWorkout2
                    $coach['day3']['workout'] = self::intensifyWorkout($csWorkout3, 1);
                    $coach['day3']['coach_workout_rounds'] = count($coach['day3']['workout']['exercises']);
                    $coach['day3']['workout_intensity'] = 2;
                    $coach['day3']['hiit'] = [];
                    $coach['day3']['stretching'] = $stretches;

                    //Day4 Exercise set
                    $coach['day4']['warmup'] = $warmUps;
                    $coach['day4']['is_completed'] = 0;
                    $coach['day4']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day4']['exercises'] = [];
                    //intensify sWorkout2
                    $coach['day4']['workout'] = self::intensifyWorkout($csWorkout4, 1);
                    $coach['day4']['coach_workout_rounds'] = count($coach['day4']['workout']['exercises']);
                    $coach['day4']['workout_intensity'] = 2;
                    $coach['day4']['hiit'] = [];
                    $coach['day4']['stretching'] = $stretches;

                    //Day5 Exercise set
                    $coach['day5']['warmup'] = $warmUps;
                    $coach['day5']['is_completed'] = 0;
                    $coach['day5']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day5']['exercises'] = [];
                    //intensify sWorkout2
                    $coach['day5']['workout'] = $sWorkout1;
                    $coach['day5']['coach_workout_rounds'] = count($coach['day5']['workout']['exercises']);
                    $coach['day5']['workout_intensity'] = 1;
                    $coach['day5']['hiit'] = [['id' => 3, 'intensity' => 3, 'is_completed' => 0]];
                    $coach['day5']['stretching'] = $stretches;

                    //Day5 Exercise set
                    $coach['day6']['warmup'] = $warmUps;
                    $coach['day6']['is_completed'] = 0;
                    $coach['day6']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day6']['exercises'] = [];
                    //intensify sWorkout2
                    $coach['day6']['workout'] = self::intensifyWorkout($sWorkout2, 1);
                    $coach['day6']['coach_workout_rounds'] = count($coach['day6']['workout']['exercises']);
                    $coach['day6']['workout_intensity'] = 2;
                    $coach['day6']['stretching'] = $stretches;
                }
            } elseif ($focus == 2) {

                if ($data['days'] == 2) {

                    //Day1 exercise set
                    $coach['day1']['warmup'] = $warmUps;
                    $coach['day1']['is_completed'] = 0;
                    $coach['day1']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day1']['exercises'] = [];
                    //intensify csWorkout1
                    $coach['day1']['workout'] = self::intensifyWorkout($csWorkout1, 1);
                    $coach['day1']['coach_workout_rounds'] = count($coach['day1']['workout']['exercises']);
                    $coach['day1']['workout_intensity'] = 2;
                    $coach['day1']['hiit'] = [];
                    $coach['day1']['stretching'] = $stretches;

                    //Day2 Exercise set
                    $coach['day2']['warmup'] = $warmUps;
                    $coach['day2']['is_completed'] = 0;
                    $coach['day2']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day2']['exercises'] = [];
                    $coach['day2']['workout'] = $sWorkout1;
                    $coach['day2']['coach_workout_rounds'] = count($coach['day2']['workout']['exercises']);
                    $coach['day2']['workout_intensity'] = 1;
                    $coach['day2']['hiit'] = [['id' => 1, 'intensity' => 4, 'is_completed' => 0]];
                    $coach['day2']['stretching'] = $stretches;
                } elseif ($data['days'] == 3) {

                    //Day1 exercise set
                    $coach['day1']['warmup'] = $warmUps;
                    $coach['day1']['is_completed'] = 0;
                    $coach['day1']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day1']['exercises'] = [];
                    //intensify csWorkout1
                    $coach['day1']['workout'] = self::intensifyWorkout($csWorkout1, 1);
                    $coach['day1']['coach_workout_rounds'] = count($coach['day1']['workout']['exercises']);
                    $coach['day1']['workout_intensity'] = 2;
                    $coach['day1']['hiit'] = [];
                    $coach['day1']['stretching'] = $stretches;

                    //Day2 Exercise set
                    $coach['day2']['warmup'] = $warmUps;
                    $coach['day2']['is_completed'] = 0;
                    $coach['day2']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day2']['exercises'] = [];
                    $coach['day2']['workout'] = $sWorkout1;
                    $coach['day2']['coach_workout_rounds'] = count($coach['day2']['workout']['exercises']);
                    $coach['day2']['workout_intensity'] = 1;
                    $coach['day2']['hiit'] = [['id' => 1, 'intensity' => 4, 'is_completed' => 0]];
                    $coach['day2']['stretching'] = $stretches;

                    //Day3 Exercise set
                    $coach['day3']['warmup'] = $warmUps;
                    $coach['day3']['is_completed'] = 0;
                    $coach['day3']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day3']['exercises'] = [];
                    //intensify sWorkout2
                    $coach['day3']['workout'] = self::intensifyWorkout($sWorkout2, 1);
                    $coach['day3']['coach_workout_rounds'] = count($coach['day3']['workout']['exercises']);
                    $coach['day3']['workout_intensity'] = 2;
                    $coach['day3']['hiit'] = [];
                    $coach['day3']['stretching'] = $stretches;
                } elseif ($data['days'] == 4) {
                    //Day1 exercise set
                    $coach['day1']['warmup'] = $warmUps;
                    $coach['day1']['is_completed'] = 0;
                    $coach['day1']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day1']['exercises'] = [];
                    //intensify csWorkout1
                    $coach['day1']['workout'] = self::intensifyWorkout($csWorkout1, 1);
                    $coach['day1']['coach_workout_rounds'] = count($coach['day1']['workout']['exercises']);
                    $coach['day1']['workout_intensity'] = 2;
                    $coach['day1']['hiit'] = [];
                    $coach['day1']['stretching'] = $stretches;

                    //Day2 Exercise set
                    $coach['day2']['warmup'] = $warmUps;
                    $coach['day2']['is_completed'] = 0;
                    $coach['day2']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day2']['exercises'] = [];
                    $coach['day2']['workout'] = $csWorkout2;
                    $coach['day2']['coach_workout_rounds'] = count($csWorkout2);
                    $coach['day2']['workout_intensity'] = 1;
                    $coach['day2']['hiit'] = [['id' => 3, 'intensity' => 3, 'is_completed' => 0]];
                    $coach['day2']['stretching'] = $stretches;

                    //Day3 Exercise set
                    $coach['day3']['warmup'] = $warmUps;
                    $coach['day3']['is_completed'] = 0;
                    $coach['day3']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day3']['exercises'] = [];
                    //intensify sWorkout2
                    $coach['day3']['workout'] = self::intensifyWorkout($sWorkout1, 1);
                    $coach['day3']['coach_workout_rounds'] = count($coach['day3']['workout']['exercises']);
                    $coach['day3']['workout_intensity'] = 2;
                    $coach['day3']['hiit'] = [];
                    $coach['day3']['stretching'] = $stretches;

                    //Day4 Exercise set
                    $coach['day4']['warmup'] = $warmUps;
                    $coach['day4']['is_completed'] = 0;
                    $coach['day4']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day4']['exercises'] = [];
                    //intensify sWorkout2
                    $coach['day4']['workout'] = $sWorkout2;
                    $coach['day4']['coach_workout_rounds'] = count($coach['day4']['workout']['exercises']);
                    $coach['day4']['workout_intensity'] = 1;
                    $coach['day4']['hiit'] = [['id' => 1, 'intensity' => 4, 'is_completed' => 0]];
                    $coach['day4']['stretching'] = $stretches;
                } elseif ($data['days'] == 5) {

                    //Day1 exercise set
                    $coach['day1']['warmup'] = $warmUps;
                    $coach['day1']['is_completed'] = 0;
                    $coach['day1']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day1']['exercises'] = [];
                    //intensify csWorkout1
                    $coach['day1']['workout'] = self::intensifyWorkout($csWorkout1, 1);
                    $coach['day1']['coach_workout_rounds'] = count($coach['day1']['workout']['exercises']);
                    $coach['day1']['workout_intensity'] = 2;
                    $coach['day1']['hiit'] = [];
                    $coach['day1']['stretching'] = $stretches;

                    //Day2 Exercise set
                    $coach['day2']['warmup'] = $warmUps;
                    $coach['day2']['is_completed'] = 0;
                    $coach['day2']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day2']['exercises'] = [];
                    $coach['day2']['workout'] = $csWorkout2;
                    $coach['day2']['coach_workout_rounds'] = count($csWorkout2);
                    $coach['day2']['workout_intensity'] = 1;
                    $coach['day2']['hiit'] = [['id' => 1, 'intensity' => 4, 'is_completed' => 0]];
                    $coach['day2']['stretching'] = $stretches;

                    //Day3 Exercise set
                    $coach['day3']['warmup'] = $warmUps;
                    $coach['day3']['is_completed'] = 0;
                    $coach['day3']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day3']['exercises'] = [];
                    //intensify sWorkout2
                    $coach['day3']['workout'] = self::intensifyWorkout($csWorkout3, 1);
                    $coach['day3']['coach_workout_rounds'] = count($coach['day3']['workout']['exercises']);
                    $coach['day3']['workout_intensity'] = 2;
                    $coach['day3']['hiit'] = [];
                    $coach['day3']['stretching'] = $stretches;

                    //Day4 Exercise set
                    $coach['day4']['warmup'] = $warmUps;
                    $coach['day4']['is_completed'] = 0;
                    $coach['day4']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day4']['exercises'] = [];
                    //intensify sWorkout2
                    $coach['day4']['workout'] = $sWorkout1;
                    $coach['day4']['coach_workout_rounds'] = count($coach['day4']['workout']['exercises']);
                    $coach['day4']['workout_intensity'] = 1;
                    $coach['day4']['hiit'] = [['id' => 3, 'intensity' => 3, 'is_completed' => 0]];
                    $coach['day4']['stretching'] = $stretches;

                    //Day5 Exercise set
                    $coach['day5']['warmup'] = $warmUps;
                    $coach['day5']['is_completed'] = 0;
                    $coach['day5']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day5']['exercises'] = [];
                    //intensify sWorkout2
                    $coach['day5']['workout'] = self::intensifyWorkout($sWorkout2, 1);
                    $coach['day5']['coach_workout_rounds'] = count($coach['day5']['workout']['exercises']);
                    $coach['day5']['hiit'] = [['id' => 1, 'intensity' => 4, 'is_completed' => 0]];
                    $coach['day5']['stretching'] = $stretches;
                } elseif ($data['days'] == 6) {

                    //Day1 exercise set
                    $coach['day1']['warmup'] = $warmUps;
                    $coach['day1']['is_completed'] = 0;
                    $coach['day1']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day1']['exercises'] = [];
                    //intensify csWorkout1
                    $coach['day1']['workout'] = self::intensifyWorkout($csWorkout1, 1);
                    $coach['day1']['coach_workout_rounds'] = count($coach['day1']['workout']['exercises']);
                    $coach['day1']['workout_intensity'] = 2;
                    $coach['day1']['hiit'] = [];
                    $coach['day1']['stretching'] = $stretches;

                    //Day2 Exercise set
                    $coach['day2']['warmup'] = $warmUps;
                    $coach['day2']['is_completed'] = 0;
                    $coach['day2']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day2']['exercises'] = [];
                    $coach['day2']['workout'] = $csWorkout2;
                    $coach['day2']['coach_workout_rounds'] = count($csWorkout2);
                    $coach['day2']['workout_intensity'] = 1;
                    $coach['day2']['hiit'] = [['id' => 1, 'intensity' => 4, 'is_completed' => 0], ['id' => 1, 'intensity' => 3, 'is_completed' => 0]];
                    $coach['day2']['stretching'] = $stretches;

                    //Day3 Exercise set
                    $coach['day3']['warmup'] = $warmUps;
                    $coach['day3']['is_completed'] = 0;
                    $coach['day3']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day3']['exercises'] = [];
                    //intensify sWorkout2
                    $coach['day3']['workout'] = self::intensifyWorkout($csWorkout3, 1);
                    $coach['day3']['coach_workout_rounds'] = count($coach['day3']['workout']['exercises']);
                    $coach['day3']['workout_intensity'] = 2;
                    $coach['day4']['hiit'] = [];
                    $coach['day3']['stretching'] = $stretches;

                    //Day4 Exercise set
                    $coach['day4']['warmup'] = $warmUps;
                    $coach['day4']['is_completed'] = 0;
                    $coach['day4']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day4']['exercises'] = [];
                    //intensify sWorkout2
                    $coach['day4']['workout'] = self::intensifyWorkout($sWorkout1, 1);
                    $coach['day4']['coach_workout_rounds'] = count($coach['day4']['workout']['exercises']);
                    $coach['day4']['workout_intensity'] = 2;
                    $coach['day4']['hiit'] = [];
                    $coach['day4']['stretching'] = $stretches;

                    //Day5 Exercise set
                    $coach['day5']['warmup'] = $warmUps;
                    $coach['day5']['is_completed'] = 0;
                    $coach['day5']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day5']['exercises'] = [];
                    //intensify sWorkout2
                    $coach['day5']['workout'] = $sWorkout2;
                    $coach['day5']['coach_workout_rounds'] = count($coach['day5']['workout']['exercises']);
                    $coach['day5']['workout_intensity'] = 1;
                    $coach['day5']['hiit'] = [['id' => 3, 'intensity' => 3, 'is_completed' => 0]];
                    $coach['day5']['stretching'] = $stretches;

                    //Day5 Exercise set
                    $coach['day6']['warmup'] = $warmUps;
                    $coach['day6']['is_completed'] = 0;
                    $coach['day6']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day6']['exercises'] = [];
                    //intensify sWorkout2
                    $coach['day6']['workout'] = self::intensifyWorkout($sWorkout3, 1);
                    $coach['day6']['coach_workout_rounds'] = count($coach['day6']['workout']['exercises']);
                    $coach['day6']['workout_intensity'] = 2;
                    $coach['day6']['hiit'] = [];
                    $coach['day6']['stretching'] = $stretches;
                }
            } elseif ($focus == 3) {

                if ($data['days'] == 2) {

                    //Day1 exercise set
                    $coach['day1']['warmup'] = $warmUps;
                    $coach['day1']['is_completed'] = 0;
                    $coach['day1']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day1']['exercises'] = [];
                    //intensify csWorkout1
                    $coach['day1']['workout'] = self::intensifyWorkout($csWorkout1, 1);
                    $coach['day1']['coach_workout_rounds'] = count($coach['day1']['workout']['exercises']);
                    $coach['day1']['workout_intensity'] = 2;
                    $coach['day1']['hiit'] = [];
                    $coach['day1']['stretching'] = $stretches;

                    //Day2 Exercise set
                    $coach['day2']['warmup'] = $warmUps;
                    $coach['day2']['is_completed'] = 0;
                    $coach['day2']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day2']['exercises'] = [];
                    $coach['day2']['workout'] = $sWorkout1;
                    $coach['day2']['coach_workout_rounds'] = count($coach['day2']['workout']['exercises']);
                    $coach['day2']['workout_intensity'] = 1;
                    $coach['day2']['hiit'] = [['id' => 1, 'intensity' => 4, 'is_completed' => 0]];
                    $coach['day2']['stretching'] = $stretches;
                } elseif ($data['days'] == 3) {

                    //Day1 exercise set
                    $coach['day1']['warmup'] = $warmUps;
                    $coach['day1']['is_completed'] = 0;
                    $coach['day1']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day1']['exercises'] = [];
                    //intensify csWorkout1
                    $coach['day1']['workout'] = self::intensifyWorkout($csWorkout1, 1);
                    $coach['day1']['coach_workout_rounds'] = count($coach['day1']['workout']['exercises']);
                    $coach['day1']['workout_intensity'] = 2;
                    $coach['day1']['hiit'] = [];
                    $coach['day1']['stretching'] = $stretches;

                    //Day2 Exercise set
                    $coach['day2']['warmup'] = $warmUps;
                    $coach['day2']['is_completed'] = 0;
                    $coach['day2']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day2']['exercises'] = [];
                    $coach['day2']['workout'] = $sWorkout1;
                    $coach['day2']['coach_workout_rounds'] = count($coach['day2']['workout']['exercises']);
                    $coach['day2']['workout_intensity'] = 1;
                    $coach['day2']['hiit'] = [['id' => 1, 'intensity' => 4, 'is_completed' => 0]];
                    $coach['day2']['stretching'] = $stretches;

                    //Day3 Exercise set
                    $coach['day3']['warmup'] = $warmUps;
                    $coach['day3']['is_completed'] = 0;
                    $coach['day3']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day3']['exercises'] = [];
                    //intensify sWorkout2
                    $coach['day3']['workout'] = self::intensifyWorkout($sWorkout2, 1);
                    $coach['day3']['coach_workout_rounds'] = count($coach['day3']['workout']['exercises']);
                    $coach['day3']['workout_intensity'] = 2;
                    $coach['day3']['hiit'] = [];
                    $coach['day3']['stretching'] = $stretches;
                } elseif ($data['days'] == 4) {
                    //Day1 exercise set
                    $coach['day1']['warmup'] = $warmUps;
                    $coach['day1']['is_completed'] = 0;
                    $coach['day1']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day1']['exercises'] = [];
                    //intensify csWorkout1
                    $coach['day1']['workout'] = self::intensifyWorkout($csWorkout1, 1);
                    $coach['day1']['coach_workout_rounds'] = count($coach['day1']['workout']['exercises']);
                    $coach['day1']['workout_intensity'] = 2;
                    $coach['day1']['hiit'] = [];
                    $coach['day1']['stretching'] = $stretches;

                    //Day2 Exercise set
                    $coach['day2']['warmup'] = $warmUps;
                    $coach['day2']['is_completed'] = 0;
                    $coach['day2']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day2']['exercises'] = [];
                    $coach['day2']['workout'] = $csWorkout2;
                    $coach['day2']['coach_workout_rounds'] = count($csWorkout2);
                    $coach['day2']['workout_intensity'] = 1;
                    $coach['day2']['hiit'] = [['id' => 3, 'intensity' => 3, 'is_completed' => 0]];
                    $coach['day2']['stretching'] = $stretches;

                    //Day3 Exercise set
                    $coach['day3']['warmup'] = $warmUps;
                    $coach['day3']['is_completed'] = 0;
                    $coach['day3']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day3']['exercises'] = [];
                    //intensify sWorkout2
                    $coach['day3']['workout'] = self::intensifyWorkout($sWorkout1, 1);
                    $coach['day3']['coach_workout_rounds'] = count($coach['day3']['workout']['exercises']);
                    $coach['day3']['workout_intensity'] = 2;
                    $coach['day3']['hiit'] = [];
                    $coach['day3']['stretching'] = $stretches;

                    //Day4 Exercise set
                    $coach['day4']['warmup'] = $warmUps;
                    $coach['day4']['is_completed'] = 0;
                    $coach['day4']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day4']['exercises'] = [];
                    //intensify sWorkout2
                    $coach['day4']['workout'] = $sWorkout2;
                    $coach['day4']['coach_workout_rounds'] = count($coach['day4']['workout']['exercises']);
                    $coach['day4']['workout_intensity'] = 1;
                    $coach['day4']['hiit'] = [['id' => 1, 'intensity' => 4, 'is_completed' => 0]];
                    $coach['day4']['stretching'] = $stretches;
                } elseif ($data['days'] == 5) {

                    //Day1 exercise set
                    $coach['day1']['warmup'] = $warmUps;
                    $coach['day1']['is_completed'] = 0;
                    $coach['day1']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day1']['exercises'] = [];
                    //intensify csWorkout1
                    $coach['day1']['workout'] = self::intensifyWorkout($csWorkout1, 1);
                    $coach['day1']['coach_workout_rounds'] = count($coach['day1']['workout']['exercises']);
                    $coach['day1']['workout_intensity'] = 2;
                    $coach['day1']['hiit'] = [];
                    $coach['day1']['stretching'] = $stretches;

                    //Day2 Exercise set
                    $coach['day2']['warmup'] = $warmUps;
                    $coach['day2']['is_completed'] = 0;
                    $coach['day2']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day2']['exercises'] = [];
                    $coach['day2']['workout'] = $csWorkout2;
                    $coach['day2']['coach_workout_rounds'] = count($csWorkout2);
                    $coach['day2']['workout_intensity'] = 1;
                    $coach['day2']['hiit'] = [['id' => 1, 'intensity' => 4, 'is_completed' => 0]];
                    $coach['day2']['stretching'] = $stretches;

                    //Day3 Exercise set
                    $coach['day3']['warmup'] = $warmUps;
                    $coach['day3']['is_completed'] = 0;
                    $coach['day3']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day3']['exercises'] = [];
                    //intensify sWorkout2
                    $coach['day3']['workout'] = self::intensifyWorkout($csWorkout3, 1);
                    $coach['day3']['coach_workout_rounds'] = count($coach['day3']['workout']['exercises']);
                    $coach['day3']['workout_intensity'] = 2;
                    $coach['day3']['hiit'] = [];
                    $coach['day3']['stretching'] = $stretches;

                    //Day4 Exercise set
                    $coach['day4']['warmup'] = $warmUps;
                    $coach['day4']['is_completed'] = 0;
                    $coach['day4']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day4']['exercises'] = [];
                    //intensify sWorkout2
                    $coach['day4']['workout'] = $sWorkout1;
                    $coach['day4']['coach_workout_rounds'] = count($coach['day4']['workout']['exercises']);
                    $coach['day4']['workout_intensity'] = 1;
                    $coach['day4']['hiit'] = [['id' => 3, 'intensity' => 3, 'is_completed' => 0]];
                    $coach['day4']['stretching'] = $stretches;

                    //Day5 Exercise set
                    $coach['day5']['warmup'] = $warmUps;
                    $coach['day5']['is_completed'] = 0;
                    $coach['day5']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day5']['exercises'] = [];
                    //intensify sWorkout2
                    $coach['day5']['workout'] = self::intensifyWorkout($sWorkout2, 1);
                    $coach['day5']['coach_workout_rounds'] = count($coach['day5']['workout']['exercises']);
                    $coach['day5']['hiit'] = [['id' => 1, 'intensity' => 4, 'is_completed' => 0]];
                    $coach['day5']['stretching'] = $stretches;
                } elseif ($data['days'] == 6) {

                    //Day1 exercise set
                    $coach['day1']['warmup'] = $warmUps;
                    $coach['day1']['is_completed'] = 0;
                    $coach['day1']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day1']['exercises'] = [];
                    //intensify csWorkout1
                    $coach['day1']['workout'] = self::intensifyWorkout($csWorkout1, 1);
                    $coach['day1']['coach_workout_rounds'] = count($coach['day1']['workout']['exercises']);
                    $coach['day1']['workout_intensity'] = 2;
                    $coach['day1']['hiit'] = [];
                    $coach['day1']['stretching'] = $stretches;

                    //Day2 Exercise set
                    $coach['day2']['warmup'] = $warmUps;
                    $coach['day2']['is_completed'] = 0;
                    $coach['day2']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day2']['exercises'] = [];
                    $coach['day2']['workout'] = $csWorkout2;
                    $coach['day2']['coach_workout_rounds'] = count($csWorkout2);
                    $coach['day2']['workout_intensity'] = 1;
                    $coach['day2']['hiit'] = [['id' => 1, 'intensity' => 4, 'is_completed' => 0], ['id' => 1, 'intensity' => 3, 'is_completed' => 0]];
                    $coach['day2']['stretching'] = $stretches;

                    //Day3 Exercise set
                    $coach['day3']['warmup'] = $warmUps;
                    $coach['day3']['is_completed'] = 0;
                    $coach['day3']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day3']['exercises'] = [];
                    //intensify sWorkout2
                    $coach['day3']['workout'] = self::intensifyWorkout($csWorkout3, 1);
                    $coach['day3']['coach_workout_rounds'] = count($coach['day3']['workout']['exercises']);
                    $coach['day3']['workout_intensity'] = 2;
                    $coach['day3']['hiit'] = [];
                    $coach['day3']['stretching'] = $stretches;

                    //Day4 Exercise set
                    $coach['day4']['warmup'] = $warmUps;
                    $coach['day4']['is_completed'] = 0;
                    $coach['day4']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day4']['exercises'] = [];
                    //intensify sWorkout2
                    $coach['day4']['workout'] = self::intensifyWorkout($sWorkout1, 1);
                    $coach['day4']['coach_workout_rounds'] = count($coach['day4']['workout']['exercises']);
                    $coach['day4']['workout_intensity'] = 2;
                    $coach['day4']['hiit'] = [];
                    $coach['day4']['stretching'] = $stretches;

                    //Day5 Exercise set
                    $coach['day5']['warmup'] = $warmUps;
                    $coach['day5']['is_completed'] = 0;
                    $coach['day5']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day5']['exercises'] = [];
                    //intensify sWorkout2
                    $coach['day5']['workout'] = $sWorkout2;
                    $coach['day5']['coach_workout_rounds'] = count($coach['day5']['workout']['exercises']);
                    $coach['day5']['workout_intensity'] = 1;
                    $coach['day5']['hiit'] = [['id' => 3, 'intensity' => 3, 'is_completed' => 0]];
                    $coach['day5']['stretching'] = $stretches;

                    //Day5 Exercise set
                    $coach['day6']['warmup'] = $warmUps;
                    $coach['day6']['is_completed'] = 0;
                    $coach['day6']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day6']['exercises'] = [];
                    //intensify sWorkout2
                    $coach['day5']['workout'] = $sWorkout2;
                    $coach['day5']['coach_workout_rounds'] = count($coach['day5']['workout']['exercises']);
                    $coach['day6']['workout_intensity'] = 2;
                    $coach['day6']['hiit'] = [];
                    $coach['day6']['stretching'] = $stretches;
                }
            }
        } elseif ($userLevel == 'professional') {

            $csWorkout1 = self::getWorkoutWithExercises($userWorkouts['cardio_strength'][0]->id, $focus);

            $csWorkout2 = self::getWorkoutWithExercises($userWorkouts['cardio_strength'][1]->id, $focus);

            $csWorkout3 = self::getWorkoutWithExercises($userWorkouts['cardio_strength'][2]->id, $focus);

            $csWorkout4 = self::getWorkoutWithExercises($userWorkouts['cardio_strength'][3]->id, $focus);

            $csWorkout5 = self::getWorkoutWithExercises($userWorkouts['cardio_strength'][4]->id, $focus);

            $csWorkout6 = self::getWorkoutWithExercises($userWorkouts['cardio_strength'][5]->id, $focus);

            $sWorkout1 = self::getWorkoutWithExercises($userWorkouts['strength'][0]->id, $focus);

            $sWorkout2 = self::getWorkoutWithExercises($userWorkouts['strength'][1]->id, $focus);

            $sWorkout3 = self::getWorkoutWithExercises($userWorkouts['strength'][2]->id, $focus);

            $sWorkout4 = self::getWorkoutWithExercises($userWorkouts['strength'][3]->id, $focus);

            $sWorkout5 = self::getWorkoutWithExercises($userWorkouts['strength'][4]->id, $focus);

            $sWorkout6 = self::getWorkoutWithExercises($userWorkouts['strength'][5]->id, $focus);

            if ($focus == 1) {

                if ($data['days'] == 2) {

                    //Day1 exercise set
                    $coach['day1']['warmup'] = $warmUps;
                    $coach['day1']['is_completed'] = 0;
                    $coach['day1']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day1']['exercises'] = [];
                    //intensify csWorkout1
                    $coach['day1']['workout'] = self::intensifyWorkout($csWorkout1, 1);
                    $coach['day1']['coach_workout_rounds'] = count($coach['day1']['workout']['exercises']);
                    $coach['day1']['workout_intensity'] = 2;
                    $coach['day1']['hiit'] = [];
                    $coach['day1']['stretching'] = $stretches;

                    //Day2 Exercise set
                    $coach['day2']['warmup'] = $warmUps;
                    $coach['day2']['is_completed'] = 0;
                    $coach['day2']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day2']['exercises'] = [];
                    $coach['day2']['workout'] = $csWorkout2;
                    $coach['day2']['coach_workout_rounds'] = count($csWorkout2);
                    $coach['day2']['workout_intensity'] = 1;
                    $coach['day2']['hiit'] = [['id' => 2, 'intensity' => 4, 'is_completed' => 0]];
                    $coach['day2']['stretching'] = $stretches;
                } elseif ($data['days'] == 3) {

                    //Day1 exercise set
                    $coach['day1']['warmup'] = $warmUps;
                    $coach['day1']['is_completed'] = 0;
                    $coach['day1']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day1']['exercises'] = [];
                    //intensify csWorkout1
                    $coach['day1']['workout'] = self::intensifyWorkout($csWorkout1, 1);
                    $coach['day1']['coach_workout_rounds'] = count($coach['day1']['workout']['exercises']);
                    $coach['day1']['workout_intensity'] = 2;
                    $coach['day1']['hiit'] = [];
                    $coach['day1']['stretching'] = $stretches;

                    //Day2 Exercise set
                    $coach['day2']['warmup'] = $warmUps;
                    $coach['day2']['is_completed'] = 0;
                    $coach['day2']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day2']['exercises'] = [];
                    $coach['day2']['workout'] = $csWorkout2;
                    $coach['day2']['coach_workout_rounds'] = count($csWorkout2);
                    $coach['day2']['workout_intensity'] = 1;
                    $coach['day2']['hiit'] = [['id' => 2, 'intensity' => 4, 'is_completed' => 0]];
                    $coach['day2']['stretching'] = $stretches;

                    //Day3 Exercise set
                    $coach['day3']['warmup'] = $warmUps;
                    $coach['day3']['is_completed'] = 0;
                    $coach['day3']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day3']['exercises'] = [];
                    //intensify sWorkout2
                    $coach['day3']['workout'] = self::intensifyWorkout($sWorkout1, 1);
                    $coach['day3']['coach_workout_rounds'] = count($coach['day3']['workout']['exercises']);
                    $coach['day3']['workout_intensity'] = 2;
                    $coach['day3']['hiit'] = [];
                    $coach['day3']['stretching'] = $stretches;
                } elseif ($data['days'] == 4) {
                    //Day1 exercise set
                    $coach['day1']['warmup'] = $warmUps;
                    $coach['day1']['is_completed'] = 0;
                    $coach['day1']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day1']['exercises'] = [];
                    //intensify csWorkout1
                    $coach['day1']['workout'] = self::intensifyWorkout($csWorkout1, 1);
                    $coach['day1']['coach_workout_rounds'] = count($coach['day1']['workout']['exercises']);
                    $coach['day1']['workout_intensity'] = 2;
                    $coach['day1']['hiit'] = [];
                    $coach['day1']['stretching'] = $stretches;

                    //Day2 Exercise set
                    $coach['day2']['warmup'] = $warmUps;
                    $coach['day2']['is_completed'] = 0;
                    $coach['day2']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day2']['exercises'] = [];
                    $coach['day2']['workout'] = $csWorkout2;
                    $coach['day2']['coach_workout_rounds'] = count($csWorkout2);
                    $coach['day2']['workout_intensity'] = 1;
                    $coach['day2']['hiit'] = [['id' => 1, 'intensity' => 4, 'is_completed' => 0]];
                    $coach['day2']['stretching'] = $stretches;

                    //Day3 Exercise set
                    $coach['day3']['warmup'] = $warmUps;
                    $coach['day3']['is_completed'] = 0;
                    $coach['day3']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day3']['exercises'] = [];
                    //intensify sWorkout2
                    $coach['day3']['workout'] = self::intensifyWorkout($csWorkout3, 1);
                    $coach['day3']['coach_workout_rounds'] = count($coach['day3']['workout']['exercises']);
                    $coach['day3']['workout_intensity'] = 2;
                    $coach['day3']['hiit'] = [];
                    $coach['day3']['stretching'] = $stretches;

                    //Day4 Exercise set
                    $coach['day4']['warmup'] = $warmUps;
                    $coach['day4']['is_completed'] = 0;
                    $coach['day4']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day4']['exercises'] = [];
                    //intensify sWorkout2
                    $coach['day4']['workout'] = $sWorkout1;
                    $coach['day4']['coach_workout_rounds'] = count($coach['day4']['workout']['exercises']);
                    $coach['day4']['workout_intensity'] = 1;
                    $coach['day4']['hiit'] = [['id' => 2, 'intensity' => 4, 'is_completed' => 0]];
                    $coach['day4']['stretching'] = $stretches;
                } elseif ($data['days'] == 5) {

                    //Day1 exercise set
                    $coach['day1']['warmup'] = $warmUps;
                    $coach['day1']['is_completed'] = 0;
                    $coach['day1']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day1']['exercises'] = [];
                    //intensify csWorkout1
                    $coach['day1']['workout'] = self::intensifyWorkout($csWorkout1, 1);
                    $coach['day1']['coach_workout_rounds'] = count($coach['day1']['workout']['exercises']);
                    $coach['day1']['workout_intensity'] = 2;
                    $coach['day1']['hiit'] = [];
                    $coach['day1']['stretching'] = $stretches;

                    //Day2 Exercise set
                    $coach['day2']['warmup'] = $warmUps;
                    $coach['day2']['is_completed'] = 0;
                    $coach['day2']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day2']['exercises'] = [];
                    $coach['day2']['workout'] = $csWorkout2;
                    $coach['day2']['coach_workout_rounds'] = count($csWorkout2);
                    $coach['day2']['workout_intensity'] = 1;
                    $coach['day2']['hiit'] = [['id' => 3, 'intensity' => 3, 'is_completed' => 0]];
                    $coach['day2']['stretching'] = $stretches;

                    //Day3 Exercise set
                    $coach['day3']['warmup'] = $warmUps;
                    $coach['day3']['is_completed'] = 0;
                    $coach['day3']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day3']['exercises'] = [];
                    //intensify sWorkout2
                    $coach['day3']['workout'] = self::intensifyWorkout($csWorkout3, 1);
                    $coach['day3']['coach_workout_rounds'] = count($coach['day3']['workout']['exercises']);
                    $coach['day3']['workout_intensity'] = 2;
                    $coach['day3']['hiit'] = [];
                    $coach['day3']['stretching'] = $stretches;

                    //Day4 Exercise set
                    $coach['day4']['warmup'] = $warmUps;
                    $coach['day4']['is_completed'] = 0;
                    $coach['day4']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day4']['exercises'] = [];
                    //intensify sWorkout2
                    $coach['day4']['workout'] = $sWorkout1;
                    $coach['day4']['coach_workout_rounds'] = count($coach['day4']['workout']['exercises']);
                    $coach['day4']['workout_intensity'] = 1;
                    $coach['day4']['hiit'] = [['id' => 2, 'intensity' => 4, 'is_completed' => 0]];
                    $coach['day4']['stretching'] = $stretches;

                    //Day5 Exercise set
                    $coach['day5']['warmup'] = $warmUps;
                    $coach['day5']['is_completed'] = 0;
                    $coach['day5']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day5']['exercises'] = [];
                    //intensify sWorkout2
                    $coach['day5']['workout'] = self::intensifyWorkout($sWorkout2, 1);
                    $coach['day5']['coach_workout_rounds'] = count($coach['day5']['workout']['exercises']);
                    $coach['day5']['workout_intensity'] = 2;
                    $coach['day5']['hiit'] = [['id' => 1, 'intensity' => 4, 'is_completed' => 0]];
                    $coach['day5']['stretching'] = $stretches;
                } elseif ($data['days'] == 6) {

                    //Day1 exercise set
                    $coach['day1']['warmup'] = $warmUps;
                    $coach['day1']['is_completed'] = 0;
                    $coach['day1']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day1']['exercises'] = [];
                    //intensify csWorkout1
                    $coach['day1']['workout'] = self::intensifyWorkout($csWorkout1, 1);
                    $coach['day1']['coach_workout_rounds'] = count($coach['day1']['workout']['exercises']);
                    $coach['day1']['workout_intensity'] = 2;
                    $coach['day1']['hiit'] = [];
                    $coach['day1']['stretching'] = $stretches;

                    //Day2 Exercise set
                    $coach['day2']['warmup'] = $warmUps;
                    $coach['day2']['is_completed'] = 0;
                    $coach['day2']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day2']['exercises'] = [];
                    $coach['day2']['workout'] = $csWorkout2;
                    $coach['day2']['coach_workout_rounds'] = count($csWorkout2);
                    $coach['day2']['workout_intensity'] = 1;
                    $coach['day2']['hiit'] = [['id' => 1, 'intensity' => 4, 'is_completed' => 0], ['id' => 1, 'intensity' => 3, 'is_completed' => 0]];
                    $coach['day2']['stretching'] = $stretches;

                    //Day3 Exercise set
                    $coach['day3']['warmup'] = $warmUps;
                    $coach['day3']['is_completed'] = 0;
                    $coach['day3']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day3']['exercises'] = [];
                    //intensify sWorkout2
                    $coach['day3']['workout'] = self::intensifyWorkout($csWorkout3, 1);
                    $coach['day3']['coach_workout_rounds'] = count($coach['day3']['workout']['exercises']);
                    $coach['day3']['workout_intensity'] = 2;
                    $coach['day3']['hiit'] = [];
                    $coach['day3']['stretching'] = $stretches;

                    //Day4 Exercise set
                    $coach['day4']['warmup'] = $warmUps;
                    $coach['day4']['is_completed'] = 0;
                    $coach['day4']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day4']['exercises'] = [];
                    //intensify sWorkout2
                    $coach['day4']['workout'] = self::intensifyWorkout($csWorkout4, 1);
                    $coach['day4']['coach_workout_rounds'] = count($coach['day4']['workout']['exercises']);
                    $coach['day4']['workout_intensity'] = 2;
                    $coach['day4']['hiit'] = [];
                    $coach['day4']['stretching'] = $stretches;

                    //Day5 Exercise set
                    $coach['day5']['warmup'] = $warmUps;
                    $coach['day5']['is_completed'] = 0;
                    $coach['day5']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day5']['exercises'] = [];
                    //intensify sWorkout2
                    $coach['day5']['workout'] = $sWorkout1;
                    $coach['day5']['coach_workout_rounds'] = count($coach['day5']['workout']['exercises']);
                    $coach['day5']['workout_intensity'] = 1;
                    $coach['day5']['hiit'] = [['id' => 2, 'intensity' => 4, 'is_completed' => 0]];
                    $coach['day5']['stretching'] = $stretches;

                    //Day5 Exercise set
                    $coach['day6']['warmup'] = $warmUps;
                    $coach['day6']['is_completed'] = 0;
                    $coach['day6']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day6']['exercises'] = [];
                    //intensify sWorkout2
                    $coach['day5']['workout'] = $sWorkout1;
                    $coach['day5']['coach_workout_rounds'] = count($coach['day5']['workout']['exercises']);
                    $coach['day6']['workout_intensity'] = 2;
                    $coach['day6']['hiit'] = [];
                    $coach['day6']['stretching'] = $stretches;
                }
            } elseif ($focus == 2) {

                if ($data['days'] == 2) {

                    //Day1 exercise set
                    $coach['day1']['warmup'] = $warmUps;
                    $coach['day1']['is_completed'] = 0;
                    $coach['day1']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day1']['exercises'] = [];
                    //intensify csWorkout1
                    $coach['day1']['workout'] = self::intensifyWorkout($csWorkout1, 1);
                    $coach['day1']['coach_workout_rounds'] = count($coach['day1']['workout']['exercises']);
                    $coach['day1']['workout_intensity'] = 2;
                    $coach['day1']['hiit'] = [];
                    $coach['day1']['stretching'] = $stretches;

                    //Day2 Exercise set
                    $coach['day2']['warmup'] = $warmUps;
                    $coach['day2']['is_completed'] = 0;
                    $coach['day2']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day2']['exercises'] = [];
                    $coach['day2']['workout'] = $sWorkout1;
                    $coach['day2']['coach_workout_rounds'] = count($coach['day2']['workout']['exercises']);
                    $coach['day2']['workout_intensity'] = 1;
                    $coach['day2']['hiit'] = [['id' => 2, 'intensity' => 4, 'is_completed' => 0]];
                    $coach['day2']['stretching'] = $stretches;
                } elseif ($data['days'] == 3) {

                    //Day1 exercise set
                    $coach['day1']['warmup'] = $warmUps;
                    $coach['day1']['is_completed'] = 0;
                    $coach['day1']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day1']['exercises'] = [];
                    //intensify csWorkout1
                    $coach['day1']['workout'] = self::intensifyWorkout($csWorkout1, 1);
                    $coach['day1']['coach_workout_rounds'] = count($coach['day1']['workout']['exercises']);
                    $coach['day1']['workout_intensity'] = 2;
                    $coach['day1']['hiit'] = [];
                    $coach['day1']['stretching'] = $stretches;

                    //Day2 Exercise set
                    $coach['day2']['warmup'] = $warmUps;
                    $coach['day2']['is_completed'] = 0;
                    $coach['day2']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day2']['exercises'] = [];
                    $coach['day2']['workout'] = $sWorkout1;
                    $coach['day2']['coach_workout_rounds'] = count($coach['day2']['workout']['exercises']);
                    $coach['day2']['workout_intensity'] = 1;
                    $coach['day2']['hiit'] = [['id' => 2, 'intensity' => 4, 'is_completed' => 0]];
                    $coach['day2']['stretching'] = $stretches;

                    //Day3 Exercise set
                    $coach['day3']['warmup'] = $warmUps;
                    $coach['day3']['is_completed'] = 0;
                    $coach['day3']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day3']['exercises'] = [];
                    //intensify sWorkout2
                    $coach['day3']['workout'] = self::intensifyWorkout($sWorkout2, 1);
                    $coach['day3']['coach_workout_rounds'] = count($coach['day3']['workout']['exercises']);
                    $coach['day3']['workout_intensity'] = 2;
                    $coach['day3']['hiit'] = [];
                    $coach['day3']['stretching'] = $stretches;
                } elseif ($data['days'] == 4) {
                    //Day1 exercise set
                    $coach['day1']['warmup'] = $warmUps;
                    $coach['day1']['is_completed'] = 0;
                    $coach['day1']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day1']['exercises'] = [];
                    //intensify csWorkout1
                    $coach['day1']['workout'] = self::intensifyWorkout($csWorkout1, 1);
                    $coach['day1']['coach_workout_rounds'] = count($coach['day1']['workout']['exercises']);
                    $coach['day1']['workout_intensity'] = 2;
                    $coach['day1']['hiit'] = [];
                    $coach['day1']['stretching'] = $stretches;

                    //Day2 Exercise set
                    $coach['day2']['warmup'] = $warmUps;
                    $coach['day2']['is_completed'] = 0;
                    $coach['day2']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day2']['exercises'] = [];
                    $coach['day2']['workout'] = $csWorkout2;
                    $coach['day2']['coach_workout_rounds'] = count($csWorkout2);
                    $coach['day2']['workout_intensity'] = 1;
                    $coach['day2']['hiit'] = [['id' => 1, 'intensity' => 4, 'is_completed' => 0]];
                    $coach['day2']['stretching'] = $stretches;

                    //Day3 Exercise set
                    $coach['day3']['warmup'] = $warmUps;
                    $coach['day3']['is_completed'] = 0;
                    $coach['day3']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day3']['exercises'] = [];
                    //intensify sWorkout2
                    $coach['day3']['workout'] = self::intensifyWorkout($sWorkout1, 1);
                    $coach['day3']['coach_workout_rounds'] = count($coach['day3']['workout']['exercises']);
                    $coach['day3']['workout_intensity'] = 2;
                    $coach['day3']['hiit'] = [];
                    $coach['day3']['stretching'] = $stretches;

                    //Day4 Exercise set
                    $coach['day4']['warmup'] = $warmUps;
                    $coach['day4']['is_completed'] = 0;
                    $coach['day4']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day4']['exercises'] = [];
                    //intensify sWorkout2
                    $coach['day4']['workout'] = $sWorkout2;
                    $coach['day4']['coach_workout_rounds'] = count($coach['day4']['workout']['exercises']);
                    $coach['day4']['workout_intensity'] = 1;
                    $coach['day4']['hiit'] = [['id' => 2, 'intensity' => 4, 'is_completed' => 0]];
                    $coach['day4']['stretching'] = $stretches;
                } elseif ($data['days'] == 5) {

                    //Day1 exercise set
                    $coach['day1']['warmup'] = $warmUps;
                    $coach['day1']['is_completed'] = 0;
                    $coach['day1']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day1']['exercises'] = [];
                    //intensify csWorkout1
                    $coach['day1']['workout'] = self::intensifyWorkout($csWorkout1, 1);
                    $coach['day1']['coach_workout_rounds'] = count($coach['day1']['workout']['exercises']);
                    $coach['day1']['workout_intensity'] = 2;
                    $coach['day1']['hiit'] = [];
                    $coach['day1']['stretching'] = $stretches;

                    //Day2 Exercise set
                    $coach['day2']['warmup'] = $warmUps;
                    $coach['day2']['is_completed'] = 0;
                    $coach['day2']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day2']['exercises'] = [];
                    $coach['day2']['workout'] = $csWorkout2;
                    $coach['day2']['coach_workout_rounds'] = count($csWorkout2);
                    $coach['day2']['workout_intensity'] = 1;
                    $coach['day2']['hiit'] = [['id' => 3, 'intensity' => 3, 'is_completed' => 0]];
                    $coach['day2']['stretching'] = $stretches;

                    //Day3 Exercise set
                    $coach['day3']['warmup'] = $warmUps;
                    $coach['day3']['is_completed'] = 0;
                    $coach['day3']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day3']['exercises'] = [];
                    //intensify sWorkout2
                    $coach['day3']['workout'] = self::intensifyWorkout($csWorkout3, 1);
                    $coach['day3']['coach_workout_rounds'] = count($coach['day3']['workout']['exercises']);
                    $coach['day3']['workout_intensity'] = 2;
                    $coach['day3']['hiit'] = [];
                    $coach['day3']['stretching'] = $stretches;

                    //Day4 Exercise set
                    $coach['day4']['warmup'] = $warmUps;
                    $coach['day4']['is_completed'] = 0;
                    $coach['day4']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day4']['exercises'] = [];
                    //intensify sWorkout2
                    $coach['day4']['workout'] = $sWorkout1;
                    $coach['day4']['coach_workout_rounds'] = count($coach['day4']['workout']['exercises']);
                    $coach['day4']['workout_intensity'] = 1;
                    $coach['day4']['hiit'] = [['id' => 2, 'intensity' => 4, 'is_completed' => 0]];
                    $coach['day4']['stretching'] = $stretches;

                    //Day5 Exercise set
                    $coach['day5']['warmup'] = $warmUps;
                    $coach['day5']['is_completed'] = 0;
                    $coach['day5']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day5']['exercises'] = [];
                    //intensify sWorkout2
                    $coach['day5']['workout'] = self::intensifyWorkout($sWorkout2, 1);
                    $coach['day5']['coach_workout_rounds'] = count($coach['day5']['workout']['exercises']);
                    $coach['day5']['workout_intensity'] = 2;
                    $coach['day5']['hiit'] = [['id' => 1, 'intensity' => 4, 'is_completed' => 0]];
                    $coach['day5']['stretching'] = $stretches;
                } elseif ($data['days'] == 6) {

                    //Day1 exercise set
                    $coach['day1']['warmup'] = $warmUps;
                    $coach['day1']['is_completed'] = 0;
                    $coach['day1']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day1']['exercises'] = [];
                    //intensify csWorkout1
                    $coach['day1']['workout'] = self::intensifyWorkout($csWorkout1, 1);
                    $coach['day1']['coach_workout_rounds'] = count($coach['day1']['workout']['exercises']);
                    $coach['day1']['workout_intensity'] = 2;
                    $coach['day1']['hiit'] = [];
                    $coach['day1']['stretching'] = $stretches;

                    //Day2 Exercise set
                    $coach['day2']['warmup'] = $warmUps;
                    $coach['day2']['is_completed'] = 0;
                    $coach['day2']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day2']['exercises'] = [];
                    $coach['day2']['workout'] = $csWorkout2;
                    $coach['day2']['coach_workout_rounds'] = count($coach['day2']['workout']['exercises']);
                    $coach['day2']['workout_intensity'] = 1;
                    $coach['day2']['hiit'] = [['id' => 1, 'intensity' => 4, 'is_completed' => 0], ['id' => 1, 'intensity' => 3, 'is_completed' => 0]];
                    $coach['day2']['stretching'] = $stretches;

                    //Day3 Exercise set
                    $coach['day3']['warmup'] = $warmUps;
                    $coach['day3']['is_completed'] = 0;
                    $coach['day3']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day3']['exercises'] = [];
                    //intensify sWorkout2
                    $coach['day3']['workout'] = self::intensifyWorkout($csWorkout3, 1);
                    $coach['day3']['coach_workout_rounds'] = count($coach['day3']['workout']['exercises']);
                    $coach['day3']['workout_intensity'] = 2;
                    $coach['day3']['hiit'] = [];
                    $coach['day3']['stretching'] = $stretches;

                    //Day4 Exercise set
                    $coach['day4']['warmup'] = $warmUps;
                    $coach['day4']['is_completed'] = 0;
                    $coach['day4']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day4']['exercises'] = [];
                    //intensify sWorkout2
                    $coach['day4']['workout'] = self::intensifyWorkout($sWorkout1, 1);
                    $coach['day4']['coach_workout_rounds'] = count($coach['day4']['workout']['exercises']);
                    $coach['day4']['workout_intensity'] = 2;
                    $coach['day4']['hiit'] = [];
                    $coach['day4']['stretching'] = $stretches;

                    //Day5 Exercise set
                    $coach['day5']['warmup'] = $warmUps;
                    $coach['day5']['is_completed'] = 0;
                    $coach['day5']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day5']['exercises'] = [];
                    //intensify sWorkout2
                    $coach['day5']['workout'] = $sWorkout2;
                    $coach['day5']['coach_workout_rounds'] = count($coach['day5']['workout']['exercises']);
                    $coach['day5']['workout_intensity'] = 1;
                    $coach['day5']['hiit'] = [['id' => 2, 'intensity' => 4, 'is_completed' => 0]];
                    $coach['day5']['stretching'] = $stretches;

                    //Day5 Exercise set
                    $coach['day6']['warmup'] = $warmUps;
                    $coach['day6']['is_completed'] = 0;
                    $coach['day6']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day6']['exercises'] = [];
                    //intensify sWorkout2
                    $coach['day5']['workout'] = $sWorkout2;
                    $coach['day5']['coach_workout_rounds'] = count($coach['day5']['workout']['exercises']);
                    $coach['day6']['workout_intensity'] = 2;
                    $coach['day6']['hiit'] = [];
                    $coach['day6']['stretching'] = $stretches;
                }
            } elseif ($focus == 3) {

                if ($data['days'] == 2) {

                    //Day1 exercise set
                    $coach['day1']['warmup'] = $warmUps;
                    $coach['day1']['is_completed'] = 0;
                    $coach['day1']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day1']['exercises'] = [];
                    //intensify csWorkout1
                    $coach['day1']['workout'] = self::intensifyWorkout($sWorkout1, 1);
                    $coach['day1']['coach_workout_rounds'] = count($coach['day1']['workout']['exercises']);
                    $coach['day1']['workout_intensity'] = 2;
                    $coach['day1']['hiit'] = [];
                    $coach['day1']['stretching'] = $stretches;

                    //Day2 Exercise set
                    $coach['day2']['warmup'] = $warmUps;
                    $coach['day2']['is_completed'] = 0;
                    $coach['day2']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day2']['exercises'] = [];
                    $coach['day2']['workout'] = $sWorkout2;
                    $coach['day2']['coach_workout_rounds'] = count($coach['day2']['workout']['exercises']);
                    $coach['day2']['workout_intensity'] = 1;
                    $coach['day2']['hiit'] = [['id' => 2, 'intensity' => 4, 'is_completed' => 0]];
                    $coach['day2']['stretching'] = $stretches;
                } elseif ($data['days'] == 3) {

                    //Day1 exercise set
                    $coach['day1']['warmup'] = $warmUps;
                    $coach['day1']['is_completed'] = 0;
                    $coach['day1']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day1']['exercises'] = [];
                    //intensify csWorkout1
                    $coach['day1']['workout'] = self::intensifyWorkout($sWorkout1, 1);
                    $coach['day1']['coach_workout_rounds'] = count($coach['day1']['workout']['exercises']);
                    $coach['day1']['workout_intensity'] = 2;
                    $coach['day1']['hiit'] = [];
                    $coach['day1']['stretching'] = $stretches;

                    //Day2 Exercise set
                    $coach['day2']['warmup'] = $warmUps;
                    $coach['day2']['is_completed'] = 0;
                    $coach['day2']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day2']['exercises'] = [];
                    $coach['day2']['workout'] = $sWorkout2;
                    $coach['day2']['coach_workout_rounds'] = count($coach['day2']['workout']['exercises']);
                    $coach['day2']['workout_intensity'] = 1;
                    $coach['day2']['hiit'] = [['id' => 2, 'intensity' => 4, 'is_completed' => 0]];
                    $coach['day2']['stretching'] = $stretches;

                    //Day3 Exercise set
                    $coach['day3']['warmup'] = $warmUps;
                    $coach['day3']['is_completed'] = 0;
                    $coach['day3']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day3']['exercises'] = [];
                    //intensify sWorkout2
                    $coach['day3']['workout'] = self::intensifyWorkout($sWorkout3, 1);
                    $coach['day3']['coach_workout_rounds'] = count($coach['day3']['workout']['exercises']);
                    $coach['day3']['workout_intensity'] = 2;
                    $coach['day3']['hiit'] = [];
                    $coach['day3']['stretching'] = $stretches;
                } elseif ($data['days'] == 4) {
                    //Day1 exercise set
                    $coach['day1']['warmup'] = $warmUps;
                    $coach['day1']['is_completed'] = 0;
                    $coach['day1']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day1']['exercises'] = [];
                    //intensify csWorkout1
                    $coach['day1']['workout'] = self::intensifyWorkout($sWorkout1, 1);
                    $coach['day1']['coach_workout_rounds'] = count($coach['day1']['workout']['exercises']);
                    $coach['day1']['workout_intensity'] = 2;
                    $coach['day1']['hiit'] = [];
                    $coach['day1']['stretching'] = $stretches;

                    //Day2 Exercise set
                    $coach['day2']['warmup'] = $warmUps;
                    $coach['day2']['is_completed'] = 0;
                    $coach['day2']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day2']['exercises'] = [];
                    $coach['day2']['workout'] = $sWorkout2;
                    $coach['day2']['coach_workout_rounds'] = count($coach['day2']['workout']['exercises']);
                    $coach['day2']['workout_intensity'] = 1;
                    $coach['day2']['hiit'] = [['id' => 1, 'intensity' => 4, 'is_completed' => 0]];
                    $coach['day2']['stretching'] = $stretches;

                    //Day3 Exercise set
                    $coach['day3']['warmup'] = $warmUps;
                    $coach['day3']['is_completed'] = 0;
                    $coach['day3']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day3']['exercises'] = [];
                    //intensify sWorkout2
                    $coach['day3']['workout'] = self::intensifyWorkout($sWorkout3, 1);
                    $coach['day3']['coach_workout_rounds'] = count($coach['day3']['workout']['exercises']);
                    $coach['day3']['workout_intensity'] = 2;
                    $coach['day3']['hiit'] = [];
                    $coach['day3']['stretching'] = $stretches;

                    //Day4 Exercise set
                    $coach['day4']['warmup'] = $warmUps;
                    $coach['day4']['is_completed'] = 0;
                    $coach['day4']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day4']['exercises'] = [];
                    //intensify sWorkout2
                    $coach['day4']['workout'] = $sWorkout4;
                    $coach['day4']['coach_workout_rounds'] = count($coach['day4']['workout']['exercises']);
                    $coach['day4']['workout_intensity'] = 1;
                    $coach['day4']['hiit'] = [['id' => 2, 'intensity' => 4, 'is_completed' => 0]];
                    $coach['day4']['stretching'] = $stretches;
                } elseif ($data['days'] == 5) {

                    //Day1 exercise set
                    $coach['day1']['warmup'] = $warmUps;
                    $coach['day1']['is_completed'] = 0;
                    $coach['day1']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day1']['exercises'] = [];
                    //intensify csWorkout1
                    $coach['day1']['workout'] = self::intensifyWorkout($csWorkout1, 1);
                    $coach['day1']['coach_workout_rounds'] = count($coach['day1']['workout']['exercises']);
                    $coach['day1']['workout_intensity'] = 2;
                    $coach['day1']['hiit'] = [];
                    $coach['day1']['stretching'] = $stretches;

                    //Day2 Exercise set
                    $coach['day2']['warmup'] = $warmUps;
                    $coach['day2']['is_completed'] = 0;
                    $coach['day2']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day2']['exercises'] = [];
                    $coach['day2']['workout'] = $sWorkout1;
                    $coach['day2']['coach_workout_rounds'] = count($coach['day2']['workout']['exercises']);
                    $coach['day2']['workout_intensity'] = 1;
                    $coach['day2']['hiit'] = [['id' => 3, 'intensity' => 3, 'is_completed' => 0]];
                    $coach['day2']['stretching'] = $stretches;

                    //Day3 Exercise set
                    $coach['day3']['warmup'] = $warmUps;
                    $coach['day3']['is_completed'] = 0;
                    $coach['day3']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day3']['exercises'] = [];
                    //intensify sWorkout2
                    $coach['day3']['workout'] = self::intensifyWorkout($sWorkout2, 1);
                    $coach['day3']['coach_workout_rounds'] = count($coach['day3']['workout']['exercises']);
                    $coach['day3']['workout_intensity'] = 2;
                    $coach['day3']['hiit'] = [];
                    $coach['day3']['stretching'] = $stretches;

                    //Day4 Exercise set
                    $coach['day4']['warmup'] = $warmUps;
                    $coach['day4']['is_completed'] = 0;
                    $coach['day4']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day4']['exercises'] = [];
                    //intensify sWorkout2
                    $coach['day4']['workout'] = $sWorkout3;
                    $coach['day4']['coach_workout_rounds'] = count($coach['day4']['workout']['exercises']);
                    $coach['day4']['workout_intensity'] = 1;
                    $coach['day4']['hiit'] = [['id' => 2, 'intensity' => 4, 'is_completed' => 0]];
                    $coach['day4']['stretching'] = $stretches;

                    //Day5 Exercise set
                    $coach['day5']['warmup'] = $warmUps;
                    $coach['day5']['is_completed'] = 0;
                    $coach['day5']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day5']['exercises'] = [];
                    //intensify sWorkout2
                    $coach['day5']['workout'] = self::intensifyWorkout($sWorkout4, 1);
                    $coach['day5']['coach_workout_rounds'] = count($coach['day5']['workout']['exercises']);
                    $coach['day5']['workout_intensity'] = 2;
                    $coach['day5']['hiit'] = [['id' => 1, 'intensity' => 4, 'is_completed' => 0]];
                    $coach['day5']['stretching'] = $stretches;
                } elseif ($data['days'] == 6) {

                    //Day1 exercise set
                    $coach['day1']['warmup'] = $warmUps;
                    $coach['day1']['is_completed'] = 0;
                    $coach['day1']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day1']['exercises'] = [];
                    //intensify csWorkout1
                    $coach['day1']['workout'] = self::intensifyWorkout($csWorkout1, 1);
                    $coach['day1']['coach_workout_rounds'] = count($coach['day1']['workout']['exercises']);
                    $coach['day1']['workout_intensity'] = 2;
                    $coach['day1']['hiit'] = [];
                    $coach['day1']['stretching'] = $stretches;

                    //Day2 Exercise set
                    $coach['day2']['warmup'] = $warmUps;
                    $coach['day2']['is_completed'] = 0;
                    $coach['day2']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day2']['exercises'] = [];
                    $coach['day2']['workout'] = $sWorkout1;
                    $coach['day2']['coach_workout_rounds'] = count($coach['day2']['workout']['exercises']);
                    $coach['day2']['workout_intensity'] = 1;
                    $coach['day2']['hiit'] = [['id' => 1, 'intensity' => 4, 'is_completed' => 0], ['id' => 1, 'intensity' => 3, 'is_completed' => 0]];
                    $coach['day2']['stretching'] = $stretches;

                    //Day3 Exercise set
                    $coach['day3']['warmup'] = $warmUps;
                    $coach['day3']['is_completed'] = 0;
                    $coach['day3']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day3']['exercises'] = [];
                    //intensify sWorkout2
                    $coach['day3']['workout'] = self::intensifyWorkout($sWorkout2, 1);
                    $coach['day3']['coach_workout_rounds'] = count($coach['day3']['workout']['exercises']);
                    $coach['day3']['workout_intensity'] = 2;
                    $coach['day3']['hiit'] = [];
                    $coach['day3']['stretching'] = $stretches;

                    //Day4 Exercise set
                    $coach['day4']['warmup'] = $warmUps;
                    $coach['day4']['is_completed'] = 0;
                    $coach['day4']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day4']['exercises'] = [];
                    //intensify sWorkout2
                    $coach['day4']['workout'] = self::intensifyWorkout($sWorkout3, 1);
                    $coach['day4']['coach_workout_rounds'] = count($coach['day4']['workout']['exercises']);
                    $coach['day4']['workout_intensity'] = 2;
                    $coach['day4']['hiit'] = [];
                    $coach['day4']['stretching'] = $stretches;

                    //Day5 Exercise set
                    $coach['day5']['warmup'] = $warmUps;
                    $coach['day5']['is_completed'] = 0;
                    $coach['day5']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day5']['exercises'] = [];
                    //intensify sWorkout2
                    $coach['day5']['workout'] = $sWorkout4;
                    $coach['day5']['coach_workout_rounds'] = count($coach['day5']['workout']['exercises']);
                    $coach['day5']['workout_intensity'] = 1;
                    $coach['day5']['hiit'] = [['id' => 2, 'intensity' => 4, 'is_completed' => 0]];
                    $coach['day5']['stretching'] = $stretches;

                    //Day5 Exercise set
                    $coach['day6']['warmup'] = $warmUps;
                    $coach['day6']['is_completed'] = 0;
                    $coach['day6']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day6']['exercises'] = [];
                    //intensify sWorkout5
                    $coach['day6']['workout'] = self::intensifyWorkout($sWorkout5, 1);
                    $coach['day6']['coach_workout_rounds'] = count($coach['day6']['workout']['exercises']);
                    $coach['day6']['workout_intensity'] = 2;
                    $coach['day6']['hiit'] = [];
                    $coach['day6']['stretching'] = $stretches;
                }
            }
        }

        return $coach;
    }

    public static function getWorkoutWithExercises($workoutId, $category)
    {

        $workout = Workout::where('id', '=', $workoutId)->first();
        $workout->is_completed = 0;
        $rounds = $workout->rounds;
        $count = 1;
        $exercises = [];
        do {
            $roundExercises = Workoutexercise::where('round', '=', $count)
                    ->where('category', '=', $category)
                    ->where('workout_id', '=', $workoutId)
                    ->with(['video', 'exercise'])->get();

            foreach ($roundExercises as $reKey => $roundExercise) {
                $roundExercises[$reKey]->is_completed = 0;
            }

            $exercises['round' . $count] = $roundExercises->toArray();

            $count++;
        } while ($count <= $rounds);

        $workoutArray = $workout->toArray();

        $workoutArray['exercises'] = $exercises;

        $rewardArray = json_decode($workoutArray['rewards'], true);

        if ($category == 1) {
            $workoutArray['rewards'] = $rewardArray['lean'];
        } elseif ($category == 2) {
            $workoutArray['rewards'] = $rewardArray['athletic'];
        } elseif ($category == 3) {
            $workoutArray['rewards'] = $rewardArray['strength'];
        }

        return $workoutArray;
    }

    public static function intensifyWorkout($workout, $intensity)
    {

        $roundCount = count($workout['exercises']);

        for ($i = $roundCount + 1; $i <= $roundCount + $intensity; $i++) {
            $workout['exercises']['round' . $i] = $workout['exercises']['round' . ($i - $roundCount)];
        }

        return $workout;
    }

    public static function updateCoach($exercises, $assessment, $coachId)
    {
        if ($assessment != 3) {
            foreach ($exercises as $eKey => $dayExercise) {
                $exercises[$eKey] = self::updateDayExercises($dayExercise, $assessment, $coachId);
                $exercises[$eKey]['is_completed'] = 0;
            }
        }

        return $exercises;
    }

    public static function updateDayExercises($dayExercise, $assessment, $coachId)
    {

        $coach = DB::table('coaches')->where('id', $coachId)->first();

        $coachStatus = DB::table('coach_status')->where('coach_id', $coachId)->first();

        $userDoneExercises = [];

        $i = 1;

        do {

            $fundumental = Fundumental::where('row', $i)->with(['exercise'])->get();

            $fundumentalArray[$i] = $fundumental->toArray();

            $i++;
            unset($fundumental);
        } while ($i <= 5);

        foreach ($fundumentalArray as $fKey => $fundumentals) {
            if ($data['category'] == 'beginer') {
                $fundumentalArray[$fKey] = array_map(function ($fundumental) {
                    $fundumentalDurationArray = json_decode($fundumental['duration'], TRUE);

                    $fundumental['duration'] = $fundumentalDurationArray[1];

                    $exercise = Exercise::where('id', $fundumental['exercise_id'])->with(['video'])->first();

                    $fundumental['exercise'] = $exercise->toArray();

                    return $fundumental;
                }, $fundumentals);
            } else {
                $fundumentalArray[$fKey] = array_map(function ($fundumental) {

                    $fundumentalDurationArray = json_decode($fundumental['duration'], TRUE);

                    $fundumental['duration'] = $fundumentalDurationArray[2];

                    $exercise = Exercise::where('id', $fundumental['exercise_id'])->with(['video'])->first();

                    $fundumental['exercise'] = $exercise->toArray();

                    return $fundumental;
                }, $fundumentals);
            }
        }

        $warmUps = DB::table('warmups')->select('*')->get();

        if ($coach->category == 'beginer') {
            $warmUps = array_map(function($warmUp) {

                $duration = $warmUp->duration;

                $durationArray = json_decode($duration, true);

                $warmUp->duration = $durationArray[1];

                $warmUp->is_completed = 0;

                return $warmUp;
            }, $warmUps);
        } else {

            $warmUps = array_map(function($warmUp) {

                $duration = $warmUp->duration;

                $durationArray = json_decode($duration, true);

                $warmUp->duration = $durationArray[2];

                $warmUp->is_completed = 0;

                return $warmUp;
            }, $warmUps);
        }

        if (isset($dayExercise['fundumentals'])) {
            $dayExercise['fundumentals'] = $fundumentalArray;
        }

        if (isset($dayExercise['warmup'])) {
            $dayExercise['warmup'] = $warmUps;
        }

        if ($assessment == 1) {

            if (isset($dayExercise['exercises']) && count($dayExercise['exercises']) > 0) {
                foreach ($dayExercise['exercises'] as $fKey => $exercise) {
                    if (!empty($exercise)) {
                        if ($exercise['unit'] == 'times') {
                            if ($exercise['duration'] < 25) {
                                $dayExercise['exercises'][$fKey]['duration'] = 25;
                            } elseif ($exercise['duration'] >= 25 && $exercise['duration'] < 50) {
                                $dayExercise['exercises'][$fKey]['duration'] = 50;
                            } elseif ($exercise['duration'] >= 50 && $exercise['duration'] < 100) {
                                $dayExercise['exercises'][$fKey]['duration'] = 100;
                            } elseif ($exercise['duration'] >= 250 && $exercise['duration'] < 500) {
                                $dayExercise['exercises'][$fKey]['duration'] = 500;
                            } elseif ($exercise['duration'] >= 500 && $exercise['duration'] < 750) {
                                $dayExercise['exercises'][$fKey]['duration'] = 750;
                            } elseif ($exercise['duration'] >= 750 && $exercise['duration'] <= 1000) {
                                $dayExercise['exercises'][$fKey]['duration'] = 1000;
                            }
                        } else {
                            $dayExercise['exercises'][$fKey]['duration'] = round($exercise['duration'] + ($exercise['duration'] * 5 / 100));
                        }
                        $dayExercise['exercises'][$fKey]['is_completed'] = 0;
                        $userDoneExercises[] = strval($exercise['id']);
                    }
                }
            }

            if (isset($dayExercise['workout']) && count($dayExercise['workout'] > 0)) {

                if (!empty($dayExercise['workout'])) {
                    $dayExercise['workout'] = self::intensifyWorkout($dayExercise['workout'], 1);

                    $dayExercise['workout']['is_completed'] = 0;

                    $workoutExerciseRoundCount = count($dayExercise['workout']['exercises']);

                    $dayExercise['workout_intensity'] = ceil($workoutExerciseRoundCount / $dayExercise['workout']['rounds']);
                }
            }

            if (isset($dayExercise['hiit']) && count($dayExercise['hiit']) > 0) {
                if (!empty($dayExercise['hiit'])) {
                    foreach ($dayExercise['hiit'] as $hKey => $hiit) {
                        $dayExercise['hiit'][$hKey]['is_completed'] = 0;
                        if ($hiit['id'] == 1) {
                            if ($hiit['intensity'] < 10) {
                                $dayExercise['hiit'][$hKey]['intensity'] = $hiit['intensity'] + 1;
                            } else {
                                $dayExercise['hiit'][$hKey]['intensity'] = $hiit['intensity'];
                            }
                        } elseif ($hiit['id'] == 2) {
                            if ($hiit['intensity'] < 8) {
                                $dayExercise['hiit'][$hKey]['intensity'] = $hiit['intensity'] + 1;
                            } else {
                                $dayExercise['hiit'][$hKey]['intensity'] = $hiit['intensity'];
                            }
                        } elseif ($hiit['id'] == 3) {
                            if ($hiit['intensity'] < 5) {
                                $dayExercise['hiit'][$hKey]['intensity'] = $hiit['intensity'] + 1;
                            } else {
                                $dayExercise['hiit'][$hKey]['intensity'] = $hiit['intensity'];
                            }
                        }
                    }
                }
            }
        } elseif ($assessment == 2) {
            if (isset($dayExercise['exercises']) && count($dayExercise['exercises']) > 0) {
                foreach ($dayExercise['exercises'] as $fKey => $exercise) {
                    if (!empty($exercise)) {
                        if ($exercise['unit'] == 'times') {
                            if ($exercise['duration'] < 25) {
                                $dayExercise['exercises'][$fKey]['duration'] = 25;
                            } elseif ($exercise['duration'] >= 25 && $exercise['duration'] < 50) {
                                $dayExercise['exercises'][$fKey]['duration'] = 50;
                            } elseif ($exercise['duration'] >= 50 && $exercise['duration'] < 100) {
                                $dayExercise['exercises'][$fKey]['duration'] = 100;
                            } elseif ($exercise['duration'] >= 250 && $exercise['duration'] < 500) {
                                $dayExercise['exercises'][$fKey]['duration'] = 500;
                            } elseif ($exercise['duration'] >= 500 && $exercise['duration'] < 750) {
                                $dayExercise['exercises'][$fKey]['duration'] = 750;
                            } elseif ($exercise['duration'] >= 750 && $exercise['duration'] <= 1000) {
                                $dayExercise['exercises'][$fKey]['duration'] = 1000;
                            }
                        } else {
                            $dayExercise['exercises'][$fKey]['duration'] = round($exercise['duration'] + ($exercise['duration'] * 5 / 100));
                        }
                        $userDoneExercises[] = strval($exercise['id']);
                    }
                }
            }

            if (isset($dayExercise['workout']) && count($dayExercise['workout'] > 0)) {

                $dayExercise['workout'] = self::intensifyWorkout($dayExercise['workout'], 1);

                $workoutExerciseRoundCount = count($dayExercise['workout']['exercises']);

                $dayExercise['workout_intensity'] = ceil($workoutExerciseRoundCount / $dayExercise['workout']['rounds']);
            }
        }

        $notInQuery = '';

        if (count($userDoneExercises) > 0) {

            $notInQuery = ' AND skills.exercise_id NOT IN(' . implode(',', $userDoneExercises) . ')';
        }


        $userUnlockedSkillExerciseQuery = DB::table('unlocked_skills')
                ->select('exercise_id')
                ->whereRaw('user_id = ' . $coach->user_id)->toSql();

        $basicSkillsQuery = DB::table('skills')
            ->leftJoin('exercises', 'skills.exercise_id', '=', 'exercises.id')
            ->select('skills.*')
            ->groupBy('skills.progression_id')
            ->orderBy('skills.id');

        $likeQuery = '';

        if ($coach->muscle_groups != '') {

            $muscleGroupArray = explode(',', $coach->muscle_groups);
            $likeQuery = ' AND (';
            foreach ($muscleGroupArray as $mgKey => $muscleGroupId) {
                $likeQueryArray[] = 'exercises.muscle_groups LIKE "%' . $muscleGroupId . '%"';
            }

            $likeQuery .= implode(' OR ', $likeQueryArray) . ')';

            $basicSkillsQuery->whereRaw('skills.exercise_id IN(' . $userUnlockedSkillExerciseQuery . ') AND exercises.category = ' . $coach->focus . $likeQuery . $notInQuery);

            $additionalExercise = $basicSkillsQuery->first();
            if (!is_null($additionalExercise)) {
                $dayExercise['exercises'][] = Exercise::where('id', $additionalExercise->id)->with(['video'])->first();
            }
        }

        return $dayExercise;
    }

    public static function getUserMatchedWorkoutsQuery($category, $focus, $userId)
    {
        $whereQuery = '';

        $userUnlockedSkillExerciseQuery = DB::table('unlocked_skills')
            ->select('exercise_id')
            ->whereRaw('user_id = ' . $userId)
            ->toSql();

        $whereQuery .= ' AND (exercise_id IN(' . $userUnlockedSkillExerciseQuery . ')';
        

        $userMuscleGroups = DB::table('user_physique_options')->where('user_id', $userId)->first();


        if (!is_null($userMuscleGroups)) {
            if ($userMuscleGroups->physique_options != '') {
                $muscleGroupArray = explode(',', $userMuscleGroups->physique_options);

                $likeQuery = '';
                
                foreach ($muscleGroupArray as $mgKey => $muscleGroupId) {
                    if ($muscleGroupId != ' ' && $muscleGroupId != '') {
                        $likeQueryArray[] = 'exercises.muscle_groups LIKE "%' . $muscleGroupId . '%"';
                    }
                }
                $likeQuery .= implode(' OR ', $likeQueryArray);

                if ($likeQuery != '') {
                    $userOptedMuscleExercisesQuery = DB::table('exercises')
                        ->select('id')
                        ->whereRaw($likeQuery)
                        ->toSql();
                    $whereQuery .= ' AND exercise_id IN(' . $userOptedMuscleExercisesQuery . ')';
                }
            }
        }

        $userGoalOption = DB::table('user_goal_options')->where('user_id', $userId)->first();

        if (!is_null($userGoalOption)) {
            if ($userGoalOption->goal_options != '') {

                $goal = DB::table('skills')->where('id', $userGoalOption->goal_options)->first();

                $userOptedGoalExercisesQuery = DB::table('skills')
                    ->select('exercise_id')
                    ->whereRaw('progression_id = ' . $goal->progression_id . ' AND row = ' . $goal->row)
                    ->toSql();

                $whereQuery .= ' AND exercise_id IN(' . $userOptedGoalExercisesQuery . ')';
            }
        }
        
        $whereQuery .= ')';

        return 'SELECT  t1.id, 
                        s.totalCount AS exercise_count 
                FROM    workouts AS t1 
                        LEFT JOIN
                        (
                            SELECT  workout_id, COUNT(*) totalCount 
                            FROM    workout_exercises 
                            WHERE   workout_exercises.category = ' . $focus . $whereQuery .
            'GROUP   BY workout_id
                        )  s ON s.workout_id = t1.id
                WHERE   t1.category = ' . $category . '
                ORDER   BY exercise_count DESC';
    }

    public static function getUserBasicSkills($userId, $muscleGroups, $focus)
    {

        $userUnlockedSkillExerciseQuery = DB::table('unlocked_skills')
            ->select('exercise_id')
            ->whereRaw('user_id = ' . $userId)
            ->toSql();

        $basicSkillsQuery = DB::table('skills')
            ->leftJoin('exercises', 'exercises.id', '=', 'skills.exercise_id')
            ->select('skills.*')
            ->groupBy('skills.progression_id')
            ->orderBy('skills.id');

        if ($muscleGroups != '') {
            $muscleGroupArray = explode(',', $muscleGroups);
            $likeQuery = ' AND (';
            foreach ($muscleGroupArray as $mgKey => $muscleGroupId) {
                $likeQueryArray[] = 'exercises.muscle_groups LIKE "%' . $muscleGroupId . '%"';
            }
            $likeQuery .= implode(' OR ', $likeQueryArray) . ')';

            $basicSkillsQuery->whereRaw('skills.exercise_id IN(' . $userUnlockedSkillExerciseQuery . ') AND exercises.category = ' . $focus . $likeQuery);
        } else {
            $basicSkillsQuery->whereRaw('skills.exercise_id IN(' . $userUnlockedSkillExerciseQuery . ') AND exercises.category = ' . $focus);
        }

        $basicSkills = $basicSkillsQuery->get();

        return $basicSkills;
    }
}
