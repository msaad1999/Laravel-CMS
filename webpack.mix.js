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
        'resources/assets/theme_sb-admin-2/css/sb-admin-2.min.css',
        'resources/assets/theme_sb-admin-2/vendor/fontawesome/css/all.min.css',
        'resources/assets/theme_sb-admin-2/vendor/datatables/datatables.bootstrap4.min.css',
    ], 'public/css/libs.css')
    .scripts([
        'resources/assets/theme_sb-admin-2/vendor/jquery/jquery.min.js',
        'resources/assets/theme_sb-admin-2/vendor/bootstrap/js/bootstrap.bundle.min.js',
        'resources/assets/theme_sb-admin-2/vendor/jquery-easing/jquery.easing.min.js',
        'resources/assets/theme_sb-admin-2/vendor/fontawesome/js/all.min.js',
        'resources/assets/theme_sb-admin-2/js/sb-admin-2.min.js',
        'resources/assets/theme_sb-admin-2/vendor/chart.js/Chart.min.js',
        'resources/assets/theme_sb-admin-2/vendor/datatables/jquery.datatables.min.js',
        'resources/assets/theme_sb-admin-2/vendor/datatables/datatables.bootstrap4.min.js',
    ], 'public/js/libs.js')
    .scripts('resources/assets/theme_sb-admin-2/js/demo/chart-area-demo.js', 'public/js/components/chart-area.js')
    .scripts('resources/assets/theme_sb-admin-2/js/demo/chart-pie-demo.js', 'public/js/components/chart-pie.js')
    .scripts('resources/assets/theme_sb-admin-2/js/demo/chart-bar-demo.js', 'public/js/components/chart-bar.js')
    .scripts('resources/assets/theme_sb-admin-2/js/demo/datatables-demo.js', 'public/js/components/datatables.js');