<?php

namespace philperusse\Filters;

use Illuminate\Http\Request;
use Laravel\Nova\Filters\Filter;

class ColumnFilter extends Filter
{
    protected $component = 'column-filter';

    public function apply(Request $request, $query, $value)
    {
        $args = collect($value)->values()->filter();
        if($args->isEmpty())
            return $query;

        return $args->isEmpty() ?
            $query :
            $query->where(...$args->all());
    }

    public function options( Request $request )
    {
        return [
            'columns' => [
                //
            ],
            'operators' => [
                '=' => '&equals;',
                '>' => '&gt;',
                '>=' => '&ge;',
                '<' => '&lt;',
                '<=' => '&le;',
            ],
            'data' => '',
        ];
    }
}
