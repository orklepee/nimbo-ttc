<?php
/**
 * Header type 2 (Two rows)
 *
 * @package WordPress
 * @subpackage Nimbo
 * @since Nimbo 1.0
 */
?>

<!-- header (type 2) -->
<header id="bwp-header" class="bwp-header-two-rows">

	<!-- row 1 - logo container -->
	<div class="bwp-header-logo-row">
		<div class="container">
			<div class="bwp-header-logo-row-container clearfix">

				<?php
				// custom logo (image or text)
				nimbo_show_custom_logo();
				?>

			</div>
		</div>
	</div>
	<!-- end: row 1 - logo container -->

	<!-- row 2 - navigation container -->
	<div class="bwp-header-nav-row">
		<div class="container">
			<div class="bwp-header-nav-row-container clearfix">

				<?php
				// menus (id: nimbo_main_menu)
				if ( has_nav_menu( 'nimbo_main_menu' ) ) {

					// standard menu
					nimbo_show_main_menu();

					// mobile menu
					nimbo_show_mobile_menu();

				}

				// dropdown search form
				nimbo_show_dropdown_search();

				// color switch (moon icon)
				nimbo_show_color_switch();
				?>

			</div>
		</div>
	</div>
	<!-- end: row 2 - navigation container -->

</header>
<!-- end: header -->
