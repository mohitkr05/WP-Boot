<?php
/**
*
* The template is used for displaying the header 
* 
*		@package wpboot
*		@since wpboot 0.2
*		@author mohit
*
*
**/

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> prefix="og: http://ogp.me/ns#">>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width" />
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<!--[if lt IE 9]>
<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
<![endif]-->
<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/bootstrap-responsive.css">
<?php get_wpboot_theme_options(); ?>
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<!------------------------------------Header starts ------------------------------->

<header role="banner" class="span12">
	<div id="inner-header" class="clearfix">
		<div class="navbar navbar-fixed-top navbar-inverse">
			<div class="navbar-inner">
				<div class="container-fluid nav-container">
					<nav role="navigation">
						<a class="brand" id="logo" title="<?php echo get_bloginfo('description'); ?>" href="<?php echo home_url(); ?>"><?php bloginfo('name'); ?></a>
						<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</a>
						<div class="nav-collapse">
							<?php wpboot_main_nav(); // Adjust using Menus in Wordpress Admin ?>
						</div>
					</nav>
					<form class="navbar-search pull-right" role="search" method="get" id="searchform" action="<?php echo home_url( '/' ); ?>">
						<i class="icon-search icon-white"></i> <input name="s" id="s" type="text" class="search-query" autocomplete="off" placeholder="<?php _e('Search','bonestheme'); ?>" data-provide="typeahead" data-items="4" data-source='<?php echo $typeahead_data; ?>'>
					</form>
				</div>
			</div>
		</div> <!-- Navbar fixed top -->
	</div> <!-- end #inner-header -->
	<?php wpboot_header(); ?>	
</header> <!-- end header -->

<!------------------------------------Header ends ------------------------------->
<?php wpboot_main_before(); ?>
<div id="main" class="site-main row-fluid">

		<?php wpboot_main(); ?>
