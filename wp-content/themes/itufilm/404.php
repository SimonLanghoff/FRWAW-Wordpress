<?php get_header(); ?>
<?php get_sidebar(); ?>
<section id="content" role="main">
<article id="post-0" class="post not-found">
<header class="header">
<h1 class="entry-title"><?php _e( 'Not Found', 'itufilm' ); ?></h1>
</header>
<section class="entry-content">
<p><?php _e( 'Nothing found for the requested page. Try a search instead?', 'itufilm' ); ?></p>
<?php get_search_form(); ?>
</section>
</article>
</section>
<?php get_footer(); ?>