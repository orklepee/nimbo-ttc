<?php
/**
 * Slider / Featured image (Single post page)
 *
 * @package WordPress
 * @subpackage Nimbo
 * @since Nimbo 1.0
 */

// post ID
$blog_post_id = $post->ID;

// single post page: layout
$single_post_layout = get_post_meta( $blog_post_id, 'nimbo_mb_single_post_layout', true ); // right_sidebar, left_sidebar, or full_width
if ( ! $single_post_layout ) {
	$single_post_layout = get_theme_mod( 'nimbo_single_post_global_layout', 'right_sidebar' ); // right_sidebar, left_sidebar, or full_width
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

// hover icons: show or hide
$show_hover_icons = get_theme_mod( 'nimbo_single_image_show_hover_icons', 1 ); // 1 or 0

// gallery images ID
$gallery_images_id = get_post_meta( $blog_post_id, 'nimbo_mb_gallery', false );
if ( ! is_array( $gallery_images_id ) ) {
	$gallery_images_id = (array) $gallery_images_id;
}

// if $gallery_images_id is not empty
if ( ! empty( $gallery_images_id ) && $gallery_images_id[0] ) {

	// number of gallery images
	$gallery_images_num = count( $gallery_images_id );
	if ( $gallery_images_num > 1 ) { // several images in the gallery
		?>

		<!-- slider with images -->
		<div class="bwp-post-media-slider">
			<div id="bwp-post-owl-slider-<?php echo (int) $blog_post_id; ?>" class="bwp-post-slider owl-carousel owl-theme bwp-popup-gallery">

				<?php
				foreach ( $gallery_images_id as $gallery_image_id ) {

					// image data: url, caption, and alt
					$gallery_image_url = wp_get_attachment_image_url( $gallery_image_id, $image_size );
					$gallery_image_caption = get_post( $gallery_image_id )->post_excerpt;
					$gallery_image_alt = get_post_meta( $gallery_image_id, '_wp_attachment_image_alt', true );

					if ( $show_hover_icons ) {

						// full size image: url
						$gallery_full_image_url = wp_get_attachment_image_url( $gallery_image_id, $full_image_size );
						?>

						<!-- slider item -->
						<figure class="bwp-post-slider-item<?php if ( $is_full_image ) { echo ' bwp-full-image'; } ?>">
							<img src="<?php echo esc_url( $gallery_image_url ); ?>" alt="<?php if ( $gallery_image_alt ) { echo esc_attr( $gallery_image_alt ); } else { the_title_attribute(); } ?>">
							<div class="bwp-post-bg-overlay"></div>
							<div class="bwp-post-hover-buttons">
								<a href="<?php echo esc_url( $gallery_full_image_url ); ?>" class="bwp-popup-gallery-item" title="<?php if ( $gallery_image_caption ) { echo esc_attr( $gallery_image_caption ); } else { the_title_attribute(); } ?>">
									<i class="fas fa-expand"></i>
								</a>
								<a href="<?php echo esc_url( $gallery_full_image_url ); ?>" target="_blank" rel="noopener">
									<i class="fas fa-file-image"></i>
								</a>
							</div>
							<?php if ( $gallery_image_caption ) { ?>
								<figcaption class="bwp-post-image-caption"><?php echo esc_html( $gallery_image_caption ); ?></figcaption>
							<?php } ?>
						</figure>
						<!-- end: slider item -->

						<?php
					} else {
						?>

						<!-- slider item -->
						<figure class="bwp-post-slider-item">
							<img src="<?php echo esc_url( $gallery_image_url ); ?>" alt="<?php if ( $gallery_image_alt ) { echo esc_attr( $gallery_image_alt ); } else { the_title_attribute(); } ?>">
							<?php if ( $gallery_image_caption ) { ?>
								<figcaption class="bwp-post-image-caption"><?php echo esc_html( $gallery_image_caption ); ?></figcaption>
							<?php } ?>
						</figure>
						<!-- end: slider item -->

						<?php
					}

				}
				?>

			</div>
		</div>
		<!-- end: slider with images -->

		<?php
	} else { // one image in the gallery

		// image data: url, caption, and alt
		$gallery_image_url = wp_get_attachment_image_url( $gallery_images_id[0], $image_size );
		$gallery_image_caption = get_post( $gallery_images_id[0] )->post_excerpt;
		$gallery_image_alt = get_post_meta( $gallery_images_id[0], '_wp_attachment_image_alt', true );

		if ( $show_hover_icons ) {

			// full size image: url
			$gallery_full_image_url = wp_get_attachment_image_url( $gallery_images_id[0], $full_image_size );
			?>

			<!-- single gallery image -->
			<figure class="bwp-post-media<?php if ( $is_full_image ) { echo ' bwp-full-image'; } ?>">
				<img src="<?php echo esc_url( $gallery_image_url ); ?>" alt="<?php if ( $gallery_image_alt ) { echo esc_attr( $gallery_image_alt ); } else { the_title_attribute(); } ?>">
				<div class="bwp-post-bg-overlay"></div>
				<div class="bwp-post-hover-buttons">
					<a href="<?php echo esc_url( $gallery_full_image_url ); ?>" class="bwp-popup-image" title="<?php if ( $gallery_image_caption ) { echo esc_attr( $gallery_image_caption ); } else { the_title_attribute(); } ?>">
						<i class="fas fa-expand"></i>
					</a>
					<a href="<?php echo esc_url( $gallery_full_image_url ); ?>" target="_blank" rel="noopener">
						<i class="fas fa-file-image"></i>
					</a>
				</div>
				<?php if ( $gallery_image_caption ) { ?>
					<figcaption class="bwp-post-image-caption"><?php echo esc_html( $gallery_image_caption ); ?></figcaption>
				<?php } ?>
			</figure>
			<!-- end: single gallery image -->

			<?php
		} else {
			?>

			<!-- single gallery image -->
			<figure class="bwp-post-media">
				<img src="<?php echo esc_url( $gallery_image_url ); ?>" alt="<?php if ( $gallery_image_alt ) { echo esc_attr( $gallery_image_alt ); } else { the_title_attribute(); } ?>">
				<?php if ( $gallery_image_caption ) { ?>
					<figcaption class="bwp-post-image-caption"><?php echo esc_html( $gallery_image_caption ); ?></figcaption>
				<?php } ?>
			</figure>
			<!-- end: single gallery image -->

			<?php
		}

	}

} else {

	// show featured image...
	if ( has_post_thumbnail() ) {

		// image data: id and caption
		$image_id = get_post_thumbnail_id();
		$image_caption = get_post( $image_id )->post_excerpt;

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

}
