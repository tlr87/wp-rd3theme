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
        <div class="logo">
            <?php if(get_theme_mod('rd3_logo')):?>
                <a href="<?php echo esc_url(home_url('/'));?>">
                    <img src="<?php echo esc_url(get_theme_mod('rd3_logo'));?>" alt="<?php bloginfo('name');?>">
                </a>
            <?php else:?>
                <h1><a href="<?php echo esc_url(home_url('/'));?>"><?php bloginfo('name');?></a></h1>
            <?php endif;?>
        </div>

        <!-- Main Navigation -->
        <nav class="main-nav">
            <?php wp_nav_menu(['theme_location'=>'main-menu','container'=>false,'menu_class'=>'main-menu']);?>
        </nav>

    </div>

</header>
