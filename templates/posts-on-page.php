<?php
/**
 * Blog posts on the page
 *
 * @package WordPress
 * @subpackage Nimbo
 * @since Nimbo 1.0
 */

// page layout
$page_layout = get_post_meta( $post->ID, 'nimbo_mb_page_layout', true ); // right_sidebar, left_sidebar, or full_width
if ( ! $page_layout ) {
	$page_layout = get_theme_mod( 'nimbo_single_page_global_layout', 'right_sidebar' ); // right_sidebar, left_sidebar, or full_width
}

// maximum number of posts
if ( 'full_width' === $page_layout ) {
	$max_posts_number = 3;
	$max_posts_number_class = 'bwp-show-3-page-posts';
} else {
	$max_posts_number = 2;
	$max_posts_number_class = 'bwp-show-2-page-posts';
}

// new query arguments
$posts_on_page_args = array(
	'post_type'				=> 'post',
	'posts_per_page'		=> (int) $max_posts_number,
	'orderby'				=> 'rand',
	'ignore_sticky_posts'	=> true,
);

// start query
$posts_on_page = new WP_Query( $posts_on_page_args );
if ( $posts_on_page->have_posts() ) :
	?>

	<!-- blog posts -->
	<div class="bwp-page-posts <?php echo sanitize_html_class( $max_posts_number_class ); ?>">
		<!-- title -->
		<h2 class="bwp-container-title"><?php esc_html_e( 'Posts from our blog', 'nimbo' ); ?></h2>
		<!-- end: title -->
		<!-- posts list -->
		<div class="bwp-page-posts-list clearfix">

			<?php
			while ( $posts_on_page->have_posts() ) :
				$posts_on_page->the_post();
				$blog_post_format = get_post_format();
				if ( false === $blog_post_format ) {
					get_template_part( 'content', 'standard' );
				} else {
					get_template_part( 'content', $blog_post_format );
				}
			endwhile;
			?>

		</div>
		<!-- end: posts list -->
	</div>
	<!-- end: blog posts -->

	<?php
endif;

// reset post data
wp_reset_postdata();
