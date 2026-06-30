<!-- NAVBAR -->
<nav id="topnav">
  <div class="nav-brand" data-page="home">
    <div class="nav-brand-text">
      <div class="nav-brand-name">ANNEO<span> Fresh</span></div>
      <div class="nav-brand-tag">Pure · Natural · Fresh</div>
    </div>
  </div>

  <ul class="nav-links">
    <!-- Home Link -->
    <li>
      <a href="<?php echo esc_url(home_url('/')); ?>"
        class="<?php echo (is_front_page() || is_home()) ? 'active' : ''; ?>">Home</a>
    </li>

    <!-- WooCommerce Shop Link -->
    <?php if (class_exists('WooCommerce')): ?>
      <li>
        <a href="<?php echo esc_url(wc_get_page_permalink('shop')); ?>"
          class="<?php echo (is_shop() || is_product_category() || is_product()) ? 'active' : ''; ?>">Shop</a>
      </li>
    <?php endif; ?>

    <!-- Categories Page Link -->
    <li>
      <a href="<?php echo esc_url(get_permalink(get_page_by_path('categories'))); ?>"
        class="<?php echo is_page('categories') ? 'active' : ''; ?>">Categories</a>
    </li>

    <!-- About Page Link -->
    <li>
      <a href="<?php echo esc_url(get_permalink(get_page_by_path('about'))); ?>"
        class="<?php echo is_page('about') ? 'active' : ''; ?>">About</a>
    </li>

    <!-- Contact Page Link -->
    <li>
      <a href="<?php echo esc_url(get_permalink(get_page_by_path('contact'))); ?>"
        class="<?php echo is_page('contact') ? 'active' : ''; ?>">Contact</a>
    </li>
  </ul>


  <div class="nav-right">
    <?php
    if (is_user_logged_in()):
      $user = wp_get_current_user();
      $first_name = get_user_meta($user->ID, 'first_name', true);

      if (empty($first_name)) {
        $first_name = $user->display_name;
      }

      ?>

      <div class="nav-user-menu">
        <button class="user-btn" id="userMenuBtn">
          <span class="user-icon"><i class="fa-solid fa-user"></i></span>

        </button>

        <div class="user-dropdown" id="userDropdown">

          <span class="user-greeting">
            <?php echo esc_html($first_name); ?>
          </span>
          <a href="<?php echo esc_url(wc_get_page_permalink('myaccount')); ?>">
            My Account
          </a>

          <a href="<?php echo esc_url(wc_get_account_endpoint_url('edit-address')); ?>">
            My Addresses
          </a>

          <a href="<?php echo esc_url(wp_logout_url(home_url())); ?>">
            Logout
          </a>

        </div>
      </div>


    <?php else: ?>

      <button data-open="login" class="nav-login">Login</button>

    <?php endif; ?>
    <a class="nav-shop" href="<?php echo esc_url(wc_get_page_permalink('shop')); ?>">Shop Now</a>
    <div data-open="cart" class="nav-cart">🛒
      <?php echo WC()->cart ? WC()->cart->get_cart_contents_count() : 0; ?>
    </div>

    <button class="hamburger" id="hbg" aria-label="Menu"><span></span><span></span><span></span></button>
  </div>
</nav>


<!-- MOBILE MENU -->
<div class="mobile-menu" id="mmenu">
  <a href="<?php echo get_permalink(get_page_by_path('home')); ?>">Home</a>
  <a href="<?php echo get_permalink(get_page_by_path('shop')); ?>">Shop</a>
  <a href="<?php echo get_permalink(get_page_by_path('categories')); ?>">Categories</a>
  <a href="<?php echo get_permalink(get_page_by_path('about')); ?>">About</a>
  <a href="<?php echo get_permalink(get_page_by_path('contact')); ?>">Contact</a>
  <div class="mobile-auth">
    <a class="m-login" id="mm-login-btn">Login</a>
    <a class="m-signup" id="mm-signup-btn">Sign Up</a>
  </div>
</div>


<!-- TRUST BAR -->
<div class="trust-bar">
  <div class="trust-ticker">
    <span class="trust-item">🌱 Farm-Fresh Quality <span class="dot">✦</span></span>
    <span class="trust-item">🚚 Free Delivery Above ₹499 <span class="dot">✦</span></span>
    <span class="trust-item">🔬 FSSAI Certified <span class="dot">✦</span></span>
    <span class="trust-item">💳 UPI · Paytm · PhonePe · Cards <span class="dot">✦</span></span>
    <span class="trust-item">📦 Premium Packaging <span class="dot">✦</span></span>
    <span class="trust-item">❤️ 10,000+ Happy Families <span class="dot">✦</span></span>
    <span class="trust-item">🌱 Farm-Fresh Quality <span class="dot">✦</span></span>
    <span class="trust-item">🚚 Free Delivery Above ₹499 <span class="dot">✦</span></span>
    <span class="trust-item">🔬 FSSAI Certified <span class="dot">✦</span></span>
    <span class="trust-item">💳 UPI · Paytm · PhonePe · Cards <span class="dot">✦</span></span>
    <span class="trust-item">📦 Premium Packaging <span class="dot">✦</span></span>
    <span class="trust-item">❤️ 10,000+ Happy Families <span class="dot">✦</span></span>
  </div>
</div>




<div id="toast"></div>


<?php
get_template_part('template-parts/modals/login');
get_template_part('template-parts/modals/signup');
get_template_part('template-parts/modals/cart');
get_template_part('template-parts/modals/buynow');
get_template_part('template-parts/modals/whatsapp');
?>