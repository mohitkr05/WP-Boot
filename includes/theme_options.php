<?php 

/**
*
* All the theme options are loaded in the files from options-framework
* 
*		@package wpboot
*		@since wpboot 0.3
*		@author mohit
*
*
**/


// Get theme options - Code credit http://320press.com/wpbs
function get_wpboot_theme_options(){
      $bootwatch_theme = of_get_option('wpboot_bootswatch_theme');
      
     
        if( $bootwatch_theme == 'default' ){}
        else {
          echo '<link rel="stylesheet" href="' . get_template_directory_uri() . '/includes/admin/themes/' . $bootwatch_theme . '.css">';
        }
	}
 
 
 
/**
 * Custom Typography
 *
 * 	    @package wpboot
 *		@since wpboot 0.3
 *		@author mohit
 */
 
add_action( 'wp_head', 'wpboot_custom_typography' );

function wpboot_custom_typography() {

	if ( !of_get_option( 'wpboot_disable_typography' ) ) {
		$output = '';
		
		if ( of_get_option( 'wpboot_content_font' ) ) {
			$output .= wpboot_content_font_styles( of_get_option( 'wpboot_content_font' ) , '.entry-content, .entry-summary');
		}

		if ( of_get_option( 'wpboot_heading_font' ) ) {
			$output .= wpboot_heading_font_styles( of_get_option( 'wpboot_heading_font' ) , 'h1,h2,h3,h4,h5,h6');
		}

		if ( $output != '' ) {
			$output = "\n<style>\n" . $output . "</style>\n";
			echo $output;
		}

	}

}


/** 
 * Returns a typography option for content in a format that can be outputted as inline CSS
 *
 * @since 0.2
 */
 
function wpboot_content_font_styles( $option, $selectors ) {
	$output = $selectors . ' {';
	$output .= ' color:' . $option['color'] .'; ';
	$output .= 'font-family:' . $option['face'] . '; ';
	$output .= 'font-weight:' . $option['style'] . '; ';
	$output .= 'font-size:' . $option['size'] . ' !important; ';
	$output .= '}';
	$output .= "\n";

	return $output;
}

/** 
 * Returns a typography option for heading in a format that can be outputted as inline CSS
 *
 * @since 0.2
 */
function wpboot_heading_font_styles( $option, $selectors ) {
	$output = $selectors . ' {';
	$output .= ' color:' . $option['color'] .'; ';
	$output .= 'font-family:' . $option['face'] . '; ';
	$output .= 'font-weight:' . $option['style'] . '; ';
	$output .= '}';
	$output .= "\n";

	return $output;
}



/**
 * Favicon
 *
 * @since 0.0.1
 */
add_action( 'wp_head', 'wpboot_custom_favicon', 5 );
function wpboot_custom_favicon() {

	if ( of_get_option( 'wpboot_custom_favicon' ) )
		echo '<link rel="shortcut icon" href="'. esc_url( of_get_option( 'wpboot_custom_favicon' ) ) .'">'."\n";

}

/**
 * Iframe blocker
 *
 * @since 0.0.1
 */
add_action( 'wp_head', 'wpboot_iframe_blocker', 11 );
function wpboot_iframe_blocker() {
		
	if( of_get_option('wpboot_iframe_blocker') == 'enable' ) : ?>
		<script language="javascript" type="text/javascript"> 
			if (top.location != self.location) top.location.replace(self.location); 
		</script>
	<?php endif;

}

/**
 * Custom layout classes
 *
 * @since 0.0.1
 */
add_filter( 'body_class', 'wpboot_custom_layouts' );
function wpboot_custom_layouts($classes) {
	$layouts = of_get_option('wpboot_layouts');
	
	if ( 'rcontent' == $layouts )
		$classes[] = 'two-columns right-primary left-secondary';
	elseif ( 'lcontent' == $layouts )
		$classes[] = 'two-columns left-primary right-secondary';
	else
		$classes[] = 'one-column only-primary';
	
	return $classes;
}

/**
 * One-column css
 *
 * @since 0.1
 */
add_action( 'wp_enqueue_scripts', 'wpboot_onecol_style', 30 );
function wpboot_onecol_style() {

	$layouts = of_get_option( 'wpboot_layouts' );

	if ( 'onecolumn' == $layouts ) :
		wp_enqueue_style( 'wpboot-onecolumn', trailingslashit( wpboot_CSS ) . 'one-column.css', '', wpboot_VERSION, 'all' );
	endif;

}

/**
 * Sets the post excerpt length
 *
 * @since 0.1
 */
add_filter( 'excerpt_length', 'wpboot_excerpt' );
function wpboot_excerpt( $length ) {

	$home_layout = of_get_option( 'wpboot_home_layouts' );

	if( 'one-col' == $home_layout )
		return 50;
	else
		return 35;
}

/**
 * Header code
 *
 * @since 1.0
 */
add_action( 'wp_head', 'wpboot_header_code' );
function wpboot_header_code() {

	$hcode = of_get_option( 'wpboot_header_code' );
	if ( $hcode ) 
		echo "\n" . stripslashes( $hcode ) . "\n";

}

/**
 * Footer code
 *
 * @since 1.0
 */
add_action( 'wp_footer', 'wpboot_footer_code' );
function wpboot_footer_code() {

	$output = of_get_option( 'wpboot_footer_code' );
	if ( $output ) 
		echo "\n" . stripslashes( $output ) . "\n";

}

/**
 * for textarea sanitization and $allowedposttags + embed and script.
 *
 * @since 0.0.1
 */
add_action('admin_init', 'wpboot_change_santiziation', 100);
function wpboot_change_santiziation() {

    remove_filter( 'of_sanitize_textarea', 'of_sanitize_textarea' );
    add_filter( 'of_sanitize_textarea', 'wpboot_sanitize_textarea' );
    
}

function wpboot_sanitize_textarea($input) {

    global $allowedposttags;

    $custom_allowedtags["embed"] = array(
		"src" => array(),
		"type" => array(),
		"allowfullscreen" => array(),
		"allowscriptaccess" => array(),
		"height" => array(),
		"width" => array()
	);

	$custom_allowedtags["script"] = array(
		"src" => array(), 
		"type" => array()
	);

	$custom_allowedtags["meta"] = array(
		"name" => array(), 
		"content" => array()
	);

	$custom_allowedtags["link"] = array(
		"href" => array(), 
		"rel" => array(),
		"type" => array()
	);

	$custom_allowedtags = array_merge($custom_allowedtags, $allowedposttags);
	$output = wp_kses( $input, $custom_allowedtags);
    return $output;

}


?>
