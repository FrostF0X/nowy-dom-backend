<?php

namespace App\Common\Entity;

use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Events;
use Doctrine\Persistence\Event\LifecycleEventArgs;

class TimestampableSubscriber implements EventSubscriber
{

    public function getSubscribedEvents(): array
    {
        return [Events::preUpdate, Events::prePersist];
    }

    public function preUpdate(LifecycleEventArgs $args): void
    {
        $hasTimestamps = $this->asHasTimestamps($args->getObject());
        if (!$hasTimestamps) {
            return;
        }
        $hasTimestamps->onPreUpdate();
    }

    /**
     * @return ?Timestampable
     */
    private function asHasTimestamps(object $object): ?object
    {
        if (in_array(HasTimestamps::class, (array)class_uses($object))) {
            /** @phpstan-ignore-next-line */
            return $object;
        }
        return null;
    }

    public function prePersist(LifecycleEventArgs $args): void
    {
        $hasTimestamps = $this->asHasTimestamps($args->getObject());
        if (!$hasTimestamps) {
            return;
        }
        $hasTimestamps->onPrePersist();
    }
}
