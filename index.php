<?php get_header(); ?>

<?php
$layout = get_theme_mod('rd3_homepage_layout', 'posts');

if ($layout === 'page') :

    $page_id = get_theme_mod('rd3_homepage_page', 0);

    if ($page_id && get_post($page_id)) :
        $page = get_post($page_id);
        setup_postdata($page);
        ?>

        <article class="full-page">
            <h1><?php echo get_the_title($page); ?></h1>
            <div class="content">
                <?php echo apply_filters('the_content', $page->post_content); ?>
            </div>
        </article>

        <?php
        wp_reset_postdata();
    else :
        echo '<p>No page selected for homepage.</p>';
    endif;

else :

    // Default: Show latest posts
    if ( have_posts() ) :
        while ( have_posts() ) : the_post(); ?>
            <article class="post">
                <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                <?php the_excerpt(); ?>
            </article>
            <hr>
        <?php endwhile;
    else :
        echo '<p>No posts found.</p>';
    endif;

endif;
?>

<?php get_footer(); ?>