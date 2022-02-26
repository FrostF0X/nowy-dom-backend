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

        $message = $this->messageBasedOnRegion($notification)
            ->withNotification(FirebaseNotification::create($notification->getTitle(), $notification->getBody()));

        $this->messaging->send($message);
    }

    /**
     * @param Notification $notification
     * @return CloudMessage
     */
    private function messageBasedOnRegion(Notification $notification): CloudMessage
    {

        return CloudMessage::withTarget('topic', $notification->getRegion()->getValue());
    }

}
