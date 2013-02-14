<?php
/**
*
* The template is used for displaying the author page
*		@package wpboot
*		@since wpboot 0.2
*		@author mohit
*
*
**/

get_header(); ?>

<section id="primary" class="content-area span8">
			<div id="content" class="site-content" role="main">

			<?php if ( have_posts() ) : ?>

				<header class="page-header">
					<h1 class="page-title">
						<?php
								the_post();
								printf( __( '%s', 'wpboot' ), '<span class="vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( "ID" ) ) ) . '" title="' . esc_attr( get_the_author("display_name") ) . '" rel="me">' . get_the_author() . '</a></span>' );
								?></h1>
								<hr>
								<div class="row-fluid authorbox">
									<div class="span6">
										<h4>About the Author</h4>
										<p><?php the_author_meta( 'description' ); ?></p>
										<p>The author has submitted a total of <?php the_author_posts(); ?> article</p>
									</div>
									<div class="span6">
										<div id="author-avatar"><br> 
											<?php echo get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'twentyeleven_author_bio_avatar_size', 100 ) ); ?><br> 
									</div><!-- #author-avatar --><br> 
									<h4>Contact Me</h4>
										<ul>
											<li><p>Facebook:<?php the_author_meta( 'contact_facebook' ); ?></p></li>
											<li><p>Twitter:<?php the_author_meta( 'contact_twitter' ); ?></p></li>
											<li><p>Skype:<?php the_author_meta( 'contact_skype' ); ?></p></li>
										</ul>	
									</div>	
									
								</div>	
												
								<?php 
								/* Since we called the_post() above, we need to
								 * rewind the loop back to the beginning that way
								 * we can run the loop properly, in full.
								 */
								rewind_posts();

						?>
					
					
				</header><!-- .page-header -->

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

				<?php get_template_part( 'no-results', 'archive' ); ?>

			<?php endif; ?>

			</div><!-- #content .site-content -->
		</section><!-- #primary .content-area -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
