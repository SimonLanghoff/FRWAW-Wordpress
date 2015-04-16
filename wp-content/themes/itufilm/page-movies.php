<?php get_header(); ?>
<?php get_sidebar(); ?>

    <div id="content" class="grid_9">
    <h1>ITU.film's Movie Database</h1>

    <!-- Image loaded in css -->
    <div class="search-box">
        <input class="visible-desktop" type="text">
        <!-- Example search input for mobile version -->
        <input class="visible-mobile" type="text" placeholder="Bittersweet, touching, gloomy">
    </div>

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
                            

            ?>


            <article class="comment row-even">
                <div class="comment-picture">
                    <img src="images/profile_dummy.jpg">
                </div>
                <div class="comment-text">
                    <h4>Simon Langhoff recommended <a href="#">Terminator</a></h4>
                    <span class="date">23 feb. 2015</span>
                    <p>
                        'The Terminator' is not a perfect picture. The movie lags in some parts,
                        and the romance element is fairly contrived. Despite all that the movie brims with
                        energy and promise, a script that mostly delivers, characters you can enjoy,
                        and the ultimate Arnie role.
                        <br>
                        Well worth catching. 8/10.
                    </p>
                </div>
            </article>
            <article class="comment">
                <div class="comment-picture">
                    <img src="images/profile_dummy.jpg">
                </div>
                <div class="comment-text">
                    <h4>Simon Langhoff recommended <a href="#">Terminator</a></h4>
                    <span class="date">20 feb. 2015</span>
                    <p>
                        'Her' is a complex film with a much deeper meaning that lies beneath the surface.
                        A beautifully crafted motion picture, this quirky love story is sure to resonate with
                        you once you've seen it. It is an extremely interesting (and realistic) look at the future
                        - Jonze's quaint and poignant film is a must-see! 9/10
                    </p>
                </div>
            </article>
            <article class="comment row-even">
                <div class="comment-picture">
                    <img src="images/profile_dummy.jpg">
                </div>
                <div class="comment-text">
                    <h4>Billy Joel recommended <a href="#">The Room</a></h4>
                    <span class="date">19 feb. 2015</span>
                    <p>
                        This film is completely worth seeing.
                        A friend of mine recently said it was as if a deer made a movie about human interaction,
                        unable to comprehend what it is to be a human being. It is hilarious.
                    </p>
                </div>
            </article>
        </div>
        <a href="#">More recommendations...</a>
    </div>


    <div class="list-wrapper container_9">
        <div class="movie-list">
            <h2>Latest Movies</h2>
            <ul class="no-margin">
                <li>
                    <a href="#">Her</a>
                </li>
                <li>
                    <a href="#">The Perks of Being a Wallflower</a>
                </li>
                <li>
                    <a href="#">Searching for Sugar Man</a>
                </li>
                <li>
                    <a href="movie.html">Twin Peaks</a>
                </li>
                <li>
                    <a href="#">Terminator</a>
                </li>
                <li>
                    <a href="#">The Room</a>
                </li>
            </ul>
            <a href="#">More Movies...</a>
        </div>
        <div class="event-wrapper">
            <div class="event-list">
                <h2>Screening Events</h2>
                <ul class="no-margin">
                    <li>
                        <a href="#">Game of Thrones Premiere</a>
                    </li>
                    <li>
                        <a href="#">Her</a>
                    </li>
                    <li>
                        <a href="#">The Perks of Being a Wallflower</a>
                    </li>
                    <li>
                        <a href="#">Searching for Sugar Man</a>
                    </li>
                    <li>
                        <a href="#">Twin Peaks Season 2 Episode 2</a>
                    </li>
                    <li>
                        <a href="#">Twin Peaks Season 2 Episode Start</a>
                    </li>
                </ul>
            </div>
            <div class="event-dates">
                <ul class="no-margin">
                    <li>
                        4th Mar
                    </li>
                    <li>
                        27th Feb
                    </li>
                    <li>
                        13th Feb
                    </li>
                    <li>
                        6th Feb
                    </li>
                    <li>
                        30th Oct
                    </li>
                    <li>
                        23rd Oct
                    </li>
                </ul>
            </div>
            <a href="#">More Events...</a>
        </div>
    </div>

<!---->
<!--<section id="content" role="main">-->
<?php //if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
<!--<article id="post---><?php //the_ID(); ?><!--" --><?php //post_class(); ?>
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
<?php get_footer(); ?>