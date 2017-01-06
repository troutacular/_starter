# `_starter`


This is a starting point to create a new theme template.  You should not use this theme for a project as it will be updated with elements.  You should, however, take a snapshot and use it to create a new theme for your project.


## Installing

### Naming the Theme

Download `_starter` and change the project to reflect the name of the theme you will be developing. You'll need to do a multi-step find and replace on the name in all the templates (yes this was based off of [underscores] at one point).

__CAUTION:__ Search and replace the theme name references in the order listed below to avoid naming conflicts and potential PHP errors.

1. Search for `'_starter'` (inside single quotations) to capture the text domain.
2. Search for `_starter_` to capture all the function names.
4. Search for `starter-` to capture sprite filename references.
5. Search for `starter.` to capture asset filename references.

OR

- Search for: `'_starter'` and replace with: `'theme-name'`
- Search for: `_starter_` and replace with: `theme_name_`
- Search for: `_starter-` and replace with: `theme-name-` for sprite renaming.
- Search for: `starter.` and replace with: `theme-name.` for asset filename renaming.

__NOTE:__ `Text Domain: _starter` in style.css will be updated automatically from the config settings in `gulpfile.js` when the project is compiled.


#### Filenames

- Rename the SASS partial `starter.scss` to `theme-name.scss` located `assets-source/sass/`.
	- If you completed the search and replace options above, the reference to this file will be updated in `functions.php` under section _2.1 - CSS_.
- Rename the JS file `starter.js` to `theme-name.js` located in `assets-source/js/lib`.
	- If you completed the search and replace options above, the reference to this file will be updated in `functions.php` under section _2.2 - Javascript_.

### Installing Node, NPM, and Gulp

You will need to install [Node][], [NPM][] and [Gulp][] to use this theme's compiling functions.  Please see the individual installation documentations for installing these on your system.


### Installing Dependencies

Install the [Gulp][] dependencies by opening the theme folder in the Command Line Interface (CLI) and run the following command:

```
$ npm install
```

Upon completion, you will now have the project dependencies installed in the directory `node_modules`.


## Configuration

This project's settings are controlled by the Gulp config file `gulpfile.js` in the root directory.

In this file is the `project_info` variable object.  This object controls and sets the following information on compiling:

- Sets the following variables in `assets-source/sass/variables/config.scss`:
  - `$version__project` for sprite image version reference.
  - `$path__assets-base` for sprite image path reference.
- Sets the following information for the package manager file in `package.json`:
  - Package Information: `version`, `description`, `author`, `license`
  - Repository Information: `repository:type`, `repository:url`
  - Bugs URL: `bugs:url`
  - Asset Paths Information: `css`, `images`, `js:amdin`, `js:lib`, `js:vendor`
- Sets the stylesheet theme information in `style.css` from the template in `assets-source/templates/tpl-style.css`.
- Sets the php information for the project version and asset paths for `css`, `js/lib`, `js/vendor`, `js/admin`.


## Project Compiling

### Compile Project

When you are ready to compile your project, open the project folder in the CLI and run the following command:

```
$ gulp
```

This will compile the Javascript, Images, CSS, and set the Theme Information.

__NOTE:__ If you encounter a `directory not empty` error running the default Gulp function: `$ gulp`, run `$ gulp clean` to clear the destination directories and then run the default Gulp task `$ gulp`.


#### Watch Project

If you want to see your changes while working, open the project folder in the CLI and run the following command:

```
$ gulp watch
```

__NOTE:__ This will only change `js`, `css`, and `images` assets.  You will need to run `$ gulp` to fully compile the project for changes to the version, language support, theme information, or updates to the paths information.

### Javascript

Javascript files can be found in `assets-source/js` and have three sub directories for script types of Library, Vendor, and Admin.

The scripts are only compiled to their respective destination directories and are _not_ auto loaded to the theme output.  This is intended to use the `functions.php` file to load the scripts with [wp_enqueue_script][] and allow for the use of dependency scripts.


#### Library Scripts

Javascript files in `assets-source/js/lib` will run jshint on the file and compile to `assets/js/lib/[paths.js.output.basename].min.js`.  

These files will be combined (concatenated), minified, and renamed to the value in the `gulpfile.js` variable `paths.js.output.basename` with the extension `.min.js` attached.


#### Vendor Scripts

Javascript files in `assets-source/js/vendor` will run jshint on the file and compile to `assets/js/vendor`.  These are third party scripts maintained by other developers/organizations.

_These files will not run jshint or be concatenated or minified._


#### Admin Scripts

Javascript files in `assets-source/js/admin` will run jshint on the file and compile to `assets/js/admin`.  These are intended to be individual scripts for WP-Admin.

_These files will not run jshint or be concatenated or minified._


### CSS

This project uses SCSS to compile a theme stylesheet.  SCSS files withou an underscore `_` prefix in `assets-source/sass/` will be compiled with an autoprefixer (based on project settings) to `assets/css/[filename].css`.

CSS Maps will be compiled per stylesheet in `assets/css/maps`.

The stylesheets are only compiled to their respective destination directories and are _not_ auto loaded to the theme output.  This is intended to use the `functions.php` file to load the scripts with [wp_enqueue_style][] and allow for the use of dependency scripts.


### Images

#### Optimization
Images are optimized based on project settings in `config.images.minification`.  They will be optimized and moved from `assets-source/images/` to `assets/images/` and will retain their directory.


#### Sprites

SVGs in `assets-source/images/sprite` will be optimized, combined, and created into a sprite in `assets/images`.

Associative classes will be created in the SCSS files and compiled for usage as CSS classes in the format `.icon-[filename]{}` and `.icon-only-[filename]{}`.


#### PNG

Any SVG files in `assets-source/images` will have a copy saved and converted to a PNG format in `assets/images`.


## Naming Conventions

### SASS Variables

SASS variables use a BEM format that is structured in the `.scss-lint.yml` config settings.  The structure for these elements is as follows:

```
[block]__[element][--modifier][--state]
```

Using HTML elements and CSS Selectors:

```
[html-element]__[css-attribute][--modifier][--state]
```


#### Examples:

---

Construct

```
[html-element]__[css-attribute][--modifier][--state]
```

Examples

```
$input__background-color
$input__background-color--hover
```

---

Construct

```
[html-element]__[css-attribute][--modifier][--state]
```

Examples

```
$link__font-color--primary
$link__font-color--primary--hover
```

---


## File Commenting

```
// Single line comments.

/**
 * Multi-line commenting for explanations
 * and doc blocks.
 */
```

Examples

```
/**
 * [foo description]
 *
 * @author  l. hamilton
 * @version [version]
 * @param   [type] $var  [description]
 * @return  [type]
 */
function foo ($x) {
	// Single comment.
	return;
}
```


## Functions

- Core elements exist in the `functions.php` file
- Optional elements (including common) reside in the `/inc` folder and can be commented out to remove.


## Stylesheets

This theme uses SASS to compile one stylesheet with compression and uses Gulp for compiling.  Feel free to modify and import the individual elements as needed.

Currently, this theme is simplified in it's structure to allow customization to be added, rather than stripped out / overridden.  However, there are some example elements in the files than illustrate how to build the theme.


### Vendor Inclusions

- [Sass] for compiling CSS
- [Susy] for the grid structure
- [Sass-Heading-Sizes] is available for percentage or fixed interval heading sizes


### Custom Mixins

There are some additional mixins included:

- align-horizontal
- align-vertical
- asset-url-helpers
- center-block
- clearfix
- clearfix-after
- fill-absolute
- font-size
- Font-style
- media-queries
- [Sass-Heading-Sizes]
  - heading-decrement
  - heading-decrement-fixed
  - heading-increment
  - heading-increment-fixed


## Notable Items

### Accesibility

If you create a template without a sidebar (`get_sidebar();`), be sure to wrap the skip to link in `header.php` with a conditional statement removing the link from output.  For example, if you remove `get_sidebar` from `404.php`:

```
if ( ! is_404() ) {
	<a class="skip-link screen-reader-text" href="#secondary"><?php esc_html_e( 'Skip to secondary content', '_starter' ); ?></a>
}
```


## Credits

Theme base: [underscores]

Theme modifications, construct and build: [troutacular]

Mixins: See individual mixins.

Functions: See individual functions.


[Gulp]: http://gulpjs.com
[Node]: https://nodejs.org/en/
[NPM]: https://www.npmjs.com/
[Sass]: http://sass-lang.com
[Sass-Font-Icon]: http://github.com/troutacular/sass-font-icon
[Sass-Heading-Sizes]: http://github.com/troutacular/sass-heading-sizes
[Susy]: http://susy.oddbird.net/
[troutacular]: https://github.com/troutacular/
[underscores]: http://www.underscores.me
[wp_enqueue_script]: https://developer.wordpress.org/reference/functions/wp_enqueue_script/
[wp_enqueue_style]: https://developer.wordpress.org/reference/functions/wp_enqueue_style/
