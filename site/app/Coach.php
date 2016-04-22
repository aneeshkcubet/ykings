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

    /**
     * Function to string form of muscle group on Coach Object
     * @depends musclegroupString
     * @return type
     * @author Aneesh K<aneeshk@cubettech.com>
     */
    public function getMusclegroupStringAttribute()
    {
        return $this->attributes['musclegroup_string'] = self::musclegroupString($this->muscle_groups);
    }

    /**
     * Function to get musclegroup string from database table
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
     * Function to string form of user ride on Coach Object
     * @depends goaloptionString
     * @return type
     * @author Aneesh K<aneeshk@cubettech.com>
     */
    public function getGoaloptionStringAttribute()
    {
        return $this->attributes['goaloption_string'] = self::goaloptionString($this->goal_option);
    }

    /**
     * Function to get user Raid string from database table
     * @param type $goalOption
     * @return string
     * @author Aneesh K<aneeshk@cubettech.com>
     */
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

    /**
     * Relation with profile table
     * @return type
     * @author Aneesh K<aneeshk@cubettech.com>
     */
    public function profile()
    {
        return $this->belongsTo('App\Profile', 'user_id', 'user_id')->select(array('user_id', 'first_name', 'last_name', 'image', 'quote', 'gender'));
    }

    /**
     * Function to prepare coach exercises according to user options
     * @depends getUserMatchedWorkoutsQuery
     * @depends getCoachForFocus
     * @param type $coachId
     * @param type $data
     * @return type
     * @author Aneesh K<aneeshk@cubettech.com>
     */
    public static function prepareCoachExercises($coachId, $data)
    {

        $tests = json_decode($data['test'], true);
        $passed = 1;
        foreach ($tests as $test) {
            if ($test['test_done'] == 0) {
                $passed = 0;
                continue;
            }
        }

        $coach = [];

        $i = 1;

        do {

            $fundumental = Fundumental::where('row', $i)->with(['exercise'])->get();

            $fundumentalArray[$i] = $fundumental->toArray();

            $i++;
            unset($fundumental);
        } while ($i <= 5);

        $warmUps = DB::table('warmups')->select('*')->get();

        if ($passed == 0) {
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

        $userLevel = $data['category'];

        if ($userLevel == 'professional') {
            $intenseFactor = 2;
            $stretchesArray = array_map(function($stretch) {
                $stretch['duration']['min'] = round($stretch['duration']['min'] + ($stretch['duration']['min'] * (25 / 100)));
                $stretch['duration']['max'] = round($stretch['duration']['max'] + ($stretch['duration']['max'] * (25 / 100)));
                return $stretch;
            }, $stretchesArray);
        } elseif ($userLevel == 'advanced') {
            $intenseFactor = 1;
        } elseif ($userLevel == 'beginer') {
            $intenseFactor = 0;
        }

        $userWorkouts['strength'] = DB::select(self::getUserMatchedWorkoutsQuery(1, $data['user_id'], $data, $intenseFactor, $fundumentalArray));

        $userWorkouts['cardio_strength'] = DB::select(self::getUserMatchedWorkoutsQuery(2, $data['user_id'], $data, $intenseFactor, $fundumentalArray));

        $coach = self::getCoachForFocus($warmUps, $fundumentalArray, $stretchesArray, $data, $userWorkouts, $data['focus'], $userLevel, 1);
//        die;
        return $coach;
    }

    /**
     * Function to get user coach exercises including warmups, fundamentals, exercises, workouts and hiits
     * @depends userWorkoutCategory
     * @depends getUserBasicSkills
     * @depends getWorkoutWithExercises
     * @param type $warmUps
     * @param type $fundumentalArray
     * @param type $stretches
     * @param type $data
     * @param type $userWorkouts
     * @param type $focus
     * @param type $userLevel
     * @param type $week
     * @return type
     * @author Aneesh K<aneeshk@cubettech.com>
     */
    public static function getCoachForFocus($warmUps, $fundumentalArray, $stretches, $data, $userWorkouts, $focus, $userLevel, $week)
    {

        $coach = [];
        if ($userLevel == 'professional') {
            $intenseFactor = 2;
        } elseif ($userLevel == 'advanced') {
            $intenseFactor = 1;
        } elseif ($userLevel == 'beginer') {
            $intenseFactor = 0;
        }

        $hiitReplacements = [
            1 => [
                [ 'round1' => [
                        ['name' => 'Burpee', 'duration' => 15, 'unit' => 'times'],
                        ['name' => 'Plank', 'duration' => 30, 'unit' => 'seconds']
                    ],
                    'round2' => [
                        ['name' => 'High Jumps', 'duration' => 50, 'unit' => 'times'],
                        ['name' => 'Plank', 'duration' => 30, 'unit' => 'seconds']
                    ]
                ]
            ],
            2 => [
                [ 'round1' => [
                        ['name' => 'Burpee', 'duration' => 10, 'unit' => 'times'],
                        ['name' => 'Rest', 'duration' => 10, 'unit' => 'seconds']
                    ],
                    'round2' => [
                        ['name' => 'High Jumps', 'duration' => 25, 'unit' => 'times'],
                        ['name' => 'Rest', 'duration' => 10, 'unit' => 'seconds']
                    ],
                    'round3' => [
                        ['name' => 'Knee Raises', 'duration' => 15, 'unit' => 'times'],
                        ['name' => 'Rest', 'duration' => 10, 'unit' => 'seconds']
                    ]
                ]
            ],
            3 => [
                [ 'round1' => [
                        ['name' => 'Burpee', 'duration' => 25, 'unit' => 'times'],
                        ['name' => 'Climbers', 'duration' => 50, 'unit' => 'times'],
                        ['name' => 'High Jumps', 'duration' => 100, 'unit' => 'times']
                    ]
                ]
            ]
        ];

        $hiitReplacements = array_map(function($hiitReplacement) {
            $hiitReplacement = array_map(function($roundExercises) {

                $roundExercises = array_map(function($roundExercise) {
                    foreach ($roundExercise as $exerciseSet) {
                        if ($exerciseSet['name'] != 'Jumping Jacks' && $exerciseSet['name'] != 'Rest') {
                            $exercise = Exercise::where('name', '=', $exerciseSet['name'])->with(['video'])->first();
                            $exerciseSet['exercise'] = $exercise->toArray();
                        } else {
                            $exerciseSet['exercise'] = [];
                        }
                        $exercises[] = $exerciseSet;
                    }
                    return $exercises;
                }, $roundExercises);

                return $roundExercises;
            }, $hiitReplacement);

            return $hiitReplacement;
        }, $hiitReplacements);
        // hiit 1 - 30/30, 2 - 20/10, 3 - 60/120
        if (isset($data['week'])) {
            if ($data['week'] % 24 > 0 && $data['week'] % 24 <= 4) {
                $hiit = [['id' => 2, 'intensity' => 4, 'is_completed' => 0, 'replacement' => $hiitReplacements[2], 'replacement_round_count' => count($hiitReplacements[2][0])]];
            } elseif ($data['week'] % 24 <= 8) {
                $hiit = [['id' => 2, 'intensity' => 5, 'is_completed' => 0, 'replacement' => $hiitReplacements[2], 'replacement_round_count' => count($hiitReplacements[2][0])]];
            } elseif ($data['week'] % 24 <= 12) {
                $hiit = [['id' => 3, 'intensity' => 3, 'is_completed' => 0, 'replacement' => $hiitReplacements[3], 'replacement_round_count' => count($hiitReplacements[3][0])]];
            } elseif ($data['week'] % 24 <= 16) {
                $hiit = [['id' => 3, 'intensity' => 4, 'is_completed' => 0, 'replacement' => $hiitReplacements[3], 'replacement_round_count' => count($hiitReplacements[3][0])]];
            } elseif ($data['week'] % 24 <= 20) {
                $hiit = [['id' => 1, 'intensity' => 4, 'is_completed' => 0, 'replacement' => $hiitReplacements[1], 'replacement_round_count' => count($hiitReplacements[1][0])]];
            } elseif ($data['week'] % 24 < 24 || $data['week'] % 24 == 0) {
                $hiit = [['id' => 1, 'intensity' => 6, 'is_completed' => 0, 'replacement' => $hiitReplacements[1], 'replacement_round_count' => count($hiitReplacements[1][0])]];
            }
        }

        $exerciseCat = self::userWorkoutCategory($data['user_id'], $userWorkouts);

        $basicSkills = self::getUserBasicSkills($data['user_id'], $data['muscle_groups'], $exerciseCat);
        $exercises = [];
        foreach ($basicSkills as $bKey => $basicSkill) {
            $exercise = Exercise::where('id', $basicSkill->exercise_id)->with(['video'])->first();
            if (!is_null($exercise)) {
                $exercise->is_completed = 0;
                $exercises[] = $exercise;
            }
        }


        if ($userLevel == 'beginer') {


            $csWorkout1 = self::getWorkoutWithExercises($userWorkouts['cardio_strength'][0]->id, $intenseFactor, $data['user_id'], $week, $exerciseCat);

            $csWorkout2 = self::getWorkoutWithExercises($userWorkouts['cardio_strength'][1]->id, $intenseFactor, $data['user_id'], $week, $exerciseCat);

            $csWorkout3 = self::getWorkoutWithExercises($userWorkouts['cardio_strength'][2]->id, $intenseFactor, $data['user_id'], $week, $exerciseCat);



            $sWorkout1 = self::getWorkoutWithExercises($userWorkouts['strength'][0]->id, $intenseFactor, $data['user_id'], $week, $exerciseCat);

            $sWorkout2 = self::getWorkoutWithExercises($userWorkouts['strength'][1]->id, $intenseFactor, $data['user_id'], $week, $exerciseCat);

            $sWorkout3 = self::getWorkoutWithExercises($userWorkouts['strength'][2]->id, $intenseFactor, $data['user_id'], $week, $exerciseCat);

            $sWorkout4 = self::getWorkoutWithExercises($userWorkouts['strength'][3]->id, $intenseFactor, $data['user_id'], $week, $exerciseCat);

            $sWorkout5 = self::getWorkoutWithExercises($userWorkouts['strength'][4]->id, $intenseFactor, $data['user_id'], $week, $exerciseCat);

            if ($focus == 1) {

                if ($data['days'] == 2) {

//                  Day1 exercise set
                    $coach['day1']['warmup'] = $warmUps;
                    $coach['day1']['is_completed'] = 0;
                    $coach['day1']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day1']['exercises'] = [];
                    $coach['day1']['workout'] = $csWorkout1;
                    $coach['day1']['coach_workout_rounds'] = count($csWorkout1['exercises']);
                    $coach['day1']['workout_intensity'] = 1;
                    $coach['day1']['hiit'] = [];
                    $coach['day1']['stretching'] = $stretches;
                    $coach['day1']['is_completed'] = 0;

//                  Day2 Exercise set
                    $coach['day2']['warmup'] = $warmUps;
                    $coach['day2']['is_completed'] = 0;
                    $coach['day2']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day2']['exercises'] = $exercises;
                    $coach['day2']['workout'] = [];
                    $coach['day2']['coach_workout_rounds'] = 0;
                    $coach['day2']['workout_intensity'] = 1;
                    $coach['day2']['hiit'] = $hiit;
                    $coach['day2']['stretching'] = $stretches;
                } elseif ($data['days'] == 3) {

                    $coach['day1']['warmup'] = $warmUps;
                    $coach['day1']['is_completed'] = 0;
                    $coach['day1']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day1']['exercises'] = [];
                    $coach['day1']['workout'] = $csWorkout1;
                    $coach['day1']['coach_workout_rounds'] = count($csWorkout1['exercises']);
                    $coach['day1']['workout_intensity'] = 1;
                    $coach['day1']['hiit'] = [];
                    $coach['day1']['stretching'] = $stretches;

//                  Day2 Exercise set

                    $coach['day2']['warmup'] = $warmUps;
                    $coach['day2']['is_completed'] = 0;
                    $coach['day2']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day2']['exercises'] = [];
                    $coach['day2']['workout'] = $csWorkout2;
                    $coach['day2']['coach_workout_rounds'] = count($csWorkout2['exercises']);
                    $coach['day2']['workout_intensity'] = 1;
                    $coach['day2']['hiit'] = [];
                    $coach['day2']['stretching'] = $stretches;

//                  Day3 exercise set

                    $coach['day3']['warmup'] = $warmUps;
                    $coach['day3']['is_completed'] = 0;
                    $coach['day3']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day3']['exercises'] = $exercises;
                    $coach['day3']['workout'] = [];
                    $coach['day3']['coach_workout_rounds'] = 0;
                    $coach['day3']['workout_intensity'] = 1;
                    $coach['day3']['hiit'] = $hiit;
                    $coach['day3']['stretching'] = $stretches;
                } elseif ($data['days'] == 4) {

//                  Day1 exercise set
                    $coach['day1']['warmup'] = $warmUps;
                    $coach['day1']['is_completed'] = 0;
                    $coach['day1']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day1']['exercises'] = [];
                    $coach['day1']['workout'] = $csWorkout1;
                    $coach['day1']['coach_workout_rounds'] = count($csWorkout1['exercises']);
                    $coach['day1']['workout_intensity'] = 1;
                    $coach['day1']['hiit'] = [];
                    $coach['day1']['stretching'] = $stretches;

//                  Day2 Exercise set

                    $coach['day2']['warmup'] = $warmUps;
                    $coach['day2']['is_completed'] = 0;
                    $coach['day2']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day2']['exercises'] = $exercises;
                    $coach['day2']['workout'] = [];
                    $coach['day2']['coach_workout_rounds'] = 0;
                    $coach['day2']['workout_intensity'] = 1;
                    $coach['day2']['hiit'] = [];
                    $coach['day2']['stretching'] = $stretches;

//                  Day3 exercise set

                    $coach['day3']['warmup'] = $warmUps;
                    $coach['day3']['is_completed'] = 0;
                    $coach['day3']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day3']['exercises'] = [];
                    $coach['day3']['workout'] = $csWorkout2;
                    $coach['day3']['coach_workout_rounds'] = count($csWorkout2['exercises']);
                    $coach['day3']['workout_intensity'] = 1;
                    $coach['day3']['hiit'] = [];
                    $coach['day3']['stretching'] = $stretches;

//                  Day4 exercise set
                    $coach['day4']['warmup'] = $warmUps;
                    $coach['day4']['is_completed'] = 0;
                    $coach['day4']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day4']['exercises'] = $exercises;
                    $coach['day4']['workout'] = [];
                    $coach['day4']['coach_workout_rounds'] = 0;
                    $coach['day4']['workout_intensity'] = 1;
                    $coach['day4']['hiit'] = $hiit;
                    $coach['day4']['stretching'] = $stretches;
                } elseif ($data['days'] == 5) {

//                  Day1 exercise set
                    $coach['day1']['warmup'] = $warmUps;
                    $coach['day1']['is_completed'] = 0;
                    $coach['day1']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day1']['exercises'] = [];
                    $coach['day1']['workout'] = $csWorkout1;
                    $coach['day1']['coach_workout_rounds'] = count($csWorkout1['exercises']);
                    $coach['day1']['workout_intensity'] = 1;
                    $coach['day1']['hiit'] = [];
                    $coach['day1']['stretching'] = $stretches;

//                  Day2 Exercise set
                    $coach['day2']['warmup'] = $warmUps;
                    $coach['day2']['is_completed'] = 0;
                    $coach['day2']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day2']['exercises'] = [];
                    $coach['day2']['workout'] = $sWorkout1;
                    $coach['day2']['coach_workout_rounds'] = count($sWorkout1['exercises']);
                    $coach['day2']['workout_intensity'] = 1;
                    $coach['day2']['hiit'] = [];
                    $coach['day2']['stretching'] = $stretches;

//                  Day3 exercise set
                    $coach['day3']['warmup'] = $warmUps;
                    $coach['day3']['is_completed'] = 0;
                    $coach['day3']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day3']['exercises'] = [];
                    $coach['day3']['workout'] = $csWorkout2;
                    $coach['day3']['coach_workout_rounds'] = count($csWorkout2['exercises']);
                    $coach['day3']['workout_intensity'] = 1;
                    $coach['day3']['hiit'] = [];
                    $coach['day3']['stretching'] = $stretches;


                    $coach['day4']['warmup'] = $warmUps;
                    $coach['day4']['is_completed'] = 0;
                    $coach['day4']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day4']['exercises'] = [];
                    $coach['day4']['workout'] = $sWorkout2;
                    $coach['day4']['coach_workout_rounds'] = count($sWorkout2['exercises']);
                    $coach['day4']['workout_intensity'] = 1;
                    $coach['day4']['hiit'] = [];
                    $coach['day4']['stretching'] = $stretches;


                    $coach['day5']['warmup'] = $warmUps;
                    $coach['day5']['is_completed'] = 0;
                    $coach['day5']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day5']['exercises'] = $exercises;
                    $coach['day5']['workout'] = [];
                    $coach['day5']['coach_workout_rounds'] = 0;
                    $coach['day5']['workout_intensity'] = 1;
                    $coach['day5']['hiit'] = $hiit;
                    $coach['day5']['stretching'] = $stretches;
                } elseif ($data['days'] == 6) {
//                  Day1 exercise set
                    $coach['day1']['warmup'] = $warmUps;
                    $coach['day1']['is_completed'] = 0;
                    $coach['day1']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day1']['exercises'] = [];
                    $coach['day1']['workout'] = $csWorkout1;
                    $coach['day1']['coach_workout_rounds'] = count($csWorkout1['exercises']);
                    $coach['day1']['workout_intensity'] = 1;
                    $coach['day1']['hiit'] = [];
                    $coach['day1']['stretching'] = $stretches;

//                  Day2 Exercise set
                    $coach['day2']['warmup'] = $warmUps;
                    $coach['day2']['is_completed'] = 0;
                    $coach['day2']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day2']['exercises'] = $exercises;
                    $coach['day2']['workout'] = [];
                    $coach['day2']['coach_workout_rounds'] = 0;
                    $coach['day2']['workout_intensity'] = 1;
                    $coach['day2']['hiit'] = $hiit;
                    $coach['day2']['stretching'] = $stretches;

//                  Day3 exercise set
                    $coach['day3']['warmup'] = $warmUps;
                    $coach['day3']['is_completed'] = 0;
                    $coach['day3']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day3']['exercises'] = [];
                    $coach['day3']['workout'] = $csWorkout2;
                    $coach['day3']['coach_workout_rounds'] = count($csWorkout2['exercises']);
                    $coach['day3']['workout_intensity'] = 1;
                    $coach['day3']['hiit'] = [];
                    $coach['day3']['stretching'] = $stretches;

//                  Day4 exercise set
                    $coach['day4']['warmup'] = $warmUps;
                    $coach['day4']['is_completed'] = 0;
                    $coach['day4']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day4']['exercises'] = [];
                    $coach['day4']['workout'] = $csWorkout3;
                    $coach['day4']['coach_workout_rounds'] = count($csWorkout3['exercises']);
                    $coach['day4']['workout_intensity'] = 1;
                    $coach['day4']['hiit'] = [];
                    $coach['day4']['stretching'] = $stretches;

//                  Day5 exercise set
                    $coach['day5']['warmup'] = $warmUps;
                    $coach['day5']['is_completed'] = 0;
                    $coach['day5']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day5']['exercises'] = [];
                    $coach['day5']['workout'] = $sWorkout1;
                    $coach['day5']['coach_workout_rounds'] = count($sWorkout1['exercises']);
                    $coach['day5']['workout_intensity'] = 1;
                    $coach['day5']['hiit'] = [];
                    $coach['day5']['stretching'] = $stretches;

                    $coach['day6']['warmup'] = $warmUps;
                    $coach['day6']['is_completed'] = 0;
                    $coach['day6']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day6']['exercises'] = $exercises;
                    $coach['day6']['workout'] = [];
                    $coach['day6']['coach_workout_rounds'] = 0;
                    $coach['day6']['workout_intensity'] = 1;
                    $coach['day6']['hiit'] = $hiit;
                    $coach['day6']['stretching'] = $stretches;
                }
            } elseif ($focus == 2) {

                $basicSkills = self::getUserBasicSkills($data['user_id'], $data['muscle_groups'], $exerciseCat);

                $exercises = [];
                foreach ($basicSkills as $bKey => $basicSkill) {
                    $exercises[] = Exercise::where('id', $basicSkill->exercise_id)->with(['video'])->first();
                }

                if ($data['days'] == 2) {

//                  Day1 exercise set
                    $coach['day1']['warmup'] = $warmUps;
                    $coach['day1']['is_completed'] = 0;
                    $coach['day1']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day1']['exercises'] = [];
                    $coach['day1']['workout'] = $csWorkout1;
                    $coach['day1']['coach_workout_rounds'] = count($csWorkout1['exercises']);
                    $coach['day1']['workout_intensity'] = 1;
                    $coach['day1']['hiit'] = [];
                    $coach['day1']['stretching'] = $stretches;

//                  Day2 Exercise set
                    $coach['day2']['warmup'] = $warmUps;
                    $coach['day2']['is_completed'] = 0;
                    $coach['day2']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day2']['exercises'] = $exercises;
                    $coach['day2']['workout'] = [];
                    $coach['day2']['coach_workout_rounds'] = 0;
                    $coach['day2']['workout_intensity'] = 1;
                    $coach['day2']['hiit'] = $hiit;
                    $coach['day2']['stretching'] = $stretches;
                } elseif ($data['days'] == 3) {

                    $coach['day1']['warmup'] = $warmUps;
                    $coach['day1']['is_completed'] = 0;
                    $coach['day1']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day1']['exercises'] = [];
                    $coach['day1']['workout'] = $csWorkout1;
                    $coach['day1']['coach_workout_rounds'] = count($csWorkout1['exercises']);
                    $coach['day1']['workout_intensity'] = 1;
                    $coach['day1']['hiit'] = [];
                    $coach['day1']['stretching'] = $stretches;

//                  Day2 Exercise set
                    $coach['day2']['warmup'] = $warmUps;
                    $coach['day2']['is_completed'] = 0;
                    $coach['day2']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day2']['exercises'] = [];
                    $coach['day2']['workout'] = $sWorkout1;
                    $coach['day2']['coach_workout_rounds'] = count($sWorkout1['exercises']);
                    $coach['day2']['workout_intensity'] = 1;
                    $coach['day2']['hiit'] = [];
                    $coach['day2']['stretching'] = $stretches;

//                  Day3 exercise set
                    $coach['day3']['warmup'] = $warmUps;
                    $coach['day3']['is_completed'] = 0;
                    $coach['day3']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day3']['exercises'] = $exercises;
                    $coach['day3']['workout'] = [];
                    $coach['day3']['coach_workout_rounds'] = 0;
                    $coach['day3']['workout_intensity'] = 1;
                    $coach['day3']['hiit'] = $hiit;
                    $coach['day3']['stretching'] = $stretches;
                } elseif ($data['days'] == 4) {

//Day1 exercise set
                    $coach['day1']['warmup'] = $warmUps;
                    $coach['day1']['is_completed'] = 0;
                    $coach['day1']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day1']['exercises'] = [];
                    $coach['day1']['workout'] = $csWorkout1;
                    $coach['day1']['coach_workout_rounds'] = count($csWorkout1['exercises']);
                    $coach['day1']['workout_intensity'] = 1;
                    $coach['day1']['hiit'] = [];
                    $coach['day1']['stretching'] = $stretches;

//Day2 Exercise set

                    $coach['day2']['warmup'] = $warmUps;
                    $coach['day2']['is_completed'] = 0;
                    $coach['day2']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day2']['exercises'] = [];
                    $coach['day2']['workout'] = $sWorkout1;
                    $coach['day2']['coach_workout_rounds'] = count($sWorkout1['exercises']);
                    $coach['day2']['workout_intensity'] = 1;
                    $coach['day2']['hiit'] = [];
                    $coach['day2']['stretching'] = $stretches;

//Day3 exercise set                    
                    $coach['day3']['warmup'] = $warmUps;
                    $coach['day3']['is_completed'] = 0;
                    $coach['day3']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day3']['exercises'] = [];
                    $coach['day3']['workout'] = $csWorkout2;
                    $coach['day3']['coach_workout_rounds'] = count($csWorkout2['exercises']);
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
                    $coach['day4']['hiit'] = $hiit;
                    $coach['day4']['stretching'] = $stretches;
                } elseif ($data['days'] == 5) {

//                  Day1 exercise set
                    $coach['day1']['warmup'] = $warmUps;
                    $coach['day1']['is_completed'] = 0;
                    $coach['day1']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day1']['exercises'] = [];
                    $coach['day1']['workout'] = $csWorkout1;
                    $coach['day1']['coach_workout_rounds'] = count($csWorkout1['exercises']);
                    $coach['day1']['workout_intensity'] = 1;
                    $coach['day1']['hiit'] = [];
                    $coach['day1']['stretching'] = $stretches;

//                  Day2 Exercise set
                    $coach['day2']['warmup'] = $warmUps;
                    $coach['day2']['is_completed'] = 0;
                    $coach['day2']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day2']['exercises'] = [];
                    $coach['day2']['workout'] = $csWorkout2;
                    $coach['day2']['coach_workout_rounds'] = count($csWorkout2['exercises']);
                    $coach['day2']['workout_intensity'] = 1;
                    $coach['day2']['hiit'] = [];
                    $coach['day2']['stretching'] = $stretches;

//                  Day3 exercise set
                    $coach['day3']['warmup'] = $warmUps;
                    $coach['day3']['is_completed'] = 0;
                    $coach['day3']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day3']['exercises'] = [];
                    $coach['day3']['workout'] = $csWorkout3;
                    $coach['day3']['coach_workout_rounds'] = count($csWorkout3['exercises']);
                    $coach['day3']['workout_intensity'] = 1;
                    $coach['day3']['hiit'] = [];
                    $coach['day3']['stretching'] = $stretches;


                    $coach['day4']['warmup'] = $warmUps;
                    $coach['day4']['is_completed'] = 0;
                    $coach['day4']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day4']['exercises'] = [];
                    $coach['day4']['workout'] = $sWorkout1;
                    $coach['day4']['coach_workout_rounds'] = count($sWorkout1['exercises']);
                    $coach['day4']['workout_intensity'] = 1;
                    $coach['day4']['hiit'] = [];
                    $coach['day4']['stretching'] = $stretches;


                    $coach['day5']['warmup'] = $warmUps;
                    $coach['day5']['is_completed'] = 0;
                    $coach['day5']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day5']['exercises'] = $exercises;
                    $coach['day5']['workout'] = [];
                    $coach['day5']['coach_workout_rounds'] = 0;
                    $coach['day5']['workout_intensity'] = 1;
                    $coach['day5']['hiit'] = $hiit;
                    $coach['day5']['stretching'] = $stretches;
                } elseif ($data['days'] == 6) {
//                  Day1 exercise set
                    $coach['day1']['warmup'] = $warmUps;
                    $coach['day1']['is_completed'] = 0;
                    $coach['day1']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day1']['exercises'] = [];
                    $coach['day1']['workout'] = $csWorkout1;
                    $coach['day1']['coach_workout_rounds'] = count($csWorkout1['exercises']);
                    $coach['day1']['workout_intensity'] = 1;
                    $coach['day1']['hiit'] = [];
                    $coach['day1']['stretching'] = $stretches;

//                  Day2 Exercise set
                    $coach['day2']['warmup'] = $warmUps;
                    $coach['day2']['is_completed'] = 0;
                    $coach['day2']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day2']['exercises'] = [];
                    $coach['day2']['workout'] = $csWorkout2;
                    $coach['day2']['coach_workout_rounds'] = count($csWorkout2['exercises']);
                    $coach['day2']['workout_intensity'] = 1;
                    $coach['day2']['hiit'] = [];
                    $coach['day2']['stretching'] = $stretches;

//                  Day3 exercise set
                    $coach['day3']['warmup'] = $warmUps;
                    $coach['day3']['is_completed'] = 0;
                    $coach['day3']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day3']['exercises'] = [];
                    $coach['day3']['workout'] = $csWorkout3;
                    $coach['day3']['coach_workout_rounds'] = count($csWorkout3['exercises']);
                    $coach['day3']['workout_intensity'] = 1;
                    $coach['day3']['hiit'] = [];
                    $coach['day3']['stretching'] = $stretches;

//                  Day4 exercise set
                    $coach['day4']['warmup'] = $warmUps;
                    $coach['day4']['is_completed'] = 0;
                    $coach['day4']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day4']['exercises'] = [];
                    $coach['day4']['workout'] = $sWorkout1;
                    $coach['day4']['coach_workout_rounds'] = count($sWorkout1['exercises']);
                    $coach['day4']['workout_intensity'] = 1;
                    $coach['day4']['hiit'] = [];
                    $coach['day4']['stretching'] = $stretches;

//                  Day5 exercise set
                    $coach['day5']['warmup'] = $warmUps;
                    $coach['day5']['is_completed'] = 0;
                    $coach['day5']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day5']['exercises'] = [];
                    $coach['day5']['workout'] = $sWorkout2;
                    $coach['day5']['coach_workout_rounds'] = count($sWorkout2['exercises']);
                    $coach['day5']['workout_intensity'] = 1;
                    $coach['day5']['hiit'] = [];
                    $coach['day5']['stretching'] = $stretches;

//                  Day6 exercise set
                    $coach['day6']['warmup'] = $warmUps;
                    $coach['day6']['is_completed'] = 0;
                    $coach['day6']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day6']['exercises'] = $exercises;
                    $coach['day6']['workout'] = [];
                    $coach['day6']['coach_workout_rounds'] = 0;
                    $coach['day6']['workout_intensity'] = 1;
                    $coach['day6']['hiit'] = $hiit;
                    $coach['day6']['stretching'] = $stretches;
                }
            } elseif ($focus == 3) {
                $basicSkills = self::getUserBasicSkills($data['user_id'], $data['muscle_groups'], $exerciseCat);
                $exercises = [];
                foreach ($basicSkills as $bKey => $basicSkill) {
                    $exercises[] = Exercise::where('id', $basicSkill->exercise_id)->with(['video'])->first();
                }

                if ($data['days'] == 2) {

//                  Day1 exercise set
                    $coach['day1']['warmup'] = $warmUps;
                    $coach['day1']['is_completed'] = 0;
                    $coach['day1']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day1']['exercises'] = [];
                    $coach['day1']['workout'] = $sWorkout1;
                    $coach['day1']['coach_workout_rounds'] = count($sWorkout1['exercises']);
                    $coach['day1']['workout_intensity'] = 1;
                    $coach['day1']['hiit'] = [];
                    $coach['day1']['stretching'] = $stretches;

//                  Day2 Exercise set
                    $coach['day2']['warmup'] = $warmUps;
                    $coach['day2']['is_completed'] = 0;
                    $coach['day2']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day2']['exercises'] = $exercises;
                    $coach['day2']['workout'] = [];
                    $coach['day2']['coach_workout_rounds'] = 0;
                    $coach['day2']['workout_intensity'] = 1;
                    $coach['day2']['hiit'] = $hiit;
                    $coach['day2']['stretching'] = $stretches;
                } elseif ($data['days'] == 3) {

                    $coach['day1']['warmup'] = $warmUps;
                    $coach['day1']['is_completed'] = 0;
                    $coach['day1']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day1']['exercises'] = [];
                    $coach['day1']['workout'] = $sWorkout1;
                    $coach['day1']['coach_workout_rounds'] = count($sWorkout1['exercises']);
                    $coach['day1']['workout_intensity'] = 1;
                    $coach['day1']['hiit'] = [];
                    $coach['day1']['stretching'] = $stretches;

//                  Day2 Exercise set
                    $coach['day2']['warmup'] = $warmUps;
                    $coach['day2']['is_completed'] = 0;
                    $coach['day2']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day2']['exercises'] = [];
                    $coach['day2']['workout'] = $sWorkout2;
                    $coach['day2']['coach_workout_rounds'] = count($sWorkout2['exercises']);
                    $coach['day2']['workout_intensity'] = 1;
                    $coach['day2']['hiit'] = [];
                    $coach['day2']['stretching'] = $stretches;

//                  Day3 exercise set
                    $coach['day3']['warmup'] = $warmUps;
                    $coach['day3']['is_completed'] = 0;
                    $coach['day3']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day3']['exercises'] = $exercises;
                    $coach['day3']['workout'] = [];
                    $coach['day3']['coach_workout_rounds'] = 0;
                    $coach['day3']['workout_intensity'] = 1;
                    $coach['day3']['hiit'] = $hiit;
                    $coach['day3']['stretching'] = $stretches;
                } elseif ($data['days'] == 4) {
//                  Day1 exercise set
                    $coach['day1']['warmup'] = $warmUps;
                    $coach['day1']['is_completed'] = 0;
                    $coach['day1']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day1']['exercises'] = [];
                    $coach['day1']['workout'] = $sWorkout1;
                    $coach['day1']['coach_workout_rounds'] = count($sWorkout1['exercises']);
                    $coach['day1']['workout_intensity'] = 1;
                    $coach['day1']['hiit'] = [];
                    $coach['day1']['stretching'] = $stretches;

//                  Day2 Exercise set
                    $coach['day2']['warmup'] = $warmUps;
                    $coach['day2']['is_completed'] = 0;
                    $coach['day2']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day2']['exercises'] = [];
                    $coach['day2']['workout'] = $sWorkout2;
                    $coach['day2']['coach_workout_rounds'] = count($sWorkout2['exercises']);
                    $coach['day2']['workout_intensity'] = 1;
                    $coach['day2']['hiit'] = [];
                    $coach['day2']['stretching'] = $stretches;

//                  Day3 exercise set                    
                    $coach['day3']['warmup'] = $warmUps;
                    $coach['day3']['is_completed'] = 0;
                    $coach['day3']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day3']['exercises'] = [];
                    $coach['day3']['workout'] = $sWorkout3;
                    $coach['day3']['coach_workout_rounds'] = count($sWorkout3['exercises']);
                    $coach['day3']['workout_intensity'] = 1;
                    $coach['day3']['hiit'] = [];
                    $coach['day3']['stretching'] = $stretches;

//                  Day4 exercise set
                    $coach['day4']['warmup'] = $warmUps;
                    $coach['day4']['is_completed'] = 0;
                    $coach['day4']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day4']['exercises'] = $exercises;
                    $coach['day4']['workout'] = [];
                    $coach['day4']['coach_workout_rounds'] = 0;
                    $coach['day4']['workout_intensity'] = 1;
                    $coach['day4']['hiit'] = $hiit;
                    $coach['day4']['stretching'] = $stretches;
                } elseif ($data['days'] == 5) {

//                  Day1 exercise set
                    $coach['day1']['warmup'] = $warmUps;
                    $coach['day1']['is_completed'] = 0;
                    $coach['day1']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day1']['exercises'] = [];
                    $coach['day1']['workout'] = $csWorkout1;
                    $coach['day1']['coach_workout_rounds'] = count($csWorkout1['exercises']);
                    $coach['day1']['workout_intensity'] = 1;
                    $coach['day1']['hiit'] = [];
                    $coach['day1']['stretching'] = $stretches;

//                  Day2 Exercise set
                    $coach['day2']['warmup'] = $warmUps;
                    $coach['day2']['is_completed'] = 0;
                    $coach['day2']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day2']['exercises'] = [];
                    $coach['day2']['workout'] = $ssWorkout1;
                    $coach['day2']['coach_workout_rounds'] = count($sWorkout1['exercises']);
                    $coach['day2']['workout_intensity'] = 1;
                    $coach['day2']['hiit'] = [];
                    $coach['day2']['stretching'] = $stretches;

//Day3 exercise set
                    $coach['day3']['warmup'] = $warmUps;
                    $coach['day3']['is_completed'] = 0;
                    $coach['day3']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day3']['exercises'] = [];
                    $coach['day3']['workout'] = $sWorkout2;
                    $coach['day3']['coach_workout_rounds'] = count($sWorkout2['exercises']);
                    $coach['day3']['workout_intensity'] = 1;
                    $coach['day3']['hiit'] = [];
                    $coach['day3']['stretching'] = $stretches;

//Day4 exercise set
                    $coach['day4']['warmup'] = $warmUps;
                    $coach['day4']['is_completed'] = 0;
                    $coach['day4']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day4']['exercises'] = [];
                    $coach['day4']['workout'] = $sWorkout3;
                    $coach['day4']['coach_workout_rounds'] = count($sWorkout3['exercises']);
                    $coach['day4']['workout_intensity'] = 1;
                    $coach['day4']['hiit'] = [];
                    $coach['day4']['stretching'] = $stretches;

//Day5 exercise set 
                    $coach['day5']['warmup'] = $warmUps;
                    $coach['day5']['is_completed'] = 0;
                    $coach['day5']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day5']['exercises'] = $exercises;
                    $coach['day5']['workout'] = [];
                    $coach['day5']['coach_workout_rounds'] = 0;
                    $coach['day5']['workout_intensity'] = 1;
                    $coach['day5']['hiit'] = $hiit;
                    $coach['day5']['stretching'] = $stretches;
                } elseif ($data['days'] == 6) {
//Day1 exercise set
                    $coach['day1']['warmup'] = $warmUps;
                    $coach['day1']['is_completed'] = 0;
                    $coach['day1']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day1']['exercises'] = [];
                    $coach['day1']['workout'] = $csWorkout1;
                    $coach['day1']['coach_workout_rounds'] = count($csWorkout1['exercises']);
                    $coach['day1']['workout_intensity'] = 1;
                    $coach['day1']['hiit'] = [];
                    $coach['day1']['stretching'] = $stretches;

//Day2 Exercise set
                    $coach['day2']['warmup'] = $warmUps;
                    $coach['day2']['is_completed'] = 0;
                    $coach['day2']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day2']['exercises'] = [];
                    $coach['day2']['workout'] = $sWorkout1;
                    $coach['day2']['coach_workout_rounds'] = count($sWorkout1['exercises']);
                    $coach['day2']['workout_intensity'] = 1;
                    $coach['day2']['hiit'] = [];
                    $coach['day2']['stretching'] = $stretches;

//Day3 exercise set
                    $coach['day3']['warmup'] = $warmUps;
                    $coach['day3']['is_completed'] = 0;
                    $coach['day3']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day3']['exercises'] = [];
                    $coach['day3']['workout'] = $sWorkout2;
                    $coach['day3']['coach_workout_rounds'] = count($sWorkout2['exercises']);
                    $coach['day3']['workout_intensity'] = 1;
                    $coach['day3']['hiit'] = [];
                    $coach['day3']['stretching'] = $stretches;

//Day4 exercise set
                    $coach['day4']['warmup'] = $warmUps;
                    $coach['day4']['is_completed'] = 0;
                    $coach['day4']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day4']['exercises'] = [];
                    $coach['day4']['workout'] = $sWorkout3;
                    $coach['day4']['coach_workout_rounds'] = count($sWorkout3['exercises']);
                    $coach['day4']['workout_intensity'] = 1;
                    $coach['day4']['hiit'] = [];
                    $coach['day4']['stretching'] = $stretches;

//                    Day5 exercise set
                    $coach['day5']['warmup'] = $warmUps;
                    $coach['day5']['is_completed'] = 0;
                    $coach['day5']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day5']['exercises'] = [];
                    $coach['day5']['workout'] = $sWorkout4;
                    $coach['day5']['coach_workout_rounds'] = count($sWorkout4['exercises']);
                    $coach['day5']['workout_intensity'] = 1;
                    $coach['day5']['hiit'] = [];
                    $coach['day5']['stretching'] = $stretches;

//                    Day6 exercise set

                    $coach['day6']['warmup'] = $warmUps;
                    $coach['day6']['is_completed'] = 0;
                    $coach['day6']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day6']['exercises'] = $exercises;
                    $coach['day6']['workout'] = [];
                    $coach['day6']['coach_workout_rounds'] = 0;
                    $coach['day6']['workout_intensity'] = 1;
                    $coach['day6']['hiit'] = $hiit;
                    $coach['day6']['stretching'] = $stretches;
                }
            }
        } elseif ($userLevel == 'advanced') {

            $csWorkout1 = self::getWorkoutWithExercises($userWorkouts['cardio_strength'][0]->id, $intenseFactor, $data['user_id'], $week, $exerciseCat);

            $csWorkout2 = self::getWorkoutWithExercises($userWorkouts['cardio_strength'][1]->id, $intenseFactor, $data['user_id'], $week, $exerciseCat);

            $csWorkout3 = self::getWorkoutWithExercises($userWorkouts['cardio_strength'][2]->id, $intenseFactor, $data['user_id'], $week, $exerciseCat);

            $csWorkout4 = self::getWorkoutWithExercises($userWorkouts['cardio_strength'][3]->id, $intenseFactor, $data['user_id'], $week, $exerciseCat);

            $csWorkout5 = self::getWorkoutWithExercises($userWorkouts['cardio_strength'][4]->id, $intenseFactor, $data['user_id'], $week, $exerciseCat);

            $sWorkout1 = self::getWorkoutWithExercises($userWorkouts['strength'][0]->id, $intenseFactor, $data['user_id'], $week, $exerciseCat);

            $sWorkout2 = self::getWorkoutWithExercises($userWorkouts['strength'][1]->id, $intenseFactor, $data['user_id'], $week, $exerciseCat);

            $sWorkout3 = self::getWorkoutWithExercises($userWorkouts['strength'][2]->id, $intenseFactor, $data['user_id'], $week, $exerciseCat);

            $sWorkout4 = self::getWorkoutWithExercises($userWorkouts['strength'][3]->id, $intenseFactor, $data['user_id'], $week, $exerciseCat);

            $sWorkout5 = self::getWorkoutWithExercises($userWorkouts['strength'][4]->id, $intenseFactor, $data['user_id'], $week, $exerciseCat);

            if ($focus == 1) {
                if ($data['days'] == 2) {
//                  Day1 exercise set
                    $coach['day1']['warmup'] = $warmUps;
                    $coach['day1']['is_completed'] = 0;
                    $coach['day1']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day1']['exercises'] = [];
                    $coach['day1']['workout'] = $csWorkout1;
                    $coach['day1']['coach_workout_rounds'] = count($coach['day1']['workout']['exercises']);
                    $coach['day1']['workout_intensity'] = 1;
                    $coach['day1']['hiit'] = [];
                    $coach['day1']['stretching'] = $stretches;

//                  Day2 Exercise set
                    $coach['day2']['warmup'] = $warmUps;
                    $coach['day2']['is_completed'] = 0;
                    $coach['day2']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day2']['exercises'] = $exercises;
                    $coach['day2']['workout'] = [];
                    $coach['day2']['coach_workout_rounds'] = count($sWorkout1['exercises']);
                    $coach['day2']['workout_intensity'] = 1;
                    $coach['day2']['hiit'] = $hiit;
                    $coach['day2']['stretching'] = $stretches;
                } elseif ($data['days'] == 3) {

//                  Day1 exercise set
                    $coach['day1']['warmup'] = $warmUps;
                    $coach['day1']['is_completed'] = 0;
                    $coach['day1']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day1']['exercises'] = [];
                    $coach['day1']['workout'] = $csWorkout1;
                    $coach['day1']['coach_workout_rounds'] = count($coach['day1']['workout']['exercises']);
                    $coach['day1']['workout_intensity'] = 1;
                    $coach['day1']['hiit'] = [];
                    $coach['day1']['stretching'] = $stretches;

//                  Day2 Exercise set
                    $coach['day2']['warmup'] = $warmUps;
                    $coach['day2']['is_completed'] = 0;
                    $coach['day2']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day2']['exercises'] = [];
                    $coach['day2']['workout'] = $csWorkout2;
                    $coach['day2']['coach_workout_rounds'] = count($coach['day2']['workout']['exercises']);
                    $coach['day2']['workout_intensity'] = 1;
                    $coach['day2']['hiit'] = [];
                    $coach['day2']['stretching'] = $stretches;

//                  Day3 Exercise set
                    $coach['day3']['warmup'] = $warmUps;
                    $coach['day3']['is_completed'] = 0;
                    $coach['day3']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day3']['exercises'] = [];
                    $coach['day3']['workout'] = $sWorkout1;
                    $coach['day3']['coach_workout_rounds'] = count($csWorkout2['exercises']);
                    $coach['day3']['workout_intensity'] = 1;
                    $coach['day3']['hiit'] = $hiit;
                    $coach['day3']['stretching'] = $stretches;
                } elseif ($data['days'] == 4) {
//                  Day1 exercise set
                    $coach['day1']['warmup'] = $warmUps;
                    $coach['day1']['is_completed'] = 0;
                    $coach['day1']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day1']['exercises'] = [];
                    $coach['day1']['workout'] = $csWorkout1;
                    $coach['day1']['coach_workout_rounds'] = count($coach['day1']['workout']['exercises']);
                    $coach['day1']['workout_intensity'] = 1;
                    $coach['day1']['hiit'] = [];
                    $coach['day1']['stretching'] = $stretches;

//                  Day2 Exercise set
                    $coach['day2']['warmup'] = $warmUps;
                    $coach['day2']['is_completed'] = 0;
                    $coach['day2']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day2']['exercises'] = [];
                    $coach['day2']['workout'] = $csWorkout2;
                    $coach['day2']['coach_workout_rounds'] = count($csWorkout2['exercises']);
                    $coach['day2']['workout_intensity'] = 1;
                    $coach['day2']['hiit'] = [];
                    $coach['day2']['stretching'] = $stretches;

//                  Day3 Exercise set
                    $coach['day3']['warmup'] = $warmUps;
                    $coach['day3']['is_completed'] = 0;
                    $coach['day3']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day3']['exercises'] = [];
                    $coach['day3']['workout'] = $csWorkout3;
                    $coach['day3']['coach_workout_rounds'] = count($coach['day3']['workout']['exercises']);
                    $coach['day3']['workout_intensity'] = 1;
                    $coach['day3']['hiit'] = [];
                    $coach['day3']['stretching'] = $stretches;

//                  Day4 Exercise set
                    $coach['day4']['warmup'] = $warmUps;
                    $coach['day4']['is_completed'] = 0;
                    $coach['day4']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day4']['exercises'] = [];
                    $coach['day4']['workout'] = $sWorkout1;
                    $coach['day4']['coach_workout_rounds'] = count($coach['day4']['workout']['exercises']);
                    $coach['day4']['workout_intensity'] = 1;
                    $coach['day4']['hiit'] = $hiit;
                    $coach['day4']['stretching'] = $stretches;
                } elseif ($data['days'] == 5) {

//                  Day1 exercise set
                    $coach['day1']['warmup'] = $warmUps;
                    $coach['day1']['is_completed'] = 0;
                    $coach['day1']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day1']['exercises'] = [];
                    $coach['day1']['workout'] = $csWorkout1;
                    $coach['day1']['coach_workout_rounds'] = count($coach['day1']['workout']['exercises']);
                    $coach['day1']['workout_intensity'] = 1;
                    $coach['day1']['hiit'] = [];
                    $coach['day1']['stretching'] = $stretches;

//                  Day2 Exercise set
                    $coach['day2']['warmup'] = $warmUps;
                    $coach['day2']['is_completed'] = 0;
                    $coach['day2']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day2']['exercises'] = [];
                    $coach['day2']['workout'] = $csWorkout2;
                    $coach['day2']['coach_workout_rounds'] = count($csWorkout2['exercises']);
                    $coach['day2']['workout_intensity'] = 1;
                    $coach['day2']['hiit'] = [];
                    $coach['day2']['stretching'] = $stretches;

//                  Day3 Exercise set
                    $coach['day3']['warmup'] = $warmUps;
                    $coach['day3']['is_completed'] = 0;
                    $coach['day3']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day3']['exercises'] = [];
                    $coach['day3']['workout'] = $csWorkout3;
                    $coach['day3']['coach_workout_rounds'] = count($coach['day3']['workout']['exercises']);
                    $coach['day3']['workout_intensity'] = 1;
                    $coach['day3']['hiit'] = [];
                    $coach['day3']['stretching'] = $stretches;

//                  Day4 Exercise set
                    $coach['day4']['warmup'] = $warmUps;
                    $coach['day4']['is_completed'] = 0;
                    $coach['day4']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day4']['exercises'] = [];
                    $coach['day4']['workout'] = $sWorkout2;
                    $coach['day4']['coach_workout_rounds'] = count($coach['day4']['workout']['exercises']);
                    $coach['day4']['workout_intensity'] = 1;
                    $coach['day4']['hiit'] = [];
                    $coach['day4']['stretching'] = $stretches;

//                  Day5 Exercise set
                    $coach['day5']['warmup'] = $warmUps;
                    $coach['day5']['is_completed'] = 0;
                    $coach['day5']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day5']['exercises'] = [];
                    $coach['day5']['workout'] = $sWorkout1;
                    $coach['day5']['coach_workout_rounds'] = count($coach['day5']['workout']['exercises']);
                    $coach['day5']['workout_intensity'] = 1;
                    $coach['day5']['hiit'] = $hiit;
                    $coach['day5']['stretching'] = $stretches;
                } elseif ($data['days'] == 6) {

//                  Day1 exercise set
                    $coach['day1']['warmup'] = $warmUps;
                    $coach['day1']['is_completed'] = 0;
                    $coach['day1']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day1']['exercises'] = [];
                    $coach['day1']['workout'] = $csWorkout1;
                    $coach['day1']['coach_workout_rounds'] = count($coach['day1']['workout']['exercises']);
                    $coach['day1']['workout_intensity'] = 1;
                    $coach['day1']['hiit'] = [];
                    $coach['day1']['stretching'] = $stretches;

//                  Day2 Exercise set
                    $coach['day2']['warmup'] = $warmUps;
                    $coach['day2']['is_completed'] = 0;
                    $coach['day2']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day2']['exercises'] = [];
                    $coach['day2']['workout'] = $csWorkout2;
                    $coach['day2']['coach_workout_rounds'] = count($csWorkout2['exercises']);
                    $coach['day2']['workout_intensity'] = 1;
                    $coach['day2']['hiit'] = [];
                    $coach['day2']['stretching'] = $stretches;

//                  Day3 Exercise set
                    $coach['day3']['warmup'] = $warmUps;
                    $coach['day3']['is_completed'] = 0;
                    $coach['day3']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day3']['exercises'] = [];
                    $coach['day3']['workout'] = $csWorkout3;
                    $coach['day3']['coach_workout_rounds'] = count($coach['day3']['workout']['exercises']);
                    $coach['day3']['workout_intensity'] = 1;
                    $coach['day3']['hiit'] = [];
                    $coach['day3']['stretching'] = $stretches;

//                  Day4 Exercise set
                    $coach['day4']['warmup'] = $warmUps;
                    $coach['day4']['is_completed'] = 0;
                    $coach['day4']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day4']['exercises'] = [];
                    $coach['day4']['workout'] = $csWorkout4;
                    $coach['day4']['coach_workout_rounds'] = count($coach['day4']['workout']['exercises']);
                    $coach['day4']['workout_intensity'] = 1;
                    $coach['day4']['hiit'] = [];
                    $coach['day4']['stretching'] = $stretches;

//                  Day5 Exercise set
                    $coach['day5']['warmup'] = $warmUps;
                    $coach['day5']['is_completed'] = 0;
                    $coach['day5']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day5']['exercises'] = [];
                    $coach['day5']['workout'] = $sWorkout2;
                    $coach['day5']['coach_workout_rounds'] = count($coach['day5']['workout']['exercises']);
                    $coach['day5']['workout_intensity'] = 1;
                    $coach['day5']['hiit'] = [];
                    $coach['day5']['stretching'] = $stretches;

//                  Day6 Exercise set
                    $coach['day6']['warmup'] = $warmUps;
                    $coach['day6']['is_completed'] = 0;
                    $coach['day6']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day6']['exercises'] = [];
                    $coach['day6']['workout'] = $sWorkout1;
                    $coach['day6']['coach_workout_rounds'] = count($coach['day6']['workout']['exercises']);
                    $coach['day6']['workout_intensity'] = 1;
                    $coach['day6']['hiit'] = $hiit;
                    $coach['day6']['stretching'] = $stretches;
                }
            } elseif ($focus == 2) {

                if ($data['days'] == 2) {
//                  Day1 exercise set
                    $coach['day1']['warmup'] = $warmUps;
                    $coach['day1']['is_completed'] = 0;
                    $coach['day1']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day1']['exercises'] = [];
                    $coach['day1']['workout'] = $csWorkout1;
                    $coach['day1']['coach_workout_rounds'] = count($coach['day1']['workout']['exercises']);
                    $coach['day1']['workout_intensity'] = 1;
                    $coach['day1']['hiit'] = [];
                    $coach['day1']['stretching'] = $stretches;

//                  Day2 Exercise set
                    $coach['day2']['warmup'] = $warmUps;
                    $coach['day2']['is_completed'] = 0;
                    $coach['day2']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day2']['exercises'] = [];
                    $coach['day2']['workout'] = $sWorkout1;
                    $coach['day2']['coach_workout_rounds'] = count($coach['day2']['workout']['exercises']);
                    $coach['day2']['workout_intensity'] = 1;
                    $coach['day2']['hiit'] = $hiit;
                    $coach['day2']['stretching'] = $stretches;
                } elseif ($data['days'] == 3) {

//                  Day1 exercise set
                    $coach['day1']['warmup'] = $warmUps;
                    $coach['day1']['is_completed'] = 0;
                    $coach['day1']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day1']['exercises'] = [];
                    $coach['day1']['workout'] = $csWorkout1;
                    $coach['day1']['coach_workout_rounds'] = count($coach['day1']['workout']['exercises']);
                    $coach['day1']['workout_intensity'] = 1;
                    $coach['day1']['hiit'] = [];
                    $coach['day1']['stretching'] = $stretches;

//                  Day2 Exercise set
                    $coach['day2']['warmup'] = $warmUps;
                    $coach['day2']['is_completed'] = 0;
                    $coach['day2']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day2']['exercises'] = [];
                    $coach['day2']['workout'] = $sWorkout2;
                    $coach['day2']['coach_workout_rounds'] = count($coach['day2']['workout']['exercises']);
                    $coach['day2']['workout_intensity'] = 1;
                    $coach['day2']['hiit'] = [];
                    $coach['day2']['stretching'] = $stretches;

//                  Day3 Exercise set
                    $coach['day3']['warmup'] = $warmUps;
                    $coach['day3']['is_completed'] = 0;
                    $coach['day3']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day3']['exercises'] = [];
                    $coach['day3']['workout'] = $sWorkout1;
                    $coach['day3']['coach_workout_rounds'] = count($coach['day3']['workout']['exercises']);
                    $coach['day3']['workout_intensity'] = 1;
                    $coach['day3']['hiit'] = $hiit;
                    $coach['day3']['stretching'] = $stretches;
                } elseif ($data['days'] == 4) {
//                  Day1 exercise set
                    $coach['day1']['warmup'] = $warmUps;
                    $coach['day1']['is_completed'] = 0;
                    $coach['day1']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day1']['exercises'] = [];
                    $coach['day1']['workout'] = $csWorkout1;
                    $coach['day1']['coach_workout_rounds'] = count($coach['day1']['workout']['exercises']);
                    $coach['day1']['workout_intensity'] = 1;
                    $coach['day1']['hiit'] = [];
                    $coach['day1']['stretching'] = $stretches;

//                  Day2 Exercise set
                    $coach['day2']['warmup'] = $warmUps;
                    $coach['day2']['is_completed'] = 0;
                    $coach['day2']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day2']['exercises'] = [];
                    $coach['day2']['workout'] = $csWorkout2;
                    $coach['day2']['coach_workout_rounds'] = count($csWorkout2['exercises']);
                    $coach['day2']['workout_intensity'] = 1;
                    $coach['day2']['hiit'] = [];
                    $coach['day2']['stretching'] = $stretches;

//                  Day3 Exercise set
                    $coach['day3']['warmup'] = $warmUps;
                    $coach['day3']['is_completed'] = 0;
                    $coach['day3']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day3']['exercises'] = [];
                    $coach['day3']['workout'] = $sWorkout1;
                    $coach['day3']['coach_workout_rounds'] = count($coach['day3']['workout']['exercises']);
                    $coach['day3']['workout_intensity'] = 1;
                    $coach['day3']['hiit'] = [];
                    $coach['day3']['stretching'] = $stretches;

//                  Day4 Exercise set
                    $coach['day4']['warmup'] = $warmUps;
                    $coach['day4']['is_completed'] = 0;
                    $coach['day4']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day4']['exercises'] = [];
                    $coach['day4']['workout'] = $sWorkout2;
                    $coach['day4']['coach_workout_rounds'] = count($coach['day4']['workout']['exercises']);
                    $coach['day4']['workout_intensity'] = 1;
                    $coach['day4']['hiit'] = $hiit;
                    $coach['day4']['stretching'] = $stretches;
                } elseif ($data['days'] == 5) {

//                  Day1 exercise set
                    $coach['day1']['warmup'] = $warmUps;
                    $coach['day1']['is_completed'] = 0;
                    $coach['day1']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day1']['exercises'] = [];
                    $coach['day1']['workout'] = $csWorkout1;
                    $coach['day1']['coach_workout_rounds'] = count($coach['day1']['workout']['exercises']);
                    $coach['day1']['workout_intensity'] = 1;
                    $coach['day1']['hiit'] = [];
                    $coach['day1']['stretching'] = $stretches;

//                  Day2 Exercise set
                    $coach['day2']['warmup'] = $warmUps;
                    $coach['day2']['is_completed'] = 0;
                    $coach['day2']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day2']['exercises'] = [];
                    $coach['day2']['workout'] = $csWorkout2;
                    $coach['day2']['coach_workout_rounds'] = count($csWorkout2['exercises']);
                    $coach['day2']['workout_intensity'] = 1;
                    $coach['day2']['hiit'] = [];
                    $coach['day2']['stretching'] = $stretches;

//                  Day3 Exercise set
                    $coach['day3']['warmup'] = $warmUps;
                    $coach['day3']['is_completed'] = 0;
                    $coach['day3']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day3']['exercises'] = [];
                    $coach['day3']['workout'] = $csWorkout3;
                    $coach['day3']['coach_workout_rounds'] = count($coach['day3']['workout']['exercises']);
                    $coach['day3']['workout_intensity'] = 1;
                    $coach['day3']['hiit'] = [];
                    $coach['day3']['stretching'] = $stretches;

//                  Day4 Exercise set
                    $coach['day4']['warmup'] = $warmUps;
                    $coach['day4']['is_completed'] = 0;
                    $coach['day4']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day4']['exercises'] = [];
                    $coach['day4']['workout'] = $sWorkout1;
                    $coach['day4']['coach_workout_rounds'] = count($coach['day4']['workout']['exercises']);
                    $coach['day4']['workout_intensity'] = 1;
                    $coach['day4']['hiit'] = [];
                    $coach['day4']['stretching'] = $stretches;

//                  Day5 Exercise set
                    $coach['day5']['warmup'] = $warmUps;
                    $coach['day5']['is_completed'] = 0;
                    $coach['day5']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day5']['exercises'] = [];
                    $coach['day5']['workout'] = $sWorkout2;
                    $coach['day5']['coach_workout_rounds'] = count($coach['day5']['workout']['exercises']);
                    $coach['day5']['hiit'] = $hiit;
                    $coach['day5']['stretching'] = $stretches;
                } elseif ($data['days'] == 6) {

//                  Day1 exercise set
                    $coach['day1']['warmup'] = $warmUps;
                    $coach['day1']['is_completed'] = 0;
                    $coach['day1']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day1']['exercises'] = [];
                    $coach['day1']['workout'] = $csWorkout1;
                    $coach['day1']['coach_workout_rounds'] = count($coach['day1']['workout']['exercises']);
                    $coach['day1']['workout_intensity'] = 1;
                    $coach['day1']['hiit'] = [];
                    $coach['day1']['stretching'] = $stretches;

//                  Day2 Exercise set
                    $coach['day2']['warmup'] = $warmUps;
                    $coach['day2']['is_completed'] = 0;
                    $coach['day2']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day2']['exercises'] = [];
                    $coach['day2']['workout'] = $csWorkout2;
                    $coach['day2']['coach_workout_rounds'] = count($csWorkout2['exercises']);
                    $coach['day2']['workout_intensity'] = 1;
                    $coach['day2']['hiit'] = [];
                    $coach['day2']['stretching'] = $stretches;

//                  Day3 Exercise set
                    $coach['day3']['warmup'] = $warmUps;
                    $coach['day3']['is_completed'] = 0;
                    $coach['day3']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day3']['exercises'] = [];
                    $coach['day3']['workout'] = $csWorkout3;
                    $coach['day3']['coach_workout_rounds'] = count($coach['day3']['workout']['exercises']);
                    $coach['day3']['workout_intensity'] = 1;
                    $coach['day3']['hiit'] = [];
                    $coach['day3']['stretching'] = $stretches;

//                  Day4 Exercise set
                    $coach['day4']['warmup'] = $warmUps;
                    $coach['day4']['is_completed'] = 0;
                    $coach['day4']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day4']['exercises'] = [];
                    $coach['day4']['workout'] = $sWorkout1;
                    $coach['day4']['coach_workout_rounds'] = count($coach['day4']['workout']['exercises']);
                    $coach['day4']['workout_intensity'] = 1;
                    $coach['day4']['hiit'] = [];
                    $coach['day4']['stretching'] = $stretches;

//                  Day5 Exercise set
                    $coach['day5']['warmup'] = $warmUps;
                    $coach['day5']['is_completed'] = 0;
                    $coach['day5']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day5']['exercises'] = [];
                    $coach['day5']['workout'] = $sWorkout2;
                    $coach['day5']['coach_workout_rounds'] = count($coach['day5']['workout']['exercises']);
                    $coach['day5']['workout_intensity'] = 1;
                    $coach['day5']['hiit'] = [];
                    $coach['day5']['stretching'] = $stretches;

//                  Day5 Exercise set
                    $coach['day6']['warmup'] = $warmUps;
                    $coach['day6']['is_completed'] = 0;
                    $coach['day6']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day6']['exercises'] = [];
                    $coach['day6']['workout'] = $sWorkout3;
                    $coach['day6']['coach_workout_rounds'] = count($coach['day6']['workout']['exercises']);
                    $coach['day6']['workout_intensity'] = 1;
                    $coach['day6']['hiit'] = $hiit;
                    $coach['day6']['stretching'] = $stretches;
                }
            } elseif ($focus == 3) {

                if ($data['days'] == 2) {
//                  Day1 exercise set
                    $coach['day1']['warmup'] = $warmUps;
                    $coach['day1']['is_completed'] = 0;
                    $coach['day1']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day1']['exercises'] = [];
                    $coach['day1']['workout'] = $sWorkout1;
                    $coach['day1']['coach_workout_rounds'] = count($coach['day1']['workout']['exercises']);
                    $coach['day1']['workout_intensity'] = 1;
                    $coach['day1']['hiit'] = [];
                    $coach['day1']['stretching'] = $stretches;

//                  Day2 Exercise set
                    $coach['day2']['warmup'] = $warmUps;
                    $coach['day2']['is_completed'] = 0;
                    $coach['day2']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day2']['exercises'] = [];
                    $coach['day2']['workout'] = $sWorkout1;
                    $coach['day2']['coach_workout_rounds'] = count($coach['day2']['workout']['exercises']);
                    $coach['day2']['workout_intensity'] = 1;
                    $coach['day2']['hiit'] = $hiit;
                    $coach['day2']['stretching'] = $stretches;
                } elseif ($data['days'] == 3) {

//                  Day1 exercise set
                    $coach['day1']['warmup'] = $warmUps;
                    $coach['day1']['is_completed'] = 0;
                    $coach['day1']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day1']['exercises'] = [];
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
                    $coach['day2']['hiit'] = [];
                    $coach['day2']['stretching'] = $stretches;

//Day3 Exercise set
                    $coach['day3']['warmup'] = $warmUps;
                    $coach['day3']['is_completed'] = 0;
                    $coach['day3']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day3']['exercises'] = [];
                    $coach['day3']['workout'] = $sWorkout3;
                    $coach['day3']['coach_workout_rounds'] = count($coach['day3']['workout']['exercises']);
                    $coach['day3']['workout_intensity'] = 1;
                    $coach['day3']['hiit'] = $hiit;
                    $coach['day3']['stretching'] = $stretches;
                } elseif ($data['days'] == 4) {
//Day1 exercise set
                    $coach['day1']['warmup'] = $warmUps;
                    $coach['day1']['is_completed'] = 0;
                    $coach['day1']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day1']['exercises'] = [];
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
                    $coach['day2']['coach_workout_rounds'] = count($csWorkout2['exercises']);
                    $coach['day2']['workout_intensity'] = 1;
                    $coach['day2']['hiit'] = [];
                    $coach['day2']['stretching'] = $stretches;

//Day3 Exercise set
                    $coach['day3']['warmup'] = $warmUps;
                    $coach['day3']['is_completed'] = 0;
                    $coach['day3']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day3']['exercises'] = [];
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
                    $coach['day4']['workout'] = $sWorkout4;
                    $coach['day4']['coach_workout_rounds'] = count($coach['day4']['workout']['exercises']);
                    $coach['day4']['workout_intensity'] = 1;
                    $coach['day4']['hiit'] = $hiit;
                    $coach['day4']['stretching'] = $stretches;
                } elseif ($data['days'] == 5) {

//Day1 exercise set
                    $coach['day1']['warmup'] = $warmUps;
                    $coach['day1']['is_completed'] = 0;
                    $coach['day1']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
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
                    $coach['day2']['workout'] = $sWorkout1;
                    $coach['day2']['coach_workout_rounds'] = count($sWorkout1['exercises']);
                    $coach['day2']['workout_intensity'] = 1;
                    $coach['day2']['hiit'] = [];
                    $coach['day2']['stretching'] = $stretches;

//Day3 Exercise set
                    $coach['day3']['warmup'] = $warmUps;
                    $coach['day3']['is_completed'] = 0;
                    $coach['day3']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day3']['exercises'] = [];
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
                    $coach['day5']['workout'] = $sWorkout4;
                    $coach['day5']['coach_workout_rounds'] = count($coach['day5']['workout']['exercises']);
                    $coach['day5']['hiit'] = $hiit;
                    $coach['day5']['stretching'] = $stretches;
                } elseif ($data['days'] == 6) {

//Day1 exercise set
                    $coach['day1']['warmup'] = $warmUps;
                    $coach['day1']['is_completed'] = 0;
                    $coach['day1']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
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
                    $coach['day2']['workout'] = $sWorkout1;
                    $coach['day2']['coach_workout_rounds'] = count($sWorkout1['exercises']);
                    $coach['day2']['workout_intensity'] = 1;
                    $coach['day2']['hiit'] = [];
                    $coach['day2']['stretching'] = $stretches;

//Day3 Exercise set
                    $coach['day3']['warmup'] = $warmUps;
                    $coach['day3']['is_completed'] = 0;
                    $coach['day3']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day3']['exercises'] = [];
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
                    $coach['day5']['workout'] = $sWorkout4;
                    $coach['day5']['coach_workout_rounds'] = count($coach['day5']['workout']['exercises']);
                    $coach['day5']['workout_intensity'] = 1;
                    $coach['day5']['hiit'] = [];
                    $coach['day5']['stretching'] = $stretches;

//Day5 Exercise set
                    $coach['day6']['warmup'] = $warmUps;
                    $coach['day6']['is_completed'] = 0;
                    $coach['day6']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day6']['exercises'] = [];
                    $coach['day6']['workout'] = $sWorkout5;
                    $coach['day6']['coach_workout_rounds'] = count($coach['day6']['workout']['exercises']);
                    $coach['day6']['workout_intensity'] = 1;
                    $coach['day6']['hiit'] = $hiit;
                    $coach['day6']['stretching'] = $stretches;
                }
            }
        } elseif ($userLevel == 'professional') {

            $csWorkout1 = self::getWorkoutWithExercises($userWorkouts['cardio_strength'][0]->id, $intenseFactor, $data['user_id'], $week, $exerciseCat);

            $csWorkout2 = self::getWorkoutWithExercises($userWorkouts['cardio_strength'][1]->id, $intenseFactor, $data['user_id'], $week, $exerciseCat);

            $csWorkout3 = self::getWorkoutWithExercises($userWorkouts['cardio_strength'][2]->id, $intenseFactor, $data['user_id'], $week, $exerciseCat);

            $csWorkout4 = self::getWorkoutWithExercises($userWorkouts['cardio_strength'][3]->id, $intenseFactor, $data['user_id'], $week, $exerciseCat);

            $csWorkout5 = self::getWorkoutWithExercises($userWorkouts['cardio_strength'][4]->id, $intenseFactor, $data['user_id'], $week, $exerciseCat);

            $sWorkout1 = self::getWorkoutWithExercises($userWorkouts['strength'][0]->id, $intenseFactor, $data['user_id'], $week, $exerciseCat);

            $sWorkout2 = self::getWorkoutWithExercises($userWorkouts['strength'][1]->id, $intenseFactor, $data['user_id'], $week, $exerciseCat);

            $sWorkout3 = self::getWorkoutWithExercises($userWorkouts['strength'][2]->id, $intenseFactor, $data['user_id'], $week, $exerciseCat);

            $sWorkout4 = self::getWorkoutWithExercises($userWorkouts['strength'][3]->id, $intenseFactor, $data['user_id'], $week, $exerciseCat);

            $sWorkout5 = self::getWorkoutWithExercises($userWorkouts['strength'][4]->id, $intenseFactor, $data['user_id'], $week, $exerciseCat);

            if ($focus == 1) {
                if ($data['days'] == 2) {
//Day1 exercise set
                    $coach['day1']['warmup'] = $warmUps;
                    $coach['day1']['is_completed'] = 0;
                    $coach['day1']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
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
                    $coach['day2']['exercises'] = $exercises;
                    ;
                    $coach['day2']['workout'] = [];
                    $coach['day2']['coach_workout_rounds'] = count($sWorkout1['exercises']);
                    $coach['day2']['workout_intensity'] = 1;
                    $coach['day2']['hiit'] = $hiit;
                    $coach['day2']['stretching'] = $stretches;
                } elseif ($data['days'] == 3) {

//Day1 exercise set
                    $coach['day1']['warmup'] = $warmUps;
                    $coach['day1']['is_completed'] = 0;
                    $coach['day1']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
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
                    $coach['day2']['coach_workout_rounds'] = count($coach['day2']['workout']['exercises']);
                    $coach['day2']['workout_intensity'] = 1;
                    $coach['day2']['hiit'] = [];
                    $coach['day2']['stretching'] = $stretches;

//Day3 Exercise set
                    $coach['day3']['warmup'] = $warmUps;
                    $coach['day3']['is_completed'] = 0;
                    $coach['day3']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day3']['exercises'] = [];
                    $coach['day3']['workout'] = $sWorkout1;
                    $coach['day3']['coach_workout_rounds'] = count($csWorkout2['exercises']);
                    $coach['day3']['workout_intensity'] = 1;
                    $coach['day3']['hiit'] = $hiit;
                    $coach['day3']['stretching'] = $stretches;
                } elseif ($data['days'] == 4) {
//Day1 exercise set
                    $coach['day1']['warmup'] = $warmUps;
                    $coach['day1']['is_completed'] = 0;
                    $coach['day1']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
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
                    $coach['day2']['hiit'] = [];
                    $coach['day2']['stretching'] = $stretches;

//Day3 Exercise set
                    $coach['day3']['warmup'] = $warmUps;
                    $coach['day3']['is_completed'] = 0;
                    $coach['day3']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day3']['exercises'] = [];
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
                    $coach['day4']['workout'] = $sWorkout1;
                    $coach['day4']['coach_workout_rounds'] = count($coach['day4']['workout']['exercises']);
                    $coach['day4']['workout_intensity'] = 1;
                    $coach['day4']['hiit'] = $hiit;
                    $coach['day4']['stretching'] = $stretches;
                } elseif ($data['days'] == 5) {

//Day1 exercise set
                    $coach['day1']['warmup'] = $warmUps;
                    $coach['day1']['is_completed'] = 0;
                    $coach['day1']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
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
                    $coach['day2']['hiit'] = [];
                    $coach['day2']['stretching'] = $stretches;

//Day3 Exercise set
                    $coach['day3']['warmup'] = $warmUps;
                    $coach['day3']['is_completed'] = 0;
                    $coach['day3']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day3']['exercises'] = [];
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
                    $coach['day5']['workout'] = $sWorkout2;
                    $coach['day5']['coach_workout_rounds'] = count($coach['day5']['workout']['exercises']);
                    $coach['day5']['workout_intensity'] = 1;
                    $coach['day5']['hiit'] = $hiit;
                    $coach['day5']['stretching'] = $stretches;
                } elseif ($data['days'] == 6) {

//Day1 exercise set
                    $coach['day1']['warmup'] = $warmUps;
                    $coach['day1']['is_completed'] = 0;
                    $coach['day1']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
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
                    $coach['day2']['hiit'] = [];
                    $coach['day2']['stretching'] = $stretches;

//Day3 Exercise set
                    $coach['day3']['warmup'] = $warmUps;
                    $coach['day3']['is_completed'] = 0;
                    $coach['day3']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day3']['exercises'] = [];
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
                    $coach['day5']['workout'] = $sWorkout1;
                    $coach['day5']['coach_workout_rounds'] = count($coach['day5']['workout']['exercises']);
                    $coach['day5']['workout_intensity'] = 1;
                    $coach['day5']['hiit'] = [];
                    $coach['day5']['stretching'] = $stretches;

//Day5 Exercise set
                    $coach['day6']['warmup'] = $warmUps;
                    $coach['day6']['is_completed'] = 0;
                    $coach['day6']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day6']['exercises'] = [];
                    $coach['day6']['workout'] = $sWorkout2;
                    $coach['day6']['coach_workout_rounds'] = count($coach['day6']['workout']['exercises']);
                    $coach['day6']['workout_intensity'] = 1;
                    $coach['day6']['hiit'] = $hiit;
                    $coach['day6']['stretching'] = $stretches;
                }
            } elseif ($focus == 2) {

                if ($data['days'] == 2) {

//                  Day1 exercise set
                    $coach['day1']['warmup'] = $warmUps;
                    $coach['day1']['is_completed'] = 0;
                    $coach['day1']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day1']['exercises'] = [];
                    $coach['day1']['workout'] = $csWorkout1;
                    $coach['day1']['coach_workout_rounds'] = count($coach['day1']['workout']['exercises']);
                    $coach['day1']['workout_intensity'] = 1;
                    $coach['day1']['hiit'] = [];
                    $coach['day1']['stretching'] = $stretches;

//                  Day2 Exercise set
                    $coach['day2']['warmup'] = $warmUps;
                    $coach['day2']['is_completed'] = 0;
                    $coach['day2']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day2']['exercises'] = [];
                    $coach['day2']['workout'] = $sWorkout1;
                    $coach['day2']['coach_workout_rounds'] = count($coach['day2']['workout']['exercises']);
                    $coach['day2']['workout_intensity'] = 1;
                    $coach['day2']['hiit'] = $hiit;
                    $coach['day2']['stretching'] = $stretches;
                } elseif ($data['days'] == 3) {

//                  Day1 exercise set
                    $coach['day1']['warmup'] = $warmUps;
                    $coach['day1']['is_completed'] = 0;
                    $coach['day1']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day1']['exercises'] = [];
                    $coach['day1']['workout'] = $csWorkout1;
                    $coach['day1']['coach_workout_rounds'] = count($coach['day1']['workout']['exercises']);
                    $coach['day1']['workout_intensity'] = 1;
                    $coach['day1']['hiit'] = [];
                    $coach['day1']['stretching'] = $stretches;

//                  Day2 Exercise set
                    $coach['day2']['warmup'] = $warmUps;
                    $coach['day2']['is_completed'] = 0;
                    $coach['day2']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day2']['exercises'] = [];
                    $coach['day2']['workout'] = $sWorkout1;
                    $coach['day2']['coach_workout_rounds'] = count($coach['day2']['workout']['exercises']);
                    $coach['day2']['workout_intensity'] = 1;
                    $coach['day2']['hiit'] = [];
                    $coach['day2']['stretching'] = $stretches;

//                  Day3 Exercise set
                    $coach['day3']['warmup'] = $warmUps;
                    $coach['day3']['is_completed'] = 0;
                    $coach['day3']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day3']['exercises'] = [];
                    $coach['day3']['workout'] = $sWorkout2;
                    $coach['day3']['coach_workout_rounds'] = count($coach['day3']['workout']['exercises']);
                    $coach['day3']['workout_intensity'] = 1;
                    $coach['day3']['hiit'] = $hiit;
                    $coach['day3']['stretching'] = $stretches;
                } elseif ($data['days'] == 4) {

//                  Day1 exercise set
                    $coach['day1']['warmup'] = $warmUps;
                    $coach['day1']['is_completed'] = 0;
                    $coach['day1']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day1']['exercises'] = [];
                    $coach['day1']['workout'] = $csWorkout1;
                    $coach['day1']['coach_workout_rounds'] = count($coach['day1']['workout']['exercises']);
                    $coach['day1']['workout_intensity'] = 1;
                    $coach['day1']['hiit'] = [];
                    $coach['day1']['stretching'] = $stretches;

//                  Day2 Exercise set
                    $coach['day2']['warmup'] = $warmUps;
                    $coach['day2']['is_completed'] = 0;
                    $coach['day2']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day2']['exercises'] = [];
                    $coach['day2']['workout'] = $csWorkout2;
                    $coach['day2']['coach_workout_rounds'] = count($csWorkout2['exercises']);
                    $coach['day2']['workout_intensity'] = 1;
                    $coach['day2']['hiit'] = [];
                    $coach['day2']['stretching'] = $stretches;

//                  Day3 Exercise set
                    $coach['day3']['warmup'] = $warmUps;
                    $coach['day3']['is_completed'] = 0;
                    $coach['day3']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day3']['exercises'] = [];
                    $coach['day3']['workout'] = $sWorkout1;
                    $coach['day3']['coach_workout_rounds'] = count($coach['day3']['workout']['exercises']);
                    $coach['day3']['workout_intensity'] = 1;
                    $coach['day3']['hiit'] = [];
                    $coach['day3']['stretching'] = $stretches;

//                  Day4 Exercise set
                    $coach['day4']['warmup'] = $warmUps;
                    $coach['day4']['is_completed'] = 0;
                    $coach['day4']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day4']['exercises'] = [];
                    $coach['day4']['workout'] = $sWorkout2;
                    $coach['day4']['coach_workout_rounds'] = count($coach['day4']['workout']['exercises']);
                    $coach['day4']['workout_intensity'] = 1;
                    $coach['day4']['hiit'] = $hiit;
                    $coach['day4']['stretching'] = $stretches;
                } elseif ($data['days'] == 5) {

//                  Day1 exercise set
                    $coach['day1']['warmup'] = $warmUps;
                    $coach['day1']['is_completed'] = 0;
                    $coach['day1']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day1']['exercises'] = [];
                    $coach['day1']['workout'] = $csWorkout1;
                    $coach['day1']['coach_workout_rounds'] = count($coach['day1']['workout']['exercises']);
                    $coach['day1']['workout_intensity'] = 1;
                    $coach['day1']['hiit'] = [];
                    $coach['day1']['stretching'] = $stretches;

//                  Day2 Exercise set
                    $coach['day2']['warmup'] = $warmUps;
                    $coach['day2']['is_completed'] = 0;
                    $coach['day2']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day2']['exercises'] = [];
                    $coach['day2']['workout'] = $csWorkout2;
                    $coach['day2']['coach_workout_rounds'] = count($csWorkout2['exercises']);
                    $coach['day2']['workout_intensity'] = 1;
                    $coach['day2']['hiit'] = [];
                    $coach['day2']['stretching'] = $stretches;

//                  Day3 Exercise set
                    $coach['day3']['warmup'] = $warmUps;
                    $coach['day3']['is_completed'] = 0;
                    $coach['day3']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day3']['exercises'] = [];
                    $coach['day3']['workout'] = $csWorkout3;
                    $coach['day3']['coach_workout_rounds'] = count($coach['day3']['workout']['exercises']);
                    $coach['day3']['workout_intensity'] = 1;
                    $coach['day3']['hiit'] = [];
                    $coach['day3']['stretching'] = $stretches;

//                  Day4 Exercise set
                    $coach['day4']['warmup'] = $warmUps;
                    $coach['day4']['is_completed'] = 0;
                    $coach['day4']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day4']['exercises'] = [];
                    $coach['day4']['workout'] = $sWorkout1;
                    $coach['day4']['coach_workout_rounds'] = count($coach['day4']['workout']['exercises']);
                    $coach['day4']['workout_intensity'] = 1;
                    $coach['day4']['hiit'] = [];
                    $coach['day4']['stretching'] = $stretches;

//                  Day5 Exercise set
                    $coach['day5']['warmup'] = $warmUps;
                    $coach['day5']['is_completed'] = 0;
                    $coach['day5']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day5']['exercises'] = [];
                    $coach['day5']['workout'] = $sWorkout2;
                    $coach['day5']['coach_workout_rounds'] = count($coach['day5']['workout']['exercises']);
                    $coach['day5']['workout_intensity'] = 1;
                    $coach['day5']['hiit'] = $hiit;
                    $coach['day5']['stretching'] = $stretches;
                } elseif ($data['days'] == 6) {

//                  Day1 exercise set
                    $coach['day1']['warmup'] = $warmUps;
                    $coach['day1']['is_completed'] = 0;
                    $coach['day1']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day1']['exercises'] = [];
                    $coach['day1']['workout'] = $csWorkout1;
                    $coach['day1']['coach_workout_rounds'] = count($coach['day1']['workout']['exercises']);
                    $coach['day1']['workout_intensity'] = 1;
                    $coach['day1']['hiit'] = [];
                    $coach['day1']['stretching'] = $stretches;

//                  Day2 Exercise set
                    $coach['day2']['warmup'] = $warmUps;
                    $coach['day2']['is_completed'] = 0;
                    $coach['day2']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day2']['exercises'] = [];
                    $coach['day2']['workout'] = $csWorkout2;
                    $coach['day2']['coach_workout_rounds'] = count($coach['day2']['workout']['exercises']);
                    $coach['day2']['workout_intensity'] = 1;
                    $coach['day2']['hiit'] = [];
                    $coach['day2']['stretching'] = $stretches;

//                  Day3 Exercise set
                    $coach['day3']['warmup'] = $warmUps;
                    $coach['day3']['is_completed'] = 0;
                    $coach['day3']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day3']['exercises'] = [];
                    $coach['day3']['workout'] = $csWorkout3;
                    $coach['day3']['coach_workout_rounds'] = count($coach['day3']['workout']['exercises']);
                    $coach['day3']['workout_intensity'] = 1;
                    $coach['day3']['hiit'] = [];
                    $coach['day3']['stretching'] = $stretches;

//                  Day4 Exercise set
                    $coach['day4']['warmup'] = $warmUps;
                    $coach['day4']['is_completed'] = 0;
                    $coach['day4']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day4']['exercises'] = [];
                    $coach['day4']['workout'] = $sWorkout1;
                    $coach['day4']['coach_workout_rounds'] = count($coach['day4']['workout']['exercises']);
                    $coach['day4']['workout_intensity'] = 1;
                    $coach['day4']['hiit'] = [];
                    $coach['day4']['stretching'] = $stretches;

//                  Day5 Exercise set
                    $coach['day5']['warmup'] = $warmUps;
                    $coach['day5']['is_completed'] = 0;
                    $coach['day5']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day5']['exercises'] = [];
                    $coach['day5']['workout'] = $sWorkout2;
                    $coach['day5']['coach_workout_rounds'] = count($coach['day5']['workout']['exercises']);
                    $coach['day5']['workout_intensity'] = 1;
                    $coach['day5']['hiit'] = [];
                    $coach['day5']['stretching'] = $stretches;

//                  Day5 Exercise set
                    $coach['day6']['warmup'] = $warmUps;
                    $coach['day6']['is_completed'] = 0;
                    $coach['day6']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day6']['exercises'] = [];
                    $coach['day6']['workout'] = $sWorkout3;
                    $coach['day6']['coach_workout_rounds'] = count($coach['day6']['workout']['exercises']);
                    $coach['day6']['workout_intensity'] = 1;
                    $coach['day6']['hiit'] = $hiit;
                    $coach['day6']['stretching'] = $stretches;
                }
            } elseif ($focus == 3) {

                if ($data['days'] == 2) {

//                  Day1 exercise set
                    $coach['day1']['warmup'] = $warmUps;
                    $coach['day1']['is_completed'] = 0;
                    $coach['day1']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day1']['exercises'] = [];
                    $coach['day1']['workout'] = $sWorkout1;
                    $coach['day1']['coach_workout_rounds'] = count($coach['day1']['workout']['exercises']);
                    $coach['day1']['workout_intensity'] = 1;
                    $coach['day1']['hiit'] = [];
                    $coach['day1']['stretching'] = $stretches;

//                  Day2 Exercise set
                    $coach['day2']['warmup'] = $warmUps;
                    $coach['day2']['is_completed'] = 0;
                    $coach['day2']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day2']['exercises'] = [];
                    $coach['day2']['workout'] = $sWorkout2;
                    $coach['day2']['coach_workout_rounds'] = count($coach['day2']['workout']['exercises']);
                    $coach['day2']['workout_intensity'] = 1;
                    $coach['day2']['hiit'] = $hiit;
                    $coach['day2']['stretching'] = $stretches;
                } elseif ($data['days'] == 3) {

//                  Day1 exercise set
                    $coach['day1']['warmup'] = $warmUps;
                    $coach['day1']['is_completed'] = 0;
                    $coach['day1']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day1']['exercises'] = [];
                    $coach['day1']['workout'] = $sWorkout1;
                    $coach['day1']['coach_workout_rounds'] = count($coach['day1']['workout']['exercises']);
                    $coach['day1']['workout_intensity'] = 1;
                    $coach['day1']['hiit'] = [];
                    $coach['day1']['stretching'] = $stretches;

//                  Day2 Exercise set
                    $coach['day2']['warmup'] = $warmUps;
                    $coach['day2']['is_completed'] = 0;
                    $coach['day2']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day2']['exercises'] = [];
                    $coach['day2']['workout'] = $sWorkout2;
                    $coach['day2']['coach_workout_rounds'] = count($coach['day2']['workout']['exercises']);
                    $coach['day2']['workout_intensity'] = 1;
                    $coach['day2']['hiit'] = [];
                    $coach['day2']['stretching'] = $stretches;

//                  Day3 Exercise set
                    $coach['day3']['warmup'] = $warmUps;
                    $coach['day3']['is_completed'] = 0;
                    $coach['day3']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day3']['exercises'] = [];
                    $coach['day3']['workout'] = $sWorkout3;
                    $coach['day3']['coach_workout_rounds'] = count($coach['day3']['workout']['exercises']);
                    $coach['day3']['workout_intensity'] = 1;
                    $coach['day3']['hiit'] = $hiit;
                    $coach['day3']['stretching'] = $stretches;
                } elseif ($data['days'] == 4) {
//                  Day1 exercise set
                    $coach['day1']['warmup'] = $warmUps;
                    $coach['day1']['is_completed'] = 0;
                    $coach['day1']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day1']['exercises'] = [];
                    $coach['day1']['workout'] = $sWorkout1;
                    $coach['day1']['coach_workout_rounds'] = count($coach['day1']['workout']['exercises']);
                    $coach['day1']['workout_intensity'] = 1;
                    $coach['day1']['hiit'] = [];
                    $coach['day1']['stretching'] = $stretches;

//                  Day2 Exercise set
                    $coach['day2']['warmup'] = $warmUps;
                    $coach['day2']['is_completed'] = 0;
                    $coach['day2']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day2']['exercises'] = [];
                    $coach['day2']['workout'] = $sWorkout2;
                    $coach['day2']['coach_workout_rounds'] = count($coach['day2']['workout']['exercises']);
                    $coach['day2']['workout_intensity'] = 1;
                    $coach['day2']['hiit'] = [];
                    $coach['day2']['stretching'] = $stretches;

//                  Day3 Exercise set
                    $coach['day3']['warmup'] = $warmUps;
                    $coach['day3']['is_completed'] = 0;
                    $coach['day3']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day3']['exercises'] = [];
                    $coach['day3']['workout'] = $sWorkout3;
                    $coach['day3']['coach_workout_rounds'] = count($coach['day3']['workout']['exercises']);
                    $coach['day3']['workout_intensity'] = 1;
                    $coach['day3']['hiit'] = [];
                    $coach['day3']['stretching'] = $stretches;

//                  Day4 Exercise set
                    $coach['day4']['warmup'] = $warmUps;
                    $coach['day4']['is_completed'] = 0;
                    $coach['day4']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day4']['exercises'] = [];
                    $coach['day4']['workout'] = $sWorkout4;
                    $coach['day4']['coach_workout_rounds'] = count($coach['day4']['workout']['exercises']);
                    $coach['day4']['workout_intensity'] = 1;
                    $coach['day4']['hiit'] = $hiit;
                    $coach['day4']['stretching'] = $stretches;
                } elseif ($data['days'] == 5) {

//                  Day1 exercise set
                    $coach['day1']['warmup'] = $warmUps;
                    $coach['day1']['is_completed'] = 0;
                    $coach['day1']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day1']['exercises'] = [];
                    $coach['day1']['workout'] = $csWorkout1;
                    $coach['day1']['coach_workout_rounds'] = count($coach['day1']['workout']['exercises']);
                    $coach['day1']['workout_intensity'] = 1;
                    $coach['day1']['hiit'] = [];
                    $coach['day1']['stretching'] = $stretches;

//                  Day2 Exercise set
                    $coach['day2']['warmup'] = $warmUps;
                    $coach['day2']['is_completed'] = 0;
                    $coach['day2']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day2']['exercises'] = [];
                    $coach['day2']['workout'] = $sWorkout1;
                    $coach['day2']['coach_workout_rounds'] = count($coach['day2']['workout']['exercises']);
                    $coach['day2']['workout_intensity'] = 1;
                    $coach['day2']['hiit'] = [];
                    $coach['day2']['stretching'] = $stretches;

//                  Day3 Exercise set
                    $coach['day3']['warmup'] = $warmUps;
                    $coach['day3']['is_completed'] = 0;
                    $coach['day3']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day3']['exercises'] = [];
                    $coach['day3']['workout'] = $sWorkout2;
                    $coach['day3']['coach_workout_rounds'] = count($coach['day3']['workout']['exercises']);
                    $coach['day3']['workout_intensity'] = 1;
                    $coach['day3']['hiit'] = [];
                    $coach['day3']['stretching'] = $stretches;

//                  Day4 Exercise set
                    $coach['day4']['warmup'] = $warmUps;
                    $coach['day4']['is_completed'] = 0;
                    $coach['day4']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day4']['exercises'] = [];
                    $coach['day4']['workout'] = $sWorkout3;
                    $coach['day4']['coach_workout_rounds'] = count($coach['day4']['workout']['exercises']);
                    $coach['day4']['workout_intensity'] = 1;
                    $coach['day4']['hiit'] = [];
                    $coach['day4']['stretching'] = $stretches;

//                  Day5 Exercise set
                    $coach['day5']['warmup'] = $warmUps;
                    $coach['day5']['is_completed'] = 0;
                    $coach['day5']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day5']['exercises'] = [];
                    $coach['day5']['workout'] = $sWorkout4;
                    $coach['day5']['coach_workout_rounds'] = count($coach['day5']['workout']['exercises']);
                    $coach['day5']['workout_intensity'] = 1;
                    $coach['day5']['hiit'] = $hiit;
                    $coach['day5']['stretching'] = $stretches;
                } elseif ($data['days'] == 6) {

//                  Day1 exercise set
                    $coach['day1']['warmup'] = $warmUps;
                    $coach['day1']['is_completed'] = 0;
                    $coach['day1']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day1']['exercises'] = [];
                    $coach['day1']['workout'] = $csWorkout1;
                    $coach['day1']['coach_workout_rounds'] = count($coach['day1']['workout']['exercises']);
                    $coach['day1']['workout_intensity'] = 1;
                    $coach['day1']['hiit'] = [];
                    $coach['day1']['stretching'] = $stretches;

//                  Day2 Exercise set
                    $coach['day2']['warmup'] = $warmUps;
                    $coach['day2']['is_completed'] = 0;
                    $coach['day2']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day2']['exercises'] = [];
                    $coach['day2']['workout'] = $sWorkout1;
                    $coach['day2']['coach_workout_rounds'] = count($coach['day2']['workout']['exercises']);
                    $coach['day2']['workout_intensity'] = 1;
                    $coach['day2']['hiit'] = [];
                    $coach['day2']['stretching'] = $stretches;

//                  Day3 Exercise set
                    $coach['day3']['warmup'] = $warmUps;
                    $coach['day3']['is_completed'] = 0;
                    $coach['day3']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day3']['exercises'] = [];
                    $coach['day3']['workout'] = $sWorkout2;
                    $coach['day3']['coach_workout_rounds'] = count($coach['day3']['workout']['exercises']);
                    $coach['day3']['workout_intensity'] = 1;
                    $coach['day3']['hiit'] = [];
                    $coach['day3']['stretching'] = $stretches;

//                  Day4 Exercise set
                    $coach['day4']['warmup'] = $warmUps;
                    $coach['day4']['is_completed'] = 0;
                    $coach['day4']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day4']['exercises'] = [];
                    $coach['day4']['workout'] = $sWorkout3;
                    $coach['day4']['coach_workout_rounds'] = count($coach['day4']['workout']['exercises']);
                    $coach['day4']['workout_intensity'] = 1;
                    $coach['day4']['hiit'] = [];
                    $coach['day4']['stretching'] = $stretches;

//                  Day5 Exercise set
                    $coach['day5']['warmup'] = $warmUps;
                    $coach['day5']['is_completed'] = 0;
                    $coach['day5']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day5']['exercises'] = [];
                    $coach['day5']['workout'] = $sWorkout4;
                    $coach['day5']['coach_workout_rounds'] = count($coach['day5']['workout']['exercises']);
                    $coach['day5']['workout_intensity'] = 1;
                    $coach['day5']['hiit'] = [];
                    $coach['day5']['stretching'] = $stretches;

//                  Day6 Exercise set
                    $coach['day6']['warmup'] = $warmUps;
                    $coach['day6']['is_completed'] = 0;
                    $coach['day6']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day6']['exercises'] = [];
                    $coach['day6']['workout'] = $sWorkout5;
                    $coach['day6']['coach_workout_rounds'] = count($coach['day6']['workout']['exercises']);
                    $coach['day6']['workout_intensity'] = 1;
                    $coach['day6']['hiit'] = $hiit;
                    $coach['day6']['stretching'] = $stretches;
                }
            }
        }

        return $coach;
    }

    /**
     * Function to find the workout category 
     * @param type $userId
     * @param type $userWorkouts
     * @return int
     * @author Aneesh K<aneeshk@cubettech.com>
     */
    public static function userWorkoutCategory($userId, $userWorkouts)
    {
        $workoutInArray = [];
        foreach ($userWorkouts['strength'] as $sWorkouta) {
            $workoutInArray[] = $sWorkouta->id;
        }
        foreach ($userWorkouts['cardio_strength'] as $csWorkouta) {
            $workoutInArray[] = $csWorkouta->id;
        }

        $workoutExercises = DB::table('workout_exercises')->select('exercise_id')->whereIn('workout_id', $workoutInArray)->groupBy('exercise_id')->get();
        $workoutExercisesArray = Array();
        foreach ($workoutExercises as $workoutExercise) {
            $workoutExercisesArray[] = $workoutExercise->exercise_id;
        }

        $workoutExercises1 = DB::table('workout_exercises')
            ->select('exercise_id')
            ->whereRaw('category = 1')
            ->groupBy('exercise_id')
            ->get();

        foreach ($workoutExercises1 as $workoutExercise) {
            $workoutExercisesArray1[] = $workoutExercise->exercise_id;
        }

        $workoutExercises2 = DB::table('workout_exercises')
            ->select('exercise_id')
            ->whereRaw('category = 2')
            ->groupBy('exercise_id')
            ->get();

        foreach ($workoutExercises2 as $workoutExercise) {
            $workoutExercisesArray2[] = $workoutExercise->exercise_id;
        }



        $workoutExercises3 = DB::table('workout_exercises')
            ->select('exercise_id')
            ->whereRaw('category = 3')
            ->groupBy('exercise_id')
            ->get();

        foreach ($workoutExercises3 as $workoutExercise) {
            $workoutExercisesArray3[] = $workoutExercise->exercise_id;
        }

        $categoryArray[1] = DB::table('exercises')
            ->select(DB::raw('DISTINCT exercises.category, COUNT(*) catCount'))
            ->join('unlocked_skills', 'unlocked_skills.exercise_id', '=', 'exercises.id')
            ->whereIn('unlocked_skills.exercise_id', $workoutExercisesArray)
            ->where('exercises.category', 1)
            ->count();

        $categoryArray[2] = DB::table('exercises')
            ->select(DB::raw('DISTINCT exercises.category, COUNT(*) catCount'))
            ->join('unlocked_skills', 'unlocked_skills.exercise_id', '=', 'exercises.id')
            ->whereIn('unlocked_skills.exercise_id', $workoutExercisesArray)
            ->where('exercises.category', 2)
            ->count();

        $categoryArray[3] = DB::table('exercises')
            ->select(DB::raw('DISTINCT exercises.category, COUNT(*) catCount'))
            ->join('unlocked_skills', 'unlocked_skills.exercise_id', '=', 'exercises.id')
            ->whereIn('unlocked_skills.exercise_id', $workoutExercisesArray)
            ->where('exercises.category', 3)
            ->count();



        if ($categoryArray[3] > 0) {
            $category = 3;

            foreach ($workoutExercisesArray3 as $workoutExercise) {

                if ($category > 2) {
                    $exercise = Exercise::where('id', $workoutExercise)->first();

                    $unLocked = DB::table('unlocked_skills')
                        ->whereRaw('user_id = ' . $userId . ' AND exercise_id = ' . $workoutExercise)
                        ->first();

                    if (count($unLocked) <= 0) {

                        //Not unlocked the skill
                        $skill = DB::table('skills')->where('exercise_id', $workoutExercise)->first();

                        if ($skill->substitute > 0) {
                            //Skill has substitute
                            $substitute = DB::table('skills')->where('row', $skill->row)
                                ->where('progression_id', $skill->progression_id)
                                ->where('exercise_id', '=', $skill->substitute)
                                ->first();

                            $unLockCount = DB::table('unlocked_skills')
                                ->select('exercise_id')
                                ->whereRaw('user_id = ' . $userId . ' AND skill_id = ' . $substitute->id)
                                ->count();

                            if ($unLockCount == 0) {
                                //Unlocked substitute then replace the workout exercise with new one.
                                $category = 2;
                            }
                        } else {
                            //Skill doesn't have substitute, down the difficulty level
                            $category = 2;
                        }
                    }
                }
            }
        }


        if ($category == 2 && $categoryArray[2] > 0) {

            foreach ($workoutExercisesArray2 as $workoutExercise) {

                if ($category > 1) {

                    $exercise = Exercise::where('id', $workoutExercise)->first();

                    $unLocked = DB::table('unlocked_skills')
                        ->whereRaw('user_id = ' . $userId . ' AND exercise_id = ' . $workoutExercise)
                        ->first();

                    if (count($unLocked) <= 0) {

                        //Not unlocked the skill
                        $skill = DB::table('skills')->where('exercise_id', $workoutExercise)->first();

                        if ($skill->substitute > 0) {
                            //Skill has substitute
                            $substitute = DB::table('skills')->where('row', $skill->row)
                                ->where('progression_id', $skill->progression_id)
                                ->where('exercise_id', '=', $skill->substitute)
                                ->first();

                            $unLockCount = DB::table('unlocked_skills')
                                ->select('exercise_id')
                                ->whereRaw('user_id = ' . $userId . ' AND skill_id = ' . $substitute->id)
                                ->count();

                            if ($unLockCount == 0) {
                                //Unlocked substitute then replace the workout exercise with new one.
                                $category = 1;
                            }
                        } else {
                            //Skill doesn't have substitute, down the difficulty level
                            $category = 1;
                        }
                    }
                }
            }
        }

        if ($category == 1 && $categoryArray[1] > 0) {
            $category = 1;
        }

        return $category;
    }

    /**
     * Function to get workout with their exercises
     * @param type $workoutId
     * @param type $intenseFactor
     * @param type $userId
     * @param type $week
     * @param type $category
     * @return type
     * @author Aneesh K<aneeshk@cubettech.com>
     */
    public static function getWorkoutWithExercises($workoutId, $intenseFactor, $userId, $week, $category)
    {
        $workout = Workout::where('id', '=', $workoutId)->first();

        if ($week < 7) {
            $workoutIntensity = self::$workoutIntensityArray[1][$workout->id];
        } elseif ($week == 7) {
            $workoutIntensity = self::$workoutIntensityArray[2][$workout->id];
        } elseif ($week < 15) {
            $workoutIntensity = self::$workoutIntensityArray[3][$workout->id];
        } elseif ($week == 15) {
            $workoutIntensity = self::$workoutIntensityArray[4][$workout->id];
        } elseif ($week >= 16) {
            $workoutIntensity = self::$workoutIntensityArray[5][$workout->id];
        }

        $workoutIntensity = self::$workoutIntensityArray[1][$workout->id];

        $rounds = $workoutIntensity[$intenseFactor];

        $workout->is_completed = 0;

        if ($workoutIntensity[$intenseFactor] == 0) {
            foreach ($workoutIntensity as $aKey => $aValue) {
                if ($aKey > $intenseFactor && $aValue > 0) {
                    $rounds = $aValue;
                }
            }
        } else {
            $rounds = $workoutIntensity[$intenseFactor];
        }

        $count = 1;
        $exercises = [];

        $workoutExercises = DB::table('workout_exercises')->select('exercise_id')->whereRaw('workout_id = ' . $workoutId)->groupBy('exercise_id')->get();
        $workoutExercisesArray = Array();
        foreach ($workoutExercises as $workoutExercise) {
            $workoutExercisesArray[] = $workoutExercise->exercise_id;
        }

        $workoutExercises1 = DB::table('workout_exercises')
            ->select('exercise_id')
            ->whereRaw('workout_id = ' . $workoutId . ' AND category = 1')
            ->groupBy('exercise_id')
            ->get();

        foreach ($workoutExercises1 as $workoutExercise) {
            $workoutExercisesArray1[] = $workoutExercise->exercise_id;
        }

        $workoutExercises2 = DB::table('workout_exercises')
            ->select('exercise_id')
            ->whereRaw('workout_id = ' . $workoutId . ' AND category = 2')
            ->groupBy('exercise_id')
            ->get();

        foreach ($workoutExercises2 as $workoutExercise) {
            $workoutExercisesArray2[] = $workoutExercise->exercise_id;
        }



        $workoutExercises3 = DB::table('workout_exercises')
            ->select('exercise_id')
            ->whereRaw('workout_id = ' . $workoutId . ' AND category = 3')
            ->groupBy('exercise_id')
            ->get();

        foreach ($workoutExercises3 as $workoutExercise) {
            $workoutExercisesArray3[] = $workoutExercise->exercise_id;
        }

        $categoryArray[1] = DB::table('exercises')
            ->select(DB::raw('DISTINCT exercises.category, COUNT(*) catCount'))
            ->join('unlocked_skills', 'unlocked_skills.exercise_id', '=', 'exercises.id')
            ->whereIn('unlocked_skills.exercise_id', $workoutExercisesArray)
            ->where('exercises.category', 1)
            ->count();

        $categoryArray[2] = DB::table('exercises')
            ->select(DB::raw('DISTINCT exercises.category, COUNT(*) catCount'))
            ->join('unlocked_skills', 'unlocked_skills.exercise_id', '=', 'exercises.id')
            ->whereIn('unlocked_skills.exercise_id', $workoutExercisesArray)
            ->where('exercises.category', 2)
            ->count();

        $categoryArray[3] = DB::table('exercises')
            ->select(DB::raw('DISTINCT exercises.category, COUNT(*) catCount'))
            ->join('unlocked_skills', 'unlocked_skills.exercise_id', '=', 'exercises.id')
            ->whereIn('unlocked_skills.exercise_id', $workoutExercisesArray)
            ->where('exercises.category', 3)
            ->count();

        $replacementArray = Array();

        if ($category == 3) {
            foreach ($workoutExercisesArray3 as $workoutExercise) {

                $exercise = Exercise::where('id', $workoutExercise)->first();

                $unLocked = DB::table('unlocked_skills')
                    ->whereRaw('user_id = ' . $userId . ' AND exercise_id = ' . $workoutExercise)
                    ->first();

                if (count($unLocked) <= 0) {

                    //Not unlocked the skill
                    $skill = DB::table('skills')->where('exercise_id', $workoutExercise)->first();

                    if ($skill->substitute > 0) {
                        //Skill has substitute
                        $substitute = DB::table('skills')->where('row', $skill->row)
                            ->where('progression_id', $skill->progression_id)
                            ->where('exercise_id', '=', $skill->substitute)
                            ->first();

                        $unLockCount = DB::table('unlocked_skills')
                            ->select('exercise_id')
                            ->whereRaw('user_id = ' . $userId . ' AND skill_id = ' . $substitute->id)
                            ->count();

                        if ($unLockCount > 0) {
                            //Unlocked substitute then replace the workout exercise with new one.
                            $replacementArray[$workoutExercise] = $skill->substitute;
                        }
                    }
                }
            }
        }

        if ($category == 2) {
            foreach ($workoutExercisesArray2 as $workoutExercise) {

                $exercise = Exercise::where('id', $workoutExercise)->first();

                $unLocked = DB::table('unlocked_skills')
                    ->whereRaw('user_id = ' . $userId . ' AND exercise_id = ' . $workoutExercise)
                    ->first();

                if (count($unLocked) <= 0) {

                    //Not unlocked the skill
                    $skill = DB::table('skills')->where('exercise_id', $workoutExercise)->first();

                    if ($skill->substitute > 0) {
                        //Skill has substitute
                        $substitute = DB::table('skills')->where('row', $skill->row)
                            ->where('progression_id', $skill->progression_id)
                            ->where('exercise_id', '=', $skill->substitute)
                            ->first();

                        $unLockCount = DB::table('unlocked_skills')
                            ->select('exercise_id')
                            ->whereRaw('user_id = ' . $userId . ' AND skill_id = ' . $substitute->id)
                            ->count();

                        if ($unLockCount > 0) {
                            //Unlocked substitute then replace the workout exercise with new one.                            
                            $replacementArray[$workoutExercise] = $skill->substitute;
                        }
                    }
                } else {
                    $replacementArray[$workoutExercise] = $workoutExercise;
                }
            }
        }

        do {
            $roundExercises = Workoutexercise::where('round', '=', $count)
                ->where('category', '=', $category)
                ->where('workout_id', '=', $workoutId)
                ->with(['video', 'exercise'])
                ->get();

            foreach ($roundExercises as $roundExercise) {

                if (array_key_exists($roundExercise->exercise_id, $replacementArray)) {

                    $roundExercise->exercise_id = $replacementArray[$roundExercise->exercise_id];

                    $exercise = Exercise::where('id', $roundExercise->exercise_id)->with(['video'])->first();

                    $roundExercise->unit = $exercise->unit;

                    $roundExercise['exercise'] = $exercise;
                }

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

    /**
     * Intensify the workout rounds
     * @param type $workout
     * @param type $intensity
     * @return type
     * @deprecated since version 1.0
     * @author Aneesh K<aneeshk@cubettech.com>
     */
    public static function intensifyWorkout($workout, $intensity)
    {

        $roundCount = count($workout['exercises']);

        for ($i = $roundCount + 1; $i <= $roundCount + $intensity; $i++) {
            $workout['exercises']['round' . $i] = $workout['exercises']['round' . ($i - $roundCount)];
        }

        return $workout;
    }

    /**
     * Function to intensify workout exercises repititions by percentage.
     * @param type $roundExercises
     * @param type $increasePercent
     * @return type
     * @author Aneesh K<aneeshk@cubettech.com>
     */
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

    /**
     * Function to update coach after week exercises completed.
     * @depends updateCoachExercises
     * @param type $assessment
     * @param type $coachId
     * @param type $focus
     * @param type $days
     * @return type
     * @author Aneesh K<aneeshk@cubettech.com>
     */
    public static function updateCoach($assessment, $coachId, $focus, $days)
    {
        $coach = DB::table('coaches')->where('id', $coachId)->first();

        $exercises = self::updateCoachExercises($coach, $assessment, $focus, $days);


        return $exercises;
    }

    /**
     * Function to update coach after week exercises completed.
     * @depends getUserMatchedWorkoutsQuery
     * @depends increaseWorkoutBypercentage
     * @depends addExerciseToWorkout
     * @param type $coach
     * @param type $assessment
     * @param type $focus
     * @param type $days
     * @return type
     * @author Aneesh K<aneeshk@cubettech.com>
     */
    public static function updateCoachExercises($coach, $assessment, $focus, $days)
    {

        $coachStatus = DB::table('coach_status')->where('coach_id', $coach->id)->first();

        //Restructure coach and get new exercises and add exercises to existing workouts according to user feedback
        $i = 1;

        do {

            $fundumental = Fundumental::where('row', $i)->with(['exercise'])->get();

            $fundumentalArray[$i] = $fundumental->toArray();

            $i++;
            unset($fundumental);
        } while ($i <= 5);

        $warmUps = DB::table('warmups')->select('*')->get();

        if ($coach->category == 'beginer' || $coach->category == 'advanced') {
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

        $userLevel = $coach->category;

        if ($userLevel == 'professional') {
            $intenseFactor = 2;
            $stretchesArray = array_map(function($stretch) {
                $stretch['duration']['min'] = round($stretch['duration']['min'] + ($stretch['duration']['min'] * (25 / 100)));
                $stretch['duration']['max'] = round($stretch['duration']['max'] + ($stretch['duration']['max'] * (25 / 100)));
                return $stretch;
            }, $stretchesArray);
        } elseif ($userLevel == 'advanced') {
            $intenseFactor = 1;
        } elseif ($userLevel == 'beginer') {
            $intenseFactor = 0;
        }

        $data['user_id'] = $coach->user_id;
        $data['focus'] = $focus;
        $data['category'] = $coach->category;
        $data['muscle_groups'] = $coach->muscle_groups;
        $data['days'] = $days;
        $data['week'] = $coachStatus->week + 1;


        $userWorkouts['strength'] = DB::select(self::getUserMatchedWorkoutsQuery(1, $coach->user_id, $data, $intenseFactor, $fundumentalArray));

        $userWorkouts['cardio_strength'] = DB::select(self::getUserMatchedWorkoutsQuery(2, $coach->user_id, $data, $intenseFactor, $fundumentalArray));

        $exercises = self::getCoachForFocus($warmUps, $fundumentalArray, $stretchesArray, $data, $userWorkouts, $focus, $userLevel, $coachStatus->week + 1);

        if ($coachStatus->week + 1 <= 2) {
            if ($assessment == 3) {
                return $exercises;
            }
            //Just Increse the workout exercise amount by percentage
            $exercises = self::increaseWorkoutBypercentage($exercises, $assessment);

            return $exercises;
        } else {
            $exercises = self::addExerciseToWorkout($coach, $exercises, $assessment, $coachStatus->week + 1);

            return $exercises;
        }

        return $exercises;
    }

    /**
     * Function to increase workout exercise repititions as per the user assessment
     * @depends intensifyWorkoutPercentage
     * @param type $exercises
     * @param type $assessment
     * @return type
     * @author Aneesh K<aneeshk@cubettech.com>
     */
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

    /**
     * Function to get user matched workouts according to user unlocked skills, user raid, user muscle groups etc.
     * @param type $category
     * @param type $userId
     * @param type $data
     * @param type $userLevel
     * @param type $fundumentalArray
     * @return type
     * @author Aneesh K<aneeshk@cubettech.com>
     */
    public static function getUserMatchedWorkoutsQuery($category, $userId, $data, $userLevel, $fundumentalArray)
    {
        $whereQuery = '';

        $whereTestQuery = '';
        $testArray = [];
        $testString = '';

        $userUnlockedSkillExerciseQuery = DB::table('unlocked_skills')
            ->select('exercise_id')
            ->whereRaw('user_id = ' . $userId)
            ->toSql();


        $whereQuery .= 'exercise_id IN(' . $userUnlockedSkillExerciseQuery . ')';

        $userMuscleGroups = DB::table('user_physique_options')->where('user_id', $userId)->first();

        $whereSubQueryArray = [];

        if (!is_null($userMuscleGroups)) {
            if ($userMuscleGroups->physique_options != '') {
                $likeQueryArray = [];
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
                    $whereSubQueryArray[] = 'exercise_id IN(' . $userOptedMuscleExercisesQuery . ')';
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

                $whereSubQueryArray[] = 'exercise_id IN(' . $userOptedGoalExercisesQuery . ')';
            }
        }

        if (count($whereSubQueryArray) > 0) {
            $whereQuery .= 'AND (';

            $whereQuery .= implode(' OR ', $whereSubQueryArray);

            $whereQuery .= ')';
        }

        $selWorkouts = [];

        if (isset($data['week']) && $data['week'] <= 7) {
            if ($data['week'] == 1) {
                foreach (self::$workoutIntensityArray[1] as $wKey => $wValue) {
                    if ($userLevel == 0) {
                        if ($wValue[$userLevel] > 0) {
                            $selWorkouts[] = $wKey;
                        }
                    } else {
                        if ($wValue[$userLevel] > 0) {
                            $selWorkouts[] = $wKey;
                        }
                    }
                }
            } else {
                foreach (self::$workoutIntensityArray[1] as $wKey => $wValue) {
                    if ($wKey != 4 && $wKey != 6 && $wKey != 17) {
                        $selWorkouts[] = $wKey;
                    }
                }
            }
        }

        $selectedWorkouts = '';

        if (count($selWorkouts) > 0) {
            $selectedWorkouts .= ' AND t1.id IN(' . implode(",", $selWorkouts) . ')';
        }

        return 'SELECT t1.id, 
                        s.totalCount AS exercise_count 
                FROM workouts AS t1 
                        LEFT JOIN
                        (
                            SELECT DISTINCT  workout_id, COUNT(*) totalCount 
                            FROM    workout_exercises 
                            WHERE   ' . $whereQuery .
            ' GROUP BY workout_id
                        ) s ON s.workout_id = t1.id
                WHERE t1.category = ' . $category . $selectedWorkouts . '
                ORDER BY exercise_count DESC';
    }

    /**
     * Function to add exercises to an existing workout according to assessment, workout week etc.
     * @depends addRoundsOrExerciseToWorkout
     * @depends checkForHigherLimits
     * @param type $coach
     * @param type $exercises
     * @param type $assessment
     * @param type $week
     * @return type
     * @author Aneesh K<aneeshk@cubettech.com>
     */
    public static function addExerciseToWorkout($coach, $exercises, $assessment, $week)
    {
        if ($assessment == 1) {
            $increasePercent = 33;
        } else {
            $increasePercent = 10;
        }

        $doneExercises = [];

        foreach ($exercises as $eKey => $dayExercise) {
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

                    list($dayExercise['workout']['exercises'], $doneExercises) = self::addRoundsOrExerciseToWorkout($dayExercise['workout']['exercises'], $coach, $assessment, $week, $dayExercise['workout']['id'], $doneExercises);

                    $workoutExerciseRoundCount = count($dayExercise['workout']['exercises']);

                    $dayExercise['coach_workout_rounds'] = $workoutExerciseRoundCount;

                    $dayExercise['workout_intensity'] = ceil($workoutExerciseRoundCount / $dayExercise['workout']['rounds']);
                }
            }
            $exercises[$eKey] = $dayExercise;
        }

        if ($week > 15) {
            $exercises = self::checkForHigherLimits($exercises, ['focus' => $coach->focus]);
        }

        return $exercises;
    }

    /**
     * Function to Add rounds or exercise to an existing workout.
     * @param type $roundExercises
     * @param type $coach
     * @param type $assessment
     * @param type $week
     * @param type $workoutId
     * @param type $doneExercisesArray
     * @return type
     * @author Aneesh K<aneeshk@cubettech.com>
     */
    public static function addRoundsOrExerciseToWorkout($roundExercises, $coach, $assessment, $week, $workoutId, $doneExercisesArray = [])
    {
        $notInQuery = '';

        if (count($doneExercisesArray) > 0) {
            $doneExercises = implode(',', $doneExercisesArray);

            $notInQuery = ' AND exercises.id NOT IN(' . $doneExercises . ')';
        }

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
                    }

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

            return [$roundExercises, $doneExercisesArray];
        } elseif ($week == 7) {
            if ($assessment == 3) {
                $slab = 1;
            } elseif ($assessment == 2) {
                $slab = 1;
            } elseif ($assessment == 1) {
                $slab = 2;
            }

            $intensityArray = self::$workoutIntensityArray[2];
            $rounds = 0;
            if ($intensityArray[$workoutId][$slab] == 0) {
                for ($i = $slab; $i < count($intensityArray[$workoutId]); $i++) {
                    if ($intensityArray[$workoutId][$i] > 0) {
                        $rounds = $intensityArray[$workoutId][$i];
                        continue;
                    }
                }
                if ($rounds == 0) {
                    for ($j = $slab; $i <= 0; $j--) {
                        if ($intensityArray[$workoutId][$i] > 0) {
                            $rounds = $intensityArray[$workoutId][$i];
                            continue;
                        }
                    }
                }
            } else {
                $rounds = $intensityArray[$workoutId][$slab];
            }
//          Find the next round of the same workout and add to round exercises
            if ($rounds > 0) {
                $doneExercisesArray = [];
                for ($i = 1; $i <= $rounds; $i++) {
                    $newRoundExercises = Workoutexercise::where('round', '=', $i)
                        ->where('category', '=', $coach->focus)
                        ->where('workout_id', '=', $workoutId)
                        ->with(['video', 'exercise'])
                        ->get();

                    foreach ($newRoundExercises as $roundExercise) {
                        $roundExercise->is_completed = 0;
                    }

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

            return [$roundExercises, $doneExercisesArray];
        } elseif ($week >= 8 && $week < 15) {

            if ($coach->category == 'beginer') {
                if ($assessment == 3) {
                    $slab = 0;
                } elseif ($assessment == 2) {
                    $slab = 1;
                } elseif ($assessment == 1) {
                    $slab = 2;
                }
            } else {
                if ($assessment == 3) {
                    $slab = 2;
                } elseif ($assessment == 2) {
                    $slab = 3;
                } elseif ($assessment == 1) {
                    $slab = 4;
                }
            }

            $intensityArray = self::$workoutIntensityArray[3];
            $rounds = 0;
            if ($intensityArray[$workoutId][$slab] == 0) {
                for ($i = $slab; $i < count($intensityArray[$workoutId]); $i++) {
                    if ($intensityArray[$workoutId][$i] > 0) {
                        $rounds = $intensityArray[$workoutId][$i];
                        continue;
                    }
                }
                if ($rounds == 0) {
                    for ($j = $slab; $i <= 0; $j--) {
                        if ($intensityArray[$workoutId][$i] > 0) {
                            $rounds = $intensityArray[$workoutId][$i];
                            continue;
                        }
                    }
                }
            } else {
                $rounds = $intensityArray[$workoutId][$slab];
            }

            if ($slab < 2) {
                //Add rounds as per slab and add exercise to all rounds according to the user options
                if ($rounds > 0 && $workoutId != 18) {
                    for ($i = 1; $i <= $rounds; $i++) {
                        $newRoundExercises = Workoutexercise::where('round', '=', $i)
                            ->where('category', '=', $coach->focus)
                            ->where('workout_id', '=', $workoutId)
                            ->with(['video', 'exercise'])
                            ->get();

                        foreach ($newRoundExercises as $roundExercise) {
                            $roundExercise->is_completed = 0;
                        }

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
                } elseif ($rounds > 0 && $workoutId == 18) {

                    $roundCount = $rounds;
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

                    $roundExercises['round' . $rounds] = $newRoundExercises->toArray();
                }
            } else {
                if ($rounds > 0 && $workoutId != 18) {
                    for ($i = 1; $i <= $rounds; $i++) {
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
                } elseif ($rounds > 0 && $workoutId == 18) {

                    $roundCount = $rounds;
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

                    $roundExercises['round' . $rounds] = $newRoundExercises->toArray();
                }
            }
            return [$roundExercises, $doneExercisesArray];
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
            return [$roundExercises, $doneExercisesArray];
        } elseif ($week > 15) {
            if ($coach->category == 'beginer') {
                if ($assessment == 3) {
                    $slab = 0;
                } elseif ($assessment == 2) {
                    $slab = 1;
                } elseif ($assessment == 1) {
                    $slab = 2;
                }
            } else {
                if ($assessment == 3) {
                    $slab = 2;
                } elseif ($assessment == 2) {
                    $slab = 3;
                } elseif ($assessment == 1) {
                    $slab = 4;
                }
            }
            $intensityArray = self::$workoutIntensityArray[5];

            $rounds = 0;
            if ($intensityArray[$workoutId][$slab] == 0) {
                for ($i = $slab; $i < count($intensityArray[$workoutId]); $i++) {
                    if ($intensityArray[$workoutId][$i] > 0) {
                        $rounds = $intensityArray[$workoutId][$i];
                        continue;
                    }
                }
                if ($rounds == 0) {
                    for ($j = $slab; $i <= 0; $j--) {
                        if ($intensityArray[$workoutId][$i] > 0) {
                            $rounds = $intensityArray[$workoutId][$i];
                            continue;
                        }
                    }
                }
            } else {
                $rounds = $intensityArray[$workoutId][$slab];
            }

            if ($slab < 2) {
                //Add rounds as per slab and add exercise to all rounds according to the user options
                if ($rounds > 0 && $workoutId != 18) {
                    for ($i = 1; $i <= $rounds; $i++) {
                        $newRoundExercises = Workoutexercise::where('round', '=', $i)
                            ->where('category', '=', $coach->focus)
                            ->where('workout_id', '=', $workoutId)
                            ->with(['video', 'exercise'])
                            ->get();

                        foreach ($newRoundExercises as $roundExercise) {
                            $roundExercise->is_completed = 0;
                        }

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
                } elseif ($rounds > 0 && $workoutId == 18) {

                    $roundCount = $rounds;
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

                    $roundExercises['round' . $rounds] = $newRoundExercises->toArray();
                }
            } else {
                if ($rounds > 0 && $workoutId != 18) {
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
                } elseif ($rounds > 0 && $workoutId == 18) {

                    $roundCount = $rounds;
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
                    $roundExercises['round' . $rounds] = $newRoundExercises->toArray();
                }
            }

            return [$roundExercises, $doneExercisesArray];
        }
    }

    /**
     * Function to check for higher limits of each progression exercises and drop if exeeds
     * @depends getProgressionId
     * @param type $coachExercises
     * @param type $data
     * @return type
     * @author Aneesh K<aneeshk@cubettech.com>
     */
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

    /**
     * Function to get user basic skills according to user focus, musclegroups etc.
     * @param type $userId
     * @param type $muscleGroups
     * @param type $focus
     * @return type
     * @author Aneesh K<aneeshk@cubettech.com>
     */
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
            $likeQuery = ' OR (';
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

    /**
     * Function to limit exercises in each progression exercises.
     * @depends getProgressionId
     * @param type $coachExercises
     * @param type $data
     * @return type
     * @author Aneesh K<aneeshk@cubettech.com>
     */
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
                    if ($exercise->unit == 'times') {
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

    /**
     * Function to return progression id of an exercise
     * @param type $exerciseId
     * @return int
     * @author Aneesh K<aneeshk@cubettech.com>
     */
    public static function getProgressionId($exerciseId)
    {
        $progressionId = DB::table('skills')->where('exercise_id', $exerciseId)->pluck('progression_id');
        if (!is_null($progressionId)) {
            return $progressionId;
        } else {
            return 0;
        }
    }

    /**
     * Function to add additional user raid exercises
     * @param type $userId
     * @param type $coachExercises
     * @return type
     * @author Aneesh K<aneeshk@cubettech.com>
     */
    public static function addRaidExercisesToWorkouts($userId, $coachExercises)
    {
        $userRaid = DB::table('user_goal_options')->where('user_id', $userId)->first();

        if (!is_null($userRaid)) {
            foreach ($coachExercises as $day => $coachExercise) {
                if (isset($coachExercise['workout']) && !empty($coachExercise['workout']) && (!isset($coachExercise['hiit']) || empty($coachExercise['hiit']))) {
                    if ($coachExercise['workout']['category'] != 2) {
                        $skill = Skill::where('id', $userRaid->goal_options)->first();
                        $unlockedCnt = DB::table('unlocked_skills')
                            ->leftJoin('skills', 'unlocked_skills.skill_id', '=', 'skills.id')
                            ->where('skills.row', $skill->row)
                            ->where('unlocked_skills.user_id', $userId)
                            ->where('skills.progression_id', $skill->progression_id)
                            ->orderBy('skills.level', 'ASC')
                            ->count();
                        if ($unlockedCnt > 0) {
                            $unlocked = DB::table('unlocked_skills')
                                ->leftJoin('skills', 'unlocked_skills.skill_id', '=', 'skills.id')
                                ->where('skills.row', $skill->row)
                                ->where('skills.progression_id', $skill->progression_id)
                                ->where('unlocked_skills.user_id', $userId)
                                ->orderBy('skills.level', 'ASC')
                                ->get();
                            $roundCount = count($coachExercise['workout']['exercises']);
                            if ($roundCount == 1) {
                                foreach ($unlocked as $uKey => $unlockedExercise) {
                                    $exercise = Exercise::where('id', $unlockedExercise->exercise_id)->with(['video'])->first();
                                    if ($unlockedCnt == 1) {
                                        for ($j = 0; $j < 2; $j++) {
                                            $coachExercises[$day]['workout']['exercises']['round1'][] = [
                                                'workout_id' => $coachExercise['workout']['id'],
                                                'exercise' => $exercise->toArray(),
                                                'category' => $exercise->category,
                                                'repititions' => 25,
                                                'exercise_id' => $exercise->id,
                                                'unit' => $exercise->unit,
                                                'round' => 1,
                                                'is_completed' => 0
                                            ];
                                        }
                                    } elseif ($unlockedCnt > 1) {
                                        $reps = floor(50 / $unlockedCnt);
                                        $coachExercises[$day]['workout']['exercises']['round1'][] = [
                                            'workout_id' => $coachExercise['workout']['id'],
                                            'exercise' => $exercise->toArray(),
                                            'category' => $exercise->category,
                                            'repititions' => $reps,
                                            'exercise_id' => $exercise->id,
                                            'unit' => $exercise->unit,
                                            'round' => 1,
                                            'is_completed' => 0
                                        ];
                                    }
                                }
                            } elseif ($roundCount > 1) {
                                foreach ($unlocked as $uKey => $unlockedExercise) {
                                    $exercise = Exercise::where('id', $unlockedExercise->exercise_id)->with(['video'])->first();
                                    for ($i = 1; $i <= $roundCount; $i++) {
                                        if ($unlockedCnt == 1) {
                                            for ($j = 0; $j < 2; $j++) {
                                                $coachExercises[$day]['workout']['exercises']['round' . $i][] = [
                                                    'workout_id' => $coachExercise['workout']['id'],
                                                    'exercise' => $exercise->toArray(),
                                                    'category' => $exercise->category,
                                                    'repititions' => 25,
                                                    'exercise_id' => $exercise->id,
                                                    'unit' => $exercise->unit,
                                                    'round' => $i,
                                                    'is_completed' => 0
                                                ];
                                            }
                                        } elseif ($unlockedCnt > 1) {
                                            $reps = floor(50 / $unlockedCnt);
                                            $coachExercises[$day]['workout']['exercises']['round' . $i][] = [
                                                'workout_id' => $coachExercise['workout']['id'],
                                                'exercise' => $exercise->toArray(),
                                                'category' => $exercise->category,
                                                'repititions' => $reps,
                                                'exercise_id' => $exercise->id,
                                                'unit' => $exercise->unit,
                                                'round' => $i,
                                                'is_completed' => 0
                                            ];
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
        return $coachExercises;
    }
}
