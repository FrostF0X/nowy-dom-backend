<?php

namespace App\Offer;

use JetBrains\PhpStorm\Pure;

class OfferOutput
{

    public function __construct(
        public string $id,
        public string $email,
        public ?string $googleMapsLink,
        public string $region,
        public string $address,
        public ?string $description,
        public string $phoneNumber,
        public int    $persons,
    )
    {
    }

    public static function createMany(Offer ...$offers): array
    {
        return array_map(fn(Offer $o) => self::create($o), $offers);
    }

    #[Pure] public static function create(Offer $offer): self
    {
        return new self(
            $offer->getId(),
            $offer->getEmail(),
            $offer->getGoogleMapsLink(),
            $offer->getRegion()->getValue(),
            $offer->getAddress(),
            $offer->getDescription(),
            $offer->getPhoneNumber(),
            $offer->getPersons(),
        );
    }
}
