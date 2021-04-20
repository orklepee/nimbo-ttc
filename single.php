<?php
/**
 * The template for displaying all Single posts
 *
 * @package WordPress
 * @subpackage Nimbo
 * @since Nimbo 1.0
 */

// header
get_header();

// start the loop
while ( have_posts() ) : the_post();

	// post ID, format
	$blog_post_id = $post->ID;
	$blog_post_format = get_post_format();
	if ( false === $blog_post_format ) {
		$blog_post_format = 'standard';
	}

	// single post page: layout
	$single_post_layout = get_post_meta( $blog_post_id, 'nimbo_mb_single_post_layout', true ); // right_sidebar, left_sidebar, or full_width
	if ( ! $single_post_layout ) {
		$single_post_layout = get_theme_mod( 'nimbo_single_post_global_layout', 'right_sidebar' ); // right_sidebar, left_sidebar, or full_width
	}

	// post with password or not
	$is_password_protected = post_password_required();

	// this is an attachment page or not
	$is_attachment_page = is_attachment();

	// social share buttons: show or hide
	$show_share_buttons_opt = get_theme_mod( 'nimbo_single_show_share_buttons', 1 ); // 1 or 0
	$show_share_buttons = ( function_exists( 'nimbo_social_media_single_post_share' ) && $show_share_buttons_opt ) ? true : false;
	?>

	<!-- single blog post -->
	<section id="bwp-single-post">
		<div class="container">

			<?php if ( 'right_sidebar' === $single_post_layout ) { ?>
				<div class="row"><div class="col-md-8 bwp-single-post-col bwp-sidebar-right">
			<?php } elseif ( 'left_sidebar' === $single_post_layout ) { ?>
				<div class="row"><div class="col-md-8 col-md-push-4 bwp-single-post-col bwp-sidebar-left">
			<?php } ?>

			<!-- single post container -->
			<div class="bwp-single-post-container<?php echo ( 'full_width' === $single_post_layout ) ? ' bwp-full-width-layout' : ''; ?>" role="main">

				<!-- single post -->
				<article id="bwp-post-<?php echo (int) $blog_post_id; ?>" <?php post_class(); ?>>

					<?php
					// media (featured image / slider / video / audio; show only if the post is not password protected)
					if ( ! $is_password_protected ) {
						if ( 'gallery' === $blog_post_format || 'video' === $blog_post_format || 'audio' === $blog_post_format ) {
							get_template_part( 'templates/single-post-media/media', $blog_post_format );
						} else {
							get_template_part( 'templates/single-post-media/media', 'image' );
						}
					}
					?>

					<!-- content -->
					<div class="bwp-post-content">

						<?php
						// metadata (date, author, categories)
						if ( ! $is_attachment_page ) {
							nimbo_show_single_post_metadata();
						}

						// post content (title and full post content)
						nimbo_show_single_post_content();

						// tags, share icons, counters, and post navigation (show only on a single post)
						if ( ! $is_attachment_page ) {

							// if the post is not password protected...
							if ( ! $is_password_protected ) {

								// if the social share buttons are hidden, show tags and counters
								if ( ! $show_share_buttons ) {
									?>

									<!-- tags and counters -->
									<div class="bwp-single-post-tags-counters clearfix">

										<?php
										// tags
										nimbo_show_single_post_tags();

										// counters (comments and likes)
										nimbo_show_single_post_counters();
										?>

									</div>
									<!-- end: tags and counters -->

									<?php
								} else {

									// show only tags
									nimbo_show_single_post_tags();

								}

								// share icons and counters; show this section only if the social share buttons are visible
								if ( $show_share_buttons ) {
									?>

									<!-- share icons and counters -->
									<div class="clearfix">

										<?php
										// social share buttons
										nimbo_social_media_single_post_share();

										// counters (comments and likes)
										nimbo_show_single_post_counters();
										?>

									</div>
									<!-- end: share icons and counters -->

									<?php
								}

							}

							// post navigation
							the_post_navigation( array(
								'next_text' => '<span class="meta-nav">' . esc_html__( 'Next post', 'nimbo' ) . '<i class="fas fa-caret-right"></i></span><span class="post-title-nav">%title</span>',
								'prev_text' => '<span class="meta-nav"><i class="fas fa-caret-left"></i>' . esc_html__( 'Previous post', 'nimbo' ) . '</span><span class="post-title-nav">%title</span>',
							) );

						} // end: tags, share icons, counters, and post navigation
						?>

					</div>
					<!-- end: content -->

				</article>
				<!-- end: single post -->

				<?php
				// about the author
				if ( ! $is_attachment_page ) {
					nimbo_show_about_the_author();
				}

				// comments
				if ( comments_open() || get_comments_number() ) {
					comments_template();
				}

				// related posts (by tags)
				if ( ! $is_attachment_page && ! $is_password_protected ) {
					get_template_part( 'templates/related-posts' );
				}
				?>

			</div>
			<!-- end: single post container -->

			<?php if ( 'right_sidebar' === $single_post_layout ) { ?>
				</div><!-- /col/single-post-col --><div class="col-md-4 bwp-sidebar-col bwp-sidebar-right">
			<?php } elseif ( 'left_sidebar' === $single_post_layout ) { ?>
				</div><!-- /col/single-post-col --><div class="col-md-4 col-md-pull-8 bwp-sidebar-col bwp-sidebar-left">
			<?php } ?>

			<?php
			if ( 'right_sidebar' === $single_post_layout || 'left_sidebar' === $single_post_layout ) {
				// show sidebar
				get_sidebar();
				?>
				</div><!-- /col/sidebar-col --></div><!-- /row -->
				<?php
			}
			?>

		</div>
	</section>
	<!-- end: single blog post -->

	<?php
endwhile;
// end of the loop

// footer
get_footer();
