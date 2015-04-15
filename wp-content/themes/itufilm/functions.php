<?php
add_action('after_setup_theme', 'itufilm_setup');
function itufilm_setup()
{
    load_theme_textdomain('itufilm', get_template_directory() . '/languages');
    add_theme_support('automatic-feed-links');
    add_theme_support('post-thumbnails');
    global $content_width;
    if (!isset($content_width)) $content_width = 640;

    register_nav_menus(array(
        'main-menu' => __('Navigation', 'itufilm')
    ));
}

add_action('wp_enqueue_scripts', 'itufilm_load_scripts');
function itufilm_load_scripts()
{
//     Enqueue Scripts and Styles
    wp_register_script('bootstrap', get_template_directory_uri() . '/js/bootstrap.js');
    wp_register_script('facebook', get_template_directory_uri() . '/js/facebook-sdk.js');
    wp_register_script('functions', get_template_directory_uri() . '/js/functions.js');

    wp_register_style('960_grid', get_template_directory_uri() . '/css/960_12_col.css');
    wp_register_style('bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css');
    wp_register_style('styles', get_template_directory_uri() . '/css/styles.css');
    wp_register_style('styles-mobile', get_template_directory_uri() . '/css/styles-mobile.css' ,
        array(),
        '',
        'screen and (max-width: 960px)');

//     Enqueue Scripts and Styles
    wp_enqueue_script('jquery');

    wp_enqueue_script('bootstrap');
    wp_enqueue_script('facebook');
    wp_enqueue_script('functions');

    wp_enqueue_style('960_grid');
    wp_enqueue_style('bootstrap');
    wp_enqueue_style('styles');
    wp_enqueue_style('styles-mobile');

}

add_action('comment_form_before', 'itufilm_enqueue_comment_reply_script');
function itufilm_enqueue_comment_reply_script()
{
    if (get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}

add_filter('the_title', 'itufilm_title');
function itufilm_title($title)
{
    if ($title == '') {
        return '&rarr;';
    } else {
        return $title;
    }
}

add_filter('wp_title', 'itufilm_filter_wp_title');
function itufilm_filter_wp_title($title)
{
    return $title . esc_attr(get_bloginfo('name'));
}

add_action('widgets_init', 'itufilm_widgets_init');
function itufilm_widgets_init()
{
    register_sidebar(array(
        'name' => __('Sidebar Widget Area', 'itufilm'),
        'id' => 'primary-widget-area',
        'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
        'after_widget' => "</li>",
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));
}

function itufilm_custom_pings($comment)
{
    $GLOBALS['comment'] = $comment;
    ?>
    <li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>"><?php echo comment_author_link(); ?></li>
<?php
}

add_filter('get_comments_number', 'itufilm_comments_number');
function itufilm_comments_number($count)
{
    if (!is_admin()) {
        global $id;
        $comments_by_type = &separate_comments(get_comments('status=approve&post_id=' . $id));
        return count($comments_by_type['comment']);
    } else {
        return $count;
    }
}


/* TODO: make your own */

add_theme_support('post-thumbnails');

add_filter('rwmb_meta_boxes', 'show_me_the_picture');

function show_me_the_picture ($args) {
    $prefix = 'yiha_';

    $args[] = array (
        'id' => 'movie_details',
        'title' => 'Movie Details',
        'pages' => array('movie'),
        'context' => 'normal',
        'priority' => 'high',
        'fields' => array(
            array(
                'id' => $prefix . 'movie_poster',
                'name' => 'Image',
                'type' => 'image_advanced'
            ),
            array(
                'id' => $prefix . 'movie_banner',
                'name' => 'Banner',
                'type' => 'image_advanced'
            ),
            array(
                'id' => $prefix . 'start_date',
                'name' => 'Start Date',
                'type' => 'date'
            ),
            array(
                'id' => $prefix . 'end_date',
                'name' => 'End Date',
                'type' => 'date'
            ),
            array(
                'id' => $prefix . 'time_slots',
                'name' => 'Time slots',
                'type' => 'text'
            ),
            array(
                'id' => $prefix . 'category',
                'name' => 'Category',
                'type' => 'text'
            ),
        )
    );

    return $args;
}

?>


