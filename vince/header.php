<?php
/**
 * @package WordPress
 * @subpackage The Crest
 */
?><!DOCTYPE html xmlns:fb="http://ogp.me/ns/fb#">
<!--[if IE 7 ]> <html <?php language_attributes(); ?> class="ie7"> <![endif]-->
<!--[if IE 8 ]> <html <?php language_attributes(); ?> class="ie8"> <![endif]-->
<!--[if IE 9 ]> <html <?php language_attributes(); ?> class="ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <html <?php language_attributes(); ?>> <!-- <![endif]-->

<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta http-equiv="X-UA-Compatible" content="chrome=1">

<title><?php
	/*
	 * Print the <title> tag based on what is being viewed.
	 */
	global $page, $paged;

	wp_title( '|', true, 'right' );

	// Add the blog name.
	bloginfo( 'name' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		echo " | $site_description";

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		echo ' | ' . sprintf( __( 'Page %s', 'themename' ), max( $paged, $page ) );

	?></title>
	<meta name="description" content="<?php the_excerpt(); ?>">
	<meta name="author" content="Vince Camuto">
	
	<!--  Mobile Viewport Fix -->
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
	
	<!-- NEED TO ADD FOR FACEBOOK -->
	<meta property="og:title" content="<?php the_title(); ?>" />
	<meta property="og:type" content="blog" />
	<meta property="og:url" content="<?php the_permalink(); ?>" />
	<meta property="og:site_name" content="The Crest" />
	<!-- // -->
    
	<!-- Place favicon.ico and apple-touch-icons in the images folder -->
	<link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/images/favicon.ico">	
	<link rel="profile" href="http://gmpg.org/xfn/11" />
    <link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); echo '?' . filemtime( get_stylesheet_directory() . '/style.css'); ?>" type="text/css" media="screen" />
    <link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/jquery.fancybox.css" type="text/css" media="screen" />


	<?php if ( is_singular() && get_option( 'thread_comments' ) ) wp_enqueue_script( 'comment-reply' ); ?>
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	
	<!--[if lt IE 9]>
    <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
	
	<?php wp_head(); ?>	
	</head>
	
	<body <?php body_class(); ?>>
		
	<div id="top-bar-cont" class="clear">
		<div id="top-bar">
			<h1 id="vince-logo" class="left">Vince Camuto</h1>
			<div class="form-cont right clear">
				<div class="email left">
					<form class="email-form">
					<input class="join" type="text" value="Join Our Email List" onfocus="if (this.value=='Join Our Email List') this.value='';" onblur="if (this.value=='') this.value='Join Our Email List';">
					<input class="submit-email" type="submit" value="submit" >
					</form>
				</div>
				
				<div id="search" class="left">
					<?php get_search_form(); ?>
				</div>
			</div>
		</div>
	</div>
	<div id="page" class="hfeed">
		
		<header id="branding" role="banner">
				<h1 id="site-title"><span><a href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></span></h1>
				<nav id="main-nav" role="article">
					<?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>
				</nav> <!-- #main-nav -->
		</header><!-- #branding -->
	
	
		<div id="main" class="clear">