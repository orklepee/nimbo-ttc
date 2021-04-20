<?php
/**
 * The template for displaying all pages
 *
 * @package WordPress
 * @subpackage Nimbo
 * @since Nimbo 1.0
 */

// header
get_header();

// start the loop
while ( have_posts() ) : the_post();

	// page ID
	$page_id = $post->ID;

	// page with password or not
	$is_password_protected = post_password_required();

	// this is an attachment page or not
	$is_attachment_page = is_attachment();

	// page layout
	$page_layout = get_post_meta( $page_id, 'nimbo_mb_page_layout', true ); // right_sidebar, left_sidebar, or full_width
	if ( ! $page_layout ) {
		$page_layout = get_theme_mod( 'nimbo_single_page_global_layout', 'right_sidebar' ); // right_sidebar, left_sidebar, or full_width
	}

	// show/hide options:
	// 1 - metadata (date and author)
	$page_metadata = get_post_meta( $page_id, 'nimbo_mb_page_metadata', true ); // show / hide
	if ( ! $page_metadata ) {
		$page_metadata = 'show'; // default
	}
	$show_metadata = ( 'show' === $page_metadata && ! $is_password_protected && ! $is_attachment_page ) ? true : false;
	// 2 - social share buttons
	$page_share_buttons = get_post_meta( $page_id, 'nimbo_social_media_page_show_share_buttons', true ); // show / hide
	if ( ! $page_share_buttons ) {
		$page_share_buttons = 'show'; // default
	}
	$show_share_buttons = ( function_exists( 'nimbo_social_media_single_post_share' ) && 'show' === $page_share_buttons && ! $is_password_protected && ! $is_attachment_page ) ? true : false;
	// 3 - blog posts
	$show_blog_posts = get_post_meta( $page_id, 'nimbo_mb_page_blog_posts', true ); // show / hide
	if ( ! $show_blog_posts ) {
		$show_blog_posts = 'hide'; // default
	}

	// some css classes
	$page_content_class = '';
	if ( ! $show_metadata && ! $show_share_buttons ) {
		$page_content_class = 'bwp-page-only-content';
	} elseif ( ! $show_metadata || ! $show_share_buttons ) {
		if ( ! $show_metadata ) {
			$page_content_class = 'bwp-page-no-metadata';
		} else {
			$page_content_class = 'bwp-page-no-social-share';
		}
	}
	?>

	<!-- single blog post (post type: page) -->
	<section id="bwp-single-post">
		<div class="container">

			<?php if ( 'right_sidebar' === $page_layout ) { ?>
				<div class="row"><div class="col-md-8 bwp-single-post-col bwp-sidebar-right">
			<?php } elseif ( 'left_sidebar' === $page_layout ) { ?>
				<div class="row"><div class="col-md-8 col-md-push-4 bwp-single-post-col bwp-sidebar-left">
			<?php } ?>

			<!-- single post container -->
			<div class="bwp-single-post-container<?php echo ( 'full_width' === $page_layout ) ? ' bwp-full-width-layout' : ''; ?>" role="main">

				<!-- single post -->
				<article id="bwp-page-<?php echo (int) $page_id; ?>" <?php post_class(); ?>>

					<?php
					// featured image
					if ( ! $is_password_protected ) {
						get_template_part( 'templates/single-post-media/media', 'image' );
					}
					?>

					<!-- content -->
					<div class="bwp-post-content<?php if ( $page_content_class ) { echo ' ' . sanitize_html_class( $page_content_class ); } ?>">

						<?php
						// metadata (date and author)
						if ( $show_metadata ) {
							nimbo_show_single_post_metadata( 'page' );
						}

						// page content (title and full page content)
						nimbo_show_single_post_content();

						// social share buttons
						if ( $show_share_buttons ) {
							nimbo_social_media_single_post_share();
						}
						?>

					</div>
					<!-- end: content -->

				</article>
				<!-- end: single post -->

				<?php
				// comments
				if ( comments_open() || get_comments_number() ) {
					comments_template();
				}

				// blog posts
				if ( 'show' === $show_blog_posts ) {
					get_template_part( 'templates/posts-on-page' );
				}
				?>

			</div>
			<!-- end: single post container -->

			<?php if ( 'right_sidebar' === $page_layout ) { ?>
				</div><!-- /col/single-post-col --><div class="col-md-4 bwp-sidebar-col bwp-sidebar-right">
			<?php } elseif ( 'left_sidebar' === $page_layout ) { ?>
				</div><!-- /col/single-post-col --><div class="col-md-4 col-md-pull-8 bwp-sidebar-col bwp-sidebar-left">
			<?php } ?>

			<?php
			if ( 'right_sidebar' === $page_layout || 'left_sidebar' === $page_layout ) {
				// show sidebar
				get_sidebar();
				?>
				</div><!-- /col/sidebar-col --></div><!-- /row -->
				<?php
			}
			?>

		</div>
	</section>
	<!-- end: single blog post (post type: page) -->

	<?php
endwhile;
// end of the loop

// footer
get_footer();
