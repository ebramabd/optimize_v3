<?php

namespace App\Enums;

class UserType
{
    const Admin = 0;
    const Client = 1;
    const Branch_Administrator = 2;

    public static function values()
    {
        return [
            self::Admin,//admin panel
            self::Client,
            self::Branch_Administrator,
        ];
    }

    public static function get_type_user()
    {
        return [
            self::Admin =>'Admin',
            self::Client =>'Client',
            self::Branch_Administrator =>'Branch_Administrator',
        ];
    }

    public static function getSpecificStatus($status)
    {
        $roles = self::get_type_user();
        return isset($roles[$status]) ? $roles[$status] : null;
    }
}
