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

mix.js([
        'resources/js/app.js'
        ],'public/js/app.js'
    )
    .js([
        'resources/js/operacion/menu.js',
        'resources/js/operacion/mesas.js',
        'resources/js/operacion/meseros.js',
        'resources/js/operacion/alimentos.js',
        'resources/js/operacion/cuentas.js',
        'resources/js/operacion/bebidas.js'
    ], 'public/js/operacion.js'
    )
    .sass('resources/sass/app.scss', 'public/css')
    .sourceMaps();
