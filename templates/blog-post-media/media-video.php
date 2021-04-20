<?php
/**
 * Featured image / Video player (Blog post)
 *
 * @package WordPress
 * @subpackage Nimbo
 * @since Nimbo 1.0
 */

// post ID
$blog_post_id = $post->ID;

// thumbnail type
$video_thumb_type = get_post_meta( $blog_post_id, 'nimbo_mb_video_thumb_type', true ); // 'iframe' or 'featured_image'
if ( ! $video_thumb_type ) {
	$video_thumb_type = 'iframe'; // default
}

// video URL
$video_url = get_post_meta( $blog_post_id, 'nimbo_mb_video_url', true );

// thumbnail type = featured image
if ( 'featured_image' === $video_thumb_type ) {

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

		// hover icons: show or hide
		$show_hover_icons = get_theme_mod( 'nimbo_image_show_hover_icons', 1 ); // 1 or 0
		if ( $show_hover_icons ) {

			// if $video_url is not empty
			if ( $video_url ) {

				// get embed code
				$video_embed_code_escaped = wp_oembed_get( esc_url( $video_url ) ); // this variable has been safely escaped

				// pop-up window with image or video?
				if ( $video_embed_code_escaped ) {

					// iframe
					$is_popup_iframe = true;

				} else {

					// image
					$is_popup_iframe = false;
					$image_id = get_post_thumbnail_id();
					$popup_image_url = wp_get_attachment_image_url( $image_id, $popup_image_size );
					$image_caption = get_post( $image_id )->post_excerpt;

				}

			} else {

				// image
				$is_popup_iframe = false;
				$image_id = get_post_thumbnail_id();
				$popup_image_url = wp_get_attachment_image_url( $image_id, $popup_image_size );
				$image_caption = get_post( $image_id )->post_excerpt;

			}
			?>

			<!-- featured image -->
			<figure class="bwp-post-media">
				<?php the_post_thumbnail( $image_size, $image_attr ); ?>
				<div class="bwp-post-bg-overlay"></div>
				<div class="bwp-post-hover-buttons">
					<?php if ( $is_popup_iframe ) { ?>
						<a href="#bwp-popup-video-<?php echo (int) $blog_post_id; ?>" class="bwp-popup-video">
							<i class="fas fa-play"></i>
						</a>
					<?php } else { ?>
						<a href="<?php echo esc_url( $popup_image_url ); ?>" class="bwp-popup-image" title="<?php if ( $image_caption ) { echo esc_attr( $image_caption ); } else { the_title_attribute(); } ?>">
							<i class="fas fa-camera"></i>
						</a>
					<?php } ?>
					<a href="<?php the_permalink(); ?>">
						<i class="fas fa-share"></i>
					</a>
				</div>
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
