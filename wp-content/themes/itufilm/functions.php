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

add_filter('rwmb_meta_boxes', 'add_movie_meta');
add_filter('rwmb_meta_boxes', 'add_news_info');
add_filter('rwmb_meta_boxes', 'add_event_info');

function add_movie_meta ($args) {
    $prefix = 'siml_';

    $args[] = array (
        'id' => 'movie_details',
        'title' => 'Movie Details',
        'pages' => array('movie'),
        'context' => 'normal',
        'priority' => 'high',

        'fields' => array(
            array(
                'id' => $prefix . 'movie_poster',
                'name' => 'Movie Poster',
                'type' => 'image_advanced'
            ),
            array(
                'id' => $prefix . 'rating',
                'name' => 'Movie Rating',
                'type' => 'number'
            ),
            array(
                'id' => $prefix . 'recommendations',
                'name' => 'Recommendations',
                'type' => 'number'
            ),
            array(
                //            list of similar movie id's
                'id' => $prefix . 'similar-movies',
                'name' => 'Similar Movies',
                'type' => 'select_advanced',
                'options' => array(
                    'movie1' => __( 'blue velvet', 'similar-movie' ),
                    'movie2' => __( 'twin-peaks', 'similar-movie' ),
                    'movie3' => __( 'eraser head', 'similar-movie' ),
                    'movie4' => __( 'x-files', 'similar-movie' ),
                    'movie5' => __( 'mulholland drive', 'similar-movie' ),
                    'movie6' => __( 'lost highway', 'similar-movie' ),
                ),

                'multiple'    => true,
                'std'         => 'blue velvet',
                'placeholder' => __( 'Select similar movies', 'similar-movie' ),

            ),
            array(
                'id' => $prefix . 'type',
                'name' => 'Type',
                'type' => 'text'
            ),
            array(
                'id' => $prefix . 'genre',
                'name' => 'Genre',
                'type' => 'text'
            ),
            array(
                'id' => $prefix . 'playtime',
                'name' => 'Playtime',
                'type' => 'text'
            ),
            array(
                'id' => $prefix . 'creators',
                'name' => 'Creators',
                'type' => 'text'
            ),
            array(
                'id' => $prefix . 'stars',
                'name' => 'Starring',
                'type' => 'text'
            ),
            array(
                'id' => $prefix . 'moods',
                'name' => 'Moods',
                'type' => 'text'
            ),
        )
    );

    return $args;
}

// Meta box for news items
function add_news_info ($args) {
    $prefix = 'siml_';

    $args[] = array (
        'id' => 'news_item',
        'title' => 'News Item',
        'pages' => array('news'),
        'context' => 'normal',
        'priority' => 'high',

        'fields' => array(
            array(
                'id' => $prefix . 'news_picture',
                'name' => 'Picture',
                'type' => 'image_advanced'
            ),
            array(
                // Should link to a user
                'id' => $prefix . 'news_author',
                'name' => 'Author',
                'type' => 'text'
            ),
            array(
                'id' => $prefix . 'news_date',
                'name' => 'Date',
                'type' => 'datetime',

                'js_options' => array(
                    'showTimepicker' => false,
                ),
            ),
        )
    );

    return $args;
}

// Meta box for the next event
function add_event_info ($args) {
    $prefix = 'siml_';

    $args[] = array (
        'id' => 'event_next',
        'title' => 'Next Event',
        'pages' => array('event'),
        'context' => 'normal',
        'priority' => 'high',

        'fields' => array(
            array(
                'id' => $prefix . 'event_picture',
                'name' => 'Picture',
                'type' => 'image_advanced'
            ),
            array(
                // Should link to a user
                'id' => $prefix . 'location',
                'name' => 'Location',
                'type' => 'text'
            ),
            array(
                'id' => $prefix . 'event_time',
                'name' => 'Date',
                'type' => 'datetime',

                'js_options' => array(
                    'showTimepicker' => true,
                    'stepMinute'     => 15
                ),
            ),
        )
    );

    return $args;
}


// Add a filter such that we can query custom posts using the title.
add_filter( 'posts_where', 'title_like_posts_where', 10, 2 );
function title_like_posts_where( $where, &$wp_query ) {
    global $wpdb;
    if ( $post_title_like = $wp_query->get( 'post_title_like' ) ) {
        $where .= ' AND ' . $wpdb->posts . '.post_title LIKE \'' . esc_sql( $wpdb->esc_like( $post_title_like ) ) . '%\'';
    }
    return $where;
}

// Simple function used to get the correct movie based on its id.
// This should really be done by matching together the custom post type meta box with the corresponding
// movie, but this will do for simple showcasing of the functionality.
function get_movie_info($movie_title){
    $args = array(
        'post_title_like' => $movie_title
    );
    // TODO: do new here so we don't have to clear.
    return new WP_Query( $args );

//
//    switch($movie_title){
//        case "movie1":
//            echo("movie1");
//
//            break;
//        case "movie2":
//            echo("movie2");
//            break;
//        case "movie3":
//            echo("movie3");
//            break;
//        case "movie4":
//            echo("movie4");
//            break;
//        case "movie5":
//            echo("movie5");
//            break;
//        case "movie6":
//            echo("movie6");
//            break;
//        default:
//            echo("Movie not recognized!");
//            break;
//    }
//
//    $args = array(
//        'post_type' => 'my_post_type',
//        'post_status' => 'publish',
//        'posts_per_page' => -1
//    );
//    $posts = new WP_Query( $args );
//    if ( $posts -> have_posts() ) {
//        while ( $posts -> have_posts() ) {
//
//            the_content();
//            // Or your video player code here
//
//        }
//    }
//    wp_reset_query();
//
//    return $result;

}

?>




