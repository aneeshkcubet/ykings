<?php namespace App\Events;

use App\User;
use App\Uservideo;
use App\Video;
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
    }

    public function userDeleted(User $user)
    {
        
    }
}
