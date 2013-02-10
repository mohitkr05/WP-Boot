<?php
/**
*
* The template is used for displaying footer
* 
*		@package wpboot
*		@since wpboot 0.2
*		@author mohit
*
*
**/

?>

	</div><!-- #main .site-main -->

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
