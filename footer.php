<?php get_template_part('template-parts/footer'); ?>

<nav class="bottom-nav">
  <div class="bn-item <?php echo (is_front_page() || is_home()) ? 'active' : ''; ?>"
    href="<?php echo esc_url(home_url('/')); ?>"><span class="bn-icon">🏠</span>Home</div>
  <div class="bn-item <?php echo (is_shop() || is_product_category() || is_product()) ? 'active' : ''; ?>"
    href="<?php echo esc_url(wc_get_page_permalink('shop')); ?>"><span class="bn-icon">🛒</span>Shop</div>
  <div class="bn-item <?php echo is_page('categories') ? 'active' : ''; ?>"
    href="<?php echo esc_url(get_permalink(get_page_by_path('categories'))); ?>><span class=" bn-icon">
    📦</span>Categories</div>
  <div class="bn-item" onclick="event.stopPropagation();openModal('cart')"><span class="bn-icon">🛒</span>Cart</div>
  <div class="bn-item <?php echo is_page('contact') ? 'active' : ''; ?>"
    href="<?php echo esc_url(get_permalink(get_page_by_path('contact'))); ?>><span class=" bn-icon">📞</span>Contact
  </div>
</nav>
<script src="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@7.3.0/js/fontawesome.min.js"></script>
<?php wp_footer(); ?>
</body>

</html>