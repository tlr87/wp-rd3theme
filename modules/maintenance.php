<?php
/**
 * Maintenance Mode Functionality
 * 
 * Redirects non-admin users to a maintenance page when enabled.
 * Supports countdown timer with optional auto-disable after expiry.
 *
 * @package RD3 Client Starter
 */

// ===============================
// Maintenance Mode Redirect
// ===============================
function rd3_maintenance_mode_redirect() {
    // Skip for admins and backend
    if ( current_user_can( 'manage_options' ) || is_admin() ) {
        return;
    }

    $maintenance      = get_theme_mod( 'rd3_maintenance_mode', false );
    $auto_reload      = get_theme_mod( 'rd3_maintenance_auto_reload', true );
    $countdown_date   = get_theme_mod( 'rd3_maintenance_countdown', date( 'Y-m-d H:i:s', strtotime( '+3 days' ) ) );
    $current_time     = current_time( 'timestamp' );
    $countdown_timestamp = strtotime( $countdown_date );

    // Fallback if date is invalid
    if ( false === $countdown_timestamp ) {
        $countdown_timestamp = time() + ( 3 * DAY_IN_SECONDS );
    }

    // If countdown has passed and auto-reload is enabled → just don't show maintenance anymore
    if ( $auto_reload && $current_time >= $countdown_timestamp ) {
        return; // No DB write → safe & performant
    }

    // Show maintenance page if still enabled
    if ( $maintenance ) {
        $maintenance_file = get_template_directory() . '/maintenance.php';

        if ( file_exists( $maintenance_file ) ) {
            nocache_headers(); // Prevent caching of maintenance page
            include $maintenance_file;
            exit;
        } else {
            // Fallback message if file is missing (for debugging)
            wp_die( 'Maintenance mode active, but maintenance.php template not found.', 'Maintenance', array( 'response' => 503 ) );
        }
    }
}
add_action( 'template_redirect', 'rd3_maintenance_mode_redirect' );


// ===============================
// Customizer: Maintenance Mode Section
// ===============================
function rd3_customize_register( $wp_customize ) {

    $wp_customize->add_section( 'rd3_maintenance', array(
        'title'       => __( 'Maintenance Mode', 'your-text-domain' ),
        'priority'    => 30,
        'description' => __( 'Configure the maintenance splash page, countdown timer, messages, colors, and widgets shown to visitors.', 'your-text-domain' ),
    ) );

    // Enable/Disable Maintenance Mode
    $wp_customize->add_setting( 'rd3_maintenance_mode', array(
        'default'           => false,
        'sanitize_callback' => 'rd3_sanitize_checkbox',
    ) );
    $wp_customize->add_control( 'rd3_maintenance_mode', array(
        'type'    => 'checkbox',
        'section' => 'rd3_maintenance',
        'label'   => __( 'Enable Maintenance Mode', 'your-text-domain' ),
    ) );

    // Widgets link (custom control)
    class RD3_Maintenance_Widgets_Link extends WP_Customize_Control {
        public $type = 'link';
        public function render_content() {
            ?>
            <p>
                <strong><?php esc_html_e( 'Widgets:', 'your-text-domain' ); ?></strong><br>
                <a href="<?php echo esc_url( admin_url( 'widgets.php' ) ); ?>" target="_blank">
                    <?php esc_html_e( 'Edit Maintenance Page Widgets', 'your-text-domain' ); ?>
                </a>
            </p>
            <?php
        }
    }
    $wp_customize->add_setting( 'rd3_maintenance_widgets_link', array(
        'sanitize_callback' => 'esc_url_raw',
    ) );
    $wp_customize->add_control( new RD3_Maintenance_Widgets_Link( $wp_customize, 'rd3_maintenance_widgets_link', array(
        'section' => 'rd3_maintenance',
    ) ) );

    // Logo
    $wp_customize->add_setting( 'rd3_maintenance_logo', array(
        'sanitize_callback' => 'esc_url_raw',
    ) );
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'rd3_maintenance_logo', array(
        'label'    => __( 'Maintenance Logo', 'your-text-domain' ),
        'section'  => 'rd3_maintenance',
    ) ) );

    // Colors
    $wp_customize->add_setting( 'rd3_maintenance_bg', array(
        'default'           => '#f7f7f7',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'rd3_maintenance_bg', array(
        'label'   => __( 'Background Color', 'your-text-domain' ),
        'section' => 'rd3_maintenance',
    ) ) );

    $wp_customize->add_setting( 'rd3_maintenance_text', array(
        'default'           => '#333',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'rd3_maintenance_text', array(
        'label'   => __( 'Text Color', 'your-text-domain' ),
        'section' => 'rd3_maintenance',
    ) ) );

    // Title & Message
    $wp_customize->add_setting( 'rd3_maintenance_title', array(
        'default'           => __( 'Site Under Maintenance', 'your-text-domain' ),
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'rd3_maintenance_title', array(
        'type'    => 'text',
        'section' => 'rd3_maintenance',
        'label'   => __( 'Maintenance Page Title', 'your-text-domain' ),
    ) );

    $wp_customize->add_setting( 'rd3_maintenance_message', array(
        'default'           => __( 'We’re making improvements. Please check back soon.', 'your-text-domain' ),
        'sanitize_callback' => 'sanitize_textarea_field',
    ) );
    $wp_customize->add_control( 'rd3_maintenance_message', array(
        'type'    => 'textarea',
        'section' => 'rd3_maintenance',
        'label'   => __( 'Maintenance Page Message', 'your-text-domain' ),
    ) );

    // Countdown
    $wp_customize->add_setting( 'rd3_maintenance_countdown_enable', array(
        'default'           => true,
        'sanitize_callback' => 'rd3_sanitize_checkbox',
    ) );
    $wp_customize->add_control( 'rd3_maintenance_countdown_enable', array(
        'type'    => 'checkbox',
        'section' => 'rd3_maintenance',
        'label'   => __( 'Enable Countdown Timer', 'your-text-domain' ),
    ) );

    $wp_customize->add_setting( 'rd3_maintenance_countdown', array(
        'default'           => date( 'Y-m-d H:i:s', strtotime( '+3 days' ) ),
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'rd3_maintenance_countdown', array(
        'type'    => 'text',
        'section' => 'rd3_maintenance',
        'label'   => __( 'Countdown End Date (YYYY-MM-DD HH:MM:SS)', 'your-text-domain' ),
        'description' => __( 'Example: 2026-03-01 18:00:00', 'your-text-domain' ),
    ) );

    $wp_customize->add_setting( 'rd3_maintenance_back_message', array(
        'default'           => __( 'We are back!', 'your-text-domain' ),
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'rd3_maintenance_back_message', array(
        'type'    => 'text',
        'section' => 'rd3_maintenance',
        'label'   => __( 'Countdown Finished Message', 'your-text-domain' ),
    ) );

    $wp_customize->add_setting( 'rd3_maintenance_auto_reload', array(
        'default'           => true,
        'sanitize_callback' => 'rd3_sanitize_checkbox',
    ) );
    $wp_customize->add_control( 'rd3_maintenance_auto_reload', array(
        'type'    => 'checkbox',
        'section' => 'rd3_maintenance',
        'label'   => __( 'Auto Disable Maintenance When Countdown Ends', 'your-text-domain' ),
        'description' => __( '(No database writes – visitors just see the normal site after expiry)', 'your-text-domain' ),
    ) );
}
add_action( 'customize_register', 'rd3_customize_register' );