<?php
/**
 * The sidebar template file
 *
 * It is located in the left or right column of the theme
 *
 * @package WordPress
 * @subpackage Nimbo
 * @since Nimbo 1.0
 */

// sidebar (id: nimbo_sidebar)
if ( is_active_sidebar( 'nimbo_sidebar' ) ) {
	?>

	<!-- sidebar -->
	<div class="bwp-sidebar-container" role="complementary">
		<?php dynamic_sidebar( 'nimbo_sidebar' ); ?>
	</div>
	<!-- end: sidebar -->

	<?php
}
