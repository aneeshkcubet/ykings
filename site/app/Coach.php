<?php namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use DB;
use App\Exercise;
use App\Fundumental;
use App\Stretching;
use App\Musclegroup;
use App\Skill;
use App\Workout;
use App\Workoutexercise;
use App\Skilltraining;
use App\Skilltrainingexercise;
use App\Skilltraininguser;

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
        'limitations',
        'feedback'
    ];
    protected $appends = ['musclegroup_string', 'goaloption_string'];
    public static $workoutIntensityArray = [
        1 => [
            1 => [0 => 2, 1 => 3, 2 => 4],
            2 => [0 => 2, 1 => 3, 2 => 3],
            3 => [0 => 2, 1 => 3, 2 => 4],
            4 => [0 => 1, 1 => 1, 2 => 1],
            6 => [0 => 1, 1 => 1, 2 => 1],
            7 => [0 => 2, 1 => 4, 2 => 5],
            8 => [0 => 2, 1 => 3, 2 => 4],
            9 => [0 => 2, 1 => 3, 2 => 4],
            10 => [0 => 2, 1 => 3, 2 => 3],
            11 => [0 => 2, 1 => 3, 2 => 3],
            12 => [0 => 1, 1 => 1, 2 => 1],
            13 => [0 => 1, 1 => 1, 2 => 1]
        ],
        2 => [
            1 => [0 => 2, 1 => 3, 2 => 4],
            2 => [0 => 2, 1 => 3, 2 => 3],
            3 => [0 => 2, 1 => 3, 2 => 4],
            4 => [0 => 1, 1 => 1, 2 => 1],
            6 => [0 => 1, 1 => 1, 2 => 1],
            7 => [0 => 2, 1 => 4, 2 => 5],
            8 => [0 => 2, 1 => 3, 2 => 4],
            9 => [0 => 2, 1 => 3, 2 => 4],
            10 => [0 => 2, 1 => 3, 2 => 3],
            11 => [0 => 2, 1 => 3, 2 => 3],
            12 => [0 => 1, 1 => 1, 2 => 1],
            13 => [0 => 1, 1 => 1, 2 => 1]
        ],
        3 => [
            1 => [0 => 2, 1 => 3, 2 => 5, 3 => 5],
            2 => [0 => 2, 1 => 3, 2 => 3, 3 => 3],
            3 => [0 => 3, 1 => 4, 2 => 5, 3 => 5],
            4 => [0 => 1, 1 => 1, 2 => 1, 3 => 1],
            6 => [0 => 1, 1 => 1, 2 => 1, 3 => 1],
            7 => [0 => 3, 1 => 4, 2 => 5, 3 => 6],
            8 => [0 => 2, 1 => 3, 2 => 4, 3 => 4],
            9 => [0 => 2, 1 => 3, 2 => 4, 3 => 4],
            10 => [0 => 2, 1 => 3, 2 => 3, 3 => 3],
            11 => [0 => 2, 1 => 3, 2 => 3, 3 => 3],
            12 => [0 => 1, 1 => 1, 2 => 1, 3 => 1],
            13 => [0 => 1, 1 => 1, 2 => 1, 3 => 1]
        ],
        4 => [
            1 => [0 => 5],
            2 => [0 => 3],
            3 => [0 => 5],
            4 => [0 => 1],
            5 => [0 => 1],
            6 => [0 => 1],
            7 => [0 => 6],
            8 => [0 => 4],
            9 => [0 => 4],
            10 => [0 => 3],
            11 => [0 => 3],
            12 => [0 => 1],
            13 => [0 => 1]
        ],
        5 => [
            1 => [0 => 2, 1 => 3, 2 => 5, 3 => 5],
            2 => [0 => 2, 1 => 3, 2 => 3, 3 => 3],
            3 => [0 => 3, 1 => 4, 2 => 5, 3 => 5],
            4 => [0 => 1, 1 => 1, 2 => 1, 3 => 1],
            6 => [0 => 1, 1 => 1, 2 => 1, 3 => 1],
            7 => [0 => 3, 1 => 4, 2 => 6, 3 => 6],
            8 => [0 => 2, 1 => 3, 2 => 4, 3 => 4],
            9 => [0 => 2, 1 => 3, 2 => 4, 3 => 4],
            10 => [0 => 2, 1 => 3, 2 => 3, 3 => 3],
            11 => [0 => 2, 1 => 3, 2 => 3, 3 => 3],
            12 => [0 => 1, 1 => 1, 2 => 1, 3 => 1],
            13 => [0 => 1, 1 => 1, 2 => 1, 3 => 1]
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

        $tests = json_decode($data['feedback'], true);
        $passed = 1;
        $notdoneCnt = $userRaidSelected = 0;
        foreach ($tests as $test) {
            if ($test == 3 || $test == 0) {
                $passed = 0;
                $notdoneCnt++;
                break;
            }
        }

        $userGoalOption = DB::table('user_goal_options')->where('user_id', $data['user_id'])->first();

        if (!is_null($userGoalOption)) {
            if ($userGoalOption->goal_options != '') {
                $userRaidSelected = 1;
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
            $stretchesArray = array_map(function($stretch) {
                $stretch['duration']['min'] = round($stretch['duration']['min'] + ($stretch['duration']['min'] * (25 / 100)));
                $stretch['duration']['max'] = round($stretch['duration']['max'] + ($stretch['duration']['max'] * (25 / 100)));
                return $stretch;
            }, $stretchesArray);
        }

        $feedbacks = json_decode($data['feedback'], true);

        $intenseFactor = 2;

        foreach ($feedbacks as $feedback) {
            if ($feedback == 1) {
                continue;
            } elseif ($feedback == 2) {
                $intenseFactor = 1;
                break;
            }
        }

        foreach ($feedbacks as $feedback) {
            if ($feedback == 2) {
                continue;
            } elseif ($feedback == 3) {
                $intenseFactor = 0;
                break;
            }
        }

        $focus = $data['focus'];

        $userWorkouts['strength'] = DB::select(self::getUserMatchedWorkoutsQuery(1, $data['user_id'], $data, $intenseFactor, $fundumentalArray));

        $userWorkouts['cardio_strength'] = DB::select(self::getUserMatchedWorkoutsQuery(2, $data['user_id'], $data, $intenseFactor, $fundumentalArray));
        if ($notdoneCnt > 0) {
            if ($focus == 1) {
                if ($data['days'] == 2) {
                    if (count($userWorkouts['cardio_strength']) < 2) {
                        return false;
                    }
                } elseif ($data['days'] == 3) {
                    if (count($userWorkouts['cardio_strength']) < 2 && count($userWorkouts['strength']) < 1) {
                        return false;
                    }
                } elseif ($data['days'] == 4) {
                    if (count($userWorkouts['cardio_strength']) < 3 && count($userWorkouts['strength']) < 1) {
                        return false;
                    }
                } elseif ($data['days'] == 5) {
                    if (count($userWorkouts['cardio_strength']) < 3 && count($userWorkouts['strength']) < 2) {
                        return false;
                    }
                }
            } elseif ($focus == 2) {
                if ($data['days'] == 2) {
                    if (count($userWorkouts['cardio_strength']) < 1 && count($userWorkouts['strength']) < 1) {
                        return false;
                    }
                } elseif ($data['days'] == 3) {
                    if (count($userWorkouts['cardio_strength']) < 1 && count($userWorkouts['strength']) < 2) {
                        return false;
                    }
                } elseif ($data['days'] == 4) {
                    if (count($userWorkouts['cardio_strength']) < 2 && count($userWorkouts['strength']) < 2) {
                        return false;
                    }
                } elseif ($data['days'] == 5) {
                    if (count($userWorkouts['cardio_strength']) < 2 && count($userWorkouts['strength']) < 3) {
                        return false;
                    }
                }
            } elseif ($focus == 3) {
                if ($data['days'] == 2) {
                    if (count($userWorkouts['strength']) < 2) {
                        return false;
                    }
                } elseif ($data['days'] == 3) {
                    if (count($userWorkouts['strength']) < 3) {
                        return false;
                    }
                } elseif ($data['days'] == 4) {
                    if (count($userWorkouts['strength']) < 4) {
                        return false;
                    }
                } elseif ($data['days'] == 5) {
                    if (count($userWorkouts['strength']) < 5) {
                        return false;
                    }
                }
            }

            list($coach, $exerciseCat) = self::getCoachForFocus($warmUps, $fundumentalArray, $stretchesArray, $data, $userWorkouts, $focus, $userLevel, 1, $intenseFactor);
        } else {
            if ($focus == 1) {
                if ($data['days'] == 2) {
                    if (count($userWorkouts['cardio_strength']) < 1) {
                        return false;
                    }
                } elseif ($data['days'] == 3) {
                    if (count($userWorkouts['cardio_strength']) < 2) {
                        return false;
                    }
                } elseif ($data['days'] == 4) {
                    if (count($userWorkouts['cardio_strength']) < 2) {
                        return false;
                    }
                } elseif ($data['days'] == 5) {
                    if (count($userWorkouts['cardio_strength']) < 3) {
                        return false;
                    }
                }
            } elseif ($focus == 2) {
                if ($data['days'] == 2) {
                    if (count($userWorkouts['strength']) < 1) {
                        return false;
                    }
                } elseif ($data['days'] == 3) {
                    if (count($userWorkouts['cardio_strength']) < 1 && count($userWorkouts['strength']) < 1) {
                        return false;
                    }
                } elseif ($data['days'] == 4) {
                    if (count($userWorkouts['cardio_strength']) < 1 && count($userWorkouts['strength']) < 1) {
                        return false;
                    }
                } elseif ($data['days'] == 5) {
                    if (count($userWorkouts['cardio_strength']) < 2 && count($userWorkouts['strength']) < 1) {
                        return false;
                    }
                }
            } elseif ($focus == 3) {
                if ($data['days'] == 3) {
                    if (count($userWorkouts['strength']) < 1) {
                        return false;
                    }
                } elseif ($data['days'] == 4) {
                    if (count($userWorkouts['strength']) < 2) {
                        return false;
                    }
                } elseif ($data['days'] == 5) {
                    if (count($userWorkouts['strength']) < 2) {
                        return false;
                    }
                }
            }

            list($coach, $exerciseCat) = self::getCoachForFocusUpdate($warmUps, $fundumentalArray, $stretchesArray, $data, $userWorkouts, $focus, $userLevel, 1, $intenseFactor);
        }
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
    public static function getCoachForFocus($warmUps, $fundumentalArray, $stretches, $data, $userWorkouts, $focus, $userLevel, $week, $intenseFactor)
    {

        $coach = [];
        if ($userLevel == 'professional') {
            $intenseFactor = 2;
            $exerciseCat = 3;
        } elseif ($userLevel == 'advanced') {
            $intenseFactor = 1;
            $exerciseCat = 2;
        } elseif ($userLevel == 'beginer') {
            $intenseFactor = 0;
            $exerciseCat = 1;
        }

        $hiitReplacements = [
            1 => [
                ['round1' => [
                        ['name' => 'Burpee Pushups', 'duration' => 15, 'unit' => 'times'],
                        ['name' => 'Tucked Plank (SH)', 'duration' => 30, 'unit' => 'seconds']
                    ],
                    'round2' => [
                        ['name' => 'Jumping Lunges', 'duration' => 50, 'unit' => 'times'],
                        ['name' => 'Plank (SH)', 'duration' => 30, 'unit' => 'seconds']
                    ]
                ]
            ],
            2 => [
                ['round1' => [
                        ['name' => 'Burpee Pushups', 'duration' => 10, 'unit' => 'times'],
                        ['name' => 'Rest', 'duration' => 10, 'unit' => 'seconds']
                    ],
                    'round2' => [
                        ['name' => 'Squat Jumps', 'duration' => 15, 'unit' => 'times'],
                        ['name' => 'Rest', 'duration' => 10, 'unit' => 'seconds']
                    ],
                    'round3' => [
                        ['name' => 'Mountain Climbers', 'duration' => 30, 'unit' => 'times'],
                        ['name' => 'Rest', 'duration' => 10, 'unit' => 'seconds']
                    ]
                ]
            ],
            3 => [
                ['round1' => [
                        ['name' => 'Tuck Jump Burpees', 'duration' => 25, 'unit' => 'times'],
                        ['name' => 'Jumping Lunges', 'duration' => 50, 'unit' => 'times'],
                        ['name' => 'Mountain Climbers', 'duration' => 50, 'unit' => 'times']
                    ]
                ]
            ]
        ];

        // hiit 1 - 30/30, 2 - 20/10, 3 - 60/120

        $hiitReplacements = array_map(function($hiitReplacement) {
            $hiitReplacement = array_map(function($roundExercises) {
                $roundExercises = array_map(function($roundExercise) {
                    foreach ($roundExercise as $exerciseSet) {
                        $exercise = Exercise::where('name', '=', $exerciseSet['name'])->with(['video'])->first();
                        $exerciseSet['exercise'] = $exercise->toArray();
                        $exercises[] = $exerciseSet;
                    }
                    return $exercises;
                }, $roundExercises);
                return $roundExercises;
            }, $hiitReplacement);
            return $hiitReplacement;
        }, $hiitReplacements);

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

        $basicSkills = self::getUserBasicSkills($data['user_id'], $data['muscle_groups'], $data['limitations']);

        $exercises = [];
        foreach ($basicSkills as $bKey => $basicSkill) {
            $exercise = Exercise::where('id', $basicSkill->exercise_id)->with(['video'])->first();
            if (!is_null($exercise)) {
                $exercise->is_completed = 0;
                $exercises[] = $exercise;
            }
        }
        if ($focus == 1) {
            if ($data['days'] == 2) {

                $csWorkout1 = self::getWorkoutWithExercises($userWorkouts['cardio_strength'][0]->id, $intenseFactor, $data['user_id'], $week);

                $csWorkout2 = self::getWorkoutWithExercises($userWorkouts['cardio_strength'][1]->id, $intenseFactor, $data['user_id'], $week);

//                  Day1 exercise set
                $coach['day1']['warmup'] = $warmUps;
                $coach['day1']['is_completed'] = 0;
                $coach['day1']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                $coach['day1']['exercises'] = [];
                $coach['day1']['workout'] = $csWorkout1;
                $coach['day1']['skilltraining'] = [];
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
                $coach['day2']['skilltraining'] = [];
                $coach['day2']['coach_workout_rounds'] = count($coach['day2']['workout']['exercises']);
                $coach['day2']['workout_intensity'] = 1;
                $coach['day2']['hiit'] = $hiit;
                $coach['day2']['stretching'] = $stretches;
            } elseif ($data['days'] == 3) {

                $csWorkout1 = self::getWorkoutWithExercises($userWorkouts['cardio_strength'][0]->id, $intenseFactor, $data['user_id'], $week);

                $csWorkout2 = self::getWorkoutWithExercises($userWorkouts['cardio_strength'][1]->id, $intenseFactor, $data['user_id'], $week);

                $sWorkout1 = self::getWorkoutWithExercises($userWorkouts['strength'][0]->id, $intenseFactor, $data['user_id'], $week);

//                  Day1 exercise set
                $coach['day1']['warmup'] = $warmUps;
                $coach['day1']['is_completed'] = 0;
                $coach['day1']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                $coach['day1']['exercises'] = [];
                $coach['day1']['workout'] = $csWorkout1;
                $coach['day1']['skilltraining'] = [];
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
                $coach['day2']['skilltraining'] = [];
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
                $coach['day3']['skilltraining'] = [];
                $coach['day3']['coach_workout_rounds'] = count($csWorkout2['exercises']);
                $coach['day3']['workout_intensity'] = 1;
                $coach['day3']['hiit'] = $hiit;
                $coach['day3']['stretching'] = $stretches;
            } elseif ($data['days'] == 4) {
                $csWorkout1 = self::getWorkoutWithExercises($userWorkouts['cardio_strength'][0]->id, $intenseFactor, $data['user_id'], $week);

                $csWorkout2 = self::getWorkoutWithExercises($userWorkouts['cardio_strength'][1]->id, $intenseFactor, $data['user_id'], $week);

                $csWorkout3 = self::getWorkoutWithExercises($userWorkouts['cardio_strength'][2]->id, $intenseFactor, $data['user_id'], $week);

                $sWorkout1 = self::getWorkoutWithExercises($userWorkouts['strength'][0]->id, $intenseFactor, $data['user_id'], $week);
//                  Day1 exercise set
                $coach['day1']['warmup'] = $warmUps;
                $coach['day1']['is_completed'] = 0;
                $coach['day1']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                $coach['day1']['exercises'] = [];
                $coach['day1']['workout'] = $csWorkout1;
                $coach['day1']['skilltraining'] = [];
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
                $coach['day2']['skilltraining'] = [];
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
                $coach['day3']['skilltraining'] = [];
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
                $coach['day4']['skilltraining'] = [];
                $coach['day4']['coach_workout_rounds'] = count($coach['day4']['workout']['exercises']);
                $coach['day4']['workout_intensity'] = 1;
                $coach['day4']['hiit'] = $hiit;
                $coach['day4']['stretching'] = $stretches;
            } elseif ($data['days'] == 5) {

                $csWorkout1 = self::getWorkoutWithExercises($userWorkouts['cardio_strength'][0]->id, $intenseFactor, $data['user_id'], $week);

                $csWorkout2 = self::getWorkoutWithExercises($userWorkouts['cardio_strength'][1]->id, $intenseFactor, $data['user_id'], $week);

                $csWorkout3 = self::getWorkoutWithExercises($userWorkouts['cardio_strength'][2]->id, $intenseFactor, $data['user_id'], $week);

                $sWorkout1 = self::getWorkoutWithExercises($userWorkouts['strength'][0]->id, $intenseFactor, $data['user_id'], $week);

                $sWorkout2 = self::getWorkoutWithExercises($userWorkouts['strength'][1]->id, $intenseFactor, $data['user_id'], $week);

//                  Day1 exercise set
                $coach['day1']['warmup'] = $warmUps;
                $coach['day1']['is_completed'] = 0;
                $coach['day1']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                $coach['day1']['exercises'] = [];
                $coach['day1']['workout'] = $csWorkout1;
                $coach['day1']['skilltraining'] = [];
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
                $coach['day2']['skilltraining'] = [];
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
                $coach['day3']['skilltraining'] = [];
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
                $coach['day4']['skilltraining'] = [];
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
                $coach['day5']['skilltraining'] = [];
                $coach['day5']['coach_workout_rounds'] = count($coach['day5']['workout']['exercises']);
                $coach['day5']['workout_intensity'] = 1;
                $coach['day5']['hiit'] = $hiit;
                $coach['day5']['stretching'] = $stretches;
            }
        } elseif ($focus == 2) {

            if ($data['days'] == 2) {

                $csWorkout1 = self::getWorkoutWithExercises($userWorkouts['cardio_strength'][0]->id, $intenseFactor, $data['user_id'], $week);

                $sWorkout1 = self::getWorkoutWithExercises($userWorkouts['strength'][0]->id, $intenseFactor, $data['user_id'], $week);

//                  Day1 exercise set
                $coach['day1']['warmup'] = $warmUps;
                $coach['day1']['is_completed'] = 0;
                $coach['day1']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                $coach['day1']['exercises'] = [];
                $coach['day1']['workout'] = $csWorkout1;
                $coach['day1']['skilltraining'] = [];
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
                $coach['day2']['skilltraining'] = [];
                $coach['day2']['coach_workout_rounds'] = count($coach['day2']['workout']['exercises']);
                $coach['day2']['workout_intensity'] = 1;
                $coach['day2']['hiit'] = $hiit;
                $coach['day2']['stretching'] = $stretches;
            } elseif ($data['days'] == 3) {

                $csWorkout1 = self::getWorkoutWithExercises($userWorkouts['cardio_strength'][0]->id, $intenseFactor, $data['user_id'], $week);

                $sWorkout1 = self::getWorkoutWithExercises($userWorkouts['strength'][0]->id, $intenseFactor, $data['user_id'], $week);

                $sWorkout2 = self::getWorkoutWithExercises($userWorkouts['strength'][1]->id, $intenseFactor, $data['user_id'], $week);

//                  Day1 exercise set
                $coach['day1']['warmup'] = $warmUps;
                $coach['day1']['is_completed'] = 0;
                $coach['day1']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                $coach['day1']['exercises'] = [];
                $coach['day1']['workout'] = $csWorkout1;
                $coach['day1']['skilltraining'] = [];
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
                $coach['day2']['skilltraining'] = [];
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
                $coach['day3']['skilltraining'] = [];
                $coach['day3']['coach_workout_rounds'] = count($coach['day3']['workout']['exercises']);
                $coach['day3']['workout_intensity'] = 1;
                $coach['day3']['hiit'] = $hiit;
                $coach['day3']['stretching'] = $stretches;
            } elseif ($data['days'] == 4) {

                $csWorkout1 = self::getWorkoutWithExercises($userWorkouts['cardio_strength'][0]->id, $intenseFactor, $data['user_id'], $week);

                $csWorkout2 = self::getWorkoutWithExercises($userWorkouts['cardio_strength'][1]->id, $intenseFactor, $data['user_id'], $week);

                $sWorkout1 = self::getWorkoutWithExercises($userWorkouts['strength'][0]->id, $intenseFactor, $data['user_id'], $week);

                $sWorkout2 = self::getWorkoutWithExercises($userWorkouts['strength'][1]->id, $intenseFactor, $data['user_id'], $week);


//                  Day1 exercise set
                $coach['day1']['warmup'] = $warmUps;
                $coach['day1']['is_completed'] = 0;
                $coach['day1']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                $coach['day1']['exercises'] = [];
                $coach['day1']['workout'] = $csWorkout1;
                $coach['day1']['skilltraining'] = [];
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
                $coach['day2']['skilltraining'] = [];
                $coach['day2']['coach_workout_rounds'] = count($coach['day2']['workout']['exercises']);
                $coach['day2']['workout_intensity'] = 1;
                $coach['day2']['hiit'] = [];
                $coach['day2']['stretching'] = $stretches;

//                  Day3 Exercise set
                $coach['day3']['warmup'] = $warmUps;
                $coach['day3']['is_completed'] = 0;
                $coach['day3']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                $coach['day3']['exercises'] = [];
                $coach['day3']['workout'] = $csWorkout2;
                $coach['day3']['skilltraining'] = [];
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
                $coach['day4']['skilltraining'] = [];
                $coach['day4']['coach_workout_rounds'] = count($coach['day4']['workout']['exercises']);
                $coach['day4']['workout_intensity'] = 1;
                $coach['day4']['hiit'] = $hiit;
                $coach['day4']['stretching'] = $stretches;
            } elseif ($data['days'] == 5) {

                $csWorkout1 = self::getWorkoutWithExercises($userWorkouts['cardio_strength'][0]->id, $intenseFactor, $data['user_id'], $week);

                $csWorkout2 = self::getWorkoutWithExercises($userWorkouts['cardio_strength'][1]->id, $intenseFactor, $data['user_id'], $week);


                $sWorkout1 = self::getWorkoutWithExercises($userWorkouts['strength'][0]->id, $intenseFactor, $data['user_id'], $week);

                $sWorkout2 = self::getWorkoutWithExercises($userWorkouts['strength'][1]->id, $intenseFactor, $data['user_id'], $week);

                $sWorkout3 = self::getWorkoutWithExercises($userWorkouts['strength'][2]->id, $intenseFactor, $data['user_id'], $week);

//                  Day1 exercise set
                $coach['day1']['warmup'] = $warmUps;
                $coach['day1']['is_completed'] = 0;
                $coach['day1']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                $coach['day1']['exercises'] = [];
                $coach['day1']['workout'] = $csWorkout1;
                $coach['day1']['skilltraining'] = [];
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
                $coach['day2']['skilltraining'] = [];
                $coach['day2']['coach_workout_rounds'] = count($coach['day2']['workout']['exercises']);
                $coach['day2']['workout_intensity'] = 1;
                $coach['day2']['hiit'] = $hiit;
                $coach['day2']['stretching'] = $stretches;

//                  Day3 Exercise set
                $coach['day3']['warmup'] = $warmUps;
                $coach['day3']['is_completed'] = 0;
                $coach['day3']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                $coach['day3']['exercises'] = [];
                $coach['day3']['workout'] = $csWorkout2;
                $coach['day3']['skilltraining'] = [];
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
                $coach['day4']['skilltraining'] = [];
                $coach['day4']['coach_workout_rounds'] = count($coach['day4']['workout']['exercises']);
                $coach['day4']['workout_intensity'] = 1;
                $coach['day4']['hiit'] = [];
                $coach['day4']['stretching'] = $stretches;

//                  Day5 Exercise set
                $coach['day5']['warmup'] = $warmUps;
                $coach['day5']['is_completed'] = 0;
                $coach['day5']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                $coach['day5']['exercises'] = [];
                $coach['day5']['workout'] = $sWorkout3;
                $coach['day5']['skilltraining'] = [];
                $coach['day5']['coach_workout_rounds'] = count($coach['day5']['workout']['exercises']);
                $coach['day5']['workout_intensity'] = 1;
                $coach['day5']['hiit'] = $hiit;
                $coach['day5']['stretching'] = $stretches;
            }
        } elseif ($focus == 3) {

            if ($data['days'] == 2) {

                $sWorkout1 = self::getWorkoutWithExercises($userWorkouts['strength'][0]->id, $intenseFactor, $data['user_id'], $week);

                $sWorkout2 = self::getWorkoutWithExercises($userWorkouts['strength'][1]->id, $intenseFactor, $data['user_id'], $week);

//                  Day1 exercise set
                $coach['day1']['warmup'] = $warmUps;
                $coach['day1']['is_completed'] = 0;
                $coach['day1']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                $coach['day1']['exercises'] = [];
                $coach['day1']['workout'] = $sWorkout1;
                $coach['day1']['skilltraining'] = [];
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
                $coach['day2']['skilltraining'] = [];
                $coach['day2']['coach_workout_rounds'] = count($coach['day2']['workout']['exercises']);
                $coach['day2']['workout_intensity'] = 1;
                $coach['day2']['hiit'] = $hiit;
                $coach['day2']['stretching'] = $stretches;
            } elseif ($data['days'] == 3) {

                $sWorkout1 = self::getWorkoutWithExercises($userWorkouts['strength'][0]->id, $intenseFactor, $data['user_id'], $week);

                $sWorkout2 = self::getWorkoutWithExercises($userWorkouts['strength'][1]->id, $intenseFactor, $data['user_id'], $week);

                $sWorkout3 = self::getWorkoutWithExercises($userWorkouts['strength'][2]->id, $intenseFactor, $data['user_id'], $week);

//                  Day1 exercise set
                $coach['day1']['warmup'] = $warmUps;
                $coach['day1']['is_completed'] = 0;
                $coach['day1']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                $coach['day1']['exercises'] = [];
                $coach['day1']['workout'] = $sWorkout1;
                $coach['day1']['skilltraining'] = [];
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
                $coach['day2']['skilltraining'] = [];
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
                $coach['day3']['skilltraining'] = [];
                $coach['day3']['coach_workout_rounds'] = count($coach['day3']['workout']['exercises']);
                $coach['day3']['workout_intensity'] = 1;
                $coach['day3']['hiit'] = $hiit;
                $coach['day3']['stretching'] = $stretches;
            } elseif ($data['days'] == 4) {

                $sWorkout1 = self::getWorkoutWithExercises($userWorkouts['strength'][0]->id, $intenseFactor, $data['user_id'], $week);

                $sWorkout2 = self::getWorkoutWithExercises($userWorkouts['strength'][1]->id, $intenseFactor, $data['user_id'], $week);

                $sWorkout3 = self::getWorkoutWithExercises($userWorkouts['strength'][2]->id, $intenseFactor, $data['user_id'], $week);

                $sWorkout4 = self::getWorkoutWithExercises($userWorkouts['strength'][3]->id, $intenseFactor, $data['user_id'], $week);
//Day1 exercise set
                $coach['day1']['warmup'] = $warmUps;
                $coach['day1']['is_completed'] = 0;
                $coach['day1']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                $coach['day1']['exercises'] = [];
                $coach['day1']['workout'] = $sWorkout1;
                $coach['day1']['skilltraining'] = [];
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
                $coach['day2']['skilltraining'] = [];
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
                $coach['day3']['skilltraining'] = [];
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
                $coach['day4']['skilltraining'] = [];
                $coach['day4']['coach_workout_rounds'] = count($coach['day4']['workout']['exercises']);
                $coach['day4']['workout_intensity'] = 1;
                $coach['day4']['hiit'] = $hiit;
                $coach['day4']['stretching'] = $stretches;
            } elseif ($data['days'] == 5) {

                $sWorkout1 = self::getWorkoutWithExercises($userWorkouts['strength'][0]->id, $intenseFactor, $data['user_id'], $week);

                $sWorkout2 = self::getWorkoutWithExercises($userWorkouts['strength'][1]->id, $intenseFactor, $data['user_id'], $week);

                $sWorkout3 = self::getWorkoutWithExercises($userWorkouts['strength'][2]->id, $intenseFactor, $data['user_id'], $week);

                $sWorkout4 = self::getWorkoutWithExercises($userWorkouts['strength'][3]->id, $intenseFactor, $data['user_id'], $week);

                $sWorkout5 = self::getWorkoutWithExercises($userWorkouts['strength'][4]->id, $intenseFactor, $data['user_id'], $week);

//Day1 exercise set
                $coach['day1']['warmup'] = $warmUps;
                $coach['day1']['is_completed'] = 0;
                $coach['day1']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                $coach['day1']['exercises'] = [];
                $coach['day1']['workout'] = $sWorkout1;
                $coach['day1']['skilltraining'] = [];
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
                $coach['day2']['skilltraining'] = [];
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
                $coach['day3']['skilltraining'] = [];
                $coach['day3']['coach_workout_rounds'] = count($coach['day3']['workout']['exercises']);
                $coach['day3']['workout_intensity'] = 1;
                $coach['day3']['hiit'] = $hiit;
                $coach['day3']['stretching'] = $stretches;

//Day4 Exercise set
                $coach['day4']['warmup'] = $warmUps;
                $coach['day4']['is_completed'] = 0;
                $coach['day4']['fundumentals'] = $fundumentalArray[5];
                $coach['day4']['exercises'] = [];
                $coach['day4']['workout'] = $sWorkout4;
                $coach['day4']['skilltraining'] = [];
                $coach['day4']['coach_workout_rounds'] = count($coach['day4']['workout']['exercises']);
                $coach['day4']['workout_intensity'] = 1;
                $coach['day4']['hiit'] = [];
                $coach['day4']['stretching'] = $stretches;

//Day5 Exercise set
                $coach['day5']['warmup'] = $warmUps;
                $coach['day5']['is_completed'] = 0;
                $coach['day5']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                $coach['day5']['exercises'] = [];
                $coach['day5']['workout'] = $sWorkout5;
                $coach['day5']['skilltraining'] = [];
                $coach['day5']['coach_workout_rounds'] = count($coach['day5']['workout']['exercises']);
                $coach['day5']['workout_intensity'] = 1;
                $coach['day5']['hiit'] = $hiit;
                $coach['day5']['stretching'] = $stretches;
            }
        }

        return array($coach, $exerciseCat);
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

        $category = 3;

        if ($categoryArray[3] > 0) {
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

                            if ($unLockCount <= 0) {
                                //Unlocked substitute then replace the workout exercise with new one.
                                $category = 2;
                            }
                        } else {
                            //Skill doesn't have substitute, down the difficulty level
                            $category = 2;
                        }
                    }
                } else {
                    break;
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
                } else {
                    //echo '2.exercise___'.$workoutExercise;
                    break;
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
    public static function getWorkoutWithExercises($workoutId, $intenseFactor, $userId, $week)
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

        $rounds = $workoutIntensity[$intenseFactor];

        $workout->is_completed = 0;

        $count = 1;
        $exercises = [];

        $categoryArray = [1 => 0, 2 => 0, 3 => 0];

        do {

            if ($workout->is_repsandsets == 1) {
                $roundExercises = Workoutexercise::where('round', '=', $count)
                    ->where('category', '=', 1)
                    ->where('workout_id', '=', $workoutId)
                    ->with(['exercise', 'video'])
                    ->get();
            } else {
                $roundExercises = Workoutexercise::where('round', '=', $count)
                    ->where('category', '=', 1)
                    ->where('workout_id', '=', $workoutId)
                    ->with(['exercise', 'video'])
                    ->get();
            }

            $roundExerciseArray = $roundExercises->toArray();

            foreach ($roundExerciseArray as $roundExercise) {
                $skill = DB::table('skills')
                    ->where('exercise_id', $roundExercise['exercise_id'])
                    ->first();

                if (!is_null($skill)) {
                    $highestUnlockedSkill = DB::table('unlocked_skills')
                        ->leftJoin('skills', 'skills.id', '=', 'unlocked_skills.skill_id')
                        ->where('skills.progression_id', $skill->progression_id)
                        ->where('skills.row', $skill->row)
                        ->where('unlocked_skills.user_id', $userId)
                        ->orderBy('skills.level', 'DESC')
                        ->first();

                    if (!is_null($highestUnlockedSkill)) {
                        if ($highestUnlockedSkill->level <= 2) {
                            $categoryArray[1] ++;
                        } elseif ($highestUnlockedSkill->level <= 4) {
                            $categoryArray[2] ++;
                        } else {
                            $categoryArray[3] ++;
                        }
                        $roundExercise['exercise_id'] = $highestUnlockedSkill->exercise_id;

                        $exercise = Exercise::where('id', $highestUnlockedSkill->exercise_id)->with(['video'])->first();

                        $roundExercise['unit'] = $exercise->unit;

                        $roundExercise['exercise'] = $exercise->toArray();
                        $roundExercise['video'] = $roundExercise['exercise']['video'][0];
                    } else {
                        if ($skill->level <= 2) {
                            $categoryArray[1] ++;
                        } elseif ($skill->level <= 4) {
                            $categoryArray[2] ++;
                        } else {
                            $categoryArray[3] ++;
                        }
                        $exercise = Exercise::where('id', $roundExercise['exercise_id'])->with(['video'])->first();

                        $roundExercise['unit'] = $exercise->unit;

                        $roundExercise['exercise'] = $exercise->toArray();
                        $roundExercise['video'] = $roundExercise['exercise']['video'][0];
                    }
                } else {

                    $exercise = Exercise::where('id', $roundExercise['exercise_id'])->with(['video'])->first();

                    $roundExercise['unit'] = $exercise->unit;

                    $roundExercise['exercise'] = $exercise->toArray();

                    $roundExercise['video'] = $roundExercise['exercise']['video'][0];
                }

                $roundExercise['is_completed'] = 0;
                $newExercises[] = $roundExercise;
            }

            $exercises['round' . $count] = $newExercises;

            $newExercises = Array();

            $count++;
        } while ($count <= $rounds);

        $maxs = array_keys($categoryArray, max($categoryArray));

        $category = $maxs[0];

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

        $workoutArray['exercise_category'] = $category;

        return $workoutArray;
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

        if ($exercises) {
            return $exercises;
        } else {
            return false;
        }
    }

    /**
     * Function to update coach after week exercises completed.
     * @depends getUserMatchedWorkoutsQuery
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

        $userGoalOption = DB::table('user_goal_options')->where('user_id', $coach->user_id)->first();

        $userRaidSelected = 0;

        if (!is_null($userGoalOption)) {
            if ($userGoalOption->goal_options != '') {
                $userRaidSelected = 1;
            }
        }

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
            $stretchesArray = array_map(function($stretch) {
                $stretch['duration']['min'] = round($stretch['duration']['min'] + ($stretch['duration']['min'] * (25 / 100)));
                $stretch['duration']['max'] = round($stretch['duration']['max'] + ($stretch['duration']['max'] * (25 / 100)));
                return $stretch;
            }, $stretchesArray);
        }

        if ($assessment == 3) {
            $intenseFactor = 0;
        } elseif ($assessment == 2) {
            $intenseFactor = 1;
        } elseif ($assessment == 1) {
            $intenseFactor = 2;
        }

        $data['user_id'] = $coach->user_id;
        $data['focus'] = $focus;
        $data['category'] = $coach->category;
        $data['muscle_groups'] = $coach->muscle_groups;
        $data['days'] = $days;
        $data['week'] = $coachStatus->week + 1;
        $data['limitations'] = $coach->limitations;


        $userWorkouts['strength'] = DB::select(self::getUserMatchedWorkoutsQuery(1, $coach->user_id, $data, $intenseFactor, $fundumentalArray));

        $userWorkouts['cardio_strength'] = DB::select(self::getUserMatchedWorkoutsQuery(2, $coach->user_id, $data, $intenseFactor, $fundumentalArray));

        if (($coachStatus->week + 1) <= 4 && $assessment == 3) {

            if ($userLevel == 'beginer') {
                if ($focus == 1) {
                    if ($data['days'] == 2) {
                        if (count($userWorkouts['cardio_strength']) < 1) {
                            return false;
                        }
                    } elseif ($data['days'] == 3) {
                        if (count($userWorkouts['cardio_strength']) < 2) {
                            return false;
                        }
                    } elseif ($data['days'] == 4) {
                        if (count($userWorkouts['cardio_strength']) < 2) {
                            return false;
                        }
                    } elseif ($data['days'] == 5) {
                        if (count($userWorkouts['cardio_strength']) < 2 && count($userWorkouts['strength']) < 1) {
                            return false;
                        }
                    }
                } elseif ($focus == 2) {
                    if ($data['days'] == 2) {
                        if (count($userWorkouts['cardio_strength']) < 1) {
                            return false;
                        }
                    } elseif ($data['days'] == 3) {
                        if (count($userWorkouts['cardio_strength']) < 1 && count($userWorkouts['strength']) < 1) {
                            return false;
                        }
                    } elseif ($data['days'] == 4) {
                        if (count($userWorkouts['cardio_strength']) < 2 && count($userWorkouts['strength']) < 1) {
                            return false;
                        }
                    } elseif ($data['days'] == 5) {
                        if (count($userWorkouts['cardio_strength']) < 3 && count($userWorkouts['strength']) < 1) {
                            return false;
                        }
                    }
                } elseif ($focus == 3) {
                    if ($data['days'] == 2) {
                        if (count($userWorkouts['strength']) < 1) {
                            return false;
                        }
                    } elseif ($data['days'] == 3) {
                        if (count($userWorkouts['strength']) < 2) {
                            return false;
                        }
                    } elseif ($data['days'] == 4) {
                        if (count($userWorkouts['strength']) < 3) {
                            return false;
                        }
                    } elseif ($data['days'] == 5) {
                        if (count($userWorkouts['cardio_strength']) < 1 && count($userWorkouts['strength']) < 3) {
                            return false;
                        }
                    }
                }
            } elseif ($userLevel == 'advanced') {
                if ($focus == 1) {
                    if ($data['days'] == 2) {
                        if (count($userWorkouts['cardio_strength']) < 1 && count($userWorkouts['strength']) < 1) {
                            return false;
                        }
                    } elseif ($data['days'] == 3) {
                        if (count($userWorkouts['cardio_strength']) < 2 && count($userWorkouts['strength']) < 1) {
                            return false;
                        }
                    } elseif ($data['days'] == 4) {
                        if (count($userWorkouts['cardio_strength']) < 3 && count($userWorkouts['strength']) < 1) {
                            return false;
                        }
                    } elseif ($data['days'] == 5) {
                        if (count($userWorkouts['cardio_strength']) < 3 && count($userWorkouts['strength']) < 2) {
                            return false;
                        }
                    }
                } elseif ($focus == 2) {
                    if ($data['days'] == 2) {
                        if (count($userWorkouts['cardio_strength']) < 1 && count($userWorkouts['strength']) < 1) {
                            return false;
                        }
                    } elseif ($data['days'] == 3) {
                        if (count($userWorkouts['cardio_strength']) < 1 && count($userWorkouts['strength']) < 2) {
                            return false;
                        }
                    } elseif ($data['days'] == 4) {
                        if (count($userWorkouts['cardio_strength']) < 2 && count($userWorkouts['strength']) < 2) {
                            return false;
                        }
                    } elseif ($data['days'] == 5) {
                        if (count($userWorkouts['cardio_strength']) < 2 && count($userWorkouts['strength']) < 3) {
                            return false;
                        }
                    }
                } elseif ($focus == 3) {
                    if ($data['days'] == 2) {
                        if (count($userWorkouts['strength']) < 2) {
                            return false;
                        }
                    } elseif ($data['days'] == 3) {
                        if (count($userWorkouts['strength']) < 3) {
                            return false;
                        }
                    } elseif ($data['days'] == 4) {
                        if (count($userWorkouts['strength']) < 4) {
                            return false;
                        }
                    } elseif ($data['days'] == 5) {
                        if (count($userWorkouts['cardio_strength']) < 1 && count($userWorkouts['strength']) < 4) {
                            return false;
                        }
                    }
                }
            } elseif ($userLevel == 'professional') {
                if ($focus == 1) {
                    if ($data['days'] == 2) {
                        if (count($userWorkouts['cardio_strength']) < 1 && count($userWorkouts['strength']) < 1) {
                            return false;
                        }
                    } elseif ($data['days'] == 3) {
                        if (count($userWorkouts['cardio_strength']) < 2 && count($userWorkouts['strength']) < 1) {
                            return false;
                        }
                    } elseif ($data['days'] == 4) {
                        if (count($userWorkouts['cardio_strength']) < 3 && count($userWorkouts['strength']) < 1) {
                            return false;
                        }
                    } elseif ($data['days'] == 5) {
                        if (count($userWorkouts['cardio_strength']) < 3 && count($userWorkouts['strength']) < 2) {
                            return false;
                        }
                    }
                } elseif ($focus == 2) {
                    if ($data['days'] == 2) {
                        if (count($userWorkouts['cardio_strength']) < 1 && count($userWorkouts['strength']) < 1) {
                            return false;
                        }
                    } elseif ($data['days'] == 3) {
                        if (count($userWorkouts['cardio_strength']) < 1 && count($userWorkouts['strength']) < 2) {
                            return false;
                        }
                    } elseif ($data['days'] == 4) {
                        if (count($userWorkouts['cardio_strength']) < 2 && count($userWorkouts['strength']) < 2) {
                            return false;
                        }
                    } elseif ($data['days'] == 5) {
                        if (count($userWorkouts['cardio_strength']) < 2 && count($userWorkouts['strength']) < 3) {
                            return false;
                        }
                    }
                } elseif ($focus == 3) {
                    if ($data['days'] == 2) {
                        if (count($userWorkouts['strength']) < 2) {
                            return false;
                        }
                    } elseif ($data['days'] == 3) {
                        if (count($userWorkouts['strength']) < 3) {
                            return false;
                        }
                    } elseif ($data['days'] == 4) {
                        if (count($userWorkouts['strength']) < 4) {
                            return false;
                        }
                    } elseif ($data['days'] == 5) {
                        if (count($userWorkouts['cardio_strength']) < 1 && count($userWorkouts['strength']) < 4) {
                            return false;
                        }
                    }
                }
            }

            list($exercises, $exerciseCat) = self::getCoachForFocus($warmUps, $fundumentalArray, $stretchesArray, $data, $userWorkouts, $focus, $userLevel, $coachStatus->week + 1, $intenseFactor);
        } else {
            if ($focus == 1) {
                if ($data['days'] == 2) {
                    if (count($userWorkouts['cardio_strength']) < 1) {
                        return false;
                    }
                } elseif ($data['days'] == 3) {
                    if (count($userWorkouts['cardio_strength']) < 2) {
                        return false;
                    }
                } elseif ($data['days'] == 4) {
                    if (count($userWorkouts['cardio_strength']) < 2) {
                        return false;
                    }
                } elseif ($data['days'] == 5) {
                    if (count($userWorkouts['cardio_strength']) < 3) {
                        return false;
                    }
                }
            } elseif ($focus == 2) {
                if ($data['days'] == 2) {
                    if (count($userWorkouts['strength']) < 1) {
                        return false;
                    }
                } elseif ($data['days'] == 3) {
                    if (count($userWorkouts['cardio_strength']) < 1 && count($userWorkouts['strength']) < 1) {
                        return false;
                    }
                } elseif ($data['days'] == 4) {
                    if (count($userWorkouts['cardio_strength']) < 1 && count($userWorkouts['strength']) < 1) {
                        return false;
                    }
                } elseif ($data['days'] == 5) {
                    if (count($userWorkouts['cardio_strength']) < 2 && count($userWorkouts['strength']) < 1) {
                        return false;
                    }
                }
            } elseif ($focus == 3) {
                if ($data['days'] == 3) {
                    if (count($userWorkouts['strength']) < 1) {
                        return false;
                    }
                } elseif ($data['days'] == 4) {
                    if (count($userWorkouts['strength']) < 2) {
                        return false;
                    }
                } elseif ($data['days'] == 5) {
                    if (count($userWorkouts['strength']) < 2) {
                        return false;
                    }
                }
            }
            list($exercises, $exerciseCat) = self::getCoachForFocusUpdate($warmUps, $fundumentalArray, $stretchesArray, $data, $userWorkouts, $focus, $userLevel, $coachStatus->week + 1, $intenseFactor);
        }

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

        $userMuscleGroups = DB::table('user_physique_options')->where('user_id', $userId)->pluck('physique_options');

        $whereSubQueryArray = [];

        if (!is_null($userMuscleGroups) && $userMuscleGroups != '') {
            $likeQueryArray = [];
            $muscleGroupArray = explode(',', $userMuscleGroups);
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

        if (count($whereSubQueryArray) > 0) {
            $whereQuery .= 'AND (';

            $whereQuery .= implode(' OR ', $whereSubQueryArray);

            $whereQuery .= ')';
        }

        $whereLimitSubQueryArray = [];

        if (isset($data['limitations']) && $data['limitations'] != '') {

            $limitQueryArray = [];
            $limitArray = explode(',', $data['limitations']);

            $limitQuery = '';

            foreach ($limitArray as $mgKey => $limitId) {
                if ($limitId != ' ' && $limitId != '') {
                    $limitQueryArray[] = 'exercises.muscle_groups LIKE "%' . $limitId . '%"';
                }
            }

            $limitQuery .= implode(' OR ', $limitQueryArray);

            if ($limitQuery != '') {
                $userLimitedMuscleExercisesQuery = DB::table('exercises')
                    ->select('id')
                    ->whereRaw($limitQuery)
                    ->toSql();
                $whereLimitSubQueryArray[] = 'workout_exercises.exercise_id NOT IN(' . $userLimitedMuscleExercisesQuery . ')';
            }
        }

        $whereOmmitQuery = '';

        if (count($whereLimitSubQueryArray) > 0) {
            $whereOmmitQuery .= ' AND (';

            $whereOmmitQuery .= implode(' OR ', $whereLimitSubQueryArray);

            $whereOmmitQuery .= ')';
        }

        $selWorkouts = [];

        $selectedWorkouts = '';

        if (count($selWorkouts) > 0) {
            $selectedWorkouts .= ' AND t1.id IN(' . implode(",", $selWorkouts) . ')';
        }

        return 'SELECT DISTINCT t1.id, 
                        s.totalCount AS exercise_count 
                FROM workouts AS t1 
                        LEFT JOIN
                        (
                            SELECT DISTINCT  workout_id, COUNT(*) totalCount 
                            FROM    workout_exercises 
                            WHERE   ' . $whereQuery .
            ' GROUP BY workout_id
                        ) s ON s.workout_id = t1.id
                        LEFT JOIN workout_exercises ON workout_exercises.workout_id = t1.id
                WHERE t1.category = ' . $category . $selectedWorkouts . $whereOmmitQuery . '
                ORDER BY exercise_count DESC';
    }

    /**
     * Function to get user basic skills according to user focus, musclegroups etc.
     * @param type $userId
     * @param type $muscleGroups
     * @param type $focus
     * @return type
     * @author Aneesh K<aneeshk@cubettech.com>
     */
    public static function getUserBasicSkills($userId, $muscleGroups, $limitations)
    {
        $userRaid = DB::table('user_goal_options')->where('user_id', $userId)->first();

        if (!is_null($userRaid)) {
            $skill = Skill::where('id', $userRaid->goal_options)->first();

            $basicSkillsQuery = DB::table('unlocked_skills')
                ->select('skills.*')
                ->leftJoin('skills', 'unlocked_skills.skill_id', '=', 'skills.id')
                ->orderBy('skills.level', 'ASC')
                ->take(5);
            $whereQuery = 'skills.row = ' . $skill->row . ' AND skills.progression_id = ' . $skill->progression_id . ' AND unlocked_skills.user_id = ' . $userId;
        } else {
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

                $whereQuery = 'skills.exercise_id IN(' . $userUnlockedSkillExerciseQuery . ')' . $likeQuery;
            } else {
                $whereQuery = 'skills.exercise_id IN(' . $userUnlockedSkillExerciseQuery . ')';
            }
        }

        $whereLimitSubQueryArray = [];

        if (isset($limitations) && $limitations != '') {

            $limitQueryArray = [];
            $limitArray = explode(',', $limitations);

            $limitQuery = '';

            foreach ($limitArray as $mgKey => $limitId) {
                if ($limitId != ' ' && $limitId != '') {
                    $limitQueryArray[] = 'exercises.muscle_groups LIKE "%' . $limitId . '%"';
                }
            }

            $limitQuery .= implode(' OR ', $limitQueryArray);

            if ($limitQuery != '') {
                $userLimitedMuscleExercisesQuery = DB::table('exercises')
                    ->select('id')
                    ->whereRaw($limitQuery)
                    ->toSql();
                $whereLimitSubQueryArray[] = 'skills.exercise_id NOT IN(' . $userLimitedMuscleExercisesQuery . ')';
            }
        }

        if (count($whereLimitSubQueryArray) > 0) {
            $whereQuery .= ' AND (';

            $whereQuery .= implode(' OR ', $whereLimitSubQueryArray);

            $whereQuery .= ')';
        }

        $basicSkills = $basicSkillsQuery->whereRaw($whereQuery)->get();

        return $basicSkills;
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
    public static function getCoachForFocusUpdate($warmUps, $fundumentalArray, $stretches, $data, $userWorkouts, $focus, $userLevel, $week, $intenseFactor)
    {

        $coach = [];
        if ($userLevel == 'professional') {
            $exerciseCat = 3;
        } elseif ($userLevel == 'advanced') {
            $exerciseCat = 2;
        } elseif ($userLevel == 'beginer') {
            $exerciseCat = 1;
        }

        $hiitReplacements = [
            1 => [
                ['round1' => [
                        ['name' => 'Burpee Pushups', 'duration' => 15, 'unit' => 'times'],
                        ['name' => 'Tucked Plank (SH)', 'duration' => 30, 'unit' => 'seconds']
                    ],
                    'round2' => [
                        ['name' => 'Jumping Lunges', 'duration' => 50, 'unit' => 'times'],
                        ['name' => 'Plank (SH)', 'duration' => 30, 'unit' => 'seconds']
                    ]
                ]
            ],
            2 => [
                ['round1' => [
                        ['name' => 'Burpee Pushups', 'duration' => 10, 'unit' => 'times'],
                        ['name' => 'Rest', 'duration' => 10, 'unit' => 'seconds']
                    ],
                    'round2' => [
                        ['name' => 'Squat Jumps', 'duration' => 15, 'unit' => 'times'],
                        ['name' => 'Rest', 'duration' => 10, 'unit' => 'seconds']
                    ],
                    'round3' => [
                        ['name' => 'Mountain Climbers', 'duration' => 30, 'unit' => 'times'],
                        ['name' => 'Rest', 'duration' => 10, 'unit' => 'seconds']
                    ]
                ]
            ],
            3 => [
                ['round1' => [
                        ['name' => 'Tuck Jump Burpees', 'duration' => 25, 'unit' => 'times'],
                        ['name' => 'Jumping Lunges', 'duration' => 50, 'unit' => 'times'],
                        ['name' => 'Mountain Climbers', 'duration' => 50, 'unit' => 'times']
                    ]
                ]
            ]
        ];

        // hiit 1 - 30/30, 2 - 20/10, 3 - 60/120

        $hiitReplacements = array_map(function($hiitReplacement) {
            $hiitReplacement = array_map(function($roundExercises) {
                $roundExercises = array_map(function($roundExercise) {
                    foreach ($roundExercise as $exerciseSet) {
                        $exercise = Exercise::where('name', '=', $exerciseSet['name'])->with(['video'])->first();
                        $exerciseSet['exercise'] = $exercise->toArray();
                        $exercises[] = $exerciseSet;
                    }
                    return $exercises;
                }, $roundExercises);
                return $roundExercises;
            }, $hiitReplacement);
            return $hiitReplacement;
        }, $hiitReplacements);

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

        $basicSkills = self::getUserBasicSkills($data['user_id'], $data['muscle_groups'], $data['limitations']);

        $exercises = [];
        foreach ($basicSkills as $bKey => $basicSkill) {
            $exercise = Exercise::where('id', $basicSkill->exercise_id)->with(['video'])->first();
            if (!is_null($exercise)) {
                $exercise->is_completed = 0;
                $exercises[] = $exercise;
            }
        }

        $skillTraining = self::getUserSkilltainingwithExercises($data);

        if ($focus == 1) {
            if ($data['days'] == 2) {
                $csWorkout1 = self::getWorkoutWithExercises($userWorkouts['cardio_strength'][0]->id, $intenseFactor, $data['user_id'], $week);
//                  Day1 exercise set
                $coach['day1']['warmup'] = $warmUps;
                $coach['day1']['is_completed'] = 0;
                $coach['day1']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                $coach['day1']['exercises'] = [];
                $coach['day1']['workout'] = $csWorkout1;
                $coach['day1']['skilltraining'] = [];
                $coach['day1']['coach_workout_rounds'] = count($csWorkout1['exercises']);
                $coach['day1']['workout_intensity'] = 1;
                $coach['day1']['hiit'] = [];
                $coach['day1']['stretching'] = $stretches;
                $coach['day1']['is_completed'] = 0;

//                  Day2 Exercise set
                $coach['day2']['warmup'] = $warmUps;
                $coach['day2']['is_completed'] = 0;
                $coach['day2']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                $coach['day2']['exercises'] = [];
                $coach['day2']['workout'] = [];
                $coach['day2']['skilltraining'] = $skillTraining;
                $coach['day2']['coach_workout_rounds'] = 1;
                $coach['day2']['workout_intensity'] = 1;
                $coach['day2']['hiit'] = $hiit;
                $coach['day2']['stretching'] = $stretches;
            } elseif ($data['days'] == 3) {
                $csWorkout1 = self::getWorkoutWithExercises($userWorkouts['cardio_strength'][0]->id, $intenseFactor, $data['user_id'], $week);
                $csWorkout2 = self::getWorkoutWithExercises($userWorkouts['cardio_strength'][1]->id, $intenseFactor, $data['user_id'], $week);

                $coach['day1']['warmup'] = $warmUps;
                $coach['day1']['is_completed'] = 0;
                $coach['day1']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                $coach['day1']['exercises'] = [];
                $coach['day1']['workout'] = $csWorkout1;
                $coach['day1']['skilltraining'] = [];
                $coach['day1']['coach_workout_rounds'] = count($csWorkout1['exercises']);
                $coach['day1']['workout_intensity'] = 1;
                $coach['day1']['hiit'] = [];
                $coach['day1']['stretching'] = $stretches;

//                  Day2 Exercise set

                $coach['day2']['warmup'] = $warmUps;
                $coach['day2']['is_completed'] = 0;
                $coach['day2']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                $coach['day2']['exercises'] = [];
                $coach['day2']['workout'] = [];
                $coach['day2']['skilltraining'] = $skillTraining;
                $coach['day2']['coach_workout_rounds'] = 1;
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
            } elseif ($data['days'] == 4) {

                $csWorkout1 = self::getWorkoutWithExercises($userWorkouts['cardio_strength'][0]->id, $intenseFactor, $data['user_id'], $week);
                $csWorkout2 = self::getWorkoutWithExercises($userWorkouts['cardio_strength'][1]->id, $intenseFactor, $data['user_id'], $week);

//                  Day1 exercise set
                $coach['day1']['warmup'] = $warmUps;
                $coach['day1']['is_completed'] = 0;
                $coach['day1']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                $coach['day1']['exercises'] = [];
                $coach['day1']['workout'] = $csWorkout1;
                $coach['day1']['skilltraining'] = [];
                $coach['day1']['coach_workout_rounds'] = count($csWorkout1['exercises']);
                $coach['day1']['workout_intensity'] = 1;
                $coach['day1']['hiit'] = [];
                $coach['day1']['stretching'] = $stretches;

//                  Day2 Exercise set

                $coach['day2']['warmup'] = $warmUps;
                $coach['day2']['is_completed'] = 0;
                $coach['day2']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                $coach['day2']['exercises'] = [];
                $coach['day2']['workout'] = [];
                $coach['day2']['skilltraining'] = $skillTraining;
                $coach['day2']['coach_workout_rounds'] = 1;
                $coach['day2']['workout_intensity'] = 1;
                $coach['day2']['hiit'] = $hiit;
                $coach['day2']['stretching'] = $stretches;

//                  Day3 exercise set

                $coach['day3']['warmup'] = $warmUps;
                $coach['day3']['is_completed'] = 0;
                $coach['day3']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                $coach['day3']['exercises'] = [];
                $coach['day3']['workout'] = $csWorkout2;
                $coach['day3']['skilltraining'] = [];
                $coach['day3']['coach_workout_rounds'] = count($csWorkout2['exercises']);
                $coach['day3']['workout_intensity'] = 1;
                $coach['day3']['hiit'] = [];
                $coach['day3']['stretching'] = $stretches;

//                  Day4 exercise set
                $coach['day4']['warmup'] = $warmUps;
                $coach['day4']['is_completed'] = 0;
                $coach['day4']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                $coach['day4']['exercises'] = [];
                $coach['day4']['workout'] = [];
                $coach['day4']['skilltraining'] = $skillTraining;
                $coach['day4']['coach_workout_rounds'] = 1;
                $coach['day4']['workout_intensity'] = 1;
                $coach['day4']['hiit'] = $hiit;
                $coach['day4']['stretching'] = $stretches;
            } elseif ($data['days'] == 5) {

                $csWorkout1 = self::getWorkoutWithExercises($userWorkouts['cardio_strength'][0]->id, $intenseFactor, $data['user_id'], $week);

                $csWorkout2 = self::getWorkoutWithExercises($userWorkouts['cardio_strength'][1]->id, $intenseFactor, $data['user_id'], $week);

                $csWorkout3 = self::getWorkoutWithExercises($userWorkouts['cardio_strength'][2]->id, $intenseFactor, $data['user_id'], $week);

//                  Day1 exercise set
                $coach['day1']['warmup'] = $warmUps;
                $coach['day1']['is_completed'] = 0;
                $coach['day1']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                $coach['day1']['exercises'] = [];
                $coach['day1']['workout'] = $csWorkout1;
                $coach['day1']['skilltraining'] = [];
                $coach['day1']['coach_workout_rounds'] = count($csWorkout1['exercises']);
                $coach['day1']['workout_intensity'] = 1;
                $coach['day1']['hiit'] = [];
                $coach['day1']['stretching'] = $stretches;

//                  Day2 Exercise set
                $coach['day2']['warmup'] = $warmUps;
                $coach['day2']['is_completed'] = 0;
                $coach['day2']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                $coach['day2']['exercises'] = [];
                $coach['day2']['workout'] = [];
                $coach['day2']['skilltraining'] = $skillTraining;
                $coach['day2']['coach_workout_rounds'] = 1;
                $coach['day2']['workout_intensity'] = 1;
                $coach['day2']['hiit'] = $hiit;
                $coach['day2']['stretching'] = $stretches;

//                  Day3 exercise set
                $coach['day3']['warmup'] = $warmUps;
                $coach['day3']['is_completed'] = 0;
                $coach['day3']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                $coach['day3']['exercises'] = [];
                $coach['day3']['workout'] = $csWorkout2;
                $coach['day3']['skilltraining'] = [];
                $coach['day3']['coach_workout_rounds'] = count($csWorkout2['exercises']);
                $coach['day3']['workout_intensity'] = 1;
                $coach['day3']['hiit'] = [];
                $coach['day3']['stretching'] = $stretches;


                $coach['day4']['warmup'] = $warmUps;
                $coach['day4']['is_completed'] = 0;
                $coach['day4']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                $coach['day4']['exercises'] = [];
                $coach['day4']['workout'] = $csWorkout3;
                $coach['day4']['skilltraining'] = [];
                $coach['day4']['coach_workout_rounds'] = count($csWorkout3['exercises']);
                $coach['day4']['workout_intensity'] = 1;
                $coach['day4']['hiit'] = [];
                $coach['day4']['stretching'] = $stretches;


                $coach['day5']['warmup'] = $warmUps;
                $coach['day5']['is_completed'] = 0;
                $coach['day5']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                $coach['day5']['exercises'] = [];
                $coach['day5']['workout'] = [];
                $coach['day5']['skilltraining'] = $skillTraining;
                $coach['day5']['coach_workout_rounds'] = 1;
                $coach['day5']['workout_intensity'] = 1;
                $coach['day5']['hiit'] = $hiit;
                $coach['day5']['stretching'] = $stretches;
            }
        } elseif ($focus == 2) {

            if ($data['days'] == 2) {

                $sWorkout1 = self::getWorkoutWithExercises($userWorkouts['strength'][0]->id, $intenseFactor, $data['user_id'], $week);

//                  Day1 exercise set
                $coach['day1']['warmup'] = $warmUps;
                $coach['day1']['is_completed'] = 0;
                $coach['day1']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                $coach['day1']['exercises'] = [];
                $coach['day1']['workout'] = $sWorkout1;
                $coach['day1']['skilltraining'] = [];
                $coach['day1']['coach_workout_rounds'] = count($sWorkout1['exercises']);
                $coach['day1']['workout_intensity'] = 1;
                $coach['day1']['hiit'] = [];
                $coach['day1']['stretching'] = $stretches;

//                  Day2 Exercise set
                $coach['day2']['warmup'] = $warmUps;
                $coach['day2']['is_completed'] = 0;
                $coach['day2']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                $coach['day2']['exercises'] = [];
                $coach['day2']['workout'] = [];
                $coach['day2']['skilltraining'] = $skillTraining;
                $coach['day2']['coach_workout_rounds'] = 1;
                $coach['day2']['workout_intensity'] = 1;
                $coach['day2']['hiit'] = $hiit;
                $coach['day2']['stretching'] = $stretches;
            } elseif ($data['days'] == 3) {

                $csWorkout1 = self::getWorkoutWithExercises($userWorkouts['cardio_strength'][0]->id, $intenseFactor, $data['user_id'], $week);

                $sWorkout1 = self::getWorkoutWithExercises($userWorkouts['strength'][0]->id, $intenseFactor, $data['user_id'], $week);

                $coach['day1']['warmup'] = $warmUps;
                $coach['day1']['is_completed'] = 0;
                $coach['day1']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                $coach['day1']['exercises'] = [];
                $coach['day1']['workout'] = $csWorkout1;
                $coach['day1']['skilltraining'] = [];
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
                $coach['day2']['skilltraining'] = [];
                $coach['day2']['coach_workout_rounds'] = count($sWorkout1['exercises']);
                $coach['day2']['workout_intensity'] = 1;
                $coach['day2']['hiit'] = [];
                $coach['day2']['stretching'] = $stretches;

//                  Day3 exercise set
                $coach['day3']['warmup'] = $warmUps;
                $coach['day3']['is_completed'] = 0;
                $coach['day3']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                $coach['day3']['exercises'] = [];
                $coach['day3']['workout'] = [];
                $coach['day3']['skilltraining'] = $skillTraining;
                $coach['day3']['coach_workout_rounds'] = 0;
                $coach['day3']['workout_intensity'] = 1;
                $coach['day3']['hiit'] = $hiit;
                $coach['day3']['stretching'] = $stretches;
            } elseif ($data['days'] == 4) {

                $csWorkout1 = self::getWorkoutWithExercises($userWorkouts['cardio_strength'][0]->id, $intenseFactor, $data['user_id'], $week);

                $sWorkout1 = self::getWorkoutWithExercises($userWorkouts['strength'][0]->id, $intenseFactor, $data['user_id'], $week);

                //Day1 exercise set
                $coach['day1']['warmup'] = $warmUps;
                $coach['day1']['is_completed'] = 0;
                $coach['day1']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                $coach['day1']['exercises'] = [];
                $coach['day1']['workout'] = $csWorkout1;
                $coach['day1']['skilltraining'] = [];
                $coach['day1']['coach_workout_rounds'] = count($csWorkout1['exercises']);
                $coach['day1']['workout_intensity'] = 1;
                $coach['day1']['hiit'] = [];
                $coach['day1']['stretching'] = $stretches;

                //Day2 Exercise set
                $coach['day2']['warmup'] = $warmUps;
                $coach['day2']['is_completed'] = 0;
                $coach['day2']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                $coach['day2']['exercises'] = [];
                $coach['day2']['workout'] = [];
                $coach['day2']['skilltraining'] = $skillTraining;
                $coach['day2']['coach_workout_rounds'] = 1;
                $coach['day2']['workout_intensity'] = 1;
                $coach['day2']['hiit'] = [];
                $coach['day2']['stretching'] = $stretches;

                //Day3 exercise set                    
                $coach['day3']['warmup'] = $warmUps;
                $coach['day3']['is_completed'] = 0;
                $coach['day3']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                $coach['day3']['exercises'] = [];
                $coach['day3']['workout'] = $sWorkout1;
                $coach['day3']['skilltraining'] = [];
                $coach['day3']['coach_workout_rounds'] = count($sWorkout1['exercises']);
                $coach['day3']['workout_intensity'] = 1;
                $coach['day3']['hiit'] = [];
                $coach['day3']['stretching'] = $stretches;

                //Day4 exercise set
                $coach['day4']['warmup'] = $warmUps;
                $coach['day4']['is_completed'] = 0;
                $coach['day4']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                $coach['day4']['exercises'] = [];
                $coach['day4']['workout'] = [];
                $coach['day4']['skilltraining'] = $skillTraining;
                $coach['day4']['coach_workout_rounds'] = 1;
                $coach['day4']['workout_intensity'] = 1;
                $coach['day4']['hiit'] = $hiit;
                $coach['day4']['stretching'] = $stretches;
            } elseif ($data['days'] == 5) {

                $csWorkout1 = self::getWorkoutWithExercises($userWorkouts['cardio_strength'][0]->id, $intenseFactor, $data['user_id'], $week);

                $csWorkout2 = self::getWorkoutWithExercises($userWorkouts['cardio_strength'][1]->id, $intenseFactor, $data['user_id'], $week);

                $sWorkout1 = self::getWorkoutWithExercises($userWorkouts['strength'][0]->id, $intenseFactor, $data['user_id'], $week);

//                  Day1 exercise set
                $coach['day1']['warmup'] = $warmUps;
                $coach['day1']['is_completed'] = 0;
                $coach['day1']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                $coach['day1']['exercises'] = [];
                $coach['day1']['workout'] = $csWorkout1;
                $coach['day1']['skilltraining'] = [];
                $coach['day1']['coach_workout_rounds'] = count($csWorkout1['exercises']);
                $coach['day1']['workout_intensity'] = 1;
                $coach['day1']['hiit'] = [];
                $coach['day1']['stretching'] = $stretches;

//                  Day2 Exercise set
                $coach['day2']['warmup'] = $warmUps;
                $coach['day2']['is_completed'] = 0;
                $coach['day2']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                $coach['day2']['exercises'] = [];
                $coach['day2']['workout'] = [];
                $coach['day2']['skilltraining'] = $skillTraining;
                $coach['day2']['coach_workout_rounds'] = 1;
                $coach['day2']['workout_intensity'] = 1;
                $coach['day2']['hiit'] = $hiit;
                $coach['day2']['stretching'] = $stretches;

//                  Day3 exercise set
                $coach['day3']['warmup'] = $warmUps;
                $coach['day3']['is_completed'] = 0;
                $coach['day3']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                $coach['day3']['exercises'] = [];
                $coach['day3']['workout'] = $sWorkout1;
                $coach['day3']['skilltraining'] = [];
                $coach['day3']['coach_workout_rounds'] = count($sWorkout1['exercises']);
                $coach['day3']['workout_intensity'] = 1;
                $coach['day3']['hiit'] = [];
                $coach['day3']['stretching'] = $stretches;


                $coach['day4']['warmup'] = $warmUps;
                $coach['day4']['is_completed'] = 0;
                $coach['day4']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                $coach['day4']['exercises'] = [];
                $coach['day4']['workout'] = $csWorkout2;
                $coach['day4']['skilltraining'] = [];
                $coach['day4']['coach_workout_rounds'] = count($csWorkout2['exercises']);
                $coach['day4']['workout_intensity'] = 1;
                $coach['day4']['hiit'] = [];
                $coach['day4']['stretching'] = $stretches;


                $coach['day5']['warmup'] = $warmUps;
                $coach['day5']['is_completed'] = 0;
                $coach['day5']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                $coach['day5']['exercises'] = [];
                $coach['day5']['workout'] = [];
                $coach['day5']['skilltraining'] = $skillTraining;
                $coach['day5']['coach_workout_rounds'] = 1;
                $coach['day5']['workout_intensity'] = 1;
                $coach['day5']['hiit'] = $hiit;
                $coach['day5']['stretching'] = $stretches;
            }
        } elseif ($focus == 3) {

            if ($data['days'] == 2) {

//                  Day1 exercise set
                $coach['day1']['warmup'] = $warmUps;
                $coach['day1']['is_completed'] = 0;
                $coach['day1']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                $coach['day1']['exercises'] = [];
                $coach['day1']['workout'] = [];
                $coach['day1']['skilltraining'] = $skillTraining;
                $coach['day1']['coach_workout_rounds'] = 1;
                $coach['day1']['workout_intensity'] = 1;
                $coach['day1']['hiit'] = [];
                $coach['day1']['stretching'] = $stretches;

//                  Day2 Exercise set
                $coach['day2']['warmup'] = $warmUps;
                $coach['day2']['is_completed'] = 0;
                $coach['day2']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                $coach['day2']['exercises'] = [];
                $coach['day2']['workout'] = [];
                $coach['day2']['skilltraining'] = $skillTraining;
                $coach['day2']['coach_workout_rounds'] = 1;
                $coach['day2']['workout_intensity'] = 1;
                $coach['day2']['hiit'] = $hiit;
                $coach['day2']['stretching'] = $stretches;
            } elseif ($data['days'] == 3) {
                $sWorkout1 = self::getWorkoutWithExercises($userWorkouts['strength'][0]->id, $intenseFactor, $data['user_id'], $week);

                $coach['day1']['warmup'] = $warmUps;
                $coach['day1']['is_completed'] = 0;
                $coach['day1']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                $coach['day1']['exercises'] = [];
                $coach['day1']['workout'] = [];
                $coach['day1']['skilltraining'] = $skillTraining;
                $coach['day1']['coach_workout_rounds'] = 1;
                $coach['day1']['workout_intensity'] = 1;
                $coach['day1']['hiit'] = [];
                $coach['day1']['stretching'] = $stretches;

//                  Day2 Exercise set
                $coach['day2']['warmup'] = $warmUps;
                $coach['day2']['is_completed'] = 0;
                $coach['day2']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                $coach['day2']['exercises'] = [];
                $coach['day2']['workout'] = $sWorkout1;
                $coach['day2']['skilltraining'] = [];
                $coach['day2']['coach_workout_rounds'] = count($sWorkout1['exercises']);
                $coach['day2']['workout_intensity'] = 1;
                $coach['day2']['hiit'] = [];
                $coach['day2']['stretching'] = $stretches;

//                  Day3 exercise set
                $coach['day3']['warmup'] = $warmUps;
                $coach['day3']['is_completed'] = 0;
                $coach['day3']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                $coach['day3']['exercises'] = [];
                $coach['day3']['workout'] = [];
                $coach['day3']['skilltraining'] = $skillTraining;
                $coach['day3']['coach_workout_rounds'] = 1;
                $coach['day3']['workout_intensity'] = 1;
                $coach['day3']['hiit'] = $hiit;
                $coach['day3']['stretching'] = $stretches;
            } elseif ($data['days'] == 4) {
                $sWorkout1 = self::getWorkoutWithExercises($userWorkouts['strength'][0]->id, $intenseFactor, $data['user_id'], $week);

                $sWorkout2 = self::getWorkoutWithExercises($userWorkouts['strength'][1]->id, $intenseFactor, $data['user_id'], $week);

                $sWorkout3 = self::getWorkoutWithExercises($userWorkouts['strength'][2]->id, $intenseFactor, $data['user_id'], $week);
//                  Day1 exercise set
                $coach['day1']['warmup'] = $warmUps;
                $coach['day1']['is_completed'] = 0;
                $coach['day1']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                $coach['day1']['exercises'] = [];
                $coach['day1']['workout'] = $sWorkout1;
                $coach['day1']['skilltraining'] = [];
                $coach['day1']['coach_workout_rounds'] = count($sWorkout1['exercises']);
                $coach['day1']['workout_intensity'] = 1;
                $coach['day1']['hiit'] = [];
                $coach['day1']['stretching'] = $stretches;

//                  Day2 Exercise set
                $coach['day2']['warmup'] = $warmUps;
                $coach['day2']['is_completed'] = 0;
                $coach['day2']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                $coach['day2']['exercises'] = [];
                $coach['day2']['workout'] = [];
                $coach['day2']['skilltraining'] = $skillTraining;
                $coach['day2']['coach_workout_rounds'] = 1;
                $coach['day2']['workout_intensity'] = 1;
                $coach['day2']['hiit'] = [];
                $coach['day2']['stretching'] = $stretches;

//                  Day3 exercise set                    
                $coach['day3']['warmup'] = $warmUps;
                $coach['day3']['is_completed'] = 0;
                $coach['day3']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                $coach['day3']['exercises'] = [];
                $coach['day3']['workout'] = $sWorkout2;
                $coach['day3']['skilltraining'] = [];
                $coach['day3']['coach_workout_rounds'] = count($sWorkout2['exercises']);
                $coach['day3']['workout_intensity'] = 1;
                $coach['day3']['hiit'] = [];
                $coach['day3']['stretching'] = $stretches;

//                  Day4 exercise set
                $coach['day4']['warmup'] = $warmUps;
                $coach['day4']['is_completed'] = 0;
                $coach['day4']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                $coach['day4']['exercises'] = [];
                $coach['day4']['workout'] = [];
                $coach['day4']['skilltraining'] = $skillTraining;
                $coach['day4']['coach_workout_rounds'] = 1;
                $coach['day4']['workout_intensity'] = 1;
                $coach['day4']['hiit'] = $hiit;
                $coach['day4']['stretching'] = $stretches;
            } elseif ($data['days'] == 5) {

                $csWorkout1 = self::getWorkoutWithExercises($userWorkouts['cardio_strength'][0]->id, $intenseFactor, $data['user_id'], $week);

                $sWorkout1 = self::getWorkoutWithExercises($userWorkouts['strength'][0]->id, $intenseFactor, $data['user_id'], $week);

                $sWorkout2 = self::getWorkoutWithExercises($userWorkouts['strength'][1]->id, $intenseFactor, $data['user_id'], $week);

                $sWorkout3 = self::getWorkoutWithExercises($userWorkouts['strength'][2]->id, $intenseFactor, $data['user_id'], $week);


//                  Day1 exercise set
                $coach['day1']['warmup'] = $warmUps;
                $coach['day1']['is_completed'] = 0;
                $coach['day1']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                $coach['day1']['exercises'] = [];
                $coach['day1']['workout'] = [];
                $coach['day1']['skilltraining'] = $skillTraining;
                $coach['day1']['coach_workout_rounds'] = 1;
                $coach['day1']['workout_intensity'] = 1;
                $coach['day1']['hiit'] = [];
                $coach['day1']['stretching'] = $stretches;

//                  Day2 Exercise set
                $coach['day2']['warmup'] = $warmUps;
                $coach['day2']['is_completed'] = 0;
                $coach['day2']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                $coach['day2']['exercises'] = [];
                $coach['day2']['workout'] = $sWorkout1;
                $coach['day2']['skilltraining'] = [];
                $coach['day2']['coach_workout_rounds'] = count($sWorkout1['exercises']);
                $coach['day2']['workout_intensity'] = 1;
                $coach['day2']['hiit'] = [];
                $coach['day2']['stretching'] = $stretches;

//Day3 exercise set
                $coach['day3']['warmup'] = $warmUps;
                $coach['day3']['is_completed'] = 0;
                $coach['day3']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                $coach['day3']['exercises'] = [];
                $coach['day3']['workout'] = [];
                $coach['day3']['skilltraining'] = $skillTraining;
                $coach['day3']['coach_workout_rounds'] = 1;
                $coach['day3']['workout_intensity'] = 1;
                $coach['day3']['hiit'] = [];
                $coach['day3']['stretching'] = $stretches;

//Day4 exercise set
                $coach['day4']['warmup'] = $warmUps;
                $coach['day4']['is_completed'] = 0;
                $coach['day4']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                $coach['day4']['exercises'] = [];
                $coach['day4']['workout'] = $sWorkout2;
                $coach['day4']['skilltraining'] = [];
                $coach['day4']['coach_workout_rounds'] = count($sWorkout2['exercises']);
                $coach['day4']['workout_intensity'] = 1;
                $coach['day4']['hiit'] = [];
                $coach['day4']['stretching'] = $stretches;

//Day5 exercise set 
                $coach['day5']['warmup'] = $warmUps;
                $coach['day5']['is_completed'] = 0;
                $coach['day5']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                $coach['day5']['exercises'] = [];
                $coach['day5']['workout'] = [];
                $coach['day5']['skilltraining'] = $skillTraining;
                $coach['day5']['coach_workout_rounds'] = 1;
                $coach['day5']['workout_intensity'] = 1;
                $coach['day5']['hiit'] = $hiit;
                $coach['day5']['stretching'] = $stretches;
            }
        }

        return array($coach, $exerciseCat);
    }

    /**
     * Get the skill training with exercises
     * @param type $data
     * @return type
     * @author Aneesh K <aneeshk@cubettech.com>
     */
    public static function getUserSkilltainingwithExercises($data)
    {
        $userRaid = DB::table('user_goal_options')->where('user_id', $data['user_id'])->pluck('goal_options');

        if (!is_null($userRaid) && $userRaid != '') {
            $userSkillTrainingId = DB::table('skilltraining_map')->where('skill_id', $userRaid)->pluck('skilltraining_id');
            $skill = DB::table('skills')->where('id', $userRaid)->first();
        } else {
            return [];
        }

        $userSkillTrainingCat = 3;

        $LegendSkills = DB::table('skills')->where('row', $skill->row)->where('progression_id', $skill->progression_id)->whereIn('level', [4, 5])->lists('id');

        $LegendSkillCount = DB::table('unlocked_skills')->whereIn('skill_id', $LegendSkills)->where('user_id', $data['user_id'])->count();

        if ($LegendSkillCount < 1) {
            $userSkillTrainingCat = 2;
        }

        $barzerkerSkills = DB::table('skills')->where('row', $skill->row)->where('progression_id', $skill->progression_id)->where('level', 3)->lists('id');

        $barzerkerSkillCount = DB::table('unlocked_skills')->whereIn('skill_id', $barzerkerSkills)->where('user_id', $data['user_id'])->count();
        if ($userSkillTrainingCat == 2) {
            if ($barzerkerSkillCount < 1) {
                $userSkillTrainingCat = 1;
            }
        }

        $userSkillTraining = Skilltraining::where('id', $userSkillTrainingId)->first();

        if (!is_null($userSkillTraining)) {

            $skilltrainingArray = $userSkillTraining->toArray();

            $rewardsArray = json_decode($skilltrainingArray['rewards'], TRUE);

            if ($userSkillTrainingCat == 1) {
                $skilltrainingArray['rewards'] = $rewardsArray['lean'];
                $skilltrainingArray['focus'] = 1;
            } elseif ($userSkillTrainingCat == 2) {
                $skilltrainingArray['rewards'] = $rewardsArray['athletic'];
                $skilltrainingArray['focus'] = 2;
            } elseif ($userSkillTrainingCat == 3) {
                $skilltrainingArray['rewards'] = $rewardsArray['strength'];
                $skilltrainingArray['focus'] = 3;
            }

            if ($userSkillTraining->is_circuit == 0) {
                $roundExercises = Skilltrainingexercise::where('category', '=', $userSkillTrainingCat)
                        ->where('skilltraining_id', '=', $userSkillTrainingId)
                        ->with(['exercise', 'video'])->get();
                $skilltrainingArray['exercises'] = $roundExercises->toArray();
            } else {
                $rounds = Skilltrainingexercise::where('category', '=', $userSkillTrainingCat)
                        ->where('skilltraining_id', '=', $userSkillTrainingId)->pluck('sets');
                $skilltrainingArray['rounds'] = $rounds;
                for ($i = 1; $i <= $rounds; $i++) {
                    $roundExercises = Skilltrainingexercise::where('category', '=', $userSkillTrainingCat)
                            ->where('skilltraining_id', '=', $userSkillTrainingId)
                            ->with(['exercise', 'video'])->get();
                    $skilltrainingArray['exercises']['round' . $i] = $roundExercises->toArray();
                }
            }
        }
        return $skilltrainingArray;
    }
}
