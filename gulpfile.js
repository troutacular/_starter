/**

	Gulp File
	========================

	1.0 - Dependencies
	2.0 - Variables
		2.1 - Project Information
		2.2 - Paths
	3.0 - Assets
		3.1 - Images
			3.1.1 - SVG to PNG
			3.1.2 - Sprite
			3.1.3 - SVG Optimize and Move
	4.0 - Scripts
	5.0 - Styles
		5.1 - Theme Information
		5.2 - Theme Stylesheet
	6.0 - Build
		6.1 - Clean
		6.2 - Build Types
		6.3 - Default
		6.4 - Watch

**/



/*--------------------------------------------------------------
1.0 - Dependencies
--------------------------------------------------------------*/

(function(){

	'use strict';

	var gulp = require('gulp'),

		// Utilities
		del = require('del'),
		inject_string = require('gulp-inject-string'),
		json_editor = require('gulp-json-editor'),
		notify = require('gulp-notify'),
		path = require('path'),
		preprocess = require('gulp-preprocess'),
		pump = require('pump'),
		rename = require('gulp-rename'),
		run_sequence = require('run-sequence'),
		sourcemaps = require('gulp-sourcemaps'),

		// Javascript
		concat = require('gulp-concat'),
		jshint = require('gulp-jshint'),
		uglify = require('gulp-uglify'),

		// CSS
		autoprefixer = require('gulp-autoprefixer'),
		sass = require('gulp-sass'),

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
2.1 - Project Information
--------------------------------------------------------------*/

	/**
	 * Set up Theme Information.  These settings control the name,
	 * version, and pertinent information for the Gulp build.
	 * @type  {Object}
	 */
	var project_info = {
		theme: {
			version: '1.0.0',
			name: '_starter',
			uri: 'https://github.com/troutacular/_starter',
			author: '@troutacular',
			author_uri: 'https://github.com/troutacular/',
			description: 'WordPress _starter theme is based off of the _s (underscores) theme and is intended to clone and use as you see fit.  It is not intended to be used as a Parent or Child theme.',
			license: 'MIT',
			license_uri: 'LICENSE.txt',
			text_domain: '_starter',
			domain_path: '/languages',
			tags: 'one-column, two-columns, left-sidebar, custom-menu, editor-style, featured-images, post-formats, sticky-post',
		},
		repository: {
			type: 'git',
			url: 'git+https://github.com/troutacular/_starter.git',
			bugs: {
				url: 'https://github.com/troutacular/_starter/issues'},
		},
	};


/*--------------------------------------------------------------
2.2 - Paths
--------------------------------------------------------------*/

	var base_paths = {
		root: './',
		src: 'assets-source/',
		dest: 'assets/',
		sass: 'assets-source/sass/',
	};
	var paths = {
		images: {
			src: base_paths.src + 'images/',
			dest: base_paths.dest + 'images/',
		},
		js: {
			src: {
				admin: base_paths.src + 'js/admin/',
				lib: base_paths.src + 'js/lib/',
				vendor: base_paths.src + 'js/vendor/',
			},
			dest: {
				admin: base_paths.dest + 'js/admin/',
				lib: base_paths.dest + 'js/lib/',
				vendor: base_paths.dest + 'js/vendor/',
			},
			output: {
				basename: 'starter',
				ext: '.js',
			},
		},
		sass: {
			src: base_paths.src + 'sass/',
			dest: base_paths.dest + 'css/',
			maps: 'maps/',
			output: {
				basename: 'starter',
				ext: '.css',
			},
		},
		sprite: {
			src: base_paths.src + 'images/sprite/*',
			dest: './',
			// Needed for running function.
			src_svg: base_paths.dest + 'images/starter_sprite.svg',
			// Needed for css output - otherwise if using above, creates separate directory.
			svg: 'images/starter_sprite.svg',
			scss: '../' + base_paths.sass + 'sprite/_sprite-map.scss',
			template: base_paths.src + 'sass/sprite/templates/sprite-template.scss',
		},
		templates: {
			src: base_paths.src + 'templates/',
			theme: {
				src: base_paths.src + 'templates/tpl-style.css',
				dest: './',
			},
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
		gulp.src(paths.images.src + '**/*.svg')
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
					// Icon output size
					dimension		: {
						maxWidth	: 16,
						maxHeight	: 16
					},
					spacing			: {
						// Add padding
						padding		: 10
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
3.1.3 - SVG Optimize and Move
--------------------------------------------------------------*/

	gulp.task('images_optimize_move', ['png_sprite'], function() {
		// Indclude all the images and sub-folders.
		return gulp.src(paths.images.src + '**/*')
		.pipe(imagemin(image_min_setting))
		.pipe(gulp.dest(paths.images.dest));
	});


/*--------------------------------------------------------------
4.0 - Scripts
--------------------------------------------------------------*/

	gulp.task('site_scripts', function() {
		return pump([
			gulp.src(paths.js.src.lib + '**/*.js'),
			jshint(),
			jshint.reporter('default'),
			concat(paths.js.output.basename + paths.js.output.ext),
			uglify(),
			rename(function (path) {
				path.basename = paths.js.output.basename;
				path.extname = '.min' + paths.js.output.ext;
			}),
			gulp.dest(paths.js.dest.lib)
		])
		.pipe(notify({ message: 'Library scripts task complete' }));
	});



	gulp.task('admin_scripts', function() {
		// Include all admin js files as is.
		return gulp.src(paths.js.src.admin + '**/*')
		.pipe(gulp.dest(paths.js.dest.admin))
		.pipe(notify({ message: 'Admin scripts task complete' }));
	});

	gulp.task('vendor_scripts', function() {
		// Include all vendor js files as is.
		return gulp.src(paths.js.src.vendor + '**/*')
		.pipe(gulp.dest(paths.js.dest.vendor))
		.pipe(notify({ message: 'Vendor scripts task complete' }));
	});


/*--------------------------------------------------------------
5.0 - Styles
--------------------------------------------------------------*/


/*--------------------------------------------------------------
5.1 - Theme Information
--------------------------------------------------------------*/

	gulp.task('theme_info_stylesheet', function() {
		var info = project_info.theme;
		gulp.src(paths.templates.theme.src)
		.pipe(inject_string.replace('@@theme_name@@', info.name))
		.pipe(inject_string.replace('@@theme_version@@', info.version))
		.pipe(inject_string.replace('@@theme_uri@@', info.uri))
		.pipe(inject_string.replace('@@theme_author@@', info.author))
		.pipe(inject_string.replace('@@theme_author_uri@@', info.author_uri))
		.pipe(inject_string.replace('@@theme_description@@', info.description))
		.pipe(inject_string.replace('@@theme_license@@', info.license))
		.pipe(inject_string.replace('@@theme_license_uri@@', info.license_uri))
		.pipe(inject_string.replace('@@theme_text_domain@@', info.text_domain))
		.pipe(inject_string.replace('@@theme_domain_path@@', info.domain_path))
		.pipe(inject_string.replace('@@theme_tags@@', info.tags))
		.pipe(rename('style.css'))
		.pipe(gulp.dest(paths.templates.theme.dest));
	});

	gulp.task('project_version', function(){
		var info = project_info;
		console.log(paths.sass.dest);
		gulp.src('./package.json')
		.pipe(json_editor({
			'version': info.theme.version,
			'description': info.theme.description,
			'author': info.theme.author,
			'license': info.theme.license,
			'repository': {
				'type': info.repository.type,
				'url': info.repository.url,
			},
			'bugs': {
				'url': info.repository.bugs.url
			},
			'paths': {
				'assets': {
					'css': '/' + paths.sass.dest,
					'images': '/' + paths.images.dest,
					'js': {
						'admin': '/' + paths.js.dest.admin,
						'lib': '/' + paths.js.dest.lib,
						'vendor': '/' + paths.js.dest.vendor,
					}
				}
			}
		}))
		.pipe(gulp.dest('./'));
	});

	gulp.task('set_theme_info', function(cb) {
		run_sequence('clean:theme_info', 'project_version', 'theme_info_stylesheet', cb);
	});


/*--------------------------------------------------------------
5.2 - Theme Stylesheet
--------------------------------------------------------------*/

	gulp.task('theme_styles', function() {
		gulp.src(paths.sass.src + '*.scss')
		.pipe(sourcemaps.init())
		.pipe(sass({
			outputStyle: 'compressed',
			includePaths: ['node_modules/susy/sass']
		}))
		.pipe(preprocess({context: {
			VERSION: project_info.theme.version,
			// Set the assets path in relation to the compiled css file.
			ASSET_RELATION_TO_CSS: '../',
		}}))
		.on('error', function (error) {
			console.error('Error!', error.message);
		})
		.pipe(autoprefixer({
			browsers: ['last 2 versions', '> 1% in US',],
			cascade: false
		}))
		.pipe(sourcemaps.write(paths.sass.maps))
		.pipe(rename(function(path) {
			path.basename = paths.sass.output.basename;
		}))
		.pipe(gulp.dest(paths.sass.dest))
		.pipe(notify({ message: 'Styles written to ' + paths.sass.dest }))
		.pipe(notify({ message: 'Maps written to ' + paths.sass.maps }));
	});


/*--------------------------------------------------------------
6.0 - Build
--------------------------------------------------------------*/


/*--------------------------------------------------------------
6.1 - Clean
--------------------------------------------------------------*/

	// Master clean function.
	gulp.task('clean', ['clean:stylesheet', 'clean:images', 'clean:js', 'clean:theme_info']);

	// Individual clean functions for streams.
	gulp.task('clean:stylesheet', function(){
		del([
			base_paths.dest + 'css'
		]);
	});

	gulp.task('clean:theme_info', function(){
		del([
			base_paths.root + 'style.css'
		]);
	});

	gulp.task('clean:images', function(){
		del([
			base_paths.dest + 'images'
		]);
	});

	gulp.task('clean:js', function(){
		del([
			base_paths.dest + 'js'
		]);
	});


/*--------------------------------------------------------------
6.2 - Build Types
--------------------------------------------------------------*/

	gulp.task('images', function(cb) {
		run_sequence('clean:images', 'svg2png', 'images_optimize_move', cb);
	});

	gulp.task('scripts', function(cb) {
		run_sequence('clean:js', 'site_scripts', 'vendor_scripts', 'admin_scripts', cb);
	});

	gulp.task('styles', function(cb) {
		run_sequence('clean:stylesheet', 'theme_styles', cb);
	});


/*--------------------------------------------------------------
6.3 - Default
--------------------------------------------------------------*/

	/**
	 * Default function for build.
	 * $ gulp
	 */
	gulp.task('default', function(){
		run_sequence('scripts', 'images', 'styles', 'set_theme_info');
	});


/*--------------------------------------------------------------
6.4 - Watch
--------------------------------------------------------------*/

	/**
	 * Watch functiion for changes.
	 * $ gulp watch
	 */
	gulp.task('watch', function() {

		// Watch .js files
		gulp.watch(base_paths.src + '**/*.js', ['scripts']);

		// Watch image files.
		gulp.watch(base_paths.src + 'images/*', ['images']);

		// Watch .scss files.
		gulp.watch(base_paths.src + '**/*.scss', ['styles']);

		// Watch any files in dist/, reload on change.
		// gulp.watch([base_paths.dest + '/**']).on('change', livereload.changed);

	});

// Close function.
})();
