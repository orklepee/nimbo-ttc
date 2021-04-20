<?php
/**
 * Registering meta boxes
 *
 * @since Nimbo 1.0
 */

// add filter
add_filter( 'rwmb_meta_boxes', 'nimbo_register_meta_boxes' );

// function: register meta boxes
function nimbo_register_meta_boxes( $meta_boxes ) {

	$prefix = 'nimbo_mb_';

	/**
	 * Post meta boxes
	 * -----------------------------------------------------------------------------
	 *
	 * Single post page: Layout options
	 * -----------------------------------------------------------------------------
	 */
	$meta_boxes[] = array(
		'id'		=> "{$prefix}layout_settings",
		'title'		=> esc_html__( 'Post Layout', 'nimbo' ),
		'pages'		=> array( 'post' ),
		'context'	=> 'normal',
		'priority'	=> 'high',
		'fields'	=> array(

			/**
			 * Layout
			 * -----------------------------------------------------------------------------
			 */
			array(
				'name'		=> esc_html__( 'Single post page: Layout', 'nimbo' ),
				'desc'		=> esc_html__( 'Available layout options for the post: Post with right sidebar, post with left sidebar, and post without sidebar', 'nimbo' ),
				'id'		=> "{$prefix}single_post_layout",
				'type'		=> 'select_advanced',
				'options'	=> array(
					'right_sidebar'	=> esc_html__( 'Post with right sidebar', 'nimbo' ),
					'left_sidebar'	=> esc_html__( 'Post with left sidebar', 'nimbo' ),
					'full_width'	=> esc_html__( 'Full width post (without sidebar)', 'nimbo' ),
				),
				'multiple'		=> false,
				'placeholder'	=> esc_html__( 'Layout', 'nimbo' ),
			),

		),
	);


	/**
	 * Gallery format
	 * -----------------------------------------------------------------------------
	 */
	$meta_boxes[] = array(
		'id'		=> "{$prefix}gallery_format",
		'title'		=> esc_html__( 'Settings for the Gallery Format', 'nimbo' ),
		'pages'		=> array( 'post' ),
		'context'	=> 'normal',
		'priority'	=> 'high',
		'fields'	=> array(

			/**
			 * Thumbnail type (or media type)
			 * -----------------------------------------------------------------------------
			 */
			array(
				'name'		=> esc_html__( 'Media type', 'nimbo' ),
				'desc'		=> esc_html__( 'Default value: Slider with images from the gallery', 'nimbo' ),
				'id'		=> "{$prefix}gallery_thumb_type",
				'type'		=> 'select_advanced',
				'options'	=> array(
					'featured_image'	=> esc_html__( 'Featured image', 'nimbo' ),
					'slider'			=> esc_html__( 'Slider', 'nimbo' ),
				),
				'std'			=> 'slider',
				'multiple'		=> false,
				'placeholder'	=> esc_html__( 'Featured image / Slider', 'nimbo' ),
			),

			/**
			 * Images for the gallery
			 * -----------------------------------------------------------------------------
			 */
			array(
				'name'				=> esc_html__( 'Add images for the gallery', 'nimbo' ),
				'id'				=> "{$prefix}gallery",
				'type'				=> 'image_advanced',
				'max_file_uploads'	=> 60,
			),

		),
	);


	/**
	 * Video format
	 * -----------------------------------------------------------------------------
	 */
	$meta_boxes[] = array(
		'id'		=> "{$prefix}video_format",
		'title'		=> esc_html__( 'Settings for the Video Format', 'nimbo' ),
		'pages'		=> array( 'post' ),
		'context'	=> 'normal',
		'priority'	=> 'high',
		'fields'	=> array(

			/**
			 * Thumbnail type (or media type)
			 * -----------------------------------------------------------------------------
			 */
			array(
				'name'		=> esc_html__( 'Media type', 'nimbo' ),
				'desc'		=> esc_html__( 'Default value: Video player (iframe)', 'nimbo' ),
				'id'		=> "{$prefix}video_thumb_type",
				'type'		=> 'select_advanced',
				'options'	=> array(
					'iframe'			=> esc_html__( 'Video player (iframe)', 'nimbo' ),
					'featured_image'	=> esc_html__( 'Featured image and popup window with video player', 'nimbo' ),
				),
				'std'			=> 'iframe',
				'multiple'		=> false,
				'placeholder'	=> esc_html__( 'Video player / Featured image', 'nimbo' ),
			),

			/**
			 * Video URL
			 * -----------------------------------------------------------------------------
			 */
			array(
				'name'	=> esc_html__( 'Video URL', 'nimbo' ),
				'id'	=> "{$prefix}video_url",
				'desc'	=> esc_html__( 'Insert a link (URL) on a video from one of the video hosting sites: YouTube, Vimeo, etc', 'nimbo' ),
				'type'	=> 'oembed',
			),

		),
	);


	/**
	 * Audio format
	 * -----------------------------------------------------------------------------
	 */
	$meta_boxes[] = array(
		'id'		=> "{$prefix}audio_format",
		'title'		=>  esc_html__( 'Settings for the Audio Format', 'nimbo' ),
		'pages'		=> array( 'post' ),
		'context'	=> 'normal',
		'priority'	=> 'high',
		'fields'	=> array(

			/**
			 * Thumbnail type (or media type)
			 * -----------------------------------------------------------------------------
			 */
			array(
				'name'		=> esc_html__( 'Media type', 'nimbo' ),
				'desc'		=> esc_html__( 'Default value: Audio player (iframe)', 'nimbo' ),
				'id'		=> "{$prefix}audio_thumb_type",
				'type'		=> 'select_advanced',
				'options'	=> array(
					'iframe'			=> esc_html__( 'Audio player (iframe)', 'nimbo' ),
					'featured_image'	=> esc_html__( 'Featured image and popup window with audio player', 'nimbo' ),
				),
				'std'			=> 'iframe',
				'multiple'		=> false,
				'placeholder'	=> esc_html__( 'Audio player / Featured image', 'nimbo' ),
			),

			/**
			 * Audio URL
			 * -----------------------------------------------------------------------------
			 */
			array(
				'name'	=> esc_html__( 'SoundCloud URL', 'nimbo' ),
				'id'	=> "{$prefix}audio_url",
				'desc'	=> esc_html__( 'Insert a link (URL) on a song from the SoundCloud service', 'nimbo' ),
				'type'	=> 'oembed',
			),

		),
	);


	/**
	 * Link format
	 * -----------------------------------------------------------------------------
	 */
	$meta_boxes[] = array(
		'id'		=> "{$prefix}link_format",
		'title'		=>  esc_html__( 'Settings for the Link Format', 'nimbo' ),
		'pages'		=> array( 'post' ),
		'context'	=> 'normal',
		'priority'	=> 'high',
		'fields'	=> array(

			/**
			 * Target attribute
			 * -----------------------------------------------------------------------------
			 */
			array(
				'name'		=> esc_html__( 'Link open in... (target attribute)', 'nimbo' ),
				'desc'		=> esc_html__( 'Default value: New tab (_blank)', 'nimbo' ),
				'id'		=> "{$prefix}link_target",
				'type'		=> 'select_advanced',
				'options'	=> array(
					'self'	=> esc_html__( 'Current tab (_self)', 'nimbo' ),
					'blank'	=> esc_html__( 'New tab (_blank)', 'nimbo' ),
				),
				'std'			=> 'blank',
				'multiple'		=> false,
				'placeholder'	=> esc_html__( 'Current tab / New tab', 'nimbo' ),
			),

		),
	);


	/**
	 * Pages meta boxes
	 * -----------------------------------------------------------------------------
	 *
	 * Page settings
	 * -----------------------------------------------------------------------------
	 */
	$meta_boxes[] = array(
		'id'		=> "{$prefix}page_settings",
		'title'		=> esc_html__( 'General Settings for the Page', 'nimbo' ),
		'pages'		=> array( 'page' ),
		'context'	=> 'normal',
		'priority'	=> 'high',
		'fields'	=> array(

			/**
			 * Page layout
			 * -----------------------------------------------------------------------------
			 */
			array(
				'name'		=> esc_html__( 'Page layout', 'nimbo' ),
				'desc'		=> esc_html__( 'Available layout options for the page: Page with right sidebar, page with left sidebar, and page without sidebar', 'nimbo' ),
				'id'		=> "{$prefix}page_layout",
				'type'		=> 'select_advanced',
				'options'	=> array(
					'right_sidebar'	=> esc_html__( 'Page with right sidebar', 'nimbo' ),
					'left_sidebar'	=> esc_html__( 'Page with left sidebar', 'nimbo' ),
					'full_width'	=> esc_html__( 'Full width page (without sidebar)', 'nimbo' ),
				),
				'multiple'		=> false,
				'placeholder'	=> esc_html__( 'Layout', 'nimbo' ),
			),

			/**
			 * Show/hide metadata for the page (date, author)
			 * -----------------------------------------------------------------------------
			 */
			array(
				'name'		=> esc_html__( 'Page metadata (date and author): Show or hide', 'nimbo' ),
				'desc'		=> esc_html__( 'Default value: Show', 'nimbo' ),
				'id'		=> "{$prefix}page_metadata",
				'type'		=> 'select_advanced',
				'options'	=> array(
					'show'	=> esc_html__( 'Show', 'nimbo' ),
					'hide'	=> esc_html__( 'Hide', 'nimbo' ),
				),
				'std'			=> 'show',
				'multiple'		=> false,
				'placeholder'	=> esc_html__( 'Show / Hide', 'nimbo' ),
			),

			/**
			 * Show/hide blog posts on the page
			 * -----------------------------------------------------------------------------
			 */
			array(
				'name'		=> esc_html__( 'Blog posts on the page: Show or hide', 'nimbo' ),
				'desc'		=> esc_html__( 'Default value: Hide', 'nimbo' ),
				'id'		=> "{$prefix}page_blog_posts",
				'type'		=> 'select_advanced',
				'options'	=> array(
					'show'	=> esc_html__( 'Show', 'nimbo' ),
					'hide'	=> esc_html__( 'Hide', 'nimbo' ),
				),
				'std'			=> 'hide',
				'multiple'		=> false,
				'placeholder'	=> esc_html__( 'Show / Hide', 'nimbo' ),
			),

		),
	);

	return $meta_boxes;
}
