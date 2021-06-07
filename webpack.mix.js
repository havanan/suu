const mix = require('laravel-mix');

mix.js('resources/js/app.js', 'public/js')
    .vue()
    .sass('resources/sass/app.scss', 'public/css');

// mix.copyDirectory('resources/theme/admin/rocker/icons/flaticon','public/assets/admin/css');

mix.styles([
    // rocker theme
    'resources/theme/admin/rocker/assets/plugins/simplebar/css/simplebar.css',
    'resources/theme/admin/rocker/assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css',
    'resources/theme/admin/rocker/assets/plugins/metismenu/css/metisMenu.min.css',
    'resources/theme/admin/rocker/assets/css/pace.min.css',
    'resources/theme/admin/rocker/assets/css/bootstrap.min.css',
    'resources/theme/admin/rocker/assets/css/app.css',
    'resources/theme/admin/rocker/assets/css/icons.css',
    'resources/theme/admin/rocker/assets/css/dark-theme.css',
    'resources/theme/admin/rocker/assets/css/semi-dark.css',
    'resources/theme/admin/rocker/assets/css/header-colors.csss',
    'resources/theme/admin/rocker/assets/plugins/toastr/toastr.css',
], 'public/assets/admin/css/lib.css').version();

mix.scripts([
    // rocker theme
    'resources/theme/admin/rocker/assets/js/pace.min.js',
    'resources/theme/admin/rocker/assets/js/bootstrap.bundle.min.js',
    'resources/theme/admin/rocker/assets/js/jquery.min.js',
    'resources/theme/admin/rocker/assets/plugins/simplebar/js/simplebar.min.js',
    'resources/theme/admin/rocker/assets/plugins/metismenu/js/metisMenu.min.js',
    'resources/theme/admin/rocker/assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js',
    'resources/theme/admin/rocker/assets/js/app.js',
    'resources/theme/admin/rocker/assets/plugins/toastr/toastr.min.js'
    // 'resources/theme/admin/rocker/js/popper.min.js',
], 'public/assets/admin/js/lib.js').version();
