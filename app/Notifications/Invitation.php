<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class Invitation extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
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
        $invite = $notifiable;
        $url = route('redeem', ['token' => $invite->token]);
        $user = $invite->user;
        $client = $invite->client;
        $key = $client->domain ? $client->domain : $client->name;
        $title = $user->name.' ('.$user->username.') invited you to join '.$key;

        return (new MailMessage())
                    ->success()
                    ->subject($title)
                    ->greeting($client->name)
                    ->line($title)
                    ->line($client->description)
                    ->action('Accept Invitation', $url)
                    ->line('This invitation is from a trusted user, so an account will be created for you automatically.')
                    ->line('If you are not interested to join then please ignore it, no further action is required.');
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
            //
        ];
    }
}
