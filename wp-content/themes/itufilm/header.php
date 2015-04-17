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
        <?php wp_nav_menu('main_menu')?>
    </header>

<!--    Wrap the main content. -->
    <div class="wrapper">