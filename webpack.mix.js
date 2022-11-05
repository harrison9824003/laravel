const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/js/filepond.js', 'public/admin/assets/js/filepond.js')
.js('resources/js/app.js', 'public/js').vue()
.copyDirectory('resources/admin', 'public/admin')
.copyDirectory('resources/front/assets', 'public/front/assets').version();

// mix.sass('resources/sass/app.scss', 'public/css').version();
