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
- Search for: `Text Domain: _starter` and replace with: `Text Domain: theme-name` in style.css.



## Notable Elements

### Naming Conventions

#### SASS Variables

SASS variables use a BEM format that is structured in the `.scss-lint.yml` config settings.  The structure for these elements is as follows:

```
[block]__[element][--modifier][--state]
```

Using HTML elements and CSS Selectors:

```
[html-element]__[css-attribute][--modifier][--state]
```


##### Examples:

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


### File Commenting

```
// Single line comments.

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
 * @author  l. hamilton
 * @version [version]
 * @param   [type] $var  [description]
 * @return  [type]
 */
function foo ($x) {
	// Do stuff.
	return;
}
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


[Grunt]: http://gruntjs.com
[Gulp]: http://gulpjs.com
[Sass]: http://sass-lang.com
[Sass-Font-Icon]: http://github.com/troutacular/sass-font-icon
[Sass-Heading-Sizes]: http://github.com/troutacular/sass-heading-sizes
[Susy]: http://susy.oddbird.net/
[troutacular]: https://github.com/troutacular/
[underscores]: http://www.underscores.me
[_starter]: http://github.com/troutacular/_starter
