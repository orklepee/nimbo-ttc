<?php
/**
 * The template for displaying related posts by tags
 *
 * @package WordPress
 * @subpackage Nimbo
 * @since Nimbo 1.0
 */

// show or hide related posts
$show_related_posts = get_theme_mod( 'nimbo_show_related_posts', 0 ); // 1 or 0
if ( $show_related_posts ) {

	// current post ID
	$current_post_id = $post->ID;

	// get current post tags
	$current_post_tags = wp_get_post_terms( $current_post_id );
	if ( $current_post_tags ) {

		// get tags IDs
		$current_post_tags_count = count( $current_post_tags );
		for ( $i = 0; $i < $current_post_tags_count; $i++ ) {
			$current_post_tag_IDs[ $i ] = $current_post_tags[ $i ]->term_id;
		}

		// single post page: layout
		$single_post_layout = get_post_meta( $current_post_id, 'nimbo_mb_single_post_layout', true ); // right_sidebar, left_sidebar, or full_width
		if ( ! $single_post_layout ) {
			$single_post_layout = get_theme_mod( 'nimbo_single_post_global_layout', 'right_sidebar' ); // right_sidebar, left_sidebar, or full_width
		}

		// maximum number of posts
		if ( 'full_width' === $single_post_layout ) {
			$max_posts_number = 3;
			$max_posts_number_class = 'bwp-show-3-related-posts';
		} else {
			$max_posts_number = 2;
			$max_posts_number_class = 'bwp-show-2-related-posts';
		}

		// new query arguments
		$related_posts_args = array(
			'tag__in'				=> $current_post_tag_IDs,
			'post__not_in'			=> array( $current_post_id ),
			'posts_per_page'		=> (int) $max_posts_number,
			'orderby'				=> 'rand',
			'ignore_sticky_posts'	=> true,
		);

		// start query
		$related_posts = new WP_Query( $related_posts_args );
		if ( $related_posts->have_posts() ) :
			?>

			<!-- related posts (by tags) -->
			<div class="bwp-related-posts <?php echo sanitize_html_class( $max_posts_number_class ); ?>">
				<!-- title -->
				<h2 class="bwp-container-title"><?php esc_html_e( 'You may also like', 'nimbo' ); ?></h2>
				<!-- end: title -->
				<!-- posts list -->
				<div class="bwp-related-posts-list clearfix">

					<?php
					while ( $related_posts->have_posts() ) :
						$related_posts->the_post();
						$related_post_format = get_post_format();
						if ( false === $related_post_format ) {
							get_template_part( 'content', 'standard' );
						} else {
							get_template_part( 'content', $related_post_format );
						}
					endwhile;
					?>

				</div>
				<!-- end: posts list -->
			</div>
			<!-- end: related posts -->

			<?php
		endif;

		// reset post data
		wp_reset_postdata();

	}

}
