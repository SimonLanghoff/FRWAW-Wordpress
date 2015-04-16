<?php get_header(); ?>
<?php get_sidebar(); ?>

SINGLE PAGE

<section id="content" role="main" class="grid_9">
    THIS IS THE SINGLE PAGE
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
<?php get_template_part( 'entry' ); ?>
<?php if ( ! post_password_required() ) comments_template( '', true ); ?>
<?php endwhile; endif; ?>
</section>

<?php get_footer(); ?>