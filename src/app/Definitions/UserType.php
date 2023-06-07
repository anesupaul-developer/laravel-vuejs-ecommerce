<?php

namespace App\Definitions;

enum UserType: string
{
    CASE SUPER_ADMIN = 'Super Administrator';

    CASE MANAGER = 'Manager';

    CASE GENERAL_USER = 'General User';

    public static function getAdminRolesOnly(): array
    {
        return [
            self::MANAGER->value, self::SUPER_ADMIN->value
        ];
    }
}
