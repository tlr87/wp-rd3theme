<?php
function rd3_modules_customizer($wp_customize) {
    $wp_customize->add_section('rd3_modules_section', [
        'title' => __('Theme Modules', 'rd3starter'),
        'priority' => 40,
    ]);

    $modules = rd3_get_registered_modules();

    foreach ($modules as $slug => $module) {
        $default = $module['enabled_by_default'] ?? true;

        $wp_customize->add_setting("rd3_module_$slug", [
            'default' => $default,
            'sanitize_callback' => 'wp_validate_boolean',
        ]);

        $wp_customize->add_control("rd3_module_$slug", [
            'label' => $module['name'],
            'section' => 'rd3_modules_section',
            'type' => 'checkbox',
        ]);
    }
}
add_action('customize_register', 'rd3_modules_customizer');