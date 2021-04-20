<?php
/**
 * Theme options (customizer)
 *
 * Additional sanitize functions are located in the "sanitize-functions.php" file (/assets/sanitize-functions.php)
 *
 * @package WordPress
 * @subpackage Nimbo
 * @since Nimbo 1.0
 */

function nimbo_customize_register( $wp_customize ) {

	/**
	 * Customize control: Heading (title and subtitle)
	 * -------------------------------------------------------------
	 */
	class nimbo_customize_control_heading extends WP_Customize_Control {
		public $type = 'nimbo_heading';
		public function render_content() {
			?>

			<div class="bwp-customize-control-heading">
				<span class="customize-control-title">
					<?php echo esc_html( $this->label ); ?>
				</span>
				<?php if ( $this->value() ) { ?>
					<span class="bwp-customize-control-subtitle">
						<?php echo esc_html( $this->value() ); ?>
					</span>
				<?php } ?>
			</div>

			<?php
		}
	}


	/**
	 * Customize control: Number field (input type = number; min=1, max=10000)
	 * -------------------------------------------------------------
	 */
	class nimbo_customize_control_number extends WP_Customize_Control {
		public $type = 'nimbo_number_field';
		public function render_content() {
			?>

			<label>
				<span class="customize-control-title">
					<?php echo esc_html( $this->label ); ?>
				</span>
				<input type="number" min="1" max="10000" value="<?php echo (int) $this->value(); ?>" <?php $this->link(); ?>>
			</label>

			<?php
		}
	}


	/**
	 * Customize control: Short description
	 * -------------------------------------------------------------
	 */
	class nimbo_customize_control_description extends WP_Customize_Control {
		public $type = 'nimbo_description';
		public function render_content() {
			?>

			<div class="bwp-customize-control-description">
				<?php
				echo esc_html( $this->value() );
				?>
			</div>

			<?php
		}
	}


	/**
	 * Theme Options
	 * -------------------------------------------------------------
	 *
	 * 1.0 - Site Identity
	 * -------------------------------------------------------------
	 */

	// Dark logo
	$wp_customize->add_setting(
		'nimbo_dark_logo_image',
		array(
			'default'			=> '',
			'sanitize_callback'	=> 'esc_url',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize,
			'nimbo_dark_logo_image',
			array(
				'label'		=> __( 'Logo For Dark Style (optional)', 'nimbo' ),
				'section'	=> 'title_tagline',
				'settings'	=> 'nimbo_dark_logo_image',
			)
		)
	);


	// Logo: description
	$wp_customize->add_setting(
		'nimbo_logo_image_desc',
		array(
			'default'			=> __( 'Logo for the dark theme style must have the same dimensions as the original logo and should differ only in color.', 'nimbo' ),
			'sanitize_callback'	=> 'esc_html',
		)
	);

	$wp_customize->add_control(
		new nimbo_customize_control_description(
			$wp_customize,
			'nimbo_logo_image_desc',
			array(
				'label'		=> __( 'Logo: Description', 'nimbo' ),
				'section'	=> 'title_tagline',
				'settings'	=> 'nimbo_logo_image_desc',
			)
		)
	);


	// Logo width
	$wp_customize->add_setting(
		'nimbo_logo_width',
		array(
			'default'			=> '',
			'sanitize_callback'	=> 'nimbo_sanitize_number_intval',
		)
	);

	$wp_customize->add_control(
		new nimbo_customize_control_number(
			$wp_customize,
			'nimbo_logo_width',
			array(
				'label'		=> __( 'Logo Width, px', 'nimbo' ),
				'section'	=> 'title_tagline',
				'settings'	=> 'nimbo_logo_width',
			)
		)
	);


	/**
	 * 2.0 - General Settings
	 * -------------------------------------------------------------
	 */

	// Add new section
	$wp_customize->add_section(
		'nimbo_general_settings_section',
		array(
			'title'		=> __( 'General Settings', 'nimbo' ),
			'priority'	=> 21,
		)
	);


	/**
	 * 2.1 - General Settings: Header
	 * -------------------------------------------------------------
	 */

	// Heading
	$wp_customize->add_setting(
		'nimbo_general_settings_header',
		array(
			'default'			=> '',
			'sanitize_callback'	=> 'esc_html',
		)
	);

	$wp_customize->add_control(
		new nimbo_customize_control_heading(
			$wp_customize,
			'nimbo_general_settings_header',
			array(
				'label'		=> __( 'Header', 'nimbo' ),
				'section'	=> 'nimbo_general_settings_section',
				'settings'	=> 'nimbo_general_settings_header',
			)
		)
	);


	// Header type
	$wp_customize->add_setting(
		'nimbo_header_type',
		array(
			'default'			=> 'header-one-row',
			'sanitize_callback'	=> 'nimbo_sanitize_header_type',
		)
	);

	$wp_customize->add_control(
		'nimbo_header_type',
		array(
			'type'		=> 'select',
			'label'		=> __( 'Header Type', 'nimbo' ),
			'section'	=> 'nimbo_general_settings_section',
			'choices'	=> array(
				'header-one-row'	=> esc_html__( 'Header: Type 1 - One row', 'nimbo' ),
				'header-two-rows'	=> esc_html__( 'Header: Type 2 - Two rows', 'nimbo' ),
			),
		)
	);


	// Header type: description
	$wp_customize->add_setting(
		'nimbo_header_type_desc',
		array(
			'default'			=> __( 'If you use a logo with small dimensions, then the first header type ("Header: Type 1 - One row") will be a good choice.', 'nimbo' ),
			'sanitize_callback'	=> 'esc_html',
		)
	);

	$wp_customize->add_control(
		new nimbo_customize_control_description(
			$wp_customize,
			'nimbo_header_type_desc',
			array(
				'label'		=> __( 'Header Type: Description', 'nimbo' ),
				'section'	=> 'nimbo_general_settings_section',
				'settings'	=> 'nimbo_header_type_desc',
			)
		)
	);


	// Menu type
	$wp_customize->add_setting(
		'nimbo_menu_type',
		array(
			'default'			=> 'hidden-menu',
			'sanitize_callback'	=> 'nimbo_sanitize_menu_type',
		)
	);

	$wp_customize->add_control(
		'nimbo_menu_type',
		array(
			'type'		=> 'select',
			'label'		=> __( 'Menu Type', 'nimbo' ),
			'section'	=> 'nimbo_general_settings_section',
			'choices'	=> array(
				'hidden-menu'	=> esc_html__( 'Hidden menu', 'nimbo' ),
				'visible-menu'	=> esc_html__( 'Visible menu', 'nimbo' ),
			),
		)
	);


	// Enable/disable color switch
	$wp_customize->add_setting(
		'nimbo_enable_color_switch',
		array(
			'default'			=> 0,
			'sanitize_callback'	=> 'nimbo_sanitize_checkbox',
		)
	);

	$wp_customize->add_control(
		'nimbo_enable_color_switch',
		array(
			'type'		=> 'checkbox',
			'label'		=> __( 'Enable color switch', 'nimbo' ),
			'section'	=> 'nimbo_general_settings_section',
		)
	);


	// Enable/disable color switch: description
	$wp_customize->add_setting(
		'nimbo_color_switch_desc',
		array(
			'default'			=> __( 'After disabling the color switch option, the "nimbo_site_style" cookie with information about the current theme style will be deleted. The default theme style can be selected in the following option below: "General Settings > Other Settings > Default Color Scheme".', 'nimbo' ),
			'sanitize_callback'	=> 'esc_html',
		)
	);

	$wp_customize->add_control(
		new nimbo_customize_control_description(
			$wp_customize,
			'nimbo_color_switch_desc',
			array(
				'label'		=> __( 'Color Switch: Description', 'nimbo' ),
				'section'	=> 'nimbo_general_settings_section',
				'settings'	=> 'nimbo_color_switch_desc',
			)
		)
	);


	// Dark style: Color switch icon type
	$wp_customize->add_setting(
		'nimbo_dark_color_switch_icon_type',
		array(
			'default'			=> 'moon',
			'sanitize_callback'	=> 'nimbo_sanitize_dark_color_switch_icon_type',
		)
	);

	$wp_customize->add_control(
		'nimbo_dark_color_switch_icon_type',
		array(
			'type'		=> 'select',
			'label'		=> __( 'Dark Style: Color Switch Icon Type', 'nimbo' ),
			'section'	=> 'nimbo_general_settings_section',
			'choices'	=> array(
				'moon'	=> esc_html__( 'Moon icon', 'nimbo' ),
				'sun'	=> esc_html__( 'Sun icon', 'nimbo' ),
			),
		)
	);


	// Show/hide search
	$wp_customize->add_setting(
		'nimbo_show_search',
		array(
			'default'			=> 1,
			'sanitize_callback'	=> 'nimbo_sanitize_checkbox',
		)
	);

	$wp_customize->add_control(
		'nimbo_show_search',
		array(
			'type'		=> 'checkbox',
			'label'		=> __( 'Show search icon and dropdown search form', 'nimbo' ),
			'section'	=> 'nimbo_general_settings_section',
		)
	);


	// Sticky header
	$wp_customize->add_setting(
		'nimbo_enable_sticky_header',
		array(
			'default'			=> 1,
			'sanitize_callback'	=> 'nimbo_sanitize_checkbox',
		)
	);

	$wp_customize->add_control(
		'nimbo_enable_sticky_header',
		array(
			'type'		=> 'checkbox',
			'label'		=> __( 'Enable sticky header', 'nimbo' ),
			'section'	=> 'nimbo_general_settings_section',
		)
	);


	/**
	 * 2.2 - General Settings: Logo
	 * -------------------------------------------------------------
	 */

	// Heading
	$wp_customize->add_setting(
		'nimbo_general_settings_logo',
		array(
			'default'			=> '',
			'sanitize_callback'	=> 'esc_html',
		)
	);

	$wp_customize->add_control(
		new nimbo_customize_control_heading(
			$wp_customize,
			'nimbo_general_settings_logo',
			array(
				'label'		=> __( 'Logo', 'nimbo' ),
				'section'	=> 'nimbo_general_settings_section',
				'settings'	=> 'nimbo_general_settings_logo',
			)
		)
	);


	// Logo type
	$wp_customize->add_setting(
		'nimbo_logo_type',
		array(
			'default'			=> 'text',
			'sanitize_callback'	=> 'nimbo_sanitize_logo_type',
		)
	);

	$wp_customize->add_control(
		'nimbo_logo_type',
		array(
			'type'		=> 'select',
			'label'		=> __( 'Logo Type', 'nimbo' ),
			'section'	=> 'nimbo_general_settings_section',
			'choices'	=> array(
				'text'	=> esc_html__( 'Text', 'nimbo' ),
				'image'	=> esc_html__( 'Image', 'nimbo' ),
			),
		)
	);


	// Logo type: description
	$wp_customize->add_setting(
		'nimbo_logo_type_desc',
		array(
			'default'			=> __( 'You can add an image for your logo in the "Site Identity" section: "Site Identity > Logo".', 'nimbo' ),
			'sanitize_callback'	=> 'esc_html',
		)
	);

	$wp_customize->add_control(
		new nimbo_customize_control_description(
			$wp_customize,
			'nimbo_logo_type_desc',
			array(
				'label'		=> __( 'Logo Type: Description', 'nimbo' ),
				'section'	=> 'nimbo_general_settings_section',
				'settings'	=> 'nimbo_logo_type_desc',
			)
		)
	);


	// Logo text
	$wp_customize->add_setting(
		'nimbo_logo_text',
		array(
			'default'			=> 'Nimbo',
			'sanitize_callback'	=> 'esc_html',
		)
	);

	$wp_customize->add_control(
		'nimbo_logo_text',
		array(
			'label'		=> __( 'Logo Text (Logo Type: Text)', 'nimbo' ),
			'section'	=> 'nimbo_general_settings_section',
			'type'		=> 'text',
		)
	);


	/**
	 * 2.3 - General Settings: Header image and Header text
	 * -------------------------------------------------------------
	 */

	// Heading
	$wp_customize->add_setting(
		'nimbo_general_settings_intro',
		array(
			'default'			=> '',
			'sanitize_callback'	=> 'esc_html',
		)
	);

	$wp_customize->add_control(
		new nimbo_customize_control_heading(
			$wp_customize,
			'nimbo_general_settings_intro',
			array(
				'label'		=> __( 'Homepage: Header image and Header text', 'nimbo' ),
				'section'	=> 'nimbo_general_settings_section',
				'settings'	=> 'nimbo_general_settings_intro',
			)
		)
	);


	// Header image and Header text: Show only on the first page or not
	$wp_customize->add_setting(
		'nimbo_show_intro_on_first_page',
		array(
			'default'			=> 0,
			'sanitize_callback'	=> 'nimbo_sanitize_checkbox',
		)
	);

	$wp_customize->add_control(
		'nimbo_show_intro_on_first_page',
		array(
			'type'		=> 'checkbox',
			'label'		=> __( 'Show header image and header text only on the first page', 'nimbo' ),
			'section'	=> 'nimbo_general_settings_section',
		)
	);


	/**
	 * 2.4 - General Settings: Blog
	 * -------------------------------------------------------------
	 */

	// Heading
	$wp_customize->add_setting(
		'nimbo_general_settings_blog',
		array(
			'default'			=> '',
			'sanitize_callback'	=> 'esc_html',
		)
	);

	$wp_customize->add_control(
		new nimbo_customize_control_heading(
			$wp_customize,
			'nimbo_general_settings_blog',
			array(
				'label'		=> __( 'Blog', 'nimbo' ),
				'section'	=> 'nimbo_general_settings_section',
				'settings'	=> 'nimbo_general_settings_blog',
			)
		)
	);


	// Layout
	$wp_customize->add_setting(
		'nimbo_blog_layout',
		array(
			'default'			=> '3-columns',
			'sanitize_callback'	=> 'nimbo_sanitize_blog_layout',
		)
	);

	$wp_customize->add_control(
		'nimbo_blog_layout',
		array(
			'type'		=> 'select',
			'label'		=> __( 'Layout', 'nimbo' ),
			'section'	=> 'nimbo_general_settings_section',
			'choices'	=> array(
				'3-columns'					=> esc_html__( 'No sidebar', 'nimbo' ),
				'2-columns-left-sidebar'	=> esc_html__( 'Left sidebar', 'nimbo' ),
				'2-columns-right-sidebar'	=> esc_html__( 'Right sidebar', 'nimbo' ),
			),
		)
	);


	/**
	 * 2.5 - General Settings: Blog Posts
	 * -------------------------------------------------------------
	 */

	// Heading
	$wp_customize->add_setting(
		'nimbo_general_settings_blog_posts',
		array(
			'default'			=> '',
			'sanitize_callback'	=> 'esc_html',
		)
	);

	$wp_customize->add_control(
		new nimbo_customize_control_heading(
			$wp_customize,
			'nimbo_general_settings_blog_posts',
			array(
				'label'		=> __( 'Blog Posts', 'nimbo' ),
				'section'	=> 'nimbo_general_settings_section',
				'settings'	=> 'nimbo_general_settings_blog_posts',
			)
		)
	);


	// "Excerpt" or "Read more tag"
	$wp_customize->add_setting(
		'nimbo_post_excerpt_type',
		array(
			'default'			=> 'excerpt',
			'sanitize_callback'	=> 'nimbo_sanitize_excerpt_type',
		)
	);

	$wp_customize->add_control(
		'nimbo_post_excerpt_type',
		array(
			'type'		=> 'select',
			'label'		=> __( '"Excerpt" Or "Read More Tag"', 'nimbo' ),
			'section'	=> 'nimbo_general_settings_section',
			'choices'	=> array(
				'excerpt'	=> esc_html__( 'Excerpt', 'nimbo' ),
				'more-tag'	=> esc_html__( 'Read More Tag', 'nimbo' ),
			),
		)
	);


	// "Excerpt" or "Read more tag": Description
	$wp_customize->add_setting(
		'nimbo_post_excerpt_type_desc',
		array(
			'default'			=> __( 'The "Excerpt" option does not apply to the following post formats: aside, link, status, chat, and quote.', 'nimbo' ),
			'sanitize_callback'	=> 'esc_html',
		)
	);

	$wp_customize->add_control(
		new nimbo_customize_control_description(
			$wp_customize,
			'nimbo_post_excerpt_type_desc',
			array(
				'label'		=> __( 'Excerpt Type: Description', 'nimbo' ),
				'section'	=> 'nimbo_general_settings_section',
				'settings'	=> 'nimbo_post_excerpt_type_desc',
			)
		)
	);


	// Excerpt length (number of words)
	$wp_customize->add_setting(
		'nimbo_excerpt_length',
		array(
			'default'			=> 25,
			'sanitize_callback'	=> 'nimbo_sanitize_number_intval',
		)
	);

	$wp_customize->add_control(
		new nimbo_customize_control_number(
			$wp_customize,
			'nimbo_excerpt_length',
			array(
				'label'		=> __( 'Excerpt Length (Number Of Words)', 'nimbo' ),
				'section'	=> 'nimbo_general_settings_section',
				'settings'	=> 'nimbo_excerpt_length',
			)
		)
	);


	// Increase the size of small images
	$wp_customize->add_setting(
		'nimbo_increase_images',
		array(
			'default'			=> 0,
			'sanitize_callback'	=> 'nimbo_sanitize_checkbox',
		)
	);

	$wp_customize->add_control(
		'nimbo_increase_images',
		array(
			'type'		=> 'checkbox',
			'label'		=> __( 'Increase the size of small images (option applies only to your featured images)', 'nimbo' ),
			'section'	=> 'nimbo_general_settings_section',
		)
	);


	// Show icons when you hover on featured image
	$wp_customize->add_setting(
		'nimbo_image_show_hover_icons',
		array(
			'default'			=> 1,
			'sanitize_callback'	=> 'nimbo_sanitize_checkbox',
		)
	);

	$wp_customize->add_control(
		'nimbo_image_show_hover_icons',
		array(
			'type'		=> 'checkbox',
			'label'		=> __( 'Show icons when you hover on featured image', 'nimbo' ),
			'section'	=> 'nimbo_general_settings_section',
		)
	);


	// Show date
	$wp_customize->add_setting(
		'nimbo_show_date',
		array(
			'default'			=> 1,
			'sanitize_callback'	=> 'nimbo_sanitize_checkbox',
		)
	);

	$wp_customize->add_control(
		'nimbo_show_date',
		array(
			'type'		=> 'checkbox',
			'label'		=> __( 'Show date', 'nimbo' ),
			'section'	=> 'nimbo_general_settings_section',
		)
	);


	// Show author
	$wp_customize->add_setting(
		'nimbo_show_author',
		array(
			'default'			=> 1,
			'sanitize_callback'	=> 'nimbo_sanitize_checkbox',
		)
	);

	$wp_customize->add_control(
		'nimbo_show_author',
		array(
			'type'		=> 'checkbox',
			'label'		=> __( 'Show author', 'nimbo' ),
			'section'	=> 'nimbo_general_settings_section',
		)
	);


	// if Nimbo Social Media plugin is activated
	if ( function_exists( 'nimbo_social_media_get_like' ) && function_exists( 'nimbo_social_media_post_share' ) ) {

		// Show "I like" counter
		$wp_customize->add_setting(
			'nimbo_show_like_counter',
			array(
				'default'			=> 1,
				'sanitize_callback'	=> 'nimbo_sanitize_checkbox',
			)
		);

		$wp_customize->add_control(
			'nimbo_show_like_counter',
			array(
				'type'		=> 'checkbox',
				'label'		=> __( 'Show "I like" counter', 'nimbo' ),
				'section'	=> 'nimbo_general_settings_section',
			)
		);

		// Show social share buttons on posts
		$wp_customize->add_setting(
			'nimbo_show_share_buttons',
			array(
				'default'			=> 1,
				'sanitize_callback'	=> 'nimbo_sanitize_checkbox',
			)
		);

		$wp_customize->add_control(
			'nimbo_show_share_buttons',
			array(
				'type'		=> 'checkbox',
				'label'		=> __( 'Show social share buttons', 'nimbo' ),
				'section'	=> 'nimbo_general_settings_section',
			)
		);

	}


	// Show recent comments
	$wp_customize->add_setting(
		'nimbo_show_recent_comments',
		array(
			'default'			=> 1,
			'sanitize_callback'	=> 'nimbo_sanitize_checkbox',
		)
	);

	$wp_customize->add_control(
		'nimbo_show_recent_comments',
		array(
			'type'		=> 'checkbox',
			'label'		=> __( 'Show recent comments', 'nimbo' ),
			'section'	=> 'nimbo_general_settings_section',
		)
	);


	// Number of recent comments
	$wp_customize->add_setting(
		'nimbo_recent_comments_number',
		array(
			'default'			=> 3,
			'sanitize_callback'	=> 'nimbo_sanitize_number_intval',
		)
	);

	$wp_customize->add_control(
		new nimbo_customize_control_number(
			$wp_customize,
			'nimbo_recent_comments_number',
			array(
				'label'		=> __( 'Number Of Recent Comments', 'nimbo' ),
				'section'	=> 'nimbo_general_settings_section',
				'settings'	=> 'nimbo_recent_comments_number',
			)
		)
	);


	// Comment: Number of words
	$wp_customize->add_setting(
		'nimbo_comment_words_number',
		array(
			'default'			=> 8,
			'sanitize_callback'	=> 'nimbo_sanitize_number_intval',
		)
	);

	$wp_customize->add_control(
		new nimbo_customize_control_number(
			$wp_customize,
			'nimbo_comment_words_number',
			array(
				'label'		=> __( 'Comment: Number Of Words', 'nimbo' ),
				'section'	=> 'nimbo_general_settings_section',
				'settings'	=> 'nimbo_comment_words_number',
			)
		)
	);


	/**
	 * 2.6 - General Settings: Page with a single post
	 * -------------------------------------------------------------
	 */

	// Heading
	$wp_customize->add_setting(
		'nimbo_general_settings_single_post',
		array(
			'default'			=> '',
			'sanitize_callback'	=> 'esc_html',
		)
	);

	$wp_customize->add_control(
		new nimbo_customize_control_heading(
			$wp_customize,
			'nimbo_general_settings_single_post',
			array(
				'label'		=> __( 'Single Post Page', 'nimbo' ),
				'section'	=> 'nimbo_general_settings_section',
				'settings'	=> 'nimbo_general_settings_single_post',
			)
		)
	);


	// Single post page: Default layout
	$wp_customize->add_setting(
		'nimbo_single_post_global_layout',
		array(
			'default'			=> 'right_sidebar',
			'sanitize_callback'	=> 'nimbo_sanitize_single_post_global_layout',
		)
	);

	$wp_customize->add_control(
		'nimbo_single_post_global_layout',
		array(
			'type'		=> 'select',
			'label'		=> __( 'Single Post Page: Default Layout', 'nimbo' ),
			'section'	=> 'nimbo_general_settings_section',
			'choices'	=> array(
				'right_sidebar'	=> esc_html__( 'Post with right sidebar', 'nimbo' ),
				'left_sidebar'	=> esc_html__( 'Post with left sidebar', 'nimbo' ),
				'full_width'	=> esc_html__( 'Full width post (without sidebar)', 'nimbo' ),
			),
		)
	);


	// Default post layout: Description
	$wp_customize->add_setting(
		'nimbo_single_post_global_layout_desc',
		array(
			'default'			=> __( 'Here you can change the default layout for all your posts. You can also change the layout for each post in the post settings: "WordPress Dashboard > Posts > Add new or Edit existing post > Post Layout > Single post page: Layout".', 'nimbo' ),
			'sanitize_callback'	=> 'esc_html',
		)
	);

	$wp_customize->add_control(
		new nimbo_customize_control_description(
			$wp_customize,
			'nimbo_single_post_global_layout_desc',
			array(
				'label'		=> __( 'Default Post Layout: Description', 'nimbo' ),
				'section'	=> 'nimbo_general_settings_section',
				'settings'	=> 'nimbo_single_post_global_layout_desc',
			)
		)
	);


	// Full width post: Image size (Original or Cropped)
	$wp_customize->add_setting(
		'nimbo_single_image_size',
		array(
			'default'			=> 'cropped',
			'sanitize_callback'	=> 'nimbo_sanitize_single_image_size',
		)
	);

	$wp_customize->add_control(
		'nimbo_single_image_size',
		array(
			'type'		=> 'select',
			'label'		=> __( 'Full Width Post: Image Size', 'nimbo' ),
			'section'	=> 'nimbo_general_settings_section',
			'choices'	=> array(
				'cropped'	=> esc_html__( 'Cropped image', 'nimbo' ),
				'original'	=> esc_html__( 'Original size', 'nimbo' ),
			),
		)
	);


	// Show icons when you hover on featured image
	$wp_customize->add_setting(
		'nimbo_single_image_show_hover_icons',
		array(
			'default'			=> 1,
			'sanitize_callback'	=> 'nimbo_sanitize_checkbox',
		)
	);

	$wp_customize->add_control(
		'nimbo_single_image_show_hover_icons',
		array(
			'type'		=> 'checkbox',
			'label'		=> __( 'Show icons when you hover on featured image (option for single post page)', 'nimbo' ),
			'section'	=> 'nimbo_general_settings_section',
		)
	);


	// Show date
	$wp_customize->add_setting(
		'nimbo_single_show_date',
		array(
			'default'			=> 1,
			'sanitize_callback'	=> 'nimbo_sanitize_checkbox',
		)
	);

	$wp_customize->add_control(
		'nimbo_single_show_date',
		array(
			'type'		=> 'checkbox',
			'label'		=> __( 'Show date (option for single post page)', 'nimbo' ),
			'section'	=> 'nimbo_general_settings_section',
		)
	);


	// Show author
	$wp_customize->add_setting(
		'nimbo_single_show_author',
		array(
			'default'			=> 1,
			'sanitize_callback'	=> 'nimbo_sanitize_checkbox',
		)
	);

	$wp_customize->add_control(
		'nimbo_single_show_author',
		array(
			'type'		=> 'checkbox',
			'label'		=> __( 'Show author (option for single post page)', 'nimbo' ),
			'section'	=> 'nimbo_general_settings_section',
		)
	);


	// Show categories
	$wp_customize->add_setting(
		'nimbo_single_show_categories',
		array(
			'default'			=> 1,
			'sanitize_callback'	=> 'nimbo_sanitize_checkbox',
		)
	);

	$wp_customize->add_control(
		'nimbo_single_show_categories',
		array(
			'type'		=> 'checkbox',
			'label'		=> __( 'Show categories', 'nimbo' ),
			'section'	=> 'nimbo_general_settings_section',
		)
	);


	// if Nimbo Social Media plugin is activated
	if ( function_exists( 'nimbo_social_media_single_post_share' ) ) {

		// Show social share buttons
		$wp_customize->add_setting(
			'nimbo_single_show_share_buttons',
			array(
				'default'			=> 1,
				'sanitize_callback'	=> 'nimbo_sanitize_checkbox',
			)
		);

		$wp_customize->add_control(
			'nimbo_single_show_share_buttons',
			array(
				'type'		=> 'checkbox',
				'label'		=> __( 'Show social share buttons (option for single post page)', 'nimbo' ),
				'section'	=> 'nimbo_general_settings_section',
			)
		);

	}


	// if Nimbo Social Media plugin is activated
	if ( function_exists( 'nimbo_social_media_comments_counter' ) && function_exists( 'nimbo_social_media_get_like' ) ) {

		// Show comments counter
		$wp_customize->add_setting(
			'nimbo_single_show_comments_counter',
			array(
				'default'			=> 1,
				'sanitize_callback'	=> 'nimbo_sanitize_checkbox',
			)
		);

		$wp_customize->add_control(
			'nimbo_single_show_comments_counter',
			array(
				'type'		=> 'checkbox',
				'label'		=> __( 'Show comments counter', 'nimbo' ),
				'section'	=> 'nimbo_general_settings_section',
			)
		);


		// Show "I like" counter
		$wp_customize->add_setting(
			'nimbo_single_show_like_counter',
			array(
				'default'			=> 1,
				'sanitize_callback'	=> 'nimbo_sanitize_checkbox',
			)
		);

		$wp_customize->add_control(
			'nimbo_single_show_like_counter',
			array(
				'type'		=> 'checkbox',
				'label'		=> __( 'Show "I like" counter (option for single post page)', 'nimbo' ),
				'section'	=> 'nimbo_general_settings_section',
			)
		);

	}


	// Show "About the author" section
	$wp_customize->add_setting(
		'nimbo_show_about_author',
		array(
			'default'			=> 0,
			'sanitize_callback'	=> 'nimbo_sanitize_checkbox',
		)
	);

	$wp_customize->add_control(
		'nimbo_show_about_author',
		array(
			'type'		=> 'checkbox',
			'label'		=> __( 'Show "About the author" section', 'nimbo' ),
			'section'	=> 'nimbo_general_settings_section',
		)
	);


	// Show related posts
	$wp_customize->add_setting(
		'nimbo_show_related_posts',
		array(
			'default'			=> 0,
			'sanitize_callback'	=> 'nimbo_sanitize_checkbox',
		)
	);

	$wp_customize->add_control(
		'nimbo_show_related_posts',
		array(
			'type'		=> 'checkbox',
			'label'		=> __( 'Show related posts', 'nimbo' ),
			'section'	=> 'nimbo_general_settings_section',
		)
	);


	/**
	 * 2.7 - General Settings: Single Page
	 * -------------------------------------------------------------
	 */

	// Heading
	$wp_customize->add_setting(
		'nimbo_general_settings_single_page',
		array(
			'default'			=> '',
			'sanitize_callback'	=> 'esc_html',
		)
	);

	$wp_customize->add_control(
		new nimbo_customize_control_heading(
			$wp_customize,
			'nimbo_general_settings_single_page',
			array(
				'label'		=> __( 'Single Page', 'nimbo' ),
				'section'	=> 'nimbo_general_settings_section',
				'settings'	=> 'nimbo_general_settings_single_page',
			)
		)
	);


	// Single page: Default layout
	$wp_customize->add_setting(
		'nimbo_single_page_global_layout',
		array(
			'default'			=> 'right_sidebar',
			'sanitize_callback'	=> 'nimbo_sanitize_single_page_global_layout',
		)
	);

	$wp_customize->add_control(
		'nimbo_single_page_global_layout',
		array(
			'type'		=> 'select',
			'label'		=> __( 'Single Page: Default Layout', 'nimbo' ),
			'section'	=> 'nimbo_general_settings_section',
			'choices'	=> array(
				'right_sidebar'	=> esc_html__( 'Page with right sidebar', 'nimbo' ),
				'left_sidebar'	=> esc_html__( 'Page with left sidebar', 'nimbo' ),
				'full_width'	=> esc_html__( 'Full width page (without sidebar)', 'nimbo' ),
			),
		)
	);


	// Default page layout: Description
	$wp_customize->add_setting(
		'nimbo_single_page_global_layout_desc',
		array(
			'default'			=> __( 'Here you can change the default layout for all your pages. You can also change the layout for each page in the page settings: "WordPress Dashboard > Pages > Add new or Edit existing page > General Settings for the Page > Page layout".', 'nimbo' ),
			'sanitize_callback'	=> 'esc_html',
		)
	);

	$wp_customize->add_control(
		new nimbo_customize_control_description(
			$wp_customize,
			'nimbo_single_page_global_layout_desc',
			array(
				'label'		=> __( 'Default Page Layout: Description', 'nimbo' ),
				'section'	=> 'nimbo_general_settings_section',
				'settings'	=> 'nimbo_single_page_global_layout_desc',
			)
		)
	);


	/**
	 * 2.8 - General Settings: Footer
	 * -------------------------------------------------------------
	 */

	// Heading
	$wp_customize->add_setting(
		'nimbo_general_settings_footer',
		array(
			'default'			=> '',
			'sanitize_callback'	=> 'esc_html',
		)
	);

	$wp_customize->add_control(
		new nimbo_customize_control_heading(
			$wp_customize,
			'nimbo_general_settings_footer',
			array(
				'label'		=> __( 'Footer', 'nimbo' ),
				'section'	=> 'nimbo_general_settings_section',
				'settings'	=> 'nimbo_general_settings_footer',
			)
		)
	);


	// Copyright text
	$wp_customize->add_setting(
		'nimbo_footer_copyright_text',
		array(
			'default'			=> '',
			'sanitize_callback'	=> 'nimbo_sanitize_wp_kses_html_tags_text',
		)
	);

	$wp_customize->add_control(
		'nimbo_footer_copyright_text',
		array(
			'label'		=> __( 'Copyright Text', 'nimbo' ),
			'section'	=> 'nimbo_general_settings_section',
			'type'		=> 'textarea',
		)
	);


	// Copyright text: Allowed HTML tags
	$wp_customize->add_setting(
		'nimbo_footer_copyright_text_desc',
		array(
			'default'			=> __( 'Allowed HTML tags: a, span, strong, b, em, i, br. Allowed attributes: a - href, title, target, class, rel. span - class. i - class.', 'nimbo' ),
			'sanitize_callback'	=> 'esc_html',
		)
	);

	$wp_customize->add_control(
		new nimbo_customize_control_description(
			$wp_customize,
			'nimbo_footer_copyright_text_desc',
			array(
				'label'		=> __( 'Copyright Text: Allowed HTML Tags', 'nimbo' ),
				'section'	=> 'nimbo_general_settings_section',
				'settings'	=> 'nimbo_footer_copyright_text_desc',
			)
		)
	);


	// Show social links or footer menu
	$wp_customize->add_setting(
		'nimbo_footer_links_type',
		array(
			'default'			=> 'menu',
			'sanitize_callback'	=> 'nimbo_sanitize_footer_links_type',
		)
	);

	$wp_customize->add_control(
		'nimbo_footer_links_type',
		array(
			'type'		=> 'select',
			'label'		=> __( 'Show Social Links Or Menu In The Footer', 'nimbo' ),
			'section'	=> 'nimbo_general_settings_section',
			'choices'	=> array(
				'menu'			=> esc_html__( 'Footer menu', 'nimbo' ),
				'social-links'	=> esc_html__( 'Social links', 'nimbo' ),
			),
		)
	);


	// Social links
	$wp_customize->add_setting(
		'nimbo_footer_social_links',
		array(
			'default'			=> '',
			'sanitize_callback'	=> 'nimbo_sanitize_wp_kses_html_tags_links',
		)
	);

	$wp_customize->add_control(
		'nimbo_footer_social_links',
		array(
			'label'		=> __( 'Social Links', 'nimbo' ),
			'section'	=> 'nimbo_general_settings_section',
			'type'		=> 'textarea',
		)
	);


	// Social links: Allowed HTML tags
	$wp_customize->add_setting(
		'nimbo_footer_social_links_desc',
		array(
			'default'			=> __( 'Allowed HTML tags: a, span, i. Allowed attributes: a - href, title, target, class, rel. span - class. i - class. An example of filling this field you can see in the documentation.', 'nimbo' ),
			'sanitize_callback'	=> 'esc_html',
		)
	);

	$wp_customize->add_control(
		new nimbo_customize_control_description(
			$wp_customize,
			'nimbo_footer_social_links_desc',
			array(
				'label'		=> __( 'Social Links: Allowed HTML Tags', 'nimbo' ),
				'section'	=> 'nimbo_general_settings_section',
				'settings'	=> 'nimbo_footer_social_links_desc',
			)
		)
	);


	/**
	 * 2.9 - General Settings: Other Settings
	 * -------------------------------------------------------------
	 */

	// Heading
	$wp_customize->add_setting(
		'nimbo_general_settings_other',
		array(
			'default'			=> '',
			'sanitize_callback'	=> 'esc_html',
		)
	);

	$wp_customize->add_control(
		new nimbo_customize_control_heading(
			$wp_customize,
			'nimbo_general_settings_other',
			array(
				'label'		=> __( 'Other Settings', 'nimbo' ),
				'section'	=> 'nimbo_general_settings_section',
				'settings'	=> 'nimbo_general_settings_other',
			)
		)
	);


	// Default color scheme (Light or Dark)
	$wp_customize->add_setting(
		'nimbo_default_color_scheme',
		array(
			'default'			=> 'light',
			'sanitize_callback'	=> 'nimbo_sanitize_color_scheme',
		)
	);

	$wp_customize->add_control(
		'nimbo_default_color_scheme',
		array(
			'type'		=> 'select',
			'label'		=> __( 'Default Color Scheme', 'nimbo' ),
			'section'	=> 'nimbo_general_settings_section',
			'choices'	=> array(
				'light'	=> esc_html__( 'Light', 'nimbo' ),
				'dark'	=> esc_html__( 'Dark', 'nimbo' ),
			),
		)
	);


	// Default color scheme: description
	$wp_customize->add_setting(
		'nimbo_default_color_scheme_desc',
		array(
			'default'			=> __( 'This option will change the default color scheme for your site. Important! If your current browser has the "nimbo_site_style" cookie with information about the current theme style, then for this browser the color scheme will be what is written in this cookie file. For all other visitors, who do not have the "nimbo_site_style" cookie about the current style, the color scheme will be changed to the selected by default.', 'nimbo' ),
			'sanitize_callback'	=> 'esc_html',
		)
	);

	$wp_customize->add_control(
		new nimbo_customize_control_description(
			$wp_customize,
			'nimbo_default_color_scheme_desc',
			array(
				'label'		=> __( 'Default Color Scheme: Description', 'nimbo' ),
				'section'	=> 'nimbo_general_settings_section',
				'settings'	=> 'nimbo_default_color_scheme_desc',
			)
		)
	);


	// Show "Back to top" button
	$wp_customize->add_setting(
		'nimbo_show_to_top_button',
		array(
			'default'			=> 1,
			'sanitize_callback'	=> 'nimbo_sanitize_checkbox',
		)
	);

	$wp_customize->add_control(
		'nimbo_show_to_top_button',
		array(
			'type'		=> 'checkbox',
			'label'		=> __( 'Show "Back to top" button', 'nimbo' ),
			'section'	=> 'nimbo_general_settings_section',
		)
	);


	// Enable cookies for the theme color switching function
	$wp_customize->add_setting(
		'nimbo_color_switch_enable_cookies',
		array(
			'default'			=> 1,
			'sanitize_callback'	=> 'nimbo_sanitize_checkbox',
		)
	);

	$wp_customize->add_control(
		'nimbo_color_switch_enable_cookies',
		array(
			'type'		=> 'checkbox',
			'label'		=> __( 'Enable cookies for the theme color switching function', 'nimbo' ),
			'section'	=> 'nimbo_general_settings_section',
		)
	);


	// if Nimbo Cookies Information plugin is activated
	if ( function_exists( 'nimbo_cookies_information_window' ) ) {

		// Show "Cookies information" window
		$wp_customize->add_setting(
			'nimbo_show_cookies_info',
			array(
				'default'			=> 0,
				'sanitize_callback'	=> 'nimbo_sanitize_checkbox',
			)
		);

		$wp_customize->add_control(
			'nimbo_show_cookies_info',
			array(
				'type'		=> 'checkbox',
				'label'		=> __( 'Show "Cookies information" window', 'nimbo' ),
				'section'	=> 'nimbo_general_settings_section',
			)
		);


		// "Cookies information" window: Window type on mobile devices
		$wp_customize->add_setting(
			'nimbo_cookies_info_on_mobile',
			array(
				'default'			=> 'hidden-window',
				'sanitize_callback'	=> 'nimbo_sanitize_cookies_info_on_mobile',
			)
		);

		$wp_customize->add_control(
			'nimbo_cookies_info_on_mobile',
			array(
				'type'		=> 'select',
				'label'		=> __( '"Cookies Information" Window: Window Type On Mobile Devices', 'nimbo' ),
				'section'	=> 'nimbo_general_settings_section',
				'choices'	=> array(
					'hidden-window'		=> esc_html__( 'Hidden window', 'nimbo' ),
					'visible-window'	=> esc_html__( 'Visible window', 'nimbo' ),
				),
			)
		);


		// "Cookies information" window: Text
		$wp_customize->add_setting(
			'nimbo_cookies_info_text',
			array(
				'default'			=> 'Our website use cookies. If you continue to use this site we will assume that you are happy with this.',
				'sanitize_callback'	=> 'nimbo_sanitize_wp_kses_html_tags_text_p',
			)
		);

		$wp_customize->add_control(
			'nimbo_cookies_info_text',
			array(
				'label'		=> __( '"Cookies Information" Window: Text', 'nimbo' ),
				'section'	=> 'nimbo_general_settings_section',
				'type'		=> 'textarea',
			)
		);


		// "Cookies information" window: Text - Allowed HTML tags
		$wp_customize->add_setting(
			'nimbo_cookies_info_text_desc',
			array(
				'default'			=> __( 'This is a required field (If this field is empty, the window will not appear). Allowed HTML tags: p, a, span, strong, b, em, i, br. Allowed attributes: p - class. a - href, title, target, class, rel. span - class. i - class.', 'nimbo' ),
				'sanitize_callback'	=> 'esc_html',
			)
		);

		$wp_customize->add_control(
			new nimbo_customize_control_description(
				$wp_customize,
				'nimbo_cookies_info_text_desc',
				array(
					'label'		=> __( '"Cookies Information" Window: Text - Allowed HTML Tags', 'nimbo' ),
					'section'	=> 'nimbo_general_settings_section',
					'settings'	=> 'nimbo_cookies_info_text_desc',
				)
			)
		);


		// "Cookies information" window: Accept button text
		$wp_customize->add_setting(
			'nimbo_cookies_accept_btn_text',
			array(
				'default'			=> 'Accept',
				'sanitize_callback'	=> 'esc_html',
			)
		);

		$wp_customize->add_control(
			'nimbo_cookies_accept_btn_text',
			array(
				'label'		=> __( '"Cookies Information" Window: Accept Button Text', 'nimbo' ),
				'section'	=> 'nimbo_general_settings_section',
				'type'		=> 'text',
			)
		);


		// "Cookies information" window: Accept button text - Description
		$wp_customize->add_setting(
			'nimbo_cookies_accept_btn_text_desc',
			array(
				'default'			=> __( 'This is a required field (If this field is empty, the window will not appear).', 'nimbo' ),
				'sanitize_callback'	=> 'esc_html',
			)
		);

		$wp_customize->add_control(
			new nimbo_customize_control_description(
				$wp_customize,
				'nimbo_cookies_accept_btn_text_desc',
				array(
					'label'		=> __( '"Cookies Information" Window: Accept Button Text - Description', 'nimbo' ),
					'section'	=> 'nimbo_general_settings_section',
					'settings'	=> 'nimbo_cookies_accept_btn_text_desc',
				)
			)
		);

	}


	/**
	 * 3.0 - Fonts
	 * -------------------------------------------------------------
	 */

	// Add new section
	$wp_customize->add_section(
		'nimbo_fonts_section',
		array(
			'title'		=> __( 'Fonts', 'nimbo' ),
			'priority'	=> 22,
		)
	);


	// Information about fonts
	$wp_customize->add_setting(
		'nimbo_fonts_info',
		array(
			'default'			=> __( 'The theme uses four Google fonts: Lora (main font), Source Sans Pro (headings, logo text, menus, copyright text, and "cookies information" window), Playfair Display (blockquote items), and PT Sans (metadata).', 'nimbo' ),
			'sanitize_callback'	=> 'esc_html',
		)
	);

	$wp_customize->add_control(
		new nimbo_customize_control_description(
			$wp_customize,
			'nimbo_fonts_info',
			array(
				'label'		=> __( 'Information About Fonts', 'nimbo' ),
				'section'	=> 'nimbo_fonts_section',
				'settings'	=> 'nimbo_fonts_info',
			)
		)
	);


	// Character sets
	$wp_customize->add_setting(
		'nimbo_fonts_character_sets',
		array(
			'default'			=> '',
			'sanitize_callback'	=> 'esc_html',
		)
	);

	$wp_customize->add_control(
		'nimbo_fonts_character_sets',
		array(
			'label'		=> __( 'Character Sets', 'nimbo' ),
			'section'	=> 'nimbo_fonts_section',
			'type'		=> 'textarea',
		)
	);


	// Character sets: Description
	$wp_customize->add_setting(
		'nimbo_fonts_character_sets_desc',
		array(
			'default'			=> __( 'Specify which subsets should be used. Multiple subsets must be separated with commas (,) and must be entered without spaces. Example: cyrillic,cyrillic-ext,latin-ext', 'nimbo' ),
			'sanitize_callback'	=> 'esc_html',
		)
	);

	$wp_customize->add_control(
		new nimbo_customize_control_description(
			$wp_customize,
			'nimbo_fonts_character_sets_desc',
			array(
				'label'		=> __( 'Character Sets: Description', 'nimbo' ),
				'section'	=> 'nimbo_fonts_section',
				'settings'	=> 'nimbo_fonts_character_sets_desc',
			)
		)
	);


	/**
	 * 3.1 - Font styles
	 * -------------------------------------------------------------
	 */

	// Heading
	$wp_customize->add_setting(
		'nimbo_fonts_styles',
		array(
			'default'			=> '',
			'sanitize_callback'	=> 'esc_html',
		)
	);

	$wp_customize->add_control(
		new nimbo_customize_control_heading(
			$wp_customize,
			'nimbo_fonts_styles',
			array(
				'label'		=> __( 'Styles', 'nimbo' ),
				'section'	=> 'nimbo_fonts_section',
				'settings'	=> 'nimbo_fonts_styles',
			)
		)
	);


	// Main font (default: Lora)
	$wp_customize->add_setting(
		'nimbo_main_font_style',
		array(
			'default'			=> '400,400i,700,700i',
			'sanitize_callback'	=> 'esc_html',
		)
	);

	$wp_customize->add_control(
		'nimbo_main_font_style',
		array(
			'label'		=> __( 'Main Font (Default Font: Lora; Default Styles: 400,400i,700,700i)', 'nimbo' ),
			'section'	=> 'nimbo_fonts_section',
			'type'		=> 'text',
		)
	);


	// Font for headings (default: Source Sans Pro)
	$wp_customize->add_setting(
		'nimbo_headings_font_style',
		array(
			'default'			=> '400,600,700',
			'sanitize_callback'	=> 'esc_html',
		)
	);

	$wp_customize->add_control(
		'nimbo_headings_font_style',
		array(
			'label'		=> __( 'Font For Headings (Default Font: Source Sans Pro; Default Styles: 400,600,700)', 'nimbo' ),
			'section'	=> 'nimbo_fonts_section',
			'type'		=> 'text',
		)
	);


	// Font for quotes (blockquote items, default: Playfair Display)
	$wp_customize->add_setting(
		'nimbo_blockquote_font_style',
		array(
			'default'			=> '400,400i',
			'sanitize_callback'	=> 'esc_html',
		)
	);

	$wp_customize->add_control(
		'nimbo_blockquote_font_style',
		array(
			'label'		=> __( 'Font For Quotes (Blockquote Items; Default Font: Playfair Display; Default Styles: 400,400i)', 'nimbo' ),
			'section'	=> 'nimbo_fonts_section',
			'type'		=> 'text',
		)
	);


	// Font for metadata (default: PT Sans)
	$wp_customize->add_setting(
		'nimbo_metadata_font_style',
		array(
			'default'			=> '400,700',
			'sanitize_callback'	=> 'esc_html',
		)
	);

	$wp_customize->add_control(
		'nimbo_metadata_font_style',
		array(
			'label'		=> __( 'Font For Metadata (Default Font: PT Sans; Default Styles: 400,700)', 'nimbo' ),
			'section'	=> 'nimbo_fonts_section',
			'type'		=> 'text',
		)
	);


	/**
	 * 4.0 - Colors
	 * -------------------------------------------------------------
	 */

	// Hover/active color (Light style)
	$wp_customize->add_setting(
		'nimbo_light_style_hover_color',
		array(
			'default'			=> '#6ca4db',
			'sanitize_callback'	=> 'sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'nimbo_light_style_hover_color',
			array(
				'label'		=> esc_html__( 'Hover/Active Color', 'nimbo' ),
				'section'	=> 'colors',
				'settings'	=> 'nimbo_light_style_hover_color',
			)
		)
	);


	// Background color (Dark style)
	$wp_customize->add_setting(
		'nimbo_dark_style_bg_color',
		array(
			'default'			=> '#0b0b0c',
			'sanitize_callback'	=> 'sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'nimbo_dark_style_bg_color',
			array(
				'label'		=> esc_html__( 'Background Color (Dark Style)', 'nimbo' ),
				'section'	=> 'colors',
				'settings'	=> 'nimbo_dark_style_bg_color',
			)
		)
	);


	// Hover/active color (Dark style)
	$wp_customize->add_setting(
		'nimbo_dark_style_hover_color',
		array(
			'default'			=> '#6ca4db',
			'sanitize_callback'	=> 'sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'nimbo_dark_style_hover_color',
			array(
				'label'		=> esc_html__( 'Hover/Active Color (Dark Style)', 'nimbo' ),
				'section'	=> 'colors',
				'settings'	=> 'nimbo_dark_style_hover_color',
			)
		)
	);


	/**
	 * 5.0 - Header Text
	 * -------------------------------------------------------------
	 */

	// Add new section
	$wp_customize->add_section(
		'nimbo_header_text_section',
		array(
			'title'		=> __( 'Header Text', 'nimbo' ),
			'priority'	=> 61,
		)
	);


	// Custom title
	$wp_customize->add_setting(
		'nimbo_header_custom_title',
		array(
			'default'			=> '',
			'sanitize_callback'	=> 'nimbo_sanitize_wp_kses_html_tags_title',
		)
	);

	$wp_customize->add_control(
		'nimbo_header_custom_title',
		array(
			'label'		=> __( 'Custom Title', 'nimbo' ),
			'section'	=> 'nimbo_header_text_section',
			'type'		=> 'text',
		)
	);


	// Custom title: Allowed HTML tags
	$wp_customize->add_setting(
		'nimbo_header_custom_title_desc',
		array(
			'default'			=> __( 'Allowed HTML tags: a, span, strong, b, em, i. Allowed attributes: a - href, title, target, class, rel. span - class. i - class.', 'nimbo' ),
			'sanitize_callback'	=> 'esc_html',
		)
	);

	$wp_customize->add_control(
		new nimbo_customize_control_description(
			$wp_customize,
			'nimbo_header_custom_title_desc',
			array(
				'label'		=> __( 'Header Text: Custom Title - Allowed HTML Tags', 'nimbo' ),
				'section'	=> 'nimbo_header_text_section',
				'settings'	=> 'nimbo_header_custom_title_desc',
			)
		)
	);


	// Custom text
	$wp_customize->add_setting(
		'nimbo_header_custom_text',
		array(
			'default'			=> '',
			'sanitize_callback'	=> 'nimbo_sanitize_wp_kses_html_tags_text',
		)
	);

	$wp_customize->add_control(
		'nimbo_header_custom_text',
		array(
			'label'		=> __( 'Custom Text', 'nimbo' ),
			'section'	=> 'nimbo_header_text_section',
			'type'		=> 'textarea',
		)
	);


	// Custom text: Allowed HTML tags
	$wp_customize->add_setting(
		'nimbo_header_custom_text_desc',
		array(
			'default'			=> __( 'Allowed HTML tags: a, span, strong, b, em, i, br. Allowed attributes: a - href, title, target, class, rel. span - class. i - class.', 'nimbo' ),
			'sanitize_callback'	=> 'esc_html',
		)
	);

	$wp_customize->add_control(
		new nimbo_customize_control_description(
			$wp_customize,
			'nimbo_header_custom_text_desc',
			array(
				'label'		=> __( 'Header Text: Custom Text - Allowed HTML Tags', 'nimbo' ),
				'section'	=> 'nimbo_header_text_section',
				'settings'	=> 'nimbo_header_custom_text_desc',
			)
		)
	);

}
add_action( 'customize_register', 'nimbo_customize_register' );
