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

    public static function getDescription(\BackedEnum $enum): string
    {
        if (ctype_upper(preg_replace('/[^a-zA-Z]/', '', $enum->name))) {
            $key = strtolower($enum->name);
        }

        return ucfirst(str_replace('_', ' ', self::snakeCase($enum->name)));
    }

    /**
     * Convert a string to snake case.
     *
     * @param  string  $value
     * @param  string  $delimiter
     * @return string
     */
    public static function snakeCase(string $value, string $delimiter = '_'): string
    {
        $key = $value;

        if (!ctype_lower($value)) {
            $value = preg_replace('/\s+/u', '', ucwords($value));
            $value = strtolower((preg_replace('/(.)(?=[A-Z])/u', '$1'.$delimiter, $value)));
        }

        return $value;
    }

}