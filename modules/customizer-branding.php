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


    // Hamburger Menu Color
    $wp_customize->add_setting('rd3_hamburger_color', [
        'default' => '#000000',
        'sanitize_callback' => 'sanitize_hex_color',
    ]);

    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'rd3_hamburger_color_control',
            [
                'label' => __('Hamburger Menu Color', 'rd3starter'),
                'section' => 'rd3_branding', // ✅ Shows in Branding Settings
                'settings' => 'rd3_hamburger_color',
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

    // Sidebar Toggle Button Colors

    // Button Background
    $wp_customize->add_setting('toggle-button-bg', [
        'default' => '#0073aa',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport' => 'refresh',
    ]);
    $wp_customize->add_control(new WP_Customize_Color_Control(
        $wp_customize,
        'toggle-button-bg',
        [
            'label' => __('Sidebar Toggle Button Background', 'rd3starter'),
            'section' => 'rd3_branding',
            'settings' => 'toggle-button-bg',
        ]
    ));

    // Button Hover Background Color
    $wp_customize->add_setting('toggle-button-hover-bg', [
        'default' => '#005177',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport' => 'refresh',
    ]);
    $wp_customize->add_control(new WP_Customize_Color_Control(
        $wp_customize,
        'toggle-button-hover-bg',
        [
            'label' => __('Sidebar Toggle Button Hover Background', 'rd3starter'),
            'section' => 'rd3_branding',
            'settings' => 'toggle-button-hover-bg',
        ]
    ));

    // Button Text Color
    $wp_customize->add_setting('toggle-button-text', [
        'default' => '#ffffff',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport' => 'refresh',
    ]);
    $wp_customize->add_control(new WP_Customize_Color_Control(
        $wp_customize,
        'toggle-button-text',
        [
            'label' => __('Sidebar Toggle Button Text Color', 'rd3starter'),
            'section' => 'rd3_branding',
            'settings' => 'toggle-button-text',
        ]
    ));

    // Arrow Color
    $wp_customize->add_setting('toggle-button-arrow', [
        'default' => '#ffffff',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport' => 'refresh',
    ]);
    $wp_customize->add_control(new WP_Customize_Color_Control(
        $wp_customize,
        'toggle-button-arrow',
        [
            'label' => __('Sidebar Toggle Arrow Color', 'rd3starter'),
            'section' => 'rd3_branding',
            'settings' => 'toggle-button-arrow',
        ]
    ));



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


    // Footer Info Alignment
    $wp_customize->add_setting('rd3_footer_info_alignment', ['default' => 'center']);
    $wp_customize->add_control('rd3_footer_info_alignment', [
        'label' => 'Footer Info Alignment',
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

    // Search Form Styling

    // Input background color
    $wp_customize->add_setting('rd3_search_input_bg', array(
        'default' => '#ffffff',
        'sanitize_callback' => 'sanitize_hex_color',
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control(
        $wp_customize,
        'rd3_search_input_bg',
        array(
            'label' => __('Search Input Background', 'rd3starter'),
            'section' => 'rd3_branding',
            'settings' => 'rd3_search_input_bg',
        )
    ));

    // Input text color
    $wp_customize->add_setting('rd3_search_input_text', array(
        'default' => '#333333',
        'sanitize_callback' => 'sanitize_hex_color',
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control(
        $wp_customize,
        'rd3_search_input_text',
        array(
            'label' => __('Search Input Text Color', 'rd3starter'),
            'section' => 'rd3_branding',
            'settings' => 'rd3_search_input_text',
        )
    ));

    // Input border color
    $wp_customize->add_setting('rd3_search_input_border', array(
        'default' => '#cccccc',
        'sanitize_callback' => 'sanitize_hex_color',
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control(
        $wp_customize,
        'rd3_search_input_border',
        array(
            'label' => __('Search Input Border Color', 'rd3starter'),
            'section' => 'rd3_branding',
            'settings' => 'rd3_search_input_border',
        )
    ));

    // Submit button background
    $wp_customize->add_setting('rd3_search_submit_bg', array(
        'default' => '#333333',
        'sanitize_callback' => 'sanitize_hex_color',
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control(
        $wp_customize,
        'rd3_search_submit_bg',
        array(
            'label' => __('Search Button Background', 'rd3starter'),
            'section' => 'rd3_branding',
            'settings' => 'rd3_search_submit_bg',
        )
    ));

    // Submit button text color
    $wp_customize->add_setting('rd3_search_submit_text', array(
        'default' => '#ffffff',
        'sanitize_callback' => 'sanitize_hex_color',
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control(
        $wp_customize,
        'rd3_search_submit_text',
        array(
            'label' => __('Search Button Text Color', 'rd3starter'),
            'section' => 'rd3_branding',
            'settings' => 'rd3_search_submit_text',
        )
    ));

    // Header Background Images
    $wp_customize->add_setting('rd3_header_bg');
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'rd3_header_bg', [
        'label' => 'Header Background Image',
        'section' => 'rd3_branding',
        'settings' => 'rd3_header_bg'
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

    // Header Background Opacity
    $wp_customize->add_setting('rd3_header_bg_opacity', [
        'default' => 1,
        'sanitize_callback' => 'rd3_sanitize_opacity',
    ]);
    $wp_customize->add_control('rd3_header_bg_opacity', [
        'label' => __('Header Background Opacity', 'rd3starter'),
        'section' => 'rd3_branding',
        'type' => 'number',
        'input_attrs' => [
            'min' => 0,
            'max' => 1,
            'step' => 0.01,
        ],
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

    //Footer Background Images
    $wp_customize->add_setting('rd3_footer_bg');
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'rd3_footer_bg', [
        'label' => 'Footer Background Image',
        'section' => 'rd3_branding',
        'settings' => 'rd3_footer_bg'
    ]));

    // Footer Background Opacity
    $wp_customize->add_setting('rd3_footer_bg_opacity', [
        'default' => 1,
        'sanitize_callback' => 'rd3_sanitize_opacity',
    ]);
    $wp_customize->add_control('rd3_footer_bg_opacity', [
        'label' => __('Footer Background Opacity', 'rd3starter'),
        'section' => 'rd3_branding',
        'type' => 'number',
        'input_attrs' => [
            'min' => 0,
            'max' => 1,
            'step' => 0.01,
        ],
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
// Opacity Sanitizer
// ===============================
function rd3_sanitize_opacity($value)
{
    return ($value >= 0 && $value <= 1) ? $value : 1;
}

// ===============================
// Dynamic Styles
// ===============================
function rd3_branding_styles()
{
    $rd3_bg_img = get_theme_mod('rd3_bg_img', '');
    $rd3_bg_color = get_theme_mod('rd3_bg_color', '#ffffff');
    $hamburger_color = get_theme_mod('rd3_hamburger_color', '#000000');
    $logo_align = get_theme_mod('rd3_logo_alignment', 'left');
    $logo_align_class = 'logo-align-' . $logo_align;
    $header_bg = get_theme_mod('rd3_header_bg', '');
    $footer_bg = get_theme_mod('rd3_footer_bg', '');
    $header_menu_align = get_theme_mod('rd3_header_menu_alignment', 'center');
    $footer_menu_align = get_theme_mod('rd3_footer_menu_alignment', 'center');
    $footer_info_align = get_theme_mod('rd3_footer_info_alignment', 'center');
    $enable_header_bg_color = get_theme_mod('rd3_enable_header_bg_color', true);
    $enable_footer_bg_color = get_theme_mod('rd3_enable_footer_bg_color', true);
    $header_bg_color = get_theme_mod('rd3_header_bg_color', '#ffffff');
    $footer_bg_color = get_theme_mod('rd3_footer_bg_color', '#ffffff');
    $header_bg_opacity = get_theme_mod('rd3_header_bg_opacity', 1);
    $footer_bg_opacity = get_theme_mod('rd3_footer_bg_opacity', 1);
    $input_bg = get_theme_mod('rd3_search_input_bg', '#ffffff');
    $input_text = get_theme_mod('rd3_search_input_text', '#333333');
    $input_border = get_theme_mod('rd3_search_input_border', '#cccccc');
    $submit_bg = get_theme_mod('rd3_search_submit_bg', '#333333');
    $submit_text = get_theme_mod('rd3_search_submit_text', '#ffffff');
    $toggleBtn_bg = get_theme_mod('toggle-button-bg', '#0073aa');
    $toggleBtn_hover_bg = get_theme_mod('toggle-button-hover-bg', '#005177');
    $toggleBtn_text = get_theme_mod('toggle-button-text', '#ffffff');
    $toggleBtn_arrow = get_theme_mod('toggle-button-arrow', '#ffffff');

    ?>
    <style>
        /* Site Background */
        .Main-container {
            <?php if ($rd3_bg_img): ?>
                background-image: url('<?php echo esc_url($rd3_bg_img); ?>');
                background-size: cover;
                background-position: center;
                background-repeat: no-repeat;
            <?php endif; ?>
            background-color:
                <?php echo esc_attr($rd3_bg_color); ?>
            ;
        }

        /* Hamburger Menu */
        span.hamburger.hamburger-colour {
            color:
                <?php echo esc_attr($hamburger_color); ?>
            ;
            background-color:
                <?php echo esc_attr($hamburger_color); ?>
                !important;
        }

        .sidebar-toggle-button {
            background-color:
                <?php echo esc_attr($toggleBtn_bg); ?>
            ;
            color:
                <?php echo esc_attr($toggleBtn_text); ?>
            ;
        }

        .sidebar-toggle-button:hover {
            background-color:
                <?php echo esc_attr($toggleBtn_hover_bg); ?>
            ;
        }

        .sidebar-toggle-button .arrow {
            border-top-color:
                <?php echo esc_attr($toggleBtn_arrow); ?>
            ;
        }

        /* Header Background */
        <?php if ($enable_header_bg_color): ?>
            .site-header {
                background-color:
                    <?php echo esc_attr(hex_to_rgba($header_bg_color, $header_bg_opacity)); ?>
                ;
            }

        <?php endif; ?>

        <?php if ($header_bg): ?>
            .site-header {
                background-image: url('<?php echo esc_url($header_bg); ?>');
                background-size: cover;
                background-position: center;
                background-repeat: no-repeat;
            }

        <?php endif; ?>

        /* Footer Background */
        <?php if ($enable_footer_bg_color): ?>
            .site-footer {
                background-color:
                    <?php echo esc_attr(hex_to_rgba($footer_bg_color, $footer_bg_opacity)); ?>
                ;
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

        /* Logo Alignment */
        .site-header .logo {
            text-align:
                <?php echo esc_attr($logo_align); ?>
            ;
        }

        /* Header Menu Alignment */
        .main-nav {
            display: flex;
            justify-content:
                <?php echo $header_menu_align === 'left' ? 'flex-start' : ($header_menu_align === 'right' ? 'flex-end' : 'center'); ?>
            ;
            width: 100%;
        }

        /* Footer Info Alignment */
        .footer-info {
            display: flex;
            justify-content:
                <?php echo $footer_info_align === 'left' ? 'flex-start' : ($footer_info_align === 'right' ? 'flex-end' : 'center'); ?>
            ;
        }

        /* Footer Menu Alignment */
        .footer-nav ul {
            display: flex;
            justify-content:
                <?php echo $footer_menu_align === 'left' ? 'flex-start' : ($footer_menu_align === 'right' ? 'flex-end' : 'center'); ?>
            ;
        }

        /* Search Form Styling*/
        .search-form,
        .wp-block-search {
            width: 100%;
        }

        /* Wrapper */
        .wp-block-search__inside-wrapper {
            display: flex;
            border: 1px solid
                <?php echo esc_attr($input_border); ?>
            ;
            overflow: hidden;
        }

        /* Input field */
        .search-form input[type="search"],
        .wp-block-search__input {
            background-color:
                <?php echo esc_attr($input_bg); ?>
            ;
            color:
                <?php echo esc_attr($input_text); ?>
            ;
            border: none;
            padding: 0.5em 1em;
            flex: 1;
            width: 100%;
        }

        /* Input focus */
        .wp-block-search__input:focus,
        .search-form input[type="search"]:focus {
            outline: none;
        }

        /* Submit button */
        .search-submit,
        .wp-block-search__button {
            background-color:
                <?php echo esc_attr($submit_bg); ?>
            ;
            color:
                <?php echo esc_attr($submit_text); ?>
            ;
            border: none;
            padding: 0.5em 1em;
            cursor: pointer;
            transition: 0.3s;
        }

        /* Hover effect */
        .search-submit:hover,
        .wp-block-search__button:hover {
            opacity: 0.85;
        }
    </style>
    <?php
}
add_action('wp_head', 'rd3_branding_styles');