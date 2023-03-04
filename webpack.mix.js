const mix = require('laravel-mix');

   mix.copy('node_modules/jquery/dist/jquery.min.js', 'public/js')
   .copy('node_modules/moment/min/moment.min.js', 'public/js');

   mix.js('resources/js/app.js', 'public/js')
   .extract(['jquery'])
   .sass('resources/sass/app.scss', 'public/css');

   mix.js('resources/js/app.js', 'public/js')
   .sass('resources/sass/app.scss', 'public/css')
   .copy('node_modules/jquery-ui-dist/jquery-ui.min.js', 'public/js')
   .copy('node_modules/jquery-ui-dist/jquery-ui.min.css', 'public/css');
