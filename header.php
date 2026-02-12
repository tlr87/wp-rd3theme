<?php 
/**
 * Header Template
 */
?><!DOCTYPE html>
<html <?php language_attributes();?>>
<head>
<meta charset="<?php bloginfo('charset');?>">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<?php wp_head();?>
</head>
<body <?php body_class();?>>

<header class="site-header">
    <div class="container">

    
   <!-- Logo -->
        <div class="logo <?php echo esc_attr($logo_align_class); ?>">
            <?php if(get_theme_mod('rd3_logo')): ?>
                <a href="<?php echo esc_url(home_url('/')); ?>">
                    <img src="<?php echo esc_url(get_theme_mod('rd3_logo')); ?>" alt="<?php bloginfo('name'); ?>">
                </a>

                <?php if ( get_theme_mod('rd3_show_site_title', true) ): ?>
                    <h1><?php bloginfo('name'); ?></h1>
                <?php endif; ?>

                <?php if ( get_theme_mod('rd3_show_site_desc', true) ): ?>
                    <p><?php bloginfo('description'); ?></p>
                <?php endif; ?>

            <?php else: ?>
                <h1><a href="<?php echo esc_url(home_url('/')); ?>"><?php bloginfo('name'); ?></a></h1>
            <?php endif; ?>
        </div>

        <!-- Desktop Menu -->
        <nav class="main-nav desktop">
            <?php
            wp_nav_menu([
                'theme_location' => 'main-menu',
                'container' => false,
                'menu_class' => 'main-menu'
            ]);
            ?>
        </nav>

        <!-- Mobile Hamburger -->
        <button id="menu-toggle" class="menu-toggle" aria-controls="mobile-menu" aria-expanded="false" onclick="toggleMenu()">
            <span class="hamburger"></span>
            <span class="hamburger"></span>
            <span class="hamburger"></span>
            <span class="screen-reader-text"><?php _e('Toggle Menu', 'davis'); ?></span>
        </button>
    </div>

    <!-- Mobile Slide-In Menu -->
    <nav id="mobile-menu" class="mobile-nav">
        <?php
        wp_nav_menu([
            'theme_location' => 'main-menu',
            'container' => false,
            'menu_class' => 'main-menu'
        ]);
        ?>
    </nav>
</header>

<script>
// Toggle mobile menu
function toggleMenu() {
    const body = document.body;
    const toggle = document.getElementById('menu-toggle');
    body.classList.toggle('menu-open');

    const expanded = toggle.getAttribute('aria-expanded') === 'true';
    toggle.setAttribute('aria-expanded', !expanded);
}

// Auto-close mobile menu
document.querySelectorAll('#mobile-menu a').forEach(link => {
    link.addEventListener('click', () => {
        if(document.body.classList.contains('menu-open')) toggleMenu();
    });
});
</script>