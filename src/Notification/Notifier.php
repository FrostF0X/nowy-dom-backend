<?php

namespace App\Notification;

use Kreait\Firebase\Contract\Messaging;
use Kreait\Firebase\Exception\FirebaseException;
use Kreait\Firebase\Exception\MessagingException;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\Messaging\Notification as FirebaseNotification;

class Notifier
{

    public function __construct(private Messaging $messaging)
    {
    }

    /**
     * @throws MessagingException
     * @throws FirebaseException
     */
    public function send(Notification $notification)
    {

        $regionMessage = $this->messageBasedOnRegion($notification)
            ->withNotification(FirebaseNotification::create($notification->getTitle(), $notification->getBody()));

        $allMessage = $this->messageBasedOnRegion($notification)
            ->withNotification(FirebaseNotification::create($notification->getTitle(), $notification->getBody()));

        $this->messaging->send($regionMessage);
        $this->messaging->send($allMessage);
    }

    private function messageBasedOnRegion(Notification $notification): CloudMessage
    {
        return CloudMessage::withTarget('topic', $notification->getRegion()->getValue());
    }

    private function messageToAllRegion(Notification $notification): CloudMessage
    {
        return CloudMessage::withTarget('topic', NotificationRegionAll::VALUE);
    }


}
