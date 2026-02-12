<?php get_header(); ?>

<p><?php rd3_breadcrumbs(); ?></p>


<?php while ( have_posts() ) : the_post(); ?>

<article class="page">

    <h1><?php the_title(); ?></h1>

    <?php the_content(); ?>

</article>

<?php endwhile; ?>

<?php get_footer(); ?>
