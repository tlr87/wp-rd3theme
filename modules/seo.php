<?php
/**
 * RD3 SEO Module
 * Adds SEO Customizer options and outputs meta tags
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

// ===============================
// Customizer Settings
// ===============================
function rd3_seo_customizer( $wp_customize ) {
    $wp_customize->add_section('rd3_seo', [
        'title' => __('SEO Settings', 'rd3starter'),
        'priority' => 35,
        'description' => 'Set default SEO meta tags and social sharing image.',
    ]);

    // SEO Title
    $wp_customize->add_setting('rd3_seo_title', [
        'default' => get_bloginfo('name'),
        'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control('rd3_seo_title', [
        'label' => __('SEO Title', 'rd3starter'),
        'section' => 'rd3_seo',
        'type' => 'text',
    ]);

    // SEO Description
    $wp_customize->add_setting('rd3_seo_description', [
        'default' => get_bloginfo('description'),
        'sanitize_callback' => 'sanitize_textarea_field',
    ]);
    $wp_customize->add_control('rd3_seo_description', [
        'label' => __('SEO Description', 'rd3starter'),
        'section' => 'rd3_seo',
        'type' => 'textarea',
    ]);

    // SEO Social Image
    $wp_customize->add_setting('rd3_seo_image', [
        'default' => '',
        'sanitize_callback' => 'esc_url_raw',
    ]);
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'rd3_seo_image', [
        'label' => __('Social Sharing Image', 'rd3starter'),
        'section' => 'rd3_seo',
        'settings' => 'rd3_seo_image',
    ]));
}
add_action('customize_register', 'rd3_seo_customizer');


// ===============================
// Output SEO Meta Tags
// ===============================
function rd3_seo_headers() {
    $title = get_theme_mod('rd3_seo_title', get_bloginfo('name'));
    $description = get_theme_mod('rd3_seo_description', get_bloginfo('description'));
    $image = get_theme_mod('rd3_seo_image', '');

    // Current URL
    $url = esc_url( home_url( add_query_arg( null, null ) ) );

    ?>
    <!-- RD3 SEO Meta Tags -->
    <meta name="description" content="<?php echo esc_attr($description); ?>">
    <meta property="og:title" content="<?php echo esc_attr($title); ?>">
    <meta property="og:description" content="<?php echo esc_attr($description); ?>">
    <meta property="og:url" content="<?php echo $url; ?>">
    <?php if ($image): ?>
        <meta property="og:image" content="<?php echo esc_url($image); ?>">
        <meta name="twitter:card" content="summary_large_image">
    <?php else: ?>
        <meta name="twitter:card" content="summary">
    <?php endif; ?>
    <?php
}
add_action('wp_head', 'rd3_seo_headers');