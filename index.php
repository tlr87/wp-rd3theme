<?php get_header(); ?>

<?php if ( get_theme_mod('rd3_show_breadcrumbs', true) ) : ?>
    <?php rd3_breadcrumbs(); ?>
<?php endif; ?>

<div class="content-area" style="flex-direction: <?php echo get_theme_mod('rd3_sidebar_position','left') === 'left'?'row':'row-reverse'; ?>;">
    <?php get_sidebar(); ?>

    <main class="site-main">
        <?php if ( have_posts() ) : ?>
            <?php while ( have_posts() ) : the_post(); ?>
                <article class="post">
                    <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                    <?php the_excerpt(); ?>
                </article>
            <?php endwhile; ?>
        <?php else: ?>
            <p><?php _e('No posts found.', 'rd3starter'); ?></p>
        <?php endif; ?>
    </main>
</div>

<?php get_footer(); ?>
