<?php
/**
 * Featured image / Slider (Blog post)
 *
 * @package WordPress
 * @subpackage Nimbo
 * @since Nimbo 1.0
 */

// post ID
$blog_post_id = $post->ID;

// thumbnail type
$gallery_thumb_type = get_post_meta( $blog_post_id, 'nimbo_mb_gallery_thumb_type', true ); // 'featured_image' or 'slider'
if ( ! $gallery_thumb_type ) {
	$gallery_thumb_type = 'slider'; // default
}

// image size
$image_size = 'full';
$popup_image_size = 'full';

// image attributes
$image_attr = '';
if ( ! is_singular() ) {
	$image_attr = array( 'loading' => '' );
}

// hover icons: show or hide
$show_hover_icons = get_theme_mod( 'nimbo_image_show_hover_icons', 1 ); // 1 or 0

// thumbnail type = featured image
if ( 'featured_image' === $gallery_thumb_type ) {

	// if the post has a featured image
	if ( has_post_thumbnail() ) {

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
					<a href="<?php the_permalink(); ?>">
						<i class="fas fa-share"></i>
					</a>
				</div>
			</figure>
			<!-- end: featured image -->

			<?php
		} else {
			?>

			<!-- featured image -->
			<figure class="bwp-post-media bwp-no-hover-buttons">
				<a href="<?php the_permalink(); ?>" class="bwp-post-media-link">
					<?php the_post_thumbnail( $image_size, $image_attr ); ?>
					<div class="bwp-post-bg-overlay"></div>
				</a>
			</figure>
			<!-- end: featured image -->

			<?php
		}

	}

// thumbnail type = slider
} else {

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

						// image url and image alt
						$gallery_image_url = wp_get_attachment_image_url( $gallery_image_id, $image_size );
						$gallery_image_alt = get_post_meta( $gallery_image_id, '_wp_attachment_image_alt', true );

						if ( $show_hover_icons ) {

							// pop-up image url and image caption
							$gallery_popup_image_url = wp_get_attachment_image_url( $gallery_image_id, $popup_image_size );
							$gallery_image_caption = get_post( $gallery_image_id )->post_excerpt;
							?>

							<!-- slider item -->
							<figure class="bwp-post-slider-item">
								<img src="<?php echo esc_url( $gallery_image_url ); ?>" alt="<?php if ( $gallery_image_alt ) { echo esc_attr( $gallery_image_alt ); } else { the_title_attribute(); } ?>">
								<div class="bwp-post-bg-overlay"></div>
								<div class="bwp-post-hover-buttons">
									<a href="<?php echo esc_url( $gallery_popup_image_url ); ?>" class="bwp-popup-gallery-item" title="<?php if ( $gallery_image_caption ) { echo esc_attr( $gallery_image_caption ); } else { the_title_attribute(); } ?>">
										<i class="fas fa-camera"></i>
									</a>
									<a href="<?php the_permalink(); ?>">
										<i class="fas fa-share"></i>
									</a>
								</div>
							</figure>
							<!-- end: slider item -->

							<?php
						} else {
							?>

							<!-- slider item -->
							<figure class="bwp-post-slider-item bwp-no-hover-buttons">
								<a href="<?php the_permalink(); ?>" class="bwp-post-media-link">
									<img src="<?php echo esc_url( $gallery_image_url ); ?>" alt="<?php if ( $gallery_image_alt ) { echo esc_attr( $gallery_image_alt ); } else { the_title_attribute(); } ?>">
									<div class="bwp-post-bg-overlay"></div>
								</a>
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

			// image url and image alt
			$gallery_image_url = wp_get_attachment_image_url( $gallery_images_id[0], $image_size );
			$gallery_image_alt = get_post_meta( $gallery_images_id[0], '_wp_attachment_image_alt', true );

			if ( $show_hover_icons ) {

				// pop-up image url and image caption
				$gallery_popup_image_url = wp_get_attachment_image_url( $gallery_images_id[0], $popup_image_size );
				$gallery_image_caption = get_post( $gallery_images_id[0] )->post_excerpt;
				?>

				<!-- single gallery image -->
				<figure class="bwp-post-media">
					<img src="<?php echo esc_url( $gallery_image_url ); ?>" alt="<?php if ( $gallery_image_alt ) { echo esc_attr( $gallery_image_alt ); } else { the_title_attribute(); } ?>">
					<div class="bwp-post-bg-overlay"></div>
					<div class="bwp-post-hover-buttons">
						<a href="<?php echo esc_url( $gallery_popup_image_url ); ?>" class="bwp-popup-image" title="<?php if ( $gallery_image_caption ) { echo esc_attr( $gallery_image_caption ); } else { the_title_attribute(); } ?>">
							<i class="fas fa-camera"></i>
						</a>
						<a href="<?php the_permalink(); ?>">
							<i class="fas fa-share"></i>
						</a>
					</div>
				</figure>
				<!-- end: single gallery image -->

				<?php
			} else {
				?>

				<!-- single gallery image -->
				<figure class="bwp-post-media bwp-no-hover-buttons">
					<a href="<?php the_permalink(); ?>" class="bwp-post-media-link">
						<img src="<?php echo esc_url( $gallery_image_url ); ?>" alt="<?php if ( $gallery_image_alt ) { echo esc_attr( $gallery_image_alt ); } else { the_title_attribute(); } ?>">
						<div class="bwp-post-bg-overlay"></div>
					</a>
				</figure>
				<!-- end: single gallery image -->

				<?php
			}

		}

	}

}
