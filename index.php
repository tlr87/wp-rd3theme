<?php get_header(); ?>

<?php if ( have_posts() ) : ?>

    <?php while ( have_posts() ) : the_post(); ?>

        <article>
            <h2><?php the_title(); ?></h2>
            <p><?php the_content(); ?></p>
        </article>

        <hr>

    <?php endwhile; ?>

<?php else : ?>

    <p>No content found.</p>

<?php endif; ?>

<?php get_footer(); ?>
