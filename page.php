<?php
/**
*
* The template is used for displaying the page.
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
				<?php wpboot_content(); ?>
				<?php while ( have_posts() ) : the_post(); ?>

					<?php get_template_part( 'content', 'page' ); ?>

					<?php comments_template( '', true ); ?>

				<?php endwhile; // end of the loop. ?>

			</div><!-- #content .site-content -->
			<?php wpboot_content_after(); ?>
		</div><!-- #primary .content-area -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
