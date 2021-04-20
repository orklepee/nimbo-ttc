<?php
/**
 * The template for displaying Author archive pages
 *
 * @package WordPress
 * @subpackage Nimbo
 * @since Nimbo 1.0
 */

// header
get_header();

// heading with author information, blog posts with pagination, and sidebar
get_template_part( 'templates/blog-posts' );

// footer
get_footer();
