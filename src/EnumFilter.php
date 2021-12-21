<?php

namespace EquinoxMatt\LaravelNova\Fields\Enum;

use Illuminate\Http\Request;
use Laravel\Nova\Filters\Filter;
use Laravel\Nova\Nova;

class EnumFilter extends Filter
{
    protected $column;

    protected $class;

    protected $default;

    public function __construct($column, $class)
    {
        $this->column = $column;
        $this->class = $class;
    }

    public function name($name = null)
    {
        if (is_null($name)) {
            return $this->name ?: Nova::humanize($this->column);
        }

        $this->name = $name;

        return $this->name;
    }

    public function apply(Request $request, $query, $value)
    {
        return $query->where($this->column, $value);
    }

    public function key()
    {
        return 'enum_filter_' . $this->column;
    }

    public function options(Request $request)
    {
        return array_flip($this->class::getAsSelectArray());
    }

    public function default()
    {
        if (isset(func_get_args()[0])) {
            $this->default = is_subclass_of(func_get_args()[0], \BackedEnum::class) ? func_get_args()[0]->value : func_get_args()[0];

            return $this;
        }

        if (is_null($this->default)) {
            return parent::default();
        }

        return $this->default;
    }
}