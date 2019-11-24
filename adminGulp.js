/*
|--------------------------------------------------------------------------
| Elixir Asset Management
|--------------------------------------------------------------------------
|
|  The file takes all Metronic js and css files and puts it into the public folder
|
|
*/

var gulp          = require('gulp');
var elixir        = require('laravel-elixir');
var rename        = require('gulp-rename');
var merge2        = require('merge2');
var browserSync   = require('browser-sync').create();
var path          = require('path');

// css
var sass          = require('gulp-sass');
var sassGlob      = require('gulp-sass-glob');
var cssimport     = require("gulp-cssimport");
var cleanCss      = require('gulp-clean-css');
var autoprefixer  = require('gulp-autoprefixer');

// js
var jshint        = require('gulp-jshint');
var uglify        = require('gulp-uglify');
var plumber       = require('gulp-plumber');
var sourcemaps    = require('gulp-sourcemaps');

var bowerDir = '../admin/bower_components/';
/**
 * ----------------------
 *      Assets
 * ----------------------
 **/
// Path for the resources assets
var adminResourcesPath = '../admin/';
var adminPublicPath = 'public/assets/admin/';


elixir(function(mix) {

    mix
    /**
     *  Admin
     **/

    /**
     *  Compiling LTR CSS
     **/
        .sass(
            adminResourcesPath + 'sass/main_ltr.scss'
            , adminPublicPath + 'css/app.css')

        /**
         *  Compiling RTL CSS
         **/
        .sass(
            adminResourcesPath + 'sass/main_rtl.scss'
            , adminPublicPath + 'css/app-rtl.css')

        /**
         * Styles
         */

        .styles([
            // THEME LAYOUT STYLES
            adminResourcesPath + 'metronic/global/plugins/bootstrap/css/bootstrap.css',
            adminResourcesPath + 'metronic/layouts/vendors/base/vendors.bundle.rtl.css',
            adminResourcesPath + 'metronic/layouts/default/base/style.bundle.rtl.css',
            adminResourcesPath + 'metronic/layouts/vendors/custom/fullcalendar/fullcalendar.bundle.rtl.css',

            <!-- BEGIN THEME GLOBAL STYLES -->
            // adminResourcesPath + 'metronic/global/css/components-rtl.css',
            adminResourcesPath + 'metronic/global/css/components-rounded-rtl.css',
            // adminResourcesPath + 'metronic/global/css/plugins-rtl.css',
            // adminResourcesPath + 'metronic/global/plugins/vendors/fontawesome5/css/fontawesome.css',

            // PLUGINS
            bowerDir + 'tinymce/skins/lightgray/skin.min.css',
            adminResourcesPath + 'metronic/global/plugins/toastr/toastr.min.rtl.css',
            adminResourcesPath + 'metronic/layouts/vendors/custom/jquery-ui-1.12.1.custom/jquery-ui.css',
            adminResourcesPath + 'metronic/layouts/vendors/custom/jqvmap/jqvmap.bundle.rtl.css',

            //DataTable
            adminResourcesPath + 'metronic/layouts/vendors/custom/datatables/datatables.bundle.rtl.css',

            //Bootstrap
            adminResourcesPath + 'metronic/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css',
            adminResourcesPath + 'metronic/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css',
            adminResourcesPath + 'metronic/global/plugins/bootstrap-switch/css/bootstrap3/bootstrap-switch.css',
            adminResourcesPath + 'metronic/global/plugins/bootstrap-modal/css/bootstrap-modal.css',

            <!-- BEGIN PAGE LEVEL PLUGINS -->
            adminResourcesPath + 'metronic/global/plugins/bootstrap-daterangepicker/daterangepicker.css',
            adminResourcesPath + 'metronic/global/plugins/morris.js/morris.min.rtl.css',
            adminResourcesPath + 'metronic/global/plugins/jquery-file-upload/blueimp-gallery/blueimp-gallery.min.css',
            adminResourcesPath + 'metronic/global/plugins/jquery-file-upload/css/jquery.fileupload.css',
            adminResourcesPath + 'metronic/global/plugins/jquery-file-upload/css/jquery.fileupload-ui.css',

            adminResourcesPath + 'metronic/layouts/vendors/custom/multi-select/css/multi-select.css',


            <!-- BEGIN THEME LAYOUT STYLES -->

        ], adminPublicPath + 'metronic/css/all-rtl.css')

        .styles([
            // THEME LAYOUT STYLES
            adminResourcesPath + 'metronic/global/plugins/bootstrap/css/bootstrap.css',
            adminResourcesPath + 'metronic/layouts/vendors/base/vendors.bundle.css',
            adminResourcesPath + 'metronic/layouts/default/base/style.bundle.css',
            adminResourcesPath + 'metronic/layouts/vendors/custom/fullcalendar/fullcalendar.bundle.css',

            <!-- BEGIN THEME GLOBAL STYLES -->
            // adminResourcesPath + 'metronic/global/css/components.css',
            adminResourcesPath + 'metronic/global/css/components-rounded.css',
            // adminResourcesPath + 'metronic/global/css/plugins.css',
            // adminResourcesPath + 'metronic/global/plugins/vendors/fontawesome5/css/fontawesome.css',

            // PLUGINS
            bowerDir + 'tinymce/skins/lightgray/skin.min.css',
            adminResourcesPath + 'metronic/global/plugins/toastr/toastr.css',
            adminResourcesPath + 'metronic/layouts/vendors/custom/jquery-ui-1.12.1.custom/jquery-ui.css',
            adminResourcesPath + 'metronic/layouts/vendors/custom/jqvmap/jqvmap.bundle.css',

            //DataTable
            adminResourcesPath + 'metronic/layouts/vendors/custom/datatables/datatables.bundle.css',

            //Bootstrap
            adminResourcesPath + 'metronic/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css',
            adminResourcesPath + 'metronic/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css',
            adminResourcesPath + 'metronic/global/plugins/bootstrap-switch/css/bootstrap3/bootstrap-switch.css',
            adminResourcesPath + 'metronic/global/plugins/bootstrap-modal/css/bootstrap-modal.css',

            <!-- BEGIN PAGE LEVEL PLUGINS -->
            adminResourcesPath + 'metronic/global/plugins/bootstrap-daterangepicker/daterangepicker.css',
            adminResourcesPath + 'metronic/global/plugins/morris.js/morris.css',
            adminResourcesPath + 'metronic/global/plugins/jquery-file-upload/blueimp-gallery/blueimp-gallery.min.css',
            adminResourcesPath + 'metronic/global/plugins/jquery-file-upload/css/jquery.fileupload.css',
            adminResourcesPath + 'metronic/global/plugins/jquery-file-upload/css/jquery.fileupload-ui.css',

            adminResourcesPath + 'metronic/layouts/vendors/custom/multi-select/css/multi-select.css',


            <!-- BEGIN THEME LAYOUT STYLES -->


        ], adminPublicPath + 'metronic/css/all.css')

        .styles([ // plugin files - upload page
        ], adminPublicPath + 'metronic/css/uploader.css')

        /**
         * Scripts
         */
        .scripts([
            // CORE PLUGINS
            // adminResourcesPath + 'metronic/global/plugins/jquery-3.2.1/jquery-3.2.1.min.js',

            adminResourcesPath + 'metronic/layouts/vendors/base/vendors.bundle.js',
            adminResourcesPath + 'metronic/layouts/default/base/scripts.bundle.js',
            adminResourcesPath + 'metronic/layouts/vendors/custom/jquery-ui-1.12.1.custom/jquery-ui.js',
            adminResourcesPath + 'metronic/layouts/default/custom/components/portlets/draggable.js',
            adminResourcesPath + 'metronic/layouts/default/custom/crud/forms/widgets/bootstrap-datepicker.js',
            // adminResourcesPath +  'metronic/layouts/default/custom/crud/datatables/basic/scrollable.js',


            adminResourcesPath + 'metronic/layouts/vendors/custom/multi-select/js/jquery.multi-select.js',
            adminResourcesPath + 'metronic/layouts/default/assets/app/js/dashboard.js',
            adminResourcesPath + 'metronic/layouts/vendors/custom/fullcalendar/fullcalendar.bundle.js',
            adminResourcesPath + 'metronic/layouts/default/custom/crud/forms/widgets/bootstrap-select.js',
            adminResourcesPath + 'metronic/layouts/default/custom/crud/forms/widgets/autosize.js',
            adminResourcesPath + 'metronic/global/plugins/bootstrap-switch/js/bootstrap-switch.js',
            // adminResourcesPath + 'metronic/global/plugins/bootstrap-modal/js/bootstrap-modal.js',
            adminResourcesPath + 'metronic/global/plugins/bootstrap-modal/js/bootstrap-modalmanager.js',
            adminResourcesPath + 'metronic/global/plugins/jquery-file-upload/js/vendor/jquery.ui.widget.js',
            adminResourcesPath + 'metronic/global/plugins/jquery-file-upload/js/vendor/load-image.min.js',
            adminResourcesPath + 'metronic/global/plugins/jquery-file-upload/js/vendor/canvas-to-blob.min.js',
            adminResourcesPath + 'metronic/global/plugins/jquery-file-upload/blueimp-gallery/jquery.blueimp-gallery.min.js',
            adminResourcesPath + 'metronic/global/plugins/jquery-file-upload/js/jquery.iframe-transport.js',
            adminResourcesPath + 'metronic/global/plugins/jquery-file-upload/js/jquery.fileupload.js',
            adminResourcesPath + 'metronic/global/plugins/jquery-file-upload/js/jquery.fileupload-process.js',
            adminResourcesPath + 'metronic/global/plugins/jquery-file-upload/js/jquery.fileupload-image.js',
            adminResourcesPath + 'metronic/global/plugins/jquery-file-upload/js/jquery.fileupload-audio.js',
            adminResourcesPath + 'metronic/global/plugins/jquery-file-upload/js/jquery.fileupload-video.js',
            adminResourcesPath + 'metronic/global/plugins/jquery-file-upload/js/jquery.fileupload-validate.js',
            adminResourcesPath + 'metronic/global/plugins/jquery-file-upload/js/jquery.fileupload-ui.js',



            // Plugins
            bowerDir + 'tinymce/tinymce.js',
            bowerDir + 'tinymce/themes/modern/theme.js',
            bowerDir + 'tinymce/plugins/advlist/plugin.js',
            bowerDir + 'tinymce/plugins/autolink/plugin.js',
            bowerDir + 'tinymce/plugins/link/plugin.js',
            bowerDir + 'tinymce/plugins/image/plugin.js',
            bowerDir + 'tinymce/plugins/lists/plugin.js',
            bowerDir + 'tinymce/plugins/charmap/plugin.js',
            bowerDir + 'tinymce/plugins/print/plugin.js',
            bowerDir + 'tinymce/plugins/preview/plugin.js',
            bowerDir + 'tinymce/plugins/textcolor/plugin.js',
            bowerDir + 'tinymce/plugins/table/plugin.js',
            bowerDir + 'tinymce/plugins/code/plugin.js',
            bowerDir + 'jquery-jsform/js/jquery.jsForm.js',


            // THEME GLOBAL SCRIPTS
            adminResourcesPath + 'metronic/global/scripts/app.js',

            //Header
            adminResourcesPath + 'metronic/layouts/default/custom/header/actions.js',

            //Flot
            adminResourcesPath + 'metronic/layouts/vendors/custom/flot/flot.bundle.js',

            //gmaps
            adminResourcesPath + 'metronic/layouts/vendors/custom/gmaps/gmaps.js',

            //jqvmap
            adminResourcesPath + 'metronic/layouts/vendors/custom/jqvmap/jqvmap.bundle.js',

            //Toastr
            adminResourcesPath + 'metronic/global/plugins/toastr/toastr.min.js',


            // Popup window
            adminResourcesPath + 'metronic/layouts/vendors/custom/datatables/datatables.bundle.js',

            '**/*.js'
        ], adminPublicPath + 'metronic/js/all.js')
        .scripts([ // Custom js files
            adminResourcesPath + 'js/**/*.js',
        ], adminPublicPath + 'metronic/js/custom.js')
        .scripts([ // plugin files - upload page
            adminResourcesPath + 'metronic/global/plugins/fancybox/source/jquery.fancybox.pack.js',
            adminResourcesPath + 'metronic/global/plugins/jquery-file-upload/js/vendor/tmpl.min.js',
            adminResourcesPath + 'metronic/global/plugins/jquery-file-upload/js/jquery.fileupload.js',
            adminResourcesPath + 'metronic/global/plugins/jquery-file-upload/js/jquery.fileupload-ui.js',
            adminResourcesPath + 'metronic/global/plugins/jquery-file-upload/js/vendor/load-image.min.js',
            adminResourcesPath + 'metronic/global/plugins/jquery-file-upload/js/jquery.iframe-transport.js',
            adminResourcesPath + 'metronic/global/plugins/jquery-file-upload/js/vendor/jquery.ui.widget.js',
            adminResourcesPath + 'metronic/global/plugins/jquery-file-upload/js/jquery.fileupload-image.js',
            adminResourcesPath + 'metronic/global/plugins/jquery-file-upload/js/jquery.fileupload-audio.js',
            adminResourcesPath + 'metronic/global/plugins/jquery-file-upload/js/jquery.fileupload-video.js',
            adminResourcesPath + 'metronic/global/plugins/jquery-file-upload/js/jquery.fileupload-process.js',
            adminResourcesPath + 'metronic/global/plugins/jquery-file-upload/js/vendor/canvas-to-blob.min.js',
            adminResourcesPath + 'metronic/global/plugins/jquery-file-upload/js/jquery.fileupload-validate.js',
            adminResourcesPath + 'metronic/global/plugins/jquery-file-upload/blueimp-gallery/jquery.blueimp-gallery.min.js'
        ], adminPublicPath + 'metronic/js/uploader.js')

        /**
         *  COPY TASKS
         **/
        .copy(
            './resources/assets/admin/metronic/layouts/vendors/base/fonts/fontawesome5',
            adminPublicPath + 'metronic/css/fonts/fontawesome5')
        .copy(
            './resources/assets/admin/metronic/layouts/vendors/base/fonts/flaticon',
            adminPublicPath + 'metronic/css/fonts/flaticon')
        .copy(
            './resources/assets/admin/metronic/layouts/vendors/base/fonts/line-awesome',
            adminPublicPath + 'metronic/css/fonts/line-awesome')
        .copy(
            './resources/assets/admin/metronic/layouts/vendors/base/fonts/metronic',
            adminPublicPath + 'metronic/css/fonts/metronic')
        .copy(
            './resources/assets/admin/metronic/layouts/vendors/base/fonts/socicon',
            adminPublicPath + 'metronic/css/fonts/socicon')
        .copy(
            './resources/assets/admin/metronic/layouts/default/media/img/misc',
            adminPublicPath + 'metronic/img')
        .copy(
            './resources/assets/admin/metronic/layouts/default/media/img/logo',
            adminPublicPath + 'metronic/img')
        .copy(
            './resources/assets/admin/images/',
            adminPublicPath + 'images/')
        .copy(
            './resources/assets/admin/images/file-manager/filestypes',
            adminPublicPath + 'images/file-manager/filestypes')
        .copy(
            './resources/assets/admin/metronic/layouts/vendors/base/fonts/summernote',
            adminPublicPath + 'metronic/css/fonts/summernote')
        .copy(
            './resources/assets/admin/metronic/global/img',
            adminPublicPath + 'metronic/img');

    mix.task('copy_data_images');
    mix.task('sass_admin');
    mix.task('js_admin');

    mix.version([
        adminPublicPath + 'metronic/js/all.js',
        adminPublicPath + 'metronic/js/custom.js'
    ]);
});



gulp.task('sass_admin', function() {
    var saas_ltr = gulp.src('./resources/assets/admin/sass/components_ltr.scss')
        .pipe(sourcemaps.init('.', {includeContent: false}))
        .pipe(sassGlob())
        .pipe(sass())
        .pipe(autoprefixer({
            browsers: ['last 10 versions', 'ie >= 9'], // Live demo: http://autoprefixer.github.io/
            cascade: false
        }))
        .pipe(cssimport())
        .pipe(cleanCss({debug: true}))
        .pipe(sourcemaps.write({includeContent: false, sourceRoot: '../scss'}))
        .pipe(rename('components_ltr.css'))
        .pipe(gulp.dest('public/assets/admin/css/'))
        .pipe(browserSync.stream({match: '**/*.css'}));

    var saas_rtl = gulp.src('./resources/assets/admin/sass/components_rtl.scss')
        .pipe(sourcemaps.init('.', {includeContent: false}))
        .pipe(sassGlob())
        .pipe(sass())
        .pipe(autoprefixer({
            browsers: ['last 10 versions', 'ie >= 9'], // Live demo: http://autoprefixer.github.io/
            cascade: false
        }))
        .pipe(cssimport())
        .pipe(cleanCss({debug: true}))
        .pipe(sourcemaps.write({includeContent: false, sourceRoot: '../scss'}))
        .pipe(rename('components_rtl.css'))
        .pipe(gulp.dest('public/assets/admin/css/'))
        .pipe(browserSync.stream({match: '**/*.css'}));

    return merge2(saas_ltr, saas_rtl);
});

gulp.task('js_admin', function() {
    return gulp.src('./resources/assets/admin/js/components/*.js')
        .pipe(plumber())
        .pipe(sourcemaps.init())
        .pipe(uglify())
        .pipe(gulp.dest('public/assets/admin/metronic/js/components/'));
});

gulp.task('copy_data_images', function() {
    gulp.src('./resources/assets/admin/metronic/global/plugins/datatables/images/*.png')
        .pipe(gulp.dest('public/assets/admin/metronic/css/DataTables-1.10.11/images'));
});

gulp.watch('resources/assets/admin/sass/*.scss', ['sass_admin']);
gulp.watch('resources/assets/admin/js/*.js', ['js_admin']);