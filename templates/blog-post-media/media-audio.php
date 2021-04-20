<?php
/**
 * Featured image / Audio player (Blog post)
 *
 * @package WordPress
 * @subpackage Nimbo
 * @since Nimbo 1.0
 */

// post ID
$blog_post_id = $post->ID;

// thumbnail type
$audio_thumb_type = get_post_meta( $blog_post_id, 'nimbo_mb_audio_thumb_type', true ); // 'iframe' or 'featured_image'
if ( ! $audio_thumb_type ) {
	$audio_thumb_type = 'iframe'; // default
}

// audio URL
$audio_url = get_post_meta( $blog_post_id, 'nimbo_mb_audio_url', true );

// thumbnail type = featured image
if ( 'featured_image' === $audio_thumb_type ) {

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

			// if $audio_url is not empty
			if ( $audio_url ) {

				// get embed code
				$audio_embed_code_escaped = wp_oembed_get( esc_url( $audio_url ) ); // this variable has been safely escaped

				// pop-up window with image or audio?
				if ( $audio_embed_code_escaped ) {

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
						<a href="#bwp-popup-audio-<?php echo (int) $blog_post_id; ?>" class="bwp-popup-audio">
							<i class="fas fa-music"></i>
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
				<!-- audio (pop-up window) -->
				<div id="bwp-popup-audio-<?php echo (int) $blog_post_id; ?>" class="bwp-audio-popup-container mfp-hide">
					<div class="bwp-iframe-audio-wrap">
						<?php echo ! empty( $audio_embed_code_escaped ) ? $audio_embed_code_escaped : ''; ?>
					</div>
				</div>
				<!-- end: audio (pop-up window) -->
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

	// if $audio_url is not empty
	if ( $audio_url ) {

		// get embed code
		$audio_embed_code_escaped = wp_oembed_get( esc_url( $audio_url ) ); // this variable has been safely escaped

		if ( $audio_embed_code_escaped ) {
			?>

			<!-- audio player -->
			<figure class="bwp-post-media">
				<div class="bwp-iframe-audio-wrap">
					<?php echo ! empty( $audio_embed_code_escaped ) ? $audio_embed_code_escaped : ''; ?>
				</div>
			</figure>
			<!-- end: audio player -->

			<?php
		}

	}

}
