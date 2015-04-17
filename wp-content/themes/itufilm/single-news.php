<?php get_header(); ?>
<?php get_sidebar(); ?>

    <section id="content" role="main" class="grid_9">
        <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
            <?php get_template_part( 'entry' ); ?>
            <?php if ( ! post_password_required() ) comments_template( '', true ); ?>
        <?php endwhile; endif; ?>
    </section>

<?php get_footer(); ?>