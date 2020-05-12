# Minimum Viable WordPress

A single-file WordPress theme. Designed as a fallback in case [Timber](https://www.upstatement.com/timber/) fails to load, but it might be generally useful as a minimalist theme. Styled using lightly modified [MVP.css](https://andybrewer.github.io/mvp/).

## Supported Features

These WordPress features have been tested:

- Site name, tagline and custom logos
- Navigation menus
- Posts and pages
- Excerpts and `<!--more-->`
- Featured images (post thumbnails)
- Tags and categories

These should work but haven't been extensively tested:

- Forms
- Block editor (Gutenberg)
- Favicons

It does not support: 

- Translation / RTL languages
- 404 pages
- Search
- Authors and author pages
- Post formats
- Comments
- Sidebars and widgets
- Custom backgrounds, headers and footers
- Custom post types
- Custom taxonomies
- Custom fields

## Usage

### Within a Timber theme

Copy the index.php file to your theme and rename it `minimum-viable-wordpress.php`, then add this chunk of code to `functions.php` file:

```
if ( ! class_exists( 'Timber' ) ) {
	add_filter(
		'template_include',
		function( $template ) {
			return get_stylesheet_directory() . '/minimum-viable-wordpress.php';
		}
	);
	return;
}
```

This was tested with Timber 1.x.

### As a standalone theme

Download a copy of this repository and upload it to WordPress.

## Roadmap

- Fully fork [MVP.css](https://andybrewer.github.io/mvp/) instead of fighting it.
- Figure out how to detect 404 pages without using 404.php.

## Contributing

This project was designed to be extremely lean. Pull requests are welcome for minor bugfixes or enhancements. For major changes or additions, please open an issue and I'd be happy to discuss!

## License

[GPLv2](https://choosealicense.com/licenses/gpl-2.0/), as you do for WordPress.