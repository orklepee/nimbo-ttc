<?php
/**
 * Featured image (Blog post)
 *
 * @package WordPress
 * @subpackage Nimbo
 * @since Nimbo 1.0
 */

// if the post has a featured image
if ( has_post_thumbnail() ) {

	// image size
	$image_size = 'full';
	$popup_image_size = 'full';

	// image attributes
	$image_attr = '';
	if ( ! is_singular() ) {
		$image_attr = array( 'loading' => '' );
	}

	// post format
	$format = get_post_format();
	if ( false === $format ) {
		$format = 'standard';
	}

	// link format
	if ( 'link' === $format ) {
		// get url
		$link_url = nimbo_get_link_url();
		// target attribute
		$get_link_target = get_post_meta( $post->ID, 'nimbo_mb_link_target', true ); // 'self' or 'blank'
		if ( ! $get_link_target ) {
			$get_link_target = 'blank'; // default
		}
		$link_target = ( 'blank' === $get_link_target ) ? '_blank' : '_self';
	}

	// hover icons: show or hide
	$show_hover_icons = get_theme_mod( 'nimbo_image_show_hover_icons', 1 ); // 1 or 0
	if ( $show_hover_icons ) {

		// image data
		$image_id = get_post_thumbnail_id();
		$popup_image_url = wp_get_attachment_image_url( $image_id, $popup_image_size );
		$image_caption = get_post( $image_id )->post_excerpt;
		?>

		<!-- featured image -->
		<figure class="bwp-post-media">
			<?php the_post_thumbnail( $image_size, $image_attr ); ?>
			<div class="bwp-post-bg-overlay"></div>
			<div class="bwp-post-hover-buttons">
				<a href="<?php echo esc_url( $popup_image_url ); ?>" class="bwp-popup-image" title="<?php if ( $image_caption ) { echo esc_attr( $image_caption ); } else { the_title_attribute(); } ?>">
					<i class="fas fa-camera"></i>
				</a>
				<?php if ( 'link' === $format ) { ?>
					<a href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"<?php if ( '_blank' === $link_target ) { echo ' rel="noopener"'; } ?>>
						<i class="fas fa-link"></i>
					</a>
				<?php } else { ?>
					<a href="<?php the_permalink(); ?>">
						<i class="fas fa-share"></i>
					</a>
				<?php } ?>
			</div>
		</figure>
		<!-- end: featured image -->

		<?php
	} else {
		?>

		<!-- featured image -->
		<figure class="bwp-post-media bwp-no-hover-buttons">
			<?php if ( 'link' === $format ) { ?>
				<a href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>" class="bwp-post-media-link"<?php if ( '_blank' === $link_target ) { echo ' rel="noopener"'; } ?>>
			<?php } else { ?>
				<a href="<?php the_permalink(); ?>" class="bwp-post-media-link">
			<?php } ?>
				<?php the_post_thumbnail( $image_size, $image_attr ); ?>
				<div class="bwp-post-bg-overlay"></div>
			</a>
		</figure>
		<!-- end: featured image -->

		<?php
	}

}
