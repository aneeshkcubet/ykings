<?php namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use DB;

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
        'exercises'
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

                $basicSkills = DB::table('skills')
                    ->leftJoin('exercises', 'skills.exercise_id', '=', 'exercises.id')
                    ->select('skills.*')
                    ->whereRaw('skills.exercise_id IN(' . $userUnlockedSkillExerciseQuery . ') AND exercises.category = 1')
                    ->groupBy('skills.progression_id')
                    ->orderBy('skills.id')
                    ->get();
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
                    $coach['day1']['workout_intensity'] = 1;
                    $coach['day1']['hiit'] = [];
                    $coach['day1']['stretching'] = $stretches;

                    //Day2 Exercise set
                    $coach['day2']['warmup'] = $warmup;
                    $coach['day2']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day2']['exercises'] = $exercises;
                    $coach['day2']['workout'] = [];
                    $coach['day2']['workout_intensity'] = 1;
                    $coach['day2']['hiit'] = [3];
                    $coach['day2']['stretching'] = $stretches;
                } elseif ($data['days'] == 3) {

                    $coach['day1']['warmup'] = $warmup;
                    $coach['day1']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day1']['exercises'] = [];
                    $coach['day1']['workout'] = $day1Workout;
                    $coach['day1']['workout_intensity'] = 1;
                    $coach['day1']['hiit'] = [];
                    $coach['day1']['stretching'] = $stretches;

                    //Day2 Exercise set

                    $coach['day2']['warmup'] = $warmup;
                    $coach['day2']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day2']['exercises'] = $exercises;
                    $coach['day2']['workout'] = [];
                    $coach['day2']['workout_intensity'] = 1;
                    $coach['day2']['hiit'] = [3];
                    $coach['day2']['stretching'] = $stretches;

                    //Day3 exercise set

                    $coach['day3']['warmup'] = $warmup;
                    $coach['day3']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day3']['exercises'] = [];
                    $coach['day3']['workout'] = $day3Workout;
                    $coach['day3']['workout_intensity'] = 1;
                    $coach['day3']['hiit'] = [];
                    $coach['day3']['stretching'] = $stretches;
                } elseif ($data['days'] == 4) {

                    //Day1 exercise set
                    $coach['day1']['warmup'] = $warmup;
                    $coach['day1']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day1']['exercises'] = [];
                    $coach['day1']['workout'] = $day1Workout;
                    $coach['day1']['workout_intensity'] = 1;
                    $coach['day1']['hiit'] = [];
                    $coach['day1']['stretching'] = $stretches;

                    //Day2 Exercise set

                    $coach['day2']['warmup'] = $warmup;
                    $coach['day2']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day2']['exercises'] = $exercises;
                    $coach['day2']['workout'] = [];
                    $coach['day2']['workout_intensity'] = 1;
                    $coach['day2']['hiit'] = [3];
                    $coach['day2']['stretching'] = $stretches;

                    //Day3 exercise set                    
                    $coach['day3']['warmup'] = $warmup;
                    $coach['day3']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day3']['exercises'] = [];
                    $coach['day3']['workout'] = $day3Workout;
                    $coach['day3']['workout_intensity'] = 1;
                    $coach['day3']['hiit'] = [];
                    $coach['day3']['stretching'] = $stretches;

                    //Day4 exercise set
                    $coach['day4']['warmup'] = $warmup;
                    $coach['day4']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day4']['exercises'] = $exercises;
                    $coach['day4']['workout'] = [];
                    $coach['day4']['workout_intensity'] = 1;
                    $coach['day4']['hiit'] = [3];
                    $coach['day4']['stretching'] = $stretches;
                } elseif ($data['days'] == 5) {

                    //Day1 exercise set
                    $coach['day1']['warmup'] = $warmup;
                    $coach['day1']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day1']['exercises'] = [];
                    $coach['day1']['workout'] = $day1Workout;
                    $coach['day1']['workout_intensity'] = 1;
                    $coach['day1']['hiit'] = [];
                    $coach['day1']['stretching'] = $stretches;

                    //Day2 Exercise set
                    $coach['day2']['warmup'] = $warmup;
                    $coach['day2']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day2']['exercises'] = $exercises;
                    $coach['day2']['workout'] = [];
                    $coach['day2']['workout_intensity'] = 1;
                    $coach['day2']['hiit'] = [3];
                    $coach['day2']['stretching'] = $stretches;

                    //Day3 exercise set
                    $coach['day3']['warmup'] = $warmup;
                    $coach['day3']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day3']['exercises'] = [];
                    $coach['day3']['workout'] = $day3Workout;
                    $coach['day3']['workout_intensity'] = 1;
                    $coach['day3']['hiit'] = [];
                    $coach['day3']['stretching'] = $stretches;

                    //Day4 exercise set
                    $coach['day4']['warmup'] = $warmup;
                    $coach['day4']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day4']['exercises'] = $exercises;
                    $coach['day4']['workout'] = [];
                    $coach['day4']['workout_intensity'] = 1;
                    $coach['day4']['hiit'] = [3];
                    $coach['day4']['stretching'] = $stretches;

                    //Day5 exercise set                    
                    $coach['day5']['warmup'] = $warmup;
                    $coach['day5']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day5']['exercises'] = [];
                    $coach['day5']['workout'] = $day5Workout;
                    $coach['day5']['workout_intensity'] = 1;
                    $coach['day5']['hiit'] = [];
                    $coach['day5']['stretching'] = $stretches;
                } elseif ($data['days'] == 6) {
                    //Day1 exercise set
                    $coach['day1']['warmup'] = $warmup;
                    $coach['day1']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day1']['exercises'] = [];
                    $coach['day1']['workout'] = $day1Workout;
                    $coach['day1']['workout_intensity'] = 1;
                    $coach['day1']['hiit'] = [];
                    $coach['day1']['stretching'] = $stretches;

                    //Day2 Exercise set
                    $coach['day2']['warmup'] = $warmup;
                    $coach['day2']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day2']['exercises'] = $exercises;
                    $coach['day2']['workout'] = [];
                    $coach['day2']['workout_intensity'] = 1;
                    $coach['day2']['hiit'] = [3];
                    $coach['day2']['stretching'] = $stretches;

                    //Day3 exercise set
                    $coach['day3']['warmup'] = $warmup;
                    $coach['day3']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day3']['exercises'] = [];
                    $coach['day3']['workout'] = $day3Workout;
                    $coach['day3']['workout_intensity'] = 1;
                    $coach['day3']['hiit'] = [];
                    $coach['day3']['stretching'] = $stretches;

                    //Day4 exercise set
                    $coach['day4']['warmup'] = $warmup;
                    $coach['day4']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day4']['exercises'] = $exercises;
                    $coach['day4']['workout'] = [];
                    $coach['day4']['workout_intensity'] = 1;
                    $coach['day4']['hiit'] = [3];
                    $coach['day4']['stretching'] = $stretches;

                    //Day5 exercise set
                    $coach['day5']['warmup'] = $warmup;
                    $coach['day5']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day5']['exercises'] = $exercises;
                    $coach['day5']['workout'] = [];
                    $coach['day5']['workout_intensity'] = 1;
                    $coach['day5']['hiit'] = [3];
                    $coach['day5']['stretching'] = $stretches;

                    //Day6 exercise set                    
                    $coach['day6']['warmup'] = $warmup;
                    $coach['day6']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day6']['exercises'] = [];
                    $coach['day6']['workout'] = $day5Workout;
                    $coach['day6']['workout_intensity'] = 1;
                    $coach['day6']['hiit'] = [];
                    $coach['day6']['stretching'] = $stretches;
                }
            } elseif ($focus == 2) {

                $userUnlockedSkillExerciseQuery = DB::table('unlocked_skills')
                        ->select('exercise_id')
                        ->whereRaw('user_id = ' . $data['user_id'])->toSql();

                $basicSkills = DB::table('skills')
                    ->leftJoin('exercises', 'skills.exercise_id', '=', 'exercises.id')
                    ->select('skills.*')
                    ->whereRaw('skills.exercise_id IN(' . $userUnlockedSkillExerciseQuery . ') AND exercises.category = 2')
                    ->groupBy('skills.progression_id')
                    ->orderBy('skills.id')
                    ->get();
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
                    $coach['day1']['workout_intensity'] = 1;
                    $coach['day1']['hiit'] = [];
                    $coach['day1']['stretching'] = $stretches;

                    //Day2 Exercise set
                    $coach['day2']['warmup'] = $warmup;
                    $coach['day2']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day2']['exercises'] = $exercises;
                    $coach['day2']['workout'] = [];
                    $coach['day2']['workout_intensity'] = 1;
                    $coach['day2']['hiit'] = [3];
                    $coach['day2']['stretching'] = $stretches;
                } elseif ($data['days'] == 3) {

                    $coach['day1']['warmup'] = $warmup;
                    $coach['day1']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day1']['exercises'] = [];
                    $coach['day1']['workout'] = $day1Workout;
                    $coach['day1']['workout_intensity'] = 1;
                    $coach['day1']['hiit'] = [];
                    $coach['day1']['stretching'] = $stretches;

                    //Day2 Exercise set

                    $coach['day2']['warmup'] = $warmup;
                    $coach['day2']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day2']['exercises'] = $exercises;
                    $coach['day2']['workout'] = [];
                    $coach['day2']['workout_intensity'] = 1;
                    $coach['day2']['hiit'] = [3];
                    $coach['day2']['stretching'] = $stretches;

                    //Day3 exercise set

                    $coach['day3']['warmup'] = $warmup;
                    $coach['day3']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day3']['exercises'] = [];
                    $coach['day3']['workout'] = $day3Workout;
                    $coach['day3']['workout_intensity'] = 1;
                    $coach['day3']['hiit'] = [];
                    $coach['day3']['stretching'] = $stretches;
                } elseif ($data['days'] == 4) {

                    //Day1 exercise set
                    $coach['day1']['warmup'] = $warmup;
                    $coach['day1']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day1']['exercises'] = [];
                    $coach['day1']['workout'] = $day1Workout;
                    $coach['day1']['workout_intensity'] = 1;
                    $coach['day1']['hiit'] = [];
                    $coach['day1']['stretching'] = $stretches;

                    //Day2 Exercise set

                    $coach['day2']['warmup'] = $warmup;
                    $coach['day2']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day2']['exercises'] = $exercises;
                    $coach['day2']['workout'] = [];
                    $coach['day2']['workout_intensity'] = 1;
                    $coach['day2']['hiit'] = [3];
                    $coach['day2']['stretching'] = $stretches;

                    //Day3 exercise set                    
                    $coach['day3']['warmup'] = $warmup;
                    $coach['day3']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day3']['exercises'] = [];
                    $coach['day3']['workout'] = $day3Workout;
                    $coach['day3']['workout_intensity'] = 1;
                    $coach['day3']['hiit'] = [];
                    $coach['day3']['stretching'] = $stretches;

                    //Day4 exercise set
                    $coach['day4']['warmup'] = $warmup;
                    $coach['day4']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day4']['exercises'] = $exercises;
                    $coach['day4']['workout'] = [];
                    $coach['day4']['workout_intensity'] = 1;
                    $coach['day4']['hiit'] = [3];
                    $coach['day4']['stretching'] = $stretches;
                } elseif ($data['days'] == 5) {

                    //Day1 exercise set
                    $coach['day1']['warmup'] = $warmup;
                    $coach['day1']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day1']['exercises'] = [];
                    $coach['day1']['workout'] = $day1Workout;
                    $coach['day1']['workout_intensity'] = 1;
                    $coach['day1']['hiit'] = [];
                    $coach['day1']['stretching'] = $stretches;

                    //Day2 Exercise set
                    $coach['day2']['warmup'] = $warmup;
                    $coach['day2']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day2']['exercises'] = $exercises;
                    $coach['day2']['workout'] = [];
                    $coach['day2']['workout_intensity'] = 1;
                    $coach['day2']['hiit'] = [3];
                    $coach['day2']['stretching'] = $stretches;

                    //Day3 exercise set
                    $coach['day3']['warmup'] = $warmup;
                    $coach['day3']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day3']['exercises'] = [];
                    $coach['day3']['workout'] = $day3Workout;
                    $coach['day3']['workout_intensity'] = 1;
                    $coach['day3']['hiit'] = [];
                    $coach['day3']['stretching'] = $stretches;

                    //Day4 exercise set
                    $coach['day4']['warmup'] = $warmup;
                    $coach['day4']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day4']['exercises'] = $exercises;
                    $coach['day4']['workout'] = [];
                    $coach['day4']['workout_intensity'] = 1;
                    $coach['day4']['hiit'] = [3];
                    $coach['day4']['stretching'] = $stretches;

                    //Day5 exercise set                    
                    $coach['day5']['warmup'] = $warmup;
                    $coach['day5']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day5']['exercises'] = [];
                    $coach['day5']['workout'] = $day5Workout;
                    $coach['day5']['workout_intensity'] = 1;
                    $coach['day5']['hiit'] = [];
                    $coach['day5']['stretching'] = $stretches;
                } elseif ($data['days'] == 6) {
                    //Day1 exercise set
                    $coach['day1']['warmup'] = $warmup;
                    $coach['day1']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day1']['exercises'] = [];
                    $coach['day1']['workout'] = $day1Workout;
                    $coach['day1']['workout_intensity'] = 1;
                    $coach['day1']['hiit'] = [];
                    $coach['day1']['stretching'] = $stretches;

                    //Day2 Exercise set
                    $coach['day2']['warmup'] = $warmup;
                    $coach['day2']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day2']['exercises'] = $exercises;
                    $coach['day2']['workout'] = [];
                    $coach['day2']['workout_intensity'] = 1;
                    $coach['day2']['hiit'] = [3];
                    $coach['day2']['stretching'] = $stretches;

                    //Day3 exercise set
                    $coach['day3']['warmup'] = $warmup;
                    $coach['day3']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day3']['exercises'] = [];
                    $coach['day3']['workout'] = $day3Workout;
                    $coach['day3']['workout_intensity'] = 1;
                    $coach['day3']['hiit'] = [];
                    $coach['day3']['stretching'] = $stretches;

                    //Day4 exercise set
                    $coach['day4']['warmup'] = $warmup;
                    $coach['day4']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day4']['exercises'] = $exercises;
                    $coach['day4']['workout'] = [];
                    $coach['day4']['workout_intensity'] = 1;
                    $coach['day4']['hiit'] = [3];
                    $coach['day4']['stretching'] = $stretches;

                    //Day5 exercise set
                    $coach['day5']['warmup'] = $warmup;
                    $coach['day5']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day5']['exercises'] = $exercises;
                    $coach['day5']['workout'] = [];
                    $coach['day5']['workout_intensity'] = 1;
                    $coach['day5']['hiit'] = [3];
                    $coach['day5']['stretching'] = $stretches;

                    //Day6 exercise set                    
                    $coach['day6']['warmup'] = $warmup;
                    $coach['day6']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day6']['exercises'] = [];
                    $coach['day6']['workout'] = $day5Workout;
                    $coach['day6']['workout_intensity'] = 1;
                    $coach['day6']['hiit'] = [];
                    $coach['day6']['stretching'] = $stretches;
                }
            } elseif ($focus == 3) {
                $userUnlockedSkillExerciseQuery = DB::table('unlocked_skills')
                        ->select('exercise_id')
                        ->whereRaw('user_id = ' . $data['user_id'])->toSql();

                $basicSkills = DB::table('skills')
                    ->leftJoin('exercises', 'skills.exercise_id', '=', 'exercises.id')
                    ->select('skills.*')
                    ->whereRaw('skills.exercise_id IN(' . $userUnlockedSkillExerciseQuery . ') AND exercises.category = 3')
                    ->groupBy('skills.progression_id')
                    ->orderBy('skills.id')
                    ->get();
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
                    $coach['day1']['workout_intensity'] = 1;
                    $coach['day1']['hiit'] = [];
                    $coach['day1']['stretching'] = $stretches;

                    //Day2 Exercise set
                    $coach['day2']['warmup'] = $warmup;
                    $coach['day2']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day2']['exercises'] = $exercises;
                    $coach['day2']['workout'] = [];
                    $coach['day2']['workout_intensity'] = 1;
                    $coach['day2']['hiit'] = [3];
                    $coach['day2']['stretching'] = $stretches;
                } elseif ($data['days'] == 3) {

                    $coach['day1']['warmup'] = $warmup;
                    $coach['day1']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day1']['exercises'] = [];
                    $coach['day1']['workout'] = $day1Workout;
                    $coach['day1']['workout_intensity'] = 1;
                    $coach['day1']['hiit'] = [];
                    $coach['day1']['stretching'] = $stretches;

                    //Day2 Exercise set

                    $coach['day2']['warmup'] = $warmup;
                    $coach['day2']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day2']['exercises'] = $exercises;
                    $coach['day2']['workout'] = [];
                    $coach['day2']['workout_intensity'] = 1;
                    $coach['day2']['hiit'] = [3];
                    $coach['day2']['stretching'] = $stretches;

                    //Day3 exercise set

                    $coach['day3']['warmup'] = $warmup;
                    $coach['day3']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day3']['exercises'] = [];
                    $coach['day3']['workout'] = $day3Workout;
                    $coach['day3']['workout_intensity'] = 1;
                    $coach['day3']['hiit'] = [];
                    $coach['day3']['stretching'] = $stretches;
                } elseif ($data['days'] == 4) {

                    //Day1 exercise set
                    $coach['day1']['warmup'] = $warmup;
                    $coach['day1']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day1']['exercises'] = [];
                    $coach['day1']['workout'] = $day1Workout;
                    $coach['day1']['workout_intensity'] = 1;
                    $coach['day1']['hiit'] = [];
                    $coach['day1']['stretching'] = $stretches;

                    //Day2 Exercise set

                    $coach['day2']['warmup'] = $warmup;
                    $coach['day2']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day2']['exercises'] = $exercises;
                    $coach['day2']['workout'] = [];
                    $coach['day2']['workout_intensity'] = 1;
                    $coach['day2']['hiit'] = [3];
                    $coach['day2']['stretching'] = $stretches;

                    //Day3 exercise set                    
                    $coach['day3']['warmup'] = $warmup;
                    $coach['day3']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day3']['exercises'] = [];
                    $coach['day3']['workout'] = $day3Workout;
                    $coach['day3']['workout_intensity'] = 1;
                    $coach['day3']['hiit'] = [];
                    $coach['day3']['stretching'] = $stretches;

                    //Day4 exercise set
                    $coach['day4']['warmup'] = $warmup;
                    $coach['day4']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day4']['exercises'] = $exercises;
                    $coach['day4']['workout'] = [];
                    $coach['day4']['workout_intensity'] = 1;
                    $coach['day4']['hiit'] = [3];
                    $coach['day4']['stretching'] = $stretches;
                } elseif ($data['days'] == 5) {

                    //Day1 exercise set
                    $coach['day1']['warmup'] = $warmup;
                    $coach['day1']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day1']['exercises'] = [];
                    $coach['day1']['workout'] = $day1Workout;
                    $coach['day1']['workout_intensity'] = 1;
                    $coach['day1']['hiit'] = [];
                    $coach['day1']['stretching'] = $stretches;

                    //Day2 Exercise set
                    $coach['day2']['warmup'] = $warmup;
                    $coach['day2']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day2']['exercises'] = $exercises;
                    $coach['day2']['workout'] = [];
                    $coach['day2']['workout_intensity'] = 1;
                    $coach['day2']['hiit'] = [3];
                    $coach['day2']['stretching'] = $stretches;

                    //Day3 exercise set
                    $coach['day3']['warmup'] = $warmup;
                    $coach['day3']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day3']['exercises'] = [];
                    $coach['day3']['workout'] = $day3Workout;
                    $coach['day3']['workout_intensity'] = 1;
                    $coach['day3']['hiit'] = [];
                    $coach['day3']['stretching'] = $stretches;

                    //Day4 exercise set
                    $coach['day4']['warmup'] = $warmup;
                    $coach['day4']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day4']['exercises'] = $exercises;
                    $coach['day4']['workout'] = [];
                    $coach['day4']['workout_intensity'] = 1;
                    $coach['day4']['hiit'] = [3];
                    $coach['day4']['stretching'] = $stretches;

                    //Day5 exercise set                    
                    $coach['day5']['warmup'] = $warmup;
                    $coach['day5']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day5']['exercises'] = [];
                    $coach['day5']['workout'] = $day5Workout;
                    $coach['day5']['workout_intensity'] = 1;
                    $coach['day5']['hiit'] = [];
                    $coach['day5']['stretching'] = $stretches;
                } elseif ($data['days'] == 6) {
                    //Day1 exercise set
                    $coach['day1']['warmup'] = $warmup;
                    $coach['day1']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day1']['exercises'] = [];
                    $coach['day1']['workout'] = $day1Workout;
                    $coach['day1']['workout_intensity'] = 1;
                    $coach['day1']['hiit'] = [];
                    $coach['day1']['stretching'] = $stretches;

                    //Day2 Exercise set
                    $coach['day2']['warmup'] = $warmup;
                    $coach['day2']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day2']['exercises'] = $exercises;
                    $coach['day2']['workout'] = [];
                    $coach['day2']['workout_intensity'] = 1;
                    $coach['day2']['hiit'] = [3];
                    $coach['day2']['stretching'] = $stretches;

                    //Day3 exercise set
                    $coach['day3']['warmup'] = $warmup;
                    $coach['day3']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day3']['exercises'] = [];
                    $coach['day3']['workout'] = $day3Workout;
                    $coach['day3']['workout_intensity'] = 1;
                    $coach['day3']['hiit'] = [];
                    $coach['day3']['stretching'] = $stretches;

                    //Day4 exercise set
                    $coach['day4']['warmup'] = $warmup;
                    $coach['day4']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day4']['exercises'] = $exercises;
                    $coach['day4']['workout'] = [];
                    $coach['day4']['workout_intensity'] = 1;
                    $coach['day4']['hiit'] = [3];
                    $coach['day4']['stretching'] = $stretches;

                    //Day5 exercise set
                    $coach['day5']['warmup'] = $warmup;
                    $coach['day5']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day5']['exercises'] = $exercises;
                    $coach['day5']['workout'] = [];
                    $coach['day5']['workout_intensity'] = 1;
                    $coach['day5']['hiit'] = [3];
                    $coach['day5']['stretching'] = $stretches;

                    //Day6 exercise set                    
                    $coach['day6']['warmup'] = $warmup;
                    $coach['day6']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day6']['exercises'] = [];
                    $coach['day6']['workout'] = $day5Workout;
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
                    $coach['day1']['workout_intensity'] = 2;
                    $coach['day1']['hiit'] = [];
                    $coach['day1']['stretching'] = $stretches;

                    //Day2 Exercise set
                    $coach['day2']['warmup'] = $warmup;
                    $coach['day2']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day2']['exercises'] = [];
                    $coach['day2']['workout'] = $csWorkout2;
                    $coach['day2']['workout_intensity'] = 1;
                    $coach['day2']['hiit'] = [1];
                    $coach['day2']['stretching'] = $stretches;
                } elseif ($data['days'] == 3) {

                    //Day1 exercise set
                    $coach['day1']['warmup'] = $warmup;
                    $coach['day1']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day1']['exercises'] = [];
                    //intensify csWorkout1
                    $coach['day1']['workout'] = self::intensifyWorkout($csWorkout1, 1);
                    $coach['day1']['workout_intensity'] = 2;
                    $coach['day1']['hiit'] = [];
                    $coach['day1']['stretching'] = $stretches;

                    //Day2 Exercise set
                    $coach['day2']['warmup'] = $warmup;
                    $coach['day2']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day2']['exercises'] = [];
                    $coach['day2']['workout'] = $csWorkout2;
                    $coach['day2']['workout_intensity'] = 1;
                    $coach['day2']['hiit'] = [1];
                    $coach['day2']['stretching'] = $stretches;

                    //Day3 Exercise set
                    $coach['day3']['warmup'] = $warmup;
                    $coach['day3']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day3']['exercises'] = [];
                    //intensify sWorkout2
                    $coach['day3']['workout'] = self::intensifyWorkout($sWorkout1, 1);
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
                    $coach['day1']['workout_intensity'] = 2;
                    $coach['day1']['hiit'] = [];
                    $coach['day1']['stretching'] = $stretches;

                    //Day2 Exercise set
                    $coach['day2']['warmup'] = $warmup;
                    $coach['day2']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day2']['exercises'] = [];
                    $coach['day2']['workout'] = $csWorkout2;
                    $coach['day2']['workout_intensity'] = 1;
                    $coach['day2']['hiit'] = [3];
                    $coach['day2']['stretching'] = $stretches;

                    //Day3 Exercise set
                    $coach['day3']['warmup'] = $warmup;
                    $coach['day3']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day3']['exercises'] = [];
                    //intensify sWorkout2
                    $coach['day3']['workout'] = self::intensifyWorkout($csWorkout3, 1);
                    $coach['day3']['workout_intensity'] = 2;
                    $coach['day3']['hiit'] = [];
                    $coach['day3']['stretching'] = $stretches;

                    //Day4 Exercise set
                    $coach['day4']['warmup'] = $warmup;
                    $coach['day4']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day4']['exercises'] = [];
                    //intensify sWorkout2
                    $coach['day4']['workout'] = $sWorkout1;
                    $coach['day4']['workout_intensity'] = 1;
                    $coach['day4']['hiit'] = [1];
                    $coach['day4']['stretching'] = $stretches;
                } elseif ($data['days'] == 5) {

                    //Day1 exercise set
                    $coach['day1']['warmup'] = $warmup;
                    $coach['day1']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day1']['exercises'] = [];
                    //intensify csWorkout1
                    $coach['day1']['workout'] = self::intensifyWorkout($csWorkout1, 1);
                    $coach['day1']['workout_intensity'] = 2;
                    $coach['day1']['hiit'] = [];
                    $coach['day1']['stretching'] = $stretches;

                    //Day2 Exercise set
                    $coach['day2']['warmup'] = $warmup;
                    $coach['day2']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day2']['exercises'] = [];
                    $coach['day2']['workout'] = $csWorkout2;
                    $coach['day2']['workout_intensity'] = 1;
                    $coach['day2']['hiit'] = [1];
                    $coach['day2']['stretching'] = $stretches;

                    //Day3 Exercise set
                    $coach['day3']['warmup'] = $warmup;
                    $coach['day3']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day3']['exercises'] = [];
                    //intensify sWorkout2
                    $coach['day3']['workout'] = self::intensifyWorkout($csWorkout3, 1);
                    $coach['day3']['workout_intensity'] = 2;
                    $coach['day3']['hiit'] = [];
                    $coach['day3']['stretching'] = $stretches;

                    //Day4 Exercise set
                    $coach['day4']['warmup'] = $warmup;
                    $coach['day4']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day4']['exercises'] = [];
                    //intensify sWorkout2
                    $coach['day4']['workout'] = $sWorkout1;
                    $coach['day4']['workout_intensity'] = 1;
                    $coach['day4']['hiit'] = [3];
                    $coach['day4']['stretching'] = $stretches;

                    //Day5 Exercise set
                    $coach['day5']['warmup'] = $warmup;
                    $coach['day5']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day5']['exercises'] = [];
                    //intensify sWorkout2
                    $coach['day5']['workout'] = self::intensifyWorkout($sWorkout2, 1);
                    $coach['day5']['workout_intensity'] = 2;
                    $coach['day5']['hiit'] = [1];
                    $coach['day5']['stretching'] = $stretches;
                } elseif ($data['days'] == 6) {

                    //Day1 exercise set
                    $coach['day1']['warmup'] = $warmup;
                    $coach['day1']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day1']['exercises'] = [];
                    //intensify csWorkout1
                    $coach['day1']['workout'] = self::intensifyWorkout($csWorkout1, 1);
                    $coach['day1']['workout_intensity'] = 2;
                    $coach['day1']['hiit'] = [];
                    $coach['day1']['stretching'] = $stretches;

                    //Day2 Exercise set
                    $coach['day2']['warmup'] = $warmup;
                    $coach['day2']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day2']['exercises'] = [];
                    $coach['day2']['workout'] = $csWorkout2;
                    $coach['day2']['workout_intensity'] = 1;
                    $coach['day2']['hiit'] = [1, 3];
                    $coach['day2']['stretching'] = $stretches;

                    //Day3 Exercise set
                    $coach['day3']['warmup'] = $warmup;
                    $coach['day3']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day3']['exercises'] = [];
                    //intensify sWorkout2
                    $coach['day3']['workout'] = self::intensifyWorkout($csWorkout3, 1);
                    $coach['day3']['workout_intensity'] = 2;
                    $coach['day3']['hiit'] = [];
                    $coach['day3']['stretching'] = $stretches;

                    //Day4 Exercise set
                    $coach['day4']['warmup'] = $warmup;
                    $coach['day4']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day4']['exercises'] = [];
                    //intensify sWorkout2
                    $coach['day4']['workout'] = self::intensifyWorkout($csWorkout4, 1);
                    $coach['day4']['workout_intensity'] = 2;
                    $coach['day4']['hiit'] = [];
                    $coach['day4']['stretching'] = $stretches;

                    //Day5 Exercise set
                    $coach['day5']['warmup'] = $warmup;
                    $coach['day5']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day5']['exercises'] = [];
                    //intensify sWorkout2
                    $coach['day5']['workout'] = $sWorkout1;
                    $coach['day5']['workout_intensity'] = 1;
                    $coach['day5']['hiit'] = [3];
                    $coach['day5']['stretching'] = $stretches;

                    //Day5 Exercise set
                    $coach['day6']['warmup'] = $warmup;
                    $coach['day6']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day6']['exercises'] = [];
                    //intensify sWorkout2
                    $coach['day6']['workout'] = self::intensifyWorkout($sWorkout2, 1);
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
                    $coach['day1']['workout_intensity'] = 2;
                    $coach['day1']['hiit'] = [];
                    $coach['day1']['stretching'] = $stretches;

                    //Day2 Exercise set
                    $coach['day2']['warmup'] = $warmup;
                    $coach['day2']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day2']['exercises'] = [];
                    $coach['day2']['workout'] = $sWorkout1;
                    $coach['day2']['workout_intensity'] = 1;
                    $coach['day2']['hiit'] = [1];
                    $coach['day2']['stretching'] = $stretches;
                } elseif ($data['days'] == 3) {

                    //Day1 exercise set
                    $coach['day1']['warmup'] = $warmup;
                    $coach['day1']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day1']['exercises'] = [];
                    //intensify csWorkout1
                    $coach['day1']['workout'] = self::intensifyWorkout($csWorkout1, 1);
                    $coach['day1']['workout_intensity'] = 2;
                    $coach['day1']['hiit'] = [];
                    $coach['day1']['stretching'] = $stretches;

                    //Day2 Exercise set
                    $coach['day2']['warmup'] = $warmup;
                    $coach['day2']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day2']['exercises'] = [];
                    $coach['day2']['workout'] = $sWorkout1;
                    $coach['day2']['workout_intensity'] = 1;
                    $coach['day2']['hiit'] = [1];
                    $coach['day2']['stretching'] = $stretches;

                    //Day3 Exercise set
                    $coach['day3']['warmup'] = $warmup;
                    $coach['day3']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day3']['exercises'] = [];
                    //intensify sWorkout2
                    $coach['day3']['workout'] = self::intensifyWorkout($sWorkout2, 1);
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
                    $coach['day1']['workout_intensity'] = 2;
                    $coach['day1']['hiit'] = [];
                    $coach['day1']['stretching'] = $stretches;

                    //Day2 Exercise set
                    $coach['day2']['warmup'] = $warmup;
                    $coach['day2']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day2']['exercises'] = [];
                    $coach['day2']['workout'] = $csWorkout2;
                    $coach['day2']['workout_intensity'] = 1;
                    $coach['day2']['hiit'] = [3];
                    $coach['day2']['stretching'] = $stretches;

                    //Day3 Exercise set
                    $coach['day3']['warmup'] = $warmup;
                    $coach['day3']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day3']['exercises'] = [];
                    //intensify sWorkout2
                    $coach['day3']['workout'] = self::intensifyWorkout($sWorkout1, 1);
                    $coach['day3']['workout_intensity'] = 2;
                    $coach['day3']['hiit'] = [];
                    $coach['day3']['stretching'] = $stretches;

                    //Day4 Exercise set
                    $coach['day4']['warmup'] = $warmup;
                    $coach['day4']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day4']['exercises'] = [];
                    //intensify sWorkout2
                    $coach['day4']['workout'] = $sWorkout2;
                    $coach['day4']['workout_intensity'] = 1;
                    $coach['day4']['hiit'] = [1];
                    $coach['day4']['stretching'] = $stretches;
                } elseif ($data['days'] == 5) {

                    //Day1 exercise set
                    $coach['day1']['warmup'] = $warmup;
                    $coach['day1']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day1']['exercises'] = [];
                    //intensify csWorkout1
                    $coach['day1']['workout'] = self::intensifyWorkout($csWorkout1, 1);
                    $coach['day1']['workout_intensity'] = 2;
                    $coach['day1']['hiit'] = [];
                    $coach['day1']['stretching'] = $stretches;

                    //Day2 Exercise set
                    $coach['day2']['warmup'] = $warmup;
                    $coach['day2']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day2']['exercises'] = [];
                    $coach['day2']['workout'] = $csWorkout2;
                    $coach['day2']['workout_intensity'] = 1;
                    $coach['day2']['hiit'] = [1];
                    $coach['day2']['stretching'] = $stretches;

                    //Day3 Exercise set
                    $coach['day3']['warmup'] = $warmup;
                    $coach['day3']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day3']['exercises'] = [];
                    //intensify sWorkout2
                    $coach['day3']['workout'] = self::intensifyWorkout($csWorkout3, 1);
                    $coach['day3']['workout_intensity'] = 2;
                    $coach['day3']['hiit'] = [];
                    $coach['day3']['stretching'] = $stretches;

                    //Day4 Exercise set
                    $coach['day4']['warmup'] = $warmup;
                    $coach['day4']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day4']['exercises'] = [];
                    //intensify sWorkout2
                    $coach['day4']['workout'] = $sWorkout1;
                    $coach['day4']['workout_intensity'] = 1;
                    $coach['day4']['hiit'] = [3];
                    $coach['day4']['stretching'] = $stretches;

                    //Day5 Exercise set
                    $coach['day5']['warmup'] = $warmup;
                    $coach['day5']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day5']['exercises'] = [];
                    //intensify sWorkout2
                    $coach['day5']['workout'] = self::intensifyWorkout($sWorkout2, 1);
                    $coach['day5']['hiit'] = [1];
                    $coach['day5']['stretching'] = $stretches;
                } elseif ($data['days'] == 6) {

                    //Day1 exercise set
                    $coach['day1']['warmup'] = $warmup;
                    $coach['day1']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day1']['exercises'] = [];
                    //intensify csWorkout1
                    $coach['day1']['workout'] = self::intensifyWorkout($csWorkout1, 1);
                    $coach['day1']['workout_intensity'] = 2;
                    $coach['day1']['hiit'] = [];
                    $coach['day1']['stretching'] = $stretches;

                    //Day2 Exercise set
                    $coach['day2']['warmup'] = $warmup;
                    $coach['day2']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day2']['exercises'] = [];
                    $coach['day2']['workout'] = $csWorkout2;
                    $coach['day2']['workout_intensity'] = 1;
                    $coach['day2']['hiit'] = [1, 3];
                    $coach['day2']['stretching'] = $stretches;

                    //Day3 Exercise set
                    $coach['day3']['warmup'] = $warmup;
                    $coach['day3']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day3']['exercises'] = [];
                    //intensify sWorkout2
                    $coach['day3']['workout'] = self::intensifyWorkout($csWorkout3, 1);
                    $coach['day3']['workout_intensity'] = 2;
                    $coach['day4']['hiit'] = [];
                    $coach['day3']['stretching'] = $stretches;

                    //Day4 Exercise set
                    $coach['day4']['warmup'] = $warmup;
                    $coach['day4']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day4']['exercises'] = [];
                    //intensify sWorkout2
                    $coach['day4']['workout'] = self::intensifyWorkout($sWorkout1, 1);
                    $coach['day4']['workout_intensity'] = 2;
                    $coach['day4']['hiit'] = [];
                    $coach['day4']['stretching'] = $stretches;

                    //Day5 Exercise set
                    $coach['day5']['warmup'] = $warmup;
                    $coach['day5']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day5']['exercises'] = [];
                    //intensify sWorkout2
                    $coach['day5']['workout'] = $sWorkout2;
                    $coach['day5']['workout_intensity'] = 1;
                    $coach['day5']['hiit'] = [3];
                    $coach['day5']['stretching'] = $stretches;

                    //Day5 Exercise set
                    $coach['day6']['warmup'] = $warmup;
                    $coach['day6']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day6']['exercises'] = [];
                    //intensify sWorkout2
                    $coach['day6']['workout'] = self::intensifyWorkout($sWorkout3, 1);
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
                    $coach['day1']['workout_intensity'] = 2;
                    $coach['day1']['hiit'] = [];
                    $coach['day1']['stretching'] = $stretches;

                    //Day2 Exercise set
                    $coach['day2']['warmup'] = $warmup;
                    $coach['day2']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day2']['exercises'] = [];
                    $coach['day2']['workout'] = $sWorkout1;
                    $coach['day2']['workout_intensity'] = 1;
                    $coach['day2']['hiit'] = [1];
                    $coach['day2']['stretching'] = $stretches;
                } elseif ($data['days'] == 3) {

                    //Day1 exercise set
                    $coach['day1']['warmup'] = $warmup;
                    $coach['day1']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day1']['exercises'] = [];
                    //intensify csWorkout1
                    $coach['day1']['workout'] = self::intensifyWorkout($csWorkout1, 1);
                    $coach['day1']['workout_intensity'] = 2;
                    $coach['day1']['hiit'] = [];
                    $coach['day1']['stretching'] = $stretches;

                    //Day2 Exercise set
                    $coach['day2']['warmup'] = $warmup;
                    $coach['day2']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day2']['exercises'] = [];
                    $coach['day2']['workout'] = $sWorkout1;
                    $coach['day2']['workout_intensity'] = 1;
                    $coach['day2']['hiit'] = [1];
                    $coach['day2']['stretching'] = $stretches;

                    //Day3 Exercise set
                    $coach['day3']['warmup'] = $warmup;
                    $coach['day3']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day3']['exercises'] = [];
                    //intensify sWorkout2
                    $coach['day3']['workout'] = self::intensifyWorkout($sWorkout2, 1);
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
                    $coach['day1']['workout_intensity'] = 2;
                    $coach['day1']['hiit'] = [];
                    $coach['day1']['stretching'] = $stretches;

                    //Day2 Exercise set
                    $coach['day2']['warmup'] = $warmup;
                    $coach['day2']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day2']['exercises'] = [];
                    $coach['day2']['workout'] = $csWorkout2;
                    $coach['day2']['workout_intensity'] = 1;
                    $coach['day2']['hiit'] = [3];
                    $coach['day2']['stretching'] = $stretches;

                    //Day3 Exercise set
                    $coach['day3']['warmup'] = $warmup;
                    $coach['day3']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day3']['exercises'] = [];
                    //intensify sWorkout2
                    $coach['day3']['workout'] = self::intensifyWorkout($sWorkout1, 1);
                    $coach['day3']['workout_intensity'] = 2;
                    $coach['day3']['hiit'] = [];
                    $coach['day3']['stretching'] = $stretches;

                    //Day4 Exercise set
                    $coach['day4']['warmup'] = $warmup;
                    $coach['day4']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day4']['exercises'] = [];
                    //intensify sWorkout2
                    $coach['day4']['workout'] = $sWorkout2;
                    $coach['day4']['workout_intensity'] = 1;
                    $coach['day4']['hiit'] = [1];
                    $coach['day4']['stretching'] = $stretches;
                } elseif ($data['days'] == 5) {

                    //Day1 exercise set
                    $coach['day1']['warmup'] = $warmup;
                    $coach['day1']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day1']['exercises'] = [];
                    //intensify csWorkout1
                    $coach['day1']['workout'] = self::intensifyWorkout($csWorkout1, 1);
                    $coach['day1']['workout_intensity'] = 2;
                    $coach['day1']['hiit'] = [];
                    $coach['day1']['stretching'] = $stretches;

                    //Day2 Exercise set
                    $coach['day2']['warmup'] = $warmup;
                    $coach['day2']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day2']['exercises'] = [];
                    $coach['day2']['workout'] = $csWorkout2;
                    $coach['day2']['workout_intensity'] = 1;
                    $coach['day2']['hiit'] = [1];
                    $coach['day2']['stretching'] = $stretches;

                    //Day3 Exercise set
                    $coach['day3']['warmup'] = $warmup;
                    $coach['day3']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day3']['exercises'] = [];
                    //intensify sWorkout2
                    $coach['day3']['workout'] = self::intensifyWorkout($csWorkout3, 1);
                    $coach['day3']['workout_intensity'] = 2;
                    $coach['day3']['hiit'] = [];
                    $coach['day3']['stretching'] = $stretches;

                    //Day4 Exercise set
                    $coach['day4']['warmup'] = $warmup;
                    $coach['day4']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day4']['exercises'] = [];
                    //intensify sWorkout2
                    $coach['day4']['workout'] = $sWorkout1;
                    $coach['day4']['workout_intensity'] = 1;
                    $coach['day4']['hiit'] = [3];
                    $coach['day4']['stretching'] = $stretches;

                    //Day5 Exercise set
                    $coach['day5']['warmup'] = $warmup;
                    $coach['day5']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day5']['exercises'] = [];
                    //intensify sWorkout2
                    $coach['day5']['workout'] = self::intensifyWorkout($sWorkout2, 1);
                    $coach['day5']['hiit'] = [1];
                    $coach['day5']['stretching'] = $stretches;
                } elseif ($data['days'] == 6) {

                    //Day1 exercise set
                    $coach['day1']['warmup'] = $warmup;
                    $coach['day1']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day1']['exercises'] = [];
                    //intensify csWorkout1
                    $coach['day1']['workout'] = self::intensifyWorkout($csWorkout1, 1);
                    $coach['day1']['workout_intensity'] = 2;
                    $coach['day1']['hiit'] = [];
                    $coach['day1']['stretching'] = $stretches;

                    //Day2 Exercise set
                    $coach['day2']['warmup'] = $warmup;
                    $coach['day2']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day2']['exercises'] = [];
                    $coach['day2']['workout'] = $csWorkout2;
                    $coach['day2']['workout_intensity'] = 1;
                    $coach['day2']['hiit'] = [1, 3];
                    $coach['day2']['stretching'] = $stretches;

                    //Day3 Exercise set
                    $coach['day3']['warmup'] = $warmup;
                    $coach['day3']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day3']['exercises'] = [];
                    //intensify sWorkout2
                    $coach['day3']['workout'] = self::intensifyWorkout($csWorkout3, 1);
                    $coach['day3']['workout_intensity'] = 2;
                    $coach['day3']['hiit'] = [];
                    $coach['day3']['stretching'] = $stretches;

                    //Day4 Exercise set
                    $coach['day4']['warmup'] = $warmup;
                    $coach['day4']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day4']['exercises'] = [];
                    //intensify sWorkout2
                    $coach['day4']['workout'] = self::intensifyWorkout($sWorkout1, 1);
                    $coach['day4']['workout_intensity'] = 2;
                    $coach['day4']['hiit'] = [];
                    $coach['day4']['stretching'] = $stretches;

                    //Day5 Exercise set
                    $coach['day5']['warmup'] = $warmup;
                    $coach['day5']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day5']['exercises'] = [];
                    //intensify sWorkout2
                    $coach['day5']['workout'] = $sWorkout2;
                    $coach['day5']['workout_intensity'] = 1;
                    $coach['day5']['hiit'] = [3];
                    $coach['day5']['stretching'] = $stretches;

                    //Day5 Exercise set
                    $coach['day6']['warmup'] = $warmup;
                    $coach['day6']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day6']['exercises'] = [];
                    //intensify sWorkout2
                    $coach['day6']['workout'] = self::intensifyWorkout($sWorkout3, 1);
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
                    $coach['day1']['workout_intensity'] = 2;
                    $coach['day1']['hiit'] = [];
                    $coach['day1']['stretching'] = $stretches;

                    //Day2 Exercise set
                    $coach['day2']['warmup'] = $warmup;
                    $coach['day2']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day2']['exercises'] = [];
                    $coach['day2']['workout'] = $csWorkout2;
                    $coach['day1']['workout_intensity'] = 1;
                    $coach['day2']['hiit'] = [2];
                    $coach['day2']['stretching'] = $stretches;
                } elseif ($data['days'] == 3) {

                    //Day1 exercise set
                    $coach['day1']['warmup'] = $warmup;
                    $coach['day1']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day1']['exercises'] = [];
                    //intensify csWorkout1
                    $coach['day1']['workout'] = self::intensifyWorkout($csWorkout1, 1);
                    $coach['day1']['workout_intensity'] = 2;
                    $coach['day1']['hiit'] = [];
                    $coach['day1']['stretching'] = $stretches;

                    //Day2 Exercise set
                    $coach['day2']['warmup'] = $warmup;
                    $coach['day2']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day2']['exercises'] = [];
                    $coach['day2']['workout'] = $csWorkout2;
                    $coach['day2']['workout_intensity'] = 1;
                    $coach['day2']['hiit'] = [2];
                    $coach['day2']['stretching'] = $stretches;

                    //Day3 Exercise set
                    $coach['day3']['warmup'] = $warmup;
                    $coach['day3']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day3']['exercises'] = [];
                    //intensify sWorkout2
                    $coach['day3']['workout'] = self::intensifyWorkout($sWorkout1, 1);
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
                    $coach['day1']['workout_intensity'] = 2;
                    $coach['day1']['hiit'] = [];
                    $coach['day1']['stretching'] = $stretches;

                    //Day2 Exercise set
                    $coach['day2']['warmup'] = $warmup;
                    $coach['day2']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day2']['exercises'] = [];
                    $coach['day2']['workout'] = $csWorkout2;
                    $coach['day2']['workout_intensity'] = 1;
                    $coach['day2']['hiit'] = [1];
                    $coach['day2']['stretching'] = $stretches;

                    //Day3 Exercise set
                    $coach['day3']['warmup'] = $warmup;
                    $coach['day3']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day3']['exercises'] = [];
                    //intensify sWorkout2
                    $coach['day3']['workout'] = self::intensifyWorkout($csWorkout3, 1);
                    $coach['day3']['workout_intensity'] = 2;
                    $coach['day3']['hiit'] = [];
                    $coach['day3']['stretching'] = $stretches;

                    //Day4 Exercise set
                    $coach['day4']['warmup'] = $warmup;
                    $coach['day4']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day4']['exercises'] = [];
                    //intensify sWorkout2
                    $coach['day4']['workout'] = $sWorkout1;
                    $coach['day4']['workout_intensity'] = 1;
                    $coach['day4']['hiit'] = [2];
                    $coach['day4']['stretching'] = $stretches;
                } elseif ($data['days'] == 5) {

                    //Day1 exercise set
                    $coach['day1']['warmup'] = $warmup;
                    $coach['day1']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day1']['exercises'] = [];
                    //intensify csWorkout1
                    $coach['day1']['workout'] = self::intensifyWorkout($csWorkout1, 1);
                    $coach['day1']['workout_intensity'] = 2;
                    $coach['day1']['hiit'] = [];
                    $coach['day1']['stretching'] = $stretches;

                    //Day2 Exercise set
                    $coach['day2']['warmup'] = $warmup;
                    $coach['day2']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day2']['exercises'] = [];
                    $coach['day2']['workout'] = $csWorkout2;
                    $coach['day2']['workout_intensity'] = 1;
                    $coach['day2']['hiit'] = [3];
                    $coach['day2']['stretching'] = $stretches;

                    //Day3 Exercise set
                    $coach['day3']['warmup'] = $warmup;
                    $coach['day3']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day3']['exercises'] = [];
                    //intensify sWorkout2
                    $coach['day3']['workout'] = self::intensifyWorkout($csWorkout3, 1);
                    $coach['day3']['workout_intensity'] = 2;
                    $coach['day3']['hiit'] = [];
                    $coach['day3']['stretching'] = $stretches;

                    //Day4 Exercise set
                    $coach['day4']['warmup'] = $warmup;
                    $coach['day4']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day4']['exercises'] = [];
                    //intensify sWorkout2
                    $coach['day4']['workout'] = $sWorkout1;
                    $coach['day4']['workout_intensity'] = 1;
                    $coach['day4']['hiit'] = [2];
                    $coach['day4']['stretching'] = $stretches;

                    //Day5 Exercise set
                    $coach['day5']['warmup'] = $warmup;
                    $coach['day5']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day5']['exercises'] = [];
                    //intensify sWorkout2
                    $coach['day5']['workout'] = self::intensifyWorkout($sWorkout2, 1);
                    $coach['day5']['workout_intensity'] = 2;
                    $coach['day5']['hiit'] = [1];
                    $coach['day5']['stretching'] = $stretches;
                } elseif ($data['days'] == 6) {

                    //Day1 exercise set
                    $coach['day1']['warmup'] = $warmup;
                    $coach['day1']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day1']['exercises'] = [];
                    //intensify csWorkout1
                    $coach['day1']['workout'] = self::intensifyWorkout($csWorkout1, 1);
                    $coach['day1']['workout_intensity'] = 2;
                    $coach['day1']['hiit'] = [];
                    $coach['day1']['stretching'] = $stretches;

                    //Day2 Exercise set
                    $coach['day2']['warmup'] = $warmup;
                    $coach['day2']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day2']['exercises'] = [];
                    $coach['day2']['workout'] = $csWorkout2;
                    $coach['day2']['workout_intensity'] = 1;
                    $coach['day2']['hiit'] = [1, 3];
                    $coach['day2']['stretching'] = $stretches;

                    //Day3 Exercise set
                    $coach['day3']['warmup'] = $warmup;
                    $coach['day3']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day3']['exercises'] = [];
                    //intensify sWorkout2
                    $coach['day3']['workout'] = self::intensifyWorkout($csWorkout3, 1);
                    $coach['day3']['workout_intensity'] = 2;
                    $coach['day3']['hiit'] = [];
                    $coach['day3']['stretching'] = $stretches;

                    //Day4 Exercise set
                    $coach['day4']['warmup'] = $warmup;
                    $coach['day4']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day4']['exercises'] = [];
                    //intensify sWorkout2
                    $coach['day4']['workout'] = self::intensifyWorkout($csWorkout4, 1);
                    $coach['day4']['workout_intensity'] = 2;
                    $coach['day4']['hiit'] = [];
                    $coach['day4']['stretching'] = $stretches;

                    //Day5 Exercise set
                    $coach['day5']['warmup'] = $warmup;
                    $coach['day5']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day5']['exercises'] = [];
                    //intensify sWorkout2
                    $coach['day5']['workout'] = $sWorkout1;
                    $coach['day5']['workout_intensity'] = 1;
                    $coach['day5']['hiit'] = [2];
                    $coach['day5']['stretching'] = $stretches;

                    //Day5 Exercise set
                    $coach['day6']['warmup'] = $warmup;
                    $coach['day6']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day6']['exercises'] = [];
                    //intensify sWorkout2
                    $coach['day6']['workout'] = self::intensifyWorkout($sWorkout2, 1);
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
                    $coach['day1']['workout_intensity'] = 2;
                    $coach['day1']['hiit'] = [];
                    $coach['day1']['stretching'] = $stretches;

                    //Day2 Exercise set
                    $coach['day2']['warmup'] = $warmup;
                    $coach['day2']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day2']['exercises'] = [];
                    $coach['day2']['workout'] = $sWorkout1;
                    $coach['day2']['workout_intensity'] = 1;
                    $coach['day2']['hiit'] = [2];
                    $coach['day2']['stretching'] = $stretches;
                } elseif ($data['days'] == 3) {

                    //Day1 exercise set
                    $coach['day1']['warmup'] = $warmup;
                    $coach['day1']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day1']['exercises'] = [];
                    //intensify csWorkout1
                    $coach['day1']['workout'] = self::intensifyWorkout($csWorkout1, 1);
                    $coach['day1']['workout_intensity'] = 2;
                    $coach['day1']['hiit'] = [];
                    $coach['day1']['stretching'] = $stretches;

                    //Day2 Exercise set
                    $coach['day2']['warmup'] = $warmup;
                    $coach['day2']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day2']['exercises'] = [];
                    $coach['day2']['workout'] = $sWorkout1;
                    $coach['day2']['workout_intensity'] = 1;
                    $coach['day2']['hiit'] = [2];
                    $coach['day2']['stretching'] = $stretches;

                    //Day3 Exercise set
                    $coach['day3']['warmup'] = $warmup;
                    $coach['day3']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day3']['exercises'] = [];
                    //intensify sWorkout2
                    $coach['day3']['workout'] = self::intensifyWorkout($sWorkout2, 1);
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
                    $coach['day1']['workout_intensity'] = 2;
                    $coach['day1']['hiit'] = [];
                    $coach['day1']['stretching'] = $stretches;

                    //Day2 Exercise set
                    $coach['day2']['warmup'] = $warmup;
                    $coach['day2']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day2']['exercises'] = [];
                    $coach['day2']['workout'] = $csWorkout2;
                    $coach['day2']['workout_intensity'] = 1;
                    $coach['day2']['hiit'] = [1];
                    $coach['day2']['stretching'] = $stretches;

                    //Day3 Exercise set
                    $coach['day3']['warmup'] = $warmup;
                    $coach['day3']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day3']['exercises'] = [];
                    //intensify sWorkout2
                    $coach['day3']['workout'] = self::intensifyWorkout($sWorkout1, 1);
                    $coach['day3']['workout_intensity'] = 2;
                    $coach['day3']['hiit'] = [];
                    $coach['day3']['stretching'] = $stretches;

                    //Day4 Exercise set
                    $coach['day4']['warmup'] = $warmup;
                    $coach['day4']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day4']['exercises'] = [];
                    //intensify sWorkout2
                    $coach['day4']['workout'] = $sWorkout2;
                    $coach['day4']['workout_intensity'] = 1;
                    $coach['day4']['hiit'] = [2];
                    $coach['day4']['stretching'] = $stretches;
                } elseif ($data['days'] == 5) {

                    //Day1 exercise set
                    $coach['day1']['warmup'] = $warmup;
                    $coach['day1']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day1']['exercises'] = [];
                    //intensify csWorkout1
                    $coach['day1']['workout'] = self::intensifyWorkout($csWorkout1, 1);
                    $coach['day1']['workout_intensity'] = 2;
                    $coach['day1']['hiit'] = [];
                    $coach['day1']['stretching'] = $stretches;

                    //Day2 Exercise set
                    $coach['day2']['warmup'] = $warmup;
                    $coach['day2']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day2']['exercises'] = [];
                    $coach['day2']['workout'] = $csWorkout2;
                    $coach['day2']['workout_intensity'] = 1;
                    $coach['day2']['hiit'] = [3];
                    $coach['day2']['stretching'] = $stretches;

                    //Day3 Exercise set
                    $coach['day3']['warmup'] = $warmup;
                    $coach['day3']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day3']['exercises'] = [];
                    //intensify sWorkout2
                    $coach['day3']['workout'] = self::intensifyWorkout($csWorkout3, 1);
                    $coach['day3']['workout_intensity'] = 2;
                    $coach['day3']['hiit'] = [];
                    $coach['day3']['stretching'] = $stretches;

                    //Day4 Exercise set
                    $coach['day4']['warmup'] = $warmup;
                    $coach['day4']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day4']['exercises'] = [];
                    //intensify sWorkout2
                    $coach['day4']['workout'] = $sWorkout1;
                    $coach['day4']['workout_intensity'] = 1;
                    $coach['day4']['hiit'] = [2];
                    $coach['day4']['stretching'] = $stretches;

                    //Day5 Exercise set
                    $coach['day5']['warmup'] = $warmup;
                    $coach['day5']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day5']['exercises'] = [];
                    //intensify sWorkout2
                    $coach['day5']['workout'] = self::intensifyWorkout($sWorkout2, 1);
                    $coach['day5']['workout_intensity'] = 2;
                    $coach['day5']['hiit'] = [1];
                    $coach['day5']['stretching'] = $stretches;
                } elseif ($data['days'] == 6) {

                    //Day1 exercise set
                    $coach['day1']['warmup'] = $warmup;
                    $coach['day1']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day1']['exercises'] = [];
                    //intensify csWorkout1
                    $coach['day1']['workout'] = self::intensifyWorkout($csWorkout1, 1);
                    $coach['day1']['workout_intensity'] = 2;
                    $coach['day1']['hiit'] = [];
                    $coach['day1']['stretching'] = $stretches;

                    //Day2 Exercise set
                    $coach['day2']['warmup'] = $warmup;
                    $coach['day2']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day2']['exercises'] = [];
                    $coach['day2']['workout'] = $csWorkout2;
                    $coach['day2']['workout_intensity'] = 1;
                    $coach['day2']['hiit'] = [1, 3];
                    $coach['day2']['stretching'] = $stretches;

                    //Day3 Exercise set
                    $coach['day3']['warmup'] = $warmup;
                    $coach['day3']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day3']['exercises'] = [];
                    //intensify sWorkout2
                    $coach['day3']['workout'] = self::intensifyWorkout($csWorkout3, 1);
                    $coach['day3']['workout_intensity'] = 2;
                    $coach['day3']['hiit'] = [];
                    $coach['day3']['stretching'] = $stretches;

                    //Day4 Exercise set
                    $coach['day4']['warmup'] = $warmup;
                    $coach['day4']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day4']['exercises'] = [];
                    //intensify sWorkout2
                    $coach['day4']['workout'] = self::intensifyWorkout($sWorkout1, 1);
                    $coach['day4']['workout_intensity'] = 2;
                    $coach['day4']['hiit'] = [];
                    $coach['day4']['stretching'] = $stretches;

                    //Day5 Exercise set
                    $coach['day5']['warmup'] = $warmup;
                    $coach['day5']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day5']['exercises'] = [];
                    //intensify sWorkout2
                    $coach['day5']['workout'] = $sWorkout2;
                    $coach['day5']['workout_intensity'] = 1;
                    $coach['day5']['hiit'] = [2];
                    $coach['day5']['stretching'] = $stretches;

                    //Day5 Exercise set
                    $coach['day6']['warmup'] = $warmup;
                    $coach['day6']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day6']['exercises'] = [];
                    //intensify sWorkout2
                    $coach['day6']['workout'] = self::intensifyWorkout($sWorkout3, 1);
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
                    $coach['day1']['workout_intensity'] = 2;
                    $coach['day1']['hiit'] = [];
                    $coach['day1']['stretching'] = $stretches;

                    //Day2 Exercise set
                    $coach['day2']['warmup'] = $warmup;
                    $coach['day2']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day2']['exercises'] = [];
                    $coach['day2']['workout'] = $sWorkout2;
                    $coach['day2']['workout_intensity'] = 1;
                    $coach['day2']['hiit'] = [2];
                    $coach['day2']['stretching'] = $stretches;
                } elseif ($data['days'] == 3) {

                    //Day1 exercise set
                    $coach['day1']['warmup'] = $warmup;
                    $coach['day1']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day1']['exercises'] = [];
                    //intensify csWorkout1
                    $coach['day1']['workout'] = self::intensifyWorkout($sWorkout1, 1);
                    $coach['day1']['workout_intensity'] = 2;
                    $coach['day1']['hiit'] = [];
                    $coach['day1']['stretching'] = $stretches;

                    //Day2 Exercise set
                    $coach['day2']['warmup'] = $warmup;
                    $coach['day2']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day2']['exercises'] = [];
                    $coach['day2']['workout'] = $sWorkout2;
                    $coach['day2']['workout_intensity'] = 1;
                    $coach['day2']['hiit'] = [2];
                    $coach['day2']['stretching'] = $stretches;

                    //Day3 Exercise set
                    $coach['day3']['warmup'] = $warmup;
                    $coach['day3']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day3']['exercises'] = [];
                    //intensify sWorkout2
                    $coach['day3']['workout'] = self::intensifyWorkout($sWorkout3, 1);
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
                    $coach['day1']['workout_intensity'] = 2;
                    $coach['day1']['hiit'] = [];
                    $coach['day1']['stretching'] = $stretches;

                    //Day2 Exercise set
                    $coach['day2']['warmup'] = $warmup;
                    $coach['day2']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day2']['exercises'] = [];
                    $coach['day2']['workout'] = $sWorkout2;
                    $coach['day2']['workout_intensity'] = 1;
                    $coach['day2']['hiit'] = [1];
                    $coach['day2']['stretching'] = $stretches;

                    //Day3 Exercise set
                    $coach['day3']['warmup'] = $warmup;
                    $coach['day3']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day3']['exercises'] = [];
                    //intensify sWorkout2
                    $coach['day3']['workout'] = self::intensifyWorkout($sWorkout3, 1);
                    $coach['day3']['workout_intensity'] = 2;
                    $coach['day3']['hiit'] = [];
                    $coach['day3']['stretching'] = $stretches;

                    //Day4 Exercise set
                    $coach['day4']['warmup'] = $warmup;
                    $coach['day4']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day4']['exercises'] = [];
                    //intensify sWorkout2
                    $coach['day4']['workout'] = $sWorkout4;
                    $coach['day4']['workout_intensity'] = 1;
                    $coach['day4']['hiit'] = [2];
                    $coach['day4']['stretching'] = $stretches;
                } elseif ($data['days'] == 5) {

                    //Day1 exercise set
                    $coach['day1']['warmup'] = $warmup;
                    $coach['day1']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day1']['exercises'] = [];
                    //intensify csWorkout1
                    $coach['day1']['workout'] = self::intensifyWorkout($csWorkout1, 1);
                    $coach['day1']['workout_intensity'] = 2;
                    $coach['day1']['hiit'] = [];
                    $coach['day1']['stretching'] = $stretches;

                    //Day2 Exercise set
                    $coach['day2']['warmup'] = $warmup;
                    $coach['day2']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day2']['exercises'] = [];
                    $coach['day2']['workout'] = $sWorkout1;
                    $coach['day2']['workout_intensity'] = 1;
                    $coach['day2']['hiit'] = [3];
                    $coach['day2']['stretching'] = $stretches;

                    //Day3 Exercise set
                    $coach['day3']['warmup'] = $warmup;
                    $coach['day3']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day3']['exercises'] = [];
                    //intensify sWorkout2
                    $coach['day3']['workout'] = self::intensifyWorkout($sWorkout2, 1);
                    $coach['day3']['workout_intensity'] = 2;
                    $coach['day3']['hiit'] = [];
                    $coach['day3']['stretching'] = $stretches;

                    //Day4 Exercise set
                    $coach['day4']['warmup'] = $warmup;
                    $coach['day4']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day4']['exercises'] = [];
                    //intensify sWorkout2
                    $coach['day4']['workout'] = $sWorkout3;
                    $coach['day4']['workout_intensity'] = 1;
                    $coach['day4']['hiit'] = [2];
                    $coach['day4']['stretching'] = $stretches;

                    //Day5 Exercise set
                    $coach['day5']['warmup'] = $warmup;
                    $coach['day5']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day5']['exercises'] = [];
                    //intensify sWorkout2
                    $coach['day5']['workout'] = self::intensifyWorkout($sWorkout4, 1);
                    $coach['day5']['workout_intensity'] = 2;
                    $coach['day5']['hiit'] = [1];
                    $coach['day5']['stretching'] = $stretches;
                } elseif ($data['days'] == 6) {

                    //Day1 exercise set
                    $coach['day1']['warmup'] = $warmup;
                    $coach['day1']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day1']['exercises'] = [];
                    //intensify csWorkout1
                    $coach['day1']['workout'] = self::intensifyWorkout($csWorkout1, 1);
                    $coach['day1']['workout_intensity'] = 2;
                    $coach['day1']['hiit'] = [];
                    $coach['day1']['stretching'] = $stretches;

                    //Day2 Exercise set
                    $coach['day2']['warmup'] = $warmup;
                    $coach['day2']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day2']['exercises'] = [];
                    $coach['day2']['workout'] = $sWorkout1;
                    $coach['day2']['workout_intensity'] = 1;
                    $coach['day2']['hiit'] = [1, 3];
                    $coach['day2']['stretching'] = $stretches;

                    //Day3 Exercise set
                    $coach['day3']['warmup'] = $warmup;
                    $coach['day3']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day3']['exercises'] = [];
                    //intensify sWorkout2
                    $coach['day3']['workout'] = self::intensifyWorkout($sWorkout2, 1);
                    $coach['day3']['workout_intensity'] = 2;
                    $coach['day3']['hiit'] = [];
                    $coach['day3']['stretching'] = $stretches;

                    //Day4 Exercise set
                    $coach['day4']['warmup'] = $warmup;
                    $coach['day4']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day4']['exercises'] = [];
                    //intensify sWorkout2
                    $coach['day4']['workout'] = self::intensifyWorkout($sWorkout3, 1);
                    $coach['day4']['workout_intensity'] = 2;
                    $coach['day4']['hiit'] = [];
                    $coach['day4']['stretching'] = $stretches;

                    //Day5 Exercise set
                    $coach['day5']['warmup'] = $warmup;
                    $coach['day5']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day5']['exercises'] = [];
                    //intensify sWorkout2
                    $coach['day5']['workout'] = $sWorkout4;
                    $coach['day5']['workout_intensity'] = 1;
                    $coach['day5']['hiit'] = [2];
                    $coach['day5']['stretching'] = $stretches;

                    //Day5 Exercise set
                    $coach['day6']['warmup'] = $warmup;
                    $coach['day6']['fundumentals'] = $fundumentalArray[random_int(1, 5)];
                    $coach['day6']['exercises'] = [];
                    //intensify sWorkout5
                    $coach['day6']['workout'] = self::intensifyWorkout($sWorkout5, 1);
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

    public static function updateCoach($exercises, $assessment)
    {
        if ($assessment != 3) {
            foreach ($exercises as $eKey => $dayExercise) {
                $exercises[$eKey] = self::updateDayExercises($dayExercise, $assessment);
            }
        }

        return $exercises;
    }

    public static function updateDayExercises($dayExercise, $assessment)
    {

        if ($assessment == 1) {

            if (isset($dayExercise['exercises'])) {
                foreach ($dayExercise['exercises'] as $fKey => $fundumental) {
                    if ($fundumental['exercise']['unit'] == 'times') {
                        if ($fundumental['duration'] < 25) {
                            $dayExercise['exercises'][$fKey]['duration'] = 25;
                        } elseif ($fundumental['duration'] >= 25 && $fundumental['duration'] < 50) {
                            $dayExercise['exercises'][$fKey]['duration'] = 50;
                        } elseif ($fundumental['duration'] >= 50 && $fundumental['duration'] < 100) {
                            $dayExercise['exercises'][$fKey]['duration'] = 100;
                        } elseif ($fundumental['duration'] >= 250 && $fundumental['duration'] < 500) {
                            $dayExercise['exercises'][$fKey]['duration'] = 500;
                        } elseif ($fundumental['duration'] >= 500 && $fundumental['duration'] < 750) {
                            $dayExercise['exercises'][$fKey]['duration'] = 750;
                        } elseif ($fundumental['duration'] >= 750 && $fundumental['duration'] <= 1000) {
                            $dayExercise['exercises'][$fKey]['duration'] = 1000;
                        }
                    } else {
                        $dayExercise['exercises'][$fKey]['duration'] = round($fundumental['duration'] + ($fundumental['duration'] * 5 / 100));
                    }
                }
            }

            if (isset($dayExercise['workout'])) {

                $dayExercise['workout'] = self::intensifyWorkout($workout, 1);

                $workoutExerciseRoundCount = count($dayExercise['workout']['exercises']);

                $dayExercise['workout_intensity'] = ceil($workoutExerciseRoundCount / $dayExercise['workout']['rounds']);
            }

            if (isset($dayExercise['hiit'])) {
                if (!empty($dayExercise['hiit'])) {
                    foreach ($dayExercise['hiit'] as $hiit) {
                        $dayExercise['hiit'][] = $hiit;
                    }
                }
            }

        } elseif ($assessment == 2) {
            if (isset($dayExercise['exercises'])) {
                foreach ($dayExercise['exercises'] as $fKey => $fundumental) {
                    if ($fundumental['exercise']['unit'] == 'times') {
                        if ($fundumental['duration'] < 25) {
                            $dayExercise['exercises'][$fKey]['duration'] = 25;
                        } elseif ($fundumental['duration'] >= 25 && $fundumental['duration'] < 50) {
                            $dayExercise['exercises'][$fKey]['duration'] = 50;
                        } elseif ($fundumental['duration'] >= 50 && $fundumental['duration'] < 100) {
                            $dayExercise['exercises'][$fKey]['duration'] = 100;
                        } elseif ($fundumental['duration'] >= 250 && $fundumental['duration'] < 500) {
                            $dayExercise['exercises'][$fKey]['duration'] = 500;
                        } elseif ($fundumental['duration'] >= 500 && $fundumental['duration'] < 750) {
                            $dayExercise['exercises'][$fKey]['duration'] = 750;
                        } elseif ($fundumental['duration'] >= 750 && $fundumental['duration'] <= 1000) {
                            $dayExercise['exercises'][$fKey]['duration'] = 1000;
                        }
                    } else {
                        $dayExercise['exercises'][$fKey]['duration'] = round($fundumental['duration'] + ($fundumental['duration'] * 5 / 100));
                    }
                }
            }

            if (isset($dayExercise['workout'])) {

                $dayExercise['workout'] = self::intensifyWorkout($workout, 1);

                $workoutExerciseRoundCount = count($dayExercise['workout']['exercises']);

                $dayExercise['workout_intensity'] = ceil($workoutExerciseRoundCount / $dayExercise['workout']['rounds']);
            }

            if (isset($dayExercise['workout_intensity'])) {
                $dayExercise['workout_intensity'] += $dayExercise['workout_intensity'];
            }
        }

        return $dayExercise;
    }
}
