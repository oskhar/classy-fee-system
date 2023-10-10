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

/**
 * START DASHBOARD
 */
mix.js("resources/js/admin/dashboard.js", "public/js/admin");

/**
 * START MAIN SOURCE
 */
mix.copy("resources/assets/images", "public/images");
mix.copy("resources/assets/template_excel", "public/template_excel");

mix.js("resources/js/admin/Core.js", "public/js/admin");
mix.js("resources/js/auth/Core.js", "public/js/auth");

mix.js("resources/js/template_admin.js", "public/js");
mix.postCss("resources/css/template_admin.css", "public/css");

/**
 * START PROSSES LOGIN
 */
mix.js("resources/js/auth/login_admin.js", "public/js/auth");

/**
 * START DATA SISWA
 */
mix.js("resources/js/admin/data_siswa.js", "public/js/admin");
mix.postCss("resources/css/admin/data_siswa.css", "public/css/admin");

mix.js("resources/js/admin/data_siswa_create.js", "public/js/admin");
mix.js("resources/js/admin/data_siswa_update.js", "public/js/admin");
mix.js("resources/js/admin/data_siswa_detail.js", "public/js/admin");
mix.js("resources/js/admin/data_siswa_import.js", "public/js/admin");

/**
 * START DATA SISWA PERKELAS
 */
mix.js("resources/js/admin/data_siswa_perkelas.js", "public/js/admin");

/**
 * START DATA JURUSAN
 */
mix.js("resources/js/admin/data_jurusan.js", "public/js/admin");
mix.postCss("resources/css/admin/data_jurusan.css", "public/css/admin");

mix.js("resources/js/admin/data_jurusan_create.js", "public/js/admin");
mix.postCss("resources/css/admin/data_jurusan_create.css", "public/css/admin");

mix.js("resources/js/admin/data_jurusan_update.js", "public/js/admin");
mix.postCss("resources/css/admin/data_jurusan_update.css", "public/css/admin");

/**
 * START DATA KELAS
 */
mix.js("resources/js/admin/data_kelas.js", "public/js/admin");
mix.postCss("resources/css/admin/data_kelas.css", "public/css/admin");

mix.js("resources/js/admin/data_kelas_create.js", "public/js/admin");
mix.postCss("resources/css/admin/data_kelas_create.css", "public/css/admin");

mix.js("resources/js/admin/data_kelas_update.js", "public/js/admin");
mix.postCss("resources/css/admin/data_kelas_update.css", "public/css/admin");

/**
 * START DATA TAHUN AJAR
 */
mix.js("resources/js/admin/data_tahun_ajar.js", "public/js/admin");
mix.postCss("resources/css/admin/data_tahun_ajar.css", "public/css/admin");
mix.js("resources/js/admin/data_tahun_ajar_create.js", "public/js/admin");
mix.postCss(
    "resources/css/admin/data_tahun_ajar_create.css",
    "public/css/admin"
);
mix.js("resources/js/admin/data_tahun_ajar_update.js", "public/js/admin");

/**
 * START DATA REKENING
 */
mix.js("resources/js/admin/rekening.js", "public/js/admin");
mix.postCss("resources/css/admin/rekening.css", "public/css/admin");

mix.js("resources/js/admin/buku_tabungan.js", "public/js/admin");
mix.js("resources/js/admin/buku_tabungan_create.js", "public/js/admin");

/**
 * START CETAK DATA LAPORAN KESELURURHAN
 */
mix.js("resources/js/admin/cetak/laporan_siswa.js", "public/js/admin/cetak");
