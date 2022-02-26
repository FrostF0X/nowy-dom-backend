<?php

namespace App\Notification;

use App\Common\Entity\HasId;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Table;

#[Entity]
#[Table(name: "notification")]
class Notification
{
    use HasId;

    #[Column(type: "notification_region", nullable: false)]
    private NotificationRegion $region;
    #[Column(type: "text", nullable: true)]
    private string $text;

    public function getRegion(): NotificationRegion
    {
        return $this->region;
    }

    public function setRegion(NotificationRegion $region): void
    {
        $this->region = $region;
    }

    public function getText(): string
    {
        return $this->text;
    }

    public function setText(string $text): void
    {
        $this->text = $text;
    }

}
