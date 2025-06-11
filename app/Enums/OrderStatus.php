<?php

namespace App\Enums;

class OrderStatus
{
    const Under_processing = 0;
    const Waiting_For_Delivery = 1;
    const Completed = 2;

    public static function values()
    {
        return [
            self::Under_processing,
            self::Waiting_For_Delivery,
            self::Completed,
        ];
    }

    public static function get_type_user()
    {
        return [
            self::Under_processing  => 'Under_processing',
            self::Waiting_For_Delivery =>'Waiting_For_Delivery',
            self::Completed =>'Completed',
        ];
    }

    public static function getSpecificStatus($status)
    {
        $roles = self::get_type_user();
        return isset($roles[$status]) ? $roles[$status] : null;
    }
}
