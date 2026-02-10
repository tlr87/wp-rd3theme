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

    <div class="logo">

        <?php if ( get_theme_mod('rd3_logo') ) : ?>

            <a href="<?php echo home_url(); ?>">
                <img src="<?php echo esc_url(get_theme_mod('rd3_logo')); ?>" alt="Logo">
            </a>

        <?php else : ?>

            <a href="<?php echo home_url(); ?>">
                <?php bloginfo('name'); ?>
            </a>

        <?php endif; ?>

        </div>

        <nav class="main-nav">
            <?php wp_nav_menu([
                'theme_location' => 'main-menu'
            ]); ?>
        </nav>

    </div>

</header>

<main class="site-main">
