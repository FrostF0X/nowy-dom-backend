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

        $allMessage = $this->messageToAllRegion()
            ->withNotification(FirebaseNotification::create(NotificationTitle::create($notification), $notification->getBody()));

        $regionMessage = $this->messageBasedOnRegion($notification)
            ->withNotification(FirebaseNotification::create(NotificationTitle::create($notification), $notification->getBody()));

        $this->messaging->send($regionMessage);
        if (!$notification->getRegion()->equals(NotificationRegion::TEST()) &&
            $notification->getDuplicateToAll()) {
            $this->messaging->send($allMessage);
        }
    }

    private function messageToAllRegion(): CloudMessage
    {
        return CloudMessage::withTarget('topic', NotificationRegionAll::VALUE);
    }

    private function messageBasedOnRegion(Notification $notification): CloudMessage
    {
        return CloudMessage::withTarget('topic', $notification->getRegion()->getValue());
    }

}
