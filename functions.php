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





add_action('after_setup_theme', function () {
    add_theme_support('woocommerce');
});


// ffor product badges, only allow certain tags to be used as badges
function get_allowed_badge_tags()
{
    return [
        'bestseller',
        'organic',
        'new-arrival',
        'premium',
        'limited-edition',
        'hot',
        'sale',
        'save 10%',
        'save 20%',
        'save 30%',
        'save 40%',
        'deal',
        'exclusive',
        'eco-friendly',
        'handmade',
        'gluten-free',
        'vegan',
        'fair-trade',
    ];
}

add_action('admin_notices', function () {

    $screen = get_current_screen();

    if (!$screen)
        return;

    // All Products page
    $is_products_list = (
        $screen->base === 'edit' &&
        $screen->post_type === 'product'
    );

    // Product Tags page
    $is_product_tags = (
        $screen->base === 'edit-tags' &&
        $screen->taxonomy === 'product_tag'
    );

    if (!$is_products_list && !$is_product_tags) {
        return;
    }

    echo '<div class="notice notice-info"><p>';
    echo '<strong>Badge Tags Rule:</strong> Only these tags will appear as product badges:<br>';
    echo '<code>' . implode(', ', get_allowed_badge_tags()) . '</code>';
    echo '</p></div>';
});