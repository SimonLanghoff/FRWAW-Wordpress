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


// List of movies
function get_movie_list(){
    return array(
        'movie1' => __( 'Blue Velvet', 'movie' ),
        'movie2' => __( 'Twin Peaks', 'movie' ),
        'movie3' => __( 'Eraser Head', 'movie' ),
        'movie4' => __( 'X-files', 'movie' ),
        'movie5' => __( 'Mulholland Drive', 'movie' ),
        'movie6' => __( 'Lost Highway', 'movie' ),
        'movie7' => __( 'Twin Peaks Series', 'movie' ),
        'movie8' => __( 'Terminator', 'movie'),
        'movie9' => __( 'Her', 'movie'),
        'movie10' => __( 'Searching for Sugar Man', 'movie'),
        'movie11' => __( 'The Room', 'movie' ),
    );
}


add_theme_support('post-thumbnails');

add_filter('rwmb_meta_boxes', 'add_movie_meta');
add_filter('rwmb_meta_boxes', 'add_news_info');
add_filter('rwmb_meta_boxes', 'add_event_info');
add_filter('rwmb_meta_boxes', 'add_recommendation');
add_filter('rwmb_meta_boxes', 'add_main_news_info');

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
                // list of similar movie id's
                'id' => $prefix . 'similar-movies',
                'name' => 'Similar Movies',
                'type' => 'select_advanced',
                'options' => get_movie_list(),
                'multiple'    => true,
                'std'         => 'blue velvet',
                'placeholder' => __( 'Select similar movies', 'similar-movies' ),
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

function add_main_news_info($args) {
    $prefix = 'siml_';

    $args[] = array (
        'id' => 'main_news_item',
        'title' => 'Main News Item',
        'pages' => array('main_news_item'),
        'context' => 'normal',
        'priority' => 'high',

        'fields' => array(
            array(
                'id' => $prefix . 'main_news_picture',
                'name' => 'Picture',
                'type' => 'image_advanced'
            ),
            array(
                // Should link to a user
                'id' => $prefix . 'main_news_author',
                'name' => 'Author',
                'type' => 'text'
            ),
            array(
                'id' => $prefix . 'main_news_date',
                'name' => 'Event Date (if appropriate)',
                'type' => 'datetime',

                'js_options' => array(
                    'showTimepicker' => true,
                ),
            ),
            array(
                // Should link to a user
                'id' => $prefix . 'main_news_location',
                'name' => 'Location',
                'type' => 'text'
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
                'id' => $prefix . 'event_location',
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

// Meta box for recommendations
function add_recommendation ($args) {
    $prefix = 'siml_';

    $args[] = array (
        'id' => 'recommendation',
        'title' => 'Recommendation',
        'pages' => array('recommendation'),
        'context' => 'normal',
        'priority' => 'high',


        'fields' => array(
            array(
                // Let the user select from the list of movies
                'id' => $prefix . 'recommended_movie',
                'name' => 'Recommended Movie',
                'type' => 'select_advanced',
                'options' => get_movie_list(),
                'multiple'    => false,
                'placeholder' => __( 'Select Recommended Movie', 'recommendations' ),
            ),
        )
    );

    return $args;
}

// Simple function used to get the correct movie based on its id.
// This should really be done by matching together the custom post type meta box with the corresponding
// movie, but this will do for simple showcasing of the functionality.
function get_movie_info($movie_id){
    $movie_title = null;
    switch($movie_id){
        case "movie1":
            $movie_title = "blue-velvet-1986";
            break;
        case "movie2":
            $movie_title = "twin-peaks-fire-walk-with-me-1992";
            break;
        case "movie3":
            $movie_title = "eraser-head-1977";
            break;
        case "movie4":
            $movie_title = "the-x-files-1993-2002";
            break;
        case "movie5":
            $movie_title = "mulholland-drive-2001";
            break;
        case "movie6":
            $movie_title = "lost-highway-1997";
            break;
        case "movie7":
            $movie_title = "twin-peaks-1990";
            break;
        case "movie8":
            $movie_title = "terminator-1984";
            break;
        case "movie9":
            $movie_title = "her-2013";
            break;
        case "movie10":
            $movie_title = "searching-for-sugar-man-2012";
            break;
        case "movie11":
            $movie_title = "the-room-2003";
            break;
        default:
            return null;
    }


    $movie_info = null;

    // Query args for fetching a similar movie.
    $get_movie_query_args = array(
        'name'              => $movie_title,
        'post_type'			=> 'movie',
        'posts_per_page'	=> 1
    );

    // Get all the news items
    $movie_info = get_posts($get_movie_query_args);
    // Movie is wrapped in an array, get the first item.
    $movie_info = reset($movie_info);

    return $movie_info;
}

/* Simple Function to get predefined images for ratings. */
function get_rating_image_dir($rating_number){

    $uri = null;
    switch($rating_number){
        case 7:
            $uri = get_template_directory_uri() . "/images/Movies/ratings/RatingStar7.png";
            break;
        case 8:
            $uri = get_template_directory_uri() . "/images/Movies/ratings/RatingStar8.png";
            break;
        case 9:
            $uri = get_template_directory_uri() . "/images/Movies/ratings/RatingStar9.png";
            break;
        default:
            $uri = get_template_directory_uri() . "/images/Movies/ratings/RatingStar10.png";
            break;
    }

    return $uri;
}

// Exclude pages from the search results.
add_action('pre_get_posts','exclude_all_pages_search');
function exclude_all_pages_search($query) {
    if (
        ! is_admin()
        && $query->is_main_query()
        && $query->is_search
        && is_user_logged_in()
    )
        $query->set( 'post_type', array('post', 'movie', 'recommendation', 'comment', 'event') );
}

// We need to get all kinds of custom type posts when we look at an author page.
function custom_post_author_archive($query) {
    if ($query->is_author)
        $query->set( 'post_type', array('movie', 'recommendation', 'news', 'main_news_item', 'comment') );
    remove_action( 'pre_get_posts', 'custom_post_author_archive' );
}
add_action('pre_get_posts', 'custom_post_author_archive');

?>




