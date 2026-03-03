<?php
/**
 * Customizer - Branding Section
 * Colors, logos, backgrounds, alignments, visibility toggles
 */

// ===============================
// Customizer Settings
// ===============================
function rd3_branding_customizer($wp_customize)
{
    $wp_customize->add_section('rd3_branding', [
        'title' => __('Branding Settings', 'rd3starter'),
        'priority' => 30,
    ]);

    // Add this inside rd3_branding_customizer
    $wp_customize->add_setting('rd3_body_bg_color', [
        'default' => '#ffffff',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport' => 'refresh',
    ]);


    //  Background Image
    $wp_customize->add_setting('rd3_bg_img');
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'rd3_bg_img', [
        'label' => 'Background Image',
        'section' => 'rd3_branding',
        'settings' => 'rd3_bg_img'
    ]));

    //  Background Colour
    $wp_customize->add_setting('rd3_bg_color', [
        'default' => '#ffffff',
        'sanitize_callback' => 'sanitize_hex_color',
    ]);

    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'rd3_bg_color',
            [
                'label' => __(' Background Colour', 'rd3starter'),
                'section' => 'rd3_branding',
            ]
        )
    );



    // Site Logo
    $wp_customize->add_setting('rd3_logo');
    $wp_customize->add_control(new WP_Customize_Image_Control(
        $wp_customize,
        'rd3_logo',
        ['label' => 'Site Logo', 'section' => 'rd3_branding', 'settings' => 'rd3_logo']
    ));


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


    // Footer Menu Toggle
    $wp_customize->add_setting('rd3_show_footer_menu', ['default' => true]);
    $wp_customize->add_control('rd3_show_footer_menu', [
        'label' => 'Display Footer Menu',
        'section' => 'nav_menus',
        'type' => 'checkbox'
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
        // Enable Header Background Color
        $wp_customize->add_setting('rd3_enable_header_bg_color', [
            'default' => true,
            'sanitize_callback' => 'wp_validate_boolean'
        ]);
        $wp_customize->add_control('rd3_enable_header_bg_color_control', [
            'label' => __('Enable Header Background Color', 'rd3starter'),
            'section' => 'rd3_branding',
            'type' => 'checkbox',
            'settings' => 'rd3_enable_header_bg_color',
        ]);


    // Header Background Colour
    $wp_customize->add_setting('rd3_header_bg_color', [
        'default' => '#ffffff',
        'sanitize_callback' => 'sanitize_hex_color',
    ]);

    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'rd3_header_bg_color',
            [
                'label' => __('Header Background Colour', 'rd3starter'),
                'section' => 'rd3_branding',
            ]
        )
    );

    // Enable Footer Background Color
    $wp_customize->add_setting('rd3_enable_footer_bg_color', [
        'default' => true,
        'sanitize_callback' => 'wp_validate_boolean'
    ]);
    $wp_customize->add_control('rd3_enable_footer_bg_color_control', [
        'label' => __('Enable Footer Background Color', 'rd3starter'),
        'section' => 'rd3_branding',
        'type' => 'checkbox',
        'settings' => 'rd3_enable_footer_bg_color',
    ]);


    // Footer Background Colour
    $wp_customize->add_setting('rd3_footer_bg_color', [
        'default' => '#ffffff',
        'sanitize_callback' => 'sanitize_hex_color',
    ]);

    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'rd3_footer_bg_color',
            [
                'label' => __('Footer Background Colour', 'rd3starter'),
                'section' => 'rd3_branding',
            ]
        )
    );


}
add_action('customize_register', 'rd3_branding_customizer');



// ===============================
// Dynamic Styles
// ===============================
function rd3_branding_styles()

{   $rd3_bg_img = get_theme_mod('rd3_bg_img', '');
    $rd3_bg_color = get_theme_mod('rd3_bg_color', '#ffffff');
    $primary = get_theme_mod('rd3_primary_color', '#000000');
    $secondary = get_theme_mod('rd3_secondary_color', '#666666');
    $logo_align = get_theme_mod('rd3_logo_alignment', 'left');
    $logo_align_class = 'logo-align-' . $logo_align;
    $header_bg = get_theme_mod('rd3_header_bg', '');
    $footer_bg = get_theme_mod('rd3_footer_bg', '');
    $header_menu_align = get_theme_mod('rd3_header_menu_alignment', 'center');
    $footer_menu_align = get_theme_mod('rd3_footer_menu_alignment', 'center');
    $enable_header_bg_color = get_theme_mod('rd3_enable_header_bg_color', true);
    $enable_footer_bg_color = get_theme_mod('rd3_enable_footer_bg_color', true);
    $header_bg_color = get_theme_mod('rd3_header_bg_color', '#ffffff');
    $footer_bg_color = get_theme_mod('rd3_footer_bg_color', '#ffffff');

    $fonts = [
        'system' => 'system-ui, sans-serif',
        'arial' => 'Arial, sans-serif',
        'roboto' => 'Roboto, sans-serif',
        'poppins' => 'Poppins, sans-serif',
        'lato' => 'Lato, sans-serif'
    ];
    $logo_text_align = $logo_align;
    ?>

    <style>
    <?php if ($rd3_bg_img): ?>
        .Main-container {
            background-image: url('<?php echo esc_url($rd3_bg_img); ?>');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }
    <?php endif; ?>

    .Main-container {
        background-color: <?php echo esc_attr($rd3_bg_color); ?>;
    }

    <?php if ($enable_header_bg_color): ?>
        .site-header {
            background-color: <?php echo esc_attr($header_bg_color); ?>;
        }
    <?php endif; ?>

    <?php if ($enable_footer_bg_color): ?>
        .site-footer {
            background-color: <?php echo esc_attr($footer_bg_color); ?>;
        }
    <?php endif; ?>

    .site-header .logo {
        text-align: <?php echo $logo_text_align; ?>;
    }

    .main-nav {
        display: flex;
        justify-content: <?php echo $header_menu_align === 'left' ? 'flex-start' : ($header_menu_align === 'right' ? 'flex-end' : 'center'); ?>;
        width: 100%;
    }

    .footer-nav ul {
        display: flex;
        justify-content: <?php echo $footer_menu_align === 'left' ? 'flex-start' : ($footer_menu_align === 'right' ? 'flex-end' : 'center'); ?>;
    }

    <?php if ($header_bg): ?>
        .site-header {
            background-image: url('<?php echo esc_url($header_bg); ?>');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }
    <?php endif; ?>

    <?php if ($footer_bg): ?>
        .site-footer {
            background-image: url('<?php echo esc_url($footer_bg); ?>');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }
    <?php endif; ?>
</style>
    <?php
}
add_action('wp_head', 'rd3_branding_styles');