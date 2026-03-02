<div class="Main-container">

    <?php 
    // Load the site header (header.php)
    get_header(); 
    ?>

    <?php 
    // Optional breadcrumb visibility toggle from Customizer
    // Currently just acts as a feature flag
    if ( get_theme_mod('rd3_show_breadcrumbs', true) ) : 
    ?>
        <!-- Breadcrumbs enabled -->
    <?php endif; ?>

    <div class="content-area"
         style="flex-direction: <?php 
            // Allow sidebar left/right positioning via Customizer
            echo get_theme_mod('rd3_sidebar_position','left') === 'left'
                ? 'row'
                : 'row-reverse';
         ?>;">

        <?php 
        // Load sidebar.php
        get_sidebar(); 
        ?>

        <main class="site-main">

            <?php 
            // Output theme breadcrumb function
            // (custom function defined in theme)
            rd3_breadcrumbs(); 
            ?>

            <?php if ( have_posts() ) : ?>
                <?php 
                // Start WordPress Loop
                // Retrieves posts based on current query
                while ( have_posts() ) : the_post(); 
                ?>

                    <article <?php post_class('post'); ?>>
                        
                        <!-- Post Title -->
                        <h2 class="post-title">
                            <a href="<?php the_permalink(); ?>">
                                <?php the_title(); ?>
                            </a>
                        </h2>

                        <!-- Post Excerpt -->
                        <div class="post-excerpt">
                            <?php the_excerpt(); ?>
                        </div>

                    </article>

                <?php endwhile; ?>
                <!-- End Loop -->

                <!-- =========================
                     Pagination Navigation
                     =========================
                     Automatically creates:
                     ← Previous | page numbers | Next →
                     Works for:
                     - blog index
                     - archives
                     - categories
                     - search results
                -->
                <div class="pagination">
                    <?php
                    the_posts_pagination([
                        'mid_size'  => 1, // pages shown around current page
                        'prev_text' => __('← Previous', 'rd3starter'),
                        'next_text' => __('Next →', 'rd3starter'),
                        'screen_reader_text' => __('Posts navigation', 'rd3starter'),
                    ]);
                    ?>
                </div>

            <?php else : ?>

                <!-- No posts fallback -->
                <p><?php _e('No posts found.', 'rd3starter'); ?></p>

            <?php endif; ?>

        </main>

    </div>

    <?php 
    // Load footer.php
    get_footer(); 
    ?>

</div>