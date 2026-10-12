<?php

namespace App\Notifications;

use App\Models\ServiceHourRecord;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ServiceHourRejected extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(
        public ServiceHourRecord $record,
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
            ->subject('Service Hours Rejected')
            ->line('Your service hour submission was rejected.')
            ->line('Reason: ' . $this->reason)
            ->action('View Service Hours', url('/volunteer/service-hours'));
    }

    public function toArray(object $notifiable): array
    {
        return [
            'title' => 'Service Hours Rejected',
            'message' => 'Your submission was rejected. Reason: ' . $this->reason,
            'type' => 'service_hour_rejected',
            'link' => '/volunteer/service-hours',
        ];
    }
}
