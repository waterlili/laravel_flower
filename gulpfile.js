var elixir = require('laravel-elixir');
process.env.NODE_ENV = 'production';
/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */
elixir.config.publicPath = 'public_html';

elixir(function (mix) {
    mix.sass(['admin.scss']);
    mix.sass(['auth.scss'], 'public_html/css/auth.css');
    mix.sass(['public.scss'], 'public_html/css/public.css');
    mix.sass(['print.scss'], 'public_html/css/print.css');

    mix.scripts(
        [
            'Tranc.js',
            'App.js',
            'Http.js',
            'NGAc.js',
            'NGChip.js',
            'Notify.js',
            'File.js',
            'Preloader.js',
            'Route.js',
            'AdminCtrl.js',
            'AuthCtrl.js',
            'NGTable.js',
            'Ctrl/**/*.js',
            'Directive/**/*.js'
        ]);


    mix.scripts(
        [
            'AppPublic.js',
            'Http.js',
            'Notify.js',
            'Preloader.js',
            'PublicCtrl.js'
        ], 'public_html/js/public.js');

    mix.version(['css/admin.css']);
    //mix.browserSync();
});
