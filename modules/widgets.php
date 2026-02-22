<?php
/**
 * Register theme sidebars / widget areas
 *
 * @package Your_Theme_Name
 */


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

