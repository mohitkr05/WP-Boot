<?php
/**
*
* The template is used for displaying the page.
* 
*		@package wpboot
*		@since wpboot 0.2
*		@author mohit
*
*	Template Name: Contributors
**/

get_header(); ?>
	<div id="primary" class="content-area span8">
		
		<?php wpboot_content_before(); ?>
			<div id="content" class="site-content" role="main">
				<div id="authorlist">
					<ul>
					<?php contributors(); ?>
					</ul>
				</div>
			</div><!-- #content .site-content -->
			<?php wpboot_content_after(); ?>
	</div><!-- #primary .content-area -->	
<?php get_sidebar(); ?>
<?php get_footer(); ?>
