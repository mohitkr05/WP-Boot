<?php
/**
*
* The template is used for displaying the page 
* 
*		@package wpboot
*		@since wpboot 0.2
*		@author mohit
*
*
**/

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<h1 class="entry-title"><?php the_title(); ?></h1>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php the_content(); ?>
		<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'wpboot' ), 'after' => '</div>' ) ); ?>
		<?php edit_post_link( __( 'Edit', 'wpboot' ), '<span class="edit-link">', '</span>' ); ?>
	</div><!-- .entry-content -->
</article><!-- #post-<?php the_ID(); ?> -->
