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

    // ------------ parte pública ------------
mix.js('resources/js/app.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css')
    .copyDirectory('resources/js/libs', 'public/js')
    // ------------ parte privada ------------
    .js('resources/js/app_admin.js', 'public/admin/js')
    .sass('resources/sass/app_admin.scss', 'public/admin/css');
