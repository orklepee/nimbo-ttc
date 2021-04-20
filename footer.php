<?php
/**
 * The template for displaying the footer
 *
 * @package WordPress
 * @subpackage Nimbo
 * @since Nimbo 1.0
 */

// footer widgets
if ( is_active_sidebar( 'nimbo_footer_sidebar_1' ) || is_active_sidebar( 'nimbo_footer_sidebar_2' ) || is_active_sidebar( 'nimbo_footer_sidebar_3' ) ) {
	?>

	<!-- footer widgets -->
	<section id="bwp-footer-widgets" role="complementary">
		<div class="container">
			<div class="bwp-footer-widgets-container">
				<h2 class="screen-reader-text">
					<?php esc_html_e( 'Widgets', 'nimbo' ); ?>
				</h2>
				<div class="row">

					<!-- column 1 -->
					<div class="col-md-4 bwp-footer-col-1">
						<?php
						if ( is_active_sidebar( 'nimbo_footer_sidebar_1' ) ) {
							dynamic_sidebar( 'nimbo_footer_sidebar_1' );
						}
						?>
					</div>
					<!-- end: column 1 -->

					<!-- column 2 -->
					<div class="col-md-4 bwp-footer-col-2">
						<?php
						if ( is_active_sidebar( 'nimbo_footer_sidebar_2' ) ) {
							dynamic_sidebar( 'nimbo_footer_sidebar_2' );
						}
						?>
					</div>
					<!-- end: column 2 -->

					<!-- column 3 -->
					<div class="col-md-4 bwp-footer-col-3">
						<?php
						if ( is_active_sidebar( 'nimbo_footer_sidebar_3' ) ) {
							dynamic_sidebar( 'nimbo_footer_sidebar_3' );
						}
						?>
					</div>
					<!-- end: column 3 -->

				</div>
			</div>
		</div>
	</section>
	<!-- end: footer widgets -->

	<?php
} // end: footer widgets
?>

<!-- footer -->
<footer id="bwp-footer">
	<div class="container">
		<div class="bwp-footer-container clearfix">

			<?php
			// footer text (copyright text)
			$copyright_text = get_theme_mod( 'nimbo_footer_copyright_text' );
			if ( $copyright_text ) {
				?>

				<!-- footer text -->
				<div class="bwp-footer-text">
					<?php
					echo wp_kses( $copyright_text, array(
						'a'			=> array(
							'href'		=> array(),
							'title'		=> array(),
							'target'	=> array(),
							'class'		=> array(),
							'rel'		=> array(),
						),
						'span'		=> array(
							'class'		=> array()
						),
						'strong'	=> array(),
						'b'			=> array(),
						'em'		=> array(),
						'i'			=> array(
							'class'		=> array()
						),
						'br'		=> array(),
					) );
					?>
				</div>
				<!-- end: footer text -->

				<?php
			}

			// footer links type
			$footer_links_type = get_theme_mod( 'nimbo_footer_links_type', 'menu' ); // 'menu' or 'social-links'
			if ( 'social-links' === $footer_links_type ) {

				// social links
				$social_links = get_theme_mod( 'nimbo_footer_social_links' );
				if ( $social_links ) {
					?>

					<!-- social links -->
					<div class="bwp-footer-social-links clearfix">
						<?php
						echo wp_kses( $social_links, array(
							'a'			=> array(
								'href'		=> array(),
								'title'		=> array(),
								'target'	=> array(),
								'class'		=> array(),
								'rel'		=> array(),
							),
							'span'		=> array(
								'class'		=> array()
							),
							'i'			=> array(
								'class'		=> array()
							),
						) );
						?>
					</div>
					<!-- end: social links -->

					<?php
				}

			} else {

				// footer menu (nimbo_footer_menu)
				if ( has_nav_menu( 'nimbo_footer_menu' ) ) {
					?>

					<!-- footer menu -->
					<div class="bwp-footer-menu-wrap">
						<?php
						wp_nav_menu( array(
							'theme_location'	=> 'nimbo_footer_menu',
							'container'			=> 'nav',
							'menu_class'		=> 'bwp-footer-menu list-unstyled clearfix',
						) );
						?>
					</div>
					<!-- end: footer menu -->

					<?php
				}

			}
			?>

		</div>
	</div>
</footer>
<!-- end: footer -->

<?php
// "cookies information" window (show only if the "Nimbo Cookies Information" plugin is activated)
if ( function_exists( 'nimbo_cookies_information_window' ) ) {
	nimbo_cookies_information_window();
}
?>

<?php wp_footer(); ?>
</body>
</html>
