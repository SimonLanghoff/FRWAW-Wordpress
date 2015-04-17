<?php get_header(); ?>
<?php get_sidebar(); ?>

    <div id="content" class="grid_9">
    <h1>ITU.film's Movie Database</h1>


    <?php get_search_form(); ?>
    <!-- Image loaded in css -->
<!--    <div class="search-box only-search">-->
<!--        <input class="visible-desktop" type="text">-->
<!---->
<!--        <!-- Example search input for mobile version --><!-->
<!--        <input class="visible-mobile" type="text" placeholder="Bittersweet, touching, gloomy">-->
<!--    </div>-->

    <!--
        Here I add some content to simulate that a user has searched for a movie.
         (Since the search bar is only designed, it's not functional)
         This will make the mobile version look more like the design I did previously.
    -->

    <div class="search-results-container visible-mobile">
        <h4>Results for bittersweet, touching, gloomy</h4>
        <div class="search-results">
            <div class="search-result">
                <a href=""><img src="images/Perks-of-Being-a-Wallflower-The-poster.jpg"></a>
                <h3 class="text-overlay">The Perks of Being a Wallflower (2012)</h3>
            </div>
            <div class="search-result hidden">
                <a href=""><img src="images/Perks-of-Being-a-Wallflower-The-poster.jpg"></a>
                <h1 class="text-overlay"> Other movie here</h1>
            </div>
            <a href="">
                <img src="images/button-left.png" class="button-left">
            </a>

            <a href="">
                <img src="images/button-right.png" class="button-right">
            </a>
        </div>
    </div>

    <div class="recommendations">
        <div class="user-comments">
            <h2> Latest Recommendations </h2>

            <?php
            // Get the recommendations

            // TODO: Sort by date.
            // Query args for fetching the featured screening.
            $get_recommendations_query_args = array(
                'post_type'			=> 'Recommendation',
                'posts_per_page'	=> 10,
                'orderby'			=> 'post_date',
                'order'				=> 'ASC'
            );

            $recommendations = get_posts($get_recommendations_query_args);


            ?>
            <?php $count = 0 ?>
            <?php foreach($recommendations as $recommendation):?>

                <?php

                // Get meta data (
                $recommended_movie = rwmb_meta('siml_recommended_movie', 'type=text', $recommendation -> ID );
                $recommended_movie = get_movie_info($recommended_movie);

                $username = get_userdata($recommendation -> post_author)->display_name; // accessed using magic! woo!
                $movie_link = get_permalink($recommended_movie -> ID);
                $movie_title = $recommended_movie -> post_title;
                $user_link = get_permalink($recommendation -> post_author);



                $date = $recommendation -> post_date_gmt;
                $date = strtotime($date);

                ?>

            <article class="comment <?php  if($count % 2 == 0) { echo "row-even"; }   ?>  ">
                <div class="comment-picture">
                    <?php echo " <img src=\"" . get_template_directory_uri() . "/images/profile_dummy.jpg\" >"?>
                </div>
                <div class="comment-text">
                    <?php echo "<h4> <a href='$user_link'> $username </a> recommended <a href='$movie_link'> $movie_title </a></h4>"; ?>

                    <span class="date"><?php echo (date("j M. Y" , $date)); ?></span>
                    <p>
                        <?php echo ($recommendation -> post_content); ?>
                    </p>
                </div>
            </article>

            <?php $count++; ?>
            <?php endforeach ?>
        </div>
        <a href="<?php echo(get_post_type_archive_link("recommendations"));?>">More recommendations...</a>
    </div>


    <div class="list-wrapper container_9">
        <div class="movie-list">
            <h2>Latest Movies</h2>
            <ul class="no-margin">

                <?php
                // Get the different movies

                // TODO: Sort by date.
                // Query args for fetching the featured screening.
                $get_movies_query_args = array(
                    'post_type'			=> 'Movie',
                    'posts_per_page'	=> 10,
                    'orderby'			=> 'post_date',
                    'order'				=> 'DESC'
                );

                $movies = get_posts($get_movies_query_args);
                ?>

                <?php foreach($movies as $movie):?>
                <?php
                $movie_link = get_permalink($movie -> ID);
                $movie_title = $movie -> post_title;
                ?>

                <li>
                    <?php echo("<a href=\"$movie_link\">$movie_title</a>"); ?>
                </li>

                <?php endforeach ?>

            </ul>
            <a href="#">More Movies...</a>
        </div>

        <?php
        // Get the different events and their dates

        // TODO: Sort by date.
        // Query args for fetching the featured screening.
        $get_events_query_args = array(
            'post_type'			=> 'Event',
            'posts_per_page'	=> 10,
            'orderby'			=> 'post_date',
            'order'				=> 'DESC'
        );

        $events = get_posts($get_events_query_args);
        ?>

        <div class="event-wrapper">
            <div class="event-list">
                <h2>Screening Events</h2>
                <ul class="no-margin">



                    <?php foreach($events as $event):?>
                        <?php
                        $event_link = get_permalink($event -> ID);
                        $event_title = $event -> post_title;
                        ?>

                        <li>
                            <?php echo("<li><a href=\"$event_link\">$event_title</a></li>"); ?>
                        </li>

                    <?php endforeach ?>
                </ul>
            </div>
            <div class="event-dates">
                <ul class="no-margin">

                    <?php foreach($events as $event):?>
                        <?php
                        // Go through all the events again and display their dates.
                        $event_date = rwmb_meta('siml_event_time', 'type=datetime', $event -> ID );
                        $event_date = date("dS M", strtotime($event_date));


                        ?>

                        <li>
                            <?php echo("<li>$event_date</li>"); ?>
                        </li>

                    <?php endforeach ?>
                </ul>
            </div>
            <a href="#">More Events...</a>
        </div>
    </div>
<?php get_footer(); ?>