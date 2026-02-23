<?php
/**
 * RD3 SEO + Social Sharing Module
 * Adds SEO meta tags, Open Graph, Twitter Cards, and Customizer options
 */

if (!function_exists('rd3_social_customizer')) :
function rd3_social_customizer($wp_customize) {

    // ------------------------------
    // Section: SEO Settings
    // ------------------------------
    $wp_customize->add_section('rd3_seo', [
        'title' => __('SEO Settings', 'rd3starter'),
        'priority' => 32,
        'description' => 'Set default meta tags, social sharing settings, Open Graph, and Twitter cards.',
    ]);

    // Meta Description
    $wp_customize->add_setting('seo_meta_description', [
        'default' => get_bloginfo('description'),
        'sanitize_callback' => 'sanitize_textarea_field',
    ]);
    $wp_customize->add_control('seo_meta_description', [
        'label' => 'Default Meta Description',
        'section' => 'rd3_seo',
        'type' => 'textarea',
    ]);

    // Default OG Title
    $wp_customize->add_setting('social_default_title', [
        'default' => get_bloginfo('name'),
        'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control('social_default_title', [
        'label' => 'Default OG Title',
        'section' => 'rd3_seo',
        'type' => 'text',
    ]);

    // Default OG Description
    $wp_customize->add_setting('social_default_description', [
        'default' => get_bloginfo('description'),
        'sanitize_callback' => 'sanitize_textarea_field',
    ]);
    $wp_customize->add_control('social_default_description', [
        'label' => 'Default OG Description',
        'section' => 'rd3_seo',
        'type' => 'textarea',
    ]);

    // Default Social Image
    $wp_customize->add_setting('social_default_image', [
        'sanitize_callback' => 'esc_url_raw',
    ]);
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'social_default_image', [
        'label' => 'Default Social Image',
        'section' => 'rd3_seo',
        'settings' => 'social_default_image',
    ]));

    // Twitter Card Type
    $wp_customize->add_setting('social_twitter_card_type', [
        'default' => 'summary_large_image',
        'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control('social_twitter_card_type', [
        'label' => 'Twitter Card Type',
        'section' => 'rd3_seo',
        'type' => 'select',
        'choices' => [
            'summary' => 'Summary',
            'summary_large_image' => 'Summary Large Image',
        ],
    ]);

    // Twitter Site Handle
    $wp_customize->add_setting('social_twitter_site', [
        'default' => '@yourhandle',
        'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control('social_twitter_site', [
        'label' => 'Twitter Site Username',
        'section' => 'rd3_seo',
        'type' => 'text',
    ]);

    // OG Type
    $wp_customize->add_setting('social_og_type', [
        'default' => 'website',
        'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control('social_og_type', [
        'label' => 'OG Type',
        'section' => 'rd3_seo',
        'type' => 'select',
        'choices' => [
            'website' => 'Website',
            'article' => 'Article',
        ],
    ]);

}
endif;
add_action('customize_register', 'rd3_social_customizer');


// ------------------------------
// Output Meta Tags in <head>
// ------------------------------
if (!function_exists('rd3_social_meta_tags')) :
function rd3_social_meta_tags() {
    if (is_singular()) {
        global $post;
        $title = get_the_title($post->ID) ?: get_theme_mod('social_default_title');
        $desc = get_the_excerpt($post->ID) ?: get_theme_mod('social_default_description');
        $url = get_permalink($post->ID);
        $image = get_the_post_thumbnail_url($post->ID, 'full') ?: get_theme_mod('social_default_image');
    } else {
        $title = get_theme_mod('social_default_title');
        $desc = get_theme_mod('social_default_description');
        $url = home_url();
        $image = get_theme_mod('social_default_image');
    }

    $twitter_card = get_theme_mod('social_twitter_card_type', 'summary_large_image');
    $twitter_site = get_theme_mod('social_twitter_site', '@yourhandle');
    $og_type = get_theme_mod('social_og_type', 'website');

    echo "\n<!-- RD3 Social & SEO Meta Tags -->\n";
    echo '<meta name="description" content="'.esc_attr($desc).'">'."\n";

    echo '<meta property="og:title" content="'.esc_attr($title).'">'."\n";
    echo '<meta property="og:description" content="'.esc_attr($desc).'">'."\n";
    echo '<meta property="og:url" content="'.esc_url($url).'">'."\n";
    echo '<meta property="og:image" content="'.esc_url($image).'">'."\n";
    echo '<meta property="og:type" content="'.esc_attr($og_type).'">'."\n";

    echo '<meta name="twitter:card" content="'.esc_attr($twitter_card).'">'."\n";
    echo '<meta name="twitter:title" content="'.esc_attr($title).'">'."\n";
    echo '<meta name="twitter:description" content="'.esc_attr($desc).'">'."\n";
    echo '<meta name="twitter:image" content="'.esc_url($image).'">'."\n";
    echo '<meta name="twitter:site" content="'.esc_attr($twitter_site).'">'."\n";
}
endif;
add_action('wp_head', 'rd3_social_meta_tags');


if (!function_exists('rd3_schema_customizer')) :
function rd3_schema_customizer($wp_customize) {

    // ------------------------------
    // Section: Structured Data
    // ------------------------------
    $wp_customize->add_section('rd3_schema', [
        'title' => __('Structured Data / Schema', 'rd3starter'),
        'priority' => 33,
        'description' => 'Add Schema.org structured data to improve SEO and rich snippets.',
    ]);

    // Organization Name
    $wp_customize->add_setting('schema_org_name', [
        'default' => get_bloginfo('name'),
        'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control('schema_org_name', [
        'label' => 'Organization / Website Name',
        'section' => 'rd3_schema',
        'type' => 'text',
    ]);

    // Organization URL
    $wp_customize->add_setting('schema_org_url', [
        'default' => home_url(),
        'sanitize_callback' => 'esc_url_raw',
    ]);
    $wp_customize->add_control('schema_org_url', [
        'label' => 'Website URL',
        'section' => 'rd3_schema',
        'type' => 'text',
    ]);

    // Logo
    $wp_customize->add_setting('schema_org_logo', [
        'sanitize_callback' => 'esc_url_raw',
    ]);
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'schema_org_logo', [
        'label' => 'Logo URL',
        'section' => 'rd3_schema',
        'settings' => 'schema_org_logo',
    ]));

    // Social Profiles
    $wp_customize->add_setting('schema_org_social', [
        'default' => '',
        'sanitize_callback' => 'sanitize_textarea_field',
    ]);
    $wp_customize->add_control('schema_org_social', [
        'label' => 'Social Profiles (one URL per line)',
        'section' => 'rd3_schema',
        'type' => 'textarea',
    ]);
}
endif;
add_action('customize_register', 'rd3_schema_customizer');


// ------------------------------
// Output JSON-LD Structured Data
// ------------------------------
if (!function_exists('rd3_output_schema')) :
function rd3_output_schema() {

    $name = get_theme_mod('schema_org_name', get_bloginfo('name'));
    $url = get_theme_mod('schema_org_url', home_url());
    $logo = get_theme_mod('schema_org_logo', '');
    $social_raw = get_theme_mod('schema_org_social', '');
    $social_profiles = array_filter(array_map('trim', explode("\n", $social_raw)));

    $data = [
        '@context' => 'https://schema.org',
        '@type' => 'Organization',
        'name' => $name,
        'url' => $url,
    ];

    if ($logo) {
        $data['logo'] = $logo;
    }

    if ($social_profiles) {
        $data['sameAs'] = $social_profiles;
    }

    echo "\n<!-- RD3 JSON-LD Schema -->\n";
    echo '<script type="application/ld+json">'.wp_json_encode($data, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT).'</script>'."\n";
}
endif;
add_action('wp_head', 'rd3_output_schema');



function rd3_seo_meta_customizer($wp_customize) {

    $wp_customize->add_section('rd3_seo_meta', [
        'title' => __('Meta Enhancements', 'rd3starter'),
        'priority' => 40,
        'description' => 'Advanced meta tags for SEO, indexing, canonical URLs, and custom meta.',
    ]);

    // Robots
    $wp_customize->add_setting('rd3_meta_robots', [
        'default' => 'index, follow',
        'sanitize_callback' => 'sanitize_text_field'
    ]);
    $wp_customize->add_control('rd3_meta_robots', [
        'label' => 'Robots Meta',
        'section' => 'rd3_seo_meta',
        'type' => 'text',
        'description' => 'Example: index, follow or noindex, nofollow'
    ]);

    // Canonical URL
    $wp_customize->add_setting('rd3_meta_canonical', [
        'default' => '',
        'sanitize_callback' => 'esc_url_raw'
    ]);
    $wp_customize->add_control('rd3_meta_canonical', [
        'label' => 'Canonical URL',
        'section' => 'rd3_seo_meta',
        'type' => 'url'
    ]);

    // Author
    $wp_customize->add_setting('rd3_meta_author', [
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field'
    ]);
    $wp_customize->add_control('rd3_meta_author', [
        'label' => 'Author',
        'section' => 'rd3_seo_meta',
        'type' => 'text'
    ]);

    // Publisher
    $wp_customize->add_setting('rd3_meta_publisher', [
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field'
    ]);
    $wp_customize->add_control('rd3_meta_publisher', [
        'label' => 'Publisher',
        'section' => 'rd3_seo_meta',
        'type' => 'text'
    ]);

    // Generator
    $wp_customize->add_setting('rd3_meta_generator', [
        'default' => 'RD3 Starter Theme 1.0',
        'sanitize_callback' => 'sanitize_text_field'
    ]);
    $wp_customize->add_control('rd3_meta_generator', [
        'label' => 'Generator',
        'section' => 'rd3_seo_meta',
        'type' => 'text'
    ]);

    // Additional Meta
    $wp_customize->add_setting('rd3_meta_additional', [
        'default' => '',
        'sanitize_callback' => 'wp_kses_post'
    ]);
    $wp_customize->add_control('rd3_meta_additional', [
        'label' => 'Additional Meta',
        'section' => 'rd3_seo_meta',
        'type' => 'textarea',
        'description' => 'Enter any additional <meta> HTML tags to include in <head>.'
    ]);
}
add_action('customize_register', 'rd3_seo_meta_customizer');

// ===============================
// Output Meta Tags
// ===============================
function rd3_output_seo_meta() {
    $robots = get_theme_mod('rd3_meta_robots', 'index, follow');
    $canonical = get_theme_mod('rd3_meta_canonical', '');
    $author = get_theme_mod('rd3_meta_author', '');
    $publisher = get_theme_mod('rd3_meta_publisher', '');
    $generator = get_theme_mod('rd3_meta_generator', 'RD3 Starter Theme 1.0');
    $additional = get_theme_mod('rd3_meta_additional', '');

    echo "\n<!-- RD3 SEO Meta Enhancements -->\n";

    if ($robots) echo '<meta name="robots" content="'.esc_attr($robots).'">'."\n";
    if ($canonical) echo '<link rel="canonical" href="'.esc_url($canonical).'">'."\n";
    if ($author) echo '<meta name="author" content="'.esc_attr($author).'">'."\n";
    if ($publisher) echo '<meta name="publisher" content="'.esc_attr($publisher).'">'."\n";
    if ($generator) echo '<meta name="generator" content="'.esc_attr($generator).'">'."\n";
    if ($additional) echo $additional . "\n";

    echo "<!-- /RD3 SEO Meta Enhancements -->\n";
}
add_action('wp_head', 'rd3_output_seo_meta');