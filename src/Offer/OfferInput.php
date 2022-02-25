<?php

namespace App\Offer;

use Elao\Enum\Bridge\Symfony\Validator\Constraint\Enum;
use Symfony\Component\Validator\Constraints\NotBlank;

class OfferInput
{
    #[NotBlank]
    public string $email;
    public ?string $googleMapsLink = null;
    #[NotBlank, Enum(class: Region::class)]
    public string $region;
    #[NotBlank]
    public string $address;
    public ?string $description = null;
    #[NotBlank]
    public string $phoneNumber;
    #[NotBlank]
    public int $persons;
}
