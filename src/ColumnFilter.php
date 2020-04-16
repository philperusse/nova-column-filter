<?php

namespace philperusse\Filters;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Laravel\Nova\Filters\Filter;

class ColumnFilter extends Filter
{
    public $component = 'column-filter-selector';

    public function apply(Request $request, $query, $value)
    {
        $args = collect($value)->values()->filter();

        if ($args->count() !== 3) {
            return $query;
        }

        $transformName = 'transform' . Str::studly($args[0]) . 'Value';
        if (method_exists($this, $transformName)) {
            $args[2] = $this->{$transformName}($args[2]);
        }

        return $query->where(...$args->all());
    }

    public function columns()
    {
        return [
            //bud l
        ];
    }

    public function operators()
    {
        return [
            '=' => '&equals;',
            '>' => '&gt;',
            '>=' => '&ge;',
            '<' => '&lt;',
            '<=' => '&le;',
        ];
    }

    public function options( Request $request )
    {
        return [
            'columns' => $this->columns(),
            'operators' => $this->operators(),
            'data' => '',
        ];
    }
}
