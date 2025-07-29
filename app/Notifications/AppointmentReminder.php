<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AppointmentReminder extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->from('moalaa123321@gmail.com', 'Mostafa Alaa')
            ->greeting('Hello,')
            ->line('One Of Your Appoinment Has Been Confirmed.')
            ->action('View Appointment', url('/appointments'))
            ->line('Thank you for using our application!');
    }

    public function toDatabase($notifiable)
    {
        return [
            'title' => 'Appointment Confirmed',
            'message' => 'One Of Your Appointment Has Been Confirmed.',
            'action_url' => url('/appointments'),
            'action_text' => 'View Appointment',
        ];
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'id' => $this->id,
            'type' => 'AppointmentReminder',
            'data' => [
                'title' => 'Appointment Confirmed',
                'message' => 'One Of Your Appointment Has Been Confirmed.',
                'action_url' => url('/appointments'),
                'action_text' => 'View Appointment',
            ],
        ];
    }
}
