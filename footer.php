<?php
/**
 * Footer Template
 * RD3 Client Starter Theme
 */
?>

<footer class="site-footer">

    <div class="container">

        <!-- Footer Menu -->
        <?php if ( get_theme_mod('rd3_show_footer_menu', true) ) : ?>
            <nav class="footer-nav">
                <?php wp_nav_menu([
                    'theme_location' => 'footer-menu',
                    'container'      => false,
                    'fallback_cb'    => false,
                ]); ?>
            </nav>
        <?php endif; ?>


        <!-- Footer Widgets -->
        <div class="footer-widgets">

            <?php if ( is_active_sidebar('footer-col-1') ) : ?>
                <div class="footer-column">
                    <?php dynamic_sidebar('footer-col-1'); ?>
                </div>
            <?php endif; ?>

            <?php if ( is_active_sidebar('footer-col-2') ) : ?>
                <div class="footer-column">
                    <?php dynamic_sidebar('footer-col-2'); ?>
                </div>
            <?php endif; ?>

            <?php if ( is_active_sidebar('footer-col-3') ) : ?>
                <div class="footer-column">
                    <?php dynamic_sidebar('footer-col-3'); ?>
                </div>
            <?php endif; ?>

        </div>


        <!-- Footer Info -->
        <div class="footer-info">
            <p>
                &copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>. All rights reserved.
            </p>
        </div>

    </div>

</footer>

<?php wp_footer(); ?>
</body>
</html>
