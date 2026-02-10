<?php
/**
 * RD3 Client Starter Theme Functions
 */

// ===============================
// Theme Setup
// ===============================
function rd3_theme_setup() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('html5');

    register_nav_menus([
        'main-menu'   => 'Main Menu',
        'footer-menu' => 'Footer Menu',
    ]);
}
add_action('after_setup_theme', 'rd3_theme_setup');

// ===============================
// Load Assets
// ===============================
function rd3_assets() {
    wp_enqueue_style('rd3-main', get_template_directory_uri() . '/assets/css/main.css', [], '1.0');
    wp_enqueue_script('rd3-js', get_template_directory_uri() . '/assets/js/main.js', [], '1.0', true);
}
add_action('wp_enqueue_scripts', 'rd3_assets');

// ===============================
// Widgets
// ===============================
function rd3_widgets() {
    register_sidebar([
        'name' => 'Sidebar',
        'id'   => 'main-sidebar',
    ]);
}
add_action('widgets_init', 'rd3_widgets');

// ===============================
// Customizer Settings
// ===============================
function rd3_branding_customizer($wp_customize) {

    /* ======================
       Branding Section
    ====================== */
    $wp_customize->add_section('rd3_branding', [
        'title'    => __('Branding Settings', 'rd3starter'),
        'priority' => 30,
    ]);

    // Logo
    $wp_customize->add_setting('rd3_logo');
    $wp_customize->add_control(new WP_Customize_Image_Control(
        $wp_customize,
        'rd3_logo',
        [
            'label'    => __('Site Logo', 'rd3starter'),
            'section'  => 'rd3_branding',
            'settings' => 'rd3_logo',
        ]
    ));

    // Logo Alignment
    $wp_customize->add_setting('rd3_logo_alignment', ['default' => 'left']);
    $wp_customize->add_control('rd3_logo_alignment', [
        'label'   => __('Logo Alignment', 'rd3starter'),
        'section' => 'rd3_branding',
        'type'    => 'radio',
        'choices' => [
            'left'   => 'Left',
            'center' => 'Center',
            'right'  => 'Right',
        ],
    ]);

    // Primary Colour
    $wp_customize->add_setting('rd3_primary_color', ['default' => '#000000']);
    $wp_customize->add_control(new WP_Customize_Color_Control(
        $wp_customize,
        'rd3_primary_color',
        [
            'label'   => __('Primary Colour', 'rd3starter'),
            'section' => 'rd3_branding',
        ]
    ));

    // Secondary Colour
    $wp_customize->add_setting('rd3_secondary_color', ['default' => '#666666']);
    $wp_customize->add_control(new WP_Customize_Color_Control(
        $wp_customize,
        'rd3_secondary_color',
        [
            'label'   => __('Secondary Colour', 'rd3starter'),
            'section' => 'rd3_branding',
        ]
    ));

    // Font Family
    $wp_customize->add_setting('rd3_font_family', ['default' => 'system']);
    $wp_customize->add_control('rd3_font_family', [
        'label'   => __('Font Family', 'rd3starter'),
        'section' => 'rd3_branding',
        'type'    => 'select',
        'choices' => [
            'system'  => 'System Default',
            'arial'   => 'Arial',
            'roboto'  => 'Roboto',
            'poppins' => 'Poppins',
            'lato'    => 'Lato',
        ],
    ]);

    /* ======================
       Footer Menu Toggle
    ====================== */
    $wp_customize->add_setting('rd3_show_footer_menu', ['default' => true]);
    $wp_customize->add_control('rd3_show_footer_menu', [
        'label'   => __('Display Footer Menu', 'rd3starter'),
        'section' => 'nav_menus',
        'type'    => 'checkbox',
    ]);

    /* ======================
       Homepage Layout
    ====================== */
    $wp_customize->add_setting('rd3_homepage_layout', ['default' => 'posts']);
    $wp_customize->add_control('rd3_homepage_layout', [
        'label'   => __('Homepage Layout', 'rd3starter'),
        'section' => 'rd3_branding',
        'type'    => 'radio',
        'choices' => [
            'posts' => 'Show Latest Posts',
            'page'  => 'Show Full Page',
        ],
    ]);

    $wp_customize->add_setting('rd3_homepage_page', ['default' => 0]);
    $wp_customize->add_control('rd3_homepage_page', [
        'label'           => __('Select Full Page for Homepage', 'rd3starter'),
        'section'         => 'rd3_branding',
        'type'            => 'dropdown-pages',
        'active_callback' => function() { 
            return get_theme_mod('rd3_homepage_layout', 'posts') === 'page';
        },
    ]);

}
add_action('customize_register', 'rd3_branding_customizer');

// ===============================
// Output Custom Styles
// ===============================
function rd3_branding_styles() {
    $primary   = get_theme_mod('rd3_primary_color', '#000000');
    $secondary = get_theme_mod('rd3_secondary_color', '#666666');
    $font      = get_theme_mod('rd3_font_family', 'system');
    $logo_align = get_theme_mod('rd3_logo_alignment', 'left');

    $fonts = [
        'system'  => 'system-ui, sans-serif',
        'arial'   => 'Arial, sans-serif',
        'roboto'  => 'Roboto, sans-serif',
        'poppins' => 'Poppins',
        'lato'    => 'Lato',
    ];

    $font_family = $fonts[$font] ?? $fonts['system'];

    // Logo container alignment
    $align_css = 'flex-start';
    if ($logo_align === 'center') $align_css = 'center';
    if ($logo_align === 'right') $align_css = 'flex-end';
    ?>

    <style>
        body {
            font-family: <?php echo $font_family; ?>;
        }

        a {
            color: <?php echo $primary; ?>;
        }

        .site-header,
        .site-footer {
            background: <?php echo $secondary; ?>;
        }

        /* Logo alignment */
        .site-header .container {
            display: flex;
            flex-direction: column;
            align-items: <?php echo $align_css; ?>;
        }

        .site-header .logo {
            text-align: <?php echo $logo_align; ?>;
        }
    </style>

    <?php
}
add_action('wp_head', 'rd3_branding_styles');
