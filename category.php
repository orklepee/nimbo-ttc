<?php
/**
 * The template for displaying Category pages
 *
 * @package WordPress
 * @subpackage Nimbo
 * @since Nimbo 1.0
 */

// header
get_header();

// archive heading (category and description), blog posts with pagination, and sidebar
get_template_part( 'templates/blog-posts' );

// footer
get_footer();
