<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>"/>
    <meta name="viewport" content="width=device-width"/>
    <title><?php wp_title(' | ', true, 'right'); ?></title>
<!--    <link rel="stylesheet" type="text/css" href="--><?php //echo get_stylesheet_uri(); ?><!--"/>-->
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<div class="container_12">
    <header>
        <a href="<?php echo home_url(); ?>">
        <div class="banner-logo-container grid_3">

            <!-- Image loaded as background image in css-->
        </div>




        </a>
        <!--Wordpress menu goes away, so manually create Mobile menu -->
        <div class="visible-mobile">
            <div id="mobile-menu-button">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </div>
        </div>
        <?php wp_nav_menu('main_menu')?>
    </header>

    <!-- This will display a collapsible menu that is right aligned under the header when the mobile menu butotn is pressed-->
    <div id="mobile-nav-bar" class="visible-mobile mobile-navigation hidden">
        <div>
            <nav class="no-margin">

                <a href="<?php echo(get_permalink( get_page_by_title( 'Home' ) ))?>">Home</a>
                <a href="<?php echo(get_permalink( get_page_by_title( 'Movies' ) ))?>">Movies</a>
                <a href="<?php echo(get_permalink( get_page_by_title( 'About' ) ))?>">About</a>
            </nav>
        </div>
    </div>

<!--    Wrap the main content. -->
    <div class="wrapper">