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
		path = require('path'),
		rename = require('gulp-rename'),

		// CSS
		sass = require('gulp-ruby-sass'),
		compass = require('gulp-compass'),
		autoprefixer = require('gulp-autoprefixer'),
		cleanCSS = require('gulp-clean-css'),

		// Images
		imagemin = require('gulp-imagemin'),

		// SVG
		svg_sprite = require('gulp-svg-sprite'),
		svg2png = require('gulp-svg2png'),
		svgmin = require('gulp-svgmin');


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
		images: {
			src: base_paths.src + '/images',
			dest: base_paths.dest + '/images',
		},
		sass: {
			src: base_paths.src + '/sass',
			dest: base_paths.dest + '/css',
			config: './config.rb',
		},
		sprite: {
			src: base_paths.src + '/images/sprite/*',
			dest: './',
			// needed for running function
			src_svg: base_paths.dest + '/images/sprite-v' + project_version + '.svg',
			// needed for css output - otherwise if using above, creates separte directory
			svg: 'images/sprite-v' + project_version + '.svg',
			scss: '../' + base_paths.sass + '/sprite/_sprite-map.scss',
			template: base_paths.src + '/sass/sprite/templates/sprite-template.scss',
		},
	};


/*--------------------------------------------------------------
3.1 - Images
--------------------------------------------------------------*/

	var image_min_setting = { optimizationLevel: 3, progressive: true, interlaced: true, multipass: true };


/*--------------------------------------------------------------
3.1.1 - SVG to PNG
--------------------------------------------------------------*/

	gulp.task('svg2png', function () {
		gulp.src(paths.images.src + '/*.svg')
			.pipe(svg2png())
			.pipe(gulp.dest(paths.images.dest));
	});


/*--------------------------------------------------------------
3.1.2 - Sprite
--------------------------------------------------------------*/

	gulp.task('svg_sprite', function () {

		return gulp.src(paths.sprite.src)
			.pipe(svg_sprite({
				shape				: {
					dimension		: {
						maxWidth	: 32,
						maxHeight	: 32
					},
					spacing			: {
						// Add padding
						padding		: 5
					},
				},
				mode: {
					css: {
						dest: paths.sprite.dest,
						layout: 'vertical',
						sprite: paths.sprite.svg,
						bust: false,
						render: {
							scss: {
								dest: paths.sprite.scss,
								template: paths.sprite.template
							}
						}
					}
				}
			}))
			.pipe(imagemin(image_min_setting))
			.pipe(gulp.dest(base_paths.dest));

	});


	gulp.task('png_sprite', ['svg_sprite'], function() {
		return gulp.src(paths.sprite.src_svg)
			.pipe(svg2png())
			.pipe(imagemin(image_min_setting))
			.pipe(gulp.dest(paths.images.dest));
	});


/*--------------------------------------------------------------
3.1.3 - SVG optimize and move
--------------------------------------------------------------*/

	gulp.task('images_optimize_move', ['png_sprite'], function() {
		// indclude all the images and sub-folders
		return gulp.src(paths.images.src + '/**/*')
		.pipe(imagemin(image_min_setting))
		.pipe(gulp.dest(paths.images.dest));
	});


/*--------------------------------------------------------------
4.0 - Scripts
--------------------------------------------------------------*/


/*--------------------------------------------------------------
5.0 - Styles
--------------------------------------------------------------*/

	gulp.task('styles', function() {
		gulp.src(paths.sass.src + '/*.scss')
		.pipe(compass({
			css: paths.sass.dest,
			sass: paths.sass.src,
			image: paths.images.dest,
			require: ['susy'],
		}))
		.on('error', function (error) {
			console.error('Error!', error.message);
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

/**
 * Assets
 *
 * 1. create sprite
 * 2. convert svg to png
 * 3. optimize and move
 */

gulp.task('images', ['svg2png', 'images_optimize_move']);


/*--------------------------------------------------------------
6.2 - Clean
--------------------------------------------------------------*/

	gulp.task('clean', function(cb) {
		del([base_paths.dest + '/css', base_paths.dest + '/images'], cb);
	});


/*--------------------------------------------------------------
6.3 - Default
--------------------------------------------------------------*/

	/**
	 * Default function for build.
	 * $ gulp
	 */
	gulp.task('default', ['clean', 'images', 'styles']);


/*--------------------------------------------------------------
6.4 - Watch
--------------------------------------------------------------*/

	/**
	 * Watch functiion for changes.
	 * $ gulp watch
	 */
	gulp.task('watch', function() {

		// Watch image files.
		gulp.watch(base_paths.src + '/images/*', ['images']);

		// Watch .scss files.
		gulp.watch(base_paths.src + '/**/*.scss', ['styles']);

		// Watch any files in dist/, reload on change.
		gulp.watch([base_paths.dest + '/**']).on('change', livereload.changed);

	});

// Close function.
})();
