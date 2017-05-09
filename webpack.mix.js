const { mix } = require('laravel-mix');

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

mix.js('admin/js/src/app.js', 'admin/js/dist/trail-manager-admin.js')
	.js('public/js/src/app.js', 'public/js/dist/trail-manager-public.js')
	.sass('admin/sass/app.scss', 'admin/css/trail-manager-admin.css')
	.sass('public/sass/app.scss', 'public/css/trail-manager-public.css');