<?php
/**
*
* The template is used for generating the single post.
* 
*		@package wpboot
*		@since wpboot 0.2
*		@author mohit
*
*
**/

get_header(); ?>

		<div id="primary" class="content-area span8">
			<?php wpboot_content_before(); ?>
			<div id="content" class="site-content" role="main">

			<?php while ( have_posts() ) : the_post(); ?>

				<?php wpboot_content_nav( 'nav-above' ); ?>

				<?php get_template_part( 'content', 'single' ); ?>

				<?php wpboot_content_nav( 'nav-below' ); ?>

				<?php
					// If comments are open or we have at least one comment, load up the comment template
					if ( comments_open() || '0' != get_comments_number() )
						comments_template( '', true );
				?>

			<?php endwhile; // end of the loop. ?>

			</div><!-- #content .site-content -->
			
			<?php wpboot_content_after(); ?>
		</div><!-- #primary .content-area -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
