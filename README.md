# RD3 Starter Theme

**Version:** 1.0  
**Author:** Tom Revill / RD3 Tech  

**Description:**  
A clean, modular WordPress starter theme built for flexibility, SEO, and fast development.  
Features include customizable branding, layout controls, maintenance mode, SEO modules, social sharing, structured data support, and extended developer-focused features.

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
9. [For Developers](#for-developers)
10. [Recommended Plugins](#recommended-plugins)
11. [Support](#support)

---

## Installation

1. Copy the `rd3-starter` theme folder to your WordPress:
   ```
   /wp-content/themes/
   ```

2. Activate the theme:
   - Go to **Appearance → Themes**
   - Click **Activate**

3. Configure settings:
   - Go to **Appearance → Customize**

---

## Theme Features

- Clean, modular structure for easy customization  
- Fully responsive design (horizontal & vertical layouts)  
- Custom branding (logo, colors, header/footer backgrounds)  
- Maintenance / Coming Soon mode  
- SEO, Open Graph, Twitter Cards, JSON-LD structured data  
- Widgetized footer, sidebar, and maintenance areas  
- Custom CSS support for advanced styling  
- Breadcrumbs support  
- Properly enqueued assets with dependency management  

---

## Modules

All major features are located in `/modules/`:

- `seo-meta.php` – Meta enhancements (description, canonical, robots)  
- `seo-social.php` – Open Graph & Twitter Cards  
- `seo-schema.php` – Structured data (JSON-LD)  
- `branding.php` – Branding and dynamic styles  
- `layout.php` – Layout controls and custom CSS  
- `maintenance.php` – Maintenance mode template  

This modular approach allows you to enable, extend, or replace functionality without modifying `functions.php`.

---

## Customizer Settings

### Branding
- Logo, logo alignment, site title, tagline  
- Header & footer background images and colors  
- Breadcrumb toggle  
- Sidebar position  

### Layout & Custom CSS
- Horizontal / vertical header layout  
- Upload custom CSS  
- Global enable/disable toggle  

### Maintenance Mode
- Enable/disable maintenance mode  
- Custom logo, background, and text colors  
- Maintenance message and countdown timer  
- Auto-disable when countdown ends  
- Widget area for content  

### SEO Settings
- Open Graph & Twitter Cards  
- JSON-LD structured data  
- Robots, canonical URLs, author, publisher, generator meta  
- Social sharing controls  

---

## Maintenance Mode

- Template: `/modules/maintenance.php`  
- Widgets: Assign via **Appearance → Widgets → Maintenance Page Widgets**  
- Countdown timer can auto-disable maintenance mode  
- Works without JavaScript (pure PHP/HTML)  
- Admin users bypass maintenance mode  

---

## SEO & Social

- Meta description and SEO enhancements  
- Open Graph and Twitter Card support  
- JSON-LD structured data for:
  - Articles  
  - Products  
  - Organization  
  - Website  
- Custom meta tags:
  - Robots  
  - Canonical  
  - Author  
  - Publisher  

---

## Dynamic Styling

- Background images and colors  
- Header and footer styling  
- Primary & secondary color palette  
- Logo alignment  
- Menu alignment controls  
- Custom CSS uploads  

---

## Widgets

Available widget areas:

- Sidebar (`main-sidebar`)  
- Footer:
  - `footer-col-1`  
  - `footer-col-2`  
  - `footer-col-3`  
- Maintenance page (`maintenance-widgets`)  

---

## For Developers

RD3 Starter Theme is designed to be modular, maintainable, and extendable. This guide provides an overview for developers working with the theme.

---

### 📁 File Structure

```
rd3-starter/
├─ assets/
│  ├─ css/        # Main stylesheets and layout CSS
│  ├─ js/         # JavaScript assets
├─ modules/
│  ├─ branding.php
│  ├─ layout.php
│  ├─ maintenance.php
│  ├─ seo-meta.php
│  ├─ seo-social.php
│  ├─ seo-schema.php
├─ functions.php   # Includes modules and essential hooks
├─ header.php
├─ footer.php
├─ index.php
├─ style.css
```  

---

### 🧩 Modules Overview

- All modules are loaded from the `/modules/` folder for easier maintenance  
- `functions.php` only contains module includes and essential hooks  
- Assets are enqueued properly for performance  
- Fully compatible with WordPress 6.0+  

---

### 🎨 Adding Custom CSS

#### Option 1: Enqueue Custom CSS

```php
wp_enqueue_style(
    'rd3-custom',
    get_template_directory_uri() . '/assets/css/custom.css',
    ['rd3-main'],
    '1.0'
);
```

#### Option 2: Add via Customizer
- Go to **Appearance → Customize**
- Add CSS in the custom CSS section

---

### 🧱 Adding a Module

1. Create a new file in `/modules/`:
   ```
   /modules/analytics.php
   ```

2. Add your code:
   ```php
   <?php
   add_action('wp_head', function() {
       echo '<!-- Analytics Module Loaded -->';
   });
   ```

3. Include it in `functions.php`:
   ```php
   require get_template_directory() . '/modules/analytics.php';
   ```

---

### 🛠 Customizer Guidelines

- Split into: Branding, Layout, Maintenance, SEO  
- Add settings with proper `sanitize_callback`  

Example:

```php
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

---

### 🔗 SEO Integration

- `/modules/seo-meta.php`  
  - Meta description, canonical, robots  
- `/modules/seo-social.php`  
  - Open Graph & Twitter Cards  
- `/modules/seo-schema.php`  
  - Structured data (JSON-LD)  

---

### ⚙️ Enqueueing Scripts & Styles

Use WordPress enqueue functions inside modules:

```php
wp_enqueue_style(
    'rd3-custom',
    get_template_directory_uri() . '/assets/css/custom.css',
    ['rd3-main'],
    '1.0'
);
```

---

### 🧠 Best Practices

- Keep code modular in `/modules/`  
- Avoid editing `functions.php` for major features  
- Sanitize all user input  
- Use WordPress APIs and hooks  
- Enqueue assets properly  
- Admin users bypass maintenance mode  

---

### 🔧 Extending the Theme

You can extend the theme by adding modules for:

- Analytics  
- Newsletter integration  
- Custom post types  
- Additional layouts or features  

Include modules in `functions.php` and hook into WordPress appropriately.

---

## Recommended Plugins

- Classic Editor (if needed)  
- Gutenberg (block editor)  
- Any SEO plugin (optional)  

---

## Support

For questions or help with the RD3 Starter Theme:

- Email: tom@rd3tech.com  
- Website: https://rd3tech.com  

---

## Notes

- All modules are loaded from `/modules/`  
- `functions.php` only contains module includes and essential hooks  
- CSS/JS assets are enqueued properly for performance  
- Fully compatible with WordPress 6.0+  
- Templates:
  - `/modules/maintenance.php`  
  - `header.php`, `footer.php`, `index.php`  
- Widgets available for sidebar, footer, and maintenance page  

This guide ensures developers can easily extend, maintain, and debug RD3 Starter Theme without breaking core functionality.
