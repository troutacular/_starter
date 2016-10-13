# `_starter`


This is a starting point to create a new theme template.  You should not use this theme for a project as it will be updated with elements.  You should, however, take a snapshot and use it to create a new theme for your project.


## Installing

### Naming the Theme

Download `_starter` and change the project to reflect the name of the theme you will be developing. You'll need to do a multi-step find and replace on the name in all the templates (yes this was based off of [underscores] at one point).

1. Search for `'_starter'` (inside single quotations) to capture the text domain.
2. Search for `_starter_` to capture all the function names.
3. Search for `Text Domain: _starter` in style.css.

OR

- Search for: `'_starter'` and replace with: `'theme-name'`
- Search for: `_starter_` and replace with: `theme_name_`
- Search for: `Text Domain: _starter` and replace with: `Text Domain: theme-name` in style.css.

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


## Project Compiling

### Compile Project

When you are ready to compile your project, open the project folder in the CLI and run the following command:

```
$ gulp
```

This will compile the Javascript, Images, CSS, and set the Theme Information.


### Watch Project

If you want to see your changes while working, open the project folder in the CLI and run the following command:

```
$ gulp watch
```

## Javascript

Javascript files can be found in `assets-source/js` and have three sub directories for script types.


### Library Scripts

Javascript files in `assets-source/js/lib` will run jshint on the file and compile to `assets/js/lib/[paths.js.output.basename].min.js`.  

These files will be combined (concatenated), minified, and renamed to the value in the `gulpfile.js` variable `paths.js.output.basename` with the extension `.min.js` attached.


### Admin Scripts

Javascript files in `assets-source/js/admin` will run jshint on the file and compile to `assets/js/admin`.  

_These files will not be concatenated or minified._


### Vendor Scripts

Javascript files in `assets-source/js/vendor` will run jshint on the file and compile to `assets/js/vendor`.  

_These files will not be concatenated or minified._


## CSS

This project uses SCSS to compile a theme stylesheet.  SCSS files withou an underscore `_` prefix in `assets-source/sass/` will be compiled with an autoprefixer (based on project settings) to `assets/css/[filename].css`.

CSS Maps will be compiled per stylesheet in `assets/css/maps`.


## Images

### Optimization
Images are optimized based on project settings in `config.images.minification`.  They will be optimized and moved from `assets-source/images/` to `assets/images/` and will retain their directory.


### Sprites

SVGs in `assets-source/images/sprite` will be optimized, combined, and created into a sprite in `assets/images`.

Associative classes will be created in the SCSS files and compiled for usage as CSS classes in the format `.icon-[filename]{}` and `.icon-only-[filename]{}`.


### PNG

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


## Credits

Theme base: [underscores]

Theme modifications, construct and build: [troutacular]

Mixins: See individual mixins.

Functions: See individual functions.


[Gulp]: http://gulpjs.com
[Sass]: http://sass-lang.com
[Sass-Font-Icon]: http://github.com/troutacular/sass-font-icon
[Sass-Heading-Sizes]: http://github.com/troutacular/sass-heading-sizes
[Susy]: http://susy.oddbird.net/
[troutacular]: https://github.com/troutacular/
[underscores]: http://www.underscores.me
[_starter]: http://github.com/troutacular/_starter
