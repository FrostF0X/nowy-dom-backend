<?php

namespace App\Notification;

use App\Common\Entity\HasId;
use App\Common\Entity\HasTimestamps;
use App\Common\Entity\Timestampable;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Table;

#[Entity]
#[Table(name: "notification")]
class Notification implements Timestampable
{
    use HasId;
    use HasTimestamps;

    #[Column(type: "notification_region", nullable: false)]
    private NotificationRegion $region;
    #[Column(type: "text", nullable: true)]
    private string $title;
    #[Column(type: "text", nullable: true)]
    private string $body;

    public function getRegion(): NotificationRegion
    {
        return $this->region;
    }

    public function setRegion(NotificationRegion $region): void
    {
        $this->region = $region;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function getBody(): string
    {
        return $this->body;
    }

    public function setBody(string $body): void
    {
        $this->body = $body;
    }

}
