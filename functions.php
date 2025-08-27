<?php

/**
 * Composer Autoload
 */
require_once __DIR__ . '/vendor/autoload.php';

/**
 * Env
 * create an env.php file and add define('WP_ENVIRONMENT_TYPE', 'local');
 */
get_template_part('env');

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
get_template_part('src/remove-wp-bloat');
