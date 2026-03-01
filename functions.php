<?php
/**
 * RD3 Client Starter Theme Functions
 */

// ===============================
// Theme Setup
// ===============================
function rd3_theme_setup()
{
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('html5');

    register_nav_menus([
        'main-menu' => 'Main Menu',
        'footer-menu' => 'Footer Menu',
    ]);
}
add_action('after_setup_theme', 'rd3_theme_setup');

// ===============================
// Load modules
// ===============================

//Module Registry
require get_template_directory() . '/inc/module-registry.php';
require get_template_directory() . '/inc/modules-loader.php';
require get_template_directory() . '/inc/customizer-modules.php';

//Modules
require get_template_directory() . '/modules/assets.php';
require get_template_directory() . '/modules/widgets.php';
require get_template_directory() . '/modules/css-upload.php';
require get_template_directory() . '/modules/customizer-branding.php';
require get_template_directory() . '/modules/customizer-layout.php';
require get_template_directory() . '/modules/maintenance.php'; 
require get_template_directory() . '/modules/breadcrumbs.php';
require get_template_directory() . '/modules/seo.php';

// ===============================
// Sanitize Checkbox
// ===============================
function rd3_sanitize_checkbox($checked)
{
    return (isset($checked) && $checked === true) ? true : false;
}


