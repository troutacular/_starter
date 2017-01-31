# `_starter`

This is a starting point to create a new theme template.  You should not use this theme for a project as it will be updated with elements.  You should, however, take a snapshot and use it to create a new theme for your project.


## Installing

### Naming the Theme

Download `_starter` and change the project to reflect the name of the theme you will be developing. You'll need to do a multi-step find and replace on the name in all the templates (yes this was based off of [underscores] at one point).

__CAUTION:__ Search and replace the theme name references in the order listed below to avoid naming conflicts and potential PHP errors.

1. Search for `'_starter'` *(inside single quotations)* to capture the text domain.
2. Search for `_starter_` to capture all the function names.
3. Search for `_starter` to capture filename references.
4. Search for `wp-theme-starter` to capture package compiling information.
4. Search for `Starter` to capture admin page titles.

OR

- Search for: `'_starter'` and replace with: `'theme-name'`
- Search for: `_starter_` and replace with: `theme_name_`
- Search for: `_starter` and replace with: `theme-name` for asset output renaming.
- Search for: `wp-theme-starter` and replace with: `wp-theme-theme-name` for gulp and package configurations.
- Search for: `Starter` and replace with: `Theme Name` for admin page titles and theme name references.

__Update the following:__

- Clear the contents and restart the documentation and versioning for the following files as needed:
  - `readme.md`
  - `release-versions.md`
- Update the following information in `gulpfile.js`:
  - Git repository URL:
    - `project_info.package.repository.url`
    - `project_info.package.repository.bugs.url`
    - `project_info.theme.uri`
  - Author URI in `project_info.theme.author_uri`
  - Check and update the theme information in `project_info.theme`:
    - `version`, `name`, `uri`, `author`, `author_uri`, `description`, `tags`


__NOTES:__

- `Text Domain: _starter` in style.css will be updated automatically from the config settings in `gulpfile.js` when the project is compiled.


### Installing Node, NPM, and Gulp

You will need to install [Node][] (includes [NPM][]) and [Gulp][] to use this theme's compiling functions.  Please see the individual installation documentations for installing these on your system.


### Installing Dependencies

Install the [Gulp][] dependencies by opening the theme folder in the Command Line Interface (CLI) and run the following command:

```
$ npm install
```

Upon completion, you will now have the project dependencies installed in the directory `node_modules`.


## Configuration

This project's settings are controlled by the Gulp config file `gulpfile.js` in the root directory.

In this file is the `project_info`, `config`, and `paths` variable objects.  These objects control and sets the version, paths and asset relation information when compiling.

The CSS, JS, and sprite filenames are generated automatically from the Gulp build process using the value `project_info.assets.filename_base`.

__NOTE:__  You do not need to edit below section 2.1 of `gulpfile.js` unless adding additional functions/dependencies or changing output settings in `config`.


### NPM Package

- `project_info.package` sets the following information for the package manager file in `package.json`:
  - Package Information: `name`, `version`, `description`, `author`, `license`
  - Repository Information: `repository.type`, `repository.url`
  - Bugs URL: `bugs.url`
  - Asset Paths Information: `css`, `images`, `js.amdin`, `js.lib`, `js.vendor`


### WordPress Theme Information

- `package_info.theme` sets the stylesheet theme information in `style.css` from the template in `assets-source/templates/tpl-style.css`.

### Stylesheets

- Sets the following variables in `assets-source/sass/variables/config.scss`:
  - `$version__project` for sprite image version reference.
  - `$path__assets-base` for sprite image path reference.
  - `$filename__assets-base` for sprite filename creation.

### PHP Variables
- Sets the php information:
  - Project version from `project_info.theme.version`
  - Asset paths for `css`, `js/lib`, `js/vendor`, `js/admin`.


## PHP Functions

- Core elements exist in the `functions.php` file
- Optional elements (including common) reside in the `/inc` folder and can be commented out to remove.


## Theme Templates

Theme templates should be created under the `/page-templates` according to [WordPress Theme Organization][] standards.


### Theme Templates: Dynamic Sidebars

If you want to have a custom sidebar for the page template type, add the sidebar information to the the `_starter_widgets_init` function's `$sidebars` array:

```
$sidebars = array(
  array(
    'name' => 'Name',
    'slug' => 'template-name',
    'description' => 'Items placed here will appear in the sidebar on pages assigned to the page template page [template-name].',
  ),
```


## Project Compiling

### Compile Project

__NOTE:__ Be sure to update the theme version appropriately using [Semantic Versioning][] in `gulpfile.js` under `project_info.theme.version` before compiling.

When you are ready to compile your project, open the project folder in the CLI and run the following command:

```
$ gulp
```

This will compile the Javascript, Images, CSS, and set the Theme Information.


#### Watch Project

If you want to see your changes while working, open the project folder in the CLI and run the following command:

```
$ gulp watch
```

__NOTE:__ This will only change `js`, `css`, and `images` assets.  You will need to run `$ gulp` to fully compile the project for changes to the version, language support, theme information, or updates to the paths information.

### Javascript

Javascript files can be found in `assets-source/js` and have three sub directories for script types of Library: `lib`, Vendor: `vendor`, and Admin: `admin`.

*The `lib` files will compile automatically and be renamed to the value in the `gulpfile.js` under `project_info.assets.filename_base`.*

The `admin` and `vendor` scripts are only compiled to their respective destination directories and are *not* auto loaded to the theme output.  This is intended to use the `functions.php` file to load the scripts with [wp_enqueue_script][] and allow for the use of dependency scripts.


#### JS: Library Scripts

Javascript files in `assets-source/js/lib` will run jshint on the files, concatenate, minify and rename into a single file `assets/js/lib/[paths.js.output.basename].min.js`.

__NOTE:__ `paths.js.output.basename` maps to `project_info.assets.filename_base`.


#### JS: Vendor Scripts

These are third party scripts maintained by other developers/organizations.

Javascript files in `assets-source/js/vendor` will run jshint on the file and compile to `assets/js/vendor`.

*These files will not run jshint or be concatenated or minified.*


#### JS: Admin Scripts

These are intended to be individual scripts for WP-Admin.

Javascript files in `assets-source/js/admin` will run jshint on the file and compile to `assets/js/admin`.

*These files will not run jshint or be concatenated or minified.*


### Stylesheets

This theme uses SASS to compile one stylesheet with compression and uses Gulp for compiling.  Feel free to modify and import the individual elements as needed.

Currently, this theme is simplified in it's structure to allow customization to be added, rather than stripped out / overridden.  However, there are some example elements in the files than illustrate how to build the theme.

#### CSS Compiling

All stylesheets compiled will use an auto prefix generator based on the project settings under `config.autorprefixer`.

CSS Maps will be compiled per stylesheet in `assets/css/maps/[filename].css.map`.


#### Stylesheet Types

##### Primary stylesheet

The theme's stylesheet SCSS file `/assets-source/sass/theme-stylesheet.scss` will be compiled and renamed to the value in `project_info.assets.filename_base`.


###### Vendor Inclusions

- [Sass] for compiling CSS
- [Susy] for the grid structure
- [Sass-Heading-Sizes] is available for percentage or fixed interval heading sizes


###### Custom Mixins

There are some additional mixins included:

- align-horizontal
- align-vertical
- asset-url-helpers
- center-block
- clearfix-after
- clearfix
- fill-absolute
- font-size
- font-style
- media-queries
- [Sass-Heading-Sizes]
  - heading-decrement
  - heading-decrement-fixed
  - heading-increment
  - heading-increment-fixed


##### Right to Left

Use the SCSS base stylesheet `/assets-source/sass/rtl.scss` to set styles to support additional languages in right-to-left format.

The theme's RTL SCSS file `/assets-source/sass/rtl.scss` will be compiled and output to the theme's root directory.

__NOTE:__ `rtl.css` will compile to the theme root `./` for WordPress support.


##### All other stylesheets

Other SCSS files without an underscore `_` prefix in `assets-source/sass/` will be compiled to `assets/css/[filename].css`.

These stylesheets are only compiled to their respective destination directories and are *not* auto loaded to the theme output.  This is intended to use the `functions.php` file to load the scripts with [wp_enqueue_style][] and allow for the use of dependency requirements.


### Images

#### Optimization
Images are optimized based on project settings in `config.images.minification`.  They will be optimized and moved from `assets-source/images/` to `assets/images/` and will retain their directory.


#### Sprites

SVGs in `assets-source/images/sprite` will be optimized, combined, and created into a sprite in `assets/images`.

Associative classes will be created in the SCSS files and compiled for usage as CSS classes in the format `.icon-[filename]{}` and `.icon-only-[filename]{}`.  These classes will display in the TinyMCE editor in the WP Admin content section under the `Formats` dropdown as separate `Icon` and `Icon Only` lists.  They will insert the icon with a span tag to allow editors to add the icon to content easily without remembering classes.

__NOTE:__ The sprite filename is generated automatically from the value `project_info.assets.filename_base`.


#### PNG

Any SVG files in `assets-source/images` will have a copy converted and saved to a PNG format in `assets/images`.


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
[Semantic Versioning]: http://semver.org
[Susy]: http://susy.oddbird.net/
[troutacular]: https://github.com/troutacular/
[underscores]: http://www.underscores.me
[wp_enqueue_script]: https://developer.wordpress.org/reference/functions/wp_enqueue_script/
[wp_enqueue_style]: https://developer.wordpress.org/reference/functions/wp_enqueue_style/
[WordPress Theme Organization]: https://developer.wordpress.org/themes/basics/organizing-theme-files/
