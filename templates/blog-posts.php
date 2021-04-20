<?php
/**
 * The template for displaying blog posts with pagination and sidebar
 *
 * @package WordPress
 * @subpackage Nimbo
 * @since Nimbo 1.0
 */

// layout
$blog_layout = get_theme_mod( 'nimbo_blog_layout', '3-columns' ); // '3-columns', '2-columns-left-sidebar', or '2-columns-right-sidebar'
?>

<!-- blog posts -->
<section id="bwp-posts">
	<div class="container">

		<?php if ( '2-columns-right-sidebar' === $blog_layout ) { ?>
			<div class="row"><div class="col-md-8 bwp-posts-col bwp-sidebar-right">
		<?php } elseif ( '2-columns-left-sidebar' === $blog_layout ) { ?>
			<div class="row"><div class="col-md-8 col-md-push-4 bwp-posts-col bwp-sidebar-left">
		<?php } ?>

		<!-- posts container -->
		<div class="bwp-posts-container">

			<?php
			// archive pages: heading
			nimbo_show_archive_heading();
			?>

			<!-- masonry -->
			<div id="bwp-masonry" class="bwp-masonry-container" role="main">

				<div class="<?php echo ( '3-columns' === $blog_layout ) ? 'bwp-col-3-default' : 'bwp-col-2-default'; ?>"></div><!-- default columnWidth -->

				<?php
				// start the loop
				if ( have_posts() ) :
					while ( have_posts() ) :
						the_post();
						$format = get_post_format();
						if ( false === $format ) {
							get_template_part( 'content', 'standard' );
						} else {
							get_template_part( 'content', $format );
						}
					endwhile;
				endif;
				// end the loop
				?>

			</div>
			<!-- end: masonry -->

			<?php
			// if no content, include the "No post found" template
			if ( ! have_posts() ) :
				get_template_part( 'content', 'none' );
			endif;
			?>

		</div>
		<!-- end: posts container -->

		<?php
		// pagination
		the_posts_pagination( array(
			'prev_text' => '<i class="fas fa-caret-left"></i>' . esc_html__( 'Newer posts', 'nimbo' ),
			'next_text' => esc_html__( 'Older posts', 'nimbo' ) . '<i class="fas fa-caret-right"></i>',
		) );
		?>

		<?php if ( '2-columns-right-sidebar' === $blog_layout ) { ?>
			</div><!-- /col/posts-col --><div class="col-md-4 bwp-sidebar-col bwp-sidebar-right">
		<?php } elseif ( '2-columns-left-sidebar' === $blog_layout ) { ?>
			</div><!-- /col/posts-col --><div class="col-md-4 col-md-pull-8 bwp-sidebar-col bwp-sidebar-left">
		<?php } ?>

		<?php
		if ( '2-columns-right-sidebar' === $blog_layout || '2-columns-left-sidebar' === $blog_layout ) {
			// show sidebar
			get_sidebar();
			?>
			</div><!-- /col/sidebar-col --></div><!-- /row -->
			<?php
		}
		?>

	</div>
</section>
<!-- end: blog posts -->
