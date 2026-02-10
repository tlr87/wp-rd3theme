<?php
/**
 * Header Template
 * RD3 Client Starter Theme
 */
?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>

<meta charset="<?php bloginfo('charset'); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">

<?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>

<header class="site-header">

    <div class="container">

        <!-- Logo Area -->
        <div class="logo">

            <?php if ( get_theme_mod('rd3_logo') ) : ?>

                <a href="<?php echo esc_url( home_url('/') ); ?>">
                    <img 
                        src="<?php echo esc_url( get_theme_mod('rd3_logo') ); ?>" 
                        alt="<?php bloginfo('name'); ?>"
                    >
                </a>

            <?php else : ?>

                <a href="<?php echo esc_url( home_url('/') ); ?>" class="site-title">
                    <?php bloginfo('name'); ?>
                </a>

            <?php endif; ?>

        </div>


        <!-- Navigation -->
        <nav class="main-nav">

            <?php
            wp_nav_menu([
                'theme_location' => 'main-menu',
                'container'      => false,
                'fallback_cb'    => false,
                'menu_class'     => 'main-menu',
            ]);
            ?>

        </nav>

    </div>

</header>


<main class="site-main">
