<?php

namespace App\Notifications\Messages;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use App\Models\Message;

class MessageCreatedNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(Message $message)
    {
        $this->message = $message;
        $this->poem = $message->poem;
        $this->category = $this->poem->text->category;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     *
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param mixed $notifiable
     *
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $subject = sprintf('%s shared a poem from Emerge.', $this->message->from_name);
        $text = sprintf('%s wanted to share this Emerge poem with you!', $this->message->from_name);

        return (new MailMessage())
            ->subject($subject)
            ->view('emails.poem', [
                'color' => $this->category->color,
                'poem' => $this->poem,
                'content' => $text,
                'note' => $this->message->note,
            ]);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param mixed $notifiable
     *
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
        ];
    }
}
