<?php

// Theme Setup
function rd3_theme_setup() {

    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('html5');

    register_nav_menus([
        'main-menu'   => 'Main Menu',
        'footer-menu' => 'Footer Menu'
    ]);

}
add_action('after_setup_theme', 'rd3_theme_setup');


// Load Assets
function rd3_assets() {

    wp_enqueue_style(
        'rd3-main',
        get_template_directory_uri() . '/assets/css/main.css',
        [],
        '1.0'
    );

    wp_enqueue_script(
        'rd3-js',
        get_template_directory_uri() . '/assets/js/main.js',
        [],
        '1.0',
        true
    );

}
add_action('wp_enqueue_scripts', 'rd3_assets');


// Widget Areas
function rd3_widgets() {

    register_sidebar([
        'name' => 'Sidebar',
        'id'   => 'main-sidebar'
    ]);

}
add_action('widgets_init', 'rd3_widgets');
