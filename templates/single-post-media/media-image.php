<?php
/**
 * Featured image (Single post page)
 *
 * @package WordPress
 * @subpackage Nimbo
 * @since Nimbo 1.0
 */

// if the post has a featured image
if ( has_post_thumbnail() ) {

	// post ID and post type (post, page, attachment, etc)
	$blog_post_id = $post->ID;
	$blog_post_type = get_post_type();

	// default layout
	$single_post_layout = get_theme_mod( 'nimbo_single_post_global_layout', 'right_sidebar' ); // right_sidebar, left_sidebar, or full_width
	// layout for post or page
	if ( 'post' === $blog_post_type ) {
		// single post: layout
		$single_post_layout = get_post_meta( $blog_post_id, 'nimbo_mb_single_post_layout', true ); // right_sidebar, left_sidebar, or full_width
		if ( ! $single_post_layout ) {
			$single_post_layout = get_theme_mod( 'nimbo_single_post_global_layout', 'right_sidebar' ); // right_sidebar, left_sidebar, or full_width
		}
	} elseif ( 'page' === $blog_post_type ) {
		// page layout
		$single_post_layout = get_post_meta( $blog_post_id, 'nimbo_mb_page_layout', true ); // right_sidebar, left_sidebar, or full_width
		if ( ! $single_post_layout ) {
			$single_post_layout = get_theme_mod( 'nimbo_single_page_global_layout', 'right_sidebar' ); // right_sidebar, left_sidebar, or full_width
		}
	}

	// image size
	$image_size = 'full'; // default value
	$is_full_image = true;
	if ( 'full_width' === $single_post_layout ) {
		// new image size
		$full_width_single_image_size = get_theme_mod( 'nimbo_single_image_size', 'cropped' ); // 'cropped' or 'original'
		if ( 'cropped' === $full_width_single_image_size ) {
			$image_size = 'nimbo-1200x500-crop'; // show cropped image
			$is_full_image = false;
		}
	}
	$full_image_size = 'full';

	// image data: id and caption
	$image_id = get_post_thumbnail_id();
	$image_caption = get_post( $image_id )->post_excerpt;

	// hover icons: show or hide
	$show_hover_icons = get_theme_mod( 'nimbo_single_image_show_hover_icons', 1 ); // 1 or 0
	if ( $show_hover_icons ) {

		// full size image: url
		$full_image_url = wp_get_attachment_image_url( $image_id, $full_image_size );
		?>

		<!-- featured image -->
		<figure class="bwp-post-media<?php if ( $is_full_image ) { echo ' bwp-full-image'; } ?>">
			<?php the_post_thumbnail( $image_size ); ?>
			<div class="bwp-post-bg-overlay"></div>
			<div class="bwp-post-hover-buttons">
				<a href="<?php echo esc_url( $full_image_url ); ?>" class="bwp-popup-image" title="<?php if ( $image_caption ) { echo esc_attr( $image_caption ); } else { the_title_attribute(); } ?>">
					<i class="fas fa-expand"></i>
				</a>
				<a href="<?php echo esc_url( $full_image_url ); ?>" target="_blank" rel="noopener">
					<i class="fas fa-file-image"></i>
				</a>
			</div>
			<?php if ( $image_caption ) { ?>
				<figcaption class="bwp-post-image-caption"><?php echo esc_html( $image_caption ); ?></figcaption>
			<?php } ?>
		</figure>
		<!-- end: featured image -->

		<?php
	} else {
		?>

		<!-- featured image -->
		<figure class="bwp-post-media">
			<?php
			the_post_thumbnail( $image_size );
			if ( $image_caption ) {
				?>
				<figcaption class="bwp-post-image-caption"><?php echo esc_html( $image_caption ); ?></figcaption>
				<?php
			}
			?>
		</figure>
		<!-- end: featured image -->

		<?php
	}

}
