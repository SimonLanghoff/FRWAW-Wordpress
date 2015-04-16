<?php get_header(); ?>
<?php get_sidebar(); ?>

    <!--  Retrieve the movie from the DB  -->
<?php if (have_posts()) :?>
    <!-- We only have one post, so no while, just get the post.     -->
    <?php the_post();?>
    <!-- Fetch all the needed meta data for each movie.  -->
    <?php

    // Output poster image
    $images = rwmb_meta( 'siml_movie_poster', 'type=image' );
    $movie_poster_high = current($images); // Get the first element (high res poster)

    // Get the rating
    $rating = rwmb_meta( 'siml_rating', 'type=number' );
    $recommendations_number = rwmb_meta( 'siml_rating', 'type=number' );
    $similar_movie_ids = rwmb_meta( 'siml_similar-movies', 'type=select&multiple=true' );
    $type = rwmb_meta( 'siml_type', 'type=text&multiple=true' );
    $genre = rwmb_meta( 'siml_genre', 'type=text&multiple=true' );
    $playtime = rwmb_meta( 'siml_playtime', 'type=text&multiple=true' );
    $creators = rwmb_meta( 'siml_creators', 'type=text&multiple=true' );
    $stars = rwmb_meta( 'siml_stars', 'type=text&multiple=true' );
    $moods = rwmb_meta( 'siml_moods', 'type=text&multiple=true' );
    ?>

<?php else : ?>
    <h2 class="center">Not Found</h2>
    <p class="center">Sorry, but you are looking for
        something that isn't here.</p>
    <?php get_search_form(); ?>
<?php endif; ?>

    <div id="content" class="grid_9">
    <div class="movie-info-container">
        <div class="movie-info-image">
            <!-- Display poster -->
            <?php
                echo "<img class\"no-margin\" src='{$movie_poster_high['url']}' width='{$movie_poster_high['width']}' height='{$movie_poster_high['height']}'  alt='{$movie_poster_high['alt']}' />";
            ?>

            <h3 class="text-overlay visible-mobile"><?php the_title() ?></h3>
        </div>

        <!-- Insert storyline after image, only on mobile (should have been done with JS instead, but could not get it to work. -->
        <div class="visible-mobile">
            <h3 class="no-margin">Storyline</h3>
            <?php the_content();?>
        </div>

        <div class="mobile-header visible-mobile toggle-button" data-toggle="collapse" data-target="#collapse-movie-info">
            <!-- Make Movie Info collapsible -->
            <h2>Movie Information</h2>
            <!-- The button is just dummy content, used to indicate that it is clickable, but clicking anywhere will result in collapsing-->
            <button type="button" >+</button>
        </div>
        <div id="collapse-movie-info" class="movie-info collapse in">

            <h1 class="visible-desktop"><?php the_title() ?></h1>
            <hr class="horizontal-separator no-margin">

            <div class="rating">
                <?php $rating_image = get_rating_image_dir($rating);?>
                <img src="<?php echo($rating_image)?>" alt="A star-shaped polygon with the rating of the movie inside">
                <br>
                <a href="#"> <?php echo("$recommendations_number"); ?> Recommendations</a>
            </div>

            <div class="movie-info-list">
                <ul>
                    <li>Type: <?php echo("$type[0]")?></li>
                    <li>Genre: <?php echo("$genre[0]")?></li>
                    <li>Playtime: <?php echo("$playtime[0]")?></li>
                    <li>Creators: <?php echo("$creators[0]")?></li>
                    <li>Stars: <?php echo("$stars[0]")?></li>
                    <li>Moods: <?php echo("$moods[0]")?></li>
                </ul>
            </div>
            <hr class="horizontal-separator">
            <br>
        </div>

        <!--Instead of moving the div, simply just hide it on mobile. -->
        <div class="visible-desktop">
            <h3 class="no-margin">Storyline</h3>
            <?php the_content();?>
        </div>
        <hr class="horizontal-separator">
    </div>

    <!-- Similar Movies-->
    <div class="similar-movies-container">
        <div class="mobile-header visible-mobile toggle-button" data-toggle="collapse" data-target="#collapse-similar-movies">
            <!-- Create Headline for mobile version-->
            <h2>Similar Movies</h2>
            <!-- The button is just dummy content, used to indicate that it is clickable, but clicking anywhere will result in collapsing-->
            <button type="button">+</button>
        </div>



        <div id="collapse-similar-movies" class="collapse in similar-movies">
            <div class="image-grid no-margin">
                <h2 class="visible-desktop">Similar Movies</h2>

                <!-- Go through each similar movie and add posters and movie info        -->
                <?php
                $count = 1;
                foreach ( $similar_movie_ids as $movie_id ):
                ?>
                    <?php
                    // Get the correct movie title which can be used to fetch the posts:
                    $movie_info = get_movie_info($movie_id);

                    $id = $movie_info -> ID;
                    // Output poster image
                    $similar_movie_poster = rwmb_meta( 'siml_movie_poster', 'type=image', $id);
                    $similar_movie_poster_low = next($similar_movie_poster); // get second item (low-res poster)
                ?>

                <!-- Add posters -->
                <?php
                    // Link to each movie.
                    $link = get_permalink($id);
                    echo "<a href='$link' title='{$similar_movie_poster_low['title']}'><img class=\"movie-thumbnail movie-".$count."\" src='{$similar_movie_poster_low['url']}' alt='{$similar_movie_poster_low['alt']}' /></a>";

                    $count++;
                ?>

                <?php endforeach?>
            </div>

            <!-- Go through each similar movie and add expanded movie info        -->
            <?php
            $count = 1;
            foreach ( $similar_movie_ids as $movie_id ):
            ?>
            <?php
                // Get the correct movie title which can be used to fetch the posts:
                $movie_info = get_movie_info($movie_id);

                $id = $movie_info -> ID;
                // Output poster image
                // TODO: get hires
                $similar_movie_poster = rwmb_meta( 'siml_movie_poster', 'type=image', $id);
                $similar_movie_poster_high = current($similar_movie_poster); // get first element (hi-res)


                $rating = rwmb_meta( 'siml_rating', 'type=number', $id );
                $recommendations_number = rwmb_meta( 'siml_rating', 'type=number', $id );
                $similar_movie_ids = rwmb_meta( 'siml_similar-movies', 'type=select&multiple=true', $id );
                $type = rwmb_meta( 'siml_type', 'type=text&multiple=true', $id );
                $genre = rwmb_meta( 'siml_genre', 'type=text', $id );

//            var_dump($similar_movie_poster_high);

            ?>

            <!-- Add similar movie information blocks. -->
            <?php ?>

            <div class="similar-movie-expanded <?php if($count != 1){ echo(" hidden "); }?> <?php echo("movie-"."$count"." no-margin\"");   echo(">"); ?>
                <?php echo("<a href='$link' title='{$similar_movie_poster_high['title']}'><img src='{$similar_movie_poster_high['url']}' alt='{$similar_movie_poster_high['alt']}' /></a>"); ?>

                <div class="info-container">

                    <h2><?php echo($movie_info -> post_title)?></h2>
                    <p><strong><?php echo("$genre")?></strong></p>
                    <p>
                        <?php echo($movie_info -> post_content)?>
                    </p>
                </div>
            </div>

<!--            <div class="similar-movie-expanded movie-2 no-margin hidden">-->
<!--                <img src="images/Movies/Twin%20Peaks%20Movie%20Poster.jpg" alt="Movie poster for Twin Peaks">-->
<!--                <div class="info-container">-->
<!--                    <h2>Twin Peaks: Fire Walk With Me</h2>-->
<!--                    <p><strong>Thriller, Mystery</strong></p>-->
<!--                    <p>-->
<!--                        A young FBI agent disappears while investigating a murder miles from Twin Peaks that may be related to the future murder of Laura Palmer; the last week of the life of Laura Palmer is chronicled.-->
<!--                    </p>-->
<!--                </div>-->
<!--            </div>-->

        <!-- Make sure to increase counter         -->
            <?php
                $count++;
                endforeach
            ?>
        </div>

    </div>


<!--        Add comments here -->

    <?php comments_template(); ?>
<!--        <div class="user-comments-container">-->
<!--            <div class="user-comments">-->
<!--                <h2 class="visible-desktop">Comments</h2>-->
<!--                <!-- Using Bootstrap to collapse content. Somehow it does not work correctly though--><!-->
<!--                <div class="mobile-header visible-mobile toggle-button" data-toggle="collapse" data-target="#collapse-comments">-->
<!--                    <h2>Comments</h2>-->
<!--                    <!-- The button is just dummy content, used to indicate that it is clickable, but clicking anywhere will result in collapsing--><!-->
<!--                    <button type="button">+</button>-->
<!--                </div>-->
<!--                <div id="collapse-comments" class="comments-container visible-desktop collapse in">-->
<!--                    <article class="comment row-even">-->
<!--                        <div class="comment-picture">-->
<!--                            <img src="images/profile_dummy.jpg" alt="Profile Picture of a User">-->
<!--                        </div>-->
<!--                        <div class="comment-text">-->
<!--                            <h4>Simon Langhoff</h4>-->
<!--                            <span class="date">19 feb. 2015</span>-->
<!--                            <p>-->
<!--                                I am a huge fan of Twin Peaks! Best TV-Series ever! #omg-best-tv-series-ever-->
<!--                            </p>-->
<!--                        </div>-->
<!--                    </article>-->
<!--                    <article class="comment">-->
<!--                        <div class="comment-picture">-->
<!--                            <img src="images/profile_dummy.jpg" alt="Profile Picture of a User">-->
<!--                        </div>-->
<!--                        <div class="comment-text">-->
<!--                            <h4>Billy</h4>-->
<!--                            <span class="date">19 feb. 2015</span>-->
<!--                            <p>-->
<!--                                Kyle MacLachlan &lt;3-->
<!--                            </p>-->
<!--                        </div>-->
<!--                    </article>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->



    <!-- Make sure to reset query-->
<?php
wp_reset_query();
?>

    <!---->
    <!--<section id="content" role="main">-->
<?php //if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
    <!--<article id="post---><?php //the_ID(); ?><!--" --><?php //post_class(); ?><!--><!-->
    <!--<header class="header">-->
    <!--<h1 class="entry-title">--><?php //the_title(); ?><!--</h1> --><?php //edit_post_link(); ?>
    <!--</header>-->
    <!--<section class="entry-content">-->
<?php //if ( has_post_thumbnail() ) { the_post_thumbnail(); } ?>
<?php //the_content(); ?>
    <!--<div class="entry-links">--><?php //wp_link_pages(); ?><!--</div>-->
    <!--</section>-->
    <!--</article>-->
<?php //if ( ! post_password_required() ) comments_template( '', true ); ?>
<?php //endwhile; endif; ?>
    <!--</section>-->
<?php //get_sidebar(); ?>


<?php get_footer(); ?>