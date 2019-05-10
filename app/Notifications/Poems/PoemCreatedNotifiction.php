<?php

namespace App\Notifications\Poems;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use NotificationChannels\Twilio\TwilioMmsMessage;
use App\Models\Poem;
use NotificationChannels\Twilio\TwilioChannel;

class PoemCreatedNotifiction extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(Poem $poem)
    {
        $this->poem = $poem;
        $this->text = $poem->text;
        $this->category = $this->text->category;
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
        return ['mail', TwilioChannel::class];
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
        return (new MailMessage())
            ->subject('You created a poem with Emerge.')
            ->view('emails.poem', [
                'color' => $this->category->color,
                'poem' => $this->poem,
                'content' => 'You created a poem with Emerge.',
            ]);
    }

    public function toTwilio($notifiable)
    {
        return (new TwilioMmsMessage())
            ->content("Hey $notifiable->name, thanks for creating a poem with Emerge! You can view it here: ".$this->poem->public_url)
            ->mediaUrl($this->poem->photo_url);
    }
}
