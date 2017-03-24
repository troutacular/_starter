/**

	Gulp File
	========================

	1.0 - Dependencies
	2.0 - Variables
		2.1 - Project Information
		2.2 - Configuration
		2.3 - Paths
	3.0 - Assets
		3.1 - Images
			3.1.1 - SVG to PNG
			3.1.2 - Sprite
			3.1.3 - SVG Optimize and Move
	4.0 - Scripts
	5.0 - Styles
	6.0 - Theme Information
	7.0 - Languages
	8.0 - Build
		8.1 - Clean
		8.2 - Build Types
		8.3 - Default
		8.4 - Watch

	NOTE: You do not need to edit below section 2.2 unless adding additional functions/dependencies.
**/



/*--------------------------------------------------------------
1.0 - Dependencies
--------------------------------------------------------------*/

(function(){

	'use strict';

	var gulp = require('gulp'),

		// Utilities
		del = require('del'),
		gulp_if = require('gulp-if'),
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
		modernizr = require('gulp-modernizr'),
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
		svgmin = require('gulp-svgmin'),

		// Language support
		wpPot = require('gulp-wp-pot');


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
		// The filename base for the output theme stylesheet, compiled javascript for `/lib`, and sprite name.
		assets: {
			filename_base: '_starter',
		},
		// Sets information in package.json
		package: {
			// See https://docs.npmjs.com/files/package.json for naming rules.
			name: 'wp-theme-starter',
			license: 'GPL-2.0',
			homepage: 'https://github.com/troutacular/_starter/',
			// The git repository for this project.
			repository: {
				type: 'git',
				url: 'git+https://github.com/troutacular/_starter.git',
				bugs: {
					url: 'https://github.com/troutacular/_starter/issues'},
			},
		},
		// This section provides the information for the 'style.css' file in the root of the theme.
		theme: {
			version: '3.4.0',
			name: 'Starter',
			uri: 'https://github.com/troutacular/_starter',
			author: '@troutacular',
			author_uri: 'https://github.com/troutacular/',
			description: 'WordPress _starter theme is based off of the _s (underscores) theme and is intended to clone and use as you see fit.  It is not intended to be used as a Parent or Child theme.',
			license: 'GNU General Public License v2 or later',
			license_uri: 'LICENSE.txt',
			text_domain: '_starter',
			domain_path: '/languages',
			tags: 'custom-menu, editor-style, featured-images, footer-widgets, full-width-template, one-column, post-formats, sticky-post, theme-options',
		},
	};


/*--------------------------------------------------------------
2.2 - Configuration
--------------------------------------------------------------*/

	/**
	 * Set configuration items for compiling.
	 * @type  {Object}
	 */
	var config = {
		autoprefixer: {
			browsers: ['last 2 versions', '> 1% in US',],
			cascade: false
		},
		images: {
			minification: {
				optimizationLevel: 3,
				progressive: true,
				interlaced: true,
				multipass: true
			}
		},
		sass: {
			outputStyle: 'compressed',
			includePaths: ['node_modules/susy/sass']
		},
		modernizr: {
			include: true,
			in_footer: true,
			filename: 'modernizr.js',
			settings: {
				'crawl': false,
				'options': [],
				'tests': [
					'svg',
				],
			}
		}
	};


/*--------------------------------------------------------------
2.3 - Paths
--------------------------------------------------------------*/

	/**
	 * Set base paths for root, source, destination and sass.
	 * @type  {Object}
	 */
	var base_paths = {
		root: './',
		root_from_asset: '../',
		src: 'assets-source/',
		dest: 'assets/',
		sass: 'assets-source/sass/',
	};

	/**
	 * Set paths for use with gulp tasks.
	 * @type  {Object}
	 */
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
				filename: project_info.assets.filename_base,
				ext: '.js',
			},
		},
		sass: {
			src: base_paths.src + 'sass/',
			dest: base_paths.dest + 'css/',
			maps: 'maps/',
			output: {
				filename: project_info.assets.filename_base,
				ext: '.css',
			},
			stylesheets: {
				primary: 'theme-stylesheet.scss',
			},
		},
		sprite: {
			src: base_paths.src + 'images/sprite/*',
			dest: './',
			// Needed for running function. Rename sprite
			src_svg: base_paths.dest + 'images/' + project_info.assets.filename_base + '-sprite.svg',
			// Needed for css output - otherwise if using above, creates separate directory.
			svg: 'images/' + project_info.assets.filename_base + '-sprite.svg',
			scss: '../' + base_paths.sass + 'sprite/_sprite-map.scss',
			template: base_paths.src + 'sass/sprite/templates/sprite-template.scss',
			admin: {
				template: base_paths.src + 'templates/sprite-classes.php',
				dest: base_paths.root_from_asset + 'inc/sprite-classes.php',
				clean: base_paths.root + 'inc/sprite-classes.php',
			}
		},
		templates: {
			src: base_paths.src + 'templates/',
			theme: {
				filename: 'style.css',
				src: base_paths.src + 'templates/tpl-style.css',
				dest: './',
			},
			php: {
				filename: 'config-options.php',
				src: base_paths.src + 'templates/config-options.php',
				dest: './inc/',
			},
		},
		languages: {
			dest: 'languages/',
			filename: project_info.assets.filename_base + '.pot',
		}
	};


/*--------------------------------------------------------------
3.1 - Images
--------------------------------------------------------------*/


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
				shape: {
					// Icon output size
					dimension: {
						maxWidth: 16,
						maxHeight: 16
					},
					spacing: {
						// Add padding
						padding: 10
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
							},
						},
						// Admin output for theme usage.
						example: {
							// relative to current working directory
							template: paths.sprite.admin.template,
							// relative to current output directory
							dest: paths.sprite.admin.dest,
						},
					}
				},
			}))
			.pipe(imagemin(config.images.minification))
			.pipe(gulp.dest(base_paths.dest));

	});


	gulp.task('png_sprite', ['svg_sprite'], function() {
		return gulp.src(paths.sprite.src_svg)
			.pipe(svg2png())
			.pipe(imagemin(config.images.minification))
			.pipe(gulp.dest(paths.images.dest));
	});


/*--------------------------------------------------------------
3.1.3 - SVG Optimize and Move
--------------------------------------------------------------*/

	gulp.task('images_optimize_move', ['png_sprite'], function() {
		// Indclude all the images and sub-folders.
		return gulp.src(paths.images.src + '**/*')
		.pipe(imagemin(config.images.minification))
		.pipe(gulp.dest(paths.images.dest));
	});


/*--------------------------------------------------------------
4.0 - Scripts
--------------------------------------------------------------*/

	gulp.task('modernizr', function() {
		gulp.src(paths.js.src.lib + '/*.js')
		.pipe(modernizr(config.modernizr.filename, config.modernizr.settings))
		.pipe(uglify())
		.pipe(gulp.dest(paths.js.dest.vendor))
		.pipe(notify({ message: 'Modernizr script task complete' }));
	});

	gulp.task('site_scripts', function() {
		return pump([
			gulp.src(paths.js.src.lib + '**/*.js'),
			jshint(),
			jshint.reporter('default'),
			concat(paths.js.output.filename + paths.js.output.ext),
			uglify(),
			rename(function(path) {
				path.filename = paths.js.output.filename;
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

	function rename_sass(filename, src) {
		if (filename===false) {
			return src;
		}
		return filename + '.css';
	}
	function sass_build(style_name, filename, src, dest, map, asset_relation) {
		return pump([
			gulp.src(src),
			sourcemaps.init(),
			sass(config.sass).on('error', function (error) {
				console.error('Error! ' + style_name + ': ', error.message);
			}),
			preprocess({context: {
				VERSION: project_info.theme.version,
				// Set the assets path in relation to the compiled css file.
				ASSET_RELATION_TO_CSS: asset_relation,
				// Set the filename base for sprite generation.
				ASSET_FILENAME_BASE: project_info.assets.filename_base,
			}}),
			autoprefixer(config.autoprefixer),
			rename(rename_sass(filename, src)),
			sourcemaps.write(map),
			gulp.dest(dest),
		])
		.pipe(notify({ message: style_name + ' styles written to ' + dest }))
		.pipe(notify({ message: style_name + ' map written to ' + map }));
	}

	// Primary theme stylsheet.
	gulp.task('theme_styles_primary', function() {
		sass_build('Main Theme', paths.sass.output.filename, [paths.sass.src + paths.sass.stylesheets.primary], paths.sass.dest, paths.sass.maps, '../');
	});

	// Right to Left stylesheet.
	gulp.task('theme_styles_rtl', function() {
		sass_build('RTL', 'rtl', paths.sass.src + 'rtl.scss', base_paths.root, paths.sass.dest + paths.sass.maps, base_paths.dest);
	});

	// All other stylesheets in /assets-source/sass/.
	gulp.task('theme_styles_additional', function() {
		sass_build('Additional Theme', false, [paths.sass.src + '*.scss', '!' + paths.sass.src + 'rtl.scss', '!' + paths.sass.src + paths.sass.stylesheets.primary], paths.sass.dest, paths.sass.maps, '../');
	});


/*--------------------------------------------------------------
6.0 - Theme Information
--------------------------------------------------------------*/

	gulp.task('theme_info_stylesheet', function() {
		var info = project_info.theme;
		var tpl = paths.templates.theme;
		gulp.src(tpl.src)
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
		.pipe(rename(tpl.filename))
		.pipe(gulp.dest(tpl.dest))
		.pipe(notify({ message: 'Theme Info Stylesheet: ' + tpl.filename + ' written to ' + tpl.dest }));
	});

	gulp.task('theme_info_php', function() {
		var info = project_info.theme;
		var tpl = paths.templates.php;
		gulp.src(tpl.src)
		.pipe(inject_string.replace('@@theme_version@@', info.version))
		.pipe(inject_string.replace('@@filename_base@@', project_info.assets.filename_base))
		.pipe(inject_string.replace('@@css@@', '/' + paths.sass.dest))
		.pipe(inject_string.replace('@@images@@', '/' + paths.images.dest))
		.pipe(inject_string.replace('@@js_lib@@', '/' + paths.js.dest.lib))
		.pipe(inject_string.replace('@@js_vendor@@', '/' + paths.js.dest.vendor))
		.pipe(inject_string.replace('@@js_admin@@', '/' + paths.js.dest.admin))
		.pipe(inject_string.replace('modernizr_include', config.modernizr.include))
		.pipe(inject_string.replace('modernizr_in_footer', config.modernizr.in_footer))
		.pipe(inject_string.replace('@@modernizr_filename@@', config.modernizr.filename))
		.pipe(rename(tpl.filename))
		.pipe(gulp.dest(tpl.dest))
		.pipe(notify({ message: 'Theme Info: ' + tpl.filename + ' written to ' + tpl.dest }));
	});

	gulp.task('project_version', function(){
		var info = project_info;
		gulp.src('./package.json')
		.pipe(json_editor({
			'name': info.package.name,
			'version': info.theme.version,
			'description': info.theme.description,
			'author': info.theme.author,
			'license': info.package.license,
			'homepage': info.package.homepage,
			'repository': {
				'type': info.package.repository.type,
				'url': info.package.repository.url,
			},
			'bugs': {
				'url': info.package.repository.bugs.url
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


/*--------------------------------------------------------------
7.0 - Languages
--------------------------------------------------------------*/

gulp.task('languages', function () {
	return gulp.src('**/*.php')
		.pipe(wpPot( {
			domain: project_info.theme.text_domain,
			package: project_info.theme.name,
		} ))
		.pipe(gulp.dest(paths.languages.dest + paths.languages.filename))
		.pipe(notify({ message: 'Language POT file generated' }));
});

/*--------------------------------------------------------------
8.0 - Build
--------------------------------------------------------------*/


/*--------------------------------------------------------------
8.1 - Clean
--------------------------------------------------------------*/

	// Master clean function.
	gulp.task('clean', ['clean:stylesheet', 'clean:rtl', 'clean:images', 'clean:js', 'clean:theme_info', 'clean:theme_info_php', 'clean:languages']);

	// Individual clean functions for streams.
	gulp.task('clean:stylesheet', function(){
		del([
			base_paths.dest + 'css/'
		]);
	});

	gulp.task('clean:theme_info', function(){
		del([
			base_paths.root + 'style.css'
		]);
	});

	gulp.task('clean:theme_info_php', function(){
		del([
			paths.templates.php.dest + paths.templates.php.filename
		]);
	});

	gulp.task('clean:languages', function(){
		del([
			paths.languages.dest + paths.languages.filename
		]);
	});

	gulp.task('clean:theme_sprites', function(){
		del([
			paths.sprite.admin.clean
		]);
	});

	gulp.task('clean:rtl', function(){
		del([
			base_paths.root + 'rtl.css'
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
8.2 - Build Types
--------------------------------------------------------------*/

	gulp.task('images', function(cb) {
		run_sequence('clean:images', 'svg2png', 'images_optimize_move', cb);
	});

	gulp.task('scripts', function(cb) {
		run_sequence('clean:js', 'site_scripts', 'vendor_scripts', 'modernizr', 'admin_scripts', cb);
	});

	gulp.task('styles', function(cb) {
		run_sequence('clean:stylesheet', 'clean:rtl', 'theme_styles_primary', 'theme_styles_additional', 'theme_styles_rtl', cb);
	});

	gulp.task('set_theme_info', function(cb) {
		run_sequence('clean:theme_info', 'clean:theme_info_php', 'project_version', 'theme_info_stylesheet', 'theme_info_php', cb);
	});


/*--------------------------------------------------------------
8.3 - Default
--------------------------------------------------------------*/

	/**
	 * Default function for build.
	 * $ gulp
	 */
	gulp.task('default', function(){
		run_sequence('clean', 'scripts', 'images', 'styles', 'set_theme_info', 'languages');
	});


/*--------------------------------------------------------------
8.4 - Watch
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
