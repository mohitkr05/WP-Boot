<?php
/**
*
* The template is used for generating title and description 
* 
*		@package wpboot
*		@since wpboot 0.2
*		@author mohit
*
*
**/

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 *
 * @since wpboot 0.2
 */
function wpboot_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport        = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';
}
add_action( 'customize_register', 'wpboot_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 *
 * @since wpboot 0.2
 */
function wpboot_customize_preview_js() {
	wp_enqueue_script( 'wpboot_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20120827', true );
}
add_action( 'customize_preview_init', 'wpboot_customize_preview_js' );
