<?php
/**
 * The main template file
 *
 * @package WordPress
 * @subpackage Nimbo
 * @since Nimbo 1.0
 */

// header
get_header();

// container with introductory text and background image
get_template_part( 'templates/homepage-intro-container' );

// blog posts with pagination and sidebar
get_template_part( 'templates/blog-posts' );

// footer
get_footer();
