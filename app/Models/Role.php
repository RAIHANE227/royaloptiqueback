<?php

namespace App\Models;

final class Role
{
    public const USER = 'user';
    public const ADMIN = 'admin';

    public static function allRoles(): array
    {
        return [self::USER, self::ADMIN];
    }
}
