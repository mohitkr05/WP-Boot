<?php
/**
*
* The template is used for <description>
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
			<?php if ( have_posts() ) : ?>
				
				<?php wpboot_content_nav( 'nav-above' ); ?>

				<?php /* Start the Loop */ ?>
				<?php while ( have_posts() ) : the_post(); ?>

					<?php
						/* Include the Post-Format-specific template for the content.
						 * If you want to overload this in a child theme then include a file
						 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
						 */
						get_template_part( 'content', get_post_format() );
					?>

				<?php endwhile; ?>

				<?php wpboot_content_nav( 'nav-below' ); ?>

			<?php else : ?>

				<?php get_template_part( 'no-results', 'index' ); ?>

			<?php endif; ?>

			</div><!-- #content .site-content -->
			<?php wpboot_content_after(); ?>
		</div><!-- #primary .content-area -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
