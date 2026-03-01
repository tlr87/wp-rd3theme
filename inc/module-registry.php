<?php
// Global registry of all modules
global $rd3_registered_modules;
$rd3_registered_modules = [];

// Function for modules to register themselves
function rd3_register_module($config) {
    global $rd3_registered_modules;

    if (empty($config['slug'])) {
        return;
    }

    $rd3_registered_modules[$config['slug']] = $config;
}

// Helper: get all registered modules
function rd3_get_registered_modules() {
    global $rd3_registered_modules;
    return $rd3_registered_modules;
}