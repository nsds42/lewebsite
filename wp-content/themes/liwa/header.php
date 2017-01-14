<!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8) ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<?php 
global $theme_option; 
global $wp_query;
    $seo_title = get_post_meta($wp_query->get_queried_object_id(), "_cmb_seo_title", true);
    $seo_description = get_post_meta($wp_query->get_queried_object_id(), "_cmb_seo_description", true);
    $seo_keywords = get_post_meta($wp_query->get_queried_object_id(), "_cmb_seo_keywords", true);
?>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="author" content="Davis Hoang" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

	<!-- Page Title 
	================================================== -->
	<title><?php bloginfo('name'); ?> - <?php is_front_page() ? bloginfo('description') : wp_title(''); ?></title>
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	
	<!-- For SEO -->
	<?php if($seo_description!="") { ?>
	<meta name="description" content="<?php echo $seo_description; ?>">
	<?php }elseif($theme_option['seo_des']){ ?>
	<meta name="description" content="<?php echo $theme_option['seo_des']; ?>">
	<?php } ?>
	<?php if($seo_keywords!="") { ?>
	<meta name="keywords" content="<?php echo $seo_keywords; ?>">
	<?php }elseif($theme_option['seo_key']){ ?>
	<meta name="keywords" content="<?php echo $theme_option['seo_key']; ?>">
	<?php } ?>
	<!-- End SEO-->
	
	<!--Stylesheet-->
	
	<!--[if lt IE 9]>
		<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
	
	<!-- Favicons -->
	<link rel="shortcut icon" href="<?php echo $theme_option['favicon']['url']; ?>" type="image/png">
	
<?php wp_head(); ?>
</head>



<?php if(is_page_template('page-templates/template-boxes.php')){?>
<body <?php body_class('op0 boxed'); ?> data-animated="fadeIn"> 
<?php }else{ ?>
<body <?php body_class('op0'); ?> data-animated="fadeIn">
<?php } ?>

<!-- Header
================================================== -->
<header id="header">

<!-- Container -->
<div class="container">
	<!-- Logo / Mobile Menu -->
	<div class="three columns">
		<div id="mobile-navigation">
			<form role="search" method="get" id="menu-search" action="<?php echo home_url( '/' ); ?>">			
				<input type="text" placeholder="Start Typing..." value="" name="s" />
			</form>
			<a href="#menu" class="menu-trigger"><i class="icon-reorder"></i></a>
			<span class="search-trigger"><i class="icon-search"></i></span>
		</div>
		<div id="logo">
			<h1><a href="<?php echo home_url(); ?>"><img src="<?php echo $theme_option['logo']['url']; ?>"></a></h1>
		</div>
	</div>

<!-- Navigation
================================================== -->
<div class="thirteen columns">
	<nav id="navigation" class="menu">
		<ul id="responsive">
			<?php
			 $primarymenu = array(
					'theme_location'  => 'primary',
					'menu'            => '',
					'container'       => '',
					'container_class' => '',
					'container_id'    => '',
					'menu_class'      => '',
					'menu_id'         => '',
					'echo'            => true,
					 'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
					 'walker'            => new wp_bootstrap_navwalker(),
					'before'          => '',
					'after'           => '',
					'link_before'     => '',
					'link_after'      => '',
					'items_wrap'      => '%3$s',
					'depth'           => 0,
				);
				if ( has_nav_menu( 'primary' ) ) {
					wp_nav_menu( $primarymenu );
				}
			?>	
			<!-- Search Form -->		
			<li class="search-container">
				<div id="search-form">
					<form role="search" method="get" action="<?php echo home_url( '/' ); ?>">			
						<input type="text" class="search-text-box" value="" name="s" />
					</form>					
				</div>
			</li>
		</ul>
	</nav>	
</div>

</div>
<!-- Container / End -->
</header>
<!-- Header / End -->		

<!-- Content Wrapper / Start -->
<div id="content-wrapper">