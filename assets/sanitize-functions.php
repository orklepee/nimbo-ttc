<?php
/**
 * Data sanitization functions
 *
 * @package WordPress
 * @subpackage Nimbo
 * @since Nimbo 1.0
 */

/**
 * Number field (intval)
 *
 * @since Nimbo 1.0
 */
function nimbo_sanitize_number_intval( $input ) {
	if ( is_numeric( $input ) && $input >= 1 ) {
		return intval( $input );
	} else {
		return '';
	}
}


/**
 * Checkbox
 *
 * @since Nimbo 1.0
 */
function nimbo_sanitize_checkbox( $input ) {
	if ( 1 === (int) $input ) {
		return 1;
	} else {
		return 0;
	}
}


/**
 * HTML tags: a (+ href, title, target, class, rel), span (+ class), strong, b, em, i (+ class) (wp_kses)
 *
 * @since Nimbo 1.0
 */
function nimbo_sanitize_wp_kses_html_tags_title( $input ) {
	return wp_kses( $input, array(
		'a'			=> array(
			'href'		=> array(),
			'title'		=> array(),
			'target'	=> array(),
			'class'		=> array(),
			'rel'		=> array(),
		),
		'span'		=> array(
			'class'		=> array()
		),
		'strong'	=> array(),
		'b'			=> array(),
		'em'		=> array(),
		'i'			=> array(
			'class'		=> array()
		),
	) );
}


/**
 * HTML tags: a (+ href, title, target, class, rel), span (+ class), strong, b, em, i (+ class), br (wp_kses)
 *
 * @since Nimbo 1.0
 */
function nimbo_sanitize_wp_kses_html_tags_text( $input ) {
	return wp_kses( $input, array(
		'a'			=> array(
			'href'		=> array(),
			'title'		=> array(),
			'target'	=> array(),
			'class'		=> array(),
			'rel'		=> array(),
		),
		'span'		=> array(
			'class'		=> array()
		),
		'strong'	=> array(),
		'b'			=> array(),
		'em'		=> array(),
		'i'			=> array(
			'class'		=> array()
		),
		'br'		=> array(),
	) );
}


/**
 * HTML tags: p (+ class), a (+ href, title, target, class, rel), span (+ class), strong, b, em, i (+ class), br (wp_kses)
 *
 * @since Nimbo 1.0
 */
function nimbo_sanitize_wp_kses_html_tags_text_p( $input ) {
	return wp_kses( $input, array(
		'p'			=> array(
			'class'		=> array()
		),
		'a'			=> array(
			'href'		=> array(),
			'title'		=> array(),
			'target'	=> array(),
			'class'		=> array(),
			'rel'		=> array(),
		),
		'span'		=> array(
			'class'		=> array()
		),
		'strong'	=> array(),
		'b'			=> array(),
		'em'		=> array(),
		'i'			=> array(
			'class'		=> array()
		),
		'br'		=> array(),
	) );
}


/**
 * HTML tags: a (+ href, title, target, class, rel), span (+ class), i (+ class) (wp_kses)
 *
 * @since Nimbo 1.0
 */
function nimbo_sanitize_wp_kses_html_tags_links( $input ) {
	return wp_kses( $input, array(
		'a'			=> array(
			'href'		=> array(),
			'title'		=> array(),
			'target'	=> array(),
			'class'		=> array(),
			'rel'		=> array(),
		),
		'span'		=> array(
			'class'		=> array()
		),
		'i'			=> array(
			'class'		=> array()
		),
	) );
}


/**
 * Header type
 *
 * @since Nimbo 1.0
 */
function nimbo_sanitize_header_type( $input ) {
	$valid = array(
		'header-one-row'	=> 'Header: Type 1 - One row',
		'header-two-rows'	=> 'Header: Type 2 - Two rows',
	);

	if ( array_key_exists( $input, $valid ) ) {
		return $input;
	} else {
		return 'header-one-row'; // default
	}
}


/**
 * Menu type
 *
 * @since Nimbo 1.0
 */
function nimbo_sanitize_menu_type( $input ) {
	$valid = array(
		'hidden-menu'	=> 'Hidden menu',
		'visible-menu'	=> 'Visible menu',
	);

	if ( array_key_exists( $input, $valid ) ) {
		return $input;
	} else {
		return 'hidden-menu'; // default
	}
}


/**
 * Logo type
 *
 * @since Nimbo 1.0
 */
function nimbo_sanitize_logo_type( $input ) {
	$valid = array(
		'text'	=> 'Text',
		'image'	=> 'Image',
	);

	if ( array_key_exists( $input, $valid ) ) {
		return $input;
	} else {
		return 'text'; // default
	}
}


/**
 * Blog layout
 *
 * @since Nimbo 1.0
 */
function nimbo_sanitize_blog_layout( $input ) {
	$valid = array(
		'3-columns'					=> 'No sidebar',
		'2-columns-left-sidebar'	=> 'Left sidebar',
		'2-columns-right-sidebar'	=> 'Right sidebar',
	);

	if ( array_key_exists( $input, $valid ) ) {
		return $input;
	} else {
		return '3-columns'; // default
	}
}


/**
 * Post excerpt type
 *
 * @since Nimbo 1.0
 */
function nimbo_sanitize_excerpt_type( $input ) {
	$valid = array(
		'excerpt'	=> 'Excerpt',
		'more-tag'	=> 'Read More Tag',
	);

	if ( array_key_exists( $input, $valid ) ) {
		return $input;
	} else {
		return 'excerpt'; // default
	}
}


/**
 * Single post page: Layout
 *
 * @since Nimbo 1.4
 */
function nimbo_sanitize_single_post_global_layout( $input ) {
	$valid = array(
		'right_sidebar'	=> 'Post with right sidebar',
		'left_sidebar'	=> 'Post with left sidebar',
		'full_width'	=> 'Full width post (without sidebar)',
	);

	if ( array_key_exists( $input, $valid ) ) {
		return $input;
	} else {
		return 'right_sidebar'; // default
	}
}


/**
 * Single post page (full width post): Image size
 *
 * @since Nimbo 1.4
 */
function nimbo_sanitize_single_image_size( $input ) {
	$valid = array(
		'cropped'	=> 'Cropped image',
		'original'	=> 'Original size',
	);

	if ( array_key_exists( $input, $valid ) ) {
		return $input;
	} else {
		return 'cropped'; // default
	}
}


/**
 * Single page: Layout
 *
 * @since Nimbo 1.4
 */
function nimbo_sanitize_single_page_global_layout( $input ) {
	$valid = array(
		'right_sidebar'	=> 'Page with right sidebar',
		'left_sidebar'	=> 'Page with left sidebar',
		'full_width'	=> 'Full width page (without sidebar)',
	);

	if ( array_key_exists( $input, $valid ) ) {
		return $input;
	} else {
		return 'right_sidebar'; // default
	}
}


/**
 * Footer links type
 *
 * @since Nimbo 1.0
 */
function nimbo_sanitize_footer_links_type( $input ) {
	$valid = array(
		'menu'			=> 'Footer menu',
		'social-links'	=> 'Social links',
	);

	if ( array_key_exists( $input, $valid ) ) {
		return $input;
	} else {
		return 'menu'; // default
	}
}


/**
 * Color scheme (Light or Dark)
 *
 * @since Nimbo 1.1
 */
function nimbo_sanitize_color_scheme( $input ) {
	$valid = array(
		'light'	=> 'Light',
		'dark'	=> 'Dark',
	);

	if ( array_key_exists( $input, $valid ) ) {
		return $input;
	} else {
		return 'light'; // default
	}
}


/**
 * Dark style: Color switch icon type (Moon or Sun)
 *
 * @since Nimbo 1.2
 */
function nimbo_sanitize_dark_color_switch_icon_type( $input ) {
	$valid = array(
		'moon'	=> 'Moon icon',
		'sun'	=> 'Sun icon',
	);

	if ( array_key_exists( $input, $valid ) ) {
		return $input;
	} else {
		return 'moon'; // default
	}
}


/**
 * "Cookies information" window: Window type on mobile devices
 *
 * @since Nimbo 1.3
 */
function nimbo_sanitize_cookies_info_on_mobile( $input ) {
	$valid = array(
		'hidden-window'		=> 'Hidden window',
		'visible-window'	=> 'Visible window',
	);

	if ( array_key_exists( $input, $valid ) ) {
		return $input;
	} else {
		return 'hidden-window'; // default
	}
}
