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

    #[Column(type: "string", length: 180, nullable: false)]
    public string $email;
    #[Column(type: "string", length: 180, nullable: true)]
    public ?string $googleMapsLink;
    #[Column(type: "region", nullable: false)]
    private Region $region;
    #[Column(type: "string", nullable: false)]
    private string $address;
    #[Column(type: "text", nullable: true)]
    private ?string $description;
    #[Column(type: "string", length: 180, nullable: false)]
    private string $phoneNumber;
    #[Column(type: "integer", nullable: false, options: ["unsigned" => true])]
    private int $persons;

    public function __construct(string $email, ?string $googleMapsLink, Region $region, string $address, ?string $description, string $phoneNumber, int $persons)
    {
        $this->email = $email;
        $this->googleMapsLink = $googleMapsLink;
        $this->region = $region;
        $this->address = $address;
        $this->description = $description;
        $this->phoneNumber = $phoneNumber;
        $this->persons = $persons;
    }

    public function getRegion(): Region
    {
        return $this->region;
    }

    public function getAddress(): string
    {
        return $this->address;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function getPhoneNumber(): string
    {
        return $this->phoneNumber;
    }

    public function getPersons(): int
    {
        return $this->persons;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getGoogleMapsLink(): ?string
    {
        return $this->googleMapsLink;
    }
}
