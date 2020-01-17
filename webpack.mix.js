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

mix.js('resources/js/app.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css')
    .styles([
        'resources/theme_sb-admin-2/css/sb-admin-2.min.css',
        'resources/theme_sb-admin-2/vendor/fontawesome-free/css/all.min.css',
    ], 'public/css/libs.css')
    .scripts([
        'resources/theme_sb-admin-2/vendor/jquery/jquery.min.js',
        'resources/theme_sb-admin-2/vendor/bootstrap/js/bootstrap.bundle.min.js',
        'resources/theme_sb-admin-2/vendor/jquery-easing/jquery.easing.min.js',
        'resources/theme_sb-admin-2/js/sb-admin-2.min.js',
        'resources/theme_sb-admin-2/vendor/chart.js/Chart.min.js',
        'resources/theme_sb-admin-2/js/demo/chart-area-demo.js',
        'resources/theme_sb-admin-2/js/demo/chart-pie-demo.js',
    ], 'public/js/libs.js');