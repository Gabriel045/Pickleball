<?php
define('theme_version', time());
function dd($data = '')
{
    if ($data != '') {
        echo "<pre>";
        print_r($data);
        echo "</pre>";
    } else {
        echo "No Text";
    }
}


// Adding theme styles and scripts
add_action('wp_enqueue_scripts', 'af_add_theme_scripts');

function af_add_theme_scripts()
{

    wp_enqueue_style(
        'theme-styles',
        get_template_directory_uri() . '/assets/styles/styles.css',
    );

    wp_enqueue_script(
        'theme-main-script',
        get_template_directory_uri() . '/assets/js/main.js',
        ['jquery'],
        theme_version,
        true
    );

    // Tailwind
    wp_enqueue_style(
        'tailwind',
        get_template_directory_uri() . '/src/output.css',
    );
}


//Register ACF blocks
include_once('acf-blocks.php');

add_theme_support('post-thumbnails');


//Add Menu 
function menu()
{
    register_nav_menus(array(
        'primary' => 'Primary Navigation',
        'an-extra-menu' => 'An Extra Menu',
    ));
}

add_action('after_setup_theme', 'menu');


//Register general settings page
if (function_exists('acf_add_options_page')) {

    if (function_exists('acf_add_options_page')) {

        acf_add_options_page(array(
            'page_title'    => 'Theme General Settings',
            'menu_title'    => 'Theme Settings',
            'menu_slug'     => 'theme-general-settings',
            'capability'    => 'edit_posts',
            'position' => '3.5',
            'redirect'      => false
        ));
    }
}