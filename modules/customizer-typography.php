<?php
/**
 * Typography & Main Navigation Customizer Module
 * Allows dynamic customization of H1-H6, P, A, UL, OL, LI, and .main-nav
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

// ================================
// Typography Customizer & Main Navigation Customizer
// ================================

function rd3_typography_and_nav_customizer($wp_customize) {

    // -------------------------------
    // Typography Section
    // -------------------------------
    $wp_customize->add_section('rd3_typography', [
        'title'    => __('Typography', 'rd3starter'),
        'priority' => 40,
    ]);

    // Elements to customize
    $elements = ['h1','h2','h3','h4','h5','h6','p','a','ul','ol','li'];

    foreach($elements as $el) {

        // Color
        $wp_customize->add_setting("rd3_{$el}_color", [
            'default'           => ($el === 'a') ? '#007bff' : '#333333',
            'sanitize_callback' => 'sanitize_hex_color',
        ]);
        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, "rd3_{$el}_color", [
            'label'   => ucfirst($el).' Color',
            'section' => 'rd3_typography',
        ]));

        // Font Size (skip li/ul/ol)
        if(!in_array($el, ['ul','ol','li'])) {
            $wp_customize->add_setting("rd3_{$el}_font_size", [
                'default'           => ($el==='p') ? '1rem' : '2rem',
                'sanitize_callback' => 'sanitize_text_field',
            ]);
            $wp_customize->add_control("rd3_{$el}_font_size", [
                'label'   => ucfirst($el).' Font Size (e.g., 1rem, 16px)',
                'section' => 'rd3_typography',
                'type'    => 'text',
            ]);
        }

        // Line Height (headings + paragraph)
        if(in_array($el, ['h1','h2','h3','h4','h5','h6','p'])) {
            $wp_customize->add_setting("rd3_{$el}_line_height", [
                'default'           => '1.4',
                'sanitize_callback' => 'sanitize_text_field',
            ]);
            $wp_customize->add_control("rd3_{$el}_line_height", [
                'label'   => ucfirst($el).' Line Height (e.g., 1.5)',
                'section' => 'rd3_typography',
                'type'    => 'text',
            ]);
        }

        // Margin Bottom
        $wp_customize->add_setting("rd3_{$el}_margin_bottom", [
            'default'           => '1rem',
            'sanitize_callback' => 'sanitize_text_field',
        ]);
        $wp_customize->add_control("rd3_{$el}_margin_bottom", [
            'label'   => ucfirst($el).' Margin Bottom',
            'section' => 'rd3_typography',
            'type'    => 'text',
        ]);
    }

    // -------------------------------
    // Main Navigation
    // -------------------------------
    $wp_customize->add_setting('rd3_main_nav_color', [
        'default'           => '#333333',
        'sanitize_callback' => 'sanitize_hex_color',
    ]);
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'rd3_main_nav_color', [
        'label'   => __('Main Navigation Color', 'rd3starter'),
        'section' => 'rd3_typography',
    ]));

    // Font size
    $wp_customize->add_setting('rd3_main_nav_font_size', [
        'default'           => '1rem',
        'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control('rd3_main_nav_font_size', [
        'label'   => __('Main Navigation Font Size (e.g., 1rem, 16px)', 'rd3starter'),
        'section' => 'rd3_typography',
        'type'    => 'text',
    ]);

    // Line height
    $wp_customize->add_setting('rd3_main_nav_line_height', [
        'default'           => '1.5',
        'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control('rd3_main_nav_line_height', [
        'label'   => __('Main Navigation Line Height (e.g., 1.5)', 'rd3starter'),
        'section' => 'rd3_typography',
        'type'    => 'text',
    ]);

    // Margin bottom
    $wp_customize->add_setting('rd3_main_nav_margin_bottom', [
        'default'           => '1rem',
        'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control('rd3_main_nav_margin_bottom', [
        'label'   => __('Main Navigation Margin Bottom', 'rd3starter'),
        'section' => 'rd3_typography',
        'type'    => 'text',
    ]);
}
add_action('customize_register', 'rd3_typography_and_nav_customizer');


// ================================
// Output Dynamic CSS
// ================================
function rd3_dynamic_typography_css() {

    $elements = ['h1','h2','h3','h4','h5','h6','p','a','ul','ol','li'];

    echo "<style>";

    // ================================
    // Typography
    // ================================
    foreach($elements as $el) {

        $color   = get_theme_mod("rd3_{$el}_color", ($el==='a' ? '#007bff' : '#333333'));
        $font    = get_theme_mod("rd3_{$el}_font_size", '');
        $line    = get_theme_mod("rd3_{$el}_line_height", '');
        $margin  = get_theme_mod("rd3_{$el}_margin_bottom", '1rem');

        // Headings must override nested links
        if(in_array($el, ['h1','h2','h3','h4','h5','h6'])) {
            echo "{$el}, {$el} a {";
        } else {
            echo "{$el} {";
        }

        echo "color: {$color};";

        if($font) {
            echo " font-size: {$font};";
        }

        if($line) {
            echo " line-height: {$line};";
        }

        echo " margin-bottom: {$margin};";
        echo "}";

        // Standard link hover (not affecting heading links)
        if($el === 'a') {
            echo "a:hover, a:focus { opacity: 0.8; }";
        }

        // Add default list padding
        if(in_array($el, ['ul','ol'])) {
            echo "{$el} { padding-left: 1.5rem; }";
        }
    }

    // ================================
    // Main Navigation
    // ================================
    $nav_selector = '.main-nav, .main-nav a, .main-nav li';

    $nav_color   = get_theme_mod('rd3_main_nav_color', '#333333');
    $nav_font    = get_theme_mod('rd3_main_nav_font_size', '1rem');
    $nav_line    = get_theme_mod('rd3_main_nav_line_height', '1.5');
    $nav_margin  = get_theme_mod('rd3_main_nav_margin_bottom', '1rem');

    echo "{$nav_selector} {
        color: {$nav_color};
        font-size: {$nav_font};
        line-height: {$nav_line};
        margin-bottom: {$nav_margin};
    }";

    echo ".main-nav a {
        color: {$nav_color};
        text-decoration: none;
    }";

    echo ".main-nav a:hover,
          .main-nav a:focus {
        opacity: 0.8;
    }";

    echo "</style>";
}
add_action('wp_head', 'rd3_dynamic_typography_css');