<?php
/**
 * Enqueue theme styles and scripts
 * Handles conditional layout CSS + custom CSS
 *
 * @package rd3starter
 */

// assets.php check
if ( ! defined( 'RD3_ASSETS_LOADED' ) ) {
    define( 'RD3_ASSETS_LOADED', true );
}

function rd3_enqueue_assets(): void {

    $theme_version = wp_get_theme()->get( 'Version' ) ?: '1.0.0';

    // ── Main stylesheet (always loaded first)
    wp_enqueue_style(
        'rd3-main',
        get_template_directory_uri() . '/assets/css/main.css',
        array(),
        $theme_version
    );

    // ── Layout-specific CSS (horizontal or vertical)
    $layout = get_theme_mod( 'rd3_site_layout', 'horizontal' );

    if ( 'vertical' === $layout ) {
        wp_enqueue_style(
            'rd3-layout-vertical',
            get_template_directory_uri() . '/assets/css/layout-vertical.css',
            array( 'rd3-main' ),           // depends on main.css
            $theme_version
        );
    } else {
        wp_enqueue_style(
            'rd3-layout-horizontal',
            get_template_directory_uri() . '/assets/css/layout-horizontal.css',
            array( 'rd3-main' ),
            $theme_version
        );
    }

    // ── Custom CSS (only if a valid URL exists)
    // Note: renamed setting to match common naming pattern
    $custom_css_url = get_theme_mod( 'rd3_custom_css_file', '' );  // ← adjust name if different

    if ( ! empty( $custom_css_url ) && filter_var( $custom_css_url, FILTER_VALIDATE_URL ) ) {
        wp_enqueue_style(
            'rd3-custom-css',
            esc_url_raw( $custom_css_url ),
            array( 'rd3-main' ),           // load after main + layout
            null                           // no version – external file
        );
    }

    // ── Main JavaScript (in footer)
    wp_enqueue_script(
        'rd3-main-js',
        get_template_directory_uri() . '/assets/js/main.js',
        array(),                       // add dependencies if needed (jquery, etc.)
        $theme_version,
        true                           // in footer
    );

    // Optional: pass PHP values to JS (if your main.js needs them)
    /*
    wp_localize_script( 'rd3-main-js', 'rd3ThemeVars', array(
        'ajaxurl'     => admin_url( 'admin-ajax.php' ),
        'nonce'       => wp_create_nonce( 'rd3_nonce' ),
        'layout'      => $layout,
        'is_rtl'      => is_rtl() ? 'true' : 'false',
    ) );
    */
}
add_action( 'wp_enqueue_scripts', 'rd3_enqueue_assets', 10 );

