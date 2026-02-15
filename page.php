
<div class="Main-container">
<?php get_header(); ?>

<p><?php if ( get_theme_mod('rd3_show_breadcrumbs', true) ) : ?>

<?php endif; ?></p>


<?php while ( have_posts() ) : the_post(); ?>

<article class="page">
    <?php rd3_breadcrumbs(); ?>
    <h1><?php the_title(); ?></h1>

    <?php the_content(); ?>

</article>

<?php endwhile; ?>

<?php get_footer(); ?>
</div>