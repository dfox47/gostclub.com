
// npm install -g gulp-cli
// npm install gulp gulp-csso gulp-concat vinyl-ftp gulp-util gulp-rename gulp-sass gulp-uglify --save-dev

'use strict'

let fs              = require('fs')
let config          = JSON.parse(fs.readFileSync('../config.json'))
let ftp             = require('vinyl-ftp')
let gulp            = require('gulp')
let gutil           = require('gulp-util')
let concat          = require('gulp-concat')
let cssMinify       = require('gulp-csso')
let rename          = require('gulp-rename')
let sass            = require('gulp-sass')(require('sass'))
let uglify          = require('gulp-uglify')

// FTP config
let host            = config.host
let password        = config.password
let port            = config.port
let user            = config.user

let remoteFolder    = '/gostclub.com/public_html/wp-content/themes/supermag/'
let remoteHooks     = remoteFolder + 'acmethemes/hooks/'
let remoteAssets    = remoteFolder + 'assets/'
let remoteCss       = remoteAssets + 'css/'
let remoteJs        = remoteAssets + 'js/'
let remoteParts     = remoteFolder + 'template-parts/'

let localFolder     = 'wp-content/themes/supermag/'
let localHooks      = localFolder + 'acmethemes/hooks/'
let localAssets     = localFolder + 'assets/'
let localCss        = localAssets + 'css/'
let localJs         = localAssets + 'js/'
let localParts      = localFolder + 'template-parts/'

function getFtpConnection() {
	return ftp.create({
		host:           host,
		log:            gutil.log,
		password:       password,
		parallel:       3,
		port:           port,
		timeout:        99999999,
		user:           user
	});
}

let conn = getFtpConnection()



gulp.task('css', function () {
	return gulp.src(localCss + 'styles.scss')
		.pipe(sass())
		.pipe(cssMinify())
		.pipe(rename({
			basename: 'style',
			// suffix: '.min'
		}))
		.pipe(conn.dest(remoteFolder));
});

gulp.task('css_copy', function () {
	return gulp.src(localCss + '**/*')
		.pipe(conn.dest(remoteCss));
});

gulp.task('hooks_copy', function () {
	return gulp.src(localHooks + '**/*')
		.pipe(conn.dest(remoteHooks));
});

gulp.task('php', function () {
	return gulp.src(localFolder + '*.php')
		.pipe(conn.dest(remoteFolder));
});

gulp.task('template-parts', function () {
	return gulp.src(localParts + '**/*')
		.pipe(conn.dest(remoteParts));
});

gulp.task('js', function () {
	return gulp.src([
		localJs + 'jquery-3.4.1.min.js',
		localJs + 'easeljs-0.7.1.min.js',
		localJs + 'TweenMax.min.js',
		localJs + '**/*.js'
	])
		.pipe(concat('all.js'))
		// .pipe(uglify())
		.pipe(rename({
			suffix: ".min"
		}))
		.pipe(conn.dest(remoteFolder));
});

gulp.task('js_copy', function () {
	return gulp.src(localJs + '**/*')
		.pipe(conn.dest(remoteJs));
});

gulp.task('watch', function() {
	// gulp.watch(localFolder + '*.php',            gulp.series('php'))
	gulp.watch(localHooks + '**/*',           gulp.series('hooks_copy'))
	gulp.watch(localCss + '**/*',             gulp.series('css', 'css_copy'))
	// gulp.watch(localJs + '**/*',           gulp.series('js', 'js_copy'))
	// gulp.watch(localParts + '**/*',        gulp.series('template-parts'))
});

gulp.task('default', gulp.series('watch'))
