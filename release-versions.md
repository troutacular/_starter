# Version Releases

## 1.1.0

- WAVE accessibility updates
  - Escaped output for:
    - Post navigation screen reader text
	- `excerpt_read_more` function
	- WP Admin: primary and secondary menus
	- WP Admin: Footer Column text output
  - Search form label wrapper for screen readers
  - Default font color contrast update for block quotes
  - Added `sidebar();` to 404.php for skip to secondary
- Note about not including `sidebar();` on templates
- Remove 'other.css' test file
- Gulp sass_build fix for watch function

## 1.0.0

- Remove
  - Ruby Gem Dependencies
    - Ruby Sass
	- Compass
- Add
  - Gulp preprocessing
    - style.css generation by compile
	- SVG sprite Creation
	- Image optimization
	- PNG creation for SVGs
    - SCSS Lint
    - JSHint and `/lib` concat and minifcation
  - WordPress Coding Standards Settings
- Update templates for WordPress Coding Standards
- BEM variable naming conventions
- Reconfigure SCSS partials structure

## 0.1.0

- Project init.
