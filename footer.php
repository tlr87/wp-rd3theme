</main>

<footer class="site-footer">

    <div class="container">

        <nav>
            <?php wp_nav_menu([
                'theme_location' => 'footer-menu'
            ]); ?>
        </nav>

        <p>
            &copy; <?php echo date('Y'); ?>
            <?php bloginfo('name'); ?>
        </p>

    </div>

</footer>

<?php wp_footer(); ?>
</body>
</html>
