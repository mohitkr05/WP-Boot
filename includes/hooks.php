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
*/

/**
 * Action hook after #page
 *
 * @file 	header.php
 * @since 	0.2
 */
function wpboot_before() {
    do_action('wpboot_before');
}

/**
 * Action hook inside #masthead
 *
 * @file 	header.php
 * @since 	0.2
 */
function wpboot_header() {
    do_action('wpboot_header');
}

/**
 * Action hook before #main
 *
 * @file 	header.php
 * @since 	0.2
 */
function wpboot_main_before() {
    do_action('wpboot_main_before');
}

/**
 * Action hook after #main
 *
 * @file 	header.php
 * @since 	0.2
 */
function wpboot_main() {
    do_action('wpboot_main');
}

/**
 * Action hook before #content
 *
 * @file 	index.php, single.php, page.php, 
 *			404.php, archive.php, author.php, image.php, search.php,
 *			template-archives.php, template-fullwidth.php
 * @since 	0.2
 */
function wpboot_content_before() {
    do_action('wpboot_content_before');
}

/**
 * Action hook after #content
 *
 * @file 	index.php, single.php, page.php, 
 *			404.php, archive.php, author.php, image.php, search.php,
 *			template-archives.php, template-fullwidth.php
 * @since 	0.2
 */
function wpboot_content() {
    do_action('wpboot_content');
}

/**
 * Action hook after end #content
 *
 * @file 	index.php, single.php, page.php, 
 *			404.php, archive.php, author.php, image.php, search.php,
 *			template-archives.php, template-fullwidth.php
 * @since 	0.2
 */
function wpboot_content_after() {
    do_action('wpboot_content_after');
}

/**
 * Action hook after #secondary
 *
 * @file 	sidebar.php
 * @since 	0.2
 */
function wpboot_sidebar_before() {
    do_action('wpboot_sidebar_before');
}

/**
 * Action hook after .site-info
 *
 * @file 	footer.php
 * @since 	0.2
 */
function wpboot_credits() {
    do_action('wpboot_credits');
}
?>
