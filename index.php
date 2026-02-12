<?php get_header(); ?>

<?php if ( get_theme_mod('rd3_show_breadcrumbs', true) ) : ?>
    <p class="rd3-breadcrumbs"><?php rd3_breadcrumbs(); ?></p>
<?php endif; ?>

<!-- FLEX WRAPPER -->
<div class="content-area">

    <!-- Sidebar -->
    <aside class="sidebar">
        <?php get_sidebar(); ?>
    </aside>

    <!-- Main Posts -->
    <main class="site-main">
        <?php if ( have_posts() ) : ?>
            <?php while ( have_posts() ) : the_post(); ?>
                <article class="post">
                    <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                    <?php the_excerpt(); ?>
                </article>
            <?php endwhile; ?>
        <?php else : ?>
            <p>No posts found.</p>
        <?php endif; ?>
    </main>

</div> <!-- /.content-area -->

<?php get_footer(); ?>
