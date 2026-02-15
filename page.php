
<div class="Main-container">
<?php get_header(); ?>



<?php while ( have_posts() ) : the_post(); ?>

<article class="page">
   <p><?php if ( get_theme_mod('rd3_show_breadcrumbs', true) ) : ?>
        <?php rd3_breadcrumbs(); ?>
    <?php endif; ?></p>

    <h1><?php the_title(); ?></h1>

    <?php the_content(); ?>

</article>

<?php endwhile; ?>

<?php get_footer(); ?>
</div>