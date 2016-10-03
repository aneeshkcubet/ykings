<?php
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Exercise;

class DatabaseSeeder extends Seeder
{

//    public function run()
//    {
//        Model::unguard();
//
//        DB::table('users')->delete();
//
//        $users = array(
//                ['name' => 'Ykings Admin', 'email' => 'admin@ykings.com', 'password' => Hash::make('admin123')],
//                ['name' => 'Ryan Chenkie', 'email' => 'ryanchenkie@gmail.com', 'password' => Hash::make('secret')],
//                ['name' => 'Chris Sevilleja', 'email' => 'chris@scotch.io', 'password' => Hash::make('secret')],
//                ['name' => 'Holly Lloyd', 'email' => 'holly@scotch.io', 'password' => Hash::make('secret')],
//                ['name' => 'Adnan Kukic', 'email' => 'adnan@scotch.io', 'password' => Hash::make('secret')],
//        );
//            
//        // Loop through each user above and create the record for them in the database
//        foreach ($users as $user)
//        {
//            User::create($user);
//        }
//
//        Model::reguard();
//    }

    public function run()
    {
        Model::unguard();

//        DB::table('exercises')->delete();
//
//        $exercises = array(
//            ['name' => 'Jumping Pullups', 'description' => 'The jumping pull-up is a challenging full body exercise that targets the back, legs and arms.', 'category' => '1', 'type' => '1', 'rewards' => '6', 'repititions' => 10, 'duration' => 0.50, 'equipment' => ''],
//            ['name' => 'Australian Pullups', 'description' => 'Australian pull-ups are becoming a very popular exercise. Like all types of pull-ups (and all types of exercises for that matter) there are many different ways to do the Australian, and it can be incorporated into a number of different contexts within a workout.', 'category' => '1', 'type' => '1', 'rewards' => '6', 'repititions' => 10, 'duration' => 0.50, 'equipment' => ''],
//            ['name' => 'Knee Raises', 'description' => 'Standing Knee Raises (also known as standing knee crunches and standing knee pulls) is a functional abdominal exercise for boosting strength throughout the core. Unlike standard ab exercises, they don’t isolate abdominal muscles. Instead they work your upper abs and lower abs in conjunction with other important muscles such as hips, back and shoulders.', 'category' => '1', 'type' => '1', 'rewards' => '6', 'repititions' => 10, 'duration' => 0.50, 'equipment' => ''],
//            ['name' => 'Skin the cat', 'description' => 'A good upper body stretching exercise, especially for achieving full range of motion in the shoulder. The skin the cat exercise is a fundamental movement performed on gymnastics rings.', 'category' => '1', 'type' => '1', 'rewards' => '6', 'repititions' => 10, 'duration' => 0.50, 'equipment' => ''],
//            ['name' => 'Side Trizeps', 'description' => '', 'category' => '1', 'type' => '1', 'rewards' => '6', 'repititions' => 10, 'duration' => 0.50, 'equipment' => ''],
//            ['name' => 'Trizeps Extension', 'description' => '', 'category' => '1', 'type' => '1', 'rewards' => '6', 'repititions' => 10, 'duration' => 0.50, 'equipment' => ''],
//            ['name' => 'Wall Sits', 'description' => '', 'category' => '1', 'type' => '1', 'rewards' => '6', 'repititions' => 10, 'duration' => 0.50, 'equipment' => ''],
//            ['name' => 'Single Leg Deadlift', 'description' => '', 'category' => '1', 'type' => '1', 'rewards' => '6', 'repititions' => 10, 'duration' => 0.50, 'equipment' => ''],
//            ['name' => 'Climbers', 'description' => '', 'category' => '1', 'type' => '1', 'rewards' => '6', 'repititions' => 10, 'duration' => 0.50, 'equipment' => ''],
//            ['name' => 'High Jumps', 'description' => '', 'category' => '1', 'type' => '1', 'rewards' => '6', 'repititions' => 10, 'duration' => 0.50, 'equipment' => ''],
//            ['name' => 'Sprawl', 'description' => '', 'category' => '1', 'type' => '1', 'rewards' => '6', 'repititions' => 10, 'duration' => 0.50, 'equipment' => ''],
//            ['name' => 'Incline Pushups', 'description' => '', 'category' => '1', 'type' => '1', 'rewards' => '6', 'repititions' => 10, 'duration' => 0.50, 'equipment' => ''],
//            ['name' => 'Military Press', 'description' => '', 'category' => '1', 'type' => '1', 'rewards' => '6', 'repititions' => 10, 'duration' => 0.50, 'equipment' => ''],
//            ['name' => 'Decline Pushups', 'description' => '', 'category' => '1', 'type' => '1', 'rewards' => '6', 'repititions' => 10, 'duration' => 0.50, 'equipment' => ''],
//            ['name' => 'Explosive Pushups', 'description' => '', 'category' => '1', 'type' => '1', 'rewards' => '6', 'repititions' => 10, 'duration' => 0.50, 'equipment' => ''],
//            ['name' => 'Crunches', 'description' => '', 'category' => '1', 'type' => '1', 'rewards' => '6', 'repititions' => 10, 'duration' => 0.50, 'equipment' => ''],
//            ['name' => 'Plank', 'description' => '', 'category' => '1', 'type' => '1', 'rewards' => '6', 'repititions' => 10, 'duration' => 0.50, 'equipment' => ''],
//            ['name' => 'Tucked Human Flag', 'description' => '', 'category' => '1', 'type' => '1', 'rewards' => '6', 'repititions' => 20, 'duration' => 0.50, 'equipment' => ''],
//            ['name' => 'Tucked Lever', 'description' => '', 'category' => '1', 'type' => '1', 'rewards' => '6', 'repititions' => 10, 'duration' => 0.50, 'equipment' => ''],
//            ['name' => 'Tuck Planche', 'description' => '', 'category' => '1', 'type' => '1', 'rewards' => '6', 'repititions' => 10, 'duration' => 0.50, 'equipment' => ''],
//            ['name' => 'Supported Pullups', 'description' => '', 'category' => '1', 'type' => '1', 'rewards' => '6', 'repititions' => 10, 'duration' => 0.50, 'equipment' => ''],
//            ['name' => 'Tuck Front Lever', 'description' => '', 'category' => '1', 'type' => '1', 'rewards' => '6', 'repititions' => 10, 'duration' => 0.50, 'equipment' => ''],
//            ['name' => 'Leg Raises', 'description' => '', 'category' => '1', 'type' => '1', 'rewards' => '6', 'repititions' => 10, 'duration' => 0.50, 'equipment' => ''],
//            ['name' => 'Tuck Back Lever', 'description' => '', 'category' => '1', 'type' => '1', 'rewards' => '6', 'repititions' => 10, 'duration' => 0.50, 'equipment' => ''],
//            ['name' => 'Ball Pushups', 'description' => '', 'category' => '1', 'type' => '1', 'rewards' => '6', 'repititions' => 10, 'duration' => 0.50, 'equipment' => ''],
//            ['name' => 'Assisted HS Pushups', 'description' => '', 'category' => '1', 'type' => '1', 'rewards' => '6', 'repititions' => 10, 'duration' => 0.50, 'equipment' => ''],
//            ['name' => 'Bicycle', 'description' => '', 'category' => '1', 'type' => '1', 'rewards' => '6', 'repititions' => 10, 'duration' => 0.50, 'equipment' => ''],
//            ['name' => 'Leg Raises', 'description' => '', 'category' => '1', 'type' => '1', 'rewards' => '6', 'repititions' => 10, 'duration' => 0.50, 'equipment' => ''],
//            ['name' => 'High Human Flag', 'description' => '', 'category' => '1', 'type' => '1', 'rewards' => '6', 'repititions' => 10, 'duration' => 0.50, 'equipment' => ''],
//            ['name' => 'Tucked Dragon Flag', 'description' => '', 'category' => '1', 'type' => '1', 'rewards' => '6', 'repititions' => 10, 'duration' => 0.50, 'equipment' => ''],
//            ['name' => 'Tuck Planche Hips up & down', 'description' => '', 'category' => '1', 'type' => '1', 'rewards' => '6', 'repititions' => 10, 'duration' => 0.50, 'equipment' => ''],
//            
//        );

//        $exercises = array(
//            ['name' => 'Pull ups / Chin ups', 'description' => '', 'category' => '2', 'type' => '1', 'rewards' => '6', 'repititions' => 10, 'duration' => 0.50, 'equipment' => ''],
//            ['name' => 'One Leg Front Lever', 'description' => '', 'category' => '2', 'type' => '1', 'rewards' => '6', 'repititions' => 10, 'duration' => 0.50, 'equipment' => ''],
//            ['name' => 'L-Sit', 'description' => '', 'category' => '2', 'type' => '1', 'rewards' => '6', 'repititions' => 10, 'duration' => 0.50, 'equipment' => ''],
//            ['name' => 'One Leg Back Lever', 'description' => '', 'category' => '2', 'type' => '1', 'rewards' => '6', 'repititions' => 10, 'duration' => 0.50, 'equipment' => ''],
//            ['name' => 'Dips (Bench)', 'description' => '', 'category' => '2', 'type' => '1', 'rewards' => '6', 'repititions' => 10, 'duration' => 0.50, 'equipment' => ''],
//            ['name' => 'Hip Lifts', 'description' => '', 'category' => '2', 'type' => '1', 'rewards' => '6', 'repititions' => 10, 'duration' => 0.50, 'equipment' => ''],
//            ['name' => 'Squats', 'description' => '', 'category' => '2', 'type' => '1', 'rewards' => '6', 'repititions' => 10, 'duration' => 0.50, 'equipment' => ''],
//            ['name' => 'Bulgarian Lunge', 'description' => '', 'category' => '2', 'type' => '1', 'rewards' => '6', 'repititions' => 10, 'duration' => 0.50, 'equipment' => ''],
//            ['name' => 'Lunge', 'description' => '', 'category' => '2', 'type' => '1', 'rewards' => '6', 'repititions' => 10, 'duration' => 0.50, 'equipment' => ''],
//            ['name' => 'Squat Jumps', 'description' => '', 'category' => '2', 'type' => '1', 'rewards' => '6', 'repititions' => 10, 'duration' => 0.50, 'equipment' => ''],
//            ['name' => 'Burpee', 'description' => '', 'category' => '2', 'type' => '1', 'rewards' => '6', 'repititions' => 10, 'duration' => 0.50, 'equipment' => ''],
//            ['name' => 'Pushups', 'description' => '', 'category' => '2', 'type' => '1', 'rewards' => '6', 'repititions' => 10, 'duration' => 0.50, 'equipment' => ''],
//            ['name' => 'Crow Pose', 'description' => '', 'category' => '2', 'type' => '1', 'rewards' => '6', 'repititions' => 10, 'duration' => 0.50, 'equipment' => ''],
//            ['name' => 'Diamond Pushups', 'description' => '', 'category' => '2', 'type' => '1', 'rewards' => '6', 'repititions' => 10, 'duration' => 0.50, 'equipment' => ''],
//            ['name' => 'Spiderman Pushups', 'description' => '', 'category' => '2', 'type' => '1', 'rewards' => '6', 'repititions' => 10, 'duration' => 0.50, 'equipment' => ''],
//            ['name' => 'Situps', 'description' => '', 'category' => '2', 'type' => '1', 'rewards' => '6', 'repititions' => 10, 'duration' => 0.50, 'equipment' => ''],
//            ['name' => 'Tucked Plank', 'description' => '', 'category' => '2', 'type' => '1', 'rewards' => '6', 'repititions' => 10, 'duration' => 0.50, 'equipment' => ''],
//            ['name' => 'L-Sit', 'description' => '', 'category' => '2', 'type' => '1', 'rewards' => '6', 'repititions' => 10, 'duration' => 0.50, 'equipment' => ''],
//            ['name' => 'Negative Human Flag', 'description' => '', 'category' => '2', 'type' => '1', 'rewards' => '6', 'repititions' => 10, 'duration' => 0.50, 'equipment' => ''],
//            ['name' => 'One Leg Dragon Flag', 'description' => '', 'category' => '2', 'type' => '1', 'rewards' => '6', 'repititions' => 10, 'duration' => 0.50, 'equipment' => ''],
//            ['name' => 'Pseudo Planche', 'description' => '', 'category' => '2', 'type' => '1', 'rewards' => '6', 'repititions' => 10, 'duration' => 0.50, 'equipment' => ''],
//            ['name' => 'Explosive Pull ups', 'description' => '', 'category' => '2', 'type' => '1', 'rewards' => '6', 'repititions' => 10, 'duration' => 0.50, 'equipment' => ''],
//            ['name' => 'Front Lever Top', 'description' => '', 'category' => '2', 'type' => '1', 'rewards' => '6', 'repititions' => 10, 'duration' => 0.50, 'equipment' => ''],
//            ['name' => 'L-Sit Pullup', 'description' => '', 'category' => '2', 'type' => '1', 'rewards' => '6', 'repititions' => 10, 'duration' => 0.50, 'equipment' => ''],
//            ['name' => 'Half Back Lever', 'description' => '', 'category' => '2', 'type' => '1', 'rewards' => '6', 'repititions' => 10, 'duration' => 0.50, 'equipment' => ''],
//            ['name' => 'Elevated Dips', 'description' => '', 'category' => '2', 'type' => '1', 'rewards' => '6', 'repititions' => 10, 'duration' => 0.50, 'equipment' => ''],
//            ['name' => 'Back Bridge', 'description' => '', 'category' => '2', 'type' => '1', 'rewards' => '6', 'repititions' => 10, 'duration' => 0.50, 'equipment' => ''],
//            ['name' => 'Assisted Pistols', 'description' => '', 'category' => '2', 'type' => '1', 'rewards' => '6', 'repititions' => 10, 'duration' => 0.50, 'equipment' => ''],
//            ['name' => 'Squat One Leg Jump', 'description' => '', 'category' => '2', 'type' => '1', 'rewards' => '6', 'repititions' => 10, 'duration' => 0.50, 'equipment' => ''],
//            ['name' => 'Assisted One Arm Pushup', 'description' => '', 'category' => '2', 'type' => '1', 'rewards' => '6', 'repititions' => 10, 'duration' => 0.50, 'equipment' => ''],
//            ['name' => 'Handstand', 'description' => '', 'category' => '2', 'type' => '1', 'rewards' => '6', 'repititions' => 10, 'duration' => 0.50, 'equipment' => ''],
//            ['name' => 'Clapping Pushups', 'description' => '', 'category' => '2', 'type' => '1', 'rewards' => '6', 'repititions' => 10, 'duration' => 0.50, 'equipment' => ''],
//            ['name' => 'V-Up Rollup', 'description' => '', 'category' => '2', 'type' => '1', 'rewards' => '6', 'repititions' => 10, 'duration' => 0.50, 'equipment' => ''],
//            ['name' => 'Side Hip Lifts', 'description' => '', 'category' => '2', 'type' => '1', 'rewards' => '6', 'repititions' => 10, 'duration' => 0.50, 'equipment' => ''],
//            ['name' => 'Tuck Knee Leg Lifts', 'description' => '', 'category' => '2', 'type' => '1', 'rewards' => '6', 'repititions' => 10, 'duration' => 0.50, 'equipment' => ''],
//            ['name' => 'Straddle Dragon Flag', 'description' => '', 'category' => '2', 'type' => '1', 'rewards' => '6', 'repititions' => 10, 'duration' => 0.50, 'equipment' => ''],
//            ['name' => 'Straddle Planche', 'description' => '', 'category' => '2', 'type' => '1', 'rewards' => '6', 'repititions' => 10, 'duration' => 0.50, 'equipment' => ''],
//        );
//        $exercises = array(
//            ['name' => 'Muscleups', 'description' => '', 'category' => '3', 'type' => '1', 'rewards' => '6', 'repititions' => 10, 'duration' => 0.50, 'equipment' => ''],
//            ['name' => 'Dips', 'description' => '', 'category' => '3', 'type' => '1', 'rewards' => '6', 'repititions' => 10, 'duration' => 0.50, 'equipment' => ''],
//            ['name' => 'Pistols', 'description' => '', 'category' => '3', 'type' => '1', 'rewards' => '6', 'repititions' => 10, 'duration' => 0.50, 'equipment' => ''],
//            ['name' => 'Burpee Squat Jumps', 'description' => '', 'category' => '3', 'type' => '1', 'rewards' => '6', 'repititions' => 10, 'duration' => 0.50, 'equipment' => ''],
//            ['name' => 'One Arm Pushups', 'description' => '', 'category' => '3', 'type' => '1', 'rewards' => '6', 'repititions' => 10, 'duration' => 0.50, 'equipment' => ''],
//            ['name' => 'Handstand Pushups', 'description' => '', 'category' => '3', 'type' => '1', 'rewards' => '6', 'repititions' => 10, 'duration' => 0.50, 'equipment' => ''],
//            ['name' => 'Jacknives', 'description' => '', 'category' => '3', 'type' => '1', 'rewards' => '6', 'repititions' => 10, 'duration' => 0.50, 'equipment' => ''],
//            ['name' => 'Side Plank', 'description' => '', 'category' => '3', 'type' => '1', 'rewards' => '6', 'repititions' => 10, 'duration' => 0.50, 'equipment' => ''],
//        );
        
//        $exercises = array(
//            ['name' => 'Front Lever', 'description' => '', 'category' => '3', 'type' => '2', 'rewards' => '10', 'repititions' => 10, 'duration' => 0.50, 'equipment' => ''],
//            ['name' => 'Pullover', 'description' => '', 'category' => '3', 'type' => '2', 'rewards' => '10', 'repititions' => 10, 'duration' => 0.50, 'equipment' => ''],
//            ['name' => 'Back Lever', 'description' => '', 'category' => '3', 'type' => '2', 'rewards' => '10', 'repititions' => 10, 'duration' => 0.50, 'equipment' => ''],
//            ['name' => 'Triceps Pushups', 'description' => '', 'category' => '3', 'type' => '2', 'rewards' => '10', 'repititions' => 10, 'duration' => 0.50, 'equipment' => ''],
//            ['name' => 'Shrimp Squats', 'description' => '', 'category' => '3', 'type' => '2', 'rewards' => '10', 'repititions' => 10, 'duration' => 0.50, 'equipment' => ''],
//            ['name' => 'Iron Mike', 'description' => '', 'category' => '3', 'type' => '2', 'rewards' => '10', 'repititions' => 10, 'duration' => 0.50, 'equipment' => ''],
//            ['name' => 'Pistol Jumps', 'description' => '', 'category' => '3', 'type' => '2', 'rewards' => '10', 'repititions' => 10, 'duration' => 0.50, 'equipment' => ''],
//            ['name' => 'Bruce Lee Pushups', 'description' => '', 'category' => '3', 'type' => '2', 'rewards' => '10', 'repititions' => 10, 'duration' => 0.50, 'equipment' => ''],
//            ['name' => 'Atztec Pushups', 'description' => '', 'category' => '3', 'type' => '2', 'rewards' => '10', 'repititions' => 10, 'duration' => 0.50, 'equipment' => ''],
//            ['name' => 'Toe Touches', 'description' => '', 'category' => '3', 'type' => '2', 'rewards' => '10', 'repititions' => 10, 'duration' => 0.50, 'equipment' => ''],
//            ['name' => 'Human Flag', 'description' => '', 'category' => '3', 'type' => '2', 'rewards' => '10', 'repititions' => 10, 'duration' => 0.50, 'equipment' => ''],
//            ['name' => 'Dragon Flag', 'description' => '', 'category' => '3', 'type' => '2', 'rewards' => '10', 'repititions' => 10, 'duration' => 0.50, 'equipment' => ''],
//            ['name' => 'Planche', 'description' => '', 'category' => '3', 'type' => '2', 'rewards' => '10', 'repititions' => 10, 'duration' => 0.50, 'equipment' => ''],
//        );

        // Loop through each user above and create the record for them in the database
        foreach ($exercises as $exercise) {
            Exercise::create($exercise);
        }

        Model::reguard();
    }
}
