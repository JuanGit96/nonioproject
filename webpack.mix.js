let mix = require('laravel-mix');

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

mix.scripts([
    'resources/assets/js/jquery-3.3.1.js',
    'resources/assets/js/datatables.min.js',
    'resources/assets/js/dataTables.bootstrap4.min.js',
    'resources/assets/js/jquery.dataTables.min.js',
    'resources/assets/js/jquery.priceformat.min.js',
    'resources/assets/js/slick.min.js',
    'resources/assets/js/popper.js',
    'resources/assets/js/bootstrap-datepicker.js',
    'resources/assets/js/bootstrap.js',
    'resources/assets/js/toastr.js',
    'resources/assets/js/sweetalert.min.js',
    'resources/assets/js/vue.js',
    'resources/assets/js/axios.js',
    'resources/assets/js/app.js'
], 'public/js/app.js')
.styles([
    'resources/assets/css/slick.css',
    'resources/assets/css/slick-theme.css',
    'resources/assets/css/toastr.css',
    'resources/assets/css/bootstrap-datepicker.css',
    'resources/assets/css/bootstrap.css',
    'resources/assets/css/datatables.min.css',
    'resources/assets/css/jquery.dataTables.min.css',
    'resources/assets/css/dataTables.bootstrap4.min.css',
    'resources/assets/css/sweetalert.css',
    
    ], 'public/css/app.css');