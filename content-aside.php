<?php
/**
 * The template for displaying posts in the Aside post format
 *
 * This format is suitable for brief snippets of text that aren’t quite whole blog posts, such as quick thoughts and anecdotes.
 *
 * @link https://codex.wordpress.org/Post_Formats
 *
 * @package WordPress
 * @subpackage Nimbo
 * @since Nimbo 1.0
 */

// post ID, format
$blog_post_id = $post->ID;
$blog_post_format = 'aside';

// post with password or not
$is_password_protected = post_password_required();

// show or hide avatars (WordPress Settings > Discussion > Avatars > Avatar Display: Show Avatars)
$show_avatars = get_option( 'show_avatars' );
?>

<!-- post - aside format -->
<article id="bwp-post-<?php echo (int) $blog_post_id; ?>" <?php post_class(); ?>>
	<div class="bwp-post-wrap bwp-post-aside-format<?php echo ( ! $show_avatars ) ? ' bwp-no-avatars' : ''; ?>">

		<?php
		// sticky post: icon
		if ( is_sticky() ) {
			?>

			<!-- sticky post - icon -->
			<div class="bwp-post-sticky-mark">
				<i class="fas fa-thumbtack"></i>
			</div>
			<!-- end: sticky post - icon -->

			<?php
		}

		// featured image
		if ( ! $is_password_protected ) {
			get_template_part( 'templates/blog-post-media/media', 'image' );
		}
		?>

		<!-- content -->
		<div class="bwp-post-content">

			<?php
			// link to single page
			nimbo_show_post_permalink();

			// date
			nimbo_show_post_date();

			// post content (title and excerpt)
			nimbo_show_post_content( $blog_post_format );
			?>

			<!-- author and icons -->
			<div class="clearfix">

				<?php
				// author (avatar and name)
				nimbo_show_post_author( $show_avatars );

				// icons (heart and social share)
				if ( ! $is_password_protected ) {
					nimbo_show_post_icons();
				}
				?>

			</div>
			<!-- end: author and icons -->

			<?php
			// recent comments
			if ( ! $is_password_protected ) {
				nimbo_show_post_recent_comments( $show_avatars );
			}
			?>

		</div>
		<!-- end: content -->

	</div>
</article>
<!-- end: post - aside format -->