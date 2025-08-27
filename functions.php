<?php

/**
 * Composer Autoload
 */
require_once __DIR__ . '/vendor/autoload.php';

/**
 * Timber
 */
Timber\Timber::init();

get_template_part('src/timber/timber');

if (class_exists('Timber')) {
    get_template_part('src/timber/starter');
}

/**
 * Remove/Disable WP Bloats
 */
get_template_part('src/remove-wp-bloats');
