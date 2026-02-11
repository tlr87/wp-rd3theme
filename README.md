# RD3 Starter Theme

**Version:** 1.0
**Author:** RD3 Tech

A lightweight, client-ready WordPress starter theme for small businesses, churches, and community organizations. Fully customizable via the WordPress Customizer.

---

## Features

### 1. Header

* Custom logo (upload via Customizer)
* **Logo alignment**: left, center, right
* **Header menu**: independent alignment (left, center, right)
* **Header background image** with cover, center, and no-repeat
* Optional overlay for text readability

### 2. Footer

* Footer menu with **independent alignment** (left, center, right)
* Toggle to **show/hide footer menu**
* **3-column widget area** for footer content
* Footer background image with cover, center, and no-repeat
* Optional overlay for text readability

### 3. Customizer Options

* Logo upload + alignment
* Header & footer menu alignment
* Primary and secondary colors
* Font selection (System, Arial, Roboto, Poppins, Lato)
* Header and footer background images
* Homepage layout: latest posts or full page
* Full-page selection for homepage if layout is set to page

### 4. Widgets

* Sidebar widget area
* Footer: 3 independent widget columns

### 5. Homepage Layout

* Show latest posts (default)
* Show a full page of content (selectable via Customizer)

### 6. Responsive & Clean

* Fully responsive header, menu, and footer
* Lightweight and minimal CSS for easy client editing
* Ready for future expansion

---

## How to Modify

### 1. Customizer

* Go to **Appearance → Customize → Branding Settings**
* Change **logo** and its alignment
* Set **header & footer menu alignment**
* Upload **header and footer background images**
* Adjust **primary/secondary colors** and **font family**
* Toggle **footer menu** visibility
* Select **homepage layout** (latest posts or full page)

### 2. Menus

* Header menu: assign under **Appearance → Menus → Manage Locations → Main Menu**
* Footer menu: assign under **Appearance → Menus → Manage Locations → Footer Menu**

### 3. Widgets

* Go to **Appearance → Widgets**
* Add content to **Sidebar** or **Footer Column 1-3**

### 4. CSS Customizations

* Additional styling can be added in `assets/css/main.css`
* Overlay adjustments for header/footer background images:

```css
.site-header::before,
.site-footer::before {
    content: "";
    position: absolute;
    top: 0; left: 0;
    width: 100%; height: 100%;
    background: rgba(0,0,0,0.3); /* adjust opacity/color */
    z-index: 0;
}
.site-header .container,
.site-footer .container {
    position: relative;
    z-index: 1; /* content above overlay */
}
```

### 5. Functions / Features

* `functions.php` contains all Customizer settings, dynamic CSS, menu registration, and widget areas.
* Header menu and logo alignment are **separate** for flexible layouts.
* Footer menu alignment and widget columns are fully configurable.

---

## Folder Structure

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

## Tips for Clients / Developers

* Use the **Customizer** for layout changes; avoids touching code.
* For advanced styling, edit `main.css`.
* Widgets and menus are fully flexible for content changes.
* Background images scale automatically (`cover`) for desktop and mobile.

---

## For Coders: Code Modification Guide

This section is for developers who want to **extend or modify theme behavior**.

### 1. Header / Footer

* `header.php` → modify logo structure, menu markup, or add custom elements.
* `footer.php` → modify footer widgets, menus, or add custom content blocks.

### 2. Customizer / Theme Options

* All Customizer settings are in `functions.php` → `rd3_branding_customizer()`
* Add new settings by copying the pattern:

```php
$wp_customize->add_setting('new_setting_name', ['default'=>'value']);
$wp_customize->add_control('new_setting_name', [
    'label'=>'New Setting',
    'section'=>'rd3_branding',
    'type'=>'text', // or radio, checkbox, color, etc.
]);
```

* Use `get_theme_mod('new_setting_name')` in templates to output the value.

### 3. Dynamic CSS

* All live styles are generated in `rd3_branding_styles()`
* To add new CSS rules based on Customizer values, append them here.

### 4. Widgets

* Register new widget areas in `rd3_widgets()`
* Add markup in `footer.php` or other template files.

### 5. JavaScript

* Custom JS can be added in `assets/js/main.js`
* Enqueued automatically by `rd3_assets()` in `functions.php`.

### 6. Homepage Layout

* Controlled by Customizer (`rd3_homepage_layout`)
* `index.php` should handle logic for either latest posts or a full page:

```php
$layout = get_theme_mod('rd3_homepage_layout', 'posts');
if ($layout === 'page') {
    $page_id = get_theme_mod('rd3_homepage_page', 0);
    echo apply_filters('the_content', get_post_field('post_content', $page_id));
} else {
    if (have_posts()) while(have_posts()) { the_post(); the_content(); }
}
```

### 7. Best Practices

* Avoid modifying core files directly if possible; use a child theme for major changes.
* Keep custom CSS in `main.css` or a separate file for easy updates.
* Use WordPress hooks (`add_action`, `add_filter`) to extend functionality without editing core theme files.
