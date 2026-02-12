<?php get_header(); ?>

<?php rd3_breadcrumbs(); ?>

<?php if ( have_posts() ) : ?>

    <?php while ( have_posts() ) : the_post(); ?>

        <article class="post">

            <h2>
                <a href="<?php the_permalink(); ?>">
                    <?php the_title(); ?>
                </a>
            </h2>

            <?php the_excerpt(); ?>

        </article>

    <?php endwhile; ?>

<?php endif; ?>

<?php get_footer(); ?>
