<?php

namespace App\Offer;

use Elao\Enum\Bridge\Symfony\Validator\Constraint\Enum;
use Symfony\Component\Validator\Constraints\NotBlank;

class OfferInput
{
    #[NotBlank, Enum(class: Region::class)]
    public string $region;
    #[NotBlank]
    public string $address;
    #[NotBlank]
    public string $description;
    #[NotBlank]
    public string $phoneNumber;
    #[NotBlank]
    public int $persons;

}
