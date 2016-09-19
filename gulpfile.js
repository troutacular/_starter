/**

	Gulp File
	========================

	1.0 - Dependencies
	2.0 - Variables
		2.1 - Project version
		2.2 - Paths
	3.0 - Assets
		3.1 - Images
			3.1.1 - SVG to PNG
			3.1.2 - Sprite
			3.1.3 - SVG optimize and move
	4.0 - Scripts
		4.1 - Inject Scripts
	5.0 - Styles
	6.0 - Build
		6.1 - Build order
		6.2 - Clean
		6.3 - Default
		6.4 - Watch

**/



/*--------------------------------------------------------------
1.0 - Dependencies
--------------------------------------------------------------*/

(function(){

	'use strict';

	var gulp = require('gulp'),

		// Functions
		del = require('del'),
		notify = require('gulp-notify'),
		rename = require('gulp-rename'),

		// CSS
		sass = require('gulp-ruby-sass'),
		compass = require('gulp-compass'),
		autoprefixer = require('gulp-autoprefixer'),
		minifycss = require('gulp-clean-css');


/*--------------------------------------------------------------
2.0 - Variables
--------------------------------------------------------------*/


/*--------------------------------------------------------------
2.1 - Project version
--------------------------------------------------------------*/

	var project_version = '1.0.0';


/*--------------------------------------------------------------
2.2 - Paths
--------------------------------------------------------------*/

	var base_paths = {
		src: 'assets-source',
		dest: 'assets',
		sass: 'assets-source/sass',
	};
	var paths = {
		sass: {
			src: base_paths.src + '/sass',
			dest: base_paths.dest + '/css',
			config: './config.rb',
		},
	};


/*--------------------------------------------------------------
3.1 - Images
--------------------------------------------------------------*/


/*--------------------------------------------------------------
3.1.1 - SVG to PNG
--------------------------------------------------------------*/


/*--------------------------------------------------------------
3.1.2 - Sprite
--------------------------------------------------------------*/


/*--------------------------------------------------------------
3.1.3 - SVG optimize and move
--------------------------------------------------------------*/

/*--------------------------------------------------------------
4.0 - Scripts
--------------------------------------------------------------*/


/*--------------------------------------------------------------
5.0 - Styles
--------------------------------------------------------------*/

	gulp.task('styles', function() {
		gulp.src(paths.sass.src + '/*.scss')
		.pipe(compass({
			config_file: paths.sass.config,
			css: paths.sass.dest,
			sass: paths.sass.src
		}))
		.on('error', function (err) {
			console.error('Error!', err.message);
		})
		.pipe(autoprefixer('last 2 version'))
		.pipe(gulp.dest(paths.sass.dest))
		.pipe(rename(function (path) {
			path.basename += '-v' + project_version;
		}))
		.pipe(cleanCSS())
		.pipe(gulp.dest(base_paths.dest + '/css'))
		.pipe(notify({ message: 'Styles task complete' }));
	});



/*--------------------------------------------------------------
6.0 - Build
--------------------------------------------------------------*/


/*--------------------------------------------------------------
6.1 - Build order
--------------------------------------------------------------*/


/*--------------------------------------------------------------
6.2 - Clean
--------------------------------------------------------------*/

	gulp.task('clean', function(cb) {
		del([base_paths.dest + '/css'], cb);
	});


/*--------------------------------------------------------------
6.3 - Default
--------------------------------------------------------------*/

	/**
	 * Default function for build.
	 * $ gulp
	 */
	gulp.task('default', ['clean', 'styles']);


/*--------------------------------------------------------------
6.4 - Watch
--------------------------------------------------------------*/

	/**
	 * Watch functiion for changes.
	 * $ gulp watch
	 */
	gulp.task('watch', function() {

		// Watch .scss files.
		gulp.watch(base_paths.src + '/**/*.scss', ['styles']);

		// Watch any files in dist/, reload on change.
		gulp.watch([base_paths.dest + '/**']).on('change', livereload.changed);

	});

// Close function.
})();
