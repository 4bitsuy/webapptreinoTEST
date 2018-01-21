let mix = require('laravel-mix');

mix.js('resource/assests/js/app.js', 'public/js/')
   .sass('resource/assests/sass/app.scss', 'public/css/');
