# RD3 Starter Theme

**Version:** 1.0  
**Author:** RD3 Tech  

A lightweight, client-ready WordPress starter theme designed for small businesses, churches, and community organisations. It focuses on simplicity, flexibility, and easy customisation through the WordPress Customizer.

---

## Overview

RD3 Starter Theme provides a clean foundation for building professional WordPress websites without unnecessary complexity. It allows non-technical users to manage branding, layout, and content while giving developers a solid base for extension.

---

## Features

### Header

- Custom logo (via Customizer)
- Logo alignment: left, centre, right
- Independent header menu alignment
- Header background image (cover, centre, no-repeat)
- Optional overlay for improved readability

### Footer

- Footer menu with independent alignment
- Toggle to show/hide footer menu
- Three-column widget area
- Footer background image support
- Optional overlay

### Customizer Options

- Logo upload and alignment
- Header and footer menu alignment
- Primary and secondary colours
- Font selection (System, Arial, Roboto, Poppins, Lato)
- Header and footer background images
- Homepage layout selection
- Page selection for full-page homepage

### Widgets

- Sidebar widget area
- Three independent footer widget columns

### Homepage Layout

- Latest posts (default)
- Full-page content (selectable)

### Performance & Design

- Fully responsive layout
- Minimal, lightweight CSS
- Easy to customise
- Ready for future expansion

---

## Installation

1. Download or clone this repository.
2. Upload the folder to `/wp-content/themes/`.
3. In WordPress Admin, go to **Appearance → Themes**.
4. Activate **RD3 Starter Theme**.
5. Configure via **Appearance → Customize**.

---

## Customisation Guide

### Customizer

Navigate to:

```
Appearance → Customize → Branding Settings
```

From here you can:

- Upload and align the logo
- Set menu alignment
- Configure colours and fonts
- Upload background images
- Toggle footer menu
- Select homepage layout

### Menus

- Header menu:  
  `Appearance → Menus → Manage Locations → Main Menu`

- Footer menu:  
  `Appearance → Menus → Manage Locations → Footer Menu`

### Widgets

Go to:

```
Appearance → Widgets
```

Configure:

- Sidebar
- Footer Column 1–3

---

## CSS Customisation

Additional styling can be added in:

```
assets/css/main.css
```

Example overlay styling:

```css
.site-header::before,
.site-footer::before {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0,0,0,0.3);
    z-index: 0;
}

.site-header .container,
.site-footer .container {
    position: relative;
    z-index: 1;
}
```

---

## Theme Structure

```
rd3-starter-theme/
├── assets/
│   ├── css/
│   │   └── main.css
│   └── js/
│       └── main.js
├── footer.php
├── functions.php
├── header.php
├── index.php
├── style.css
└── screenshot.png
```

---

## Developer Guide

This section is for extending or modifying theme behaviour.

### Header & Footer

- `header.php` – Logo, menus, and header elements
- `footer.php` – Widgets, menus, and footer blocks

### Customizer Settings

All Customizer logic is in:

```
functions.php → rd3_branding_customizer()
```

To add a new setting:

```php
$wp_customize->add_setting('new_setting_name', [
    'default' => 'value'
]);

$wp_customize->add_control('new_setting_name', [
    'label' => 'New Setting',
    'section' => 'rd3_branding',
    'type' => 'text'
]);
```

Retrieve values using:

```php
get_theme_mod('new_setting_name');
```

### Dynamic Styles

Generated in:

```
rd3_branding_styles()
```

Append new rules here when adding Customizer options.

### Widgets

- Registered in `rd3_widgets()`
- Output in `footer.php` or templates

### JavaScript

Add custom scripts in:

```
assets/js/main.js
```

Automatically enqueued via `rd3_assets()`.

### Homepage Logic

Controlled by `rd3_homepage_layout`:

```php
$layout = get_theme_mod('rd3_homepage_layout', 'posts');

if ($layout === 'page') {
    $page_id = get_theme_mod('rd3_homepage_page', 0);
    echo apply_filters(
        'the_content',
        get_post_field('post_content', $page_id)
    );
} else {
    if (have_posts()) {
        while (have_posts()) {
            the_post();
            the_content();
        }
    }
}
```

---

## Best Practices

- Use the Customizer for most changes
- Create a child theme for major customisation
- Keep custom CSS organised
- Use WordPress hooks where possible
- Avoid editing core files directly

---

## License

This project is licensed under **Creative Commons Attribution-NonCommercial (CC BY-NC)**.  
Commercial use requires permission from RD3 Tech.

---

## Support

For support, customisation, or development services, contact:

**RD3 Tech**  
Website: https://rd3tech.com
