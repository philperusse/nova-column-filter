<?php

namespace philperusse\ColumnFilter;


use Illuminate\Container\Container;
use Illuminate\Http\Request;

abstract class ColumnFilter extends CustomFilter
{
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

    /**
     * The name of the Vue component to be used for this filter
     *
     * @return string
     */
    protected function componentName()
    {
        return 'column-filter';
    }
}
