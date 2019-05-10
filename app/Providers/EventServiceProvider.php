<?php

namespace App\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use App\Events\Poems\PoemCreated;
use App\Listeners\Poems\SendPoemCreatedNotification;
use App\Events\Messages\MessageCreated;
use App\Listeners\Messages\SendMessageNotification;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        PoemCreated::class => [
            SendPoemCreatedNotification::class,
        ],
        MessageCreated::class => [
            SendMessageNotification::class,
        ],
    ];

    /**
     * Register any events for your application.
     */
    public function boot()
    {
        parent::boot();
    }
}
