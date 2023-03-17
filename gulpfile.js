// npm install -g gulp-cli
// npm install gulp gulp-csso gulp-concat vinyl-ftp gulp-util gulp-rename gulp-sass gulp-uglify --save-dev

'use strict'

let fs              = require('fs')
let config          = JSON.parse(fs.readFileSync('../config.json'))
let concat          = require('gulp-concat')
let cssMinify       = require('gulp-csso')
let ftp             = require('vinyl-ftp')
let gulp            = require('gulp')
let gutil           = require('gulp-util')
let rename          = require('gulp-rename')
let sass            = require('gulp-sass')(require('sass'))
let uglify          = require('gulp-uglify')

// FTP config
let host            = config.host
let password        = config.password
let port            = config.port
let user            = config.user

let gostRemote          = '/gostclub.com/public_html/wp-content/themes/gostclub2022/'
let gostRemoteCss       = gostRemote + 'css/'
let gostRemoteJs        = gostRemote + 'js/'
let gostRemoteParts     = gostRemote + 'template-parts/'
let gostRemoteBook      = gostRemote + 'tmp/wowbook-master/'

let gostLocal           = 'wp-content/themes/gostclub2022/'
let gostLocalCss        = gostLocal + 'css/'
let gostLocalJs         = gostLocal + 'js/'
let gostLocalParts      = gostLocal + 'template-parts/'
let gostLocalBook       = gostLocal + 'tmp/wowbook-master/'

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



gulp.task('gostCss', () => {
	return gulp.src(gostLocalCss + 'styles.scss')
		.pipe(sass())
		.pipe(cssMinify())
		.pipe(rename({
			basename: 'style',
			// suffix: '.min'
		}))
		.pipe(conn.dest(gostRemote))
})

gulp.task('gostCssCopy', () => {
	return gulp.src(gostLocalCss + '**/*')
		.pipe(conn.dest(gostRemoteCss))
})

gulp.task('gostBookCopy', () => {
	return gulp.src(gostLocalBook + 'index.html')
		.pipe(conn.dest(gostRemoteBook))
})

gulp.task('gostJs', () => {
	return gulp.src([
		gostLocalJs + 'jquery-3.6.0.min.js',
		gostLocalJs + 'owl.carousel.min.js',
		gostLocalJs + '**/*.js'
	])
		.pipe(concat('all.js'))
		// .pipe(uglify())
		.pipe(rename({
			suffix: ".min"
		}))
		.pipe(conn.dest(gostRemote))
})

gulp.task('gostJsCopy', () => {
	return gulp.src(gostLocalJs + '**/*')
		.pipe(conn.dest(gostRemoteJs))
})

gulp.task('gostPhp', () => {
	return gulp.src(gostLocal + '*.php')
		.pipe(conn.dest(gostRemote))
})

gulp.task('gostTemplateParts', () => {
	return gulp.src(gostLocalParts + '**/*')
		.pipe(conn.dest(gostRemoteParts))
})



gulp.task('watch', () => {
	gulp.watch(gostLocal + '*.php',             gulp.series('gostPhp'))
	gulp.watch(gostLocalCss + '**/*',           gulp.series('gostCss', 'gostCssCopy'))
	gulp.watch(gostLocalJs + '**/*',            gulp.series('gostJs', 'gostJsCopy'))
	gulp.watch(gostLocalParts + '**/*',         gulp.series('gostTemplateParts'))
	gulp.watch(gostLocalBook + 'index.html',    gulp.series('gostBookCopy'))
})

gulp.task('default', gulp.series('watch'))