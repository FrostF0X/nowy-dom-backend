<?php

namespace App\Common\Entity;

use DateTimeImmutable;
use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;


trait HasTimestamps
{
    #[ORM\Column(type: "datetime_immutable", nullable: false)]
    private DateTimeImmutable $createdAt;

    #[ORM\Column(type: "datetime_immutable", nullable: false)]
    private DateTimeImmutable $updatedAt;

    public function getCreatedAt(): DateTimeInterface
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function onPrePersist(): void
    {
        $this->createdAt = new DateTimeImmutable("now");
        $this->updatedAt = new DateTimeImmutable("now");
    }

    public function onPreUpdate(): void
    {
        $this->updatedAt = new DateTimeImmutable("now");
    }
}
