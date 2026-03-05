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
// Load required modules
// ===============================

require get_template_directory() . '/modules/breadcrumbs.php';

// ===============================
// Load optional modules
// ===============================
require get_template_directory() . '/modules/assets.php';
require get_template_directory() . '/modules/widgets.php';
require get_template_directory() . '/modules/css-upload.php';
require get_template_directory() . '/modules/customizer-branding.php';
require get_template_directory() . '/modules/customizer-typography.php';
require get_template_directory() . '/modules/customizer-layout.php';
require get_template_directory() . '/modules/maintenance.php'; 
require get_template_directory() . '/modules/seo.php';

// ===============================
// Sanitize Checkbox
// ===============================
function rd3_sanitize_checkbox($checked)
{
    return (isset($checked) && $checked === true) ? true : false;
}

// ===============================
// Sanitize Hex to RGB
// ===============================
function hex_to_rgba($hex, $alpha = 1) {
    $hex = str_replace('#', '', $hex);
    if (strlen($hex) === 3) {
        $r = hexdec(str_repeat($hex[0], 2));
        $g = hexdec(str_repeat($hex[1], 2));
        $b = hexdec(str_repeat($hex[2], 2));
    } elseif (strlen($hex) === 6) {
        $r = hexdec(substr($hex, 0, 2));
        $g = hexdec(substr($hex, 2, 2));
        $b = hexdec(substr($hex, 4, 2));
    } else {
        return "rgba(0,0,0,$alpha)";
    }
    return "rgba($r,$g,$b,$alpha)";
}


// ===============================
// Fallback CSS loader
// Ensures main.css + layout-horizontal.css load if assets.php is missing
// ===============================

if ( ! defined( 'RD3_ASSETS_LOADED' ) ) {

    function rd3_fallback_assets() {
        $theme_version = wp_get_theme()->get( 'Version' ) ?: '1.0.0';

        // Always load main.css
        wp_enqueue_style(
            'rd3-main',
            get_template_directory_uri() . '/assets/css/main.css',
            array(),
            $theme_version
        );

        // Fallback: always horizontal layout
        wp_enqueue_style(
            'rd3-layout-horizontal',
            get_template_directory_uri() . '/assets/css/layout-horizontal.css',
            array( 'rd3-main' ),
            $theme_version
        );
    }
    add_action( 'wp_enqueue_scripts', 'rd3_fallback_assets', 5 ); // run early
}