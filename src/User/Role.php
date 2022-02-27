<?php

namespace App\User;

use App\Notification\NotificationRegion;
use JetBrains\PhpStorm\Pure;

class Role
{
    public const ROLE_SUPER_ADMIN = 'ROLE_SUPER_ADMIN';
    public const ROLE_ADMIN = 'ROLE_ADMIN';
    public const ROLE_ALL_REGIONS = 'ROLE_ALL_REGIONS';

    public static function allRegion(): array
    {
        return array_flip(NotificationRegion::MAP);
    }

    #[Pure] public static function forRegion(NotificationRegion $region): string
    {
        return $region->getValue();
    }
}
