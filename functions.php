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

    $login = sanitize_email($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    if (!is_email($login)) {
        wp_send_json_error([
            'message' => 'Please enter a valid email address.',
        ]);
    }

    $user = get_user_by('email', $login);

    if (!$user) {
        wp_send_json_error([
            'message' => 'No account exists with this email address.',
        ]);
    }

    $creds = [
        'user_login' => $user->user_login,
        'user_password' => $password,
        'remember' => true,
    ];

    $user = wp_signon($creds, is_ssl());

    if (is_wp_error($user)) {

        $code = $user->get_error_code();

        switch ($code) {

            case 'invalid_username':
                $message = 'No account was found with that email or username.';
                break;

            case 'incorrect_password':
                $message = 'Incorrect password. Please try again.';
                break;

            case 'empty_username':
                $message = 'Please enter your email.';
                break;

            case 'empty_password':
                $message = 'Please enter your password.';
                break;

            default:
                $message = 'Unable to log in. Please check your credentials and try again.';
        }

        wp_send_json_error([
            'message' => $message,
        ]);
    }

    wp_send_json_success([
        'message' => 'Welcome back!',
        'redirect' => wc_get_page_permalink('myaccount'),
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

    $name = sanitize_text_field($_POST['name'] ?? '');
    $email = sanitize_email($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    /*
    |--------------------------------------------------------------------------
    | Required Fields
    |--------------------------------------------------------------------------
    */

    if (empty($name) || empty($email) || empty($password)) {
        wp_send_json_error([
            'message' => 'Please fill in all required fields.',
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | Name Validation
    |--------------------------------------------------------------------------
    */

    if (strlen($name) < 3) {
        wp_send_json_error([
            'message' => 'Please enter your full name.',
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | Email Validation
    |--------------------------------------------------------------------------
    */

    if (!is_email($email)) {
        wp_send_json_error([
            'message' => 'Please enter a valid email address.',
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | Password Validation
    |--------------------------------------------------------------------------
    */

    if (strlen($password) < 8) {
        wp_send_json_error([
            'message' => 'Password must be at least 8 characters long.',
        ]);
    }

    if (!preg_match('/[A-Z]/', $password)) {
        wp_send_json_error([
            'message' => 'Password must contain at least one uppercase letter.',
        ]);
    }

    if (!preg_match('/[a-z]/', $password)) {
        wp_send_json_error([
            'message' => 'Password must contain at least one lowercase letter.',
        ]);
    }

    if (!preg_match('/[0-9]/', $password)) {
        wp_send_json_error([
            'message' => 'Password must contain at least one number.',
        ]);
    }

    if (!preg_match('/[\W_]/', $password)) {
        wp_send_json_error([
            'message' => 'Password must contain at least one special character.',
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | Generate Username
    |--------------------------------------------------------------------------
    */

    $username = sanitize_user(strstr($email, '@', true));

    if (empty($username)) {
        $username = 'customer';
    }

    while (username_exists($username)) {
        $username = sanitize_user(strstr($email, '@', true)) . wp_rand(1000, 9999);
    }

    /*
    |--------------------------------------------------------------------------
    | Create WooCommerce Customer
    |--------------------------------------------------------------------------
    */

    $user_id = wc_create_new_customer(
        $email,
        $username,
        $password
    );

    if (is_wp_error($user_id)) {

        switch ($user_id->get_error_code()) {

            case 'registration-error-email-exists':
                $message = 'An account with this email already exists.';
                break;

            case 'registration-error-invalid-email':
                $message = 'Please enter a valid email address.';
                break;

            case 'registration-error-username-exists':
                $message = 'Username already exists.';
                break;

            default:
                $message = $user_id->get_error_message();
        }

        wp_send_json_error([
            'message' => $message,
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | Split Name
    |--------------------------------------------------------------------------
    */

    $parts = preg_split('/\s+/', trim($name), 2);

    $first_name = $parts[0];
    $last_name = $parts[1] ?? '';

    /*
    |--------------------------------------------------------------------------
    | Update User Profile
    |--------------------------------------------------------------------------
    */

    wp_update_user([
        'ID' => $user_id,
        'display_name' => $name,
        'first_name' => $first_name,
        'last_name' => $last_name,
    ]);

    /*
    |--------------------------------------------------------------------------
    | WooCommerce Billing Details
    |--------------------------------------------------------------------------
    */

    update_user_meta($user_id, 'billing_first_name', $first_name);
    update_user_meta($user_id, 'billing_last_name', $last_name);

    /*
    |--------------------------------------------------------------------------
    | WooCommerce Shipping Details
    |--------------------------------------------------------------------------
    */

    update_user_meta($user_id, 'shipping_first_name', $first_name);
    update_user_meta($user_id, 'shipping_last_name', $last_name);

    /*
    |--------------------------------------------------------------------------
    | Automatically Login User
    |--------------------------------------------------------------------------
    */

    wp_set_current_user($user_id);

    wp_set_auth_cookie($user_id, true);

    do_action('wp_login', $username, get_user_by('id', $user_id));

    /*
    |--------------------------------------------------------------------------
    | Success Response
    |--------------------------------------------------------------------------
    */

    wp_send_json_success([
        'message' => 'Welcome to ANNEO Fresh! Your account has been created successfully.',
        'redirect' => wc_get_page_permalink('myaccount'),
    ]);
}