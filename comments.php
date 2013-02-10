<?php
/**
*
* The template is used for displaying comments
* 
*		@package wpboot
*		@since wpboot 0.2
*		@author mohit
*
*
**/

?>

<?php
	/*
	 * If the current post is protected by a password and
	 * the visitor has not yet entered the password we will
	 * return early without loading the comments.
	 */
	if ( post_password_required() )
		return;
?>

	<div id="comments" class="comments-area">

	<?php // You can start editing here -- including this comment! ?>

	<?php if ( have_comments() ) : ?>
		<h2 class="comments-title">
			<?php
				printf( _nx( 'One thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', get_comments_number(), 'comments title', 'wpboot' ),
					number_format_i18n( get_comments_number() ), '<span>' . get_the_title() . '</span>' );
			?>
		</h2>

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
		<nav role="navigation" id="comment-nav-above" class="site-navigation comment-navigation">
			<h1 class="assistive-text"><?php _e( 'Comment navigation', 'wpboot' ); ?></h1>
			<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'wpboot' ) ); ?></div>
			<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'wpboot' ) ); ?></div>
		</nav><!-- #comment-nav-before .site-navigation .comment-navigation -->
		<?php endif; // check for comment navigation ?>

		<ol class="commentlist">
			<?php
				/* Loop through and list the comments. Tell wp_list_comments()
				 * to use wpboot_comment() to format the comments.
				 * If you want to overload this in a child theme then you can
				 * define wpboot_comment() and that will be used instead.
				 * See wpboot_comment() in inc/template-tags.php for more.
				 */
				wp_list_comments( array( 'callback' => 'wpboot_comment' ) );
			?>
		</ol><!-- .commentlist -->

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
		<nav role="navigation" id="comment-nav-below" class="site-navigation comment-navigation">
			<h1 class="assistive-text"><?php _e( 'Comment navigation', 'wpboot' ); ?></h1>
			<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'wpboot' ) ); ?></div>
			<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'wpboot' ) ); ?></div>
		</nav><!-- #comment-nav-below .site-navigation .comment-navigation -->
		<?php endif; // check for comment navigation ?>

	<?php endif; // have_comments() ?>

	<?php
		// If comments are closed and there are comments, let's leave a little note, shall we?
		if ( ! comments_open() && '0' != get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
	?>
		<p class="nocomments"><?php _e( 'Comments are closed.', 'wpboot' ); ?></p>
	<?php endif; ?>

	<?php comment_form(); ?>

</div><!-- #comments .comments-area -->
