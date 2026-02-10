<?php
/**
 * Footer Template
 * RD3 Client Starter Theme
 */
?>

    </main><!-- /.site-main -->

    <footer class="site-footer">

        <div class="container">

            <?php
            // Show footer menu if enabled in Customizer
            if ( get_theme_mod('rd3_show_footer_menu', true) ) :
            ?>

                <nav class="footer-nav">
                    <?php
                    wp_nav_menu([
                        'theme_location' => 'footer-menu',
                        'container'      => false,
                        'fallback_cb'    => false,
                    ]);
                    ?>
                </nav>

            <?php endif; ?>


            <div class="footer-info">

                <p>
                    &copy; <?php echo date('Y'); ?>
                    <?php bloginfo('name'); ?>
                    . All rights reserved.
                </p>

            </div>

        </div>

    </footer>

<?php wp_footer(); ?>
</body>
</html>
