<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ResetPassword extends Notification
{
    public $token;

    public function __construct($token)
    {
        $this->token = $token;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Inspire Reset Password')
            ->line('You are receiving this email because we received a password reset request for your account.')
            ->action('Reset Password', url('forgot_password?token=?' . $this->token))
            ->line('If you did not request a password reset, no further action is required.');
    }
}
