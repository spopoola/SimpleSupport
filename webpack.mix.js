let mix = require('laravel-mix');


/**
 * Styles
 */
// Styles
//-------------------------------------------------------
mix.sass('resources/assets/sass/site.scss', 'public/css')
    .sass('resources/assets/sass/app.scss', 'public/css')
    .copy('resources/assets/images', 'public/images');

/**
 * Javascripts
 */
mix.js('resources/assets/js/app.js', 'public/js')
   .version();
