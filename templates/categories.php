<?php
/*
  Template Name: Categories Page Template
*/
// Rest of your layout code starts here...
get_header();
?>
<section style="padding:3rem 6% 1.5rem;background:var(--cream2);border-bottom:1px solid var(--cream3);">
  <div class="sec-label">Browse</div>
  <h1 style="font-size:2rem;color:var(--forest);">All Categories</h1>
  <p style="color:var(--text-s);">Explore our full range of premium grocery categories.</p>
</section>
<div class="cat-page-grid">

  <!-- <div class="cat-card" style="padding:2.5rem 1.5rem;" data-filter-shop="flour"><span class="cat-icon">🌾</span><span class="cat-lbl">Flour &amp; Atta</span>
    <p style="font-size:.76rem;color:var(--text-s);margin-top:.5rem;position:relative;z-index:1;">Stone ground, pure
      wheat</p>
  </div> -->
  <?php
  $categories = get_terms(array(
    'taxonomy' => 'product_cat',
    'hide_empty' => false, // Set to true to hide categories with 0 products
  ));


  if (!empty($categories) && !is_wp_error($categories)) {
    foreach ($categories as $category) {
      $category_link = get_term_link($category);
      $category_name = $category->name;
      $category_description = $category->description;
      $thumbnail_id = get_term_meta($category->term_id, 'thumbnail_id', true);

      echo '<div class="cat-card" data-filter-shop="' . esc_attr($category->slug) . '">';
      echo '<span class="cat-icon">' . wp_get_attachment_image($thumbnail_id, 'large') . '</span>';
      echo '<span class="cat-lbl">' . esc_html($category_name) . '</span>';
      echo '<p class="cat-description">' . esc_html($category_description) . '</p>';
      echo '</div>';
    }
  }
  ?>

  <!-- <div class="cat-card" style="padding:2.5rem 1.5rem;" data-filter-shop="flour"><span class="cat-icon"
      style="font-size:3rem;">🌾</span><span class="cat-lbl" style="font-size:1rem;">Flour &amp; Atta</span>
    <p style="font-size:.76rem;color:var(--text-s);margin-top:.5rem;position:relative;z-index:1;">Stone ground, pure
      wheat</p>
  </div>
  <div class="cat-card" style="padding:2.5rem 1.5rem;" data-filter-shop="pulses"><span class="cat-icon"
      style="font-size:3rem;">🫘</span><span class="cat-lbl" style="font-size:1rem;">Pulses</span>
    <p style="font-size:.76rem;color:var(--text-s);margin-top:.5rem;position:relative;z-index:1;">Protein-rich daily
      essentials</p>
  </div>
  <div class="cat-card" style="padding:2.5rem 1.5rem;" data-filter-shop="organic"><span class="cat-icon"
      style="font-size:3rem;">🌿</span><span class="cat-lbl" style="font-size:1rem;">Organic</span>
    <p style="font-size:.76rem;color:var(--text-s);margin-top:.5rem;position:relative;z-index:1;">100% certified organic
    </p>
  </div>
  <div class="cat-card" style="padding:2.5rem 1.5rem;" data-filter-shop="spices"><span class="cat-icon"
      style="font-size:3rem;">🌶</span><span class="cat-lbl" style="font-size:1rem;">Spices</span>
    <p style="font-size:.76rem;color:var(--text-s);margin-top:.5rem;position:relative;z-index:1;">Pure, aromatic flavors
    </p>
  </div>
  <div class="cat-card" style="padding:2.5rem 1.5rem;" data-filter-shop="rice"><span class="cat-icon"
      style="font-size:3rem;">🍚</span><span class="cat-lbl" style="font-size:1rem;">Rice</span>
    <p style="font-size:.76rem;color:var(--text-s);margin-top:.5rem;position:relative;z-index:1;">Premium selected
      grains</p>
  </div>
  <div class="cat-card" style="padding:2.5rem 1.5rem;" data-filter-shop="dryfruits"><span class="cat-icon"
      style="font-size:3rem;">🥜</span><span class="cat-lbl" style="font-size:1rem;">Dry Fruits</span>
    <p style="font-size:.76rem;color:var(--text-s);margin-top:.5rem;position:relative;z-index:1;">Nutritious &amp;
      natural</p>
  </div>
  <div class="cat-card" style="padding:2.5rem 1.5rem;" data-filter-shop="all"><span class="cat-icon"
      style="font-size:3rem;">🛍</span><span class="cat-lbl" style="font-size:1rem;">Essentials</span>
    <p style="font-size:.76rem;color:var(--text-s);margin-top:.5rem;position:relative;z-index:1;">Everyday kitchen needs
    </p>
  </div>
  <div class="cat-card" style="padding:2.5rem 1.5rem;" data-filter-shop="all"><span class="cat-icon"
      style="font-size:3rem;">🎁</span><span class="cat-lbl" style="font-size:1rem;">Combos</span>
    <p style="font-size:.76rem;color:var(--text-s);margin-top:.5rem;position:relative;z-index:1;">Bundle &amp; save big
    </p>
  </div> -->
</div>

<?php
get_footer();
?>