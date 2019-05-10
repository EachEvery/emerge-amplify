<?php

namespace Tests\Feature\Controllers;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Notifications\Messages\MessageCreatedNotification;
use App\Models\Message;
use Illuminate\Support\Facades\Notification;

class MessageControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_message_can_be_saved_and_notifications_are_sent()
    {
        $response = $this->post('/messages', [
            'message' => [
                'from_name' => 'Sender',
                'from_email' => 'sender@example.com',
                'to_name' => 'Reciever',
                'to_email' => 'receiver@example.com',
                'poem_id' => $this->poems->random()->id,
            ],
        ]);

        $messageData = json_decode($response->assertStatus(201)->getContent());
        $message = Message::findOrFail($messageData->id);

        Notification::assertSentTo($message->to, MessageCreatedNotification::class,
            function ($notification) use ($message) {
                return $notification->message = $message;
            });
    }
}
