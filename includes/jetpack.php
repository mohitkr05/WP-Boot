<?php
/**
*
* The template is used for infinite scroll
* 
*		@package wpboot
*		@since wpboot 0.2
*		@author mohit
*
*
**/

/**
 * Add theme support for Infinite Scroll.
 * See: http://jetpack.me/support/infinite-scroll/
 */
function wpboot_infinite_scroll_setup() {
	add_theme_support( 'infinite-scroll', array(
		'container' => 'content',
		'footer'    => 'page',
	) );
}
add_action( 'after_setup_theme', 'wpboot_infinite_scroll_setup' );
