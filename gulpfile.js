// npm install -g gulp-cli
// npm install gulp gulp-csso gulp-concat vinyl-ftp gulp-util gulp-rename gulp-sass gulp-uglify --save-dev

'use strict'

const fs            = require('fs')
const config        = JSON.parse(fs.readFileSync('../config.json'))
const ftp           = require('vinyl-ftp')
const gulp          = require('gulp')
const gutil         = require('gulp-util')
const concat        = require('gulp-concat')
const cssMinify     = require('gulp-csso')
const rename        = require('gulp-rename')
const sass          = require('gulp-sass')(require('sass'))
const uglify        = require('gulp-uglify')

// FTP config
const host          = config.host
const password      = config.password
const port          = config.port
const user          = config.user

const remoteFolder      = '/gostclub.com/public_html/wp-content/themes/supermag/'
const remoteHooks       = remoteFolder + 'acmethemes/hooks/'
const remoteAssets      = remoteFolder + 'assets/'
const remoteCss         = remoteAssets + 'css/'
const remoteJs          = remoteAssets + 'js/'
const remoteParts       = remoteFolder + 'template-parts/'

const localFolder       = 'wp-content/themes/supermag/'
const localHooks        = localFolder + 'acmethemes/hooks/'
const localAssets       = localFolder + 'assets/'
const localCss          = localAssets + 'css/'
const localJs           = localAssets + 'js/'
const localParts        = localFolder + 'template-parts/'



// GOST club template
const gostClubRemote        = '/gostclub.com/public_html/wp-content/themes/gostclub2022/'
const gostClubRemoteCss     = gostClubRemote + 'css/'
const gostClubRemoteJs      = gostClubRemote + 'js/'
const gostClubRemoteParts   = gostClubRemote + 'template-parts/'

const gostClubLocal         = 'wp-content/themes/gostclub2022/'
const gostClubLocalCss      = gostClubLocal + 'css/'
const gostClubLocalJs       = gostClubLocal + 'js/'
const gostClubLocalParts    = gostClubLocal + 'template-parts/'



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

const conn = getFtpConnection()



// gost club tasks [START]
gulp.task('gostCss', function () {
	return gulp.src(gostClubLocalCss + 'styles.scss')
		.pipe(sass())
		.pipe(cssMinify())
		.pipe(rename({
			basename: 'style',
			// suffix: '.min'
		}))
		.pipe(conn.dest(gostClubRemote));
})

gulp.task('gostCssCopy', function () {
	return gulp.src(gostClubLocalCss + '**/*')
		.pipe(conn.dest(gostClubRemoteCss));
})

gulp.task('gostJs', function () {
	return gulp.src([
		gostClubLocalJs + 'jquery-3.6.0.min.js',
		gostClubLocalJs + '**/*.js'
	])
		.pipe(concat('all.js'))
		// .pipe(uglify())
		.pipe(rename({
			suffix: ".min"
		}))
		.pipe(conn.dest(gostClubRemote));
})

gulp.task('gostJsCopy', function () {
	return gulp.src(gostClubLocalJs + '**/*')
		.pipe(conn.dest(gostClubRemoteJs));
})

gulp.task('gostPhp', function () {
	return gulp.src(gostClubLocal + '*.php')
		.pipe(conn.dest(gostClubRemote));
})

gulp.task('gostTemplateParts', function () {
	return gulp.src(gostClubLocalParts + '**/*')
		.pipe(conn.dest(gostClubRemoteParts));
})
// gost club tasks [END]



gulp.task('watch', function() {
	gulp.watch(gostClubLocal + '*.php',         gulp.series('gostPhp'))
	gulp.watch(gostClubLocalCss + '**/*',       gulp.series('gostCss', 'gostCssCopy'))
	gulp.watch(gostClubLocalJs + '**/*',        gulp.series('gostJs', 'gostJsCopy'))
	gulp.watch(gostClubLocalParts + '**/*',     gulp.series('gostTemplateParts'))
})

gulp.task('default', gulp.series('watch'))