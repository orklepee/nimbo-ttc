<?php
/**
 * Inline styles
 *
 * @package WordPress
 * @subpackage Nimbo
 * @since Nimbo 1.0
 */

function nimbo_inline_styles() {

	$inline_styles = '';

	/**
	 * Customizer section -> Site Identity
	 * -------------------------------------------------------------
	 */

	// Logo width (id: nimbo_logo_width)
	$logo_width = get_theme_mod( 'nimbo_logo_width' );
	if ( $logo_width ) {
		$inline_styles .= '
		.custom-logo-link img {
			width: ' . $logo_width . 'px;
		}';
	}


	/**
	 * Customizer section -> General Settings
	 * -------------------------------------------------------------
	 */

	// Increase the size of small images (id: nimbo_increase_images)
	$increase_images = get_theme_mod( 'nimbo_increase_images', 0 ); // 1 or 0
	if ( $increase_images ) {
		$inline_styles .= '
		.bwp-post-media img,
		.owl-carousel .owl-item .bwp-post-slider-item img {
			width: 100%;
			margin: 0;
		}';
	}

	// Blog Posts -> Show/hide date (id: nimbo_show_date)
	$show_date = get_theme_mod( 'nimbo_show_date', 1 ); // 1 or 0
	if ( ! $show_date ) {
		$inline_styles .= '
		.bwp-post-date {
			display: none;
		}';
	}

	// Blog Posts -> Show/hide author (id: nimbo_show_author)
	$show_author = get_theme_mod( 'nimbo_show_author', 1 ); // 1 or 0
	if ( ! $show_author ) {
		$inline_styles .= '
		.bwp-post-author {
			display: none;
		}';
	}

	// Single Post Page -> Show/hide date (id: nimbo_single_show_date)
	$single_show_date = get_theme_mod( 'nimbo_single_show_date', 1 ); // 1 or 0
	if ( ! $single_show_date ) {
		$inline_styles .= '
		.single-post .bwp-single-post-meta-date {
			display: none;
		}';
	}

	// Single Post Page -> Show/hide author (id: nimbo_single_show_author)
	$single_show_author = get_theme_mod( 'nimbo_single_show_author', 1 ); // 1 or 0
	if ( ! $single_show_author ) {
		$inline_styles .= '
		.single-post .bwp-single-post-meta-author {
			display: none;
		}';
	}

	// Metadata (Single post page): Remove indents if all metadata is hidden
	// Single Post Page -> Show/hide categories (id: nimbo_single_show_categories)
	$single_show_categories = get_theme_mod( 'nimbo_single_show_categories', 1 ); // 1 or 0
	if ( ! $single_show_date && ! $single_show_author && ! $single_show_categories ) {
		$inline_styles .= '
		.single-post .bwp-single-post-metadata {
			margin-bottom: 0;
		}';
	}


	/**
	 * Customizer section -> Colors
	 * -------------------------------------------------------------
	 */

	// Background color (Dark style; id: nimbo_dark_style_bg_color)
	$dark_style_bg_color = get_theme_mod( 'nimbo_dark_style_bg_color', '#0b0b0c' );
	if ( '#0b0b0c' !== $dark_style_bg_color ) {
		$inline_styles .= '
		.bwp-dark-style {
			background-color: ' . $dark_style_bg_color . ' !important;
		}';
	}


	// Hover/active color (Light style; id: nimbo_light_style_hover_color)
	$light_style_hover_color = get_theme_mod( 'nimbo_light_style_hover_color', '#6ca4db' );
	if ( '#6ca4db' !== $light_style_hover_color ) {
		$inline_styles .= '
		a:hover,
		.bwp-header-search-icon:hover,
		.bwp-header-search-icon.bwp-active,
		.bwp-color-switch-icon:hover,
		.sf-menu a:hover,
		.sf-menu > li:hover > a,
		.sf-menu > .current-menu-item > a,
		.sf-menu > .current-menu-ancestor > a,
		.sf-menu > .current-menu-ancestor > .sf-with-ul::after,
		.sf-arrows > li > .sf-with-ul:focus::after,
		.sf-arrows > li:hover > .sf-with-ul::after,
		.sf-arrows > .sfHover > .sf-with-ul::after,
		.bwp-intro-heading a:hover,
		.bwp-intro-heading a:focus,
		.bwp-intro-text a:hover,
		.bwp-intro-text a:focus,
		.bwp-no-results a:hover,
		.bwp-no-results a:focus,
		.bwp-post-link-to-single-page:hover,
		.bwp-post-link-to-single-page:focus,
		.bwp-post-date a:focus,
		.bwp-post-date a:hover,
		.bwp-post-excerpt a:hover,
		.bwp-post-excerpt a:focus,
		.bwp-content a:hover,
		.bwp-content a:focus,
		.bwp-content h1 a:focus,
		.bwp-content h2 a:focus,
		.bwp-content h3 a:focus,
		.bwp-content h4 a:focus,
		.bwp-content h5 a:focus,
		.bwp-content h6 a:focus,
		.bwp-content h1 a:hover,
		.bwp-content h2 a:hover,
		.bwp-content h3 a:hover,
		.bwp-content h4 a:hover,
		.bwp-content h5 a:hover,
		.bwp-content h6 a:hover,
		.bwp-post-author-name a:hover,
		.bwp-post-author-name a:focus,
		.bwp-post-likes a:hover,
		.bwp-post-share:hover .bwp-post-share-icon,
		.bwp-post-share-icon:hover,
		.bwp-post-add-comment-link:hover,
		.bwp-post-add-comment-link:focus,
		.pagination .nav-links .page-numbers.current,
		.pagination .nav-links a.page-numbers:hover,
		.bwp-single-post-metadata li a:hover,
		.bwp-single-post-metadata li a:focus,
		.bwp-single-post-tags a:hover,
		.bwp-single-post-tags a:focus,
		.bwp-single-post-counters-list li a:hover,
		.post-navigation .nav-links a:hover,
		.post-navigation .nav-links a:focus,
		.bwp-content .wp-playlist-item a:hover,
		.bwp-content .bwp-single-post-pagination > span,
		.bwp-content .wp-block-file a:not(.wp-block-file__button),
		.bwp-content .wp-block-file a:not(.wp-block-file__button):focus,
		.bwp-content .wp-block-file a:not(.wp-block-file__button):hover,
		.bwp-content .wp-block-calendar #wp-calendar tfoot td a:hover,
		.bwp-content .wp-block-calendar #wp-calendar tfoot td a:focus,
		.bwp-about-author-name a:hover,
		.bwp-about-author-name a:focus,
		.bwp-about-author-posts-link:hover,
		.bwp-about-author-posts-link:focus,
		.comment-respond .must-log-in a:hover,
		.comment-respond .must-log-in a:focus,
		.comment-form .logged-in-as a:last-child:hover,
		.comment-form .logged-in-as a:last-child:focus,
		.comment-reply-title #cancel-comment-reply-link:hover,
		.comment-list .pingback .comment-body > a:hover,
		.comment-list .pingback .comment-body > a:focus,
		.comment-list .pingback .comment-body .edit-link .comment-edit-link:hover,
		.comment-list .pingback .comment-body .edit-link .comment-edit-link:focus,
		.comment-meta .comment-author .fn .url:hover,
		.comment-meta .comment-author .fn .url:focus,
		.comment-meta .comment-metadata a:hover,
		.comment-meta .comment-metadata a:focus,
		.comment-content a:hover,
		.comment-content a:focus,
		.comment-body .reply .comment-reply-link:hover,
		.comment-navigation .nav-links a:hover,
		.comment-navigation .nav-links a:focus,
		.bwp-page-404-content a:hover,
		.bwp-page-404-content a:focus,
		.bwp-widget a:hover,
		.bwp-widget a:focus,
		.bwp-widget .bwp-widget-title a:hover,
		.bwp-widget .bwp-widget-title a:focus,
		.widget_search #searchform .bwp-search-submit:hover,
		.widget_bwp_meta li a:hover,
		.widget_bwp_meta li a:focus,
		.bwp-footer-text a:hover,
		.bwp-footer-text a:focus,
		.bwp-footer-social-links a:hover,
		.bwp-footer-social-links a:focus,
		.bwp-footer-menu li a:hover,
		.bwp-footer-menu li a:focus,
		.bwp-cookies-info-content a:hover,
		.bwp-cookies-info-content a:focus {
			color: ' . $light_style_hover_color . ';
		}
		.bwp-main-menu-icon:hover span,
		.bwp-main-menu-icon:hover span::before,
		.bwp-main-menu-icon:hover span::after,
		.bwp-main-menu-icon.bwp-active span,
		.bwp-main-menu-icon.bwp-active span::before,
		.bwp-main-menu-icon.bwp-active span::after,
		input[type="checkbox"]:checked,
		input[type="radio"]:checked {
			background: ' . $light_style_hover_color . ';
		}
		.bwp-post-hover-buttons a:hover,
		.bwp-cookies-close-icon:hover,
		.bwp-mobile-cookies-info-icon:hover,
		#bwp-scroll-top:hover {
			color: #ffffff;
			background-color: ' . $light_style_hover_color . ';
		}
		.bwp-post-media-slider .owl-theme .owl-nav button:hover,
		.bwp-content .wp-block-file .wp-block-file__button:active,
		.bwp-content .wp-block-file .wp-block-file__button:focus,
		.bwp-content .wp-block-file .wp-block-file__button:hover,
		.bwp-content .wp-block-file .wp-block-file__button:visited,
		.widget_bwp_posts_slider .owl-theme .owl-nav button:hover,
		.textwidget button:hover,
		.textwidget input[type="button"]:hover,
		.textwidget input[type="reset"]:hover,
		.textwidget input[type="submit"]:hover {
			color: #ffffff;
			background: ' . $light_style_hover_color . ';
		}
		.bwp-content button:hover,
		.bwp-content input[type="button"]:hover,
		.bwp-content input[type="reset"]:hover,
		.bwp-content input[type="submit"]:hover {
			color: #ffffff;
			background-color: ' . $light_style_hover_color . ';
		}
		.comment-form #submit:hover,
		.bwp-accept-cookies-btn:hover {
			background-color: ' . $light_style_hover_color . ';
		}
		.bwp-content input[type="text"]:hover,
		.bwp-content input[type="email"]:hover,
		.bwp-content input[type="url"]:hover,
		.bwp-content input[type="password"]:hover,
		.bwp-content input[type="search"]:hover,
		.bwp-content input[type="tel"]:hover,
		.bwp-content input[type="number"]:hover,
		.bwp-content input[type="date"]:hover,
		.bwp-content textarea:hover,
		.bwp-content select:hover,
		.bwp-content input[type="text"]:focus,
		.bwp-content input[type="email"]:focus,
		.bwp-content input[type="url"]:focus,
		.bwp-content input[type="password"]:focus,
		.bwp-content input[type="search"]:focus,
		.bwp-content input[type="tel"]:focus,
		.bwp-content input[type="number"]:focus,
		.bwp-content input[type="date"]:focus,
		.bwp-content textarea:focus,
		.bwp-content select:active,
		.bwp-content select:focus,
		.bwp-content input[type="file"]:hover,
		.bwp-content input[type="file"]:focus,
		#author:hover,
		#email:hover,
		#url:hover,
		#comment:hover,
		#author:active,
		#email:active,
		#url:active,
		#comment:active,
		#author:focus,
		#email:focus,
		#url:focus,
		#comment:focus,
		.textwidget input[type="file"]:hover,
		.textwidget input[type="file"]:focus,
		input[type="checkbox"]:hover,
		input[type="radio"]:hover,
		input[type="checkbox"]:checked,
		input[type="radio"]:checked {
			border-color: ' . $light_style_hover_color . ';
		}
		.textwidget input[type="text"]:hover,
		.textwidget input[type="email"]:hover,
		.textwidget input[type="url"]:hover,
		.textwidget input[type="password"]:hover,
		.textwidget input[type="search"]:hover,
		.textwidget input[type="tel"]:hover,
		.textwidget input[type="number"]:hover,
		.textwidget input[type="date"]:hover,
		.textwidget textarea:hover,
		.textwidget select:hover,
		.textwidget input[type="text"]:focus,
		.textwidget input[type="email"]:focus,
		.textwidget input[type="url"]:focus,
		.textwidget input[type="password"]:focus,
		.textwidget input[type="search"]:focus,
		.textwidget input[type="tel"]:focus,
		.textwidget input[type="number"]:focus,
		.textwidget input[type="date"]:focus,
		.textwidget textarea:focus,
		.textwidget select:active,
		.textwidget select:focus {
			border-bottom-color: ' . $light_style_hover_color . ' !important;
		}';
	}


	// Hover/active color (Dark style; id: nimbo_dark_style_hover_color)
	$dark_style_hover_color = get_theme_mod( 'nimbo_dark_style_hover_color', '#6ca4db' );
	if ( '#6ca4db' !== $dark_style_hover_color ) {
		$inline_styles .= '
		.bwp-dark-style a:hover,
		.bwp-dark-style .bwp-header-search-icon:hover,
		.bwp-dark-style .bwp-header-search-icon.bwp-active,
		.bwp-dark-style .bwp-color-switch-icon:hover,
		.bwp-dark-style .sf-menu a:hover,
		.bwp-dark-style .sf-menu > li:hover > a,
		.bwp-dark-style .sf-menu > .current-menu-item > a,
		.bwp-dark-style .sf-menu > .current-menu-ancestor > a,
		.bwp-dark-style .sf-menu > .current-menu-ancestor > .sf-with-ul::after,
		.bwp-dark-style .sf-arrows > li > .sf-with-ul:focus::after,
		.bwp-dark-style .sf-arrows > li:hover > .sf-with-ul::after,
		.bwp-dark-style .sf-arrows > .sfHover > .sf-with-ul::after,
		.bwp-dark-style .bwp-intro-heading a:hover,
		.bwp-dark-style .bwp-intro-heading a:focus,
		.bwp-dark-style .bwp-intro-text a:hover,
		.bwp-dark-style .bwp-intro-text a:focus,
		.bwp-dark-style .bwp-no-results a:hover,
		.bwp-dark-style .bwp-no-results a:focus,
		.bwp-dark-style .bwp-post-link-to-single-page:hover,
		.bwp-dark-style .bwp-post-link-to-single-page:focus,
		.bwp-dark-style .bwp-post-date a:focus,
		.bwp-dark-style .bwp-post-date a:hover,
		.bwp-dark-style .bwp-post-excerpt a:hover,
		.bwp-dark-style .bwp-post-excerpt a:focus,
		.bwp-dark-style .bwp-content a:hover,
		.bwp-dark-style .bwp-content a:focus,
		.bwp-dark-style .bwp-content h1 a:focus,
		.bwp-dark-style .bwp-content h2 a:focus,
		.bwp-dark-style .bwp-content h3 a:focus,
		.bwp-dark-style .bwp-content h4 a:focus,
		.bwp-dark-style .bwp-content h5 a:focus,
		.bwp-dark-style .bwp-content h6 a:focus,
		.bwp-dark-style .bwp-content h1 a:hover,
		.bwp-dark-style .bwp-content h2 a:hover,
		.bwp-dark-style .bwp-content h3 a:hover,
		.bwp-dark-style .bwp-content h4 a:hover,
		.bwp-dark-style .bwp-content h5 a:hover,
		.bwp-dark-style .bwp-content h6 a:hover,
		.bwp-dark-style .bwp-post-author-name a:hover,
		.bwp-dark-style .bwp-post-author-name a:focus,
		.bwp-dark-style .bwp-post-likes a:hover,
		.bwp-dark-style .bwp-post-share:hover .bwp-post-share-icon,
		.bwp-dark-style .bwp-post-share-icon:hover,
		.bwp-dark-style .bwp-post-add-comment-link:hover,
		.bwp-dark-style .bwp-post-add-comment-link:focus,
		.bwp-dark-style .pagination .nav-links .page-numbers.current,
		.bwp-dark-style .pagination .nav-links a.page-numbers:hover,
		.bwp-dark-style .bwp-single-post-metadata li a:hover,
		.bwp-dark-style .bwp-single-post-metadata li a:focus,
		.bwp-dark-style .bwp-single-post-tags a:hover,
		.bwp-dark-style .bwp-single-post-tags a:focus,
		.bwp-dark-style .bwp-single-post-counters-list li a:hover,
		.bwp-dark-style .post-navigation .nav-links a:hover,
		.bwp-dark-style .post-navigation .nav-links a:focus,
		.bwp-dark-style .bwp-content .wp-playlist-item a:hover,
		.bwp-dark-style .bwp-content .bwp-single-post-pagination > span,
		.bwp-dark-style .bwp-content .wp-block-file a:not(.wp-block-file__button),
		.bwp-dark-style .bwp-content .wp-block-file a:not(.wp-block-file__button):focus,
		.bwp-dark-style .bwp-content .wp-block-file a:not(.wp-block-file__button):hover,
		.bwp-dark-style .bwp-content .wp-block-calendar #wp-calendar tfoot td a:hover,
		.bwp-dark-style .bwp-content .wp-block-calendar #wp-calendar tfoot td a:focus,
		.bwp-dark-style .bwp-about-author-name a:hover,
		.bwp-dark-style .bwp-about-author-name a:focus,
		.bwp-dark-style .bwp-about-author-posts-link:hover,
		.bwp-dark-style .bwp-about-author-posts-link:focus,
		.bwp-dark-style .comment-respond .must-log-in a:hover,
		.bwp-dark-style .comment-respond .must-log-in a:focus,
		.bwp-dark-style .comment-form .logged-in-as a:last-child:hover,
		.bwp-dark-style .comment-form .logged-in-as a:last-child:focus,
		.bwp-dark-style .comment-reply-title #cancel-comment-reply-link:hover,
		.bwp-dark-style .comment-list .pingback .comment-body > a:hover,
		.bwp-dark-style .comment-list .pingback .comment-body > a:focus,
		.bwp-dark-style .comment-list .pingback .comment-body .edit-link .comment-edit-link:hover,
		.bwp-dark-style .comment-list .pingback .comment-body .edit-link .comment-edit-link:focus,
		.bwp-dark-style .comment-meta .comment-author .fn .url:hover,
		.bwp-dark-style .comment-meta .comment-author .fn .url:focus,
		.bwp-dark-style .comment-meta .comment-metadata a:hover,
		.bwp-dark-style .comment-meta .comment-metadata a:focus,
		.bwp-dark-style .comment-content a:hover,
		.bwp-dark-style .comment-content a:focus,
		.bwp-dark-style .comment-body .reply .comment-reply-link:hover,
		.bwp-dark-style .comment-navigation .nav-links a:hover,
		.bwp-dark-style .comment-navigation .nav-links a:focus,
		.bwp-dark-style .bwp-page-404-content a:hover,
		.bwp-dark-style .bwp-page-404-content a:focus,
		.bwp-dark-style .bwp-widget a:hover,
		.bwp-dark-style .bwp-widget a:focus,
		.bwp-dark-style .bwp-widget .bwp-widget-title a:hover,
		.bwp-dark-style .bwp-widget .bwp-widget-title a:focus,
		.bwp-dark-style .widget_search #searchform .bwp-search-submit:hover,
		.bwp-dark-style .widget_bwp_meta li a:hover,
		.bwp-dark-style .widget_bwp_meta li a:focus,
		.bwp-dark-style .bwp-footer-text a:hover,
		.bwp-dark-style .bwp-footer-text a:focus,
		.bwp-dark-style .bwp-footer-social-links a:hover,
		.bwp-dark-style .bwp-footer-social-links a:focus,
		.bwp-dark-style .bwp-footer-menu li a:hover,
		.bwp-dark-style .bwp-footer-menu li a:focus,
		.bwp-dark-style .bwp-cookies-info-content a:hover,
		.bwp-dark-style .bwp-cookies-info-content a:focus {
			color: ' . $dark_style_hover_color . ';
		}
		.bwp-dark-style .bwp-main-menu-icon:hover span,
		.bwp-dark-style .bwp-main-menu-icon:hover span::before,
		.bwp-dark-style .bwp-main-menu-icon:hover span::after,
		.bwp-dark-style .bwp-main-menu-icon.bwp-active span,
		.bwp-dark-style .bwp-main-menu-icon.bwp-active span::before,
		.bwp-dark-style .bwp-main-menu-icon.bwp-active span::after,
		.bwp-dark-style input[type="checkbox"]:checked,
		.bwp-dark-style input[type="radio"]:checked {
			background: ' . $dark_style_hover_color . ';
		}
		.bwp-dark-style .bwp-post-hover-buttons a:hover,
		.bwp-dark-style .bwp-cookies-close-icon:hover,
		.bwp-dark-style .bwp-mobile-cookies-info-icon:hover,
		.bwp-dark-style #bwp-scroll-top:hover {
			color: #ffffff;
			background-color: ' . $dark_style_hover_color . ';
		}
		.bwp-dark-style .bwp-post-media-slider .owl-theme .owl-nav button:hover,
		.bwp-dark-style .bwp-content .wp-block-file .wp-block-file__button:active,
		.bwp-dark-style .bwp-content .wp-block-file .wp-block-file__button:focus,
		.bwp-dark-style .bwp-content .wp-block-file .wp-block-file__button:hover,
		.bwp-dark-style .bwp-content .wp-block-file .wp-block-file__button:visited,
		.bwp-dark-style .widget_bwp_posts_slider .owl-theme .owl-nav button:hover,
		.bwp-dark-style .textwidget button:hover,
		.bwp-dark-style .textwidget input[type="button"]:hover,
		.bwp-dark-style .textwidget input[type="reset"]:hover,
		.bwp-dark-style .textwidget input[type="submit"]:hover {
			color: #ffffff;
			background: ' . $dark_style_hover_color . ';
		}
		.bwp-dark-style .bwp-content button:hover,
		.bwp-dark-style .bwp-content input[type="button"]:hover,
		.bwp-dark-style .bwp-content input[type="reset"]:hover,
		.bwp-dark-style .bwp-content input[type="submit"]:hover {
			color: #ffffff;
			background-color: ' . $dark_style_hover_color . ';
		}
		.bwp-dark-style .comment-form #submit:hover,
		.bwp-dark-style .bwp-accept-cookies-btn:hover {
			background-color: ' . $dark_style_hover_color . ';
		}
		.bwp-dark-style .bwp-content input[type="text"]:hover,
		.bwp-dark-style .bwp-content input[type="email"]:hover,
		.bwp-dark-style .bwp-content input[type="url"]:hover,
		.bwp-dark-style .bwp-content input[type="password"]:hover,
		.bwp-dark-style .bwp-content input[type="search"]:hover,
		.bwp-dark-style .bwp-content input[type="tel"]:hover,
		.bwp-dark-style .bwp-content input[type="number"]:hover,
		.bwp-dark-style .bwp-content input[type="date"]:hover,
		.bwp-dark-style .bwp-content textarea:hover,
		.bwp-dark-style .bwp-content select:hover,
		.bwp-dark-style .bwp-content input[type="text"]:focus,
		.bwp-dark-style .bwp-content input[type="email"]:focus,
		.bwp-dark-style .bwp-content input[type="url"]:focus,
		.bwp-dark-style .bwp-content input[type="password"]:focus,
		.bwp-dark-style .bwp-content input[type="search"]:focus,
		.bwp-dark-style .bwp-content input[type="tel"]:focus,
		.bwp-dark-style .bwp-content input[type="number"]:focus,
		.bwp-dark-style .bwp-content input[type="date"]:focus,
		.bwp-dark-style .bwp-content textarea:focus,
		.bwp-dark-style .bwp-content select:active,
		.bwp-dark-style .bwp-content select:focus,
		.bwp-dark-style .bwp-content input[type="file"]:hover,
		.bwp-dark-style .bwp-content input[type="file"]:focus,
		.bwp-dark-style #author:hover,
		.bwp-dark-style #email:hover,
		.bwp-dark-style #url:hover,
		.bwp-dark-style #comment:hover,
		.bwp-dark-style #author:active,
		.bwp-dark-style #email:active,
		.bwp-dark-style #url:active,
		.bwp-dark-style #comment:active,
		.bwp-dark-style #author:focus,
		.bwp-dark-style #email:focus,
		.bwp-dark-style #url:focus,
		.bwp-dark-style #comment:focus,
		.bwp-dark-style .textwidget input[type="file"]:hover,
		.bwp-dark-style .textwidget input[type="file"]:focus,
		.bwp-dark-style input[type="checkbox"]:hover,
		.bwp-dark-style input[type="radio"]:hover,
		.bwp-dark-style input[type="checkbox"]:checked,
		.bwp-dark-style input[type="radio"]:checked {
			border-color: ' . $dark_style_hover_color . ';
		}
		.bwp-dark-style .textwidget input[type="text"]:hover,
		.bwp-dark-style .textwidget input[type="email"]:hover,
		.bwp-dark-style .textwidget input[type="url"]:hover,
		.bwp-dark-style .textwidget input[type="password"]:hover,
		.bwp-dark-style .textwidget input[type="search"]:hover,
		.bwp-dark-style .textwidget input[type="tel"]:hover,
		.bwp-dark-style .textwidget input[type="number"]:hover,
		.bwp-dark-style .textwidget input[type="date"]:hover,
		.bwp-dark-style .textwidget textarea:hover,
		.bwp-dark-style .textwidget select:hover,
		.bwp-dark-style .textwidget input[type="text"]:focus,
		.bwp-dark-style .textwidget input[type="email"]:focus,
		.bwp-dark-style .textwidget input[type="url"]:focus,
		.bwp-dark-style .textwidget input[type="password"]:focus,
		.bwp-dark-style .textwidget input[type="search"]:focus,
		.bwp-dark-style .textwidget input[type="tel"]:focus,
		.bwp-dark-style .textwidget input[type="number"]:focus,
		.bwp-dark-style .textwidget input[type="date"]:focus,
		.bwp-dark-style .textwidget textarea:focus,
		.bwp-dark-style .textwidget select:active,
		.bwp-dark-style .textwidget select:focus {
			border-bottom-color: ' . $dark_style_hover_color . ' !important;
		}';
	}


	/**
	 * Add inline styles (after the style.css file; id: nimbo-style)
	 * -------------------------------------------------------------
	 */

	wp_add_inline_style( 'nimbo-style', $inline_styles );

}
add_action( 'wp_enqueue_scripts', 'nimbo_inline_styles' );
