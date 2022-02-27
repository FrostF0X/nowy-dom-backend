<?php

namespace App\Notification;

use JetBrains\PhpStorm\Pure;

class NotificationTitle
{
    #[Pure] public static function create(Notification $notification): string
    {
        return $notification->getSignal() . ' ' . $notification->getTitle();
    }
}
