# RD3 Starter Theme

**Version:** 1.0  
**Author:** Tom Revill / RD3 Tech  
**Description:** A clean, modular WordPress starter theme built for flexibility, SEO, and fast development. Features include customizable branding, layout controls, maintenance mode, SEO modules, social sharing, and structured data support.

---

## Table of Contents
1. [Installation](#installation)
2. [Theme Features](#theme-features)
3. [Modules](#modules)
4. [Customizer Settings](#customizer-settings)
5. [Maintenance Mode](#maintenance-mode)
6. [SEO & Social](#seo--social)
7. [Dynamic Styling](#dynamic-styling)
8. [Widgets](#widgets)
9. [Recommended Plugins](#recommended-plugins)
10. [Support](#support)

---

## Installation

1. Copy the `rd3-starter` theme folder to your WordPress `wp-content/themes/` directory.  
2. Activate the theme via **Appearance → Themes**.  
3. Configure the theme via **Appearance → Customize**.  

---

## Theme Features

- Clean, modular structure for easy customization  
- Fully responsive design with horizontal and vertical layouts  
- Custom branding options (logo, colors, header/footer backgrounds)  
- Maintenance / Coming Soon mode  
- SEO, Open Graph, Twitter Cards, and JSON-LD structured data support  
- Widgetized footer, sidebar, and maintenance pages  
- Upload custom CSS for advanced styling  
- Breadcrumbs support  
- Enqueued assets with dependency management  

---

## Modules

All major features are organized in `/modules/` for clean separation:

- **seo.php** – Meta Enhancements (robots, canonical, author, publisher, generator, additional meta), Social Sharing & Open Graph / Twitter Card controls ,Structured Data (JSON-LD) configuration  
- **maintenance.php** – Maintenance page template  
- **branding.php** – Branding & dynamic styling  
- **layout.php** – Layout & custom CSS controls  

This modular setup makes it easy to **enable, extend, or replace** functionality without touching `functions.php`.

---

## Customizer Settings

**Branding**  
- Site logo, logo alignment, site title, tagline  
- Header and footer background images and colors  
- Breadcrumbs toggle  
- Sidebar position  

**Layout & Custom CSS**  
- Horizontal / vertical header layout  
- Upload a custom CSS file  
- Master enable/disable toggle  

**Maintenance Mode**  
- Enable/disable maintenance mode  
- Logo, background color, text color  
- Maintenance message and countdown timer  
- Auto reload when countdown ends  
- Widget area for maintenance page content  

**SEO Settings**  
- **Social Sharing**: Open Graph & Twitter cards  
- **Structured Data**: JSON-LD support for articles, products, organization, and website  
- **Meta Enhancements**: Robots, canonical URLs, author, publisher, generator, and additional meta  

---

## Maintenance Mode

- Template located at `/modules/maintenance.php`  
- Widgets can be assigned via **Appearance → Widgets → Maintenance Page Widgets**  
- Countdown timer auto-disables maintenance mode if configured  
- Works without JavaScript; pure PHP / HTML solution  

---

## SEO & Social

- Meta tags for description, Open Graph, Twitter Cards  
- JSON-LD structured data for enhanced search engine results  
- Custom meta enhancements (robots, canonical, author, publisher, generator)  
- Social sharing links configurable via Customizer  
- Full control via **Appearance → Customize → SEO Settings**  

---

## Dynamic Styling

- Background image/color, header/footer backgrounds  
- Primary and secondary color palette  
- Logo alignment  
- Header and footer menu alignment  
- Custom CSS uploads supported  

---

## Widgets

- Sidebar (`main-sidebar`)  
- Footer columns (`footer-col-1`, `footer-col-2`, `footer-col-3`)  
- Maintenance page (`maintenance-widgets`)  

---

## Recommended Plugins

- **Classic Editor** or **Gutenberg** (as needed)  


## Developer Guide

RD3 Starter Theme is designed to be **modular, maintainable, and extendable**. This guide provides an overview for developers working with the theme.

### 1. File Structure

rd3-starter/
├─ assets/
│ ├─ css/ # Main stylesheets and layout CSS
│ ├─ js/ # JavaScript assets
├─ modules/
│ ├─ branding.php # Branding & dynamic styles
│ ├─ layout.php # Layout & custom CSS
│ ├─ maintenance.php # Maintenance mode template
│ ├─ seo-meta.php # Meta enhancements (description, canonical, robots)
│ ├─ seo-social.php # Open Graph & Twitter Cards
│ ├─ seo-schema.php # Structured Data / JSON-LD
├─ functions.php # Includes modules and essential hooks
├─ header.php
├─ footer.php
├─ index.php
├─ style.css



---

## Support

For questions or help with the RD3 Starter Theme:  
- Email: tom@rd3tech.com  
- Website: [https://rd3tech.com](https://rd3tech.com)  

---

## Notes

- All modules are loaded from `/modules/` folder for easier maintenance.  
- Functions.php only contains **module includes** and essential hooks.  
- CSS/JS assets are enqueued properly for performance.  
- Fully compatible with WordPress 6.0+  

## Templates

- Maintenance mode template: /modules/maintenance.php
- Standard templates: header.php, footer.php, index.php
- Widgets available for sidebar, footer, maintenance page

## Customizer Guidelines

- Split into Branding, Layout, Maintenance, SEO
- Add new settings with proper sanitize_callback
- Add controls for text, color, image, checkbox, or radio types

Example:
```
$wp_customize->add_setting('rd3_custom_setting', [
    'default' => '',
    'sanitize_callback' => 'sanitize_text_field',
]);

$wp_customize->add_control('rd3_custom_setting', [
    'type' => 'text',
    'section' => 'rd3_layout_section',
    'label' => 'Custom Setting',
]);
```


SEO Integration
- /modules/seo.php: meta description, canonical, robots, Open Graph & Twitter Cards, structured data / JSON-LD

Enqueueing Scripts & Styles

- Use wp_enqueue_script() and wp_enqueue_style() in modules

Example:
```
wp_enqueue_style('rd3-custom', get_template_directory_uri() . '/assets/css/custom.css', ['rd3-main'], '1.0');
```

## Best Practices

Keep code modular in /modules/
Avoid editing functions.php for major features
Sanitize all user input
Use proper hooks, WordPress API functions, and enqueue assets correctly
Admin users bypass maintenance mode

## Extending the Theme

Add new modules for features like analytics, newsletter, or custom post types

Include the module in functions.php and hook into WordPress appropriately

This guide ensures developers can easily extend, maintain, and debug RD3 Starter Theme without breaking core functionality.