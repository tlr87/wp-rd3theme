<?php
/**
 * Footer Template
 */
?>

<footer class="site-footer">

    <div class="container">

        <!-- Footer Menu -->
        <?php if(get_theme_mod('rd3_show_footer_menu',true)):?>
            <nav class="footer-nav">
                <?php wp_nav_menu(['theme_location'=>'footer-menu','container'=>false,'fallback_cb'=>false]);?>
            </nav>
        <?php endif;?>

        <!-- Footer Widgets -->
        <div class="footer-widgets">
            <?php for($i=1;$i<=3;$i++):
                if(is_active_sidebar("footer-col-$i")):?>
                    <div class="footer-column"><?php dynamic_sidebar("footer-col-$i");?></div>
            <?php endif; endfor;?>
        </div>

        <!-- Footer Info -->
        <div class="footer-info">
            <p>&copy; <?php echo date('Y');?> <?php bloginfo('name');?>. All rights reserved.</p>
        </div>

    </div>

</footer>

<?php wp_footer();?>
</body>
</html>
