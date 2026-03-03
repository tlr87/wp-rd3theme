<?php
/**
 * Typography Customizer Module
 * Allows H1-H6, P, A, UL, OL, LI customization via WordPress Customizer
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

function rd3_typography_customizer($wp_customize) {

    // -------------------------------
    // Typography Section
    // -------------------------------
    $wp_customize->add_section('rd3_typography', [
        'title'    => __('Typography', 'rd3starter'),
        'priority' => 40,
    ]);

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

        // Line Height (for headings & paragraph)
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

}
add_action('customize_register', 'rd3_typography_customizer');


// -------------------------------
// Output Dynamic CSS
// -------------------------------
function rd3_dynamic_typography_css() {
    $elements = ['h1','h2','h3','h4','h5','h6','p','a','ul','ol','li'];
    echo "<style>";

    foreach($elements as $el) {
        $color   = get_theme_mod("rd3_{$el}_color", ($el==='a'?'#007bff':'#333333'));
        $font    = get_theme_mod("rd3_{$el}_font_size", '');
        $line    = get_theme_mod("rd3_{$el}_line_height", '');
        $margin  = get_theme_mod("rd3_{$el}_margin_bottom", '1rem');

        echo "{$el} { color: {$color};";

        if($font) echo " font-size: {$font};";
        if($line) echo " line-height: {$line};";

        echo " margin-bottom: {$margin}; }";

        // Link hover
        if($el==='a') {
            echo "a:hover, a:focus { opacity: 0.8; }";
        }

        // List padding
        if(in_array($el,['ul','ol'])) {
            echo "{$el} { padding-left: 1.5rem; }";
        }
    }

    echo "</style>";
}
add_action('wp_head', 'rd3_dynamic_typography_css');