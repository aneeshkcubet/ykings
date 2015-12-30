<?php namespace App\Events;

use App\User;
use App\Uservideo;
use App\Video;
use App\Settings;
use App\Skill;
use App\Unlockedexercise;
use DB;
use App\Events\Event;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class UserEvents extends Event
{

    use SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return [];
    }

    public function userCreated(User $user)
    {
        $videos = Video::where('type', '=', 1)->get();

        if (!is_null($videos)) {
            foreach ($videos as $vKey => $video) {
                Uservideo::create([
                    'user_id' => $user->id,
                    'video_id' => $video->id
                ]);
            }
        }

        Settings::create([
            'user_id' => $user->id,
            'key' => 'subscription',
            'value' => 1
        ]);
        
        Settings::create([
            'user_id' => $user->id,
            'key' => 'notification',
            'value' => '{"comments":"1","claps":"0","follow":"0","my_performance":"1","motivation_knowledge":"1"}'
        ]);
        
        $unlockedSkills = Skill::where('level', 1)->get();
        
        foreach($unlockedSkills as $sKey => $unlockedSkill){
            Unlockedexercise::create([
                'user_id' => $user->id,
                'skill_id' => $unlockedSkill->id,
                'exercise_id' => $unlockedSkill->exercise_id
            ]);            
        }
    }

    public function userDeleted(User $user)
    {
        
    }
}
