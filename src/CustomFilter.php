<?php

namespace philperusse\Filters;

use Illuminate\Container\Container;
use Illuminate\Http\Request;
use Laravel\Nova\Filters\Filter;

abstract class CustomFilter extends Filter
{
    /**
     * Prepare the filter for JSON serialization.
     *
     * @return array
     */
    public function jsonSerialize()
    {
        $container = Container::getInstance();

        return [
            'class' => get_class($this),
            'name' => $this->name(),
            'options' => collect($this->options($container->make(Request::class)))->all(),
            'currentValue' => '',
            'customComponent' => true,
            'component'       => $this->componentName(),
        ];
    }
    /**
     * The name of the Vue component to be used for this filter
     *
     * @return string
     */
    protected abstract function componentName();
}