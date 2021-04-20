<?php
/**
 * The template for displaying the header
 *
 * @package WordPress
 * @subpackage Nimbo
 * @since Nimbo 1.0
 */

?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<?php
// header type
$header_type = get_theme_mod( 'nimbo_header_type', 'header-one-row' ); // 'header-one-row' or 'header-two-rows'
if ( 'header-one-row' ===  $header_type ) {
	// header type 1
	get_template_part( 'templates/headers/header-one-row' );
} else {
	// header type 2
	get_template_part( 'templates/headers/header-two-rows' );
}
