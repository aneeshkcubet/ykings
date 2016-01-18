<?php namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use DB;
use App\Exercise;

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
        'exercises',
        'category',
        'muscle_groups'
    ];

    public static function prepareCoachExercises($coachId, $data)
    {
        $coach = [];

        $fundumentalArray = [
            1 => [
                ['exercise_id' => 1, 'duration' => [1 => ['min' => 7], 2 => ['min' => 15]], 'unit' => 'times'],
                ['exercise_id' => 13, 'duration' => [1 => ['min' => 10], 2 => ['min' => 20]], 'unit' => 'times'],
                ['exercise_id' => 5, 'duration' => [1 => ['min' => 20], 2 => ['min' => 40]], 'unit' => 'times'],
                ['exercise_id' => 16, 'duration' => [1 => ['min' => 20], 2 => ['min' => 40]], 'unit' => 'times'],
                ['exercise_id' => 7, 'duration' => [1 => ['min' => 10, 'max' => 60], 2 => ['min' => 60, 'max' => 90]], 'unit' => 'seconds']
            ],
            2 => [
                ['exercise_id' => 4, 'duration' => [1 => ['min' => 7], 2 => ['min' => 10]], 'unit' => 'times'],
                ['exercise_id' => 12, 'duration' => [1 => ['min' => 10], 2 => ['min' => 20]], 'unit' => 'times'],
                ['exercise_id' => 36, 'duration' => [1 => ['min' => 20], 2 => ['min' => 40]], 'unit' => 'times'],
                ['exercise_id' => 3, 'duration' => [1 => ['min' => 10], 2 => ['min' => 15]], 'unit' => 'times'],
                ['exercise_id' => 8, 'duration' => [1 => ['min' => 10], 2 => ['min' => 20]], 'unit' => 'times']
            ],
            3 => [
                ['exercise_id' => 4, 'duration' => [1 => ['min' => 7], 2 => ['min' => 10]], 'unit' => 'times'],
                ['exercise_id' => 14, 'duration' => [1 => ['min' => 10], 2 => ['min' => 20]], 'unit' => 'times'],
                ['exercise_id' => 5, 'duration' => [1 => ['min' => 20], 2 => ['min' => 40]], 'unit' => 'times'],
                ['exercise_id' => 17, 'duration' => [1 => ['min' => 10, 'max' => 60], 2 => ['min' => 60, 'max' => 90]], 'unit' => 'seconds'],
                ['exercise_id' => 10, 'duration' => [1 => ['min' => 10], 2 => ['min' => 20]], 'unit' => 'times']
            ],
            4 => [
                ['exercise_id' => 3, 'duration' => [1 => ['min' => 7], 2 => ['min' => 15]], 'unit' => 'times'],
                ['exercise_id' => 46, 'duration' => [1 => ['min' => 10], 2 => ['min' => 20]], 'unit' => 'times'],
                ['exercise_id' => 5, 'duration' => [1 => ['min' => 20], 2 => ['min' => 40]], 'unit' => 'times'],
                ['exercise_id' => 30, 'duration' => [1 => ['min' => 10], 2 => ['min' => 25]], 'unit' => 'times'],
                ['exercise_id' => 11, 'duration' => [1 => ['min' => 10], 2 => ['min' => 20]], 'unit' => 'times']
            ],
            5 => [
                ['exercise_id' => 2, 'duration' => [1 => ['min' => 10], 2 => ['min' => 20]], 'unit' => 'times'],
                ['exercise_id' => 12, 'duration' => [1 => ['min' => 10], 2 => ['min' => 20]], 'unit' => 'times'],
                ['exercise_id' => 36, 'duration' => [1 => ['min' => 20], 2 => ['min' => 40]], 'unit' => 'times'],
                ['exercise_id' => 17, 'duration' => [1 => ['min' => 10, 'max' => 60], 2 => ['min' => 60, 'max' => 90]], 'unit' => 'seconds'],
                ['exercise_id' => 9, 'duration' => [1 => ['min' => 20], 2 => ['min' => 40]], 'unit' => 'times']
            ],
        ];

        foreach ($fundumentalArray as $fKey => $fundumentals) {
            foreach ($fundumentals as $jKey => $jVal) {
                if ($data['category'] == 'beginer') {
                    $fundumentalArray[$fKey][$jKey]['duration'] = $jVal['duration'][1];
                } else {
                    $fundumentalArray[$fKey][$jKey]['duration'] = $jVal['duration'][2];
                }
                $exercise = Exercise::where('id', $jVal['exercise_id'])->with(['video'])->first();
                $fundumentalArray[$fKey][$jKey]['exercise'] = $exercise->toArray();
            }
        }

        $warmUps = DB::table('warmups')->select('*')->get();

        if ($data['test1'] == 0 && $data['test2'] == 0) {
            foreach ($warmUps as $wKey => $warmUp) {
                $duration = $warmUp->duration;

                $durationArray = json_decode($duration, true);

                $warmUps[$wKey]->duration = $durationArray[1];
            }
        } elseif (($data['test1'] == 1 && $data['test2'] == 0) || ($data['test1'] == 1 && $data['test2'] == 1)) {

            foreach ($warmUps as $wKey => $warmUp) {
                $duration = $warmUp->duration;

                $durationArray = json_decode($duration, true);

                $warmUps[$wKey]->duration = $durationArray[2];
            }
        }

        $warmupArray = $warmUps;

        $strechingArray = [
            ['exercise_id' => 'Superman', 'duration' => ['min' => 5, 'max' => 10], 'unit' => 'times'],
            ['exercise_id' => 'Lower Back Strength', 'duration' => ['min' => 30, 'max' => 50], 'unit' => 'times'],
            ['exercise_id' => 'Upper Dog', 'duration' => ['min' => 30, 'max' => 60], 'unit' => 'seconds'],
            ['exercise_id' => 'Child\'s Pose', 'duration' => ['min' => 30, 'max' => 60], 'unit' => 'seconds'],
            ['exercise_id' => 'L-sit on the floor', 'duration' => ['min' => 30, 'max' => 60], 'unit' => 'seconds'],
            ['exercise_id' => 'Frog stretch', 'duration' => ['min' => 30, 'max' => 60], 'unit' => 'seconds'],
            ['exercise_id' => 'Good morning', 'duration' => ['min' => 30, 'max' => 60], 'unit' => 'seconds'],
            ['exercise_id' => 'Chest Opener', 'duration' => ['min' => 30, 'max' => 60], 'unit' => 'seconds'],
            ['exercise_id' => 'Triceps Stretch', 'duration' => ['min' => 30, 'max' => 60], 'unit' => 'seconds'],
            ['exercise_id' => 'Hands Back', 'duration' => ['min' => 30, 'max' => 60], 'unit' => 'seconds'],
            ['exercise_id' => 'Shoulder Stretch', 'duration' => ['min' => 30, 'max' => 60], 'unit' => 'seconds'],
        ];

        $userUnlockedSkillExerciseQuery = DB::table('unlocked_skills')
                ->select('exercise_id')
                ->whereRaw('user_id = ' . $data['user_id'])->toSql();

        if ($data['focus'] == 1) {
            $userMatchedSworkoutsQuery = 'SELECT  t1.id, 
                                                    s.totalCount AS exercise_count 
                                            FROM    workouts AS t1 
                                                    LEFT JOIN
                                                    (
                                                        SELECT  workout_id, COUNT(*) totalCount 
                                                        FROM    workout_exercises 
                                                        WHERE   exercise_id IN(' . $userUnlockedSkillExerciseQuery . ') AND workout_exercises.category = 1
                                                        GROUP   BY workout_id
                                                    )  s ON s.workout_id = t1.id
                                            WHERE   t1.category = 1
                                            ORDER   BY exercise_count DESC';


            $userMatchedCSworkoutsQuery = 'SELECT  t1.id, 
                                                    s.totalCount AS exercise_count 
                                            FROM    workouts AS t1 
                                                    LEFT JOIN
                                                    (
                                                        SELECT  workout_id, COUNT(*) totalCount 
                                                        FROM    workout_exercises 
                                                        WHERE   exercise_id IN(' . $userUnlockedSkillExerciseQuery . ') AND workout_exercises.category = 1
                                                        GROUP   BY workout_id
                                                    )  s ON s.workout_id = t1.id
                                            WHERE   t1.category = 2
                                            ORDER   BY exercise_count DESC';
        } elseif ($data['focus'] == 2) {
            $userMatchedSworkoutsQuery = 'SELECT  t1.id, 
                                                    s.totalCount AS exercise_count 
                                            FROM    workouts AS t1 
                                                    LEFT JOIN
                                                    (
                                                        SELECT  workout_id, COUNT(*) totalCount 
                                                        FROM    workout_exercises 
                                                        WHERE   exercise_id IN(' . $userUnlockedSkillExerciseQuery . ') AND workout_exercises.category = 2
                                                        GROUP   BY workout_id
                                                    )  s ON s.workout_id = t1.id
                                            WHERE   t1.category = 1
                                            ORDER   BY exercise_count DESC';


            $userMatchedCSworkoutsQuery = 'SELECT  t1.id, 
                                                    s.totalCount AS exercise_count 
                                            FROM    workouts AS t1 
                                                    LEFT JOIN
                                                    (
                                                        SELECT  workout_id, COUNT(*) totalCount 
                                                        FROM    workout_exercises 
                                                        WHERE   exercise_id IN(' . $userUnlockedSkillExerciseQuery . ') AND workout_exercises.category = 2
                                                        GROUP   BY workout_id
                                                    )  s ON s.workout_id = t1.id
                                            WHERE   t1.category = 2
                                            ORDER   BY exercise_count DESC';
        } elseif ($data['focus'] == 3) {

            $userMatchedSworkoutsQuery = 'SELECT  t1.id, 
                                                    s.totalCount AS exercise_count 
                                            FROM    workouts AS t1 
                                                    LEFT JOIN
                                                    (
                                                        SELECT  workout_id, COUNT(*) totalCount 
                                                        FROM    workout_exercises 
                                                        WHERE   exercise_id IN(' . $userUnlockedSkillExerciseQuery . ') AND workout_exercises.category = 3
                                                        GROUP   BY workout_id
                                                    )  s ON s.workout_id = t1.id
                                            WHERE   t1.category = 1
                                            ORDER   BY exercise_count DESC';


            $userMatchedCSworkoutsQuery = 'SELECT  t1.id, 
                                                    s.totalCount AS exercise_count 
                                            FROM    workouts AS t1 
                                                    LEFT JOIN
                                                    (
                                                        SELECT  workout_id, COUNT(*) totalCount 
                                                        FROM    workout_exercises 
                                                        WHERE   exercise_id IN(' . $userUnlockedSkillExerciseQuery . ') AND workout_exercises.category = 3
                                                        GROUP   BY workout_id
                                                    )  s ON s.workout_id = t1.id
                                            WHERE   t1.category = 2
                                            ORDER   BY exercise_count DESC';
        }

        $userWorkouts['strength'] = DB::select($userMatchedSworkoutsQuery);

        $userWorkouts['cardio_strength'] = DB::select($userMatchedCSworkoutsQuery);

        if ($data['test1'] == 0 && $data['test2'] == 0) {
            //user failed in test1
            $warmup = $warmupArray;

            $stretches = $strechingArray;
            if ($data['focus'] == 1) {
                $coach = self::getCoachForFocus($warmup, $fundumentalArray, $stretches, $data, $userWorkouts, 1, 'beginer');
            } elseif ($data['focus'] == 2) {
                $coach = self::getCoachForFocus($warmup, $fundumentalArray, $stretches, $data, $userWorkouts, 2, 'beginer');
            } elseif ($data['focus'] == 3) {
                $coach = self::getCoachForFocus($warmup, $fundumentalArray, $stretches, $data, $userWorkouts, 3, 'beginer');
            }
        }

        if ($data['test1'] == 1 && $data['test2'] == 0) {

            $warmup = $warmupArray;

            $stretches = $strechingArray;

            if ($data['focus'] == 1) {
                $coach = self::getCoachForFocus($warmup, $fundumentalArray, $stretches, $data, $userWorkouts, 1, 'advanced');
            } elseif ($data['focus'] == 2) {
                $coach = self::getCoachForFocus($warmup, $fundumentalArray, $stretches, $data, $userWorkouts, 2, 'advanced');
            } elseif ($data['focus'] == 3) {
                $coach = self::getCoachForFocus($warmup, $fundumentalArray, $stretches, $data, $userWorkouts, 3, 'advanced');
            }
        }

        if ($data['test1'] == 1 && $data['test2'] == 1) {

            $warmup = $warmupArray;

            $stretches = $strechingArray;

            foreach ($stretches as $sKey => $sValue) {
                $stretches[$sKey]['duration']['min'] = round($sValue['duration']['min'] + ($sValue['duration']['min'] * (25 / 100)));
                $stretches[$sKey]['duration']['max'] = round($sValue['duration']['max'] + ($sValue['duration']['max'] * (25 / 100)));
            }

            if ($data['focus'] == 1) {
                $coach = self::getCoachForFocus($warmup, $fundumentalArray, $stretches, $data, $userWorkouts, 1, 'professional');
            } elseif ($data['focus'] == 2) {
                $coach = self::getCoachForFocus($warmup, $fundumentalArray, $stretches, $data, $userWorkouts, 2, 'professional');
            } elseif ($data['focus'] == 3) {
                $coach = self::getCoachForFocus($warmup, $fundumentalArray, $stretches, $data, $userWorkouts, 3, 'professional');
            }
        }

        return $coach;
    }

    public static function getCoachForFocus($warmup, $fundumentalArray, $stretches, $data, $userWorkouts, $focus, $userLevel)
    {
        $coach = [];
        if ($userLevel == 'beginer') {
            if ($focus == 1) {

                $userUnlockedSkillExerciseQuery = DB::table('unlocked_skills')
                        ->select('exercise_id')
                        ->whereRaw('user_id = ' . $data['user_id'])->toSql();

                $basicSkillsQuery = DB::table('skills')
                    ->leftJoin('exercises', 'skills.exercise_id', '=', 'exercises.id')
                    ->select('skills.*')
                    ->groupBy('skills.progression_id')
                    ->orderBy('skills.id');
                if ($data['muscle_groups'] != '') {

                    $muscleGroupArray = explode(',', $data['muscle_groups']);
                    $likeQuery = '( ';
                    foreach ($muscleGroupArray as $mgKey => $muscleGroupId) {
                        $likeQuery .= 'exercises.muscle_groups LIKE %' . $muscleGroupId . '%';
                        if ($mgKey < count($muscleGroupArray) - 1) {
                            $likeQuery = $likeQuery . ' OR ';
                        }
                    }
                    $likeQuery .= $likeQuery = ' )';

                    $basicSkillsQuery->whereRaw('skills.exercise_id IN(' . $userUnlockedSkillExerciseQuery . ') AND exercises.category = 1');
                } else {
                    $basicSkillsQuery->whereRaw('skills.exercise_id IN(' . $userUnlockedSkillExerciseQuery . ') AND exercises.category = 1');
                }

                $basicSkills = $basicSkillsQuery->get();

                $exercises = [];
                foreach ($basicSkills as $bKey => $basicSkill) {
                    $exercises[] = Exercise::where('id', $basicSkill->exercise_id)->with(['video'])->first();
                }

                $day1Workout = self::getWorkoutWithExercises($userWorkouts['cardio_strength'][0]->id, $focus);

                $day3Workout = self::getWorkoutWithExercises($userWorkouts['cardio_strength'][1]->id, $focus);

                $day5Workout = self::getWorkoutWithExercises($userWorkouts['cardio_strength'][2]->id, $focus);

                $day6Workout = self::getWorkoutWithExercises($userWorkouts['cardio_strength'][3]->id, $focus);

                if ($data['days'] == 2) {

                    //Day1 exercise set
                    $coach['day1']['warmup'] = $warmup;
                    $coach['day1']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day1']['exercises'] = [];
                    $coach['day1']['workout'] = $day1Workout;
                    $coach['day1']['coach_workout_rounds'] = count($day1Workout['exercises']);
                    $coach['day1']['workout_intensity'] = 1;
                    $coach['day1']['hiit'] = [];
                    $coach['day1']['stretching'] = $stretches;

                    //Day2 Exercise set
                    $coach['day2']['warmup'] = $warmup;
                    $coach['day2']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day2']['exercises'] = $exercises;
                    $coach['day2']['workout'] = [];
                    $coach['day2']['coach_workout_rounds'] = 0;
                    $coach['day2']['workout_intensity'] = 1;
                    $coach['day2']['hiit'] = [['id' => 3, 'intensity' => 3]];
                    $coach['day2']['stretching'] = $stretches;
                } elseif ($data['days'] == 3) {

                    $coach['day1']['warmup'] = $warmup;
                    $coach['day1']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day1']['exercises'] = [];
                    $coach['day1']['workout'] = $day1Workout;
                    $coach['day1']['coach_workout_rounds'] = count($day1Workout['exercises']);
                    $coach['day1']['workout_intensity'] = 1;
                    $coach['day1']['hiit'] = [];
                    $coach['day1']['stretching'] = $stretches;

                    //Day2 Exercise set

                    $coach['day2']['warmup'] = $warmup;
                    $coach['day2']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day2']['exercises'] = $exercises;
                    $coach['day2']['workout'] = [];
                    $coach['day2']['coach_workout_rounds'] = 0;
                    $coach['day2']['workout_intensity'] = 1;
                    $coach['day2']['hiit'] = [['id' => 3, 'intensity' => 3]];
                    $coach['day2']['stretching'] = $stretches;

                    //Day3 exercise set

                    $coach['day3']['warmup'] = $warmup;
                    $coach['day3']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day3']['exercises'] = [];
                    $coach['day3']['workout'] = $day3Workout;
                    $coach['day3']['coach_workout_rounds'] = count($day3Workout['exercises']);
                    $coach['day3']['workout_intensity'] = 1;
                    $coach['day3']['hiit'] = [];
                    $coach['day3']['stretching'] = $stretches;
                } elseif ($data['days'] == 4) {

                    //Day1 exercise set
                    $coach['day1']['warmup'] = $warmup;
                    $coach['day1']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day1']['exercises'] = [];
                    $coach['day1']['workout'] = $day1Workout;
                    $coach['day1']['coach_workout_rounds'] = count($day1Workout['exercises']);
                    $coach['day1']['workout_intensity'] = 1;
                    $coach['day1']['hiit'] = [];
                    $coach['day1']['stretching'] = $stretches;

                    //Day2 Exercise set

                    $coach['day2']['warmup'] = $warmup;
                    $coach['day2']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day2']['exercises'] = $exercises;
                    $coach['day2']['workout'] = [];
                    $coach['day2']['coach_workout_rounds'] = 0;
                    $coach['day2']['workout_intensity'] = 1;
                    $coach['day2']['hiit'] = [['id' => 3, 'intensity' => 3]];
                    $coach['day2']['stretching'] = $stretches;

                    //Day3 exercise set                    
                    $coach['day3']['warmup'] = $warmup;
                    $coach['day3']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day3']['exercises'] = [];
                    $coach['day3']['workout'] = $day3Workout;
                    $coach['day3']['coach_workout_rounds'] = count($day3Workout['exercises']);
                    $coach['day3']['workout_intensity'] = 1;
                    $coach['day3']['hiit'] = [];
                    $coach['day3']['stretching'] = $stretches;

                    //Day4 exercise set
                    $coach['day4']['warmup'] = $warmup;
                    $coach['day4']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day4']['exercises'] = $exercises;
                    $coach['day4']['workout'] = [];
                    $coach['day4']['coach_workout_rounds'] = 0;
                    $coach['day4']['workout_intensity'] = 1;
                    $coach['day4']['hiit'] = [['id' => 3, 'intensity' => 3]];
                    $coach['day4']['stretching'] = $stretches;
                } elseif ($data['days'] == 5) {

                    //Day1 exercise set
                    $coach['day1']['warmup'] = $warmup;
                    $coach['day1']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day1']['exercises'] = [];
                    $coach['day1']['workout'] = $day1Workout;
                    $coach['day1']['coach_workout_rounds'] = count($day1Workout['exercises']);
                    $coach['day1']['workout_intensity'] = 1;
                    $coach['day1']['hiit'] = [];
                    $coach['day1']['stretching'] = $stretches;

                    //Day2 Exercise set
                    $coach['day2']['warmup'] = $warmup;
                    $coach['day2']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day2']['exercises'] = $exercises;
                    $coach['day2']['workout'] = [];
                    $coach['day2']['coach_workout_rounds'] = 0;
                    $coach['day2']['workout_intensity'] = 1;
                    $coach['day2']['hiit'] = [['id' => 3, 'intensity' => 3]];
                    $coach['day2']['stretching'] = $stretches;

                    //Day3 exercise set
                    $coach['day3']['warmup'] = $warmup;
                    $coach['day3']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day3']['exercises'] = [];
                    $coach['day3']['workout'] = $day3Workout;
                    $coach['day3']['coach_workout_rounds'] = count($day3Workout['exercises']);
                    $coach['day3']['workout_intensity'] = 1;
                    $coach['day3']['hiit'] = [];
                    $coach['day3']['stretching'] = $stretches;

                    //Day4 exercise set
                    $coach['day4']['warmup'] = $warmup;
                    $coach['day4']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day4']['exercises'] = $exercises;
                    $coach['day4']['workout'] = [];
                    $coach['day4']['coach_workout_rounds'] = 0;
                    $coach['day4']['workout_intensity'] = 1;
                    $coach['day4']['hiit'] = [['id' => 3, 'intensity' => 3]];
                    $coach['day4']['stretching'] = $stretches;

                    //Day5 exercise set                    
                    $coach['day5']['warmup'] = $warmup;
                    $coach['day5']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day5']['exercises'] = [];
                    $coach['day5']['workout'] = $day5Workout;
                    $coach['day5']['coach_workout_rounds'] = count($day5Workout['exercises']);
                    $coach['day5']['workout_intensity'] = 1;
                    $coach['day5']['hiit'] = [];
                    $coach['day5']['stretching'] = $stretches;
                } elseif ($data['days'] == 6) {
                    //Day1 exercise set
                    $coach['day1']['warmup'] = $warmup;
                    $coach['day1']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day1']['exercises'] = [];
                    $coach['day1']['workout'] = $day1Workout;
                    $coach['day1']['coach_workout_rounds'] = count($day1Workout['exercises']);
                    $coach['day1']['workout_intensity'] = 1;
                    $coach['day1']['hiit'] = [];
                    $coach['day1']['stretching'] = $stretches;

                    //Day2 Exercise set
                    $coach['day2']['warmup'] = $warmup;
                    $coach['day2']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day2']['exercises'] = $exercises;
                    $coach['day2']['workout'] = [];
                    $coach['day2']['coach_workout_rounds'] = 0;
                    $coach['day2']['workout_intensity'] = 1;
                    $coach['day2']['hiit'] = [['id' => 3, 'intensity' => 3]];
                    $coach['day2']['stretching'] = $stretches;

                    //Day3 exercise set
                    $coach['day3']['warmup'] = $warmup;
                    $coach['day3']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day3']['exercises'] = [];
                    $coach['day3']['workout'] = $day3Workout;
                    $coach['day3']['coach_workout_rounds'] = count($day3Workout['exercises']);
                    $coach['day3']['workout_intensity'] = 1;
                    $coach['day3']['hiit'] = [];
                    $coach['day3']['stretching'] = $stretches;

                    //Day4 exercise set
                    $coach['day4']['warmup'] = $warmup;
                    $coach['day4']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day4']['exercises'] = $exercises;
                    $coach['day4']['workout'] = [];
                    $coach['day4']['coach_workout_rounds'] = 0;
                    $coach['day4']['workout_intensity'] = 1;
                    $coach['day4']['hiit'] = [['id' => 3, 'intensity' => 3]];
                    $coach['day4']['stretching'] = $stretches;

                    //Day5 exercise set
                    $coach['day5']['warmup'] = $warmup;
                    $coach['day5']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day5']['exercises'] = $exercises;
                    $coach['day5']['workout'] = [];
                    $coach['day5']['coach_workout_rounds'] = 0;
                    $coach['day5']['workout_intensity'] = 1;
                    $coach['day5']['hiit'] = [['id' => 3, 'intensity' => 3]];
                    $coach['day5']['stretching'] = $stretches;

                    //Day6 exercise set                    
                    $coach['day6']['warmup'] = $warmup;
                    $coach['day6']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day6']['exercises'] = [];
                    $coach['day6']['workout'] = $day5Workout;
                    $coach['day6']['coach_workout_rounds'] = count($day5Workout['exercises']);
                    $coach['day6']['workout_intensity'] = 1;
                    $coach['day6']['hiit'] = [];
                    $coach['day6']['stretching'] = $stretches;
                }
            } elseif ($focus == 2) {

                $userUnlockedSkillExerciseQuery = DB::table('unlocked_skills')
                        ->select('exercise_id')
                        ->whereRaw('user_id = ' . $data['user_id'])->toSql();

                $basicSkillsQuery = DB::table('skills')
                    ->leftJoin('exercises', 'skills.exercise_id', '=', 'exercises.id')
                    ->select('skills.*')
                    ->groupBy('skills.progression_id')
                    ->orderBy('skills.id');
                if ($data['muscle_groups'] != '') {

                    $muscleGroupArray = explode(',', $data['muscle_groups']);
                    $likeQuery = '( ';
                    foreach ($muscleGroupArray as $mgKey => $muscleGroupId) {
                        $likeQuery .= 'exercises.muscle_groups LIKE %' . $muscleGroupId . '%';
                        if ($mgKey < count($muscleGroupArray) - 1) {
                            $likeQuery = $likeQuery . ' OR ';
                        }
                    }
                    $likeQuery .= $likeQuery = ' )';

                    $basicSkillsQuery->whereRaw('skills.exercise_id IN(' . $userUnlockedSkillExerciseQuery . ') AND exercises.category = 2');
                } else {
                    $basicSkillsQuery->whereRaw('skills.exercise_id IN(' . $userUnlockedSkillExerciseQuery . ') AND exercises.category = 2');
                }

                $basicSkills = $basicSkillsQuery->get();
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
                    $coach['day1']['warmup'] = $warmup;
                    $coach['day1']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day1']['exercises'] = [];
                    $coach['day1']['workout'] = $day1Workout;
                    $coach['day1']['coach_workout_rounds'] = count($day1Workout['exercises']);
                    $coach['day1']['workout_intensity'] = 1;
                    $coach['day1']['hiit'] = [];
                    $coach['day1']['stretching'] = $stretches;

                    //Day2 Exercise set
                    $coach['day2']['warmup'] = $warmup;
                    $coach['day2']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day2']['exercises'] = $exercises;
                    $coach['day2']['workout'] = [];
                    $coach['day2']['coach_workout_rounds'] = 0;
                    $coach['day2']['workout_intensity'] = 1;
                    $coach['day2']['hiit'] = [['id' => 3, 'intensity' => 3]];
                    $coach['day2']['stretching'] = $stretches;
                } elseif ($data['days'] == 3) {

                    $coach['day1']['warmup'] = $warmup;
                    $coach['day1']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day1']['exercises'] = [];
                    $coach['day1']['workout'] = $day1Workout;
                    $coach['day1']['coach_workout_rounds'] = count($day1Workout['exercises']);
                    $coach['day1']['workout_intensity'] = 1;
                    $coach['day1']['hiit'] = [];
                    $coach['day1']['stretching'] = $stretches;

                    //Day2 Exercise set

                    $coach['day2']['warmup'] = $warmup;
                    $coach['day2']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day2']['exercises'] = $exercises;
                    $coach['day2']['workout'] = [];
                    $coach['day2']['coach_workout_rounds'] = 0;
                    $coach['day2']['workout_intensity'] = 1;
                    $coach['day2']['hiit'] = [['id' => 3, 'intensity' => 3]];
                    $coach['day2']['stretching'] = $stretches;

                    //Day3 exercise set

                    $coach['day3']['warmup'] = $warmup;
                    $coach['day3']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day3']['exercises'] = [];
                    $coach['day3']['workout'] = $day3Workout;
                    $coach['day3']['coach_workout_rounds'] = count($day3Workout['exercises']);
                    $coach['day3']['workout_intensity'] = 1;
                    $coach['day3']['hiit'] = [];
                    $coach['day3']['stretching'] = $stretches;
                } elseif ($data['days'] == 4) {

                    //Day1 exercise set
                    $coach['day1']['warmup'] = $warmup;
                    $coach['day1']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day1']['exercises'] = [];
                    $coach['day1']['workout'] = $day1Workout;
                    $coach['day1']['coach_workout_rounds'] = count($day1Workout['exercises']);
                    $coach['day1']['workout_intensity'] = 1;
                    $coach['day1']['hiit'] = [];
                    $coach['day1']['stretching'] = $stretches;

                    //Day2 Exercise set

                    $coach['day2']['warmup'] = $warmup;
                    $coach['day2']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day2']['exercises'] = $exercises;
                    $coach['day2']['workout'] = [];
                    $coach['day2']['coach_workout_rounds'] = 0;
                    $coach['day2']['workout_intensity'] = 1;
                    $coach['day2']['hiit'] = [['id' => 3, 'intensity' => 3]];
                    $coach['day2']['stretching'] = $stretches;

                    //Day3 exercise set                    
                    $coach['day3']['warmup'] = $warmup;
                    $coach['day3']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day3']['exercises'] = [];
                    $coach['day3']['workout'] = $day3Workout;
                    $coach['day3']['coach_workout_rounds'] = count($day3Workout['exercises']);
                    $coach['day3']['workout_intensity'] = 1;
                    $coach['day3']['hiit'] = [];
                    $coach['day3']['stretching'] = $stretches;

                    //Day4 exercise set
                    $coach['day4']['warmup'] = $warmup;
                    $coach['day4']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day4']['exercises'] = $exercises;
                    $coach['day4']['workout'] = [];
                    $coach['day4']['coach_workout_rounds'] = 0;
                    $coach['day4']['workout_intensity'] = 1;
                    $coach['day4']['hiit'] = [['id' => 3, 'intensity' => 3]];
                    $coach['day4']['stretching'] = $stretches;
                } elseif ($data['days'] == 5) {

                    //Day1 exercise set
                    $coach['day1']['warmup'] = $warmup;
                    $coach['day1']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day1']['exercises'] = [];
                    $coach['day1']['workout'] = $day1Workout;
                    $coach['day1']['coach_workout_rounds'] = count($day1Workout['exercises']);
                    $coach['day1']['workout_intensity'] = 1;
                    $coach['day1']['hiit'] = [];
                    $coach['day1']['stretching'] = $stretches;

                    //Day2 Exercise set
                    $coach['day2']['warmup'] = $warmup;
                    $coach['day2']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day2']['exercises'] = $exercises;
                    $coach['day2']['workout'] = [];
                    $coach['day2']['coach_workout_rounds'] = 0;
                    $coach['day2']['workout_intensity'] = 1;
                    $coach['day2']['hiit'] = [['id' => 3, 'intensity' => 3]];
                    $coach['day2']['stretching'] = $stretches;

                    //Day3 exercise set
                    $coach['day3']['warmup'] = $warmup;
                    $coach['day3']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day3']['exercises'] = [];
                    $coach['day3']['workout'] = $day3Workout;
                    $coach['day3']['coach_workout_rounds'] = count($day3Workout['exercises']);
                    $coach['day3']['workout_intensity'] = 1;
                    $coach['day3']['hiit'] = [];
                    $coach['day3']['stretching'] = $stretches;

                    //Day4 exercise set
                    $coach['day4']['warmup'] = $warmup;
                    $coach['day4']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day4']['exercises'] = $exercises;
                    $coach['day4']['workout'] = [];
                    $coach['day4']['coach_workout_rounds'] = 0;
                    $coach['day4']['workout_intensity'] = 1;
                    $coach['day4']['hiit'] = [['id' => 3, 'intensity' => 3]];
                    $coach['day4']['stretching'] = $stretches;

                    //Day5 exercise set                    
                    $coach['day5']['warmup'] = $warmup;
                    $coach['day5']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day5']['exercises'] = [];
                    $coach['day5']['workout'] = $day5Workout;
                    $coach['day5']['coach_workout_rounds'] = count($day5Workout['exercises']);
                    $coach['day5']['workout_intensity'] = 1;
                    $coach['day5']['hiit'] = [];
                    $coach['day5']['stretching'] = $stretches;
                } elseif ($data['days'] == 6) {
                    //Day1 exercise set
                    $coach['day1']['warmup'] = $warmup;
                    $coach['day1']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day1']['exercises'] = [];
                    $coach['day1']['workout'] = $day1Workout;
                    $coach['day1']['coach_workout_rounds'] = count($day1Workout['exercises']);
                    $coach['day1']['workout_intensity'] = 1;
                    $coach['day1']['hiit'] = [];
                    $coach['day1']['stretching'] = $stretches;

                    //Day2 Exercise set
                    $coach['day2']['warmup'] = $warmup;
                    $coach['day2']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day2']['exercises'] = $exercises;
                    $coach['day2']['workout'] = [];
                    $coach['day2']['coach_workout_rounds'] = 0;
                    $coach['day2']['workout_intensity'] = 1;
                    $coach['day2']['hiit'] = [['id' => 3, 'intensity' => 3]];
                    $coach['day2']['stretching'] = $stretches;

                    //Day3 exercise set
                    $coach['day3']['warmup'] = $warmup;
                    $coach['day3']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day3']['exercises'] = [];
                    $coach['day3']['workout'] = $day3Workout;
                    $coach['day3']['coach_workout_rounds'] = count($day3Workout['exercises']);
                    $coach['day3']['workout_intensity'] = 1;
                    $coach['day3']['hiit'] = [];
                    $coach['day3']['stretching'] = $stretches;

                    //Day4 exercise set
                    $coach['day4']['warmup'] = $warmup;
                    $coach['day4']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day4']['exercises'] = $exercises;
                    $coach['day4']['workout'] = [];
                    $coach['day4']['coach_workout_rounds'] = 0;
                    $coach['day4']['workout_intensity'] = 1;
                    $coach['day4']['hiit'] = [['id' => 3, 'intensity' => 3]];
                    $coach['day4']['stretching'] = $stretches;

                    //Day5 exercise set
                    $coach['day5']['warmup'] = $warmup;
                    $coach['day5']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day5']['exercises'] = $exercises;
                    $coach['day5']['workout'] = [];
                    $coach['day5']['coach_workout_rounds'] = 0;
                    $coach['day5']['workout_intensity'] = 1;
                    $coach['day5']['hiit'] = [['id' => 3, 'intensity' => 3]];
                    $coach['day5']['stretching'] = $stretches;

                    //Day6 exercise set                    
                    $coach['day6']['warmup'] = $warmup;
                    $coach['day6']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day6']['exercises'] = [];
                    $coach['day6']['workout'] = $day5Workout;
                    $coach['day6']['coach_workout_rounds'] = count($day5Workout['exercises']);
                    $coach['day6']['workout_intensity'] = 1;
                    $coach['day6']['hiit'] = [];
                    $coach['day6']['stretching'] = $stretches;
                }
            } elseif ($focus == 3) {
                $userUnlockedSkillExerciseQuery = DB::table('unlocked_skills')
                        ->select('exercise_id')
                        ->whereRaw('user_id = ' . $data['user_id'])->toSql();

                $basicSkillsQuery = DB::table('skills')
                    ->leftJoin('exercises', 'skills.exercise_id', '=', 'exercises.id')
                    ->select('skills.*')
                    ->groupBy('skills.progression_id')
                    ->orderBy('skills.id');
                if ($data['muscle_groups'] != '') {

                    $muscleGroupArray = explode(',', $data['muscle_groups']);
                    $likeQuery = '( ';
                    foreach ($muscleGroupArray as $mgKey => $muscleGroupId) {
                        $likeQuery .= 'exercises.muscle_groups LIKE %' . $muscleGroupId . '%';
                        if ($mgKey < count($muscleGroupArray) - 1) {
                            $likeQuery = $likeQuery . ' OR ';
                        }
                    }
                    $likeQuery .= $likeQuery = ' )';

                    $basicSkillsQuery->whereRaw('skills.exercise_id IN(' . $userUnlockedSkillExerciseQuery . ') AND exercises.category = 3');
                } else {
                    $basicSkillsQuery->whereRaw('skills.exercise_id IN(' . $userUnlockedSkillExerciseQuery . ') AND exercises.category = 3');
                }

                $basicSkills = $basicSkillsQuery->get();
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
                    $coach['day1']['warmup'] = $warmup;
                    $coach['day1']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day1']['exercises'] = [];
                    $coach['day1']['workout'] = $day1Workout;
                    $coach['day1']['coach_workout_rounds'] = count($day1Workout['exercises']);
                    $coach['day1']['workout_intensity'] = 1;
                    $coach['day1']['hiit'] = [];
                    $coach['day1']['stretching'] = $stretches;

                    //Day2 Exercise set
                    $coach['day2']['warmup'] = $warmup;
                    $coach['day2']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day2']['exercises'] = $exercises;
                    $coach['day2']['workout'] = [];
                    $coach['day2']['coach_workout_rounds'] = 0;
                    $coach['day2']['workout_intensity'] = 1;
                    $coach['day2']['hiit'] = [['id' => 3, 'intensity' => 3]];
                    $coach['day2']['stretching'] = $stretches;
                } elseif ($data['days'] == 3) {

                    $coach['day1']['warmup'] = $warmup;
                    $coach['day1']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day1']['exercises'] = [];
                    $coach['day1']['workout'] = $day1Workout;
                    $coach['day1']['coach_workout_rounds'] = count($day1Workout['exercises']);
                    $coach['day1']['workout_intensity'] = 1;
                    $coach['day1']['hiit'] = [];
                    $coach['day1']['stretching'] = $stretches;

                    //Day2 Exercise set

                    $coach['day2']['warmup'] = $warmup;
                    $coach['day2']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day2']['exercises'] = $exercises;
                    $coach['day2']['workout'] = [];
                    $coach['day2']['coach_workout_rounds'] = 0;
                    $coach['day2']['workout_intensity'] = 1;
                    $coach['day2']['hiit'] = [['id' => 3, 'intensity' => 3]];
                    $coach['day2']['stretching'] = $stretches;

                    //Day3 exercise set

                    $coach['day3']['warmup'] = $warmup;
                    $coach['day3']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day3']['exercises'] = [];
                    $coach['day3']['workout'] = $day3Workout;
                    $coach['day3']['coach_workout_rounds'] = count($day3Workout['exercises']);
                    $coach['day3']['workout_intensity'] = 1;
                    $coach['day3']['hiit'] = [];
                    $coach['day3']['stretching'] = $stretches;
                } elseif ($data['days'] == 4) {

                    //Day1 exercise set
                    $coach['day1']['warmup'] = $warmup;
                    $coach['day1']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day1']['exercises'] = [];
                    $coach['day1']['workout'] = $day1Workout;
                    $coach['day1']['coach_workout_rounds'] = count($day1Workout['exercises']);
                    $coach['day1']['workout_intensity'] = 1;
                    $coach['day1']['hiit'] = [];
                    $coach['day1']['stretching'] = $stretches;

                    //Day2 Exercise set

                    $coach['day2']['warmup'] = $warmup;
                    $coach['day2']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day2']['exercises'] = $exercises;
                    $coach['day2']['workout'] = [];
                    $coach['day2']['coach_workout_rounds'] = 0;
                    $coach['day2']['workout_intensity'] = 1;
                    $coach['day2']['hiit'] = [['id' => 3, 'intensity' => 3]];
                    $coach['day2']['stretching'] = $stretches;

                    //Day3 exercise set                    
                    $coach['day3']['warmup'] = $warmup;
                    $coach['day3']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day3']['exercises'] = [];
                    $coach['day3']['workout'] = $day3Workout;
                    $coach['day3']['coach_workout_rounds'] = count($day3Workout['exercises']);
                    $coach['day3']['workout_intensity'] = 1;
                    $coach['day3']['hiit'] = [];
                    $coach['day3']['stretching'] = $stretches;

                    //Day4 exercise set
                    $coach['day4']['warmup'] = $warmup;
                    $coach['day4']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day4']['exercises'] = $exercises;
                    $coach['day4']['workout'] = [];
                    $coach['day4']['coach_workout_rounds'] = 0;
                    $coach['day4']['workout_intensity'] = 1;
                    $coach['day4']['hiit'] = [['id' => 3, 'intensity' => 3]];
                    $coach['day4']['stretching'] = $stretches;
                } elseif ($data['days'] == 5) {

                    //Day1 exercise set
                    $coach['day1']['warmup'] = $warmup;
                    $coach['day1']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day1']['exercises'] = [];
                    $coach['day1']['workout'] = $day1Workout;
                    $coach['day1']['coach_workout_rounds'] = count($day1Workout['exercises']);
                    $coach['day1']['workout_intensity'] = 1;
                    $coach['day1']['hiit'] = [];
                    $coach['day1']['stretching'] = $stretches;

                    //Day2 Exercise set
                    $coach['day2']['warmup'] = $warmup;
                    $coach['day2']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day2']['exercises'] = $exercises;
                    $coach['day2']['workout'] = [];
                    $coach['day2']['coach_workout_rounds'] = 0;
                    $coach['day2']['workout_intensity'] = 1;
                    $coach['day2']['hiit'] = [['id' => 3, 'intensity' => 3]];
                    $coach['day2']['stretching'] = $stretches;

                    //Day3 exercise set
                    $coach['day3']['warmup'] = $warmup;
                    $coach['day3']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day3']['exercises'] = [];
                    $coach['day3']['workout'] = $day3Workout;
                    $coach['day3']['coach_workout_rounds'] = count($day3Workout['exercises']);
                    $coach['day3']['workout_intensity'] = 1;
                    $coach['day3']['hiit'] = [];
                    $coach['day3']['stretching'] = $stretches;

                    //Day4 exercise set
                    $coach['day4']['warmup'] = $warmup;
                    $coach['day4']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day4']['exercises'] = $exercises;
                    $coach['day4']['workout'] = [];
                    $coach['day4']['coach_workout_rounds'] = 0;
                    $coach['day4']['workout_intensity'] = 1;
                    $coach['day4']['hiit'] = [['id' => 3, 'intensity' => 3]];
                    $coach['day4']['stretching'] = $stretches;

                    //Day5 exercise set                    
                    $coach['day5']['warmup'] = $warmup;
                    $coach['day5']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day5']['exercises'] = [];
                    $coach['day5']['workout'] = $day5Workout;
                    $coach['day5']['coach_workout_rounds'] = count($day5Workout['exercises']);
                    $coach['day5']['workout_intensity'] = 1;
                    $coach['day5']['hiit'] = [];
                    $coach['day5']['stretching'] = $stretches;
                } elseif ($data['days'] == 6) {
                    //Day1 exercise set
                    $coach['day1']['warmup'] = $warmup;
                    $coach['day1']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day1']['exercises'] = [];
                    $coach['day1']['workout'] = $day1Workout;
                    $coach['day1']['coach_workout_rounds'] = count($day1Workout['exercises']);
                    $coach['day1']['workout_intensity'] = 1;
                    $coach['day1']['hiit'] = [];
                    $coach['day1']['stretching'] = $stretches;

                    //Day2 Exercise set
                    $coach['day2']['warmup'] = $warmup;
                    $coach['day2']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day2']['exercises'] = $exercises;
                    $coach['day2']['workout'] = [];
                    $coach['day2']['coach_workout_rounds'] = 0;
                    $coach['day2']['workout_intensity'] = 1;
                    $coach['day2']['hiit'] = [['id' => 3, 'intensity' => 3]];
                    $coach['day2']['stretching'] = $stretches;

                    //Day3 exercise set
                    $coach['day3']['warmup'] = $warmup;
                    $coach['day3']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day3']['exercises'] = [];
                    $coach['day3']['workout'] = $day3Workout;
                    $coach['day3']['coach_workout_rounds'] = count($day3Workout['exercises']);
                    $coach['day3']['workout_intensity'] = 1;
                    $coach['day3']['hiit'] = [];
                    $coach['day3']['stretching'] = $stretches;

                    //Day4 exercise set
                    $coach['day4']['warmup'] = $warmup;
                    $coach['day4']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day4']['exercises'] = $exercises;
                    $coach['day4']['workout'] = [];
                    $coach['day4']['coach_workout_rounds'] = 0;
                    $coach['day4']['workout_intensity'] = 1;
                    $coach['day4']['hiit'] = [['id' => 3, 'intensity' => 3]];
                    $coach['day4']['stretching'] = $stretches;

                    //Day5 exercise set
                    $coach['day5']['warmup'] = $warmup;
                    $coach['day5']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day5']['exercises'] = $exercises;
                    $coach['day5']['workout'] = [];
                    $coach['day5']['coach_workout_rounds'] = 0;
                    $coach['day5']['workout_intensity'] = 1;
                    $coach['day5']['hiit'] = [['id' => 3, 'intensity' => 3]];
                    $coach['day5']['stretching'] = $stretches;

                    //Day6 exercise set                    
                    $coach['day6']['warmup'] = $warmup;
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


            $userCompletedExercisesQuery = DB::table('exercise_users')
                ->select('exercise_id')
                ->where('user_id', $data['user_id'])
                ->toSql();


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
                    $coach['day1']['warmup'] = $warmup;
                    $coach['day1']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    //intensify csWorkout1
                    $coach['day1']['exercises'] = [];
                    $coach['day1']['workout'] = self::intensifyWorkout($csWorkout1, 1);
                    $coach['day1']['coach_workout_rounds'] = count($coach['day1']['workout']['exercises']);
                    $coach['day1']['workout_intensity'] = 2;
                    $coach['day1']['hiit'] = [];
                    $coach['day1']['stretching'] = $stretches;

                    //Day2 Exercise set
                    $coach['day2']['warmup'] = $warmup;
                    $coach['day2']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day2']['exercises'] = [];
                    $coach['day2']['workout'] = $csWorkout2;
                    $coach['day2']['coach_workout_rounds'] = count($csWorkout2);
                    $coach['day2']['workout_intensity'] = 1;
                    $coach['day2']['hiit'] = [['id' => 1, 'intensity' => 4]];
                    $coach['day2']['stretching'] = $stretches;
                } elseif ($data['days'] == 3) {

                    //Day1 exercise set
                    $coach['day1']['warmup'] = $warmup;
                    $coach['day1']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day1']['exercises'] = [];
                    //intensify csWorkout1
                    $coach['day1']['workout'] = self::intensifyWorkout($csWorkout1, 1);
                    $coach['day1']['coach_workout_rounds'] = count($coach['day1']['workout']['exercises']);
                    $coach['day1']['workout_intensity'] = 2;
                    $coach['day1']['hiit'] = [];
                    $coach['day1']['stretching'] = $stretches;

                    //Day2 Exercise set
                    $coach['day2']['warmup'] = $warmup;
                    $coach['day2']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day2']['exercises'] = [];
                    $coach['day2']['workout'] = $csWorkout2;
                    $coach['day2']['coach_workout_rounds'] = count($csWorkout2);
                    $coach['day2']['workout_intensity'] = 1;
                    $coach['day2']['hiit'] = [['id' => 1, 'intensity' => 4]];
                    $coach['day2']['stretching'] = $stretches;

                    //Day3 Exercise set
                    $coach['day3']['warmup'] = $warmup;
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
                    $coach['day1']['warmup'] = $warmup;
                    $coach['day1']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day1']['exercises'] = [];
                    //intensify csWorkout1
                    $coach['day1']['workout'] = self::intensifyWorkout($csWorkout1, 1);
                    $coach['day1']['coach_workout_rounds'] = count($coach['day1']['workout']['exercises']);
                    $coach['day1']['workout_intensity'] = 2;
                    $coach['day1']['hiit'] = [];
                    $coach['day1']['stretching'] = $stretches;

                    //Day2 Exercise set
                    $coach['day2']['warmup'] = $warmup;
                    $coach['day2']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day2']['exercises'] = [];
                    $coach['day2']['workout'] = $csWorkout2;
                    $coach['day2']['coach_workout_rounds'] = count($csWorkout2);
                    $coach['day2']['workout_intensity'] = 1;
                    $coach['day2']['hiit'] = [['id' => 3, 'intensity' => 3]];
                    $coach['day2']['stretching'] = $stretches;

                    //Day3 Exercise set
                    $coach['day3']['warmup'] = $warmup;
                    $coach['day3']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day3']['exercises'] = [];
                    //intensify sWorkout2
                    $coach['day3']['workout'] = self::intensifyWorkout($csWorkout3, 1);
                    $coach['day3']['coach_workout_rounds'] = count($coach['day3']['workout']['exercises']);
                    $coach['day3']['workout_intensity'] = 2;
                    $coach['day3']['hiit'] = [];
                    $coach['day3']['stretching'] = $stretches;

                    //Day4 Exercise set
                    $coach['day4']['warmup'] = $warmup;
                    $coach['day4']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day4']['exercises'] = [];
                    //intensify sWorkout2
                    $coach['day4']['workout'] = $sWorkout1;
                    $coach['day4']['coach_workout_rounds'] = count($coach['day4']['workout']['exercises']);
                    $coach['day4']['workout_intensity'] = 1;
                    $coach['day4']['hiit'] = [['id' => 1, 'intensity' => 4]];
                    $coach['day4']['stretching'] = $stretches;
                } elseif ($data['days'] == 5) {

                    //Day1 exercise set
                    $coach['day1']['warmup'] = $warmup;
                    $coach['day1']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day1']['exercises'] = [];
                    //intensify csWorkout1
                    $coach['day1']['workout'] = self::intensifyWorkout($csWorkout1, 1);
                    $coach['day1']['coach_workout_rounds'] = count($coach['day1']['workout']['exercises']);
                    $coach['day1']['workout_intensity'] = 2;
                    $coach['day1']['hiit'] = [];
                    $coach['day1']['stretching'] = $stretches;

                    //Day2 Exercise set
                    $coach['day2']['warmup'] = $warmup;
                    $coach['day2']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day2']['exercises'] = [];
                    $coach['day2']['workout'] = $csWorkout2;
                    $coach['day2']['coach_workout_rounds'] = count($csWorkout2);
                    $coach['day2']['workout_intensity'] = 1;
                    $coach['day2']['hiit'] = [['id' => 1, 'intensity' => 4]];
                    $coach['day2']['stretching'] = $stretches;

                    //Day3 Exercise set
                    $coach['day3']['warmup'] = $warmup;
                    $coach['day3']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day3']['exercises'] = [];
                    //intensify sWorkout2
                    $coach['day3']['workout'] = self::intensifyWorkout($csWorkout3, 1);
                    $coach['day3']['coach_workout_rounds'] = count($coach['day3']['workout']['exercises']);
                    $coach['day3']['workout_intensity'] = 2;
                    $coach['day3']['hiit'] = [];
                    $coach['day3']['stretching'] = $stretches;

                    //Day4 Exercise set
                    $coach['day4']['warmup'] = $warmup;
                    $coach['day4']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day4']['exercises'] = [];
                    //intensify sWorkout2
                    $coach['day4']['workout'] = $sWorkout1;
                    $coach['day4']['coach_workout_rounds'] = count($coach['day4']['workout']['exercises']);
                    $coach['day4']['workout_intensity'] = 1;
                    $coach['day4']['hiit'] = [['id' => 3, 'intensity' => 3]];
                    $coach['day4']['stretching'] = $stretches;

                    //Day5 Exercise set
                    $coach['day5']['warmup'] = $warmup;
                    $coach['day5']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day5']['exercises'] = [];
                    //intensify sWorkout2
                    $coach['day5']['workout'] = self::intensifyWorkout($sWorkout2, 1);
                    $coach['day5']['coach_workout_rounds'] = count($coach['day5']['workout']['exercises']);
                    $coach['day5']['workout_intensity'] = 2;
                    $coach['day5']['hiit'] = [['id' => 1, 'intensity' => 4]];
                    $coach['day5']['stretching'] = $stretches;
                } elseif ($data['days'] == 6) {

                    //Day1 exercise set
                    $coach['day1']['warmup'] = $warmup;
                    $coach['day1']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day1']['exercises'] = [];
                    //intensify csWorkout1
                    $coach['day1']['workout'] = self::intensifyWorkout($csWorkout1, 1);
                    $coach['day1']['coach_workout_rounds'] = count($coach['day1']['workout']['exercises']);
                    $coach['day1']['workout_intensity'] = 2;
                    $coach['day1']['hiit'] = [];
                    $coach['day1']['stretching'] = $stretches;

                    //Day2 Exercise set
                    $coach['day2']['warmup'] = $warmup;
                    $coach['day2']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day2']['exercises'] = [];
                    $coach['day2']['workout'] = $csWorkout2;
                    $coach['day2']['coach_workout_rounds'] = count($csWorkout2);
                    $coach['day2']['workout_intensity'] = 1;
                    $coach['day2']['hiit'] = [['id' => 1, 'intensity' => 4], ['id' => 1, 'intensity' => 3]];
                    $coach['day2']['stretching'] = $stretches;

                    //Day3 Exercise set
                    $coach['day3']['warmup'] = $warmup;
                    $coach['day3']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day3']['exercises'] = [];
                    //intensify sWorkout2
                    $coach['day3']['workout'] = self::intensifyWorkout($csWorkout3, 1);
                    $coach['day3']['coach_workout_rounds'] = count($coach['day3']['workout']['exercises']);
                    $coach['day3']['workout_intensity'] = 2;
                    $coach['day3']['hiit'] = [];
                    $coach['day3']['stretching'] = $stretches;

                    //Day4 Exercise set
                    $coach['day4']['warmup'] = $warmup;
                    $coach['day4']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day4']['exercises'] = [];
                    //intensify sWorkout2
                    $coach['day4']['workout'] = self::intensifyWorkout($csWorkout4, 1);
                    $coach['day4']['coach_workout_rounds'] = count($coach['day4']['workout']['exercises']);
                    $coach['day4']['workout_intensity'] = 2;
                    $coach['day4']['hiit'] = [];
                    $coach['day4']['stretching'] = $stretches;

                    //Day5 Exercise set
                    $coach['day5']['warmup'] = $warmup;
                    $coach['day5']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day5']['exercises'] = [];
                    //intensify sWorkout2
                    $coach['day5']['workout'] = $sWorkout1;
                    $coach['day5']['coach_workout_rounds'] = count($coach['day5']['workout']['exercises']);
                    $coach['day5']['workout_intensity'] = 1;
                    $coach['day5']['hiit'] = [['id' => 3, 'intensity' => 3]];
                    $coach['day5']['stretching'] = $stretches;

                    //Day5 Exercise set
                    $coach['day6']['warmup'] = $warmup;
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
                    $coach['day1']['warmup'] = $warmup;
                    $coach['day1']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day1']['exercises'] = [];
                    //intensify csWorkout1
                    $coach['day1']['workout'] = self::intensifyWorkout($csWorkout1, 1);
                    $coach['day1']['coach_workout_rounds'] = count($coach['day1']['workout']['exercises']);
                    $coach['day1']['workout_intensity'] = 2;
                    $coach['day1']['hiit'] = [];
                    $coach['day1']['stretching'] = $stretches;

                    //Day2 Exercise set
                    $coach['day2']['warmup'] = $warmup;
                    $coach['day2']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day2']['exercises'] = [];
                    $coach['day2']['workout'] = $sWorkout1;
                    $coach['day2']['coach_workout_rounds'] = count($coach['day2']['workout']['exercises']);
                    $coach['day2']['workout_intensity'] = 1;
                    $coach['day2']['hiit'] = [['id' => 1, 'intensity' => 4]];
                    $coach['day2']['stretching'] = $stretches;
                } elseif ($data['days'] == 3) {

                    //Day1 exercise set
                    $coach['day1']['warmup'] = $warmup;
                    $coach['day1']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day1']['exercises'] = [];
                    //intensify csWorkout1
                    $coach['day1']['workout'] = self::intensifyWorkout($csWorkout1, 1);
                    $coach['day1']['coach_workout_rounds'] = count($coach['day1']['workout']['exercises']);
                    $coach['day1']['workout_intensity'] = 2;
                    $coach['day1']['hiit'] = [];
                    $coach['day1']['stretching'] = $stretches;

                    //Day2 Exercise set
                    $coach['day2']['warmup'] = $warmup;
                    $coach['day2']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day2']['exercises'] = [];
                    $coach['day2']['workout'] = $sWorkout1;
                    $coach['day2']['coach_workout_rounds'] = count($coach['day2']['workout']['exercises']);
                    $coach['day2']['workout_intensity'] = 1;
                    $coach['day2']['hiit'] = [['id' => 1, 'intensity' => 4]];
                    $coach['day2']['stretching'] = $stretches;

                    //Day3 Exercise set
                    $coach['day3']['warmup'] = $warmup;
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
                    $coach['day1']['warmup'] = $warmup;
                    $coach['day1']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day1']['exercises'] = [];
                    //intensify csWorkout1
                    $coach['day1']['workout'] = self::intensifyWorkout($csWorkout1, 1);
                    $coach['day1']['coach_workout_rounds'] = count($coach['day1']['workout']['exercises']);
                    $coach['day1']['workout_intensity'] = 2;
                    $coach['day1']['hiit'] = [];
                    $coach['day1']['stretching'] = $stretches;

                    //Day2 Exercise set
                    $coach['day2']['warmup'] = $warmup;
                    $coach['day2']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day2']['exercises'] = [];
                    $coach['day2']['workout'] = $csWorkout2;
                    $coach['day2']['coach_workout_rounds'] = count($csWorkout2);
                    $coach['day2']['workout_intensity'] = 1;
                    $coach['day2']['hiit'] = [['id' => 3, 'intensity' => 3]];
                    $coach['day2']['stretching'] = $stretches;

                    //Day3 Exercise set
                    $coach['day3']['warmup'] = $warmup;
                    $coach['day3']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day3']['exercises'] = [];
                    //intensify sWorkout2
                    $coach['day3']['workout'] = self::intensifyWorkout($sWorkout1, 1);
                    $coach['day3']['coach_workout_rounds'] = count($coach['day3']['workout']['exercises']);
                    $coach['day3']['workout_intensity'] = 2;
                    $coach['day3']['hiit'] = [];
                    $coach['day3']['stretching'] = $stretches;

                    //Day4 Exercise set
                    $coach['day4']['warmup'] = $warmup;
                    $coach['day4']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day4']['exercises'] = [];
                    //intensify sWorkout2
                    $coach['day4']['workout'] = $sWorkout2;
                    $coach['day4']['coach_workout_rounds'] = count($coach['day4']['workout']['exercises']);
                    $coach['day4']['workout_intensity'] = 1;
                    $coach['day4']['hiit'] = [['id' => 1, 'intensity' => 4]];
                    $coach['day4']['stretching'] = $stretches;
                } elseif ($data['days'] == 5) {

                    //Day1 exercise set
                    $coach['day1']['warmup'] = $warmup;
                    $coach['day1']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day1']['exercises'] = [];
                    //intensify csWorkout1
                    $coach['day1']['workout'] = self::intensifyWorkout($csWorkout1, 1);
                    $coach['day1']['coach_workout_rounds'] = count($coach['day1']['workout']['exercises']);
                    $coach['day1']['workout_intensity'] = 2;
                    $coach['day1']['hiit'] = [];
                    $coach['day1']['stretching'] = $stretches;

                    //Day2 Exercise set
                    $coach['day2']['warmup'] = $warmup;
                    $coach['day2']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day2']['exercises'] = [];
                    $coach['day2']['workout'] = $csWorkout2;
                    $coach['day2']['coach_workout_rounds'] = count($csWorkout2);
                    $coach['day2']['workout_intensity'] = 1;
                    $coach['day2']['hiit'] = [['id' => 1, 'intensity' => 4]];
                    $coach['day2']['stretching'] = $stretches;

                    //Day3 Exercise set
                    $coach['day3']['warmup'] = $warmup;
                    $coach['day3']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day3']['exercises'] = [];
                    //intensify sWorkout2
                    $coach['day3']['workout'] = self::intensifyWorkout($csWorkout3, 1);
                    $coach['day3']['coach_workout_rounds'] = count($coach['day3']['workout']['exercises']);
                    $coach['day3']['workout_intensity'] = 2;
                    $coach['day3']['hiit'] = [];
                    $coach['day3']['stretching'] = $stretches;

                    //Day4 Exercise set
                    $coach['day4']['warmup'] = $warmup;
                    $coach['day4']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day4']['exercises'] = [];
                    //intensify sWorkout2
                    $coach['day4']['workout'] = $sWorkout1;
                    $coach['day4']['coach_workout_rounds'] = count($coach['day4']['workout']['exercises']);
                    $coach['day4']['workout_intensity'] = 1;
                    $coach['day4']['hiit'] = [['id' => 3, 'intensity' => 3]];
                    $coach['day4']['stretching'] = $stretches;

                    //Day5 Exercise set
                    $coach['day5']['warmup'] = $warmup;
                    $coach['day5']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day5']['exercises'] = [];
                    //intensify sWorkout2
                    $coach['day5']['workout'] = self::intensifyWorkout($sWorkout2, 1);
                    $coach['day5']['coach_workout_rounds'] = count($coach['day5']['workout']['exercises']);
                    $coach['day5']['hiit'] = [['id' => 1, 'intensity' => 4]];
                    $coach['day5']['stretching'] = $stretches;
                } elseif ($data['days'] == 6) {

                    //Day1 exercise set
                    $coach['day1']['warmup'] = $warmup;
                    $coach['day1']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day1']['exercises'] = [];
                    //intensify csWorkout1
                    $coach['day1']['workout'] = self::intensifyWorkout($csWorkout1, 1);
                    $coach['day1']['coach_workout_rounds'] = count($coach['day1']['workout']['exercises']);
                    $coach['day1']['workout_intensity'] = 2;
                    $coach['day1']['hiit'] = [];
                    $coach['day1']['stretching'] = $stretches;

                    //Day2 Exercise set
                    $coach['day2']['warmup'] = $warmup;
                    $coach['day2']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day2']['exercises'] = [];
                    $coach['day2']['workout'] = $csWorkout2;
                    $coach['day2']['coach_workout_rounds'] = count($csWorkout2);
                    $coach['day2']['workout_intensity'] = 1;
                    $coach['day2']['hiit'] = [['id' => 1, 'intensity' => 4], ['id' => 1, 'intensity' => 3]];
                    $coach['day2']['stretching'] = $stretches;

                    //Day3 Exercise set
                    $coach['day3']['warmup'] = $warmup;
                    $coach['day3']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day3']['exercises'] = [];
                    //intensify sWorkout2
                    $coach['day3']['workout'] = self::intensifyWorkout($csWorkout3, 1);
                    $coach['day3']['coach_workout_rounds'] = count($coach['day3']['workout']['exercises']);
                    $coach['day3']['workout_intensity'] = 2;
                    $coach['day4']['hiit'] = [];
                    $coach['day3']['stretching'] = $stretches;

                    //Day4 Exercise set
                    $coach['day4']['warmup'] = $warmup;
                    $coach['day4']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day4']['exercises'] = [];
                    //intensify sWorkout2
                    $coach['day4']['workout'] = self::intensifyWorkout($sWorkout1, 1);
                    $coach['day4']['coach_workout_rounds'] = count($coach['day4']['workout']['exercises']);
                    $coach['day4']['workout_intensity'] = 2;
                    $coach['day4']['hiit'] = [];
                    $coach['day4']['stretching'] = $stretches;

                    //Day5 Exercise set
                    $coach['day5']['warmup'] = $warmup;
                    $coach['day5']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day5']['exercises'] = [];
                    //intensify sWorkout2
                    $coach['day5']['workout'] = $sWorkout2;
                    $coach['day5']['coach_workout_rounds'] = count($coach['day5']['workout']['exercises']);
                    $coach['day5']['workout_intensity'] = 1;
                    $coach['day5']['hiit'] = [['id' => 3, 'intensity' => 3]];
                    $coach['day5']['stretching'] = $stretches;

                    //Day5 Exercise set
                    $coach['day6']['warmup'] = $warmup;
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
                    $coach['day1']['warmup'] = $warmup;
                    $coach['day1']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day1']['exercises'] = [];
                    //intensify csWorkout1
                    $coach['day1']['workout'] = self::intensifyWorkout($csWorkout1, 1);
                    $coach['day1']['coach_workout_rounds'] = count($coach['day1']['workout']['exercises']);
                    $coach['day1']['workout_intensity'] = 2;
                    $coach['day1']['hiit'] = [];
                    $coach['day1']['stretching'] = $stretches;

                    //Day2 Exercise set
                    $coach['day2']['warmup'] = $warmup;
                    $coach['day2']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day2']['exercises'] = [];
                    $coach['day2']['workout'] = $sWorkout1;
                    $coach['day2']['coach_workout_rounds'] = count($coach['day2']['workout']['exercises']);
                    $coach['day2']['workout_intensity'] = 1;
                    $coach['day2']['hiit'] = [['id' => 1, 'intensity' => 4]];
                    $coach['day2']['stretching'] = $stretches;
                } elseif ($data['days'] == 3) {

                    //Day1 exercise set
                    $coach['day1']['warmup'] = $warmup;
                    $coach['day1']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day1']['exercises'] = [];
                    //intensify csWorkout1
                    $coach['day1']['workout'] = self::intensifyWorkout($csWorkout1, 1);
                    $coach['day1']['coach_workout_rounds'] = count($coach['day1']['workout']['exercises']);
                    $coach['day1']['workout_intensity'] = 2;
                    $coach['day1']['hiit'] = [];
                    $coach['day1']['stretching'] = $stretches;

                    //Day2 Exercise set
                    $coach['day2']['warmup'] = $warmup;
                    $coach['day2']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day2']['exercises'] = [];
                    $coach['day2']['workout'] = $sWorkout1;
                    $coach['day2']['coach_workout_rounds'] = count($coach['day2']['workout']['exercises']);
                    $coach['day2']['workout_intensity'] = 1;
                    $coach['day2']['hiit'] = [['id' => 1, 'intensity' => 4]];
                    $coach['day2']['stretching'] = $stretches;

                    //Day3 Exercise set
                    $coach['day3']['warmup'] = $warmup;
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
                    $coach['day1']['warmup'] = $warmup;
                    $coach['day1']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day1']['exercises'] = [];
                    //intensify csWorkout1
                    $coach['day1']['workout'] = self::intensifyWorkout($csWorkout1, 1);
                    $coach['day1']['coach_workout_rounds'] = count($coach['day1']['workout']['exercises']);
                    $coach['day1']['workout_intensity'] = 2;
                    $coach['day1']['hiit'] = [];
                    $coach['day1']['stretching'] = $stretches;

                    //Day2 Exercise set
                    $coach['day2']['warmup'] = $warmup;
                    $coach['day2']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day2']['exercises'] = [];
                    $coach['day2']['workout'] = $csWorkout2;
                    $coach['day2']['coach_workout_rounds'] = count($csWorkout2);
                    $coach['day2']['workout_intensity'] = 1;
                    $coach['day2']['hiit'] = [['id' => 3, 'intensity' => 3]];
                    $coach['day2']['stretching'] = $stretches;

                    //Day3 Exercise set
                    $coach['day3']['warmup'] = $warmup;
                    $coach['day3']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day3']['exercises'] = [];
                    //intensify sWorkout2
                    $coach['day3']['workout'] = self::intensifyWorkout($sWorkout1, 1);
                    $coach['day3']['coach_workout_rounds'] = count($coach['day3']['workout']['exercises']);
                    $coach['day3']['workout_intensity'] = 2;
                    $coach['day3']['hiit'] = [];
                    $coach['day3']['stretching'] = $stretches;

                    //Day4 Exercise set
                    $coach['day4']['warmup'] = $warmup;
                    $coach['day4']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day4']['exercises'] = [];
                    //intensify sWorkout2
                    $coach['day4']['workout'] = $sWorkout2;
                    $coach['day4']['coach_workout_rounds'] = count($coach['day4']['workout']['exercises']);
                    $coach['day4']['workout_intensity'] = 1;
                    $coach['day4']['hiit'] = [['id' => 1, 'intensity' => 4]];
                    $coach['day4']['stretching'] = $stretches;
                } elseif ($data['days'] == 5) {

                    //Day1 exercise set
                    $coach['day1']['warmup'] = $warmup;
                    $coach['day1']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day1']['exercises'] = [];
                    //intensify csWorkout1
                    $coach['day1']['workout'] = self::intensifyWorkout($csWorkout1, 1);
                    $coach['day1']['coach_workout_rounds'] = count($coach['day1']['workout']['exercises']);
                    $coach['day1']['workout_intensity'] = 2;
                    $coach['day1']['hiit'] = [];
                    $coach['day1']['stretching'] = $stretches;

                    //Day2 Exercise set
                    $coach['day2']['warmup'] = $warmup;
                    $coach['day2']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day2']['exercises'] = [];
                    $coach['day2']['workout'] = $csWorkout2;
                    $coach['day2']['coach_workout_rounds'] = count($csWorkout2);
                    $coach['day2']['workout_intensity'] = 1;
                    $coach['day2']['hiit'] = [['id' => 1, 'intensity' => 4]];
                    $coach['day2']['stretching'] = $stretches;

                    //Day3 Exercise set
                    $coach['day3']['warmup'] = $warmup;
                    $coach['day3']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day3']['exercises'] = [];
                    //intensify sWorkout2
                    $coach['day3']['workout'] = self::intensifyWorkout($csWorkout3, 1);
                    $coach['day3']['coach_workout_rounds'] = count($coach['day3']['workout']['exercises']);
                    $coach['day3']['workout_intensity'] = 2;
                    $coach['day3']['hiit'] = [];
                    $coach['day3']['stretching'] = $stretches;

                    //Day4 Exercise set
                    $coach['day4']['warmup'] = $warmup;
                    $coach['day4']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day4']['exercises'] = [];
                    //intensify sWorkout2
                    $coach['day4']['workout'] = $sWorkout1;
                    $coach['day4']['coach_workout_rounds'] = count($coach['day4']['workout']['exercises']);
                    $coach['day4']['workout_intensity'] = 1;
                    $coach['day4']['hiit'] = [['id' => 3, 'intensity' => 3]];
                    $coach['day4']['stretching'] = $stretches;

                    //Day5 Exercise set
                    $coach['day5']['warmup'] = $warmup;
                    $coach['day5']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day5']['exercises'] = [];
                    //intensify sWorkout2
                    $coach['day5']['workout'] = self::intensifyWorkout($sWorkout2, 1);
                    $coach['day5']['coach_workout_rounds'] = count($coach['day5']['workout']['exercises']);
                    $coach['day5']['hiit'] = [['id' => 1, 'intensity' => 4]];
                    $coach['day5']['stretching'] = $stretches;
                } elseif ($data['days'] == 6) {

                    //Day1 exercise set
                    $coach['day1']['warmup'] = $warmup;
                    $coach['day1']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day1']['exercises'] = [];
                    //intensify csWorkout1
                    $coach['day1']['workout'] = self::intensifyWorkout($csWorkout1, 1);
                    $coach['day1']['coach_workout_rounds'] = count($coach['day1']['workout']['exercises']);
                    $coach['day1']['workout_intensity'] = 2;
                    $coach['day1']['hiit'] = [];
                    $coach['day1']['stretching'] = $stretches;

                    //Day2 Exercise set
                    $coach['day2']['warmup'] = $warmup;
                    $coach['day2']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day2']['exercises'] = [];
                    $coach['day2']['workout'] = $csWorkout2;
                    $coach['day2']['coach_workout_rounds'] = count($csWorkout2);
                    $coach['day2']['workout_intensity'] = 1;
                    $coach['day2']['hiit'] = [['id' => 1, 'intensity' => 4], ['id' => 1, 'intensity' => 3]];
                    $coach['day2']['stretching'] = $stretches;

                    //Day3 Exercise set
                    $coach['day3']['warmup'] = $warmup;
                    $coach['day3']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day3']['exercises'] = [];
                    //intensify sWorkout2
                    $coach['day3']['workout'] = self::intensifyWorkout($csWorkout3, 1);
                    $coach['day3']['coach_workout_rounds'] = count($coach['day3']['workout']['exercises']);
                    $coach['day3']['workout_intensity'] = 2;
                    $coach['day3']['hiit'] = [];
                    $coach['day3']['stretching'] = $stretches;

                    //Day4 Exercise set
                    $coach['day4']['warmup'] = $warmup;
                    $coach['day4']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day4']['exercises'] = [];
                    //intensify sWorkout2
                    $coach['day4']['workout'] = self::intensifyWorkout($sWorkout1, 1);
                    $coach['day4']['coach_workout_rounds'] = count($coach['day4']['workout']['exercises']);
                    $coach['day4']['workout_intensity'] = 2;
                    $coach['day4']['hiit'] = [];
                    $coach['day4']['stretching'] = $stretches;

                    //Day5 Exercise set
                    $coach['day5']['warmup'] = $warmup;
                    $coach['day5']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day5']['exercises'] = [];
                    //intensify sWorkout2
                    $coach['day5']['workout'] = $sWorkout2;
                    $coach['day5']['coach_workout_rounds'] = count($coach['day5']['workout']['exercises']);
                    $coach['day5']['workout_intensity'] = 1;
                    $coach['day5']['hiit'] = [['id' => 3, 'intensity' => 3]];
                    $coach['day5']['stretching'] = $stretches;

                    //Day5 Exercise set
                    $coach['day6']['warmup'] = $warmup;
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
                    $coach['day1']['warmup'] = $warmup;
                    $coach['day1']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day1']['exercises'] = [];
                    //intensify csWorkout1
                    $coach['day1']['workout'] = self::intensifyWorkout($csWorkout1, 1);
                    $coach['day1']['coach_workout_rounds'] = count($coach['day1']['workout']['exercises']);
                    $coach['day1']['workout_intensity'] = 2;
                    $coach['day1']['hiit'] = [];
                    $coach['day1']['stretching'] = $stretches;

                    //Day2 Exercise set
                    $coach['day2']['warmup'] = $warmup;
                    $coach['day2']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day2']['exercises'] = [];
                    $coach['day2']['workout'] = $csWorkout2;
                    $coach['day2']['coach_workout_rounds'] = count($csWorkout2);
                    $coach['day2']['workout_intensity'] = 1;
                    $coach['day2']['hiit'] = [['id' => 2, 'intensity' => 4]];
                    $coach['day2']['stretching'] = $stretches;
                } elseif ($data['days'] == 3) {

                    //Day1 exercise set
                    $coach['day1']['warmup'] = $warmup;
                    $coach['day1']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day1']['exercises'] = [];
                    //intensify csWorkout1
                    $coach['day1']['workout'] = self::intensifyWorkout($csWorkout1, 1);
                    $coach['day1']['coach_workout_rounds'] = count($coach['day1']['workout']['exercises']);
                    $coach['day1']['workout_intensity'] = 2;
                    $coach['day1']['hiit'] = [];
                    $coach['day1']['stretching'] = $stretches;

                    //Day2 Exercise set
                    $coach['day2']['warmup'] = $warmup;
                    $coach['day2']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day2']['exercises'] = [];
                    $coach['day2']['workout'] = $csWorkout2;
                    $coach['day2']['coach_workout_rounds'] = count($csWorkout2);
                    $coach['day2']['workout_intensity'] = 1;
                    $coach['day2']['hiit'] = [['id' => 2, 'intensity' => 4]];
                    $coach['day2']['stretching'] = $stretches;

                    //Day3 Exercise set
                    $coach['day3']['warmup'] = $warmup;
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
                    $coach['day1']['warmup'] = $warmup;
                    $coach['day1']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day1']['exercises'] = [];
                    //intensify csWorkout1
                    $coach['day1']['workout'] = self::intensifyWorkout($csWorkout1, 1);
                    $coach['day1']['coach_workout_rounds'] = count($coach['day1']['workout']['exercises']);
                    $coach['day1']['workout_intensity'] = 2;
                    $coach['day1']['hiit'] = [];
                    $coach['day1']['stretching'] = $stretches;

                    //Day2 Exercise set
                    $coach['day2']['warmup'] = $warmup;
                    $coach['day2']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day2']['exercises'] = [];
                    $coach['day2']['workout'] = $csWorkout2;
                    $coach['day2']['coach_workout_rounds'] = count($csWorkout2);
                    $coach['day2']['workout_intensity'] = 1;
                    $coach['day2']['hiit'] = [['id' => 1, 'intensity' => 4]];
                    $coach['day2']['stretching'] = $stretches;

                    //Day3 Exercise set
                    $coach['day3']['warmup'] = $warmup;
                    $coach['day3']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day3']['exercises'] = [];
                    //intensify sWorkout2
                    $coach['day3']['workout'] = self::intensifyWorkout($csWorkout3, 1);
                    $coach['day3']['coach_workout_rounds'] = count($coach['day3']['workout']['exercises']);
                    $coach['day3']['workout_intensity'] = 2;
                    $coach['day3']['hiit'] = [];
                    $coach['day3']['stretching'] = $stretches;

                    //Day4 Exercise set
                    $coach['day4']['warmup'] = $warmup;
                    $coach['day4']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day4']['exercises'] = [];
                    //intensify sWorkout2
                    $coach['day4']['workout'] = $sWorkout1;
                    $coach['day4']['coach_workout_rounds'] = count($coach['day4']['workout']['exercises']);
                    $coach['day4']['workout_intensity'] = 1;
                    $coach['day4']['hiit'] = [['id' => 2, 'intensity' => 4]];
                    $coach['day4']['stretching'] = $stretches;
                } elseif ($data['days'] == 5) {

                    //Day1 exercise set
                    $coach['day1']['warmup'] = $warmup;
                    $coach['day1']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day1']['exercises'] = [];
                    //intensify csWorkout1
                    $coach['day1']['workout'] = self::intensifyWorkout($csWorkout1, 1);
                    $coach['day1']['coach_workout_rounds'] = count($coach['day1']['workout']['exercises']);
                    $coach['day1']['workout_intensity'] = 2;
                    $coach['day1']['hiit'] = [];
                    $coach['day1']['stretching'] = $stretches;

                    //Day2 Exercise set
                    $coach['day2']['warmup'] = $warmup;
                    $coach['day2']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day2']['exercises'] = [];
                    $coach['day2']['workout'] = $csWorkout2;
                    $coach['day2']['coach_workout_rounds'] = count($csWorkout2);
                    $coach['day2']['workout_intensity'] = 1;
                    $coach['day2']['hiit'] = [['id' => 3, 'intensity' => 3]];
                    $coach['day2']['stretching'] = $stretches;

                    //Day3 Exercise set
                    $coach['day3']['warmup'] = $warmup;
                    $coach['day3']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day3']['exercises'] = [];
                    //intensify sWorkout2
                    $coach['day3']['workout'] = self::intensifyWorkout($csWorkout3, 1);
                    $coach['day3']['coach_workout_rounds'] = count($coach['day3']['workout']['exercises']);
                    $coach['day3']['workout_intensity'] = 2;
                    $coach['day3']['hiit'] = [];
                    $coach['day3']['stretching'] = $stretches;

                    //Day4 Exercise set
                    $coach['day4']['warmup'] = $warmup;
                    $coach['day4']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day4']['exercises'] = [];
                    //intensify sWorkout2
                    $coach['day4']['workout'] = $sWorkout1;
                    $coach['day4']['coach_workout_rounds'] = count($coach['day4']['workout']['exercises']);
                    $coach['day4']['workout_intensity'] = 1;
                    $coach['day4']['hiit'] = [['id' => 2, 'intensity' => 4]];
                    $coach['day4']['stretching'] = $stretches;

                    //Day5 Exercise set
                    $coach['day5']['warmup'] = $warmup;
                    $coach['day5']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day5']['exercises'] = [];
                    //intensify sWorkout2
                    $coach['day5']['workout'] = self::intensifyWorkout($sWorkout2, 1);
                    $coach['day5']['coach_workout_rounds'] = count($coach['day5']['workout']['exercises']);
                    $coach['day5']['workout_intensity'] = 2;
                    $coach['day5']['hiit'] = [['id' => 1, 'intensity' => 4]];
                    $coach['day5']['stretching'] = $stretches;
                } elseif ($data['days'] == 6) {

                    //Day1 exercise set
                    $coach['day1']['warmup'] = $warmup;
                    $coach['day1']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day1']['exercises'] = [];
                    //intensify csWorkout1
                    $coach['day1']['workout'] = self::intensifyWorkout($csWorkout1, 1);
                    $coach['day1']['coach_workout_rounds'] = count($coach['day1']['workout']['exercises']);
                    $coach['day1']['workout_intensity'] = 2;
                    $coach['day1']['hiit'] = [];
                    $coach['day1']['stretching'] = $stretches;

                    //Day2 Exercise set
                    $coach['day2']['warmup'] = $warmup;
                    $coach['day2']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day2']['exercises'] = [];
                    $coach['day2']['workout'] = $csWorkout2;
                    $coach['day2']['coach_workout_rounds'] = count($csWorkout2);
                    $coach['day2']['workout_intensity'] = 1;
                    $coach['day2']['hiit'] = [['id' => 1, 'intensity' => 4], ['id' => 1, 'intensity' => 3]];
                    $coach['day2']['stretching'] = $stretches;

                    //Day3 Exercise set
                    $coach['day3']['warmup'] = $warmup;
                    $coach['day3']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day3']['exercises'] = [];
                    //intensify sWorkout2
                    $coach['day3']['workout'] = self::intensifyWorkout($csWorkout3, 1);
                    $coach['day3']['coach_workout_rounds'] = count($coach['day3']['workout']['exercises']);
                    $coach['day3']['workout_intensity'] = 2;
                    $coach['day3']['hiit'] = [];
                    $coach['day3']['stretching'] = $stretches;

                    //Day4 Exercise set
                    $coach['day4']['warmup'] = $warmup;
                    $coach['day4']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day4']['exercises'] = [];
                    //intensify sWorkout2
                    $coach['day4']['workout'] = self::intensifyWorkout($csWorkout4, 1);
                    $coach['day4']['coach_workout_rounds'] = count($coach['day4']['workout']['exercises']);
                    $coach['day4']['workout_intensity'] = 2;
                    $coach['day4']['hiit'] = [];
                    $coach['day4']['stretching'] = $stretches;

                    //Day5 Exercise set
                    $coach['day5']['warmup'] = $warmup;
                    $coach['day5']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day5']['exercises'] = [];
                    //intensify sWorkout2
                    $coach['day5']['workout'] = $sWorkout1;
                    $coach['day5']['coach_workout_rounds'] = count($coach['day5']['workout']['exercises']);
                    $coach['day5']['workout_intensity'] = 1;
                    $coach['day5']['hiit'] = [['id' => 2, 'intensity' => 4]];
                    $coach['day5']['stretching'] = $stretches;

                    //Day5 Exercise set
                    $coach['day6']['warmup'] = $warmup;
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
                    $coach['day1']['warmup'] = $warmup;
                    $coach['day1']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day1']['exercises'] = [];
                    //intensify csWorkout1
                    $coach['day1']['workout'] = self::intensifyWorkout($csWorkout1, 1);
                    $coach['day1']['coach_workout_rounds'] = count($coach['day1']['workout']['exercises']);
                    $coach['day1']['workout_intensity'] = 2;
                    $coach['day1']['hiit'] = [];
                    $coach['day1']['stretching'] = $stretches;

                    //Day2 Exercise set
                    $coach['day2']['warmup'] = $warmup;
                    $coach['day2']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day2']['exercises'] = [];
                    $coach['day2']['workout'] = $sWorkout1;
                    $coach['day2']['coach_workout_rounds'] = count($coach['day2']['workout']['exercises']);
                    $coach['day2']['workout_intensity'] = 1;
                    $coach['day2']['hiit'] = [['id' => 2, 'intensity' => 4]];
                    $coach['day2']['stretching'] = $stretches;
                } elseif ($data['days'] == 3) {

                    //Day1 exercise set
                    $coach['day1']['warmup'] = $warmup;
                    $coach['day1']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day1']['exercises'] = [];
                    //intensify csWorkout1
                    $coach['day1']['workout'] = self::intensifyWorkout($csWorkout1, 1);
                    $coach['day1']['coach_workout_rounds'] = count($coach['day1']['workout']['exercises']);
                    $coach['day1']['workout_intensity'] = 2;
                    $coach['day1']['hiit'] = [];
                    $coach['day1']['stretching'] = $stretches;

                    //Day2 Exercise set
                    $coach['day2']['warmup'] = $warmup;
                    $coach['day2']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day2']['exercises'] = [];
                    $coach['day2']['workout'] = $sWorkout1;
                    $coach['day2']['coach_workout_rounds'] = count($coach['day2']['workout']['exercises']);
                    $coach['day2']['workout_intensity'] = 1;
                    $coach['day2']['hiit'] = [['id' => 2, 'intensity' => 4]];
                    $coach['day2']['stretching'] = $stretches;

                    //Day3 Exercise set
                    $coach['day3']['warmup'] = $warmup;
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
                    $coach['day1']['warmup'] = $warmup;
                    $coach['day1']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day1']['exercises'] = [];
                    //intensify csWorkout1
                    $coach['day1']['workout'] = self::intensifyWorkout($csWorkout1, 1);
                    $coach['day1']['coach_workout_rounds'] = count($coach['day1']['workout']['exercises']);
                    $coach['day1']['workout_intensity'] = 2;
                    $coach['day1']['hiit'] = [];
                    $coach['day1']['stretching'] = $stretches;

                    //Day2 Exercise set
                    $coach['day2']['warmup'] = $warmup;
                    $coach['day2']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day2']['exercises'] = [];
                    $coach['day2']['workout'] = $csWorkout2;
                    $coach['day2']['coach_workout_rounds'] = count($csWorkout2);
                    $coach['day2']['workout_intensity'] = 1;
                    $coach['day2']['hiit'] = [['id' => 1, 'intensity' => 4]];
                    $coach['day2']['stretching'] = $stretches;

                    //Day3 Exercise set
                    $coach['day3']['warmup'] = $warmup;
                    $coach['day3']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day3']['exercises'] = [];
                    //intensify sWorkout2
                    $coach['day3']['workout'] = self::intensifyWorkout($sWorkout1, 1);
                    $coach['day3']['coach_workout_rounds'] = count($coach['day3']['workout']['exercises']);
                    $coach['day3']['workout_intensity'] = 2;
                    $coach['day3']['hiit'] = [];
                    $coach['day3']['stretching'] = $stretches;

                    //Day4 Exercise set
                    $coach['day4']['warmup'] = $warmup;
                    $coach['day4']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day4']['exercises'] = [];
                    //intensify sWorkout2
                    $coach['day4']['workout'] = $sWorkout2;
                    $coach['day4']['coach_workout_rounds'] = count($coach['day4']['workout']['exercises']);
                    $coach['day4']['workout_intensity'] = 1;
                    $coach['day4']['hiit'] = [['id' => 2, 'intensity' => 4]];
                    $coach['day4']['stretching'] = $stretches;
                } elseif ($data['days'] == 5) {

                    //Day1 exercise set
                    $coach['day1']['warmup'] = $warmup;
                    $coach['day1']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day1']['exercises'] = [];
                    //intensify csWorkout1
                    $coach['day1']['workout'] = self::intensifyWorkout($csWorkout1, 1);
                    $coach['day1']['coach_workout_rounds'] = count($coach['day1']['workout']['exercises']);
                    $coach['day1']['workout_intensity'] = 2;
                    $coach['day1']['hiit'] = [];
                    $coach['day1']['stretching'] = $stretches;

                    //Day2 Exercise set
                    $coach['day2']['warmup'] = $warmup;
                    $coach['day2']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day2']['exercises'] = [];
                    $coach['day2']['workout'] = $csWorkout2;
                    $coach['day2']['coach_workout_rounds'] = count($csWorkout2);
                    $coach['day2']['workout_intensity'] = 1;
                    $coach['day2']['hiit'] = [['id' => 3, 'intensity' => 3]];
                    $coach['day2']['stretching'] = $stretches;

                    //Day3 Exercise set
                    $coach['day3']['warmup'] = $warmup;
                    $coach['day3']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day3']['exercises'] = [];
                    //intensify sWorkout2
                    $coach['day3']['workout'] = self::intensifyWorkout($csWorkout3, 1);
                    $coach['day3']['coach_workout_rounds'] = count($coach['day3']['workout']['exercises']);
                    $coach['day3']['workout_intensity'] = 2;
                    $coach['day3']['hiit'] = [];
                    $coach['day3']['stretching'] = $stretches;

                    //Day4 Exercise set
                    $coach['day4']['warmup'] = $warmup;
                    $coach['day4']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day4']['exercises'] = [];
                    //intensify sWorkout2
                    $coach['day4']['workout'] = $sWorkout1;
                    $coach['day4']['coach_workout_rounds'] = count($coach['day4']['workout']['exercises']);
                    $coach['day4']['workout_intensity'] = 1;
                    $coach['day4']['hiit'] = [['id' => 2, 'intensity' => 4]];
                    $coach['day4']['stretching'] = $stretches;

                    //Day5 Exercise set
                    $coach['day5']['warmup'] = $warmup;
                    $coach['day5']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day5']['exercises'] = [];
                    //intensify sWorkout2
                    $coach['day5']['workout'] = self::intensifyWorkout($sWorkout2, 1);
                    $coach['day5']['coach_workout_rounds'] = count($coach['day5']['workout']['exercises']);
                    $coach['day5']['workout_intensity'] = 2;
                    $coach['day5']['hiit'] = [['id' => 1, 'intensity' => 4]];
                    $coach['day5']['stretching'] = $stretches;
                } elseif ($data['days'] == 6) {

                    //Day1 exercise set
                    $coach['day1']['warmup'] = $warmup;
                    $coach['day1']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day1']['exercises'] = [];
                    //intensify csWorkout1
                    $coach['day1']['workout'] = self::intensifyWorkout($csWorkout1, 1);
                    $coach['day1']['coach_workout_rounds'] = count($coach['day1']['workout']['exercises']);
                    $coach['day1']['workout_intensity'] = 2;
                    $coach['day1']['hiit'] = [];
                    $coach['day1']['stretching'] = $stretches;

                    //Day2 Exercise set
                    $coach['day2']['warmup'] = $warmup;
                    $coach['day2']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day2']['exercises'] = [];
                    $coach['day2']['workout'] = $csWorkout2;
                    $coach['day2']['coach_workout_rounds'] = count($coach['day2']['workout']['exercises']);
                    $coach['day2']['workout_intensity'] = 1;
                    $coach['day2']['hiit'] = [['id' => 1, 'intensity' => 4], ['id' => 1, 'intensity' => 3]];
                    $coach['day2']['stretching'] = $stretches;

                    //Day3 Exercise set
                    $coach['day3']['warmup'] = $warmup;
                    $coach['day3']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day3']['exercises'] = [];
                    //intensify sWorkout2
                    $coach['day3']['workout'] = self::intensifyWorkout($csWorkout3, 1);
                    $coach['day3']['coach_workout_rounds'] = count($coach['day3']['workout']['exercises']);
                    $coach['day3']['workout_intensity'] = 2;
                    $coach['day3']['hiit'] = [];
                    $coach['day3']['stretching'] = $stretches;

                    //Day4 Exercise set
                    $coach['day4']['warmup'] = $warmup;
                    $coach['day4']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day4']['exercises'] = [];
                    //intensify sWorkout2
                    $coach['day4']['workout'] = self::intensifyWorkout($sWorkout1, 1);
                    $coach['day4']['coach_workout_rounds'] = count($coach['day4']['workout']['exercises']);
                    $coach['day4']['workout_intensity'] = 2;
                    $coach['day4']['hiit'] = [];
                    $coach['day4']['stretching'] = $stretches;

                    //Day5 Exercise set
                    $coach['day5']['warmup'] = $warmup;
                    $coach['day5']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day5']['exercises'] = [];
                    //intensify sWorkout2
                    $coach['day5']['workout'] = $sWorkout2;
                    $coach['day5']['coach_workout_rounds'] = count($coach['day5']['workout']['exercises']);
                    $coach['day5']['workout_intensity'] = 1;
                    $coach['day5']['hiit'] = [['id' => 2, 'intensity' => 4]];
                    $coach['day5']['stretching'] = $stretches;

                    //Day5 Exercise set
                    $coach['day6']['warmup'] = $warmup;
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
                    $coach['day1']['warmup'] = $warmup;
                    $coach['day1']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day1']['exercises'] = [];
                    //intensify csWorkout1
                    $coach['day1']['workout'] = self::intensifyWorkout($sWorkout1, 1);
                    $coach['day1']['coach_workout_rounds'] = count($coach['day1']['workout']['exercises']);
                    $coach['day1']['workout_intensity'] = 2;
                    $coach['day1']['hiit'] = [];
                    $coach['day1']['stretching'] = $stretches;

                    //Day2 Exercise set
                    $coach['day2']['warmup'] = $warmup;
                    $coach['day2']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day2']['exercises'] = [];
                    $coach['day2']['workout'] = $sWorkout2;
                    $coach['day2']['coach_workout_rounds'] = count($coach['day2']['workout']['exercises']);
                    $coach['day2']['workout_intensity'] = 1;
                    $coach['day2']['hiit'] = [['id' => 2, 'intensity' => 4]];
                    $coach['day2']['stretching'] = $stretches;
                } elseif ($data['days'] == 3) {

                    //Day1 exercise set
                    $coach['day1']['warmup'] = $warmup;
                    $coach['day1']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day1']['exercises'] = [];
                    //intensify csWorkout1
                    $coach['day1']['workout'] = self::intensifyWorkout($sWorkout1, 1);
                    $coach['day1']['coach_workout_rounds'] = count($coach['day1']['workout']['exercises']);
                    $coach['day1']['workout_intensity'] = 2;
                    $coach['day1']['hiit'] = [];
                    $coach['day1']['stretching'] = $stretches;

                    //Day2 Exercise set
                    $coach['day2']['warmup'] = $warmup;
                    $coach['day2']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day2']['exercises'] = [];
                    $coach['day2']['workout'] = $sWorkout2;
                    $coach['day2']['coach_workout_rounds'] = count($coach['day2']['workout']['exercises']);
                    $coach['day2']['workout_intensity'] = 1;
                    $coach['day2']['hiit'] = [['id' => 2, 'intensity' => 4]];
                    $coach['day2']['stretching'] = $stretches;

                    //Day3 Exercise set
                    $coach['day3']['warmup'] = $warmup;
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
                    $coach['day1']['warmup'] = $warmup;
                    $coach['day1']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day1']['exercises'] = [];
                    //intensify csWorkout1
                    $coach['day1']['workout'] = self::intensifyWorkout($sWorkout1, 1);
                    $coach['day1']['coach_workout_rounds'] = count($coach['day1']['workout']['exercises']);
                    $coach['day1']['workout_intensity'] = 2;
                    $coach['day1']['hiit'] = [];
                    $coach['day1']['stretching'] = $stretches;

                    //Day2 Exercise set
                    $coach['day2']['warmup'] = $warmup;
                    $coach['day2']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day2']['exercises'] = [];
                    $coach['day2']['workout'] = $sWorkout2;
                    $coach['day2']['coach_workout_rounds'] = count($coach['day2']['workout']['exercises']);
                    $coach['day2']['workout_intensity'] = 1;
                    $coach['day2']['hiit'] = [['id' => 1, 'intensity' => 4]];
                    $coach['day2']['stretching'] = $stretches;

                    //Day3 Exercise set
                    $coach['day3']['warmup'] = $warmup;
                    $coach['day3']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day3']['exercises'] = [];
                    //intensify sWorkout2
                    $coach['day3']['workout'] = self::intensifyWorkout($sWorkout3, 1);
                    $coach['day3']['coach_workout_rounds'] = count($coach['day3']['workout']['exercises']);
                    $coach['day3']['workout_intensity'] = 2;
                    $coach['day3']['hiit'] = [];
                    $coach['day3']['stretching'] = $stretches;

                    //Day4 Exercise set
                    $coach['day4']['warmup'] = $warmup;
                    $coach['day4']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day4']['exercises'] = [];
                    //intensify sWorkout2
                    $coach['day4']['workout'] = $sWorkout4;
                    $coach['day4']['coach_workout_rounds'] = count($coach['day4']['workout']['exercises']);
                    $coach['day4']['workout_intensity'] = 1;
                    $coach['day4']['hiit'] = [['id' => 2, 'intensity' => 4]];
                    $coach['day4']['stretching'] = $stretches;
                } elseif ($data['days'] == 5) {

                    //Day1 exercise set
                    $coach['day1']['warmup'] = $warmup;
                    $coach['day1']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day1']['exercises'] = [];
                    //intensify csWorkout1
                    $coach['day1']['workout'] = self::intensifyWorkout($csWorkout1, 1);
                    $coach['day1']['coach_workout_rounds'] = count($coach['day1']['workout']['exercises']);
                    $coach['day1']['workout_intensity'] = 2;
                    $coach['day1']['hiit'] = [];
                    $coach['day1']['stretching'] = $stretches;

                    //Day2 Exercise set
                    $coach['day2']['warmup'] = $warmup;
                    $coach['day2']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day2']['exercises'] = [];
                    $coach['day2']['workout'] = $sWorkout1;
                    $coach['day2']['coach_workout_rounds'] = count($coach['day2']['workout']['exercises']);
                    $coach['day2']['workout_intensity'] = 1;
                    $coach['day2']['hiit'] = [['id' => 3, 'intensity' => 3]];
                    $coach['day2']['stretching'] = $stretches;

                    //Day3 Exercise set
                    $coach['day3']['warmup'] = $warmup;
                    $coach['day3']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day3']['exercises'] = [];
                    //intensify sWorkout2
                    $coach['day3']['workout'] = self::intensifyWorkout($sWorkout2, 1);
                    $coach['day3']['coach_workout_rounds'] = count($coach['day3']['workout']['exercises']);
                    $coach['day3']['workout_intensity'] = 2;
                    $coach['day3']['hiit'] = [];
                    $coach['day3']['stretching'] = $stretches;

                    //Day4 Exercise set
                    $coach['day4']['warmup'] = $warmup;
                    $coach['day4']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day4']['exercises'] = [];
                    //intensify sWorkout2
                    $coach['day4']['workout'] = $sWorkout3;
                    $coach['day4']['coach_workout_rounds'] = count($coach['day4']['workout']['exercises']);
                    $coach['day4']['workout_intensity'] = 1;
                    $coach['day4']['hiit'] = [['id' => 2, 'intensity' => 4]];
                    $coach['day4']['stretching'] = $stretches;

                    //Day5 Exercise set
                    $coach['day5']['warmup'] = $warmup;
                    $coach['day5']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day5']['exercises'] = [];
                    //intensify sWorkout2
                    $coach['day5']['workout'] = self::intensifyWorkout($sWorkout4, 1);
                    $coach['day5']['coach_workout_rounds'] = count($coach['day5']['workout']['exercises']);
                    $coach['day5']['workout_intensity'] = 2;
                    $coach['day5']['hiit'] = [['id' => 1, 'intensity' => 4]];
                    $coach['day5']['stretching'] = $stretches;
                } elseif ($data['days'] == 6) {

                    //Day1 exercise set
                    $coach['day1']['warmup'] = $warmup;
                    $coach['day1']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day1']['exercises'] = [];
                    //intensify csWorkout1
                    $coach['day1']['workout'] = self::intensifyWorkout($csWorkout1, 1);
                    $coach['day1']['coach_workout_rounds'] = count($coach['day1']['workout']['exercises']);
                    $coach['day1']['workout_intensity'] = 2;
                    $coach['day1']['hiit'] = [];
                    $coach['day1']['stretching'] = $stretches;

                    //Day2 Exercise set
                    $coach['day2']['warmup'] = $warmup;
                    $coach['day2']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day2']['exercises'] = [];
                    $coach['day2']['workout'] = $sWorkout1;
                    $coach['day2']['coach_workout_rounds'] = count($coach['day2']['workout']['exercises']);
                    $coach['day2']['workout_intensity'] = 1;
                    $coach['day2']['hiit'] = [['id' => 1, 'intensity' => 4], ['id' => 1, 'intensity' => 3]];
                    $coach['day2']['stretching'] = $stretches;

                    //Day3 Exercise set
                    $coach['day3']['warmup'] = $warmup;
                    $coach['day3']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day3']['exercises'] = [];
                    //intensify sWorkout2
                    $coach['day3']['workout'] = self::intensifyWorkout($sWorkout2, 1);
                    $coach['day3']['coach_workout_rounds'] = count($coach['day3']['workout']['exercises']);
                    $coach['day3']['workout_intensity'] = 2;
                    $coach['day3']['hiit'] = [];
                    $coach['day3']['stretching'] = $stretches;

                    //Day4 Exercise set
                    $coach['day4']['warmup'] = $warmup;
                    $coach['day4']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day4']['exercises'] = [];
                    //intensify sWorkout2
                    $coach['day4']['workout'] = self::intensifyWorkout($sWorkout3, 1);
                    $coach['day4']['coach_workout_rounds'] = count($coach['day4']['workout']['exercises']);
                    $coach['day4']['workout_intensity'] = 2;
                    $coach['day4']['hiit'] = [];
                    $coach['day4']['stretching'] = $stretches;

                    //Day5 Exercise set
                    $coach['day5']['warmup'] = $warmup;
                    $coach['day5']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day5']['exercises'] = [];
                    //intensify sWorkout2
                    $coach['day5']['workout'] = $sWorkout4;
                    $coach['day5']['coach_workout_rounds'] = count($coach['day5']['workout']['exercises']);
                    $coach['day5']['workout_intensity'] = 1;
                    $coach['day5']['hiit'] = [['id' => 2, 'intensity' => 4]];
                    $coach['day5']['stretching'] = $stretches;

                    //Day5 Exercise set
                    $coach['day6']['warmup'] = $warmup;
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
        $rounds = $workout->rounds;
        $count = 1;
        $exercises = [];
        do {
            $roundExercises = Workoutexercise::where('round', '=', $count)
                    ->where('category', '=', $category)
                    ->where('workout_id', '=', $workoutId)
                    ->with(['video', 'exercise'])->get();

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
            }
        }

        return $exercises;
    }

    public static function updateDayExercises($dayExercise, $assessment, $coachId)
    {

        $coach = DB::table('coaches')->where('id', $coachId)->first();

        $coachStatus = DB::table('coach_status')->where('coach_id', $coachId)->first();

        $userDoneExercises = [];

        $fundumentalArray = [
            1 => [
                ['exercise_id' => 1, 'duration' => [1 => ['min' => 7], 2 => ['min' => 15]], 'unit' => 'times'],
                ['exercise_id' => 13, 'duration' => [1 => ['min' => 10], 2 => ['min' => 20]], 'unit' => 'times'],
                ['exercise_id' => 5, 'duration' => [1 => ['min' => 20], 2 => ['min' => 40]], 'unit' => 'times'],
                ['exercise_id' => 16, 'duration' => [1 => ['min' => 20], 2 => ['min' => 40]], 'unit' => 'times'],
                ['exercise_id' => 7, 'duration' => [1 => ['min' => 10, 'max' => 60], 2 => ['min' => 60, 'max' => 90]], 'unit' => 'seconds']
            ],
            2 => [
                ['exercise_id' => 4, 'duration' => [1 => ['min' => 7], 2 => ['min' => 10]], 'unit' => 'times'],
                ['exercise_id' => 12, 'duration' => [1 => ['min' => 10], 2 => ['min' => 20]], 'unit' => 'times'],
                ['exercise_id' => 36, 'duration' => [1 => ['min' => 20], 2 => ['min' => 40]], 'unit' => 'times'],
                ['exercise_id' => 3, 'duration' => [1 => ['min' => 10], 2 => ['min' => 15]], 'unit' => 'times'],
                ['exercise_id' => 8, 'duration' => [1 => ['min' => 10], 2 => ['min' => 20]], 'unit' => 'times']
            ],
            3 => [
                ['exercise_id' => 4, 'duration' => [1 => ['min' => 7], 2 => ['min' => 10]], 'unit' => 'times'],
                ['exercise_id' => 14, 'duration' => [1 => ['min' => 10], 2 => ['min' => 20]], 'unit' => 'times'],
                ['exercise_id' => 5, 'duration' => [1 => ['min' => 20], 2 => ['min' => 40]], 'unit' => 'times'],
                ['exercise_id' => 17, 'duration' => [1 => ['min' => 10, 'max' => 60], 2 => ['min' => 60, 'max' => 90]], 'unit' => 'seconds'],
                ['exercise_id' => 10, 'duration' => [1 => ['min' => 10], 2 => ['min' => 20]], 'unit' => 'times']
            ],
            4 => [
                ['exercise_id' => 3, 'duration' => [1 => ['min' => 7], 2 => ['min' => 15]], 'unit' => 'times'],
                ['exercise_id' => 46, 'duration' => [1 => ['min' => 10], 2 => ['min' => 20]], 'unit' => 'times'],
                ['exercise_id' => 5, 'duration' => [1 => ['min' => 20], 2 => ['min' => 40]], 'unit' => 'times'],
                ['exercise_id' => 30, 'duration' => [1 => ['min' => 10], 2 => ['min' => 25]], 'unit' => 'times'],
                ['exercise_id' => 11, 'duration' => [1 => ['min' => 10], 2 => ['min' => 20]], 'unit' => 'times']
            ],
            5 => [
                ['exercise_id' => 2, 'duration' => [1 => ['min' => 10], 2 => ['min' => 20]], 'unit' => 'times'],
                ['exercise_id' => 12, 'duration' => [1 => ['min' => 10], 2 => ['min' => 20]], 'unit' => 'times'],
                ['exercise_id' => 36, 'duration' => [1 => ['min' => 20], 2 => ['min' => 40]], 'unit' => 'times'],
                ['exercise_id' => 17, 'duration' => [1 => ['min' => 10, 'max' => 60], 2 => ['min' => 60, 'max' => 90]], 'unit' => 'seconds'],
                ['exercise_id' => 9, 'duration' => [1 => ['min' => 20], 2 => ['min' => 40]], 'unit' => 'times']
            ],
        ];

        foreach ($fundumentalArray as $fKey => $fundumentals) {
            foreach ($fundumentals as $jKey => $jVal) {
                if ($coach->category == 'beginer' && $coachStatus->week == 6) {
                    $fundumentalArray[$fKey][$jKey]['duration'] = $jVal['duration'][2];
                }
                $exercise = Exercise::where('id', $jVal['exercise_id'])->with(['video'])->first();
                $fundumentalArray[$fKey][$jKey]['exercise'] = $exercise->toArray();

                $userDoneExercises[] = $jVal['exercise_id'];
            }
        }

        $warmUps = DB::table('warmups')->select('*')->get();

        if ($coach->category == 'beginer') {
            foreach ($warmUps as $wKey => $warmUp) {
                $duration = $warmUp->duration;

                $durationArray = json_decode($duration, true);

                $warmUps[$wKey]->duration = $durationArray[1];
            }
        } else {

            foreach ($warmUps as $wKey => $warmUp) {
                $duration = $warmUp->duration;

                $durationArray = json_decode($duration, true);

                $warmUps[$wKey]->duration = $durationArray[2];
            }
        }

        $warmupArray = $warmUps;

        if (isset($dayExercise['fundumentals'])) {
            $dayExercise['fundumentals'] = $fundumentalArray;
        }

        if (isset($dayExercise['warmup'])) {
            $dayExercise['warmup'] = $warmupArray;
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
                        $userDoneExercises[] = strval($exercise['id']);
                    }
                }
            }

            if (isset($dayExercise['workout']) && count($dayExercise['workout'] > 0)) {

                if (!empty($dayExercise['workout'])) {
                    $dayExercise['workout'] = self::intensifyWorkout($dayExercise['workout'], 1);

                    $workoutExerciseRoundCount = count($dayExercise['workout']['exercises']);

                    $dayExercise['workout_intensity'] = ceil($workoutExerciseRoundCount / $dayExercise['workout']['rounds']);
                }
            }

            if (isset($dayExercise['hiit']) && count($dayExercise['hiit']) > 0) {
                if (!empty($dayExercise['hiit'])) {
                    foreach ($dayExercise['hiit'] as $hKey => $hiit) {
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

//        var_dump($userDoneExercises);
//        
//        die;

        if (count($userDoneExercises) > 0) {

            $notInQuery = ' AND skills.exercise_id NOT IN(' . implode(',', $userDoneExercises) . ')';
        }


        if ($coach->muscle_groups != '') {

            $muscleGroupArray = explode(',', $coach->muscle_groups);


            foreach ($muscleGroupArray as $mgKey => $muscleGroupId) {

                $userUnlockedSkillExerciseQuery = DB::table('unlocked_skills')
                        ->select('exercise_id')
                        ->whereRaw('user_id = ' . $coach->user_id)->toSql();

                $basicSkillsQuery = DB::table('skills')
                    ->leftJoin('exercises', 'skills.exercise_id', '=', 'exercises.id')
                    ->select('skills.*')
                    ->groupBy('skills.progression_id')
                    ->orderBy('skills.id');

                $likeQuery = '';

                $likeQuery .= ' AND exercises.muscle_groups LIKE "%' . $muscleGroupId . '%"';

                $basicSkillsQuery->whereRaw('skills.exercise_id IN(' . $userUnlockedSkillExerciseQuery . ') AND exercises.category = ' . $coach->focus . $likeQuery . $notInQuery);

                $additionalExercise = $basicSkillsQuery->first();
                if (!is_null($additionalExercise)) {
                    $dayExercise['exercises'][] = Exercise::where('id', $additionalExercise->id)->with(['video'])->first();
                }
            }
        }

        return $dayExercise;
    }
}
