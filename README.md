# `_starter`


This is a starting point to create a new theme template.  You should not use this theme for a project as it will be updated with elements.  You should, however, take a snapshot and use it to create a new theme for your project.


# Getting Started

If you want to set things up manually, download `_starter`. You'll need to do a multi-step find and replace on the name in all the templates (yes this was based off of [underscores] at one point).

1. Search for `'_starter'` (inside single quotations) to capture the text domain.
2. Search for `_starter_` to capture all the function names.
3. Search for `Text Domain: _starter` in style.css.

OR

- Search for: `'_starter'` and replace with: `'theme-name'`
- Search for: `_starter_` and replace with: `theme_name_`
-  Search for: `Text Domain: _starter` and replace with: `Text Domain: theme-name` in style.css.


## Bundler

This project uses [Bundler] to incorporate the required building elements:

- [Sass]
- [Compass]
- [Susy]

`_starter` already has a Gemfile and the requirements for the libraries above.  You will need to add new Gems to the Gemfile and

Make sure you have bundler installed by running the following command in the command line (terminal):

	$ gem install bundler

To ensure you have the necessary components for theme development, cd to the theme folder and run the following command in the command line (terminal):

	$ bundle install

If you are adding a new Gem, run the install and create a new lock file

	$ bundle update [gem]

Now watch the file:

	$ bundle exec compass watch



## Notable Elements

The goal of this template was to create a markup that did not need to be changed that much (with exception to the index/home page).  That being said, feel free to remove anything or strip it down.  Most classes for elements exist in the SASS files.

### Naming Conventions

#### SASS Variables

	[scope]-[scope element]-[element]-[state]-[specificity]


##### Examples:

---

Construct

	[scope]-[element]-[specificity]-[state]


Examples

	$color-background-site

	$color-text-link-site-header-hover

---

Construct

	[scope]-[element]-[specificity]-[state]

Examples

	$color-text-link-site

	$color-text-link-site-header-active

---


### File Commenting

```
// Single line comments

/**
 * Multi-line commenting for explanations
 * and doc blocks.
 */
```

Use

```
/**
 * [foo description]
 *
 * This is a cool function.
 *
 * @author  weber
 * @version [version]
 * @param   [type]     $x   [description]
 * @return  [type]
 */
function foo ($x) {}
```


### Functions

- Core elements exist in the `functions.php` file
- Optional elements (including common) reside in the `/inc` folder and can be commented out to remove


### Stylesheets

This theme uses SASS to compile one stylesheet with compression and uses Ruby Sass and Bundler to run the specified Ruby Gems for compiling.  Feel free to modify and import the individual elements as needed.

Currently, this theme is simplified in it's structure to allow customization to be added, rather than stripped out / overridden.  However, there are some example elements in the files than illustrate how to build the theme.


#### Vendor Inclusions

- [Sass] for compiling CSS
- [Compass] for mixins
- [Susy] for the grid structure
- [Sass-Heading-Sizes] is available for percentage or fixed interval heading sizes


#### Custom Mixins

There are some additional mixins included:

- Breakpoints
- Font-size
- Font-style
- Horizontal-align
- Media-queries
- [Sass-Font-Icon]
- [Sass-Heading-Sizes]
- Svg-background-image
- Vertical-align


# Credits

Theme base: [underscores]

Mixins: See individual mixins

Functions: See individual functions

Sass construct: [troutacular]


[Bundler]: http://bundler.io
[Compass]: http://compass-style.org
[Grunt]: http://gruntjs.com
[Gulp]: http://gulpjs.com
[Sass]: http://sass-lang.com
[Sass-Font-Icon]: http://github.com/troutacular/sass-font-icon
[Sass-Heading-Sizes]: http://github.com/troutacular/sass-heading-sizes
[Susy]: http://susy.oddbird.net/
[troutacular]: https://github.com/troutacular/
[underscores]: http://www.underscores.me
[_starter]: http://github.com/uscwebservices/_starter-2015
