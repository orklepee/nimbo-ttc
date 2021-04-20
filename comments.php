<?php
/**
 * The template for displaying comments
 *
 * The area of the page that contains both current comments
 * and the comment form.
 *
 * @package WordPress
 * @subpackage Nimbo
 * @since Nimbo 1.0
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}

// show or hide avatars (WordPress Settings > Discussion > Avatars > Avatar Display: Show Avatars)
$show_avatars = get_option( 'show_avatars' );
?>

<!-- comments -->
<div id="comments" class="comments-area<?php echo ( ! $show_avatars ) ? ' bwp-no-avatars' : ''; ?>">

	<?php
	// if the post has comments
	if ( have_comments() ) {
		?>

		<!-- comments title -->
		<h2 class="comments-title">
			<?php
			$comments_number = get_comments_number();
			if ( 1 === $comments_number ) {
				/* translators: %s: post title */
				printf(
					_x(
						'One thought on &ldquo;%s&rdquo;',
						'comments title',
						'nimbo'
					),
					get_the_title()
				);
			} else {
				printf(
					/* translators: 1: number of comments, 2: post title */
					_nx(
						'%1$s thought on &ldquo;%2$s&rdquo;',
						'%1$s thoughts on &ldquo;%2$s&rdquo;',
						$comments_number,
						'comments title',
						'nimbo'
					),
					number_format_i18n( $comments_number ),
					get_the_title()
				);
			}
			?>
		</h2>
		<!-- end: comments title -->

		<!-- comment list and navigation -->
		<div class="comment-list-wrap<?php echo ( ! comments_open() ) ? ' comments-closed' : ''; ?>">

			<ol class="comment-list">
				<?php
				wp_list_comments( array(
					'style'			=> 'ol',
					'short_ping'	=> true,
					'avatar_size'	=> 92,
				) );
				?>
			</ol>

			<?php
			// comments navigation
			the_comments_navigation( array(
				'prev_text'	=> '<i class="fas fa-caret-left"></i>' . esc_html__( 'Older comments', 'nimbo' ),
				'next_text'	=> esc_html__( 'Newer comments', 'nimbo' ) . '<i class="fas fa-caret-right"></i>',
			) );
			?>

		</div>
		<!-- end: comment list and navigation -->

		<?php
	}
	?>

	<?php if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) { ?>
		<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'nimbo' ); ?></p>
	<?php } ?>

	<?php
	// comment form
	comment_form( array(
		'title_reply_before'	=> '<h2 id="reply-title" class="comment-reply-title">',
		'title_reply_after'		=> '</h2>',
		'comment_notes_before'	=> '<p class="comment-notes">' . esc_html__( 'Your email address will not be published. Required fields are marked *', 'nimbo' ) . '</p>',
		'title_reply'			=> '<span>' . esc_html__( 'Leave a reply', 'nimbo' ) . '</span>',
		'title_reply_to'		=> '<span>' . esc_html__( 'Leave a reply to %s', 'nimbo' ) . '</span>',
		'cancel_reply_link'		=> esc_html__( 'Cancel reply', 'nimbo' ),
		'label_submit'			=> esc_html__( 'Post comment', 'nimbo' ),
	) );
	?>

</div>
<!-- end: comments -->
