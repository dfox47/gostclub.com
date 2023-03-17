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



// GOST club template
let gostClubRemote          = '/gostclub.com/public_html/wp-content/themes/gostclub2022/'
let gostClubRemoteCss       = gostClubRemote + 'css/'
let gostClubRemoteJs        = gostClubRemote + 'js/'
let gostClubRemoteParts     = gostClubRemote + 'template-parts/'

let gostClubLocal           = 'wp-content/themes/gostclub2022/'
let gostClubLocalCss        = gostClubLocal + 'css/'
let gostClubLocalJs         = gostClubLocal + 'js/'
let gostClubLocalParts      = gostClubLocal + 'template-parts/'



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
		gostClubLocalJs + 'owl.carousel.min.js',
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