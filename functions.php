<?php

/**
 * ==========================================================================
 * ANNEO Fresh Theme Functions
 * ==========================================================================
 * This file contains:
 * - Theme asset loading (CSS & JavaScript)
 * - WooCommerce support
 * - Product badge helpers
 * - AJAX Cart
 * - AJAX Login
 * - AJAX Signup
 * ==========================================================================
 */


/* ==========================================================================
   Theme Styles & Scripts
   ========================================================================== */

function anne_register_assets()
{
    /**
     * Main stylesheet
     */
    wp_enqueue_style(
        'main-css',
        get_template_directory_uri() . '/assets/css/main.css',
        [],
        wp_get_theme()->get('Version')
    );

    /**
     * Main JavaScript (ES Module)
     */
    wp_enqueue_script(
        'main-js',
        get_template_directory_uri() . '/assets/js/main.js',
        [],
        wp_get_theme()->get('Version'),
        true
    );

    /**
     * Pass PHP values to JavaScript.
     * Accessible in JS as:
     *
     * anneo.ajax_url
     * anneo.nonce
     */
    wp_localize_script(
        'main-js',
        'anneo',
        [
            'ajax_url' => admin_url('admin-ajax.php'),
            'nonce' => wp_create_nonce('anneo_auth'),
        ]
    );
}

add_action('wp_enqueue_scripts', 'anne_register_assets');


/* ==========================================================================
   Load main.js as an ES Module
   ========================================================================== */

add_filter('script_loader_tag', function ($tag, $handle, $src) {

    if ($handle === 'main-js') {
        return '<script type="module" src="' . esc_url($src) . '"></script>';
    }

    return $tag;

}, 10, 3);


/* ==========================================================================
   WooCommerce Support
   ========================================================================== */

add_action('after_setup_theme', function () {
    add_theme_support('woocommerce');
});


/* ==========================================================================
   Product Badge Tags
   ========================================================================== */

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


/**
 * Show badge information inside WooCommerce admin.
 */
add_action('admin_notices', function () {

    $screen = get_current_screen();

    if (!$screen) {
        return;
    }

    $is_products_list = (
        $screen->base === 'edit' &&
        $screen->post_type === 'product'
    );

    $is_product_tags = (
        $screen->base === 'edit-tags' &&
        $screen->taxonomy === 'product_tag'
    );

    if (!$is_products_list && !$is_product_tags) {
        return;
    }

    echo '<div class="notice notice-info"><p>';
    echo '<strong>Badge Tags Rule:</strong><br>';
    echo 'Only these tags will appear as product badges:<br>';
    echo '<code>' . implode(', ', get_allowed_badge_tags()) . '</code>';
    echo '</p></div>';

});


/* ==========================================================================
   AJAX Cart
   ========================================================================== */

add_action('wp_ajax_anneo_add_to_cart', 'anneo_add_to_cart');
add_action('wp_ajax_nopriv_anneo_add_to_cart', 'anneo_add_to_cart');

/**
 * Add a product to the WooCommerce cart.
 */
function anneo_add_to_cart()
{
    $product_id = intval($_POST['product_id']);
    $qty = intval($_POST['quantity']);

    WC()->cart->add_to_cart($product_id, $qty);

    wp_send_json([
        'count' => WC()->cart->get_cart_contents_count(),
        'cart' => anneo_get_cart_items(),
    ]);
}


/* ==========================================================================
   AJAX Login
   ========================================================================== */

add_action('wp_ajax_nopriv_anneo_login', 'anneo_login');

/**
 * Authenticate a customer using WordPress login.
 */
function anneo_login()
{
    check_ajax_referer('anneo_auth', 'nonce');

    $creds = [
        'user_login' => sanitize_email($_POST['email']),
        'user_password' => $_POST['password'],
        'remember' => true,
    ];

    $user = wp_signon($creds, false);

    if (is_wp_error($user)) {

        wp_send_json_error([
            'message' => 'Invalid email or password.',
        ]);

    }

    wp_send_json_success([
        'message' => 'Login successful!',
    ]);
}


/* ==========================================================================
   AJAX Signup
   ========================================================================== */

add_action('wp_ajax_nopriv_anneo_signup', 'anneo_signup');

/**
 * Create a new WooCommerce customer account
 * and automatically log the user in.
 */
function anneo_signup()
{
    check_ajax_referer('anneo_auth', 'nonce');

    $name = sanitize_text_field($_POST['name']);
    $email = sanitize_email($_POST['email']);
    $password = $_POST['password'];

    /**
     * Check if email already exists.
     */
    if (email_exists($email)) {

        wp_send_json_error([
            'message' => 'Email already exists.',
        ]);

    }

    /**
     * Generate username from email.
     */
    $username = sanitize_user(current(explode('@', $email)));

    if (username_exists($username)) {
        $username .= rand(1000, 9999);
    }

    /**
     * Create WordPress user.
     */
    $user_id = wp_create_user(
        $username,
        $password,
        $email
    );

    if (is_wp_error($user_id)) {

        wp_send_json_error([
            'message' => 'Unable to create account.',
        ]);

    }

    /**
     * Save customer information.
     */
    wp_update_user([
        'ID' => $user_id,
        'display_name' => $name,
        'first_name' => $name,
    ]);

    /**
     * Automatically log in the new customer.
     */
    wp_set_current_user($user_id);
    wp_set_auth_cookie($user_id);

    wp_send_json_success([
        'message' => 'Welcome to ANNEO Fresh!',
    ]);
}