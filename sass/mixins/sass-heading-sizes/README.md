Sass Heading Sizes
==================

Developed by [@troutacular]

This is a Sass (SCSS) mixin that will allow you to increase or decrease your <h> tag heading sizes in increments by either an equal percentage or by a fixed amount.

Sizes are set to use relative (rem) where possible and fall back to px if support for IE is needed.

# Mixins

## Heading Decrement [heading-decrement]

Uses a heading-size (font size) and declares the decrease amount in percentage.		

---

`[heading-size]` 

Starts with h1 size and decreases to h6 evenly


`[decrement]` 

The percentage amount you would like to decrease between h tags


`[unit]` 

The font size unit you would like to use - rem, em, px

---


### Usage

	@include heading-decrement( [ heading-size ], [ decrement ] , [ unit ] );

## Heading Increment

Uses a heading-size (font size) and declares the increase amount in percentage.

---

`[heading-size]` 
	
Starts with h6 size and increases to h1 evenly

`[decrement]` 
	
The percentage amount you would like to increase between h tags

`[unit]` 
	
The font size unit you would like to use - rem, em, px

---
	
### Usage

	@include heading-increment( [ heading-size ], [ decrement ] , [ unit ] );

## Heading Decrement - Fixed

Uses a heading-size (font size) and declares the decrease amount in unit size.		

---

`[heading-size]` 

Starts with h1 size and decreases to h6 evenly

`[decrement]` 
	
The unit amount you would like to decrease between h tags

`[unit]` 

The font size unit you would like to use - rem, em, px

---
	
### Usage

@include heading-decrement-fixed( [ heading-size ], [ decrement ] , [ unit ] );

## Heading Increment - Fixed

Uses a heading-size (font size) and declares the increase amount in unit size.

---

`[heading-size]` 
	
Starts with h6 size and increases to h1 evenly

`[decrement]` 
	
The unit amount you would like to increase between h tags

`[unit]` 
	
The font size unit you would like to use - rem, em, px

---

### Usage

	@include heading-increment-fixed( [ heading-size ], [ decrement ] , [ unit ] );


[@troutacular]: https://github.com/troutacular
