<?php get_header(); ?>
<?php get_sidebar(); ?>

    <div id="content" class="grid_9" role="main">
        <div class="news-item-main">
            <article>
                <img src="images/Event%20Poster%20Her.jpg" width="600">
                <div class="news-item-main-backdrop">
                    <div class="event-headline">
                        <h1>
                            ITU.film presents "Her"
                        </h1>
                        <h1 class="visible-mobile">
                            27th Feb, 16:00, AUD 1
                        </h1>
                    </div>
                    <p>
                        ITU.Film is excited to invite you all to join us for our first screening
                        in Auditorium 1. We will be rolling out the red carpet and showing
                        you the film, Her, on the big screen!
                    </p>
                </div>
            </article>
            <hr class="visible-mobile">
        </div>
        <div class="news-item">
            <article>
                <div class="article-headline-container">
                    <h2 class=" article-headline">
                        Announcing introductory speaker this Friday
                    </h2>
                    <h4 class="text-left no-margin"> Written by ITU.film </h4>
                    <h4 class="text-right no-margin"> 25. feb. 2015 </h4>
                </div>
                <div class="news-item-images">
                    <figure>
                        <img src="images/AI.jpeg">
                    </figure>
                    <!-- I decided to only include facebook integration since that is the only social site that ITU.film uses right now anyways.-->
                    <figure>
                        <div class="fb-like" data-href="https://www.facebook.com/itu.film" data-layout="button" data-action="like" data-show-faces="false" data-share="true"></div>
                    </figure>
                </div>
                <p>
                    We’re very happy to announce that ITU’s own Judith Simon will introduce the screening of Her this Friday with a short talk on AI.
                    Judith does research on Philosophy of Science and Computer ethics among other subjects.
                    We hope that this will encourage you to look closer at the interesting views and issues with AI shown in the film.
                </p>
                <p>
                    And of course, we in the ITU.Film crew are all looking very much forward to seeing you all at the screening this Friday!
                </p>
            </article>
            <hr/>
        </div>
        <div class="news-item">
            <article>

                <div class="article-headline-container">
                    <h2 class="article-headline">
                        The Perks of being a Wallflower screening
                    </h2>
                    <h4 class="text-left no-margin"> Written by ITU.film </h4>
                    <h4 class="text-right no-margin"> 9. feb. 2015 </h4>
                </div>
                <div class="news-item-images">
                    <figure>
                        <img src="images/Perks-of-Being-a-Wallflower-The-poster.jpg">
                    </figure>
                    <figure>
                        <!-- Facebook Share Button -->
                        <div class="fb-like" data-href="https://www.facebook.com/itu.film" data-layout="button" data-action="like" data-show-faces="false" data-share="true"></div>
                    </figure>
                </div>
                <p>
                    Join us in watching the everyday life of Charlie, an introvert freshman trying to fit in with help from seniors Sam (Emma Watson) and Patrick (Ezra Miller).
                    Charlie is a freshman, struggling to find a place in high school.
                    However, his life is forever changed after meeting the amazing Sam (played by Emma Watson) and the eccentric Patrick (played by Ezra Miller),
                    joining them and their friends in what is going to be one heck of a year.
                </p>
            </article>
            <hr/>
        </div>
    </div>


<!---->
<!---->
<!--<section id="content" role="main">-->
<?php //if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
<!--<article id="post---><?php //the_ID(); ?><!--" --><?php //post_class(); ?><!--> <!-->
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