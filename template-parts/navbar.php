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
    <button class="nav-login" onclick="openModal('login')">Login</button>
    <button class="nav-shop" data-page="shop">Shop Now</button>
    <div class="nav-cart" onclick="openModal('cart')">🛒 <span class="cart-count" id="cart-count">0</span></div>
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

<!-- ======= MODALS ======= -->
<div class="modal-overlay" id="modal-login">
  <div class="modal-box">
    <button class="modal-close" onclick="closeModal('login')">✕</button>
    <h2>👋 Welcome Back</h2>
    <div class="modal-field"><label>Email / Phone</label><input type="text" id="l-email"
        placeholder="Email or Mobile Number"></div>
    <div class="modal-field"><label>Password</label><input type="password" id="l-pass"
        placeholder="Enter your password"></div>
    <button class="modal-btn" onclick="handleLogin()">Login →</button>
    <p class="modal-switch">New here? <a onclick="switchModal('login','signup')">Create Account</a></p>
  </div>
</div>
<div class="modal-overlay" id="modal-signup">
  <div class="modal-box">
    <button class="modal-close" onclick="closeModal('signup')">✕</button>
    <h2>🌿 Join ANNEO Fresh</h2>
    <div class="modal-field"><label>Full Name</label><input type="text" id="s-name" placeholder="Your full name"></div>
    <div class="modal-field"><label>Email</label><input type="email" id="s-email" placeholder="you@example.com"></div>
    <div class="modal-field"><label>Mobile Number</label><input type="tel" id="s-phone" placeholder="+91 XXXXX XXXXX">
    </div>
    <div class="modal-field"><label>Password</label><input type="password" id="s-pass"
        placeholder="Create a strong password"></div>
    <button class="modal-btn" onclick="handleSignup()">Create Account 🌿</button>
    <p class="modal-switch">Already have an account? <a onclick="switchModal('signup','login')">Login</a></p>
  </div>
</div>
<div class="modal-overlay" id="modal-cart">
  <div class="modal-box" style="max-width:500px;">
    <button class="modal-close" onclick="closeModal('cart')">✕</button>
    <h2>🛒 Your Bag</h2>
    <div id="cart-items-container"></div>
    <div id="cart-footer" style="display:none;">
      <div class="cart-total"><span>Total</span><span id="cart-total-val">₹0</span></div>
      <button class="modal-btn" onclick="handleCheckout()">Proceed to Checkout →</button>
    </div>
  </div>
</div>
<div class="modal-overlay" id="modal-buynow">
  <div class="modal-box">
    <button class="modal-close" onclick="closeModal('buynow')">✕</button>
    <h2>⚡ Quick Buy</h2>
    <div id="buy-product-preview"
      style="display:flex;align-items:center;gap:1rem;background:var(--cream2);border-radius:14px;padding:1rem;margin-bottom:1.2rem;">
    </div>
    <div class="modal-field"><label>Full Name</label><input type="text" id="buy-name" placeholder="Your name"></div>
    <div class="modal-field"><label>Mobile Number</label><input type="tel" id="buy-phone" placeholder="+91 XXXXX XXXXX">
    </div>
    <div class="modal-field"><label>Delivery Address</label><textarea id="buy-addr"
        placeholder="Full delivery address with pincode..."></textarea></div>
    <div class="modal-field"><label>Payment Method</label>
      <select id="buy-payment">
        <option value="upi">UPI</option>
        <option value="paytm">Paytm</option>
        <option value="phonepay">PhonePe</option>
        <option value="gpay">Google Pay</option>
        <option value="card">Debit / Credit Card</option>
        <option value="cod">Cash on Delivery</option>
      </select>
    </div>
    <button class="modal-btn" onclick="handleBuyNow()">Confirm Order ✅</button>
  </div>
</div>
<div class="modal-overlay" id="modal-wa">
  <div class="modal-box">
    <button class="modal-close" id="wa-close-btn">✕</button>
    <div style="font-size:3rem;text-align:center;margin-bottom:.5rem;">💬</div>
    <h2 style="text-align:center;">Chat on WhatsApp</h2>
    <div class="modal-field"><label>Your Name</label><input type="text" id="wa-name" placeholder="Your name"></div>
    <div class="modal-field"><label>Message</label><textarea id="wa-msg"
        placeholder="Hello, I want to enquire about..."></textarea></div>
    <button class="modal-btn" id="wa-send-btn" style="background:#25D366;">💬 Open WhatsApp →</button>
  </div>
</div>

<div id="toast"></div>