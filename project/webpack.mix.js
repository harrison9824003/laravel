const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/js/app.js', 'public/js');
// mix.css('node_modules/filepond/dist/filepond.min.css', 'public/admin/assets/css/filepond.min.css');
mix.js('resources/js/filepond.js', 'public/admin/assets/js/filepond.js');
mix.copyDirectory('resources/admin', 'public/admin').version();
