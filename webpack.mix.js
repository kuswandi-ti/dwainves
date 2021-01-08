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

// mix.js('resources/js/app.js', 'public/js')
//     .sass('resources/sass/app.scss', 'public/css');

mix.styles([
	'public/plugins/datatables/datatables.min.css',
	'public/plugins/datatables/dataTables.bootstrap4.min.css',
	'public/plugins/datatables/select.bootstrap4.min.css',
	'public/plugins/datatables/responsive.bootstrap4.min.css',
	'public/plugins/select2/select2.min.css',
	'public/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css',
	'public/plugins/sweetalert/sweetalert.css',
	'public/plugins/iziToast/css/iziToast.min.css',
	'public/assets/css/style.css',
	'public/assets/css/components.css',
],'public/css/css.min.css').version();

mix.scripts([
	'public/plugins/jquery/jquery.min.js',
	'public/plugins/popper/popper.js',
	'public/plugins/tooltip/tooltip.js',
	'public/plugins/bootstrap/js/bootstrap.min.js',
	'public/plugins/nicescroll/jquery.nicescroll.min.js',
	'public/plugins/moment/moment.min.js',
	'public/plugins/accounting/accounting.min.js',
	'public/assets/js/stisla.js',
	'public/plugins/datatables/datatables.min.js',
	'public/plugins/datatables/dataTables.bootstrap4.min.js',
	'public/plugins/datatables/dataTables.select.min.js',
	'public/plugins/datatables/responsive.bootstrap4.min.js',
	'public/plugins/select2/select2.full.min.js',
	'public/plugins/loading-overlay/loadingoverlay.min.js',
	'public/plugins/sweetalert/sweetalert.min.js',
	'public/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js',
	'public/plugins/iziToast/js/iziToast.min.js',
	'public/assets/js/scripts.js',
	'public/assets/js/custom.js',
],'public/js/js.min.js').version();

mix.js([
	'public/script/data-user.js',
],'public/js/user.min.js').version();

mix.js([
	'public/script/receiving-report.js',
],'public/js/rr.min.js').version();

mix.js([
	'public/script/certificate-of-invoice-list.js',
],'public/js/coi-list.min.js').version();

mix.js([
	'public/script/certificate-of-invoice-input.js',
],'public/js/coi-input.min.js').version();
