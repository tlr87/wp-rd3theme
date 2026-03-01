<?php
function rd3_boot_modules() {
    $modules_dir = get_template_directory() . '/modules/';
    foreach (glob($modules_dir . '*/*.php') as $file) {
        require_once $file; // Module registers itself here
    }
}
add_action('after_setup_theme', 'rd3_boot_modules', 5);

// Initialize modules (attach hooks and only load enabled modules)
function rd3_init_modules() {
    $modules = rd3_get_registered_modules();

    foreach ($modules as $slug => $module) {
        if (!get_theme_mod("rd3_module_$slug", $module['enabled_by_default'] ?? true)) {
            continue; // skip disabled
        }

        if (!empty($module['hooks'])) {
            foreach ($module['hooks'] as $hook) {
                add_action($hook, function() use ($slug) {
                    do_action("rd3_render_module_$slug");
                });
            }
        }

        // Optional: load module assets
        if (!empty($module['styles'])) {
            foreach ($module['styles'] as $style) {
                wp_enqueue_style("rd3_module_{$slug}_css", get_template_directory_uri() . "/modules/$slug/$style");
            }
        }
        if (!empty($module['scripts'])) {
            foreach ($module['scripts'] as $script) {
                wp_enqueue_script("rd3_module_{$slug}_js", get_template_directory_uri() . "/modules/$slug/$script", [], false, true);
            }
        }
    }
}
add_action('init', 'rd3_init_modules');