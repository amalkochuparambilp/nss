<?php

namespace App\Notifications;

use App\Models\VolunteerProfile;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class VolunteerRejected extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(
        public VolunteerProfile $volunteer,
        public string $reason
    ) {
        //
    }

    public function via(object $notifiable): array
    {
        return ['database', 'mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('NSS Volunteer Enrollment Status')
            ->line('Your NSS volunteer enrollment was not approved.')
            ->line('Reason: ' . $this->reason)
            ->line('Please contact your Programme Officer for more information.');
    }

    public function toArray(object $notifiable): array
    {
        return [
            'title' => 'Enrollment Not Approved',
            'message' => 'Your NSS volunteer enrollment was not approved. Reason: ' . $this->reason,
            'type' => 'enrollment_rejected',
            'link' => '/dashboard',
        ];
    }
}
