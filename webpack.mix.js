let mix = require('laravel-mix')

mix.setPublicPath('dist')
   .js('resources/js/nova-filter.js', 'js')
   .sass('resources/sass/nova-filter.scss', 'css')
