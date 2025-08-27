<?php

class StarterSite extends Timber\Site
{
    public function __construct()
    {
        add_action('after_setup_theme', [$this, 'theme_supports']);
        add_filter('timber/context', [$this, 'add_to_context']);
        add_filter('timber/twig/functions', [$this, 'add_functions_to_twig']);
        add_action('init', [$this, 'register_widgets']);

        parent::__construct();
    }

    public function register_widgets(): void
    {
        //
    }

    public function add_to_context($context): array
    {
        $site = $this;
        $option = wp_load_alloptions();
        $theme = wp_get_theme();
        $body_class = implode(' ', get_body_class());

        $main_css = wp_get_environment_type() === 'production'
            ? get_stylesheet_directory() . '/assets/css/main.min.css'
            : get_stylesheet_directory() . '/assets/css/main.css';

        $asset_version = file_exists($main_css) ? filemtime($main_css) : time();

        return compact(
            'site',
            'option',
            'theme',
            'body_class',
            'asset_version',
        );
    }

    public function theme_supports(): void
    {
        add_theme_support(
            'html5',
            [
                'comment-form',
                'comment-list',
                'gallery',
                'caption',
            ]
        );

        add_theme_support('post-thumbnails');
        add_theme_support('menus');
    }

    public function add_functions_to_twig(array $functions): array
    {
        $additional_functions = [
            'asset' => ['callable' => function (string $string): string {
                return get_stylesheet_directory_uri() . '/' . ltrim($string, '/');
            }],
            'get_option' => ['callable' => 'get_option'],
            'settings_fields' => ['callable' => 'settings_fields'],
        ];

        return array_merge($functions, $additional_functions);
    }
}

new StarterSite;
