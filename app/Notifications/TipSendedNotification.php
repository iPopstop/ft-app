<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;

class TipSendedNotification extends Notification
{

    public function __construct()
    {
        //
    }

    public function via($notifiable): array
    {
        return ['broadcast'];
    }

    public function toArray($notifiable): array
    {
        return [
            'updated' => true
        ];
    }
}
