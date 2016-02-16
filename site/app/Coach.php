<?php namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use DB;
use App\Exercise;
use App\Fundumental;
use App\Stretching;
use App\Musclegroup;
use App\Skill;
Use App\Workout;
Use App\Workoutexercise;

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
        'muscle_groups',
        'feedback'
    ];
    protected $appends = ['musclegroup_string', 'goaloption_string'];
    public static $workoutIntensityArray = [
        1 => [
            1 => [0 => 1, 1 => 2, 2 => 3],
            2 => [0 => 0, 1 => 1, 2 => 3],
            3 => [0 => 0, 1 => 0, 2 => 3],
            4 => [0 => 0, 1 => 0, 2 => 0],
            5 => [0 => 1, 1 => 3, 2 => 3],
            6 => [0 => 0, 1 => 0, 2 => 1],
            7 => [0 => 0, 1 => 0, 2 => 0],
            8 => [0 => 1, 1 => 2, 2 => 3],
            9 => [0 => 1, 1 => 2, 2 => 3],
            10 => [0 => 0, 1 => 0, 2 => 1],
            11 => [0 => 1, 1 => 2, 2 => 3],
            12 => [0 => 0, 1 => 2, 2 => 3],
            13 => [0 => 1, 1 => 2, 2 => 0],
            14 => [0 => 0, 1 => 0, 2 => 1],
            15 => [0 => 2, 1 => 3, 2 => 0],
            16 => [0 => 1, 1 => 2, 2 => 0],
            17 => [0 => 0, 1 => 0, 2 => 0],
            18 => [0 => 0, 1 => 0, 2 => 3],
            19 => [0 => 1, 1 => 2, 2 => 3],
            20 => [0 => 1, 1 => 2, 2 => 0],
            21 => [0 => 1, 1 => 2, 2 => 3],
            22 => [0 => 1, 1 => 2, 2 => 0],
            23 => [0 => 1, 1 => 2, 2 => 3],
            24 => [0 => 0, 1 => 0, 2 => 1],
            25 => [0 => 0, 1 => 2, 2 => 3],
        ],
        2 => [
            1 => [0 => 0, 1 => 2, 2 => 3],
            2 => [0 => 0, 1 => 0, 2 => 3],
            3 => [0 => 0, 1 => 0, 2 => 3],
            4 => [0 => 0, 1 => 0, 2 => 0],
            5 => [0 => 0, 1 => 0, 2 => 3],
            6 => [0 => 0, 1 => 0, 2 => 1],
            7 => [0 => 0, 1 => 0, 2 => 0],
            8 => [0 => 0, 1 => 2, 2 => 3],
            9 => [0 => 0, 1 => 2, 2 => 3],
            10 => [0 => 0, 1 => 0, 2 => 1],
            11 => [0 => 0, 1 => 2, 2 => 3],
            12 => [0 => 0, 1 => 2, 2 => 3],
            13 => [0 => 0, 1 => 0, 2 => 2],
            14 => [0 => 0, 1 => 0, 2 => 1],
            15 => [0 => 0, 1 => 0, 2 => 3],
            16 => [0 => 0, 1 => 0, 2 => 2],
            17 => [0 => 0, 1 => 0, 2 => 0],
            18 => [0 => 0, 1 => 0, 2 => 3],
            19 => [0 => 0, 1 => 2, 2 => 3],
            20 => [0 => 0, 1 => 0, 2 => 2],
            21 => [0 => 0, 1 => 2, 2 => 3],
            22 => [0 => 0, 1 => 0, 2 => 2],
            23 => [0 => 0, 1 => 2, 2 => 3],
            24 => [0 => 0, 1 => 0, 2 => 1],
            25 => [0 => 0, 1 => 2, 2 => 3]
        ],
        3 => [
            1 => [0 => 0, 1 => 2, 2 => 3, 3 => 0, 4 => 5],
            2 => [0 => 0, 1 => 0, 2 => 0, 3 => 0, 4 => 3],
            3 => [0 => 0, 1 => 0, 2 => 3, 3 => 4, 4 => 5],
            4 => [0 => 0, 1 => 0, 2 => 0, 3 => 0, 4 => 1],
            5 => [0 => 1, 1 => 2, 2 => 0, 3 => 0, 4 => 3],
            6 => [0 => 0, 1 => 0, 2 => 0, 3 => 0, 4 => 1],
            7 => [0 => 0, 1 => 0, 2 => 0, 3 => 0, 4 => 1],
            8 => [0 => 1, 1 => 2, 2 => 3, 3 => 4, 4 => 5],
            9 => [0 => 1, 1 => 2, 2 => 0, 3 => 0, 4 => 3],
            10 => [0 => 0, 1 => 0, 2 => 0, 3 => 0, 4 => 1],
            11 => [0 => 1, 1 => 0, 2 => 2, 3 => 3, 4 => 4],
            12 => [0 => 2, 1 => 3, 2 => 4, 3 => 5, 4 => 6],
            13 => [0 => 1, 1 => 2, 2 => 0, 3 => 3, 4 => 4],
            14 => [0 => 0, 1 => 0, 2 => 0, 3 => 0, 4 => 1],
            15 => [0 => 2, 1 => 0, 2 => 0, 3 => 3, 4 => 4],
            16 => [0 => 1, 1 => 0, 2 => 0, 3 => 2, 4 => 3],
            17 => [0 => 0, 1 => 0, 2 => 0, 3 => 0, 4 => 1],
            18 => [0 => 0, 1 => 0, 2 => 0, 3 => 3, 4 => 4],
            19 => [0 => 1, 1 => 2, 2 => 0, 3 => 0, 4 => 3],
            20 => [0 => 1, 1 => 2, 2 => 0, 3 => 0, 4 => 3],
            21 => [0 => 1, 1 => 2, 2 => 0, 3 => 0, 4 => 3],
            22 => [0 => 1, 1 => 2, 2 => 0, 3 => 0, 4 => 3],
            23 => [0 => 1, 1 => 2, 2 => 0, 3 => 0, 4 => 3],
            24 => [0 => 1, 1 => 0, 2 => 0, 3 => 2, 4 => 3],
            25 => [0 => 0, 1 => 0, 2 => 2, 3 => 3, 4 => 4]
        ],
        4 => [
            1 => [0 => 5],
            2 => [0 => 3],
            3 => [0 => 5],
            4 => [0 => 1],
            5 => [0 => 3],
            6 => [0 => 1],
            7 => [0 => 1],
            8 => [0 => 5],
            9 => [0 => 3],
            10 => [0 => 1],
            11 => [0 => 4],
            12 => [0 => 6],
            13 => [0 => 4],
            14 => [0 => 1],
            15 => [0 => 4],
            16 => [0 => 3],
            17 => [0 => 1],
            18 => [0 => 4],
            19 => [0 => 3],
            20 => [0 => 3],
            21 => [0 => 3],
            22 => [0 => 3],
            23 => [0 => 3],
            24 => [0 => 3],
            25 => [0 => 4],
        ],
        5 => [
            1 => [0 => 1, 1 => 2, 2 => 3, 3 => 0, 4 => 5],
            2 => [0 => 1, 1 => 1, 2 => 1, 3 => 0, 4 => 3],
            3 => [0 => 0, 1 => 0, 2 => 3, 3 => 4, 4 => 5],
            4 => [0 => 0, 1 => 0, 2 => 0, 3 => 0, 4 => 1],
            5 => [0 => 1, 1 => 2, 2 => 0, 3 => 0, 4 => 3],
            6 => [0 => 0, 1 => 0, 2 => 0, 3 => 0, 4 => 1],
            7 => [0 => 0, 1 => 0, 2 => 0, 3 => 0, 4 => 1],
            8 => [0 => 1, 1 => 2, 2 => 3, 3 => 4, 4 => 5],
            9 => [0 => 1, 1 => 2, 2 => 0, 3 => 0, 4 => 3],
            10 => [0 => 0, 1 => 0, 2 => 0, 3 => 0, 4 => 1],
            11 => [0 => 1, 1 => 0, 2 => 2, 3 => 3, 4 => 4],
            12 => [0 => 2, 1 => 3, 2 => 4, 3 => 5, 4 => 6],
            13 => [0 => 1, 1 => 2, 2 => 0, 3 => 3, 4 => 4],
            14 => [0 => 0, 1 => 0, 2 => 0, 3 => 0, 4 => 1],
            15 => [0 => 2, 1 => 0, 2 => 0, 3 => 3, 4 => 4],
            16 => [0 => 1, 1 => 0, 2 => 0, 3 => 2, 4 => 3],
            17 => [0 => 0, 1 => 0, 2 => 0, 3 => 0, 4 => 1],
            18 => [0 => 0, 1 => 0, 2 => 0, 3 => 3, 4 => 4],
            19 => [0 => 1, 1 => 2, 2 => 0, 3 => 0, 4 => 3],
            20 => [0 => 1, 1 => 2, 2 => 0, 3 => 0, 4 => 3],
            21 => [0 => 1, 1 => 2, 2 => 0, 3 => 0, 4 => 3],
            22 => [0 => 1, 1 => 2, 2 => 0, 3 => 0, 4 => 3],
            23 => [0 => 1, 1 => 2, 2 => 0, 3 => 0, 4 => 3],
            24 => [0 => 1, 1 => 0, 2 => 0, 3 => 2, 4 => 3],
            25 => [0 => 0, 1 => 0, 2 => 2, 3 => 3, 4 => 4]
        ]
    ];

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
            $skill = Skill::where('id', (int) $goalOption)->first();
            $exercise = DB::table('exercises')->where('id', $skill->exercise_id)->first();
            return $exercise->name;
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
            $userLevel = 'beginer';
        } else {
            if ($data['test1'] == 1 && $data['test2'] == 0) {
                $userLevel = 'advanced';
            } else {
                $stretchesArray = array_map(function($stretch) {
                    $stretch['duration']['min'] = round($stretch['duration']['min'] + ($stretch['duration']['min'] * (25 / 100)));
                    $stretch['duration']['max'] = round($stretch['duration']['max'] + ($stretch['duration']['max'] * (25 / 100)));
                    return $stretch;
                }, $stretchesArray);

                $userLevel = 'professional';
            }
        }

        if ($userLevel == 'professional') {
            $intenseFactor = 2;
        } elseif ($userLevel == 'advanced') {
            $intenseFactor = 1;
        } elseif ($userLevel == 'beginer') {
            $intenseFactor = 0;
        }

        $userWorkouts['strength'] = DB::select(self::getUserMatchedWorkoutsQuery(1, $data['focus'], $data['user_id'], $data, $intenseFactor, $fundumentalArray));

        $userWorkouts['cardio_strength'] = DB::select(self::getUserMatchedWorkoutsQuery(2, $data['focus'], $data['user_id'], $data, $intenseFactor, $fundumentalArray));

        $coach = self::getCoachForFocus($warmUps, $fundumentalArray, $stretchesArray, $data, $userWorkouts, $data['focus'], $userLevel);

        return $coach;
    }

    public static function getCoachForFocus($warmUps, $fundumentalArray, $stretches, $data, $userWorkouts, $focus, $userLevel)
    {
        $coach = [];
        if ($userLevel == 'professional') {
            $intenseFactor = 2;
        } elseif ($userLevel == 'advanced') {
            $intenseFactor = 1;
        } elseif ($userLevel == 'beginer') {
            $intenseFactor = 0;
        }

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

                $day1Workout = self::getWorkoutWithExercises($userWorkouts['cardio_strength'][random_int(1, 4)]->id, $focus, $intenseFactor);

                $day3Workout = self::getWorkoutWithExercises($userWorkouts['cardio_strength'][random_int(1, 4)]->id, $focus, $intenseFactor);

                $day5Workout = self::getWorkoutWithExercises($userWorkouts['cardio_strength'][random_int(1, 4)]->id, $focus, $intenseFactor);

                $day6Workout = self::getWorkoutWithExercises($userWorkouts['cardio_strength'][random_int(1, 4)]->id, $focus, $intenseFactor);

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

                $day1Workout = self::getWorkoutWithExercises($userWorkouts['cardio_strength'][random_int(1, 4)]->id, 2, $intenseFactor);

                $day3Workout = self::getWorkoutWithExercises($userWorkouts['cardio_strength'][random_int(1, 4)]->id, 2, $intenseFactor);

                $day5Workout = self::getWorkoutWithExercises($userWorkouts['cardio_strength'][random_int(1, 4)]->id, 2, $intenseFactor);

                $day6Workout = self::getWorkoutWithExercises($userWorkouts['cardio_strength'][random_int(1, 4)]->id, 2, $intenseFactor);

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

                $day1Workout = self::getWorkoutWithExercises($userWorkouts['cardio_strength'][random_int(1, 4)]->id, 3, $intenseFactor);

                $day3Workout = self::getWorkoutWithExercises($userWorkouts['cardio_strength'][random_int(1, 4)]->id, 3, $intenseFactor);

                $day5Workout = self::getWorkoutWithExercises($userWorkouts['cardio_strength'][random_int(1, 4)]->id, 3, $intenseFactor);

                $day6Workout = self::getWorkoutWithExercises($userWorkouts['cardio_strength'][random_int(1, 4)]->id, 3, $intenseFactor);

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

            $csWorkout1 = self::getWorkoutWithExercises($userWorkouts['cardio_strength'][random_int(1, 7)]->id, $focus, $intenseFactor);

            $csWorkout2 = self::getWorkoutWithExercises($userWorkouts['cardio_strength'][random_int(1, 7)]->id, $focus, $intenseFactor);

            $csWorkout3 = self::getWorkoutWithExercises($userWorkouts['cardio_strength'][random_int(1, 7)]->id, $focus, $intenseFactor);

            $csWorkout4 = self::getWorkoutWithExercises($userWorkouts['cardio_strength'][random_int(1, 7)]->id, $focus, $intenseFactor);

            $csWorkout5 = self::getWorkoutWithExercises($userWorkouts['cardio_strength'][random_int(1, 7)]->id, $focus, $intenseFactor);

            $csWorkout6 = self::getWorkoutWithExercises($userWorkouts['cardio_strength'][random_int(1, 7)]->id, $focus, $intenseFactor);

            $sWorkout1 = self::getWorkoutWithExercises($userWorkouts['strength'][random_int(1, 7)]->id, $focus, $intenseFactor);

            $sWorkout2 = self::getWorkoutWithExercises($userWorkouts['strength'][random_int(1, 7)]->id, $focus, $intenseFactor);

            $sWorkout3 = self::getWorkoutWithExercises($userWorkouts['strength'][random_int(1, 7)]->id, $focus, $intenseFactor);

            $sWorkout4 = self::getWorkoutWithExercises($userWorkouts['strength'][random_int(1, 7)]->id, $focus, $intenseFactor);

            $sWorkout5 = self::getWorkoutWithExercises($userWorkouts['strength'][random_int(1, 7)]->id, $focus, $intenseFactor);

            $sWorkout6 = self::getWorkoutWithExercises($userWorkouts['strength'][random_int(1, 7)]->id, $focus, $intenseFactor);

            if ($focus == 1) {
                if ($data['days'] == 2) {
//Day1 exercise set
                    $coach['day1']['warmup'] = $warmUps;
                    $coach['day1']['is_completed'] = 0;
                    $coach['day1']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
//intensify csWorkout1
                    $coach['day1']['exercises'] = [];
                    $coach['day1']['workout'] = $csWorkout1;
                    $coach['day1']['coach_workout_rounds'] = count($coach['day1']['workout']['exercises']);
                    $coach['day1']['workout_intensity'] = 1;
                    $coach['day1']['hiit'] = [];
                    $coach['day1']['stretching'] = $stretches;

//Day2 Exercise set
                    $coach['day2']['warmup'] = $warmUps;
                    $coach['day2']['is_completed'] = 0;
                    $coach['day2']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day2']['exercises'] = [];
                    $coach['day2']['workout'] = $csWorkout2;
                    $coach['day2']['coach_workout_rounds'] = count($csWorkout2['exercises']);
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
                    $coach['day1']['workout'] = $csWorkout1;
                    $coach['day1']['coach_workout_rounds'] = count($coach['day1']['workout']['exercises']);
                    $coach['day1']['workout_intensity'] = 1;
                    $coach['day1']['hiit'] = [];
                    $coach['day1']['stretching'] = $stretches;

//Day2 Exercise set
                    $coach['day2']['warmup'] = $warmUps;
                    $coach['day2']['is_completed'] = 0;
                    $coach['day2']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day2']['exercises'] = [];
                    $coach['day2']['workout'] = $csWorkout2;
                    $coach['day2']['coach_workout_rounds'] = count($csWorkout2['exercises']);
                    $coach['day2']['workout_intensity'] = 1;
                    $coach['day2']['hiit'] = [['id' => 1, 'intensity' => 4, 'is_completed' => 0]];
                    $coach['day2']['stretching'] = $stretches;

//Day3 Exercise set
                    $coach['day3']['warmup'] = $warmUps;
                    $coach['day3']['is_completed'] = 0;
                    $coach['day3']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day3']['exercises'] = [];
//intensify sWorkout2
                    $coach['day3']['workout'] = $sWorkout1;
                    $coach['day3']['coach_workout_rounds'] = count($coach['day3']['workout']['exercises']);
                    $coach['day3']['workout_intensity'] = 1;
                    $coach['day3']['hiit'] = [];
                    $coach['day3']['stretching'] = $stretches;
                } elseif ($data['days'] == 4) {
//Day1 exercise set
                    $coach['day1']['warmup'] = $warmUps;
                    $coach['day1']['is_completed'] = 0;
                    $coach['day1']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day1']['exercises'] = [];
//intensify csWorkout1
                    $coach['day1']['workout'] = $csWorkout1;
                    $coach['day1']['coach_workout_rounds'] = count($coach['day1']['workout']['exercises']);
                    $coach['day1']['workout_intensity'] = 1;
                    $coach['day1']['hiit'] = [];
                    $coach['day1']['stretching'] = $stretches;

//Day2 Exercise set
                    $coach['day2']['warmup'] = $warmUps;
                    $coach['day2']['is_completed'] = 0;
                    $coach['day2']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day2']['exercises'] = [];
                    $coach['day2']['workout'] = $csWorkout2;
                    $coach['day2']['coach_workout_rounds'] = count($csWorkout2['exercises']);
                    $coach['day2']['workout_intensity'] = 1;
                    $coach['day2']['hiit'] = [['id' => 3, 'intensity' => 3, 'is_completed' => 0]];
                    $coach['day2']['stretching'] = $stretches;

//Day3 Exercise set
                    $coach['day3']['warmup'] = $warmUps;
                    $coach['day3']['is_completed'] = 0;
                    $coach['day3']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day3']['exercises'] = [];
//intensify sWorkout2
                    $coach['day3']['workout'] = $csWorkout3;
                    $coach['day3']['coach_workout_rounds'] = count($coach['day3']['workout']['exercises']);
                    $coach['day3']['workout_intensity'] = 1;
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
                    $coach['day1']['workout'] = $csWorkout1;
                    $coach['day1']['coach_workout_rounds'] = count($coach['day1']['workout']['exercises']);
                    $coach['day1']['workout_intensity'] = 1;
                    $coach['day1']['hiit'] = [];
                    $coach['day1']['stretching'] = $stretches;

//Day2 Exercise set
                    $coach['day2']['warmup'] = $warmUps;
                    $coach['day2']['is_completed'] = 0;
                    $coach['day2']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day2']['exercises'] = [];
                    $coach['day2']['workout'] = $csWorkout2;
                    $coach['day2']['coach_workout_rounds'] = count($csWorkout2['exercises']);
                    $coach['day2']['workout_intensity'] = 1;
                    $coach['day2']['hiit'] = [['id' => 1, 'intensity' => 4, 'is_completed' => 0]];
                    $coach['day2']['stretching'] = $stretches;

//Day3 Exercise set
                    $coach['day3']['warmup'] = $warmUps;
                    $coach['day3']['is_completed'] = 0;
                    $coach['day3']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day3']['exercises'] = [];
//intensify sWorkout2
                    $coach['day3']['workout'] = $csWorkout3;
                    $coach['day3']['coach_workout_rounds'] = count($coach['day3']['workout']['exercises']);
                    $coach['day3']['workout_intensity'] = 1;
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
                    $coach['day5']['workout'] = $sWorkout2;
                    $coach['day5']['coach_workout_rounds'] = count($coach['day5']['workout']['exercises']);
                    $coach['day5']['workout_intensity'] = 1;
                    $coach['day5']['hiit'] = [['id' => 1, 'intensity' => 4, 'is_completed' => 0]];
                    $coach['day5']['stretching'] = $stretches;
                } elseif ($data['days'] == 6) {

//Day1 exercise set
                    $coach['day1']['warmup'] = $warmUps;
                    $coach['day1']['is_completed'] = 0;
                    $coach['day1']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day1']['exercises'] = [];
//intensify csWorkout1
                    $coach['day1']['workout'] = $csWorkout1;
                    $coach['day1']['coach_workout_rounds'] = count($coach['day1']['workout']['exercises']);
                    $coach['day1']['workout_intensity'] = 1;
                    $coach['day1']['hiit'] = [];
                    $coach['day1']['stretching'] = $stretches;

//Day2 Exercise set
                    $coach['day2']['warmup'] = $warmUps;
                    $coach['day2']['is_completed'] = 0;
                    $coach['day2']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day2']['exercises'] = [];
                    $coach['day2']['workout'] = $csWorkout2;
                    $coach['day2']['coach_workout_rounds'] = count($csWorkout2['exercises']);
                    $coach['day2']['workout_intensity'] = 1;
                    $coach['day2']['hiit'] = [['id' => 1, 'intensity' => 4, 'is_completed' => 0], ['id' => 1, 'intensity' => 3, 'is_completed' => 0]];
                    $coach['day2']['stretching'] = $stretches;

//Day3 Exercise set
                    $coach['day3']['warmup'] = $warmUps;
                    $coach['day3']['is_completed'] = 0;
                    $coach['day3']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day3']['exercises'] = [];
//intensify sWorkout2
                    $coach['day3']['workout'] = $csWorkout3;
                    $coach['day3']['coach_workout_rounds'] = count($coach['day3']['workout']['exercises']);
                    $coach['day3']['workout_intensity'] = 1;
                    $coach['day3']['hiit'] = [];
                    $coach['day3']['stretching'] = $stretches;

//Day4 Exercise set
                    $coach['day4']['warmup'] = $warmUps;
                    $coach['day4']['is_completed'] = 0;
                    $coach['day4']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day4']['exercises'] = [];
//intensify sWorkout2
                    $coach['day4']['workout'] = $csWorkout4;
                    $coach['day4']['coach_workout_rounds'] = count($coach['day4']['workout']['exercises']);
                    $coach['day4']['workout_intensity'] = 1;
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
                    $coach['day6']['workout'] = $sWorkout2;
                    $coach['day6']['coach_workout_rounds'] = count($coach['day6']['workout']['exercises']);
                    $coach['day6']['workout_intensity'] = 1;
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
                    $coach['day1']['workout'] = $csWorkout1;
                    $coach['day1']['coach_workout_rounds'] = count($coach['day1']['workout']['exercises']);
                    $coach['day1']['workout_intensity'] = 1;
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
                    $coach['day1']['workout'] = $csWorkout1;
                    $coach['day1']['coach_workout_rounds'] = count($coach['day1']['workout']['exercises']);
                    $coach['day1']['workout_intensity'] = 1;
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
                    $coach['day3']['workout'] = $sWorkout2;
                    $coach['day3']['coach_workout_rounds'] = count($coach['day3']['workout']['exercises']);
                    $coach['day3']['workout_intensity'] = 1;
                    $coach['day3']['hiit'] = [];
                    $coach['day3']['stretching'] = $stretches;
                } elseif ($data['days'] == 4) {
//Day1 exercise set
                    $coach['day1']['warmup'] = $warmUps;
                    $coach['day1']['is_completed'] = 0;
                    $coach['day1']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day1']['exercises'] = [];
//intensify csWorkout1
                    $coach['day1']['workout'] = $csWorkout1;
                    $coach['day1']['coach_workout_rounds'] = count($coach['day1']['workout']['exercises']);
                    $coach['day1']['workout_intensity'] = 1;
                    $coach['day1']['hiit'] = [];
                    $coach['day1']['stretching'] = $stretches;

//Day2 Exercise set
                    $coach['day2']['warmup'] = $warmUps;
                    $coach['day2']['is_completed'] = 0;
                    $coach['day2']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day2']['exercises'] = [];
                    $coach['day2']['workout'] = $csWorkout2;
                    $coach['day2']['coach_workout_rounds'] = count($csWorkout2['exercises']);
                    $coach['day2']['workout_intensity'] = 1;
                    $coach['day2']['hiit'] = [['id' => 3, 'intensity' => 3, 'is_completed' => 0]];
                    $coach['day2']['stretching'] = $stretches;

//Day3 Exercise set
                    $coach['day3']['warmup'] = $warmUps;
                    $coach['day3']['is_completed'] = 0;
                    $coach['day3']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day3']['exercises'] = [];
//intensify sWorkout2
                    $coach['day3']['workout'] = $sWorkout1;
                    $coach['day3']['coach_workout_rounds'] = count($coach['day3']['workout']['exercises']);
                    $coach['day3']['workout_intensity'] = 1;
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
                    $coach['day1']['workout'] = $csWorkout1;
                    $coach['day1']['coach_workout_rounds'] = count($coach['day1']['workout']['exercises']);
                    $coach['day1']['workout_intensity'] = 1;
                    $coach['day1']['hiit'] = [];
                    $coach['day1']['stretching'] = $stretches;

//Day2 Exercise set
                    $coach['day2']['warmup'] = $warmUps;
                    $coach['day2']['is_completed'] = 0;
                    $coach['day2']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day2']['exercises'] = [];
                    $coach['day2']['workout'] = $csWorkout2;
                    $coach['day2']['coach_workout_rounds'] = count($csWorkout2['exercises']);
                    $coach['day2']['workout_intensity'] = 1;
                    $coach['day2']['hiit'] = [['id' => 1, 'intensity' => 4, 'is_completed' => 0]];
                    $coach['day2']['stretching'] = $stretches;

//Day3 Exercise set
                    $coach['day3']['warmup'] = $warmUps;
                    $coach['day3']['is_completed'] = 0;
                    $coach['day3']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day3']['exercises'] = [];
//intensify sWorkout2
                    $coach['day3']['workout'] = $csWorkout3;
                    $coach['day3']['coach_workout_rounds'] = count($coach['day3']['workout']['exercises']);
                    $coach['day3']['workout_intensity'] = 1;
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
                    $coach['day5']['workout'] = $sWorkout2;
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
                    $coach['day1']['workout'] = $csWorkout1;
                    $coach['day1']['coach_workout_rounds'] = count($coach['day1']['workout']['exercises']);
                    $coach['day1']['workout_intensity'] = 1;
                    $coach['day1']['hiit'] = [];
                    $coach['day1']['stretching'] = $stretches;

//Day2 Exercise set
                    $coach['day2']['warmup'] = $warmUps;
                    $coach['day2']['is_completed'] = 0;
                    $coach['day2']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day2']['exercises'] = [];
                    $coach['day2']['workout'] = $csWorkout2;
                    $coach['day2']['coach_workout_rounds'] = count($csWorkout2['exercises']);
                    $coach['day2']['workout_intensity'] = 1;
                    $coach['day2']['hiit'] = [['id' => 1, 'intensity' => 4, 'is_completed' => 0], ['id' => 1, 'intensity' => 3, 'is_completed' => 0]];
                    $coach['day2']['stretching'] = $stretches;

//Day3 Exercise set
                    $coach['day3']['warmup'] = $warmUps;
                    $coach['day3']['is_completed'] = 0;
                    $coach['day3']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day3']['exercises'] = [];
//intensify sWorkout2
                    $coach['day3']['workout'] = $csWorkout3;
                    $coach['day3']['coach_workout_rounds'] = count($coach['day3']['workout']['exercises']);
                    $coach['day3']['workout_intensity'] = 1;
                    $coach['day4']['hiit'] = [];
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
                    $coach['day6']['workout'] = $sWorkout3;
                    $coach['day6']['coach_workout_rounds'] = count($coach['day6']['workout']['exercises']);
                    $coach['day6']['workout_intensity'] = 1;
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
                    $coach['day1']['workout'] = $csWorkout1;
                    $coach['day1']['coach_workout_rounds'] = count($coach['day1']['workout']['exercises']);
                    $coach['day1']['workout_intensity'] = 1;
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
                    $coach['day1']['workout'] = $csWorkout1;
                    $coach['day1']['coach_workout_rounds'] = count($coach['day1']['workout']['exercises']);
                    $coach['day1']['workout_intensity'] = 1;
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
                    $coach['day3']['workout'] = $sWorkout2;
                    $coach['day3']['coach_workout_rounds'] = count($coach['day3']['workout']['exercises']);
                    $coach['day3']['workout_intensity'] = 1;
                    $coach['day3']['hiit'] = [];
                    $coach['day3']['stretching'] = $stretches;
                } elseif ($data['days'] == 4) {
//Day1 exercise set
                    $coach['day1']['warmup'] = $warmUps;
                    $coach['day1']['is_completed'] = 0;
                    $coach['day1']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day1']['exercises'] = [];
//intensify csWorkout1
                    $coach['day1']['workout'] = $csWorkout1;
                    $coach['day1']['coach_workout_rounds'] = count($coach['day1']['workout']['exercises']);
                    $coach['day1']['workout_intensity'] = 1;
                    $coach['day1']['hiit'] = [];
                    $coach['day1']['stretching'] = $stretches;

//Day2 Exercise set
                    $coach['day2']['warmup'] = $warmUps;
                    $coach['day2']['is_completed'] = 0;
                    $coach['day2']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day2']['exercises'] = [];
                    $coach['day2']['workout'] = $csWorkout2;
                    $coach['day2']['coach_workout_rounds'] = count($csWorkout2['exercises']);
                    $coach['day2']['workout_intensity'] = 1;
                    $coach['day2']['hiit'] = [['id' => 3, 'intensity' => 3, 'is_completed' => 0]];
                    $coach['day2']['stretching'] = $stretches;

//Day3 Exercise set
                    $coach['day3']['warmup'] = $warmUps;
                    $coach['day3']['is_completed'] = 0;
                    $coach['day3']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day3']['exercises'] = [];
//intensify sWorkout2
                    $coach['day3']['workout'] = $sWorkout1;
                    $coach['day3']['coach_workout_rounds'] = count($coach['day3']['workout']['exercises']);
                    $coach['day3']['workout_intensity'] = 1;
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
                    $coach['day1']['workout'] = $csWorkout1;
                    $coach['day1']['coach_workout_rounds'] = count($coach['day1']['workout']['exercises']);
                    $coach['day1']['workout_intensity'] = 1;
                    $coach['day1']['hiit'] = [];
                    $coach['day1']['stretching'] = $stretches;

//Day2 Exercise set
                    $coach['day2']['warmup'] = $warmUps;
                    $coach['day2']['is_completed'] = 0;
                    $coach['day2']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day2']['exercises'] = [];
                    $coach['day2']['workout'] = $csWorkout2;
                    $coach['day2']['coach_workout_rounds'] = count($csWorkout2['exercises']);
                    $coach['day2']['workout_intensity'] = 1;
                    $coach['day2']['hiit'] = [['id' => 1, 'intensity' => 4, 'is_completed' => 0]];
                    $coach['day2']['stretching'] = $stretches;

//Day3 Exercise set
                    $coach['day3']['warmup'] = $warmUps;
                    $coach['day3']['is_completed'] = 0;
                    $coach['day3']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day3']['exercises'] = [];
//intensify sWorkout2
                    $coach['day3']['workout'] = $csWorkout3;
                    $coach['day3']['coach_workout_rounds'] = count($coach['day3']['workout']['exercises']);
                    $coach['day3']['workout_intensity'] = 1;
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
                    $coach['day5']['workout'] = $sWorkout2;
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
                    $coach['day1']['workout'] = $csWorkout1;
                    $coach['day1']['coach_workout_rounds'] = count($coach['day1']['workout']['exercises']);
                    $coach['day1']['workout_intensity'] = 1;
                    $coach['day1']['hiit'] = [];
                    $coach['day1']['stretching'] = $stretches;

//Day2 Exercise set
                    $coach['day2']['warmup'] = $warmUps;
                    $coach['day2']['is_completed'] = 0;
                    $coach['day2']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day2']['exercises'] = [];
                    $coach['day2']['workout'] = $csWorkout2;
                    $coach['day2']['coach_workout_rounds'] = count($csWorkout2['exercises']);
                    $coach['day2']['workout_intensity'] = 1;
                    $coach['day2']['hiit'] = [['id' => 1, 'intensity' => 4, 'is_completed' => 0], ['id' => 1, 'intensity' => 3, 'is_completed' => 0]];
                    $coach['day2']['stretching'] = $stretches;

//Day3 Exercise set
                    $coach['day3']['warmup'] = $warmUps;
                    $coach['day3']['is_completed'] = 0;
                    $coach['day3']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day3']['exercises'] = [];
//intensify sWorkout2
                    $coach['day3']['workout'] = $csWorkout3;
                    $coach['day3']['coach_workout_rounds'] = count($coach['day3']['workout']['exercises']);
                    $coach['day3']['workout_intensity'] = 1;
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
                    $coach['day6']['workout'] = $sWorkout2;
                    $coach['day6']['coach_workout_rounds'] = count($coach['day6']['workout']['exercises']);
                    $coach['day6']['workout_intensity'] = 1;
                    $coach['day6']['hiit'] = [];
                    $coach['day6']['stretching'] = $stretches;
                }
            }
        } elseif ($userLevel == 'professional') {

            $csWorkout1 = self::getWorkoutWithExercises($userWorkouts['cardio_strength'][random_int(1, 7)]->id, $focus, $intenseFactor);

            $csWorkout2 = self::getWorkoutWithExercises($userWorkouts['cardio_strength'][random_int(1, 7)]->id, $focus, $intenseFactor);

            $csWorkout3 = self::getWorkoutWithExercises($userWorkouts['cardio_strength'][random_int(1, 7)]->id, $focus, $intenseFactor);

            $csWorkout4 = self::getWorkoutWithExercises($userWorkouts['cardio_strength'][random_int(1, 7)]->id, $focus, $intenseFactor);

            $csWorkout5 = self::getWorkoutWithExercises($userWorkouts['cardio_strength'][random_int(1, 7)]->id, $focus, $intenseFactor);

            $csWorkout6 = self::getWorkoutWithExercises($userWorkouts['cardio_strength'][random_int(1, 7)]->id, $focus, $intenseFactor);

            $sWorkout1 = self::getWorkoutWithExercises($userWorkouts['strength'][random_int(1, 7)]->id, $focus, $intenseFactor);

            $sWorkout2 = self::getWorkoutWithExercises($userWorkouts['strength'][random_int(1, 7)]->id, $focus, $intenseFactor);

            $sWorkout3 = self::getWorkoutWithExercises($userWorkouts['strength'][random_int(1, 7)]->id, $focus, $intenseFactor);

            $sWorkout4 = self::getWorkoutWithExercises($userWorkouts['strength'][random_int(1, 7)]->id, $focus, $intenseFactor);

            $sWorkout5 = self::getWorkoutWithExercises($userWorkouts['strength'][random_int(1, 7)]->id, $focus, $intenseFactor);

            $sWorkout6 = self::getWorkoutWithExercises($userWorkouts['strength'][random_int(1, 7)]->id, $focus, $intenseFactor);

            if ($focus == 1) {

                if ($data['days'] == 2) {

//Day1 exercise set
                    $coach['day1']['warmup'] = $warmUps;
                    $coach['day1']['is_completed'] = 0;
                    $coach['day1']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day1']['exercises'] = [];
//intensify csWorkout1
                    $coach['day1']['workout'] = $csWorkout1;
                    $coach['day1']['coach_workout_rounds'] = count($coach['day1']['workout']['exercises']);
                    $coach['day1']['workout_intensity'] = 1;
                    $coach['day1']['hiit'] = [];
                    $coach['day1']['stretching'] = $stretches;

//Day2 Exercise set
                    $coach['day2']['warmup'] = $warmUps;
                    $coach['day2']['is_completed'] = 0;
                    $coach['day2']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day2']['exercises'] = [];
                    $coach['day2']['workout'] = $csWorkout2;
                    $coach['day2']['coach_workout_rounds'] = count($csWorkout2['exercises']);
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
                    $coach['day1']['workout'] = $csWorkout1;
                    $coach['day1']['coach_workout_rounds'] = count($coach['day1']['workout']['exercises']);
                    $coach['day1']['workout_intensity'] = 1;
                    $coach['day1']['hiit'] = [];
                    $coach['day1']['stretching'] = $stretches;

//Day2 Exercise set
                    $coach['day2']['warmup'] = $warmUps;
                    $coach['day2']['is_completed'] = 0;
                    $coach['day2']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day2']['exercises'] = [];
                    $coach['day2']['workout'] = $csWorkout2;
                    $coach['day2']['coach_workout_rounds'] = count($csWorkout2['exercises']);
                    $coach['day2']['workout_intensity'] = 1;
                    $coach['day2']['hiit'] = [['id' => 2, 'intensity' => 4, 'is_completed' => 0]];
                    $coach['day2']['stretching'] = $stretches;

//Day3 Exercise set
                    $coach['day3']['warmup'] = $warmUps;
                    $coach['day3']['is_completed'] = 0;
                    $coach['day3']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day3']['exercises'] = [];
//intensify sWorkout2
                    $coach['day3']['workout'] = $sWorkout1;
                    $coach['day3']['coach_workout_rounds'] = count($coach['day3']['workout']['exercises']);
                    $coach['day3']['workout_intensity'] = 1;
                    $coach['day3']['hiit'] = [];
                    $coach['day3']['stretching'] = $stretches;
                } elseif ($data['days'] == 4) {
//Day1 exercise set
                    $coach['day1']['warmup'] = $warmUps;
                    $coach['day1']['is_completed'] = 0;
                    $coach['day1']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day1']['exercises'] = [];
//intensify csWorkout1
                    $coach['day1']['workout'] = $csWorkout1;
                    $coach['day1']['coach_workout_rounds'] = count($coach['day1']['workout']['exercises']);
                    $coach['day1']['workout_intensity'] = 1;
                    $coach['day1']['hiit'] = [];
                    $coach['day1']['stretching'] = $stretches;

//Day2 Exercise set
                    $coach['day2']['warmup'] = $warmUps;
                    $coach['day2']['is_completed'] = 0;
                    $coach['day2']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day2']['exercises'] = [];
                    $coach['day2']['workout'] = $csWorkout2;
                    $coach['day2']['coach_workout_rounds'] = count($csWorkout2['exercises']);
                    $coach['day2']['workout_intensity'] = 1;
                    $coach['day2']['hiit'] = [['id' => 1, 'intensity' => 4, 'is_completed' => 0]];
                    $coach['day2']['stretching'] = $stretches;

//Day3 Exercise set
                    $coach['day3']['warmup'] = $warmUps;
                    $coach['day3']['is_completed'] = 0;
                    $coach['day3']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day3']['exercises'] = [];
//intensify sWorkout2
                    $coach['day3']['workout'] = $csWorkout3;
                    $coach['day3']['coach_workout_rounds'] = count($coach['day3']['workout']['exercises']);
                    $coach['day3']['workout_intensity'] = 1;
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
                    $coach['day1']['workout'] = $csWorkout1;
                    $coach['day1']['coach_workout_rounds'] = count($coach['day1']['workout']['exercises']);
                    $coach['day1']['workout_intensity'] = 1;
                    $coach['day1']['hiit'] = [];
                    $coach['day1']['stretching'] = $stretches;

//Day2 Exercise set
                    $coach['day2']['warmup'] = $warmUps;
                    $coach['day2']['is_completed'] = 0;
                    $coach['day2']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day2']['exercises'] = [];
                    $coach['day2']['workout'] = $csWorkout2;
                    $coach['day2']['coach_workout_rounds'] = count($csWorkout2['exercises']);
                    $coach['day2']['workout_intensity'] = 1;
                    $coach['day2']['hiit'] = [['id' => 3, 'intensity' => 3, 'is_completed' => 0]];
                    $coach['day2']['stretching'] = $stretches;

//Day3 Exercise set
                    $coach['day3']['warmup'] = $warmUps;
                    $coach['day3']['is_completed'] = 0;
                    $coach['day3']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day3']['exercises'] = [];
//intensify sWorkout2
                    $coach['day3']['workout'] = $csWorkout3;
                    $coach['day3']['coach_workout_rounds'] = count($coach['day3']['workout']['exercises']);
                    $coach['day3']['workout_intensity'] = 1;
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
                    $coach['day5']['workout'] = $sWorkout2;
                    $coach['day5']['coach_workout_rounds'] = count($coach['day5']['workout']['exercises']);
                    $coach['day5']['workout_intensity'] = 1;
                    $coach['day5']['hiit'] = [['id' => 1, 'intensity' => 4, 'is_completed' => 0]];
                    $coach['day5']['stretching'] = $stretches;
                } elseif ($data['days'] == 6) {

//Day1 exercise set
                    $coach['day1']['warmup'] = $warmUps;
                    $coach['day1']['is_completed'] = 0;
                    $coach['day1']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day1']['exercises'] = [];
//intensify csWorkout1
                    $coach['day1']['workout'] = $csWorkout1;
                    $coach['day1']['coach_workout_rounds'] = count($coach['day1']['workout']['exercises']);
                    $coach['day1']['workout_intensity'] = 1;
                    $coach['day1']['hiit'] = [];
                    $coach['day1']['stretching'] = $stretches;

//Day2 Exercise set
                    $coach['day2']['warmup'] = $warmUps;
                    $coach['day2']['is_completed'] = 0;
                    $coach['day2']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day2']['exercises'] = [];
                    $coach['day2']['workout'] = $csWorkout2;
                    $coach['day2']['coach_workout_rounds'] = count($csWorkout2['exercises']);
                    $coach['day2']['workout_intensity'] = 1;
                    $coach['day2']['hiit'] = [['id' => 1, 'intensity' => 4, 'is_completed' => 0], ['id' => 1, 'intensity' => 3, 'is_completed' => 0]];
                    $coach['day2']['stretching'] = $stretches;

//Day3 Exercise set
                    $coach['day3']['warmup'] = $warmUps;
                    $coach['day3']['is_completed'] = 0;
                    $coach['day3']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day3']['exercises'] = [];
//intensify sWorkout2
                    $coach['day3']['workout'] = $csWorkout3;
                    $coach['day3']['coach_workout_rounds'] = count($coach['day3']['workout']['exercises']);
                    $coach['day3']['workout_intensity'] = 1;
                    $coach['day3']['hiit'] = [];
                    $coach['day3']['stretching'] = $stretches;

//Day4 Exercise set
                    $coach['day4']['warmup'] = $warmUps;
                    $coach['day4']['is_completed'] = 0;
                    $coach['day4']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day4']['exercises'] = [];
//intensify sWorkout2
                    $coach['day4']['workout'] = $csWorkout4;
                    $coach['day4']['coach_workout_rounds'] = count($coach['day4']['workout']['exercises']);
                    $coach['day4']['workout_intensity'] = 1;
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
                    $coach['day6']['workout'] = $sWorkout1;
                    $coach['day6']['coach_workout_rounds'] = count($coach['day6']['workout']['exercises']);
                    $coach['day6']['workout_intensity'] = 1;
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
                    $coach['day1']['workout'] = $csWorkout1;
                    $coach['day1']['coach_workout_rounds'] = count($coach['day1']['workout']['exercises']);
                    $coach['day1']['workout_intensity'] = 1;
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
                    $coach['day1']['workout'] = $csWorkout1;
                    $coach['day1']['coach_workout_rounds'] = count($coach['day1']['workout']['exercises']);
                    $coach['day1']['workout_intensity'] = 1;
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
                    $coach['day3']['workout'] = $sWorkout2;
                    $coach['day3']['coach_workout_rounds'] = count($coach['day3']['workout']['exercises']);
                    $coach['day3']['workout_intensity'] = 1;
                    $coach['day3']['hiit'] = [];
                    $coach['day3']['stretching'] = $stretches;
                } elseif ($data['days'] == 4) {
//Day1 exercise set
                    $coach['day1']['warmup'] = $warmUps;
                    $coach['day1']['is_completed'] = 0;
                    $coach['day1']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day1']['exercises'] = [];
//intensify csWorkout1
                    $coach['day1']['workout'] = $csWorkout1;
                    $coach['day1']['coach_workout_rounds'] = count($coach['day1']['workout']['exercises']);
                    $coach['day1']['workout_intensity'] = 1;
                    $coach['day1']['hiit'] = [];
                    $coach['day1']['stretching'] = $stretches;

//Day2 Exercise set
                    $coach['day2']['warmup'] = $warmUps;
                    $coach['day2']['is_completed'] = 0;
                    $coach['day2']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day2']['exercises'] = [];
                    $coach['day2']['workout'] = $csWorkout2;
                    $coach['day2']['coach_workout_rounds'] = count($csWorkout2['exercises']);
                    $coach['day2']['workout_intensity'] = 1;
                    $coach['day2']['hiit'] = [['id' => 1, 'intensity' => 4, 'is_completed' => 0]];
                    $coach['day2']['stretching'] = $stretches;

//Day3 Exercise set
                    $coach['day3']['warmup'] = $warmUps;
                    $coach['day3']['is_completed'] = 0;
                    $coach['day3']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day3']['exercises'] = [];
//intensify sWorkout2
                    $coach['day3']['workout'] = $sWorkout1;
                    $coach['day3']['coach_workout_rounds'] = count($coach['day3']['workout']['exercises']);
                    $coach['day3']['workout_intensity'] = 1;
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
                    $coach['day1']['workout'] = $csWorkout1;
                    $coach['day1']['coach_workout_rounds'] = count($coach['day1']['workout']['exercises']);
                    $coach['day1']['workout_intensity'] = 1;
                    $coach['day1']['hiit'] = [];
                    $coach['day1']['stretching'] = $stretches;

//Day2 Exercise set
                    $coach['day2']['warmup'] = $warmUps;
                    $coach['day2']['is_completed'] = 0;
                    $coach['day2']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day2']['exercises'] = [];
                    $coach['day2']['workout'] = $csWorkout2;
                    $coach['day2']['coach_workout_rounds'] = count($csWorkout2['exercises']);
                    $coach['day2']['workout_intensity'] = 1;
                    $coach['day2']['hiit'] = [['id' => 3, 'intensity' => 3, 'is_completed' => 0]];
                    $coach['day2']['stretching'] = $stretches;

//Day3 Exercise set
                    $coach['day3']['warmup'] = $warmUps;
                    $coach['day3']['is_completed'] = 0;
                    $coach['day3']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day3']['exercises'] = [];
//intensify sWorkout2
                    $coach['day3']['workout'] = $csWorkout3;
                    $coach['day3']['coach_workout_rounds'] = count($coach['day3']['workout']['exercises']);
                    $coach['day3']['workout_intensity'] = 1;
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
                    $coach['day5']['workout'] = $sWorkout2;
                    $coach['day5']['coach_workout_rounds'] = count($coach['day5']['workout']['exercises']);
                    $coach['day5']['workout_intensity'] = 1;
                    $coach['day5']['hiit'] = [['id' => 1, 'intensity' => 4, 'is_completed' => 0]];
                    $coach['day5']['stretching'] = $stretches;
                } elseif ($data['days'] == 6) {

//Day1 exercise set
                    $coach['day1']['warmup'] = $warmUps;
                    $coach['day1']['is_completed'] = 0;
                    $coach['day1']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day1']['exercises'] = [];
//intensify csWorkout1
                    $coach['day1']['workout'] = $csWorkout1;
                    $coach['day1']['coach_workout_rounds'] = count($coach['day1']['workout']['exercises']);
                    $coach['day1']['workout_intensity'] = 1;
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
                    $coach['day3']['workout'] = $csWorkout3;
                    $coach['day3']['coach_workout_rounds'] = count($coach['day3']['workout']['exercises']);
                    $coach['day3']['workout_intensity'] = 1;
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
                    $coach['day6']['workout'] = $sWorkout2;
                    $coach['day6']['coach_workout_rounds'] = count($coach['day6']['workout']['exercises']);
                    $coach['day6']['workout_intensity'] = 1;
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
                    $coach['day1']['workout'] = $sWorkout1;
                    $coach['day1']['coach_workout_rounds'] = count($coach['day1']['workout']['exercises']);
                    $coach['day1']['workout_intensity'] = 1;
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
                    $coach['day1']['workout'] = $sWorkout1;
                    $coach['day1']['coach_workout_rounds'] = count($coach['day1']['workout']['exercises']);
                    $coach['day1']['workout_intensity'] = 1;
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
                    $coach['day3']['workout'] = $sWorkout3;
                    $coach['day3']['coach_workout_rounds'] = count($coach['day3']['workout']['exercises']);
                    $coach['day3']['workout_intensity'] = 1;
                    $coach['day3']['hiit'] = [];
                    $coach['day3']['stretching'] = $stretches;
                } elseif ($data['days'] == 4) {
//Day1 exercise set
                    $coach['day1']['warmup'] = $warmUps;
                    $coach['day1']['is_completed'] = 0;
                    $coach['day1']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day1']['exercises'] = [];
//intensify csWorkout1
                    $coach['day1']['workout'] = $sWorkout1;
                    $coach['day1']['coach_workout_rounds'] = count($coach['day1']['workout']['exercises']);
                    $coach['day1']['workout_intensity'] = 1;
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
                    $coach['day3']['workout'] = $sWorkout3;
                    $coach['day3']['coach_workout_rounds'] = count($coach['day3']['workout']['exercises']);
                    $coach['day3']['workout_intensity'] = 1;
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
                    $coach['day1']['workout'] = $csWorkout1;
                    $coach['day1']['coach_workout_rounds'] = count($coach['day1']['workout']['exercises']);
                    $coach['day1']['workout_intensity'] = 1;
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
                    $coach['day3']['workout'] = $sWorkout2;
                    $coach['day3']['coach_workout_rounds'] = count($coach['day3']['workout']['exercises']);
                    $coach['day3']['workout_intensity'] = 1;
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
                    $coach['day5']['workout'] = $sWorkout4;
                    $coach['day5']['coach_workout_rounds'] = count($coach['day5']['workout']['exercises']);
                    $coach['day5']['workout_intensity'] = 1;
                    $coach['day5']['hiit'] = [['id' => 1, 'intensity' => 4, 'is_completed' => 0]];
                    $coach['day5']['stretching'] = $stretches;
                } elseif ($data['days'] == 6) {

//Day1 exercise set
                    $coach['day1']['warmup'] = $warmUps;
                    $coach['day1']['is_completed'] = 0;
                    $coach['day1']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day1']['exercises'] = [];
//intensify csWorkout1
                    $coach['day1']['workout'] = $csWorkout1;
                    $coach['day1']['coach_workout_rounds'] = count($coach['day1']['workout']['exercises']);
                    $coach['day1']['workout_intensity'] = 1;
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
                    $coach['day3']['workout'] = $sWorkout2;
                    $coach['day3']['coach_workout_rounds'] = count($coach['day3']['workout']['exercises']);
                    $coach['day3']['workout_intensity'] = 1;
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
                    $coach['day6']['workout'] = $sWorkout5;
                    $coach['day6']['coach_workout_rounds'] = count($coach['day6']['workout']['exercises']);
                    $coach['day6']['workout_intensity'] = 1;
                    $coach['day6']['hiit'] = [];
                    $coach['day6']['stretching'] = $stretches;
                }
            }
        }

        return $coach;
    }

    public static function getWorkoutWithExercises($workoutId, $category, $intenseFactor)
    {
        $workout = Workout::where('id', '=', $workoutId)->first();

        $workoutIntensity = self::$workoutIntensityArray[1][$workout->id];

        $rounds = $workoutIntensity[$intenseFactor];
        $workout->is_completed = 0;

        if ($rounds == 0 && $intenseFactor < 3) {
            $rounds = $workoutIntensity[$intenseFactor] + 1;
        }
        $count = 1;
        $exercises = [];
        do {
            $roundExercises = Workoutexercise::where('round', '=', $count)
                ->where('category', '=', $category)
                ->where('workout_id', '=', $workoutId)
                ->with(['video', 'exercise'])
                ->get();

            foreach ($roundExercises as $roundExercise) {
                $roundExercise->is_completed = 0;
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

    public static function intensifyWorkoutPercentage($roundExercises, $increasePercent)
    {
        $roundExercises = array_map(function($roundExercise) use ($increasePercent) {
            foreach ($roundExercise as $rKey => $exercise) {
                $roundExercise[$rKey]['repititions'] = round($exercise['repititions'] + ($exercise['repititions'] * $increasePercent / 100));
            }
            return $roundExercise;
        }, $roundExercises);

        return $roundExercises;
    }

    public static function updateCoach($assessment, $coachId, $focus, $days)
    {
        $coach = DB::table('coaches')->where('id', $coachId)->first();

        $exercises = self::updateCoachExercises($coach, $assessment, $focus, $days);


        return $exercises;
    }

    public static function updateCoachExercises($coach, $assessment, $focus, $days)
    {

        $coachStatus = DB::table('coach_status')->where('coach_id', $coach->id)->first();


        if ($focus == $coach->focus && $days == $coach->days && $coachStatus->week == 2) {

            if ($assessment == 3) {
                return json_decode($coach->exercises, TRUE);
            }

            //Just Increse the workout exercise amount by percentage
            $exercises = self::increaseWorkoutBypercentage(json_decode($coach->exercises, TRUE), $assessment);

            return $exercises;
        } else {
            //User Focus or workout days changed or transition week
            if ($focus == $coach->focus && $days == $coach->days && $coachStatus->week > 2) {
                //Add new Exercises to the existing workouts

                $exercises = self::addExerciseToWorkout($coach, json_decode($coach->exercises, TRUE), $assessment, $coachStatus->week + 1);

                return $exercises;
            } elseif ($focus != $coach->focus || $days != $coach->days) {
                //Restructure coach and get new exercises and add exercises to existing workouts according to user feedback

                $i = 1;

                do {

                    $fundumental = Fundumental::where('row', $i)->with(['exercise'])->get();

                    $fundumentalArray[$i] = $fundumental->toArray();

                    $i++;
                    unset($fundumental);
                } while ($i <= 5);

                $warmUps = DB::table('warmups')->select('*')->get();

                if ($coach->category == 'beginer') {
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

                if ($coach->category == 'beginer' && $assessment == 3) {
                    $userLevel = 'beginer';
                } else {
                    if ($coach->category == 'beginer' && $assessment == 2 || $coach->category == 'advanced' && $assessment == 2) {
                        $userLevel = 'advanced';
                    } else {
                        $stretchesArray = array_map(function($stretch) {
                            $stretch['duration']['min'] = round($stretch['duration']['min'] + ($stretch['duration']['min'] * (25 / 100)));
                            $stretch['duration']['max'] = round($stretch['duration']['max'] + ($stretch['duration']['max'] * (25 / 100)));
                            return $stretch;
                        }, $stretchesArray);

                        $userLevel = 'professional';
                    }
                }

                if ($userLevel == 'professional') {
                    $intenseFactor = 2;
                    $data['test1'] = 1;
                    $data['test2'] = 1;
                } elseif ($userLevel == 'advanced') {
                    $intenseFactor = 1;
                    $data['test1'] = 1;
                    $data['test2'] = 0;
                } elseif ($userLevel == 'beginer') {
                    $intenseFactor = 0;
                    $data['test1'] = 0;
                    $data['test2'] = 0;
                }

                $data['user_id'] = $coach->user_id;
                $data['focus'] = $focus;
                $data['category'] = $coach->category;
                $data['muscle_groups'] = $coach->muscle_groups;
                $data['days'] = $days;


                $userWorkouts['strength'] = DB::select(self::getUserMatchedWorkoutsQuery(1, $coach->focus, $coach->user_id, $data, $intenseFactor, $fundumentalArray));

                $userWorkouts['cardio_strength'] = DB::select(self::getUserMatchedWorkoutsQuery(2, $coach->focus, $coach->user_id, $data, $intenseFactor, $fundumentalArray));

                $exercises = self::getCoachForFocus($warmUps, $fundumentalArray, $stretchesArray, $data, $userWorkouts, $coach->focus, $userLevel);
                if ($coachStatus->week == 2) {
                    if ($assessment == 3) {
                        return $exercises;
                    }

                    //Just Increse the workout exercise amount by percentage
                    $exercises = self::increaseWorkoutBypercentage(json_decode($coach->exercises, TRUE), $assessment);

                    return $exercises;
                } else {
                    $exercises = self::addExerciseToWorkout($coach, $exercises, $assessment, $coachStatus->week + 1);

                    return $exercises;
                }

                return $exercises;
            }
        }
    }

    public static function increaseWorkoutBypercentage($exercises, $assessment)
    {
        if ($assessment == 1) {
            $increasePercent = 33;
        } else {
            $increasePercent = 10;
        }

        $exercises = array_map(function($dayExercise) use($increasePercent) {
            if (isset($dayExercise['exercises']) && count($dayExercise['exercises']) > 0) {
                foreach ($dayExercise['exercises'] as $fKey => $exercise) {
                    if (!empty($exercise)) {
                        if ($exercise['unit'] == 'times') {
                            $duration = round($exercise['duration'] + ($exercise['duration'] * $increasePercent / 100));
                            if ($duration < 25) {
                                $dayExercise['exercises'][$fKey]['duration'] = 25;
                            } elseif ($duration >= 25 && $duration < 50) {
                                $dayExercise['exercises'][$fKey]['duration'] = 50;
                            } elseif ($duration >= 50 && $duration < 100) {
                                $dayExercise['exercises'][$fKey]['duration'] = 100;
                            } elseif ($duration >= 250 && $duration < 500) {
                                $dayExercise['exercises'][$fKey]['duration'] = 500;
                            } elseif ($duration >= 500 && $duration < 750) {
                                $dayExercise['exercises'][$fKey]['duration'] = 750;
                            } elseif ($duration >= 750 && $duration <= 1000) {
                                $dayExercise['exercises'][$fKey]['duration'] = 1000;
                            }
                        } else {
                            $dayExercise['exercises'][$fKey]['duration'] = round($exercise['duration'] + ($exercise['duration'] * 5 / 100));
                        }
                        $dayExercise['exercises'][$fKey]['is_completed'] = 0;
                    }
                }
            }

            if (isset($dayExercise['workout']) && count($dayExercise['workout'] > 0)) {
                if (!empty($dayExercise['workout'])) {
                    $dayExercise['workout']['exercises'] = self::intensifyWorkoutPercentage($dayExercise['workout']['exercises'], $increasePercent);

                    $dayExercise['workout']['is_completed'] = 0;

                    $workoutExerciseRoundCount = count($dayExercise['workout']['exercises']);

                    $dayExercise['coach_workout_rounds'] = $workoutExerciseRoundCount;

                    $dayExercise['workout_intensity'] = ceil($workoutExerciseRoundCount / $dayExercise['workout']['rounds']);
                }
            }
            return $dayExercise;
        }, $exercises);

        return $exercises;
    }

    public static function getUserMatchedWorkoutsQuery($category, $focus, $userId, $data, $userLevel, $fundumentalArray)
    {
        $whereQuery = '';

        $whereTestQuery = '';
        $testArray = [];
        $testString = '';

        if ($data['test1'] == 1 && $data['test1'] == 0) {
            $fundumentalArray = $fundumentalArray[1];

            foreach ($fundumentalArray as $fKey => $fundumental) {
                if ($fundumental != 0) {
                    $testArray[] = $fKey;
                }
            }
            $testString = implode(',', $testArray);
            $whereTestQuery .= ' AND exercise_id IN(' . $testString . ')';
        } elseif ($data['test1'] == 1 && $data['test1'] == 1) {

            $fundumentalArray = array_merge($fundumentalArray[1], $fundumentalArray[2]);
            foreach ($fundumentalArray as $fKey => $fundumental) {
                if ($fundumental != 0) {
                    $testArray[] = $fKey;
                }
            }
            $testString = implode(',', $testArray);
            $whereTestQuery .= ' AND exercise_id IN(' . $testString . ')';
        }

        $userUnlockedSkillExerciseQuery = DB::table('unlocked_skills')
            ->select('exercise_id')
            ->whereRaw('user_id = ' . $userId . $whereTestQuery)
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
                    $whereQuery .= ' OR exercise_id IN(' . $userOptedMuscleExercisesQuery . ')';
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

                $whereQuery .= ' OR exercise_id IN(' . $userOptedGoalExercisesQuery . ')';
            }
        }

        $whereQuery .= ')';

        $selWorkouts = [];

        foreach (self::$workoutIntensityArray[1] as $wKey => $wValue) {
            if ($wValue[$userLevel] > 0) {
                $selWorkouts[] = $wKey;
            }
        }

        $selectedWorkouts = '';

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
                WHERE   t1.category = ' . $category . ' AND t1.id NOT IN("4,7,17")' . $selectedWorkouts . '
                ORDER   BY exercise_count DESC';
    }

    public static function addExerciseToWorkout($coach, $exercises, $assessment, $week)
    {
        if ($assessment == 1) {
            $increasePercent = 33;
        } else {
            $increasePercent = 10;
        }

        $exercises = array_map(function($dayExercise) use($increasePercent, $coach, $assessment, $week) {

            if (isset($dayExercise['exercises']) && count($dayExercise['exercises']) > 0) {
                foreach ($dayExercise['exercises'] as $fKey => $exercise) {
                    if (!empty($exercise)) {
                        if ($exercise['unit'] == 'times') {
                            $duration = round($exercise['duration'] + ($exercise['duration'] * $increasePercent / 100));
                            if ($duration < 25) {
                                $dayExercise['exercises'][$fKey]['duration'] = 25;
                            } elseif ($duration >= 25 && $duration < 50) {
                                $dayExercise['exercises'][$fKey]['duration'] = 50;
                            } elseif ($duration >= 50 && $duration < 100) {
                                $dayExercise['exercises'][$fKey]['duration'] = 100;
                            } elseif ($duration >= 250 && $duration < 500) {
                                $dayExercise['exercises'][$fKey]['duration'] = 500;
                            } elseif ($duration >= 500 && $duration < 750) {
                                $dayExercise['exercises'][$fKey]['duration'] = 750;
                            } elseif ($duration >= 750 && $duration <= 1000) {
                                $dayExercise['exercises'][$fKey]['duration'] = 1000;
                            }
                        } else {
                            $dayExercise['exercises'][$fKey]['duration'] = round($exercise['duration'] + ($exercise['duration'] * 5 / 100));
                        }
                        $dayExercise['exercises'][$fKey]['is_completed'] = 0;
                    }
                }
            }

            if (isset($dayExercise['workout']) && count($dayExercise['workout'] > 0)) {
                if (!empty($dayExercise['workout'])) {

                    $dayExercise['workout']['exercises'] = self::addRoundsOrExerciseToWorkout($dayExercise['workout']['exercises'], $coach, $assessment, $week, $dayExercise['workout']['id']);

                    $workoutExerciseRoundCount = count($dayExercise['workout']['exercises']);

                    $dayExercise['coach_workout_rounds'] = $workoutExerciseRoundCount;

                    $dayExercise['workout_intensity'] = ceil($workoutExerciseRoundCount / $dayExercise['workout']['rounds']);
                }
            }
            return $dayExercise;
        }, $exercises);

        if ($week > 15) {
            $exercises = self::checkForHigherLimits($exercises, ['focus' => $coach->focus]);
        }

        return $exercises;
    }

    public static function addRoundsOrExerciseToWorkout($roundExercises, $coach, $assessment, $week, $workoutId)
    {
        if ($week < 7) {
            if ($assessment == 3) {
                $slab = 1;
            } elseif ($assessment == 2) {
                $slab = 1;
            } elseif ($assessment == 1) {
                $slab = 2;
            }

            $intensityArray = self::$workoutIntensityArray[1];

            if ($intensityArray[$workoutId][$slab] > 0) {
                for ($i = 1; $i <= $intensityArray[$workoutId][$slab]; $i++) {
                    $newRoundExercises = Workoutexercise::where('round', '=', $i)
                        ->where('category', '=', $coach->focus)
                        ->where('workout_id', '=', $workoutId)
                        ->with(['video', 'exercise'])
                        ->get();

                    foreach ($newRoundExercises as $roundExercise) {
                        $roundExercise->is_completed = 0;
                        $doneExercisesArray[] = $roundExercise->exercise_id;
                    }

                    $doneExercises = implode(',', $doneExercisesArray);

                    $notInQuery = ' AND exercises.id NOT IN("' . $doneExercises . '")';

                    if ($coach->goal_option > 0) {
                        $userRaidRow = DB::table('skills')->where('id', $coach->goal_option)->first();
                        $notInQuery.=' AND skills.progression_id = ' . $userRaidRow->progression_id . ' AND skills.row = ' . $userRaidRow->row;
                    }

                    $basicSkillsQuery = DB::table('skills')
                        ->select('skills.exercise_id')
                        ->leftJoin('exercises', 'exercises.id', '=', 'skills.exercise_id')
                        ->orderBy('skills.id');

                    $likeQueryArray[] = 'exercises.muscle_groups =""';

                    $likeQuery = ' AND (';

                    if ($coach->muscle_groups != '') {
                        $muscleGroupArray = explode(',', $coach->muscle_groups);
                        foreach ($muscleGroupArray as $mgKey => $muscleGroupId) {
                            if ($muscleGroupId != '') {
                                $likeQueryArray[] = 'exercises.muscle_groups LIKE "%' . $muscleGroupId . '%"';
                            }
                        }
                    }

                    $likeQuery .= implode(' OR ', $likeQueryArray) . ')';

                    $basicSkillsQuery->whereRaw('exercises.category = ' . $coach->focus . $likeQuery . $notInQuery);

                    $basicSkill = $basicSkillsQuery->first();

                    $newRoundExercisesArray = $newRoundExercises->toArray();

                    if (!is_null($basicSkill)) {
                        $exercise = Exercise::where('id', $basicSkill->exercise_id)->with(['video'])->first();
                        $newRoundExercise = [
                            'workout_id' => $workoutId,
                            'exercise' => $exercise->toArray(),
                            'category' => $coach->focus,
                            'repititions' => $exercise->repititions,
                            'exercise_id' => $exercise->id,
                            'unit' => $exercise->unit,
                            'round' => $i,
                            'is_completed' => 0
                        ];
                        $newRoundExercisesArray[] = $newRoundExercise;
                        $doneExercisesArray[] = $basicSkill->exercise_id;
                    }

                    $roundExercises['round' . $i] = $newRoundExercisesArray;
                }
            }

            return $roundExercises;
        } elseif ($week == 7) {
            if ($assessment == 3) {
                $slab = 1;
            } elseif ($assessment == 2) {
                $slab = 1;
            } elseif ($assessment == 1) {
                $slab = 2;
            }


            $intensityArray = self::$workoutIntensityArray[2];
            //Find the next round of the same workout and add to round exercises
            if ($intensityArray[$workoutId][$slab] > 0) {
                for ($i = 1; $i <= $intensityArray[$workoutId][$slab]; $i++) {
                    $newRoundExercises = Workoutexercise::where('round', '=', $i)
                        ->where('category', '=', $coach->focus)
                        ->where('workout_id', '=', $workoutId)
                        ->with(['video', 'exercise'])
                        ->get();

                    foreach ($newRoundExercises as $roundExercise) {
                        $roundExercise->is_completed = 0;
                        $doneExercisesArray[] = $roundExercise->exercise_id;
                    }

                    $doneExercises = implode(',', $doneExercisesArray);

                    $notInQuery = ' AND exercises.id NOT IN("' . $doneExercises . '")';

                    if ($coach->goal_option > 0) {
                        $userRaidRow = DB::table('skills')->where('id', $coach->goal_option)->first();
                        $notInQuery.=' AND skills.progression_id = ' . $userRaidRow->progression_id . ' AND skills.row = ' . $userRaidRow->row;
                    }

                    $basicSkillsQuery = DB::table('skills')
                        ->select('skills.exercise_id')
                        ->leftJoin('exercises', 'exercises.id', '=', 'skills.exercise_id')
                        ->orderBy('skills.id');

                    $likeQueryArray[] = 'exercises.muscle_groups =""';

                    $likeQuery = ' AND (';

                    if ($coach->muscle_groups != '') {
                        $muscleGroupArray = explode(',', $coach->muscle_groups);
                        foreach ($muscleGroupArray as $mgKey => $muscleGroupId) {
                            if ($muscleGroupId != '') {
                                $likeQueryArray[] = 'exercises.muscle_groups LIKE "%' . $muscleGroupId . '%"';
                            }
                        }
                    }

                    $likeQuery .= implode(' OR ', $likeQueryArray) . ')';

                    $basicSkillsQuery->whereRaw('exercises.category = ' . $coach->focus . $likeQuery . $notInQuery);

                    $basicSkill = $basicSkillsQuery->first();

                    $newRoundExercisesArray = $newRoundExercises->toArray();

                    if (!is_null($basicSkill)) {
                        $exercise = Exercise::where('id', $basicSkill->exercise_id)->with(['video'])->first();
                        $newRoundExercise = [
                            'workout_id' => $workoutId,
                            'exercise' => $exercise->toArray(),
                            'category' => $coach->focus,
                            'repititions' => $exercise->repititions,
                            'exercise_id' => $exercise->id,
                            'unit' => $exercise->unit,
                            'round' => $i,
                            'is_completed' => 0
                        ];
                        $newRoundExercisesArray[] = $newRoundExercise;
                        $doneExercisesArray[] = $basicSkill->exercise_id;
                    }

                    $roundExercises['round' . $i] = $newRoundExercisesArray;
                }
            }

            return $roundExercises;
        } elseif ($week >= 8 && $week < 15) {
            if ($assessment == 3 && $coach->category == 'beginer') {
                $slab = 0;
            } elseif ($assessment == 2 && $coach->category == 'beginer') {
                $slab = 1;
            } elseif (($assessment == 1 && $coach->category == 'beginer')) {
                $slab = 2;
            } elseif ($assessment == 2) {
                $slab = 3;
            } elseif ($assessment == 1) {
                $slab = 4;
            }
            $intensityArray = self::$workoutIntensityArray[3];
            if ($slab < 2) {
                //Add rounds as per slab and add exercise to all rounds according to the user options
                if ($intensityArray[$workoutId][$slab] != 0 && $workoutId != 18) {
                    for ($i = 1; $i <= $intensityArray[$workoutId][$slab]; $i++) {
                        $newRoundExercises = Workoutexercise::where('round', '=', $i)
                            ->where('category', '=', $coach->focus)
                            ->where('workout_id', '=', $workoutId)
                            ->with(['video', 'exercise'])
                            ->get();

                        foreach ($newRoundExercises as $roundExercise) {
                            $roundExercise->is_completed = 0;
                            $doneExercisesArray[] = $roundExercise->exercise_id;
                        }

                        $doneExercises = implode(',', $doneExercisesArray);

                        $notInQuery = ' AND exercises.id NOT IN("' . $doneExercises . '")';

                        if ($coach->goal_option > 0) {
                            $userRaidRow = DB::table('skills')->where('id', $coach->goal_option)->first();
                            $notInQuery.=' AND skills.progression_id = ' . $userRaidRow->progression_id . ' AND skills.row = ' . $userRaidRow->row;
                        }

                        $basicSkillsQuery = DB::table('skills')
                            ->select('skills.exercise_id')
                            ->leftJoin('exercises', 'exercises.id', '=', 'skills.exercise_id')
                            ->orderBy('skills.id');

                        $likeQueryArray[] = 'exercises.muscle_groups =""';

                        $likeQuery = ' AND (';

                        if ($coach->muscle_groups != '') {
                            $muscleGroupArray = explode(',', $coach->muscle_groups);
                            foreach ($muscleGroupArray as $mgKey => $muscleGroupId) {
                                if ($muscleGroupId != '') {
                                    $likeQueryArray[] = 'exercises.muscle_groups LIKE "%' . $muscleGroupId . '%"';
                                }
                            }
                        }

                        $likeQuery .= implode(' OR ', $likeQueryArray) . ')';

                        $basicSkillsQuery->whereRaw('exercises.category = ' . $coach->focus . $likeQuery . $notInQuery);

                        $basicSkill = $basicSkillsQuery->first();

                        $newRoundExercisesArray = $newRoundExercises->toArray();

                        if (!is_null($basicSkill)) {
                            $exercise = Exercise::where('id', $basicSkill->exercise_id)->with(['video'])->first();
                            $newRoundExercise = [
                                'workout_id' => $workoutId,
                                'exercise' => $exercise->toArray(),
                                'category' => $coach->focus,
                                'repititions' => $exercise->repititions,
                                'exercise_id' => $exercise->id,
                                'unit' => $exercise->unit,
                                'round' => $i,
                                'is_completed' => 0
                            ];
                            $newRoundExercisesArray[] = $newRoundExercise;
                            $doneExercisesArray[] = $basicSkill->exercise_id;
                        }

                        $roundExercises['round' . $i] = $newRoundExercisesArray;
                    }
                } elseif ($intensityArray[$workoutId][$slab] != 0 && $workoutId == 18) {

                    $roundCount = $intensityArray[$workoutId][$slab];
                    $actualRoundCount = DB::table('workouts')->where('id', $workoutId)->pluck('rounds');
                    if ($roundCount >= $actualRoundCount) {
                        $newRoundExercises = Workoutexercise::where('round', '=', ($roundCount % $actualRoundCount) + 1)
                            ->where('category', '=', $coach->focus)
                            ->where('workout_id', '=', $workoutId)
                            ->with(['video', 'exercise'])
                            ->get();

                        foreach ($newRoundExercises as $roundExercise) {
                            $roundExercise->is_completed = 0;
                        }
                    }

                    $roundExercises['round' . $intensityArray[$workoutId][$slab]] = $newRoundExercises->toArray();
                }
            } else {
                if ($intensityArray[$workoutId][$slab] != 0 && $workoutId != 18) {
                    for ($i = 1; $i <= $intensityArray[$workoutId][$slab]; $i++) {
                        $newRoundExercises = Workoutexercise::where('round', '=', $i)
                            ->where('category', '=', $coach->focus)
                            ->where('workout_id', '=', $workoutId)
                            ->with(['video', 'exercise'])
                            ->get();

                        foreach ($newRoundExercises as $roundExercise) {
                            $roundExercise->is_completed = 0;
                        }
                        $roundExercises['round' . $i] = $newRoundExercises->toArray();
                    }
                } elseif ($intensityArray[$workoutId][$slab] != 0 && $workoutId == 18) {

                    $roundCount = $intensityArray[$workoutId][$slab];
                    $actualRoundCount = DB::table('workouts')->where('id', $workoutId)->pluck('rounds');
                    if ($roundCount > $actualRoundCount) {
                        $newRoundExercises = Workoutexercise::where('round', '=', ($roundCount % $actualRoundCount) + 1)
                            ->where('category', '=', $coach->focus)
                            ->where('workout_id', '=', $workoutId)
                            ->with(['video', 'exercise'])
                            ->get();

                        foreach ($newRoundExercises as $roundExercise) {
                            $roundExercise->is_completed = 0;
                        }
                    }

                    $roundExercises['round' . $intensityArray[$workoutId][$slab]] = $newRoundExercises->toArray();
                }
            }
            return $roundExercises;
        } elseif ($week == 15) {
            $slab = 0;
            $intensityArray = self::$workoutIntensityArray[4];
            if ($workoutId != 18) {
                for ($i = 1; $i <= $intensityArray[$workoutId][$slab]; $i++) {
                    $newRoundExercises = Workoutexercise::where('round', '=', $i)
                        ->where('category', '=', $coach->focus)
                        ->where('workout_id', '=', $workoutId)
                        ->with(['video', 'exercise'])
                        ->get();

                    foreach ($newRoundExercises as $roundExercise) {
                        $roundExercise->is_completed = 0;
                    }

                    $roundExercises['round' . $i] = $newRoundExercises->toArray();
                }
            } else {
                $roundCount = $intensityArray[$workoutId][$slab];
                $actualRoundCount = DB::table('workouts')->where('id', $workoutId)->pluck('rounds');
                if ($roundCount > $actualRoundCount) {
                    $newRoundExercises = Workoutexercise::where('round', '=', ($roundCount % $actualRoundCount) + 1)
                        ->where('category', '=', $coach->focus)
                        ->where('workout_id', '=', $workoutId)
                        ->with(['video', 'exercise'])
                        ->get();

                    foreach ($newRoundExercises as $roundExercise) {
                        $roundExercise->is_completed = 0;
                    }
                }

                $roundExercises['round' . $intensityArray[$workoutId][$slab]] = $newRoundExercises->toArray();
            }
            return $roundExercises;
        } elseif ($week > 15) {
            if ($assessment == 3 && $coach->category == 'beginer') {
                $slab = 0;
            } elseif ($assessment == 2 && $coach->category == 'beginer') {
                $slab = 1;
            } elseif (($assessment == 1 && $coach->category == 'beginer')) {
                $slab = 2;
            } elseif ($assessment == 1) {
                $slab = 3;
            } elseif ($assessment == 1) {
                $slab = 4;
            }
            $intensityArray = self::$workoutIntensityArray[5];

            if ($slab < 2) {
                //Add rounds as per slab and add exercise to all rounds according to the user options
                if ($intensityArray[$workoutId][$slab] != 0 && $workoutId != 18) {
                    for ($i = 1; $i <= $intensityArray[$workoutId][$slab]; $i++) {
                        $newRoundExercises = Workoutexercise::where('round', '=', $i)
                            ->where('category', '=', $coach->focus)
                            ->where('workout_id', '=', $workoutId)
                            ->with(['video', 'exercise'])
                            ->get();

                        foreach ($newRoundExercises as $roundExercise) {
                            $roundExercise->is_completed = 0;
                            $doneExercisesArray[] = $roundExercise->exercise_id;
                        }

                        $doneExercises = implode(',', $doneExercisesArray);

                        $notInQuery = ' AND exercises.id NOT IN("' . $doneExercises . '")';

                        if ($coach->goal_option > 0) {
                            $userRaidRow = DB::table('skills')->where('id', $coach->goal_option)->first();
                            $notInQuery.=' AND skills.progression_id = ' . $userRaidRow->progression_id . ' AND skills.row = ' . $userRaidRow->row;
                        }

                        $basicSkillsQuery = DB::table('skills')
                            ->select('skills.exercise_id')
                            ->leftJoin('exercises', 'exercises.id', '=', 'skills.exercise_id')
                            ->orderBy('skills.id');

                        $likeQueryArray[] = 'exercises.muscle_groups =""';

                        $likeQuery = ' AND (';

                        if ($coach->muscle_groups != '') {
                            $muscleGroupArray = explode(',', $coach->muscle_groups);
                            foreach ($muscleGroupArray as $mgKey => $muscleGroupId) {
                                if ($muscleGroupId != '') {
                                    $likeQueryArray[] = 'exercises.muscle_groups LIKE "%' . $muscleGroupId . '%"';
                                }
                            }
                        }

                        $likeQuery .= implode(' OR ', $likeQueryArray) . ')';

                        $basicSkillsQuery->whereRaw('exercises.category = ' . $coach->focus . $likeQuery . $notInQuery);

                        $basicSkill = $basicSkillsQuery->first();

                        $newRoundExercisesArray = $newRoundExercises->toArray();

                        if (!is_null($basicSkill)) {
                            $exercise = Exercise::where('id', $basicSkill->exercise_id)->with(['video'])->first();
                            $newRoundExercise = [
                                'workout_id' => $workoutId,
                                'exercise' => $exercise->toArray(),
                                'category' => $coach->focus,
                                'repititions' => $exercise->repititions,
                                'exercise_id' => $exercise->id,
                                'unit' => $exercise->unit,
                                'round' => $i,
                                'is_completed' => 0
                            ];
                            $newRoundExercisesArray[] = $newRoundExercise;
                            $doneExercisesArray[] = $basicSkill->exercise_id;
                        }

                        $roundExercises['round' . $i] = $newRoundExercisesArray;
                    }
                } elseif ($intensityArray[$workoutId][$slab] != 0 && $workoutId == 18) {

                    $roundCount = $intensityArray[$workoutId][$slab];
                    $actualRoundCount = DB::table('workouts')->where('id', $workoutId)->pluck('rounds');
                    if ($roundCount >= $actualRoundCount) {
                        $newRoundExercises = Workoutexercise::where('round', '=', ($roundCount % $actualRoundCount) + 1)
                            ->where('category', '=', $coach->focus)
                            ->where('workout_id', '=', $workoutId)
                            ->with(['video', 'exercise'])
                            ->get();

                        foreach ($newRoundExercises as $roundExercise) {
                            $roundExercise->is_completed = 0;
                        }
                    }

                    $roundExercises['round' . $intensityArray[$workoutId][$slab]] = $newRoundExercises->toArray();
                }
            } else {
                if ($intensityArray[$workoutId][$slab] != 0 && $workoutId != 18) {
                    for ($i = 1; $i <= $intensityArray[$workoutId][$slab]; $i++) {
                        $newRoundExercises = Workoutexercise::where('round', '=', $i)
                            ->where('category', '=', $coach->focus)
                            ->where('workout_id', '=', $workoutId)
                            ->with(['video', 'exercise'])
                            ->get();

                        foreach ($newRoundExercises as $roundExercise) {
                            $roundExercise->is_completed = 0;
                        }
                        $roundExercises['round' . $i] = $newRoundExercises->toArray();
                    }
                } elseif ($intensityArray[$workoutId][$slab] != 0 && $workoutId == 18) {

                    $roundCount = $intensityArray[$workoutId][$slab];
                    $actualRoundCount = DB::table('workouts')->where('id', $workoutId)->pluck('rounds');
                    if ($roundCount > $actualRoundCount) {
                        $newRoundExercises = Workoutexercise::where('round', '=', ($roundCount % $actualRoundCount) + 1)
                            ->where('category', '=', $coach->focus)
                            ->where('workout_id', '=', $workoutId)
                            ->with(['video', 'exercise'])
                            ->get();

                        foreach ($newRoundExercises as $roundExercise) {
                            $roundExercise->is_completed = 0;
                        }
                    }
                    $roundExercises['round' . $intensityArray[$workoutId][$slab]] = $newRoundExercises->toArray();
                }
            }

            return $roundExercises;
        }
    }

    public static function checkForHigherLimits($coachExercises, $data)
    {
        $filterArray = [
            1 => [1 => 500, 2 => 500, 3 => 500],
            2 => [1 => 500, 2 => 500, 3 => 500],
            3 => [1 => 500, 2 => 500, 3 => 500],
            4 => [1 => 500, 2 => 500, 3 => 500],
            5 => [1 => 500, 2 => 500, 3 => 500]
        ];

        $repitationCount = [
            1 => 0,
            2 => 0,
            3 => 0,
            4 => 0,
            5 => 0
        ];

        foreach ($coachExercises as $aKey => $coachExercise) {
            if (!empty($coachExercise['workout'])) {
                foreach ($coachExercise['workout']['exercises'] as $rKey => $roundExercises) {
                    foreach ($roundExercises as $roundExercise) {
                        if ($roundExercise['exercise']['unit'] == 'times') {
                            $progressionId = self::getProgressionId($roundExercise['exercise']['id']);
                            if ($progressionId > 0) {
                                $repitationCount[$progressionId] += $roundExercise['repititions'];
                                if ($repitationCount[$progressionId] > $filterArray[$progressionId][$data['focus']]) {
                                    unset($roundExercise);
                                }
                            }
                        }
                    }
                }
            } elseif (!empty($coachExercise['exercises'])) {
                foreach ($coachExercise['exercises'] as $eKey => $exercise) {
                    if ($exercise['unit'] == 'times') {
                        $progressionId = self::getProgressionId($exercise->id);
                        if ($progressionId > 0) {
                            $repitationCount[$progressionId] += $exercise->repititions;
                            if ($repitationCount[$progressionId] > $filterArray[$progressionId][$data['focus']]) {
                                unset($exercise);
                            }
                        }
                    }
                }
            }
        }

        return $coachExercises;
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

    public static function filterCoachExercises($coachExercises, $data)
    {
        $filterArray = [
            1 => [1 => 90, 2 => 120, 3 => 150],
            2 => [1 => 90, 2 => 120, 3 => 150],
            3 => [1 => 120, 2 => 160, 3 => 200],
            4 => [1 => 90, 2 => 120, 3 => 150],
            5 => [1 => 120, 2 => 160, 3 => 200]
        ];

        $repitationCount = [
            1 => 0,
            2 => 0,
            3 => 0,
            4 => 0,
            5 => 0
        ];

        foreach ($coachExercises as $aKey => $coachExercise) {
            if (!empty($coachExercise['workout'])) {
                foreach ($coachExercise['workout']['exercises'] as $rKey => $roundExercises) {
                    foreach ($roundExercises as $roundExercise) {
                        if ($roundExercise['exercise']['unit'] == 'times') {
                            $progressionId = self::getProgressionId($roundExercise['exercise']['id']);
                            if ($progressionId > 0) {
                                $repitationCount[$progressionId] += $roundExercise['repititions'];
                                if ($repitationCount[$progressionId] > $filterArray[$progressionId][$data['focus']]) {
                                    unset($roundExercise);
                                }
                            }
                        }
                    }
                }
            } elseif (!empty($coachExercise['exercises'])) {
                foreach ($coachExercise['exercises'] as $eKey => $exercise) {
                    if ($exercise['unit'] == 'times') {
                        $progressionId = self::getProgressionId($exercise->id);
                        if ($progressionId > 0) {
                            $repitationCount[$progressionId] += $exercise->repititions;
                            if ($repitationCount[$progressionId] > $filterArray[$progressionId][$data['focus']]) {
                                unset($exercise);
                            }
                        }
                    }
                }
            }
        }

        return $coachExercises;
    }

    public static function getProgressionId($exerciseId)
    {
        $progressionId = DB::table('skills')->where('exercise_id', $exerciseId)->pluck('progression_id');
        if (!is_null($progressionId)) {
            return $progressionId;
        } else {
            return 0;
        }
    }
}
