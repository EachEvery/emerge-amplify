<?php

namespace App\Repositories;

use App\Models\Message;
use App\Events\Messages\MessageCreated;

class MessageRepository
{
    public function create($data)
    {
        return tap(Message::create($data), function ($message) {
            event(new MessageCreated($message));
        });
    }
}
