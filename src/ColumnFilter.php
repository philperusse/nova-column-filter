<?php

namespace philperusse\Filters;

use Illuminate\Http\Request;
use Laravel\Nova\Filters\Filter;

class ColumnFilter extends Filter
{
    public $component = 'column-filter-selector';

    public function apply(Request $request, $query, $value)
    {
        $args = collect($value)->values()->filter();
        return $args->count() !== 3 ?
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
