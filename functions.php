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
    // Load main stylesheet
    wp_enqueue_style('rd3-main', get_template_directory_uri() . '/assets/css/main.css', [], '1.0');

    // Horizontal or vertical layout
    $layout = get_theme_mod('rd3_site_layout', 'horizontal');
    if ($layout === 'vertical') {
        wp_enqueue_style('rd3-layout-vertical', get_template_directory_uri() . '/assets/css/layout-vertical.css', ['rd3-main'], '1.0');
    } else {
        wp_enqueue_style('rd3-layout-horizontal', get_template_directory_uri() . '/assets/css/layout-horizontal.css', ['rd3-main'], '1.0');
    }

    // Custom uploaded CSS
    $custom_css = get_theme_mod('rd3_layout_custom_upload');
    if ($custom_css)
        wp_enqueue_style('rd3-custom-css', esc_url($custom_css), [], '1.0');

    // Main JS
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

    // Maintenance Page Widgets
    register_sidebar([
        'name' => 'Maintenance Page Widgets',
        'id' => 'maintenance-widgets',
        'before_widget' => '<div class="maintenance-widget">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ]);

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
// Sanitize Checkbox
// ===============================
function rd3_sanitize_checkbox($checked)
{
    return (isset($checked) && $checked === true) ? true : false;
}


// ===============================rd3_maintenance_mode_redirect
// Maintenance Mode Redirect
// ===============================
function rd3_maintenance_mode_redirect()
{
    if (current_user_can('manage_options') || is_admin())
        return;

    $maintenance = get_theme_mod('rd3_maintenance_mode', false);
    $auto_reload = get_theme_mod('rd3_maintenance_auto_reload', true);
    $countdown_date = get_theme_mod('rd3_maintenance_countdown', date('Y-m-d H:i:s', strtotime('+3 days')));
    $current_time = current_time('timestamp');
    $countdown_timestamp = strtotime($countdown_date);

    // If countdown passed and auto reload enabled, turn off maintenance mode
    if ($auto_reload && $current_time >= $countdown_timestamp) {
        if ($maintenance) {
            // Update the theme mod to false so checkbox becomes unchecked
            set_theme_mod('rd3_maintenance_mode', false);
        }
        return; // Don't show maintenance page
    }

    // Show maintenance page if enabled
    if ($maintenance) {
        include get_template_directory() . '/maintenance.php';
        exit;
    }
}
add_action('template_redirect', 'rd3_maintenance_mode_redirect');


// ===============================
// Customizer: Maintenance Mode
// ===============================
function rd3_customize_register($wp_customize)
{
    $wp_customize->add_section('rd3_maintenance', [
        'title' => 'Maintenance Mode',
        'priority' => 30,
        'description' => 'Configure the maintenance splash page, countdown timer, messages, colors, and widgets shown to visitors.',
    ]);

    // Enable/Disable Maintenance Mode
    $wp_customize->add_setting('rd3_maintenance_mode', ['default' => false, 'sanitize_callback' => 'rd3_sanitize_checkbox']);
    $wp_customize->add_control('rd3_maintenance_mode', [
        'type' => 'checkbox',
        'section' => 'rd3_maintenance',
        'label' => 'Enable Maintenance Mode',
    ]);

    // Widgets link
    class RD3_Maintenance_Widgets_Link extends WP_Customize_Control
    {
        public $type = 'link';
        public function render_content()
        {
            ?>
            <p>
                <strong>Widgets:</strong>
                <a href="<?php echo admin_url('widgets.php'); ?>" target="_blank">
                    Edit Maintenance Page Widgets
                </a>
            </p>
            <?php
        }
    }
    $wp_customize->add_setting('rd3_maintenance_widgets_link', ['sanitize_callback' => 'esc_url']);
    $wp_customize->add_control(new RD3_Maintenance_Widgets_Link($wp_customize, 'rd3_maintenance_widgets_link', [
        'section' => 'rd3_maintenance',
    ]));

    // Logo
    $wp_customize->add_setting('rd3_maintenance_logo', ['sanitize_callback' => 'esc_url_raw']);
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'rd3_maintenance_logo', [
        'label' => 'Maintenance Logo',
        'section' => 'rd3_maintenance',
        'settings' => 'rd3_maintenance_logo',
    ]));

    // Colors
    $wp_customize->add_setting('rd3_maintenance_bg', ['default' => '#f7f7f7', 'sanitize_callback' => 'sanitize_hex_color']);
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'rd3_maintenance_bg', ['label' => 'Background Color', 'section' => 'rd3_maintenance']));

    $wp_customize->add_setting('rd3_maintenance_text', ['default' => '#333', 'sanitize_callback' => 'sanitize_hex_color']);
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'rd3_maintenance_text', ['label' => 'Text Color', 'section' => 'rd3_maintenance']));

    // Title & Message
    $wp_customize->add_setting('rd3_maintenance_title', ['default' => 'Site Under Maintenance', 'sanitize_callback' => 'sanitize_text_field']);
    $wp_customize->add_control('rd3_maintenance_title', ['type' => 'text', 'section' => 'rd3_maintenance', 'label' => 'Maintenance Page Title']);

    $wp_customize->add_setting('rd3_maintenance_message', ['default' => 'We’re making improvements. Please check back soon.', 'sanitize_callback' => 'sanitize_textarea_field']);
    $wp_customize->add_control('rd3_maintenance_message', ['type' => 'textarea', 'section' => 'rd3_maintenance', 'label' => 'Maintenance Page Message']);

    // Countdown
    $wp_customize->add_setting('rd3_maintenance_countdown_enable', ['default' => true, 'sanitize_callback' => 'rd3_sanitize_checkbox']);
    $wp_customize->add_control('rd3_maintenance_countdown_enable', [
        'type' => 'checkbox',
        'section' => 'rd3_maintenance',
        'label' => 'Enable Countdown Timer',
    ]);

    $wp_customize->add_setting('rd3_maintenance_countdown', ['default' => date('Y-m-d H:i:s', strtotime('+3 days')), 'sanitize_callback' => 'sanitize_text_field']);
    $wp_customize->add_control('rd3_maintenance_countdown', [
        'type' => 'text',
        'section' => 'rd3_maintenance',
        'label' => 'Countdown End Date (YYYY-MM-DD HH:MM:SS)',
    ]);

    $wp_customize->add_setting('rd3_maintenance_back_message', ['default' => 'We are back!', 'sanitize_callback' => 'sanitize_text_field']);
    $wp_customize->add_control('rd3_maintenance_back_message', ['type' => 'text', 'section' => 'rd3_maintenance', 'label' => 'Countdown Finished Message']);

    $wp_customize->add_setting('rd3_maintenance_auto_reload', ['default' => true, 'sanitize_callback' => 'rd3_sanitize_checkbox']);
    $wp_customize->add_control('rd3_maintenance_auto_reload', ['type' => 'checkbox', 'section' => 'rd3_maintenance', 'label' => 'Auto Reload When Countdown Ends']);
}
add_action('customize_register', 'rd3_customize_register');



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
// Layout Section with Enable/Disable
// ===============================
function rd3_customize_layout($wp_customize)
{

    // --- Layout Section ---
    $wp_customize->add_section('rd3_layout_section', [
        'title' => 'Layout & Custom CSS',
        'priority' => 30,
        'description' => __('Layout & Custom CSS for Advanced users only.', 'textdomain'),
    ]);

    // --- Master Enable/Disable Checkbox ---
    $wp_customize->add_setting('rd3_layout_enabled', [
        'default' => 1, // 1 = enabled, 0 = disabled
        'sanitize_callback' => 'absint',
    ]);

    $wp_customize->add_control('rd3_layout_enabled', [
        'label' => 'Show Layout & Custom CSS Controls',
        'section' => 'rd3_layout_section',
        'type' => 'checkbox',
    ]);

    // --- Layout Choice: Horizontal / Vertical ---
    $wp_customize->add_setting('rd3_site_layout', [
        'default' => 'horizontal',
        'transport' => 'refresh',
    ]);

    $wp_customize->add_control('rd3_site_layout', [
        'label' => __('Site Layout', 'rd3starter'),
        'section' => 'rd3_layout_section',
        'type' => 'radio',
        'choices' => [
            'horizontal' => __('Horizontal Header', 'rd3starter'),
            'vertical' => __('Vertical Header', 'rd3starter'),
        ],
        // Only active if master checkbox is checked
        'active_callback' => function () use ($wp_customize) {
            return get_theme_mod('rd3_layout_enabled', 1) == 1;
        }
    ]);

    //Custom CSS Upload
    $wp_customize->add_setting('rd3_custom_css', [
        'default' => '',
        'sanitize_callback' => 'esc_url_raw',
    ]);

    $wp_customize->add_control(new WP_Customize_Upload_Control($wp_customize, 'rd3_custom_css', [
        'label' => 'Upload Custom CSS File',
        'section' => 'rd3_layout_section',
        // Only active if master checkbox is checked
        'active_callback' => function () use ($wp_customize) {
            return get_theme_mod('rd3_layout_enabled', 1) == 1;
        }
    ]));

}
add_action('customize_register', 'rd3_customize_layout');



// ===============================
// Dynamic Styles
// ===============================
function rd3_branding_styles()
{
    $primary = get_theme_mod('rd3_primary_color', '#000000');
    $secondary = get_theme_mod('rd3_secondary_color', '#666666');
    $logo_align = get_theme_mod('rd3_logo_alignment', 'left');
    $logo_align_class = 'logo-align-' . $logo_align;
    $header_bg = get_theme_mod('rd3_header_bg', '');
    $footer_bg = get_theme_mod('rd3_footer_bg', '');
    $header_menu_align = get_theme_mod('rd3_header_menu_alignment', 'center');
    $footer_menu_align = get_theme_mod('rd3_footer_menu_alignment', 'center');
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
            .site-header .container {
            background-color: <?php echo esc_attr($header_bg_color) ?>!important
                ;
            }
        
            .site-footer .container {
                background-color:
                    <?php echo esc_attr($footer_bg_color)?>!important 
                ;
            }
        
            .site-header,
            .site-footer {
                background:
                    <?php echo $secondary; ?>
                ;
            }
        
            .site-header .logo {
                text-align:
                    <?php echo $logo_text_align; ?>
                ;
            }
        
            .main-nav {
                display: flex;
                justify-content:
                    <?php echo $header_menu_align === 'left' ? 'flex-start' : ($header_menu_align === 'right' ? 'flex-end' : 'center'); ?>
                ;
                width: 100%;
            }
        
            .footer-nav ul {
                display: flex;
                justify-content:
                    <?php echo $footer_menu_align === 'left' ? 'flex-start' : ($footer_menu_align === 'right' ? 'flex-end' : 'center'); ?>
                ;
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

// ===============================
// Breadcrumbs
// ===============================
function rd3_breadcrumbs()
{
    if (is_front_page())
        return;

    echo '<p class="breadcrumbs">';
    echo '<a href="' . esc_url(home_url('/')) . '">Home</a> » ';

    if (is_category() || is_single()) {
        the_category(' » ');
        if (is_single()) {
            echo ' » ';
            the_title();
        }
    } elseif (is_page()) {
        the_title();
    } elseif (is_search()) {
        echo 'Search: "' . get_search_query() . '"';
    } elseif (is_404()) {
        echo '404';
    }

    echo '</p>';
}

// Allow CSS uploads
function rd3_allow_css_uploads($mimes)
{
    $mimes['css'] = 'text/css';
    return $mimes;
}
add_filter('upload_mimes', 'rd3_allow_css_uploads');

// Fix WordPress filetype checking (WP 5.0+)
function rd3_fix_css_mime_check($data, $file, $filename, $mimes)
{

    $ext = pathinfo($filename, PATHINFO_EXTENSION);

    if ($ext === 'css') {
        $data['ext'] = 'css';
        $data['type'] = 'text/css';
    }

    return $data;
}
add_filter('wp_check_filetype_and_ext', 'rd3_fix_css_mime_check', 10, 4);