<?php
/**
 * The template for displaying 404 page (Not Found)
 *
 * @package WordPress
 * @subpackage Nimbo
 * @since Nimbo 1.0
 */

// header
get_header();
?>

<!-- page 404 -->
<section id="bwp-page-404">
	<div class="container">
		<div class="bwp-page-404-container">
			<div class="bwp-page-404-content">
				<h1><?php esc_html_e( 'Oops... Error 404', 'nimbo' ); ?></h1>
				<h2><?php esc_html_e( 'We are sorry, but the page you are looking for does not exist.', 'nimbo' ); ?></h2>
				<p><?php printf( __( 'Please check entered address and try again or go to <a href="%1$s" rel="home"><strong>homepage</strong></a>.', 'nimbo' ), esc_url( home_url( '/' ) ) ); ?></p>
			</div>
		</div>
	</div>
</section>
<!-- end: page 404 -->

<?php
// footer
get_footer();
