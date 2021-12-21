<?php

namespace EquinoxMatt\LaravelNova\Fields\Enum\Tests\Enums;

use EquinoxMatt\LaravelNova\EnumDescriptionTrait;
use EquinoxMatt\LaravelNova\Fields\Enum\EnumWithDescriptionInterface;

enum StatusType: int implements EnumWithDescriptionInterface
{
    use \EquinoxMatt\LaravelNova\Fields\Enum\EnumDescriptionTrait;

    case Inactive = 0;
    case Active = 1;
    case Suspended = 2;

    public static function getDescription(\BackedEnum $value): string
    {
        if ($value === self::Inactive) {
            return 'Inactive';
        }

        if ($value === self::Active) {
            return 'Active';
        }

        if ($value === self::Suspended) {
            return 'Suspended';
        }

        return '';
    }
}