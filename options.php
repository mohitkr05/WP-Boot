<?php
/**
 * A unique identifier is defined to store the options in the database and reference them from the theme.
 * By default it uses the theme name, in lowercase and without spaces, but this can be changed if needed.
 * If the identifier changes, it'll appear as if the options have been reset.
 *
 */

function optionsframework_option_name() {

	// This gets the theme name from the stylesheet (lowercase and without spaces)
	$themename = get_option( 'stylesheet' );
	$themename = preg_replace("/\W/", "_", strtolower($themename) );

	$optionsframework_settings = get_option('optionsframework');
	$optionsframework_settings['id'] = $themename;
	update_option('optionsframework', $optionsframework_settings);

	// echo $themename;
}

/**
 * Defines an array of options that will be used to generate the settings page and be saved in the database.
 * When creating the 'id' fields, make sure to use all lowercase and no spaces.
 *
 */

function optionsframework_options() {

	
	
	$wpboot_background = array(
		'color' => '',
		'image' => '',
		'repeat' => 'repeat',
		'position' => 'top center',
		'attachment'=>'scroll' 
	);
	
	$wpboot_numbers = array(
		'2' => __( 'Two', 'wpboot' ), 
		'3' => __( 'Three', 'wpboot' ), 
		'4' => __( 'Four', 'wpboot' ), 
		'5' => __( 'Five', 'wpboot' ), 
		'6' => __( 'Six', 'wpboot' ), 
		'7' => __( 'Seven', 'wpboot' ), 
		'8' => __( 'Eight', 'wpboot' ), 
		'9' => __( 'Nine', 'wpboot' ), 
		'10' => __( 'Ten', 'wpboot' ) 
	);
	
	$wpboot_select = array(
		'enable' => __( 'Enable', 'wpboot' ), 
		'disable' => __( 'Disable', 'wpboot' ) 
	);


	// Background Defaults
	$background_defaults = array(
		'color' => '',
		'image' => '',
		'repeat' => 'repeat',
		'position' => 'top center',
		'attachment'=>'scroll' );

	// Typography Defaults
	$typography_defaults = array(
		'size' => '15px',
		'face' => 'georgia',
		'style' => 'bold',
		'color' => '#bada55' );
		
	// Typography Options
	$typography_options = array(
		'sizes' => array( '6','12','14','16','20' ),
		'faces' => array( 'Helvetica Neue' => 'Helvetica Neue','Arial' => 'Arial' ),
		'styles' => array( 'normal' => 'Normal','bold' => 'Bold' ),
		'color' => false
	);

	// Pull all the categories into an array
	$options_categories = array();
	$options_categories_obj = get_categories();
	foreach ($options_categories_obj as $category) {
		$options_categories[$category->cat_ID] = $category->cat_name;
	}
	
	// Pull all tags into an array
	$options_tags = array();
	$options_tags_obj = get_tags();
	foreach ( $options_tags_obj as $tag ) {
		$options_tags[$tag->term_id] = $tag->name;
	}

	// Pull all the pages into an array
	$options_pages = array();
	$options_pages_obj = get_pages('sort_column=post_parent,menu_order');
	$options_pages[''] = 'Select a page:';
	foreach ($options_pages_obj as $page) {
		$options_pages[$page->ID] = $page->post_title;
	}

	// If using image radio buttons, define a directory path
	$imagepath =  get_template_directory_uri() . '/img/';
	
	// Path for custom Bootswatch themes
	
	$themesPath = dirname(__FILE__) . '/includes/admin/themes';
	
	// Insert default option
	$theList['default'] = OPTIONS_FRAMEWORK_DIRECTORY . '/themes/default-thumbnail-100x60.png';

	$options = array();
	
	if ($handle = opendir( $themesPath )) {
	    while (false !== ($file = readdir($handle)))
	    {
	        if ($file != "." && $file != ".." && strtolower(substr($file, strrpos($file, '.') + 1)) == 'css')
	        {
	        	$name = substr($file, 0, strlen($file) - 4);
				$thumb = OPTIONS_FRAMEWORK_DIRECTORY . '/themes/' . $name . '-thumbnail-100x60.png';
				$theList[$name] = $thumb;
	        }
	    }
	    closedir($handle);
	}
	//Lets define the custom CSS urls and load it in our theme. Most of the themes are downloaded from Bootswatch.com
	// Code credit - http://320press.com/wpbs
	
	$imagepath =  get_template_directory_uri() . '/img/layouts/';
	$patternpath =  get_template_directory_uri() . '/img/bg/';
		
	$options = array();
	
	$options[] = array( 
		'name' => __( 'General', 'wpboot' ),
		'type' => 'heading'
	);
							
	$options[] = array( 
		'name' => __( 'Custom Logo', 'wpboot' ),
		'desc' => __( 'Upload a logo for your website, or specify the image address of your online logo. (http://example.com/logo.png)', 'wpboot' ),
		'id' => 'wpboot_custom_logo',
		'type' => 'upload'
	);
								
	$options[] = array( 
		'name' => __( 'Custom Favicon', 'wpboot' ),
		'desc' => __( 'Upload a favicon for your website, or specify the image address of your online favicon. (http://example.com/favicon.png)', 'wpboot' ),
		'id' => 'wpboot_custom_favicon',
		'type' => 'upload'
	);
							
	$options[] = array( 
		'name' => __( 'Custom CSS', 'wpboot' ),
		'desc' => __( 'Quickly add some CSS to your theme by adding it to this block.', 'wpboot' ),
		'id' => 'wpboot_custom_css',
		'std' => '',
		'type' => 'textarea'
	); 
						
	$options[] = array( 
		'name' => __( 'Header Code', 'wpboot' ),
		'desc' => __( 'Add any custom script like the meta verification from various search engine. It will be inserted before the closing head tag of your theme', 'wpboot' ),
		'id' => 'wpboot_header_code',
		'type' => 'textarea'
	); 	
						
	$options[] = array( 
		'name' => __( 'Footer Code', 'wpboot' ),
		'desc' => __( 'Add your analytic code or you can add any custom script here. It will be inserted before the closing body tag of your theme', 'wpboot' ),
		'id' => 'wpboot_footer_code',
		'type' => 'textarea'
	); 		 	 
						
	$options[] = array( 
		'name' => __( 'Iframe Blocker', 'wpboot' ),
		'desc' => __( 'Iframe blocker is for block iframe to your site such as google image.', 'wpboot' ),
		'id' => 'wpboot_iframe_blocker',
		'std' => 'disable',
		'type' => 'select',
		'options' => $wpboot_select
	);

	$options[] = array( 
		'name' => __(  'Disable credit links', 'wpboot' ),
		'desc' => __(  'Are you sure want to disable the credit link for WordPress and theme author?', 'wpboot' ),
		'id' => 'wpboot_credits',
		'type' => 'checkbox'
	);
						
	/* ============================== End General Settings ================================= */					
	
	$options[] = array( 
		'name' => __( 'Typography', 'wpboot' ),
		'type' => 'heading'
	);

	$options[] = array( 
		'name' => __( 'Disable custom typography', 'wpboot' ),
		'desc' => __( 'Disable custom typography and use theme defaults.', 'wpboot' ),
		'id' => 'wpboot_disable_typography',
		'std' => true,
		'type' => 'checkbox' 
	);

	$options[] = array( 
		'name' => __( 'Content typography', 'wpboot' ),
		'desc' => __( 'This font is used for content text.', 'wpboot' ),
		'id' => 'wpboot_content_font',
		'class' => 'hidden',
		'std' => array('size' => '13px','face' => '"Open Sans", sans-serif', 'color' => '#333333' ),
		'type' => 'typography',
		'options' => array(
			'sizes' => array( '12','13','14', '15', '16', '17', '18', '19', '20', '21', '22', '23', '24' ),
			'faces' => array(
				'"Open Sans", sans-serif' => 'Open Sans',
				'Arial, "Helvetica Neue", Helvetica, sans-serif' => 'Arial',
				'Georgia, Palatino, "Palatino Linotype", Times, "Times New Roman", serif' => 'Georgia',
				'Tahoma, Geneva, Verdana, sans-serif' => 'Tahoma',
				'"Helvetica Neue", Arial, Helvetica, sans-serif' => 'Helvetica',
				'Verdana, Geneva, sans-serif' => 'Verdana',
				'Times, "Times New Roman", Georgia, serif' => 'Times New Roman',
				'"Trebuchet MS", "Lucida Sans Unicode", "Lucida Grande", "Lucida Sans", Arial, sans-serif' => 'Trebuchet MS',
				'Cambria, Georgia, serif' => 'Cambria',
				'Calibri, Candara, Segoe, "Segoe UI", Optima, Arial, sans-serif' => 'Calibri'
			),
			'styles' => array( 'normal' => 'Normal', 'bold' => 'Bold' )
		)
	);

	$options[] = array( 
		'name' => __( 'Content heading typography', 'wpboot' ),
		'desc' => __( 'Select the headline font (h1,h2,h3 etc)', 'wpboot' ),
		'id' => 'wpboot_heading_font',
		'class' => 'hidden',
		'std' => array('size' => '13px','face' => '"Francois One", sans-serif', 'color' => '#333333' ),
		'type' => 'typography',
		'options' => array(
			'sizes' => false,
			'faces' => array(
				'"Francois One", sans-serif' => 'Francois Regular',
				'Arial, "Helvetica Neue", Helvetica, sans-serif' => 'Arial',
				'Georgia, Palatino, "Palatino Linotype", Times, "Times New Roman", serif' => 'Georgia',
				'Tahoma, Geneva, Verdana, sans-serif' => 'Tahoma',
				'"Helvetica Neue", Arial, Helvetica, sans-serif' => 'Helvetica',
				'Verdana, Geneva, sans-serif' => 'Verdana',
				'Times, "Times New Roman", Georgia, serif' => 'Times New Roman',
				'"Trebuchet MS", "Lucida Sans Unicode", "Lucida Grande", "Lucida Sans", Arial, sans-serif' => 'Trebuchet MS',
				'Cambria, Georgia, serif' => 'Cambria',
				'Calibri, Candara, Segoe, "Segoe UI", Optima, Arial, sans-serif' => 'Calibri'
			),
			'styles' => array( 'normal' => 'Normal',  'bold' => 'Bold' )
		)
	);

	/* ============================== End Typography Settings ================================= */


	
	$options[] = array( "name" => "Theme",
						"type" => "heading");
						
	$options[] = array( "name" => "Select a theme",
						"id" => "wpboot_bootswatch_theme",
						"std" => "default",
						"type" => "images",
						"options" => $theList
						);
						
	
	return $options;
}


/** 
 * Custom script for theme options
 *
 * @since 0.0.1
 */

add_action('optionsframework_custom_scripts', 'wpboot_custom_scripts' );
function wpboot_custom_scripts() { ?>
	<script type='text/javascript'>
	jQuery(document).ready(function($) {

		$('#wpboot_disable_typography' ).click(function() {
			$('#section-wpboot_content_font, #section-wpboot_heading_font' ).fadeToggle(400);
		});
		
	});
	</script>
<?php
}
?>
