<?php

/**
 * Prevent gutenberg-related styles and scripts
 */
function remove_block_library_css()
{
    wp_dequeue_style('wp-block-library');
    wp_dequeue_style('wp-block-library-theme');
    wp_dequeue_style('global-styles');
}
add_action('wp_enqueue_scripts', 'remove_block_library_css', 100);

if (! is_admin()) {
    function dequeue_gutenberg_deps()
    {
        wp_dequeue_script('wp-hooks');
        wp_deregister_script('wp-hooks');

        wp_dequeue_script('wp-i18n');
        wp_deregister_script('wp-i18n');
    }

    add_action('wp_enqueue_scripts', 'dequeue_gutenberg_deps', 100);
}

/**
 * Remove clasic theme
 */
function dequeue_classic_theme_styles()
{
    wp_dequeue_style('classic-theme-styles');
}
add_action('wp_enqueue_scripts', 'dequeue_classic_theme_styles', 100);

/**
 * Prevent emoji from loading
 */
function disable_wp_emojicons()
{
    remove_action('wp_print_styles', 'print_emoji_styles');
    remove_action('wp_head', 'print_emoji_detection_script', 7);
    remove_action('admin_print_scripts', 'print_emoji_detection_script');
    remove_action('admin_print_styles', 'print_emoji_styles');
    remove_filter('the_content_feed', 'wp_staticize_emoji');
    remove_filter('comment_text_rss', 'wp_staticize_emoji');
    remove_filter('wp_mail', 'wp_staticize_emoji_for_email');

    add_filter('tiny_mce_plugins', function ($plugins) {
        return is_array($plugins) ? array_diff($plugins, ['wpemoji']) : [];
    });

    add_filter('emoji_svg_url', '__return_false');
}
add_action('init', 'disable_wp_emojicons');

/**
 * Remove contact form 7
 */
function remove_cf7_styles()
{
    wp_dequeue_style('contact-form-7');
    wp_deregister_style('contact-form-7');
}
add_action('wp_enqueue_scripts', 'remove_cf7_styles', 100);

/**
 * Remove layout shift
 */
add_action('wp_enqueue_scripts', function () {
    remove_action('wp_print_styles', 'wp_print_imagesizes_inline_style', 999);
}, 9);

/**
 * Remove jQuery
 */
add_action('wp_enqueue_scripts', function () {
    if (! is_admin()) {
        wp_deregister_script('jquery');
    }
});

/**
 * Remove RSS
 */
function disable_feed() {
    wp_die(__('No feed available. Please visit the homepage.'));
}
add_action('do_feed', 'disable_feed', 1);
add_action('do_feed_rdf', 'disable_feed', 1);
add_action('do_feed_rss', 'disable_feed', 1);
add_action('do_feed_rss2', 'disable_feed', 1);
add_action('do_feed_atom', 'disable_feed', 1);

/**
 * Throttle Heartbeat API
 */
add_filter('heartbeat_settings', function ($settings) {
    $settings['interval'] = 120; // 1 request per minute
    return $settings;
});
