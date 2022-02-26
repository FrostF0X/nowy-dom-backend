<?php

namespace App\Common\Entity;

use DateTimeInterface;

interface Timestampable
{
    public function getCreatedAt(): DateTimeInterface;

    public function getUpdatedAt(): DateTimeInterface;
}
