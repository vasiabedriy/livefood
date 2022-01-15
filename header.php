<?php
/**
 * The Header template for our theme
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */
?><!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) & !(IE 8)]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width" />
	<title><?php wp_title( '|', true, 'right' ); ?></title>
	<link rel="profile" href="https://gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php echo esc_url( get_bloginfo( 'pingback_url' ) ); ?>">
	<?php // Loads HTML5 JavaScript file to add support for HTML5 elements in older IE versions. ?>
	<!--[if lt IE 9]>
<![endif]-->
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<header>
	<div class="site_logo">
        <a href="/">
		    <img src="<?php echo get_template_directory_uri(); ?>/library/images/logo.png">
        </a>
        <ul><?php pll_the_languages(array('display_names_as'=> 'slug' ,'show_names'=>0));?></ul>
	</div>
	<div class="main_menu">
		<?php $menuParameters = [
			'menu'            => 'primary',
			'container'       => false,
			'echo'            => false,
			'items_wrap'      => '%3$s',
			'depth'           => 0,
		];
		$menu = strip_tags(wp_nav_menu( $menuParameters ), '<a>' );
		echo $menu;?>
	</div>
	<div class="actions">
		<div class="socials">
			<a href="#">
                <img src="<?php echo get_template_directory_uri(); ?>/library/images/inst.svg">
			</a>
			<a href="#">
                <img src="<?php echo get_template_directory_uri(); ?>/library/images/fb.svg">
			</a>
		</div>
		<div class="action">
			<a href="#">
                <img src="<?php echo get_template_directory_uri(); ?>/library/images/heart.svg">
			</a>
			<a href="/cart">
                <img src="<?php echo get_template_directory_uri(); ?>/library/images/bag.svg">
			</a>
		</div>
	</div>
    <img class="mobile_menu_icon" src="<?php echo get_template_directory_uri(); ?>/library/images/mobile_menu.svg">

    <div class="mobile-nav hide">
        <div class="site_logo">
            <a href="/">
                <img src="<?php echo get_template_directory_uri(); ?>/library/images/logo_white.png">
            </a>
            <ul><?php pll_the_languages(array('display_names_as'=> 'slug' ,'show_names'=>0));?></ul>
        </div>
        <div class="menu">
	        <?php echo $menu;?>
        </div>
        <div class="phones">
            <a href="#">+38 095 5709 955</a>
        </div>
        <div class="socials">
            <a href="#">
                <img src="<?php echo get_template_directory_uri(); ?>/library/images/inst_white.svg">
            </a>
            <a href="#">
                <img src="<?php echo get_template_directory_uri(); ?>/library/images/fb_white.svg">
            </a>
        </div>
    </div>
</header>

