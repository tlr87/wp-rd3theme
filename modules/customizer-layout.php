<?php
/**
 * Customizer - Layout & Custom CSS Section
 */
function rd3_customize_layout( $wp_customize ) {

    // === Section ===
    $wp_customize->add_section( 'rd3_layout_section', array(
        'title'       => esc_html__( 'Layout & Custom CSS', 'rd3starter' ),
        'priority'    => 35,
        'description' => esc_html__( 'Advanced layout options and custom styling. Use with caution.', 'rd3starter' ),
    ) );

    // === Master toggle ===
    $wp_customize->add_setting( 'rd3_layout_enabled', array(
        'default'           => true,
        'sanitize_callback' => 'rd3_sanitize_checkbox',
        'transport'         => 'refresh',
    ) );

    $wp_customize->add_control( 'rd3_layout_enabled', array(
        'type'        => 'checkbox',
        'section'     => 'rd3_layout_section',
        'label'       => esc_html__( 'Enable Layout & Custom CSS Options', 'rd3starter' ),
        'description' => esc_html__( 'Uncheck to hide these controls (useful for child themes or minimal setups).', 'rd3starter' ),
    ) );

    // Helper function to check if section is enabled
    $is_enabled = function() {
        return (bool) get_theme_mod( 'rd3_layout_enabled', true );
    };

    // === Site Layout (Horizontal vs Vertical Header) ===
    $wp_customize->add_setting( 'rd3_site_layout', array(
        'default'           => 'horizontal',
        'sanitize_callback' => 'sanitize_key',
    ) );

    $wp_customize->add_control( 'rd3_site_layout', array(
        'type'            => 'radio',
        'section'         => 'rd3_layout_section',
        'label'           => esc_html__( 'Header Layout', 'rd3starter' ),
        'description'     => esc_html__( 'Choose between traditional top header or sidebar-style vertical header.', 'rd3starter' ),
        'choices'         => array(
            'horizontal' => esc_html__( 'Horizontal Header (top)', 'rd3starter' ),
            'vertical'   => esc_html__( 'Vertical Header (sidebar)', 'rd3starter' ),
        ),
        'active_callback' => $is_enabled,
    ) );

    // === Custom CSS (textarea – most common & recommended) ===
    $wp_customize->add_setting( 'rd3_custom_css', array(
        'default'           => '',
        'sanitize_callback' => 'wp_strip_all_tags',     // or use 'wp_kses_post' if you allow more
        'transport'         => 'postMessage',           // live preview possible
    ) );

    $wp_customize->add_control( 'rd3_custom_css', array(
        'type'            => 'textarea',
        'section'         => 'rd3_layout_section',
        'label'           => esc_html__( 'Custom CSS', 'rd3starter' ),
        'description'     => esc_html__( 'Add custom CSS here. Changes appear live (if postMessage supported). Do NOT wrap in <style> tags.', 'rd3starter' ),
        'input_attrs'     => array(
            'rows'        => 12,
            'placeholder' => "/* Example */\nbody {\n    font-family: 'Georgia', serif;\n}",
        ),
        'active_callback' => $is_enabled,
    ) );

    // === Optional: Custom CSS File Upload (only if you really need it) ===
    /*
    $wp_customize->add_setting( 'rd3_custom_css_file', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ) );

    $wp_customize->add_control( new WP_Customize_Upload_Control( $wp_customize, 'rd3_custom_css_file', array(
        'label'           => esc_html__( 'Upload Custom CSS File', 'rd3starter' ),
        'description'     => esc_html__( 'Rarely needed. Most users should use the textarea above instead.', 'rd3starter' ),
        'section'         => 'rd3_layout_section',
        'active_callback' => $is_enabled,
    ) ) );
    */
}
add_action( 'customize_register', 'rd3_customize_layout' );