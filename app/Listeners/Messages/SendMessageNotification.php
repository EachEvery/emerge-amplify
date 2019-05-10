<?php

namespace App\Listeners\Messages;

use App\Events\Messages\MessageCreated;
use App\Notifications\Messages\MessageCreatedNotification;

class SendMessageNotification
{
    /**
     * Handle the event.
     *
     * @param object $event
     */
    public function handle(MessageCreated $event)
    {
        $event->message->to->notify(new MessageCreatedNotification($event->message));
    }
}
