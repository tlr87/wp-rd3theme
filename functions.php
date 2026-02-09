<?php

// Load styles
function rd3_load_styles() {
    wp_enqueue_style('rd3-style', get_stylesheet_uri());
}
add_action('wp_enqueue_scripts', 'rd3_load_styles');

// Enable menus
add_theme_support('menus');

// Register menu
register_nav_menus(array(
    'main-menu' => 'Main Menu'
));

// Enable featured images
add_theme_support('post-thumbnails');
