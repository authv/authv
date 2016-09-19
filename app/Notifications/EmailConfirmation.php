<?php

namespace App\Notifications;

use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class EmailConfirmation extends Notification
{
    protected $token;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($token)
    {
        $this->token = $token;
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
        $url = route('confirm-email', ['token' => $this->token]);

        return (new MailMessage())
                    ->success()
                    ->subject('Confirm your new account')
                    ->greeting('Welcome!')
                    ->line('You are receiving this email because we received a create account request from this email address. Click the button below to confirm and activate your new account:')
                    ->action('Confirm & Activate', $url)
                    ->line('If you did not created an account, no further action is required.');
    }
}
