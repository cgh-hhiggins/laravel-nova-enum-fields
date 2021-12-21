<?php

namespace EquinoxMatt\LaravelNova\Fields\Enum;

use Laravel\Nova\Fields\Field;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Http\Requests\NovaRequest;

class Enum extends Select
{
    public function __construct($name, $attribute = null, $resolveCallback = null)
    {
        parent::__construct($name, $attribute, $resolveCallback);

        $this->resolveUsing(
            function ($value) {
                return $value instanceof \BackedEnum ? $value->value : $value;
            }
        );

        $this->displayUsing(
            function ($value) {
                return $value instanceof EnumWithDescriptionInterface ? $value->getDescription($value) : $value;
            }
        );

        $this->fillUsing(
            function (NovaRequest $request, $model, $attribute, $requestAttribute) {
                if ($request->exists($requestAttribute)) {
                    $model->{$attribute} = $request[$requestAttribute];
                }
            }
        );
    }

    public function attach(string $class): Field
    {
        return $this->options($class::getAsSelectArray())
            ->rules($this->nullable ? 'nullable' : 'required');
    }

    public function nullable($nullable = true, $values = null)
    {
        $this->rules = str_replace('required', 'nullable', $this->rules);

        return parent::nullable($nullable, $values);
    }
}
