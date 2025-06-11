<?php

namespace App\Enums;

use App\Traits\BaseEnumTrait;

enum OtpStatus: int
{
    use BaseEnumTrait;

    case Active = 1;
    case Pending = 2;

    /** we use it for Api response */
    public static function toArrayCases(array $cases): array
    {
        // Map the enum cases by value, using the value as the key
        $cases = array_reduce($cases, function ($prev, $status) {
            $prev[$status->value] = $status->toArray();
            return $prev;
        }, []);

        return $cases;
    }

    protected function toArray(): array
    {
        return [
            'name' => $this->name,  // Refers to the enum case name
            'proberty_name' => $this->probertyName(),  // Refers to the enum case proberty name
            'value' => $this->value,  // Refers to the enum case value
        ];
    }



}
