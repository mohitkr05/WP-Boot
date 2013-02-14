<?php
/**
*
* Custom user profile fields  - Modify as per requirements
* 
*		@package wpboot
*		@since wpboot 0.4
*		@author mohit
*
*
**/

// CUSTOM USER PROFILE FIELDS
   function wpboot_custom_userfields( $contactmethods ) {

    // ADD CONTACT CUSTOM FIELDS
    $contactmethods['contact_phone']    	 	= 'Phone Number';
    $contactmethods['contact_facebook']     	= 'Facebook ID';
    $contactmethods['contact_twitter'] 		    = 'Twitter ID';
    $contactmethods['contact_skype'] 		    = 'Skype ID';
	
	// Remove annoying and unwanted default fields  
	unset($contactmethods['aim']);  
	unset($contactmethods['jabber']);  
	unset($contactmethods['yim']);  

    // ADD ADDRESS CUSTOM FIELDS
    $contactmethods['address_line_1']       = 'Address Line 1';
    $contactmethods['address_line_2']       = 'Address Line 2 (optional)';
    $contactmethods['address_city']         = 'City';
    $contactmethods['address_state']        = 'State';
    $contactmethods['address_pincode']      = 'Pincode';
    return $contactmethods;
   }
   add_filter('user_contactmethods','wpboot_custom_userfields',10,1);


function contributors() {
	global $wpdb;

	$authors = $wpdb->get_results("SELECT ID, user_nicename from $wpdb->users WHERE display_name <> 'admin' ORDER BY display_name");

	foreach ($authors as $author ) {

	echo "<li>";
	echo "<a href=\"".get_bloginfo('url')."/author/";
	the_author_meta('user_nicename', $author->ID);
	echo "/\">";
	echo get_avatar($author->ID);
	echo "</a>";
	echo '<div>';
	echo "<a href=\"".get_bloginfo('url')."/author/";
	the_author_meta('user_nicename', $author->ID);
	echo "/\">";
	the_author_meta('display_name', $author->ID);
	echo "</a>";
	echo "<br />";
	echo "Website: <a href=\"";
	the_author_meta('user_url', $author->ID);
	echo "/\" target='_blank'>";
	the_author_meta('user_url', $author->ID);
	echo "</a>";
	echo "<br />";
	echo "Twitter: <a href=\"http://twitter.com/";
	the_author_meta('twitter', $author->ID);
	echo "\" target='_blank'>";
	the_author_meta('twitter', $author->ID);
	echo "</a>";
	echo "<br />";
	echo "<a href=\"".get_bloginfo('url')."/author/";
	the_author_meta('user_nicename', $author->ID);
	echo "/\">Visit&nbsp;";
	the_author_meta('display_name', $author->ID);
	echo "'s Profile Page";
	echo "</a>";
	echo "</div>";
	echo "</li>";
	}
}
?>
