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
<!--    <header id="header" role="banner">-->
<!--        <section id="branding">-->
<!--            <div id="site-title">--><?php //if (!is_singular()) {
//                    echo '<h1>';
//                } ?><!--<a href="--><?php //echo esc_url(home_url('/')); ?><!--"-->
<!--                       title="--><?php //esc_attr_e(get_bloginfo('name'), 'itufilm'); ?><!--"-->
<!--                       rel="home">--><?php //echo esc_html(get_bloginfo('name')); ?><!--</a>--><?php //if (!is_singular()) {
//                    echo '</h1>';
//                } ?><!--</div>-->
<!--            <div id="site-description">--><?php //bloginfo('description'); ?><!--</div>-->
<!--        </section>-->
<!--    </header>-->

<div class="container_12">
    <header>
        <div class="banner-logo-container grid_3">
            <!-- Image loaded as background image in css-->
        </div>
        <?php wp_nav_menu('main_menu')?>
    </header>

<!--    Wrap the main content. -->
    <div class="wrapper">