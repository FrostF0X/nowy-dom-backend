<?php

namespace App\Offer;

use App\Common\Entity\HasId;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Table;

#[Entity(repositoryClass: OfferRepository::class)]
#[Table(name: "offer")]
class Offer
{
    use HasId;

    #[Column(type: "region")]
    private Region $region;
    #[Column(type: "string")]
    private string $address;
    #[Column(type: "text")]
    private string $description;
    #[Column(type: "string", length: 180)]
    private string $phoneNumber;
    #[Column(type: "integer", options: ["unsigned" => true])]
    private int $person;

    public function __construct(Region $region, string $address, string $description, string $phoneNumber, int $person)
    {
        $this->region = $region;
        $this->address = $address;
        $this->description = $description;
        $this->phoneNumber = $phoneNumber;
        $this->person = $person;
    }

    public function getRegion(): Region
    {
        return $this->region;
    }

    public function getAddress(): string
    {
        return $this->address;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getPhoneNumber(): string
    {
        return $this->phoneNumber;
    }

    public function getPersons(): int
    {
        return $this->person;
    }
}
