<?php
/**
 * Functions and definitions
 *
 * For more information on hooks, actions, and filters, @link https://codex.wordpress.org/Plugin_API
 *
 * @package WordPress
 * @subpackage Nimbo
 * @since Nimbo 1.0
 */

/**
 * TGM Plugin Activation
 *
 * @since Nimbo 1.0
 */
require_once get_theme_file_path( '/assets/class-tgm-plugin-activation.php' );
require_once get_theme_file_path( '/assets/plugin-activation.php' );


/**
 * Theme meta boxes
 *
 * @since Nimbo 1.0
 */
require_once get_theme_file_path( '/assets/theme-meta-boxes.php' );


/*
 * Set up the content width value
 *
 * @since Nimbo 1.0
 */
if ( ! isset( $content_width ) ) {
	$content_width = 940;
}


/**
 * Sets up theme defaults and registers support for various WordPress features
 *
 * @since Nimbo 1.0
 */
if ( ! function_exists( 'nimbo_setup' ) ) {
	function nimbo_setup() {

		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 */
		load_theme_textdomain( 'nimbo', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		// Register menus
		register_nav_menus( array(
			'nimbo_main_menu'	=> esc_html__( 'Main menu', 'nimbo' ),
			'nimbo_footer_menu'	=> esc_html__( 'Footer menu', 'nimbo' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		/*
		 * Enable support for Post Formats.
		 *
		 * See: https://codex.wordpress.org/Post_Formats
		 */
		add_theme_support( 'post-formats', array(
			'image',
			'gallery',
			'video',
			'audio',
			'aside',
			'link',
			'quote',
			'status',
			'chat',
		) );

		// Enable support for Custom background
		$bg_default = array( 'default-color' => 'f7f8f8' );
		add_theme_support( 'custom-background', $bg_default );

		// Enable support for Custom logo
		add_theme_support( 'custom-logo', array(
			'height'		=> 33,
			'width'			=> 76,
			'flex-height'	=> true,
			'flex-width'	=> true,
		) );

		// Enable support for Custom header
		$header_bg_default = array(
			'width'			=> 2000,
			'height'		=> 1120,
			'flex-width'	=> true,
			'flex-height'	=> true,
			'header-text'	=> false,
		);
		add_theme_support( 'custom-header', $header_bg_default );

		// Add styles for TinyMCE editor (editor-style.css + fontawesome all.min.css + custom fonts (Lora, Source Sans Pro, and Playfair Display))
		add_editor_style( array(
			'css/editor-style.css',
			'assets/fontawesome/css/all.min.css',
			nimbo_editor_fonts_url(),
		) );

		// Enable support for wide and full images (Gutenberg)
		add_theme_support( 'align-wide' );

		// Enable support for responsive embeds (Gutenberg)
		add_theme_support( 'responsive-embeds' );

		// Enable support for Post Thumbnails
		add_theme_support( 'post-thumbnails' );
		set_post_thumbnail_size( 200, 200, true );

		// Registers a new image sizes
		add_image_size( 'nimbo-939x626-crop', 939, 626, true ); // it is used for "Posts slider widget" and "Posts list widget"
		add_image_size( 'nimbo-1200x500-crop', 1200, 500, true ); // it is used for single pages without sidebar (full width layout)
	}
}
add_action( 'after_setup_theme', 'nimbo_setup' );


/**
 * Register custom fonts (Google fonts)
 *
 * @since Nimbo 1.0
 */
if ( ! function_exists( 'nimbo_google_fonts_url' ) ) {
	function nimbo_google_fonts_url() {
		$font_url = '';

		/*
		Translators: If there are characters in your language that are not supported
		by chosen font(s), translate this to 'off'. Do not translate into your own language.
		*/
		if ( 'off' !== _x( 'on', 'Google fonts: on or off', 'nimbo' ) ) {

			// all Google fonts
			$main_font = 'Lora'; // main font
			$headings_font = 'Source Sans Pro'; // headings, logo text, menus, copyright text, and "cookies information" window
			$blockquote_font = 'Playfair Display'; // blockquote items
			$metadata_font = 'PT Sans'; // metadata

			// font styles
			// main font (Lora)
			$main_font_style = get_theme_mod( 'nimbo_main_font_style', '400,400i,700,700i' );
			if ( ! $main_font_style ) {
				$main_font_style = '400,400i,700,700i';
			}

			// font for headings (Source Sans Pro)
			$headings_font_style = get_theme_mod( 'nimbo_headings_font_style', '400,600,700' );
			if ( ! $headings_font_style ) {
				$headings_font_style = '400,600,700';
			}

			// blockquote items (Playfair Display)
			$blockquote_font_style = get_theme_mod( 'nimbo_blockquote_font_style', '400,400i' );
			if ( ! $blockquote_font_style ) {
				$blockquote_font_style = '400,400i';
			}

			// metadata (PT Sans)
			$metadata_font_style = get_theme_mod( 'nimbo_metadata_font_style', '400,700' );
			if ( ! $metadata_font_style ) {
				$metadata_font_style = '400,700';
			}

			// character sets
			$subset = get_theme_mod( 'nimbo_fonts_character_sets' );
			$subset = str_replace( ' ', '', $subset );

			// array of fonts with styles
			$fonts = array(
				$main_font . ':' . $main_font_style,
				$headings_font . ':' . $headings_font_style,
				$blockquote_font . ':' . $blockquote_font_style,
				$metadata_font . ':' . $metadata_font_style,
			);

			// query
			$query_args = array(
				'family'	=> urlencode( implode( '|', $fonts ) ),
				'subset'	=> urlencode( $subset ),
			);
			$font_url = add_query_arg( $query_args, '//fonts.googleapis.com/css' );

		}

		return esc_url_raw( $font_url );
	}
}


/**
 * Enqueue styles
 *
 * @since Nimbo 1.0
 */
if ( ! function_exists( 'nimbo_styles' ) ) {
	function nimbo_styles() {

		// Google fonts
		wp_enqueue_style( 'nimbo-google-fonts', nimbo_google_fonts_url(), array(), '1.4.3' );

		// bootstrap
		wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css', array(), '3.4.1' );
		wp_enqueue_style( 'bootstrap-theme', get_template_directory_uri() . '/css/bootstrap-theme.min.css', array(), '3.4.1' );

		// ie10 viewport bug workaround
		wp_enqueue_style( 'nimbo-ie10-viewport-bug-workaround', get_template_directory_uri() . '/css/ie10-viewport-bug-workaround.css', array(), '3.4.1' );

		// font awesome
		wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/assets/fontawesome/css/all.min.css', array(), '5.15.1' );

		// owl carousel
		wp_enqueue_style( 'owl-carousel', get_template_directory_uri() . '/assets/owlcarousel/assets/owl.carousel.min.css', array(), '2.3.4' );
		wp_enqueue_style( 'owl-theme-default', get_template_directory_uri() . '/assets/owlcarousel/assets/owl.theme.default.min.css', array(), '2.3.4' );

		// magnific popup
		wp_enqueue_style( 'magnific-popup', get_template_directory_uri() . '/assets/magnific-popup/magnific-popup.css', array(), '1.1.0' );

		// main stylesheet
		wp_enqueue_style( 'nimbo-style', get_stylesheet_directory_uri() . '/style.css', array(), '1.4.3' );

	}
}
add_action( 'wp_enqueue_scripts', 'nimbo_styles' );


/**
 * Enqueue scripts
 *
 * @since Nimbo 1.0
 */
if ( ! function_exists( 'nimbo_scripts' ) ) {
	function nimbo_scripts() {

		// html5shiv.js (for IE)
		wp_enqueue_script( 'html5shiv', get_template_directory_uri() . '/js/html5shiv.min.js', array(), '3.7.3', false );
		wp_script_add_data( 'html5shiv', 'conditional', 'lt IE 9' );

		// respond.js (for IE)
		wp_enqueue_script( 'respond', get_template_directory_uri() . '/js/respond.min.js', array(), '1.4.2', false );
		wp_script_add_data( 'respond', 'conditional', 'lt IE 9' );

		// bootstrap
		wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js', array( 'jquery' ), '3.4.1', true );

		// superfish
		wp_enqueue_script( 'superfish', get_template_directory_uri() . '/js/superfish.min.js', array( 'jquery' ), '1.7.10', true );

		// masonry
		if ( ! is_singular() ) {
			wp_enqueue_script( 'jquery-masonry' );
		}

		// owl carousel
		wp_enqueue_script( 'owl-carousel', get_template_directory_uri() . '/assets/owlcarousel/owl.carousel.min.js', array( 'jquery' ), '2.3.4', true );

		// magnific popup
		wp_enqueue_script( 'jquery-magnific-popup', get_template_directory_uri() . '/assets/magnific-popup/jquery.magnific-popup.min.js', array( 'jquery' ), '1.1.0', true );

		// IE10 viewport hack for Surface/desktop Windows 8 bug
		wp_enqueue_script( 'nimbo-ie10-viewport-bug-workaround', get_template_directory_uri() . '/js/ie10-viewport-bug-workaround.js', array(), '3.4.1', true );

		// nimbo theme js
		wp_enqueue_script( 'nimbo-theme', get_template_directory_uri() . '/js/nimbo-theme.js', array( 'jquery' ), '1.1.0', true );

		// comments
		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}

		// nimbo theme data
		$isMobile_data = ( wp_is_mobile() ) ? 'true' : 'false';
		$isSingular_data = ( is_singular() ) ? 'true' : 'false';
		$isAdminBarShowing_data = ( is_admin_bar_showing() ) ? 'true' : 'false';

		// header type
		$headerType_data = get_theme_mod( 'nimbo_header_type', 'header-one-row' ); // 'header-one-row' or 'header-two-rows'

		// sticky header: enabled or disabled
		$sticky_header_enabled = get_theme_mod( 'nimbo_enable_sticky_header', 1 ); // 1 or 0
		$stickyHeader_data = ( $sticky_header_enabled ) ? 'on' : 'off';

		// logo type
		$logoType_data = get_theme_mod( 'nimbo_logo_type', 'text' ); // 'text' or 'image'

		// menu type
		$menuType_data = get_theme_mod( 'nimbo_menu_type', 'hidden-menu' ); // 'hidden-menu' or 'visible-menu'

		// color switch: enabled or disabled
		$color_switch_enabled = get_theme_mod( 'nimbo_enable_color_switch', 0 ); // 1 or 0
		$colorSwitch_data = ( $color_switch_enabled ) ? 'on' : 'off';

		// dark style: color switch icon type
		$darkColorSwitchIconType_data = get_theme_mod( 'nimbo_dark_color_switch_icon_type', 'moon' ); // 'moon' or 'sun'

		// dropdown search form: show or hide
		$show_search = get_theme_mod( 'nimbo_show_search', 1 ); // 1 or 0
		$dropdownSearch_data = ( $show_search ) ? 'show' : 'hide';

		// blog layout: masonryColumnWidth value
		$blog_layout = get_theme_mod( 'nimbo_blog_layout', '3-columns' ); // '3-columns', '2-columns-left-sidebar', or '2-columns-right-sidebar'
		$masonryColumnWidth_data = ( '3-columns' === $blog_layout ) ? '.bwp-col-3-default' : '.bwp-col-2-default';

		// "Back to top" button: show or hide
		$show_to_top_button = get_theme_mod( 'nimbo_show_to_top_button', 1 ); // 1 or 0
		$toTopButton_data = ( $show_to_top_button ) ? 'show' : 'hide';

		// color switch: cookies enabled or disabled
		$color_switch_cookies_enabled = get_theme_mod( 'nimbo_color_switch_enable_cookies', 1 ); // 1 or 0
		$colorSwitchCookies_data = ( $color_switch_cookies_enabled ) ? 'on' : 'off';

		// nimbo theme data array
		$nimboData_array = array(
			'isMobile'					=> $isMobile_data,
			'isSingular'				=> $isSingular_data,
			'isAdminBarShowing'			=> $isAdminBarShowing_data,
			'headerType'				=> $headerType_data,
			'stickyHeader'				=> $stickyHeader_data,
			'logoType'					=> $logoType_data,
			'menuType'					=> $menuType_data,
			'colorSwitch'				=> $colorSwitch_data,
			'darkColorSwitchIconType'	=> $darkColorSwitchIconType_data,
			'dropdownSearch'			=> $dropdownSearch_data,
			'masonryColumnWidth'		=> $masonryColumnWidth_data,
			'toTopButton'				=> $toTopButton_data,
			'colorSwitchCookies'		=> $colorSwitchCookies_data,
		);
		wp_localize_script( 'nimbo-theme', 'nimboData', $nimboData_array );

	}
}
add_action( 'wp_enqueue_scripts', 'nimbo_scripts' );


/**
 * Enqueue styles for WordPress Customizer
 *
 * @since Nimbo 1.0
 */
if ( ! function_exists( 'nimbo_customizer_styles' ) ) {
	function nimbo_customizer_styles() {
		// styles for additional customize controls
		wp_enqueue_style( 'nimbo-customizer-style', get_template_directory_uri() . '/css/customizer-style.css', array(), '1.0.1' );
	}
}
add_action( 'customize_controls_print_styles', 'nimbo_customizer_styles' );


/**
 * Enqueue styles and scripts for Gutenberg (Admin side)
 *
 * @since Nimbo 1.4.2
 */
if ( ! function_exists( 'nimbo_gutenberg_styles_scripts' ) ) {
	function nimbo_gutenberg_styles_scripts() {

		/**
		 * Enqueue styles:
		 */

		// Google fonts
		wp_enqueue_style( 'nimbo-gutenberg-editor-fonts', nimbo_editor_fonts_url(), array(), '1.4.3' );
		// font awesome
		wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/assets/fontawesome/css/all.min.css', array(), '5.15.1' );
		// general editor styles
		wp_enqueue_style( 'nimbo-gutenberg-editor-style', get_template_directory_uri() . '/css/gutenberg-editor-style.css', array(), '3.0.2' );

		/**
		 * Enqueue scripts:
		 */

		// show/hide meta boxes (Gutenberg)
		wp_enqueue_script( 'nimbo-gutenberg-meta-boxes', get_template_directory_uri() . '/js/nimbo-gutenberg-meta-boxes.js', array( 'jquery' ), '1.0.0', true );

	}
}
add_action( 'enqueue_block_editor_assets', 'nimbo_gutenberg_styles_scripts' );


/**
 * Enqueue scripts (Admin side)
 *
 * @since Nimbo 1.0
 */
if ( ! function_exists( 'nimbo_admin_scripts' ) ) {
	function nimbo_admin_scripts( $hook ) {
		// add scripts only to the post creation/editing page
		if ( 'post-new.php' !== $hook && 'post.php' !== $hook ) {
			return; // stop this function
		}
		// meta boxes
		wp_enqueue_script( 'nimbo-meta-boxes', get_template_directory_uri() . '/js/nimbo-meta-boxes.js', array( 'jquery' ), '1.0.0', true );
	}
}
add_action( 'admin_enqueue_scripts', 'nimbo_admin_scripts' );


/**
 * Register custom fonts for TinyMCE and Gutenberg editors
 *
 * @since Nimbo 1.0
 */
if ( ! function_exists( 'nimbo_editor_fonts_url' ) ) {
	function nimbo_editor_fonts_url() {
		$font_url = '';

		/*
		Translators: If there are characters in your language that are not supported
		by chosen font(s), translate this to 'off'. Do not translate into your own language.
		*/
		if ( 'off' !== _x( 'on', 'Google fonts: on or off', 'nimbo' ) ) {

			// all Google fonts
			$main_font = 'Lora';
			$headings_font = 'Source Sans Pro';
			$blockquote_font = 'Playfair Display';

			// font styles
			// main font (Lora)
			$main_font_style = get_theme_mod( 'nimbo_main_font_style', '400,400i,700,700i' );
			if ( ! $main_font_style ) {
				$main_font_style = '400,400i,700,700i';
			}

			// font for headings (Source Sans Pro)
			$headings_font_style = get_theme_mod( 'nimbo_headings_font_style', '400,600,700' );
			if ( ! $headings_font_style ) {
				$headings_font_style = '400,600,700';
			}

			// blockquote items (Playfair Display)
			$blockquote_font_style = get_theme_mod( 'nimbo_blockquote_font_style', '400,400i' );
			if ( ! $blockquote_font_style ) {
				$blockquote_font_style = '400,400i';
			}

			// character sets
			$subset = get_theme_mod( 'nimbo_fonts_character_sets' );
			$subset = str_replace( ' ', '', $subset );

			// array of fonts with styles
			$fonts = array(
				$main_font . ':' . $main_font_style,
				$headings_font . ':' . $headings_font_style,
				$blockquote_font . ':' . $blockquote_font_style,
			);

			// query
			$query_args = array(
				'family'	=> urlencode( implode( '|', $fonts ) ),
				'subset'	=> urlencode( $subset ),
			);
			$font_url = add_query_arg( $query_args, '//fonts.googleapis.com/css' );

		}

		return esc_url_raw( $font_url );
	}
}


/**
 * Change excerpt length
 *
 * @since Nimbo 1.0
 */
if ( ! function_exists( 'nimbo_new_excerpt_length' ) ) {
	function nimbo_new_excerpt_length( $length ) {
		$new_excerpt_length = get_theme_mod( 'nimbo_excerpt_length', 25 );

		if ( $new_excerpt_length ) {
			$new_excerpt_length = intval( $new_excerpt_length );
		} else {
			$new_excerpt_length = 25;
		}

		return $new_excerpt_length;
	}
}
add_filter( 'excerpt_length', 'nimbo_new_excerpt_length' );


/**
 * Add the "Read more" link to the end of the post excerpt
 *
 * @since Nimbo 1.0
 */
if ( ! function_exists( 'nimbo_new_excerpt_more' ) ) {
	function nimbo_new_excerpt_more( $more ) {
		return '... <a href="' . esc_url( get_permalink( get_the_ID() ) ) . '" class="bwp-excerpt-more-link">' . esc_html__( 'Read more', 'nimbo' ) . '</a>';
	}
}
add_filter( 'excerpt_more', 'nimbo_new_excerpt_more' );


/**
 * Returns URL from post content (used for link format)
 *
 * @since Nimbo 1.0
 */
if ( ! function_exists( 'nimbo_get_link_url' ) ) {
	function nimbo_get_link_url() {
		$has_url = get_url_in_content( get_the_content() );
		return $has_url ? $has_url : apply_filters( 'the_permalink', get_permalink() );
	}
}


/**
 * Returns a current theme style (light style or dark style)
 *
 * @since Nimbo 1.0
 */
if ( ! function_exists( 'nimbo_get_current_theme_style' ) ) {
	function nimbo_get_current_theme_style() {
		// default theme style
		$default_theme_style = get_theme_mod( 'nimbo_default_color_scheme', 'light' ); // 'light' or 'dark'
		// color switch: cookies enabled or disabled
		$color_switch_cookies_enabled = get_theme_mod( 'nimbo_color_switch_enable_cookies', 1 ); // 1 or 0

		// if cookies are enabled
		if ( $color_switch_cookies_enabled ) {

			// color switch: enabled or disabled
			$color_switch_enabled = get_theme_mod( 'nimbo_enable_color_switch', 0 ); // 1 or 0

			// if the color switch is enabled
			if ( $color_switch_enabled ) {

				// get current theme style
				$current_theme_style = ( ! empty( $_COOKIE['nimbo_site_style'] ) ) ? $_COOKIE['nimbo_site_style'] : $default_theme_style;
				return $current_theme_style; // light or dark

			}

		}

		// return the default theme style
		return $default_theme_style; // light or dark
	}
}


/**
 * The function adds the wp_body_open action for backward compatibility to support WordPress versions prior to 5.2.0
 *
 * @since Nimbo 1.4.2
 */
if ( ! function_exists( 'wp_body_open' ) ) {
	function wp_body_open() {
		/**
		 * Triggered after the opening "body" tag
		 */
		do_action( 'wp_body_open' );
	}
}


/**
 * The function adds additional classes to the "body" element
 *
 * @since Nimbo 1.0
 */
if ( ! function_exists( 'nimbo_custom_body_classes' ) ) {
	function nimbo_custom_body_classes( $classes ) {
		// get current theme style
		$current_theme_style = nimbo_get_current_theme_style(); // dark or light
		// sticky header: is the option enabled or not?
		$sticky_header_enabled = get_theme_mod( 'nimbo_enable_sticky_header', 1 ); // 1 or 0
		// header type
		$header_type = get_theme_mod( 'nimbo_header_type', 'header-one-row' ); // 'header-one-row' or 'header-two-rows'

		// add new classes
		if ( 'header-two-rows' === $header_type ) {
			// header type 2
			if ( 'dark' === $current_theme_style && $sticky_header_enabled ) {
				$classes[] = 'bwp-dark-style';
				$classes[] = 'bwp-sticky-header-two-rows';
			} elseif ( 'dark' === $current_theme_style ) {
				$classes[] = 'bwp-dark-style';
			} elseif ( $sticky_header_enabled ) {
				$classes[] = 'bwp-sticky-header-two-rows';
			}
		} else {
			// header type 1
			if ( 'dark' === $current_theme_style && $sticky_header_enabled ) {
				$classes[] = 'bwp-dark-style';
				$classes[] = 'bwp-sticky-header-one-row';
			} elseif ( 'dark' === $current_theme_style ) {
				$classes[] = 'bwp-dark-style';
			} elseif ( $sticky_header_enabled ) {
				$classes[] = 'bwp-sticky-header-one-row';
			}
		}

		return $classes;
	}
}
add_filter( 'body_class', 'nimbo_custom_body_classes' );


/**
 * The function adds additional classes to posts
 *
 * @since Nimbo 1.0
 */
if ( ! function_exists( 'nimbo_custom_post_classes' ) ) {
	function nimbo_custom_post_classes( $classes, $class, $post_id ) {
		if ( ! is_singular() ) {
			// blog layout
			$blog_layout = get_theme_mod( 'nimbo_blog_layout', '3-columns' ); // '3-columns', '2-columns-left-sidebar', or '2-columns-right-sidebar'
			// add new classes
			$classes[] = 'bwp-masonry-item';
			$classes[] = ( '3-columns' === $blog_layout ) ? 'bwp-col-3' : 'bwp-col-2';
		} else {
			// single post/page
			if ( is_single( $post_id ) ) {
				// get post format
				$blog_post_format = get_post_format( $post_id );
				if ( false === $blog_post_format ) {
					$blog_post_format = 'standard';
				}
				// add new classes
				$classes[] = 'bwp-single-post-article';
				switch ( $blog_post_format ) {
					case 'aside':
						$classes[] = 'bwp-post-aside-format';
						break;
					case 'link':
						$classes[] = 'bwp-post-link-format';
						break;
					case 'quote':
						$classes[] = 'bwp-post-quote-format';
						break;
					case 'status':
						$classes[] = 'bwp-post-status-format';
						break;
					case 'chat':
						$classes[] = 'bwp-post-chat-format';
						break;
				}
			} elseif ( is_page( $post_id ) ) {
				// add new classes
				$classes[] = 'bwp-single-post-article';
				$classes[] = 'bwp-page-article';
			}
		}

		return $classes;
	}
}
add_filter( 'post_class', 'nimbo_custom_post_classes', 10, 3 );


/**
 * The function displays a custom logo (image or text)
 *
 * @since Nimbo 1.0
 */
if ( ! function_exists( 'nimbo_show_custom_logo' ) ) {
	function nimbo_show_custom_logo() {
		// logo type
		$logo_type = get_theme_mod( 'nimbo_logo_type', 'text' ); // 'text' or 'image'

		// text
		if ( 'text' === $logo_type ) {
			// logo text
			$logo_text = get_theme_mod( 'nimbo_logo_text', 'Nimbo' );
			if ( $logo_text ) {
				?>

				<!-- logo (text) -->
				<div class="bwp-logo-container bwp-logo-text-container">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="bwp-logo-text">
						<?php echo esc_html( $logo_text ); ?>
					</a>
				</div>
				<!-- end: logo -->

				<?php
			}
		// image
		} else {
			if ( function_exists( 'the_custom_logo' ) ) {
				if ( has_custom_logo() ) {
					// logo for light theme style (default logo)
					$custom_logo_id = get_theme_mod( 'custom_logo' );
					$custom_logo_url = wp_get_attachment_image_url( $custom_logo_id, 'full' );
					// logo for dark theme style (optional)
					$dark_logo_url = get_theme_mod( 'nimbo_dark_logo_image' );
					// logo alt
					$custom_logo_alt = get_post_meta( $custom_logo_id, '_wp_attachment_image_alt', true );
					// get current theme style
					$current_theme_style = nimbo_get_current_theme_style(); // dark or light
					?>

					<!-- logo (image) -->
					<div id="bwp-custom-logo" class="bwp-logo-container bwp-logo-image-container"
						 data-logo-url="<?php echo esc_url( $custom_logo_url ); ?>"
						 data-dark-logo-url="<?php if ( $dark_logo_url ) { echo esc_url( $dark_logo_url ); } else { echo 'none'; } ?>"
						 data-logo-alt="<?php if ( $custom_logo_alt ) { echo esc_attr( $custom_logo_alt ); } else { echo get_bloginfo( 'name', 'display' ); } ?>">

						<?php
						if ( 'dark' === $current_theme_style && $dark_logo_url ) {
							?>
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="custom-logo-link" rel="home" itemprop="url">
								<img src="<?php echo esc_url( $dark_logo_url ); ?>" class="custom-logo" alt="<?php if ( $custom_logo_alt ) { echo esc_attr( $custom_logo_alt ); } else { echo get_bloginfo( 'name', 'display' ); } ?>" itemprop="logo">
							</a>
							<?php
						} else {
							the_custom_logo();
						}
						?>

					</div>
					<!-- end: logo -->

					<?php
				} else {
					// if a logo is not set, show empty block (only for JavaScript needs)
					?>

					<!-- logo (empty block) -->
					<div id="bwp-custom-logo" data-logo-url="none" data-dark-logo-url="none" data-logo-alt="none"></div>
					<!-- end: logo (empty block) -->

					<?php
				}
			}
		}
	}
}


/**
 * The function displays a dropdown search form
 *
 * @since Nimbo 1.0
 */
if ( ! function_exists( 'nimbo_show_dropdown_search' ) ) {
	function nimbo_show_dropdown_search() {
		$show_search = get_theme_mod( 'nimbo_show_search', 1 ); // 1 or 0
		if ( $show_search ) {
			?>

			<!-- search -->
			<div class="bwp-header-search-container">
				<!-- search icon -->
				<a href="#" rel="nofollow" id="bwp-show-dropdown-search" class="bwp-header-search-icon">
					<i class="fas fa-search"></i>
				</a>
				<!-- end: search icon -->
				<!-- container with search form -->
				<div id="bwp-dropdown-search" class="bwp-dropdown-search-container bwp-hidden">
					<?php
					// show search form
					get_search_form();
					?>
				</div>
				<!-- end: container with search form -->
			</div>
			<!-- end: search -->

			<?php
		}
	}
}


/**
 * The function displays a color switch (moon or sun icon)
 *
 * @since Nimbo 1.0
 */
if ( ! function_exists( 'nimbo_show_color_switch' ) ) {
	function nimbo_show_color_switch() {
		// is the color switch on or off?
		$color_switch_enabled = get_theme_mod( 'nimbo_enable_color_switch', 0 ); // 1 or 0
		if ( $color_switch_enabled ) {
			// get current theme style
			$current_theme_style = nimbo_get_current_theme_style(); // dark or light
			// get icon type (dark style)
			$dark_color_switch_icon_type = get_theme_mod( 'nimbo_dark_color_switch_icon_type', 'moon' ); // moon or sun
			?>

			<!-- color switch -->
			<a href="#" rel="nofollow" id="bwp-color-switch" class="bwp-color-switch-icon">
				<?php
				if ( 'dark' === $current_theme_style ) {
					if ( 'moon' === $dark_color_switch_icon_type ) {
						?>
						<i class="fas fa-moon"></i>
						<?php
					} else {
						?>
						<i class="fas fa-sun"></i>
						<?php
					}
				} else {
					?>
					<i class="far fa-moon"></i>
					<?php
				}
				?>
			</a>
			<!-- end: color switch -->

			<?php
		}
	}
}


/**
 * The function displays a main menu (hidden or visible menu)
 *
 * @since Nimbo 1.0
 */
if ( ! function_exists( 'nimbo_show_main_menu' ) ) {
	function nimbo_show_main_menu() {
		// menu type
		$menu_type = get_theme_mod( 'nimbo_menu_type', 'hidden-menu' ); // 'hidden-menu' or 'visible-menu'
		if ( 'hidden-menu' === $menu_type ) {
			?>

			<!-- menu (hidden) -->
			<div class="bwp-header-menu-container hidden-sm hidden-xs">
				<!-- menu icon -->
				<a href="#" rel="nofollow" id="bwp-show-main-menu" class="bwp-main-menu-icon">
					<span></span>
				</a>
				<!-- end: menu icon -->
				<!-- container with menu -->
				<div id="bwp-main-menu" class="bwp-main-menu-container bwp-hidden">
					<?php
					wp_nav_menu( array(
						'theme_location'	=> 'nimbo_main_menu',
						'container'			=> 'nav',
						'menu_class'		=> 'sf-menu',
					) );
					?>
				</div>
				<!-- end: container with menu -->
			</div>
			<!-- end: menu (hidden) -->

			<?php
		} else {
			?>

			<!-- menu (visible) -->
			<div class="bwp-header-menu-container bwp-visible hidden-sm hidden-xs">
				<?php
				wp_nav_menu( array(
					'theme_location'	=> 'nimbo_main_menu',
					'container'			=> 'nav',
					'menu_class'		=> 'sf-menu',
				) );
				?>
			</div>
			<!-- end: menu (visible) -->

			<?php
		}
	}
}


/**
 * The function displays a menu for mobile devices
 *
 * @since Nimbo 1.0
 */
if ( ! function_exists( 'nimbo_show_mobile_menu' ) ) {
	function nimbo_show_mobile_menu() {
		?>

		<!-- mobile menu -->
		<div class="bwp-header-sm-menu-container hidden-md hidden-lg">
			<!-- menu icon -->
			<a href="#" rel="nofollow" id="bwp-show-sm-main-menu" class="bwp-main-menu-icon">
				<span></span>
			</a>
			<!-- end: menu icon -->
			<!-- container with menu (dropdown container) -->
			<div id="bwp-sm-main-menu" class="bwp-sm-main-menu-container bwp-hidden">
				<?php
				wp_nav_menu( array(
					'theme_location'	=> 'nimbo_main_menu',
					'container'			=> 'nav',
					'menu_class'		=> 'bwp-sm-menu list-unstyled',
				) );
				?>
			</div>
			<!-- end: container with menu -->
		</div>
		<!-- end: mobile menu -->

		<?php
	}
}


/**
 * The function displays a heading for all archive pages
 *
 * @since Nimbo 1.0
 */
if ( ! function_exists( 'nimbo_show_archive_heading' ) ) {
	function nimbo_show_archive_heading() {
		// author page
		if ( is_author() ) {
			// get author data
			$author_id = get_the_author_meta( 'ID' );
			$author_display_name = get_the_author_meta( 'display_name' );
			// show or hide avatars (WordPress Settings > Discussion > Avatars > Avatar Display: Show Avatars)
			$show_avatars = get_option( 'show_avatars' );
			?>

			<!-- archive heading (author page) -->
			<div class="bwp-author-heading-container clearfix<?php echo ( ! $show_avatars ) ? ' bwp-no-avatars' : ''; ?>">
				<?php if ( $show_avatars ) { ?>
					<!-- avatar -->
					<figure class="bwp-author-heading-avatar">
						<?php echo get_avatar( $author_id, '144', '', esc_attr( $author_display_name ) ); ?>
					</figure>
					<!-- end: avatar -->
				<?php } ?>
				<!-- biographical info -->
				<div class="bwp-author-heading-bio-wrap">
					<h1 class="bwp-archive-title">
						<?php echo esc_html( $author_display_name ); ?>
					</h1>
					<?php if ( get_the_author_meta( 'description' ) ) { ?>
						<div class="bwp-archive-description">
							<?php the_author_meta( 'description' ); ?>
						</div>
					<?php } ?>
					<?php
					// social links
					if ( function_exists( 'nimbo_social_media_author_links' ) ) {
						nimbo_social_media_author_links();
					}
					?>
				</div>
				<!-- end: biographical info -->
			</div>
			<!-- end: archive heading -->

			<?php
		// end: author page; start: category or tag page
		} elseif ( is_category() || is_tag() ) {
			?>

			<!-- archive heading (category/tag page) -->
			<div class="bwp-archive-heading-container">
				<h1 class="bwp-archive-title">
					<?php the_archive_title(); ?>
				</h1>
				<?php if ( get_the_archive_description() ) { ?>
					<div class="bwp-archive-description">
						<?php the_archive_description(); ?>
					</div>
				<?php } ?>
			</div>
			<!-- end: archive heading -->

			<?php
		// end: category or tag page; start: search results page
		} elseif ( is_search() ) {
			?>

			<!-- archive heading (search results page) -->
			<div class="bwp-archive-heading-container">
				<h1 class="bwp-archive-title">
					<?php echo esc_html__( 'Search results for:', 'nimbo' ) . '<span class="bwp-search-query-text">' . esc_html( get_search_query() ) . '</span>'; ?>
				</h1>
				<?php
				// the number of found posts
				global $wp_query;
				$search_results_number_escaped = (int) $wp_query->found_posts; // this variable has been safely escaped
				if ( 0 !== $search_results_number_escaped ) {
					?>
					<div class="bwp-archive-description">
						<?php
						echo esc_html__( 'Found:', 'nimbo' ) . '<span class="bwp-search-results-number">' . $search_results_number_escaped . '</span>';
						echo ( 1 === $search_results_number_escaped ) ? esc_html__( 'Post', 'nimbo' ) : esc_html__( 'Posts', 'nimbo' );
						?>
					</div>
					<?php
				}
				?>
			</div>
			<!-- end: archive heading -->

			<?php
		// end: search results page; start: archive page
		} elseif ( is_archive() ) {
			?>

			<!-- archive heading (archive page) -->
			<div class="bwp-archive-heading-container">
				<h1 class="bwp-archive-title">
					<?php the_archive_title(); ?>
				</h1>
			</div>
			<!-- end: archive heading -->

			<?php
		// end: archive page; start: all other pages
		} else {
			?>

			<h2 class="screen-reader-text">
				<?php esc_html_e( 'Blog posts', 'nimbo' ); ?>
			</h2>

			<?php
		}
	}
}


/**
 * The function displays a date at the top of each post
 *
 * @since Nimbo 1.0
 */
if ( ! function_exists( 'nimbo_show_post_date' ) ) {
	function nimbo_show_post_date( $post_type = 'post' ) {
		if ( 'post' === $post_type ) {
			// year, month, day
			$archive_year = get_the_time( 'Y' );
			$archive_month = get_the_time( 'm' );
			$archive_day = get_the_time( 'd' );
		}
		?>

		<!-- date -->
		<div class="bwp-post-date<?php echo ( ! get_the_title() ) ? ' bwp-no-title' : ''; ?>">
			<?php if ( 'post' === $post_type ) { ?>
				<a href="<?php echo esc_url( get_day_link( $archive_year, $archive_month, $archive_day ) ); ?>">
					<span class="date updated"><?php the_time( get_option( 'date_format' ) ); ?></span>
				</a>
			<?php } else { ?>
				<a href="<?php the_permalink(); ?>">
					<span class="date updated"><?php the_time( get_option( 'date_format' ) ); ?></span>
				</a>
			<?php } ?>
		</div>
		<!-- end: date -->

		<?php
	}
}


/**
 * The function displays a link to single post page
 *
 * @since Nimbo 1.0
 */
if ( ! function_exists( 'nimbo_show_post_permalink' ) ) {
	function nimbo_show_post_permalink( $post_format = '' ) {
		$show_link = ( 'link' === $post_format || 'status' === $post_format || ! get_the_title() ) ? true : false;
		if ( $show_link ) {
			?>

			<!-- link to single page -->
			<a href="<?php the_permalink(); ?>" class="bwp-post-link-to-single-page" title="<?php esc_attr_e( 'Read more', 'nimbo' ); ?>">
				<i class="fas fa-share"></i>
			</a>
			<!-- end: link to single page -->

			<?php
		}
	}
}


/**
 * The function displays a content of a post (post title and post excerpt)
 *
 * @since Nimbo 1.0
 */
if ( ! function_exists( 'nimbo_show_post_content' ) ) {
	function nimbo_show_post_content( $post_format ) {

		// excerpt type
		$excerpt_type = get_theme_mod( 'nimbo_post_excerpt_type', 'excerpt' ); // 'excerpt' or 'more-tag'

		// formats that use excerpt
		$post_formats_with_excerpt = array(
			'standard',
			'image',
			'gallery',
			'audio',
			'video',
		);
		$post_with_excerpt = ( in_array( $post_format, $post_formats_with_excerpt ) ) ? true : false;

		// title
		if ( get_the_title() ) {
			// link format
			if ( 'link' === $post_format ) {
				// get url
				$link_url = nimbo_get_link_url();
				// target attribute
				$get_link_target = get_post_meta( get_the_ID(), 'nimbo_mb_link_target', true ); // self / blank
				if ( ! $get_link_target ) {
					$get_link_target = 'blank'; // default
				}
				$link_target = ( 'blank' === $get_link_target ) ? '_blank' : '_self';
			}
			?>

			<!-- title -->
			<h3 class="bwp-post-title entry-title">
				<?php if ( 'link' === $post_format ) { ?>
					<a href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"<?php if ( '_blank' === $link_target ) { echo ' rel="noopener"'; } ?>><?php the_title(); ?></a>
				<?php } else { ?>
					<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
				<?php } ?>
			</h3>
			<!-- end: title -->

			<?php
		} // end: title

		// excerpt (the_excerpt)
		if ( $post_with_excerpt && 'excerpt' === $excerpt_type ) {
			?>

			<!-- excerpt -->
			<div class="bwp-post-excerpt entry-content">
				<?php the_excerpt(); ?>
			</div>
			<!-- end: excerpt -->

			<?php
		// end: excerpt; start: post content (the_content)
		} else {
			?>

			<!-- excerpt (post content) -->
			<div class="bwp-content entry-content clearfix">
				<?php the_content( esc_html__( 'Read more', 'nimbo' ), false ); ?>
			</div>
			<!-- end: excerpt (post content) -->

			<?php
		} // end: post content

	}
}


/**
 * The function displays an author of a post (avatar and name)
 *
 * @since Nimbo 1.0
 */
if ( ! function_exists( 'nimbo_show_post_author' ) ) {
	function nimbo_show_post_author( $show_avatar ) {
		// author data: id, name, and author posts url
		$author_id = get_the_author_meta( 'ID' );
		$author_display_name = get_the_author_meta( 'display_name' );
		$author_posts_url = get_author_posts_url( $author_id );
		?>

		<!-- author -->
		<div class="bwp-post-author">
			<?php if ( $show_avatar ) { ?>
				<figure class="bwp-post-author-avatar">
					<a href="<?php echo esc_url( $author_posts_url ); ?>" title="<?php echo esc_attr__( 'Posted by', 'nimbo' ) . ' ' . esc_attr( $author_display_name ); ?>">
						<?php echo get_avatar( $author_id, '72', '', esc_attr( $author_display_name ) ); ?>
						<div class="bwp-avatar-bg-overlay"></div>
					</a>
				</figure>
			<?php } ?>
			<div class="bwp-post-author-name">
				<a href="<?php echo esc_url( $author_posts_url ); ?>" title="<?php echo esc_attr__( 'Posted by', 'nimbo' ) . ' ' . esc_attr( $author_display_name ); ?>" rel="author">
					<span class="vcard author">
						<span class="fn"><?php echo esc_html( $author_display_name ); ?></span>
					</span>
				</a>
			</div>
		</div>
		<!-- end: author -->

		<?php
	}
}


/**
 * The function displays icons at the bottom of each post (heart and social share)
 *
 * @since Nimbo 1.0
 */
if ( ! function_exists( 'nimbo_show_post_icons' ) ) {
	function nimbo_show_post_icons() {
		// if there are functions for displaying icons
		if ( function_exists( 'nimbo_social_media_get_like' ) && function_exists( 'nimbo_social_media_post_share' ) ) {

			// heart icon: show or hide ("I like" counter)
			$show_like_counter = get_theme_mod( 'nimbo_show_like_counter', 1 ); // 1 or 0
			// share icon: show or hide (social share buttons)
			$show_share_buttons = get_theme_mod( 'nimbo_show_share_buttons', 1 ); // 1 or 0

			// show icons
			if ( $show_like_counter || $show_share_buttons ) {

				// author: show or hide
				$show_author = get_theme_mod( 'nimbo_show_author', 1 ); // 1 or 0
				?>

				<!-- icons -->
				<div class="bwp-post-icons<?php if ( ! $show_author ) { echo ' bwp-no-post-author'; } ?>">

					<?php if ( $show_like_counter ) { ?>
						<!-- heart -->
						<div class="bwp-post-likes">
							<?php echo nimbo_social_media_get_like( get_the_ID() ); ?>
						</div>
						<!-- end: heart -->
					<?php } ?>

					<?php
					// social share buttons
					if ( $show_share_buttons ) {
						nimbo_social_media_post_share();
					}
					?>

				</div>
				<!-- end: icons -->

				<?php
			}
		}
	}
}


/**
 * The function displays several recent comments
 *
 * @since Nimbo 1.0
 */
if ( ! function_exists( 'nimbo_show_post_recent_comments' ) ) {
	function nimbo_show_post_recent_comments( $show_avatar ) {
		// recent comments: show or hide
		$show_recent_comments = get_theme_mod( 'nimbo_show_recent_comments', 1 ); // 1 or 0
		if ( $show_recent_comments ) {
			// comments number (maximum value)
			$recent_comments_number = get_theme_mod( 'nimbo_recent_comments_number', 3 );
			// arguments
			$recent_comments_args = array(
				'post_id'		=> get_the_ID(),
				'post_type'		=> 'post',
				'status'		=> 'approve',
				'orderby'		=> 'comment_date_gmt',
				'order'			=> 'DESC',
				'number'		=> (int) $recent_comments_number,
				'type'			=> 'comment',
				'hierarchical'	=> 'threaded',
			);
			// get and show comments
			if ( $recent_comments = get_comments( $recent_comments_args ) ) {
				// comment content: number of words (maximum value)
				$comment_words_number = get_theme_mod( 'nimbo_comment_words_number', 8 );
				?>

				<!-- recent comments -->
				<div class="bwp-post-comments">

					<h4 class="bwp-post-comments-title">
						<i class="fas fa-comment fa-fw"></i><?php esc_html_e( 'Recent comments', 'nimbo' ); ?>
					</h4>

					<ul class="bwp-post-comments-list list-unstyled clearfix">

						<?php
						foreach ( $recent_comments as $comment ) {
							// current comment data: id, author email, author name, and comment content (trimmed)
							$current_comment_id = $comment->comment_ID;
							$current_comment_author_email = $comment->comment_author_email;
							$current_comment_author_name = $comment->comment_author;
							$current_comment_content = wp_trim_words( $comment->comment_content, (int) $comment_words_number );
							?>

							<!-- comment -->
							<li>
								<?php if ( $show_avatar ) { ?>
									<figure class="bwp-post-comment-author-avatar">
										<?php echo get_avatar( $current_comment_author_email, '72', '', esc_attr( $current_comment_author_name ) ); ?>
									</figure>
								<?php } ?>
								<div class="bwp-post-comment-content">
									<span class="bwp-post-comment-author"><?php echo esc_html( $current_comment_author_name ); ?></span>
									<div class="bwp-post-comment-excerpt">
										<a href="<?php the_permalink(); ?>#comment-<?php echo (int) $current_comment_id; ?>">
											<?php echo esc_html( $current_comment_content ); ?>
										</a>
									</div>
								</div>
							</li>
							<!-- end: comment -->

							<?php
						} // end: foreach
						?>

					</ul>

					<?php
					if ( comments_open() ) {
						?>
						<a href="<?php the_permalink(); ?>#respond" class="bwp-post-add-comment-link">
							<i class="fas fa-plus fa-fw"></i><?php esc_html_e( 'Add a comment...', 'nimbo' ); ?>
						</a>
						<?php
					} elseif ( get_comments_number() ) {
						?>
						<a href="<?php the_permalink(); ?>#comments" class="bwp-post-add-comment-link bwp-post-comments-closed">
							<i class="fas fa-comment-slash fa-fw"></i><?php esc_html_e( 'Comments are closed.', 'nimbo' ); ?>
						</a>
						<?php
					}
					?>

				</div>
				<!-- end: recent comments -->

				<?php
			}
		}
	}
}


/**
 * The function displays a post's metadata
 *
 * Single post page: date, author, and categories
 * Page: date and author
 *
 * @since Nimbo 1.0
 */
if ( ! function_exists( 'nimbo_show_single_post_metadata' ) ) {
	function nimbo_show_single_post_metadata( $post_type = 'post' ) {
		?>

		<!-- metadata -->
		<ul class="bwp-single-post-metadata list-unstyled<?php echo ( ! get_the_title() ) ? ' bwp-no-title' : ''; ?>">

			<?php
			// 1: date
			// post type: 'post'
			if ( 'post' === $post_type ) {
				// year, month, day
				$archive_year = get_the_time( 'Y' );
				$archive_month = get_the_time( 'm' );
				$archive_day = get_the_time( 'd' );
				?>

				<!-- date (with link) -->
				<li class="bwp-single-post-meta-date">
					<span><?php esc_html_e( 'Posted on', 'nimbo' ); ?></span>
					<a href="<?php echo esc_url( get_day_link( $archive_year, $archive_month, $archive_day ) ); ?>">
						<span class="date updated"><?php the_time( get_option( 'date_format' ) ); ?></span>
					</a>
				</li>
				<!-- end: date -->

				<?php
			// post type: 'page'
			} else {
				?>

				<!-- date (no link) -->
				<li class="bwp-single-post-meta-date">
					<span><?php esc_html_e( 'Posted on', 'nimbo' ); ?></span>
					<span class="date updated"><?php the_time( get_option( 'date_format' ) ); ?></span>
				</li>
				<!-- end: date -->

				<?php
			}

			// 2: author
			// current author data
			$author_id = get_the_author_meta( 'ID' );
			$author_display_name = get_the_author_meta( 'display_name' );
			$author_posts_url = get_author_posts_url( $author_id );
			?>

			<!-- author -->
			<li class="bwp-single-post-meta-author">
				<span><?php esc_html_e( 'By', 'nimbo' ); ?></span>
				<a href="<?php echo esc_url( $author_posts_url ); ?>" title="<?php echo esc_attr__( 'Posts by', 'nimbo' ) . ' ' . esc_attr( $author_display_name ); ?>" rel="author">
					<span class="vcard author">
						<span class="fn"><?php echo esc_html( $author_display_name ); ?></span>
					</span>
				</a>
			</li>
			<!-- end: author -->

			<?php
			// 3: categories
			// post type: 'post' (because pages do not have categories)
			if ( 'post' === $post_type ) {
				// categories: show or hide
				$show_categories = get_theme_mod( 'nimbo_single_show_categories', 1 ); // 1 or 0
				if ( $show_categories ) {
					?>

					<!-- categories -->
					<li class="bwp-single-post-meta-categories">
						<span><?php esc_html_e( 'In', 'nimbo' ); ?></span>
						<?php the_category( ', ' ); ?>
					</li>
					<!-- end: categories -->

					<?php
				}
			}
			?>

		</ul>
		<!-- end: metadata -->

		<?php
	}
}


/**
 * The function displays a content of a post (title and full post content) on a single page of this post
 *
 * @since Nimbo 1.0
 */
if ( ! function_exists( 'nimbo_show_single_post_content' ) ) {
	function nimbo_show_single_post_content() {

		// title
		if ( get_the_title() ) {
			?>

			<!-- title -->
			<h1 class="bwp-post-title entry-title"><?php the_title(); ?></h1>
			<!-- end: title -->

			<?php
		}
		?>

		<!-- full post content -->
		<div class="bwp-content entry-content clearfix">

			<?php
			// content
			the_content();
			?>

			<!-- clearfix -->
			<div class="clearfix"></div>

			<?php
			// pagination
			wp_link_pages( array(
				'before'			=> '<nav class="bwp-single-post-pagination">' . esc_html__( 'Pages:', 'nimbo' ),
				'after'				=> '</nav>',
				'link_before'		=> '<span>',
				'link_after'		=> '</span>',
				'nextpagelink'		=> '<i class="fas fa-caret-right"></i>',
				'previouspagelink'	=> '<i class="fas fa-caret-left"></i>',
			) );
			?>

		</div>
		<!-- end: full post content -->

		<?php
	}
}


/**
 * The function displays tags
 *
 * @since Nimbo 1.0
 */
if ( ! function_exists( 'nimbo_show_single_post_tags' ) ) {
	function nimbo_show_single_post_tags() {
		if ( get_the_tags() ) {
			?>

			<!-- tags -->
			<div class="bwp-single-post-tags">
				<?php the_tags( esc_html__( 'Tags:', 'nimbo' ), ', ', '' ); ?>
			</div>
			<!-- end: tags -->

			<?php
		}
	}
}


/**
 * The function displays counters on single post page (comments and likes)
 *
 * @since Nimbo 1.0
 */
if ( ! function_exists( 'nimbo_show_single_post_counters' ) ) {
	function nimbo_show_single_post_counters() {
		// if there are functions for displaying counters
		if ( function_exists( 'nimbo_social_media_comments_counter' ) && function_exists( 'nimbo_social_media_get_like' ) ) {

			// comments counter: show or hide
			$show_comments_counter = get_theme_mod( 'nimbo_single_show_comments_counter', 1 ); // 1 or 0
			// "I like" counter: show or hide
			$show_like_counter = get_theme_mod( 'nimbo_single_show_like_counter', 1 ); // 1 or 0

			// show counters
			if ( $show_comments_counter || $show_like_counter ) {
				?>

				<!-- counters -->
				<div class="bwp-single-post-counters">
					<ul class="bwp-single-post-counters-list list-unstyled clearfix">

						<?php if ( $show_comments_counter && ( comments_open() || get_comments_number() ) ) { ?>
							<!-- comments counter -->
							<li class="bwp-single-post-comments-count">
								<?php nimbo_social_media_comments_counter(); ?>
							</li>
							<!-- end: comments counter -->
						<?php } ?>

						<?php if ( $show_like_counter ) { ?>
							<!-- likes counter -->
							<li class="bwp-single-post-likes-count">
								<?php echo nimbo_social_media_get_like( get_the_ID() ); ?>
							</li>
							<!-- end: likes counter -->
						<?php } ?>

					</ul>
				</div>
				<!-- end: counters -->

				<?php
			}
		}
	}
}


/**
 * The function displays the "About the author" section
 *
 * @since Nimbo 1.0
 */
if ( ! function_exists( 'nimbo_show_about_the_author' ) ) {
	function nimbo_show_about_the_author() {
		$show_about_author = get_theme_mod( 'nimbo_show_about_author', 0 ); // 1 or 0
		if ( $show_about_author ) {
			// current author data
			$author_id = get_the_author_meta( 'ID' );
			$author_display_name = get_the_author_meta( 'display_name' );
			$author_posts_url = get_author_posts_url( $author_id );
			$author_posts_num_escaped = (int) get_the_author_posts(); // this variable has been safely escaped
			// show or hide avatars (WordPress Settings > Discussion > Avatars > Avatar Display: Show Avatars)
			$show_avatars = get_option( 'show_avatars' );
			?>

			<!-- about the author -->
			<h2 class="bwp-container-title"><?php esc_html_e( 'Written by', 'nimbo' ); ?></h2>
			<div class="bwp-about-author clearfix<?php echo ( ! $show_avatars ) ? ' bwp-no-avatars' : ''; ?>">
				<?php if ( $show_avatars ) { ?>
					<!-- avatar -->
					<figure class="bwp-about-author-avatar">
						<a href="<?php echo esc_url( $author_posts_url ); ?>" title="<?php echo esc_attr__( 'Posts by', 'nimbo' ) . ' ' . esc_attr( $author_display_name ); ?>">
							<?php echo get_avatar( $author_id, '144', '', esc_attr( $author_display_name ) ); ?>
							<div class="bwp-avatar-bg-overlay"></div>
						</a>
					</figure>
					<!-- end: avatar -->
				<?php } ?>
				<!-- biographical info -->
				<div class="bwp-about-author-bio-wrap">
					<h3 class="bwp-about-author-name">
						<a href="<?php echo esc_url( $author_posts_url ); ?>" title="<?php echo esc_attr__( 'Posts by', 'nimbo' ) . ' ' . esc_attr( $author_display_name ); ?>" rel="author">
							<span class="vcard author">
								<span class="fn"><?php echo esc_html( $author_display_name ); ?></span>
							</span>
						</a>
						<?php if ( 0 !== $author_posts_num_escaped ) { ?>
							<span class="bwp-about-author-posts-num"><i class="fas fa-pen-fancy fa-fw"></i><?php echo ( 1 === $author_posts_num_escaped ) ? '1 ' . esc_html__( 'Post', 'nimbo' ) : $author_posts_num_escaped . ' ' . esc_html__( 'Posts', 'nimbo' ); ?></span>
						<?php } ?>
					</h3>
					<?php if ( get_the_author_meta( 'description' ) ) { ?>
						<div class="bwp-about-author-bio">
							<?php the_author_meta( 'description' ); ?>
						</div>
					<?php } ?>
					<a href="<?php echo esc_url( $author_posts_url ); ?>" class="bwp-about-author-posts-link">
						<i class="far fa-hand-point-right fa-fw"></i><?php esc_html_e( 'View all posts', 'nimbo' ); ?>
					</a>
				</div>
				<!-- end: biographical info -->
			</div>
			<!-- end: about the author -->

			<?php
		}
	}
}


/**
 * Register sidebars
 *
 * @since Nimbo 1.0
 */
if ( ! function_exists( 'nimbo_widgets_init' ) ) {
	function nimbo_widgets_init() {

		// Sidebar. It is located in the left or right column of the theme
		register_sidebar( array(
			'name'			=> esc_html__( 'Sidebar', 'nimbo' ),
			'id'			=> 'nimbo_sidebar',
			'description'	=> esc_html__( 'Add widgets here to appear in your sidebar on blog posts, homepage, single pages, and archive pages. This sidebar is located in the left or right column.', 'nimbo' ),
			'before_widget'	=> '<aside id="%1$s" class="bwp-widget %2$s clearfix">',
			'after_widget'	=> '</aside>',
			'before_title'	=> '<h3 class="bwp-widget-title">',
			'after_title'	=> '</h3>',
		) );

		// Footer (column 1: left column)
		register_sidebar( array(
			'name'			=> esc_html__( 'Footer: Column 1', 'nimbo' ),
			'id'			=> 'nimbo_footer_sidebar_1',
			'description'	=> esc_html__( 'Add widgets here to appear in your footer (column 1: left column).', 'nimbo' ),
			'before_widget'	=> '<aside id="%1$s" class="bwp-widget %2$s clearfix">',
			'after_widget'	=> '</aside>',
			'before_title'	=> '<h3 class="bwp-widget-title">',
			'after_title'	=> '</h3>',
		) );

		// Footer (column 2: central column)
		register_sidebar( array(
			'name'			=> esc_html__( 'Footer: Column 2', 'nimbo' ),
			'id'			=> 'nimbo_footer_sidebar_2',
			'description'	=> esc_html__( 'Add widgets here to appear in your footer (column 2: central column).', 'nimbo' ),
			'before_widget'	=> '<aside id="%1$s" class="bwp-widget %2$s clearfix">',
			'after_widget'	=> '</aside>',
			'before_title'	=> '<h3 class="bwp-widget-title">',
			'after_title'	=> '</h3>',
		) );

		// Footer (column 3: right column)
		register_sidebar( array(
			'name'			=> esc_html__( 'Footer: Column 3', 'nimbo' ),
			'id'			=> 'nimbo_footer_sidebar_3',
			'description'	=> esc_html__( 'Add widgets here to appear in your footer (column 3: right column).', 'nimbo' ),
			'before_widget'	=> '<aside id="%1$s" class="bwp-widget %2$s clearfix">',
			'after_widget'	=> '</aside>',
			'before_title'	=> '<h3 class="bwp-widget-title">',
			'after_title'	=> '</h3>',
		) );

	}
}
add_action( 'widgets_init', 'nimbo_widgets_init' );


/**
 * Customizer (Theme options)
 *
 * @since Nimbo 1.0
 */
require_once get_theme_file_path( '/assets/customizer.php' );
require_once get_theme_file_path( '/assets/sanitize-functions.php' );
require_once get_theme_file_path( '/assets/inline-styles.php' );
