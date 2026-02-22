<?php
/**
 * Register theme allow for CSS uploads to the theme 
 * 
 * @package Your_Theme_Name
 */


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