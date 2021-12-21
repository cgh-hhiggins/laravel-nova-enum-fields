<?php

namespace EquinoxMatt\LaravelNova\Fields\Enum\Tests\Enums;

use EquinoxMatt\LaravelNova\Fields\Enum\EnumDescriptionTrait;
use EquinoxMatt\LaravelNova\Fields\Enum\EnumWithDescriptionInterface;

enum AccountType: int implements EnumWithDescriptionInterface {
    use EnumDescriptionTrait;

    case FREE = 0;
    case STANDARD = 1;
    case PREMIUM = 2;

    public static function getDescription(\BackedEnum $value): string
    {
        if ($value === self::FREE) {
            return 'Free Tier';
        }

        if ($value === self::STANDARD) {
            return 'Standard Tier';
        }

        if ($value === self::PREMIUM) {
            return 'Premium Tier';
        }

        return '';
    }
}