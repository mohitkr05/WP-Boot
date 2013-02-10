<?php
/**
*
* The template is used for displaying the searched content 
* 
*		@package wpboot
*		@since wpboot 0.2
*		@author mohit
*
*
**/


get_header(); ?>

		<section id="primary" class="content-area span8">
			<?php wpboot_content_before(); ?>
			
			<div id="content" class="site-content" role="main">
			<?php wpboot_content(); ?>
			
			<?php if ( have_posts() ) : ?>

				<header class="page-header">
					<h1 class="page-title"><?php printf( __( 'Search Results for: %s', 'wpboot' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
				</header><!-- .page-header -->

				<?php wpboot_content_nav( 'nav-above' ); ?>

				<?php /* Start the Loop */ ?>
				<?php while ( have_posts() ) : the_post(); ?>

					<?php get_template_part( 'content', 'search' ); ?>

				<?php endwhile; ?>

				<?php wpboot_content_nav( 'nav-below' ); ?>

			<?php else : ?>

				<?php get_template_part( 'no-results', 'search' ); ?>

			<?php endif; ?>

			</div><!-- #content .site-content -->
			
			<?php wpboot_content_after(); ?>
		</section><!-- #primary .content-area -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
