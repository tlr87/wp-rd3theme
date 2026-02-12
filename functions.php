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
// Load Assets
// ===============================
function rd3_assets()
{
    wp_enqueue_style('rd3-main', get_template_directory_uri() . '/assets/css/main.css', [], '1.0');
    wp_enqueue_script('rd3-js', get_template_directory_uri() . '/assets/js/main.js', [], '1.0', true);
}
add_action('wp_enqueue_scripts', 'rd3_assets');

// ===============================
// Widgets
// ===============================
function rd3_widgets()
{
    // Sidebar
    register_sidebar(['name' => 'Sidebar', 'id' => 'main-sidebar']);

    // Footer Columns
    for ($i = 1; $i <= 3; $i++) {
        register_sidebar([
            'name' => "Footer Column $i",
            'id' => "footer-col-$i",
            'before_widget' => '<div class="footer-widget">',
            'after_widget' => '</div>',
            'before_title' => '<h4 class="footer-widget-title">',
            'after_title' => '</h4>',
        ]);
    }
}
add_action('widgets_init', 'rd3_widgets');

// ===============================
// Customizer Settings
// ===============================
function rd3_branding_customizer($wp_customize)
{
    $wp_customize->add_section('rd3_branding', [
        'title' => __('Branding Settings', 'rd3starter'),
        'priority' => 30,
    ]);

    // Site Logo
    $wp_customize->add_setting('rd3_logo');
    $wp_customize->add_control(new WP_Customize_Image_Control(
        $wp_customize,
        'rd3_logo',
        ['label' => 'Site Logo', 'section' => 'rd3_branding', 'settings' => 'rd3_logo']
    ));

    // Logo Alignment
    $wp_customize->add_setting('rd3_logo_alignment', ['default' => 'left']);
    $wp_customize->add_control('rd3_logo_alignment', [
        'label' => 'Logo Alignment',
        'section' => 'rd3_branding',
        'type' => 'radio',
        'choices' => ['left' => 'Left', 'center' => 'Center', 'right' => 'Right']
    ]);

    // Display Site Title
    $wp_customize->add_setting('rd3_show_site_title', ['default' => true, 'sanitize_callback' => 'wp_validate_boolean']);
    $wp_customize->add_control('rd3_show_site_title_control', [
        'label' => __('Display Site Title', 'rd3starter'),
        'section' => 'rd3_branding',
        'type' => 'checkbox',
        'settings' => 'rd3_show_site_title',
    ]);

    // Display Site Description / Tagline
    $wp_customize->add_setting('rd3_show_site_desc', ['default' => true, 'sanitize_callback' => 'wp_validate_boolean']);
    $wp_customize->add_control('rd3_show_site_desc_control', [
        'label' => __('Display Site Description / Tagline', 'rd3starter'),
        'section' => 'rd3_branding',
        'type' => 'checkbox',
        'settings' => 'rd3_show_site_desc',
    ]);

    // Display Breadcrumbs
    $wp_customize->add_setting('rd3_show_breadcrumbs', ['default' => true, 'sanitize_callback' => 'wp_validate_boolean']);
    $wp_customize->add_control('rd3_show_breadcrumbs_control', [
        'label' => __('Display Breadcrumbs', 'rd3starter'),
        'section' => 'rd3_branding',
        'type' => 'checkbox',
        'settings' => 'rd3_show_breadcrumbs',
    ]);

    // Sidebar Position
    $wp_customize->add_setting('rd3_sidebar_position', [
        'default' => 'left',
        'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control('rd3_sidebar_position_control', [
        'label' => __('Sidebar Position', 'rd3starter'),
        'section' => 'rd3_branding',
        'type' => 'radio',
        'settings' => 'rd3_sidebar_position',
        'choices' => ['left' => 'Left', 'right' => 'Right'],
    ]);

    // Header Menu Alignment
    $wp_customize->add_setting('rd3_header_menu_alignment', ['default' => 'center']);
    $wp_customize->add_control('rd3_header_menu_alignment', [
        'label' => 'Header Menu Alignment',
        'section' => 'rd3_branding',
        'type' => 'radio',
        'choices' => ['left' => 'Left', 'center' => 'Center', 'right' => 'Right']
    ]);

    // Footer Menu Alignment
    $wp_customize->add_setting('rd3_footer_menu_alignment', ['default' => 'center']);
    $wp_customize->add_control('rd3_footer_menu_alignment', [
        'label' => 'Footer Menu Alignment',
        'section' => 'rd3_branding',
        'type' => 'radio',
        'choices' => ['left' => 'Left', 'center' => 'Center', 'right' => 'Right']
    ]);

    // Colors
    $wp_customize->add_setting('rd3_primary_color', ['default' => '#000000']);
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'rd3_primary_color', [
        'label' => 'Primary Colour', 'section' => 'rd3_branding'
    ]));

    $wp_customize->add_setting('rd3_secondary_color', ['default' => '#666666']);
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'rd3_secondary_color', [
        'label' => 'Secondary Colour', 'section' => 'rd3_branding'
    ]));

    // Font Color
    $wp_customize->add_setting('rd3_font_color', [
        'default' => '#000000',
        'sanitize_callback' => 'sanitize_hex_color',
    ]);
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'rd3_font_color_control', [
        'label' => __('Font Color', 'rd3starter'),
        'section' => 'rd3_branding',
        'settings' => 'rd3_font_color',
    ]));

    // Font Family
    $wp_customize->add_setting('rd3_font_family', ['default' => 'system']);
    $wp_customize->add_control('rd3_font_family', [
        'label' => 'Font Family',
        'section' => 'rd3_branding',
        'type' => 'select',
        'choices' => ['system' => 'System Default', 'arial' => 'Arial', 'roboto' => 'Roboto', 'poppins' => 'Poppins', 'lato' => 'Lato']
    ]);

    // Footer Menu Toggle
    $wp_customize->add_setting('rd3_show_footer_menu', ['default' => true]);
    $wp_customize->add_control('rd3_show_footer_menu', [
        'label' => 'Display Footer Menu',
        'section' => 'nav_menus',
        'type' => 'checkbox'
    ]);

    // Homepage Layout
    $wp_customize->add_setting('rd3_homepage_layout', ['default' => 'posts']);
    $wp_customize->add_control('rd3_homepage_layout', [
        'label' => 'Homepage Layout',
        'section' => 'rd3_branding',
        'type' => 'radio',
        'choices' => ['posts' => 'Show Latest Posts', 'page' => 'Show Full Page']
    ]);

    $wp_customize->add_setting('rd3_homepage_page', ['default' => 0]);
    $wp_customize->add_control('rd3_homepage_page', [
        'label' => 'Select Full Page for Homepage',
        'section' => 'rd3_branding',
        'type' => 'dropdown-pages',
        'active_callback' => function () {
            return get_theme_mod('rd3_homepage_layout', 'posts') === 'page';
        }
    ]);

    // Header & Footer Background Images
    $wp_customize->add_setting('rd3_header_bg');
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'rd3_header_bg', [
        'label' => 'Header Background Image',
        'section' => 'rd3_branding',
        'settings' => 'rd3_header_bg'
    ]));

    $wp_customize->add_setting('rd3_footer_bg');
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'rd3_footer_bg', [
        'label' => 'Footer Background Image',
        'section' => 'rd3_branding',
        'settings' => 'rd3_footer_bg'
    ]));
}
add_action('customize_register', 'rd3_branding_customizer');

// ===============================
// Dynamic Styles
// ===============================
function rd3_branding_styles()
{
    $primary = get_theme_mod('rd3_primary_color', '#000000');
    $secondary = get_theme_mod('rd3_secondary_color', '#666666');
    $font = get_theme_mod('rd3_font_family', 'system');
    $font_color = get_theme_mod('rd3_font_color', '#000000');
    $logo_align = get_theme_mod('rd3_logo_alignment', 'left');
    $header_bg = get_theme_mod('rd3_header_bg', '');
    $footer_bg = get_theme_mod('rd3_footer_bg', '');
    $header_menu_align = get_theme_mod('rd3_header_menu_alignment', 'center');
    $footer_menu_align = get_theme_mod('rd3_footer_menu_alignment', 'center');

    $fonts = [
        'system' => 'system-ui, sans-serif',
        'arial' => 'Arial, sans-serif',
        'roboto' => 'Roboto, sans-serif',
        'poppins' => 'Poppins, sans-serif',
        'lato' => 'Lato, sans-serif'
    ];

    $font_family = $fonts[$font] ?? $fonts['system'];
    $logo_text_align = $logo_align;
    ?>
    <style>
        body,
        h1, p,
        .site-header .logo a,
        .main-nav a,
        .footer-nav a,
        .footer-widgets,
        .site-footer p {
            color: <?php echo esc_attr($font_color); ?> !important;
        }

        body { font-family: <?php echo $font_family; ?>; }
        a { color: <?php echo $primary; ?>; }
        .site-header, .site-footer { background: <?php echo $secondary; ?>; }

        .site-header .logo { text-align: <?php echo $logo_text_align; ?>; }

        .main-nav { display: flex; justify-content: <?php echo $header_menu_align==='left'?'flex-start':($header_menu_align==='right'?'flex-end':'center'); ?>; width: 100%; }
        .footer-nav ul { display: flex; justify-content: <?php echo $footer_menu_align==='left'?'flex-start':($footer_menu_align==='right'?'flex-end':'center'); ?>; }

        <?php if ($header_bg): ?>
        .site-header { background-image: url('<?php echo esc_url($header_bg); ?>'); background-size: cover; background-position: center; background-repeat: no-repeat; }
        <?php endif; ?>

        <?php if ($footer_bg): ?>
        .site-footer { background-image: url('<?php echo esc_url($footer_bg); ?>'); background-size: cover; background-position: center; background-repeat: no-repeat; }
        <?php endif; ?>
    </style>
    <?php
}
add_action('wp_head', 'rd3_branding_styles');

// ===============================
// Breadcrumbs
// ===============================
function rd3_breadcrumbs()
{
    if (is_front_page()) return;

    echo '<p class="rd3-breadcrumbs">';
    echo '<a href="' . esc_url(home_url('/')) . '">Home</a> » ';

    if (is_category() || is_single()) {
        the_category(' » ');
        if (is_single()) { echo ' » '; the_title(); }
    } elseif (is_page()) { the_title(); }
    elseif (is_search()) { echo 'Search: "' . get_search_query() . '"'; }
    elseif (is_404()) { echo '404'; }

    echo '</p>';
}
