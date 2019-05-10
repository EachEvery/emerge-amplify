<?php

namespace Tests\Feature\Controller;

use Tests\TestCase;
use Illuminate\Support\Facades\Notification;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Notifications\Poems\PoemCreatedNotifiction;
use Illuminate\Support\Facades\Storage;

class PoemControllerTest extends TestCase
{
    use RefreshDatabase;

    public function get_response()
    {
        return $this->post('/poems', $this->saveFixture->get());
    }

    public function test_poem_can_be_saved_and_notifications_are_sent()
    {
        $poem = json_decode($this->get_response()->assertStatus(201)->getContent());

        $poem = $this->poems->findOrFail($poem->id);

        Storage::disk('s3')->assertExists($poem->photo);

        Notification::assertSentTo($poem->user, PoemCreatedNotifiction::class,
            function ($notification) use ($poem) {
                return $notification->poem = $poem;
            });
    }
}
