<?php get_header(); ?>
<?php get_sidebar(); ?>

    <!--  Retrieve the movie from the DB  -->
<?php if (have_posts()) :?>
    <?php while (have_posts()) : the_post();?>

        <!-- Fetch all the needed meta data for each movie.  -->
        <?php
        // Output poster image
        $images_poster = rwmb_meta( 'siml_movie_poster', 'type=image' );

        // Get the rating
        $rating = rwmb_meta( 'siml_rating', 'type=number' );
        $recommendations_number = rwmb_meta( 'siml_rating', 'type=number' );
        $similar_movie_ids = rwmb_meta( 'siml_similar-movies', 'type=select&multiple=true' );

        ?>



        <div id="content" class="grid_9">
        <div class="movie-info-container">
            <div class="movie-info-image">
                <!-- Display poster -->
                <?php
                foreach ( $images_poster as $image )
                {
                echo "<img class\"no-margin\" src='{$image['url']}'  alt='{$image['alt']}' />";
                }
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
                    <img src="images/RatingStar.png" alt="A star-shaped polygon with the rating of the movie inside">
                    <br>
                    <a href="#">4 Recommendations</a>
                </div>

                <div class="movie-info-list">
                    <ul>
                        <li>Type: TV Series</li>
                        <li>Genre: Drama, Mystery, Thriller</li>
                        <li>Playtime: 47 minutes</li>
                        <li>Creators: Mark Frost, David Lynch</li>
                        <li>Stars: Kyle MacLachlan, Michael Ontkean, Mädchen Amick</li>
                        <li>Moods: Adventurous, Spooky, Experimental</li>
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

                    <!-- Add posters -->
                    <?php
                    foreach ( $similar_movie_ids as $movie_id ) {
                        // Get the correct movie title which can be used to fetch the posts:
                        // TODO:
                        $movie_title = get_movie_info($movie_id);


//                        $args = array(
//                            'post_title_like' => $movie_title
//                        );
//
//                        $result = new WP_Query( $args );
//
//                        if ($result -> have_posts()){
//                            while ($result->have_posts()){
//                                $result -> the_post();
//                                the_title();
//                                the_content();
//
//                                var_dump($result->the_post());
//                            }
//
//                        }
//                        wp_reset_query();


                        // TODO: Change the global post stuff?
                        // Now we got the movie post for each similar movie, so get the poster image.
                        $similar_movie_posters = rwmb_meta( 'siml_movie_poster', 'type=image' );
                        foreach ( $similar_movie_posters as $movie_poster )
                        {
                            //$link = the_permalink($movie_post -> ID);
                        // echo "<a href='$the_permalink($movie_post -> ID)'> <img class\"no-margin\" src='{$image['url']}'  alt='{$image['alt']}' /> </a> ";
                            // echo "<a href='$link' title='{$movie_poster['title']}'><img src='{$movie_poster['url']}' alt='{$movie_poster['alt']}' /></a>";
                        }

                        // TODO: reset query???
                    }
                    ?>
                    <!-- Added div to horizontally align picture grid when viewed on mobile. -->
                    <a href="">
                        <img class="movie-thumbnail movie-1" src="images/Movies/Blue%20Velvet%20Poster.jpg" alt="Movie Poster for Blue Velvet">
                    </a>
                    <a href="">
                        <img class="movie-thumbnail movie-2" src="images/Movies/Twin%20Peaks%20Movie%20Poster.jpg" alt="Movie Poster for Twin Peaks the movie">
                    </a>
                    <a href="">
                        <img class="movie-thumbnail movie-3" src="images/Movies/Eraser%20Head.jpg" alt="Movie Poster for Eraser Head">
                    </a>
                    <a href="">
                        <img class="movie-thumbnail movie-4" src="images/Movies/The%20Xfiles.jpg" alt="Movie Poster for The X files">
                    </a>
                    <a href="">
                        <img class="movie-thumbnail movie-5" src="images/Movies/Mulholland%20Drive.jpg" alt="Movie Poster for Mulholland Drive">
                    </a>
                    <a href="">
                        <img class="movie-thumbnail movie-6" src="images/Movies/Lost%20Highway.jpg" alt="Movie Poster for Lost Highway">
                    </a>
                </div>
                <!-- Highlighted Movie info should only be visible on desktop -->
                <!-- A section for each similar movie is requested but only one is visible at a time -->
                <div class="similar-movie-expanded movie-1 no-margin">
                    <img src="images/Movies/blue%20velvet%20high.jpg" alt="A higher resolution movie poster for Blue Velvet">
                    <div class="info-container">
                        <h2>Blue Velvet</h2>
                        <p><strong>Crime, Drama, Mystery</strong></p>
                        <p>
                            The discovery of a severed human ear found in a field leads a young man on an investigation related to a beautiful, mysterious nightclub singer and a group of psychopathic criminals who have kidnapped her child.
                        </p>
                    </div>
                </div>
                <div class="similar-movie-expanded movie-2 no-margin hidden">
                    <img src="images/Movies/Twin%20Peaks%20Movie%20Poster.jpg" alt="Movie poster for Twin Peaks">
                    <div class="info-container">
                        <h2>Twin Peaks: Fire Walk With Me</h2>
                        <p><strong>Thriller, Mystery</strong></p>
                        <p>
                            A young FBI agent disappears while investigating a murder miles from Twin Peaks that may be related to the future murder of Laura Palmer; the last week of the life of Laura Palmer is chronicled.
                        </p>
                    </div>
                </div>
                <div class="similar-movie-expanded movie-3 no-margin hidden">
                    <img src="images/Movies/Eraser%20Head.jpg" alt="Movie poster for Eraserhead">
                    <div class="info-container">
                        <h2>Eraserhead</h2>
                        <p><strong>Drama, Horror, Mystery</strong></p>
                        <p>
                            Henry Spencer tries to survive his industrial environment, his angry girlfriend, and the unbearable screams of his newly born mutant child.
                        </p>
                    </div>
                </div>
                <div class="similar-movie-expanded movie-4 no-margin hidden">
                    <img src="images/Movies/The%20Xfiles.jpg" alt="Movie poster for The X-files">
                    <div class="info-container">
                        <h2>The X-files</h2>
                        <p><strong>Drama, Mystery</strong></p>
                        <p>
                            Two FBI agents, Fox Mulder the believer and Dana Scully the skeptic, investigate the strange and unexplained while hidden forces work to impede their efforts.
                        </p>
                    </div>
                </div>
                <div class="similar-movie-expanded movie-5 no-margin hidden">
                    <img src="images/Movies/Mulholland%20Drive.jpg" alt="Movie poster for Mulholland Drive">
                    <div class="info-container">
                        <h2>Mulholland Drive</h2>
                        <p><strong>Drama, Thriller, Mystery</strong></p>
                        <p>
                            After a car wreck on the winding Mulholland Drive renders a woman amnesiac, she and a perky Hollywood-hopeful search for clues and answers across Los Angeles in a twisting venture beyond dreams and reality.
                        </p>
                    </div>
                </div>
                <div class="similar-movie-expanded movie-6 no-margin hidden">
                    <img src="images/Movies/Lost%20Highway.jpg" alt="Movie poster for Lost Highway">
                    <div class="info-container">
                        <h2>Lost Highway</h2>
                        <p><strong>Drama, Mystery, Thriller</strong></p>
                        <p>
                            After a bizarre encounter at a party, a jazz saxophonist is framed for the murder of his wife and sent to prison, where he inexplicably morphs into a young mechanic and begins leading a new life.
                        </p>
                    </div>
                </div>
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


    <?php endwhile; ?>
<?php else : ?>
    <h2 class="center">Not Found</h2>
    <p class="center">Sorry, but you are looking for
        something that isn't here.</p>
    <?php get_search_form(); ?>
<?php endif; ?>

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