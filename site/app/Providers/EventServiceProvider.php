<?php namespace App\Providers;

use Illuminate\Contracts\Events\Dispatcher as DispatcherContract;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{

    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'user.created' => [
            'App\Events\UserEvents@userCreated',
        ],
        'user.deleted' => [
            'App\Events\UserEvents@userDeleted',
        ],
        'video.created' => [
            'App\Events\VideoEvents@videoCreated',
        ],
        'video.deleted' => [
            'App\Events\VideoEvents@videoDeleted',
        ],
    ];

    /**
     * Register any other events for your application.
     *
     * @param  \Illuminate\Contracts\Events\Dispatcher  $events
     * @return void
     */
    public function boot(DispatcherContract $events)
    {
        parent::boot($events);

        //
    }
}
