<?php

namespace EquinoxMatt\LaravelNova\Fields\Enum;

interface EnumWithDescriptionInterface extends \BackedEnum
{
    public static function getDescription(\BackedEnum $enum): string;

    public static function getAsSelectArray(): array;
}