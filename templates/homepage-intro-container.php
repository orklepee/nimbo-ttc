<?php
/**
 * Container with introductory text (header text) and background image (header image)
 *
 * @package WordPress
 * @subpackage Nimbo
 * @since Nimbo 1.0
 */

// show the container only on the first page or on all pages
$show_intro_on_first_page = get_theme_mod( 'nimbo_show_intro_on_first_page', 0 ); // 1 or 0

if ( $show_intro_on_first_page ) {
	$show_intro = ( ! is_paged() ) ? 'show' : 'hide';
} else {
	$show_intro = 'show';
}

if ( 'show' === $show_intro ) {

	// header image (url or empty string)
	$header_image_url = get_header_image();

	// custom title
	$header_custom_title = get_theme_mod( 'nimbo_header_custom_title' );

	// custom text
	$header_custom_text = get_theme_mod( 'nimbo_header_custom_text' );

	if ( $header_image_url || $header_custom_title || $header_custom_text ) {
		?>

		<!-- container with introductory text and background image -->
		<section id="bwp-intro">
			<div class="container">
				<div class="bwp-intro-container">

					<!-- background image (header image) -->
					<div class="bwp-intro-bg"<?php if ( $header_image_url ) { echo ' style="background-image: url(' . esc_url( $header_image_url ) . ');"'; } ?>>

						<?php if ( $header_custom_title || $header_custom_text ) { ?>

							<!-- content (bg overlay, title, and text) -->
							<div class="bwp-intro-bg-overlay"></div>
							<div class="bwp-intro-content">

								<?php if ( $header_custom_title ) { ?>

									<!-- title -->
									<div class="bwp-intro-heading">
										<h1>
											<?php
											echo wp_kses( $header_custom_title, array(
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
											) );
											?>
										</h1>
									</div>
									<!-- end: title -->

								<?php } ?>

								<?php if ( $header_custom_text ) { ?>

									<!-- text -->
									<div class="bwp-intro-text">
										<p>
											<?php
											echo wp_kses( $header_custom_text, array(
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
										</p>
									</div>
									<!-- end: text -->

								<?php } ?>

							</div>
							<!-- end: content (bg overlay, title, and text) -->

						<?php } ?>

					</div>
					<!-- end: background image (header image) -->

				</div>
			</div>
		</section>
		<!-- end: container with introductory text -->

		<?php
	}
}
