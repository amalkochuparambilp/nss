<?php

namespace App\Notifications;

use App\Models\ServiceHourRecord;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ServiceHourApproved extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(public ServiceHourRecord $record)
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
            ->subject('Service Hours Approved')
            ->line('Your service hour submission has been approved.')
            . $this->record->approved_hours . ' hours approved.')
            ->action('View Service Hours', url('/volunteer/service-hours'));
    }

    public function toArray(object $notifiable): array
    {
        return [
            'title' => 'Service Hours Approved',
            'message' => $this->record->approved_hours . ' hours approved.',
            'type' => 'service_hour_approved',
            'link' => '/volunteer/service-hours',
        ];
    }
}
