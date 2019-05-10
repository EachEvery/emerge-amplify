<?php

namespace App\Events\Poems;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use App\Models\Poem;

class PoemCreated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Poem that was creatd.
     *
     * @var \App\Models\Poem
     */
    public $poem;

    /**
     * Create a new event instance.
     */
    public function __construct(Poem $poem)
    {
        $this->poem = $poem;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
