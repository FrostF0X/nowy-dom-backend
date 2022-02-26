<?php

namespace App\User;

use App\Notification\NotificationRegion;

class Role
{
    public const ROLE_SUPER_ADMIN = 'ROLE_SUPER_ADMIN';
    public const ROLE_ADMIN = 'ROLE_ADMIN';

    public static function allRegion(): array
    {
        return array_map(fn(string $i) => 'ROLE_' . $i, array_flip(NotificationRegion::MAP));
    }

}
