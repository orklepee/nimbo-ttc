<?php
/**
 * The template for displaying a message that posts can not be found
 *
 * @package WordPress
 * @subpackage Nimbo
 * @since Nimbo 1.0
 */
?>

<!-- no results (content none) -->
<div class="bwp-no-results">

	<h3><?php esc_html_e( 'Nothing found', 'nimbo' ); ?></h3>

	<?php if ( is_home() && current_user_can( 'publish_posts' ) ) { ?>
		<p><?php printf( __( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'nimbo' ), esc_url( admin_url( 'post-new.php' ) ) ); ?></p>
	<?php } elseif ( is_search() ) { ?>
		<p><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'nimbo' ); ?></p>
	<?php } else { ?>
		<p><?php esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for.', 'nimbo' ); ?></p>
	<?php } ?>

</div>
<!-- end: no results -->
