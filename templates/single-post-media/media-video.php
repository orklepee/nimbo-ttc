<?php
/**
 * Featured image / Video player (Single post page)
 *
 * @package WordPress
 * @subpackage Nimbo
 * @since Nimbo 1.0
 */

// post ID
$blog_post_id = $post->ID;

// thumbnail type
$video_thumb_type = get_post_meta( $blog_post_id, 'nimbo_mb_video_thumb_type', true ); // iframe or featured_image
if ( ! $video_thumb_type ) {
	$video_thumb_type = 'iframe'; // default
}

// video URL
$video_url = get_post_meta( $blog_post_id, 'nimbo_mb_video_url', true );

// thumbnail type = featured image
if ( 'featured_image' === $video_thumb_type ) {

	// if the post has a featured image
	if ( has_post_thumbnail() ) {

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

		// image data: id and caption
		$image_id = get_post_thumbnail_id();
		$image_caption = get_post( $image_id )->post_excerpt;

		// hover icons: show or hide
		$show_hover_icons = get_theme_mod( 'nimbo_single_image_show_hover_icons', 1 ); // 1 or 0
		if ( $show_hover_icons ) {

			// full size image: url
			$full_image_url = wp_get_attachment_image_url( $image_id, $full_image_size );

			// if $video_url is not empty
			if ( $video_url ) {

				// get embed code
				$video_embed_code_escaped = wp_oembed_get( esc_url( $video_url ) ); // this variable has been safely escaped

				// pop-up window with image or video?
				if ( $video_embed_code_escaped ) {

					// iframe
					$is_popup_iframe = true;
					// new image size (show full image)
					$image_size = 'full';

				} else {

					// image
					$is_popup_iframe = false;

				}

			} else {

				// image
				$is_popup_iframe = false;

			}
			?>

			<!-- featured image -->
			<figure class="bwp-post-media<?php if ( $is_full_image || $is_popup_iframe ) { echo ' bwp-full-image'; } ?>">
				<?php the_post_thumbnail( $image_size ); ?>
				<div class="bwp-post-bg-overlay"></div>
				<div class="bwp-post-hover-buttons">
					<?php if ( $is_popup_iframe ) { ?>
						<a href="#bwp-popup-video-<?php echo (int) $blog_post_id; ?>" class="bwp-popup-video">
							<i class="fas fa-play"></i>
						</a>
					<?php } else { ?>
						<a href="<?php echo esc_url( $full_image_url ); ?>" class="bwp-popup-image" title="<?php if ( $image_caption ) { echo esc_attr( $image_caption ); } else { the_title_attribute(); } ?>">
							<i class="fas fa-expand"></i>
						</a>
					<?php } ?>
					<a href="<?php echo esc_url( $full_image_url ); ?>" target="_blank" rel="noopener">
						<i class="fas fa-file-image"></i>
					</a>
				</div>
				<?php if ( $image_caption ) { ?>
					<figcaption class="bwp-post-image-caption"><?php echo esc_html( $image_caption ); ?></figcaption>
				<?php } ?>
			</figure>
			<!-- end: featured image -->

			<?php if ( $is_popup_iframe ) { ?>
				<!-- video (pop-up window) -->
				<div id="bwp-popup-video-<?php echo (int) $blog_post_id; ?>" class="bwp-video-popup-container mfp-hide">
					<div class="bwp-iframe-video-wrap">
						<?php echo ! empty( $video_embed_code_escaped ) ? $video_embed_code_escaped : ''; ?>
					</div>
				</div>
				<!-- end: video (pop-up window) -->
			<?php } ?>

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

// thumbnail type = iframe
} else {

	// if $video_url is not empty
	if ( $video_url ) {

		// get embed code
		$video_embed_code_escaped = wp_oembed_get( esc_url( $video_url ) ); // this variable has been safely escaped

		if ( $video_embed_code_escaped ) {
			?>

			<!-- video player -->
			<figure class="bwp-post-media">
				<div class="bwp-iframe-video-wrap">
					<?php echo ! empty( $video_embed_code_escaped ) ? $video_embed_code_escaped : ''; ?>
				</div>
			</figure>
			<!-- end: video player -->

			<?php
		}

	}

}
