# Column Filter for Laravel Nova

A Laravel Nova column queryer filter

### Demo


### Installation

Run this command in your Laravel Nova project:

`composer require philperusse/nova-column-filter`

### Usage

Extend your filter class with the ColumnFilter class instead of Nova's base Filter class.

```php
use \philperusse\Filters\ColumnFilter as Filter;

class ColumnFilter extends Filter
{
  public function apply( Request $request, $query, $value )
    {
        $args = collect($value)->values()->filter(); //Remove any empty keys.
        if($args->isEmpty())
            return $query;

        return $query->where(...$args->all());
    }
}
```

### Customization

You must pass an array of columns to the filter through its options.
You can also customize the operator list.

```php
use philperusse\Filters\ColumnFilter as Filter;

class ColumnFilter extends Filter
{
    public function options( Request $request ) 
    {
        return array_merge(parent::options($request), [
            'columns' => [
                'name'      => 'Name',
                'age'       => 'Age',
            ],
            'operators' => [
                '='     => '&equals;',
                '>'     => '&gt;',
                '>='    => '&ge;',
                '<'     => '&lt;',
                '<='    => '&le;',
            ]
        ]);
    }

    protected function componentName()
    {
        return 'column-filter';
    }
}
```


### Contributions

All contributions are welcomed. Please send a PR

### Authors

* Philippe Pérusse <philippe.perusse@outlook.com>

The filter is loosely-based on [64Robots's Date Filter](https://github.com/64robots/nova-date-filter) and its [custom filter selector component](https://github.com/64robots/nova-date-filter/blob/master/resources/js/components/FilterSelector.vue)

### License

This package is open-sourced software licensed under the [MIT Licence](https://github.com/philperusse/nova-column-filter/blob/master/LICENSE)
 