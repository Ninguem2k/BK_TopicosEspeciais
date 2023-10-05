<?php

namespace App\Enums;

class ServiceOrderOptions
{
    const RECENT_DATE = 'recentDate';
    const OLD_DATE = 'oldDate';
    const LOWER_PRICE = 'lowerPrice';
    const HIGHER_PRICE = 'higherPrice';

    public static function getFindOptions($option)
    {
        switch ($option) {
            case self::RECENT_DATE:
                return ['created_at' => 'DESC'];
            case self::OLD_DATE:
                return ['created_at' => 'ASC'];
            case self::LOWER_PRICE:
                return ['price' => 'ASC'];
            case self::HIGHER_PRICE:
                return ['price' => 'DESC'];
            default:
                return null;
        }
    }
}
