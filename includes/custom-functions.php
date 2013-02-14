<?php 
/**
*
* Custom function
* 
*		@package wpboot
*		@since wpboot 0.4
*		@author mohit
*
*
**/
/** These custom functions are included for reference.Can be called with an option specified The option to load these functions by choice will be defined in future versions.**/

/**
 * Function to load jquery from Google
 *
 * @since wpboot 0.4
 */


	add_action( 'init', 'wpboot_jquery_register' );

// register from google and for footer
function wpboot_jquery_register() {

		if ( !is_admin() ) {

			wp_deregister_script( 'jquery' );
			wp_register_script( 'jquery', ( '//ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js' ), false, null, true );
			wp_enqueue_script( 'jquery' );
		}
	}


/**
 * Function to remove WordPress version information
 *
 * @since wpboot 0.4
 */
 
 
function wpboot_complete_version_removal() {
		return '';
	}

	add_filter('the_generator', 'wpboot_complete_version_removal');

/**
 * Function to remove default post screen metaboxes
 *
 * @since wpboot 0.4
 */
 
 



   function wpboot_remove_default_post_screen_metaboxes() {
	   
		remove_meta_box( 'postcustom','post','normal' ); // Custom Fields Metabox
		remove_meta_box( 'postexcerpt','post','normal' ); // Excerpt Metabox
		remove_meta_box( 'commentstatusdiv','post','normal' ); // Comments Metabox
		remove_meta_box( 'trackbacksdiv','post','normal' ); // Talkback Metabox
		remove_meta_box( 'slugdiv','post','normal' ); // Slug Metabox
		remove_meta_box( 'authordiv','post','normal' ); // Author Metabox
 }

	add_action('admin_menu','wpboot_remove_default_post_screen_metaboxes');

/**
 * Function to remove default pages screen metaboxes
 *
 * @since wpboot 0.4
 */
 
 
 
   function wpboot_remove_default_page_screen_metaboxes() {
	   
	remove_meta_box( 'postcustom','page','normal' ); // Custom Fields Metabox
	remove_meta_box( 'postexcerpt','page','normal' ); // Excerpt Metabox
	remove_meta_box( 'commentstatusdiv','page','normal' ); // Comments Metabox
	remove_meta_box( 'trackbacksdiv','page','normal' ); // Talkback Metabox
	remove_meta_box( 'slugdiv','page','normal' ); // Slug Metabox
	remove_meta_box( 'authordiv','page','normal' ); // Author Metabox
 }
   add_action('admin_menu','wpboot_remove_default_page_screen_metaboxes');
   
 
 /**
 * Function to remove default dashboard widgets
 *
 * @since wpboot 0.4
 */
 
add_action('wp_dashboard_setup', 'wpboot_dashboard_widgets');

function wpboot_dashboard_widgets() {
	global $wp_meta_boxes;
	//Right Now - Comments, Posts, Pages at a glance
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_right_now']);
	//Recent Comments
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_comments']);
	//Incoming Links
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_incoming_links']);
	//Plugins - Popular, New and Recently updated Wordpress Plugins
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins']);

	//Wordpress Development Blog Feed
	unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_primary']);
	//Other Wordpress News Feed
	unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary']);
	//Quick Press Form
	unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_quick_press']);
	//Recent Drafts List
	unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_recent_drafts']);
}


 /**
 * Function to remove default author metabox 
 *
 * @since wpboot 0.4
 */


add_action( 'admin_menu', 'remove_author_metabox' );
add_action( 'post_submitbox_misc_actions', 'move_author_to_publish_metabox' );


function remove_author_metabox() {
    remove_meta_box( 'authordiv', 'post', 'normal' );
}


 /**
 * Function to move default author metabox inside the publish option 
 *
 * @since wpboot 0.4
 */
function move_author_to_publish_metabox() {
    global $post_ID;
    $post = get_post( $post_ID );
    echo '<div id="author" class="misc-pub-section" style="border-top-style:solid; border-top-width:1px; border-top-color:#EEEEEE; border-bottom-width:0px;">Author: ';
    post_author_meta_box( $post );
    echo '</div>';
}

 /**
 * Show only images and media related to the user.
 *
 * @since wpboot 0.4
 */

add_action('pre_get_posts', 'query_set_only_author' );
function query_set_only_author( $wp_query ) {
    global $current_user;
    if( is_admin() && !current_user_can('edit_others_posts') ) {
        $wp_query->set( 'author', $current_user->ID );
        add_filter('views_edit-post', 'fix_post_counts');
        add_filter('views_upload', 'fix_media_counts');
    }
}

// Fix post counts
function fix_post_counts($views) {
    global $current_user, $wp_query;
    unset($views['mine']);
    $types = array(
        array( 'status' =>  NULL ),
        array( 'status' => 'publish' ),
        array( 'status' => 'draft' ),
        array( 'status' => 'pending' ),
        array( 'status' => 'trash' )
    );
    foreach( $types as $type ) {
        $query = array(
            'author'      => $current_user->ID,
            'post_type'   => 'post',
            'post_status' => $type['status']
        );
        $result = new WP_Query($query);
        if( $type['status'] == NULL ):
            $class = ($wp_query->query_vars['post_status'] == NULL) ? ' class="current"' : '';
            $views['all'] = sprintf(__('<a href="%s"'. $class .'>All <span class="count">(%d)</span></a>', 'all'),
                admin_url('edit.php?post_type=post'),
                $result->found_posts);
        elseif( $type['status'] == 'publish' ):
            $class = ($wp_query->query_vars['post_status'] == 'publish') ? ' class="current"' : '';
            $views['publish'] = sprintf(__('<a href="%s"'. $class .'>Published <span class="count">(%d)</span></a>', 'publish'),
                admin_url('edit.php?post_status=publish&post_type=post'),
                $result->found_posts);
        elseif( $type['status'] == 'draft' ):
            $class = ($wp_query->query_vars['post_status'] == 'draft') ? ' class="current"' : '';
            $views['draft'] = sprintf(__('<a href="%s"'. $class .'>Draft'. ((sizeof($result->posts) > 1) ? "s" : "") .' <span class="count">(%d)</span></a>', 'draft'),
                admin_url('edit.php?post_status=draft&post_type=post'),
                $result->found_posts);
        elseif( $type['status'] == 'pending' ):
            $class = ($wp_query->query_vars['post_status'] == 'pending') ? ' class="current"' : '';
            $views['pending'] = sprintf(__('<a href="%s"'. $class .'>Pending <span class="count">(%d)</span></a>', 'pending'),
                admin_url('edit.php?post_status=pending&post_type=post'),
                $result->found_posts);
        elseif( $type['status'] == 'trash' ):
            $class = ($wp_query->query_vars['post_status'] == 'trash') ? ' class="current"' : '';
            $views['trash'] = sprintf(__('<a href="%s"'. $class .'>Trash <span class="count">(%d)</span></a>', 'trash'),
                admin_url('edit.php?post_status=trash&post_type=post'),
                $result->found_posts);
        endif;
    }
    return $views;
}

// Fix media counts
function fix_media_counts($views) {
    global $wpdb, $current_user, $post_mime_types, $avail_post_mime_types;
    $views = array();
    $_num_posts = array();
    $count = $wpdb->get_results( "
        SELECT post_mime_type, COUNT( * ) AS num_posts 
        FROM $wpdb->posts 
        WHERE post_type = 'attachment' 
        AND post_author = $current_user->ID 
        AND post_status != 'trash' 
        GROUP BY post_mime_type
    ", ARRAY_A );
    foreach( $count as $row )
        $_num_posts[$row['post_mime_type']] = $row['num_posts'];
    $_total_posts = array_sum($_num_posts);
    $detached = isset( $_REQUEST['detached'] ) || isset( $_REQUEST['find_detached'] );
    if ( !isset( $total_orphans ) )
        $total_orphans = $wpdb->get_var("
            SELECT COUNT( * ) 
            FROM $wpdb->posts 
            WHERE post_type = 'attachment' 
            AND post_author = $current_user->ID 
            AND post_status != 'trash' 
            AND post_parent < 1
        ");
    $matches = wp_match_mime_types(array_keys($post_mime_types), array_keys($_num_posts));
    foreach ( $matches as $type => $reals )
        foreach ( $reals as $real )
            $num_posts[$type] = ( isset( $num_posts[$type] ) ) ? $num_posts[$type] + $_num_posts[$real] : $_num_posts[$real];
    $class = ( empty($_GET['post_mime_type']) && !$detached && !isset($_GET['status']) ) ? ' class="current"' : '';
    $views['all'] = "<a href='upload.php'$class>" . sprintf( __('All <span class="count">(%s)</span>', 'uploaded files' ), number_format_i18n( $_total_posts )) . '</a>';
    foreach ( $post_mime_types as $mime_type => $label ) {
        $class = '';
        if ( !wp_match_mime_types($mime_type, $avail_post_mime_types) )
            continue;
        if ( !empty($_GET['post_mime_type']) && wp_match_mime_types($mime_type, $_GET['post_mime_type']) )
            $class = ' class="current"';
        if ( !empty( $num_posts[$mime_type] ) )
            $views[$mime_type] = "<a href='upload.php?post_mime_type=$mime_type'$class>" . sprintf( translate_nooped_plural( $label[2], $num_posts[$mime_type] ), $num_posts[$mime_type] ) . '</a>';
    }
    $views['detached'] = '<a href="upload.php?detached=1"' . ( $detached ? ' class="current"' : '' ) . '>' . sprintf( __( 'Unattached <span class="count">(%s)</span>', 'detached files' ), $total_orphans ) . '</a>';
    return $views;
}


 /**
 * Function to change the login logo at the wp_admin
 *
 * @since wpboot 0.4
 */
function wpboot_custom_login() {
  echo '<link rel="stylesheet" type="text/css" href="' . get_bloginfo('template_directory') . '/css/login.css">';
}
add_action('login_head', 'wpboot_custom_login');

 /**
 * Function to change the footer information
 *
 * @since wpboot 0.4
 */


function wpboot_admin_footer() {
echo 'Thanks for working for students in case of any issues please contact info@forstudents.co.in';
}
add_filter('admin_footer_text', 'wpboot_admin_footer');


 /**
 * Function to automatically add Open Graph meta
 * http://www.catswhocode.com/blog/wordpress-snippets-to-work-with-social-networks
 *
 * @since wpboot 0.4
 */

function wpboots_opengraph_for_posts() {
    if ( is_singular() ) {
        global $post;
        setup_postdata( $post );
        $output = '<meta property="og:type" content="article" />' . "\n";
        $output .= '<meta property="og:title" content="' . esc_attr( get_the_title() ) . '" />' . "\n";
        $output .= '<meta property="og:url" content="' . get_permalink() . '" />' . "\n";
        $output .= '<meta property="og:description" content="' . esc_attr( get_the_excerpt() ) . '" />' . "\n";
        if ( has_post_thumbnail() ) {
            $imgsrc = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'medium' );
            $output .= '<meta property="og:image" content="' . $imgsrc[0] . '" />' . "\n";
        }
        echo $output;
    }
}
add_action( 'wp_head', 'wpboots_opengraph_for_posts' );


 /**
 * Function to automatically remove WordPress logo and other menus
 * http://www.catswhocode.com/blog/wordpress-snippets-to-work-with-social-networks
 *
 * @since wpboot 0.4
 */
 
function wpboot_admin_bar() {
    global $wp_admin_bar;
    $wp_admin_bar->remove_menu('wp-logo');
    $wp_admin_bar->remove_menu('about');
    $wp_admin_bar->remove_menu('wporg');
    $wp_admin_bar->remove_menu('documentation');
    $wp_admin_bar->remove_menu('support-forums');
    $wp_admin_bar->remove_menu('feedback');
    $wp_admin_bar->remove_menu('view-site');
}
add_action( 'wp_before_admin_bar_render', 'wpboot_admin_bar' );



 /**
 * Function for numeric pagination
 * Credit : Bones Theme
 *
 * @since wpboot 0.4
 */
function wpboot_page_navi($before = '', $after = '') {
	global $wpdb, $wp_query;
	$request = $wp_query->request;
	$posts_per_page = intval(get_query_var('posts_per_page'));
	$paged = intval(get_query_var('paged'));
	$numposts = $wp_query->found_posts;
	$max_page = $wp_query->max_num_pages;
	if ( $numposts <= $posts_per_page ) { return; }
	if(empty($paged) || $paged == 0) {
		$paged = 1;
	}
	$pages_to_show = 7;
	$pages_to_show_minus_1 = $pages_to_show-1;
	$half_page_start = floor($pages_to_show_minus_1/2);
	$half_page_end = ceil($pages_to_show_minus_1/2);
	$start_page = $paged - $half_page_start;
	if($start_page <= 0) {
		$start_page = 1;
	}
	$end_page = $paged + $half_page_end;
	if(($end_page - $start_page) != $pages_to_show_minus_1) {
		$end_page = $start_page + $pages_to_show_minus_1;
	}
	if($end_page > $max_page) {
		$start_page = $max_page - $pages_to_show_minus_1;
		$end_page = $max_page;
	}
	if($start_page <= 0) {
		$start_page = 1;
	}
		
	echo $before.'<div class="pagination"><ul class="clearfix">'."";
	if ($paged > 1) {
		$first_page_text = "«";
		echo '<li class="prev"><a href="'.get_pagenum_link().'" title="First">'.$first_page_text.'</a></li>';
	}
		
	$prevposts = get_previous_posts_link('← Previous');
	if($prevposts) { echo '<li>' . $prevposts  . '</li>'; }
	else { echo '<li class="disabled"><a href="#">← Previous</a></li>'; }
	
	for($i = $start_page; $i  <= $end_page; $i++) {
		if($i == $paged) {
			echo '<li class="active"><a href="#">'.$i.'</a></li>';
		} else {
			echo '<li><a href="'.get_pagenum_link($i).'">'.$i.'</a></li>';
		}
	}
	echo '<li class="">';
	next_posts_link('Next →');
	echo '</li>';
	if ($end_page < $max_page) {
		$last_page_text = "»";
		echo '<li class="next"><a href="'.get_pagenum_link($max_page).'" title="Last">'.$last_page_text.'</a></li>';
	}
	echo '</ul></div>'.$after."";
}




 /**
 *  Related Posts Function (call using wpboot_related_posts(); )
 * Credit : Bones Theme
 *
 * @since wpboot 0.4
 */
 
function wpboot_related_posts() {
	echo '<ul id="bones-related-posts">';
	global $post;
	$tags = wp_get_post_tags($post->ID);
	if($tags) {
		foreach($tags as $tag) { $tag_arr .= $tag->slug . ','; }
        $args = array(
        	'tag' => $tag_arr,
        	'numberposts' => 5, /* you can change this to show more */
        	'post__not_in' => array($post->ID)
     	);
        $related_posts = get_posts($args);
        if($related_posts) {
        	foreach ($related_posts as $post) : setup_postdata($post); ?>
	           	<li class="related_post"><a class="entry-unrelated" href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></li>
	        <?php endforeach; }
	    else { ?>
            <?php echo '<li class="no_related_post">' . __( 'No Related Posts Yet!', 'bonestheme' ) . '</li>'; ?>
		<?php }
	}
	wp_reset_query();
	echo '</ul>';
} 

 /**
 *  // remove the p from around imgs (http://css-tricks.com/snippets/wordpress/remove-paragraph-tags-from-around-images/)
 * Credit : Bones Theme
 *
 * @since wpboot 0.4
 */




function wpboot_filter_ptags_on_images($content){
   return preg_replace('/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(<\/a>)?\s*<\/p>/iU', '\1\2\3', $content);
}

 /**
 *  // This removes the annoying […] to a Read More link
 * Credit : Bones Theme
 *
 * @since wpboot 0.4
 */



function wpboot_excerpt_more($more) {
	global $post;
	// edit here if you like
	return '...  <a href="'. get_permalink($post->ID) . '" title="Read '.get_the_title($post->ID).'">Read more &raquo;</a>';
}

/*	Credit : Bones Theme
 * This is a modified the_author_posts_link() which just returns the link.
 *	@since wpboot 0.4
 * This is necessary to allow usage of the usual l10n process with printf().
 */
function wpboot_get_the_author_posts_link() {
	global $authordata;
	if ( !is_object( $authordata ) )
		return false;
	$link = sprintf(
		'<a href="%1$s" title="%2$s" rel="author">%3$s</a>',
		get_author_posts_url( $authordata->ID, $authordata->user_nicename ),
		esc_attr( sprintf( __( 'Posts by %s' ), get_the_author() ) ), // No further l10n needed, core will take care of this one
		get_the_author()
	);
	return $link;
}
