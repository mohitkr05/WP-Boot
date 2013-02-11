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
 

?>
