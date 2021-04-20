<?php
/**
 * Header type 1 (One row)
 *
 * @package WordPress
 * @subpackage Nimbo
 * @since Nimbo 1.0
 */
?>

<!-- header (type 1) -->
<header id="bwp-header">
	<div class="container">
		<div class="bwp-header-container clearfix">

			<?php
			// custom logo (image or text)
			nimbo_show_custom_logo();

			// dropdown search form
			nimbo_show_dropdown_search();

			// color switch (moon icon)
			nimbo_show_color_switch();

			// menus (id: nimbo_main_menu)
			if ( has_nav_menu( 'nimbo_main_menu' ) ) {

				// standard menu
				nimbo_show_main_menu();

				// mobile menu
				nimbo_show_mobile_menu();

			}
			?>

		</div>
	</div>
</header>
<!-- end: header -->
