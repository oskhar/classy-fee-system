const mix = require("laravel-mix");

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

mix.js("resources/js/template_admin.js", "public/js");
mix.js("resources/js/admin/Core.js", "public/js/admin");

mix.js("resources/js/admin/data_siswa.js", "public/js/admin");
mix.postCss("resources/css/admin/data_siswa.css", "public/css/admin");

// Kelola data kelas
mix.js("resources/js/admin/data_kelas.js", "public/js/admin");
mix.postCss("resources/css/admin/data_kelas.css", "public/css/admin");

mix.js("resources/js/admin/data_kelas_create.js", "public/js/admin");
mix.postCss("resources/css/admin/data_kelas_create.css", "public/css/admin");

mix.js("resources/js/admin/data_kelas_update.js", "public/js/admin");
mix.postCss("resources/css/admin/data_kelas_update.css", "public/css/admin");

mix.postCss("resources/css/template_admin.css", "public/css");
mix.copy("resources/assets/images", "public/images");
