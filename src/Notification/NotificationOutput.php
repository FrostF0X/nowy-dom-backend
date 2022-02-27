<?php

namespace App\Notification;

use DateTimeInterface;
use JetBrains\PhpStorm\Pure;

class NotificationOutput
{

    public function __construct(
        public string $id,
        public string $createdAt,
        public string $createdAtParsed,
        public string $region,
        public string $title,
        public string $body,
    )
    {
    }

    public static function createMany(Notification ...$notifications): array
    {
        return collect($notifications)->map(fn(Notification $n) => self::create($n))->all();
    }

    #[Pure] public static function create(Notification $notification): self
    {
        return new self(
            $notification->getId(),
            $notification->getCreatedAt()->format(DateTimeInterface::ATOM),
            $notification->getCreatedAt()->format('H:i / d.m'),
            $notification->getRegion()->getValue(),
            $notification->getTitle(),
            $notification->getBody()
        );
    }

}
