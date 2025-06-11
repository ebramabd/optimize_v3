<?php

namespace App\Enums;

class CompanyStatus
{
    const Active = 0;
    const Expired = 1;
    const Pending = 2;

    public static function values()
    {
        return [
            self::Active,
            self::Expired,
            self::Pending,
        ];
    }

    public static function get_type_user()
    {
        return [
            self::Active  => 'Active',
            self::Expired =>'Expired',
            self::Pending =>'Pending',
        ];
    }

    public static function getSpecificStatus($status)
    {
        $roles = self::get_type_user();
        return isset($roles[$status]) ? $roles[$status] : null;
    }
}
