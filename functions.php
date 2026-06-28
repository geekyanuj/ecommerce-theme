<?php


function anne_register_styles()
{

    wp_enqueue_style(
        'main-css',
        get_template_directory_uri() . '/assets/css/main.css',
        [],
        wp_get_theme()->get('Version')
    );

}

add_action('wp_enqueue_scripts', 'anne_register_styles');


function anne_register_scripts()
{

    wp_enqueue_script(
        'main-js',
        get_template_directory_uri() . '/assets/js/main.js',
        array(),
        '0.0.1',
        array('in_footer' => true)
    );

}

add_action('wp_enqueue_scripts', 'anne_register_scripts');





