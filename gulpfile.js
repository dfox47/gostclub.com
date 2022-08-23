
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
let sass            = require('gulp-sass')
let uglify          = require('gulp-uglify')

// FTP config
let host            = config.host
let password        = config.password
let port            = config.port
let user            = config.user

let remoteFolder        = '/gostclub.com/public_html/wp-content/themes/supermag/'
let remoteFolderCss     = remoteFolder + 'css/'
let remoteFolderJs      = remoteFolder + 'js/'
let remoteFolderParts   = remoteFolder + 'template-parts/'

let localFolder         = 'www/wp-content/themes/supermag/'
let localFolderCss      = localFolder + 'css/'
let localFolderJs       = localFolder + 'js/'
let localFolderParts    = localFolder + 'template-parts/'

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
	return gulp.src(localFolderCss + 'styles.scss')
		.pipe(sass())
		.pipe(cssMinify())
		.pipe(rename({
			// basename: 'styles',
			suffix: '.min'
		}))
		.pipe(conn.dest(remoteFolder));
});

gulp.task('css_copy', function () {
	return gulp.src(localFolderCss + '**/*')
		.pipe(conn.dest(remoteFolderCss));
});

gulp.task('php', function () {
	return gulp.src(localFolder + '*.php')
		.pipe(conn.dest(remoteFolder));
});

gulp.task('template-parts', function () {
	return gulp.src(localFolderParts + '**/*')
		.pipe(conn.dest(remoteFolderParts));
});

gulp.task('js', function () {
	return gulp.src([
		localFolderJs + 'jquery-3.4.1.min.js',
		localFolderJs + 'easeljs-0.7.1.min.js',
		localFolderJs + 'TweenMax.min.js',
		localFolderJs + '**/*.js'
	])
		.pipe(concat('all.js'))
		// .pipe(uglify())
		.pipe(rename({
			suffix: ".min"
		}))
		.pipe(conn.dest(remoteFolder));
});

gulp.task('js_copy', function () {
	return gulp.src(localFolderJs + '**/*')
		.pipe(conn.dest(remoteFolderJs));
});

gulp.task('watch', function() {
	// gulp.watch(localFolder + '*.php',           gulp.series('php'))
	// gulp.watch(localFolderCss + '**/*',         gulp.series('css', 'css_copy'))
	// gulp.watch(localFolderJs + '**/*',          gulp.series('js', 'js_copy'))
	// gulp.watch(localFolderParts + '**/*',       gulp.series('template-parts'))
});

gulp.task('default', gulp.series('watch'))
