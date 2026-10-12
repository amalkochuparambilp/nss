<?php

namespace App\Notifications;

use App\Models\VolunteerProfile;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class VolunteerApproved extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(public VolunteerProfile $volunteer)
    {
        //
    }

    public function via(object $notifiable): array
    {
        return ['database', 'mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('NSS Volunteer Enrollment Approved')
            ->line('Your NSS volunteer enrollment has been approved.')
            ->line('Institution: ' . $this->volunteer->institution?->name)
            ->line('Unit: ' . $this->volunteer->unit?->name)
            ->action('View Dashboard', url('/dashboard'))
            ->line('Thank you for joining NSS!');
    }

    public function toArray(object $notifiable): array
    {
        return [
            'title' => 'Enrollment Approved',
            'message' => 'Your NSS volunteer enrollment has been approved.',
            'type' => 'enrollment_approved',
            'link' => '/dashboard',
        ];
    }
}
