# Version Releases

## 2.2.0

- Update PHP and JS functions to remove `starter` and `Starter` from function names to more generic function descriptors.
	- `/assets-source/js/lib/starter.js`
		- Renamed `starterAcronymClass` to `siteAcronymClass`
	- `/inc/footer-columns.php`
		- Renamed `Starter_Footer_Columns` to `WP_Custom_Footer_Columns`

## 2.1.0

- Fix theme tag `full-width-template`.
- Add `.sticky` class support.
- Update language support to `_starter` text domain.
- Move php config paths to Gulp build:
  - Source: `assets-source/templates/config-paths.php`
  - Destination: `inc/config-paths.php`
- Add `editory-styles.css` for Admin stylesheet display.
	- Imports typography and general content SCSS partials to display content output in the editor.


## 2.0.1

- Fix asset path generation for images in relation to generated stylesheets.
  - Removes double slash `..//images` for theme and rtl stylesheets.
- Fix asset path for rtl stylesheets.


## 2.0.0

- Remove `_breakpoints.scss` mixin.  Arbitrary to have _set_ breakpoints these days.

### __Deprecation:__

#### `@media #{$breakpoint-variable} {}`

Replace with one of the following mixins:
```
@include screen( $resolution-min, $resolution-max ) {}
@include max-screen( $resolution ) {}
@include min-screen( $resolution ) {}
@include screen-height( $resolution-min, $resolution-max ) {}
@include max-screen-height( $resolution ) {}
@include min-screen-height($resolution) {}
@include screen-orientation( $orientation: landscape ) {}
@include print {}
```

See `assets-source/sass/mixins/_media-queries.scss` for full documentation.


## 1.0.1

- WAVE accessibility updates:
  - Escaped output for:
    - Post navigation screen reader text
	- `excerpt_read_more` function
	- WP Admin: primary and secondary menus
	- WP Admin: Footer Column text output
  - Search form label wrapper for screen readers.
  - Default font color contrast update for block quotes.
  - Added `sidebar();` to 404.php for skip to secondary.
- Note about not including `sidebar();` on templates.
- Remove 'other.css' test file.
- Gulp sass_build fix for watch function.


## 1.0.0

- Remove:
  - Ruby Gem Dependencies:
    - Ruby Sass
	- Compass
- Add:
  - Gulp preprocessing:
    - style.css generation by compile
	- SVG sprite Creation
	- Image optimization
	- PNG creation for SVGs
    - SCSS Lint
    - JSHint and `/lib` concat and minify
  - WordPress Coding Standards Settings.
- Update templates for WordPress Coding Standards.
- BEM variable naming conventions.
- Reconfigure SCSS partials structure.


## 0.1.0

- Project init.
