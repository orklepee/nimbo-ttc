<?php
/**
 * The template for displaying Tag pages
 *
 * Used to display archive-type pages for posts in a tag.
 *
 * @package WordPress
 * @subpackage Nimbo
 * @since Nimbo 1.0
 */

// header
get_header();

// archive heading (tag and description), blog posts with pagination, and sidebar
get_template_part( 'templates/blog-posts' );

// footer
get_footer();
