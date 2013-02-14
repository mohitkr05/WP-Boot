<?php
/**
*
* The template is used for displaying footer
* 
*		@package wpboot
*		@since wpboot 0.3
*		@author mohit
*
*
**/

?>

</div><!-- #main .site-main -->

<!--Footer Widgets (4) --->
<div id="footer-widgets" class="row-fluid">
	<div class="span3">
		<?php dynamic_sidebar( 'footer-1' ); ?>
		</div>
	<div class="span3">
				<?php dynamic_sidebar( 'footer-2' ); ?>
	</div>
	<div class="span3">
				<?php dynamic_sidebar( 'footer-3' ); ?>
	</div>
	<div class="span3">
				<?php dynamic_sidebar( 'footer-4' ); ?>
	</div>
</div>




<!--footer divisions end ---->

	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="site-info">
			<?php wpboot_credits(); ?>
			<a href="http://wordpress.org/" title="<?php esc_attr_e( 'A Semantic Personal Publishing Platform', 'wpboot' ); ?>" rel="generator"><?php printf( __( 'Proudly powered by %s', 'wpboot' ), 'WordPress' ); ?></a>
			<span class="sep"> | </span>
			<?php printf( __( 'Theme: %1$s by %2$s.', 'wpboot' ), 'wpboot', '<a href="http://underscores.me/" rel="designer">Underscores.me</a>' ); ?>
		</div><!-- .site-info -->
	</footer><!-- #colophon .site-footer -->
</div><!-- #page .hfeed .site -->

<?php wp_footer(); ?>

</body>
</html>
