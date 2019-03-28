# Column Filter for Laravel Nova

A Laravel Nova column querier filter for Nova > v1.1.8

*Prior to Nova v.1.3.2, use the [0.2.1 version](https://github.com/philperusse/nova-column-filter/tree/v0.2.1).*

*Prior to Nova v.1.1.8, use the [0.1.1 version](https://github.com/philperusse/nova-column-filter/tree/0.1.1).*

### Demo

![Demo](http://g.recordit.co/lzkVNWA5De.gif)

### Installation

Run this command in your Laravel Nova project:

`composer require philperusse/nova-column-filter`

### Usage

Create a filter with `artisan`

```shell 
 $ php artisan nova:filter UserColumnFilter 
 ```
Extend your filter class with the ColumnFilter class instead of Nova's base Filter class and add the columns on which you want to filter on in the options

```php
use \philperusse\Filters\ColumnFilter as Filter;

class ColumnFilter extends Filter
{
  
   /**
    * Apply the filter to the given query.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  \Illuminate\Database\Eloquent\Builder  $query
    * @param  mixed  $value
    * @return \Illuminate\Database\Eloquent\Builder
   */	 
  public function apply( Request $request, $query, $value )
  {
     $args = collect($value)->values()->filter(); //Remove any empty keys.
     if($args->isEmpty())
          return $query;
		  
      return $query->where(...$args->all());
  }
  
  /**
   * Get the filter's available options.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return array
   */
  public function options( Request $request ) : array
    {
        return array_merge(parent::options($request), [
            'columns' => [
                'name'      => 'Name',
                'age'       => 'Age',
            ]
        ]);
    }
}
```

### Customization

You can customize the operator list by overriding the `operators` key in the filters options.

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

Also you can have users write the column names by settings `columns` to `false` and setting a custom `apply` function. This is useful when searching JSON data.

```php
use philperusse\Filters\ColumnFilter as Filter;

class ColumnFilter extends Filter
{
    public function apply( Request $request, $query, $value )
    {
        $args = collect($value)->values()->filter();

        // Only filter if all conditions are provided
        if ($args->count() !== 3) {
            return $query;
        }

        $query->where(function (\Illuminate\Database\Eloquent\Builder $query) use ($args) {
            $query->where("metadata->{$args[0]}", $args[1], $args[2]);
        });

        return $query;
    }

    public function options( Request $request ) 
    {
        return array_merge(parent::options($request), [
            'columns' => false,
            'operators' => [
                '='     => 'is',
                '!='    => 'is not',
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
 
