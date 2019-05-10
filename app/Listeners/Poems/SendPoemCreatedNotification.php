<?php

namespace App\Listeners\Poems;

use App\Notifications\Poems\PoemCreatedNotifiction;
use App\Events\Poems\PoemCreated;

class SendPoemCreatedNotification
{
    /**
     * Handle the event.
     *
     * @param object $event
     */
    public function handle(PoemCreated $event)
    {
        $poem = $event->poem;

        $poem->user->notify(new PoemCreatedNotifiction($poem));
    }
}
