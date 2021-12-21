<?php

namespace EquinoxMatt\LaravelNova\Fields\Enum;

trait EnumDescriptionTrait
{
    public static function getAsSelectArray(): array
    {
        $cases = self::cases();
        $selectArray = [];

        foreach ($cases as $key => $enum) {
            $selectArray[$enum->value] = self::getDescription($enum);
        }

        return $selectArray;
    }
}