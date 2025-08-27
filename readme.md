# SMC WP Starter

## Suggested plug-ins to install

-   Classic Editor
-   Classic Widget
-   ACF Pro

## Theme Settings

-   Use ACF's options page and fields to setup settings page
-   use `get_option` helper method in twig to get the field value

## Setting up env

Create an `env.php` at the project directory and define a new constant with the key of `WP_ENVIRONMENT_TYPE` and value of `local`

## Global variables

All global variables should be declared inside `add_to_context` method inside `src/timber/starter.php`

## Helper methods for twig

To register new helper method for twig, use the `add_functions_to_twig` method inside `src/timber/starter.php`
