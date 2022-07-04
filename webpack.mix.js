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

mix
    .sass('node_modules/bootstrap/scss/bootstrap.scss', 'public/css/bootstrap.css')
    .css('node_modules/@fortawesome/fontawesome-free/css/all.css', 'public/css/fontawesome.css')
    .css('node_modules/overlayscrollbars/css/OverlayScrollbars.css', 'public/css/overlayScrollbars.css')
    .css('vendor/almasaeed2010/adminlte/dist/css/adminlte.css', 'public/css/adminlte.css')
    
    .scripts('node_modules/jquery/dist/jquery.js', 'public/js/jquery.js')
    .scripts('node_modules/bootstrap/dist/js/bootstrap.bundle.js', 'public/js/bootstrap.js')
    .scripts('node_modules/overlayScrollbars/js/jquery.overlayScrollbars.min.js', 'public/js/overlayScrollbars.js')
    .scripts('vendor/almasaeed2010/adminlte/dist/js/adminlte.min.js', 'public/js/adminlte.js')
    .scripts('node_modules/chart.js/dist/chart.js', 'public/js/chart.js')
    .scripts('node_modules/chartjs-plugin-datalabels/dist/chartjs-plugin-datalabels.js', 'public/js/chartjs-plugin-datalabels.js')
;
    
