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
/*
mix.js('resources/js/app.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css');

    */

    
mix.styles([
        'resources/assets/css/font-awesome.min.css',
        'resources/assets/css/simple-line-icons.min.css',
        'resources/assets/css/style.css',
        'resources/assets/css/dataTables.bootstrap4.min.css',
], 'public/css/all.css');



mix.scripts([
    
    'resources/assets/js/jquery.min.js',
    'resources/assets/js/popper.min.js',
    'resources/assets/js/bootstrap.min.js',
    'resources/assets/js/Chart.min.js',
    'resources/assets/js/template.js',
    'resources/assets/js/pace.min.js',
    'resources/assets/js/sweetalert.js',
    'resources/assets/js/jquery.dataTables.min.js',
    'resources/assets/js/dataTables.bootstrap4.min.js',
    
], 'public/js/all.js')
.js(['resources/js/app.js'],'public/js/app.js');

