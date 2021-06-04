const mix = require('laravel-mix');

mix.js('resources/js/app.js', 'public/js')
    .vue()
    .sass('resources/sass/app.scss', 'public/css');

mix.copyDirectory('resources/theme/admin/vora/icons/flaticon','public/assets/admin/css');

mix.styles([
    // vora theme
    'resources/theme/admin/vora/vendor/vendor/chartist/css/chartist.min.css',
    'resources/theme/admin/vora/vendor/chartist/css/chartist.min.css',
    'resources/theme/admin/vora/vendor/bootstrap-select/dist/css/bootstrap-select.min.css',
    'resources/theme/admin/vora/css/style.css',
    'resources/theme/admin/vora/vendor/owl-carousel/owl.carousel.css',
    'resources/theme/admin/vora/icons/flaticon/flaticon.css',
], 'public/assets/admin/css/lib.css').version();

mix.scripts([
    // vora theme
    'resources/theme/admin/vora/vendor/global/global.min.js',
    'resources/theme/admin/vora/vendor/bootstrap-select/dist/js/bootstrap-select.min.js',
    'resources/theme/admin/vora/js/custom.min.js',
    'resources/theme/admin/vora/js/dlabnav-init.js',
    'resources/theme/admin/vora/vendor/owl-carousel/owl.carousel.js',
    'resources/theme/admin/vora/vendor/peity/jquery.peity.min.js',
], 'public/assets/admin/js/lib.js').version();
