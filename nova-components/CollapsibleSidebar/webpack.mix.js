let mix = require('laravel-mix')

mix
  .setPublicPath('dist')
  .js('resources/js/collapsible-sidebar.js', 'js')
  .sass('resources/sass/collapsible-sidebar.scss', 'css')
