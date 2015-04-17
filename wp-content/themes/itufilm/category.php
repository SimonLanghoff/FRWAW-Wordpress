<?php get_header(); ?>
<?php get_sidebar(); ?>
<section id="content" role="main" class="grid_9">
<header class="header">
<h1 class="entry-title"><?php _e( 'Category Archives: ', 'itufilm' ); ?><?php single_cat_title(); ?></h1>
<?php if ( '' != category_description() ) echo apply_filters( 'archive_meta', '<div class="archive-meta">' . category_description() . '</div>' ); ?>
</header>
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
<?php get_template_part( 'entry' ); ?>
<?php endwhile; endif; ?>
<?php get_template_part( 'nav', 'below' ); ?>
</section>
<?php get_footer(); ?>