<?php get_header(); ?>

<p><?php if ( get_theme_mod('rd3_show_breadcrumbs', true) ) : ?>
    <?php rd3_breadcrumbs(); ?>
<?php endif; ?></p>

<?php while ( have_posts() ) : the_post(); ?>

<article class="single-post">

    <h1><?php the_title(); ?></h1>

    <?php the_content(); ?>

</article>

<?php endwhile; ?>

<?php get_footer(); ?>
