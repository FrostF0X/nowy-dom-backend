<?php

namespace App\Common\Entity;

use Doctrine\ORM\Mapping as ORM;

trait HasId
{
    #[ORM\Id]
    #[ORM\Column(name: "id", type: "bigint", nullable: false, options: ["unsigned" => true])]
    #[ORM\GeneratedValue(strategy: "IDENTITY")]
    private int $id;

    public function getId(): string
    {
        return (string)$this->id;
    }
}
