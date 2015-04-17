<?php get_header(); ?>
<?php get_sidebar(); ?>

<?php if ( have_posts()) :?>

    <?php
    // Query args for fetching the news items.
    $next_event_query_args = array(
        'post_type'			=> 'main_news_item',
        'posts_per_page'	=> 1, // only get one item
        'meta_key'			=> 'siml_main_news_date',
        'orderby'			=> 'meta_value',
        'order'				=> 'DESC'
    );


    // Get all the news items
    $news_main = get_posts($next_event_query_args);
    ?>
    <?php foreach($news_main as $news_item_main) : ?>
        <?php
        // Fetch all the meta data for each news and create the HTML markup.
        $news_image_main = rwmb_meta( 'siml_main_news_picture', 'type=image&size=700x259', $news_item_main -> ID );
        $news_image_main = reset($news_image_main); // There is only one element for each news, just get it.
        $username = get_userdata($news_item_main -> post_author)->display_name; // accessed using magic! woo!
        $author_link = get_author_posts_url($news_item_main -> post_author);
        $date_main = rwmb_meta( 'siml_main_news_date', 'type=datetime', $news_item_main -> ID );

        $date_main = strtotime($date_main);
        $location_main = rwmb_meta( 'siml_main_news_location', 'type=text', $news_item_main -> ID );


        ?>

    <div id="content" class="grid_9 home-page" role="main">
        <div class="news-item-main">
            <article>
                <?php echo "<img src='{$news_image_main["url"]}' height='260'  alt='{$news_image_main['alt']}' />"; ?>
                <div class="news-item-main-backdrop">
                    <div class="event-headline">
                        <a href="<?php echo get_permalink($news_item_main -> ID); ?>">
                        <h1>
                            <?php echo($news_item_main -> post_title) ?>
                        </h1>
                        </a>
                        <h1 class="visible-mobile">
                            <?php echo(date("j F " , $date_main) . date("H:i ", $date_main) . "in " . $location_main);  ?>
                        </h1>
                    </div>
                    <p>
                        <?php echo($news_item_main -> post_content) ?>
                    </p>
                </div>
            </article>
            <hr class="visible-mobile">
        </div>

    <?php endforeach ?>


        <?php
        // Query args for fetching the news items.
        $next_event_query_args = array(
            'post_type'			=> 'news',
            'posts_per_page'	=> 10,
            'meta_key'			=> 'siml_news_date',
            'orderby'			=> 'meta_value',
            'order'				=> 'DESC'
        );


        // Get all the news items
        $news = get_posts($next_event_query_args);
        ?>
        <?php foreach($news as $news_item) : ?>
        <?php
            // Fetch all the meta data for each news and create the HTML markup.
            $news_image = rwmb_meta( 'siml_news_picture', 'type=image&size=200x120', $news_item -> ID );
            $news_image = reset($news_image); // There is only one element for each news, just get it.
            $author = get_userdata($news_item -> post_author)->display_name; // accessed using magic! woo!
            $author_link = get_author_posts_url($news_item -> post_author);
            $date = rwmb_meta( 'siml_news_date', 'type=datetime', $news_item -> ID );
            $date = strtotime($date);


            ?>

        <div class="news-item">
            <article>
                <div class="article-headline-container">
                    <a href="<?php echo get_permalink($news_item -> ID); ?>">
                    <h2 class=" article-headline">
                        <?php echo($news_item -> post_title);?>
                    </h2>
                    </a>
                    <h4 class="text-left no-margin"> Written by <?php echo( "<a href=\"$author_link\">$author </a>"); ?> </h4>
                    <!--        Transform date                    -->
                    <h4 class="text-right no-margin"> <?php echo(date("j M" . "." . " Y" , $date))?></h4>
                </div>
                <div class="news-item-images">
                    <figure>
                        <!--    Override image size since WP sets it to 150x150                    -->
                        <?php echo "<img src='{$news_image["url"]}' width='{$news_image["width"]}' height='140'  alt='{$news_image['alt']}' />"; ?>
                    </figure>
                    <!-- I decided to only include facebook integration since that is the only social site that ITU.film uses right now anyways.-->
                    <figure>
                        <div class="fb-like" data-href="https://www.facebook.com/itu.film" data-layout="button" data-action="like" data-show-faces="false" data-share="true"></div>
                    </figure>
                </div>
                <p>
                        <!-- Output the news item content                    -->
                    <?php echo($news_item -> post_content)?>
                </p>
            </article>
            <hr/>
        </div>

        <?php endforeach ?>
    </div>

<?php else : ?>
    <h2 class="center">Not Found</h2>
    <p class="center">Sorry, but you are looking for
        something that isn't here.</p>
    <?php get_search_form(); ?>
<?php endif; ?>
<?php get_footer(); ?>