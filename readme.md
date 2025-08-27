# SMC WP Starter

A lightweight WordPress starter kit with Timber and ACF Pro integration.
This kit provides a clean foundation for building custom WordPress themes with modern workflows and minimal bloat.

---

## Features

-   Timber integration for Twig-based templating
-   ACF Pro support with Options Pages
-   Asset and script cleanup (removes common WP bloat)
-   Support for environment-specific configs (`WP_ENVIRONMENT_TYPE`)
-   Custom helpers and global variables for Twig

---

## Suggested plug-ins to install

Install the following plugins for full functionality:

-   [Classic Editor](https://wordpress.org/plugins/classic-editor/)
-   [Classic Widgets](https://wordpress.org/plugins/classic-widgets/)
-   [Advanced Custom Fields Pro](https://www.advancedcustomfields.com/pro/)

---

## Theme Settings

-   Use ACF's **Options Page** to configure global settings.
-   Access option fields in Twig using the helper:

```twig
{{ get_option('field_name') }}
```

## Environment Setup

-   Create an env.php file at the project root.
-   Define the environment type constant:

```php
<?php
define('WP_ENVIRONMENT_TYPE', 'local');
```

-   Use in theme code:

```php
if (wp_get_environment_type() === 'production') {
    // Production-only logic
}
```

## Global Variables

All global variables should be declared inside the `add_to_context` method located in:

```bash
src/timber/starter.php
```

## Helper Methods for Twig

To register new helper functions for Twig, use the `add_functions_to_twig` method inside:

```bash
src/timber/starter.php
```

## File Structure

```bash
theme/
├── assets/
│   └── images/ # images for the theme
├── src/
│   └── timber/
│       └── starter.php # Core theme setup
│       └── timber.php # Timber
├── resources/
│   └── css/ # Twig templates
│       └── main.css # Tailwind main css file
│   └── views # Twig templates
├── functions.php
├── env.php # Environment configuration (not committed)
└── style.css
```
