<?php

namespace App\Enums;

class SubscriptionStatus
{
    const Pending = 0;
    const Active = 1;
    const Expired = 2;
    public static function values()
    {
        return [
            self::Pending,
            self::Active,
            self::Expired,
        ];
    }

    public static function get_type_user()
    {
        return [
            self::Pending =>'Pending',
            self::Active =>'Active',
            self::Expired =>'Expired',
        ];
    }

    public static function getSpecificStatus($status)
    {
        $roles = self::get_type_user();
        return isset($roles[$status]) ? $roles[$status] : null;
    }
}
